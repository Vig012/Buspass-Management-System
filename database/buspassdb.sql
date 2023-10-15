-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 03:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buspassdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 2222222222, 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-04-14 06:44:27'),
(2, 'Admin', 'mahesh', 8197674710, 'maheshr@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2020-04-14 01:14:27');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `ID` int(10) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `CategoryName`, `CreationDate`) VALUES
(8, 'AC Bus', '2021-07-04 14:27:53'),
(9, 'Non AC Bus', '2021-07-04 14:28:32'),
(10, 'Volvo Bus', '2021-07-04 14:28:47'),
(11, 'Delux Bus', '2021-07-04 14:29:01');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontact`
--

CREATE TABLE `tblcontact` (
  `ID` int(10) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `EnquiryDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `IsRead` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcontact`
--

INSERT INTO `tblcontact` (`ID`, `Name`, `Email`, `Message`, `EnquiryDate`, `IsRead`) VALUES
(1, 'Kiran', 'kran@gmail.com', 'cost of volvo place pritampura to dwarka', '2021-07-05 07:26:24', 1),
(2, 'Anuj', 'AKKK@GMAIL.COM', 'This is for testing.', '2021-07-11 08:55:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'About us', '<font color=\"#747474\" face=\"Roboto, sans-serif, arial\"><span style=\"font-size: 13px;\">busssssssssssssssssssssssssssssss</span></font>', NULL, NULL, '2023-05-28 05:00:35'),
(2, 'contactus', 'Contact Us', '                #890 CFG Apartment, Mayur Vihar, Mangalore-India.&nbsp;', 'infotest@gmail.com', 4654789799, '2023-05-28 05:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `tblpass`
--

CREATE TABLE `tblpass` (
  `ID` int(10) NOT NULL,
  `PassNumber` varchar(200) DEFAULT NULL,
  `FullName` varchar(200) DEFAULT NULL,
  `ProfileImage` varchar(200) DEFAULT NULL,
  `ContactNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `IdentityType` varchar(200) DEFAULT NULL,
  `IdentityCardno` varchar(200) DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Source` varchar(200) DEFAULT NULL,
  `Destination` varchar(200) DEFAULT NULL,
  `FromDate` varchar(200) DEFAULT NULL,
  `ToDate` varchar(200) DEFAULT NULL,
  `Cost` decimal(10,0) DEFAULT NULL,
  `Status` varchar(50) NOT NULL DEFAULT 'Pending',
  `Payment` varchar(100) NOT NULL DEFAULT 'Not Done',
  `PasscreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpass`
--

INSERT INTO `tblpass` (`ID`, `PassNumber`, `FullName`, `ProfileImage`, `ContactNumber`, `Email`, `IdentityType`, `IdentityCardno`, `Category`, `Source`, `Destination`, `FromDate`, `ToDate`, `Cost`, `Status`, `Payment`, `PasscreationDate`) VALUES
(3, '884595667', 'Anuj kumar', '779b7513263ef185b6d094af290ef5401625471444.png', 1234567890, 'phpgurukulofficial@Gmail.com', 'Voter Card', '5235252', 'Delux Bus', NULL, NULL, '2020-04-16', '2020-04-19', 600, 'Verified', 'Not Done', '2020-04-16 02:38:27'),
(4, '210712236', 'Abir Singh', 'e76de47f621d84adbab3266e3239baee1625460898.png', 4654646546, 'abir@gmail.com', 'Voter Card', '5646465', 'Non AC Bus', NULL, NULL, '2021-07-05', '2021-07-16', 900, 'Verified', 'Not Done', '2021-07-04 15:01:38'),
(5, '474965545', 'Augustya', '779b7513263ef185b6d094af290ef5401625471444.png', 6546465464, 'aug@gmail.com', 'Student Card', '789456', 'Delux Bus', 'fghdhf', 'vamanjoor', '2021-07-05', '2021-07-31', 1800, 'Verified', 'Not Done', '2021-07-05 07:50:44'),
(6, '681924385', 'Anuj kumar', 'afadf1ddb224aef8a213e08e5cd728c01685021320.jpg', 1234569870, 'ak@test.com', 'Driving License', 'GGGGGGHGH2423423432', 'Delux Bus', 'mangalore', 'bangalore', '2021-07-15', '2021-07-30', 5000, 'Verified', 'Not Done', '2021-07-11 08:53:44'),
(8, '257549999', 'H Vignesh', '41db0da28abd7d262d063a82fab51b491685253631.jpg', 8197674709, 'vigneshdevadiga210@gmail.com', 'PAN Card', '4SO22MC038', 'Non AC Bus', 'kulshekar', 'vamanjoor', '2023-05-25', '2024-05-25', 2000, 'Verified', 'Done', '2023-05-26 15:07:58'),
(9, '244511253', 'Mahesh', 'e73043df64a4af9b4bb1702afafbd9ed1685177104.jpg', 9535648480, 'allok787878@gmail.com', 'PAN Card', '987843099187', 'AC Bus', 'Dharmasthala', 'Mangalore', '2023-05-27', '2024-05-27', 6000, 'Verified', 'Done', '2023-05-27 07:31:43'),
(10, '206926646', 'Deepa', '9beeff1ffa01151b3cb2c342e96025141685174657.jpg', 8722863619, 'xaax77993@gmail.com', 'Voter Card', '4SO22MC038', 'AC Bus', 'Gurupura', 'Vamanjoor', '2023-05-27', '2024-05-27', 3500, 'Verified', 'Done', '2023-05-27 08:03:09'),
(11, '762624458', 'mahesh', 'e73043df64a4af9b4bb1702afafbd9ed1685179423.jpg', 9535648480, 'allok787878@gmail.com', 'Student Card', '78747456', 'Volvo Bus', 'mangalore', 'bangalore', '2023-05-31', '2023-07-29', 5000, 'Verified', 'Done', '2023-05-27 09:23:43'),
(12, '969269836', 'mahesh', '41db0da28abd7d262d063a82fab51b491685181760.jpg', 9535648480, 'allok787878@gmail.com', 'PAN Card', '78747456', 'Delux Bus', 'ddsgsd', 'bangalore', '2023-05-18', '2023-06-10', 5000, 'Verified', 'Done', '2023-05-27 10:02:40'),
(13, '690070748', 'mahesh', 'e73043df64a4af9b4bb1702afafbd9ed1685262855.jpg', 9535648480, 'allok787878@gmail.com', 'Driving License', '78747456', 'Delux Bus', 'mangalore', 'bangalore', '2023-06-05', '2023-07-29', 7899, 'Verified', 'Done', '2023-05-28 08:34:15'),
(14, '270274519', 'etwetw', '9beeff1ffa01151b3cb2c342e96025141685266492.jpg', 9535648480, 'allok787878@gmail.com', 'Adhar Card', '78747456', 'Non AC Bus', 'mangalore', 'bangalore', '2023-05-30', '2023-07-08', NULL, 'Pending', 'Not Done', '2023-05-28 09:34:52'),
(15, '576450642', 'dsv bs', '9beeff1ffa01151b3cb2c342e96025141685266649.jpg', 1234123412, 'allok787878@gmail.com', 'PAN Card', '78747456', 'Volvo Bus', 'mangalore', 'bangalore', '2023-06-10', '2023-06-30', NULL, 'Pending', 'Not Done', '2023-05-28 09:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `UserRegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Email` varchar(100) NOT NULL,
  `MobileNumber` bigint(10) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `UserName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `Name`, `UserRegDate`, `Email`, `MobileNumber`, `Password`, `UserName`) VALUES
(2, 'Vignesh', '2023-05-25 08:35:06', 'vigneshdevadiga012@gmail.com', 8197674710, '202cb962ac59075b964b07152d234b70', 'viggu'),
(3, 'Mahesh', '2023-05-25 16:36:15', 'hemachandra884@gmail.com', 8197674700, '81dc9bdb52d04dc20036dbd8313ed055', 'root'),
(4, 'Vignesh', '2023-05-26 15:06:21', 'vigneshdevadiga210@gmail.com', 8197674709, '81dc9bdb52d04dc20036dbd8313ed055', 'viggu'),
(5, 'Mahesh', '2023-05-27 07:29:14', 'allok787878@gmail.com', 9535648480, '202cb962ac59075b964b07152d234b70', 'mahesh'),
(6, 'mahesh', '2023-05-27 18:46:43', 'allok787878@gmail.com', 1234567890, '698d51a19d8a121ce581499d7b701668', 'mahesha'),
(7, 'mahesh', '2023-05-28 09:07:42', 'allok787878@gmail.com', 1234567890, '81dc9bdb52d04dc20036dbd8313ed055', 'mahes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcontact`
--
ALTER TABLE `tblcontact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpass`
--
ALTER TABLE `tblpass`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblcontact`
--
ALTER TABLE `tblcontact`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpass`
--
ALTER TABLE `tblpass`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
