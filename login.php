<?php
    include "config/koneksi.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- iCheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

      <form action="#" method="post">
    <div class="input-group mb-3">
        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <div class="row">

        <!-- /.col -->
        <div class="col-12">
            <input type="submit" name="login" value="Login" class="btn
            btn-primary btn-block">
        </div>
        <!-- /.col -->
    </div>
</form>
</div>
<!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

<?php if(isset($_GET['msg']) && $_GET['msg']=="logout"): ?>
    <div class="alert alert-success" id="logoutAlert">
        Berhasil logout
    </div>

    <script>
        if(window.history.replaceState){
            window.history.replaceState(null,null,window.location.pathname);
        }

        setTimeout(()=>{
            document.getElementById("logoutAlert").style.display="none";
        },3000);
    </script>
<?php endif; ?>

<?php
    if(isset($_POST['login'])) {
    $username = $_POST['username']; 
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        echo "Data Tidak Boleh kosong";
    } else {

        $query = mysqli_query($koneksi,
            "SELECT * FROM user WHERE username='$username' AND password='$password'"
        );

        $data = mysqli_fetch_array($query);

        if($data) {

            $_SESSION['Username'] = $data['username'];
            $_SESSION['Role'] = $data['role']; // PENTING

            if($data['role'] == "admin") {
                header("location:index.php");
            } 
            elseif($data['role'] == "guru") {
                header("location:index_guru.php");
            } 
            elseif($data['role'] == "siswa") {
                header("location:index_siswa.php");
            }

        } else {
            echo '<div class="alert alert-danger">Login gagal</div>';
        }
    }
}