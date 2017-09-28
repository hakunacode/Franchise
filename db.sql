/*
SQLyog Ultimate v8.55 
MySQL - 5.5.16 : Database - franchise
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`franchise` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `franchise`;

/*Table structure for table `admin_requests` */

DROP TABLE IF EXISTS `admin_requests`;

CREATE TABLE `admin_requests` (
  `ads_id` int(11) DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `zipcode` varchar(200) DEFAULT NULL,
  `country` int(10) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `location` int(10) DEFAULT NULL,
  `street` varchar(200) DEFAULT NULL,
  `phonenumber` varchar(100) DEFAULT NULL,
  `investment` int(11) NOT NULL,
  `request_date` datetime NOT NULL,
  `flag` int(1) NOT NULL DEFAULT '1',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `admin_requests` */

insert  into `admin_requests`(`ads_id`,`name`,`email`,`zipcode`,`country`,`state`,`city`,`location`,`street`,`phonenumber`,`investment`,`request_date`,`flag`,`id`) values (2,'FDFFF','ASDASD','asd',3,'ASD','ASD',3,'ASD','ASDSADSAD',2,'2012-07-07 03:22:03',2,2),(1,'Full Name','Email Address','Zip/Postal Code',12,'State','City',384,'Street','Telephone Number',7,'2012-07-14 18:01:31',2,3),(3,'test1','test1@example.com','Zip/Postal Code',98,'State','City',261,'Street','123456-789456',2,'2012-07-14 18:03:29',1,4),(3,'test2','test2@example.com','Zip/Postal Code',98,'State','City',261,'Street','123456-789456',2,'2012-07-14 18:04:03',1,5),(3,'test3','test3@example.com','Zip/Postal Code',98,'State','City',261,'Street','123456-789456',2,'2012-07-14 18:11:33',1,6),(2,'Kim Kyoung Jin','kimkyoungjin@hotmail.com','222',3,'state of us','millemen',3,'kingston','222222222',8,'2012-07-17 05:59:50',1,7),(2,'Kim Kyoung Jin','kimkyoungjin@hotmail.com','222',3,'state of us','millemen',3,'kingston','222222222',8,'2012-07-17 05:59:55',1,8),(2,'Kim Kyoung Jin','kimkyoungjin@hotmail.com','222',3,'state of us','millemen',3,'kingston','222222222',8,'2012-07-17 06:00:13',1,9);

/*Table structure for table `advertising` */

DROP TABLE IF EXISTS `advertising`;

CREATE TABLE `advertising` (
  `id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` blob,
  `img` varchar(100) DEFAULT NULL,
  `pass_flag` int(1) NOT NULL DEFAULT '2',
  `status` int(1) NOT NULL DEFAULT '2',
  `advertisor_id` int(10) NOT NULL,
  `post_datetime` datetime NOT NULL,
  `country` int(10) NOT NULL,
  `location` int(10) NOT NULL,
  `investment` int(10) NOT NULL,
  `full_ads` blob,
  `newly` int(1) NOT NULL DEFAULT '0',
  `feature` int(1) NOT NULL DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `advertising` */

insert  into `advertising`(`id`,`title`,`description`,`img`,`pass_flag`,`status`,`advertisor_id`,`post_datetime`,`country`,`location`,`investment`,`full_ads`,`newly`,`feature`,`email`) values (1,'Marketing11_advertising','This is my help site....\n\ntop 10 sites is my sire....\n\n\nHellos worlds gentleman and woman!!','STORE.INF',2,2,4,'2012-07-05 17:56:57',4,515,10000,'<span style=\"color: rgb(0, 0, 153);\">This is the templete</span> <span style=\"color: rgb(255, 0, 0);\">advertisment </span><span style=\"color: rgb(255, 255, 0);\">full </span><span style=\"color: rgb(0, 153, 0);\">description</span><br>',1,1,'advertisor1@example.com'),(2,'second ADS','dslkfjslkdjflkdsjf\nsdfjslkdjflksdjflksjf\ns\n\n\ns\ndf\nsdfdsfjsdlkjflkdsjflksjflksdjflksjflksdjlkfjdslk\nsdfjslkdjflkdsjflksjflkjdsf','STORE.INF',2,2,4,'2012-07-05 17:57:53',3,3,230000,'<br><br>&nbsp;',1,1,'Â '),(3,'ads demo','Â content','project3609217911.png',2,2,4,'2012-07-05 18:21:08',18,254,10000,'<br>&nbsp;',1,1,'Â '),(4,'test ads',' ','project3609217911.png',2,2,4,'2012-07-05 18:23:51',221,267,50000,'<br>&nbsp;',1,1,'Â '),(5,'12345678',' ','project3609217913.png',2,2,4,'2012-07-05 18:29:39',18,13,123456,'<br>&nbsp;',1,1,'Â '),(7,'ads of the advertisor','content','project3609217913.png',2,2,3,'2012-07-05 18:40:07',12,384,999999,'<br>&nbsp;',1,1,'Â '),(8,'title','content','end.gif',2,2,3,'2012-07-05 18:47:07',20,20,13432,'<br><span lang=\"ZH-TW\"><font face=\"WKLChongbong\"><span lang=\"ZH-TW\"></span></font></span><span lang=\"ZH-TW\"><font face=\"WKLChongbong\"><span lang=\"ZH-TW\"></span></font></span><p style=\"color: rgb(255, 0, 0);\">The full descripti</p><p style=\"color: rgb(255, 0, 0);\"><img src=\"http://175.160.211.4/franchise/upload/advertising/insert_image/adsimages20120707171812.gif\"><br></p><p style=\"color: rgb(255, 0, 0);\"><br></p><p style=\"color: rgb(255, 0, 0);\"><img alt=\"ë§¥ì£¼\" src=\"images/emo_24.gif\">on of this advertising.<span style=\"color: rgb(0, 0, 0);\"><br></span></p><p style=\"color: rgb(255, 0, 0);\"><span style=\"color: rgb(0, 0, 0);\">dasdsadsadsa,l</span></p>\n',1,1,'Â '),(9,'11111111111111','11111111111111','adsimages20120707173043.gif',2,2,3,'2012-07-07 17:30:43',5,17,123123123,'<br><br><span lang=\"ZH-TW\"><font face=\"WKLChongbong\"><span lang=\"ZH-TW\"></span></font></span><span lang=\"ZH-TW\"><font face=\"WKLChongbong\"><span lang=\"ZH-TW\"></span></font></span>fsdfasdfdsfsadfdsafdsa<br><br><img src=\"http://175.160.211.4/franchise/upload/advertising/insert_image/adsimages20120707173025.png\"><br><br><img src=\"http://localhost/franchise/include/htmlarea_temp/popups/../../../upload/advertising/insert_image/adsimages20120707190808.gif\"><span lang=\"ZH-TW\"><font face=\"WKLChongbong\"><span lang=\"ZH-TW\"></span></font></span>',1,1,NULL);

/*Table structure for table `advertisor_requests` */

DROP TABLE IF EXISTS `advertisor_requests`;

CREATE TABLE `advertisor_requests` (
  `ads_id` int(11) DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `zipcode` varchar(200) DEFAULT NULL,
  `country` int(10) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `location` int(10) DEFAULT NULL,
  `street` varchar(200) DEFAULT NULL,
  `phonenumber` varchar(100) DEFAULT NULL,
  `investment` int(11) NOT NULL,
  `request_date` datetime NOT NULL,
  `flag` int(1) NOT NULL DEFAULT '1',
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `reply_flag` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `advertisor_requests` */

insert  into `advertisor_requests`(`ads_id`,`name`,`email`,`zipcode`,`country`,`state`,`city`,`location`,`street`,`phonenumber`,`investment`,`request_date`,`flag`,`id`,`reply_flag`) values (2,'FDFFF','ASDASD','asd',3,'ASD','ASD',3,'ASD','ASDSADSAD',2,'2012-07-07 03:22:03',1,2,1),(1,'Full Name','Email Address','Zip/Postal Code',12,'State','City',384,'Street','Telephone Number',7,'2012-07-14 18:01:31',1,3,1);

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `content` blob,
  `user_id` int(10) NOT NULL,
  `post_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `blog` */

insert  into `blog`(`id`,`title`,`content`,`user_id`,`post_date`) values (1,'private policy','<p>All contents of everything.com are Copyright © Franchise Everything. \nAll rights reserved. Any reproduction of any content is strictly \nprohibited.</p><br>\n\n			<p>The publishers here at Franchise Everything reserve the right at \ntheir absolute discretion and at any time to refuse any advertising \nSubmition.</p><br>\n				\n			<p>The views and opinions expressed in any document or image \ncontained in, or linked to or from this site, do not necessarily state \nor reflect those at Franchise Everything.</p><br>\n				\n			<p>Franchise Everything was developed for the sole purpose of \nproviding information and connections to other seeking to buy or sell a \nproduct, brand or other type of service. We are not offering any advice \nor endorsements with the information in this website . Franchise \nEverything, any of its employees or associates, does not assume any \nresponsibility or liability for any actions of any listed company or \nsubject matter contained herein, nor can we guarantee or assume \nliability for the accuracy, completeness or usefulness of any \ninformation from this server or any links. In no event shall Franchise \nEverything be liable for any indirect, special or consequential damages \nin connection with readers\' or others\' use of any content listed in \nFranchise Everything</p><br>\n				\n			<p>Franchise Everything will only put text or images on any of our \nwebsites on the explicit understanding that the client hold the \ncopyright to all text and images.</p><br>\n				\n			<p>For any investment listed on Franchise Everything, it is up to the\n prospective buyer and user to thoroughly investigate any listing or \ncompany, obtain the appropriate disclosure documents and seek \nprofessional consultation prior to making any and all investment \ndecisions.</p><br>\n			\n			<p>All buying and selling of franchise is done solebetween the \nprospective buyer and the selling company.  Franchise Everything only \nprovides the connection between the two.  We are not an employee of any \ncompany nor do we represent any company or entity contianed in this site\n other than our own companies.</p>',3,'2012-07-18 13:40:17');

/*Table structure for table `blog_comment` */

DROP TABLE IF EXISTS `blog_comment`;

CREATE TABLE `blog_comment` (
  `blog_id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `comment` varchar(4000) NOT NULL,
  `post_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `blog_comment` */

insert  into `blog_comment`(`blog_id`,`name`,`email`,`comment`,`post_date`) values (1,'anonymous','an@example.com','private policy comment 1.','2012-07-18 13:51:51');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `desc` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `categories` */

insert  into `categories`(`id`,`name`,`desc`) values (1,'Advertising & Marketing',''),(2,'ATM Franchises',''),(3,'Automotive Franchises',''),(4,'Business Opportunities',''),(5,'Business Services',''),(6,'Children\'s Franchises',''),(7,'Cleaning Franchises',''),(8,'Coffee Franchises',''),(9,'Computer & Internet',''),(10,'Consultant & Business Broker',''),(11,'courier Franchises',''),(12,'DVD & Video',''),(13,'Employment & Staffing',''),(14,'Entertainment Franchises',''),(15,'Fitness Franchises',''),(16,'Food Franchises',''),(17,'Health & Beauty',''),(18,'Healthcare & Senior Care',''),(19,'Home Services Franchises',''),(20,'Home-based Franchises',''),(21,'Industrial Franchises',''),(22,'Mailing & shipping',''),(23,'Moving & Storage',''),(24,'Pet Franchises',''),(25,'Photography Franchises',''),(26,'Printer, Copying & Sign',''),(27,'Real Estate Franchises',''),(28,'Restaurant Franchises',''),(29,'Retail Franchises',''),(30,'Security Franchises',''),(31,'Sport Franchises',''),(32,'Tax Franchises',''),(33,'Training Franchises',''),(34,'Travel Franchises',''),(35,'Vending Opportunities','');

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=801 DEFAULT CHARSET=latin1;

/*Data for the table `country` */

insert  into `country`(`id`,`name`) values (3,'Afghanistan'),(4,'Albania'),(5,'Algeria'),(6,'Andorra'),(7,'Angola'),(8,'Anguilla'),(9,'Antigua'),(10,'Argentina'),(11,'Armenia'),(12,'Aruba'),(13,'Australia'),(14,'Austria'),(15,'Azerbaijan'),(16,'Bahamas'),(17,'Bahrain'),(18,'Bangladesh'),(19,'Barbados'),(20,'Barbuda'),(21,'Belarus'),(22,'Belgium'),(23,'Belize'),(24,'Benin'),(25,'Bermuda'),(26,'Bhutan'),(27,'Bolivia'),(28,'Bosnia'),(29,'Botswana'),(30,'Brazil'),(31,'Brunei Darussalam'),(32,'Bulgaria'),(33,'Burkina Faso'),(34,'Burundi'),(35,'Cambodia'),(36,'Cameroon'),(37,'Canada'),(38,'Cape Verde'),(39,'Cayman Islands'),(40,'Central African Republic'),(41,'Chad'),(42,'Chile'),(43,'China'),(44,'Christmas Island'),(45,'Cocos Islands'),(46,'Colombia'),(47,'Comoros'),(48,'Congo'),(49,'Cook Islands'),(50,'Costa Rica'),(51,'Ivory Coast'),(52,'Croatia'),(53,'Cuba'),(54,'Cyprus'),(55,'Czech Republic'),(56,'Denmark'),(57,'Djibouti'),(58,'Dominica'),(59,'Dominican Republic'),(60,'East Timor'),(61,'Ecuador'),(62,'Egypt'),(63,'Equatorial Guinea'),(64,'Estonia'),(65,'Ethiopia'),(66,'Faeroe Islands'),(67,'Falkland Islands'),(68,'Fiji'),(69,'Finland'),(70,'France'),(71,'French Polynesia'),(72,'Futuna Island'),(73,'Gabon'),(74,'Gambia'),(75,'Georgia'),(76,'Germany'),(77,'Ghana'),(78,'Gibraltar'),(79,'Greece'),(80,'Greenland'),(81,'Grenada'),(82,'Grenadines'),(83,'Guadaloupe'),(84,'Guyana'),(85,'Guam'),(86,'Guatemala'),(87,'Guinea'),(88,'Guinea-Bissau'),(89,'French Guiana'),(90,'Haiti'),(91,'Herzegovina'),(93,'Honduras'),(94,'Hong-Kong'),(95,'Hungary'),(96,'Iceland'),(97,'India'),(98,'Indonesia'),(99,'Iran'),(100,'Iraq'),(101,'Ireland'),(102,'Israel'),(103,'Italy'),(104,'Jamaica'),(105,'Japan'),(106,'Jordan'),(107,'Kazakhstan'),(108,'Kenya'),(109,'Kiribati'),(110,'North Korea'),(111,'South Korea'),(112,'Kuwait'),(113,'Kyrgyzstan'),(114,'Laos'),(115,'Latvia'),(116,'Lebanon'),(117,'Lesotho'),(118,'Liberia'),(119,'Libyan Arab Jamahiri'),(120,'Liechtenstein'),(121,'Lithuania'),(122,'Luxembourg'),(123,'Macau'),(124,'Macedonia'),(125,'Madagascar'),(126,'Malawi'),(127,'Malaysia'),(128,'Maldives'),(129,'Mali'),(130,'Malta'),(131,'Malvinas'),(132,'Marshall Islands'),(133,'Martinique'),(134,'Mauritania'),(135,'Mauritius'),(136,'Mexico'),(137,'Micronesia'),(139,'Moldova'),(140,'Monaco'),(141,'Mongolia'),(142,'Montserrat'),(143,'Morocco'),(144,'Mozambique'),(145,'Myanmar'),(146,'Namibia'),(147,'Nauru'),(148,'Nepal'),(149,'Netherlands'),(150,'Netherlands Antilles'),(151,'Nevis'),(152,'New Caledonia'),(153,'New Zealand'),(154,'Nicaragua'),(155,'Niger'),(156,'Nigeria'),(157,'Niue'),(158,'Norfolk Island'),(159,'Norway'),(160,'Oman'),(161,'Pakistan'),(162,'Panama'),(163,'Papua New Guinea'),(164,'Paraguay'),(165,'Peru'),(166,'Philippines'),(167,'Pitcairn Island'),(168,'Poland'),(169,'Portugal'),(170,'Principe'),(171,'Qatar'),(172,'Reunion'),(173,'Romania'),(174,'Russian Federation'),(175,'Rwanda'),(176,'Saint Helena'),(177,'Saint Kitts'),(178,'Saint Lucia'),(179,'Saint Pierre and Miquelon'),(180,'Saint Vincent'),(181,'San Marino'),(182,'Sao Tome'),(183,'Saudi Arabia'),(185,'Senegal'),(186,'Seychelles'),(187,'Sierra Leone'),(188,'Singapore'),(189,'Slovakia'),(190,'Slovenia'),(191,'Solomon Islands'),(192,'Somalia'),(193,'South Africa'),(194,'Spain'),(195,'Sri Lanka'),(196,'Sudan'),(197,'Suriname'),(198,'Swaziland'),(199,'Sweden'),(200,'Switzerland'),(201,'Syrian Arab Republic'),(202,'Taiwan'),(203,'Tajikistan'),(204,'Tanzania'),(205,'Thailand'),(206,'Togo'),(207,'Tokelau'),(208,'Tonga'),(209,'Trinidad'),(210,'Tobago'),(211,'Tunisia'),(212,'Turkey'),(213,'Turkmenistan'),(214,'Turks Island'),(215,'Caicos Island'),(216,'Tuvalu'),(217,'Uganda'),(218,'Ukraine'),(219,'United Arab Emirates'),(221,'United States of America'),(222,'Uruguay'),(223,'Uzbekistan'),(224,'Vanuatu'),(225,'Venezuela'),(226,'Viet Nam'),(227,'Wallis Island'),(228,'Western Sahara'),(229,'Yemen'),(230,'Yugoslavia'),(231,'Zaire'),(232,'Zambia'),(233,'Zimbabwe'),(280,'Puerto Rico'),(300,'UK - England'),(301,'UK - Scotland'),(302,'UK - Wales'),(303,'UK - Northern Ireland'),(505,'El Salvador'),(508,'Virgin Islands (British)'),(509,'Virgin Islands (US)'),(510,'Eritrea'),(511,'Montenegro'),(512,'Republic of Serbia'),(513,'Gaza'),(514,'West Bank'),(515,'American Samoa'),(516,'Northern Mariana Islands'),(517,'Palau'),(518,'Samoa'),(519,'Wake Islands'),(520,'Coral Sea Islands'),(521,'US Outlying Islands'),(522,'United Kingdom'),(800,'Kosovo');

/*Table structure for table `investment_range` */

DROP TABLE IF EXISTS `investment_range`;

CREATE TABLE `investment_range` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `investment_range` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `investment_range` */

insert  into `investment_range`(`id`,`investment_range`) values (1,'Less than $25,000'),(2,'$25,000 to $50,000'),(3,'$50,000 to $75,000'),(4,'$75,000 to $100,000'),(5,'$100,000 to $150,000'),(6,'$150,000 to $200,000'),(7,'$200,000 to $250,000'),(8,'$250,000 to $500,000'),(9,'$500,000 to $1,000,000'),(10,'More than $1,000,000');

/*Table structure for table `location` */

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=801 DEFAULT CHARSET=latin1;

/*Data for the table `location` */

insert  into `location`(`id`,`name`) values (3,'Afghanistan'),(4,'Albania'),(5,'Algeria'),(6,'Andorra'),(7,'Angola'),(8,'Anguilla'),(9,'Antigua'),(10,'Argentina'),(11,'Armenia'),(12,'Aruba'),(13,'Australia'),(14,'Austria'),(15,'Azerbaijan'),(16,'Bahamas'),(17,'Bahrain'),(18,'Bangladesh'),(19,'Barbados'),(20,'Barbuda'),(21,'Belarus'),(22,'Belgium'),(23,'Belize'),(24,'Benin'),(25,'Bermuda'),(26,'Bhutan'),(27,'Bolivia'),(28,'Bosnia'),(29,'Botswana'),(30,'Brazil'),(31,'Brunei Darussalam'),(32,'Bulgaria'),(33,'Burkina Faso'),(34,'Burundi'),(35,'Cambodia'),(36,'Cameroon'),(37,'Canada'),(38,'Cape Verde'),(39,'Cayman Islands'),(40,'Central African Republic'),(41,'Chad'),(42,'Chile'),(43,'China'),(44,'Christmas Island'),(45,'Cocos Islands'),(46,'Colombia'),(47,'Comoros'),(48,'Congo'),(49,'Cook Islands'),(50,'Costa Rica'),(51,'Ivory Coast'),(52,'Croatia'),(53,'Cuba'),(54,'Cyprus'),(55,'Czech Republic'),(56,'Denmark'),(57,'Djibouti'),(58,'Dominica'),(59,'Dominican Republic'),(60,'East Timor'),(61,'Ecuador'),(62,'Egypt'),(63,'Equatorial Guinea'),(64,'Estonia'),(65,'Ethiopia'),(66,'Faeroe Islands'),(67,'Falkland Islands'),(68,'Fiji'),(69,'Finland'),(70,'France'),(71,'French Polynesia'),(72,'Futuna Island'),(73,'Gabon'),(74,'Gambia'),(75,'Georgia'),(76,'Germany'),(77,'Ghana'),(78,'Gibraltar'),(79,'Greece'),(80,'Greenland'),(81,'Grenada'),(82,'Grenadines'),(83,'Guadaloupe'),(84,'Guyana'),(85,'Guam'),(86,'Guatemala'),(87,'Guinea'),(88,'Guinea-Bissau'),(89,'French Guiana'),(90,'Haiti'),(91,'Herzegovina'),(93,'Honduras'),(94,'Hong-Kong'),(95,'Hungary'),(96,'Iceland'),(97,'India'),(98,'Indonesia'),(99,'Iran'),(100,'Iraq'),(101,'Ireland'),(102,'Israel'),(103,'Italy'),(104,'Jamaica'),(105,'Japan'),(106,'Jordan'),(107,'Kazakhstan'),(108,'Kenya'),(109,'Kiribati'),(110,'North Korea'),(111,'South Korea'),(112,'Kuwait'),(113,'Kyrgyzstan'),(114,'Laos'),(115,'Latvia'),(116,'Lebanon'),(117,'Lesotho'),(118,'Liberia'),(119,'Libyan Arab Jamahiri'),(120,'Liechtenstein'),(121,'Lithuania'),(122,'Luxembourg'),(123,'Macau'),(124,'Macedonia'),(125,'Madagascar'),(126,'Malawi'),(127,'Malaysia'),(128,'Maldives'),(129,'Mali'),(130,'Malta'),(131,'Malvinas'),(132,'Marshall Islands'),(133,'Martinique'),(134,'Mauritania'),(135,'Mauritius'),(136,'Mexico'),(137,'Micronesia'),(139,'Moldova'),(140,'Monaco'),(141,'Mongolia'),(142,'Montserrat'),(143,'Morocco'),(144,'Mozambique'),(145,'Myanmar'),(146,'Namibia'),(147,'Nauru'),(148,'Nepal'),(149,'Netherlands'),(150,'Netherlands Antilles'),(151,'Nevis'),(152,'New Caledonia'),(153,'New Zealand'),(154,'Nicaragua'),(155,'Niger'),(156,'Nigeria'),(157,'Niue'),(158,'Norfolk Island'),(159,'Norway'),(160,'Oman'),(161,'Pakistan'),(162,'Panama'),(163,'Papua New Guinea'),(164,'Paraguay'),(165,'Peru'),(166,'Philippines'),(167,'Pitcairn Island'),(168,'Poland'),(169,'Portugal'),(170,'Principe'),(171,'Qatar'),(172,'Reunion'),(173,'Romania'),(174,'Russian Federation'),(175,'Rwanda'),(176,'Saint Helena'),(177,'Saint Kitts'),(178,'Saint Lucia'),(179,'Saint Pierre and Miquelon'),(180,'Saint Vincent'),(181,'San Marino'),(182,'Sao Tome'),(183,'Saudi Arabia'),(185,'Senegal'),(186,'Seychelles'),(187,'Sierra Leone'),(188,'Singapore'),(189,'Slovakia'),(190,'Slovenia'),(191,'Solomon Islands'),(192,'Somalia'),(193,'South Africa'),(194,'Spain'),(195,'Sri Lanka'),(196,'Sudan'),(197,'Suriname'),(198,'Swaziland'),(199,'Sweden'),(200,'Switzerland'),(201,'Syrian Arab Republic'),(202,'Taiwan'),(203,'Tajikistan'),(204,'Tanzania'),(205,'Thailand'),(206,'Togo'),(207,'Tokelau'),(208,'Tonga'),(209,'Trinidad'),(210,'Tobago'),(211,'Tunisia'),(212,'Turkey'),(213,'Turkmenistan'),(214,'Turks Island'),(215,'Caicos Island'),(216,'Tuvalu'),(217,'Uganda'),(218,'Ukraine'),(219,'United Arab Emirates'),(222,'Uruguay'),(223,'Uzbekistan'),(224,'Vanuatu'),(225,'Venezuela'),(226,'Viet Nam'),(227,'Wallis Island'),(228,'Western Sahara'),(229,'Yemen'),(230,'Yugoslavia'),(231,'Zaire'),(232,'Zambia'),(233,'Zimbabwe'),(234,'US - Alabama'),(236,'US - Alaska'),(238,'US - Arizona'),(239,'US - Arkansas'),(240,'US - California'),(241,'US - Colorado'),(242,'US - Connecticut'),(243,'US - Delaware'),(244,'US - District of Columbia'),(246,'US - Florida'),(247,'US - Georgia'),(249,'US - Hawaii'),(250,'US - Idaho'),(251,'US - Illinois'),(252,'US - Indiana'),(253,'US - Iowa'),(254,'US - Kansas'),(255,'US - Kentucky'),(256,'US - Louisiana'),(257,'US - Maine'),(259,'US - Maryland'),(260,'US - Massachusetts'),(261,'US - Michigan'),(262,'US - Minnesota'),(263,'US - Mississippi'),(264,'US - Missouri'),(265,'US - Montana'),(266,'US - Nebraska'),(267,'US - Nevada'),(268,'US - New Hampshire'),(269,'US - New Jersey'),(270,'US - New Mexico'),(271,'US - New York'),(272,'US - North Carolina'),(273,'US - North Dakota'),(275,'US - Ohio'),(276,'US - Oklahoma'),(277,'US - Oregon'),(279,'US - Pennsylvania'),(280,'Puerto Rico'),(281,'US - Rhode Island'),(282,'US - South Carolina'),(283,'US - South Dakota'),(284,'US - Tennessee'),(285,'US - Texas'),(286,'US - Utah'),(287,'US - Vermont'),(289,'US - Virginia'),(290,'US - Washington'),(291,'US - West Virginia'),(292,'US - Wisconsin'),(293,'US - Wyoming'),(300,'UK - England'),(301,'UK - Scotland'),(302,'UK - Wales'),(303,'UK - Northern Ireland'),(372,'CA - Alberta'),(373,'CA - British Columbia'),(374,'CA - Manitoba'),(375,'CA - New Brunswick'),(376,'CA - Newfoundland and Labrador'),(377,'CA - Nova Scotia'),(378,'CA - Ontario'),(379,'CA - Prince Edward Island'),(380,'CA - Quebec'),(381,'CA - Saskatchewan'),(382,'CA - Northwest Territories'),(383,'CA - Nunavut'),(384,'CA - Yukon Territory'),(505,'El Salvador'),(508,'Virgin Islands (British)'),(509,'Virgin Islands (US)'),(510,'Eritrea'),(511,'Montenegro'),(512,'Republic of Serbia'),(513,'Gaza'),(514,'West Bank'),(515,'American Samoa'),(516,'Northern Mariana Islands'),(517,'Palau'),(518,'Samoa'),(519,'Wake Islands'),(520,'Coral Sea Islands'),(521,'US Outlying Islands'),(522,'United Kingdom'),(800,'Kosovo');

/*Table structure for table `relation` */

DROP TABLE IF EXISTS `relation`;

CREATE TABLE `relation` (
  `category_id` int(10) NOT NULL,
  `advertising_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `relation` */

insert  into `relation`(`category_id`,`advertising_id`) values (12,1),(11,1),(1,1),(1,2),(34,7),(3,6),(13,8),(23,7),(2,6),(1,6),(12,7),(1,3),(12,8),(1,7),(11,8),(1,8),(11,9),(1,9),(1,4),(1,5);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `account` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `permission` int(1) NOT NULL DEFAULT '1',
  `fullname` varchar(150) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`account`,`email`,`password`,`permission`,`fullname`,`status`) values (1,'admin','admin@example.com','123456',1,'Administrator',1),(2,'broker','broker@example.com','123456',2,'Broker',1),(3,'advertisor1','advertisor1@example.com','123456',3,'Advertisor',1),(4,'advertisor2','advertisor2@example.com','123456',3,'Advertisor',1),(5,'dasd','asdasd','asd',3,'sadas',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
