-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 11:14 PM
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
('$2y$10$a9wj7P3ais91t.Dv/IksUetME8jmscqzxjM.PFs/G7pSOfHvjPEwu', 'asdasd'),
('$2y$10$JOk4Sne1lBn0hlnr4b9.pOj/lWafwrhv9MmvSYt6mDWSYHFMDtyoO', 'lai'),
('$2y$10$ZrG/yxdf9S.U9WrQliFnw.QRpcSPG/Fb5eWMEuOqGNuGkbuP5Ix4a', 'pans'),
('$2y$10$pLL/gfA3sf5w99CsfIZAxe6h2m3KiUo065tdqywbOkerKFJtl8DkK', 'yans');

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
(101, 'UrYcn3x', 'asdas', 'IDEN', 'yes', '', '', '', ''),
(102, 'UrYcn3x', 'sdfsdfs', 'TOF', 'TRUE', '', '', '', ''),
(103, 'UrYcn3x', 'sdgsdg', 'MCQ', 'choiceA', 'yes', 'asfas', 'fasfas', 'fasfas'),
(104, 'R2wHuhY', 'is it one only?', 'IDEN', 'yes', '', '', '', ''),
(105, 'R2wHuhY', 'for one', 'MCQ', 'choiceA', 'yes', 'asda', 'sdasda', 'asdasd'),
(106, 'R2wHuhY', 'is it ture???', 'TOF', 'TRUE', '', '', '', ''),
(107, '7R3F7H6', 'asdas', 'IDEN', 'yes', '', '', '', ''),
(108, '7R3F7H6', 'asdasda', 'MCQ', 'choiceC', 'asdas', 'dasdasd', 'yes', 'asdasd'),
(109, '7R3F7H6', 'asdasda', 'IDEN', 'yes', '', '', '', ''),
(110, '7R3F7H6', 'asdASDADAS', 'TOF', 'TRUE', '', '', '', ''),
(111, '5En4qi5', 'asfasfa', 'IDEN', 'yes', '', '', '', ''),
(112, '3FC8ZmH', 'ysd', 'TOF', 'TRUE', '', '', '', ''),
(113, '3FC8ZmH', 'yasdasda', 'MCQ', 'choiceD', 'asfafaf', 'asfasf', 'asdasf', 'yes'),
(114, '3FC8ZmH', 'asfasas', 'IDEN', 'yes', '', '', '', '');

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
('3FC8ZmH', 'new', 'default_img.jpg', 'PUBLIC', 'pans', 1, 0),
('5En4qi5', 'asdfasfas', 'default_img.jpg', 'PUBLIC', 'yans', 2, 0),
('7R3F7H6', 'someone', 'default_img.jpg', 'PUBLIC', 'yans', 14, 0),
('R2wHuhY', 'For adding score', 'default_img.jpg', 'PUBLIC', 'pans', 143, 0),
('UrYcn3x', 'for score', '65e29557323f80.70019434.png', 'PUBLIC', 'pans', 83, 0);

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
('3FC8ZmH', 'pans', 2),
('7R3F7H6', 'pans', 3),
('R2wHuhY', 'pans', 61),
('UrYcn3x', 'pans', 16),
('7R3F7H6', 'yans', 8),
('R2wHuhY', 'yans', 6);

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
('pans', '7R3F7H6', 0),
('pans', 'R2wHuhY', 0),
('pans', 'UrYcn3x', 0),
('yans', 'R2wHuhY', 0),
('yans', '7R3F7H6', 0),
('yans', 'UrYcn3x', 0),
('yans', '5En4qi5', 0),
('pans', '5En4qi5', 0),
('pans', '3FC8ZmH', 0);

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
  ADD PRIMARY KEY (`username`,`code`),
  ADD KEY `fk_quiz_scores_quiz_code` (`code`);

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
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

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
  ADD CONSTRAINT `fk_quiz_scores_quiz_code` FOREIGN KEY (`code`) REFERENCES `questions` (`quizcode`),
  ADD CONSTRAINT `fk_quiz_scores_username` FOREIGN KEY (`username`) REFERENCES `account` (`username`),
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
