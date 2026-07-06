-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2026 at 03:01 AM
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
-- Database: `pt_ken_mandiri_teknik`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `aktivitas` varchar(255) DEFAULT NULL,
  `tabel` varchar(255) DEFAULT NULL,
  `record_id` varchar(100) DEFAULT NULL,
  `data_lama` longtext DEFAULT NULL,
  `data_baru` longtext DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `nama_user`, `role`, `aktivitas`, `tabel`, `record_id`, `data_lama`, `data_baru`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 1, 'Administrator', 'admin', 'Tambah NotaPembelian', 'nota_pembelian', 'KODE12', NULL, '{\"kode_nota\":\"KODE12\",\"tanggal\":\"2026-07-03T17:00:00.000000Z\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"informasi\":\"BELI\",\"created_by\":1,\"updated_by\":1,\"updated_at\":\"2026-07-04T12:47:11.000000Z\",\"created_at\":\"2026-07-04T12:47:11.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 12:47:11', NULL),
(2, 1, 'Administrator', 'admin', 'Ubah BahanBaku', 'bahan_baku', 'BB01', '{\"harga_bahan_baku\":\"1111.00\"}', '{\"harga_bahan_baku\":\"992929\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 12:47:59', NULL),
(3, 1, 'Administrator', 'admin', 'Tambah InvoicePenjualan', 'invoice_penjualan', 'NOIN123', NULL, '{\"no_invoice\":\"NOIN123\",\"tanggal\":\"2026-07-03T17:00:00.000000Z\",\"no_faktur\":\"FK-0011234777\",\"no_preorder\":\"PO-00109\",\"id_customer\":\"CUST01\",\"id_pegawai\":\"PEG01\",\"created_by\":1,\"updated_by\":1,\"updated_at\":\"2026-07-04T12:49:23.000000Z\",\"created_at\":\"2026-07-04T12:49:23.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 12:49:23', NULL),
(4, 1, 'Administrator', 'admin', 'Ubah Barang', 'barang', 'ba123', '{\"harga_barang\":\"9999.00\"}', '{\"harga_barang\":\"8888\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 12:49:59', NULL),
(5, 1, 'Administrator', 'admin', 'Cetak', 'invoice_penjualan', 'NOIN123', NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 12:50:17', NULL),
(6, 2, 'Nama Pegawai', 'pegawai', 'Tambah NotaPembelian', 'nota_pembelian', 'kode322', NULL, '{\"kode_nota\":\"kode322\",\"tanggal\":\"2026-07-03T17:00:00.000000Z\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"informasi\":\"k\",\"created_by\":2,\"updated_by\":2,\"updated_at\":\"2026-07-04T15:05:14.000000Z\",\"created_at\":\"2026-07-04T15:05:14.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 15:05:14', NULL),
(7, 1, 'Administrator', 'admin', 'Ubah BahanBaku', 'bahan_baku', 'bb123', '{\"harga_bahan_baku\":\"121212.00\"}', '{\"harga_bahan_baku\":\"33333\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 15:06:27', NULL),
(8, 1, 'Administrator', 'admin', 'Hapus (Soft Delete) NotaPembelian', 'nota_pembelian', 'kode322', '{\"kode_nota\":\"kode322\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"tanggal\":\"2026-07-03T17:00:00.000000Z\",\"informasi\":\"k\",\"created_by\":2,\"updated_by\":2,\"deleted_at\":\"2026-07-04T15:08:07.000000Z\",\"deleted_by\":1,\"created_at\":\"2026-07-04T15:05:14.000000Z\",\"updated_at\":\"2026-07-04T15:08:07.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 15:08:07', NULL),
(9, 1, 'Administrator', 'admin', 'Hapus (Soft Delete) NotaPembelian', 'nota_pembelian', 'kd1234', '{\"kode_nota\":\"kd1234\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"tanggal\":\"2026-06-18T17:00:00.000000Z\",\"informasi\":\"pembelian\\r\\n\\r\\n\",\"created_by\":null,\"updated_by\":null,\"deleted_at\":\"2026-07-04T15:08:10.000000Z\",\"deleted_by\":1,\"created_at\":null,\"updated_at\":\"2026-07-04T15:08:10.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 15:08:10', NULL),
(10, 1, 'Administrator', 'admin', 'Hapus (Soft Delete) NotaPembelian', 'nota_pembelian', 'KODE12', '{\"kode_nota\":\"KODE12\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"tanggal\":\"2026-07-03T17:00:00.000000Z\",\"informasi\":\"BELI\",\"created_by\":1,\"updated_by\":1,\"deleted_at\":\"2026-07-04T15:08:14.000000Z\",\"deleted_by\":1,\"created_at\":\"2026-07-04T12:47:11.000000Z\",\"updated_at\":\"2026-07-04T15:08:14.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 15:08:14', NULL),
(11, 1, 'Administrator', 'admin', 'Hapus (Soft Delete) NotaPembelian', 'nota_pembelian', 'kd12345', '{\"kode_nota\":\"kd12345\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"tanggal\":\"2026-07-03T17:00:00.000000Z\",\"informasi\":\"PEMBELIAN\",\"created_by\":null,\"updated_by\":null,\"deleted_at\":\"2026-07-04T15:08:17.000000Z\",\"deleted_by\":1,\"created_at\":null,\"updated_at\":\"2026-07-04T15:08:17.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 15:08:17', NULL),
(12, 1, 'Administrator', 'admin', 'Hapus (Soft Delete) NotaPembelian', 'nota_pembelian', 'kd1234ftft', '{\"kode_nota\":\"kd1234ftft\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"tanggal\":\"2026-06-25T17:00:00.000000Z\",\"informasi\":\"asdf\",\"created_by\":null,\"updated_by\":null,\"deleted_at\":\"2026-07-04T15:08:42.000000Z\",\"deleted_by\":1,\"created_at\":null,\"updated_at\":\"2026-07-04T15:08:42.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 15:08:42', NULL),
(13, 1, 'Administrator', 'admin', 'Tambah NotaPembelian', 'nota_pembelian', 'KODE123', NULL, '{\"kode_nota\":\"KODE123\",\"tanggal\":\"2026-07-03T17:00:00.000000Z\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"informasi\":\"kakak\",\"created_by\":1,\"updated_by\":1,\"updated_at\":\"2026-07-04T15:09:39.000000Z\",\"created_at\":\"2026-07-04T15:09:39.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 15:09:39', NULL),
(14, 1, 'Administrator', 'admin', 'Tambah NotaPembelian', 'nota_pembelian', 'NP-20260705-001', NULL, '{\"tanggal\":\"2026-07-04T17:00:00.000000Z\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"informasi\":\"hahaha\",\"created_by\":1,\"kode_nota\":\"NP-20260705-001\",\"updated_by\":1,\"updated_at\":\"2026-07-05T00:56:37.000000Z\",\"created_at\":\"2026-07-05T00:56:37.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-05 00:56:37', NULL),
(15, 1, 'Administrator', 'admin', 'Tambah NotaPembelian', 'nota_pembelian', 'NP-20260705-002', NULL, '{\"tanggal\":\"2026-07-04T17:00:00.000000Z\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"informasi\":\"hahaha\",\"created_by\":1,\"kode_nota\":\"NP-20260705-002\",\"updated_by\":1,\"updated_at\":\"2026-07-05T00:56:38.000000Z\",\"created_at\":\"2026-07-05T00:56:38.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-05 00:56:38', NULL),
(16, 1, 'Administrator', 'admin', 'Tambah NotaPembelian', 'nota_pembelian', 'NP-20260705-003', NULL, '{\"tanggal\":\"2026-07-04T17:00:00.000000Z\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"informasi\":\"hahaha\",\"created_by\":1,\"kode_nota\":\"NP-20260705-003\",\"updated_by\":1,\"updated_at\":\"2026-07-05T00:56:39.000000Z\",\"created_at\":\"2026-07-05T00:56:39.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-05 00:56:39', NULL),
(17, 1, 'Administrator', 'admin', 'Tambah NotaPembelian', 'nota_pembelian', 'NP-20260705-004', NULL, '{\"tanggal\":\"2026-07-04T17:00:00.000000Z\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"informasi\":\"hahaha\",\"created_by\":1,\"kode_nota\":\"NP-20260705-004\",\"updated_by\":1,\"updated_at\":\"2026-07-05T00:56:39.000000Z\",\"created_at\":\"2026-07-05T00:56:39.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-05 00:56:39', NULL),
(18, 1, 'Administrator', 'admin', 'Tambah NotaPembelian', 'nota_pembelian', 'NP-20260705-005', NULL, '{\"tanggal\":\"2026-07-04T17:00:00.000000Z\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"informasi\":\"hahaha\",\"created_by\":1,\"kode_nota\":\"NP-20260705-005\",\"updated_by\":1,\"updated_at\":\"2026-07-05T00:56:40.000000Z\",\"created_at\":\"2026-07-05T00:56:40.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-05 00:56:40', NULL),
(19, 1, 'Administrator', 'admin', 'Tambah NotaPembelian', 'nota_pembelian', 'NP-20260705-006', NULL, '{\"tanggal\":\"2026-07-04T17:00:00.000000Z\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"informasi\":\"hahaha\",\"created_by\":1,\"kode_nota\":\"NP-20260705-006\",\"updated_by\":1,\"updated_at\":\"2026-07-05T00:56:40.000000Z\",\"created_at\":\"2026-07-05T00:56:40.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-05 00:56:40', NULL),
(20, 1, 'Administrator', 'admin', 'Hapus (Soft Delete) NotaPembelian', 'nota_pembelian', 'NP-20260705-001', '{\"kode_nota\":\"NP-20260705-001\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"tanggal\":\"2026-07-04T17:00:00.000000Z\",\"informasi\":\"hahaha\",\"created_by\":1,\"updated_by\":1,\"deleted_at\":\"2026-07-05T00:56:58.000000Z\",\"deleted_by\":1,\"created_at\":\"2026-07-05T00:56:37.000000Z\",\"updated_at\":\"2026-07-05T00:56:58.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-05 00:56:58', NULL),
(21, 1, 'Administrator', 'admin', 'Hapus (Soft Delete) NotaPembelian', 'nota_pembelian', 'NP-20260705-002', '{\"kode_nota\":\"NP-20260705-002\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"tanggal\":\"2026-07-04T17:00:00.000000Z\",\"informasi\":\"hahaha\",\"created_by\":1,\"updated_by\":1,\"deleted_at\":\"2026-07-05T00:57:03.000000Z\",\"deleted_by\":1,\"created_at\":\"2026-07-05T00:56:38.000000Z\",\"updated_at\":\"2026-07-05T00:57:03.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-05 00:57:03', NULL),
(22, 1, 'Administrator', 'admin', 'Tambah NotaPembelian', 'nota_pembelian', 'NP-20260705-007', NULL, '{\"tanggal\":\"2026-07-04T17:00:00.000000Z\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"informasi\":\"kakakak\",\"created_by\":1,\"kode_nota\":\"NP-20260705-007\",\"updated_by\":1,\"updated_at\":\"2026-07-05T00:57:31.000000Z\",\"created_at\":\"2026-07-05T00:57:31.000000Z\"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-05 00:57:31', NULL),
(23, 1, 'Administrator', 'admin', 'Hapus (Soft Delete) NotaPembelian', 'nota_pembelian', 'NP-20260705-003', '{\"kode_nota\":\"NP-20260705-003\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"tanggal\":\"2026-07-04T17:00:00.000000Z\",\"informasi\":\"hahaha\",\"created_by\":1,\"updated_by\":1,\"deleted_at\":\"2026-07-05T00:57:41.000000Z\",\"deleted_by\":1,\"created_at\":\"2026-07-05T00:56:39.000000Z\",\"updated_at\":\"2026-07-05T00:57:41.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-05 00:57:41', NULL),
(24, 1, 'Administrator', 'admin', 'Hapus (Soft Delete) NotaPembelian', 'nota_pembelian', 'NP-20260705-004', '{\"kode_nota\":\"NP-20260705-004\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"tanggal\":\"2026-07-04T17:00:00.000000Z\",\"informasi\":\"hahaha\",\"created_by\":1,\"updated_by\":1,\"deleted_at\":\"2026-07-05T00:57:46.000000Z\",\"deleted_by\":1,\"created_at\":\"2026-07-05T00:56:39.000000Z\",\"updated_at\":\"2026-07-05T00:57:46.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-05 00:57:46', NULL),
(25, 1, 'Administrator', 'admin', 'Hapus (Soft Delete) NotaPembelian', 'nota_pembelian', 'NP-20260705-005', '{\"kode_nota\":\"NP-20260705-005\",\"id_perusahaan\":\"PER01\",\"id_pegawai\":\"PEG01\",\"tanggal\":\"2026-07-04T17:00:00.000000Z\",\"informasi\":\"hahaha\",\"created_by\":1,\"updated_by\":1,\"deleted_at\":\"2026-07-05T00:57:50.000000Z\",\"deleted_by\":1,\"created_at\":\"2026-07-05T00:56:40.000000Z\",\"updated_at\":\"2026-07-05T00:57:50.000000Z\"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-05 00:57:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bahan_baku` varchar(10) NOT NULL,
  `nama_bahan_baku` varchar(100) NOT NULL,
  `harga_bahan_baku` decimal(15,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id_bahan_baku`, `nama_bahan_baku`, `harga_bahan_baku`, `deleted_at`, `deleted_by`) VALUES
('BB01', 'Besi', 992929.00, NULL, NULL),
('bb123', 'Solar', 33333.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_barang` decimal(15,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_barang`, `deleted_at`, `deleted_by`) VALUES
('ba123', 'Kabel', 8888.00, NULL, NULL),
('BAR01', 'Panel', 1000.00, NULL, NULL),
('bk12', 'Pipa', 10000.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(10) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `nama_pt` varchar(100) DEFAULT NULL,
  `alamat_pt` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `nama_pt`, `alamat_pt`, `deleted_at`, `deleted_by`) VALUES
('CUST01', 'Nama Customer', 'Nama PT', 'Alamat PT', NULL, NULL);

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
('INV01', 'ba123', 1, 73000.00, 73000.00, 73000.00, 'kabeldes'),
('NI1236', 'ba123', 1, 1000.00, 1000.00, 1000.00, 'KABEL LISTRIK'),
('NI1236', 'ba123', 2, 1000.00, 2000.00, 2000.00, 'KABEL LISTRIK'),
('NOIN123', 'ba123', 1, 9999.00, 9999.00, 9999.00, 'KABEL LISTRIK');

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
('kd1234', 'BB01', 1, 100.00, 100.00, 100.00, 'Besi Plat 2mm – lembar'),
('kd1234ftft', 'BB01', 2, 100.00, 200.00, 200.00, 'Besi Plat 2mm – lembar'),
('kd1234ftft', 'BB01', 1, 1111.00, 1111.00, 1111.00, NULL),
('kd12345', 'bb123', 1, 150000.00, 150000.00, 150000.00, 'solar'),
('kd12345', 'bb123', 1, 9999.00, 9999.00, 9999.00, 'solar'),
('kd1234', 'bb123', 1, 9999.00, 9999.00, 9999.00, 'solar'),
('kd12345', 'bb123', 1, 121212.00, 121212.00, 121212.00, 'solar'),
('KODE12', 'BB01', 1, 1111.00, 1111.00, 1111.00, 'Besi Plat 2mm – lembar'),
('kode322', 'bb123', 1, 121212.00, 121212.00, 121212.00, 'solar'),
('KODE1', 'bb123', 1, 33333.00, 33333.00, 33333.00, 'solar'),
('NP-20260705-001', 'BB01', 2, 992929.00, 1985858.00, 1985858.00, 'besi'),
('NP-20260705-002', 'BB01', 2, 992929.00, 1985858.00, 1985858.00, 'besi'),
('NP-20260705-003', 'BB01', 2, 992929.00, 1985858.00, 1985858.00, 'besi'),
('NP-20260705-004', 'BB01', 2, 992929.00, 1985858.00, 1985858.00, 'besi'),
('NP-20260705-005', 'BB01', 2, 992929.00, 1985858.00, 1985858.00, 'besi'),
('NP-20260705-006', 'BB01', 2, 992929.00, 1985858.00, 1985858.00, 'besi'),
('NP-20260705-007', 'bb123', 2, 33333.00, 66666.00, 66666.00, 'solar');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `tanggal` date NOT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_penjualan`
--

INSERT INTO `invoice_penjualan` (`no_invoice`, `no_faktur`, `no_preorder`, `id_pegawai`, `id_customer`, `tanggal`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`, `created_at`, `updated_at`) VALUES
('INV01', 'F11', 'P1', 'PEG01', 'CUST01', '2026-06-19', NULL, NULL, NULL, NULL, NULL, NULL),
('NI1236', 'FK-0011234', 'PO-001', 'PEG01', 'CUST01', '2026-07-04', NULL, NULL, NULL, NULL, NULL, NULL),
('NOIN123', 'FK-0011234777', 'PO-00109', 'PEG01', 'CUST01', '2026-07-04', 1, 1, NULL, NULL, '2026-07-04 12:49:23', '2026-07-04 12:49:23');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_user` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `logout_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `nama_user`, `role`, `login_at`, `logout_at`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, 1, 'Administrator', 'admin', '2026-07-04 12:38:43', '2026-07-04 15:04:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 12:38:43', NULL),
(2, 2, 'Nama Pegawai', 'pegawai', '2026-07-04 15:04:53', '2026-07-04 15:05:46', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 15:04:53', NULL),
(3, 1, 'Administrator', 'admin', '2026-07-04 15:05:53', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-04 15:05:53', NULL),
(4, 1, 'Administrator', 'admin', '2026-07-05 00:54:23', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', '2026-07-05 00:54:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nota_pembelian`
--

CREATE TABLE `nota_pembelian` (
  `kode_nota` varchar(20) NOT NULL,
  `id_perusahaan` varchar(10) NOT NULL,
  `id_pegawai` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `informasi` text DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nota_pembelian`
--

INSERT INTO `nota_pembelian` (`kode_nota`, `id_perusahaan`, `id_pegawai`, `tanggal`, `informasi`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`, `created_at`, `updated_at`) VALUES
('kd1234', 'PER01', 'PEG01', '2026-06-19', 'pembelian\r\n\r\n', NULL, NULL, '2026-07-04 15:08:10', 1, NULL, '2026-07-04 15:08:10'),
('kd12345', 'PER01', 'PEG01', '2026-07-04', 'PEMBELIAN', NULL, NULL, '2026-07-04 15:08:17', 1, NULL, '2026-07-04 15:08:17'),
('kd1234ftft', 'PER01', 'PEG01', '2026-06-26', 'asdf', NULL, NULL, '2026-07-04 15:08:42', 1, NULL, '2026-07-04 15:08:42'),
('KODE1', 'PER01', 'PEG01', '2026-07-04', 'BELI', 1, 1, NULL, NULL, '2026-07-04 12:46:22', '2026-07-04 12:46:22'),
('KODE12', 'PER01', 'PEG01', '2026-07-04', 'BELI', 1, 1, '2026-07-04 15:08:14', 1, '2026-07-04 12:47:11', '2026-07-04 15:08:14'),
('KODE123', 'PER01', 'PEG01', '2026-07-04', 'kakak', 1, 1, NULL, NULL, '2026-07-04 15:09:39', '2026-07-04 15:09:39'),
('kode322', 'PER01', 'PEG01', '2026-07-04', 'k', 2, 2, '2026-07-04 15:08:07', 1, '2026-07-04 15:05:14', '2026-07-04 15:08:07'),
('NP-20260705-001', 'PER01', 'PEG01', '2026-07-05', 'hahaha', 1, 1, '2026-07-05 00:56:58', 1, '2026-07-05 00:56:37', '2026-07-05 00:56:58'),
('NP-20260705-002', 'PER01', 'PEG01', '2026-07-05', 'hahaha', 1, 1, '2026-07-05 00:57:03', 1, '2026-07-05 00:56:38', '2026-07-05 00:57:03'),
('NP-20260705-003', 'PER01', 'PEG01', '2026-07-05', 'hahaha', 1, 1, '2026-07-05 00:57:41', 1, '2026-07-05 00:56:39', '2026-07-05 00:57:41'),
('NP-20260705-004', 'PER01', 'PEG01', '2026-07-05', 'hahaha', 1, 1, '2026-07-05 00:57:46', 1, '2026-07-05 00:56:39', '2026-07-05 00:57:46'),
('NP-20260705-005', 'PER01', 'PEG01', '2026-07-05', 'hahaha', 1, 1, '2026-07-05 00:57:50', 1, '2026-07-05 00:56:40', '2026-07-05 00:57:50'),
('NP-20260705-006', 'PER01', 'PEG01', '2026-07-05', 'hahaha', 1, 1, NULL, NULL, '2026-07-05 00:56:40', '2026-07-05 00:56:40'),
('NP-20260705-007', 'PER01', 'PEG01', '2026-07-05', 'kakakak', 1, 1, NULL, NULL, '2026-07-05 00:57:31', '2026-07-05 00:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(10) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `deleted_at`, `deleted_by`) VALUES
('PEG01', 'Nama Pegawai', NULL, NULL);

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
  `nama_petugas` varchar(100) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama_perusahaan`, `alamat_perusahaan`, `no_telpon`, `no_fax`, `email_perusahaan`, `nama_penandatangan`, `jabatan`, `nama_petugas`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`) VALUES
('PER01', 'Nama Perusahaan', 'Alamat', 'No Telpon', 'No Fax', 'Email@email.com', 'Nama Penandatangan', 'Jabatan', 'Nama Petugas', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('IUFOGZFiKPhlRGqe3CAkThCku1Z4KCNhhOuOuXRg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmFMWEVsRWF4d3dSU0RZc0oyU0NZcmc4R09Jb25BRVFRcllxM0pqeSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1783201957),
('MjuujLHY1wnCz2ftAQcA2MX19HhTTnaoFHLWCQX0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMkZiYUcwRWpwY1haMXNMdkp1MzdrbkhlbzNHbkI0dklTeTZ0UER1SiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ub3RhIjtzOjU6InJvdXRlIjtzOjEwOiJub3RhLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjEyOiJsb2dpbl9sb2dfaWQiO2k6Mzt9', 1783178024),
('TBel8IMQNjvKYmMcofvYB7D9BlMPSkdnlZQ7FWmK', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQTM3MWxrVEZ1ZWtNWTRVYjhoNUsxWmQ5b1lwRDF0a0JGbmZmclVyVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXJ1c2FoYWFuL2NyZWF0ZSI7czo1OiJyb3V0ZSI7czoxNzoicGVydXNhaGFhbi5jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTI6ImxvZ2luX2xvZ19pZCI7aTo0O30=', 1783213183);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'pegawai',
  `id_pegawai` varchar(10) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `id_pegawai`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '$2y$12$IjmJ553CudPjiAsMWJnyUeVFHHy8JwZn9SJUTX4Gsmdj3w/sBRjxK', 'admin', NULL, NULL, '2026-06-25 01:30:45', '2026-06-25 01:30:45'),
(2, 'Nama Pegawai', 'Nama Pegawai', '$2y$12$sUBeRAUQPcJtVECW5ShrxeszQ9oQDJYe/QiHjZB.D5vtv9HHGmNl.', 'pegawai', 'PEG01', NULL, '2026-06-25 01:30:46', '2026-06-25 01:30:46'),
(3, 'Manager', 'manager', 'HASIL_HASH_PASSWORD', 'manager', NULL, NULL, '2026-06-25 02:32:52', '2026-06-25 02:32:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoice_penjualan`
--
ALTER TABLE `invoice_penjualan`
  ADD PRIMARY KEY (`no_invoice`),
  ADD KEY `fk_invoice_pegawai` (`id_pegawai`),
  ADD KEY `fk_invoice_customer` (`id_customer`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nota_pembelian`
--
ALTER TABLE `nota_pembelian`
  ADD PRIMARY KEY (`kode_nota`),
  ADD KEY `fk_nota_perusahaan` (`id_perusahaan`),
  ADD KEY `fk_nota_pegawai` (`id_pegawai`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
