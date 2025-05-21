<?php

require_once __DIR__ . "/includes/init.php";

// Redirect jika belum login
if (!is_logged_in()) {
    $_SESSION['error'] = "Anda harus login terlebih dahulu!";
    header('Location: /sekolah/login.php');
    exit;
}

// Tampilkan halaman utama
require_once __DIR__ . "/views/index.php";
