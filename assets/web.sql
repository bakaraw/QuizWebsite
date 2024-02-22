-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 22, 2024 at 08:58 AM
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
-- Database: `web`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `pass` varchar(64) DEFAULT NULL,
  `username` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`pass`, `username`) VALUES
('$2y$10$gUXmDYLGxbTW4p5B8HSuJuPGaB0ckpTXEgMGihpJTFpgvtDJpql/u', 'otin'),
('$2y$10$k3o1019PoGeCqYV16oUEP.sI74es6q7BIJH7eqAcy8779izsEWvEm', 'shit');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qid` int(11) NOT NULL,
  `quizcode` varchar(7) NOT NULL,
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `quizcode`, `question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`) VALUES
(1, '$5ayyt2', '123', 'IDEN', '123', '', '', '', ''),
(2, '$5ayyt2', '123', 'MCQ', 'choiceC', '1', '2', '3', '4'),
(3, 'U71OhnF', '123', 'MCQ', 'choiceC', '1', '2', '3', '4'),
(4, 'U71OhnF', '123', 'MCQ', 'choiceC', '1', '2', '3', '4'),
(5, 'U71OhnF', 'sa true lungs', 'TOF', 'TRUE', '', '', '', ''),
(11, 'o0d5HRY', 'sino si kokey', 'TOF', 'TRUE', '', '', '', ''),
(12, 'o0d5HRY', 'shiiit', 'MCQ', 'choiceC', '1', '2', '3', '4'),
(13, 'o0d5HRY', '123', 'IDEN', '2', '', '', '', ''),
(14, 'o0d5HRY', '12', 'MCQ', 'choiceC', '1', '2', '3', '4'),
(15, 'o0d5HRY', '123', 'IDEN', '123', '', '', '', ''),
(16, 'o0d5HRY', '123', 'IDEN', '', '', '', '', ''),
(17, 'o0d5HRY', '123', 'IDEN', '', '', '', '', ''),
(18, 'o0d5HRY', 'j', 'IDEN', '123', '', '', '', ''),
(19, 'o0d5HRY', 'jaks', 'MCQ', 'choiceC', '1', '2', '3', '4'),
(20, 'o0d5HRY', '12', 'MCQ', 'choiceC', '1', '2', '3', '4'),
(21, 'TKGstEe', '123', 'MCQ', 'choiceC', '1', '2', '3', '4'),
(22, 'TKGstEe', '123', 'MCQ', 'choiceC', '1', '2', '3', '4'),
(23, 'TKGstEe', '123', 'IDEN', '1', '', '', '', ''),
(24, 'TKGstEe', '132', 'IDEN', '1', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `quizlisttable`
--

CREATE TABLE `quizlisttable` (
  `code` varchar(7) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `visibility` varchar(8) NOT NULL,
  `creator` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizlisttable`
--

INSERT INTO `quizlisttable` (`code`, `title`, `thumbnail`, `visibility`, `creator`) VALUES
('$5ayyt2', '123', '', '', 'shit'),
('$qdri90', 'otni', '', '', 'otin'),
('$xt7lso', '123', '', '', 'shit'),
('fITcsLx', 'shit', '', '', 'shit'),
('o0d5HRY', 'new Quiz', '', '', 'shit'),
('TKGstEe', 'shitzu', '', '', 'shit'),
('U71OhnF', 'si god na bahala', '', '', 'shit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD UNIQUE KEY `username_2` (`username`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `fk_quizcode` (`quizcode`);

--
-- Indexes for table `quizlisttable`
--
ALTER TABLE `quizlisttable`
  ADD PRIMARY KEY (`code`),
  ADD KEY `fk_username` (`creator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_quizcode` FOREIGN KEY (`quizcode`) REFERENCES `quizlisttable` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quizlisttable`
--
ALTER TABLE `quizlisttable`
  ADD CONSTRAINT `fk_username` FOREIGN KEY (`creator`) REFERENCES `account` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
