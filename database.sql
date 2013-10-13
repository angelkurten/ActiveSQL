-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-10-2013 a las 19:00:39
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `girucode`
--
CREATE DATABASE IF NOT EXISTS `girucode` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `girucode`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `idEtiquetas` int(11) NOT NULL,
  `idTutores` int(11) NOT NULL,
  `portada` text NOT NULL,
  `slug` varchar(10) NOT NULL,
  `puntos` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `descripcion`, `idEtiquetas`, `idTutores`, `portada`, `slug`, `puntos`, `estado`) VALUES
(1, 'HTML5', 'Curso de HTML5', 1, 1, 'http://angelkurten.com/cdn/img/html5.png\r\n\r\n', 'html5', 10, 1),
(2, 'PHP', 'Curso de PHP k\r\n	', 2, 1, 'http://angelkurten.com/cdn/img/php.jpg\r\n', 'php', 20, 1);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `codYoutube` text NOT NULL,
  `descripcion` text NOT NULL,
  `duracion` time NOT NULL,
  `slug` varchar(50) NOT NULL,
  `puntos` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`id`, `nombre`, `codYoutube`, `descripcion`, `duracion`, `slug`, `puntos`) VALUES
(1, 'Aprende PHP desde cero HD (1/10)', 'JNbTvInths0', 'Curso de PHP impartido por CodeJobs', '00:34:20', 'php1', 10),
(2, 'Aprende PHP desde cero HD (2/10)', '2EVO_2fFdBU', 'Cursoo PHP CodeJobs', '00:39:34', 'php2', 10);

