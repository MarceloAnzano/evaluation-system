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
  `rating` float(7,4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `final_ratings`
--

LOCK TABLES `final_ratings` WRITE;
/*!40000 ALTER TABLE `final_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `final_ratings` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `img_uploads`
--

LOCK TABLES `img_uploads` WRITE;
/*!40000 ALTER TABLE `img_uploads` DISABLE KEYS */;
INSERT INTO `img_uploads` VALUES (1,'28bf3712266ccb584cbbf9aa63d209156ff232c48f8086c463e0492ffc6c8c75','http://jeytee.net/images/cute_white_cat.jpg');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results`
--

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_questionnaire`
--

LOCK TABLES `student_questionnaire` WRITE;
/*!40000 ALTER TABLE `student_questionnaire` DISABLE KEYS */;
INSERT INTO `student_questionnaire` VALUES (1,100.0000,'Teaching Skill'),(2,0.0000,'The instructor expresses clear expectations for my learning and performance in this class.'),(3,0.0000,'The instructor clearly explains concepts.'),(4,0.0000,'The instructor clarifies areas of confusion.'),(5,0.0000,'The instructor uses effective teaching methods that enhance my learning.'),(6,0.0000,'The instructor encourages me to raise questions or make comments.'),(7,0.0000,'The instructor is well organized and prepared.'),(8,0.0000,'The instructor challenges me to think.'),(9,0.0000,'The instructor is available on an individual basis outside of class when I request it.'),(10,0.0000,'The instructor uses technology effectively to advance my learning.'),(11,0.0000,'The instructor contributes to improving my learning.'),(12,100.0000,'Motivation and Encouragement'),(13,0.0000,'I attend class regularly.'),(14,0.0000,'I come to class prepared.'),(15,0.0000,'I actively participate in discussions and projects.'),(16,0.0000,'I have put a great deal of effort into advancing my learning in this course.'),(17,0.0000,'In this course, I have been challenged to learn more than I expected.'),(18,0.0000,'I am working up to my potential in this course.'),(19,0.0000,'I have made my best effort to participate in this course.'),(20,100.0000,'Outcome'),(21,0.0000,'I have learned a lot in this class.'),(22,0.0000,'This class has increased my interest in this field of study.'),(23,0.0000,'The instructor shows respect and concern for students.'),(24,0.0000,'I believe that what I am being asked to learn in this course is important.'),(25,100.0000,'Effectiveness of Methods'),(26,0.0000,'The assignments in this course have enhanced my learning.'),(27,0.0000,'The tests accurately assess what I have learned in this course.'),(28,0.0000,'The instructor has high standards for achievement in this class.'),(29,0.0000,'The instructor provides clear evaluation criteria.'),(30,0.0000,'The instructor grades consistently with the evaluation criteria.'),(31,0.0000,'The assignments are returned quickly enough to benefit my learning.'),(32,0.0000,'The exam results are returned quickly enough to benefit my learning.'),(33,0.0000,'The feedback I have received on my work has enhanced my learning.');
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
  `year` int(11) DEFAULT NULL,
  `semester` varchar(60) DEFAULT NULL,
  `gradelevel` varchar(30) DEFAULT NULL,
  `section` varchar(60) NOT NULL,
  `subject` varchar(60) DEFAULT NULL,
  `teacherId` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
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
  `hashid` varchar(100) DEFAULT NULL,
  `logid` varchar(50) NOT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'28bf3712266ccb584cbbf9aa63d209156ff232c48f8086c463e0492ffc6c8c75','sallymorganq0003','Sally Hendrix Morgan','$2y$07$CCU390Ed/6Ghp2DV7rPlYOzaus6zbazTEfClN25LFvLRtpK0sje42','faculty',1,'english',NULL,NULL,'intermediate','2','none'),(2,'6e65ee2c03dde4af4bb2f5adcd9ea7afe71201fdfbef19d888048885d5df7cd1','suzannemorganq0004','suzanne hendrix morgan','$2y$07$AzZyDB69fPlY1kQWc8bx7uApMR1Hg32lhGenClTxU0qWsqMeQXhGu','faculty',1,'english',NULL,NULL,'1','4','none'),(3,'abc299c77a19466d2fd9fdbfc1802631fa1eacea369a392e241fa186e9c81d6b','arielleroyq0005','ariel ross leroy','$2y$07$5EWAY79f/UKeylijpLrMBeR9TYZl9plkzfTY..h2P6K8mZTJEvdRm','faculty',0,'drama',NULL,NULL,'1','4','none'),(4,'8db451328a883fb5288619bd818ab9ed4895d05c2ac6121c069fee37db694f1f','ronaldcalvinq0006','ronald bumgarner calvin','$2y$07$5EWAY79f/UKeylijpLrMBeR9TYZl9plkzfTY..h2P6K8mZTJEvdRm','faculty',0,'math',NULL,NULL,'1','4','none'),(5,'0bd566f99ffb8ce6a60ab7e79f02fa686b00e4b2d1d5e14cfc552176a184225e','jeremyfisherq0007','jeremy fox fisher','$2y$07$5EWAY79f/UKeylijpLrMBeR9TYZl9plkzfTY..h2P6K8mZTJEvdRm','student',1,NULL,'grade 6','section 1',NULL,NULL,'none'),(6,'70a9f6dd8376a43ce69fccc064722d247259d6f7efcc8cb5add3acaa3d7132a9','hubertdaleq0008','hubert comber dale','$2y$07$5EWAY79f/UKeylijpLrMBeR9TYZl9plkzfTY..h2P6K8mZTJEvdRm','student',0,NULL,'grade 6','section 1',NULL,NULL,'none'),(7,'ca3b40c7b3059aeb1cb30eb13a5a5a340744e118ece8a6aef417d76636164cef','margaretbaxterq0009','margaret stuart baxter','$2y$07$5EWAY79f/UKeylijpLrMBeR9TYZl9plkzfTY..h2P6K8mZTJEvdRm','student',0,NULL,'grade 2','section 1',NULL,NULL,'none'),(8,'afd74fbdcca0713c9daa87460c5c38773b99deac1abc6f31556ea60754471e4b','michaelmeyersq0010','michael grimm meyers','$2y$07$5EWAY79f/UKeylijpLrMBeR9TYZl9plkzfTY..h2P6K8mZTJEvdRm','student',0,NULL,'grade 2','section 1',NULL,NULL,'none'),(9,'c09a0eb6436622ffc5dab5a9ac6fffcf6f50a7153bbc6a4f27e97d9ec8a28b13','elizagordonq0011','eliza smith gordon','$2y$07$5EWAY79f/UKeylijpLrMBeR9TYZl9plkzfTY..h2P6K8mZTJEvdRm','faculty',1,'english',NULL,NULL,'1','2','cc'),(10,'f6e8b8457aeaa3c1ed6eac02672b5a50ea5e1de7e9d6cffab485709b6bfc6ce2','clarklancaster1234','clark powers lancaster','$2y$07$5EWAY79f/UKeylijpLrMBeR9TYZl9plkzfTY..h2P6K8mZTJEvdRm','admin',0,NULL,NULL,NULL,NULL,NULL,'none'),(11,'d74a5e27f51819a134eac166e0b507a358ddc0aca21271e02760860b5a017f0d','justinflores1234','justin cornelio flores','$2y$07$5EWAY79f/UKeylijpLrMBeR9TYZl9plkzfTY..h2P6K8mZTJEvdRm','admin',1,NULL,NULL,NULL,NULL,NULL,'none'),(25,'d019f6d820d2f6bd0e2dc3b68c21f4354b07cf42f8b191b5224cfc9ef868864a','lorinarittenhouse','Lorina Rittenhouse','$2y$07$HLOmzGkzlYtB4K8J8.kG1ONDlUW1WOdGeGgElpQV6OYqSVfTRff5a','faculty',1,'math',NULL,NULL,'1','4','principal'),(26,'968e71b47865074d115df74872acd50117f15940ab79227df624cc1e5b6aa43a','patriciaangel','Patricia Angel','$2y$07$SMi/nUfCnnVa3BpgpoWUCu1gU86Av9.sS0Fkj5Ig3LC0ttxduRGwC','faculty',1,'science',NULL,NULL,'1','4','api'),(27,'2ca8349cfbd38fd811d246007c3685aed02191509e846db07a58177f15bbd007','calvinlightsey','Calvin Lightsey','$2y$07$aGmoGk57rlDwSJYsDLg5Gei7EK75vjQou3VQGXlcih3GJk7ndXXRm','faculty',1,'english',NULL,NULL,'1','4','satl'),(28,'7e730ee2bcfc7c8fe6105e338bc822db8424a5a0e895093f6a489893b78f9d1d','felipebounds','Felipe Bounds','$2y$07$mZmYxMHpI6CLAgJCZQKKHuMz77ZOWFygplfjbX41qoYrssfWQ.7b6','faculty',0,'math',NULL,NULL,'primary','4','ll'),(29,'9b67fb2bef1c312ff88ae1a6e3c0d78d85571f53c2f03fb4c58cb7819e7fd488','nicolebucko','Nicolle Bucko','$2y$07$hXatcutjJdkAYbS8WGYRteMAD8X2XUVwg.T0R2F87I2AU3CbFVpze','faculty',0,'science',NULL,NULL,'1','4','none'),(30,'28866f2d5907b2022e2a005aab0d973b857f458611343091cffb945226d8516e','melissamulvaney','Melissa Mulvaney','$2y$07$CKWdxymjCgNJUS7mqR.9ZOTuKJHesGUdZ0HggqaYyT9zJJEn9v3Qe','faculty',0,'drama',NULL,NULL,'2','4','none'),(31,'b28f6d958e4c1aa9349e1cd6ffb8e0f0bfefa959e3bc5d9047c667f954c6a13e','ernestinanajera','Ernestina Najera','$2y$07$1iDnc0Udh1kT7u01Cyxkve6Z49lb2KGcIj6BiWd5/50hfJRi3pd7q','faculty',0,'math',NULL,NULL,'2','4','none'),(32,'c97b409496e6b9cecb10f76faa89f8da081cac09519d0f0130a855684fa9a939','herthajurgens','Hertha Jurgens','$2y$07$RfZFgS3XRqU6rFlwmh4yzuEOqa/cuAGcchR9ZnwlkOTJy0CUGVnA2','faculty',0,'english',NULL,NULL,'high school','4','ll'),(33,'5cfda4a8bb49a07cb67b766cc2bb8acb87e714608b006f84d19237cb1bae5271','fredericdurkin','Frederic Durkin','$2y$07$RMVP8zBhTP5uHfjwgPgoW.KmANReEWxUGUsW81ngiK7Vw4woa421.','faculty',0,'filipino',NULL,NULL,'2','3','cc'),(34,'04c9e86a6cdc4a578362ffa446b015cd9e2e6a1a2db3740ba362bdbeabf4ebb1','donitacambron','Donita Cambron','$2y$07$JhEGsOfzmjDggCGhCP4ztu7u8lXRMLnigka6/cETqdrQs/IwCs.Ea','faculty',0,'math',NULL,NULL,'1','4','none'),(35,'ab1b7ef57c5a41a07d948de6374b7d7b03081d7cfb470980f71f725577be8710','santosguilliams','Santos Guilliams','$2y$07$x5HRTnI.97eTKhU8lh/T8.stTYAexzgqf4dqri84oq3XHSULFSB8y','faculty',0,'drama',NULL,NULL,'1','4','satl'),(36,'57abee0ada18502b5e33b46b7be84f63cf00e48e17681d9bbc722601ecf18a4f','parisstoneking','Paris Stoneking','$2y$07$kYRB1tQ8mstHMpv9effWgOKHibAQFZB0Hc0Vd7y7925etcnDBdzaa','faculty',0,'science',NULL,NULL,'1','4','none'),(37,'ff75dcb0cd9753d35c0c9a20f07fae1fa3511e69a54f9cbf8f21a7eb1f6f5fac','clintcarson','Clint Carson','$2y$07$NAnq8IUdnWicAv3xRF/wo.EbYJ/Ainmqc7H8BNja2RDFbF5M7ynyC','student',0,NULL,'grade 10','section 1',NULL,NULL,'none'),(39,'320efacad6df163b24701610ce450e6ec00d47c941f3f9d020df106724e4bc37','trumpsanders','Trump Sanders','$2y$07$gquDSzPpp02oH0EXHnYz7.2UMbpA1mhT.pTjMvOFjZLzk00buojIK','faculty',0,'math',NULL,NULL,'2','4','none'),(41,'4cd9ccd9852c66cc89419a5a3862d01eff08191901492f546690058cb38b545a','adminpreschool','Adminpreschool','$2y$07$gIh1jmvodcN173FRC96ZGuJx5SjxnaBCqWj7qFECT6E5jHeBJb8Iu','student',0,NULL,'kinder 1','section 1',NULL,NULL,NULL);
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

-- Dump completed on 2016-03-08 18:04:00
