-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2020 at 10:50 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `optica_martinez`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `borrar_asignacion` (IN `id_u` INT(10))  NO SQL
DELETE from usuario_rol where id_usuario = id_u$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `roles_usuarios` (IN `n_rol` INT(10))  NO SQL
select u.id_usuario,u.nombre,u.apellido
  
  from usuario u
  
 where exists (select null from usuario_rol r where r.id_usuario = u.id_usuario and r.id_rol = n_rol)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usuarios_roles` (IN `n_rol` INT(10))  NO SQL
select u.id_usuario,u.nombre,u.apellido
  from usuario u
 where not exists (select null from usuario_rol r where r.id_usuario = u.id_usuario and r.id_rol = n_rol)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `concepto_cuenta`
--

CREATE TABLE `concepto_cuenta` (
  `id_concepto_cuenta` int(10) NOT NULL,
  `id_cuenta_cobrar` int(10) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `consulta`
--

CREATE TABLE `consulta` (
  `id_consulta` int(10) NOT NULL,
  `id_historia_clinica` int(10) NOT NULL,
  `id_jornada_trabajo` int(10) NOT NULL,
  `optometrista` varchar(150) NOT NULL,
  `fecha` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `consulta-servicio`
--

CREATE TABLE `consulta-servicio` (
  `id_consulta_servicio` int(10) NOT NULL,
  `id_consulta` int(10) NOT NULL,
  `id_servicio` int(10) NOT NULL,
  `precio` int(10) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cuenta_cobrar`
--

CREATE TABLE `cuenta_cobrar` (
  `id_cuenta_cobrar` int(10) NOT NULL,
  `id_historia_cuenta` int(10) NOT NULL,
  `id_plan_pago` int(10) NOT NULL,
  `monto_restante` int(10) NOT NULL,
  `monto_actual` int(10) NOT NULL,
  `monto_total` int(10) NOT NULL,
  `estado_cuenta_cobrar` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cuota`
--

CREATE TABLE `cuota` (
  `id_cuota` int(10) NOT NULL,
  `id_cuenta_cobrar` int(10) NOT NULL,
  `monto_cuota` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(10) NOT NULL,
  `departamento` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `desglose`
--

CREATE TABLE `desglose` (
  `id_desglose` int(10) NOT NULL,
  `id_cuenta_cobrar` int(10) NOT NULL,
  `proceso` int(10) DEFAULT NULL,
  `montaje` int(10) DEFAULT NULL,
  `estuche` int(10) DEFAULT NULL,
  `gasto_lente` int(10) DEFAULT NULL,
  `gasto_varios` int(10) DEFAULT NULL,
  `gasto_total` int(10) DEFAULT NULL,
  `ganacia_percibida` int(10) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `examen_visual`
--

CREATE TABLE `examen_visual` (
  `id_examen_visual` int(10) NOT NULL,
  `id_consulta_servicio` int(10) NOT NULL,
  `distancia_pupilar` float DEFAULT NULL,
  `alt` float DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `historia_clinica`
--

CREATE TABLE `historia_clinica` (
  `id_historia_clinica` int(10) NOT NULL,
  `id_paciente` int(10) NOT NULL,
  `antecedentes` varchar(255) DEFAULT 'NULL',
  `fecha_registro` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `historia_cuenta`
--

CREATE TABLE `historia_cuenta` (
  `id_historia_cuenta` int(10) NOT NULL,
  `id_paciente` int(10) NOT NULL,
  `estado_historia` varchar(50) NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jornada`
--

CREATE TABLE `jornada` (
  `id_jornada` int(10) NOT NULL,
  `tipo_jornada` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jornada_trabajo`
--

CREATE TABLE `jornada_trabajo` (
  `id_jornada_trabajo` int(10) NOT NULL,
  `id_jornada` int(10) NOT NULL,
  `id_departamento` int(10) NOT NULL,
  `nombre_jornada` varchar(255) DEFAULT NULL,
  `lugar` varchar(500) DEFAULT 'NULL',
  `fecha_jornada` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(10) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `precio` int(10) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `marco`
--

CREATE TABLE `marco` (
  `id_marco` int(10) NOT NULL,
  `id_marca` int(10) NOT NULL,
  `cod_marco` varchar(255) DEFAULT NULL,
  `dir_foto` varchar(255) DEFAULT NULL,
  `precio` int(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `marco-tipo_marco`
--

CREATE TABLE `marco-tipo_marco` (
  `id_mtm` int(10) NOT NULL,
  `id_marco` int(10) NOT NULL,
  `id_tipo_marco` int(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medidas_ojo`
--

CREATE TABLE `medidas_ojo` (
  `id_medidas_ojo` int(10) NOT NULL,
  `id_examen_visual` int(10) NOT NULL,
  `ojo` tinyint(1) NOT NULL,
  `esfera` float DEFAULT NULL,
  `cilindro` float DEFAULT NULL,
  `eje` float DEFAULT NULL,
  `adicion` float DEFAULT NULL,
  `agudeza_visual` float DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orden_lente`
--

CREATE TABLE `orden_lente` (
  `id_orden_lente` int(10) NOT NULL,
  `id_cuenta_cobrar` int(10) NOT NULL,
  `id_marco` int(10) NOT NULL,
  `costo_material` int(10) NOT NULL,
  `costo_marco` int(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paciente`
--

CREATE TABLE `paciente` (
  `id_paciente` int(10) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `cedula` varchar(20) NOT NULL,
  `edad` int(3) DEFAULT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `plan_pago`
--

CREATE TABLE `plan_pago` (
  `id_plan_pago` int(10) NOT NULL,
  `plan_pago` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `retinoscopia`
--

CREATE TABLE `retinoscopia` (
  `id_retinoscopia` int(10) NOT NULL,
  `id_consulta_servicio` int(10) NOT NULL,
  `hallazgos` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(10) NOT NULL,
  `rol` varchar(25) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`, `estado`) VALUES
(1, 'Optometrista', 1),
(2, 'Prueba', 1),
(3, 'Tesorero', 1),
(4, 'Recepcionista', 1);

-- --------------------------------------------------------

--
-- Table structure for table `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(10) NOT NULL,
  `servicio` varchar(30) NOT NULL,
  `precio` int(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_lente`
--

CREATE TABLE `tipo_lente` (
  `id_tipo_lente` int(10) NOT NULL,
  `tipo_lente` varchar(100) DEFAULT NULL,
  `precio` int(10) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_lente-orden_lente`
--

CREATE TABLE `tipo_lente-orden_lente` (
  `id_tlol` int(10) NOT NULL,
  `id_tipo_lente` int(10) NOT NULL,
  `id_orden_lente` int(10) NOT NULL,
  `precio` int(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_marco`
--

CREATE TABLE `tipo_marco` (
  `id_tipo_marco` int(10) NOT NULL,
  `tipo_marco` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_material`
--

CREATE TABLE `tipo_material` (
  `id_tipo_material` int(10) NOT NULL,
  `tipo_material` varchar(100) DEFAULT NULL,
  `precio` int(10) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_material-orden_lente`
--

CREATE TABLE `tipo_material-orden_lente` (
  `id_tmol` int(10) NOT NULL,
  `id_tipo_material` int(10) NOT NULL,
  `id_orden_lente` int(10) NOT NULL,
  `precio` int(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(10) NOT NULL,
  `cod_minsa` varchar(100) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `apellido` varchar(35) NOT NULL,
  `cedula` varchar(50) NOT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `dir_foto` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `cod_minsa`, `nombre`, `apellido`, `cedula`, `telefono`, `correo`, `dir_foto`, `contraseña`, `descripcion`, `estado`) VALUES
(27, '123456', 'Carlos Alejandro', 'Arróliga Amador', '0012805960027T', '89886161', 'caarroliga@hotmail.com', '1441534052695.jpg', '123456', 'Prueba', 1),
(28, '12345', 'Erick', 'Andres', '0012805960023F', '84651505', 'erick@mail.com', NULL, '12345689', 'Prueba', 1),
(29, 'wqerty123', 'david', 'arroliga', '0012805460027T', '84651505', 'wqeqwe@asd.com', NULL, 'qweqwe', 'qweqwe', 1),
(30, '123ewww', 'Andrea', 'Lucia', '00128059600024H', '84651505', 'cacaaa@gga.com', NULL, '12345566', 'qweqwewqe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario-rol` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_rol` int(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuario_rol`
--

INSERT INTO `usuario_rol` (`id_usuario-rol`, `id_usuario`, `id_rol`, `estado`) VALUES
(42, 28, 1, 1),
(43, 27, 3, 1),
(44, 29, 1, 1),
(45, 29, 3, 1),
(46, 30, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `concepto_cuenta`
--
ALTER TABLE `concepto_cuenta`
  ADD PRIMARY KEY (`id_concepto_cuenta`),
  ADD KEY `id_cuenta_cobrar` (`id_cuenta_cobrar`);

--
-- Indexes for table `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `id_jornada_trabajo` (`id_jornada_trabajo`),
  ADD KEY `id_historia_clinica` (`id_historia_clinica`);

--
-- Indexes for table `consulta-servicio`
--
ALTER TABLE `consulta-servicio`
  ADD PRIMARY KEY (`id_consulta_servicio`),
  ADD KEY `id_consulta` (`id_consulta`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indexes for table `cuenta_cobrar`
--
ALTER TABLE `cuenta_cobrar`
  ADD PRIMARY KEY (`id_cuenta_cobrar`),
  ADD KEY `id_historia_cuenta` (`id_historia_cuenta`),
  ADD KEY `id_plan_pago` (`id_plan_pago`);

--
-- Indexes for table `cuota`
--
ALTER TABLE `cuota`
  ADD PRIMARY KEY (`id_cuota`),
  ADD KEY `id_cuenta_cobrar` (`id_cuenta_cobrar`);

--
-- Indexes for table `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`),
  ADD UNIQUE KEY `departamento` (`departamento`);

--
-- Indexes for table `desglose`
--
ALTER TABLE `desglose`
  ADD PRIMARY KEY (`id_desglose`),
  ADD KEY `FK_cuenta_desglose` (`id_cuenta_cobrar`);

--
-- Indexes for table `examen_visual`
--
ALTER TABLE `examen_visual`
  ADD PRIMARY KEY (`id_examen_visual`),
  ADD KEY `id_consulta_servicio` (`id_consulta_servicio`);

--
-- Indexes for table `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD PRIMARY KEY (`id_historia_clinica`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indexes for table `historia_cuenta`
--
ALTER TABLE `historia_cuenta`
  ADD PRIMARY KEY (`id_historia_cuenta`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indexes for table `jornada`
--
ALTER TABLE `jornada`
  ADD PRIMARY KEY (`id_jornada`);

--
-- Indexes for table `jornada_trabajo`
--
ALTER TABLE `jornada_trabajo`
  ADD PRIMARY KEY (`id_jornada_trabajo`),
  ADD KEY `departamento_id_departamento` (`id_departamento`),
  ADD KEY `jornada_id_jornada` (`id_jornada`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`),
  ADD UNIQUE KEY `marca` (`marca`);

--
-- Indexes for table `marco`
--
ALTER TABLE `marco`
  ADD PRIMARY KEY (`id_marco`),
  ADD UNIQUE KEY `cod_marco` (`cod_marco`),
  ADD UNIQUE KEY `dirfoto` (`dir_foto`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indexes for table `marco-tipo_marco`
--
ALTER TABLE `marco-tipo_marco`
  ADD PRIMARY KEY (`id_mtm`),
  ADD KEY `id_marco` (`id_marco`),
  ADD KEY `id_tipo_marco` (`id_tipo_marco`);

--
-- Indexes for table `medidas_ojo`
--
ALTER TABLE `medidas_ojo`
  ADD PRIMARY KEY (`id_medidas_ojo`),
  ADD KEY `id_examen_visual` (`id_examen_visual`);

--
-- Indexes for table `orden_lente`
--
ALTER TABLE `orden_lente`
  ADD PRIMARY KEY (`id_orden_lente`),
  ADD KEY `id_cuenta_cobrar` (`id_cuenta_cobrar`),
  ADD KEY `id_marco` (`id_marco`);

--
-- Indexes for table `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indexes for table `plan_pago`
--
ALTER TABLE `plan_pago`
  ADD PRIMARY KEY (`id_plan_pago`);

--
-- Indexes for table `retinoscopia`
--
ALTER TABLE `retinoscopia`
  ADD PRIMARY KEY (`id_retinoscopia`),
  ADD KEY `id_consulta_servicio` (`id_consulta_servicio`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indexes for table `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD UNIQUE KEY `servicio` (`servicio`);

--
-- Indexes for table `tipo_lente`
--
ALTER TABLE `tipo_lente`
  ADD PRIMARY KEY (`id_tipo_lente`),
  ADD UNIQUE KEY `tipo_lente` (`tipo_lente`);

--
-- Indexes for table `tipo_lente-orden_lente`
--
ALTER TABLE `tipo_lente-orden_lente`
  ADD PRIMARY KEY (`id_tlol`),
  ADD KEY `id_tipo_lente` (`id_tipo_lente`),
  ADD KEY `id_orden_lente` (`id_orden_lente`);

--
-- Indexes for table `tipo_marco`
--
ALTER TABLE `tipo_marco`
  ADD PRIMARY KEY (`id_tipo_marco`);

--
-- Indexes for table `tipo_material`
--
ALTER TABLE `tipo_material`
  ADD PRIMARY KEY (`id_tipo_material`),
  ADD UNIQUE KEY `tipo_material` (`tipo_material`);

--
-- Indexes for table `tipo_material-orden_lente`
--
ALTER TABLE `tipo_material-orden_lente`
  ADD PRIMARY KEY (`id_tmol`),
  ADD KEY `id_tipo_material` (`id_tipo_material`),
  ADD KEY `id_orden_lente` (`id_orden_lente`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cod_minsa` (`cod_minsa`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indexes for table `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id_usuario-rol`),
  ADD KEY `usuario_id_rol` (`id_usuario`),
  ADD KEY `rol_id_rol` (`id_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `concepto_cuenta`
--
ALTER TABLE `concepto_cuenta`
  MODIFY `id_concepto_cuenta` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id_consulta` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consulta-servicio`
--
ALTER TABLE `consulta-servicio`
  MODIFY `id_consulta_servicio` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cuenta_cobrar`
--
ALTER TABLE `cuenta_cobrar`
  MODIFY `id_cuenta_cobrar` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cuota`
--
ALTER TABLE `cuota`
  MODIFY `id_cuota` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `desglose`
--
ALTER TABLE `desglose`
  MODIFY `id_desglose` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `examen_visual`
--
ALTER TABLE `examen_visual`
  MODIFY `id_examen_visual` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historia_clinica`
--
ALTER TABLE `historia_clinica`
  MODIFY `id_historia_clinica` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `historia_cuenta`
--
ALTER TABLE `historia_cuenta`
  MODIFY `id_historia_cuenta` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jornada`
--
ALTER TABLE `jornada`
  MODIFY `id_jornada` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jornada_trabajo`
--
ALTER TABLE `jornada_trabajo`
  MODIFY `id_jornada_trabajo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marco`
--
ALTER TABLE `marco`
  MODIFY `id_marco` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marco-tipo_marco`
--
ALTER TABLE `marco-tipo_marco`
  MODIFY `id_mtm` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medidas_ojo`
--
ALTER TABLE `medidas_ojo`
  MODIFY `id_medidas_ojo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orden_lente`
--
ALTER TABLE `orden_lente`
  MODIFY `id_orden_lente` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plan_pago`
--
ALTER TABLE `plan_pago`
  MODIFY `id_plan_pago` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retinoscopia`
--
ALTER TABLE `retinoscopia`
  MODIFY `id_retinoscopia` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_lente`
--
ALTER TABLE `tipo_lente`
  MODIFY `id_tipo_lente` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_lente-orden_lente`
--
ALTER TABLE `tipo_lente-orden_lente`
  MODIFY `id_tlol` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_marco`
--
ALTER TABLE `tipo_marco`
  MODIFY `id_tipo_marco` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_material`
--
ALTER TABLE `tipo_material`
  MODIFY `id_tipo_material` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_material-orden_lente`
--
ALTER TABLE `tipo_material-orden_lente`
  MODIFY `id_tmol` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `usuario_rol`
--
ALTER TABLE `usuario_rol`
  MODIFY `id_usuario-rol` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `concepto_cuenta`
--
ALTER TABLE `concepto_cuenta`
  ADD CONSTRAINT `concepto_cuenta_ibfk_1` FOREIGN KEY (`id_cuenta_cobrar`) REFERENCES `cuenta_cobrar` (`id_cuenta_cobrar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`id_jornada_trabajo`) REFERENCES `jornada_trabajo` (`id_jornada_trabajo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consulta_ibfk_2` FOREIGN KEY (`id_historia_clinica`) REFERENCES `historia_clinica` (`id_historia_clinica`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consulta-servicio`
--
ALTER TABLE `consulta-servicio`
  ADD CONSTRAINT `consulta-servicio_ibfk_1` FOREIGN KEY (`id_consulta`) REFERENCES `consulta` (`id_consulta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consulta-servicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cuenta_cobrar`
--
ALTER TABLE `cuenta_cobrar`
  ADD CONSTRAINT `cuenta_cobrar_ibfk_1` FOREIGN KEY (`id_historia_cuenta`) REFERENCES `historia_cuenta` (`id_historia_cuenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuenta_cobrar_ibfk_2` FOREIGN KEY (`id_plan_pago`) REFERENCES `plan_pago` (`id_plan_pago`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cuota`
--
ALTER TABLE `cuota`
  ADD CONSTRAINT `cuota_ibfk_1` FOREIGN KEY (`id_cuenta_cobrar`) REFERENCES `cuenta_cobrar` (`id_cuenta_cobrar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `desglose`
--
ALTER TABLE `desglose`
  ADD CONSTRAINT `FK_cuenta_desglose` FOREIGN KEY (`id_cuenta_cobrar`) REFERENCES `cuenta_cobrar` (`id_cuenta_cobrar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `examen_visual`
--
ALTER TABLE `examen_visual`
  ADD CONSTRAINT `examen_visual_ibfk_1` FOREIGN KEY (`id_consulta_servicio`) REFERENCES `consulta-servicio` (`id_consulta_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD CONSTRAINT `historia_clinica_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `historia_cuenta`
--
ALTER TABLE `historia_cuenta`
  ADD CONSTRAINT `historia_cuenta_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jornada_trabajo`
--
ALTER TABLE `jornada_trabajo`
  ADD CONSTRAINT `jornada_trabajo_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jornada_trabajo_ibfk_2` FOREIGN KEY (`id_jornada`) REFERENCES `jornada` (`id_jornada`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marco`
--
ALTER TABLE `marco`
  ADD CONSTRAINT `marco_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marco-tipo_marco`
--
ALTER TABLE `marco-tipo_marco`
  ADD CONSTRAINT `marco-tipo_marco_ibfk_1` FOREIGN KEY (`id_tipo_marco`) REFERENCES `tipo_marco` (`id_tipo_marco`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marco-tipo_marco_ibfk_2` FOREIGN KEY (`id_marco`) REFERENCES `marco` (`id_marco`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medidas_ojo`
--
ALTER TABLE `medidas_ojo`
  ADD CONSTRAINT `medidas_ojo_ibfk_1` FOREIGN KEY (`id_examen_visual`) REFERENCES `examen_visual` (`id_examen_visual`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orden_lente`
--
ALTER TABLE `orden_lente`
  ADD CONSTRAINT `orden_lente_ibfk_1` FOREIGN KEY (`id_cuenta_cobrar`) REFERENCES `cuenta_cobrar` (`id_cuenta_cobrar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_lente_ibfk_2` FOREIGN KEY (`id_marco`) REFERENCES `marco` (`id_marco`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `retinoscopia`
--
ALTER TABLE `retinoscopia`
  ADD CONSTRAINT `retinoscopia_ibfk_1` FOREIGN KEY (`id_consulta_servicio`) REFERENCES `consulta-servicio` (`id_consulta_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tipo_lente-orden_lente`
--
ALTER TABLE `tipo_lente-orden_lente`
  ADD CONSTRAINT `tipo_lente-orden_lente_ibfk_1` FOREIGN KEY (`id_tipo_lente`) REFERENCES `tipo_lente` (`id_tipo_lente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tipo_lente-orden_lente_ibfk_2` FOREIGN KEY (`id_orden_lente`) REFERENCES `orden_lente` (`id_orden_lente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tipo_material-orden_lente`
--
ALTER TABLE `tipo_material-orden_lente`
  ADD CONSTRAINT `tipo_material-orden_lente_ibfk_1` FOREIGN KEY (`id_orden_lente`) REFERENCES `orden_lente` (`id_orden_lente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tipo_material-orden_lente_ibfk_2` FOREIGN KEY (`id_tipo_material`) REFERENCES `tipo_material` (`id_tipo_material`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `usuario_rol_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
