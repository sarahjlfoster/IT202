-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: sql2.njit.edu
-- Generation Time: Mar 17, 2021 at 04:51 AM
-- Server version: 8.0.17
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sf339`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `ucid` varchar(4) NOT NULL COMMENT 'uicd',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'balance',
  `account` varchar(3) NOT NULL COMMENT 'account',
  `mostRecentTrans` timestamp NOT NULL COMMENT 'most recent trans'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='accounts for user''s';

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ucid`, `balance`, `account`, `mostRecentTrans`) VALUES
('jon1', 110.00, '001', '2021-03-17 03:19:16'),
('jon1', 40.00, '002', '2021-03-02 05:00:00'),
('sar2', 400.00, '001', '2021-03-06 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `security-questions`
--

CREATE TABLE IF NOT EXISTS `security-questions` (
`AI` int(11) NOT NULL,
  `ucid` varchar(4) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `security-questions`
--

INSERT INTO `security-questions` (`AI`, `ucid`, `question`, `answer`) VALUES
(1, 'jon1', 'favorite color', 'blue'),
(2, 'jon1', 'favorite car', 'civic'),
(3, 'jon1', 'favorite food', 'strawberries'),
(4, 'sar1', 'favorite color', 'black'),
(5, 'sar1', 'favorite car', 'jeep'),
(6, 'sar1', 'favorite food', 'cheese');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `ucid` varchar(4) NOT NULL COMMENT 'ucid',
  `amount` decimal(10,2) NOT NULL COMMENT 'amount',
  `account` varchar(3) NOT NULL COMMENT 'ucid''s account',
  `timestamp` date NOT NULL COMMENT 'transaction data and time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Transactions for users accounts';

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`ucid`, `amount`, `account`, `timestamp`) VALUES
('jon1', 110.00, '001', '2021-03-16'),
('jon1', 40.00, '002', '2021-03-02'),
('sar2', 400.00, '001', '2021-03-06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ucid` varchar(4) NOT NULL COMMENT 'ucid',
  `cell` varchar(12) NOT NULL COMMENT 'user''s address',
  `email` varchar(256) NOT NULL COMMENT 'user''s Pretend NJIT email address',
  `pass` text NOT NULL COMMENT 'plaintext password',
  `name` varchar(256) NOT NULL COMMENT 'firstname lastname'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ucid`, `cell`, `email`, `pass`, `name`) VALUES
('jon1', '222 222 2222', 'jon@njit.edu', '777', 'jon wein'),
('sar2', '555 555 5555', 'sar2@njit.edu', '555', 'sar foster');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`ucid`,`account`,`mostRecentTrans`), ADD KEY `ucid` (`ucid`,`account`,`mostRecentTrans`);

--
-- Indexes for table `security-questions`
--
ALTER TABLE `security-questions`
 ADD PRIMARY KEY (`AI`,`ucid`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
 ADD PRIMARY KEY (`ucid`,`account`,`timestamp`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`ucid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `security-questions`
--
ALTER TABLE `security-questions`
MODIFY `AI` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
ADD CONSTRAINT `ucid` FOREIGN KEY (`ucid`) REFERENCES `users` (`ucid`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
