<?php
session_start();
//koneksi database
$koneksi = new mysqli ("localhost","root","","lepashijab");

if (!isset($_SESSION["pelanggan"]))
{
    echo "<script>alert('Silahkan Login');</script>";
    echo "<script>location='login.php';</script>";
}
if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
    echo "<script>alert('Anda Belum Memilih Barang')</script>";
    echo "<script>location='index.php'</script>";
}
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

    <title>Keranjang Belanja</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/table.css">

</head>

<body>

    <!-- ***** Preloader Start ***** 
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div> -->
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <nav class="navbar navbar-expand-lg" style="background-color: black;">
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
                    <li class="nav-item active">
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
    <section class="konten">
        <div class="container">
            <h3>Keranjang Belanja</h3>
            <hr>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor=1; ?>
                    <?php $totalbelanja = 0; ?>
                    <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                    <!-- menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
                    <?php
                    $ambil = $koneksi->query ("SELECT * FROM produk WHERE id_produk='$id_produk'");
                    $pecah = $ambil->fetch_assoc();
                    $subharga = $pecah["harga_produk"]*$jumlah;
                    ?>

                    <tr class="active-row">
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah["nama_produk"]; ?></td>
                        <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
                        <td><?php echo $jumlah; ?></td>
                        <td>Rp. <?php echo number_format($subharga);?></td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php $totalbelanja+=$subharga; ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr style="color: #007c65;">
                        <th colspan="4">Total Belanja</th>
                        <th>Rp. <?php echo number_format($totalbelanja) ?> </th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <form method="post">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']?>"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']?>"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" name="id_ongkir">
                            <option value="">Pilih Ongkos Kirim</option>
                            <?php 
                            $ambil=$koneksi->query("SELECT * FROM ongkir");
                            while($perongkir = $ambil-> fetch_assoc()) {
                             ?>
                            <option value="<?php echo $perongkir["id_ongkir"] ?>">
                                <?php echo $perongkir['nama_kota']?> -
                                Rp. <?php echo number_format($perongkir['tarif'])?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap Pengiriman</label>
                    <textarea class="form-control" name="alamat_pengiriman"
                        placeholder="Masukkan Alamat Lengkap"></textarea>
                </div>
                <button class="btn" name="checkout" style="background-color : #004638; color : white;">Checkout</button>
            </form>
            <?php  
            if (isset ($_POST["checkout"]))
            {
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                $id_ongkir = $_POST["id_ongkir"];
                $tanggal_pembelian = date("Y-m-d");
                $alamat_pengiriman = $_POST['alamat_pengiriman'];

                $ambil = $koneksi -> query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
                $arrayongkir = $ambil-> fetch_assoc();
                $nama_kota = $arrayongkir['nama_kota'];
                $tarif = $arrayongkir ['tarif'];
                $total_pembelian = $totalbelanja + $tarif;

                // menyimpan data ke tabel pembelian
                $koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");
                //menadapatkan id_pembelian baru
               $id_pembelian_barusan = $koneksi->insert_id;
               foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
                   //mendapatkan data produk berdasarkan id_produk
                $ambil = $koneksi -> query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                $perproduk = $ambil -> fetch_assoc();
                $nama = $perproduk['nama_produk'];
                $harga = $perproduk['harga_produk'];
                $berat = $perproduk['berat_produk'];
                $subberat = $perproduk['berat_produk']*$jumlah;
                $subharga = $perproduk['harga_produk']*$jumlah;
                   $koneksi -> query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah) VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");
               }
               //mengkosongkan keranjang belanja
               unset ($_SESSION["keranjang"]);
               //tampilan dialihkan ke halaman nota
               echo "<script>alert('pembelian succes');</script>";
               echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
            }
            ?>
        </div>
    </section>
    <pre><?php print_r($_SESSION['pelanggan'])?></pre>
    <pre><?php print_r($_SESSION['keranjang'])?></pre>

</body>

</html>