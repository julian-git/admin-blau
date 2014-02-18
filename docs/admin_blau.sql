-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: admin_blau
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.13.04.1
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activitats`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activitats` (
  `id` int(10) unsigned NOT NULL,
  `titol` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipus_activitats_fk` int(10) unsigned NOT NULL,
  `data` date NOT NULL,
  `fi` date DEFAULT NULL,
  `descripcio` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contacte` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost_estimat` decimal(8,2) DEFAULT NULL,
  `cost_real` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `activitats_tipus_activitats_fk_foreign` (`tipus_activitats_fk`),
  KEY `activitats_titol_index` (`titol`),
  KEY `activitats_data_index` (`data`),
  CONSTRAINT `activitats_tipus_activitats_fk_foreign` FOREIGN KEY (`tipus_activitats_fk`) REFERENCES `tipus_activitats` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `castellers`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `castellers` (
  `id` int(10) unsigned NOT NULL,
  `cognom1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cognom2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mot` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `families_fk` int(10) unsigned NOT NULL,
  `naixement` date NOT NULL,
  `dni` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `direccio` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cp` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `poblacio` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `provincia` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `telefon1` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `telefon2` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `mobil1` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `mobil2` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `whatsapp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `alta` date NOT NULL,
  `sexe` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `quotes_fk` int(10) unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `castellers_families_fk_foreign` (`families_fk`),
  KEY `castellers_quotes_fk_foreign` (`quotes_fk`),
  KEY `castellers_cognom1_index` (`cognom1`),
  KEY `castellers_nom_index` (`nom`),
  KEY `castellers_mot_index` (`mot`),
  KEY `castellers_alta_index` (`alta`),
  CONSTRAINT `castellers_quotes_fk_foreign` FOREIGN KEY (`quotes_fk`) REFERENCES `quotes` (`id`),
  CONSTRAINT `castellers_families_fk_foreign` FOREIGN KEY (`families_fk`) REFERENCES `families` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `castellers_x_activitats`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `castellers_x_activitats` (
  `castellers_fk` int(10) unsigned NOT NULL,
  `activitats_fk` int(10) unsigned NOT NULL,
  KEY `castellers_x_activitats_castellers_fk_foreign` (`castellers_fk`),
  KEY `castellers_x_activitats_activitats_fk_foreign` (`activitats_fk`),
  CONSTRAINT `castellers_x_activitats_activitats_fk_foreign` FOREIGN KEY (`activitats_fk`) REFERENCES `activitats` (`id`),
  CONSTRAINT `castellers_x_activitats_castellers_fk_foreign` FOREIGN KEY (`castellers_fk`) REFERENCES `castellers` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `families`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `families` (
  `id` int(10) unsigned NOT NULL,
  `cognom1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cognom2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `migrations`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `quotes`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes` (
  `id` int(10) unsigned NOT NULL,
  `banc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `codi_banc` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oficina` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `digit_control` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `compte` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BIC` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IBAN` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `import` decimal(8,2) NOT NULL,
  `tipus_quotes_fk` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `quotes_tipus_quotes_fk_foreign` (`tipus_quotes_fk`),
  CONSTRAINT `quotes_tipus_quotes_fk_foreign` FOREIGN KEY (`tipus_quotes_fk`) REFERENCES `tipus_quotes` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipus_activitats`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipus_activitats` (
  `id` int(10) unsigned NOT NULL,
  `tipus` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcio` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tipus_activitats_tipus_index` (`tipus`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipus_quotes`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipus_quotes` (
  `id` int(10) unsigned NOT NULL,
  `descripcio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `periodicitat_mesos` int(10) unsigned NOT NULL,
  `primer_cop_al_any` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-02-18 11:26:41
