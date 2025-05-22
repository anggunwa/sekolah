<?php 

  require_once __DIR__ . "/../includes/init.php";
  require_login(); // proteksi halaman  
?>

<?php if (isset($_SESSION['success'])): ?>
  <div class="alert alert-success">
    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
  </div>
<?php endif; ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Data Siswa - Aplikasi Sekolah Negeri Hogwarts</title>
  </head>

  <body>

    <div class="container mt-5" style="margin-top: 80px">
      <div class="row">
        <div class="col-md-12">

          <!-- Notifikasi -->
          <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success alert-dismissable fade show" role="alert">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php endif; ?>

          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <div>
                <strong>DATA SISWA - SEKOLAH NEGERI HOGWARTS</strong>
              </div>
              <div class="d-flex aligh-items-center">
                <span class="mr-3 text-muted">
                👤 <?= $_SESSION['username'] ?? 'Pengguna' ?>
                </span>
              <a href="/sekolah/logout.php" class="btn btn-outline-danger btn-sm justify-content-end">Logout</a>
              </div>
            </div>
            <div class="card-body">
              <a href="tambah-siswa.php" class="btn btn-md btn-success" style="margin-bottom: 10px">TAMBAH DATA</a>
              <table class="table table-bordered" id="myTable">
                <thead>
                  <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">NISN</th>
                    <th scope="col">NAMA LENGKAP</th>
                    <th scope="col">ALAMAT</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>    
                <tbody>
                  <?php
                      $no = 1;
                      $query = mysqli_query($connection,"SELECT * FROM tbl_siswa");
                      while($row = mysqli_fetch_array($query)):
                  ?>

                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $row['nisn'] ?></td>
                      <td><?php echo $row['nama_lengkap'] ?></td>
                      <td><?php echo $row['alamat'] ?></td>
                      <td class="text-center">
                        <!-- tombol edit & hapus -->
                        <form action="/sekolah/views/edit-siswa.php" method="GET" style="display :inline">
                          <input type="hidden" name="id" value="<?= $row['id_siswa']?>">
                          <button type="submit" class="btn btn-sm btn-primary">EDIT</button>
                        </form>
                        <form action="hapus-siswa.php" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                          <input type="hidden" name="id_siswa" value="<?= $row['id_siswa'] ?>">
                          <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                        </form>
                      </td>
                  </tr>

                <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
      } );
    </script>
  </body>
</html>