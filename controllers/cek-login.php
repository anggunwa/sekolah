<?php

require_once __DIR__ . "/../includes/init.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Cek user berdasarkan username

/* $stmt = mysqli_prepare($connection, "SELECT * FROM tbl_admin WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$query = mysqli_stmt_get_result( $stmt );
$user = mysqli_fetch_assoc($query);

if ($user && password_verify($password, $user['password'])) {
    // Jika berhasil login
    $_SESSION['is_login'] = true;
    $_SESSION['username'] = $user['username'];
    header("Location: /sekolah/index.php"); // arahkan ke halaman utama
    exit; 
} else {
    // Jika gagal login
    $_SESSION['old_username'] = $_POST['username'];
    $_SESSION['error'] = 'Username atau password salah!';
    header("Location: /sekolah/login.php");
    exit;
} 
*/

var_dump($user);
var_dump($password);
if ($user) {
    var_dump($user['password']);
    var_dump(password_verify($password, $user['password']));
}
exit;

if ($user) {
    $_SESSION['is_login'] = true;
    $_SESSION['username'] = $user['username'];

    header("Location: /sekolah/index.php");
    exit;
}

?>