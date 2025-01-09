-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-01-2025 a las 11:28:46
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `caro_net`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

DROP TABLE IF EXISTS `cargo`;
CREATE TABLE IF NOT EXISTS `cargo` (
  `id` int NOT NULL,
  `Nombre_Cargo` varchar(100) DEFAULT NULL,
  `Estado` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id`, `Nombre_Cargo`, `Estado`) VALUES
(0, 'presidente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `apellido_materno` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dni_ruc` varchar(20) NOT NULL,
  `tipo_documento` enum('DNI','RUC') NOT NULL,
  `celular` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `referencia` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `estado` tinyint DEFAULT '1',
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `dni_ruc` (`dni_ruc`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido_paterno`, `apellido_materno`, `dni_ruc`, `tipo_documento`, `celular`, `email`, `direccion`, `referencia`, `fecha_registro`, `estado`) VALUES
(14, 'Roynerasdf', 'Rodriguez', 'Fernandez', '72183781', 'DNI', '132456789', 'royner41@fasd.com', 'asdfasdf', 'asda', '2025-01-06 23:33:59', 1),
(15, 'Juan', 'Perez', 'Don', '13456789888', 'RUC', '132456789', 'roooas@sadf.com', 'asdf', 'asdfsdf', '2025-01-06 23:56:21', 2),
(16, 'Dionel', 'Rodriguez', 'Fernandez', '13246532', 'DNI', '969547013', 'royner41@gmail.com', 'CA INGENIERIA S/N MZ B LT 5 PIS 1', 'asdfsdf', '2025-01-07 23:26:00', 1),
(17, 'Dionela', 'Rodriguez', 'Fernandez', '13246532123', 'RUC', '969547011', 'royner@gmail.com', 'CA INGENIERIA S/N MZ B LT 5 PIS 1', 'asdfsadf', '2025-01-08 03:59:59', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_planes`
--

DROP TABLE IF EXISTS `cliente_planes`;
CREATE TABLE IF NOT EXISTS `cliente_planes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `id_planes_servicios` int NOT NULL,
  `Ip` varchar(45) NOT NULL,
  `Nombre_wifi` varchar(255) DEFAULT NULL,
  `Contraseña_wifi` varchar(250) DEFAULT NULL,
  `Ubicacion` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Foto_ubicacion` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Foto_router` varchar(1000) DEFAULT NULL,
  `Fecha_inicio` datetime NOT NULL,
  `Fecha_finalizacion` datetime NOT NULL,
  `Estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_planes_servicios` (`id_planes_servicios`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cliente_planes`
--

INSERT INTO `cliente_planes` (`id`, `id_cliente`, `id_planes_servicios`, `Ip`, `Nombre_wifi`, `Contraseña_wifi`, `Ubicacion`, `Foto_ubicacion`, `Foto_router`, `Fecha_inicio`, `Fecha_finalizacion`, `Estado`) VALUES
(24, 14, 29, '192.168.0.15', 'seh', 'royner123123', '', NULL, NULL, '2025-01-08 00:00:00', '2025-02-08 00:00:00', 1),
(25, 17, 29, '192.168.0.10', 'seh', 'royner123123', '', NULL, NULL, '2025-01-09 00:00:00', '2025-02-09 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

DROP TABLE IF EXISTS `detalle_factura`;
CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `id_detalle` int NOT NULL AUTO_INCREMENT,
  `id_factura` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad` int NOT NULL DEFAULT '1',
  `precio_unitario` decimal(10,2) NOT NULL,
  `igv` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_factura` (`id_factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

DROP TABLE IF EXISTS `direccion`;
CREATE TABLE IF NOT EXISTS `direccion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ubigeo` varchar(6) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `distrito` varchar(50) NOT NULL,
  `urbanizacion` varchar(100) DEFAULT '-',
  `direccion` varchar(255) NOT NULL,
  `cod_local` varchar(10) DEFAULT '0000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`id`, `ubigeo`, `departamento`, `provincia`, `distrito`, `urbanizacion`, `direccion`, `cod_local`) VALUES
(1, '150201', 'LIMA', 'HUAURA', 'HUACHO', '_', 'CAL.AMAZONAS MZA. L LOTE. 2 (ASENT. HUM. MANZANARES 1ERA. ETAPA)', '0000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(250) DEFAULT NULL,
  `Apellido_Paterno` varchar(250) DEFAULT NULL,
  `Apellido_Materno` varchar(250) DEFAULT NULL,
  `DNI` varchar(8) DEFAULT NULL,
  `Fecha_de_Nacimiento` date DEFAULT NULL,
  `Sexo` varchar(20) DEFAULT NULL,
  `Sueldo` decimal(10,2) DEFAULT NULL,
  `Correo` varchar(250) DEFAULT NULL,
  `Celular` varchar(9) DEFAULT NULL,
  `Direccion` varchar(250) DEFAULT NULL,
  `id_Cargo` int DEFAULT NULL,
  `Estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `Nombre`, `Apellido_Paterno`, `Apellido_Materno`, `DNI`, `Fecha_de_Nacimiento`, `Sexo`, `Sueldo`, `Correo`, `Celular`, `Direccion`, `id_Cargo`, `Estado`) VALUES
(1, 'Royner', 'Rodriguez', 'Fernandez', '72183781', '2025-01-05', 'M', 1222.00, 'royner41@gmail.com', '969547011', 'urbanizacion las brisas', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

DROP TABLE IF EXISTS `empresas`;
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ruc` varchar(11) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `nombre_comercial` varchar(100) DEFAULT NULL,
  `id_direccion` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ruc` (`ruc`),
  KEY `id_direccion` (`id_direccion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `ruc`, `razon_social`, `nombre_comercial`, `id_direccion`) VALUES
(1, '20606725095', 'GRUPO CARONET E.I.R.L', 'CARONET', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

DROP TABLE IF EXISTS `facturas`;
CREATE TABLE IF NOT EXISTS `facturas` (
  `id_factura` int NOT NULL AUTO_INCREMENT,
  `id_empresa_emisora` int NOT NULL,
  `numero_factura` varchar(20) NOT NULL,
  `tipo_documento` enum('Factura','Boleta') NOT NULL,
  `id_cliente_planes` int NOT NULL,
  `tipo_igv` enum('18','10','','') NOT NULL DEFAULT '',
  `fecha_emision` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_vencimiento` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` tinyint DEFAULT '1',
  PRIMARY KEY (`id_factura`),
  UNIQUE KEY `numero_factura` (`numero_factura`),
  KEY `id_empresa_emisora` (`id_empresa_emisora`),
  KEY `id_cliente_planes` (`id_cliente_planes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `id_pago` int NOT NULL AUTO_INCREMENT,
  `id_factura` int NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha_pago` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pago`),
  KEY `id_factura` (`id_factura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_servicio`
--

DROP TABLE IF EXISTS `planes_servicio`;
CREATE TABLE IF NOT EXISTS `planes_servicio` (
  `id_plan_servicio` int NOT NULL AUTO_INCREMENT,
  `nombre_plan` varchar(100) NOT NULL,
  `codigo_plan` varchar(250) NOT NULL,
  `descripcion` text,
  `tarifa_mensual` decimal(10,2) NOT NULL,
  `igv_tarifa` decimal(10,2) NOT NULL,
  `velocidad` varchar(50) DEFAULT NULL,
  `estado` tinyint DEFAULT '1',
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_plan_servicio`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `planes_servicio`
--

INSERT INTO `planes_servicio` (`id_plan_servicio`, `nombre_plan`, `codigo_plan`, `descripcion`, `tarifa_mensual`, `igv_tarifa`, `velocidad`, `estado`, `fecha_creacion`, `fecha_actualizacion`) VALUES
(29, 'basico', 'BA62516495', 'asdf', 41.00, 9.00, '20', 1, '2025-01-08 20:58:34', '2025-01-09 02:05:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion` text,
  `precio` decimal(10,2) NOT NULL,
  `estado` tinyint DEFAULT '1',
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

DROP TABLE IF EXISTS `recibos`;
CREATE TABLE IF NOT EXISTS `recibos` (
  `id_recibo` int NOT NULL AUTO_INCREMENT,
  `numero_recibo` varchar(250) NOT NULL,
  `Tipo_documento` enum('DNI','RUC','','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dni_ruc` varchar(250) NOT NULL,
  `id_cliente` int NOT NULL,
  `id_emisor` int NOT NULL,
  `id_plan_servicio` int NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `monto_unitario` decimal(10,2) NOT NULL,
  `descuento` decimal(10,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(10,2) NOT NULL,
  `igv` decimal(10,2) NOT NULL,
  `monto_total` decimal(10,2) NOT NULL,
  `estado` enum('Pendiente','Pagado','Vencido') DEFAULT 'Pendiente',
  `estado_sunat` enum('NO_ENVIADO','ACEPTADO','RECHAZADO','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fecha_pago` date DEFAULT NULL,
  `motivo_descuento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hora_evio_sunat` datetime DEFAULT NULL,
  `codigo_recibo` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_recibo`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_plan_servicio` (`id_plan_servicio`),
  KEY `id_emisor` (`id_emisor`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `recibos`
--

INSERT INTO `recibos` (`id_recibo`, `numero_recibo`, `Tipo_documento`, `dni_ruc`, `id_cliente`, `id_emisor`, `id_plan_servicio`, `fecha_emision`, `fecha_vencimiento`, `monto_unitario`, `descuento`, `subtotal`, `igv`, `monto_total`, `estado`, `estado_sunat`, `fecha_pago`, `motivo_descuento`, `fecha_creacion`, `fecha_actualizacion`, `hora_evio_sunat`, `codigo_recibo`) VALUES
(34, 'B001-00000002', 'DNI', '72183781', 14, 1, 29, '2025-01-09', '2025-01-24', 41.00, 0.00, 41.00, 9.00, 50.00, 'Pendiente', 'NO_ENVIADO', NULL, '', '2025-01-09 05:39:50', '2025-01-09 05:39:50', NULL, '0DR2I02'),
(35, 'F001-00000002', 'RUC', '13246532123', 17, 1, 29, '2025-01-09', '2025-01-24', 41.00, 0.00, 41.00, 9.00, 50.00, 'Pendiente', 'ACEPTADO', NULL, '', '2025-01-09 06:56:03', '2025-01-09 11:18:57', NULL, 'NETWB02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  `Estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `Nombre`, `Estado`) VALUES
(1, 'administrador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL,
  `Nombre` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Correo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Contraseña` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_Tipo_Usuario` int NOT NULL,
  `Fecha_Registro` datetime NOT NULL,
  `Fecha_Actualizacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Estado` int NOT NULL DEFAULT '1',
  `id_Empleado` int NOT NULL,
  `confirmado` varchar(250) DEFAULT 'no',
  `codigo` varchar(4) DEFAULT NULL,
  `token` varchar(250) DEFAULT NULL,
  KEY `id_Empleado` (`id_Empleado`),
  KEY `id_Tipo_Usuario` (`id_Tipo_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `Nombre`, `Correo`, `Contraseña`, `id_Tipo_Usuario`, `Fecha_Registro`, `Fecha_Actualizacion`, `Estado`, `id_Empleado`, `confirmado`, `codigo`, `token`) VALUES
(0, 'Roy', 'royner41@gmail.com', '$2y$10$jElwAYckOa/IE7N0fQTSOOdLb8wK2GlN9OJybRGRgRixdKxgrh5nO', 1, '2025-01-05 23:55:31', '2025-01-06 00:03:22', 1, 1, 'si', '1234', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente_planes`
--
ALTER TABLE `cliente_planes`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_planes_servicios` FOREIGN KEY (`id_planes_servicios`) REFERENCES `planes_servicio` (`id_plan_servicio`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `empresas_ibfk_1` FOREIGN KEY (`id_direccion`) REFERENCES `direccion` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_3` FOREIGN KEY (`id_empresa_emisora`) REFERENCES `empresas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `facturas_ibfk_4` FOREIGN KEY (`id_cliente_planes`) REFERENCES `cliente_planes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `recibos`
--
ALTER TABLE `recibos`
  ADD CONSTRAINT `recibos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `recibos_ibfk_2` FOREIGN KEY (`id_plan_servicio`) REFERENCES `planes_servicio` (`id_plan_servicio`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `recibos_ibfk_3` FOREIGN KEY (`id_emisor`) REFERENCES `empresas` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_Empleado`) REFERENCES `empleado` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_Tipo_Usuario`) REFERENCES `tipo_usuario` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
