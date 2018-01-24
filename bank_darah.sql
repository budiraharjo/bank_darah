-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2018 at 03:56 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bank_darah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama`, `level`) VALUES
(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 1),
(2, 'petugassatu', '21232f297a57a5a743894a0e4a801fc3', 'Petugas', 2);

-- --------------------------------------------------------

--
-- Table structure for table `darah`
--

CREATE TABLE IF NOT EXISTS `darah` (
  `id_darah` int(15) NOT NULL AUTO_INCREMENT,
  `golongan` varchar(10) NOT NULL,
  `ukuran` varchar(25) NOT NULL,
  `harga` int(15) NOT NULL,
  `stok` int(10) NOT NULL,
  `jenis` varchar(25) NOT NULL,
  PRIMARY KEY (`id_darah`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `darah`
--

INSERT INTO `darah` (`id_darah`, `golongan`, `ukuran`, `harga`, `stok`, `jenis`) VALUES
(1, 'A', '15', 50000, 12, 'Fresh'),
(2, 'B', '500', 8000, 7, 'Fresh'),
(3, 'AB', '200', 75000, 10, 'Fresh');

-- --------------------------------------------------------

--
-- Table structure for table `distributor`
--

CREATE TABLE IF NOT EXISTS `distributor` (
  `id_distributor` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `nama` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `jenis_kelamin` varchar(32) CHARACTER SET latin1 DEFAULT NULL,
  `nip` int(11) DEFAULT NULL,
  `nama_instansi` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `no_reg_instansi` int(20) DEFAULT NULL,
  `alamat` text CHARACTER SET latin1,
  `telp` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_distributor`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `distributor`
--

INSERT INTO `distributor` (`id_distributor`, `username`, `password`, `nama`, `jenis_kelamin`, `nip`, `nama_instansi`, `no_reg_instansi`, `alamat`, `telp`) VALUES
(6, 'Ibnu', '95ea6a3742afe40417810ba13d6f1e0a', 'Ibnu Hajar', 'Laki-laki', 855545444, 'Puskesmas Menes', 2147483647, 'Jl. Ahmad Yani Alun-alun Menes', '085210484755');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE IF NOT EXISTS `keranjang` (
  `id_keranjang` int(25) NOT NULL AUTO_INCREMENT,
  `id_distributor` int(25) NOT NULL,
  `id_darah` int(25) NOT NULL,
  `banyaknya` int(25) NOT NULL,
  `total` int(30) NOT NULL,
  PRIMARY KEY (`id_keranjang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE IF NOT EXISTS `konfirmasi` (
  `id_konfirmasi` int(25) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(25) NOT NULL,
  `id_distributor` int(25) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `tanggal` varchar(25) NOT NULL,
  PRIMARY KEY (`id_konfirmasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_konfirmasi`, `id_penjualan`, `id_distributor`, `foto`, `keterangan`, `tanggal`) VALUES
(1, 1, 6, '12012018143240Struk-Transfer.jpg', 'Kirim/Lunas', '2018-01-12'),
(2, 3, 6, '16012018063037jamur-bulan.jpg', 'Kirim/Lunas', '2018-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` varchar(10) DEFAULT NULL,
  `id_keranjang` varchar(8) DEFAULT NULL,
  `id_distributor` varchar(8) DEFAULT NULL,
  `id_darah` varchar(8) DEFAULT NULL,
  `banyaknya` int(8) DEFAULT NULL,
  `total` int(30) NOT NULL,
  `tanggal` int(8) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_keranjang`, `id_distributor`, `id_darah`, `banyaknya`, `total`, `tanggal`, `status`) VALUES
('1', '1', '6', '1', 1, 50000, 2018, 'Kirim/Lunas'),
('1', '1', '6', '1', 1, 50000, 2018, 'Kirim/Lunas'),
('1', '1', '6', '1', 1, 50000, 2018, 'Kirim/Lunas'),
('2', '1', '6', '1', 5, 250000, 2018, 'Kirim/Lunas'),
('2', '2', '6', '2', 2, 16000, 2018, 'Kirim/Lunas'),
('3', '1', '6', '1', 1, 50000, 2018, 'Kirim/Lunas');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
