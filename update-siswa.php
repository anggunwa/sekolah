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
if (empty($nisn) || empty($nama_lengkap) || empty($alamat)) {
    $_SESSION['error'] = "Semua field wajib diisi.";
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
