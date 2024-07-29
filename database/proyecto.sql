-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-09-2023 a las 00:46:31
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
CREATE DATABASE IF NOT EXISTS `proyecto` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proyecto`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amputacion_protesis`
--

DROP TABLE IF EXISTS `amputacion_protesis`;
CREATE TABLE `amputacion_protesis` (
  `ahp_protesis` int(5) NOT NULL,
  `ahp_idtipoamp` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracterizacion`
--

DROP TABLE IF EXISTS `caracterizacion`;
CREATE TABLE `caracterizacion` (
  `id_caracterizacion` int(5) NOT NULL,
  `altura` decimal(10,0) UNSIGNED NOT NULL,
  `peso` int(3) UNSIGNED NOT NULL,
  `diametro_pierna` decimal(10,0) UNSIGNED NOT NULL,
  `antecedentes` varchar(40) NOT NULL,
  `puntaje` int(3) UNSIGNED NOT NULL,
  `caracterizacion_idtipoamp` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `protesis`
--

DROP TABLE IF EXISTS `protesis`;
CREATE TABLE `protesis` (
  `id_protesis` int(5) NOT NULL,
  `diseño` varchar(10) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `material` varchar(50) NOT NULL,
  `costo` decimal(10,0) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `id_rol` int(5) NOT NULL,
  `nombre_rol` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'administrador'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_amputacion`
--

DROP TABLE IF EXISTS `tipo_amputacion`;
CREATE TABLE `tipo_amputacion` (
  `id_amputacion` int(5) NOT NULL,
  `tipo_amputacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(10) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(20) NOT NULL,
  `edad` int(2) NOT NULL,
  `celular` int(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `c_idcarac` int(5) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `clave`, `nombre`, `apellidos`, `edad`, `celular`, `email`, `c_idcarac`, `estado`) VALUES
(1042134, '', 'pepito', 'gomez', 0, 0, 'pepe@gmail.com', 0, 0),
(1098822276, 'rUahGMzWB4U88GsHzr00YA==', 'Jhonatan Snheider', 'Romero', 0, 0, 'cferomero@outlook.com', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_protesis`
--

DROP TABLE IF EXISTS `usuarios_protesis`;
CREATE TABLE `usuarios_protesis` (
  `id_uhp` int(5) NOT NULL,
  `uhp_idprotesis` int(5) NOT NULL,
  `uhp_idusuarios` int(10) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `fec_entrega` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_roles`
--

DROP TABLE IF EXISTS `usuarios_roles`;
CREATE TABLE `usuarios_roles` (
  `id_usuario` int(10) NOT NULL,
  `id_rol` int(5) NOT NULL,
  `permisos` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios_roles`
--

INSERT INTO `usuarios_roles` (`id_usuario`, `id_rol`, `permisos`) VALUES
(1042134, 1, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracterizacion`
--
ALTER TABLE `caracterizacion`
  ADD PRIMARY KEY (`id_caracterizacion`),
  ADD KEY `caracterizacion_idtipoamp` (`caracterizacion_idtipoamp`);

--
-- Indices de la tabla `protesis`
--
ALTER TABLE `protesis`
  ADD PRIMARY KEY (`id_protesis`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_amputacion`
--
ALTER TABLE `tipo_amputacion`
  ADD PRIMARY KEY (`id_amputacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `c_idcarac` (`c_idcarac`);

--
-- Indices de la tabla `usuarios_protesis`
--
ALTER TABLE `usuarios_protesis`
  ADD PRIMARY KEY (`id_uhp`),
  ADD KEY `uhp_idprotesis` (`uhp_idprotesis`,`uhp_idusuarios`),
  ADD KEY `uhp_idusuarios` (`uhp_idusuarios`);

--
-- Indices de la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD PRIMARY KEY (`id_usuario`,`id_rol`),
  ADD KEY `id_usuario` (`id_usuario`,`id_rol`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracterizacion`
--
ALTER TABLE `caracterizacion`
  MODIFY `id_caracterizacion` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `protesis`
--
ALTER TABLE `protesis`
  MODIFY `id_protesis` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_amputacion`
--
ALTER TABLE `tipo_amputacion`
  MODIFY `id_amputacion` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios_protesis`
--
ALTER TABLE `usuarios_protesis`
  MODIFY `id_uhp` int(5) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caracterizacion`
--
ALTER TABLE `caracterizacion`
  ADD CONSTRAINT `caracterizacion_ibfk_1` FOREIGN KEY (`caracterizacion_idtipoamp`) REFERENCES `tipo_amputacion` (`id_amputacion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `caracterizacion_ibfk_2` FOREIGN KEY (`id_caracterizacion`) REFERENCES `usuarios` (`c_idcarac`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_protesis`
--
ALTER TABLE `usuarios_protesis`
  ADD CONSTRAINT `usuarios_protesis_ibfk_1` FOREIGN KEY (`uhp_idprotesis`) REFERENCES `protesis` (`id_protesis`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_protesis_ibfk_2` FOREIGN KEY (`uhp_idusuarios`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_roles`
--
ALTER TABLE `usuarios_roles`
  ADD CONSTRAINT `usuarios_roles_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_roles_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
