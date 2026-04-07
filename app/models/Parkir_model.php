<?php

class Parkir_model {
    private $table = 'tb_transaksi'; 
    private $db;

    public function __construct() {
        $this->db = new Database;
        // Memastikan waktu sinkron dengan zona waktu lokal
        date_default_timezone_set('Asia/Jakarta');
    }

    // ==========================================================
    // --- MANAJEMEN MASTER KENDARAAN (ADMIN) ---
    // ==========================================================

    public function getAllKendaraan() {
        $this->db->query("SELECT k.*, u.username FROM tb_kendaraan k 
                          LEFT JOIN tb_user u ON k.id_user = u.id_user 
                          ORDER BY k.plat_nomor ASC");
        return $this->db->resultSet();
    }

    public function getKendaraanByPlat($plat) {
        $plat_check = strtoupper(str_replace(' ', '', $plat));
        $this->db->query("SELECT * FROM tb_kendaraan WHERE REPLACE(plat_nomor, ' ', '') = :plat");
        $this->db->bind('plat', $plat_check);
        return $this->db->single();
    }

    public function getKendaraanById($id) {
        $this->db->query("SELECT * FROM tb_kendaraan WHERE id_kendaraan = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahMasterKendaraan($data) {
        if ($this->getKendaraanByPlat($data['plat_nomor'])) {
            return -1; 
        }
        $query = "INSERT INTO tb_kendaraan (plat_nomor, jenis_kendaraan, warna, pemilik, id_user) 
                  VALUES (:plat, :jenis, :warna, :pemilik, :id_user)";
        $this->db->query($query);
        $this->db->bind('plat', strtoupper($data['plat_nomor']));
        $this->db->bind('jenis', $data['jenis_kendaraan']);
        $this->db->bind('warna', !empty($data['warna']) ? $data['warna'] : '-');
        $this->db->bind('pemilik', $data['pemilik']);
        $this->db->bind('id_user', $_SESSION['id_user']);
        $this->db->execute();
        
        $this->addLog("Tambah Member: " . strtoupper($data['plat_nomor']));
        return $this->db->rowCount();
    }

    public function ubahMasterKendaraan($data) {
        $query = "UPDATE tb_kendaraan SET 
                    plat_nomor = :plat, 
                    jenis_kendaraan = :jenis, 
                    warna = :warna, 
                    pemilik = :pemilik 
                  WHERE id_kendaraan = :id";
        $this->db->query($query);
        $this->db->bind('plat', strtoupper($data['plat_nomor']));
        $this->db->bind('jenis', $data['jenis_kendaraan']);
        $this->db->bind('warna', $data['warna']);
        $this->db->bind('pemilik', $data['pemilik']);
        $this->db->bind('id', $data['id_kendaraan']);
        $this->db->execute();
        
        $this->addLog("Update Member ID: " . $data['id_kendaraan']);
        return $this->db->rowCount();
    }

    public function hapusMasterKendaraan($id) {
        $this->db->query("SELECT id_parkir FROM " . $this->table . " WHERE id_kendaraan = :id LIMIT 1");
        $this->db->bind('id', $id);
        if ($this->db->single()) {
            return -2; 
        }

        $this->db->query("DELETE FROM tb_kendaraan WHERE id_kendaraan = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        
        $this->addLog("Hapus Member ID: " . $id);
        return $this->db->rowCount();
    }

    // ==========================================================
    // --- OPERASIONAL PARKIR (PETUGAS) ---
    // ==========================================================

    public function getParkirById($id) {
        $query = "SELECT t.*, a.nama_area, k.plat_nomor, k.pemilik as nama_pemilik, k.jenis_kendaraan, tr.tarif_per_jam
                  FROM " . $this->table . " t
                  INNER JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
                  LEFT JOIN tb_area_parkir a ON t.id_area = a.id_area
                  LEFT JOIN tb_tarif tr ON t.id_tarif = tr.id_tarif
                  WHERE t.id_parkir = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getKendaraanAktif() {
        $query = "SELECT t.*, a.nama_area, k.plat_nomor, k.pemilik as nama_pemilik, k.jenis_kendaraan
                  FROM " . $this->table . " t
                  INNER JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
                  LEFT JOIN tb_area_parkir a ON t.id_area = a.id_area
                  WHERE t.status = 'masuk' 
                  ORDER BY t.waktu_masuk DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function kendaraanMasuk($data) {
        $this->db->query("SELECT jenis_kendaraan, plat_nomor FROM tb_kendaraan WHERE id_kendaraan = :id_k");
        $this->db->bind('id_k', $data['id_kendaraan']);
        $k = $this->db->single();

        $tarif = $this->getTarifByJenis($k['jenis_kendaraan']);

        $queryT = "INSERT INTO " . $this->table . " (id_kendaraan, waktu_masuk, id_tarif, status, id_user, id_area, biaya_total) 
                   VALUES (:id_k, :waktu, :id_t, 'masuk', :id_u, :id_a, 0)";
        $this->db->query($queryT);
        $this->db->bind('id_k', $data['id_kendaraan']);
        $this->db->bind('waktu', date('Y-m-d H:i:s'));
        $this->db->bind('id_t', $tarif['id_tarif']);
        $this->db->bind('id_u', $_SESSION['id_user']);
        $this->db->bind('id_a', $data['id_area']); 
        $this->db->execute();
        
        $this->db->query("UPDATE tb_area_parkir SET terisi = terisi + 1 WHERE id_area = :id_a");
        $this->db->bind('id_a', $data['id_area']);
        $this->db->execute();

        $this->addLog("Parkir Masuk: " . $k['plat_nomor']);
        return $this->db->rowCount();
    }

    /**
     * PERBAIKAN LOGIKA: Menghitung biaya otomatis berdasarkan selisih waktu
     */
    public function kendaraanKeluar($id) {
        // 1. Ambil data transaksi & tarif
        $parkir = $this->getParkirById($id);
        if (!$parkir) return 0;

        $tarif = $this->getTarifByJenis($parkir['jenis_kendaraan']);
        $biaya_per_jam = $tarif['tarif_per_jam'] ?? 2000;

        // 2. Hitung Durasi
        $waktu_masuk = new DateTime($parkir['waktu_masuk']);
        $waktu_keluar = new DateTime(); // Waktu sekarang
        $interval = $waktu_masuk->diff($waktu_keluar);

        // Konversi durasi ke jam (minimal 1 jam)
        $total_jam = ($interval->days * 24) + $interval->h;
        if ($interval->i > 0 || $interval->s > 0) {
            $total_jam++;
        }

        // 3. Kalkulasi Biaya Total
        $biaya_total = $total_jam * $biaya_per_jam;

        // 4. Update Database
        $query = "UPDATE " . $this->table . " SET 
                    waktu_keluar = :waktu_keluar, 
                    biaya_total = :biaya, 
                    status = 'keluar' 
                  WHERE id_parkir = :id";
        $this->db->query($query);
        $this->db->bind('waktu_keluar', $waktu_keluar->format('Y-m-d H:i:s'));
        $this->db->bind('biaya', $biaya_total);
        $this->db->bind('id', $id);
        $this->db->execute();

        // 5. Update Kapasitas Area Parkir
        if (!empty($parkir['id_area'])) {
            $this->db->query("UPDATE tb_area_parkir SET terisi = terisi - 1 WHERE id_area = :id_a AND terisi > 0");
            $this->db->bind('id_a', $parkir['id_area']);
            $this->db->execute();
        }

        $this->addLog("Parkir Keluar: " . $parkir['plat_nomor'] . " (Total: " . $biaya_total . ")");
        return $this->db->rowCount();
    }

    public function hapusDataParkir($id) {
        $this->db->query("SELECT id_area, status FROM " . $this->table . " WHERE id_parkir = :id");
        $this->db->bind('id', $id);
        $transaksi = $this->db->single();

        if ($transaksi && $transaksi['status'] === 'masuk') {
            $this->db->query("UPDATE tb_area_parkir SET terisi = terisi - 1 WHERE id_area = :id_a AND terisi > 0");
            $this->db->bind('id_a', $transaksi['id_area']);
            $this->db->execute();
        }

        $this->db->query("DELETE FROM " . $this->table . " WHERE id_parkir = :id");
        $this->db->bind('id', $id);
        $this->db->execute();

        $this->addLog("Hapus Transaksi ID: " . $id);
        return $this->db->rowCount();
    }

    // ==========================================================
    // --- MANAJEMEN TARIF & AREA ---
    // ==========================================================

    public function getTarif() {
        $this->db->query("SELECT * FROM tb_tarif");
        return $this->db->resultSet();
    }

    public function getTarifByJenis($jenis) {
        $this->db->query("SELECT * FROM tb_tarif WHERE LOWER(jenis_kendaraan) = LOWER(:jenis)");
        $this->db->bind('jenis', $jenis);
        return $this->db->single();
    }

    public function updateTarif($data) {
        $query = "UPDATE tb_tarif SET tarif_per_jam = :tarif WHERE jenis_kendaraan = :jenis";
        $this->db->query($query);
        $this->db->bind('tarif', $data['tarif']);
        $this->db->bind('jenis', strtoupper($data['jenis']));
        $this->db->execute();

        $this->addLog("Update Tarif " . strtoupper($data['jenis']) . " menjadi " . $data['tarif']);
        return $this->db->rowCount();
    }

    public function getArea() {
        $this->db->query("SELECT * FROM tb_area_parkir");
        return $this->db->resultSet();
    }

    public function updateArea($data) {
        $query = "UPDATE tb_area_parkir SET 
                    nama_area = :nama, 
                    kapasitas = :kapasitas 
                  WHERE id_area = :id";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama_area']);
        $this->db->bind('kapasitas', $data['kapasitas']);
        $this->db->bind('id', $data['id_area']);
        $this->db->execute();

        $this->addLog("Update Area: " . $data['nama_area'] . " (Kapasitas Baru: " . $data['kapasitas'] . ")");
        return $this->db->rowCount();
    }

    public function getLaporanByDate($tgl_mulai = null, $tgl_selesai = null) {
        $query = "SELECT t.*, a.nama_area, k.plat_nomor, k.pemilik as nama_pemilik, k.jenis_kendaraan
                  FROM " . $this->table . " t
                  INNER JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
                  LEFT JOIN tb_area_parkir a ON t.id_area = a.id_area
                  WHERE t.status = 'keluar'";

        if (!empty($tgl_mulai) && !empty($tgl_selesai)) {
            $query .= " AND DATE(t.waktu_keluar) BETWEEN :mulai AND :selesai";
        }

        $query .= " ORDER BY t.waktu_keluar DESC";
        $this->db->query($query);

        if (!empty($tgl_mulai) && !empty($tgl_selesai)) {
            $this->db->bind('mulai', $tgl_mulai);
            $this->db->bind('selesai', $tgl_selesai);
        }

        return $this->db->resultSet();
    }

    // ==========================================================
    // --- LOG & STATISTIK ---
    // ==========================================================

    public function addLog($aksi) {
        $query = "INSERT INTO tb_log_aktivitas (id_user, aktivitas, waktu_aktivitas) 
                  VALUES (:id_u, :aksi, :waktu)";
        $this->db->query($query);
        $id_user = $_SESSION['id_user'] ?? 0;
        $this->db->bind('id_u', $id_user);
        $this->db->bind('aksi', $aksi);
        $this->db->bind('waktu', date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    public function getLogs() {
        $query = "SELECT l.*, u.username FROM tb_log_aktivitas l 
                  JOIN tb_user u ON l.id_user = u.id_user 
                  ORDER BY l.waktu_aktivitas DESC LIMIT 10";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getJumlahKendaraanParkir() {
        $this->db->query("SELECT COUNT(*) as total FROM " . $this->table . " WHERE status = 'masuk'");
        $res = $this->db->single();
        return $res['total'] ?? 0;
    }

    public function getTotalPendapatanHariIni() {
        $this->db->query("SELECT SUM(biaya_total) as total FROM " . $this->table . " 
                          WHERE status = 'keluar' AND DATE(waktu_keluar) = CURDATE()");
        $res = $this->db->single();
        return $res['total'] ?? 0;
    }

    public function getJumlahMember() {
        $this->db->query("SELECT COUNT(*) as total FROM tb_kendaraan");
        $res = $this->db->single();
        return $res['total'] ?? 0;
    }
}