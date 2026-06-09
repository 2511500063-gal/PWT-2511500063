<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php
$carikode = mysqli_query($koneksi, "SELECT MAX(kd_jadwal) FROM jadwal")
             or die(mysqli_error($koneksi));

$datakode = mysqli_fetch_array($carikode);

if ($datakode && $datakode[0] != null) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int)$nilaikode;
    $kode++;
    $hasilkode = "J-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "J-001";
}

$_SESSION["KODE"] = $hasilkode;

if (isset($_POST['tambah'])) {

    $kd_jadwal    = $_POST['kd_jadwal'];
    $kd_guru      = $_POST['kd_guru'];
    $semester     = $_POST['semester'];
    $tahun_ajaran = $_POST['tahun_ajaran'];

    $kd_mapel = $_POST['kd_mapel'];
    $hari     = $_POST['hari'];
    $jam      = $_POST['jam'];
    $kelas    = $_POST['kelas'];

    // Simpan ke tabel jadwal
    $insertjadwal = mysqli_query(
        $koneksi,
        "INSERT INTO jadwal VALUES(
            '$kd_jadwal',
            '$kd_guru',
            '$semester',
            '$tahun_ajaran'
        )"
    );

    if (!$insertjadwal) {
        die("Gagal insert jadwal : " . mysqli_error($koneksi));
    }

    // Simpan detail jadwal
    $allSuccess = true;

    for ($i = 0; $i < count($kd_mapel); $i++) {

        $insert = mysqli_query(
            $koneksi,
            "INSERT INTO detailjadwal
            (kd_jadwal, kd_mapel, Hari, Jam, Kelas)
            VALUES
            (
                '$kd_jadwal',
                '{$kd_mapel[$i]}',
                '{$hari[$i]}',
                '{$jam[$i]}',
                '{$kelas[$i]}'
            )"
        );

        if (!$insert) {
            $allSuccess = false;
            echo "Gagal insert detail ke-" . ($i + 1) . " : "
                 . mysqli_error($koneksi) . "<br>";
        }
    }

    if ($allSuccess) {
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button>
            <h5><i class="icon fas fa-check"></i> Info</h5>
            Data berhasil disimpan.
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal">';
    } else {
        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button>
            <h5><i class="icon fas fa-times"></i> Info</h5>
            Gagal menyimpan sebagian data.
        </div>';
    }

} // PENUTUP if(isset($_POST["tambah"]))
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <h3>Tambah Jadwal</h3>

                <form method="POST">

                    <div class="form-group">
                        <label>Kode Jadwal</label>
                        <input type="text"
                               name="kd_jadwal"
                               value="<?php echo $hasilkode; ?>"
                               class="form-control"
                               readonly>
                    </div>

                    <div class="form-group">
                        <label>Guru</label>
                        <select name="kd_guru" class="form-control" required>
                            <option value="">-- Pilih Guru --</option>

                            <?php
                            $guru = mysqli_query($koneksi, "SELECT * FROM guru");

                            while ($g = mysqli_fetch_assoc($guru)) {
                                echo "<option value='".$g['kd_guru']."'>".$g['nm_guru']."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control" required>
                            <option value="">-- Pilih Semester --</option>
                            <option>Ganjil</option>
                            <option>Genap</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select name="tahun_ajaran" class="form-control" required>
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            <option>2024-2025</option>
                            <option>2025-2026</option>
                        </select>
                    </div>

                    <hr>
                    <h5>Detail Jadwal</h5>

                    <div id="detail-jadwal">

                        <div class="row mb-2 detail-row">

                            <div class="col-md-3">
                                <select name="kd_mapel[]" class="form-control" required>
                                    <option value="">-- Pilih Mapel --</option>

                                    <?php
                                    $mapel = mysqli_query($koneksi, "SELECT * FROM mapel");

                                    while ($m = mysqli_fetch_assoc($mapel)) {
                                        echo "<option value='".$m['kd_mapel']."'>".$m['nm_mapel']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="hari[]" class="form-control" required>
                                    <option value="">-- Pilih Hari --</option>
                                    <option>Senin</option>
                                    <option>Selasa</option>
                                    <option>Rabu</option>
                                    <option>Kamis</option>
                                    <option>Jumat</option>
                                    <option>Sabtu</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="jam[]" class="form-control" required>
                                    <option value="">-- Pilih Jam --</option>
                                    <option>08.00-10.00</option>
                                    <option>08.00-09.30</option>
                                    <option>10.30-12.00</option>
                                    <option>12.30-14.00</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <input type="text"
                                       name="kelas[]"
                                       class="form-control"
                                       placeholder="Kelas"
                                       required>
                            </div>

                        </div>

                    </div>

                    <button type="button"
                            class="btn btn-info"
                            onclick="tambahBaris()">
                        + Tambah Mapel
                    </button>

                    <br><br>

                    <input type="submit"
                           name="tambah"
                           value="Simpan"
                           class="btn btn-primary">

                </form>

            </div>
        </div>
    </div>
</div>

<script>
function tambahBaris() {

    let container = document.getElementById('detail-jadwal');

    let row = document.querySelector('.detail-row').cloneNode(true);

    row.querySelectorAll('input').forEach(function(input){
        input.value = '';
    });

    row.querySelectorAll('select').forEach(function(select){
        select.selectedIndex = 0;
    });

    container.appendChild(row);
}
</script>