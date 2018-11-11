-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2018 at 03:13 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `user_id` int(10) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`user_id`, `user_email`, `user_password`) VALUES
(1, 'uma@uma.com', 'uma'),
(2, 'laxmi@laxmi.com', 'laxmi');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(100) NOT NULL,
  `brand_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'HP'),
(2, 'DELL'),
(3, 'LG'),
(4, 'Samsung'),
(5, 'Apple'),
(6, 'Sony Ericsson'),
(7, 'Nikon');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_key` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_key`, `p_id`, `ip_add`, `qty`) VALUES
(15, 6, '::1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Laptops'),
(2, 'Cameras'),
(3, 'Mobiles'),
(4, 'Computers'),
(5, 'iPads'),
(7, 'Printers'),
(9, 'Watchezzzzzzz');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(10) NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_ip`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`) VALUES
(2, '::1', 'Dhruv', 'dhruv@gmail.com', 'dhruv', 'Nepal', 'Kathmandu', '1234512345', 'House no:903,Dhruv street, dhruv house. My life my rules.', 'men_white.jpeg'),
(3, '::1', 'Uma Rani', 'umarani@yahoo.com', 'umarani', 'United states', 'New York', '6785675673', 'Block no:mera, Street: tera, NY, US', 'cute_girl.jpeg'),
(4, '::1', 'Shanu', 'shanu@gmail.com', 'shanu', 'Russia', 'Moscow', '3455433455', '456/B, Apni lane, apna city, apna country', 'beautiful_smile.jpeg'),
(8, '::1', 'Nidhi Tripathi', 'nidhi@hotmail.com', 'nidhi', 'United states', 'New York', '0834534576', 'B/76, Nidhi housing, Lane number:48, Sir Mount street, New yourk, US', 'smile_lady.jpeg'),
(9, '::1', 'ashok', 'tripathiashok@gmail.com', 'chinmay@1234', 'India', 'New Delhi', '8902718753', 'palam', 'smile_boy.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_brand` int(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keyword` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keyword`) VALUES
(5, 1, 1, 'HP LED laptop', 60000, '<p>HP laptop with LED display and parallel processing.</p>', 'HP_laptop.jpg', 'HP, LED, computer, desktop, Pavillion'),
(6, 6, 3, 'LG tablet', 35000, '<p>Marvellous speed, lucious looks, gorilla glass with LG tablet.</p>', 'tablet.jpeg', 'LG, tablet'),
(7, 4, 1, 'HP LED desktop', 50000, '<p>HP Pavillion all in one desktop with light screen and in built processing unit. No bulgy screen outside.</p>', 'hp-desktops-500x500.png', 'HP, LED, computer, desktop, Pavillion'),
(16, 5, 5, 'APPLE iPad pro', 75000, '<p>Apple ipad pro with dual quad core processor.</p>', 'iPad-Pro-No-Watermark-67.jpg', 'APPLE, iPad'),
(17, 2, 4, 'Samsung camera', 30000, '<p>Samsung camera with bi-focal length.</p>', 'samsung-camera.jpg', 'SAMSUNG, camera'),
(18, 3, 6, 'Sony 395W', 16000, '<p>Sony ericssson mobile worth 16,000 only with a digital GPS default enabled.</p>', 'sony_ericsson_w800_w910_w300_1483966438658.png', 'Sony ericsson, mobile'),
(19, 2, 4, 'SAMSUNG camera', 105000, '<p>SAMSUNG camera</p>\r\n<ul>\r\n<li>high-resolution</li>\r\n<li>bi-focal lens</li>\r\n<li>thermal colors</li>\r\n</ul>', 'camera.jpeg', 'samsung, camera'),
(20, 3, 6, 'Sony ericsson XP pro', 55000, '<p>A fabulous double screen phone with water resistance and heat-less long running phone. Hurry up.</p>', '152_xperia-pro-1.jpg', 'Sony ericsson, mobile'),
(21, 1, 5, 'Apple macintosh', 90000, '<p>Apple macintosh with high resolution picture display and glowing screen.</p>', 'Apple_laptop.jpg', 'Apple, laptop, macintosh, mac'),
(23, 1, 4, 'Dummy12345', 711, '<p>Dummy12345</p>', 'nikon-p1000-main.jpg', 'Dummy12345'),
(24, 4, 2, 'Dummy product', 123, '<p>Dummy product</p>', 'nikon-p1000-main.jpg', 'Dummy product');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_key` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
