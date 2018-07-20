-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2018 at 03:10 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `ORNumber` int(11) NOT NULL,
  `checkInId` int(11) NOT NULL,
  `collection` float NOT NULL,
  `date_collected` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`ORNumber`, `checkInId`, `collection`, `date_collected`) VALUES
(1000002, 3, 0, '2018-07-19 14:21:20'),
(1000003, 4, 0, '2018-07-19 14:21:20'),
(1000004, 5, 0, '2018-07-19 14:21:20'),
(1000005, 6, 0, '2018-07-19 14:21:20'),
(1000006, 7, 1823, '2018-07-19 14:27:27'),
(1000007, 8, 0, '2018-07-19 14:28:43'),
(1000008, 9, 350, '2018-07-19 14:29:57'),
(1000009, 10, 2735, '2018-07-19 17:04:19'),
(1000010, 11, 2444, '2018-07-19 16:41:34'),
(1000011, 12, 1355, '2018-07-19 20:49:02'),
(1000012, 13, 3002, '0000-00-00 00:00:00'),
(1000013, 14, 2195, '0000-00-00 00:00:00'),
(1000014, 15, 5555, '2018-07-19 20:56:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`ORNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `ORNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000015;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
