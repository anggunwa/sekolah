<?php 

  require_once __DIR__ . "/../includes/init.php";
  
  if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID siswa tidak valid.");
  }

  $id = $_GET['id'];
  $query = "SELECT * FROM tbl_siswa WHERE id_siswa = ?";
  $stmt = $connection->prepare($query);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  
  if (!$row) {
      die("Data siswa tidak ditemukan.");
  }

    // Ambil data lama dari session jika validasi gagal
  $old = $_SESSION['old'] ?? null;
  unset($_SESSION['old']);

  // Ambil pesan error kalau ada
  $error = $_SESSION['error'] ?? null;
  unset($_SESSION['error']);  

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Edit Siswa</title>
  </head>

  <body>

    <div class="container" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              EDIT SISWA
            </div>
            <div class="card-body">

              <?php if ($error): ?>
                <div class="alert alert-danger">
                  <?= htmlspecialchars($error) ?>
                </div>
              <?php endif; ?>

              <form action="/sekolah/controllers/update-siswa.php" method="POST">
                <!-- di dalam form -->
                <input type="hidden" name="id_siswa" value="<?= $row['id_siswa'] ?>">

                <div class="form-group">
                  <label>NISN</label>
                  <input type="text" name="nisn" maxlength="10" pattern="\d{1,10}" value="<?= htmlspecialchars($old['nisn'] ?? $row['nisn']) ?>" placeholder="Masukkan NISN Siswa" title="Maksimal 10 angka" class="form-control" required>
                  <input type="hidden" name="id_siswa" value="<?php echo $row['id_siswa'] ?>">
                </div>

                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($old['nama_lengkap'] ?? $row['nama_lengkap']) ?>" placeholder="Masukkan Nama Siswa" pattern="[a-zA-Z\s]+" title="Hanya huruf dan spasi" class="form-control" required>
                </div>

                <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat Siswa" rows="4" required><?= htmlspecialchars($old['alamat'] ?? $row['alamat']) ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-success">UPDATE</button>
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