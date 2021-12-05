<?php
session_start();
//koneksi database
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="./assets/font-awesome/css/all.min.css?ver=1.2.0" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Gidugu&family=Nunito:wght@700;800&family=Oswald&family=Outfit&family=Roboto&family=Roboto+Condensed&family=Spectral:wght@500&display=swap"
        rel="stylesheet">


    <title>Lepas Hijab</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">

<body>

    <!-- ***** Prloader Start *****-->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Preloader End ***** -->

    <!-- Header -->

    <nav class="navbar navbar-expand-lg" style="background-color: #3f5a5e;">
        <div class="container">
            <a class="navbar-brand" href="produk.php">
                <h2>Lepas <em style="color:#FF6366">Hijab</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="keranjang.php">Keranjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="checkout.php">Checkout</a>
                    </li>
                    <!-- Jika sudah login -->
                    <?php if (isset ($_SESSION["pelanggan"])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <!--jika belum login -->
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php endif ?>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="page-heading products-heading header-text"
        style="background-image:url(assets/images/produk-bg.jpeg);padding: 300px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>new arrivals</h4>
                        <h2 style="font-size: 30px;">Lepas Hijab produk</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>