-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 08:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neptours`
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
(9, 'Gobinda', 'asd@gmail.com', '$2y$10$kDBi4RSCJrtw2VvAYOMmaeSJkRabj4yslRk/ykWMCfpEzRyNI9ic6');

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

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `package_id`, `num_people`, `packageAvailable_id`, `package_cost`, `booking_status`, `bookingVerifyBy`) VALUES
(14, NULL, NULL, '14', NULL, '28000', 'Pending', NULL);

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
(72, 'asd', '[\"ebc4.jpg\"]', 'asd', '32', 0),
(143, 'ebc', '[\"ebcu.jpg\"]', 'asdasfdszdfdszfzsdfczsdc', '4', 0),
(144, 'annapurna', '[\"ebc3.jpg\"]', 'fdgxdfgdfsgsdfgsdfg', '5', 0),
(145, 'annapurna', '[\"ebc3.jpg\"]', 'fdgxdfgdfsgsdfgsdfg', '5', 0),
(153, 'pokhara', '[]', 'dsfdsgsdfvsd', '4', 0),
(155, '', '[]', '', '0', 0),
(156, '', '[]', '', '0', 0),
(157, '', '[]', '', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `popularpackage`
--

CREATE TABLE `popularpackage` (
  `id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `pimage` varchar(255) NOT NULL,
  `pdescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `popularpackage`
--

INSERT INTO `popularpackage` (`id`, `package_name`, `pimage`, `pdescription`) VALUES
(100, 'sdf', 'gsk2.jpg', 'sadf'),
(101, 'Rara Lake', 'rara-lake-trekking-2.jpg', 'Lake Rara is situated in the western part of Nepal, at about 300 km northwest of Kathamndu, the capital of Nepal. It is a warm, oligotrophic lake with a monomictic type of water circulation. It is surrounded by hills and mountains from which more than 30 '),
(104, 'pokhara', 'Pokhara.jpg', 'Pokhara’s tranquil beauty has been the subject of inspiration for many travel writers. Its pristine air, spectacular backdrop of snowy peaks, blue lakes and surrounding greenery make it ‘the jewel in the Himalaya’, a place of remarkable natural dispositio'),
(111, 'rara', 'rara-lake-trekking-2.jpg', 'raradkgjdfgj sdjfgh seadkjd;sjkakj.gh erwsghslad;z');

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
(3, 'banana', '123123', 'zxc@gmail.com', '$2y$10$3lMw2p4bsOpMtdF6ApBD..NLSEw/LZtzGefg6G4aBt3VK/4voidfC'),
(4, 'gobinda', '9865329832', 'gobinda@gmail.com', '$2y$10$D1AJy7C.7H3Kp1wRLxKggeOQOTe4K1qDtpamZHzZqLSCu.0BRkPce');

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
-- Indexes for table `popularpackage`
--
ALTER TABLE `popularpackage`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `packageavailable`
--
ALTER TABLE `packageavailable`
  MODIFY `packageAvailable_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `popularpackage`
--
ALTER TABLE `popularpackage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
