-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2021 at 01:48 PM
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
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `username`, `password`, `email`) VALUES
(1, 'nuwan@gmail.com', '123', 'n@gmail.com'),
(2, 'nuwan@gmail.com', '123', 'n@gmail.com'),
(3, 'nuwan@gmail.com', '123', ''),
(4, 'nuwan@gmail.com', '123', ''),
(5, 'nuwan@gmail.com', '', '123'),
(6, 'nuwan@gmail.com', '', '123'),
(7, 'nuwan@gmail.com', '', '123'),
(8, 'nuwan@gmail.com', '', '123'),
(9, 'nuwan@gmail.com', '', '123'),
(10, 'nuwan@gmail.com', '', '123'),
(11, 'nuwan@gmail.com', '', '123'),
(12, 'nuwan@gmail.com', '', '123'),
(13, 'nuwsadadsdddan@gmail.com', '', '123'),
(14, 'nuwsadadsdddan@gmail.com', '', '123'),
(15, 'nuwdsffdan@gmail.com', '', '123'),
(16, 'nuwdsffdan@gmail.com', '', '123'),
(17, 'nuwdsffdan@gmail.com', '', '123'),
(18, 'dfsfdfdfffd@gmail.com', '', '123'),
(19, 'dfsfdfdfffd@gmail.com', '', '123'),
(20, 'dfsfdfdfffd@gmail.com', '', '123'),
(21, 'n@gmail.com', '', '123'),
(22, 'nuwan@gmail.com', '', '123'),
(23, 'nuwan@gmail.com', 'k@g.com', '123');

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
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`seller_id`, `username`, `email`, `password`) VALUES
(1, 'nuwan@gmail.com', 'f@g.com', '123'),
(2, 'nuwan@gmail.com', 'f@g.com', '123'),
(3, 'nufsdfsfdddfsfffsffsdfdfsfsdff', '123', ''),
(4, 'nufsdfsfdddfsfffsffsdfdfsfsdff', '123', ''),
(5, 'nudsfsfdfsdfswan@gmail.com', '123', ''),
(6, 'n@gmail.com', '123', ''),
(7, 'n@gmail.com', '123', '');

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
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
