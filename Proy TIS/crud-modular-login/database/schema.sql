-- Crear la base de datos "repuestos" con cotejamiento utf8_spanish_ci
CREATE DATABASE IF NOT EXISTS repuestos CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;

-- Usar la base de datos "repuestos"
USE repuestos;

-- Crear la tabla "marcas"
CREATE TABLE IF NOT EXISTS marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    origen ENUM('Francia', 'China', 'Japón') NOT NULL,
    logo VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Ejemplo de cómo insertar datos en la tabla
INSERT INTO marcas (nombre, origen, logo) VALUES
('Marca1', 'Francia', 'logo1.png'),
('Marca2', 'China', 'logo2.png'),
('Marca3', 'Japón', 'logo3.png');

-- Crear la tabla "users"
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  trn_date DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
