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
-- Table structure for table `actuacion_persone`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actuacion_persone` (
  `persone_id` int(10) unsigned NOT NULL,
  `actuacion_id` int(10) unsigned NOT NULL,
  KEY `actuacion_persone_persone_id_foreign` (`persone_id`),
  KEY `actuacion_persone_actuacion_id_foreign` (`actuacion_id`),
  CONSTRAINT `actuacion_persone_actuacion_id_foreign` FOREIGN KEY (`actuacion_id`) REFERENCES `actuacions` (`id`),
  CONSTRAINT `actuacion_persone_persone_id_foreign` FOREIGN KEY (`persone_id`) REFERENCES `persones` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `actuacions`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actuacions` (
  `id` int(10) unsigned NOT NULL,
  `titol` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipus_actuacions_fk` int(10) unsigned NOT NULL,
  `data` date NOT NULL,
  `llocs_fk` int(10) unsigned NOT NULL,
  `placa_o_assaig` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `actuacions_tipus_actuacions_fk_foreign` (`tipus_actuacions_fk`),
  KEY `actuacions_llocs_fk_foreign` (`llocs_fk`),
  KEY `actuacions_data_index` (`data`),
  CONSTRAINT `actuacions_llocs_fk_foreign` FOREIGN KEY (`llocs_fk`) REFERENCES `llocs` (`id`),
  CONSTRAINT `actuacions_tipus_actuacions_fk_foreign` FOREIGN KEY (`tipus_actuacions_fk`) REFERENCES `tipus_actuacions` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `beneficiaris`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiaris` (
  `id` int(10) unsigned NOT NULL,
  `quote_id` int(10) unsigned NOT NULL,
  `persone_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `beneficiaris_quote_id_foreign` (`quote_id`),
  KEY `beneficiaris_persone_id_foreign` (`persone_id`),
  CONSTRAINT `beneficiaris_persone_id_foreign` FOREIGN KEY (`persone_id`) REFERENCES `persones` (`id`),
  CONSTRAINT `beneficiaris_quote_id_foreign` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `castell_persone`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `castell_persone` (
  `persone_id` int(10) unsigned NOT NULL,
  `castell_id` int(10) unsigned NOT NULL,
  KEY `castell_persone_persone_id_foreign` (`persone_id`),
  KEY `castell_persone_castell_id_foreign` (`castell_id`),
  CONSTRAINT `castell_persone_castell_id_foreign` FOREIGN KEY (`castell_id`) REFERENCES `castells` (`id`),
  CONSTRAINT `castell_persone_persone_id_foreign` FOREIGN KEY (`persone_id`) REFERENCES `persones` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `castells`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `castells` (
  `id` int(10) unsigned NOT NULL,
  `tipus_castells_fk` int(10) unsigned NOT NULL,
  `actuacion_id` int(10) unsigned NOT NULL,
  `ordre_a_placa` smallint(6) DEFAULT NULL,
  `resultat` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `castells_tipus_castells_fk_foreign` (`tipus_castells_fk`),
  KEY `castells_actuacion_id_foreign` (`actuacion_id`),
  CONSTRAINT `castells_actuacion_id_foreign` FOREIGN KEY (`actuacion_id`) REFERENCES `actuacions` (`id`),
  CONSTRAINT `castells_tipus_castells_fk_foreign` FOREIGN KEY (`tipus_castells_fk`) REFERENCES `tipus_castells` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categories`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL,
  `tipus` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comentari` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `esdeveniment_persone`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `esdeveniment_persone` (
  `persone_id` int(10) unsigned NOT NULL,
  `esdeveniment_id` int(10) unsigned NOT NULL,
  KEY `esdeveniment_persone_persone_id_foreign` (`persone_id`),
  KEY `esdeveniment_persone_esdeveniment_id_foreign` (`esdeveniment_id`),
  CONSTRAINT `esdeveniment_persone_esdeveniment_id_foreign` FOREIGN KEY (`esdeveniment_id`) REFERENCES `esdeveniments` (`id`),
  CONSTRAINT `esdeveniment_persone_persone_id_foreign` FOREIGN KEY (`persone_id`) REFERENCES `persones` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `esdeveniments`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `esdeveniments` (
  `id` int(10) unsigned NOT NULL,
  `titol` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipus_esdeveniments_fk` int(10) unsigned NOT NULL,
  `data` date NOT NULL,
  `data_fi` date DEFAULT NULL,
  `hora` time NOT NULL,
  `hora_fi` time DEFAULT NULL,
  `descripcio` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `llocs_fk` int(10) unsigned NOT NULL,
  `contacte` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cost_estimat` decimal(8,2) DEFAULT NULL,
  `cost_real` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `esdeveniments_tipus_esdeveniments_fk_foreign` (`tipus_esdeveniments_fk`),
  KEY `esdeveniments_llocs_fk_foreign` (`llocs_fk`),
  KEY `esdeveniments_titol_index` (`titol`),
  KEY `esdeveniments_data_index` (`data`),
  CONSTRAINT `esdeveniments_llocs_fk_foreign` FOREIGN KEY (`llocs_fk`) REFERENCES `llocs` (`id`),
  CONSTRAINT `esdeveniments_tipus_esdeveniments_fk_foreign` FOREIGN KEY (`tipus_esdeveniments_fk`) REFERENCES `tipus_esdeveniments` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `families`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `families` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `activa` tinyint(1) NOT NULL DEFAULT '1',
  `persona_membre_fk` int(10) unsigned NOT NULL,
  `persona_responsable_fk` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `families_persona_membre_fk_foreign` (`persona_membre_fk`),
  KEY `families_persona_responsable_fk_foreign` (`persona_responsable_fk`),
  CONSTRAINT `families_persona_responsable_fk_foreign` FOREIGN KEY (`persona_responsable_fk`) REFERENCES `persones` (`id`),
  CONSTRAINT `families_persona_membre_fk_foreign` FOREIGN KEY (`persona_membre_fk`) REFERENCES `persones` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `llocs`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `llocs` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
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
-- Table structure for table `missatges`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `missatges` (
  `id` int(10) unsigned NOT NULL,
  `titol` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `data` date NOT NULL,
  `llocs_fk` int(10) unsigned NOT NULL,
  `contingut` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `missatges_llocs_fk_foreign` (`llocs_fk`),
  CONSTRAINT `missatges_llocs_fk_foreign` FOREIGN KEY (`llocs_fk`) REFERENCES `llocs` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `persones`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persones` (
  `id` int(10) unsigned NOT NULL,
  `numero_soci` int(10) unsigned DEFAULT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cognom1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cognom2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mot` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `naixement` date NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `direccio` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cp` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `poblacio` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `provincia` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pais` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Espanya',
  `telefon` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `mobil` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `sexe` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `alta` date NOT NULL,
  `actiu` tinyint(1) NOT NULL DEFAULT '1',
  `categories_fk` int(10) unsigned NOT NULL DEFAULT '1',
  `rols_fk` int(10) unsigned NOT NULL DEFAULT '2',
  `usuari` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rebre_sms` tinyint(1) NOT NULL DEFAULT '1',
  `rebre_mail` tinyint(1) NOT NULL DEFAULT '1',
  `comentari` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bic` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iban` varchar(34) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alcada-cadira` decimal(8,2) NOT NULL DEFAULT '0.00',
  `alcada-hombros` decimal(8,2) NOT NULL DEFAULT '0.00',
  `alcada-mans` decimal(8,2) NOT NULL DEFAULT '0.00',
  `amplada-hombros` decimal(8,2) NOT NULL DEFAULT '0.00',
  `circunferencia` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `persones_mot_unique` (`mot`),
  KEY `persones_categories_fk_foreign` (`categories_fk`),
  KEY `persones_rols_fk_foreign` (`rols_fk`),
  KEY `persones_nom_index` (`nom`),
  KEY `persones_cognom1_index` (`cognom1`),
  KEY `persones_alta_index` (`alta`),
  KEY `persones_actiu_index` (`actiu`),
  CONSTRAINT `persones_rols_fk_foreign` FOREIGN KEY (`rols_fk`) REFERENCES `rols` (`id`),
  CONSTRAINT `persones_categories_fk_foreign` FOREIGN KEY (`categories_fk`) REFERENCES `categories` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pinyes`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pinyes` (
  `id` int(10) unsigned NOT NULL,
  `castells_fk` int(10) unsigned NOT NULL,
  `persones_fk` int(10) unsigned NOT NULL,
  `posicions_fk` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pinyes_castells_fk_foreign` (`castells_fk`),
  KEY `pinyes_persones_fk_foreign` (`persones_fk`),
  KEY `pinyes_posicions_fk_foreign` (`posicions_fk`),
  CONSTRAINT `pinyes_posicions_fk_foreign` FOREIGN KEY (`posicions_fk`) REFERENCES `posicions` (`id`),
  CONSTRAINT `pinyes_castells_fk_foreign` FOREIGN KEY (`castells_fk`) REFERENCES `castells` (`id`),
  CONSTRAINT `pinyes_persones_fk_foreign` FOREIGN KEY (`persones_fk`) REFERENCES `persones` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `posicions`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posicions` (
  `id` int(10) unsigned NOT NULL,
  `tipus_castells_fk` int(10) unsigned NOT NULL,
  `tipus_posicio` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `origin_x` decimal(8,2) NOT NULL DEFAULT '0.00',
  `origin_y` decimal(8,2) NOT NULL DEFAULT '0.00',
  `x` decimal(8,2) NOT NULL DEFAULT '0.00',
  `y` decimal(8,2) NOT NULL DEFAULT '0.00',
  `d` decimal(8,2) NOT NULL DEFAULT '0.00',
  `alpha` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `posicions_tipus_castells_fk_foreign` (`tipus_castells_fk`),
  CONSTRAINT `posicions_tipus_castells_fk_foreign` FOREIGN KEY (`tipus_castells_fk`) REFERENCES `tipus_castells` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `quotes`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes` (
  `id` int(10) unsigned NOT NULL,
  `periodicitat_mesos` int(10) unsigned NOT NULL,
  `import` decimal(8,2) NOT NULL DEFAULT '0.00',
  `id_responsables_fk` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `quotes_id_responsables_fk_foreign` (`id_responsables_fk`),
  CONSTRAINT `quotes_id_responsables_fk_foreign` FOREIGN KEY (`id_responsables_fk`) REFERENCES `persones` (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rols`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rols` (
  `id` int(10) unsigned NOT NULL,
  `tipus` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nivell_permis` int(10) unsigned NOT NULL,
  `comentari` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipus_actuacions`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipus_actuacions` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipus_castells`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipus_castells` (
  `id` int(10) unsigned NOT NULL,
  `nom` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `pinya_necessaria` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tipus_castells_nom_index` (`nom`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tipus_esdeveniments`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipus_esdeveniments` (
  `id` int(10) unsigned NOT NULL,
  `tipus` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descripcio` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tipus_esdeveniments_tipus_index` (`tipus`)
);
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-02-26  8:31:32
