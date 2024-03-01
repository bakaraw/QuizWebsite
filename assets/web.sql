-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 11:39 AM
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
('$2y$10$YTWSjlkzq0sqHY.txiEWsOFDT/2e1xKCAfbsECwYiOOIvPz33EbLe', 'lean'),
('$2y$10$SBIf07PuOy.zOcZjsA3m3uVr1CEp5x0f/v.d.eZY7LK8fqKpJkpS.', 'pans'),
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
(91, 'cSHwszQ', 'is it?', 'TOF', 'TRUE', '', '', '', ''),
(92, 'E4XufQk', 'awww', 'TOF', 'TRUE', '', '', '', ''),
(93, 'NVGg60d', 'yesss', 'TOF', 'TRUE', '', '', '', ''),
(94, 'l06ZoYv', 'yesss', 'TOF', 'TRUE', '', '', '', ''),
(95, 'E1dANP0', 'yes', 'IDEN', 'yes', '', '', '', ''),
(96, 'E1dANP0', 'yes', 'MCQ', 'choiceA', 'yes', 'asda', 'dasdasda', 'dasdasd'),
(97, 'E1dANP0', 'yes', 'TOF', 'TRUE', '', '', '', '');

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
  `views` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizlisttable`
--

INSERT INTO `quizlisttable` (`code`, `title`, `thumbnail`, `accessibility`, `creator`, `views`) VALUES
('cSHwszQ', 'for score', '65e19a57a646b9.31009452.png', 'PUBLIC', 'yans', 26),
('E1dANP0', 'score', 'default_img.jpg', 'PUBLIC', 'yawa', 10),
('E4XufQk', 'pans for title', 'default_img.jpg', 'PUBLIC', 'pans', 1),
('l06ZoYv', 'titi', 'default_img.jpg', 'PUBLIC', 'yawa', 1),
('NVGg60d', 'lean', 'default_img.jpg', 'PUBLIC', 'lean', 5);

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
('cSHwszQ', 'yawa', NULL),
('cSHwszQ', 'yawa', 1),
('cSHwszQ', 'yawa', 1),
('E1dANP0', 'yawa', 1),
('E1dANP0', 'yawa', 0),
('E1dANP0', 'pans', NULL),
('E1dANP0', 'pans', NULL),
('E1dANP0', 'pans', 0),
('cSHwszQ', 'pans', 0),
('E1dANP0', 'pans', 0),
('E1dANP0', 'lean', 1);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
