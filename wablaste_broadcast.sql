-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2018 at 03:27 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_broadcast`
--

-- --------------------------------------------------------

--
-- Table structure for table `databroadcast`
--

CREATE TABLE `databroadcast` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `waktu` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `target` varchar(50) NOT NULL,
  `operator` varchar(20) NOT NULL,
  `prefix` varchar(20) NOT NULL,
  `jenis_kartu` varchar(20) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `databroadcast`
--

INSERT INTO `databroadcast` (`id`, `nama`, `tanggal`, `waktu`, `jumlah`, `target`, `operator`, `prefix`, `jenis_kartu`, `status`) VALUES
(1, 'Beauty Sky', '2018-06-12', '20:00', 1000, 'Siswa', 'Simpati', 'Telkomsel', '909', '1'),
(2, 'Beuty White', '2018-06-14', '20:01', 200, 'Test', 'M3', 'Indosat', '212', '0');

-- --------------------------------------------------------

--
-- Table structure for table `isicontent`
--

CREATE TABLE `isicontent` (
  `id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `asset` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `broadcast_id` int(11) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `revisi` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `isicontent`
--

INSERT INTO `isicontent` (`id`, `content`, `asset`, `broadcast_id`, `status`, `revisi`) VALUES
(2, 'Hati bagai SKRIPSI yang mesti harus diuji, seperti MAKALAH yang tentu banyak salah, seperti KURIKULUM yang harus dimaklum, perlu STRATEGI dan PEMBELAJARAN untuk perbaikan, Tanpa SILABUS dan INDIKATOR yang bagus, hati akan kotor. Sebagai APERSEPSI menyambut datangnya fitri, disampaikan permohonan maaf dengan KOMPETENSI DASAR menggali makna Taqaballahu minna wa minkum, minal aidzin wal faizin mohon maaf lahir serta bathin', '3180.png', 1, NULL, 'Perlu diperbaiki gambar nya yang lebih bagus');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `level`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$e7vg4yqsn/Oy/SsJdJieguYQZ8.mOfzBDLH0/mWDPIEgpuWcn4zA6', 'NbakN8cZPnShSaxQF5UPecLMbmEaRwdgZUhy9zVzYBpJYQwdTMgNx8NXHhYw', '2018-06-01 23:08:34', '2018-06-01 23:08:34', '1'),
(2, 'headadmin', 'headadmin@gmail.com', '$2y$10$DFKUsNVwrwyLjbjOeJiMqORHML/c/szULx9jizM7rXMIpVUoaqwue', 'G5xQ3kKx0M8L0DPcxRs18p3NUrANa0KHiiz0KBgz9kSEmNhMDICmsbUNp8Sj', '2018-06-03 02:51:17', '2018-06-03 02:51:17', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `databroadcast`
--
ALTER TABLE `databroadcast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `isicontent`
--
ALTER TABLE `isicontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `databroadcast`
--
ALTER TABLE `databroadcast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `isicontent`
--
ALTER TABLE `isicontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
