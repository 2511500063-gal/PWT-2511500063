-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2026 at 07:11 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jadwal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_user` int(11) NOT NULL,
  `Nama_lengkap` varchar(50) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_user`, `Nama_lengkap`, `Username`, `Password`) VALUES
(1, 'Delpiah Wahyuningsih', 'admin', '12345'),
(2, 'Nayaka Jibran', 'siswa', '12345'),
(3, 'Eka Firman', 'guru', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `Kd_guru` varchar(5) NOT NULL,
  `Nm_guru` varchar(50) NOT NULL,
  `Jenkel` varchar(10) NOT NULL,
  `Pend_terakhir` varchar(20) NOT NULL,
  `Hp` varchar(13) NOT NULL,
  `Alamat` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`Kd_guru`, `Nm_guru`, `Jenkel`, `Pend_terakhir`, `Hp`, `Alamat`, `password`) VALUES
('G001', 'nayakakk', 'L', 'S1', '98123547646', 'jl. selindung', '12345'),
('G001', 'nayaka', 'L', 'S2', '98123547646', 'toboali\r\n', '12345'),
('G002', 'nayaka', 'L', 'S1', '98123547646', 'seee', '12345'),
('G003', 'guru', 'L', 'S1', '98123547646', 'toboali', '12345'),
('G004', 'nayaka', 'L', 'S1', '98123547646', 'toboali', '12345'),
('G005', 'nayaka', 'L', 'S1', '98123547646', 'toboali', '12345'),
('G005', 'nayaka', 'L', 'S1', '98123547646', 'toboali', '12345'),
('G006', 'nayaka', 'L', 'S1', '98123547646', 'toboali', '12345'),
('G007', 'adila agustia', 'L', 's3', '98123547646', 'gsdgdvgdfgd', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `Id_kelas` int(11) NOT NULL,
  `Nm_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`Id_kelas`, `Nm_kelas`) VALUES
(222, 'ti2b'),
(3, 'yue'),
(3, 'nayakaa');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `kd_mapel` varchar(5) NOT NULL,
  `nm_mapel` varchar(35) DEFAULT NULL,
  `kkm` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`kd_mapel`, `nm_mapel`, `kkm`) VALUES
('BHS2', 'BAHASA MINANG', 75),
('gitar', 'gitar klasik', 75),
('M-001', 'bahasa nayaka', 50),
('M-004', 'ADILA CANTIK BANGETTTTTTTTTTTTT', 100),
('M-005', 'bahasa nayaka', 67);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'Nayaka Jibran', '12345', 'admin'),
(2, 'adiila', '12345', 'guru'),
(3, 'guru', '1234', 'guru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`kd_mapel`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
