-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 02, 2024 at 01:55 PM
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
  `username` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL
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
('ss', '$2y$10$7ErHVYo4Wp6tAzZUDnjRzeL');

-- --------------------------------------------------------

--
-- Table structure for table `quizlisttable`
--

CREATE TABLE `quizlisttable` (
  `code` varchar(7) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `creator` varchar(255) NOT NULL,
  `visibility` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizlisttable`
--

INSERT INTO `quizlisttable` (`code`, `title`, `thumbnail`, `creator`, `visibility`) VALUES
('3Pnq33i', 'otindakulonganisa', '', '', ''),
('ILQ2i3L', 'ako si thor', '', '', ''),
('zOVomhP', 'torjack', '', '', ''),
('zzzz', 'hello', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quizlisttable`
--
ALTER TABLE `quizlisttable`
  ADD PRIMARY KEY (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
