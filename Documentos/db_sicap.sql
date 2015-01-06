-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 31-10-2014 a las 12:21:26
-- Versión del servidor: 5.5.38
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_sicap`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bien_metros_departamento`
--

CREATE TABLE IF NOT EXISTS `bien_metros_departamento` (
`codigo` int(11) NOT NULL,
  `codigo_departamento` int(11) NOT NULL,
  `codigo_tipo_activo_principal` int(11) NOT NULL,
  `metros` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `bien_metros_departamento`
--

INSERT INTO `bien_metros_departamento` (`codigo`, `codigo_departamento`, `codigo_tipo_activo_principal`, `metros`, `eliminado`) VALUES
(1, 14, 3, '3', '2014-09-10'),
(2, 14, 3, '3', '2014-09-10'),
(3, 14, 3, '3', '2014-09-10'),
(4, 14, 3, '3', 'n'),
(5, 18, 3, '10', 'n'),
(6, 30, 3, '1', 'n'),
(7, 24, 3, '20', '2014-09-10'),
(8, 25, 3, '100', '2014-09-10'),
(9, 42, 3, '36', '2014-09-10'),
(10, 37, 3, '2', 'n'),
(11, 7, 3, '50', '2014-09-10'),
(12, 40, 3, '34', 'n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_asignaciones`
--

CREATE TABLE IF NOT EXISTS `bie_asignaciones` (
`codigo` int(11) NOT NULL,
  `codigo_bien` int(11) NOT NULL,
  `codigo_trabajador` int(11) NOT NULL,
  `codigo_tipo_bien` int(11) NOT NULL,
  `fecha_asignacion` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_culminacion` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `desasignado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `bie_asignaciones`
--

INSERT INTO `bie_asignaciones` (`codigo`, `codigo_bien`, `codigo_trabajador`, `codigo_tipo_bien`, `fecha_asignacion`, `fecha_culminacion`, `desasignado`, `eliminado`) VALUES
(1, 4, 15, 1, '2014-09-12', '2014-09-11', 'n', '2014-09-12'),
(2, 4, 28, 1, '2014-09-12', '2014-09-11', 's', 'n'),
(6, 4, 28, 1, '2014-09-12', '2014-09-12', 's', 'n'),
(7, 4, 25, 1, '2014-09-13', '2014-09-12', 's', 'n'),
(11, 5, 18, 2, '2014-09-13', '2014-09-13', 'n', 'n'),
(12, 2, 28, 3, '2014-09-15', '2014-09-15', 'n', 'n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_mantenimiento`
--

CREATE TABLE IF NOT EXISTS `bie_mantenimiento` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_tipo_medida` int(11) NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `codigo_tipo_bien` int(11) NOT NULL,
  `periodicidad` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `bie_mantenimiento`
--

INSERT INTO `bie_mantenimiento` (`codigo`, `nombre`, `codigo_tipo_medida`, `eliminado`, `codigo_tipo_bien`, `periodicidad`) VALUES
(3, 'Cambio de aceite', 1, 'n', 1, '4'),
(4, 'camino', 3, '2014-09-15', 1, '4'),
(5, 'arrazar2', 9, 'n', 1, '7'),
(6, 'ejmeplo2', 8, 'n', 2, '1'),
(7, 'tiburon2', 2, 'n', 1, '46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_realizar_mantenimiento`
--

CREATE TABLE IF NOT EXISTS `bie_realizar_mantenimiento` (
`codigo` int(11) NOT NULL,
  `codigo_bien` int(11) NOT NULL,
  `codigo_bien_tipo` int(11) NOT NULL,
  `codigo_mantenimiento` int(11) NOT NULL,
  `codigo_contable` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `numero_factura` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `costo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `medida_especial` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `fecha` varchar(12) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `bie_realizar_mantenimiento`
--

INSERT INTO `bie_realizar_mantenimiento` (`codigo`, `codigo_bien`, `codigo_bien_tipo`, `codigo_mantenimiento`, `codigo_contable`, `numero_factura`, `costo`, `medida_especial`, `eliminado`, `fecha`) VALUES
(1, 4, 4, 6, 'fff', 'fff', '40', '40', 'n', ''),
(2, 3, 1, 7, 'gg', 'gg', '34', '', '2014-09-18', ''),
(3, 3, 1, 7, 'ff-ff', '22fdf', '2300', '', 'n', '2014-09-19'),
(4, 3, 1, 7, 'ff-ff', '22fdf', '1', '', 'n', '2014-09-20'),
(5, 4, 1, 3, 'ffff', 'fff', '2', '', 'n', '2014-09-19'),
(6, 4, 4, 6, 'fgg.f', 'er43d', '1500', '1', 'n', '2014-09-19'),
(7, 4, 4, 6, '123', '1', '1', '1', 'n', '2010-01-19'),
(8, 4, 4, 7, '3323', '212', '3000', '', 'n', '2014-09-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_revicion_diaria_vhiculo`
--

CREATE TABLE IF NOT EXISTS `bie_revicion_diaria_vhiculo` (
`codigo` int(11) NOT NULL,
  `cod_vehiculo` int(11) DEFAULT NULL,
  `agua` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aceite` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filtro` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caucho` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `frenos` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kilometros` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci DEFAULT 'n',
  `fecha` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `bie_revicion_diaria_vhiculo`
--

INSERT INTO `bie_revicion_diaria_vhiculo` (`codigo`, `cod_vehiculo`, `agua`, `aceite`, `filtro`, `caucho`, `frenos`, `kilometros`, `observacion`, `eliminado`, `fecha`) VALUES
(3, 2, '1', '1', '1', '1', '1', '10', '\r\n                                        ', '2014-09-16', '2014-09-16'),
(4, 2, '2', '1', '1', '1', '1', '3', '12\r\n                                        ', 'n', '2014-09-16'),
(5, 2, '1', '1', '1', '1', '1', '102', '\r\n                                        ', '2014-09-16', '2014-09-16'),
(6, 0, '', '', '', '', '', '0', '', 'n', '2014-10-22'),
(7, 0, '', '', '', '', '', '0', '', 'n', '2014-10-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_rutas`
--

CREATE TABLE IF NOT EXISTS `bie_rutas` (
`codigo` int(11) NOT NULL,
  `origen_codigo_google` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `origen_estado` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `origen_ciudad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `origen_zona` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `distancia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `origen_latitud` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `origen_longitud` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `llegada_codigo_google` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `llegada_estado` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `llegada_ciudad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `llegada_zona` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `llegada_latitud` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `llegada_longitud` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `bie_rutas`
--

INSERT INTO `bie_rutas` (`codigo`, `origen_codigo_google`, `origen_estado`, `origen_ciudad`, `origen_zona`, `distancia`, `origen_latitud`, `origen_longitud`, `llegada_codigo_google`, `llegada_estado`, `llegada_ciudad`, `llegada_zona`, `llegada_latitud`, `llegada_longitud`, `eliminado`) VALUES
(3, 'Carora, Venezuela', 'lara', 'carora', '', '82.6', '10.1730588', '-70.0800863', 'Barquisimeto, Venezuela', 'lara', 'barquisimeto', '', '10.063611', '-69.334722', '2014-09-14'),
(4, 'Cabimas, Venezuela', 'zulia', 'cabimas', '', '32.5', '10.3895862', '-71.46928430000003', 'Maracaibo, Venezuela', 'zulia', 'maracaibo', '', '10.633333', '-71.633333', 'n'),
(5, 'Prados de Occidente, Barquisimeto 3001, Venezuela', 'lara', 'barquisimeto', 'prados de occidente', '9.2', '10.0464217', '-69.416629', 'Barquisimeto, Venezuela', 'lara', 'barquisimeto', 'avenida lara', '10.063611', '-69.334722', 'n'),
(6, 'Barquisimeto, Venezuela', 'lara ', 'barquisimeto', '', '146.8', '10.063611', '-69.334722', 'Valencia, Venezuela', 'carabobo', 'valencia', '', '10.1579312', '-67.99721039999997', 'n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_tipo_activo_principal`
--

CREATE TABLE IF NOT EXISTS `bie_tipo_activo_principal` (
`codigo` int(11) NOT NULL,
  `nombre_bien` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_contable` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vida_util` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_adquisicion` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `costo_adquisicion` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `valor_rescate` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `monto_depreciar` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_depreciacion` int(11) NOT NULL,
  `valor_mercado` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `valor_actualizado` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `mts_edificacion` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `tipo` int(11) NOT NULL DEFAULT '4'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `bie_tipo_activo_principal`
--

INSERT INTO `bie_tipo_activo_principal` (`codigo`, `nombre_bien`, `codigo_alias`, `codigo_contable`, `vida_util`, `fecha_adquisicion`, `costo_adquisicion`, `valor_rescate`, `monto_depreciar`, `codigo_depreciacion`, `valor_mercado`, `valor_actualizado`, `mts_edificacion`, `eliminado`, `tipo`) VALUES
(3, 'central principal', '33--33', '43', '50', '2014-09-10', '400000', '30000', '3000', 1, '60000', '80000', '50', '2014-09-10', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_tipo_basico`
--

CREATE TABLE IF NOT EXISTS `bie_tipo_basico` (
`codigo` int(11) NOT NULL,
  `nombre_bien` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_contable` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_departamento` int(11) NOT NULL,
  `vida_util` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_adquisicion` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `costo_adquisicion` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `valor_rescate` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `monto_depreciar` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_depreciacion` int(11) NOT NULL,
  `valor_mercado` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `valor_actualizado` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci DEFAULT 'n',
  `tipo` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `bie_tipo_basico`
--

INSERT INTO `bie_tipo_basico` (`codigo`, `nombre_bien`, `codigo_alias`, `codigo_contable`, `codigo_departamento`, `vida_util`, `fecha_adquisicion`, `costo_adquisicion`, `valor_rescate`, `monto_depreciar`, `codigo_depreciacion`, `valor_mercado`, `valor_actualizado`, `eliminado`, `tipo`) VALUES
(3, 'ds', 'd', 'd', 35, '2', '2014-09-10', '2', '2', '2', 1, '2', '2', 'n', 1),
(4, 'computadora', '33-43', 'ssad', 20, '10', '2014-09-12', '20000', '20000', '20000', 1, '25000', '26000', 'n', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_tipo_bien`
--

CREATE TABLE IF NOT EXISTS `bie_tipo_bien` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `bie_tipo_bien`
--

INSERT INTO `bie_tipo_bien` (`codigo`, `nombre`) VALUES
(1, 'Básico'),
(2, 'Maquinaria'),
(3, 'Vehículo'),
(4, 'Activo Principal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_tipo_depreciacion`
--

CREATE TABLE IF NOT EXISTS `bie_tipo_depreciacion` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bie_tipo_depreciacion`
--

INSERT INTO `bie_tipo_depreciacion` (`codigo`, `nombre`) VALUES
(1, 'Linea Recta'),
(2, 'Unidades Producidas'),
(3, 'Ktms. Recoridos'),
(4, 'Digito Creciente'),
(5, 'Digito Creciente'),
(6, '% Fijo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_tipo_licencia`
--

CREATE TABLE IF NOT EXISTS `bie_tipo_licencia` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bie_tipo_licencia`
--

INSERT INTO `bie_tipo_licencia` (`codigo`, `nombre`) VALUES
(1, 'Tercera'),
(2, 'Cuarta'),
(3, 'Quinta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_tipo_maquinaria`
--

CREATE TABLE IF NOT EXISTS `bie_tipo_maquinaria` (
`codigo` int(11) NOT NULL,
  `nombre_bien` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_contable` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_departamento` int(11) NOT NULL,
  `vida_util` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_adquisicion` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `costo_adquisicion` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `valor_rescate` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `monto_depreciar` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_depreciacion` int(11) NOT NULL,
  `unidades_producidas` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `valor_mercado` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `valor_actualizado` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `tipo` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `bie_tipo_maquinaria`
--

INSERT INTO `bie_tipo_maquinaria` (`codigo`, `nombre_bien`, `codigo_alias`, `codigo_contable`, `codigo_departamento`, `vida_util`, `fecha_adquisicion`, `costo_adquisicion`, `valor_rescate`, `monto_depreciar`, `codigo_depreciacion`, `unidades_producidas`, `valor_mercado`, `valor_actualizado`, `eliminado`, `tipo`) VALUES
(1, 'ffff', 'fff', 'fff', 18, '3', '2014-09-09', '3', '3', '3', 3, '34', '34', '34', '2014-09-10', 2),
(2, 'maquina', 'codigo', 'codigo_contable', 29, '1', '2014-09-10', '1', '1', '1', 3, '1', '1', '1', '2014-09-10', 2),
(3, '1', '1', '1', 35, '1', '2014-09-10', '1', '1', '1', 1, '1', '1', '1', '2014-09-10', 2),
(4, '2', '2', '2', 28, '2', '2014-09-10', '2', '2', '2', 1, '2', '2', '2', 'n', 2),
(5, 'carro', '', 'sad', 17, '50', '2014-09-13', '50', '70', '70', 2, '34', '43', '32', 'n', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_tipo_vehiculo`
--

CREATE TABLE IF NOT EXISTS `bie_tipo_vehiculo` (
`codigo` int(11) NOT NULL,
  `nombre_bien` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_contable` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_departamento` int(11) NOT NULL,
  `vida_util` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_adquisicion` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `costo_adquisicion` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `valor_rescate` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `monto_depreciar` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_depreciacion` int(11) NOT NULL,
  `kilometros` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `modelo_vehculo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `marca_vehculo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_vehculo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `placa_vehculo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `serial_vehculo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_licencia` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `valor_mercado` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `valor_actualizado` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `tipo` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `bie_tipo_vehiculo`
--

INSERT INTO `bie_tipo_vehiculo` (`codigo`, `nombre_bien`, `codigo_alias`, `codigo_contable`, `codigo_departamento`, `vida_util`, `fecha_adquisicion`, `costo_adquisicion`, `valor_rescate`, `monto_depreciar`, `codigo_depreciacion`, `kilometros`, `modelo_vehculo`, `marca_vehculo`, `tipo_vehculo`, `placa_vehculo`, `serial_vehculo`, `tipo_licencia`, `valor_mercado`, `valor_actualizado`, `eliminado`, `tipo`) VALUES
(1, '1', '1', '1', 18, '1', '2014-09-10', '1', '1', '1', 4, '11', '1', '1', '1', '1', '1', '2', '1', '1', '2014-09-10', 3),
(2, 'caprice', '44-44', '4343-343', 7, '20', '2014-09-15', '40000', '40000', '40000', 3, '123', 'caprice', 'ford', 'sedan', '44-5454', 'ssdd--4454545', '1', '50000', '50000', 'n', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_unidad_medida`
--

CREATE TABLE IF NOT EXISTS `bie_unidad_medida` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `sigla` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `bie_unidad_medida`
--

INSERT INTO `bie_unidad_medida` (`codigo`, `nombre`, `sigla`) VALUES
(1, 'Kilometros', 'km'),
(2, 'Horas', 'H'),
(3, 'Semestre', 'Semestre'),
(4, 'Semana', 'Semana'),
(7, 'Unidades', 'Unidades'),
(8, 'Año', 'Año'),
(9, 'Días', 'Días');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cob_disminucion`
--

CREATE TABLE IF NOT EXISTS `cob_disminucion` (
`codigo` int(11) NOT NULL,
  `codigo_empleado` int(11) NOT NULL,
  `monto_factura` varchar(16) NOT NULL,
  `monto` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cob_facturas`
--

CREATE TABLE IF NOT EXISTS `cob_facturas` (
`codigo` int(11) NOT NULL,
  `codigo_empleado` int(11) NOT NULL,
  `monto_factura` varchar(16) NOT NULL,
  `estatus_factura` varchar(16) NOT NULL,
  `monto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_general`
--

CREATE TABLE IF NOT EXISTS `configuracion_general` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `configuracion_general`
--

INSERT INTO `configuracion_general` (`codigo`, `nombre`, `valor`) VALUES
(1, 'diferencia_de_salario', 'si'),
(2, 'bono_antiguedad_fijo', 'no'),
(3, 'anhio_servicios_fijo', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cos_detalle_erogaciones`
--

CREATE TABLE IF NOT EXISTS `cos_detalle_erogaciones` (
`codigo` int(11) NOT NULL,
  `codigo_departamento` int(11) DEFAULT NULL,
  `cuenta_contable` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_erogacion` int(11) DEFAULT NULL,
  `eliminado` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'n',
  `fecha` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `costo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `cos_detalle_erogaciones`
--

INSERT INTO `cos_detalle_erogaciones` (`codigo`, `codigo_departamento`, `cuenta_contable`, `codigo_erogacion`, `eliminado`, `fecha`, `costo`) VALUES
(1, 17, 'ff-ddd', 2, '2014-09-05', '2014-09-05', '150'),
(2, 18, 'gg', 1, 'n', '2014-09-05', '5'),
(3, 25, 'hh.hh', 2, 'n', '2014-09-07', '1000'),
(4, 32, 'ffgg', 1, 'n', '2014-09-07', '2000'),
(5, 19, '12221', 1, 'n', '2014-09-07', '123000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cos_erogaciones`
--

CREATE TABLE IF NOT EXISTS `cos_erogaciones` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desactivo` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'n'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cos_erogaciones`
--

INSERT INTO `cos_erogaciones` (`codigo`, `nombre`, `desactivo`) VALUES
(0, 'agua', 'n'),
(1, 'da1', 'n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_backup_mensual`
--

CREATE TABLE IF NOT EXISTS `mco_backup_mensual` (
`codigo` int(11) NOT NULL,
  `mes` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ano` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `respaldo_fecha` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ultimo` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `mco_backup_mensual`
--

INSERT INTO `mco_backup_mensual` (`codigo`, `mes`, `ano`, `respaldo_fecha`, `ultimo`) VALUES
(1, '8', '2014', '00-00-00', 'n'),
(8, '8', '2014', '2014-09-04', 'n'),
(9, '9', '2014', '2014-09-05', 'n'),
(10, '10', '2014', '2014-10-06', 's');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_dias_feriados`
--

CREATE TABLE IF NOT EXISTS `mco_dias_feriados` (
`codigo` int(11) NOT NULL,
  `mes` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dia` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `mco_dias_feriados`
--

INSERT INTO `mco_dias_feriados` (`codigo`, `mes`, `dia`, `nombre`) VALUES
(1, 'Enero', '1', 'Año Nuevo'),
(2, 'Abril', '19', 'Declaración de la Independencia'),
(3, 'Mayo', '1', 'Día del Trabajador'),
(4, 'Mayo', '1', 'Día del Trabajador'),
(5, 'junio', '24', 'Aniversario de la Batalla de Carabobo'),
(6, 'junio', '24', 'Día de la Independencia'),
(7, 'junio', '24', 'Aniversario de la Batalla de Carabobo'),
(8, 'junio', '24', 'Día de la Independencia'),
(9, '7', '24', 'Natalicio de Simón Bolívar'),
(10, '7', '24', 'Natalicio de Simón Bolívar'),
(11, '10', '12', 'Día de la Resistencia Indígena'),
(12, '10', '12', 'Día de la Resistencia Indígena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_efectuar_dotacion_uniforme`
--

CREATE TABLE IF NOT EXISTS `mco_efectuar_dotacion_uniforme` (
`codigo` int(11) NOT NULL,
  `fecha` varchar(12) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `mco_efectuar_dotacion_uniforme`
--

INSERT INTO `mco_efectuar_dotacion_uniforme` (`codigo`, `fecha`) VALUES
(2, '2014-02-11'),
(3, '2014-10-10'),
(4, '1999-10-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_empresa`
--

CREATE TABLE IF NOT EXISTS `mco_empresa` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `nombre_largo` varchar(45) NOT NULL,
  `rif` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `fax` varchar(45) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `mco_empresa`
--

INSERT INTO `mco_empresa` (`codigo`, `nombre`, `nombre_largo`, `rif`, `direccion`, `telefono`, `fax`) VALUES
(1, 'Silys, C.A.', 'Colchones Silys, C.A.', 'j-30598122-1', 'Zona industrial 2 Entre Carrera 23 y 24', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_forma_pago`
--

CREATE TABLE IF NOT EXISTS `mco_forma_pago` (
`codigo` int(11) NOT NULL COMMENT 'esta es para tener guardado la configuracion de las formas pagadas a los bonos',
  `nombre` varchar(45) DEFAULT NULL,
  `eliminado` varchar(12) DEFAULT 'no'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `mco_forma_pago`
--

INSERT INTO `mco_forma_pago` (`codigo`, `nombre`, `eliminado`) VALUES
(0, 'Monto Fijo', 'no'),
(1, '% Salario Base', 'no'),
(2, '% Salario Normal', 'no'),
(3, '% Salario Integral', 'no'),
(4, 'Unidad Tributaria', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_formulaconcepto`
--

CREATE TABLE IF NOT EXISTS `mco_formulaconcepto` (
`codigo` int(11) NOT NULL,
  `codigoconcepto` varchar(8) DEFAULT NULL,
  `formula` varchar(200) DEFAULT NULL,
  `asignacion` varchar(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

--
-- Volcado de datos para la tabla `mco_formulaconcepto`
--

INSERT INTO `mco_formulaconcepto` (`codigo`, `codigoconcepto`, `formula`, `asignacion`) VALUES
(98, '101', '( c$SUE )', NULL),
(99, '102', '( c$BONX )', NULL),
(100, '103', '( c$BONY )', NULL),
(101, '104', '( c$BNOC )', NULL),
(102, '105', '( c$SAN )', NULL),
(104, '106', '( ( ( c$SAN / c$DME ) + ( ( c$SAN / c$DME ) * c$PHED ) )', NULL),
(106, '107', '( ( ( ( c$SAN / c$DME ) + ( ( c$SAN / c$DME ) * c$PHED ) ) + (  ( ( ( c$SAN / c$DME ) + ( ( c$SAN / c$DME ) * c$PHED ) ) * c$PHEN ) )', NULL),
(107, '108', '( c$PRIHIJ )', NULL),
(108, '109', '( c$PRIHOG )', NULL),
(109, '110', '( c$PRIVEH )', NULL),
(110, '111', '( ( c$CDA / c$DME ) * ( c$CDA / c$MES ) )', NULL),
(111, '112', '( c$CDA )', NULL),
(112, '113', '( c$DLA )', NULL),
(113, '114', '( c$DFE / c$DME )', NULL),
(114, '115', '( ( c$VAC / c$DME ) * ( c$VAC / c$MES ) )', NULL),
(115, '116', '( c$UTI / c$DIAA )', NULL),
(116, '117', '( c$DAG / c$DIAA )', NULL),
(117, '118', '( c$VEN * c$PCO )', NULL),
(118, '119', '( c$SIN )', NULL),
(119, '120', '( ( c$UBON / c$DME ) * c$CBN )', NULL),
(120, '121', '( c$SIND / c$DME )', NULL),
(121, '122', '( ( c$DPV / c$DME ) * ( c$DBV / c$MES ) )', NULL),
(122, '123', '( ( c$CPU / c$DME ) * c$DPS )', NULL),
(123, '124', '( c$TSI / c$MES )', NULL),
(124, '125', '( c$SSO * c$CSS )', NULL),
(125, '126', '( c$PIE * c$CPI )', NULL),
(126, '127', '( c$BAN )', NULL),
(127, '128', '( c$INC )', NULL),
(128, '129', '( c$SID )', NULL),
(129, '130', '( c$GNA * c$LDD )', NULL),
(130, '131', '( p$PLD / c$NTR )', NULL),
(131, '132', '( c$CAN )', NULL),
(132, '133', '( c$CAN )', NULL),
(133, '134', '( ( c$OBLUTI * c$UTR ) / c$MES )', NULL),
(134, '135', '( ( c$OBLJUG * c$UTR ) / c$MES )', NULL),
(135, '136', '( c$OBLBPH )', NULL),
(136, '137', '( ( c$OBLDNI * c$UTR ) / c$MES )', NULL),
(137, '138', '( c$OBLBPT )', NULL),
(138, '139', '( c$OBLGUA )', NULL),
(139, '140', '( ( c$OBLTRA / c$NTR ) / c$MES )', NULL),
(140, '141', '( ( c$OBLNIN / c$NTR ) / c$MES )', NULL),
(141, '142', '( c$OBLOFA / c$MES )', NULL),
(142, '143', '( c$OBLDUN / c$SMM )', NULL),
(143, '144', '( c$OBLASI / c$MES )', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_montoconstante`
--

CREATE TABLE IF NOT EXISTS `mco_montoconstante` (
`codigo` int(11) NOT NULL,
  `codigoconstante` int(11) DEFAULT NULL,
  `monto` varchar(150) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

--
-- Volcado de datos para la tabla `mco_montoconstante`
--

INSERT INTO `mco_montoconstante` (`codigo`, `codigoconstante`, `monto`) VALUES
(84, 64, '1'),
(85, 65, '1'),
(86, 66, '60'),
(87, 67, '1453215'),
(88, 68, '0.09'),
(89, 69, '0.02'),
(90, 70, '0.02'),
(91, 71, '0.01'),
(92, 72, '0.02'),
(93, 73, '5.16'),
(94, 74, '20'),
(95, 75, '40'),
(96, 76, '0.16'),
(97, 77, '4252'),
(98, 78, '5'),
(99, 79, '0.30'),
(100, 80, '0.25'),
(101, 81, '500000'),
(102, 82, '0.01'),
(103, 83, '30'),
(104, 84, '7'),
(105, 85, '1'),
(106, 86, '1'),
(107, 87, '8'),
(108, 88, '7.5'),
(109, 89, '7'),
(110, 90, '1'),
(111, 91, '0.50'),
(112, 92, '0.30'),
(113, 93, '8'),
(114, 94, '127'),
(115, 95, '1.3'),
(116, 96, '1'),
(117, 97, '0.01'),
(118, 98, '0.05'),
(119, 99, '0.1'),
(120, 100, '1'),
(121, 101, '12'),
(122, 102, '1'),
(123, 103, '1.5'),
(124, 104, '1'),
(125, 105, '360'),
(126, 106, '1'),
(127, 107, '1'),
(128, 108, '1'),
(129, 109, '0.230769230769231'),
(130, 110, '0.230769230769231'),
(131, 111, '1'),
(132, 113, '100'),
(133, 114, '0.1'),
(134, 115, '0.1'),
(135, 116, '0.1'),
(136, 117, '1'),
(137, 118, '1'),
(139, 120, '0.1'),
(140, 121, '0.1'),
(141, 122, '0.1'),
(142, 123, '1'),
(143, 124, '20000'),
(144, 125, '20000'),
(145, 126, '3500'),
(146, 127, '3500'),
(147, 128, '6'),
(148, 129, '7500'),
(149, 130, '600'),
(150, 131, '1'),
(151, 132, '1'),
(152, 133, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_organigrama`
--

CREATE TABLE IF NOT EXISTS `mco_organigrama` (
`codigo` int(11) NOT NULL,
  `codigo_alias` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `codigo_depende` int(11) DEFAULT NULL,
  `profundidad` varchar(6) DEFAULT NULL,
  `nombre_depende` varchar(45) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `mco_organigrama`
--

INSERT INTO `mco_organigrama` (`codigo`, `codigo_alias`, `descripcion`, `codigo_depende`, `profundidad`, `nombre_depende`) VALUES
(1, 'Junta Directiva', 'Junta Directiva', 0, '', ''),
(2, 'PRESIDEN', 'Presidecia', 1, '1', 'Junta Directiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_periocidad`
--

CREATE TABLE IF NOT EXISTS `mco_periocidad` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `eliminado` varchar(12) DEFAULT 'no'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `mco_periocidad`
--

INSERT INTO `mco_periocidad` (`codigo`, `nombre`, `eliminado`) VALUES
(0, 'Mes', 'no'),
(1, 'Quinceal', 'no'),
(2, 'Mensual', 'no'),
(3, 'Bimestral', 'no'),
(4, 'Trimestral', 'no'),
(5, 'Cuatrmestral', 'no'),
(6, 'Semestral', 'no'),
(7, 'Anual', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_razon_social`
--

CREATE TABLE IF NOT EXISTS `mco_razon_social` (
`codigo` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_tabulador_anhio_servicio`
--

CREATE TABLE IF NOT EXISTS `mco_tabulador_anhio_servicio` (
  `codigo` int(11) NOT NULL,
  `paso` varchar(4) NOT NULL,
  `referencia` varchar(45) NOT NULL,
  `valor` varchar(4) NOT NULL,
  `cola` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mco_tabulador_anhio_servicio`
--

INSERT INTO `mco_tabulador_anhio_servicio` (`codigo`, `paso`, `referencia`, `valor`, `cola`) VALUES
(0, '0', '100', '50', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_tabulador_antiguedad`
--

CREATE TABLE IF NOT EXISTS `mco_tabulador_antiguedad` (
`codigo` int(11) NOT NULL,
  `paso` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `referencia` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `cola` varchar(4) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `mco_tabulador_antiguedad`
--

INSERT INTO `mco_tabulador_antiguedad` (`codigo`, `paso`, `referencia`, `valor`, `cola`) VALUES
(1, '1', '3', '300', ''),
(2, '3', '6', '500', ''),
(3, '6', '9', '700', ''),
(4, '9', '12', '900', ''),
(5, '12', '15', '1100', ''),
(6, '15', '100', '1300', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_tabulador_nuevo_bonos_produccion`
--

CREATE TABLE IF NOT EXISTS `mco_tabulador_nuevo_bonos_produccion` (
`codigo` int(11) NOT NULL,
  `paso` varchar(4) DEFAULT NULL,
  `referencia` varchar(4) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `cola` varchar(4) DEFAULT NULL,
  `eliminado` varchar(12) DEFAULT 'no',
  `codigo_bono` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `mco_tabulador_nuevo_bonos_produccion`
--

INSERT INTO `mco_tabulador_nuevo_bonos_produccion` (`codigo`, `paso`, `referencia`, `valor`, `cola`, `eliminado`, `codigo_bono`) VALUES
(1, '1', '10', '30', NULL, 'no', NULL),
(2, '10', '20', '50', NULL, 'no', NULL),
(3, '20', '30', '60', NULL, 'no', NULL),
(4, '30', '40', '70', NULL, 'no', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_unidad`
--

CREATE TABLE IF NOT EXISTS `mco_unidad` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `default` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `sigla` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mco_unidad`
--

INSERT INTO `mco_unidad` (`codigo`, `descripcion`, `default`, `sigla`) VALUES
(10, 'Metros', 'si', 'm'),
(11, 'Metros Cuadrados', 'si', 'm2'),
(12, 'Metro Cubico', 'si', 'm3'),
(13, 'Kilogramo', 'si', ' kg'),
(14, 'Litro', 'si', 'L'),
(15, 'Pie', 'si', 'ft'),
(16, 'Vara', 'si', 'vara'),
(17, 'Libra', 'si', 'lb'),
(18, 'Onza', 'si', 'oz'),
(19, 'Piezas', 'si', 'Pzas'),
(20, 'Toneladas', 'si', 'Tm'),
(21, 'Caja', 'si', 'caja'),
(22, 'Lote', 'si', 'lote'),
(23, 'Galon', 'si', 'galon'),
(24, 'Unidad', 'si', 'unidad'),
(25, 'ejemplo', 'no', 'ejem');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `mco_view_formulaconcepto`
--
CREATE TABLE IF NOT EXISTS `mco_view_formulaconcepto` (
`codigo` int(11)
,`codigoproceso` varchar(8)
,`formula` varchar(200)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `mco_view_montoconstante`
--
CREATE TABLE IF NOT EXISTS `mco_view_montoconstante` (
`codigo` int(11)
,`codigoproceso` varchar(8)
,`monto` varchar(150)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_cliente`
--

CREATE TABLE IF NOT EXISTS `min_cliente` (
`codigo` int(11) NOT NULL,
  `codigo_alias` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `rif` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `min_cliente`
--

INSERT INTO `min_cliente` (`codigo`, `codigo_alias`, `rif`, `telefono`, `direccion`, `correo`) VALUES
(1, 'Maria C.A.', 'j-2135623-5', '5555-5555', 'ejemplo', 'ejemplo@ejemplo'),
(2, 'Gobernacion C.A.', 'j-2135617-5', '5555-5555', 'ejemplo calle ejemplo', 'ejemplo@ejemplo'),
(3, 'Alcaldia C.A.', 'j-2135325-5', '5555-5555', 'ejemplo ejemplo', 'ejemplo@ejemplo'),
(4, 'Josefa C.A.', 'j-2135421-5', '5555-5555', 'ejemplo calle ejemplo', 'ejemplo@ejemplo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_compra`
--

CREATE TABLE IF NOT EXISTS `min_compra` (
`codigo` int(11) NOT NULL,
  `codigo_articulo` int(11) NOT NULL,
  `codigo_proveedor` int(11) NOT NULL,
  `fecha_compra` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rotacion_inventario` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_moneda` int(11) NOT NULL,
  `codigo_tipo_pago` int(11) NOT NULL,
  `flete` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `gastos_varios` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `monto_factura` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `costo_almacenaje` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `devolucion` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `costo_total` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `min_compra`
--

INSERT INTO `min_compra` (`codigo`, `codigo_articulo`, `codigo_proveedor`, `fecha_compra`, `rotacion_inventario`, `codigo_moneda`, `codigo_tipo_pago`, `flete`, `cantidad`, `gastos_varios`, `monto_factura`, `costo_almacenaje`, `devolucion`, `costo_total`) VALUES
(1, 40, 0, '2014-010-3', '2014-010-3', 0, 3, '10', '500', '', '25000', '1000', 'n', '26010'),
(2, 128, 1, '2014-010-10', '2014-010-10', 0, 3, '100', '250', '1000', '430000', '0', 'n', '431100'),
(3, 129, 3, '2014-010-22', '2014-12-12', 0, 3, '', '6', '', '12000', '', 'n', '12000'),
(4, 129, 6, '2014-010-22', '2014-010-22', 0, 3, '', '8', '16000', '', '', 'n', '16000'),
(5, 59, 6, '2014-010-24', '2014-010-24', 1, 3, '', '1000', '', '500000', '', 'n', '500000'),
(6, 52, 5, '2014-010-24', '2014-010-24', 1, 3, '', '1000', '', '450000', '', 'n', '450000'),
(7, 55, 5, '2014-010-24', '2014-010-24', 1, 3, '', '500', '', '400000', '', 'n', '400000'),
(8, 58, 4, '2014-010-24', '2014-010-24', 1, 3, '', '1000', '', '100000', '', 'n', '100000'),
(9, 56, 3, '2014-010-24', '2014-010-24', 1, 3, '', '6000', '', '3000000', '', 'n', '3000000'),
(10, 54, 3, '2014-010-24', '2014-010-24', 1, 3, '', '40000', '', '10000000', '', 'n', '10000000'),
(11, 53, 7, '2014-010-24', '2014-010-24', 1, 3, '', '3000', '', '450000', '', 'n', '450000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_compra_importacion`
--

CREATE TABLE IF NOT EXISTS `min_compra_importacion` (
`codigo` int(11) NOT NULL,
  `codigo_compra` int(11) NOT NULL,
  `gasto_importacion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gasto_importacion_moneda` int(11) NOT NULL,
  `gastos_aduanales` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `gasto_aduanales_moneda` int(11) NOT NULL,
  `gastos_arancelarios` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gastos_arancelarios_moneda` int(11) NOT NULL,
  `gasto_nacionalizacion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gasto_nacionalizacion_moneda` int(11) NOT NULL,
  `tasa_cambio` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `min_compra_importacion`
--

INSERT INTO `min_compra_importacion` (`codigo`, `codigo_compra`, `gasto_importacion`, `gasto_importacion_moneda`, `gastos_aduanales`, `gasto_aduanales_moneda`, `gastos_arancelarios`, `gastos_arancelarios_moneda`, `gasto_nacionalizacion`, `gasto_nacionalizacion_moneda`, `tasa_cambio`) VALUES
(1, 1, '', 0, '', 0, '', 0, '', 0, ''),
(2, 2, '', 0, '', 0, '', 0, '', 0, ''),
(3, 3, '', 0, '', 0, '', 0, '', 0, ''),
(4, 4, '', 0, '', 0, '', 0, '', 0, ''),
(5, 5, '', 0, '', 0, '', 0, '', 0, ''),
(6, 6, '', 0, '', 0, '', 0, '', 0, ''),
(7, 7, '', 0, '', 0, '', 0, '', 0, ''),
(8, 8, '', 0, '', 0, '', 0, '', 0, ''),
(9, 9, '', 0, '', 0, '', 0, '', 0, ''),
(10, 10, '', 0, '', 0, '', 0, '', 0, ''),
(11, 11, '', 0, '', 0, '', 0, '', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_empresa`
--

CREATE TABLE IF NOT EXISTS `min_empresa` (
`codigo` int(11) NOT NULL,
  `codigo_alias` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rif` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `min_empresa`
--

INSERT INTO `min_empresa` (`codigo`, `codigo_alias`, `descripcion`, `correo`, `direccion`, `telefono`, `rif`) VALUES
(1, 'Asdrubal Paez C.A.', 'descripcion', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-1'),
(3, 'Jose Garcia C.A.', 'ejemplo2', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-2'),
(4, 'Ingeve C.A.', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-3'),
(5, 'Camara de Comercio C', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-4'),
(6, 'Ferreteria C.A.', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-5'),
(7, 'Hamburguesa C.A.', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-6'),
(8, 'Filito C.A.', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-7'),
(9, 'Herrera C.A.', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-8'),
(10, 'Igualito C.A.', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_imagen`
--

CREATE TABLE IF NOT EXISTS `min_imagen` (
  `nombre_subir` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_min_articulos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `min_imagen`
--

INSERT INTO `min_imagen` (`nombre_subir`, `name`, `type`, `size`, `codigo_min_articulos`) VALUES
('../img_articulos/1408023987-ac53e78a0e711643a9f1c8ac8d8e8717', '', 'vacio', '0', 123),
('../img_articulos/1408547649-eae5762931c1a6cb7fc58c2a5d24a79e', '', 'vacio', '0', 124),
('../img_articulos/1408547686-v89682ef02625f0b0f943b9bc6f3985b', '', 'vacio', '0', 125),
('../img_articulos/1408547712-d4b975671cf8141da65f1282146f9737', '', 'vacio', '0', 126),
('../img_articulos/1408548505-X0228bda57f43db3337758863414cdc9', '', 'vacio', '0', 127),
('../img_articulos/1408652732-I69f36ccffca3938589ad2dde3c6eefb', '', 'vacio', '0', 128),
('../img_articulos/1414506835-Dc734fbc1dba182c4809df1482d52e0f', '', 'vacio', '0', 130),
('../img_articulos/1414506845-N556cd40544c3d3decb65d80f1358e70', '', 'vacio', '0', 131),
('../img_articulos/1414507622-m1436e34ea839681555ab22aa9986caf', '', 'vacio', '0', 132),
('../img_articulos/asd1414007711-ma6b16c9b8b0650116890d314543701d.jpg', 'asd.jpg', 'image/jpeg', '4096', 129),
('1407865699-Hf74a5fd4465fc25ef02cca1cbea48bf', '', '', '0', 1),
('1407867584-X20c8960d0a4d756d6c2e9224067df9e', '', '', '0', 2),
('1407867632-v7cc6ba712ccfb0b948b1d32dfb362a9', '', '', '0', 3),
('1407867661-o2aa3a53b3066fa3a51458664a4be82a', '', '', '0', 4),
('1407867712-b42e93c7e22bf860010089f2ec70f1c6', '', '', '0', 5),
('1407867741-Kb92772e2834efe73987e2542d08a940', '', '', '0', 6),
('1407867780-E7f2f447459e37ee29c8d463c811e1bf', '', '', '0', 7),
('1407867944-zf772fc1da7a86e491663142f3c90a22', '', '', '0', 8),
('1407867994-n98be67c83bdd3c86ef1b7c7dd2c972a', '', '', '0', 9),
('1407868023-Q11a7100b1cccc019dd93e8e0d6dcbb5', '', '', '0', 10),
('1407868060-Nf395ab82fa8ad510bc44f25b1445a60', '', '', '0', 11),
('1407868870-O14d9fe5ae80728af699b1ea4f45a569', '', '', '0', 12),
('1407868896-j8bd997ab4ecc18ba7356844df9528a1', '', '', '0', 13),
('1407868943-p307f288ddcb956df4bc2d3eb8901c56', '', '', '0', 14),
('1407868973-Uf7ea89946d8b96a1220e51b969c3cad', '', '', '0', 15),
('1407868999-Def534cb4213b2fd5c4a3663327c3206', '', '', '0', 16),
('1407869071-mcf3190a6bf615264b0a55e3cbaab4ec', '', '', '0', 17),
('1407869102-p7edef0e28278b7adda1c85b64241e4f', '', '', '0', 18),
('1407869146-a4cf008a1c70b6d51d7f6af0db66c1df', '', '', '0', 19),
('1407869167-yd19d1092f354f92ecd6748e70d7f1c2', '', '', '0', 20),
('1407869223-o4ec43e8f22de1942c43820d24d945c8', '', '', '0', 21),
('1407869330-O95dafa8f336fbec1259eef6197e04fd', '', '', '0', 22),
('1407869356-Aa622fe23c72491ca9389b0c057c18ae', '', '', '0', 23),
('1407869393-H98790305de430c872b035b0e958c557', '', '', '0', 24),
('1407869416-g1a659a893c82071c4aefb746672817e', '', '', '0', 25),
('1407869524-dc61b73117445d3d7b5d4829a8d90a17', '', '', '0', 26),
('1407869551-Be61f39d6977b49dc2a8f8444fc3a06d', '', '', '0', 27),
('1407869582-l8d429ae6e0fdaae7976149960cfcf75', '', '', '0', 28),
('1407940222-W925780d4f18295556173ca77edb441b', '', '', '0', 29),
('1407940248-dce30608bfca16e7b65467e0adf530f6', '', '', '0', 30),
('1407940266-S0a4bd6bcc189ad2cf0aadf6ea6e9978', '', '', '0', 31),
('1407940291-o130d760c70b17059dfcad843c267625', '', '', '0', 32),
('1407940322-lc9b441023756f42b7e8f15128facdba', '', '', '0', 33),
('1407940344-z656499e77fe6ba7a6234aff879ffb0b', '', '', '0', 34),
('1407940413-l3da8b64b341bcd12c177bbdd1b943f6', '', '', '0', 35),
('1407940435-P6ae2b4b5145640f5427b7441bc36b11', '', '', '0', 36),
('1407940454-I2428c5a2fdd46763849f53749eb42bf', '', '', '0', 37),
('1407940479-pd38eb1d958e66ec9de4067e6a3427b3', '', '', '0', 38),
('1407940505-U88f1292397d811b180ae762c804d911', '', '', '0', 39),
('1407940521-S7aab16ab155a869c87fa3de63125d04', '', '', '0', 40),
('1407940541-E334fb1343090360590c1eb8eefcba6d', '', '', '0', 41),
('1407940571-M43e7c9d56e92d8de3f871ec15a75b0d', '', '', '0', 42),
('1407940586-H2dc0f5a8c7641dc173dcbd49f2cceb5', '', '', '0', 43),
('1407940606-O176c0a79c5d08a6cf59141d02529b82', '', '', '0', 44),
('1407940681-L33c77d45c7664c26ce5cf99adab59ae', '', '', '0', 45),
('1407940725-Gd882aa5e9409dc1afdf4cd7206e8ea6', '', '', '0', 46),
('1407940788-reb2b78a5c45290dc29ba592f8bb891c', '', '', '0', 47),
('1407940802-i87650a87747ecc791ae432df1c2d19b', '', '', '0', 48),
('1407940813-f4985f606b5d924d6ceb0156658e4a22', '', '', '0', 49),
('1407940831-I5e1385061e1579dd2d1cde626e09051', '', '', '0', 50),
('1407940851-x3ed2bf9a722074c55c36562e7240ff4', '', '', '0', 51),
('1407940870-Ge1aa5dbf69cc40666f83d173fa78833', '', '', '0', 52),
('1407940887-hcbef3c76c8d9acde3631291a60d5f2b', '', '', '0', 53),
('1407940902-m933ddc077fd314056eb144d518cfd70', '', '', '0', 54),
('1407940918-ha9761de699de569f41b739fc2e104fa', '', '', '0', 55),
('1407940930-I6927bafcf90075a9103257ac99cf300', '', '', '0', 56),
('1407940948-Xd0004d1b08477b91b273abe797c4fb6', '', '', '0', 57),
('1407940962-E3634305f65e300dcb6139d6249a38d8', '', '', '0', 58),
('1407940974-A3c514acd52c24d10467a6ed8a4aa6bb', '', '', '0', 59),
('1407940990-sf62c48901c6bf9006594605ce9d4b9b', '', '', '0', 60),
('1407941009-J0490d2bf4027284319aac664d3b5fd5', '', '', '0', 61),
('1407941026-sd458bc74ffb316e5f65263cfd390f11', '', '', '0', 62),
('1407941045-O505a91e41728fdffbabbf7c3312fd9d', '', '', '0', 63),
('1407941088-o28fb89cf8dcdc920a7e188ed8500e20', '', '', '0', 64),
('1407941168-G96ef8f8721a6f2c11492bf2aea31a66', '', '', '0', 65),
('1407941220-gbd14491c6739fa72ab446bb12df6c4e', '', '', '0', 66),
('1407941236-Q1ae0cdd93ca1836bc08c39c25108be5', '', '', '0', 67),
('1407941259-x8741b446ace09456a944197674311bd', '', '', '0', 68),
('1407941299-a1cd14db354a7a20438ade3019cab08e', '', '', '0', 69),
('1407941333-cf9c89226b8c83fe406f14d054b7f9e4', '', '', '0', 70),
('1407941353-pd4fada6236ba9d07af9c07da5502ce5', '', '', '0', 71),
('1407941374-Ybe7f4c0844cca079b9b05a73b5f127b', '', '', '0', 72),
('1407941394-z62007727ef662f353b22f7859326da0', '', '', '0', 73),
('1407941419-Y3ffce9b57ace01eca123b6e1d1ca9e8', '', '', '0', 74),
('1407941438-J41c7615c8c7672628e4a5bd365a8302', '', '', '0', 75),
('1407941491-Ld97ead09eb6714c5b45c971de2df385', '', '', '0', 76),
('1407941508-j7ded1b108b403022b25e37eeb065155', '', '', '0', 77),
('1407941533-s2e83a7c89fd052355fecdb65a431fdd', '', '', '0', 78),
('1407941553-Qab97398c3d2549e18ba4499c99502da', '', '', '0', 79),
('1407941579-Te65287a696f23b62842d3f04e7074f9', '', '', '0', 80),
('1407941609-Raa2b018c76bdfbcb3500aa8e3465f09', '', '', '0', 81),
('1407941656-vde2a07f72948cf09511dc9a462eab9a', '', '', '0', 82),
('1407941688-d4837031d8d3c886b9ddcec9d47328ef', '', '', '0', 83),
('1407941702-B2e54c35ab824697eafbb263b71d9661', '', '', '0', 84),
('1407941718-Ya9ab90141306645171c8d8a849254b3', '', '', '0', 85),
('1407941734-Q28340d06b6efb118a240545073743f9', '', '', '0', 86),
('1407941750-F6dd6b581c04f61db80feeac86ac88ff', '', '', '0', 87),
('1407941768-F8e4c315d82df392c7e5fe488e5ac095', '', '', '0', 88),
('1407941791-d865ad5788beb6c31e41a6046b33ede3', '', '', '0', 89),
('1407941811-O0f32c1c9522b9e21de6fe34424c7e64', '', '', '0', 90),
('1407941833-Kbf0b6c1cd66828c2eb8eb148c9eb973', '', '', '0', 91),
('1407941857-a8945141740c39cc21aeff1faac7747b', '', '', '0', 92),
('1407941876-l1ef4d38934400cd53129bbd1c122053', '', '', '0', 93),
('1407941953-A5047e2620e649b93712c73bf2a3fcd4', '', '', '0', 94),
('1407941970-H113d77285660e48c642ad1becfb9e59', '', '', '0', 95),
('1407941985-q6e59aaeafb81b0b320a7da57b194c82', '', '', '0', 96),
('1407942001-tc7906454d4c6ab5cd5ea3766979bfde', '', '', '0', 97),
('1407942019-Yc9582f86ae5c07433b43e65e6862936', '', '', '0', 98),
('1407942036-l7be6ee143622ae7404261f2666dd2c1', '', '', '0', 99),
('1407942055-J0af838d5c01a47b35273158f2583d9f', '', '', '0', 100),
('1407942071-o65c1b3cb5ac9d4e8ccbd5493d4e20ea', '', '', '0', 101),
('1407942089-Xffae183ec5f876215e928c7c59b8133', '', '', '0', 102),
('1407942104-e4d898888bdf73bc600c9557dc210914', '', '', '0', 103),
('1407942123-h2417f51574820c7eca4fefe57e1c0f8', '', '', '0', 104),
('1407942137-hcd6169994183f058cc7a17859368288', '', '', '0', 105),
('1407942154-h6f8e480e1357c45aa50802ddb177d8c', '', '', '0', 106),
('1407942171-n0c09545d9d7c698a8813fab15dfa0cb', '', '', '0', 107),
('1407942186-s632eced73a493dc67e449ca0a00bea0', '', '', '0', 108),
('1407942198-h559517efa02b5bbb7260ab73c36ea95', '', '', '0', 109),
('1407942232-ddf40dd41bf8c3667c42ad022eb52114', '', '', '0', 110),
('1407942260-jd1c1d1cc2bb1ee4164e1bfc2a33dd02', '', '', '0', 111),
('1407942274-U34e6c69cedddd859fa434b2b871595a', '', '', '0', 112),
('1407942293-G52eac876656d9d42aac176e848e2b8a', '', '', '0', 113),
('1407942311-Ra17028e28a19a50ef443e79b0aa2a42', '', '', '0', 114),
('1407942326-uf68ee65a09e76530cfe8b7b7f0caeeb', '', '', '0', 115),
('1408022976-p758c0e866dea78cafa054b9ce1a384b', '', '', '0', 116),
('1408023083-Sba885e1bc78824cbbd2bb3b9b2874d7', '', '', '0', 117),
('1408023424-J04b1a886cd3b38f718fb8dde7213419', '', '', '0', 118),
('1408023456-w7b0891279f41a7545a135ca50b417a1', '', '', '0', 119),
('1408023828-s67120ba0ada53172d0764dfa8ba1d42', '', '', '0', 120),
('1408023847-n20d8b654224ae255367aa4f8dc72cf3', '', '', '0', 121),
('1408023923-Ie375bb342f019ad0b5324cb1d7532e9', '', 'vacio', '0', 122);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_inventario_cola`
--

CREATE TABLE IF NOT EXISTS `min_inventario_cola` (
`codigo` int(11) NOT NULL,
  `codigo_producto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `costo_total` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usado` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `id_compra` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `costo_unidad` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `min_inventario_cola`
--

INSERT INTO `min_inventario_cola` (`codigo`, `codigo_producto`, `fecha`, `cantidad`, `costo_total`, `usado`, `id_compra`, `id_venta`, `costo_unidad`) VALUES
(1, '40', '1412353942', '476', '25800.429233399', 'n', 1, 0, '52.02'),
(2, '128', '1412951928', '250', '431100', 'n', 2, 0, '1724.4'),
(3, '129', '1414007784', '6', '12000', 'n', 3, 0, '2000'),
(4, '129', '1414011786', '8', '16000', 'n', 4, 0, '2000'),
(5, '59', '1414159821', '1000', '500000', 'n', 5, 0, '500'),
(6, '52', '1414159872', '1000', '450000', 'n', 6, 0, '450'),
(7, '55', '1414159958', '500', '400000', 'n', 7, 0, '800'),
(8, '58', '1414160111', '1000', '100000', 'n', 8, 0, '100'),
(9, '56', '1414160147', '6000', '3000000', 'n', 9, 0, '500'),
(10, '54', '1414160195', '40000', '10000000', 'n', 10, 0, '250'),
(11, '53', '1414160234', '3000', '450000', 'n', 11, 0, '150');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_inventario_ueps`
--

CREATE TABLE IF NOT EXISTS `min_inventario_ueps` (
`codigo` int(11) NOT NULL,
  `codigo_producto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `costo_total` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usado` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `costo_unidad` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_compra` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `min_inventario_ueps`
--

INSERT INTO `min_inventario_ueps` (`codigo`, `codigo_producto`, `fecha`, `cantidad`, `costo_total`, `usado`, `costo_unidad`, `id_compra`) VALUES
(1, '40', '1412353942', '500', '26010', 'n', '52.02', 1),
(2, '128', '1412951928', '250', '431100', 'n', '1724.4', 2),
(3, '129', '1414007784', '6', '12000', 'n', '2000', 3),
(4, '129', '1414011786', '8', '16000', 'n', '2000', 4),
(5, '59', '1414159821', '1000', '500000', 'n', '500', 5),
(6, '52', '1414159872', '1000', '450000', 'n', '450', 6),
(7, '55', '1414159958', '500', '400000', 'n', '800', 7),
(8, '58', '1414160111', '1000', '100000', 'n', '100', 8),
(9, '56', '1414160147', '6000', '3000000', 'n', '500', 9),
(10, '54', '1414160195', '40000', '10000000', 'n', '250', 10),
(11, '53', '1414160234', '3000', '450000', 'n', '150', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_productos_servicios`
--

CREATE TABLE IF NOT EXISTS `min_productos_servicios` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `fecha_vencimiento` varchar(12) NOT NULL,
  `fecha_adquisicion` varchar(12) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `observacion` text NOT NULL,
  `inventario` int(11) NOT NULL,
  `mco_unidad` int(11) NOT NULL,
  `foto_articulo` varchar(200) DEFAULT NULL,
  `existencia_minima` varchar(200) NOT NULL,
  `existencia_maxima` varchar(200) NOT NULL,
  `existencia` varchar(200) NOT NULL DEFAULT '0',
  `codigo_alias` varchar(80) NOT NULL,
  `eliminado` varchar(16) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=130 ;

--
-- Volcado de datos para la tabla `min_productos_servicios`
--

INSERT INTO `min_productos_servicios` (`codigo`, `nombre`, `fecha_vencimiento`, `fecha_adquisicion`, `ubicacion`, `observacion`, `inventario`, `mco_unidad`, `foto_articulo`, `existencia_minima`, `existencia_maxima`, `existencia`, `codigo_alias`, `eliminado`) VALUES
(1, 'Contemporary II Semi-OrtopÃ©dico 1.4x1.90 8 aÃ±os de GarantÃ­a', '2014-07-09', '2014-08-12', '', '\r\n                                ', 6, 24, '1407867541-n5f62de9da0ae0554e0fd5838f1e4bcb', '1', '10', '0', '', 'no'),
(2, 'Contemporary II Semi-OrtopÃ©dico 1.0x1.90 8 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407867584-X20c8960d0a4d756d6c2e9224067df9e', '1', '10', '0', '', 'no'),
(3, 'Premiere Semi-OrtopÃ©dico 1.4x1.90 12 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407867632-v7cc6ba712ccfb0b948b1d32dfb362a9', '1', '10', '0', '', 'no'),
(4, 'Premiere Semi-OrtopÃ©dico 1.0x1.90 12 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '                                ', 6, 10, '1407867661-o2aa3a53b3066fa3a51458664a4be82a', '1', '10', '0', '', 'no'),
(5, 'Contemporary OrtopÃ©dico 1.4x1.90 15 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407867712-b42e93c7e22bf860010089f2ec70f1c6', '1', '10', '0', '', 'no'),
(6, 'Contemporary OrtopÃ©dico 1.0x1.90 15 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407867741-Kb92772e2834efe73987e2542d08a940', '1', '10', '0', '', 'no'),
(7, 'Contemporary 1 Tapa OrtopÃ©dico 1.4x1.90 15 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407867780-E7f2f447459e37ee29c8d463c811e1bf', '1', '10', '0', '', 'no'),
(8, 'Contemporary 1 Tapa OrtopÃ©dico 1.0x1.90 15 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407867944-zf772fc1da7a86e491663142f3c90a22', '1', '10', '0', '', 'no'),
(9, 'Contemporary 2 Tapas OrtopÃ©dico 1.4x1.90 15 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407867994-n98be67c83bdd3c86ef1b7c7dd2c972a', '1', '10', '0', '', 'no'),
(10, 'Contemporary 2 Tapas OrtopÃ©dico 1.0x1.90 15 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407868023-Q11a7100b1cccc019dd93e8e0d6dcbb5', '1', '10', '0', '', 'no'),
(11, 'Contemporary Semi- OrtopÃ©dico 1.6x1.90 8 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407868060-Nf395ab82fa8ad510bc44f25b1445a60', '1', '10', '0', '', 'no'),
(12, 'Contemporary 1 Tapa OrtopÃ©dico 1.6x1.90 15 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407868870-O14d9fe5ae80728af699b1ea4f45a569', '1', '10', '0', '', 'no'),
(13, 'Contemporary 1 2 Tapas OrtopÃ©dico 1.6x1.90 15 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407868896-j8bd997ab4ecc18ba7356844df9528a1', '1', '10', '0', '', 'no'),
(14, 'Contemporary  OrtopÃ©dico 2.0x2.0 12 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407868943-p307f288ddcb956df4bc2d3eb8901c56', '1', '10', '0', '', 'no'),
(15, 'Contemporary  1 Tapa OrtopÃ©dico 2.0x2.0 15 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407868973-Uf7ea89946d8b96a1220e51b969c3cad', '1', '10', '0', '', 'no'),
(16, 'Contemporary  2 Tapas OrtopÃ©dico 2.0x2.0 15 aÃ±os de GarantÃ­a', '2014-08-12', '2014-08-12', '', '\r\n                                ', 6, 24, '1407868999-Def534cb4213b2fd5c4a3663327c3206', '1', '10', '0', '', 'no'),
(17, 'Resortes 2,32 Mm', '2014-08-12', '2014-08-12', '', '\r\n                                ', 11, 24, '1407869071-mcf3190a6bf615264b0a55e3cbaab4ec', '1', '10', '0', '', 'no'),
(18, 'Resortes 2,50 Mts', '2014-08-12', '2014-08-12', '', '                                ', 11, 24, '1407869102-p7edef0e28278b7adda1c85b64241e4f', '1', '10', '0', '', 'no'),
(19, 'Armadura 1 Mts.', '2014-08-12', '2014-08-12', '', '\r\n                                ', 11, 10, '1407869146-a4cf008a1c70b6d51d7f6af0db66c1df', '1', '10', '0', '', 'no'),
(20, 'Armadura 1 Mts. Especial.', '2014-08-12', '2014-08-12', '', '\r\n                                ', 11, 10, '1407869167-yd19d1092f354f92ecd6748e70d7f1c2', '1', '10', '0', '', 'no'),
(21, 'Armadura 1,40 Mts.', '2014-08-12', '2014-08-12', '', '\r\n                                ', 11, 10, '1407869223-o4ec43e8f22de1942c43820d24d945c8', '1', '10', '99', '', 'no'),
(22, 'Armadura 1,40 Mts. Especial.', '2014-08-12', '2014-08-12', '', '\r\n                                ', 11, 10, '1407869330-O95dafa8f336fbec1259eef6197e04fd', '1', '10', '0', '', 'no'),
(23, 'Armadura 1,60 Mts.', '2014-08-12', '2014-08-12', '', '\r\n                                ', 11, 10, '1407869356-Aa622fe23c72491ca9389b0c057c18ae', '1', '10', '0', '', 'no'),
(24, 'Armadura 2 x 2 Mts.', '2014-08-12', '2014-08-12', '', '\r\n                                ', 11, 10, '1407869393-H98790305de430c872b035b0e958c557', '1', '10', '0', '', 'no'),
(25, 'Armadura Cuna.', '2014-08-12', '2014-08-12', '', '\r\n                                ', 11, 10, '1407869416-g1a659a893c82071c4aefb746672817e', '1', '10', '0', '', 'no'),
(26, 'Estabilizadores 4,12 Mm x 0,60 Mts', '2014-08-12', '2014-08-12', '', '\r\n                                ', 11, 24, '1407869524-dc61b73117445d3d7b5d4829a8d90a17', '1', '10', '0', '', 'no'),
(27, 'Goma Espuma Piller', '2014-08-12', '2014-08-12', '', '\r\n                                ', 11, 10, '1407869551-Be61f39d6977b49dc2a8f8444fc3a06d', '1', '10', '0', '', 'no'),
(28, 'Goma Espuma Cuadrada', '2014-08-12', '2014-08-12', '', '\r\n                                ', 11, 10, '1407869582-l8d429ae6e0fdaae7976149960cfcf75', '1', '10', '0', '', 'no'),
(29, 'Hilo lup-300', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 26, '1407940222-W925780d4f18295556173ca77edb441b', '1', '10', '0', '', 'no'),
(30, 'Hilo J-46', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 26, '1407940248-dce30608bfca16e7b65467e0adf530f6', '1', '10', '0', '', 'no'),
(31, 'Hilo B-46 ', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 26, '1407940266-S0a4bd6bcc189ad2cf0aadf6ea6e9978', '1', '10', '0', '', 'no'),
(32, 'Hilo B-46', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 26, '1407940291-o130d760c70b17059dfcad843c267625', '1', '10', '0', '', 'no'),
(33, 'Hilo NY-JJ-55', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 26, '1407940322-lc9b441023756f42b7e8f15128facdba', '1', '10', '0', '', 'no'),
(34, 'Hilo NY-JJ-55', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 26, '1407940344-z656499e77fe6ba7a6234aff879ffb0b', '1', '10', '0', '', 'no'),
(35, 'PerlÃ³n 2,10 Mts.', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 27, '1407940413-l3da8b64b341bcd12c177bbdd1b943f6', '1', '10', '0', '', 'no'),
(36, 'PerlÃ³n 2,30 Mts.', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 27, '1407940435-P6ae2b4b5145640f5427b7441bc36b11', '1', '10', '0', '', 'no'),
(37, 'PerlÃ³n 2,40 Mts.', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 27, '1407940454-I2428c5a2fdd46763849f53749eb42bf', '1', '10', '0', '', 'no'),
(38, 'PerlÃ³n de aleta', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 27, '1407940479-pd38eb1d958e66ec9de4067e6a3427b3', '1', '10', '0', '', 'no'),
(39, 'Alambre 1,37 (200 Kg)', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940505-U88f1292397d811b180ae762c804d911', '1', '10', '1590', '', 'no'),
(40, 'Alambre 2,32 (700 Kg)', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940521-S7aab16ab155a869c87fa3de63125d04', '1', '10', '495', '', 'no'),
(41, 'Alambre 2,50 (700 Kg)', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940541-E334fb1343090360590c1eb8eefcba6d', '1', '10', '0', '', 'no'),
(42, 'Alambre 4,12 x 0,60 (300 kg)- cabilla', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940571-M43e7c9d56e92d8de3f871ec15a75b0d', '1', '10', '0', '', 'no'),
(43, 'Alambre 3,77 x 2,90 (300 kg)- cabilla', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940586-H2dc0f5a8c7641dc173dcbd49f2cceb5', '1', '10', '0', '', 'no'),
(44, 'Alambre 3,77 x 3,30 (300 kg)- cabilla', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940606-O176c0a79c5d08a6cf59141d02529b82', '1', '10', '0', '', 'no'),
(45, 'Hiladilla', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 28, '1407940681-L33c77d45c7664c26ce5cf99adab59ae', '1', '10', '0', '', 'no'),
(46, 'Grapas', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 21, '1407940725-Gd882aa5e9409dc1afdf4cd7206e8ea6', '1', '10', '0', '', 'no'),
(47, 'Pega', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 29, '1407940788-reb2b78a5c45290dc29ba592f8bb891c', '1', '10', '0', '', 'no'),
(48, 'Guata', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 10, '1407940802-i87650a87747ecc791ae432df1c2d19b', '1', '10', '0', '', 'no'),
(49, 'Telas Silys', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 10, '1407940813-f4985f606b5d924d6ceb0156658e4a22', '1', '10', '0', '', 'no'),
(50, 'Tela Eclipse', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 10, '1407940831-I5e1385061e1579dd2d1cde626e09051', '1', '10', '0', '', 'no'),
(51, 'Tela Spring Air', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 10, '1407940851-x3ed2bf9a722074c55c36562e7240ff4', '1', '10', '0', '', 'no'),
(52, 'TDI', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940870-Ge1aa5dbf69cc40666f83d173fa78833', '1', '10', ' 941 ', '', 'no'),
(53, 'Silicona', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940887-hcbef3c76c8d9acde3631291a60d5f2b', '1', '10', ' 2927 ', '', 'no'),
(54, 'EstaÃ±o', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940902-m933ddc077fd314056eb144d518cfd70', '1', '10', ' 39798 ', '', 'no'),
(55, 'Poliol', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940918-ha9761de699de569f41b739fc2e104fa', '1', '10', '457', '', 'no'),
(56, 'Amina', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940930-I6927bafcf90075a9103257ac99cf300', '1', '10', '5980', '', 'no'),
(57, 'PolimÃ©rico (Bari tanque x 1.000 Kg)', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940948-Xd0004d1b08477b91b273abe797c4fb6', '1', '10', '0', '', 'no'),
(58, 'PolimÃ©rico', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940962-E3634305f65e300dcb6139d6249a38d8', '1', '10', '750', '', 'no'),
(59, 'Cloruro', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940974-A3c514acd52c24d10467a6ed8a4aa6bb', '1', '10', ' -8888089 ', '', 'no'),
(60, 'Tinta', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407940990-sf62c48901c6bf9006594605ce9d4b9b', '1', '10', '0', '', 'no'),
(61, 'Grasa', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407941009-J0490d2bf4027284319aac664d3b5fd5', '1', '10', '0', '', 'no'),
(62, 'Sisal 1,40 Mts.', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 28, '1407941026-sd458bc74ffb316e5f65263cfd390f11', '1', '10', '0', '', 'no'),
(63, 'Sisal 1 Mts.', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 28, '1407941045-O505a91e41728fdffbabbf7c3312fd9d', '1', '10', '0', '', 'no'),
(64, 'Bolsas con impresiÃ³n 2 x 2 Mts. Silys', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941088-o28fb89cf8dcdc920a7e188ed8500e20', '1', '10', '0', '', 'no'),
(65, 'Bolsas con impresiÃ³n 1,60 Mts. Silys', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941168-G96ef8f8721a6f2c11492bf2aea31a66', '1', '10', '0', '', 'no'),
(66, 'Bolsas con impresiÃ³n 1,40 x 10 Mts.    Silys', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941220-gbd14491c6739fa72ab446bb12df6c4e', '1', '10', '0', '', 'no'),
(67, 'Bolsas con impresiÃ³n 1,40 x 15 Mts. Silys', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941236-Q1ae0cdd93ca1836bc08c39c25108be5', '1', '10', '0', '', 'no'),
(68, 'Bolsas con impresiÃ³n 1 x 10 Mts. Silys', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941259-x8741b446ace09456a944197674311bd', '1', '10', '0', '', 'no'),
(69, 'Bolsas con impresiÃ³n 1 x 15 Mts. Silys', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941299-a1cd14db354a7a20438ade3019cab08e', '1', '10', '0', '', 'no'),
(70, 'Bolsas con impresiÃ³n cuna Silys', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941333-cf9c89226b8c83fe406f14d054b7f9e4', '1', '10', '0', '', 'no'),
(71, 'Etiqueta Dakota, con banderÃ­n', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941353-pd4fada6236ba9d07af9c07da5502ce5', '1', '10', '0', '', 'no'),
(72, 'Etiqueta Kansas, con banderÃ­n', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941374-Ybe7f4c0844cca079b9b05a73b5f127b', '1', '10', '0', '', 'no'),
(73, 'Etiqueta New York, con banderÃ­n', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941394-z62007727ef662f353b22f7859326da0', '1', '10', '0', '', 'no'),
(74, 'Etiqueta Flamingo, con banderÃ­n', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941419-Y3ffce9b57ace01eca123b6e1d1ca9e8', '1', '10', '0', '', 'no'),
(75, 'Etiqueta Florida, con banderÃ­n', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941438-J41c7615c8c7672628e4a5bd365a8302', '1', '10', '0', '', 'no'),
(76, 'Etiqueta para cama cuna', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941491-Ld97ead09eb6714c5b45c971de2df385', '1', '10', '0', '', 'no'),
(77, 'Etiqueta para cuna', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941508-j7ded1b108b403022b25e37eeb065155', '1', '10', '0', '', 'no'),
(78, 'Etiqueta para Pillow Top, con banderÃ­n', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941533-s2e83a7c89fd052355fecdb65a431fdd', '1', '10', '0', '', 'no'),
(79, 'Etiqueta Florida Box', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941553-Qab97398c3d2549e18ba4499c99502da', '1', '10', '0', '', 'no'),
(80, 'Flamingo Box', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941579-Te65287a696f23b62842d3f04e7074f9', '1', '10', '0', '', 'no'),
(81, 'California, con banderÃ­n', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941609-Raa2b018c76bdfbcb3500aa8e3465f09', '1', '10', '0', '', 'no'),
(82, 'Dakota Box', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941656-vde2a07f72948cf09511dc9a462eab9a', '1', '10', '0', '', 'no'),
(83, 'Bolsas con impresiÃ³n 2 x 2 Mts. Eclipse', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941688-d4837031d8d3c886b9ddcec9d47328ef', '1', '10', '0', '', 'no'),
(84, 'Bolsas con impresiÃ³n 1,60 Mts. Eclipse', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941702-B2e54c35ab824697eafbb263b71d9661', '1', '10', '0', '', 'no'),
(85, 'Bolsas con impresiÃ³n 1,40 x 10 Mts. Eclipse', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941718-Ya9ab90141306645171c8d8a849254b3', '1', '10', '0', '', 'no'),
(86, 'Bolsas con impresiÃ³n 1,40 x 15 Mts. Eclipse', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941734-Q28340d06b6efb118a240545073743f9', '1', '10', '0', '', 'no'),
(87, 'Bolsas con impresiÃ³n 1 x 10 Mts. Eclipse', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941750-F6dd6b581c04f61db80feeac86ac88ff', '1', '10', '0', '', 'no'),
(88, 'Bolsas con impresiÃ³n 1 x 15 Mts. Eclipse', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941768-F8e4c315d82df392c7e5fe488e5ac095', '1', '10', '0', '', 'no'),
(89, 'Bolsas con impresiÃ³n cama cuna Eclipse', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941791-d865ad5788beb6c31e41a6046b33ede3', '1', '10', '0', '', 'no'),
(90, 'Bolsas con impresiÃ³n cuna Eclipse', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941811-O0f32c1c9522b9e21de6fe34424c7e64', '1', '10', '0', '', 'no'),
(91, 'Etiquetas Texas, con banderÃ­n', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941833-Kbf0b6c1cd66828c2eb8eb148c9eb973', '1', '10', '0', '', 'no'),
(92, 'Etiqueta Nevada, con banderÃ­n', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941857-a8945141740c39cc21aeff1faac7747b', '1', '10', '0', '', 'no'),
(93, 'Etiqueta Atlanta, con banderÃ­n', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941876-l1ef4d38934400cd53129bbd1c122053', '1', '10', '0', '', 'no'),
(94, 'Etiqueta Atlanta box', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941953-A5047e2620e649b93712c73bf2a3fcd4', '1', '10', '0', '', 'no'),
(95, 'Etiqueta Boston, con banderÃ­n', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941970-H113d77285660e48c642ad1becfb9e59', '1', '10', '0', '', 'no'),
(96, 'Etiqueta para cama cuna, eclipse', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407941985-q6e59aaeafb81b0b320a7da57b194c82', '1', '10', '0', '', 'no'),
(97, 'Etiqueta para cuna, eclipse', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942001-tc7906454d4c6ab5cd5ea3766979bfde', '1', '10', '0', '', 'no'),
(98, 'Etiquetas Spring Air', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942019-Yc9582f86ae5c07433b43e65e6862936', '1', '10', '0', '', 'no'),
(99, 'Etiquetas para cama cuna Spring air', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942036-l7be6ee143622ae7404261f2666dd2c1', '1', '10', '0', '', 'no'),
(100, 'Etiquetas para cuna Spring air', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942055-J0af838d5c01a47b35273158f2583d9f', '1', '10', '0', '', 'no'),
(101, 'Etiqueta spring air de 8 aÃ±os', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942071-o65c1b3cb5ac9d4e8ccbd5493d4e20ea', '1', '10', '0', '', 'no'),
(102, 'Etiqueta spring air de 12 aÃ±os', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942089-Xffae183ec5f876215e928c7c59b8133', '1', '10', '0', '', 'no'),
(103, 'BanderÃ­n spring air de 12 aÃ±os', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942104-e4d898888bdf73bc600c9557dc210914', '1', '10', '197', '', 'no'),
(104, 'Etiqueta spring air de 15 aÃ±os', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942123-h2417f51574820c7eca4fefe57e1c0f8', '1', '10', '0', '', 'no'),
(105, 'BanderÃ­n spring air de 15 aÃ±os', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942137-hcd6169994183f058cc7a17859368288', '1', '10', '0', '', 'no'),
(106, 'Bolsas sin impresiÃ³n 2 x 2 Mts. Spring Air', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942154-h6f8e480e1357c45aa50802ddb177d8c', '1', '10', '0', '', 'no'),
(107, 'Bolsas sin impresiÃ³n 1,60 Mts. Spring Air', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942171-n0c09545d9d7c698a8813fab15dfa0cb', '1', '10', '0', '', 'no'),
(108, 'Bolsas sin impresiÃ³n 1,40 x 10 Mts. Spring Air', '2014-08-13', '2014-08-13', '', '                                                                                                                                                                        \r\n                                                                                                                                                                                                        ', 1, 19, '', '1', '10', '0', '123456', 'no'),
(109, 'Bolsas sin impresiÃ³n 1,40 x 15 Mts. Spring Air', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942198-h559517efa02b5bbb7260ab73c36ea95', '1', '10', '0', '', 'no'),
(110, 'Bolsas sin impresiÃ³n 1 x 10 Mts. Spring Air', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942232-ddf40dd41bf8c3667c42ad022eb52114', '1', '10', '0', '', 'no'),
(111, 'Bolsas sin impresiÃ³n 1 x 15 Mts. Spring Air', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942260-jd1c1d1cc2bb1ee4164e1bfc2a33dd02', '1', '10', '0', '', 'no'),
(112, 'Bolsas sin impresiÃ³n cama cuna Spring Air', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942274-U34e6c69cedddd859fa434b2b871595a', '1', '10', '0', '', 'no'),
(113, 'Bolsas sin impresiÃ³n cuna Spring Air', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 19, '1407942293-G52eac876656d9d42aac176e848e2b8a', '1', '10', '0', '', 'no'),
(114, 'Bobina de plÃ¡stico laminado 2,70 Mts.', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407942311-Ra17028e28a19a50ef443e79b0aa2a42', '1', '10', '99', '', 'no'),
(115, 'Bobina de plÃ¡stico laminado 2,50 Mts.', '2014-08-13', '2014-08-13', '', '\r\n                                ', 1, 13, '1407942326-uf68ee65a09e76530cfe8b7b7f0caeeb', '1', '10', '0', '', 'no'),
(124, 'Marco 3,77 Mm x 2,90 Mts', '2014-08-20', '2014-08-20', '', '                                ', 11, 19, '../img_articulos/1408547649-eae5762931c1a6cb7fc58c2a5d24a79e', '1', '10', '0', '', 'no'),
(125, 'Marco 2,77 Mm X 3,0 Mts', '2014-08-20', '2014-08-20', '', '\r\n                                ', 11, 19, '../img_articulos/1408547686-v89682ef02625f0b0f943b9bc6f3985b', '1', '10', '0', '', 'no'),
(126, 'Marco 3,77 Mm x 2Mts', '2014-08-20', '2014-08-20', '', '\r\n                                ', 11, 10, '../img_articulos/1408547712-d4b975671cf8141da65f1282146f9737', '1', '10', '0', '', 'no'),
(127, 'Cabilla "Tripa de pollo" 4,12 Mm 0,60 Mts', '2014-08-20', '2014-08-20', '', '\r\n                                ', 1, 19, '../img_articulos/1408548505-X0228bda57f43db3337758863414cdc9', '1', '10', '0', '', 'no'),
(128, 'botas de seguridad', '2014-08-21', '2014-08-21', '', '\r\n                                ', 3, 24, '../img_articulos/1408652732-I69f36ccffca3938589ad2dde3c6eefb', '1', '2', '248', 'ff-rr', 'no'),
(129, 'casco', '2014-010-22', '2014-010-22', 'departamento de logistica', '\r\n                                ', 3, 24, '../img_articulos/asd1414007711-ma6b16c9b8b0650116890d314543701d.jpg', '2', '1000', '0', 'ff-gg', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_requisicion`
--

CREATE TABLE IF NOT EXISTS `min_requisicion` (
`codigo` int(11) NOT NULL,
  `codigo_encargado_almacen` int(11) DEFAULT NULL,
  `codigo_persona_recibe` int(11) DEFAULT NULL,
  `codigo_articulo` int(11) DEFAULT NULL,
  `cantidad_despacho` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_uso` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `devolucion` varchar(15) COLLATE utf8_unicode_ci DEFAULT 'n',
  `valor_unidad` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_alias` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `periocidad` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `existencia_final` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `beneficiario` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `min_requisicion`
--

INSERT INTO `min_requisicion` (`codigo`, `codigo_encargado_almacen`, `codigo_persona_recibe`, `codigo_articulo`, `cantidad_despacho`, `fecha_uso`, `devolucion`, `valor_unidad`, `codigo_alias`, `periocidad`, `existencia_final`, `beneficiario`) VALUES
(1, 19, 3, 129, ' 1 ', '2014-10-22', 'n', ' 2000 ', '12212', '6', '4', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_tipo_empresa`
--

CREATE TABLE IF NOT EXISTS `min_tipo_empresa` (
`codigo` int(11) NOT NULL,
  `tipo` varchar(80) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `min_tipo_empresa`
--

INSERT INTO `min_tipo_empresa` (`codigo`, `tipo`) VALUES
(1, 'producci&oacute;n'),
(2, 'manufacturera'),
(3, 'comercializadora'),
(5, 'servicio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_tipo_inventario`
--

CREATE TABLE IF NOT EXISTS `min_tipo_inventario` (
`codigo` int(11) NOT NULL,
  `tipo` varchar(80) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `min_tipo_inventario`
--

INSERT INTO `min_tipo_inventario` (`codigo`, `tipo`) VALUES
(1, 'Materiales Directos'),
(2, 'Materiales Indirectos'),
(3, 'Seguridad Industrial'),
(4, 'Productos en Proceso'),
(6, 'Productos Terminados'),
(7, 'Mercancia'),
(8, 'Articulo de Oficina'),
(9, 'Repuesto y Suministro'),
(10, 'Limpieza'),
(11, 'Semi Elaborado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_tipo_moneda`
--

CREATE TABLE IF NOT EXISTS `min_tipo_moneda` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `simbolo` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `min_tipo_moneda`
--

INSERT INTO `min_tipo_moneda` (`codigo`, `nombre`, `simbolo`) VALUES
(1, 'Bolívar', 'Bs.'),
(2, 'Dólar', '$'),
(3, 'Euro', ' UE'),
(5, 'Yen', 'Yen'),
(6, 'Franco', 'CHF'),
(7, 'Libra Esterlina', 'Libra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_tipo_pago`
--

CREATE TABLE IF NOT EXISTS `min_tipo_pago` (
`codigo` int(11) NOT NULL,
  `tipo` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `min_tipo_pago`
--

INSERT INTO `min_tipo_pago` (`codigo`, `tipo`) VALUES
(1, 'Crédito '),
(2, 'Débito'),
(3, 'Efectivo'),
(4, 'Cheque');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_uso_consumo`
--

CREATE TABLE IF NOT EXISTS `min_uso_consumo` (
`codigo` int(11) NOT NULL,
  `codigo_encargado_almacen` int(11) NOT NULL,
  `codigo_orden_produccion` int(11) NOT NULL,
  `codigo_persona_recibe` int(11) NOT NULL,
  `cod_articulo` int(11) NOT NULL,
  `existencia_antes` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad_despacho` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `existencia_final` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_uso` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `devolucion` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `codigo_etapa` int(11) NOT NULL,
  `costo_articulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='tabla para el uso consumo' AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `min_uso_consumo`
--

INSERT INTO `min_uso_consumo` (`codigo`, `codigo_encargado_almacen`, `codigo_orden_produccion`, `codigo_persona_recibe`, `cod_articulo`, `existencia_antes`, `cantidad_despacho`, `existencia_final`, `fecha_uso`, `devolucion`, `codigo_etapa`, `costo_articulo`) VALUES
(1, 52, 1, 45, 40, '500', '2', '498', '2014-10-3', 'n', 2, '52.02'),
(2, 43, 2, 38, 40, '498', '3', '495', '2014-10-3', 'n', 2, '52.02'),
(3, 16, 4, 19, 59, '1000', '100', '900', '2014-10-24', 'n', 1, '500'),
(4, 19, 4, 3, 52, '1000', '24', '976', '2014-10-24', 'n', 1, '450'),
(5, 16, 1, 3, 59, '900', '101', '799', '2014-10-24', 'n', 1, '500'),
(6, 16, 1, 19, 52, '976', '24', '952', '2014-10-24', 'n', 1, '450'),
(7, 19, 1, 19, 55, '500', '43', '457', '2014-10-24', 'n', 1, '800'),
(8, 19, 1, 19, 58, '1000', '250', '750', '2014-10-24', 'n', 1, '100'),
(9, 19, 1, 3, 56, '6000', '20', '5980', '2014-10-24', 'n', 1, '500'),
(10, 19, 1, 19, 54, '40000', '200', '39800', '2014-10-24', 'n', 1, '250'),
(11, 19, 1, 19, 53, '3000', '50', '2950', '2014-10-24', 'n', 1, '150'),
(12, 16, 2, 19, 59, ' 799 ', ' 8888888 ', ' -8888089 ', '2014-10-27', 'n', 1, '500'),
(13, 19, 3, 3, 52, ' 952 ', ' 11 ', ' 941 ', '2014-10-31', 'n', 1, '450'),
(14, 19, 3, 3, 54, ' 39800 ', ' 2 ', ' 39798 ', '2014-10-31', 'n', 1, '250'),
(15, 19, 3, 3, 53, ' 2950 ', ' 23 ', ' 2927 ', '2014-10-31', 'n', 1, '150');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_valoracion`
--

CREATE TABLE IF NOT EXISTS `min_valoracion` (
`codigo` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `unidades` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `costo_total` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `promedio_actual` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=130 ;

--
-- Volcado de datos para la tabla `min_valoracion`
--

INSERT INTO `min_valoracion` (`codigo`, `codigo_producto`, `unidades`, `costo_total`, `promedio_actual`) VALUES
(1, 1, '0', '0', '0'),
(4, 2, '0', '0', '0'),
(5, 3, '0', '0', '0'),
(6, 4, '0', '0', '0'),
(7, 5, '0', '0', '0'),
(8, 6, '0', '0', '0'),
(9, 7, '0', '0', '0'),
(10, 8, '0', '0', '0'),
(11, 9, '0', '0', '0'),
(12, 10, '0', '0', '0'),
(13, 11, '0', '0', '0'),
(14, 12, '0', '0', '0'),
(15, 13, '0', '0', '0'),
(16, 14, '0', '0', '0'),
(17, 15, '0', '0', '0'),
(18, 16, '0', '0', '0'),
(19, 17, '0', '0', '0'),
(20, 18, '0', '0', '0'),
(21, 19, '0', '0', '0'),
(22, 20, '0', '0', '0'),
(23, 21, '0', '0', '0'),
(24, 22, '0', '0', '0'),
(25, 23, '0', '0', '0'),
(26, 24, '0', '0', '0'),
(27, 25, '0', '0', '0'),
(28, 26, '0', '0', '0'),
(29, 27, '0', '0', '0'),
(30, 28, '110', '1000', '9.0909090909091'),
(31, 29, '0', '0', '0'),
(32, 30, '0', '0', '0'),
(33, 31, '0', '0', '0'),
(34, 32, '0', '0', '0'),
(35, 33, '0', '0', '0'),
(36, 34, '0', '0', '0'),
(37, 35, '0', '0', '0'),
(38, 36, '0', '0', '0'),
(39, 37, '0', '0', '0'),
(40, 38, '0', '0', '0'),
(41, 39, '0', '0', '0'),
(42, 40, '471', '24501.42', '52.02'),
(43, 41, '0', '0', '0'),
(44, 42, '0', '0', '0'),
(45, 43, '0', '0', '0'),
(46, 44, '0', '0', '0'),
(47, 45, '0', '0', '0'),
(48, 46, '0', '0', '0'),
(49, 47, '0', '0', '0'),
(50, 48, '0', '0', '0'),
(51, 49, '0', '0', '0'),
(52, 50, '0', '0', '0'),
(53, 51, '0', '0', '0'),
(54, 52, '941', '423450', '450'),
(55, 53, '2927', '439050', '150'),
(56, 54, '39798', '9949500', '250'),
(57, 55, '457', '365600', '800'),
(58, 56, '5980', '2990000', '500'),
(59, 57, '0', '0', '0'),
(60, 58, '750', '75000', '100'),
(61, 59, '-8888089', '-4444044500', '500'),
(62, 60, '0', '0', '0'),
(63, 61, '0', '0', '0'),
(64, 62, '0', '0', '0'),
(65, 63, '0', '0', '0'),
(66, 64, '0', '0', '0'),
(67, 65, '0', '0', '0'),
(68, 66, '0', '0', '0'),
(69, 67, '0', '0', '0'),
(70, 68, '0', '0', '0'),
(71, 69, '0', '0', '0'),
(72, 70, '0', '0', '0'),
(73, 71, '0', '0', '0'),
(74, 72, '0', '0', '0'),
(75, 73, '0', '0', '0'),
(76, 74, '0', '0', '0'),
(77, 75, '0', '0', '0'),
(78, 76, '0', '0', '0'),
(79, 77, '0', '0', '0'),
(80, 78, '0', '0', '0'),
(81, 79, '0', '0', '0'),
(82, 80, '0', '0', '0'),
(83, 81, '0', '0', '0'),
(84, 82, '0', '0', '0'),
(85, 83, '0', '0', '0'),
(86, 84, '0', '0', '0'),
(87, 85, '0', '0', '0'),
(88, 86, '0', '0', '0'),
(89, 87, '0', '0', '0'),
(90, 88, '0', '0', '0'),
(91, 89, '0', '0', '0'),
(92, 90, '0', '0', '0'),
(93, 91, '0', '0', '0'),
(94, 92, '0', '0', '0'),
(95, 93, '0', '0', '0'),
(96, 94, '0', '0', '0'),
(97, 95, '0', '0', '0'),
(98, 96, '0', '0', '0'),
(99, 97, '0', '0', '0'),
(100, 98, '0', '0', '0'),
(101, 99, '0', '0', '0'),
(102, 100, '0', '0', '0'),
(103, 101, '0', '0', '0'),
(104, 102, '0', '0', '0'),
(105, 103, '0', '0', '0'),
(106, 104, '0', '0', '0'),
(107, 105, '0', '0', '0'),
(108, 106, '0', '0', '0'),
(109, 107, '0', '0', '0'),
(110, 108, '0', '0', '0'),
(111, 109, '0', '0', '0'),
(112, 110, '0', '0', '0'),
(113, 111, '0', '0', '0'),
(114, 112, '0', '0', '0'),
(115, 113, '0', '0', '0'),
(116, 114, '99', '31887.9', '322.1'),
(117, 115, '357.88', '3835.164', '10.716340672851'),
(118, 116, '0', '0', '0'),
(119, 117, '0', '0', '0'),
(120, 118, '112', '11016.393442623', '98.360655737705'),
(121, 119, '0', '0', '0'),
(122, 120, '0', '0', '0'),
(123, 121, '0', '0', '0'),
(124, 122, '0', '0', '0'),
(125, 123, '0', '0', '0'),
(126, 124, '0', '0', '0'),
(127, 125, '0', '0', '0'),
(128, 126, '0', '0', '0'),
(129, 127, '0', '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_ventas`
--

CREATE TABLE IF NOT EXISTS `min_ventas` (
`codigo` int(11) NOT NULL,
  `codigo_articulo` int(11) NOT NULL,
  `codigo_cliente` int(11) NOT NULL,
  `fecha_venta` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_entrega` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_factura` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_empleado` int(11) NOT NULL,
  `costo_unidad` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `devolucion` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `venta_credito` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `cobrado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `codigo_cobrador` int(11) NOT NULL,
  `venta_colectivo` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `min_ventas`
--

INSERT INTO `min_ventas` (`codigo`, `codigo_articulo`, `codigo_cliente`, `fecha_venta`, `fecha_entrega`, `codigo_factura`, `cantidad`, `codigo_empleado`, `costo_unidad`, `devolucion`, `venta_credito`, `cobrado`, `codigo_cobrador`, `venta_colectivo`) VALUES
(1, 40, 2, '2014-10-02', '2014-10-01', '1', '2', 34, '52.02', 'n', 'si', '2014-02-03', 52, 'no'),
(2, 40, 2, '2014-02-04', '2014-10-15', 'ff-gg-kk', '2', 52, '52.02', 'n', 'si', 'si', 52, 'si'),
(3, 40, 4, '2014-10-13', '2014-10-13', 'ff.kk', '10', 47, '52.02', 'n', 'si', 'no', 0, 'no'),
(4, 40, 3, '2014-02-05', '2014-10-07', 'gg-44', '10', 47, '52.02', 'n', 'si', 'no', 0, 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_antiguedad`
--

CREATE TABLE IF NOT EXISTS `mno_antiguedad` (
`codigo` int(11) NOT NULL,
  `anos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diasbono` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `mno_antiguedad`
--

INSERT INTO `mno_antiguedad` (`codigo`, `anos`, `diasbono`) VALUES
(1, '1', 16),
(2, '2', 17),
(3, '3', 18),
(4, '4', 19),
(5, '5', 20),
(6, '6', 21),
(7, '7', 22),
(8, '8', 23),
(9, '9', 24),
(10, '10', 25),
(11, '11', 26),
(12, '12', 27),
(13, '13', 28),
(14, '14', 29),
(15, '15', 30),
(16, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_beneficio_proceso`
--

CREATE TABLE IF NOT EXISTS `mno_beneficio_proceso` (
`codigo` int(11) NOT NULL,
  `codigo_empleado` int(11) NOT NULL,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `monto` varchar(50) NOT NULL,
  `codigo_tipo` int(11) NOT NULL,
  `codigo_hijo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_cargalaboral`
--

CREATE TABLE IF NOT EXISTS `mno_cargalaboral` (
`codigo` int(11) NOT NULL,
  `codigoempleado` int(11) DEFAULT NULL,
  `codigomes` int(11) DEFAULT NULL,
  `codigosemana` int(11) DEFAULT NULL,
  `bonos_fijos` varchar(255) DEFAULT NULL,
  `asignaciones_fijas` varchar(255) DEFAULT NULL,
  `horas_extras_diurnas` varchar(255) DEFAULT NULL,
  `horas_extras_nocturnas` varchar(255) DEFAULT NULL,
  `total_primas` varchar(255) DEFAULT NULL,
  `diferencia_sueldo` varchar(255) DEFAULT NULL,
  `cestaticket` varchar(255) DEFAULT NULL,
  `cestaticket_adicional` varchar(255) DEFAULT NULL,
  `monto_feriado` varchar(255) DEFAULT NULL,
  `bono_vacacional` varchar(255) DEFAULT NULL,
  `utilidades` varchar(255) DEFAULT NULL,
  `aguinaldos` varchar(255) DEFAULT NULL,
  `comisiones` varchar(255) DEFAULT NULL,
  `bono_post_vacacional` varchar(255) DEFAULT NULL,
  `dias_prestaciones` varchar(255) DEFAULT NULL,
  `interes_prestaciones` varchar(255) DEFAULT NULL,
  `seguro_social` varchar(255) DEFAULT NULL,
  `pie` varchar(255) DEFAULT NULL,
  `banavih` varchar(255) DEFAULT NULL,
  `inces` varchar(255) DEFAULT NULL,
  `sindical` varchar(255) DEFAULT NULL,
  `deporte` varchar(255) DEFAULT NULL,
  `caja_ahorro` varchar(255) DEFAULT NULL,
  `total_obl` varchar(255) DEFAULT NULL,
  `cargalaboral` varchar(255) DEFAULT NULL,
  `cargalaboral_veces` varchar(255) DEFAULT NULL,
  `cargalaboral_porc` varchar(255) DEFAULT NULL,
  `sueldo_base` varchar(255) DEFAULT NULL,
  `salario_normal` varchar(255) DEFAULT NULL,
  `salario_integral` varchar(255) DEFAULT NULL,
  `bono_nocturno` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `mno_cargalaboral`
--

INSERT INTO `mno_cargalaboral` (`codigo`, `codigoempleado`, `codigomes`, `codigosemana`, `bonos_fijos`, `asignaciones_fijas`, `horas_extras_diurnas`, `horas_extras_nocturnas`, `total_primas`, `diferencia_sueldo`, `cestaticket`, `cestaticket_adicional`, `monto_feriado`, `bono_vacacional`, `utilidades`, `aguinaldos`, `comisiones`, `bono_post_vacacional`, `dias_prestaciones`, `interes_prestaciones`, `seguro_social`, `pie`, `banavih`, `inces`, `sindical`, `deporte`, `caja_ahorro`, `total_obl`, `cargalaboral`, `cargalaboral_veces`, `cargalaboral_porc`, `sueldo_base`, `salario_normal`, `salario_integral`, `bono_nocturno`) VALUES
(4, 13, 1, 1, '145', '0', '21.46875', '46.515625', '183.2', '15.902777777778', '31.75', '146.05', '57.25', '50.888888888889', '190.83333333333', '127.22222222222', '1000', '63.611111111111', '462.00782638889', '6.1601043518519', '118.90384615385', '26.423076923077', '53.721840277778', '23.917777777778', '10', '0', '114.5', '685.43333333333', '4611.7709302066', '0.92235418604131', '-7.7645813958689', '5000', '5725', '13430.460069444', '31.010416666667'),
(5, 13, 1, 2, '145', '0', '21.46875', '46.515625', '183.2', '15.902777777778', '31.75', '146.05', '57.25', '50.888888888889', '190.83333333333', '127.22222222222', '1000', '63.611111111111', '462.00782638889', '6.1601043518519', '118.90384615385', '26.423076923077', '53.721840277778', '23.917777777778', '10', '0', '114.5', '685.43333333333', '4611.7709302066', '0.92235418604131', '-7.7645813958689', '5000', '5725', '13430.460069444', '31.010416666667'),
(6, 13, 1, 3, '145', '0', '21.46875', '46.515625', '183.2', '15.902777777778', '31.75', '146.05', '57.25', '50.888888888889', '190.83333333333', '127.22222222222', '1000', '63.611111111111', '462.00782638889', '6.1601043518519', '118.90384615385', '26.423076923077', '53.721840277778', '23.917777777778', '10', '0', '114.5', '685.43333333333', '4611.7709302066', '0.92235418604131', '-7.7645813958689', '5000', '5725', '13430.460069444', '31.010416666667'),
(7, 13, 1, 4, '145', '0', '21.46875', '46.515625', '183.2', '15.902777777778', '31.75', '146.05', '57.25', '50.888888888889', '190.83333333333', '127.22222222222', '1000', '63.611111111111', '462.00782638889', '6.1601043518519', '118.90384615385', '26.423076923077', '53.721840277778', '23.917777777778', '10', '0', '114.5', '685.43333333333', '4611.7709302066', '0.92235418604131', '-7.7645813958689', '5000', '5725', '13430.460069444', '31.010416666667'),
(8, 13, 1, 5, '145', '0', '21.46875', '46.515625', '183.2', '15.902777777778', '31.75', '146.05', '57.25', '50.888888888889', '190.83333333333', '127.22222222222', '1000', '63.611111111111', '462.00782638889', '6.1601043518519', '118.90384615385', '26.423076923077', '53.721840277778', '23.917777777778', '10', '0', '114.5', '685.43333333333', '4611.7709302066', '0.92235418604131', '-7.7645813958689', '5000', '5725', '13430.460069444', '31.010416666667'),
(9, 14, 8, 32, '0', '0', '0', '0', '0', '65.169270833333', '39.6875', '7.9375', '0', '0', '782.03125', '0', '0', '0', '952.77473958333', '12.703663194444', '389.8125', '86.625', '110.78776041667', '93.84375', '0', '0', '0', '0', '7233.5604340278', '0.38540448532949', '-61.459551467051', '18768.75', '18768.75', '22157.552083333', '0'),
(10, 14, 8, 33, '0', '0', '0', '0', '0', '65.169270833333', '39.6875', '7.9375', '0', '0', '782.03125', '0', '0', '0', '952.77473958333', '12.703663194444', '389.8125', '86.625', '110.78776041667', '93.84375', '0', '0', '0', '0', '7233.5604340278', '0.38540448532949', '-61.459551467051', '18768.75', '18768.75', '22157.552083333', '0'),
(11, 14, 8, 34, '0', '0', '0', '0', '0', '65.169270833333', '39.6875', '7.9375', '0', '0', '782.03125', '0', '0', '0', '952.77473958333', '12.703663194444', '389.8125', '86.625', '110.78776041667', '93.84375', '0', '0', '0', '0', '7233.5604340278', '0.38540448532949', '-61.459551467051', '18768.75', '18768.75', '22157.552083333', '0'),
(12, 14, 8, 35, '0', '0', '0', '0', '0', '65.169270833333', '39.6875', '7.9375', '0', '0', '782.03125', '0', '0', '0', '952.77473958333', '12.703663194444', '389.8125', '86.625', '110.78776041667', '93.84375', '0', '0', '0', '0', '7233.5604340278', '0.38540448532949', '-61.459551467051', '18768.75', '18768.75', '22157.552083333', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_concepto`
--

CREATE TABLE IF NOT EXISTS `mno_concepto` (
`codigo` int(11) NOT NULL,
  `codigoproceso` varchar(8) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `asignacion` varchar(1) NOT NULL,
  `codigotipo` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=183 ;

--
-- Volcado de datos para la tabla `mno_concepto`
--

INSERT INTO `mno_concepto` (`codigo`, `codigoproceso`, `descripcion`, `asignacion`, `codigotipo`) VALUES
(101, 'p$1AASUE', 'Sueldo Base', 'S', 1),
(104, 'p$1DDNoc', 'Bono Nocturno', 'S', 1),
(105, 'p$1EENor', 'Salario Normal', 'S', 66),
(106, 'p$1FFHED', 'Horas Extras Diurnas', 'S', 1),
(107, 'p$1GGHEN', 'Horas Extras Nocturnas', 'S', 1),
(109, 'p$1HHhog', 'Prima por Hogar', 'S', 3),
(110, 'p$1HHveh', 'Prima por Vehiculo', 'S', 3),
(111, 'p$1JJDif', 'Diferencia de Salario', 'S', 1),
(112, 'p$1KKCes', 'Cesta Ticket Adicional', 'S', 1),
(113, 'p$1LLCes', 'Cesta Ticket', 'S', 1),
(114, 'p$1MMFer', 'Dias Feriados', 'S', 1),
(115, 'p$1NNVac', 'Bono Vacacional', 'S', 6),
(116, 'p$1OOUti', 'Utilidades', 'N', 6),
(117, 'p$1PPAgu', 'Aguinaldos', 'S', 6),
(118, 'p$1QQCom', 'Comisiones', 'N', 4),
(119, 'p$1RRSIn', 'Salario Integral', 'S', 67),
(120, 'p$1GHBNo', 'Bono Nocturno', 'S', 1),
(121, 'p$1RSSID', 'Salario Integral Diario', 'N', 68),
(122, 'p$1TABPV', 'Bono Post Vacacional', 'S', 6),
(123, 'p$1UApre', 'Prestaciones Sociales', 'S', 6),
(124, 'p$1UBInt', 'Intereses de Prestaciones Sociales', 'S', 6),
(125, 'p$1VAsso', 'Seguro Social Obligatorio', 'S', 5),
(126, 'p$1VBPie', 'PIE', 'S', 5),
(127, 'p$1VCBan', 'BANAVIH', 'S', 5),
(128, 'p$1VDinc', 'INCES', 'S', 5),
(129, 'p$1VEsin', 'Cuota Sindical', 'S', 5),
(132, 'p$1WAcaj', 'Caja de Ahorro Sueldo Base', 'S', 7),
(133, 'p$1WBcaj', 'Caja de Ahorro Salario Normal', 'S', 7),
(146, 'p$1CAEfi', 'Bono por Eficiencia', 'S', 1),
(147, 'p$1CBANT', 'Bono por Antiguedad', 'S', 1),
(148, 'p$1CDSer', 'Bono por AÃ±os de Servicio', 'S', 1),
(149, 'p$1EEnor', 'Salario Normal', 'S', 68),
(150, 'p$1MPant', 'Bono por Antiguedad Otros', 'S', 2),
(151, 'p$1MQser', 'Bono por AÃ±os de Servicio Otros', 'S', 2),
(152, 'p$1MNpro', 'Bono de Productividad', 'S', 2),
(153, 'p$1MRprf', 'Bono de Profesionalizacion', 'S', 2),
(154, 'p$1MNres', 'Bono de Responsabilidad', 'S', 2),
(155, 'p$1MSpro', 'Bono por Unidades Producidas', 'S', 2),
(156, 'p$1HJhij', 'Prima por Hijo (Cantidad)', 'S', 3),
(157, 'p$1HKhij', 'Prima por Hijo (Salario)', 'N', 3),
(158, 'p$1HHmat', 'Prima por Matrimonio', 'S', 3),
(159, 'p$1HHnac', 'Prima por Nacimiento', 'S', 3),
(160, 'p$1QRven', 'Comisiones por Ventas Totales', 'S', 4),
(161, 'p$1QSven', 'Comisiones por Ventas a Credito', 'S', 4),
(162, 'p$1QTven', 'Comisiones por Ventas de Contado', 'N', 4),
(163, 'p$1QXcob', 'Comision de Cobranza', 'S', 4),
(164, 'p$1RQcom', 'Complemento al Compensatorio', 'S', 1),
(165, 'p$1OOuti', 'Utilidades', 'S', 6),
(166, 'p$1NOvac', 'Vacaciones', 'S', 6),
(167, 'p$1UBint', 'Intereses de Prestaciones Sociales', 'N', 6),
(168, 'p$1XAbtr', 'Beca Trabajador', 'S', 7),
(169, 'p$1XKbec', 'Beca Hijos', 'S', 7),
(170, 'p$1XLmed', 'Asistencia MÃ©dica', 'S', 7),
(171, 'p$1XAjug', 'Juguetes', 'S', 7),
(172, 'p$1XFgua', 'Guarderia', 'S', 7),
(173, 'p$1XMnin', 'Dia del NiÃ±o', 'S', 7),
(174, 'p$1XNtra', 'Fin de AÃ±o de Trabajadores', 'S', 7),
(175, 'p$1XMffn', 'Fiesta Fin de AÃ±o NiÃ±os', 'S', 7),
(176, 'p$1XOobs', 'Obsequio Fin de AÃ±o', 'S', 7),
(177, 'p$1XMvac', 'Plan Vacacional', 'S', 7),
(178, 'p$1XNdma', 'Dia de la Madre', 'S', 7),
(179, 'p$1XNser', 'Servicio Recreacional', 'S', 7),
(180, 'p$1XAstr', 'Servicio de Transporte', 'S', 7),
(181, 'p$1XPuti', 'Utiles Escolares', 'S', 7),
(182, '', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_concepto_empleados`
--

CREATE TABLE IF NOT EXISTS `mno_concepto_empleados` (
`codigo` int(11) NOT NULL,
  `codigoempleado` int(11) DEFAULT NULL,
  `codigomes` int(11) DEFAULT NULL,
  `codigosemana` int(11) DEFAULT NULL,
  `codigoconcepto` int(11) DEFAULT NULL,
  `valor` varchar(120) DEFAULT NULL,
  `resultado` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_constante`
--

CREATE TABLE IF NOT EXISTS `mno_constante` (
`codigo` int(11) NOT NULL,
  `codigoproceso` varchar(8) DEFAULT NULL,
  `descripcion` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `asignacion` varchar(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=136 ;

--
-- Volcado de datos para la tabla `mno_constante`
--

INSERT INTO `mno_constante` (`codigo`, `codigoproceso`, `descripcion`, `asignacion`) VALUES
(64, 'c$BONX', 'Bono X', 'S'),
(65, 'c$BONY', 'Bono Y', 'S'),
(66, 'c$UTI', 'Dias de Utilidades', 'S'),
(67, 'c$GNA', 'Ganancia Neta AÃ±o Anterior', 'S'),
(68, 'c$SSO', '% Seguro Social Obligatorio', 'S'),
(69, 'c$PIE', '% PIE', 'S'),
(70, 'c$INC', '% INCES', 'S'),
(71, 'c$LDD', '% Ley del Deporte', 'S'),
(72, 'c$BAN', '% BANAVIH', 'S'),
(73, 'c$DPS', 'Dias Prestaciones Sociales', 'S'),
(74, 'c$DBV', 'Dias Bono Post Vacacional', 'S'),
(75, 'c$DAG', 'Dias de Aguinaldos', 'S'),
(76, 'c$TSI', 'Tasa de Interes', 'S'),
(77, 'c$SAL', 'Salario Minimo', 'S'),
(78, 'c$MULSSO', 'Multiplo de Tope de Seguro Social', 'S'),
(79, 'c$BNOC', 'Bono Nocturno', 'S'),
(80, 'c$UTC', 'Unidad Tributaria Cestaticker', 'S'),
(81, 'c$VEN', 'Monto por Ventas', 'S'),
(82, 'c$PCO', 'Porcentaje de Comisiones', 'S'),
(83, 'c$DME', 'Dias del Mes', 'S'),
(84, 'c$DSE', 'Dias de la Semana', 'S'),
(85, 'c$HED', 'Horas Extras Diurnas', 'S'),
(86, 'c$HEN', 'Horas Extras Nocturnas', 'S'),
(87, 'c$TURD', 'Horas de Turno Diurno', 'S'),
(88, 'c$TURM', 'Horas de Turno Mixto', 'S'),
(89, 'c$TURN', 'Horas de Turno Nocturno', 'S'),
(90, 'c$CVEN', 'Comision por Ventas', 'S'),
(91, 'c$PHED', 'Porcentaje de Horas Extras Diurnas', 'S'),
(92, 'c$PHEN', 'Porcentaje de Horas Extras Nocturnas', 'S'),
(93, 'c$HDD', 'Horas del Dia', 'S'),
(94, 'c$UTR', 'Unidad Tributaria', 'S'),
(95, 'c$CBN', 'Constante de Bono Nocturno', 'S'),
(96, 'c$UBON', 'Constante de Uso de Bono Nocturno', 'S'),
(97, 'c$PRIHIJ', 'Constante de Prima por Hijo', 'S'),
(98, 'c$PRIHOG', 'Contante de Prima por Hogar', 'S'),
(99, 'c$PRIVEH', 'Contante de Prima por Vehiculo', 'S'),
(100, 'c$CDA', 'Constante de Dias Adicionales', 'S'),
(101, 'c$MES', 'Numero de Meses del AÃ±o', 'S'),
(102, 'c$DLA', 'Dias Laborados', 'S'),
(103, 'c$DFE', 'Constante de Dia Feriado', 'S'),
(104, 'c$VAC', 'Contante de Bono Vacacional', 'S'),
(105, 'c$DIAA', 'Dias del AÃ±o', 'S'),
(106, 'c$SIN', 'Constante de Salario Integral', 'S'),
(107, 'c$DPV', 'Contante de Dia Post Vacacional Unitario', 'S'),
(108, 'c$CPU', 'Constante de Prestaciones Unitaria', 'S'),
(109, 'c$CSS', 'Constante de Calculo de Seguro Social', 'S'),
(110, 'c$CPI', 'Constante de Calculo de PIE', 'S'),
(111, 'c$SID', 'Constante Unitaria de Asignacion Sindical', 'S'),
(113, 'c$NTR', 'Numero Total de Trabajadores', 'S'),
(114, 'c$CAB', 'Caja de Ahorro Salario Base', 'S'),
(115, 'c$CAN', 'Caja de Ahorro Salario Normal', 'S'),
(116, 'c$CAI', 'Caja de Ahorro Salario Integral', 'S'),
(117, 'c$OBLUTI', 'Utiles Escolares', 'S'),
(118, 'c$OBLJUG', 'Juguetes', 'S'),
(120, 'c$OBLBPH', 'Beca por Hijo', 'S'),
(121, 'c$OBLBPT', 'Beca por Trabajador', 'S'),
(122, 'c$OBLGUA', 'Guarderia', 'S'),
(123, 'c$OBLDNI', 'Dia del NiÃ±o', 'S'),
(124, 'c$OBLTRA', 'Monto a Trabajadores', 'S'),
(125, 'c$OBLNIN', 'Fiesta de fin de aÃ±o NiÃ±o', 'S'),
(126, 'c$OBS', 'Obsequio de Fin de AÃ±o', 'S'),
(127, 'c$OBLOFA', 'Obsequio de Fin de AÃ±o', 'S'),
(128, 'c$SMM', 'Constante Semestral', 'S'),
(129, 'c$OBLDUN', 'Dotacion de Uniforme', 'S'),
(130, 'c$OBLASI', 'Asistencia Medica', 'S'),
(131, 'c$SAN', 'Salario Normal', 'S'),
(132, 'c$SUE', 'Sueldo Base', 'S'),
(133, 'c$SIND', 'Salario Integral Diario', 'S'),
(134, 'c$1AAasd', '1', 'N'),
(135, 'c$1ABs', '23', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_departamento`
--

CREATE TABLE IF NOT EXISTS `mno_departamento` (
`codigo` int(11) NOT NULL,
  `codigoalias` varchar(8) DEFAULT NULL,
  `codigogerencia` int(11) DEFAULT NULL,
  `codigounidad` int(11) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `mno_departamento`
--

INSERT INTO `mno_departamento` (`codigo`, `codigoalias`, `codigogerencia`, `codigounidad`, `descripcion`) VALUES
(17, 'GERGERGE', 7, 13, 'Gerencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_empleadoxnomina`
--

CREATE TABLE IF NOT EXISTS `mno_empleadoxnomina` (
`codigo` int(11) NOT NULL,
  `codigonomina` int(11) DEFAULT NULL,
  `codigoempleado` int(11) DEFAULT NULL,
  `salariobase` varchar(255) DEFAULT NULL,
  `fechaingreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_gerencia`
--

CREATE TABLE IF NOT EXISTS `mno_gerencia` (
`codigo` int(11) NOT NULL,
  `codigoalias` varchar(8) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `codigo_depende` int(11) NOT NULL,
  `etapa` varchar(2) NOT NULL,
  `profundidad` varchar(6) NOT NULL,
  `nombre_depende` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Volcado de datos para la tabla `mno_gerencia`
--

INSERT INTO `mno_gerencia` (`codigo`, `codigoalias`, `descripcion`, `codigo_depende`, `etapa`, `profundidad`, `nombre_depende`) VALUES
(7, 'DIRECT', 'Junta Directiva', 0, 'no', '', ''),
(12, 'PRESIDEN', 'Presidecia', 7, 'no', '1', 'Junta Directiva'),
(43, '', 'gerenca de Comercialización', 12, 'no', '2', 'Presidecia'),
(44, '', 'Gerencia Producción', 12, 'no', '2', 'Presidecia'),
(45, '', 'Gerencia de Administración', 12, 'no', '2', 'Presidecia'),
(46, '', 'Producto Semielaborado', 44, 'no', '3', 'Gerencia Producción'),
(47, '', 'Producto Elaborado', 44, 'no', '3', 'Gerencia Producción'),
(48, '', 'Mantenimiento', 44, 'no', '3', 'Gerencia Producción'),
(49, '', 'Mezclado', 46, 'si', '4', 'Producto Semielaborado'),
(50, '', 'Mezclado Rigor', 46, 'si', '4', 'Producto Semielaborado'),
(51, '', 'Vaciado', 46, 'si', '4', 'Producto Semielaborado'),
(52, '', 'Laminado', 46, 'si', '4', 'Producto Semielaborado'),
(53, '', 'Metalurgica', 46, 'si', '4', 'Producto Semielaborado'),
(54, '', 'Ensamblaje', 47, 'si', '4', 'Producto Elaborado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_new_bonos_produccion`
--

CREATE TABLE IF NOT EXISTS `mno_new_bonos_produccion` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tipo_concepto` int(11) DEFAULT NULL,
  `codigo_formula` varchar(45) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `tipo_forma_pago` int(11) DEFAULT NULL,
  `tipo_periocidad` int(11) DEFAULT NULL COMMENT 'tabla para guardar los nuevos bonos de produccion',
  `eliminado` varchar(12) DEFAULT 'no',
  `fijo` varchar(2) DEFAULT 'no'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `mno_new_bonos_produccion`
--

INSERT INTO `mno_new_bonos_produccion` (`codigo`, `nombre`, `tipo_concepto`, `codigo_formula`, `valor`, `tipo_forma_pago`, `tipo_periocidad`, `eliminado`, `fijo`) VALUES
(4, 'bonoUno2', 2, 'bonoUno2', '11', 1, 1, '2014-10-03', 'si'),
(5, 'prepararioncadaber', 2, 'prepararioncadaber', '400', 0, 0, 'no', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_new_bono_variable`
--

CREATE TABLE IF NOT EXISTS `mno_new_bono_variable` (
`codigo` int(11) NOT NULL,
  `codigo_empleado` int(11) NOT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `periocidad` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `mno_new_bono_variable`
--

INSERT INTO `mno_new_bono_variable` (`codigo`, `codigo_empleado`, `valor`, `periocidad`) VALUES
(1, 1, '0', 1),
(2, 2, '1', NULL),
(3, 4, '100', NULL),
(4, 3, '100', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_new_concepto`
--

CREATE TABLE IF NOT EXISTS `mno_new_concepto` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_concepto` int(11) NOT NULL,
  `codigo_formula` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_forma_pago` int(11) NOT NULL,
  `tipo_periocidad` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=62 ;

--
-- Volcado de datos para la tabla `mno_new_concepto`
--

INSERT INTO `mno_new_concepto` (`codigo`, `nombre`, `tipo_concepto`, `codigo_formula`, `valor`, `tipo_forma_pago`, `tipo_periocidad`) VALUES
(1, 'Sueldo Base', 1, 'sueldoBase', '', 0, 0),
(3, 'horas Extras Diarias Adicional(turno)', 1, 'horasExtraDiariaAdicionalTurno', '', 0, 0),
(4, 'Horas Extras Nocturnas(Turno)', 1, 'horasExtrasNocturnasTurno', '', 0, 0),
(5, 'Cesta Ticket Adicional', 1, 'cestaTicketAdicional', '', 0, 0),
(6, 'Dias Feriados', 1, 'diasFeriados', '', 0, 0),
(9, 'Bono Antigüedad', 2, 'bonoAntiguedad', '', 0, 0),
(10, 'Bono Año de Servicio', 2, 'bonoAnhioServicio', '', 0, 0),
(11, 'Bono Eficiencia', 2, 'bonoEficiencia', '2000', 0, 6),
(12, 'Productividad', 2, 'productividad', '1500', 0, 6),
(13, 'Profesionalizacion', 2, 'profesionalizacion', '2', 0, 0),
(14, 'Responsabilidad', 2, 'responsabilidad', '10', 0, 1),
(15, 'Vehiculo', 2, 'vehiculo', '3', 0, 1),
(16, 'Unidades Producidas', 2, 'unidadesProducidas', '', 0, 0),
(17, 'Prima por Hijos', 3, 'primaHijos', '3', 2, 1),
(18, 'Prima por Hogar', 3, 'primaHogar', '2', 2, 6),
(19, 'Prima por Matrimonio', 3, 'primaMatrimonio', '2', 2, 6),
(20, 'Prima por Nacimiento', 3, 'primaNacimiento', '2', 2, 6),
(21, 'Ventas Totales', 4, 'ventasTotales', '', 0, 0),
(22, 'Ventas a  Crédito', 4, 'ventasCredito', '', 0, 0),
(23, 'Ventas Colectivo', 4, 'ventasColectivo', '', 0, 0),
(24, 'Cobranza', 4, 'cobranza', '', 0, 0),
(25, 'Seguro Social', 5, 'seguroSocial', '', 0, 0),
(26, 'Perdida Involuntaria de Empleo', 5, 'perdidaInvoluntariaEmpleo', '', 0, 0),
(27, 'Banavih', 5, 'banavih', '', 0, 0),
(28, 'Inces', 5, 'inces', '', 0, 0),
(29, 'Caja de Ahorro', 5, 'cajaAhorro', '', 0, 0),
(30, 'Cuota Sindical', 5, 'cuotaSindical', '', 0, 0),
(31, 'Utilidades', 6, 'utilidades', '', 0, 0),
(32, 'Aguinaldo', 6, 'aguinaldo', '', 0, 0),
(33, 'Bono Vacacional', 6, 'bonoVacacional', '', 0, 0),
(34, 'Bono Post Vacional', 6, 'bonoPostVacional', '', 0, 0),
(35, 'Prestaciones Sociales', 6, 'prestacionesSociales', '', 0, 0),
(36, 'Intereses Prestaciones Sociales', 6, 'interesesPrestacionesSociales', '', 0, 0),
(37, 'Beca de Trabajador', 7, 'becaTrabajador', '', 0, 0),
(38, 'Becas Hijos', 7, 'becasHijos', '', 0, 0),
(39, 'Asistencia Médica', 7, 'asistenciaMedica', '15000', 0, 6),
(40, 'Juguetes', 7, 'juguetes', '3', 2, 6),
(41, 'Guarderia', 7, 'guarderia', '500', 0, 1),
(42, 'Dotacion de Uniforme', 7, 'dotacionUniforme', '6000', 0, 5),
(43, 'Día del Niño', 7, 'diaNinho', '7500', 0, 6),
(44, 'Fiesta Fin de Año Trabajadores', 7, 'fiestaFinAnhoTrabajadores', '20000', 0, 6),
(45, 'Fiesta Fin de Año Niños', 7, 'fiestaFinAnhoNinhos', '8000', 0, 6),
(46, 'Obsequio Fin de Año', 7, 'obsequioFinAnho', '25000', 0, 6),
(47, 'Plan Vacacional', 7, 'planVacacional', '9000', 0, 6),
(48, 'Dia de la Madre', 7, 'diaMadre', '7500', 0, 6),
(49, 'Servicio Recreacional', 7, 'servicioRecreacional', '8000', 0, 6),
(50, 'Servicio de Transporte', 7, 'servicioTransporte', '6500', 0, 1),
(51, 'Utiles Escolares', 7, 'utilesEscolares', '3', 2, 6),
(52, 'Cesta Ticket ', 1, 'cestaTicket', '', 0, 0),
(54, 'Bono Nocturno Normal', 1, 'bonoNocturnoNormal', '', 0, 0),
(55, 'horas Extras Diarias Adicional(extraordinaria)', 1, 'horasExtraDiariaAdicionalExtraordinaria', '', 0, 0),
(56, 'horas Extras Nocturna Adicional(extraordinaria)', 1, 'horasExtraNocturnaAdicionalExtraordinaria', '', 0, 0),
(58, 'Sueldo Base Real', 1, 'sueldoBaseReal', '', 0, 0),
(59, 'Diferencia de Salario', 1, 'diferenciaSalaro', '', 0, 0),
(60, 'Bono eficiencia Variable ', 2, 'bonoEficienciaVariable', '', 0, 0),
(61, 'Bono Nocturno Extra', 1, 'bonoNocturnoExtra', '0', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_new_concepto_empleado`
--

CREATE TABLE IF NOT EXISTS `mno_new_concepto_empleado` (
  `codigo` int(11) NOT NULL,
  `codigo_empleado` int(11) NOT NULL,
  `codigo_concepto` int(11) NOT NULL,
  `semana_1` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `semana_2` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `semana_3` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `semana_4` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `semana_5` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `total` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `mes` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `anhio` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mno_new_concepto_empleado`
--

INSERT INTO `mno_new_concepto_empleado` (`codigo`, `codigo_empleado`, `codigo_concepto`, `semana_1`, `semana_2`, `semana_3`, `semana_4`, `semana_5`, `total`, `mes`, `anhio`, `eliminado`) VALUES
(0, 1, 16, '9', '9', '9', '9', '0', '36', '10', '2014', 'no'),
(0, 1, 12, '31.25', '31.25', '31.25', '31.25', '0', '125', '10', '2014', 'no'),
(0, 1, 60, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 15, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 11, '41.666666666667', '41.666666666667', '41.666666666667', '41.666666666667', '0', '166.66666666667', '10', '2014', 'no'),
(0, 1, 13, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 14, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 1, '1038.4615384615', '1038.4615384615', '1038.4615384615', '1038.4615384615', '0', '4153.8461538462', '10', '2014', 'no'),
(0, 1, 58, '1038.4615384615', '1038.4615384615', '1038.4615384615', '1038.4615384615', '0', '4500', '10', '2014', 'no'),
(0, 1, 5, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 52, '182.5625', '182.5625', '182.5625', '182.5625', '0', '730.25', '10', '2014', 'no'),
(0, 1, 9, '325', '325', '325', '325', '0', '1300', '10', '2014', 'no'),
(0, 1, 10, '12.5', '12.5', '12.5', '12.5', '0', '50', '10', '2014', 'no'),
(0, 1, 21, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 22, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 23, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 24, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 54, '266.1204866562', '266.1204866562', '266.1204866562', '266.1204866562', '0', '1064.4819466248', '10', '2014', 'no'),
(0, 1, 3, '0', '0', '354.8273155416', '0', '354.8273155416', '1419.3092621664', '10', '2014', 'no'),
(0, 1, 4, '0', '0', '634.25382653061', '0', '634.25382653061', '2537.0153061224', '10', '2014', 'no'),
(0, 1, 55, '419.99967962067', '419.99967962067', '419.99967962067', '419.99967962067', '0', '1679.9987184827', '10', '2014', 'no'),
(0, 1, 56, '750.74942732195', '750.74942732195', '750.74942732195', '750.74942732195', '0', '3002.9977092878', '10', '2014', 'no'),
(0, 1, 61, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 59, '20.123308404558', '20.123308404558', '20.123308404558', '20.123308404558', '0', '80.493233618234', '10', '2014', 'no'),
(0, 1, 6, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 17, '190.5', '190.5', '190.5', '190.5', '0', '762', '10', '2014', 'no'),
(0, 1, 19, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 18, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 20, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 25, '130.39903846154', '130.39903846154', '130.39903846154', '130.39903846154', '0', '521.59615384615', '10', '2014', 'no'),
(0, 1, 26, '28.977564102564', '28.977564102564', '28.977564102564', '28.977564102564', '0', '115.91025641026', '10', '2014', 'no'),
(0, 1, 27, '49.717428550218', '49.717428550218', '49.717428550218', '49.717428550218', '0', '198.86971420087', '10', '2014', 'no'),
(0, 1, 28, '28.977564102564', '28.977564102564', '28.977564102564', '28.977564102564', '0', '115.91025641026', '10', '2014', 'no'),
(0, 1, 29, '103.84615384615', '103.84615384615', '103.84615384615', '103.84615384615', '0', '415.38461538462', '10', '2014', 'no'),
(0, 1, 30, '12.5', '12.5', '12.5', '12.5', '0', '50', '10', '2014', 'no'),
(0, 1, 31, '120.73985042735', '120.73985042735', '120.73985042735', '120.73985042735', '0', '482.9594017094', '10', '2014', 'no'),
(0, 1, 32, '60.369925213675', '60.369925213675', '60.369925213675', '60.369925213675', '0', '241.4797008547', '10', '2014', 'no'),
(0, 1, 33, '120.73985042735', '120.73985042735', '120.73985042735', '120.73985042735', '0', '482.9594017094', '10', '2014', 'no'),
(0, 1, 34, '60.369925213675', '60.369925213675', '60.369925213675', '60.369925213675', '0', '241.4797008547', '10', '2014', 'no'),
(0, 1, 35, '776.18475274725', '776.18475274725', '776.18475274725', '776.18475274725', '0', '3104.739010989', '10', '2014', 'no'),
(0, 1, 36, '10.34913003663', '10.34913003663', '10.34913003663', '10.34913003663', '0', '41.39652014652', '10', '2014', 'no'),
(0, 1, 37, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 38, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 39, '18.028846153846', '18.028846153846', '18.028846153846', '18.028846153846', '0', '72.115384615385', '10', '2014', 'no'),
(0, 1, 40, '14.653846153846', '14.653846153846', '14.653846153846', '14.653846153846', '0', '58.615384615385', '10', '2014', 'no'),
(0, 1, 41, '250', '250', '250', '250', '0', '1000', '10', '2014', 'no'),
(0, 1, 43, '48.076923076923', '48.076923076923', '48.076923076923', '48.076923076923', '0', '192.30769230769', '10', '2014', 'no'),
(0, 1, 44, '24.038461538462', '24.038461538462', '24.038461538462', '24.038461538462', '0', '96.153846153846', '10', '2014', 'no'),
(0, 1, 45, '51.282051282051', '51.282051282051', '51.282051282051', '51.282051282051', '0', '205.12820512821', '10', '2014', 'no'),
(0, 1, 46, '30.048076923077', '30.048076923077', '30.048076923077', '30.048076923077', '0', '120.19230769231', '10', '2014', 'no'),
(0, 1, 47, '57.692307692308', '57.692307692308', '57.692307692308', '57.692307692308', '0', '230.76923076923', '10', '2014', 'no'),
(0, 1, 48, '9.0144230769231', '9.0144230769231', '9.0144230769231', '9.0144230769231', '0', '36.057692307692', '10', '2014', 'no'),
(0, 1, 49, '51.282051282051', '51.282051282051', '51.282051282051', '51.282051282051', '0', '205.12820512821', '10', '2014', 'no'),
(0, 1, 50, '101.5625', '101.5625', '101.5625', '101.5625', '0', '406.25', '10', '2014', 'no'),
(0, 1, 51, '14.653846153846', '14.653846153846', '14.653846153846', '14.653846153846', '0', '58.615384615385', '10', '2014', 'no'),
(0, 1, 16, '9', '9', '9', '9', '0', '36', '10', '2014', 'no'),
(0, 1, 12, '31.25', '31.25', '31.25', '31.25', '0', '125', '10', '2014', 'no'),
(0, 1, 60, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 15, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 11, '41.666666666667', '41.666666666667', '41.666666666667', '41.666666666667', '0', '166.66666666667', '10', '2014', 'no'),
(0, 1, 13, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 14, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 1, '1038.4615384615', '1038.4615384615', '1038.4615384615', '1038.4615384615', '0', '4153.8461538462', '10', '2014', 'no'),
(0, 1, 58, '1038.4615384615', '1038.4615384615', '1038.4615384615', '1038.4615384615', '0', '4500', '10', '2014', 'no'),
(0, 1, 5, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 52, '182.5625', '182.5625', '182.5625', '182.5625', '0', '730.25', '10', '2014', 'no'),
(0, 1, 9, '325', '325', '325', '325', '0', '1300', '10', '2014', 'no'),
(0, 1, 10, '12.5', '12.5', '12.5', '12.5', '0', '50', '10', '2014', 'no'),
(0, 1, 21, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 22, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 23, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 24, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 54, '266.1204866562', '266.1204866562', '266.1204866562', '266.1204866562', '0', '1064.4819466248', '10', '2014', 'no'),
(0, 1, 3, '0', '0', '354.8273155416', '0', '354.8273155416', '1419.3092621664', '10', '2014', 'no'),
(0, 1, 4, '0', '0', '634.25382653061', '0', '634.25382653061', '2537.0153061224', '10', '2014', 'no'),
(0, 1, 55, '419.99967962067', '419.99967962067', '419.99967962067', '419.99967962067', '0', '1679.9987184827', '10', '2014', 'no'),
(0, 1, 56, '750.74942732195', '750.74942732195', '750.74942732195', '750.74942732195', '0', '3002.9977092878', '10', '2014', 'no'),
(0, 1, 61, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 59, '20.123308404558', '20.123308404558', '20.123308404558', '20.123308404558', '0', '80.493233618234', '10', '2014', 'no'),
(0, 1, 6, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 17, '190.5', '190.5', '190.5', '190.5', '0', '762', '10', '2014', 'no'),
(0, 1, 19, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 18, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 20, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 25, '130.39903846154', '130.39903846154', '130.39903846154', '130.39903846154', '0', '521.59615384615', '10', '2014', 'no'),
(0, 1, 26, '28.977564102564', '28.977564102564', '28.977564102564', '28.977564102564', '0', '115.91025641026', '10', '2014', 'no'),
(0, 1, 27, '49.717428550218', '49.717428550218', '49.717428550218', '49.717428550218', '0', '198.86971420087', '10', '2014', 'no'),
(0, 1, 28, '28.977564102564', '28.977564102564', '28.977564102564', '28.977564102564', '0', '115.91025641026', '10', '2014', 'no'),
(0, 1, 29, '103.84615384615', '103.84615384615', '103.84615384615', '103.84615384615', '0', '415.38461538462', '10', '2014', 'no'),
(0, 1, 30, '12.5', '12.5', '12.5', '12.5', '0', '50', '10', '2014', 'no'),
(0, 1, 31, '120.73985042735', '120.73985042735', '120.73985042735', '120.73985042735', '0', '482.9594017094', '10', '2014', 'no'),
(0, 1, 32, '60.369925213675', '60.369925213675', '60.369925213675', '60.369925213675', '0', '241.4797008547', '10', '2014', 'no'),
(0, 1, 33, '120.73985042735', '120.73985042735', '120.73985042735', '120.73985042735', '0', '482.9594017094', '10', '2014', 'no'),
(0, 1, 34, '60.369925213675', '60.369925213675', '60.369925213675', '60.369925213675', '0', '241.4797008547', '10', '2014', 'no'),
(0, 1, 35, '776.18475274725', '776.18475274725', '776.18475274725', '776.18475274725', '0', '3104.739010989', '10', '2014', 'no'),
(0, 1, 36, '10.34913003663', '10.34913003663', '10.34913003663', '10.34913003663', '0', '41.39652014652', '10', '2014', 'no'),
(0, 1, 37, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 38, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 39, '18.028846153846', '18.028846153846', '18.028846153846', '18.028846153846', '0', '72.115384615385', '10', '2014', 'no'),
(0, 1, 40, '14.653846153846', '14.653846153846', '14.653846153846', '14.653846153846', '0', '58.615384615385', '10', '2014', 'no'),
(0, 1, 41, '250', '250', '250', '250', '0', '1000', '10', '2014', 'no'),
(0, 1, 43, '48.076923076923', '48.076923076923', '48.076923076923', '48.076923076923', '0', '192.30769230769', '10', '2014', 'no'),
(0, 1, 44, '24.038461538462', '24.038461538462', '24.038461538462', '24.038461538462', '0', '96.153846153846', '10', '2014', 'no'),
(0, 1, 45, '51.282051282051', '51.282051282051', '51.282051282051', '51.282051282051', '0', '205.12820512821', '10', '2014', 'no'),
(0, 1, 46, '30.048076923077', '30.048076923077', '30.048076923077', '30.048076923077', '0', '120.19230769231', '10', '2014', 'no'),
(0, 1, 47, '57.692307692308', '57.692307692308', '57.692307692308', '57.692307692308', '0', '230.76923076923', '10', '2014', 'no'),
(0, 1, 48, '9.0144230769231', '9.0144230769231', '9.0144230769231', '9.0144230769231', '0', '36.057692307692', '10', '2014', 'no'),
(0, 1, 49, '51.282051282051', '51.282051282051', '51.282051282051', '51.282051282051', '0', '205.12820512821', '10', '2014', 'no'),
(0, 1, 50, '101.5625', '101.5625', '101.5625', '101.5625', '0', '406.25', '10', '2014', 'no'),
(0, 1, 51, '14.653846153846', '14.653846153846', '14.653846153846', '14.653846153846', '0', '58.615384615385', '10', '2014', 'no'),
(0, 1, 42, '19.230769230769', '19.230769230769', '19.230769230769', '19.230769230769', '0', '76.92307692307692', '10', '2014', 'no'),
(0, 1, 16, '9', '9', '9', '9', '0', '36', '10', '2014', 'no'),
(0, 1, 12, '31.25', '31.25', '31.25', '31.25', '0', '125', '10', '2014', 'no'),
(0, 1, 60, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 15, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 11, '41.666666666667', '41.666666666667', '41.666666666667', '41.666666666667', '0', '166.66666666667', '10', '2014', 'no'),
(0, 1, 13, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 14, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 1, '1038.4615384615', '1038.4615384615', '1038.4615384615', '1038.4615384615', '0', '4153.8461538462', '10', '2014', 'no'),
(0, 1, 58, '1038.4615384615', '1038.4615384615', '1038.4615384615', '1038.4615384615', '0', '4500', '10', '2014', 'no'),
(0, 1, 5, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 52, '182.5625', '182.5625', '182.5625', '182.5625', '0', '730.25', '10', '2014', 'no'),
(0, 1, 9, '325', '325', '325', '325', '0', '1300', '10', '2014', 'no'),
(0, 1, 10, '12.5', '12.5', '12.5', '12.5', '0', '50', '10', '2014', 'no'),
(0, 1, 21, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 22, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 23, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 24, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 54, '266.1204866562', '266.1204866562', '266.1204866562', '266.1204866562', '0', '1064.4819466248', '10', '2014', 'no'),
(0, 1, 3, '0', '0', '354.8273155416', '0', '354.8273155416', '1419.3092621664', '10', '2014', 'no'),
(0, 1, 4, '0', '0', '634.25382653061', '0', '634.25382653061', '2537.0153061224', '10', '2014', 'no'),
(0, 1, 55, '419.99967962067', '419.99967962067', '419.99967962067', '419.99967962067', '0', '1679.9987184827', '10', '2014', 'no'),
(0, 1, 56, '750.74942732195', '750.74942732195', '750.74942732195', '750.74942732195', '0', '3002.9977092878', '10', '2014', 'no'),
(0, 1, 61, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 59, '20.123308404558', '20.123308404558', '20.123308404558', '20.123308404558', '0', '80.493233618234', '10', '2014', 'no'),
(0, 1, 6, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 17, '190.5', '190.5', '190.5', '190.5', '0', '762', '10', '2014', 'no'),
(0, 1, 19, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 18, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 20, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 25, '130.39903846154', '130.39903846154', '130.39903846154', '130.39903846154', '0', '521.59615384615', '10', '2014', 'no'),
(0, 1, 26, '28.977564102564', '28.977564102564', '28.977564102564', '28.977564102564', '0', '115.91025641026', '10', '2014', 'no'),
(0, 1, 27, '49.717428550218', '49.717428550218', '49.717428550218', '49.717428550218', '0', '198.86971420087', '10', '2014', 'no'),
(0, 1, 28, '28.977564102564', '28.977564102564', '28.977564102564', '28.977564102564', '0', '115.91025641026', '10', '2014', 'no'),
(0, 1, 29, '103.84615384615', '103.84615384615', '103.84615384615', '103.84615384615', '0', '415.38461538462', '10', '2014', 'no'),
(0, 1, 30, '12.5', '12.5', '12.5', '12.5', '0', '50', '10', '2014', 'no'),
(0, 1, 31, '120.73985042735', '120.73985042735', '120.73985042735', '120.73985042735', '0', '482.9594017094', '10', '2014', 'no'),
(0, 1, 32, '60.369925213675', '60.369925213675', '60.369925213675', '60.369925213675', '0', '241.4797008547', '10', '2014', 'no'),
(0, 1, 33, '120.73985042735', '120.73985042735', '120.73985042735', '120.73985042735', '0', '482.9594017094', '10', '2014', 'no'),
(0, 1, 34, '60.369925213675', '60.369925213675', '60.369925213675', '60.369925213675', '0', '241.4797008547', '10', '2014', 'no'),
(0, 1, 35, '776.18475274725', '776.18475274725', '776.18475274725', '776.18475274725', '0', '3104.739010989', '10', '2014', 'no'),
(0, 1, 36, '10.34913003663', '10.34913003663', '10.34913003663', '10.34913003663', '0', '41.39652014652', '10', '2014', 'no'),
(0, 1, 37, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 38, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 39, '18.028846153846', '18.028846153846', '18.028846153846', '18.028846153846', '0', '72.115384615385', '10', '2014', 'no'),
(0, 1, 40, '14.653846153846', '14.653846153846', '14.653846153846', '14.653846153846', '0', '58.615384615385', '10', '2014', 'no'),
(0, 1, 41, '250', '250', '250', '250', '0', '1000', '10', '2014', 'no'),
(0, 1, 43, '48.076923076923', '48.076923076923', '48.076923076923', '48.076923076923', '0', '192.30769230769', '10', '2014', 'no'),
(0, 1, 44, '24.038461538462', '24.038461538462', '24.038461538462', '24.038461538462', '0', '96.153846153846', '10', '2014', 'no'),
(0, 1, 45, '51.282051282051', '51.282051282051', '51.282051282051', '51.282051282051', '0', '205.12820512821', '10', '2014', 'no'),
(0, 1, 46, '30.048076923077', '30.048076923077', '30.048076923077', '30.048076923077', '0', '120.19230769231', '10', '2014', 'no'),
(0, 1, 47, '57.692307692308', '57.692307692308', '57.692307692308', '57.692307692308', '0', '230.76923076923', '10', '2014', 'no'),
(0, 1, 48, '9.0144230769231', '9.0144230769231', '9.0144230769231', '9.0144230769231', '0', '36.057692307692', '10', '2014', 'no'),
(0, 1, 49, '51.282051282051', '51.282051282051', '51.282051282051', '51.282051282051', '0', '205.12820512821', '10', '2014', 'no'),
(0, 1, 50, '101.5625', '101.5625', '101.5625', '101.5625', '0', '406.25', '10', '2014', 'no'),
(0, 1, 51, '14.653846153846', '14.653846153846', '14.653846153846', '14.653846153846', '0', '58.615384615385', '10', '2014', 'no'),
(0, 1, 42, '76.92307692307692', '76.92307692307692', '76.92307692307692', '76.92307692307692', '0', '76.92307692307692', '10', '2014', 'no'),
(0, 1, 16, '9', '9', '9', '9', '0', '36', '10', '2014', 'no'),
(0, 1, 12, '31.25', '31.25', '31.25', '31.25', '0', '125', '10', '2014', 'no'),
(0, 1, 60, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 15, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 11, '41.666666666667', '41.666666666667', '41.666666666667', '41.666666666667', '0', '166.66666666667', '10', '2014', 'no'),
(0, 1, 13, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 14, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 1, '1038.4615384615', '1038.4615384615', '1038.4615384615', '1038.4615384615', '0', '4153.8461538462', '10', '2014', 'no'),
(0, 1, 58, '1038.4615384615', '1038.4615384615', '1038.4615384615', '1038.4615384615', '0', '4500', '10', '2014', 'no'),
(0, 1, 5, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 52, '182.5625', '182.5625', '182.5625', '182.5625', '0', '730.25', '10', '2014', 'no'),
(0, 1, 9, '325', '325', '325', '325', '0', '1300', '10', '2014', 'no'),
(0, 1, 10, '12.5', '12.5', '12.5', '12.5', '0', '50', '10', '2014', 'no'),
(0, 1, 21, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 22, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 23, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 24, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 54, '266.1204866562', '266.1204866562', '266.1204866562', '266.1204866562', '0', '1064.4819466248', '10', '2014', 'no'),
(0, 1, 3, '0', '0', '354.8273155416', '0', '354.8273155416', '1419.3092621664', '10', '2014', 'no'),
(0, 1, 4, '0', '0', '634.25382653061', '0', '634.25382653061', '2537.0153061224', '10', '2014', 'no'),
(0, 1, 55, '419.99967962067', '419.99967962067', '419.99967962067', '419.99967962067', '0', '1679.9987184827', '10', '2014', 'no'),
(0, 1, 56, '750.74942732195', '750.74942732195', '750.74942732195', '750.74942732195', '0', '3002.9977092878', '10', '2014', 'no'),
(0, 1, 61, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 59, '20.123308404558', '20.123308404558', '20.123308404558', '20.123308404558', '0', '80.493233618234', '10', '2014', 'no'),
(0, 1, 6, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 17, '190.5', '190.5', '190.5', '190.5', '0', '762', '10', '2014', 'no'),
(0, 1, 19, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 18, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 20, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 25, '130.39903846154', '130.39903846154', '130.39903846154', '130.39903846154', '0', '521.59615384615', '10', '2014', 'no'),
(0, 1, 26, '28.977564102564', '28.977564102564', '28.977564102564', '28.977564102564', '0', '115.91025641026', '10', '2014', 'no'),
(0, 1, 27, '49.717428550218', '49.717428550218', '49.717428550218', '49.717428550218', '0', '198.86971420087', '10', '2014', 'no'),
(0, 1, 28, '28.977564102564', '28.977564102564', '28.977564102564', '28.977564102564', '0', '115.91025641026', '10', '2014', 'no'),
(0, 1, 29, '103.84615384615', '103.84615384615', '103.84615384615', '103.84615384615', '0', '415.38461538462', '10', '2014', 'no'),
(0, 1, 30, '12.5', '12.5', '12.5', '12.5', '0', '50', '10', '2014', 'no'),
(0, 1, 31, '120.73985042735', '120.73985042735', '120.73985042735', '120.73985042735', '0', '482.9594017094', '10', '2014', 'no'),
(0, 1, 32, '60.369925213675', '60.369925213675', '60.369925213675', '60.369925213675', '0', '241.4797008547', '10', '2014', 'no'),
(0, 1, 33, '120.73985042735', '120.73985042735', '120.73985042735', '120.73985042735', '0', '482.9594017094', '10', '2014', 'no'),
(0, 1, 34, '60.369925213675', '60.369925213675', '60.369925213675', '60.369925213675', '0', '241.4797008547', '10', '2014', 'no'),
(0, 1, 35, '776.18475274725', '776.18475274725', '776.18475274725', '776.18475274725', '0', '3104.739010989', '10', '2014', 'no'),
(0, 1, 36, '10.34913003663', '10.34913003663', '10.34913003663', '10.34913003663', '0', '41.39652014652', '10', '2014', 'no'),
(0, 1, 37, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 38, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 39, '18.028846153846', '18.028846153846', '18.028846153846', '18.028846153846', '0', '72.115384615385', '10', '2014', 'no'),
(0, 1, 40, '14.653846153846', '14.653846153846', '14.653846153846', '14.653846153846', '0', '58.615384615385', '10', '2014', 'no'),
(0, 1, 41, '250', '250', '250', '250', '0', '1000', '10', '2014', 'no'),
(0, 1, 43, '48.076923076923', '48.076923076923', '48.076923076923', '48.076923076923', '0', '192.30769230769', '10', '2014', 'no'),
(0, 1, 44, '24.038461538462', '24.038461538462', '24.038461538462', '24.038461538462', '0', '96.153846153846', '10', '2014', 'no'),
(0, 1, 45, '51.282051282051', '51.282051282051', '51.282051282051', '51.282051282051', '0', '205.12820512821', '10', '2014', 'no'),
(0, 1, 46, '30.048076923077', '30.048076923077', '30.048076923077', '30.048076923077', '0', '120.19230769231', '10', '2014', 'no'),
(0, 1, 47, '57.692307692308', '57.692307692308', '57.692307692308', '57.692307692308', '0', '230.76923076923', '10', '2014', 'no'),
(0, 1, 48, '9.0144230769231', '9.0144230769231', '9.0144230769231', '9.0144230769231', '0', '36.057692307692', '10', '2014', 'no'),
(0, 1, 49, '51.282051282051', '51.282051282051', '51.282051282051', '51.282051282051', '0', '205.12820512821', '10', '2014', 'no'),
(0, 1, 50, '101.5625', '101.5625', '101.5625', '101.5625', '0', '406.25', '10', '2014', 'no'),
(0, 1, 51, '14.653846153846', '14.653846153846', '14.653846153846', '14.653846153846', '0', '58.615384615385', '10', '2014', 'no'),
(0, 1, 16, '9', '9', '9', '9', '0', '36', '10', '2014', 'no'),
(0, 1, 12, '31.25', '31.25', '31.25', '31.25', '0', '125', '10', '2014', 'no'),
(0, 1, 60, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 15, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 11, '41.666666666667', '41.666666666667', '41.666666666667', '41.666666666667', '0', '166.66666666667', '10', '2014', 'no'),
(0, 1, 13, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 14, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 1, '1038.4615384615', '1038.4615384615', '1038.4615384615', '1038.4615384615', '0', '4153.8461538462', '10', '2014', 'no'),
(0, 1, 58, '1038.4615384615', '1038.4615384615', '1038.4615384615', '1038.4615384615', '0', '4500', '10', '2014', 'no'),
(0, 1, 5, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 52, '182.5625', '182.5625', '182.5625', '182.5625', '0', '730.25', '10', '2014', 'no'),
(0, 1, 9, '325', '325', '325', '325', '0', '1300', '10', '2014', 'no'),
(0, 1, 10, '12.5', '12.5', '12.5', '12.5', '0', '50', '10', '2014', 'no'),
(0, 1, 21, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 22, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 23, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 24, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 54, '266.1204866562', '266.1204866562', '266.1204866562', '266.1204866562', '0', '1064.4819466248', '10', '2014', 'no'),
(0, 1, 3, '0', '0', '354.8273155416', '0', '354.8273155416', '1419.3092621664', '10', '2014', 'no'),
(0, 1, 4, '0', '0', '634.25382653061', '0', '634.25382653061', '2537.0153061224', '10', '2014', 'no'),
(0, 1, 55, '419.99967962067', '419.99967962067', '419.99967962067', '419.99967962067', '0', '1679.9987184827', '10', '2014', 'no'),
(0, 1, 56, '750.74942732195', '750.74942732195', '750.74942732195', '750.74942732195', '0', '3002.9977092878', '10', '2014', 'no'),
(0, 1, 61, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 59, '20.123308404558', '20.123308404558', '20.123308404558', '20.123308404558', '0', '80.493233618234', '10', '2014', 'no'),
(0, 1, 6, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 17, '190.5', '190.5', '190.5', '190.5', '0', '762', '10', '2014', 'no'),
(0, 1, 19, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 18, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 20, '63.5', '63.5', '63.5', '63.5', '0', '254', '10', '2014', 'no'),
(0, 1, 25, '130.39903846154', '130.39903846154', '130.39903846154', '130.39903846154', '0', '521.59615384615', '10', '2014', 'no'),
(0, 1, 26, '28.977564102564', '28.977564102564', '28.977564102564', '28.977564102564', '0', '115.91025641026', '10', '2014', 'no'),
(0, 1, 27, '49.717428550218', '49.717428550218', '49.717428550218', '49.717428550218', '0', '198.86971420087', '10', '2014', 'no'),
(0, 1, 28, '28.977564102564', '28.977564102564', '28.977564102564', '28.977564102564', '0', '115.91025641026', '10', '2014', 'no'),
(0, 1, 29, '103.84615384615', '103.84615384615', '103.84615384615', '103.84615384615', '0', '415.38461538462', '10', '2014', 'no'),
(0, 1, 30, '12.5', '12.5', '12.5', '12.5', '0', '50', '10', '2014', 'no'),
(0, 1, 31, '120.73985042735', '120.73985042735', '120.73985042735', '120.73985042735', '0', '482.9594017094', '10', '2014', 'no'),
(0, 1, 32, '60.369925213675', '60.369925213675', '60.369925213675', '60.369925213675', '0', '241.4797008547', '10', '2014', 'no'),
(0, 1, 33, '120.73985042735', '120.73985042735', '120.73985042735', '120.73985042735', '0', '482.9594017094', '10', '2014', 'no'),
(0, 1, 34, '60.369925213675', '60.369925213675', '60.369925213675', '60.369925213675', '0', '241.4797008547', '10', '2014', 'no'),
(0, 1, 35, '776.18475274725', '776.18475274725', '776.18475274725', '776.18475274725', '0', '3104.739010989', '10', '2014', 'no'),
(0, 1, 36, '10.34913003663', '10.34913003663', '10.34913003663', '10.34913003663', '0', '41.39652014652', '10', '2014', 'no'),
(0, 1, 37, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 38, '0', '0', '0', '0', '0', '0', '10', '2014', 'no'),
(0, 1, 39, '18.028846153846', '18.028846153846', '18.028846153846', '18.028846153846', '0', '72.115384615385', '10', '2014', 'no'),
(0, 1, 40, '14.653846153846', '14.653846153846', '14.653846153846', '14.653846153846', '0', '58.615384615385', '10', '2014', 'no'),
(0, 1, 41, '250', '250', '250', '250', '0', '1000', '10', '2014', 'no'),
(0, 1, 43, '48.076923076923', '48.076923076923', '48.076923076923', '48.076923076923', '0', '192.30769230769', '10', '2014', 'no'),
(0, 1, 44, '24.038461538462', '24.038461538462', '24.038461538462', '24.038461538462', '0', '96.153846153846', '10', '2014', 'no'),
(0, 1, 45, '51.282051282051', '51.282051282051', '51.282051282051', '51.282051282051', '0', '205.12820512821', '10', '2014', 'no'),
(0, 1, 46, '30.048076923077', '30.048076923077', '30.048076923077', '30.048076923077', '0', '120.19230769231', '10', '2014', 'no'),
(0, 1, 47, '57.692307692308', '57.692307692308', '57.692307692308', '57.692307692308', '0', '230.76923076923', '10', '2014', 'no'),
(0, 1, 48, '9.0144230769231', '9.0144230769231', '9.0144230769231', '9.0144230769231', '0', '36.057692307692', '10', '2014', 'no'),
(0, 1, 49, '51.282051282051', '51.282051282051', '51.282051282051', '51.282051282051', '0', '205.12820512821', '10', '2014', 'no'),
(0, 1, 50, '101.5625', '101.5625', '101.5625', '101.5625', '0', '406.25', '10', '2014', 'no'),
(0, 1, 51, '14.653846153846', '14.653846153846', '14.653846153846', '14.653846153846', '0', '58.615384615385', '10', '2014', 'no'),
(0, 1, 42, '76.92307692307692', '76.92307692307692', '76.92307692307692', '76.92307692307692', '0', '307.69230769231', '10', '2014', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_new_concepto_tipo`
--

CREATE TABLE IF NOT EXISTS `mno_new_concepto_tipo` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `mno_new_concepto_tipo`
--

INSERT INTO `mno_new_concepto_tipo` (`codigo`, `nombre`) VALUES
(1, 'Sueldos y Salarios'),
(2, 'Bonos '),
(3, 'Primas'),
(4, 'Comisiones'),
(5, 'Aportes'),
(6, 'Apartados'),
(7, 'Otros Benficios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_new_variables`
--

CREATE TABLE IF NOT EXISTS `mno_new_variables` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fijo` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `mno_new_variables`
--

INSERT INTO `mno_new_variables` (`codigo`, `nombre`, `valor`, `fijo`, `tipo`) VALUES
(1, 'Seguro Social ', '9', 'no', 1),
(2, 'PIE', '2', 'no', 1),
(3, 'Banavih', '2', 'no', 1),
(4, 'Inces', '2', 'no', 1),
(5, 'Utilidades ', '30', 'no', 2),
(6, 'Aguinaldo', '15', 'no', 2),
(7, 'Bono Vacacional', '15', 'no', 2),
(8, 'Bono Post Vacacional', '15', 'no', 2),
(9, 'Prestaciones Sociales', '5', 'no', 2),
(10, 'Bono Nocturno', '30', 'no', 2),
(11, 'Intereses Prestaciones Sociales', '16', 'no', 2),
(12, 'Recargo Horas Extras Diurna', '1.5', 'no', 3),
(13, 'Recargo Horas Extras Noctura', '1.95', 'no', 3),
(14, 'Dias Feriados', '2', 'no', 3),
(15, 'Cestaticket', '0.25', 'no', 3),
(16, 'Unidad Tributaria', '127', 'no', 4),
(17, 'Caja de Ahorro', '10', 'no', 4),
(18, 'Cuota Sindical', '50', 'no', 4),
(19, 'Semestre Año ', '2', 'no', 4),
(20, 'Trimestres', '4', 'no', 4),
(21, 'Cuatrimestres', '3', 'no', 4),
(22, 'Semana del Año', '52', 'si', 4),
(23, 'Meses del Año', '12', 'si', 4),
(24, 'Dias Bancarios', '360', 'si', 4),
(25, 'Dias Efectivos', '365', 'no', 4),
(26, 'Dias Semana', '7', 'no', 5),
(30, 'Salario Minimo', '4152.75', 'no', 5),
(31, 'Turno Diario', '8', 'no', 4),
(33, 'Turno Mixto', '7.5', 'no', 4),
(34, 'Turno Nocturno', '7', 'no', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_new_variables_tipo`
--

CREATE TABLE IF NOT EXISTS `mno_new_variables_tipo` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `sub_nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `mno_new_variables_tipo`
--

INSERT INTO `mno_new_variables_tipo` (`codigo`, `nombre`, `sub_nombre`) VALUES
(1, 'Contribuciones Sociales', 'Aportes'),
(2, 'LOTTT', 'Apartados'),
(3, 'LOTTT', 'Otros Beneficios'),
(4, 'Constantes Fijas', ''),
(5, 'Constantes Variables', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_nomina`
--

CREATE TABLE IF NOT EXISTS `mno_nomina` (
`codigo` int(11) NOT NULL,
  `codigoalias` varchar(8) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `fechainicio` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `fechacierre` date DEFAULT NULL,
  `estatus` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_proceso_empleados`
--

CREATE TABLE IF NOT EXISTS `mno_proceso_empleados` (
`codigo` int(11) NOT NULL,
  `codigoempleado` int(11) DEFAULT NULL,
  `codigomes` int(11) DEFAULT NULL,
  `codigosemana` int(11) DEFAULT NULL,
  `codigogerencia` int(11) DEFAULT NULL,
  `codigounidadadm` int(11) DEFAULT NULL,
  `codigodepartamento` int(11) DEFAULT NULL,
  `codigocargo` int(11) DEFAULT NULL,
  `sueldobase` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_tipo_concepto`
--

CREATE TABLE IF NOT EXISTS `mno_tipo_concepto` (
`codigo` int(11) NOT NULL,
  `codigo_concepto` int(8) NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=190 ;

--
-- Volcado de datos para la tabla `mno_tipo_concepto`
--

INSERT INTO `mno_tipo_concepto` (`codigo`, `codigo_concepto`, `descripcion`) VALUES
(182, 1, 'Sueldos y Salarios'),
(183, 2, 'Bonos '),
(184, 3, 'Primas'),
(185, 4, 'Comisiones'),
(186, 5, 'Aportes'),
(187, 6, 'Apartados'),
(188, 7, 'Otros Beneficios Laborales'),
(189, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_unidadadm`
--

CREATE TABLE IF NOT EXISTS `mno_unidadadm` (
`codigo` int(11) NOT NULL,
  `codigoalias` varchar(8) DEFAULT NULL,
  `codigogerencia` int(11) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `mno_unidadadm`
--

INSERT INTO `mno_unidadadm` (`codigo`, `codigoalias`, `codigogerencia`, `descripcion`) VALUES
(13, 'GERGERGE', 7, 'Gerencia');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `mno_view_concepto_empleados`
--
CREATE TABLE IF NOT EXISTS `mno_view_concepto_empleados` (
`codigo` int(11)
,`codigoempleado` int(11)
,`codigomes` int(11)
,`codigoconcepto` int(11)
,`codigosemana` int(11)
,`valor` varchar(120)
,`codigoproceso` varchar(8)
,`descripcion` varchar(150)
,`codigotipo` int(11)
,`resultado` varchar(255)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_ano`
--

CREATE TABLE IF NOT EXISTS `mrh_ano` (
`codigo` int(11) NOT NULL,
  `descripcion` int(4) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `mrh_ano`
--

INSERT INTO `mrh_ano` (`codigo`, `descripcion`) VALUES
(1, 2012),
(2, 2013),
(3, 2014),
(4, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_beneficio_periodico`
--

CREATE TABLE IF NOT EXISTS `mrh_beneficio_periodico` (
`codigo` int(11) NOT NULL,
  `codigo_empleado` int(11) NOT NULL,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `codigo_tipo` int(11) NOT NULL,
  `codigo_periocidad` int(11) NOT NULL,
  `monto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_carga`
--

CREATE TABLE IF NOT EXISTS `mrh_carga` (
`codigo` int(11) NOT NULL,
  `cedulaempleado` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `cedula` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `primernombre` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `segundonombre` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `primerapellido` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `segundoapellido` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `fechanacimiento` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `parentesco` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `estudios` varchar(1) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `mrh_carga`
--

INSERT INTO `mrh_carga` (`codigo`, `cedulaempleado`, `cedula`, `primernombre`, `segundonombre`, `primerapellido`, `segundoapellido`, `fechanacimiento`, `parentesco`, `estudios`) VALUES
(3, '1', '123', 'hijo', 'hijo', 'hji', 'hijo', '2007-10-17', 'H', 'G'),
(4, '1', '123', 'asd', 'asd', 'asd', 'asd', '2014-10-02', 'H', 'G'),
(5, '3', '123', 'asd', 'asd', 'asd', 'asd', '2012-10-15', 'H', 'G');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_cargo`
--

CREATE TABLE IF NOT EXISTS `mrh_cargo` (
`codigo` int(8) NOT NULL,
  `codigoalias` varchar(8) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Volcado de datos para la tabla `mrh_cargo`
--

INSERT INTO `mrh_cargo` (`codigo`, `codigoalias`, `descripcion`) VALUES
(23, 'GERGERGE', 'Gerente'),
(24, 'ADMCRCJE', 'Jefe de AdministraciÃ³n CrÃ©dito y Cobranza'),
(25, 'ADMCRCAN', 'Analista de CrÃ©dito y Cobranzas'),
(26, 'ADMCONPS', 'Pasante de Contaduria'),
(28, 'ADMADMAP', 'Aprendiz Ince'),
(29, 'VENVINCR', 'Coordinador de Ventas Industriales'),
(30, 'VENVINAS', 'Asesor de Ventas Industrial'),
(31, 'VENVIMAN', 'Analista de Ventas  y Vendedor de Mostrador'),
(32, 'VENVACCR', 'Coordinador de Ventas Automotriz / Compras'),
(33, 'VENVAUAS', 'Asesor de Ventas Automotriz'),
(34, 'ALMALMJE', 'Jefe de Almacen'),
(35, 'ALMALMAL', 'Almacenista 1'),
(36, 'ALMALMDE', 'Despachador'),
(37, 'ALMALMAL', 'Almacenista 2'),
(38, 'ALMALMDE', 'Despachador'),
(39, 'ADMINIST', 'Administradora'),
(40, 'COORDINA', 'Coordinador de Ventas Industriales'),
(41, 'JEFE DE ', 'Jefe de  Almacen'),
(42, 'ANALISTA', 'Analista de Credito'),
(43, 'ANALISTA', 'Analista de Ventas'),
(44, 'REPRESEN', 'Representante de Venta'),
(45, 'ALMACENI', 'Almacenista'),
(47, 'ANALISTA', 'Analista de Compra'),
(48, 'DESPACHA', 'Despachador'),
(49, 'COORDINA', 'Coordinador de Ventas Automatrices');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_dotacion`
--

CREATE TABLE IF NOT EXISTS `mrh_dotacion` (
`codigo` int(11) NOT NULL,
  `codigo_empleado` int(11) NOT NULL,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `codigo_articulo` int(11) NOT NULL,
  `cantidad` varchar(50) NOT NULL,
  `costo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_empleado`
--

CREATE TABLE IF NOT EXISTS `mrh_empleado` (
`codigo` int(11) NOT NULL,
  `cedula` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ficha` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `primernombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `segundonombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `primerapellido` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `segundoapellido` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `estadocivil` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `becado` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `sexo` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaingreso` date DEFAULT NULL,
  `fechaegreso` date DEFAULT NULL,
  `codigocargo` int(11) DEFAULT NULL,
  `estatus` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `condicion` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigoperioricidad` int(11) DEFAULT NULL,
  `direccionhabitacion` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `codigo_departamento` int(11) NOT NULL,
  `retirado` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `vehiculo` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'no',
  `nacionalidad` varchar(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `mrh_empleado`
--

INSERT INTO `mrh_empleado` (`codigo`, `cedula`, `ficha`, `primernombre`, `segundonombre`, `primerapellido`, `segundoapellido`, `fechanacimiento`, `telefono`, `celular`, `estadocivil`, `becado`, `sexo`, `fechaingreso`, `fechaegreso`, `codigocargo`, `estatus`, `condicion`, `codigoperioricidad`, `direccionhabitacion`, `codigo_departamento`, `retirado`, `vehiculo`, `nacionalidad`) VALUES
(1, '12643262', '12643263', 'Criseila', '', 'Zambrano', 'Cordero', '1961-06-27', '', '', 'C', '1', 'F', '1998-08-03', '0000-00-00', 23, '1', 'N', 0, 'URBANIZACION VILLA ANTILLANA CALLE BELICE 08-02 - BOLIVAR', 7, 'no', 'no', 'V'),
(2, '13982750', '4', 'Monica', 'Josefina', 'Garcia', 'Henrriquez', '1993-10-28', '', '0416-6864239', 'C', '0', 'F', '2000-05-02', '0000-00-00', 39, '1', 'N', 0, 'URBANIZACION VILLA BETANIA RESIDENCIAS LAS QUINTAS  CASA N° 34 PUERTO ORDAZ - BOLIVAR', 12, 'no', 'no', 'V'),
(3, '12545746', '13', 'Gonzalo', 'Jesus', 'Gomez', 'Cotua', '1979-04-27', '0286-9222617', '0416-6862232', 'C', '0', 'M', '2007-06-18', '0000-00-00', 40, '1', 'N', 0, 'URBANIZACION MANOA MANZANA 27 CASA N° 11 - BOLIVAR', 22, 'no', 'no', 'V'),
(4, '18882366', '39', 'Alexandra', 'Adelfa', 'Romero', 'Diaz', '1993-03-31', '', '0424-9384949', 'S', '1', 'F', '2012-01-09', '0000-00-00', 41, '1', 'N', 0, 'PRINCIPAL DE UNARE II BLOQUE 8 PISO 02 APTO 02-01 - BOLIVAR', 30, 'no', 'si', 'V'),
(5, '5983973', '24', 'Plinio', 'Deljesus', 'Diaz', 'Mundarain', '1987-06-27', '', '0426-9974076', 'C', '0', 'M', '2009-01-12', '0000-00-00', 43, '1', 'N', 0, 'AVENIDA GUARAPICHE CONJUNTO RESIDENCIAL GUARAPICHE PISO 3 APARTAMENTO 3-2 PARROQUIA UNARE MUNICIPIO CARONI - BOLIVAR', 36, 'no', 'no', 'V'),
(6, '82117719', '26', 'Maria', 'Carolina', 'Latman', 'Desatnik', '1968-09-29', '0286-9224282', '0412-6971586', 'C', '1', 'F', '2010-01-13', '0000-00-00', 42, '1', 'N', 0, 'URBANIZACION LA CORNISA CALLE 9 N° 6  CALLE PUERTO RICO, PUERTO ORDAZ - BOLIVAR', 30, 'no', 'si', 'E'),
(10, '13214758', '6', 'Michel', 'Antonio', 'Aponte', 'Valdez', '1974-09-09', '', '0416-6873495', 'C', '0', 'F', '2010-01-13', '2014-09-01', 49, '1', 'N', 0, 'COORDINAR DE VENTAS AUTOMOTRICES', 42, 'no', 'si', 'V'),
(11, '4582655', '18', 'Paul', 'Enrique', 'Calderon', 'Cedeno', '1979-09-19', '0286-9310985', '0414-8763152', 'C', '0', 'M', '2011-05-01', '0000-00-00', 44, '1', 'N', 0, 'REPRESENTANTE DE VENTA', 28, 'no', 'no', 'V'),
(12, '16396224', '29', 'Alfredo', 'Jose', 'Escalona', 'Venales', '1990-02-28', '0286-9623726', '', 'O', '0', 'M', '2011-09-01', '0000-00-00', 43, '1', 'N', 0, 'CALLE BERMUDEZ, CASA # 5310 PARROQUIA CHIRICA, MUNICIPIO CARONI - BOLIVAR', 30, 'no', 'no', 'V'),
(13, '18787141', '21', 'Reinaldo', 'Luis', 'Heredia', 'Ordaz', '1995-07-31', '', '0414-8910334', 'O', '0', 'M', '2011-01-11', '0000-00-00', 45, '1', 'N', 0, 'CALLE BERMUDEZ, CASA # 5310 PARROQUIA CHIRICA, MUNICIPIO CARONI - BOLIVAR', 18, 'no', 'no', 'V'),
(14, '15907877', '32', 'Diobel', 'Lorenzo', 'Rivas', 'Betancourt', '1963-05-07', '0286-9525019', '', 'O', '0', 'M', '2013-01-14', '0000-00-00', 48, '1', 'N', 0, 'UNARE II SECTOR I VEREDA I CASA 10 - BOLIVAR', 30, 'no', 'no', 'V'),
(15, '9933181', '34', 'Wilfredo', 'Jose', 'Gonzales', 'Fuentes', '1986-07-24', '0286-9941694', '0424-9073842', 'S', '0', 'M', '2013-01-01', '0000-00-00', 39, '1', 'N', 0, 'URBANIZACION EL CAIMITO MANZANA 43A CASA N° 13 - BOLIVAR', 30, 'no', 'si', 'V'),
(16, '11533695', '20', 'Jairo', 'Jose', 'Palomo', 'Villarroel', '1968-02-06', '', '0416-4869734', 'C', '0', 'M', '2012-08-24', '0000-00-00', 44, '1', 'N', 0, 'URBANIZACION LOMAS DEL CARONI - BOLIVAR', 26, 'no', 'no', 'V'),
(17, '9224054', '35', 'Francia', 'Mayela', 'Chacon', 'Decontreras', '1964-10-12', '0286-9719002', '0416-6866920', 'C', '0', 'F', '2014-06-02', '0000-00-00', 47, '1', 'N', 0, 'URBANIZACION RORAIMA CR PARQUE CARONI VILLAS N° 9 ALTA VISTA', 30, 'no', 'no', 'V'),
(18, '14088319', '36', 'Vicente', 'Emilio', 'Ordaz', 'Moreno', '1958-01-09', '', '0416-3883154', 'C', '0', 'M', '2014-07-02', '0000-00-00', 48, '1', 'N', 0, 'VISTA AL SOL RUTA 1, CALLE FRANCISCO FAJARDO N° 09, CASA N° 18-12-02, SAN FELIX', 30, 'no', 'no', 'V'),
(19, '12359735', 'e', 'Carlos', 'Jose', 'Marquez', 'Marquez', '1982-10-20', '0286-9613910', '0416-6873840', 'C', '0', 'M', '2013-07-18', '0000-00-00', 44, '1', 'N', 0, 'AVENIDA PRINCIPAL DE VILLA BETANIA TORRE 5 PLANTA BAJA APTO 05-01 - BOLIVAR', 37, 'no', 'no', 'V');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_empleado_depende`
--

CREATE TABLE IF NOT EXISTS `mrh_empleado_depende` (
`codigo` int(11) NOT NULL,
  `codigo_trabajador` int(11) NOT NULL,
  `codigo_depende` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `mrh_empleado_depende`
--

INSERT INTO `mrh_empleado_depende` (`codigo`, `codigo_trabajador`, `codigo_depende`) VALUES
(2, 52, 14),
(3, 34, 14),
(4, 52, 51);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_jornada`
--

CREATE TABLE IF NOT EXISTS `mrh_jornada` (
`codigo` int(11) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `horainicio` varchar(10) DEFAULT NULL,
  `horafin` varchar(10) DEFAULT NULL,
  `fechavigencia` date DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `mrh_jornada`
--

INSERT INTO `mrh_jornada` (`codigo`, `descripcion`, `horainicio`, `horafin`, `fechavigencia`) VALUES
(2, 'jornada 1', '8:00', '6:00', '2013-06-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_mes`
--

CREATE TABLE IF NOT EXISTS `mrh_mes` (
`codigo` int(11) NOT NULL,
  `codigoano` int(11) DEFAULT NULL,
  `codigomes` int(11) DEFAULT NULL,
  `descripcion` varchar(25) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `mrh_mes`
--

INSERT INTO `mrh_mes` (`codigo`, `codigoano`, `codigomes`, `descripcion`) VALUES
(1, 3, 1, 'Enero'),
(2, 3, 2, 'Febrero'),
(3, 3, 3, 'Marzo'),
(4, 3, 4, 'Abril'),
(5, 3, 5, 'Mayo'),
(6, 3, 6, 'Junio'),
(7, 3, 7, 'Julio'),
(8, 3, 8, 'Agosto'),
(9, 3, 9, 'Septiembre'),
(10, 3, 10, 'Octubre'),
(11, 3, 11, 'Noviembre'),
(12, 3, 12, 'Diciembre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_periocidad`
--

CREATE TABLE IF NOT EXISTS `mrh_periocidad` (
`codigo` int(11) NOT NULL,
  `codigo_alias` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_periocidad_proceso`
--

CREATE TABLE IF NOT EXISTS `mrh_periocidad_proceso` (
`codigo` int(11) NOT NULL,
  `codigo_empleado` int(11) NOT NULL,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `codigo_articulo` int(11) NOT NULL,
  `codigo_periocidad` int(11) NOT NULL,
  `monto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_semana`
--

CREATE TABLE IF NOT EXISTS `mrh_semana` (
`codigo` int(11) NOT NULL,
  `codigoano` int(11) DEFAULT NULL,
  `codigomes` int(11) DEFAULT NULL,
  `codigosemana` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Volcado de datos para la tabla `mrh_semana`
--

INSERT INTO `mrh_semana` (`codigo`, `codigoano`, `codigomes`, `codigosemana`) VALUES
(0, 3, 1, 1),
(2, 3, 1, 2),
(3, 3, 1, 3),
(4, 3, 1, 4),
(5, 3, 1, 5),
(6, 3, 2, 6),
(7, 3, 2, 7),
(8, 3, 2, 8),
(9, 3, 2, 9),
(10, 3, 3, 10),
(11, 3, 3, 11),
(12, 3, 3, 12),
(13, 3, 3, 13),
(14, 3, 3, 14),
(15, 3, 4, 15),
(16, 3, 4, 16),
(17, 3, 4, 17),
(18, 3, 4, 18),
(19, 3, 5, 19),
(20, 3, 5, 20),
(21, 3, 5, 21),
(22, 3, 5, 22),
(23, 3, 6, 23),
(24, 3, 6, 24),
(25, 3, 6, 25),
(26, 3, 6, 26),
(27, 3, 6, 27),
(28, 3, 7, 28),
(29, 3, 7, 29),
(30, 3, 7, 30),
(31, 3, 7, 31),
(32, 3, 8, 32),
(33, 3, 8, 33),
(34, 3, 8, 34),
(35, 3, 8, 35),
(36, 3, 9, 36),
(37, 3, 9, 37),
(38, 3, 9, 38),
(39, 3, 9, 39),
(40, 3, 9, 40),
(41, 3, 10, 41),
(42, 3, 10, 42),
(43, 3, 10, 43),
(44, 3, 10, 44),
(45, 3, 11, 45),
(46, 3, 11, 46),
(47, 3, 11, 47),
(48, 3, 11, 48),
(49, 3, 12, 49),
(50, 3, 12, 50),
(51, 3, 12, 51),
(52, 3, 12, 52),
(53, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_tipoturno`
--

CREATE TABLE IF NOT EXISTS `mrh_tipoturno` (
`codigo` int(11) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `horainicio` varchar(10) DEFAULT NULL,
  `horafin` varchar(10) DEFAULT NULL,
  `horasemanales` varchar(10) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `mrh_tipoturno`
--

INSERT INTO `mrh_tipoturno` (`codigo`, `descripcion`, `horainicio`, `horafin`, `horasemanales`) VALUES
(8, 'D', '05:00', '19:00', '40'),
(9, 'N', '19:00', '05:00', '35'),
(10, 'M', '', '', '37.5'),
(11, 'L', '05:00', '19:00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_tipo_beneficio`
--

CREATE TABLE IF NOT EXISTS `mrh_tipo_beneficio` (
`codigo` int(11) NOT NULL,
  `codigo_alias` varchar(8) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_turnos`
--

CREATE TABLE IF NOT EXISTS `mrh_turnos` (
`codigo` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `horaentrada` varchar(10) DEFAULT NULL,
  `horasalida` varchar(10) DEFAULT NULL,
  `horadescanso` int(11) DEFAULT NULL,
  `descripciontipoturno` varchar(8) DEFAULT NULL,
  `diaslaborales` int(11) DEFAULT NULL,
  `horaextradiurno` int(11) DEFAULT NULL,
  `horaextranocturno` int(11) DEFAULT NULL,
  `horatdiario` varchar(10) DEFAULT NULL,
  `horatsemana` varchar(10) DEFAULT NULL,
  `horatmensual` varchar(10) DEFAULT NULL,
  `totalhrsextra` varchar(10) DEFAULT NULL,
  `hrsnocdiarias` varchar(10) DEFAULT NULL,
  `hrsnocsemanal` varchar(10) DEFAULT NULL,
  `hrsnocmensual` varchar(10) DEFAULT NULL,
  `hrslabpermitidas` varchar(10) DEFAULT NULL,
  `bononocdiario` varchar(10) DEFAULT NULL,
  `bononocsemanal` varchar(10) DEFAULT NULL,
  `bononocmensual` varchar(10) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `mrh_turnos`
--

INSERT INTO `mrh_turnos` (`codigo`, `descripcion`, `horaentrada`, `horasalida`, `horadescanso`, `descripciontipoturno`, `diaslaborales`, `horaextradiurno`, `horaextranocturno`, `horatdiario`, `horatsemana`, `horatmensual`, `totalhrsextra`, `hrsnocdiarias`, `hrsnocsemanal`, `hrsnocmensual`, `hrslabpermitidas`, `bononocdiario`, `bononocsemanal`, `bononocmensual`) VALUES
(22, '1', '08:00', '18:00', 2, 'D', 5, 0, 0, '8', '40', '200', '0', '0', '0', '0', '40', '0', '0', '0'),
(23, '2', '12:30', '22:00', 2, 'M', 5, 0, 0, '7.5', '37.5', '187.5', '0', '3', '15', '75', '37.5', '3', '15', '75'),
(24, '3', '06:00', '06:00', 6, 'N', 3, 12, 7, '8', '54', '270', '19', '10', '30', '150', '35', '10', '30', '150'),
(25, '4', '22:00', '06:00', 1, 'N', 5, 0, 0, '7', '35', '175', '0', '7', '35', '175', '35', '7', '35', '175'),
(26, '5', '05:00', '15:00', 2, 'D', 5, 0, 0, '8', '40', '200', '0', '0', '0', '0', '40', '0', '0', '0'),
(30, '6', '01:00', '08:00', 1, 'N', 5, 0, 0, '6', '30', '150', '0', '4', '20', '100', '35', '4', '20', '100'),
(31, '7', '18:00', '18:00', 6, 'N', 3, 8, 11, '18', '54', '270', '19', '10', '30', '150', '35', '10', '30', '150'),
(32, '8', '07:30', '16:30', 1, 'D', 5, 0, 0, '8', '40', '200', '0', '0', '0', '0', '40', '0', '0', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_turnoxempleado`
--

CREATE TABLE IF NOT EXISTS `mrh_turnoxempleado` (
`codigo` int(11) NOT NULL,
  `cedulaempleado` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `codigomes` int(11) DEFAULT NULL,
  `codigosemana` int(11) DEFAULT NULL,
  `codigoturno` int(11) DEFAULT NULL,
  `anhio` varchar(4) CHARACTER SET latin1 NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=81 ;

--
-- Volcado de datos para la tabla `mrh_turnoxempleado`
--

INSERT INTO `mrh_turnoxempleado` (`codigo`, `cedulaempleado`, `codigomes`, `codigosemana`, `codigoturno`, `anhio`, `eliminado`) VALUES
(1, '11', 10, 1, 22, '2014', 'no'),
(2, '11', 10, 2, 22, '2014', 'no'),
(3, '11', 10, 3, 22, '2014', 'no'),
(4, '11', 10, 4, 22, '2014', 'no'),
(5, '1', 10, 1, 22, '2014', '2014-10-16'),
(6, '1', 10, 2, 22, '2014', '2014-10-16'),
(7, '1', 10, 3, 22, '2014', '2014-10-16'),
(8, '1', 10, 4, 22, '2014', '2014-10-16'),
(9, '2', 10, 1, 25, '2014', 'no'),
(10, '2', 10, 2, 23, '2014', 'no'),
(11, '2', 10, 3, 25, '2014', 'no'),
(12, '2', 10, 4, 22, '2014', 'no'),
(13, '3', 10, 1, 22, '2014', '2014-10-16'),
(14, '3', 10, 2, 22, '2014', '2014-10-16'),
(15, '3', 10, 3, 22, '2014', '2014-10-16'),
(16, '3', 10, 4, 22, '2014', '2014-10-16'),
(17, '10', 10, 1, 22, '2014', 'no'),
(18, '10', 10, 2, 22, '2014', 'no'),
(19, '10', 10, 3, 22, '2014', 'no'),
(20, '10', 10, 4, 22, '2014', 'no'),
(21, '4', 10, 1, 22, '2014', 'no'),
(22, '4', 10, 2, 22, '2014', 'no'),
(23, '4', 10, 3, 22, '2014', 'no'),
(24, '4', 10, 4, 22, '2014', 'no'),
(25, '5', 10, 1, 22, '2014', 'no'),
(26, '5', 10, 2, 22, '2014', 'no'),
(27, '5', 10, 3, 22, '2014', 'no'),
(28, '5', 10, 4, 22, '2014', 'no'),
(29, '6', 10, 1, 22, '2014', '2014-10-15'),
(30, '6', 10, 2, 22, '2014', '2014-10-15'),
(31, '6', 10, 3, 22, '2014', '2014-10-15'),
(32, '6', 10, 4, 22, '2014', '2014-10-15'),
(33, '6', 10, 1, 25, '2014', 'no'),
(34, '6', 10, 2, 23, '2014', 'no'),
(35, '6', 10, 3, 25, '2014', 'no'),
(36, '6', 10, 4, 22, '2014', 'no'),
(37, '12', 10, 1, 22, '2014', 'no'),
(38, '12', 10, 2, 22, '2014', 'no'),
(39, '12', 10, 3, 22, '2014', 'no'),
(40, '12', 10, 4, 22, '2014', 'no'),
(41, '13', 10, 1, 25, '2014', 'no'),
(42, '13', 10, 2, 23, '2014', 'no'),
(43, '13', 10, 3, 25, '2014', 'no'),
(44, '13', 10, 4, 22, '2014', 'no'),
(45, '19', 10, 1, 22, '2014', 'no'),
(46, '19', 10, 2, 22, '2014', 'no'),
(47, '19', 10, 3, 22, '2014', 'no'),
(48, '19', 10, 4, 22, '2014', 'no'),
(49, '14', 10, 1, 22, '2014', 'no'),
(50, '14', 10, 2, 22, '2014', 'no'),
(51, '14', 10, 3, 22, '2014', 'no'),
(52, '14', 10, 4, 22, '2014', 'no'),
(53, '15', 10, 1, 25, '2014', 'no'),
(54, '15', 10, 2, 23, '2014', 'no'),
(55, '15', 10, 3, 25, '2014', 'no'),
(56, '15', 10, 4, 22, '2014', 'no'),
(57, '16', 10, 1, 22, '2014', 'no'),
(58, '16', 10, 2, 22, '2014', 'no'),
(59, '16', 10, 3, 22, '2014', 'no'),
(60, '16', 10, 4, 22, '2014', 'no'),
(61, '17', 10, 1, 22, '2014', 'no'),
(62, '17', 10, 2, 22, '2014', 'no'),
(63, '17', 10, 3, 22, '2014', 'no'),
(64, '17', 10, 4, 22, '2014', 'no'),
(65, '18', 10, 1, 22, '2014', 'no'),
(66, '18', 10, 2, 22, '2014', 'no'),
(67, '18', 10, 3, 22, '2014', 'no'),
(68, '18', 10, 4, 22, '2014', 'no'),
(69, '1', 10, 1, 22, '2014', '2014-10-16'),
(70, '1', 10, 2, 22, '2014', '2014-10-16'),
(71, '1', 10, 3, 22, '2014', '2014-10-16'),
(72, '1', 10, 4, 22, '2014', '2014-10-16'),
(73, '3', 10, 1, 22, '2014', 'no'),
(74, '3', 10, 2, 22, '2014', 'no'),
(75, '3', 10, 3, 22, '2014', 'no'),
(76, '3', 10, 4, 22, '2014', 'no'),
(77, '1', 10, 1, 31, '2014', 'no'),
(78, '1', 10, 2, 31, '2014', 'no'),
(79, '1', 10, 3, 31, '2014', 'no'),
(80, '1', 10, 4, 31, '2014', 'no');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `mrh_view_analisisxempleado`
--
CREATE TABLE IF NOT EXISTS `mrh_view_analisisxempleado` (
`cedulaempleado` varchar(15)
,`codigomes` int(11)
,`codigosemana` int(11)
,`codigo` int(11)
,`descripcion` varchar(100)
,`horaentrada` varchar(10)
,`horasalida` varchar(10)
,`horadescanso` int(11)
,`descripciontipoturno` varchar(8)
,`diaslaborales` int(11)
,`horaextradiurno` int(11)
,`horaextranocturno` int(11)
,`horatdiario` varchar(10)
,`horatsemana` varchar(10)
,`horatmensual` varchar(10)
,`totalhrsextra` varchar(10)
,`hrsnocdiarias` varchar(10)
,`hrsnocsemanal` varchar(10)
,`hrsnocmensual` varchar(10)
,`hrslabpermitidas` varchar(10)
,`bononocdiario` varchar(10)
,`bononocsemanal` varchar(10)
,`bononocmensual` varchar(10)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `mrh_view_turnos_empleados`
--
CREATE TABLE IF NOT EXISTS `mrh_view_turnos_empleados` (
`cedulaempleado` varchar(15)
,`codigomes` int(11)
,`codigosemana` int(11)
,`descripciontipoturno` varchar(8)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prc_detalle_etapa`
--

CREATE TABLE IF NOT EXISTS `prc_detalle_etapa` (
`codigo` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `cantidad_estandar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_etapa` int(11) NOT NULL,
  `codigo_producto_detalle` int(11) NOT NULL,
  `desactivo` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `prc_detalle_etapa`
--

INSERT INTO `prc_detalle_etapa` (`codigo`, `codigo_producto`, `cantidad_estandar`, `codigo_etapa`, `codigo_producto_detalle`, `desactivo`) VALUES
(1, 28, '100', 1, 59, 'n'),
(2, 28, '24', 1, 52, 'n'),
(3, 28, '43', 1, 55, 'n'),
(4, 28, '250', 1, 58, 'n'),
(5, 28, '20', 1, 56, 'n'),
(6, 28, '200', 1, 54, 'n'),
(7, 28, '50', 1, 53, 'n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prc_elaborados`
--

CREATE TABLE IF NOT EXISTS `prc_elaborados` (
`codigo` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `desactivo` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prc_etapas`
--

CREATE TABLE IF NOT EXISTS `prc_etapas` (
`codigo` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `codigo_departamento` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `desactivo` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `prc_etapas`
--

INSERT INTO `prc_etapas` (`codigo`, `codigo_producto`, `codigo_departamento`, `desactivo`) VALUES
(1, 28, '49', 'n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prc_orden_trabajador`
--

CREATE TABLE IF NOT EXISTS `prc_orden_trabajador` (
`codigo` int(11) NOT NULL COMMENT 'esta tabla es para ver cuando se agregan trabajdores a una orden especifica q tiene q estar activa',
  `codigo_trabajador` int(11) DEFAULT NULL,
  `codigo_orden_produccion` int(11) DEFAULT NULL,
  `eliminado` varchar(12) DEFAULT 'no',
  `codigo_etapa` int(11) DEFAULT NULL,
  `horas` varchar(45) DEFAULT NULL,
  `bono_producido` varchar(45) NOT NULL DEFAULT '0',
  `pago_unidades` varchar(45) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `prc_orden_trabajador`
--

INSERT INTO `prc_orden_trabajador` (`codigo`, `codigo_trabajador`, `codigo_orden_produccion`, `eliminado`, `codigo_etapa`, `horas`, `bono_producido`, `pago_unidades`) VALUES
(1, 11, 3, 'no', 3, '13', '10', '0'),
(2, 1, 3, 'no', 3, '12', '10', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prc_orden_trabajo`
--

CREATE TABLE IF NOT EXISTS `prc_orden_trabajo` (
`codigo` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `produccion_planificada` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `produccion_real` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `indicador` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_inicio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_culminacion` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `codigo_alias` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `eliminada` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `comentario` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `valor_standar` varchar(90) COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `prc_orden_trabajo`
--

INSERT INTO `prc_orden_trabajo` (`codigo`, `codigo_producto`, `produccion_planificada`, `produccion_real`, `indicador`, `fecha_inicio`, `fecha_culminacion`, `codigo_alias`, `eliminada`, `comentario`, `valor_standar`) VALUES
(1, 28, '3', '2', '', '2014-10-24', '2014-10-24', 'ff', 'n', 'estubo todo bien', '0'),
(2, 28, '10', '100', '', '2014-10-27', '2014-10-27', '1', 'n', 'hola', '0'),
(3, 28, '10', '10', '', '2014-10-31', '2014-10-31', 'leonel', 'n', '', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prc_orden_trabajo_detalle_etapa`
--

CREATE TABLE IF NOT EXISTS `prc_orden_trabajo_detalle_etapa` (
`codigo` int(11) NOT NULL,
  `codigo_orden_trabajo` int(11) NOT NULL,
  `cantidad_estandar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `completo` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `codigo_etapa` int(11) NOT NULL,
  `codigo_producto_detalle` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `valor` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `valor_standar` varchar(90) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `prc_orden_trabajo_detalle_etapa`
--

INSERT INTO `prc_orden_trabajo_detalle_etapa` (`codigo`, `codigo_orden_trabajo`, `cantidad_estandar`, `completo`, `codigo_etapa`, `codigo_producto_detalle`, `codigo_producto`, `valor`, `valor_standar`) VALUES
(1, 1, '100', 'n', 1, 59, 28, '', '500'),
(2, 1, '24', 'n', 1, 52, 28, '', '450'),
(3, 1, '43', 'n', 1, 55, 28, '', '800'),
(4, 1, '250', 'n', 1, 58, 28, '', '100'),
(5, 1, '20', 'n', 1, 56, 28, '', '500'),
(6, 1, '200', 'n', 1, 54, 28, '', '250'),
(7, 1, '50', 'n', 1, 53, 28, '', '150'),
(8, 2, '100', 'n', 1, 59, 28, '', '500'),
(9, 2, '24', 'n', 1, 52, 28, '', '450'),
(10, 2, '43', 'n', 1, 55, 28, '', '800'),
(11, 2, '250', 'n', 1, 58, 28, '', '100'),
(12, 2, '20', 'n', 1, 56, 28, '', '500'),
(13, 2, '200', 'n', 1, 54, 28, '', '250'),
(14, 2, '50', 'n', 1, 53, 28, '', '150'),
(15, 3, '100', 'n', 1, 59, 28, '', '500'),
(16, 3, '24', 'n', 1, 52, 28, '', '450'),
(17, 3, '43', 'n', 1, 55, 28, '', '800'),
(18, 3, '250', 'n', 1, 58, 28, '', '100'),
(19, 3, '20', 'n', 1, 56, 28, '', '500'),
(20, 3, '200', 'n', 1, 54, 28, '', '250'),
(21, 3, '50', 'n', 1, 53, 28, '', '150');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prc_orden_trabajo_etapas`
--

CREATE TABLE IF NOT EXISTS `prc_orden_trabajo_etapas` (
`codigo` int(11) NOT NULL,
  `codigo_orden_trabajo` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `codigo_departamento` int(11) NOT NULL,
  `completo` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `prc_orden_trabajo_etapas`
--

INSERT INTO `prc_orden_trabajo_etapas` (`codigo`, `codigo_orden_trabajo`, `codigo_producto`, `codigo_departamento`, `completo`) VALUES
(1, 1, 28, 49, '2014-10-24'),
(2, 2, 28, 49, '2014-10-27'),
(3, 3, 28, 49, '2014-10-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prc_semielaborados`
--

CREATE TABLE IF NOT EXISTS `prc_semielaborados` (
`codigo` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `desactivo` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE IF NOT EXISTS `prueba` (
`codigo` int(11) NOT NULL,
  `codigo_alias` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rif` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `prueba`
--

INSERT INTO `prueba` (`codigo`, `codigo_alias`, `descripcion`, `correo`, `direccion`, `telefono`, `rif`) VALUES
(1, 'Asdrubal Paez C.A.', 'descripcion', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-1'),
(2, 'Jose Garcia C.A.', 'ejemplo2', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-2'),
(3, 'Ingeve C.A.', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-3'),
(4, 'Camara de Comercio C', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-4'),
(5, 'Ferreteria C.A.', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-5'),
(6, 'Hamburguesa C.A.', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-6'),
(7, 'Filito C.A.', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-7'),
(8, 'Herrera C.A.', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-8'),
(9, 'Igualito C.A.', 'ejemplo', 'ejemplo@ejemplo', 'ejemplo calle ejemplo', '5555-5555', 'j-0000000-9');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_comisiones`
--

CREATE TABLE IF NOT EXISTS `ven_comisiones` (
`codigo` int(11) NOT NULL,
  `codigo_empresa` int(11) NOT NULL,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `codigo_tipo` int(11) NOT NULL,
  `monoto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_empleado`
--

CREATE TABLE IF NOT EXISTS `ven_empleado` (
`codigo` int(11) NOT NULL,
  `codigo_empleado` int(11) NOT NULL,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `codigo_cliente` int(11) NOT NULL,
  `codigo_factura` int(11) NOT NULL,
  `venta_contado` varchar(200) NOT NULL,
  `venta_credito` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_empresa`
--

CREATE TABLE IF NOT EXISTS `ven_empresa` (
`codigo` int(11) NOT NULL,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `venta_contado` varchar(200) NOT NULL,
  `venta_credito` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ven_tipo`
--

CREATE TABLE IF NOT EXISTS `ven_tipo` (
`codigo` int(11) NOT NULL,
  `codigo_alias` varchar(8) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `nombre1` varchar(100) NOT NULL,
  `nombre2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `mco_view_formulaconcepto`
--
DROP TABLE IF EXISTS `mco_view_formulaconcepto`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mco_view_formulaconcepto` AS select `mno_concepto`.`codigo` AS `codigo`,`mno_concepto`.`codigoproceso` AS `codigoproceso`,`mco_formulaconcepto`.`formula` AS `formula` from (`mno_concepto` join `mco_formulaconcepto` on((`mno_concepto`.`codigo` = `mco_formulaconcepto`.`codigoconcepto`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `mco_view_montoconstante`
--
DROP TABLE IF EXISTS `mco_view_montoconstante`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mco_view_montoconstante` AS select `mno_constante`.`codigo` AS `codigo`,`mno_constante`.`codigoproceso` AS `codigoproceso`,`mco_montoconstante`.`monto` AS `monto` from (`mno_constante` join `mco_montoconstante` on((`mno_constante`.`codigo` = `mco_montoconstante`.`codigoconstante`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `mno_view_concepto_empleados`
--
DROP TABLE IF EXISTS `mno_view_concepto_empleados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mno_view_concepto_empleados` AS select `mno_concepto_empleados`.`codigo` AS `codigo`,`mno_concepto_empleados`.`codigoempleado` AS `codigoempleado`,`mno_concepto_empleados`.`codigomes` AS `codigomes`,`mno_concepto_empleados`.`codigoconcepto` AS `codigoconcepto`,`mno_concepto_empleados`.`codigosemana` AS `codigosemana`,`mno_concepto_empleados`.`valor` AS `valor`,`mno_concepto`.`codigoproceso` AS `codigoproceso`,`mno_concepto`.`descripcion` AS `descripcion`,`mno_concepto`.`codigotipo` AS `codigotipo`,`mno_concepto_empleados`.`resultado` AS `resultado` from (`mno_concepto_empleados` join `mno_concepto` on((`mno_concepto_empleados`.`codigoconcepto` = `mno_concepto`.`codigo`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `mrh_view_analisisxempleado`
--
DROP TABLE IF EXISTS `mrh_view_analisisxempleado`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mrh_view_analisisxempleado` AS select `mrh_turnoxempleado`.`cedulaempleado` AS `cedulaempleado`,`mrh_turnoxempleado`.`codigomes` AS `codigomes`,`mrh_turnoxempleado`.`codigosemana` AS `codigosemana`,`mrh_turnos`.`codigo` AS `codigo`,`mrh_turnos`.`descripcion` AS `descripcion`,`mrh_turnos`.`horaentrada` AS `horaentrada`,`mrh_turnos`.`horasalida` AS `horasalida`,`mrh_turnos`.`horadescanso` AS `horadescanso`,`mrh_turnos`.`descripciontipoturno` AS `descripciontipoturno`,`mrh_turnos`.`diaslaborales` AS `diaslaborales`,`mrh_turnos`.`horaextradiurno` AS `horaextradiurno`,`mrh_turnos`.`horaextranocturno` AS `horaextranocturno`,`mrh_turnos`.`horatdiario` AS `horatdiario`,`mrh_turnos`.`horatsemana` AS `horatsemana`,`mrh_turnos`.`horatmensual` AS `horatmensual`,`mrh_turnos`.`totalhrsextra` AS `totalhrsextra`,`mrh_turnos`.`hrsnocdiarias` AS `hrsnocdiarias`,`mrh_turnos`.`hrsnocsemanal` AS `hrsnocsemanal`,`mrh_turnos`.`hrsnocmensual` AS `hrsnocmensual`,`mrh_turnos`.`hrslabpermitidas` AS `hrslabpermitidas`,`mrh_turnos`.`bononocdiario` AS `bononocdiario`,`mrh_turnos`.`bononocsemanal` AS `bononocsemanal`,`mrh_turnos`.`bononocmensual` AS `bononocmensual` from (`mrh_turnos` join `mrh_turnoxempleado` on((`mrh_turnos`.`codigo` = `mrh_turnoxempleado`.`codigoturno`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `mrh_view_turnos_empleados`
--
DROP TABLE IF EXISTS `mrh_view_turnos_empleados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mrh_view_turnos_empleados` AS select `mrh_turnoxempleado`.`cedulaempleado` AS `cedulaempleado`,`mrh_turnoxempleado`.`codigomes` AS `codigomes`,`mrh_turnoxempleado`.`codigosemana` AS `codigosemana`,`mrh_turnos`.`descripciontipoturno` AS `descripciontipoturno` from (`mrh_turnos` join `mrh_turnoxempleado` on((`mrh_turnos`.`codigo` = `mrh_turnoxempleado`.`codigoturno`)));

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bien_metros_departamento`
--
ALTER TABLE `bien_metros_departamento`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `bie_asignaciones`
--
ALTER TABLE `bie_asignaciones`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `bie_mantenimiento`
--
ALTER TABLE `bie_mantenimiento`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `bie_realizar_mantenimiento`
--
ALTER TABLE `bie_realizar_mantenimiento`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `bie_revicion_diaria_vhiculo`
--
ALTER TABLE `bie_revicion_diaria_vhiculo`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `bie_rutas`
--
ALTER TABLE `bie_rutas`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `bie_tipo_activo_principal`
--
ALTER TABLE `bie_tipo_activo_principal`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `bie_tipo_basico`
--
ALTER TABLE `bie_tipo_basico`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `bie_tipo_bien`
--
ALTER TABLE `bie_tipo_bien`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `bie_tipo_maquinaria`
--
ALTER TABLE `bie_tipo_maquinaria`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `bie_tipo_vehiculo`
--
ALTER TABLE `bie_tipo_vehiculo`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `bie_unidad_medida`
--
ALTER TABLE `bie_unidad_medida`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `cob_disminucion`
--
ALTER TABLE `cob_disminucion`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `cob_facturas`
--
ALTER TABLE `cob_facturas`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `configuracion_general`
--
ALTER TABLE `configuracion_general`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `cos_detalle_erogaciones`
--
ALTER TABLE `cos_detalle_erogaciones`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `cos_erogaciones`
--
ALTER TABLE `cos_erogaciones`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mco_backup_mensual`
--
ALTER TABLE `mco_backup_mensual`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mco_dias_feriados`
--
ALTER TABLE `mco_dias_feriados`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mco_efectuar_dotacion_uniforme`
--
ALTER TABLE `mco_efectuar_dotacion_uniforme`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mco_empresa`
--
ALTER TABLE `mco_empresa`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mco_forma_pago`
--
ALTER TABLE `mco_forma_pago`
 ADD PRIMARY KEY (`codigo`), ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `mco_formulaconcepto`
--
ALTER TABLE `mco_formulaconcepto`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mco_montoconstante`
--
ALTER TABLE `mco_montoconstante`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mco_organigrama`
--
ALTER TABLE `mco_organigrama`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mco_periocidad`
--
ALTER TABLE `mco_periocidad`
 ADD PRIMARY KEY (`codigo`), ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `mco_razon_social`
--
ALTER TABLE `mco_razon_social`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mco_tabulador_antiguedad`
--
ALTER TABLE `mco_tabulador_antiguedad`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mco_tabulador_nuevo_bonos_produccion`
--
ALTER TABLE `mco_tabulador_nuevo_bonos_produccion`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_cliente`
--
ALTER TABLE `min_cliente`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_compra`
--
ALTER TABLE `min_compra`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_compra_importacion`
--
ALTER TABLE `min_compra_importacion`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_empresa`
--
ALTER TABLE `min_empresa`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_imagen`
--
ALTER TABLE `min_imagen`
 ADD PRIMARY KEY (`nombre_subir`);

--
-- Indices de la tabla `min_inventario_cola`
--
ALTER TABLE `min_inventario_cola`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_inventario_ueps`
--
ALTER TABLE `min_inventario_ueps`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_productos_servicios`
--
ALTER TABLE `min_productos_servicios`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_requisicion`
--
ALTER TABLE `min_requisicion`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_tipo_empresa`
--
ALTER TABLE `min_tipo_empresa`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_tipo_inventario`
--
ALTER TABLE `min_tipo_inventario`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_tipo_moneda`
--
ALTER TABLE `min_tipo_moneda`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_tipo_pago`
--
ALTER TABLE `min_tipo_pago`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_uso_consumo`
--
ALTER TABLE `min_uso_consumo`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `min_valoracion`
--
ALTER TABLE `min_valoracion`
 ADD PRIMARY KEY (`codigo`), ADD UNIQUE KEY `codigo_producto` (`codigo_producto`);

--
-- Indices de la tabla `min_ventas`
--
ALTER TABLE `min_ventas`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_antiguedad`
--
ALTER TABLE `mno_antiguedad`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_beneficio_proceso`
--
ALTER TABLE `mno_beneficio_proceso`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_cargalaboral`
--
ALTER TABLE `mno_cargalaboral`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_concepto`
--
ALTER TABLE `mno_concepto`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_concepto_empleados`
--
ALTER TABLE `mno_concepto_empleados`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_constante`
--
ALTER TABLE `mno_constante`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_departamento`
--
ALTER TABLE `mno_departamento`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_empleadoxnomina`
--
ALTER TABLE `mno_empleadoxnomina`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_gerencia`
--
ALTER TABLE `mno_gerencia`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_new_bonos_produccion`
--
ALTER TABLE `mno_new_bonos_produccion`
 ADD PRIMARY KEY (`codigo`), ADD UNIQUE KEY `bonos_produccioncol_UNIQUE` (`nombre`);

--
-- Indices de la tabla `mno_new_bono_variable`
--
ALTER TABLE `mno_new_bono_variable`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_new_concepto`
--
ALTER TABLE `mno_new_concepto`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_new_concepto_tipo`
--
ALTER TABLE `mno_new_concepto_tipo`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_new_variables`
--
ALTER TABLE `mno_new_variables`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_new_variables_tipo`
--
ALTER TABLE `mno_new_variables_tipo`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_nomina`
--
ALTER TABLE `mno_nomina`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_proceso_empleados`
--
ALTER TABLE `mno_proceso_empleados`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_tipo_concepto`
--
ALTER TABLE `mno_tipo_concepto`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mno_unidadadm`
--
ALTER TABLE `mno_unidadadm`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_ano`
--
ALTER TABLE `mrh_ano`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_beneficio_periodico`
--
ALTER TABLE `mrh_beneficio_periodico`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_carga`
--
ALTER TABLE `mrh_carga`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_cargo`
--
ALTER TABLE `mrh_cargo`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_dotacion`
--
ALTER TABLE `mrh_dotacion`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_empleado`
--
ALTER TABLE `mrh_empleado`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_empleado_depende`
--
ALTER TABLE `mrh_empleado_depende`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_jornada`
--
ALTER TABLE `mrh_jornada`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_mes`
--
ALTER TABLE `mrh_mes`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_periocidad`
--
ALTER TABLE `mrh_periocidad`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_periocidad_proceso`
--
ALTER TABLE `mrh_periocidad_proceso`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_semana`
--
ALTER TABLE `mrh_semana`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_tipoturno`
--
ALTER TABLE `mrh_tipoturno`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_tipo_beneficio`
--
ALTER TABLE `mrh_tipo_beneficio`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_turnos`
--
ALTER TABLE `mrh_turnos`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `mrh_turnoxempleado`
--
ALTER TABLE `mrh_turnoxempleado`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `prc_detalle_etapa`
--
ALTER TABLE `prc_detalle_etapa`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `prc_elaborados`
--
ALTER TABLE `prc_elaborados`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `prc_etapas`
--
ALTER TABLE `prc_etapas`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `prc_orden_trabajador`
--
ALTER TABLE `prc_orden_trabajador`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `prc_orden_trabajo`
--
ALTER TABLE `prc_orden_trabajo`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `prc_orden_trabajo_detalle_etapa`
--
ALTER TABLE `prc_orden_trabajo_detalle_etapa`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `prc_orden_trabajo_etapas`
--
ALTER TABLE `prc_orden_trabajo_etapas`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `prc_semielaborados`
--
ALTER TABLE `prc_semielaborados`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `ven_comisiones`
--
ALTER TABLE `ven_comisiones`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `ven_empleado`
--
ALTER TABLE `ven_empleado`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `ven_empresa`
--
ALTER TABLE `ven_empresa`
 ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `ven_tipo`
--
ALTER TABLE `ven_tipo`
 ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bien_metros_departamento`
--
ALTER TABLE `bien_metros_departamento`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `bie_asignaciones`
--
ALTER TABLE `bie_asignaciones`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `bie_mantenimiento`
--
ALTER TABLE `bie_mantenimiento`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `bie_realizar_mantenimiento`
--
ALTER TABLE `bie_realizar_mantenimiento`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `bie_revicion_diaria_vhiculo`
--
ALTER TABLE `bie_revicion_diaria_vhiculo`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `bie_rutas`
--
ALTER TABLE `bie_rutas`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `bie_tipo_activo_principal`
--
ALTER TABLE `bie_tipo_activo_principal`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `bie_tipo_basico`
--
ALTER TABLE `bie_tipo_basico`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `bie_tipo_bien`
--
ALTER TABLE `bie_tipo_bien`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `bie_tipo_maquinaria`
--
ALTER TABLE `bie_tipo_maquinaria`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `bie_tipo_vehiculo`
--
ALTER TABLE `bie_tipo_vehiculo`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `bie_unidad_medida`
--
ALTER TABLE `bie_unidad_medida`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `cob_disminucion`
--
ALTER TABLE `cob_disminucion`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cob_facturas`
--
ALTER TABLE `cob_facturas`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `configuracion_general`
--
ALTER TABLE `configuracion_general`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `cos_detalle_erogaciones`
--
ALTER TABLE `cos_detalle_erogaciones`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `cos_erogaciones`
--
ALTER TABLE `cos_erogaciones`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `mco_backup_mensual`
--
ALTER TABLE `mco_backup_mensual`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `mco_dias_feriados`
--
ALTER TABLE `mco_dias_feriados`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `mco_efectuar_dotacion_uniforme`
--
ALTER TABLE `mco_efectuar_dotacion_uniforme`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `mco_empresa`
--
ALTER TABLE `mco_empresa`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `mco_forma_pago`
--
ALTER TABLE `mco_forma_pago`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'esta es para tener guardado la configuracion de las formas pagadas a los bonos',AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `mco_formulaconcepto`
--
ALTER TABLE `mco_formulaconcepto`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT de la tabla `mco_montoconstante`
--
ALTER TABLE `mco_montoconstante`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT de la tabla `mco_organigrama`
--
ALTER TABLE `mco_organigrama`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `mco_periocidad`
--
ALTER TABLE `mco_periocidad`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `mco_razon_social`
--
ALTER TABLE `mco_razon_social`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mco_tabulador_antiguedad`
--
ALTER TABLE `mco_tabulador_antiguedad`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `mco_tabulador_nuevo_bonos_produccion`
--
ALTER TABLE `mco_tabulador_nuevo_bonos_produccion`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `min_cliente`
--
ALTER TABLE `min_cliente`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `min_compra`
--
ALTER TABLE `min_compra`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `min_compra_importacion`
--
ALTER TABLE `min_compra_importacion`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `min_empresa`
--
ALTER TABLE `min_empresa`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `min_inventario_cola`
--
ALTER TABLE `min_inventario_cola`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `min_inventario_ueps`
--
ALTER TABLE `min_inventario_ueps`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `min_productos_servicios`
--
ALTER TABLE `min_productos_servicios`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT de la tabla `min_requisicion`
--
ALTER TABLE `min_requisicion`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `min_tipo_empresa`
--
ALTER TABLE `min_tipo_empresa`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `min_tipo_inventario`
--
ALTER TABLE `min_tipo_inventario`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `min_tipo_moneda`
--
ALTER TABLE `min_tipo_moneda`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `min_tipo_pago`
--
ALTER TABLE `min_tipo_pago`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `min_uso_consumo`
--
ALTER TABLE `min_uso_consumo`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `min_valoracion`
--
ALTER TABLE `min_valoracion`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT de la tabla `min_ventas`
--
ALTER TABLE `min_ventas`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `mno_antiguedad`
--
ALTER TABLE `mno_antiguedad`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `mno_beneficio_proceso`
--
ALTER TABLE `mno_beneficio_proceso`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mno_cargalaboral`
--
ALTER TABLE `mno_cargalaboral`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `mno_concepto`
--
ALTER TABLE `mno_concepto`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=183;
--
-- AUTO_INCREMENT de la tabla `mno_concepto_empleados`
--
ALTER TABLE `mno_concepto_empleados`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mno_constante`
--
ALTER TABLE `mno_constante`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT de la tabla `mno_departamento`
--
ALTER TABLE `mno_departamento`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `mno_empleadoxnomina`
--
ALTER TABLE `mno_empleadoxnomina`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mno_gerencia`
--
ALTER TABLE `mno_gerencia`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `mno_new_bonos_produccion`
--
ALTER TABLE `mno_new_bonos_produccion`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `mno_new_bono_variable`
--
ALTER TABLE `mno_new_bono_variable`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `mno_new_concepto`
--
ALTER TABLE `mno_new_concepto`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de la tabla `mno_new_concepto_tipo`
--
ALTER TABLE `mno_new_concepto_tipo`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `mno_new_variables`
--
ALTER TABLE `mno_new_variables`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `mno_new_variables_tipo`
--
ALTER TABLE `mno_new_variables_tipo`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `mno_nomina`
--
ALTER TABLE `mno_nomina`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mno_proceso_empleados`
--
ALTER TABLE `mno_proceso_empleados`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mno_tipo_concepto`
--
ALTER TABLE `mno_tipo_concepto`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=190;
--
-- AUTO_INCREMENT de la tabla `mno_unidadadm`
--
ALTER TABLE `mno_unidadadm`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `mrh_ano`
--
ALTER TABLE `mrh_ano`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `mrh_beneficio_periodico`
--
ALTER TABLE `mrh_beneficio_periodico`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mrh_carga`
--
ALTER TABLE `mrh_carga`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `mrh_cargo`
--
ALTER TABLE `mrh_cargo`
MODIFY `codigo` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `mrh_dotacion`
--
ALTER TABLE `mrh_dotacion`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mrh_empleado`
--
ALTER TABLE `mrh_empleado`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `mrh_empleado_depende`
--
ALTER TABLE `mrh_empleado_depende`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `mrh_jornada`
--
ALTER TABLE `mrh_jornada`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `mrh_mes`
--
ALTER TABLE `mrh_mes`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `mrh_periocidad`
--
ALTER TABLE `mrh_periocidad`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mrh_periocidad_proceso`
--
ALTER TABLE `mrh_periocidad_proceso`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mrh_semana`
--
ALTER TABLE `mrh_semana`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT de la tabla `mrh_tipoturno`
--
ALTER TABLE `mrh_tipoturno`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `mrh_tipo_beneficio`
--
ALTER TABLE `mrh_tipo_beneficio`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mrh_turnos`
--
ALTER TABLE `mrh_turnos`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `mrh_turnoxempleado`
--
ALTER TABLE `mrh_turnoxempleado`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT de la tabla `prc_detalle_etapa`
--
ALTER TABLE `prc_detalle_etapa`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `prc_elaborados`
--
ALTER TABLE `prc_elaborados`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `prc_etapas`
--
ALTER TABLE `prc_etapas`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `prc_orden_trabajador`
--
ALTER TABLE `prc_orden_trabajador`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'esta tabla es para ver cuando se agregan trabajdores a una orden especifica q tiene q estar activa',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `prc_orden_trabajo`
--
ALTER TABLE `prc_orden_trabajo`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `prc_orden_trabajo_detalle_etapa`
--
ALTER TABLE `prc_orden_trabajo_detalle_etapa`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `prc_orden_trabajo_etapas`
--
ALTER TABLE `prc_orden_trabajo_etapas`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `prc_semielaborados`
--
ALTER TABLE `prc_semielaborados`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `ven_comisiones`
--
ALTER TABLE `ven_comisiones`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ven_empleado`
--
ALTER TABLE `ven_empleado`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ven_empresa`
--
ALTER TABLE `ven_empresa`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ven_tipo`
--
ALTER TABLE `ven_tipo`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
