-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-09-2021 a las 02:38:44
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `chicken`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nit` int(30) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido_paterno` varchar(20) NOT NULL,
  `apellido_materno` varchar(20) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nit`, `nombre`, `apellido_paterno`, `apellido_materno`, `direccion`, `telefono`) VALUES
(62, 12345678, 'miguel', 'Ortiz', 'Cruz', 'villa', 2147483647),
(67, 1234567890, 'maria', 'test', 'test2', 'villa', 12345678);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `detalle` varchar(150) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `id_pedido`, `id_producto`, `detalle`, `cantidad`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 3, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 0, 3, NULL, NULL),
(6, 0, 2, NULL, NULL),
(7, 5, 2, NULL, NULL),
(8, 0, 3, NULL, NULL),
(9, 0, 0, NULL, NULL),
(10, 0, 0, NULL, NULL),
(11, 0, 0, NULL, NULL),
(12, 0, 0, NULL, NULL),
(13, 0, 0, NULL, NULL),
(14, 6, 3, NULL, NULL),
(15, 7, 3, NULL, NULL),
(16, 8, 1, NULL, NULL),
(17, 9, 1, NULL, NULL),
(18, 0, 0, NULL, NULL),
(19, 0, 0, NULL, NULL),
(20, 0, 0, NULL, 1),
(21, 0, 0, NULL, 1),
(22, 21, 0, NULL, 1),
(23, 21, 0, NULL, 1),
(24, 23, 0, NULL, 1),
(25, 0, 0, NULL, 1),
(26, 0, 0, NULL, 1),
(27, 26, 0, NULL, 1),
(28, 26, 0, NULL, 1),
(29, 28, 0, NULL, 1),
(30, 0, 0, NULL, 1),
(31, 0, 0, NULL, 1),
(32, 31, 0, NULL, 1),
(33, 31, 0, NULL, 1),
(34, 33, 0, NULL, 1),
(35, 0, 0, NULL, 1),
(36, 35, 0, NULL, 1),
(37, 36, 0, NULL, 1),
(38, 0, 0, NULL, 1),
(39, 38, 0, NULL, 1),
(40, 39, 0, NULL, 1),
(41, 0, 0, NULL, 1),
(42, 41, 0, NULL, 1),
(43, 42, 0, NULL, 1),
(44, 0, 0, NULL, 1),
(45, 0, 0, NULL, 1),
(46, 0, 0, NULL, 1),
(47, 0, 0, NULL, 1),
(48, 0, 0, NULL, 1),
(49, 0, 0, NULL, 1),
(50, 0, 0, NULL, 1),
(51, 0, 0, NULL, 1),
(52, 0, 0, NULL, 1),
(53, 0, 0, NULL, 1),
(54, 0, 0, NULL, 1),
(55, 0, 0, NULL, 1),
(56, 0, 1, NULL, 1),
(57, 0, 5, NULL, 1),
(58, 0, 15, NULL, 1),
(59, 0, 1, NULL, 1),
(60, 0, 5, NULL, 1),
(61, 0, 15, NULL, 1),
(62, 0, 1, NULL, 1),
(63, 0, 5, NULL, 1),
(64, 0, 15, NULL, 1),
(65, 0, 1, NULL, 1),
(66, 0, 5, NULL, 1),
(67, 0, 15, NULL, 1),
(68, 0, 1, NULL, 1),
(69, 0, 5, NULL, 1),
(70, 0, 15, NULL, 1),
(71, 0, 1, NULL, 1),
(72, 0, 5, NULL, 1),
(73, 0, 15, NULL, 1),
(74, 10, 1, NULL, 2),
(75, 11, 1, NULL, 2),
(76, 12, 1, NULL, 2),
(77, 13, 2, NULL, 2),
(78, 14, 2, NULL, 2),
(79, 15, 5, NULL, 1),
(80, 16, 6, NULL, 1),
(81, 17, 7, 'Entero', 1),
(82, 17, 5, 'Porcion de arroz', 1),
(83, 17, 6, 'Porcion de papas', 1),
(84, 18, 1, 'economico', 2),
(85, 18, 5, 'Porcion de arroz', 2),
(86, 18, 6, 'Porcion de papas', 3),
(87, 19, 1, 'economico', 4),
(88, 20, 2, 'cuarto', 3),
(89, 20, 5, 'Porcion de arroz', 1),
(90, 21, 15, 'Entero', 1),
(91, 21, 17, 'Economico', 3),
(92, 22, 17, 'Economico', 1),
(93, 22, 17, 'Economico', 1),
(94, 22, 23, 'Porcion de papas', 1),
(95, 23, 17, 'Economico', 1),
(96, 24, 17, NULL, NULL),
(97, 25, 17, NULL, NULL),
(98, 26, 17, 'Economico', 1),
(99, 26, 18, 'Entero', 1),
(100, 27, 17, 'Economico', 1),
(101, 27, 18, 'Entero', 1),
(102, 28, 17, 'Economico', 1),
(103, 28, 18, 'Entero', 1),
(104, 28, 19, 'Cuarto', 2),
(105, 28, 20, 'Medio', 1),
(106, 29, 17, 'Economico', 2),
(107, 29, 18, 'Entero', 1),
(108, 29, 23, 'Porcion de papas', 1),
(109, 29, 28, 'Porcion de fideo', 1),
(110, 29, 21, 'Porcion de arroz', 3),
(111, 0, 0, NULL, NULL),
(112, 34, 17, 'Economico', 1),
(113, 35, 19, 'Cuarto', 1),
(114, 36, 17, 'Economico', 1),
(115, 36, 18, 'Entero', 1),
(116, 37, 18, 'Entero', 1),
(117, 38, 17, 'Economico', 1),
(118, 40, 18, 'Entero', 1),
(119, 41, 17, 'Economico', 2),
(120, 42, 19, 'Cuarto', 3),
(121, 43, 17, 'Economico', 3),
(122, 44, 18, 'Entero', 2),
(123, 44, 17, 'Economico', 2),
(124, 45, 17, 'Economico', 4),
(125, 46, 17, 'Economico', 1),
(126, 47, 17, 'Economico', 1),
(127, 47, 18, 'Entero', 1),
(128, 48, 17, 'Economico', 1),
(129, 48, 17, 'Economico', 1),
(130, 49, 17, 'Economico', 1),
(131, 49, 18, 'Entero', 1),
(132, 49, 19, 'Cuarto', 1),
(133, 50, 17, 'Economico', 2),
(134, 50, 19, 'Cuarto', 4),
(135, 50, 20, 'Medio', 2),
(136, 50, 21, 'Porcion de arroz', 3),
(137, 51, 18, 'Entero', 2),
(138, 51, 19, 'Cuarto', 1),
(139, 51, 21, 'Porcion de arroz', 1),
(140, 51, 23, 'Porcion de papas', 1),
(141, 52, 17, 'Economico', 1),
(142, 52, 18, 'Entero', 2),
(143, 52, 17, 'Economico', 1),
(144, 53, 17, 'Economico', 1),
(145, 53, 19, 'Cuarto', 1),
(146, 53, 20, 'Medio', 1),
(147, 54, 21, 'Porcion de arroz', 1),
(148, 54, 23, 'Porcion de papas', 1),
(149, 54, 28, 'Porcion de fideo', 1),
(150, 54, 18, 'Entero', 1),
(151, 55, 21, 'Porcion de arroz', 2),
(152, 55, 23, 'Porcion de papas', 3),
(153, 55, 17, 'Economico', 4),
(154, 56, 18, 'Entero', 1),
(155, 56, 18, 'Entero', 1),
(156, 57, 17, 'Economico', 1),
(157, 58, 17, 'Economico', 2),
(158, 58, 19, 'Cuarto', 1),
(159, 58, 21, 'Porcion de arroz', 1),
(160, 58, 23, 'Porcion de papas', 3),
(161, 58, 28, 'Porcion de fideo', 1),
(162, 59, 18, 'Entero', 1),
(163, 59, 18, 'Entero', 1),
(164, 59, 18, 'Entero', 1),
(165, 60, 30, 'salchipapa', 4),
(166, 60, 28, 'Porcion de fideo', 1),
(167, 61, 17, 'Economico', 1),
(168, 61, 18, 'Entero', 1),
(169, 62, 17, 'Economico', 1),
(170, 62, 17, 'Economico', 1),
(171, 63, 17, 'Economico', 1),
(172, 65, 17, 'Economico', 1),
(173, 66, 17, 'Economico', 1),
(174, 67, 17, 'Economico', 1),
(175, 68, 18, 'Entero', 1),
(176, 68, 17, 'Economico', 1),
(177, 71, 18, 'Entero', 1),
(178, 71, 19, 'Cuarto', 1),
(179, 72, 17, 'Economico', 1),
(180, 73, 17, 'Economico', 1),
(181, 73, 17, 'Economico', 1),
(182, 73, 17, 'Economico', 1),
(183, 74, 17, 'Economico', 1),
(184, 75, 35, 'salchipollo', 1),
(185, 75, 17, 'Economico', 1),
(186, 75, 19, 'Cuarto', 1),
(187, 76, 17, 'Economico', 1),
(188, 79, 17, 'Economico', 1),
(189, 80, 17, 'Economico', 1),
(190, 82, 17, 'Economico', 2),
(191, 83, 17, 'Economico', 2),
(192, 84, 17, 'Economico', 2),
(193, 84, 18, 'Entero', 2),
(194, 85, 17, 'Economico', 2),
(195, 85, 19, 'Cuarto', 2),
(196, 86, 17, 'Economico', 1),
(197, 86, 19, 'Cuarto', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `producto_preparado` varchar(25) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_cliente`, `producto_preparado`, `fecha`, `hora`) VALUES
(1, 5, NULL, '0000-00-00', '00:00:12'),
(2, 6, NULL, '0000-00-00', '00:00:13'),
(3, 7, NULL, '0000-00-00', '00:00:14'),
(4, 7, NULL, '2020-11-14', '00:00:14'),
(5, 6, NULL, '2020-11-17', '00:00:12'),
(6, 7, NULL, '2020-11-20', '00:00:12'),
(7, 6, NULL, '2020-11-21', '00:00:14'),
(8, 7, NULL, '2020-11-19', '00:00:12'),
(9, 9, NULL, '2020-05-20', '00:00:12'),
(10, NULL, 'economico', '2020-11-25', NULL),
(11, NULL, 'economico', '2020-11-25', NULL),
(12, NULL, 'economico', '2020-11-25', NULL),
(13, NULL, 'cuarto', '2020-11-25', NULL),
(14, NULL, 'cuarto', '2020-11-25', NULL),
(15, NULL, 'Porcion de arroz', '2020-11-25', NULL),
(16, NULL, 'Porcion de papas', '2020-11-25', NULL),
(26, 92, NULL, '2020-11-26', NULL),
(27, 92, NULL, '2020-11-26', NULL),
(28, 170, NULL, '2020-11-26', NULL),
(29, 144, NULL, '2020-12-01', NULL),
(30, 0, NULL, '2020-12-03', NULL),
(31, 0, NULL, '2020-12-03', NULL),
(32, 0, NULL, '2020-12-03', NULL),
(33, 0, NULL, '2020-12-03', NULL),
(34, 12, NULL, '2020-12-03', NULL),
(35, 19, NULL, '2020-12-03', NULL),
(36, 92, NULL, '2020-12-03', NULL),
(37, 80, NULL, '2020-12-03', NULL),
(38, 12, NULL, '2020-12-03', NULL),
(39, 20, '', '2020-12-03', NULL),
(40, 21, '80', '2020-12-03', NULL),
(41, 20, '24', '2020-12-03', NULL),
(42, 20, '57', '2020-12-03', NULL),
(43, 20, '36', '2020-12-03', NULL),
(44, 21, '184', '2020-12-03', NULL),
(45, 20, '48', '2020-12-03', NULL),
(46, 20, '12', '2020-12-03', NULL),
(47, 22, '92', '2020-12-03', NULL),
(48, 22, '24', '2020-12-03', NULL),
(49, 29, '111', '2020-12-03', NULL),
(50, 30, '204', '2020-12-03', NULL),
(51, 32, '193', '2020-12-12', NULL),
(52, 30, '184', '2021-04-17', NULL),
(53, 35, '71', '2021-04-18', NULL),
(54, 31, '104', '2021-04-18', NULL),
(55, 32, '82', '2021-04-18', NULL),
(56, 47, '160', '2021-04-18', NULL),
(57, 53, '12', '2021-04-22', NULL),
(58, 54, '79', '2021-04-24', NULL),
(59, 55, '240', '2021-04-25', NULL),
(60, 56, '70', '2021-04-25', NULL),
(61, 58, '92', '2021-05-03', NULL),
(62, 58, '24', '2021-05-03', NULL),
(63, NULL, '12', '2021-05-08', NULL),
(64, NULL, '', '2021-05-08', NULL),
(65, NULL, '12', '2021-05-08', NULL),
(66, NULL, '12', '2021-05-08', NULL),
(67, NULL, '12', '2021-05-08', NULL),
(68, NULL, '92', '2021-05-08', NULL),
(69, NULL, '', '2021-05-08', NULL),
(70, NULL, '', '2021-05-08', NULL),
(71, NULL, '99', '2021-05-08', NULL),
(72, NULL, '12', '2021-05-09', NULL),
(73, NULL, '36', '2021-05-09', NULL),
(74, NULL, '12', '2021-05-09', NULL),
(75, NULL, '46', '2021-05-10', NULL),
(76, NULL, '12', '2021-05-10', NULL),
(77, NULL, '', '2021-05-10', NULL),
(78, NULL, '', '2021-05-10', NULL),
(79, NULL, '12', '2021-05-10', NULL),
(80, NULL, '12', '2021-05-10', NULL),
(81, NULL, '', '2021-05-16', NULL),
(82, NULL, '24', '2021-05-16', NULL),
(83, NULL, '24', '2021-05-16', NULL),
(84, NULL, '184', '2021-05-16', NULL),
(85, NULL, '62', '2021-05-16', NULL),
(86, NULL, '31', '2021-08-18', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `codigo` varchar(25) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `codigo`, `precio`, `imagen`) VALUES
(17, 'Economico', '01', 12300, 'photo_2020-05-20_03-46-24-2.jpg'),
(18, 'Entero', '02', 80, 'descarga.jpg'),
(19, 'Cuarto', '03', 19, 'photo.jpg'),
(20, 'Medio', '04', 40, 'images.jpg'),
(21, 'Porcion de arroz', '05', 8, 'images (1).jpg'),
(23, 'Porcion de papas', '06', 6, 'papas.jpg'),
(28, 'Porcion de fideo', '07', 10, 'fideo.jpg'),
(37, 'test', '08', 12, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurante`
--

CREATE TABLE `restaurante` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `_password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `_password`) VALUES
(1, 'denar', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `restaurante`
--
ALTER TABLE `restaurante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `restaurante`
--
ALTER TABLE `restaurante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
