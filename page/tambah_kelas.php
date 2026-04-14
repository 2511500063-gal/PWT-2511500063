<?php
// ================= AUTO KODE =================
$cari_kode = mysqli_query($koneksi, "SELECT MAX(kd_kelas) as maxkode FROM kelas");
$data = mysqli_fetch_assoc($cari_kode);

if ($data['maxkode']) {
    $no = (int) substr($data['maxkode'], 2);
    $no++;
    $kd_kelas = "M-" . str_pad($no, 3, "0", STR_PAD_LEFT);
} else {
    $kd_kelas = "M-001";
}

// ================= PROSES SIMPAN =================
if (isset($_POST['simpan'])) {

    $kode = mysqli_real_escape_string($koneksi, $_POST['kd_kelas']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nm_kelas']);
    $kkm  = mysqli_real_escape_string($koneksi, $_POST['kkm']);

    if ($nama == "" || $kkm == "") {
        echo "<div class='alert alert-warning'>Data tidak boleh kosong</div>";
    } else {

        $insert = mysqli_query($koneksi,
            "INSERT INTO kelas (kd_kelas, nm_kelas, kkm)
             VALUES ('$kode','$nama','$kkm')"
        );

        if ($insert) {
            echo "<script>
                alert('Data berhasil ditambahkan');
                window.location='index.php?page=kelas';
            </script>";
        } else {
            echo "<div class='alert alert-danger'>
                Gagal: " . mysqli_error($koneksi) . "
            </div>";
        }
    }
}
?>

<div class="content-header">
  <div class="container-fluid">
    <h1 class="m-0 text-dark">Tambah Kelas</h1>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-body">

      <form method="POST">

        <div class="form-group">
          <label>Kode Kelas</label>
          <input type="text" name="kd_kelas" 
                 value="<?= $kd_kelas; ?>" 
                 class="form-control" readonly>
        </div>

        <div class="form-group">
          <label>Nama Kelas</label>
          <input type="text" name="nm_kelas" 
                 class="form-control" required>
        </div>

        <div class="form-group">
          <label>KKM</label>
          <input type="number" name="kkm" 
                 class="form-control" required>
        </div>

        <button type="submit" name="simpan" class="btn btn-success">
          Simpan
        </button>

        <a href="index.php?page=kelas" class="btn btn-secondary">
          Kembali
        </a>

      </form>

    </div>
  </div>
</div>