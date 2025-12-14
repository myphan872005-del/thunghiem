-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 13, 2025 lúc 03:40 PM
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
-- Cơ sở dữ liệu: `dbs_db`
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

--
-- Đang đổ dữ liệu cho bảng `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:2;', 1765635763),
('laravel-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1765635763;', 1765635763);

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
(1, 'Hà Nội', NULL, NULL),
(2, 'Hải Phòng', NULL, NULL),
(3, 'Lào Cai', NULL, NULL),
(4, 'Yên Bái', NULL, NULL),
(5, 'Điện Biên', NULL, NULL),
(6, 'Hòa Bình', NULL, NULL),
(7, 'Lai Châu', NULL, NULL),
(8, 'Sơn La', NULL, NULL),
(9, 'Hà Giang', NULL, NULL),
(10, 'Cao Bằng', NULL, NULL),
(11, 'Bắc Kạn', NULL, NULL),
(12, 'Lạng Sơn', NULL, NULL),
(13, 'Tuyên Quang', NULL, NULL),
(14, 'Thái Nguyên', NULL, NULL),
(15, 'Phú Thọ', NULL, NULL),
(16, 'Bắc Giang', NULL, NULL),
(17, 'Quảng Ninh', NULL, NULL),
(18, 'Bắc Ninh', NULL, NULL),
(19, 'Hà Nam', NULL, NULL),
(20, 'Hải Dương', NULL, NULL),
(21, 'Hưng Yên', NULL, NULL),
(22, 'Nam Định', NULL, NULL),
(23, 'Ninh Bình', NULL, NULL),
(24, 'Thái Bình', NULL, NULL),
(25, 'Vĩnh Phúc', NULL, NULL),
(26, 'Đà Nẵng', NULL, NULL),
(27, 'Thanh Hóa', NULL, NULL),
(28, 'Nghệ An', NULL, NULL),
(29, 'Hà Tĩnh', NULL, NULL),
(30, 'Quảng Bình', NULL, NULL),
(31, 'Quảng Trị', NULL, NULL),
(32, 'Thừa Thiên Huế', NULL, NULL),
(33, 'Quảng Nam', NULL, NULL),
(34, 'Quảng Ngãi', NULL, NULL),
(35, 'Bình Định', NULL, NULL),
(36, 'Phú Yên', NULL, NULL),
(37, 'Khánh Hòa', NULL, NULL),
(38, 'Ninh Thuận', NULL, NULL),
(39, 'Bình Thuận', NULL, NULL),
(40, 'Kon Tum', NULL, NULL),
(41, 'Gia Lai', NULL, NULL),
(42, 'Đắk Lắk', NULL, NULL),
(43, 'Đắk Nông', NULL, NULL),
(44, 'Lâm Đồng', NULL, NULL),
(45, 'Bình Phước', NULL, NULL),
(46, 'Bình Dương', NULL, NULL),
(47, 'TP. Hồ Chí Minh', NULL, NULL),
(48, 'Cần Thơ', NULL, NULL),
(49, 'Bà Rịa - Vũng Tàu', NULL, NULL),
(50, 'Đồng Nai', NULL, NULL),
(51, 'Tây Ninh', NULL, NULL),
(52, 'Long An', NULL, NULL),
(53, 'Đồng Tháp', NULL, NULL),
(54, 'An Giang', NULL, NULL),
(55, 'Tiền Giang', NULL, NULL),
(56, 'Bến Tre', NULL, NULL),
(57, 'Vĩnh Long', NULL, NULL),
(58, 'Trà Vinh', NULL, NULL),
(59, 'Sóc Trăng', NULL, NULL),
(60, 'Bạc Liêu', NULL, NULL),
(61, 'Cà Mau', NULL, NULL),
(62, 'Kiên Giang', NULL, NULL),
(63, 'Hậu Giang', NULL, NULL);

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
(6, '2025_12_13_133020_create_cache_table', 2);

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
(1, 'ADMIN', NULL, NULL),
(2, 'USER', NULL, NULL);

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
('iRVbI2VU7HhnDMa0pgLatYpX5p4mlkzfyiLqjyGv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSDAwNFloNUE4TXNHeXFaNW15RDEwUXh5SFVuWkwyMG5LYjUzaE9HWCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1765636713);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `RoleID` bigint(20) UNSIGNED NOT NULL DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `RoleID`, `created_at`, `updated_at`) VALUES
(1, 'Đạt', 'umizuka', 'umizuka4@gmail.com', '0934928704', NULL, '11111111', NULL, 1, NULL, NULL),
(2, 'a', 'dat', 'a@gmail.com', '123456789', NULL, '$2y$12$cGbhqxCzEFCSDqG5wft8iOZ0xdqObI1z8zLBlNRBS7obLvJNfvRRe', NULL, 2, '2025-12-13 06:26:37', '2025-12-13 06:26:37');

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
(1, 'Hải Châu', 26, NULL, NULL),
(2, 'Liên Chiểu', 26, NULL, NULL),
(3, 'Ngũ Hành Sơn', 26, NULL, NULL);

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
  MODIFY `CityID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `properties`
--
ALTER TABLE `properties`
  MODIFY `PropertyID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `wards`
--
ALTER TABLE `wards`
  MODIFY `WardID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
