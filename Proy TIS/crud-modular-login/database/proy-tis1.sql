SET NAMES 'utf8';

CREATE DATABASE `proy-tis1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `proy-tis1`;

CREATE TABLE calificacion (
    cod_calificacion BIGINT NOT NULL,
    rut_usuario BIGINT NOT NULL,
    calificacion SMALLINT NOT NULL,
    comentario VARCHAR(500)
);

CREATE TABLE comuna (
    cod_comuna BIGINT NOT NULL,
    cod_region BIGINT NOT NULL,
    nombre_comuna VARCHAR(50) NOT NULL
);

CREATE TABLE departamento (
    cod_departamento BIGINT NOT NULL,
    cod_municipalidad BIGINT NOT NULL,
    nombre_departamento VARCHAR(50) NOT NULL,
    telefono_departamento BIGINT NOT NULL
);

CREATE TABLE direccion (
    rut_usuario BIGINT NOT NULL,
    cod_direccion BIGINT NOT NULL,
    cod_comuna BIGINT NOT NULL,
    calle VARCHAR(255) NOT NULL,
    numero SMALLINT NOT NULL,
    numero_departamento SMALLINT
);

CREATE TABLE encargado_departamento (
    cod_departamento BIGINT NOT NULL,
    rut_usuario BIGINT NOT NULL
);

CREATE TABLE municipalidad (
    cod_municipalidad BIGINT NOT NULL,
    cod_comuna BIGINT NOT NULL,
    direccion_municipalidad VARCHAR(255) NOT NULL,
    correo_municipalidad VARCHAR(255) NOT NULL
);

CREATE TABLE permiso (
    cod_permiso BIGINT NOT NULL,
    nombre_permiso VARCHAR(30) NOT NULL,
    descripcion_permiso VARCHAR(50)
);

CREATE TABLE proyecto (
    cod_proyecto BIGINT NOT NULL,
    cod_departamento BIGINT NOT NULL,
    nombre_proyecto VARCHAR(50) NOT NULL,
    descripcion_proyecto VARCHAR(500) NOT NULL,
    fecha_inicio_proyecto DATE,
    fecha_termino_estimada_proyecto DATE
);

CREATE TABLE region (
    cod_region BIGINT NOT NULL,
    nombre_region VARCHAR(50) NOT NULL
);

CREATE TABLE respuesta (
    cod_respuesta BIGINT NOT NULL,
    cod_ticket BIGINT NOT NULL,
    rut_usuario BIGINT NOT NULL,
    detalles_respuesta TEXT NOT NULL,
    fecha_hora_envio_respuesta TIMESTAMP
);

CREATE TABLE rol (
    cod_rol BIGINT NOT NULL,
    nombre_rol VARCHAR(30) NOT NULL
);

CREATE TABLE rol_permiso (
    cod_permiso BIGINT NOT NULL,
    cod_rol BIGINT NOT NULL
);

CREATE TABLE suscripcion (
    cod_ticket BIGINT NOT NULL,
    rut_usuario BIGINT NOT NULL
);

CREATE TABLE ticket (
    cod_ticket INT NOT NULL AUTO_INCREMENT,
    cod_departamento BIGINT NOT NULL,
    rut_usuario BIGINT NOT NULL,
    tipo_solicitud VARCHAR(255),
    detalles_solicitud TEXT,
    estado_solicitud VARCHAR(255),
    visibilidad_solicitud BOOLEAN,
    fecha_hora_envio_ticket TIMESTAMP,
    PRIMARY KEY (cod_ticket)
);

CREATE TABLE usuario (
    rut_usuario BIGINT NOT NULL,
    nombre_usuario VARCHAR(255) NOT NULL,
    correo_electronico_usuario VARCHAR(255) NOT NULL,
    correo_electronico_tercero VARCHAR(255),
    telefono_usuario BIGINT,
    telefono_tercero BIGINT,
    cod_direccion BIGINT
);

CREATE TABLE usuario_rol (
    cod_rol BIGINT NOT NULL,
    rut_usuario BIGINT NOT NULL
);