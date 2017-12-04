-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 04, 2017 at 12:11 AM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
