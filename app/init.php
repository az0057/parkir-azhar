<?php

if ( !session_id() ) {
    session_start();
}

// Memanggil file-file utama (Core)
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';

// Konfigurasi Dasar
define('BASEURL', 'http://localhost/parkirkeun_v2/public');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'parkirkeun');