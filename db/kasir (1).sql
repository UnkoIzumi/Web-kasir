-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2023 at 08:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `ID_ABSENSI` int(11) NOT NULL,
  `ID_PEGAWAI` varchar(8) DEFAULT NULL,
  `TANGGAL_ABSENSI` date NOT NULL,
  `JAM_ABSENSI` time DEFAULT NULL,
  `KETERANGAN` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `ID_BARANG` int(11) NOT NULL,
  `NAMA_BARANG` varchar(50) NOT NULL,
  `DESKRIPSI_BARANG` text DEFAULT NULL,
  `HARGA_BELI` int(11) NOT NULL,
  `HARGA_JUAL` int(11) NOT NULL,
  `STOK_BARANG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detil_nota`
--

CREATE TABLE `detil_nota` (
  `ID_BARANG` int(11) NOT NULL,
  `ID_NOTA` varchar(50) NOT NULL,
  `ID_DETIL` int(11) NOT NULL,
  `JUMLAH_BARANG` int(11) NOT NULL,
  `TOTAL_HARGA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nota`
--

CREATE TABLE `nota` (
  `ID_NOTA` varchar(50) NOT NULL,
  `TOTAL_PENJUALAN` int(11) DEFAULT NULL,
  `JAM_PENJUALAN` time DEFAULT NULL,
  `TANGGAL_PENJUALAN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `ID_PEGAWAI` varchar(8) NOT NULL,
  `NAMA_PEGAWAI` varchar(50) NOT NULL,
  `NO__TELP` varchar(14) DEFAULT NULL,
  `ALAMAT` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `ID_PEMBELIAN` int(11) NOT NULL,
  `ID_BARANG` int(11) NOT NULL,
  `JUMLAH_PEMBELIAN` int(11) NOT NULL,
  `TOTAL_BAYAR` int(11) NOT NULL,
  `TANGGAL_PEMBELIAN` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `ID_USER` int(11) NOT NULL,
  `USERNAME` varchar(16) NOT NULL,
  `PASSWORD` varchar(16) NOT NULL,
  `NAMA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`ID_USER`, `USERNAME`, `PASSWORD`, `NAMA`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'Hilal', 'hilalala99', 'Hilal Abdullah'),
(3, 'kasir', 'kasir', 'kasir'),
(4, 'Fahmi', 'Fahmi', 'Ilham Fahmi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`ID_ABSENSI`),
  ADD KEY `FK_ABSENSI_RELATIONS_PEGAWAI` (`ID_PEGAWAI`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BARANG`);

--
-- Indexes for table `detil_nota`
--
ALTER TABLE `detil_nota`
  ADD PRIMARY KEY (`ID_BARANG`,`ID_NOTA`,`ID_DETIL`),
  ADD KEY `FK_DETIL_NO_RELATIONS_NOTA` (`ID_NOTA`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`ID_NOTA`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`ID_PEGAWAI`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`ID_PEMBELIAN`),
  ADD KEY `FK_PEMBELIA_RELATIONS_BARANG` (`ID_BARANG`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `ID_ABSENSI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `ID_BARANG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `ID_PEMBELIAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `FK_ABSENSI_RELATIONS_PEGAWAI` FOREIGN KEY (`ID_PEGAWAI`) REFERENCES `pegawai` (`ID_PEGAWAI`);

--
-- Constraints for table `detil_nota`
--
ALTER TABLE `detil_nota`
  ADD CONSTRAINT `FK_DETIL_NO_RELATIONS_BARANG` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`),
  ADD CONSTRAINT `FK_DETIL_NO_RELATIONS_NOTA` FOREIGN KEY (`ID_NOTA`) REFERENCES `nota` (`ID_NOTA`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `FK_PEMBELIA_RELATIONS_BARANG` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
