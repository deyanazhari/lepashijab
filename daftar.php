<?php
session_start();
//koneksi databas
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('assets/images/background.jpeg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Daftar Akun
                </span>
                <form class="login100-form validate-form p-b-33 p-t-5" method="post">
                    <div class="wrap-input100 validate-input" data-validate="Enter Email">
                        <input class="input100" type="text" name="nama" placeholder="Nama" required>
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>
                    <div class=" wrap-input100 validate-input" data-validate="Enter Email">
                        <input class=" input100" type="text" name="email" placeholder="Email" required>
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter Email">
                        <input class="input100" type="password" name="password" placeholder="Password" required>
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>
                    <div class="wrap-input100 validate-input">
                        <textarea class="input100" type="password" name="alamat" placeholder="Alamat"
                            required></textarea>
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="telepon" placeholder="Nomer Hp" required>
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-32">
                        <button class="login100-form-btn" name="daftar">
                            Daftar
                        </button>
                    </div>

                </form>
                <?php 
        if (isset($_POST["daftar"]))
        {
           $nama =  $_POST["nama"];
           $email =  $_POST["email"];
           $password =  $_POST["password"];
           $alamat =  $_POST["alamat"];
           $telepon =  $_POST["telepon"];

           $ambil = $koneksi->query("SELECT*FROM pelanggan WHERE email_pelanggan='$email'");
           $yangcocok = $ambil->num_rows;
           if ($yangcocok==1){
               echo "<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
               echo "<script>location='daftar.php';</script>";
           }
           else 
           {
               $koneksi->query ("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,alamat_pelanggan,telepon_pelanggan) VALUES('$email','$password','$nama','$telepon','$alamat')");
               echo "<script>alert('pendaftaran Sukses, Silahkan Login');</script>";
               echo "<script>location='login.php';</script>";
           }
        }
    ?>

            </div>
        </div>
    </div>



    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>