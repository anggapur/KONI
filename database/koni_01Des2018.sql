-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2018 at 09:04 AM
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
-- Table structure for table `cabang_olahraga`
--

CREATE TABLE `cabang_olahraga` (
  `id_cabor` int(11) NOT NULL,
  `nama_cabor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cabang_olahraga`
--

INSERT INTO `cabang_olahraga` (`id_cabor`, `nama_cabor`) VALUES
(1, 'FUTSAL'),
(2, 'SEPAK BOLA'),
(3, 'RENANG'),
(4, 'LARI'),
(5, 'ANGKAT BEBAN');

-- --------------------------------------------------------

--
-- Table structure for table `detail_atlet`
--

CREATE TABLE `detail_atlet` (
  `id_detail` int(11) NOT NULL,
  `atlet_id` int(11) DEFAULT NULL,
  `np_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_atlet`
--

INSERT INTO `detail_atlet` (`id_detail`, `atlet_id`, `np_id`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 4),
(4, 3, 5),
(5, 3, 6),
(6, 4, 4),
(7, 4, 6),
(8, 5, 7),
(9, 5, 9),
(10, 6, 10),
(11, 6, 11),
(12, 6, 12);

-- --------------------------------------------------------

--
-- Table structure for table `detail_atlet_event`
--

CREATE TABLE `detail_atlet_event` (
  `id_detail_event` int(11) NOT NULL,
  `atlet_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_event`
--

CREATE TABLE `detail_event` (
  `id_detail` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `cabor_id` int(11) NOT NULL,
  `lama_pertandingan` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `tempat_pertandingan` varchar(100) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time DEFAULT NULL,
  `status_cabor` enum('Eksibisi','Tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_event`
--

INSERT INTO `detail_event` (`id_detail`, `event_id`, `cabor_id`, `lama_pertandingan`, `tgl_mulai`, `tgl_selesai`, `tempat_pertandingan`, `waktu_mulai`, `waktu_selesai`, `status_cabor`) VALUES
(8, 5, 1, 1, '2018-12-04', '2018-12-05', 'a', '01:01:00', '01:01:00', 'Tidak'),
(9, 5, 2, 1, '2018-12-04', '2018-12-05', 'a', '01:01:00', '01:01:00', 'Eksibisi');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `tingkat_id` int(11) NOT NULL,
  `nama_event` varchar(100) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id_event`, `tingkat_id`, `nama_event`, `lokasi`, `tgl_mulai`, `tgl_selesai`) VALUES
(1, 1, 'PON 2015', 'BADUNG', '2015-08-08', '2015-10-10'),
(2, 1, 'PON 2016', 'GIANYAR', '2016-08-08', '2015-10-10'),
(3, 1, 'PON 2017', 'KLUNGKUNG', '2017-08-08', '2015-10-10'),
(4, 1, 'PON 2018', 'TABANAN', '2018-08-08', '2015-10-10'),
(5, 1, 'PON 2019', 'DENPASAR', '2019-08-08', '2015-10-10'),
(29, 3, 'PORSENIJAR 2019', 'Bali', '2018-12-30', '2018-12-31');

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

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id_foto`, `nama_foto`, `ukuran_foto`, `tipe_foto`) VALUES
(1, 'atletSilat.jpg', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'MANAGER'),
(2, 'PELATIH'),
(3, 'TEKNISI'),
(4, 'OFFICIAL'),
(5, 'MEDIS');

-- --------------------------------------------------------

--
-- Table structure for table `juara`
--

CREATE TABLE `juara` (
  `id_juara` int(11) NOT NULL,
  `ket_juara` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `juara`
--

INSERT INTO `juara` (`id_juara`, `ket_juara`) VALUES
(1, 'Juara 1'),
(2, 'Juara 2'),
(3, 'Juara 3');

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kabupaten` int(11) NOT NULL,
  `nama_kabupaten` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id_kabupaten`, `nama_kabupaten`) VALUES
(1, 'BADUNG'),
(2, 'DENPASAR'),
(3, 'GIANYAR');

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
  `jabatan_id` int(11) DEFAULT NULL,
  `kabupaten_id` int(11) DEFAULT NULL,
  `foto_id` int(11) DEFAULT NULL,
  `cabor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontingen`
--

INSERT INTO `kontingen` (`id_kontingen`, `nama_kontingen`, `no_kartu_tanda_anggota`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `alamat`, `jabatan_id`, `kabupaten_id`, `foto_id`, `cabor_id`) VALUES
(1, 'Abra Kadabra', '1608561001', 'L', 'DENPASAR', '1998-01-20', 'Jln. di Denpasar', 1, 1, 1, 3),
(2, 'Bulbasaur', '1608561002', 'L', 'DENPASAR', '1997-01-01', 'Jln. di Denpasar', 2, 2, 1, 1),
(3, 'Cyndaquil', '1608561013', 'L', 'DENPASAR', '1996-03-02', 'Jln. di Badung', 1, 3, 1, 1),
(4, 'Deoxys', '1608561004', 'L', 'DENPASAR', '1995-01-01', 'Jln. di Denpasar', 1, 1, 1, 1),
(5, 'Emolga', '1608561005', 'P', 'BADUNG', '2000-11-12', 'Jln. di Denpasar', 5, 1, 1, 1),
(6, 'Flageon', '1608561006', 'P', 'DENPASAR', '1998-01-01', 'Jln. di Denpasar', 1, 1, 1, 1),
(7, 'Gyarados', '1608561007', 'L', 'DENPASAR', '1998-01-01', 'Jln. di Denpasar', 1, 1, 1, 1),
(8, 'Huntail', '1608561008', 'L', 'DENPASAR', '1998-01-01', 'Jln. di Denpasar', 1, 1, 1, 1),
(9, 'Alit Indrawan Lari', '1608561013', 'L', 'Gianyar', '2018-10-31', 'Jalan Pasekan Gang Batu Intan 1 no 5', 1, 1, 1, 4),
(11, 'Alit Indrawan 2', '1608561013', 'L', 'Gianyar', '2018-11-30', 'Jalan Pasekan Gang Batu Intan 1 no 5', 5, 1, 1, 1),
(12, 'Alit Indrawan 24', '1234567890', 'L', 'Gianyar', '2018-11-09', 'Jalan Pasekan Gang Batu Intan 1 no 5', 5, 1, 1, 5),
(13, 'Alit Indrawan', '1234567896', 'L', 'Gianyar', '2018-11-07', 'Jalan Pasekan Gang Batu Intan 1 no 5', 3, 1, 1, 5),
(14, 'Alit Indrawan 12', '1234567899', 'P', 'Gianyar', '2018-11-24', 'Jalan Pasekan Gang Batu Intan 1 no 5', 2, 1, 1, 4),
(15, 'I Gusti Ngurah Alit Indrawan', '1234567893', 'L', 'Gianyar', '2018-11-27', 'Jalan Pasekan Gang Batu Intan 1 no 5', 3, 1, 1, 4),
(16, 'Alit Indrawan', '1234567892', 'L', 'Gianyar', '2018-11-14', 'Jalan Pasekan Gang Batu Intan 1 no 5', 2, 1, 1, 3),
(17, 'Alit Indrawan', '1234567818', 'L', 'Gianyar', '2018-11-13', 'Jalan Pasekan Gang Batu Intan 1 no 5', 3, 1, 1, 3),
(18, 'Alit Indrawan', '1234567891', 'L', 'Gianyar', '2018-11-09', 'Jalan Pasekan Gang Batu Intan 1 no 5', 4, 1, 1, 2),
(19, 'Alit Indrawan', '1608561010', 'L', 'Gianyar', '2018-12-06', 'Jalan Pasekan Gang Batu Intan 1 no 5', 3, 1, 1, 2),
(20, 'Alit Indrawan', '1234567898', 'L', 'Gianyar', '2018-11-29', 'Jalan Pasekan Gang Batu Intan 1 no 5', 2, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `master_atlet`
--

CREATE TABLE `master_atlet` (
  `id_atlet` int(11) NOT NULL,
  `nama_atlet` varchar(100) NOT NULL,
  `cabor_id` int(11) NOT NULL,
  `no_kartu_tanda_anggota` char(10) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `tinggi` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `kabupaten_id` int(11) DEFAULT NULL,
  `foto_id` int(11) DEFAULT NULL,
  `tgl_jadi_atlet` date NOT NULL,
  `tgl_pensiun` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_atlet`
--

INSERT INTO `master_atlet` (`id_atlet`, `nama_atlet`, `cabor_id`, `no_kartu_tanda_anggota`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `alamat`, `tinggi`, `berat`, `kabupaten_id`, `foto_id`, `tgl_jadi_atlet`, `tgl_pensiun`, `status`) VALUES
(1, 'Alit Indrawan', 1, '1808561001', 'L', 'Rumah Sakit', '1998-01-10', 'Batubulan', 170, 65, 1, 1, '0000-00-00', NULL, 0),
(2, 'Angga Purnajiwa', 2, '1808561002', 'L', 'Rumah Sakit', '1996-03-15', 'Denpasar', 170, 65, 1, 1, '0000-00-00', NULL, 0),
(3, 'Hendra Satuan', 3, '1808561003', 'L', 'Rumah Sakit', '1999-05-14', 'Denpasar', 160, 58, 1, 1, '0000-00-00', NULL, 0),
(4, 'Kenny Kurniadi', 3, '1808561004', 'L', 'Rumah Sakit', '1999-12-11', 'Jimbaran', 168, 99, 1, 1, '0000-00-00', NULL, 0),
(5, 'Afif Ngehek', 4, '1808561005', 'L', 'Rumah Sakit', '1998-05-11', 'Badung', 165, 60, 1, 1, '0000-00-00', NULL, 0),
(6, 'Deri Korlap', 5, '1808561006', 'L', 'Rumah Sakit', '1997-04-18', 'Bangli', 169, 80, 1, 1, '0000-00-00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `medali`
--

CREATE TABLE `medali` (
  `id_medali` int(11) NOT NULL,
  `nama_medali` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medali`
--

INSERT INTO `medali` (`id_medali`, `nama_medali`) VALUES
(1, 'Medali Emas'),
(2, 'Medali Perak'),
(3, 'Medali Perunggu');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_11_22_112511_create_rentang_umurs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nomor_pertandingan`
--

CREATE TABLE `nomor_pertandingan` (
  `id_np` int(11) NOT NULL,
  `cabor_id` int(11) NOT NULL,
  `ket_np` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nomor_pertandingan`
--

INSERT INTO `nomor_pertandingan` (`id_np`, `cabor_id`, `ket_np`) VALUES
(1, 1, 'BEREGU PUTRA'),
(2, 1, 'BEREGU PUTRI'),
(3, 2, 'BEREGU PUTRA'),
(4, 3, 'GAYA BEBAS 100M'),
(5, 3, 'GAYA PUNGGUNG 100M'),
(6, 3, 'GAYA CAMPURAN 100M'),
(7, 4, '100M'),
(8, 4, '500M'),
(9, 4, '1000M'),
(10, 5, '120KG'),
(11, 5, '200KG Wanita'),
(12, 5, '250KG'),
(13, 1, 'Futsal 30 menit'),
(14, 1, 'Futsal 60 menit');

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `atlet_id` int(11) NOT NULL,
  `juara_id` int(11) NOT NULL,
  `medali_id` int(11) NOT NULL,
  `cabor_id` int(11) NOT NULL,
  `np_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `waktu` date NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`id_prestasi`, `atlet_id`, `juara_id`, `medali_id`, `cabor_id`, `np_id`, `event_id`, `waktu`, `create_at`) VALUES
(3, 1, 2, 1, 1, 1, 1, '2018-12-12', '2018-11-23 22:05:16'),
(4, 1, 1, 1, 1, 1, 2, '2018-12-12', '0000-00-00 00:00:00'),
(5, 1, 1, 1, 1, 3, 2, '2018-12-12', '0000-00-00 00:00:00'),
(6, 1, 1, 1, 1, 1, 2, '2018-12-12', '2018-11-23 20:48:35'),
(7, 3, 1, 1, 3, 5, 1, '2018-12-12', '0000-00-00 00:00:00'),
(8, 3, 1, 1, 3, 6, 1, '2018-12-12', '0000-00-00 00:00:00'),
(9, 3, 1, 1, 3, 4, 5, '2018-12-26', '2018-11-23 20:43:23'),
(12, 1, 1, 1, 1, 1, 1, '2018-12-12', '0000-00-00 00:00:00'),
(13, 1, 1, 1, 1, 1, 1, '2018-11-28', '2018-11-23 19:55:07'),
(14, 1, 1, 1, 1, 1, 1, '2018-11-28', '2018-11-23 19:56:52'),
(15, 1, 1, 1, 1, 1, 3, '2018-11-26', '2018-11-23 20:50:19'),
(17, 1, 2, 1, 1, 1, 1, '2018-11-27', '2018-11-23 22:18:41'),
(18, 3, 2, 2, 3, 4, 5, '2018-11-30', '2018-11-23 22:21:23'),
(19, 6, 2, 2, 5, 10, 1, '2018-11-26', '2018-11-23 23:03:04');

-- --------------------------------------------------------

--
-- Table structure for table `rekor_atlet`
--

CREATE TABLE `rekor_atlet` (
  `id_rekor` int(11) NOT NULL,
  `atlet_id` int(11) DEFAULT NULL,
  `keterangan_rekor` varchar(50) DEFAULT NULL,
  `cabor_id` int(11) DEFAULT NULL,
  `np_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekor_atlet`
--

INSERT INTO `rekor_atlet` (`id_rekor`, `atlet_id`, `keterangan_rekor`, `cabor_id`, `np_id`, `event_id`, `waktu`, `create_at`) VALUES
(1, 1, 'TIM TERBAIK', 1, 1, 2, '2018-12-12', '0000-00-00 00:00:00'),
(2, 1, 'TIM FAIR PLAY', 1, 3, 2, '2018-12-12', '0000-00-00 00:00:00'),
(3, 2, 'TIM FAIR PLAY', 2, 3, 2, '2018-12-12', '0000-00-00 00:00:00'),
(4, 3, '2 menit 38 detik', 3, 5, 1, '2018-12-12', '0000-00-00 00:00:00'),
(5, 3, '1 menti 44 detik', 3, 6, 1, '2018-12-12', '0000-00-00 00:00:00'),
(6, 4, '1 menit 58 detik', 3, 6, 1, '2018-12-12', '0000-00-00 00:00:00'),
(7, 5, '24 detik', 4, 7, 2, '2018-12-12', '0000-00-00 00:00:00'),
(8, 6, '280.56 KG', 5, 12, 3, '2018-12-12', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rentang_umur`
--

CREATE TABLE `rentang_umur` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis_umur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur_awal` int(11) NOT NULL,
  `umur_akhir` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rentang_umur`
--

INSERT INTO `rentang_umur` (`id`, `jenis_umur`, `umur_awal`, `umur_akhir`, `created_at`, `updated_at`) VALUES
(1, '17 - 20 Tahun', 17, 20, '2018-11-22 22:07:19', '2018-11-22 22:07:19');

-- --------------------------------------------------------

--
-- Table structure for table `tingkat_event`
--

CREATE TABLE `tingkat_event` (
  `id_tingkat` int(11) NOT NULL,
  `nama_tingkat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tingkat_event`
--

INSERT INTO `tingkat_event` (`id_tingkat`, `nama_tingkat`) VALUES
(1, 'Kabupaten'),
(2, 'Provinsi'),
(3, 'Nasional');

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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'alit', 'alitindrawan71@gmail.com', NULL, '$2y$10$9c2Xzgj6eaT.rFu2KNTDu.FBcBRo5DKju9NV8MectCdLiii4dTi3u', 'tldpEFq7G49yu2Pv52U6IjEQshApq5gmtu1QouTnm5kz31QFR1kFIMvSzqUf', '2018-11-13 02:36:54', '2018-11-13 02:36:54'),
(2, 'alit', 'alitindrawan71@gmail.com', NULL, '$2y$10$iLXGMx6UmYa1W1ZXRhXpjuA1gSAE.zmHJKTbqhfK8m.1JBxtErCsW', NULL, '2018-11-13 02:36:54', '2018-11-13 02:36:54'),
(3, 'alit', 'alitindrawan71@gmail.com', NULL, '$2y$10$S.DZ3g1nclMII/lWKWa/SOnZhnref88O8zv1qkMuragQ4.oidkZIa', NULL, '2018-11-13 02:36:54', '2018-11-13 02:36:54'),
(4, 'Alit Indrawan', 'alitindrawan24@gmail.com', NULL, '$2y$10$f1ZNMdCElQgFwyJbc393lO7uoJyyOsL2d5YaShx3EOWudwX.joxu2', NULL, '2018-11-22 07:35:28', '2018-11-22 07:35:28');

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
  `kabupaten_id` int(11) DEFAULT NULL,
  `cabor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wasit`
--

INSERT INTO `wasit` (`id_wasit`, `nama_wasit`, `no_kartu_anggota`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `alamat`, `kabupaten_id`, `cabor_id`) VALUES
(1, 'Alfonso', '1708561001', 'L', 'SPANYOL', '1976-04-24', 'Jauh pokoknya', 1, 1),
(2, 'Ferguso', '1708561002', 'L', 'SPANYOL', '1984-07-14', 'Jauh pokoknya', 1, 1),
(3, 'Leornado', '1708561003', 'L', 'SPANYOL', '1981-11-13', 'Jauh pokoknya', 2, 1),
(4, 'Gattuso', '1708561004', 'L', 'SPANYOL', '1974-03-01', 'Jauh pokoknya', 3, 1),
(5, 'Fernandinho', '1708561005', 'L', 'SPANYOL', '1981-04-30', 'Jauh pokoknya', 3, 1);

--
-- Indexes for dumped tables
--

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
  ADD KEY `id_atlet` (`atlet_id`),
  ADD KEY `id_np` (`np_id`);

--
-- Indexes for table `detail_atlet_event`
--
ALTER TABLE `detail_atlet_event`
  ADD PRIMARY KEY (`id_detail_event`),
  ADD KEY `atlet_id` (`atlet_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `detail_event`
--
ALTER TABLE `detail_event`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `cabor_id` (`cabor_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `tingkat_id` (`tingkat_id`);

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
-- Indexes for table `juara`
--
ALTER TABLE `juara`
  ADD PRIMARY KEY (`id_juara`);

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
  ADD KEY `id_jabatan` (`jabatan_id`),
  ADD KEY `id_kabupaten` (`kabupaten_id`),
  ADD KEY `id_foto` (`foto_id`),
  ADD KEY `cabor_id` (`cabor_id`);

--
-- Indexes for table `master_atlet`
--
ALTER TABLE `master_atlet`
  ADD PRIMARY KEY (`id_atlet`),
  ADD KEY `id_cabor` (`cabor_id`),
  ADD KEY `id_kabupaten` (`kabupaten_id`),
  ADD KEY `id_foto` (`foto_id`);

--
-- Indexes for table `medali`
--
ALTER TABLE `medali`
  ADD PRIMARY KEY (`id_medali`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nomor_pertandingan`
--
ALTER TABLE `nomor_pertandingan`
  ADD PRIMARY KEY (`id_np`),
  ADD KEY `id_cabor` (`cabor_id`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `id_atlet` (`atlet_id`,`cabor_id`,`np_id`,`event_id`),
  ADD KEY `id_cabor` (`cabor_id`),
  ADD KEY `id_np` (`np_id`),
  ADD KEY `id_event` (`event_id`),
  ADD KEY `juara_id` (`juara_id`),
  ADD KEY `medali_id` (`medali_id`);

--
-- Indexes for table `rekor_atlet`
--
ALTER TABLE `rekor_atlet`
  ADD PRIMARY KEY (`id_rekor`),
  ADD KEY `id_atlet` (`atlet_id`),
  ADD KEY `id_cabor` (`cabor_id`),
  ADD KEY `id_np` (`np_id`),
  ADD KEY `id_event` (`event_id`);

--
-- Indexes for table `rentang_umur`
--
ALTER TABLE `rentang_umur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tingkat_event`
--
ALTER TABLE `tingkat_event`
  ADD PRIMARY KEY (`id_tingkat`);

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
  ADD KEY `id_kabupaten` (`kabupaten_id`),
  ADD KEY `cabor_id` (`cabor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cabang_olahraga`
--
ALTER TABLE `cabang_olahraga`
  MODIFY `id_cabor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_atlet`
--
ALTER TABLE `detail_atlet`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `detail_atlet_event`
--
ALTER TABLE `detail_atlet_event`
  MODIFY `id_detail_event` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_event`
--
ALTER TABLE `detail_event`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `juara`
--
ALTER TABLE `juara`
  MODIFY `id_juara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id_kabupaten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kontingen`
--
ALTER TABLE `kontingen`
  MODIFY `id_kontingen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `master_atlet`
--
ALTER TABLE `master_atlet`
  MODIFY `id_atlet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medali`
--
ALTER TABLE `medali`
  MODIFY `id_medali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nomor_pertandingan`
--
ALTER TABLE `nomor_pertandingan`
  MODIFY `id_np` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rekor_atlet`
--
ALTER TABLE `rekor_atlet`
  MODIFY `id_rekor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rentang_umur`
--
ALTER TABLE `rentang_umur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tingkat_event`
--
ALTER TABLE `tingkat_event`
  MODIFY `id_tingkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wasit`
--
ALTER TABLE `wasit`
  MODIFY `id_wasit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_atlet`
--
ALTER TABLE `detail_atlet`
  ADD CONSTRAINT `detail_atlet_ibfk_1` FOREIGN KEY (`atlet_id`) REFERENCES `master_atlet` (`id_atlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_atlet_ibfk_2` FOREIGN KEY (`np_id`) REFERENCES `nomor_pertandingan` (`id_np`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_atlet_event`
--
ALTER TABLE `detail_atlet_event`
  ADD CONSTRAINT `detail_atlet_event_ibfk_1` FOREIGN KEY (`atlet_id`) REFERENCES `master_atlet` (`id_atlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_atlet_event_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`id_event`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_event`
--
ALTER TABLE `detail_event`
  ADD CONSTRAINT `detail_event_ibfk_1` FOREIGN KEY (`cabor_id`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_event_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event` (`id_event`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`tingkat_id`) REFERENCES `tingkat_event` (`id_tingkat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kontingen`
--
ALTER TABLE `kontingen`
  ADD CONSTRAINT `kontingen_ibfk_1` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kontingen_ibfk_2` FOREIGN KEY (`kabupaten_id`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kontingen_ibfk_3` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`id_foto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kontingen_ibfk_4` FOREIGN KEY (`cabor_id`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_atlet`
--
ALTER TABLE `master_atlet`
  ADD CONSTRAINT `master_atlet_ibfk_1` FOREIGN KEY (`cabor_id`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `master_atlet_ibfk_2` FOREIGN KEY (`kabupaten_id`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `master_atlet_ibfk_3` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`id_foto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nomor_pertandingan`
--
ALTER TABLE `nomor_pertandingan`
  ADD CONSTRAINT `nomor_pertandingan_ibfk_1` FOREIGN KEY (`cabor_id`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `prestasi_ibfk_1` FOREIGN KEY (`atlet_id`) REFERENCES `master_atlet` (`id_atlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestasi_ibfk_2` FOREIGN KEY (`cabor_id`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestasi_ibfk_4` FOREIGN KEY (`event_id`) REFERENCES `event` (`id_event`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestasi_ibfk_5` FOREIGN KEY (`juara_id`) REFERENCES `juara` (`id_juara`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestasi_ibfk_6` FOREIGN KEY (`medali_id`) REFERENCES `medali` (`id_medali`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekor_atlet`
--
ALTER TABLE `rekor_atlet`
  ADD CONSTRAINT `rekor_atlet_ibfk_1` FOREIGN KEY (`atlet_id`) REFERENCES `master_atlet` (`id_atlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekor_atlet_ibfk_2` FOREIGN KEY (`cabor_id`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekor_atlet_ibfk_3` FOREIGN KEY (`np_Id`) REFERENCES `nomor_pertandingan` (`id_np`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekor_atlet_ibfk_4` FOREIGN KEY (`event_id`) REFERENCES `event` (`id_event`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wasit`
--
ALTER TABLE `wasit`
  ADD CONSTRAINT `wasit_ibfk_1` FOREIGN KEY (`kabupaten_id`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wasit_ibfk_2` FOREIGN KEY (`cabor_id`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
