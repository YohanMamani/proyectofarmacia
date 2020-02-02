-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2018 a las 09:06:17
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletas`
--

CREATE TABLE `boletas` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `boletas`
--

INSERT INTO `boletas` (`id`, `id_venta`, `fecha`) VALUES
(1, 1, '2018-10-31 00:31:07'),
(4, 1, '2018-11-04 11:00:12'),
(5, 1, '2018-11-04 11:12:00'),
(6, 1, '2018-11-04 11:28:33'),
(7, 1, '2018-11-04 11:28:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `dni` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `puntos` int(11) NOT NULL,
  `compras_realizadas` int(11) NOT NULL DEFAULT '0',
  `ultima_compra` date NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `dni`, `nombre`, `puntos`, `compras_realizadas`, `ultima_compra`, `fecha_registro`) VALUES
(2, '7635396', 'Kristel Leon Bravo', 88, 3, '2018-11-07', '2018-11-07 07:52:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `excel`
--

CREATE TABLE `excel` (
  `Codigo` varchar(6) DEFAULT NULL,
  `Descripcion` tinytext,
  `Juego` varchar(100) DEFAULT NULL,
  `Precio` float DEFAULT NULL,
  `Costo` float DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `ValorPuntos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `excel`
--

INSERT INTO `excel` (`Codigo`, `Descripcion`, `Juego`, `Precio`, `Costo`, `Cantidad`, `ValorPuntos`) VALUES
('1BS512', 'Structure Deck Power Encode ', 'DBZ', 40, 25, 10, 2000),
('1CF562', 'Structure Deck Wave of Light', 'YuGiOh', 35, 20, 15, 1750),
('2DF124', 'Starter Deck Code Break', 'YuGiOh', 40, 25, 12, 2000),
('3TY145', 'Dragon Ball Super TCG', 'DBZ', 50, 30, 10, 2500),
('4SD785', 'Booster Pack Set 2 Union Force', 'YuGiOh', 13, 5, 25, 650),
('5JK456', 'Combo Pokemon TCG', 'Pokemon', 85, 50, 15, 4250),
('6IO154', 'Booster Pack Set 1 Galactic Battle', 'YuGiOh', 13, 5, 25, 650),
('7KL415', 'Legendary Hero Decks', 'YuGiOh', 120, 60, 15, 6000),
('8HN158', 'Planeswalker Deck', 'Magi', 60, 30, 40, 3000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id` int(11) NOT NULL,
  `juego` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id`, `juego`, `fecha`) VALUES
(1, 'YuGiOh', '2018-10-09 21:23:40'),
(2, 'Magi', '2018-10-09 21:23:51'),
(4, 'Pokemon', '2018-10-09 21:24:26'),
(7, 'DBS', '2018-10-17 15:07:09'),
(8, 'DBZ', '2018-10-21 19:16:58'),
(9, 'DIGIMON', '2018-10-29 12:00:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_juego` int(11) NOT NULL,
  `codigo` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `valor_puntos` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_juego`, `codigo`, `descripcion`, `stock`, `precio_compra`, `precio_venta`, `valor_puntos`, `fecha`) VALUES
(1, 8, '1BS512', 'Structure Deck Power Encode ', 10, 25, 40, 2000, '2018-10-29 11:44:59'),
(2, 1, '1CF562', 'Structure Deck Wave of Light', 15, 20, 35, 1750, '2018-10-29 11:44:59'),
(3, 1, '2DF124', 'Starter Deck Code Break', 12, 25, 40, 2000, '2018-10-29 11:44:59'),
(4, 8, '3TY145', 'Dragon Ball Super TCG', 10, 30, 50, 2500, '2018-10-29 11:44:59'),
(5, 1, '4SD785', 'Booster Pack Set 2 Union Force', 24, 5, 13, 650, '2018-11-07 07:52:04'),
(6, 4, '5JK456', 'Combo Pokemon TCG', 15, 50, 85, 4250, '2018-10-29 11:44:59'),
(7, 1, '6IO154', 'Booster Pack Set 1 Galactic Battle', 25, 5, 13, 650, '2018-10-29 11:44:59'),
(8, 1, '7KL415', 'Legendary Hero Decks', 15, 60, 120, 6000, '2018-10-29 11:44:59'),
(9, 2, '8HN158', 'Planeswalker Deck', 40, 40, 80, 2000, '2018-10-29 12:28:15'),
(18, 1, '1GY522', 'Deck Destiny Hero', 20, 25, 30, 2000, '2018-10-29 12:40:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dni` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `contraseña` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `turno` text COLLATE utf8_spanish_ci NOT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre`, `usuario`, `contraseña`, `perfil`, `estado`, `turno`, `ultimo_login`, `fecha`) VALUES
(70485303, 'Santiago Gean Paul Acevedo Serrano', 'admin', 'admin', 'Administrador', 1, 'Mañana', NULL, '2018-10-09 20:20:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `dni_cli` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `dni_cli`, `id_vendedor`, `productos`, `total`, `metodo_pago`, `fecha`) VALUES
(1, 10001, 2, 70485303, '[{\"id\":\"1\",\"descripcion\":\"Structure Deck Power Encode \",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"40\",\"total\":\"40\"},{\"id\":\"2\",\"descripcion\":\"Structure Deck Wave of Light\",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"35\",\"total\":\"35\"}]', 75, 'Efectivo', '2018-10-30 22:34:16'),
(2, 10002, 2, 70485303, '[{\"id\":\"5\",\"descripcion\":\"Booster Pack Set 2 Union Force\",\"cantidad\":\"1\",\"stock\":\"24\",\"precio\":\"13\",\"total\":\"13\"}]', 13, 'Efectivo', '2018-11-07 07:52:04');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boletas`
--
ALTER TABLE `boletas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_constraint` (`juego`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_p_c` (`codigo`),
  ADD KEY `fk_juego` (`id_juego`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dni_cli` (`dni_cli`),
  ADD KEY `id_vendedor` (`id_vendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boletas`
--
ALTER TABLE `boletas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boletas`
--
ALTER TABLE `boletas`
  ADD CONSTRAINT `boletas_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_juego` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`dni`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`dni_cli`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
