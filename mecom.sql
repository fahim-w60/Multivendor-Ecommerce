-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 06, 2023 at 10:35 PM
-- Server version: 8.0.34-0ubuntu0.20.04.1
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `brand_slug`, `brand_image`, `created_at`, `updated_at`) VALUES
(1, 'oppo', 'oppo', 'upload/brand/1766803323055235.png', '2023-05-24 13:02:31', '2023-05-24 13:02:31'),
(2, 'walton', 'walton', 'upload/brand/1766803352452693.png', '2023-05-24 13:02:46', '2023-05-24 13:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `category_image`, `created_at`, `updated_at`) VALUES
(1, 'category 1', 'category-1', 'upload/category_images/1766803391270619.png', '2023-05-24 13:03:36', '2023-05-24 13:03:36'),
(2, 'category 2', '', 'upload/category_images/1766803418197277.png', '2023-05-24 13:03:51', '2023-05-24 13:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_04_041602_create_brands_table', 1),
(6, '2023_02_04_104711_create_categories_table', 1),
(7, '2023_02_05_032648_create_subcategories_table', 1),
(8, '2023_02_06_051853_create_products_table', 1),
(9, '2023_02_06_055441_create_multi_imgs_table', 1),
(10, '2023_02_14_082318_create_order1s_table', 1),
(11, '2023_02_14_113201_create_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `multi_imgs`
--

CREATE TABLE `multi_imgs` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` int NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order1s`
--

CREATE TABLE `order1s` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `total_amount` int NOT NULL,
  `discount_amount` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order1s`
--

INSERT INTO `order1s` (`id`, `user_id`, `product_id`, `vendor_id`, `total_amount`, `discount_amount`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 3, 20, 2, 0, 0, 0, '2023-10-05 13:43:16', '2023-10-05 13:43:16'),
(2, 3, 20, 2, 0, 0, NULL, '2023-10-05 14:13:12', '2023-10-05 14:13:12'),
(3, 3, 20, 2, 0, 0, NULL, '2023-10-05 14:14:24', '2023-10-05 14:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `brand_id` int NOT NULL,
  `category_id` int NOT NULL,
  `subcategory_id` int NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_descp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_descp` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int DEFAULT NULL,
  `hot_deals` int DEFAULT NULL,
  `featured` int DEFAULT NULL,
  `special_offer` int DEFAULT NULL,
  `special_deals` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `subcategory_id`, `product_name`, `product_slug`, `product_code`, `product_qty`, `product_tags`, `product_size`, `product_color`, `selling_price`, `discount_price`, `short_descp`, `long_descp`, `product_thumbnail`, `vendor_id`, `hot_deals`, `featured`, `special_offer`, `special_deals`, `status`, `created_at`, `updated_at`) VALUES
(20, 2, 2, 5, 'shirt', 'shirt', '456465', '20', 'New Product,Top Product', 'Small,Medium,Large', 'Red,Blue,Black', '1000', '1000', 'sfsrhsrh', '<p>Hello, World!</p>', 'upload/products/thambnail/1769698126729693.1687715651.2023-06-25.jpg', 2, 1, 1, 1, 1, 1, '2023-06-25 11:54:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` int NOT NULL,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcategory_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`, `subcategory_slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'subcategory of 1', 'subcategory-of-1', '2023-05-24 13:04:33', '2023-05-24 13:04:33'),
(2, 1, '2 subcategory of 1', '2-subcategory-of-1', '2023-05-24 13:04:52', '2023-05-24 13:04:52'),
(3, 1, '3 subcategory of 1', '3-subcategory-of-1', '2023-05-24 13:05:06', '2023-05-24 13:05:06'),
(4, 2, '1 subcategory of 2', '1-subcategory-of-2', '2023-05-24 13:05:21', '2023-05-24 13:05:21'),
(5, 2, '2 subcategory of 2', '2-subcategory-of-2', '2023-05-24 13:05:34', '2023-05-24 13:05:34'),
(6, 2, '3 subcategory of 2', '3-subcategory-of-2', '2023-05-24 13:05:55', '2023-05-24 13:05:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `role` enum('admin','vendor','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `address`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$.L7G1wwl8shio9zhj2EJUeEClrSXuDeuQwCWQQWq02vX/yk7DWkSO', NULL, NULL, NULL, 'admin', 'active', NULL, NULL, NULL),
(2, 'vendor', 'vendor', 'vendor@gmail.com', NULL, '$2y$10$tf0yIq/3mJJoNCw6Kg497.uN.rqyAznHu45OJ3mOATmPSym3sX9oK', NULL, NULL, NULL, 'vendor', 'active', NULL, NULL, NULL),
(3, 'user', 'user', 'user@gmail.com', NULL, '$2y$10$NzXHcv3gY8A4ciQDfxrkzONo2sQuxxVY6aaOBcct6KFBzOFGdw15a', NULL, NULL, NULL, 'user', 'active', NULL, NULL, NULL),
(4, 'Prof. Penelope Moore', 'raynor.kevin', 'kris.mireille@example.net', '2023-05-06 14:00:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/0055bb?text=explicabo', '434-401-1666', '32619 Darlene Views Suite 161\nCarletonstad, MA 51707-2488', 'vendor', 'active', 'g2TYxu3Qfx', '2023-05-06 14:00:11', '2023-05-06 14:00:11'),
(5, 'Leif Bernier', 'xabbott', 'greenholt.tyler@example.org', '2023-05-06 14:00:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/00cc33?text=exercitationem', '(702) 332-2733', '315 Omari Mountains Apt. 254\nAustinton, DC 22771-9414', 'user', 'active', 'Ti1Bn6b4y3', '2023-05-06 14:00:11', '2023-05-06 14:00:11'),
(6, 'Ms. Ardella Strosin DVM', 'cschinner', 'hgerlach@example.net', '2023-05-06 14:00:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/00ee55?text=at', '283-270-5386', '243 Candace Hollow Apt. 696\nSouth Nelson, WV 21542', 'user', 'inactive', 'Mp4citnLe4', '2023-05-06 14:00:11', '2023-05-06 14:00:11'),
(7, 'Prof. Ephraim Quigley IV', 'valerie.oberbrunner', 'mroberts@example.com', '2023-05-06 14:00:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/00ee33?text=error', '+1 (520) 375-1400', '889 Hosea Corner\nHesselfort, TX 02411', 'vendor', 'inactive', 'fvgAcSYLjS', '2023-05-06 14:00:11', '2023-05-06 14:00:11'),
(8, 'Buford Eichmann', 'qdurgan', 'edyth81@example.org', '2023-05-06 14:00:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/008811?text=debitis', '1-480-681-7499', '288 Georgiana Throughway Suite 673\nLake Carlieport, AR 70832', 'admin', 'active', 'cd9YzmmVXn', '2023-05-06 14:00:11', '2023-05-06 14:00:11'),
(9, 'Roxanne Ebert', 'clarabelle.schuster', 'will.stacy@example.net', '2023-05-06 14:00:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/0022bb?text=alias', '606.438.0131', '35096 Fabian Fords\nHackettland, IN 47850', 'vendor', 'inactive', 'tzknISiTVY', '2023-05-06 14:00:12', '2023-05-06 14:00:12'),
(10, 'Dr. Deshaun Upton V', 'kade73', 'yreilly@example.org', '2023-05-06 14:00:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/004411?text=qui', '323.785.8100', '56538 Bulah Viaduct Suite 325\nManleyberg, ME 64709', 'user', 'inactive', '6rkhC0cpmT', '2023-05-06 14:00:12', '2023-05-06 14:00:12'),
(11, 'Ms. Monica Kuhn', 'fmann', 'iharris@example.net', '2023-05-06 14:00:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/00ddcc?text=eum', '+1-202-913-6374', '94333 Nikolaus Via\nBartolettiland, IN 63392', 'user', 'active', 'swcV9p3P8t', '2023-05-06 14:00:12', '2023-05-06 14:00:12'),
(12, 'Toni Dooley', 'corene23', 'monahan.madyson@example.org', '2023-05-06 14:00:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/009977?text=numquam', '+1-901-585-8287', '531 Schiller Mission Apt. 547\nRitaburgh, PA 46212', 'vendor', 'active', '2g7bjl0RKJ', '2023-05-06 14:00:12', '2023-05-06 14:00:12'),
(13, 'Prof. Llewellyn Walker DVM', 'jaycee93', 'jamil.boyer@example.net', '2023-05-06 14:00:11', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'https://via.placeholder.com/60x60.png/009966?text=laudantium', '+1 (445) 838-7700', '6075 Torp Trail Apt. 038\nDangeloview, OK 24161', 'user', 'inactive', 'vcOGwa2K9x', '2023-05-06 14:00:12', '2023-05-06 14:00:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `multi_imgs`
--
ALTER TABLE `multi_imgs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order1s`
--
ALTER TABLE `order1s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `multi_imgs`
--
ALTER TABLE `multi_imgs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `order1s`
--
ALTER TABLE `order1s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
