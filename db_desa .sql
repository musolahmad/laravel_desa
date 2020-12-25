-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2020 at 12:22 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_desa`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_09_02_033015_create_tbuser_tabel', 1),
(2, '2020_09_03_015348_create_tbaduan_tabel', 1),
(3, '2020_09_15_103002_create_tbjabatan_table', 1),
(4, '2020_09_15_103039_create_tbpegawai_table', 1),
(5, '2020_09_15_103242_create_tbperiode_table', 1),
(6, '2020_09_15_103332_create_tbpegawaiperiode_table', 1),
(7, '2020_09_15_103647_create_tbadmin_table', 1),
(8, '2020_09_21_125313_create_tbprofildesa_table', 1),
(9, '2020_11_11_135336_create_tbberita_table', 2),
(10, '2020_11_16_122547_create_tbmasterapbdes_table', 3),
(11, '2020_11_16_122548_create_tbmasterapbdes_table', 4),
(12, '2020_11_16_122549_create_tbmasterapbdes_table', 5),
(13, '2020_11_17_140845_create_tb_apbdes_table', 6),
(14, '2020_11_17_140846_create_tb_apbdes_table', 7),
(15, '2020_11_20_140343_create_tb_satuans_table', 8),
(16, '2020_11_20_140347_create_tb_satuans_table', 9),
(17, '2020_11_20_140346_create_tb_satuans_table', 10),
(18, '2020_11_20_140356_create_tb_satuans_table', 11),
(19, '2020_11_20_154508_create_tb_rkps_table', 11),
(20, '2020_11_20_155328_create_tb_sumberdanas_table', 11),
(21, '2020_11_20_154509_create_tb_rkps_table', 12),
(22, '2020_11_20_154510_create_tb_rkps_table', 13),
(23, '2020_11_20_154511_create_tb_rkps_table', 14),
(24, '2020_11_20_154512_create_tb_rkps_table', 15),
(25, '2020_11_20_154513_create_tb_rkps_table', 16),
(26, '2020_12_01_134114_create_tb_artikels_table', 17),
(27, '2020_12_01_134526_create_tb_galeris_table', 18),
(28, '2020_12_01_134526_create_tb_galeri_table', 19),
(29, '2020_09_03_015349_create_tbaduan_tabel', 20),
(30, '2020_09_03_015340_create_tbaduan_tabel', 21),
(31, '2020_11_20_154514_create_tb_rkps_table', 22),
(32, '2020_12_05_175824_create_tb_komentars_table', 23),
(33, '2020_12_05_175825_create_tb_komentars_table', 24),
(34, '2020_12_10_141848_create_tb_rabs_table', 25),
(35, '2020_12_10_141845_create_tb_rabs_table', 26),
(36, '2020_12_11_141345_create_tb_referensis_table', 27);

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `kd_admin` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_pegawai` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lvl_admin` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`kd_admin`, `kd_pegawai`, `email`, `password`, `lvl_admin`, `created_at`, `updated_at`) VALUES
('ADM001', 'PGW001', 'ti17.0221@gmail.com', 'eyJpdiI6ImZiN2lLZ0R3N3FhTzZKUXVpYTJKV2c9PSIsInZhbHVlIjoiWUxyYzN6bGNOZlRHRGtIeUdFckJZdz09IiwibWFjIjoiNTAxMjYzNzc2ZWM5ZDFkNGNlODU0MjA1N2ZiNWU2N2JmODY2N2RjYThjYTViMmVmYWJjN2M5ZjgxY2FiOWFhNiJ9', '1', NULL, NULL),
('ADM002', 'ADM001', 'muhsoleh90@gmail.com', 'eyJpdiI6ImF4cTRpZlZ0NU1FeTNlcnhYaEtCVHc9PSIsInZhbHVlIjoic1NHWEZhNHNMWVAzTjdib0NlS2ZGUT09IiwibWFjIjoiZTBlNzFlNjAyNmRhNGI5ZTA3MGE0M2VhMWNjMmQwN2QzZTJmN2QzZGVhZmMwOThjM2RhYzQ2MzlkNDRkNTg3YSJ9', '1', '2020-11-26 04:05:50', '2020-11-26 04:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `tb_aduan`
--

CREATE TABLE `tb_aduan` (
  `kd_aduan` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_user` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `baca` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Masuk','Diterima','Diajukan','Ditolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_baca` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_aduan`
--

INSERT INTO `tb_aduan` (`kd_aduan`, `kd_user`, `judul`, `lokasi`, `isi`, `baca`, `status`, `jml_baca`, `created_at`, `updated_at`) VALUES
('201205221730', '2010050001', 'Jalan Rusak', 'RT 03 / RW 04 / Dusun Kranding', 'Tolong Segera Perbaiki karena sudah lama rusak', '2', 'Diterima', 1, '2020-12-05 15:17:30', '2020-12-25 10:08:38'),
('201205222624', '2010050001', 'Jalan Rusak', 'RT 03 / RW 04 / Dusun Kranding', 'Jangan Diabaikan ini sudah sangat parah', '2', 'Diterima', 1, '2020-12-05 15:26:24', '2020-12-07 09:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_apbdes`
--

CREATE TABLE `tb_apbdes` (
  `kd_apbdes` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_rekening` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `th_anggaran` year(4) NOT NULL,
  `pagu_rencana` bigint(20) NOT NULL,
  `pagu_realisasi` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_apbdes`
--

INSERT INTO `tb_apbdes` (`kd_apbdes`, `kd_rekening`, `th_anggaran`, `pagu_rencana`, `pagu_realisasi`, `created_at`, `updated_at`) VALUES
('20201', '1', 2020, 990000, 990000, '2020-11-19 09:01:41', '2020-11-19 10:07:51'),
('20201.1', '1.1', 2020, 990000, 990000, '2020-11-19 09:01:41', '2020-11-19 10:07:51'),
('20201.1.1', '1.1.1', 2020, 900000, 900000, '2020-11-19 09:01:41', '2020-11-19 10:07:42'),
('20201.1.2', '1.1.2', 2020, 90000, 90000, '2020-11-19 09:03:47', '2020-11-19 10:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_admin` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_berita` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_baca` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_berita`
--

INSERT INTO `tb_berita` (`id`, `kd_admin`, `judul`, `isi`, `foto_berita`, `jml_baca`, `created_at`, `updated_at`) VALUES
(1, 'ADM001', 'Sejarah Desa', '<p><strong>Jeruksari</strong>&nbsp;adalah kelurahan di wilayah Kecamatan tirto Kabupaten Pekalongan yang mempunyai luas wilayah 217.4393 Ha terdiri dari tanah sawah 112.9988 Ha, tanah bangunan 34.6425 Ha, Tambak kolam 56.6425 Ha, rawa 112.9988 Ha dan lain-lain 13.1555 Ha, Kelurahan Jeruksari terletak di 1 M di atas permukaan laut, Kelurahan Jeruksari berada di perbatasan antara Kabupaten Pekalongan dan Kota Pekalongan,&nbsp;Kondisi geografis yang tidak jauh dari pantai mempunyai curah hujan 2.000-2500 mm/tahun, dengan jumlah penduduk terdiri dari laki-laki 3546 orang dan perempuan sebanyak 3549 orang, Jumlah kepala keluarga 1866 KK, Jumlah penduduk berdasarkan kelompok mata pencaharian yaitu Petani sendiri ada 189 orang, Buruh Tani ada 162 orang, Nelayan 183 orang, Pengusaha ada 27 orang, Buruh Industri 1235 orang, Buruh Bangunan 234 Orang, Pedagang 63 Orang, Pengangkutan 428 orang, Pegawai Negeri Sipil 37 orang, Pensiunan 11 orang dan Lain-lain 2760 orang.</p>', 'foto_berita/MQXojnTjrfdN1OcwjQeWjlogNWJRQgj5Fwjm6hna.jpeg', 19, '2020-11-11 07:24:59', '2020-12-07 08:37:51'),
(6, 'ADM001', 'Pengaspalan Jalan', '<p>SDASDASDASDASDASDASDASDS</p>\r\n\r\n<p><a href=\"https://juraganberdesa.blogspot.com/2019/11/rencana-kerja-pemerintahan-desa-rkpdesa.html\">laporan desa</a></p>\r\n\r\n<p><img alt=\"\" src=\"http://localhost:8000/storage/profil_desa/13T0HTkBysQIUvUwjS8yh7QMHcVfTP7etQutz7J5.png\" style=\"height:50px; width:50px\" /></p>', 'foto_berita/no_image_news.jpg', 14, '2020-12-01 08:22:40', '2020-12-03 19:01:28'),
(7, 'ADM001', 'Lagu Menepi', '<h1><strong>Lirik</strong></h1>\r\n\r\n<p>Kau yang pernah singgah disini<br />\r\nDan cerita yang dulu kau ingatkan kembali<br />\r\nTak mampu aku tuk mengenang lagi<br />\r\nBiarlah kenangan kita pupus di hati</p>\r\n\r\n<p>Tak ada waktu kembali<br />\r\nUntuk mengulang lagi<br />\r\nMengenang dirimu diawal dulu<br />\r\nKu tahu dirimu dulu<br />\r\nHanya meluangkan waktu<br />\r\nSekedar melepas kisah sedihmu</p>\r\n\r\n<p>Mencintai dalam sepi<br />\r\nDan rasa sabar mana lagi<br />\r\nYang harus kupendam dalam<br />\r\nMengagumi dirimu</p>\r\n\r\n<p>Melihatmu genggam tangannya<br />\r\nNyaman didalam pelukannya<br />\r\nYang mampu membuatku<br />\r\nTersadar dan sedikit menepi</p>\r\n\r\n<p>Tak ada waktu kembali<br />\r\nUntuk mengulang lagi<br />\r\nMengenang dirimu diawal dulu<br />\r\nKu tahu dirimu dulu<br />\r\nHanya meluangkan waktu<br />\r\nSekedar melepas kisah sedihmu</p>\r\n\r\n<p>Mencintai dalam sepi<br />\r\nDan rasa sabar mana lagi<br />\r\nYang harus kupendam dalam<br />\r\nMengagumi dirimu</p>\r\n\r\n<p>Melihatmu genggam tangannya<br />\r\nNyaman didalam pelukannya<br />\r\nYang mampu membuatku<br />\r\nTersadar dan sedikit menepi</p>\r\n\r\n<p>Mencintai dalam sepi<br />\r\nDan rasa sabar mana lagi<br />\r\nYang harus kupendam dalam<br />\r\nMengagumi dirimu</p>\r\n\r\n<p>Melihatmu genggam tangannya<br />\r\nNyaman didalam pelukannya<br />\r\nYang mampu membuatku</p>\r\n\r\n<p>Tersadar dan sedikit menepi<br />\r\nTersadar dan sedikit menepi<br />\r\nTersadar dan sedikit menepi</p>\r\n\r\n<p><img alt=\"\" src=\"http://localhost:8000/storage/foto_galeri/M3aDWrDseWctKx2U7J2EwkgvSdDfuCCKj1zw6wpW.jpeg\" style=\"height:393px; width:700px\" /></p>', 'foto_berita/8BrtJGrwdhbxaKRa2O5CnYZjaC409PKJWstX0A3y.jpeg', 3, '2020-12-05 17:15:08', '2020-12-07 07:54:39');

-- --------------------------------------------------------

--
-- Table structure for table `tb_galeri`
--

CREATE TABLE `tb_galeri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_galeri`
--

INSERT INTO `tb_galeri` (`id`, `kode`, `gambar`, `created_at`, `updated_at`) VALUES
(3, '201205221730', 'foto_galeri/M3aDWrDseWctKx2U7J2EwkgvSdDfuCCKj1zw6wpW.jpeg', '2020-12-05 15:17:30', '2020-12-05 15:17:30'),
(4, '201205222624', 'foto_galeri/7HRvUz8T4Gv6ejLvGd93KToY29y5VWLziZ8J2Vza.jpeg', '2020-12-05 15:26:24', '2020-12-05 15:26:24'),
(9, '20202.2.11', 'foto_galeri/BjtLU9zuwu8Q0FzkjpcyeCZoVv9oo7oUwYm1kdct.jpeg', '2020-12-07 08:17:26', '2020-12-07 08:17:26'),
(10, '20202.2.12', 'foto_galeri/pUyiUEaZGsunltchl1V789Dqu0Q6lFaBeTy1SvXd.png', '2020-12-07 08:17:38', '2020-12-07 08:17:38'),
(11, '20202.2.11', 'foto_galeri/6OpJmIeU3r2kokieJ2LdtKxws8sYWsKIJNJXQEji.jpeg', '2020-12-07 09:16:37', '2020-12-07 09:16:37'),
(12, '20202.2.12', 'foto_galeri/qAss4ygrkSp3KUfT6pU99s4kBXa6o6Fg6u1RNcM7.jpeg', '2020-12-07 09:25:48', '2020-12-07 09:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `kd_jabatan` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_jabatan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`kd_jabatan`, `nm_jabatan`, `created_at`, `updated_at`) VALUES
('JBT001', 'Kepala Desa', '2020-10-05 07:35:07', '2020-10-05 07:35:07'),
('JBT002', 'Sekretaris Desa', '2020-10-09 08:14:39', '2020-10-09 08:14:39'),
('JBT003', 'Kaur Keuangan', '2020-10-12 03:23:14', '2020-10-12 03:23:14'),
('JBT004', 'Kaur Pemerintahan dan Perencanaan', '2020-10-12 03:25:04', '2020-10-12 03:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `tb_komentar`
--

CREATE TABLE `tb_komentar` (
  `kd_komentar` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_aduan` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_admin` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Masuk','Diterima','Diajukan','Ditolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_komentar`
--

INSERT INTO `tb_komentar` (`kd_komentar`, `kd_aduan`, `kd_admin`, `status`, `komentar`, `created_at`, `updated_at`) VALUES
('201205221751', '201205221730', 'ADM001', 'Diterima', 'Harap bersabar aduan anda akan segera kami ajukan ke rencana pembangunan', '2020-12-05 15:17:51', '2020-12-05 15:17:51'),
('201205222642', '201205222624', 'ADM001', 'Diterima', 'Harap bersabar aduan anda akan segera kami ajukan ke rencana pembangunan', '2020-12-05 15:26:42', '2020-12-05 15:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_apbdes`
--

CREATE TABLE `tb_master_apbdes` (
  `kd_rekening` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jns_akun` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_induk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_akun` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_urut` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_master_apbdes`
--

INSERT INTO `tb_master_apbdes` (`kd_rekening`, `uraian`, `jns_akun`, `kd_induk`, `tipe_akun`, `no_urut`, `created_at`, `updated_at`) VALUES
('1', 'Pendapatan', '1', '0', '1', 1, '2020-11-19 06:48:12', '2020-11-20 08:19:16'),
('1.1', 'Pendapatan Asli Desa', '1', '1', '1', 1, '2020-11-19 06:50:13', '2020-11-19 06:50:13'),
('1.1.1', 'Hasil Usaha Desa', '1', '1.1', '2', 1, '2020-11-19 08:52:29', '2020-11-19 08:52:29'),
('1.1.2', 'Lain - Lain Pendapatan Asli Desa Yang Sah', '1', '1.1', '2', 2, '2020-11-19 08:52:38', '2020-11-19 08:52:38'),
('1.2', 'Pendapatan Transfer', '1', '1', '1', 2, '2020-11-19 08:52:50', '2020-11-19 08:52:50'),
('1.2.1', 'Dana Desa', '1', '1.2', '2', 1, '2020-11-19 08:52:58', '2020-11-19 08:52:58'),
('1.2.2', 'Bagi Hasil Pajak Dan Retibusi', '1', '1.2', '2', 2, '2020-11-19 08:53:14', '2020-11-19 08:53:14'),
('1.2.3', 'Alokasi Dana Desa', '1', '1.2', '2', 3, '2020-11-19 08:53:32', '2020-11-19 08:53:32'),
('2', 'Belanja', '2', '0', '1', 2, '2020-11-19 06:48:32', '2020-11-20 08:23:10'),
('2.1', 'BIDANG PENYELENGGARAAN PEMERINTAH', '2', '2', '2', 1, '2020-11-26 04:14:27', '2020-11-26 04:14:27'),
('2.2', 'BIDANG PENYELENGGARAAN PEMBANGUNAN DESA', '2', '2', '2', 2, '2020-11-26 04:14:41', '2020-11-26 04:14:41'),
('2.3', 'BIDANG PEMBINAAN KEMASYARAKATAN', '2', '2', '2', 3, '2020-11-26 04:15:05', '2020-11-26 04:15:05'),
('2.4', 'BIDANG PEMBERDAYAAN MASYARAKAT', '2', '2', '2', 4, '2020-11-26 04:15:19', '2020-11-26 04:15:19'),
('3', 'Pembiayaan', '1', '0', '1', 3, '2020-12-10 07:07:48', '2020-12-10 07:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `kd_pegawai` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_nik` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_pegawai` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jns_kelamin` enum('l','p') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_profil` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`kd_pegawai`, `nip_nik`, `nm_pegawai`, `tgl_lahir`, `alamat`, `jns_kelamin`, `foto_profil`, `created_at`, `updated_at`) VALUES
('ADM001', 'SUPERADMIN', 'Super Admin', '1990-08-10', 'Pekalongan', 'l', 'foto_admin/1.jpg', NULL, NULL),
('PGW001', '9809830830981', 'Yasir Lana', '1993-07-07', 'Pekalongan', 'l', 'foto_admin/08I493FoUzjmKJFFVrNTssel2Z9IwY4FJQclR8Ew.jpeg', NULL, '2020-12-22 15:34:57'),
('PGW002', '1213233444', 'Muhammad Soleh', '1990-08-10', 'Jeruksari, Pekalongan', 'l', 'foto_admin/1.jpg', '2020-10-05 07:35:37', '2020-10-05 07:35:37');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawaiperiode`
--

CREATE TABLE `tb_pegawaiperiode` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_periode` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_pegawai` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_jabatan` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_pegawaiperiode`
--

INSERT INTO `tb_pegawaiperiode` (`id`, `kd_periode`, `kd_pegawai`, `kd_jabatan`, `created_at`, `updated_at`) VALUES
(5, 'PRD001', 'PGW001', 'JBT001', '2020-10-12 03:38:51', '2020-10-12 03:56:25'),
(6, 'PRD001', 'PGW002', 'JBT002', '2020-10-12 03:38:51', '2020-10-12 03:56:25'),
(7, 'PRD001', 'PGW001', 'JBT003', '2020-10-12 03:38:51', '2020-10-12 03:56:25'),
(8, 'PRD001', 'PGW002', 'JBT004', '2020-10-12 03:38:51', '2020-10-12 03:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `tb_periode`
--

CREATE TABLE `tb_periode` (
  `kd_periode` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `awal` date NOT NULL,
  `akhir` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_periode`
--

INSERT INTO `tb_periode` (`kd_periode`, `awal`, `akhir`, `created_at`, `updated_at`) VALUES
('PRD001', '2020-10-08', '2025-10-08', '2020-10-09 06:24:16', '2020-10-09 06:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `tb_profildesa`
--

CREATE TABLE `tb_profildesa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nm_desa` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_pos` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hr_krj` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jm_krj` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peta` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_profildesa`
--

INSERT INTO `tb_profildesa` (`id`, `nm_desa`, `alamat`, `website`, `logo`, `kd_pos`, `hr_krj`, `jm_krj`, `peta`, `created_at`, `updated_at`) VALUES
(1, 'Desa Jeruksari', 'Jl. Raya Jeruksari, No 381, Jeruksari, Kec. Tirto, Kab. Pekalongan', 'https://jeruksari.com/', 'profil_desa/13T0HTkBysQIUvUwjS8yh7QMHcVfTP7etQutz7J5.png', '51151', 'Senin - Jumat', '08.00 - 15.00', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15844.903965779487!2d109.64718222701022!3d-6.863498370640777!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70260c5bcac68d%3A0xaeeb4e23e0f78d30!2sJeruksari%2C%20Kec.%20Tirto%2C%20Pekalongan%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1601880355070!5m2!1sid!2sid\" width=\"100%\" height=\"100%\" frameborder=\"0\" style=\"border:0;\" allowfullscreen=\"\" aria-hidden=\"false\" tabindex=\"0\"></iframe>', '2020-10-05 06:46:05', '2020-12-02 08:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rab`
--

CREATE TABLE `tb_rab` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_kegiatan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uraian` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_urut` int(11) NOT NULL,
  `jns_belanja` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `vol_rab` int(11) NOT NULL,
  `kd_satuan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hrg_satuan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_rab`
--

INSERT INTO `tb_rab` (`id`, `kd_kegiatan`, `uraian`, `no_urut`, `jns_belanja`, `vol_rab`, `kd_satuan`, `hrg_satuan`, `created_at`, `updated_at`) VALUES
(6, '20202.2.1', 'Belanja ATK', 1, '1', 3, '3', 1000000, '2020-12-10 15:28:54', '2020-12-10 16:30:42'),
(7, '20202.2.1', 'ATK', 1, '2', 12, '1', 799999, '2020-12-10 15:29:37', '2020-12-10 15:29:37');

-- --------------------------------------------------------

--
-- Table structure for table `tb_referensi`
--

CREATE TABLE `tb_referensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kd_kegiatan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_aduan` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rkp`
--

CREATE TABLE `tb_rkp` (
  `kd_kegiatan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_urut_kegiatan` int(11) NOT NULL,
  `th_anggaran` year(4) NOT NULL,
  `kd_rekening` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_kegiatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume` double NOT NULL,
  `kd_satuan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sasaran` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `biaya` int(11) NOT NULL,
  `sumber` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pola_pelaksanaan` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelaksana` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_gbr_awl` varchar(31) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kd_gbr_akh` varchar(31) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_rkp`
--

INSERT INTO `tb_rkp` (`kd_kegiatan`, `no_urut_kegiatan`, `th_anggaran`, `kd_rekening`, `nm_kegiatan`, `lokasi`, `volume`, `kd_satuan`, `sasaran`, `tgl_awal`, `tgl_akhir`, `biaya`, `sumber`, `pola_pelaksanaan`, `pelaksana`, `kd_gbr_awl`, `kd_gbr_akh`, `created_at`, `updated_at`) VALUES
('20202.2.1', 1, 2020, '2.2', 'Pengaspalan', 'dasdsadas', 23232, '1', 'dfdsfsdfdsf', '2020-12-01', '2020-12-04', 90000000, '1.1.1', '1', 'sdasdasdsa', '20202.2.11', '20202.2.12', '2020-12-03 17:44:27', '2020-12-03 17:44:27'),
('20202.3.1', 1, 2020, '2.3', 'Perawatan Kembang Desa', 'dasdsadas', 23232, '1', 'dfdsfsdfdsf', '2020-12-01', '2020-12-09', 900000000, '1.1.1', '1', 'sdasdasdsa', '20202.3.11', '20202.3.12', '2020-12-03 17:43:54', '2020-12-03 17:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `kd_satuan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_satuan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_satuan`
--

INSERT INTO `tb_satuan` (`kd_satuan`, `nm_satuan`, `created_at`, `updated_at`) VALUES
('1', 'Kg', '2020-11-26 08:42:32', '2020-11-26 08:42:32'),
('2', 'M', '2020-11-26 08:55:11', '2020-12-10 07:23:53'),
('3', 'Paket', '2020-11-26 08:57:38', '2020-11-26 08:57:38'),
('4', 'Km', '2020-11-27 04:30:26', '2020-11-27 04:30:26'),
('5', 'M3', '2020-11-27 07:12:55', '2020-12-10 07:24:04'),
('6', 'M2', '2020-12-10 07:24:15', '2020-12-10 07:24:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `kd_user` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_depan` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_belakang` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jns_kelamin` enum('l','p') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_profil` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_user` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_daftar` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`kd_user`, `nama_depan`, `nama_belakang`, `email`, `password`, `jns_kelamin`, `tgl_lahir`, `alamat`, `no_telp`, `foto_profil`, `status_user`, `tgl_daftar`, `created_at`, `updated_at`) VALUES
('2010050001', 'Muhammad', 'Soleh', 'muhsoleh9@gmail.com', 'eyJpdiI6InhYZ0ZwQm9mL0FVVEZKSEN1aER6T0E9PSIsInZhbHVlIjoiU1dQQWVuZ200SmNGMWtWU1pROVJGdz09IiwibWFjIjoiOTZjMWYzYjk2MWY4MjNlYTQyYmU1ZjMzZTQ1MmI1MGVmODY0MzgyZjY5ZDU0ZjQ3ZGU3YTkwMDg5Zjc0OTQ0YyJ9', 'l', '2000-10-05', 'Pekalongan', '021654141464', 'foto_profil/1.jpg', '2', '2020-10-05', '2020-10-05 06:40:48', '2020-10-05 06:41:56'),
('2012020001', 'Ismail', 'Warkonah', 'imamprayogo@gmail.com', 'eyJpdiI6InhYZ0ZwQm9mL0FVVEZKSEN1aER6T0E9PSIsInZhbHVlIjoiU1dQQWVuZ200SmNGMWtWU1pROVJGdz09IiwibWFjIjoiOTZjMWYzYjk2MWY4MjNlYTQyYmU1ZjMzZTQ1MmI1MGVmODY0MzgyZjY5ZDU0ZjQ3ZGU3YTkwMDg5Zjc0OTQ0YyJ9', 'l', '2002-12-02', 'Pekalongan', '021654141464', 'foto_profil/XZ0FIBVwHuzVToOgCkUYGEXLfp5K09pti9pQZtMH.jpeg', '2', '2020-12-02', '2020-12-02 09:30:31', '2020-12-03 06:38:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`kd_admin`),
  ADD UNIQUE KEY `tb_admin_email_unique` (`email`),
  ADD KEY `tb_admin_kd_pegawai_foreign` (`kd_pegawai`);

--
-- Indexes for table `tb_aduan`
--
ALTER TABLE `tb_aduan`
  ADD PRIMARY KEY (`kd_aduan`),
  ADD KEY `tb_aduan_kd_user_foreign` (`kd_user`);

--
-- Indexes for table `tb_apbdes`
--
ALTER TABLE `tb_apbdes`
  ADD PRIMARY KEY (`kd_apbdes`),
  ADD KEY `tb_apbdes_kd_rekening_foreign` (`kd_rekening`);

--
-- Indexes for table `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_berita_kd_admin_foreign` (`kd_admin`);

--
-- Indexes for table `tb_galeri`
--
ALTER TABLE `tb_galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`kd_jabatan`);

--
-- Indexes for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD PRIMARY KEY (`kd_komentar`),
  ADD KEY `tb_komentar_kd_aduan_foreign` (`kd_aduan`),
  ADD KEY `tb_komentar_kd_admin_foreign` (`kd_admin`);

--
-- Indexes for table `tb_master_apbdes`
--
ALTER TABLE `tb_master_apbdes`
  ADD PRIMARY KEY (`kd_rekening`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`kd_pegawai`);

--
-- Indexes for table `tb_pegawaiperiode`
--
ALTER TABLE `tb_pegawaiperiode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_pegawaiperiode_kd_periode_foreign` (`kd_periode`),
  ADD KEY `tb_pegawaiperiode_kd_pegawai_foreign` (`kd_pegawai`),
  ADD KEY `tb_pegawaiperiode_kd_jabatan_foreign` (`kd_jabatan`);

--
-- Indexes for table `tb_periode`
--
ALTER TABLE `tb_periode`
  ADD PRIMARY KEY (`kd_periode`);

--
-- Indexes for table `tb_profildesa`
--
ALTER TABLE `tb_profildesa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_rab`
--
ALTER TABLE `tb_rab`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_rab_kd_kegiatan_foreign` (`kd_kegiatan`),
  ADD KEY `tb_rab_kd_satuan_foreign` (`kd_satuan`);

--
-- Indexes for table `tb_referensi`
--
ALTER TABLE `tb_referensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_referensi_kd_kegiatan_foreign` (`kd_kegiatan`),
  ADD KEY `tb_referensi_kd_aduan_foreign` (`kd_aduan`);

--
-- Indexes for table `tb_rkp`
--
ALTER TABLE `tb_rkp`
  ADD PRIMARY KEY (`kd_kegiatan`),
  ADD KEY `tb_rkp_kd_rekening_foreign` (`kd_rekening`),
  ADD KEY `tb_rkp_kd_satuan_foreign` (`kd_satuan`),
  ADD KEY `tb_rkp_sumber_foreign` (`sumber`);

--
-- Indexes for table `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`kd_satuan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`kd_user`),
  ADD UNIQUE KEY `tb_user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_galeri`
--
ALTER TABLE `tb_galeri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_pegawaiperiode`
--
ALTER TABLE `tb_pegawaiperiode`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_profildesa`
--
ALTER TABLE `tb_profildesa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_rab`
--
ALTER TABLE `tb_rab`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_referensi`
--
ALTER TABLE `tb_referensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD CONSTRAINT `tb_admin_kd_pegawai_foreign` FOREIGN KEY (`kd_pegawai`) REFERENCES `tb_pegawai` (`kd_pegawai`);

--
-- Constraints for table `tb_aduan`
--
ALTER TABLE `tb_aduan`
  ADD CONSTRAINT `tb_aduan_kd_user_foreign` FOREIGN KEY (`kd_user`) REFERENCES `tb_user` (`kd_user`);

--
-- Constraints for table `tb_apbdes`
--
ALTER TABLE `tb_apbdes`
  ADD CONSTRAINT `tb_apbdes_kd_rekening_foreign` FOREIGN KEY (`kd_rekening`) REFERENCES `tb_master_apbdes` (`kd_rekening`);

--
-- Constraints for table `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD CONSTRAINT `tb_berita_kd_admin_foreign` FOREIGN KEY (`kd_admin`) REFERENCES `tb_admin` (`kd_admin`);

--
-- Constraints for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD CONSTRAINT `tb_komentar_kd_admin_foreign` FOREIGN KEY (`kd_admin`) REFERENCES `tb_admin` (`kd_admin`),
  ADD CONSTRAINT `tb_komentar_kd_aduan_foreign` FOREIGN KEY (`kd_aduan`) REFERENCES `tb_aduan` (`kd_aduan`);

--
-- Constraints for table `tb_pegawaiperiode`
--
ALTER TABLE `tb_pegawaiperiode`
  ADD CONSTRAINT `tb_pegawaiperiode_kd_jabatan_foreign` FOREIGN KEY (`kd_jabatan`) REFERENCES `tb_jabatan` (`kd_jabatan`),
  ADD CONSTRAINT `tb_pegawaiperiode_kd_pegawai_foreign` FOREIGN KEY (`kd_pegawai`) REFERENCES `tb_pegawai` (`kd_pegawai`),
  ADD CONSTRAINT `tb_pegawaiperiode_kd_periode_foreign` FOREIGN KEY (`kd_periode`) REFERENCES `tb_periode` (`kd_periode`);

--
-- Constraints for table `tb_rab`
--
ALTER TABLE `tb_rab`
  ADD CONSTRAINT `tb_rab_kd_kegiatan_foreign` FOREIGN KEY (`kd_kegiatan`) REFERENCES `tb_rkp` (`kd_kegiatan`),
  ADD CONSTRAINT `tb_rab_kd_satuan_foreign` FOREIGN KEY (`kd_satuan`) REFERENCES `tb_satuan` (`kd_satuan`);

--
-- Constraints for table `tb_referensi`
--
ALTER TABLE `tb_referensi`
  ADD CONSTRAINT `tb_referensi_kd_aduan_foreign` FOREIGN KEY (`kd_aduan`) REFERENCES `tb_aduan` (`kd_aduan`),
  ADD CONSTRAINT `tb_referensi_kd_kegiatan_foreign` FOREIGN KEY (`kd_kegiatan`) REFERENCES `tb_rkp` (`kd_kegiatan`);

--
-- Constraints for table `tb_rkp`
--
ALTER TABLE `tb_rkp`
  ADD CONSTRAINT `tb_rkp_kd_rekening_foreign` FOREIGN KEY (`kd_rekening`) REFERENCES `tb_master_apbdes` (`kd_rekening`),
  ADD CONSTRAINT `tb_rkp_kd_satuan_foreign` FOREIGN KEY (`kd_satuan`) REFERENCES `tb_satuan` (`kd_satuan`),
  ADD CONSTRAINT `tb_rkp_sumber_foreign` FOREIGN KEY (`sumber`) REFERENCES `tb_master_apbdes` (`kd_rekening`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
