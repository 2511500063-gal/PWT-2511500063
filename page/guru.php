<?php
// ================= DELETE DATA =================
if (isset($_GET['action']) && $_GET['action'] == "hapus") {

    $kd = mysqli_real_escape_string($koneksi, $_GET['kd']);

    $hapus = mysqli_query($koneksi,
        "DELETE FROM guru WHERE kd_guru = '$kd'"
    );

    if ($hapus) {
        echo "<script>
            alert('Data berhasil dihapus');
            window.location='index.php?page=guru';
        </script>";
    } else {
        echo "<div class='alert alert-danger'>
            Gagal hapus: " . mysqli_error($koneksi) . "
        </div>";
    }
}
?>

<!-- HEADER -->
<div class="content-header">
  <div class="container-fluid">
    <h1 class="m-0 text-dark">Data Guru</h1>
  </div>
</div>

<!-- CONTENT -->
<div class="container-fluid">
  <div class="card">
    <div class="card-body">

      <!-- BUTTON TAMBAH -->
      <a href="index.php?page=tambah_guru" class="btn btn-primary btn-sm mb-3">
        Tambah Guru
      </a>

      <!-- TABLE -->
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Guru</th>
            <th>Nama Guru</th>
            <th>Jenis Kelamin</th>
            <th>Pendidikan</th>
            <th>No HP</th>
            <th>Alamat</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM guru");

        if (!$query) {
            die("Query error: " . mysqli_error($koneksi));
        }

        while ($result = mysqli_fetch_assoc($query)) {
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $result['kd_guru']; ?></td>
            <td><?= $result['nm_guru']; ?></td>
            <td><?= $result['jenkel']; ?></td>
            <td><?= $result['pend_terakhir']; ?></td>
            <td><?= $result['hp']; ?></td>
            <td><?= $result['alamat']; ?></td>
            <td>

              <!-- EDIT -->
              <a href="index.php?page=edit_guru&kd=<?= $result['kd_guru']; ?>" 
                 class="btn btn-warning btn-sm">
                Edit
              </a>

              <!-- HAPUS -->
              <a href="index.php?page=guru&action=hapus&kd=<?= $result['kd_guru']; ?>" 
                 class="btn btn-danger btn-sm"
                 onclick="return confirm('Yakin ingin menghapus data ini?')">
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