-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2017 at 10:41 PM
-- Server version: 5.5.58-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ta_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin_Matching`
--

CREATE TABLE IF NOT EXISTS `Admin_Matching` (
  `Admin_Matching_Id` int(11) NOT NULL AUTO_INCREMENT,
  `TA_Id` int(11) NOT NULL,
  `Section_Id` int(11) NOT NULL,
  `IsActive` int(11) NOT NULL,
  PRIMARY KEY (`Admin_Matching_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Admin_Matching`
--

INSERT INTO `Admin_Matching` (`Admin_Matching_Id`, `TA_Id`, `Section_Id`, `IsActive`) VALUES
(4, 1, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE IF NOT EXISTS `Course` (
  `Course_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Course_Code` varchar(250) NOT NULL,
  `Course_Name` varchar(250) NOT NULL,
  `Area` varchar(250) NOT NULL,
  `IsActive` int(11) NOT NULL,
  `Number_Of_Half_TA` int(11) NOT NULL,
  `Number_Of_Full_TA` int(11) NOT NULL,
  PRIMARY KEY (`Course_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `Course`
--

INSERT INTO `Course` (`Course_Id`, `Course_Code`, `Course_Name`, `Area`, `IsActive`, `Number_Of_Half_TA`, `Number_Of_Full_TA`) VALUES
(1, 'PSYC-100', 'Introduction to Psychology', 'General', 1, 2, 2),
(4, 'PSYC-314', 'Experimental Research Methods', 'Research', 1, 2, 1),
(7, 'PSYC-360', 'Abnormal Psychology', 'General', 1, 0, 1),
(9, 'PSYC-274', 'Statistics', 'Quant', 1, 2, 1),
(10, 'PSYC-165', 'Drugs, Behavior, and Society', 'General', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Course_Section`
--

CREATE TABLE IF NOT EXISTS `Course_Section` (
  `Section_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Course_Id` int(11) NOT NULL,
  `Lecture_Code` varchar(250) NOT NULL,
  `Lab_Code` varchar(250) NOT NULL,
  `IsLecture` tinyint(1) NOT NULL,
  `Time_Slot_Id` int(11) NOT NULL,
  PRIMARY KEY (`Section_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `Course_Section`
--

INSERT INTO `Course_Section` (`Section_Id`, `Course_Id`, `Lecture_Code`, `Lab_Code`, `IsLecture`, `Time_Slot_Id`) VALUES
(9, 1, '52410', '', 1, 16),
(10, 1, '52410', '52412', 0, 17),
(11, 1, '52410', '52416', 0, 18),
(12, 1, '52410', '52407', 0, 19),
(13, 1, '52410', '52420', 0, 20),
(14, 1, '52410', '52420', 0, 21),
(15, 1, '52410', '52413', 0, 22),
(16, 1, '52410', '52414', 0, 23),
(17, 1, '52410', '52418', 0, 24),
(18, 1, '52410', '52415', 0, 25),
(19, 1, '52410', '52417', 0, 26),
(20, 1, '52410', '52424', 0, 27),
(21, 1, '52400', '', 1, 28),
(22, 1, '52400', '52405', 0, 29),
(23, 1, '52400', '52404', 0, 30),
(24, 1, '52400', '52401', 0, 31),
(25, 1, '52400', '52422', 0, 32),
(26, 1, '52400', '52425', 0, 33),
(27, 1, '52400', '52411', 0, 34),
(28, 1, '52400', '52409', 0, 35),
(29, 1, '52400', '52403', 0, 36),
(30, 10, '52440', '', 1, 37),
(31, 10, '52440', '52444', 0, 38),
(32, 10, '52440', '52442', 0, 33),
(33, 9, '52450', '', 1, 39),
(34, 9, '52450', '52452', 0, 34),
(35, 9, '52450', '52451', 0, 23),
(36, 4, '52515', '', 1, 40),
(37, 4, '52515', '52516', 0, 36),
(38, 4, '52515', '52517', 0, 26),
(39, 4, '52515', '', 1, 16),
(40, 4, '52515', '52482', 0, 36),
(41, 4, '52515', '52521', 0, 31),
(42, 7, '52566', '', 1, 41);

-- --------------------------------------------------------

--
-- Table structure for table `Matching`
--

CREATE TABLE IF NOT EXISTS `Matching` (
  `Matching_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Run_Id` int(11) NOT NULL,
  `Allotment_Id` int(11) NOT NULL,
  `TA_Id` int(11) NOT NULL,
  `Section_Id` int(11) NOT NULL,
  `IsActive` int(11) NOT NULL,
  PRIMARY KEY (`Matching_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `Matching`
--

INSERT INTO `Matching` (`Matching_Id`, `Run_Id`, `Allotment_Id`, `TA_Id`, `Section_Id`, `IsActive`) VALUES
(27, 1, 1, 3, 34, 1),
(28, 1, 1, 3, 35, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Milestones`
--

CREATE TABLE IF NOT EXISTS `Milestones` (
  `Milestone_Id` int(11) NOT NULL,
  `Milestone_Name` varchar(250) NOT NULL,
  `Ranking` varchar(250) NOT NULL,
  PRIMARY KEY (`Milestone_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Milestones`
--

INSERT INTO `Milestones` (`Milestone_Id`, `Milestone_Name`, `Ranking`) VALUES
(1, 'Dissertation defense', '1.5'),
(2, 'Quals Part 1 (Review Paper)', '1.25'),
(3, 'Dissertation proposal', '1'),
(4, '2nd year project/Masters thesis defense', '0.75'),
(5, '1st year proposal defense', '0.5'),
(6, 'None', '0');

-- --------------------------------------------------------

--
-- Table structure for table `Reason`
--

CREATE TABLE IF NOT EXISTS `Reason` (
  `Reason_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Reason` varchar(250) NOT NULL,
  PRIMARY KEY (`Reason_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Reason`
--

INSERT INTO `Reason` (`Reason_Id`, `Reason`) VALUES
(1, 'Class'),
(2, 'Research Work'),
(3, 'Family'),
(4, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `TA`
--

CREATE TABLE IF NOT EXISTS `TA` (
  `TA_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Area` varchar(250) NOT NULL,
  `Previous_Courses_Taught` varchar(250) NOT NULL,
  `Course_Taught_Last_Semester` int(11) NOT NULL,
  `Happy_With_Last_Course_Taught` tinyint(1) NOT NULL,
  `Has_TA_Experience` tinyint(1) NOT NULL,
  `Has_TA_Experience_For_Number_Of_Semester` int(11) NOT NULL,
  `Milestones_Id` varchar(250) NOT NULL,
  `IsActive` int(11) NOT NULL,
  PRIMARY KEY (`TA_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `TA`
--

INSERT INTO `TA` (`TA_Id`, `User_Id`, `Area`, `Previous_Courses_Taught`, `Course_Taught_Last_Semester`, `Happy_With_Last_Course_Taught`, `Has_TA_Experience`, `Has_TA_Experience_For_Number_Of_Semester`, `Milestones_Id`, `IsActive`) VALUES
(1, 3, 'General', 'N/A', 0, 0, 0, 0, '', 1),
(3, 4, 'Quant', '1, 7, 9', 1, 1, 1, 3, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `TA_Preferences`
--

CREATE TABLE IF NOT EXISTS `TA_Preferences` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `TA_Id` int(11) NOT NULL,
  `Course_Id` int(11) NOT NULL,
  `Has_Been_TA_For_This_Course` tinyint(1) NOT NULL,
  `Interest_Level` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `TA_Preferences`
--

INSERT INTO `TA_Preferences` (`Id`, `TA_Id`, `Course_Id`, `Has_Been_TA_For_This_Course`, `Interest_Level`) VALUES
(111, 1, 1, 1, 4),
(112, 1, 4, 0, 3),
(113, 1, 7, 0, 5),
(114, 1, 9, 1, 2),
(115, 1, 10, 1, 1),
(116, 3, 1, 1, 1),
(117, 3, 4, 1, 3),
(118, 3, 7, 0, 5),
(119, 3, 9, 1, 5),
(120, 3, 10, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `TA_Time_Constraints`
--

CREATE TABLE IF NOT EXISTS `TA_Time_Constraints` (
  `Constraint_Id` int(11) NOT NULL AUTO_INCREMENT,
  `TA_Id` int(11) NOT NULL,
  `Time_Interval_Not_Available_Id` int(11) NOT NULL,
  `Reason_Id` int(11) NOT NULL,
  `Reason_If_Other` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Constraint_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `TA_Time_Constraints`
--

INSERT INTO `TA_Time_Constraints` (`Constraint_Id`, `TA_Id`, `Time_Interval_Not_Available_Id`, `Reason_Id`, `Reason_If_Other`) VALUES
(1, 1, 10, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `Time_Intervals`
--

CREATE TABLE IF NOT EXISTS `Time_Intervals` (
  `Time_Slot_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Start_Time` varchar(250) NOT NULL,
  `End_Time` varchar(250) NOT NULL,
  `Day` varchar(250) NOT NULL,
  PRIMARY KEY (`Time_Slot_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `Time_Intervals`
--

INSERT INTO `Time_Intervals` (`Time_Slot_Id`, `Start_Time`, `End_Time`, `Day`) VALUES
(10, '08:30', '09:50', 'Monday'),
(11, '08:30', '09:50', 'Wednesday'),
(12, '08:30', '09:50', 'Tuesday'),
(13, '12:30', '13:50', 'Tuesday'),
(14, '11:00', '12:20', 'Tuesday'),
(15, '08:00', '09:20', 'Tuesday'),
(16, '08:30', '09:50', 'MW'),
(17, '08:00', '09:50', 'T'),
(18, '08:00', '09:50', 'F'),
(19, '10:00', '11:50', 'M'),
(20, '10:00', '11:50', 'MW'),
(21, '10:00', '11:50', 'T'),
(22, '10:00', '11:50', 'Th'),
(23, '12:00', '13:50', 'M'),
(24, '12:00', '13:50', 'T'),
(25, '12:00', '13:50', 'W'),
(26, '14:00', '15:50', 'F'),
(27, '18:00', '19:50', 'W'),
(28, '14:00', '15:20', 'MW'),
(29, '12:00', '13:50', 'F'),
(30, '14:00', '15:50', 'T'),
(31, '14:00', '15:50', 'Th'),
(32, '18:00', '19:50', 'M'),
(33, '08:00', '09:50', 'W'),
(34, '08:00', '09:50', 'Th'),
(35, '10:00', '11:50', 'W'),
(36, '10:00', '11:50', 'F'),
(37, '08:00', '09:50', 'TTh'),
(38, '08:00', '09:50', 'M'),
(39, '11:00', '12:20', 'TTh'),
(40, '12:30', '13:50', 'TTh'),
(41, '14:00', '15:50', 'MW');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `User_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `IsAdmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`User_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`User_Id`, `Name`, `Username`, `Password`, `IsAdmin`) VALUES
(1, 'Admin', 'admin', '$2y$10$6VVO3BFXLzoMLIq8lTrmqOmv1Xq.9HKd8YFF7sSVMaQId3G28ZpjW', 1),
(3, 'Srinidhi', 'snandaku', '$2y$10$MwBVF657xuhcDMsSPDZIDOtpPtBTGr3DEINZlxEMcBbLGuLylJwn.', 0),
(4, 'Rajdeep', 'kaurr', '$2y$10$86eIK35VNwQtGDN4Ggmn1eAtVP5ciBs4WrAvXYrdC8Jj6EFnNDxSK', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
