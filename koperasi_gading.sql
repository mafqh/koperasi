-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Feb 2023 pada 14.18
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

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
-- Struktur dari tabel `biaya_administrasi`
--

CREATE TABLE `biaya_administrasi` (
  `id_biaya_administrasi` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `biaya_administrasi`
--

INSERT INTO `biaya_administrasi` (`id_biaya_administrasi`, `id_anggota`, `tanggal`, `jumlah`, `status`) VALUES
(8, 1, '2022-09-08', 2000, 1),
(11, 1, '2022-09-08', 8000, 1),
(12, 1, '2022-09-08', 5000, 1),
(13, 1, '2022-09-08', 6000, 0),
(15, 4, '2022-09-17', 21000, 1),
(16, 1, '2022-09-19', 2000, 1),
(17, 1, '2022-10-03', 20000, 1),
(18, 1, '2022-10-10', 200000, 1),
(19, 1, '2022-10-10', 2000000, 1),
(21, 18, '2022-10-24', 15000, 1),
(22, 17, '2022-10-24', 20000, 1),
(23, 18, '2022-10-24', 5000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_anggota`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_anggota`
--

INSERT INTO `data_anggota` (`id_anggota`, `nik`, `nama_anggota`, `alamat_anggota`, `no_telp`, `jenis_kelamin`, `status`, `tanggal_masuk`, `photo`, `hak_akses`, `username`, `password`) VALUES
(1, '123', 'Ujang Bustomi', 'Komplek Pertanian Loji, Kel. Loji, Kec. Bogor Barat, Kota Bogor', '01283123', 'Laki-laki', '5', '2022-08-02', 'img_avatar31.png', 2, 'Ujang', '202cb962ac59075b964b07152d234b70'),
(3, '123', 'Hendi', 'Kota Bogorrrrrrrr', '021xxx', 'Laki-laki', '5', '2022-08-01', 'img_avatar13.png', 2, 'hendi', '202cb962ac59075b964b07152d234b70'),
(4, '123', 'Dodi', 'Kota Bogorrrrrrrr', '021xxxx', 'Laki-laki', '5', '2022-08-08', 'img_avatar32.png', 2, 'dodi', '202cb962ac59075b964b07152d234b70'),
(16, '01', 'Dini', 'Komplek Pertanian Loji, Kel. Loji, Kec. Bogor Barat, Kota Bogor', '021xxx', 'Perempuan', '2', '2022-08-28', 'img_avatar26.png', 1, 'dini', '202cb962ac59075b964b07152d234b70'),
(18, '12313123', 'asdsad', 'asdadsadas', '12313123213', 'Laki-laki', '6', '2022-10-22', 'dummy-user1.png', 2, 'asdasd', 'ec02c59dee6faaca3189bace969c22d3'),
(19, 'superadmin', 'Superadmin', '', '', 'Laki-Laki', '1', '2022-08-28', 'img_avatar26.png', 1, 'superadmin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_angsuran`
--

CREATE TABLE `data_angsuran` (
  `id` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `no_angsuran` varchar(50) NOT NULL,
  `jumlah_angsuran` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_angsuran`
--

INSERT INTO `data_angsuran` (`id`, `id_pinjaman`, `no_angsuran`, `jumlah_angsuran`, `tanggal_bayar`) VALUES
(3, 5, '132131222', 3000000, '2022-10-14'),
(5, 5, 'A2301025002', 1000, '2023-01-02'),
(6, 4, 'A2301104001', 10000, '2023-01-10'),
(7, 9, 'A2301139001', 1000000, '2023-01-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(120) NOT NULL,
  `is_pengurus` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_jabatan`
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
-- Struktur dari tabel `data_pinjaman`
--

CREATE TABLE `data_pinjaman` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `no_pinjaman` varchar(50) NOT NULL,
  `jumlah_pinjaman` int(11) NOT NULL,
  `tanggal_pinjaman` date NOT NULL,
  `lama` int(11) NOT NULL,
  `status` enum('lunas','belum lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_pinjaman`
--

INSERT INTO `data_pinjaman` (`id`, `id_anggota`, `no_pinjaman`, `jumlah_pinjaman`, `tanggal_pinjaman`, `lama`, `status`) VALUES
(4, 1, '123456789', 2000000, '2022-10-13', 12, 'belum lunas'),
(5, 4, '3213123123', 2000000, '2022-10-14', 12, 'lunas'),
(6, 1, 'P20221230', 5000000, '2022-12-30', 12, 'belum lunas'),
(7, 1, 'P202212300004', 3500000, '2022-12-30', 15, 'belum lunas'),
(8, 1, 'P202212301004', 55000, '2022-12-30', 15, 'belum lunas'),
(9, 1, 'P2301131005', 24000000, '2023-01-13', 24, 'belum lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `menu` varchar(225) NOT NULL,
  `fungsi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hak_akses`
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
(1221, 3, 'dashboard', 1),
(1222, 3, 'gantiPassword', 1),
(1223, 4, 'dashboard', 1),
(1224, 4, 'gantiPassword', 1),
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
(1244, 6, 'gantiPassword', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan_tabungan`
--

CREATE TABLE `simpanan_tabungan` (
  `id_simpanan_tabungan` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jenis_simpanan` enum('pemasukan','pengeluaran') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `simpanan_tabungan`
--

INSERT INTO `simpanan_tabungan` (`id_simpanan_tabungan`, `id_anggota`, `tanggal`, `jumlah`, `jenis_simpanan`) VALUES
(12, 1, '2022-12-28', 400000, 'pemasukan'),
(13, 1, '2022-12-28', 200000, 'pengeluaran'),
(14, 3, '2022-12-28', 500000, 'pemasukan'),
(15, 3, '2022-12-28', 500000, 'pemasukan'),
(16, 3, '2022-12-28', 200000, 'pengeluaran'),
(17, 1, '2022-12-28', 10000, 'pengeluaran'),
(18, 1, '2022-12-28', 50000, 'pemasukan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan_wajib`
--

CREATE TABLE `simpanan_wajib` (
  `id_simpanan_wajib` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `simpanan_wajib`
--

INSERT INTO `simpanan_wajib` (`id_simpanan_wajib`, `id_anggota`, `tanggal`, `jumlah`, `status`) VALUES
(1, 1, '2022-10-10', 20000, 1),
(2, 0, '2022-10-29', 0, 1),
(3, 0, '2022-10-29', 180000, 1),
(4, 1, '2022-10-29', 180000, 1),
(6, 1, '2023-02-04', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `biaya_administrasi`
--
ALTER TABLE `biaya_administrasi`
  ADD PRIMARY KEY (`id_biaya_administrasi`);

--
-- Indeks untuk tabel `data_anggota`
--
ALTER TABLE `data_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `data_angsuran`
--
ALTER TABLE `data_angsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `data_pinjaman`
--
ALTER TABLE `data_pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `simpanan_tabungan`
--
ALTER TABLE `simpanan_tabungan`
  ADD PRIMARY KEY (`id_simpanan_tabungan`);

--
-- Indeks untuk tabel `simpanan_wajib`
--
ALTER TABLE `simpanan_wajib`
  ADD PRIMARY KEY (`id_simpanan_wajib`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `biaya_administrasi`
--
ALTER TABLE `biaya_administrasi`
  MODIFY `id_biaya_administrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `data_anggota`
--
ALTER TABLE `data_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `data_angsuran`
--
ALTER TABLE `data_angsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `data_pinjaman`
--
ALTER TABLE `data_pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1245;

--
-- AUTO_INCREMENT untuk tabel `simpanan_tabungan`
--
ALTER TABLE `simpanan_tabungan`
  MODIFY `id_simpanan_tabungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `simpanan_wajib`
--
ALTER TABLE `simpanan_wajib`
  MODIFY `id_simpanan_wajib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
