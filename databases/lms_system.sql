-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2023 at 08:35 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `homework_id` char(10) NOT NULL,
  `teacher_sid` char(10) NOT NULL,
  `sub_id` char(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `question` varchar(100) DEFAULT NULL,
  `time_limit` char(10) DEFAULT NULL,
  `date` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`homework_id`, `teacher_sid`, `sub_id`, `title`, `question`, `time_limit`, `date`) VALUES
('HW-3272535', 't80904', 's003', 'calculas', 'solve problems because math is a sequential field that builds on prior knowledge. The tricky part of', '30_day', '03/Mar'),
('HW-3700849', 't80904', 's003', 'algebra', 'Algebra is the part of mathematics that helps represent problems or situations in the form of mathem', '30_day', '03/Mar'),
('HW-3908265', 't01862', 's001', 'artificial inteligence', 'white a paragraph about good side of artificial inteligence.', '3_day', '03/Mar');

-- --------------------------------------------------------

--
-- Table structure for table `homework_class`
--

CREATE TABLE `homework_class` (
  `homework_id` char(15) NOT NULL,
  `class_no` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homework_class`
--

INSERT INTO `homework_class` (`homework_id`, `class_no`) VALUES
('HW-3908265', 'c005'),
('HW-3908265', 'c006'),
('HW-3908265', 'c007'),
('HW-5225719', 'c005'),
('HW-5225719', 'c006'),
('HW-5225719', 'c007'),
('HW-9189276', 'c005'),
('HW-9189276', 'c006'),
('HW-9189276', 'c007'),
('HW-3272535', 'c005'),
('HW-3272535', 'c006'),
('HW-3272535', 'c007'),
('HW-3700849', 'c005'),
('HW-3700849', 'c006'),
('HW-3700849', 'c007');

-- --------------------------------------------------------

--
-- Table structure for table `homework_file`
--

CREATE TABLE `homework_file` (
  `homework_id` char(10) NOT NULL,
  `file_name` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `res_id` char(10) NOT NULL,
  `title` varchar(150) NOT NULL,
  `info` varchar(200) DEFAULT NULL,
  `sub_id` char(10) NOT NULL,
  `teacher_sid` char(10) DEFAULT NULL,
  `date` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`res_id`, `title`, `info`, `sub_id`, `teacher_sid`, `date`) VALUES
('res01966', 'calculas', 'It is a vast field of study; hence in this article, we will look into solving questions based on basic calculus concepts, such as limits, continuity,', 's003', 't80904', '03/Mar'),
('res22195', 'himalayan mountain', 'Where is the Himalayan mountains?\r\nGeography: The Himalayas stretch across the northeastern portion of India. They cover approximately 1,500 mi (2,400 km) and pass through the nations of India, Pakist', 's005', 't80904', '03/Mar'),
('res27015', 'Good side of Ai', 'The Future of AI: Cyber Security Experts Discuss Next Steps for Artificial Intelligence. What is Artificial Intelligence? An Article by Experts Robert Fay and Wallace Trenholm. Leading Research. Globa', 's001', 't01862', '03/Mar'),
('res72950', 'Kala Wewa Lake', 'Kala Wewa Lake. Kala Wewa Lake and Reservoir is the biggest lake in Sri Lanka. The lake has a rich history – it was built by King Datusena in the year 307 B.C. Having a capacity of 123 million cubic m', 's002', 't80904', '03/Mar'),
('res73152', 'bad side of Ai', 'Biases are also often present in AI datasets and have the potential of spreading and reinforcing harmful stereotypes. Surveillance technology is also impacting human rights. AI is also being used to m', 's001', 't01862', '03/Mar'),
('res79794', 'algebra', 'Algebra problems available here with solutions for class 6, 7 and 8 students. Learn to solve algebraic expressions with the help of formulas and examples ...', 's003', 't80904', '03/Mar'),
('res94388', 'Caspian Sea', 'The Caspian Sea is not only the largest lake in Asia, but also the largest in the world. Followed by the Baikal which is considered the deepest and the largest freshwater lake in the world.', 's005', 't80904', '03/Mar');

-- --------------------------------------------------------

--
-- Table structure for table `resource_class`
--

CREATE TABLE `resource_class` (
  `res_id` char(10) DEFAULT NULL,
  `class_no` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resource_class`
--

INSERT INTO `resource_class` (`res_id`, `class_no`) VALUES
('res27015', 'c005'),
('res27015', 'c006'),
('res27015', 'c007'),
('res73152', 'c005'),
('res73152', 'c006'),
('res73152', 'c007'),
('res79794', 'c005'),
('res79794', 'c006'),
('res79794', 'c007'),
('res01966', 'c005'),
('res01966', 'c006'),
('res01966', 'c007'),
('res22195', 'c005'),
('res22195', 'c006'),
('res22195', 'c007'),
('res72950', 'c005'),
('res72950', 'c006'),
('res72950', 'c007'),
('res94388', 'c005'),
('res94388', 'c006'),
('res94388', 'c007');

-- --------------------------------------------------------

--
-- Table structure for table `resource_file`
--

CREATE TABLE `resource_file` (
  `res_id` char(10) DEFAULT NULL,
  `res_url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` char(10) NOT NULL,
  `sub_id` char(10) NOT NULL,
  `link` varchar(100) NOT NULL,
  `start_time` char(10) NOT NULL,
  `end_time` char(10) NOT NULL,
  `teacher_id` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room_class`
--

CREATE TABLE `room_class` (
  `room_id` char(10) NOT NULL,
  `class_no` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_homework`
--

CREATE TABLE `student_homework` (
  `homework_id` char(15) NOT NULL,
  `student_sid` char(10) NOT NULL,
  `answer` varchar(100) DEFAULT NULL,
  `status` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_homework`
--

INSERT INTO `student_homework` (`homework_id`, `student_sid`, `answer`, `status`) VALUES
('HW-3908265', 'st22100', 'Throughout the years, AI has progressed from simple Machine Learning algorithms to advanced machine ', 'pending'),
('HW-3272535', 'st22100', 'fuck all ', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `student_homework_file`
--

CREATE TABLE `student_homework_file` (
  `homework_id` char(10) NOT NULL,
  `file_name` char(20) NOT NULL,
  `student_sid` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`homework_id`);

--
-- Indexes for table `homework_file`
--
ALTER TABLE `homework_file`
  ADD PRIMARY KEY (`homework_id`),
  ADD UNIQUE KEY `file_name` (`file_name`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
