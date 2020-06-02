-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2020 at 01:00 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `furniture_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_date` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `total` float NOT NULL,
  `disc_perc` float NOT NULL,
  `disc_amt` float NOT NULL,
  `grand_total` float NOT NULL,
  `booking_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_type_id`, `user_id`, `booking_date`, `date_updated`, `total`, `disc_perc`, `disc_amt`, `grand_total`, `booking_status_id`) VALUES
(5, 1, 2, '2020-02-01 17:55:22', '2020-02-01 17:55:22', 250, 0, 0, 250, 0),
(6, 1, 2, '2020-02-03 16:01:18', '2020-02-03 16:01:18', 570, 0, 0, 570, 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking_product_map`
--

CREATE TABLE `booking_product_map` (
  `bpm_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `rate` float NOT NULL,
  `gst` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_product_map`
--

INSERT INTO `booking_product_map` (`bpm_id`, `booking_id`, `product_id`, `qty`, `from_date`, `to_date`, `rate`, `gst`, `total`) VALUES
(6, 5, 1, 1, '2020-02-01 05:55:22', '2020-03-01 05:55:22', 120, 0, 120),
(7, 5, 2, 1, '2020-02-01 05:55:22', '2020-04-01 05:55:22', 130, 0, 130),
(8, 6, 3, 1, '2020-02-03 04:01:18', '2020-03-03 04:01:18', 120, 0, 120),
(9, 6, 5, 1, '2020-02-03 04:01:18', '2020-04-03 04:01:18', 120, 0, 120),
(10, 6, 6, 1, '2020-02-03 04:01:18', '2020-05-03 04:01:18', 130, 0, 130),
(11, 6, 9, 1, '2020-02-03 04:01:18', '2020-06-03 04:01:18', 200, 0, 200);

-- --------------------------------------------------------

--
-- Table structure for table `booking_status`
--

CREATE TABLE `booking_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `cat_name`, `date_created`, `date_updated`) VALUES
(1, 'chair', '2020-01-15 06:00:00', '2020-02-20 00:00:00'),
(2, 'table', '2020-01-24 17:49:54', '2020-01-24 17:49:54'),
(3, 'sofa', '2020-01-24 17:51:47', '2020-01-24 17:51:47'),
(4, 'dining', '2020-01-24 17:51:47', '2020-01-24 17:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `buying_price` float NOT NULL,
  `renting_price_per_day` float NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `category_id`, `buying_price`, `renting_price_per_day`, `date_created`, `date_updated`) VALUES
(1, 'Chair 1', 1, 10000, 120, '2020-01-24 17:56:52', '2020-01-24 17:56:52'),
(2, 'Chair 2', 1, 11000, 130, '2020-01-24 17:56:52', '2020-01-24 17:56:52'),
(3, 'Chair 3', 1, 11000, 120, '2020-01-24 17:56:52', '2020-01-24 17:56:52'),
(4, 'Chair 4', 1, 11000, 130, '2020-01-24 17:58:41', '2020-01-24 17:58:41'),
(5, 'Table 1', 2, 10000, 120, '2020-01-24 17:56:52', '2020-01-24 17:56:52'),
(6, 'Table 2', 2, 11000, 130, '2020-01-24 17:56:52', '2020-01-24 17:56:52'),
(7, 'Table 3', 2, 11000, 120, '2020-01-24 17:56:52', '2020-01-24 17:56:52'),
(8, 'Table 4', 2, 11000, 130, '2020-01-24 17:58:41', '2020-01-24 17:58:41'),
(9, 'Sofa 1', 3, 15000, 200, '2020-01-24 17:56:52', '2020-01-24 17:56:52'),
(10, 'Sofa 2', 3, 20000, 300, '2020-01-24 17:56:52', '2020-01-24 17:56:52'),
(11, 'Sofa 3', 3, 25000, 500, '2020-01-24 17:56:52', '2020-01-24 17:56:52'),
(12, 'Sofa 4', 3, 13000, 130, '2020-01-24 17:58:41', '2020-01-24 17:58:41'),
(13, 'Dining 1', 4, 30000, 1000, '2020-01-24 17:56:52', '2020-01-24 17:56:52'),
(14, 'Dining 2', 4, 25000, 700, '2020-01-24 17:56:52', '2020-01-24 17:56:52'),
(15, 'Dining 3', 4, 28000, 500, '2020-01-24 17:56:52', '2020-01-24 17:56:52'),
(16, 'Dining 4', 4, 24000, 450, '2020-01-24 17:58:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `pin_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type_id`, `email_id`, `password`, `first_name`, `last_name`, `phone`, `city`, `address`, `pin_code`) VALUES
(1, 1, 'friendlyabhi143@gmail.com', 'abhi1436', 'Abhilash', 'Managave', 9632813323, 'Belagavi', 'bgm', 591323),
(2, 1, 'abhisheknair135@gmail.com', 'abhi', 'Abhishek', 'Nair', 9737047650, 'Belagavi', 'Amli, Silvassa', 396230);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `user_type_id` int(11) NOT NULL,
  `user_type_name` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`user_type_id`, `user_type_name`, `date_created`, `date_updated`) VALUES
(1, 'User', '2020-01-23 12:22:07', '2020-01-23 12:22:07'),
(2, 'Admin', '2020-01-23 12:23:03', '2020-01-23 12:23:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `booking_product_map`
--
ALTER TABLE `booking_product_map`
  ADD PRIMARY KEY (`bpm_id`);

--
-- Indexes for table `booking_status`
--
ALTER TABLE `booking_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `booking_product_map`
--
ALTER TABLE `booking_product_map`
  MODIFY `bpm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `booking_status`
--
ALTER TABLE `booking_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
