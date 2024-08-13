-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 02:36 AM
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
  `id_wilayah` int(11) NOT NULL,
  `laki_laki_sangat_puas` int(11) NOT NULL,
  `laki_laki_puas` int(11) NOT NULL,
  `laki_laki_kurang_puas` int(11) NOT NULL,
  `perempuan_sangat_puas` int(11) NOT NULL,
  `perempuan_puas` int(11) NOT NULL,
  `perempuan_kurang_puas` int(11) NOT NULL,
  `total_responden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lulusan`
--

CREATE TABLE `lulusan` (
  `id` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `sd_sangat_puas` int(11) NOT NULL,
  `sd_puas` int(11) NOT NULL,
  `sd_kurang_puas` int(11) NOT NULL,
  `smp_sangat_puas` int(11) NOT NULL,
  `smp_puas` int(11) NOT NULL,
  `smp_kurang_puas` int(11) NOT NULL,
  `sma_sangat_puas` int(11) NOT NULL,
  `sma_puas` int(11) NOT NULL,
  `sma_kurang_puas` int(11) NOT NULL,
  `diploma_sangat_puas` int(11) NOT NULL,
  `diploma_puas` int(11) NOT NULL,
  `diploma_kurang_puas` int(11) NOT NULL,
  `sarjana_sangat_puas` int(11) NOT NULL,
  `sarjana_puas` int(11) NOT NULL,
  `sarjana_kurang_puas` int(11) NOT NULL,
  `total_responden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profesi`
--

CREATE TABLE `profesi` (
  `id` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `pns_sangat_puas` int(11) NOT NULL,
  `pns_puas` int(11) NOT NULL,
  `pns_kurang_puas` int(11) NOT NULL,
  `swasta_wiraswasta_sangat_puas` int(11) NOT NULL,
  `swasta_wiraswasta_puas` int(11) NOT NULL,
  `swasta_wiraswasta_kurang_puas` int(11) NOT NULL,
  `pelajar_mahasiswa_sangat_puas` int(11) NOT NULL,
  `pelajar_mahasiswa_puas` int(11) NOT NULL,
  `pelajar_mahasiswa_kurang_puas` int(11) NOT NULL,
  `pengangguran_sangat_puas` int(11) NOT NULL,
  `pengangguran_puas` int(11) NOT NULL,
  `pengangguran_kurang_puas` int(11) NOT NULL,
  `total_responden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `keterangan` varchar(999) NOT NULL,
  `image` blob NOT NULL,
  `id_wilayah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usia`
--

CREATE TABLE `usia` (
  `id` int(11) NOT NULL,
  `id_wilayah` int(11) NOT NULL,
  `18_35_sangat_puas` int(11) NOT NULL,
  `18_35_puas` int(11) NOT NULL,
  `18_35_kurang_puas` int(11) NOT NULL,
  `36_up_sangat_puas` int(11) NOT NULL,
  `36_up_puas` int(11) NOT NULL,
  `36_up_kurang_puas` int(11) NOT NULL,
  `total_responden` int(11) NOT NULL
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_wilayah` (`id_wilayah`);

--
-- Indexes for table `lulusan`
--
ALTER TABLE `lulusan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_wilayah` (`id_wilayah`);

--
-- Indexes for table `profesi`
--
ALTER TABLE `profesi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_wilayah` (`id_wilayah`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_wilayah` (`id_wilayah`);

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
