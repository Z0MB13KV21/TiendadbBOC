-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-08-2024 a las 02:45:00
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
-- Base de datos: `tiendadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE `banco` (
  `id` int(11) NOT NULL,
  `tarjeta` varchar(19) NOT NULL,
  `CVV` char(4) NOT NULL,
  `saldo` decimal(10,2) NOT NULL,
  `mes` int(11) DEFAULT NULL,
  `año` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `banco`
--

INSERT INTO `banco` (`id`, `tarjeta`, `CVV`, `saldo`, `mes`, `año`) VALUES
(1, '4111111111111111', '1234', 10000.00, 1, 2026),
(2, '5123456789012346', '5678', 15000.00, 5, 2025),
(3, '341234567890123', '9012', 144000.00, 4, 2027),
(4, '4111111111111112', '4321', 5000.00, 7, 2025),
(5, '5412345678901234', '6789', 7500.00, 2, 2028),
(6, '371449635398431', '3456', 12000.00, 11, 2027),
(7, '4111111111111113', '8765', 9000.00, 6, 2026),
(8, '5105105105105100', '1234', 3000.00, 8, 2025),
(9, '378282246310005', '5678', 18000.00, 3, 2028);

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
  `IdPedido` int(11) NOT NULL
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
(5, 'Hewlett Packard 6M0Z6UA', '8 GB de RAM DDR4,2666 MHz,SSD de 256 GB-15,6\"', 220000.00, 9, 'Laptop', 'https://www.intelec.co.cr/image/cache/catalog/AROS/Accesorios%20Laptop/6M0Z6UA-800x800.jpeg.webp', 1),
(6, 'LENOVO 82R400EMUS', '1 RYZEN 5 5500U - 8GB - 512GB-SSD - 15.6\" - W11', 231000.00, 5, 'Laptop', 'https://www.intelec.co.cr/image/cache/catalog/catalogo/82R400EMUS-800x800w.jpeg.webp', 1),
(7, 'GAMING SILVER', 'INTEL I3 10105 - 256GB SSD - 8GB - ANTEC DRACO 10 - RX 6500 XT', 240000.00, 6, 'PC', 'https://www.intelec.co.cr/image/cache/catalog/ARMADOS%20JULIO%202024/SILVER%201-800x800.png.webp', 1),
(8, 'GAMING SPIRIT', 'INTEL i3 10105 - 8GB DDR4 - 256GB SSD - RTX 3050 - ANTEC DRACO 10', 260000.00, 0, 'PC', 'https://www.intelec.co.cr/image/cache/catalog/ARMADOS%20JULIO%202024/spirit%202-800x800.png.webp', 1),
(9, 'Mantenimiento correctivo', ' Revisiónde equipo *otros gastos corren por parte del cliente* ', 12000.00, 6, 'Servicios', 'https://th.bing.com/th/id/OIP.VmMonNSwATAzYWVoVJGnhQHaGx?rs=1&pid=ImgDetMain', 1),
(10, 'Mantenimiento preventivo', 'Limpieza de los componentes del equipo  ', 5000.00, 8, 'Servicios', 'https://cdn.pixabay.com/photo/2013/03/29/13/38/wipe-97583_960_720.png', 1),
(13, 'a', 'asqwertyuio', 1.00, 2, 'Monitor', 'https://th.bing.com/th/id/OIP.VmMonNSwATAzYWVoVJGnhQHaGx?rs=1&pid=ImgDetMain', 0),
(14, 'a', 'aj', 1.00, 2, 'Monitor', 'https://th.bing.com/th/id/OIP.VmMonNSwATAzYWVoVJGnhQHaGx?rs=1&pid=ImgDetMain', 1);

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
(9, 'Olger', 'Olger', 'Arias', 'Olger@gmail.com', '$2y$10$/m0NM/UwKh8e.MdkImSEgOFFypVjtgV6txc4QxyHLFNr9i0HcG/iK', 'Administrador', 1),
(10, 'brandon12', 'Brandon', 'serrano', 'bran@gmail.com', '$2y$10$/m0NM/UwKh8e.MdkImSEgOFFypVjtgV6txc4QxyHLFNr9i0HcG/iK', 'Cajero', 1),
(16, 'Carlos', 'Carlos', 'Obando', 'Carlos@hotmail.com', '$2y$10$L4OEtobw7C5zv6yq2OqvcuCxaLNX.2VIYIQon3wPEWiRatQG51VFC', 'Usuario', 1);

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
-- Indices de la tabla `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`IdCateg`),
  ADD KEY `NCategoria` (`NCategoria`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`NFactura`),
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
-- AUTO_INCREMENT de la tabla `banco`
--
ALTER TABLE `banco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `IdProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `usuarios` (`IdUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historicousuario`
--
ALTER TABLE `historicousuario`
  ADD CONSTRAINT `historicousuario_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `usuarios` (`IdUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historicousuario_ibfk_2` FOREIGN KEY (`NFactura`) REFERENCES `facturas` (`NFactura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `historicousuario_ibfk_3` FOREIGN KEY (`IdPedido`) REFERENCES `pedidos` (`IdPedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`NFactura`) REFERENCES `facturas` (`NFactura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`IdUser`) REFERENCES `usuarios` (`IdUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`NCategoria`) REFERENCES `categorias` (`NCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
