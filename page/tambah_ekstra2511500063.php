<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Tambah Ekstrakurikuler</h1>
    </div>
</div>

<?php

$carikode = mysqli_query(
    $koneksi,
    "SELECT MAX(id_ekstra) AS kode FROM ekstra_2511500063"
);

$datakode = mysqli_fetch_array($carikode);

if (!empty($datakode['kode'])) {

    $nilaikode = substr($datakode['kode'], 2);
    $kode = (int) $nilaikode;
    $kode++;
    $hasilkode = "E-" . str_pad($kode, 3, "0", STR_PAD_LEFT);

} else {
    $hasilkode = "E-001";
}


if (isset($_POST['tambah'])) {

    $id_ekstra   = $_POST['id_ekstra'];
    $nama_ekstra = $_POST['nama_ekstra'];
    $ket         = $_POST['ket'];
    $semester    = $_POST['semester'];
    $thn_ajaran  = $_POST['thn_ajaran'];

    $insert = mysqli_query(
        $koneksi,
        "INSERT INTO ekstra_2511500063
        (id_ekstra, nama_ekstra, ket, semester, thn_ajaran)
        VALUES
        ('$id_ekstra','$nama_ekstra','$ket','$semester','$thn_ajaran')"
    );

    if ($insert) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location='index.php?page=ekstra2511500063';
              </script>";
    } else {
        die("ERROR INSERT: " . mysqli_error($koneksi));
    }
}
?>

<section class="content">
    <div class="container-fluid">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Data</h3>
            </div>

            <form method="POST" action="">

                <div class="card-body">

                    <div class="form-group">
                        <label>ID Ekstrakurikuler</label>
                        <input type="text"
                               name="id_ekstra"
                               value="<?= $hasilkode; ?>"
                               class="form-control"
                               readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Ekstrakurikuler</label>
                        <input type="text"
                               name="nama_ekstra"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text"
                               name="ket"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <input type="text"
                               name="semester"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text"
                               name="thn_ajaran"
                               class="form-control"
                               required>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit"
                            name="tambah"
                            class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="index.php?page=ekstra2511500063"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>

    </div>
</section>