<?php
$id = $_GET['kd'];


$data = mysqli_query(
    $koneksi,
    "SELECT * FROM ekstra_2511500063 WHERE id_ekstra='$id'"
);

$row = mysqli_fetch_array($data);

if (!$row) {
    die("Data tidak ditemukan di database");
}


if (isset($_POST['update'])) {

    $nama_ekstra = $_POST['nama_ekstra'];
    $ket         = $_POST['ket'];
    $semester    = $_POST['semester'];
    $thn_ajaran  = $_POST['thn_ajaran'];

    $update = mysqli_query(
        $koneksi,
        "UPDATE ekstra_2511500063 SET
            nama_ekstra = '$nama_ekstra',
            ket = '$ket',
            semester = '$semester',
            thn_ajaran = '$thn_ajaran'
         WHERE id_ekstra = '$id'"
    );

    if (!$update) {
        die("ERROR UPDATE: " . mysqli_error($koneksi));
    }

    echo "<script>
            alert('Data berhasil diupdate');
            window.location='index.php?page=ekstra2511500063';
          </script>";
}
?>


<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Edit Ekstrakurikuler</h1>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card card-warning">

            <div class="card-header">
                <h3 class="card-title">Form Edit Data</h3>
            </div>

            <form method="POST">

                <div class="card-body">

                    <div class="form-group">
                        <label>ID</label>
                        <input type="text"
                               value="<?= $row['id_ekstra']; ?>"
                               class="form-control"
                               readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Ekstrakurikuler</label>
                        <input type="text"
                               name="nama_ekstra"
                               value="<?= $row['nama_ekstra']; ?>"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text"
                               name="ket"
                               value="<?= $row['ket']; ?>"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <input type="text"
                               name="semester"
                               value="<?= $row['semester']; ?>"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <input type="text"
                               name="thn_ajaran"
                               value="<?= $row['thn_ajaran']; ?>"
                               class="form-control"
                               required>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit"
                            name="update"
                            class="btn btn-primary">
                        Update
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