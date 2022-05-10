-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2022 at 01:15 PM
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
  `first_login` int(11) DEFAULT NULL COMMENT 'NULL = user has yet to log in for the first time, 1 = user has already logged in once'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`users_id`, `users_pwd`, `users_email`, `full_name`, `verify_status`, `verify_token`, `role`, `password_reset_token`, `first_login`) VALUES
(1036, '$2y$10$lrig5TLk.ToPHQOVcVYZXe39dyKhW34RqA9X4nJxQB5tma25zvJAK', 'bobomejl123@gmail.com', 'bobo ime', 1, '$2y$10$CPKUkVrEYYyPKzepm1CS8.vmBrmHMjnjESasLHOWPPcdVkU3ktJNu', 1, NULL, NULL),
(1037, '$2y$10$QzGuuY81liXb.ryhVSV18ehu/SMzlSF3p1ht/JJKbXBjw9q9JzBj6', 'bobsagott17@gmail.com', 'Luka Prcic', 1, '$2y$10$3cwpAy6mtjTe7mzTv8UQxeaMckLABvZuGxbWLqWQS8Ybj23eNyTEG', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cash_flow`
--

CREATE TABLE `cash_flow` (
  `amount_id` int(11) NOT NULL,
  `amount` int(255) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `positive_negative` tinyint(4) NOT NULL COMMENT '0 = withdrawing amount from the budget, 1 = adding amount to the goal/budget',
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cateogries`
--

CREATE TABLE `cateogries` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `household_id` int(11) NOT NULL,
  `category_date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `goal_id` int(11) NOT NULL,
  `goal_name` varchar(255) NOT NULL,
  `goal_price` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `goal_achieved` tinyint(3) NOT NULL COMMENT '0 = goal not achieved, 1 = goal achieved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(3, 'kuca1');

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
(1036, 3);

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
(151, '::1', 'an unknown browser that imitates Chrome Dev 101.0.4951.54 on Windows 10', NULL, 1036),
(152, '::1', 'an unknown browser that imitates Chrome Dev 101.0.4951.54 on Windows 10', NULL, 1037);

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
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1038;

--
-- AUTO_INCREMENT for table `cash_flow`
--
ALTER TABLE `cash_flow`
  MODIFY `amount_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cateogries`
--
ALTER TABLE `cateogries`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `goal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `household`
--
ALTER TABLE `household`
  MODIFY `household_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log_data`
--
ALTER TABLE `log_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

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
