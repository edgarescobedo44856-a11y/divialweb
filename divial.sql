-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-11-2025 a las 15:07:35
-- Versión del servidor: 8.0.36
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `divial`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilio`
--

DROP TABLE IF EXISTS `domicilio`;
CREATE TABLE IF NOT EXISTS `domicilio` (
  `id_domicilio` int NOT NULL AUTO_INCREMENT,
  `usu_correo` varchar(45) DEFAULT NULL,
  `dom_calle` varchar(100) DEFAULT NULL,
  `dom_colonia` varchar(100) DEFAULT NULL,
  `dom_numero` varchar(10) DEFAULT NULL,
  `dom_cp` varchar(10) DEFAULT NULL,
  `dom_ciudad` varchar(45) DEFAULT NULL,
  `dom_estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_domicilio`),
  KEY `usu_correo` (`usu_correo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `domicilio`
--

INSERT INTO `domicilio` (`id_domicilio`, `usu_correo`, `dom_calle`, `dom_colonia`, `dom_numero`, `dom_cp`, `dom_ciudad`, `dom_estado`) VALUES
(1, 'rivera@gmail.com', 'JUAN ALVAREZ 33', 'FRANCISCO VILLA', '', '61154', 'CIUDAD HIDALGO', 'MICHOACAN'),
(2, 'alejandro@gmail.com', 'JUAN ALVAREZ 33', 'FRANCISCO VILLA', '', '61154', 'CIUDAD HIDALGO', 'MICHOACAN'),
(3, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id_pedido` int NOT NULL AUTO_INCREMENT,
  `usu_correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `tipo_material` varchar(45) DEFAULT NULL,
  `terminado` varchar(45) DEFAULT NULL,
  `medidas` text,
  `detalles_pedido` text,
  `fecha_pedido` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `usu_correo` (`usu_correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int DEFAULT NULL,
  `prod_nombre` varchar(100) DEFAULT NULL,
  `prod_tipo` varchar(45) DEFAULT NULL,
  `prod_medidas` text,
  `cantidad` int DEFAULT NULL,
  `descripcion` text,
  `prod_foto` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_proveedor` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int NOT NULL AUTO_INCREMENT,
  `pro_nombre_empresa` varchar(100) NOT NULL,
  `pro_contacto_principal` varchar(100) DEFAULT NULL,
  `pro_telefono` varchar(20) DEFAULT NULL,
  `pro_email` varchar(100) DEFAULT NULL,
  `pro_direccion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`),
  UNIQUE KEY `pro_email` (`pro_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usu_nombre` varchar(45) DEFAULT NULL,
  `usu_ap_pat` varchar(45) DEFAULT NULL,
  `usu_ap_mat` varchar(45) DEFAULT NULL,
  `usu_correo` varchar(100) NOT NULL,
  `usu_password` varchar(255) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`usu_correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usu_nombre`, `usu_ap_pat`, `usu_ap_mat`, `usu_correo`, `usu_password`, `tipo`) VALUES
('', '', '', '', '$2y$10$EKvdlKxede8suLD0krR9ruGfo3h4UvgmOjGLYe9LvX4.NlratO.5e', ''),
('ALEJANDRO', 'PEREZ', 'GARCIA', 'alejandro@gmail.com', '1234', 'cliente'),
('Edgar', 'ESCOBEDO', 'RIVERA', 'edgar@gmail.com', '1234', 'admin'),
('EDGAR', 'ESCOBEDO', 'RIVERA', 'rivera@gmail.com', '1234', 'gerente');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `domicilio`
--
ALTER TABLE `domicilio`
  ADD CONSTRAINT `domicilio_ibfk_1` FOREIGN KEY (`usu_correo`) REFERENCES `usuarios` (`usu_correo`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usu_correo`) REFERENCES `usuarios` (`usu_correo`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
