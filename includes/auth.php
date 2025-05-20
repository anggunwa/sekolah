<?php

    function is_logged_in() {
        return isset($_SESSION['is_login']) && $_SESSION['is_login'] === true;
    }

    function require_login() {
        if (!is_logged_in()) {
            set_flash('error', 'Silahkan login terlebih dahulu.');
            redirect('login.php');
        }
    }
?>