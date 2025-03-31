-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307:3306
-- Generation Time: Mar 26, 2025 at 12:30 PM
-- Server version: 11.5.2-MariaDB
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_2_relationship_with_custom_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(191) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `customer_id`, `product_id`, `product_name`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'Product 1', 2, 100.00, '2025-03-26 05:28:42', '2025-03-26 05:28:42'),
(2, 1, 2, 'Product 2', 1, 50.00, '2025-03-26 05:28:42', '2025-03-26 05:28:42'),
(3, 1, 3, 'Product 3', 3, 75.50, '2025-03-26 05:28:42', '2025-03-26 05:28:42');

-- --------------------------------------------------------

--
-- Table structure for table `connection_requests`
--

DROP TABLE IF EXISTS `connection_requests`;
CREATE TABLE IF NOT EXISTS `connection_requests` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection_id` varchar(191) NOT NULL,
  `auth_code` varchar(191) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `connection_requests_connection_id_unique` (`connection_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `connection_requests`
--

INSERT INTO `connection_requests` (`id`, `connection_id`, `auth_code`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, '597482', 'fg4hj2N3IY', 5, '2025-03-24 05:04:27', '2025-03-26 01:07:48'),
(2, '291217', NULL, NULL, '2025-03-25 12:35:37', '2025-03-25 12:35:37');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `address` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`),
  UNIQUE KEY `customers_phone_unique` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `password`, `gender`, `address`, `created_at`, `updated_at`) VALUES
(1, 'sim', '74577777773', 'simran@gmail.com', NULL, 'female', 'baitalpur', '2025-03-25 04:25:55', '2025-03-25 04:25:55'),
(2, 'simr', '745777777732', 'simrn@gmail.com', NULL, 'female', 'baitalpur', '2025-03-25 04:29:13', '2025-03-25 04:29:13'),
(3, 'simra', '7457777777321', 'simn@gmail.com', NULL, 'female', 'baitalpur', '2025-03-25 04:29:35', '2025-03-25 04:29:35'),
(4, 'simran', '7457777732', 'simranc@gmail.com', NULL, 'female', 'baitalpur', '2025-03-25 04:30:35', '2025-03-25 04:30:35'),
(5, 'John Doe', NULL, 'john.doe@example.com', 'password123', 'male', '123 Main Street, City, Country', '2025-03-25 05:06:59', '2025-03-25 05:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment_methods`
--

DROP TABLE IF EXISTS `customer_payment_methods`;
CREATE TABLE IF NOT EXISTS `customer_payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_payment_methods_customer_id_foreign` (`customer_id`),
  KEY `customer_payment_methods_payment_method_id_foreign` (`payment_method_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2025_03_24_101140_create_connection_requests_table', 1),
(3, '2025_03_24_105127_create_otps_table', 2),
(4, '2025_03_24_111121_create_customers_table', 3),
(5, '2025_03_24_111617_add_phone_to_customer', 4),
(6, '2025_03_25_052704_create_orders_table', 5),
(7, '0001_01_01_000000_create_users_table', 6),
(8, '0001_01_01_000001_create_cache_table', 6),
(9, '0001_01_01_000002_create_jobs_table', 6),
(10, '2025_03_24_102159_create_personal_access_tokens_table', 6),
(11, '2025_03_26_043013_create_products_table', 7),
(12, '2025_03_26_043709_create_order_items_table', 8),
(13, '2025_03_26_044426_create_cart_items_table', 9),
(14, '2025_03_26_044858_create_transactions_table', 10),
(15, '2025_03_26_093742_add_product_id_to_cart_items', 11),
(16, '2025_03_26_100835_create_payment_methods_table', 12),
(17, '2025_03_26_101904_create_customer_payment_methods_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` enum('COD','online') NOT NULL,
  `online_payment_method` enum('paypal','stripe','razorpay','none') NOT NULL DEFAULT 'none',
  `total_amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_customer_id_foreign` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `payment_method`, `online_payment_method`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'online', 'paypal', 250.00, '2025-03-25 01:15:11', '2025-03-25 01:15:11'),
(2, 1, 'online', 'paypal', 255.00, '2025-03-25 01:18:26', '2025-03-25 01:18:26'),
(3, 1, 'online', 'paypal', 257.00, '2025-03-25 01:18:34', '2025-03-25 01:18:34'),
(4, 1, 'online', 'paypal', 258.00, '2025-03-25 01:18:42', '2025-03-25 01:18:42'),
(5, 1, 'online', 'paypal', 258.00, '2025-03-25 04:27:53', '2025-03-25 04:27:53'),
(6, 1, 'online', 'paypal', 258.00, '2025-03-25 04:28:02', '2025-03-25 04:28:02'),
(7, 1, 'online', 'paypal', 258.00, '2025-03-25 04:28:08', '2025-03-25 04:28:08'),
(8, 1, 'online', 'paypal', 258.00, '2025-03-25 04:28:12', '2025-03-25 04:28:12'),
(9, 5, 'COD', 'none', 5000.00, '2025-03-26 05:24:03', '2025-03-26 05:24:03'),
(10, 5, 'COD', 'none', 5000.00, '2025-03-26 05:24:56', '2025-03-26 05:24:56'),
(11, 5, 'COD', 'none', 5000.00, '2025-03-26 05:25:29', '2025-03-26 05:25:29'),
(12, 5, 'COD', 'none', 5000.00, '2025-03-26 05:31:49', '2025-03-26 05:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

DROP TABLE IF EXISTS `otps`;
CREATE TABLE IF NOT EXISTS `otps` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `otp` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `expired_on` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `otps_otp_unique` (`otp`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `otp`, `phone`, `expired_on`, `created_at`, `updated_at`) VALUES
(1, '9145', '1111111111', '2025-03-26 07:29:10', '2025-03-24 06:25:33', '2025-03-25 04:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `method_name` enum('Credit Card','Debit Card','Net Banking','UPI','Wallet','Cash on Delivery','PayPal','Google Pay','Apple Pay','Bank Transfer') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `method_name`, `created_at`, `updated_at`) VALUES
(1, 'Credit Card', '2025-03-26 05:11:27', '2025-03-26 05:11:27'),
(2, 'Debit Card', '2025-03-26 05:11:28', '2025-03-26 05:11:28'),
(3, 'Net Banking', '2025-03-26 05:11:28', '2025-03-26 05:11:28'),
(4, 'UPI', '2025-03-26 05:11:28', '2025-03-26 05:11:28'),
(5, 'Wallet', '2025-03-26 05:11:28', '2025-03-26 05:11:28'),
(6, 'Cash on Delivery', '2025-03-26 05:11:28', '2025-03-26 05:11:28'),
(7, 'PayPal', '2025-03-26 05:11:28', '2025-03-26 05:11:28'),
(8, 'Google Pay', '2025-03-26 05:11:28', '2025-03-26 05:11:28'),
(9, 'Apple Pay', '2025-03-26 05:11:28', '2025-03-26 05:11:28'),
(10, 'Bank Transfer', '2025-03-26 05:11:28', '2025-03-26 05:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `image_url` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock_quantity`, `image_url`, `created_at`, `updated_at`) VALUES
(1, 'Dell Laptop', NULL, 100.00, 7, '1', '2025-03-26 00:48:49', '2025-03-26 00:48:49'),
(2, 'Wireless Mouse', 'Ergonomic wireless mouse with USB receiver.', 29.99, 100, 'https://example.com/images/wireless-mouse.jpg', '2025-03-26 05:30:11', '2025-03-26 05:30:11'),
(3, 'Mechanical Keyboard', 'RGB backlit mechanical keyboard with tactile switches.', 79.99, 50, 'https://example.com/images/mechanical-keyboard.jpg', '2025-03-26 05:30:11', '2025-03-26 05:30:11'),
(4, 'Gaming Headset', 'Surround sound gaming headset with noise cancellation.', 59.99, 75, 'https://example.com/images/gaming-headset.jpg', '2025-03-26 05:30:12', '2025-03-26 05:30:12'),
(5, 'Laptop Stand', 'Adjustable aluminum laptop stand.', 34.99, 120, 'https://example.com/images/laptop-stand.jpg', '2025-03-26 05:30:12', '2025-03-26 05:30:12'),
(6, 'USB-C Hub', 'Multi-port USB-C hub with HDMI and USB 3.0 ports.', 49.99, 60, 'https://example.com/images/usb-c-hub.jpg', '2025-03-26 05:30:12', '2025-03-26 05:30:12'),
(7, 'Smartphone Tripod', 'Portable tripod with Bluetooth remote.', 24.99, 90, 'https://example.com/images/smartphone-tripod.jpg', '2025-03-26 05:30:12', '2025-03-26 05:30:12'),
(8, 'Portable SSD', '1TB portable SSD with fast data transfer.', 149.99, 40, 'https://example.com/images/portable-ssd.jpg', '2025-03-26 05:30:12', '2025-03-26 05:30:12'),
(9, 'Smartwatch', 'Fitness tracker with heart rate monitor and GPS.', 199.99, 30, 'https://example.com/images/smartwatch.jpg', '2025-03-26 05:30:12', '2025-03-26 05:30:12'),
(10, 'Bluetooth Speaker', 'Waterproof Bluetooth speaker with deep bass.', 89.99, 70, 'https://example.com/images/bluetooth-speaker.jpg', '2025-03-26 05:30:12', '2025-03-26 05:30:12'),
(11, 'Power Bank', '10,000mAh portable charger with fast charging support.', 39.99, 150, 'https://example.com/images/power-bank.jpg', '2025-03-26 05:30:12', '2025-03-26 05:30:12');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gqhHbYe9dQ918gAg0PV6yWhVbbGoDDIf8NmXqcBg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQlhpeVdCMjZ6cEIyS3lnQU90SHVOU0NETUU5Q0UyNVBnVWliTFhEUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1742884630),
('l7S0JQaf9PC1ouYu108M8AzYUWITUQRgavtnA3iY', NULL, '127.0.0.1', 'PostmanRuntime/7.43.2', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlV4bG1CaDdWOTVScmZkZDRYaUh2cnZ5cFo2cGRRR29nckVxZFU0MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1742884994),
('bwubdpWtIfh3joKnFe6wO57rsw0OFv8DwT5UGQMT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicGJmaEY3TVY0cHo3NGd6eDN4b3plaDNHRlZWcXQ4d2MwTHA2S0x2TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1742968367);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('success','failed','pending') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, 0.00, 'pending', '2025-03-26 05:25:30', '2025-03-26 05:25:30'),
(2, 12, 0.00, 'pending', '2025-03-26 05:31:49', '2025-03-26 05:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-03-25 01:00:37', '$2y$12$CQAe33pw9NxDFbZt/5cI8.TYY9GHiIL9gv2BddXma1tCSc9DzZUkO', 'tQWYCyvXNk', '2025-03-25 01:00:38', '2025-03-25 01:00:38');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
