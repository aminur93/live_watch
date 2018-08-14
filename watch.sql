-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2018 at 08:57 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `watch`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(1, 'Rolex'),
(12, 'Addidas'),
(13, 'Titans'),
(14, 'Audemars Piguet'),
(15, 'Patek Philippe'),
(16, 'Blancpain'),
(17, 'Chopard'),
(18, 'IWC Schaffhausen'),
(20, 'Jaeger-LeCoultre'),
(21, 'Panerai'),
(22, 'Piaget SA'),
(23, 'Cartier');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `hand_size` decimal(10,2) NOT NULL,
  `expire_date` datetime NOT NULL,
  `paid` tinyint(4) DEFAULT '0',
  `shipped` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `items`, `hand_size`, `expire_date`, `paid`, `shipped`) VALUES
(5, '[{"id":"2","size":"medium","available":"12","quantity":"1"},{"id":"1","size":"small","available":"3","quantity":2}]', '2.20', '2018-05-22 14:30:28', 0, 0),
(6, '[{"id":"3","size":"small","available":"2","quantity":1},', '4.20', '2018-04-02 15:44:31', 0, 0),
(7, '[{"id":"1","size":"small","available":"3","quantity":2}]', '4.50', '2018-05-02 09:56:45', 0, 0),
(8, '[{"id":"1","size":"medium","available":"5","quantity":"1"},{"id":"1","size":"small","available":"3","quantity":"1"}]', '2.20', '2018-05-08 20:42:12', 0, 0),
(11, '[{"id":"2","size":"medium","available":"12","quantity":"1"},{"id":"1","size":"large","available":"10","quantity":"1"}]', '4.30', '2018-05-20 19:50:46', 0, 0),
(12, '[{"id":"1","size":"small","available":"3","quantity":"1"}]', '4.40', '2018-05-21 21:43:10', 0, 0),
(13, '[{"id":"2","size":"large","available":"14","quantity":"1"}]', '2.50', '2018-05-22 14:32:15', 0, 0),
(14, '[{"id":"14","size":"small","available":"3","quantity":"1"},{"id":"1","size":"medium","available":"5","quantity":1}]', '3.70', '2018-05-26 22:01:52', 1, 1),
(15, '[{"id":"12","size":"large","available":"5","quantity":"1"}]', '2.20', '2018-05-23 12:28:08', 1, 0),
(16, '[{"id":"2","size":"medium","available":"12","quantity":"1"}]', '4.20', '2018-05-23 12:44:45', 1, 0),
(17, '[{"id":"5","size":"small","available":"10","quantity":"1"}]', '2.20', '2018-05-23 12:50:24', 1, 1),
(18, '[{"id":"10","size":"medium","available":"3","quantity":"1"}]', '4.30', '2018-05-23 12:54:51', 1, 1),
(19, '[{"id":"5","size":"large","available":"6","quantity":6}]', '3.70', '2018-05-23 19:29:51', 1, 1),
(20, '[{"id":"2","size":"medium","available":"12","quantity":8}]', '4.20', '2018-05-23 19:31:48', 1, 1),
(21, '[{"id":"7","size":"small","available":"10","quantity":"1"}]', '2.20', '2018-05-23 21:46:07', 1, 1),
(22, '[{"id":"14","size":"medium","available":"3","quantity":"1"}]', '3.20', '2018-05-30 15:28:14', 1, 1),
(23, '[{"id":"9","size":"small","available":"4","quantity":"1"}]', '2.10', '2018-05-30 23:12:56', 1, 1),
(24, '[{"id":"1","size":"small","available":"3","quantity":"1"}]', '4.50', '2018-06-03 19:37:15', 1, 1),
(25, '[{"id":"12","size":"large","available":"5","quantity":"1"}]', '4.50', '2018-06-03 20:28:41', 1, 1),
(26, '[{"id":"7","size":"medium","available":"6","quantity":"1"}]', '3.20', '2018-06-03 21:16:16', 1, 1),
(27, '[{"id":"22","size":"samll","available":"3","quantity":"1"}]', '3.20', '2018-06-03 22:27:55', 1, 1),
(28, '[{"id":"2","size":"small","available":"10","quantity":"1"}]', '2.30', '2018-06-03 22:34:45', 1, 1),
(29, '[{"id":"1","size":"medium","available":"4","quantity":"1"}]', '4.30', '2018-06-05 10:17:01', 0, 0),
(30, '[{"id":"2","size":"medium","available":"4","quantity":"1"}]', '3.20', '2018-06-19 21:44:23', 1, 1),
(31, '[{"id":"11","size":"small","available":"2","quantity":"2"}]', '4.50', '2018-06-19 22:23:31', 1, 0),
(32, '[{"id":"1","size":"medium","available":"4","quantity":"3"}]', '2.20', '2018-06-22 11:47:49', 0, 0),
(33, '[{"id":"22","size":"samll","available":"2","quantity":"1"}]', '3.20', '2018-06-25 12:16:36', 0, 0),
(34, '[{"id":"2","size":"medium","available":"3","quantity":"1"}]', '2.20', '2018-06-28 10:52:26', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(1, 'Men', 0),
(2, 'Women', 0),
(3, 'Boys', 0),
(4, 'Girls', 0),
(5, 'Automatic Watches', 1),
(6, 'Ascender', 1),
(7, 'Fashion Watches', 1),
(8, 'Military Watches', 1),
(9, ' Cluse La Roche', 2),
(10, 'Olivia Burton', 2),
(11, ' Fossil Jacqueline', 2),
(12, 'Larsson & Jennings', 2),
(13, 'TITANIUM SLAP', 3),
(14, 'FLIK FLAK', 3),
(15, 'Prada', 4),
(16, 'Fosill', 4);

-- --------------------------------------------------------

--
-- Table structure for table `customer_user`
--

CREATE TABLE `customer_user` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer_user`
--

INSERT INTO `customer_user` (`id`, `fname`, `lname`, `email`, `password`, `image`, `phone_number`, `address`, `join_date`, `last_login`) VALUES
(8, 'rashid', 'khan', 'rashidkhan420123@gmail.com', '$2y$10$5eTLF/xeAGTencIFZSxcm.4IDUH01.o9JJxp05PYJVaZQQo05mwl2', '11264890_1023116487713398_6656691130857471308_n.jpg', 1772119941, 'framgate\r\nRaza Bazar\r\ndhaka-1210\r\nbangladesh', '2018-05-05 02:27:10', '2018-05-29 19:16:18'),
(9, 'sumon', 'islam', 'abc@gmail.com', '$2y$10$B6Z/e3F.MSQ4bUC3Zz5WP.PYf44k/VSqUvgGyfrGOTK3VSZnP2ray', '406462_340202752671445_1773567015_n.jpg', 1772119941, 'fra,gate\r\nraza bazar\r\ndhaka-1210\r\nbangladesh', '2018-05-05 02:30:31', '2018-05-29 10:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `handsize`
--

CREATE TABLE `handsize` (
  `id` int(11) NOT NULL,
  `hand_size` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `handsize`
--

INSERT INTO `handsize` (`id`, `hand_size`) VALUES
(1, '3.20'),
(2, '4.10'),
(3, '2.20'),
(4, '2.50'),
(5, '4.50'),
(6, '4.30'),
(9, '3.60'),
(10, '3.70'),
(11, '2.10'),
(12, '2.30');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8_unicode_ci NOT NULL,
  `product_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`, `product_keyword`, `deleted`) VALUES
(1, 'Rolex Silver', '23.40', '55.34', 1, '5', '/final_project/images/watch/watch1.png', 'Rolex is a nice brand watch. its wear good\r\n', 1, 'small:2:3,medium:4:4,large:10:10', 'rolex silver watch', 0),
(2, 'Fortis Gray', '45.50', '140.30', 13, '6', '/final_project/images/watch/d5ab0a2cbea72d69068d971836ccebcd.png', 'this is watch is so beautifull. fully for men. its wear very nice to see any man.', 1, 'small:9:10,medium:3:4,large:14:4', 'fortis watch ', 0),
(5, 'Addias Sports', '112.30', '45.55', 12, '7', '/final_project/images/watch/d196d1f7221d37314a96fc4ad27f3129.png', 'nice watch', 1, 'small:10:3,Medium:3:3,large:7:3', 'addidas watch', 0),
(6, 'Piaget Sa Watch', '45.50', '78.90', 22, '10', '/final_project/images/watch/7bc1acb80e6402528a321dd9c2819401.png', 'this is nice piaget watch for men and women. its wearing to comfort.please buy now,', 1, 'small:4:2,Medium:6:2,Large:10:2', 'piaget watch', 0),
(7, 'Men Watch', '34.45', '78.56', 14, '14', '/final_project/images/watch/2a69af9fe780cf9a6b5290c9aed4bcd3.png', 'this is nice watch for men and boys. please buy now . stock is limited', 1, 'small:9:3,medium:5:3,large:8:3', 'men watch', 0),
(8, 'Women Panerai', '23.45', '45.66', 21, '9', '/final_project/images/watch/85ad1c182d9a8d446eb8c7929e994fad.png', 'this is women watch. its food look to wear, please buy now. stock is limited', 1, 'small:3:2,medium:5:2,large:8:3', 'women panerai watch', 0),
(9, 'Boys Watch', '45.66', '78.90', 17, '10', '/final_project/images/watch/707e4b8e8bba7993f40242d918ef1370.png', 'this is nice watch for boys , please buy now, stock is limited', 1, 'small:3:2,medium:6:2,large:8:2', 'boys watch for fashion', 0),
(10, 'Grils Watch', '13.45', '45.66', 23, '15', '/final_project/images/watch/a08cab8e53be0081c40394dc61a14b14.png', 'this is nice watch. please buy now , stock is limited', 1, 'small:3:2,medium:3:2,large:4:2', 'girls fashionble watch', 0),
(11, 'Girls Watch', '23.45', '45.66', 20, '16', '/final_project/images/watch/da8c2da1d9294c9e87319d5e97274aab.png', 'this is girls nice watch.', 1, 'small:0:1,medium:3:1,large:3:1', 'girls nice watch', 0),
(12, 'Nike Watch', '12.30', '45.55', 20, '5', '/final_project/images/watch/2bf189099e713124b004da6005c35559.png', 'this is nice watch and comfort', 1, 'small:3:2,medum:3:2,large:4:2', 'watch', 0),
(14, 'Titans', '12.30', '23.45', 23, '15', '/final_project/images/watch/3b15b53899f973942d908862c4afcce7.png', 'this is nice titans watch. stock is limites please buy now', 1, 'small:2:1,medium:2:1,large:5:1', 'watch', 0),
(22, 'Police Watch', '12.30', '50.55', 12, '16', '/final_project/images/watch/fc1cdae354c44b5e2be39dded53a50dc.png,/final_project/images/watch/e6379c7ee547db49df120d7ccb8dd575.png,/final_project/images/watch/3886797ee97fde2e9f27c0b537da0072.png,/final_project/images/watch/ea5b7b0c066de2348b9e7a5bb0fe3a38.png,/final_project/images/watch/0005ce67f7bedc75df3e65c72ec1a50e.png', 'this is nice watch', 1, 'samll:2:2', 'police watch', 0),
(25, 'Addias Sports', '12.30', '45.55', 18, '14', '/final_project/images/watch/8cbcfa9e316d2dddcab4e8676fa7985c.png,/final_project/images/watch/55fe149e09689a5b5a976e6d96673705.png,/final_project/images/watch/e71e921ab4f12dbaf7daf20e2233f077.png', 'this is nice watch', 1, 'small:2:2,medium:3:3,large:3:3', 'addidas watch', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `charge_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cart_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `txn_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `charge_id`, `cart_id`, `users_id`, `full_name`, `email`, `street`, `street2`, `city`, `zip_code`, `country`, `state`, `sub_total`, `tax`, `grand_total`, `description`, `txn_type`, `txn_date`) VALUES
(1, 'ch_1CK2GDJhdtcjszuZgHNM73df', 17, 0, 'aminur rashid', 'aminurrashid126@gmail.com', 'framagate', 'lahamrbari', 'dhaka', '1210', 'bangaldesh', 'mirpur', '112.30', '9.77', '122.07', '1 item From Watch Store', 'charge', '2018-04-23 16:51:03'),
(2, 'ch_1CK2KhJhdtcjszuZs6E7YtAh', 18, 0, 'riya islam', 'aminurrashid126@gmail.com', 'framagate', 'lahamrbari', 'dhaka', '1210', 'bangaldesh', 'mirpur', '13.45', '1.17', '14.62', '1 item From Watch Store', 'charge', '2018-04-23 16:55:41'),
(3, 'ch_1CK8V3JhdtcjszuZxNubPFYD', 19, 0, 'pavel', 'aminurrashid126@gmail.com', 'framagate', 'lahamrbari', 'dhaka', '1210', 'bangaldesh', 'mirpur', '673.80', '58.62', '732.42', '6 items From Watch Store', 'charge', '2018-04-23 23:30:50'),
(4, 'ch_1CK8WsJhdtcjszuZmSrC5laX', 20, 0, 'pavel', 'aminurrashid126@gmail.com', 'framagate', 'lahamrbari', 'dhaka', '1210', 'bangaldesh', 'mirpur', '364.00', '31.67', '395.67', '8 items From Watch Store', 'charge', '2018-04-23 23:32:43'),
(5, 'ch_1CKBDwJhdtcjszuZnCim9fIb', 21, 0, 'pavel', 'aminurrashid126@gmail.com', 'framagate', 'lahamrbari', 'dhaka', '1210', 'bangaldesh', 'mirpur', '34.45', '3.00', '37.45', '1 item From Watch Store', 'charge', '2018-04-24 02:25:22'),
(6, 'ch_1CLGK0JhdtcjszuZjhNQC4vT', 14, 0, 'mamun rashid', 'aminurrashid126@gmail.com', 'framgate', 'khamarbari', 'dhaka', '1216', 'bangladesh', 'monipuri para', '35.70', '3.11', '38.81', '2 items From Watch Store', 'charge', '2018-04-27 02:04:03'),
(7, 'ch_1CMc47JhdtcjszuZNN9F9gsx', 22, 6, 'degonto khan', 'aminurrashid126@gmail.com', 'framgate', 'khamarbari', 'dhaka', '1216', 'bangladesh', 'monipuri para', '12.30', '1.07', '13.37', '1 item From Watch Store', 'charge', '2018-04-30 19:29:10'),
(8, 'ch_1CMtVPJhdtcjszuZVh6QBPo6', 23, 0, 'Neson Jhonson', 'aminurrashid126@gmail.com', 'framgate', 'khamarbari', 'dhaka', '1216', 'bangladesh', 'monipuri para', '45.66', '3.97', '49.63', '1 item From Watch Store', 'charge', '2018-05-01 14:06:30'),
(9, 'ch_1CO7tLJhdtcjszuZyEFwlgRe', 24, 7, 'Neson Jhonson', 'khan@gmail.com', 'framgate', 'khamarbari', 'dhaka', '1216', 'bangladesh', 'monipuri para', '23.40', '2.04', '25.44', '1 item From Watch Store', 'charge', '2018-05-04 23:40:31'),
(10, 'ch_1CO8erJhdtcjszuZTSyUptG3', 25, 7, 'Farukh Ahmed', 'abc@gmail.com', 'framgate', 'khamarbari', 'dhaka', '1216', 'bangladesh', 'monipuri para', '12.30', '1.07', '13.37', '1 item From Watch Store', 'charge', '2018-05-05 00:29:38'),
(11, 'ch_1CO9OsJhdtcjszuZchGAEHFe', 26, 6, 'riya islam', 'raj@gmail.com', 'framgate', 'khamarbari', 'dhaka', '1216', 'bangladesh', 'monipuri para', '34.45', '3.00', '37.45', '1 item From Watch Store', 'charge', '2018-05-05 01:17:11'),
(12, 'ch_1COAWLJhdtcjszuZIO9VMw6L', 27, 8, 'jhony khan', 'khan@gmail.com', 'framgate', 'khamarbari', 'dhaka', '1216', 'bangladesh', 'monipuri para', '12.30', '1.07', '13.37', '1 item From Watch Store', 'charge', '2018-05-05 02:28:58'),
(13, 'ch_1COAcqJhdtcjszuZzAWUm22P', 28, 9, 'sumon ', 'abc@gmail.com', 'framgate', 'raza bazar', 'dhaka', '1216', 'bangladesh', 'monipuri para', '45.50', '3.96', '49.46', '1 item From Watch Store', 'charge', '2018-05-05 02:35:40'),
(14, 'ch_1CTxUFJhdtcjszuZYgzthMjZ', 30, 8, 'aminur rashid', 'aminurrashid126@gmail.com', '113/c 3/a/1', '', 'dhaka', '1216', 'Bangladesh', 'mirpur shewora para', '45.50', '3.96', '49.46', '1 item From Watch Store', 'charge', '2018-05-21 01:46:36'),
(15, 'ch_1CTy57JhdtcjszuZmtFHmsRB', 31, 8, 'aminur rashid', 'aminurrashid126@gmail.com', '113/c 3/a/1', '', 'dhaka', '1216', 'Bangladesh', 'mirpur shewora para', '46.90', '4.08', '50.98', '2 items From Watch Store', 'charge', '2018-05-21 02:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `trial`
--

CREATE TABLE `trial` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `image` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trial`
--

INSERT INTO `trial` (`id`, `users_id`, `image`) VALUES
(16, 8, 'images/saved_images/webcam20180529202759931.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permissions` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permissions`) VALUES
(2, 'aminur rashid', 'aminurrashid126@gmail.com', '$2y$10$zkROdUaj5QEZCbDdiyTDhOsGAelDRSpuIJXqdXadFutV0lc2WU0mG', '2018-02-25 02:18:52', '2018-05-20 21:43:42', 'admin,editor'),
(3, 'rashid khan', 'rashidkhan420123@gmail.com', '$2y$10$/XvZMwrcGaM5JiA2v9NccOp1JxCAi2zndGsmXjWOFl5VmQkf7jG/i', '2018-02-25 16:43:45', '2018-02-26 08:07:46', 'editor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_user`
--
ALTER TABLE `customer_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `handsize`
--
ALTER TABLE `handsize`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trial`
--
ALTER TABLE `trial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `customer_user`
--
ALTER TABLE `customer_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `handsize`
--
ALTER TABLE `handsize`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `trial`
--
ALTER TABLE `trial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
