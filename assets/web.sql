-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 23, 2024 at 05:58 AM
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
(24, 'TKGstEe', '132', 'IDEN', '1', '', '', '', ''),
(25, 'r4XNJhu', 'utok', 'IDEN', '1', '', '', '', ''),
(26, '$rahnyz', '123', 'IDEN', '123', '', '', '', ''),
(28, 'LrUXQpI', 'raxa', 'IDEN', '123', '', '', '', ''),
(29, 'JlwYuaG', '13', 'IDEN', '13', '', '', '', ''),
(30, 'Tm0nNDF', '123', 'IDEN', '123', '', '', '', ''),
(31, 'JwJcnre', '12', 'MCQ', 'choiceC', '1', '2', '3', '4'),
(32, 'JwJcnre', 'shit lami', 'IDEN', '123', '', '', '', ''),
(33, 'CbPmbWi', '123', 'IDEN', '1', '', '', '', ''),
(34, 'CbPmbWi', '123', 'IDEN', '123', '', '', '', ''),
(35, 'CbPmbWi', '123', 'IDEN', '123', '', '', '', ''),
(36, 'gCvqjb6', '12', 'IDEN', '123', '', '', '', ''),
(37, 'gCvqjb6', '123', 'IDEN', '123', '', '', '', ''),
(38, '9Kbw46i', '123', 'IDEN', '222', '', '', '', ''),
(39, '9Kbw46i', 'shit', 'IDEN', '123', '', '', '', ''),
(40, '9Kbw46i', 'bilatize', 'MCQ', 'choiceC', '123', '123', '123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `quizlisttable`
--

CREATE TABLE `quizlisttable` (
  `code` varchar(7) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `accessibility` varchar(8) NOT NULL,
  `creator` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizlisttable`
--

INSERT INTO `quizlisttable` (`code`, `title`, `thumbnail`, `accessibility`, `creator`) VALUES
('$5ayyt2', '123', '', '', 'shit'),
('$bt06x2', 'kogmix', '', '', 'shit'),
('$qdri90', 'otni', '', '', 'otin'),
('$rahnyz', 'laighton', '', '', 'shit'),
('$xt7lso', '123', '', '', 'shit'),
('3NZ08WH', 'loklok', '', '', 'shit'),
('3yqr0Bv', '323', '', '', 'shit'),
('58aSWI2', 'shitz', '', '', 'shit'),
('7MT9MMo', '123321', '65d80048557394.77320454.png', 'PRIVATE', 'shit'),
('9Kbw46i', 'koing', '65d82405d5d652.86073763.png', 'PRIVATE', 'shit'),
('c1z14P7', 'uloleers', '', 'PUBLIC', 'shit'),
('CbPmbWi', 'skwembols', '', 'PRIVATE', 'shit'),
('CesVxAr', '321go', '65d802d394b301.74791797.png', 'PRIVATE', 'shit'),
('DYvchlq', '123', '', 'PUBLIC', 'shit'),
('Eu4eoh1', 'why are you gay?', '', 'PUBLIC', 'shit'),
('fITcsLx', 'shit', '', '', 'shit'),
('gCvqjb6', 'serverside monster', '', 'PRIVATE', 'shit'),
('JlwYuaG', 'copy2', '', 'PUBLIC', 'shit'),
('JwJcnre', 'corykoy', '', 'PRIVATE', 'shit'),
('LrUXQpI', 'public', '', 'PUBLIC', 'shit'),
('MFKmYSV', 'gapnguoot', '', 'PRIVATE', 'shit'),
('o0d5HRY', 'new Quiz', '', '', 'shit'),
('PsPOwr8', 'gabokol', '65d7fd38703f23.91367010.jpg', 'PUBLIC', 'shit'),
('r4XNJhu', '123', '', '', 'shit'),
('r8ZmkDI', '12211', '', 'PUBLIC', 'shit'),
('sPLLcM0', 'itlog ni bain', '', '', 'shit'),
('TKGstEe', 'shitzu', '', '', 'shit'),
('Tm0nNDF', 'akos kay gay', '', 'PUBLIC', 'shit'),
('U71OhnF', 'si god na bahala', '', '', 'shit'),
('xtKvduA', 'shotgun2', '65d8062ea7d187.73708020.png', 'PRIVATE', 'shit'),
('Z0WieHu', 'gabukol', '', 'PRIVATE', 'shit');

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
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
