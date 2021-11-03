-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2021 at 01:03 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

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
  `verification_key` varchar(32) NOT NULL,
  `status` int(1) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `usertype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_tbl`
--

INSERT INTO `account_tbl` (`account_id`, `verification_key`, `status`, `username`, `password`, `usertype`) VALUES
(7, 'e01cf75af1ee04bd991cb7a082377d94', 1, 'editeddd', 'bea735f03eee25e276ece7e4dc0a4c10', 'customer'),
(14, 'f59d2bc8a893efc3a67048992ba04425', 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(15, '43028b357555317171b58046a7ee63d9', 1, 'ardiel', '801365345c20fec90cf26e0d2109ef6e', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `admin_id` int(10) NOT NULL,
  `admin_fname` varchar(25) NOT NULL,
  `admin_lname` varchar(25) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
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
(1, '2021-10-15', 'Sample Announcement', 'img/qwe.jpg', 2018101782),
(2, '2021-09-23', 'asdasda', 'img/qwe.jpg', 2018101782);

-- --------------------------------------------------------

--
-- Table structure for table `category_tbl`
--

CREATE TABLE `category_tbl` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(10) NOT NULL
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
  `customer_fname` varchar(25) NOT NULL,
  `customer_lname` varchar(25) NOT NULL,
  `house_no` int(10) NOT NULL,
  `barangay` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `province` varchar(25) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_phonenumber` varchar(15) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `account_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_tbl`
--

INSERT INTO `customer_tbl` (`customer_id`, `customer_fname`, `customer_lname`, `house_no`, `barangay`, `city`, `province`, `customer_email`, `customer_phonenumber`, `date_created`, `account_id`) VALUES
(13, 'edited', 'Salatamos', 136, 'Malasin', 'Santo Domingo', 'Nueva Ecija', 'ardielsalatamos24@gmail.com', '09301795886', '2021-10-29 12:53:21', 7),
(19, 'ardiel', 'ardiel', 222, 'asdsadsadsad', 'sadsad', 'asdasdasd', 'sadasdas@gmail.com', '0938833', '2021-09-28 10:09:57', 15);

-- --------------------------------------------------------

--
-- Table structure for table `order_details_tbl`
--

CREATE TABLE `order_details_tbl` (
  `order_details_id` int(10) NOT NULL,
  `date_ordered` date NOT NULL DEFAULT current_timestamp(),
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
(56, '2021-01-17', '2020-12-31 23:36:15', 155, 4, 13, 2, 20),
(57, '2021-02-17', '2021-01-01 23:36:22', 450, 4, 13, 1, 21),
(58, '2021-03-24', '2021-01-02 22:59:33', 100, 4, 13, 1, 22),
(59, '2021-04-26', '2021-01-03 23:22:14', 150, 4, 13, 1, 23),
(60, '2021-05-26', '2021-01-05 04:37:40', 150, 4, 13, 1, 24),
(61, '2021-06-26', '2021-01-05 22:59:52', 5, 4, 13, 1, 25),
(62, '2021-07-26', '2021-01-07 04:37:45', 6, 4, 13, 1, 26),
(63, '2021-08-26', '2021-01-08 04:37:44', 230, 4, 13, 1, 27),
(64, '2021-09-26', '2021-01-09 04:37:48', 230, 4, 13, 1, 28),
(65, '2021-10-26', '2021-01-10 04:37:49', 230, 4, 13, 1, 29),
(66, '2021-11-26', '2021-01-11 04:37:50', 230, 4, 13, 1, 30),
(67, '2021-12-26', '2021-10-18 04:20:01', 230, 5, 13, 1, 31),
(68, '2021-09-26', '2021-01-13 04:37:54', 920, 4, 13, 1, 32),
(69, '2021-09-26', '2021-01-13 23:09:13', 230, 4, 13, 1, 33),
(71, '2021-09-28', '2021-01-15 04:37:57', 140, 4, 19, 1, 35),
(76, '2022-09-01', '2021-01-16 04:37:58', 181.8, 4, 13, 1, 47),
(77, '2023-09-11', '2021-01-17 04:38:00', 50.6, 4, 13, 1, 59),
(79, '2021-10-12', '2021-01-17 23:05:05', 70, 4, 13, 1, 66),
(80, '2021-10-12', '2021-01-18 23:05:08', 70, 4, 13, 1, 67),
(81, '2021-10-12', '2021-01-19 23:05:10', 70, 4, 13, 1, 68),
(82, '2021-10-12', '2021-01-20 23:05:11', 70, 4, 13, 1, 69),
(83, '2021-10-12', '2021-01-21 23:05:13', 70, 4, 13, 1, 70),
(84, '2021-10-12', '2021-01-22 23:05:15', 70, 4, 13, 1, 71),
(85, '2021-10-12', '2021-01-23 23:05:16', 70, 4, 13, 1, 72),
(86, '2021-10-12', '2021-01-24 23:05:19', 70, 4, 13, 1, 73),
(87, '2021-10-12', '2021-10-11 23:03:08', 70, 1, 13, 1, 74),
(88, '2021-10-12', '2021-10-11 23:03:10', 70, 1, 13, 1, 75),
(89, '2021-10-12', '2021-10-11 23:03:12', 70, 1, 13, 1, 76),
(90, '2021-10-12', '2021-10-11 23:03:13', 70, 1, 13, 1, 77),
(91, '2021-10-12', '2021-10-11 23:03:15', 70, 1, 13, 1, 78),
(92, '2021-10-12', '2021-10-11 23:03:16', 70, 1, 13, 1, 79),
(93, '2021-10-12', '2021-10-11 23:03:18', 70, 1, 13, 1, 80),
(94, '2021-10-12', '2021-10-11 23:03:19', 70, 1, 13, 1, 81),
(95, '2021-10-12', '2021-10-11 23:03:21', 70, 1, 13, 1, 82),
(96, '2021-10-12', '2021-10-11 23:03:22', 70, 1, 13, 1, 83),
(97, '2021-10-12', '2021-10-11 23:03:24', 70, 1, 13, 1, 84),
(98, '2021-10-12', '2021-10-11 23:03:26', 70, 1, 13, 1, 85),
(99, '2021-10-12', '2021-10-11 23:03:27', 70, 1, 13, 1, 86),
(100, '2021-10-12', '2021-10-11 23:03:29', 70, 1, 13, 1, 87),
(101, '2021-10-12', '2021-10-11 23:03:31', 70, 1, 13, 1, 88);

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
(79, 3, 60.6, 46, 76),
(80, 1, 50.6, 48, 77),
(81, 1, 70, 51, 79),
(82, 1, 70, 51, 80),
(83, 1, 70, 51, 81),
(84, 1, 70, 51, 82),
(85, 1, 70, 51, 83),
(86, 1, 70, 51, 84),
(87, 1, 70, 51, 85),
(88, 1, 70, 51, 86),
(89, 1, 70, 51, 87),
(90, 1, 70, 51, 88),
(91, 1, 70, 51, 89),
(92, 1, 70, 51, 90),
(93, 1, 70, 51, 91),
(94, 1, 70, 51, 92),
(95, 1, 70, 51, 93),
(96, 1, 70, 51, 94),
(97, 1, 70, 51, 95),
(98, 1, 70, 51, 96),
(99, 1, 70, 51, 97),
(100, 1, 70, 51, 98),
(101, 1, 70, 51, 99),
(102, 1, 70, 51, 100),
(103, 1, 70, 51, 101);

-- --------------------------------------------------------

--
-- Table structure for table `payment_type_tbl`
--

CREATE TABLE `payment_type_tbl` (
  `payment_type_id` int(10) NOT NULL,
  `payment_description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_type_tbl`
--

INSERT INTO `payment_type_tbl` (`payment_type_id`, `payment_description`) VALUES
(1, 'Cash on delivery'),
(2, 'Pay on pick-up');

-- --------------------------------------------------------

--
-- Table structure for table `printing_service_tbl`
--

CREATE TABLE `printing_service_tbl` (
  `printing_service_id` int(10) NOT NULL,
  `service_type` varchar(25) NOT NULL,
  `print_service_image` varchar(50) NOT NULL,
  `date_placed` timestamp NOT NULL DEFAULT current_timestamp(),
  `print_service_price` int(10) NOT NULL,
  `print_service_size` varchar(12) NOT NULL,
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

INSERT INTO `printing_service_tbl` (`printing_service_id`, `service_type`, `print_service_image`, `date_placed`, `print_service_price`, `print_service_size`, `print_service_quantity`, `print_service_total`, `status_date`, `customer_id`, `status_id`, `payment_type_id`, `shipping_details_id`) VALUES
(3, 'tarpaulin', 'printimg/aabf1d587767b69ca5e4041', '2021-10-05 11:02:47', 0, '2x2', 1, 800, '2021-10-05 12:31:41', 13, 1, 1, 53),
(6, 'tarpaulin', 'printimg/fd9bc1d2b6898c703cd39f8', '2021-09-28 11:53:11', 0, '2x2', 1, 800, '2021-10-05 10:54:24', 19, 4, 1, 42),
(7, 'tarpaulin', 'printimg/cab747af5d4786f49bf9f16', '2021-09-28 12:16:18', 0, '2x2', 4, 3200, '2021-10-05 10:54:24', 19, 4, 1, 43),
(8, 'tarpaulin', 'printimg/234e83d218dfb25acec6f4d', '2021-10-05 10:51:57', 0, '22x22', 2, 1600, '2021-10-05 10:54:24', 13, 4, 1, 48),
(9, 'tarpaulin', 'printimg/9b74630c5f9d53921c4a497', '2021-10-05 10:52:10', 0, '2x2', 3, 2400, '2021-10-05 10:54:24', 13, 4, 1, 49),
(10, 'tarpaulin', 'printimg/2463f189f865ecc94fae179', '2021-10-05 11:02:37', 0, '2x2', 1, 800, '2021-10-05 11:03:05', 13, 5, 1, 50),
(11, 'tarpaulin', 'printimg/87bee87b7338f49a8403f33', '2021-10-05 11:02:43', 0, '2x2', 1, 800, '2021-10-05 11:03:12', 13, 2, 1, 51),
(12, 'tarpaulin', 'printimg/5219f4b83734f2389b3de59', '2021-10-05 11:02:45', 0, '2x2', 1, 800, '2021-10-05 11:03:12', 13, 2, 1, 52),
(14, 'tarpaulin', 'printimg/0660eb01479b4fcdef2560a', '2021-10-05 11:02:49', 0, '2x2', 1, 800, '2021-10-05 11:02:49', 13, 1, 1, 54),
(15, 'tarpaulin', 'printimg/c5763e2715c5cf2a0510252', '2021-10-05 11:02:51', 0, '2x2', 1, 800, '2021-10-05 11:02:51', 13, 1, 1, 55),
(16, 'tarpaulin', 'printimg/be92ef03d05206883d2d924', '2021-10-05 11:05:22', 0, '2x2', 1, 800, '2021-10-05 11:05:22', 13, 1, 2, 56),
(17, 'tarpaulin', 'printimg/47cfe34e37452d584943d94', '2021-10-05 11:21:16', 0, '2x2', 1, 800, '2021-10-05 11:21:16', 13, 1, 1, 57),
(18, 'tarpaulin', 'printimg/b5b8d263281cddf1ada17e4b150d21fd.jpg', '2021-10-05 11:22:45', 0, '2x2', 1, 800, '2021-10-05 12:32:04', 13, 3, 1, 58),
(19, '1', 'printimg/b7161bea0b9b6006be0012c7d1160eae.', '2021-10-06 00:55:00', 0, '3x3 FT', 2, 4000, '2021-10-06 00:55:00', 13, 1, 1, 60),
(20, '2', 'printimg/7b69e3fc280e0b6a588f9ed1857dea8e.', '2021-10-06 00:55:59', 0, '2x2', 2, 400, '2021-10-06 00:55:59', 13, 1, 1, 61),
(21, '2', 'printimg/74e81673f84dd5086bb95cb6417cebf5.', '2021-10-06 00:57:18', 0, '2x2', 4, 800, '2021-10-06 00:57:18', 13, 1, 1, 62),
(22, '2', 'printimg/04fe8b99b30777b21f8f2511ca74ff87.', '2021-10-06 00:58:50', 0, '2x2 in', 1, 200, '2021-10-06 00:58:50', 13, 1, 1, 63),
(23, '2', 'printimg/b91a72831aa60060a398abcf6ed10a52.gif', '2021-10-06 01:04:42', 200, '2x2 INCH', 3, 600, '2021-10-06 01:04:42', 13, 1, 2, 64),
(24, '1', 'printimg/34b7df77505e0c60c43d1951bdd7b173.', '2021-10-06 01:07:28', 2000, '3x3 FT', 4, 8000, '2021-10-06 01:07:28', 13, 1, 1, 65);

-- --------------------------------------------------------

--
-- Table structure for table `product_details_tbl`
--

CREATE TABLE `product_details_tbl` (
  `product_details_id` int(10) NOT NULL,
  `product_name` varchar(25) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_details_tbl`
--

INSERT INTO `product_details_tbl` (`product_details_id`, `product_name`, `product_description`, `product_image`, `date_posted`, `category_id`) VALUES
(38, 'Kape Ecija', 'Fresh coffees', 'img/qwe.jpg', '2021-09-10 00:46:00', 1),
(39, 'mushroom chicharon', 'delicious chicharon', 'img/qwe.jpg', '2021-09-10 00:48:41', 2),
(40, 'Distilled water', 'refreshing drink', 'img/qwe.jpg', '2021-09-10 00:50:10', 2),
(41, 'milk tea', 'natural milk tea', 'img/qwe.jpg', '2021-09-10 00:51:26', 1),
(42, 'kape', 'sample description', 'img/qwe.jpg', '2021-09-10 01:25:50', 2),
(44, '3', '32131', 'img/711bea256a51d6a33df03a35bac9a53d.jpg', '2021-09-18 03:07:59', 2),
(45, 'samplewww', 'samplewwww', 'img/a92a1b064da2b0bb3f847fbccd79b844.png', '2021-09-24 13:27:06', 2),
(46, '2131231231', '123123123', 'img/7a7a39da99aa56281fd1b6f2063fc923.png', '2021-09-26 11:50:45', 1);

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
(45, 1, 300.32, 38, 1),
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
(57, 1, 100, 45, 2);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_details_tbl`
--

CREATE TABLE `shipping_details_tbl` (
  `shipping_details_id` int(10) NOT NULL,
  `recipient_name` varchar(50) NOT NULL,
  `recipient_number` varchar(15) NOT NULL,
  `ship_or_pickup_address` varchar(100) NOT NULL,
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
(43, 'ardiel ardiel', '0938833', '222/asdsadsadsad/sadsad/asdasdasd', '2021-10-03 08:16:18'),
(44, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-04 07:29:51'),
(47, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-06 09:06:19'),
(48, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-10 06:51:57'),
(49, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-10 06:52:10'),
(50, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-10 07:02:37'),
(51, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-10 07:02:43'),
(52, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-10 07:02:45'),
(53, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-10 07:02:47'),
(54, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-10 07:02:49'),
(55, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-10 07:02:51'),
(56, 'Diel Salatamos', '09301795886', 'Sumacab campus', '2021-10-20 19:05:00'),
(57, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-10 07:21:16'),
(58, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-10 07:22:45'),
(59, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-11 07:16:08'),
(60, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-11 08:55:00'),
(61, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-11 08:55:59'),
(62, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-11 08:57:18'),
(63, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-11 08:58:50'),
(64, 'Diel Salatamos', '09301795886', 'Sumacab campus', '2021-10-06 10:04:00'),
(65, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-11 09:07:28'),
(66, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:02:57'),
(67, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:02:59'),
(68, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:00'),
(69, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:02'),
(70, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:03'),
(71, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:04'),
(72, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:06'),
(73, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:07'),
(74, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:08'),
(75, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:10'),
(76, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:12'),
(77, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:13'),
(78, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:15'),
(79, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:16'),
(80, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:18'),
(81, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:19'),
(82, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:21'),
(83, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:22'),
(84, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:24'),
(85, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:26'),
(86, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:27'),
(87, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:29'),
(88, 'Diel Salatamos', '09301795886', '136/Malasin/Santo Domingo/Nueva Ecija', '2021-10-17 07:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `status_tbl`
--

CREATE TABLE `status_tbl` (
  `status_id` int(10) NOT NULL,
  `status_description` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_tbl`
--

INSERT INTO `status_tbl` (`status_id`, `status_description`) VALUES
(1, 'pending'),
(2, 'accepted'),
(3, 'cancelled'),
(4, 'completed'),
(5, 'to receive');

-- --------------------------------------------------------

--
-- Table structure for table `weight_unit_tbl`
--

CREATE TABLE `weight_unit_tbl` (
  `weight_unit_id` int(10) NOT NULL,
  `abbreviation` varchar(3) NOT NULL,
  `description` varchar(15) NOT NULL
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
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `acc_id` (`account_id`);

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
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `account` (`account_id`);

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
  MODIFY `announcement_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `order_details_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `order_items_tbl`
--
ALTER TABLE `order_items_tbl`
  MODIFY `order_items_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `payment_type_tbl`
--
ALTER TABLE `payment_type_tbl`
  MODIFY `payment_type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `printing_service_tbl`
--
ALTER TABLE `printing_service_tbl`
  MODIFY `printing_service_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_details_tbl`
--
ALTER TABLE `product_details_tbl`
  MODIFY `product_details_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `product_variation_tbl`
--
ALTER TABLE `product_variation_tbl`
  MODIFY `product_variation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `shipping_details_tbl`
--
ALTER TABLE `shipping_details_tbl`
  MODIFY `shipping_details_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

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
-- Constraints for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD CONSTRAINT `acc_id` FOREIGN KEY (`account_id`) REFERENCES `account_tbl` (`account_id`);

--
-- Constraints for table `announcement_tbl`
--
ALTER TABLE `announcement_tbl`
  ADD CONSTRAINT `adm_id` FOREIGN KEY (`admin_id`) REFERENCES `admin_tbl` (`admin_id`);

--
-- Constraints for table `customer_tbl`
--
ALTER TABLE `customer_tbl`
  ADD CONSTRAINT `account` FOREIGN KEY (`account_id`) REFERENCES `account_tbl` (`account_id`);

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
