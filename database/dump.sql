/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.16-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: bde_gestion
-- ------------------------------------------------------
-- Server version	10.11.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES
('gestion-bde-cache-bde-demo@esgi-toulon.fr|46.193.70.67','i:3;',1789391582),
('gestion-bde-cache-bde-demo@esgi-toulon.fr|46.193.70.67:timer','i:1789391582;',1789391582),
('gestion-bde-cache-zaproxy@example.com|46.193.70.67','i:5;',1789391931),
('gestion-bde-cache-zaproxy@example.com|46.193.70.67:timer','i:1789391931;',1789391931);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `etudiants` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `classe` varchar(255) NOT NULL,
  `option` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `etudiants_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudiants`
--

LOCK TABLES `etudiants` WRITE;
/*!40000 ALTER TABLE `etudiants` DISABLE KEYS */;
INSERT INTO `etudiants` VALUES
(1,'Munoz','Amélie','christine84@example.com','M2',NULL,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(2,'Bonnin','Isaac','eremy@example.net','M1','Dev','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(3,'Fontaine','Léon','marc.hoareau@example.org','B2',NULL,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(4,'Thierry','Christine','vguilbert@example.org','B3','Dev','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(5,'Toussaint','Adrien','julie67@example.net','B3','Data','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(6,'Joseph','Maryse','claudine18@example.org','B1','Data','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(7,'Lemoine','Étienne','leroy.arnaude@example.org','M1','Data','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(8,'Valentin','Bertrand','leclercq.marguerite@example.com','B1','Data','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(9,'Gregoire','Martine','zbarbier@example.org','M2','Dev','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(10,'Paul','Philippine','oceane20@example.net','B2','Dev','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(11,'Picard','Josette','diaz.gilbert@example.com','B1','Data','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(12,'Weiss','Emmanuelle','lelievre.denis@example.net','B1','Data','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(13,'Salmon','Cécile','blaporte@example.net','B3','Data','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(14,'Francois','Nicolas','gabriel67@example.org','B1','Reseaux','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(15,'Marchand','Margaud','juliette22@example.net','M2','Dev','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(16,'Munoz','Isaac','denise.barre@example.org','M1','Reseaux','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(17,'Imbert','Nicole','lmartinez@example.org','M1','Reseaux','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(18,'Jourdan','Charlotte','audrey53@example.org','B1','Cyber','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(19,'Charpentier','Vincent','ddelorme@example.com','B1','Data','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(20,'Poulain','Guy','henry.antoine@example.org','B3','Data','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(21,'Louis','Marine','caroline59@example.net','M1','Cyber','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(22,'Legrand','Julien','paul.roland@example.com','B2','Reseaux','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(23,'Laurent','Robert','qschmitt@example.org','M1','Data','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(24,'Foucher','Constance','lweber@example.org','M2','Data','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(25,'Andre','Anastasie','hubert.aurelie@example.com','B1','Reseaux','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(26,'Marques','Roger','fcourtois@example.com','B2','Dev','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(27,'Renault','Christophe','thomas.claude@example.com','M2','Dev','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(28,'Lopez','Claude','francois25@example.net','M2','Data','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(29,'Imbert','Xavier','bonneau.dorothee@example.net','B1','Data','2026-09-14 11:11:51','2026-09-14 11:11:51'),
(30,'Cousin','Thérèse','gilbert63@example.org','B2',NULL,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(31,'Fodil','Sofiane','sofianefodil676@gmail.com','B1','Réseaux','2026-09-14 11:13:47','2026-09-14 11:13:47'),
(32,'John','Smith','JS8@gmail.com','B3',NULL,'2026-09-14 11:16:01','2026-09-14 11:16:01');
/*!40000 ALTER TABLE `etudiants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `evenements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `capacite` int(10) unsigned DEFAULT NULL,
  `cree_par` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evenements_cree_par_foreign` (`cree_par`),
  CONSTRAINT `evenements_cree_par_foreign` FOREIGN KEY (`cree_par`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evenements`
--

LOCK TABLES `evenements` WRITE;
/*!40000 ALTER TABLE `evenements` DISABLE KEYS */;
INSERT INTO `evenements` VALUES
(1,'Tournoi de foot','2026-08-17 22:55:00','La Garde',NULL,NULL,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(2,'Journée sportive','2026-08-25 13:54:00',NULL,'Qui a animi hic aut totam qui',11,1,'2026-09-14 11:11:51','2026-09-14 11:14:39'),
(3,'Gala de fin d\'année','2026-08-14 10:21:17','Campus ESGI','Non in et vel omnis.',47,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(4,'Gala de fin d\'année','2026-08-05 21:33:11','Toulon',NULL,81,1,'2026-09-14 11:11:51','2026-09-14 11:11:51');
/*!40000 ALTER TABLE `evenements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_09_14_104409_add_two_factor_columns_to_users_table',1),
(5,'2026_09_14_104410_create_etudiants_table',1),
(6,'2026_09_14_104411_create_evenements_table',1),
(7,'2026_09_14_104412_create_participations_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participations`
--

DROP TABLE IF EXISTS `participations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `participations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `etudiant_id` bigint(20) unsigned NOT NULL,
  `evenement_id` bigint(20) unsigned NOT NULL,
  `present` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `participations_etudiant_id_evenement_id_unique` (`etudiant_id`,`evenement_id`),
  KEY `participations_evenement_id_foreign` (`evenement_id`),
  CONSTRAINT `participations_etudiant_id_foreign` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE,
  CONSTRAINT `participations_evenement_id_foreign` FOREIGN KEY (`evenement_id`) REFERENCES `evenements` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participations`
--

LOCK TABLES `participations` WRITE;
/*!40000 ALTER TABLE `participations` DISABLE KEYS */;
INSERT INTO `participations` VALUES
(1,1,1,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(2,2,1,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(3,6,1,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(4,7,1,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(5,11,1,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(6,14,1,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(7,20,1,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(8,23,1,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(9,30,1,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(10,2,2,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(11,6,2,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(12,7,2,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(13,9,2,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(14,10,2,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(15,13,2,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(16,14,2,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(17,15,2,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(18,27,2,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(19,7,3,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(20,9,3,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(21,23,3,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(22,26,3,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(23,27,3,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(24,28,3,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(25,1,4,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(26,2,4,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(27,7,4,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(28,8,4,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(29,9,4,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(30,17,4,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(31,18,4,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(32,23,4,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(33,24,4,0,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(34,25,4,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(35,29,4,1,'2026-09-14 11:11:51','2026-09-14 11:11:51'),
(36,30,4,1,'2026-09-14 11:11:51','2026-09-14 11:11:51');
/*!40000 ALTER TABLE `participations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES
('BrHlUkoX6Zp7rKLW7ptKJAQSKMFIu1toZ4WV89Yy',NULL,'46.193.70.67','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI3RVFLWjFoODRvajE2aDJQR2g1am5DOWNhY0N6N3BQeDI2UTFWdGE5IiwidXJsIjp7ImludGVuZGVkIjoiaHR0cHM6XC9cL2hpZGRlbi1kYWtvdGEtcGV0cm9sZXVtLXNlbnNvci50cnljbG91ZGZsYXJlLmNvbVwvcHJvZmlsZSJ9LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cHM6XC9cL2hpZGRlbi1kYWtvdGEtcGV0cm9sZXVtLXNlbnNvci50cnljbG91ZGZsYXJlLmNvbVwvbG9naW4iLCJyb3V0ZSI6ImxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1789391665),
('GiB5DqZeviwsl16Y2CjJSwgPu9GHCneXJ0JLXxyf',1,'46.193.70.67','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJjNFVWeDJXbW93RjIxMkZ6V2lNbnNXZ0RqemFxTWtEVTB2SmthSmZEIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9oaWRkZW4tZGFrb3RhLXBldHJvbGV1bS1zZW5zb3IudHJ5Y2xvdWRmbGFyZS5jb21cL2V2ZW5lbWVudHMiLCJyb3V0ZSI6ImV2ZW5lbWVudHMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1789392084),
('JtukUrVYwyCgawLLXFKSiDhAFILw7y9t1PmALtRK',1,'46.193.70.67','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.6.2 Safari/605.1.15','eyJfdG9rZW4iOiI5bUo1RlozZGtWVUZEcGtHSWJYRjNkaUpEMXJBb3FPSzI1bTlReUwzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9oaWRkZW4tZGFrb3RhLXBldHJvbGV1bS1zZW5zb3IudHJ5Y2xvdWRmbGFyZS5jb21cL3BsYW5uaW5nIiwicm91dGUiOiJwbGFubmluZy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==',1789392116),
('Qih0MEl0NIDgyv09oYyXYTa4zw2SRI7bPCJhcp0o',1,'46.193.70.67','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36 OPR/135.0.0.0','eyJfdG9rZW4iOiJuUEtRajFqaVdySGNiUzlwY0hPdEhsQWFZZ2VwaDRiQnd1SWtuODl5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9oaWRkZW4tZGFrb3RhLXBldHJvbGV1bS1zZW5zb3IudHJ5Y2xvdWRmbGFyZS5jb21cL3BsYW5uaW5nP21vaXM9MjAyNy0wMyIsInJvdXRlIjoicGxhbm5pbmcuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1789392026),
('SqWgpgel7H7fuedUF6cJEQn3f4iaEIbATvzYyqhg',NULL,'46.193.70.67','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJFaW5pZDg3SWp4V0Yzd2JENmgxbUdLZXl0SzVwWHlCOTlNaHNldElTIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2hpZGRlbi1kYWtvdGEtcGV0cm9sZXVtLXNlbnNvci50cnljbG91ZGZsYXJlLmNvbVwvbG9naW4iLCJyb3V0ZSI6ImxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1789391893),
('sRcSU7qPCMmAizZdiTgkxe6y5pR669QJ6yRZg5VD',NULL,'127.0.0.1','curl/8.15.0','eyJfdG9rZW4iOiJlZXJNUWRSeU1TT3Z0UUFzWXlXa0ZBVHBRNm5CeVdXNDV5cXBTWDVSIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAxIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1789391510),
('WZvrwYKz1IMRiEEvpSTUWHpomE6R0IgCzKTl3WaX',NULL,'46.193.70.67','curl/8.15.0','eyJfdG9rZW4iOiJEUWxWdUI5aUUyQmQ1dG5nc0NyV3JFVWlQNWxCSHJhRDV6UDhsT3o2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9oaWRkZW4tZGFrb3RhLXBldHJvbGV1bS1zZW5zb3IudHJ5Y2xvdWRmbGFyZS5jb20iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1789391512),
('xs4FbKi7UmYnd6ooXXvW3ad37pcfQCeoS8ThvTkq',NULL,'46.193.70.67','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJiVFEzUWJ5RGp6R0VEdmYwYWxxcFNackZBdUd5RVFaSnpmaE5xOENiIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2hpZGRlbi1kYWtvdGEtcGV0cm9sZXVtLXNlbnNvci50cnljbG91ZGZsYXJlLmNvbVwvbG9naW4iLCJyb3V0ZSI6ImxvZ2luIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1789391810);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `google2fa_secret` varchar(255) DEFAULT NULL,
  `two_factor_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Membre BDE (démo)','demo@bde.local','2026-09-14 11:11:51','$2y$12$RkguXi1m.vq7YsIme5tNR.uvvHxEV4p5S1JhbT0IYLLmhGaHShnAu',NULL,0,'uAyuF9b8Cp','2026-09-14 11:11:51','2026-09-14 11:11:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-14 15:22:46
