-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2022 at 05:47 PM
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
(1102, '$2y$10$G0LyLUmerjk3jY3Y5pa11eVrO1ci7t98V7W/js6VwPjBXDnhvbbXu', 'bobomejl123@gmail.com', 'bobo ime', 1, '$2y$10$jFjRquJmJhslw2JzXAwh2Op3VZFyBCzXU5L1PjHMARA/fjmpKUA16', 1, NULL, NULL, '2022-05-28 09:35:08.000000'),
(1108, '$2y$10$w19gpnDeSd6uqQyn2sQBXeUNwVkZHjfpOf2i4DR3GNG9IK0yP7E0i', 'bobsagott17@gmail.com', 'luka prcic', 1, '$2y$10$z/3edg8P76xJr501LROSG.lnQlGMkSJZ1xJMjDURshTwhiX.c7lni', 0, NULL, NULL, '2022-05-28 11:03:38.000000'),
(1111, '$2y$10$yaobcO92MCYOrbruYHAud.SXy97dnwwQvtPZ/IYTzrQL9IdTbwsD6', 'mejlzadra123jv@gmail.com', 'mejl za drajv', 1, '$2y$10$DF5RL8GOTKErkdX4NzADROQPrNLWctx.4WrTi1kH.n3uky9M7M4EC', 1, NULL, NULL, '2022-05-28 11:18:34.000000');

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
(68, 123, 1102, 10, 1, '2022-05-18 10:46:00'),
(69, 22, 1102, 4, 0, '2022-05-19 10:46:00'),
(70, 1, 1102, 1, 0, '2022-05-07 10:49:00'),
(71, 1, 1102, 10, 1, '2022-05-25 10:49:00'),
(73, 123, 1102, 1, 0, '2022-05-20 15:44:00'),
(74, 1, 1102, 1, 0, '2022-05-11 15:44:00'),
(76, 1, 1102, 9, 1, '2022-05-12 15:53:00'),
(77, 1, 1102, 10, 1, '2022-05-27 15:54:00');

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
(21, 'asdasd', 1, 37, '2022-05-28 17:25:28'),
(22, 'telefoni', 1, 37, '2022-05-28 17:28:53'),
(23, '', 0, 37, '2022-05-28 17:29:27'),
(24, 'kategorija123', 0, 37, '2022-05-28 17:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `goal_id` int(11) NOT NULL,
  `goal_name` varchar(255) NOT NULL,
  `goal_price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `goal_achieved` tinyint(3) DEFAULT NULL COMMENT '0 = goal not achieved, 1 = goal achieved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`goal_id`, `goal_name`, `goal_price`, `user_id`, `goal_achieved`) VALUES
(20, 'chair', 22, 1102, NULL),
(21, 'chair', 22, 1102, NULL),
(22, 'chair', 22, 1102, NULL),
(23, '', 0, 1102, NULL),
(24, 'car', 222, 1102, NULL),
(25, 'chair', 333, 1102, NULL),
(26, 'table', 123, 1102, NULL),
(27, 'stool', 12, 1102, NULL),
(28, 'chair', 12, 1102, NULL),
(29, 'table', 22, 1102, NULL),
(30, 'table', 22, 1102, NULL),
(31, 'table', 22, 1102, NULL),
(32, 'table', 22, 1102, NULL),
(33, 'table', 22, 1102, NULL),
(34, 'table', 22, 1102, NULL),
(35, 'table', 22, 1102, NULL),
(36, 'table', 22, 1102, NULL),
(37, 'table', 22, 1102, NULL),
(38, 'chair', 22, 1102, NULL),
(39, 'table', 33, 1102, NULL),
(40, 'car', 12, 1102, NULL),
(41, 'chair', 33, 1102, NULL),
(42, 'stool', 12, 1102, NULL),
(43, 'stool', 12, 1102, NULL),
(44, 'table', 33, 1102, NULL),
(45, 'car', 33123, 1102, NULL),
(46, '12', 22, 1102, NULL),
(47, 'car', 222, 1102, NULL),
(48, 'tavle', 444, 1102, NULL),
(49, 'tavle', 444, 1102, NULL),
(50, 'tavle', 444, 1102, NULL),
(51, 'tavle', 444, 1102, NULL),
(52, 'tavle', 444, 1102, NULL),
(53, 'tavle', 444, 1102, NULL),
(54, 'tavle', 444, 1102, NULL),
(55, 'tavle', 444, 1102, NULL),
(56, 'tavle', 444, 1102, NULL),
(57, 'tavle', 444, 1102, NULL),
(58, 'car', 222, 1102, NULL),
(59, 'table', 333, 1102, NULL),
(60, 'car', 123, 1102, NULL),
(61, 'table', 22, 1102, NULL),
(62, '', 0, 1102, NULL),
(63, 'car', 123, 1102, NULL),
(64, 'car', 123, 1102, NULL),
(65, 'table', 222, 1102, NULL),
(66, 'car', 333, 1102, NULL),
(67, 'apartment', 222, 1102, NULL),
(68, 'car', 123, 1102, NULL),
(69, 'asdasdas', 123, 1102, NULL);

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
(37, 'kuca123'),
(38, 'ja sam sam ');

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
(1102, 37),
(1108, 37),
(1111, 38);

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
(214, '::1', 'an unknown browser that imitates Chrome Dev 102.0.0.0 on Windows 10', NULL, 1102),
(220, '::1', 'an unknown browser that imitates Chrome Dev 102.0.0.0 on Windows 10', NULL, 1108),
(223, '::1', 'an unknown browser that imitates Chrome Dev 102.0.0.0 on Windows 10', NULL, 1111);

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
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1112;

--
-- AUTO_INCREMENT for table `cash_flow`
--
ALTER TABLE `cash_flow`
  MODIFY `amount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `cateogries`
--
ALTER TABLE `cateogries`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `household`
--
ALTER TABLE `household`
  MODIFY `household_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `log_data`
--
ALTER TABLE `log_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

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
