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

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Heade -->
    <header class="" style="background-color: #3f5a5e;">
        <nav class="navbar navbar-expand-lg">
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
                            <a class="nav-link" href="riwayat.php">Riwayat Belanja</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                        <!--jika belum login -->
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="daftar.php">Daftar</a>
                        </li>
                        <?php endif ?>
                    </ul>
                    <form action="pencarian.php" method="get" class="d-flex" style="place-items: right">
                        <input type="text" class="form-control" name="keyword">
                        <button class="btn btn-primary">Cari</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

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


    <div class="latest-products">
        <div class="container">
            <div class="section-heading">
                <h4 style="font-family: 'Nunito', sans-serif;font-weight:700; font-size: 20px;color:#3f5a5e;">Produk
                    Lepas Hijab</h4>
            </div>

            <div class="row">
                <?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
                <?php while($perproduk = $ambil->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="product-item">
                        <a href="produk.php"><img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt=""></a>
                        <div class="down-content">
                            <a href="#">
                                <h4 style="color:#3f5a5e;">
                                    <?php echo $perproduk['nama_produk']; ?></h4>
                            </a>
                            <h6
                                style=" font-family: 'Nunito' , sans-serif;font-weight:800; font-size:15px;color:#253b3e;">
                                Rp.
                                <?php echo  number_format($perproduk["harga_produk"]); ?></h6>
                            <p><?php echo $perproduk['deskripsi_produk']; ?></p>
                            <a href="beli.php?id=<?php echo $perproduk['id_produk'];?>" class="btn"
                                style="background-color: #f33f3f; color:white;">Beli</a>
                            <a href=" detail.php?id=<?php echo $perproduk["id_produk"] ;?>"
                                class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>


        <footer class="pt-4 pb-4 text-center bg-light">
            <div class="container">
                <div class="my-3">
                    <div class=""
                        style="font-family: 'Nunito', sans-serif;font-size:27px;font-weight:800;color:#3f5a5e;">
                        Lepas
                        Hijab</div>
                    <p>Belanja & Retail</p>
                    <div class="social-nav">
                        <nav role="navigation">
                            <ul class="nav justify-content-center">

                                <li class="nav-item"><a class="nav-link" href="https://www.instagram.com/lepashijab"
                                        title="Instagram"><i class="fab fa-instagram fa-2x"></i><span
                                            class="menu-title sr-only">Instagram</span></a></li>
                                <li class="nav-item"><a class="nav-link" href="https://www.linkedin.com/"
                                        title="LinkedIn"><i class="fab fa-whatsapp fa-2x"></i><span
                                            class="menu-title sr-only">LinkedIn</span></a></li>
                                <li class="nav-item"><a class="nav-link" href="https://www.linkedin.com/"
                                        title="LinkedIn"><i class="fas fa-store fa-2x"></i><span
                                            class="menu-title sr-only">LinkedIn</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="text-small text-secondary">
                    <div class="mb-1">&copy; All rights reserved.</div>
        </footer>


        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


        <!-- Additional Scripts -->
        <script src="assets/js/custom.js"></script>
        <script src="assets/js/owl.js"></script>
        <script src="assets/js/slick.js"></script>
        <script src="assets/js/isotope.js"></script>
        <script src="assets/js/accordions.js"></script>


        <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t) { //declaring the array outside of the
            if (!cleared[t.id]) { // function makes it static and global
                cleared[t.id] = 1; // you could use true and false, but that's more typing
                t.value = ''; // with more chance of typos
                t.style.color = '#fff';
            }
        }
        </script>


</body>

</html>