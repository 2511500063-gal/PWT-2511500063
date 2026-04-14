<?php
if (!isset($_GET['kd'])) {
    echo "<div class='alert alert-danger'>Kode tidak ditemukan</div>";
    exit;
}

$kd = mysqli_real_escape_string($koneksi, $_GET['kd']);

$query = mysqli_query($koneksi, "SELECT * FROM guru WHERE kd_guru='$kd'");

if (mysqli_num_rows($query) == 0) {
    echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
    exit;
}

$data = mysqli_fetch_assoc($query);

// ================= UPDATE =================
if (isset($_POST['update'])) {

    $nama   = mysqli_real_escape_string($koneksi, $_POST['nm_guru']);
    $jk     = mysqli_real_escape_string($koneksi, $_POST['jenkel']);
    $pend   = mysqli_real_escape_string($koneksi, $_POST['pend_terakhir']);
    $hp     = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $update = mysqli_query($koneksi, "
        UPDATE guru SET
        nm_guru='$nama',
        jenkel='$jk',
        pend_terakhir='$pend',
        hp='$hp',
        alamat='$alamat'
        WHERE kd_guru='$kd'
    ");

    if ($update) {
        echo "<script>
            alert('Data berhasil diupdate');
            window.location='index.php?page=guru';
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
    <h1>Edit Guru</h1>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-body">

      <form method="POST">

        <div class="form-group">
          <label>Kode Guru</label>
          <input type="text" value="<?= $data['kd_guru']; ?>" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label>Nama Guru</label>
          <input type="text" name="nm_guru"
                 value="<?= $data['nm_guru']; ?>"
                 class="form-control" required>
        </div>

        <div class="form-group">
          <label>Jenis Kelamin</label>
          <select name="jenkel" class="form-control">
            <option <?= ($data['jenkel']=='Laki-laki')?'selected':''; ?>>Laki-laki</option>
            <option <?= ($data['jenkel']=='Perempuan')?'selected':''; ?>>Perempuan</option>
          </select>
        </div>

        <div class="form-group">
          <label>Pendidikan Terakhir</label>
          <input type="text" name="pend_terakhir"
                 value="<?= $data['pend_terakhir']; ?>"
                 class="form-control">
        </div>

        <div class="form-group">
          <label>No HP</label>
          <input type="text" name="hp"
                 value="<?= $data['hp']; ?>"
                 class="form-control">
        </div>

        <div class="form-group">
          <label>Alamat</label>
          <textarea name="alamat" class="form-control"><?= $data['alamat']; ?></textarea>
        </div>

        <button type="submit" name="update" class="btn btn-success">
          Update
        </button>

        <a href="index.php?page=guru" class="btn btn-secondary">
          Kembali
        </a>

      </form>

    </div>
  </div>
</div>