/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 10.1.34-MariaDB : Database - koni
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`koni` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `koni`;

/*Table structure for table `cabang_olahraga` */

DROP TABLE IF EXISTS `cabang_olahraga`;

CREATE TABLE `cabang_olahraga` (
  `id_cabor` int(11) NOT NULL AUTO_INCREMENT,
  `nama_cabor` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cabor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `cabang_olahraga` */

insert  into `cabang_olahraga`(`id_cabor`,`nama_cabor`) values 
(1,'FUTSAL'),
(2,'SEPAK BOLA'),
(3,'RENANG'),
(4,'LARI'),
(5,'ANGKAT BEBAN');

/*Table structure for table `detail_atlet` */

DROP TABLE IF EXISTS `detail_atlet`;

CREATE TABLE `detail_atlet` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) DEFAULT NULL,
  `np_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_atlet` (`atlet_id`),
  KEY `id_np` (`np_id`),
  CONSTRAINT `detail_atlet_ibfk_1` FOREIGN KEY (`atlet_id`) REFERENCES `master_atlet` (`id_atlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detail_atlet_ibfk_2` FOREIGN KEY (`np_id`) REFERENCES `nomor_pertandingan` (`id_np`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `detail_atlet` */

insert  into `detail_atlet`(`id_detail`,`atlet_id`,`np_id`) values 
(1,1,1),
(2,2,3),
(3,3,4),
(4,3,5),
(5,3,6),
(6,4,4),
(7,4,6),
(8,5,7),
(9,5,9),
(10,6,10),
(11,6,11),
(12,6,12);

/*Table structure for table `event` */

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `nama_event` varchar(100) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  PRIMARY KEY (`id_event`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `event` */

insert  into `event`(`id_event`,`nama_event`,`lokasi`,`tgl_mulai`,`tgl_selesai`) values 
(1,'PON 2015','BADUNG','2015-08-08','2015-10-10'),
(2,'PON 2016','GIANYAR','2016-08-08','2015-10-10'),
(3,'PON 2017','KLUNGKUNG','2017-08-08','2015-10-10'),
(4,'PON 2018','TABANAN','2018-08-08','2015-10-10'),
(5,'PON 2019','DENPASAR','2019-08-08','2015-10-10');

/*Table structure for table `foto` */

DROP TABLE IF EXISTS `foto`;

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL AUTO_INCREMENT,
  `nama_foto` varchar(100) DEFAULT NULL,
  `ukuran_foto` int(11) DEFAULT NULL,
  `tipe_foto` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_foto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `foto` */

insert  into `foto`(`id_foto`,`nama_foto`,`ukuran_foto`,`tipe_foto`) values 
(1,'1',1,'1');

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `jabatan` */

insert  into `jabatan`(`id_jabatan`,`nama_jabatan`) values 
(1,'MANAGER'),
(2,'PELATIH'),
(3,'TEKNISI'),
(4,'OFFICIAL'),
(5,'MEDIS');

/*Table structure for table `kabupaten` */

DROP TABLE IF EXISTS `kabupaten`;

CREATE TABLE `kabupaten` (
  `id_kabupaten` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kabupaten` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_kabupaten`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `kabupaten` */

insert  into `kabupaten`(`id_kabupaten`,`nama_kabupaten`) values 
(1,'BADUNG'),
(2,'DENPASAR'),
(3,'GIANYAR');

/*Table structure for table `kontingen` */

DROP TABLE IF EXISTS `kontingen`;

CREATE TABLE `kontingen` (
  `id_kontingen` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kontingen` varchar(100) DEFAULT NULL,
  `no_kartu_tanda_anggota` char(10) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jabatan_id` int(11) DEFAULT NULL,
  `kabupaten_id` int(11) DEFAULT NULL,
  `foto_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kontingen`),
  KEY `id_jabatan` (`jabatan_id`),
  KEY `id_kabupaten` (`kabupaten_id`),
  KEY `id_foto` (`foto_id`),
  CONSTRAINT `kontingen_ibfk_1` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kontingen_ibfk_2` FOREIGN KEY (`kabupaten_id`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kontingen_ibfk_3` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`id_foto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `kontingen` */

insert  into `kontingen`(`id_kontingen`,`nama_kontingen`,`no_kartu_tanda_anggota`,`jenis_kelamin`,`tempat_lahir`,`tgl_lahir`,`alamat`,`jabatan_id`,`kabupaten_id`,`foto_id`) values 
(1,'Abra','1608561001','L','DENPASAR','1998-01-01','Jln. di Denpasar',1,1,1),
(2,'Bulbasaur','1608561002','L','DENPASAR','1997-01-01','Jln. di Denpasar',2,2,1),
(3,'Cyndaquil','1608561003','L','DENPASAR','1996-03-02','Jln. di Badung',4,3,1),
(4,'Deoxys','1608561004','L','DENPASAR','1995-01-01','Jln. di Denpasar',1,1,1),
(5,'Emolga','1608561005','P','BADUNG','2000-11-12','Jln. di Denpasar',5,1,1),
(6,'Flageon','1608561006','P','DENPASAR','1998-01-01','Jln. di Denpasar',1,1,1),
(7,'Gyarados','1608561007','L','DENPASAR','1998-01-01','Jln. di Denpasar',1,1,1),
(8,'Huntail','1608561008','L','DENPASAR','1998-01-01','Jln. di Denpasar',1,1,1);

/*Table structure for table `master_atlet` */

DROP TABLE IF EXISTS `master_atlet`;

CREATE TABLE `master_atlet` (
  `id_atlet` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_atlet`),
  KEY `id_cabor` (`cabor_id`),
  KEY `id_kabupaten` (`kabupaten_id`),
  KEY `id_foto` (`foto_id`),
  CONSTRAINT `master_atlet_ibfk_1` FOREIGN KEY (`cabor_id`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `master_atlet_ibfk_2` FOREIGN KEY (`kabupaten_id`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `master_atlet_ibfk_3` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`id_foto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `master_atlet` */

insert  into `master_atlet`(`id_atlet`,`nama_atlet`,`cabor_id`,`no_kartu_tanda_anggota`,`jenis_kelamin`,`tempat_lahir`,`tgl_lahir`,`alamat`,`tinggi`,`berat`,`kabupaten_id`,`foto_id`,`tgl_jadi_atlet`,`tgl_pensiun`,`status`) values 
(1,'Alit Indrawan',1,'1808561001','L','Rumah Sakit','1998-01-10','Batubulan',170,65,1,1,'0000-00-00',NULL,0),
(2,'Angga Purnajiwa',2,'1808561002','L','Rumah Sakit','1996-03-15','Denpasar',170,65,1,1,'0000-00-00',NULL,0),
(3,'Hendra Satuan',3,'1808561003','L','Rumah Sakit','1999-05-14','Denpasar',160,58,1,1,'0000-00-00',NULL,0),
(4,'Kenny Kurniadi',3,'1808561004','L','Rumah Sakit','1999-12-11','Jimbaran',168,99,1,1,'0000-00-00',NULL,0),
(5,'Afif Ngehek',4,'1808561005','L','Rumah Sakit','1998-05-11','Badung',165,60,1,1,'0000-00-00',NULL,0),
(6,'Deri Korlap',5,'1808561006','L','Rumah Sakit','1997-04-18','Bangli',169,80,1,1,'0000-00-00',NULL,0);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

/*Table structure for table `nomor_pertandingan` */

DROP TABLE IF EXISTS `nomor_pertandingan`;

CREATE TABLE `nomor_pertandingan` (
  `id_np` int(11) NOT NULL AUTO_INCREMENT,
  `cabor_id` int(11) NOT NULL,
  `ket_np` varchar(50) NOT NULL,
  PRIMARY KEY (`id_np`),
  KEY `id_cabor` (`cabor_id`),
  CONSTRAINT `nomor_pertandingan_ibfk_1` FOREIGN KEY (`cabor_id`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `nomor_pertandingan` */

insert  into `nomor_pertandingan`(`id_np`,`cabor_id`,`ket_np`) values 
(1,1,'BEREGU PUTRA'),
(2,1,'BEREGU PUTRI'),
(3,2,'BEREGU PUTRA'),
(4,3,'GAYA BEBAS 100M'),
(5,3,'GAYA PUNGGUNG 100M'),
(6,3,'GAYA CAMPURAN 100M'),
(7,4,'100M'),
(8,4,'500M'),
(9,4,'1000M'),
(10,5,'120KG'),
(11,5,'200KG'),
(12,5,'250KG');

/*Table structure for table `prestasi` */

DROP TABLE IF EXISTS `prestasi`;

CREATE TABLE `prestasi` (
  `id_prestasi` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) NOT NULL,
  `nama_prestasi` varchar(50) NOT NULL,
  `cabor_id` int(11) NOT NULL,
  `np_Id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `waktu` date NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_prestasi`),
  KEY `id_atlet` (`atlet_id`,`cabor_id`,`np_Id`,`event_id`),
  KEY `id_cabor` (`cabor_id`),
  KEY `id_np` (`np_Id`),
  KEY `id_event` (`event_id`),
  CONSTRAINT `prestasi_ibfk_1` FOREIGN KEY (`atlet_id`) REFERENCES `master_atlet` (`id_atlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `prestasi_ibfk_2` FOREIGN KEY (`cabor_id`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `prestasi_ibfk_3` FOREIGN KEY (`np_Id`) REFERENCES `nomor_pertandingan` (`id_np`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `prestasi_ibfk_4` FOREIGN KEY (`event_id`) REFERENCES `event` (`id_event`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `prestasi` */

insert  into `prestasi`(`id_prestasi`,`atlet_id`,`nama_prestasi`,`cabor_id`,`np_Id`,`event_id`,`waktu`,`create_at`) values 
(3,1,'JUARA 1',1,1,1,'2018-12-12','0000-00-00 00:00:00'),
(4,1,'JUARA 1',1,1,2,'2018-12-12','0000-00-00 00:00:00'),
(5,1,'MEDALI EMAS',1,3,2,'2018-12-12','0000-00-00 00:00:00'),
(6,2,'JUARA 2',2,3,2,'2018-12-12','0000-00-00 00:00:00'),
(7,3,'JUARA 3',3,5,1,'2018-12-12','0000-00-00 00:00:00'),
(8,3,'JUARA 1',3,6,1,'2018-12-12','0000-00-00 00:00:00'),
(9,4,'JUARA 2',3,6,1,'2018-12-12','0000-00-00 00:00:00'),
(10,5,'MEDALI PERAK',4,7,2,'2018-12-12','0000-00-00 00:00:00'),
(11,6,'MEDALI PERUNGGU',5,12,3,'2018-12-12','0000-00-00 00:00:00'),
(12,1,'JUARA 1',1,1,1,'2018-12-12','0000-00-00 00:00:00');

/*Table structure for table `rekor_atlet` */

DROP TABLE IF EXISTS `rekor_atlet`;

CREATE TABLE `rekor_atlet` (
  `id_rekor` int(11) NOT NULL AUTO_INCREMENT,
  `atlet_id` int(11) DEFAULT NULL,
  `keterangan_rekor` varchar(50) DEFAULT NULL,
  `cabor_id` int(11) DEFAULT NULL,
  `np_Id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rekor`),
  KEY `id_atlet` (`atlet_id`),
  KEY `id_cabor` (`cabor_id`),
  KEY `id_np` (`np_Id`),
  KEY `id_event` (`event_id`),
  CONSTRAINT `rekor_atlet_ibfk_1` FOREIGN KEY (`atlet_id`) REFERENCES `master_atlet` (`id_atlet`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rekor_atlet_ibfk_2` FOREIGN KEY (`cabor_id`) REFERENCES `cabang_olahraga` (`id_cabor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rekor_atlet_ibfk_3` FOREIGN KEY (`np_Id`) REFERENCES `nomor_pertandingan` (`id_np`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rekor_atlet_ibfk_4` FOREIGN KEY (`event_id`) REFERENCES `event` (`id_event`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `rekor_atlet` */

insert  into `rekor_atlet`(`id_rekor`,`atlet_id`,`keterangan_rekor`,`cabor_id`,`np_Id`,`event_id`,`waktu`,`create_at`) values 
(1,1,'TIM TERBAIK',1,1,2,'2018-12-12','0000-00-00 00:00:00'),
(2,1,'TIM FAIR PLAY',1,3,2,'2018-12-12','0000-00-00 00:00:00'),
(3,2,'TIM FAIR PLAY',2,3,2,'2018-12-12','0000-00-00 00:00:00'),
(4,3,'2 menit 38 detik',3,5,1,'2018-12-12','0000-00-00 00:00:00'),
(5,3,'1 menti 44 detik',3,6,1,'2018-12-12','0000-00-00 00:00:00'),
(6,4,'1 menit 58 detik',3,6,1,'2018-12-12','0000-00-00 00:00:00'),
(7,5,'24 detik',4,7,2,'2018-12-12','0000-00-00 00:00:00'),
(8,6,'280.56 KG',5,12,3,'2018-12-12','0000-00-00 00:00:00');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'alit','alitindrawan71@gmail.com',NULL,'$2y$10$9c2Xzgj6eaT.rFu2KNTDu.FBcBRo5DKju9NV8MectCdLiii4dTi3u','ErhHiy9JmbbpuQZJJqxJMuCgIL00568Q5wMgbf47popIFANnt6oHUWaOyvgO','2018-11-13 10:36:54','2018-11-13 10:36:54'),
(2,'alit','alitindrawan71@gmail.com',NULL,'$2y$10$iLXGMx6UmYa1W1ZXRhXpjuA1gSAE.zmHJKTbqhfK8m.1JBxtErCsW',NULL,'2018-11-13 10:36:54','2018-11-13 10:36:54'),
(3,'alit','alitindrawan71@gmail.com',NULL,'$2y$10$S.DZ3g1nclMII/lWKWa/SOnZhnref88O8zv1qkMuragQ4.oidkZIa',NULL,'2018-11-13 10:36:54','2018-11-13 10:36:54');

/*Table structure for table `wasit` */

DROP TABLE IF EXISTS `wasit`;

CREATE TABLE `wasit` (
  `id_wasit` int(11) NOT NULL AUTO_INCREMENT,
  `nama_wasit` varchar(100) DEFAULT NULL,
  `no_kartu_anggota` char(10) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `kabupaten_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_wasit`),
  KEY `id_kabupaten` (`kabupaten_id`),
  CONSTRAINT `wasit_ibfk_1` FOREIGN KEY (`kabupaten_id`) REFERENCES `kabupaten` (`id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `wasit` */

insert  into `wasit`(`id_wasit`,`nama_wasit`,`no_kartu_anggota`,`jenis_kelamin`,`tempat_lahir`,`tgl_lahir`,`alamat`,`kabupaten_id`) values 
(1,'Alfonso','1708561001','L','SPANYOL','1976-04-24','Jauh pokoknya',1),
(2,'Ferguso','1708561002','L','SPANYOL','1984-07-14','Jauh pokoknya',1),
(3,'Leornado','1708561003','L','SPANYOL','1981-11-13','Jauh pokoknya',2),
(4,'Gattuso','1708561004','L','SPANYOL','1974-03-01','Jauh pokoknya',3),
(5,'Fernandinho','1708561005','L','SPANYOL','1981-04-30','Jauh pokoknya',3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
