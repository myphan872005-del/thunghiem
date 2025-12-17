-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 17, 2025 lúc 01:49 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `bds3_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cities`
--

CREATE TABLE `cities` (
  `CityID` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cities`
--

INSERT INTO `cities` (`CityID`, `Name`, `created_at`, `updated_at`) VALUES
(1, 'Đà Nẵng', NULL, NULL),
(2, 'Hà Nội', NULL, NULL),
(3, 'Huế', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_12_13_080239_create_roles_table', 1),
(2, '2025_12_13_080240_create_users_table', 1),
(3, '2025_12_13_081156_create_cities_table', 1),
(4, '2025_12_13_081246_create_wards_table', 1),
(5, '2025_12_13_081315_create_properties_table', 1),
(6, '2025_12_13_133020_create_cache_table', 1),
(7, '2025_12_17_031345_add_level_to_users_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `properties`
--

CREATE TABLE `properties` (
  `PropertyID` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Address` varchar(255) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `CityID` bigint(20) UNSIGNED NOT NULL,
  `WardID` bigint(20) UNSIGNED NOT NULL,
  `ListingType` varchar(50) NOT NULL,
  `Price` bigint(20) NOT NULL,
  `Area` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `properties`
--

INSERT INTO `properties` (`PropertyID`, `user_id`, `Title`, `Description`, `Address`, `Image`, `CityID`, `WardID`, `ListingType`, `Price`, `Area`, `Status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nhà mặt tiền Đà Nẵng view biển', 'Mô tả chi tiết...', '123 Đường ABC', 'default.jpg', 1, 1, 'Sale', 5000000000, 80, 'Approved', '2025-12-16 23:09:46', '2025-12-16 23:09:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `RoleID` bigint(20) UNSIGNED NOT NULL,
  `RoleName` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`RoleID`, `RoleName`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'User', NULL, NULL),
(3, 'Agent', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
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
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('VUuvbyofaEeXUwMVNk90YCS7OD8vCdjiDBvtuBO6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUjhCTVBHWDBGcFQzWWROWG1wR3lUQWw1OTFXMUxDeDM5QU9BRlA4aCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765951815);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL DEFAULT 'Sơ cấp',
  `points` int(11) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `RoleID` bigint(20) UNSIGNED NOT NULL DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `level`, `points`, `email_verified_at`, `password`, `remember_token`, `username`, `phone`, `RoleID`, `created_at`, `updated_at`) VALUES
(1, 'Admin FullName', 'admin@demo.com', 'Sơ cấp', 0, '2025-12-16 23:09:45', '$2y$12$3WTT28Q1YXEKLu5.vuLI6uxgFyAAe.4GoHcYp9agYp5kZsuWNAxxa', '27NHrFP23e', 'admin_user', '0901234567', 1, '2025-12-16 23:09:46', '2025-12-16 23:09:46'),
(2, 'Precious Gleichner', 'aurelia54@example.net', 'Sơ cấp', 0, '2025-12-16 23:09:46', '$2y$12$3WTT28Q1YXEKLu5.vuLI6uxgFyAAe.4GoHcYp9agYp5kZsuWNAxxa', 'vriMGG7kEV', NULL, NULL, 2, '2025-12-16 23:09:46', '2025-12-16 23:09:46'),
(3, 'Dr. Jayson Collier', 'nlegros@example.org', 'Sơ cấp', 0, '2025-12-16 23:09:46', '$2y$12$3WTT28Q1YXEKLu5.vuLI6uxgFyAAe.4GoHcYp9agYp5kZsuWNAxxa', 'CeJ46Qny6c', NULL, NULL, 2, '2025-12-16 23:09:46', '2025-12-16 23:09:46'),
(4, 'Katelin Champlin', 'amos.yundt@example.net', 'Sơ cấp', 0, '2025-12-16 23:09:46', '$2y$12$3WTT28Q1YXEKLu5.vuLI6uxgFyAAe.4GoHcYp9agYp5kZsuWNAxxa', '3QsycLFH06', NULL, NULL, 2, '2025-12-16 23:09:46', '2025-12-16 23:09:46'),
(5, 'Otto Graham', 'lgerhold@example.net', 'Sơ cấp', 0, '2025-12-16 23:09:46', '$2y$12$3WTT28Q1YXEKLu5.vuLI6uxgFyAAe.4GoHcYp9agYp5kZsuWNAxxa', '8QlUjnuHiE', NULL, NULL, 2, '2025-12-16 23:09:46', '2025-12-16 23:09:46'),
(6, 'Courtney Borer II', 'cartwright.chadd@example.com', 'Sơ cấp', 0, '2025-12-16 23:09:46', '$2y$12$3WTT28Q1YXEKLu5.vuLI6uxgFyAAe.4GoHcYp9agYp5kZsuWNAxxa', 'bAzQxWnPzZ', NULL, NULL, 2, '2025-12-16 23:09:46', '2025-12-16 23:09:46'),
(7, 'Prof. Kaitlyn Stoltenberg', 'ufisher@example.com', 'Sơ cấp', 0, '2025-12-16 23:09:46', '$2y$12$3WTT28Q1YXEKLu5.vuLI6uxgFyAAe.4GoHcYp9agYp5kZsuWNAxxa', 'Co6IwddH1F', NULL, NULL, 2, '2025-12-16 23:09:46', '2025-12-16 23:09:46'),
(8, 'Jamaal Greenfelder V', 'abigail.moore@example.org', 'Sơ cấp', 0, '2025-12-16 23:09:46', '$2y$12$3WTT28Q1YXEKLu5.vuLI6uxgFyAAe.4GoHcYp9agYp5kZsuWNAxxa', 'FsJgjCdgAF', NULL, NULL, 2, '2025-12-16 23:09:46', '2025-12-16 23:09:46'),
(9, 'Matilde Wisoky', 'nader.makayla@example.com', 'Sơ cấp', 0, '2025-12-16 23:09:46', '$2y$12$3WTT28Q1YXEKLu5.vuLI6uxgFyAAe.4GoHcYp9agYp5kZsuWNAxxa', 'MjaYr4KV36', NULL, NULL, 2, '2025-12-16 23:09:46', '2025-12-16 23:09:46'),
(10, 'Rosamond Mueller DVM', 'jheller@example.net', 'Sơ cấp', 0, '2025-12-16 23:09:46', '$2y$12$3WTT28Q1YXEKLu5.vuLI6uxgFyAAe.4GoHcYp9agYp5kZsuWNAxxa', 'phBhcozApS', NULL, NULL, 2, '2025-12-16 23:09:46', '2025-12-16 23:09:46'),
(11, 'Dr. Bryana Hayes IV', 'gmaggio@example.org', 'Sơ cấp', 0, '2025-12-16 23:09:46', '$2y$12$3WTT28Q1YXEKLu5.vuLI6uxgFyAAe.4GoHcYp9agYp5kZsuWNAxxa', 'FcYoboW9sb', NULL, NULL, 2, '2025-12-16 23:09:46', '2025-12-16 23:09:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wards`
--

CREATE TABLE `wards` (
  `WardID` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(100) NOT NULL,
  `CityID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `wards`
--

INSERT INTO `wards` (`WardID`, `Name`, `CityID`, `created_at`, `updated_at`) VALUES
(1, 'Phường Hải Châu 1', 1, NULL, NULL),
(2, 'Phường Hải Châu 2', 1, NULL, NULL),
(3, 'Phường Ba Đình 1', 2, NULL, NULL),
(4, 'Phường Ba Đình 2', 2, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`CityID`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`PropertyID`),
  ADD KEY `properties_user_id_foreign` (`user_id`),
  ADD KEY `properties_cityid_foreign` (`CityID`),
  ADD KEY `properties_wardid_foreign` (`WardID`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleID`),
  ADD UNIQUE KEY `roles_rolename_unique` (`RoleName`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_roleid_foreign` (`RoleID`);

--
-- Chỉ mục cho bảng `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`WardID`),
  ADD KEY `wards_cityid_foreign` (`CityID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cities`
--
ALTER TABLE `cities`
  MODIFY `CityID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `properties`
--
ALTER TABLE `properties`
  MODIFY `PropertyID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `wards`
--
ALTER TABLE `wards`
  MODIFY `WardID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_cityid_foreign` FOREIGN KEY (`CityID`) REFERENCES `cities` (`CityID`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_wardid_foreign` FOREIGN KEY (`WardID`) REFERENCES `wards` (`WardID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roleid_foreign` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `wards`
--
ALTER TABLE `wards`
  ADD CONSTRAINT `wards_cityid_foreign` FOREIGN KEY (`CityID`) REFERENCES `cities` (`CityID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
