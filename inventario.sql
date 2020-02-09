-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-07-2019 a las 17:43:05
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

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
(1, 1, '2018-12-29 18:25:40'),
(2, 1, '2018-12-29 18:26:13'),
(3, 1, '2018-12-30 03:32:27'),
(4, 1, '2018-12-31 02:47:59'),
(5, 1, '2018-12-31 04:20:49'),
(6, 3, '2018-12-31 23:56:22'),
(7, 4, '2019-01-01 00:06:54'),
(8, 5, '2019-01-03 07:15:44'),
(9, 5, '2019-01-03 07:15:55'),
(10, 5, '2019-01-03 21:04:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `dni` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `correo` text COLLATE utf8_spanish_ci NOT NULL,
  `distrito` text COLLATE utf8_spanish_ci NOT NULL,
  `juego_interes` text COLLATE utf8_spanish_ci NOT NULL,
  `puntos` int(11) NOT NULL,
  `compras_realizadas` int(11) NOT NULL DEFAULT '0',
  `ultima_compra` date NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `dni`, `nombre`, `telefono`, `correo`, `distrito`, `juego_interes`, `puntos`, `compras_realizadas`, `ultima_compra`, `fecha_registro`) VALUES
(1, '12345678', 'Anonimo', '', '', '', '', 150, 7, '2019-04-30', '2019-04-30 20:04:29'),
(2, '70485202', 'Luis Gonzales', '995520635', 'luis@gmail.com', 'San Juan de Miraflores', 'YuGiOH', 23, 1, '2019-04-30', '2019-04-30 20:18:39'),
(3, '70485385', 'Manuel Guillen', '946551587', 'manuel1@gmail.com', 'El Agustino', 'MAGI', 40, 1, '2019-04-30', '2019-04-30 19:58:55'),
(4, '85625452', 'Jean Flores', '945632563', 'jean@gmail.com', 'El Rimac', 'Pokemon', 55, 3, '2019-04-30', '2019-04-30 19:55:46');

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
  `Cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `excel`
--

INSERT INTO `excel` (`Codigo`, `Descripcion`, `Juego`, `Precio`, `Costo`, `Cantidad`) VALUES
('1BS512', 'Structure Deck Power Encode ', 'DBZ', 40, 25, 10),
('1CF562', 'Structure Deck Wave of Light', 'YuGiOh', 35, 20, 15),
('2DF124', 'Starter Deck Code Break', 'YuGiOh', 40, 25, 12),
('3TY145', 'Dragon Ball Super TCG', 'DBZ', 50, 30, 10),
('4SD785', 'Booster Pack Set 2 Union Force', 'YuGiOh', 13, 5, 25),
('5JK456', 'Combo Pokemon TCG', 'Pokemon', 85, 50, 15),
('6IO154', 'Booster Pack Set 1 Galactic Battle', 'YuGiOh', 13, 5, 25),
('7KL415', 'Legendary Hero Decks', 'YuGiOh', 120, 60, 15),
('8HN158', 'Planeswalker Deck', 'Magi', 60, 30, 40),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0),
('', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finanzas`
--

CREATE TABLE `finanzas` (
  `id` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `egreso` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `finanzas`
--

INSERT INTO `finanzas` (`id`, `descripcion`, `egreso`, `fecha`) VALUES
(1, 'lunas', 10, '2018-12-31 05:35:03');

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
(1, 'YuGiOH', '2019-01-03 06:04:31'),
(2, 'DBZ', '2019-01-02 00:56:30'),
(3, 'Pokemon', '2019-01-02 00:56:30'),
(4, 'Magi', '2019-01-02 00:56:30'),
(5, 'Warcraft3', '2019-01-03 05:59:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_juego` int(11) NOT NULL,
  `codigo` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_maximo` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_juego`, `codigo`, `descripcion`,`stock_minimo`, `stock`,`stock_maximo`, `precio_compra`, `precio_venta`, `fecha`) VALUES
(1, 1, 'SD4525', 'Deck Destiny Hero',5, 7, 50 , 12, 15, '2018-12-31 04:33:26'),
(2, 1, '1GY175', 'Deck Hero Storm GH',5, 9, 40, 11, 15, '2019-04-30 20:04:29'),
(3, 1, '1HJ159', 'ULTRADECK JOEY', 5,11, 60,20, 30, '2019-04-30 19:56:19'),
(4, 1, '1YU555', 'Deck Destiny Hero',5, 6,50, 20, 30, '2018-12-31 23:56:11'),
(6, 1, '1YU558', 'ULTRADECK YUGI',5, 23,60, 25, 35, '2019-01-02 05:47:07'),
(7, 2, '1BS512', 'Structure Deck Power Encode ',5, 9,70, 25, 40, '2019-04-30 19:58:55'),
(23, 1, '1CF562', 'Structure Deck Wave of Light',5,15,50, 20, 35, '2019-01-02 01:05:41'),
(24, 1, '2DF124', 'Starter Deck Code Break',5,12,80, 25, 40, '2019-01-02 01:05:41'),
(25, 2, '3TY145', 'Dragon Ball Super TCG',5,10,50, 30, 50, '2019-01-02 01:05:41'),
(26, 1, '4SD785', 'Booster Pack Set 2 Union Force',5, 25,70, 5, 13, '2019-01-02 01:05:41'),
(27, 3, '5JK456', 'Combo Pokemon TCG',5, 15,50, 50, 85, '2019-01-02 01:05:41'),
(28, 1, '6IO154', 'Booster Pack Set 1 Galactic Battle',5, 25,80, 5, 13, '2019-01-02 01:05:41'),
(29, 1, '7KL415', 'Legendary Hero Decks',5, 15,70, 60, 120, '2019-01-02 01:05:41'),
(30, 4, '8HN158', 'Planeswalker Deck',5, 40,80, 30, 60, '2019-01-02 01:05:41'),
(31, 1, 'SD45GH', 'ludo',5,22,70, 12, 23, '2019-04-30 20:18:39');

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
  `estado` int(11) NOT NULL DEFAULT '0',
  `turno` text COLLATE utf8_spanish_ci NOT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `nombre`, `usuario`, `contraseña`, `perfil`, `estado`, `turno`, `ultimo_login`, `fecha`, `foto`) VALUES
(70485212, 'Christian Romero', 'romero', 'romero', 'Vendedor', 1, 'Tarde', '2019-04-30 15:16:10', '2019-04-30 20:16:10', ''),
(70485303, 'Santiago Gean Paul Acevedo Serrano', 'admin', 'admin', 'Administrador', 1, 'Mañana', '2019-07-15 10:38:45', '2019-07-15 15:38:45', 'vistas/img/usuarios/admin/253.png'),
(85632654, 'Marco Rojas', 'marco', 'marco', 'Vendedor', 0, 'Mañana', NULL, '2019-01-02 06:02:42', '');

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
  `descuento` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `codigo`, `dni_cli`, `id_vendedor`, `productos`, `descuento`, `total`, `metodo_pago`, `fecha`) VALUES
(1, 10001, 1, 70485303, '[{\"id\":\"1\",\"descripcion\":\"Deck Destiny Hero\",\"cantidad\":\"2\",\"stock\":\"8\",\"precio\":\"15\",\"total\":\"30\"}]', 0, 30, 'Efectivo', '2018-12-29 18:26:09'),
(2, 10002, 1, 70485303, '[{\"id\":\"1\",\"descripcion\":\"Deck Destiny Hero\",\"cantidad\":\"1\",\"stock\":\"7\",\"precio\":\"15\",\"total\":\"15\"}]', 0, 15, 'Efectivo', '2018-12-31 04:33:27'),
(3, 10003, 1, 70485303, '[{\"id\":\"3\",\"descripcion\":\"ULTRADECK JOEY\",\"cantidad\":\"1\",\"stock\":\"14\",\"precio\":\"30\",\"total\":\"30\"},{\"id\":\"4\",\"descripcion\":\"Deck Destiny Hero\",\"cantidad\":\"1\",\"stock\":\"4\",\"precio\":\"30\",\"total\":\"30\"}]', 0, 60, 'Efectivo', '2018-12-31 23:56:11'),
(4, 10004, 1, 70485303, '[{\"id\":\"6\",\"descripcion\":\"ULTRADECK YUGI\",\"cantidad\":\"1\",\"stock\":\"24\",\"precio\":\"35\",\"total\":\"35\"}]', 10, 25, 'Efectivo', '2019-01-01 00:06:49'),
(5, 10005, 4, 70485303, '[{\"id\":\"3\",\"descripcion\":\"ULTRADECK JOEY\",\"cantidad\":\"1\",\"stock\":\"13\",\"precio\":\"30\",\"total\":\"30\"},{\"id\":\"6\",\"descripcion\":\"ULTRADECK YUGI\",\"cantidad\":\"1\",\"stock\":\"23\",\"precio\":\"35\",\"total\":\"35\"}]', 10, 55, 'Efectivo', '2019-01-02 05:47:07'),
(6, 10006, 4, 70485303, '[{\"id\":\"3\",\"descripcion\":\"ULTRADECK JOEY\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"30\",\"total\":\"30\"}]', 30, 0, 'Efectivo', '2019-04-30 19:55:46'),
(7, 10007, 1, 70485303, '[{\"id\":\"3\",\"descripcion\":\"ULTRADECK JOEY\",\"cantidad\":\"1\",\"stock\":\"11\",\"precio\":\"30\",\"total\":\"30\"}]', 10, 20, 'Efectivo', '2019-04-30 19:56:20'),
(8, 10008, 3, 70485303, '[{\"id\":\"7\",\"descripcion\":\"Structure Deck Power Encode \",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"40\",\"total\":\"40\"}]', 0, 40, 'Efectivo', '2019-04-30 19:58:55'),
(9, 10009, 1, 70485212, '[{\"id\":\"2\",\"descripcion\":\"Deck Hero Storm GH\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"15\",\"total\":\"15\"}]', 0, 15, 'Efectivo', '2019-04-30 20:04:30'),
(10, 10010, 2, 70485212, '[{\"id\":\"31\",\"descripcion\":\"ludo\",\"cantidad\":\"1\",\"stock\":\"22\",\"precio\":\"23\",\"total\":\"23\"}]', 0, 23, 'Efectivo', '2019-04-30 20:18:39');

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `codigo_producto` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_producto` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `nombrelaboratorio` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `nombrefarmacia` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fechaconfirmacion` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `mensaje` varchar(200) COLLATE utf8_spanish_ci NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
-- Indices de la tabla `finanzas`
--
ALTER TABLE `finanzas`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `finanzas`
--
ALTER TABLE `finanzas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`dni_cli`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
