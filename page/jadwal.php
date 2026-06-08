<?php
include __DIR__ . "/../config/koneksi.php";

if(isset($_POST['tambah'])){

    $id_kelas     = mysqli_real_escape_string($koneksi,$_POST['id_kelas']);
    $kd_guru      = mysqli_real_escape_string($koneksi,$_POST['kd_guru']);
    $semester     = mysqli_real_escape_string($koneksi,$_POST['semester']);
    $tahun_ajaran = mysqli_real_escape_string($koneksi,$_POST['tahun_ajaran']);

    // SIMPAN HEADER JADWAL
    $simpan = mysqli_query($koneksi,"
        INSERT INTO jadwal_kelas
        (
            Id_kelas,
            Thn_ajaran,
            Semester
        )
        VALUES
        (
            '$id_kelas',
            '$tahun_ajaran',
            '$semester'
        )
    ");

    if(!$simpan){
        die(mysqli_error($koneksi));
    }

    $id_jadwal = mysqli_insert_id($koneksi);

    // DETAIL JADWAL
    if(isset($_POST['kd_mapel'])){

        $kd_mapel = $_POST['kd_mapel'];
        $hari     = $_POST['hari'];
        $jam      = $_POST['jam'];

        for($i=0;$i<count($kd_mapel);$i++){

            $pecah = explode('|',$jam[$i]);

            $jam_mulai   = $pecah[0];
            $jam_selesai = $pecah[1];

            mysqli_query($koneksi,"
                INSERT INTO detail_jadwal
                (
                    Id_jadwal,
                    Kd_mapel,
                    Kd_guru,
                    Hari,
                    Jam_mulai,
                    Jam_selesai
                )
                VALUES
                (
                    '$id_jadwal',
                    '{$kd_mapel[$i]}',
                    '$kd_guru',
                    '{$hari[$i]}',
                    '$jam_mulai',
                    '$jam_selesai'
                )
            ") or die(mysqli_error($koneksi));
        }
    }

    echo "
    <script>
        alert('Data Jadwal Berhasil Disimpan');
        window.location='index.php?page=jadwal';
    </script>";
}
?>

<div class="content-header">
    <div class="container-fluid">
        <h1>Data Jadwal</h1>
    </div>
</div>

<section class="content">
<div class="container-fluid">

<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title">Tambah Jadwal</h3>
    </div>

    <form method="POST">

    <div class="card-body">

        <!-- KELAS -->
        <div class="form-group">
            <label>Kelas</label>
            <select name="id_kelas" class="form-control" required>

                <option value="">-- Pilih Kelas --</option>

                <?php
                $kelas = mysqli_query($koneksi,"
                    SELECT *
                    FROM kelas
                    ORDER BY Nm_kelas ASC
                ");

                while($k = mysqli_fetch_assoc($kelas)){
                ?>
                    <option value="<?= $k['Id_kelas']; ?>">
                        <?= $k['Nm_kelas']; ?>
                    </option>
                <?php } ?>

            </select>
        </div>

        <!-- GURU -->
        <div class="form-group">
            <label>Guru</label>

            <select name="kd_guru" class="form-control" required>

                <option value="">-- Pilih Guru --</option>

                <?php
                $guru = mysqli_query($koneksi,"
                    SELECT *
                    FROM guru
                    ORDER BY Nm_guru ASC
                ");

                while($g = mysqli_fetch_assoc($guru)){
                ?>
                    <option value="<?= $g['Kd_guru']; ?>">
                        <?= $g['Nm_guru']; ?>
                    </option>
                <?php } ?>

            </select>
        </div>

        <!-- SEMESTER -->
        <div class="form-group">
            <label>Semester</label>

            <select name="semester" class="form-control" required>
                <option value="Ganjil">Ganjil</option>
                <option value="Genap">Genap</option>
            </select>
        </div>

        <!-- TAHUN AJARAN -->
        <div class="form-group">
            <label>Tahun Ajaran</label>

            <input
                type="text"
                name="tahun_ajaran"
                class="form-control"
                placeholder="Contoh : 2024/2025"
                required>
        </div>

        <hr>

        <h4>Detail Jadwal</h4>

        <div id="detail">

            <div class="row mb-2 baris">

                <!-- MAPEL -->
                <div class="col-md-4">

                    <select name="kd_mapel[]" class="form-control" required>

                        <option value="">-- Pilih Mapel --</option>

                        <?php
                        $mapel = mysqli_query($koneksi,"
                            SELECT *
                            FROM mapel
                            ORDER BY nm_mapel ASC
                        ");

                        while($m = mysqli_fetch_assoc($mapel)){
                        ?>
                            <option value="<?= $m['kd_mapel']; ?>">
                                <?= $m['nm_mapel']; ?>
                            </option>
                        <?php } ?>

                    </select>

                </div>

                <!-- HARI -->
                <div class="col-md-3">

                    <select name="hari[]" class="form-control" required>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>

                </div>

                <!-- JAM -->
                <div class="col-md-3">

                    <select name="jam[]" class="form-control" required>
                        <option value="08:00|09:30">08.00 - 09.30</option>
                        <option value="09:30|11:00">09.30 - 11.00</option>
                        <option value="11:00|12:30">11.00 - 12.30</option>
                    </select>

                </div>

                <!-- HAPUS -->
                <div class="col-md-2">

                    <button
                        type="button"
                        class="btn btn-danger btn-block"
                        onclick="hapusBaris(this)">
                        Hapus
                    </button>

                </div>

            </div>

        </div>

        <button
            type="button"
            class="btn btn-info"
            onclick="tambahBaris()">
            Tambah Mapel
        </button>

    </div>

    <div class="card-footer">

        <button
            type="submit"
            name="tambah"
            class="btn btn-primary">
            Simpan
        </button>

    </div>

    </form>

</div>

</div>
<hr>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Data Jadwal</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Tahun Ajaran</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php
            $no = 1;

            $query = mysqli_query($koneksi,"
                SELECT
                    jadwal_kelas.*,
                    kelas.Nm_kelas
                FROM jadwal_kelas
                JOIN kelas ON jadwal_kelas.Id_kelas = kelas.Id_kelas
                ORDER BY jadwal_kelas.Id_jadwal DESC
            ");

            while($row = mysqli_fetch_assoc($query)){
            ?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['Nm_kelas']; ?></td>
                    <td><?= $row['Thn_ajaran']; ?></td>
                    <td><?= $row['Semester']; ?></td>

                    <td>
                        <a href="page/cetak_jadwal.php?id=<?= $row['Id_jadwal']; ?>"
                           target="_blank"
                           class="btn btn-danger btn-sm">
                            PDF
                        </a>
                    </td>
                </tr>

            <?php } ?>

            </tbody>
        </table>

    </div>
</div>

</section>

<script>

function tambahBaris(){

    let detail = document.getElementById('detail');
    let baris = document.querySelector('.baris');

    let clone = baris.cloneNode(true);

    clone.querySelectorAll('select').forEach(function(item){
        item.selectedIndex = 0;
    });

    detail.appendChild(clone);
}

function hapusBaris(btn){

    let jumlah = document.querySelectorAll('.baris').length;

    if(jumlah > 1){
        btn.closest('.baris').remove();
    }
}

</script>