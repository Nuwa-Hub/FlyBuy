-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2021 at 11:22 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flybuy`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` int(11) NOT NULL,
  `customer_obj` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `customer_obj`) VALUES
(1, 'O:8:\"customer\":3:{s:8:\"username\";s:15:\"nuwan@gmail.com\";s:8:\"password\";s:3:\"123\";s:5:\"email\";s:0:\"\";}'),
(2, 'O:8:\"customer\":3:{s:8:\"username\";s:15:\"nuwan@gmail.com\";s:8:\"password\";s:3:\"123\";s:5:\"email\";s:0:\"\";}'),
(3, 'O:8:\"customer\":3:{s:8:\"username\";s:14:\"nuan@gmail.com\";s:8:\"password\";s:3:\"123\";s:5:\"email\";s:0:\"\";}'),
(4, ''),
(5, '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_obj` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `seller_id` int(11) NOT NULL,
  `seller_obj` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`seller_id`, `seller_obj`) VALUES
(1, 'O:6:\"seller\":3:{s:8:\"username\";s:15:\"nuwan@gmail.com\";s:8:\"password\";s:3:\"123\";s:5:\"email\";s:0:\"\";}'),
(2, 'O:6:\"seller\":3:{s:8:\"username\";s:15:\"nuwan@gmail.com\";s:8:\"password\";s:3:\"123\";s:5:\"email\";s:0:\"\";}'),
(3, 'O:6:\"seller\":3:{s:8:\"username\";s:15:\"nuwan@gmail.com\";s:8:\"password\";s:3:\"123\";s:5:\"email\";s:0:\"\";}'),
(4, 'O:6:\"seller\":3:{s:8:\"username\";s:15:\"nuwan@gmail.com\";s:8:\"password\";s:3:\"123\";s:5:\"email\";s:0:\"\";}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`seller_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
