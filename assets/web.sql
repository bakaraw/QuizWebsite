-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2024 at 12:15 AM
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
-- Table structure for table `$0l62o66`
--

CREATE TABLE `$0l62o66` (
  `qid` int(11) NOT NULL,
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `$0l62o66`
--

INSERT INTO `$0l62o66` (`qid`, `question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`) VALUES
(1, 'Windows 7 is the latest OS', 'TOF', 'FALSE', '', '', '', '');

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
-- Table structure for table `$5q7d5dq`
--

CREATE TABLE `$5q7d5dq` (
  `qid` int(11) NOT NULL,
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `$5q7d5dq`
--

INSERT INTO `$5q7d5dq` (`qid`, `question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`) VALUES
(2, 'What is the latest OS for windows users?', 'IDEN', 'Windows 11', '', '', '', ''),
(3, 'The oldest operating system for Windows?', 'MCQ', 'choiceA', 'Windows 1.0', 'Windows XP', 'Windows VISTA', 'Windows ni Laiton');

-- --------------------------------------------------------

--
-- Table structure for table `$6rdrqkd`
--

CREATE TABLE `$6rdrqkd` (
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
-- Dumping data for table `$6rdrqkd`
--

INSERT INTO `$6rdrqkd` (`question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `qid`) VALUES
('lami ang bilat?', 'TOF', 'FALSE', '', '', '', '', 1);

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
-- Table structure for table `$89kxotk`
--

CREATE TABLE `$89kxotk` (
  `qid` int(11) NOT NULL,
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `$89kxotk`
--

INSERT INTO `$89kxotk` (`qid`, `question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`) VALUES
(1, 'asff', 'TOF', 'FALSE', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `$b1djkvr`
--

CREATE TABLE `$b1djkvr` (
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
-- Dumping data for table `$b1djkvr`
--

INSERT INTO `$b1djkvr` (`question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `qid`) VALUES
('okay', 'TOF', 'FALSE', '', '', '', '', 1),
('Some some', 'TOF', 'TRUE', '', '', '', '', 2),
('Otin', 'TOF', 'FALSE', '', '', '', '', 3);

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
-- Table structure for table `$h66aqn6`
--

CREATE TABLE `$h66aqn6` (
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
-- Table structure for table `$hh8wbod`
--

CREATE TABLE `$hh8wbod` (
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
-- Table structure for table `$l0zquqs`
--

CREATE TABLE `$l0zquqs` (
  `qid` int(11) NOT NULL,
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
-- Table structure for table `$lbv08h1`
--

CREATE TABLE `$lbv08h1` (
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
-- Dumping data for table `$lbv08h1`
--

INSERT INTO `$lbv08h1` (`question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `qid`) VALUES
('Sometrinhf', 'IDEN', 'yawels', '', '', '', '', 1),
('yawels', 'IDEN', 'pisti', '', '', '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `$qdri909`
--

CREATE TABLE `$qdri909` (
  `qid` int(11) NOT NULL,
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `$qdri909`
--

INSERT INTO `$qdri909` (`qid`, `question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`) VALUES
(1, 'asdasda', 'MCQ', 'choiceD', 'asdasd', 'asda', 'sdasd', 'fff');

-- --------------------------------------------------------

--
-- Table structure for table `$sjsotrg`
--

CREATE TABLE `$sjsotrg` (
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
-- Dumping data for table `$sjsotrg`
--

INSERT INTO `$sjsotrg` (`question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `qid`) VALUES
('yameteeee', 'TOF', 'FALSE', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `$smdrifv`
--

CREATE TABLE `$smdrifv` (
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
-- Dumping data for table `$smdrifv`
--

INSERT INTO `$smdrifv` (`question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `qid`) VALUES
('This is something', 'TOF', 'TRUE', '', '', '', '', 1);

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
-- Table structure for table `$txiomua`
--

CREATE TABLE `$txiomua` (
  `qid` int(11) NOT NULL,
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
-- Table structure for table `$w1lodxa`
--

CREATE TABLE `$w1lodxa` (
  `qid` int(11) NOT NULL,
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `$w1lodxa`
--

INSERT INTO `$w1lodxa` (`qid`, `question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`) VALUES
(1, 'Otin', 'TOF', 'FALSE', '', '', '', ''),
(2, 'otik dako', 'TOF', 'TRUE', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `$whvpqil`
--

CREATE TABLE `$whvpqil` (
  `qid` int(11) NOT NULL,
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
-- Table structure for table `$x087p5c`
--

CREATE TABLE `$x087p5c` (
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
-- Dumping data for table `$x087p5c`
--

INSERT INTO `$x087p5c` (`question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`, `qid`) VALUES
('Lami ba ang bilat?', 'TOF', 'TRUE', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `$yd4qxq3`
--

CREATE TABLE `$yd4qxq3` (
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
-- Table structure for table `$za7oqhg`
--

CREATE TABLE `$za7oqhg` (
  `qid` int(11) NOT NULL,
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `$za7oqhg`
--

INSERT INTO `$za7oqhg` (`qid`, `question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`) VALUES
(1, 'asdasda', 'TOF', 'TRUE', '', '', '', ''),
(2, 'otind dako', 'TOF', 'FALSE', '', '', '', ''),
(3, 'dd', 'TOF', 'TRUE', '', '', '', ''),
(4, 'asdasd', 'TOF', 'FALSE', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `$zw1qh6z`
--

CREATE TABLE `$zw1qh6z` (
  `qid` int(11) NOT NULL,
  `question` text NOT NULL,
  `questiontype` text NOT NULL,
  `answer` text NOT NULL,
  `choiceA` text NOT NULL,
  `choiceB` text NOT NULL,
  `choiceC` text NOT NULL,
  `choiceD` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `$zw1qh6z`
--

INSERT INTO `$zw1qh6z` (`qid`, `question`, `questiontype`, `answer`, `choiceA`, `choiceB`, `choiceC`, `choiceD`) VALUES
(1, 'is it bilat good?', 'TOF', 'TRUE', '', '', '', '');

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
('$2y$10$gUXmDYLGxbTW4p5B8HSuJuPGaB0ckpTXEgMGihpJTFpgvtDJpql/u', 'otin');

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
('$qdri90', 'otni', '', '', 'otin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `$0l62o66`
--
ALTER TABLE `$0l62o66`
  ADD PRIMARY KEY (`qid`);

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
-- Indexes for table `$5q7d5dq`
--
ALTER TABLE `$5q7d5dq`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$6rdrqkd`
--
ALTER TABLE `$6rdrqkd`
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
-- Indexes for table `$89kxotk`
--
ALTER TABLE `$89kxotk`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$b1djkvr`
--
ALTER TABLE `$b1djkvr`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$h5tgrnj`
--
ALTER TABLE `$h5tgrnj`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$h66aqn6`
--
ALTER TABLE `$h66aqn6`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$hh8wbod`
--
ALTER TABLE `$hh8wbod`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$l0zquqs`
--
ALTER TABLE `$l0zquqs`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$l6m2ego`
--
ALTER TABLE `$l6m2ego`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$lbv08h1`
--
ALTER TABLE `$lbv08h1`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$qdri909`
--
ALTER TABLE `$qdri909`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$sjsotrg`
--
ALTER TABLE `$sjsotrg`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$smdrifv`
--
ALTER TABLE `$smdrifv`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$t0em9ok`
--
ALTER TABLE `$t0em9ok`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$txiomua`
--
ALTER TABLE `$txiomua`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$u3zufn8`
--
ALTER TABLE `$u3zufn8`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$w1lodxa`
--
ALTER TABLE `$w1lodxa`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$whvpqil`
--
ALTER TABLE `$whvpqil`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$x087p5c`
--
ALTER TABLE `$x087p5c`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$yd4qxq3`
--
ALTER TABLE `$yd4qxq3`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$ymrv0uj`
--
ALTER TABLE `$ymrv0uj`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$za7oqhg`
--
ALTER TABLE `$za7oqhg`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `$zw1qh6z`
--
ALTER TABLE `$zw1qh6z`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD UNIQUE KEY `username_2` (`username`);

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
-- AUTO_INCREMENT for table `$0l62o66`
--
ALTER TABLE `$0l62o66`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `$5q7d5dq`
--
ALTER TABLE `$5q7d5dq`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `$6rdrqkd`
--
ALTER TABLE `$6rdrqkd`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `$89kxotk`
--
ALTER TABLE `$89kxotk`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `$b1djkvr`
--
ALTER TABLE `$b1djkvr`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `$h66aqn6`
--
ALTER TABLE `$h66aqn6`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$hh8wbod`
--
ALTER TABLE `$hh8wbod`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$l0zquqs`
--
ALTER TABLE `$l0zquqs`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$lbv08h1`
--
ALTER TABLE `$lbv08h1`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `$qdri909`
--
ALTER TABLE `$qdri909`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `$sjsotrg`
--
ALTER TABLE `$sjsotrg`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `$smdrifv`
--
ALTER TABLE `$smdrifv`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `$txiomua`
--
ALTER TABLE `$txiomua`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$w1lodxa`
--
ALTER TABLE `$w1lodxa`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `$whvpqil`
--
ALTER TABLE `$whvpqil`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$x087p5c`
--
ALTER TABLE `$x087p5c`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `$yd4qxq3`
--
ALTER TABLE `$yd4qxq3`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `$za7oqhg`
--
ALTER TABLE `$za7oqhg`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `$zw1qh6z`
--
ALTER TABLE `$zw1qh6z`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quizlisttable`
--
ALTER TABLE `quizlisttable`
  ADD CONSTRAINT `fk_username` FOREIGN KEY (`creator`) REFERENCES `account` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
