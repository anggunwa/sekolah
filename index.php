<?php

session_start();

// Redirect jika belum login
if (empty($_SESSION["is_login"])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Selama datang, <?= $_SESSION['username']?></h2>
    <a href="logout.php">Logout</a>
</body>
</html>