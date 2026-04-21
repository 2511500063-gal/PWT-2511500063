<?php
include "config/koneksi.php";
session_start();
?>

<!-- TAMPAK TETAP ADMINLTE KAMU (TIDAK DIUBAH) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Login</b>System</a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">

            <form method="post">

                <div class="input-group mb-3">
                    <input type="text" name="Username" class="form-control" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="Password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" name="login" class="btn btn-primary btn-block">
                            Login
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>

<?php
// ================= LOGIN PROCESS (FIX TOTAL) =================

if (isset($_POST['login'])) {

    $Username = mysqli_real_escape_string($koneksi, $_POST['Username']);
    $Password = mysqli_real_escape_string($koneksi, $_POST['Password']);

    if ($Username == "" || $Password == "") {
        echo "<script>alert('Data tidak boleh kosong');</script>";
        exit;
    }

    // QUERY YANG SUDAH DIBENERIN (INI YANG ERROR TADI)
    $query = mysqli_query($koneksi, "
        SELECT * FROM admin 
        WHERE username = '$Username'
        AND password = '$Password'
        LIMIT 1
    ");

    if (!$query) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_assoc($query);

    if ($data) {

        $_SESSION['Username'] = $data['username'];
        $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
        $_SESSION['role'] = $data['role'];

        if ($data['role'] == "admin") {
            header("Location: index.php");
        } elseif ($data['role'] == "guru") {
            header("Location: index_guru.php");
        } elseif ($data['role'] == "siswa") {
            header("Location: index_siswa.php");
        }

        exit;

    } else {
        echo "<script>alert('Username atau password salah');</script>";
    }
}
?>