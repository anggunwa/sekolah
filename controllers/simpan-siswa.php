<?php
    
    require_once __DIR__ . "/../includes/init.php";

    // Ambil data dari form
    $nisn = trim($_POST['nisn']);
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $alamat = trim($_POST['alamat']);

    // Simpan input lama ke session jika validasi gagal
    $_SESSION['old'] = [
        'nisn' => $nisn,
        'nama_lengkap' => $nama_lengkap,
        'alamat' => $alamat
    ];

    // Validasi input kosong
    if (empty($nisn) || empty($nama_lengkap) || empty($alamat)) {
        $_SESSION['error'] = "Semua field wajib diisi.";
        header("Location: /sekolah/views/tambah-siswa.php");
        exit();
    }

    // Validasi NISN: hanya angka, maksimal 10 digit
    if (!preg_match('/^[0-9]{1,10}$/', $nisn)) {
        $_SESSION['error'] = "NISN harus berupa angka dan maksimal 10 digit.";
        header("Location: /sekolah/views/tambah-siswa.php");
        exit();
    }

    // Validasi Nama: hanya huruf dan spasi
    if (!preg_match('/^[a-zA-Z\s]+$/', $nama_lengkap)) {
        $_SESSION['error'] = "Nama hanya boleh berisi huruf dan spasi.";
        header("Location: /sekolah/views/tambah-siswa.php");
        exit();
    }

    // Simpan ke DB
    // Prepare query dengan prepared statement
    $stmt = $connection->prepare("INSERT INTO tbl_siswa (nisn, nama_lengkap, alamat) VALUES (?, ?, ?)");

    // Bind parameter dan eksekusi
    $stmt->bind_param("sss", $nisn, $nama_lengkap, $alamat);

    // Eksekusi
    if ($stmt->execute()) {
        unset($_SESSION["csrf_token"]); // Hanya hapus token jika data berhasil disimpan
        $_SESSION['success'] = "Data berhasil disimpan!";
        unset($_SESSION['old']); // bersihkan form lama 
        header("Location: /sekolah/views/index.php"); // redirect ke index
        exit();
    } else {
        $_SESSION['error'] = "Data gagal disimpan!";
        header("Location: /sekolah/views/tambah-siswa.php");
        exit();
    }
?>
