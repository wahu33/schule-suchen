-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: schuladressen
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.17.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `t01_schuladressen`
--

DROP TABLE IF EXISTS `t01_schuladressen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t01_schuladressen` (
  `Schulnummer` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Schulform` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Schulbezeichnung_1` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Schulbezeichnung_2` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Schulbezeichnung_3` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Kurzbezeichnung` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PLZ` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Ort` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Strasse` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Telefonvorwahl` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Telefon` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Faxvorwahl` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Fax` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `E_Mail` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Homepage` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Rechtsform` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Traegernummer` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Gemeindeschluessel` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `KoordinatenRechtswert` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `KoordinatenHochwert` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Schulbetriebsschluessel` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Schulbetriebsdatum` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `Schulnummer_2` (`Schulnummer`),
  KEY `Schulnummer` (`Schulnummer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t02_schultraeger`
--

DROP TABLE IF EXISTS `t02_schultraeger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t02_schultraeger` (
  `Traegernummer` int(5) DEFAULT NULL,
  `Traegerbezeichnung_1` varchar(40) DEFAULT NULL,
  `Traegerbezeichnung_2` varchar(40) DEFAULT NULL,
  `Traegerbezeichnung_3` varchar(40) DEFAULT NULL,
  `Kurzbezeichnung` varchar(40) DEFAULT NULL,
  `PLZ` int(5) DEFAULT NULL,
  `Ort` varchar(24) DEFAULT NULL,
  `Strasse` varchar(31) DEFAULT NULL,
  `Telefonvorwahl` varchar(5) DEFAULT NULL,
  `Telefon` varchar(10) DEFAULT NULL,
  `Faxvorwahl` varchar(5) DEFAULT NULL,
  `Fax` varchar(10) DEFAULT NULL,
  `Gemeindeschluessel` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t03_schulbetriebsschluessel`
--

DROP TABLE IF EXISTS `t03_schulbetriebsschluessel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t03_schulbetriebsschluessel` (
  `Schluessel` int(11) NOT NULL,
  `Bezeichnung` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Schluessel`),
  KEY `id` (`Schluessel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t04_schulform`
--

DROP TABLE IF EXISTS `t04_schulform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t04_schulform` (
  `id` int(11) NOT NULL,
  `Schulform` varchar(60) COLLATE utf8 NOT NULL,
  `Bem` varchar(20) COLLATE utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t04_schulformschluessel`
--

DROP TABLE IF EXISTS `t04_schulformschluessel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t04_schulformschluessel` (
  `Schluessel` int(11) NOT NULL,
  `Bezeichnung` varchar(60) COLLATE utf8 NOT NULL,
  PRIMARY KEY (`Schluessel`),
  UNIQUE KEY `id` (`Schluessel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t05_rechtsform`
--

DROP TABLE IF EXISTS `t05_rechtsform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t05_rechtsform` (
  `id` int(11) NOT NULL,
  `Rechtsform` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t05_rechtsformschluessel`
--

DROP TABLE IF EXISTS `t05_rechtsformschluessel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t05_rechtsformschluessel` (
  `Schluessel` int(11) NOT NULL,
  `Bezeichnung` varchar(60) NOT NULL,
  PRIMARY KEY (`Schluessel`),
  UNIQUE KEY `id` (`Schluessel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t06_gemeindeschluessel`
--

DROP TABLE IF EXISTS `t06_gemeindeschluessel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t06_gemeindeschluessel` (
  `Schluessel` int(11) NOT NULL,
  `Bezeichnung` varchar(80) NOT NULL,
  PRIMARY KEY (`Schluessel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t10_kurse`
--

DROP TABLE IF EXISTS `t10_kurse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t10_kurse` (
  `Schulnummer` varchar(6) DEFAULT NULL,
  `Fachschluessel` varchar(2) DEFAULT NULL,
  `GKEF` int(1) DEFAULT NULL,
  `GKQ1` int(1) DEFAULT NULL,
  `LKQ1` int(1) DEFAULT NULL,
  `GKQ2` int(1) DEFAULT NULL,
  `LKQ2` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t11_fachschluessel`
--

DROP TABLE IF EXISTS `t11_fachschluessel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t11_fachschluessel` (
  `Fachschluessel` varchar(14) DEFAULT NULL,
  `Fachtext` varchar(107) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t12_usprache`
--

DROP TABLE IF EXISTS `t12_usprache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t12_usprache` (
  `U_Sprache_Schluessel` varchar(2) CHARACTER SET utf8 NOT NULL,
  `U_Sprache_Text` varchar(25) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t15_schuelerzahlen`
--

DROP TABLE IF EXISTS `t15_schuelerzahlen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t15_schuelerzahlen` (
  `Schulnummer` varchar(6) NOT NULL,
  `Anzahl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t16_bilingual`
--

DROP TABLE IF EXISTS `t16_bilingual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t16_bilingual` (
  `Schulnummer` varchar(6) NOT NULL,
  `U_Fach` varchar(2) NOT NULL,
  `U_Sprache` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-03 11:13:03
