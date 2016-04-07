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
-- Table structure for table `admin_log`
--

DROP TABLE IF EXISTS `admin_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `userId` varchar(150) DEFAULT NULL,
  `event_type` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_log`
--

LOCK TABLES `admin_log` WRITE;
/*!40000 ALTER TABLE `admin_log` DISABLE KEYS */;
INSERT INTO `admin_log` VALUES (1,'2016-04-08 00:08:31','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506','User logged in'),(2,'2016-04-08 00:08:55','caa31e3d66b052be6b31350358c98ccb31e2de0c67f8383bd46ab476bcd54d96','User logged in'),(3,'2016-04-08 00:09:11','885983dfabbfd325fa8354ef58ec54503a7916045d1ce844a9ebd231596fa9ff','User logged in'),(4,'2016-04-08 00:10:24','d74a5e27f51819a134eac166e0b507a358ddc0aca21271e02760860b5a017f0d','User logged in'),(5,'2016-04-08 00:20:51','94ad576e31b1f40a78416012560ecec916615708e495ac3151f9b601f04fbb5b','User logged in'),(6,'2016-04-08 00:34:46','d74a5e27f51819a134eac166e0b507a358ddc0aca21271e02760860b5a017f0d','User logged in'),(7,'2016-04-08 00:35:23','d74a5e27f51819a134eac166e0b507a358ddc0aca21271e02760860b5a017f0d','User logged in');
/*!40000 ALTER TABLE `admin_log` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `final_ratings`
--

LOCK TABLES `final_ratings` WRITE;
/*!40000 ALTER TABLE `final_ratings` DISABLE KEYS */;
INSERT INTO `final_ratings` VALUES (1,20152016,1,'650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',0.0000,0.0000,0.0000,0.0000,0.0000),(2,20152016,1,'d02423a24809d1cc5a63f991a1fa52de14f5332caa5b38fd8ddf15d4d5f63fd3',0.0000,0.0000,0.0000,0.0000,0.0000),(3,20152016,1,'090012b5de669cdb6d810ea8e8f5b03609f9905552e6a6dd12954003d3dd84bc',0.0000,0.0000,0.0000,0.0000,0.0000),(4,20152016,1,'30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728',0.0000,0.0000,0.0000,0.0000,0.0000),(5,20152016,1,'a7789158389d8912801882735bb52c853bb6f87a30f279e5ac654dfbbda81a14',0.0000,0.0000,0.0000,0.0000,0.0000),(6,20152016,1,'275df542ed21b8d45bf6f2bb3242beed45db16f6c2568a5d0b9f3642a54f9ffc',0.0000,0.0000,0.0000,0.0000,0.0000),(7,20152016,1,'9f2a67ed3910bb697fa58d98659cc70dd09fa585fa7da1232c3c49d8bdadf82a',0.0000,0.0000,0.0000,0.0000,0.0000),(8,20152016,1,'18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',0.0000,0.0000,0.0000,0.0000,0.0000),(9,20152016,1,'8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',0.0000,0.0000,0.0000,0.0000,0.0000),(10,20152016,1,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05',0.0000,0.0000,0.0000,0.0000,0.0000),(11,20152016,1,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c',0.0000,0.0000,0.0000,0.0000,0.0000),(12,20152016,2,'650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',0.0000,0.0000,0.0000,0.0000,0.0000),(13,20152016,2,'d02423a24809d1cc5a63f991a1fa52de14f5332caa5b38fd8ddf15d4d5f63fd3',0.0000,0.0000,0.0000,0.0000,0.0000),(14,20152016,2,'090012b5de669cdb6d810ea8e8f5b03609f9905552e6a6dd12954003d3dd84bc',0.0000,0.0000,0.0000,0.0000,0.0000),(15,20152016,2,'30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728',0.0000,0.0000,0.0000,0.0000,0.0000),(16,20152016,2,'a7789158389d8912801882735bb52c853bb6f87a30f279e5ac654dfbbda81a14',0.0000,0.0000,0.0000,0.0000,0.0000),(17,20152016,2,'275df542ed21b8d45bf6f2bb3242beed45db16f6c2568a5d0b9f3642a54f9ffc',0.0000,0.0000,0.0000,0.0000,0.0000),(18,20152016,2,'9f2a67ed3910bb697fa58d98659cc70dd09fa585fa7da1232c3c49d8bdadf82a',0.0000,0.0000,0.0000,0.0000,0.0000),(19,20152016,2,'18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',0.0000,0.0000,0.0000,0.0000,0.0000),(20,20152016,2,'8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',0.0000,0.0000,0.0000,0.0000,0.0000),(21,20152016,2,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05',0.0000,0.0000,0.0000,0.0000,0.0000),(22,20152016,2,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c',0.0000,0.0000,0.0000,0.0000,0.0000);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `final_ratings_archive`
--

LOCK TABLES `final_ratings_archive` WRITE;
/*!40000 ALTER TABLE `final_ratings_archive` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results`
--

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
INSERT INTO `results` VALUES (1,20152016,1,'650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'self',0),(2,20152016,1,'d02423a24809d1cc5a63f991a1fa52de14f5332caa5b38fd8ddf15d4d5f63fd3','d02423a24809d1cc5a63f991a1fa52de14f5332caa5b38fd8ddf15d4d5f63fd3',NULL,NULL,NULL,NULL,'self',0),(3,20152016,1,'090012b5de669cdb6d810ea8e8f5b03609f9905552e6a6dd12954003d3dd84bc','090012b5de669cdb6d810ea8e8f5b03609f9905552e6a6dd12954003d3dd84bc',NULL,NULL,NULL,NULL,'self',0),(4,20152016,1,'30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728','30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728',NULL,NULL,NULL,NULL,'self',0),(5,20152016,1,'a7789158389d8912801882735bb52c853bb6f87a30f279e5ac654dfbbda81a14','a7789158389d8912801882735bb52c853bb6f87a30f279e5ac654dfbbda81a14',NULL,NULL,NULL,NULL,'self',0),(6,20152016,1,'275df542ed21b8d45bf6f2bb3242beed45db16f6c2568a5d0b9f3642a54f9ffc','275df542ed21b8d45bf6f2bb3242beed45db16f6c2568a5d0b9f3642a54f9ffc',NULL,NULL,NULL,NULL,'self',0),(7,20152016,1,'9f2a67ed3910bb697fa58d98659cc70dd09fa585fa7da1232c3c49d8bdadf82a','9f2a67ed3910bb697fa58d98659cc70dd09fa585fa7da1232c3c49d8bdadf82a',NULL,NULL,NULL,NULL,'self',0),(8,20152016,1,'18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',NULL,NULL,NULL,NULL,'self',0),(9,20152016,1,'8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05','8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',NULL,NULL,NULL,NULL,'self',0),(10,20152016,1,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05',NULL,NULL,NULL,NULL,'self',0),(11,20152016,1,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c',NULL,NULL,NULL,NULL,'self',0),(12,20152016,1,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'principal-teacher',0),(13,20152016,1,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'api-teacher',0),(14,20152016,1,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','d02423a24809d1cc5a63f991a1fa52de14f5332caa5b38fd8ddf15d4d5f63fd3',NULL,NULL,NULL,NULL,'principal-teacher',0),(15,20152016,1,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','d02423a24809d1cc5a63f991a1fa52de14f5332caa5b38fd8ddf15d4d5f63fd3',NULL,NULL,NULL,NULL,'api-teacher',0),(16,20152016,1,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','090012b5de669cdb6d810ea8e8f5b03609f9905552e6a6dd12954003d3dd84bc',NULL,NULL,NULL,NULL,'principal-teacher',0),(17,20152016,1,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','090012b5de669cdb6d810ea8e8f5b03609f9905552e6a6dd12954003d3dd84bc',NULL,NULL,NULL,NULL,'api-teacher',0),(18,20152016,1,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728',NULL,NULL,NULL,NULL,'principal-teacher',0),(19,20152016,1,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728',NULL,NULL,NULL,NULL,'api-teacher',0),(20,20152016,1,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','a7789158389d8912801882735bb52c853bb6f87a30f279e5ac654dfbbda81a14',NULL,NULL,NULL,NULL,'principal-teacher',0),(21,20152016,1,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','a7789158389d8912801882735bb52c853bb6f87a30f279e5ac654dfbbda81a14',NULL,NULL,NULL,NULL,'api-teacher',0),(22,20152016,1,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','275df542ed21b8d45bf6f2bb3242beed45db16f6c2568a5d0b9f3642a54f9ffc',NULL,NULL,NULL,NULL,'principal-teacher',0),(23,20152016,1,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','275df542ed21b8d45bf6f2bb3242beed45db16f6c2568a5d0b9f3642a54f9ffc',NULL,NULL,NULL,NULL,'api-teacher',0),(24,20152016,1,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','9f2a67ed3910bb697fa58d98659cc70dd09fa585fa7da1232c3c49d8bdadf82a',NULL,NULL,NULL,NULL,'principal-teacher',0),(25,20152016,1,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','9f2a67ed3910bb697fa58d98659cc70dd09fa585fa7da1232c3c49d8bdadf82a',NULL,NULL,NULL,NULL,'api-teacher',0),(26,20152016,1,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',NULL,NULL,NULL,NULL,'principal-teacher',0),(27,20152016,1,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',NULL,NULL,NULL,NULL,'api-teacher',0),(28,20152016,1,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',NULL,NULL,NULL,NULL,'principal-teacher',0),(29,20152016,1,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',NULL,NULL,NULL,NULL,'api-teacher',0),(30,20152016,1,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05',NULL,NULL,NULL,NULL,'principal-teacher',0),(31,20152016,1,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05',NULL,NULL,NULL,NULL,'api-teacher',0),(32,20152016,1,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c',NULL,NULL,NULL,NULL,'principal-teacher',0),(33,20152016,1,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c',NULL,NULL,NULL,NULL,'api-teacher',0),(34,20152016,1,'18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'satl-teacher',0),(35,20152016,1,'18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',NULL,NULL,NULL,NULL,'satl-teacher',0),(36,20152016,1,'8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05','8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',NULL,NULL,NULL,NULL,'satl-teacher',0),(37,20152016,1,'275df542ed21b8d45bf6f2bb3242beed45db16f6c2568a5d0b9f3642a54f9ffc','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'cc-teacher',0),(38,20152016,1,'30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'ll-teacher',0),(39,20152016,1,'30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',NULL,NULL,NULL,NULL,'ll-teacher',0),(40,20152016,1,'30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728','8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',NULL,NULL,NULL,NULL,'ll-teacher',0),(41,20152016,1,'885983dfabbfd325fa8354ef58ec54503a7916045d1ce844a9ebd231596fa9ff','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'student-teacher',0),(42,20152016,1,'885983dfabbfd325fa8354ef58ec54503a7916045d1ce844a9ebd231596fa9ff','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'student-teacher',0),(43,20152016,1,'94ad576e31b1f40a78416012560ecec916615708e495ac3151f9b601f04fbb5b','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'student-teacher',0),(44,20152016,1,'94ad576e31b1f40a78416012560ecec916615708e495ac3151f9b601f04fbb5b','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',NULL,NULL,NULL,NULL,'student-teacher',0),(45,20152016,1,'94ad576e31b1f40a78416012560ecec916615708e495ac3151f9b601f04fbb5b','8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',NULL,NULL,NULL,NULL,'student-teacher',0),(46,20152016,2,'650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'self',0),(47,20152016,2,'d02423a24809d1cc5a63f991a1fa52de14f5332caa5b38fd8ddf15d4d5f63fd3','d02423a24809d1cc5a63f991a1fa52de14f5332caa5b38fd8ddf15d4d5f63fd3',NULL,NULL,NULL,NULL,'self',0),(48,20152016,2,'090012b5de669cdb6d810ea8e8f5b03609f9905552e6a6dd12954003d3dd84bc','090012b5de669cdb6d810ea8e8f5b03609f9905552e6a6dd12954003d3dd84bc',NULL,NULL,NULL,NULL,'self',0),(49,20152016,2,'30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728','30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728',NULL,NULL,NULL,NULL,'self',0),(50,20152016,2,'a7789158389d8912801882735bb52c853bb6f87a30f279e5ac654dfbbda81a14','a7789158389d8912801882735bb52c853bb6f87a30f279e5ac654dfbbda81a14',NULL,NULL,NULL,NULL,'self',0),(51,20152016,2,'275df542ed21b8d45bf6f2bb3242beed45db16f6c2568a5d0b9f3642a54f9ffc','275df542ed21b8d45bf6f2bb3242beed45db16f6c2568a5d0b9f3642a54f9ffc',NULL,NULL,NULL,NULL,'self',0),(52,20152016,2,'9f2a67ed3910bb697fa58d98659cc70dd09fa585fa7da1232c3c49d8bdadf82a','9f2a67ed3910bb697fa58d98659cc70dd09fa585fa7da1232c3c49d8bdadf82a',NULL,NULL,NULL,NULL,'self',0),(53,20152016,2,'18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',NULL,NULL,NULL,NULL,'self',0),(54,20152016,2,'8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05','8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',NULL,NULL,NULL,NULL,'self',0),(55,20152016,2,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05',NULL,NULL,NULL,NULL,'self',0),(56,20152016,2,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c',NULL,NULL,NULL,NULL,'self',0),(57,20152016,2,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'principal-teacher',0),(58,20152016,2,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'api-teacher',0),(59,20152016,2,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','d02423a24809d1cc5a63f991a1fa52de14f5332caa5b38fd8ddf15d4d5f63fd3',NULL,NULL,NULL,NULL,'principal-teacher',0),(60,20152016,2,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','d02423a24809d1cc5a63f991a1fa52de14f5332caa5b38fd8ddf15d4d5f63fd3',NULL,NULL,NULL,NULL,'api-teacher',0),(61,20152016,2,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','090012b5de669cdb6d810ea8e8f5b03609f9905552e6a6dd12954003d3dd84bc',NULL,NULL,NULL,NULL,'principal-teacher',0),(62,20152016,2,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','090012b5de669cdb6d810ea8e8f5b03609f9905552e6a6dd12954003d3dd84bc',NULL,NULL,NULL,NULL,'api-teacher',0),(63,20152016,2,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728',NULL,NULL,NULL,NULL,'principal-teacher',0),(64,20152016,2,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728',NULL,NULL,NULL,NULL,'api-teacher',0),(65,20152016,2,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','a7789158389d8912801882735bb52c853bb6f87a30f279e5ac654dfbbda81a14',NULL,NULL,NULL,NULL,'principal-teacher',0),(66,20152016,2,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','a7789158389d8912801882735bb52c853bb6f87a30f279e5ac654dfbbda81a14',NULL,NULL,NULL,NULL,'api-teacher',0),(67,20152016,2,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','275df542ed21b8d45bf6f2bb3242beed45db16f6c2568a5d0b9f3642a54f9ffc',NULL,NULL,NULL,NULL,'principal-teacher',0),(68,20152016,2,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','275df542ed21b8d45bf6f2bb3242beed45db16f6c2568a5d0b9f3642a54f9ffc',NULL,NULL,NULL,NULL,'api-teacher',0),(69,20152016,2,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','9f2a67ed3910bb697fa58d98659cc70dd09fa585fa7da1232c3c49d8bdadf82a',NULL,NULL,NULL,NULL,'principal-teacher',0),(70,20152016,2,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','9f2a67ed3910bb697fa58d98659cc70dd09fa585fa7da1232c3c49d8bdadf82a',NULL,NULL,NULL,NULL,'api-teacher',0),(71,20152016,2,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',NULL,NULL,NULL,NULL,'principal-teacher',0),(72,20152016,2,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',NULL,NULL,NULL,NULL,'api-teacher',0),(73,20152016,2,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',NULL,NULL,NULL,NULL,'principal-teacher',0),(74,20152016,2,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',NULL,NULL,NULL,NULL,'api-teacher',0),(75,20152016,2,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05',NULL,NULL,NULL,NULL,'principal-teacher',0),(76,20152016,2,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05',NULL,NULL,NULL,NULL,'api-teacher',0),(77,20152016,2,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c',NULL,NULL,NULL,NULL,'principal-teacher',0),(78,20152016,2,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c',NULL,NULL,NULL,NULL,'api-teacher',0),(79,20152016,2,'18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'satl-teacher',0),(80,20152016,2,'18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',NULL,NULL,NULL,NULL,'satl-teacher',0),(81,20152016,2,'8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05','8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',NULL,NULL,NULL,NULL,'satl-teacher',0),(82,20152016,2,'275df542ed21b8d45bf6f2bb3242beed45db16f6c2568a5d0b9f3642a54f9ffc','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'cc-teacher',0),(83,20152016,2,'30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'ll-teacher',0),(84,20152016,2,'30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',NULL,NULL,NULL,NULL,'ll-teacher',0),(85,20152016,2,'30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728','8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',NULL,NULL,NULL,NULL,'ll-teacher',0),(86,20152016,2,'885983dfabbfd325fa8354ef58ec54503a7916045d1ce844a9ebd231596fa9ff','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'student-teacher',0),(87,20152016,2,'885983dfabbfd325fa8354ef58ec54503a7916045d1ce844a9ebd231596fa9ff','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'student-teacher',0),(88,20152016,2,'94ad576e31b1f40a78416012560ecec916615708e495ac3151f9b601f04fbb5b','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb',NULL,NULL,NULL,NULL,'student-teacher',0),(89,20152016,2,'94ad576e31b1f40a78416012560ecec916615708e495ac3151f9b601f04fbb5b','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506',NULL,NULL,NULL,NULL,'student-teacher',0),(90,20152016,2,'94ad576e31b1f40a78416012560ecec916615708e495ac3151f9b601f04fbb5b','8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05',NULL,NULL,NULL,NULL,'student-teacher',0);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results_archive`
--

LOCK TABLES `results_archive` WRITE;
/*!40000 ALTER TABLE `results_archive` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_questionnaire`
--

LOCK TABLES `student_questionnaire` WRITE;
/*!40000 ALTER TABLE `student_questionnaire` DISABLE KEYS */;
INSERT INTO `student_questionnaire` VALUES (1,100.0000,'How well does the teacher teach the subject?'),(2,0.0000,'Teacher is prepared for  class.'),(3,0.0000,'Teacher knows his/her subject.'),(4,0.0000,'Teacher is organized and neat.'),(5,0.0000,'Teacher plans class time and assignments that help us solve problems and think critically.'),(6,0.0000,'Teacher has clear classroom procedures so we don\'t waste time.'),(7,0.0000,'Teacher is clear in giving directions and on explaining what is expected on assignments and tests.'),(8,0.0000,'Teacher is creative in developing activities and lessons.'),(9,0.0000,'Teacher provides activities that make subject matter meaningful.'),(10,0.0000,'Teacher returns homework, seatwork, projects, and tests in a timely manner.'),(11,0.0000,'Teacher gives me good feedback on homework and projects so that I can improve.'),(12,0.0000,'Teacher is flexible in accommodating for our individual needs.'),(13,0.0000,'Teachers grades fairly.'),(14,100.0000,'How well does the teachr model the core values through his/her behaviour with the students and with the other school personnel?'),(15,0.0000,'Teacher is sensitive and responsive to our needs.'),(16,0.0000,'Teacher listens and understands our opinions; he/she may not agree but we feel understood.'),(17,0.0000,'Teacher is willing to learn from us.'),(18,0.0000,'Teacher is willling to accept responsibility for his/her own mistakes.'),(19,0.0000,'Teacher is consistent, fair and firm in discipline without being to strict.'),(20,0.0000,'Teacher follows through on what he/she says. You can count on the teacher\'s word.'),(21,0.0000,'Teacher is fun to be with.'),(22,0.0000,'Teacher tries to model what teacher expects of students.'),(23,100.0000,'How well does the teacher inspire me to be responsible for my own learning?'),(24,0.0000,'I am encouraged to bring things needed for my learning.'),(25,0.0000,'I am motivated to come to his/her class on time.'),(26,0.0000,'I am enthused to speak up and be active in the class.'),(27,0.0000,'I am expected to submit my homework and projects on time.'),(28,0.0000,'I am always reminded to speak and act with respect.');
/*!40000 ALTER TABLE `student_questionnaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject_areas`
--

DROP TABLE IF EXISTS `subject_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject_areas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(60) DEFAULT NULL,
  `subject_area` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject_areas`
--

LOCK TABLES `subject_areas` WRITE;
/*!40000 ALTER TABLE `subject_areas` DISABLE KEYS */;
INSERT INTO `subject_areas` VALUES (1,'Biology I','Science'),(2,'Chemistry I','Science'),(3,'Physics I','Science'),(4,'Algebra','Math'),(5,'Geometry','Math');
/*!40000 ALTER TABLE `subject_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gradelevel` int(11) DEFAULT NULL,
  `section` varchar(60) NOT NULL,
  `subject` varchar(60) DEFAULT NULL,
  `teacherId` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` VALUES (1,10,'mahiwaga','biology i','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb'),(2,10,'mahiwaga','physics i','18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506'),(3,10,'mahiwaga','algebra','8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05'),(4,7,'marikit','biology i','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb'),(5,7,'marikit','chemistry i','650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb');
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
  `gradelevel` int(11) DEFAULT NULL,
  `section` varchar(60) DEFAULT NULL,
  `level` varchar(60) DEFAULT NULL,
  `cluster` varchar(20) DEFAULT NULL,
  `supervisor` varchar(60) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `timeout` datetime DEFAULT NULL,
  `login_times` tinyint(4) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `logid` (`logid`),
  UNIQUE KEY `hashid` (`hashid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'f6e8b8457aeaa3c1ed6eac02672b5a50ea5e1de7e9d6cffab485709b6bfc6ce2','clarklancaster1234','clark powers lancaster','$2y$07$5EWAY79f/UKeylijpLrMBeR9TYZl9plkzfTY..h2P6K8mZTJEvdRm','admin',1,NULL,NULL,NULL,NULL,NULL,'none',0,NULL,0),(11,'d74a5e27f51819a134eac166e0b507a358ddc0aca21271e02760860b5a017f0d','justinflores1234','Justin Cornelio Flores','$2y$07$5EWAY79f/UKeylijpLrMBeR9TYZl9plkzfTY..h2P6K8mZTJEvdRm','admin',1,NULL,NULL,NULL,NULL,NULL,'none',0,NULL,0),(12,'caa31e3d66b052be6b31350358c98ccb31e2de0c67f8383bd46ab476bcd54d96','studentone','Student One','$2y$07$fujMajEJSGBkXLNBmLALUuPNoy81DPqAuaydtM70L3jvas2OSY8cm','student',1,'none',4,'masaya','none','none','none',0,NULL,0),(13,'885983dfabbfd325fa8354ef58ec54503a7916045d1ce844a9ebd231596fa9ff','student2','Student 2','$2y$07$fujMajEJSGBkXLNBmLALUuPNoy81DPqAuaydtM70L3jvas2OSY8cm','student',1,'none',7,'marikit','none','none','none',0,NULL,0),(14,'94ad576e31b1f40a78416012560ecec916615708e495ac3151f9b601f04fbb5b','studentiii','Student III','$2y$07$fujMajEJSGBkXLNBmLALUuPNoy81DPqAuaydtM70L3jvas2OSY8cm','student',1,'none',10,'mahiwaga','none','none','none',0,NULL,0),(15,'650151a02517d05f6e4d44cd6481c1ed2dc55114cf6fef766883a0c9eb495ceb','teacher1','Teacher 1','$2y$07$Rrw0wEI5BQ.hXCutOb./TeNti92EmF6N9JAR8GDBmU9a8rI/z9Wde','faculty',1,'none',0,'none','none','none','none',0,NULL,0),(16,'d02423a24809d1cc5a63f991a1fa52de14f5332caa5b38fd8ddf15d4d5f63fd3','teacher2','Teacher 2','$2y$07$Rrw0wEI5BQ.hXCutOb./TeNti92EmF6N9JAR8GDBmU9a8rI/z9Wde','faculty',1,'none',0,'none','none','none','none',0,NULL,0),(17,'090012b5de669cdb6d810ea8e8f5b03609f9905552e6a6dd12954003d3dd84bc','teacheriii','Teacher III','$2y$07$Rrw0wEI5BQ.hXCutOb./TeNti92EmF6N9JAR8GDBmU9a8rI/z9Wde','faculty',1,'none',0,'none','none','none','none',0,NULL,0),(18,'30326136cf086b406b45f133fb0a991e68c8e5ee2181d2e2ecea7ea8aaa25728','highschoolll','High School LL','$2y$07$Rrw0wEI5BQ.hXCutOb./TeNti92EmF6N9JAR8GDBmU9a8rI/z9Wde','faculty',1,'none',0,'none','high school','none','ll',0,NULL,0),(19,'a7789158389d8912801882735bb52c853bb6f87a30f279e5ac654dfbbda81a14','cluster4','Cluster 4','$2y$07$Rrw0wEI5BQ.hXCutOb./TeNti92EmF6N9JAR8GDBmU9a8rI/z9Wde','faculty',1,'none',0,'none','none','4','cc',0,NULL,0),(20,'275df542ed21b8d45bf6f2bb3242beed45db16f6c2568a5d0b9f3642a54f9ffc','cluster5','Cluster 5','$2y$07$Rrw0wEI5BQ.hXCutOb./TeNti92EmF6N9JAR8GDBmU9a8rI/z9Wde','faculty',1,'none',0,'none','none','5','cc',0,NULL,0),(21,'9f2a67ed3910bb697fa58d98659cc70dd09fa585fa7da1232c3c49d8bdadf82a','intermediatell','Intermediate LL','$2y$07$Rrw0wEI5BQ.hXCutOb./TeNti92EmF6N9JAR8GDBmU9a8rI/z9Wde','faculty',1,'none',0,'none','intermediate','none','ll',0,NULL,0),(22,'18fb35ca5d3a26b4f881d47678a936deb687f9d04fbe930b40c00a97258e5506','sciencesatl','Science SATL','$2y$07$Rrw0wEI5BQ.hXCutOb./TeNti92EmF6N9JAR8GDBmU9a8rI/z9Wde','faculty',1,'science',0,'none','none','none','satl',0,NULL,0),(23,'8bb4a58a63ec9d34c75859b4a51cd1577a0ca900786a34abd28b015c115d9f05','mathsatl','Math SATL','$2y$07$Rrw0wEI5BQ.hXCutOb./TeNti92EmF6N9JAR8GDBmU9a8rI/z9Wde','faculty',1,'math',0,'none','none','none','satl',0,NULL,0),(24,'c609317da85090ec7d9152e61551e11658b0432909b808f71f601ef993be8d05','principal','Principal','$2y$07$Rrw0wEI5BQ.hXCutOb./TeNti92EmF6N9JAR8GDBmU9a8rI/z9Wde','faculty',1,'none',0,'none','none','none','principal',0,NULL,0),(25,'cb8876939087f208bb0b61e03d1cdad2d8a8374e08cb331d7e59999a24d2920c','asst.principal','Asst. Principal','$2y$07$Rrw0wEI5BQ.hXCutOb./TeNti92EmF6N9JAR8GDBmU9a8rI/z9Wde','faculty',1,'none',0,'none','none','none','api',0,NULL,0);
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

-- Dump completed on 2016-04-08  0:42:14
