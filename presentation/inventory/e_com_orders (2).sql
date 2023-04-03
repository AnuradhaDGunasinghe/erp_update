-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 09:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `main_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `e_com_orders`
--

CREATE TABLE `e_com_orders` (
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `platform` varchar(15) NOT NULL,
  `order_type` varchar(40) NOT NULL,
  `order_number` varchar(15) NOT NULL,
  `asin_sku_number` varchar(15) NOT NULL,
  `device` varchar(15) NOT NULL,
  `brand` varchar(15) NOT NULL,
  `model` varchar(50) NOT NULL,
  `processor` varchar(15) NOT NULL,
  `core` varchar(20) NOT NULL,
  `gen` varchar(20) NOT NULL,
  `speed` varchar(10) NOT NULL,
  `touch` varchar(10) NOT NULL,
  `screen_size` varchar(10) NOT NULL,
  `resolution` varchar(15) NOT NULL,
  `hdd_type` varchar(10) NOT NULL,
  `hdd_capacity` varchar(10) NOT NULL,
  `ram` varchar(10) NOT NULL,
  `os` varchar(40) NOT NULL,
  `inv_location` varchar(15) NOT NULL,
  `keybord_language` varchar(20) NOT NULL,
  `keybord_backlight` varchar(20) NOT NULL,
  `graphic_brand` varchar(30) NOT NULL,
  `graphic_capacity` varchar(10) NOT NULL,
  `charger_type` varchar(15) NOT NULL,
  `charger_watt` varchar(10) NOT NULL,
  `charger_pin` varchar(10) NOT NULL,
  `order_condition` varchar(15) NOT NULL,
  `packing_type` varchar(15) NOT NULL,
  `shipping_method` varchar(20) NOT NULL,
  `qty` decimal(5,0) NOT NULL,
  `unit_price` decimal(10,0) NOT NULL,
  `discount` decimal(5,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `created_by` int(20) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `e_com_orders`
--

INSERT INTO `e_com_orders` (`id`, `platform`, `order_type`, `order_number`, `asin_sku_number`, `device`, `brand`, `model`, `processor`, `core`, `gen`, `speed`, `touch`, `screen_size`, `resolution`, `hdd_type`, `hdd_capacity`, `ram`, `os`, `inv_location`, `keybord_language`, `keybord_backlight`, `graphic_brand`, `graphic_capacity`, `charger_type`, `charger_watt`, `charger_pin`, `order_condition`, `packing_type`, `shipping_method`, `qty`, `unit_price`, `discount`, `total`, `created_by`, `created_time`) VALUES
(0001, 'noon', '1', '12345', 'laptop', 'Dell', 'Latitude e5480', 'intel', 'i5-5200U', '5', '2.80GHz', '1', '14', '1366 x 768', 'SSD', '256', '8GB', 'Windows 10', 'wh-4', 'UK', '1', 'Nvidia', '4GB', '1', '1', '1', '1', '1', '1', '0', '0', '1000', '500', '500000', 0, '2023-03-08 13:00:06'),
(0002, 'none', 'FBP', '1231', '65765', 'laptop', 'dell', 'Thinkpad', 'intel', 'i5-5200U', '5', '1.80Ghz', 'Yes', '11.6', '1920 x 1080', 'SATA', '256', '2', 'chrome os', 'ecom_inventory', 'us', 'no', 'intel', '1', 'us', '65', 'blue', 'fully refurbish', 'single box', '--Select Shipping Me', '32', '22', '22', '2233', 11, '2023-03-08 13:28:16'),
(0003, 'none', 'FBP', '1231', '1231', 'laptop', 'dell', 'Thinkpad', 'intel', 'i5-5200U', '5', '1.80Ghz', 'Yes', '11.6', '1920 x 1080', 'SATA', '333GB', '4', 'chrome os', 'big_inventory', 'us', 'no', 'intel', '2', 'uk', '65', 'blue', 'a grade', 'single box', '--Select Shipping Me', '11', '111', '11', '111111', 11, '2023-03-08 13:30:05'),
(0004, 'Two', 'FBP', '', '222', 'laptop', 'dell', 'Thinkpad', 'intel', 'i5-5200U', '5', '1.80Ghz', 'Yes', '13.3', '1368 x 768', 'SSD', '512GB', '16', 'windows', 'big_inventory', 'germany', 'yes', 'nvidia', '6', 'uk', '65', 'blue', 'a grade', 'bulk packing', '--Select Shipping Me', '10', '1000', '10', '9000', 11, '2023-03-08 13:36:18'),
(0005, '', 'FBN', '', '123123', 'laptop', 'dell', 'Thinkpad', 'intel', 'i5-5200U', '5', '1.80Ghz', 'Yes', '11.6', '1920 x 1080', 'SATA', '256', '2', 'chrome os', 'ecom_inventory', 'us', 'no', 'intel', '2', 'us', '65', 'blue', 'fully refurbish', 'single box', '--Select Shipping Me', '23123', '2342', '323', '2324', 11, '2023-03-08 13:40:17'),
(0006, '', 'FBN', '', '123123', 'laptop', 'dell', 'Thinkpad', 'intel', 'i5-5200U', '5', '1.80Ghz', 'Yes', '11.6', '1920 x 1080', 'SATA', '256', '2', 'chrome os', 'ecom_inventory', 'us', 'no', 'intel', '2', 'us', '65', 'blue', 'fully refurbish', 'single box', '--Select Shipping Me', '23123', '2342', '323', '2324', 11, '2023-03-08 13:40:28'),
(0007, 'One', 'FBP', '', '12312', 'laptop', 'dell', 'Thinkpad', 'intel', 'i5-5200U', '5', '1.80Ghz', 'Yes', '11.6', '1920 x 1080', 'SATA', '256', '2', 'chrome os', 'ecom_inventory', 'us', 'no', 'intel', '1', 'us', '65', 'blue', 'fully refurbish', 'single box', '--Select Shipping Me', '231', '21', '12', '1231', 11, '2023-03-08 13:53:59'),
(0008, 'One', 'FBP', '', '12312', 'laptop', 'dell', 'Thinkpad', 'intel', 'i5-5200U', '5', '1.80Ghz', 'Yes', '11.6', '1920 x 1080', 'SATA', '256', '2', 'chrome os', 'ecom_inventory', 'us', 'no', 'intel', '1', 'us', '65', 'blue', 'fully refurbish', 'single box', '--Select Shipping Me', '231', '21', '12', '1231', 11, '2023-03-08 14:58:39'),
(0009, 'One', 'FBP', '', '12312', 'laptop', 'dell', 'Thinkpad', 'intel', 'i5-5200U', '5', '1.80Ghz', 'Yes', '11.6', '1920 x 1080', 'SATA', '256', '2', 'chrome os', 'ecom_inventory', 'us', 'no', 'intel', '1', 'us', '65', 'blue', 'fully refurbish', 'single box', '--Select Shipping Me', '231', '21', '12', '1231', 11, '2023-03-08 14:58:45'),
(0010, 'alsakb', 'FBP', '', '123123', 'laptop', 'dell', 'Thinkpad', 'intel', 'i5-5200U', '5', '1.80Ghz', 'Yes', '17.3', '1368 x 768', 'SSD', '512GB', '16', 'chrome os', 'big_inventory', 'germany', 'yes', 'nvidia', '4', 'eu', '65', 'yellow', 'a grade', 'single box', 'DHL', '10', '100', '10', '90', 11, '2023-03-08 15:07:59'),
(0011, 'alsakb', 'FBN', '', '123123', 'laptop', 'dell', 'Thinkpad', 'intel', 'i5-5200U', '5', '1.80Ghz', 'Yes', '12', '1368 x 768', 'SATA', '333GB', '8', 'linux', 'big_inventory', 'french', 'yes', 'amd', '2', 'uk', '65', 'yellow', 'a grade', 'bulk packing', 'UPS', '11', '11', '111', '2323', 11, '2023-03-08 15:20:35'),
(0012, 'amazon.ae', 'FBN', '1234555', '555555', 'laptop', 'dell', 'Thinkpad', 'intel', 'i5-5200U', '5', '1.80Ghz', 'Yes', '11.6', '1920 x 1080', 'SATA', '256', '2', 'chrome os', 'ecom_inventory', 'us', 'no', 'intel', '1', 'us', '65', 'blue', 'fully refurbish', 'single box', 'UPS', '231', '213', '12', '2131231', 11, '2023-03-08 15:22:38'),
(0013, '', 'FBN', '', '', '', 'dell', '', 'intel', '', '5', '', 'no', '11.6', '1920 x 1080', 'SATA', '', '--Select R', 'windows', '--Select Invent', 'french', 'no', '--Select Graphic Type--', '--Select G', '--Select Charge', '--Select C', '--Select P', '--Select Condit', '--Select Packin', 'UPS', '0', '0', '0', '0', 11, '2023-03-08 15:28:43'),
(0014, '', 'FBN', '', '', '', 'dell', '', 'intel', '', '5', '', 'no', '11.6', '1920 x 1080', 'SATA', '', '--Select R', 'windows', '--Select Invent', 'us', 'no', '--Select Graphic Type--', '--Select G', '--Select Charge', '--Select C', '--Select P', '--Select Condit', '--Select Packin', 'UPS', '0', '0', '0', '0', 11, '2023-03-08 15:29:03'),
(0015, '', 'FBN', '12312', '12312', '', 'dell', '', 'intel', '', '5', '', 'no', '12', '1368 x 768', 'SATA', '', '--Select R', 'windows', '--Select Invent', 'french', 'no', '--Select Graphic Type--', '--Select G', '--Select Charge', '--Select C', '--Select P', '--Select Condit', '--Select Packin', 'UPS', '0', '0', '0', '0', 11, '2023-03-08 15:31:08'),
(0016, '', 'FBN', '', '', '', 'dell', '', 'intel', '', '5', '', 'no', '11.6', '1920 x 1080', 'SATA', '', '--Select R', 'windows', '--Select Invent', 'french', 'no', '--Select Graphic Type--', '--Select G', '--Select Charge', '--Select C', '--Select P', '--Select Condit', '--Select Packin', 'UPS', '0', '0', '0', '0', 11, '2023-03-08 15:31:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `e_com_orders`
--
ALTER TABLE `e_com_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `e_com_orders`
--
ALTER TABLE `e_com_orders`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
