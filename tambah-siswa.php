<?php
session_start(); // HARUS di paling atas sebelum HTML

// Token CSRF
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Ambil data lama jika ada
$old = $_SESSION['old'] ?? [
    'nisn' => '',
    'nama_lengkap' => '',
    'alamat' => ''
];
unset($_SESSION['old']);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Tambah Siswa</title>
  </head>

  <body>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              TAMBAH SISWA
            </div>
            <div class="card-body">

              <!-- Notifikasi -->
              <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                  <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
              <?php endif; ?>

              <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                  <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
              <?php endif; ?>

              <form action="simpan-siswa.php" method="POST">
                <div class="form-group">
                  <label>NISN</label>
                  <input 
                    type="text" 
                    name="nisn" 
                    placeholder="Masukkan NISN Siswa" 
                    class="form-control"
                    maxlength="10" 
                    pattern="\d*" 
                    inputmode="numeric"
                    value="<?= htmlspecialchars($old['nisn'] ?? '') ?>">
                </div>

                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input 
                    type="text" 
                    name="nama_lengkap" 
                    placeholder="Masukkan Nama Siswa" 
                    class="form-control"
                    maxlength="50"
                    pattern="[A-Za-z\s]+"
                    title="Nama hanya boleh berisi huruf dan spasi"
                    value="<?= htmlspecialchars($old['nama_lengkap'] ?? '') ?>">
                </div>

                <div class="form-group">
                  <label>Alamat</label>
                  <textarea 
                    class="form-control" 
                    name="alamat" 
                    placeholder="Masukkan Alamat Siswa" 
                    rows="4"
                    maxlength="255"><?= htmlspecialchars($old['alamat'] ?? '') ?></textarea>
                </div>

                <!-- di dalam form -->
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']?>">
                <button type="submit" class="btn btn-success">SIMPAN</button>
                <button type="reset" class="btn btn-warning">RESET</button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>