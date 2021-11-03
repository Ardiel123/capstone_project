-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2021 at 01:02 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tradebay_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_tbl`
--

CREATE TABLE `account_tbl` (
  `account_id` int(10) NOT NULL,
  `verification_key` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_tbl`
--

INSERT INTO `account_tbl` (`account_id`, `verification_key`, `status`, `username`, `password`, `usertype`) VALUES
(7, 'e01cf75af1ee04bd991cb7a082377d94', 1, 'diel', 'bea735f03eee25e276ece7e4dc0a4c10', 'customer'),
(14, 'f59d2bc8a893efc3a67048992ba04425', 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(15, '43028b357555317171b58046a7ee63d9', 1, 'ardiel', '801365345c20fec90cf26e0d2109ef6e', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(15) NOT NULL,
  `admin_fname` varchar(255) NOT NULL,
  `admin_lname` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `account_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `admin_fname`, `admin_lname`, `admin_email`, `date_created`, `account_id`) VALUES
(2018101782, 'Ardiel', 'Salatamos', 'salatamos.ardiel@gmail.com', '2021-09-17 06:05:41', 14);

-- --------------------------------------------------------

--
-- Table structure for table `announcement_tbl`
--

CREATE TABLE `announcement_tbl` (
  `announcement_id` int(10) NOT NULL,
  `date_published` date NOT NULL DEFAULT current_timestamp(),
  `content` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `admin_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement_tbl`
--

INSERT INTO `announcement_tbl` (`announcement_id`, `date_published`, `content`, `image`, `admin_id`) VALUES
(1, '2021-10-09', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,', 'img/mushroom.jpg', 2018101782),
(2, '2021-10-11', 'hahahahaha', 'img/kape.jpg', 2018101782),
(3, '2021-10-12', 'jimuuuelllllll', 'img/fertilizer.jpg', 2018101782);

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_tbl`
--

INSERT INTO `category_tbl` (`category_id`, `category_name`) VALUES
(1, 'food\r\n'),
(2, 'drink');

-- --------------------------------------------------------

--
-- Table structure for table `customer_tbl`
--

CREATE TABLE `customer_tbl` (
  `customer_id` int(10) NOT NULL,
  `customer_fname` varchar(255) NOT NULL,
  `customer_lname` varchar(255) NOT NULL,
  `house_no` int(10) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phonenumber` varchar(15) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `account_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_tbl`
--

INSERT INTO `customer_tbl` (`customer_id`, `customer_fname`, `customer_lname`, `house_no`, `barangay`, `city`, `province`, `customer_email`, `customer_phonenumber`, `date_created`, `account_id`) VALUES
(13, 'Diel', 'Salatamos', 136, 'Malasin', 'Santo Domingo', 'Nueva Ecija', 'ardielsalatamos24@gmail.com', '09301795886', '2021-11-03 00:43:55', 7),
(19, 'ardiel', 'ardiel', 222, 'asdsadsadsad', 'sadsad', 'asdasdasd', 'sadasdas@gmail.com', '0938833', '2021-09-28 10:09:57', 15);

-- --------------------------------------------------------

--
-- Table structure for table `order_details_tbl`
--

CREATE TABLE `order_details_tbl` (
  `order_details_id` int(10) NOT NULL,
  `date_ordered` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` float NOT NULL,
  `status_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `payment_type_id` int(10) NOT NULL,
  `shipping_details_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details_tbl`
--

INSERT INTO `order_details_tbl` (`order_details_id`, `date_ordered`, `status_date`, `total`, `status_id`, `customer_id`, `payment_type_id`, `shipping_details_id`) VALUES
(56, '2021-09-17 05:51:38', '2021-09-28 07:39:53', 155, 2, 13, 2, 20),
(57, '2021-09-17 06:09:28', '2021-09-28 07:39:53', 450, 2, 13, 1, 21),
(58, '2021-09-24 13:27:38', '2021-09-26 13:11:57', 100, 2, 13, 1, 22),
(59, '2021-09-26 07:59:45', '2021-09-26 13:11:57', 150, 2, 13, 1, 23),
(60, '2021-09-26 07:59:47', '2021-09-26 13:11:57', 150, 2, 13, 1, 24),
(61, '2021-09-26 07:59:52', '2021-09-26 13:11:57', 5, 2, 13, 1, 25),
(62, '2021-09-26 08:00:00', '2021-09-26 13:11:57', 6, 2, 13, 1, 26),
(63, '2021-09-26 08:00:06', '2021-09-28 07:47:44', 230, 5, 13, 1, 27),
(64, '2021-09-26 08:00:08', '2021-09-28 07:47:44', 230, 5, 13, 1, 28),
(65, '2021-09-26 08:00:10', '2021-09-28 07:47:44', 230, 5, 13, 1, 29),
(66, '2021-09-26 08:00:11', '2021-09-26 13:11:57', 230, 2, 13, 1, 30),
(67, '2021-09-26 08:00:13', '2021-09-26 13:11:57', 230, 2, 13, 1, 31),
(68, '2021-09-26 08:00:16', '2021-09-26 13:11:57', 920, 2, 13, 1, 32),
(69, '2021-09-26 08:00:18', '2021-09-26 13:11:57', 230, 2, 13, 1, 33),
(71, '2021-09-28 10:10:55', '2021-09-28 10:10:55', 140, 1, 19, 1, 35),
(72, '2021-09-28 10:11:05', '2021-09-28 10:11:05', 290, 1, 19, 1, 36),
(73, '2021-10-04 02:53:29', '2021-10-05 23:37:07', 3000, 3, 13, 1, 43),
(74, '2021-10-04 02:54:29', '2021-10-04 02:54:29', 1650, 1, 13, 1, 44),
(75, '2021-10-04 02:55:21', '2021-10-04 02:55:21', 2, 1, 13, 1, 45),
(76, '2021-10-05 02:25:38', '2021-10-05 02:25:38', 750.6, 1, 13, 1, 46),
(77, '2021-10-11 12:36:52', '2021-10-11 12:36:52', 1200, 1, 13, 1, 48);

-- --------------------------------------------------------

--
-- Table structure for table `order_items_tbl`
--

CREATE TABLE `order_items_tbl` (
  `order_items_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `current_price` float NOT NULL,
  `product_variation_id` int(10) NOT NULL,
  `order_details_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items_tbl`
--

INSERT INTO `order_items_tbl` (`order_items_id`, `quantity`, `current_price`, `product_variation_id`, `order_details_id`) VALUES
(56, 1, 150, 47, 56),
(57, 1, 5, 49, 56),
(58, 1, 300, 45, 57),
(59, 1, 150, 47, 57),
(60, 1, 100, 57, 58),
(61, 1, 150, 47, 59),
(62, 1, 150, 47, 60),
(63, 1, 5, 49, 61),
(64, 3, 2, 56, 62),
(65, 1, 230, 53, 63),
(66, 1, 230, 53, 64),
(67, 1, 230, 53, 65),
(68, 1, 230, 53, 66),
(69, 1, 230, 53, 67),
(70, 4, 230, 53, 68),
(71, 1, 230, 53, 69),
(73, 2, 70, 51, 71),
(74, 1, 150, 47, 72),
(75, 2, 70, 51, 72),
(76, 21, 150, 47, 73),
(77, 12, 150, 47, 74),
(78, 1, 2, 56, 75),
(79, 1, 300, 45, 76),
(80, 1, 50.6, 48, 76),
(81, 2, 150, 47, 76),
(82, 1, 100, 57, 76),
(83, 8, 150, 47, 77);

-- --------------------------------------------------------

--
-- Table structure for table `payment_type_tbl`
--

CREATE TABLE `payment_type_tbl` (
  `payment_type_id` int(10) NOT NULL,
  `payment_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_type_tbl`
--

INSERT INTO `payment_type_tbl` (`payment_type_id`, `payment_description`) VALUES
(1, 'Cash on delivery'),
(2, 'Pick up - Payment upon pick up');

-- --------------------------------------------------------

--
-- Table structure for table `printing_service_tbl`
--

CREATE TABLE `printing_service_tbl` (
  `printing_service_id` int(10) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `print_service_image` varchar(255) NOT NULL,
  `date_placed` timestamp NOT NULL DEFAULT current_timestamp(),
  `print_service_size` varchar(255) NOT NULL,
  `print_service_quantity` int(10) NOT NULL,
  `print_service_total` int(10) NOT NULL,
  `status_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customer_id` int(10) NOT NULL,
  `status_id` int(10) NOT NULL,
  `payment_type_id` int(10) NOT NULL,
  `shipping_details_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `printing_service_tbl`
--

INSERT INTO `printing_service_tbl` (`printing_service_id`, `service_type`, `print_service_image`, `date_placed`, `print_service_size`, `print_service_quantity`, `print_service_total`, `status_date`, `customer_id`, `status_id`, `payment_type_id`, `shipping_details_id`) VALUES
(6, 'tarpaulin', 'printimg/fd9bc1d2b6898c703cd39f8ab0650dae.png', '2021-09-28 11:53:11', '2x2', 1, 800, '2021-09-28 11:55:10', 19, 2, 1, 42),
(7, 'logo', 'printimg/248cd9402a7fa4bea15c8e88be3e6b38.jpg', '2021-10-05 23:39:29', '2x2', 2, 400, '2021-10-05 23:39:35', 13, 3, 1, 47);

-- --------------------------------------------------------

--
-- Table structure for table `product_details_tbl`
--

CREATE TABLE `product_details_tbl` (
  `product_details_id` int(10) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_details_tbl`
--

INSERT INTO `product_details_tbl` (`product_details_id`, `product_name`, `product_description`, `product_image`, `date_posted`, `category_id`) VALUES
(38, 'Kape Ecija', 'Fresh coffees', 'img/qwe.jpg', '2021-09-10 00:46:00', 1),
(39, 'Mushroom Chicharon', 'Vegan Filipino Chicharon, Two Ways. Vegan Filipino Chicharon is a fun little snack that has dried shiitake mushrooms coated in rice flour and sweet rice flour then deep-fried. Another way to make it is by deep-frying dried yuba skin.Y', 'img/3a3e3dc691b95f7c68e4e2b529f61d9d.jpg', '2021-09-10 00:48:41', 1),
(40, 'Distilled water', 'Distilled water is steam from boiling water that’s been cooled and returned to its liquid state. Some people claim distilled water is the purest water you can drink.', 'img/qwe.jpg', '2021-09-10 00:50:10', 2),
(41, 'milk tea', 'natural milk tea', 'img/d8e0f3c6339a3d949039987907ab9e91.jpg', '2021-09-10 00:51:26', 1),
(42, 'kape', 'sample description', 'img/qwe.jpg', '2021-09-10 01:25:50', 1),
(44, '3asd asdasd asdasd asdasd', '32131', 'img/ca00d8dbb7a130cf75cc0562ec7c2992.png', '2021-09-18 03:07:59', 2),
(45, 'samplewww', 'samplewwww', 'img/9ce369101ec8e436159ea6c15cdaf7e9.jpg', '2021-09-24 13:27:06', 2),
(46, '2131231231', '123123123', 'img/015419c4fce8952d9c0c29dec5f769ff.jpg', '2021-09-26 11:50:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_variation_tbl`
--

CREATE TABLE `product_variation_tbl` (
  `product_variation_id` int(10) NOT NULL,
  `weight_value` float NOT NULL,
  `price` float NOT NULL,
  `product_details_id` int(10) NOT NULL,
  `weight_unit_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_variation_tbl`
--

INSERT INTO `product_variation_tbl` (`product_variation_id`, `weight_value`, `price`, `product_details_id`, `weight_unit_id`) VALUES
(45, 1, 300, 38, 1),
(46, 300, 60.6, 38, 2),
(47, 1, 150, 39, 1),
(48, 100, 50.6, 39, 2),
(49, 100, 5, 40, 4),
(50, 200, 8.5, 40, 4),
(51, 75, 70, 41, 4),
(52, 90, 80.7, 41, 4),
(53, 1, 230, 42, 3),
(54, 400, 600, 42, 4),
(56, 1, 2, 44, 1),
(57, 1, 100, 45, 2),
(59, 150, 65, 46, 4);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_details_tbl`
--

CREATE TABLE `shipping_details_tbl` (
  `shipping_details_id` int(10) NOT NULL,
  `recipient_name` varchar(255) NOT NULL,
  `recipient_number` varchar(15) NOT NULL,
  `ship_or_pickup_address` varchar(255) NOT NULL,
  `date_to_receive` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_details_tbl`
--

INSERT INTO `shipping_details_tbl` (`shipping_details_id`, `recipient_name`, `recipient_number`, `ship_or_pickup_address`, `date_to_receive`) VALUES
(20, 'Diel Salatamos', '09301795886', 'Gabaldon campus', '2021-09-17 05:56:00'),
(21, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-09-22 08:09:28'),
(22, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-09-29 09:27:38'),
(23, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-01 03:59:45'),
(24, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-01 03:59:47'),
(25, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-01 03:59:52'),
(26, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-01 04:00:00'),
(27, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-01 04:00:06'),
(28, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-01 04:00:08'),
(29, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-01 04:00:10'),
(30, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-01 04:00:11'),
(31, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-01 04:00:13'),
(32, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-01 04:00:16'),
(33, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-01 04:00:18'),
(34, 'ardiel ardiel', '0938833', '222/asdsadsadsad/sadsad/asdasdasd', '2021-10-03 06:10:47'),
(35, 'ardiel ardiel', '0938833', '222/asdsadsadsad/sadsad/asdasdasd', '2021-10-03 06:10:55'),
(36, 'ardiel ardiel', '0938833', '222/asdsadsadsad/sadsad/asdasdasd', '2021-10-03 12:11:05'),
(37, 'ardiel ardiel', '0938833', '222/asdsadsadsad/sadsad/asdasdasd', '2021-10-03 07:09:16'),
(42, 'ardiel ardiel', '0938833', '222/asdsadsadsad/sadsad/asdasdasd', '2021-10-03 07:53:11'),
(43, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-09 04:53:29'),
(44, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-09 04:54:29'),
(45, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-09 04:55:21'),
(46, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-10 04:25:38'),
(47, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-11 07:39:29'),
(48, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-16 02:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `status_tbl`
--

CREATE TABLE `status_tbl` (
  `status_id` int(10) NOT NULL,
  `status_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_tbl`
--

INSERT INTO `status_tbl` (`status_id`, `status_description`) VALUES
(1, 'pending'),
(2, 'accepted'),
(3, 'cancelled'),
(4, 'completed'),
(5, 'to deliver');

-- --------------------------------------------------------

--
-- Table structure for table `weight_unit_tbl`
--

CREATE TABLE `weight_unit_tbl` (
  `weight_unit_id` int(10) NOT NULL,
  `abbreviation` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weight_unit_tbl`
--

INSERT INTO `weight_unit_tbl` (`weight_unit_id`, `abbreviation`, `description`) VALUES
(1, 'kg', 'kilogram'),
(2, 'mg', 'milligram\r\n'),
(3, 'l', 'liter'),
(4, 'ml', 'milliliters');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_tbl`
--
ALTER TABLE `account_tbl`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `announcement_tbl`
--
ALTER TABLE `announcement_tbl`
  ADD PRIMARY KEY (`announcement_id`),
  ADD KEY `adm_id` (`admin_id`);

--
-- Indexes for table `category_tbl`
--
ALTER TABLE `category_tbl`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `order_details_tbl`
--
ALTER TABLE `order_details_tbl`
  ADD PRIMARY KEY (`order_details_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `payment_type_id` (`shipping_details_id`),
  ADD KEY `payment` (`payment_type_id`);

--
-- Indexes for table `order_items_tbl`
--
ALTER TABLE `order_items_tbl`
  ADD PRIMARY KEY (`order_items_id`),
  ADD KEY `product_variation_id` (`product_variation_id`),
  ADD KEY `order_details_id` (`order_details_id`);

--
-- Indexes for table `payment_type_tbl`
--
ALTER TABLE `payment_type_tbl`
  ADD PRIMARY KEY (`payment_type_id`);

--
-- Indexes for table `printing_service_tbl`
--
ALTER TABLE `printing_service_tbl`
  ADD PRIMARY KEY (`printing_service_id`),
  ADD KEY `cus_id` (`customer_id`),
  ADD KEY `stat_id` (`status_id`),
  ADD KEY `payment_typeid` (`payment_type_id`),
  ADD KEY `ship_det_id` (`shipping_details_id`);

--
-- Indexes for table `product_details_tbl`
--
ALTER TABLE `product_details_tbl`
  ADD PRIMARY KEY (`product_details_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_variation_tbl`
--
ALTER TABLE `product_variation_tbl`
  ADD PRIMARY KEY (`product_variation_id`),
  ADD KEY `product_details_id` (`product_details_id`),
  ADD KEY `weight_unit_id` (`weight_unit_id`);

--
-- Indexes for table `shipping_details_tbl`
--
ALTER TABLE `shipping_details_tbl`
  ADD PRIMARY KEY (`shipping_details_id`);

--
-- Indexes for table `status_tbl`
--
ALTER TABLE `status_tbl`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `weight_unit_tbl`
--
ALTER TABLE `weight_unit_tbl`
  ADD PRIMARY KEY (`weight_unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_tbl`
--
ALTER TABLE `account_tbl`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `announcement_tbl`
--
ALTER TABLE `announcement_tbl`
  MODIFY `announcement_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_tbl`
--
ALTER TABLE `category_tbl`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_details_tbl`
--
ALTER TABLE `order_details_tbl`
  MODIFY `order_details_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `order_items_tbl`
--
ALTER TABLE `order_items_tbl`
  MODIFY `order_items_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `payment_type_tbl`
--
ALTER TABLE `payment_type_tbl`
  MODIFY `payment_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `printing_service_tbl`
--
ALTER TABLE `printing_service_tbl`
  MODIFY `printing_service_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_details_tbl`
--
ALTER TABLE `product_details_tbl`
  MODIFY `product_details_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `product_variation_tbl`
--
ALTER TABLE `product_variation_tbl`
  MODIFY `product_variation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `shipping_details_tbl`
--
ALTER TABLE `shipping_details_tbl`
  MODIFY `shipping_details_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `status_tbl`
--
ALTER TABLE `status_tbl`
  MODIFY `status_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `weight_unit_tbl`
--
ALTER TABLE `weight_unit_tbl`
  MODIFY `weight_unit_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement_tbl`
--
ALTER TABLE `announcement_tbl`
  ADD CONSTRAINT `adm_id` FOREIGN KEY (`admin_id`) REFERENCES `admin_tbl` (`admin_id`);

--
-- Constraints for table `order_details_tbl`
--
ALTER TABLE `order_details_tbl`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer_tbl` (`customer_id`),
  ADD CONSTRAINT `payment` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type_tbl` (`payment_type_id`),
  ADD CONSTRAINT `shipping_details_id` FOREIGN KEY (`shipping_details_id`) REFERENCES `shipping_details_tbl` (`shipping_details_id`),
  ADD CONSTRAINT `status_id` FOREIGN KEY (`status_id`) REFERENCES `status_tbl` (`status_id`);

--
-- Constraints for table `order_items_tbl`
--
ALTER TABLE `order_items_tbl`
  ADD CONSTRAINT `order_details_id` FOREIGN KEY (`order_details_id`) REFERENCES `order_details_tbl` (`order_details_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variation_id` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variation_tbl` (`product_variation_id`);

--
-- Constraints for table `printing_service_tbl`
--
ALTER TABLE `printing_service_tbl`
  ADD CONSTRAINT `cus_id` FOREIGN KEY (`customer_id`) REFERENCES `customer_tbl` (`customer_id`),
  ADD CONSTRAINT `payment_typeid` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type_tbl` (`payment_type_id`),
  ADD CONSTRAINT `ship_det_id` FOREIGN KEY (`shipping_details_id`) REFERENCES `shipping_details_tbl` (`shipping_details_id`),
  ADD CONSTRAINT `stat_id` FOREIGN KEY (`status_id`) REFERENCES `status_tbl` (`status_id`);

--
-- Constraints for table `product_details_tbl`
--
ALTER TABLE `product_details_tbl`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category_tbl` (`category_id`);

--
-- Constraints for table `product_variation_tbl`
--
ALTER TABLE `product_variation_tbl`
  ADD CONSTRAINT `product_details_id` FOREIGN KEY (`product_details_id`) REFERENCES `product_details_tbl` (`product_details_id`),
  ADD CONSTRAINT `weight_unit_id` FOREIGN KEY (`weight_unit_id`) REFERENCES `weight_unit_tbl` (`weight_unit_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
