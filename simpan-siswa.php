<?php
    session_start();
    include("koneksi.php");

    // Ambil data
    $nisn = $_POST['nisn'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];

    // Simpan input lama
    $_SESSION['old'] = [
        'nisn' => $nisn,
        'nama_lengkap' => $nama_lengkap,
        'alamat' => $alamat
    ];

    // Validasi
    if (empty($nisn) || empty($nama_lengkap) || empty($alamat)) {
        $_SESSION['error'] = "Semua field wajib diisi.";
        header("Location: tambah-siswa.php");
        exit();
    }

    // Simpan ke DB
    $query = "INSERT INTO tbl_siswa(nisn, nama_lengkap, alamat) VALUES ('$nisn', '$nama_lengkap', '$alamat')";

    if ($connection->query($query)) {
        $_SESSION['success'] = "Data berhasil disimpan!";
        unset($_SESSION['old']); // bersihka form lama 
        header("Location: index.php"); // redirect ke index
    } else {
        $_SESSION['error'] = "Data gagal disimpan!";
        header("Location: tambah-siswa.php");
    }
    exit();
?>
