-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2024 a las 20:00:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `elefanteazul`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `entrada` datetime NOT NULL,
  `salida` datetime NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `coche` varchar(50) NOT NULL,
  `matricula` varchar(7) NOT NULL,
  `tipo_lavado` varchar(30) NOT NULL,
  `llantas` int(1) NOT NULL,
  `precio` double NOT NULL,
  `id` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`entrada`, `salida`, `nombre`, `telefono`, `coche`, `matricula`, `tipo_lavado`, `llantas`, `precio`, `id`) VALUES
('2028-09-14 16:00:00', '2028-09-14 17:00:00', 'laura', '638385004', 'ford focus', '5555lop', '1', 0, 40, '25459abc6a8e73b46585a37066eb0506fc91'),
('2028-09-14 15:30:00', '2028-09-14 16:30:00', 'laura', '638385004', 'ford focus', '5555lop', '1', 0, 40, '49b3f96019673c45d85d8d06cbc90b04d8d9'),
('2024-02-14 16:00:00', '2024-02-14 16:20:00', 'Prueba', '633338128', 'Auto Load', '1245dcd', '2', 0, 10, 'eb700552871d1308ea1013980609337b9ded'),
('2025-12-13 11:30:00', '2025-12-13 12:45:00', 'laura', '638385004', 'renult focus', '4444rty', '1', 15, 55, 'f12fe47d1e1cb9f808eee1ea65c8b1488cb9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_lavado`
--

CREATE TABLE `tipo_lavado` (
  `descripcion` varchar(30) NOT NULL,
  `precio` double NOT NULL,
  `tiempo` int(2) NOT NULL,
  `id` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_lavado`
--

INSERT INTO `tipo_lavado` (`descripcion`, `precio`, `tiempo`, `id`) VALUES
('Premium', 40, 60, '1'),
('Básico', 10, 20, '2'),
('Completo', 20, 40, '3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_lavado`
--
ALTER TABLE `tipo_lavado`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
