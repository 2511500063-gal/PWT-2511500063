<?php
// ================= DELETE DATA =================
if (isset($_GET['action']) && $_GET['action'] == "hapus") {

  if (isset($_GET['kd']) && $_GET['kd'] != "") {

    $kd = mysqli_real_escape_string($koneksi, $_GET['kd']);

    $hapus = mysqli_query($koneksi,
      "DELETE FROM kelas WHERE kd_kelas = '$kd'"
    );

    if ($hapus) {
      echo "<script>
        alert('Data berhasil dihapus');
        window.location='index.php?page=kelas';
      </script>";
    } else {
      echo "<div class='alert alert-danger'>
        Gagal hapus: " . mysqli_error($koneksi) . "
      </div>";
    }
  }
}
?>

<div class="content-header">
  <div class="container-fluid">
    <h1 class="m-0 text-dark">Data Kelas</h1>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-body">

      <!-- Tombol tambah -->
      <a href="index.php?page=tambah_kelas" 
         class="btn btn-primary btn-sm mb-3">
        Tambah Kelas
      </a>

      <!-- Tabel -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Kd Kelas</th>
            <th>Nama Kelas</th>
            <th>KKM</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM kelas");

        if (!$query) {
          die("Query error: " . mysqli_error($koneksi));
        }

        while ($result = mysqli_fetch_assoc($query)) {
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $result['kd_kelas']; ?></td>
            <td><?= $result['nm_kelas']; ?></td>
            <td><?= $result['kkm']; ?></td>
            <td>

              <a href="index.php?page=edit_kelas&kd=<?= $result['kd_kelas']; ?>" 
                 class="btn btn-warning btn-sm">
                Edit
              </a>

              <a href="index.php?page=kelas&action=hapus&kd=<?= $result['kd_kelas']; ?>" 
                 class="btn btn-danger btn-sm"
                 onclick="return confirm('Yakin ingin menghapus?')">
                Hapus
              </a>

            </td>
          </tr>
        <?php } ?>
        </tbody>

      </table>

    </div>
  </div>
</div>