-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 12:31 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roadwings`
--

-- --------------------------------------------------------

--
-- Table structure for table `carrierpaymentdetail`
--

CREATE TABLE `carrierpaymentdetail` (
  `id` int(11) NOT NULL,
  `truckercost` varchar(200) NOT NULL,
  `truckerpaymentstatus` varchar(200) NOT NULL,
  `shipperpaidamount` varchar(200) NOT NULL,
  `shippperpaymentdate` varchar(200) NOT NULL,
  `companyid` varchar(200) NOT NULL,
  `loadid` varchar(200) NOT NULL,
  `truckerid` varchar(200) NOT NULL,
  `addedby` varchar(200) NOT NULL,
  `createdat` varchar(200) NOT NULL,
  `paymentmode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carrierpaymentdetail`
--

INSERT INTO `carrierpaymentdetail` (`id`, `truckercost`, `truckerpaymentstatus`, `shipperpaidamount`, `shippperpaymentdate`, `companyid`, `loadid`, `truckerid`, `addedby`, `createdat`, `paymentmode`) VALUES
(1, '345', 'Paid', '0', '2024-05-20', '12', '1', '13', '2', '2024-05-02', ''),
(2, '345', 'Due', '0', '2024-05-16', '12', '1', '13', '2', '2024-05-02', '');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `companyname` varchar(200) NOT NULL,
  `contactperson` varchar(200) NOT NULL,
  `emailaddress` varchar(200) NOT NULL,
  `companycontactno` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `zipcode` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `phoneno` varchar(200) NOT NULL,
  `mailingaddress` varchar(200) NOT NULL,
  `accountPayable` varchar(200) NOT NULL,
  `accountPayableEmail` varchar(200) NOT NULL,
  `accountPayableNumber` varchar(200) NOT NULL,
  `creditlimit` varchar(200) NOT NULL,
  `createdby` varchar(200) NOT NULL,
  `createdat` datetime NOT NULL,
  `companystatus` enum('1','2','3','4','5') NOT NULL COMMENT '1 for working \r\n2 for approved\r\n3 for pending\r\n4 for rejected\r\n5 for high risk',
  `is_read` enum('0','1','','') NOT NULL,
  `paymentterm` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `companyname`, `contactperson`, `emailaddress`, `companycontactno`, `address`, `zipcode`, `city`, `state`, `phoneno`, `mailingaddress`, `accountPayable`, `accountPayableEmail`, `accountPayableNumber`, `creditlimit`, `createdby`, `createdat`, `companystatus`, `is_read`, `paymentterm`) VALUES
(2, 'jamwals and jamwals', 'jamwal', 'jamwal@gmail.com', '0000000000', 'jamwal', '0000', 'jamwal', 'jamwal', '08889207955', 'sdfsdfsd', 'test', 'susheel@netedsoftech.com', '0000000000', '1233', '33', '2024-03-29 00:00:00', '1', '1', ''),
(7, 'test', 'test', 'test@gmail.com', '2342423423', 'sdfsdf', 'sfsdfsdf', 'sdfsdf', 'sdfsdf', '2342342344', 'test@gmail.com', 'sdfdfsd', 'test@gmail.com', '234234234234', '1000', '2', '2024-04-01 00:00:00', '3', '1', '40'),
(8, 'ssss', 'asdasd', 'sdfsdfs@gmail.com', '3453534534', 'sdfsdfsd', '43534', 'sdfsfsdfs', 'sdfsdfsdf', '453534535', 'sdfs@gmail.com', 'sdfsdfs', 'sdfsd@gmail.com', 'sdfsdfsdfsd', '1234', '33', '2024-04-02 00:00:00', '1', '1', '1'),
(9, 'sdfsdf', 'jamwal jamwalq', 'susheel@netedsoftech.com', '752898403', 'sdfsdfsd', '2131', 'sdfsdfs', '2342', '', 'sdfsdfsd', 'test', 'susheel@netedsoftech.com', '0000000000', '1233', '2', '2024-04-10 00:00:00', '3', '1', '35'),
(10, 'sdfsdf', 'jamwal jamwalq', 'susheel@netedsoftech.com', '454353453234', 'sdfsdfsd', '2131', 'sdfsdfs', '2342', '', 'sdfsdfsd', 'test', 'susheel@netedsoftech.com', '0000000000', '1233', '34', '2024-04-10 00:00:00', '3', '1', '45'),
(11, 'demo567789', 'jamwal jamwalq', 'susheel@netedsoftech.com', '752898403', 'sdfsdfsd', '2131', 'sdfsdfs', '2342', '', 'sdfsdfsd', 'test', 'susheel@netedsoftech.com', 'sdfsdf', '2342', '2', '2024-04-11 00:00:00', '2', '1', '35'),
(12, 'sdf', 'jamwal jamwalq', 'susheel@netedsoftech.com', '234234242342', 'sdfsdfsd', '2131', 'sdfsdfs', '2342', '', 'sdfsdfsd', 'test', 'susheel@netedsoftech.com', 'sdfsdf', '2342', '2', '2024-04-11 00:00:00', '3', '1', 'Payment Terms ( 1 - 50 days)'),
(13, 'sdf', 'jamwal jamwalq', 'susheel@netedsoftech.com', '234234242342', 'sdfsdfsd', '2131', 'sdfsdfs', '2342', '', 'sdfsdfsd', 'test', 'susheel@netedsoftech.com', 'sdfsdf', '2342', '2', '2024-04-11 00:00:00', '3', '1', '30'),
(14, 'sdf', 'jamwal jamwalq', 'susheel@netedsoftech.com', '234234242342', 'sdfsdfsd', '2131', 'sdfsdfs', '2342', '', 'sdfsdfsd', 'test', 'susheel@netedsoftech.com', 'sdfsdf', '2342', '2', '2024-04-11 00:00:00', '3', '1', 'Payment Terms ( 1 - 50 days)'),
(15, 'sdf', 'jamwal jamwalq', 'susheel@netedsoftech.com', '234234242342', 'sdfsdfsd', '2131', 'sdfsdfs', '2342', '', 'sdfsdfsd', 'test', 'susheel@netedsoftech.com', 'sdfsdf', '2342', '2', '2024-04-11 00:00:00', '3', '1', 'Payment Terms ( 1 - 50 days)'),
(16, 'sdf', 'jamwal jamwalq', 'susheel@netedsoftech.com', '234234242342', 'sdfsdfsd', '2131', 'sdfsdfs', '2342', '', 'sdfsdfsd', 'test', 'susheel@netedsoftech.com', 'sdfsdf', '2342', '2', '2024-04-11 00:00:00', '3', '1', 'Payment Terms ( 1 - 50 days)'),
(17, 'sdfds', 'sdfdsf', 'sd999999f@gamil.com', '234234234234', 'sdfdsf', 'dfsd', 'sdfs', 'sdfsd', '', 'fdsfsdfsdf', 'sdfsdf', 'sdfsdf', 'sdfsdf', '2342', '2', '2024-04-15 00:00:00', '5', '1', '45');

-- --------------------------------------------------------

--
-- Table structure for table `companypaymentdetail`
--

CREATE TABLE `companypaymentdetail` (
  `id` int(11) NOT NULL,
  `companycost` varchar(200) NOT NULL,
  `companypaidamount` varchar(200) NOT NULL,
  `companypaymentstatus` enum('0','1','','') NOT NULL,
  `companypaymentdate` varchar(200) NOT NULL,
  `companyid` varchar(200) NOT NULL,
  `loadid` varchar(200) NOT NULL,
  `truckerid` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `livefeed`
--

CREATE TABLE `livefeed` (
  `id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `addeddate` datetime NOT NULL,
  `addedby` varchar(200) NOT NULL,
  `isread` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loadinfo`
--

CREATE TABLE `loadinfo` (
  `id` int(11) NOT NULL,
  `locationfrom` varchar(200) NOT NULL,
  `locationto` varchar(200) NOT NULL,
  `startdate` varchar(200) NOT NULL,
  `deliverydate` varchar(200) NOT NULL,
  `trucktype` varchar(200) NOT NULL,
  `length` varchar(200) NOT NULL,
  `weight` varchar(200) NOT NULL,
  `commodity` varchar(200) NOT NULL,
  `customerrate` varchar(200) NOT NULL,
  `carrierrate` varchar(200) NOT NULL,
  `notes` varchar(200) NOT NULL,
  `addeddate` datetime NOT NULL,
  `addedby` varchar(200) NOT NULL,
  `updatedat` varchar(200) DEFAULT NULL,
  `companyid` varchar(200) NOT NULL,
  `companyname` varchar(200) NOT NULL,
  `truckerNo` varchar(200) DEFAULT NULL,
  `truckerEmail` varchar(200) DEFAULT NULL,
  `truckerAddress` text DEFAULT NULL,
  `trucksubcategorytype` varchar(200) DEFAULT NULL,
  `truckerid` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `carrierinvoiceno` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loadinfo`
--

INSERT INTO `loadinfo` (`id`, `locationfrom`, `locationto`, `startdate`, `deliverydate`, `trucktype`, `length`, `weight`, `commodity`, `customerrate`, `carrierrate`, `notes`, `addeddate`, `addedby`, `updatedat`, `companyid`, `companyname`, `truckerNo`, `truckerEmail`, `truckerAddress`, `trucksubcategorytype`, `truckerid`, `status`, `carrierinvoiceno`) VALUES
(1, 'chd', 'bombay', '2024-05-29', '2024-05-30', 'Flatbed 53', '343', 'sdf', '452342', '234324234', '345', 'sdfsdf', '2024-05-01 00:00:00', '2', NULL, '12', '', '234242342433', 'test@gmail.com', 'sdfsdfsdfsfsd', '13', '13', '0', 'RWL261');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `createdat` datetime NOT NULL,
  `agentname` varchar(200) DEFAULT NULL,
  `agentphoneno` varchar(200) DEFAULT NULL,
  `agentrole` varchar(200) DEFAULT NULL,
  `department` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `createdat`, `agentname`, `agentphoneno`, `agentrole`, `department`) VALUES
(2, 'susheel@netedsoftech.com', '$2y$10$tfFH.iclD4UJzBJGGa2vI.8GDDclZItH1/FE9VXWdV4DRoqDp7lA.', '2024-03-06 10:27:30', 'susheel', '1234567890', 'Admin', NULL),
(32, 'manju@netedsoftech.com', '$2y$10$S/IxfCCjm61LD8wvPgcnTul5XZLmDO4ISdeJRVYoOpc..6BpBRNJ.', '2024-03-28 00:00:00', 'manju negi', '7528980000', 'MANAGER', 'ACCOUNTS'),
(33, 'sarita@netedsoftech.com', '$2y$10$S/IxfCCjm61LD8wvPgcnTul5XZLmDO4ISdeJRVYoOpc..6BpBRNJ.', '2024-03-28 00:00:00', 'sarita', '2323232323', 'COORDINATOR', 'CMT PROFILE'),
(34, 'test@netedsoftech.com', '$2y$10$S/IxfCCjm61LD8wvPgcnTul5XZLmDO4ISdeJRVYoOpc..6BpBRNJ.', '2024-04-10 00:00:00', 'test123', '752898403', 'COORDINATOR', 'CUSTOMER SUPPORT');

-- --------------------------------------------------------

--
-- Table structure for table `truckerdata`
--

CREATE TABLE `truckerdata` (
  `createdby` varchar(200) NOT NULL,
  `id` int(11) NOT NULL,
  `tname` varchar(200) NOT NULL,
  `taddress` text NOT NULL,
  `temail` varchar(200) NOT NULL,
  `tphoneno` varchar(200) NOT NULL,
  `tmcno` varchar(200) NOT NULL,
  `tcarrierrate` varchar(200) NOT NULL,
  `createdat` datetime NOT NULL,
  `isread` enum('0','1') NOT NULL,
  `carrierpaymentterm` varchar(200) DEFAULT NULL,
  `lane` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `truckerdata`
--

INSERT INTO `truckerdata` (`createdby`, `id`, `tname`, `taddress`, `temail`, `tphoneno`, `tmcno`, `tcarrierrate`, `createdat`, `isread`, `carrierpaymentterm`, `lane`) VALUES
('2', 4, 'sdfsdf', '345345345', 'sus123hel@gmail.com', 'sdfsdf', '1234', '25/h', '2024-04-12 00:00:00', '1', NULL, 'jaipur'),
('2', 5, 'xcv', 'sdfsdfsdf', 'sdfsd@gmail.com', '345435345', '2342342', '12', '2024-04-15 00:00:00', '1', NULL, 'dehradoon'),
('2', 6, 'jamwal', 'sdfsdfsdf', 'jamwal@gmail.com', '3242342344', '123213sds', '123', '2024-04-15 00:00:00', '1', '25', 'delhi'),
('2', 7, 'sdf', 'sdfsdf', 'sdfsdf@gmail.com', 'sdf', '423432sdfds', '32423', '2024-04-15 00:00:00', '1', NULL, NULL),
('2', 8, 'sdf', '2324xvxcv', 's@gmail.com', '43353453', '234234', '', '2024-04-16 00:00:00', '1', '40', NULL),
('2', 9, 'ttt', 'mohail chadigarh', 'testtesting@gmail.com', 'ewrwerwrewr', '123ert', '', '2024-04-16 00:00:00', '1', '40', 'himchal to usa'),
('2', 10, 'dd', 'sdfs', 'dd@gmail.com', '45345345', '3453dsfsd', '', '2024-04-16 00:00:00', '1', '40', 'dfsdfs'),
('2', 11, 'jj', 'sdfsd', 'jj@gmail.com', '567567', '345dsf', '', '2024-04-16 00:00:00', '1', '40', 'ffsdfs'),
('2', 12, 'jj23', 'sdfsd', 'j222j@gmail.com', '56756722', '7072', '', '2024-04-16 00:00:00', '1', 'Payment Terms ( 1 - 50 days)', 'ffsdfs'),
('34', 13, 'test123', 'sdfsdfsdfsfsd', 'test@gmail.com', '234242342433', 'werwe3432', '', '2024-04-16 00:00:00', '1', '50', 'sdfsdf'),
('2', 14, 'rohit kumar', 'mohali phase-7', 'rohitkumar@gmail.com', '123654789520', '123600', '', '2024-04-17 00:00:00', '1', '45', 'mohali phase-7 to palampur-jaisinghpur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrierpaymentdetail`
--
ALTER TABLE `carrierpaymentdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companypaymentdetail`
--
ALTER TABLE `companypaymentdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livefeed`
--
ALTER TABLE `livefeed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loadinfo`
--
ALTER TABLE `loadinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `truckerdata`
--
ALTER TABLE `truckerdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrierpaymentdetail`
--
ALTER TABLE `carrierpaymentdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `companypaymentdetail`
--
ALTER TABLE `companypaymentdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `livefeed`
--
ALTER TABLE `livefeed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loadinfo`
--
ALTER TABLE `loadinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `truckerdata`
--
ALTER TABLE `truckerdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
