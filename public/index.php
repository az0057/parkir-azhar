<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Memulai sesi untuk login
if( !session_id() ) session_start();

// Memanggil file inisialisasi sistem
require_once '../app/init.php';

// Menjalankan class App (Routing)
$app = new App;