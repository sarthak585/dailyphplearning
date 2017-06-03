-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2017 at 02:59 PM
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
  `TotalScore` double DEFAULT NULL,
  `TotalTime` double DEFAULT NULL,
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `CreatedDateTime` datetime DEFAULT NULL,
  `UpdatedDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderinvoice`
--

INSERT INTO `orderinvoice` (`OrderId`, `UserId`, `CategoryId`, `DifficultyId`, `TotalScore`, `TotalTime`, `CreatedDateTime`, `UpdatedDateTime`) VALUES
(1, 3, 1, 1, NULL, NULL, NULL, NULL),
(2, 3, 1, 1, NULL, NULL, NULL, NULL),
(3, 3, 1, 1, NULL, NULL, NULL, NULL),
(4, 3, 1, 1, NULL, NULL, NULL, NULL),
(5, 3, 1, 1, NULL, NULL, NULL, NULL),
(6, 3, 4, 3, NULL, NULL, NULL, NULL),
(7, 3, 4, 3, NULL, NULL, NULL, NULL),
(8, 3, 4, 3, NULL, NULL, NULL, NULL),
(9, 3, 4, 3, NULL, NULL, NULL, NULL),
(10, 3, 4, 3, NULL, NULL, NULL, NULL),
(11, 3, 2, 3, NULL, NULL, NULL, NULL),
(12, 3, 2, 3, NULL, NULL, NULL, NULL),
(13, 3, 2, 3, NULL, NULL, NULL, NULL),
(14, 3, 1, 1, NULL, NULL, NULL, NULL),
(15, 3, 1, 1, NULL, NULL, NULL, NULL),
(16, 3, 1, 1, NULL, NULL, NULL, NULL),
(17, 3, 3, 2, NULL, NULL, NULL, NULL),
(18, 3, 3, 2, NULL, NULL, NULL, NULL),
(19, 3, 1, 1, NULL, NULL, NULL, NULL);

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
(13, 0x412c204220616e6420432063616e20646f2061207069656365206f6620776f726b20696e2032302c20333020616e64203630206461797320726573706563746976656c792e20496e20686f77206d616e7920646179732063616e204120646f2074686520776f726b206966206865206973206173736973746564206279204220616e642043206f6e206576657279207468697264206461793f, 0x31322064617973, 0x31352064617973, 0x31362064617973, 0x31382064617973, 2, 1, 1);

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
  MODIFY `OrderDetailId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orderinvoice`
--
ALTER TABLE `orderinvoice`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
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
