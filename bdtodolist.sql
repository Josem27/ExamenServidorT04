-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-03-2024 a las 19:14:59
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdtodolist`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(4, 'Ejemplo'),
(7, 'Importante'),
(9, 'Diario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `usuario` varchar(24) NOT NULL,
  `operacion` varchar(24) NOT NULL,
  `fecha` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`usuario`, `operacion`, `fecha`) VALUES
('Admin', 'Entrada', '2024-02-27 13:59:03.550145'),
('Admin', 'Eliminar', '2024-02-27 13:59:11.625445'),
('Admin', 'Entrada', '2024-03-07 18:43:36.556638'),
('Admin', 'Edicion', '2024-03-07 18:47:24.596055'),
('Admin', 'Eliminar', '2024-03-07 18:47:27.553458'),
('Admin', 'Eliminar', '2024-03-07 18:47:59.209059'),
('Admin', 'Eliminar', '2024-03-07 18:50:02.705685'),
('Admin', 'Eliminar', '2024-03-07 18:50:08.019904'),
('Admin', 'Entrada', '2024-03-07 18:51:12.684462'),
('Admin', 'Entrada', '2024-03-07 18:51:45.162409'),
('Admin', 'Entrada', '2024-03-07 18:51:53.799547'),
('Admin', 'Edicion', '2024-03-07 18:58:27.032188'),
('Admin', 'Entrada', '2024-03-07 19:06:27.808627'),
('Admin', 'Eliminar', '2024-03-07 19:07:11.432022'),
('Admin', 'Eliminar', '2024-03-07 19:07:16.424779'),
('Admin', 'Eliminar', '2024-03-07 19:07:21.187418');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

DROP TABLE IF EXISTS `tareas`;
CREATE TABLE IF NOT EXISTS `tareas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `categoria_id` int NOT NULL,
  `titulo` varchar(32) NOT NULL,
  `imagen` varchar(45) DEFAULT NULL,
  `descripcion` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fecha` varchar(16) NOT NULL,
  `hora` time NOT NULL,
  `prioridad` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `usuario_id`, `categoria_id`, `titulo`, `imagen`, `descripcion`, `fecha`, `hora`, `prioridad`) VALUES
(4, 1, 4, 'Ejemplo 1', '1709837907-img1.1.png', '<p>ejemplo</p>\r\n', '07/03/2024', '00:00:00', 1),
(7, 1, 7, 'Ultimo test', NULL, '<p>adawd</p>\r\n', '07/03/2024', '00:00:00', 2),
(9, 1, 9, 'Dia', NULL, '<p>adawd</p>\r\n', '07/03/2024', '00:00:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nick` varchar(32) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `apellidos` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(48) NOT NULL,
  `imagen-avatar` varchar(32) NOT NULL,
  `tipo` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nick`, `nombre`, `apellidos`, `email`, `password`, `imagen-avatar`, `tipo`) VALUES
(1, 'Admin', 'Josema', 'Cruz', 'admin@test.com', 'admin', '', 1),
(2, 'user', 'user', 'user', 'user@user.com', 'user', '', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
