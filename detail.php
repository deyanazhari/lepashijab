<?php session_start(); ?>
<?php include 'config.php'; ?>
<?php 
$id_produk = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil -> fetch_assoc();
echo "<pre>";
print_r($detail);
echo "</pre>";
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
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative&display=swap" rel="stylesheet">
    <link href="./assets/font-awesome/css/all.min.css?ver=1.2.0" rel="stylesheet">

    <title>Lepas Hijab</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/table.css">

</head>

<body>

    <!-- ***** Preloader Start **** 
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div> -->
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <nav class="navbar navbar-expand-lg" style="background-color: #3f5a5e;">
        <div class="container">
            <a class="navbar-brand" href="index.php">
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
                    <li class="nav-item">
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
    <h2 class="section-heading" style="margin-top: 30px; ">Detail Produk</h2>
    <section class="kontent">
        <div class="container" style="margin-top: 60px;">
            <div class="row">
                <div class="col-md-6">
                    <img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2><?php echo $detail["nama_produk"]?></h2>
                    <h4>Rp. <?php echo number_format($detail["harga_produk"])?></h4>
                    <form method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="number" min="1" name="jumlah" class="form-control">
                                <div class="input-class-button">
                                    <button class="btn btn-primary" name="beli">Beli</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php 
                    // jika ada tombol beli
                    if (isset ($_POST["beli"])){
                        $jumlah = $_POST["jumlah"];
                        $_SESSION["keranjang"][$id_produk] = $jumlah;
                        echo "<script>alert('Produk telah masuk ke keranjang');</script>";
                        echo "<script>location='keranjang.php';</script>";
                    }
                    ?>
                    <p><?php echo $detail["deskripsi_produk"]; ?></p>
                </div>
            </div>
        </div>
    </section>
</body>

</html>