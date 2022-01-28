-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 28, 2022 at 05:12 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vietstar_shipping`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `cust_name` varchar(100) NOT NULL,
  `cust_address` text,
  `cust_city` varchar(100) DEFAULT NULL,
  `cust_state` varchar(50) DEFAULT NULL,
  `cust_zipcode` varchar(10) DEFAULT NULL,
  `cust_email` varchar(100) DEFAULT NULL,
  `cust_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `cust_name`, `cust_address`, `cust_city`, `cust_state`, `cust_zipcode`, `cust_email`, `cust_phone`) VALUES
(1, 'John Smith', '123 ABC', 'Fairfax', 'VA', '22011', 'jsmith@gmail.com', '5715990090'),
(2, 'Alice Tran', '456 Bluesky', 'Chantilly', 'VA', '20151', 'atran@gmail.com', '7034429953'),
(3, 'Alex Han', '99 Horizontal Light', 'Chantilly', 'VA', '22055', 'ahan@gmail.com', '7035556666'),
(4, 'Alex Nguyen', '99 Horizontal Light', 'Chantilly', 'VA', '22055', 'ahan@gmail.com', ''),
(5, 'Trinh Trinh', '99 Rose Street', 'Rainbow', 'VA', '20151', '', '7038889901');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `pkg_id` int(11) NOT NULL,
  `shipping_order_id` int(11) NOT NULL,
  `package_desc` text NOT NULL,
  `package_weight` double DEFAULT NULL,
  `mst` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`pkg_id`, `shipping_order_id`, `package_desc`, `package_weight`, `mst`) VALUES
(73320, 4, '12 Ensure', NULL, NULL),
(73321, 4, '13 Fish Oils', NULL, NULL),
(73322, 4, '12 Ensure', 12, '13'),
(73323, 4, '13 Fish Oils', 13, '13'),
(73324, 3, '12 Ginger Candies', 12, '12'),
(73325, 3, '13 Fish Oils, 3 glocosamine', 15, '12'),
(73326, 3, 'Clothes, 5 shoes', 5, '12'),
(73327, 5, '12 Ginseng', 12, '14'),
(73328, 6, '100 Ginseng', 30, '15'),
(73329, 6, '50 Vitamin C', 50, '15'),
(73330, 7, '10 Candies', 1, '16'),
(73331, 8, '1000 Candies', 1, '17'),
(73332, 9, '10 Fish Oils', 10, '18'),
(73333, 10, '10 Fish Oils', 15, '19'),
(73334, 11, '15 Fish Oils', 20, '20'),
(73335, 12, '100 Ginger Candies', 13, '21'),
(73336, 13, '101 Ginger Candies', 15, '22'),
(73337, 14, 'Clothes', 5, '23'),
(73338, 15, 'Clothes', 10, '24'),
(73339, 16, 'Clothes', 10, '25'),
(73341, 18, '1 hello kitty', 25.43, '27'),
(73342, 18, '2 stuffed bear', 25, '27'),
(73343, 18, 'a bicycle', 30, '27'),
(73344, 19, '10 hello kitties', 10, '28');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(200) DEFAULT NULL,
  `product_category` varchar(200) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `profit` double DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `qty_onhand` int(10) DEFAULT NULL,
  `qty_supplied` int(10) DEFAULT NULL,
  `product_location` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_code`, `product_category`, `product_name`, `unit_price`, `profit`, `supplier`, `qty_onhand`, `qty_supplied`, `product_location`, `user_id`) VALUES
(58, 'SKU001', 'Vitamin', ' Vitamin C ', 35, 15, 'Multi-Vitamin', 8, 50, 'Middle shelf - 5B', NULL),
(59, 'SKU002', 'Dairy', ' Ensure milk ', 35, 15, 'YumYum', 22, 100, 'Left shelf - 4A', NULL),
(60, 'SKU003', 'Candies/Snack', ' Ginger ', 60, 30, 'YumYum', 84, 100, 'Right shelf - 3A', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `purchase_invoice` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_total_cost` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE `purchase_item` (
  `pitem_id` int(11) NOT NULL,
  `pitem_qty` int(11) DEFAULT NULL,
  `pitem_unit_cost` double DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `purchase_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `recipient`
--

CREATE TABLE `recipient` (
  `recipient_id` int(11) NOT NULL,
  `recipient_name` varchar(100) NOT NULL,
  `recipient_address` text NOT NULL,
  `recipient_phone` varchar(10) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `recipient_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipient`
--

INSERT INTO `recipient` (`recipient_id`, `recipient_name`, `recipient_address`, `recipient_phone`, `customer_id`, `recipient_email`) VALUES
(1, 'Ana Smith', '234 Rose Street', '7035558900', 1, NULL),
(2, 'Alex Nguyen', '98 Sunlight', '8909907888', 2, NULL),
(3, 'Hung Le', '78 Lake Village', '5718889999', 1, NULL),
(4, 'Hieu Nguyen', '88 Winter Snow', '5718889090', 1, NULL),
(6, 'Trinh Trinh', '84 Rose Street', '5715990808', 1, NULL),
(8, 'Hong Chau', '55 Sunny Lake', '3012345678', 2, NULL),
(10, 'Yen Le', '58 Snowflake', '7038882727', 2, NULL),
(12, 'Phuong Dang', '1302 Betty Lane, MD', '5718889900', 2, NULL),
(13, 'Khanh Vi', '123 Pham Ngu Lao', '7038889090', 2, NULL),
(15, 'Van Van', '123 Pham Ngu Lao', '0913260181', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `invoice_number` varchar(100) DEFAULT NULL,
  `cashier` varchar(100) DEFAULT NULL,
  `sales_payment_method` varchar(100) DEFAULT NULL,
  `sales_custname` varchar(100) DEFAULT NULL,
  `sales_cust_payment` double DEFAULT NULL,
  `sales_discount` double DEFAULT NULL,
  `sales_date` date DEFAULT NULL,
  `sales_amount` double DEFAULT NULL,
  `sales_profit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `invoice_number`, `cashier`, `sales_payment_method`, `sales_custname`, `sales_cust_payment`, `sales_discount`, `sales_date`, `sales_amount`, `sales_profit`) VALUES
(142, 'RS-8343433', 'Admin', 'cash', 'Ana Tran', NULL, 0, NULL, NULL, 0),
(143, 'RS-32032603', 'Admin', 'cash', 'Ana Tran', NULL, 0, NULL, NULL, 0),
(144, 'RS-0333309', 'Admin', 'Cash', 'John Smith', NULL, 0, NULL, NULL, 0),
(145, '', 'Admin', 'Credit', 'Alex', 220, 0, NULL, NULL, 0),
(146, '', 'Admin', 'Cash', 'Again', 220, 0, NULL, NULL, 0),
(147, 'RS-25040333', 'Admin', 'cash', 'Trinh', 175, 25, NULL, NULL, 0),
(148, 'RS-233346', 'Admin', 'Cash', 'Phuong', 150, 25, NULL, NULL, 0),
(149, 'RS0099', 'admin', 'cash', 'Ana', 100, 0, NULL, 100, 0),
(150, 'RS-733223', 'Admin', 'cash', 'Ana', 175, 0, '2022-11-21', 175, 0),
(151, 'RS-733223', 'Admin', 'cash', 'Ana', 175, 0, '2022-11-21', 175, 0),
(152, 'RS-733223', 'Admin', 'credit', 'Smith', 235, 0, '2022-11-21', 235, 0),
(153, 'RS-733223', 'Admin', 'cash', 'Smith', 235, 0, '2022-01-22', 235, 0),
(154, 'RS-2223308', 'Admin', 'cash', 'No name', 175, 0, '2022-01-22', 175, 0),
(155, 'RS-2223308', 'Admin', 'credit', 'No name', 100, 0, '2022-01-22', 175, 0),
(156, 'RS-2223308', 'Admin', 'credit', 'No name', 175, 0, '2022-01-22', 175, 0),
(157, 'RS-230323', 'Admin', 'credit', 'Nam', 175, 0, '2022-01-24', 175, 0),
(158, 'RS-323043', 'Admin', 'cash', 'Lina', 295, 0, '2022-01-24', 295, 0),
(159, 'RS-323043', 'Admin', 'cash', '-', 295, 0, '2022-01-24', 295, 0),
(160, 'RS-228040', 'Admin', 'cash', '-', 200, 0, '2022-01-24', 175, 0),
(161, 'RS-3230033', 'Admin', 'credit', '-', 175, 0, '2022-01-24', 175, 0),
(162, 'RS-32205763', 'Admin', 'cash', '-', NULL, 0, '2022-01-24', 70, 0),
(163, 'RS-32205763', 'Admin', 'credit', '-', NULL, 0, '2022-01-24', 70, 0),
(164, 'RS-32205763', 'Admin', 'cash', 'unknown', NULL, 0, '2022-01-24', 70, 0),
(165, 'RS-32205763', 'Admin', 'cash', '-', NULL, 10, '2022-01-24', 70, 0),
(166, 'RS-52453', 'Admin', 'cash', 'Baby', NULL, 0, '2022-01-24', 35, 0),
(167, 'RS-52453', 'Admin', 'cash', 'Baby', NULL, 0, '2022-01-24', 35, 0),
(168, 'RS-37803260', 'Admin', 'cash', '-', 35, 0, '2022-01-24', 35, 0),
(169, 'RS-37803260', 'Admin', 'cash', '-', 35, 0, '2022-01-24', 35, 0),
(170, '', 'Admin', 'cash', '-', 130, 0, '2022-01-24', 130, 0),
(171, '', 'Admin', 'cash', '-', 130, 0, '2022-01-24', 130, 0),
(172, '', 'Admin', 'cash', '-', 130, 0, '2022-01-24', 130, 0),
(173, '', 'Admin', 'cash', '-', 60, 0, '2022-01-24', 60, 0),
(174, '', 'Admin', 'cash', '-', 60, 0, '2022-01-24', 60, 0),
(175, 'RS-254020', 'Admin', 'cash', '-', 35, 0, '2022-01-24', 35, 0),
(176, 'RS-30003977', 'Admin', 'cash', 'StWrong', 15, 0, '2022-01-24', 35, 0),
(177, 'RS-2203', 'Admin', 'cash', '-', 35, 0, '2022-01-24', 35, 0),
(178, 'RS-2203', 'Admin', 'cash', '-', NULL, 0, '2022-01-24', 35, 0),
(179, 'RS-9232940', 'Admin', 'cahs', '-', 35, 0, '2022-01-24', 35, 0),
(180, 'RS-9232940', 'Admin', 'cahs', '-', 35, 0, '2022-01-24', 35, 0),
(181, 'RS-320027', 'Admin', 'cash', '-', 60, 0, '2022-01-25', 60, 30),
(182, 'RS-320027', 'Admin', 'cash', '-', 60, 0, '2022-01-25', 60, 30),
(183, '', 'Admin', 'cash', '-', 60, 0, '2022-01-25', 60, 30),
(184, '', 'Admin', 'cash', '-', 60, 0, '2022-01-25', 60, 30),
(185, '', 'Admin', 'cash', '-', 60, 0, '2022-01-25', 60, 30),
(186, 'RS-0440328', 'Admin', 'cash', '-', 130, 0, '2022-01-25', 130, 60),
(187, 'RS-033333', 'Admin', 'credit', '-', 60, 0, '2022-01-25', 60, 30),
(188, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(189, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(190, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(191, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(192, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(193, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(194, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(195, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(196, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(197, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(198, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(199, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(200, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(201, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(202, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(203, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(204, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(205, 'RS-3200928', 'Admin', 'cash', '-', 35, 0, '2022-01-25', 35, 15),
(206, 'RS-24323223', 'Admin', 'credit', '-', 70, 0, '2022-01-25', 70, 30),
(207, 'RS-24323223', 'Admin', 'credit', '-', 70, 0, '2022-01-25', 70, 30),
(208, 'RS-23632823', 'Admin', 'Cash', '-', 190, 0, '2022-01-28', 190, 90),
(209, 'RS-08022', 'Admin', 'credit', '-', 60, 0, '2022-01-28', 60, 30);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `sales_order_id` int(11) NOT NULL,
  `invoice` varchar(100) DEFAULT NULL,
  `qty_picked` int(11) DEFAULT NULL,
  `sales_order_amount` double DEFAULT NULL,
  `sales_order_profit` double DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`sales_order_id`, `invoice`, `qty_picked`, `sales_order_amount`, `sales_order_profit`, `product_id`, `sales_id`) VALUES
(315, 'RS-8343433', 2, 70, 30, 58, NULL),
(316, 'RS-32032603', 2, 120, 60, 60, NULL),
(317, 'RS-32032603', 3, 105, 45, 59, NULL),
(322, 'RS-2283383', 4, 140, 60, 59, NULL),
(327, 'RS-0333309', 3, 105, 45, 58, NULL),
(328, 'RS-0333309', 1, 35, 15, 59, NULL),
(332, 'RS-6323830', 2, 70, 30, 58, NULL),
(333, 'RS-6323830', 2, 70, 30, 59, NULL),
(334, 'RS-25040333', 5, 175, 75, 59, NULL),
(335, 'RS-233346', 5, 175, 75, 59, NULL),
(336, 'RS-733223', 5, 175, 75, 59, NULL),
(338, 'RS-2223308', 5, 175, 75, 59, NULL),
(339, 'RS-230323', 5, 175, 75, 59, NULL),
(340, 'RS-02233502', 5, 175, 75, 59, NULL),
(341, 'RS-70272', 5, 175, 75, 59, NULL),
(342, 'RS-323043', 2, 120, 60, 60, NULL),
(343, 'RS-323043', 5, 175, 75, 59, NULL),
(344, 'RS-228040', 5, 175, 75, 59, NULL),
(345, 'RS-3230033', 5, 175, 75, 59, NULL),
(346, 'RS-09500330', 1, 35, 15, 58, NULL),
(347, 'RS-09500330', 3, 180, 90, 60, NULL),
(348, 'RS-26023', 5, 175, 75, 59, NULL),
(349, 'RS-230238', 5, 175, 75, 59, NULL),
(350, 'RS-02283326', 2, 120, 60, 60, NULL),
(351, 'RS-02283326', 1, 35, 15, 59, NULL),
(352, 'RS-32205763', 1, 35, 15, 59, NULL),
(353, 'RS-32205763', 1, 35, 15, 59, NULL),
(354, 'RS-52453', 1, 35, 15, 59, NULL),
(355, 'RS-37803260', 1, 35, 15, 59, NULL),
(356, '', 1, 60, 30, 60, NULL),
(357, 'RS-254020', 1, 35, 15, 58, NULL),
(358, 'RS-30003977', 1, 35, 15, 58, NULL),
(359, 'RS-2203', 1, 35, 15, 59, NULL),
(360, 'RS-9232940', 1, 35, 15, 59, NULL),
(361, 'RS-320027', 1, 60, 30, 60, NULL),
(362, 'RS-0440328', 1, 35, 15, 59, NULL),
(363, 'RS-0440328', 1, 60, 30, 60, NULL),
(364, 'RS-0440328', 1, 35, 15, 59, NULL),
(365, 'RS-033333', 1, 60, 30, 60, NULL),
(366, 'RS-3200928', 1, 35, 15, 58, 188),
(367, 'RS-24323223', 1, 35, 15, 58, 206),
(368, 'RS-24323223', 1, 35, 15, 59, 206),
(369, '', 1, 35, 15, 59, NULL),
(370, 'RS-23632823', 2, 70, 30, 59, 208),
(371, 'RS-23632823', 2, 120, 60, 60, 208),
(372, 'RS-08022', 1, 60, 30, 60, 209),
(373, 'RS-362363', 1, 35, 15, 59, NULL),
(374, 'RS-362363', 1, 35, 15, 59, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_order`
--

CREATE TABLE `shipping_order` (
  `shipping_order_id` int(11) NOT NULL,
  `mst` varchar(100) NOT NULL,
  `send_date` date NOT NULL,
  `airport_delivery_date` date DEFAULT NULL,
  `total_weight` double NOT NULL,
  `num_of_packages` int(11) NOT NULL,
  `package_value` double DEFAULT NULL,
  `custom_fee` double DEFAULT NULL,
  `insurance` double DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `recipient_id` int(11) DEFAULT NULL,
  `price_per_lb` double DEFAULT NULL,
  `total_pmt` double NOT NULL,
  `discount` double DEFAULT NULL,
  `refund` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping_order`
--

INSERT INTO `shipping_order` (`shipping_order_id`, `mst`, `send_date`, `airport_delivery_date`, `total_weight`, `num_of_packages`, `package_value`, `custom_fee`, `insurance`, `payment_method`, `user_id`, `location`, `customer_id`, `recipient_id`, `price_per_lb`, `total_pmt`, `discount`, `refund`) VALUES
(1, '10', '2022-01-12', '2022-01-16', 20, 1, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(2, '11', '2022-01-12', '2022-01-16', 20, 1, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(3, '12', '2022-01-12', '2022-01-19', 20, 1, 100, 35, 100, 'venmo', 1, 'Sài Gòn', 1, 1, 3.5, 0, NULL, NULL),
(4, '13', '2022-01-12', '2022-01-16', 20, 1, 100, 35, 100, 'venmo', 1, 'Sài Gòn', 1, 1, 3.5, 0, NULL, NULL),
(5, '14', '2022-01-14', '2022-01-21', 12, 1, 120, 100, 120, 'credit', 1, 'Sài Gòn', 2, 10, 3.5, 0, NULL, NULL),
(6, '15', '2022-01-14', '2022-01-21', 80, 2, 1200, 100, 1200, 'zelle', 1, 'Sài Gòn', 2, 8, 3.5, 0, NULL, NULL),
(7, '16', '2022-01-14', '2022-01-14', 1, 1, 0, 0, 0, 'zelle', 1, 'Tỉnh (Province)', 2, 2, 3.75, 0, NULL, NULL),
(8, '17', '2022-01-14', '2022-01-14', 1, 1, 0, 0, 0, 'credit', 1, 'Tỉnh (Province)', 2, 2, 3.75, 0, NULL, NULL),
(9, '18', '2022-01-16', '2022-01-17', 15, 1, 0, 0, 0, 'venmo', 1, 'Tỉnh (Province)', 2, 2, 3.75, 0, NULL, NULL),
(10, '19', '2022-01-16', '2022-01-16', 15, 1, 0, 0, 0, 'cash', 1, 'Sài Gòn', 2, 2, 3.5, 0, NULL, NULL),
(11, '20', '2022-01-16', '2022-01-16', 15, 1, 0, 0, 0, 'cash', 1, 'Sài Gòn', 2, 2, 3.5, 0, NULL, NULL),
(12, '21', '2022-01-15', '2022-01-15', 13, 1, 0, 0, 0, 'cash', 1, 'Sài Gòn', 2, 2, 3.5, 0, NULL, NULL),
(13, '22', '2022-01-15', '2022-01-15', 15, 1, 0, 0, 0, 'cash', 1, 'Sài Gòn', 2, 2, 3.5, 0, NULL, NULL),
(14, '23', '2022-01-15', '2022-01-15', 5, 1, 0, 0, 0, '', 1, 'Sài Gòn', 2, 13, 3.5, 0, NULL, NULL),
(15, '24', '2022-01-15', '2022-01-15', 10, 1, 0, 0, 0, '', 1, 'Sài Gòn', 2, 12, 3.5, 0, NULL, NULL),
(16, '25', '2022-01-15', '2022-01-15', 10, 1, 0, 0, 0, 'check', 1, 'Sài Gòn', 2, 12, 3.5, 0, NULL, NULL),
(18, '27', '2022-01-19', '2022-01-19', 80.43, 3, 0, 0, 0, 'cash', 1, 'Sài Gòn', 2, 13, 3.5, 0, NULL, NULL),
(19, '28', '2022-01-19', '2022-01-19', 10, 1, 0, 0, 0, 'cash', 1, 'Tỉnh (Province)', 5, 15, 3.75, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supliers`
--

CREATE TABLE `supliers` (
  `suplier_id` int(11) NOT NULL,
  `suplier_name` varchar(100) NOT NULL,
  `suplier_address` varchar(100) NOT NULL,
  `suplier_contact` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `note` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supliers`
--

INSERT INTO `supliers` (`suplier_id`, `suplier_name`, `suplier_address`, `suplier_contact`, `contact_person`, `note`) VALUES
(5, 'YumYum', '45 Candy Street', 'Min', '5716789900', ''),
(6, 'Multi-Vitamin', '88 Skylight', 'Max', '5718890945', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `password`, `position`) VALUES
(1, 'admin', 'Admin', 'admin', 'admin'),
(2, 'cashier', 'Cashier Pharmacy', 'cashier', 'Cashier'),
(3, 'admin', 'Administrator', 'admin123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`pkg_id`),
  ADD KEY `shipping_order_id` (`shipping_order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `user_id_products_tbl` (`user_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `supplier_id_purchase_tbl` (`supplier_id`),
  ADD KEY `user_id_purchase_tbl` (`user_id`);

--
-- Indexes for table `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD PRIMARY KEY (`pitem_id`),
  ADD KEY `product_id_purchase_item_tbl` (`product_id`),
  ADD KEY `purchase_id_purchase_tbl` (`purchase_id`);

--
-- Indexes for table `recipient`
--
ALTER TABLE `recipient`
  ADD PRIMARY KEY (`recipient_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`sales_order_id`),
  ADD KEY `product_id_tbl_sales_order` (`product_id`),
  ADD KEY `sales_id_tbl_sales_order` (`sales_id`);

--
-- Indexes for table `shipping_order`
--
ALTER TABLE `shipping_order`
  ADD PRIMARY KEY (`shipping_order_id`),
  ADD KEY `recipient_id_tbl_shipping_order` (`recipient_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `location_id` (`location`);

--
-- Indexes for table `supliers`
--
ALTER TABLE `supliers`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `pkg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73345;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_item`
--
ALTER TABLE `purchase_item`
  MODIFY `pitem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recipient`
--
ALTER TABLE `recipient`
  MODIFY `recipient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `sales_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT for table `shipping_order`
--
ALTER TABLE `shipping_order`
  MODIFY `shipping_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `supliers`
--
ALTER TABLE `supliers`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `shipping_order_id` FOREIGN KEY (`shipping_order_id`) REFERENCES `shipping_order` (`shipping_order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `user_id_products_tbl` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `supplier_id_purchase_tbl` FOREIGN KEY (`supplier_id`) REFERENCES `supliers` (`suplier_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_purchase_tbl` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD CONSTRAINT `product_id_purchase_item_tbl` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_id_purchase_tbl` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipient`
--
ALTER TABLE `recipient`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD CONSTRAINT `product_id_tbl_sales_order` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_id_tbl_sales_order` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`sales_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipping_order`
--
ALTER TABLE `shipping_order`
  ADD CONSTRAINT `recipient_id_tbl_shipping_order` FOREIGN KEY (`recipient_id`) REFERENCES `recipient` (`recipient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipping_order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
