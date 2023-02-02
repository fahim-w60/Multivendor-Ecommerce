-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 04:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_join` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_short_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','vendor','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `address`, `vendor_join`, `vendor_short_info`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fahim', 'admin', 'admin@gmail.com', NULL, '$2y$10$zDDTvRisG10.xXWhujI8LuPbc92pTl9T0z46mOsX1lXCvLNzjcQo.', '202301300646Screenshot_20200809-175110_OfficeSuite.jpg', '01869520885', 'Rampura,Dhaka', NULL, NULL, 'admin', 'active', NULL, NULL, '2023-01-30 04:05:32'),
(2, 'Ariyan Food Ltd', 'vendor', 'vendor@gmail.com', NULL, '$2y$10$o1ION3B1pp8kBaeVMAWuTOayeytsfuoUL5nLZNIgo7O43WV/6n77q', '202301310525update.PNG', '01869520885666', 'Munshiganj,Dhaka', '2023', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum', 'vendor', 'active', NULL, NULL, '2023-01-31 00:24:13'),
(3, 'user', 'user', 'user@gmail.com', NULL, '$2y$10$BBqpIwSRtv651XMIqKW9yeMKAtq3I4khdtpLyMX3dw3di6bYQRkXe', NULL, NULL, NULL, NULL, NULL, 'user', 'active', NULL, NULL, NULL),
(4, 'Austyn Lockman', 'gschiller', 'shawn.kling@example.net', '2023-01-28 02:33:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/00aa66?text=ducimus', '+16574325254', '8108 Taylor Highway Apt. 552\nYundtfurt, OR 66191', NULL, NULL, 'vendor', 'inactive', 'A4iuw84xXT', '2023-01-28 02:33:18', '2023-01-28 02:33:18'),
(5, 'Andres Lowe', 'chadd20', 'kshlerin.torrance@example.com', '2023-01-28 02:33:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/0055cc?text=nam', '(574) 643-4360', '220 Kris Track Apt. 195\nNorth Brantfort, CT 84906-4882', NULL, NULL, 'vendor', 'active', 'jq5rov4iaU', '2023-01-28 02:33:19', '2023-01-28 02:33:19'),
(6, 'Cornelius Bashirian', 'lhills', 'meta.kuhic@example.com', '2023-01-28 02:33:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/005588?text=est', '651.644.9439', '28936 Aida Lakes\nEast Destanychester, GA 13773', NULL, NULL, 'admin', 'active', 'M4OdFPYmXC', '2023-01-28 02:33:19', '2023-01-28 02:33:19'),
(7, 'Ms. Delores Mitchell Jr.', 'wondricka', 'lavern.jast@example.net', '2023-01-28 02:33:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/00ff99?text=qui', '609.796.8486', '83755 Prudence Walk Suite 329\nSouth Kayleighchester, WY 33841', NULL, NULL, 'user', 'inactive', 'UTXu4x7i7E', '2023-01-28 02:33:19', '2023-01-28 02:33:19'),
(8, 'Prof. Winnifred Ward V', 'ichristiansen', 'nolson@example.net', '2023-01-28 02:33:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/003377?text=aut', '(515) 922-3793', '330 Carter Squares\nNorth Alexys, WY 71095', NULL, NULL, 'vendor', 'inactive', 'vpLwoT9lGi', '2023-01-28 02:33:19', '2023-01-28 02:33:19'),
(9, 'Mrs. Brisa Klein DVM', 'barney97', 'lessie12@example.com', '2023-01-28 02:33:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/001166?text=saepe', '540-947-7392', '231 Karl Pike Suite 645\nEast Lucyland, NM 87155-5790', NULL, NULL, 'vendor', 'active', 'GxDGHfQPHT', '2023-01-28 02:33:19', '2023-01-28 02:33:19'),
(10, 'Margot Jakubowski', 'maynard81', 'ebba16@example.org', '2023-01-28 02:33:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/0099cc?text=voluptas', '1-534-588-8440', '79550 Haag Flat Apt. 880\nNorth Rosaton, FL 02520', NULL, NULL, 'vendor', 'inactive', 'fDrPvGFxXB', '2023-01-28 02:33:19', '2023-01-28 02:33:19'),
(11, 'Oliver Dare', 'nicole82', 'eliezer.padberg@example.org', '2023-01-28 02:33:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/00ee88?text=id', '+1-337-742-8568', '428 Dorthy Trail Apt. 119\nSouth Maxland, ID 58812-3328', NULL, NULL, 'vendor', 'active', 'uozSi6crY0', '2023-01-28 02:33:19', '2023-01-28 02:33:19'),
(12, 'River Thiel', 'nikolas.collier', 'jritchie@example.net', '2023-01-28 02:33:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/000088?text=sapiente', '1-669-323-9790', '412 Balistreri Turnpike Suite 690\nSouth Trevionhaven, MD 71419-3945', NULL, NULL, 'admin', 'active', 'PRh3l2Yobr', '2023-01-28 02:33:20', '2023-01-28 02:33:20'),
(13, 'Florence Lowe', 'mdouglas', 'wiegand.susan@example.com', '2023-01-28 02:33:18', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/0066aa?text=nobis', '1-863-764-8004', '7579 Hermann Stream\nWest Genevievefort, CA 70740-8326', NULL, NULL, 'user', 'active', 'VOVDkygh5N', '2023-01-28 02:33:20', '2023-01-28 02:33:20'),
(14, 'Tanim Hasan Mahmud', 'tanim', 'tanim@gmail.com', NULL, '$2y$10$Pv9hrrbg2rQhnhqwMmTuauNzU16SwQiW38UeE2dGt/3hSGJ/jNiei', '202301301049walli.PNG', '01869520885', '7579 Hermann Stream\nWest Genevievefort, CA 70740-8326', NULL, NULL, 'admin', 'active', NULL, '2023-01-28 02:43:47', '2023-01-30 23:33:31'),
(17, 'nobie', NULL, 'nobie@gmail.com', NULL, '$2y$10$KE0DRajf6.VgXABHgct5FezD9LVgVmu7VV4WIcY05lWuf2Vez4uha', NULL, NULL, NULL, NULL, NULL, 'user', 'active', NULL, '2023-01-31 11:16:41', '2023-01-31 11:16:41');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
