-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 02, 2024 at 01:57 PM
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
('$2y$10$87RD/TIApqo/oVC8OydsQehJ7IWGl2UaNDT.ph9/zbg3JmD8yVf/i', 'lai'),
('$2y$10$YTWSjlkzq0sqHY.txiEWsOFDT/2e1xKCAfbsECwYiOOIvPz33EbLe', 'lean'),
('$2y$10$SBIf07PuOy.zOcZjsA3m3uVr1CEp5x0f/v.d.eZY7LK8fqKpJkpS.', 'pans'),
('$2y$10$mTRfBID5I7kH4wN9jxqr7ulMp0dhMz9Nb3pC8QPMG6ELcAHVjb/ku', 'shit'),
('$2y$10$4NxknTtC344TWRXZeaBUA.Zs8xCXdBSgnLEhBU3Ayi8VhQ7gH7/3G', 'yans'),
('$2y$10$nP/elDAwmc8RV5L90HaubuVNyABGHs/OTLDWw549mQoYXc3ap83p2', 'yawa');

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
(103, '9dJyn7x', '123', 'IDEN', '123', '', '', '', ''),
(104, 'u5leirn', '123', 'MCQ', 'choiceC', '1', '2', '3', '4');

-- --------------------------------------------------------

--
-- Table structure for table `quizlisttable`
--

CREATE TABLE `quizlisttable` (
  `code` varchar(7) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `accessibility` varchar(8) NOT NULL,
  `creator` varchar(255) NOT NULL,
  `views` int(11) DEFAULT 0,
  `max_attempts` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizlisttable`
--

INSERT INTO `quizlisttable` (`code`, `title`, `thumbnail`, `accessibility`, `creator`, `views`, `max_attempts`) VALUES
('9dJyn7x', 'awdad', 'default_img.jpg', 'PUBLIC', 'lai', 10, 2),
('eRmxAbv', 'laightger', 'default_img.jpg', 'PUBLIC', 'lai', 24, 3),
('IFJ462c', 'ako si badoy', 'default_img.jpg', 'PUBLIC', 'lai', 23, 3),
('nVoyJ5u', 'laighton', 'default_img.jpg', 'PUBLIC', 'lai', 7, 2),
('u5leirn', '1231231', 'default_img.jpg', 'PUBLIC', 'lai', 23, 123);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_scores`
--

CREATE TABLE `quiz_scores` (
  `code` varchar(7) NOT NULL,
  `username` varchar(300) NOT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_quiz_attempts`
--

CREATE TABLE `user_quiz_attempts` (
  `username` varchar(300) DEFAULT NULL,
  `quizcode` varchar(7) DEFAULT NULL,
  `remaining_attempts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_quiz_attempts`
--

INSERT INTO `user_quiz_attempts` (`username`, `quizcode`, `remaining_attempts`) VALUES
('lai', 'IFJ462c', -3),
('shit', 'IFJ462c', 0),
('lai', 'nVoyJ5u', 0),
('lai', 'eRmxAbv', 0),
('lai', '9dJyn7x', 0),
('lai', 'u5leirn', 120);

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
-- Indexes for table `quiz_scores`
--
ALTER TABLE `quiz_scores`
  ADD KEY `fk_quiz_code_score` (`code`),
  ADD KEY `fk_username_score` (`username`);

--
-- Indexes for table `user_quiz_attempts`
--
ALTER TABLE `user_quiz_attempts`
  ADD KEY `username` (`username`),
  ADD KEY `quizcode` (`quizcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

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

--
-- Constraints for table `quiz_scores`
--
ALTER TABLE `quiz_scores`
  ADD CONSTRAINT `fk_quiz_code_score` FOREIGN KEY (`code`) REFERENCES `quizlisttable` (`code`),
  ADD CONSTRAINT `fk_username_score` FOREIGN KEY (`username`) REFERENCES `account` (`username`);

--
-- Constraints for table `user_quiz_attempts`
--
ALTER TABLE `user_quiz_attempts`
  ADD CONSTRAINT `user_quiz_attempts_ibfk_1` FOREIGN KEY (`username`) REFERENCES `account` (`username`),
  ADD CONSTRAINT `user_quiz_attempts_ibfk_2` FOREIGN KEY (`quizcode`) REFERENCES `quizlisttable` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
