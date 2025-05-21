<?php

require_once __DIR__ . "includes/init.php";

if (!validate_csrf_token($_POST['csrf_token']) ?? '') {
    $_SESSION['error'] = "Permintaan tidak valid (CSRF Detected)";
    header("Location: edit-siswa.php");
    exit();
}

// Ambil data dari form
$id_siswa     = $_POST['id_siswa'];
$nisn         = trim($_POST['nisn']);
$nama_lengkap = trim($_POST['nama_lengkap']);
$alamat       = trim($_POST['alamat']);

// Simpan nilai lama ke session jika validasi gagal
$_SESSION['old'] = [
    'nisn' => $nisn,
    'nama_lengkap' => $nama_lengkap,
    'alamat' => $alamat
];

// Validasi kosong
if (empty($nisn) || empty($nama_lengkap) || empty($alamat)) {
    $_SESSION['error'] = "Semua field wajib diisi.";
    header("Location: edit-siswa.php?id=$id_siswa");
    exit();
}

// Validasi NISN
$errors = [];

if (empty($nisn)) {
    $errors[] = "NISN wajib diisi.";
} elseif (!ctype_digit($nisn)) {
    $errors[] = "NISN harus berupa angka.";
} elseif (strlen($nisn) !== 10) {
    $errors[] = "NISN harus tepat 10 digit.";
} elseif ((int)$nisn > 9999999999) {
    $errors[] = "NISN tidak boleh lebih dari 9999999999.";
}

// Validasi nama
if (empty($nama_lengkap)) {
    $errors[] = "Nama lengkap wajib diisi.";
} elseif (!preg_match("/^[a-zA-Z\s]+$/", $nama_lengkap)) {
    $errors[] = "Nama hanya boleh huruf dan spasi.";
}

if (empty($alamat)) {
    $errors[] = "Alamat wajib diisi.";
} elseif (strlen($alamat) < 5) {
    $errors[] = "Alamat terlalu pendek (minimal 5 karakter).";
}

// Jika ada error, kembalikan ke form
if (!empty($errors)) {
    $_SESSION['error'] = implode("<br>", $errors);
    header("Location: edit-siswa.php?id=$id_siswa");
    exit();
}

// Query update
// Prepare statement
$sql = "UPDATE tbl_siswa SET nisn = ?, nama_lengkap = ?, alamat = ? WHERE id_siswa = ?";
$stmt = $connection->prepare($sql);

// Cek apakah prepare berhasil
if (!$stmt) {
    $_SESSION['error'] = "Terjadi kesalahan pada query: " . $connection->error;
    header("Location: edit-siswa.php?id=$id_siswa");
    exit();
}

// Lanjut jika prepare berhasil
$stmt->bind_param("sssi", $nisn, $nama_lengkap, $alamat, $id_siswa);

// Jalankan dan cek hasil
if ($stmt->execute()) {
    unset($_SESSION['csrf_token']);
    $_SESSION['success'] = "Data berhasil diperbarui!";
    header("Location: index.php");
    exit();
} else {
    $_SESSION['error'] = "Gagal memperbarui data.";
    header("Location: edit-siswa.php?id=$id_siswa");
    exit();
}
?>
