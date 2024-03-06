-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2024 at 07:41 AM
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
('$2y$10$tEjZQpWgN4Vtdz8ITPtWQeQ8rkTuUcZ9Eiq4rFLRxKOnMdKpqsnse', 'QuizHero'),
('$2y$10$e3mp8oS91pQgF/uKluanYu8WxbmMQJpCB6j1WHEgvjOzntC/Q1uw6', 'Trojan'),
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
(122, 'K49cIav', '\"Pac-Man\" was first released in the 1980s as an arcade game and later became one of the most recognizable and iconic video game characters.', 'TOF', 'TRUE', '', '', '', ''),
(123, 'K49cIav', 'The popular game \"The Legend of Zelda: Breath of the Wild\" was released for the Nintendo Switch before the Wii U.', 'TOF', 'TRUE', '', '', '', ''),
(124, 'K49cIav', 'The video game \"Minecraft\" was initially created by Markus Persson and was later developed and published by Mojang Studios.\r\n\r\n', 'TOF', 'TRUE', '', '', '', ''),
(125, 'K49cIav', 'The character \"Mario\" first appeared in the game \"Super Mario Bros.\" released in 1985.', 'TOF', 'TRUE', '', '', '', ''),
(126, 'K49cIav', 'The game \"Fortnite\" was originally released as a single-player, cooperative, zombie survival game.', 'TOF', 'TRUE', '', '', '', ''),
(127, 'QHLEzEc', 'What does the acronym \"HTML\" stand for in web development?', 'MCQ', 'choiceB', 'Hyperlink and Text Markup Language', 'Hypertext Markup Language', 'High-Level Text Manipulation Language', 'Hyper Transferable Markup Linguistics'),
(128, 'QHLEzEc', 'What programming language was developed by Microsoft and is often used for creating dynamic web pages and web applications?', 'MCQ', 'choiceC', 'Java', 'Python', 'C#', 'Ruby'),
(129, 'QHLEzEc', 'In JavaScript, what is the purpose of the \"document.getElementById()\" function?', 'MCQ', 'choiceA', 'Access a specific HTML element by its ID', 'Retrieve the document\'s URL', 'Create a new HTML document', 'Style a group of HTML elements'),
(130, 'QHLEzEc', 'What does the acronym \"CSS\" stand for in web development?', 'MCQ', 'choiceC', 'Computer Style Sheets', 'Centralized Style System', 'Cascading Style Sheets', 'Code Syntax System'),
(131, 'QHLEzEc', 'In Python, what is the purpose of the \"elif\" keyword?', 'MCQ', 'choiceD', 'Define a new function', 'Execute a block of code only if the specified condition is true', 'Represent a loop in Python', 'Combine multiple conditions in an \"if-else\" statement'),
(132, 'cp9KL08', 'Known as the \"Sublime Paralytic\" and the \"Brains of the Katipunan,\" this hero wrote the constitution for the first Philippine Republic. Who is he?', 'IDEN', 'Apolinario Mabini', '', '', '', ''),
(133, 'cp9KL08', 'This hero, also known as the \"Great Plebeian,\" founded the Katipunan, a secret society that played a crucial role in the Philippine Revolution against Spanish colonization. Who is he?', 'IDEN', 'Andres Bonifacio', '', '', '', ''),
(134, 'cp9KL08', 'A revolutionary leader and military general, he is often referred to as the \"Supremo\" and played a key role in initiating the Philippine Revolution in 1896. Who is this hero?', 'IDEN', 'Andres Bonifacio', '', '', '', ''),
(135, 'cp9KL08', 'Known as the \"Mother of the Philippine Revolution,\" she provided support and care to the Katipunan and its members. What is her name?', 'IDEN', 'Gregoria de Jesus', '', '', '', ''),
(136, 'cp9KL08', 'This hero, also known as the \"Brains of the Katipunan,\" was a writer, lawyer, and nationalistic leader. He authored \"Noli Me Tangere\" and \"El Filibusterismo.\" Who is he?', 'IDEN', 'Jose Rizal', '', '', '', ''),
(137, '3oOkt09', 'Who is credited with the invention of the telephone in 1876?', 'MCQ', 'choiceB', 'Thomas Edison', 'Alexander Graham Bell', 'Nikola Tesla', 'Samuel Morse'),
(138, '3oOkt09', 'In what year did Sir Isaac Newton publish his groundbreaking work \"Philosophiæ Naturalis Principia Mathematica,\" which laid the foundation for classical mechanics?', 'MCQ', 'choiceB', '1605', '1687', '1752', '1810'),
(139, '3oOkt09', 'Which scientist is known for the discovery of penicillin, a breakthrough in the development of antibiotics?', 'MCQ', 'choiceB', 'Louis Pasteur', 'Alexander Fleming', 'Maire Curie', 'Jonas Salk'),
(140, '3oOkt09', 'What everyday item did Swiss engineer George de Mestral invent in the 1940s after observing burrs sticking to his clothing during a walk?', 'MCQ', 'choiceA', 'Velcro', 'Zipper', 'Safety Pins', 'Buttons'),
(141, '3oOkt09', 'Which inventor is associated with the development of the World Wide Web in the late 20th century?', 'MCQ', 'choiceB', 'Bill Gates', 'Tim Berners-Lee', 'Steve Jobs', 'Mark Zuckerberg'),
(142, 'xtHzfol', 'In which city is the main campus of the University of Mindanao located?', 'MCQ', 'choiceA', 'Davao City', 'Cagayan De Oro City', 'General Santos City', 'Tagum City'),
(143, 'xtHzfol', 'What year was the University of Mindanao established?', 'IDEN', '1945', '', '', '', ''),
(144, 'xtHzfol', 'No Permit, No Exam', 'TOF', 'TRUE', '', '', '', '');

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
('3oOkt09', 'Famous Inventions and Discoveries', '65e80e94c13749.68499177.jpg', 'PRIVATE', 'QuizHero', 0, -1),
('cp9KL08', 'Philippine Heroes', '65e80d85294254.60117303.jpg', 'PUBLIC', 'QuizHero', 0, -1),
('K49cIav', 'Video Game True or False', '65e80bd5b941e5.48291205.jpg', 'PUBLIC', 'QuizHero', 1, -1),
('QHLEzEc', 'Coding Trivia', '65e80ce167f328.89352583.jpg', 'PUBLIC', 'QuizHero', 1, 1),
('xtHzfol', 'UM Quiz', '65e80f90724a33.69436659.png', 'PUBLIC', 'QuizHero', 0, 2);

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
('Trojan', 'QHLEzEc', 1),
('Trojan', 'K49cIav', -1);

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
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

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
