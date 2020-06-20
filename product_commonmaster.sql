-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2020 at 05:23 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_commonmaster`
--

CREATE TABLE `product_commonmaster` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_price` int(11) NOT NULL,
  `colors` longtext NOT NULL,
  `image` longtext NOT NULL,
  `category` varchar(50) NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_commonmaster`
--

INSERT INTO `product_commonmaster` (`product_id`, `product_name`, `product_price`, `colors`, `image`, `category`, `isactive`) VALUES
(2, 'Hair Wax', 350, '', 'Screenshot_2020-01-07-12-34-31-508.jpeg', '', 1),
(3, 'Beard Oil', 450, '', 'Screenshot_2020-01-07-12-40-48-661.jpeg', '', 1),
(4, 'Hair Spray', 150, '', 'Screenshot_2020-01-07-12-38-13-935.jpeg', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_commonmaster`
--
ALTER TABLE `product_commonmaster`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_commonmaster`
--
ALTER TABLE `product_commonmaster`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
