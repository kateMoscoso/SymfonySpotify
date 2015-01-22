-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-01-2015 a las 19:54:59
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `miw_musica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE IF NOT EXISTS `etiquetas` (
`id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`id`, `nombre`, `idUsuario`) VALUES
(1, 'rock', 1),
(2, 'pop', 1),
(3, 'dance', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorito`
--

CREATE TABLE IF NOT EXISTS `favorito` (
`id` int(11) NOT NULL,
  `idSpotify` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idTipo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `etiqueta` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `favorito`
--

INSERT INTO `favorito` (`id`, `idSpotify`, `idTipo`, `idUsuario`, `etiqueta`) VALUES
(1, '600HVBpzF1WfBdaRwbEvLz', 3, 2, ''),
(2, '2QAHN4C4M8D8E8eiQvQW6a', 3, 1, 'Rock'),
(3, '0bTnB8YDYijhQbSWwpQYDU', 3, 2, ''),
(4, '42UJjk8i8L0De7lQtu7sqi', 2, 2, ''),
(5, '2p4FqHnazRucYQHyDCdBrJ', 1, 2, ''),
(13, '511stzj94eZPxWOLFuqREz', 3, 1, 'Pop'),
(14, '4aHlTPFGOwfFtjx74cjTJA', 2, 1, 'Pop'),
(15, '2Oehrcv4Kov0SuIgWyQY9e', 3, 1, ''),
(16, '2Fsy6GsFvp3Z5EHaIfcXLi', 3, 1, ''),
(17, '1vAEF8F0HoRFGiYOEeJXHW', 2, 1, 'Pop'),
(18, '6Ep6BzIOB9tz3P4sWqiiAB', 3, 1, ''),
(20, '51Blml2LZPmy7TTiAg47vQ', 1, 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
`id` int(11) NOT NULL,
  `Nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `Nombre`) VALUES
(1, 'interprete'),
(2, 'album'),
(3, 'tema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) NOT NULL,
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `esAdmin` tinyint(1) DEFAULT NULL,
  `esActivo` tinyint(1) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `esAdmin`, `esActivo`, `email`, `create_time`) VALUES
(1, 'u1', '$2a$12$yf.Q3YSPvezPG6bbCbf6ReI2cgF/.prma1ZRK9pPuyDB2GIrur67G', 1, 1, 'u1@gmail.com', NULL),
(2, 'u2', '$2y$10$x5tahlUekzCPlC2BBLjhM.r5I7vPgPPRqMtfLInPDs3st9FumS0Am', 0, 1, 'u2@gmail.com', '2015-01-16 00:00:00'),
(3, 'Carlos', '$2y$10$IQ4Arg2PkNH3YTA6TZkjKenmKxM0Bwt3bETmclLml2yMsqUp7pVx6', 1, 1, 'carlos@gmail.com', '2015-01-16 20:03:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `favorito`
--
ALTER TABLE `favorito`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `favorito`
--
ALTER TABLE `favorito`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
