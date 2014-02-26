/*
SQLyog Trial v11.32 (64 bit)
MySQL - 5.5.16-log : Database - edificio
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`edificio` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `edificio`;

/*Table structure for table `ciudades` */

DROP TABLE IF EXISTS `ciudades`;

CREATE TABLE `ciudades` (
  `Cod_Ciudad` varchar(4) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `Nom_Ciudad` varchar(80) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `Cod_Dpto` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`Cod_Ciudad`),
  KEY `Cod_Dpto` (`Cod_Dpto`),
  CONSTRAINT `ciudades_ibfk_1` FOREIGN KEY (`Cod_Dpto`) REFERENCES `departamentos` (`Cod_Dpto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `ciudades` */

insert  into `ciudades`(`Cod_Ciudad`,`Nom_Ciudad`,`Cod_Dpto`) values ('1','Valledupar','1');

/*Table structure for table `departamentos` */

DROP TABLE IF EXISTS `departamentos`;

CREATE TABLE `departamentos` (
  `Cod_Dpto` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `Nom_Dpto` varchar(80) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`Cod_Dpto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `departamentos` */

insert  into `departamentos`(`Cod_Dpto`,`Nom_Dpto`) values ('1','Cesar');

/*Table structure for table `personas` */

DROP TABLE IF EXISTS `personas`;

CREATE TABLE `personas` (
  `Ced_Persona` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `Nom_Persona` varchar(40) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `Ape_Persona` varchar(40) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `Dir_Persona` varchar(60) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `Tel_Persona` varchar(16) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `Cod_Ciudad` varchar(4) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `Cod_Dpto` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`Ced_Persona`),
  KEY `Cod_Dpto` (`Cod_Dpto`),
  KEY `Cod_Ciudad` (`Cod_Ciudad`),
  CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`Cod_Dpto`) REFERENCES `departamentos` (`Cod_Dpto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `personas_ibfk_2` FOREIGN KEY (`Cod_Ciudad`) REFERENCES `ciudades` (`Cod_Ciudad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `personas` */

/*Table structure for table `pisos` */

DROP TABLE IF EXISTS `pisos`;

CREATE TABLE `pisos` (
  `Cod_Piso` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `Nom_Piso` varchar(80) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`Cod_Piso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `pisos` */

/*Table structure for table `salidas` */

DROP TABLE IF EXISTS `salidas`;

CREATE TABLE `salidas` (
  `Cod_Sallida` bigint(16) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Fecha_Salida` date NOT NULL DEFAULT '0000-00-00',
  `Ced_Persona` varchar(12) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`Cod_Sallida`),
  KEY `Ced_Persona` (`Ced_Persona`),
  CONSTRAINT `salidas_ibfk_1` FOREIGN KEY (`Ced_Persona`) REFERENCES `personas` (`Ced_Persona`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `salidas` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
