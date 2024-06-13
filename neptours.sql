-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2024 at 02:28 PM
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
-- Database: `neptour`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `admin_name`, `admin_email`, `admin_password`) VALUES
(7, 'Gobinda', 'asd@gmail.com', '$2y$10$eZO.ykx1NA6Gz7f35eMgzO8h0/fgDrjz8AGvIIEkaf4ELSCiBcLyy');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `num_people` varchar(255) NOT NULL,
  `packageAvailable_id` int(11) DEFAULT NULL,
  `package_cost` varchar(255) NOT NULL,
  `booking_status` enum('Pending','Confirmed','Cancelled','Completed') DEFAULT 'Pending',
  `bookingVerifyBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packageavailable`
--

CREATE TABLE `packageavailable` (
  `packageAvailable_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `pavailable_time` date NOT NULL,
  `pAvailableCreator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `package_title` varchar(255) NOT NULL,
  `package_image` varchar(255) DEFAULT NULL,
  `package_description` varchar(255) DEFAULT NULL,
  `package_duration` varchar(255) DEFAULT NULL,
  `package_creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `package_title`, `package_image`, `package_description`, `package_duration`, `package_creator`) VALUES
(12, 'gosaikunda', 'dsa', 'sd', 'sd', 1),
(13, 'abc', 'aewrewr', 'qwqwf', 'wqeq', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `user_phone`, `user_email`, `user_password`) VALUES
(1, 'apple', '650650650', 'asd@gmail.com', '123'),
(2, 'mango', '12312312', 'qwe@gmail.com', '123'),
(3, 'banana', '123123', 'zxc@gmail.com', '$2y$10$3lMw2p4bsOpMtdF6ApBD..NLSEw/LZtzGefg6G4aBt3VK/4voidfC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_package_id` (`package_id`),
  ADD KEY `idx_packageAvailable_id` (`packageAvailable_id`),
  ADD KEY `idx_bookingVerifyBy` (`bookingVerifyBy`);

--
-- Indexes for table `packageavailable`
--
ALTER TABLE `packageavailable`
  ADD PRIMARY KEY (`packageAvailable_id`),
  ADD KEY `pAvailableCreator_fk` (`package_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `package_creator` (`package_creator`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `packageavailable`
--
ALTER TABLE `packageavailable`
  MODIFY `packageAvailable_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`packageAvailable_id`) REFERENCES `packageavailable` (`packageAvailable_id`),
  ADD CONSTRAINT `bookings_ibfk_4` FOREIGN KEY (`bookingVerifyBy`) REFERENCES `admin` (`adminID`);

--
-- Constraints for table `packageavailable`
--
ALTER TABLE `packageavailable`
  ADD CONSTRAINT `pAvailableCreator_fk` FOREIGN KEY (`package_id`) REFERENCES `admin` (`adminID`),
  ADD CONSTRAINT `packageavailable_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`package_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
