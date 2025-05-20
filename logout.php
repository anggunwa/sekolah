<?php
    session_start();
    session_unset(); // menghapus semua data sesi
    session_destroy(); // menghancurkan sesi
    header("Location: login.php"); // arahkan ke halaman login
    exit;
?>