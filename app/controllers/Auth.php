<?php

class Auth extends Controller {

    public function index() {
        // Jika sudah login, langsung arahkan ke dashboard masing-masing
        if (isset($_SESSION['role'])) {
            $this->redirectByRole($_SESSION['role']);
        }

        $data['judul'] = 'Login - Parkirkeun';
        $this->view('auth/login', $data);
    }

    public function proses() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = $this->model('User_model');
        $user = $userModel->getUserByUsername($username);

        if ($user) {
            // Menggunakan password_verify jika password di database sudah di-hash
            // Jika masih teks biasa, gunakan: if ($password === $user['password'])
            if ($password === $user['password']) {
                
                // Set Session
                $_SESSION['id_user']  = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama']     = $user['nama_lengkap'];
                $_SESSION['role']     = strtolower($user['role']); // Simpan dalam huruf kecil

                // Jalankan fungsi redirect
                $this->redirectByRole($_SESSION['role']);
                
            } else {
                header('Location: ' . BASEURL . '/auth?error=wrong_password');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/auth?error=not_found');
            exit;
        }
    }

    /**
     * Fungsi Helper untuk mengatur tujuan redirect berdasarkan role
     */
    private function redirectByRole($role) {
        if ($role === 'admin' || $role === 'owner') {
            header('Location: ' . BASEURL . '/admin');
        } else {
            header('Location: ' . BASEURL . '/petugas');
        }
        exit;
    }

    public function logout() {
        $_SESSION = [];
        session_unset();
        session_destroy();
        header('Location: ' . BASEURL . '/auth');
        exit;
    }
}