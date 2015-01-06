-- MySQL dump 10.13  Distrib 5.5.38, for linux2.6 (i686)
--
-- Host: localhost    Database: db_sicap
-- ------------------------------------------------------
-- Server version	5.5.38

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES UTF8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bie_asignaciones`
--

DROP TABLE IF EXISTS `bie_asignaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_asignaciones` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_bien` int(11) NOT NULL,
  `codigo_trabajador` int(11) NOT NULL,
  `codigo_tipo_bien` int(11) NOT NULL,
  `fecha_asignacion` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_culminacion` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `desasignado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_asignaciones`
--

LOCK TABLES `bie_asignaciones` WRITE;
/*!40000 ALTER TABLE `bie_asignaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `bie_asignaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_backup_bienes`
--

DROP TABLE IF EXISTS `bie_backup_bienes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_backup_bienes` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_bien` varchar(100) NOT NULL,
  `codigo_alias` varchar(100) NOT NULL,
  `codigo_contable` varchar(45) NOT NULL,
  `codigo_departamento` int(11) NOT NULL,
  `vida_util` varchar(4) NOT NULL,
  `fecha_adquisicion` varchar(12) NOT NULL,
  `costo_adquisicion` varchar(20) NOT NULL,
  `valor_rescate` varchar(20) NOT NULL,
  `monto_depreciar` varchar(20) NOT NULL,
  `codigo_depreciacion` int(11) NOT NULL,
  `valor_mercado` varchar(20) NOT NULL,
  `valor_actualizado` varchar(20) NOT NULL,
  `eliminado` varchar(45) NOT NULL DEFAULT 'n',
  `tipo` varchar(45) NOT NULL,
  `fecha_backup` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_backup_bienes`
--

LOCK TABLES `bie_backup_bienes` WRITE;
/*!40000 ALTER TABLE `bie_backup_bienes` DISABLE KEYS */;
/*!40000 ALTER TABLE `bie_backup_bienes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_mantenimiento`
--

DROP TABLE IF EXISTS `bie_mantenimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_mantenimiento` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_tipo_medida` int(11) NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `codigo_tipo_bien` int(11) NOT NULL,
  `periodicidad` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_mantenimiento`
--

LOCK TABLES `bie_mantenimiento` WRITE;
/*!40000 ALTER TABLE `bie_mantenimiento` DISABLE KEYS */;
INSERT INTO `bie_mantenimiento` VALUES (1,'hola',1,'n',1,'12');
/*!40000 ALTER TABLE `bie_mantenimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_realizar_mantenimiento`
--

DROP TABLE IF EXISTS `bie_realizar_mantenimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_realizar_mantenimiento` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_bien` int(11) NOT NULL,
  `codigo_bien_tipo` int(11) NOT NULL,
  `codigo_mantenimiento` int(11) NOT NULL,
  `codigo_contable` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `numero_factura` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `costo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `medida_especial` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `fecha` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_realizar_mantenimiento`
--

LOCK TABLES `bie_realizar_mantenimiento` WRITE;
/*!40000 ALTER TABLE `bie_realizar_mantenimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `bie_realizar_mantenimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_revicion_diaria_vhiculo`
--

DROP TABLE IF EXISTS `bie_revicion_diaria_vhiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_revicion_diaria_vhiculo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_vehiculo` int(11) DEFAULT NULL,
  `agua` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aceite` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `filtro` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caucho` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `frenos` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kilometros` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci DEFAULT 'n',
  `fecha` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_revicion_diaria_vhiculo`
--

LOCK TABLES `bie_revicion_diaria_vhiculo` WRITE;
/*!40000 ALTER TABLE `bie_revicion_diaria_vhiculo` DISABLE KEYS */;
INSERT INTO `bie_revicion_diaria_vhiculo` VALUES (1,5,'1','1','1','1','1','-2980','hola','n','2014-12-05');
/*!40000 ALTER TABLE `bie_revicion_diaria_vhiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_rutas`
--

DROP TABLE IF EXISTS `bie_rutas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_rutas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_rutas`
--

LOCK TABLES `bie_rutas` WRITE;
/*!40000 ALTER TABLE `bie_rutas` DISABLE KEYS */;
INSERT INTO `bie_rutas` VALUES (1,'Barquisimeto, Venezuela','Lara','Barquisimeto','','236.4','10.063611','-69.334722','Cabimas, Venezuela','Zulia','Cabimas','','10.3895862','-71.46928430000003','n'),(2,'Barquisimeto, Venezuela','Lara','Barquisimeto','','612.2','10.063611','-69.334722','Anzoátegui, Venezuela','Anzoategui','punto fijo','','8.5913073','-63.958611099999985','n'),(3,'Barquisimeto, Venezuela','Lara','Barquisimeto','','280.7','10.063611','-69.334722','Caracas, Venezuela','Caracas','caracas','','10.4696404','-66.8037185','n'),(4,'Barquisimeto, Venezuela','lara','barquisimeto','','236.4','10.063611','-69.334722','Cabimas, Venezuela','zulia','cabimas','','10.3895862','-71.46928430000003','2014-11-28');
/*!40000 ALTER TABLE `bie_rutas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_tipo_activo_principal`
--

DROP TABLE IF EXISTS `bie_tipo_activo_principal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_tipo_activo_principal` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `tipo` int(11) NOT NULL DEFAULT '4',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_tipo_activo_principal`
--

LOCK TABLES `bie_tipo_activo_principal` WRITE;
/*!40000 ALTER TABLE `bie_tipo_activo_principal` DISABLE KEYS */;
INSERT INTO `bie_tipo_activo_principal` VALUES (1,'edificio','000001','000001','50','2014-12-04','1000000','10','10',1,'1000100','1000200','300','n',4);
/*!40000 ALTER TABLE `bie_tipo_activo_principal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_tipo_basico`
--

DROP TABLE IF EXISTS `bie_tipo_basico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_tipo_basico` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `tipo` int(11) NOT NULL DEFAULT '1',
  `horas_trabajadas` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_tipo_basico`
--

LOCK TABLES `bie_tipo_basico` WRITE;
/*!40000 ALTER TABLE `bie_tipo_basico` DISABLE KEYS */;
INSERT INTO `bie_tipo_basico` VALUES (1,'computadora','000002','000002',11,'3','2014-12-04','20000','8','0',1,'1000','1000','n',1,'0'),(2,'computadora','00004','00004',9,'3','2014-12-04','12000','12','0',1,'12000','12000','n',1,'0'),(3,'Monitor 30 Pulgadas','00005','00005',10,'5','2014-12-04','560000','10','0',1,'60000','60000','n',1,'0'),(4,'computadora','00006','00006',12,'3','2011-12-08','80000','10','0',1,'80000','80000','n',1,'0'),(5,'Escritorio','000009','000009',8,'6','2013-06-07','20000','10','0',1,'0','0','n',1,'0'),(6,'Meson','000010','000010',7,'5','2014-12-04','5000','10','0',1,'0','0','n',1,'0'),(7,'Silla Ejecutiva','000011','000011',10,'5','2014-12-04','3000','9','0',1,'0','0','n',1,'0'),(8,'Aire Acondicionado','0000013','0000013',9,'3','2014-12-04','50000','10','0',1,'0','0','n',1,'0'),(9,'Mesa','000015','000015',16,'8','2014-12-04','10000','8','0',1,'0','0','n',1,'0'),(10,'dvd','000016','000016',17,'4','2014-12-04','3000','10','0',1,'0','0','n',1,'0'),(11,'Fotocopiadora','00000017','00000017',7,'3','2012-12-20','30000','9','0',1,'0','0','n',1,'0'),(12,'Telefono de Mesa','0000018','0000018',10,'4','2013-06-20','1000','10','0',1,'0','0','n',1,'0'),(13,'Lapton','00000018','00000018',12,'3','2014-12-04','60000','10','0',1,'0','0','n',1,'0'),(14,'Silla','000020','000020',7,'5','2012-07-25','500','10','0',1,'0','0','n',1,''),(15,'Computadora','000022','000022',9,'3','2012-04-18','30000','10','0',1,'0','0','n',1,''),(16,'Modem','23','23',11,'3','2014-12-04','800','10','0',1,'0','0','n',1,''),(17,'Silla','24','24',25,'5','2011-06-16','400','10','0',1,'0','0','n',1,''),(18,'Televisor','25','25',7,'3','2012-05-22','60000','10','0',1,'0','0','n',1,''),(19,'Impresorac HP','28','28',8,'3','2014-05-05','10000','8','0',1,'0','0','n',1,''),(20,'Lapton','31','31',12,'3|','2013-12-09','50000','10','0',1,'0','0','n',1,''),(21,'Telefono','32','32',11,'4','2011-12-22','1000','10','0',1,'0','0','n',1,''),(22,'Telefono','33','33',10,'4','2013-05-24','1200','10','0',1,'0','0','n',1,''),(23,'Monitor','34','34',10,'4','2012-09-03','5000','10','0',1,'0','0','n',1,''),(24,'Escritorio','35','35',12,'5','2012-07-25','2000','10','0',1,'0','0','n',1,''),(25,'Escritorio','36','36',13,'6','2007-10-09','2000','10','0',1,'0','0','n',1,''),(26,'Computadora','37','37',9,'4','2010-12-08','1000','8','0',1,'0','0','n',1,''),(27,'Microondas','38','38',10,'3','2012-10-24','4000','10','0',1,'0','0','n',1,''),(28,'Monitor 50 pulgadas','39','39',23,'3','2011-01-05','40000','40000','0',1,'0','0','n',1,''),(29,'Monitor 50 pulgadas','40','40',7,'3','2012-07-20','30000','10','0',1,'0','0','n',1,''),(30,'ejmeplo hola','00067767','554545',25,'45','2014-09-18','900','9','0',7,'0','0','n',1,'3000');
/*!40000 ALTER TABLE `bie_tipo_basico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_tipo_bien`
--

DROP TABLE IF EXISTS `bie_tipo_bien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_tipo_bien` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_tipo_bien`
--

LOCK TABLES `bie_tipo_bien` WRITE;
/*!40000 ALTER TABLE `bie_tipo_bien` DISABLE KEYS */;
INSERT INTO `bie_tipo_bien` VALUES (1,'Básico'),(2,'Maquinaria'),(3,'Vehículo'),(4,'Activo Principal');
/*!40000 ALTER TABLE `bie_tipo_bien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_tipo_depreciacion`
--

DROP TABLE IF EXISTS `bie_tipo_depreciacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_tipo_depreciacion` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_tipo_depreciacion`
--

LOCK TABLES `bie_tipo_depreciacion` WRITE;
/*!40000 ALTER TABLE `bie_tipo_depreciacion` DISABLE KEYS */;
INSERT INTO `bie_tipo_depreciacion` VALUES (1,'Linea Recta'),(2,'Unidades Producidas'),(3,'Ktms. Recoridos'),(4,'Digito Creciente'),(5,'Digito Creciente'),(6,'% Fijo');
/*!40000 ALTER TABLE `bie_tipo_depreciacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_tipo_licencia`
--

DROP TABLE IF EXISTS `bie_tipo_licencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_tipo_licencia` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_tipo_licencia`
--

LOCK TABLES `bie_tipo_licencia` WRITE;
/*!40000 ALTER TABLE `bie_tipo_licencia` DISABLE KEYS */;
INSERT INTO `bie_tipo_licencia` VALUES (1,'Tercera'),(2,'Cuarta'),(3,'Quinta');
/*!40000 ALTER TABLE `bie_tipo_licencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_tipo_maquinaria`
--

DROP TABLE IF EXISTS `bie_tipo_maquinaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_tipo_maquinaria` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `tipo` int(11) NOT NULL DEFAULT '2',
  `horas_trabajadas` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_tipo_maquinaria`
--

LOCK TABLES `bie_tipo_maquinaria` WRITE;
/*!40000 ALTER TABLE `bie_tipo_maquinaria` DISABLE KEYS */;
INSERT INTO `bie_tipo_maquinaria` VALUES (1,'Monta Carga','00003','00003',23,'8','2014-12-04','150000','10','0',1,'580000','17000','17002','n',2,''),(2,'Zorra','000012','000012',12,'8','2014-12-04','12000','12','0',1,'500000','0','0','n',2,''),(3,'Cortadora','29','29',22,'6','2012-09-04','600000','10','0',1,'0','0','0','n',2,''),(4,'Dobladora','30','30',18,'8','2013-01-26','800000','10','0',1,'0','0','0','n',2,''),(5,'ejmeplo maquinaria','656565655565','656565644',22,'0','2014-12-08','443435','9','100',2,'80000','0','0','n',2,'2500');
/*!40000 ALTER TABLE `bie_tipo_maquinaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_tipo_vehiculo`
--

DROP TABLE IF EXISTS `bie_tipo_vehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_tipo_vehiculo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `tipo` int(11) NOT NULL DEFAULT '3',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_tipo_vehiculo`
--

LOCK TABLES `bie_tipo_vehiculo` WRITE;
/*!40000 ALTER TABLE `bie_tipo_vehiculo` DISABLE KEYS */;
INSERT INTO `bie_tipo_vehiculo` VALUES (1,'NPR 5000','000008','000008',11,'6','2014-04-23','200000','10','0',1,'0','f5000','Ford','npr','444-ggg','12332-32323-3223','2','200000','200000','n',3),(2,'Vehiculo Zacura','0000014','0000014',12,'8','2014-12-04','110000','7','0',1,'340000','Ford','555-5555','Coupe','4454-3323','23232-1323123-43','1','0','0','n',3),(3,'Eclipce','00021','00021',9,'6','2014-12-04','130000','10','0',1,'20000','Eclipce','Mitsubishi','Coupe','4444-4444','444-4444-444-444','1','0','0','n',3),(4,'Mazda 32','26','26',10,'7','2012-12-24','200000','9','0',1,'1000','C44','Mazda','Coupe','3333-3','33333-333','1','0','0','n',3),(5,'Gandola','27','27',9,'6','2010-04-13','400000','10','0',1,'20','Mqc','Mac','Gandola','3333-3333','3333-3333','1','0','0','n',3),(6,'ejeplo vehiculo ','50004','464644444',21,'0','2014-12-08','323','10','5454',3,'300','gfgfgf','ghfhf','gfgf','ggg5544','4545','3','0','0','n',3);
/*!40000 ALTER TABLE `bie_tipo_vehiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_unidad_medida`
--

DROP TABLE IF EXISTS `bie_unidad_medida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_unidad_medida` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `sigla` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_unidad_medida`
--

LOCK TABLES `bie_unidad_medida` WRITE;
/*!40000 ALTER TABLE `bie_unidad_medida` DISABLE KEYS */;
INSERT INTO `bie_unidad_medida` VALUES (1,'Kilometros','km'),(2,'Horas','H'),(3,'Semestre','Semestre'),(4,'Semana','Semana'),(7,'Unidades','Unidades'),(8,'Año','Año'),(9,'Días','Días');
/*!40000 ALTER TABLE `bie_unidad_medida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bie_unidades_depreciacion`
--

DROP TABLE IF EXISTS `bie_unidades_depreciacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bie_unidades_depreciacion` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_bien` varchar(45) NOT NULL,
  `unidades` varchar(45) NOT NULL,
  `codigo_bien` varchar(45) NOT NULL,
  `fecha` varchar(12) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bie_unidades_depreciacion`
--

LOCK TABLES `bie_unidades_depreciacion` WRITE;
/*!40000 ALTER TABLE `bie_unidades_depreciacion` DISABLE KEYS */;
INSERT INTO `bie_unidades_depreciacion` VALUES (1,'bie_tipo_vehiculo','45','6','2014-12-01'),(2,'bie_tipo_vehiculo','40','6','2014-10-01'),(3,'bie_tipo_basico','200','30','2014-12-01'),(4,'bie_tipo_basico','3000','30','2014-11-01'),(5,'bie_tipo_maquinaria','666','5','2014-12-01'),(6,'bie_tipo_basico','4014','30','2014-12-01');
/*!40000 ALTER TABLE `bie_unidades_depreciacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bien_metros_departamento`
--

DROP TABLE IF EXISTS `bien_metros_departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bien_metros_departamento` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_departamento` int(11) NOT NULL,
  `codigo_tipo_activo_principal` int(11) NOT NULL,
  `metros` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bien_metros_departamento`
--

LOCK TABLES `bien_metros_departamento` WRITE;
/*!40000 ALTER TABLE `bien_metros_departamento` DISABLE KEYS */;
INSERT INTO `bien_metros_departamento` VALUES (1,9,1,'2','n'),(2,10,1,'17','n'),(3,11,1,'17','n'),(4,20,1,'17','n'),(5,23,1,'14','n'),(6,25,1,'18','n'),(7,22,1,'17','n'),(8,7,1,'20','n'),(9,15,1,'16','n'),(10,8,1,'18','n'),(11,21,1,'12','n'),(12,16,1,'22','n'),(13,18,1,'16','n'),(14,12,1,'17','n'),(15,19,1,'16','n'),(16,13,1,'10','n'),(17,14,1,'20','n'),(18,17,1,'31','n');
/*!40000 ALTER TABLE `bien_metros_departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cob_disminucion`
--

DROP TABLE IF EXISTS `cob_disminucion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cob_disminucion` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_empleado` int(11) NOT NULL,
  `monto_factura` varchar(16) NOT NULL,
  `monto` varchar(16) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cob_disminucion`
--

LOCK TABLES `cob_disminucion` WRITE;
/*!40000 ALTER TABLE `cob_disminucion` DISABLE KEYS */;
/*!40000 ALTER TABLE `cob_disminucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cob_facturas`
--

DROP TABLE IF EXISTS `cob_facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cob_facturas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_empleado` int(11) NOT NULL,
  `monto_factura` varchar(16) NOT NULL,
  `estatus_factura` varchar(16) NOT NULL,
  `monto` varchar(20) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cob_facturas`
--

LOCK TABLES `cob_facturas` WRITE;
/*!40000 ALTER TABLE `cob_facturas` DISABLE KEYS */;
/*!40000 ALTER TABLE `cob_facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion_general`
--

DROP TABLE IF EXISTS `configuracion_general`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion_general` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion_general`
--

LOCK TABLES `configuracion_general` WRITE;
/*!40000 ALTER TABLE `configuracion_general` DISABLE KEYS */;
INSERT INTO `configuracion_general` VALUES (1,'diferencia_de_salario','si'),(2,'bono_antiguedad_fijo','no'),(3,'anhio_servicios_fijo','si');
/*!40000 ALTER TABLE `configuracion_general` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cos_detalle_erogaciones`
--

DROP TABLE IF EXISTS `cos_detalle_erogaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cos_detalle_erogaciones` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cuenta_contable` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_erogacion` int(11) NOT NULL,
  `eliminado` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'n',
  `fecha` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `costo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cos_detalle_erogaciones`
--

LOCK TABLES `cos_detalle_erogaciones` WRITE;
/*!40000 ALTER TABLE `cos_detalle_erogaciones` DISABLE KEYS */;
INSERT INTO `cos_detalle_erogaciones` VALUES (4,'000023',20,'n','2014-12-12','100'),(5,'0003233',21,'n','2014-12-12','1200'),(6,'23232323',23,'n','2014-12-12','300'),(7,'dddds',24,'n','2014-12-12','1250'),(8,'asdasdasd',29,'n','2014-12-12','5000'),(9,'4500000',51,'n','2014-12-15','450');
/*!40000 ALTER TABLE `cos_detalle_erogaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cos_erogaciones`
--

DROP TABLE IF EXISTS `cos_erogaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cos_erogaciones` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_unidad_erogacion` int(11) NOT NULL,
  `codigo_departamento` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codigo_unidad_erogacion_idx` (`codigo_unidad_erogacion`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cos_erogaciones`
--

LOCK TABLES `cos_erogaciones` WRITE;
/*!40000 ALTER TABLE `cos_erogaciones` DISABLE KEYS */;
INSERT INTO `cos_erogaciones` VALUES (20,'Cantv 0251-233',13,20),(21,'Cantv 0251-2335',9,7),(22,'Cantv 0251-2335',9,18),(23,'Alimentos y Bebidas',14,7),(24,'Energia electrica',11,7),(25,'Energia electrica',11,8),(26,'Energia electrica',11,9),(27,'Energia electrica',11,10),(28,'Energia electrica',11,11),(29,'Energia electrica 110',12,7),(30,'Energia electrica 110',12,8),(31,'Energia electrica 110',12,9),(32,'Energia electrica 110',12,10),(33,'Energia electrica 110',12,11),(34,'Energia electrica 110',12,12),(35,'Energia electrica 110',12,13),(36,'Energia electrica 110',12,14),(37,'Energia electrica 110',12,15),(38,'Energia electrica 110',12,16),(39,'Energia electrica 110',12,17),(40,'Energia electrica 110',12,18),(41,'Energia electrica 110',12,19),(42,'Energia electrica 110',12,20),(43,'Energia electrica 110',12,21),(44,'Energia electrica 110',12,22),(45,'Energia electrica 110',12,23),(46,'hola',12,7),(47,'hola',12,8),(48,'hola',12,9),(49,'hola',12,10),(50,'hola',12,11),(51,'Agua potable',-1,7),(52,'Agua potable',-1,8),(53,'Agua potable',-1,9),(54,'Agua potable',-1,10),(55,'Agua potable',-1,11),(56,'Agua potable',-1,12),(57,'Agua potable',-1,13),(58,'Agua potable',-1,14),(59,'Agua potable',-1,15),(60,'Agua potable',-1,16),(61,'Agua potable',-1,17),(62,'Agua potable',-1,18),(63,'Agua potable',-1,19),(64,'Agua potable',-1,20),(65,'Agua potable',-1,21),(66,'Agua potable',-1,22),(67,'Agua potable',-1,23);
/*!40000 ALTER TABLE `cos_erogaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_backup_mensual`
--

DROP TABLE IF EXISTS `mco_backup_mensual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_backup_mensual` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `mes` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ano` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `respaldo_fecha` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ultimo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_backup_mensual`
--

LOCK TABLES `mco_backup_mensual` WRITE;
/*!40000 ALTER TABLE `mco_backup_mensual` DISABLE KEYS */;
INSERT INTO `mco_backup_mensual` VALUES (1,'11','2014','2014-11-10','n'),(4,'12','2014','2014-12-02','s');
/*!40000 ALTER TABLE `mco_backup_mensual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_dias_feriados`
--

DROP TABLE IF EXISTS `mco_dias_feriados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_dias_feriados` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `mes` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dia` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_dias_feriados`
--

LOCK TABLES `mco_dias_feriados` WRITE;
/*!40000 ALTER TABLE `mco_dias_feriados` DISABLE KEYS */;
INSERT INTO `mco_dias_feriados` VALUES (1,'Enero','1','Año Nuevo'),(2,'Abril','19','Declaración de la Independencia'),(3,'Mayo','1','Día del Trabajador'),(4,'Mayo','1','Día del Trabajador'),(5,'junio','24','Aniversario de la Batalla de Carabobo'),(6,'junio','24','Día de la Independencia'),(7,'junio','24','Aniversario de la Batalla de Carabobo'),(8,'junio','24','Día de la Independencia'),(9,'7','24','Natalicio de Simón Bolívar'),(10,'7','24','Natalicio de Simón Bolívar'),(11,'10','12','Día de la Resistencia Indígena'),(12,'10','12','Día de la Resistencia Indígena');
/*!40000 ALTER TABLE `mco_dias_feriados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_efectuar_dotacion_uniforme`
--

DROP TABLE IF EXISTS `mco_efectuar_dotacion_uniforme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_efectuar_dotacion_uniforme` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` varchar(12) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_efectuar_dotacion_uniforme`
--

LOCK TABLES `mco_efectuar_dotacion_uniforme` WRITE;
/*!40000 ALTER TABLE `mco_efectuar_dotacion_uniforme` DISABLE KEYS */;
INSERT INTO `mco_efectuar_dotacion_uniforme` VALUES (1,'2014-11-10');
/*!40000 ALTER TABLE `mco_efectuar_dotacion_uniforme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_empresa`
--

DROP TABLE IF EXISTS `mco_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_empresa` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `nombre_largo` varchar(45) NOT NULL,
  `rif` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `fax` varchar(45) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_empresa`
--

LOCK TABLES `mco_empresa` WRITE;
/*!40000 ALTER TABLE `mco_empresa` DISABLE KEYS */;
INSERT INTO `mco_empresa` VALUES (1,'Silys, C.A.','Colchones Spumjet, C.A.','j-30598122-1','','','');
/*!40000 ALTER TABLE `mco_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_forma_pago`
--

DROP TABLE IF EXISTS `mco_forma_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_forma_pago` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'esta es para tener guardado la configuracion de las formas pagadas a los bonos',
  `nombre` varchar(45) DEFAULT NULL,
  `eliminado` varchar(12) DEFAULT 'no',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_forma_pago`
--

LOCK TABLES `mco_forma_pago` WRITE;
/*!40000 ALTER TABLE `mco_forma_pago` DISABLE KEYS */;
INSERT INTO `mco_forma_pago` VALUES (0,'Monto Fijo','no'),(1,'% Salario Base','no'),(2,'% Salario Normal','no'),(3,'% Salario Integral','no'),(4,'Unidad Tributaria','no');
/*!40000 ALTER TABLE `mco_forma_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_formulaconcepto`
--

DROP TABLE IF EXISTS `mco_formulaconcepto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_formulaconcepto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigoconcepto` varchar(8) DEFAULT NULL,
  `formula` varchar(200) DEFAULT NULL,
  `asignacion` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_formulaconcepto`
--

LOCK TABLES `mco_formulaconcepto` WRITE;
/*!40000 ALTER TABLE `mco_formulaconcepto` DISABLE KEYS */;
INSERT INTO `mco_formulaconcepto` VALUES (98,'101','( c$SUE )',NULL),(99,'102','( c$BONX )',NULL),(100,'103','( c$BONY )',NULL),(101,'104','( c$BNOC )',NULL),(102,'105','( c$SAN )',NULL),(104,'106','( ( ( c$SAN / c$DME ) + ( ( c$SAN / c$DME ) * c$PHED ) )',NULL),(106,'107','( ( ( ( c$SAN / c$DME ) + ( ( c$SAN / c$DME ) * c$PHED ) ) + (  ( ( ( c$SAN / c$DME ) + ( ( c$SAN / c$DME ) * c$PHED ) ) * c$PHEN ) )',NULL),(107,'108','( c$PRIHIJ )',NULL),(108,'109','( c$PRIHOG )',NULL),(109,'110','( c$PRIVEH )',NULL),(110,'111','( ( c$CDA / c$DME ) * ( c$CDA / c$MES ) )',NULL),(111,'112','( c$CDA )',NULL),(112,'113','( c$DLA )',NULL),(113,'114','( c$DFE / c$DME )',NULL),(114,'115','( ( c$VAC / c$DME ) * ( c$VAC / c$MES ) )',NULL),(115,'116','( c$UTI / c$DIAA )',NULL),(116,'117','( c$DAG / c$DIAA )',NULL),(117,'118','( c$VEN * c$PCO )',NULL),(118,'119','( c$SIN )',NULL),(119,'120','( ( c$UBON / c$DME ) * c$CBN )',NULL),(120,'121','( c$SIND / c$DME )',NULL),(121,'122','( ( c$DPV / c$DME ) * ( c$DBV / c$MES ) )',NULL),(122,'123','( ( c$CPU / c$DME ) * c$DPS )',NULL),(123,'124','( c$TSI / c$MES )',NULL),(124,'125','( c$SSO * c$CSS )',NULL),(125,'126','( c$PIE * c$CPI )',NULL),(126,'127','( c$BAN )',NULL),(127,'128','( c$INC )',NULL),(128,'129','( c$SID )',NULL),(129,'130','( c$GNA * c$LDD )',NULL),(130,'131','( p$PLD / c$NTR )',NULL),(131,'132','( c$CAN )',NULL),(132,'133','( c$CAN )',NULL),(133,'134','( ( c$OBLUTI * c$UTR ) / c$MES )',NULL),(134,'135','( ( c$OBLJUG * c$UTR ) / c$MES )',NULL),(135,'136','( c$OBLBPH )',NULL),(136,'137','( ( c$OBLDNI * c$UTR ) / c$MES )',NULL),(137,'138','( c$OBLBPT )',NULL),(138,'139','( c$OBLGUA )',NULL),(139,'140','( ( c$OBLTRA / c$NTR ) / c$MES )',NULL),(140,'141','( ( c$OBLNIN / c$NTR ) / c$MES )',NULL),(141,'142','( c$OBLOFA / c$MES )',NULL),(142,'143','( c$OBLDUN / c$SMM )',NULL),(143,'144','( c$OBLASI / c$MES )',NULL);
/*!40000 ALTER TABLE `mco_formulaconcepto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_montoconstante`
--

DROP TABLE IF EXISTS `mco_montoconstante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_montoconstante` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigoconstante` int(11) DEFAULT NULL,
  `monto` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_montoconstante`
--

LOCK TABLES `mco_montoconstante` WRITE;
/*!40000 ALTER TABLE `mco_montoconstante` DISABLE KEYS */;
INSERT INTO `mco_montoconstante` VALUES (84,64,'1'),(85,65,'1'),(86,66,'60'),(87,67,'1453215'),(88,68,'0.09'),(89,69,'0.02'),(90,70,'0.02'),(91,71,'0.01'),(92,72,'0.02'),(93,73,'5.16'),(94,74,'20'),(95,75,'40'),(96,76,'0.16'),(97,77,'4252'),(98,78,'5'),(99,79,'0.30'),(100,80,'0.25'),(101,81,'500000'),(102,82,'0.01'),(103,83,'30'),(104,84,'7'),(105,85,'1'),(106,86,'1'),(107,87,'8'),(108,88,'7.5'),(109,89,'7'),(110,90,'1'),(111,91,'0.50'),(112,92,'0.30'),(113,93,'8'),(114,94,'127'),(115,95,'1.3'),(116,96,'1'),(117,97,'0.01'),(118,98,'0.05'),(119,99,'0.1'),(120,100,'1'),(121,101,'12'),(122,102,'1'),(123,103,'1.5'),(124,104,'1'),(125,105,'360'),(126,106,'1'),(127,107,'1'),(128,108,'1'),(129,109,'0.230769230769231'),(130,110,'0.230769230769231'),(131,111,'1'),(132,113,'100'),(133,114,'0.1'),(134,115,'0.1'),(135,116,'0.1'),(136,117,'1'),(137,118,'1'),(139,120,'0.1'),(140,121,'0.1'),(141,122,'0.1'),(142,123,'1'),(143,124,'20000'),(144,125,'20000'),(145,126,'3500'),(146,127,'3500'),(147,128,'6'),(148,129,'7500'),(149,130,'600'),(150,131,'1'),(151,132,'1'),(152,133,'1');
/*!40000 ALTER TABLE `mco_montoconstante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_organigrama`
--

DROP TABLE IF EXISTS `mco_organigrama`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_organigrama` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_alias` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `codigo_depende` int(11) DEFAULT NULL,
  `profundidad` varchar(6) DEFAULT NULL,
  `nombre_depende` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_organigrama`
--

LOCK TABLES `mco_organigrama` WRITE;
/*!40000 ALTER TABLE `mco_organigrama` DISABLE KEYS */;
INSERT INTO `mco_organigrama` VALUES (1,'Junta Directiva','Junta Directiva',0,'',''),(2,'PRESIDEN','Gerencia',1,'1','Junta Directiva'),(3,'0002','Compras',2,'1','Gerencia'),(4,'00004','Almacén',2,'1','Gerencia'),(5,'00005','Almacén',2,'1','Gerencia'),(6,'00006','Vemtas Industriales',2,'1','Gerencia'),(7,'00007','Ventas AutoMotrices',2,'1','Gerencia'),(8,'00008','Administración',2,'1','Gerencia');
/*!40000 ALTER TABLE `mco_organigrama` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_periocidad`
--

DROP TABLE IF EXISTS `mco_periocidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_periocidad` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `eliminado` varchar(12) DEFAULT 'no',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_periocidad`
--

LOCK TABLES `mco_periocidad` WRITE;
/*!40000 ALTER TABLE `mco_periocidad` DISABLE KEYS */;
INSERT INTO `mco_periocidad` VALUES (0,'Mes','no'),(1,'Quinceal','no'),(2,'Mensual','no'),(3,'Bimestral','no'),(4,'Trimestral','no'),(5,'Cuatrmestral','no'),(6,'Semestral','no'),(7,'Anual','no');
/*!40000 ALTER TABLE `mco_periocidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_razon_social`
--

DROP TABLE IF EXISTS `mco_razon_social`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_razon_social` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_razon_social`
--

LOCK TABLES `mco_razon_social` WRITE;
/*!40000 ALTER TABLE `mco_razon_social` DISABLE KEYS */;
/*!40000 ALTER TABLE `mco_razon_social` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_tabulador_anhio_servicio`
--

DROP TABLE IF EXISTS `mco_tabulador_anhio_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_tabulador_anhio_servicio` (
  `codigo` int(11) NOT NULL,
  `paso` varchar(4) NOT NULL,
  `referencia` varchar(45) NOT NULL,
  `valor` varchar(4) NOT NULL,
  `cola` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_tabulador_anhio_servicio`
--

LOCK TABLES `mco_tabulador_anhio_servicio` WRITE;
/*!40000 ALTER TABLE `mco_tabulador_anhio_servicio` DISABLE KEYS */;
INSERT INTO `mco_tabulador_anhio_servicio` VALUES (0,'0','100','50','');
/*!40000 ALTER TABLE `mco_tabulador_anhio_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_tabulador_antiguedad`
--

DROP TABLE IF EXISTS `mco_tabulador_antiguedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_tabulador_antiguedad` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `paso` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `referencia` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `cola` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_tabulador_antiguedad`
--

LOCK TABLES `mco_tabulador_antiguedad` WRITE;
/*!40000 ALTER TABLE `mco_tabulador_antiguedad` DISABLE KEYS */;
INSERT INTO `mco_tabulador_antiguedad` VALUES (1,'1','3','300',''),(2,'3','6','500',''),(3,'6','9','700',''),(4,'9','12','900',''),(5,'12','15','1100',''),(6,'15','100','1300','');
/*!40000 ALTER TABLE `mco_tabulador_antiguedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_tabulador_nuevo_bonos_produccion`
--

DROP TABLE IF EXISTS `mco_tabulador_nuevo_bonos_produccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_tabulador_nuevo_bonos_produccion` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `paso` varchar(4) DEFAULT NULL,
  `referencia` varchar(4) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `cola` varchar(4) DEFAULT NULL,
  `eliminado` varchar(12) DEFAULT 'no',
  `codigo_bono` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_tabulador_nuevo_bonos_produccion`
--

LOCK TABLES `mco_tabulador_nuevo_bonos_produccion` WRITE;
/*!40000 ALTER TABLE `mco_tabulador_nuevo_bonos_produccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `mco_tabulador_nuevo_bonos_produccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_unidad`
--

DROP TABLE IF EXISTS `mco_unidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_unidad` (
  `codigo` int(11) NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `default` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `sigla` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_unidad`
--

LOCK TABLES `mco_unidad` WRITE;
/*!40000 ALTER TABLE `mco_unidad` DISABLE KEYS */;
INSERT INTO `mco_unidad` VALUES (10,'Metros','si','m'),(11,'Metros Cuadrados','si','m2'),(12,'Metro Cubico','si','m3'),(13,'Kilogramo','si',' kg'),(14,'Litro','si','L'),(15,'Pie','si','ft'),(16,'Vara','si','vara'),(17,'Libra','si','lb'),(18,'Onza','si','oz'),(19,'Piezas','si','Pzas'),(20,'Toneladas','si','Tm'),(21,'Caja','si','caja'),(22,'Lote','si','lote'),(23,'Galon','si','galon'),(24,'Unidad','si','unidad'),(25,'ejemplo','no','ejem'),(26,'Cono','si','Cono.'),(27,'Rollo','si','Rollo'),(28,'Paquete','si','Pqte.'),(29,'Lata','si','lata'),(30,'Pieza','si','Pza.'),(31,'Par','si','Par'),(32,'Resma','si','Resma');
/*!40000 ALTER TABLE `mco_unidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_unidad_erogacion`
--

DROP TABLE IF EXISTS `mco_unidad_erogacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_unidad_erogacion` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `sigla` varchar(45) NOT NULL,
  `eliminado` varchar(12) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_unidad_erogacion`
--

LOCK TABLES `mco_unidad_erogacion` WRITE;
/*!40000 ALTER TABLE `mco_unidad_erogacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `mco_unidad_erogacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mco_unidad_erogacion_detalle`
--

DROP TABLE IF EXISTS `mco_unidad_erogacion_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mco_unidad_erogacion_detalle` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_unidad_erogacion` int(11) NOT NULL,
  `cantidad` varchar(45) NOT NULL,
  `codigo_departamento` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `codigo_unidad_erogacion_idx` (`codigo_unidad_erogacion`),
  KEY `codigo_gerencia_idx` (`codigo_departamento`),
  CONSTRAINT `codigo_gerencia` FOREIGN KEY (`codigo_departamento`) REFERENCES `mno_gerencia` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `codigo_unidad_erogacion` FOREIGN KEY (`codigo_unidad_erogacion`) REFERENCES `mco_unidad_erogacion` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mco_unidad_erogacion_detalle`
--

LOCK TABLES `mco_unidad_erogacion_detalle` WRITE;
/*!40000 ALTER TABLE `mco_unidad_erogacion_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `mco_unidad_erogacion_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `mco_view_formulaconcepto`
--

DROP TABLE IF EXISTS `mco_view_formulaconcepto`;
/*!50001 DROP VIEW IF EXISTS `mco_view_formulaconcepto`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `mco_view_formulaconcepto` (
  `codigo` tinyint NOT NULL,
  `codigoproceso` tinyint NOT NULL,
  `formula` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `mco_view_montoconstante`
--

DROP TABLE IF EXISTS `mco_view_montoconstante`;
/*!50001 DROP VIEW IF EXISTS `mco_view_montoconstante`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `mco_view_montoconstante` (
  `codigo` tinyint NOT NULL,
  `codigoproceso` tinyint NOT NULL,
  `monto` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `min_cliente`
--

DROP TABLE IF EXISTS `min_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_cliente` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_alias` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `rif` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_cliente`
--

LOCK TABLES `min_cliente` WRITE;
/*!40000 ALTER TABLE `min_cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `min_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_compra`
--

DROP TABLE IF EXISTS `min_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_compra` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `costo_total` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_compra`
--

LOCK TABLES `min_compra` WRITE;
/*!40000 ALTER TABLE `min_compra` DISABLE KEYS */;
INSERT INTO `min_compra` VALUES (1,142,1,'2014-11-10','2014-11-10',1,3,'0','80000','','28000','','n','28000'),(2,56,2,'2014-11-10','2014-11-10',1,3,'','3500','','8750','','n','8750'),(3,59,4,'2014-11-10','2014-11-10',1,3,'','65','','845','','n','845'),(4,54,5,'2014-11-10','2014-11-10',1,3,'','3600','','93600','','n','93600'),(5,58,3,'2014-11-10','2014-11-10',1,3,'','6000','','420000','','n','420000'),(6,55,2,'2014-11-10','2014-11-10',1,3,'','1200','','108000','','n','108000'),(7,53,2,'2014-11-10','2014-11-10',1,3,'','1600','','96000','','n','96000'),(8,52,4,'2014-11-10','2014-11-10',1,3,'','8000','','504000','','n','504000'),(9,143,5,'2014-11-10','2014-11-10',1,3,'','4500','','58500','','n','58500'),(10,60,3,'2014-11-10','2014-11-10',1,3,'','600','','60000','','n','60000'),(11,142,1,'2014-11-12','2014-11-12',1,3,'300','200','300','120000','','n','120600'),(12,142,2,'2014-11-13','2014-11-13',1,3,'','80000','','28000','','n','28000'),(13,56,5,'2014-11-13','2014-11-13',1,3,'','3500','','8750','','n','8750'),(14,59,3,'2014-11-13','2014-11-13',1,3,'','65','','845','','n','845'),(15,54,4,'2014-11-13','2014-11-13',1,3,'','3600','','93600','','n','93600'),(16,58,3,'2014-11-13','2014-11-13',1,3,'','6000','','420000','','n','420000'),(17,55,2,'2014-11-13','2014-11-13',1,3,'','1200','','108000','','n','108000'),(18,53,2,'2014-11-13','2014-11-13',1,3,'','1600','','96000','','n','96000'),(19,52,4,'2014-11-13','2014-11-13',1,3,'','8000','','504000','','n','504000'),(20,143,2,'2014-11-13','2014-11-13',1,3,'','4500','','58500','','n','58500'),(21,60,4,'2014-11-13','2014-11-13',1,3,'','600','','60000','','n','60000'),(22,142,4,'2014-11-18','2014-11-18',1,3,'','15000','','150000','','n','150000'),(23,56,2,'2014-11-18','2014-11-18',1,3,'','4200','','7350','','n','7350'),(24,59,2,'2014-11-18','2014-11-18',1,3,'','85','','1020','','n','1020'),(25,54,4,'2014-11-18','2014-11-18',1,3,'','5000','','135000','','n','135000'),(26,58,4,'2014-11-18','2014-11-18',1,3,'','7500','','540000','','n','540000'),(27,55,4,'2014-11-18','2014-11-18',1,3,'','1400','','140000','','n','140000'),(28,53,4,'2014-11-18','2014-11-18',1,3,'','2000','','140000','','n','140000'),(29,52,3,'2014-11-18','2014-11-18',1,3,'','12000','','816000','','n','816000'),(30,143,2,'2014-11-18','2014-11-18',1,3,'','5000','','80000','','n','80000'),(31,60,3,'2014-11-18','2014-11-18',1,3,'','800','','100000','','n','100000'),(32,115,2,'2014-11-19','2014-11-19',1,3,'','300','','300000','','n','300000'),(33,146,4,'2014-11-19','2014-11-19',1,3,'','59999','','5999999','','n','5999999'),(34,45,4,'2014-11-19','2014-11-19',1,3,'','5600','','3600000','','n','3600000'),(35,125,4,'2014-11-19','2014-11-19',1,3,'','2300000','','300000000','','n','300000000'),(36,188,5,'2014-12-18','2014-12-18',1,3,'400','30','0','40000','','n','40400');
/*!40000 ALTER TABLE `min_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_compra_importacion`
--

DROP TABLE IF EXISTS `min_compra_importacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_compra_importacion` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_compra` int(11) NOT NULL,
  `gasto_importacion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gasto_importacion_moneda` int(11) NOT NULL,
  `gastos_aduanales` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `gasto_aduanales_moneda` int(11) NOT NULL,
  `gastos_arancelarios` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gastos_arancelarios_moneda` int(11) NOT NULL,
  `gasto_nacionalizacion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gasto_nacionalizacion_moneda` int(11) NOT NULL,
  `tasa_cambio` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_compra_importacion`
--

LOCK TABLES `min_compra_importacion` WRITE;
/*!40000 ALTER TABLE `min_compra_importacion` DISABLE KEYS */;
INSERT INTO `min_compra_importacion` VALUES (1,1,'',0,'',0,'',0,'',0,''),(2,2,'',0,'',0,'',0,'',0,''),(3,3,'',0,'',0,'',0,'',0,''),(4,4,'',0,'',0,'',0,'',0,''),(5,5,'',0,'',0,'',0,'',0,''),(6,6,'',0,'',0,'',0,'',0,''),(7,7,'',0,'',0,'',0,'',0,''),(8,8,'',0,'',0,'',0,'',0,''),(9,9,'',0,'',0,'',0,'',0,''),(10,10,'',0,'',0,'',0,'',0,''),(11,11,'',0,'',0,'',0,'',0,''),(12,12,'',0,'',0,'',0,'',0,''),(13,13,'',0,'',0,'',0,'',0,''),(14,14,'',0,'',0,'',0,'',0,''),(15,15,'',0,'',0,'',0,'',0,''),(16,16,'',0,'',0,'',0,'',0,''),(17,17,'',0,'',0,'',0,'',0,''),(18,18,'',0,'',0,'',0,'',0,''),(19,19,'',0,'',0,'',0,'',0,''),(20,20,'',0,'',0,'',0,'',0,''),(21,21,'',0,'',0,'',0,'',0,''),(22,22,'',0,'',0,'',0,'',0,''),(23,23,'',0,'',0,'',0,'',0,''),(24,24,'',0,'',0,'',0,'',0,''),(25,25,'',0,'',0,'',0,'',0,''),(26,26,'',0,'',0,'',0,'',0,''),(27,27,'',0,'',0,'',0,'',0,''),(28,28,'',0,'',0,'',0,'',0,''),(29,29,'',0,'',0,'',0,'',0,''),(30,30,'',0,'',0,'',0,'',0,''),(31,31,'',0,'',0,'',0,'',0,''),(32,32,'',0,'',0,'',0,'',0,''),(33,33,'',0,'',0,'',0,'',0,''),(34,34,'',0,'',0,'',0,'',0,''),(35,35,'',0,'',0,'',0,'',0,''),(36,36,'',0,'',0,'',0,'',0,'');
/*!40000 ALTER TABLE `min_compra_importacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_desincorporacion`
--

DROP TABLE IF EXISTS `min_desincorporacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_desincorporacion` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` int(11) NOT NULL,
  `cantidad` varchar(45) NOT NULL,
  `costo` varchar(45) DEFAULT NULL,
  `valor_unitario` varchar(45) NOT NULL,
  `fecha` varchar(12) DEFAULT NULL,
  `comentario` varchar(250) DEFAULT NULL,
  `retiro` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_desincorporacion`
--

LOCK TABLES `min_desincorporacion` WRITE;
/*!40000 ALTER TABLE `min_desincorporacion` DISABLE KEYS */;
INSERT INTO `min_desincorporacion` VALUES (1,54,' 2 ','51.87012987013','99850','2014-11-12','  ',' deterioro '),(2,54,' 2 ','51.87012987013','99850','2014-11-12','  ',' deterioro '),(3,54,' 2 ','51.87012987013','99850','2014-11-12','  ',' deterioro ');
/*!40000 ALTER TABLE `min_desincorporacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_empresa`
--

DROP TABLE IF EXISTS `min_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_empresa` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_alias` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rif` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_empresa`
--

LOCK TABLES `min_empresa` WRITE;
/*!40000 ALTER TABLE `min_empresa` DISABLE KEYS */;
INSERT INTO `min_empresa` VALUES (1,'ejemplo','hola','ejemplo@ejemplo','ejemplo','5555-5555','0001'),(2,'ejemplo2','ejemplo2','ejemplo2@mail.com','ejemplo2','55555','0002'),(3,'ejemplo3','ejemplo3','ejemplo3@mail.com','ejemplo3','555-55555','0003'),(4,'ejemplo4','ejemplo4','ejemplo4@mail.com','ejemplo4','55555','0004'),(5,'ejemplo5','ejemplo5','ejemplo5@mail.com','ejemplo5','55555','0005');
/*!40000 ALTER TABLE `min_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_imagen`
--

DROP TABLE IF EXISTS `min_imagen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_imagen` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_subir` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_min_articulos` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_imagen`
--

LOCK TABLES `min_imagen` WRITE;
/*!40000 ALTER TABLE `min_imagen` DISABLE KEYS */;
/*!40000 ALTER TABLE `min_imagen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_inventario_cola`
--

DROP TABLE IF EXISTS `min_inventario_cola`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_inventario_cola` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `costo_total` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usado` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `id_compra` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `costo_unidad` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_inventario_cola`
--

LOCK TABLES `min_inventario_cola` WRITE;
/*!40000 ALTER TABLE `min_inventario_cola` DISABLE KEYS */;
INSERT INTO `min_inventario_cola` VALUES (1,'40','1412353942','476','25800.429233399','n',1,0,'52.02'),(2,'128','1412951928','250','431100','n',2,0,'1724.4'),(3,'129','1414007784','6','12000','n',3,0,'2000'),(4,'129','1414011786','8','16000','n',4,0,'2000'),(5,'59','1414159821','1000','500000','n',5,0,'500'),(6,'52','1414159872','1000','450000','n',6,0,'450'),(7,'55','1414159958','500','400000','n',7,0,'800'),(8,'58','1414160111','1000','100000','n',8,0,'100'),(9,'56','1414160147','6000','3000000','n',9,0,'500'),(10,'54','1414160195','40000','10000000','n',10,0,'250'),(11,'53','1414160234','3000','450000','n',11,0,'150'),(12,'142','1415646292','80000','28000','n',1,0,'0.35'),(13,'56','1415647163','3500','8750','n',2,0,'2.5'),(14,'59','1415647214','65','845','n',3,0,'13'),(15,'54','1415647266','3600','93600','n',4,0,'26'),(16,'58','1415647358','6000','420000','n',5,0,'70'),(17,'55','1415647407','1200','108000','n',6,0,'90'),(18,'53','1415647456','1600','96000','n',7,0,'60'),(19,'52','1415647509','8000','504000','n',8,0,'63'),(20,'143','1415647553','4500','58500','n',9,0,'13'),(21,'60','1415647609','600','60000','n',10,0,'100'),(22,'142','1415828320','200','120600','n',11,0,'603'),(23,'142','1415893022','80000','28000','n',12,0,'0.35'),(24,'56','1415893152','3500','8750','n',13,0,'2.5'),(25,'59','1415893249','65','845','n',14,0,'13'),(26,'54','1415893294','3600','93600','n',15,0,'26'),(27,'58','1415893353','6000','420000','n',16,0,'70'),(28,'55','1415893403','1200','108000','n',17,0,'90'),(29,'53','1415893436','1600','96000','n',18,0,'60'),(30,'52','1415893475','8000','504000','n',19,0,'63'),(31,'143','1415893512','4500','58500','n',20,0,'13'),(32,'60','1415893563','600','60000','n',21,0,'100'),(33,'142','1416326181','15000','150000','n',22,0,'10'),(34,'56','1416326272','4200','7350','n',23,0,'1.75'),(35,'59','1416326350','85','1020','n',24,0,'12'),(36,'54','1416326482','5000','135000','n',25,0,'27'),(37,'58','1416326549','7500','540000','n',26,0,'72'),(38,'55','1416326612','1400','140000','n',27,0,'100'),(39,'53','1416326664','2000','140000','n',28,0,'70'),(40,'52','1416326710','12000','816000','n',29,0,'68'),(41,'143','1416326762','5000','80000','n',30,0,'16'),(42,'60','1416326800','800','100000','n',31,0,'125'),(43,'115','1416417665','300','300000','n',32,0,'1000'),(44,'146','1416417709','59999','5999999','n',33,0,'100.0016500275'),(45,'45','1416417745','5600','3600000','n',34,0,'642.85714285714'),(46,'125','1416417787','2300000','300000000','n',35,0,'130.4347826087'),(47,'188','1418920219','30','40400','n',36,0,'1346.6666666667');
/*!40000 ALTER TABLE `min_inventario_cola` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_inventario_ueps`
--

DROP TABLE IF EXISTS `min_inventario_ueps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_inventario_ueps` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `costo_total` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usado` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `costo_unidad` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_compra` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_inventario_ueps`
--

LOCK TABLES `min_inventario_ueps` WRITE;
/*!40000 ALTER TABLE `min_inventario_ueps` DISABLE KEYS */;
INSERT INTO `min_inventario_ueps` VALUES (1,'40','1412353942','500','26010','n','52.02',1),(2,'128','1412951928','250','431100','n','1724.4',2),(3,'129','1414007784','6','12000','n','2000',3),(4,'129','1414011786','8','16000','n','2000',4),(5,'59','1414159821','1000','500000','n','500',5),(6,'52','1414159872','1000','450000','n','450',6),(7,'55','1414159958','500','400000','n','800',7),(8,'58','1414160111','1000','100000','n','100',8),(9,'56','1414160147','6000','3000000','n','500',9),(10,'54','1414160195','40000','10000000','n','250',10),(11,'53','1414160234','3000','450000','n','150',11),(12,'142','1415646292','80000','28000','n','0.35',1),(13,'56','1415647163','3500','8750','n','2.5',2),(14,'59','1415647214','65','845','n','13',3),(15,'54','1415647266','3600','93600','n','26',4),(16,'58','1415647358','6000','420000','n','70',5),(17,'55','1415647407','1200','108000','n','90',6),(18,'53','1415647456','1600','96000','n','60',7),(19,'52','1415647509','8000','504000','n','63',8),(20,'143','1415647553','4500','58500','n','13',9),(21,'60','1415647609','600','60000','n','100',10),(22,'142','1415828320','200','120600','n','603',11),(23,'142','1415893022','80000','28000','n','0.35',12),(24,'56','1415893152','3500','8750','n','2.5',13),(25,'59','1415893249','65','845','n','13',14),(26,'54','1415893294','3600','93600','n','26',15),(27,'58','1415893353','6000','420000','n','70',16),(28,'55','1415893403','1200','108000','n','90',17),(29,'53','1415893436','1600','96000','n','60',18),(30,'52','1415893475','8000','504000','n','63',19),(31,'143','1415893512','4500','58500','n','13',20),(32,'60','1415893563','600','60000','n','100',21),(33,'142','1416326181','15000','150000','n','10',22),(34,'56','1416326272','4200','7350','n','1.75',23),(35,'59','1416326350','85','1020','n','12',24),(36,'54','1416326482','5000','135000','n','27',25),(37,'58','1416326549','7500','540000','n','72',26),(38,'55','1416326612','1400','140000','n','100',27),(39,'53','1416326664','2000','140000','n','70',28),(40,'52','1416326710','12000','816000','n','68',29),(41,'143','1416326762','5000','80000','n','16',30),(42,'60','1416326800','800','100000','n','125',31),(43,'115','1416417665','300','300000','n','1000',32),(44,'146','1416417709','59999','5999999','n','100.0016500275',33),(45,'45','1416417745','5600','3600000','n','642.85714285714',34),(46,'125','1416417787','2300000','300000000','n','130.4347826087',35),(47,'188','1418920219','30','40400','n','1346.6666666667',36);
/*!40000 ALTER TABLE `min_inventario_ueps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_productos_servicios`
--

DROP TABLE IF EXISTS `min_productos_servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_productos_servicios` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `eliminado` varchar(16) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_productos_servicios`
--

LOCK TABLES `min_productos_servicios` WRITE;
/*!40000 ALTER TABLE `min_productos_servicios` DISABLE KEYS */;
INSERT INTO `min_productos_servicios` VALUES (1,'Agua.','','','','',1,14,'','1','1000','0','1','no'),(2,'Amina.','','','','',1,13,'','1','1000','0','2','no'),(3,'Cloruro De Metileno.','','','','',1,13,'','1','1000','0','3','no'),(4,'Estaño.','','','','',1,13,'','1','1000','0','4','no'),(5,'Polimérico.','','','','',1,13,'','1','1000','0','5','no'),(6,'Poliol.','','','','',1,13,'','1','1000','0','6','no'),(7,'Silicona.','','','','',1,13,'','1','1000','0','7','no'),(8,'Tdi.','','','','',1,13,'','1','1000','0','8','no'),(9,'Tinta Azul.','','','','',1,13,'','1','1000','0','9','no'),(10,'Tinta Roja','','','','',1,13,'','1','1000','0','10','no'),(11,'Hilo Lup-300','','','','',1,26,'','1','1000','0','11','no'),(12,'Hilo J-46','','','','',1,26,'','1','1000','0','12','no'),(13,'Hilo B-46','','','','',1,26,'','1','1000','0','13','no'),(14,'Hilo B-46','','','','',1,26,'','1','1000','0','14','no'),(15,'Hilo Ny-jj-55','','','','',1,26,'','1','1000','0','15','no'),(16,'Hilo Ny-jj-55','','','','',1,26,'','1','1000','0','16','no'),(17,'Perlón 2,10 Mts.','','','','',1,27,'','1','1000','0','17','no'),(18,'Perlón 2,30 Mts.','','','','',1,27,'','1','1000','0','18','no'),(19,'Perlón 2,40 Mts.','','','','',1,27,'','1','1000','0','19','no'),(20,'Perlón De Aleta','','','','',1,28,'','1','1000','0','20','no'),(21,'Perlón De Aleta','','','','',1,28,'','1','1000','0','21','no'),(22,'Alambre 1,37 (200 Kg)','','','','',1,13,'','1','1000','0','22','no'),(23,'Alambre 2,32 (700 Kg)','','','','',1,13,'','1','1000','0','23','no'),(24,'Alambre 2,50 (700 Kg)','','','','',1,13,'','1','1000','0','24','no'),(25,'Alambre 4,12 X 0,60 (300 Kg)- Cabilla','','','','',1,13,'','1','1000','0','25','no'),(26,'Alambre 3,77 X 2,90 (300 Kg)- Cabilla','','','','',1,13,'','1','1000','0','26','no'),(27,'Alambre 3,77 X 3,30 (300 Kg)- Cabilla','','','','',1,13,'','1','1000','0','27','no'),(28,'Hiladilla','','','','',1,28,'','1','1000','0','28','no'),(29,'Grapas','','','','',1,21,'','1','1000','0','29','no'),(30,'Pega','','','','',1,29,'','1','1000','0','30','no'),(31,'Guata ','','','','',1,10,'','1','1000','0','31','no'),(32,'Telas Silys','','','','',1,10,'','1','1000','0','32','no'),(33,'Tela Eclipse','','','','',1,10,'','1','1000','0','33','no'),(34,'Tela Spring Air','','','','',1,10,'','1','1000','0','34','no'),(35,'Grasa','','','','',1,13,'','1','1000','0','35','no'),(36,'Sisal 1,40 Mts.','','','','',1,28,'','1','1000','0','36','no'),(37,'Sisal 1 Mts.','','','','',1,28,'','1','1000','0','37','no'),(38,'Bolsas Con Impresión 2 X 2 Mts. Silys','','','','',1,30,'','1','1000','0','38','no'),(39,'Bolsas Con Impresión 1,60 Mts. Silys','','','','',1,30,'','1','1000','0','39','no'),(40,'Bolsas Con Impresión 1,40 X 10 Mts. Silys','','','','',1,30,'','1','1000','0','40','no'),(41,'Bolsas Con Impresión 1,40 X 15 Mts. Silys','','','','',1,30,'','1','1000','0','41','no'),(42,'Bolsas Con Impresión 1 X 10 Mts. Silys','','','','',1,30,'','1','1000','0','42','no'),(43,'Bolsas Con Impresión 1 X 15 Mts. Silys','','','','',1,30,'','1','1000','0','43','no'),(44,'Bolsas Con Impresión Cama Cuna Silys','','','','',1,30,'','1','1000','0','44','no'),(45,'Bolsas Con Impresión Cuna Silys','','','','',1,30,'','1','1000','0','45','no'),(46,'Etiqueta Dakota, Con Banderín','','','','',1,30,'','1','1000','0','46','no'),(47,'Etiqueta Kansas, Con Banderín','','','','',1,30,'','1','1000','0','47','no'),(48,'Etiqueta New York, Con Banderín','','','','',1,30,'','1','1000','0','48','no'),(49,'Etiqueta Flamingo, Con Banderín','','','','',1,30,'','1','1000','0','49','no'),(50,'Etiqueta Florida, Con Banderín','','','','',1,30,'','1','1000','0','50','no'),(51,'Etiqueta Para Cama Cuna','','','','',1,30,'','1','1000','0','51','no'),(52,'Etiqueta Para Cuna','','','','',1,30,'','1','1000','0','52','no'),(53,'Etiqueta Para Pillow Top, Con Banderín','','','','',1,30,'','1','1000','0','53','no'),(54,'Etiqueta Florida Box','','','','',1,30,'','1','1000','0','54','no'),(55,'Flamingo Box','','','','',1,30,'','1','1000','0','55','no'),(56,'California, Con Banderín','','','','',1,30,'','1','1000','0','56','no'),(57,'Dakota Box ','','','','',1,30,'','1','1000','0','57','no'),(58,'Bloque Tp 2,26 Mts.','','','','',11,30,'','1','1000','0','58','no'),(59,'Bloque Tp 1,56 Mts.','','','','',11,30,'','1','1000','0','59','no'),(60,'Bloque Tl 2,26.','','','','',11,30,'','1','1000','0','60','no'),(61,'Bloque Tl 1,56 Mts.','','','','',11,30,'','1','1000','0','61','no'),(62,'Peeller 2,33 Mts.','','','','',11,30,'','1','1000','0','62','no'),(63,'Estabilizadores 4,12 Mm X 0,60 Mts','','','','',11,30,'','1','1000','0','63','no'),(64,'Marco 3,77 Mm X 2 Mts.','','','','',11,30,'','1','1000','0','64','no'),(65,'Marco 3,77 Mm X 2,46 Mts.','','','','',11,30,'','1','1000','0','65','no'),(66,'Marco 3,77 Mm X 2,90 Mts','','','','',11,30,'','1','1000','0','66','no'),(67,'Marco 3,77 Mm X 3,30 Mts','','','','',11,30,'','1','1000','0','67','no'),(68,'Resorte 2,32 Mm','','','','',11,30,'','1','1000','0','68','no'),(69,'Resorte 2,50 Mm','','','','',11,30,'','1','1000','0','69','no'),(70,'Armadura 1 Mts.','','','','',11,30,'','1','1000','0','70','no'),(71,'Armadura 1 Mts. Especial.','','','','',11,30,'','1','1000','0','71','no'),(72,'Armadura 1,40 Mts.','','','','',11,30,'','1','1000','0','72','no'),(73,'Armadura 1,40 Mts. Especial.','','','','',11,30,'','1','1000','0','73','no'),(74,'Armadura 1,60 Mts.','','','','',11,30,'','1','1000','0','74','no'),(75,'Armadura 2 X 2 Mts.','','','','',11,30,'','1','1000','0','75','no'),(76,'Armadura Cuna.','','','','',11,30,'','1','1000','0','76','no'),(77,'Armadura Cama Cuna.','','','','',11,30,'','1','1000','0','77','no'),(78,'California Semi-ortopedico 12 AÑos 1,40*1,90','','','','',6,30,'','1','100','0','78','no'),(79,'California Semi-ortopedico 12 AÑos 1,00*1,90','','','','',6,30,'','1','100','0','79','no'),(80,'Flamingo Semi-ortopedico 14 AÑos 1,40*1,90','','','','',6,30,'','1','100','0','80','no'),(81,'Flamingo Semi-ortopedico 14 AÑos 1,00*1,90','','','','',6,30,'','1','100','0','81','no'),(82,'Kansas Ortopedico 17 AÑos 1,40*1,90','','','','',6,30,'','1','100','0','82','no'),(83,'Kansas Ortopedico 17 AÑos 1,00*1,90','','','','',6,30,'','1','100','0','83','no'),(84,'Kansas 1 Tapa Ortopedico 17 AÑos 1,40*1,90','','','','',6,30,'','1','100','0','84','no'),(85,'Kansas 1 Tapa Ortopedico 17 AÑos 1,00*1,90','','','','',6,30,'','1','100','0','85','no'),(86,'Kansas 2 Tapas Ortopedico 17 AÑos 1,40*1,90','','','','',6,30,'','1','100','0','86','no'),(87,'Kansas 2 Tapas Ortopedico 17 AÑos 1,00*1,90','','','','',6,30,'','1','100','0','87','no'),(88,'Dakota Ortopedico 20 AÑos 1,40*1,90','','','','',6,30,'','1','100','0','88','no'),(89,'Dakota Ortopedico 20 AÑos 1,00*1,90','','','','',6,30,'','1','100','0','89','no'),(90,'Dakota 1 Tapa Ortopedico 20 AÑos 1,40*1,90','','','','',6,30,'','1','100','0','90','no'),(91,'Dakota 1 Tapa Ortopedico 20 AÑos 1,00*1,90','','','','',6,30,'','1','100','0','91','no'),(92,'Dakota 2 Tapas Ortopedico 20 AÑos 1,40*1,90','','','','',6,30,'','1','100','0','92','no'),(93,'Dakota 2 Tapas Ortopedico 20 AÑos 1,00*1,90','','','','',6,30,'','1','100','0','93','no'),(94,'Pillow Top Ortopedico 22 AÑos 1,40*1,90','','','','',6,30,'','1','100','0','94','no'),(95,'Pillow Top Ortopedico 22 AÑos 1,00*1,90','','','','',6,30,'','1','100','0','95','no'),(96,'Pillow Top 1 Tapa Ortopedico 22 AÑos 1,40*1,90','','','','',6,30,'','1','100','0','96','no'),(97,'Pillow Top 1 Tapa Ortopedico 22 AÑos 1,00*1,90','','','','',6,30,'','1','100','0','97','no'),(98,'Pillow Top 2 Tapas Ortopedico 22 AÑos 1,40*1,90','','','','',6,30,'','1','100','0','98','no'),(99,'Pillow Top 2 Tapas Ortopedico 22 AÑos 1,00*1,90','','','','',6,30,'','1','100','0','99','no'),(100,'New York 1 Tapa Ortopedico 26 AÑos 1,40*1,90','','','','',6,30,'','1','100','0','100','no'),(101,'New York 1 Tapa Ortopedico 26 AÑos 1,00*1,90','','','','',6,30,'','1','100','0','101','no'),(102,'Florida Semi-ortopedico Acolchado 1,40*1,90','','','','',6,30,'','1','100','0','102','no'),(103,'Florida Semi-ortopedico Acolchado 1,00*1,90','','','','',6,30,'','1','100','0','103','no'),(104,'California Semi-ortopedico Acolchado 1,40*1,90','','','','',6,30,'','1','100','0','104','no'),(105,'California Semi-ortopedico Acolchado 1,00*1,90','','','','',6,30,'','1','100','0','105','no'),(106,'Flamingo Semi-ortopedico Acolchado 1,40*1,90','','','','',6,30,'','1','100','0','106','no'),(107,'Flamingo Semi-ortopedico Acolchado 1,00*1,90','','','','',6,30,'','1','100','0','107','no'),(108,'Kansas Ortopedico Acolchado 1,40*1,90','','','','',6,30,'','1','100','0','108','no'),(109,'Kansas Ortopedico Acolchado 1,00*1,90','','','','',6,30,'','1','100','0','109','no'),(110,'Dakota Ortopedico Acolchado 1,40*1,90','','','','',6,30,'','1','100','0','110','no'),(111,'Dakota Ortopedico Acolchado 1,00*1,90','','','','',6,30,'','1','100','0','111','no'),(112,'Pillow Top Ortopedico Acolchado 1,40*1,90','','','','',6,30,'','1','100','0','112','no'),(113,'Pillow Top Ortopedico Acolchado 1,00*1,90','','','','',6,30,'','1','100','0','113','no'),(114,'Colchon Kansas  17 AÑos  1,60 X 1,90','','','','',6,30,'','1','100','0','114','no'),(115,'Colchon Kansas  17 AÑos  1,60 X 1,90 1 Tpa','','','','',6,30,'','1','100','0','115','no'),(116,'Colchon Kansas  17 AÑos 1,60 X 1,90 2 Tpa','','','','',6,30,'','1','100','0','116','no'),(117,'Colchon Kansas  17 AÑos 2,00 X 2,00 ','','','','',6,30,'','1','100','0','117','no'),(118,'Colchon Kansas  17 AÑos  2,00 X 2,00 1 Tpa','','','','',6,30,'','1','100','0','118','no'),(119,'Colchon Kansas  17 AÑos  2,00 X 2,00 2 Tpa','','','','',6,30,'','1','100','0','119','no'),(120,'Colchon Dakota  20 AÑos  1,60 X 1,90 ','','','','',6,30,'','1','100','0','120','no'),(121,'Colchon Dakota  20 AÑos  1,60 X 1,90 1 Tpa','','','','',6,30,'','1','100','0','121','no'),(122,'Colchon Dakota  20 AÑos  1,60 X 1,90 2 Tpa','','','','',6,30,'','1','100','0','122','no'),(123,'Colchon Dakota  20 AÑos  2,00 X 2,00','','','','',6,30,'','1','100','0','123','no'),(124,'Colchon Dakota 20 AÑos   2,00 X 2,00 1 Tpa','','','','',6,30,'','1','100','0','124','no'),(125,'Colchon Dakota  20 AÑos  2,00 X 2,00 2 Tpa','','','','',6,30,'','1','100','0','125','no'),(126,'Colchon Pillow Top  22 AÑos 1,60 X 1,90 ','','','','',6,30,'','1','100','0','126','no'),(127,'Colchon Pillow Top  22 AÑos  1,60 X 1,90 1 Tpa','','','','',6,30,'','1','100','0','127','no'),(128,'Colchon Pillow Top  22 AÑos  1,60 X 1,90 2 Tpa','','','','',6,30,'','1','100','0','128','no'),(129,'Colchon Pillow Top  22 AÑos 2,00 X 2,00 ','','','','',6,30,'','1','100','0','129','no'),(130,'Colchon Pillow Top  22 AÑos  2,00 X 2,00 1 Tpa','','','','',6,30,'','1','100','0','130','no'),(131,'Colchon Pillow Top 22 AÑos 2,00 X 2,00 2 Tpa  ','','','','',6,30,'','1','100','0','131','no'),(132,'Botas','','','','',3,30,'','1','100','0','132','no'),(133,'Pantalones','','','','',3,30,'','1','100','0','133','no'),(134,'Casco','','','','',3,30,'','1','100','0','134','no'),(135,'Lentes','','','','',3,30,'','1','100','0','135','no'),(136,'Guantes','','','','',3,31,'','1','100','0','136','no'),(137,'Mascarillas','','','','',3,21,'','1','100','0','137','no'),(138,'Chingala','','','','',3,30,'','1','100','0','138','no'),(139,'Peto','','','','',3,30,'','1','100','0','139','no'),(140,'Papel Carta','','','','',8,32,'','1','100','0','140','no'),(141,'Papel Bon','','','','',8,32,'','1','100','0','141','no'),(142,'Lapiceros','','','','',8,21,'','1','100','0','142','no'),(143,'Tirros','','','','',8,21,'','1','100','0','143','no'),(144,'Morroplas','','','','',8,21,'','1','100','0','144','no'),(145,'Grapadoras','','','','',8,30,'','1','100','0','145','no'),(146,'Tornillo 1/2 Pulgada','','','','',9,30,'','1','100','0','146','no'),(147,'Arandela','','','','',9,30,'','1','100','0','147','no'),(148,'Bombillos','','','','',9,21,'','1','100','0','148','no'),(149,'Pintura Blaca','','','','',9,23,'','1','100','0','149','no'),(150,'Rodamientos','','','','',9,30,'','1','100','0','150','no'),(151,'Gasoil','','','','',9,14,'','1','100','0','151','no');
/*!40000 ALTER TABLE `min_productos_servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_requisicion`
--

DROP TABLE IF EXISTS `min_requisicion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_requisicion` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `beneficiario` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_requisicion`
--

LOCK TABLES `min_requisicion` WRITE;
/*!40000 ALTER TABLE `min_requisicion` DISABLE KEYS */;
/*!40000 ALTER TABLE `min_requisicion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_requisicion_etapa`
--

DROP TABLE IF EXISTS `min_requisicion_etapa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_requisicion_etapa` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` int(11) NOT NULL,
  `valoracion` varchar(45) NOT NULL,
  `costo` varchar(45) NOT NULL,
  `unidades` varchar(45) NOT NULL,
  `fecha` varchar(12) NOT NULL,
  `codigo_departamento` varchar(45) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_requisicion_etapa`
--

LOCK TABLES `min_requisicion_etapa` WRITE;
/*!40000 ALTER TABLE `min_requisicion_etapa` DISABLE KEYS */;
INSERT INTO `min_requisicion_etapa` VALUES (1,125,'130.4347826087','0','0','2014-11-19','20'),(2,125,'130.43415879071','2608683.1758142',' 20000 ','2014-11-24','20'),(3,115,'1000','100000',' 100 ','2014-11-24','21'),(4,146,'100.0016500275','100001.6500275',' 1000 ','2014-11-24','21'),(5,45,'642.85714285714','1285714.2857143',' 2000 ','2014-11-24','21'),(6,142,'1.853634085213','3707.268170426',' 2000 ','2014-11-24','15'),(7,56,'1.9000896631228','1900.0896631228',' 1000 ','2014-11-24','15'),(8,59,'12.393939393939','1239.3939393939',' 100 ','2014-11-24','15'),(9,54,'26.877485346512','26877.485346512',' 1000 ','2014-11-24','15'),(10,58,'71.220840607751','213662.52182325',' 3000 ','2014-11-24','15'),(11,53,'69.531290261263','55625.03220901',' 800 ','2014-11-24','15'),(12,52,'67.24768098491','40348.608590946',' 600 ','2014-11-24','15'),(13,143,'14.801130394864','14801.130394864',' 1000 ','2014-11-24','15'),(14,60,'114.44852941176','68669.117647056',' 600 ','2014-11-24','15'),(15,55,'97.196844579352','74744.373481522',' 769 ','2014-11-24','15'),(16,56,'1.9000896631228','1900.0896631228',' 1000 ','2014-11-24','15'),(17,53,'69.531290261263','55625.03220901',' 800 ','2014-11-24','15'),(18,60,'114.44852941176','57224.26470588',' 500 ','2014-11-24','15');
/*!40000 ALTER TABLE `min_requisicion_etapa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_tipo_empresa`
--

DROP TABLE IF EXISTS `min_tipo_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_tipo_empresa` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_tipo_empresa`
--

LOCK TABLES `min_tipo_empresa` WRITE;
/*!40000 ALTER TABLE `min_tipo_empresa` DISABLE KEYS */;
INSERT INTO `min_tipo_empresa` VALUES (1,'producci&oacute;n'),(2,'manufacturera'),(3,'comercializadora'),(5,'servicio');
/*!40000 ALTER TABLE `min_tipo_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_tipo_inventario`
--

DROP TABLE IF EXISTS `min_tipo_inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_tipo_inventario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_tipo_inventario`
--

LOCK TABLES `min_tipo_inventario` WRITE;
/*!40000 ALTER TABLE `min_tipo_inventario` DISABLE KEYS */;
INSERT INTO `min_tipo_inventario` VALUES (1,'Materiales Directos'),(2,'Materiales Indirectos'),(3,'Seguridad Industrial'),(4,'Productos en Proceso'),(6,'Productos Terminados'),(7,'Mercancia'),(8,'Articulo de Oficina'),(9,'Repuesto y Suministro'),(10,'Limpieza'),(11,'Semi Elaborado'),(12,'No Inventariable');
/*!40000 ALTER TABLE `min_tipo_inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_tipo_moneda`
--

DROP TABLE IF EXISTS `min_tipo_moneda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_tipo_moneda` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `simbolo` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_tipo_moneda`
--

LOCK TABLES `min_tipo_moneda` WRITE;
/*!40000 ALTER TABLE `min_tipo_moneda` DISABLE KEYS */;
INSERT INTO `min_tipo_moneda` VALUES (1,'Bolívar','Bs.'),(2,'Dólar','$'),(3,'Euro',' UE'),(5,'Yen','Yen'),(6,'Franco','CHF'),(7,'Libra Esterlina','Libra');
/*!40000 ALTER TABLE `min_tipo_moneda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_tipo_pago`
--

DROP TABLE IF EXISTS `min_tipo_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_tipo_pago` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_tipo_pago`
--

LOCK TABLES `min_tipo_pago` WRITE;
/*!40000 ALTER TABLE `min_tipo_pago` DISABLE KEYS */;
INSERT INTO `min_tipo_pago` VALUES (1,'Crédito '),(2,'Débito'),(3,'Efectivo'),(4,'Cheque');
/*!40000 ALTER TABLE `min_tipo_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_uso_consumo`
--

DROP TABLE IF EXISTS `min_uso_consumo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_uso_consumo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `costo_articulo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `costo_real` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='tabla para el uso consumo';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_uso_consumo`
--

LOCK TABLES `min_uso_consumo` WRITE;
/*!40000 ALTER TABLE `min_uso_consumo` DISABLE KEYS */;
INSERT INTO `min_uso_consumo` VALUES (14,1,1,2,142,' 101 ',' 20 ',' 81 ','2014-11-11','n',1,'0.32619047619048',NULL),(15,1,1,1,56,'  20  ',' 8 ',' 12 ','2014-11-11','n',1,'2.4864864864865',NULL),(16,3,2,6,56,'  2500  ',' 2500 ',' 0 ','2014-11-17','n',1,'2.4864864864865','6216.216216216'),(17,3,2,6,142,'  25000  ',' 25000 ',' 0 ','2014-11-17','n',1,'0.32619047619048','8154,7619047662'),(18,3,2,6,54,'  3200  ',' 3200 ',' 0 ','2014-11-17','n',1,'25.935064935065','82992.207792208'),(19,3,2,6,58,'  1400  ',' 1400 ',' 0 ','2014-11-17','n',1,'69.962779156328','97947.890818859'),(20,3,2,6,55,'  800  ',' 800 ',' 0 ','2014-11-17','n',1,'89.171450737005','71337.160589604'),(21,3,2,4,53,'  1500  ',' 1500 ',' 0 ','2014-11-17','n',1,'59.663716814159','89495.575221239'),(22,3,2,4,52,'  6200  ',' 6200 ',' 0 ','2014-11-17','n',1,'62.430270002477','387067.674015357'),(23,3,2,4,143,'  1250  ',' 1250 ',' 0 ','2014-11-17','n',1,'12.992880613363','16241.100766704'),(24,7,2,3,56,' 125 ',' 125 ',' 0 ','2014-11-17','n',2,'2.4864864864865',NULL),(25,7,2,3,53,' 100 ',' 100 ',' 0 ','2014-11-17','n',2,'59.663716814159',NULL),(26,7,2,3,60,'  80  ',' 80 ',' 0 ','2014-11-17','n',2,'99.375',NULL),(27,1,2,1,142,' 12500 ',' 12500 ',' 0 ','2014-11-19','n',1,'1.853634085213','23170.426065163'),(28,1,2,1,56,' 26 ',' 26 ',' 0 ','2014-11-19','n',1,'1.9000896631228','49.402331241193'),(29,1,2,1,54,' 68 ',' 68 ',' 0 ','2014-11-19','n',1,'26.877485346512','1827.6690035628'),(30,1,2,1,58,' 100 ',' 100 ',' 0 ','2014-11-19','n',1,'71.220840607751','7122.0840607751'),(31,1,2,1,53,' 65 ',' 65 ',' 0 ','2014-11-19','n',1,'69.531290261263','4519.5338669821'),(32,1,2,1,52,' 80 ',' 80 ',' 0 ','2014-11-19','n',1,'67.24768098491','5379.8144787928'),(33,1,2,1,143,' 67 ',' 67 ',' 0 ','2014-11-19','n',1,'14.801130394864','991.67573645589'),(34,1,2,1,55,' 120 ',' 120 ',' 0 ','2014-11-19','n',1,'97.196844579352','11663.621349522'),(35,1,4,2,125,' 19997 ',' 6 ',' 19991 ','2014-11-24','n',4,'130.43415869712','782.60495218272'),(36,2,4,1,115,'  100  ',' 3 ',' 97 ','2014-11-24','n',3,'1000','3000'),(37,2,4,1,146,'  1000  ',' 300 ',' 700 ','2014-11-24','n',3,'100.0016500275','30000.49500825'),(38,2,4,1,45,'  2000  ',' 80 ',' 1920 ','2014-11-24','n',3,'642.85714285714','51428.571428571'),(39,2,1,1,142,' 2000 ',' 20 ',' 1980 ','2014-11-24','n',1,'1.853634085213','37.07268170426'),(40,2,1,1,56,' 2000 ',' 20 ',' 1980 ','2014-11-24','n',1,'1.9000896631228','38.001793262456'),(41,2,1,1,59,'  100  ',' 30 ',' 70 ','2014-11-24','n',1,'12.393939393939','371.81818181817'),(42,2,1,1,54,' 1000 ',' 80 ',' 920 ','2014-11-24','n',1,'26.877485346512','2150.198827721'),(43,2,1,1,58,' 3000 ',' 60 ',' 2940 ','2014-11-24','n',1,'71.220840607751','4273.2504364651'),(44,2,1,1,53,' 1600 ',' 30 ',' 1570 ','2014-11-24','n',1,'69.531290261263','2085.9387078379'),(45,2,1,1,52,' 600 ',' 100 ',' 500 ','2014-11-24','n',1,'67.24768098491','6724.768098491'),(46,2,1,1,143,' 1000 ',' 555 ',' 445 ','2014-11-24','n',1,'14.801130394864','8214.6273691495'),(47,2,1,1,60,' 1100 ',' 20 ',' 1080 ','2014-11-24','n',1,'114.44852941176','2288.9705882352'),(48,2,1,1,55,' 769 ',' 69 ',' 700 ','2014-11-24','n',1,'97.196844579352','6706.5822759753'),(49,6,1,1,56,' 1980 ',' 47 ',' 1933 ','2014-11-24','n',2,'1.9000896631228','89.304214166772'),(50,6,1,1,53,' 1570 ',' 70 ',' 1500 ','2014-11-24','n',2,'69.531290261263','4867.1903182884'),(51,6,1,1,60,' 1080 ',' 27 ',' 1053 ','2014-11-24','n',2,'114.44852941176','3090.1102941175');
/*!40000 ALTER TABLE `min_uso_consumo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_valoracion`
--

DROP TABLE IF EXISTS `min_valoracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_valoracion` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` int(11) NOT NULL,
  `unidades` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `costo_total` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `promedio_actual` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `codigo_producto` (`codigo_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_valoracion`
--

LOCK TABLES `min_valoracion` WRITE;
/*!40000 ALTER TABLE `min_valoracion` DISABLE KEYS */;
INSERT INTO `min_valoracion` VALUES (1,1,'12500','625000.00','50'),(2,2,'5000','60000.00','12'),(3,3,'1250','75000.00','60'),(4,4,'800','96000.00','120'),(5,5,'5400','59400.00','11'),(6,6,'6200','148800.00','24'),(7,7,'4125','268125.00','65'),(8,8,'6540','274680.00','42'),(9,9,'6000','390000.00','65'),(10,10,'4000','336000.00','84'),(11,11,'1000','200.00','0.2'),(12,12,'1500','450.00','0.3'),(13,13,'2000','500.00','0.25'),(14,14,'3000','2250.00','0.75'),(15,15,'4500','4500.00','1'),(16,16,'5000','6250.00','1.25'),(17,17,'1245','2178.75','1.75'),(18,18,'5000','6250.00','1.25'),(19,19,'7500','7500.00','1'),(20,20,'6500','19500.00','3'),(21,21,'4000','8000.00','2'),(22,22,'3000','3750.00','1.25'),(23,23,'3500','7000.00','2'),(24,24,'5000','6000.00','1.2'),(25,25,'7000','21000.00','3'),(26,26,'4000','16000.00','4'),(27,27,'6540','8175.00','1.25'),(28,28,'20000','20000.00','1'),(29,29,'40000','10000.00','0.25'),(30,30,'60','30000.00','500'),(31,31,'1250','1562.50','1.25'),(32,32,'4000','20000.00','5'),(33,33,'4874','8529.50','1.75'),(34,34,'6500','19500.00','3'),(35,35,'9000','11250.00','1.25'),(36,36,'4125','1237.50','0.3'),(37,37,'2000','6000.00','3'),(38,38,'6000','6000.00','1'),(39,39,'7500','9000.00','1.2'),(40,40,'8000','12000.00','1.5'),(41,41,'6000','6000.00','1'),(42,42,'2000','1500.00','0.75'),(43,43,'6000','13800.00','2.3'),(44,44,'4500','7875.00','1.75'),(45,45,'6000','6000.00','1'),(46,46,'5000','6500.00','1.3'),(47,47,'6000','7800.00','1.3'),(48,48,'8000','14000.00','1.75'),(49,49,'1250','300.00','0.24'),(50,50,'4563','3422.25','0.75'),(51,51,'6200','8432.00','1.36'),(52,52,'6500','9100.00','1.4'),(53,53,'6900','8280.00','1.2'),(54,54,'4500','5850.00','1.3'),(55,55,'4000','1000.00','0.25'),(56,56,'6500','6500.00','1'),(57,57,'8000','13200.00','1.65'),(58,58,'50','62500.00','1250'),(59,59,'100','120000.00','1200'),(60,60,'75','97500.00','1300'),(61,61,'20','40000.00','2000'),(62,62,'30','63000.00','2100'),(63,63,'1000','2500.00','2.5'),(64,64,'2000','3500.00','1.75'),(65,65,'5000','9250.00','1.85'),(66,66,'6000','7800.00','1.3'),(67,67,'1200','6000.00','5'),(68,68,'9000','40500.00','4.5'),(69,69,'10000','60000.00','6'),(70,70,'2412','3015000.00','1250'),(71,71,'400','600000.00','1500'),(72,72,'500','680000.00','1360'),(73,73,'60','84000.00','1400'),(74,74,'75','101250.00','1350'),(75,75,'60','72600.00','1210'),(76,76,'40','52800.00','1320'),(77,77,'70','77000.00','1100'),(78,78,'30','150000.00','5000'),(79,79,'30','165000.00','5500'),(80,80,'30','156000.00','5200'),(81,81,'30','153000.00','5100'),(82,82,'30','186000.00','6200'),(83,83,'30','123000.00','4100'),(84,84,'30','120000.00','4000'),(85,85,'30','180000.00','6000'),(86,86,'30','210000.00','7000'),(87,87,'30','90000.00','3000'),(88,88,'30','240000.00','8000'),(89,89,'30','300000.00','10000'),(90,90,'30','243000.00','8100'),(91,91,'30','195000.00','6500'),(92,92,'30','228000.00','7600'),(93,93,'30','240000.00','8000'),(94,94,'30','300000.00','10000'),(95,95,'30','330000.00','11000'),(96,96,'30','183600.00','6120'),(97,97,'30','195000.00','6500'),(98,98,'30','120000.00','4000'),(99,99,'30','180000.00','6000'),(100,100,'30','225000.00','7500'),(101,101,'30','216000.00','7200'),(102,102,'30','189000.00','6300'),(103,103,'30','222000.00','7400'),(104,104,'30','180000.00','6000'),(105,105,'30','222000.00','7400'),(106,106,'30','369000.00','12300'),(107,107,'30','120000.00','4000'),(108,108,'30','225000.00','7500'),(109,109,'30','195000.00','6500'),(110,110,'30','222000.00','7400'),(111,111,'30','216000.00','7200'),(112,112,'30','180000.00','6000'),(113,113,'30','150000.00','5000'),(114,114,'30','165000.00','5500'),(115,115,'30','162000.00','5400'),(116,116,'30','168000.00','5600'),(117,117,'30','222000.00','7400'),(118,118,'30','180000.00','6000'),(119,119,'30','225000.00','7500'),(120,120,'30','186000.00','6200'),(121,121,'30','189000.00','6300'),(122,122,'30','126000.00','4200'),(123,123,'30','240000.00','8000'),(124,124,'30','270000.00','9000'),(125,125,'30','300000.00','10000'),(126,126,'30','330000.00','11000'),(127,127,'30','216000.00','7200'),(128,128,'30','186000.00','6200'),(129,129,'30','222000.00','7400'),(130,130,'30','216300.00','7210'),(131,131,'30','207000.00','6900'),(132,132,'200','360000.00','1800'),(133,133,'600','840000.00','1400'),(134,134,'100','25000.00','250'),(135,135,'50','7500.00','150'),(136,136,'600','30000.00','50'),(137,137,'60','60000.00','1000'),(138,138,'20','10000.00','500'),(139,139,'45','54000.00','1200'),(140,140,'35','14000.00','400'),(141,141,'50','22500.00','450'),(142,142,'40','2000.00','50'),(143,143,'2','1000.00','500'),(144,144,'6','600.00','100'),(145,145,'10','2500.00','250'),(146,146,'500','125.00','0.25'),(147,147,'1000','750.00','0.75'),(148,148,'20','24000.00','1200'),(149,149,'3','1800.00','600'),(150,150,'20','2500.00','125'),(151,151,'1000','90.00','0.09');
/*!40000 ALTER TABLE `min_valoracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_valoracion_backup`
--

DROP TABLE IF EXISTS `min_valoracion_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_valoracion_backup` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` varchar(45) NOT NULL,
  `unidades` varchar(45) NOT NULL,
  `costo_total` varchar(45) NOT NULL,
  `promedio_actual` varchar(200) NOT NULL,
  `fecha` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=693 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_valoracion_backup`
--

LOCK TABLES `min_valoracion_backup` WRITE;
/*!40000 ALTER TABLE `min_valoracion_backup` DISABLE KEYS */;
INSERT INTO `min_valoracion_backup` VALUES (1,'1','0','0','0','2014-11-10'),(2,'2','0','0','0','2014-11-10'),(3,'3','0','0','0','2014-11-10'),(4,'4','0','0','0','2014-11-10'),(5,'5','0','0','0','2014-11-10'),(6,'6','0','0','0','2014-11-10'),(7,'7','0','0','0','2014-11-10'),(8,'8','0','0','0','2014-11-10'),(9,'9','0','0','0','2014-11-10'),(10,'10','0','0','0','2014-11-10'),(11,'11','0','0','0','2014-11-10'),(12,'12','0','0','0','2014-11-10'),(13,'13','0','0','0','2014-11-10'),(14,'14','0','0','0','2014-11-10'),(15,'15','0','0','0','2014-11-10'),(16,'16','0','0','0','2014-11-10'),(17,'17','0','0','0','2014-11-10'),(18,'18','0','0','0','2014-11-10'),(19,'19','0','0','0','2014-11-10'),(20,'20','0','0','0','2014-11-10'),(21,'21','0','0','0','2014-11-10'),(22,'22','0','0','0','2014-11-10'),(23,'23','0','0','0','2014-11-10'),(24,'24','0','0','0','2014-11-10'),(25,'25','0','0','0','2014-11-10'),(26,'26','0','0','0','2014-11-10'),(27,'27','0','0','0','2014-11-10'),(28,'28','0','0','0','2014-11-10'),(29,'29','0','0','0','2014-11-10'),(30,'30','0','0','0','2014-11-10'),(31,'31','0','0','0','2014-11-10'),(32,'32','0','0','0','2014-11-10'),(33,'33','0','0','0','2014-11-10'),(34,'34','0','0','0','2014-11-10'),(35,'35','0','0','0','2014-11-10'),(36,'36','0','0','0','2014-11-10'),(37,'37','0','0','0','2014-11-10'),(38,'38','0','0','0','2014-11-10'),(39,'39','0','0','0','2014-11-10'),(40,'40','0','0','0','2014-11-10'),(41,'41','0','0','0','2014-11-10'),(42,'42','0','0','0','2014-11-10'),(43,'43','0','0','0','2014-11-10'),(44,'44','0','0','0','2014-11-10'),(45,'45','0','0','0','2014-11-10'),(46,'46','0','0','0','2014-11-10'),(47,'47','0','0','0','2014-11-10'),(48,'48','0','0','0','2014-11-10'),(49,'49','0','0','0','2014-11-10'),(50,'50','0','0','0','2014-11-10'),(51,'51','0','0','0','2014-11-10'),(52,'52','74','4588','62','2014-11-10'),(53,'53','95','5130',' 54','2014-11-10'),(54,'54','250',' 6250','25','2014-11-10'),(55,'55','89','6942','78','2014-11-10'),(56,'56','200',' 450','2.25','2014-11-10'),(57,'57','0','0','0','2014-11-10'),(58,'58','45',' 2925','65','2014-11-10'),(59,'59','15','180','12','2014-11-10'),(60,'60','40','3600','90','2014-11-10'),(61,'61','0','0','0','2014-11-10'),(62,'62','0','0','0','2014-11-10'),(63,'63','0','0','0','2014-11-10'),(64,'64','0','0','0','2014-11-10'),(65,'65','0','0','0','2014-11-10'),(66,'66','0','0','0','2014-11-10'),(67,'67','0','0','0','2014-11-10'),(68,'68','0','0','0','2014-11-10'),(69,'69','0','0','0','2014-11-10'),(70,'70','0','0','0','2014-11-10'),(71,'71','0','0','0','2014-11-10'),(72,'72','0','0','0','2014-11-10'),(73,'73','0','0','0','2014-11-10'),(74,'74','0','0','0','2014-11-10'),(75,'75','0','0','0','2014-11-10'),(76,'76','0','0','0','2014-11-10'),(77,'77','0','0','0','2014-11-10'),(78,'78','0','0','0','2014-11-10'),(79,'79','0','0','0','2014-11-10'),(80,'80','0','0','0','2014-11-10'),(81,'81','0','0','0','2014-11-10'),(82,'82','0','0','0','2014-11-10'),(83,'83','0','0','0','2014-11-10'),(84,'84','0','0','0','2014-11-10'),(85,'85','0','0','0','2014-11-10'),(86,'86','0','0','0','2014-11-10'),(87,'87','0','0','0','2014-11-10'),(88,'88','0','0','0','2014-11-10'),(89,'89','0','0','0','2014-11-10'),(90,'90','0','0','0','2014-11-10'),(91,'91','0','0','0','2014-11-10'),(92,'92','0','0','0','2014-11-10'),(93,'93','0','0','0','2014-11-10'),(94,'94','0','0','0','2014-11-10'),(95,'95','0','0','0','2014-11-10'),(96,'96','0','0','0','2014-11-10'),(97,'97','0','0','0','2014-11-10'),(98,'98','0','0','0','2014-11-10'),(99,'99','0','0','0','2014-11-10'),(100,'100','0','0','0','2014-11-10'),(101,'101','0','0','0','2014-11-10'),(102,'102','0','0','0','2014-11-10'),(103,'103','0','0','0','2014-11-10'),(104,'104','0','0','0','2014-11-10'),(105,'105','0','0','0','2014-11-10'),(106,'106','0','0','0','2014-11-10'),(107,'107','0','0','0','2014-11-10'),(108,'108','0','0','0','2014-11-10'),(109,'109','0','0','0','2014-11-10'),(110,'110','0','0','0','2014-11-10'),(111,'111','0','0','0','2014-11-10'),(112,'112','0','0','0','2014-11-10'),(113,'113','0','0','0','2014-11-10'),(114,'114','0','0','0','2014-11-10'),(115,'115','0','0','0','2014-11-10'),(116,'116','0','0','0','2014-11-10'),(117,'117','0','0','0','2014-11-10'),(118,'118','0','0','0','2014-11-10'),(119,'119','0','0','0','2014-11-10'),(120,'120','0','0','0','2014-11-10'),(121,'121','0','0','0','2014-11-10'),(122,'122','0','0','0','2014-11-10'),(123,'123','0','0','0','2014-11-10'),(124,'124','0','0','0','2014-11-10'),(125,'125','0','0','0','2014-11-10'),(126,'126','0','0','0','2014-11-10'),(127,'127','0','0','0','2014-11-10'),(128,'131','1','0','0','2014-11-10'),(129,'132','1','0','0','2014-11-10'),(130,'133','0','0','0','2014-11-10'),(131,'134','0','0','0','2014-11-10'),(132,'135','0','0','0','2014-11-10'),(133,'136','0','0','0','2014-11-10'),(134,'137','1','0','0','2014-11-10'),(135,'138','1','0','0','2014-11-10'),(136,'139','1','0','0','2014-11-10'),(137,'140','1','0','0','2014-11-10'),(138,'141','1','0','0','2014-11-10'),(139,'142','25000','6250','0.25','2014-11-10'),(140,'143','65','812.5',' 12.5','2014-11-10'),(509,'1','0','0','0','2014-12-02'),(510,'2','0','0','0','2014-12-02'),(511,'3','0','0','0','2014-12-02'),(512,'4','0','0','0','2014-12-02'),(513,'5','0','0','0','2014-12-02'),(514,'6','0','0','0','2014-12-02'),(515,'7','0','0','0','2014-12-02'),(516,'8','0','0','0','2014-12-02'),(517,'9','0','0','0','2014-12-02'),(518,'10','0','0','0','2014-12-02'),(519,'11','0','0','0','2014-12-02'),(520,'12','0','0','0','2014-12-02'),(521,'13','0','0','0','2014-12-02'),(522,'14','0','0','0','2014-12-02'),(523,'15','0','0','0','2014-12-02'),(524,'16','0','0','0','2014-12-02'),(525,'17','0','0','0','2014-12-02'),(526,'18','0','0','0','2014-12-02'),(527,'19','0','0','0','2014-12-02'),(528,'20','0','0','0','2014-12-02'),(529,'21','0','0','0','2014-12-02'),(530,'22','0','0','0','2014-12-02'),(531,'23','0','0','0','2014-12-02'),(532,'24','0','0','0','2014-12-02'),(533,'25','0','0','0','2014-12-02'),(534,'26','0','0','0','2014-12-02'),(535,'27','0','0','0','2014-12-02'),(536,'28','0','0','0','2014-12-02'),(537,'29','0','0','0','2014-12-02'),(538,'30','0','0','0','2014-12-02'),(539,'31','0','0','0','2014-12-02'),(540,'32','0','0','0','2014-12-02'),(541,'33','0','0','0','2014-12-02'),(542,'34','0','0','0','2014-12-02'),(543,'35','0','0','0','2014-12-02'),(544,'36','0','0','0','2014-12-02'),(545,'37','0','0','0','2014-12-02'),(546,'38','0','0','0','2014-12-02'),(547,'39','0','0','0','2014-12-02'),(548,'40','0','0','0','2014-12-02'),(549,'41','0','0','0','2014-12-02'),(550,'42','0','0','0','2014-12-02'),(551,'43','0','0','0','2014-12-02'),(552,'44','0','0','0','2014-12-02'),(553,'45','3600','2314285.7142857','642.85714285714','2014-12-02'),(554,'46','0','0','0','2014-12-02'),(555,'47','0','0','0','2014-12-02'),(556,'48','0','0','0','2014-12-02'),(557,'49','0','0','0','2014-12-02'),(558,'50','0','0','0','2014-12-02'),(559,'51','0','0','0','2014-12-02'),(560,'52','13194','887265.9029149','67.24768098491','2014-12-02'),(561,'53','430','29898.45481235','69.531290261263','2014-12-02'),(562,'54','4582','123152.63785772','26.877485346512','2014-12-02'),(563,'55','1000','97196.844579358','97.196844579352','2014-12-02'),(564,'56','3249','6173.3913154862','1.9000896631228','2014-12-02'),(565,'57','0','0','0','2014-12-02'),(566,'58','9045','644192.50329711','71.220840607751','2014-12-02'),(567,'59','65','805.6060606061','12.393939393939','2014-12-02'),(568,'60','260','29756.617647064','114.44852941176','2014-12-02'),(569,'61','0','0','0','2014-12-02'),(570,'62','0','0','0','2014-12-02'),(571,'63','0','0','0','2014-12-02'),(572,'64','0','0','0','2014-12-02'),(573,'65','0','0','0','2014-12-02'),(574,'66','0','0','0','2014-12-02'),(575,'67','0','0','0','2014-12-02'),(576,'68','0','0','0','2014-12-02'),(577,'69','0','0','0','2014-12-02'),(578,'70','0','0','0','2014-12-02'),(579,'71','0','0','0','2014-12-02'),(580,'72','0','0','0','2014-12-02'),(581,'73','0','0','0','2014-12-02'),(582,'74','0','0','0','2014-12-02'),(583,'75','0','0','0','2014-12-02'),(584,'76','0','0','0','2014-12-02'),(585,'77','0','0','0','2014-12-02'),(586,'78','0','0','0','2014-12-02'),(587,'79','0','0','0','2014-12-02'),(588,'80','0','0','0','2014-12-02'),(589,'81','0','0','0','2014-12-02'),(590,'82','0','0','0','2014-12-02'),(591,'83','0','0','0','2014-12-02'),(592,'84','0','0','0','2014-12-02'),(593,'85','0','0','0','2014-12-02'),(594,'86','0','0','0','2014-12-02'),(595,'87','0','0','0','2014-12-02'),(596,'88','0','0','0','2014-12-02'),(597,'89','0','0','0','2014-12-02'),(598,'90','0','0','0','2014-12-02'),(599,'91','0','0','0','2014-12-02'),(600,'92','0','0','0','2014-12-02'),(601,'93','0','0','0','2014-12-02'),(602,'94','0','0','0','2014-12-02'),(603,'95','0','0','0','2014-12-02'),(604,'96','0','0','0','2014-12-02'),(605,'97','0','0','0','2014-12-02'),(606,'98','0','0','0','2014-12-02'),(607,'99','0','0','0','2014-12-02'),(608,'100','0','0','0','2014-12-02'),(609,'101','0','0','0','2014-12-02'),(610,'102','0','0','0','2014-12-02'),(611,'103','0','0','0','2014-12-02'),(612,'104','0','0','0','2014-12-02'),(613,'105','0','0','0','2014-12-02'),(614,'106','0','0','0','2014-12-02'),(615,'107','0','0','0','2014-12-02'),(616,'108','0','0','0','2014-12-02'),(617,'109','0','0','0','2014-12-02'),(618,'110','0','0','0','2014-12-02'),(619,'111','0','0','0','2014-12-02'),(620,'112','0','0','0','2014-12-02'),(621,'113','0','0','0','2014-12-02'),(622,'114','0','0','0','2014-12-02'),(623,'115','200','200000','1000','2014-12-02'),(624,'116','0','0','0','2014-12-02'),(625,'117','0','0','0','2014-12-02'),(626,'118','0','0','0','2014-12-02'),(627,'119','0','0','0','2014-12-02'),(628,'120','0','0','0','2014-12-02'),(629,'121','0','0','0','2014-12-02'),(630,'122','0','0','0','2014-12-02'),(631,'123','0','0','0','2014-12-02'),(632,'124','0','0','0','2014-12-02'),(633,'125','2280002','297390142.91113','130.43415879071','2014-12-02'),(634,'126','0','0','0','2014-12-02'),(635,'127','0','0','0','2014-12-02'),(636,'131','1','0','0','2014-12-02'),(637,'132','1','0','0','2014-12-02'),(638,'133','0','0','0','2014-12-02'),(639,'134','0','0','0','2014-12-02'),(640,'135','0','0','0','2014-12-02'),(641,'136','0','0','0','2014-12-02'),(642,'137','1','0','0','2014-12-02'),(643,'138','1','0','0','2014-12-02'),(644,'139','1','0','0','2014-12-02'),(645,'140','1','0','0','2014-12-02'),(646,'141','1','0','0','2014-12-02'),(647,'142','80500','149217.54385964','1.853634085213','2014-12-02'),(648,'143','7248','107278.59310198','14.801130394864','2014-12-02'),(649,'144','257','3000','11.673151750973','2014-12-02'),(650,'145','0','0','1','2014-12-02'),(651,'146','58999','5899997.3499725','100.0016500275','2014-12-02'),(652,'147','0','0','1','2014-12-02'),(653,'148','0','0','1','2014-12-02'),(654,'149','0','0','1','2014-12-02'),(655,'150','0','0','1','2014-12-02'),(656,'151','0','0','1','2014-12-02'),(657,'152','0','0','1','2014-12-02'),(658,'153','0','0','1','2014-12-02'),(659,'154','0','0','1','2014-12-02'),(660,'155','0','0','1','2014-12-02'),(661,'156','0','0','1','2014-12-02'),(662,'157','0','0','1','2014-12-02'),(663,'158','0','0','1','2014-12-02'),(664,'159','0','0','1','2014-12-02'),(665,'160','0','0','1','2014-12-02'),(666,'161','0','0','1','2014-12-02'),(667,'162','0','0','1','2014-12-02'),(668,'163','0','0','1','2014-12-02'),(669,'164','0','0','1','2014-12-02'),(670,'165','0','0','1','2014-12-02'),(671,'166','0','0','1','2014-12-02'),(672,'167','0','0','1','2014-12-02'),(673,'168','0','0','1','2014-12-02'),(674,'169','0','0','1','2014-12-02'),(675,'170','0','0','1','2014-12-02'),(676,'171','0','0','1','2014-12-02'),(677,'172','0','0','1','2014-12-02'),(678,'173','0','0','1','2014-12-02'),(679,'174','0','0','1','2014-12-02'),(680,'175','0','0','1','2014-12-02'),(681,'176','0','0','1','2014-12-02'),(682,'177','0','0','1','2014-12-02'),(683,'178','0','0','1','2014-12-02'),(684,'179','0','0','1','2014-12-02'),(685,'180','0','0','1','2014-12-02'),(686,'181','0','0','1','2014-12-02'),(687,'182','0','0','1','2014-12-02'),(688,'183','0','0','1','2014-12-02'),(689,'184','0','0','1','2014-12-02'),(690,'185','0','500','','2014-12-02'),(691,'186','0','0','1','2014-12-02'),(692,'187','0','0','1','2014-12-02');
/*!40000 ALTER TABLE `min_valoracion_backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_valoracion_historico`
--

DROP TABLE IF EXISTS `min_valoracion_historico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_valoracion_historico` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` int(11) NOT NULL,
  `unidades` varchar(50) NOT NULL,
  `costo_total` varchar(50) NOT NULL,
  `promedio_actual` varchar(50) NOT NULL,
  `fecha` varchar(12) NOT NULL,
  `eliminado` varchar(12) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_valoracion_historico`
--

LOCK TABLES `min_valoracion_historico` WRITE;
/*!40000 ALTER TABLE `min_valoracion_historico` DISABLE KEYS */;
INSERT INTO `min_valoracion_historico` VALUES (1,1,'12500','625000.00','50','2014-12-22','no'),(2,2,'5000','60000.00','12','2014-12-22','no'),(3,3,'1250','75000.00','60','2014-12-22','no'),(4,4,'800','96000.00','120','2014-12-22','no'),(5,5,'5400','59400.00','11','2014-12-22','no'),(6,6,'6200','148800.00','24','2014-12-22','no'),(7,7,'4125','268125.00','65','2014-12-22','no'),(8,8,'6540','274680.00','42','2014-12-22','no'),(9,9,'6000','390000.00','65','2014-12-22','no'),(10,10,'4000','336000.00','84','2014-12-22','no'),(11,11,'1000','200.00','0.2','2014-12-22','no'),(12,12,'1500','450.00','0.3','2014-12-22','no'),(13,13,'2000','500.00','0.25','2014-12-22','no'),(14,14,'3000','2250.00','0.75','2014-12-22','no'),(15,15,'4500','4500.00','1','2014-12-22','no'),(16,16,'5000','6250.00','1.25','2014-12-22','no'),(17,17,'1245','2178.75','1.75','2014-12-22','no'),(18,18,'5000','6250.00','1.25','2014-12-22','no'),(19,19,'7500','7500.00','1','2014-12-22','no'),(20,20,'6500','19500.00','3','2014-12-22','no'),(21,21,'4000','8000.00','2','2014-12-22','no'),(22,22,'3000','3750.00','1.25','2014-12-22','no'),(23,23,'3500','7000.00','2','2014-12-22','no'),(24,24,'5000','6000.00','1.2','2014-12-22','no'),(25,25,'7000','21000.00','3','2014-12-22','no'),(26,26,'4000','16000.00','4','2014-12-22','no'),(27,27,'6540','8175.00','1.25','2014-12-22','no'),(28,28,'20000','20000.00','1','2014-12-22','no'),(29,29,'40000','10000.00','0.25','2014-12-22','no'),(30,30,'60','30000.00','500','2014-12-22','no'),(31,31,'1250','1562.50','1.25','2014-12-22','no'),(32,32,'4000','20000.00','5','2014-12-22','no'),(33,33,'4874','8529.50','1.75','2014-12-22','no'),(34,34,'6500','19500.00','3','2014-12-22','no'),(35,35,'9000','11250.00','1.25','2014-12-22','no'),(36,36,'4125','1237.50','0.3','2014-12-22','no'),(37,37,'2000','6000.00','3','2014-12-22','no'),(38,38,'6000','6000.00','1','2014-12-22','no'),(39,39,'7500','9000.00','1.2','2014-12-22','no'),(40,40,'8000','12000.00','1.5','2014-12-22','no'),(41,41,'6000','6000.00','1','2014-12-22','no'),(42,42,'2000','1500.00','0.75','2014-12-22','no'),(43,43,'6000','13800.00','2.3','2014-12-22','no'),(44,44,'4500','7875.00','1.75','2014-12-22','no'),(45,45,'6000','6000.00','1','2014-12-22','no'),(46,46,'5000','6500.00','1.3','2014-12-22','no'),(47,47,'6000','7800.00','1.3','2014-12-22','no'),(48,48,'8000','14000.00','1.75','2014-12-22','no'),(49,49,'1250','300.00','0.24','2014-12-22','no'),(50,50,'4563','3422.25','0.75','2014-12-22','no'),(51,51,'6200','8432.00','1.36','2014-12-22','no'),(52,52,'6500','9100.00','1.4','2014-12-22','no'),(53,53,'6900','8280.00','1.2','2014-12-22','no'),(54,54,'4500','5850.00','1.3','2014-12-22','no'),(55,55,'4000','1000.00','0.25','2014-12-22','no'),(56,56,'6500','6500.00','1','2014-12-22','no'),(57,57,'8000','13200.00','1.65','2014-12-22','no'),(58,58,'50','62500.00','1250','2014-12-22','no'),(59,59,'100','120000.00','1200','2014-12-22','no'),(60,60,'75','97500.00','1300','2014-12-22','no'),(61,61,'20','40000.00','2000','2014-12-22','no'),(62,62,'30','63000.00','2100','2014-12-22','no'),(63,63,'1000','2500.00','2.5','2014-12-22','no'),(64,64,'2000','3500.00','1.75','2014-12-22','no'),(65,65,'5000','9250.00','1.85','2014-12-22','no'),(66,66,'6000','7800.00','1.3','2014-12-22','no'),(67,67,'1200','6000.00','5','2014-12-22','no'),(68,68,'9000','40500.00','4.5','2014-12-22','no'),(69,69,'10000','60000.00','6','2014-12-22','no'),(70,70,'2412','3015000.00','1250','2014-12-22','no'),(71,71,'400','600000.00','1500','2014-12-22','no'),(72,72,'500','680000.00','1360','2014-12-22','no'),(73,73,'60','84000.00','1400','2014-12-22','no'),(74,74,'75','101250.00','1350','2014-12-22','no'),(75,75,'60','72600.00','1210','2014-12-22','no'),(76,76,'40','52800.00','1320','2014-12-22','no'),(77,77,'70','77000.00','1100','2014-12-22','no'),(78,78,'30','150000.00','5000','2014-12-22','no'),(79,79,'30','165000.00','5500','2014-12-22','no'),(80,80,'30','156000.00','5200','2014-12-22','no'),(81,81,'30','153000.00','5100','2014-12-22','no'),(82,82,'30','186000.00','6200','2014-12-22','no'),(83,83,'30','123000.00','4100','2014-12-22','no'),(84,84,'30','120000.00','4000','2014-12-22','no'),(85,85,'30','180000.00','6000','2014-12-22','no'),(86,86,'30','210000.00','7000','2014-12-22','no'),(87,87,'30','90000.00','3000','2014-12-22','no'),(88,88,'30','240000.00','8000','2014-12-22','no'),(89,89,'30','300000.00','10000','2014-12-22','no'),(90,90,'30','243000.00','8100','2014-12-22','no'),(91,91,'30','195000.00','6500','2014-12-22','no'),(92,92,'30','228000.00','7600','2014-12-22','no'),(93,93,'30','240000.00','8000','2014-12-22','no'),(94,94,'30','300000.00','10000','2014-12-22','no'),(95,95,'30','330000.00','11000','2014-12-22','no'),(96,96,'30','183600.00','6120','2014-12-22','no'),(97,97,'30','195000.00','6500','2014-12-22','no'),(98,98,'30','120000.00','4000','2014-12-22','no'),(99,99,'30','180000.00','6000','2014-12-22','no'),(100,100,'30','225000.00','7500','2014-12-22','no'),(101,101,'30','216000.00','7200','2014-12-22','no'),(102,102,'30','189000.00','6300','2014-12-22','no'),(103,103,'30','222000.00','7400','2014-12-22','no'),(104,104,'30','180000.00','6000','2014-12-22','no'),(105,105,'30','222000.00','7400','2014-12-22','no'),(106,106,'30','369000.00','12300','2014-12-22','no'),(107,107,'30','120000.00','4000','2014-12-22','no'),(108,108,'30','225000.00','7500','2014-12-22','no'),(109,109,'30','195000.00','6500','2014-12-22','no'),(110,110,'30','222000.00','7400','2014-12-22','no'),(111,111,'30','216000.00','7200','2014-12-22','no'),(112,112,'30','180000.00','6000','2014-12-22','no'),(113,113,'30','150000.00','5000','2014-12-22','no'),(114,114,'30','165000.00','5500','2014-12-22','no'),(115,115,'30','162000.00','5400','2014-12-22','no'),(116,116,'30','168000.00','5600','2014-12-22','no'),(117,117,'30','222000.00','7400','2014-12-22','no'),(118,118,'30','180000.00','6000','2014-12-22','no'),(119,119,'30','225000.00','7500','2014-12-22','no'),(120,120,'30','186000.00','6200','2014-12-22','no'),(121,121,'30','189000.00','6300','2014-12-22','no'),(122,122,'30','126000.00','4200','2014-12-22','no'),(123,123,'30','240000.00','8000','2014-12-22','no'),(124,124,'30','270000.00','9000','2014-12-22','no'),(125,125,'30','300000.00','10000','2014-12-22','no'),(126,126,'30','330000.00','11000','2014-12-22','no'),(127,127,'30','216000.00','7200','2014-12-22','no'),(128,128,'30','186000.00','6200','2014-12-22','no'),(129,129,'30','222000.00','7400','2014-12-22','no'),(130,130,'30','216300.00','7210','2014-12-22','no'),(131,131,'30','207000.00','6900','2014-12-22','no'),(132,132,'200','360000.00','1800','2014-12-22','no'),(133,133,'600','840000.00','1400','2014-12-22','no'),(134,134,'100','25000.00','250','2014-12-22','no'),(135,135,'50','7500.00','150','2014-12-22','no'),(136,136,'600','30000.00','50','2014-12-22','no'),(137,137,'60','60000.00','1000','2014-12-22','no'),(138,138,'20','10000.00','500','2014-12-22','no'),(139,139,'45','54000.00','1200','2014-12-22','no'),(140,140,'35','14000.00','400','2014-12-22','no'),(141,141,'50','22500.00','450','2014-12-22','no'),(142,142,'40','2000.00','50','2014-12-22','no'),(143,143,'2','1000.00','500','2014-12-22','no'),(144,144,'6','600.00','100','2014-12-22','no'),(145,145,'10','2500.00','250','2014-12-22','no'),(146,146,'500','125.00','0.25','2014-12-22','no'),(147,147,'1000','750.00','0.75','2014-12-22','no'),(148,148,'20','24000.00','1200','2014-12-22','no'),(149,149,'3','1800.00','600','2014-12-22','no'),(150,150,'20','2500.00','125','2014-12-22','no'),(151,151,'1000','90.00','0.09','2014-12-22','no');
/*!40000 ALTER TABLE `min_valoracion_historico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_valoracion_produccion`
--

DROP TABLE IF EXISTS `min_valoracion_produccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_valoracion_produccion` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` int(11) NOT NULL,
  `codigo_departamento` int(11) NOT NULL,
  `unidades` varchar(45) NOT NULL,
  `costo_total` varchar(45) NOT NULL,
  `promedio_actual` varchar(45) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_valoracion_produccion`
--

LOCK TABLES `min_valoracion_produccion` WRITE;
/*!40000 ALTER TABLE `min_valoracion_produccion` DISABLE KEYS */;
INSERT INTO `min_valoracion_produccion` VALUES (12,142,15,'1980','3670.1954887217','1.853634085213'),(13,56,15,'1933','3672.8733188163','1.9000896631228'),(14,54,15,'920','24727.286518791','26.877485346512'),(15,58,15,'2940','209389.27138678','71.220840607751'),(16,55,15,'700','68037.791205547','97.196844579352'),(17,53,15,'1500','104296.93539189','69.531290261263'),(18,52,15,'500','33623.840492455','67.24768098491'),(19,143,15,'445','6586.5030257145','14.801130394864'),(20,60,15,'1053','120514.30147058','114.44852941176'),(21,125,20,'19991','2607509.2665142','130.43415869712'),(22,115,21,'97','97000','1000'),(23,146,21,'700','70001.15501925','100.0016500275'),(24,45,21,'1920','1234285.7142857','642.85714285714'),(25,59,15,'70','867.57575757573','12.393939393939');
/*!40000 ALTER TABLE `min_valoracion_produccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_valoracion_produccion_historico`
--

DROP TABLE IF EXISTS `min_valoracion_produccion_historico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_valoracion_produccion_historico` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` int(11) NOT NULL,
  `codigo_departamento` int(11) NOT NULL,
  `unidades` varchar(45) NOT NULL,
  `costo_total` varchar(45) NOT NULL,
  `promedio_actual` varchar(45) NOT NULL,
  `fecha` varchar(12) NOT NULL,
  `eliminado` varchar(2) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_valoracion_produccion_historico`
--

LOCK TABLES `min_valoracion_produccion_historico` WRITE;
/*!40000 ALTER TABLE `min_valoracion_produccion_historico` DISABLE KEYS */;
INSERT INTO `min_valoracion_produccion_historico` VALUES (1,142,15,' 100 ','32.619047619048','0.32619047619048','2014-11-11','no'),(2,142,15,' 1 ','0.32619047619048','0.32619047619048','2014-11-11','no'),(3,142,15,' 100 ','32.619047619048','0.32619047619048','2014-11-11','no'),(4,56,15,' 20 ','49.72972972973','2.4864864864865','2014-11-11','no'),(5,142,0,'81','26.421428571428','0.32619047619048','2014-11-11','no'),(6,142,0,'61','19.897619047618','0.32619047619048','2014-11-11','no'),(7,56,0,'12','29.837837837838','2.4864864864865','2014-11-11','no'),(8,142,15,' 25000 ','8154.761904762','0.32619047619048','2014-11-13','no'),(9,56,15,' 2500 ','6216.2162162163','2.4864864864865','2014-11-13','no'),(10,54,15,' 3200 ','82992.207792208','25.935064935065','2014-11-13','no'),(11,58,15,' 1400 ','97947.890818859','69.962779156328','2014-11-13','no'),(12,55,15,' 800 ','71337.160589604','89.171450737005','2014-11-13','no'),(13,53,15,' 1500 ','89495.575221238','59.663716814159','2014-11-13','no'),(14,52,15,' 6200 ','387067.67401536','62.430270002477','2014-11-13','no'),(15,143,15,' 1250 ','16241.100766704','12.992880613363','2014-11-13','no'),(16,56,0,'0','0','2.4864864864865','2014-11-17','no'),(17,142,0,'0','0','0.32619047619048','2014-11-17','no'),(18,54,0,'0','0','25.935064935065','2014-11-17','no'),(19,58,0,'0','0','69.962779156328','2014-11-17','no'),(20,55,0,'0','0','89.171450737005','2014-11-17','no'),(21,53,0,'0','0','59.663716814159','2014-11-17','no'),(22,52,0,'0','0','62.430270002477','2014-11-17','no'),(23,143,0,'0','0','12.992880613363','2014-11-17','no'),(24,56,15,' 125 ','310.81081081081','2.4864864864865','2014-11-17','no'),(25,53,15,' 100 ','5966.3716814159','59.663716814159','2014-11-17','no'),(26,60,15,' 80 ','7950','99.375','2014-11-17','no'),(27,56,0,'0','0','2.4864864864865','2014-11-17','no'),(28,53,0,'0','0','59.663716814159','2014-11-17','no'),(29,60,0,'0','0','99.375','2014-11-17','no'),(30,142,15,' 12500 ','23170.426065163','1.853634085213','2014-11-19','no'),(31,56,15,' 26 ','49.402331241193','1.9000896631228','2014-11-19','no'),(32,54,15,' 68 ','1827.6690035628','26.877485346512','2014-11-19','no'),(33,58,15,' 100 ','7122.0840607751','71.220840607751','2014-11-19','no'),(34,55,15,' 120 ','11663.621349522','97.196844579352','2014-11-19','no'),(35,53,15,' 65 ','4519.5338669821','69.531290261263','2014-11-19','no'),(36,52,15,' 80 ','5379.8144787928','67.24768098491','2014-11-19','no'),(37,143,15,' 67 ','991.67573645589','14.801130394864','2014-11-19','no'),(38,142,0,'0','0','1.853634085213','2014-11-19','no'),(39,56,0,'0','0','1.9000896631228','2014-11-19','no'),(40,54,0,'0','0','26.877485346512','2014-11-19','no'),(41,58,0,'0','0','71.220840607751','2014-11-19','no'),(42,53,0,'0','0','69.531290261263','2014-11-19','no'),(43,52,0,'0','0','67.24768098491','2014-11-19','no'),(44,143,0,'0','0','14.801130394864','2014-11-19','no'),(45,55,0,'0','0','97.196844579352','2014-11-19','no'),(46,125,20,' 3 ','391.3043478261','130.4347826087','2014-11-19','no'),(47,125,20,' 20000 ','2608683.1758142','130.43415879071','2014-11-24','no'),(48,115,21,' 100 ','100000','1000','2014-11-24','no'),(49,146,21,' 1000 ','100001.6500275','100.0016500275','2014-11-24','no'),(50,45,21,' 2000 ','1285714.2857143','642.85714285714','2014-11-24','no'),(51,142,15,' 2000 ','3707.268170426','1.853634085213','2014-11-24','no'),(52,56,15,' 1000 ','1900.0896631228','1.9000896631228','2014-11-24','no'),(53,59,15,' 100 ','1239.3939393939','12.393939393939','2014-11-24','no'),(54,54,15,' 1000 ','26877.485346512','26.877485346512','2014-11-24','no'),(55,58,15,' 3000 ','213662.52182325','71.220840607751','2014-11-24','no'),(56,53,15,' 800 ','55625.03220901','69.531290261263','2014-11-24','no'),(57,52,15,' 600 ','40348.608590946','67.24768098491','2014-11-24','no'),(58,143,15,' 1000 ','14801.130394864','14.801130394864','2014-11-24','no'),(59,60,15,' 600 ','68669.117647056','114.44852941176','2014-11-24','no'),(60,55,15,' 769 ','74744.373481522','97.196844579352','2014-11-24','no'),(61,56,15,' 1000 ','1900.0896631228','1.9000896631228','2014-11-24','no'),(62,53,15,' 800 ','55625.03220901','69.531290261263','2014-11-24','no'),(63,60,15,' 500 ','57224.26470588','114.44852941176','2014-11-24','no'),(64,125,0,'19991','2607509.2665142','130.43415869712','2014-11-24','no'),(65,115,0,'97','97000','1000','2014-11-24','no'),(66,146,0,'700','70001.15501925','100.0016500275','2014-11-24','no'),(67,45,0,'1920','1234285.7142857','642.85714285714','2014-11-24','no'),(68,142,0,'1980','3670.1954887217','1.853634085213','2014-11-24','no'),(69,56,0,'1980','3762.1775329831','1.9000896631228','2014-11-24','no'),(70,59,0,'70','867.57575757573','12.393939393939','2014-11-24','no'),(71,54,0,'920','24727.286518791','26.877485346512','2014-11-24','no'),(72,58,0,'2940','209389.27138678','71.220840607751','2014-11-24','no'),(73,53,0,'1570','109164.12571018','69.531290261263','2014-11-24','no'),(74,52,0,'500','33623.840492455','67.24768098491','2014-11-24','no'),(75,143,0,'445','6586.5030257145','14.801130394864','2014-11-24','no'),(76,60,0,'1080','123604.4117647','114.44852941176','2014-11-24','no'),(77,55,0,'700','68037.791205547','97.196844579352','2014-11-24','no'),(78,56,0,'1933','3672.8733188163','1.9000896631228','2014-11-24','no'),(79,53,0,'1500','104296.93539189','69.531290261263','2014-11-24','no'),(80,60,0,'1053','120514.30147058','114.44852941176','2014-11-24','no');
/*!40000 ALTER TABLE `min_valoracion_produccion_historico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `min_ventas`
--

DROP TABLE IF EXISTS `min_ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `min_ventas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `venta_colectivo` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `min_ventas`
--

LOCK TABLES `min_ventas` WRITE;
/*!40000 ALTER TABLE `min_ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `min_ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_antiguedad`
--

DROP TABLE IF EXISTS `mno_antiguedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_antiguedad` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `anos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diasbono` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_antiguedad`
--

LOCK TABLES `mno_antiguedad` WRITE;
/*!40000 ALTER TABLE `mno_antiguedad` DISABLE KEYS */;
INSERT INTO `mno_antiguedad` VALUES (1,'1',16),(2,'2',17),(3,'3',18),(4,'4',19),(5,'5',20),(6,'6',21),(7,'7',22),(8,'8',23),(9,'9',24),(10,'10',25),(11,'11',26),(12,'12',27),(13,'13',28),(14,'14',29),(15,'15',30),(16,NULL,NULL);
/*!40000 ALTER TABLE `mno_antiguedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_beneficio_proceso`
--

DROP TABLE IF EXISTS `mno_beneficio_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_beneficio_proceso` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_empleado` int(11) NOT NULL,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `monto` varchar(50) NOT NULL,
  `codigo_tipo` int(11) NOT NULL,
  `codigo_hijo` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_beneficio_proceso`
--

LOCK TABLES `mno_beneficio_proceso` WRITE;
/*!40000 ALTER TABLE `mno_beneficio_proceso` DISABLE KEYS */;
/*!40000 ALTER TABLE `mno_beneficio_proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_cargalaboral`
--

DROP TABLE IF EXISTS `mno_cargalaboral`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_cargalaboral` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `bono_nocturno` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_cargalaboral`
--

LOCK TABLES `mno_cargalaboral` WRITE;
/*!40000 ALTER TABLE `mno_cargalaboral` DISABLE KEYS */;
/*!40000 ALTER TABLE `mno_cargalaboral` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_concepto`
--

DROP TABLE IF EXISTS `mno_concepto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_concepto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigoproceso` varchar(8) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `asignacion` varchar(1) NOT NULL,
  `codigotipo` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_concepto`
--

LOCK TABLES `mno_concepto` WRITE;
/*!40000 ALTER TABLE `mno_concepto` DISABLE KEYS */;
INSERT INTO `mno_concepto` VALUES (101,'p$1AASUE','Sueldo Base','S',1),(104,'p$1DDNoc','Bono Nocturno','S',1),(105,'p$1EENor','Salario Normal','S',66),(106,'p$1FFHED','Horas Extras Diurnas','S',1),(107,'p$1GGHEN','Horas Extras Nocturnas','S',1),(109,'p$1HHhog','Prima por Hogar','S',3),(110,'p$1HHveh','Prima por Vehiculo','S',3),(111,'p$1JJDif','Diferencia de Salario','S',1),(112,'p$1KKCes','Cesta Ticket Adicional','S',1),(113,'p$1LLCes','Cesta Ticket','S',1),(114,'p$1MMFer','Dias Feriados','S',1),(115,'p$1NNVac','Bono Vacacional','S',6),(116,'p$1OOUti','Utilidades','N',6),(117,'p$1PPAgu','Aguinaldos','S',6),(118,'p$1QQCom','Comisiones','N',4),(119,'p$1RRSIn','Salario Integral','S',67),(120,'p$1GHBNo','Bono Nocturno','S',1),(121,'p$1RSSID','Salario Integral Diario','N',68),(122,'p$1TABPV','Bono Post Vacacional','S',6),(123,'p$1UApre','Prestaciones Sociales','S',6),(124,'p$1UBInt','Intereses de Prestaciones Sociales','S',6),(125,'p$1VAsso','Seguro Social Obligatorio','S',5),(126,'p$1VBPie','PIE','S',5),(127,'p$1VCBan','BANAVIH','S',5),(128,'p$1VDinc','INCES','S',5),(129,'p$1VEsin','Cuota Sindical','S',5),(132,'p$1WAcaj','Caja de Ahorro Sueldo Base','S',7),(133,'p$1WBcaj','Caja de Ahorro Salario Normal','S',7),(146,'p$1CAEfi','Bono por Eficiencia','S',1),(147,'p$1CBANT','Bono por Antiguedad','S',1),(148,'p$1CDSer','Bono por AÃ±os de Servicio','S',1),(149,'p$1EEnor','Salario Normal','S',68),(150,'p$1MPant','Bono por Antiguedad Otros','S',2),(151,'p$1MQser','Bono por AÃ±os de Servicio Otros','S',2),(152,'p$1MNpro','Bono de Productividad','S',2),(153,'p$1MRprf','Bono de Profesionalizacion','S',2),(154,'p$1MNres','Bono de Responsabilidad','S',2),(155,'p$1MSpro','Bono por Unidades Producidas','S',2),(156,'p$1HJhij','Prima por Hijo (Cantidad)','S',3),(157,'p$1HKhij','Prima por Hijo (Salario)','N',3),(158,'p$1HHmat','Prima por Matrimonio','S',3),(159,'p$1HHnac','Prima por Nacimiento','S',3),(160,'p$1QRven','Comisiones por Ventas Totales','S',4),(161,'p$1QSven','Comisiones por Ventas a Credito','S',4),(162,'p$1QTven','Comisiones por Ventas de Contado','N',4),(163,'p$1QXcob','Comision de Cobranza','S',4),(164,'p$1RQcom','Complemento al Compensatorio','S',1),(165,'p$1OOuti','Utilidades','S',6),(166,'p$1NOvac','Vacaciones','S',6),(167,'p$1UBint','Intereses de Prestaciones Sociales','N',6),(168,'p$1XAbtr','Beca Trabajador','S',7),(169,'p$1XKbec','Beca Hijos','S',7),(170,'p$1XLmed','Asistencia MÃ©dica','S',7),(171,'p$1XAjug','Juguetes','S',7),(172,'p$1XFgua','Guarderia','S',7),(173,'p$1XMnin','Dia del NiÃ±o','S',7),(174,'p$1XNtra','Fin de AÃ±o de Trabajadores','S',7),(175,'p$1XMffn','Fiesta Fin de AÃ±o NiÃ±os','S',7),(176,'p$1XOobs','Obsequio Fin de AÃ±o','S',7),(177,'p$1XMvac','Plan Vacacional','S',7),(178,'p$1XNdma','Dia de la Madre','S',7),(179,'p$1XNser','Servicio Recreacional','S',7),(180,'p$1XAstr','Servicio de Transporte','S',7),(181,'p$1XPuti','Utiles Escolares','S',7),(182,'','','',0);
/*!40000 ALTER TABLE `mno_concepto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_concepto_empleados`
--

DROP TABLE IF EXISTS `mno_concepto_empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_concepto_empleados` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigoempleado` int(11) DEFAULT NULL,
  `codigomes` int(11) DEFAULT NULL,
  `codigosemana` int(11) DEFAULT NULL,
  `codigoconcepto` int(11) DEFAULT NULL,
  `valor` varchar(120) DEFAULT NULL,
  `resultado` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_concepto_empleados`
--

LOCK TABLES `mno_concepto_empleados` WRITE;
/*!40000 ALTER TABLE `mno_concepto_empleados` DISABLE KEYS */;
/*!40000 ALTER TABLE `mno_concepto_empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_constante`
--

DROP TABLE IF EXISTS `mno_constante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_constante` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigoproceso` varchar(8) DEFAULT NULL,
  `descripcion` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `asignacion` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_constante`
--

LOCK TABLES `mno_constante` WRITE;
/*!40000 ALTER TABLE `mno_constante` DISABLE KEYS */;
INSERT INTO `mno_constante` VALUES (64,'c$BONX','Bono X','S'),(65,'c$BONY','Bono Y','S'),(66,'c$UTI','Dias de Utilidades','S'),(67,'c$GNA','Ganancia Neta AÃ±o Anterior','S'),(68,'c$SSO','% Seguro Social Obligatorio','S'),(69,'c$PIE','% PIE','S'),(70,'c$INC','% INCES','S'),(71,'c$LDD','% Ley del Deporte','S'),(72,'c$BAN','% BANAVIH','S'),(73,'c$DPS','Dias Prestaciones Sociales','S'),(74,'c$DBV','Dias Bono Post Vacacional','S'),(75,'c$DAG','Dias de Aguinaldos','S'),(76,'c$TSI','Tasa de Interes','S'),(77,'c$SAL','Salario Minimo','S'),(78,'c$MULSSO','Multiplo de Tope de Seguro Social','S'),(79,'c$BNOC','Bono Nocturno','S'),(80,'c$UTC','Unidad Tributaria Cestaticker','S'),(81,'c$VEN','Monto por Ventas','S'),(82,'c$PCO','Porcentaje de Comisiones','S'),(83,'c$DME','Dias del Mes','S'),(84,'c$DSE','Dias de la Semana','S'),(85,'c$HED','Horas Extras Diurnas','S'),(86,'c$HEN','Horas Extras Nocturnas','S'),(87,'c$TURD','Horas de Turno Diurno','S'),(88,'c$TURM','Horas de Turno Mixto','S'),(89,'c$TURN','Horas de Turno Nocturno','S'),(90,'c$CVEN','Comision por Ventas','S'),(91,'c$PHED','Porcentaje de Horas Extras Diurnas','S'),(92,'c$PHEN','Porcentaje de Horas Extras Nocturnas','S'),(93,'c$HDD','Horas del Dia','S'),(94,'c$UTR','Unidad Tributaria','S'),(95,'c$CBN','Constante de Bono Nocturno','S'),(96,'c$UBON','Constante de Uso de Bono Nocturno','S'),(97,'c$PRIHIJ','Constante de Prima por Hijo','S'),(98,'c$PRIHOG','Contante de Prima por Hogar','S'),(99,'c$PRIVEH','Contante de Prima por Vehiculo','S'),(100,'c$CDA','Constante de Dias Adicionales','S'),(101,'c$MES','Numero de Meses del AÃ±o','S'),(102,'c$DLA','Dias Laborados','S'),(103,'c$DFE','Constante de Dia Feriado','S'),(104,'c$VAC','Contante de Bono Vacacional','S'),(105,'c$DIAA','Dias del AÃ±o','S'),(106,'c$SIN','Constante de Salario Integral','S'),(107,'c$DPV','Contante de Dia Post Vacacional Unitario','S'),(108,'c$CPU','Constante de Prestaciones Unitaria','S'),(109,'c$CSS','Constante de Calculo de Seguro Social','S'),(110,'c$CPI','Constante de Calculo de PIE','S'),(111,'c$SID','Constante Unitaria de Asignacion Sindical','S'),(113,'c$NTR','Numero Total de Trabajadores','S'),(114,'c$CAB','Caja de Ahorro Salario Base','S'),(115,'c$CAN','Caja de Ahorro Salario Normal','S'),(116,'c$CAI','Caja de Ahorro Salario Integral','S'),(117,'c$OBLUTI','Utiles Escolares','S'),(118,'c$OBLJUG','Juguetes','S'),(120,'c$OBLBPH','Beca por Hijo','S'),(121,'c$OBLBPT','Beca por Trabajador','S'),(122,'c$OBLGUA','Guarderia','S'),(123,'c$OBLDNI','Dia del NiÃ±o','S'),(124,'c$OBLTRA','Monto a Trabajadores','S'),(125,'c$OBLNIN','Fiesta de fin de aÃ±o NiÃ±o','S'),(126,'c$OBS','Obsequio de Fin de AÃ±o','S'),(127,'c$OBLOFA','Obsequio de Fin de AÃ±o','S'),(128,'c$SMM','Constante Semestral','S'),(129,'c$OBLDUN','Dotacion de Uniforme','S'),(130,'c$OBLASI','Asistencia Medica','S'),(131,'c$SAN','Salario Normal','S'),(132,'c$SUE','Sueldo Base','S'),(133,'c$SIND','Salario Integral Diario','S'),(134,'c$1AAasd','1','N'),(135,'c$1ABs','23','N');
/*!40000 ALTER TABLE `mno_constante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_departamento`
--

DROP TABLE IF EXISTS `mno_departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_departamento` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigoalias` varchar(8) DEFAULT NULL,
  `codigogerencia` int(11) DEFAULT NULL,
  `codigounidad` int(11) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_departamento`
--

LOCK TABLES `mno_departamento` WRITE;
/*!40000 ALTER TABLE `mno_departamento` DISABLE KEYS */;
INSERT INTO `mno_departamento` VALUES (17,'GERGERGE',7,13,'Gerencia');
/*!40000 ALTER TABLE `mno_departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_empleadoxnomina`
--

DROP TABLE IF EXISTS `mno_empleadoxnomina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_empleadoxnomina` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigonomina` int(11) DEFAULT NULL,
  `codigoempleado` int(11) DEFAULT NULL,
  `salariobase` varchar(255) DEFAULT NULL,
  `fechaingreso` date DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_empleadoxnomina`
--

LOCK TABLES `mno_empleadoxnomina` WRITE;
/*!40000 ALTER TABLE `mno_empleadoxnomina` DISABLE KEYS */;
/*!40000 ALTER TABLE `mno_empleadoxnomina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_gerencia`
--

DROP TABLE IF EXISTS `mno_gerencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_gerencia` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigoalias` varchar(8) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `codigo_depende` int(11) NOT NULL,
  `etapa` varchar(2) NOT NULL,
  `profundidad` varchar(6) NOT NULL,
  `nombre_depende` varchar(50) NOT NULL,
  `unidad_administrativa` varchar(25) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_gerencia`
--

LOCK TABLES `mno_gerencia` WRITE;
/*!40000 ALTER TABLE `mno_gerencia` DISABLE KEYS */;
INSERT INTO `mno_gerencia` VALUES (7,'JUNTA','Junta Directiva',0,'no','1','',''),(26,'1','Presidencia',7,'no','2','Junta Directiva','productiva'),(27,'2','Servicio o Producción',26,'no','3','Presidecia','1'),(28,'3','Logistica',27,'no','4','Servicio o Producción','1'),(29,'4','Seguridad',28,'no','5','Logistica','1'),(30,'5','Compra',28,'no','5','Logistica','1'),(31,'6','Almacen de Productos Terminados',28,'no','5','Logistica','1'),(32,'7','Seguridad',28,'no','5','Logistica','1'),(33,'8','Mantenimiento Departamento',27,'no','4','Servicio o Producción','apoyo'),(34,'10','Reparación',33,'no','5','Mantenimiento Departamento','apoyo'),(35,'11','Mantenimiento',33,'no','5','Mantenimiento Departamento','apoyo'),(36,'12','Limpieza',33,'no','5','Mantenimiento Departamento','apoyo'),(37,'13','Fabricación',27,'no','4','Servicio o Producción','1'),(38,'14','Area Metalurgica',37,'no','5','Fabricación','1'),(39,'15','Marco',38,'no','6','Area Metalurgica','1'),(40,'17','Armado Marco',39,'si','7','Marco','1'),(41,'18','Estabilizadores',38,'no','6','Area Metalurgica','1'),(42,'19','Armado Estabilizadores',41,'si','7','Estabilizadores','1'),(43,'20','Resorte',38,'no','6','Area Metalurgica','1'),(44,'21','Armado Resorte',43,'si','7','Resorte','1'),(45,'22','Armadura',38,'no','6','Area Metalurgica','1'),(46,'23','Armado de Armadura',45,'si','7','Armadura','1'),(47,'24','Espumado',37,'no','5','Fabricación','1'),(48,'25','Preparación Espumado',47,'si','6','Espumado','1'),(49,'26','Vaciado Espumado',47,'si','6','Espumado','1'),(50,'27','Peeler',37,'no','5','Fabricación','1'),(51,'28','Peeler Laminado',50,'si','6','Peeler','1'),(52,'29','Bloque',37,'no','5','Fabricación','1'),(53,'30','Bloque Laminado',52,'si','6','Bloque','1'),(54,'31','Desperdicio',37,'no','5','Fabricación','1'),(55,'32','Preparación Desperdicio',54,'si','6','Desperdicio','1'),(56,'33','Vaciado Desperdicio',54,'si','6','Desperdicio','1'),(57,'34','Laminado Desperdicio',54,'si','6','Desperdicio','1'),(58,'35','Colchones Producto Terminado',37,'no','5','Fabricación','1'),(59,'36','Armado Colchones',58,'si','6','Colchones Producto Terminado','1'),(60,'37','Costura Colchones',58,'si','6','Colchones Producto Terminado','1'),(61,'38','Empaquetado Colchones',58,'si','6','Colchones Producto Terminado','1'),(62,'39','Ensamblaje Colchones',58,'si','6','Colchones Producto Terminado','1'),(63,'40','Operativo',26,'no','3','Presidecia','1'),(64,'41','Administración',63,'no','4','Operativo','1'),(65,'42','Contabilidad',64,'no','5','Administración','1'),(66,'43','Recurso Humano',64,'no','5','Administración','1'),(67,'44','Informatica',64,'no','5','Administración','1'),(68,'45','Servicio Generales',64,'no','5','Administración','1'),(69,'Venta','Venta',63,'no','4','Operativo','1'),(70,'47','Oficina de Ventas',69,'no','5','Venta','1'),(71,'48','Cobranza',69,'no','5','Venta','1'),(72,'49','Comercializacion',69,'no','5','Venta','1');
/*!40000 ALTER TABLE `mno_gerencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_new_bono_variable`
--

DROP TABLE IF EXISTS `mno_new_bono_variable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_new_bono_variable` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_empleado` int(11) NOT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `periocidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_new_bono_variable`
--

LOCK TABLES `mno_new_bono_variable` WRITE;
/*!40000 ALTER TABLE `mno_new_bono_variable` DISABLE KEYS */;
/*!40000 ALTER TABLE `mno_new_bono_variable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_new_bonos_produccion`
--

DROP TABLE IF EXISTS `mno_new_bonos_produccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_new_bonos_produccion` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `tipo_concepto` int(11) DEFAULT NULL,
  `codigo_formula` varchar(45) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `tipo_forma_pago` int(11) DEFAULT NULL,
  `tipo_periocidad` int(11) DEFAULT NULL COMMENT 'tabla para guardar los nuevos bonos de produccion',
  `eliminado` varchar(12) DEFAULT 'no',
  `fijo` varchar(2) DEFAULT 'no',
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `bonos_produccioncol_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_new_bonos_produccion`
--

LOCK TABLES `mno_new_bonos_produccion` WRITE;
/*!40000 ALTER TABLE `mno_new_bonos_produccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `mno_new_bonos_produccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_new_concepto`
--

DROP TABLE IF EXISTS `mno_new_concepto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_new_concepto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_concepto` int(11) NOT NULL,
  `codigo_formula` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_forma_pago` int(11) NOT NULL,
  `tipo_periocidad` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_new_concepto`
--

LOCK TABLES `mno_new_concepto` WRITE;
/*!40000 ALTER TABLE `mno_new_concepto` DISABLE KEYS */;
INSERT INTO `mno_new_concepto` VALUES (1,'Sueldo Base',1,'sueldoBase','',0,0),(3,'horas Extras Diarias Adicional(turno)',1,'horasExtraDiariaAdicionalTurno','',0,0),(4,'Horas Extras Nocturnas(Turno)',1,'horasExtrasNocturnasTurno','',0,0),(5,'Cesta Ticket Adicional',1,'cestaTicketAdicional','',0,0),(6,'Dias Feriados',1,'diasFeriados','',0,0),(9,'Bono Antigüedad',2,'bonoAntiguedad','',0,0),(10,'Bono Año de Servicio',2,'bonoAnhioServicio','',0,0),(11,'Bono Eficiencia',2,'bonoEficiencia','2000',0,6),(12,'Productividad',2,'productividad','1500',0,6),(13,'Profesionalizacion',2,'profesionalizacion','2',0,0),(14,'Responsabilidad',2,'responsabilidad','10',0,1),(15,'Vehiculo',2,'vehiculo','3',0,1),(16,'Unidades Producidas',2,'unidadesProducidas','',0,0),(17,'Prima por Hijos',3,'primaHijos','3',2,1),(18,'Prima por Hogar',3,'primaHogar','2',2,6),(19,'Prima por Matrimonio',3,'primaMatrimonio','2',2,6),(20,'Prima por Nacimiento',3,'primaNacimiento','2',2,6),(21,'Ventas Totales',4,'ventasTotales','',0,0),(22,'Ventas a  Crédito',4,'ventasCredito','',0,0),(23,'Ventas Colectivo',4,'ventasColectivo','',0,0),(24,'Cobranza',4,'cobranza','',0,0),(25,'Seguro Social',5,'seguroSocial','',0,0),(26,'Perdida Involuntaria de Empleo',5,'perdidaInvoluntariaEmpleo','',0,0),(27,'Banavih',5,'banavih','',0,0),(28,'Inces',5,'inces','',0,0),(29,'Caja de Ahorro',5,'cajaAhorro','',0,0),(30,'Cuota Sindical',5,'cuotaSindical','',0,0),(31,'Utilidades',6,'utilidades','',0,0),(32,'Aguinaldo',6,'aguinaldo','',0,0),(33,'Bono Vacacional',6,'bonoVacacional','',0,0),(34,'Bono Post Vacional',6,'bonoPostVacional','',0,0),(35,'Prestaciones Sociales',6,'prestacionesSociales','',0,0),(36,'Intereses Prestaciones Sociales',6,'interesesPrestacionesSociales','',0,0),(37,'Beca de Trabajador',7,'becaTrabajador','',0,0),(38,'Becas Hijos',7,'becasHijos','',0,0),(39,'Asistencia Médica',7,'asistenciaMedica','15000',0,6),(40,'Juguetes',7,'juguetes','3',2,6),(41,'Guarderia',7,'guarderia','500',0,1),(42,'Dotacion de Uniforme',7,'dotacionUniforme','6000',0,5),(43,'Día del Niño',7,'diaNinho','7500',0,6),(44,'Fiesta Fin de Año Trabajadores',7,'fiestaFinAnhoTrabajadores','20000',0,6),(45,'Fiesta Fin de Año Niños',7,'fiestaFinAnhoNinhos','8000',0,6),(46,'Obsequio Fin de Año',7,'obsequioFinAnho','25000',0,6),(47,'Plan Vacacional',7,'planVacacional','9000',0,6),(48,'Dia de la Madre',7,'diaMadre','7500',0,6),(49,'Servicio Recreacional',7,'servicioRecreacional','8000',0,6),(50,'Servicio de Transporte',7,'servicioTransporte','6500',0,1),(51,'Utiles Escolares',7,'utilesEscolares','3',2,6),(52,'Cesta Ticket ',1,'cestaTicket','',0,0),(54,'Bono Nocturno Normal',1,'bonoNocturnoNormal','',0,0),(55,'horas Extras Diarias Adicional(extraordinaria)',1,'horasExtraDiariaAdicionalExtraordinaria','',0,0),(56,'horas Extras Nocturna Adicional(extraordinaria)',1,'horasExtraNocturnaAdicionalExtraordinaria','',0,0),(58,'Sueldo Base Real',1,'sueldoBaseReal','',0,0),(59,'Diferencia de Salario',1,'diferenciaSalaro','',0,0),(60,'Bono eficiencia Variable ',2,'bonoEficienciaVariable','',0,0),(61,'Bono Nocturno Extra',1,'bonoNocturnoExtra','0',0,0);
/*!40000 ALTER TABLE `mno_new_concepto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_new_concepto_empleado`
--

DROP TABLE IF EXISTS `mno_new_concepto_empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_new_concepto_empleado` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_new_concepto_empleado`
--

LOCK TABLES `mno_new_concepto_empleado` WRITE;
/*!40000 ALTER TABLE `mno_new_concepto_empleado` DISABLE KEYS */;
INSERT INTO `mno_new_concepto_empleado` VALUES (1,1,16,'0','0','0','0','0','0','11','2014','no'),(2,1,12,'0','0','0','0','0','0','11','2014','no'),(3,1,60,'0','0','0','0','0','0','11','2014','no'),(4,1,15,'0','0','0','0','0','no','11','2014','no'),(5,1,11,'41.666666666667','41.666666666667','41.666666666667','41.666666666667','0','166.66666666667','11','2014','no'),(6,1,13,'0','0','0','0','0','0','11','2014','no'),(7,1,14,'0','0','0','0','0','0','11','2014','no'),(8,1,1,'1195.9453846154','1195.9453846154','1195.9453846154','1195.9453846154','0','4783.7815384615','11','2014','no'),(9,1,58,'1195.9453846154','1195.9453846154','1195.9453846154','1195.9453846154','0','5182.43','11','2014','no'),(10,1,5,'0','0','0','0','0','0','11','2014','no'),(11,1,52,'317.5','317.5','317.5','317.5','0','1270','11','2014','no'),(12,1,9,'175','175','175','175','0','700','11','2014','no'),(13,1,10,'12.5','12.5','12.5','12.5','0','50','11','2014','no'),(14,1,21,'0','0','0','0','0','0','11','2014','no'),(15,1,22,'0','0','0','0','0','0','11','2014','no'),(16,1,23,'0','0','0','0','0','0','11','2014','no'),(17,1,24,'0','0','0','0','0','0','11','2014','no'),(18,1,54,'0','0','0','0','0','0','11','2014','no'),(19,1,3,'0','0','0','0','0','0','11','2014','no'),(20,1,4,'0','0','0','0','0','0','11','2014','no'),(21,1,55,'190.86322115385','0','0','0','0','190.86322115385','11','2014','no'),(22,1,56,'99.248875','0','0','0','0','99.248875','11','2014','no'),(23,1,61,'15.269057692308','0','0','0','0','15.269057692308','11','2014','no'),(24,1,59,'0','0','0','0','0','0','11','2014','no'),(25,1,6,'0','0','0','0','0','0','11','2014','no'),(26,1,17,'571.5','571.5','571.5','571.5','0','2286','11','2014','no'),(27,1,19,'0','0','0','0','0','0','11','2014','no'),(28,1,18,'63.5','63.5','63.5','63.5','0','254','11','2014','no'),(29,1,20,'0','0','0','0','0','0','11','2014','no'),(30,1,25,'128.26008461538','128.26008461538','128.26008461538','128.26008461538','0','513.04033846154','11','2014','no'),(31,1,62,'370.85734432234','370.85734432234','370.85734432234','370.85734432234','0','1483.4293772894','11','2014','no'),(32,1,26,'28.502241025641','28.502241025641','28.502241025641','28.502241025641','0','114.00896410256','11','2014','no'),(33,1,27,'29.074830689103','29.074830689103','29.074830689103','29.074830689103','0','116.29932275641','11','2014','no'),(34,1,28,'28.502241025641','28.502241025641','28.502241025641','28.502241025641','0','114.00896410256','11','2014','no'),(35,1,29,'119.59453846154','119.59453846154','119.59453846154','119.59453846154','0','478.37815384615','11','2014','no'),(36,1,30,'12.5','12.5','12.5','12.5','0','50','11','2014','no'),(37,1,31,'118.75933760684','118.75933760684','118.75933760684','118.75933760684','0','475.03735042735','11','2014','no'),(38,1,32,'59.379668803419','59.379668803419','59.379668803419','59.379668803419','0','237.51867521368','11','2014','no'),(39,1,33,'87.090180911681','87.090180911681','87.090180911681','87.090180911681','0','348.36072364672','11','2014','no'),(40,1,34,'59.379668803419','59.379668803419','59.379668803419','59.379668803419','0','237.51867521368','11','2014','no'),(41,1,35,'3115.1604309753','3115.1604309753','3115.1604309753','3115.1604309753','0','12460.641723901','11','2014','no'),(42,1,36,'41.535472413004','41.535472413004','41.535472413004','41.535472413004','0','166.14188965201','11','2014','no'),(43,1,37,'500','500','500','500','0','2000','11','2014','no'),(44,1,38,'2250','2250','2250','2250','0','9000','11','2014','no'),(45,1,39,'0','0','0','0','0','0','11','2014','no'),(46,1,40,'43.961538461538','43.961538461538','43.961538461538','43.961538461538','0','175.84615384615','11','2014','no'),(47,1,41,'0','0','0','0','0','0','11','2014','no'),(48,1,43,'5.3418803418803','5.3418803418803','5.3418803418803','5.3418803418803','0','21.367521367521','11','2014','no'),(49,1,44,'6.631299734748','6.631299734748','6.631299734748','6.631299734748','0','26.525198938992','11','2014','no'),(50,1,45,'5.6980056980057','5.6980056980057','5.6980056980057','5.6980056980057','0','22.792022792023','11','2014','no'),(51,1,46,'8.289124668435','8.289124668435','8.289124668435','8.289124668435','0','33.15649867374','11','2014','no'),(52,1,47,'6.4102564102564','6.4102564102564','6.4102564102564','6.4102564102564','0','25.641025641026','11','2014','no'),(53,1,48,'2.4867374005305','2.4867374005305','2.4867374005305','2.4867374005305','0','9.946949602122','11','2014','no'),(54,1,49,'5.6980056980057','5.6980056980057','5.6980056980057','5.6980056980057','0','22.792022792023','11','2014','no'),(55,1,50,'28.01724137931','28.01724137931','28.01724137931','28.01724137931','0','112.06896551724','11','2014','no'),(56,1,51,'43.961538461538','43.961538461538','43.961538461538','43.961538461538','0','175.84615384615','11','2014','no'),(57,1,42,'','','','','0','0','11','2014','no');
/*!40000 ALTER TABLE `mno_new_concepto_empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_new_concepto_tipo`
--

DROP TABLE IF EXISTS `mno_new_concepto_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_new_concepto_tipo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_new_concepto_tipo`
--

LOCK TABLES `mno_new_concepto_tipo` WRITE;
/*!40000 ALTER TABLE `mno_new_concepto_tipo` DISABLE KEYS */;
INSERT INTO `mno_new_concepto_tipo` VALUES (1,'Sueldos y Salarios'),(2,'Bonos '),(3,'Primas'),(4,'Comisiones'),(5,'Aportes'),(6,'Apartados'),(7,'Otros Benficios');
/*!40000 ALTER TABLE `mno_new_concepto_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_new_variables`
--

DROP TABLE IF EXISTS `mno_new_variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_new_variables` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `valor` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `fijo` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_new_variables`
--

LOCK TABLES `mno_new_variables` WRITE;
/*!40000 ALTER TABLE `mno_new_variables` DISABLE KEYS */;
INSERT INTO `mno_new_variables` VALUES (1,'Seguro Social ','9','no',1),(2,'PIE','2','no',1),(3,'Banavih','2','no',1),(4,'Inces','2','no',1),(5,'Utilidades ','30','no',2),(6,'Aguinaldo','15','no',2),(7,'Bono Vacacional','15','no',2),(8,'Bono Post Vacacional','15','no',2),(9,'Prestaciones Sociales','5','no',2),(10,'Bono Nocturno','30','no',2),(11,'Intereses Prestaciones Sociales','16','no',2),(12,'Recargo Horas Extras Diurna','1.5','no',3),(13,'Recargo Horas Extras Noctura','1.95','no',3),(14,'Dias Feriados','2','no',3),(15,'Cestaticket','0.5','no',3),(16,'Unidad Tributaria','127','no',4),(17,'Caja de Ahorro','10','no',4),(18,'Cuota Sindical','50','no',4),(19,'Semestre Año ','2','no',4),(20,'Trimestres','4','no',4),(21,'Cuatrimestres','3','no',4),(22,'Semana del Año','52','si',4),(23,'Meses del Año','12','si',4),(24,'Dias Bancarios','360','si',4),(25,'Dias Efectivos','365','no',4),(26,'Dias Semana','7','no',5),(30,'Salario Minimo','4152.75','no',5),(31,'Turno Diario','8','no',4),(33,'Turno Mixto','7.5','no',4),(34,'Turno Nocturno','7','no',4);
/*!40000 ALTER TABLE `mno_new_variables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_new_variables_tipo`
--

DROP TABLE IF EXISTS `mno_new_variables_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_new_variables_tipo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `sub_nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_new_variables_tipo`
--

LOCK TABLES `mno_new_variables_tipo` WRITE;
/*!40000 ALTER TABLE `mno_new_variables_tipo` DISABLE KEYS */;
INSERT INTO `mno_new_variables_tipo` VALUES (1,'Contribuciones Sociales','Aportes'),(2,'LOTTT','Apartados'),(3,'LOTTT','Otros Beneficios'),(4,'Constantes Fijas',''),(5,'Constantes Variables','');
/*!40000 ALTER TABLE `mno_new_variables_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_nomina`
--

DROP TABLE IF EXISTS `mno_nomina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_nomina` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigoalias` varchar(8) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `fechainicio` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `fechacierre` date DEFAULT NULL,
  `estatus` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_nomina`
--

LOCK TABLES `mno_nomina` WRITE;
/*!40000 ALTER TABLE `mno_nomina` DISABLE KEYS */;
/*!40000 ALTER TABLE `mno_nomina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_proceso_empleados`
--

DROP TABLE IF EXISTS `mno_proceso_empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_proceso_empleados` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigoempleado` int(11) DEFAULT NULL,
  `codigomes` int(11) DEFAULT NULL,
  `codigosemana` int(11) DEFAULT NULL,
  `codigogerencia` int(11) DEFAULT NULL,
  `codigounidadadm` int(11) DEFAULT NULL,
  `codigodepartamento` int(11) DEFAULT NULL,
  `codigocargo` int(11) DEFAULT NULL,
  `sueldobase` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_proceso_empleados`
--

LOCK TABLES `mno_proceso_empleados` WRITE;
/*!40000 ALTER TABLE `mno_proceso_empleados` DISABLE KEYS */;
/*!40000 ALTER TABLE `mno_proceso_empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_tipo_concepto`
--

DROP TABLE IF EXISTS `mno_tipo_concepto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_tipo_concepto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_concepto` int(8) NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_tipo_concepto`
--

LOCK TABLES `mno_tipo_concepto` WRITE;
/*!40000 ALTER TABLE `mno_tipo_concepto` DISABLE KEYS */;
INSERT INTO `mno_tipo_concepto` VALUES (182,1,'Sueldos y Salarios'),(183,2,'Bonos '),(184,3,'Primas'),(185,4,'Comisiones'),(186,5,'Aportes'),(187,6,'Apartados'),(188,7,'Otros Beneficios Laborales'),(189,0,'');
/*!40000 ALTER TABLE `mno_tipo_concepto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mno_unidadadm`
--

DROP TABLE IF EXISTS `mno_unidadadm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mno_unidadadm` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigoalias` varchar(8) DEFAULT NULL,
  `codigogerencia` int(11) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mno_unidadadm`
--

LOCK TABLES `mno_unidadadm` WRITE;
/*!40000 ALTER TABLE `mno_unidadadm` DISABLE KEYS */;
INSERT INTO `mno_unidadadm` VALUES (13,'GERGERGE',7,'Gerencia');
/*!40000 ALTER TABLE `mno_unidadadm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `mno_view_concepto_empleados`
--

DROP TABLE IF EXISTS `mno_view_concepto_empleados`;
/*!50001 DROP VIEW IF EXISTS `mno_view_concepto_empleados`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `mno_view_concepto_empleados` (
  `codigo` tinyint NOT NULL,
  `codigoempleado` tinyint NOT NULL,
  `codigomes` tinyint NOT NULL,
  `codigoconcepto` tinyint NOT NULL,
  `codigosemana` tinyint NOT NULL,
  `valor` tinyint NOT NULL,
  `codigoproceso` tinyint NOT NULL,
  `descripcion` tinyint NOT NULL,
  `codigotipo` tinyint NOT NULL,
  `resultado` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `mrh_ano`
--

DROP TABLE IF EXISTS `mrh_ano`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_ano` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` int(4) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_ano`
--

LOCK TABLES `mrh_ano` WRITE;
/*!40000 ALTER TABLE `mrh_ano` DISABLE KEYS */;
INSERT INTO `mrh_ano` VALUES (1,2012),(2,2013),(3,2014),(4,NULL);
/*!40000 ALTER TABLE `mrh_ano` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_beneficio_periodico`
--

DROP TABLE IF EXISTS `mrh_beneficio_periodico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_beneficio_periodico` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_empleado` int(11) NOT NULL,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `codigo_tipo` int(11) NOT NULL,
  `codigo_periocidad` int(11) NOT NULL,
  `monto` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_beneficio_periodico`
--

LOCK TABLES `mrh_beneficio_periodico` WRITE;
/*!40000 ALTER TABLE `mrh_beneficio_periodico` DISABLE KEYS */;
/*!40000 ALTER TABLE `mrh_beneficio_periodico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_carga`
--

DROP TABLE IF EXISTS `mrh_carga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_carga` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cedulaempleado` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `cedula` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `primernombre` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `segundonombre` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `primerapellido` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `segundoapellido` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `fechanacimiento` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `parentesco` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `estudios` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_carga`
--

LOCK TABLES `mrh_carga` WRITE;
/*!40000 ALTER TABLE `mrh_carga` DISABLE KEYS */;
INSERT INTO `mrh_carga` VALUES (1,'1','10778878',' ',' ',' ',' ',' ','H',' '),(2,'1','10778878',' ',' ',' ',' ',' ','H',' '),(3,'6','12041392',' ',' ',' ',' ',' ','H',' '),(4,'6','12041392',' ',' ',' ',' ',' ','H',' '),(5,'9','13346696',' ',' ',' ',' ',' ','H',' '),(6,'9','13346696',' ',' ',' ',' ',' ','H',' '),(7,'9','13346696',' ',' ',' ',' ',' ','H',' '),(8,'9','13346696',' ',' ',' ',' ',' ','H',' '),(9,'9','13346696',' ',' ',' ',' ',' ','H',' '),(10,'9','13346696',' ',' ',' ',' ',' ','H',' '),(11,'10','13644618',' ',' ',' ',' ',' ','H',' '),(12,'16','16585467',' ',' ',' ',' ',' ','H',' '),(13,'16','16585467',' ',' ',' ',' ',' ','H',' '),(14,'22','17378943',' ',' ',' ',' ',' ','H',' '),(15,'22','17378943',' ',' ',' ',' ',' ','H',' '),(16,'25','17626013',' ',' ',' ',' ',' ','H',' '),(17,'25','17626013',' ',' ',' ',' ',' ','H',' '),(18,'30','19180605',' ',' ',' ',' ',' ','H',' '),(19,'32','19883408',' ',' ',' ',' ',' ','H',' '),(20,'32','19883408',' ',' ',' ',' ',' ','H',' '),(21,'38','20472373',' ',' ',' ',' ',' ','H',' '),(22,'38','20472373',' ',' ',' ',' ',' ','H',' '),(23,'40','21181731',' ',' ',' ',' ',' ','H',' '),(24,'15','123','leneol','soriano','hola','como estas','2014-12-19','P','P'),(25,'1','123','jun','ramon','Perez','Oglin','2014-01-05','H','P'),(26,'1','999','tulio','alfonzo','enrique','','2010-01-05','H','P'),(27,'1','123','jun','ramon','Perez','Oglin','2014-01-05','H','P'),(28,'1','999','tulio','alfonzo','enrique','','2010-01-05','H','P');
/*!40000 ALTER TABLE `mrh_carga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_cargo`
--

DROP TABLE IF EXISTS `mrh_cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_cargo` (
  `codigo` int(8) NOT NULL AUTO_INCREMENT,
  `codigoalias` varchar(8) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `tipo_cargo` varchar(45) NOT NULL DEFAULT 'produccion',
  `tipo_cargo_opcion` varchar(45) NOT NULL DEFAULT 'directo',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_cargo`
--

LOCK TABLES `mrh_cargo` WRITE;
/*!40000 ALTER TABLE `mrh_cargo` DISABLE KEYS */;
INSERT INTO `mrh_cargo` VALUES (50,'MECANICO','Mecanico','produccion','indirecta'),(51,'LIMPIEZA','Limpieza','produccion','directa'),(52,'MONTADOR','Montador','produccion','Indirecta'),(53,'CHOFER','Chofer','produccion','directa'),(54,'CERRADOR','Cerrador','produccion','directa'),(55,'COSTURER','Costurera','produccion','produccion'),(56,'CARGADOR','Cargador armadura','','directo'),(57,'ESPUMADO','Espumado-laboratorio','','directo'),(58,'ACOLCHAD','Acolchador','produccion','directa'),(59,'DESPACHA','Despachador','','directo'),(60,'LAMINADO','Laminador','produccion','indirecta'),(61,'RESORTER','Resortero','','directo');
/*!40000 ALTER TABLE `mrh_cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_dotacion`
--

DROP TABLE IF EXISTS `mrh_dotacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_dotacion` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_empleado` int(11) NOT NULL,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `codigo_articulo` int(11) NOT NULL,
  `cantidad` varchar(50) NOT NULL,
  `costo` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_dotacion`
--

LOCK TABLES `mrh_dotacion` WRITE;
/*!40000 ALTER TABLE `mrh_dotacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `mrh_dotacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_empleado`
--

DROP TABLE IF EXISTS `mrh_empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_empleado` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ficha` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `primernombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `segundonombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `primerapellido` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `segundoapellido` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `nacionalidad` varchar(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_empleado`
--

LOCK TABLES `mrh_empleado` WRITE;
/*!40000 ALTER TABLE `mrh_empleado` DISABLE KEYS */;
INSERT INTO `mrh_empleado` VALUES (1,'12698263','1','Eudes','Mariano','Apostol ','Orellana','0000-00-00','','','0','1','M','2007-08-06','0000-00-00',50,'1','N',0,'',71,'no','no','OBR','','V'),(2,'17625464','2','Eudes','Antonio','Camejo','Noguera','0000-00-00','','','0','1','M','2007-02-05','0000-00-00',59,'1','N',0,'',62,'no','no','OBR','','V'),(3,'16750927','3','Anibal','Jose','Caruci','','0000-00-00','','','0','1','M','2001-03-05','0000-00-00',59,'1','N',0,'',49,'no','no','OBR','','V'),(4,'18861585','4','Hector','Ramon','Castillo','PeÑa','0000-00-00','','','0','1','M','2008-01-28','0000-00-00',56,'1','N',0,'',48,'no','no','OBR','','V'),(5,'18785269','5','Marvin','Gregorio','Chirinos','Mendoza','0000-00-00','','','0','1','M','2003-11-25','0000-00-00',53,'1','N',0,'',72,'no','no','OBR','','V'),(6,'7366216','6','Concepcion Del Carme','','Cordero','De Adarfio','0000-00-00','','','0','1','F','2007-08-23','0000-00-00',51,'1','N',0,'',27,'no','no','OBR','','V'),(7,'17378547','7','Ana','Rosa','Coroba','Pereira','0000-00-00','','','0','1','F','2008-06-09','0000-00-00',59,'1','N',0,'',61,'no','no','OBR','','V'),(8,'16840131','8','Ynocencio','','Dorante','Dorante','0000-00-00','','','0','1','M','2007-04-26','0000-00-00',55,'1','N',0,'',49,'no','no','OBR','','V'),(9,'17859886','9','Yoiber','Alberto','Garcia','Pire','0000-00-00','','','0','1','M','2008-01-28','0000-00-00',59,'1','N',0,'',37,'no','no','OBR','','V'),(10,'16585786','10','Ender','Luis','Garcia','Suarez','0000-00-00','','','0','1','M','2005-06-02','0000-00-00',54,'1','N',0,'',53,'no','no','OBR','','V'),(11,'9558496','11','Carlos','','Hernandez','','0000-00-00','','','0','1','M','1999-07-06','0000-00-00',54,'1','N',0,'',61,'no','no','OBR','','V'),(12,'13084286','12','Manuel','Jose','Mendoza','','0000-00-00','','','0','1','M','2000-10-02','0000-00-00',61,'1','N',0,'',33,'no','no','OBR','','V'),(13,'18262863','13','Luis','Alberto','Perez','Mendoza','0000-00-00','','','0','1','M','2008-05-19','0000-00-00',60,'1','N',0,'',50,'no','no','OBR','','V'),(14,'24549232','14','Jaiber Jose','','Perez','Rivero','0000-00-00','','','0','1','M','2010-02-22','0000-00-00',58,'1','N',0,'',59,'no','no','OBR','','V'),(15,'7355949','15','Aida Del Carmen','','Perozo','R','0000-00-00','','','0','1','F','2000-09-25','0000-00-00',50,'1','N',0,'',65,'no','no','OBR','','V'),(16,'16002777','16','Alexander','Jose','PiÑa','','0000-00-00','','','0','1','M','2009-06-23','0000-00-00',60,'1','N',0,'',28,'no','no','OBR','','V'),(17,'9551036','17','Roso','','Ramirez','','0000-00-00','','','0','1','M','2008-09-18','0000-00-00',59,'1','N',0,'',55,'no','no','OBR','','V'),(18,'7986096','18','Carmen','Mireya','Sequera','','0000-00-00','','','0','1','F','2001-01-18','0000-00-00',60,'1','N',0,'',51,'no','no','OBR','','V'),(19,'20924553','19','Maria','Andreina','Sira','','0000-00-00','','','0','1','F','2010-01-29','0000-00-00',51,'1','N',0,'',43,'no','no','OBR','','V'),(20,'15776236','20','Henry','Jose','Torres','','0000-00-00','','','0','1','M','2000-09-26','0000-00-00',50,'1','N',0,'',46,'no','no','OBR','','V'),(21,'10848228','21','Gregorio','Ramon','Vargas','Camacaro','0000-00-00','','','0','1','M','2009-01-18','0000-00-00',54,'1','N',0,'',35,'no','no','OBR','','V'),(22,'16839260','22','Wilmer','Rafael','Vargas','Camacaro','0000-00-00','','','0','1','M','2010-02-01','0000-00-00',56,'1','N',0,'',35,'no','no','OBR','','V'),(23,'15448074','23','Alonso','Jose','Vargas','Rosendo','0000-00-00','','','0','1','M','1994-01-01','0000-00-00',61,'1','N',0,'',69,'no','no','OBR','','V'),(24,'12024058','24','Pedro','Javier','Vera','NiÑo','0000-00-00','','','0','1','M','2005-05-09','0000-00-00',58,'1','N',0,'',62,'no','no','OBR','','V'),(25,'16323925','25','Donny','Jose','PeÑa','PeÑa','0000-00-00','','','0','1','M','2012-01-20','0000-00-00',52,'1','N',0,'',30,'no','no','OBR','','V'),(26,'11879060','26','Jose','Natalio','Mendoza','Caripa','0000-00-00','','','0','1','M','2012-02-22','0000-00-00',54,'1','N',0,'',50,'no','no','OBR','','V'),(27,'20017257','27','Ana','Rosa','Rodriguez','Baldallo','0000-00-00','','','0','1','F','2012-07-23','0000-00-00',60,'1','N',0,'',40,'no','no','OBR','','V'),(28,'11264568','28','Angel','Ramon','Montes','Bracho','0000-00-00','','','0','1','M','2004-01-19','0000-00-00',58,'1','N',0,'',61,'no','no','OBR','','V'),(29,'12851741','29','Angel','Antonio','Rodriguez','','0000-00-00','','','0','1','M','2000-09-08','0000-00-00',60,'1','N',0,'',42,'no','no','OBR','','V'),(30,'18996977','30','Luis','Guillermo','Crespo','PiÑa','0000-00-00','','','0','1','M','2011-08-22','0000-00-00',55,'1','N',0,'',69,'no','no','OBR','','V'),(31,'14513729','31','Wilmer','Antonio','Palencia','Rodriguez','0000-00-00','','','0','1','M','2002-01-20','0000-00-00',52,'1','N',0,'',40,'no','no','OBR','','V'),(32,'7426189','32','Aguedo','Benjasmin','Montes','Arrieche','0000-00-00','','','0','1','M','2001-01-20','0000-00-00',50,'1','N',0,'',25,'no','no','OBR','','V'),(33,'7430385','33','Oscar','Jose','Bastidas','Sangronis','0000-00-00','','','0','1','M','2007-02-07','0000-00-00',61,'1','N',0,'',66,'no','no','OBR','','V'),(34,'17074587','34','Edgar','Enrique','Brea Gomez','','0000-00-00','','','0','1','M','2008-03-03','0000-00-00',56,'1','N',0,'',29,'no','no','OBR','','V'),(35,'15996264','35','Deivis','Andres','Camejo','Noguera','0000-00-00','','','0','1','M','2006-02-12','0000-00-00',53,'1','N',0,'',54,'no','no','OBR','','V'),(36,'10772303','36','Jose','Ramon','Chirinos','','0000-00-00','','','0','1','M','2009-02-16','0000-00-00',56,'1','N',0,'',56,'no','no','OBR','','V'),(37,'21296944','37','Rigoberto','Jose','Rodriguez','Marchan','0000-00-00','','','0','1','M','2007-02-27','0000-00-00',59,'1','N',0,'',27,'no','no','OBR','','V'),(38,'18333854','38','Arcangel','','Rivero','','0000-00-00','','','0','1','M','2004-09-27','0000-00-00',60,'1','N',0,'',62,'no','no','OBR','','V'),(39,'11265789','39','Gregorio','','Linarez','','0000-00-00','','','0','1','M','2003-05-12','0000-00-00',61,'1','N',0,'',53,'no','no','OBR','','V'),(40,'9613709','40','Jesus','Malabe','Sira','','0000-00-00','','','0','1','M','2002-06-25','0000-00-00',56,'1','N',0,'',31,'no','no','OBR','','V'),(41,'17867811','41','Andres','Rafael','Tona','Serrano','0000-00-00','','','0','1','M','2007-02-05','0000-00-00',58,'1','N',0,'',70,'no','no','OBR','','V'),(42,'23571161','42','Miguel','Angel','Orellana','Diaz','0000-00-00','','','0','1','M','2007-02-04','0000-00-00',58,'1','N',0,'',52,'no','no','OBR','','V'),(43,'7390533','43','Giovanny','Martin','Sequera','Mendoza','0000-00-00','','','0','1','M','2013-03-11','0000-00-00',53,'1','N',0,'',43,'no','no','OBR','','V'),(44,'18332224','44','Esther ','Karelis Del Valle','Gonzalez','','0000-00-00','','','0','1','F','2013-05-13','0000-00-00',54,'1','N',0,'',30,'no','no','OBR','','V'),(45,'14825344','45','Naymar','Yessennia','Aguero','Lucena','0000-00-00','','','0','1','F','2011-06-07','0000-00-00',58,'1','N',0,'',64,'no','no','EMP','','V'),(46,'18656924','46','Francys','Carminne','PeÑa ','Amache','0000-00-00','','','0','1','F','2013-04-01','0000-00-00',50,'1','N',0,'',70,'no','no','EMP','','V'),(47,'18059222','47','Nirian','Nohemi','Gutierrez Paez','','0000-00-00','','','0','1','F','2005-06-13','0000-00-00',51,'1','N',0,'',26,'no','no','EMP','','V'),(48,'7399816','48','Alexis','Pastor','Ramos','','0000-00-00','','','0','1','M','2013-08-12','0000-00-00',61,'1','N',0,'',29,'no','no','EMP','','V'),(49,'16642072','49','Edward','Jose','Melendez','Leal','0000-00-00','','','0','1','M','2013-10-29','0000-00-00',60,'1','N',0,'',49,'no','no','EMP','','V'),(50,'18549334','50','Edmir','Jose Del Valle','Colina','','0000-00-00','','','0','1','M','2013-11-06','0000-00-00',52,'1','N',0,'',33,'no','no','EMP','','V'),(51,'11425602','51','Luis','','Rodriguez','CedeÑo','0000-00-00','','','0','1','M','2014-01-28','0000-00-00',51,'1','N',0,'',60,'no','no','EMP','','V'),(52,'12244081','52','Milaberth Mara','','Figueroa','Riera','0000-00-00','','','0','1','F','2002-02-15','0000-00-00',59,'1','N',0,'',69,'no','no','EMP','','V'),(53,'15349542','53','Maria    ','','Valderrama','','0000-00-00','','','0','1','F','2014-07-09','0000-00-00',59,'1','N',0,'',57,'no','no','EMP','','V'),(54,'15960478','54','Luis Geraldo','','Rivas','','0000-00-00','','','0','1','M','2014-07-09','0000-00-00',58,'1','N',0,'',54,'no','no','OBR','','V'),(55,'12241869','55','Maribel','','Morillo','','0000-00-00','','','0','1','F','2014-09-29','0000-00-00',59,'1','N',0,'',38,'no','no','OBR','','V'),(56,'17858792','56','Jose Gregorio','','Hernadez','','0000-00-00','','','0','1','M','2014-10-13','0000-00-00',53,'1','N',0,'',67,'no','no','OBR','','V'),(57,'17814886','57','Roger','','Arriechi','','0000-00-00','','','0','1','M','2014-11-03','0000-00-00',61,'1','N',0,'',35,'no','no','OBR','','V'),(58,'15598993','58','Deybis','','Rodriguez','','0000-00-00','','','0','1','M','2014-11-03','0000-00-00',56,'1','N',0,'',51,'no','no','OBR','','V');
/*!40000 ALTER TABLE `mrh_empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_empleado_backup`
--

DROP TABLE IF EXISTS `mrh_empleado_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_empleado_backup` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(15) NOT NULL,
  `ficha` varchar(25) NOT NULL,
  `primernombre` varchar(45) NOT NULL,
  `segundonombre` varchar(45) NOT NULL,
  `primerapellido` varchar(45) NOT NULL,
  `segundoapellido` varchar(45) NOT NULL,
  `fechanacimiento` varchar(10) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `estadocivil` varchar(1) NOT NULL,
  `becado` varchar(1) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `fechaingreso` varchar(10) NOT NULL,
  `fechaegreso` varchar(10) NOT NULL,
  `codigocargo` int(11) NOT NULL,
  `estatus` varchar(1) NOT NULL,
  `condicion` varchar(1) NOT NULL,
  `codigoperioricidad` varchar(1) NOT NULL,
  `direccionhabitacion` varchar(250) NOT NULL,
  `codigo_departamento` varchar(11) NOT NULL,
  `retirado` varchar(12) NOT NULL,
  `vehiculo` varchar(2) NOT NULL,
  `tipo_trabajador` varchar(3) NOT NULL,
  `foto` varchar(120) NOT NULL,
  `nacionalidad` varchar(1) NOT NULL,
  `codigo_empleado` int(11) NOT NULL,
  `fecha` varchar(15) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_empleado_backup`
--

LOCK TABLES `mrh_empleado_backup` WRITE;
/*!40000 ALTER TABLE `mrh_empleado_backup` DISABLE KEYS */;
INSERT INTO `mrh_empleado_backup` VALUES (1,'10778878','0000000001','Ernesto','Ramon','Vasquez','Mendoza','1972-12-18','4162507581','','S','0','M','1972-12-18','0000-00-00',50,'1','N','0','BRISAS DEL TURBIO 01 CALLE JUANCITO CALDERA VIA LA PEDRERA','10','no','no','OBR','','V',1,'2014-11-02'),(2,'10964144','0000000036','Zenaida','Coromoto','Yepez','','1971-04-29','4145595512','','C','0','F','1971-04-29','0000-00-00',51,'1','N','0','','12','no','no','OBR','','V',2,'2014-11-02'),(3,'11429595','0000000020','Pedro','Jose','Piñero',' barrios','1972-04-29','4167578118','','C','0','M','1972-04-29','0000-00-00',53,'1','N','0','CARRERA 17 CON CALLE 11 B','22','no','no','OBR','','V',3,'2014-11-02'),(4,'11786199','0000000032','Jhonnys','Argenis','Lucena','Rodriguez','1975-02-06','4269506000','','C','0','M','1975-02-06','0000-00-00',51,'1','N','0','CALLE ARAGUANEY CASA NRO 10437 SECTOR RANCHO GRANDE','3','no','no','OBR','','V',4,'2014-11-02'),(5,'12019748','0000000037','Maria','Gregoria','Garcia','','1970-01-29','4245579763','','C','0','F','1970-01-29','0000-00-00',51,'1','N','0','AVENIDA PRINCIPAL EGAR MENDOZA LA PIEDAD SUR, CABUDARE ESTADO LARA','3','no','no','OBR','','V',5,'2014-11-02'),(6,'12041392','0000000012','Franco','Felipe','Parisi','Rincon','1975-08-31','4247645582','','C','0','M','1975-08-31','0000-00-00',53,'1','N','0','','3','no','no','OBR','','V',6,'2014-11-02'),(7,'12700058','0000000021','Williams','Francisco','Espinoza','Colina','1977-05-19','4264501086','','C','0','M','1977-05-19','0000-00-00',54,'1','N','0','INTERCOMUNAL BARQUISIMETO DUACA','3','no','no','OBR','','V',7,'2014-11-02'),(8,'12852364','0000000030','Fanny','Consolacion','Rodriguez','Inojosa','1970-05-25','4160770959','','C','0','F','1970-05-25','0000-00-00',51,'1','N','0','CALLE PRINCIPAL VILLA DEL C. AGUA VIVA CABUDARE','3','no','no','OBR','','V',8,'2014-11-02'),(9,'13346696','0000000006','Olivia','Del','Querales','','1972-03-23','4262084175','','C','0','F','1972-03-23','0000-00-00',55,'1','N','0','BARRIO EL CARMEN URBANIZACION GUERRERA ANAZOTO','3','no','no','OBR','','V',9,'2014-11-02'),(10,'13644618','0000000014','Eduardo','Jose','Bolivar','Angulo','1979-07-06','2518861133','','C','0','M','1979-07-06','0000-00-00',53,'1','N','0','','3','no','no','OBR','','V',10,'2014-11-02'),(11,'13774010','0000000013','Virgilio','Jose','Sira','Ledezma','1979-01-09','4266510273','','S','0','M','1979-01-09','0000-00-00',56,'1','N','0',' CARRERA 5 ENTRE CALLES 2 Y 3 SECTOR EL RECREO CASA 1-60 DE LA PARROQUIA UNION','3','no','no','OBR','','V',11,'2014-11-02'),(12,'13856741','0000000033','Zoraida','Del Carmen','Rivero','Gonzalez','1976-03-25','4245622320','','C','0','F','1976-03-25','0000-00-00',51,'1','N','0','AVENIDA PRINCIPAL AGUA VIVA . VILLA DEL C. CABUDARE','3','no','no','OBR','','V',12,'2014-11-02'),(13,'14978721','0000000019','Yonny','Alberto','Perez','Carrillo','1979-07-17','4268587736','','S','0','M','1979-07-17','0000-00-00',54,'1','N','0','CALLE 10 CON 11 Y 12 LOS LUISES','3','no','no','OBR','','V',13,'2014-11-02'),(14,'15424327','0000000038','Yanit','Lucia','Guedez','Piña','1977-12-13','4161570906','','C','0','F','1977-12-13','0000-00-00',51,'1','N','0','AV. EDGAR MENDOZA CON CALLE PRINCIPAL CASA NRO 32 LA PIEDAD SUR CABUDARE.','3','no','no','OBR','','V',14,'2014-11-02'),(15,'16454183','0000000022','Heber','Jose','Padilla','Caro','1985-09-09','4245996280','','C','0','M','1985-09-09','2014-07-03',56,'1','N','0','JACINTO LARA NORTE CALLE 3 ENTRE 1 Y 2','3','no','no','OBR','','V',15,'2014-11-02'),(16,'16585467','0000000025','Heili','Carolina','Domoromo','Rivas','1983-11-26','4165569789','','S','0','F','1983-11-26','0000-00-00',55,'1','N','0','','3','no','no','OBR','','V',16,'2014-11-02'),(17,'16822848','0000000027','Jaiker','Javier','Peroza','Ortega','1983-06-01','4163155447','','C','0','M','1983-06-01','0000-00-00',57,'1','N','0','CALLE 04 PRINCIPAL CON CALLEJON 5 BARRIO EL CORIANO 1 SECTOR SUR.','3','no','no','OBR','','V',17,'2014-11-02'),(18,'16953458','0000000016','Walther','Leandro','Zambrano','Bastidas','1984-12-12','4245664686','','C','0','M','1984-12-12','0000-00-00',54,'1','N','0','','3','no','no','OBR','','V',18,'2014-11-02'),(19,'17104823','0000000041','Richard','Jose','Navas','','1982-07-01','4262541158','','C','0','M','1982-07-01','0000-00-00',52,'1','N','0','','3','no','no','OBR','','V',19,'2014-11-02'),(20,'17229378','0000000044','Anibal','Jose','Silva','','1984-06-19','4163154187','','C','0','M','1984-06-19','0000-00-00',52,'1','N','0','PAVIA - ALGARI','3','no','no','OBR','','V',20,'2014-11-02'),(21,'17306811','0000000031','Dayana','Lucia','Castillo','','1979-12-13','','','C','0','F','1979-12-13','0000-00-00',51,'1','N','0','CALLE 7 CON 7 A CASA NRO 05 SECTOR LA UVA 1 AGUA VIVA CABUDARE','3','no','no','OBR','','V',21,'2014-11-02'),(22,'17378943','0000000017','Erickson','Javier','Moreno','Pineda','1986-12-10','4163571490','','S','0','M','1986-12-10','0000-00-00',53,'1','N','0','','3','no','no','OBR','','V',22,'2014-11-02'),(23,'17573215','0000000003','Yillberth','Jhossue','Atacho','Riera','1986-09-04','4245319232','','C','0','M','1986-09-04','0000-00-00',58,'1','N','0','','3','no','no','OBR','','V',23,'2014-11-02'),(24,'17574343','0000000018','Julio','Cesar','Apostol','','1985-11-03','4261537916','','C','0','M','1985-11-03','0000-00-00',54,'1','N','0','ALGARI VIA BOBARE','3','no','no','OBR','','V',24,'2014-11-02'),(25,'17626013','0000000002','Yadira','Josefina','Montero','Amaro','1986-08-02','4264520363','','C','0','F','1986-08-02','0000-00-00',55,'1','N','0','AVENIDA PRINCIPAL ALI PRIMERA PAVIA KM 8','3','no','no','OBR','','V',25,'2014-11-02'),(26,'18526829','0000000034','Nixon','Andres','Aarraez','Briceño','1985-08-21','4165555635','','C','0','M','1985-08-21','0000-00-00',51,'1','N','0','CALLE 1 ENTRE AVENIDA BOLIVAR Y AV. 3 UVA 2 PARROQUIA AGUA VIVA CABUDARE','3','no','no','OBR','','V',26,'2014-11-02'),(27,'18877860','0000000026','Jhon','Dixon','Vasques','Peña','1981-03-25','4263500937','','S','0','M','1981-03-25','0000-00-00',57,'1','N','0','URBANIZACION URJA VEREDA 16 EL FRIO DUACA.','3','no','no','OBR','','V',27,'2014-11-02'),(28,'18910141','0000000007','Ramon','Antonio','Rivas','Castro','1989-12-02','4269368761','','C','0','M','1989-12-02','0000-00-00',57,'1','N','0','','3','no','no','OBR','','V',28,'2014-11-02'),(29,'19105385','0000000008','Ali','Rafael','Arrieche','Arrieche','1980-12-28','','','C','0','M','1980-12-28','0000-00-00',59,'1','N','0','ALGARI LOS CAMAGOS','3','no','no','OBR','','V',29,'2014-11-02'),(30,'19180605','0000000005','Alcides','Rafael','Sivira','Boraure','1984-08-24','4245597911','','S','0','M','1984-08-24','0000-00-00',52,'1','N','0','','3','no','no','OBR','','V',30,'2014-11-02'),(31,'19424050','0000000046','Yovanny','Jose','Marchan','Rivero','1991-09-24','4262071908','','S','0','M','1991-09-24','0000-00-00',52,'1','N','0','AVENIDA 1 CALLE 08 AV. SIMON BOLIVAR','3','no','no','OBR','','V',31,'2014-11-02'),(32,'19883408','0000000004','Ricardo','Antonio','Pereira','Mendoza','1983-02-10','4264589444','','C','0','M','1983-02-10','0000-00-00',52,'1','N','0','ALGARI VIA BOBARE','3','no','no','OBR','','V',32,'2014-11-02'),(33,'19884093','0000000028','Isabel','Cristina','','','1987-07-23','','','C','0','M','1987-07-23','0000-00-00',51,'1','N','0','AV. BOLIVAR CON CALLE 7 SECTOR EL PARADERO','3','no','no','OBR','','V',33,'2014-11-02'),(34,'20075813','0000000015','Alberth','Jesus','Ure','Alegullar','1989-02-17','4145692911','','S','0','M','1989-02-17','0000-00-00',60,'1','N','0','URBANIZACION LUIS HURTADO HIGUERA CALLE 3 CON CARRERA 1 EDIFICIO DON MIGUEL','3','no','no','OBR','','V',34,'2014-11-02'),(35,'20234408','0000000043','Carlos','Alberto','Rodriguez','Martinez','1989-02-14','4161279800','','C','0','M','1989-02-14','0000-00-00',52,'1','N','0','CARRERA 30 ENTRE CALLES 33 Y 34 CASA NRO 33-61','3','no','no','OBR','','V',35,'2014-11-02'),(36,'20237986','0000000042','Johnny','Antonio','Barco','Barco','1990-12-09','4262319855','','C','0','M','1990-12-09','0000-00-00',52,'1','N','0','AVENIDA CIRCUNVALACION NORTE MOYETONES III','3','no','no','OBR','','V',36,'2014-11-02'),(37,'20351539','0000000011','Dayber','Anibal','Adan','Cordones','1990-09-11','4245422340','','C','0','M','1990-09-11','0000-00-00',0,'1','N','0','PARROQUIA EL CUJI SECTOR ANDRE BELLO II CARRERA 5 ENTRE CALLES 2 Y 3','3','no','no','OBR','','V',37,'2014-11-02'),(38,'20472373','0000000010','Wilber','Jhoan','Rodriguez','Lucena','1990-10-12','4245682985','','S','0','M','1990-10-12','0000-00-00',52,'1','N','0','BARRIO EL TRIUNFO CARRERA 12 CON CALLE 1 Y 2','3','no','no','OBR','','V',38,'2014-11-02'),(39,'20920711','0000000024','Jairo','Jesus','Medina','Torrialba','1987-06-20','4145690677','','S','0','M','1987-06-20','0000-00-00',56,'1','N','0','LA PLAYA SANTA ISABEL BARQUISIMETO','3','no','no','OBR','','V',39,'2014-11-02'),(40,'21181731','0000000009','Leonel','Antonio','Araujo','Zambrano','1992-12-29','4267514781','','S','0','M','1992-12-29','0000-00-00',61,'1','N','0','KM 11 VIA QUIBOR BARRIO JACINTO LARA','3','no','no','OBR','','V',40,'2014-11-02'),(41,'21296706','0000000040','Yoel','David','Vargas','Perozo','1991-06-26','4261576979','','C','0','M','1991-06-26','0000-00-00',52,'1','N','0','AVENIDA ROSALES DE PAVIA, ALI PRIMERA','3','no','no','OBR','','V',41,'2014-11-02'),(42,'21296973','0000000035','Lopez','Garfidez','Ronal','Eduardo','1991-07-24','4267584308','','C','0','M','1991-07-24','0000-00-00',51,'1','N','0','AVENIDA BOLIVAR CALLE 02 PARROQUIA AGUA VIVA CABUDARE','3','no','no','OBR','','V',42,'2014-11-02'),(43,'24160590','0000000045','Yordy','Alberto','Sanchez','Silva','1994-02-11','4163154187','','C','0','M','1994-02-11','0000-00-00',52,'1','N','0','ALGARI - PAVIA SECTOR LA PLAZA VIA BOBARE','3','no','no','OBR','','V',43,'2014-11-02'),(44,'24398194','0000000029','Yesica','Carolina','Vasquez','Rodriguez','1991-05-19','4263355250','','C','0','F','1991-05-19','0000-00-00',51,'1','N','0','AGUA VIVA VILLAS DE CANAAN','3','no','no','OBR','','V',44,'2014-11-02'),(45,'24550901','0000000023','Jonas','Jose','Alvarez','Barco','1991-10-22','4245563703','','C','0','M','1991-10-22','0000-00-00',52,'1','N','0','VIA CIRCUNVALACION CALLE CIEGA','3','no','no','OBR','','V',45,'2014-11-02'),(46,'25390297','0000000047','Yonder','Alexander','Hernandez','Sanchez','1996-02-12','4165546407','','C','0','M','1996-02-12','0000-00-00',52,'1','N','0','MOYETONES SECTOR III','3','no','no','OBR','','V',46,'2014-11-02'),(47,'26846696','0000000039','Antony','Alejandro','Barcos','Marchan','1996-02-04','4163515692','','C','0','M','1996-02-04','0000-00-00',52,'1','N','0','MOYETONES SECTOR III','3','no','no','OBR','','V',47,'2014-11-02');
/*!40000 ALTER TABLE `mrh_empleado_backup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_empleado_depende`
--

DROP TABLE IF EXISTS `mrh_empleado_depende`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_empleado_depende` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_trabajador` int(11) NOT NULL,
  `codigo_depende` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_empleado_depende`
--

LOCK TABLES `mrh_empleado_depende` WRITE;
/*!40000 ALTER TABLE `mrh_empleado_depende` DISABLE KEYS */;
/*!40000 ALTER TABLE `mrh_empleado_depende` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_jornada`
--

DROP TABLE IF EXISTS `mrh_jornada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_jornada` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) DEFAULT NULL,
  `horainicio` varchar(10) DEFAULT NULL,
  `horafin` varchar(10) DEFAULT NULL,
  `fechavigencia` date DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_jornada`
--

LOCK TABLES `mrh_jornada` WRITE;
/*!40000 ALTER TABLE `mrh_jornada` DISABLE KEYS */;
INSERT INTO `mrh_jornada` VALUES (2,'jornada 1','8:00','6:00','2013-06-10');
/*!40000 ALTER TABLE `mrh_jornada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_mes`
--

DROP TABLE IF EXISTS `mrh_mes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_mes` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigoano` int(11) DEFAULT NULL,
  `codigomes` int(11) DEFAULT NULL,
  `descripcion` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_mes`
--

LOCK TABLES `mrh_mes` WRITE;
/*!40000 ALTER TABLE `mrh_mes` DISABLE KEYS */;
INSERT INTO `mrh_mes` VALUES (1,3,1,'Enero'),(2,3,2,'Febrero'),(3,3,3,'Marzo'),(4,3,4,'Abril'),(5,3,5,'Mayo'),(6,3,6,'Junio'),(7,3,7,'Julio'),(8,3,8,'Agosto'),(9,3,9,'Septiembre'),(10,3,10,'Octubre'),(11,3,11,'Noviembre'),(12,3,12,'Diciembre');
/*!40000 ALTER TABLE `mrh_mes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_periocidad`
--

DROP TABLE IF EXISTS `mrh_periocidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_periocidad` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_alias` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_periocidad`
--

LOCK TABLES `mrh_periocidad` WRITE;
/*!40000 ALTER TABLE `mrh_periocidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `mrh_periocidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_periocidad_proceso`
--

DROP TABLE IF EXISTS `mrh_periocidad_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_periocidad_proceso` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_empleado` int(11) NOT NULL,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `codigo_articulo` int(11) NOT NULL,
  `codigo_periocidad` int(11) NOT NULL,
  `monto` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_periocidad_proceso`
--

LOCK TABLES `mrh_periocidad_proceso` WRITE;
/*!40000 ALTER TABLE `mrh_periocidad_proceso` DISABLE KEYS */;
/*!40000 ALTER TABLE `mrh_periocidad_proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_semana`
--

DROP TABLE IF EXISTS `mrh_semana`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_semana` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigoano` int(11) DEFAULT NULL,
  `codigomes` int(11) DEFAULT NULL,
  `codigosemana` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_semana`
--

LOCK TABLES `mrh_semana` WRITE;
/*!40000 ALTER TABLE `mrh_semana` DISABLE KEYS */;
INSERT INTO `mrh_semana` VALUES (0,3,1,1),(2,3,1,2),(3,3,1,3),(4,3,1,4),(5,3,1,5),(6,3,2,6),(7,3,2,7),(8,3,2,8),(9,3,2,9),(10,3,3,10),(11,3,3,11),(12,3,3,12),(13,3,3,13),(14,3,3,14),(15,3,4,15),(16,3,4,16),(17,3,4,17),(18,3,4,18),(19,3,5,19),(20,3,5,20),(21,3,5,21),(22,3,5,22),(23,3,6,23),(24,3,6,24),(25,3,6,25),(26,3,6,26),(27,3,6,27),(28,3,7,28),(29,3,7,29),(30,3,7,30),(31,3,7,31),(32,3,8,32),(33,3,8,33),(34,3,8,34),(35,3,8,35),(36,3,9,36),(37,3,9,37),(38,3,9,38),(39,3,9,39),(40,3,9,40),(41,3,10,41),(42,3,10,42),(43,3,10,43),(44,3,10,44),(45,3,11,45),(46,3,11,46),(47,3,11,47),(48,3,11,48),(49,3,12,49),(50,3,12,50),(51,3,12,51),(52,3,12,52),(53,NULL,NULL,NULL);
/*!40000 ALTER TABLE `mrh_semana` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_tipo_beneficio`
--

DROP TABLE IF EXISTS `mrh_tipo_beneficio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_tipo_beneficio` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_alias` varchar(8) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_tipo_beneficio`
--

LOCK TABLES `mrh_tipo_beneficio` WRITE;
/*!40000 ALTER TABLE `mrh_tipo_beneficio` DISABLE KEYS */;
/*!40000 ALTER TABLE `mrh_tipo_beneficio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_tipoturno`
--

DROP TABLE IF EXISTS `mrh_tipoturno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_tipoturno` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) DEFAULT NULL,
  `horainicio` varchar(10) DEFAULT NULL,
  `horafin` varchar(10) DEFAULT NULL,
  `horasemanales` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_tipoturno`
--

LOCK TABLES `mrh_tipoturno` WRITE;
/*!40000 ALTER TABLE `mrh_tipoturno` DISABLE KEYS */;
INSERT INTO `mrh_tipoturno` VALUES (8,'D','05:00','19:00','40'),(9,'N','19:00','05:00','35'),(10,'M','','','37.5'),(11,'L','05:00','19:00','');
/*!40000 ALTER TABLE `mrh_tipoturno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_turnos`
--

DROP TABLE IF EXISTS `mrh_turnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_turnos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `bononocmensual` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_turnos`
--

LOCK TABLES `mrh_turnos` WRITE;
/*!40000 ALTER TABLE `mrh_turnos` DISABLE KEYS */;
INSERT INTO `mrh_turnos` VALUES (22,'1','08:00','18:00',2,'D',5,0,0,'8','40','200','0','0','0','0','40','0','0','0'),(23,'2','12:30','22:00',2,'M',5,0,0,'7.5','37.5','187.5','0','3','15','75','37.5','3','15','75'),(24,'3','06:00','06:00',6,'N',3,12,7,'8','54','270','19','10','30','150','35','10','30','150'),(25,'4','22:00','06:00',1,'N',5,0,0,'7','35','175','0','7','35','175','35','7','35','175'),(26,'5','05:00','15:00',2,'D',5,0,0,'8','40','200','0','0','0','0','40','0','0','0'),(30,'6','01:00','08:00',1,'N',5,0,0,'6','30','150','0','4','20','100','35','4','20','100'),(31,'7','18:00','18:00',6,'N',3,8,11,'18','54','270','19','10','30','150','35','10','30','150'),(32,'8','07:30','16:30',1,'D',5,0,0,'8','40','200','0','0','0','0','40','0','0','0'),(33,'9','08:00','17:00',1,'D',5,0,0,'8','40','200','0','0','0','0','40','0','0','0');
/*!40000 ALTER TABLE `mrh_turnos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mrh_turnoxempleado`
--

DROP TABLE IF EXISTS `mrh_turnoxempleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mrh_turnoxempleado` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cedulaempleado` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `codigomes` int(11) DEFAULT NULL,
  `codigosemana` int(11) DEFAULT NULL,
  `codigoturno` int(11) DEFAULT NULL,
  `anhio` varchar(4) CHARACTER SET latin1 NOT NULL,
  `eliminado` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mrh_turnoxempleado`
--

LOCK TABLES `mrh_turnoxempleado` WRITE;
/*!40000 ALTER TABLE `mrh_turnoxempleado` DISABLE KEYS */;
INSERT INTO `mrh_turnoxempleado` VALUES (1,'1',11,1,33,'2014','no'),(2,'1',11,2,33,'2014','no'),(3,'1',11,3,33,'2014','no'),(4,'1',11,4,33,'2014','no'),(5,'2',11,1,33,'2014','no'),(6,'2',11,2,33,'2014','no'),(7,'2',11,3,33,'2014','no'),(8,'2',11,4,33,'2014','no'),(9,'3',11,1,33,'2014','no'),(10,'3',11,2,33,'2014','no'),(11,'3',11,3,33,'2014','no'),(12,'3',11,4,33,'2014','no'),(13,'4',11,1,33,'2014','no'),(14,'4',11,2,33,'2014','no'),(15,'4',11,3,33,'2014','no'),(16,'4',11,4,33,'2014','no'),(17,'5',11,1,33,'2014','no'),(18,'5',11,2,33,'2014','no'),(19,'5',11,3,33,'2014','no'),(20,'5',11,4,33,'2014','no'),(21,'6',11,1,33,'2014','no'),(22,'6',11,2,33,'2014','no'),(23,'6',11,3,33,'2014','no'),(24,'6',11,4,33,'2014','no'),(25,'7',11,1,33,'2014','no'),(26,'7',11,2,33,'2014','no'),(27,'7',11,3,33,'2014','no'),(28,'7',11,4,33,'2014','no'),(29,'8',11,1,33,'2014','no'),(30,'8',11,2,33,'2014','no'),(31,'8',11,3,33,'2014','no'),(32,'8',11,4,33,'2014','no'),(33,'9',11,1,33,'2014','no'),(34,'9',11,2,33,'2014','no'),(35,'9',11,3,33,'2014','no'),(36,'9',11,4,33,'2014','no'),(37,'10',11,1,33,'2014','no'),(38,'10',11,2,33,'2014','no'),(39,'10',11,3,33,'2014','no'),(40,'10',11,4,33,'2014','no'),(41,'11',11,1,33,'2014','no'),(42,'11',11,2,33,'2014','no'),(43,'11',11,3,33,'2014','no'),(44,'11',11,4,33,'2014','no'),(45,'12',11,1,33,'2014','no'),(46,'12',11,2,33,'2014','no'),(47,'12',11,3,33,'2014','no'),(48,'12',11,4,33,'2014','no'),(49,'13',11,1,33,'2014','no'),(50,'13',11,2,33,'2014','no'),(51,'13',11,3,33,'2014','no'),(52,'13',11,4,33,'2014','no'),(53,'14',11,1,33,'2014','no'),(54,'14',11,2,33,'2014','no'),(55,'14',11,3,33,'2014','no'),(56,'14',11,4,33,'2014','no'),(57,'15',11,1,33,'2014','no'),(58,'15',11,2,33,'2014','no'),(59,'15',11,3,33,'2014','no'),(60,'15',11,4,33,'2014','no'),(61,'16',11,1,33,'2014','no'),(62,'16',11,2,33,'2014','no'),(63,'16',11,3,33,'2014','no'),(64,'16',11,4,33,'2014','no'),(65,'17',11,1,33,'2014','no'),(66,'17',11,2,33,'2014','no'),(67,'17',11,3,33,'2014','no'),(68,'17',11,4,33,'2014','no'),(69,'18',11,1,33,'2014','no'),(70,'18',11,2,33,'2014','no'),(71,'18',11,3,33,'2014','no'),(72,'18',11,4,33,'2014','no'),(73,'19',11,1,33,'2014','no'),(74,'19',11,2,33,'2014','no'),(75,'19',11,3,33,'2014','no'),(76,'19',11,4,33,'2014','no'),(77,'20',11,1,33,'2014','no'),(78,'20',11,2,33,'2014','no'),(79,'20',11,3,33,'2014','no'),(80,'20',11,4,33,'2014','no'),(81,'21',11,1,33,'2014','no'),(82,'21',11,2,33,'2014','no'),(83,'21',11,3,33,'2014','no'),(84,'21',11,4,33,'2014','no'),(85,'22',11,1,33,'2014','no'),(86,'22',11,2,33,'2014','no'),(87,'22',11,3,33,'2014','no'),(88,'22',11,4,33,'2014','no'),(89,'23',11,1,33,'2014','no'),(90,'23',11,2,33,'2014','no'),(91,'23',11,3,33,'2014','no'),(92,'23',11,4,33,'2014','no'),(93,'24',11,1,33,'2014','no'),(94,'24',11,2,33,'2014','no'),(95,'24',11,3,33,'2014','no'),(96,'24',11,4,33,'2014','no'),(97,'25',11,1,33,'2014','no'),(98,'25',11,2,33,'2014','no'),(99,'25',11,3,33,'2014','no'),(100,'25',11,4,33,'2014','no'),(101,'26',11,1,33,'2014','no'),(102,'26',11,2,33,'2014','no'),(103,'26',11,3,33,'2014','no'),(104,'26',11,4,33,'2014','no'),(105,'27',11,1,33,'2014','no'),(106,'27',11,2,33,'2014','no'),(107,'27',11,3,33,'2014','no'),(108,'27',11,4,33,'2014','no'),(109,'28',11,1,33,'2014','no'),(110,'28',11,2,33,'2014','no'),(111,'28',11,3,33,'2014','no'),(112,'28',11,4,33,'2014','no'),(113,'29',11,1,33,'2014','no'),(114,'29',11,2,33,'2014','no'),(115,'29',11,3,33,'2014','no'),(116,'29',11,4,33,'2014','no'),(117,'30',11,1,33,'2014','no'),(118,'30',11,2,33,'2014','no'),(119,'30',11,3,33,'2014','no'),(120,'30',11,4,33,'2014','no'),(121,'31',11,1,33,'2014','no'),(122,'31',11,2,33,'2014','no'),(123,'31',11,3,33,'2014','no'),(124,'31',11,4,33,'2014','no'),(125,'32',11,1,33,'2014','no'),(126,'32',11,2,33,'2014','no'),(127,'32',11,3,33,'2014','no'),(128,'32',11,4,33,'2014','no'),(129,'33',11,1,33,'2014','no'),(130,'33',11,2,33,'2014','no'),(131,'33',11,3,33,'2014','no'),(132,'33',11,4,33,'2014','no'),(133,'34',11,1,33,'2014','no'),(134,'34',11,2,33,'2014','no'),(135,'34',11,3,33,'2014','no'),(136,'34',11,4,33,'2014','no'),(137,'35',11,1,33,'2014','no'),(138,'35',11,2,33,'2014','no'),(139,'35',11,3,33,'2014','no'),(140,'35',11,4,33,'2014','no'),(141,'36',11,1,33,'2014','no'),(142,'36',11,2,33,'2014','no'),(143,'36',11,3,33,'2014','no'),(144,'36',11,4,33,'2014','no'),(145,'37',11,1,33,'2014','no'),(146,'37',11,2,33,'2014','no'),(147,'37',11,3,33,'2014','no'),(148,'37',11,4,33,'2014','no'),(149,'38',11,1,33,'2014','no'),(150,'38',11,2,33,'2014','no'),(151,'38',11,3,33,'2014','no'),(152,'38',11,4,33,'2014','no'),(153,'39',11,1,33,'2014','no'),(154,'39',11,2,33,'2014','no'),(155,'39',11,3,33,'2014','no'),(156,'39',11,4,33,'2014','no'),(157,'40',11,1,33,'2014','no'),(158,'40',11,2,33,'2014','no'),(159,'40',11,3,33,'2014','no'),(160,'40',11,4,33,'2014','no'),(161,'41',11,1,33,'2014','no'),(162,'41',11,2,33,'2014','no'),(163,'41',11,3,33,'2014','no'),(164,'41',11,4,33,'2014','no'),(165,'42',11,1,33,'2014','no'),(166,'42',11,2,33,'2014','no'),(167,'42',11,3,33,'2014','no'),(168,'42',11,4,33,'2014','no'),(169,'43',11,1,33,'2014','no'),(170,'43',11,2,33,'2014','no'),(171,'43',11,3,33,'2014','no'),(172,'43',11,4,33,'2014','no'),(173,'44',11,1,33,'2014','no'),(174,'44',11,2,33,'2014','no'),(175,'44',11,3,33,'2014','no'),(176,'44',11,4,33,'2014','no'),(177,'45',11,1,33,'2014','no'),(178,'45',11,2,33,'2014','no'),(179,'45',11,3,33,'2014','no'),(180,'45',11,4,33,'2014','no'),(181,'46',11,1,33,'2014','no'),(182,'46',11,2,33,'2014','no'),(183,'46',11,3,33,'2014','no'),(184,'46',11,4,33,'2014','no'),(185,'47',11,1,33,'2014','no'),(186,'47',11,2,33,'2014','no'),(187,'47',11,3,33,'2014','no'),(188,'47',11,4,33,'2014','no'),(189,'48',11,1,33,'2014','no'),(190,'48',11,2,33,'2014','no'),(191,'48',11,3,33,'2014','no'),(192,'48',11,4,33,'2014','no'),(193,'49',11,1,33,'2014','no'),(194,'49',11,2,33,'2014','no'),(195,'49',11,3,33,'2014','no'),(196,'49',11,4,33,'2014','no'),(197,'50',11,1,33,'2014','no'),(198,'50',11,2,33,'2014','no'),(199,'50',11,3,33,'2014','no'),(200,'50',11,4,33,'2014','no'),(201,'51',11,1,33,'2014','no'),(202,'51',11,2,33,'2014','no'),(203,'51',11,3,33,'2014','no'),(204,'51',11,4,33,'2014','no'),(205,'52',11,1,33,'2014','no'),(206,'52',11,2,33,'2014','no'),(207,'52',11,3,33,'2014','no'),(208,'52',11,4,33,'2014','no'),(209,'53',11,1,33,'2014','no'),(210,'53',11,2,33,'2014','no'),(211,'53',11,3,33,'2014','no'),(212,'53',11,4,33,'2014','no'),(213,'54',11,1,33,'2014','no'),(214,'54',11,2,33,'2014','no'),(215,'54',11,3,33,'2014','no'),(216,'54',11,4,33,'2014','no'),(217,'55',11,1,33,'2014','no'),(218,'55',11,2,33,'2014','no'),(219,'55',11,3,33,'2014','no'),(220,'55',11,4,33,'2014','no'),(221,'56',11,1,33,'2014','no'),(222,'56',11,2,33,'2014','no'),(223,'56',11,3,33,'2014','no'),(224,'56',11,4,33,'2014','no'),(225,'57',11,1,33,'2014','no'),(226,'57',11,2,33,'2014','no'),(227,'57',11,3,33,'2014','no'),(228,'57',11,4,33,'2014','no'),(229,'58',11,1,33,'2014','no'),(230,'58',11,2,33,'2014','no'),(231,'58',11,3,33,'2014','no'),(232,'58',11,4,33,'2014','no');
/*!40000 ALTER TABLE `mrh_turnoxempleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `mrh_view_analisisxempleado`
--

DROP TABLE IF EXISTS `mrh_view_analisisxempleado`;
/*!50001 DROP VIEW IF EXISTS `mrh_view_analisisxempleado`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `mrh_view_analisisxempleado` (
  `cedulaempleado` tinyint NOT NULL,
  `codigomes` tinyint NOT NULL,
  `codigosemana` tinyint NOT NULL,
  `codigo` tinyint NOT NULL,
  `descripcion` tinyint NOT NULL,
  `horaentrada` tinyint NOT NULL,
  `horasalida` tinyint NOT NULL,
  `horadescanso` tinyint NOT NULL,
  `descripciontipoturno` tinyint NOT NULL,
  `diaslaborales` tinyint NOT NULL,
  `horaextradiurno` tinyint NOT NULL,
  `horaextranocturno` tinyint NOT NULL,
  `horatdiario` tinyint NOT NULL,
  `horatsemana` tinyint NOT NULL,
  `horatmensual` tinyint NOT NULL,
  `totalhrsextra` tinyint NOT NULL,
  `hrsnocdiarias` tinyint NOT NULL,
  `hrsnocsemanal` tinyint NOT NULL,
  `hrsnocmensual` tinyint NOT NULL,
  `hrslabpermitidas` tinyint NOT NULL,
  `bononocdiario` tinyint NOT NULL,
  `bononocsemanal` tinyint NOT NULL,
  `bononocmensual` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `mrh_view_turnos_empleados`
--

DROP TABLE IF EXISTS `mrh_view_turnos_empleados`;
/*!50001 DROP VIEW IF EXISTS `mrh_view_turnos_empleados`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `mrh_view_turnos_empleados` (
  `cedulaempleado` tinyint NOT NULL,
  `codigomes` tinyint NOT NULL,
  `codigosemana` tinyint NOT NULL,
  `descripciontipoturno` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `prc_detalle_etapa`
--

DROP TABLE IF EXISTS `prc_detalle_etapa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prc_detalle_etapa` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` int(11) NOT NULL,
  `cantidad_estandar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_etapa` int(11) NOT NULL,
  `codigo_producto_detalle` int(11) NOT NULL,
  `desactivo` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prc_detalle_etapa`
--

LOCK TABLES `prc_detalle_etapa` WRITE;
/*!40000 ALTER TABLE `prc_detalle_etapa` DISABLE KEYS */;
INSERT INTO `prc_detalle_etapa` VALUES (1,144,'2,498',1,142,'n'),(2,144,'0,133',1,56,'n'),(3,144,'0',1,59,'n'),(4,144,'0,126',1,54,'n'),(5,144,'13,6',1,58,'n'),(6,144,'0,76',1,53,'n'),(7,144,'34,6',1,52,'n'),(8,144,'0,03',1,143,'n'),(9,144,'0',1,60,'n'),(10,144,'0,2',2,56,'n'),(11,144,'1',2,53,'n'),(12,144,'0,25',2,60,'n'),(13,144,'53',1,55,'n'),(14,185,'2',3,115,'n'),(15,185,'1',3,146,'n'),(16,185,'2',3,45,'n'),(17,185,'22',4,125,'n');
/*!40000 ALTER TABLE `prc_detalle_etapa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prc_elaborados`
--

DROP TABLE IF EXISTS `prc_elaborados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prc_elaborados` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` int(11) NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `desactivo` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prc_elaborados`
--

LOCK TABLES `prc_elaborados` WRITE;
/*!40000 ALTER TABLE `prc_elaborados` DISABLE KEYS */;
/*!40000 ALTER TABLE `prc_elaborados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prc_etapas`
--

DROP TABLE IF EXISTS `prc_etapas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prc_etapas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` int(11) NOT NULL,
  `codigo_departamento` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `desactivo` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `horas_estandar` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prc_etapas`
--

LOCK TABLES `prc_etapas` WRITE;
/*!40000 ALTER TABLE `prc_etapas` DISABLE KEYS */;
INSERT INTO `prc_etapas` VALUES (1,144,'16','n','40'),(2,144,'17','n','40'),(3,185,'25','n','2.05'),(4,185,'23','n','0.3666666666');
/*!40000 ALTER TABLE `prc_etapas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prc_orden_trabajador`
--

DROP TABLE IF EXISTS `prc_orden_trabajador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prc_orden_trabajador` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'esta tabla es para ver cuando se agregan trabajdores a una orden especifica q tiene q estar activa',
  `codigo_trabajador` int(11) DEFAULT NULL,
  `codigo_orden_produccion` int(11) DEFAULT NULL,
  `eliminado` varchar(12) DEFAULT 'no',
  `codigo_etapa` int(11) DEFAULT NULL,
  `horas` varchar(45) DEFAULT NULL,
  `bono_producido` varchar(45) NOT NULL DEFAULT '0',
  `pago_unidades` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prc_orden_trabajador`
--

LOCK TABLES `prc_orden_trabajador` WRITE;
/*!40000 ALTER TABLE `prc_orden_trabajador` DISABLE KEYS */;
INSERT INTO `prc_orden_trabajador` VALUES (1,1,1,'no',1,'60','0','0'),(2,2,1,'no',1,'60','0','0'),(3,3,1,'no',1,'60','0','0'),(4,1,1,'no',2,'20','0','0'),(5,2,1,'no',2,'30','0','0');
/*!40000 ALTER TABLE `prc_orden_trabajador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prc_orden_trabajo`
--

DROP TABLE IF EXISTS `prc_orden_trabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prc_orden_trabajo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` int(11) NOT NULL,
  `produccion_planificada` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `produccion_real` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `indicador` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_inicio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_culminacion` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `codigo_alias` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `eliminada` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `comentario` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `valor_standar` varchar(90) COLLATE utf8_unicode_ci DEFAULT '0',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prc_orden_trabajo`
--

LOCK TABLES `prc_orden_trabajo` WRITE;
/*!40000 ALTER TABLE `prc_orden_trabajo` DISABLE KEYS */;
INSERT INTO `prc_orden_trabajo` VALUES (1,144,'20','69','','2014-11-10','2014-11-26','1','n','','0'),(2,144,'20','25','','2014-11-13','2014-11-19','leonell','n','','0'),(3,185,'3','','','2014-11-19','n','prueba','n','','0'),(4,185,'20','','','2014-11-24','2014-11-24','ASD','n','22','0');
/*!40000 ALTER TABLE `prc_orden_trabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prc_orden_trabajo_detalle_etapa`
--

DROP TABLE IF EXISTS `prc_orden_trabajo_detalle_etapa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prc_orden_trabajo_detalle_etapa` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_orden_trabajo` int(11) NOT NULL,
  `cantidad_estandar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `completo` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  `codigo_etapa` int(11) NOT NULL,
  `codigo_producto_detalle` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `valor` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `valor_standar` varchar(90) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prc_orden_trabajo_detalle_etapa`
--

LOCK TABLES `prc_orden_trabajo_detalle_etapa` WRITE;
/*!40000 ALTER TABLE `prc_orden_trabajo_detalle_etapa` DISABLE KEYS */;
INSERT INTO `prc_orden_trabajo_detalle_etapa` VALUES (1,1,'2,498','n',1,142,144,'','0.25'),(2,1,'0,133','n',1,56,144,'','2.25'),(3,1,'0','n',1,59,144,'','12'),(4,1,'0,126','n',1,54,144,'','25'),(5,1,'13,6','n',1,58,144,'','65'),(6,1,'0,76','n',1,53,144,'',' 54'),(7,1,'34,6','n',1,52,144,'','62'),(8,1,'0,03','n',1,143,144,'',' 12.5'),(9,1,'0','n',1,60,144,'','90'),(10,1,'0,2','n',2,56,144,'','2.25'),(11,1,'1','n',2,53,144,'',' 54'),(12,1,'0,25','n',2,60,144,'','90'),(13,2,'2,498','n',1,142,144,'','0.25'),(14,2,'0,133','n',1,56,144,'','2.25'),(15,2,'0','n',1,59,144,'','12'),(16,2,'0,126','n',1,54,144,'','25'),(17,2,'13,6','n',1,58,144,'','65'),(18,2,'0,76','n',1,53,144,'',' 54'),(19,2,'34,6','n',1,52,144,'','62'),(20,2,'0,03','n',1,143,144,'',' 12.5'),(21,2,'0','n',1,60,144,'','90'),(22,2,'0,2','n',2,56,144,'','2.25'),(23,2,'1','n',2,53,144,'',' 54'),(24,2,'0,25','n',2,60,144,'','90'),(25,2,'53','n',1,55,144,'','78'),(26,3,'2','n',3,115,185,'','0'),(27,3,'1','n',3,146,185,'',''),(28,3,'2','n',3,45,185,'','0'),(29,3,'22','n',4,125,185,'','0'),(30,4,'2','n',3,115,185,'','0'),(31,4,'1','n',3,146,185,'',''),(32,4,'2','n',3,45,185,'','0'),(33,4,'22','n',4,125,185,'','0');
/*!40000 ALTER TABLE `prc_orden_trabajo_detalle_etapa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prc_orden_trabajo_etapas`
--

DROP TABLE IF EXISTS `prc_orden_trabajo_etapas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prc_orden_trabajo_etapas` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_orden_trabajo` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `codigo_departamento` int(11) NOT NULL,
  `completo` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prc_orden_trabajo_etapas`
--

LOCK TABLES `prc_orden_trabajo_etapas` WRITE;
/*!40000 ALTER TABLE `prc_orden_trabajo_etapas` DISABLE KEYS */;
INSERT INTO `prc_orden_trabajo_etapas` VALUES (1,1,144,16,'2014-11-26'),(2,1,144,17,'2014-11-26'),(3,2,144,16,'2014-11-19'),(4,2,144,17,'2014-11-19'),(5,3,185,25,'2014-11-28'),(6,3,185,23,'2014-11-28'),(7,4,185,25,'2014-11-24'),(8,4,185,23,'2014-11-24');
/*!40000 ALTER TABLE `prc_orden_trabajo_etapas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prc_semielaborados`
--

DROP TABLE IF EXISTS `prc_semielaborados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prc_semielaborados` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` int(11) NOT NULL,
  `cantidad` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `desactivo` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'n',
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prc_semielaborados`
--

LOCK TABLES `prc_semielaborados` WRITE;
/*!40000 ALTER TABLE `prc_semielaborados` DISABLE KEYS */;
INSERT INTO `prc_semielaborados` VALUES (1,144,'25','n');
/*!40000 ALTER TABLE `prc_semielaborados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prueba`
--

DROP TABLE IF EXISTS `prueba`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prueba` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_alias` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `rif` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prueba`
--

LOCK TABLES `prueba` WRITE;
/*!40000 ALTER TABLE `prueba` DISABLE KEYS */;
/*!40000 ALTER TABLE `prueba` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seg_usuario`
--

DROP TABLE IF EXISTS `seg_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seg_usuario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `permiso` int(11) NOT NULL,
  `token_actual` varchar(45) NOT NULL,
  `nombre_alias` varchar(45) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seg_usuario`
--

LOCK TABLES `seg_usuario` WRITE;
/*!40000 ALTER TABLE `seg_usuario` DISABLE KEYS */;
INSERT INTO `seg_usuario` VALUES (1,'root','123',1,'Bf4e688c7b91c2ef2748446122165e83-1419605505','');
/*!40000 ALTER TABLE `seg_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ven_comisiones`
--

DROP TABLE IF EXISTS `ven_comisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ven_comisiones` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_empresa` int(11) NOT NULL,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `codigo_tipo` int(11) NOT NULL,
  `monoto` varchar(200) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ven_comisiones`
--

LOCK TABLES `ven_comisiones` WRITE;
/*!40000 ALTER TABLE `ven_comisiones` DISABLE KEYS */;
/*!40000 ALTER TABLE `ven_comisiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ven_empleado`
--

DROP TABLE IF EXISTS `ven_empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ven_empleado` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_empleado` int(11) NOT NULL,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `codigo_cliente` int(11) NOT NULL,
  `codigo_factura` int(11) NOT NULL,
  `venta_contado` varchar(200) NOT NULL,
  `venta_credito` varchar(200) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ven_empleado`
--

LOCK TABLES `ven_empleado` WRITE;
/*!40000 ALTER TABLE `ven_empleado` DISABLE KEYS */;
/*!40000 ALTER TABLE `ven_empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ven_empresa`
--

DROP TABLE IF EXISTS `ven_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ven_empresa` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_mes` int(11) NOT NULL,
  `codigo_semana` int(11) NOT NULL,
  `venta_contado` varchar(200) NOT NULL,
  `venta_credito` varchar(200) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ven_empresa`
--

LOCK TABLES `ven_empresa` WRITE;
/*!40000 ALTER TABLE `ven_empresa` DISABLE KEYS */;
/*!40000 ALTER TABLE `ven_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ven_tipo`
--

DROP TABLE IF EXISTS `ven_tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ven_tipo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_alias` varchar(8) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `nombre1` varchar(100) NOT NULL,
  `nombre2` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ven_tipo`
--

LOCK TABLES `ven_tipo` WRITE;
/*!40000 ALTER TABLE `ven_tipo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ven_tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `mco_view_formulaconcepto`
--

/*!50001 DROP TABLE IF EXISTS `mco_view_formulaconcepto`*/;
/*!50001 DROP VIEW IF EXISTS `mco_view_formulaconcepto`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `mco_view_formulaconcepto` AS select `mno_concepto`.`codigo` AS `codigo`,`mno_concepto`.`codigoproceso` AS `codigoproceso`,`mco_formulaconcepto`.`formula` AS `formula` from (`mno_concepto` join `mco_formulaconcepto` on((`mno_concepto`.`codigo` = `mco_formulaconcepto`.`codigoconcepto`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `mco_view_montoconstante`
--

/*!50001 DROP TABLE IF EXISTS `mco_view_montoconstante`*/;
/*!50001 DROP VIEW IF EXISTS `mco_view_montoconstante`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `mco_view_montoconstante` AS select `mno_constante`.`codigo` AS `codigo`,`mno_constante`.`codigoproceso` AS `codigoproceso`,`mco_montoconstante`.`monto` AS `monto` from (`mno_constante` join `mco_montoconstante` on((`mno_constante`.`codigo` = `mco_montoconstante`.`codigoconstante`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `mno_view_concepto_empleados`
--

/*!50001 DROP TABLE IF EXISTS `mno_view_concepto_empleados`*/;
/*!50001 DROP VIEW IF EXISTS `mno_view_concepto_empleados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `mno_view_concepto_empleados` AS select `mno_concepto_empleados`.`codigo` AS `codigo`,`mno_concepto_empleados`.`codigoempleado` AS `codigoempleado`,`mno_concepto_empleados`.`codigomes` AS `codigomes`,`mno_concepto_empleados`.`codigoconcepto` AS `codigoconcepto`,`mno_concepto_empleados`.`codigosemana` AS `codigosemana`,`mno_concepto_empleados`.`valor` AS `valor`,`mno_concepto`.`codigoproceso` AS `codigoproceso`,`mno_concepto`.`descripcion` AS `descripcion`,`mno_concepto`.`codigotipo` AS `codigotipo`,`mno_concepto_empleados`.`resultado` AS `resultado` from (`mno_concepto_empleados` join `mno_concepto` on((`mno_concepto_empleados`.`codigoconcepto` = `mno_concepto`.`codigo`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `mrh_view_analisisxempleado`
--

/*!50001 DROP TABLE IF EXISTS `mrh_view_analisisxempleado`*/;
/*!50001 DROP VIEW IF EXISTS `mrh_view_analisisxempleado`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `mrh_view_analisisxempleado` AS select `mrh_turnoxempleado`.`cedulaempleado` AS `cedulaempleado`,`mrh_turnoxempleado`.`codigomes` AS `codigomes`,`mrh_turnoxempleado`.`codigosemana` AS `codigosemana`,`mrh_turnos`.`codigo` AS `codigo`,`mrh_turnos`.`descripcion` AS `descripcion`,`mrh_turnos`.`horaentrada` AS `horaentrada`,`mrh_turnos`.`horasalida` AS `horasalida`,`mrh_turnos`.`horadescanso` AS `horadescanso`,`mrh_turnos`.`descripciontipoturno` AS `descripciontipoturno`,`mrh_turnos`.`diaslaborales` AS `diaslaborales`,`mrh_turnos`.`horaextradiurno` AS `horaextradiurno`,`mrh_turnos`.`horaextranocturno` AS `horaextranocturno`,`mrh_turnos`.`horatdiario` AS `horatdiario`,`mrh_turnos`.`horatsemana` AS `horatsemana`,`mrh_turnos`.`horatmensual` AS `horatmensual`,`mrh_turnos`.`totalhrsextra` AS `totalhrsextra`,`mrh_turnos`.`hrsnocdiarias` AS `hrsnocdiarias`,`mrh_turnos`.`hrsnocsemanal` AS `hrsnocsemanal`,`mrh_turnos`.`hrsnocmensual` AS `hrsnocmensual`,`mrh_turnos`.`hrslabpermitidas` AS `hrslabpermitidas`,`mrh_turnos`.`bononocdiario` AS `bononocdiario`,`mrh_turnos`.`bononocsemanal` AS `bononocsemanal`,`mrh_turnos`.`bononocmensual` AS `bononocmensual` from (`mrh_turnos` join `mrh_turnoxempleado` on((`mrh_turnos`.`codigo` = `mrh_turnoxempleado`.`codigoturno`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `mrh_view_turnos_empleados`
--

/*!50001 DROP TABLE IF EXISTS `mrh_view_turnos_empleados`*/;
/*!50001 DROP VIEW IF EXISTS `mrh_view_turnos_empleados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `mrh_view_turnos_empleados` AS select `mrh_turnoxempleado`.`cedulaempleado` AS `cedulaempleado`,`mrh_turnoxempleado`.`codigomes` AS `codigomes`,`mrh_turnoxempleado`.`codigosemana` AS `codigosemana`,`mrh_turnos`.`descripciontipoturno` AS `descripciontipoturno` from (`mrh_turnos` join `mrh_turnoxempleado` on((`mrh_turnos`.`codigo` = `mrh_turnoxempleado`.`codigoturno`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-29 16:21:10
