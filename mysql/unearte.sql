-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 16-05-2023 a las 23:05:18
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--
CREATE DATABASE IF NOT EXISTS `proyecto` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `proyecto`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

DROP TABLE IF EXISTS `actividad`;
CREATE TABLE IF NOT EXISTS `actividad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `actividad` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id`, `actividad`) VALUES
(3, 'exposicion'),
(4, 'canto y musica'),
(5, 'baile artistica'),
(10, 'berro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

DROP TABLE IF EXISTS `clase`;
CREATE TABLE IF NOT EXISTS `clase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `clase_nombre` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id`, `clase_nombre`) VALUES
(1, 'videovid'),
(2, 'estereo'),
(3, 'mascaras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

DROP TABLE IF EXISTS `equipos`;
CREATE TABLE IF NOT EXISTS `equipos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo_equ` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codigo_bien` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre_equ` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `grupo` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `clase` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_equ` (`codigo_equ`),
  UNIQUE KEY `codigo_bien` (`codigo_bien`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `codigo_equ`, `codigo_bien`, `nombre_equ`, `estado`, `grupo`, `clase`) VALUES
(1, '45463', 'dsadasds', 'vidiovid color verde', 'prestamo', '75', '1'),
(3, '202020', 'dsdas', 'stereo color negro inalambrico', 'bien', '75', '2'),
(8, '454654', '4546543', 'mondogo', 'bien', '', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `grupo_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `grupo_nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`grupo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`grupo_id`, `grupo_nombre`) VALUES
('75', 'alv wn'),
('456465', 'dadsadsa'),
('800', 'sisoy');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

DROP TABLE IF EXISTS `prestamo`;
CREATE TABLE IF NOT EXISTS `prestamo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `equipo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `fecha_devolucion` date NOT NULL,
  `fecha_uso` date NOT NULL,
  `hora_inicial` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `hora_final` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `equipo_solicitado` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `actividad` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `salon` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `observacion` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `cedula_solicitante` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cedula_revisor` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`id`, `equipo`, `fecha_creacion`, `fecha_entrega`, `fecha_devolucion`, `fecha_uso`, `hora_inicial`, `hora_final`, `equipo_solicitado`, `cantidad`, `actividad`, `salon`, `observacion`, `cedula_solicitante`, `estado`, `cedula_revisor`) VALUES
(17, '45463', '2023-05-14', '2023-05-15', '2023-05-15', '2023-05-16', '14:00', '16:00', '1', '1', '4', '2', '', '27564673', '3', '1'),
(18, '45463', '2023-05-15', '2023-05-15', '2023-05-25', '2023-05-20', '08:00', '15:00', '1', '1', '3', '2', '', '9372683', '2', '1'),
(19, NULL, '2023-05-16', NULL, '2023-05-26', '2023-05-19', '16:00', '18:00', '2', '1', '10', '2', NULL, '27564673', '1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salon`
--

DROP TABLE IF EXISTS `salon`;
CREATE TABLE IF NOT EXISTS `salon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `salon_nombre` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `salon`
--

INSERT INTO `salon` (`id`, `salon_nombre`) VALUES
(1, 'simon ramirez'),
(2, 'aura boreal'),
(3, 'gfdgdfgdfgfd'),
(4, 'dsadasdsagfg ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `cedula` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`cedula`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cedula`, `nombre`, `apellido`, `pass`, `rol`, `estado`) VALUES
('27564673', 'jonas', 'pepe', '152560', 'usuario', 1),
('11716900', 'dsadasdasdas', 'ramirez', '152560', 'almacenista', 1),
('9372683', 'niretcia', 'valero', '152560', 'usuario', 1),
('2147483647', 'albani', 'albani', '152560', 'usuario', 1),
('545646', 'alaverga', 'dsadas', '', 'usuario', 0),
('45646541465465', 'dadsadas', 'dsadasdsa', '', 'usuario', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
