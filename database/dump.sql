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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etudiants`
--

LOCK TABLES `etudiants` WRITE;
/*!40000 ALTER TABLE `etudiants` DISABLE KEYS */;
INSERT INTO `etudiants` VALUES
(1,'Mallet','Philippe','michel.robert@example.org','B2',NULL,'2026-09-14 12:28:15','2026-09-14 12:28:15'),
(2,'Auger','Monique','ddelahaye@example.net','M2','Dev','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(3,'Nguyen','Pauline','yves11@example.net','B2','Data','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(4,'Paris','Alain','lombard.oceane@example.net','B1','Data','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(5,'Aubert','Alain','plebrun@example.net','B1','Reseaux','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(6,'Guyon','Rémy','rey.guillaume@example.org','M2','Reseaux','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(7,'Bouvier','Jean','fhuet@example.com','M1','Dev','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(8,'Reynaud','Hélène','rlamy@example.com','M2',NULL,'2026-09-14 12:28:15','2026-09-14 12:28:15'),
(9,'Chauveau','Véronique','pasquier.frederic@example.com','B2','Data','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(10,'Guyon','Benoît','oceane.ollivier@example.com','M1','Cyber','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(11,'Jacques','Denis','leconte.martine@example.org','B2',NULL,'2026-09-14 12:28:15','2026-09-14 12:28:15'),
(12,'De Sousa','Yves','julien77@example.net','M1','Data','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(13,'Roussel','Marguerite','charles.gillet@example.net','M1','Cyber','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(14,'Renault','André','kdaniel@example.com','B3','Reseaux','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(15,'Vallet','Jean','qmarion@example.com','B1',NULL,'2026-09-14 12:28:15','2026-09-14 12:28:15'),
(16,'Hubert','Marc','alemaire@example.net','B2','Reseaux','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(17,'Gillet','Françoise','pdelaunay@example.com','M1','Reseaux','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(18,'Julien','Augustin','elise.leger@example.org','B2','Data','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(19,'Gillet','Rémy','emilie.jacques@example.com','B1','Data','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(20,'Leveque','Georges','auguste39@example.com','M1','Cyber','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(21,'Brunel','Augustin','audrey.samson@example.net','B2','Cyber','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(22,'Bouchet','Clémence','paulette24@example.com','B3','Data','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(23,'Nicolas','Yves','aimee21@example.net','M2','Cyber','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(24,'Poulain','Guy','valentin.susanne@example.com','M1','Data','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(25,'Lebrun','Charlotte','diaz.martin@example.net','B3',NULL,'2026-09-14 12:28:15','2026-09-14 12:28:15'),
(26,'Thibault','Éric','patrick.charpentier@example.org','B1','Reseaux','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(27,'Leconte','Sophie','chauvin.constance@example.org','M1',NULL,'2026-09-14 12:28:15','2026-09-14 12:28:15'),
(28,'Delahaye','Christine','perrier.zacharie@example.com','B2',NULL,'2026-09-14 12:28:15','2026-09-14 12:28:15'),
(29,'Robin','Brigitte','cecile.bousquet@example.com','B3','Data','2026-09-14 12:28:15','2026-09-14 12:28:15'),
(30,'Benoit','Chantal','dcharles@example.org','M2','Reseaux','2026-09-14 12:28:15','2026-09-14 12:28:15');
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
  `payant` tinyint(1) NOT NULL DEFAULT 0,
  `prix` decimal(6,2) DEFAULT NULL,
  `cree_par` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evenements_cree_par_foreign` (`cree_par`),
  CONSTRAINT `evenements_cree_par_foreign` FOREIGN KEY (`cree_par`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evenements`
--

LOCK TABLES `evenements` WRITE;
/*!40000 ALTER TABLE `evenements` DISABLE KEYS */;
INSERT INTO `evenements` VALUES
(1,'Afterwork BDE','2026-10-24 19:38:35',NULL,'Qui iure aut consectetur ratione voluptatem sunt.',NULL,1,5.00,1,'2026-09-14 12:28:15','2026-09-14 12:28:16'),
(2,'Barbecue de rentrée','2026-10-26 01:13:34','Toulon',NULL,50,0,NULL,1,'2026-09-14 12:28:15','2026-09-14 12:28:16'),
(3,'Journée sportive','2026-11-08 04:04:24','Toulon',NULL,40,1,5.00,1,'2026-09-14 12:28:15','2026-09-14 12:28:16'),
(4,'Gala de fin d\'année','2026-11-13 09:27:32','La Garde',NULL,117,0,NULL,1,'2026-09-14 12:28:15','2026-09-14 12:28:16'),
(5,'Gala de fin d\'année','2026-10-17 01:03:56','La Garde',NULL,NULL,0,NULL,1,'2026-09-14 12:28:15','2026-09-14 12:28:16');
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
-- Table structure for table `invitations`
--

DROP TABLE IF EXISTS `invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `invitations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(64) NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `expires_at` datetime NOT NULL,
  `used_at` datetime DEFAULT NULL,
  `used_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invitations_token_unique` (`token`),
  KEY `invitations_created_by_foreign` (`created_by`),
  KEY `invitations_used_by_foreign` (`used_by`),
  CONSTRAINT `invitations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invitations_used_by_foreign` FOREIGN KEY (`used_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invitations`
--

LOCK TABLES `invitations` WRITE;
/*!40000 ALTER TABLE `invitations` DISABLE KEYS */;
/*!40000 ALTER TABLE `invitations` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
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
(7,'2026_09_14_104412_create_participations_table',1),
(8,'2026_09_14_140716_add_payant_prix_to_evenements_table',1),
(9,'2026_09_14_140717_add_paye_to_participations_table',1),
(10,'2026_09_14_140718_add_role_to_users_table',1),
(11,'2026_09_14_142533_create_invitations_table',1);
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
  `paye` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `participations_etudiant_id_evenement_id_unique` (`etudiant_id`,`evenement_id`),
  KEY `participations_evenement_id_foreign` (`evenement_id`),
  CONSTRAINT `participations_etudiant_id_foreign` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE,
  CONSTRAINT `participations_evenement_id_foreign` FOREIGN KEY (`evenement_id`) REFERENCES `evenements` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participations`
--

LOCK TABLES `participations` WRITE;
/*!40000 ALTER TABLE `participations` DISABLE KEYS */;
INSERT INTO `participations` VALUES
(1,4,1,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(2,5,1,1,1,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(3,6,1,1,1,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(4,9,1,0,1,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(5,10,1,0,1,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(6,13,1,1,1,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(7,14,1,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(8,15,1,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(9,17,1,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(10,18,1,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(11,19,1,1,1,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(12,20,1,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(13,25,1,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(14,27,1,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(15,2,2,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(16,3,2,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(17,4,2,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(18,6,2,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(19,8,2,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(20,9,2,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(21,13,2,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(22,18,2,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(23,6,3,1,1,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(24,12,3,1,1,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(25,13,3,0,1,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(26,16,3,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(27,18,3,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(28,22,3,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(29,25,3,0,1,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(30,26,3,1,1,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(31,30,3,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(32,3,4,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(33,9,4,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(34,10,4,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(35,17,4,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(36,21,4,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(37,22,4,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(38,26,4,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(39,29,4,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(40,30,4,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(41,7,5,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(42,15,5,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(43,16,5,0,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(44,17,5,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16'),
(45,20,5,1,0,'2026-09-14 12:28:16','2026-09-14 12:28:16');
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
  `role` enum('admin','membre') NOT NULL DEFAULT 'membre',
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
(1,'Membre BDE (démo)','demo@bde.local','admin','2026-09-14 12:28:15','$2y$12$012TvkUa/eD63Na00eA1oOoUPq8HZ2GnQxGnYp0gGVF9rvNwvZx6e',NULL,0,'e9ch6oITBB','2026-09-14 12:28:15','2026-09-14 12:28:15');
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

-- Dump completed on 2026-09-14 16:28:16
