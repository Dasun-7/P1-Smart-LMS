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
-- Database: `lms_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_no` char(10) NOT NULL,
  `class_name` char(50) NOT NULL,
  `homeroom_teacher` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_no`, `class_name`, `homeroom_teacher`) VALUES
('c002', '10-a', NULL),
('c004', '10-d', NULL),
('c005', '11-a', NULL),
('c006', '11-b', NULL),
('c007', '11-c', NULL),
('c008', '12-a2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `system_sid` char(10) NOT NULL,
  `indexno` char(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`system_sid`, `indexno`, `password`, `name`, `email`) VALUES
('st11865', 'st011', '1234', 'harry maguir', ''),
('st16018', 'st030', 'iman', 'iman gandzi', ''),
('st20559', 'st013', '1234', 'kylian mbappe', ''),
('st21407', 'st006', '1234', 'suzune horikita', ''),
('st22100', 'st001', 'dadasun', 'dasun sathsara', 'dsathsara40@gmail.com'),
('st33381', 'st010', '1234', 'naruto uzumaki', ''),
('st63144', 'st012', '1234', 'marcus rashford', ''),
('st74558', 'st014', '1234', 'erling haaland', ''),
('st90370', 'st008', '1234', 'ayanokoji kiyotaka', ''),
('st95691', 'st009', '1324', 'oreki hautaro', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_class`
--

CREATE TABLE `student_class` (
  `student_sid` char(10) DEFAULT NULL,
  `class_no` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_class`
--

INSERT INTO `student_class` (`student_sid`, `class_no`) VALUES
('st22100', 'c007'),
('st96056', 'c002'),
('st62937', 'c002'),
('st71624', 'c007'),
('st21407', 'c007'),
('st90370', 'c007'),
('st95691', 'c007'),
('st33381', 'c007'),
('st11865', 'c007'),
('st63144', 'c007'),
('st20559', 'c007'),
('st74558', 'c007'),
('st16018', 'c002');

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

CREATE TABLE `student_subject` (
  `student_sid` char(10) NOT NULL,
  `sub_id` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_subject`
--

INSERT INTO `student_subject` (`student_sid`, `sub_id`) VALUES
('st22100', 's006'),
('st22100', 's002'),
('st22100', 's005'),
('st22100', 's003'),
('st22100', 's007'),
('st22100', 's001'),
('st22100', 's004'),
('st96056', 's006'),
('st96056', 's002'),
('st96056', 's005'),
('st96056', 's003'),
('st96056', 's007'),
('st96056', 's001'),
('st96056', 's004'),
('st62937', 's006'),
('st62937', 's002'),
('st62937', 's005'),
('st62937', 's003'),
('st62937', 's007'),
('st62937', 's001'),
('st62937', 's004'),
('st71624', 's006'),
('st71624', 's002'),
('st71624', 's005'),
('st71624', 's003'),
('st71624', 's007'),
('st71624', 's001'),
('st71624', 's004'),
('st21407', 's006'),
('st21407', 's002'),
('st21407', 's005'),
('st21407', 's003'),
('st21407', 's007'),
('st21407', 's001'),
('st21407', 's004'),
('st90370', 's006'),
('st90370', 's002'),
('st90370', 's005'),
('st90370', 's003'),
('st90370', 's007'),
('st90370', 's001'),
('st90370', 's004'),
('st95691', 's006'),
('st95691', 's002'),
('st95691', 's005'),
('st95691', 's003'),
('st95691', 's007'),
('st95691', 's001'),
('st95691', 's004'),
('st33381', 's006'),
('st33381', 's002'),
('st33381', 's005'),
('st33381', 's003'),
('st33381', 's007'),
('st33381', 's001'),
('st33381', 's004'),
('st11865', 's006'),
('st11865', 's002'),
('st11865', 's005'),
('st11865', 's003'),
('st11865', 's007'),
('st11865', 's001'),
('st11865', 's004'),
('st63144', 's006'),
('st63144', 's002'),
('st63144', 's005'),
('st63144', 's003'),
('st63144', 's007'),
('st63144', 's001'),
('st63144', 's004'),
('st20559', 's006'),
('st20559', 's002'),
('st20559', 's005'),
('st20559', 's003'),
('st20559', 's007'),
('st20559', 's001'),
('st20559', 's004'),
('st74558', 's006'),
('st74558', 's002'),
('st74558', 's005'),
('st74558', 's003'),
('st74558', 's007'),
('st74558', 's001'),
('st74558', 's004'),
('st16018', 's002'),
('st16018', 's005'),
('st16018', 's001');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` char(10) NOT NULL,
  `sub_name` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `sub_name`) VALUES
('s006', 'buddhisum'),
('s002', 'english'),
('s005', 'geogropy'),
('s003', 'maths'),
('s007', 'music'),
('s001', 'science'),
('s004', 'sinhala');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `system_tid` char(10) NOT NULL,
  `teacher_id` char(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`system_tid`, `teacher_id`, `password`, `name`, `email`) VALUES
('t01862', 'th001', '1234', 'Nicolo tesla', 'Nicolotesla@gmail.com'),
('t15537', 'th004', '1234', 'gojo satoru', 'Strongestsoucerer@gmai.com'),
('t26846', 'th1010', '1234', 'lionel messi', ''),
('t41089', 'th006', '1234', 'suguru geto', ''),
('t48408', 'th003', '1234', 'Madara uchiha', 'gostofuchihas@gmail.com'),
('t80788', 'th777', '1234', 'cristiano ronaldo', ''),
('t80904', 'th002', '1234', 'kakashi hatake', 'copyninjakakashi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_class`
--

CREATE TABLE `teacher_class` (
  `teacher_sid` char(10) NOT NULL,
  `class_no` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_class`
--

INSERT INTO `teacher_class` (`teacher_sid`, `class_no`) VALUES
('t01862', 'c002'),
('t01862', 'c004'),
('t01862', 'c005'),
('t01862', 'c006'),
('t01862', 'c007'),
('t01862', 'c008'),
('t80904', 'c002'),
('t80904', 'c004'),
('t80904', 'c005'),
('t80904', 'c006'),
('t80904', 'c007'),
('t80904', 'c008'),
('t48408', 'c002'),
('t48408', 'c004'),
('t48408', 'c005'),
('t48408', 'c006'),
('t48408', 'c007'),
('t48408', 'c008'),
('t15537', 'c002'),
('t15537', 'c004'),
('t15537', 'c005'),
('t15537', 'c006'),
('t15537', 'c007'),
('t15537', 'c008'),
('t41089', 'c002'),
('t41089', 'c004'),
('t41089', 'c005'),
('t41089', 'c006'),
('t41089', 'c007'),
('t41089', 'c008');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `teacher_sid` char(10) NOT NULL,
  `sub_id` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`teacher_sid`, `sub_id`) VALUES
('t01862', 's002'),
('t01862', 's003'),
('t01862', 's001'),
('t80904', 's002'),
('t80904', 's005'),
('t80904', 's003'),
('t80904', 's001'),
('t48408', 's002'),
('t48408', 's005'),
('t15537', 's002'),
('t15537', 's005'),
('t41089', 's006'),
('t80788', 's006'),
('t80788', 's002'),
('t80788', 's005'),
('t80788', 's003'),
('t26846', 's006'),
('t26846', 's002'),
('t26846', 's005'),
('t26846', 's003');

-- --------------------------------------------------------

--
-- Table structure for table `user_propics`
--

CREATE TABLE `user_propics` (
  `user_id` char(10) NOT NULL,
  `url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_propics`
--

INSERT INTO `user_propics` (`user_id`, `url`) VALUES
('st20559', 'st-pro83747.jpg'),
('st21407', 'st-pro08031.jpg'),
('st22100', 'st-pro65600.jpeg'),
('st62937', 'st-pro23360.jpg'),
('st63144', 'st-pro30530.jpg'),
('st71624', 'st-pro92357.jpg'),
('st74558', 'st-pro96209.jpeg'),
('st90370', 'st-pro52932.jpg'),
('st95691', 'st-pro00407.jpg'),
('st96056', 'st-pro99942.jpg'),
('t01862', 'th-pro92548.jpg'),
('t15537', 'th-pro59441.jpg'),
('t26846', 'th-pro06257.jpg'),
('t41089', 'th-pro20194.jpg'),
('t48408', 'th-pro48836.jpg'),
('t80788', 'th-pro43426.webp'),
('t80904', 'th-pro45014.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_no`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`system_sid`),
  ADD UNIQUE KEY `indexno` (`indexno`);

--
-- Indexes for table `student_class`
--
ALTER TABLE `student_class`
  ADD UNIQUE KEY `student_sid` (`student_sid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`),
  ADD UNIQUE KEY `sub_name` (`sub_name`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`system_tid`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `user_propics`
--
ALTER TABLE `user_propics`
  ADD UNIQUE KEY `user_id` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
