-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2021 at 11:33 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sza`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(30) NOT NULL,
  `lot_no` varchar(30) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `lot_no`, `street`, `city`, `country`) VALUES
(1, 'jsadhask', 'jkhkjhk', 'kjhkjh', '', 'kjhkjhkjh');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(10) NOT NULL,
  `brand_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
(75, ' sdc'),
(76, 'casc'),
(78, 'dsafasdfsadfsafsafasfsafasfsfdas'),
(77, 'dsfasdfasdfasdfsadfasdfs'),
(74, 'dvsdv'),
(7, 'Honda'),
(8, 'Jaguar'),
(3, 'Kia'),
(11, 'Lexus'),
(5, 'Mazda'),
(9, 'Mitsubishi'),
(2, 'Porsche'),
(79, 'sdfsdfdsfdsfds'),
(4, 'Tesla'),
(6, 'Toyota'),
(10, 'Volvo'),
(73, 'Volvoloc');

-- --------------------------------------------------------

--
-- Table structure for table `branded`
--

CREATE TABLE `branded` (
  `serial_no` int(10) NOT NULL,
  `brand_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branded`
--

INSERT INTO `branded` (`serial_no`, `brand_id`) VALUES
(127, 73),
(129, 74),
(126, 75),
(135, 75),
(136, 75),
(133, 76),
(137, 76),
(138, 76),
(139, 76);

-- --------------------------------------------------------

--
-- Table structure for table `categorized`
--

CREATE TABLE `categorized` (
  `serial_no` int(10) NOT NULL,
  `type_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorized`
--

INSERT INTO `categorized` (`serial_no`, `type_id`) VALUES
(139, 5),
(130, 8),
(127, 9),
(129, 19),
(133, 21),
(135, 21),
(136, 21),
(137, 24),
(138, 24);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(10) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `m_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `house_no` varchar(10) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `f_name`, `m_name`, `l_name`, `house_no`, `street`, `city`, `country`, `phone_no`, `email`) VALUES
(73, 'Mary Elizabeth', 'Estaris', 'Chua', 'f', 'Worth Drive', 'Paranaque', 'Philippines', 2147483647, 'mc@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `dealer`
--

CREATE TABLE `dealer` (
  `dealer_id` int(11) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `m_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `house_no` varchar(10) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dealer`
--

INSERT INTO `dealer` (`dealer_id`, `f_name`, `m_name`, `l_name`, `house_no`, `street`, `city`, `country`, `phone_no`, `email`) VALUES
(1, 'Mary Elizabeth', 'Estaris', 'Chua', 'ghdfhfdhdf', 'Worth Drive', 'Paranaque', 'Philippines', 2147483647, 'mc@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `serial_no` int(10) NOT NULL,
  `model_name` varchar(30) NOT NULL,
  `year` int(5) NOT NULL,
  `color` varchar(10) DEFAULT NULL,
  `seat_capacity` int(5) DEFAULT 5,
  `transmission` varchar(50) DEFAULT NULL,
  `speed` int(10) DEFAULT NULL,
  `engine` varchar(50) DEFAULT NULL,
  `price` decimal(20,0) NOT NULL,
  `availability` tinytext DEFAULT '\'Available\'',
  `description` varchar(500) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`serial_no`, `model_name`, `year`, `color`, `seat_capacity`, `transmission`, `speed`, `engine`, `price`, `availability`, `description`, `image`) VALUES
(126, 'Bolbolok ulit', 2021, 'blue', 4, 'V6', 345, 'dasd', '200', '\'Available\'', 'bulok daw', 'scdas'),
(127, 'Bolbolok ulit', 2021, 'blue', 4, 'V6', 345, 'dasd', '200', '\'Available\'', 'bulok daw', 'scdas'),
(128, 'sdvsd', 0, 'vsdvsdv', 4, 'dv', 0, 'sdv', '0', '\'Available\'', 'sdvs', 'vsdvsd'),
(129, 'sdvsd', 0, 'vsdvsdv', 4, 'dv', 0, 'sdv', '0', '\'Available\'', 'sdvs', 'vsdvsd'),
(130, 'sd', 0, 'vsd', 4, 'sdv', 0, 'sdv', '0', '\'Available\'', 'vsd', 'csdv'),
(131, 'sd', 0, 'vsd', 4, 'sdv', 0, 'sdv', '0', '\'Available\'', 'vsd', 'csdv'),
(133, 'asc', 0, 'asc', 6, 'asc', 0, 'ascas', '0', '\'Available\'', 'asc', 'asc'),
(134, 'asc', 0, 'asc', 6, 'asc', 0, 'ascas', '0', '\'Available\'', 'asc', 'asc'),
(135, 'asc', 0, 'asc', 6, 'asc', 0, 'ascas', '0', '\'Available\'', 'asc', 'asc'),
(136, 'asc', 0, 'asc', 6, 'asc', 0, 'ascas', '0', '\'Available\'', 'asc', 'asc'),
(137, 'asx', 0, 'asca', 4, 'sc', 0, 'asc', '0', '\'Available\'', 'sc', 'as'),
(138, 'asxa', 0, 'asca', 4, 'sc', 0, 'asc', '0', '\'Available\'', 'sc', 'as'),
(139, 'asxa', 0, 'asca', 4, 'sc', 0, 'asc', '0', '\'Available\'', 'sc', 'as');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(10) NOT NULL DEFAULT 0,
  `f_name` varchar(30) NOT NULL,
  `m_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `house_no` varchar(10) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `f_name`, `m_name`, `l_name`, `house_no`, `street`, `city`, `country`, `phone_no`, `email`) VALUES
(0, '1', '2', '3', '4', '5', 'sdasdasdas', 'dasdasdasdas', 2147483647, 'jsdhfksdjf@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `type_id` int(10) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_type`
--

INSERT INTO `vehicle_type` (`type_id`, `type_name`) VALUES
(24, 'casc'),
(6, 'Convertible'),
(2, 'Coupe'),
(21, 'csa'),
(26, 'dsfdsfdsf'),
(5, 'HatchBack'),
(8, 'Minivan'),
(9, 'Pickup Truck'),
(20, 'sds'),
(19, 'sdvsd'),
(1, 'Sedan'),
(7, 'Sport-Utility Vehicle (SUV)'),
(3, 'Sports Car'),
(4, 'Station Wagon'),
(10, 'Van');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`),
  ADD UNIQUE KEY `brand_name` (`brand_name`);

--
-- Indexes for table `branded`
--
ALTER TABLE `branded`
  ADD PRIMARY KEY (`serial_no`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `categorized`
--
ALTER TABLE `categorized`
  ADD PRIMARY KEY (`serial_no`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `dealer`
--
ALTER TABLE `dealer`
  ADD PRIMARY KEY (`dealer_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`serial_no`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`type_id`),
  ADD UNIQUE KEY `type_name` (`type_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `dealer`
--
ALTER TABLE `dealer`
  MODIFY `dealer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `serial_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branded`
--
ALTER TABLE `branded`
  ADD CONSTRAINT `branded_ibfk_1` FOREIGN KEY (`serial_no`) REFERENCES `item` (`serial_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `branded_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categorized`
--
ALTER TABLE `categorized`
  ADD CONSTRAINT `categorized_ibfk_1` FOREIGN KEY (`serial_no`) REFERENCES `item` (`serial_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categorized_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `vehicle_type` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
