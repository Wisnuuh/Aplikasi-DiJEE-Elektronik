-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 03:15 PM
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
  `Barang_ID` int(11) NOT NULL,
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
(1, 'Lampu Led Maxxis 20W', 1, '', 15000, 17500, 1, 1),
(2, 'Lampu Philips Led 10W', 2, '1 hari', 45000, 50000, 1, 2),
(3, 'Aper Lebar Lubang Besar', 3, '2 bulan', 2000, 5000, 2, 5),
(4, 'Aper Lubang Besar', 2, '', 3000, 5000, 2, 5),
(5, 'Aper Lubang Kecil/Besar', 5, '', 3000, 5000, 2, 5),
(6, 'Aper Maspion Hitam', 4, '', 2750, 5000, 2, 5),
(7, 'Aqua 1500ml', 8, '', 4000, 5000, 3, 3),
(8, 'Aqua 600ml', 7, '', 2000, 3000, 3, 3),
(9, 'Aqua Air Galon', 4, '', 18200, 20000, 3, 3),
(10, 'Aqua Galon Kosong', 5, '', 30000, 35000, 3, 3),
(11, 'Aqua Gelas 240ml', 10, '', 21700, 25000, 3, 3),
(12, 'Arde Besar', 5, '', 27500, 32000, 4, 4),
(13, 'Arde Kecil', 2, '', 9000, 15000, 4, 4),
(14, 'Arde Tanggung', 5, '', 13500, 17500, 4, 4),
(15, 'Arpus Soder', 3, '', 2500, 4000, 5, 6),
(16, 'Arpus Soder Kuning', 5, '', 3000, 5000, 5, 6),
(17, 'Avr Genset Specktek', 4, '', 38000, 100000, 6, 7),
(18, 'Avr Genset Yamamoto', 5, '', 45000, 125000, 6, 7),
(19, 'Box Adaptor 1A', 9, '', 3750, 6000, 7, 8),
(20, 'Box Adaptor 3A', 10, '', 6500, 10000, 7, 8),
(21, 'Box Adaptor 5A', 3, '', 7000, 12500, 7, 8),
(22, 'Box Ampli AG 02', 4, '', 46000, 60000, 8, 8),
(23, 'Box Ampli AG 03', 3, '', 47000, 60000, 8, 8),
(24, 'Box Ampli AG 04', 5, '', 46000, 60000, 8, 8),
(25, 'Box Ampli Besar', 5, '', 57500, 75000, 8, 8),
(26, 'Box Ampli Humer 200', 5, '', 70000, 85000, 8, 8),
(27, 'Box Ampli SJ1000', 1, '', 170000, 200000, 8, 8),
(28, 'Box Ampli SJ500', 5, '', 64000, 80000, 8, 8),
(29, 'Tango', 3, '1 tahun', 5000, 10000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detailpembelian`
--

CREATE TABLE `detailpembelian` (
  `ID_DetailPembelian` int(11) NOT NULL,
  `Barang_ID` int(11) NOT NULL,
  `Pembelian_ID` int(11) NOT NULL,
  `Jumlah` int(16) DEFAULT NULL,
  `subTotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detailpembelian`
--

INSERT INTO `detailpembelian` (`ID_DetailPembelian`, `Barang_ID`, `Pembelian_ID`, `Jumlah`, `subTotal`) VALUES
(1, 1, 1, 5, 75000),
(2, 2, 2, 5, 225000),
(3, 3, 3, 5, 10000),
(4, 4, 4, 5, 15000),
(5, 5, 5, 5, 15000),
(6, 6, 6, 5, 13750),
(7, 7, 7, 10, 40000),
(8, 8, 8, 10, 20000),
(9, 9, 9, 5, 91000),
(10, 10, 10, 5, 150000),
(11, 11, 11, 10, 217000),
(12, 12, 12, 5, 137500),
(13, 13, 13, 5, 45000),
(14, 14, 14, 5, 67500),
(15, 15, 15, 5, 12500),
(16, 16, 16, 5, 15000),
(17, 17, 17, 5, 190000),
(18, 18, 18, 5, 225000),
(19, 19, 19, 10, 37500),
(20, 20, 20, 10, 65000),
(21, 21, 21, 5, 35000),
(22, 22, 22, 5, 230000),
(23, 23, 23, 5, 235000),
(24, 24, 24, 5, 230000),
(25, 25, 25, 5, 287500),
(26, 26, 26, 5, 350000),
(27, 27, 27, 2, 340000),
(28, 28, 28, 5, 320000),
(29, 29, 29, 5, 25000);

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
  `Barang_ID` int(11) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `subTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detailpenjualan`
--

INSERT INTO `detailpenjualan` (`ID_detailPenjualan`, `ID_Penjualan`, `Barang_ID`, `Jumlah`, `subTotal`) VALUES
(1, 1, 1, 2, 35000),
(2, 2, 9, 1, 20000),
(3, 3, 7, 2, 10000),
(4, 3, 8, 3, 9000),
(5, 4, 4, 1, 5000),
(6, 4, 6, 1, 5000),
(7, 5, 3, 2, 10000),
(8, 5, 4, 2, 10000),
(9, 6, 2, 2, 100000),
(10, 7, 17, 1, 100000),
(11, 8, 15, 2, 8000),
(12, 8, 21, 2, 25000),
(13, 8, 19, 1, 6000),
(14, 9, 22, 1, 60000),
(15, 9, 23, 2, 120000),
(16, 10, 13, 3, 45000),
(17, 11, 2, 1, 50000),
(18, 12, 29, 2, 20000),
(19, 13, 27, 1, 200000),
(20, 14, 1, 1, 17500),
(21, 15, 1, 1, 17500);

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
  `Barang_ID` int(11) NOT NULL,
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
(1, 3, 'Aper Lebar Lubang Besar', 1, '2023-05-23', '2023-07-23', 'barang rusak dan kabel putus');

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
(1, '2023-08-25', 75000),
(2, '2023-08-25', 225000),
(3, '2023-08-28', 10000),
(4, '2023-08-28', 15000),
(5, '2023-08-28', 15000),
(6, '2023-08-28', 13750),
(7, '2023-09-02', 40000),
(8, '2023-09-02', 20000),
(9, '2023-09-02', 91000),
(10, '2023-09-02', 150000),
(11, '2023-09-03', 217000),
(12, '2023-10-03', 137500),
(13, '2023-10-03', 45000),
(14, '2023-10-03', 67500),
(15, '2023-10-03', 12500),
(16, '2023-10-03', 15000),
(17, '2023-10-03', 190000),
(18, '2023-10-03', 225000),
(19, '2023-11-03', 37500),
(20, '2023-11-03', 65000),
(21, '2023-11-03', 35000),
(22, '2023-11-03', 230000),
(23, '2023-11-03', 235000),
(24, '2023-11-03', 230000),
(25, '2023-12-03', 287500),
(26, '2023-12-03', 350000),
(27, '2023-12-03', 340000),
(28, '2023-12-03', 320000),
(29, '2023-12-03', 25000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `ID_Penjualan` int(11) NOT NULL,
  `Tgl_Penjualan` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `pembayaran` int(11) DEFAULT NULL,
  `uangKembalian` int(11) DEFAULT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`ID_Penjualan`, `Tgl_Penjualan`, `total`, `pembayaran`, `uangKembalian`, `User_ID`) VALUES
(1, '2023-09-01', 35000, 50000, 15000, 3),
(2, '2023-09-01', 20000, 20000, 0, 3),
(3, '2023-09-05', 19000, 20000, 1000, 3),
(4, '2023-09-06', 10000, 20000, 10000, 2),
(5, '2023-09-06', 20000, 20000, 0, 2),
(6, '2023-09-06', 100000, 100000, 0, 2),
(7, '2023-09-06', 100000, 100000, 0, 2),
(8, '2023-10-11', 39000, 50000, 11000, 2),
(9, '2023-10-19', 180000, 200000, 20000, 2),
(10, '2023-11-15', 45000, 50000, 5000, 2),
(11, '2023-11-26', 50000, 100000, 50000, 2),
(12, '2023-12-02', 20000, 50000, 30000, 2),
(13, '2023-12-18', 200000, 200000, 0, 2),
(14, '2023-12-19', 17500, 20000, 2500, 2),
(15, '2023-12-20', 17500, 20000, 2500, 2);

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
(3, 'Kartika Ayu', 'Jln.Agus Salim No.43', '089765342516', 2, 'Admin212', 'Admin212');

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
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`Pembelian_ID`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`ID_Penjualan`),
  ADD KEY `User_ID` (`User_ID`);

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
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `Barang_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `detailpembelian`
--
ALTER TABLE `detailpembelian`
  MODIFY `ID_DetailPembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  MODIFY `ID_detailPenjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jenis_user`
--
ALTER TABLE `jenis_user`
  MODIFY `JenisUser_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `Pembelian_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `ID_Penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID_Supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`Kategori_ID`) REFERENCES `kategori` (`Kategori_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_supplier` FOREIGN KEY (`ID_Supplier`) REFERENCES `supplier` (`ID_Supplier`) ON UPDATE CASCADE;

--
-- Constraints for table `detailpembelian`
--
ALTER TABLE `detailpembelian`
  ADD CONSTRAINT `detailPembelianBarang` FOREIGN KEY (`Barang_ID`) REFERENCES `barang` (`Barang_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detailPembelianPembelian` FOREIGN KEY (`Pembelian_ID`) REFERENCES `pembelian` (`Pembelian_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD CONSTRAINT `detailPenjualanBarang` FOREIGN KEY (`Barang_ID`) REFERENCES `barang` (`Barang_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualanDetailPenjualan` FOREIGN KEY (`ID_Penjualan`) REFERENCES `penjualan` (`ID_Penjualan`) ON UPDATE CASCADE;

--
-- Constraints for table `incomingclaim`
--
ALTER TABLE `incomingclaim`
  ADD CONSTRAINT `claimBarang` FOREIGN KEY (`Barang_ID`) REFERENCES `barang` (`Barang_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_5` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`JenisUser_ID`) REFERENCES `jenis_user` (`JenisUser_ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
