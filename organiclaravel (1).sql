-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th5 15, 2024 lúc 08:07 AM
-- Phiên bản máy phục vụ: 8.0.30
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
(1, 'Cua biển', 'cua.png', NULL, '2024-05-13 18:21:34', 0, 1, 'cua-bien'),
(2, 'Mực biển', 'muc.png', NULL, '2024-05-13 18:21:23', 0, 1, 'muc-bien'),
(3, 'Tôm biển', 'tom.png', NULL, '2024-05-13 18:53:44', 0, 1, 'tom-bien'),
(4, 'Cá biển', 'ca.png', NULL, '2024-05-13 18:44:03', 0, 1, 'ca-bien');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `user_id`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 32, 1, 'u', 0, '2024-05-09 11:44:26', '2024-05-09 11:44:26'),
(2, 32, 1, 'thdthdt', 0, '2024-05-09 11:44:57', '2024-05-09 11:44:57'),
(3, 32, 1, 'hk', 0, '2024-05-09 11:45:28', '2024-05-09 11:45:28'),
(4, 32, 1, 'kkkk', 0, '2024-05-09 11:48:31', '2024-05-09 11:48:31'),
(5, 46, 1, 'now', 0, '2024-05-10 00:22:15', '2024-05-10 00:22:15'),
(6, 52, 1, 'Tôm ngọt quá', 0, '2024-05-10 10:17:34', '2024-05-10 10:17:34'),
(7, 52, 1, 'Tôm ngol', 0, '2024-05-10 10:24:43', '2024-05-10 10:24:43');

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
  `discount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupons`
--

INSERT INTO `coupons` (`id`, `name_coupon`, `code`, `type`, `total`, `date_start`, `date_end`, `created_at`, `updated_at`, `discount`) VALUES
(2, 'seafood', 1111, 1, 500000.00, NULL, NULL, NULL, NULL, 50000.00),
(3, 'sea', 2222, 0, 500000.00, NULL, NULL, NULL, NULL, 5.00);

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
(16, '2024_05_14_060103_create_orders_table', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int NOT NULL,
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ward` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double NOT NULL,
  `payment` tinyint DEFAULT NULL,
  `status_id` tinyint DEFAULT NULL,
  `coupon_code` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `province`, `district`, `ward`, `total`, `payment`, `status_id`, `coupon_code`, `created_at`, `updated_at`) VALUES
(1, 3, 'admin_QTV', 'admin@gmail.com', 383331822, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 709000, NULL, NULL, NULL, '2024-05-13 23:06:46', '2024-05-13 23:06:46'),
(2, 3, 'admin_QTV', 'admin@gmail.com', 383331822, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 2290000, NULL, NULL, NULL, '2024-05-13 23:10:09', '2024-05-13 23:10:09'),
(3, 6, 'cut kítt', 'khahps306@fpt.edu.vn', 365835677, '02', '027', '00778', 900000, NULL, NULL, NULL, '2024-05-14 09:14:32', '2024-05-14 09:14:32'),
(4, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 7974000, NULL, NULL, NULL, '2024-05-14 09:21:35', '2024-05-14 09:21:35'),
(5, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 6541000, NULL, NULL, NULL, '2024-05-14 09:25:09', '2024-05-14 09:25:09'),
(6, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 595000, NULL, NULL, NULL, '2024-05-14 09:25:32', '2024-05-14 09:25:32'),
(7, 7, 'thânh', 'babi@gmail.com', 1111111111, '25', '227', '08287', 13740000, NULL, NULL, NULL, '2024-05-14 09:26:57', '2024-05-14 09:26:57'),
(8, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 685000, NULL, NULL, NULL, '2024-05-14 09:27:34', '2024-05-14 09:27:34'),
(18, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 9000, NULL, NULL, NULL, '2024-05-14 10:13:13', '2024-05-14 10:13:13'),
(19, 1, 'Huynh Kha', 'khakha5087@gmail.com', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 3061000, NULL, NULL, NULL, '2024-05-15 00:03:42', '2024-05-15 00:03:42');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `name`, `price`, `total`, `created_at`, `updated_at`) VALUES
(9, 1, 34, 'Cua Cà Mau', 215000.00, 215000.00, '2024-05-13 23:06:46', '2024-05-13 23:06:46'),
(10, 1, 46, 'Tôm Hùm Alaska Nhỏ', 509000.00, 509000.00, '2024-05-13 23:06:46', '2024-05-13 23:06:46'),
(11, 2, 37, 'Cua King Crab Cái', 2290000.00, 2290000.00, '2024-05-13 23:10:09', '2024-05-13 23:10:09'),
(12, 3, 49, 'Tôm Hùm Bông', 925000.00, 925000.00, '2024-05-14 09:14:32', '2024-05-14 09:14:32'),
(13, 4, 32, 'Cá hồi nguyên con', 595000.00, 595000.00, '2024-05-14 09:21:35', '2024-05-14 09:21:35'),
(14, 5, 32, 'Cá hồi nguyên con', 595000.00, 1785000.00, '2024-05-14 09:25:09', '2024-05-14 09:25:09'),
(15, 6, 32, 'Cá hồi nguyên con', 595000.00, 595000.00, '2024-05-14 09:25:32', '2024-05-14 09:25:32'),
(16, 7, 37, 'Cua King Crab Cái', 2290000.00, 13740000.00, '2024-05-14 09:26:57', '2024-05-14 09:26:57'),
(17, 8, 27, 'Mực lá câu', 176000.00, 176000.00, '2024-05-14 09:27:34', '2024-05-14 09:27:34'),
(18, 8, 46, 'Tôm Hùm Alaska Nhỏ', 509000.00, 509000.00, '2024-05-14 09:27:34', '2024-05-14 09:27:34'),
(19, 18, 46, 'Tôm Hùm Alaska Nhỏ', 509000.00, 509000.00, '2024-05-14 10:13:13', '2024-05-14 10:13:13'),
(20, 19, 37, 'Cua King Crab Cái', 2290000.00, 2290000.00, '2024-05-15 00:03:42', '2024-05-15 00:03:42'),
(21, 19, 32, 'Cá hồi nguyên con', 595000.00, 595000.00, '2024-05-15 00:03:42', '2024-05-15 00:03:42'),
(22, 19, 27, 'Mực lá câu', 176000.00, 176000.00, '2024-05-15 00:03:42', '2024-05-15 00:03:42');

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
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `quantity`, `category_id`, `price`, `discount_price`, `hot`, `view`, `outstanding`, `status`, `created_at`, `updated_at`, `slug`) VALUES
(24, 'Bạch tuột', 'bachtuot.jpg', 10, 2, 139000.00, 115000.00, 0, 5, 0, 0, NULL, '2024-05-10 10:44:42', 'bach-tuot'),
(25, 'Mực khô', 'muckho.jpg', 1, 2, 195000.00, NULL, 0, 2, 0, 0, NULL, '2024-05-10 12:05:08', 'muc-kho'),
(26, 'Mực lá 1 nắng', 'mucla1nang.jpg', 1, 2, 369000.00, NULL, 0, 753, 0, 0, NULL, NULL, 'muc-la-mot-nang'),
(27, 'Mực lá câu', 'muclacau.jpg', 1, 2, 176000.00, NULL, 0, 3, 1, 0, NULL, '2024-05-11 23:41:12', 'muc-la-cau'),
(28, 'Mực ống 1 nắng', 'mucong1nang.jpg', 1, 2, 215000.00, NULL, 0, NULL, 0, 0, NULL, NULL, 'muc-ong-mot-nang'),
(29, 'Cá bông', 'cabong.jpg', 1, 4, 100000.00, 90000.00, 0, 5, 0, 0, NULL, '2024-05-10 10:43:41', 'ca-bong'),
(30, 'Cá trù', 'catru.png', 1, 4, 80000.00, NULL, 0, 215, 0, 0, NULL, NULL, 'ca-tru'),
(31, 'Cá như gan', 'canhugan.jpg', 1, 4, 80000.00, NULL, 0, NULL, 0, 0, NULL, NULL, 'ca-nhu-gan'),
(32, 'Cá hồi nguyên con', 'cahoinguyencon.jpg', 1, 4, 595000.00, NULL, 0, 33, 1, 0, NULL, '2024-05-10 10:47:53', 'ca-hoi-nguyen-con'),
(33, 'Cá hồi phi lê', 'cahoiphile.jpg', 1, 4, 1700000.00, NULL, 0, 1, 0, 0, NULL, '2024-05-11 23:40:49', 'ca-hoi-phi-le'),
(34, 'Cua Cà Mau', 'cuacamau.jpg', 1, 1, 215000.00, 200000.00, NULL, 621, 0, 0, NULL, '2024-05-10 10:07:28', 'cua-ca-mau'),
(35, 'Cua Nâu Sống', 'cuanausong.jpg', 1, 1, 552000.00, NULL, 0, NULL, 0, 0, NULL, NULL, 'cua-nau-song'),
(36, 'Ghẹ xanh', 'ghexanh.jpg', 1, 1, 295000.00, NULL, 0, NULL, 0, 0, NULL, NULL, 'ghe-xanh'),
(37, 'Cua King Crab Cái', 'kinggrab.jpg', 1, 1, 2290000.00, NULL, 0, 38, 1, 0, NULL, '2024-05-13 19:38:12', 'king-crab'),
(46, 'Tôm Hùm Alaska Nhỏ', 'tomalaska.jpg', 1, 3, 509000.00, NULL, 0, 20, 1, 0, NULL, '2024-05-13 19:45:10', 'tom-alaska'),
(47, 'Tôm Mũ Ni', 'tomauni.jpg', 1, 3, 390000.00, NULL, 0, NULL, 0, 0, NULL, NULL, 'tom-mau-ni'),
(48, 'Tôm Càng Xanh', 'tomcangxanh.jpg', 1, 3, 130000.00, NULL, 0, NULL, 0, 0, NULL, NULL, 'tom-cang-xanh'),
(49, 'Tôm Hùm Bông', 'tomhumbong.jpg', 1, 3, 925000.00, 900000.00, 0, 1, 0, 0, NULL, '2024-05-10 05:10:14', 'tom-hum-bong'),
(50, 'Tôm Hùm Uc', 'tomhumuc.jpg', 1, 3, 1850000.00, NULL, 0, 1, 0, 0, NULL, '2024-05-10 10:27:44', 'tom-hum-uc'),
(51, 'Tôm Sú Sống', 'tomsusong.jpg', 1, 3, 210000.00, NULL, 0, NULL, 0, 0, NULL, NULL, 'tom-su-song'),
(52, 'Tôm Tít', 'tomtit.jpg', 1, 3, 175000.00, NULL, 0, 5, 0, 0, NULL, '2024-05-10 10:27:39', 'tom-tit'),
(53, 'Tôm Hùm Xanh', 'tomhumxanh.jpg', 1, 3, 542000.00, NULL, 0, 369, 0, 0, NULL, NULL, 'tom-hum-xanh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 34, 'cuacamau1.jpg', NULL, NULL),
(2, 34, 'cuacamau2.jpg', NULL, NULL),
(3, 34, 'cuacamau3.jpg', NULL, NULL),
(4, 34, 'cuacamau4.jpg', NULL, NULL),
(5, 46, 'tomalaska1.jpg', NULL, NULL),
(6, 46, 'tomalaska2.jpg', NULL, NULL),
(7, 46, 'tomalaska3.jpg', NULL, NULL),
(8, 46, 'tomalaska4.jpg', NULL, NULL),
(9, 37, 'kinggrab1.jpg', NULL, NULL),
(10, 37, 'kinggrab2.jpg', NULL, NULL),
(11, 37, 'kinggrab3.jpg', NULL, NULL),
(12, 37, 'kinggrab4.jpg', NULL, NULL);

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
('A99j3mqkqQuAypKjp4uJ4fI0U2XgIuP7zZ3ciuRQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUHVudGhzWnY4NnhQRU5iUzNIWFZrYzl6ZFpRMjNkUTMzTmR4bEtPUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGVja291dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YToxOntpOjI3O2E6Njp7czoyOiJpZCI7czoyOiIyNyI7czo0OiJuYW1lIjtzOjE0OiJN4buxYyBsw6EgY8OidSI7czo1OiJpbWFnZSI7czoxMjoibXVjbGFjYXUuanBnIjtzOjU6InByaWNlIjtzOjk6IjE3NjAwMC4wMCI7czoxNDoiZGlzY291bnRfcHJpY2UiO047czo4OiJxdWFudGl0eSI7aTozO319fQ==', 1715756075),
('CksbnOdFRA1ClAaD4E8xLhnxegE2VdWitOmUzQmv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'YTozOntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2NoZWNrb3V0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6InQ2Z1VmRHVOYkpTUkZEOEFFaWZSb3haM1NXWWNyT09jVXRpVXV1RXciO30=', 1715707204),
('HKvF4hoDfVxNqynMiUf8IVI3mfbTNqaKmvAhn1Hf', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiMGlnUzBZOUNtRk5OUkREZEZCSDRUTEFYQTVBQ0lPdFhra3ZvcHdxZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGVja291dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJ1c2VyIjtPOjE1OiJBcHBcTW9kZWxzXFVzZXIiOjMyOntzOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjU6InVzZXJzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTk6InByZXZlbnRzTGF6eUxvYWRpbmciO2I6MDtzOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6MTU6e3M6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6OToiSHV5bmggS2hhIjtzOjU6ImVtYWlsIjtzOjIwOiJraGFraGE1MDg3QGdtYWlsLmNvbSI7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO047czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEyJFpVUE1TLjRudTNNVk1mR1lNSTJabXVoOVFhb0xFdVozaThCN0hBMmZVWlpmdk9SV3l6LnZ1IjtzOjU6InBob25lIjtpOjM1MzEyMzc3MTtzOjg6InByb3ZpbmNlIjtzOjIwOiJU4buJbmggQsOsbmggxJDhu4tuaCI7czo4OiJkaXN0cmljdCI7czoyMToiVGjhu4sgeMOjIEhvw6BpIE5oxqFuIjtzOjQ6IndhcmQiO3M6MjQ6IlBoxrDhu51uZyBUYW0gUXVhbiBC4bqvYyI7czo2OiJzdGF0dXMiO2k6MTtzOjQ6InJvbGUiO2k6MDtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI0LTA1LTA5IDE3OjU0OjMxIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI0LTA1LTA5IDE3OjU0OjMxIjtzOjU6ImltYWdlIjtzOjg6InVzZXIucG5nIjt9czoxMToiACoAb3JpZ2luYWwiO2E6MTU6e3M6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6OToiSHV5bmggS2hhIjtzOjU6ImVtYWlsIjtzOjIwOiJraGFraGE1MDg3QGdtYWlsLmNvbSI7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO047czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEyJFpVUE1TLjRudTNNVk1mR1lNSTJabXVoOVFhb0xFdVozaThCN0hBMmZVWlpmdk9SV3l6LnZ1IjtzOjU6InBob25lIjtpOjM1MzEyMzc3MTtzOjg6InByb3ZpbmNlIjtzOjIwOiJU4buJbmggQsOsbmggxJDhu4tuaCI7czo4OiJkaXN0cmljdCI7czoyMToiVGjhu4sgeMOjIEhvw6BpIE5oxqFuIjtzOjQ6IndhcmQiO3M6MjQ6IlBoxrDhu51uZyBUYW0gUXVhbiBC4bqvYyI7czo2OiJzdGF0dXMiO2k6MTtzOjQ6InJvbGUiO2k6MDtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI0LTA1LTA5IDE3OjU0OjMxIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI0LTA1LTA5IDE3OjU0OjMxIjtzOjU6ImltYWdlIjtzOjg6InVzZXIucG5nIjt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YToyOntzOjE3OiJlbWFpbF92ZXJpZmllZF9hdCI7czo4OiJkYXRldGltZSI7czo4OiJwYXNzd29yZCI7czo2OiJoYXNoZWQiO31zOjE3OiIAKgBjbGFzc0Nhc3RDYWNoZSI7YTowOnt9czoyMToiACoAYXR0cmlidXRlQ2FzdENhY2hlIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6MDp7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MDp7fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6MTA6InRpbWVzdGFtcHMiO2I6MTtzOjEzOiJ1c2VzVW5pcXVlSWRzIjtiOjA7czo5OiIAKgBoaWRkZW4iO2E6Mjp7aTowO3M6ODoicGFzc3dvcmQiO2k6MTtzOjE0OiJyZW1lbWJlcl90b2tlbiI7fXM6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTE6IgAqAGZpbGxhYmxlIjthOjEwOntpOjA7czo0OiJuYW1lIjtpOjE7czo1OiJlbWFpbCI7aToyO3M6ODoicGFzc3dvcmQiO2k6MztzOjU6InBob25lIjtpOjQ7czo4OiJwcm92aW5jZSI7aTo1O3M6ODoiZGlzdHJpY3QiO2k6NjtzOjQ6IndhcmQiO2k6NztzOjY6InN0YXR1cyI7aTo4O3M6NDoicm9sZSI7aTo5O3M6NToiaW1hZ2UiO31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO31zOjE5OiIAKgBhdXRoUGFzc3dvcmROYW1lIjtzOjg6InBhc3N3b3JkIjtzOjIwOiIAKgByZW1lbWJlclRva2VuTmFtZSI7czoxNDoicmVtZW1iZXJfdG9rZW4iO31zOjQ6ImNhcnQiO2E6MTp7aTo0NjthOjY6e3M6MjoiaWQiO3M6MjoiNDYiO3M6NDoibmFtZSI7czoyMjoiVMO0bSBIw7ltIEFsYXNrYSBOaOG7jyI7czo1OiJpbWFnZSI7czoxMzoidG9tYWxhc2thLmpwZyI7czo1OiJwcmljZSI7czo5OiI1MDkwMDAuMDAiO3M6MTQ6ImRpc2NvdW50X3ByaWNlIjtOO3M6ODoicXVhbnRpdHkiO2k6MTt9fXM6NjoiY291cG9uIjthOjE6e2k6MDthOjM6e3M6NDoiY29kZSI7aToxMTExO3M6NDoidHlwZSI7aToxO3M6NToidG90YWwiO3M6OToiNTAwMDAwLjAwIjt9fX0=', 1715708234),
('lgFuxFBYnMgoSL5XMus4AMYPNFSV223dg8XL4XQC', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo1OntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3ZpZXdvcmRlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NjoiX3Rva2VuIjtzOjQwOiJTanpUVGp1ZG1yNnZTVTFYeVB0SzJJWks4dUQ3emh1R1E3ZWJkb0R1IjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoidXNlciI7TzoxNToiQXBwXE1vZGVsc1xVc2VyIjozMjp7czoxMzoiACoAY29ubmVjdGlvbiI7czo1OiJteXNxbCI7czo4OiIAKgB0YWJsZSI7czo1OiJ1c2VycyI7czoxMzoiACoAcHJpbWFyeUtleSI7czoyOiJpZCI7czoxMDoiACoAa2V5VHlwZSI7czozOiJpbnQiO3M6MTI6ImluY3JlbWVudGluZyI7YjoxO3M6NzoiACoAd2l0aCI7YTowOnt9czoxMjoiACoAd2l0aENvdW50IjthOjA6e31zOjE5OiJwcmV2ZW50c0xhenlMb2FkaW5nIjtiOjA7czoxMDoiACoAcGVyUGFnZSI7aToxNTtzOjY6ImV4aXN0cyI7YjoxO3M6MTg6Indhc1JlY2VudGx5Q3JlYXRlZCI7YjowO3M6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDtzOjEzOiIAKgBhdHRyaWJ1dGVzIjthOjE1OntzOjI6ImlkIjtpOjE7czo0OiJuYW1lIjtzOjk6Ikh1eW5oIEtoYSI7czo1OiJlbWFpbCI7czoyMDoia2hha2hhNTA4N0BnbWFpbC5jb20iO3M6MTc6ImVtYWlsX3ZlcmlmaWVkX2F0IjtOO3M6ODoicGFzc3dvcmQiO3M6NjA6IiQyeSQxMiRaVVBNUy40bnUzTVZNZkdZTUkyWm11aDlRYW9MRXVaM2k4QjdIQTJmVVpaZnZPUld5ei52dSI7czo1OiJwaG9uZSI7aTozNTMxMjM3NzE7czo4OiJwcm92aW5jZSI7czoyMDoiVOG7iW5oIELDrG5oIMSQ4buLbmgiO3M6ODoiZGlzdHJpY3QiO3M6MjE6IlRo4buLIHjDoyBIb8OgaSBOaMahbiI7czo0OiJ3YXJkIjtzOjI0OiJQaMaw4budbmcgVGFtIFF1YW4gQuG6r2MiO3M6Njoic3RhdHVzIjtpOjE7czo0OiJyb2xlIjtpOjA7czoxNDoicmVtZW1iZXJfdG9rZW4iO047czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNC0wNS0wOSAxNzo1NDozMSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNC0wNS0wOSAxNzo1NDozMSI7czo1OiJpbWFnZSI7czo4OiJ1c2VyLnBuZyI7fXM6MTE6IgAqAG9yaWdpbmFsIjthOjE1OntzOjI6ImlkIjtpOjE7czo0OiJuYW1lIjtzOjk6Ikh1eW5oIEtoYSI7czo1OiJlbWFpbCI7czoyMDoia2hha2hhNTA4N0BnbWFpbC5jb20iO3M6MTc6ImVtYWlsX3ZlcmlmaWVkX2F0IjtOO3M6ODoicGFzc3dvcmQiO3M6NjA6IiQyeSQxMiRaVVBNUy40bnUzTVZNZkdZTUkyWm11aDlRYW9MRXVaM2k4QjdIQTJmVVpaZnZPUld5ei52dSI7czo1OiJwaG9uZSI7aTozNTMxMjM3NzE7czo4OiJwcm92aW5jZSI7czoyMDoiVOG7iW5oIELDrG5oIMSQ4buLbmgiO3M6ODoiZGlzdHJpY3QiO3M6MjE6IlRo4buLIHjDoyBIb8OgaSBOaMahbiI7czo0OiJ3YXJkIjtzOjI0OiJQaMaw4budbmcgVGFtIFF1YW4gQuG6r2MiO3M6Njoic3RhdHVzIjtpOjE7czo0OiJyb2xlIjtpOjA7czoxNDoicmVtZW1iZXJfdG9rZW4iO047czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNC0wNS0wOSAxNzo1NDozMSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNC0wNS0wOSAxNzo1NDozMSI7czo1OiJpbWFnZSI7czo4OiJ1c2VyLnBuZyI7fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6ODoiACoAY2FzdHMiO2E6Mjp7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO3M6ODoiZGF0ZXRpbWUiO3M6ODoicGFzc3dvcmQiO3M6NjoiaGFzaGVkIjt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6MjE6IgAqAGF0dHJpYnV0ZUNhc3RDYWNoZSI7YTowOnt9czoxMzoiACoAZGF0ZUZvcm1hdCI7TjtzOjEwOiIAKgBhcHBlbmRzIjthOjA6e31zOjE5OiIAKgBkaXNwYXRjaGVzRXZlbnRzIjthOjA6e31zOjE0OiIAKgBvYnNlcnZhYmxlcyI7YTowOnt9czoxMjoiACoAcmVsYXRpb25zIjthOjA6e31zOjEwOiIAKgB0b3VjaGVzIjthOjA6e31zOjEwOiJ0aW1lc3RhbXBzIjtiOjE7czoxMzoidXNlc1VuaXF1ZUlkcyI7YjowO3M6OToiACoAaGlkZGVuIjthOjI6e2k6MDtzOjg6InBhc3N3b3JkIjtpOjE7czoxNDoicmVtZW1iZXJfdG9rZW4iO31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjExOiIAKgBmaWxsYWJsZSI7YToxMDp7aTowO3M6NDoibmFtZSI7aToxO3M6NToiZW1haWwiO2k6MjtzOjg6InBhc3N3b3JkIjtpOjM7czo1OiJwaG9uZSI7aTo0O3M6ODoicHJvdmluY2UiO2k6NTtzOjg6ImRpc3RyaWN0IjtpOjY7czo0OiJ3YXJkIjtpOjc7czo2OiJzdGF0dXMiO2k6ODtzOjQ6InJvbGUiO2k6OTtzOjU6ImltYWdlIjt9czoxMDoiACoAZ3VhcmRlZCI7YToxOntpOjA7czoxOiIqIjt9czoxOToiACoAYXV0aFBhc3N3b3JkTmFtZSI7czo4OiJwYXNzd29yZCI7czoyMDoiACoAcmVtZW1iZXJUb2tlbk5hbWUiO3M6MTQ6InJlbWVtYmVyX3Rva2VuIjt9fQ==', 1715703933),
('qSEx0LG20QGxAQsKhQ4K7QCs6nYfWzqTJPTXbjTn', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMUVnQ1NSUVZ4MTNjNXBZU3k0UDlZcUxra05qYjN3d0c1Nko0eFFEbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJ1c2VyIjtPOjE1OiJBcHBcTW9kZWxzXFVzZXIiOjMyOntzOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjU6InVzZXJzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTk6InByZXZlbnRzTGF6eUxvYWRpbmciO2I6MDtzOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6MTU6e3M6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6OToiSHV5bmggS2hhIjtzOjU6ImVtYWlsIjtzOjIwOiJraGFraGE1MDg3QGdtYWlsLmNvbSI7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO047czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEyJFpVUE1TLjRudTNNVk1mR1lNSTJabXVoOVFhb0xFdVozaThCN0hBMmZVWlpmdk9SV3l6LnZ1IjtzOjU6InBob25lIjtpOjM1MzEyMzc3MTtzOjg6InByb3ZpbmNlIjtzOjIwOiJU4buJbmggQsOsbmggxJDhu4tuaCI7czo4OiJkaXN0cmljdCI7czoyMToiVGjhu4sgeMOjIEhvw6BpIE5oxqFuIjtzOjQ6IndhcmQiO3M6MjQ6IlBoxrDhu51uZyBUYW0gUXVhbiBC4bqvYyI7czo2OiJzdGF0dXMiO2k6MTtzOjQ6InJvbGUiO2k6MDtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI0LTA1LTA5IDE3OjU0OjMxIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI0LTA1LTA5IDE3OjU0OjMxIjtzOjU6ImltYWdlIjtzOjg6InVzZXIucG5nIjt9czoxMToiACoAb3JpZ2luYWwiO2E6MTU6e3M6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6OToiSHV5bmggS2hhIjtzOjU6ImVtYWlsIjtzOjIwOiJraGFraGE1MDg3QGdtYWlsLmNvbSI7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO047czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEyJFpVUE1TLjRudTNNVk1mR1lNSTJabXVoOVFhb0xFdVozaThCN0hBMmZVWlpmdk9SV3l6LnZ1IjtzOjU6InBob25lIjtpOjM1MzEyMzc3MTtzOjg6InByb3ZpbmNlIjtzOjIwOiJU4buJbmggQsOsbmggxJDhu4tuaCI7czo4OiJkaXN0cmljdCI7czoyMToiVGjhu4sgeMOjIEhvw6BpIE5oxqFuIjtzOjQ6IndhcmQiO3M6MjQ6IlBoxrDhu51uZyBUYW0gUXVhbiBC4bqvYyI7czo2OiJzdGF0dXMiO2k6MTtzOjQ6InJvbGUiO2k6MDtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI0LTA1LTA5IDE3OjU0OjMxIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI0LTA1LTA5IDE3OjU0OjMxIjtzOjU6ImltYWdlIjtzOjg6InVzZXIucG5nIjt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YToyOntzOjE3OiJlbWFpbF92ZXJpZmllZF9hdCI7czo4OiJkYXRldGltZSI7czo4OiJwYXNzd29yZCI7czo2OiJoYXNoZWQiO31zOjE3OiIAKgBjbGFzc0Nhc3RDYWNoZSI7YTowOnt9czoyMToiACoAYXR0cmlidXRlQ2FzdENhY2hlIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6MDp7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MDp7fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6MTA6InRpbWVzdGFtcHMiO2I6MTtzOjEzOiJ1c2VzVW5pcXVlSWRzIjtiOjA7czo5OiIAKgBoaWRkZW4iO2E6Mjp7aTowO3M6ODoicGFzc3dvcmQiO2k6MTtzOjE0OiJyZW1lbWJlcl90b2tlbiI7fXM6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTE6IgAqAGZpbGxhYmxlIjthOjEwOntpOjA7czo0OiJuYW1lIjtpOjE7czo1OiJlbWFpbCI7aToyO3M6ODoicGFzc3dvcmQiO2k6MztzOjU6InBob25lIjtpOjQ7czo4OiJwcm92aW5jZSI7aTo1O3M6ODoiZGlzdHJpY3QiO2k6NjtzOjQ6IndhcmQiO2k6NztzOjY6InN0YXR1cyI7aTo4O3M6NDoicm9sZSI7aTo5O3M6NToiaW1hZ2UiO31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO31zOjE5OiIAKgBhdXRoUGFzc3dvcmROYW1lIjtzOjg6InBhc3N3b3JkIjtzOjIwOiIAKgByZW1lbWJlclRva2VuTmFtZSI7czoxNDoicmVtZW1iZXJfdG9rZW4iO319', 1715760290),
('uOyMcZ7gkgnV23DzjmJlvV7e3oESZk459VtvKz97', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRXdWdXB3TmV1bE9FRzdXUkVQczY4bzMwRW9GWEo3VW83T2VkQTFnRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGVja291dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YToxOntpOjMyO2E6Njp7czoyOiJpZCI7czoyOiIzMiI7czo0OiJuYW1lIjtzOjIxOiJDw6EgaOG7k2kgbmd1ecOqbiBjb24iO3M6NToiaW1hZ2UiO3M6MTg6ImNhaG9pbmd1eWVuY29uLmpwZyI7czo1OiJwcmljZSI7czo5OiI1OTUwMDAuMDAiO3M6MTQ6ImRpc2NvdW50X3ByaWNlIjtOO3M6ODoicXVhbnRpdHkiO2k6Mjt9fX0=', 1715754473),
('vZTmmbDgH8bMte6Y1rJQBzONWmBU0RmgkYy8YjVn', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo2OntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2NoZWNrb3V0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6IlJZZlBacHE5alVRUXY0dkt4RExsMDRQb1dSMG1PaUk5aVBOZDk3VXYiO3M6NDoiY2FydCI7YTo0OntpOjMyO2E6Njp7czoyOiJpZCI7czoyOiIzMiI7czo0OiJuYW1lIjtzOjIxOiJDw6EgaOG7k2kgbmd1ecOqbiBjb24iO3M6NToiaW1hZ2UiO3M6MTg6ImNhaG9pbmd1eWVuY29uLmpwZyI7czo1OiJwcmljZSI7czo5OiI1OTUwMDAuMDAiO3M6MTQ6ImRpc2NvdW50X3ByaWNlIjtOO3M6ODoicXVhbnRpdHkiO2k6MTt9czo1OiJ0b3RhbCI7aTowO2k6Mzc7YTo2OntzOjI6ImlkIjtzOjI6IjM3IjtzOjQ6Im5hbWUiO3M6MTg6IkN1YSBLaW5nIENyYWIgQ8OhaSI7czo1OiJpbWFnZSI7czoxMjoia2luZ2dyYWIuanBnIjtzOjU6InByaWNlIjtzOjEwOiIyMjkwMDAwLjAwIjtzOjE0OiJkaXNjb3VudF9wcmljZSI7TjtzOjg6InF1YW50aXR5IjtpOjM7fWk6NDY7YTo2OntzOjI6ImlkIjtzOjI6IjQ2IjtzOjQ6Im5hbWUiO3M6MjI6IlTDtG0gSMO5bSBBbGFza2EgTmjhu48iO3M6NToiaW1hZ2UiO3M6MTM6InRvbWFsYXNrYS5qcGciO3M6NToicHJpY2UiO3M6OToiNTA5MDAwLjAwIjtzOjE0OiJkaXNjb3VudF9wcmljZSI7TjtzOjg6InF1YW50aXR5IjtpOjE7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoidXNlciI7TzoxNToiQXBwXE1vZGVsc1xVc2VyIjozMjp7czoxMzoiACoAY29ubmVjdGlvbiI7czo1OiJteXNxbCI7czo4OiIAKgB0YWJsZSI7czo1OiJ1c2VycyI7czoxMzoiACoAcHJpbWFyeUtleSI7czoyOiJpZCI7czoxMDoiACoAa2V5VHlwZSI7czozOiJpbnQiO3M6MTI6ImluY3JlbWVudGluZyI7YjoxO3M6NzoiACoAd2l0aCI7YTowOnt9czoxMjoiACoAd2l0aENvdW50IjthOjA6e31zOjE5OiJwcmV2ZW50c0xhenlMb2FkaW5nIjtiOjA7czoxMDoiACoAcGVyUGFnZSI7aToxNTtzOjY6ImV4aXN0cyI7YjoxO3M6MTg6Indhc1JlY2VudGx5Q3JlYXRlZCI7YjowO3M6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDtzOjEzOiIAKgBhdHRyaWJ1dGVzIjthOjE1OntzOjI6ImlkIjtpOjE7czo0OiJuYW1lIjtzOjk6Ikh1eW5oIEtoYSI7czo1OiJlbWFpbCI7czoyMDoia2hha2hhNTA4N0BnbWFpbC5jb20iO3M6MTc6ImVtYWlsX3ZlcmlmaWVkX2F0IjtOO3M6ODoicGFzc3dvcmQiO3M6NjA6IiQyeSQxMiRaVVBNUy40bnUzTVZNZkdZTUkyWm11aDlRYW9MRXVaM2k4QjdIQTJmVVpaZnZPUld5ei52dSI7czo1OiJwaG9uZSI7aTozNTMxMjM3NzE7czo4OiJwcm92aW5jZSI7czoyMDoiVOG7iW5oIELDrG5oIMSQ4buLbmgiO3M6ODoiZGlzdHJpY3QiO3M6MjE6IlRo4buLIHjDoyBIb8OgaSBOaMahbiI7czo0OiJ3YXJkIjtzOjI0OiJQaMaw4budbmcgVGFtIFF1YW4gQuG6r2MiO3M6Njoic3RhdHVzIjtpOjE7czo0OiJyb2xlIjtpOjA7czoxNDoicmVtZW1iZXJfdG9rZW4iO047czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNC0wNS0wOSAxNzo1NDozMSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNC0wNS0wOSAxNzo1NDozMSI7czo1OiJpbWFnZSI7czo4OiJ1c2VyLnBuZyI7fXM6MTE6IgAqAG9yaWdpbmFsIjthOjE1OntzOjI6ImlkIjtpOjE7czo0OiJuYW1lIjtzOjk6Ikh1eW5oIEtoYSI7czo1OiJlbWFpbCI7czoyMDoia2hha2hhNTA4N0BnbWFpbC5jb20iO3M6MTc6ImVtYWlsX3ZlcmlmaWVkX2F0IjtOO3M6ODoicGFzc3dvcmQiO3M6NjA6IiQyeSQxMiRaVVBNUy40bnUzTVZNZkdZTUkyWm11aDlRYW9MRXVaM2k4QjdIQTJmVVpaZnZPUld5ei52dSI7czo1OiJwaG9uZSI7aTozNTMxMjM3NzE7czo4OiJwcm92aW5jZSI7czoyMDoiVOG7iW5oIELDrG5oIMSQ4buLbmgiO3M6ODoiZGlzdHJpY3QiO3M6MjE6IlRo4buLIHjDoyBIb8OgaSBOaMahbiI7czo0OiJ3YXJkIjtzOjI0OiJQaMaw4budbmcgVGFtIFF1YW4gQuG6r2MiO3M6Njoic3RhdHVzIjtpOjE7czo0OiJyb2xlIjtpOjA7czoxNDoicmVtZW1iZXJfdG9rZW4iO047czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNC0wNS0wOSAxNzo1NDozMSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNC0wNS0wOSAxNzo1NDozMSI7czo1OiJpbWFnZSI7czo4OiJ1c2VyLnBuZyI7fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6ODoiACoAY2FzdHMiO2E6Mjp7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO3M6ODoiZGF0ZXRpbWUiO3M6ODoicGFzc3dvcmQiO3M6NjoiaGFzaGVkIjt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6MjE6IgAqAGF0dHJpYnV0ZUNhc3RDYWNoZSI7YTowOnt9czoxMzoiACoAZGF0ZUZvcm1hdCI7TjtzOjEwOiIAKgBhcHBlbmRzIjthOjA6e31zOjE5OiIAKgBkaXNwYXRjaGVzRXZlbnRzIjthOjA6e31zOjE0OiIAKgBvYnNlcnZhYmxlcyI7YTowOnt9czoxMjoiACoAcmVsYXRpb25zIjthOjA6e31zOjEwOiIAKgB0b3VjaGVzIjthOjA6e31zOjEwOiJ0aW1lc3RhbXBzIjtiOjE7czoxMzoidXNlc1VuaXF1ZUlkcyI7YjowO3M6OToiACoAaGlkZGVuIjthOjI6e2k6MDtzOjg6InBhc3N3b3JkIjtpOjE7czoxNDoicmVtZW1iZXJfdG9rZW4iO31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjExOiIAKgBmaWxsYWJsZSI7YToxMDp7aTowO3M6NDoibmFtZSI7aToxO3M6NToiZW1haWwiO2k6MjtzOjg6InBhc3N3b3JkIjtpOjM7czo1OiJwaG9uZSI7aTo0O3M6ODoicHJvdmluY2UiO2k6NTtzOjg6ImRpc3RyaWN0IjtpOjY7czo0OiJ3YXJkIjtpOjc7czo2OiJzdGF0dXMiO2k6ODtzOjQ6InJvbGUiO2k6OTtzOjU6ImltYWdlIjt9czoxMDoiACoAZ3VhcmRlZCI7YToxOntpOjA7czoxOiIqIjt9czoxOToiACoAYXV0aFBhc3N3b3JkTmFtZSI7czo4OiJwYXNzd29yZCI7czoyMDoiACoAcmVtZW1iZXJUb2tlbk5hbWUiO3M6MTQ6InJlbWVtYmVyX3Rva2VuIjt9fQ==', 1715703695),
('WKasJKScg7qXec6iJuqxB0dRwwMObhHPFFpMGox1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOVJQdWt0alFBQjEwWVcwV2lvZjhSMVF6b3BMY1NMNUVIZ0JXWDJYdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGVja291dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTA6ImNhcnRfdG90YWwiO2Q6MTc2MDAwO3M6NDoiY2FydCI7YToxOntpOjI3O2E6Njp7czoyOiJpZCI7czoyOiIyNyI7czo0OiJuYW1lIjtzOjE0OiJN4buxYyBsw6EgY8OidSI7czo1OiJpbWFnZSI7czoxMjoibXVjbGFjYXUuanBnIjtzOjU6InByaWNlIjtzOjk6IjE3NjAwMC4wMCI7czoxNDoiZGlzY291bnRfcHJpY2UiO047czo4OiJxdWFudGl0eSI7aTozO319fQ==', 1715755216),
('x7YINpVWhiXnbXN2ZepQn9pK2S7fgvAZA3LQ9yiM', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoic3dLWk5QQ2p3V0d3cnd2dHRUajFEYk9tM2k2WWdrSnBMM09xSm41YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGVja291dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJ1c2VyIjtPOjE1OiJBcHBcTW9kZWxzXFVzZXIiOjMyOntzOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjU6InVzZXJzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTk6InByZXZlbnRzTGF6eUxvYWRpbmciO2I6MDtzOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6MTU6e3M6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6OToiSHV5bmggS2hhIjtzOjU6ImVtYWlsIjtzOjIwOiJraGFraGE1MDg3QGdtYWlsLmNvbSI7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO047czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEyJFpVUE1TLjRudTNNVk1mR1lNSTJabXVoOVFhb0xFdVozaThCN0hBMmZVWlpmdk9SV3l6LnZ1IjtzOjU6InBob25lIjtpOjM1MzEyMzc3MTtzOjg6InByb3ZpbmNlIjtzOjIwOiJU4buJbmggQsOsbmggxJDhu4tuaCI7czo4OiJkaXN0cmljdCI7czoyMToiVGjhu4sgeMOjIEhvw6BpIE5oxqFuIjtzOjQ6IndhcmQiO3M6MjQ6IlBoxrDhu51uZyBUYW0gUXVhbiBC4bqvYyI7czo2OiJzdGF0dXMiO2k6MTtzOjQ6InJvbGUiO2k6MDtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI0LTA1LTA5IDE3OjU0OjMxIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI0LTA1LTA5IDE3OjU0OjMxIjtzOjU6ImltYWdlIjtzOjg6InVzZXIucG5nIjt9czoxMToiACoAb3JpZ2luYWwiO2E6MTU6e3M6MjoiaWQiO2k6MTtzOjQ6Im5hbWUiO3M6OToiSHV5bmggS2hhIjtzOjU6ImVtYWlsIjtzOjIwOiJraGFraGE1MDg3QGdtYWlsLmNvbSI7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO047czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEyJFpVUE1TLjRudTNNVk1mR1lNSTJabXVoOVFhb0xFdVozaThCN0hBMmZVWlpmdk9SV3l6LnZ1IjtzOjU6InBob25lIjtpOjM1MzEyMzc3MTtzOjg6InByb3ZpbmNlIjtzOjIwOiJU4buJbmggQsOsbmggxJDhu4tuaCI7czo4OiJkaXN0cmljdCI7czoyMToiVGjhu4sgeMOjIEhvw6BpIE5oxqFuIjtzOjQ6IndhcmQiO3M6MjQ6IlBoxrDhu51uZyBUYW0gUXVhbiBC4bqvYyI7czo2OiJzdGF0dXMiO2k6MTtzOjQ6InJvbGUiO2k6MDtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI0LTA1LTA5IDE3OjU0OjMxIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI0LTA1LTA5IDE3OjU0OjMxIjtzOjU6ImltYWdlIjtzOjg6InVzZXIucG5nIjt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YToyOntzOjE3OiJlbWFpbF92ZXJpZmllZF9hdCI7czo4OiJkYXRldGltZSI7czo4OiJwYXNzd29yZCI7czo2OiJoYXNoZWQiO31zOjE3OiIAKgBjbGFzc0Nhc3RDYWNoZSI7YTowOnt9czoyMToiACoAYXR0cmlidXRlQ2FzdENhY2hlIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6MDp7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MDp7fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6MTA6InRpbWVzdGFtcHMiO2I6MTtzOjEzOiJ1c2VzVW5pcXVlSWRzIjtiOjA7czo5OiIAKgBoaWRkZW4iO2E6Mjp7aTowO3M6ODoicGFzc3dvcmQiO2k6MTtzOjE0OiJyZW1lbWJlcl90b2tlbiI7fXM6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTE6IgAqAGZpbGxhYmxlIjthOjEwOntpOjA7czo0OiJuYW1lIjtpOjE7czo1OiJlbWFpbCI7aToyO3M6ODoicGFzc3dvcmQiO2k6MztzOjU6InBob25lIjtpOjQ7czo4OiJwcm92aW5jZSI7aTo1O3M6ODoiZGlzdHJpY3QiO2k6NjtzOjQ6IndhcmQiO2k6NztzOjY6InN0YXR1cyI7aTo4O3M6NDoicm9sZSI7aTo5O3M6NToiaW1hZ2UiO31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO31zOjE5OiIAKgBhdXRoUGFzc3dvcmROYW1lIjtzOjg6InBhc3N3b3JkIjtzOjIwOiIAKgByZW1lbWJlclRva2VuTmFtZSI7czoxNDoicmVtZW1iZXJfdG9rZW4iO31zOjQ6ImNhcnQiO2E6MTp7aTozMjthOjY6e3M6MjoiaWQiO3M6MjoiMzIiO3M6NDoibmFtZSI7czoyMToiQ8OhIGjhu5NpIG5ndXnDqm4gY29uIjtzOjU6ImltYWdlIjtzOjE4OiJjYWhvaW5ndXllbmNvbi5qcGciO3M6NToicHJpY2UiO3M6OToiNTk1MDAwLjAwIjtzOjE0OiJkaXNjb3VudF9wcmljZSI7TjtzOjg6InF1YW50aXR5IjtpOjE7fX1zOjY6ImNvdXBvbiI7YToxOntpOjA7YTo0OntzOjQ6ImNvZGUiO2k6MTExMTtzOjQ6InR5cGUiO2k6MTtzOjU6InRvdGFsIjtzOjk6IjUwMDAwMC4wMCI7czo4OiJkaXNjb3VudCI7czo4OiI1MDAwMC4wMCI7fX19', 1715708288),
('xos3NbAQ5mcYMTWGTuVs5Qp14YxwrIsSDTwtZxJq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid0l4WTh3dDNoaUxaVzdWSEdwRHB4aWVYdUpscGt2QUs5OGFXbGpvQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC92aWV3b3JkZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1715703272);

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
  `image` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `province`, `district`, `ward`, `status`, `role`, `remember_token`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Huynh Kha', 'khakha5087@gmail.com', NULL, '$2y$12$ZUPMS.4nu3MVMfGYMI2Zmuh9QaoLEuZ3i8B7HA2fUZZfvORWyz.vu', 353123771, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 1, 0, NULL, '2024-05-09 10:54:31', '2024-05-09 10:54:31', 'user.png'),
(3, 'admin_QTV', 'admin@gmail.com', NULL, '$2y$12$nh9vU6T.R0JbVSk/h0L1zu8C4XCxoEesQamOXS7NV8UseaDetrTEi', 383331822, 'Tỉnh Bình Định', 'Thị xã Hoài Nhơn', 'Phường Tam Quan Bắc', 1, 1, NULL, '2024-05-12 08:05:41', '2024-05-12 08:05:41', 'user.png'),
(4, 'cut kít', 'khahps31506@fpt.edu.vn', NULL, NULL, 365835677, '01', '001', '00001', 1, 0, NULL, '2024-05-14 09:13:33', '2024-05-14 09:13:33', NULL),
(6, 'cut kítt', 'khahps306@fpt.edu.vn', NULL, NULL, 365835677, '02', '027', '00778', 1, 0, NULL, '2024-05-14 09:14:32', '2024-05-14 09:14:32', NULL),
(7, 'thânh', 'babi@gmail.com', NULL, NULL, 1111111111, '25', '227', '08287', 1, 0, NULL, '2024-05-14 09:26:57', '2024-05-14 09:26:57', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

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
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

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
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
