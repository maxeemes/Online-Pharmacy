-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 15, 2019 at 02:14 PM
-- Server version: 5.6.37
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy_db`
--
CREATE DATABASE IF NOT EXISTS `pharmacy_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pharmacy_db`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_category` varchar(50) NOT NULL,
  `category_status` enum('0','1') NOT NULL,
  `category_sub` varchar(4) NOT NULL,
  `category_image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_category`, `category_status`, `category_sub`, `category_image`) VALUES
(1, 'Сердечные', '1', 'null', 'img/cats/5.png'),
(2, 'Витамины', '1', 'null', 'img\\cats\\5.png'),
(8, 'пРОТИВОПРОСТУДНЫЕ', '1', '2', 'imgcats5.png');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_type` enum('0','1') NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_adress` varchar(100) NOT NULL,
  `customer_phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `deal`
--

CREATE TABLE `deal` (
  `deal_id` int(11) NOT NULL,
  `deal_name_customer` varchar(150) NOT NULL,
  `deal_product_name` varchar(1024) NOT NULL,
  `deal_count` varchar(255) NOT NULL,
  `deal_date` varchar(10) NOT NULL,
  `deal_delivery_type` enum('0','1') NOT NULL,
  `deal_cost` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `status` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login`, `password`, `salt`, `status`) VALUES
('admin', 'd2a199170846839629d614b0d9c51817', '30c4490522', '1'),
('root', '5c28f164884f5aa15e70c1d64af45c25', '9d234346ac', '2'),
('user', 'f10bdf34dd548c162390dd99c97a0cb2', 'b8ca5d80ef', '0');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_cost` int(6) NOT NULL,
  `product_description` varchar(512) NOT NULL,
  `product_image` varchar(124) NOT NULL,
  `product_count` int(10) NOT NULL,
  `product_characteristic` varchar(512) NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_cost`, `product_description`, `product_image`, `product_count`, `product_characteristic`, `product_category`, `product_status`) VALUES
(1, 'аврпва', 200000, 'ваываывавыаымвымывс', 'img\\cats\\5.png', 34, 'вапва', 1, '1'),
(2, 'таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка ', 220000, 'таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка ', './img/5.png', 1, 'таблетка - таблетка', 1, '1'),
(3, 'таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка ', 230000, 'таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка таблетка ', 'img/5.png', 1, 'таблетка - таблетка', 2, '1'),
(5, 'gdfg', 231, 'fgdydtyd', 'img/products/5.png', 12, 'ert-ret;-', 8, '1'),
(7, 'аыуа', 34, '3424', 'img/products/5.png', 432, '234-324;234-3424', 8, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `deal`
--
ALTER TABLE `deal`
  ADD PRIMARY KEY (`deal_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `deal`
--
ALTER TABLE `deal`
  MODIFY `deal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
