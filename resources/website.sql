-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 14, 2022 at 12:54 PM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Table structure for table `Assign_policy_classes`
--

CREATE TABLE `Assign_policy_classes` (
  `APC_id` int NOT NULL,
  `policy_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_attribute_ID` bigint DEFAULT NULL,
  `object_attribute_ID` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Assign_policy_classes`
--

INSERT INTO `Assign_policy_classes` (`APC_id`, `policy_name`, `user_attribute_ID`, `object_attribute_ID`) VALUES
(846, 'demo', 713, NULL),
(847, 'demo', NULL, 660),
(848, 'demo', NULL, 661);

-- --------------------------------------------------------

--
-- Table structure for table `Associations`
--

CREATE TABLE `Associations` (
  `association_id` int NOT NULL,
  `policy_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_attribute` bigint NOT NULL,
  `operation_id` int NOT NULL,
  `object_attribute` bigint NOT NULL,
  `cond_ID` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Associations`
--

INSERT INTO `Associations` (`association_id`, `policy_name`, `user_attribute`, `operation_id`, `object_attribute`, `cond_ID`) VALUES
(771, 'demo', 714, 6, 662, NULL),
(772, 'demo', 715, 6, 663, NULL),
(773, 'demo', 716, 7, 660, 111),
(774, 'demo', 716, 6, 660, 111),
(775, 'demo', 713, 7, 661, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE `conditions` (
  `condition_ID` bigint NOT NULL,
  `condition_definition` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`condition_ID`, `condition_definition`) VALUES
(111, 'time_in_range(time(7,0,0),time_now,time(16,0,0))');

-- --------------------------------------------------------

--
-- Table structure for table `Loaded_policies`
--

CREATE TABLE `Loaded_policies` (
  `policy_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `loaded_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Objects`
--

CREATE TABLE `Objects` (
  `object_id` int NOT NULL,
  `full_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Objects`
--

INSERT INTO `Objects` (`object_id`, `full_name`) VALUES
(4, 'Secret_Document'),
(11, 'Document1'),
(12, 'Document2');

-- --------------------------------------------------------

--
-- Table structure for table `Object_attr_policy_conns`
--

CREATE TABLE `Object_attr_policy_conns` (
  `object_attribute_ID` bigint NOT NULL,
  `policy_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `object_attr_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parent_attribute` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Object_attr_policy_conns`
--

INSERT INTO `Object_attr_policy_conns` (`object_attribute_ID`, `policy_name`, `object_attr_name`, `parent_attribute`) VALUES
(660, 'demo', 'Boss_Documents', NULL),
(661, 'demo', 'Documents', NULL),
(662, 'demo', 'Group1_Documents', 661),
(663, 'demo', 'Group2_Documents', 661);

-- --------------------------------------------------------

--
-- Table structure for table `Object_policy_conns`
--

CREATE TABLE `Object_policy_conns` (
  `object_policy_ID` bigint NOT NULL,
  `policy_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int NOT NULL,
  `assigned_attribute` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Object_policy_conns`
--

INSERT INTO `Object_policy_conns` (`object_policy_ID`, `policy_name`, `object_id`, `assigned_attribute`) VALUES
(643, 'demo', 11, 662),
(644, 'demo', 12, 663),
(645, 'demo', 4, 660);

-- --------------------------------------------------------

--
-- Table structure for table `Operations`
--

CREATE TABLE `Operations` (
  `operation_id` int NOT NULL,
  `operation_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `operation_2_field` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Operations`
--

INSERT INTO `Operations` (`operation_id`, `operation_name`, `operation_2_field`) VALUES
(1, 'w', 'write'),
(3, 'r', 'read'),
(6, 'w', 'w'),
(7, 'r', 'r');

-- --------------------------------------------------------

--
-- Table structure for table `Policies`
--

CREATE TABLE `Policies` (
  `policy_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `policy_class_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Policies`
--

INSERT INTO `Policies` (`policy_name`, `policy_class_name`, `created_at`) VALUES
('demo', 'access', '2022-03-01 13:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int NOT NULL,
  `full_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `full_name`) VALUES
(3, 'Ilaman'),
(4, 'Jesper'),
(5, 'Emil'),
(6, 'Birger'),
(10, 'Ulf');

-- --------------------------------------------------------

--
-- Table structure for table `User_attr_policy_conns`
--

CREATE TABLE `User_attr_policy_conns` (
  `user_attribute_ID` bigint NOT NULL,
  `policy_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_attr_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parent_attribute` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `User_attr_policy_conns`
--

INSERT INTO `User_attr_policy_conns` (`user_attribute_ID`, `policy_name`, `user_attr_name`, `parent_attribute`) VALUES
(713, 'demo', 'Company', NULL),
(714, 'demo', 'Group1', 713),
(715, 'demo', 'Group2', 713),
(716, 'demo', 'Boss', 713);

-- --------------------------------------------------------

--
-- Table structure for table `User_policy_conns`
--

CREATE TABLE `User_policy_conns` (
  `user_policy_ID` bigint NOT NULL,
  `policy_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `assigned_attribute` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `User_policy_conns`
--

INSERT INTO `User_policy_conns` (`user_policy_ID`, `policy_name`, `user_id`, `assigned_attribute`) VALUES
(612, 'demo', 4, 714),
(613, 'demo', 3, 714),
(614, 'demo', 5, 715),
(615, 'demo', 6, 715),
(616, 'demo', 10, 716);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Assign_policy_classes`
--
ALTER TABLE `Assign_policy_classes`
  ADD PRIMARY KEY (`APC_id`),
  ADD KEY `policy_name` (`policy_name`),
  ADD KEY `Assign_policy_classes_ibfk_1` (`object_attribute_ID`),
  ADD KEY `Assign_policy_classes_ibfk_3` (`user_attribute_ID`);

--
-- Indexes for table `Associations`
--
ALTER TABLE `Associations`
  ADD PRIMARY KEY (`association_id`),
  ADD KEY `fk_operation_id` (`operation_id`),
  ADD KEY `fk_user_attribute` (`user_attribute`),
  ADD KEY `fk_object_attribute` (`object_attribute`),
  ADD KEY `fk_user_policy_name` (`policy_name`),
  ADD KEY `cond_ID` (`cond_ID`);

--
-- Indexes for table `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`condition_ID`),
  ADD UNIQUE KEY `condition_definition` (`condition_definition`);

--
-- Indexes for table `Loaded_policies`
--
ALTER TABLE `Loaded_policies`
  ADD PRIMARY KEY (`policy_name`);

--
-- Indexes for table `Objects`
--
ALTER TABLE `Objects`
  ADD PRIMARY KEY (`object_id`);

--
-- Indexes for table `Object_attr_policy_conns`
--
ALTER TABLE `Object_attr_policy_conns`
  ADD PRIMARY KEY (`object_attribute_ID`),
  ADD KEY `policy_name` (`policy_name`),
  ADD KEY `parent_attribute` (`parent_attribute`);

--
-- Indexes for table `Object_policy_conns`
--
ALTER TABLE `Object_policy_conns`
  ADD PRIMARY KEY (`object_policy_ID`),
  ADD KEY `fk_object_id_OBJECTS` (`object_id`),
  ADD KEY `policy_name` (`policy_name`),
  ADD KEY `object_attribute_ID` (`assigned_attribute`);

--
-- Indexes for table `Operations`
--
ALTER TABLE `Operations`
  ADD PRIMARY KEY (`operation_id`);

--
-- Indexes for table `Policies`
--
ALTER TABLE `Policies`
  ADD PRIMARY KEY (`policy_name`),
  ADD KEY `Policy_class_name` (`policy_class_name`) USING BTREE;

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `User_attr_policy_conns`
--
ALTER TABLE `User_attr_policy_conns`
  ADD PRIMARY KEY (`user_attribute_ID`),
  ADD KEY `policy_name` (`policy_name`),
  ADD KEY `User_attr_policy_conns_ibfk_1` (`parent_attribute`);

--
-- Indexes for table `User_policy_conns`
--
ALTER TABLE `User_policy_conns`
  ADD PRIMARY KEY (`user_policy_ID`),
  ADD KEY `fk_user_id_USER_POLICY_CONNS` (`user_id`),
  ADD KEY `policy_name` (`policy_name`),
  ADD KEY `object_attribute_ID` (`assigned_attribute`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Assign_policy_classes`
--
ALTER TABLE `Assign_policy_classes`
  MODIFY `APC_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1067;

--
-- AUTO_INCREMENT for table `Associations`
--
ALTER TABLE `Associations`
  MODIFY `association_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=915;

--
-- AUTO_INCREMENT for table `conditions`
--
ALTER TABLE `conditions`
  MODIFY `condition_ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `Objects`
--
ALTER TABLE `Objects`
  MODIFY `object_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Object_attr_policy_conns`
--
ALTER TABLE `Object_attr_policy_conns`
  MODIFY `object_attribute_ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=812;

--
-- AUTO_INCREMENT for table `Object_policy_conns`
--
ALTER TABLE `Object_policy_conns`
  MODIFY `object_policy_ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=723;

--
-- AUTO_INCREMENT for table `Operations`
--
ALTER TABLE `Operations`
  MODIFY `operation_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `User_attr_policy_conns`
--
ALTER TABLE `User_attr_policy_conns`
  MODIFY `user_attribute_ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=865;

--
-- AUTO_INCREMENT for table `User_policy_conns`
--
ALTER TABLE `User_policy_conns`
  MODIFY `user_policy_ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=738;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Assign_policy_classes`
--
ALTER TABLE `Assign_policy_classes`
  ADD CONSTRAINT `Assign_policy_classes_ibfk_1` FOREIGN KEY (`object_attribute_ID`) REFERENCES `Object_attr_policy_conns` (`object_attribute_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Assign_policy_classes_ibfk_2` FOREIGN KEY (`policy_name`) REFERENCES `Policies` (`policy_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Assign_policy_classes_ibfk_3` FOREIGN KEY (`user_attribute_ID`) REFERENCES `User_attr_policy_conns` (`user_attribute_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Associations`
--
ALTER TABLE `Associations`
  ADD CONSTRAINT `Associations_ibfk_1` FOREIGN KEY (`cond_ID`) REFERENCES `conditions` (`condition_ID`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_object_attribute` FOREIGN KEY (`object_attribute`) REFERENCES `Object_attr_policy_conns` (`object_attribute_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_operation_id` FOREIGN KEY (`operation_id`) REFERENCES `Operations` (`operation_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_attribute` FOREIGN KEY (`user_attribute`) REFERENCES `User_attr_policy_conns` (`user_attribute_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_policy_name` FOREIGN KEY (`policy_name`) REFERENCES `Policies` (`policy_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Loaded_policies`
--
ALTER TABLE `Loaded_policies`
  ADD CONSTRAINT `fk_policy_name_Policies` FOREIGN KEY (`policy_name`) REFERENCES `Policies` (`policy_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Object_attr_policy_conns`
--
ALTER TABLE `Object_attr_policy_conns`
  ADD CONSTRAINT `fk_policy_name_OBJ` FOREIGN KEY (`policy_name`) REFERENCES `Policies` (`policy_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Object_attr_policy_conns_ibfk_1` FOREIGN KEY (`parent_attribute`) REFERENCES `Object_attr_policy_conns` (`object_attribute_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Object_policy_conns`
--
ALTER TABLE `Object_policy_conns`
  ADD CONSTRAINT `fk_object_id_OBJECTS` FOREIGN KEY (`object_id`) REFERENCES `Objects` (`object_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_policy_name_OBJECTS` FOREIGN KEY (`policy_name`) REFERENCES `Policies` (`policy_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Object_policy_conns_ibfk_1` FOREIGN KEY (`assigned_attribute`) REFERENCES `Object_attr_policy_conns` (`object_attribute_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `User_attr_policy_conns`
--
ALTER TABLE `User_attr_policy_conns`
  ADD CONSTRAINT `fk_policy_name_USER_attr` FOREIGN KEY (`policy_name`) REFERENCES `Policies` (`policy_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User_attr_policy_conns_ibfk_1` FOREIGN KEY (`parent_attribute`) REFERENCES `User_attr_policy_conns` (`user_attribute_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `User_policy_conns`
--
ALTER TABLE `User_policy_conns`
  ADD CONSTRAINT `fk_policy_name_USER_POLICY_CONNS` FOREIGN KEY (`policy_name`) REFERENCES `Policies` (`policy_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id_USER_POLICY_CONNS` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `User_policy_conns_ibfk_1` FOREIGN KEY (`assigned_attribute`) REFERENCES `User_attr_policy_conns` (`user_attribute_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
