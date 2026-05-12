<?php

if (isset($_GET['action']) && $_GET['action'] == "hapus") {

    if (!isset($_GET['kd']) || $_GET['kd'] == "") {
        die("ID tidak ditemukan");
    }

    $kd = $_GET['kd'];

    $hapus = mysqli_query(
        $koneksi,
        "DELETE FROM ekstra_2511500063 WHERE id_ekstra='$kd'"
    );

    if (!$hapus) {
        die("QUERY ERROR: " . mysqli_error($koneksi));
    }

    echo "<script>
            alert('Data berhasil dihapus');
            window.location='index.php?page=ekstra_2511500063';
          </script>";
}
?>


<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Data Ekstrakurikuler</h1>
    </div>
</div>



<section class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">

                <a href="index.php?page=tambah_ekstra2511500063"
                   class="btn btn-primary btn-sm">
                    Tambah Ekstrakurikuler
                </a>

                <br><br>

                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php
                    $no = 1;

                    $query = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500063");

                    while ($row = mysqli_fetch_array($query)) {
                    ?>

                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['id_ekstra']; ?></td>
                            <td><?= $row['nama_ekstra']; ?></td>
                            <td><?= $row['ket']; ?></td>
                            <td><?= $row['semester']; ?></td>
                            <td><?= $row['thn_ajaran']; ?></td>

                            <td>

                               
                                <a href="index.php?page=ekstra_2511500063&action=hapus&kd=<?= $row['id_ekstra']; ?>"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')"
                                   class="btn btn-danger btn-sm">
                                    Hapus
                                </a>

                                
                                <a href="index.php?page=edit_ekstra2511500063&kd=<?= $row['id_ekstra']; ?>"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                            </td>
                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>
        </div>

    </div>
</section>