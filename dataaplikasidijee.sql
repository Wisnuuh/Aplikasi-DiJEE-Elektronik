-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 10:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasidijee`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `Barang_ID` varchar(50) NOT NULL,
  `Nama` varchar(255) DEFAULT NULL,
  `Jumlah` int(255) DEFAULT NULL,
  `Garansi` varchar(255) DEFAULT NULL,
  `HargaBeli` int(11) DEFAULT NULL,
  `HargaJual` int(11) DEFAULT NULL,
  `Kategori_ID` int(11) NOT NULL,
  `ID_Supplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`Barang_ID`, `Nama`, `Jumlah`, `Garansi`, `HargaBeli`, `HargaJual`, `Kategori_ID`, `ID_Supplier`) VALUES
('1', 'Lampu Led Maxxis 20W', 13, '', 15000, 17500, 1, 1),
('10', 'Aqua Galon Kosong', 0, '', 30000, 35000, 3, 3),
('11', 'Aqua Gelas 240ml', 3, '', 21700, 25000, 3, 3),
('12', 'Arde Besar', 18, '', 27500, 32000, 4, 4),
('13', 'Arde Kecil', 15, '', 9000, 15000, 4, 4),
('14', 'Arde Tanggung', 18, '', 13500, 17500, 4, 4),
('15', 'Arpus Soder', 0, '', 2500, 4000, 5, 6),
('16', 'Arpus Soder Kuning', 0, '', 3000, 5000, 5, 6),
('17', 'Avr Genset Specktek', 0, '', 38000, 100000, 6, 7),
('18', 'Avr Genset Yamamoto', 0, '', 45000, 125000, 6, 7),
('19', 'Box Adaptor 1A', 0, '', 3750, 6000, 7, 8),
('2', 'Lampu Philips Led 10W', 6, '1 hari', 45000, 50000, 1, 2),
('20', 'Box Adaptor 3A', 0, '', 6500, 10000, 7, 8),
('21', 'Box Adaptor 5A', 0, '', 7000, 12500, 7, 8),
('22', 'Box Ampli AG 02', 0, '', 46000, 60000, 8, 8),
('23', 'Box Ampli AG 03', 0, '', 47000, 60000, 8, 8),
('24', 'Box Ampli AG 04', 0, '', 46000, 60000, 8, 8),
('25', 'Box Ampli Besar', 0, '', 57500, 75000, 8, 8),
('26', 'Box Ampli Humer 200', 0, '', 70000, 85000, 8, 8),
('27', 'Box Ampli SJ1000', 0, '', 170000, 200000, 8, 8),
('28', 'Box Ampli SJ500', 0, '', 64000, 80000, 8, 8),
('3', 'Aper Lebar Lubang Besar', 87, '2 bulan', 2000, 5000, 2, 5),
('4', 'Aper Lubang Besar', 90, '', 3000, 5000, 2, 5),
('5', 'Aper Lubang Kecil/Besar', 80, '', 3000, 5000, 2, 5),
('6', 'Aper Maspion Hitam', 90, '', 2750, 5000, 2, 5),
('7', 'Aqua 1500ml', 38, '', 4000, 5000, 3, 3),
('8', 'Aqua 600ml', 44, '', 2000, 3000, 3, 3),
('8991102387262', 'tango', 5, '1 tahun', 5000, 10000, 1, 1),
('9', 'Aqua Air Galon', 10, '', 18200, 20000, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `detailpembelian`
--

CREATE TABLE `detailpembelian` (
  `ID_DetailPembelian` int(11) NOT NULL,
  `Barang_ID` varchar(50) NOT NULL,
  `Pembelian_ID` int(11) NOT NULL,
  `Nama_Barang` varchar(255) DEFAULT NULL,
  `hargaBeli` int(11) DEFAULT NULL,
  `Jumlah` int(16) DEFAULT NULL,
  `subTotal` int(11) DEFAULT NULL,
  `Garansi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detailpembelian`
--

INSERT INTO `detailpembelian` (`ID_DetailPembelian`, `Barang_ID`, `Pembelian_ID`, `Nama_Barang`, `hargaBeli`, `Jumlah`, `subTotal`, `Garansi`) VALUES
(1, '1', 1, 'Lampu Led Maxxis 20W', 15000, 10, 150000, 'tidak ada\r\n'),
(2, '2', 1, 'Lampu Philips Led 10W', 45000, 5, 225000, 'tidak ada\r\n'),
(3, '7', 2, 'Aqua 1500ml', 4000, 50, 200000, 'tergantung expired'),
(4, '8', 2, 'Aqua 600ml', 2000, 50, 100000, 'tergantung expired'),
(5, '9', 2, 'Aqua Air Galon', 18200, 10, 182000, 'tergantung expired'),
(6, '3', 3, 'Aper Lebar Lubang Besar', 2000, 100, 200000, 'tidak ada'),
(7, '4', 3, 'Aper Lubang Besar', 3000, 100, 300000, 'tidak ada'),
(8, '5', 3, 'Aper Lubang Kecil/Besar', 3000, 100, 300000, 'tidak ada'),
(9, '6', 3, 'Aper Maspion Hitam', 2750, 100, 275000, 'tidak ada'),
(10, '12', 4, 'Arde Besar', 27500, 20, 550000, 'tidak ada'),
(11, '13', 4, 'Arde Kecil', 9000, 20, 180000, 'tidak ada'),
(12, '14', 4, 'Arde Tanggung', 13500, 20, 270000, 'tidak ada'),
(13, '1', 5, 'Lampu Led Maxxis 20W', 15000, 1, 15000, ''),
(14, '8', 5, 'Aqua 600ml', 2000, 2, 4000, ''),
(15, '1', 6, 'Lampu Led Maxxis 20W', 15000, 12, 180000, ''),
(16, '11', 7, 'Aqua Gelas 240ml', 21700, 5, 108500, ''),
(17, '1', 8, 'Lampu Led Maxxis 20W', 15000, 2, 30000, ''),
(18, '2', 9, 'Lampu Philips Led 10W', 45000, 2, 90000, '1 hari');

--
-- Triggers `detailpembelian`
--
DELIMITER $$
CREATE TRIGGER `tambakStok` AFTER INSERT ON `detailpembelian` FOR EACH ROW BEGIN
    INSERT INTO barang SET
    barang.Barang_ID = NEW.Barang_ID, barang.Jumlah = NEW.Jumlah
    ON DUPLICATE KEY UPDATE barang.Jumlah = barang.Jumlah + NEW.Jumlah;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detailpenjualan`
--

CREATE TABLE `detailpenjualan` (
  `ID_detailPenjualan` int(11) NOT NULL,
  `ID_Penjualan` int(11) NOT NULL,
  `Barang_ID` varchar(50) NOT NULL,
  `nama_Barang` varchar(100) NOT NULL,
  `harga_Jual` int(11) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `subTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detailpenjualan`
--

INSERT INTO `detailpenjualan` (`ID_detailPenjualan`, `ID_Penjualan`, `Barang_ID`, `nama_Barang`, `harga_Jual`, `Jumlah`, `subTotal`) VALUES
(1, 1, '1', 'Lampu Led Maxxis 20W', 17500, 2, 35000),
(2, 1, '2', 'Lampu Philips Led 10W', 50000, 1, 50000),
(3, 2, '9', 'Aqua Air Galon', 20000, 2, 40000),
(4, 2, '4', 'Aper Lubang Besar', 5000, 2, 10000),
(5, 2, '2', 'Lampu Philips Led 10W', 50000, 1, 50000),
(6, 3, '12', 'Arde Besar', 32000, 2, 64000),
(7, 3, '14', 'Arde Tanggung', 17500, 1, 17500),
(11, 4, '1', 'Lampu Led Maxxis 20W', 17500, 2, 35000),
(12, 5, '9', 'Aqua Air Galon', 20000, 2, 40000),
(13, 5, '2', 'Lampu Philips Led 10W', 50000, 1, 50000),
(14, 6, '1', 'Lampu Led Maxxis 20W', 17500, 2, 35000),
(15, 7, '3', 'Aper Lebar Lubang Besar', 5000, 2, 10000),
(16, 8, '3', 'Aper Lebar Lubang Besar\r\n', 5000, 2, 10000),
(17, 9, '7', 'Aqua 1500ml', 5000, 2, 10000),
(18, 9, '8', 'Aqua 600ml', 3000, 2, 6000),
(19, 10, '12', 'Arde Besar', 32000, 2, 64000),
(20, 10, '13', 'Arde Kecil', 15000, 5, 75000),
(21, 10, '11', 'Aqua Gelas 240ml', 25000, 2, 50000),
(22, 11, '4', 'Aper Lubang Besar', 5000, 2, 10000),
(23, 11, '5', 'Aper Lubang Kecil/Besar', 5000, 2, 10000),
(24, 11, '6', 'Aper Maspion Hitam', 5000, 2, 10000),
(25, 12, '4', 'Aper Lubang Besar', 5000, 3, 15000),
(26, 12, '4', 'Aper Lubang Besar', 5000, 2, 10000),
(27, 13, '4', 'Aper Lubang Besar', 5000, 2, 10000),
(28, 13, '6', 'Aper Maspion Hitam', 5000, 2, 10000),
(29, 14, '1', 'Lampu Led Maxxis 20W', 17500, 2, 35000),
(30, 14, '5', 'Aper Lubang Kecil/Besar', 5000, 2, 10000),
(31, 14, '2', 'Lampu Philips Led 10W', 50000, 1, 50000),
(32, 14, '7', 'Aqua 1500ml', 5000, 10, 50000),
(33, 15, '5', 'Aper Lubang Kecil/Besar', 5000, 4, 20000),
(34, 15, '6', 'Aper Maspion Hitam', 5000, 5, 25000),
(35, 15, '1', 'Lampu Led Maxxis 20W', 17500, 3, 52500),
(36, 15, '5', 'Aper Lubang Kecil/Besar', 5000, 5, 25000),
(37, 15, '14', 'Arde Tanggung', 17500, 2, 35000),
(38, 16, '3', 'Aper Lebar Lubang Besar', 5000, 4, 20000),
(39, 16, '5', 'Aper Lubang Kecil/Besar', 5000, 3, 15000),
(40, 17, '1', 'Lampu Led Maxxis 20W', 17500, 2, 35000),
(41, 17, '8', 'Aqua 600ml', 3000, 4, 12000),
(42, 18, '6', 'Aper Maspion Hitam', 5000, 1, 5000),
(43, 18, '4', 'Aper Lubang Besar', 5000, 1, 5000),
(44, 19, '3', 'Aper Lebar Lubang Besar', 5000, 2, 10000),
(45, 20, '3', 'Aper Lebar Lubang Besar', 5000, 1, 5000),
(46, 20, '5', 'Aper Lubang Kecil/Besar', 5000, 2, 10000),
(47, 21, '5', 'Aper Lubang Kecil/Besar', 5000, 2, 10000),
(48, 21, '3', 'Aper Lebar Lubang Besar', 5000, 1, 5000),
(49, 22, '3', 'Aper Lebar Lubang Besar', 5000, 1, 5000);

--
-- Triggers `detailpenjualan`
--
DELIMITER $$
CREATE TRIGGER `kurangStok` AFTER INSERT ON `detailpenjualan` FOR EACH ROW BEGIN
    INSERT INTO barang SET
    barang.Barang_ID = NEW.Barang_ID, barang.Jumlah = NEW.Jumlah
    ON DUPLICATE KEY UPDATE barang.Jumlah = barang.Jumlah - NEW.Jumlah;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `incomingclaim`
--

CREATE TABLE `incomingclaim` (
  `Klaim_ID` int(11) NOT NULL,
  `Barang_ID` varchar(50) NOT NULL,
  `nama_Barang` varchar(100) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Tgl_Pengembalian` date NOT NULL,
  `akhir_Garansi` varchar(60) DEFAULT NULL,
  `Keterangan` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incomingclaim`
--

INSERT INTO `incomingclaim` (`Klaim_ID`, `Barang_ID`, `nama_Barang`, `Jumlah`, `Tgl_Pengembalian`, `akhir_Garansi`, `Keterangan`) VALUES
(1, '3', 'Aper Lebar Lubang Besar', 1, '2023-05-23', '2023-07-23', 'barang rusak dan kabel putus');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_user`
--

CREATE TABLE `jenis_user` (
  `JenisUser_ID` int(11) NOT NULL,
  `Divisi_User` enum('Pemilik','Kasir','Service') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_user`
--

INSERT INTO `jenis_user` (`JenisUser_ID`, `Divisi_User`) VALUES
(1, 'Pemilik'),
(2, 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `Kategori_ID` int(11) NOT NULL,
  `Nama` varchar(255) DEFAULT NULL,
  `Deskripsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`Kategori_ID`, `Nama`, `Deskripsi`) VALUES
(1, 'Lampu', 'penerang ruangan'),
(2, 'Aper', 'tidak ada garansi'),
(3, 'Aqua', 'air minum dan galon'),
(4, 'Arde', 'macam kabel'),
(5, 'Arpus sorder', 'pelengket timah'),
(6, 'Avr genset', 'pengatur tegangan'),
(7, 'Box adaptor', 'pengubah tegangan'),
(8, 'Box ampli', 'memperbaiki suara audio'),
(11, 'kulkas', 'penyimpan makanan'),
(12, 'kipas', 'pendingin ruangan');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `Pelanggan_ID` int(11) NOT NULL,
  `Nama` varchar(255) DEFAULT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `No_Telp` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`Pelanggan_ID`, `Nama`, `Alamat`, `No_Telp`) VALUES
(1, 'Adi', 'Jln. Duku, Jember', '085633455231'),
(2, 'Rani', 'Jln. Melayu, Jember', '085633455211'),
(3, 'Doni', 'Jln. Rambutan, Jember', '0856235158211'),
(4, 'Ali Suseno', 'Jln.Anggrek', '0824356728354'),
(5, 'fuad', NULL, NULL),
(6, 'tes', NULL, NULL),
(7, 'tes1', NULL, NULL),
(8, 'rijal', NULL, NULL),
(9, 'Andi Bagus', NULL, NULL),
(10, 'fian', NULL, NULL),
(11, 'arya', NULL, NULL),
(12, 'ari', NULL, NULL),
(13, 'farid', NULL, NULL),
(14, 'fian', NULL, NULL),
(15, 'ardi', NULL, NULL),
(16, 'Alvaro', NULL, NULL),
(17, 'alfa', NULL, NULL),
(18, 'Alva', NULL, NULL),
(19, 'alvaro A.', NULL, NULL),
(20, 'arya alvaro', NULL, NULL),
(21, 'Kalingga', NULL, NULL),
(22, 'raditya', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `Pembelian_ID` int(11) NOT NULL,
  `Tanggal_Pembelian` date NOT NULL,
  `Total_Pembayaran` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`Pembelian_ID`, `Tanggal_Pembelian`, `Total_Pembayaran`) VALUES
(1, '2023-01-05', 375000),
(2, '2023-03-31', 482000),
(3, '2023-01-10', 1075000),
(4, '2023-03-05', 1000000),
(5, '2023-05-15', 19000),
(6, '2023-05-21', 180000),
(7, '2023-05-21', 108500),
(8, '2023-05-21', 30000),
(9, '2022-05-10', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `ID_Penjualan` int(11) NOT NULL,
  `Tgl_Penjualan` date DEFAULT NULL,
  `totalPembayaran` int(11) DEFAULT NULL,
  `uangKembalian` int(11) DEFAULT NULL,
  `Pelanggan_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`ID_Penjualan`, `Tgl_Penjualan`, `totalPembayaran`, `uangKembalian`, `Pelanggan_ID`, `User_ID`) VALUES
(1, '2022-02-03', 85000, 15000, 1, 1),
(2, '2023-02-10', 100000, 0, 2, 1),
(3, '2023-02-20', 81500, 18500, 3, 2),
(4, '2023-05-21', 35000, 15000, 4, 2),
(5, '2023-05-22', 90000, 10000, 5, 2),
(6, '2023-05-23', 35000, 0, 6, 2),
(7, '2023-05-23', 10000, 0, 7, 2),
(8, '2023-02-25', 10000, 0, 7, 1),
(9, '2023-05-23', 16000, 4000, 8, 2),
(10, '2023-05-24', 189000, 11000, 9, 2),
(11, '2023-05-25', 30000, 10000, 10, 2),
(12, '2023-05-26', 25000, 25000, 11, 2),
(13, '2023-05-26', 20000, 10000, 12, 2),
(14, '2023-05-26', 145000, 5000, 13, 2),
(15, '2023-05-26', 157500, 42500, 14, 2),
(16, '2023-05-26', 35000, 15000, 15, 2),
(17, '2023-05-29', 47000, 3000, 16, 2),
(18, '2023-05-31', 10000, 0, 18, 2),
(19, '2023-05-31', 10000, 0, 19, 2),
(20, '2023-05-31', 15000, 5000, 20, 2),
(21, '2023-05-31', 15000, 0, 21, 4),
(22, '2023-05-31', 5000, 0, 22, 4);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `ID_Supplier` int(11) NOT NULL,
  `Nama_Supplier` varchar(255) DEFAULT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `No_Telp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`ID_Supplier`, `Nama_Supplier`, `Alamat`, `No_Telp`) VALUES
(1, 'LED', 'Jln. Pangeran, Sidoarjo', '082553776881'),
(2, 'Philips', 'Jln. Wahid Hasyim, Sidoarjo', '083445677821'),
(3, 'AQUA', 'Jln. Pattimura, Surabaya', '089553667882'),
(4, 'Arde Jaya', 'Jln. MangunKusumo, Sidoarjo', '085332776889'),
(5, 'Perusahaan Aper', 'Jl.Pondok, Sidoarjo', '085766359281'),
(6, 'Perusahaan Arpus', 'Jln.Anggrek, Surabaya', '085966475983'),
(7, 'Perusahaan Avr', 'Jln.Kenanga, Sidoarjo', '089667554883'),
(8, 'Perusahaan Adaptor dan Ampli', 'Jln. Mawar,Sidoarjo', '089556443778');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(11) NOT NULL,
  `Nama` varchar(255) DEFAULT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `Nomor_HP` varchar(16) DEFAULT NULL,
  `JenisUser_ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_ID`, `Nama`, `Alamat`, `Nomor_HP`, `JenisUser_ID`, `username`, `password`) VALUES
(1, 'Ayu Dewi', 'Jln. Prajurit, jember', '085335887665', 1, 'Pemilik', 'Pemilik'),
(2, 'Indah Lestari', 'Jln. Mada, jember', '089556773445', 2, 'Admin1', 'Admin1'),
(4, 'Kartika Ayu', 'Jln.Agus Salim No.43', '089765342516', 2, 'Admin212', 'Admin212');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`Barang_ID`),
  ADD KEY `Kategori_ID` (`Kategori_ID`),
  ADD KEY `ID_Supplier` (`ID_Supplier`);

--
-- Indexes for table `detailpembelian`
--
ALTER TABLE `detailpembelian`
  ADD PRIMARY KEY (`ID_DetailPembelian`),
  ADD KEY `Pembelian_ID` (`Pembelian_ID`),
  ADD KEY `Barang_ID` (`Barang_ID`);

--
-- Indexes for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD PRIMARY KEY (`ID_detailPenjualan`),
  ADD KEY `ID_Penjualan` (`ID_Penjualan`),
  ADD KEY `Barang_ID` (`Barang_ID`);

--
-- Indexes for table `incomingclaim`
--
ALTER TABLE `incomingclaim`
  ADD PRIMARY KEY (`Klaim_ID`),
  ADD KEY `Barang_ID` (`Barang_ID`);

--
-- Indexes for table `jenis_user`
--
ALTER TABLE `jenis_user`
  ADD PRIMARY KEY (`JenisUser_ID`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`Kategori_ID`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`Pelanggan_ID`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`Pembelian_ID`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`ID_Penjualan`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Pelanggan_ID` (`Pelanggan_ID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID_Supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `JenisUser_ID` (`JenisUser_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailpembelian`
--
ALTER TABLE `detailpembelian`
  MODIFY `ID_DetailPembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  MODIFY `ID_detailPenjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `jenis_user`
--
ALTER TABLE `jenis_user`
  MODIFY `JenisUser_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `Pelanggan_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3555;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`Kategori_ID`) REFERENCES `kategori` (`Kategori_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`ID_Supplier`) REFERENCES `supplier` (`ID_Supplier`) ON UPDATE CASCADE;

--
-- Constraints for table `detailpembelian`
--
ALTER TABLE `detailpembelian`
  ADD CONSTRAINT `detailpembelian_ibfk_2` FOREIGN KEY (`Pembelian_ID`) REFERENCES `pembelian` (`Pembelian_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detailpembelian_ibfk_3` FOREIGN KEY (`Barang_ID`) REFERENCES `barang` (`Barang_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD CONSTRAINT `detailpenjualan_ibfk_2` FOREIGN KEY (`ID_Penjualan`) REFERENCES `penjualan` (`ID_Penjualan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detailpenjualan_ibfk_3` FOREIGN KEY (`Barang_ID`) REFERENCES `barang` (`Barang_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `incomingclaim`
--
ALTER TABLE `incomingclaim`
  ADD CONSTRAINT `incomingclaim_ibfk_1` FOREIGN KEY (`Barang_ID`) REFERENCES `barang` (`Barang_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_5` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_ibfk_6` FOREIGN KEY (`Pelanggan_ID`) REFERENCES `pelanggan` (`Pelanggan_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`JenisUser_ID`) REFERENCES `jenis_user` (`JenisUser_ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
