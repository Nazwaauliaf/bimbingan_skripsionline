-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2026 at 05:36 PM
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
-- Database: `bimbingan_skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan`
--

CREATE TABLE `bimbingan` (
  `id_bimbingan` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `angkatan` varchar(10) DEFAULT NULL,
  `topik` varchar(150) NOT NULL,
  `catatan` text NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('menunggu','disetujui','revisi') DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bimbingan`
--

INSERT INTO `bimbingan` (`id_bimbingan`, `id_mahasiswa`, `nama`, `nim`, `jurusan`, `angkatan`, `topik`, `catatan`, `tanggal`, `status`) VALUES
(0, 11, 'Fitri Aulia', '1223', 'PSTI', '2023', 'Analisis Kurikulum Merdeka dalam Mengatasi Learning Loss', 'Silahkan lanjut ke Bab berikutnya', '2026-01-05', 'disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `nim` varchar(150) NOT NULL,
  `jurusan` varchar(200) NOT NULL,
  `angkatan` varchar(100) NOT NULL,
  `topik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('dosen','mahasiswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nim`, `email`, `foto`, `password`, `role`) VALUES
(7, 'nazwa aulia', NULL, NULL, NULL, '$2y$10$F4QlGJ3uyxsr.nNBdXp2UetlU0CK2KY4P8.GHHv9/kqxr3/MGyqCq', 'mahasiswa'),
(8, 'Randy Pamungkas', '22345', 'randy@upi.edu', '695a712968760.png', '$2y$10$lVXI9Rdl9uOeUc3.k.QYj.eN7dyzmT1F0cV.LnQ8qcOFUHUjY6dsq', 'dosen'),
(9, 'sarah aulia', NULL, NULL, NULL, '$2y$10$5xTp.xMLMPom9sCcIF4BfOKaVHnXKQpOFCtp93iL9VvepU9Pw84K6', 'mahasiswa'),
(10, 'Arkan Purnama', '2323', 'arkan@upi.edu', '695a93f5180b3.png', '$2y$10$tZFq01Aw1pGSbXpvcoHsl.WH6t401hkK4pqBXGlT3B4DEtcPwbJRS', 'mahasiswa'),
(11, 'Putri Lestari', '1332', 'nazwa@upi.edu', NULL, '$2y$10$0LZ/bxoLG.1rYujKmebYmuZjrL/YfsK01AZkOfOesC2sJ6dwM9LEC', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bimbingan`
--
ALTER TABLE `bimbingan`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
