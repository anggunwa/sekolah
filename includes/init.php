<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('APP_NAME', 'Aplikasi Sekolah Negeri Hogwarts');

// koneksi ke database
require_once __DIR__ ."/../config/database.php";

require_once __DIR__ . "/helpers.php";

require_once __DIR__ . "/auth.php";

require_once __DIR__ . "/csrf.php";

