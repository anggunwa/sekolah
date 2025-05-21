<?php

    session_start();
    
    require_once __DIR__ . "/includes/init.php";
    
    logout();
    header("Location: login.php"); // arahkan ke halaman login
    exit;
?>