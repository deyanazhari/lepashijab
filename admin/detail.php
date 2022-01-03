<h2>Detail Pembelian</h2><br>
<?php 
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil -> fetch_assoc();
?>
<!--<pre><?php //print_r($detail); ?></pre> -->


<div class="row">
    <div class="col-md-4">
        <h1>Pembelian</h1>
        <p>
            Tanggal: <?php echo date("d F Y",strtotime($detail['tanggal_pembelian'])); ?><br>
            Total: Rp. <?php echo number_format ($detail['total_pembelian']); ?> <br>
            Status: <?php echo $detail ['status_pembelian']; ?> <br>
        </p>
    </div>
    <div class="col-md-4">
        <h1>Pelanggan</h1>
        <strong> <?php echo $detail['nama_pelanggan']; ?></strong><br>
        <p>
            <?php echo $detail ['telepon_pelanggan']; ?> <br>
            <?php echo $detail ['email_pelanggan']; ?> <br>
        </p>
    </div>
    <div class="col-md-4">
        <h1>Pengiriman</h1>
        <h4>Pengiriman</h4>
        <strong> <?php echo $detail['tipe'];?> <?php echo $detail['kota'];?> <?php echo $detail['provinsi']; ?></strong> <br>
        Ongkos Kirim: Rp. <?php echo number_format($detail['ongkir']);?>,00<br>
        Ekspedisi: <?php echo $detail["ekspedisi"] ?> <?php echo $detail["paket"] ?> <?php echo $detail["estimasi"] ?> <br>
        Alamat Pengiriman: <?php echo ($detail['alamat_pengiriman']); ?>
    </div>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
        <?php while ($pecah=$ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah ['nama_produk']; ?></td>
            <td>Rp. <?php echo number_format ($pecah ['harga_produk']); ?></td>
            <td><?php echo $pecah ['jumlah']; ?></td>
            <td>
                Rp. <?php echo number_format ($pecah ['harga_produk']*$pecah['jumlah']); ?>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>