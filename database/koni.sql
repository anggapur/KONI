-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2018 at 02:06 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koni`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cabang_olahraga`
--

CREATE TABLE `cabang_olahraga` (
  `id_cabor` int(11) NOT NULL,
  `nama_cabor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_atlet`
--

CREATE TABLE `detail_atlet` (
  `id_detail` int(11) NOT NULL,
  `id_atlet` int(11) DEFAULT NULL,
  `id_np` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `nama_event` varchar(100) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `nama_foto` varchar(100) DEFAULT NULL,
  `ukuran_foto` int(11) DEFAULT NULL,
  `tipe_foto` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kabupaten` int(11) NOT NULL,
  `nama_kabupaten` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kontingen`
--

CREATE TABLE `kontingen` (
  `id_kontingen` int(11) NOT NULL,
  `nama_kontingen` varchar(100) DEFAULT NULL,
  `no_kartu_tanda_anggota` char(10) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `id_foto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_atlet`
--

CREATE TABLE `master_atlet` (
  `id_atlet` int(11) NOT NULL,
  `nama_atlet` varchar(100) NOT NULL,
  `id_cabor` int(11) NOT NULL,
  `no_kartu_tanda_anggota` char(10) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tinggi` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `id_kabupaten` int(11) DEFAULT NULL,
  `id_foto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `nomor_pertadingan`
--

CREATE TABLE `nomor_pertadingan` (
  `id_np` int(11) NOT NULL,
  `id_cabor` int(11) NOT NULL,
  `ket_np` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `id_atlet` int(11) NOT NULL,
  `nama_prestasi` varchar(50) NOT NULL,
  `id_cabor` int(11) NOT NULL,
  `id_np` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `waktu` date NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rekor_atlet`
--

CREATE TABLE `rekor_atlet` (
  `id_rekor` int(11) NOT NULL,
  `id_atlet` int(11) DEFAULT NULL,
  `keterangan_rekor` varchar(50) DEFAULT NULL,
  `id_cabor` int(11) DEFAULT NULL,
  `id_np` int(11) DEFAULT NULL,
  `id_event` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wasit`
--

CREATE TABLE `wasit` (
  `id_wasit` int(11) NOT NULL,
  `nama_wasit` varchar(100) DEFAULT NULL,
  `no_kartu_anggota` char(10) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `id_kabupaten` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `cabang_olahraga`
--
ALTER TABLE `cabang_olahraga`
  ADD PRIMARY KEY (`id_cabor`);

--
-- Indexes for table `detail_atlet`
--
ALTER TABLE `detail_atlet`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_atlet` (`id_atlet`),
  ADD KEY `id_np` (`id_np`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`);

--
-- Indexes for table `kontingen`
--
ALTER TABLE `kontingen`
  ADD PRIMARY KEY (`id_kontingen`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_kabupaten` (`id_kabupaten`),
  ADD KEY `id_foto` (`id_foto`);

--
-- Indexes for table `master_atlet`
--
ALTER TABLE `master_atlet`
  ADD PRIMARY KEY (`id_atlet`),
  ADD KEY `id_cabor` (`id_cabor`),
  ADD KEY `id_kabupaten` (`id_kabupaten`),
  ADD KEY `id_foto` (`id_foto`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor_pertadingan`
--
ALTER TABLE `nomor_pertadingan`
  ADD PRIMARY KEY (`id_np`),
  ADD KEY `id_cabor` (`id_cabor`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `id_atlet` (`id_atlet`,`id_cabor`,`id_np`,`id_event`),
  ADD KEY `id_cabor` (`id_cabor`),
  ADD KEY `id_np` (`id_np`),
  ADD KEY `id_event` (`id_event`);

--
-- Indexes for table `rekor_atlet`
--
ALTER TABLE `rekor_atlet`
  ADD PRIMARY KEY (`id_rekor`),
  ADD KEY `id_atlet` (`id_atlet`),
  ADD KEY `id_cabor` (`id_cabor`),
  ADD KEY `id_np` (`id_np`),
  ADD KEY `id_event` (`id_event`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wasit`
--
ALTER TABLE `wasit`
  ADD PRIMARY KEY (`id_wasit`),
  ADD KEY `id_kabupaten` (`id_kabupaten`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cabang_olahraga`
--
ALTER TABLE `cabang_olahraga`
  MODIFY `id_cabor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_atlet`
--
ALTER TABLE `detail_atlet`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id_kabupaten` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kontingen`
--
ALTER TABLE `kontingen`
  MODIFY `id_kontingen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_atlet`
--
ALTER TABLE `master_atlet`
  MODIFY `id_atlet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nomor_pertadingan`
--
ALTER TABLE `nomor_pertadingan`
  MODIFY `id_np` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekor_atlet`
--
ALTER TABLE `rekor_atlet`
  MODIFY `id_rekor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wasit`
--
ALTER TABLE `wasit`
  MODIFY `id_wasit` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_atlet`
--
ALTER TABLE `detail_atlet`
  ADD CONSTRAINT `detail_atlet_ibfk_1` FOREIGN KEY (`id_atlet`) REFERENCES `master_atlet` (`id_atlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_atlet_ibfk_2` FOREIGN KEY (`id_np`) REFERENCES `nomor_pertadingan` (`id_np`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kontingen`
--
ALTER TABLE `kontingen`
  ADD CONSTRAINT `kontingen_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kontingen_ibfk_2` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kontingen_ibfk_3` FOREIGN KEY (`id_foto`) REFERENCES `foto` (`id_foto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_atlet`
--
ALTER TABLE `master_atlet`
  ADD CONSTRAINT `master_atlet_ibfk_1` FOREIGN KEY (`id_cabor`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `master_atlet_ibfk_2` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `master_atlet_ibfk_3` FOREIGN KEY (`id_foto`) REFERENCES `foto` (`id_foto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nomor_pertadingan`
--
ALTER TABLE `nomor_pertadingan`
  ADD CONSTRAINT `nomor_pertadingan_ibfk_1` FOREIGN KEY (`id_cabor`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `prestasi_ibfk_1` FOREIGN KEY (`id_atlet`) REFERENCES `master_atlet` (`id_atlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestasi_ibfk_2` FOREIGN KEY (`id_cabor`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestasi_ibfk_3` FOREIGN KEY (`id_np`) REFERENCES `nomor_pertadingan` (`id_np`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestasi_ibfk_4` FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekor_atlet`
--
ALTER TABLE `rekor_atlet`
  ADD CONSTRAINT `rekor_atlet_ibfk_1` FOREIGN KEY (`id_atlet`) REFERENCES `master_atlet` (`id_atlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekor_atlet_ibfk_2` FOREIGN KEY (`id_cabor`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekor_atlet_ibfk_3` FOREIGN KEY (`id_np`) REFERENCES `nomor_pertadingan` (`id_np`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekor_atlet_ibfk_4` FOREIGN KEY (`id_event`) REFERENCES `event` (`id_event`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wasit`
--
ALTER TABLE `wasit`
  ADD CONSTRAINT `wasit_ibfk_1` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
