-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2022 at 04:35 AM
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
  `phoneNumber` varchar(128) DEFAULT NULL,
  `salary` double NOT NULL,
  `startDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `email`, `Fname`, `Lname`, `password`, `phoneNumber`, `salary`, `startDate`) VALUES
('12345678', 'admin@SGE.com', 'FirstName', 'LastName', '$2y$10$h3SDCgB5Gs9h8eREDm4Ca.y9iY9JZOaDR3q0kxE.uARE1VtSSEvPy', '123-456-7890', 500000, '2022-11-21'),
('14588358', 'admin2@sge.com', 'Admin2', 'SGE', '$2y$10$MCQgF9ZWnvxbrORJ..AySOAVCdM6V8exNi9AOV.7FVGcuMyGFbdLu', '999-999-9999', 72047, '2022-12-05');

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
('452046', '16908224', '530622', '427016', 70, 1, '2022-11-26 23:15:18', '123 main street Montclair NJ 07028', '123 main street Montclair NJ 07028'),
('271604', '16908224', '530622', '506675', 21.99, 1, '2022-11-26 23:15:18', '123 main street Montclair NJ 07028', '123 main street Montclair NJ 07028'),
('287266', '16908224', '530622', '413532', 16.99, 1, '2022-11-26 23:15:18', '123 main street Montclair NJ 07028', '123 main street Montclair NJ 07028'),
('177914', '16908224', '530622', '804492', 13.99, 1, '2022-11-26 23:15:18', '123 main street Montclair NJ 07028', '123 main street Montclair NJ 07028'),
('299564', '16908224', '553746', '506675', 21.99, 5, '2022-11-26 23:16:33', '123 main street Montclair NJ 07028', '123 main street Montclair NJ 07028'),
('335549', '16908224', '553746', '660519', 69.99, 1, '2022-11-26 23:16:33', '123 main street Montclair NJ 07028', '123 main street Montclair NJ 07028'),
('348449', '16908224', '834958', '413532', 16.99, 48, '2022-11-27 01:33:34', '123 main street Montclair NJ 07028', '123 main street Montclair NJ 07028'),
('277209', '16908224', '834958', '660519', 69.99, 1, '2022-11-27 01:33:34', '123 main street Montclair NJ 07028', '123 main street Montclair NJ 07028'),
('451543', '16908224', '669794', '804492', 13.99, 1, '2022-11-28 13:18:47', '123 main street Montclair NJ 07028', '123 main street Montclair NJ 07028'),
('108934', '16908224', '647348', '594706', 600, 1, '2022-12-05 21:59:33', '1234 main street Montclair NJ 12345', '123 main street Montclair NJ 12345'),
('235162', '16908224', '647348', '730870', 209.99, 1, '2022-12-05 21:59:33', '1234 main street Montclair NJ 12345', '123 main street Montclair NJ 12345'),
('253266', '16908224', '647348', '195120', 12, 6, '2022-12-05 21:59:33', '1234 main street Montclair NJ 12345', '123 main street Montclair NJ 12345'),
('227430', '16908224', '647348', '694819', 26.99, 1, '2022-12-05 21:59:33', '1234 main street Montclair NJ 12345', '123 main street Montclair NJ 12345'),
('294376', '16908224', '647348', '660519', 69.99, 1, '2022-12-05 21:59:33', '1234 main street Montclair NJ 12345', '123 main street Montclair NJ 12345'),
('114354', '16908224', '647348', '427016', 70, 3, '2022-12-05 21:59:33', '1234 main street Montclair NJ 12345', '123 main street Montclair NJ 12345');

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
('427016', 'Elevation Training Mask 3.0 with Carrying Case & Spray', 'Exercise Equipment', 70, 'Elevation', 'Quality air flow platform, carrying case, spray included, durable, mult-sport purpose', 54, 'assets/20JRIUDSG30LLBLKSEAC.png'),
('804492', 'Under Armour Men\'s t shirt', 'Tops', 13.99, 'Under Armour', 'loose fit t-shirt, classic crew neckline, multi-colors', 56, 'assets/18UARMSPRTSTYLLFTAPT_Aurora_Purple_Black.png'),
('413532', 'Under Armour Men\'s long sleeve shirt', 'Tops', 16.99, 'Under Armour', 'Loose fit long sleeve shirt, stretch material, multi-colors', 51, 'assets/18UARMTCHLSXXXXXXAPT_Cerulean_White.jpg'),
('506675', 'Under Armour Men\'s Compression Long Sleeve', 'Tops', 21.99, 'Under Armour', 'Compression long sleeve shirt, stretch material, multi-colors, rashguard', 43, 'assets/20UARMHGRMRCMPLSXAPT_Dark_Orange_Black.png'),
('747835', 'Under Armour Men\'s Compression T-shirt', 'Tops', 15.99, 'Under Armour', 'Compression t-shirt, stretch material, multi-colors, rashguard', 64, 'assets/20UARMHGRMRCMPSSXAPT_Black_White.jpg'),
('660519', 'Everlast PowerLock 2 Boxing Gloves', 'Exercise Equipment', 69.99, 'Everlast', 'Ergonomic grip bar, foam interior lining, durable', 32, 'assets/21ELSUPWRLCK2GLVBBXN_Red.png'),
('367389', 'ETHOS Wall Ball', 'Exercise Equipment', 105.99, 'ETHOS', 'Quality Construction, Maximizes Workout', 67, 'assets/17AU6UTHSWLLBLL10EAC.jpg'),
('594706', 'Sunny Health & Fitness Premium Cardio Climber', 'Exercise Equipment', 600, 'Sunny Health & Fitness', '8 levels of resistance, Easy transport and storage, Monitor performance', 87, 'assets/21SVZUPRMMCRDCLMBMSC.jpg'),
('122807', 'Peloton Bike', 'Exercise Equipment', 1445.99, 'Peloton', 'Immersive 22” HD Touchscreen, 4’x2’ Compact Footprint, 10+ disciplines across cycling, strength & more', 152, 'assets/22FGEUBKXXXXXXXXXBKS.jpg'),
('464462', 'NordicTrack EXP 14i Smart Treadmill', 'Exercise Equipment', 3199.99, 'NordicTrack', 'Immersive, Built-in Monitor, Active Pulse, Speed Controls, Incline Controls', 313, 'assets/21NTKUNTXP14TRDMLTRD.jpg'),
('478696', 'Peloton Tread', 'Exercise Equipment', 3495, 'Peloton', 'Track progress, Live/On Demand Classes, Value Packed Membership', 305, 'assets/22FGEUTRDVDCXXXXXTRD.jpg'),
('521510', 'Northeast Outfitters Men\'s Cozy Cabin Moose Socks', 'Socks', 14.99, 'North easy Outfitters', 'Regular fit, retains heat, dry-tested design', 79, 'assets/22ZLXMCZYMNSMSXXXSNL_Golden_Brown.jpg'),
('339020', 'Nike Dri-FIT Everyday Plus Cushion Training No-Show Socks - 6 Pack', 'Socks', 22, 'Nike', 'Handles moisture well, no show, fitted,', 100, 'assets/18NIKA6PKDFNSXXXXAPA_White.jpg'),
('195120', 'Vans Sycamore Tie Dyed Crew Socks', 'Socks', 12, 'Vans', 'Stretchy, art covers entire sock, logo embroidery', 51, 'assets/21VANMMSYCMRTDYCRSOX_SYCAMORE_TIE_DYE.jpg'),
('567013', 'Under Armour Men\'s Project Rock Beanie', 'Hats', 40, 'Under Armour', 'Dries quickly, durable, stretchy, woven patch logo', 46, 'assets/22UARMPRJCTRCKBN9CLD_Summit_White_Deco_Rose.jpg'),
('735113', 'Columbia Polar Powder II Beanie', 'Hats', 35, 'Columbia', 'Stretchy, ski and trail sports, fleece lined', 21, 'assets/20CMBMPLRPWDRBNXXAOA_Dark_Nocturnal_Lapis_Blue.jpg'),
('166441', 'Nike Sportswear Utility Futura Beanie', 'Hats', 30, 'Nike', 'Stretchy, embroidered logo', 36, 'assets/21NIKMNSWBNTLTYFTCLD_Elemental_Gold.jpg'),
('365762', 'Nike Men\'s Free Run 5.0 Running Shoes', 'Shoes', 99.99, 'Nike', 'Flexible, breathable, heel pull tab', 50, 'assets/22NIKMFRRN50NXTNTRNN_Blue_Grey_Blue.jpg'),
('537233', 'New Balance Men\'s Old Bay 200 Slides', 'Shoes', 39.99, 'New Balance', 'Soft toe bed foam, slip on, foot contour mimicking', 44, 'assets/22NWBMLDBY200SLDXOPE_White.jpg'),
('847338', 'The North Face Men\'s Back to Berkeley III Boots', 'Shoes', 159.99, 'The North Face', 'vintage design, compression molded, recycled rubber for traction', 89, 'assets/21TNOMB2BSPRTWPRRFBO_Flax_Grey.jpg'),
('730870', 'Timberland Men\'s 6\" Premium 400g Waterproof Boots', 'Shoes', 209.99, 'Timberland', 'Waterproof, durable, comfortable', 107, 'assets/16TLDMCN6PRMMWHT4FBO_Wheat-1.jpg'),
('934324', 'Nike Men\'s Air Force 1 \'07 Shoes', 'Shoes', 109.99, 'Nike', 'Unisex, easy to clean', 15, 'assets/16NIKMRFRC1GRYWHTLFS_Cool_Grey_Sail.jpg'),
('270053', 'Air Jordan 1 Mid Shoes', 'Shoes', 130.99, 'Nike', 'Unisex, easy to clean', 19, 'assets/22JDNARJRDN1MDBLKMNSB_Black_Red_White.jpg'),
('705272', 'Nike Men\'s Challenger Brief-lined 5\" Running Shorts', 'Bottoms', 30.99, 'Nike', 'Standard fit running shorts, elastic waistband adjustable drawcord, inner layer, mesh at lower side panels', 64, 'assets/20NIKMMCHLLNGRBF5APB_Mystic_Dates.jpg'),
('432469', 'DSG Men\'s 8\" Agility Woven Shorts', 'Bottoms', 20.99, 'DSG', 'Standard fit ,Adjustable, drawstring waist, 8\" inseam', 70, 'assets/20QYFMCRWVNSHRTXXDSG_Arctic_Pure_White.jpg'),
('868538', 'DSG Men\'s 6\" Rec Shorts', 'Bottoms', 18.99, 'DSG', 'Loose fit, elastic waist, 6\" inseam', 51, 'assets/21QYFM6LFSTYLWVNSDSG_Americana_Arrows_Tr_Scarl-1.jpg'),
('506667', 'Under Armour Men\'s 7\" inseam shorts', 'Bottoms', 18.99, 'Under Armour', 'Fitted, 7\" inseam', 42, 'assets/20UARMLNCHSW7SHRTAPB_Pitch_Gray_Full_Heather.jpg'),
('694819', 'The North Face Men\'s quarter zip pullover', 'Tops', 26.99, 'The North Face', 'Quarter zip, Fitted, Raglan sleeves, Shaped Hem, Thumb Holes', 59, 'assets/20TNOMWNDR14ZPXXXAPT_Porcelain_Green.jpg'),
('887057', 'Under Armour cut off tank top', 'Tops', 11.99, 'Under Armour', 'Breathable fabric, stretch material, multi-colors, anti tear', 34, 'assets/20UARMLFTCHSTCTFFAPT_Lime_Foam_Black.jpg');

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
