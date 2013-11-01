/*
SQLyog Ultimate v9.20 
MySQL - 5.6.12-log : Database - girucode
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`girucode` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `girucode`;

/*Table structure for table `cursos` */

DROP TABLE IF EXISTS `cursos`;

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `idEtiquetas` int(11) NOT NULL,
  `idTutores` int(11) NOT NULL,
  `portada` text NOT NULL,
  `slug` varchar(10) NOT NULL,
  `puntos` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `cursos` */

insert  into `cursos`(`id`,`nombre`,`descripcion`,`idEtiquetas`,`idTutores`,`portada`,`slug`,`puntos`,`estado`) values (1,'HTML5','curso uno',1,1,'http://angelkurten.com/cdn/img/html5.png\r\n\r\n','html5',10,1),(2,'PHP','curso 1',2,1,'http://angelkurten.com/cdn/img/php.jpg\r\n','php',20,1),(21,'nombre','descripcion',0,0,'p','s',0,0),(22,'nombre','descripcion',0,0,'p','s',0,0),(23,'nombre','descripcion',0,0,'p','s',0,0);

/*Table structure for table `videos` */

DROP TABLE IF EXISTS `videos`;

CREATE TABLE `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `codYoutube` text NOT NULL,
  `descripcion` text NOT NULL,
  `duracion` time NOT NULL,
  `slug` varchar(50) NOT NULL,
  `puntos` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `videos` */

insert  into `videos`(`id`,`nombre`,`codYoutube`,`descripcion`,`duracion`,`slug`,`puntos`) values (1,'Aprende PHP desde cero HD (1/10)','JNbTvInths0','Curso de PHP impartido por CodeJobs','00:34:20','php1',10),(2,'Aprende PHP desde cero HD (2/10)','2EVO_2fFdBU','Cursoo PHP CodeJobs','00:39:34','php2',10);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
