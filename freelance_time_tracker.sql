-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2025 at 09:12 PM
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
-- Database: `freelance_time_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `name`, `email`, `contact_person`, `created_at`, `updated_at`) VALUES
(1, 12, 'Test Client', 'abc2@gamil.com', 'Test', '2025-05-28 12:36:23', '2025-05-28 12:36:23'),
(2, 12, 'Test Client 1', 'test1@gamil.com', 'Test', '2025-05-28 12:36:53', '2025-05-28 12:36:53');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2014_10_12_100000_create_password_resets_table', 2),
(13, '2025_05_27_185932_create_clients_table', 2),
(14, '2025_05_28_154037_create_projects_table', 2),
(15, '2025_05_28_161423_create_time_logs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', '24d8b7fcba8b1c66ae5d36f6aafc7b55892c04d0fbe4af0df4e20ea006a4ca99', '[\"*\"]', NULL, NULL, '2025-05-27 12:07:58', '2025-05-27 12:07:58'),
(2, 'App\\Models\\User', 1, 'auth_token', '4fb727f789e9229b5fe48204fa16684d44c08496ec67f0ccd0b72218bb21813e', '[\"*\"]', NULL, NULL, '2025-05-27 12:10:14', '2025-05-27 12:10:14'),
(3, 'App\\Models\\User', 1, 'auth_token', 'e55c469451e325b8ded555fe149c44deaab86f7edb063538d08f4c0fb9d706e5', '[\"*\"]', NULL, NULL, '2025-05-27 12:16:37', '2025-05-27 12:16:37'),
(4, 'App\\Models\\User', 4, 'auth_token', 'ada7066b6526a35a97387932cd08db65439d87cc83f94bea0be6f486b500b763', '[\"*\"]', NULL, NULL, '2025-05-27 12:21:14', '2025-05-27 12:21:14'),
(5, 'App\\Models\\User', 1, 'auth_token', '974c9ff9ee033febda48def10133e0486e90ed851e0bd0007cfab70350db4fba', '[\"*\"]', NULL, NULL, '2025-05-27 12:22:14', '2025-05-27 12:22:14'),
(6, 'App\\Models\\User', 1, 'auth_token', '0c5caa5790a5dd424900e89214f6a3c254258b6098573e2aa342c94ddc128f7c', '[\"*\"]', NULL, NULL, '2025-05-27 12:23:12', '2025-05-27 12:23:12'),
(7, 'App\\Models\\User', 5, 'auth_token', '31da684f21dd86fbf8edaa7eb7ba1cdde83bd88b13cf0b0ac06c4b3130085e2f', '[\"*\"]', NULL, NULL, '2025-05-27 12:23:51', '2025-05-27 12:23:51'),
(8, 'App\\Models\\User', 1, 'auth_token', '3eb0ed517db78b9437d0b3bd6c5d24be11bc15551ec5ac57a1301847eddd5cf2', '[\"*\"]', NULL, NULL, '2025-05-27 12:24:04', '2025-05-27 12:24:04'),
(14, 'App\\Models\\User', 11, 'auth_token', '227a3fb8dcdd5f5471a75d7068724903e1b4ee3e00f654a5909978d8958a370d', '[\"*\"]', NULL, NULL, '2025-05-27 12:55:05', '2025-05-27 12:55:05'),
(19, 'App\\Models\\User', 12, 'auth_token', '8aa42b55ba05f62277990993390a35147cb692a1daff56015950f001c132e8d7', '[\"*\"]', NULL, NULL, '2025-05-27 13:08:51', '2025-05-27 13:08:51'),
(27, 'App\\Models\\User', 14, 'auth_token', 'd9bad33ca79f40e764768f8f1912ef80ecd43c60b04cf83af97d129b5ec413b2', '[\"*\"]', '2025-05-28 08:47:09', NULL, '2025-05-28 08:00:54', '2025-05-28 08:47:09'),
(31, 'App\\Models\\User', 15, 'auth_token', 'c4583414a07991e83668d7fc21d7ace28e40bc3003d446ad2be2513a6eb2abb2', '[\"*\"]', '2025-05-28 08:49:49', NULL, '2025-05-28 08:49:41', '2025-05-28 08:49:49'),
(33, 'App\\Models\\User', 11, 'auth_token', 'e76452cadc166174317ee43c1ffae3ce790f3d79361db8833bd1e3c28318be44', '[\"*\"]', '2025-05-28 09:26:45', NULL, '2025-05-28 09:18:15', '2025-05-28 09:26:45'),
(34, 'App\\Models\\User', 11, 'auth_token', '25a9c1767e1d2d9f2e068f9093b72984c1a5119569e86f569d3cbf8d0901384d', '[\"*\"]', '2025-05-28 09:35:48', NULL, '2025-05-28 09:27:42', '2025-05-28 09:35:48'),
(36, 'App\\Models\\User', 11, 'auth_token', 'd963117f6a2df3da22d4ddb2d72a8368b98e74dea26f7d715f8247890d61ac85', '[\"*\"]', '2025-05-28 10:12:45', NULL, '2025-05-28 09:41:26', '2025-05-28 10:12:45'),
(38, 'App\\Models\\User', 12, 'auth_token', '26ea806104f57cb8194b0be5bfd84dafff997830179bbf57ee0246b19b17a6e1', '[\"*\"]', '2025-05-28 12:47:17', NULL, '2025-05-28 11:17:09', '2025-05-28 12:47:17'),
(39, 'App\\Models\\User', 12, 'auth_token', '8762c539d5f34e94c5392038dbd02d0cbf59ddf400716473ee0855476d6b1ece', '[\"*\"]', '2025-05-28 13:07:09', NULL, '2025-05-28 12:47:29', '2025-05-28 13:07:09');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','completed') NOT NULL DEFAULT 'active',
  `deadline` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `client_id`, `title`, `description`, `status`, `deadline`, `created_at`, `updated_at`) VALUES
(1, 1, 'My New Project 1', 'This is a description of my new project 1', 'active', '2024-11-30', '2025-05-28 12:38:11', '2025-05-28 12:38:11'),
(2, 2, 'My New Project 2', 'This is a description of my new project 1', 'active', '2024-11-30', '2025-05-28 12:38:18', '2025-05-28 12:38:18');

-- --------------------------------------------------------

--
-- Table structure for table `time_logs`
--

CREATE TABLE `time_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_time` timestamp NULL DEFAULT NULL,
  `hours` decimal(5,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_logs`
--

INSERT INTO `time_logs` (`id`, `project_id`, `user_id`, `start_time`, `end_time`, `hours`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 12, '2024-03-21 08:00:00', '2024-03-21 09:30:00', NULL, 'Meeting', '2025-05-28 12:43:13', '2025-05-28 12:48:13'),
(2, 1, 12, '2024-03-01 03:00:00', '2024-03-01 12:30:00', NULL, 'Clent meeting 1', '2025-05-28 12:49:10', '2025-05-28 12:49:10'),
(3, 1, 12, '2024-03-02 03:00:00', '2024-03-02 12:30:00', NULL, 'Clent meeting 2', '2025-05-28 12:49:24', '2025-05-28 12:49:24'),
(4, 1, 12, '2024-03-03 03:00:00', '2024-03-03 12:30:00', NULL, 'Clent meeting 3', '2025-05-28 12:49:35', '2025-05-28 12:49:35'),
(7, 2, 12, '2025-05-28 18:54:16', '2025-05-28 12:54:16', 0.02, 'Clent meeting 10', '2025-05-28 12:53:00', '2025-05-28 12:54:16'),
(9, 2, 12, '2025-05-28 19:00:49', '2025-05-28 13:00:49', 0.02, 'Clent meeting 10', '2025-05-28 12:59:48', '2025-05-28 13:00:49');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(11, 'Tufan', 'tufan@gmail.com', NULL, '$2y$12$mvQWgjdmHjGGqxfpXeUTCu89mmyvGYl/054lADXnmHnzbRQHzXZrC', NULL, '2025-05-27 12:55:05', '2025-05-27 12:55:05'),
(12, 'Tufan', 'tufan1@gmail.com', NULL, '$2y$12$bWxXumoh8yZDXzmKagC97Ol97ZGm8xlhIV.EvcT8.zcITBXhK8ncW', NULL, '2025-05-27 13:08:51', '2025-05-27 13:08:51'),
(13, 'Tufan', 'robiul@gmail.com', NULL, '$2y$12$0rflLZ5KyeXnZZSXxJjM/./9Y0vWpanClA5b1IQ/X1rYCzrvKEYZG', NULL, '2025-05-27 13:14:18', '2025-05-27 13:14:18'),
(14, 'Tufan', 'robiul1@gmail.com', NULL, '$2y$12$Z0LAsea0nIHAUVgIAe0jq.2s9iKDpv7qo6PhX0ewsrl.Bi7WjMhIC', NULL, '2025-05-28 08:00:54', '2025-05-28 08:00:54'),
(15, 'Tufan', 'robiul2@gmail.com', NULL, '$2y$12$aJnwFTW0c.KIcJu43AK5uuzNY4nx2FYllU5uuFH75bCXpQwEGBKQq', NULL, '2025-05-28 08:49:41', '2025-05-28 08:49:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_user_id_foreign` (`user_id`);

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
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_client_id_foreign` (`client_id`);

--
-- Indexes for table `time_logs`
--
ALTER TABLE `time_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_logs_project_id_foreign` (`project_id`),
  ADD KEY `time_logs_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `time_logs`
--
ALTER TABLE `time_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `time_logs`
--
ALTER TABLE `time_logs`
  ADD CONSTRAINT `time_logs_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `time_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
