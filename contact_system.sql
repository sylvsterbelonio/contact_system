/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - contact_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `contacts` */

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `name` varchar(255) DEFAULT '',
  `company` varchar(255) DEFAULT '',
  `phone` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

/*Data for the table `contacts` */

insert  into `contacts`(`id`,`user_id`,`name`,`company`,`phone`,`email`,`created_at`) values 
(8,25,'name','company','phone','emi@gmail.com','2025-01-15 15:36:43'),
(9,25,'michael','fcdi','phone','asdf@gmail.com','2025-01-15 15:37:00'),
(10,25,'shiella','asc','asdf','sadf@gmaill.comx','2025-01-15 15:37:12'),
(11,25,'asd','aw','aw','Aad@gmail.com','2025-01-15 15:55:31'),
(12,26,'aaa','bbbq','ccc','ddd@gmail.com','2025-01-15 16:05:12'),
(13,25,'aasd','awda','awd','daw@gmail.com','2025-01-15 16:10:18'),
(14,25,'222','222','34','ASD@gmail.com','2025-01-15 16:10:26'),
(15,25,'asda','asd','asd','asd@gmail.com','2025-01-15 16:16:56'),
(16,25,'1','','','','2025-01-15 16:17:01'),
(17,25,'2','','','','2025-01-15 16:17:01'),
(18,25,'543','','','','2025-01-15 16:17:01'),
(19,25,'334','','','','2025-01-15 16:17:02'),
(20,25,'4','','','','2025-01-15 16:17:02'),
(21,25,'534','','','','2025-01-15 16:17:02'),
(22,25,'534','','','','2025-01-15 16:17:03'),
(23,25,'43','','','','2025-01-15 16:17:03'),
(24,25,'43','','','','2025-01-15 16:17:03'),
(25,25,'r','','','','2025-01-15 16:17:03'),
(27,27,'awdwdx','awdx','awd','awd@gmai.com','2025-01-15 16:40:05');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `company` varchar(255) DEFAULT '',
  `phone` varchar(255) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`password`,`company`,`phone`,`email`,`created_at`) values 
(25,'sylvster','294c0954de82308d4b3c69c99ccad78e','','','sylvster129@gmail.com','2025-01-15 15:20:24'),
(26,'michael','5f4dcc3b5aa765d61d8327deb882cf99','','','michael@gmail.com','2025-01-15 16:05:00'),
(27,'asdad','294c0954de82308d4b3c69c99ccad78e','','','asd@gmail.com','2025-01-15 16:39:49');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
