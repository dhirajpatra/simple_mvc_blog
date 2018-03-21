-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: mvc
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `intro` text NOT NULL,
  `article` text NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'PHP is Awesome!','This is an article about PHP!','PHP: Hypertext Preprocessor','2012-10-19 22:36:46','Y',1,'127.0.01'),(2,'What is Routing and why do we need it?','As you may or may not know, communication on the Internet uses packets for transmitting data.\r\n	So, every time your computer communicates with a computer on the Internet, IP packets are\r\n	used to transmit and receive data. ','<p>\r\n	As you may or may not know, communication on the Internet uses packets for transmitting data.\r\n	So, every time your computer communicates with a computer on the Internet, IP packets are\r\n	used to transmit and receive data. \r\n</p>\r\n\r\n<p>\r\n	Your computer by itself can&rsquo;t deliver the packets all the way to the destination,\r\n	so it relies on other networking hardware on the way over to do their part. We could say that \r\n	Routing is a process of selecting the best paths through the network for forwarding packets \r\n	from source to their destination. \r\n</p>','2012-10-19 23:05:15','Y',1,'127.0.4.1'),(3,'What is ASP.NET MVC?','<strong>MVC</strong> stands for <strong>Model-View-Controller</strong>. MVC enables us to separate our logic from the \r\n	presentation. This philosophy is very popular for all the right reasons. One of the biggest advantages is the code re-usability. \r\n	There are other benefits, such as: We can let the designers edit the Views, without worrying that they will screw up database \r\n	access logic. What if we switch to another programming language, such as PHP? We can still use most of the presentation \r\n	logic with only minimal changes.','<p>\r\n	<strong>MVC</strong> stands for <strong>Model-View-Controller</strong>. MVC enables us to separate our logic from the \r\n	presentation. This philosophy is very popular for all the right reasons. One of the biggest advantages is the code re-usability. \r\n	There are other benefits, such as: We can let the designers edit the Views, without worrying that they will screw up database \r\n	access logic. What if we switch to another programming language, such as PHP? We can still use most of the presentation \r\n	logic with only minimal changes.\r\n</p>\r\n\r\n<p>\r\n	So, to summarize:\r\n</p>\r\n\r\n<ul>\r\n	<li><strong>Model</strong> - Classes that connect and talk to the database</li>\r\n	<li><strong>View</strong> - presentation logic - HTML/CSS/JSON, etc</li>\r\n	<li><strong>Controller</strong> - loads View, talks to the the Model, does stuff that user asks it to</li>\r\n</ul>','2012-10-19 23:07:09','Y',1,'127.0.1.2'),(7,'fdfads','fdsaafdas','fadssfa fdsfds dsfa','2018-03-16 19:50:44','N',1,'UNKNOWN'),(8,'Good','vfddsfsa f','fdskjjhfawe  erwlkwearew ewrnwae rewkrew rwrwjr werwer nwer werwe','2018-03-16 20:17:28','Y',1,'UNKNOWN'),(9,'Germans First? A Food Bank Bars Migrants, Setting Off a Storm','Germans First? A Food Bank Bars Migrants, Setting Off a Storm','ESSEN, Germany â€” JÃ¶rg Sartor does not like to turn newcomers away from his food bank, especially single mothers like the young Syrian woman with her 5-year-old son who had waited outside since before dawn.\r\n\r\nBut rules are rules. And for the moment, it is Germans only.\r\n\r\nâ€œCome here,â€ said Mr. Sartor, waving the boy over. Mr. Sartor disappeared into a storage room and re-emerged with a wooden toy. Then the boy and his mother were shown the door, which for the past two weeks has had five letters scrawled across the outside: â€œNazis.â€\r\n\r\nThe decision of one food bank in the western city of Essen to stop signing up more foreigners after migrants gradually became the majority of its users has prompted a storm of reaction in Essen, a former coal town in Germanyâ€™s rust belt, and across the country. Even Chancellor Angela Merkel weighed in: â€œYou shouldnâ€™t categorize people like this.â€','2018-03-17 07:09:15','Y',1,'UNKNOWN'),(10,'Porsche boss warns EU bullying Britain','Porsche boss warns EU bullying Britain over Brexit deal could cost jobs in Germany and cause \'big trouble for businesses\'  Read more: http://www.dailymail.co.uk/news/article-5511435/Porsche-boss-warns-EU-bullying-Britain-cost-jobs-Germany.html#ixzz59xz5zgOa Follow us: @MailOnline on Twitter | DailyMail on Facebook','Porsche bosses have said that punishing the UK for leaving EU could backfire\r\n    They say tariffs and customs barriers would make German cars difficult to export\r\n    Lutz Meschke said: \'Imposed trade tariffs will push up the price, weaken demand for Porsche cars in the UK, and ultimately put German jobs at risk\'\r\n\r\n\r\nRead more: http://www.dailymail.co.uk/news/article-5511435/Porsche-boss-warns-EU-bullying-Britain-cost-jobs-Germany.html#ixzz59xzAYeOT\r\nFollow us: @MailOnline on Twitter | DailyMail on Facebook','2018-03-17 07:15:59','Y',1,'127.0.0.1'),(11,'Debate On Role Of Islam Divides German Government','Debate On Role Of Islam Divides German Government','<p>&nbsp;</p>\r\n<div class=\"enlarge-options\">&nbsp;</div>\r\n<div class=\"credit-caption\">\r\n<div class=\"caption-wrap\">\r\n<div class=\"caption\">\r\n<p>Muslim women from Syria take a German language lesson at a Muslim cultural center in February in Halle, Germany.</p>\r\n</div>\r\n</div>\r\n<span class=\"credit\"> Jens Schlueter/Getty Images </span></div>\r\n<p>Germany\'s new minister of interior, Horst Seehofer, has stirred up debate about the role of Islam in Germany.</p>\r\n<p><a href=\"https://www.bild.de/bild-plus/politik/inland/islam/heimat-minister-seehofer-islam-gehoert-nicht-zu-deutschland-55108896,view=conversionToLogin.bild.html\">In an interview with the German newspaper BILD</a> Seehofer said: \"Islam is not a part of Germany. Germany has been influenced by Christianity. This includes free Sundays, church holidays and rituals such as Easter, Pentecost and Christmas. However, the Muslims living in Germany obviously do belong to Germany.\"</p>\r\n<p>This statement conflicted with the position of German Chancellor Angela Merkel. Merkel said, even though Germany has been influenced mainly by Christianity and Judaism, there are more than four million Muslims in the country, they \"belong to Germany and so does their religion.\"</p>\r\n<p><a href=\"https://www.von-notz.de/\">Konstantin von Notz</a>, member of the opposition Green party, protests, \"The statement of Interior Minister Seehoher is complete nonsense. Germany cannot afford such behavior in the important questions of integration.\"</p>','2018-03-17 08:27:51','Y',1,'127.0.0.1');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` varchar(255) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'Good post',1,1),(2,'Somehow ok',2,1),(3,'Very good post',1,1),(4,'Ok',3,1),(5,'Bad',3,1),(6,'good value',8,1);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'dhiraj.patra@gmail.com','$2y$10$Fe3wUpWK5KgKiljp/zQBOuL4ENjUIDnTUbGvoY3jQI7.t6.I0kKFi','dhirajpatra'),(2,'markus@gmail.com','$2y$10$Fe3wUpWK5KgKiljp/zQBOuL4ENjUIDnTUbGvoY3jQI7.t6.I0kKFi','markus');
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

-- Dump completed on 2018-03-17  8:33:34