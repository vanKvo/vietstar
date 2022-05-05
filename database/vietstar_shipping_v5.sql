-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 23, 2022 at 10:13 PM
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
(2, 'Alice Tran', '456 Bluesky', 'Chantilly', 'VA', '20151', 'atran@gmail.com', '7034429967'),
(3, 'Alex Han', '99 Horizontal Light', 'Chantilly', 'VA', '22055', 'ahan@gmail.com', '7035556666'),
(4, 'Alex Nguyen', '99 Horizontal Light', 'Chantilly', 'VA', '22055', 'alexnguyen@gmail.com', '5718907676'),
(5, 'Mina', '99 Rose Street', 'Rainbow', 'VA', '20151', 'tmina@gmail.com', '7038889999'),
(6, 'Trinh Trinh', '34 Blue Street', 'Wisconsin', 'VA', '20151', '', '7035556789'),
(7, 'Alice May', '34 Snow flake', 'Wisconsin', 'VA', '20151', '', '2035556789'),
(8, 'Henry Jay', '123 Rose Street', 'Fairfax', 'VA', '', 'hjay@gmail.com', '5715289496'),
(9, 'Joyce Smith', '55 Wall Street', 'Chantilly', 'VA', '', '', '5718889090'),
(10, 'Ngoc Han', '123 RoseSweet Street', 'Fairfax', 'VA', '22011', 'ngochan@gmail.com', '7034567878'),
(11, 'Emma Tran', '78 Langley Street', 'Chantilly', 'VA', '', '', '7035678907'),
(12, 'Michael Jay', '9 Langley', 'Ashburn', 'VA', '21202', 'mjay@gmail.com', '5017778888'),
(13, 'Washington Lee', '99 BLuesky', 'Chantilly', 'VA', '20151', '', '3035678907'),
(14, 'Anne Tran', '78 Langley Street', 'Chantilly', 'VA', '', '', '7035678907'),
(15, 'Joy Hans', '45 AderWood', 'Reston', 'VA', '20559', '', '7038889090'),
(16, 'Winson Le', '101 Pompeli Road', 'Herndon', 'VA', '21025', '', '7035678907'),
(17, 'Johanna', '78 Langley Street', 'Chantilly', 'VA', '22055', '', '5715989495'),
(18, 'Min Min', '78 Langley Street', 'Arlington', 'VA', '21202', '', '2035678907'),
(19, 'Michael Jay', '123 Rose Street', 'Arlington', 'VA', '21000', 'hjay@gmail.com', '5715289496'),
(20, 'Jay Chou', '123 Rainbow Street', 'Arlington', 'VA', '21034', '', '5715789499'),
(21, 'Johanna', '78 Langley Street', 'Chantilly', 'VA', '22055', '', '2035678907'),
(22, 'Elisa Nguyen', '99 Alder Wood', 'Fairfax', 'VA', '23456', '', '7034567890'),
(23, 'Anne Tran', '78 Langley Street', 'Chantilly', 'VA', '22055', '', '7035678906'),
(24, 'Yen Nguyen', '22 Langley Street', 'Chantilly', 'VA', '22055', '', '2035678907'),
(25, 'Anh Tran', '1111 Apple St', 'Fairfax', 'VA', '22153', '', '7031111111'),
(26, 'Nancy Tran', '123 shore st', 'Arlington', 'VA', '22153', '', '7032222222'),
(27, 'Smith', '123 ABC', 'Fairfax', 'VA', '22011', '', '7034567890'),
(28, 'Phuong Tran', '1234 smith ct', 'Alexandria', 'VA', '22044', '', '5712223333'),
(29, 'Hekko', '123 shore st', 'Fairfax', 'VA', '22044', '', '7034567891'),
(30, 'Alex Mai', '11123 Apple St', 'Falls Church', 'VA', '22042', '', '8045909090'),
(31, 'Anh D Tran', '1111 Apple St', 'Fairfax', 'VA', '22153', '', '7031111111'),
(32, 'Kitty', '55 Snow Lake', 'Arlington', 'VA', '21034', '', '5017778908'),
(33, 'Kitty', '34 Blue Street', 'Falls Church', 'VA', '21202', '', '5715789493');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `pkg_id` int(11) NOT NULL,
  `shipping_order_id` int(11) NOT NULL,
  `package_desc` text NOT NULL,
  `package_weight` double NOT NULL,
  `mst` varchar(100) NOT NULL,
  `pkg_tracking_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`pkg_id`, `shipping_order_id`, `package_desc`, `package_weight`, `mst`, `pkg_tracking_no`) VALUES
(1, 1, '15 Ensure Milk', 16.5, '14000', 1),
(2, 2, '10 Fish Oils', 13, '14001', 1),
(3, 3, '10 shoes', 11, '14002', 1),
(4, 4, '15 Ensure', 16.5, '14003', 1),
(5, 4, '10 Vitamin C, 100 Ginger Candies, 28 dried dates', 11, '14003', 2),
(6, 5, 'Clothes, 5 Tylenol, 5 shoes', 7.5, '14004', 1),
(7, 6, '10 Vitamin C, 100 Ginger candy packages', 15, '14005', 1),
(8, 7, '38 Vitamin C', 40, '14006', 1),
(9, 8, '10 Fish Oils', 12, '14007', 1),
(10, 9, '80 Candies,  15 Fish Oils', 19, '14008', 1),
(11, 10, '10 Candies, 10 Ensures, 15 Fish Oils, 2 chai Dau Cu La', 4.3, '14009', 1),
(13, 12, '12 Shoes, 10 Ensure', 17, '14010', 1),
(14, 13, '10 Vitamin C, 10 Ginger Candies', 10, '14011', 1),
(15, 13, '20 dried dates', 13.5, '14011', 2),
(16, 14, 'giay, thuoc, quan ao', 15.67, '14012', 1),
(17, 15, 'quan ao, thuoc, giay', 15.35, '14013', 1),
(18, 15, 'quan ao, thuoc, giay', 25.45, '14013', 2),
(19, 16, '5 Vitamin C, 8 Ensure, 28 dried dates', 7.45, '14014', 1),
(20, 17, '10 Ensure', 11.25, '14015', 1),
(21, 18, 'dau gio', 5, '14016', 1),
(22, 19, 'food, giay, thuoc', 14.39, '14017', 1),
(23, 19, 'food, giay, thuoc', 13.37, '14017', 2),
(24, 20, 'Ensure', 10.87, '14018', 1),
(25, 20, '10 Fish Oils', 6.37, '14018', 2),
(26, 20, '5 Vitamin C', 5.97, '14018', 3),
(27, 21, '8 Fish Oils', 10.32, '14019', 1),
(28, 21, '100 Lolippop, clothes', 5.75, '14019', 2),
(29, 21, '8 shoes', 6.75, '14019', 3),
(30, 22, '10 Fish Oils', 11.32, '14020', 1),
(31, 22, 'Clothes', 5.63, '14020', 2),
(32, 22, '5 Shoes', 7.38, '14020', 3),
(33, 23, 'Clothes', 5.67, '14021', 1),
(34, 23, '6 Shoes', 7.98, '14021', 2),
(35, 23, 'Blender', 6.4, '14021', 3),
(36, 23, 'ipad', 5, '14021', 4),
(37, 24, 'Clothes', 5.68, '14022', 1),
(38, 24, 'Perfumes', 6.78, '14022', 2),
(39, 24, 'Vitamins', 7.89, '14022', 3),
(40, 25, 'clothes', 5.43, '14023', 1),
(41, 25, '5 vitamin C', 6.73, '14023', 2),
(42, 26, 'Clothes', 5.3, '14024', 1),
(43, 26, '6 shoes', 7.8, '14024', 2),
(44, 26, '4 vitamin E', 6.75, '14024', 3),
(45, 27, '10 Ensure', 11.35, '14025', 1),
(46, 28, '5 Vitamin C, 8 Ensure, 28 dried dates', 6.75, '14026', 1),
(47, 29, '5 Vitamin C, 8 Ensure, 28 dried dates', 6.78, '14027', 1);

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
  `qty_onhand` int(10) DEFAULT NULL,
  `product_location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_code`, `product_category`, `product_name`, `unit_price`, `qty_onhand`, `product_location`) VALUES
(58, 'SKU001', 'Vitamin', ' Vitamin C ', 40, 89, 'Middle shelf - 5B'),
(59, 'SKU002', 'Dairy', ' Ensure milk ', 35, 99, 'Left shelf - 4A'),
(60, 'SKU003', 'Candies/Snack', ' Ginger ', 43, 69, 'Right shelf - 3A'),
(61, 'SKU005', 'Vitamin', 'Fish Oil', 40, 164, 'Middle shelf - 5B'),
(62, 'SKU009', 'Medicine', 'Tylenol', 40, 46, 'Middle shelf - 5B'),
(63, 'SKU006', 'Vitamin', 'Vitamin A', 30, 50, '4A'),
(64, 'SKU007', 'Candies/Snack', 'Lolippop', 15, 117, '5B'),
(65, 'SKU008', 'Candies/Snack', 'Mint candy', 50, 115, '4A'),
(66, 'SKU10', 'Bread', 'banh mi', 8, 12, '8X'),
(67, 'SKU011', 'Vitamin', 'Vitamin E', 30, 5, ''),
(69, 'SKU012', 'Vitamin', 'Gummy', 22.99, 50, ''),
(70, 'SKU13', 'Vitamin', 'Superman', 39.99, 30, ''),
(71, 'SKU014', 'Vitamin', 'MultiCentrum50Plus', 23.99, 50, 'NA'),
(72, 'SKU015', 'Snack', 'KittyCandy', 8.5, 29, 'NA'),
(75, 'SKU016', 'Vitamin', 'Vitamin B1', 15, 105, '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_cost` double DEFAULT NULL,
  `purchase_qty` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `supplier_id`, `user_id`, `purchase_date`, `purchase_cost`, `purchase_qty`, `product_id`) VALUES
(9, 6, 1, '2022-03-04', 11, 13, 58),
(10, 6, 1, '2022-03-04', 11, 21, 58),
(11, 6, 1, '2022-03-04', 18, 30, 62),
(12, 7, 1, '2022-03-04', 10, 50, 65),
(13, 6, 1, '2022-03-04', 13, 50, 58),
(14, 6, 1, '2022-03-04', 8.5, 88, 59),
(15, 6, 1, '2022-03-11', 13, 15, 58),
(16, 6, 1, '2022-03-15', 15, 50, 61),
(17, 5, 2, '2022-03-15', 10, 50, 59),
(18, 5, 3, '2022-03-15', 13.5, 100, 61),
(19, NULL, 3, '2022-03-15', 13, 10, 60),
(20, 7, 3, '2022-03-15', 13.5, 30, 64),
(21, 6, 3, '2022-03-17', 13, 50, 75),
(22, 8, 3, '2022-03-17', 16, 55, 75);

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
(15, 'Van Van', '123 Pham Ngu Lao', '0913260181', 5, NULL),
(16, 'Rose Maine', '89 Anne Village, Fairfax, VA', '5718887979', 6, NULL),
(17, 'Henry Mai', '89 Anne Village, Fairfax, VA', '7018887979', 7, NULL),
(18, '', '', '', 2, NULL),
(19, 'Nguyen Nguyen', '88 To Hien Thanh, Q.10. TP. HCM', '0913555678', 8, NULL),
(20, 'Alex Chau', '88 NTMK, Q.3', '0918855378', 9, NULL),
(21, 'Loan Nguyen', '89 Ben Nghe, TP HCM', '0918789989', 10, NULL),
(22, '', '', '', 10, NULL),
(23, 'Hong Ai', '1000 Ben Thanh, Q.1, TP.HCM', '0917675678', 11, NULL),
(24, 'Chau Chau', '90 To Hien Thanh, TP HCM', '7039882829', 1, NULL),
(25, '', '', '', 5, NULL),
(26, 'Emma Watson', '158 Phan Thanh Gian, Bao Loc City, Viet Nam', '0913456789', 12, NULL),
(28, 'Anita', '10 Nguyen Dinh Chieu, Q.1, TP.HCM', '0913888678', 13, NULL),
(29, 'Linh Chi', '11 Nguyen Trai, Q.3, TP. HCM', '0913456789', 12, NULL),
(30, 'Ngoc Tran', '90 Ben Thanh, Q.1, TP.HCM', '0813555698', 14, NULL),
(31, 'Anna Tran', '108 To Hien Thanh, Q.10', '0910855378', 15, NULL),
(32, 'Daisy Dan', '31, Nguyen Hue, Q.1, TP.HCM', '0916672378', 16, NULL),
(33, 'Hong Ai', '1000 Ben Thanh, Q.1, TP.HCM', '0916123678', 17, NULL),
(34, 'An Nguyen', '999 NTMK, Q.3, TP.HCM', '0914123678', 18, NULL),
(35, 'Nguyen Tran', '188 To Hien Thanh, Q.10. TP. HCM', '091355', 19, NULL),
(36, 'An Nguyen', '188 NTMK, Q.10. TP. HCM', '0913555343', 20, NULL),
(37, 'Nguyen Nguyen', '109 Ly Thanh Tong, Q.1, TP.HCM', '0918133998', 21, NULL),
(38, 'Ngoc Hoang', '78 Tran Phu, Bao Loc, Lam Dong', '0918765456', 22, NULL),
(39, '', '', '0000000000', 1, NULL),
(40, 'Ngoc Tran', '90 Ben Thanh, Q.1, TP.HCM', '0813555696', 23, NULL),
(41, 'Hong Ai', '72 Ben Thanh, Q.1, TP.HCM', '0919909678', 24, NULL),
(42, 'Bao Tran', '123 nguyen tao tphcm', '0903222543', 25, NULL),
(43, 'Mai Tran', '6715 Nguyen Tao Tinh Dong Nai', '0905123456', 26, NULL),
(44, 'An Tran', '123 Pham Ngu Lao', '0914567890', 27, NULL),
(45, 'Thinh Tran', '889 Nguyen Thao Phuong 2 Quan 6 tphcm', '0987654321', 28, NULL),
(46, 'Mina', '123 Pham Ngu Lao', '0913555341', 29, NULL),
(47, 'Annie', '158 Sweet Candy, Bao Loc, VN', '0913555323', 1, NULL),
(48, 'Lien Nguyen', '109 Ly Thanh Tong, Q.1, TP.HCM', '0913425696', 30, NULL),
(49, 'Mina', '31, Nguyen Hue, Q.1, TP.HCM', '0918133998', 32, NULL),
(50, 'Mai Tran', '31, Nguyen Hue, Q.1, TP.HCM', '0913270191', 33, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `sales_payment_method` varchar(100) DEFAULT NULL,
  `sales_custname` varchar(100) DEFAULT NULL,
  `sales_cust_payment` double DEFAULT NULL,
  `sales_discount` double DEFAULT NULL,
  `sales_date` date DEFAULT NULL,
  `sales_amount` double DEFAULT NULL,
  `mst` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `invoice_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `sales_payment_method`, `sales_custname`, `sales_cust_payment`, `sales_discount`, `sales_date`, `sales_amount`, `mst`, `user_id`, `invoice_number`) VALUES
(1, 'Cash', 'Kitty', 86, 0, '2022-03-11', 86, 0, 1, 1),
(2, 'Cash', 'N/A', 30, 0, '2022-03-11', 30, 0, 1, 2),
(3, 'Cash', 'Emma', 80, 0, '2022-03-11', 80, 0, 1, 3),
(4, 'Credit', 'Mina', 45, 0, '2022-03-11', 45, 0, 1, 4),
(5, 'cash', 'Henry Jay', NULL, NULL, '2022-03-10', 80, 1, 1, 5),
(6, 'cash', 'Henry Jay', NULL, NULL, '2022-03-10', 80, 1, 1, 6),
(7, 'credit', 'Washington Lee', NULL, NULL, '2022-03-10', 175, 14002, 1, 7),
(8, 'cash', 'Elisa Nguyen', NULL, NULL, '2022-02-28', 175, 14000, 1, 8),
(9, 'cash', 'Yen Nguyen', NULL, NULL, '2022-03-10', 200, 14006, 1, 9),
(10, 'cash', 'Henry Jay', NULL, NULL, '2022-03-11', 80, 14007, 1, 10),
(11, 'cash', 'Henry Jay', NULL, NULL, '2022-03-11', 80, 14007, 1, 11),
(12, 'cash', 'Henry Jay', NULL, NULL, '2022-03-11', 80, 14007, 1, 12),
(13, 'credit', 'Washington Lee', NULL, NULL, '2022-03-11', 115, 14008, 1, 13),
(14, 'Cash', 'CL', 120, 0, '2022-03-15', 160, 0, 1, 14),
(15, 'Credit Card', '2', 130, 0, '2022-03-15', 110, 0, 1, 15),
(16, 'Credit Card', '33', 160, 0, '2022-03-15', 166, 0, 1, 16),
(17, 'check', 'Joyce Smith', NULL, NULL, '2022-03-14', 163, 14009, 1, 17),
(18, 'Cash', 'N/A', 40, 0, '2022-03-15', 40, 0, 1, 18),
(19, 'zelle', 'Alice Tran', NULL, NULL, '2022-03-15', 70, 14010, 2, 19),
(20, 'cash', 'NA', 40, 0, '2022-03-15', 40, 0, 2, 20),
(21, 'cash', 'NA', 86, 0, '2022-03-15', 86, 0, 3, 21),
(22, 'cash', 'NA', 35, 0, '2022-03-16', 35, 0, 1, 22),
(23, 'cash', 'NA', 40, 0, '2022-03-16', 40, 0, 2, 23),
(24, 'cash', 'Anne Tran', NULL, NULL, '2022-03-16', 115, 14011, 2, 24),
(25, 'cash', 'Anh Tran', NULL, NULL, '2022-03-18', 73, 14012, 2, 25),
(26, 'cash', 'Nancy Tran', NULL, NULL, '2022-03-18', 73, 14013, 2, 26),
(27, 'cash', 'Washington Lee', NULL, NULL, '2022-03-16', 80, 14014, 2, 27),
(28, 'credit', 'Alice Tran', NULL, NULL, '2022-03-16', 70, 14015, 2, 28),
(29, 'zelle', 'Phuong Tran', NULL, NULL, '2022-03-18', 40, 14017, 3, 29),
(30, 'zelle', 'Phuong Tran', NULL, NULL, '2022-03-18', 40, 14017, 3, 30),
(31, 'zelle', 'Phuong Tran', NULL, NULL, '2022-03-18', 40, 14017, 3, 31),
(32, 'zelle', 'Alex Mai', NULL, NULL, '2022-03-17', 40, 14021, 3, 32),
(33, 'check', 'John Smith', NULL, NULL, '2022-03-17', 43, 14022, 3, 33),
(34, 'venmo', 'Kitty', NULL, NULL, '2022-03-17', 0, 14024, 3, 34),
(35, 'venmo', 'Kitty', NULL, NULL, '2022-03-17', 0, 14024, 3, 35),
(36, 'credit', 'Anh Tran', NULL, NULL, '2022-03-17', 70, 14025, 3, 36);

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `sales_order_id` int(11) NOT NULL,
  `invoice` varchar(100) DEFAULT NULL,
  `qty_picked` int(11) DEFAULT NULL,
  `sales_order_amount` double DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `sales_unit_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`sales_order_id`, `invoice`, `qty_picked`, `sales_order_amount`, `product_id`, `sales_id`, `sales_unit_price`) VALUES
(1, '1', 2, 86, 60, 1, 43),
(2, '2', 1, 30, 63, 2, 30),
(3, '3', 2, 80, 61, 3, 40),
(4, '4', 3, 45, 64, 4, 15),
(5, '5', 2, NULL, 61, 5, 40),
(6, '6', 2, NULL, 61, 5, 40),
(7, '7', 5, NULL, 59, 7, 35),
(8, '8', 5, NULL, 59, 8, 35),
(9, '9', 10, 100, 59, 9, 35),
(10, '10', 2, 80, 58, 10, 40),
(11, '13', 2, 80, 58, 13, 40),
(12, '13', 1, 35, 59, 13, 35),
(13, '14', 4, 160, 61, 14, 40),
(14, '15', 2, 70, 59, 15, 35),
(15, '15', 1, 40, 61, 15, 40),
(16, '16', 1, 35, 59, 16, 35),
(19, '16', 1, 35, 59, 16, 35),
(20, '17', 1, 43, 60, 17, 43),
(21, '17', 3, 120, 61, 17, 40),
(22, '18', 1, 40, 58, 18, 40),
(23, '19', 2, 70, 59, 19, 35),
(24, '20', 1, 40, 61, 20, 40),
(25, '21', 2, 86, 60, 21, 43),
(26, '22', 1, 35, 59, 22, 35),
(27, '23', 1, 40, 61, 23, 40),
(28, '24', 2, 80, 58, 24, 40),
(29, '24', 1, 35, 59, 24, 35),
(30, '25', 6, 210, 59, 25, 35),
(31, '26', 6, 210, 59, 26, 35),
(32, '27', 2, 80, 58, 27, 40),
(33, '28', 2, 70, 59, 28, 35),
(34, '29', 1, 40, 62, 29, 40),
(35, '29', 1, 40, 62, 29, 40),
(36, '29', 1, 40, 62, 29, 40),
(37, '32', 1, 40, 58, 32, 40),
(38, '33', 1, 43, 60, 33, 43),
(39, '36', 2, 70, 59, 36, 35);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_order`
--

CREATE TABLE `shipping_order` (
  `shipping_order_id` int(11) NOT NULL,
  `mst` varchar(100) NOT NULL,
  `send_date` date NOT NULL,
  `airport_delivery_date` date NOT NULL,
  `total_weight` double NOT NULL,
  `num_of_packages` int(11) NOT NULL,
  `package_value` double NOT NULL,
  `custom_fee` double DEFAULT NULL,
  `insurance` double DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `recipient_id` int(11) DEFAULT NULL,
  `price_per_lb` double DEFAULT NULL,
  `amount` double NOT NULL,
  `custom_fee_taxed_item` varchar(200) DEFAULT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping_order`
--

INSERT INTO `shipping_order` (`shipping_order_id`, `mst`, `send_date`, `airport_delivery_date`, `total_weight`, `num_of_packages`, `package_value`, `custom_fee`, `insurance`, `payment_method`, `user_id`, `location`, `customer_id`, `recipient_id`, `price_per_lb`, `amount`, `custom_fee_taxed_item`, `sales_id`, `note`) VALUES
(1, '14000', '2022-02-28', '2022-02-28', 16.5, 1, 0, 0, 0, 'cash', 1, 'Tỉnh (Province)', 22, 38, 3.25, 228.63, 'NONE', 8, NULL),
(2, '14001', '2022-03-03', '2022-03-03', 13, 1, 250, 16, 0, 'credit', 1, 'Sài Gòn', 8, 19, 3.25, 58.25, '8 lbs Vitamin', NULL, NULL),
(3, '14002', '2022-03-05', '2022-03-05', 11, 1, 0, 20, 0, 'zelle', 1, 'Sài Gòn', 1, 39, 3.25, 55.75, '8 shoes', NULL, NULL),
(4, '14003', '2022-03-08', '2022-03-08', 27.5, 2, 80, 10, 0, 'cash', 1, 'Tinh', 23, 40, 3.75, 113.13, '5 Ensure', NULL, NULL),
(5, '14004', '2022-03-10', '2022-03-10', 7.5, 1, 0, 6, 0, 'venmo', 1, 'Sài Gòn', 2, 2, 3.25, 30.38, '3 shoes', NULL, NULL),
(6, '14005', '2022-03-08', '2022-03-08', 15, 1, 0, 16, 0, 'cash', 1, 'Sài Gòn', 10, 21, 3.5, 68.5, '8 lbs vitamin', NULL, NULL),
(7, '14006', '2022-03-10', '2022-03-10', 40, 1, 80, 0, 0, 'cash', 1, 'Tỉnh (Province)', 24, 41, 3.75, 350, 'NONE', 9, NULL),
(8, '14007', '2022-03-11', '2022-03-11', 12, 1, 250, 0, 0, 'cash', 1, 'Sai Gon', 8, 19, 3.5, 122, 'NONE', 10, NULL),
(9, '14008', '2022-03-11', '2022-03-11', 19, 1, 80, 0, 0, 'credit', 1, 'Tỉnh (Province)', 13, 28, 3.75, 186.25, 'NONE', 13, NULL),
(10, '14009', '2022-03-14', '2022-03-16', 14.3, 1, 50, 15, 0, 'check', 1, 'Sai Gon', 9, 20, 3.5, 228.05, '4 Shoes', 17, NULL),
(12, '14010', '2022-03-15', '2022-03-15', 17, 1, 0, 35, 0, 'zelle', 2, 'Tỉnh (Province)', 2, 12, 3.75, 168.75, '10 shoes', 19, NULL),
(13, '14011', '2022-03-16', '2022-03-16', 23.5, 2, 80, 16, 0, 'cash', 2, 'Tỉnh (Province)', 14, 30, 3.5, 213.25, '8 shoes', 24, NULL),
(14, '14012', '2022-03-18', '2022-03-20', 15.67, 1, 0, 150, 10, 'cash', 2, 'Sài Gòn', 25, 42, 2.95, 279.23, 'Iphone 12', 25, NULL),
(15, '14013', '2022-03-18', '2022-03-20', 40.8, 2, 0, 150, 10, 'cash', 2, 'Tỉnh (Province)', 26, 43, 3.75, 386, 'Iphone 12', 26, NULL),
(16, '14014', '2022-03-16', '2022-03-16', 7.45, 1, 80, 0, 0, 'cash', 2, 'Sài Gòn', 13, 28, 3.25, 104.21, 'NA', 27, NULL),
(17, '14015', '2022-03-16', '2022-03-16', 11.25, 1, 0, 0, 0, 'credit', 2, 'Sài Gòn', 2, 2, 3.75, 112.19, 'NA', 28, NULL),
(18, '14016', '2022-03-16', '2022-03-19', 5, 1, 0, 0, 0, 'cash', 3, 'Sài Gòn', 27, 44, 3.5, 17.5, 'NA', NULL, NULL),
(19, '14017', '2022-03-18', '2022-03-20', 40.31, 3, 0, 55, 10, 'zelle', 3, 'Sài Gòn', 28, 45, 2.95, 231.91, 'Ipad, airpods', 29, NULL),
(20, '14018', '2022-03-16', '2022-03-18', 23.209999999999997, 4, 0, 0, 0, 'cash', 3, 'Sài Gòn', 29, 46, 3.25, 75.43, 'NA', NULL, NULL),
(21, '14019', '2022-03-16', '2022-03-18', 22.82, 3, 50, 0, 0, 'zelle', 3, 'Sài Gòn', 9, 20, 3.25, 74.17, 'NA', NULL, NULL),
(22, '14020', '2022-03-17', '2022-03-17', 24.33, 3, 0, 0, 0, 'cash', 3, 'Sài Gòn', 1, 47, 3.25, 79.07, 'NA', NULL, NULL),
(23, '14021', '2022-03-17', '2022-03-21', 25.05, 4, 0, 100, 10, 'zelle', 3, 'Sài Gòn', 30, 48, 3.25, 231.41, 'ipad', 32, 'Order is cancelled'),
(24, '14022', '2022-03-17', '2022-03-21', 20.35, 3, 0, 4, 10, 'check', 3, 'Tỉnh (Province)', 1, 4, 3.75, 133.31, '2 shoes', 33, NULL),
(25, '14023', '2022-03-17', '2022-03-17', 12.16, 3, 0, 0, 0, 'zelle', 3, 'Tỉnh (Province)', 32, 49, 3.75, 45.6, 'NA', NULL, NULL),
(26, '14024', '2022-03-17', '2022-03-17', 19.85, 3, 0, 0, 0, 'venmo', 3, 'Sài Gòn', 33, 50, 3.25, 64.51, 'NA', 34, NULL),
(27, '14025', '2022-03-18', '2022-03-21', 11.35, 1, 0, 0, 0, 'credit', 3, 'Sài Gòn', 25, 42, 3.25, 106.89, 'NA', 36, 'Refund to customer'),
(28, '14026', '2022-03-18', '2022-03-18', 6.75, 1, 80, 0, 0, 'venmo', 3, 'Tinh', 13, 28, 3.25, 21.94, 'NA', NULL, NULL),
(29, '14027', '2022-03-18', '2022-03-18', 6.78, 1, 0, 0, 0, 'zelle', 3, 'Sài Gòn', 13, 28, 3.25, 22.04, 'NA', NULL, 'Order is cancelled');

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
(6, 'Multi-Vitamin', '88 Skylight', 'Max', '5718890945', ''),
(7, 'HealthySnack', '34 Rock Street', 'Ana Tran', '5716664747', ''),
(8, 'Con Gau', '12345 de la Mer', 'Ocean', '301 123 4567', 'hieu con gau'),
(9, 'Con Ga To', '1 de la rue', 'street', '703 123 4567', 'chuon ga');

-- --------------------------------------------------------

--
-- Table structure for table `temp_package`
--

CREATE TABLE `temp_package` (
  `pkg_id` int(11) NOT NULL,
  `shipping_order_id` int(11) NOT NULL,
  `package_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp_package`
--

INSERT INTO `temp_package` (`pkg_id`, `shipping_order_id`, `package_desc`) VALUES
(1, 1, '10 Fish Oils'),
(2, 2, '15 Ensure'),
(3, 2, '10 Vitamin C, 100 Ginger Candies, 28 dried dates'),
(4, 3, '10 Candies, 10 Ensures, 15 Fish Oils'),
(5, 4, '100 Candies,  15 Fish Oils'),
(6, 4, '80 Candies,  15 Fish Oils'),
(7, 5, '80 Candies,  15 Fish Oils'),
(8, 6, '35 Fish Oils'),
(9, 7, '38 Vitamin C');

-- --------------------------------------------------------

--
-- Table structure for table `temp_shipping_order`
--

CREATE TABLE `temp_shipping_order` (
  `shipping_order_id` int(11) NOT NULL,
  `num_of_package` int(11) NOT NULL,
  `package_value` double DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `cust_name` varchar(100) NOT NULL,
  `cust_address` varchar(100) DEFAULT NULL,
  `cust_city` varchar(100) DEFAULT NULL,
  `cust_state` varchar(100) DEFAULT NULL,
  `cust_zip` int(11) DEFAULT NULL,
  `cust_phone` varchar(10) NOT NULL,
  `cust_email` varchar(100) DEFAULT NULL,
  `recipient_name` varchar(100) NOT NULL,
  `recipient_address` varchar(100) NOT NULL,
  `recipient_phone` varchar(10) NOT NULL,
  `recipient_email` varchar(100) DEFAULT NULL,
  `submitted_date` date DEFAULT NULL,
  `package_desc` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `temp_shipping_order`
--

INSERT INTO `temp_shipping_order` (`shipping_order_id`, `num_of_package`, `package_value`, `location`, `cust_name`, `cust_address`, `cust_city`, `cust_state`, `cust_zip`, `cust_phone`, `cust_email`, `recipient_name`, `recipient_address`, `recipient_phone`, `recipient_email`, `submitted_date`, `package_desc`) VALUES
(1, 1, 250, 'Sai Gon', 'Henry Jay', '123 Rose Street', 'Fairfax', 'VA', 21035, '5715289496', 'hjay@gmail.com', 'Nguyen Nguyen', '88 To Hien Thanh, Q.10. TP. HCM', '0913555678', NULL, '2022-01-28', '10 Vitamin C, 100 Ginger Candies, 28 dried dates'),
(2, 2, 80, 'Tinh', 'Anne Tran', '78 Langley Street', 'Chantilly', 'VA', 22055, '7035678907', NULL, 'Ngoc Tran', '90 Ben Thanh, Q.1, TP.HCM', '0813555698', NULL, '2022-01-27', 'Package 1: 10 Vitamin C, 10 Ginger Candies\r\nPackage 2: 20 dried dates'),
(3, 1, 50, 'Sai Gon', 'Joyce Smith', '55 Wall Street', 'Chantilly', 'VA', 20489, '5718889090', NULL, 'Alex Chau', '88 NTMK, Q.3', '0918855378', NULL, '2022-01-28', '8 Fish Oils, 100 Lolippop, clothes'),
(4, 2, 80, 'Tinh', 'Emma Tran', '78 Langley Street', 'Chantilly', 'VA', 22055, '7035678907', NULL, 'Hong Ai', '1000 Ben Thanh, Q.1, TP.HCM', '0917675678', NULL, '2022-01-25', 'Package 1: 9 Shoes, 10 Ensure\r\nPackage 2: 18 Fish Oils'),
(5, 1, 80, 'Tinh', 'Washington Lee', '99 BLuesky', 'Chantilly', 'VA', 22055, '3035678907', NULL, 'Anita', '10 Nguyen Dinh Chieu, Q.1, TP.HCM', '0913888678', NULL, '2022-01-26', '5 Vitamin C, 8 Ensure, 28 dried dates'),
(6, 1, 80, 'Saigon', 'Johanna', '78 Langley Street', 'Chantilly', 'VA', 22055, '2035678907', NULL, 'Hong Ai', '1000 Ben Thanh, Q.1, TP.HCM', '0916123678', NULL, '2022-01-15', '10 Vitamin E, 5 shoes'),
(7, 1, 80, 'Saigon', 'Yen Nguyen', '22 Langley Street', 'Chantilly', 'VA', 22055, '2035678907', NULL, 'Hong Ai', '72 Ben Thanh, Q.1, TP.HCM', '0919909678', NULL, '2022-01-13', '8 Salt package, 5 dried dates box');

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
(1, 'admin', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin'),
(2, 'owner', 'Mrs. Stephanie', '579233b2c479241523cba5e3af55d0f50f2d6414', 'owner'),
(3, 'employee1', 'Employee 1', '73b6475fd5fe4c0750e094f547cd94abfb624351', 'employee'),
(4, 'employee2', 'Employee 2', '3207b110d19a0663da1b30eb96851edec739f736', 'employee');

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
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `supplier_id_purchase_tbl` (`supplier_id`),
  ADD KEY `user_id_purchase_tbl` (`user_id`),
  ADD KEY `product_id_purchase_tbl` (`product_id`);

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
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `user_id_tbl_sales` (`user_id`);

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
  ADD KEY `location_id` (`location`),
  ADD KEY `sales_id_tbl_shipping_order` (`sales_id`);

--
-- Indexes for table `supliers`
--
ALTER TABLE `supliers`
  ADD PRIMARY KEY (`suplier_id`);

--
-- Indexes for table `temp_package`
--
ALTER TABLE `temp_package`
  ADD PRIMARY KEY (`pkg_id`),
  ADD KEY `shipping_order_id_temp_shipping_order_tbl` (`shipping_order_id`);

--
-- Indexes for table `temp_shipping_order`
--
ALTER TABLE `temp_shipping_order`
  ADD PRIMARY KEY (`shipping_order_id`),
  ADD KEY `location_id` (`location`);

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
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `pkg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `recipient`
--
ALTER TABLE `recipient`
  MODIFY `recipient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `sales_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `shipping_order`
--
ALTER TABLE `shipping_order`
  MODIFY `shipping_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `supliers`
--
ALTER TABLE `supliers`
  MODIFY `suplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `temp_package`
--
ALTER TABLE `temp_package`
  MODIFY `pkg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `temp_shipping_order`
--
ALTER TABLE `temp_shipping_order`
  MODIFY `shipping_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `package`
--
ALTER TABLE `package`
  ADD CONSTRAINT `shipping_order_id` FOREIGN KEY (`shipping_order_id`) REFERENCES `shipping_order` (`shipping_order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `product_id_purchase_tbl` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_id_purchase_tbl` FOREIGN KEY (`supplier_id`) REFERENCES `supliers` (`suplier_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_purchase_tbl` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipient`
--
ALTER TABLE `recipient`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `user_id_tbl_sales` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `sales_id_tbl_shipping_order` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`sales_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipping_order_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `temp_package`
--
ALTER TABLE `temp_package`
  ADD CONSTRAINT `shipping_order_id_temp_shipping_order_tbl` FOREIGN KEY (`shipping_order_id`) REFERENCES `temp_shipping_order` (`shipping_order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
