-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2022 at 07:52 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cost`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `users_id` int(11) NOT NULL,
  `users_pwd` longtext NOT NULL,
  `users_email` varchar(100) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0 = not verified, 1 = verified ',
  `verify_token` varchar(200) DEFAULT NULL,
  `role` int(11) DEFAULT 1 COMMENT '0 = regular user \r\n1 = household admin \r\n2 = super admin	',
  `password_reset_token` longtext DEFAULT NULL,
  `first_login` int(11) DEFAULT NULL COMMENT 'NULL = user has yet to log in for the first time, 1 = user has already logged in once',
  `date_time_signup` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`users_id`, `users_pwd`, `users_email`, `full_name`, `verify_status`, `verify_token`, `role`, `password_reset_token`, `first_login`, `date_time_signup`) VALUES
(1124, '$2y$10$4aEL/UevrtZcFJ3S1rPUwOXvSluZr5EDiHK16tGhbprasOWNmUbZe', 'bobomejl123@gmail.com', 'bobo ime', 1, '$2y$10$SYBwEyYzKG23qBTwnqRQWeyw3hLv0SHRO31jJmdFwtysbft6PCmQi', 1, NULL, NULL, '2022-06-02 11:33:20.000000'),
(1125, '$2y$10$dSlStSINP5aQ/28mv8TiJeyeOFO4.ugmPApUNylSUPL9Gf2QpBebm', 'mejlzadra123jv@gmail.com', 'luka prcic', 1, '$2y$10$zBaGqOjLUa23KVDpXJC4LusVknrK8pIMkdkIsIA/DtYAO5a80qn6i', 0, NULL, NULL, '2022-06-02 11:34:19.000000'),
(1126, '$2y$10$caFI.e/bIxTF.tXU2W0Ake0zDE5e67WiyEYrXAEk.3JvhIBtVpSgy', 'luka.prcic01@gmail.com', 'Moje pravo ime ', 1, '$2y$10$kcjTAMAGf.8ojmxO3SyafOuNt3YDGCvPY0IN1REX7zOv6O.o8Llo.', 0, NULL, NULL, '2022-06-02 11:40:19.000000'),
(1139, '$2y$10$4msXnFgfHUEV2NOycKHdpeJCu625AhWms4dvFHMirwC//y6OHh2OG', 'bobsagott17@gmail.com', 'luka prcic', 1, '$2y$10$CqOlvnU2r92lVLd3bbSmLe.o2G4y6CGvtXXGM5X9Ade7T7sn0xsQa', 1, NULL, NULL, '2022-06-02 21:28:36.000000');

-- --------------------------------------------------------

--
-- Table structure for table `cash_flow`
--

CREATE TABLE `cash_flow` (
  `amount_id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `positive_negative` tinyint(4) NOT NULL COMMENT '0 = withdrawing amount from the budget, 1 = adding amount to the goal/budget',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_flow`
--

INSERT INTO `cash_flow` (`amount_id`, `amount`, `users_id`, `category_id`, `positive_negative`, `date_added`) VALUES
(99, 50, 1124, 9, 1, '2022-06-23 20:23:00'),
(100, 12.56, 1124, 1, 0, '2022-06-16 20:23:00'),
(101, 10, 1124, 1, 0, '2022-06-29 20:23:00'),
(102, 56, 1124, 5, 0, '2022-06-28 20:23:00'),
(103, 23, 1124, 5, 0, '2022-06-27 20:23:00'),
(104, 66, 1124, 7, 0, '2022-07-01 20:23:00'),
(105, 2, 1124, 9, 1, '2022-06-03 18:27:00'),
(106, 3, 1124, 9, 1, '2022-06-23 18:47:00'),
(107, 4, 1124, 10, 1, '2022-06-02 18:47:00'),
(108, 11, 1124, 12, 1, '2022-06-09 18:48:00'),
(109, 1, 1124, 12, 1, '2022-06-03 18:58:00'),
(110, 11.11, 1124, 10, 1, '2022-06-03 19:10:00'),
(111, 22.22, 1124, 9, 1, '2022-06-03 19:16:00'),
(112, 33.33, 1124, 9, 1, '2022-06-03 19:19:00'),
(113, 222222000, 1124, 12, 1, '2022-08-07 19:44:00'),
(114, 11, 1124, 10, 1, '2022-09-17 19:45:00'),
(115, 123, 1124, 2, 0, '2022-07-09 19:48:00'),
(116, 11111100, 1124, 1, 0, '2022-07-09 19:48:00'),
(117, 55.55, 1124, 1, 0, '2023-10-03 19:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `cateogries`
--

CREATE TABLE `cateogries` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_type` tinyint(2) NOT NULL COMMENT '0 = withdraw category\r\n1 = add category',
  `household_id` int(11) DEFAULT NULL,
  `category_date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cateogries`
--

INSERT INTO `cateogries` (`category_id`, `category_name`, `category_type`, `household_id`, `category_date_added`) VALUES
(1, 'Eating out', 0, NULL, NULL),
(2, 'Shopping', 0, NULL, NULL),
(3, 'Transportation', 0, NULL, NULL),
(4, 'Entertainment', 0, NULL, NULL),
(5, 'Family', 0, NULL, NULL),
(6, 'Health/Sport', 0, NULL, NULL),
(7, 'Pets', 0, NULL, NULL),
(8, 'Travels', 0, NULL, NULL),
(9, 'Salary', 1, NULL, NULL),
(10, 'Pension', 1, NULL, NULL),
(11, 'Odd jobs', 1, NULL, NULL),
(12, 'Gift', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `goal_id` int(11) NOT NULL,
  `goal_name` varchar(255) NOT NULL,
  `goal_price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `goal_achieved` tinyint(3) DEFAULT NULL COMMENT '0 = goal not achieved, 1 = goal achieved',
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`goal_id`, `goal_name`, `goal_price`, `user_id`, `goal_achieved`, `added_date`) VALUES
(89, 'car', 444, 1124, NULL, '2022-06-03 18:30:26'),
(90, 'chair', 111, 1124, NULL, '2022-06-03 19:00:17'),
(91, 'table', 123, 1124, NULL, '2022-06-03 19:05:28'),
(92, 'stool', 111, 1124, NULL, '2022-06-03 19:10:08'),
(93, 'bike', 444, 1124, NULL, '2022-06-03 19:10:28'),
(94, 'boat', 342, 1124, NULL, '2022-06-03 19:17:24'),
(95, 'table', 222, 1124, NULL, '2022-06-03 19:21:44'),
(96, 'asdasda', 111111, 1124, NULL, '2022-06-03 19:27:25'),
(97, 'dddddd', 222, 1124, NULL, '2022-06-03 19:27:41'),
(98, 'aaaa', 1111, 1124, NULL, '2022-06-03 19:37:39'),
(99, 'bbb', 222, 1124, NULL, '2022-06-03 19:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `household`
--

CREATE TABLE `household` (
  `household_id` int(11) NOT NULL,
  `household_name` varchar(200) NOT NULL DEFAULT 'single person'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `household`
--

INSERT INTO `household` (`household_id`, `household_name`) VALUES
(50, 'zajednicka kuca '),
(52, 'sama u kuci ');

-- --------------------------------------------------------

--
-- Table structure for table `household_accounts`
--

CREATE TABLE `household_accounts` (
  `user_id` int(11) NOT NULL,
  `house_hold_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `household_accounts`
--

INSERT INTO `household_accounts` (`user_id`, `house_hold_id`) VALUES
(1124, 50),
(1125, 50),
(1126, 50),
(1139, 52);

-- --------------------------------------------------------

--
-- Table structure for table `log_data`
--

CREATE TABLE `log_data` (
  `data_id` int(11) NOT NULL,
  `ip_adress` varchar(200) DEFAULT NULL,
  `web_browser_OS` varchar(200) DEFAULT NULL,
  `signup_time` datetime DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_data`
--

INSERT INTO `log_data` (`data_id`, `ip_adress`, `web_browser_OS`, `signup_time`, `users_id`) VALUES
(236, '::1', 'an unknown browser that imitates Chrome Dev 102.0.0.0 on Windows 10', NULL, 1124),
(237, '::1', 'an unknown browser that imitates Chrome Dev 102.0.0.0 on Windows 10', NULL, 1125),
(238, '::1', 'an unknown browser that imitates Chrome Dev 102.0.0.0 on Windows 10', NULL, 1126),
(250, '::1', 'an unknown browser that imitates Chrome Dev 102.0.0.0 on Windows 10', NULL, 1139);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roles_id` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1 COMMENT '0 = regular user\r\n1 = household admin \r\n2 = super admin	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roles_id`, `role`) VALUES
(0, 0),
(1, 1),
(2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `users_email` (`users_email`),
  ADD KEY `role_fk` (`role`);

--
-- Indexes for table `cash_flow`
--
ALTER TABLE `cash_flow`
  ADD PRIMARY KEY (`amount_id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `cateogries`
--
ALTER TABLE `cateogries`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `household_id` (`household_id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`goal_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `household`
--
ALTER TABLE `household`
  ADD PRIMARY KEY (`household_id`);

--
-- Indexes for table `household_accounts`
--
ALTER TABLE `household_accounts`
  ADD PRIMARY KEY (`user_id`,`house_hold_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `household1_id` (`house_hold_id`);

--
-- Indexes for table `log_data`
--
ALTER TABLE `log_data`
  ADD PRIMARY KEY (`data_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1140;

--
-- AUTO_INCREMENT for table `cash_flow`
--
ALTER TABLE `cash_flow`
  MODIFY `amount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `cateogries`
--
ALTER TABLE `cateogries`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `household`
--
ALTER TABLE `household`
  MODIFY `household_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `log_data`
--
ALTER TABLE `log_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `role_fk` FOREIGN KEY (`role`) REFERENCES `roles` (`roles_id`);

--
-- Constraints for table `cash_flow`
--
ALTER TABLE `cash_flow`
  ADD CONSTRAINT `cash_flow_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `accounts` (`users_id`),
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `cateogries` (`category_id`);

--
-- Constraints for table `cateogries`
--
ALTER TABLE `cateogries`
  ADD CONSTRAINT `cateogries_ibfk_1` FOREIGN KEY (`household_id`) REFERENCES `household` (`household_id`);

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`users_id`);

--
-- Constraints for table `household_accounts`
--
ALTER TABLE `household_accounts`
  ADD CONSTRAINT `household1_id` FOREIGN KEY (`house_hold_id`) REFERENCES `household` (`household_id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`users_id`);

--
-- Constraints for table `log_data`
--
ALTER TABLE `log_data`
  ADD CONSTRAINT `log_data_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `accounts` (`users_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
