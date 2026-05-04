<?php
$username = $_SESSION['Username'];
$data = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM guru WHERE Nm_guru='$username'"));
?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary">
            <h5>Profil Guru</h5>
        </div>

        <div class="card-body">
            <table class="table">
                <tr><td>Kode Guru</td><td><?= $data['Kd_guru'] ?></td></tr>
                <tr><td>Nama</td><td><?= $data['Nm_guru'] ?></td></tr>
                <tr><td>Jenis Kelamin</td><td><?= $data['Jenkel'] ?></td></tr>
                <tr><td>Pendidikan</td><td><?= $data['Pend_terakhir'] ?></td></tr>
                <tr><td>HP</td><td><?= $data['Hp'] ?></td></tr>
                <tr><td>Alamat</td><td><?= $data['Alamat'] ?></td></tr>
            </table>
        </div>
    </div>
</div>