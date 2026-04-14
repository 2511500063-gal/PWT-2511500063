<?php
// AUTO KODE
$cari_kode = mysqli_query($koneksi, "SELECT MAX(kd_guru) as maxkode FROM guru");
$data = mysqli_fetch_assoc($cari_kode);

if ($data['maxkode']) {
    $no = (int) substr($data['maxkode'], 1);
    $no++;
    $kd_guru = "G" . str_pad($no, 4, "0", STR_PAD_LEFT);
} else {
    $kd_guru = "G0001";
}

// SIMPAN
if (isset($_POST['simpan'])) {

    $nama  = mysqli_real_escape_string($koneksi, $_POST['nm_guru']);
    $jk    = mysqli_real_escape_string($koneksi, $_POST['jenkel']);
    $pend  = mysqli_real_escape_string($koneksi, $_POST['pend_terakhir']);
    $hp    = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $alamat= mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $insert = mysqli_query($koneksi,
        "INSERT INTO guru (kd_guru, nm_guru, jenkel, pend_terakhir, hp, alamat)
         VALUES ('$kd_guru','$nama','$jk','$pend','$hp','$alamat')"
    );

    if ($insert) {
        echo "<script>
            alert('Data berhasil ditambahkan');
            window.location='index.php?page=guru';
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!-- HEADER -->
<div class="content-header">
  <div class="container-fluid">
    <h1 class="m-0 text-dark">Tambah Guru</h1>
  </div>
</div>

<!-- CONTENT -->
<div class="container-fluid">
  <div class="card">
    <div class="card-body">

      <form method="POST">

        <div class="form-group">
          <label>Kode Guru</label>
          <input type="text" value="<?= $kd_guru; ?>" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label>Nama Guru</label>
          <input type="text" name="nm_guru" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Jenis Kelamin</label>
          <select name="jenkel" class="form-control">
            <option>Laki-laki</option>
            <option>Perempuan</option>
          </select>
        </div>

        <div class="form-group">
          <label>Pendidikan Terakhir</label>
          <input type="text" name="pend_terakhir" class="form-control">
        </div>

        <div class="form-group">
          <label>No HP</label>
          <input type="text" name="hp" class="form-control">
        </div>

        <div class="form-group">
          <label>Alamat</label>
          <textarea name="alamat" class="form-control"></textarea>
        </div>

        <button type="submit" name="simpan" class="btn btn-success">
          Simpan
        </button>

        <a href="index.php?page=guru" class="btn btn-secondary">
          Kembali
        </a>

      </form>

    </div>
  </div>
</div>