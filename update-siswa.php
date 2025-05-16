<?php
session_start();
include('koneksi.php');

// Ambil data dari form
$id_siswa     = $_POST['id_siswa'];
$nisn         = $_POST['nisn'];
$nama_lengkap = $_POST['nama_lengkap'];
$alamat       = $_POST['alamat'];

// Simpan nilai lama ke session jika validasi gagal
$_SESSION['old'] = [
    'nisn' => $nisn,
    'nama_lengkap' => $nama_lengkap,
    'alamat' => $alamat
];

// Validasi
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
$query = "UPDATE tbl_siswa 
          SET nisn = '$nisn', nama_lengkap = '$nama_lengkap', alamat = '$alamat' 
          WHERE id_siswa = '$id_siswa'";

// Jalankan dan cek hasil
if ($connection->query($query)) {
    unset($_SESSION['old']);
    $_SESSION['success'] = "Data berhasil diperbarui!";
    header("Location: index.php");
} else {
    $_SESSION['error'] = "Gagal memperbarui data.";
    header("Location: edit-siswa.php?id=$id_siswa");
}
?>
