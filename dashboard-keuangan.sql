-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2025 at 02:34 PM
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
-- Database: `dashboard-keuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'Transaksi', 'Transaksi telah di-updated', 'App\\Models\\Transaction', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"amount\":\"810200.00\",\"amount_dollar\":\"48.92\"},\"old\":{\"amount\":\"890200.00\",\"amount_dollar\":\"54.46\"}}', NULL, '2025-06-17 14:37:36', '2025-06-17 14:37:36'),
(2, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"AWS (gpswox)\",\"category.name\":\"Server\",\"amount\":\"8323201.00\",\"amount_dollar\":\"510.00\",\"date_transaction\":\"2025-04-10\",\"description\":null}}', NULL, '2025-06-18 01:43:09', '2025-06-18 01:43:09'),
(3, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"AWS (gpswox)\",\"category.name\":\"Server\",\"amount\":\"8323201.00\",\"amount_dollar\":\"510.00\",\"date_transaction\":\"2024-05-18\",\"description\":null}}', NULL, '2025-06-18 01:43:46', '2025-06-18 01:43:46'),
(4, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"EIKON\",\"category.name\":\"Google Workspace\",\"amount\":\"890000.00\",\"amount_dollar\":\"54.53\",\"date_transaction\":\"2025-03-05\",\"description\":null}}', NULL, '2025-06-18 01:44:28', '2025-06-18 01:44:28'),
(5, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"EIKON\",\"category.name\":\"Google Workspace\",\"amount\":\"580000.00\",\"amount_dollar\":\"35.54\",\"date_transaction\":\"2025-05-14\",\"description\":null}}', NULL, '2025-06-18 01:45:02', '2025-06-18 01:45:02'),
(6, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"EIKON\",\"category.name\":\"Google Workspace\",\"amount\":\"890000.00\",\"amount_dollar\":\"54.53\",\"date_transaction\":\"2025-06-11\",\"description\":null}}', NULL, '2025-06-18 01:45:30', '2025-06-18 01:45:30'),
(7, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Notion\",\"category.name\":\"Project Management\",\"amount\":\"550000.00\",\"amount_dollar\":\"33.70\",\"date_transaction\":\"2025-05-07\",\"description\":null}}', NULL, '2025-06-18 01:46:11', '2025-06-18 01:46:11'),
(8, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Notion\",\"category.name\":\"Project Management\",\"amount\":\"550000.00\",\"amount_dollar\":\"33.70\",\"date_transaction\":\"2025-06-18\",\"description\":null}}', NULL, '2025-06-18 01:46:29', '2025-06-18 01:46:29'),
(9, 'Transaksi', 'Transaksi telah di-updated', 'App\\Models\\Transaction', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"amount\":\"492000.00\",\"amount_dollar\":\"30.00\",\"date_transaction\":\"2025-05-15\"},\"old\":{\"amount\":\"810200.00\",\"amount_dollar\":\"48.92\",\"date_transaction\":\"2025-05-01\"}}', NULL, '2025-06-18 02:48:21', '2025-06-18 02:48:21'),
(10, 'Transaksi', 'Transaksi telah di-updated', 'App\\Models\\Transaction', 'updated', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"amount\":\"83738400.00\",\"amount_dollar\":\"5106.00\",\"date_transaction\":\"2024-05-29\"},\"old\":{\"amount\":\"8323201.00\",\"amount_dollar\":\"510.00\",\"date_transaction\":\"2025-04-10\"}}', NULL, '2025-06-18 02:49:22', '2025-06-18 02:49:22'),
(11, 'Transaksi', 'Transaksi telah di-updated', 'App\\Models\\Transaction', 'updated', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"amount\":\"83738400.00\",\"amount_dollar\":\"5106.00\",\"date_transaction\":\"2024-06-28\"},\"old\":{\"amount\":\"8323201.00\",\"amount_dollar\":\"510.00\",\"date_transaction\":\"2024-05-18\"}}', NULL, '2025-06-18 02:50:16', '2025-06-18 02:50:16'),
(12, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"AWS (gpswox)\",\"category.name\":\"Server\",\"amount\":\"83738400.00\",\"amount_dollar\":\"5106.00\",\"date_transaction\":\"2024-07-29\",\"description\":null}}', NULL, '2025-06-18 02:51:19', '2025-06-18 02:51:19'),
(13, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"AWS (gpswox)\",\"category.name\":\"Server\",\"amount\":\"124738400.00\",\"amount_dollar\":\"7606.00\",\"date_transaction\":\"2024-08-29\",\"description\":null}}', NULL, '2025-06-18 02:51:52', '2025-06-18 02:51:52'),
(14, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 11, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"AWS (gpswox)\",\"category.name\":\"Server\",\"amount\":\"153586000.00\",\"amount_dollar\":\"9365.00\",\"date_transaction\":\"2025-01-29\",\"description\":null}}', NULL, '2025-06-18 02:52:34', '2025-06-18 02:52:34'),
(15, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 12, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"AWS (gpswox)\",\"category.name\":\"Server\",\"amount\":\"153586000.00\",\"amount_dollar\":\"9365.00\",\"date_transaction\":\"2025-02-03\",\"description\":null}}', NULL, '2025-06-18 02:53:22', '2025-06-18 02:53:22'),
(16, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 13, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"AWS (gpswox)\",\"category.name\":\"Server\",\"amount\":\"153586000.00\",\"amount_dollar\":\"9365.00\",\"date_transaction\":\"2025-03-03\",\"description\":null}}', NULL, '2025-06-18 02:54:02', '2025-06-18 02:54:02'),
(17, 'Transaksi', 'Transaksi telah di-updated', 'App\\Models\\Transaction', 'updated', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"amount\":\"15644944.00\",\"amount_dollar\":\"953.96\",\"date_transaction\":\"2024-05-01\"},\"old\":{\"amount\":\"890000.00\",\"amount_dollar\":\"54.53\",\"date_transaction\":\"2025-03-05\"}}', NULL, '2025-06-18 02:55:24', '2025-06-18 02:55:24'),
(18, 'Transaksi', 'Transaksi telah di-updated', 'App\\Models\\Transaction', 'updated', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"amount\":\"965632.00\",\"amount_dollar\":\"58.88\",\"date_transaction\":\"2024-12-05\"},\"old\":{\"amount\":\"580000.00\",\"amount_dollar\":\"35.54\",\"date_transaction\":\"2025-05-14\"}}', NULL, '2025-06-18 02:56:05', '2025-06-18 02:56:05'),
(19, 'Transaksi', 'Transaksi telah di-updated', 'App\\Models\\Transaction', 'updated', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"amount\":\"16718324.00\",\"amount_dollar\":\"1019.41\",\"date_transaction\":\"2024-06-06\"},\"old\":{\"amount\":\"890000.00\",\"amount_dollar\":\"54.53\",\"date_transaction\":\"2025-06-11\"}}', NULL, '2025-06-18 02:57:00', '2025-06-18 02:57:00'),
(20, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 14, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"EIKON\",\"category.name\":\"Google Workspace\",\"amount\":\"16753092.00\",\"amount_dollar\":\"1021.53\",\"date_transaction\":\"2024-07-02\",\"description\":null}}', NULL, '2025-06-18 02:58:24', '2025-06-18 02:58:24'),
(21, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 15, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"EIKON\",\"category.name\":\"Google Workspace\",\"amount\":\"1935200.00\",\"amount_dollar\":\"118.00\",\"date_transaction\":\"2024-07-18\",\"description\":null}}', NULL, '2025-06-18 02:58:55', '2025-06-18 02:58:55'),
(22, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 16, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"EIKON\",\"category.name\":\"Google Workspace\",\"amount\":\"17720364.00\",\"amount_dollar\":\"1080.51\",\"date_transaction\":\"2024-08-01\",\"description\":null}}', NULL, '2025-06-18 02:59:32', '2025-06-18 02:59:32'),
(23, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"EIKON\",\"category.name\":\"Project Management\",\"amount\":\"18613836.00\",\"amount_dollar\":\"1134.99\",\"date_transaction\":\"2024-09-03\",\"description\":null}}', NULL, '2025-06-18 03:00:23', '2025-06-18 03:00:23'),
(24, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 18, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"EIKON\",\"category.name\":\"Google Workspace\",\"amount\":\"1587028.00\",\"amount_dollar\":\"96.77\",\"date_transaction\":\"2025-01-08\",\"description\":null}}', NULL, '2025-06-18 03:01:15', '2025-06-18 03:01:15'),
(25, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 19, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"EIKON\",\"category.name\":\"Google Workspace\",\"amount\":\"24588684.00\",\"amount_dollar\":\"1499.31\",\"date_transaction\":\"2025-01-17\",\"description\":null}}', NULL, '2025-06-18 03:01:59', '2025-06-18 03:01:59'),
(26, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 20, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"EIKON\",\"category.name\":\"Google Workspace\",\"amount\":\"24652152.00\",\"amount_dollar\":\"1503.18\",\"date_transaction\":\"2025-02-03\",\"description\":null}}', NULL, '2025-06-18 03:03:27', '2025-06-18 03:03:27'),
(27, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 21, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"EIKON\",\"category.name\":\"Google Workspace\",\"amount\":\"2138068.00\",\"amount_dollar\":\"130.37\",\"date_transaction\":\"2025-02-14\",\"description\":null}}', NULL, '2025-06-18 03:04:02', '2025-06-18 03:04:02'),
(28, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 22, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"EIKON\",\"category.name\":\"Google Workspace\",\"amount\":\"26947496.00\",\"amount_dollar\":\"1643.14\",\"date_transaction\":\"2025-03-03\",\"description\":null}}', NULL, '2025-06-18 03:05:08', '2025-06-18 03:05:08'),
(29, 'Transaksi', 'Transaksi telah di-updated', 'App\\Models\\Transaction', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"date_transaction\":\"2025-01-15\"},\"old\":{\"date_transaction\":\"2025-05-15\"}}', NULL, '2025-06-18 03:07:25', '2025-06-18 03:07:25'),
(30, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 23, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Figma\",\"category.name\":\"Dev Tools\",\"amount\":\"492000.00\",\"amount_dollar\":\"30.00\",\"date_transaction\":\"2025-02-15\",\"description\":null}}', NULL, '2025-06-18 03:07:50', '2025-06-18 03:07:50'),
(31, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 24, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Figma\",\"category.name\":\"Dev Tools\",\"amount\":\"656000.00\",\"amount_dollar\":\"40.00\",\"date_transaction\":\"2025-03-15\",\"description\":null}}', NULL, '2025-06-18 03:08:20', '2025-06-18 03:08:20'),
(32, 'Transaksi', 'Transaksi telah di-updated', 'App\\Models\\Transaction', 'updated', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"amount\":\"10897964.00\",\"amount_dollar\":\"664.51\",\"date_transaction\":\"2024-06-08\"},\"old\":{\"amount\":\"550000.00\",\"amount_dollar\":\"33.70\",\"date_transaction\":\"2025-05-07\"}}', NULL, '2025-06-18 03:10:04', '2025-06-18 03:10:04'),
(33, 'Transaksi', 'Transaksi telah di-updated', 'App\\Models\\Transaction', 'updated', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"amount\":\"11529036.00\",\"amount_dollar\":\"702.99\",\"date_transaction\":\"2024-07-08\"},\"old\":{\"amount\":\"550000.00\",\"amount_dollar\":\"33.70\",\"date_transaction\":\"2025-06-18\"}}', NULL, '2025-06-18 03:11:28', '2025-06-18 03:11:28'),
(34, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 25, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Notion\",\"category.name\":\"Project Management\",\"amount\":\"7857568.00\",\"amount_dollar\":\"479.12\",\"date_transaction\":\"2024-08-08\",\"description\":null}}', NULL, '2025-06-18 03:12:28', '2025-06-18 03:12:28'),
(35, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 26, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Notion\",\"category.name\":\"Project Management\",\"amount\":\"11381600.00\",\"amount_dollar\":\"694.00\",\"date_transaction\":\"2025-01-08\",\"description\":null}}', NULL, '2025-06-18 03:13:05', '2025-06-18 03:13:05'),
(36, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 27, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Notion\",\"category.name\":\"Project Management\",\"amount\":\"11381600.00\",\"amount_dollar\":\"694.00\",\"date_transaction\":\"2025-02-08\",\"description\":null}}', NULL, '2025-06-18 03:14:09', '2025-06-18 03:14:09'),
(37, 'Transaksi', 'Transaksi telah di-updated', 'App\\Models\\Transaction', 'updated', 17, 'App\\Models\\User', 1, '{\"attributes\":{\"category.name\":\"Google Workspace\"},\"old\":{\"category.name\":\"Project Management\"}}', NULL, '2025-06-18 03:15:32', '2025-06-18 03:15:32'),
(38, 'Transaksi', 'Transaksi telah di-updated', 'App\\Models\\Transaction', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"category.name\":\"Dev Tools\"},\"old\":{\"category.name\":\"Google Workspace\"}}', NULL, '2025-06-18 03:15:54', '2025-06-18 03:15:54'),
(39, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 28, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Notion\",\"category.name\":\"Project Management\",\"amount\":\"11922964.00\",\"amount_dollar\":\"727.01\",\"date_transaction\":\"2025-03-08\",\"description\":null}}', NULL, '2025-06-18 03:17:12', '2025-06-18 03:17:12'),
(40, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 29, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Bytebytego\",\"category.name\":\"Newsletter\",\"amount\":\"246000.00\",\"amount_dollar\":\"15.00\",\"date_transaction\":\"2024-06-06\",\"description\":null}}', NULL, '2025-06-18 03:18:37', '2025-06-18 03:18:37'),
(41, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 30, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Bytebytego\",\"category.name\":\"Newsletter\",\"amount\":\"246000.00\",\"amount_dollar\":\"15.00\",\"date_transaction\":\"2024-07-04\",\"description\":null}}', NULL, '2025-06-18 03:19:29', '2025-06-18 03:19:29'),
(42, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 31, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Bytebytego\",\"category.name\":\"Newsletter\",\"amount\":\"246000.00\",\"amount_dollar\":\"15.00\",\"date_transaction\":\"2024-08-04\",\"description\":null}}', NULL, '2025-06-18 03:20:17', '2025-06-18 03:20:17'),
(43, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 32, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Bytebytego\",\"category.name\":\"Newsletter\",\"amount\":\"246000.00\",\"amount_dollar\":\"15.00\",\"date_transaction\":\"2024-09-04\",\"description\":null}}', NULL, '2025-06-18 03:20:56', '2025-06-18 03:20:56'),
(44, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 33, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Bytebytego\",\"category.name\":\"Newsletter\",\"amount\":\"246000.00\",\"amount_dollar\":\"15.00\",\"date_transaction\":\"2025-01-04\",\"description\":null}}', NULL, '2025-06-18 03:22:38', '2025-06-18 03:22:38'),
(45, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 34, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Bytebytego\",\"category.name\":\"Newsletter\",\"amount\":\"246000.00\",\"amount_dollar\":\"15.00\",\"date_transaction\":\"2025-02-04\",\"description\":null}}', NULL, '2025-06-18 03:22:57', '2025-06-18 03:22:57'),
(46, 'Transaksi', 'Transaksi telah di-created', 'App\\Models\\Transaction', 'created', 35, 'App\\Models\\User', 1, '{\"attributes\":{\"vendor.name\":\"Bytebytego\",\"category.name\":\"Newsletter\",\"amount\":\"246000.00\",\"amount_dollar\":\"15.00\",\"date_transaction\":\"2025-03-04\",\"description\":null}}', NULL, '2025-06-18 03:23:13', '2025-06-18 03:23:13');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Google Workspace', 1, '01JXZTKK30G03P277X4C52Z1DN.png', '2025-06-17 13:52:03', '2025-06-17 13:52:03', NULL),
(2, 'Server', 1, '01JY0J3SDXRQSDD3Q8B50HN52X.jpg', '2025-06-17 20:42:51', '2025-06-17 20:42:51', NULL),
(3, 'Project Management', 1, '01JY0J4JH31WRXV25ZFB6VV5PY.png', '2025-06-17 20:43:17', '2025-06-17 20:43:17', NULL),
(4, 'Newsletter', 1, '01JY0J5C35DTDMCVRDJRG6YZ27.png', '2025-06-17 20:43:43', '2025-06-17 20:43:43', NULL),
(5, 'Security/Domain', 1, '01JY0J65XSGFPZQ0M73M4XGCBV.png', '2025-06-17 20:44:10', '2025-06-17 20:44:10', NULL),
(6, 'Dev Tools', 1, '01JY0J6R8ZW410YTWA4S3SH743.png', '2025-06-17 20:44:28', '2025-06-17 20:44:28', NULL);

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
(29, '2014_10_12_000000_create_users_table', 1),
(30, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(31, '2019_08_19_000000_create_failed_jobs_table', 1),
(32, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(33, '2025_06_12_122300_create_vendors_table', 1),
(34, '2025_06_12_122736_create_categories_table', 1),
(35, '2025_06_12_124746_create_transactions_table', 1),
(36, '2025_06_17_210550_create_activity_log_table', 2),
(37, '2025_06_17_210551_add_event_column_to_activity_log_table', 2),
(38, '2025_06_17_210552_add_batch_uuid_column_to_activity_log_table', 2),
(39, '2025_06_17_213510_add_role_to_users_table', 3);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `date_transaction` date NOT NULL,
  `description` text DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `amount_dollar` decimal(15,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(10) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `vendor_id`, `category_id`, `date_transaction`, `description`, `amount`, `amount_dollar`, `currency`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 6, '2025-01-15', NULL, 492000.00, 30.00, 'USD', NULL, '2025-06-17 13:54:58', '2025-06-18 03:15:53', NULL),
(2, 3, 2, '2024-05-29', NULL, 83738400.00, 5106.00, 'USD', NULL, '2025-06-18 01:43:09', '2025-06-18 02:49:22', NULL),
(3, 3, 2, '2024-06-28', NULL, 83738400.00, 5106.00, 'USD', NULL, '2025-06-18 01:43:46', '2025-06-18 02:50:16', NULL),
(4, 2, 1, '2024-05-01', NULL, 15644944.00, 953.96, 'USD', NULL, '2025-06-18 01:44:28', '2025-06-18 02:55:24', NULL),
(5, 2, 1, '2024-12-05', NULL, 965632.00, 58.88, 'USD', NULL, '2025-06-18 01:45:02', '2025-06-18 02:56:05', NULL),
(6, 2, 1, '2024-06-06', NULL, 16718324.00, 1019.41, 'USD', NULL, '2025-06-18 01:45:30', '2025-06-18 02:57:00', NULL),
(7, 5, 3, '2024-06-08', NULL, 10897964.00, 664.51, 'USD', NULL, '2025-06-18 01:46:11', '2025-06-18 03:10:04', NULL),
(8, 5, 3, '2024-07-08', NULL, 11529036.00, 702.99, 'USD', NULL, '2025-06-18 01:46:29', '2025-06-18 03:11:28', NULL),
(9, 3, 2, '2024-07-29', NULL, 83738400.00, 5106.00, 'USD', NULL, '2025-06-18 02:51:19', '2025-06-18 02:51:19', NULL),
(10, 3, 2, '2024-08-29', NULL, 124738400.00, 7606.00, 'USD', NULL, '2025-06-18 02:51:52', '2025-06-18 02:51:52', NULL),
(11, 3, 2, '2025-01-29', NULL, 153586000.00, 9365.00, 'USD', NULL, '2025-06-18 02:52:34', '2025-06-18 02:52:34', NULL),
(12, 3, 2, '2025-02-03', NULL, 153586000.00, 9365.00, 'USD', NULL, '2025-06-18 02:53:22', '2025-06-18 02:53:22', NULL),
(13, 3, 2, '2025-03-03', NULL, 153586000.00, 9365.00, 'USD', NULL, '2025-06-18 02:54:02', '2025-06-18 02:54:02', NULL),
(14, 2, 1, '2024-07-02', NULL, 16753092.00, 1021.53, 'USD', NULL, '2025-06-18 02:58:24', '2025-06-18 02:58:24', NULL),
(15, 2, 1, '2024-07-18', NULL, 1935200.00, 118.00, 'USD', NULL, '2025-06-18 02:58:55', '2025-06-18 02:58:55', NULL),
(16, 2, 1, '2024-08-01', NULL, 17720364.00, 1080.51, 'USD', NULL, '2025-06-18 02:59:32', '2025-06-18 02:59:32', NULL),
(17, 2, 1, '2024-09-03', NULL, 18613836.00, 1134.99, 'USD', NULL, '2025-06-18 03:00:23', '2025-06-18 03:15:32', NULL),
(18, 2, 1, '2025-01-08', NULL, 1587028.00, 96.77, 'USD', NULL, '2025-06-18 03:01:15', '2025-06-18 03:01:15', NULL),
(19, 2, 1, '2025-01-17', NULL, 24588684.00, 1499.31, 'USD', NULL, '2025-06-18 03:01:59', '2025-06-18 03:01:59', NULL),
(20, 2, 1, '2025-02-03', NULL, 24652152.00, 1503.18, 'USD', NULL, '2025-06-18 03:03:27', '2025-06-18 03:03:27', NULL),
(21, 2, 1, '2025-02-14', NULL, 2138068.00, 130.37, 'USD', NULL, '2025-06-18 03:04:02', '2025-06-18 03:04:02', NULL),
(22, 2, 1, '2025-03-03', NULL, 26947496.00, 1643.14, 'USD', NULL, '2025-06-18 03:05:08', '2025-06-18 03:05:08', NULL),
(23, 1, 6, '2025-02-15', NULL, 492000.00, 30.00, 'USD', NULL, '2025-06-18 03:07:50', '2025-06-18 03:07:50', NULL),
(24, 1, 6, '2025-03-15', NULL, 656000.00, 40.00, 'USD', NULL, '2025-06-18 03:08:20', '2025-06-18 03:08:20', NULL),
(25, 5, 3, '2024-08-08', NULL, 7857568.00, 479.12, 'USD', NULL, '2025-06-18 03:12:28', '2025-06-18 03:12:28', NULL),
(26, 5, 3, '2025-01-08', NULL, 11381600.00, 694.00, 'USD', NULL, '2025-06-18 03:13:05', '2025-06-18 03:13:05', NULL),
(27, 5, 3, '2025-02-08', NULL, 11381600.00, 694.00, 'USD', NULL, '2025-06-18 03:14:09', '2025-06-18 03:14:09', NULL),
(28, 5, 3, '2025-03-08', NULL, 11922964.00, 727.01, 'USD', NULL, '2025-06-18 03:17:12', '2025-06-18 03:17:12', NULL),
(29, 4, 4, '2024-06-06', NULL, 246000.00, 15.00, 'USD', NULL, '2025-06-18 03:18:37', '2025-06-18 03:18:37', NULL),
(30, 4, 4, '2024-07-04', NULL, 246000.00, 15.00, 'USD', NULL, '2025-06-18 03:19:29', '2025-06-18 03:19:29', NULL),
(31, 4, 4, '2024-08-04', NULL, 246000.00, 15.00, 'USD', NULL, '2025-06-18 03:20:17', '2025-06-18 03:20:17', NULL),
(32, 4, 4, '2024-09-04', NULL, 246000.00, 15.00, 'USD', NULL, '2025-06-18 03:20:56', '2025-06-18 03:20:56', NULL),
(33, 4, 4, '2025-01-04', NULL, 246000.00, 15.00, 'USD', NULL, '2025-06-18 03:22:38', '2025-06-18 03:22:38', NULL),
(34, 4, 4, '2025-02-04', NULL, 246000.00, 15.00, 'USD', NULL, '2025-06-18 03:22:57', '2025-06-18 03:22:57', NULL),
(35, 4, 4, '2025-03-04', NULL, 246000.00, 15.00, 'USD', NULL, '2025-06-18 03:23:13', '2025-06-18 03:23:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Elia Roysandi Manurun', 'elia@gmail.com', 'admin', NULL, '$2y$12$GHPUXGEui37FozcdvC8Rt.rAxXmOddUDZCUv9uRIARnaELH176YU2', NULL, '2025-06-17 13:22:54', '2025-06-17 13:22:54'),
(2, 'Heskiel', 'heskiel@gmail.com', 'user', NULL, '$2y$12$1mEljsXd3g0HvaMsyhrceerV4ASij/2rXot69pqqAXuNUSL7RynNm', NULL, '2025-06-17 14:47:15', '2025-06-17 14:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `vendor_start` date NOT NULL,
  `vendor_end` date DEFAULT NULL,
  `recurring_type` enum('Bulanan','Tahunan') DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `vendor_start`, `vendor_end`, `recurring_type`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Figma', '2025-01-15', '2025-08-28', 'Bulanan', 1, '2025-06-17 13:53:51', '2025-06-18 02:45:57'),
(2, 'EIKON', '2024-05-01', '2030-12-18', 'Bulanan', 1, '2025-06-18 01:36:47', '2025-06-18 02:40:15'),
(3, 'AWS (gpswox)', '2023-01-18', '2027-12-18', 'Bulanan', 1, '2025-06-18 01:37:15', '2025-06-18 02:39:39'),
(4, 'Bytebytego', '2024-06-06', '2027-12-18', 'Bulanan', 1, '2025-06-18 01:38:19', '2025-06-18 02:40:45'),
(5, 'Notion', '2024-06-08', '2026-12-03', 'Bulanan', 1, '2025-06-18 01:38:42', '2025-06-18 02:41:09'),
(6, 'Freepik', '2024-01-18', '2030-12-18', 'Bulanan', 1, '2025-06-18 01:39:33', '2025-06-18 01:39:33'),
(7, 'AWS', '2024-07-03', '2028-12-18', 'Bulanan', 1, '2025-06-18 02:42:40', '2025-06-18 02:42:44'),
(8, 'You Track', '2024-09-18', '2030-12-18', 'Tahunan', 1, '2025-06-18 02:43:33', '2025-06-18 02:43:33'),
(9, 'GCP', '2025-01-01', '2027-12-31', 'Bulanan', 1, '2025-06-18 02:44:17', '2025-06-18 02:44:17'),
(10, 'Comodo SSL', '2025-02-01', '2028-12-18', 'Bulanan', 1, '2025-06-18 02:45:23', '2025-06-18 02:45:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_vendor_id_foreign` (`vendor_id`),
  ADD KEY `transactions_category_id_foreign` (`category_id`),
  ADD KEY `transactions_date_transaction_index` (`date_transaction`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
