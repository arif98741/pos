-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2017 at 10:21 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dts`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandid` int(11) NOT NULL,
  `brandname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandid`, `brandname`, `address`) VALUES
(1, 'Akij Ceramics Ltd', 'Mohakhali DOHS'),
(2, 'PRAN RFL Group', 'Tongi, Gazipur'),
(3, 'Navana Group', 'Farmgate Branch'),
(4, 'Bosundara Cement Ltd', 'Basundara, Baridara DOHS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

CREATE TABLE `tbl_color` (
  `colorid` int(11) NOT NULL,
  `colorname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_color`
--

INSERT INTO `tbl_color` (`colorid`, `colorname`) VALUES
(1, 'blue'),
(2, 'lightblue'),
(3, 'green'),
(4, 'lightgreen'),
(5, 'brown'),
(6, 'black'),
(7, 'ash'),
(8, 'yellow'),
(9, 'pink');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `serial` int(11) NOT NULL,
  `customer_id` varchar(10) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `email` varchar(80) NOT NULL,
  `opening_balance` decimal(5,0) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `discount` int(11) NOT NULL,
  `updateby` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`serial`, `customer_id`, `customer_name`, `address`, `contact_no`, `email`, `opening_balance`, `remark`, `discount`, `updateby`) VALUES
(101, '14', 'Arif', 'Tangail', '012-25-6538', 'arifsofg@gmail.com', '0', 'Good', 250, 1),
(107, '125', 'Kamrul Islam', 'Kalihati', '02-894343-454', 'kamrul@gmail.com', '1300', 'Good', 1200, 0),
(122, '123', 'Jhon Doe', 'Usa', '01923-xxxxxx', 'jhon@gmail.com', '2560', 'Good', 1200, 1),
(126, '127', 'Shamim AL-Deen', 'Ghatail, Tangail', '01738-298666', 'shamimaldeen@gmail.com', '5620', 'Good and Outstanding', 250, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

CREATE TABLE `tbl_group` (
  `groupid` int(11) NOT NULL,
  `groupname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`groupid`, `groupname`) VALUES
(1, 'Wall'),
(2, 'Varanda'),
(3, 'Room'),
(4, 'Floor'),
(5, 'Rooftop'),
(6, 'Layout'),
(7, 'Front');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `serial` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `carton` int(11) NOT NULL,
  `piece` int(11) NOT NULL,
  `purchase` int(6) NOT NULL,
  `subtotal` float NOT NULL,
  `total` float NOT NULL,
  `date` date NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `updateby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_products`
--

CREATE TABLE `tbl_invoice_products` (
  `serial_no` int(11) NOT NULL,
  `invoice_id` varchar(20) NOT NULL,
  `product_id` varchar(5) NOT NULL,
  `quantity` int(11) NOT NULL,
  `carton` int(11) NOT NULL,
  `piece` int(11) NOT NULL,
  `purchase` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `serial` int(11) NOT NULL,
  `product_id` varchar(8) NOT NULL,
  `product_type` int(11) NOT NULL,
  `product_group` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_brand` int(11) NOT NULL,
  `size_h` int(4) NOT NULL,
  `size_w` int(4) NOT NULL,
  `color` text NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `unit_price` float NOT NULL DEFAULT '0',
  `purchase_price` float NOT NULL DEFAULT '0',
  `piece_in_a_carton` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`serial`, `product_id`, `product_type`, `product_group`, `product_name`, `product_brand`, `size_h`, `size_w`, `color`, `price`, `unit_price`, `purchase_price`, `piece_in_a_carton`, `last_update`, `updateby`) VALUES
(84, '1207', 1, 1, 'Navana Chair', 1, 65, 67, 'Lightblue', 1208, 678, 453, 4343, '2017-09-27 19:41:30', 0),
(85, '1208', 1, 4, 'Whirpool Refrigerator', 4, 79, 454, 'White', 1208, 487, 454, 87, '2017-10-25 10:35:35', 1),
(86, '1209', 6, 2, 'Samsung j7', 3, 75, 34, 'Green`', 1210, 689, 142, 35, '2017-09-21 09:59:06', 0),
(87, '1211', 5, 6, 'IPhone 10', 2, 45, 67, 'Lightgray', 1211, 567, 213, 10, '2017-10-06 09:32:21', 0),
(88, '1212', 3, 7, 'Samsung J2', 4, 14, 454, 'White', 1212, 75, 11, 56, '2017-10-29 20:50:10', 1),
(89, '1214', 1, 1, 'Symphony Helio', 4, 36, 67, 'Lightblue', 1210, 48, 89, 456, '2017-10-05 23:04:43', 0),
(90, '1215', 4, 5, 'HP 15-AC108TU', 2, 56, 112, 'Magento', 48000, 520, 54600, 6, '2017-10-05 23:06:26', 0),
(91, '1216', 2, 4, 'Note 3', 4, 14, 22, 'White', 1216, 224, 24000, 48, '2017-10-06 21:39:49', 1),
(92, '1213', 5, 5, 'Nokia N97', 1, 26, 32, 'Skyblue', 14500, 149, 15200, 6, '2017-10-05 23:13:59', 0),
(93, '1210', 3, 4, 'Otobi Chair', 3, 56, 54, 'Brown', 1210, 1340, 1400, 2, '2017-10-29 20:57:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sell`
--

CREATE TABLE `tbl_sell` (
  `serial` int(11) NOT NULL,
  `sell_id` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `seller` int(11) NOT NULL,
  `sub_total` float NOT NULL,
  `grand_total` float NOT NULL,
  `paid` float NOT NULL,
  `due` float NOT NULL,
  `status` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sell`
--

INSERT INTO `tbl_sell` (`serial`, `sell_id`, `customer_id`, `seller`, `sub_total`, `grand_total`, `paid`, `due`, `status`, `date`, `updateby`) VALUES
(35, '1020171000000', 121, 1, 84505.8, 411259, 352511, 58747.9, 0, '2017-10-24 22:38:33', 1),
(52, '1020171000001', 126, 1, 10298.8, 2433.48, 2500, 0, 0, '2017-10-29 17:34:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sell_products`
--

CREATE TABLE `tbl_sell_products` (
  `serial_no` int(11) NOT NULL,
  `sell_id` varchar(20) NOT NULL,
  `customer_id` int(5) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `product_piece` int(5) NOT NULL,
  `unit_price` float NOT NULL,
  `discount` varchar(5) NOT NULL DEFAULT 'null',
  `subtotal` float NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sell_products`
--

INSERT INTO `tbl_sell_products` (`serial_no`, `sell_id`, `customer_id`, `product_id`, `quantity`, `product_piece`, `unit_price`, `discount`, `subtotal`, `status`) VALUES
(187, '1020171000000', 121, 1211, 45, 54, 30618, 'null', 14084.3, 1),
(418, '1020171000001', 126, 1215, 21, 12, 6240, 'null', 6115.2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `serial` int(11) NOT NULL,
  `supplier_id` varchar(10) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `opening_balance` float NOT NULL,
  `remark` varchar(80) NOT NULL,
  `updateby` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`serial`, `supplier_id`, `supplier_name`, `address`, `contact_no`, `email`, `contact_person`, `opening_balance`, `remark`, `updateby`) VALUES
(68, '2', 'Shamim Al-Deen', 'Ghatail', '01738298666', 'shamimaldeen@gmail.com', 'Shamim', 13000, 'Wow', 1),
(69, '3', 'Roudro Mehedi', 'Sherpur', '019XX-YYYYYY', 'roudro.m@gmail.com', 'Roudro', 13000, 'Wow', 1),
(74, '5', 'Idris Hossain', 'Sherpur', '01922-552222', 'idris@gmail.com', 'Contact Person', 25698, 'Better', 1),
(75, '6', 'Raisul Islam', 'Narayangonj', '01548-xxxxxx', 'raisul@gmail.com', 'Raisul', 2540, 'Outstanding', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `typeid` int(11) NOT NULL,
  `typename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`typeid`, `typename`) VALUES
(1, 'SQFT'),
(2, 'DQPT'),
(3, 'PTPT'),
(4, 'SLDT'),
(5, 'RAPF'),
(6, 'BASF');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `password`, `name`, `email`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Ariful Islam', 'admin@gmail.com', 'admin'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Shamim Al-Deen', 'user@gmail.com', 'user'),
(3, 'mamun', 'c8e36a853fe91f3a4a3c4d739e830139', 'Abdullah Al-Mamun', 'mamun@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD PRIMARY KEY (`colorid`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_group`
--
ALTER TABLE `tbl_group`
  ADD PRIMARY KEY (`groupid`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_invoice_products`
--
ALTER TABLE `tbl_invoice_products`
  ADD PRIMARY KEY (`serial_no`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_sell`
--
ALTER TABLE `tbl_sell`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_sell_products`
--
ALTER TABLE `tbl_sell_products`
  ADD PRIMARY KEY (`serial_no`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`typeid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `colorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `tbl_group`
--
ALTER TABLE `tbl_group`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_invoice_products`
--
ALTER TABLE `tbl_invoice_products`
  MODIFY `serial_no` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `tbl_sell`
--
ALTER TABLE `tbl_sell`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `tbl_sell_products`
--
ALTER TABLE `tbl_sell_products`
  MODIFY `serial_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;
--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `typeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
