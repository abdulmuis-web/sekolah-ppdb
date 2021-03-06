<?php
session_start();
require 'functions.php';

if (isset($_POST['login'])) {
    // var_dump($_POST);
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    // var_dump($result);
    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            session_start();
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;
            header("Location: dashboard/index.php");
            exit;
        } else {
            echo '<script>alert("Username atau Password salah. Coba kembali!")</script>';
        }
    } else {
        echo "<script>alert('User tidak dikenal. Harap isi dengan benar!')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="css/all.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <form action="" method="post" class="user formlogin">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="userName" placeholder="Username" name="username" required>
                                            <br>
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                                            </div>
                                        </div>
                                        <input name="login" id="" class="btn btn-primary btn-user btn-block" type="submit" value="Login">
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="lupa_password.php">Lupa Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="registrasi.php">Buat Akun!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="lib/easing/easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        // Pesan pada field input login, register, dan forgot password
        $('.formlogin .form-group input').on('change invalid', function() {
            var textField = $(this).get(0);
            var placeHolder = $(this).attr('placeholder');

            textField.setCustomValidity('');

            if (!textField.validity.valid) {
                textField.setCustomValidity(placeHolder + " tidak boleh kosong!");
            }
        });
    </script>

</body>

</html>