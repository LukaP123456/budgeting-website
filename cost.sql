-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2022 at 12:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cost`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles`
(
    `roles_id` int(11) NOT NULL,
    `role`     int(11) NOT NULL DEFAULT 1 COMMENT '0 = regular user\r\n1 = household admin \r\n2 = super admin	',
    PRIMARY KEY (`roles_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roles_id`, `role`)
VALUES (0, 0),
       (1, 1),
       (2, 2);


-- --------------------------------------------------------

--
-- Table structure for table `household`
--

CREATE TABLE `household`
(
    `household_id`   int(11) AUTO_INCREMENT NOT NULL,
#   PRIMARY KEY (household_id),
    `household_name` varchar(200)           NOT NULL DEFAULT 'single person',
    PRIMARY KEY (`household_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `household`
--

INSERT INTO `household` (`household_id`, `household_name`)
VALUES (0, 'temporary_house');


-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts`
(
    `users_id`             int(11) AUTO_INCREMENT NOT NULL,
    PRIMARY KEY (users_id),
    `users_pwd`            longtext               NOT NULL,
    `users_email`          varchar(100)           NOT NULL,
    `full_name`            varchar(200)           NOT NULL,
    `verify_status`        tinyint(2)             NOT NULL DEFAULT 0 COMMENT '0 = not verified, 1 = verified ',
    `verify_token`         varchar(200)                    DEFAULT NULL,
    `household_id`         int(255)                        DEFAULT 0,
    `role`                 int(11)                         DEFAULT 1 COMMENT '0 = regular user \r\n1 = household admin \r\n2 = super admin	',
    `password_reset_token` longtext                        DEFAULT NULL,
    `first_login`          int(11)                         DEFAULT NULL COMMENT 'NULL = user has yet to log in for the first time, 1 = user has already logged in once',

    UNIQUE KEY `users_email` (`users_email`),
    KEY `household_id` (`household_id`),
    KEY `role_fk` (`role`),
    CONSTRAINT `household_id` FOREIGN KEY (`household_id`) REFERENCES `household` (`household_id`),
    CONSTRAINT `role_fk` FOREIGN KEY (`role`) REFERENCES `roles` (`roles_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`users_id`, `users_pwd`, `users_email`, `full_name`, `verify_status`, `verify_token`,
                        `household_id`, `role`, `password_reset_token`, `first_login`)
VALUES (1034, '$2y$10$7nyR7.KNLn1YPTsQRaK8kuDJlmFLlq0zrGrQtRilrE7f4.PFkc8Lm', 'bobomejl123@gmail.com', 'bobo ime ', 1,
        '$2y$10$aFEQ9tw086lSdOzD/g36XOQfzr4052wXvkMQb25oq6o1RMcAMkHWC', 0, 1, NULL, NULL),
       (1035, '$2y$10$tyOVtFxD4NhZ4jhsUmbJJ.lR8ZfqvfFLDb3aACFsdDdaDGAwIN8g.', 'bobsagott17@gmail.com', 'Luka Prcic', 1,
        '$2y$10$f/lzP0Ou1koPDWzEfShvJe4SMEdY7KUXqYkat7HAnWPCvtVFR9unW', 0, 1, NULL, NULL);


-- --------------------------------------------------------

--
-- Table structure for table `cateogries`
--

CREATE TABLE `cateogries`
(
    `category_id`         int(11) AUTO_INCREMENT NOT NULL,
#   PRIMARY KEY (category_id),
    `category_name`       varchar(255)           NOT NULL,
    `household_id`        int(11)                NOT NULL,
    `category_date_added` datetime               NOT NULL,
    PRIMARY KEY (`category_id`),
    KEY `household_id` (`household_id`),
    CONSTRAINT `cateogries_ibfk_1` FOREIGN KEY (`household_id`) REFERENCES `household` (`household_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;



-- --------------------------------------------------------

--
-- Table structure for table `cash_flow`
--

CREATE TABLE `cash_flow`
(
    `amount_id`         int(11) AUTO_INCREMENT NOT NULL,
#   PRIMARY KEY (amount_id),
    `amount`            int(255) DEFAULT NULL,
    `users_id`          int(11)                NOT NULL,
    `category_id`       int(11)                NOT NULL,
    `positive_negative` tinyint(4)             NOT NULL COMMENT '0 = withdrawing amount from the budget, 1 = adding amount to the goal/budget',
    `date_added`        datetime               NOT NULL,
    PRIMARY KEY (`amount_id`),
    KEY `users_id` (`users_id`),
    KEY `category_id` (`category_id`),
    CONSTRAINT `cash_flow_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `accounts` (`users_id`),
    CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `cateogries` (`category_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;



-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals`
(
    `goal_id`       int(11) AUTO_INCREMENT NOT NULL,
#   PRIMARY KEY (goal_id),
    `goal_name`     varchar(255)           NOT NULL,
    `goal_price`    int(11)                NOT NULL,
    `user_id`       int(11)                NOT NULL,
    `goal_achieved` tinyint(3)             NOT NULL COMMENT '0 = goal not achieved, 1 = goal achieved',
    PRIMARY KEY (`goal_id`),
    KEY `user_id` (`user_id`),
    CONSTRAINT `goals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`users_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;



-- --------------------------------------------------------

--
-- Table structure for table `household_accounts`
--

CREATE TABLE `household_accounts`
(
    `user_id`       int(11) NOT NULL,
    `house_hold_id` int(11) NOT NULL,
    PRIMARY KEY (`user_id`, `house_hold_id`),
    KEY `user_id` (`user_id`),
    KEY `household1_id` (`house_hold_id`),
    CONSTRAINT `household1_id` FOREIGN KEY (`house_hold_id`) REFERENCES `household` (`household_id`),
    CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`users_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `log_data`
--

CREATE TABLE `log_data`
(
    `data_id`        int(11) AUTO_INCREMENT NOT NULL,
#   PRIMARY KEY (data_id),
    `ip_adress`      varchar(200) DEFAULT NULL,
    `web_browser_OS` varchar(200) DEFAULT NULL,
    `signup_time`    datetime     DEFAULT NULL,
    `users_id`       int(11)      DEFAULT NULL,
    PRIMARY KEY (`data_id`),
    KEY `users_id` (`users_id`),
    CONSTRAINT `log_data_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `accounts` (`users_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `log_data`
--

INSERT INTO `log_data` (`data_id`, `ip_adress`, `web_browser_OS`, `signup_time`, `users_id`)
VALUES (149, '::1', 'an unknown browser that imitates Chrome Dev 100.0.4896.127 on Windows 10', NULL, 1034),
       (150, '::1', 'an unknown browser that imitates Chrome Dev 100.0.4896.127 on Windows 10', NULL, 1035);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
