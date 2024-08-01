-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-07-2024 a las 05:14:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `IdCateg` int(11) NOT NULL,
  `NCategoria` varchar(50) NOT NULL,
  `Descripción` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`IdCateg`, `NCategoria`, `Descripción`) VALUES
(1, 'holaa', 'adios'),
(124, 'hey', 'you');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `NFactura` int(11) NOT NULL,
  `IdProduct` int(11) DEFAULT NULL,
  `Total` decimal(10,2) NOT NULL,
  `IdUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historicousuario`
--

CREATE TABLE `historicousuario` (
  `IdUser` int(11) DEFAULT NULL,
  `Usuario` varchar(50) NOT NULL,
  `NFactura` int(11) DEFAULT NULL,
  `IdPedido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `IdPedido` int(11) NOT NULL,
  `NFactura` int(11) DEFAULT NULL,
  `IdProduct` int(11) DEFAULT NULL,
  `IdUser` int(11) DEFAULT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Provincia` varchar(50) NOT NULL,
  `Canton` varchar(50) NOT NULL,
  `NumeroContacto` varchar(20) NOT NULL,
  `Sede` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `IdProduct` int(11) NOT NULL,
  `NProducto` varchar(50) NOT NULL,
  `Descripcion` text NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Stock` int(11) NOT NULL,
  `NCategoria` int(11) DEFAULT NULL,
  `enlace` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`IdProduct`, `NProducto`, `Descripcion`, `Precio`, `Stock`, `NCategoria`, `enlace`, `estado`) VALUES
(2, 'reloj', 'asdasdsd', 1321.00, 123, 124, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQC012hPrk2KRUGYk5oCOnF4wRC0yayh6qwA&s', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUser` int(11) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `Rol` varchar(50) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUser`, `Usuario`, `Nombre`, `Apellido`, `Email`, `Contraseña`, `Rol`, `Estado`) VALUES
(1, 'brandon1', 'brandon1', 'serrano', 'brandon@gmail.com', '', 'Administrador', 1),
(3, 'brandon2', 'brandon1', 'serrano', 'hola@gmail.com', '123Aa.', 'Administrador', 1),
(9, 'Patitowuww', 'asd', 'serrano', 'hola@gmail.com', '123Aa.', 'Administrador', 1),
(10, 'brandon12', 'asd', 'serrano', 'hola@gmail.com', '123Aa.', 'Cajero', 1),
(11, 'brandon123', 'Keisy Valeria Castillo Flores', 'asd', 'brandon@hotmail.es', '123Aa.', 'Administrador', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`IdCateg`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`NFactura`),
  ADD KEY `IdProduct` (`IdProduct`),
  ADD KEY `IdUser` (`IdUser`);

--
-- Indices de la tabla `historicousuario`
--
ALTER TABLE `historicousuario`
  ADD KEY `IdUser` (`IdUser`),
  ADD KEY `NFactura` (`NFactura`),
  ADD KEY `IdPedido` (`IdPedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`IdPedido`),
  ADD KEY `NFactura` (`NFactura`),
  ADD KEY `IdProduct` (`IdProduct`),
  ADD KEY `IdUser` (`IdUser`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`IdProduct`),
  ADD KEY `NCategoria` (`NCategoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `IdCateg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `NFactura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `IdPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `IdProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`IdProduct`) REFERENCES `productos` (`IdProduct`),
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`IdUser`) REFERENCES `usuarios` (`IdUser`);

--
-- Filtros para la tabla `historicousuario`
--
ALTER TABLE `historicousuario`
  ADD CONSTRAINT `historicousuario_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `usuarios` (`IdUser`),
  ADD CONSTRAINT `historicousuario_ibfk_2` FOREIGN KEY (`NFactura`) REFERENCES `facturas` (`NFactura`),
  ADD CONSTRAINT `historicousuario_ibfk_3` FOREIGN KEY (`IdPedido`) REFERENCES `pedidos` (`IdPedido`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`NFactura`) REFERENCES `facturas` (`NFactura`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`IdProduct`) REFERENCES `productos` (`IdProduct`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`IdUser`) REFERENCES `usuarios` (`IdUser`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`NCategoria`) REFERENCES `categorias` (`IdCateg`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
