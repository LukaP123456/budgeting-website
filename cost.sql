-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2022 at 06:30 PM
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
(1112, '$2y$10$ax1uVZmgeLCkW1MAuaS2V.gfd/LNk8CcbiQ06QeGuyORur0OgEmcG', 'bobomejl123@gmail.com', 'bobo ime ', 1, '$2y$10$aJNuU6VSsaXFp1GK75hdOO.GxeXw5Wbl.hyYhDdh46PZ9xYANgGVe', 1, NULL, NULL, '2022-06-01 18:11:17.000000'),
(1113, '$2y$10$xvQ01yfA5eMOHQK21I4r6um6iF50ZZahUUUXrUp1GZ2xwqosO2EGy', 'mejlzadra123jv@gmail.com', 'mejl za drajv ', 1, '$2y$10$bn9TkTO.qTJXdJdd0NdtZuqN8aKm4hFEmOqj1SJkQQD/0QYp3W.3i', 1, NULL, NULL, '2022-06-01 18:18:05.000000'),
(1114, '$2y$10$pXj.gVJpsAih/qAs.Q.9uuclu/C56.X9yRwK./Slw6oqTScjn1NZi', 'bobsagott17@gmail.com', 'luka prcic', 1, '$2y$10$jSBHxWVnuNAwsGkr1awlQ.9UjbbDoiHm0hkdau29OS.0QJDHluzfa', 0, NULL, NULL, '2022-06-01 18:23:39.000000');

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
(78, 100, 1112, 9, 1, '2022-06-22 18:27:00'),
(79, 50, 1112, 3, 0, '2022-06-24 18:27:00');

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
(70, 'table', 111, 1112, NULL, '2022-06-01 18:30:34');

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
(39, 'KUCA123'),
(41, 'zajednicka kuca ');

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
(1112, 39),
(1113, 41),
(1114, 41);

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
(224, '::1', 'an unknown browser that imitates Chrome Dev 102.0.0.0 on Windows 10', NULL, 1112),
(226, '::1', 'an unknown browser that imitates Chrome Dev 102.0.0.0 on Windows 10', NULL, 1114);

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
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1115;

--
-- AUTO_INCREMENT for table `cash_flow`
--
ALTER TABLE `cash_flow`
  MODIFY `amount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `cateogries`
--
ALTER TABLE `cateogries`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `household`
--
ALTER TABLE `household`
  MODIFY `household_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `log_data`
--
ALTER TABLE `log_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

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
