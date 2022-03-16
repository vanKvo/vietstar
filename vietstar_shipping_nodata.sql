-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 16, 2022 at 01:29 PM
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
-- Database: `vietstar_shipping_nodata`
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
  `supplier` varchar(100) DEFAULT NULL,
  `qty_onhand` int(10) DEFAULT NULL,
  `product_location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `sales_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `temp_package`
--

CREATE TABLE `temp_package` (
  `pkg_id` int(11) NOT NULL,
  `shipping_order_id` int(11) NOT NULL,
  `package_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `pkg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `recipient`
--
ALTER TABLE `recipient`
  MODIFY `recipient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `sales_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `shipping_order`
--
ALTER TABLE `shipping_order`
  MODIFY `shipping_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
