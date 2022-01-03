<?php 
session_start();
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
    <br>

    <div class="banner header-text"></div>
    <section class="konten">
        <div class="container">
            <!-- Nota -->
            <h2>Detail Pembelian</h2><br>
            <?php 
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil -> fetch_assoc();
?>

<!-- jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka dilarikan ke riwayat.php karena dia tidak berhak melihat nota orang lain-->
<!-- pelanggan yang beli harus pelanggan yang login-->
<?php 
// mendapatkan id_pelanggan yang  beli
$idpelangganyangbeli = $detail["id_pelanggan"];

// mendapatkan id_pelanggan yang  beli
$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

if ($idpelangganyangbeli!==$idpelangganyanglogin)
{
    echo "<script>alert('jangan nakal');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>


            <div class="row">
                <div class="col-md-4">
                    <h4>Pembelian</h4>
                    <strong>No. Pembelian: <?php echo $detail['id_pembelian']; ?></strong> <br>
                    Tanggal: <?php echo date("d F Y",strtotime($detail['tanggal_pembelian'])); ?></strong><br>
                    Total: Rp. <?php echo number_format($detail ['total_pembelian']); ?>,00
                </div>
                <div class="col-md-4">
                    <h4>Pelanggan</h4>
                    <strong> <?php echo $detail['nama_pelanggan']; ?></strong> <br>

                    <?php echo $detail ['telepon_pelanggan']; ?> <br>
                    <?php echo $detail ['email_pelanggan']; ?> <br>

                </div>
                <div class="col-md-4">
                    <h4>Pengiriman</h4>
                    <strong> <?php echo $detail['tipe'];?> <?php echo $detail['kota'];?> <?php echo $detail['provinsi']; ?></strong> <br>
                    Ongkos Kirim: Rp. <?php echo number_format($detail['ongkir']);?>,00<br>
                    Ekspedisi: <?php echo $detail["ekspedisi"] ?> <?php echo $detail["paket"] ?> <?php echo $detail["estimasi"] ?> <br>
                    Alamat Pengiriman: <?php echo ($detail['alamat_pengiriman']); ?>
                </div>
            </div>

            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Berat</th>
                        <th>Jumlah</th>
                        <th>Subberat</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor=1; ?>
                    <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
                    <?php while ($pecah=$ambil->fetch_assoc()){ ?>
                    <tr class="active-row">
                        <td><?php echo $nomor; ?></td>
                        <td> <?php echo $pecah ['nama']; ?></td>
                        <td>Rp. <?php echo number_format($pecah ['harga']); ?></td>
                        <td> <?php echo $pecah ['berat']; ?>(gr)</td>
                        <td><?php echo $pecah ['jumlah']; ?>(pcs)</td>
                        <td> <?php echo $pecah ['subberat']; ?>(gr)</td>
                        <td>Rp. <?php echo number_format($pecah ['subharga']); ?></td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-7">
                    <div class="alert alert-info">
                        <p>
                            Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?>
                            Ke <br>
                            <strong>Bank Mandiri 137-001088-3276 AN.Lepas Hijab</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

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