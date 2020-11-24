-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 24, 2020 at 10:00 AM
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
(1, 2, 5, '2020-11-18 11:32:58', '300.00', NULL),
(2, 1, 12, '2020-11-18 11:32:58', '45.00', NULL),
(3, 1, 14, '2020-11-18 11:32:58', '250.00', NULL),
(4, 2, 12, '2020-11-18 11:32:58', '45.00', NULL),
(5, 2, 7, '2020-11-18 11:32:58', '14.00', NULL),
(6, 1, 6, '2020-11-18 11:32:58', '75.00', NULL),
(7, 3, 5, '2020-11-18 11:32:58', '300.00', NULL),
(8, 1, 11, '2020-11-18 11:32:58', '50.00', NULL),
(9, 1, 14, '2020-11-18 11:32:58', '250.00', NULL),
(10, 1, 5, '2020-11-18 11:32:58', '300.00', NULL),
(11, 3, 13, '2020-11-18 11:32:58', '30.00', NULL),
(12, 3, 8, '2020-11-18 11:32:58', '120.00', NULL),
(13, 2, 9, '2020-11-18 11:32:58', '12.00', NULL),
(14, 3, 11, '2020-11-18 11:32:58', '50.00', NULL),
(15, 1, 15, '2020-11-18 11:32:58', '55.00', NULL),
(16, 3, 7, '2020-11-18 11:32:58', '14.00', NULL),
(17, 1, 7, '2020-11-18 11:32:58', '14.00', NULL),
(18, 1, 16, '2020-11-18 11:32:58', '875.00', NULL),
(19, 1, 10, '2020-11-18 11:32:58', '17.00', NULL),
(20, 2, 5, '2020-11-18 11:32:58', '300.00', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`user_id`, `buyer_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

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
  `posttime` datetime NOT NULL,
  `endtime` datetime DEFAULT NULL,
  `itemdescription` text,
  `item_title` text,
  `finished` bit(1) DEFAULT NULL,
  `category` text,
  `reserveprice` decimal(10,2) DEFAULT NULL,
  `startprice` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`listing_id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`listing_id`, `seller_id`, `posttime`, `endtime`, `itemdescription`, `item_title`, `finished`, `category`, `reserveprice`, `startprice`) VALUES
(1, 1, '2020-11-18 11:32:58', '2020-11-21 11:32:58', 'Lorem Ipsum Lorem Ipsum', 'Brand new car', NULL, 'Car', '15000.00', '10000.00'),
(2, 1, '2020-11-18 11:32:58', '2020-11-21 11:32:58', 'Lorem Ipsum Lorem Ipsum', 'Vintage ECC83 Pre Amp /Summing Mixer', NULL, 'Music', '1000.00', '750.00'),
(3, 2, '2020-11-18 11:32:58', '2020-11-22 11:32:58', 'Lorem Ipsum Lorem Ipsum', 'Natuzzi \"Love Seat\"', NULL, 'Furniture', '350.00', '300.00'),
(4, 2, '2020-11-18 11:32:58', '2020-11-21 11:32:58', 'Lorem Ipsum Lorem Ipsum', 'British Eagle Hybrid Bicycle - Medium', NULL, 'Bicycle', '100.00', '75.00'),
(5, 2, '2020-11-18 11:32:58', '2020-11-21 11:32:58', 'Lorem Ipsum Lorem Ipsum', 'IKEA mahogany slim bookshelf, wooden, 178 x 52 x 40 cm', NULL, 'Bookshelf', '20.00', '14.00'),
(6, 3, '2020-11-18 11:32:58', '2020-11-24 11:32:58', 'Lorem Ipsum Lorem Ipsum', 'Huawei watch 2 sports black excellent condition rarely worn with box and all accessories', NULL, 'Clothes', '150.00', '120.00'),
(7, 3, '2020-11-18 11:32:58', '2020-11-21 11:32:58', 'Lorem Ipsum Lorem Ipsum', 'Apple EarPods with 3.5mm Headphone Plug', NULL, 'Technology', '15.00', '10.00'),
(8, 3, '2020-11-18 11:32:58', '2020-11-21 11:32:58', 'Lorem Ipsum Lorem Ipsum', 'Solid Wood side tables x 2', NULL, 'Furniture', '20.00', '15.00'),
(9, 4, '2020-11-18 11:32:58', '2020-11-21 11:32:58', 'Lorem Ipsum Lorem Ipsum', 'ASKVOLL Wardrobe, white stained oak effect, white - white stained oak effect/white', NULL, 'Furniture', '60.00', '50.00'),
(10, 5, '2020-11-18 11:32:58', '2020-11-21 11:32:58', 'Lorem Ipsum Lorem Ipsum', 'Large TV Media Storage Unit.TV Stand. Fits Up To 55 inch TV. (Light Oak)', NULL, 'Technology', '50.00', '45.00'),
(11, 4, '2020-11-18 11:32:58', '2020-11-21 11:32:58', 'Lorem Ipsum Lorem Ipsum', 'Coffee Table', NULL, 'Furniture', '45.00', '30.00'),
(12, 5, '2020-11-18 11:32:58', '2020-11-25 11:32:58', 'Lorem Ipsum Lorem Ipsum', '* BOARDMAN HYB 8.6 * HYBRID / ROAD BIKE / BICYCLE', NULL, 'Bicycle', '295.00', '250.00'),
(13, 4, '2020-11-18 11:32:58', '2020-11-21 11:32:58', 'Lorem Ipsum Lorem Ipsum', 'Single metal white loft bed', NULL, 'Furniture', '60.00', '50.00'),
(14, 5, '2020-11-18 11:32:58', '2020-11-21 11:32:58', 'Lorem Ipsum Lorem Ipsum', 'Apple iMac Slim 27 inch i5 Quad Core 2.9Ghz 24gb Ram 1TB HDD Cinema 4D Vectorworks Adobe Dimension', NULL, 'Technology', '900.00', '850.00');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`user_id`, `seller_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text,
  `password` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'test1@test.com', 'abc'),
(2, 'test2@test.com', 'abc'),
(3, 'test3@test.com', 'abc'),
(4, 'test4@test.com', 'abc'),
(5, 'test5@test.com', 'abc');

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
