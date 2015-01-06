-- phpMyAdmin SQL Dump
-- version 4.2.9.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-11-2014 a las 11:41:50
-- Versión del servidor: 5.5.40
-- Versión de PHP: 5.4.34

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bie_asignaciones`
--



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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bie_mantenimiento`
--



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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bie_realizar_mantenimiento`
--



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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bie_revicion_diaria_vhiculo`
--



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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bie_rutas`
--


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bie_tipo_activo_principal`
--


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bie_tipo_basico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_tipo_bien`
--

CREATE TABLE IF NOT EXISTS `bie_tipo_bien` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bie_unidad_medida`
--

CREATE TABLE IF NOT EXISTS `bie_unidad_medida` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `sigla` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion_general`
--

CREATE TABLE IF NOT EXISTS `configuracion_general` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cos_erogaciones`
--

CREATE TABLE IF NOT EXISTS `cos_erogaciones` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `desactivo` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'n'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mco_backup_mensual`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_dias_feriados`
--

CREATE TABLE IF NOT EXISTS `mco_dias_feriados` (
`codigo` int(11) NOT NULL,
  `mes` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dia` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mco_empresa`
--

INSERT INTO `mco_empresa` (`codigo`, `nombre`, `nombre_largo`, `rif`, `direccion`, `telefono`, `fax`) VALUES
(1, 'Silys, C.A.', 'Colchones Silys, C.A.', 'j-30598122-1', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mco_forma_pago`
--

CREATE TABLE IF NOT EXISTS `mco_forma_pago` (
`codigo` int(11) NOT NULL COMMENT 'esta es para tener guardado la configuracion de las formas pagadas a los bonos',
  `nombre` varchar(45) DEFAULT NULL,
  `eliminado` varchar(12) DEFAULT 'no'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `min_tipo_empresa`
--

CREATE TABLE IF NOT EXISTS `min_tipo_empresa` (
`codigo` int(11) NOT NULL,
  `tipo` varchar(80) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='tabla para el uso consumo';

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
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `min_valoracion`
--


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_antiguedad`
--

CREATE TABLE IF NOT EXISTS `mno_antiguedad` (
`codigo` int(11) NOT NULL,
  `anos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diasbono` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_constante`
--

CREATE TABLE IF NOT EXISTS `mno_constante` (
`codigo` int(11) NOT NULL,
  `codigoproceso` varchar(8) DEFAULT NULL,
  `descripcion` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `asignacion` varchar(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mno_gerencia`
--

INSERT INTO `mno_gerencia` (`codigo`, `codigoalias`, `descripcion`, `codigo_depende`, `etapa`, `profundidad`, `nombre_depende`) VALUES
(7, 'DIRECT', 'Junta Directiva', 0, 'no', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_new_bono_variable`
--

CREATE TABLE IF NOT EXISTS `mno_new_bono_variable` (
`codigo` int(11) NOT NULL,
  `codigo_empleado` int(11) NOT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `periocidad` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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


ALTER TABLE `mno_new_concepto_empleado` 
CHANGE COLUMN `codigo` `codigo` INT(11) NOT NULL AUTO_INCREMENT ,
ADD PRIMARY KEY (`codigo`);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_new_concepto_tipo`
--

CREATE TABLE IF NOT EXISTS `mno_new_concepto_tipo` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mno_tipo_concepto`
--

CREATE TABLE IF NOT EXISTS `mno_tipo_concepto` (
`codigo` int(11) NOT NULL,
  `codigo_concepto` int(8) NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_cargo`
--

CREATE TABLE IF NOT EXISTS `mrh_cargo` (
`codigo` int(8) NOT NULL,
  `codigoalias` varchar(8) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mrh_cargo`
--

INSERT INTO `mrh_cargo` (`codigo`, `codigoalias`, `descripcion`) VALUES
(23, 'GERGERGE', 'Gerente');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `tipo_trabajador` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `foto` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `nacionalidad` varchar(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_empleado_depende`
--

CREATE TABLE IF NOT EXISTS `mrh_empleado_depende` (
`codigo` int(11) NOT NULL,
  `codigo_trabajador` int(11) NOT NULL,
  `codigo_depende` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mrh_semana`
--

CREATE TABLE IF NOT EXISTS `mrh_semana` (
`codigo` int(11) NOT NULL,
  `codigoano` int(11) DEFAULT NULL,
  `codigomes` int(11) DEFAULT NULL,
  `codigosemana` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mrh_turnoxempleado`
--


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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prc_elaborados`
--

CREATE TABLE IF NOT EXISTS `prc_elaborados` (
`codigo` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `desactivo` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prc_etapas`
--

CREATE TABLE IF NOT EXISTS `prc_etapas` (
`codigo` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `codigo_departamento` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `desactivo` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `horas_estandar` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prc_semielaborados`
--

CREATE TABLE IF NOT EXISTS `prc_semielaborados` (
`codigo` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `desactivo` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `prueba`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
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
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `prc_orden_trabajador`
--
ALTER TABLE `prc_orden_trabajador`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'esta tabla es para ver cuando se agregan trabajdores a una orden especifica q tiene q estar activa';
--
-- AUTO_INCREMENT de la tabla `prc_orden_trabajo`
--
ALTER TABLE `prc_orden_trabajo`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `prc_orden_trabajo_detalle_etapa`
--
ALTER TABLE `prc_orden_trabajo_detalle_etapa`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `prc_orden_trabajo_etapas`
--
ALTER TABLE `prc_orden_trabajo_etapas`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
