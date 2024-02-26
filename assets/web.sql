-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2024 at 08:12 AM
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
('$2y$10$VXV61QGzVzi2nQTk7jyvqe5FhvA2/KcLVBxw/KVNHWkR8DIX4QcoG', 'laiton'),
('$2y$10$LeGX9RNkiEj.2PgGLBUD2OQJWaFtn2Pg8K5lV1jhTykMDVikgB4XK', 'lean'),
('$2y$10$LF2JfunAwwn0jWTg6izAzuOsRAf6XPnMqthLNzwPo0QBUJk1ndSKG', 'pans');

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
(52, 'y3Nsxne', 'is it?', 'TOF', 'TRUE', '', '', '', ''),
(55, 'xqzHFOo', 'Of course its true?', 'TOF', 'FALSE', '', '', '', ''),
(56, 'GNncDlZ', 'd oi', 'MCQ', 'choiceB', 'yes', 'no', 'what', 'ha'),
(57, 'bth4e37', 'is it?', 'TOF', 'TRUE', '', '', '', ''),
(58, 'ctCuYNQ', 'yesss', 'IDEN', 'no', '', '', '', '');

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
('bth4e37', 'sample', '65dae690439182.42432150.png', 'PUBLIC', 'laiton', 3),
('ctCuYNQ', 'sample for private', 'default_img.jpg', 'PRIVATE', 'laiton', 0),
('GNncDlZ', 'pubic', '65dacca4de9f65.31747546.png', 'PUBLIC', 'pans', 2),
('oUxX7PG', 'private', 'default_img.jpg', 'PRIVATE', 'pans', 0),
('xqzHFOo', 'new', 'default_img.jpg', 'PRIVATE', 'pans', 0),
('y3Nsxne', 'new lean', '65dac26ac22716.75628370.jpg', 'PUBLIC', 'lean', 1),
('zLTOvai', 'sampl', 'default_img.jpg', 'PRIVATE', 'pans', 0);

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
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

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
