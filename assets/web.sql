-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2024 at 03:52 AM
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
('$2y$10$MQ4CsnAygZMgTLLWg53XAe6AmQHnY2uGOnaU5et5rcXbodw66vzai', 'o'),
('$2y$10$q9ahwziDtGCIyD/S8ICqD.ltuKc/vqAze4RqAHajSgefG2dw0nWeK', 'yan');

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
(106, 'Rhuj0BJ', 'asdasd', 'TOF', 'TRUE', '', '', '', ''),
(107, 'R4C0WXt', 'asdasd', 'IDEN', 'o', '', '', '', ''),
(108, 'V6PZb12', 'asfasfa', 'TOF', 'TRUE', '', '', '', ''),
(109, 'nM8P3xY', 'is it?', 'TOF', 'TRUE', '', '', '', ''),
(110, 'nM8P3xY', 'asdasdas', 'MCQ', 'choiceB', 'sdasdasd', 'yes', 'asdasd', 'asdasdasda'),
(111, 'nM8P3xY', 'asfasf', 'IDEN', 'yes', '', '', '', ''),
(112, 'uWGB1rt', 'asdasd', 'IDEN', 'yes', '', '', '', ''),
(113, 'JGa3zy1', 'fasfasfa', 'IDEN', 'yes', '', '', '', ''),
(114, 'JGa3zy1', 'asfasdasd', 'MCQ', 'choiceB', 'asdasd', 'yes', 'asdasdas', 'dasdasd'),
(115, 'JGa3zy1', 'asdasdasd', 'TOF', 'TRUE', '', '', '', ''),
(116, 'rdb4Q5g', 'asdas', 'TOF', 'TRUE', '', '', '', ''),
(117, 'rdb4Q5g', 'asdasd', 'IDEN', 'yes', '', '', '', ''),
(118, 'rdb4Q5g', 'asdasdasd', 'MCQ', 'choiceD', 'asdasdasd', 'asdas', 'asdasdas', 'yes'),
(119, '5TFDsll', 'yesasdasd', 'TOF', 'TRUE', '', '', '', ''),
(120, '5TFDsll', 'asdasda', 'IDEN', 'yes', '', '', '', ''),
(121, '5TFDsll', 'asdasdas', 'MCQ', 'choiceA', 'yes', 'dasfas', 'fasfasdf', 'asfasfa');

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
('5TFDsll', 'asd', 'default_img.jpg', 'PUBLIC', 'o', 3, -1),
('8cte6H2', 'asdasdasd', '65e3def5e242a7.43845216.jpg', 'PUBLIC', 'o', 2, -1),
('AuNvxIa', 'asdasd', 'default_img.jpg', 'PRIVATE', 'o', 0, -1),
('b4lr6c3', 'asdasd', 'default_img.jpg', 'PRIVATE', 'yan', 0, -1),
('F7aJBJ0', 'asdasd', 'default_img.jpg', 'PRIVATE', 'yan', 0, -1),
('JGa3zy1', 'Yawas', 'default_img.jpg', 'PUBLIC', 'o', 2, -1),
('kfN9ou8', 'asda', 'default_img.jpg', 'PRIVATE', 'o', 0, -1),
('lggispn', 'sadasd', 'default_img.jpg', 'PUBLIC', 'yan', 1, -1),
('nM8P3xY', 'otin', 'default_img.jpg', 'PUBLIC', 'o', 1, -1),
('R4C0WXt', 'asdasd', 'default_img.jpg', 'PRIVATE', 'o', 0, -1),
('rdb4Q5g', 's', 'default_img.jpg', 'PUBLIC', 'o', 2, -1),
('Rhuj0BJ', 'asd', 'default_img.jpg', 'PUBLIC', 'yan', 1, -1),
('unt7sUS', 'asdas', 'default_img.jpg', 'PRIVATE', 'yan', 0, -1),
('uWGB1rt', 'otikn', 'default_img.jpg', 'PUBLIC', 'o', 1, -1),
('UzERHpH', 'asda', 'default_img.jpg', 'PUBLIC', 'yan', 0, -1),
('V6PZb12', 'asfasf', 'default_img.jpg', 'PUBLIC', 'o', 2, 10),
('WoRpW41', 'dasdasd', '65e3dc6bd7d451.11095861.jpg', 'PUBLIC', 'yan', 0, -1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_scores`
--

CREATE TABLE `quiz_scores` (
  `code` varchar(7) NOT NULL,
  `username` varchar(300) NOT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_scores`
--

INSERT INTO `quiz_scores` (`code`, `username`, `score`) VALUES
('V6PZb12', 'o', 0),
('nM8P3xY', 'o', 1),
('uWGB1rt', 'o', 1),
('JGa3zy1', 'o', 1),
('rdb4Q5g', 'o', 2),
('5TFDsll', 'o', 4);

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
('yan', 'Rhuj0BJ', -1),
('o', '8cte6H2', -1),
('o', 'lggispn', -1),
('o', 'V6PZb12', 10),
('o', 'nM8P3xY', -1),
('o', 'uWGB1rt', -1),
('o', 'JGa3zy1', -1);

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
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

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
  ADD CONSTRAINT `fk_quiz_code_score` FOREIGN KEY (`code`) REFERENCES `questions` (`quizcode`),
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
