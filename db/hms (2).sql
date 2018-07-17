-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2018 at 06:31 AM
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
-- Table structure for table `addedextras`
--

CREATE TABLE `addedextras` (
  `id` int(11) NOT NULL,
  `checkinId` int(11) NOT NULL,
  `extrasId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addedextras`
--

INSERT INTO `addedextras` (`id`, `checkinId`, `extrasId`, `quantity`) VALUES
(1, 1, 2, 2),
(2, 1, 6, 1),
(3, 1, 4, 1),
(4, 2, 4, 1),
(5, 3, 1, 1),
(6, 4, 4, 1),
(7, 4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `addedfoods`
--

CREATE TABLE `addedfoods` (
  `id` int(11) NOT NULL,
  `checkinId` int(11) NOT NULL,
  `foodsId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addedfoods`
--

INSERT INTO `addedfoods` (`id`, `checkinId`, `foodsId`, `quantity`) VALUES
(1, 1, 8, 20),
(2, 1, 10, 4),
(3, 1, 10, 4),
(4, 1, 10, 4),
(5, 1, 10, 4),
(6, 1, 10, 4),
(7, 1, 7, 4),
(8, 1, 7, 1),
(9, 1, 8, 4),
(10, 3, 7, 3),
(11, 4, 1, 1),
(12, 4, 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `ORNumber` int(11) NOT NULL,
  `checkInId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`ORNumber`, `checkInId`) VALUES
(1000001, 1),
(1000002, 1),
(1000003, 2),
(1000004, 3),
(1000005, 4);

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

CREATE TABLE `checkin` (
  `id` int(11) NOT NULL,
  `roomNo` varchar(50) NOT NULL,
  `guestId` int(11) NOT NULL,
  `checkIn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checkOutDate` datetime NOT NULL,
  `adultsCount` int(11) NOT NULL,
  `childrenCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`id`, `roomNo`, `guestId`, `checkIn`, `checkOutDate`, `adultsCount`, `childrenCount`) VALUES
(4, '2', 14, '2018-07-14 04:51:36', '2018-07-17 12:51:36', 3, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `checkindetails`
-- (See below for the actual view)
--
CREATE TABLE `checkindetails` (
`checkInId` int(11)
,`roomNo` varchar(50)
,`checkIn` timestamp
,`checkOutDate` datetime
,`adultsCount` int(11)
,`childrenCount` int(11)
,`floor` varchar(50)
,`type` varchar(100)
,`rate` double
,`rateperhour` double
,`guestId` int(11)
,`name` varchar(100)
,`mobile` varchar(50)
,`companyName` varchar(255)
,`companyAddress` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `roomNo` varchar(50) NOT NULL,
  `guestId` int(11) NOT NULL,
  `checkIn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `checkOutDate` datetime NOT NULL,
  `adultsCount` int(11) NOT NULL,
  `childrenCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `roomNo`, `guestId`, `checkIn`, `checkOutDate`, `adultsCount`, `childrenCount`) VALUES
(1, '1', 10, '2018-07-11 04:40:07', '2018-07-13 12:40:07', 4, 5),
(2, '4', 12, '2018-07-13 09:59:13', '2018-07-18 17:59:13', 3, 4),
(3, '5', 13, '2018-07-13 10:00:02', '2018-07-27 18:00:02', 2, 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `checkoutdetails`
-- (See below for the actual view)
--
CREATE TABLE `checkoutdetails` (
`checkInId` int(11)
,`roomNo` varchar(50)
,`checkIn` timestamp
,`checkOutDate` datetime
,`adultsCount` int(11)
,`childrenCount` int(11)
,`floor` varchar(50)
,`type` varchar(100)
,`rate` double
,`rateperhour` double
,`guestId` int(11)
,`name` varchar(100)
,`mobile` varchar(50)
,`companyName` varchar(255)
,`companyAddress` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE `extras` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extras`
--

INSERT INTO `extras` (`id`, `description`, `cost`) VALUES
(1, 'Bed', 500),
(2, 'Toothbrush', 50),
(3, 'Pillow', 100),
(4, 'Parking', 500),
(6, 'Aircon', 500);

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `menuName` varchar(250) NOT NULL,
  `servings` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `cost` double NOT NULL,
  `sellingPrice` double NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `menuName`, `servings`, `remaining`, `cost`, `sellingPrice`, `status`) VALUES
(1, 'Adobo', 10, 1, 1000, 150, 'Available'),
(7, 'Sinigang', 25, 9, 2500, 150, 'Available'),
(8, 'Ice Tea', 500, 456, 25, 50, 'Available'),
(9, 'Nilaga', 25, 17, 2200, 140, 'Available'),
(10, 'Hotdog', 100, 70, 10, 25, 'Available');

-- --------------------------------------------------------

--
-- Stand-in structure for view `guestdetails`
-- (See below for the actual view)
--
CREATE TABLE `guestdetails` (
`id` int(11)
,`name` varchar(100)
,`mobile` varchar(50)
,`companyName` varchar(255)
,`companyAddress` varchar(255)
,`roomNo` varchar(50)
,`floor` varchar(50)
,`checkin` timestamp
,`checkOutDate` datetime
);

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `companyAddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `name`, `mobile`, `companyName`, `companyAddress`) VALUES
(1, 'Mark Joseph R Castelo', '09752916102', '', ''),
(2, 'Administrator', '09752916102', '', ''),
(3, 'Mark Joseph Castelo', '09752916102', '', ''),
(4, 'Mark Joseph Castelo', '0192301924', '', ''),
(5, 'Mark Joseph Castelo', '0192301924', '', ''),
(6, 'Mark Joseph Castelo', '0192301924', '', ''),
(7, 'Mark Joseph Castelo', '0192301924', '', ''),
(8, 'Mark Joseph Castelo', '0192301924', '', ''),
(9, 'Mark Joseph Castelo', '0192301924', '', ''),
(10, 'Mark Joseph Castelo', '0192301924', '', ''),
(11, 'Abigail Mariano', '09153960030', 'zyxx', 'ortigas quezon city'),
(12, 'admin', '0192301924', '', ''),
(13, 'Abigail Mariano', '123124', '', ''),
(14, 'Testing testing', '1312314', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `loginnames`
--

CREATE TABLE `loginnames` (
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `accountType` varchar(20) NOT NULL,
  `onhold` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginnames`
--

INSERT INTO `loginnames` (`username`, `password`, `accountType`, `onhold`) VALUES
('abi', 'admin', 'user', b'0'),
('Joseph', 'admin', 'admin', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservationId` int(11) NOT NULL,
  `personal_id` varchar(255) NOT NULL,
  `personal_id_type` varchar(255) NOT NULL,
  `roomNo` varchar(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `compName` varchar(255) NOT NULL,
  `compAddress` varchar(255) NOT NULL,
  `checkInDate` date NOT NULL,
  `checkOutDate` date NOT NULL,
  `adultsCount` int(11) NOT NULL,
  `childrensCount` int(11) NOT NULL,
  `reservationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `roomdetails`
-- (See below for the actual view)
--
CREATE TABLE `roomdetails` (
`roomNo` int(11)
,`floor` varchar(50)
,`status` varchar(50)
,`type` varchar(100)
,`typeid` int(11)
,`rate` double
,`rateperhour` double
,`checkOutDate` datetime
,`checkIn` timestamp
,`createdDate` timestamp
);

-- --------------------------------------------------------

--
-- Table structure for table `roominventory`
--

CREATE TABLE `roominventory` (
  `id` int(11) NOT NULL,
  `roomNo` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roominventory`
--

INSERT INTO `roominventory` (`id`, `roomNo`, `description`, `quantity`) VALUES
(1, '1', 'Television', 1),
(2, '1', 'Aircon', 1),
(4, '2', 'Refrigirator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `roomNo` int(11) NOT NULL,
  `roomType` int(11) NOT NULL,
  `floor` varchar(50) NOT NULL,
  `rate` double NOT NULL,
  `rateperhour` double NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Vacant',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomNo`, `roomType`, `floor`, `rate`, `rateperhour`, `status`, `createdDate`) VALUES
(1, 1, '1', 1005, 100, 'Vacant', '2018-06-29 09:32:30'),
(2, 4, '2', 1500, 322, 'Occupied', '2018-07-03 03:59:02'),
(3, 3, '4', 4444, 44, 'Vacant', '2018-07-03 06:51:04'),
(4, 5, '1', 5555, 323, 'Cleaning', '2018-07-04 06:38:20'),
(5, 2, '1', 2222, 111, 'Cleaning', '2018-06-29 09:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `roomtypes`
--

CREATE TABLE `roomtypes` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `maxAdult` int(11) NOT NULL DEFAULT '0',
  `maxChildren` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtypes`
--

INSERT INTO `roomtypes` (`id`, `type`, `maxAdult`, `maxChildren`) VALUES
(1, 'Single', 1, 0),
(2, 'Double', 2, 0),
(3, 'Family', 4, 4),
(4, 'Deluxe', 5, 5),
(5, 'Double Deluxe', 7, 7);

-- --------------------------------------------------------

--
-- Structure for view `checkindetails`
--
DROP TABLE IF EXISTS `checkindetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `checkindetails`  AS  select `a`.`id` AS `checkInId`,`a`.`roomNo` AS `roomNo`,`a`.`checkIn` AS `checkIn`,`a`.`checkOutDate` AS `checkOutDate`,`a`.`adultsCount` AS `adultsCount`,`a`.`childrenCount` AS `childrenCount`,`b`.`floor` AS `floor`,`c`.`type` AS `type`,`b`.`rate` AS `rate`,`b`.`rateperhour` AS `rateperhour`,`d`.`id` AS `guestId`,`d`.`name` AS `name`,`d`.`mobile` AS `mobile`,`d`.`companyName` AS `companyName`,`d`.`companyAddress` AS `companyAddress` from (((`checkin` `a` join `rooms` `b` on((`a`.`roomNo` = `b`.`roomNo`))) join `roomtypes` `c` on((`b`.`roomType` = `c`.`id`))) join `guests` `d` on((`a`.`guestId` = `d`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `checkoutdetails`
--
DROP TABLE IF EXISTS `checkoutdetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `checkoutdetails`  AS  select `a`.`id` AS `checkInId`,`a`.`roomNo` AS `roomNo`,`a`.`checkIn` AS `checkIn`,`a`.`checkOutDate` AS `checkOutDate`,`a`.`adultsCount` AS `adultsCount`,`a`.`childrenCount` AS `childrenCount`,`b`.`floor` AS `floor`,`c`.`type` AS `type`,`b`.`rate` AS `rate`,`b`.`rateperhour` AS `rateperhour`,`d`.`id` AS `guestId`,`d`.`name` AS `name`,`d`.`mobile` AS `mobile`,`d`.`companyName` AS `companyName`,`d`.`companyAddress` AS `companyAddress` from (((`checkout` `a` join `rooms` `b` on((`a`.`roomNo` = `b`.`roomNo`))) join `roomtypes` `c` on((`b`.`roomType` = `c`.`id`))) join `guests` `d` on((`a`.`guestId` = `d`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `guestdetails`
--
DROP TABLE IF EXISTS `guestdetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `guestdetails`  AS  select `a`.`id` AS `id`,`a`.`name` AS `name`,`a`.`mobile` AS `mobile`,`a`.`companyName` AS `companyName`,`a`.`companyAddress` AS `companyAddress`,`b`.`roomNo` AS `roomNo`,`c`.`floor` AS `floor`,`b`.`checkIn` AS `checkin`,`b`.`checkOutDate` AS `checkOutDate` from ((`guests` `a` join `checkin` `b` on((`a`.`id` = `b`.`guestId`))) join `rooms` `c` on((`b`.`roomNo` = `c`.`roomNo`))) ;

-- --------------------------------------------------------

--
-- Structure for view `roomdetails`
--
DROP TABLE IF EXISTS `roomdetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `roomdetails`  AS  select `a`.`roomNo` AS `roomNo`,`a`.`floor` AS `floor`,`a`.`status` AS `status`,`b`.`type` AS `type`,`b`.`id` AS `typeid`,`a`.`rate` AS `rate`,`a`.`rateperhour` AS `rateperhour`,`c`.`checkOutDate` AS `checkOutDate`,`c`.`checkIn` AS `checkIn`,`a`.`createdDate` AS `createdDate` from ((`rooms` `a` join `roomtypes` `b` on((`a`.`roomType` = `b`.`id`))) left join `checkin` `c` on((`a`.`roomNo` = `c`.`roomNo`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addedextras`
--
ALTER TABLE `addedextras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addedfoods`
--
ALTER TABLE `addedfoods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`ORNumber`);

--
-- Indexes for table `checkin`
--
ALTER TABLE `checkin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loginnames`
--
ALTER TABLE `loginnames`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservationId`);

--
-- Indexes for table `roominventory`
--
ALTER TABLE `roominventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomNo`);

--
-- Indexes for table `roomtypes`
--
ALTER TABLE `roomtypes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addedextras`
--
ALTER TABLE `addedextras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `addedfoods`
--
ALTER TABLE `addedfoods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `ORNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000006;

--
-- AUTO_INCREMENT for table `checkin`
--
ALTER TABLE `checkin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservationId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roominventory`
--
ALTER TABLE `roominventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roomtypes`
--
ALTER TABLE `roomtypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
