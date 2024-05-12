-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2024 at 11:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_admin`
--

CREATE TABLE `mst_admin` (
  `username` varchar(20) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isactive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mst_admin`
--

INSERT INTO `mst_admin` (`username`, `fullname`, `password`, `isactive`) VALUES
('bagas', 'randybagas', '$2y$10$XG3gpiGiK9IUFfWo.TSnXOXhbClEhPbbYGvayDi9g9Ybl9xCTISzu', 1),
('fandy', 'fandydimas', '$2y$10$8JmY/jwxnbbO6dXACv8niuA3IirbnG4CVSOtQ.BNi4axT1gm19pC.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tst_absensi`
--

CREATE TABLE `tst_absensi` (
  `idabsensi` int(11) NOT NULL,
  `tgl_absensi` datetime NOT NULL,
  `nm_mahasiswa` varchar(30) NOT NULL,
  `matkul` varchar(30) NOT NULL,
  `nm_dosen` varchar(30) NOT NULL,
  `absensi` int(2) NOT NULL,
  `keterangan` text NOT NULL,
  `createdby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tst_absensi`
--

INSERT INTO `tst_absensi` (`idabsensi`, `tgl_absensi`, `nm_mahasiswa`, `matkul`, `nm_dosen`, `absensi`, `keterangan`, `createdby`) VALUES
(14, '2024-05-11 00:40:00', 'dimas', 'programming', 'defranka', 1, '', 'fandydimas'),
(15, '2024-05-13 00:46:00', 'aditya', 'programming', 'defranka', 2, 'masuk RS', 'fandydimas'),
(16, '2024-05-14 00:47:00', 'fajar saputra', 'design graphic', 'panji putra', 1, '', 'fandydimas'),
(17, '2024-05-14 00:49:00', 'doni setiawan', 'database', 'panji putra', 1, '', 'fandydimas'),
(18, '2024-05-15 00:50:00', 'anggun citra', 'akutansi', 'vena aulia', 1, '', 'fandydimas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_admin`
--
ALTER TABLE `mst_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tst_absensi`
--
ALTER TABLE `tst_absensi`
  ADD PRIMARY KEY (`idabsensi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tst_absensi`
--
ALTER TABLE `tst_absensi`
  MODIFY `idabsensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
