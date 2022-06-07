-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2022 at 12:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
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
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `followed_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `followed_by`, `created_at`, `updated_at`) VALUES
(184, 3, 1, '2022-05-09 00:04:33', '2022-05-09 00:04:33'),
(185, 5, 1, '2022-05-09 00:04:48', '2022-05-09 00:04:48'),
(186, 1, 3, '2022-05-09 00:37:27', '2022-05-09 00:37:27'),
(187, 1, 4, '2022-05-09 00:37:55', '2022-05-09 00:37:55'),
(188, 3, 4, '2022-05-09 01:16:12', '2022-05-09 01:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `tweet_id`, `created_at`, `updated_at`) VALUES
(126, 1, 2, '2022-05-07 02:05:08', '2022-05-07 02:05:08');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `body` varchar(250) DEFAULT NULL,
  `likes` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `shared_by` int(11) DEFAULT NULL,
  `shared_by_name` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`id`, `user_id`, `body`, `likes`, `shared_by`, `shared_by_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'This is just a test tweet', 0, NULL, NULL, '2022-04-30 07:34:59', '2022-04-30 07:34:59'),
(2, 1, 'This is my second tweet', 1, NULL, NULL, '2022-04-30 07:38:31', '2022-05-06 23:05:08'),
(3, 1, 'This is just a third tweet', 0, NULL, NULL, '2022-04-30 07:38:49', '2022-04-30 07:38:49'),
(4, 1, 'This is my forth tweet', 0, NULL, NULL, '2022-04-30 07:41:08', '2022-04-30 07:41:08'),
(5, 2, 'This is a tweet from james Osakwe!', 0, NULL, NULL, '2022-05-01 05:31:52', '2022-05-01 05:31:52'),
(6, 2, 'This is a second tweet created by james Osakwe', 0, NULL, NULL, '2022-05-01 05:32:24', '2022-05-01 05:32:24'),
(7, 2, 'This is the 3rd Tweet Created By James Osakwe', 0, NULL, NULL, '2022-05-01 05:32:50', '2022-05-01 05:32:50'),
(8, 2, 'This is the 4th Tweet Created by james Osakwe', 0, NULL, NULL, '2022-05-01 05:33:08', '2022-05-01 05:33:08'),
(9, 3, 'This is the first tweet created by Richard simpson', 0, 4, 'jonas brothers', '2022-05-01 05:34:18', '2022-05-08 22:16:28'),
(10, 3, 'This is the second tweet created by Richard SImpson', 0, 1, 'moses egboh', '2022-05-01 05:34:39', '2022-05-05 05:31:26'),
(11, 3, 'This is the third tweet created by richard simpson', 0, 1, 'moses egboh', '2022-05-01 05:34:56', '2022-05-08 21:36:35'),
(12, 3, 'This is the fourth tweet created by richard simpson', 0, NULL, NULL, '2022-05-01 05:36:02', '2022-05-01 05:36:02'),
(13, 3, 'This is the fifth tweet created by Richard SImpson', 0, 1, 'moses egboh', '2022-05-01 05:36:26', '2022-05-02 17:16:07'),
(14, 1, 'This is my 6th tweet!', 0, NULL, NULL, '2022-05-03 20:03:34', '2022-05-03 20:03:34'),
(15, 1, 'This is my 7th tweet!', 0, NULL, NULL, '2022-05-03 21:26:05', '2022-05-03 21:26:05'),
(16, 1, 'This is my 8th tweet!', 0, NULL, NULL, '2022-05-04 00:17:42', '2022-05-04 00:17:42'),
(17, 1, 'This is my 9th tweet', 0, NULL, NULL, '2022-05-04 00:18:53', '2022-05-04 00:18:53'),
(18, 1, 'This is my 10th tweet okay!!!', 0, NULL, NULL, '2022-05-04 00:19:10', '2022-05-08 19:08:54'),
(19, 3, 'This is my 6th tweet woohoooo!!', 0, NULL, NULL, '2022-05-04 21:04:09', '2022-05-06 22:54:36'),
(26, 1, 'This is my 11th tweet, Hello ...wohoo!!', 0, NULL, NULL, '2022-05-08 19:48:56', '2022-05-08 21:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `followers` int(11) UNSIGNED DEFAULT 0,
  `following` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `followers`, `following`, `created_at`, `updated_at`) VALUES
(1, 'moses egboh', 'mosesegboh@yahoo.com', NULL, '$2y$10$TlHwbouiKf/e6dO1/btG0eli3hVoIKg7MlvwS8/2pvN4tr5C/JxYG', 'Cqyc35V2MSysqfTFnJX0a4NblNQTLoBS9UJ9UrtXxHiz2BfZQeEFKfUsvX15', 2, 2, '2022-04-29 22:59:13', '2022-05-08 18:37:55'),
(2, 'James Osakwe', 'jamesosakwe@yahoo.com', NULL, '$2y$10$OlxubeHdhTEWaOs3mHqWX.8JOBOYUMJwIrz2GLCrg.l/V1EQ6JTVi', NULL, 0, 0, '2022-05-01 02:25:10', '2022-05-01 02:25:10'),
(3, 'Richard Simpson', 'richarsimpson@yaho.com', NULL, '$2y$10$TF406GI7X8V/u2XIboA45OlLD7XN1upRupa3HKyBgcG.HDMv48EBu', NULL, 2, 1, '2022-05-01 02:34:02', '2022-05-08 19:16:12'),
(4, 'jonas brothers', 'jonasbrothers@yahoo.com', NULL, '$2y$10$Y2gEw3Rdydqrq8ObV1F1EeQHxikPkAXUp/T2PPsBPOweUx6.LRfIu', NULL, 0, 2, '2022-05-02 14:22:00', '2022-05-08 19:16:12'),
(5, 'jerry egboh', 'jerryegboh@yahoo.com', NULL, '$2y$10$1ZTQGgBfTrT08h6vjFuOGu3Jy2/ye5ctxeSnls6EjCRf5bCgHDq2u', NULL, 1, 0, '2022-05-03 03:52:07', '2022-05-08 18:04:48');

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
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
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
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

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
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
