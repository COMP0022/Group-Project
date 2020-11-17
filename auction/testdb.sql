-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2020 at 05:49 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

DROP TABLE IF EXISTS `bids`;
CREATE TABLE IF NOT EXISTS `bids` (
  `bid_id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_id` int(11) DEFAULT NULL,
  `listing_id` int(11) DEFAULT NULL,
  `bidtime` datetime DEFAULT NULL,
  `bidprice` decimal(10,2) DEFAULT NULL,
  `outcome` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`bid_id`),
  KEY `listing_id` (`listing_id`),
  KEY `buyer_id` (`buyer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`bid_id`, `buyer_id`, `listing_id`, `bidtime`, `bidprice`, `outcome`) VALUES
(1, 2, 5, '2020-11-09 13:57:19', '300.00', NULL),
(2, 1, 12, '2020-11-09 13:57:19', '45.00', NULL),
(3, 1, 14, '2020-11-09 13:57:19', '250.00', NULL),
(4, 2, 12, '2020-11-09 13:57:19', '45.00', NULL),
(5, 2, 7, '2020-11-09 13:57:19', '14.00', NULL),
(6, 1, 6, '2020-11-09 13:57:19', '75.00', NULL),
(7, 3, 5, '2020-11-09 13:57:19', '300.00', NULL),
(8, 1, 11, '2020-11-09 13:57:19', '50.00', NULL),
(9, 1, 14, '2020-11-09 13:57:19', '250.00', NULL),
(10, 1, 5, '2020-11-09 13:57:19', '300.00', NULL),
(11, 3, 13, '2020-11-09 13:57:19', '30.00', NULL),
(12, 3, 8, '2020-11-09 13:57:19', '120.00', NULL),
(13, 2, 9, '2020-11-09 13:57:19', '12.00', NULL),
(14, 3, 11, '2020-11-09 13:57:19', '50.00', NULL),
(15, 1, 15, '2020-11-09 13:57:19', '55.00', NULL),
(16, 3, 7, '2020-11-09 13:57:19', '14.00', NULL),
(17, 1, 7, '2020-11-09 13:57:19', '14.00', NULL),
(18, 1, 16, '2020-11-09 13:57:19', '875.00', NULL),
(19, 1, 10, '2020-11-09 13:57:19', '17.00', NULL),
(20, 2, 5, '2020-11-09 13:57:19', '300.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

DROP TABLE IF EXISTS `buyers`;
CREATE TABLE IF NOT EXISTS `buyers` (
  `user_id` int(11) DEFAULT NULL,
  `buyer_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`buyer_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`user_id`, `buyer_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(6, 4),
(6, 5),
(7, 6),
(9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `catID` varchar(10) NOT NULL,
  `name` tinytext,
  PRIMARY KEY (`catID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catID`, `name`) VALUES
('CAT001', 'Home & Garden'),
('CAT002', 'Clothes, Footwear & Accessories'),
('CAT003', 'Baby & Kids Stuff'),
('CAT004', 'Sports, Leisure & Travel'),
('CAT005', 'Office Furniture & Equipment'),
('CAT006', 'Other Goods'),
('CAT007', 'Cameras, Camcorders & Studio Equipment'),
('CAT008', 'Appliances'),
('CAT009', 'Phones, Mobile Phones & Telecoms'),
('CAT010', 'Computers & Software'),
('CAT011', 'Music, Films, Books & Games'),
('CAT012', 'Health & Beauty'),
('CAT013', 'Musical Instruments & DJ Equipment'),
('CAT014', 'DIY Tools & Materials'),
('CAT015', 'Audio & Stereo'),
('CAT016', 'TV, DVD, Blu-Ray & Videos'),
('CAT017', 'Video Games & Consoles'),
('CAT018', 'Christmas Decorations'),
('CAT019', 'Tickets');

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

DROP TABLE IF EXISTS `listings`;
CREATE TABLE IF NOT EXISTS `listings` (
  `listing_id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) DEFAULT NULL,
  `posttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `itemdescription` text,
  `item_title` text,
  `category` text,
  `reserveprice` decimal(10,2) DEFAULT NULL,
  `startprice` decimal(10,2) DEFAULT NULL,
  `finished` bit(1) DEFAULT NULL,
  PRIMARY KEY (`listing_id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`listing_id`, `seller_id`, `posttime`, `endtime`, `itemdescription`, `item_title`, `category`, `reserveprice`, `startprice`, `finished`) VALUES
(1, 1, '2020-11-09 13:57:19', '2020-11-12 13:57:19', 'Lorem Ipsum Lorem Ipsum', 'Brand new car', 'Car', '15000.00', '10000.00', b'1'),
(2, 1, '2020-11-09 13:57:19', '2020-11-12 13:57:19', 'Lorem Ipsum Lorem Ipsum', 'Vintage ECC83 Pre Amp /Summing Mixer', 'Music', '1000.00', '750.00', b'1'),
(3, 2, '2020-11-09 13:57:19', '2020-11-13 13:57:19', 'Lorem Ipsum Lorem Ipsum', 'Natuzzi \"Love Seat\"', 'Furniture', '350.00', '300.00', b'1'),
(4, 2, '2020-11-09 13:57:19', '2020-11-12 13:57:19', 'Lorem Ipsum Lorem Ipsum', 'British Eagle Hybrid Bicycle - Medium', 'Bicycle', '100.00', '75.00', b'1'),
(5, 2, '2020-11-09 13:57:19', '2020-11-12 13:57:19', 'Lorem Ipsum Lorem Ipsum', 'IKEA mahogany slim bookshelf, wooden, 178 x 52 x 40 cm', 'Bookshelf', '20.00', '14.00', b'1'),
(6, 3, '2020-11-09 13:57:19', '2020-11-15 13:57:19', 'Lorem Ipsum Lorem Ipsum', 'Huawei watch 2 sports black excellent condition rarely worn with box and all accessories', 'Clothes', '150.00', '120.00', b'1'),
(7, 3, '2020-11-09 13:57:19', '2020-11-12 13:57:19', 'Lorem Ipsum Lorem Ipsum', 'Apple EarPods with 3.5mm Headphone Plug', 'Technology', '15.00', '10.00', b'1'),
(8, 3, '2020-11-09 13:57:19', '2020-11-12 13:57:19', 'Lorem Ipsum Lorem Ipsum', 'Solid Wood side tables x 2', 'Furniture', '20.00', '15.00', b'1'),
(9, 4, '2020-11-09 13:57:19', '2020-11-12 13:57:19', 'Lorem Ipsum Lorem Ipsum', 'ASKVOLL Wardrobe, white stained oak effect, white - white stained oak effect/white', 'Furniture', '60.00', '50.00', b'1'),
(10, 5, '2020-11-09 13:57:19', '2020-11-12 13:57:19', 'Lorem Ipsum Lorem Ipsum', 'Large TV Media Storage Unit.TV Stand. Fits Up To 55 inch TV. (Light Oak)', 'Technology', '50.00', '45.00', b'1'),
(11, 4, '2020-11-09 13:57:19', '2020-11-12 13:57:19', 'Lorem Ipsum Lorem Ipsum', 'Coffee Table', 'Furniture', '45.00', '30.00', b'1'),
(12, 5, '2020-11-09 13:57:19', '2020-11-16 13:57:19', 'Lorem Ipsum Lorem Ipsum', '* BOARDMAN HYB 8.6 * HYBRID / ROAD BIKE / BICYCLE', 'Bicycle', '295.00', '250.00', b'1'),
(13, 4, '2020-11-09 13:57:19', '2020-11-12 13:57:19', 'Lorem Ipsum Lorem Ipsum', 'Single metal white loft bed', 'Furniture', '60.00', '50.00', b'1'),
(14, 5, '2020-11-09 13:57:19', '2020-11-12 13:57:19', 'Lorem Ipsum Lorem Ipsum', 'Apple iMac Slim 27 inch i5 Quad Core 2.9Ghz 24gb Ram 1TB HDD Cinema 4D Vectorworks Adobe Dimension', 'Technology', '900.00', '850.00', b'1'),
(15, 10, '2020-11-17 15:46:00', '2020-11-18 10:10:00', 'testtest', 'test', 'Art', '110.00', '100.00', NULL),
(16, 10, '2020-11-17 15:49:00', '2020-11-18 10:10:00', 'bike test', 'Bike', 'Art', '100.00', '100.00', NULL),
(17, 10, '2020-11-17 16:24:00', '2020-11-18 01:00:00', 'asdf', 'Bike', 'Travel', '150.00', '100.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
CREATE TABLE IF NOT EXISTS `sellers` (
  `user_id` int(11) DEFAULT NULL,
  `seller_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`seller_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`user_id`, `seller_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(8, 7),
(9, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text,
  `password` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'test1@test.com', 'abc'),
(2, 'test2@test.com', 'abc'),
(3, 'test3@test.com', 'abc'),
(4, 'test4@test.com', 'abc'),
(5, 'test5@test.com', 'abc'),
(6, 'fred@turkjohnson.com', 'test'),
(7, 'andrewjacob@alexfred.com', 'test'),
(8, 'testseller@dotcom.com', 'test'),
(9, 'buyer@buy.com', 'test'),
(10, 'seller@sell.com', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

DROP TABLE IF EXISTS `watchlist`;
CREATE TABLE IF NOT EXISTS `watchlist` (
  `user_id` int(11) DEFAULT NULL,
  `listing_id` int(11) DEFAULT NULL,
  KEY `user_id` (`user_id`),
  KEY `listing_id` (`listing_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
