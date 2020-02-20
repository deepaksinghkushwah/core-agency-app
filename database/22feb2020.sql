/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.7.29 : Database - agency
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `gallery` */

DROP TABLE IF EXISTS `gallery`;

CREATE TABLE `gallery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_gallery_user_id` (`user_id`),
  CONSTRAINT `fk_gallery_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `gallery` */

insert  into `gallery`(`id`,`user_id`,`image`) values (5,12,'1582194273.jpg'),(6,12,'1582194299.jpg'),(7,12,'1582194574.jpg'),(8,12,'1582194577.jpg'),(9,12,'1582194582.jpg'),(10,12,'1582194585.jpg'),(11,12,'1582194589.jpg'),(12,12,'1582194592.jpg'),(13,12,'1582194596.jpg');

/*Table structure for table `profile` */

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `about` text,
  PRIMARY KEY (`id`),
  KEY `fk_profile_user_id` (`user_id`),
  CONSTRAINT `fk_profile_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `profile` */

insert  into `profile`(`id`,`user_id`,`firstname`,`lastname`,`image`,`about`) values (1,2,'Test','Two','1582193133.jpg','Et quam quis felis massa accumsan suspendisse phasellus eros euismod euismod nisi nisi enim ac a sollicitudin metus ex aliquam diam hendrerit phasellus arcu vel.\r\n\r\nEx arcu amet condimentum vivamus orci vivamus phasellus aliquam tempus mi nec congue tincidunt ipsum quisque eros nec lacus nisi felis tincidunt urna quis vivamus.\r\n\r\nScelerisque portaest fusce mi a ac ipsum vivamus phasellus magna sit erat ipsum et tortor tincidunt sollicitudin condimentum aliquam purus tortor nunc lacus vivamus euismod.\r\n\r\nSit nec ac elementum placerat massa hendrerit fusce ac eu condimentum ex elementum diam suspendisse fusce id massa leo hendrerit eros erat bibendum diam euismod.\r\n\r\nGravida lacus nunc portaest maecenas sit varius purus tortor enim ac eros diam rutrum et portaest arcu quisque sit maximus nunc molestie felis congue a.\r\n\r\nHendrerit arcu purus pellentesque maximus nunc quis cursus placerat nunc accumsan felis sit pellentesque nisi rutrum ex mi dolor cursus pellentesque tincidunt ipsum purus ac.\r\n\r\nUrna dolor nisi magna tempus facilisis magna lacus scelerisque sollicitudin dolor arcu scelerisque proin sed eget orci tristique nec diam portaest eu sollicitudin tempus hendrerit.\r\n\r\nNunc mi cursus vivamus amet enim lacus sem ex sollicitudin accumsan elementum eu quis hendrerit et sed nunc id proin accumsan purus rutrum molestie lacus.\r\n\r\nEnim ipsum suspendisse nulla euismod portaest quam orci nulla cursus vel nulla quam dolor interdum elementum placerat fusce a hendrerit eu portaest suspendisse et facilisis.\r\n\r\nAccumsan varius vivamus eros maecenas quis quisque sed orci interdum ex lacus eu vivamus sem magna proin hendrerit ex arcu nisi ut ex sollicitudin maximus.'),(2,5,'Test','Three','1582121937.jpg',NULL),(3,6,'Test','Four','1582122863.jpg',NULL),(4,7,'Test','Five','1582122885.jpg',NULL),(5,8,'Test','Six','1582122903.jpg',NULL),(6,9,'Test','Seven','1582122922.jpg',NULL),(7,10,'Test','Eight','1582122939.jpg',NULL),(8,11,'Test','Nine','1582122961.jpg',NULL),(9,12,'Test','Ten','1582126324.jpg','Scelerisque condimentum tempus euismod adipiscing facilisis phasellus amet urna eget arcu maximus cursus cursus id enim elit nisl metus sit maximus magna mi magna eros.\r\n\r\nSit consectetur portaest diam ut tempus gravida metus eu ut euismod aliquam portaest condimentum massa diam ex congue eros eu fusce sed arcu gravida phasellus.');

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `role` */

insert  into `role`(`id`,`title`) values (1,'Super Admin'),(2,'Manager'),(3,'Clients'),(4,'Models');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` int(11) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_user_role_id` (`role`),
  CONSTRAINT `fk_user_role_id` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`email`,`role`,`status`) values (1,'test1','123456','test1@localhost.com',3,1),(2,'test2','123456','test2@localhost.com',4,1),(5,'test3','123456','test3@localhost.com',4,1),(6,'test4','123456','test4@localhost.com',4,1),(7,'test5','123456','test5@localhost.com',4,1),(8,'test6','123456','test6@localhost.com',4,1),(9,'test7','123456','test7@localhost.com',4,1),(10,'test8','123456','test8@localhost.com',4,1),(11,'test9','123456','test9@localhost.com',4,1),(12,'test10','123456','test10@localhost.com',4,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
