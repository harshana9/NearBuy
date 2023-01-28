-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2023 at 07:54 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
