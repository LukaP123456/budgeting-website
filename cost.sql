-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2022 at 12:10 PM
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
(1139, '$2y$10$4msXnFgfHUEV2NOycKHdpeJCu625AhWms4dvFHMirwC//y6OHh2OG', 'bobsagott17@gmail.com', 'luka prcic', 1, '$2y$10$CqOlvnU2r92lVLd3bbSmLe.o2G4y6CGvtXXGM5X9Ade7T7sn0xsQa', 1, NULL, NULL, '2022-06-02 21:28:36.000000'),
(1143, '$2y$10$ceXYvj8WQhviKZ93WYDpaO.Htuk/KsDrb36EmAKzeWCrBGbihyJrq', 'woltakaunt@gmail.com', 'wolt akaunt ', 1, '$2y$10$dEvkJvEMZn0ScNVpgGmwR.UVi7AuDl9u.ehKsWOOVlHUcKeG8HrOW', 2, NULL, NULL, '2022-06-05 16:43:32.000000');

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
  `date_added` datetime NOT NULL,
  `cost_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_flow`
--

INSERT INTO `cash_flow` (`amount_id`, `amount`, `users_id`, `category_id`, `positive_negative`, `date_added`, `cost_description`) VALUES
(145, 100, 1139, 1, 0, '2022-06-05 10:50:00', 'asdasdasd'),
(146, 200, 1139, 2, 0, '2022-06-05 10:50:00', 'wwwww'),
(147, 200, 1139, 2, 0, '2022-06-05 10:51:00', 'eeeee'),
(148, 400, 1139, 3, 0, '2022-06-06 10:51:00', 'qweqwe'),
(149, 12, 1139, 5, 0, '2022-06-05 10:52:00', 'asdasd'),
(150, 12, 1139, 4, 0, '2022-06-05 10:53:00', 'qweqwe'),
(151, 20, 1139, 7, 0, '2022-05-01 11:10:00', 'asdasda'),
(152, 123, 1125, 1, 0, '2022-06-05 11:14:00', 'asdasdas'),
(153, 222, 1125, 3, 0, '2022-06-05 11:14:00', 'asdawdsdas'),
(154, 340, 1125, 4, 0, '2022-06-05 11:14:00', 'asdawdsdawd'),
(155, 1, 1125, 2, 0, '2022-06-04 14:40:00', 'asdasd'),
(156, 2, 1125, 34, 0, '2022-06-24 14:41:00', 'asdasd'),
(157, 2, 1125, 35, 0, '2022-06-06 14:42:00', 'asdawdas213asda'),
(158, 333, 1124, 36, 0, '2022-06-11 19:40:00', 'asdawdasd xz ca e wasd');

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
(12, 'Gift', 1, NULL, NULL),
(31, 'pozitivan kategorija 1', 1, 50, '2022-06-04 10:48:22'),
(32, 'pozitivan kategorija 2', 1, 50, '2022-06-04 10:48:27'),
(33, 'pozitivan kategorija 3', 1, 50, '2022-06-04 10:48:30'),
(34, 'negativna kategorija 1', 0, 50, '2022-06-04 10:48:43'),
(35, 'negativna kategorija 2', 0, 50, '2022-06-04 10:48:47'),
(36, 'negativna kategorija 3', 0, 50, '2022-06-04 10:48:49'),
(45, 'asdasdasd', 1, 50, '2022-06-04 20:00:58'),
(46, 'sama u kuci kategorija', 1, 52, '2022-06-04 20:02:46');

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
(99, 'bbb', 222, 1124, NULL, '2022-06-03 19:42:37'),
(100, 'asdasdasd', 1212, 1125, NULL, '2022-06-04 11:04:05'),
(101, 'chair', 222, 1139, NULL, '2022-06-04 14:18:28'),
(102, 'table', 111, 1139, NULL, '2022-06-04 14:23:56'),
(103, 'chair', 222, 1139, NULL, '2022-06-04 14:26:10'),
(104, 'car', 333, 1139, NULL, '2022-06-04 14:27:04'),
(105, 'asdasda', 111, 1139, NULL, '2022-06-04 14:27:53'),
(106, 'table', 222, 1139, NULL, '2022-06-04 14:29:36'),
(107, 'chair', 222, 1139, NULL, '2022-06-04 14:30:27'),
(108, 'table', 111, 1139, NULL, '2022-06-04 14:30:42'),
(109, 'car', 222, 1139, NULL, '2022-06-04 14:35:32'),
(110, 'table', 111, 1125, NULL, '2022-06-04 19:10:26'),
(111, 'chair', 222, 1125, NULL, '2022-06-04 19:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `household`
--

CREATE TABLE `household` (
  `household_id` int(11) NOT NULL,
  `household_name` varchar(200) NOT NULL DEFAULT 'single person',
  `blocked` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = not blocked, 1 = blocked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `household`
--

INSERT INTO `household` (`household_id`, `household_name`, `blocked`) VALUES
(50, 'zajednicka kuca ', 0),
(52, 'sama u kuci ', 0);

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
(250, '::1', 'an unknown browser that imitates Chrome Dev 102.0.0.0 on Windows 10', NULL, 1139),
(254, '::1', 'an unknown browser that imitates Chrome Dev 102.0.0.0 on Windows 10', NULL, 1143);

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
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1144;

--
-- AUTO_INCREMENT for table `cash_flow`
--
ALTER TABLE `cash_flow`
  MODIFY `amount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `cateogries`
--
ALTER TABLE `cateogries`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `household`
--
ALTER TABLE `household`
  MODIFY `household_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `log_data`
--
ALTER TABLE `log_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

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
