-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2024 at 12:05 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lost_n_found`
--

-- --------------------------------------------------------

--
-- Table structure for table `found_items`
--

CREATE TABLE `found_items` (
  `itemid` int NOT NULL,
  `rid` int NOT NULL,
  `sid` int NOT NULL,
  `image_id` int NOT NULL,
  `item_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `time` time DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `found_status`
--

CREATE TABLE `found_status` (
  `sid` int NOT NULL,
  `sname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Found'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `found_status`
--

INSERT INTO `found_status` (`sid`, `sname`) VALUES
(1, 'UnClaimed'),
(2, 'InProgress'),
(3, 'Claimed');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` int NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` int NOT NULL,
  `file_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--
-- --------------------------------------------------------

--
-- Table structure for table `lost_items`
--

CREATE TABLE `lost_items` (
  `itemid` int NOT NULL,
  `rid` int NOT NULL,
  `sid` int NOT NULL,
  `image_id` int NOT NULL,
  `item_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `time` time DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `claimed_items` (
  `claim_id` int(11) NOT NULL AUTO_INCREMENT,
  `found_item_id` int(11) NOT NULL,
  `rid` int(11) NOT NULL, 
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`claim_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




-- --------------------------------------------------------

--
-- Table structure for table `lost_status`
--

CREATE TABLE `lost_status` (
  `sid` int NOT NULL,
  `sname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Lost'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lost_status`
--

INSERT INTO `lost_status` (`sid`, `sname`) VALUES
(1, 'Lost'),
(2, 'Searching'),
(3, 'Found');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `rid` int NOT NULL,
  `rname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`rid`, `rname`) VALUES
(1, 'Admin'),
(2, 'Student'),
(3, 'Teaching Staff'),
(4, 'Non Teaching Staff'),
(5, 'Visitor');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int NOT NULL,
  `rid` int NOT NULL,
  `fname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` int NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `passwd` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `rid`, `fname`, `lname`, `gender`, `tel`, `email`, `passwd`) VALUES
(7, 2, 'Jean', 'Mull', 2, '1234567890', 'jmull@ashesi.edu.gh', '$2y$10$j1Z14s/IZgkzPOhCia1EEuNiBcisHdsQ8MFaXn5GRdCnW.dNsA1qS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `found_items`
--
ALTER TABLE `found_items`
  ADD PRIMARY KEY (`itemid`),
  ADD KEY `rid` (`rid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `found_items_ibfk_3` (`image_id`);

--
-- Indexes for table `found_status`
--
ALTER TABLE `found_status`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD PRIMARY KEY (`itemid`),
  ADD UNIQUE KEY `unique_item` (`item_name`,`time`,`location`),
  ADD KEY `rid` (`rid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `lost_items_ibfk_3` (`image_id`);

--
-- Indexes for table `lost_status`
--
ALTER TABLE `lost_status`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `rid` (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `found_items`
--
ALTER TABLE `found_items`
  MODIFY `itemid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `found_status`
--
ALTER TABLE `found_status`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lost_items`
--
ALTER TABLE `lost_items`
  MODIFY `itemid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lost_status`
--
ALTER TABLE `lost_status`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `rid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `found_items`
--
ALTER TABLE `found_items`
  ADD CONSTRAINT `found_items_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `role` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `found_items_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `found_status` (`sid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `found_items_ibfk_3` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`) ON UPDATE CASCADE;

--
-- Constraints for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD CONSTRAINT `lost_items_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `role` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lost_items_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `lost_status` (`sid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lost_items_ibfk_3` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `role` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;



ALTER TABLE `claimed_items`
  ADD CONSTRAINT `fk_claimed_found_item`
  FOREIGN KEY (`found_item_id`)
  REFERENCES `found_items` (`itemid`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `lost_items` ADD COLUMN `interaction_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `found_items` ADD COLUMN `interaction_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `claimed_items` ADD COLUMN `interaction_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `lost_items`
    ADD COLUMN `uid` int(11) NOT NULL,
    ADD CONSTRAINT `fk_lost_user` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `found_items`
    ADD COLUMN `uid` int(11) NOT NULL,
    ADD CONSTRAINT `fk_found_user` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `claimed_items`
    ADD COLUMN `uid` int(11) NOT NULL,
    ADD CONSTRAINT `fk_claimed_user` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE lost_items ADD COLUMN category ENUM('Electronics', 'Books', 'Clothing', 'Others') NOT NULL;
ALTER TABLE found_items ADD COLUMN category ENUM('Electronics', 'Books', 'Clothing', 'Others') NOT NULL;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- Added a claimed items table to db. Only found items can be claimed so relationship established
-- Added time to lost, found and claimed items tables
