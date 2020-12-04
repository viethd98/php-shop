-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 11:57 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test1`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'EtlvF', '2019-08-26 10:52:54', '2019-08-26 10:52:54'),
(2, 'LItQO', '2019-08-26 11:40:50', '2019-08-26 11:40:50'),
(4, 'uMbxb', '2019-08-27 04:08:01', '2019-08-27 04:08:01'),
(8, 'oNgNI', '2019-08-27 12:37:44', '2019-08-27 12:37:44'),
(9, 'YFgri', '2019-08-27 13:06:54', '2019-08-27 13:06:54'),
(10, 'bLMbv', '2019-08-27 13:12:47', '2019-08-27 13:12:47'),
(11, 'PrSSI', '2020-12-04 04:02:57', '2020-12-04 04:02:57');

-- --------------------------------------------------------

--
-- Table structure for table `cart_products`
--

CREATE TABLE `cart_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `cart_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `product_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `category_name` varchar(250) DEFAULT NULL COMMENT 'last edited category name',
  `name` varchar(250) DEFAULT NULL COMMENT 'last edited product name',
  `description` text DEFAULT NULL COMMENT 'last edited product description',
  `price` float DEFAULT NULL COMMENT 'last edited price',
  `images` text DEFAULT NULL,
  `quantity` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `cart_products`
--

INSERT INTO `cart_products` (`id`, `cart_id`, `product_id`, `category_id`, `category_name`, `name`, `description`, `price`, `images`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 2, 'Elektronik', 'Gold Mini Speaker', '', 40000, '[\"http://192.168.1.89/shopping-cart/public/images/products/gold-mini-speaker-20190826030718-0.jpg\"]', 1, '2019-08-26 10:55:18', '2019-08-26 11:06:12'),
(2, 1, 4, 2, 'Elektronik', 'Mini USB Fan', '', 25000, '[\"http://192.168.1.89/shopping-cart/public/images/products/mini-fan-20190826025941-0.jpg\"]', 1, '2019-08-26 10:59:05', '2019-08-26 11:05:48'),
(4, 1, 8, 3, 'Rumah Tangga', 'Pengupas Mie', '', 40000, '[\"http://192.168.1.89/shopping-cart/public/images/products/pengupas-mie-20190826130430-0.jpg\",\"http://192.168.1.89/shopping-cart/public/images/products/pengupas-mie-20190826130430-1.jpg\"]', 1, '2019-08-26 11:06:23', '2019-08-26 11:06:23'),
(7, 2, 10, 1, 'Alat Tulis Kantor', 'Kotak Pensil', '', 25000, '[\"http://192.168.1.89/shopping-cart/public/images/products/kotak-pensil-20190826130534-0.jpg\"]', 1, '2019-08-26 11:41:02', '2019-08-26 11:41:02'),
(8, 2, 9, 1, 'Alat Tulis Kantor', 'Deli Tempat Alat Tulis', '', 120000, '[\"http://192.168.1.89/shopping-cart/public/images/products/deli-tempat-alat-tulis-20190826130511-0.jpg\"]', 1, '2019-08-26 11:41:05', '2019-08-26 11:41:05'),
(9, 1, 1, 2, 'Elektronik', 'Caddy Disk DVD', 'Caddy Disk untuk external Hardisk.\r\nMenggunakan slot DVD.', 135000, '[\"http://192.168.1.89/shopping-cart/public/images/products/caddy-disk-dvd-20190826025555-0.jpg\",\"http://192.168.1.89/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-0.jpg\",\"http://192.168.1.89/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-1.jpg\",\"http://192.168.1.89/shopping-cart/public/images/products/caddy-disk-dvd-20190826025630-2.jpg\"]', 1, '2019-08-26 11:50:25', '2019-08-26 11:50:25'),
(13, 4, 9, 1, 'Alat Tulis Kantor', 'Deli Tempat Alat Tulis', '', 120000, '[\"http://192.168.1.89/shopping-cart/public/images/products/deli-tempat-alat-tulis-20190826130511-0.jpg\"]', 1, '2019-08-27 04:08:01', '2019-08-27 04:08:13'),
(14, 4, 10, 1, 'Alat Tulis Kantor', 'Kotak Pensil', '', 25000, '[\"http://192.168.1.89/shopping-cart/public/images/products/kotak-pensil-20190826130534-0.jpg\"]', 1, '2019-08-27 04:08:07', '2019-08-27 04:08:07'),
(22, 8, 9, 1, 'Alat Tulis Kantor', 'Deli Tempat Alat Tulis', '', 120000, '[\"http://localhost/shopping-cart/public/images/products/deli-tempat-alat-tulis-20190826130511-0.jpg\"]', 1, '2019-08-27 12:37:44', '2019-08-27 12:37:44'),
(23, 9, 9, 1, 'Alat Tulis Kantor', 'Deli Tempat Alat Tulis', '', 120000, '[\"http://192.168.1.89/shopping-cart/public/images/products/deli-tempat-alat-tulis-20190826130511-0.jpg\"]', 1, '2019-08-27 13:06:54', '2019-08-27 13:06:54'),
(24, 10, 10, 1, 'Alat Tulis Kantor', 'Kotak Pensil', '', 25000, '[\"http://192.168.1.89/shopping-cart/public/images/products/kotak-pensil-20190826130534-0.jpg\"]', 1, '2019-08-27 13:12:47', '2019-08-27 13:12:47'),
(31, 11, 9, 1, 'Alat Tulis Kantor', 'Deli Tempat Alat Tulis', '', 120000, '[\"http://localhost/shoping-cart/public/images/products/deli-tempat-alat-tulis-20190826130511-0.jpg\"]', 1, '2020-12-04 04:46:46', '2020-12-04 04:46:46');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `slug` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `slug`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 'alat-tulis-kantor', 'Alat Tulis Kantor', '', '2019-08-25 19:54:39', '2019-08-27 13:07:47'),
(2, 0, 'elektronik', 'Elektronik', '', '2019-08-25 19:54:51', '2019-08-25 19:54:51'),
(3, 0, 'rumah-tangga', 'Rumah Tangga', '', '2019-08-26 05:55:44', '2019-08-26 05:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(8) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL COMMENT 'User Order Name',
  `address` text DEFAULT NULL COMMENT 'User Order Address',
  `total_price` float UNSIGNED DEFAULT NULL,
  `payment` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `product_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `category_name` varchar(250) DEFAULT NULL COMMENT 'last edited category name',
  `name` varchar(250) DEFAULT NULL COMMENT 'last edited product name',
  `description` text DEFAULT NULL COMMENT 'last edited product description',
  `price` float DEFAULT NULL COMMENT 'last edited price',
  `images` text DEFAULT NULL,
  `quantity` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `slug` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` float DEFAULT NULL,
  `images` text DEFAULT NULL,
  `quantity` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `slug`, `name`, `description`, `price`, `images`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 2, 'caddy-disk-dvd', 'Caddy Disk DVD', 'Caddy Disk untuk external Hardisk.\r\nMenggunakan slot DVD.', 135000, '[\"http://localhost/shoping-cart/public/images/products/caddy-disk-dvd-20190826025555-0.jpg\",\"http://localhost/shoping-cart/public/images/products/caddy-disk-dvd-20190826025630-0.jpg\",\"http://localhost/shoping-cart/public/images/products/caddy-disk-dvd-20190826025630-1.jpg\",\"http://localhost/shoping-cart/public/images/products/caddy-disk-dvd-20190826025630-2.jpg\"]', 4, '2019-08-23 04:55:56', '2019-08-27 04:15:27'),
(2, 2, 'mini-bluetooth-speaker', 'Mini Bluetooth Speaker', 'Menggunakan Bluetooth atau SD Card', 60000, '[\"http://localhost/shoping-cart/public/images/products/mini-bluetooth-speaker-20190826025714-0.png\",\"http://localhost/shoping-cart/public/images/products/mini-bluetooth-speaker-20190826025714-1.jpg\"]', 10, '2019-08-23 04:57:22', '2019-08-27 04:12:18'),
(4, 2, 'mini-fan', 'Mini USB Fan', '', 25000, '[\"http://localhost/shoping-cart/public/images/products/mini-fan-20190826025941-0.jpg\"]', 10, '2019-08-25 19:59:41', '2019-08-27 04:12:29'),
(6, 2, 'gold-mini-speaker', 'Gold Mini Speaker', '', 40000, '[\"http://localhost/shoping-cart/public/images/products/gold-mini-speaker-20190826030718-0.jpg\"]', 9, '2019-08-25 20:07:18', '2019-08-27 04:12:07'),
(8, 3, 'pengupas-mie', 'Pengupas Mie', '', 40000, '[\"http://localhost/shoping-cart/public/images/products/pengupas-mie-20190826130430-0.jpg\",\"http://localhost/shoping-cart/public/images/products/pengupas-mie-20190826130430-1.jpg\"]', 8, '2019-08-26 06:04:30', '2019-08-27 04:12:57'),
(9, 1, 'deli-tempat-alat-tulis', 'Deli Tempat Alat Tulis', '', 120000, '[\"http://localhost/shoping-cart/public/images/products/deli-tempat-alat-tulis-20190826130511-0.jpg\"]', 3, '2019-08-26 06:05:11', '2019-08-27 13:13:02'),
(10, 1, 'kotak-pensil', 'Kotak Pensil', '', 25000, '[\"http://localhost/shoping-cart/public/images/products/kotak-pensil-20190826130534-0.jpg\"]', 5, '2019-08-26 06:05:34', '2019-08-27 04:11:42'),
(11, 3, 'set-sendok-masak', 'Set Sendok Masak', '', 82000, '[\"http://localhost/shoping-cart/public/images/products/set-sendok-masak-20190826130606-0.jpg\"]', 10, '2019-08-26 06:06:06', '2019-08-27 12:33:32'),
(12, 1, 'jam-digital-lucu', 'Jam Digital Lucu', '', 44000, '[\"http://localhost/shoping-cart/public/images/products/jam-digital-lucu-20190826130658-0.jpg\",\"http://localhost/shoping-cart/public/images/products/jam-digital-lucu-20190826130658-1.jpg\",\"http://localhost/shoping-cart/public/images/products/jam-digital-lucu-20190826130658-2.jpg\"]', 10, '2019-08-26 06:06:58', '2019-08-27 04:15:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_products`
--
ALTER TABLE `cart_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart_products`
--
ALTER TABLE `cart_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
