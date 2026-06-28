-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2026 at 08:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbd2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bahan_baku` varchar(10) NOT NULL,
  `nama_bahan_baku` varchar(100) NOT NULL,
  `harga_bahan_baku` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id_bahan_baku`, `nama_bahan_baku`, `harga_bahan_baku`) VALUES
('BB01', 'Besi', 100.00),
('bb123', 'Solar', 150000.00);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_barang` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_barang`) VALUES
('ba123', 'Kabel', 73000.00),
('BAR01', 'Panel', 1000.00),
('bk12', 'Pipa', 10000.00);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(10) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `nama_pt` varchar(100) DEFAULT NULL,
  `alamat_pt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `nama_pt`, `alamat_pt`) VALUES
('CUST01', 'Nama Customer', 'Nama PT', 'Alamat PT');

-- --------------------------------------------------------

--
-- Table structure for table `detail_invoice_penjualan`
--

CREATE TABLE `detail_invoice_penjualan` (
  `no_invoice` varchar(20) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `unit_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `sub_total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_invoice_penjualan`
--

INSERT INTO `detail_invoice_penjualan` (`no_invoice`, `id_barang`, `qty`, `unit_price`, `sub_total`, `total_price`, `deskripsi`) VALUES
('INV01', 'bk12', 5, 10000.00, 50000.00, 50000.00, 'pipa plastik');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `kode_nota` varchar(20) NOT NULL,
  `id_bahan_baku` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `harga_satuan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `sub_total` decimal(15,2) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL DEFAULT 0.00,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`kode_nota`, `id_bahan_baku`, `qty`, `harga_satuan`, `sub_total`, `total_harga`, `keterangan`) VALUES
('kd1234', 'BB01', 9000, 100.00, 900000.00, 900000.00, 'Besi Plat 2mm – lembar');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_penjualan`
--

CREATE TABLE `invoice_penjualan` (
  `no_invoice` varchar(20) NOT NULL,
  `no_faktur` varchar(20) DEFAULT NULL,
  `no_preorder` varchar(20) DEFAULT NULL,
  `id_pegawai` varchar(10) NOT NULL,
  `id_customer` varchar(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_penjualan`
--

INSERT INTO `invoice_penjualan` (`no_invoice`, `no_faktur`, `no_preorder`, `id_pegawai`, `id_customer`, `tanggal`) VALUES
('INV01', 'F11', 'P1', 'PEG01', 'CUST01', '2026-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `nota_pembelian`
--

CREATE TABLE `nota_pembelian` (
  `kode_nota` varchar(20) NOT NULL,
  `id_perusahaan` varchar(10) NOT NULL,
  `id_pegawai` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `informasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nota_pembelian`
--

INSERT INTO `nota_pembelian` (`kode_nota`, `id_perusahaan`, `id_pegawai`, `tanggal`, `informasi`) VALUES
('kd1234', 'PER01', 'PEG01', '2026-06-19', 'pembelian\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(10) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`) VALUES
('PEG01', 'Nama Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` varchar(10) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `alamat_perusahaan` varchar(255) NOT NULL,
  `no_telpon` varchar(20) DEFAULT NULL,
  `no_fax` varchar(20) DEFAULT NULL,
  `email_perusahaan` varchar(100) DEFAULT NULL,
  `nama_penandatangan` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `nama_petugas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_perusahaan`, `alamat_perusahaan`, `no_telpon`, `no_fax`, `email_perusahaan`, `nama_penandatangan`, `jabatan`, `nama_petugas`) VALUES
('PER01', 'Nama Perusahaan', 'Alamat', 'No Telpon', 'No Fax', 'Email@email.com', 'Nama Penandatangan', 'Jabatan', 'Nama Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bahan_baku`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `detail_invoice_penjualan`
--
ALTER TABLE `detail_invoice_penjualan`
  ADD KEY `fk_detail_inv_barang` (`id_barang`) USING BTREE,
  ADD KEY `no_invoice` (`no_invoice`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD KEY `fk_detail_bahan` (`id_bahan_baku`) USING BTREE,
  ADD KEY `fk_detail_nota` (`kode_nota`);

--
-- Indexes for table `invoice_penjualan`
--
ALTER TABLE `invoice_penjualan`
  ADD PRIMARY KEY (`no_invoice`),
  ADD KEY `fk_invoice_pegawai` (`id_pegawai`),
  ADD KEY `fk_invoice_customer` (`id_customer`);

--
-- Indexes for table `nota_pembelian`
--
ALTER TABLE `nota_pembelian`
  ADD PRIMARY KEY (`kode_nota`),
  ADD KEY `fk_nota_perusahaan` (`id_perusahaan`),
  ADD KEY `fk_nota_pegawai` (`id_pegawai`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_invoice_penjualan`
--
ALTER TABLE `detail_invoice_penjualan`
  ADD CONSTRAINT `fk_detail_inv_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_inv_invoice` FOREIGN KEY (`no_invoice`) REFERENCES `invoice_penjualan` (`no_invoice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `fk_detail_bahan` FOREIGN KEY (`id_bahan_baku`) REFERENCES `bahan_baku` (`id_bahan_baku`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_nota` FOREIGN KEY (`kode_nota`) REFERENCES `nota_pembelian` (`kode_nota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_penjualan`
--
ALTER TABLE `invoice_penjualan`
  ADD CONSTRAINT `fk_invoice_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invoice_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE;

--
-- Constraints for table `nota_pembelian`
--
ALTER TABLE `nota_pembelian`
  ADD CONSTRAINT `fk_nota_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nota_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
