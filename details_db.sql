-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2022 at 05:22 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `details_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_ID` int(255) NOT NULL,
  `Name` varchar(1000) NOT NULL,
  `User_Name` varchar(50) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Last_Login` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin_telephone`
--

CREATE TABLE `admin_telephone` (
  `Telephone_Number` int(255) NOT NULL,
  `Admin_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(255) NOT NULL,
  `Category_Name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `Item_ID` int(255) NOT NULL,
  `Item_Title` varchar(1000) NOT NULL,
  `Description` varchar(5000) NOT NULL,
  `Post_Date` date NOT NULL,
  `Expire_Date` date NOT NULL,
  `Category_ID` int(255) NOT NULL,
  `User_ID` int(255) NOT NULL,
  `Admin_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `Membership_ID` int(255) NOT NULL,
  `Fee` int(255) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Payment_ID` int(255) NOT NULL,
  `User_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `Offer_ID` int(255) NOT NULL,
  `Offer_Name` varchar(1000) NOT NULL,
  `Expire_Date` date NOT NULL,
  `Discount_Type` varchar(1000) NOT NULL,
  `Discount_Amount` int(100) NOT NULL,
  `Item_ID` int(255) NOT NULL,
  `User_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(255) NOT NULL,
  `Payment_Type` varchar(1000) NOT NULL,
  `Amount` int(255) NOT NULL,
  `Payment_Description` varchar(1000) NOT NULL,
  `Payment_Reference` varchar(1000) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Admin_ID` int(255) NOT NULL,
  `User_ID` int(255) NOT NULL,
  `Membership_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `privilage_ details`
--

CREATE TABLE `privilage_ details` (
  `Privilage_ID` int(255) NOT NULL,
  `Privilage_Name` varchar(1000) NOT NULL,
  `Admin_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `telephone`
--

CREATE TABLE `telephone` (
  `Telephone_Number` int(10) NOT NULL,
  `User_ID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(100) NOT NULL,
  `First_Name` varchar(1000) NOT NULL,
  `Last_Name` varchar(1000) NOT NULL,
  `User_Name` varchar(50) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `NIC` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Postal_Code` int(20) NOT NULL,
  `House` varchar(300) NOT NULL,
  `Street` varchar(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Province` varchar(200) NOT NULL,
  `Country` varchar(200) NOT NULL,
  `Last_Login` datetime NOT NULL DEFAULT current_timestamp(),
  `Type` varchar(100) NOT NULL,
  `Current_Location` varchar(1000) NOT NULL,
  `Permanant_Location` varchar(1000) NOT NULL,
  `Location_Permission` varchar(100) NOT NULL,
  `Promotion_Programme_Permission` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`),
  ADD UNIQUE KEY `User_Name` (`User_Name`),
  ADD UNIQUE KEY `Password` (`Password`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `admin_telephone`
--
ALTER TABLE `admin_telephone`
  ADD PRIMARY KEY (`Telephone_Number`),
  ADD KEY `ad` (`Admin_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `category` (`Category_ID`),
  ADD KEY `use` (`User_ID`),
  ADD KEY `adid` (`Admin_ID`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`Membership_ID`),
  ADD KEY `PID` (`Payment_ID`),
  ADD KEY `USEID` (`User_ID`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`Offer_ID`),
  ADD KEY `items` (`Item_ID`),
  ADD KEY `us` (`User_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `AID` (`Admin_ID`),
  ADD KEY `UID` (`User_ID`),
  ADD KEY `mid` (`Membership_ID`);

--
-- Indexes for table `privilage_ details`
--
ALTER TABLE `privilage_ details`
  ADD PRIMARY KEY (`Privilage_ID`);

--
-- Indexes for table `telephone`
--
ALTER TABLE `telephone`
  ADD PRIMARY KEY (`Telephone_Number`),
  ADD KEY `USID` (`User_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `User_Name` (`User_Name`),
  ADD UNIQUE KEY `Password` (`Password`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `NIC` (`NIC`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_telephone`
--
ALTER TABLE `admin_telephone`
  ADD CONSTRAINT `ad` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `adid` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`),
  ADD CONSTRAINT `category` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`Category_ID`),
  ADD CONSTRAINT `use` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `PID` FOREIGN KEY (`Payment_ID`) REFERENCES `payment` (`Payment_ID`),
  ADD CONSTRAINT `USEID` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);

--
-- Constraints for table `offer`
--
ALTER TABLE `offer`
  ADD CONSTRAINT `items` FOREIGN KEY (`Item_ID`) REFERENCES `item` (`Item_ID`),
  ADD CONSTRAINT `us` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON UPDATE NO ACTION;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `AID` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`Admin_ID`),
  ADD CONSTRAINT `UID` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`),
  ADD CONSTRAINT `mid` FOREIGN KEY (`Membership_ID`) REFERENCES `membership` (`Membership_ID`);

--
-- Constraints for table `telephone`
--
ALTER TABLE `telephone`
  ADD CONSTRAINT `USID` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
