-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2022 at 10:19 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi_gading`
--

-- --------------------------------------------------------

--
-- Table structure for table `biaya_administrasi`
--

CREATE TABLE `biaya_administrasi` (
  `id_biaya_administrasi` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `biaya_administrasi`
--

INSERT INTO `biaya_administrasi` (`id_biaya_administrasi`, `id_anggota`, `tanggal`, `jumlah`, `status`) VALUES
(22, 1, '2022-10-14', 20000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_anggota`
--

CREATE TABLE `data_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `alamat_anggota` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `photo` varchar(225) NOT NULL,
  `hak_akses` int(11) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_anggota`
--

INSERT INTO `data_anggota` (`id_anggota`, `nik`, `nama_anggota`, `alamat_anggota`, `no_telp`, `jenis_kelamin`, `status`, `tanggal_masuk`, `photo`, `hak_akses`, `username`, `password`) VALUES
(1, '01', 'Ujang Bustomi', 'Komplek Pertanian Loji, Kel. Loji, Kec. Bogor Barat, Kota Bogor', '01283123', 'Laki-laki', '4', '2022-08-02', 'img_avatar31.png', 2, 'Ujang', '202cb962ac59075b964b07152d234b70'),
(3, '02', 'Hendi Hidayat', 'Kota Bogorrrrrrrr', '021xxx', 'Laki-laki', '4', '2022-08-01', 'img_avatar13.png', 2, 'hendi', '202cb962ac59075b964b07152d234b70'),
(4, '03', 'Dodi Setiawan', 'Kota Bogorrrrrrrr', '021xxxx', 'Laki-laki', '4', '2022-08-08', 'img_avatar32.png', 2, 'dodi', '202cb962ac59075b964b07152d234b70'),
(16, '01', 'Dini', 'Komplek Pertanian Loji, Kel. Loji, Kec. Bogor Barat, Kota Bogor', '021xxx', 'Perempuan', '1', '2022-08-28', 'img_avatar26.png', 1, 'dini', '202cb962ac59075b964b07152d234b70'),
(17, '04', 'Farhan Maulana', 'Komplek Pertanian Loji, Kel. Loji, Kec. Bogor Barat, Kota Bogor', '021xxx', 'Laki-laki', '4', '2022-10-15', 'img_avatar19.png', 2, 'farhan', '202cb962ac59075b964b07152d234b70'),
(19, '05', 'Usman Putra', '', '', 'Perempuan', '5', '2022-10-15', 'img_avatar34.png', 2, 'usman', '202cb962ac59075b964b07152d234b70'),
(20, '06', 'qwe', '', '', 'Laki-laki', '4', '2022-10-18', 'img_avatar111.png', 2, 'qwe', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `data_angsuran`
--

CREATE TABLE `data_angsuran` (
  `id` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `no_angsuran` varchar(50) NOT NULL,
  `jumlah_angsuran` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_angsuran`
--

INSERT INTO `data_angsuran` (`id`, `id_pinjaman`, `no_angsuran`, `jumlah_angsuran`, `tanggal_bayar`) VALUES
(6, 8, '1', 5000, '2022-10-15'),
(7, 8, '2', 5000, '2022-10-16');

-- --------------------------------------------------------

--
-- Table structure for table `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(120) NOT NULL,
  `is_pengurus` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_jabatan`
--

INSERT INTO `data_jabatan` (`id_jabatan`, `nama_jabatan`, `is_pengurus`) VALUES
(1, 'Ketua', 1),
(2, 'Sekretaris', 1),
(3, 'Bendahara', 1),
(4, 'Anggota Internal', 0),
(5, 'Anggota Eksternal', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_pinjaman`
--

CREATE TABLE `data_pinjaman` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `no_pinjaman` varchar(50) NOT NULL,
  `jumlah_pinjaman` int(11) NOT NULL,
  `tanggal_pinjaman` date NOT NULL,
  `lama` int(11) NOT NULL,
  `status` enum('lunas','belum lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pinjaman`
--

INSERT INTO `data_pinjaman` (`id`, `id_anggota`, `no_pinjaman`, `jumlah_pinjaman`, `tanggal_pinjaman`, `lama`, `status`) VALUES
(8, 1, '1', 10000, '2022-10-14', 2, 'belum lunas'),
(9, 3, '2', 15000, '2022-10-14', 3, 'belum lunas');

-- --------------------------------------------------------

--
-- Table structure for table `data_simpanan`
--

CREATE TABLE `data_simpanan` (
  `id_simpanan` int(11) NOT NULL,
  `jenis_simpanan` enum('sp','ss','sw') NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `simpanan_wajib`
--

CREATE TABLE `simpanan_wajib` (
  `id_simpanan_wajib` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simpanan_wajib`
--

INSERT INTO `simpanan_wajib` (`id_simpanan_wajib`, `id_anggota`, `tanggal`, `jumlah`, `status`) VALUES
(2, 1, '2022-10-14', 10000, 1),
(3, 1, '2022-10-14', 12000, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biaya_administrasi`
--
ALTER TABLE `biaya_administrasi`
  ADD PRIMARY KEY (`id_biaya_administrasi`);

--
-- Indexes for table `data_anggota`
--
ALTER TABLE `data_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `data_angsuran`
--
ALTER TABLE `data_angsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `data_pinjaman`
--
ALTER TABLE `data_pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_simpanan`
--
ALTER TABLE `data_simpanan`
  ADD PRIMARY KEY (`id_simpanan`);

--
-- Indexes for table `simpanan_wajib`
--
ALTER TABLE `simpanan_wajib`
  ADD PRIMARY KEY (`id_simpanan_wajib`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biaya_administrasi`
--
ALTER TABLE `biaya_administrasi`
  MODIFY `id_biaya_administrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `data_anggota`
--
ALTER TABLE `data_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `data_angsuran`
--
ALTER TABLE `data_angsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_pinjaman`
--
ALTER TABLE `data_pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_simpanan`
--
ALTER TABLE `data_simpanan`
  MODIFY `id_simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `simpanan_wajib`
--
ALTER TABLE `simpanan_wajib`
  MODIFY `id_simpanan_wajib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
