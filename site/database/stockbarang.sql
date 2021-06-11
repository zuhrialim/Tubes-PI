-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2021 at 10:11 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `kategori` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `kategori`) VALUES
(3, 'Monitor'),
(4, 'PSU'),
(6, 'Graphic Card'),
(8, 'RAM'),
(11, 'Kursi gaming'),
(14, 'Pak de');

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(25) NOT NULL,
  `qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `penerima`, `qty`) VALUES
(18, 60, '2021-06-10 16:27:30', 'Alem', 2),
(19, 56, '2021-06-11 05:10:51', 'Alem', 1),
(20, 63, '2021-06-11 05:11:12', 'Alem', 2),
(21, 65, '2021-05-11 13:29:59', 'Alem', 1),
(22, 65, '2021-06-11 13:30:17', 'nizam', 1),
(24, 74, '2021-06-11 19:26:56', 'HOETANK KOH', 3),
(25, 74, '2021-06-11 19:27:37', 'ATLET BERHUTANG', 2),
(26, 69, '2021-06-11 19:29:27', 'Wikel', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `username`, `password`, `role`) VALUES
(1, 'jepara', 'jepara', 'admin'),
(6, 'staff', 'staff', 'staff'),
(15, 'hoetank', '123', 'admin'),
(16, 'makeacar', '123', 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `idsup` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(25) DEFAULT NULL,
  `qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `idsup`, `tanggal`, `keterangan`, `qty`) VALUES
(77, 58, 10, '2021-06-10 16:02:10', '', 2),
(81, 60, 10, '2021-06-10 16:28:17', '', 1),
(82, 63, 10, '2021-06-11 05:10:47', '', 2),
(92, 74, 12, '2021-06-11 19:25:57', '', 5),
(93, 74, 12, '2021-06-11 19:26:07', '', 3),
(94, 74, 12, '2021-06-11 19:26:16', '', 5),
(95, 69, 12, '2021-06-11 19:29:39', '', 2),
(96, 65, 10, '2021-06-11 19:30:30', '', 2),
(97, 65, 12, '2021-06-11 19:49:06', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `deskripsi` varchar(25) NOT NULL,
  `stock` int(20) NOT NULL,
  `image` varchar(99) DEFAULT NULL,
  `status` enum('pending','approve') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `idkategori`, `namabarang`, `deskripsi`, `stock`, `image`, `status`) VALUES
(64, 4, 'Kursi gaming 6', '<br />\r\n<b>Notice</b>:  U', 2, 'c9c0f43c253b85ba1f5361e4db4b701b.jpg', 'approve'),
(65, 3, 'NVIDIA MSI GTX 1660 Duper', '<br />\r\n<b>Notice</b>:  U', 5, '0e525a8fe22711a62f5693d6d63c8fb6.jpg', 'approve'),
(69, 3, 'Kursi gaming S', '<br />\r\n<b>Notice</b>:  U', 4, '3c9794e3680fe0da270d8ce8aade3c9e.png', 'approve'),
(74, 14, 'Yo ndak tau kok tanya saya', '<br />\r\n<b>Notice</b>:  U', 11, 'c0d6c57984d47523505d07d74a805b97.jpg', 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `idsup` int(11) NOT NULL,
  `supplier` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`idsup`, `supplier`) VALUES
(10, 'Intelligent System'),
(11, 'THE HASH SLINGING SLASHER'),
(12, 'ESEMKA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idsup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `idsup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
