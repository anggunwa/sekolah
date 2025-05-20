<?php 

function redirect($url) {
    header("Location: $url");
    exit;
}

function set_flash($key, $message) {
    $_SESSION[$key] = $message;
} 

function get_flash($key) {
    if (isset($_SESSION [$key])) {
        $msg = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $msg;
    }
    return null;
}

?>