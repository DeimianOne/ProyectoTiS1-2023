-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2023 a las 08:56:07
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proy-tis1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `cod_agenda` bigint(20) NOT NULL,
  `cod_departamento` bigint(20) NOT NULL,
  `rut_usuario` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE `comuna` (
  `cod_comuna` bigint(20) NOT NULL,
  `cod_region` bigint(20) NOT NULL,
  `nombre_comuna` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`cod_comuna`, `cod_region`, `nombre_comuna`) VALUES
(7, 7, 'hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `cod_departamento` bigint(20) NOT NULL,
  `cod_municipalidad` bigint(20) NOT NULL,
  `nombre_departamento` varchar(50) NOT NULL,
  `telefono_departamento` bigint(20) NOT NULL,
  `atencion_presencial` tinyint(1) NOT NULL,
  `horario_atencion_inicio` time DEFAULT NULL,
  `horario_atencion_termino` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`cod_departamento`, `cod_municipalidad`, `nombre_departamento`, `telefono_departamento`, `atencion_presencial`, `horario_atencion_inicio`, `horario_atencion_termino`) VALUES
(1, 1, 'qweq', 321423, 0, '20:20:00', '18:23:00'),
(2, 1, 'rgfegserg', 43254, 0, '20:23:00', '18:26:00'),
(3, 1, 'eqwrwer', 4315, 1, '19:26:00', '18:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `cod_direccion` bigint(20) NOT NULL,
  `cod_comuna` bigint(20) NOT NULL,
  `calle` varchar(255) NOT NULL,
  `numero` smallint(6) NOT NULL,
  `numero_departamento` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado_departamento`
--

CREATE TABLE `encargado_departamento` (
  `cod_departamento` bigint(20) NOT NULL,
  `rut_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `cod_estado` bigint(20) NOT NULL,
  `nombre_estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_ticket`
--

CREATE TABLE `estado_ticket` (
  `cod_ticket` bigint(20) NOT NULL,
  `cod_estado` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipalidad`
--

CREATE TABLE `municipalidad` (
  `cod_municipalidad` bigint(20) NOT NULL,
  `nombre_municipalidad` varchar(50) NOT NULL,
  `cod_comuna` bigint(20) NOT NULL,
  `direccion_municipalidad` varchar(255) NOT NULL,
  `correo_municipalidad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `municipalidad`
--

INSERT INTO `municipalidad` (`cod_municipalidad`, `nombre_municipalidad`, `cod_comuna`, `direccion_municipalidad`, `correo_municipalidad`) VALUES
(1, 'qweqw', 7, 'adfahgar', 'qwe@aad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabra_ofensiva`
--

CREATE TABLE `palabra_ofensiva` (
  `cod_palabra` int(11) NOT NULL,
  `palabra` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `palabra_ofensiva`
--

INSERT INTO `palabra_ofensiva` (`cod_palabra`, `palabra`) VALUES
(1, 'mierda'),
(2, 'conchetumadre'),
(3, 'carajo'),
(4, 'hijo de puta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `cod_permiso` bigint(20) NOT NULL,
  `nombre_permiso` varchar(30) NOT NULL,
  `descripcion_permiso` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `cod_proyecto` bigint(20) NOT NULL,
  `cod_departamento` bigint(20) NOT NULL,
  `nombre_proyecto` varchar(50) NOT NULL,
  `descripcion_proyecto` varchar(500) NOT NULL,
  `fecha_inicio_proyecto` date DEFAULT NULL,
  `fecha_termino_estimada_proyecto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `cod_region` bigint(20) NOT NULL,
  `nombre_region` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`cod_region`, `nombre_region`) VALUES
(7, 'hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `cod_respuesta` bigint(20) NOT NULL,
  `cod_ticket` bigint(20) NOT NULL,
  `rut_usuario` bigint(20) NOT NULL,
  `detalles_respuesta` text NOT NULL,
  `fecha_hora_envio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `cod_rol` bigint(20) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`cod_rol`, `nombre_rol`) VALUES
(1, 'admin'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE `rol_permiso` (
  `cod_permiso` bigint(20) NOT NULL,
  `cod_rol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion`
--

CREATE TABLE `suscripcion` (
  `cod_ticket` bigint(20) NOT NULL,
  `rut_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `cod_ticket` bigint(20) NOT NULL,
  `cod_departamento` bigint(20) NOT NULL,
  `rut_usuario` bigint(20) NOT NULL,
  `tipo_solicitud` enum('felicitacion','sugerencia','reclamo') NOT NULL,
  `asunto_ticket` varchar(50) NOT NULL,
  `detalles_solicitud` text NOT NULL,
  `fecha_hora_envio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `calificacion` float DEFAULT NULL,
  `visibilidad_solicitud` tinyint(1) NOT NULL,
  `con_palabras_ofensivas` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`cod_ticket`, `cod_departamento`, `rut_usuario`, `tipo_solicitud`, `asunto_ticket`, `detalles_solicitud`, `fecha_hora_envio`, `calificacion`, `visibilidad_solicitud`, `con_palabras_ofensivas`) VALUES
(1, 1, 1111, 'reclamo', 'calle', 'esta calle tiene tremendo hoyo', '2023-11-03 04:03:34', NULL, 0, 0),
(2, 2, 1111, 'reclamo', 'poste luz', 'el poste esta quemao', '2023-11-03 04:08:55', NULL, 0, 0),
(4, 1, 1111, 'reclamo', 'hola', 'hola', '2023-11-03 07:35:03', NULL, 0, 0),
(5, 1, 1111, 'felicitacion', 'chao', 'chao', '2023-11-03 07:42:40', NULL, 0, 0),
(6, 1, 1111, 'reclamo', 'gay', 'gay', '2023-11-03 07:52:54', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `rut_usuario` bigint(20) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `correo_electronico_usuario` varchar(255) NOT NULL,
  `correo_electronico_tercero` varchar(255) DEFAULT NULL,
  `telefono_usuario` bigint(20) DEFAULT NULL,
  `telefono_tercero` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`rut_usuario`, `nombre_usuario`, `correo_electronico_usuario`, `correo_electronico_tercero`, `telefono_usuario`, `telefono_tercero`) VALUES
(1111, 'perkin', 'wena@gmail.com', '', 0, 0),
(1234, 'admin', 'correo@gmail.com', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_direccion`
--

CREATE TABLE `usuario_direccion` (
  `rut_usuario` bigint(20) NOT NULL,
  `cod_direccion` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `cod_rol` bigint(20) NOT NULL,
  `rut_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`cod_rol`, `rut_usuario`) VALUES
(1, 1234),
(2, 1111);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`cod_agenda`),
  ADD KEY `agenda_ibfk_1` (`cod_departamento`),
  ADD KEY `rut_usuario` (`rut_usuario`);

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`cod_comuna`),
  ADD KEY `cod_region` (`cod_region`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`cod_departamento`),
  ADD KEY `cod_municipalidad` (`cod_municipalidad`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`cod_direccion`),
  ADD KEY `cod_comuna` (`cod_comuna`);

--
-- Indices de la tabla `encargado_departamento`
--
ALTER TABLE `encargado_departamento`
  ADD KEY `cod_departamento` (`cod_departamento`),
  ADD KEY `rut_usuario` (`rut_usuario`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`cod_estado`);

--
-- Indices de la tabla `estado_ticket`
--
ALTER TABLE `estado_ticket`
  ADD KEY `cod_estado` (`cod_estado`),
  ADD KEY `cod_ticket` (`cod_ticket`);

--
-- Indices de la tabla `municipalidad`
--
ALTER TABLE `municipalidad`
  ADD PRIMARY KEY (`cod_municipalidad`),
  ADD KEY `cod_comuna` (`cod_comuna`);

--
-- Indices de la tabla `palabra_ofensiva`
--
ALTER TABLE `palabra_ofensiva`
  ADD PRIMARY KEY (`cod_palabra`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`cod_permiso`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`cod_proyecto`),
  ADD KEY `cod_departamento` (`cod_departamento`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`cod_region`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`cod_respuesta`),
  ADD KEY `cod_ticket` (`cod_ticket`),
  ADD KEY `rut_usuario` (`rut_usuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`cod_rol`);

--
-- Indices de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD KEY `cod_permiso` (`cod_permiso`),
  ADD KEY `cod_rol` (`cod_rol`);

--
-- Indices de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD KEY `cod_ticket` (`cod_ticket`),
  ADD KEY `rut_usuario` (`rut_usuario`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`cod_ticket`),
  ADD KEY `cod_departamento` (`cod_departamento`),
  ADD KEY `rut_usuario` (`rut_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`rut_usuario`);

--
-- Indices de la tabla `usuario_direccion`
--
ALTER TABLE `usuario_direccion`
  ADD KEY `rut_usuario` (`rut_usuario`),
  ADD KEY `cod_direccion` (`cod_direccion`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD KEY `cod_rol` (`cod_rol`),
  ADD KEY `rut_usuario` (`rut_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `cod_agenda` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `cod_comuna` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `cod_departamento` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `cod_direccion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `cod_estado` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipalidad`
--
ALTER TABLE `municipalidad`
  MODIFY `cod_municipalidad` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `palabra_ofensiva`
--
ALTER TABLE `palabra_ofensiva`
  MODIFY `cod_palabra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `cod_permiso` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `cod_proyecto` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `cod_region` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `cod_respuesta` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `cod_rol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `cod_ticket` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`cod_departamento`) REFERENCES `departamento` (`cod_departamento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD CONSTRAINT `comuna_ibfk_1` FOREIGN KEY (`cod_region`) REFERENCES `region` (`cod_region`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `departamento_ibfk_1` FOREIGN KEY (`cod_municipalidad`) REFERENCES `municipalidad` (`cod_municipalidad`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `direccion_ibfk_1` FOREIGN KEY (`cod_comuna`) REFERENCES `comuna` (`cod_comuna`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `encargado_departamento`
--
ALTER TABLE `encargado_departamento`
  ADD CONSTRAINT `encargado_departamento_ibfk_1` FOREIGN KEY (`cod_departamento`) REFERENCES `departamento` (`cod_departamento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `encargado_departamento_ibfk_2` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `estado_ticket`
--
ALTER TABLE `estado_ticket`
  ADD CONSTRAINT `estado_ticket_ibfk_1` FOREIGN KEY (`cod_estado`) REFERENCES `estado` (`cod_estado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estado_ticket_ibfk_2` FOREIGN KEY (`cod_ticket`) REFERENCES `ticket` (`cod_ticket`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `municipalidad`
--
ALTER TABLE `municipalidad`
  ADD CONSTRAINT `municipalidad_ibfk_1` FOREIGN KEY (`cod_comuna`) REFERENCES `comuna` (`cod_comuna`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `proyecto_ibfk_1` FOREIGN KEY (`cod_departamento`) REFERENCES `departamento` (`cod_departamento`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`cod_ticket`) REFERENCES `ticket` (`cod_ticket`) ON UPDATE CASCADE,
  ADD CONSTRAINT `respuesta_ibfk_2` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD CONSTRAINT `rol_permiso_ibfk_1` FOREIGN KEY (`cod_permiso`) REFERENCES `permiso` (`cod_permiso`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rol_permiso_ibfk_2` FOREIGN KEY (`cod_rol`) REFERENCES `rol` (`cod_rol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD CONSTRAINT `suscripcion_ibfk_1` FOREIGN KEY (`cod_ticket`) REFERENCES `ticket` (`cod_ticket`) ON UPDATE CASCADE,
  ADD CONSTRAINT `suscripcion_ibfk_2` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`cod_departamento`) REFERENCES `departamento` (`cod_departamento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_direccion`
--
ALTER TABLE `usuario_direccion`
  ADD CONSTRAINT `usuario_direccion_ibfk_2` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_direccion_ibfk_3` FOREIGN KEY (`cod_direccion`) REFERENCES `direccion` (`cod_direccion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `usuario_rol_ibfk_1` FOREIGN KEY (`cod_rol`) REFERENCES `rol` (`cod_rol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_rol_ibfk_2` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
