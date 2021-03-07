/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.37-MariaDB : Database - newdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`newdb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `newdb`;

/*Table structure for table `category_information` */

DROP TABLE IF EXISTS `category_information`;

CREATE TABLE `category_information` (
  `item_name` varchar(30) DEFAULT NULL,
  `id` int(15) NOT NULL,
  `category_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `category_information` */

/*Table structure for table `contuct_us` */

DROP TABLE IF EXISTS `contuct_us`;

CREATE TABLE `contuct_us` (
  `id` int(15) NOT NULL,
  `Detail` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `contuct_us` */

/*Table structure for table `creat_admin` */

DROP TABLE IF EXISTS `creat_admin`;

CREATE TABLE `creat_admin` (
  `email` varchar(30) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `confirm_password` varchar(20) DEFAULT NULL,
  `admin_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `creat_admin` */

/*Table structure for table `item_info` */

DROP TABLE IF EXISTS `item_info`;

CREATE TABLE `item_info` (
  `id` int(15) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `item_info` */

insert  into `item_info`(`id`,`name`) values (454,'34544'),(1253,'computer'),(4354,'534543'),(234234,'2345245'),(356546,'565456'),(2147483647,'234234');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
