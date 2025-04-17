-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 07:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hexolt`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'UpdateHuman Resources', 'active', '2025-04-17 14:20:31', '2025-04-17 09:44:47'),
(3, 'Financee', 'active', '2025-04-17 14:20:31', '2025-04-17 09:48:15'),
(4, 'IT Support', 'active', '2025-04-17 14:20:31', '2025-04-17 09:53:26'),
(5, 'Marketing', 'active', '2025-04-17 14:20:31', '2025-04-17 14:20:31'),
(6, 'Sales', 'active', '2025-04-17 14:20:31', '2025-04-17 14:20:31'),
(7, 'Customer Service', 'inactive', '2025-04-17 14:20:31', '2025-04-17 14:20:31'),
(8, 'Product Development', 'active', '2025-04-17 14:20:31', '2025-04-17 14:20:31'),
(9, 'Research and Development', 'active', '2025-04-17 14:20:31', '2025-04-17 14:20:31'),
(10, 'Logistics', 'inactive', '2025-04-17 14:20:31', '2025-04-17 14:20:31'),
(11, 'Legal', 'active', '2025-04-17 14:20:31', '2025-04-17 14:20:31'),
(12, 'myk', 'active', '2025-04-17 09:49:28', '2025-04-17 09:49:28'),
(13, 'ABC', 'active', '2025-04-17 09:50:38', '2025-04-17 09:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `joining_date` date NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone`, `joining_date`, `department_id`, `profile_photo`, `created_at`, `updated_at`) VALUES
(3, 'Mrs Priya  Mehta', 'priya.mehta@example.com', '9876543211', '2023-02-12', 11, 'profile_photos/3GL0fXImezwjHP5wcaFc1p9NQeVvm7ISBxLBGWYF.jpg', '2025-04-17 14:23:46', '2025-04-17 10:38:51'),
(5, 'Neha Kapoor', 'neha.kapoor@example.com', '9876543213', '2023-04-18', 4, 'profile_photos/BoF1zZGXbqzikllwRnrMz6tWKcxiTySV6xdSVPA9.jpg', '2025-04-17 14:23:46', '2025-04-17 11:10:39'),
(7, 'Sneha Desai', 'sneha.desai@example.com', '9876543215', '2023-06-22', 2, NULL, '2025-04-17 14:23:46', '2025-04-17 14:23:46'),
(8, 'Rohan Patil', 'rohan.patil@example.com', '9876543216', '2023-07-25', 2, NULL, '2025-04-17 14:23:46', '2025-04-17 14:23:46'),
(9, 'Anjali Rao', 'anjali.rao@example.com', '9876543217', '2023-08-27', 3, NULL, '2025-04-17 14:23:46', '2025-04-17 14:23:46'),
(10, 'Karan Malhotra', 'karan.malhotra@example.com', '9876543218', '2023-09-29', 4, NULL, '2025-04-17 14:23:46', '2025-04-17 14:23:46'),
(11, 'Divya Nair', 'divya.nair@example.com', '9876543219', '2023-10-30', 5, NULL, '2025-04-17 14:23:46', '2025-04-17 14:23:46'),
(12, 'Mayank Vishwakarma', 'aryan8319@gmail.com', '9669635212', '2025-04-25', 2, 'profile_photos/DaO0LH8JW52052B5cHUsRGHgTvSgdPAnHw3ylrhV.jpg', '2025-04-17 10:30:04', '2025-04-17 10:30:04'),
(13, 'Ivor Mccarthy', 'huqywuz@mailinator.com', '+1 (137) 927-5018', '1982-04-30', 11, 'profile_photos/ApdrYDcXggZDfMKGXNvCTGbSB3LPrR6a2oR4yY0w.jpg', '2025-04-17 10:34:43', '2025-04-17 10:34:43');

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
(5, '2025_04_17_134024_create_departments_table', 2),
(6, '2025_04_17_134254_create_employees_table', 2);

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
(1, 'Test User', 'test@example.com', NULL, '$2y$12$AwZYvHCrLmjCMuELJIDT4u4LfyWiKBsAeYQ9tYd9UCVT.qi3bKuP6', NULL, '2025-04-17 07:38:55', '2025-04-17 07:38:55'),
(2, 'Mayank Vishwakarma', 'aryan8320@gmail.com', NULL, '$2y$12$6rqsTgNM6Zm9ypiM5mp1ve8ZOISGXgxyzWnv6bGLNZLHa73ErV0J.', NULL, '2025-04-17 12:01:18', '2025-04-17 12:01:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `employees_department_id_foreign` (`department_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
