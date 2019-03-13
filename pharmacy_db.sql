-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 13, 2019 at 02:42 PM
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
(8, 'пРОТИВОПРОСТУДНЫЕ', '1', '2', 'img/cats/5.png'),
(9, 'от головы', '1', 'null', 'img/cats/5.png'),
(10, 'sgdg', '1', 'null', 'img/cats/5.png'),
(11, 'dsfdf', '1', 'null', 'img/cats/5.png'),
(12, 'sfdsdf', '1', 'null', 'img/cats/5.png'),
(13, 'fsdsdf', '1', 'null', 'img/cats/5.png'),
(14, 'sgsdg', '1', 'null', 'img/cats/5.png'),
(15, 'grgerg', '1', '1', 'img/subcats/5.png'),
(16, 'vitamin', '1', '2', 'img/subcats/5.png'),
(17, 'LOGOTIPS', '1', 'null', './img/cats/logotip.jpg'),
(18, 'logotip', '1', '2', './img/subcats/logotip.jpg'),
(19, '34234', '1', '10', 'img/subcats/5.png'),
(20, '324', '1', '9', 'img/subcats/5.png'),
(21, 'logo', '1', '17', 'img/subcats/5.png');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_type` int(11) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_adress` varchar(100) NOT NULL,
  `customer_phone` varchar(11) NOT NULL,
  `customer_status` int(11) NOT NULL,
  `customer_user` varchar(150) DEFAULT NULL,
  `customer_title` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_type`, `customer_name`, `customer_adress`, `customer_phone`, `customer_status`, `customer_user`, `customer_title`) VALUES
(4, 1, 'gfdgsd fdgfdgsdf gdfgdsfgdf', 'gdfgsfgsdf', '9999999999', 1, NULL, NULL),
(5, 1, 'Организа', 'Адддддддддд', '234234234', 1, NULL, NULL),
(6, 1, 'Фам Им Отч', 'Аддр', '88888888888', 1, NULL, NULL),
(7, 1, 'выаыва выаыва ываыва', 'аыва', '32432432432', 1, NULL, NULL),
(8, 1, 'авыа выаыва ваыва', 'ываыв', '423432', 1, NULL, NULL),
(9, 0, 'выаыва выаыва ваыаыв', 'ываы', '66666666666', 1, NULL, NULL),
(10, 1, '342342', '234234234234234234234', '32423423423', 1, 'user', NULL),
(11, 0, '32434 324234 324234', '4234', '34234', 1, 'user', NULL),
(12, 0, 'Иванов  Иван', 'ул. Пушкина д. Колотушкина', '88005553535', 1, 'user', NULL);

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
  `deal_cost` int(15) NOT NULL,
  `deal_status` enum('1','0') NOT NULL,
  `deal_user` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deal`
--

INSERT INTO `deal` (`deal_id`, `deal_name_customer`, `deal_product_name`, `deal_count`, `deal_date`, `deal_delivery_type`, `deal_cost`, `deal_status`, `deal_user`) VALUES
(1, 'Организа', 'sadas;asfsadfd;5345', '1;1;1', '13.03.19', '0', 4836, '1', NULL),
(2, 'gfdgsd fdgfdgsdf gdfgdsfgdf', '', '1', '13.03.19', '0', 0, '1', NULL),
(3, '342342', 'sadas;asfsadfd', '1;1', '13.03.19', '0', 527, '1', NULL),
(4, '342342', 'sadas;asfsadfd;5345', '1;1;1', '13.03.19', '0', 4836, '1', NULL),
(5, '342342', 'sadas;21312', '1;1', '13.03.19', '0', 305560, '1', 'user'),
(6, '', 'sadas', '1', '13.03.19', '0', 305, '1', 'user'),
(7, '', 'asfsadfd', '1', '13.03.19', '0', 222, '1', 'user'),
(8, '342342', 'sadas', '1', '13.03.19', '0', 305, '1', 'user'),
(9, '342342', 'sadas;5345', '1;1', '13.03.19', '1', 5487, '1', 'user'),
(10, '32434 324234 324234', 'asfsadfd', '1', '13.03.19', '0', 222, '1', 'user'),
(11, 'Иванов  Иван', 'sadas;5345;3423553', '1;999;1', '13.03.19', '0', 4304469, '1', 'user');

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
(7, 'аыуа', 34, '3424', 'img/products/5.png', 432, '234-324;234-3424', 8, '1'),
(8, 'sadas', 321, '123243254365787', 'img/products/5.png', 1121, '2313-231', 15, '1'),
(9, 'asfsadfd', 234, 'sada', 'img/products/5.png', 2425, 'asd-sda', 15, '1'),
(11, '5345', 4535, '435435', 'img/products/5.png', 434339, '545435-5435', 15, '1'),
(12, '342', 121, 'описание', 'img/products/5.png', 32424, '4324-4324', 16, '1'),
(14, '2134123', 3131, '3213', 'img/products/5.png', 213123, '3123-123123', 16, '1'),
(15, '3423553', 234, '34234', 'img/products/5.png', 466455, '23434-34234', 16, '1'),
(16, '2342344', 324234, '234234234', 'img/products/5.png', 4234343, '34324-234234234', 16, '1'),
(17, '6546345', 3424, '4223423', 'img/products/5.png', 32434, '2344-324324', 16, '1'),
(18, '8766', 454576, '5443534', 'img/products/5.png', 545636, '342-46346', 16, '1'),
(19, '4363543', 87, '4354534', 'img/products/5.png', 35345, '435435-45345', 16, '1'),
(20, '43645u8767', 324246, '43535', 'img/products/logotip.jpg', 435345, '3545-5435345', 16, '1'),
(21, '9999999999999', 213, 'fdsfsdsdf', 'img/products/5.png', 31223, '312-123123;32432423-32432432;3432423-3423423;9999999-999999', 16, '1'),
(22, '34232434', 324234, '324234324', 'img/products/5.png', 34234, '3424-342234;234234-34234', 21, '1');

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `deal`
--
ALTER TABLE `deal`
  MODIFY `deal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
