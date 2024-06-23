-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th6 14, 2024 lúc 03:49 AM
-- Phiên bản máy phục vụ: 8.3.0
-- Phiên bản PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `organiclaravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `position` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`id`, `name`, `status`, `created_at`, `updated_at`, `position`) VALUES
(3, 'Banner trang chủ', 1, '2024-06-05 04:38:34', '2024-06-05 14:46:40', 1),
(4, 'banner item', 1, '2024-06-05 06:32:57', '2024-06-05 14:46:28', 3),
(5, 'banner dài', 1, '2024-06-05 06:36:27', '2024-06-05 14:46:18', 2),
(6, 'footer', 1, '2024-06-05 06:52:18', '2024-06-05 14:36:15', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banner_images`
--

CREATE TABLE `banner_images` (
  `id` bigint UNSIGNED NOT NULL,
  `banner_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `banner_images`
--

INSERT INTO `banner_images` (`id`, `banner_id`, `title`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(5, 3, 'banner home', 'banner1.png', 1, '2024-06-05 04:38:34', '2024-06-05 04:38:34'),
(6, 3, 'banner home', 'banner2.png', 2, '2024-06-05 04:38:34', '2024-06-05 04:38:34'),
(7, 3, 'banner home', 'banner3.png', 3, '2024-06-05 04:38:34', '2024-06-05 04:38:34'),
(8, 4, 'df', 'bannerItem1.png', 1, '2024-06-05 06:32:57', '2024-06-05 06:32:57'),
(9, 4, 'df', 'bannerItem2.png', 1, '2024-06-05 06:32:57', '2024-06-05 06:32:57'),
(10, 5, 'banner', 'banner.png', 1, '2024-06-05 06:36:27', '2024-06-05 16:12:35'),
(11, 6, 'f', 'LoGo.png', 1, '2024-06-05 06:52:19', '2024-06-05 06:52:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`, `sort_order`, `status`, `slug`) VALUES
(1, 'Cua biển', 'cua.png', NULL, '2024-05-22 08:47:11', 4, 1, 'cua-bien'),
(2, 'Mực biển', 'muc.png', NULL, '2024-05-22 08:47:05', 3, 1, 'muc-bien'),
(3, 'Tôm biển', 'tom.png', NULL, '2024-05-22 08:47:00', 2, 1, 'tom-bien'),
(4, 'Cá biển', 'ca.png', NULL, '2024-05-22 08:46:54', 1, 1, 'ca-bien'),
(9, 'Ốc biển', 'oc.png', NULL, '2024-05-22 08:47:16', 5, 1, 'oc-bien');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rating` int NOT NULL DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `user_id`, `content`, `status`, `created_at`, `updated_at`, `rating`) VALUES
(1, 32, 1, 'u', 0, '2024-05-09 11:44:26', '2024-05-09 11:44:26', 5),
(2, 32, 1, 'thdthdt', 0, '2024-05-09 11:44:57', '2024-05-09 11:44:57', 5),
(3, 32, 1, 'hk', 0, '2024-05-09 11:45:28', '2024-05-09 11:45:28', 5),
(4, 32, 1, 'kkkk', 0, '2024-05-09 11:48:31', '2024-05-09 11:48:31', 5),
(5, 46, 1, 'now', 0, '2024-05-10 00:22:15', '2024-05-10 00:22:15', 5),
(6, 52, 1, 'Tôm ngọt quá', 1, '2024-05-10 10:17:34', '2024-05-10 10:17:34', 1),
(7, 52, 1, 'Tôm ngol', 1, '2024-05-10 10:24:43', '2024-05-10 10:24:43', 4),
(8, 37, 1, 'Cua', 1, '2024-05-30 09:08:53', '2024-05-30 09:08:53', 5),
(9, 37, 1, 'cua', 0, '2024-05-30 09:10:12', '2024-05-30 09:10:12', 5),
(10, 46, 1, 'jjghk', 0, '2024-05-30 09:10:35', '2024-05-30 09:10:35', 5),
(11, 37, 1, 'Cua mắc quá dậy!', 1, '2024-06-01 11:05:56', '2024-06-01 11:05:56', 4),
(12, 50, 1, 'Tôm ngon ngọt', 1, '2024-06-01 15:01:27', '2024-06-01 15:01:27', 4),
(13, 50, 1, 'Tôm ngon ngọt', 1, '2024-06-01 15:02:04', '2024-06-01 15:02:04', 4),
(14, 50, 1, 'Tôm ngon ngọt', 1, '2024-06-01 15:02:37', '2024-06-01 15:02:37', 4),
(15, 50, 1, 'Tôm mắc quá', 1, '2024-06-01 15:06:44', '2024-06-01 15:06:44', 5),
(16, 50, 1, 'dd', 1, '2024-06-01 15:09:21', '2024-06-01 15:09:21', 4),
(17, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:27', '2024-06-01 15:11:27', 1),
(18, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:31', '2024-06-01 15:11:31', 1),
(19, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:32', '2024-06-01 15:11:32', 1),
(20, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:33', '2024-06-01 15:11:33', 1),
(21, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:33', '2024-06-01 15:11:33', 1),
(22, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:33', '2024-06-01 15:11:33', 1),
(23, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:33', '2024-06-01 15:11:33', 1),
(24, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:34', '2024-06-01 15:11:34', 1),
(25, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:34', '2024-06-01 15:11:34', 1),
(26, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:34', '2024-06-01 15:11:34', 1),
(27, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:35', '2024-06-01 15:11:35', 1),
(28, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:36', '2024-06-01 15:11:36', 1),
(29, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:36', '2024-06-01 15:11:36', 1),
(30, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:37', '2024-06-01 15:11:37', 1),
(31, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:37', '2024-06-01 15:11:37', 1),
(32, 50, 1, 'jfhskdjgsfg,', 1, '2024-06-01 15:11:37', '2024-06-01 15:11:37', 1),
(33, 51, 1, 'dvzv', 1, '2024-06-01 15:33:00', '2024-06-01 15:33:00', 5),
(34, 46, 1, '02/06', 1, '2024-06-02 03:36:41', '2024-06-02 03:36:41', 5),
(35, 46, 1, 'wwwwwwwwwwwwwwwwww', 1, '2024-06-02 03:38:55', '2024-06-02 03:38:55', 5),
(36, 46, 1, '123', 1, '2024-06-02 04:05:49', '2024-06-02 04:05:49', 3),
(37, 46, 1, 'ryety', 1, '2024-06-03 01:04:27', '2024-06-03 01:04:27', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `name_coupon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` int NOT NULL,
  `type` tinyint NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount` decimal(10,2) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupons`
--

INSERT INTO `coupons` (`id`, `name_coupon`, `code`, `type`, `total`, `date_start`, `date_end`, `created_at`, `updated_at`, `discount`, `status`) VALUES
(2, 'seafood', 1111, 1, 500000.00, NULL, NULL, NULL, NULL, 50000.00, 0),
(3, 'haisan', 2222, 0, 500000.00, NULL, NULL, NULL, '2024-05-22 23:12:01', 5.00, 0),
(4, 'huynhkha', 789987, 1, 500000.00, NULL, NULL, '2024-05-22 23:22:53', '2024-05-22 23:22:53', 90000.00, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2024_05_07_034925_create_users_table', 1),
(4, '2024_05_07_035123_create_sessions_table', 1),
(5, '2024_05_07_040718_create_categories_table', 1),
(6, '2024_05_07_044501_create_products_table', 1),
(7, '2024_05_09_180529_create_comments_table', 2),
(8, '2024_05_09_191911_create_product_image_table', 3),
(9, '2024_05_09_193607_create_product_images_table', 4),
(10, '2024_05_09_194214_create_product_images_table', 5),
(11, '2024_05_10_190553_create_order_statuses_table', 6),
(13, '2024_05_10_191517_create_order_products_table', 7),
(14, '2024_05_14_040409_create_coupons_table', 8),
(15, '2024_05_14_042556_create_order_statuses_table', 8),
(16, '2024_05_14_060103_create_orders_table', 9),
(17, '2024_05_19_225613_create_posts_table', 10),
(18, '2024_05_28_153535_add_verification_code_to_users_table', 11),
(19, '2024_05_29_053233_create_personal_access_tokens_table', 12),
(20, '2024_05_29_122552_add_note_to_orders_table', 13),
(21, '2024_06_05_101716_create_banners_table', 14),
(22, '2024_06_05_102420_create_banner_images_table', 15),
(24, '2024_06_06_180516_create_product_discounts_table', 17),
(25, '2024_06_06_180034_create_user_groups_table', 18);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int NOT NULL,
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ward` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double NOT NULL,
  `payment` tinyint DEFAULT NULL,
  `status_id` bigint UNSIGNED NOT NULL,
  `coupon_code` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `province`, `district`, `ward`, `total`, `payment`, `status_id`, `coupon_code`, `created_at`, `updated_at`, `note`, `order_code`) VALUES
(23, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 2799000, NULL, 4, NULL, '2024-05-21 18:40:55', '2024-05-27 03:52:20', NULL, ''),
(24, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 3563000, NULL, 2, NULL, '2024-05-21 18:41:32', '2024-05-21 18:41:32', NULL, ''),
(25, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 29500000, NULL, 1, NULL, '2024-05-21 19:02:05', '2024-05-21 19:02:05', NULL, ''),
(26, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 86025000, NULL, 1, NULL, '2024-05-21 19:28:58', '2024-05-21 19:28:58', NULL, ''),
(27, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 295000, NULL, 1, NULL, '2024-05-21 19:30:53', '2024-05-21 19:30:53', NULL, ''),
(28, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 1140000, NULL, 1, 1111, '2024-05-22 23:43:28', '2024-05-22 23:43:28', NULL, ''),
(29, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 550000, NULL, 1, 1111, '2024-05-24 08:47:24', '2024-05-24 08:47:24', NULL, ''),
(30, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 595000, NULL, 1, NULL, '2024-05-24 08:56:18', '2024-05-24 08:56:18', NULL, ''),
(31, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 90000, NULL, 1, NULL, '2024-05-24 08:56:57', '2024-05-24 08:56:57', NULL, ''),
(32, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 590000, NULL, 1, NULL, '2024-05-24 08:57:37', '2024-05-24 08:57:37', NULL, ''),
(33, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 2160000, NULL, 1, NULL, '2024-05-24 08:58:14', '2024-05-25 13:17:28', NULL, ''),
(34, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 390000, NULL, 1, NULL, '2024-05-25 02:05:48', '2024-05-25 02:05:48', NULL, ''),
(35, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 390000, NULL, 1, NULL, '2024-05-25 02:09:54', '2024-05-25 02:09:54', NULL, ''),
(36, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 8190000, NULL, 1, NULL, '2024-05-25 02:14:37', '2024-05-25 11:08:27', NULL, ''),
(37, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 12480000, NULL, 1, NULL, '2024-05-25 02:19:19', '2024-05-25 11:15:31', NULL, ''),
(38, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 6440000, NULL, 1, NULL, '2024-05-25 11:35:40', '2024-05-25 12:21:59', NULL, ''),
(39, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 4140000, NULL, 1, NULL, '2024-05-25 11:40:01', '2024-05-25 11:40:01', NULL, ''),
(40, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 509000, NULL, 1, NULL, '2024-05-27 03:06:44', '2024-05-27 03:06:44', NULL, ''),
(41, NULL, 'david', 'david@gmail.com', 353553991, '01', '017', '00508', 390000, NULL, 1, NULL, '2024-05-29 05:37:17', '2024-05-29 05:37:17', 'Gói hàng cẩn thận', ''),
(42, NULL, 'propro', 'solakearlene2004@outlook.com', 353353991, 'Tỉnh Điện Biên', 'Thành phố Điện Biên Phủ', 'Phường Noong Bua', 509000, NULL, 1, NULL, '2024-05-29 05:51:30', '2024-05-29 05:51:30', NULL, ''),
(43, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, '', '', '', 2290000, NULL, 1, NULL, '2024-05-29 05:52:20', '2024-05-29 05:52:20', NULL, ''),
(44, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, '', '', '', 595000, NULL, 1, NULL, '2024-05-30 06:42:38', '2024-05-30 06:42:38', NULL, 'SEAFOOD-934716'),
(45, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, '', '', '', 2290000, NULL, 1, NULL, '2024-05-30 06:43:27', '2024-05-30 06:43:27', NULL, 'SEAFOOD-906527'),
(46, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 2290000, NULL, 1, NULL, '2024-05-30 07:18:21', '2024-05-30 07:18:21', NULL, 'SEAFOOD-292321'),
(47, NULL, 'khakha1', 'khakha501111187@gmail.com', 353113991, 'Tỉnh Vĩnh Phúc', 'Thành phố Phúc Yên', 'Phường Hùng Vương', 2290000, 1, 1, NULL, '2024-06-01 00:00:27', '2024-06-01 00:00:27', '11111111111111fhdghdghdg', 'SEAFOOD-175111'),
(48, NULL, 'khakha1', 'khakha501111187@gmail.com', 353113991, 'Tỉnh Hà Giang', 'Huyện Đồng Văn', 'Xã Má Lé', 2290000, NULL, 1, NULL, '2024-06-01 00:07:16', '2024-06-01 00:07:16', '11111111111111fhdghdghdg', 'SEAFOOD-34187'),
(49, NULL, 'khakha1', 'khakha501111187@gmail.com', 353113991, 'Tỉnh Phú Thọ', 'Huyện Hạ Hoà', 'Xã Yên Luật', 2290000, 1, 1, NULL, '2024-06-01 00:13:06', '2024-06-01 00:13:06', '11111111111111fhdghdghdg', 'SEAFOOD-991846'),
(50, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 509000, NULL, 1, NULL, '2024-06-01 01:35:35', '2024-06-01 01:35:35', NULL, 'SEAFOOD-168677'),
(51, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 100000, NULL, 1, NULL, '2024-06-01 01:44:19', '2024-06-01 01:44:19', NULL, 'SEAFOOD-267982'),
(52, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 176000, NULL, 1, NULL, '2024-06-01 01:48:13', '2024-06-01 01:48:13', NULL, 'SEAFOOD-383596'),
(53, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 100000, NULL, 1, NULL, '2024-06-01 01:51:49', '2024-06-01 01:51:49', NULL, 'SEAFOOD-350884'),
(54, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 925000, 4, 1, NULL, '2024-06-01 01:57:02', '2024-06-05 13:53:25', NULL, 'SEAFOOD-701908'),
(55, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 1018000, 3, 1, NULL, '2024-06-01 01:57:21', '2024-06-01 01:57:21', NULL, 'SEAFOOD-442216'),
(56, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 509000, 2, 1, NULL, '2024-06-05 00:46:41', '2024-06-05 00:46:41', NULL, 'SEAFOOD-573086'),
(57, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 115000, NULL, 1, NULL, '2024-06-06 10:39:08', '2024-06-06 10:39:08', NULL, 'SEAFOOD-767471'),
(58, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 115000, NULL, 1, NULL, '2024-06-06 10:39:40', '2024-06-06 10:39:40', NULL, 'SEAFOOD-723616');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `name`, `price`, `total`, `created_at`, `updated_at`, `quantity`) VALUES
(28, 23, 46, 'Tôm Hùm Alaska Nhỏ', 509000.00, 509000.00, '2024-05-21 18:40:55', '2024-05-27 03:52:20', 1),
(29, 23, 37, 'Cua King Crab Cái', 2290000.00, 2290000.00, '2024-05-21 18:40:55', '2024-05-27 03:52:20', 1),
(30, 24, 46, 'Tôm Hùm Alaska Nhỏ', 509000.00, 3563000.00, '2024-05-21 18:41:32', '2024-05-21 18:41:32', 7),
(31, 25, 36, 'Ghẹ xanh', 295000.00, 29500000.00, '2024-05-21 19:02:05', '2024-05-21 19:02:05', 100),
(32, 26, 49, 'Tôm Hùm Bông', 925000.00, 86025000.00, '2024-05-21 19:28:58', '2024-05-21 19:28:58', 93),
(33, 27, 36, 'Ghẹ xanh', 295000.00, 295000.00, '2024-05-21 19:30:53', '2024-05-21 19:30:53', 1),
(34, 28, 32, 'Cá hồi nguyên con', 595000.00, 1190000.00, '2024-05-22 23:43:28', '2024-05-22 23:43:28', 2),
(35, 29, 34, 'Cua Cà Mau', 200000.00, 600000.00, '2024-05-24 08:47:24', '2024-05-25 01:57:28', 4),
(36, 30, 32, 'Cá hồi nguyên con', 595000.00, 595000.00, '2024-05-24 08:56:18', '2024-05-24 08:56:18', 1),
(37, 31, 29, 'Cá bông', 90000.00, 90000.00, '2024-05-24 08:56:57', '2024-05-24 08:56:57', 1),
(38, 32, 34, 'Cua Cà Mau', 200000.00, 1600000.00, '2024-05-24 08:57:37', '2024-05-25 08:20:52', 8),
(39, 32, 47, 'Tôm Mũ Ni', 390000.00, 390000.00, '2024-05-24 08:57:37', '2024-05-25 08:20:52', 1),
(40, 33, 47, 'Tôm Mũ Ni', 390000.00, 1560000.00, '2024-05-24 08:58:14', '2024-05-25 13:17:28', 4),
(41, 33, 34, 'Cua Cà Mau', 200000.00, 600000.00, '2024-05-24 08:58:14', '2024-05-25 13:17:28', 3),
(42, 34, 47, 'Tôm Mũ Ni', 390000.00, 1560.00, '2024-05-25 02:05:48', '2024-05-25 02:09:28', 4),
(43, 35, 47, 'Tôm Mũ Ni', 390000.00, 1170.00, '2024-05-25 02:09:54', '2024-05-25 02:13:55', 3),
(44, 36, 47, 'Tôm Mũ Ni', 390000.00, 8190.00, '2024-05-25 02:14:37', '2024-05-25 11:08:27', 21),
(45, 37, 47, 'Tôm Mũ Ni', 390000.00, 12480.00, '2024-05-25 02:19:19', '2024-05-25 11:15:31', 32),
(46, 38, 27, 'Mực lá câu', 176000.00, 1760.00, '2024-05-25 11:35:40', '2024-05-25 12:21:59', 10),
(47, 38, 47, 'Tôm Mũ Ni', 390000.00, 4680.00, '2024-05-25 11:35:40', '2024-05-25 12:21:59', 12),
(48, 39, 50, 'Tôm Hùm Uc', 1850000.00, 1850000.00, '2024-05-25 11:40:01', '2024-05-25 11:40:01', 1),
(49, 39, 37, 'Cua King Crab Cái', 2290000.00, 2290000.00, '2024-05-25 11:40:01', '2024-05-25 11:40:01', 1),
(50, 40, 46, 'Tôm Hùm Alaska Nhỏ', 509000.00, 509000.00, '2024-05-27 03:06:44', '2024-05-27 03:06:44', 1),
(51, 41, 37, 'Cua King Crab Cái', 2290000.00, 2290000.00, '2024-05-29 05:37:17', '2024-05-29 05:37:17', 1),
(52, 42, 37, 'Cua King Crab Cái', 2290000.00, 2290000.00, '2024-05-29 05:51:30', '2024-05-29 05:51:30', 1),
(53, 43, 37, 'Cua King Crab Cái', 2290000.00, 2290000.00, '2024-05-29 05:52:20', '2024-05-29 05:52:20', 1),
(54, 52, 27, 'Mực lá câu', 176000.00, 176000.00, '2024-06-01 01:48:13', '2024-06-01 01:48:13', 1),
(55, 54, 49, 'Tôm Hùm Bông', 925000.00, 925000.00, '2024-06-01 01:57:02', '2024-06-05 13:53:25', 1),
(56, 55, 46, 'Tôm Hùm Alaska Nhỏ', 509000.00, 1018000.00, '2024-06-01 01:57:21', '2024-06-01 01:57:21', 2),
(57, 56, 46, 'Tôm Hùm Alaska Nhỏ', 509000.00, 509000.00, '2024-06-05 00:46:41', '2024-06-05 00:46:41', 1),
(58, 57, 24, 'Bạch tuột', 115000.00, 115000.00, '2024-06-06 10:39:08', '2024-06-06 10:39:08', 1),
(59, 58, 24, 'Bạch tuột', 115000.00, 115000.00, '2024-06-06 10:39:40', '2024-06-06 10:39:40', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Đơn hàng mới', NULL, NULL),
(2, 'Đang xử lý', NULL, NULL),
(3, 'Đã giao hàng', NULL, NULL),
(4, 'Hoàn thành', NULL, NULL),
(5, 'Hủy đơn hàng', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `category_id` bigint UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `hot` tinyint DEFAULT '0',
  `view` int DEFAULT NULL,
  `outstanding` tinyint DEFAULT '0',
  `status` tinyint DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `quantity`, `category_id`, `price`, `discount_price`, `hot`, `view`, `outstanding`, `status`, `created_at`, `updated_at`, `slug`, `description`) VALUES
(24, 'Bạch tuột', 'bachtuot.jpg', 18, 2, 139000.00, 115000.00, 0, 115, 1, 1, NULL, '2024-06-08 21:58:04', 'bach-tuot', ''),
(25, 'Mực khô', 'muckho.jpg', 1, 2, 195000.00, NULL, 0, 2, 0, 1, NULL, '2024-05-10 12:05:08', 'muc-kho', ''),
(26, 'Mực lá 1 nắng', 'mucla1nang.jpg', 1, 2, 369000.00, NULL, 0, 753, 0, 1, NULL, NULL, 'muc-la-mot-nang', ''),
(27, 'Mực lá câu', 'muclacau.jpg', 1, 2, 176000.00, NULL, 0, 25, 1, 1, NULL, '2024-05-30 08:23:14', 'muc-la-cau', ''),
(28, 'Mực ống 1 nắng', 'mucong1nang.jpg', 1, 2, 215000.00, NULL, 0, NULL, 0, 1, NULL, NULL, 'muc-ong-mot-nang', ''),
(29, 'Cá bông', 'cabong.jpg', 25, 4, 100000.00, 90000.00, 0, 16, 1, 1, NULL, '2024-06-08 21:04:53', 'ca-bong', 'Cá ngừ bông (Eastern little tuna) còn được gọi là cá ngừ chấm, sống chủ yếu ở vùng nước ấm thuộc Thái Bình Dương, Ấn Độ Dương, Việt Nam, Trung Quốc, Nhật Bản,... Tại nước ta, cá ngừ bông sinh sống nhiều ở vùng biển miền Trung và Nam Bộ. Thân cá hình thoi, kích thước trung bình, đặc biệt phần đầu hơi nhọn.'),
(30, 'Cá trù', 'catru.png', 1, 4, 80000.00, NULL, 0, 216, 0, 1, NULL, '2024-05-17 10:12:44', 'ca-tru', ''),
(31, 'Cá như gan', 'canhugan.jpg', 1, 4, 80000.00, NULL, 0, NULL, 0, 1, NULL, NULL, 'ca-nhu-gan', ''),
(32, 'Cá hồi nguyên con', 'cahoinguyencon.jpg', 1, 4, 595000.00, NULL, 0, 56, 1, 1, NULL, '2024-05-30 08:44:52', 'ca-hoi-nguyen-con', 'Cá hồi là tên chung cho nhiều loài cá thuộc họ Salmonidae. Nhiều loại cá khác cùng họ được gọi là trout; sự khác biệt thường được cho là cá hồi salmon di cư còn cá hồi trout không di cư, nhưng sự phân biệt này không hoàn toàn chính xác.'),
(33, 'Cá hồi phi lê', 'cahoiphile.jpg', 1, 4, 1700000.00, NULL, 0, 1, 0, 1, NULL, '2024-05-11 23:40:49', 'ca-hoi-phi-le', ''),
(34, 'Cua Cà Mau', 'cuacamau.jpg', 10, 1, 215000.00, 200000.00, NULL, 634, 1, 1, NULL, '2024-06-03 00:16:06', 'cua-ca-mau', ''),
(35, 'Cua Nâu Sống', 'cuanausong.jpg', 1, 1, 552000.00, NULL, 0, 9, 0, 1, NULL, '2024-05-28 12:08:40', 'cua-nau-song', ''),
(36, 'Ghẹ xanh', 'ghexanh.jpg', 1, 1, 295000.00, NULL, 0, 8, 0, 1, NULL, '2024-05-30 08:47:55', 'ghe-xanh', ''),
(37, 'Cua King Crab Cái', 'kinggrab.jpg', 1, 1, 2290000.00, NULL, 0, 135, 1, 1, NULL, '2024-06-03 01:36:42', 'king-crab', 'Cua hoàng đế hay còn được biết đến với tên gọi tiếng Anh là King crab là một họ cua biển. Đây là một họ cua có nhiều loài có giá trị kinh tế trong đó có loài cua Alaska hay còn gọi là cua hoàng đế Alaska là loài cua đắt tiền với chất lượng thịt thượng hạng, được ưa chuộng trong các nhà hàng, quán ăn với giá cả đắt đỏ.'),
(46, 'Tôm Hùm Alaska Nhỏ', 'tomalaska.jpg', 1, 3, 509000.00, NULL, 0, 147, 1, 1, NULL, '2024-06-13 01:51:21', 'tom-hum-alaska-nho', 'Tôm Hùm Alaska sinh s.ống tại vùng biển sâu của Alaska phía bắc nước Mỹ và Canada. Thịt tôm vô cùng ngọt, giòn dai từng khối.'),
(47, 'Tôm Mũ Ni', 'tomauni.jpg', 1, 3, 390000.00, NULL, 0, 38, 1, 1, NULL, '2024-06-08 21:05:13', 'tom-mau-ni', '<pre>\r\n<span style=\"font-family:Arial,Helvetica,sans-serif\"><strong>T&ocirc;m mũ ni</strong> l&agrave; t&ocirc;m thuộc họ Động vật gi&aacute;p x&aacute;c mười ch&acirc;n, c&oacute; lớp mai d&agrave;y, thịt trắng, dai, vị ngọt v&agrave; hương thơm nhẹ đặc trưng.\r\n\r\n</span></pre>'),
(48, 'Tôm Càng Xanh', 'tomcangxanh.jpg', 1, 3, 130000.00, NULL, 0, 4, 0, 1, NULL, '2024-05-21 10:07:55', 'tom-cang-xanh', ''),
(49, 'Tôm Hùm Bông', 'tomhumbong.jpg', 5, 3, 925000.00, 900000.00, 0, 92, 1, 1, NULL, '2024-06-08 21:02:31', 'tom-hum-bong', ''),
(50, 'Tôm Hùm Uc', 'tomhumuc.jpg', 1, 3, 1850000.00, NULL, 0, 9, 0, 1, NULL, '2024-06-01 15:15:57', 'tom-hum-uc', 'T'),
(51, 'Tôm Sú Sống', 'tomsusong.jpg', 1, 3, 210000.00, NULL, 0, 21, 0, 1, NULL, '2024-06-08 21:32:20', 'tom-su-song', ''),
(52, 'Tôm Tít', 'tomtit.jpg', 1, 3, 175000.00, NULL, 0, 104, 0, 1, NULL, '2024-06-03 00:54:13', 'tom-tit', 'Thịt Tôm Tích là sản phẩm từ Tôm tít ( tôm tích, bề bề ) tươi sống, sau đó được chúng tôi làm sạch, sơ chế và hấp chín để lưu giữ phần thịt được lâu hơn. Thịt tôm tít được đóng hộp kín bảo quản lạnh đảm bảo thịt chắc ngọt và vẫn giữ được thành phần dinh dưỡng từ tôm tích.'),
(53, 'Tôm Hùm Xanh', 'tomhumxanh.jpg', 1, 3, 542000.00, NULL, 0, 406, 0, 1, NULL, '2024-05-30 08:23:33', 'tom-hum-xanh', '<p>Như ch&uacute;ng ta đ&atilde; biết, t&ocirc;m h&ugrave;m xanh l&agrave; hải sản cao cấp, c&oacute; gi&aacute; trị dinh dưỡng rất cao v&agrave; thuộc h&agrave;ng ngon nhất trong họ nh&agrave; t&ocirc;m. <strong>T&ocirc;m h&ugrave;m</strong> c&agrave;ng xanh c&oacute; đặc điểm nổi trội l&agrave; th&acirc;n d&agrave;i, phần đu&ocirc;i to v&agrave; chắc chắn, k&iacute;ch thước con trưởng th&agrave;nh &asymp; 20 &ndash; 30 (cm).</p>'),
(58, 'Cá Chim', 'ca-chim.jpg', 10, 4, 279000.00, NULL, 1, NULL, 0, 1, NULL, NULL, 'ca-chim\r\n\r\n', 'CÁ CHIM TƯƠI SỐNG VÙNG BIỂN VIỆT NAM \r\nCá chim trắng được xem là một trong những loại đặc sản biển xếp vào hạng ngon nhất trong \"làng cá Việt\" vì khiến người mê đắm với phần thịt trắng muốt, thớ to bản, đẹp mắt, thịt cá ngọt và đậm thơm, lại nhiều cung cấp nhiều dưỡng chất thiết yếu cho cơ thể người dùng. \r\nCá chim trên thị trường khá đa dạng, với các sự lựa chọn khác nhau: Từ cá chim đen, cá chim sông đến cá chim trắng biển. Cá chim trắng tại Hoàng Gia là cá chim trắng được nuôi trong môi trường biển tự nhiên với kích thước ổn định và luôn ở tình trạng tươi sống luôn sẵn có tại Hải Sản Hoàng Gia. Những con cá chim bơi khỏe trong hồ size từ 800gr - 1,5kg sẽ luôn mang đến trải nghiệm tốt nhất khi có tỉ lệ thịt đầy hoàn hảo.\r\n\r\nCHẤT LƯỢNG TỪ HƯƠNG VỊ ĐẾN GIÁ TRỊ DINH DƯỠNG\r\nThịt cá chim săn chắc, thớ to, ngọt thơm, có chút giòn dai, thịt béo nhưng ngọt và thơm. Trong cá có chứa: \r\n\r\nMột hàm lượng axit béo Omega-3 lớn rất cần thiết cho con người để cung cấp dinh dưỡng cho cơ thể. \r\nHàm lượng chất béo cao cung cấp Canxi, vitamin A và D và vitamin B12. \r\nCá chim chứa hàm lượng I-ot tốt, rất quan trọng cho tuyến giáp. Do đó loại cá này tốt cho thị lực, tóc và giúp da khỏe mạnh.\r\n \r\n\r\nCHẾ BIẾN CÁ CHIM CÙNG BẾP HOÀNG GIA\r\n\r\nCá chim nướng muối ớt: Cá chim sau khi mua về rửa sạch, sơ chế sạch: mổ bụng bỏ phần ruột cá và cắt bỏ phần vây, đuôi cá. Khứa cá theo chiều xéo và ngược lại tạo thành hình caro để khi nướng cá mau chín, thấm phần nước sốt và giúp món ăn hấp dẫn hơn. Sốt nướng cá: gồm 10gr hành tím băm, 10gr tỏi băm, 15gr sả băm, 15gr ớt xay, 30gr dầu điều, 2gr muối, 6gr hạt nêm, 3gr đường, 3gr bột ngọt, 10ml nước mắm, 20gr tương ớt, 30ml nước. Bắc chảo lên bếp, đến khi chảo nóng cho hỗn hợp hành & tỏi băm vào phi thơm, sau đó hạ nhỏ lửa và cho hỗn hợp gia vị đã chuẩn bị sẵn vào nấu đến sôi rồi tắt bếp và cho ra tô. Xếp đều cá lên khay, ướp cá đã pha đều lên 2 bề mặt cá và để khoảng 15 phút cho cá thấm gia vị. Chuẩn bị bếp than, phết một lớp dầu ăn lên vỉ nướng để tránh phần da cá bị dính lên vỉ. Cho cá lên vỉ, nướng mỗi bên 10 phút là hoàn thành. Giờ thì bày cá ra đĩa rồi thưởng thức thôi.'),
(59, 'Cá Bơn Sao', 'ca-bon-sao.jpg', 0, 4, 1099000.00, NULL, 0, 10, 0, 1, NULL, '2024-06-06 09:38:38', 'ca-bon-sao', 'CÁ BƠN SAO HÀN QUỐC NHẬP KHẨU TRỰC TIẾP, ĐẢM BẢO TƯƠI SỐNG\r\nCá bơn sao sống ở vùng biển lạnh, chủ yếu được đánh bắt tại Hàn Quốc, một vùng biển nổi tiếng với điều kiện tự nhiên thuận lợi cho sự phát triển của nhiều loài hải sản tươi ngon.\r\n\r\nĐể mang được những con cá bơn sao chất lượng nhất vào bờ, những người ngư dân phải thực hiện quy trình bảo quản nghiêm ngặt ngay sau khi bắt được chúng. Họ cần hạn chế tối đa việc chạm tay vào cá và phải để chúng được \"nghỉ ngơi\" trong nước lạnh từ 1-2 ngày. Điều này sẽ giúp cá giảm bớt căng thẳng sau quá trình đánh bắt và đảm bảo thịt cá giữ được vị ngon tự nhiên.\r\n\r\nNhờ vào quá trình kiểm định chất lượng nghiêm ngặt cùng các phương pháp bảo quản hiệu quả, cá bơn sao không chỉ là món ngon nhất định phải thử khi đến Hàn Quốc mà còn trở thành một trong những sản phẩm xuất khẩu chủ lực của quốc gia này, được ưa chuộng ở các thị trường lớn như Mỹ, Canada, Trung Quốc,...'),
(60, 'Cá Bơn Vàng', 'ca-bon-vang.jpg', 0, 4, 1790000.00, NULL, 0, 1, 0, 1, NULL, '2024-05-28 12:14:28', 'ca-bon-vang', 'CÁ BƠN VÀNG NHẬP KHẨU TƯƠI SỐNG, CHẤT LƯỢNG NHẤT\r\n\r\nVới cấu tạo đặc biệt, nó được xem là loài cá kỳ lạ nhất thế giới với phần thân mỏng dẹt, hút mắt bởi lớp vỏ vàng óng bắt mắt, thân bẹt hình trái xoan với cặp mắt tạo trên cùng. Đúng phong cách của những loài cá ngon bậc nhất ấn tượng. \r\n\r\nCá bơn vàng sinh sống chủ yếu ở vùng biển Hàn Quốc và Nhật Bản. Nó gắn bó lâu đời với ngư dân vùng biển cùng hình thức đánh bắt độc đáo. Những ngư dân phải câu từng con một bằng lưỡi câu thay vì dùng lưới. Trước khi xuất khẩu cá bơn vàng trải qua quá trình kiểm định và đánh giá chất lượng nghiêm ngặt.\r\n\r\nSau khi đánh bắt và đưa lên thuyền, các ngư dân hạn chế tối đa chạm tay vào vì sẽ khiến cá bơn vàng không còn giữ được độ tươi ngon. Họ sẽ để cá nghỉ ngơi, thư giãn trong bể nước 1 – 2 ngày, tránh tình trạng căng thẳng làm thịt cá bớt ngon. '),
(61, 'Cá Tầm', '61.jpg', 0, 4, 395000.00, NULL, 0, 5, 0, 1, NULL, '2024-06-10 21:58:41', 'ca-tam', '<p>C&Aacute; TẦM TƯƠI SỐNG TỪ V&Ugrave;NG BIỂN VIỆT NAM C&aacute; tầm thuộc nh&oacute;m thịt trắng với h&igrave;nh d&aacute;ng thon d&agrave;i c&ugrave;ng c&aacute;c h&agrave;ng v&acirc;n gai thịt sần đi dọc theo đường cơ thể. C&aacute; tầm c&oacute; lớp da trơn l&aacute;ng b&oacute;ng đen. Người ta thường t&igrave;m thấy c&aacute; tầm ở v&ugrave;ng đ&aacute;y của c&aacute;c con s&ocirc;ng v&agrave; biển, v&igrave; lo&agrave;i n&agrave;y ưa lạnh, ngo&agrave;i ra phải l&agrave; nguồn nước sạch tự nhi&ecirc;n, c&oacute; lượng oxi h&ograve;a tan cao th&igrave; ch&uacute;ng mới c&oacute; thể sinh trưởng v&agrave; ph&aacute;t triển tốt được. Lo&agrave;i c&aacute; n&agrave;y g&acirc;y ấn tượng với độ thơm ngọt v&agrave; mềm b&eacute;o của thịt, độc đ&aacute;o nhất l&agrave; cấu tr&uacute;c xương được l&agrave;m đa phần từ sụn mềm, mang lại những trải nghiệm th&uacute; vị khi thưởng thức.</p>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_discounts`
--

CREATE TABLE `product_discounts` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_group_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_discounts`
--

INSERT INTO `product_discounts` (`id`, `product_id`, `user_group_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(148, 47, 1, 1, 385000.00, '2024-06-12 06:43:03', '2024-06-12 06:43:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `images`, `created_at`, `updated_at`) VALUES
(1, 34, 'cuacamau1.jpg', NULL, NULL),
(2, 34, 'cuacamau2.jpg', NULL, NULL),
(3, 34, 'cuacamau3.jpg', NULL, NULL),
(4, 34, 'cuacamau4.jpg', NULL, NULL),
(5, 46, 'tomalaska1.jpg', NULL, '2024-05-15 10:17:59'),
(6, 46, 'tomalaska2.jpg', NULL, '2024-05-15 10:02:24'),
(7, 46, 'tomalaska3.jpg', NULL, '2024-05-15 10:02:39'),
(8, 46, 'tomalaska4.jpg', NULL, '2024-05-15 09:53:04'),
(9, 37, 'kinggrab1.jpg', NULL, NULL),
(10, 37, 'kinggrab2.jpg', NULL, NULL),
(11, 37, 'kinggrab3.jpg', NULL, NULL),
(12, 37, 'kinggrab4.jpg', NULL, NULL),
(22, 53, 'tom-hum-xanh.jpg', '2024-05-22 03:07:58', '2024-05-22 03:07:58'),
(26, 88, 'ghe.jpg', '2024-06-06 15:17:46', '2024-06-06 15:17:46'),
(27, 89, 'ghe.jpg', '2024-06-06 15:18:02', '2024-06-06 15:18:02'),
(28, 90, 'ghe.jpg', '2024-06-06 15:18:17', '2024-06-06 15:18:17'),
(29, 91, 'ghe.jpg', '2024-06-06 15:18:32', '2024-06-06 15:18:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('g2aPqIyKIcxA8xPFL8vFQoBkvqcwNZ3z3PwTZq1Z', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSEJQQVJSTGZSRXUzRnZLeXM3RFV3Sk9hUWpYWGtwZzZOMEpjekxhdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1718277242),
('m6uInPf9XsvIJC0yIvNYtC7lPlNUOED5joiRNAGp', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoielYwdFF1QlIyU2Vnc1BBNlJhc0tpbFJSczhSUWhkcmU3M1hORUR4TiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbWcvbG9nby9ISy5wbmciO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNDtzOjQ6InVzZXIiO086MTU6IkFwcFxNb2RlbHNcVXNlciI6MzI6e3M6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6NToidXNlcnMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxOToicHJldmVudHNMYXp5TG9hZGluZyI7YjowO3M6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7czoxMzoiACoAYXR0cmlidXRlcyI7YToxNzp7czoyOiJpZCI7aToxNDtzOjQ6Im5hbWUiO3M6NToiYWRtaW4iO3M6NToiZW1haWwiO3M6MjI6ImtoYWhwczMxNTA2QGZwdC5lZHUudm4iO3M6MTc6ImVtYWlsX3ZlcmlmaWVkX2F0IjtOO3M6ODoicGFzc3dvcmQiO3M6NjA6IiQyeSQxMiRjZFlpdUxtRGguRUpqcUVmcHdaSGNPWU11ZXN2NlZzai45bGhER2h6Y3dSSi4xU0VnRU05ZSI7czo1OiJwaG9uZSI7aTozODMzMzE4MjI7czo4OiJwcm92aW5jZSI7czoyOiIwMSI7czo4OiJkaXN0cmljdCI7czozOiIwMDMiO3M6NDoid2FyZCI7czo1OiIwMDA5MSI7czo2OiJzdGF0dXMiO2k6MTtzOjQ6InJvbGUiO2k6MTtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI0LTA1LTIyIDE1OjQwOjUxIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI0LTA2LTEwIDAwOjAxOjQyIjtzOjU6ImltYWdlIjtzOjY6ImN2LmpwZyI7czoxNzoidmVyaWZpY2F0aW9uX2NvZGUiO047czoxMzoidXNlcl9ncm91cF9pZCI7Tjt9czoxMToiACoAb3JpZ2luYWwiO2E6MTc6e3M6MjoiaWQiO2k6MTQ7czo0OiJuYW1lIjtzOjU6ImFkbWluIjtzOjU6ImVtYWlsIjtzOjIyOiJraGFocHMzMTUwNkBmcHQuZWR1LnZuIjtzOjE3OiJlbWFpbF92ZXJpZmllZF9hdCI7TjtzOjg6InBhc3N3b3JkIjtzOjYwOiIkMnkkMTIkY2RZaXVMbURoLkVKanFFZnB3WkhjT1lNdWVzdjZWc2ouOWxoREdoemN3UkouMVNFZ0VNOWUiO3M6NToicGhvbmUiO2k6MzgzMzMxODIyO3M6ODoicHJvdmluY2UiO3M6MjoiMDEiO3M6ODoiZGlzdHJpY3QiO3M6MzoiMDAzIjtzOjQ6IndhcmQiO3M6NToiMDAwOTEiO3M6Njoic3RhdHVzIjtpOjE7czo0OiJyb2xlIjtpOjE7czoxNDoicmVtZW1iZXJfdG9rZW4iO047czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNC0wNS0yMiAxNTo0MDo1MSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNC0wNi0xMCAwMDowMTo0MiI7czo1OiJpbWFnZSI7czo2OiJjdi5qcGciO3M6MTc6InZlcmlmaWNhdGlvbl9jb2RlIjtOO3M6MTM6InVzZXJfZ3JvdXBfaWQiO047fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6ODoiACoAY2FzdHMiO2E6Mjp7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO3M6ODoiZGF0ZXRpbWUiO3M6ODoicGFzc3dvcmQiO3M6NjoiaGFzaGVkIjt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6MjE6IgAqAGF0dHJpYnV0ZUNhc3RDYWNoZSI7YTowOnt9czoxMzoiACoAZGF0ZUZvcm1hdCI7TjtzOjEwOiIAKgBhcHBlbmRzIjthOjA6e31zOjE5OiIAKgBkaXNwYXRjaGVzRXZlbnRzIjthOjA6e31zOjE0OiIAKgBvYnNlcnZhYmxlcyI7YTowOnt9czoxMjoiACoAcmVsYXRpb25zIjthOjA6e31zOjEwOiIAKgB0b3VjaGVzIjthOjA6e31zOjEwOiJ0aW1lc3RhbXBzIjtiOjE7czoxMzoidXNlc1VuaXF1ZUlkcyI7YjowO3M6OToiACoAaGlkZGVuIjthOjI6e2k6MDtzOjg6InBhc3N3b3JkIjtpOjE7czoxNDoicmVtZW1iZXJfdG9rZW4iO31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjExOiIAKgBmaWxsYWJsZSI7YToxMjp7aTowO3M6NDoibmFtZSI7aToxO3M6NToiZW1haWwiO2k6MjtzOjg6InBhc3N3b3JkIjtpOjM7czo1OiJwaG9uZSI7aTo0O3M6ODoicHJvdmluY2UiO2k6NTtzOjg6ImRpc3RyaWN0IjtpOjY7czo0OiJ3YXJkIjtpOjc7czo2OiJzdGF0dXMiO2k6ODtzOjQ6InJvbGUiO2k6OTtzOjU6ImltYWdlIjtpOjEwO3M6MTc6InZlcmlmaWNhdGlvbl9jb2RlIjtpOjExO3M6MTM6InVzZXJfZ3JvdXBfaWQiO31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO31zOjE5OiIAKgBhdXRoUGFzc3dvcmROYW1lIjtzOjg6InBhc3N3b3JkIjtzOjIwOiIAKgByZW1lbWJlclRva2VuTmFtZSI7czoxNDoicmVtZW1iZXJfdG9rZW4iO319', 1718276911),
('mLHfsj9e9KnYajuXEdKesLB84aw7DlKnebHQYy0E', NULL, '127.0.0.1', 'PostmanRuntime/7.32.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRlZtTGFHM2NheERZcE5tak90Z3VNUENsZEo2TUdyR3oxZEY0akVJayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGkvdjEvaG9tZS9jYXRlZ29yaWVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1718285573);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` int NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ward` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `role` tinyint DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_group_id` bigint UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `province`, `district`, `ward`, `status`, `role`, `remember_token`, `created_at`, `updated_at`, `image`, `verification_code`, `user_group_id`) VALUES
(1, 'Huynh Kha', 'khakha5087@gmail.com', NULL, '$2y$12$sqOa9PAKzDRZOsVFtWJy3e2Cg.ayPOl.nwNTCb9.QtwzbTkOb4BFq', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 1, 0, 'YwqsG2HDpzVFsSIha05pbB2sRgzROkou4GUaDxh77S35NrrpWB8fhDyU28U0', '2024-05-09 10:54:31', '2024-06-12 07:22:06', 'user.png', '756917', 1),
(14, 'admin', 'khahps31506@fpt.edu.vn', NULL, '$2y$12$cdYiuLmDh.EJjqEfpwZHcOYMuesv6Vsj.9lhDGhzcwRJ.1SEgEM9e', 383331822, '01', '003', '00091', 1, 1, NULL, '2024-05-22 08:40:51', '2024-06-09 17:01:42', 'cv.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_groups`
--

CREATE TABLE `user_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Default(Mặc định)', '2024-06-12 05:37:04', '2024-06-12 05:37:04'),
(4, 'Đồng', '2024-06-12 05:37:53', '2024-06-12 05:37:53'),
(5, 'Bạc', '2024-06-12 05:38:02', '2024-06-12 05:38:02'),
(6, 'Vàng', '2024-06-12 05:38:09', '2024-06-12 05:38:09');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `banner_images`
--
ALTER TABLE `banner_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banner_images_banner_id_foreign` (`banner_id`);

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_product_id_foreign` (`product_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_order_id_foreign` (`order_id`),
  ADD KEY `order_products_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_discounts_product_id_foreign` (`product_id`),
  ADD KEY `product_discounts_user_group_id_foreign` (`user_group_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

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
  ADD KEY `user_group_id` (`user_group_id`);

--
-- Chỉ mục cho bảng `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `banner_images`
--
ALTER TABLE `banner_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT cho bảng `product_discounts`
--
ALTER TABLE `product_discounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `banner_images`
--
ALTER TABLE `banner_images`
  ADD CONSTRAINT `banner_images_banner_id_foreign` FOREIGN KEY (`banner_id`) REFERENCES `banners` (`id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `order_statuses` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD CONSTRAINT `product_discounts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_discounts_user_group_id_foreign` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`);

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_group_id`) REFERENCES `user_groups` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
