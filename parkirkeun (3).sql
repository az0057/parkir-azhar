-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Apr 2026 pada 02.22
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkirkeun`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_area_parkir`
--

CREATE TABLE `tb_area_parkir` (
  `id_area` int(11) NOT NULL,
  `nama_area` varchar(50) DEFAULT NULL,
  `kapasitas` int(5) DEFAULT 0,
  `terisi` int(5) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_area_parkir`
--

INSERT INTO `tb_area_parkir` (`id_area`, `nama_area`, `kapasitas`, `terisi`) VALUES
(1, 'area1', 40, 3),
(3, 'area2', 40, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `plat_nomor` varchar(15) DEFAULT NULL,
  `jenis_kendaraan` enum('mobil','motor') DEFAULT NULL,
  `warna` varchar(10) DEFAULT NULL,
  `pemilik` varchar(25) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`id_kendaraan`, `plat_nomor`, `jenis_kendaraan`, `warna`, `pemilik`, `id_user`) VALUES
(7, 'AA234', 'motor', 'hitam', 'mulyadi', 1),
(8, 'AUIE123', 'mobil', 'silver', 'yanto', 1),
(10, 'BHGF', 'motor', 'merah', 'yayat', 6),
(17, 'B DS 123', 'mobil', 'silver', 'maruf', 1),
(19, 'KJUYUG', 'motor', 'merah', 'dadang', 1),
(22, 'HGHFGHF', 'mobil', 'silver', 'yahya', 1),
(27, 'DHJHGJH', 'motor', 'hitam', 'mulyana', 1),
(28, 'DGDGF', 'mobil', 'hitam', 'jaelani', 1),
(36, 'REW1234', 'mobil', 'hitam', 'dayat', 6),
(40, 'ASAS', 'mobil', 'merah', 'aris', 1),
(42, 'H 123 IKJ', 'motor', 'hitam', 'ajay', 1),
(43, 'B 987 JKH', 'mobil', 'pink', 'budi', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_log_aktivitas`
--

CREATE TABLE `tb_log_aktivitas` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `aktivitas` varchar(100) DEFAULT NULL,
  `waktu_aktivitas` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_log_aktivitas`
--

INSERT INTO `tb_log_aktivitas` (`id_log`, `id_user`, `aktivitas`, `waktu_aktivitas`) VALUES
(1, 1, 'Mengubah area parkir: area2', '2026-03-09 06:39:43'),
(2, 3, 'Menghapus transaksi parkir ID: 3', '2026-03-09 06:59:25'),
(3, 3, 'Mengubah data kendaraan ID: 4', '2026-03-09 06:59:36'),
(4, 1, 'Menambah user baru: agus27', '2026-03-09 07:11:42'),
(5, 1, 'Mengubah data user: agus27', '2026-03-09 07:11:51'),
(6, 1, 'Mengubah data user: agus27', '2026-03-09 07:12:04'),
(7, 1, 'Menghapus data parkir ID: 34', '2026-03-09 08:53:38'),
(8, 1, 'Menghapus data parkir ID: 33', '2026-03-09 08:53:45'),
(9, 6, 'Mengubah data parkir ID: 12', '2026-03-09 09:02:12'),
(10, 1, 'Menambah user baru: andika27', '2026-03-10 14:46:47'),
(11, 1, 'Update tarif untuk: ID 3', '2026-03-10 14:47:12'),
(12, 6, 'Kendaraan Keluar: REW1234 - Biaya: Rp 180.000', '2026-03-10 14:47:58'),
(13, 6, 'Checkout: REW1234 (Rp 180000)', '2026-03-10 14:47:58'),
(14, 1, 'Mengubah data user: az0057', '2026-03-10 14:50:32'),
(15, 1, 'Update kapasitas area: area2', '2026-03-10 14:54:37'),
(16, 6, 'Kendaraan Masuk: REW345 (mobil)', '2026-03-10 14:55:13'),
(17, 6, 'Mencatat kendaraan masuk: rew345', '2026-03-10 14:55:13'),
(18, 6, 'Kendaraan Keluar: REW345 - Biaya: Rp 10.000', '2026-03-10 15:01:31'),
(19, 6, 'Checkout: REW345 (Rp 10000)', '2026-03-10 15:01:31'),
(20, 6, 'Kendaraan Masuk: YYFFG (mobil)', '2026-03-10 15:13:14'),
(21, 6, 'Mencatat kendaraan masuk: YYFFG', '2026-03-10 15:13:14'),
(22, 3, 'Kendaraan Masuk: REW1234 (mobil)', '2026-03-31 14:11:37'),
(23, 3, 'Mencatat kendaraan masuk: REW1234', '2026-03-31 14:11:37'),
(24, 3, 'Kendaraan Keluar: YYFFG - Biaya: Rp 5.030.000', '2026-03-31 14:11:50'),
(25, 3, 'Checkout: YYFFG (Rp 5030000)', '2026-03-31 14:11:50'),
(26, 1, 'Menghapus data kendaraan ID: 16', '2026-04-01 16:37:11'),
(27, 1, 'Menghapus data kendaraan ID: 15', '2026-04-01 16:37:17'),
(28, 1, 'Menghapus data kendaraan ID: 9', '2026-04-01 16:37:22'),
(29, 1, 'Menghapus data kendaraan ID: 4', '2026-04-01 16:37:28'),
(30, 1, 'Menghapus data kendaraan ID: 5', '2026-04-01 16:37:33'),
(31, 1, 'Menghapus data kendaraan ID: 3', '2026-04-01 16:38:27'),
(32, 1, 'Menghapus data kendaraan ID: 38', '2026-04-01 16:38:33'),
(33, 1, 'Menghapus data kendaraan ID: 6', '2026-04-01 16:38:38'),
(34, 1, 'Menghapus data kendaraan ID: 37', '2026-04-01 16:38:44'),
(35, 1, 'Registrasi kendaraan baru: asas', '2026-04-01 16:39:16'),
(36, 1, 'Mengubah data kendaraan: AA234', '2026-04-01 16:45:10'),
(37, 1, 'Menghapus data kendaraan ID: 11', '2026-04-01 16:45:20'),
(38, 1, 'Menghapus data kendaraan ID: 32', '2026-04-01 16:45:26'),
(39, 1, 'Menghapus data kendaraan ID: 31', '2026-04-01 16:45:30'),
(40, 1, 'Menghapus data kendaraan ID: 34', '2026-04-01 16:45:36'),
(41, 1, 'Menghapus data kendaraan ID: 33', '2026-04-01 16:45:41'),
(42, 1, 'Menghapus data kendaraan ID: 13', '2026-04-01 16:45:55'),
(43, 1, 'Menghapus data kendaraan ID: 23', '2026-04-01 16:46:03'),
(44, 1, 'Menghapus data kendaraan ID: 12', '2026-04-01 16:46:11'),
(45, 1, 'Menghapus data kendaraan ID: 39', '2026-04-01 16:46:18'),
(46, 1, 'Menghapus data kendaraan ID: 2', '2026-04-01 16:46:53'),
(47, 1, 'Menghapus data kendaraan ID: 20', '2026-04-01 16:47:14'),
(48, 1, 'Menghapus data kendaraan ID: 29', '2026-04-01 16:47:24'),
(49, 1, 'Mengubah data kendaraan: B DS 123', '2026-04-01 16:48:08'),
(50, 6, 'Parkir Masuk: B DS 123', '2026-04-01 16:54:33'),
(51, 6, 'Parkir Keluar Transaksi ID: 39', '2026-04-01 17:04:19'),
(52, 1, 'Update Member ID: 36', '2026-04-01 17:39:33'),
(53, 1, 'Mengubah data kendaraan: REW1234', '2026-04-01 17:39:33'),
(54, 1, 'Hapus Member ID: 35', '2026-04-01 17:40:34'),
(55, 1, 'Menghapus data kendaraan ID: 35', '2026-04-01 17:40:34'),
(56, 1, 'Mengubah data user: andika27', '2026-04-01 17:42:43'),
(57, 6, 'Parkir Masuk: AA234', '2026-04-01 17:43:30'),
(58, 6, 'Parkir Keluar ID Transaksi: 40', '2026-04-02 07:59:34'),
(59, 1, 'Update Tarif MOTOR menjadi 5000', '2026-04-02 08:09:59'),
(60, 1, 'Update Tarif MOBIL menjadi 7000', '2026-04-02 08:10:14'),
(61, 1, 'Update Tarif MOTOR menjadi 3000', '2026-04-02 08:10:21'),
(62, 1, 'Update Area: area1 (Kapasitas: 200)', '2026-04-02 08:25:08'),
(63, 1, 'Update area: area1', '2026-04-02 08:25:08'),
(64, 1, 'Update Area: area2 (Kapasitas: 150)', '2026-04-02 08:25:17'),
(65, 1, 'Update area: area2', '2026-04-02 08:25:17'),
(66, 6, 'Parkir Masuk: ASAS', '2026-04-02 08:25:44'),
(67, 1, 'Update Member ID: 10', '2026-04-02 08:26:31'),
(68, 1, 'Menambah user baru: m7', '2026-04-02 09:09:25'),
(69, 1, 'Mengubah data user: muu', '2026-04-02 09:09:35'),
(70, 1, 'Menghapus user ID: 8', '2026-04-02 09:09:39'),
(71, 6, 'Parkir Masuk: ASAS di Area ID: 1', '2026-04-02 09:10:12'),
(72, 6, 'Parkir Keluar ID Transaksi: 42', '2026-04-02 09:10:20'),
(73, 6, 'Parkir Keluar ID Transaksi: 41', '2026-04-02 09:10:25'),
(74, 6, 'Parkir Masuk: AA234 di Area ID: 1', '2026-04-02 09:14:59'),
(75, 6, 'Parkir Masuk: ASAS di Area ID: 3', '2026-04-02 09:15:22'),
(76, 6, 'Hapus Transaksi ID: 43', '2026-04-02 09:17:07'),
(77, 6, 'Parkir Keluar ID Transaksi: 44', '2026-04-02 09:17:28'),
(78, 6, 'Parkir Masuk: AA234 di Area ID: 1', '2026-04-02 09:25:55'),
(79, 1, 'Menambah user baru: gdrtg', '2026-04-02 09:26:40'),
(80, 1, 'Mengubah data user: gdhgjghs', '2026-04-02 09:26:51'),
(81, 1, 'Menghapus user ID: 9', '2026-04-02 09:26:56'),
(82, 1, 'Update Member ID: 28', '2026-04-02 09:27:38'),
(83, 1, 'Update Tarif MOBIL menjadi 6000', '2026-04-02 09:27:49'),
(84, 1, 'Update Area: area2 (Kapasitas Baru: 100)', '2026-04-02 09:28:08'),
(85, 1, 'Update area: area2', '2026-04-02 09:28:08'),
(86, 1, 'Update Member ID: 36', '2026-04-02 09:30:22'),
(87, 1, 'Update Member ID: 36', '2026-04-02 09:30:33'),
(88, 6, 'Parkir Keluar ID Transaksi: 45', '2026-04-02 09:31:23'),
(89, 6, 'Parkir Masuk: AA234', '2026-04-02 09:34:43'),
(90, 6, 'Parkir Keluar: AA234 (Total: Rp 3.000)', '2026-04-02 09:40:11'),
(91, 6, 'Parkir Masuk: AA234', '2026-04-02 09:45:21'),
(92, 6, 'Parkir Masuk: ASAS', '2026-04-02 09:47:33'),
(93, 6, 'Parkir Keluar: AA234 (Total: 3000)', '2026-04-02 09:53:23'),
(94, 6, 'Parkir Masuk: AUIE123', '2026-04-02 09:55:35'),
(95, 6, 'Parkir Keluar: ASAS (Total: 6000)', '2026-04-02 09:55:43'),
(96, 6, 'Parkir Masuk: ASAS', '2026-04-02 09:55:56'),
(97, 6, 'Parkir Keluar: ASAS (Total: 6000)', '2026-04-02 10:00:03'),
(98, 1, 'Menambah user baru: eee', '2026-04-02 10:01:18'),
(99, 1, 'Mengubah data user: eehgg', '2026-04-02 10:01:24'),
(100, 1, 'Menghapus user ID: 10', '2026-04-02 10:01:29'),
(101, 1, 'Update Member ID: 14', '2026-04-02 10:02:09'),
(102, 1, 'Update Tarif MOBIL menjadi 7000', '2026-04-02 10:02:20'),
(103, 1, 'Mengubah data user: admin27', '2026-04-07 06:16:16'),
(104, 1, 'Mengubah data user: petugas27', '2026-04-07 06:16:46'),
(105, 1, 'Hapus Member ID: 24', '2026-04-07 06:39:07'),
(106, 1, 'Update Member ID: 19', '2026-04-07 06:39:36'),
(107, 1, 'Hapus Member ID: 30', '2026-04-07 07:04:25'),
(108, 1, 'Hapus Member ID: 26', '2026-04-07 07:04:38'),
(109, 1, 'Hapus Member ID: 25', '2026-04-07 07:04:45'),
(110, 1, 'Update Member ID: 27', '2026-04-07 07:05:24'),
(111, 1, 'Update Tarif ID ', '2026-04-07 07:07:50'),
(112, 1, 'Update Tarif ID ', '2026-04-07 07:07:51'),
(113, 1, 'Update Tarif ID ', '2026-04-07 07:07:52'),
(114, 1, 'Update Tarif ID ', '2026-04-07 07:07:53'),
(115, 1, 'Update Tarif ID ', '2026-04-07 07:07:53'),
(116, 1, 'Update Tarif ID ', '2026-04-07 07:07:54'),
(117, 1, 'Update Tarif ID ', '2026-04-07 07:08:00'),
(118, 1, 'Update Tarif ID:  ke Rp ', '2026-04-07 07:09:36'),
(119, 1, 'Update Tarif ID:  ke Rp ', '2026-04-07 07:09:37'),
(120, 1, 'Hapus Member ID: 18', '2026-04-07 07:28:06'),
(121, 1, 'Hapus Member ID: 21', '2026-04-07 07:28:13'),
(122, 6, 'Parkir Masuk: AA234', '2026-04-07 07:40:13'),
(123, 6, 'Parkir Keluar: AUIE123 (Total: 826000)', '2026-04-07 07:40:41'),
(124, 1, 'Menambah user baru: sss', '2026-04-07 07:42:27'),
(125, 1, 'Mengubah data user: sssdd', '2026-04-07 07:42:34'),
(126, 1, 'Menghapus user ID: 11', '2026-04-07 07:42:39'),
(127, 1, 'Update Member ID: 22', '2026-04-07 07:43:18'),
(128, 1, 'Update Tarif MOTOR menjadi 3000', '2026-04-07 07:43:28'),
(129, 6, 'Parkir Masuk: BHGF', '2026-04-07 09:17:12'),
(130, 1, 'Tambah Member: XZADD', '2026-04-07 09:19:01'),
(131, 1, 'Update Member ID: 41', '2026-04-07 09:19:28'),
(132, 1, 'Hapus Member ID: 41', '2026-04-07 09:19:34'),
(133, 1, 'Update Tarif MOBIL menjadi 6000', '2026-04-07 09:19:48'),
(134, 1, 'Update Tarif MOBIL menjadi 6000', '2026-04-07 09:19:48'),
(135, 7, 'Menambah user baru: loij', '2026-04-08 08:22:05'),
(136, 7, 'Mengubah data user: loijlo', '2026-04-08 08:22:22'),
(137, 7, 'Menghapus user ID: 12', '2026-04-08 08:22:29'),
(138, 7, 'Update Member ID: 40', '2026-04-08 08:23:04'),
(139, 7, 'Update Tarif MOBIL menjadi 5000', '2026-04-08 08:23:37'),
(140, 6, 'Parkir Keluar: BHGF (Total: 72000)', '2026-04-08 08:25:18'),
(141, 6, 'Parkir Keluar: AA234 (Total: 144000)', '2026-04-09 06:53:34'),
(142, 1, 'Update Area: area1 (Kapasitas Baru: 50)', '2026-04-09 06:55:43'),
(143, 1, 'Update area: area1', '2026-04-09 06:55:43'),
(144, 1, 'Update Area: area2 (Kapasitas Baru: 20)', '2026-04-09 06:55:50'),
(145, 1, 'Update area: area2', '2026-04-09 06:55:50'),
(146, 1, 'Hapus Member ID: 14', '2026-04-09 07:26:25'),
(147, 1, 'Tambah Member: H 123 IKJ', '2026-04-09 07:37:42'),
(148, 1, 'Hapus Member ID: 1', '2026-04-09 07:37:49'),
(149, 1, 'Update Member ID: 40', '2026-04-09 07:49:03'),
(150, 1, 'Tambah Member: B 987 JKH', '2026-04-09 07:50:08'),
(151, 1, 'Menambah user baru: mmmm', '2026-04-09 07:59:11'),
(152, 1, 'Mengubah data user: mmmm', '2026-04-09 07:59:24'),
(153, 1, 'Menghapus user ID: 13', '2026-04-09 07:59:29'),
(154, 1, 'Tambah Member: JHHGH', '2026-04-09 07:59:52'),
(155, 1, 'Update Member ID: 44', '2026-04-09 08:00:02'),
(156, 1, 'Hapus Member ID: 44', '2026-04-09 08:00:07'),
(157, 1, 'Update area: area1', '2026-04-09 08:00:34'),
(158, 1, 'Update area: area1', '2026-04-09 08:00:34'),
(159, 6, 'Parkir Masuk: ASAS', '2026-04-09 08:08:20'),
(160, 6, 'Parkir Masuk: AA234', '2026-04-09 08:08:50'),
(161, 6, 'Parkir Masuk: B 987 JKH', '2026-04-09 08:08:57'),
(162, 6, 'Parkir Masuk: BHGF', '2026-04-09 08:09:05'),
(163, 6, 'Hapus Transaksi ID: 54', '2026-04-09 08:10:43'),
(164, 6, 'Parkir Masuk: B DS 123', '2026-04-09 08:12:45'),
(165, 6, 'Parkir Masuk: DGDGF', '2026-04-09 08:15:55'),
(166, 6, 'Parkir Keluar: ASAS', '2026-04-09 08:16:15'),
(167, 7, 'Menambah user baru: sssss', '2026-04-09 08:17:04'),
(168, 7, 'Mengubah data user: sssss', '2026-04-09 08:17:13'),
(169, 7, 'Menghapus user ID: 14', '2026-04-09 08:17:18'),
(170, 7, 'Tambah Member: TTTT', '2026-04-09 08:17:35'),
(171, 7, 'Update Member ID: 45', '2026-04-09 08:17:42'),
(172, 7, 'Hapus Member ID: 45', '2026-04-09 08:17:47'),
(173, 7, 'Update Area: area2', '2026-04-09 08:19:56'),
(174, 7, 'Update area: area2', '2026-04-09 08:19:56'),
(175, 7, 'Menghapus user ID: 16', '2026-04-10 07:10:14'),
(176, 7, 'Menambah user baru: ddd', '2026-04-10 07:10:33'),
(177, 7, 'Mengubah data user: ddd', '2026-04-10 07:10:42'),
(178, 7, 'Menghapus user ID: 17', '2026-04-10 07:10:48'),
(179, 7, 'Tambah Member: JJJJJJJ', '2026-04-10 07:11:08'),
(180, 7, 'Update Member ID: 46', '2026-04-10 07:11:24'),
(181, 7, 'Hapus Member ID: 46', '2026-04-10 07:11:30'),
(182, 7, 'Update Area: area1', '2026-04-10 07:12:15'),
(183, 7, 'Update area: area1', '2026-04-10 07:12:15'),
(184, 6, 'Hapus Transaksi ID: 55', '2026-04-10 07:12:52'),
(185, 6, 'Parkir Keluar: DGDGF', '2026-04-10 07:12:58'),
(186, 6, 'Parkir Masuk: AA234', '2026-04-10 07:13:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tarif`
--

CREATE TABLE `tb_tarif` (
  `id_tarif` int(11) NOT NULL,
  `jenis_kendaraan` enum('motor','mobil','lainnya') DEFAULT NULL,
  `tarif_per_jam` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_tarif`
--

INSERT INTO `tb_tarif` (`id_tarif`, `jenis_kendaraan`, `tarif_per_jam`) VALUES
(1, 'mobil', 5000),
(3, 'motor', 3000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_parkir` int(11) NOT NULL,
  `id_kendaraan` int(11) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `jenis_kendaraan` varchar(50) DEFAULT NULL,
  `waktu_masuk` datetime DEFAULT NULL,
  `waktu_keluar` datetime DEFAULT NULL,
  `id_tarif` int(11) DEFAULT NULL,
  `durasi_jam` int(5) DEFAULT NULL,
  `biaya_total` decimal(10,0) DEFAULT NULL,
  `status` enum('masuk','keluar') DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_parkir`, `id_kendaraan`, `nama_pelanggan`, `jenis_kendaraan`, `waktu_masuk`, `waktu_keluar`, `id_tarif`, `durasi_jam`, `biaya_total`, `status`, `id_user`, `id_area`) VALUES
(1, NULL, NULL, NULL, '2026-03-03 06:09:45', '2026-03-04 06:09:45', 1, 24, 240000, 'keluar', NULL, 1),
(2, NULL, NULL, NULL, '2026-03-03 06:09:45', '2026-03-04 06:09:45', 1, 24, 240000, 'keluar', NULL, 1),
(6, 7, NULL, NULL, '2026-03-09 07:04:22', '2026-03-09 07:12:36', 3, NULL, 5000, 'keluar', 1, 1),
(7, 8, NULL, NULL, '2026-03-09 07:34:38', '2026-03-09 07:50:31', 1, NULL, 10000, 'keluar', 1, 1),
(9, 10, NULL, NULL, '2026-03-09 07:43:13', '2026-03-09 07:44:11', 3, NULL, 0, 'keluar', 6, 1),
(13, NULL, NULL, NULL, '2026-03-09 08:13:44', '2026-03-09 08:55:06', 3, NULL, 5000, 'keluar', 1, 1),
(16, 17, NULL, NULL, '2026-03-09 08:19:58', '2026-03-09 08:54:58', 1, NULL, 10000, 'keluar', 1, 1),
(17, NULL, NULL, NULL, '2026-03-09 08:20:31', '2026-03-09 08:54:56', 3, NULL, 5000, 'keluar', 6, 1),
(18, 19, NULL, NULL, '2026-03-09 08:27:46', '2026-03-09 08:54:54', 1, NULL, 10000, 'keluar', 1, 1),
(20, NULL, NULL, NULL, '2026-03-09 08:30:31', '2026-03-09 08:54:47', 3, NULL, 5000, 'keluar', 1, 1),
(21, 22, NULL, NULL, '2026-03-09 08:31:04', '2026-03-09 08:54:45', 3, NULL, 5000, 'keluar', 1, 1),
(23, NULL, NULL, NULL, '2026-03-09 08:33:00', '2026-03-09 08:54:37', 3, NULL, 5000, 'keluar', 1, 1),
(24, NULL, NULL, NULL, '2026-03-09 08:33:33', '2026-03-09 08:54:35', 3, NULL, 5000, 'keluar', 1, 1),
(25, NULL, NULL, NULL, '2026-03-09 08:35:36', '2026-03-09 08:54:33', 3, NULL, 5000, 'keluar', 1, 1),
(26, 27, NULL, NULL, '2026-03-09 08:38:27', '2026-03-09 08:54:30', 3, NULL, 5000, 'keluar', 1, 1),
(27, 28, NULL, NULL, '2026-03-09 08:41:37', '2026-03-09 08:54:28', 3, NULL, 5000, 'keluar', 1, 1),
(29, NULL, NULL, NULL, '2026-03-09 08:46:22', '2026-03-09 08:54:24', 3, NULL, 5000, 'keluar', 1, 1),
(35, 36, NULL, NULL, '2026-03-09 09:05:39', '2026-03-10 14:47:58', 3, NULL, 180000, 'keluar', 6, 1),
(39, 17, NULL, NULL, '2026-04-01 16:54:33', '2026-04-01 17:04:19', 1, NULL, 10000, 'keluar', 6, 1),
(40, 7, NULL, NULL, '2026-04-01 17:43:30', '2026-04-02 07:59:34', 3, NULL, 90000, 'keluar', 6, 1),
(41, 40, NULL, NULL, '2026-04-02 08:25:44', '2026-04-02 09:10:25', 1, NULL, 7000, 'keluar', 6, 1),
(42, 40, NULL, NULL, '2026-04-02 09:10:12', '2026-04-02 09:10:20', 1, NULL, 0, 'keluar', 6, 1),
(44, 40, NULL, NULL, '2026-04-02 09:15:22', '2026-04-02 09:17:28', 1, NULL, 0, 'keluar', 6, 3),
(45, 7, NULL, NULL, '2026-04-02 09:25:55', '2026-04-02 09:31:23', 3, NULL, 0, 'keluar', 6, 1),
(46, 7, NULL, NULL, '2026-04-02 09:34:43', '2026-04-02 09:40:11', 3, NULL, 3000, 'keluar', 6, 1),
(47, 7, NULL, NULL, '2026-04-02 09:45:21', '2026-04-02 09:53:23', 3, NULL, 3000, 'keluar', 6, 1),
(48, 40, NULL, NULL, '2026-04-02 09:47:33', '2026-04-02 09:55:43', 1, NULL, 6000, 'keluar', 6, 1),
(49, 8, NULL, NULL, '2026-04-02 09:55:35', '2026-04-07 07:40:40', 1, NULL, 826000, 'keluar', 6, 1),
(50, 40, NULL, NULL, '2026-04-02 09:55:56', '2026-04-02 10:00:03', 1, NULL, 6000, 'keluar', 6, 1),
(51, 7, NULL, NULL, '2026-04-07 07:40:13', '2026-04-09 06:53:34', 3, NULL, 144000, 'keluar', 6, 1),
(52, 10, NULL, NULL, '2026-04-07 09:17:12', '2026-04-08 08:25:18', 3, NULL, 72000, 'keluar', 6, 1),
(53, 40, 'Umum', NULL, '2026-04-09 08:08:20', '2026-04-09 08:16:15', NULL, NULL, 2000, 'keluar', 6, 1),
(56, 10, 'Umum', NULL, '2026-04-09 08:09:05', NULL, NULL, NULL, 0, 'masuk', 6, 1),
(57, 17, 'Umum', NULL, '2026-04-09 08:12:45', NULL, NULL, NULL, 0, 'masuk', 6, 1),
(58, 28, 'Umum', NULL, '2026-04-09 08:15:55', '2026-04-10 07:12:58', NULL, NULL, 46000, 'keluar', 6, 1),
(59, 7, 'Umum', NULL, '2026-04-10 07:13:08', NULL, NULL, NULL, 0, 'masuk', 6, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(25) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `role` enum('admin','petugas','owner') DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `username`, `password`, `role`, `status_aktif`) VALUES
(1, 'azhar', 'az0057', '12345', 'admin', 1),
(3, 'petugas', 'petugas27', '12345', 'petugas', NULL),
(4, 'asep', 'asep27', '12345', 'owner', 1),
(6, 'agus', 'agus27', '12345', 'petugas', NULL),
(7, 'admin', 'admin27', '12345', 'admin', NULL),
(15, 'ajay', 'owner27', '12345', 'owner', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  ADD PRIMARY KEY (`id_area`);

--
-- Indeks untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_parkir`),
  ADD KEY `id_tarif` (`id_tarif`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_area` (`id_area`),
  ADD KEY `tb_transaksi_ibfk_1` (`id_kendaraan`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_area_parkir`
--
ALTER TABLE `tb_area_parkir`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT untuk tabel `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_parkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD CONSTRAINT `tb_kendaraan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD CONSTRAINT `tb_log_aktivitas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_kendaraan`) REFERENCES `tb_kendaraan` (`id_kendaraan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`id_tarif`) REFERENCES `tb_tarif` (`id_tarif`),
  ADD CONSTRAINT `tb_transaksi_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`),
  ADD CONSTRAINT `tb_transaksi_ibfk_4` FOREIGN KEY (`id_area`) REFERENCES `tb_area_parkir` (`id_area`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
