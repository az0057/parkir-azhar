<?php

class Admin extends Controller {

    public function __construct() {
        // Set timezone agar pencatatan log akurat sesuai waktu lokal
        date_default_timezone_set('Asia/Jakarta');

        // Middleware: Proteksi session login
        if (!isset($_SESSION['role'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    // ==========================================================
    // --- DASHBOARD UTAMA ---
    // ==========================================================

    public function index() {
        $data['judul'] = 'Dashboard Utama';
        
        $parkirModel = $this->model('Parkir_model');
        
        // Mengambil statistik dasar
        $data['total_pendapatan'] = $parkirModel->getTotalPendapatanHariIni();
        $data['kendaraan_aktif'] = $parkirModel->getJumlahKendaraanParkir();
        $data['logs'] = $parkirModel->getLogs();
        
        // Mengirimkan seluruh data area ke View agar bisa dihitung totalnya
        $data['area'] = $parkirModel->getArea(); 
        
        $this->view('templates/header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }

    // ==========================================================
    // --- KELOLA KENDARAAN (MEMBER) ---
    // ==========================================================

    public function kendaraan() {
        $data['judul'] = 'Data Master Kendaraan';
        $data['kendaraan'] = $this->model('Parkir_model')->getAllKendaraan();
        $data['tarif'] = $this->model('Parkir_model')->getTarif();

        $this->view('templates/header', $data);
        $this->view('admin/kendaraan', $data);
        $this->view('templates/footer');
    }

    public function tambah_kendaraan() {
        $result = $this->model('Parkir_model')->tambahMasterKendaraan($_POST);

        if ($result > 0) {
            header('Location: ' . BASEURL . '/admin/kendaraan');
            exit;
        } else if ($result == -1) {
            echo "<script>
                    alert('Gagal! Plat nomor " . htmlspecialchars($_POST['plat_nomor']) . " sudah terdaftar.');
                    window.location.href = '" . BASEURL . "/admin/kendaraan';
                  </script>";
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/kendaraan');
            exit;
        }
    }

    public function ubah_kendaraan() {
        if ($this->model('Parkir_model')->ubahMasterKendaraan($_POST) >= 0) {
            header('Location: ' . BASEURL . '/admin/kendaraan');
            exit;
        }
    }

    public function hapus_kendaraan($id) {
        $result = $this->model('Parkir_model')->hapusMasterKendaraan($id);
        if ($result > 0) {
            header('Location: ' . BASEURL . '/admin/kendaraan');
            exit;
        } else if ($result == -2) {
            echo "<script>
                    alert('Gagal! Kendaraan ini masih memiliki riwayat transaksi di database.');
                    window.location.href = '" . BASEURL . "/admin/kendaraan';
                  </script>";
            exit;
        }
        header('Location: ' . BASEURL . '/admin/kendaraan');
        exit;
    }

    // ==========================================================
    // --- KELOLA USER ---
    // ==========================================================

    public function user() {
        if (strtolower($_SESSION['role']) !== 'admin') {
            header('Location: ' . BASEURL . '/admin');
            exit;
        }

        $data['judul'] = 'Kelola Pengguna';
        $data['user'] = $this->model('User_model')->getAllUser();

        $this->view('templates/header', $data);
        $this->view('admin/user', $data);
        $this->view('templates/footer');
    }

    public function tambahUser() {
        if ($this->model('User_model')->tambahDataUser($_POST) > 0) {
            $this->model('Parkir_model')->addLog("Menambah user baru: " . $_POST['username']);
            header('Location: ' . BASEURL . '/admin/user');
            exit;
        }
    }

    public function getubahUser() {
        echo json_encode($this->model('User_model')->getUserById($_POST['id']));
    }

    public function ubahUser() {
        if ($this->model('User_model')->editDataUser($_POST) >= 0) {
            $this->model('Parkir_model')->addLog("Mengubah data user: " . $_POST['username']);
        }
        header('Location: ' . BASEURL . '/admin/user');
        exit;
    }

    public function hapusUser($id) {
        if ($this->model('User_model')->hapusDataUser($id) > 0) {
            $this->model('Parkir_model')->addLog("Menghapus user ID: " . $id);
        }
        header('Location: ' . BASEURL . '/admin/user');
        exit;
    }

    // ==========================================================
    // --- MANAJEMEN SISTEM (TARIF & AREA) ---
    // ==========================================================

    public function tarif() {
        $data['judul'] = 'Manajemen Tarif';
        $data['tarif'] = $this->model('Parkir_model')->getTarif(); 

        $this->view('templates/header', $data);
        $this->view('admin/tarif', $data);
        $this->view('templates/footer');
    }

    public function update_tarif() {
        if ($this->model('Parkir_model')->updateTarif($_POST) >= 0) {
            header('Location: ' . BASEURL . '/admin/tarif');
            exit;
        }
    }

    public function area() {
        $data['judul'] = 'Area & Slot Parkir';
        $data['area'] = $this->model('Parkir_model')->getArea();
        
        $this->view('templates/header', $data);
        $this->view('admin/area', $data);
        $this->view('templates/footer');
    }

    public function ubah_area() {
        if($this->model('Parkir_model')->updateArea($_POST) >= 0) {
            $logMsg = "Update area: " . ($_POST['nama_area'] ?? 'ID '.$_POST['id_area']);
            $this->model('Parkir_model')->addLog($logMsg);
            header('Location: ' . BASEURL . '/admin/area');
            exit;
        }
    }

    // ==========================================================
    // --- ANALISIS & LOG ---
    // ==========================================================

    public function laporan() {
        /** * PROTEKSI KETAT: Hanya Owner yang boleh mengakses laporan.
         * Jika role user bukan 'owner', redirect ke dashboard index.
         */
        if (strtolower($_SESSION['role']) !== 'owner') {
            header('Location: ' . BASEURL . '/admin/index');
            exit;
        }

        // Jika form filter tidak diisi, biarkan null agar Model menampilkan semua data
        $tgl_mulai = (!empty($_POST['tgl_mulai'])) ? $_POST['tgl_mulai'] : null;
        $tgl_selesai = (!empty($_POST['tgl_selesai'])) ? $_POST['tgl_selesai'] : null;

        $data['judul'] = 'Laporan Transaksi';
        
        // Panggil model dengan parameter tanggal
        $data['riwayat'] = $this->model('Parkir_model')->getLaporanByDate($tgl_mulai, $tgl_selesai);
        
        $data['tgl_mulai'] = $tgl_mulai;
        $data['tgl_selesai'] = $tgl_selesai;

        $this->view('templates/header', $data);
        $this->view('admin/laporan', $data);
        $this->view('templates/footer');
    }

    public function log() {
        if (strtolower($_SESSION['role']) !== 'admin') {
            header('Location: ' . BASEURL . '/admin');
            exit;
        }

        $data['judul'] = 'Log Aktivitas';
        $data['logs'] = $this->model('Parkir_model')->getLogs();

        $this->view('templates/header', $data);
        $this->view('admin/log', $data);
        $this->view('templates/footer');
    }
}