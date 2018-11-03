-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2016 a las 23:07:32
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test_pedidos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE IF NOT EXISTS `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `numero_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE IF NOT EXISTS `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre_marca` char(40) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre_marca`) VALUES
(1, 'Mega'),
(2, 'HP'),
(3, 'Black and decker'),
(4, 'Honda'),
(5, 'Pedrollo'),
(6, 'Taifu'),
(7, 'Porter cable'),
(8, 'Milwaukee'),
(9, 'Riggid'),
(10, 'Karcher'),
(11, 'Lincoln electric'),
(12, 'Goni'),
(13, 'Poulan'),
(14, 'Bosch'),
(15, 'Franklin electric'),
(16, 'Shell Helix'),
(17, 'QUINCIP'),
(18, 'Briggs stratton'),
(19, 'Champions'),
(20, 'Parker'),
(21, 'Norflex'),
(22, 'Campbell Hausfeld'),
(23, 'Koyo'),
(24, 'Alkota'),
(25, 'Amsterdam'),
(26, 'Oster'),
(27, 'Trupper'),
(28, 'Truck Hose'),
(29, 'Trapp'),
(30, 'Ducar'),
(31, 'Brahman'),
(32, 'Ngk'),
(33, 'Midwest Can'),
(34, 'Maccolloch'),
(35, 'Nuvo'),
(36, 'Oregon'),
(37, 'Swingfog'),
(38, 'Irwin'),
(39, 'Makita'),
(40, 'Hilti'),
(41, 'JOHN DEERE'),
(42, 'Valdoch'),
(43, 'JAZ'),
(44, 'Stanley'),
(45, 'Pressure wave'),
(46, 'Delta'),
(47, 'Urrea'),
(48, 'Skil'),
(49, 'Surtek'),
(50, 'China'),
(51, 'Foy'),
(52, 'Amana tool'),
(53, 'Norton'),
(54, '3M'),
(55, 'Square'),
(56, 'Vanguard'),
(57, 'Gbs'),
(58, 'Quality'),
(59, 'Miller'),
(60, 'Mundial'),
(61, 'Fini'),
(62, 'Nova'),
(63, 'Somar'),
(64, 'Timberline'),
(65, 'Forte'),
(66, 'Aguila'),
(67, 'Kimberly Clark'),
(68, 'Diamond'),
(69, 'Schulz'),
(70, 'Genteq'),
(71, 'Bellota'),
(72, 'Ultra'),
(73, 'Craftsman'),
(74, 'Asein'),
(75, 'Knova'),
(76, 'Generica'),
(77, 'Sagola'),
(78, 'Arvek'),
(79, 'Yale'),
(80, 'Leeson'),
(81, 'Siemen'),
(82, 'Baldor'),
(83, 'StaRite'),
(84, 'Diablo'),
(88, 'ARO'),
(86, 'Booster'),
(87, 'Dremel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `transporte` varchar(255) NOT NULL,
  `condiciones` varchar(255) NOT NULL,
  `comentarios` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL,
  `nombre_comercial` varchar(255) NOT NULL,
  `propietario` varchar(255) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `iva` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `nombre_comercial`, `propietario`, `telefono`, `direccion`, `email`, `iva`) VALUES
(1, 'Sistema Web S.A. de C.V.', 'Obed Alvarado', '7058-7688', 'San Miguel, El Salvador', 'info@obedalvarado.pw', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL,
  `codigo_producto` char(20) NOT NULL,
  `nombre_producto` char(100) NOT NULL,
  `modelo_producto` varchar(30) NOT NULL,
  `id_departamento_producto` int(11) NOT NULL,
  `id_marca_producto` int(11) NOT NULL,
  `status_producto` tinyint(4) NOT NULL,
  `unidad_medida_producto` char(20) NOT NULL,
  `peso_producto` char(20) NOT NULL,
  `date_added` datetime NOT NULL,
  `precio_producto` double NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4301 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `codigo_producto`, `nombre_producto`, `modelo_producto`, `id_departamento_producto`, `id_marca_producto`, `status_producto`, `unidad_medida_producto`, `peso_producto`, `date_added`, `precio_producto`) VALUES
(1, 'MG01', 'Mouse inalambrico', '', 3, 1, 1, 'Cada una', 'sin peso', '2013-03-25 20:35:15', 10),
(2, 'TCL01', 'Teclado multimedia', '', 3, 1, 1, '', '', '2013-03-25 20:35:15', 15),
(3, 'ILK059', 'Nuevo mini 2.4g micro inalambrico de teclado', '', 3, 1, 1, '', '', '2013-03-25 20:35:15', 25),
(4, '4520', 'TECLADO para HP 4520', 'MS250', 3, 2, 1, '', '', '2013-03-25 20:35:15', 40),
(5, 'A081', 'Altavoz de la computadora', '', 3, 2, 1, '', '', '2013-03-25 20:35:15', 18),
(64, 'MSD01', '2GB Tarjeta Micro SD', '', 2, 2, 1, '', '', '2013-03-25 20:35:15', 5),
(65, 'AUR01', 'Adaptador usb para radio cd', '', 2, 2, 1, '', '', '2013-03-25 20:35:15', 5),
(66, 'SA-205', '2.0 de canal de sonido multimedia sa-205', '', 2, 2, 1, '', '', '2013-03-25 20:35:15', 13),
(67, 'KB-1830', 'Teclado multimedia de alta calidad', '', 2, 1, 1, '', '', '2013-03-25 20:35:15', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(255) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(64) NOT NULL,
  `direccion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp`
--

CREATE TABLE IF NOT EXISTS `tmp` (
  `id_tmp` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL,
  `precio_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `numero_cotizacion` (`numero_pedido`,`id_producto`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD UNIQUE KEY `numero_cotizacion` (`numero`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `codigo_producto` (`codigo_producto`),
  ADD KEY `id_departamento_producto` (`id_departamento_producto`),
  ADD KEY `id_marca_producto` (`id_marca_producto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `tmp`
--
ALTER TABLE `tmp`
  ADD PRIMARY KEY (`id_tmp`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4301;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
