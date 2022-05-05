-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: swimming
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accessories`
--

DROP TABLE IF EXISTS `accessories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accessories` (
  `s_id` int DEFAULT NULL,
  `swimming_fins` int DEFAULT NULL,
  `shorts` int DEFAULT NULL,
  `goggles` int DEFAULT NULL,
  `silicone_caps` int DEFAULT NULL,
  KEY `s_id` (`s_id`),
  CONSTRAINT `accessories_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `user_slots` (`s_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accessories`
--

LOCK TABLES `accessories` WRITE;
/*!40000 ALTER TABLE `accessories` DISABLE KEYS */;
INSERT INTO `accessories` VALUES (0,4,10,7,9),(1,2,0,1,0);
/*!40000 ALTER TABLE `accessories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locker`
--

DROP TABLE IF EXISTS `locker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locker` (
  `locker_no` int NOT NULL,
  `s_id` int DEFAULT NULL,
  PRIMARY KEY (`locker_no`),
  KEY `s_id` (`s_id`),
  CONSTRAINT `locker_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `user_slots` (`s_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locker`
--

LOCK TABLES `locker` WRITE;
/*!40000 ALTER TABLE `locker` DISABLE KEYS */;
INSERT INTO `locker` VALUES (1,NULL),(2,NULL),(3,NULL),(4,NULL),(6,NULL),(7,NULL),(8,NULL),(5,1);
/*!40000 ALTER TABLE `locker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `montly_pass`
--

DROP TABLE IF EXISTS `montly_pass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `montly_pass` (
  `pass_status` varchar(45) NOT NULL,
  `expiry_date` date NOT NULL,
  `payment_method` varchar(45) NOT NULL,
  `last_payment_date` date NOT NULL,
  `pass_number` int NOT NULL,
  `userid` int NOT NULL,
  PRIMARY KEY (`pass_number`),
  KEY `userid` (`userid`),
  CONSTRAINT `montly_pass_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `montly_pass`
--

LOCK TABLES `montly_pass` WRITE;
/*!40000 ALTER TABLE `montly_pass` DISABLE KEYS */;
INSERT INTO `montly_pass` VALUES ('Active','2022-04-19','Cash','2022-03-19',5000,1),('Active','2022-04-09','Cash','2022-03-09',5001,2),('Active','2022-10-31','UPI','2022-05-04',5003,3),('Active','2022-04-17','Debit Card','2022-03-17',5004,4),('Inactive','2022-08-03','Debit Card','2022-05-05',5005,5),('Active','2022-06-03','Debit Card','2022-05-04',5006,7);
/*!40000 ALTER TABLE `montly_pass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slots`
--

DROP TABLE IF EXISTS `slots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slots` (
  `slots_id` int NOT NULL,
  `batch` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`slots_id`),
  UNIQUE KEY `batch` (`batch`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slots`
--

LOCK TABLES `slots` WRITE;
/*!40000 ALTER TABLE `slots` DISABLE KEYS */;
INSERT INTO `slots` VALUES (0,'admin','2000-01-01'),(1,'morning','2022-05-05');
/*!40000 ALTER TABLE `slots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `userid` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(45) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Insurance` varchar(45) NOT NULL,
  `Gender` varchar(45) NOT NULL,
  `Age` int NOT NULL,
  `Password` varchar(45) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (0,'admin','Admin','YES','M',0,'186c5c259307081dda4b45cf78af0f17'),(1,'pradeep_kumar45','Pradeep Kumar','YES','M',25,'657047263c96362700718f6768437139'),(2,'virat_kohli1818','Virat Kohli','YES','M',32,'c40465f02b7642fada5c8acd79440141'),(3,'geeta789','Geeta Rathod','YES','F',35,'1116ac3d772a1c3fbae033f7e79d337e'),(4,'gauri_patel999','Gauri Patel','YES','F',21,'6baa73d5ccac460a7670790e3a843147'),(5,'ayushm','Ayush Mandal','YES','M',19,'691c720c3152c8686e0ff812a767c552'),(7,'hari','Hari Chetan','YES','M',19,'0769e56eb5d72039f01530d705e971da');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_slots`
--

DROP TABLE IF EXISTS `user_slots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_slots` (
  `s_id` int NOT NULL,
  `slots_id` int DEFAULT NULL,
  `userid` int DEFAULT NULL,
  PRIMARY KEY (`s_id`),
  KEY `slots_id` (`slots_id`),
  KEY `userid` (`userid`),
  CONSTRAINT `user_slots_ibfk_1` FOREIGN KEY (`slots_id`) REFERENCES `slots` (`slots_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_slots_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_slots`
--

LOCK TABLES `user_slots` WRITE;
/*!40000 ALTER TABLE `user_slots` DISABLE KEYS */;
INSERT INTO `user_slots` VALUES (0,0,0),(1,1,5);
/*!40000 ALTER TABLE `user_slots` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-05 12:02:04
