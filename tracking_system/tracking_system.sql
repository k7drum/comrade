-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 03, 2019 at 05:40 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tracking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `staff_id` varchar(50) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `marks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `database_chat`
--

DROP TABLE IF EXISTS `database_chat`;
CREATE TABLE IF NOT EXISTS `database_chat` (
  `chat_id` int(100) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(100) DEFAULT NULL,
  `advisor_id` varchar(100) DEFAULT NULL,
  `message` varchar(250) NOT NULL,
  `date_time` datetime NOT NULL,
  `uploaded_file` varchar(250) NOT NULL,
  PRIMARY KEY (`chat_id`),
  KEY `FK_student_id` (`student_id`),
  KEY `FK_advisor_id` (`advisor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `database_chat`
--

INSERT INTO `database_chat` (`chat_id`, `student_id`, `advisor_id`, `message`, `date_time`, `uploaded_file`) VALUES
(1, '200001', NULL, 'Find attached database information', '2018-12-16 16:23:37', 'hackathons.docx'),
(3, '200001', NULL, 'find the attached database file', '2018-12-17 15:47:29', 'PARK-CHAN-WOOK-Article.docx');

-- --------------------------------------------------------

--
-- Table structure for table `database_evaluation`
--

DROP TABLE IF EXISTS `database_evaluation`;
CREATE TABLE IF NOT EXISTS `database_evaluation` (
  `database_id` int(11) NOT NULL AUTO_INCREMENT,
  `A` int(11) NOT NULL,
  `B` int(11) NOT NULL,
  `C` int(11) NOT NULL,
  `D` int(11) NOT NULL,
  `E` int(11) NOT NULL,
  `F` int(11) NOT NULL,
  `G` int(11) NOT NULL,
  `H` int(11) NOT NULL,
  `student_id` varchar(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `semester_year` varchar(50) NOT NULL,
  PRIMARY KEY (`database_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `database_evaluation`
--

INSERT INTO `database_evaluation` (`database_id`, `A`, `B`, `C`, `D`, `E`, `F`, `G`, `H`, `student_id`, `total`, `semester_year`) VALUES
(2, 3, 1, 1, 2, 1, 1, 1, 1, '200001', 11, 'Spring 2018'),
(3, 2, 2, 2, 2, 1, 1, 1, 1, '200002', 12, 'Fall 2019');

-- --------------------------------------------------------

--
-- Table structure for table `final_chat`
--

DROP TABLE IF EXISTS `final_chat`;
CREATE TABLE IF NOT EXISTS `final_chat` (
  `final_id` int(100) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(100) DEFAULT NULL,
  `advisor_id` varchar(100) DEFAULT NULL,
  `message` varchar(250) NOT NULL,
  `date_time` datetime NOT NULL,
  `uploaded_file` varchar(250) NOT NULL,
  PRIMARY KEY (`final_id`),
  KEY `student_id` (`student_id`),
  KEY `advisor_id` (`advisor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `milestone`
--

DROP TABLE IF EXISTS `milestone`;
CREATE TABLE IF NOT EXISTS `milestone` (
  `milestone_id` int(50) NOT NULL AUTO_INCREMENT,
  `due_date` date NOT NULL,
  `task` varchar(250) DEFAULT NULL,
  `task_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`milestone_id`),
  KEY `task_id` (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `milestone`
--

INSERT INTO `milestone` (`milestone_id`, `due_date`, `task`, `task_id`) VALUES
(1, '2018-11-26', 'A unique submission folder will be created for each task and keep track of the submission status (submitting user, date, time, file_name etc.)', NULL),
(2, '2018-11-26', 'The committee will decide on submission tasks (i.e. Entity Relationship Diagram) and milestones (i.e. submission due date) for the students.', NULL),
(4, '2019-01-03', 'All information should be passed by the advisor for the task to perform for each file to be submitted', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_upload`
--

DROP TABLE IF EXISTS `project_upload`;
CREATE TABLE IF NOT EXISTS `project_upload` (
  `upload_id` int(250) NOT NULL AUTO_INCREMENT,
  `id` varchar(11) DEFAULT NULL,
  `name` blob NOT NULL,
  `std_name` varchar(100) NOT NULL,
  `type` varchar(250) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`upload_id`),
  KEY `std_name` (`std_name`),
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_upload`
--

INSERT INTO `project_upload` (`upload_id`, `id`, `name`, `std_name`, `type`, `size`, `date_time`) VALUES
(1, '', 0x5374656c6c61, '', '', NULL, '2018-11-28 20:58:28');

-- --------------------------------------------------------

--
-- Table structure for table `report_chats`
--

DROP TABLE IF EXISTS `report_chats`;
CREATE TABLE IF NOT EXISTS `report_chats` (
  `chat_id` int(100) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(100) DEFAULT NULL,
  `adv_id` varchar(100) DEFAULT NULL,
  `message` varchar(250) NOT NULL,
  `date_time` datetime NOT NULL,
  `uploaded_file` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`chat_id`),
  KEY `student_id` (`student_id`),
  KEY `adv_id` (`adv_id`),
  KEY `student_id_2` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `report_chats`
--

INSERT INTO `report_chats` (`chat_id`, `student_id`, `adv_id`, `message`, `date_time`, `uploaded_file`) VALUES
(4, '200001', '100002', 'this should work better', '2018-12-07 00:35:17', ' ITEC403 project.docx'),
(5, NULL, NULL, 'load the information you have on database', '2018-12-16 16:19:36', 'hackathons.docx'),
(6, '200001', NULL, ' support system', '2018-12-17 13:34:33', 'Peace.docx'),
(7, '200002', NULL, '    find the attached file', '2018-12-17 13:37:14', 'The-functions-of-the-religious-committee-originals-6.docx'),
(8, '200001', NULL, 'new file to check', '2018-12-24 12:47:26', 'ALOLA MARY. N.M. T PROJECT.docx');

-- --------------------------------------------------------

--
-- Table structure for table `report_evaluation`
--

DROP TABLE IF EXISTS `report_evaluation`;
CREATE TABLE IF NOT EXISTS `report_evaluation` (
  `eval_id` int(11) NOT NULL AUTO_INCREMENT,
  `A` int(11) NOT NULL,
  `B` int(11) NOT NULL,
  `C` int(11) NOT NULL,
  `D` int(11) NOT NULL,
  `E` int(11) NOT NULL,
  `F` int(11) NOT NULL,
  `G` int(11) NOT NULL,
  `H` int(11) NOT NULL,
  `I` int(11) NOT NULL,
  `J` int(11) NOT NULL,
  `K` int(11) NOT NULL,
  `L` int(11) NOT NULL,
  `M` int(11) NOT NULL,
  `N` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `student_id` varchar(11) DEFAULT NULL,
  `semester_year` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`eval_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `report_evaluation`
--

INSERT INTO `report_evaluation` (`eval_id`, `A`, `B`, `C`, `D`, `E`, `F`, `G`, `H`, `I`, `J`, `K`, `L`, `M`, `N`, `total`, `student_id`, `semester_year`) VALUES
(4, 3, 2, 2, 2, 1, 1, 1, 1, 2, 2, 2, 2, 2, 2, 25, '200001', 'Fall 2019'),
(3, 3, 3, 2, 2, 2, 2, 1, 3, 4, 4, 4, 2, 2, 2, 36, '200002', 'Fall 2019');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'staff',
  `role` varchar(100) DEFAULT NULL,
  `course_code` varchar(50) DEFAULT 'itec403',
  `semester` varchar(50) DEFAULT NULL,
  `adv_count` varchar(250) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `surname`, `password`, `gender`, `email`, `user_type`, `role`, `course_code`, `semester`, `adv_count`, `date_time`) VALUES
('100001', 'Van', 'Smith', 'Admin1', 'female', 'admin@mail.com', 'admin', 'committee_member', 'itec403', '2018/19 Spring', '0', NULL),
('100002', 'pretty', 'Face', 'Staff2', 'female', 'staff2@mail.com', 'advisor', 'committee_member', 'itec403', '2018/19 Spring', '4', NULL),
('100003', 'hope', 'georg', 'Staff3', 'male', 'staff3@mail.com', 'advisor', 'None', 'itec403', '2018/19 Spring', '3', NULL),
('100004', 'Dark', 'John', 'Staff4', 'male', 'staff4@mail.com', 'advisor', 'None', 'itec403', 'spring', '4', '2018-11-16 13:22:30'),
('100005', 'Mustafa', 'Praise', 'Staff5', 'other', 'staff5@mail.com', 'advisor', 'committee_member', 'itec403', 'spring', '1', '2018-11-16 13:26:00'),
('100007', 'pamilerin', 'aribisogan', 'Staff7', 'female', 'vivianpamilerin@gmail.com', 'advisor', 'None', 'itec403', 'spring', '0', NULL),
('100009', 'Lovely', 'Cem', 'Staff9', 'male', 'staff9@mail.com', 'advisor', 'committee_member', 'itec403', 'spring', '0', '2018-12-29 03:16:33'),
('200006', 'Kuo', 'Sparrow', 'Staff6', 'female', 'staff6@mail.com', 'advisor', 'committee_member', 'itec403', 'fall', '0', '2018-12-28 03:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'student',
  `course_code` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `adv_status` varchar(100) NOT NULL DEFAULT 'pending',
  `date_time` datetime NOT NULL,
  `staff_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `surname`, `email`, `password`, `gender`, `user_type`, `course_code`, `status`, `adv_status`, `date_time`, `staff_id`) VALUES
('200001', 'john', 'fred', 'user1@mail.com', 'User1', 'Male', 'student', 'itec403', 'approved', 'approved', '2018-11-13 21:12:58', '100002'),
('200002', 'Yemi', 'Kay', 'User2@mail.com', 'User2', 'female', 'student', 'itec403', 'approved', 'approved', '2018-11-16 16:23:26', '100002'),
('200003', 'Mary', 'Idowu', 'user3@mail.com', 'User3', 'Male', 'student', 'itec403', 'aprroved', 'approved', '2018-11-16 16:25:22', '100003'),
('200004', 'Stella', 'Steven', 'user4@mail.com', 'User4', 'female', 'student', 'itec403', 'approved', 'approved', '2018-11-27 00:07:41', '100007'),
('200005', 'freedom', 'Er', 'user5@mail.com', 'User5', 'female', 'student', 'itec403', 'approved', 'approved', '2018-12-29 04:10:24', '100003'),
('200006', 'Justin', 'Austin', 'user6@mail.com', 'User6', 'Male', 'student', 'itec403', 'approved', 'approved', '2018-12-29 04:11:41', '100003'),
('200007', 'Musa', 'Moss', 'user7@mail.com', 'User7', 'others', 'student', 'itec403', 'approved', 'approved', '2018-12-29 04:13:32', '100004'),
('200008', 'Son', 'Father', 'User8@mail.com', 'User8', 'Male', 'student', 'itec403', 'approved', 'approved', '2018-12-29 04:14:58', '100004');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `staff_id` varchar(50) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `task` varchar(250) DEFAULT NULL,
  `course_code` varchar(50) DEFAULT 'itec403',
  `title` varchar(250) DEFAULT NULL,
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`task_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`staff_id`, `date_created`, `task`, `course_code`, `title`, `task_id`) VALUES
(NULL, '2018-11-26 15:51:09', 'Literature Review and Report', 'itec403', 'Literature Review and Report', 1),
(NULL, '2018-11-26 15:50:43', 'UML Designs', 'itec403', 'UML Designs', 2),
(NULL, '2018-11-26 15:47:37', 'Database Documentation', 'itec403', 'Database Documentation', 3),
(NULL, '2018-12-28 03:21:24', 'Student should explain the scope of the project and topic research', 'itec403', 'Literature Review', 5),
(NULL, '2018-12-28 03:40:54', 'Submit a clear Image', 'itec403', 'UML Designs', 10);

-- --------------------------------------------------------

--
-- Table structure for table `trash`
--

DROP TABLE IF EXISTS `trash`;
CREATE TABLE IF NOT EXISTS `trash` (
  `id` varchar(100) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `surname` varchar(250) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `uml_chat`
--

DROP TABLE IF EXISTS `uml_chat`;
CREATE TABLE IF NOT EXISTS `uml_chat` (
  `uml_id` int(100) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(100) DEFAULT NULL,
  `adv_id` varchar(100) DEFAULT NULL,
  `message` varchar(250) NOT NULL,
  `date_time` datetime NOT NULL,
  `uploaded_file` varchar(250) NOT NULL,
  PRIMARY KEY (`uml_id`),
  KEY `FK_student_id` (`student_id`),
  KEY `FK_adv_id` (`adv_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `uml_chat`
--

INSERT INTO `uml_chat` (`uml_id`, `student_id`, `adv_id`, `message`, `date_time`, `uploaded_file`) VALUES
(4, '200001', NULL, 'Full submission on a movie', '2018-12-17 15:44:30', 'CINEMA--1April2018.docx');

-- --------------------------------------------------------

--
-- Table structure for table `uml_evaluation`
--

DROP TABLE IF EXISTS `uml_evaluation`;
CREATE TABLE IF NOT EXISTS `uml_evaluation` (
  `UML_id` int(11) NOT NULL AUTO_INCREMENT,
  `A` int(11) NOT NULL,
  `B` int(11) NOT NULL,
  `C` int(11) NOT NULL,
  `D` int(11) NOT NULL,
  `E` int(11) NOT NULL,
  `F` int(11) NOT NULL,
  `G` int(11) NOT NULL,
  `H` int(11) NOT NULL,
  `I` int(11) NOT NULL,
  `J` int(11) NOT NULL,
  `K` int(11) NOT NULL,
  `L` int(11) NOT NULL,
  `M` int(11) NOT NULL,
  `N` int(11) NOT NULL,
  `O` int(11) NOT NULL,
  `P` int(11) NOT NULL,
  `student_id` varchar(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `semester_year` varchar(50) NOT NULL,
  PRIMARY KEY (`UML_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=armscii8;

--
-- Dumping data for table `uml_evaluation`
--

INSERT INTO `uml_evaluation` (`UML_id`, `A`, `B`, `C`, `D`, `E`, `F`, `G`, `H`, `I`, `J`, `K`, `L`, `M`, `N`, `O`, `P`, `student_id`, `total`, `semester_year`) VALUES
(19, 3, 3, 2, 2, 1, 1, 1, 1, 4, 1, 4, 1, 1, 1, 2, 2, '200002', 30, 'Spring 2018'),
(18, 3, 3, 2, 1, 1, 1, 1, 1, 2, 2, 2, 1, 1, 1, 1, 2, '200001', 25, 'Spring 2018');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `report_chats`
--
ALTER TABLE `report_chats`
  ADD CONSTRAINT `report_chats_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `report_chats_ibfk_2` FOREIGN KEY (`adv_id`) REFERENCES `staff` (`id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
