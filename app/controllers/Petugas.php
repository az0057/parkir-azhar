<?php

class Petugas extends Controller {
    
    public function __construct() {
        // Set timezone agar sinkron dengan Model (WIB)
        date_default_timezone_set('Asia/Jakarta');
        
        // Proteksi: Pastikan sudah login dan role adalah petugas
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'petugas') {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    /**
     * Tampilan Utama Dashboard Petugas
     */
    public function index() {
        $data['judul'] = 'Transaksi Parkir';
        
        // Ambil data kendaraan yang statusnya masih 'masuk'
        $data['kendaraan'] = $this->model('Parkir_model')->getKendaraanAktif();
        
        // Ambil data area untuk dropdown pilihan lokasi
        $data['area'] = $this->model('Parkir_model')->getArea();

        $this->view('templates/header', $data);
        $this->view('petugas/index', $data);
        $this->view('templates/footer');
    }

    /**
     * PROSES KENDARAAN MASUK
     */
    public function masuk() {
        $plat = strtoupper(trim($_POST['plat_nomor']));
        $id_area = $_POST['id_area'];
        $model = $this->model('Parkir_model');
        
        // 1. Cek duplikasi kendaraan di dalam
        $kendaraanAktif = $model->getKendaraanAktif();
        foreach ($kendaraanAktif as $row) {
            if (str_replace(' ', '', $row['plat_nomor']) === str_replace(' ', '', $plat)) {
                echo "<script>
                        alert('Gagal! Kendaraan $plat masih parkir di dalam.');
                        window.location.href = '" . BASEURL . "/petugas';
                      </script>";
                exit;
            }
        }

        // 2. Cek member
        $member = $model->getKendaraanByPlat($plat);

        if ($member) {
            $dataInsert = [
                'id_kendaraan' => $member['id_kendaraan'],
                'id_area' => $id_area
            ];

            if ($model->kendaraanMasuk($dataInsert) > 0) {
                $_SESSION['flash'] = "Kendaraan $plat berhasil masuk.";
                header('Location: ' . BASEURL . '/petugas');
                exit;
            }
        } else {
            echo "<script>
                    alert('Gagal! Plat nomor $plat tidak terdaftar.');
                    window.location.href = '" . BASEURL . "/petugas';
                  </script>";
            exit;
        }
    }

    /**
     * PROSES KENDARAAN KELUAR (CHECKOUT)
     * PERBAIKAN: Menjamin data session terisi sebelum pindah halaman
     */
    public function keluar($id) {
        $model = $this->model('Parkir_model');
        
        // Cek apakah data memang ada
        $detail = $model->getParkirById($id);
        if (!$detail) {
            header('Location: ' . BASEURL . '/petugas');
            exit;
        }

        // Jalankan perintah keluar (Biaya dihitung otomatis di Model)
        if ($model->kendaraanKeluar($id) > 0) {
            // AMBIL ULANG data terbaru dari DB (agar biaya_total yang baru dihitung ikut terbaca)
            $dataTerbaru = $model->getParkirById($id);

            // Simpan ke session untuk ditampilkan di modal/notifikasi dashboard
            $_SESSION['flash_bayar'] = [
                'id'    => $id,
                'plat'  => $dataTerbaru['plat_nomor'],
                'biaya' => $dataTerbaru['biaya_total'],
                'status' => 'sukses'
            ];
        } else {
            $_SESSION['flash'] = "Gagal memproses checkout kendaraan.";
        }

        header('Location: ' . BASEURL . '/petugas');
        exit;
    }

    public function hapus($id) {
        if ($this->model('Parkir_model')->hapusDataParkir($id) > 0) {
            $_SESSION['flash'] = "Data berhasil dihapus.";
        }
        header('Location: ' . BASEURL . '/petugas');
        exit;
    }

    public function cetak($id) {
        $data['judul'] = 'Struk Parkir';
        $data['parkir'] = $this->model('Parkir_model')->getParkirById($id); 
        
        if (!$data['parkir']) {
            echo "Data tidak ditemukan!";
            exit;
        }
        
        $this->view('petugas/cetak', $data);
    }
}