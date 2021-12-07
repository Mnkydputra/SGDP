-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2021 at 10:39 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sgdp_pocket`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` varchar(20) NOT NULL,
  `npk` int(6) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `npk`, `password`, `role_id`) VALUES
('agt-220927', 220927, 'e10adc3949ba59abbe56e057f20f883e', 1),
('dnr-123456', 123456, 'e10adc3949ba59abbe56e057f20f883e', 2),
('sip-987654', 987654, 'e10adc3949ba59abbe56e057f20f883e', 4);

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_akun` varchar(25) DEFAULT NULL,
  `id_biodata` varchar(25) DEFAULT NULL,
  `id_employe` varchar(25) DEFAULT NULL,
  `id_korlap` varchar(25) NOT NULL,
  `id_danru` varchar(25) DEFAULT NULL,
  `id_berkas` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_akun`, `id_biodata`, `id_employe`, `id_korlap`, `id_danru`, `id_berkas`) VALUES
('agt-220927', 'agt-220927', 'agt-220927', '', 'dnr-123456', 'agt-220927');

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id_berkas` varchar(25) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berkas`
--

INSERT INTO `berkas` (`id_berkas`, `foto`) VALUES
('agt-220927', 'Potoagt-220927.jpg'),
('sip-987654', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE `biodata` (
  `id_biodata` varchar(25) NOT NULL,
  `npk` int(6) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `ktp` varchar(16) DEFAULT NULL,
  `kk` varchar(16) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `no_emergency` varchar(13) DEFAULT NULL,
  `tinggi_badan` int(3) DEFAULT NULL,
  `berat_badan` int(3) DEFAULT NULL,
  `imt` int(3) DEFAULT NULL,
  `jl_ktp` varchar(255) DEFAULT NULL,
  `rt_ktp` varchar(10) DEFAULT NULL,
  `rw_ktp` varchar(10) DEFAULT NULL,
  `kel_ktp` varchar(100) DEFAULT NULL,
  `kec_ktp` varchar(100) DEFAULT NULL,
  `kota_ktp` varchar(100) DEFAULT NULL,
  `jl_dom` varchar(255) DEFAULT NULL,
  `rt_dom` varchar(10) DEFAULT NULL,
  `rw_dom` varchar(10) DEFAULT NULL,
  `kel_dom` varchar(100) DEFAULT NULL,
  `kec_dom` varchar(100) DEFAULT NULL,
  `kota_dom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id_biodata`, `npk`, `nama`, `ktp`, `kk`, `email`, `no_hp`, `no_emergency`, `tinggi_badan`, `berat_badan`, `imt`, `jl_ktp`, `rt_ktp`, `rw_ktp`, `kel_ktp`, `kec_ktp`, `kota_ktp`, `jl_dom`, `rt_dom`, `rw_dom`, `kel_dom`, `kec_dom`, `kota_dom`) VALUES
('agt-220927', 220927, 'Murry Febriansyah Putra', '3172021402980003', '12144154', 'mreuhreufn@gmail.com', '087886511096', '08558876512', 172, 55, 0, 'asjdkasdjeiji no.23', '11', '11', 'wareajkas', 'adasdsa', 'jakarta', 'maksmdfn', '11', '11', 'jfisjdsi', 'dijfkejfejiw', 'ojkaodkweod'),
('sip-987654', 987654, 'Murrs Fucking Brian', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `danru`
--

CREATE TABLE `danru` (
  `id_danru` varchar(25) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `id_akun` varchar(25) DEFAULT NULL,
  `id_biodata` varchar(25) DEFAULT NULL,
  `id_employe` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `danru`
--

INSERT INTO `danru` (`id_danru`, `nama`, `id_akun`, `id_biodata`, `id_employe`) VALUES
('dnr-123456', 'Sarudin', 'dnr-123456', 'dnr-123456', 'dnr-123456');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id_employee` varchar(25) NOT NULL,
  `npk` int(6) NOT NULL,
  `no_kta` varchar(100) DEFAULT NULL,
  `expired_kta` date DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `status_anggota` varchar(100) DEFAULT NULL,
  `status_kta` varchar(100) DEFAULT NULL,
  `area_kerja` varchar(100) DEFAULT NULL,
  `wilayah` varchar(100) DEFAULT NULL,
  `tgl_masuk_sigap` date DEFAULT NULL,
  `tgl_masuk_adm` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id_employee`, `npk`, `no_kta`, `expired_kta`, `jabatan`, `status_anggota`, `status_kta`, `area_kerja`, `wilayah`, `tgl_masuk_sigap`, `tgl_masuk_adm`) VALUES
('agt-220927', 220927, '215454152231', '2021-12-16', NULL, NULL, 'Aktif', NULL, NULL, NULL, NULL),
('sip-987654', 987654, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `korlap`
--

CREATE TABLE `korlap` (
  `id_korlap` varchar(25) NOT NULL,
  `id_akun` varchar(25) DEFAULT NULL,
  `id_biodata` varchar(25) DEFAULT NULL,
  `id_employee` varchar(25) DEFAULT NULL,
  `id_berkas` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sipd`
--

CREATE TABLE `sipd` (
  `id_sipd` varchar(25) NOT NULL,
  `id_akun` varchar(25) DEFAULT NULL,
  `id_korlap` varchar(25) DEFAULT NULL,
  `id_danru` varchar(25) DEFAULT NULL,
  `id_anggota` varchar(25) DEFAULT NULL,
  `id_biodata` varchar(25) DEFAULT NULL,
  `id_employee` varchar(25) DEFAULT NULL,
  `id_berkas` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sipd`
--

INSERT INTO `sipd` (`id_sipd`, `id_akun`, `id_korlap`, `id_danru`, `id_anggota`, `id_biodata`, `id_employee`, `id_berkas`) VALUES
('sip-987654', 'sip-987654', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD UNIQUE KEY `id_berkas` (`id_berkas`),
  ADD UNIQUE KEY `id_korlap` (`id_korlap`),
  ADD UNIQUE KEY `id_akun` (`id_akun`),
  ADD UNIQUE KEY `id_biodata` (`id_biodata`),
  ADD UNIQUE KEY `id_employe` (`id_employe`),
  ADD UNIQUE KEY `id_danru` (`id_danru`);

--
-- Indexes for table `berkas`
--
ALTER TABLE `berkas`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id_biodata`);

--
-- Indexes for table `danru`
--
ALTER TABLE `danru`
  ADD PRIMARY KEY (`id_danru`),
  ADD UNIQUE KEY `id_akun` (`id_akun`),
  ADD UNIQUE KEY `id_biodata` (`id_biodata`),
  ADD UNIQUE KEY `id_employe` (`id_employe`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id_employee`);

--
-- Indexes for table `korlap`
--
ALTER TABLE `korlap`
  ADD PRIMARY KEY (`id_korlap`),
  ADD UNIQUE KEY `id_akun` (`id_akun`),
  ADD UNIQUE KEY `id_biodata` (`id_biodata`),
  ADD UNIQUE KEY `id_employee` (`id_employee`),
  ADD UNIQUE KEY `id_berkas` (`id_berkas`);

--
-- Indexes for table `sipd`
--
ALTER TABLE `sipd`
  ADD PRIMARY KEY (`id_sipd`),
  ADD UNIQUE KEY `id_akun` (`id_akun`),
  ADD UNIQUE KEY `id_korlap` (`id_korlap`),
  ADD UNIQUE KEY `id_danru` (`id_danru`),
  ADD UNIQUE KEY `id_anggota` (`id_anggota`),
  ADD UNIQUE KEY `id_biodata` (`id_biodata`),
  ADD UNIQUE KEY `id_employee` (`id_employee`),
  ADD UNIQUE KEY `id_berkas` (`id_berkas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
