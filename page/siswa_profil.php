<?php
session_start();
require_once("config/koneksi.php");

if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['Username'];

// Gunakan prepared statement
$stmt = mysqli_prepare($koneksi, "SELECT * FROM siswa WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

// Cek apakah data ditemukan
if (!$data) {
    echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
    exit;
}
?>

<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h5>Profil Siswa</h5>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Kode</td>
                    <td><?= htmlspecialchars($data['Kd_siswa']) ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><?= htmlspecialchars($data['Nm_siswa']) ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td><?= htmlspecialchars($data['Jenkel']) ?></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td><?= htmlspecialchars($data['Kelas']) ?></td>
                </tr>
                <tr>
                    <td>HP</td>
                    <td><?= htmlspecialchars($data['Hp']) ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><?= htmlspecialchars($data['Alamat']) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>