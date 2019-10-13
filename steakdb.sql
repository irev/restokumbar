-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2014 at 11:44 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `steakdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE IF NOT EXISTS `bahan` (
  `no_bahan` char(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `supplier` varchar(25) NOT NULL,
  PRIMARY KEY (`no_bahan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`no_bahan`, `nama`, `harga`, `stok`, `satuan`, `supplier`) VALUES
('B001', 'Avena Minyak Goreng 5 ltr', 63000, 8, 'PCS', 'Toko Haji Muhidin'),
('B002', 'Beras Ketan Hitam Curah /', 7000, 71, 'TON', 'Toko Haji Muhidin'),
('B003', 'Beras Ketan Putih Curah /', 9000, 1, 'CG', 'Toko Haji Muhidin'),
('B004', 'Bimoli Minyak Goreng Boto', 15000, 1, 'TON', 'Toko Haji Muhidin'),
('B005', 'Bimoli Minyak Goreng Klas', 25000, 1, 'PCS', 'Toko Haji Muhidin'),
('B006', 'Bimoli N.Kolesterol Jerig', 23000, 1, 'DAG', 'Toko Haji Muhidin'),
('B007', 'Bimoli Special Refil 2ltr', 26000, 1, 'DG', 'Toko Haji Muhidin'),
('B008', 'Bimoli Special Refill 1lt', 15000, 9, 'CG', 'Toko Haji Muhidin'),
('B009', 'Filma Minyak Goreng Non K', 13000, 1, 'ONS', 'Toko Haji Muhidin'),
('B010', 'Filma Refil 2 ltr (minyak goreng)', 26000, 1, 'DAG', 'Toko Haji Muhidin'),
('B011', 'Gula Merah Curah 1/2 Kg', 4000, 1, 'KG', 'Toko Haji Muhidin'),
('B012', 'Gula Merah Curah 1/4 Kg', 3000, 1, 'KG', 'Toko Haji Muhidin'),
('B013', 'Hemart & Higienis 1000ml', 11000, 1, 'KUINTAL', 'Toko Haji Muhidin'),
('B014', 'Hemart minyak goreng 2000', 21000, 1, 'BOTOL', 'Toko Haji Muhidin'),
('B015', 'Honig Macaroni 100gr', 7000, 1, 'DAG', 'Toko Haji Muhidin'),
('B016', 'Honig Macaroni 200gr', 7000, 1, 'ONS', 'Toko Haji Muhidin'),
('B017', 'Kunci Mas 1ltr', 12000, 1, 'KG', 'Toko Haji Muhidin'),
('B018', 'Kunci Mas Refill 2ltr ? p', 24000, 6, 'KUINTAL', 'Toko Haji Muhidin'),
('B019', 'Madina Minyak Goreng 1ltr', 12000, 1, 'KG', 'Toko Haji Muhidin'),
('B021', 'Madina Minyak Goreng 5ltr', 55000, 1, 'KG', 'Toko Haji Muhidin'),
('B022', 'Palma Minyak Goreng 2ltr ', 22000, 1, 'GRAM', 'Toko Haji Muhidin'),
('B023', 'Rose Brand Tepung Beras 5', 4000, 1, 'KG', 'Toko Haji Muhidin'),
('B024', 'Rose Brand Tepung Ketan P', 5000, 1, 'TON', 'Toko Haji Muhidin'),
('B025', 'Sania Minyak Goreng 2l tr', 25000, 1, 'DAG', 'Toko Haji Muhidin'),
('B026', 'Sania Minyak Goreng Non K', 25000, 1, 'PCS', 'Toko Haji Muhidin');

-- --------------------------------------------------------

--
-- Table structure for table `extra`
--

CREATE TABLE IF NOT EXISTS `extra` (
  `no_extra` char(4) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`no_extra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extra`
--

INSERT INTO `extra` (`no_extra`, `nama`, `harga`) VALUES
('EX01', 'Ekstra Keju', 2000),
('EX02', 'Ekstra Saus', 2000),
('EX03', 'Ekstra Sayuran', 2000),
('EX04', 'Nasi', 3000),
('EX05', 'Kentang Saus BBQ', 8000),
('EX06', 'Kentang Saus BBQ Keju', 9000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_menu`
--

CREATE TABLE IF NOT EXISTS `kategori_menu` (
  `no_kategori` char(2) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  PRIMARY KEY (`no_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_menu`
--

INSERT INTO `kategori_menu` (`no_kategori`, `kategori`, `keterangan`) VALUES
('DR', 'DRINKS', 'Daftar Aneka Minuman'),
('RO', 'ROASTED', 'Tanpa Tepung dan Dipanggang'),
('RS', 'RICE WITH SOUCE', 'Nasi Disiram Dengan Sauce Pilihan'),
('SC', 'SPICY AND CRYSPY', 'Dengan Tepung dan Digoreng'),
('SP', 'SPAGHETTI', 'Sphaghetti Pilihan');

-- --------------------------------------------------------

--
-- Table structure for table `level_pedas`
--

CREATE TABLE IF NOT EXISTS `level_pedas` (
  `no_level` char(4) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `cabe` int(11) NOT NULL,
  PRIMARY KEY (`no_level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level_pedas`
--

INSERT INTO `level_pedas` (`no_level`, `nama`, `harga`, `cabe`) VALUES
('L001', 'LEVEL 1', 0, 0),
('L002', 'LEVEL 2', 0, 1),
('L003', 'LEVEL 3', 0, 2),
('L004', 'LEVEL 4', 0, 3),
('L005', 'LEVEL 5', 1000, 4),
('L006', 'LEVEL 6', 2000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE IF NOT EXISTS `meja` (
  `no_meja` int(11) NOT NULL,
  `booking` char(1) NOT NULL,
  `tamu` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `kapasitas` int(11) NOT NULL,
  PRIMARY KEY (`no_meja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`no_meja`, `booking`, `tamu`, `tanggal`, `waktu`, `kapasitas`) VALUES
(1, 'n', '', '0000-00-00', '00:00:00', 5),
(2, 'n', '', '0000-00-00', '00:00:00', 3),
(4, 'n', '', '0000-00-00', '00:00:00', 3),
(7, 'n', '', '0000-00-00', '00:00:00', 13);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `no_menu` char(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `rekomendasi` char(1) NOT NULL,
  PRIMARY KEY (`no_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`no_menu`, `nama`, `kategori`, `harga`, `rekomendasi`) VALUES
('MDR00001', 'Air Mineral Botol', 'DRINKS', 3000, 'n'),
('MDR00002', 'Teh Botol / Fruit Tea', 'DRINKS', 4000, 'n'),
('MDR00003', 'Teh Susu ', 'DRINKS', 5000, 'n'),
('MDR00004', 'Teh Lemon ', 'DRINKS', 5000, 'n'),
('MDR00005', 'Susu  Cokelat / Putih', 'DRINKS', 6000, 'n'),
('MDR00006', 'White Coffee', 'DRINKS', 6000, 'n'),
('MDR00007', 'Cappuccino ', 'DRINKS', 6000, 'n'),
('MDR00008', 'Mochacino', 'DRINKS', 6000, 'n'),
('MDR00009', 'Jeruk Peres', 'DRINKS', 6000, 'n'),
('MDR00010', 'Jerus Peres Susu', 'DRINKS', 7000, 'n'),
('MDR00011', 'Teh Manis', 'DRINKS', 7000, 'n'),
('MDR00012', 'Teh  Thailand', 'DRINKS', 7000, 'n'),
('MDR00013', 'Mi LO', 'DRINKS', 7000, 'n'),
('MDR00014', 'Mocha Millo', 'DRINKS', 9000, 'n'),
('MDR00015', 'White Millo', 'DRINKS', 9000, 'n'),
('MDR00016', 'Cappuccino Millo', 'DRINKS', 9000, 'n'),
('MRO00001', 'Chicken Steak Panggang', 'ROASTED', 15000, 'y'),
('MRO00002', 'Sirloin Panggang', 'ROASTED', 16000, 'y'),
('MRO00003', 'Tenderloin Panggang', 'ROASTED', 17000, 'y'),
('MRS00001', 'Nasi Chicken Extra Souce', 'RICE WITH SOUCE', 17000, 'n'),
('MRS00002', 'Nasi Sirloin Extra Souce', 'RICE WITH SOUCE', 19000, 'n'),
('MRS00003', 'Nasi Tenderloin Extra Souce', 'RICE WITH SOUCE', 20000, 'n'),
('MSC00001', 'Chicken Crispy Spicy', 'SPICY AND CRYSPY', 16000, 'y'),
('MSC00002', 'Chicken Katsu Spicy', 'SPICY AND CRYSPY', 16000, 'y'),
('MSC00003', 'Sirloin Spicy', 'SPICY AND CRYSPY', 17000, 'y'),
('MSC00004', 'Tenderloin Spicy', 'SPICY AND CRYSPY', 18000, 'y'),
('MSC00005', 'Chicken Spicy', 'SPICY AND CRYSPY', 22000, 'y'),
('MSP00001', 'Spaghetti Chicken Katsu Cheese', 'SPAGHETTI', 17000, 'n'),
('MSP00002', 'Spaghetti Sirloin Cheese', 'SPAGHETTI', 19000, 'n'),
('MSP00003', 'Spaghetti Tenderloin Cheese', 'SPAGHETTI', 20000, 'n'),
('MSP00004', 'Spaghetti Bolognese Cheese', 'SPAGHETTI', 12000, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `no_pegawai` char(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_register` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `posisi` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `inisial` char(2) NOT NULL,
  PRIMARY KEY (`no_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`no_pegawai`, `password`, `nama_lengkap`, `tgl_lahir`, `tgl_register`, `gender`, `telp`, `posisi`, `alamat`, `inisial`) VALUES
('PCS14DD001', '43b93443937ea642a9a43e77fd5d8f77', 'Diki Daryatna', '2014-06-01', '2014-06-07', 'Pria', '9938383838', 'Casheir', 'Bandung', 'DD'),
('PCS14FF004', '', 'Fabian Frayudi', '2004-04-01', '2014-06-07', 'Pria', '9938383838', 'Casheir', 'Padalarang', 'FF'),
('PCS14IP002', '', 'Ivan Permana', '2014-06-02', '2014-06-07', 'Pria', '0988989898989', 'Casheir', 'Bandung', 'IP'),
('PCS14RD003', '', 'Rizki Dwi', '2014-04-01', '2014-06-07', 'Pria', '9938383838', 'Casheir', 'Bandung', 'RD'),
('PMG14JA001', '', 'Jupri Aji Zakaria', '2004-06-06', '2014-06-07', 'Pria', '9938383838', 'Manager', 'Subang', 'JA');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
  `no_pembayaran` char(10) NOT NULL,
  `no_bayar` varchar(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`no_pembayaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `no_pembelian` char(10) NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `supplier` varchar(35) NOT NULL,
  `item` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`no_pembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `no_struk` char(10) NOT NULL,
  `no_check` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `sub_total` int(11) NOT NULL,
  `diskon` float NOT NULL,
  `potongan` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `no_casheir` char(10) NOT NULL,
  PRIMARY KEY (`no_struk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no_struk`, `no_check`, `tanggal`, `waktu`, `sub_total`, `diskon`, `potongan`, `total_bayar`, `cash`, `kembalian`, `no_casheir`) VALUES
('JL14000001', 1, '2014-06-07', '11:23:26', 224000, 0, 0, 224000, 250000, 26000, 'PCS14DD001'),
('JL14000002', 2, '2014-06-07', '11:27:52', 788000, 0.1, 78800, 709200, 710000, 800, 'PCS14DD001'),
('JL14000003', 1, '2014-06-08', '21:03:52', 380000, 0.05, 19000, 361000, 370000, 9000, 'PCS14DD001'),
('JL14000004', 1, '2014-06-17', '23:23:10', 48000, 0, 0, 48000, 50000, 2000, 'PCS14DD001'),
('JL14000005', 1, '2014-06-25', '17:24:53', 228000, 0, 0, 228000, 300000, 72000, 'PCS14DD001'),
('JL14000006', 2, '2014-06-25', '19:50:51', 159000, 0, 0, 159000, 170000, 11000, 'PCS14DD001');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE IF NOT EXISTS `penjualan_detail` (
  `no_struk` char(10) NOT NULL,
  `tanggal` date NOT NULL,
  `item` varchar(50) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`no_struk`, `tanggal`, `item`, `kategori`, `harga`, `jumlah`, `total`) VALUES
('JL14000001', '2014-06-07', 'Spaghetti Sirloin Cheese', 'SPAGHETTI', 19000, 3, 57000),
('JL14000001', '2014-06-07', 'White Coffee', 'DRINKS', 6000, 2, 12000),
('JL14000001', '2014-06-07', 'Nasi Chicken Extra Souce', 'RICE WITH SOUCE', 17000, 2, 34000),
('JL14000001', '2014-06-07', 'Spaghetti Chicken Katsu Cheese', 'SPAGHETTI', 17000, 3, 51000),
('JL14000001', '2014-06-07', 'Susu  Cokelat / Putih', 'DRINKS', 6000, 2, 12000),
('JL14000001', '2014-06-07', 'Ekstra Sayuran', 'EXTRA TAMBAHAN', 2000, 2, 4000),
('JL14000001', '2014-06-07', 'Jerus Peres Susu', 'DRINKS', 7000, 2, 14000),
('JL14000001', '2014-06-07', 'Nasi Tenderloin Extra Souce', 'RICE WITH SOUCE', 20000, 2, 40000),
('JL14000002', '2014-06-07', 'Spaghetti Chicken Katsu Cheese', 'SPAGHETTI', 17000, 3, 51000),
('JL14000002', '2014-06-07', 'Nasi Sirloin Extra Souce', 'RICE WITH SOUCE', 19000, 5, 95000),
('JL14000002', '2014-06-07', 'Chicken Crispy Spicy', 'SPICY AND CRYSPY', 16000, 4, 64000),
('JL14000002', '2014-06-07', 'Sirloin Spicy', 'SPICY AND CRYSPY', 17000, 4, 68000),
('JL14000002', '2014-06-07', 'Nasi Tenderloin Extra Souce', 'RICE WITH SOUCE', 20000, 6, 120000),
('JL14000002', '2014-06-07', 'Nasi Chicken Extra Souce', 'RICE WITH SOUCE', 17000, 3, 51000),
('JL14000002', '2014-06-07', 'Chicken Katsu Spicy', 'SPICY AND CRYSPY', 16000, 5, 80000),
('JL14000002', '2014-06-07', 'Tenderloin Panggang', 'ROASTED', 17000, 5, 85000),
('JL14000002', '2014-06-07', 'Spaghetti Bolognese Cheese', 'SPAGHETTI', 12000, 4, 48000),
('JL14000002', '2014-06-07', 'White Coffee', 'DRINKS', 6000, 5, 30000),
('JL14000002', '2014-06-07', 'LEVEL 5', 'LEVEL PEDAS', 1000, 3, 3000),
('JL14000002', '2014-06-07', 'Ekstra Saus', 'EXTRA TAMBAHAN', 2000, 4, 8000),
('JL14000002', '2014-06-07', 'Air Mineral Botol', 'DRINKS', 3000, 4, 12000),
('JL14000002', '2014-06-07', 'Ekstra Sayuran', 'EXTRA TAMBAHAN', 2000, 5, 10000),
('JL14000002', '2014-06-07', 'Kentang Saus BBQ Keju', 'EXTRA TAMBAHAN', 9000, 3, 27000),
('JL14000002', '2014-06-07', 'Ekstra Keju', 'EXTRA TAMBAHAN', 2000, 6, 12000),
('JL14000002', '2014-06-07', 'Kentang Saus BBQ', 'EXTRA TAMBAHAN', 8000, 3, 24000),
('JL14000003', '2014-06-08', 'Nasi Tenderloin Extra Souce', 'RICE WITH SOUCE', 20000, 3, 60000),
('JL14000003', '2014-06-08', 'Sirloin Panggang', 'ROASTED', 16000, 2, 32000),
('JL14000003', '2014-06-08', 'Spaghetti Chicken Katsu Cheese', 'SPAGHETTI', 17000, 8, 136000),
('JL14000003', '2014-06-08', 'Nasi Sirloin Extra Souce', 'RICE WITH SOUCE', 19000, 4, 76000),
('JL14000003', '2014-06-08', 'Spaghetti Sirloin Cheese', 'SPAGHETTI', 19000, 4, 76000),
('JL14000004', '2014-06-17', 'Chicken Crispy Spicy', 'SPICY AND CRYSPY', 16000, 3, 48000),
('JL14000005', '2014-06-25', 'Spaghetti Chicken Katsu Cheese', 'SPAGHETTI', 17000, 6, 102000),
('JL14000005', '2014-06-25', 'Nasi Sirloin Extra Souce', 'RICE WITH SOUCE', 19000, 2, 38000),
('JL14000005', '2014-06-25', 'Sirloin Panggang', 'ROASTED', 16000, 3, 48000),
('JL14000005', '2014-06-25', 'Nasi Tenderloin Extra Souce', 'RICE WITH SOUCE', 20000, 2, 40000),
('JL14000006', '2014-06-25', 'Sirloin Spicy', 'SPICY AND CRYSPY', 17000, 3, 51000),
('JL14000006', '2014-06-25', 'Tenderloin Panggang', 'ROASTED', 17000, 3, 51000),
('JL14000006', '2014-06-25', 'Spaghetti Sirloin Cheese', 'SPAGHETTI', 19000, 3, 57000);

-- --------------------------------------------------------

--
-- Table structure for table `posisi`
--

CREATE TABLE IF NOT EXISTS `posisi` (
  `no_posisi` char(2) NOT NULL,
  `nama` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posisi`
--

INSERT INTO `posisi` (`no_posisi`, `nama`) VALUES
('MG', 'Manager'),
('CS', 'Casheir'),
('WT', 'Waiters'),
('CL', 'Cleaner');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_izin` varchar(20) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `pin_bb` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `facebook` varchar(30) NOT NULL,
  `twitter` varchar(30) NOT NULL,
  `owner` varchar(30) NOT NULL,
  `tgl_berdiri` date NOT NULL,
  `waktu_buka` time NOT NULL,
  `waktu_tutup` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id`, `no_izin`, `nama`, `alamat`, `no_telp`, `pin_bb`, `email`, `facebook`, `twitter`, `owner`, `tgl_berdiri`, `waktu_buka`, `waktu_tutup`) VALUES
(1, '08282828', 'STEAK RANJANG', 'Jl Dipatiukur No. 68 Bandung', '08122204761', '2B50BB10', 'StekRanjang@gmail.com', 'StekRanjang', '@StekRanjang', 'admin', '2014-05-01', '07:00:00', '07:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE IF NOT EXISTS `satuan` (
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`value`) VALUES
('ML'),
('KG'),
('MM'),
('LITER'),
('CG'),
('TON'),
('BOTOL'),
('GRAM'),
('DAG'),
('PCS'),
('KUINTAL');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `no_supplier` char(4) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `telp` varchar(14) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`no_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`no_supplier`, `nama`, `telp`, `alamat`) VALUES
('S001', 'Toko Haji Muhidin', '0898989899', 'Jln. Jengkol 12');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
