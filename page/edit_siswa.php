<?php
$kd = $_GET['kd'];
$data = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM siswa WHERE Kd_siswa='$kd'"));
?>

<div class="container">
    <h3>Edit Siswa</h3>

    <form method="post">
        <input type="text" value="<?= $data['Kd_siswa'] ?>" class="form-control mb-2" readonly>
        <input type="text" name="nama" value="<?= $data['Nm_siswa'] ?>" class="form-control mb-2">

        <select name="jenkel" class="form-control mb-2">
            <option value="L" <?= $data['Jenkel']=='L'?'selected':'' ?>>Laki-laki</option>
            <option value="P" <?= $data['Jenkel']=='P'?'selected':'' ?>>Perempuan</option>
        </select>

        <input type="text" name="kelas" value="<?= $data['Kelas'] ?>" class="form-control mb-2">
        <input type="text" name="hp" value="<?= $data['Hp'] ?>" class="form-control mb-2">
        <textarea name="alamat" class="form-control mb-2"><?= $data['Alamat'] ?></textarea>

        <button type="submit" name="update" class="btn btn-primary">Update</button>
    </form>
</div>

<?php
if(isset($_POST['update'])){
    mysqli_query($koneksi,"UPDATE siswa SET
        Nm_siswa='$_POST[nama]',
        Jenkel='$_POST[jenkel]',
        Kelas='$_POST[kelas]',
        Hp='$_POST[hp]',
        Alamat='$_POST[alamat]'
        WHERE Kd_siswa='$kd'
    ");

    echo "<meta http-equiv='refresh' content='0;url=index.php?page=siswa&msg=edit'>";
}
?>