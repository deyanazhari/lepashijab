-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2022 at 07:49 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lepashijab`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'deyan', 'deyan123', 'deyan azhari');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Hijab Square'),
(2, 'Pashmina');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `nama_kota` varchar(25) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Serang', 10000),
(2, 'Jakarta', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(1, 'deyanazhari@gmail.com', 'deyan123', 'Deyan Azhari', '085947299517', ''),
(2, 'deyanazhari1@gmail.com', 'deyan123', 'azhari deyan', '085947299517', ''),
(3, 'deyan123@gmail.com', 'deyan123', 'deyan', 'Permata Banjar Asri A3/4', '757575757'),
(4, 'nindiarahma15@gmail.com', '123456789', 'Nindia Rahma', 'Jalan Mawar Anggrek D45', '0812345678'),
(5, 'fadiaarsadila00@gmail.com', 'arsadila', 'Fadia Arsadila', 'Taman Widya Asri ', '0813-1904-2170');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(5, 29, 'deyan azhari', 'bri', 35000, '2021-12-16', '20211216160818ActivityDiagram1.jpg'),
(6, 30, 'Fadia Arsadila', 'mandiri', 45000, '2021-12-21', '2021122114364405bf49ab-efa5-4615-8465-f70cb654d8cd.jfif'),
(7, 38, 'Fadia Arsadila', 'BRI', 119, '2022-01-02', '202201020804171a543249-4f0c-49b0-b902-e8838f7b944a.jfif'),
(8, 39, 'Nindia Rahma', 'BCA', 154000, '2022-01-02', '20220102083136381802d8-12a0-45b0-ad02-16712116897c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending',
  `resi_pengiriman` varchar(50) NOT NULL,
  `totalberat` int(11) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `kodepos` varchar(255) NOT NULL,
  `ekspedisi` varchar(255) NOT NULL,
  `paket` varchar(255) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `estimasi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `tanggal_pembelian`, `total_pembelian`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`, `totalberat`, `provinsi`, `kota`, `tipe`, `kodepos`, `ekspedisi`, `paket`, `ongkir`, `estimasi`) VALUES
(25, 2, '2021-11-22', 70000, 'Permata Banjar Asri A3/4', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(26, 2, '2021-11-23', 80000, 'Permata Banjar Asri A3/4', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(27, 2, '2021-11-24', 35000, '', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(28, 2, '2021-11-27', 70000, '', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(29, 1, '2021-11-29', 35000, '', 'lunas', '', 0, '', '', '', '', '', '', 0, ''),
(30, 1, '2021-11-29', 45000, 'Permata Banjar Asri A3/4', 'sudah kirim pembayaran', '', 0, '', '', '', '', '', '', 0, ''),
(31, 1, '2021-12-16', 150000, 'PBA', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(32, 1, '2021-12-16', 115000, 'PBA', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(33, 1, '2021-12-16', 220000, 'pba', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(34, 1, '2021-12-23', 45000, 'Jalan Akses UI, Gang Dharma 1, Commando Kost Kamar No. 12. Kelapa Dua, Depok', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(35, 4, '2021-12-28', 45000, 'warahayu', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(36, 5, '2022-01-01', 115000, 'Taman Widya Asri', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(37, 5, '2022-01-01', 35000, '', 'pending', '', 0, '', '', '', '', '', '', 0, ''),
(38, 5, '2022-01-02', 119000, 'antapani, bandung', 'barang dikirim', '901467294113', 300, 'Jawa Barat', 'Bandung', 'Kota', '40111', 'jne', 'OKE', 14000, '4-5'),
(39, 4, '2022-01-02', 154000, 'Kelapa dua, Tanggerang', 'sudah kirim pembayaran', '', 400, 'Banten', 'Tangerang', 'Kota', '15111', 'tiki', 'ECO', 14000, '4'),
(40, 1, '2022-01-02', 52000, 'Jalan Akses UI, Gang Dharma 1, Commando Kost Kamar No. 12. Kelapa Dua, Depok', 'pending', '', 100, 'Jawa Barat', 'Depok', 'Kota', '16416', 'jne', 'REG', 17000, '2-3');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(26, 23, 8, 1, 'Line Square', 35000, 100, 100, 35000),
(27, 24, 6, 1, 'Pansy Square', 35000, 100, 100, 35000),
(28, 25, 6, 2, 'Pansy Square', 35000, 100, 200, 70000),
(29, 26, 6, 1, 'Pansy Square', 35000, 100, 100, 35000),
(30, 26, 7, 1, 'Ammi Square', 35000, 100, 100, 35000),
(31, 27, 7, 1, 'Ammi Square', 35000, 100, 100, 35000),
(32, 28, 6, 2, 'Pansy Square', 35000, 100, 200, 70000),
(33, 29, 6, 1, 'Pansy Square', 35000, 100, 100, 35000),
(34, 30, 7, 1, 'Ammi Square', 35000, 100, 100, 35000),
(35, 31, 7, 3, 'Ammi Square', 35000, 100, 300, 105000),
(36, 31, 8, 1, 'Line Square', 35000, 100, 100, 35000),
(37, 32, 6, 2, 'Pansy Square', 35000, 100, 200, 70000),
(38, 32, 8, 1, 'Line Square', 35000, 100, 100, 35000),
(39, 33, 9, 3, 'Iris Square', 35000, 100, 300, 105000),
(40, 33, 7, 1, 'Ammi Square', 35000, 100, 100, 35000),
(41, 33, 6, 2, 'Pansy Square', 35000, 100, 200, 70000),
(42, 34, 7, 1, 'Ammi Square', 35000, 100, 100, 35000),
(43, 0, 7, 1, 'Ammi Square', 35000, 100, 100, 35000),
(44, 0, 9, 1, 'Iris Square', 35000, 100, 100, 35000),
(45, 0, 7, 1, 'Ammi Square', 35000, 100, 100, 35000),
(46, 0, 9, 1, 'Iris Square', 35000, 100, 100, 35000),
(47, 0, 8, 4, 'Line Square', 35000, 100, 400, 140000),
(48, 0, 9, 1, 'Iris Square', 35000, 100, 100, 35000),
(49, 0, 8, 1, 'Line Square', 35000, 100, 100, 35000),
(50, 0, 8, 1, 'Line Square', 35000, 100, 100, 35000),
(51, 0, 9, 1, 'Iris Square', 35000, 100, 100, 35000),
(52, 0, 7, 1, 'Ammi Square', 35000, 100, 100, 35000),
(53, 0, 7, 1, 'Ammi Square', 35000, 100, 100, 35000),
(54, 35, 9, 1, 'Iris Square', 35000, 100, 100, 35000),
(55, 36, 9, 2, 'Iris Square', 35000, 100, 200, 70000),
(56, 36, 7, 1, 'Ammi Square', 35000, 100, 100, 35000),
(57, 37, 8, 1, 'Line Square', 35000, 100, 100, 35000),
(58, 38, 7, 2, 'Ammi Square', 35000, 100, 200, 70000),
(59, 38, 9, 1, 'Iris Square', 35000, 100, 100, 35000),
(60, 39, 9, 4, 'Iris Square', 35000, 100, 400, 140000),
(61, 40, 8, 1, 'Line Square', 35000, 100, 100, 35000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `berat_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(7, 1, 'Ammi Square', 35000, 100, 'product_02.png', 'Array\n            [deskripsi]', 12),
(8, 1, 'Line Square', 35000, 100, 'hijab4.png', 'Array\n            [deskripsi]', 8),
(9, 1, 'Iris Square', 35000, 100, 'hijab3.png', 'Array\n            [deskripsi]', 13);

-- --------------------------------------------------------

--
-- Table structure for table `produk_foto`
--

CREATE TABLE `produk_foto` (
  `id_produk_foto` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_foto`
--

INSERT INTO `produk_foto` (`id_produk_foto`, `id_produk`, `nama_produk_foto`) VALUES
(1, 0, '20220101034607');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_foto`
--
ALTER TABLE `produk_foto`
  ADD PRIMARY KEY (`id_produk_foto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produk_foto`
--
ALTER TABLE `produk_foto`
  MODIFY `id_produk_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
