-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2020 at 02:36 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `order_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `a_id` int(11) NOT NULL,
  `a_first_name` varchar(255) NOT NULL,
  `a_last_name` varchar(255) NOT NULL,
  `a_percentage` varchar(11) DEFAULT NULL,
  `a_contact_number` varchar(20) NOT NULL,
  `a_country_id` int(11) NOT NULL,
  `a_state_id` int(11) NOT NULL,
  `create_on` varchar(255) DEFAULT NULL,
  `update_on` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `created_on` varchar(255) NOT NULL,
  `updated_on` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'uk'),
(2, 'usa'),
(3, 'canada'),
(4, 'ireland');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postalCode` varchar(255) DEFAULT NULL,
  `customer_notes` longtext DEFAULT NULL,
  `c_payment_method` varchar(255) DEFAULT NULL,
  `card_type` varchar(50) DEFAULT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `cvv_number` varchar(5) DEFAULT NULL,
  `expiry_date` varchar(10) DEFAULT NULL,
  `added_by` varchar(50) DEFAULT NULL,
  `added_on` varchar(50) DEFAULT NULL,
  `update_on` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) UNSIGNED NOT NULL,
  `vender_id` int(11) NOT NULL,
  `orderNo` varchar(255) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_quantity` int(5) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `ship_date` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) DEFAULT '1',
  `order_date` varchar(255) DEFAULT NULL,
  `deliver_date` varchar(255) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `postal_code` varchar(255) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `tracking_id` varchar(255) DEFAULT NULL,
  `o_create_on` varchar(255) DEFAULT NULL,
  `o_update_on` varchar(255) DEFAULT NULL,
  `deleted` varchar(10) DEFAULT 'no',
  `sell_product_cost` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL,
  `agent` varchar(255) DEFAULT NULL,
  `agent_percentage` varchar(15) DEFAULT NULL,
  `card_type` varchar(255) DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `cvv_number` varchar(255) DEFAULT NULL,
  `card_ex_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `o_h_id` int(11) NOT NULL,
  `o_h_order_id` int(11) DEFAULT NULL,
  `o_h_tracking_id` int(11) NOT NULL,
  `o_h_amount` varchar(255) DEFAULT NULL,
  `o_h_status` varchar(255) DEFAULT NULL,
  `o_h_update_on` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `pm_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `percentage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`pm_id`, `payment_method`, `percentage`) VALUES
(1, 'bank', NULL),
(2, 'cradit card', NULL),
(3, 'cash app', '10'),
(4, 'vemo', '11'),
(5, 'pay pal', '12'),
(6, 'zell', '13');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `prize` int(11) DEFAULT NULL,
  `product_qunatity` int(11) NOT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `created_on` varchar(255) NOT NULL,
  `updated_on` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(255) DEFAULT NULL,
  `country_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_name`, `country_id`) VALUES
(1, 'california', '2'),
(2, 'texas', '2'),
(3, 'florida', '2'),
(4, 'ohio', '2'),
(5, 'new jarsey', '2'),
(6, ' virginia', '2'),
(7, 'South Carolina', '2'),
(8, 'New York', '2'),
(9, 'New Mexico', '2'),
(10, 'df', '3'),
(11, 'sdfd', '3'),
(12, 'sdfsd', '3'),
(13, 'sdfa', '3'),
(14, 'sdfasd', '3'),
(15, 'fdg', '1'),
(16, 'gdf', '1'),
(17, 'gdsfg', '1'),
(18, 'dsf', '1'),
(19, 'gdf', '1'),
(20, 'gsdfg', '1'),
(21, 'sfdg', '1'),
(22, 'fgf', '4'),
(23, 'dfg', '4'),
(24, 'dfg', '4'),
(25, 'sdf', '4'),
(26, 'gdf', '4');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `s_id` int(11) NOT NULL,
  `s_product_id` int(11) NOT NULL,
  `s_product_qunatity` varchar(255) NOT NULL,
  `s_create_on` varchar(255) DEFAULT NULL,
  `s_update_on` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `roll_id` tinyint(1) DEFAULT 3,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `created_on` varchar(255) DEFAULT NULL,
  `update_on` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `username`, `email`, `password`, `image`, `status`, `roll_id`, `phone_number`, `address`, `country_id`, `created_on`, `update_on`, `site`) VALUES
(1, 'raja', 'dayo', '', 'r.dayo@gmail.com', '123', 'avatar-01.jpg', '1', 1, '03048917309', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `UNIQUE` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`o_h_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`pm_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `o_h_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `pm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
