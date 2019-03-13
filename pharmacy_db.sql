-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 13, 2019 at 04:08 PM
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
(22, 'Лекарственные препараты', '1', 'null', './img/cats/лекарственные_препараты.PNG'),
(23, 'БАД', '1', 'null', './img/cats/fsd.PNG'),
(24, 'Медицинские изделия', '1', 'null', './img/cats/medizd.PNG'),
(25, 'Медтехника', '1', 'null', './img/cats/tech.PNG'),
(26, 'Гигиена', '1', 'null', './img/cats/Gigiena.PNG'),
(27, 'АНТИБАКТЕРИАЛЬНЫЕ СРЕДСТВА', '1', '22', './img/subcats/Bakterial.PNG'),
(28, 'Иммунная система', '1', '22', './img/subcats/imun.PNG'),
(29, 'От аллергии', '1', '22', './img/subcats/Allerg.PNG'),
(30, 'БАДЫ - ВИТАМИНЫ', '1', '23', './img/subcats/BADvit.PNG'),
(31, 'БАДЫ ДЛЯ ГЛАЗ', '1', '23', './img/subcats/BADglaz.PNG'),
(32, 'БАДЫ ДЛЯ КОЖИ, ВОЛОС, НОГТЕЙ', '1', '23', './img/subcats/UQWWLpp55suNvuaj3Uarkw.png'),
(33, 'АППЛИКАТОРЫ, ИППЛИКАТОРЫ', '1', '24', './img/subcats/applikator-lyapko-malysh.jpg'),
(34, 'АПТЕЧКИ', '1', '24', './img/subcats/1014632741.jpg'),
(35, 'ПЕРЕВЯЗОЧНЫЕ МАТЕРИАЛЫ', '1', '24', './img/subcats/reha_haft.jpg'),
(36, 'ГЛЮКОМЕТРЫ, ЛАНЦЕТЫ, ТЕСТ-ПОЛОСКИ', '1', '25', './img/subcats/280_280_1.jpg'),
(37, 'ИНГАЛЯТОРЫ, НЕБУЛАЙЗЕРЫ', '1', '25', './img/subcats/download.jpg'),
(38, 'МАССАЖЕРЫ', '1', '25', './img/subcats/6Hj4UL48ftVPSomSygcgw.jpg'),
(40, 'СРЕДСТВА ОТ ПОТА', '1', '26', './img/subcats/algel-ot-pota-1.jpg'),
(41, 'УХОД ЗА ПОЛОСТЬЮ РТА', '1', '26', './img/subcats/article2324.jpg');

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
(23, 'Бетадин р-р местн и наруж 10% 30мл n1', 171, 'Антисептическое, дезинфицирующее.Для обработки кожи и слизистых оболочек применяют в неразбавленном виде для смазывания, промывания или в виде влажного компресса. Для применения в дренажных системах 10% раствор разбавляют от 10 до 100 раз. Раствор приготавливают непосредственно перед применением, разбавленные растворы не хранят.', 'img/products/photo_es_EF254B80-3A9B-4DAE-92B6-D0BA5EDEA905.jpg', 100, 'Показания-лечение и профилактика раневых инфекций в хирургии;Побочные действия-может произойти системная реабсорбция йода;Противопоказания-аденома щитовидной железы', 27, '1'),
(24, 'Цефтриаксон пор. д/пригот. р-ра в/в и в/м введ. 1г фл. №1', 33, 'АО \"Рафарма\", Российская Федерация, Показания: Бактериальные инфекции, вызванные чувствительными микроорганизмами: инфекции органов брюшной полости (перитонит, воспалительные заболевания ЖКТ, желчевыводящих путей, в т.ч. холангит, эмпиема желчного пузыря), инфекции органов малого таза, инфекции нижних дыхательных путей (в т.ч. пневмония, абсцесс легких, эмпиема плевры).', 'img/products/photo_es_56D49F5F-FC4B-0619-5E05-3E30A030ADCF.jpg', 100, 'Показания-Инфекционно-воспалительные заболевания, вызванные;Противопоказания-Повышенная чувствительность к цефтриаксону и други;Побочные действия-тошнота, рвота, диарея;-', 27, '1');

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
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
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
