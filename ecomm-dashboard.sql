-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2024 at 09:27 PM
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
-- Database: `ecomm-dashboard`
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
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_10_27_050609_create_products_table', 1),
(5, '2014_10_12_000000_create_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(46, 'App\\Models\\User', 44, 'API Token', '26793ebbe390be7c79a189be64c55a396843f751b64c191e5e26e8764c376f23', '[\"*\"]', '2023-11-20 00:26:56', NULL, '2023-11-20 00:25:10', '2023-11-20 00:26:56'),
(47, 'App\\Models\\User', 44, 'API Token', '40922a4a82debff55f7564a39e8e9b06be4ac870574af6d6baecfbd13a3bac8b', '[\"*\"]', '2023-11-27 21:56:30', NULL, '2023-11-27 21:56:28', '2023-11-27 21:56:30'),
(48, 'App\\Models\\User', 44, 'API Token', 'ad86010cfca3a525e1fa9d10d893fe1c74906f3792a0a42895820b25c78a6e60', '[\"*\"]', '2023-11-27 21:57:16', NULL, '2023-11-27 21:57:15', '2023-11-27 21:57:16'),
(63, 'App\\Models\\User', 75, 'API Token', '9ffa4bbf9f785b93b3248ad90bdd198329f545ab4d5cdd60b05152f033b106d6', '[\"*\"]', '2024-07-08 19:31:50', NULL, '2024-07-08 12:08:02', '2024-07-08 19:31:50');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Toy for kids', 'Brand new kids car', '500', '1699501479.jpg', '2023-10-27 03:18:48', '2024-07-05 10:33:48'),
(3, 'Men Shirt', 'Brand new shirt', '850', '1698726388.jpg', '2023-10-27 05:32:02', '2023-11-17 03:20:35'),
(4, 'Samsung A23', '64GB Storage by 4GB RAM', '15000', '1698395627.jpg', '2023-10-27 05:33:47', '2023-11-18 01:56:38'),
(5, 'Nokia C21', '64GB Storage by 4GB RAM', '13500', '1698740843.jpg', '2023-10-27 06:00:12', '2023-11-07 23:08:15'),
(6, 'Apple Laptop', '7th Generation 1TB Storage 8GB RAM,4GB With graphics card', '25000', '1699435283.jpg', '2023-10-31 05:29:23', '2023-11-15 00:08:58'),
(19, 'Beats Solo', 'Impressive sound quality', '2500', '1699509385.jpg', '2023-10-30 04:05:07', '2023-11-09 03:00:39'),
(22, 'Smart Watch', 'Watch that suits to your occasions', '2500', '1698999548.jpg', '2023-10-31 04:33:21', '2023-11-15 00:04:32'),
(70, 'Air Pod', 'Impressive sound quality With advanced features', '1250', '1699498702.jpg', '2023-11-08 23:58:22', '2023-11-09 06:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Natnael', 'Berhanu', 'natman093@gmail.com', '0970951608', NULL, '$2y$10$/vkOuR8EQfB6adElLW8zdO0RzC0JRBCKo9gmpHeg2Ti.cmnpnDKQu', NULL, '2023-10-27 03:52:12', '2023-10-27 03:52:12'),
(2, 'Abebe', 'Kebede', 'kebAbe093@gmail.com', '0969967890', NULL, '$2y$10$h7w6.D2WBxJoxzpr6br92.mTP1pxHIMQJoWBBnb7LHqSoCdD3zQPy', NULL, '2023-10-27 04:00:19', '2023-10-27 04:00:19'),
(3, 'Hailu', 'Kebede', 'Hailu@gmail.com', '0934567890', NULL, '$2y$10$ak0KkJHLewUDpM0ofdecU.nMh1Xn9A83RuOGCS3XPcQgjJcBQxS7G', NULL, '2023-10-27 04:07:29', '2023-10-27 04:07:29'),
(4, 'Alemayehu', 'Tefera', 'Aletefra@gmail.com', '0934567890', NULL, '$2y$10$tt6zUKFzEpM17VqiVyvhLulQBp4eisdCJb9qnuXRJ2OujM9A/HSFu', NULL, '2023-10-27 04:13:55', '2023-10-27 04:13:55'),
(14, 'Ketema', 'Derbew', 'ketder089@gmail.com', '0934567890', NULL, '$2y$10$I6fexFnjSJsF669r9UViSOi7b1lZ6/dcAd1LMTONP94nXrgfghCu6', NULL, '2023-10-31 04:29:42', '2023-10-31 04:29:42'),
(44, 'Solomon', 'Debebe', 'solomon@gmail.com', '0911147795', NULL, '$2y$10$T5o9lljLCXPKbmWfGdxjoOICxUFBV2QG7zZWkL5l0cd2hgRgaHhhu', NULL, '2023-11-09 05:52:55', '2023-11-09 05:52:55'),
(75, 'Ab', 'Kb', 'abeKee093@gmail.com', '0900951890', NULL, '$2y$10$Ix.0Wq0IvqHHvrott2.7vujD1kG8TD0uydzAYkIfMN/qCTQU4LtXu', NULL, '2024-07-05 09:41:11', '2024-07-05 09:41:11');

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
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
