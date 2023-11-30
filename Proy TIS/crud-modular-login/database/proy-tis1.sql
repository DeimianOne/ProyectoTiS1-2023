-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2023 a las 23:58:02
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
(7, 39, 5, 'muy buena');

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
(11, 39, 5, 'muy buena');

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

--
-- Volcado de datos para la tabla `estado_ticket`
--

INSERT INTO `estado_ticket` (`cod_ticket`, `cod_estado`) VALUES
(39, 2),
(38, 2),
(37, 2),
(40, 1),
(41, 2),
(42, 16),
(43, 1),
(44, 0),
(45, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `municipalidad`
--

INSERT INTO `municipalidad` (`cod_municipalidad`, `nombre_municipalidad`, `cod_comuna`, `direccion_municipalidad`, `correo_municipalidad`) VALUES
(56, 'Municipalidad de Concepción', 13, 'Bernardo O`Higgins 525', 'asistenciasocialconcepcion@gmail.com');

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
(1, 'mierda'),
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

--
-- Volcado de datos para la tabla `registro_ticket`
--

INSERT INTO `registro_ticket` (`cod_registro`, `fecha_hora_registro`, `cod_ticket`, `cod_departamento`, `rut_usuario`, `tipo_solicitud`, `cod_estado`, `asunto_ticket`, `detalles_solicitud`, `fecha_hora_envio`, `calificacion`, `visibilidad_solicitud`, `cod_respuesta`) VALUES
(68, '2023-11-16 10:33:51', 37, 12, 19815448, 'reclamo', 0, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-16 10:33:51', 0, 0, NULL),
(69, '2023-11-16 10:37:43', 38, 10, 20267690, 'sugerencia', 0, 'CESFAM', 'Faltan mas CESFAM en Talcahuano', '2023-11-16 10:37:43', 0, 0, NULL),
(70, '2023-11-16 10:45:33', 37, 12, 19815448, 'reclamo', 1, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-16 10:33:51', 0, 0, 34),
(71, '2023-11-16 10:46:49', 37, 12, 19815448, 'reclamo', 1, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-16 10:46:49', 0, 1, NULL),
(72, '2023-11-16 10:49:10', 39, 10, 20267690, 'felicitacion', 0, 'Teatro Biobío', 'Buen trabajo con el teatro Biobío', '2023-11-16 10:49:10', 0, 0, NULL),
(73, '2023-11-16 10:53:48', 39, 10, 20267690, 'felicitacion', 2, 'Teatro Biobío', 'Buen trabajo con el teatro Biobío', '2023-11-16 10:49:10', 0, 0, 35),
(74, '2023-11-16 10:53:54', 39, 10, 20267690, 'felicitacion', 2, 'Teatro Biobío', 'Buen trabajo con el teatro Biobío', '2023-11-16 10:53:54', 0, 1, NULL),
(75, '2023-11-16 10:58:24', 40, 10, 20267690, 'reclamo', 0, 'Calle en mal estado', 'En Carrera con Pelantaro hay un pasaje en muy mal estado', '2023-11-16 10:58:24', 0, 0, NULL),
(76, '2023-11-16 11:01:53', 40, 12, 20267690, 'reclamo', 3, 'Calle en mal estado', 'En Carrera con Pelantaro hay un pasaje en muy mal estado', '2023-11-16 11:01:53', 0, 0, NULL),
(77, '2023-11-16 11:02:45', 40, 12, 20267690, 'reclamo', 3, 'Calle en mal estado', 'En Carrera con Pelantaro hay un pasaje en muy mal estado', '2023-11-16 11:01:53', 0, 0, 36),
(78, '2023-11-16 11:19:33', 37, 12, 19815448, 'reclamo', 2, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-16 10:46:49', 0, 1, 37),
(79, '2023-11-17 18:11:53', 41, 10, 19815448, 'felicitacion', 0, 'pichula bombero', ' sdkawdawd', '2023-11-17 18:11:53', 0, 0, NULL),
(80, '2023-11-18 01:53:00', 41, 10, 19815448, 'felicitacion', 0, 'pichula bombero', ' sdkawdawd', '2023-11-18 01:53:00', 0, 1, NULL),
(81, '2023-11-18 01:53:42', 41, 10, 19815448, 'felicitacion', 1, 'pichula bombero', ' sdkawdawd', '2023-11-18 01:53:00', 0, 1, 38),
(82, '2023-11-18 01:55:19', 41, 10, 19815448, 'felicitacion', 2, 'pichula bombero', ' sdkawdawd', '2023-11-18 01:53:00', 0, 1, 39),
(83, '2023-11-30 03:21:06', 37, 10, 19815448, 'reclamo', 3, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, NULL),
(84, '2023-11-30 03:50:07', 37, 10, 19815448, 'reclamo', 2, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, NULL),
(85, '2023-11-30 03:50:10', 37, 10, 19815448, 'reclamo', 1, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, NULL),
(86, '2023-11-30 03:51:31', 37, 10, 19815448, 'reclamo', 2, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, NULL),
(87, '2023-11-30 03:55:13', 40, 10, 20267690, 'reclamo', 2, 'Calle en mal estado', 'En Carrera con Pelantaro hay un pasaje en muy mal estado', '2023-11-30 03:55:13', 0, 0, NULL),
(88, '2023-11-30 03:55:59', 38, 12, 20267690, 'sugerencia', 2, 'CESFAM', 'Faltan mas CESFAM en Talcahuano', '2023-11-30 03:55:59', 0, 0, NULL),
(89, '2023-11-30 04:03:20', 37, 10, 19815448, 'reclamo', 0, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, NULL),
(90, '2023-11-30 04:03:27', 37, 10, 19815448, 'reclamo', 2, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, NULL),
(91, '2023-11-30 04:03:41', 37, 10, 19815448, 'reclamo', 1, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, NULL),
(92, '2023-11-30 04:03:48', 37, 10, 19815448, 'reclamo', 2, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, NULL),
(93, '2023-11-30 04:06:24', 37, 10, 19815448, 'reclamo', 1, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, NULL),
(94, '2023-11-30 04:07:55', 37, 10, 19815448, 'reclamo', 1, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, 40),
(95, '2023-11-30 04:08:12', 37, 10, 19815448, 'reclamo', 16, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, 41),
(96, '2023-11-30 04:11:14', 37, 10, 19815448, 'reclamo', 2, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, 42),
(97, '2023-11-30 04:11:36', 37, 10, 19815448, 'reclamo', 1, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, NULL),
(98, '2023-11-30 04:11:55', 37, 10, 19815448, 'reclamo', 2, 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', 0, 1, 43),
(99, '2023-11-30 04:16:42', 40, 10, 20267690, 'reclamo', 1, 'Calle en mal estado', 'En Carrera con Pelantaro hay un pasaje en muy mal estado', '2023-11-30 03:55:13', 0, 0, NULL),
(100, '2023-11-30 04:18:48', 40, 10, 20267690, 'reclamo', 2, 'Calle en mal estado', 'En Carrera con Pelantaro hay un pasaje en muy mal estado', '2023-11-30 03:55:13', 0, 0, 44),
(101, '2023-11-30 04:18:59', 40, 10, 20267690, 'reclamo', 1, 'Calle en mal estado', 'En Carrera con Pelantaro hay un pasaje en muy mal estado', '2023-11-30 03:55:13', 0, 0, NULL),
(102, '2023-11-30 04:21:27', 40, 10, 20267690, 'reclamo', 2, 'Calle en mal estado', 'En Carrera con Pelantaro hay un pasaje en muy mal estado', '2023-11-30 03:55:13', 0, 0, 45),
(103, '2023-11-30 04:22:29', 40, 12, 20267690, 'reclamo', 3, 'Calle en mal estado', 'En Carrera con Pelantaro hay un pasaje en muy mal estado', '2023-11-30 04:22:29', 0, 0, NULL),
(104, '2023-11-30 04:22:41', 40, 12, 20267690, 'reclamo', 2, 'Calle en mal estado', 'En Carrera con Pelantaro hay un pasaje en muy mal estado', '2023-11-30 04:22:29', 0, 0, NULL),
(105, '2023-11-30 04:27:25', 40, 12, 20267690, 'reclamo', 1, 'Calle en mal estado', 'En Carrera con Pelantaro hay un pasaje en muy mal estado', '2023-11-30 04:22:29', 0, 0, NULL),
(106, '2023-11-30 04:28:28', 41, 10, 19815448, 'felicitacion', 1, 'pichula bombero', ' sdkawdawd', '2023-11-18 01:53:00', 0, 1, NULL),
(107, '2023-11-30 04:29:01', 41, 10, 19815448, 'felicitacion', 2, 'pichula bombero', ' sdkawdawd', '2023-11-18 01:53:00', 0, 1, 46),
(108, '2023-11-30 04:51:20', 42, 12, 1234, 'reclamo', 0, 'reclamo y wea', 'este es mi reclamo', '2023-11-30 04:51:20', 0, 0, NULL),
(109, '2023-11-30 05:38:12', 42, 12, 1234, 'reclamo', 16, 'reclamo y wea', 'este es mi reclamo', '2023-11-30 04:51:20', 0, 0, 47),
(110, '2023-11-30 05:49:06', 42, 12, 1234, 'reclamo', 16, 'reclamo y wea', 'este es mi reclamo', '2023-11-30 04:51:20', 0, 0, 48),
(111, '2023-11-30 06:08:55', 43, 10, 19815448, 'reclamo', 0, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, NULL),
(112, '2023-11-30 06:13:19', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 49),
(113, '2023-11-30 06:17:23', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 50),
(114, '2023-11-30 06:22:26', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 51),
(115, '2023-11-30 06:23:55', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 52),
(116, '2023-11-30 06:28:22', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 53),
(117, '2023-11-30 06:29:46', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 54),
(118, '2023-11-30 06:30:01', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 55),
(119, '2023-11-30 06:31:58', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 56),
(120, '2023-11-30 06:34:50', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 57),
(121, '2023-11-30 06:37:01', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 58),
(122, '2023-11-30 06:42:28', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 59),
(123, '2023-11-30 06:43:09', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 60),
(124, '2023-11-30 06:45:39', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 61),
(125, '2023-11-30 06:46:51', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 62),
(126, '2023-11-30 06:49:01', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 63),
(127, '2023-11-30 06:55:34', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:08:55', 0, 0, 64),
(128, '2023-11-30 06:59:51', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:59:51', 0, 1, NULL),
(129, '2023-11-30 08:03:14', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:59:51', 0, 1, 65),
(130, '2023-11-30 08:05:22', 43, 10, 19815448, 'reclamo', 16, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:59:51', 0, 1, 66),
(131, '2023-11-30 08:26:47', 43, 10, 19815448, 'reclamo', 1, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:59:51', 0, 1, 67),
(132, '2023-11-30 08:33:04', 43, 10, 19815448, 'reclamo', 1, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:59:51', 0, 1, 68),
(133, '2023-11-30 08:35:41', 43, 10, 19815448, 'reclamo', 1, 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:59:51', 0, 1, 69),
(134, '2023-11-30 08:39:37', 44, 12, 19815448, 'sugerencia', 0, 'podrian hacer esto', 'jaja ayudaaaa', '2023-11-30 08:39:37', 0, 0, NULL),
(135, '2023-11-30 08:55:17', 44, 12, 19815448, 'sugerencia', 0, 'podrian hacer esto', 'jaja ayudaaaa', '2023-11-30 08:55:17', 0, 1, NULL),
(136, '2023-11-30 09:01:42', 44, 12, 19815448, 'sugerencia', 0, 'podrian hacer esto', 'jaja ayudaaaa', '2023-11-30 09:01:42', 0, 0, NULL),
(137, '2023-11-30 09:10:06', 44, 12, 19815448, 'sugerencia', 0, 'podrian hacer esto', 'jaja ayudaaaa', '2023-11-30 09:10:06', 0, 1, NULL),
(138, '2023-11-30 09:34:45', 44, 12, 19815448, 'sugerencia', 0, 'podrian hacer esto', 'jaja ayudaaaa', '2023-11-30 09:34:45', 0, 0, NULL),
(139, '2023-11-30 09:35:25', 44, 12, 19815448, 'sugerencia', 0, 'podrian hacer esto', 'jaja ayudaaaa', '2023-11-30 09:35:24', 0, 1, NULL),
(140, '2023-11-30 09:42:08', 44, 12, 19815448, 'sugerencia', 0, 'podrian hacer esto', 'jaja ayudaaaa', '2023-11-30 09:35:24', 0, 1, 70),
(141, '2023-11-30 22:37:44', 45, 12, 1111, 'felicitacion', 0, 'los felicito', 'felicito', '2023-11-30 22:37:44', 0, 0, NULL);

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
(34, 37, 1234, 'Estamos analizando su caso e informaremos a la Municipalidad', '2023-11-16 10:45:33'),
(35, 39, 1234, 'Muchas gracias por su retroalimentación!', '2023-11-16 10:53:48'),
(36, 40, 1234, 'Solicitud ha sido remitida al departamento de calles', '2023-11-16 11:02:45'),
(37, 37, 1234, 'Se ha reparado el alcantarillado', '2023-11-16 11:19:33'),
(38, 41, 1234, 'Analizaremos su caso', '2023-11-18 01:53:42'),
(39, 41, 1234, 'El caso ha sido solucionado', '2023-11-18 01:55:19'),
(40, 37, 1234, 'gsdrgsdr', '2023-11-30 04:07:55'),
(41, 37, 1234, 'gyjgyj', '2023-11-30 04:08:12'),
(42, 37, 1234, 'sfsef', '2023-11-30 04:11:14'),
(43, 37, 1234, 'calle en raparacion', '2023-11-30 04:11:55'),
(44, 40, 1234, 'hdthfth', '2023-11-30 04:18:48'),
(45, 40, 1234, 'jgyjgyjgy', '2023-11-30 04:21:27'),
(46, 41, 1234, 'hukhuk', '2023-11-30 04:29:01'),
(47, 42, 1234, 'ghdthfth', '2023-11-30 05:38:12'),
(48, 42, 1234, 'hkbuykugyk', '2023-11-30 05:49:06'),
(49, 43, 1234, 'wena', '2023-11-30 06:13:19'),
(50, 43, 1234, 'wenad', '2023-11-30 06:17:23'),
(51, 43, 1234, 'wena esto es una respuesta', '2023-11-30 06:22:26'),
(52, 43, 1234, 'wena esto es otra respuesta', '2023-11-30 06:23:55'),
(53, 43, 1234, 'jgyjgyjgyj', '2023-11-30 06:28:22'),
(54, 43, 1234, 'fsefsefsef', '2023-11-30 06:29:46'),
(55, 43, 1234, 'hfthfthfth', '2023-11-30 06:30:01'),
(56, 43, 1234, 'thyjgyjgygj', '2023-11-30 06:31:58'),
(57, 43, 1234, 'fcfycvfgycgy', '2023-11-30 06:34:50'),
(58, 43, 1234, 'fcfycvfgycgyfse', '2023-11-30 06:37:01'),
(59, 43, 1234, 'hfthfthfthfthfthfth', '2023-11-30 06:42:28'),
(60, 43, 1234, 'hfthfthfthfthfthftht6u', '2023-11-30 06:43:09'),
(61, 43, 1234, 'sfefsefsef', '2023-11-30 06:45:39'),
(62, 43, 1234, 'fsefsefsesfe', '2023-11-30 06:46:51'),
(63, 43, 1234, 'sfefsefsef', '2023-11-30 06:49:01'),
(64, 43, 1234, 'hthrthrth', '2023-11-30 06:55:34'),
(65, 43, 1234, 'dawdawdawda', '2023-11-30 08:03:14'),
(66, 43, 1234, 'dgdgdrgd', '2023-11-30 08:05:22'),
(67, 43, 1234, 'wena tula', '2023-11-30 08:26:47'),
(68, 43, 1234, 'fhfthfthfthfh', '2023-11-30 08:33:04'),
(69, 43, 1234, 'wenarduim', '2023-11-30 08:35:41'),
(70, 44, 1234, 'tula suprema', '2023-11-30 09:42:08');

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

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`cod_ticket`, `cod_departamento`, `rut_usuario`, `tipo_solicitud`, `asunto_ticket`, `detalles_solicitud`, `fecha_hora_envio`, `calificacion`, `visibilidad_solicitud`) VALUES
(37, 10, 19815448, 'reclamo', 'Inundación Tucapel Bajo', 'Las calles de Tucapel bajo se inundan cuando llueve', '2023-11-30 03:21:06', NULL, 1),
(38, 12, 20267690, 'sugerencia', 'CESFAM', 'Faltan mas CESFAM en Talcahuano', '2023-11-30 03:55:59', NULL, 0),
(39, 10, 20267690, 'felicitacion', 'Teatro Biobío', 'Buen trabajo con el teatro Biobío', '2023-11-16 10:53:54', NULL, 1),
(40, 12, 20267690, 'reclamo', 'Calle en mal estado', 'En Carrera con Pelantaro hay un pasaje en muy mal estado', '2023-11-30 04:22:29', NULL, 0),
(41, 10, 19815448, 'felicitacion', 'pichula bombero', ' sdkawdawd', '2023-11-18 01:53:00', NULL, 1),
(42, 12, 1234, 'reclamo', 'reclamo y wea', 'este es mi reclamo', '2023-11-30 04:51:20', NULL, 0),
(43, 10, 19815448, 'reclamo', 'oye tengo un reclamo', 'chaa oe tengo un reclamo', '2023-11-30 06:59:51', NULL, 1),
(44, 12, 19815448, 'sugerencia', 'podrian hacer esto', 'jaja ayudaaaa', '2023-11-30 09:35:24', NULL, 1),
(45, 12, 1111, 'felicitacion', 'los felicito', 'felicito', '2023-11-30 22:37:44', NULL, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`rut_usuario`, `nombre_usuario`, `correo_electronico_usuario`, `correo_electronico_tercero`, `telefono_usuario`, `telefono_tercero`) VALUES
(1111, 'ciudadano', 'josephriv98@gmail.com', '', 12345678, 0),
(1234, 'admin', 'correo@gmail.com', '', 0, 0),
(19815448, 'jose rivas', 'jrivas@ing.ucsc.cl', '', 966737620, 0),
(20267690, 'juan baeza', 'juanBaeza@gmail.com', '', 0, 0);

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
(2, 19815448);

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
  MODIFY `cod_municipalidad` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
  MODIFY `cod_registro` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `cod_respuesta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `cod_rol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `cod_ticket` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
