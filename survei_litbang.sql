-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2024 at 06:45 PM
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
-- Database: `survei_litbang`
--

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `laki_laki_sangat_puas` int(11) NOT NULL DEFAULT 0,
  `laki_laki_puas` int(11) NOT NULL DEFAULT 0,
  `laki_laki_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `laki_laki_sangat_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `perempuan_sangat_puas` int(11) NOT NULL DEFAULT 0,
  `perempuan_puas` int(11) NOT NULL DEFAULT 0,
  `perempuan_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `perempuan_sangat_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `total_responden_laki_laki` int(11) NOT NULL DEFAULT 0,
  `total_responden_perempuan` int(11) NOT NULL DEFAULT 0,
  `total_responden_gender` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lulusan`
--

CREATE TABLE `lulusan` (
  `id` int(11) NOT NULL,
  `sd_sangat_puas` int(11) NOT NULL DEFAULT 0,
  `sd_puas` int(11) NOT NULL DEFAULT 0,
  `sd_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `sd_sangat_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `smp_sangat_puas` int(11) NOT NULL DEFAULT 0,
  `smp_puas` int(11) NOT NULL DEFAULT 0,
  `smp_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `smp_sangat_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `sma_sangat_puas` int(11) NOT NULL DEFAULT 0,
  `sma_puas` int(11) NOT NULL DEFAULT 0,
  `sma_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `sma_sangat_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `diploma_sangat_puas` int(11) NOT NULL DEFAULT 0,
  `diploma_puas` int(11) NOT NULL DEFAULT 0,
  `diploma_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `diploma_sangat_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `sarjana_sangat_puas` int(11) NOT NULL DEFAULT 0,
  `sarjana_puas` int(11) NOT NULL DEFAULT 0,
  `sarjana_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `sarjana_sangat_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `total_responden_sd` int(11) NOT NULL DEFAULT 0,
  `total_responden_smp` int(11) NOT NULL DEFAULT 0,
  `total_responden_sma` int(11) NOT NULL DEFAULT 0,
  `total_responden_diploma` int(11) NOT NULL DEFAULT 0,
  `total_responden_sarjana` int(11) NOT NULL DEFAULT 0,
  `total_responden_lulusan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profesi`
--

CREATE TABLE `profesi` (
  `id` int(11) NOT NULL,
  `pns_sangat_puas` int(11) NOT NULL DEFAULT 0,
  `pns_puas` int(11) NOT NULL DEFAULT 0,
  `pns_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `pns_sangat_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `swasta_wiraswasta_sangat_puas` int(11) NOT NULL DEFAULT 0,
  `swasta_wiraswasta_puas` int(11) NOT NULL DEFAULT 0,
  `swasta_wiraswasta_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `swasta_wiraswasta_sangat_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `pelajar_mahasiswa_sangat_puas` int(11) NOT NULL DEFAULT 0,
  `pelajar_mahasiswa_puas` int(11) NOT NULL DEFAULT 0,
  `pelajar_mahasiswa_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `pelajar_mahasiswa_sangat_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `pengangguran_sangat_puas` int(11) NOT NULL DEFAULT 0,
  `pengangguran_puas` int(11) NOT NULL DEFAULT 0,
  `pengangguran_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `pengangguran_sangat_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `total_responden_pns` int(11) NOT NULL DEFAULT 0,
  `total_responden_swasta_wiraswasta` int(11) NOT NULL DEFAULT 0,
  `total_responden_pelajar_mahasiswa` int(11) NOT NULL DEFAULT 0,
  `total_responden_pengangguran` int(11) NOT NULL DEFAULT 0,
  `total_responden_profesi` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `keterangan` varchar(999) NOT NULL,
  `image` varchar(255) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `waktu_buat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usia`
--

CREATE TABLE `usia` (
  `id` int(11) NOT NULL,
  `18_35_sangat_puas` int(11) NOT NULL DEFAULT 0,
  `18_35_puas` int(11) NOT NULL DEFAULT 0,
  `18_35_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `18_35_sangat_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `36_up_sangat_puas` int(11) NOT NULL DEFAULT 0,
  `36_up_puas` int(11) NOT NULL DEFAULT 0,
  `36_up_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `36_up_sangat_kurang_puas` int(11) NOT NULL DEFAULT 0,
  `total_responden_18_35` int(11) NOT NULL DEFAULT 0,
  `total_responden_36_up` int(11) NOT NULL DEFAULT 0,
  `total_responden_usia` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id` int(11) NOT NULL,
  `nama_wilayah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id`, `nama_wilayah`) VALUES
(1, 'Lampung Barat'),
(2, 'Tanggamus'),
(3, 'Lampung Selatan'),
(4, 'Lampung Timur'),
(5, 'Lampung Tengah'),
(6, 'Lampung Utara'),
(7, 'Way Kanan'),
(8, 'Tulang Bawang'),
(9, 'Pesawaran'),
(10, 'Pringsewu'),
(11, 'Mesuji'),
(12, 'Tulang Bawang Barat'),
(13, 'Pesisir Barat'),
(14, 'Bandar Lampung'),
(15, 'Metro');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lulusan`
--
ALTER TABLE `lulusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profesi`
--
ALTER TABLE `profesi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_wilayah` (`id_wilayah`);

--
-- Indexes for table `usia`
--
ALTER TABLE `usia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lulusan`
--
ALTER TABLE `lulusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profesi`
--
ALTER TABLE `profesi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usia`
--
ALTER TABLE `usia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
