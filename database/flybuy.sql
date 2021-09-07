-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2021 at 08:30 AM
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
-- Table structure for table `buyers`
--

CREATE TABLE `buyers` (
  `buy_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `telNo` varchar(20) NOT NULL,
  `vkey` varchar(255) NOT NULL,
  `verified` boolean NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`buy_id`, `username`, `password`, `email`, `address`, `telNo`) VALUES
(1, 'nuwan@gmail.com', '123', '', '', ''),
(2, 'nuwan@gmail.com', '123', '', '', ''),
(3, 'nuwan@gmail.com', '123', '', '', ''),
(4, 'nuwan@gmail.com', '123', '', '', ''),
(5, 'nuwan@gmail.com', '123', '', '', ''),
(6, 'nuwan@gmail.com', '123qwe', 'n@f.c', '', ''),
(7, 'nuwan@gmail.com', '123qwe', 's@dfsf.v', '', ''),
(8, 'nuwan@gmail.com', '123qwe', 'dsdf@dff.v', '', ''),
(9, 'nuwan@gmail.com', '123qwe', 'dsdf@dff.v', '', ''),
(10, 'nuwan@gmail.com', '123qwe', 'sda@dfd.c', '', ''),
(11, 'nuwan@gmail.com', '123456', 'dfsf@df.v', '', ''),
(12, 'nuwan@gmail.com', '123sd', 'nuwan@gmail.com', 'sdffd', 'sdsdf'),
(13, 'nuwan@gmail.com', '123sdf', 'nuwan@gmail.comfdsfsdsdff', 'sdfsfd', 'fdsdffd'),
(14, 'nuwan@gmail.com', '123', 'nuwan@gmail.comsdsfdffdsh', 'eggr', 'rerg'),
(15, 'nuwan@gmail.com', '123', 'nuwan@gmail.com', 'n0.31,sdad,asddsa', 'dsfdf'),
(16, 'nuwan@gmail.com', '123', 'nuwan@gmail.comsadsd', 'sdfsd', 'saddsa'),
(17, 'nuwan@gmail.com', '123', 'nuwan@gmail.comsdgfhg', 'fddf', 'fdg'),
(18, 'nuwan@gmail.com', '123sdf', 'nuwan@gmail.com', 'dsfd', 'dsf'),
(19, 'nuwan@gmail.com', '123', 'nuwan@sddffsd.com', 'erg', 'reger'),
(20, 'nuwan@gmail.com', '123', 'nuwan@gmail.com', 'sdfsd', 'sdf'),
(21, 'nuwan@gmail.com', '123', 'nuwan@gmail.comfsdf', 'sdff', 'sffd'),
(22, 'nuwan@gmail.com', '123', 'nuwan@gmail.com', 'dffd', 'dfdfg'),
(23, 'nuwan@gmail.com', '123', 'nuwan@gmail.comdxdfs', 'fghf', 'gfh'),
(24, 'nuwan@gmail.com', '123', 'nuwan@gmail.com', 'dfs', 'sads'),
(25, 'nuwan@gmail.com', '123', 'nuwan@gmail.comkll', 'er', 're'),
(26, 'nuwan@gmail.com', '123', 'nuwan@gmail.comdsffg', 'gfd', '0112445345'),
(27, 'nuwan@gmail.com', '123', 'nuwan@gmail.comfd', '032', '0234567890');

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
  `password` varchar(30) NOT NULL,
  `Address` varchar(30) NOT NULL,
  `telNo` varchar(30) NOT NULL,
  `storeName` varchar(30) NOT NULL,
  `vkey` varchar(255) NOT NULL,
  `verified` boolean NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`seller_id`, `username`, `email`, `password`, `Address`, `telNo`, `storeName`) VALUES
(1, 'nuwan@gmail.com', 'f@g.com', '123', '', '', ''),
(2, 'nuwan@gmail.com', 'f@g.com', '123', '', '', ''),
(3, 'nufsdfsfdddfsfffsffsdfdfsfsdff', '123', '', '', '', ''),
(4, 'nufsdfsfdddfsfffsffsdfdfsfsdff', '123', '', '', '', ''),
(5, 'nudsfsfdfsdfswan@gmail.com', '123', '', '', '', ''),
(6, 'n@gmail.com', '123', '', '', '', ''),
(7, 'n@gmail.com', '123', '', '', '', ''),
(8, 'nuwan@gmail.com', 'regre@fg.com', '123', '', '', ''),
(9, 'nuwan@gmail.com', 'dfsfd@df.v', '123456', '', '', ''),
(10, 'nuwan@gmail.com', 'nuwan@gmail.com', '123dfdf', 'fdgdf', 'dxdf', 'dfgfd'),
(11, 'nuwan@gmail.com', 'nufsdffdfwan@gmail.com', '123sd', 'sdfd', 'dsdfs', 'sdfdf'),
(12, 'nuwan@gmail.com', 'nufsdffdfwan@gmail.com', '123sd', 'sdfd', 'dsdfs', 'sdfdf'),
(13, 'nuwan@gmail.com', 'efnuwan@gmail.com', '123qwe!@#', 'ergeg', 'rgergerg', 'wer'),
(14, 'nuwan@gmail.com', 'ewfffewwefnuwan@gmail.com', '123qwe!@#', 'ergereg', 'erg', 'asda'),
(15, 'nuwan@gmail.com', 'nqwdwdqduwan@gmail.com', '123', 'fefwefwef', 'wefefwef', 'dsdfs'),
(16, 'nuwan@gmail.com', 'nuwan@gmail.com', '123sfd', 'sdffdssd', 'dsfdsf', 'sdfdsf'),
(17, 'nuwan@gmail.com', 'fdsnuwan@gmail.com', '123dfg', 'dffg', 'ffdg', 'dgf'),
(18, 'nuwan@gmail.com', 'nuwan@gmail.comdsfhg', '123', 'gfrr', '0112700703', 'hrtt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`buy_id`);

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
-- AUTO_INCREMENT for table `buyers`
--
ALTER TABLE `buyers`
  MODIFY `buy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
