-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2024 a las 16:52:37
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
  `NCategoria` varchar(100) NOT NULL,
  `Descripción` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`IdCateg`, `NCategoria`, `Descripción`) VALUES
(1, 'Monitor', 'Dispositivo qu8e permite la visualización de los programas'),
(2, 'Teclado', 'Dispositivo de entrada de texto'),
(3, 'Laptop', 'Computadoras ligeras y que se pueden transportar a cualquier lugar, no se les puede realizar mayor modificación a sus componentes '),
(4, 'PC', 'Computadoras que son de estación, se pueden armar de acuerdo a las necesidades o preferencias'),
(5, 'Servicios', 'Servicios profesionales que ofrece la tienda');

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
  `Usuario` varchar(50) DEFAULT NULL,
  `NFactura` int(11) DEFAULT NULL,
  `IdPedido` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `ofertas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `ofertas` (
`IdProduct` int(11)
,`NProducto` varchar(100)
,`Descripcion` text
,`Precio` decimal(10,2)
,`Stock` int(11)
,`NCategoria` varchar(100)
,`enlace` varchar(255)
,`estado` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `IdPedido` int(11) NOT NULL,
  `NFactura` int(11) DEFAULT NULL,
  `IdProduct` int(11) DEFAULT NULL,
  `IdUser` int(11) DEFAULT NULL,
  `Usuario` varchar(50) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Provincia` varchar(100) DEFAULT NULL,
  `Canton` varchar(100) DEFAULT NULL,
  `NumeroContacto` varchar(20) DEFAULT NULL,
  `Sede` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `IdProduct` int(11) NOT NULL,
  `NProducto` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Stock` int(11) NOT NULL,
  `NCategoria` varchar(100) DEFAULT NULL,
  `enlace` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`IdProduct`, `NProducto`, `Descripcion`, `Precio`, `Stock`, `NCategoria`, `enlace`, `estado`) VALUES
(1, 'Apple Magic ', 'Lightning to USB Type-C Cable Incluido', 69030.00, 10, 'Teclado', 'https://compubetel.com/wp-content/uploads/2024/04/ID010APL84.jpg', 1),
(2, 'Dell KB216', 'Teclado USB ,español, negro ', 5600.00, 123, 'Teclado', 'https://compubetel.com/wp-content/uploads/2024/04/ID000DEL31.jpg', 1),
(3, 'XIAOMI A22FAB-RAGL', 'MONITOR LED 21.5\" XIAOMI A22I 6MS - 75HZ - 1920X1080 ', 38000.00, 12, 'Monitor', 'https://www.intelec.co.cr/image/cache/catalog/catalogo/Monitores/A22FAB-RAGL-800x800h.jpg.webp', 1),
(4, 'X-MICROX24KF', 'Monitor Led 24\" X-Micro X24KF 5ms - 75Hz - 1920x1080 HDMI-VGA ', 61000.00, 7, 'Monitor', 'https://www.intelec.co.cr/image/cache/catalog/catalogo/Monitores/X24KF-800x800w.jpg.webp', 1),
(5, 'Hewlett Packard 6M0Z6UA', '8 GB de RAM DDR4-2666 MHz-SSD de 256 GB-15,6\"', 220000.00, 9, 'Laptop', 'https://www.intelec.co.cr/image/cache/catalog/AROS/Accesorios%20Laptop/6M0Z6UA-800x800.jpeg.webp', 1),
(6, 'LENOVO 82R400EMUS', '1 RYZEN 5 5500U - 8GB - 512GB-SSD - 15.6\" - W11', 231000.00, 5, 'Laptop', 'https://www.intelec.co.cr/image/cache/catalog/catalogo/82R400EMUS-800x800w.jpeg.webp', 1),
(7, 'GAMING SILVER', 'INTEL I3 10105 - 256GB SSD - 8GB - ANTEC DRACO 10 - RX 6500 XT', 240000.00, 6, 'PC', 'https://www.intelec.co.cr/image/cache/catalog/ARMADOS%20JULIO%202024/SILVER%201-800x800.png.webp', 1),
(8, 'GAMING SPIRIT', 'INTEL i3 10105 - 8GB DDR4 - 256GB SSD - RTX 3050 - ANTEC DRACO 10', 260000.00, 7, 'PC', 'https://www.intelec.co.cr/image/cache/catalog/ARMADOS%20JULIO%202024/spirit%202-800x800.png.webp', 1),
(9, 'Mantenimiento correctivo', ' Revisiónde equipo *otros gastos corren por parte del cliente*', 12000.00, 5, 'Servicios', 'https://th.bing.com/th/id/OIP.VmMonNSwATAzYWVoVJGnhQHaGx?rs=1&pid=ImgDetMain', 1),
(10, 'Mantenimiento preventivo', 'Limpieza de los componentes del equipo  ', 5000.00, 8, 'Servicios', 'https://cdn.pixabay.com/photo/2013/03/29/13/38/wipe-97583_960_720.png', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `productos_mas_vendidos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `productos_mas_vendidos` (
`IdProduct` int(11)
,`NProducto` varchar(100)
,`Descripcion` text
,`Precio` decimal(10,2)
,`Stock` int(11)
,`NCategoria` varchar(100)
,`enlace` varchar(255)
,`estado` tinyint(1)
);

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
(9, 'Patitowuww', 'asd', 'serrano', 'hola@gmail.com', '$2y$10$ij6/mly0HZyd7zhYDKqzuO9N2PNWBoOe4SxlexVYgMKUJ5jo3ksCq', 'Administrador', 1),
(10, 'brandon12', 'asd', 'serrano', 'hola@gmail.com', '$2y$10$ij6/mly0HZyd7zhYDKqzuO9N2PNWBoOe4SxlexVYgMKUJ5jo3ksCq', 'Cajero', 1),
(16, 'ellos', 'nei', 'bor', 'Patitowuww@hotmail.com', '$2y$10$kixzSG93Z9eh4YekEm3UE.tq7CnSUcz9jnCAbgJoQIEro7omX7mdG', 'Usuario', 1),
(21, 'Prueba', 'Prueba', 'Prueba', 'Prueba@Prueba.com', '$2y$10$HR4bEGVWY2ElL8Y4Yx0Tw.hxDNY5v4Kio22VL.x9GEI1qS9/MGhfi', 'Administrador', 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `ofertas`
--
DROP TABLE IF EXISTS `ofertas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ofertas`  AS SELECT `productos`.`IdProduct` AS `IdProduct`, `productos`.`NProducto` AS `NProducto`, `productos`.`Descripcion` AS `Descripcion`, `productos`.`Precio` AS `Precio`, `productos`.`Stock` AS `Stock`, `productos`.`NCategoria` AS `NCategoria`, `productos`.`enlace` AS `enlace`, `productos`.`estado` AS `estado` FROM `productos` ORDER BY `productos`.`Stock` DESC LIMIT 0, 5 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `productos_mas_vendidos`
--
DROP TABLE IF EXISTS `productos_mas_vendidos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productos_mas_vendidos`  AS SELECT `productos`.`IdProduct` AS `IdProduct`, `productos`.`NProducto` AS `NProducto`, `productos`.`Descripcion` AS `Descripcion`, `productos`.`Precio` AS `Precio`, `productos`.`Stock` AS `Stock`, `productos`.`NCategoria` AS `NCategoria`, `productos`.`enlace` AS `enlace`, `productos`.`estado` AS `estado` FROM `productos` ORDER BY `productos`.`Stock` ASC LIMIT 0, 5 ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`IdCateg`),
  ADD UNIQUE KEY `NCategoria` (`NCategoria`);

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
  MODIFY `IdCateg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

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
  MODIFY `IdProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`NCategoria`) REFERENCES `categorias` (`NCategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
