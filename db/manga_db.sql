-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2025 at 11:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manga_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name_TH` varchar(255) NOT NULL,
  `status_display` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name_TH`, `status_display`, `created_at`, `updated_at`) VALUES
(1, 'nattapol surinkeaw', 1, '2025-02-08 09:07:35', '2025-02-08 09:07:35'),
(2, 'ssss', 1, '2025-02-08 09:29:36', '2025-02-08 09:29:36'),
(3, 'dsadsa', 1, '2025-02-08 10:14:38', '2025-02-08 10:14:38'),
(4, 'dasdas', 1, '2025-02-10 07:54:39', '2025-02-10 07:54:39'),
(5, '1111', 1, '2025-02-10 07:54:44', '2025-02-10 07:54:44');

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cate_title` varchar(255) NOT NULL,
  `cate_url` varchar(255) NOT NULL,
  `cate_keyword` varchar(255) NOT NULL,
  `cate_display` tinyint(1) NOT NULL DEFAULT 1,
  `cate_priority` varchar(255) NOT NULL,
  `is_header` tinyint(1) NOT NULL DEFAULT 1,
  `is_menu` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cate_title`, `cate_url`, `cate_keyword`, `cate_display`, `cate_priority`, `is_header`, `is_menu`, `created_at`, `updated_at`) VALUES
(1, 'Home', '/', 'home', 1, '1', 1, 0, NULL, NULL),
(2, 'Manga', '/manga', 'manga', 1, '2', 1, 1, NULL, NULL),
(3, 'Doujin', '/doujin', 'doujin', 0, '3', 1, 1, NULL, NULL),
(4, 'about', '/aboutus', 'about', 1, '6', 1, 0, NULL, NULL),
(5, 'Search', '/search', 'Search', 1, '4', 1, 1, NULL, NULL);

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
-- Table structure for table `mangas`
--

CREATE TABLE `mangas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tag_id` varchar(255) DEFAULT NULL,
  `author_id` int(11) UNSIGNED NOT NULL,
  `title_TH` varchar(255) NOT NULL,
  `title_EN` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `status_display` tinyint(1) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mangas`
--

INSERT INTO `mangas` (`id`, `cate_id`, `tag_id`, `author_id`, `title_TH`, `title_EN`, `thumbnail`, `status_display`, `priority`, `created_at`, `updated_at`) VALUES
(2, 2, '0', 0, 'dasd', 'dasdas', 'https://images.unsplash.com/photo-1737100593814-8ceb04f29cca?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwyfHx8ZW58MHx8fHx8', 1, 1, '2025-01-07 22:00:54', '2025-01-07 22:00:54'),
(3, 3, '0', 0, 'dasdas', 'dasdsa', 'https://images.unsplash.com/photo-1738168251394-9241984c8292?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw0fHx8ZW58MHx8fHx8', 1, 1, '2025-01-07 23:12:00', '2025-01-07 23:12:00'),
(4, 3, '0', 0, 'dsad', 'dadas', 'https://plus.unsplash.com/premium_photo-1679064287823-fbd549bf47dd?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwxfHx8ZW58MHx8fHx8', 1, 1, '2025-01-07 23:24:16', '2025-01-07 23:24:16'),
(5, 2, '0', 0, 'dad', 'sda', 'https://images.unsplash.com/photo-1737100593814-8ceb04f29cca?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwyfHx8ZW58MHx8fHx8', 1, 1, '2025-01-07 23:24:37', '2025-01-07 23:24:37'),
(7, 3, '0', 0, 'dad', 'sdas', 'https://images.unsplash.com/photo-1734974981781-c4a077289b05?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw2Mnx8fGVufDB8fHx8fA%3D%3D', 1, 1, NULL, NULL),
(12, 2, '1,2', 0, 'weqe', 'qeqeqe', NULL, 1, 1, '2025-02-08 06:13:32', '2025-02-08 06:13:32'),
(13, 3, '1,2,3', 0, 'กหกฟ', 'กฟหก', NULL, 1, 1, '2025-02-08 08:25:43', '2025-02-08 08:25:43'),
(14, 3, '2', 0, '444', '444', NULL, 1, 1, '2025-02-08 08:53:06', '2025-02-08 08:53:06'),
(16, 2, '1', 1, 'ลาสุด', 'ล่าสุด', 'https://lh5.googleusercontent.com/d/dasdsdsa', 1, 1, '2025-02-10 08:11:11', '2025-02-10 08:11:39'),
(17, 2, '', 1, 'rrr', 'rrr', NULL, 1, 1, '2025-02-11 08:08:30', '2025-02-11 08:08:30'),
(18, 3, '', 4, 'rrr', 'rrr', NULL, 1, 1, '2025-02-11 08:08:37', '2025-02-11 08:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `manga_episodes`
--

CREATE TABLE `manga_episodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manga_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manga_episodes`
--

INSERT INTO `manga_episodes` (`id`, `manga_id`, `title`, `created_at`, `updated_at`) VALUES
(2, 2, 'ตอนที่ 1', '2025-01-08 00:05:42', '2025-01-08 00:05:42'),
(3, 7, 'dsadsa', NULL, NULL),
(4, 7, 'ตอนที่ 1', NULL, NULL),
(5, 7, 'dasda', NULL, NULL),
(6, 4, 'ตอนที่ 1', NULL, NULL),
(7, 4, 'ตอนที่ 2', NULL, NULL),
(8, 4, 'ตอนที่ 3', NULL, NULL),
(12, 3, 'ตอนที่ 1', NULL, NULL),
(17, 5, 'dsdad', NULL, NULL),
(22, 16, 'ตอนที่ 1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manga_images`
--

CREATE TABLE `manga_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ep_id` bigint(20) UNSIGNED NOT NULL,
  `image_link` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manga_images`
--

INSERT INTO `manga_images` (`id`, `ep_id`, `image_link`, `priority`, `created_at`, `updated_at`) VALUES
(1, 2, 'https://images.unsplash.com/photo-1737100593814-8ceb04f29cca?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwyfHx8ZW58MHx8fHx8', 1, NULL, NULL),
(2, 2, 'https://images.unsplash.com/photo-1737100593814-8ceb04f29cca?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwyfHx8ZW58MHx8fHx8', 1, NULL, NULL),
(3, 2, 'https://images.unsplash.com/photo-1737100593814-8ceb04f29cca?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwyfHx8ZW58MHx8fHx8', 2, NULL, NULL),
(4, 6, 'https://plus.unsplash.com/premium_photo-1734710081822-1396d1f13f99?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1fHx8ZW58MHx8fHx8', 1, NULL, NULL),
(5, 6, 'https://plus.unsplash.com/premium_photo-1671209881093-589125ec2a86?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwxfHx8ZW58MHx8fHx8', 2, NULL, NULL),
(6, 6, 'https://plus.unsplash.com/premium_photo-1734710081822-1396d1f13f99?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1fHx8ZW58MHx8fHx8', 1, NULL, NULL),
(7, 6, 'https://plus.unsplash.com/premium_photo-1671209881093-589125ec2a86?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwxfHx8ZW58MHx8fHx8', 2, NULL, NULL),
(19, 3, 'https://images.unsplash.com/photo-1734974981781-c4a077289b05?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw2Mnx8fGVufDB8fHx8fA%3D%3D', 1, NULL, NULL),
(20, 3, 'https://images.unsplash.com/photo-1738741267863-a8437f7c3672?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw1Mnx8fGVufDB8fHx8fA%3D%3D', 2, NULL, NULL),
(21, 3, 'https://plus.unsplash.com/premium_photo-1738599623097-f630b1e4dab6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHw0NXx8fGVufDB8fHx8fA%3D%3D', 3, NULL, NULL),
(22, 3, 'https://images.unsplash.com/photo-1738336453234-9fe01fe5d6bf?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwzOXx8fGVufDB8fHx8fA%3D%3D', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manga_tags`
--

CREATE TABLE `manga_tags` (
  `id` int(11) NOT NULL,
  `title_tag` varchar(255) NOT NULL,
  `status_display` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `manga_tags`
--

INSERT INTO `manga_tags` (`id`, `title_tag`, `status_display`, `created_at`, `updated_at`) VALUES
(1, 'love com', 1, '2025-02-08 04:47:36', '2025-02-08 04:47:36'),
(2, 'adveture', 1, '2025-02-08 06:08:52', '2025-02-08 06:08:52'),
(3, 'dasdsa', 1, '2025-02-08 08:06:50', '2025-02-08 08:06:50'),
(4, 'dsdas', 1, '2025-02-10 08:01:32', '2025-02-10 08:01:32');

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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_25_131950_create_categories_table', 1),
(5, '2024_12_25_132120_create_mangas_table', 1),
(6, '2024_12_25_132123_create_manga_episodes_table', 1),
(7, '2024_12_25_132144_create_manga_images_table', 1),
(8, '2024_12_28_082644_create_personal_access_tokens_table', 1);

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
('qYu2OWMJIm3SDpemRePXC8ftXBcb5q6vv7XBH0QJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaW9hQUc3anIyMU5RRUxreUJsZG03MVlRcmVZNVlSeWNSNkxZbWR5ZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1737008108);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `user_old` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_old`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nattapol', 'nutaponza123456@gmail.com', NULL, '$2y$12$kQGyC7637zUJaYQn7rPe7.W8OsdzRzrUEhVhELpto4mFOYqA2WEQS', 22, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `mangas`
--
ALTER TABLE `mangas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mangas_cate_id_foreign` (`cate_id`);

--
-- Indexes for table `manga_episodes`
--
ALTER TABLE `manga_episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manga_episodes_manga_id_foreign` (`manga_id`);

--
-- Indexes for table `manga_images`
--
ALTER TABLE `manga_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manga_images_ep_id_foreign` (`ep_id`);

--
-- Indexes for table `manga_tags`
--
ALTER TABLE `manga_tags`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `mangas`
--
ALTER TABLE `mangas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `manga_episodes`
--
ALTER TABLE `manga_episodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `manga_images`
--
ALTER TABLE `manga_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `manga_tags`
--
ALTER TABLE `manga_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `manga_episodes`
--
ALTER TABLE `manga_episodes`
  ADD CONSTRAINT `manga_episodes_manga_id_foreign` FOREIGN KEY (`manga_id`) REFERENCES `mangas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `manga_images`
--
ALTER TABLE `manga_images`
  ADD CONSTRAINT `manga_images_ep_id_foreign` FOREIGN KEY (`ep_id`) REFERENCES `manga_episodes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
