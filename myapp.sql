-- MySQL dump 10.16  Distrib 10.1.8-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: myapp
-- ------------------------------------------------------
-- Server version	10.1.8-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `myapp`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `myapp` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `myapp`;

--
-- Table structure for table `attendance_and_punctuality`
--

DROP TABLE IF EXISTS `attendance_and_punctuality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance_and_punctuality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percent` float(7,4) unsigned DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_and_punctuality`
--

LOCK TABLES `attendance_and_punctuality` WRITE;
/*!40000 ALTER TABLE `attendance_and_punctuality` DISABLE KEYS */;
INSERT INTO `attendance_and_punctuality` VALUES (1,100.0000,'Submits requirements promptly'),(2,0.0000,'syllabi/course outline/scope and sequence charts'),(3,0.0000,'lesson plans'),(4,0.0000,'test questions / table of specifications'),(5,0.0000,'grading sheets'),(6,0.0000,'class records'),(7,0.0000,'permanent records'),(8,0.0000,'journal'),(9,0.0000,'school register'),(10,0.0000,'seminar evaluation'),(11,0.0000,'portfolio'),(12,0.0000,'product of instruction'),(13,100.0000,'Is punctual in'),(14,0.0000,'reporting to school daily'),(15,0.0000,'attending meetings (department, subject area,  monthly personnel, committee meetings, etc.)'),(16,0.0000,'reporting for special school activities (PTC, programs, etc.)'),(17,0.0000,'in service trainings/programs'),(18,100.0000,'Others'),(19,0.0000,'Starts and ends classes on time'),(20,0.0000,'Is present in school when expected (in service trainings/programs, special school programs/activities)'),(21,0.0000,'Is present for all classes handled'),(22,0.0000,'Is present in meetings (deparment meetings, subject area,general faculty, committee, etc.)');
/*!40000 ALTER TABLE `attendance_and_punctuality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bak`
--

DROP TABLE IF EXISTS `bak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(60) DEFAULT NULL,
  `percent` float(7,4) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bak`
--

LOCK TABLES `bak` WRITE;
/*!40000 ALTER TABLE `bak` DISABLE KEYS */;
INSERT INTO `bak` VALUES (1,'tc',40.0000),(2,'ea',30.0000),(3,'ap',30.0000),(4,'tc-satl',20.0000),(5,'tc-cc',20.0000),(6,'tc-api',20.0000),(7,'tc-principal',20.0000),(8,'ea-ll',20.0000),(9,'ea-satl',20.0000),(10,'ea-api',20.0000),(11,'ea-principal',20.0000),(12,'ap-principal',20.0000),(13,'ap-api',20.0000),(14,'ap-satl',20.0000),(15,'ap-ll',20.0000),(16,'ap-self',20.0000),(17,'ea-self',20.0000),(18,'tc-self',20.0000),(19,'inst-faculty',10.0000),(20,'inst-student',90.0000);
/*!40000 ALTER TABLE `bak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `efficiency_and_attitude`
--

DROP TABLE IF EXISTS `efficiency_and_attitude`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `efficiency_and_attitude` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percent` float(7,4) unsigned DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `efficiency_and_attitude`
--

LOCK TABLES `efficiency_and_attitude` WRITE;
/*!40000 ALTER TABLE `efficiency_and_attitude` DISABLE KEYS */;
INSERT INTO `efficiency_and_attitude` VALUES (1,35.0000,'Teacher-Learner Relationship'),(2,0.0000,'Treats students fairly'),(3,0.0000,'Is willing to help students in and out of the classroom'),(4,0.0000,'Supervises students in and out of the classroom settings (checks grooming, attire, behavior during assemblies, programs, recess, lunch, etc.)'),(5,0.0000,'Tries to help students with problematic behaviors by finding out causes of problems and referring cases to proper school authorities '),(6,35.0000,' Personality and Work Ethics'),(7,0.0000,'Friendly, approachable and commands respect'),(8,0.0000,'Observes professionalism in dealing with students, parents, and co-workers'),(9,0.0000,'Is considerate of others in the use of school facilities (faculty room, comfort rooms, etc.) and materials such as books, projectors, etc.'),(10,0.0000,'Relates positively and respectfully with peers, administrators, supervisors and other members of  the school staff'),(11,0.0000,'Shares ideas and resources with others'),(12,0.0000,'Submits well-written (in accordance with defined standards) and accurate (no errors) lesson plans, syllabus, examination drafts, grades, etc. and other requirements'),(13,0.0000,'Willingly accepts reasonable assignments given'),(14,0.0000,'Shows initiative by volunteering for extra work when necessary  and/or assuming other tasks more than what is assigned'),(15,0.0000,'Participates actively in group decision-making process (departmental or monthly personnel  meetings, etc.)'),(16,15.0000,'Christian Dimension'),(17,0.0000,'Participates/leads during prayers and other spiritual exercises'),(18,0.0000,'Instills moral and spiritual values by example and by teaching'),(19,0.0000,'Shows integrity and fairness in dealing with others'),(20,15.0000,'School and Community'),(21,0.0000,'Allots time for consultation with parents and other concerned community members'),(22,0.0000,'Shows willingness to participate in activities that concern the school and the community');
/*!40000 ALTER TABLE `efficiency_and_attitude` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `final_ratings`
--

DROP TABLE IF EXISTS `final_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `final_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `teacherId` varchar(150) DEFAULT NULL,
  `student` float(7,4) DEFAULT '0.0000',
  `ap` float(7,4) DEFAULT '0.0000',
  `ea` float(7,4) DEFAULT '0.0000',
  `tc` float(7,4) DEFAULT '0.0000',
  `rating` float(7,4) DEFAULT '0.0000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `final_ratings`
--

LOCK TABLES `final_ratings` WRITE;
/*!40000 ALTER TABLE `final_ratings` DISABLE KEYS */;
INSERT INTO `final_ratings` VALUES (9,20152016,2,'67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',1.7931,0.4000,0.4000,0.3600,0.5249),(10,20152016,2,'1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',0.0000,0.0000,0.0000,0.0000,0.0000),(11,20152016,2,'ed6625448cf4c6ee468ea61f1ab47f24d4cb67298de04a8e4cfdde80b2ebb525',0.0000,0.0000,0.0000,0.0000,0.0000),(12,20152016,2,'8e09c3e8b87080b8134e8ab20b5dc218cb0401a566976f1bc7793b19109e9b5e',0.0000,0.0000,0.0000,0.0000,0.0000);
/*!40000 ALTER TABLE `final_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `final_ratings_archive`
--

DROP TABLE IF EXISTS `final_ratings_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `final_ratings_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `teacherId` varchar(150) DEFAULT NULL,
  `student` float(7,4) DEFAULT '0.0000',
  `ap` float(7,4) DEFAULT '0.0000',
  `ea` float(7,4) DEFAULT '0.0000',
  `tc` float(7,4) DEFAULT '0.0000',
  `rating` float(7,4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `final_ratings_archive`
--

LOCK TABLES `final_ratings_archive` WRITE;
/*!40000 ALTER TABLE `final_ratings_archive` DISABLE KEYS */;
INSERT INTO `final_ratings_archive` VALUES (1,20152016,1,'67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',0.0000,0.0000,0.0000,0.0000,2.0640),(2,20152016,1,'1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',0.0000,0.0000,0.0000,0.0000,0.0000),(3,20152016,1,'ed6625448cf4c6ee468ea61f1ab47f24d4cb67298de04a8e4cfdde80b2ebb525',0.0000,0.0000,0.0000,0.0000,0.0000),(4,20152016,1,'8e09c3e8b87080b8134e8ab20b5dc218cb0401a566976f1bc7793b19109e9b5e',0.0000,0.0000,0.0000,0.0000,0.0000);
/*!40000 ALTER TABLE `final_ratings_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `img_uploads`
--

DROP TABLE IF EXISTS `img_uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `img_uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(150) DEFAULT NULL,
  `img_reference` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `img_uploads`
--

LOCK TABLES `img_uploads` WRITE;
/*!40000 ALTER TABLE `img_uploads` DISABLE KEYS */;
/*!40000 ALTER TABLE `img_uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `percentages`
--

DROP TABLE IF EXISTS `percentages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `percentages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(60) DEFAULT NULL,
  `percent` float(7,4) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `percentages`
--

LOCK TABLES `percentages` WRITE;
/*!40000 ALTER TABLE `percentages` DISABLE KEYS */;
INSERT INTO `percentages` VALUES (1,'tc',40.0000),(2,'ea',30.0000),(3,'ap',30.0000),(4,'tc-satl',30.0000),(5,'tc-cc',30.0000),(6,'tc-api',15.0000),(7,'tc-principal',15.0000),(8,'ea-ll',25.0000),(9,'ea-satl',25.0000),(10,'ea-api',20.0000),(11,'ea-principal',20.0000),(12,'ap-principal',20.0000),(13,'ap-api',20.0000),(14,'ap-satl',25.0000),(15,'ap-ll',25.0000),(16,'ap-self',10.0000),(17,'ea-self',10.0000),(18,'tc-self',10.0000),(19,'inst-faculty',90.0000),(20,'inst-student',10.0000);
/*!40000 ALTER TABLE `percentages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT '0',
  `evaluator` varchar(100) DEFAULT NULL,
  `to_evaluate` varchar(100) DEFAULT NULL,
  `tc` float(7,4) DEFAULT NULL,
  `ea` float(7,4) DEFAULT NULL,
  `ap` float(7,4) DEFAULT NULL,
  `student` float(7,4) DEFAULT NULL,
  `evtype` varchar(60) DEFAULT NULL,
  `open` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results`
--

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
INSERT INTO `results` VALUES (29,20152016,2,'67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',3.6000,4.0000,4.0000,NULL,'self',1),(30,20152016,2,'1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',NULL,NULL,NULL,NULL,'self',1),(31,20152016,2,'a77c7510dae5251b07d0ecfd9e1f68284954fbd7e0f142444ae87bff5400ae32','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',NULL,NULL,NULL,NULL,'principal-teacher',1),(32,20152016,2,'b5834a9cea215ee6167befd49bec2a0e857f0582137ec0aa8032f6979182cbfb','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',NULL,NULL,NULL,NULL,'api-teacher',1),(33,20152016,2,'a77c7510dae5251b07d0ecfd9e1f68284954fbd7e0f142444ae87bff5400ae32','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',NULL,NULL,NULL,NULL,'principal-teacher',1),(34,20152016,2,'b5834a9cea215ee6167befd49bec2a0e857f0582137ec0aa8032f6979182cbfb','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',NULL,NULL,NULL,NULL,'api-teacher',1),(35,20152016,2,'f59ea4a2cb3c206a0fb0ebcd5b26cc6fe3886ce677f37f75c6c085e0d23347ac','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',NULL,NULL,NULL,NULL,'satl-teacher',1),(36,20152016,2,'f59ea4a2cb3c206a0fb0ebcd5b26cc6fe3886ce677f37f75c6c085e0d23347ac','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',NULL,NULL,NULL,NULL,'satl-teacher',1),(37,20152016,2,'392a65f7836b15424f789c3457d3732d71ed13bb00363f411d1d8971cb35f7bc','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',NULL,NULL,NULL,NULL,'cc-teacher',1),(38,20152016,2,'392a65f7836b15424f789c3457d3732d71ed13bb00363f411d1d8971cb35f7bc','ed6625448cf4c6ee468ea61f1ab47f24d4cb67298de04a8e4cfdde80b2ebb525',NULL,NULL,NULL,NULL,'cc-teacher',1),(39,20152016,2,'8e09c3e8b87080b8134e8ab20b5dc218cb0401a566976f1bc7793b19109e9b5e','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',NULL,NULL,NULL,NULL,'cc-teacher',1),(40,20152016,2,'ed6625448cf4c6ee468ea61f1ab47f24d4cb67298de04a8e4cfdde80b2ebb525','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',NULL,NULL,NULL,NULL,'ll-teacher',1),(41,20152016,2,'5eddf4d0e06126cdb14b13b16487711cfa7fd8f4f363a6406123dca11239150f','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',NULL,NULL,NULL,NULL,'ll-teacher',1),(42,20152016,2,'5eddf4d0e06126cdb14b13b16487711cfa7fd8f4f363a6406123dca11239150f','8e09c3e8b87080b8134e8ab20b5dc218cb0401a566976f1bc7793b19109e9b5e',NULL,NULL,NULL,NULL,'ll-teacher',1),(43,20152016,2,'31722f1d5e9d3f4ce139cc30ef3e759d8646e9957f86f76bc90c44f0a4887a41','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',NULL,NULL,NULL,1.7931,'student-teacher',1),(44,20152016,2,'6e1fd77b6a21a7d6a4279d8f31105b51685e6366de57d312de53be4cc87cae8e','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',NULL,NULL,NULL,NULL,'student-teacher',1);
/*!40000 ALTER TABLE `results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results_archive`
--

DROP TABLE IF EXISTS `results_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT '0',
  `evaluator` varchar(100) DEFAULT NULL,
  `to_evaluate` varchar(100) DEFAULT NULL,
  `tc` float(7,4) DEFAULT NULL,
  `ea` float(7,4) DEFAULT NULL,
  `ap` float(7,4) DEFAULT NULL,
  `student` float(7,4) DEFAULT NULL,
  `evtype` varchar(60) DEFAULT NULL,
  `open` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results_archive`
--

LOCK TABLES `results_archive` WRITE;
/*!40000 ALTER TABLE `results_archive` DISABLE KEYS */;
INSERT INTO `results_archive` VALUES (1,20152016,1,'67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',NULL,NULL,NULL,NULL,'self',1),(2,20152016,1,'1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',NULL,NULL,NULL,NULL,'self',1),(3,20152016,1,'a77c7510dae5251b07d0ecfd9e1f68284954fbd7e0f142444ae87bff5400ae32','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',NULL,NULL,NULL,NULL,'principal-teacher',1),(4,20152016,1,'b5834a9cea215ee6167befd49bec2a0e857f0582137ec0aa8032f6979182cbfb','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',NULL,NULL,NULL,NULL,'api-teacher',1),(5,20152016,1,'a77c7510dae5251b07d0ecfd9e1f68284954fbd7e0f142444ae87bff5400ae32','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',NULL,NULL,NULL,NULL,'principal-teacher',1),(6,20152016,1,'b5834a9cea215ee6167befd49bec2a0e857f0582137ec0aa8032f6979182cbfb','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',NULL,NULL,NULL,NULL,'api-teacher',1),(7,20152016,1,'f59ea4a2cb3c206a0fb0ebcd5b26cc6fe3886ce677f37f75c6c085e0d23347ac','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',3.6000,4.0000,4.0000,NULL,'satl-teacher',1),(8,20152016,1,'f59ea4a2cb3c206a0fb0ebcd5b26cc6fe3886ce677f37f75c6c085e0d23347ac','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',NULL,NULL,NULL,NULL,'satl-teacher',1),(9,20152016,1,'392a65f7836b15424f789c3457d3732d71ed13bb00363f411d1d8971cb35f7bc','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',3.6000,4.0000,4.0000,NULL,'cc-teacher',1),(10,20152016,1,'392a65f7836b15424f789c3457d3732d71ed13bb00363f411d1d8971cb35f7bc','ed6625448cf4c6ee468ea61f1ab47f24d4cb67298de04a8e4cfdde80b2ebb525',NULL,NULL,NULL,NULL,'cc-teacher',1),(11,20152016,1,'8e09c3e8b87080b8134e8ab20b5dc218cb0401a566976f1bc7793b19109e9b5e','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',NULL,NULL,NULL,NULL,'cc-teacher',1),(12,20152016,1,'ed6625448cf4c6ee468ea61f1ab47f24d4cb67298de04a8e4cfdde80b2ebb525','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e',3.6000,4.0000,4.0000,NULL,'ll-teacher',1),(13,20152016,1,'5eddf4d0e06126cdb14b13b16487711cfa7fd8f4f363a6406123dca11239150f','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4',NULL,NULL,NULL,NULL,'ll-teacher',1),(14,20152016,1,'5eddf4d0e06126cdb14b13b16487711cfa7fd8f4f363a6406123dca11239150f','8e09c3e8b87080b8134e8ab20b5dc218cb0401a566976f1bc7793b19109e9b5e',NULL,NULL,NULL,NULL,'ll-teacher',1);
/*!40000 ALTER TABLE `results_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_questionnaire`
--

DROP TABLE IF EXISTS `student_questionnaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_questionnaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percent` float(7,4) unsigned DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_questionnaire`
--

LOCK TABLES `student_questionnaire` WRITE;
/*!40000 ALTER TABLE `student_questionnaire` DISABLE KEYS */;
INSERT INTO `student_questionnaire` VALUES (1,100.0000,'How well does the teacher teach the subject?'),(2,0.0000,'Teacher is really, really prepared for  class.'),(3,0.0000,'Teacher is really, really prepared for  class.'),(4,0.0000,'Teacher is really, really prepared for  class.'),(5,0.0000,'Teacher is really, really prepared for  class.'),(6,0.0000,'Teacher is really, really prepared for  class.'),(7,0.0000,'Teacher knows his/her subject.'),(8,0.0000,'Teacher is organized and neat.'),(9,0.0000,'Teacher plans class time and assignments that help us solve problems and think critically.'),(10,0.0000,'Teacher has clear classroom procedures so we don\'t waste time.'),(11,0.0000,'Teacher is clear in giving directions and on explaining what is expected on assignments and tests.'),(12,0.0000,'Teacher is creative in developing activities and lessons.'),(13,0.0000,'Teacher provides activities that make subject matter meaningful.'),(14,0.0000,'Teacher returns homework, seatwork, projects, and tests in a timely manner.'),(15,0.0000,'Teacher gives me good feedback on homework and projects so that I can improve.'),(16,0.0000,'Teacher is flexible in accommodating for our individual needs.'),(17,0.0000,'Teachers grades fairly.'),(18,100.0000,'How well does the teachr model the core values through his/her behaviour with the students and with the other school personnel?'),(19,0.0000,'Teacher is sensitive and responsive to our needs.'),(20,0.0000,'Teacher listens and understands our opinions; he/she may not agree but we feel understood.'),(21,0.0000,'Teacher is willing to learn from us.'),(22,0.0000,'Teacher is willling to accept responsibility for his/her own mistakes.'),(23,0.0000,'Teacher is consistent, fair and firm in discipline without being to strict.'),(24,0.0000,'Teacher follows through on what he/she says. You can count on the teacher\'s word.'),(25,0.0000,'Teacher is fun to be with.'),(26,0.0000,'Teacher tries to model what teacher expects of students.'),(27,100.0000,'How well does the teacher inspire me to be responsible for my own learning?'),(28,0.0000,'I am encouraged to bring things needed for my learning.'),(29,0.0000,'I am motivated to come to his/her class on time.'),(30,0.0000,'I am enthused to speak up and be active in the class.'),(31,0.0000,'I am expected to submit my homework and projects on time.'),(32,0.0000,'I am always reminded to speak and act with respect.');
/*!40000 ALTER TABLE `student_questionnaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gradelevel` varchar(30) DEFAULT NULL,
  `section` varchar(60) NOT NULL,
  `subject` varchar(60) DEFAULT NULL,
  `teacherId` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,'grade 7','masipag','science','67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e'),(2,'grade 10','malumanay','science','1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4');
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teaching_competencies`
--

DROP TABLE IF EXISTS `teaching_competencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teaching_competencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percent` float(7,4) unsigned DEFAULT NULL,
  `content` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teaching_competencies`
--

LOCK TABLES `teaching_competencies` WRITE;
/*!40000 ALTER TABLE `teaching_competencies` DISABLE KEYS */;
INSERT INTO `teaching_competencies` VALUES (1,10.0000,'Lesson Planning'),(2,0.0000,'Brought lesson plans to class'),(3,0.0000,'Lesson plans were checked.'),(4,0.0000,'Lesson plans were updated.'),(5,35.0000,'Instructional Procedure'),(6,0.0000,'Communicates to the students lesson objective/s including the concept/s they will talk about and the product/s that will show understanding'),(7,0.0000,'The lesson motivation engages students and transitions smoothly to the learning activities in the procedure.'),(8,0.0000,'Teacher shows clear understanding of and presents accurate content.'),(9,0.0000,'Uses planned questions; TIEL components are evident in the lesson discussion'),(10,0.0000,'Provides activities and/or questions that require students to think and reason critically/analytically'),(11,0.0000,'Questions and activities are presented systematically and lead to the attainment of lesson objective/s.'),(12,0.0000,'Employs creative teaching styles and methodologies such as \"turn and talk, partner share, call a friend, small group discussions, etc. to facilitate discussion\"'),(13,0.0000,'Calls on students fairly using sufficient wait time'),(14,0.0000,'Uses effective instructional audio visual materials (pictures, photos, readings, art, music, diagrams, and others) and/or technology to facilitate student learning'),(15,0.0000,'Facilitates discussion of the subject matter and helps the students connect their lesson to their  experiences and previous lessons learned'),(16,0.0000,'Models work/task students are to do and involves students in setting criteria for their work/task during the guided practice'),(17,0.0000,'Assists students in summarizing/forming generalization about the lesson and self-evaluating work'),(18,0.0000,'Shows ability to adjust lessons/strategies to respond to unforeseen situations'),(19,0.0000,'Differentiates activities to address varied learner types'),(20,15.0000,'Communication and Appearance'),(21,0.0000,'Well-groomed'),(22,0.0000,'Portrays/uses refined manners and language'),(23,0.0000,'Uses prescribed medium of instruction with proficiency and when necessary, uses appropriate language to get the message across'),(24,0.0000,'Speaks clearly in well modulated voice'),(25,0.0000,'Encourages children to participate, show interest and enthusiasm for activities, and exceed their own expectations'),(26,0.0000,'Provides opportunity for the students to clarify their understanding of the concepts/ideas taken up'),(27,15.0000,'Classroom Management'),(28,0.0000,'Secures/prepares needed materials before class'),(29,0.0000,'Maintains order and discipline'),(30,0.0000,'Commands respect of the students'),(31,0.0000,'Employs systematic procedures for routine class activities like greeting the teacher, arranging chairs, picking up pieces of paper, getting attention after turn and talk or small group discussion.'),(32,20.0000,'Student Participation'),(33,0.0000,'The class is attentive.'),(34,0.0000,'Students are active and engaged with the different learning tasks.'),(35,0.0000,'Students are able to share their ideas and ask questions.'),(36,0.0000,'Students were able to accomplish the set objectives.'),(37,5.0000,'Professional Growth'),(38,0.0000,'Pursues graduate studies'),(39,0.0000,'Attends seminars, workshops, conferences and other training programs'),(40,0.0000,'Shares learnings with co-workers by conducting echo-seminars, workshops and other trainings'),(41,0.0000,'Reads professional books and other materials');
/*!40000 ALTER TABLE `teaching_competencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hashid` varchar(100) NOT NULL,
  `logid` varchar(100) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `utype` varchar(10) NOT NULL,
  `activation` tinyint(1) DEFAULT '0',
  `subject` varchar(60) DEFAULT NULL,
  `gradelevel` varchar(30) DEFAULT NULL,
  `section` varchar(60) DEFAULT NULL,
  `level` varchar(60) DEFAULT NULL,
  `cluster` varchar(20) DEFAULT NULL,
  `supervisor` varchar(60) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `logid` (`logid`),
  UNIQUE KEY `hashid` (`hashid`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'f6e8b8457aeaa3c1ed6eac02672b5a50ea5e1de7e9d6cffab485709b6bfc6ce2','clarklancaster1234','clark powers lancaster','$2y$07$5EWAY79f/UKeylijpLrMBeR9TYZl9plkzfTY..h2P6K8mZTJEvdRm','admin',1,NULL,NULL,NULL,NULL,NULL,'none',0),(11,'d74a5e27f51819a134eac166e0b507a358ddc0aca21271e02760860b5a017f0d','justinflores1234','justin cornelio flores','$2y$07$5EWAY79f/UKeylijpLrMBeR9TYZl9plkzfTY..h2P6K8mZTJEvdRm','admin',1,NULL,NULL,NULL,NULL,NULL,'none',0),(34,'a77c7510dae5251b07d0ecfd9e1f68284954fbd7e0f142444ae87bff5400ae32','principal','Principal','$2y$07$T8lEznC4T8/3H1ixNjxsrOlgFVQtxDm2viR.LmO/laRlKdGKSGGxy','faculty',1,'math',NULL,NULL,'high school','6','principal',0),(35,'b5834a9cea215ee6167befd49bec2a0e857f0582137ec0aa8032f6979182cbfb','asstprincipalinst','Assistant Principal for Inst','$2y$07$sUgK8DvR3HHoCUIBpUXHZeg/U6s6HTYFpke9.QkxMMo1RnK/TYn9i','faculty',1,'filipino',NULL,NULL,'high school','6','api',0),(53,'67128cdfc21239fb7468e7e15acef04b2ad0d5cf3e8ddc6e899248cca19c3d0e','teacher1','teacher1','$2y$07$nJSCiA4Y1WYQiir9c33qzuTsUmC8tnOFIGVTNv75ocdVNuEdDrONe','faculty',1,'science',NULL,NULL,'high school','5','none',0),(54,'1895dc08da433683829fcbd562a9b73ff2d469e284fe575943b2fc5947bd2bb4','teacher2','teacher2','$2y$07$/7T/H4ei66IYcpU/KHJXT.JrVzodTWQ94QFOfp4Eh/jksCxluyQmO','faculty',1,'science',NULL,NULL,'primary','2','none',0),(55,'31722f1d5e9d3f4ce139cc30ef3e759d8646e9957f86f76bc90c44f0a4887a41','student1','student1','$2y$07$os.NovmLjdcqtZVW2ezDSevz14sUaCUHUUbef4yiTvz0ZWvJi1f/y','student',1,NULL,'grade 7','masipag',NULL,NULL,'none',0),(56,'6e1fd77b6a21a7d6a4279d8f31105b51685e6366de57d312de53be4cc87cae8e','student2','student2','$2y$07$imctpBOfRe0U5LWBOvz8gu7pOc/EnQIitboGSxrp1Qzm044oCOW.K','student',1,NULL,'grade 10','malumanay',NULL,NULL,'none',0),(57,'ed6625448cf4c6ee468ea61f1ab47f24d4cb67298de04a8e4cfdde80b2ebb525','hslevel','hs level leader','$2y$07$nnzPF21iAX2F7SVoK74z4Oas6OI2WI6vinu2wDG1TL1rsWzywA.Eu','faculty',1,'math',NULL,NULL,'high school','5','ll',0),(58,'5eddf4d0e06126cdb14b13b16487711cfa7fd8f4f363a6406123dca11239150f','prilevel','pri level leader','$2y$07$eB/MlrPQZbl98fTlRjdrJ.rVUctMmNQ4DfspBKAlECI47GfJweRne','faculty',1,'english',NULL,NULL,'primary','3','ll',0),(59,'392a65f7836b15424f789c3457d3732d71ed13bb00363f411d1d8971cb35f7bc','cluster5','cluster5','$2y$07$J5WAgNWdp/AjulguvhWafOQCBhnIQd4t8ACLYxYUlZwhvdhdezFtG','faculty',1,'english',NULL,NULL,'intermediate','5','cc',0),(60,'8e09c3e8b87080b8134e8ab20b5dc218cb0401a566976f1bc7793b19109e9b5e','cluster2','cluster2','$2y$07$kkkXtmUl4G0FduOYTo9C8eyqjxXSwkceUykQD7yOdqoB7.6O9MhGW','faculty',1,'filipino',NULL,NULL,'primary','2','cc',0),(61,'f59ea4a2cb3c206a0fb0ebcd5b26cc6fe3886ce677f37f75c6c085e0d23347ac','sciencesatl','Sciencesatl','$2y$07$PDQ8G09zZr92fJl/SZwOfedaFMf9g0fjD6udTGCZ4EsOnp8GOw75W','faculty',1,'science',NULL,NULL,'primary','2','satl',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-31  2:11:31
