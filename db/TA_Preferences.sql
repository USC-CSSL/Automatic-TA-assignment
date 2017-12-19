-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2017 at 02:58 PM
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
-- Table structure for table `TA_Preferences`
--

CREATE TABLE IF NOT EXISTS `TA_Preferences` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `TA_Id` int(11) NOT NULL,
  `Section_Id` int(11) NOT NULL,
  `Has_Been_TA_For_This_Course` tinyint(1) NOT NULL,
  `Interest_Level` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Dumping data for table `TA_Preferences`
--

INSERT INTO `TA_Preferences` (`Id`, `TA_Id`, `Section_Id`, `Has_Been_TA_For_This_Course`, `Interest_Level`) VALUES
(124, 0, 9, 0, 3),
(125, 0, 21, 1, 5),
(126, 0, 30, 1, 1),
(127, 0, 33, 0, 4),
(128, 0, 36, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
