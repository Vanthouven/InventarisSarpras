-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2025 at 11:41 AM
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
-- Database: `sapras`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `role` enum('siswa','guru') NOT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `status` enum('belum_kembali','sudah_kembali') NOT NULL DEFAULT 'belum_kembali',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrowings`
--

INSERT INTO `borrowings` (`id`, `nama`, `role`, `jurusan`, `kelas`, `status`, `created_at`, `updated_at`) VALUES
(8, 'amin', 'siswa', 'Rekayasa Perangkat Lunak', NULL, 'belum_kembali', '2025-05-29 06:57:13', '2025-05-29 06:57:13'),
(11, 'amin', 'guru', NULL, NULL, 'sudah_kembali', '2025-05-30 01:55:42', '2025-05-30 06:20:35'),
(12, 'joko', 'siswa', 'Rekayasa Perangkat Lunak', NULL, 'sudah_kembali', '2025-05-30 01:57:31', '2025-05-30 06:20:33'),
(13, 'guru', 'siswa', 'Rekayasa Perangkat Lunak', NULL, 'sudah_kembali', '2025-05-30 01:57:49', '2025-05-30 06:20:30'),
(14, 'amin', 'siswa', 'Rekayasa Perangkat Lunak', NULL, 'sudah_kembali', '2025-05-30 01:58:52', '2025-05-30 06:09:47'),
(15, 'guru', 'siswa', 'Rekayasa Perangkat Lunak', 'X', 'sudah_kembali', '2025-05-30 02:02:42', '2025-05-30 06:00:10'),
(16, 'guru', 'guru', NULL, NULL, 'sudah_kembali', '2025-05-30 02:08:12', '2025-05-30 05:59:14'),
(17, 'joko', 'siswa', 'Rekayasa Perangkat Lunak', 'XII', 'sudah_kembali', '2025-05-30 02:41:26', '2025-05-30 05:14:00'),
(18, 'andre', 'guru', NULL, NULL, 'sudah_kembali', '2025-05-30 03:04:30', '2025-05-30 05:13:52'),
(19, 'amin', 'siswa', 'Rekayasa Perangkat Lunak', 'X', 'sudah_kembali', '2025-05-30 03:08:39', '2025-05-30 05:06:43'),
(20, 'amin', 'siswa', 'Rekayasa Perangkat Lunak', 'X', 'sudah_kembali', '2025-05-30 03:08:39', '2025-05-30 05:07:48'),
(21, 'amin', 'siswa', 'Rekayasa Perangkat Lunak', 'XII', 'belum_kembali', '2025-05-30 06:22:24', '2025-05-30 06:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing_item`
--

CREATE TABLE `borrowing_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `borrowing_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrowing_item`
--

INSERT INTO `borrowing_item` (`id`, `borrowing_id`, `item_id`, `quantity`, `created_at`, `updated_at`) VALUES
(7, 8, 1, 1, '2025-05-29 06:57:13', '2025-05-29 06:57:13'),
(10, 11, 1, 1, '2025-05-30 01:55:42', '2025-05-30 01:55:42'),
(11, 12, 1, 1, '2025-05-30 01:57:31', '2025-05-30 01:57:31'),
(12, 13, 1, 1, '2025-05-30 01:57:49', '2025-05-30 01:57:49'),
(13, 14, 1, 1, '2025-05-30 01:58:52', '2025-05-30 01:58:52'),
(14, 15, 1, 1, '2025-05-30 02:02:42', '2025-05-30 02:02:42'),
(15, 16, 1, 1, '2025-05-30 02:08:12', '2025-05-30 02:08:12'),
(16, 17, 1, 1, '2025-05-30 02:41:26', '2025-05-30 02:41:26'),
(17, 18, 1, 1, '2025-05-30 03:04:30', '2025-05-30 03:04:30'),
(18, 19, 1, 1, '2025-05-30 03:08:39', '2025-05-30 03:08:39'),
(19, 21, 1, 50, '2025-05-30 06:22:24', '2025-05-30 06:22:24');

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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaBarang` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `namaBarang`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 'pulpen', 49, '2025-05-29 02:50:33', '2025-05-30 06:22:24'),
(2, 'linggis', 50, '2025-05-29 03:29:54', '2025-05-29 03:29:54'),
(3, 'monitor', 12, '2025-05-29 06:05:01', '2025-05-29 06:05:01'),
(4, 'monitor advan', 1, '2025-05-29 06:29:01', '2025-06-01 02:25:35'),
(5, 'pc sekolah', 1, '2025-05-30 01:45:20', '2025-06-01 02:25:23');

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
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2025_05_28_011735_create_items_table', 1),
(9, '2025_05_28_042005_rename_column_in_table', 1),
(10, '2025_05_29_101613_create_borrowing_item_table', 2);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','viewer') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `role`, `created_at`, `updated_at`) VALUES
(12, 'admin', 'admin', 'admin', '2025-05-31 05:12:27', '2025-05-31 05:12:27'),
(18, 'adminsapras', '$2y$12$K7Zz6XAbbDyHWpRJnAfqeu7b5HJIAOAg9Qx7qdWfBCUSLtu0lfyHq', 'petugas', '2025-05-31 07:35:35', '2025-05-31 07:35:35'),
(20, 'viewer', '$2y$12$JXFdfkLQTOvD4o2n/n0trugNIn0b2XeVwfwzkHhYVzOKOs9cmes3y', 'viewer', '2025-06-01 00:43:40', '2025-06-01 00:43:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowing_item`
--
ALTER TABLE `borrowing_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrowing_item_borrowing_id_foreign` (`borrowing_id`),
  ADD KEY `borrowing_item_item_id_foreign` (`item_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `borrowing_item`
--
ALTER TABLE `borrowing_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowing_item`
--
ALTER TABLE `borrowing_item`
  ADD CONSTRAINT `borrowing_item_borrowing_id_foreign` FOREIGN KEY (`borrowing_id`) REFERENCES `borrowings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowing_item_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
