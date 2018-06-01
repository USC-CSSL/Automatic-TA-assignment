--
-- Table structure for table `Admin_Matching`
--

DROP TABLE IF EXISTS `Admin_Matching`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Admin_Matching` (
  `Admin_Matching_Id` int(11) NOT NULL AUTO_INCREMENT,
  `TA_Id` int(11) NOT NULL,
  `Section_Id` int(11) NOT NULL,
  `IsActive` int(11) NOT NULL,
  PRIMARY KEY (`Admin_Matching_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Table structure for table `Course`
--

DROP TABLE IF EXISTS `Course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Course` (
  `Course_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Course_Code` varchar(250) NOT NULL,
  `Course_Name` varchar(250) NOT NULL,
  `Area` varchar(250) NOT NULL,
  `IsActive` int(11) NOT NULL,
  `Number_Of_Half_TA` int(11) NOT NULL,
  `Number_Of_Full_TA` int(11) NOT NULL,
  PRIMARY KEY (`Course_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


--
-- Table structure for table `Course_Section`
--

DROP TABLE IF EXISTS `Course_Section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Course_Section` (
  `Section_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Course_Id` int(11) NOT NULL,
  `Lecture_Code` varchar(250) NOT NULL,
  `Lab_Code` varchar(250) NOT NULL,
  `IsLecture` tinyint(1) NOT NULL,
  `Time_Slot_Id` int(11) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`Section_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Table structure for table `Matching`
--

DROP TABLE IF EXISTS `Matching`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Matching` (
  `Matching_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Run_Id` int(11) NOT NULL,
  `Allotment_Id` int(11) NOT NULL,
  `TA_Id` int(11) NOT NULL,
  `Section_Id` int(11) NOT NULL,
  `IsActive` int(11) NOT NULL,
  PRIMARY KEY (`Matching_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Table structure for table `Milestones`
--

DROP TABLE IF EXISTS `Milestones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Milestones` (
  `Milestone_Id` int(11) NOT NULL,
  `Milestone_Name` varchar(250) NOT NULL,
  `Ranking` varchar(250) NOT NULL,
  PRIMARY KEY (`Milestone_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `Milestones`
--

LOCK TABLES `Milestones` WRITE;
/*!40000 ALTER TABLE `Milestones` DISABLE KEYS */;
INSERT INTO `Milestones` VALUES (1,'Dissertation defense','1.5'),(2,'Quals Part 1 (Review Paper)','1.25'),(3,'Dissertation proposal','1'),(4,'2nd year project/Masters thesis defense','0.75'),(5,'1st year proposal defense','0.5'),(6,'None','0');
/*!40000 ALTER TABLE `Milestones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reason`
--

DROP TABLE IF EXISTS `Reason`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reason` (
  `Reason_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Reason` varchar(250) NOT NULL,
  PRIMARY KEY (`Reason_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Table structure for table `TA`
--

DROP TABLE IF EXISTS `TA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TA` (
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Table structure for table `TA_Preferences`
--

DROP TABLE IF EXISTS `TA_Preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TA_Preferences` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `TA_Id` int(11) NOT NULL,
  `Section_Id` int(11) NOT NULL,
  `Has_Been_TA_For_This_Course` tinyint(1) NOT NULL,
  `Interest_Level` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1633 DEFAULT CHARSET=latin1;

--
-- Table structure for table `TA_Time_Constraints`
--

DROP TABLE IF EXISTS `TA_Time_Constraints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TA_Time_Constraints` (
  `Constraint_Id` int(11) NOT NULL AUTO_INCREMENT,
  `TA_Id` int(11) NOT NULL,
  `Time_Interval_Not_Available_Id` int(11) NOT NULL,
  `Reason_Id` int(11) NOT NULL,
  `Reason_If_Other` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`Constraint_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Table structure for table `Time_Intervals`
--

DROP TABLE IF EXISTS `Time_Intervals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Time_Intervals` (
  `Time_Slot_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Start_Time` varchar(250) NOT NULL,
  `End_Time` varchar(250) NOT NULL,
  `Day` varchar(250) NOT NULL,
  PRIMARY KEY (`Time_Slot_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `User_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(250) NOT NULL,
  `Username` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `IsAdmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`User_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User` for Admin setup
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'Admin','admin','$2y$10$6VVO3BFXLzoMLIq8lTrmqOmv1Xq.9HKd8YFF7sSVMaQId3G28ZpjW',1);
UNLOCK TABLES;
