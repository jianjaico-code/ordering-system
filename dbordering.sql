-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2021 at 09:30 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbordering`
--

-- --------------------------------------------------------

--
-- Table structure for table `fs_inv`
--

CREATE TABLE `fs_inv` (
  `EntryID` int(11) NOT NULL,
  `Quantity` double(15,4) DEFAULT 0.0000,
  `Cost` double(15,4) DEFAULT 0.0000,
  `FinalAmount` double(15,4) DEFAULT 0.0000,
  `AccountingType` varchar(30) DEFAULT '-' COMMENT 'GR = Goods Receive; INV = Invoicing;',
  `EmployeeID` int(11) DEFAULT NULL,
  `xTimestamp` timestamp NULL DEFAULT current_timestamp(),
  `MaterialID` int(11) DEFAULT NULL,
  `ControlNumber` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fs_inv`
--

INSERT INTO `fs_inv` (`EntryID`, `Quantity`, `Cost`, `FinalAmount`, `AccountingType`, `EmployeeID`, `xTimestamp`, `MaterialID`, `ControlNumber`) VALUES
(1, 100.0000, 40.0000, 4000.0000, 'GR', 1, '2021-12-21 07:50:16', 9, 'GR2021122108501'),
(2, 100.0000, 70.0000, 7000.0000, 'GR', 1, '2021-12-21 07:50:37', 10, 'GR2021122108502'),
(3, 80.0000, 30.0000, 2400.0000, 'GR', 1, '2021-12-21 07:50:53', 11, 'GR2021122108503'),
(4, 100.0000, 25.0000, 2500.0000, 'GR', 1, '2021-12-21 07:51:25', 12, 'GR2021122108514'),
(5, 3.0000, 50.0000, 150.0000, 'INV', 1, '2021-12-21 08:19:49', 9, 'INV2021122109195');

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `TempCartID` int(11) NOT NULL,
  `InvoiceNumber` varchar(30) DEFAULT NULL,
  `MaterialID` int(11) DEFAULT NULL,
  `Quantity` double(15,4) DEFAULT 0.0000,
  `Price` double(15,4) DEFAULT 0.0000,
  `FinalAmount` double(15,4) DEFAULT 0.0000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE `tblemployee` (
  `EmployeeID` int(11) NOT NULL,
  `Name` varchar(30) DEFAULT NULL,
  `Middlename` varchar(30) DEFAULT NULL,
  `Lastname` varchar(30) DEFAULT NULL,
  `EmployeeType` varchar(30) DEFAULT NULL,
  `BasePay` double(15,4) DEFAULT 0.0000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`EmployeeID`, `Name`, `Middlename`, `Lastname`, `EmployeeType`, `BasePay`) VALUES
(1, 'Jian Jaico', 'Manoop', 'Cajita', 'Admin', 500.0000);

-- --------------------------------------------------------

--
-- Table structure for table `tblmaterials`
--

CREATE TABLE `tblmaterials` (
  `MaterialID` int(11) NOT NULL,
  `MaterialCode` varchar(30) DEFAULT NULL,
  `MaterialDescription` varchar(100) DEFAULT NULL,
  `price` double(15,4) DEFAULT 0.0000,
  `soh` double(15,4) DEFAULT 0.0000,
  `maxstock` double(15,4) DEFAULT 0.0000,
  `isActive` tinyint(4) DEFAULT 1,
  `tax` double(15,4) DEFAULT 0.0000,
  `MaterialCategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblmaterials`
--

INSERT INTO `tblmaterials` (`MaterialID`, `MaterialCode`, `MaterialDescription`, `price`, `soh`, `maxstock`, `isActive`, `tax`, `MaterialCategoryID`) VALUES
(9, 'Hotdog', 'Hotdog', 45.0000, 97.0000, 100.0000, 1, 5.0000, 1),
(10, 'CheeseBurger', 'Cheese Burger', 80.0000, 100.0000, 100.0000, 1, 5.0000, 1),
(11, 'Fries', 'Fries', 30.0000, 80.0000, 100.0000, 1, 5.0000, 1),
(12, 'Coke', 'Coke', 35.0000, 100.0000, 100.0000, 1, 5.0000, 2),
(13, 'Sprite', 'Sprite', 35.0000, 0.0000, 100.0000, 1, 5.0000, 2),
(14, 'Tea', 'Tea', 20.0000, 0.0000, 100.0000, 1, 5.0000, 2),
(15, 'Chicken-Combo-Meal', 'Chicken Combo Meal', 150.0000, 0.0000, 100.0000, 1, 10.0000, 3),
(16, 'Pork-Combo', 'Pork Comb', 160.0000, 0.0000, 100.0000, 1, 5.0000, 3),
(17, 'Fish-Combo', 'Fish Combo', 180.0000, 0.0000, 100.0000, 1, 10.0000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblmaterials_category`
--

CREATE TABLE `tblmaterials_category` (
  `MaterialCategoryID` int(11) NOT NULL,
  `Description` varchar(30) DEFAULT NULL,
  `isActive` tinyint(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblmaterials_category`
--

INSERT INTO `tblmaterials_category` (`MaterialCategoryID`, `Description`, `isActive`) VALUES
(1, 'Burgers', 1),
(2, 'Beverages', 1),
(3, 'Combo Meals', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmaterials_cuopon`
--

CREATE TABLE `tblmaterials_cuopon` (
  `CuoponID` int(11) NOT NULL,
  `CuoponCode` varchar(30) DEFAULT NULL,
  `Discount` double(15,4) DEFAULT 0.0000,
  `isActive` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblmaterials_cuopon`
--

INSERT INTO `tblmaterials_cuopon` (`CuoponID`, `CuoponCode`, `Discount`, `isActive`) VALUES
(1, 'GO2018', 0.1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmenu`
--

CREATE TABLE `tblmenu` (
  `MenuID` int(11) NOT NULL,
  `Description` varchar(30) DEFAULT NULL,
  `action` varchar(30) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT 1,
  `icon` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblmenu`
--

INSERT INTO `tblmenu` (`MenuID`, `Description`, `action`, `isActive`, `icon`) VALUES
(1, 'Menu', 'load_inventory()', 1, 'inventory'),
(2, 'Order', 'load_pos()', 1, 'point_of_sale');

-- --------------------------------------------------------

--
-- Table structure for table `tbluseraccount`
--

CREATE TABLE `tbluseraccount` (
  `UserID` int(11) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `UserName` varchar(30) DEFAULT NULL,
  `Password` varchar(30) DEFAULT NULL,
  `UserType` varchar(30) DEFAULT 'Regular'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbluseraccount`
--

INSERT INTO `tbluseraccount` (`UserID`, `EmployeeID`, `UserName`, `Password`, `UserType`) VALUES
(1, 1, 'admin', 'admin', 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `_tblpos_detail`
--

CREATE TABLE `_tblpos_detail` (
  `posDetailID` int(11) NOT NULL,
  `ORNumber` varchar(30) DEFAULT NULL,
  `MaterialID` int(11) DEFAULT NULL,
  `Price` double(15,4) DEFAULT 0.0000,
  `Quantity` double(15,4) DEFAULT 0.0000,
  `FinalAmount` double(15,4) DEFAULT 0.0000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_tblpos_detail`
--

INSERT INTO `_tblpos_detail` (`posDetailID`, `ORNumber`, `MaterialID`, `Price`, `Quantity`, `FinalAmount`) VALUES
(1, 'OR20211221091949', 9, 50.0000, 3.0000, 150.0000);

-- --------------------------------------------------------

--
-- Table structure for table `_tblpos_summary`
--

CREATE TABLE `_tblpos_summary` (
  `posID` int(11) NOT NULL,
  `ORNumber` varchar(30) DEFAULT NULL,
  `xTimeStamp` timestamp NULL DEFAULT current_timestamp(),
  `EmployeeID` int(11) DEFAULT NULL,
  `InvoiceNumber` varchar(30) DEFAULT NULL,
  `AmountPaid` double(15,4) DEFAULT 0.0000,
  `AmountChange` double(15,4) DEFAULT 0.0000,
  `Remarks` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_tblpos_summary`
--

INSERT INTO `_tblpos_summary` (`posID`, `ORNumber`, `xTimeStamp`, `EmployeeID`, `InvoiceNumber`, `AmountPaid`, `AmountChange`, `Remarks`) VALUES
(1, 'OR20211221091949', '2021-12-21 08:19:49', 1, 'INV2021122109195', 200.0000, 65.0000, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fs_inv`
--
ALTER TABLE `fs_inv`
  ADD PRIMARY KEY (`EntryID`),
  ADD KEY `fs_inv_FK` (`MaterialID`);

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`TempCartID`),
  ADD KEY `tblcart_FK` (`MaterialID`) USING BTREE;

--
-- Indexes for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `tblmaterials`
--
ALTER TABLE `tblmaterials`
  ADD PRIMARY KEY (`MaterialID`),
  ADD KEY `tblmaterials_FK` (`MaterialCategoryID`);

--
-- Indexes for table `tblmaterials_category`
--
ALTER TABLE `tblmaterials_category`
  ADD PRIMARY KEY (`MaterialCategoryID`);

--
-- Indexes for table `tblmaterials_cuopon`
--
ALTER TABLE `tblmaterials_cuopon`
  ADD PRIMARY KEY (`CuoponID`);

--
-- Indexes for table `tblmenu`
--
ALTER TABLE `tblmenu`
  ADD PRIMARY KEY (`MenuID`);

--
-- Indexes for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `tbluseraccount_un` (`EmployeeID`);

--
-- Indexes for table `_tblpos_detail`
--
ALTER TABLE `_tblpos_detail`
  ADD PRIMARY KEY (`posDetailID`),
  ADD KEY `_tblpos_detail_FK` (`MaterialID`);

--
-- Indexes for table `_tblpos_summary`
--
ALTER TABLE `_tblpos_summary`
  ADD PRIMARY KEY (`posID`),
  ADD UNIQUE KEY `_tblpos_summary_un` (`ORNumber`),
  ADD KEY `_tblpos_summary_FK` (`EmployeeID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fs_inv`
--
ALTER TABLE `fs_inv`
  MODIFY `EntryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `TempCartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblemployee`
--
ALTER TABLE `tblemployee`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblmaterials`
--
ALTER TABLE `tblmaterials`
  MODIFY `MaterialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblmaterials_category`
--
ALTER TABLE `tblmaterials_category`
  MODIFY `MaterialCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblmaterials_cuopon`
--
ALTER TABLE `tblmaterials_cuopon`
  MODIFY `CuoponID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblmenu`
--
ALTER TABLE `tblmenu`
  MODIFY `MenuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `_tblpos_detail`
--
ALTER TABLE `_tblpos_detail`
  MODIFY `posDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `_tblpos_summary`
--
ALTER TABLE `_tblpos_summary`
  MODIFY `posID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fs_inv`
--
ALTER TABLE `fs_inv`
  ADD CONSTRAINT `fs_inv_FK` FOREIGN KEY (`MaterialID`) REFERENCES `tblmaterials` (`MaterialID`) ON UPDATE CASCADE;

--
-- Constraints for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD CONSTRAINT `tblcart_FK` FOREIGN KEY (`MaterialID`) REFERENCES `tblmaterials` (`MaterialID`) ON UPDATE CASCADE;

--
-- Constraints for table `tblmaterials`
--
ALTER TABLE `tblmaterials`
  ADD CONSTRAINT `tblmaterials_FK` FOREIGN KEY (`MaterialCategoryID`) REFERENCES `tblmaterials_category` (`MaterialCategoryID`) ON UPDATE CASCADE;

--
-- Constraints for table `tbluseraccount`
--
ALTER TABLE `tbluseraccount`
  ADD CONSTRAINT `tbluseraccount_FK` FOREIGN KEY (`EmployeeID`) REFERENCES `tblemployee` (`EmployeeID`) ON UPDATE CASCADE;

--
-- Constraints for table `_tblpos_detail`
--
ALTER TABLE `_tblpos_detail`
  ADD CONSTRAINT `_tblpos_detail_FK` FOREIGN KEY (`MaterialID`) REFERENCES `tblmaterials` (`MaterialID`) ON UPDATE CASCADE;

--
-- Constraints for table `_tblpos_summary`
--
ALTER TABLE `_tblpos_summary`
  ADD CONSTRAINT `_tblpos_summary_FK` FOREIGN KEY (`EmployeeID`) REFERENCES `tblemployee` (`EmployeeID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
