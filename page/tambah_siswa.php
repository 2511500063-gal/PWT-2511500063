<div class="container">
    <h3>Tambah Siswa</h3>

    <form method="post">
        <input type="text" name="kd" placeholder="Kode Siswa" class="form-control mb-2" required>
        <input type="text" name="nama" placeholder="Nama Siswa" class="form-control mb-2" required>

        <select name="jenkel" class="form-control mb-2">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>

        <input type="text" name="kelas" placeholder="Kelas" class="form-control mb-2">
        <input type="text" name="hp" placeholder="HP" class="form-control mb-2">
        <textarea name="alamat" placeholder="Alamat" class="form-control mb-2"></textarea>

        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
    </form>
</div>

<?php
if(isset($_POST['simpan'])){
    mysqli_query($koneksi,"INSERT INTO siswa VALUES(
        '$_POST[kd]',
        '$_POST[nama]',
        '$_POST[jenkel]',
        '$_POST[kelas]',
        '$_POST[hp]',
        '$_POST[alamat]'
    )");

    echo "<meta http-equiv='refresh' content='0;url=index.php?page=siswa&msg=tambah'>";
}
?>