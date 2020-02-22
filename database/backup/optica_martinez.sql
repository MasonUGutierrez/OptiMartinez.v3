-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2020 a las 22:55:14
-- Versión del servidor: 10.3.15-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `optica_martinez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto_cuenta`
--

CREATE TABLE `concepto_cuenta` (
  `id_concepto_cuenta` int(10) NOT NULL,
  `id_cuenta_cobrar` int(10) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
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
-- Estructura de tabla para la tabla `consulta-servicio`
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
-- Estructura de tabla para la tabla `cuenta_cobrar`
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
-- Estructura de tabla para la tabla `cuota`
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
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(10) NOT NULL,
  `departamento` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desglose`
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
-- Estructura de tabla para la tabla `examen_visual`
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
-- Estructura de tabla para la tabla `historia_clinica`
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
-- Estructura de tabla para la tabla `historia_cuenta`
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
-- Estructura de tabla para la tabla `jornada`
--

CREATE TABLE `jornada` (
  `id_jornada` int(10) NOT NULL,
  `tipo_jornada` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada_trabajo`
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
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(10) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `precio` int(10) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marco`
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
-- Estructura de tabla para la tabla `marco-tipo_marco`
--

CREATE TABLE `marco-tipo_marco` (
  `id_mtm` int(10) NOT NULL,
  `id_marco` int(10) NOT NULL,
  `id_tipo_marco` int(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas_ojo`
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
-- Estructura de tabla para la tabla `orden_lente`
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
-- Estructura de tabla para la tabla `paciente`
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
-- Estructura de tabla para la tabla `plan_pago`
--

CREATE TABLE `plan_pago` (
  `id_plan_pago` int(10) NOT NULL,
  `plan_pago` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retinoscopia`
--

CREATE TABLE `retinoscopia` (
  `id_retinoscopia` int(10) NOT NULL,
  `id_consulta_servicio` int(10) NOT NULL,
  `hallazgos` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(10) NOT NULL,
  `rol` varchar(25) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(10) NOT NULL,
  `servicio` varchar(30) NOT NULL,
  `precio` int(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_lente`
--

CREATE TABLE `tipo_lente` (
  `id_tipo_lente` int(10) NOT NULL,
  `tipo_lente` varchar(100) DEFAULT NULL,
  `precio` int(10) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_lente-orden_lente`
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
-- Estructura de tabla para la tabla `tipo_marco`
--

CREATE TABLE `tipo_marco` (
  `id_tipo_marco` int(10) NOT NULL,
  `tipo_marco` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_material`
--

CREATE TABLE `tipo_material` (
  `id_tipo_material` int(10) NOT NULL,
  `tipo_material` varchar(100) DEFAULT NULL,
  `precio` int(10) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_material-orden_lente`
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
-- Estructura de tabla para la tabla `usuario`
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
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `cod_minsa`, `nombre`, `apellido`, `cedula`, `telefono`, `correo`, `dir_foto`, `contraseña`, `descripcion`, `estado`) VALUES
(1, '123456789', 'mason', 'urbina', '0010503960016T', '88171183', 'msn.guti5395@outlook.com', NULL, 'mason123', 'ninguna', 1),
(2, '456789132', 'Carlos', 'Arroliga', '0012005970056D', '85612432', 'carlos@hotmail.com', NULL, 'carlos123', 'nada', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario-rol`
--

CREATE TABLE `usuario-rol` (
  `id_usuario-rol` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_rol` int(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `concepto_cuenta`
--
ALTER TABLE `concepto_cuenta`
  ADD PRIMARY KEY (`id_concepto_cuenta`),
  ADD KEY `id_cuenta_cobrar` (`id_cuenta_cobrar`);

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `id_jornada_trabajo` (`id_jornada_trabajo`),
  ADD KEY `id_historia_clinica` (`id_historia_clinica`);

--
-- Indices de la tabla `consulta-servicio`
--
ALTER TABLE `consulta-servicio`
  ADD PRIMARY KEY (`id_consulta_servicio`),
  ADD KEY `id_consulta` (`id_consulta`),
  ADD KEY `id_servicio` (`id_servicio`);

--
-- Indices de la tabla `cuenta_cobrar`
--
ALTER TABLE `cuenta_cobrar`
  ADD PRIMARY KEY (`id_cuenta_cobrar`),
  ADD KEY `id_historia_cuenta` (`id_historia_cuenta`),
  ADD KEY `id_plan_pago` (`id_plan_pago`);

--
-- Indices de la tabla `cuota`
--
ALTER TABLE `cuota`
  ADD PRIMARY KEY (`id_cuota`),
  ADD KEY `id_cuenta_cobrar` (`id_cuenta_cobrar`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`),
  ADD UNIQUE KEY `departamento` (`departamento`);

--
-- Indices de la tabla `desglose`
--
ALTER TABLE `desglose`
  ADD PRIMARY KEY (`id_desglose`),
  ADD KEY `FK_cuenta_desglose` (`id_cuenta_cobrar`);

--
-- Indices de la tabla `examen_visual`
--
ALTER TABLE `examen_visual`
  ADD PRIMARY KEY (`id_examen_visual`),
  ADD KEY `id_consulta_servicio` (`id_consulta_servicio`);

--
-- Indices de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD PRIMARY KEY (`id_historia_clinica`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `historia_cuenta`
--
ALTER TABLE `historia_cuenta`
  ADD PRIMARY KEY (`id_historia_cuenta`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `jornada`
--
ALTER TABLE `jornada`
  ADD PRIMARY KEY (`id_jornada`);

--
-- Indices de la tabla `jornada_trabajo`
--
ALTER TABLE `jornada_trabajo`
  ADD PRIMARY KEY (`id_jornada_trabajo`),
  ADD KEY `departamento_id_departamento` (`id_departamento`),
  ADD KEY `jornada_id_jornada` (`id_jornada`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`),
  ADD UNIQUE KEY `marca` (`marca`);

--
-- Indices de la tabla `marco`
--
ALTER TABLE `marco`
  ADD PRIMARY KEY (`id_marco`),
  ADD UNIQUE KEY `cod_marco` (`cod_marco`),
  ADD UNIQUE KEY `dirfoto` (`dir_foto`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `marco-tipo_marco`
--
ALTER TABLE `marco-tipo_marco`
  ADD PRIMARY KEY (`id_mtm`),
  ADD KEY `id_marco` (`id_marco`),
  ADD KEY `id_tipo_marco` (`id_tipo_marco`);

--
-- Indices de la tabla `medidas_ojo`
--
ALTER TABLE `medidas_ojo`
  ADD PRIMARY KEY (`id_medidas_ojo`),
  ADD KEY `id_examen_visual` (`id_examen_visual`);

--
-- Indices de la tabla `orden_lente`
--
ALTER TABLE `orden_lente`
  ADD PRIMARY KEY (`id_orden_lente`),
  ADD KEY `id_cuenta_cobrar` (`id_cuenta_cobrar`),
  ADD KEY `id_marco` (`id_marco`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id_paciente`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `plan_pago`
--
ALTER TABLE `plan_pago`
  ADD PRIMARY KEY (`id_plan_pago`);

--
-- Indices de la tabla `retinoscopia`
--
ALTER TABLE `retinoscopia`
  ADD PRIMARY KEY (`id_retinoscopia`),
  ADD KEY `id_consulta_servicio` (`id_consulta_servicio`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD UNIQUE KEY `servicio` (`servicio`);

--
-- Indices de la tabla `tipo_lente`
--
ALTER TABLE `tipo_lente`
  ADD PRIMARY KEY (`id_tipo_lente`),
  ADD UNIQUE KEY `tipo_lente` (`tipo_lente`);

--
-- Indices de la tabla `tipo_lente-orden_lente`
--
ALTER TABLE `tipo_lente-orden_lente`
  ADD PRIMARY KEY (`id_tlol`),
  ADD KEY `id_tipo_lente` (`id_tipo_lente`),
  ADD KEY `id_orden_lente` (`id_orden_lente`);

--
-- Indices de la tabla `tipo_marco`
--
ALTER TABLE `tipo_marco`
  ADD PRIMARY KEY (`id_tipo_marco`);

--
-- Indices de la tabla `tipo_material`
--
ALTER TABLE `tipo_material`
  ADD PRIMARY KEY (`id_tipo_material`),
  ADD UNIQUE KEY `tipo_material` (`tipo_material`);

--
-- Indices de la tabla `tipo_material-orden_lente`
--
ALTER TABLE `tipo_material-orden_lente`
  ADD PRIMARY KEY (`id_tmol`),
  ADD KEY `id_tipo_material` (`id_tipo_material`),
  ADD KEY `id_orden_lente` (`id_orden_lente`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cod_minsa` (`cod_minsa`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `usuario-rol`
--
ALTER TABLE `usuario-rol`
  ADD PRIMARY KEY (`id_usuario-rol`),
  ADD KEY `usuario_id_rol` (`id_usuario`),
  ADD KEY `rol_id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `concepto_cuenta`
--
ALTER TABLE `concepto_cuenta`
  MODIFY `id_concepto_cuenta` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id_consulta` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `consulta-servicio`
--
ALTER TABLE `consulta-servicio`
  MODIFY `id_consulta_servicio` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuenta_cobrar`
--
ALTER TABLE `cuenta_cobrar`
  MODIFY `id_cuenta_cobrar` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuota`
--
ALTER TABLE `cuota`
  MODIFY `id_cuota` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `desglose`
--
ALTER TABLE `desglose`
  MODIFY `id_desglose` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `examen_visual`
--
ALTER TABLE `examen_visual`
  MODIFY `id_examen_visual` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  MODIFY `id_historia_clinica` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historia_cuenta`
--
ALTER TABLE `historia_cuenta`
  MODIFY `id_historia_cuenta` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jornada`
--
ALTER TABLE `jornada`
  MODIFY `id_jornada` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jornada_trabajo`
--
ALTER TABLE `jornada_trabajo`
  MODIFY `id_jornada_trabajo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marco`
--
ALTER TABLE `marco`
  MODIFY `id_marco` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marco-tipo_marco`
--
ALTER TABLE `marco-tipo_marco`
  MODIFY `id_mtm` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medidas_ojo`
--
ALTER TABLE `medidas_ojo`
  MODIFY `id_medidas_ojo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_lente`
--
ALTER TABLE `orden_lente`
  MODIFY `id_orden_lente` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id_paciente` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan_pago`
--
ALTER TABLE `plan_pago`
  MODIFY `id_plan_pago` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `retinoscopia`
--
ALTER TABLE `retinoscopia`
  MODIFY `id_retinoscopia` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_lente`
--
ALTER TABLE `tipo_lente`
  MODIFY `id_tipo_lente` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_lente-orden_lente`
--
ALTER TABLE `tipo_lente-orden_lente`
  MODIFY `id_tlol` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_marco`
--
ALTER TABLE `tipo_marco`
  MODIFY `id_tipo_marco` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_material`
--
ALTER TABLE `tipo_material`
  MODIFY `id_tipo_material` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_material-orden_lente`
--
ALTER TABLE `tipo_material-orden_lente`
  MODIFY `id_tmol` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario-rol`
--
ALTER TABLE `usuario-rol`
  MODIFY `id_usuario-rol` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `concepto_cuenta`
--
ALTER TABLE `concepto_cuenta`
  ADD CONSTRAINT `concepto_cuenta_ibfk_1` FOREIGN KEY (`id_cuenta_cobrar`) REFERENCES `cuenta_cobrar` (`id_cuenta_cobrar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`id_jornada_trabajo`) REFERENCES `jornada_trabajo` (`id_jornada_trabajo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consulta_ibfk_2` FOREIGN KEY (`id_historia_clinica`) REFERENCES `historia_clinica` (`id_historia_clinica`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `consulta-servicio`
--
ALTER TABLE `consulta-servicio`
  ADD CONSTRAINT `consulta-servicio_ibfk_1` FOREIGN KEY (`id_consulta`) REFERENCES `consulta` (`id_consulta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consulta-servicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuenta_cobrar`
--
ALTER TABLE `cuenta_cobrar`
  ADD CONSTRAINT `cuenta_cobrar_ibfk_1` FOREIGN KEY (`id_historia_cuenta`) REFERENCES `historia_cuenta` (`id_historia_cuenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuenta_cobrar_ibfk_2` FOREIGN KEY (`id_plan_pago`) REFERENCES `plan_pago` (`id_plan_pago`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuota`
--
ALTER TABLE `cuota`
  ADD CONSTRAINT `cuota_ibfk_1` FOREIGN KEY (`id_cuenta_cobrar`) REFERENCES `cuenta_cobrar` (`id_cuenta_cobrar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `desglose`
--
ALTER TABLE `desglose`
  ADD CONSTRAINT `FK_cuenta_desglose` FOREIGN KEY (`id_cuenta_cobrar`) REFERENCES `cuenta_cobrar` (`id_cuenta_cobrar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `examen_visual`
--
ALTER TABLE `examen_visual`
  ADD CONSTRAINT `examen_visual_ibfk_1` FOREIGN KEY (`id_consulta_servicio`) REFERENCES `consulta-servicio` (`id_consulta_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historia_clinica`
--
ALTER TABLE `historia_clinica`
  ADD CONSTRAINT `historia_clinica_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historia_cuenta`
--
ALTER TABLE `historia_cuenta`
  ADD CONSTRAINT `historia_cuenta_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jornada_trabajo`
--
ALTER TABLE `jornada_trabajo`
  ADD CONSTRAINT `jornada_trabajo_ibfk_1` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jornada_trabajo_ibfk_2` FOREIGN KEY (`id_jornada`) REFERENCES `jornada` (`id_jornada`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `marco`
--
ALTER TABLE `marco`
  ADD CONSTRAINT `marco_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `marco-tipo_marco`
--
ALTER TABLE `marco-tipo_marco`
  ADD CONSTRAINT `marco-tipo_marco_ibfk_1` FOREIGN KEY (`id_tipo_marco`) REFERENCES `tipo_marco` (`id_tipo_marco`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `marco-tipo_marco_ibfk_2` FOREIGN KEY (`id_marco`) REFERENCES `marco` (`id_marco`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medidas_ojo`
--
ALTER TABLE `medidas_ojo`
  ADD CONSTRAINT `medidas_ojo_ibfk_1` FOREIGN KEY (`id_examen_visual`) REFERENCES `examen_visual` (`id_examen_visual`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_lente`
--
ALTER TABLE `orden_lente`
  ADD CONSTRAINT `orden_lente_ibfk_1` FOREIGN KEY (`id_cuenta_cobrar`) REFERENCES `cuenta_cobrar` (`id_cuenta_cobrar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_lente_ibfk_2` FOREIGN KEY (`id_marco`) REFERENCES `marco` (`id_marco`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `retinoscopia`
--
ALTER TABLE `retinoscopia`
  ADD CONSTRAINT `retinoscopia_ibfk_1` FOREIGN KEY (`id_consulta_servicio`) REFERENCES `consulta-servicio` (`id_consulta_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipo_lente-orden_lente`
--
ALTER TABLE `tipo_lente-orden_lente`
  ADD CONSTRAINT `tipo_lente-orden_lente_ibfk_1` FOREIGN KEY (`id_tipo_lente`) REFERENCES `tipo_lente` (`id_tipo_lente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tipo_lente-orden_lente_ibfk_2` FOREIGN KEY (`id_orden_lente`) REFERENCES `orden_lente` (`id_orden_lente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipo_material-orden_lente`
--
ALTER TABLE `tipo_material-orden_lente`
  ADD CONSTRAINT `tipo_material-orden_lente_ibfk_1` FOREIGN KEY (`id_orden_lente`) REFERENCES `orden_lente` (`id_orden_lente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tipo_material-orden_lente_ibfk_2` FOREIGN KEY (`id_tipo_material`) REFERENCES `tipo_material` (`id_tipo_material`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario-rol`
--
ALTER TABLE `usuario-rol`
  ADD CONSTRAINT `usuario-rol_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario-rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
