-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2018 at 04:38 AM
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
(1, 1, 4, 2),
(2, 2, 1, 2),
(3, 2, 2, 2);

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
(1, 1, 7, 4),
(2, 1, 12, 2),
(3, 2, 8, 4),
(4, 2, 1, 2);

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
(1, 1, 0, '0000-00-00 00:00:00'),
(2, 2, 0, '0000-00-00 00:00:00');

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
(1, '1', 1, '2018-07-31 02:21:52', '2018-08-05 23:59:59', 2, 3),
(2, '6', 2, '2018-07-31 02:24:27', '2018-08-24 23:59:59', 2, 4);

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
  `childrenCount` int(11) NOT NULL,
  `noOfDays` int(11) NOT NULL,
  `penaltyHours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
,`noOfDays` int(11)
,`penaltyHours` int(11)
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
(1, 'ToothBrush', 50),
(2, 'Pillow', 200),
(3, 'Bed', 500),
(4, 'Blanket', 100),
(5, 'Pillow Case', 20);

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
(1, 'Adobo', 20, 18, 1000, 150, 'Available'),
(7, 'Sinigang', 25, 21, 2500, 150, 'Available'),
(8, 'Ice Tea', 500, 496, 25, 50, 'Available'),
(9, 'Nilaga', 25, 25, 2200, 140, 'Available'),
(12, 'Hotdog', 100, 98, 25, 30, 'Available');

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
,`isCheckIn` bit(1)
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
  `companyAddress` varchar(255) NOT NULL,
  `isCheckIn` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `name`, `mobile`, `companyName`, `companyAddress`, `isCheckIn`) VALUES
(1, 'Mark Joseph Castelo', '0192301924', '', '', b'1'),
(2, 'Abigail Mariano', '31231', '', '', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `loginnames`
--

CREATE TABLE `loginnames` (
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `accountType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginnames`
--

INSERT INTO `loginnames` (`username`, `password`, `accountType`) VALUES
('abi', 'admin', 'user'),
('Joseph', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `rate_history`
--

CREATE TABLE `rate_history` (
  `refno` int(11) NOT NULL,
  `rate` double DEFAULT NULL,
  `rateperhour` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rate_history`
--

INSERT INTO `rate_history` (`refno`, `rate`, `rateperhour`) VALUES
(1, 1000, 100),
(2, 2000, 200),
(3, 3000, 300),
(4, 4000, 400),
(5, 5000, 500),
(6, 5005, 505);

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
  `reservationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservationId`, `personal_id`, `personal_id_type`, `roomNo`, `name`, `mobile`, `compName`, `compAddress`, `checkInDate`, `checkOutDate`, `adultsCount`, `childrensCount`, `reservationDate`, `status`) VALUES
(1, '1231444', 'Drivers_License', '4', 'bbcnovaliches.org', '131231', 'bbcnovaliches.org', 'bbcnovaliches.org', '2018-08-03', '2018-08-15', 3, 2, '2018-07-31 02:26:13', 'Pending'),
(2, '312313', 'Philhealt', '7', 'admin', '0192301924', '', '', '2018-08-01', '2018-08-09', 2, 1, '2018-07-31 02:26:40', 'Pending');

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
,`checkInId` int(11)
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
(1, '1', 'Aircon', 3),
(2, '6', 'Television', 1),
(3, '6', 'Beds', 3),
(4, '10', 'Remote Control', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `roomNo` int(11) NOT NULL,
  `roomType` int(11) NOT NULL,
  `floor` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Vacant',
  `createdDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomNo`, `roomType`, `floor`, `status`, `createdDate`) VALUES
(1, 1, '1', 'Occupied', '2018-07-26 08:00:02'),
(2, 4, '1', 'Maintenance', '2018-07-26 08:00:18'),
(3, 1, '1', 'Vacant', '2018-07-26 08:00:29'),
(4, 1, '1', 'Cleaning', '2018-07-26 08:00:38'),
(5, 2, '1', 'Vacant', '2018-07-26 08:00:52'),
(6, 5, '1', 'Occupied', '2018-07-26 08:01:07'),
(7, 4, '1', 'Cleaning', '2018-07-26 09:35:48'),
(8, 4, '1', 'Vacant', '2018-07-31 02:47:57'),
(9, 1, '1', 'Cleaning', '2018-07-31 02:48:08'),
(10, 2, '1', 'Vacant', '2018-07-31 02:48:21'),
(11, 5, '1', 'Cleaning', '2018-07-31 02:48:34'),
(12, 5, '1', 'Maintenance', '2018-07-31 02:48:47'),
(13, 5, '3', 'Maintenance', '2018-07-31 06:22:07'),
(14, 2, '2', 'Cleaning', '2018-07-31 16:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `roomtypes`
--

CREATE TABLE `roomtypes` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `maxAdult` int(11) NOT NULL DEFAULT '0',
  `maxChildren` int(11) NOT NULL DEFAULT '0',
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rate` double NOT NULL,
  `rateperhour` double DEFAULT NULL,
  `raterefno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtypes`
--

INSERT INTO `roomtypes` (`id`, `type`, `maxAdult`, `maxChildren`, `dateCreated`, `rate`, `rateperhour`, `raterefno`) VALUES
(1, 'Single', 1, 1, '2018-08-07 04:56:19', 1000, 100, 1),
(2, 'Double', 2, 2, '2018-08-07 04:56:30', 2000, 200, 2),
(3, 'Triple', 3, 3, '2018-08-07 04:56:39', 3000, 300, 3),
(4, 'Double Deluxe', 4, 4, '2018-08-07 04:56:57', 4000, 400, 4),
(5, 'Family', 5, 5, '2018-08-07 04:59:56', 5005, 505, 6);

-- --------------------------------------------------------

--
-- Structure for view `checkindetails`
--
DROP TABLE IF EXISTS `checkindetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `checkindetails`  AS  select `a`.`id` AS `checkInId`,`a`.`roomNo` AS `roomNo`,`a`.`checkIn` AS `checkIn`,`a`.`checkOutDate` AS `checkOutDate`,`a`.`adultsCount` AS `adultsCount`,`a`.`childrenCount` AS `childrenCount`,`b`.`floor` AS `floor`,`c`.`type` AS `type`,`c`.`rate` AS `rate`,`c`.`rateperhour` AS `rateperhour`,`d`.`id` AS `guestId`,`d`.`name` AS `name`,`d`.`mobile` AS `mobile`,`d`.`companyName` AS `companyName`,`d`.`companyAddress` AS `companyAddress` from (((`checkin` `a` join `rooms` `b` on((`a`.`roomNo` = `b`.`roomNo`))) join `roomtypes` `c` on((`b`.`roomType` = `c`.`id`))) join `guests` `d` on((`a`.`guestId` = `d`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `checkoutdetails`
--
DROP TABLE IF EXISTS `checkoutdetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `checkoutdetails`  AS  select `a`.`id` AS `checkInId`,`a`.`roomNo` AS `roomNo`,`a`.`checkIn` AS `checkIn`,`a`.`checkOutDate` AS `checkOutDate`,`a`.`adultsCount` AS `adultsCount`,`a`.`childrenCount` AS `childrenCount`,`b`.`floor` AS `floor`,`c`.`type` AS `type`,`e`.`rate` AS `rate`,`e`.`rateperhour` AS `rateperhour`,`d`.`id` AS `guestId`,`d`.`name` AS `name`,`d`.`mobile` AS `mobile`,`d`.`companyName` AS `companyName`,`d`.`companyAddress` AS `companyAddress`,`a`.`noOfDays` AS `noOfDays`,`a`.`penaltyHours` AS `penaltyHours` from ((((`checkout` `a` join `rooms` `b` on((`a`.`roomNo` = `b`.`roomNo`))) join `roomtypes` `c` on((`b`.`roomType` = `c`.`id`))) join `guests` `d` on((`a`.`guestId` = `d`.`id`))) join `rate_history` `e` on((`c`.`raterefno` = `e`.`refno`))) ;

-- --------------------------------------------------------

--
-- Structure for view `guestdetails`
--
DROP TABLE IF EXISTS `guestdetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `guestdetails`  AS  select `a`.`id` AS `id`,`a`.`name` AS `name`,`a`.`mobile` AS `mobile`,`a`.`companyName` AS `companyName`,`a`.`companyAddress` AS `companyAddress`,`b`.`roomNo` AS `roomNo`,`c`.`floor` AS `floor`,`b`.`checkIn` AS `checkin`,`b`.`checkOutDate` AS `checkOutDate`,`a`.`isCheckIn` AS `isCheckIn` from ((`guests` `a` join `checkin` `b` on((`a`.`id` = `b`.`guestId`))) join `rooms` `c` on((`b`.`roomNo` = `c`.`roomNo`))) ;

-- --------------------------------------------------------

--
-- Structure for view `roomdetails`
--
DROP TABLE IF EXISTS `roomdetails`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `roomdetails`  AS  select `a`.`roomNo` AS `roomNo`,`a`.`floor` AS `floor`,`a`.`status` AS `status`,`b`.`type` AS `type`,`b`.`id` AS `typeid`,`b`.`rate` AS `rate`,`b`.`rateperhour` AS `rateperhour`,`c`.`checkOutDate` AS `checkOutDate`,`c`.`checkIn` AS `checkIn`,`a`.`createdDate` AS `createdDate`,`c`.`id` AS `checkInId` from ((`rooms` `a` join `roomtypes` `b` on((`a`.`roomType` = `b`.`id`))) left join `checkin` `c` on((`a`.`roomNo` = `c`.`roomNo`))) ;

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
-- Indexes for table `rate_history`
--
ALTER TABLE `rate_history`
  ADD KEY `refno` (`refno`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `addedfoods`
--
ALTER TABLE `addedfoods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `ORNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `checkin`
--
ALTER TABLE `checkin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rate_history`
--
ALTER TABLE `rate_history`
  MODIFY `refno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
