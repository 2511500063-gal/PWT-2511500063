<?php if(isset($_GET['msg'])): ?>

    <?php if($_GET['msg']=="hapus"): ?>
        <div class="alert alert-danger alert-dismissible">
            Data berhasil dihapus
        </div>
    <?php endif; ?>

    <?php if($_GET['msg']=="edit"): ?>
        <div class="alert alert-success alert-dismissible">
            Data berhasil diupdate
        </div>
    <?php endif; ?>

    <?php if($_GET['msg']=="tambah"): ?>
        <div class="alert alert-primary alert-dismissible">
            Data berhasil ditambahkan
        </div>
    <?php endif; ?>

<?php endif; ?>

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Data Siswa</h1>
    </div>
</div>

<?php
if(isset($_GET['action']) && $_GET['action']=="hapus"){
    $kd = $_GET['kd'];
    mysqli_query($koneksi,"DELETE FROM siswa WHERE Kd_siswa='$kd'");
    
    echo "<meta http-equiv='refresh' content='0;url=index.php?page=siswa&msg=hapus'>";
}
?>

<div class="content">
    <div class="container-fluid">
        <a href="index.php?page=tambah_siswa" class="btn btn-primary btn-sm mb-3">
            Tambah Siswa
        </a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kd Siswa</th>
                    <th>Nama</th>
                    <th>Jenkel</th>
                    <th>Kelas</th>
                    <th>HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $no=0;
                $query = mysqli_query($koneksi,"SELECT * FROM siswa");

                while($data = mysqli_fetch_array($query)){
                    $no++;
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $data['Kd_siswa'] ?></td>
                    <td><?= $data['Nm_siswa'] ?></td>
                    <td><?= $data['Jenkel'] ?></td>
                    <td><?= $data['Kelas'] ?></td>
                    <td><?= $data['Hp'] ?></td>
                    <td><?= $data['Alamat'] ?></td>
                    <td>
                        <a href="index.php?page=siswa&action=hapus&kd=<?= $data['Kd_siswa'] ?>" onclick="return confirm('Hapus data?')">
                            <span class="badge badge-danger">Hapus</span>
                        </a>

                        <a href="index.php?page=edit_siswa&kd=<?= $data['Kd_siswa'] ?>">
                            <span class="badge badge-warning">Edit</span>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>