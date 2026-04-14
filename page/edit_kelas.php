<?php
// ambil kode dari URL
if (!isset($_GET['kd'])) {
    echo "<div class='alert alert-danger'>Kode tidak ditemukan</div>";
    exit;
}

$kd = mysqli_real_escape_string($koneksi, $_GET['kd']);

// ambil data dari database
$query = mysqli_query($koneksi, "SELECT * FROM kelas WHERE kd_kelas='$kd'");

if (mysqli_num_rows($query) == 0) {
    echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
    exit;
}

$data = mysqli_fetch_assoc($query);

// ================= UPDATE =================
if (isset($_POST['update'])) {

    $nama = mysqli_real_escape_string($koneksi, $_POST['nm_kelas']);
    $kkm  = mysqli_real_escape_string($koneksi, $_POST['kkm']);

    $update = mysqli_query($koneksi, "
        UPDATE kelas SET
        nm_kelas='$nama',
        kkm='$kkm'
        WHERE kd_kelas='$kd'
    ");

    if ($update) {
        echo "<script>
            alert('Data berhasil diupdate');
            window.location='index.php?page=kelas';
        </script>";
    } else {
        echo "<div class='alert alert-danger'>
            Gagal: " . mysqli_error($koneksi) . "
        </div>";
    }
}
?>

<div class="content-header">
  <div class="container-fluid">
    <h1>Edit Kelas</h1>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-body">

      <form method="POST">

        <div class="form-group">
          <label>Kode Kelas</label>
          <input type="text" 
                 value="<?= $data['kd_kelas']; ?>" 
                 class="form-control" readonly>
        </div>

        <div class="form-group">
          <label>Nama Kelas</label>
          <input type="text" name="nm_kelas"
                 value="<?= $data['nm_kelas']; ?>"
                 class="form-control" required>
        </div>

        <div class="form-group">
          <label>KKM</label>
          <input type="number" name="kkm"
                 value="<?= $data['kkm']; ?>"
                 class="form-control" required>
        </div>

        <button type="submit" name="update" class="btn btn-success">
          Update
        </button>

        <a href="index.php?page=kelas" class="btn btn-secondary">
          Kembali
        </a>

      </form>

    </div>
  </div>
</div>