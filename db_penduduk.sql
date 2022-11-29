-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2021 at 11:40 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penduduk`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_identitas`
--

CREATE TABLE `tb_identitas` (
  `id` int(20) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nm_lngkp` varchar(100) NOT NULL,
  `tmp_lhr` varchar(50) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `jns_klmn` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_identitas`
--

INSERT INTO `tb_identitas` (`id`, `nik`, `nm_lngkp`, `tmp_lhr`, `tgl_lhr`, `jns_klmn`, `alamat`, `agama`, `pekerjaan`) VALUES
(78, '1111111111111112', 'Adhimas Riefky Tri Pangestu', 'Sleman', '2021-05-01', 'Laki-laki', 'Depok', 'Islam', 'Pelajar'),
(79, '1111111111111113', 'Afta Baktino Putra', 'Gunung Kidul', '2021-05-02', 'Laki-laki', 'Piyungan', 'Islam', 'UI Desainer'),
(80, '1111111111111114', 'Alfatih Widyadi Koeswoyo', 'Sleman', '2021-05-03', 'Laki-laki', 'Gamping', 'Islam', 'Freelance'),
(81, '1111111111111115', 'Amadhea Putri Rasikah Zaki', 'Jakarta', '2021-05-04', 'Perempuan', 'Depok', 'Islam', 'UI Desainer'),
(82, '1111111111111116', 'Ambar Setyawati', 'Sleman', '2021-05-07', 'Perempuan', 'Sleman', 'Islam', 'UI Desainer'),
(83, '1111111111111117', 'Andi Setianto', 'Bandung', '2021-05-08', 'Laki-laki', 'Pundong', 'Islam', 'Pelajar'),
(84, '1111111111111118', 'Andre Setyawan', 'Malan', '2021-04-28', 'Laki-laki', 'Yogyakarta', 'Islam', 'UI Desainer'),
(85, '1111111111111119', 'Claudio Hans Figo', 'Sleman', '2021-05-11', 'Laki-laki', 'Kalasan', 'Konghucu', 'Pelajar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_identitas`
--
ALTER TABLE `tb_identitas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_identitas`
--
ALTER TABLE `tb_identitas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
