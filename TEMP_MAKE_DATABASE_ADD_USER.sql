-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2022 at 05:17 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportinggoodsemporiumdatabase`
--
CREATE DATABASE IF NOT EXISTS `sportinggoodsemporiumdatabase` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sportinggoodsemporiumdatabase`;

-- --------------------------------------------------------
GRANT SELECT, INSERT, DELETE, UPDATE ON sportinggoodsemporiumdatabase.* TO sportinggoodsemporium@localhost IDENTIFIED BY 'sportinggoodsemporiumpass';
--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(8) NOT NULL,
  `accountNumber` char(8) NOT NULL,
  `productID` char(6) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dateAdded` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `accountNumber`, `productID`, `quantity`, `dateAdded`) VALUES
('117000', '16908224', '660519', 1, '2022-11-26 23:16:45');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `accountNumber` char(8) NOT NULL,
  `email` varchar(128) NOT NULL,
  `Fname` varchar(128) DEFAULT NULL,
  `Lname` varchar(128) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phoneNumber` varchar(128) DEFAULT NULL,
  `dateOpened` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`accountNumber`, `email`, `Fname`, `Lname`, `password`, `address`, `phoneNumber`, `dateOpened`) VALUES
('16908224', 'test@test.com', 'test', 'test', '$2y$10$h3SDCgB5Gs9h8eREDm4Ca.y9iY9JZOaDR3q0kxE.uARE1VtSSEvPy', '123 test Road Test NJ 12345', '999-999-9999', '2022-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` char(8) NOT NULL,
  `email` varchar(128) NOT NULL,
  `Fname` varchar(128) DEFAULT NULL,
  `Lname` varchar(128) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(128) DEFAULT NULL,
  `phoneNumber` varchar(128) DEFAULT NULL,
  `salary` double NOT NULL,
  `startDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `email`, `Fname`, `Lname`, `password`, `address`, `phoneNumber`, `salary`, `startDate`) VALUES
('12345678', 'admin@SGE.com', 'FirstName', 'LastName', '$2y$10$h3SDCgB5Gs9h8eREDm4Ca.y9iY9JZOaDR3q0kxE.uARE1VtSSEvPy', '123 admin road', '123-456-7890', 500000, '2022-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` char(6) NOT NULL,
  `accountNumber` char(8) NOT NULL,
  `orderNumber` char(6) NOT NULL,
  `productID` char(6) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchaseDate` datetime NOT NULL,
  `shippingAddress` varchar(128) DEFAULT NULL,
  `billingAddress` varchar(128) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `accountNumber`, `orderNumber`, `productID`, `price`, `quantity`, `purchaseDate`, `shippingAddress`, `billingAddress`) VALUES
('452046', '16908224', '530622', '427016', 70, 1, '2022-11-26 23:15:18', '1234 Main St yellow IL 09876', '123 Main st Test AR 09876'),
('271604', '16908224', '530622', '506675', 21.99, 1, '2022-11-26 23:15:18', '1234 Main St yellow IL 09876', '123 Main st Test AR 09876'),
('287266', '16908224', '530622', '413532', 16.99, 1, '2022-11-26 23:15:18', '1234 Main St yellow IL 09876', '123 Main st Test AR 09876'),
('177914', '16908224', '530622', '804492', 13.99, 1, '2022-11-26 23:15:18', '1234 Main St yellow IL 09876', '123 Main st Test AR 09876'),
('299564', '16908224', '553746', '506675', 21.99, 5, '2022-11-26 23:16:33', '1 main st purple WV 76543', '1 main street orange KY 09876'),
('335549', '16908224', '553746', '660519', 69.99, 1, '2022-11-26 23:16:33', '1 main st purple WV 76543', '1 main street orange KY 09876');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` char(6) NOT NULL,
  `name` varchar(256) NOT NULL,
  `category` varchar(256) NOT NULL,
  `price` double NOT NULL,
  `manufacturer` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(512) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `name`, `category`, `price`, `manufacturer`, `description`, `quantity`, `image`) VALUES
('804492', 'Under Armour Men\'s t shirt', 'Tops', 13.99, 'Under Armour', 'loose fit t-shirt, classic crew neckline, multi-colors', 57, 'assets/18UARMSPRTSTYLLFTAPT_Aurora_Purple_Black.png'),
('413532', 'Under Armour Men\'s long sleeve shirt', 'Tops', 16.99, 'Under Armour', 'Loose fit long sleeve shirt, stretch material, multi-colors', 51, 'assets/18UARMTCHLSXXXXXXAPT_Cerulean_White.jpg'),
('506675', 'Under Armour Men\'s Compression Long Sleeve', 'Tops', 21.99, 'Under Armour', 'Compression long sleeve shirt, stretch material, multi-colors, rashguard', 43, 'assets/20UARMHGRMRCMPLSXAPT_Dark_Orange_Black.png'),
('747835', 'Under Armour Men\'s Compression T-shirt', 'Tops', 15.99, 'Under Armour', 'Compression t-shirt, stretch material, multi-colors, rashguard', 64, 'assets/20UARMHGRMRCMPSSXAPT_Black_White.jpg'),
('660519', 'Everlast PowerLock 2 Boxing Gloves', 'Exercise Equipment', 69.99, 'Everlast', 'Ergonomic grip bar, foam interior lining, durable', 33, 'assets/21ELSUPWRLCK2GLVBBXN_Red.png'),
('427016', 'Elevation Training Mask 3.0 with Carrying Case & Spray', 'Exercise Equipment', 70, 'Elevation', 'Quality air flow platform, carrying case, spray included, durable, mult-sport purpose', 57, 'assets/20JRIUDSG30LLBLKSEAC.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productID` (`productID`),
  ADD KEY `accountNumber` (`accountNumber`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`accountNumber`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`),
  ADD UNIQUE KEY `email` (`email`,`phoneNumber`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accountNumber` (`accountNumber`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
