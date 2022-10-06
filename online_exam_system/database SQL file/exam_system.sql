-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2021 at 07:05 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `online_exam_enroll`
--

CREATE TABLE `online_exam_enroll` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `attendance_status` enum('Absent','Present') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online_exam_enroll`
--

INSERT INTO `online_exam_enroll` (`id`, `user_id`, `exam_id`, `attendance_status`) VALUES
(18, 4, 1, 'Absent'),
(19, 4, 3, 'Absent'),
(20, 4, 3, 'Absent'),
(21, 4, 7, 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `online_exam_exams`
--

CREATE TABLE `online_exam_exams` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_title` varchar(250) NOT NULL,
  `exam_datetime` datetime NOT NULL,
  `duration` varchar(30) NOT NULL,
  `total_question` int(5) NOT NULL,
  `marks_per_right_answer` varchar(30) NOT NULL,
  `marks_per_wrong_answer` varchar(30) NOT NULL,
  `created_on` datetime NOT NULL,
  `status` enum('Pending','Created','Started','Completed') NOT NULL,
  `exam_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online_exam_exams`
--

INSERT INTO `online_exam_exams` (`id`, `user_id`, `exam_title`, `exam_datetime`, `duration`, `total_question`, `marks_per_right_answer`, `marks_per_wrong_answer`, `created_on`, `status`, `exam_code`) VALUES
(1, 1, 'PHP Test', '0000-00-00 00:00:00', '1', 5, '1', '1', '2021-05-31 12:51:11', 'Created', ''),
(3, 1, 'JavaScript Test', '2020-11-27 15:03:00', '2', 2, '1', '1', '2020-11-15 08:26:41', 'Created', ''),
(4, 1, 'HTML Test', '2020-12-22 20:47:00', '5', 2, '1', '1', '0000-00-00 00:00:00', 'Created', ''),
(6, 1, 'Perl exams', '2020-11-30 15:54:00', '5', 2, '1', '1', '0000-00-00 00:00:00', 'Created', ''),
(7, 1, 'Python test exam', '0000-00-00 00:00:00', '2', 2, '1', '1', '0000-00-00 00:00:00', 'Created', '');

-- --------------------------------------------------------

--
-- Table structure for table `online_exam_option`
--

CREATE TABLE `online_exam_option` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option` int(2) NOT NULL,
  `title` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online_exam_option`
--

INSERT INTO `online_exam_option` (`id`, `question_id`, `option`, `title`) VALUES
(1, 1, 1, 'Pre Processor '),
(2, 1, 2, 'Processor PHP'),
(3, 1, 3, 'Hypertext Preprocessor'),
(4, 1, 4, 'Text Processor'),
(5, 2, 1, 'Front end language'),
(6, 2, 2, 'Server end language'),
(7, 2, 3, 'DB end language'),
(8, 2, 4, 'Top end language'),
(9, 3, 1, '&'),
(10, 3, 2, '$'),
(11, 3, 3, '#'),
(12, 3, 4, '%'),
(13, 8, 1, '&#60;?php ....?&#62;'),
(14, 8, 2, '&#60;?php &#62;'),
(15, 8, 3, '&#60;? php?'),
(16, 8, 4, '&#60;?php ?&#62;'),
(17, 9, 1, 'programming langauge'),
(18, 9, 2, 'markup language'),
(19, 9, 3, 'database language'),
(20, 9, 4, 'design language'),
(21, 10, 1, 'stylesheet language'),
(22, 10, 2, 'scripting langauge'),
(23, 10, 3, 'design language'),
(24, 10, 4, 'styling langauge'),
(25, 11, 1, 'Server side language'),
(26, 11, 2, 'Front end language'),
(27, 11, 3, 'Design language'),
(28, 11, 4, 'Style language'),
(29, 12, 1, 'Front end language'),
(30, 12, 2, 'server side language'),
(31, 12, 3, 'UI language'),
(32, 12, 4, 'Design language'),
(33, 13, 1, 'Jhon Smith'),
(34, 13, 2, 'George Belly'),
(35, 13, 3, 'Rasmus Lerdorf'),
(36, 13, 4, 'Andy Smith'),
(37, 14, 1, 'message(\"Hello World\")'),
(38, 14, 2, 'alert(\"Hello World\")'),
(39, 14, 3, 'console.log(\"Hello World\")'),
(40, 14, 4, 'alertbox(\"Hello World\")'),
(41, 15, 1, 'practical extraction and display language'),
(42, 15, 2, 'practical extraction and report language'),
(43, 15, 3, 'practical display and report language'),
(44, 15, 4, 'practical and report language'),
(45, 16, 1, 'design language'),
(46, 16, 2, 'programming language'),
(47, 16, 3, 'server side language'),
(48, 16, 4, 'front end language');

-- --------------------------------------------------------

--
-- Table structure for table `online_exam_process`
--

CREATE TABLE `online_exam_process` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `examid` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `online_exam_process`
--

INSERT INTO `online_exam_process` (`id`, `userid`, `examid`, `start_time`) VALUES
(32, 4, 1, '2021-11-05 17:51:48');

-- --------------------------------------------------------

--
-- Table structure for table `online_exam_question`
--

CREATE TABLE `online_exam_question` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online_exam_question`
--

INSERT INTO `online_exam_question` (`id`, `exam_id`, `question`, `answer`) VALUES
(1, 1, 'PHP Stands For?', '3'),
(2, 1, 'PHP is ?', '2'),
(3, 1, 'All variables in PHP start with which symbol?', '2'),
(8, 1, 'PHP server scripts are surrounded by delimiters, which?', '4'),
(9, 4, 'HTML is ?', '2'),
(10, 4, 'CSS is', '1'),
(11, 3, 'JavaScript is a ?', '2'),
(12, 6, 'Perl is a  ?', '2'),
(13, 1, 'Who is known as the father of PHP?', '3'),
(14, 3, 'How do you write &quot;Hello World&quot; in an alert box?', '2'),
(15, 6, 'Perl language full form ?', '2'),
(16, 7, 'python is ?', '2');

-- --------------------------------------------------------

--
-- Table structure for table `online_exam_question_answer`
--

CREATE TABLE `online_exam_question_answer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_answer_option` enum('0','1','2','3','4') NOT NULL,
  `marks` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online_exam_question_answer`
--

INSERT INTO `online_exam_question_answer` (`id`, `user_id`, `exam_id`, `question_id`, `user_answer_option`, `marks`) VALUES
(117, 4, 1, 1, '3', '1'),
(118, 4, 1, 2, '3', '-1'),
(119, 4, 1, 3, '4', '-1'),
(120, 4, 1, 8, '2', '-1'),
(121, 4, 1, 13, '3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `online_exam_user`
--

CREATE TABLE `online_exam_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(64) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','user') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `online_exam_user`
--

INSERT INTO `online_exam_user` (`id`, `first_name`, `last_name`, `gender`, `email`, `password`, `mobile`, `address`, `created`, `role`) VALUES
(1, 'William', 'Smith', 'Male', 'admin@webdamn.com', '202cb962ac59075b964b07152d234b70', '1234567890', '', '2020-11-28 22:45:58', 'admin'),
(2, 'jhon', 'smith', 'Male', 'user@webdamn.com', '202cb962ac59075b964b07152d234b70', '123456789', '', '2020-11-28 22:45:58', 'user'),
(3, 'Jhon', 'Eyan', 'Male', 'user1@test.com', '202cb962ac59075b964b07152d234b70', '123456789', '', '2020-11-28 22:45:58', 'user'),
(4, 'Dunkun', 'damian', 'Male', 'user2@test.com', '202cb962ac59075b964b07152d234b70', '123456789', '', '2020-11-28 22:45:58', 'user'),
(6, 'sfas', 'khan', 'Male', 'abcd@gmail.com', '202cb962ac59075b964b07152d234b70', '1234567890', 'dsdgsd', '2021-11-04 20:42:14', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `online_exam_enroll`
--
ALTER TABLE `online_exam_enroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_exam_exams`
--
ALTER TABLE `online_exam_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_exam_option`
--
ALTER TABLE `online_exam_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_exam_process`
--
ALTER TABLE `online_exam_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_exam_question`
--
ALTER TABLE `online_exam_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_exam_question_answer`
--
ALTER TABLE `online_exam_question_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_exam_user`
--
ALTER TABLE `online_exam_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `online_exam_enroll`
--
ALTER TABLE `online_exam_enroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `online_exam_exams`
--
ALTER TABLE `online_exam_exams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `online_exam_option`
--
ALTER TABLE `online_exam_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `online_exam_process`
--
ALTER TABLE `online_exam_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `online_exam_question`
--
ALTER TABLE `online_exam_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `online_exam_question_answer`
--
ALTER TABLE `online_exam_question_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `online_exam_user`
--
ALTER TABLE `online_exam_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
