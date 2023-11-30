-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2023 a las 23:57:54
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

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

--
-- Volcado de datos para la tabla `calificacion_atencion`
--

INSERT INTO `calificacion_atencion` (`cod_calificacion_atencion`, `cod_ticket`, `calificacion_atencion`, `comentario_atencion`) VALUES
(1, 34, 5, 'asdasd'),
(2, 32, 5, ''),
(3, 33, 0, ''),
(4, 33, 0, ''),
(5, 30, 4, 'ertaerterg'),
(6, 31, 2, 'qwe'),
(7, 36, 4, '');

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

--
-- Volcado de datos para la tabla `calificacion_sistema`
--

INSERT INTO `calificacion_sistema` (`cod_calificacion_sistema`, `cod_ticket`, `calificacion_sistema`, `comentario_sistema`) VALUES
(1, 34, 2, 'asdqwe'),
(2, 32, 5, 'holis muy bien'),
(3, 34, 3, 'asdasdqwe'),
(4, 32, 0, ''),
(5, 34, 0, ''),
(6, 32, 4, ''),
(7, 33, 5, 'asdad'),
(8, 30, 3, 'asd'),
(9, 35, 5, 'muy bien'),
(10, 31, 0, ''),
(11, 36, 4, '');

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
(15, 12, 'Valdivia'),
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
(10, 56, 'Departamento de obras', 407012, 1, '09:30:00', '14:00:00'),
(12, 56, 'Departamento de calles', 23462346, 0, '00:00:00', '00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`cod_direccion`, `cod_comuna`, `calle`, `numero`, `numero_departamento`) VALUES
(14, 13, 'Bernardo O`Higgins', 525, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado_departamento`
--

CREATE TABLE `encargado_departamento` (
  `cod_departamento` bigint(20) NOT NULL,
  `rut_usuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(16, 'Calle en Reparación', 'Estado para indicar que una calle esta en reparación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_ticket`
--

CREATE TABLE `estado_ticket` (
  `cod_ticket` bigint(20) NOT NULL,
  `cod_estado` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipalidad`
--

CREATE TABLE `municipalidad` (
  `cod_municipalidad` bigint(20) NOT NULL,
  `nombre_municipalidad` varchar(50) NOT NULL,
  `cod_comuna` bigint(20) NOT NULL,
  `direccion_municipalidad` varchar(255) DEFAULT NULL,
  `latitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  `correo_municipalidad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `municipalidad`
--

INSERT INTO `municipalidad` (`cod_municipalidad`, `nombre_municipalidad`, `cod_comuna`, `direccion_municipalidad`, `latitud`, `longitud`, `correo_municipalidad`) VALUES
(56, 'Municipalidad de Concepción', 13, 'Bernardo O`Higgins 525', NULL, NULL, 'asistenciasocialconcepcion@gmail.com'),
(60, 'Hola que pasa', 13, 'Braulio Arenas Carvajal 8114', -36.8963, -73.1337, 'poroto@porots.com'),
(61, 'callbackNuevo', 13, 'Braulio Arenas Carvajal 8114', -36.8963, -73.1337, 'ojala@funcione'),
(62, 'Municipalidad de Santiago', 17, 'Amunategui 980', -33.4329, -70.6577, 'mun@stgo'),
(63, 'comprobacion', 16, 'San Felipe 80, puerto montt, Chile', -41.472, -72.9371, 'mun@ptomont'),
(64, 'holax', 13, '', -14.7431, -56.7434, 'brzil@xd'),
(65, 'testcalle', 13, 'Calle Braulio Arenas Carvajal, San Pedro de la Paz, Chile', -36.8947, -73.1332, 'xxd@xd'),
(66, 'poroto', 13, 'Calle Braulio Arenas Carvajal, San Pedro de la Paz, Chile', -36.8947, -73.1332, 'qweqw@asd'),
(67, 'ElDemian', 13, 'Orompello, Concepción, Chile', -36.8191, -73.048, 'demian@one');

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
(8, 'Responder Tickets', 'Permite al usuario responder tickets y cambiar su estado');

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

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`cod_proyecto`, `cod_departamento`, `nombre_proyecto`, `descripcion_proyecto`, `fecha_inicio_proyecto`, `fecha_termino_estimada_proyecto`) VALUES
(7, 10, 'Construcción de Plaza', 'Plaza en San Pedro', '2023-11-16', '2023-11-28');

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
(14, 'La Araucanía');

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
(4, 'inspector municipal'),
(16, 'trabajador de departamento');

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
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(8, 1),
(1, 4),
(1, 16);

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
  `fecha_hora_envio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `calificacion` float DEFAULT NULL,
  `visibilidad_solicitud` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(666, 'pollo', '$2y$10$ep1RCzXLyD2Jq5XpqR9QTODr3CCUbf99kH5ChkG89K6fk59L0rOWO', 'pollo@pollo', '', 123, 0),
(1111, 'perkin', NULL, 'perkin@perkin.perkin', '', 123456789, 0),
(1234, 'admin', NULL, 'correo@gmail.com', '', 0, 0),
(999999, 'admin3', '$2y$10$L29sCC7oXCpPy2CBsMfmj.C0xN2M61PD3AQI085Kvs7etAO22HKqW', 'admin3@poto', '', 0, 0),
(20267690, 'juan baeza', NULL, 'juanBaeza@gmail.com', '', 0, 0),
(999999998, 'admin4', '$2y$10$fZ/FPAzJGgVgiV6hStqn..qIH1/SqLtPh2H2Df5Z4zHcnwQH8ywHa', 'admin4@poto', '', 0, 0),
(999999999, 'admin2', '$2y$10$6Kb3aNNKG332a9.klNhj7OyveCuDIz9Kz0HPWiPjeEeBGJCu0G2/W', 'poto@admin2', '', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_direccion`
--

CREATE TABLE `usuario_direccion` (
  `rut_usuario` bigint(20) NOT NULL,
  `cod_direccion` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(2, 666);

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
-- AUTO_INCREMENT de la tabla `calificacion_atencion`
--
ALTER TABLE `calificacion_atencion`
  MODIFY `cod_calificacion_atencion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `calificacion_sistema`
--
ALTER TABLE `calificacion_sistema`
  MODIFY `cod_calificacion_sistema` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `cod_comuna` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `cod_departamento` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `cod_direccion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `cod_estado` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `municipalidad`
--
ALTER TABLE `municipalidad`
  MODIFY `cod_municipalidad` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `palabra_ofensiva`
--
ALTER TABLE `palabra_ofensiva`
  MODIFY `cod_palabra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `cod_permiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `cod_proyecto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `cod_region` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `registro_ticket`
--
ALTER TABLE `registro_ticket`
  MODIFY `cod_registro` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `cod_respuesta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `cod_rol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `cod_ticket` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  ADD CONSTRAINT `estado_ticket_ibfk_2` FOREIGN KEY (`cod_ticket`) REFERENCES `ticket` (`cod_ticket`) ON DELETE CASCADE ON UPDATE CASCADE;

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
