-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2023 at 04:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.33

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
(8, 1, '2022-09-08', 2000, 1),
(11, 1, '2022-09-08', 8000, 1),
(12, 1, '2022-09-08', 5000, 1),
(13, 1, '2022-09-08', 6000, 0),
(15, 4, '2022-09-17', 21000, 1),
(16, 1, '2022-09-19', 2000, 1),
(21, 18, '2022-10-24', 15000, 1),
(22, 17, '2022-10-24', 20000, 1),
(23, 18, '2022-10-24', 5000, 1),
(24, 1, '2023-04-04', 100000, 1),
(25, 1, '2023-04-04', 77000, 1);

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
(1, '04', 'Ujang Bustomi', 'Komplek Pertanian Loji, Kel. Loji, Kec. Bogor Barat, Kota Bogor', '01283123', 'Laki-laki', '6', '2022-08-02', 'img_avatar31.png', 2, 'Ujang', '202cb962ac59075b964b07152d234b70'),
(3, '05', 'Hendi', 'Perumahan Bogor Gading Residence', '021xxx', 'Laki-laki', '5', '2022-08-01', 'img_avatar13.png', 2, 'hendi', '202cb962ac59075b964b07152d234b70'),
(4, '06', 'Dodi', 'Perumahan Bogor Gading Residence', '021xxxx', 'Laki-laki', '5', '2022-08-08', 'img_avatar32.png', 2, 'dodi', '202cb962ac59075b964b07152d234b70'),
(16, '01', 'Dini', 'Komplek Pertanian Loji, Kel. Loji, Kec. Bogor Barat, Kota Bogor', '021xxx', 'Perempuan', '2', '2022-08-28', 'img_avatar26.png', 1, 'dini', '202cb962ac59075b964b07152d234b70'),
(18, '07', 'Putu', 'Kota Bogor', '021xxxxxx', 'Laki-laki', '6', '2022-10-22', 'img_avatar191.png', 2, 'putu', 'ec02c59dee6faaca3189bace969c22d3'),
(19, 'superadmin', 'Superadmin', '', '', 'Laki-Laki', '1', '2022-08-28', 'img_avatar26.png', 1, 'superadmin', '202cb962ac59075b964b07152d234b70'),
(20, '08', 'Lui', 'Perumahan Bogor Gading Residence', '021xxx', 'Perempuan', '5', '2023-02-22', 'img_avatar215.png', 2, 'lui', '202cb962ac59075b964b07152d234b70'),
(21, '09', 'Hany', 'Perumahan Bogor Gading Residence', '021xxx', 'Perempuan', '5', '2023-02-22', 'img_avatar216.png', 2, 'hany', '202cb962ac59075b964b07152d234b70'),
(22, '10', 'Murni', 'Perumahan Bogor Gading Residence', '021xxx', 'Perempuan', '5', '2023-02-22', 'img_avatar28.png', 2, 'murni', '202cb962ac59075b964b07152d234b70'),
(23, '02', 'Indra', 'Perumahan Bogor Gading Residence', '021xxx', 'Laki-laki', '3', '2023-02-22', 'dodi.png', 1, 'indra', '202cb962ac59075b964b07152d234b70'),
(24, '03', 'Henny', 'Perumahan Bogor Gading Residence', '021xxx', 'Perempuan', '4', '2023-02-22', 'img_avatar217.png', 1, 'henny', '202cb962ac59075b964b07152d234b70'),
(25, '10', 'faqih', 'Kota Bogor', '08xxxxx', 'Laki-laki', '5', '2023-04-05', '', 2, 'faqih', '202cb962ac59075b964b07152d234b70');

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
(8, 10, 'A23022310001', 50000, '2023-02-23');

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
(1, 'Superadmin', -1),
(2, 'Ketua', 1),
(3, 'Sekretaris', 1),
(4, 'Bendahara', 1),
(5, 'Anggota Internal', 0),
(6, 'Anggota Eksternal', 0);

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
(10, 1, 'P2302231001', 150000, '2023-02-23', 3, 'belum lunas');

-- --------------------------------------------------------

--
-- Table structure for table `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `menu` varchar(225) NOT NULL,
  `fungsi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `id_jabatan`, `menu`, `fungsi`) VALUES
(1184, 2, 'dashboard', 1),
(1185, 2, 'dataJabatan', 1),
(1186, 2, 'dataJabatan', 7),
(1187, 2, 'dataPengurus', 1),
(1188, 2, 'dataPengurus', 2),
(1189, 2, 'dataPengurus', 3),
(1190, 2, 'dataPengurus', 4),
(1191, 2, 'dataAnggota', 1),
(1192, 2, 'dataAnggota', 2),
(1193, 2, 'dataAnggota', 3),
(1194, 2, 'dataAnggota', 4),
(1195, 2, 'dataAnggota', 6),
(1196, 2, 'simpananPokok', 1),
(1197, 2, 'simpananPokok', 2),
(1198, 2, 'simpananPokok', 3),
(1199, 2, 'simpananPokok', 4),
(1200, 2, 'simpananPokok', 5),
(1201, 2, 'simpananPokok', 6),
(1202, 2, 'simpananWajib', 1),
(1203, 2, 'simpananWajib', 2),
(1204, 2, 'simpananWajib', 3),
(1205, 2, 'simpananWajib', 4),
(1206, 2, 'simpananWajib', 5),
(1207, 2, 'simpananWajib', 6),
(1208, 2, 'simpananSukarela', 1),
(1209, 2, 'simpananSukarela', 2),
(1210, 2, 'simpananSukarela', 3),
(1211, 2, 'simpananSukarela', 4),
(1212, 2, 'simpananSukarela', 5),
(1213, 2, 'simpananSukarela', 6),
(1214, 2, 'pinjaman', 1),
(1215, 2, 'pinjaman', 2),
(1216, 2, 'pinjaman', 3),
(1217, 2, 'pinjaman', 4),
(1218, 2, 'pinjaman', 5),
(1219, 2, 'pinjaman', 6),
(1220, 2, 'gantiPassword', 1),
(1225, 5, 'dashboard', 1),
(1226, 5, 'simpananPokok', 1),
(1227, 5, 'simpananPokok', 6),
(1228, 5, 'simpananWajib', 1),
(1229, 5, 'simpananWajib', 6),
(1230, 5, 'simpananSukarela', 1),
(1231, 5, 'simpananSukarela', 6),
(1232, 5, 'pinjaman', 1),
(1233, 5, 'pinjaman', 6),
(1234, 5, 'gantiPassword', 1),
(1235, 6, 'dashboard', 1),
(1236, 6, 'simpananPokok', 1),
(1237, 6, 'simpananPokok', 6),
(1238, 6, 'simpananWajib', 1),
(1239, 6, 'simpananWajib', 6),
(1240, 6, 'simpananSukarela', 1),
(1241, 6, 'simpananSukarela', 6),
(1242, 6, 'pinjaman', 1),
(1243, 6, 'pinjaman', 6),
(1244, 6, 'gantiPassword', 1),
(1245, 3, 'dashboard', 1),
(1246, 3, 'dataPengurus', 1),
(1247, 3, 'dataPengurus', 2),
(1248, 3, 'dataPengurus', 3),
(1249, 3, 'dataPengurus', 4),
(1250, 3, 'dataAnggota', 1),
(1251, 3, 'dataAnggota', 2),
(1252, 3, 'dataAnggota', 3),
(1253, 3, 'dataAnggota', 4),
(1254, 3, 'dataAnggota', 6),
(1255, 3, 'gantiPassword', 1),
(1256, 4, 'dashboard', 1),
(1257, 4, 'simpananPokok', 1),
(1258, 4, 'simpananPokok', 2),
(1259, 4, 'simpananPokok', 3),
(1260, 4, 'simpananPokok', 4),
(1261, 4, 'simpananPokok', 5),
(1262, 4, 'simpananPokok', 6),
(1263, 4, 'simpananWajib', 1),
(1264, 4, 'simpananWajib', 2),
(1265, 4, 'simpananWajib', 3),
(1266, 4, 'simpananWajib', 4),
(1267, 4, 'simpananWajib', 5),
(1268, 4, 'simpananWajib', 6),
(1269, 4, 'simpananSukarela', 1),
(1270, 4, 'simpananSukarela', 2),
(1271, 4, 'simpananSukarela', 3),
(1272, 4, 'simpananSukarela', 4),
(1273, 4, 'simpananSukarela', 5),
(1274, 4, 'simpananSukarela', 6),
(1275, 4, 'pinjaman', 1),
(1276, 4, 'pinjaman', 2),
(1277, 4, 'pinjaman', 3),
(1278, 4, 'pinjaman', 4),
(1279, 4, 'pinjaman', 5),
(1280, 4, 'pinjaman', 6),
(1281, 4, 'gantiPassword', 1);

-- --------------------------------------------------------

--
-- Table structure for table `simpanan_tabungan`
--

CREATE TABLE `simpanan_tabungan` (
  `id_simpanan_tabungan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jenis_simpanan` enum('pemasukan','pengeluaran') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simpanan_tabungan`
--

INSERT INTO `simpanan_tabungan` (`id_simpanan_tabungan`, `id_anggota`, `tanggal`, `jumlah`, `jenis_simpanan`) VALUES
(12, 1, '2023-04-05', 400000, 'pemasukan'),
(13, 1, '2022-12-28', 200000, 'pengeluaran'),
(14, 3, '2022-12-28', 500000, 'pemasukan'),
(15, 3, '2022-12-28', 500000, 'pemasukan'),
(16, 3, '2022-12-28', 200000, 'pengeluaran'),
(17, 1, '2022-12-28', 10000, 'pengeluaran'),
(18, 1, '2022-12-28', 50000, 'pemasukan'),
(19, 4, '2023-03-18', 200000, 'pemasukan'),
(20, 23, '2023-03-18', 300000, 'pemasukan'),
(21, 22, '2023-03-18', 150000, 'pemasukan'),
(22, 21, '2023-03-18', 50000, 'pemasukan'),
(23, 20, '2023-03-18', 100000, 'pemasukan'),
(24, 18, '2023-03-18', 200000, 'pemasukan'),
(25, 16, '2023-03-18', 100000, 'pemasukan');

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
(1, 1, '2022-10-10', 20000, 1),
(2, 0, '2022-10-29', 0, 1),
(3, 0, '2022-10-29', 180000, 1),
(4, 1, '2022-10-29', 180000, 1);

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
-- Indexes for table `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpanan_tabungan`
--
ALTER TABLE `simpanan_tabungan`
  ADD PRIMARY KEY (`id_simpanan_tabungan`);

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
  MODIFY `id_biaya_administrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `data_anggota`
--
ALTER TABLE `data_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `data_angsuran`
--
ALTER TABLE `data_angsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_pinjaman`
--
ALTER TABLE `data_pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1282;

--
-- AUTO_INCREMENT for table `simpanan_tabungan`
--
ALTER TABLE `simpanan_tabungan`
  MODIFY `id_simpanan_tabungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `simpanan_wajib`
--
ALTER TABLE `simpanan_wajib`
  MODIFY `id_simpanan_wajib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
