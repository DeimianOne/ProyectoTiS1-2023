-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2023 a las 08:00:27
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
-- Base de datos: `proy-tis1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `cod_agenda` bigint(20) NOT NULL,
  `rut_usuario` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion_atencion`
--

CREATE TABLE `calificacion_atencion` (
  `cod_calificacion_atencion` bigint(20) NOT NULL,
  `cod_ticket` bigint(20) DEFAULT NULL,
  `calificacion_atencion` int(11) NOT NULL,
  `comentario_atencion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion_sistema`
--

CREATE TABLE `calificacion_sistema` (
  `cod_calificacion_sistema` bigint(20) NOT NULL,
  `cod_ticket` bigint(20) DEFAULT NULL,
  `calificacion_sistema` float NOT NULL,
  `comentario_sistema` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

CREATE TABLE `comuna` (
  `cod_comuna` bigint(20) NOT NULL,
  `cod_region` bigint(20) NOT NULL,
  `nombre_comuna` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`cod_comuna`, `cod_region`, `nombre_comuna`) VALUES
(13, 11, 'Concepción'),
(14, 11, 'Talcahuano'),
(15, 12, 'Valdivia'),
(16, 13, 'Puerto Montt'),
(17, 13, 'Osorno'),
(18, 14, 'Temuco');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`cod_departamento`, `cod_municipalidad`, `nombre_departamento`, `telefono_departamento`, `atencion_presencial`, `horario_atencion_inicio`, `horario_atencion_termino`) VALUES
(13, 68, 'Departamento de Obras Públicas', 123456789, 0, '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `cod_direccion` bigint(20) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `latitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`cod_direccion`, `direccion`, `latitud`, `longitud`) VALUES
(1, '', -36.8282, -73.0513),
(2, 'Anibal Pinto, Concepción, Chile', -36.8172, -73.0557),
(3, 'Anibal Pinto, Concepción, Chile', -36.8172, -73.0557);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `cod_estado` bigint(20) NOT NULL,
  `nombre_estado` varchar(50) NOT NULL,
  `descripcion_estado` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`cod_estado`, `nombre_estado`, `descripcion_estado`) VALUES
(0, 'Pendiente de Revisión', 'La solicitud ha sido recibida y almacenada en el sistema, pero aún no ha sido revisada.'),
(1, 'En Proceso', 'Se ha comenzado a abordar la solicitud, ya sea investigando un reclamo, implementando una sugerencia o preparando una respuesta a una felicitación.'),
(2, 'Cerrado', 'La solicitud se considera finalizada y cerrada. Esto puede ser aplicable a felicitaciones donde no se requieren acciones adicionales.'),
(3, 'Remitido', 'La solicitud ha sido enviada o redireccionada a otro departamento para su atención y revisión'),
(14, 'Calle en Reparación', 'Usado por el departamento de calles. La calle está en reparación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_ticket`
--

CREATE TABLE `estado_ticket` (
  `cod_ticket` bigint(20) NOT NULL,
  `cod_estado` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estado_ticket`
--

INSERT INTO `estado_ticket` (`cod_ticket`, `cod_estado`) VALUES
(40, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipalidad`
--

CREATE TABLE `municipalidad` (
  `cod_municipalidad` bigint(20) NOT NULL,
  `nombre_municipalidad` varchar(50) NOT NULL,
  `cod_comuna` bigint(20) NOT NULL,
  `cod_direccion` bigint(20) DEFAULT NULL,
  `correo_municipalidad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `municipalidad`
--

INSERT INTO `municipalidad` (`cod_municipalidad`, `nombre_municipalidad`, `cod_comuna`, `cod_direccion`, `correo_municipalidad`) VALUES
(68, 'Municipalidad de Concepción', 13, 1, 'municipalidadconcepcion@gmail.com'),
(69, 'Municipalidad de San Pedro de la Paz', 13, 2, 'sanpedrodelapaz@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabra_ofensiva`
--

CREATE TABLE `palabra_ofensiva` (
  `cod_palabra` int(11) NOT NULL,
  `palabra` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `palabra_ofensiva`
--

INSERT INTO `palabra_ofensiva` (`cod_palabra`, `palabra`) VALUES
(1, 'mierdaa'),
(2, 'conchetumadre'),
(4, 'hijo de puta'),
(5, 'carajo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `cod_permiso` bigint(20) NOT NULL,
  `nombre_permiso` varchar(30) NOT NULL,
  `descripcion_permiso` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`cod_permiso`, `nombre_permiso`, `descripcion_permiso`) VALUES
(1, 'Ver tablas de datos', 'Permite al usuario poder visualizar en la pagina las tablas de la base de datos'),
(2, 'Agregar entrada', 'Permite al usuario agregar entradas a las tablas de datos'),
(3, 'Editar entrada', 'Permite al usuario editar una entrada de las tablas de datos'),
(4, 'Borrar entrada', 'Permite al usuario borrar una entrada en una tabla de datos'),
(5, 'Responder Tickets', 'Permite al usuario responder un ticket'),
(6, 'Modificar Estado Ticket', 'Permite al usuario cambiar el estado de un ticket'),
(7, 'Modificar Visibilidad Ticket', 'Permite al usuario modificar la visibilidad de un ticket'),
(8, 'Remitir Ticket', 'Permite al usuario cambiar un ticket de departamento'),
(9, 'Enviar Ticket', 'Permite al usuario enviar un ticket'),
(10, 'Exportar Datos', 'Permite al usuario exportar los datos de la tabla tickets a un archivo CSV'),
(11, 'Ver Todos los Tickets', 'Permite al usuario ver todos los tickets en el sistema'),
(12, 'Cerrar Ticket', 'Permite al usuario cerrar un ticket. Un ticket cerrado no se podrá responder ni modificar');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `cod_region` bigint(20) NOT NULL,
  `nombre_region` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`cod_region`, `nombre_region`) VALUES
(11, 'Bío bío'),
(12, 'Los Ríos'),
(13, 'Los Lagos'),
(14, 'La Araucanía'),
(15, 'Arica y Parinacota'),
(16, 'Tarapacá'),
(17, 'Antofagasta'),
(18, 'Atacama'),
(19, 'Coquimbo'),
(20, 'Valparaíso'),
(21, 'Metropolitana'),
(22, 'Libertador General Bernardo O\'Higgins'),
(23, 'Maule'),
(24, 'Ñuble'),
(25, 'Aysén del General Carlos Ibáñez del Campo'),
(26, 'Magallanes y de la Antártica Chilena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_ticket`
--

CREATE TABLE `registro_ticket` (
  `cod_registro` bigint(11) NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cod_ticket` bigint(20) NOT NULL,
  `cod_departamento` bigint(20) NOT NULL,
  `rut_usuario` bigint(20) NOT NULL,
  `tipo_solicitud` enum('felicitacion','sugerencia','reclamo') NOT NULL,
  `cod_estado` bigint(20) NOT NULL,
  `asunto_ticket` varchar(50) NOT NULL,
  `detalles_solicitud` text NOT NULL,
  `fecha_hora_envio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `calificacion` float DEFAULT NULL,
  `visibilidad_solicitud` tinyint(1) NOT NULL,
  `cod_respuesta` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `registro_ticket`
--

INSERT INTO `registro_ticket` (`cod_registro`, `fecha_hora_registro`, `cod_ticket`, `cod_departamento`, `rut_usuario`, `tipo_solicitud`, `cod_estado`, `asunto_ticket`, `detalles_solicitud`, `fecha_hora_envio`, `calificacion`, `visibilidad_solicitud`, `cod_respuesta`) VALUES
(71, '2023-12-01 03:28:09', 40, 13, 19815448, 'reclamo', 0, 'reclamoo', 'esto es un reclamo', '2023-12-01 03:28:09', 0, 0, NULL),
(72, '2023-12-01 04:19:00', 40, 13, 19815448, 'reclamo', 0, 'reclamoo', 'esto es un reclamo', '2023-12-01 03:28:09', 0, 0, 35);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`cod_respuesta`, `cod_ticket`, `rut_usuario`, `detalles_respuesta`, `fecha_hora_envio`) VALUES
(35, 40, 123, 'esto es una respuesta de alguien que no solo puede responder tickets', '2023-12-01 04:19:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `cod_rol` bigint(20) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`cod_rol`, `nombre_rol`) VALUES
(1, 'admin'),
(2, 'usuario'),
(3, 'jefe de departamento'),
(4, 'inspector municipal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE `rol_permiso` (
  `cod_permiso` bigint(20) NOT NULL,
  `cod_rol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `rol_permiso`
--

INSERT INTO `rol_permiso` (`cod_permiso`, `cod_rol`) VALUES
(1, 4),
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(5, 3),
(11, 3),
(7, 3),
(8, 3),
(12, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion`
--

CREATE TABLE `suscripcion` (
  `cod_ticket` bigint(20) NOT NULL,
  `rut_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `cod_direccion` bigint(20) DEFAULT NULL,
  `fecha_hora_envio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `calificacion` float DEFAULT NULL,
  `visibilidad_solicitud` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`cod_ticket`, `cod_departamento`, `rut_usuario`, `tipo_solicitud`, `asunto_ticket`, `detalles_solicitud`, `cod_direccion`, `fecha_hora_envio`, `calificacion`, `visibilidad_solicitud`) VALUES
(40, 13, 19815448, 'reclamo', 'reclamoo', 'esto es un reclamo', NULL, '2023-12-01 03:28:09', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `rut_usuario` bigint(20) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `password_usuario` varchar(255) DEFAULT NULL,
  `correo_electronico_usuario` varchar(255) NOT NULL,
  `correo_electronico_tercero` varchar(255) DEFAULT NULL,
  `telefono_usuario` bigint(20) DEFAULT NULL,
  `telefono_tercero` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`rut_usuario`, `nombre_usuario`, `password_usuario`, `correo_electronico_usuario`, `correo_electronico_tercero`, `telefono_usuario`, `telefono_tercero`) VALUES
(1, 'prueba', '$2y$10$9eM2w16NZKdsfpYtTc.5MuJC8urjEr8vkQ6L7frdQ42mI0Zs678G2', 'q@we', '', 0, 0),
(2, 'poto', '$2y$10$7MAEeotXwSP0D9w4xLBgruezOmZhkubFe4dAG67oET0nOw.Y5P/gO', 'admin@poto', '', 0, 0),
(123, '123', '$2y$10$Q.JubWL6rQwzO0mSgN8Wj.7.AIl03nDZ7qvlbNB1pG7OGNTv9maDy', '123@123', '', 123, 0),
(666, 'pollo', '$2y$10$ep1RCzXLyD2Jq5XpqR9QTODr3CCUbf99kH5ChkG89K6fk59L0rOWO', 'pollo@pollo', '', 123, 0),
(1111, 'perkin', NULL, 'perkin@perkin.perkin', '', 123456789, 0),
(1234, 'admin', NULL, 'correo@gmail.com', '', 0, 0),
(999999, 'admin3', '$2y$10$L29sCC7oXCpPy2CBsMfmj.C0xN2M61PD3AQI085Kvs7etAO22HKqW', 'admin3@poto', '', 0, 0),
(19815448, 'jose', '$2y$10$ka0ywvvJzaVq1.UdJAcqwu2H6XGtIvDAqxP.i4GUkM/KgicH0ZEiW', 'jrivas@ing.ucsc.cl', '', 123456789, 0),
(20267690, 'juan baeza', NULL, 'juanBaeza@gmail.com', '', 0, 0),
(999999998, 'admin4', '$2y$10$fZ/FPAzJGgVgiV6hStqn..qIH1/SqLtPh2H2Df5Z4zHcnwQH8ywHa', 'admin4@poto', '', 0, 0),
(999999999, 'admin2', '$2y$10$6Kb3aNNKG332a9.klNhj7OyveCuDIz9Kz0HPWiPjeEeBGJCu0G2/W', 'poto@admin2', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `cod_rol` bigint(20) NOT NULL,
  `rut_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`cod_rol`, `rut_usuario`) VALUES
(1, 1234),
(2, 20267690),
(2, 1111),
(2, 1),
(1, 2),
(1, 999999999),
(1, 999999),
(1, 999999998),
(2, 666),
(2, 19815448),
(3, 123);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`cod_agenda`),
  ADD KEY `rut_usuario` (`rut_usuario`);

--
-- Indices de la tabla `calificacion_atencion`
--
ALTER TABLE `calificacion_atencion`
  ADD PRIMARY KEY (`cod_calificacion_atencion`),
  ADD KEY `cod_ticket` (`cod_ticket`);

--
-- Indices de la tabla `calificacion_sistema`
--
ALTER TABLE `calificacion_sistema`
  ADD PRIMARY KEY (`cod_calificacion_sistema`),
  ADD KEY `cod_ticket` (`cod_ticket`);

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
  ADD PRIMARY KEY (`cod_direccion`);

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
  ADD KEY `cod_comuna` (`cod_comuna`),
  ADD KEY `cod_direccion` (`cod_direccion`);

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
-- Indices de la tabla `registro_ticket`
--
ALTER TABLE `registro_ticket`
  ADD PRIMARY KEY (`cod_registro`),
  ADD KEY `cod_ticket` (`cod_ticket`),
  ADD KEY `cod_departamento` (`cod_departamento`),
  ADD KEY `cod_estado` (`cod_estado`),
  ADD KEY `cod_respuesta` (`cod_respuesta`);

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
  ADD KEY `rut_usuario` (`rut_usuario`),
  ADD KEY `cod_direccion` (`cod_direccion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`rut_usuario`);

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
-- AUTO_INCREMENT de la tabla `calificacion_atencion`
--
ALTER TABLE `calificacion_atencion`
  MODIFY `cod_calificacion_atencion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `calificacion_sistema`
--
ALTER TABLE `calificacion_sistema`
  MODIFY `cod_calificacion_sistema` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `cod_comuna` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `cod_departamento` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `cod_direccion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `cod_estado` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `municipalidad`
--
ALTER TABLE `municipalidad`
  MODIFY `cod_municipalidad` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `palabra_ofensiva`
--
ALTER TABLE `palabra_ofensiva`
  MODIFY `cod_palabra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `cod_permiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `cod_proyecto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `cod_region` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `registro_ticket`
--
ALTER TABLE `registro_ticket`
  MODIFY `cod_registro` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `cod_respuesta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `cod_rol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `cod_ticket` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `calificacion_atencion`
--
ALTER TABLE `calificacion_atencion`
  ADD CONSTRAINT `calificacion_atencion_ibfk_1` FOREIGN KEY (`cod_ticket`) REFERENCES `ticket` (`cod_ticket`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `calificacion_sistema`
--
ALTER TABLE `calificacion_sistema`
  ADD CONSTRAINT `calificacion_sistema_ibfk_1` FOREIGN KEY (`cod_ticket`) REFERENCES `ticket` (`cod_ticket`) ON UPDATE CASCADE;

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
-- Filtros para la tabla `estado_ticket`
--
ALTER TABLE `estado_ticket`
  ADD CONSTRAINT `estado_ticket_ibfk_1` FOREIGN KEY (`cod_estado`) REFERENCES `estado` (`cod_estado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estado_ticket_ibfk_2` FOREIGN KEY (`cod_ticket`) REFERENCES `ticket` (`cod_ticket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `municipalidad`
--
ALTER TABLE `municipalidad`
  ADD CONSTRAINT `municipalidad_ibfk_1` FOREIGN KEY (`cod_comuna`) REFERENCES `comuna` (`cod_comuna`) ON UPDATE CASCADE,
  ADD CONSTRAINT `municipalidad_ibfk_2` FOREIGN KEY (`cod_direccion`) REFERENCES `direccion` (`cod_direccion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `proyecto_ibfk_1` FOREIGN KEY (`cod_departamento`) REFERENCES `departamento` (`cod_departamento`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro_ticket`
--
ALTER TABLE `registro_ticket`
  ADD CONSTRAINT `registro_ticket_ibfk_1` FOREIGN KEY (`cod_ticket`) REFERENCES `ticket` (`cod_ticket`) ON UPDATE CASCADE,
  ADD CONSTRAINT `registro_ticket_ibfk_2` FOREIGN KEY (`cod_departamento`) REFERENCES `departamento` (`cod_departamento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `registro_ticket_ibfk_3` FOREIGN KEY (`cod_estado`) REFERENCES `estado` (`cod_estado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `registro_ticket_ibfk_4` FOREIGN KEY (`cod_respuesta`) REFERENCES `respuesta` (`cod_respuesta`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`rut_usuario`) REFERENCES `usuario` (`rut_usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`cod_direccion`) REFERENCES `direccion` (`cod_direccion`) ON UPDATE CASCADE;

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
