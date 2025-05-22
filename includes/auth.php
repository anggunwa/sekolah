<?php

/* if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
*/

// cek apakah user sudah login
function is_logged_in() {
    return isset($_SESSION['is_login']) && $_SESSION['is_login'] === true;
}

    // redirect ke login form jika belum login
    function require_login() {
        if (!is_logged_in()) {
            $_SESSION['error'] = 'Anda harus login terlebih dahulu!';
            header('Location: /sekolah/login.php');
            exit;
        }
        return true;
    }

    // logout user
    function logout() {
        session_unset();
        session_destroy();
        header('Location: /sekolah/login.php');
        exit;
    }

    
?>