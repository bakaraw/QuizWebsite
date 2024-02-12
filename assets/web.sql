-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 12, 2024 at 02:29 PM
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
-- Table structure for table `$4h4wjow`
--

CREATE TABLE `$4h4wjow` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `$4h4wjow`
--

INSERT INTO `$4h4wjow` (`question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `qid`) VALUES
('jorg', 'IDEN', '', '', '', '', '', 1),
('jorg', 'IDEN', '', '', '', '', '', 2),
('lolly', 'IDEN', 'job', '', '', '', '', 3),
('lami mag jakol', 'IDEN', 'blojab', '', '', '', '', 4),
('gwapo ko?', 'TOF', 'TRUE', '', '', '', '', 5),
('Gustokoburat', 'MCQ', 'choiceA', 'hello', 'hilo', 'hellow', 'helu', 6),
('siinu ako?', 'TOF', 'TRUE', '', '', '', '', 7),
('jacobo', 'MCQ', 'choiceD', '1', '2', '3', '4', 8),
('lotski', 'MCQ', 'choiceD', '1', '2', '3', '4', 9),
('awdwad', 'MCQ', 'choiceB', '1', '1', '1', '1', 10),
('awd', 'IDEN', 'adw', '', '', '', '', 11),
('kk', 'MCQ', 'choiceA', 'lolers', 'lols', '1', '2', 12),
('awd', 'IDEN', 'awd', '', '', '', '', 13),
('aqw', 'IDEN', 'aqw', '', '', '', '', 14),
('pinoy ako', 'MCQ', 'choiceB', '1', '2', '3', '4', 15),
('pinoy ako', 'MCQ', 'choiceB', '1', '2', '3', '4', 16),
('pinoy ako', 'IDEN', 'a', '', '', '', '', 17),
('abc', 'IDEN', 'abc', '', '', '', '', 18),
('zxc', 'IDEN', 'zxc', '', '', '', '', 19),
('awd', 'IDEN', 'awd', '', '', '', '', 20),
('awd', 'IDEN', 'awdddd', '', '', '', '', 21),
('awd', 'IDEN', 'awdddd', '', '', '', '', 22),
('132', 'IDEN', '123', '', '', '', '', 23),
('132', 'IDEN', '123', '', '', '', '', 24),
('jkl', 'IDEN', 'jkl', '', '', '', '', 25),
('awd', 'IDEN', '123', '', '', '', '', 26),
('awd', 'IDEN', 'awd', '', '', '', '', 27),
('awd', 'IDEN', 'awd', '', '', '', '', 28),
('123', 'IDEN', '123', '', '', '', '', 29),
('123', 'IDEN', '123', '', '', '', '', 30),
('123', 'IDEN', '123', '', '', '', '', 31),
('123', 'IDEN', '123', '', '', '', '', 32),
('123', 'IDEN', '123', '', '', '', '', 33),
('save', 'IDEN', 'save', '', '', '', '', 34),
('12', 'IDEN', '12', '', '', '', '', 35),
('2', 'IDEN', '2', '', '', '', '', 36),
('2', 'IDEN', '3', '', '', '', '', 37),
('12', 'IDEN', '2', '', '', '', '', 38),
('awd', 'IDEN', 'awd', '', '', '', '', 39),
('1231233', 'IDEN', '123', '', '', '', '', 40),
('123', 'IDEN', '123', '', '', '', '', 41),
('1233', 'IDEN', '1233', '', '', '', '', 42),
('123', 'IDEN', '123', '', '', '', '', 43),
('123', 'IDEN', '123', '', '', '', '', 44);

-- --------------------------------------------------------

--
-- Table structure for table `$5bhjokc`
--

CREATE TABLE `$5bhjokc` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `$8doz9wy`
--

CREATE TABLE `$8doz9wy` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `$9jk6kh3`
--

CREATE TABLE `$9jk6kh3` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `$13qyo97`
--

CREATE TABLE `$13qyo97` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `$48grc54`
--

CREATE TABLE `$48grc54` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `$48grc54`
--

INSERT INTO `$48grc54` (`question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `qid`) VALUES
('cookings', 'IDEN', '123', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `$85m4g49`
--

CREATE TABLE `$85m4g49` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `$85m4g49`
--

INSERT INTO `$85m4g49` (`question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `qid`) VALUES
('my idol', 'iden', '', '', '', '', '', 1),
('sting my idol', 'MCQ', '', '', '', '', '', 2),
('awd', 'IDEN', '', '', '', '', '', 3),
('hello', 'IDEN', '', '', '', '', '', 4),
('add question', 'IDEN', '', '', '', '', '', 5),
('save btn', 'IDEN', '', '', '', '', '', 6),
('save btn', 'TOF', '', '', '', '', '', 7),
('save btn', 'IDEN', '', '', '', '', '', 8);

-- --------------------------------------------------------

--
-- Table structure for table `$87h1swa`
--

CREATE TABLE `$87h1swa` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `$h5tgrnj`
--

CREATE TABLE `$h5tgrnj` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `$j6l2d0f`
--

CREATE TABLE `$j6l2d0f` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `$l6m2ego`
--

CREATE TABLE `$l6m2ego` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `$t0em9ok`
--

CREATE TABLE `$t0em9ok` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `$t0em9ok`
--

INSERT INTO `$t0em9ok` (`question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `qid`) VALUES
('123', 'IDEN', '123', '', '', '', '', 1),
('123', 'IDEN', '123', '', '', '', '', 2),
('b', 'IDEN', '123', '', '', '', '', 3),
('123', 'IDEN', '123', '', '', '', '', 4),
('bain bahog tae', 'MCQ', 'choiceB', '123', '123', '123', '123', 5),
('simple dimple', 'MCQ', 'choiceC', 'h', 'h', 'h', 'h', 6);

-- --------------------------------------------------------

--
-- Table structure for table `$u3zufn8`
--

CREATE TABLE `$u3zufn8` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `$ymrv0uj`
--

CREATE TABLE `$ymrv0uj` (
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL,
  `qid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `$ymrv0uj`
--

INSERT INTO `$ymrv0uj` (`question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `qid`) VALUES
('', 'iden', '', '', '', '', '', 1),
('wow', 'iden', '', '', '', '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(30) NOT NULL,
  `pass` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `pass`) VALUES
('Leandro', '$2y$10$pT6un6.d5fHb6BbluWJfEOy'),
('lean', '$2y$10$dssOUYZ.j7avQD9qKB22geA'),
('pupa', 'paninsoro'),
('pupa', 'paninsoro'),
('laiton', '$2y$10$aVbQR7jCtPdRIUwJtwijL.o'),
('ernest', '$2y$10$LCMDrd5CxJ/ETPyWkpIoa.u'),
('asdas', '$2y$10$GBsErAL.NbQQ.V.lQ1iuTe9'),
('asdasasdasd', '$2y$10$wN0ccRYUVA/Ac1AHyi4a4.Q'),
('asdasdasd', '$2y$10$IaeF21miH23gQoyPxxBncep'),
('asdasdasdasdasd', '$2y$10$LaXAUVRI4AoS1LOYLM29nen'),
('leanlean', '$2y$10$W31JSqiVImFDvo6VYetwdeV'),
('rey', '$2y$10$6g.jHRMQ5WX4f0zEnjSotOy'),
('cumming', '$2y$10$cqOJOtxQZO0ban902asEpOy'),
('long', '$2y$10$NUqhG8bwuIbegkdfjLasTOa'),
('otin', '$2y$10$SEsqt.8opv8zhLn7xTQTQ.P'),
('otindaku', 'otindaku'),
('lai', '$2y$10$AJ40R3MUVl9Eu.dcNz5A8.O'),
('laigh', '$2y$10$NwmSUIzUcaV0C/KHnS8NUuH'),
('laighton', '$2y$10$ERDO3g.FA1jBZzS8ekpov.v'),
('ss', '$2y$10$7ErHVYo4Wp6tAzZUDnjRzeL'),
('supahero', '$2y$10$BV1nGrldN4p956QaYDwSCOVseBiN1tZzQFzTnkfwz1JKzVFtRQEpO');

-- --------------------------------------------------------

--
-- Table structure for table `quizlisttable`
--

CREATE TABLE `quizlisttable` (
  `code` varchar(8) NOT NULL,
  `title` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `creator` varchar(255) NOT NULL,
  `visibility` varchar(8) NOT NULL,
  `ispublished` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizlisttable`
--

INSERT INTO `quizlisttable` (`code`, `title`, `thumbnail`, `creator`, `visibility`, `ispublished`) VALUES
('$13qyo97', 'jems', '', '', '', 0),
('$48grc54', 'barbecue', '', '', '', 0),
('$4h4wjow', 'jakoltv', '', '', '', 0),
('$5bhjokc', 'jak', '', '', '', 0),
('$85m4g49', 'boss dogs', '', '', '', 0),
('$87h1swa', 'shirogane', '', '', '', 0),
('$8doz9wy', 'salsalero', '', '', '', 0),
('$9jk6kh3', 'lols', '', '', '', 0),
('$9puahu8', 'salsalero', '', '', '', 0),
('$h5tgrnj', 'george', '', '', '', 0),
('$j6l2d0f', 'dura', '', '', '', 0),
('$l6m2ego', 'salsalani', '', '', '', 0),
('$t0em9ok', 'bain', '', '', '', 0),
('$u3zufn8', 'wowser', '', '', '', 0),
('$ymrv0uj', 'lols', '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `$4h4wjow`
--
ALTER TABLE `$4h4wjow`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$5bhjokc`
--
ALTER TABLE `$5bhjokc`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$8doz9wy`
--
ALTER TABLE `$8doz9wy`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$9jk6kh3`
--
ALTER TABLE `$9jk6kh3`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$13qyo97`
--
ALTER TABLE `$13qyo97`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$48grc54`
--
ALTER TABLE `$48grc54`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$85m4g49`
--
ALTER TABLE `$85m4g49`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$87h1swa`
--
ALTER TABLE `$87h1swa`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$h5tgrnj`
--
ALTER TABLE `$h5tgrnj`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$l6m2ego`
--
ALTER TABLE `$l6m2ego`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$t0em9ok`
--
ALTER TABLE `$t0em9ok`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$u3zufn8`
--
ALTER TABLE `$u3zufn8`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$ymrv0uj`
--
ALTER TABLE `$ymrv0uj`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `quizlisttable`
--
ALTER TABLE `quizlisttable`
  ADD PRIMARY KEY (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `$4h4wjow`
--
ALTER TABLE `$4h4wjow`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `$5bhjokc`
--
ALTER TABLE `$5bhjokc`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$8doz9wy`
--
ALTER TABLE `$8doz9wy`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$9jk6kh3`
--
ALTER TABLE `$9jk6kh3`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$13qyo97`
--
ALTER TABLE `$13qyo97`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$48grc54`
--
ALTER TABLE `$48grc54`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `$85m4g49`
--
ALTER TABLE `$85m4g49`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `$87h1swa`
--
ALTER TABLE `$87h1swa`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$h5tgrnj`
--
ALTER TABLE `$h5tgrnj`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$l6m2ego`
--
ALTER TABLE `$l6m2ego`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$t0em9ok`
--
ALTER TABLE `$t0em9ok`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `$u3zufn8`
--
ALTER TABLE `$u3zufn8`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$ymrv0uj`
--
ALTER TABLE `$ymrv0uj`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
