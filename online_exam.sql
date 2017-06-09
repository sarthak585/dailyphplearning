-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2017 at 05:51 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_exam`
--
CREATE DATABASE IF NOT EXISTS `online_exam` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `online_exam`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryId` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryId`, `Name`, `IsActive`) VALUES
(1, 'Aptitude', 1),
(2, '.Net', 1),
(3, 'Android', 1),
(4, 'PHP', 1),
(5, 'HTML', 1),
(6, 'CSS', 1),
(7, 'Java', 1);

-- --------------------------------------------------------

--
-- Table structure for table `difficulty`
--

CREATE TABLE `difficulty` (
  `DifficultyId` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `difficulty`
--

INSERT INTO `difficulty` (`DifficultyId`, `Name`, `IsActive`) VALUES
(1, 'Begginer', 1),
(2, 'Intermediate', 1),
(3, 'Moderate', 1),
(4, 'Expert', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `OrderDetailId` int(11) NOT NULL,
  `OrderId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `GivenAnswer` int(11) DEFAULT NULL,
  `Score` double DEFAULT NULL,
  `Time` double DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`OrderDetailId`, `OrderId`, `ProductId`, `GivenAnswer`, `Score`, `Time`, `CreatedDateTime`) VALUES
(1, 1, 5, 1, 1, 2, '2017-06-08 09:57:25'),
(2, 1, 11, 4, 1, 2, '2017-06-08 09:57:28'),
(3, 1, 12, 1, 1, 3, '2017-06-08 09:57:31'),
(4, 1, 13, 2, 1, 3, '2017-06-08 09:57:34'),
(5, 2, 5, 1, 1, 3, '2017-06-08 12:14:12'),
(6, 2, 11, 4, 1, 1, '2017-06-08 12:14:14'),
(7, 2, 12, 1, 1, 5, '2017-06-08 12:14:19'),
(8, 2, 13, 2, 1, 3, '2017-06-08 12:14:23'),
(9, 3, 5, 1, 1, 5, '2017-06-09 07:06:50'),
(10, 3, 11, 4, 1, 2, '2017-06-09 07:06:53'),
(11, 3, 12, 1, 1, 2, '2017-06-09 07:06:56'),
(12, 3, 13, 2, 1, 14, '2017-06-09 07:07:10'),
(13, 4, 5, 3, 0, 3, '2017-06-09 07:10:24'),
(14, 4, 11, 2, 0, 6, '2017-06-09 07:10:31'),
(15, 4, 12, 0, 0, 9, '2017-06-09 07:10:40'),
(16, 4, 13, 2, 1, 12, '2017-06-09 07:10:53');

--
-- Triggers `orderdetail`
--
DELIMITER $$
CREATE TRIGGER `order_insert_time` BEFORE INSERT ON `orderdetail` FOR EACH ROW set NEW.CreatedDateTime = NOW()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `order_update_time` BEFORE UPDATE ON `orderdetail` FOR EACH ROW SET New.UpdatedDateTime = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orderinvoice`
--

CREATE TABLE `orderinvoice` (
  `OrderId` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `DifficultyId` int(11) DEFAULT NULL,
  `TotalScore` double DEFAULT NULL,
  `TotalTime` decimal(10,0) DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderinvoice`
--

INSERT INTO `orderinvoice` (`OrderId`, `UserId`, `CategoryId`, `DifficultyId`, `TotalScore`, `TotalTime`, `CreatedDateTime`) VALUES
(1, 3, 1, 1, 4, '10', '2017-06-08 09:57:15'),
(2, 3, 1, 1, 4, '12', '2017-06-08 12:14:06'),
(3, 3, 1, 1, 4, '23', '2017-06-09 07:06:36'),
(4, 3, 1, 1, 1, '30', '2017-06-09 07:10:16');

--
-- Triggers `orderinvoice`
--
DELIMITER $$
CREATE TRIGGER `orderinvoice_insert_DateTime` BEFORE INSERT ON `orderinvoice` FOR EACH ROW SET New.CreatedDateTime = NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductId` int(11) NOT NULL,
  `Question` blob,
  `OptionA` blob,
  `OptionB` blob,
  `OptionC` blob,
  `OptionD` blob,
  `Answer` tinyint(4) DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `DifficultyId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductId`, `Question`, `OptionA`, `OptionB`, `OptionC`, `OptionD`, `Answer`, `CategoryId`, `DifficultyId`) VALUES
(5, 0x4120706572736f6e2063726f73736573206120363030206d206c6f6e672073747265657420696e2035206d696e757465732e20576861742069732068697320737065656420696e206b6d2070657220686f75723f, 0x332e36, 0x372e32, 0x382e34, 0x3130, 1, 1, 1),
(10, 0x576861742069732074686520646966666572656e6365206265747765656e20416374697669747920636f6e7465787420616e64204170706c69636174696f6e20436f6e746578743f, 0x54686520416374697669747920696e7374616e6365206973207469656420746f20746865206c696665206379636c65206f6620616e2041637469766974792e207768696c6520746865206170706c69636174696f6e20696e7374616e6365206973207469656420746f20746865206c696665206379636c65206f6620746865206170706c69636174696f6e2e, 0x54686520416374697669747920696e7374616e6365206973207469656420746f20746865206c6966652d6379636c65206f6620746865206170706c69636174696f6e2c207768696c6520746865206170706c69636174696f6e20696e7374616e6365206973207469656420746f20746865206c6966652d6379636c65206f6620616e2041637469766974792e, 0x54686520416374697669747920696e7374616e6365206973207469656420746f20746865206c6966652d6379636c65206f66207468652041637469766974792c207768696c6520746865206170706c69636174696f6e20696e7374616e6365206973207469656420746f20746865206c6966652d6379636c65206f6620616e206170706c69636174696f6e2e, 0x4e6f6e65206f66207468652061626f7665, 1, 3, 1),
(11, 0x5768696368206f6e65206f662074686520666f6c6c6f77696e67206973206e6f742061207072696d65206e756d6265723f, 0x3331, 0x3631, 0x3731, 0x3931, 4, 1, 1),
(12, 0x46696e6420746865206772656174657374206e756d62657220746861742077696c6c206469766964652034332c20393120616e642031383320736f20617320746f206c65617665207468652073616d652072656d61696e64657220696e20656163682063617365, 0x34, 0x37, 0x39, 0x3133, 1, 1, 1),
(13, 0x412c204220616e6420432063616e20646f2061207069656365206f6620776f726b20696e2032302c20333020616e64203630206461797320726573706563746976656c792e20496e20686f77206d616e7920646179732063616e204120646f2074686520776f726b206966206865206973206173736973746564206279204220616e642043206f6e206576657279207468697264206461793f, 0x31322064617973, 0x31352064617973, 0x31362064617973, 0x31382064617973, 2, 1, 1),
(14, 0x416e206572726f7220322520696e20657863657373206973206d616465207768696c65206d6561737572696e67207468652073696465206f662061207371756172652e205468652070657263656e74616765206f66206572726f7220696e207468652063616c63756c617465642061726561206f6620746865207371756172652069733a, 0x3225, 0x322e303225, 0x3425, 0x342e303425, 4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserId` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` double DEFAULT NULL,
  `UserRole` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`, `Phone`, `UserRole`) VALUES
(1, 'Admin', 'Bit', 'admin', 'admin', 'admin@bit.com', 9892839589, 'admin'),
(2, 'Sarthak', 'Shah', 'sarthakshah', 'sarthak', 'sarthak@gmail.com', 8469598777, 'admin'),
(3, 'Student', 'Student', 'student', 'student', 'student@bit.com', 9898989898, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `difficulty`
--
ALTER TABLE `difficulty`
  ADD PRIMARY KEY (`DifficultyId`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`OrderDetailId`),
  ADD KEY `OrderId` (`OrderId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `orderinvoice`
--
ALTER TABLE `orderinvoice`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `ForeignKey` (`CategoryId`),
  ADD KEY `DifficultyLevelId` (`DifficultyId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `difficulty`
--
ALTER TABLE `difficulty`
  MODIFY `DifficultyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `OrderDetailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `orderinvoice`
--
ALTER TABLE `orderinvoice`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `orderinvoice` (`OrderId`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `product` (`ProductId`);

--
-- Constraints for table `orderinvoice`
--
ALTER TABLE `orderinvoice`
  ADD CONSTRAINT `orderinvoice_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`CategoryId`) REFERENCES `category` (`CategoryId`),
  ADD CONSTRAINT `fk_difficulty_id` FOREIGN KEY (`DifficultyId`) REFERENCES `difficulty` (`DifficultyId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
