-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Okt 2022 pada 08.23
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(19, 1, '2022-10-10', 2000000, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_anggota`
--

INSERT INTO `data_anggota` (`id_anggota`, `nik`, `nama_anggota`, `alamat_anggota`, `no_telp`, `jenis_kelamin`, `status`, `tanggal_masuk`, `photo`, `hak_akses`, `username`, `password`) VALUES
(1, '123', 'Ujang Bustomi', 'Komplek Pertanian Loji, Kel. Loji, Kec. Bogor Barat, Kota Bogor', '01283123', 'Laki-laki', '4', '2022-08-02', 'img_avatar31.png', 2, 'Ujang', '202cb962ac59075b964b07152d234b70'),
(3, '123', 'Hendi', 'Kota Bogorrrrrrrr', '021xxx', 'Laki-laki', '4', '2022-08-01', 'img_avatar13.png', 2, 'hendi', '202cb962ac59075b964b07152d234b70'),
(4, '123', 'Dodi', 'Kota Bogorrrrrrrr', '021xxxx', 'Laki-laki', '4', '2022-08-08', 'img_avatar32.png', 2, 'dodi', '202cb962ac59075b964b07152d234b70'),
(16, '01', 'Dini', 'Komplek Pertanian Loji, Kel. Loji, Kec. Bogor Barat, Kota Bogor', '021xxx', 'Perempuan', '1', '2022-08-28', 'img_avatar26.png', 1, 'dini', '202cb962ac59075b964b07152d234b70');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(120) NOT NULL,
  `is_pengurus` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_jabatan`
--

INSERT INTO `data_jabatan` (`id_jabatan`, `nama_jabatan`, `is_pengurus`) VALUES
(1, 'Ketua', 1),
(2, 'Sekretaris', 1),
(3, 'Bendahara', 1),
(4, 'Anggota Internal', 0),
(5, 'Anggota Eksternal', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_pinjaman`
--

INSERT INTO `data_pinjaman` (`id`, `id_anggota`, `no_pinjaman`, `jumlah_pinjaman`, `tanggal_pinjaman`, `lama`, `status`) VALUES
(4, 1, '123456789', 2000000, '2022-10-13', 12, 'belum lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_simpanan`
--

CREATE TABLE `data_simpanan` (
  `id_simpanan` int(11) NOT NULL,
  `jenis_simpanan` enum('sp','ss','sw') NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_simpanan`
--

INSERT INTO `data_simpanan` (`id_simpanan`, `jenis_simpanan`, `id_anggota`, `tanggal`, `jumlah`) VALUES
(1, 'sp', 3, '2022-08-03', 12312),
(3, 'sw', 3, '2022-08-03', 123123),
(4, 'sp', 1, '2022-08-03', 12312),
(5, 'sp', 3, '2022-08-01', 100000),
(6, '', 1, '0000-00-00', 123),
(7, '', 3, '0000-00-00', 10000),
(8, '', 3, '2022-08-25', 123),
(9, 'sp', 3, '2022-08-25', 123),
(10, 'sp', 3, '2022-08-25', 123),
(11, 'sp', 3, '2022-08-25', 123),
(12, 'sp', 3, '2022-08-25', 0),
(13, 'sp', 3, '2022-08-25', 123),
(14, 'sp', 3, '2022-08-25', 123),
(15, 'sp', 3, '2022-08-25', 123123),
(16, 'sp', 1, '2022-08-25', 0),
(17, 'sp', 1, '2022-08-25', 900),
(18, 'sp', 1, '2022-08-25', 900),
(19, 'sp', 1, '2022-08-25', 123),
(20, 'sp', 1, '2022-08-25', 200000),
(21, 'sw', 0, '2022-08-25', 2000),
(22, 'sw', 0, '2022-08-25', 2000),
(23, 'ss', 1, '2022-08-25', 200000),
(24, 'sw', 1, '2022-08-25', 300000),
(25, 'sp', 1, '2022-08-25', 300001),
(26, 'sp', 1, '2022-08-29', 25000),
(27, 'sp', 1, '2022-09-08', 0),
(28, 'sp', 4, '2022-09-08', 2000),
(29, 'sp', 1, '2022-09-08', 2000),
(30, 'sp', 1, '2022-09-08', 22222),
(31, 'sw', 3, '2022-09-08', 20000);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `simpanan_wajib`
--

INSERT INTO `simpanan_wajib` (`id_simpanan_wajib`, `id_anggota`, `tanggal`, `jumlah`, `status`) VALUES
(1, 1, '2022-10-10', 20000, 1);

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
-- Indeks untuk tabel `data_simpanan`
--
ALTER TABLE `data_simpanan`
  ADD PRIMARY KEY (`id_simpanan`);

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
  MODIFY `id_biaya_administrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `data_anggota`
--
ALTER TABLE `data_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `data_angsuran`
--
ALTER TABLE `data_angsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_jabatan`
--
ALTER TABLE `data_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `data_pinjaman`
--
ALTER TABLE `data_pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_simpanan`
--
ALTER TABLE `data_simpanan`
  MODIFY `id_simpanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `simpanan_wajib`
--
ALTER TABLE `simpanan_wajib`
  MODIFY `id_simpanan_wajib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
