-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 15, 2020 at 08:14 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `others_auto`
--

-- --------------------------------------------------------

--
-- Table structure for table `service_berkala`
--

CREATE TABLE `service_berkala` (
  `id` int(11) NOT NULL,
  `id_mobil` int(10) UNSIGNED NOT NULL,
  `nama` int(11) NOT NULL COMMENT 'dalam satuan km',
  `leadtime` int(11) NOT NULL COMMENT 'dalam satuan menit'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_berkala`
--

INSERT INTO `service_berkala` (`id`, `id_mobil`, `nama`, `leadtime`) VALUES
(1, 1, 60000, 70),
(2, 1, 70000, 70),
(3, 1, 80000, 110),
(4, 1, 90000, 70),
(5, 1, 100000, 70),
(6, 1, 120000, 110),
(7, 1, 160000, 110),
(8, 2, 60000, 80),
(9, 2, 70000, 80),
(10, 2, 80000, 120),
(11, 2, 90000, 80),
(12, 2, 100000, 80),
(13, 2, 120000, 120),
(14, 2, 160000, 120),
(15, 3, 60000, 70),
(16, 3, 70000, 70),
(17, 3, 80000, 110),
(18, 3, 90000, 70),
(19, 3, 100000, 70),
(20, 3, 120000, 110),
(21, 3, 160000, 110),
(22, 4, 60000, 70),
(23, 4, 70000, 70),
(24, 4, 80000, 110),
(25, 4, 90000, 70),
(26, 4, 100000, 70),
(27, 4, 120000, 110),
(28, 4, 160000, 110),
(29, 5, 60000, 70),
(30, 5, 70000, 70),
(31, 5, 80000, 110),
(32, 5, 90000, 70),
(33, 5, 100000, 70),
(34, 5, 120000, 110),
(35, 5, 160000, 110),
(36, 6, 60000, 60),
(37, 6, 70000, 60),
(38, 6, 80000, 110),
(39, 6, 90000, 60),
(40, 6, 100000, 60),
(41, 6, 120000, 110),
(42, 6, 160000, 110),
(43, 7, 60000, 80),
(44, 7, 70000, 80),
(45, 7, 80000, 120),
(46, 7, 90000, 80),
(47, 7, 100000, 80),
(48, 7, 120000, 120),
(49, 7, 160000, 120),
(50, 1, 10000, 70),
(51, 1, 20000, 70),
(52, 1, 30000, 70),
(53, 1, 40000, 110),
(54, 1, 50000, 70),
(55, 2, 10000, 80),
(56, 2, 20000, 80),
(57, 2, 30000, 80),
(58, 2, 40000, 120),
(59, 2, 50000, 80),
(60, 3, 10000, 70),
(61, 3, 20000, 70),
(62, 3, 30000, 70),
(63, 3, 40000, 110),
(64, 3, 50000, 70),
(65, 4, 10000, 70),
(66, 4, 20000, 70),
(67, 4, 30000, 70),
(68, 4, 40000, 110),
(69, 4, 50000, 70),
(70, 5, 10000, 70),
(71, 5, 20000, 70),
(72, 5, 30000, 70),
(73, 5, 40000, 110),
(74, 5, 50000, 70),
(75, 6, 10000, 60),
(76, 6, 20000, 60),
(77, 6, 30000, 60),
(78, 6, 40000, 110),
(79, 6, 50000, 60),
(80, 7, 10000, 80),
(81, 7, 20000, 80),
(82, 7, 30000, 80),
(83, 7, 40000, 120),
(84, 7, 50000, 80),
(85, 8, 10000, 70),
(86, 8, 20000, 70),
(87, 8, 30000, 70),
(88, 8, 40000, 110),
(89, 8, 50000, 70),
(90, 8, 60000, 70),
(91, 8, 70000, 70),
(92, 8, 80000, 110),
(93, 8, 90000, 70),
(94, 8, 100000, 70),
(95, 8, 120000, 110),
(96, 8, 160000, 110),
(97, 9, 10000, 70),
(98, 9, 20000, 70),
(99, 9, 30000, 70),
(100, 9, 40000, 110),
(101, 9, 50000, 70),
(102, 9, 60000, 70),
(103, 9, 70000, 70),
(104, 9, 80000, 110),
(105, 9, 90000, 70),
(106, 9, 100000, 70),
(107, 9, 120000, 110),
(108, 9, 160000, 110),
(109, 10, 10000, 60),
(110, 10, 20000, 60),
(111, 10, 30000, 60),
(112, 10, 40000, 100),
(113, 10, 50000, 60),
(114, 10, 60000, 60),
(115, 10, 70000, 60),
(116, 10, 80000, 100),
(117, 10, 90000, 60),
(118, 10, 100000, 60),
(119, 10, 120000, 100),
(120, 10, 160000, 100),
(121, 11, 10000, 60),
(122, 11, 20000, 60),
(123, 11, 30000, 60),
(124, 11, 40000, 100),
(125, 11, 50000, 60),
(126, 11, 60000, 60),
(127, 11, 70000, 60),
(128, 11, 80000, 100),
(129, 11, 90000, 60),
(130, 11, 100000, 60),
(131, 11, 120000, 100),
(132, 11, 160000, 100);

-- --------------------------------------------------------

--
-- Table structure for table `service_lain`
--

CREATE TABLE `service_lain` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `is_opl` tinyint(1) DEFAULT NULL,
  `opl_level` int(11) DEFAULT NULL,
  `leadtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_lain`
--

INSERT INTO `service_lain` (`id`, `nama`, `is_opl`, `opl_level`, `leadtime`) VALUES
(1, 'ENGINE', 0, 0, 45),
(2, 'CHASIS', 0, 0, 45),
(3, 'ELEKTRIKAL', 0, 0, 45),
(4, 'BUNYI', 0, 0, 60),
(11, 'SPOORING', 1, 11, 30),
(12, 'ENGINE CARE', 1, 12, 30),
(13, 'OZON', 1, 14, 30),
(14, 'SERVICE AC KOMPLIT', 1, 13, 120),
(15, 'FLUSHING POWER STEERING', 1, 14, 30),
(16, 'FLUSHING MATIC', 1, 14, 30),
(18, 'SERVICE AC RINGAN', 1, 13, 30),
(19, 'REMATCHING', 1, 15, 30),
(20, 'SALON INTERIOR', 1, 12, 360),
(21, 'SALON EKSTERIOR', 1, 12, 360),
(22, 'BODY WAX', 1, 12, 360),
(23, 'SALON KACA', 1, 12, 60),
(24, 'NANO GLASS', 1, 12, 120),
(25, 'HEADLAMP CARE', 1, 12, 10),
(26, 'CABIN TREATMENT', 1, 12, 180),
(27, 'FLUSHING GARDEN', 1, 14, 30),
(28, 'BALANCE RODA', 1, 11, 30),
(30, 'SUPER LIGHT', 1, 13, 30),
(31, 'AC CARE+', 1, 13, 30),
(32, 'LIGHT SERVICE', 1, 13, 120),
(33, 'HEAVY SERVICE', 1, 13, 120);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(5) NOT NULL,
  `groups` varchar(50) NOT NULL,
  `options` varchar(100) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `groups`, `options`, `value`) VALUES
(1, 'general', 'web_name', 'Digitalsystem24'),
(2, 'general', 'web_url', 'http://www.digitalsystem24.com'),
(3, 'general', 'web_meta', 'digitalsystem24'),
(4, 'general', 'web_keyword', 'racikproject'),
(5, 'general', 'web_owner', 'racikproject'),
(30, 'config', 'slug_permalink', 'detailpost');

-- --------------------------------------------------------

--
-- Table structure for table `tipe_mobil`
--

CREATE TABLE `tipe_mobil` (
  `id_tipe` int(10) UNSIGNED NOT NULL,
  `nama_tipe` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipe_mobil`
--

INSERT INTO `tipe_mobil` (`id_tipe`, `nama_tipe`) VALUES
(1, 'Innova'),
(2, 'Fortuner'),
(3, 'Yaris'),
(4, 'Vios'),
(5, 'Camry'),
(6, 'Etios'),
(7, 'Hilux'),
(8, 'Avanza'),
(9, 'Rush'),
(10, 'Agya'),
(11, 'Calya');

-- --------------------------------------------------------

--
-- Table structure for table `tracker`
--

CREATE TABLE `tracker` (
  `id` int(11) NOT NULL,
  `nobk` varchar(11) NOT NULL,
  `id_service_berkala` int(11) DEFAULT NULL,
  `id_keluhan_tambahan` int(11) DEFAULT NULL,
  `tipe_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `date_in` date DEFAULT NULL,
  `date_out` date DEFAULT NULL,
  `time` time NOT NULL,
  `time_out` time DEFAULT NULL,
  `estimasi_waktu_cuci` time NOT NULL,
  `estimasiselesai` time NOT NULL,
  `editor_sa` int(5) NOT NULL,
  `opl_1` enum('Y','N') DEFAULT 'N',
  `jenis_service_opl_1` int(11) DEFAULT NULL,
  `jam_mulai_opl_1` time DEFAULT NULL,
  `o_time_1` time DEFAULT NULL,
  `o_editor_1` varchar(15) DEFAULT NULL,
  `petugas_opl_1` varchar(10) DEFAULT NULL,
  `opl_2` enum('Y','N') DEFAULT 'N',
  `jenis_service_opl_2` int(11) DEFAULT NULL,
  `jam_mulai_opl_2` time DEFAULT NULL,
  `o_time_2` time DEFAULT NULL,
  `o_editor_2` varchar(15) DEFAULT NULL,
  `petugas_opl_2` varchar(10) DEFAULT NULL,
  `opl_3` enum('Y','N') DEFAULT 'N',
  `jenis_service_opl_3` int(11) DEFAULT NULL,
  `jam_mulai_opl_3` time DEFAULT NULL,
  `o_time_3` time DEFAULT NULL,
  `o_editor_3` varchar(15) DEFAULT NULL,
  `petugas_opl_3` varchar(10) DEFAULT NULL,
  `opl_4` enum('Y','N') DEFAULT 'N',
  `jenis_service_opl_4` int(11) DEFAULT NULL,
  `jam_mulai_opl_4` time DEFAULT NULL,
  `o_time_4` time DEFAULT NULL,
  `o_editor_4` varchar(15) DEFAULT NULL,
  `petugas_opl_4` varchar(10) DEFAULT NULL,
  `opl_5` enum('Y','N') DEFAULT 'N',
  `jenis_service_opl_5` int(11) DEFAULT NULL,
  `jam_mulai_opl_5` time DEFAULT NULL,
  `o_time_5` time DEFAULT NULL,
  `o_editor_5` varchar(15) DEFAULT NULL,
  `petugas_opl_5` varchar(10) DEFAULT NULL,
  `forman` enum('Y','N') DEFAULT 'N',
  `f_time` time DEFAULT NULL,
  `f_kelompok` int(5) DEFAULT NULL,
  `f_status` enum('Y','N') DEFAULT 'N',
  `washing` enum('Y','N') DEFAULT 'N',
  `w_time` time DEFAULT NULL,
  `jam_selesai_cuci` time DEFAULT NULL,
  `w_editor` int(11) DEFAULT NULL,
  `w_status` enum('Y','N') DEFAULT 'N',
  `status` enum('Y','N','S') DEFAULT 'N',
  `trace` char(11) NOT NULL,
  `member` int(11) DEFAULT NULL,
  `washing_use` enum('Y','N') NOT NULL,
  `k_status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracker`
--

INSERT INTO `tracker` (`id`, `nobk`, `id_service_berkala`, `id_keluhan_tambahan`, `tipe_id`, `date`, `date_in`, `date_out`, `time`, `time_out`, `estimasi_waktu_cuci`, `estimasiselesai`, `editor_sa`, `opl_1`, `jenis_service_opl_1`, `jam_mulai_opl_1`, `o_time_1`, `o_editor_1`, `petugas_opl_1`, `opl_2`, `jenis_service_opl_2`, `jam_mulai_opl_2`, `o_time_2`, `o_editor_2`, `petugas_opl_2`, `opl_3`, `jenis_service_opl_3`, `jam_mulai_opl_3`, `o_time_3`, `o_editor_3`, `petugas_opl_3`, `opl_4`, `jenis_service_opl_4`, `jam_mulai_opl_4`, `o_time_4`, `o_editor_4`, `petugas_opl_4`, `opl_5`, `jenis_service_opl_5`, `jam_mulai_opl_5`, `o_time_5`, `o_editor_5`, `petugas_opl_5`, `forman`, `f_time`, `f_kelompok`, `f_status`, `washing`, `w_time`, `jam_selesai_cuci`, `w_editor`, `w_status`, `status`, `trace`, `member`, `washing_use`, `k_status`) VALUES
(2, 'BK007', 102, 2, 9, '2020-04-16', '2020-04-08', '2020-04-08', '06:50:00', '07:06:00', '11:45:00', '12:00:00', 198, 'Y', 11, '06:53:00', '06:54:00', '11', '205', 'Y', 19, '06:56:00', '07:15:00', '15', '209', 'N', NULL, NULL, NULL, NULL, NULL, 'N', NULL, NULL, NULL, NULL, NULL, 'Y', 14, '07:02:00', '07:16:00', '13', '207', 'Y', '07:04:00', 201, 'Y', 'Y', '07:05:00', '07:10:00', 199, 'Y', 'Y', '2', 197, 'Y', 'Y'),
(3, 'BK777', NULL, 2, 8, '2020-04-16', '2020-04-16', '2020-04-16', '15:54:00', '03:13:00', '17:39:00', '17:54:00', 198, 'Y', 11, '01:37:00', '01:29:00', '11', '205', 'Y', 28, '01:39:00', '01:39:00', '11', '205', 'N', NULL, NULL, NULL, NULL, NULL, 'N', NULL, NULL, NULL, NULL, NULL, 'N', NULL, NULL, NULL, NULL, NULL, 'Y', '01:40:00', 201, 'Y', 'Y', '01:43:00', '03:04:00', 199, 'Y', 'Y', '2', 197, 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `bio` text,
  `picture` varchar(255) DEFAULT NULL,
  `level` varchar(20) NOT NULL DEFAULT '2',
  `block` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `forget_key` varchar(100) DEFAULT NULL,
  `locktype` varchar(1) NOT NULL DEFAULT '0',
  `company` int(11) NOT NULL,
  `term` enum('1','0') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `bio`, `picture`, `level`, `block`, `id_session`, `tgl_daftar`, `forget_key`, `locktype`, `company`, `term`) VALUES
(197, 'auto', 'e10adc3949ba59abbe56e057f20f883e', '', 'alfi@gmail.com', '', '', '', '7', 'N', 'jpt9k5gkbv8g44smi37ncp9om8', '2019-09-01', NULL, '0', 0, '1'),
(198, 'demosa', 'e10adc3949ba59abbe56e057f20f883e', 'Demo SA', 'alfi@gmail.com', '', '', '', '5', 'N', 'm2buamm19e62qipd9u707qn8cc', '2019-09-01', NULL, '0', 197, '0'),
(199, 'demowa', 'e10adc3949ba59abbe56e057f20f883e', 'Demo Wash', 'alfi@gmail.com', '', '', '', '4', 'N', 'nc7pa9qrf7t882510segvt7l3n', '2019-09-01', NULL, '0', 197, '0'),
(200, 'demoptm', 'e10adc3949ba59abbe56e057f20f883e', 'Demo PTM', 'alfi@gmail.com', '', '', '', '2', 'N', 'e10adc3949ba59abbe56e057f20f883e', '2019-09-01', NULL, '0', 197, '0'),
(201, 'demoforeman', 'e10adc3949ba59abbe56e057f20f883e', 'Demo Foreman', 'alfi@gmail.com', '', '', '', '3', 'N', 'bdlkpo270jojv0st3r8vedofq9', '2019-09-01', NULL, '0', 197, '0'),
(202, 'demomanager', 'e10adc3949ba59abbe56e057f20f883e', 'Demo Manager', 'alfi@gmail.com', '', '', '', '6', 'N', 'fnoa822b6dkis73nnb009lbem7', '2019-09-01', NULL, '0', 197, '0'),
(203, 'demobooking', 'e10adc3949ba59abbe56e057f20f883e', 'Demo Booking', 'alfi@gmail.com', '', '', '', '8', 'N', 'e10adc3949ba59abbe56e057f20f883e', '2019-09-01', NULL, '0', 197, '0'),
(204, 'demosales', 'e10adc3949ba59abbe56e057f20f883e', 'Demo Sales', 'alfi@gmail.com', '', '', '', '9', 'N', 'e10adc3949ba59abbe56e057f20f883e', '2019-09-01', NULL, '0', 197, '0'),
(205, 'opl_spooring', 'e10adc3949ba59abbe56e057f20f883e', 'OPL Spooring', NULL, NULL, NULL, NULL, '11', 'N', '20l6tcdddnh2jl553pf1hl3ht7', '2020-03-05', NULL, '0', 197, '0'),
(206, 'opl_salon', 'e10adc3949ba59abbe56e057f20f883e', 'Demo Salon', NULL, NULL, NULL, NULL, '12', 'N', 'n1vpqacf3e6deb294a592bbpjp', '2020-03-05', NULL, '0', 197, '0'),
(207, 'opl_ac', 'e10adc3949ba59abbe56e057f20f883e', 'OPL Service AC', NULL, NULL, NULL, NULL, '13', 'N', '3npmfr0ijq61hijq0qdtitjr3m', '2020-03-12', NULL, '0', 197, '0'),
(208, 'opl_flushing', 'e10adc3949ba59abbe56e057f20f883e', 'OPL Flushing', NULL, NULL, NULL, NULL, '14', 'N', 'nn4lgdqo0klocl59tnu8s2t2l8', '2020-03-12', NULL, '0', 197, '0'),
(209, 'opl_rematching', 'e10adc3949ba59abbe56e057f20f883e', 'OPL Rematching', NULL, NULL, NULL, NULL, '15', 'N', 'm74709vpkqspdh1r5lj7bflult', '2020-03-28', NULL, '0', 197, '0'),
(210, 'valled', 'e10adc3949ba59abbe56e057f20f883e', 'Petugas Valled', NULL, NULL, NULL, NULL, '16', 'N', 'utn4odtqbgqi8dkaajaqmvlqsi', '2020-03-16', NULL, '0', 197, '0'),
(211, 'tes_spooring', 'e10adc3949ba59abbe56e057f20f883e', 'Tes Spooring', NULL, NULL, NULL, NULL, '11', 'N', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-08', NULL, '0', 197, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE `user_level` (
  `id_level` int(5) NOT NULL,
  `level` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `role` text NOT NULL,
  `menu` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_level`, `level`, `title`, `role`, `menu`) VALUES
(1, 'superadmin', 'admin', '[{\"controller\":\"user\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"1\"},{\"controller\":\"category\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"1\"},{\"controller\":\"home\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"1\"},{\"controller\":\"login\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"1\"},{\"controller\":\"post\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"1\"},{\"controller\":\"gallery\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"1\"},{\"controller\":\"pages\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"1\"},{\"controller\":\"tracker\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"1\"},{\"controller\":\"ptm\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"1\"}]', 1),
(2, 'ptm', 'PTM', '[{\"controller\":\"home\",\"create\":\"0\",\"read\":\"1\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"login\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"user\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"tracker\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"0\"},{\"controller\":\"ptm\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"washing\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"forman\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"}]', 2),
(3, 'forman', 'Foreman', '[{\"controller\":\"home\",\"create\":\"0\",\"read\":\"1\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"login\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"user\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"tracker\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"ptm\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"forman\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"0\"},{\"controller\":\"washing\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"}]', 4),
(4, 'washing', 'Washing', '[{\"controller\":\"home\",\"create\":\"0\",\"read\":\"1\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"login\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"user\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"tracker\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"ptm\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"forman\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"washing\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"0\"}]', 6),
(5, 'sakku', 'SA', '[{\"controller\":\"washing\",\"create\":\"0\",\"read\":\"1\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"forman\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"user\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"home\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"login\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"tracker\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"0\"},{\"controller\":\"manager\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"booking\",\"create\":\"0\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"0\"}]', 2),
(6, 'manager', 'Manager', '[{\"controller\":\"forman\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"home\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"user\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"manager\",\"create\":\"0\",\"read\":\"1\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"tracker\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"washing\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"login\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"}]', 1),
(7, 'member', 'member', '[{\"controller\":\"-\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"-\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"-\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"-\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"-\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"-\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"-\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"}]', 1),
(8, 'mra', 'MRA', '[{\"controller\":\"forman\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"home\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"login\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"manager\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"tracker\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"user\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"washing\",\"create\":\"0\",\"read\":\"0\",\"update\":\"0\",\"delete\":\"0\"},{\"controller\":\"booking\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"delete\":\"1\"}]', 1),
(9, 'sales', 'Sales', '', 1),
(10, 'opl', 'OPL', '', 1),
(11, 'opl_spooring', 'OPL Spooring', '', 1),
(12, 'opl_salon', 'OPL Salon', '', 1),
(13, 'opl_ac', 'OPL AC', '', 1),
(14, 'opl_flushing', 'OPL Flushing', '', 1),
(15, 'opl_rematching', 'OPL Rematching', '', 1),
(16, 'valled', 'Petugas Valled', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `service_berkala`
--
ALTER TABLE `service_berkala`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mobil_to_mobil` (`id_mobil`);

--
-- Indexes for table `service_lain`
--
ALTER TABLE `service_lain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `tipe_mobil`
--
ALTER TABLE `tipe_mobil`
  ADD PRIMARY KEY (`id_tipe`);

--
-- Indexes for table `tracker`
--
ALTER TABLE `tracker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipe_id` (`tipe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `service_berkala`
--
ALTER TABLE `service_berkala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `service_lain`
--
ALTER TABLE `service_lain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tipe_mobil`
--
ALTER TABLE `tipe_mobil`
  MODIFY `id_tipe` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_level` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `service_berkala`
--
ALTER TABLE `service_berkala`
  ADD CONSTRAINT `id_mobil_to_mobil` FOREIGN KEY (`id_mobil`) REFERENCES `tipe_mobil` (`id_tipe`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
