-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2021 at 07:02 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

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
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_no` int(11) NOT NULL,
  `serial_no` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `cust_id` int(11) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `lot_no`, `street`, `city`, `country`) VALUES
(10, 'Baguio-Benguet Branch', '2019', 'EngineerHill', 'Baguio', 'Philippines'),
(11, 'Milan Branch', '10', 'Renaissance', 'Milan', 'Italy'),
(12, 'Paranaque NCR Branch', '7567 Block B', 'Worth Drive', 'Paranaque', 'Philippines'),
(13, 'Fuhrer Stockholm Branch', '424', 'Pewpew', 'Stockholm', 'Sweden'),
(14, 'Padre Faura Manila Branch', '331131', 'General Luna', 'Manila', 'Philippines'),
(15, 'Vito Cruz Manila Branch', '80', 'Ocampo', 'Manila', 'Philippines'),
(16, 'Cebu Branch', '42304', 'Velez', 'Cebu', 'Philippines'),
(17, 'Palawan Branch', '312-A', 'Lansanas', 'PuertoPrincesa', 'Philippines'),
(18, 'Singapore Branch', '29310', 'Li Hwan Drive ', 'Singapore', 'Singapore'),
(19, 'U.N. Manila Branch', '42', 'United Nations Avenue', 'Manila', 'Philippines');

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
(80, 'Isuzu'),
(81, 'Mitsubishi'),
(82, 'Hyunda'),
(83, 'Toyota'),
(84, 'Honda'),
(85, 'Ford'),
(86, 'Audi'),
(87, 'BMW'),
(88, 'Cadillac'),
(89, 'Ferrari'),
(90, 'Fiat'),
(91, 'Mercedez-Benz'),
(92, 'Pontiac'),
(93, 'Porsche'),
(94, 'Volskwagen');

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
(145, 81),
(144, 82),
(149, 82),
(146, 83),
(148, 83),
(152, 83),
(147, 84),
(150, 85);

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
(147, 1),
(149, 1),
(145, 5),
(146, 5),
(150, 7),
(151, 7),
(152, 7),
(148, 27);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dealer`
--

INSERT INTO `dealer` (`dealer_id`, `f_name`, `m_name`, `l_name`, `house_no`, `street`, `city`, `country`, `phone_no`, `email`) VALUES
(4, 'Shaina', 'Bess', 'Medina', '2903', 'Senpai', 'NuevaVizcaya', 'Philippines', 2147483647, 'shaishaishai@gmail.com'),
(5, 'Scarlett ', 'Barboa', 'Gamboa', '4', 'Happiness', 'RexOrange', 'USA', 2147483647, 'scarjo@gmail.com'),
(6, 'Rembrandt', 'Armin', 'Toast', '9090', 'Alfalfa', 'Bread', 'Philippines', 945893889, 'remmyratata@gmail.com'),
(7, 'Tanjiro', 'Miguel', 'San Juan', '29-C', 'Maywood', 'Tondo', 'Philippines', 2147483647, 'tancossin@gmail.com'),
(8, 'Monkey', 'D.', 'Luffy', '111', 'Rubber', 'SHP', 'Japan', 2147483647, 'monkey_luffy@gmail.com'),
(9, 'Lelouch', 'Lamp', 'Lamperouge', '57', 'Code', 'Geass', 'Philippines', 945999999, 'lelouchy_0@gmail.com'),
(10, 'Jhemerlynne', 'Princess', 'Timbalopez', '5678', 'Hatdog', 'Bayawan', 'Philippines', 2147483647, 'jhemy_b0ss-princess@gmail.com'),
(11, 'Timothy', 'James', 'Dela Torre', '40', 'Dbd', 'Quezon', 'Philippines', 2147483647, 'tjdellgaminglaptop@gmail.com'),
(12, 'Charles', 'Samuel', 'Caburian', '00', 'Sana ol nasa', 'LaUnion', 'Philippines', 2147483647, 'csc-1-1@gmail.com'),
(13, 'Mary Anne Mae Princess', 'Escalante', 'Gio', '1901', 'Heneral', 'Lucena', 'Philippines', 2147483647, 'mamamo@gmail.com');

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
  `availability` varchar(50) NOT NULL DEFAULT 'Available',
  `description` varchar(500) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`serial_no`, `model_name`, `year`, `color`, `seat_capacity`, `transmission`, `speed`, `engine`, `price`, `availability`, `description`, `image`) VALUES
(144, 'Hyundai Eon', 2020, 'Blue', 5, 'Choose...', 55, '0.8L SOHC Gasoline', '528000', 'Available', 'a car', 'default'),
(145, 'Mitsubishi Mirage', 2019, 'Yellow', 5, 'Automatic transmission', 77, '1.2L DOHC Gasoline', '553000', 'Available', '', 'default'),
(146, 'Toyota Wigo', 2020, 'Red', 5, 'Manual transmission', 64, '1.0L DOHC Gasoline', '526000', 'Available', '', 'default'),
(147, 'Honda City', 2017, 'Blue', 5, 'Continuously variable transmission (CVT)', 118, '1.5L SOHC Gasoline', '898000', 'Available', '', 'default'),
(148, 'Toyota Vios', 2020, 'Red', 5, 'Automatic transmission', 107, '1.5L DOHC Gasoline', '880000', 'Available', '', 'default'),
(149, 'Hyundai Accent', 2018, 'Brown', 5, 'Continuously variable transmission (CVT)', 99, '1.4L DOHC Gasoline', '888000', 'Available', '', 'default'),
(150, 'Ford Everest', 2021, 'Red', 7, 'Automatic transmission', 197, '3.2L DOHC 15 Turbodiesel', '1459000', 'Available', '', 'default'),
(151, 'Mitsubishi Montero Sport', 2021, 'White', 7, 'Automatic transmission', 178, '2.4L DOHC 14 Turbodiesel', '1450000', 'Available', '', 'default'),
(152, 'Toyota Fortuner', 2021, 'Black', 7, 'Automatic transmission', 174, '2.8L DOHC 14 Turbodiesel', '1599000', 'Available', '', 'default');

-- --------------------------------------------------------

--
-- Table structure for table `provides`
--

CREATE TABLE `provides` (
  `branch_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provides`
--

INSERT INTO `provides` (`branch_id`, `supplier_id`) VALUES
(13, 7);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `serial_no` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`serial_no`, `branch_id`) VALUES
(144, 10),
(150, 10),
(146, 14);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(10) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `lot_no` varchar(10) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone_no` bigint(12) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `company_name`, `lot_no`, `street`, `city`, `country`, `phone_no`, `email`) VALUES
(6, 'Toyota Motor Corp. (TM)', '9444', 'Haha', 'California', 'USA', 2147483647, 'toyotamotor@gmail.com'),
(7, 'Volkswagen AG (VWAGY)', '1100', 'Hemlin', 'TorontoSA', 'Canada', 423423423423, 'email@gmail.com'),
(8, 'Daimler AG (DMLRY)', '227757', 'Wimbledon', 'Berlin', 'Germany', 1000000000, 'daimler@gmail.com'),
(9, 'Ford Motor Co. (F)', '3', 'Wenkwonk', 'NYC', 'USA', 60090909090, 'ford@gmail.com'),
(11, 'Bayerische Motoren Werke AG (B', '34234', 'Schuller', 'Berlin', 'Germany', 945909043902, 'bmwskrt@gmail.com'),
(12, 'General Motors Co. (GM)', '33333', 'Rich', 'Baguio', 'Philippines', 29992093920, 'gm@gmail.com'),
(13, 'Fiat Chrysler Automobiles NV (', '39203', 'Lazio', 'Milan', 'Italy', 5557897000, 'fiat@yahoo.com'),
(14, 'Hyundai Motor Co. (HYMTF)', '78', 'Busan', 'Seoul', 'SouthKorea', 234923204923, 'hyundai@yahoo.com'),
(15, 'Nissan Motor Co. Ltd. (NSANY)', '4234', 'Lucky Me', 'Kyoto', 'Japan', 93204932049, 'nissan@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `m_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `house_no` varchar(10) NOT NULL,
  `street` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `phone_no` varchar(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `m_name`, `l_name`, `house_no`, `street`, `city`, `country`, `phone_no`, `email`, `password`, `role`) VALUES
(3, 'Alo', 'Alo', 'Alo', '123', 'Alo', 'Alo', 'Alo', '09999999999', 'alo@gmail.com', '$2y$10$Ip7KrVh1JqCy6MUoQEAj2O4VqlTLSm9wjVemCEuUwEX2XSSE1Y1lK', 'customer'),
(4, 'Mar', 'Mar', 'Mar', '123', 'Mar', 'Mar', 'Mar', '09091312312', 'mar@gmail.com', '$2y$10$zgoEyc4Rb4F4QR4cAsp0ruN1id8U7/yyhR3AofDj2IFz8Mf2Rqoki', 'customer'),
(5, 'Joy', 'Joy', 'Joy', '123', 'Joy', 'Joy', 'Joy', '09090909090', 'joy@gmail.com', '$2y$10$cVieSOBQfsRqnItUFf6akOWircVh4nfsE3hOr.jw2n9Lc5/1BDVFG', 'admin'),
(6, 'Noelly', 'Mase', 'Santos', '123A', 'Domingo', 'Antipolo', 'Philippines', '09121212121', 'noelly@gmail.com', '', 'customer'),
(7, 'Shaina', 'Hermoso', 'Medina', '2', 'Aquino', 'somewhere', 'Philippines', '0977987632', 'shai@gmail.com', '$2y$10$eY/0GHsS3Mi4y49MLg8hDumDZRlu8PNGfKAx9cRgtWKg1eZUolpKu', 'admin'),
(9, 'Admin', 'Admin', 'Admin', '1', 'Street', 'Baguio', 'Philippines', '00000000000', 'Admin@gmail.com', '$2y$10$6bY5V2iSWsjz6HA1ICaVa.tjtpBstej7X2Bd0UYLTclInvaWVgPm.', 'admin');

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
(1, 'Sedan'),
(2, 'Coupe'),
(3, 'Sports Car'),
(4, 'Station Wagon'),
(5, 'HatchBack'),
(6, 'Convertible'),
(7, 'Sport-Utility Vehicle (SUV)'),
(8, 'Minivan'),
(9, 'Pickup Truck'),
(10, 'Van'),
(27, 'Compact');

-- --------------------------------------------------------

--
-- Table structure for table `works_at`
--

CREATE TABLE `works_at` (
  `dealer_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `works_at`
--

INSERT INTO `works_at` (`dealer_id`, `branch_id`) VALUES
(7, 10),
(4, 12),
(6, 12),
(12, 12),
(10, 14),
(11, 17),
(8, 18),
(13, 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_no`),
  ADD KEY `serial_no` (`serial_no`),
  ADD KEY `dealer_id` (`dealer_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

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
-- Indexes for table `provides`
--
ALTER TABLE `provides`
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`serial_no`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `works_at`
--
ALTER TABLE `works_at`
  ADD PRIMARY KEY (`dealer_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `dealer`
--
ALTER TABLE `dealer`
  MODIFY `dealer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `serial_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`serial_no`) REFERENCES `item` (`serial_no`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`dealer_id`) REFERENCES `dealer` (`dealer_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`cust_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `branded`
--
ALTER TABLE `branded`
  ADD CONSTRAINT `branded_ibfk_1` FOREIGN KEY (`serial_no`) REFERENCES `item` (`serial_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `branded_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `categorized`
--
ALTER TABLE `categorized`
  ADD CONSTRAINT `categorized_ibfk_1` FOREIGN KEY (`serial_no`) REFERENCES `item` (`serial_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categorized_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `vehicle_type` (`type_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `provides`
--
ALTER TABLE `provides`
  ADD CONSTRAINT `provides_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `provides_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`serial_no`) REFERENCES `item` (`serial_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stocks_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `works_at`
--
ALTER TABLE `works_at`
  ADD CONSTRAINT `works_at_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `works_at_ibfk_2` FOREIGN KEY (`dealer_id`) REFERENCES `dealer` (`dealer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
