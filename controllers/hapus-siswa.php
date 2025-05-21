<?php

require_once __DIR__ . "includes/init.php";

if (!validate_csrf_token($_POST['csrf_token']) ?? '') {
    $_SESSION['error'] = "Permintaan tidak valid (CSRF token gagal)";
    header("Location: index.php");
    exit();
}

$id_siswa = $_POST['id_siswa'] ?? null;

$query = "DELETE FROM tbl_siswa WHERE id_siswa = ?";

if ($id_siswa) {
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $id_siswa);
    if($stmt->execute()) {
        $_SESSION['success'] = "Data berhasil dihapus.";
    } else {
        $_SESSION['error'] = "Gagal menghapus data"; 
    }
    $stmt->close();
}

header("Location: index.php");

?>