<?php
session_start();
//koneksi database
$koneksi = new mysqli ("localhost","root","","lepashijab");

// jika tidak ada session pelanggan (belum login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
    echo "<script>alert('silahkan login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

//mendapatkan id_pembelian dari url
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

//mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
//mendaparkan id_pelanggan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login !==$id_pelanggan_beli)
{
    echo "<script>alert('Tidak Dapat Melihat');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<title>Pembayaran</title>

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
    <link rel="stylesheet" href="assets/css/table.css">

</head>

<body>

    <!-- ***** Preloader Start **** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="" style="background-color: #3f5a5e;">
        <nav class="navbar navbar-expand-lg">
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
                            <a class="nav-link active" href="index.php">Home
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
    <div class="banner header-text">
    </div>
    <div class="container">
        <h2>Konfirmasi Pembayaran</h2>
        <p>Kirim Bukti Pembayaran Anda disini</p>
        <div class="alert alert-info">Total Tagihan Anda <strong>Rp.
                <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Penyetor</label>
                <input type="text" class="form-control" name="nama">
            </div>
            <div class="form-group">
                <label>Bank</label>
                <input type="text" class="form-control" name="bank">
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" min="1">
            </div>
            <div class="form-group">
                <label>Foto Bukti</label>
                <input type="file" class="form-control" name="bukti">
                <p class="text-danger">Foto Bukti harus JPG maksimal 2MB</p>
            </div>
            <button class="btn btn-primary" name="kirim">Kirim</button>
        </form>
    </div>
    </div>

    <?php  
//jika ada tombol kirim
if (isset($_POST["kirim"]))
{
    //upload bukti foto
    $namabukti = $_FILES["bukti"]["name"];
    $lokasibukti = $_FILES["bukti"]["tmp_name"];
    $namafiks = date("YmdHis").$namabukti;
    move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

    $nama = $_POST["nama"];
    $bank = $_POST["bank"];
    $jumlah = $_POST["jumlah"];
    $tanggal = date("Y-m-d");

    //simpan pembayaran
    $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti)
        VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks') ");

    //update data pembelian dari pending menjadi sudah kirim pembayaran
    $koneksi->query("UPDATE pembelian SET status_pembelian='Sudah Mengirim Pembayaran'
        WHERE id_pembelian='$idpem'");

    echo "<script>alert('Terima Kasih Sudah Mengirimkan Bukti Pembayaran');</script>";
    echo "<script>location='index.php';</script>";
    
}
?>

    <footer class="pt-4 pb-4 text-center bg-light">
        <div class="container">
            <div class="my-3">
                <div style="font-family: 'Nunito', sans-serif;font-size:27px;font-weight:800;color:#3f5a5e;">LEPAS HIJAB
                </div>
                <p>Belanja & retail</p>
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