-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Sep 2022 pada 17.14
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bumdes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aktiva_lancar`
--

CREATE TABLE `aktiva_lancar` (
  `id_aktiva_lancar` int(11) NOT NULL,
  `nama_aktiva` varchar(100) DEFAULT NULL,
  `nominal` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aktiva_lancar`
--

INSERT INTO `aktiva_lancar` (`id_aktiva_lancar`, `nama_aktiva`, `nominal`) VALUES
(1, 'Kas', 4596100),
(2, 'Bank BRI', 20652000),
(3, 'BRILink', 16542061),
(4, 'Persediaan Barang Dagang', 25740000),
(5, 'Perlengkapan Kantor', 1028000),
(6, 'Piutang Operasional', 4400000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `aktiva_tetap`
--

CREATE TABLE `aktiva_tetap` (
  `id_aktiva_tetap` int(11) NOT NULL,
  `nama_aktiva` varchar(100) DEFAULT NULL,
  `nominal` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aktiva_tetap`
--

INSERT INTO `aktiva_tetap` (`id_aktiva_tetap`, `nama_aktiva`, `nominal`) VALUES
(1, 'Peralatan Kantor', 75196500),
(2, 'Kendaraan', 30000000),
(3, 'DO Gas', 75000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `total_harga_beli` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `stok`, `total_harga_beli`, `harga_satuan`, `harga_jual`, `profit`, `id_satuan`, `id_kategori`, `id_supplier`, `deleted_at`) VALUES
('KDB0001', 'gas 3kg', 10, 210000, 21000, 22000, 1000, 20, 32, 11, NULL),
('KDB0002', 'teh gelas', 10, 300000, 30000, 32000, 2000, 22, 35, 12, NULL),
('KDB0003', 'indomie goreng', 1, 30000, 30000, 32000, 2000, 22, 31, 11, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `brilink`
--

CREATE TABLE `brilink` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nominal_transaksi` varchar(225) NOT NULL,
  `biaya_admin` varchar(100) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `brilink`
--

INSERT INTO `brilink` (`id`, `tanggal`, `nominal_transaksi`, `biaya_admin`, `deleted_at`, `id_user`) VALUES
(10, '2022-08-29', ' 150000', '6000', NULL, 52),
(11, '2022-08-29', ' 1000000', '10000', NULL, 52),
(12, '2022-09-05', ' 20000', ' 10000', NULL, 46),
(13, '2022-09-06', ' 1000000', ' 10000', NULL, 46),
(14, '2022-09-06', ' 2000000', ' 15000', NULL, 46),
(15, '2022-09-06', '100000', '100000', NULL, 46),
(16, '2022-09-14', ' 100000', ' 5000', NULL, 46);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_barang_masuk`
--

CREATE TABLE `data_barang_masuk` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `total_harga_beli` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_barang_masuk`
--

INSERT INTO `data_barang_masuk` (`id`, `kode_barang`, `stok`, `total_harga_beli`, `tanggal_masuk`) VALUES
(21, 'KDB0001', 10, 210000, '2022-09-20'),
(22, 'KDB0002', 10, 300000, '2022-09-20'),
(23, 'KDB0003', 1, 30000, '2022-09-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_beban`
--

CREATE TABLE `data_beban` (
  `id_beban` int(11) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_beban`
--

INSERT INTO `data_beban` (`id_beban`, `keterangan`, `nominal`) VALUES
(2, 'Listrik', 500000),
(3, 'Operasional BM Gas', 280000),
(4, 'Biaya laporan tahun 2022', 150000),
(5, 'Biaya Opensasional ke PT CAM', 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_laporan`
--

CREATE TABLE `data_laporan` (
  `id_laporan` int(11) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `laporan_penjualan` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `feedback` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_laporan_barang_keluar`
--

CREATE TABLE `data_laporan_barang_keluar` (
  `id_laporan` int(11) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `nama_laporan` varchar(225) NOT NULL,
  `status` varchar(50) NOT NULL,
  `feedback` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_laporan_barang_keluar`
--

INSERT INTO `data_laporan_barang_keluar` (`id_laporan`, `tgl_awal`, `tgl_akhir`, `nama_laporan`, `status`, `feedback`, `created_at`, `updated_at`) VALUES
(5, '2022-09-20', '2022-10-20', 'Laporan_Barang_Keluar1.pdf', 'proses', NULL, '2022-09-20 18:34:54', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_laporan_barang_masuk`
--

CREATE TABLE `data_laporan_barang_masuk` (
  `id_laporan` int(11) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `nama_laporan` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `feedback` varchar(225) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_laporan_barang_masuk`
--

INSERT INTO `data_laporan_barang_masuk` (`id_laporan`, `tgl_awal`, `tgl_akhir`, `nama_laporan`, `status`, `feedback`, `created_at`, `updated_at`) VALUES
(5, '2022-09-20', '2022-09-20', 'Laporan_Barang_Masuk2.pdf', 'proses', NULL, '2022-09-20 18:34:38', NULL),
(6, '2022-09-01', '2022-09-30', 'Laporan_Barang_Masuk3.pdf', 'sukses', NULL, '2022-09-20 18:35:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_laporan_laba_rugi`
--

CREATE TABLE `data_laporan_laba_rugi` (
  `id_laporan` int(11) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `nama_laporan` varchar(225) NOT NULL,
  `status` varchar(10) NOT NULL,
  `feedback` varchar(225) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `data_laporan_laba_rugi`
--

INSERT INTO `data_laporan_laba_rugi` (`id_laporan`, `tgl_awal`, `tgl_akhir`, `nama_laporan`, `status`, `feedback`, `created_at`, `updated_at`) VALUES
(5, '2022-08-01', '2022-09-30', 'Laporan_Laba_Rugi_01-08-2022_-_30-09-2022.pdf', 'sukses', NULL, '2022-08-29 14:49:43', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_laporan_neraca`
--

CREATE TABLE `data_laporan_neraca` (
  `id_laporan` int(11) NOT NULL,
  `tgl_awal` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `nama_laporan` varchar(225) NOT NULL,
  `status` varchar(10) NOT NULL,
  `feedback` varchar(225) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_laporan_neraca`
--

INSERT INTO `data_laporan_neraca` (`id_laporan`, `tgl_awal`, `tgl_akhir`, `nama_laporan`, `status`, `feedback`, `created_at`, `updated_at`) VALUES
(4, '2022-08-01', '2022-09-30', 'Laporan_Neraca1.pdf', 'sukses', 'sukses', '2022-09-05 14:55:20', '2022-08-29 14:53:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `kode_penjualan` varchar(20) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`kode_penjualan`, `total_bayar`, `bayar`, `kembalian`) VALUES
('KDP0509220001', 29000, 30000, 1000),
('KDP0609220001', 1177500, 1200000, 22500),
('KDP0609220002', 595000, 600000, 5000),
('KDP0609220003', 297500, 300000, 2500),
('KDP0609220004', 292500, 300000, 7500),
('KDP0709220001', 42000, 5000, 0),
('KDP1409220001', 84000, 90000, 6000),
('KDP1709220001', 312000, 312000, 0),
('KDP2908220001', 175000, 200000, 25000),
('KDP2908220002', 290000, 300000, 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori`, `nama_kategori`, `deleted_at`) VALUES
(31, 'sembako', NULL),
(32, 'gas', NULL),
(33, 'makanan ', NULL),
(34, 'atk', NULL),
(35, 'minuman', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `modal`
--

CREATE TABLE `modal` (
  `id_modal` int(11) NOT NULL,
  `nominal` int(11) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `modal`
--

INSERT INTO `modal` (`id_modal`, `nominal`, `keterangan`) VALUES
(1, 40000000, 'Penyertaan Modal dari Desa Tahun 2018'),
(2, 87415000, 'Penyertaan Modal dari Desa Tahun 2019'),
(3, 100000000, 'Dana Hibah Provinsi Tahun 2019'),
(4, 551561, 'Penambahan Modal dari SHU Tahun 2020'),
(5, 20592000, 'Penyertaan Modal dari Desa Tahun 2020');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `kode_penjualan` varchar(20) NOT NULL,
  `kode_barang` varchar(20) CHARACTER SET latin1 NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `portal`
--

CREATE TABLE `portal` (
  `id_portal` int(11) NOT NULL,
  `judul_1` varchar(225) NOT NULL,
  `judul_2` varchar(225) NOT NULL,
  `judul_3` varchar(225) NOT NULL,
  `gambar_1` varchar(225) NOT NULL,
  `gambar_2` varchar(225) NOT NULL,
  `gambar_3` varchar(225) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `struktur_organisasi` varchar(225) NOT NULL,
  `info_kepdes` varchar(225) NOT NULL,
  `info_ketua` varchar(225) NOT NULL,
  `info_pengawas` varchar(225) NOT NULL,
  `info_bendahara` varchar(225) NOT NULL,
  `info_sekretaris` varchar(225) NOT NULL,
  `info_kepunit` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `portal`
--

INSERT INTO `portal` (`id_portal`, `judul_1`, `judul_2`, `judul_3`, `gambar_1`, `gambar_2`, `gambar_3`, `deskripsi`, `struktur_organisasi`, `info_kepdes`, `info_ketua`, `info_pengawas`, `info_bendahara`, `info_sekretaris`, `info_kepunit`) VALUES
(1, 'BUMDes Karya Mandiri Desa Ciangir', 'BUMDes Karya Mandiri Desa Ciangir', 'BUMDes Karya Mandiri Desa Ciangir', 'sawah1.jpeg', 'sawah2.jpeg', 'sawah3.jpeg', 'Badan usaha yang seluruh atau sebagian besar modalnya dimiliki oleh Desa Ciangir melalui penyertaan secara langsung yang berasal dari kekayaan desa yang dipisahkan guna mengelola aset, jasa, dan usaha lainnya untuk kesejahteraan masyarakat ', 'struktur.jpg', '0821', '0855', '0822', '0857', '0811', '0856');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `nama_role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`role_id`, `nama_role`) VALUES
(1, 'Pengawas'),
(2, 'Petugas Penjualan'),
(3, 'Petugas Gudang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_barang`
--

CREATE TABLE `satuan_barang` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(20) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `satuan_barang`
--

INSERT INTO `satuan_barang` (`id_satuan`, `nama_satuan`, `deleted_at`) VALUES
(19, 'pak', NULL),
(20, 'tabung', NULL),
(21, 'box', NULL),
(22, 'dus', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `tanggal_dibuat` date NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `no_hp`, `keterangan`, `tanggal_dibuat`, `deleted_at`) VALUES
(11, 'PT ARDYANSA', 'Kuningan', '08128276321', 'Supplier Sembako', '2022-09-20', NULL),
(12, 'PT Berkah Jaya Amanah', 'Kuningan', '081292854201', 'Supplier Minuman', '2022-09-20', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(225) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `alamat`, `no_hp`, `email`, `image`, `password`, `role_id`, `is_active`, `created_at`, `updated_at`) VALUES
(44, 'Aang', 'Ciangir', '082123405037', 'epilego2022@gmail.com', 'ava-c4ca4238a0b923820dcc509a6f75849b.png', '$2y$10$0N2PjzPs25.qs6hi1BDc5.5Rb6MGWaGZLpfMAPBhWPp3naMi5lmwi', 1, 'on', NULL, NULL),
(45, 'Ari Purnama Aji', 'Brebes', '081292854201', 'aripurnamaaji45@gmail.com', 'user.png', '$2y$10$Pv7ye61gC3fZv/GLIF17X.rLagAUxPudHGTuwAmv6O7aMFtwD.9SW', 3, 'on', NULL, '2022-09-17 20:51:39'),
(46, 'Idham Firhanudin', 'Kuningan', '085603306568', 'khoerunnisya09icha@gmail.com', 'WhatsApp_Image_2022-08-09_at_6_39_14_PM.jpeg', '$2y$10$c1XnfhvbNyL8HQ8Ik6QHqej9kiRb5rDeYoj.0pSi1lj6WBvwACmp6', 2, 'on', NULL, NULL),
(52, 'Sutrisno', 'RT 5/RW 2 Desa Ciangir', '087792356300', 'trisnobae@gmail.com', 'user1.png', '$2y$10$xCpqbtXYquZ/5UXv41UNCOLlEuDOpUwrytM639NReOIVvwgifPvmy', 2, 'off', '2022-08-29 13:21:06', '2022-09-15 14:26:50'),
(53, 'Ai Komalasari', 'Dusun 4 desa ciangir cibingbin', '081461161546', 'komalasariai06@gmail.com', 'default.png', '$2y$10$t9IIisjLFN.MTDgVi3XY0OM.uR1/11Gp7LKOg9NRIsQ9yqL6/pa2q', 2, 'proses', '2022-08-29 14:08:19', NULL),
(54, 'aman sukmana', 'Dusun 6 ', '081293672685', 'aman64@gmail.com', 'ava-c4ca4238a0b923820dcc509a6f75849b2.png', '$2y$10$rX.Rs6Bz2Qo2jB5f28Vj/eWwsm/M8Ups3EScifoB/Obsim3JdcwmG', 1, 'off', '2022-08-29 14:50:13', '2022-09-14 16:05:02'),
(57, 'coba', '', '', 'coba@gmail.com', 'default.png', '$2y$10$.Qbfm8Ptxi1xMS3cVq0y/OlMqoZWa0Vm/kewSzKj4B9b36TqYQE7y', 3, 'off', '2022-09-07 11:48:32', '2022-09-11 22:25:26'),
(58, 'Idham Firhanudin', '', '', 'idhamfirhanudin0203@gmail.com', 'default.png', '$2y$10$FHAumpkuFMrGeVm8KN0uBu3kqFIF8cXjVbDyQPIwgipEbTQIjTwbK', 2, 'on', '2022-09-17 20:37:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `token` varchar(225) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(50, 'epilego2022@gmail.com', '5DDLZMlmx8n0C2qdFWMj0B+223rNS9wCsG23mFgWkW0=', 1650598678),
(51, 'idhamfirhanudin001@gmail.com', 'ZUVgLs2HkJ/uPtoxdjPgYscMeRap74sl2zvItmrtrTY=', 1650599822),
(52, 'khoerunnisya09icha@gmail.com', 'GuuBKW4NgLO/kOXB+pnd7CVw0dzlt1GE7u00letGrGM=', 1650600052),
(53, 'khoerunnisya09icha@gmail.com', 'UngnHuf5qY+Ei1p/CqlgJfpVmWNzeuVzpYnui37DTto=', 1650600190),
(54, 'epilego2022@gmail.com', 'kV5PnZEqSbCtqt2bgY1toLVSmQ1CC7ZMYyO1FFpvVfs=', 1650600379),
(55, 'idhamfirhanudin001@gmail.com', 'n+pvo+elHeX3QZ2PtgRfy0kneRnA5UQIpOysDWDdlpk=', 1650600426),
(56, 'rskgstnxx@gmail.com', '4CFkWfN9njOCL52MxpjYl4FLhGmUkUOWxNXTF3BR6aY=', 1650600497),
(57, 'rskgstnxx@gmail.com', 'hDSYiJJ7fy3UWyYXwvSLvLQHnk4EW6yDqX+05koKpUU=', 1650600534);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aktiva_lancar`
--
ALTER TABLE `aktiva_lancar`
  ADD PRIMARY KEY (`id_aktiva_lancar`);

--
-- Indeks untuk tabel `aktiva_tetap`
--
ALTER TABLE `aktiva_tetap`
  ADD PRIMARY KEY (`id_aktiva_tetap`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_satuan` (`id_satuan`,`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `brilink`
--
ALTER TABLE `brilink`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_beban`
--
ALTER TABLE `data_beban`
  ADD PRIMARY KEY (`id_beban`);

--
-- Indeks untuk tabel `data_laporan`
--
ALTER TABLE `data_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `data_laporan_barang_keluar`
--
ALTER TABLE `data_laporan_barang_keluar`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `data_laporan_barang_masuk`
--
ALTER TABLE `data_laporan_barang_masuk`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `data_laporan_laba_rugi`
--
ALTER TABLE `data_laporan_laba_rugi`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `data_laporan_neraca`
--
ALTER TABLE `data_laporan_neraca`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`kode_penjualan`);

--
-- Indeks untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `modal`
--
ALTER TABLE `modal`
  ADD PRIMARY KEY (`id_modal`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `portal`
--
ALTER TABLE `portal`
  ADD PRIMARY KEY (`id_portal`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `satuan_barang`
--
ALTER TABLE `satuan_barang`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aktiva_lancar`
--
ALTER TABLE `aktiva_lancar`
  MODIFY `id_aktiva_lancar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `aktiva_tetap`
--
ALTER TABLE `aktiva_tetap`
  MODIFY `id_aktiva_tetap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `brilink`
--
ALTER TABLE `brilink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `data_barang_masuk`
--
ALTER TABLE `data_barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `data_beban`
--
ALTER TABLE `data_beban`
  MODIFY `id_beban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `data_laporan`
--
ALTER TABLE `data_laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `data_laporan_barang_keluar`
--
ALTER TABLE `data_laporan_barang_keluar`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `data_laporan_barang_masuk`
--
ALTER TABLE `data_laporan_barang_masuk`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `data_laporan_laba_rugi`
--
ALTER TABLE `data_laporan_laba_rugi`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `data_laporan_neraca`
--
ALTER TABLE `data_laporan_neraca`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `modal`
--
ALTER TABLE `modal`
  MODIFY `id_modal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `portal`
--
ALTER TABLE `portal`
  MODIFY `id_portal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `satuan_barang`
--
ALTER TABLE `satuan_barang`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`id_satuan`) REFERENCES `satuan_barang` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `brilink`
--
ALTER TABLE `brilink`
  ADD CONSTRAINT `brilink_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
