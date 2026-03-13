-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: dhardhes_ops
-- ------------------------------------------------------
-- Server version	8.0.45-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attendance_logs`
--

DROP TABLE IF EXISTS `attendance_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `work_minutes` int DEFAULT NULL,
  `overtime_minutes` int NOT NULL DEFAULT '0',
  `late_minutes` int NOT NULL DEFAULT '0',
  `overtime_decimal` decimal(5,2) NOT NULL DEFAULT '0.00',
  `late_decimal` decimal(5,2) NOT NULL DEFAULT '0.00',
  `daily_salary` int NOT NULL,
  `extra_job_salary` int NOT NULL DEFAULT '0',
  `meal_allowance` int NOT NULL DEFAULT '0',
  `daily_total` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `salary_paid` tinyint(1) DEFAULT '0',
  `loan_deduction` int DEFAULT '0',
  `salary_paid_at` datetime DEFAULT NULL,
  `bonus_amount` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_employee_date` (`employee_id`,`date`),
  KEY `idx_employee_date` (`employee_id`,`date`)
) ENGINE=InnoDB AUTO_INCREMENT=897 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_logs`
--

LOCK TABLES `attendance_logs` WRITE;
/*!40000 ALTER TABLE `attendance_logs` DISABLE KEYS */;
INSERT INTO `attendance_logs` VALUES (869,3,'2026-03-11',NULL,'16:31:00',0,0,0,0.00,0.00,40000,10000,5000,0,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(870,3,'2026-03-01',NULL,NULL,0,0,0,0.00,0.00,40000,10000,5000,0,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(871,3,'2026-03-02','07:12:00','15:19:00',487,0,0,0.00,0.00,40000,10000,5000,55000,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(872,3,'2026-03-03','07:15:00','15:38:00',503,30,0,0.50,0.00,40000,10000,5000,58000,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(873,3,'2026-03-04','07:15:00','16:02:00',527,45,0,0.75,0.00,40000,10000,5000,59500,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(874,3,'2026-03-05','07:18:00','15:32:00',494,15,0,0.25,0.00,40000,10000,5000,56500,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(875,3,'2026-03-06','07:14:00','16:14:00',540,60,0,1.00,0.00,40000,10000,5000,61000,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(876,3,'2026-03-07','03:36:00','15:47:00',731,60,0,1.00,0.00,40000,10000,5000,61000,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(877,3,'2026-03-08',NULL,NULL,0,0,0,0.00,0.00,40000,10000,5000,0,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(878,3,'2026-03-09',NULL,NULL,0,0,0,0.00,0.00,40000,10000,5000,0,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(879,3,'2026-03-10','07:19:00','16:01:00',522,45,0,0.75,0.00,40000,10000,5000,59500,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(880,3,'2026-03-12','07:16:00','15:52:00',516,30,0,0.50,0.00,40000,10000,5000,58000,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(881,3,'2026-03-13','07:13:00','16:07:00',534,60,0,1.00,0.00,40000,10000,5000,61000,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(882,3,'2026-03-14','07:26:00','16:14:00',528,45,0,0.75,0.00,40000,10000,5000,59500,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(883,3,'2026-03-15',NULL,NULL,0,0,0,0.00,0.00,40000,10000,5000,0,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(884,3,'2026-03-16','03:36:00','16:14:00',758,60,0,1.00,0.00,40000,10000,5000,61000,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(885,3,'2026-03-17',NULL,NULL,0,0,0,0.00,0.00,40000,10000,5000,0,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(886,3,'2026-03-18',NULL,NULL,0,0,0,0.00,0.00,40000,10000,5000,0,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(887,3,'2026-03-19','06:32:00','14:03:00',451,0,30,0.00,0.50,40000,10000,5000,53000,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(888,3,'2026-03-20','06:35:00','15:12:00',517,30,0,0.50,0.00,40000,10000,5000,58000,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(889,3,'2026-03-21','07:11:00','15:26:00',495,15,0,0.25,0.00,40000,10000,5000,56500,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(890,3,'2026-03-22',NULL,NULL,0,0,0,0.00,0.00,40000,10000,5000,0,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(891,3,'2026-03-23','07:38:00','15:48:00',490,15,0,0.25,0.00,40000,10000,5000,56500,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(892,3,'2026-03-24',NULL,NULL,0,0,0,0.00,0.00,40000,10000,5000,0,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(893,3,'2026-03-25',NULL,NULL,0,0,0,0.00,0.00,40000,10000,5000,0,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(894,3,'2026-03-26',NULL,NULL,0,0,0,0.00,0.00,40000,10000,5000,0,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(895,3,'2026-03-27',NULL,NULL,0,0,0,0.00,0.00,40000,10000,5000,0,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000),(896,3,'2026-03-28',NULL,NULL,0,0,0,0.00,0.00,40000,10000,5000,0,'2026-03-13 04:20:18','2026-03-13 04:20:18',0,0,NULL,26000);
/*!40000 ALTER TABLE `attendance_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
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
-- Table structure for table `employee_cash_loans`
--

DROP TABLE IF EXISTS `employee_cash_loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee_cash_loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint unsigned NOT NULL,
  `loan_date` date NOT NULL,
  `amount` int NOT NULL,
  `paid_amount` int NOT NULL DEFAULT '0',
  `remaining_amount` int NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_cash_loans_employee_id_foreign` (`employee_id`),
  CONSTRAINT `employee_cash_loans_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_cash_loans`
--

LOCK TABLES `employee_cash_loans` WRITE;
/*!40000 ALTER TABLE `employee_cash_loans` DISABLE KEYS */;
INSERT INTO `employee_cash_loans` VALUES (1,1,'2026-03-12',200000,200000,0,'Testing','paid','2026-03-12 16:31:05','2026-03-12 16:39:35'),(2,3,'2026-02-12',200000,200000,0,'test','paid','2026-03-12 16:55:01','2026-03-12 16:55:03'),(3,3,'2026-03-13',300000,300000,0,'Transfer','paid','2026-03-12 18:58:11','2026-03-12 18:58:28'),(4,3,'2026-03-12',300000,300000,0,'Transfer','paid','2026-03-12 19:10:06','2026-03-12 19:10:27'),(5,3,'2026-03-11',300000,300000,0,'Transfer','paid','2026-03-12 19:32:02','2026-03-12 19:32:57'),(6,3,'2026-03-11',200000,200000,0,'Transfer','paid','2026-03-12 19:47:01','2026-03-12 19:47:15'),(7,3,'2026-03-11',100000,100000,0,'cash','paid','2026-03-12 19:51:25','2026-03-12 19:51:40'),(8,1,'2026-03-06',200000,200000,0,'cash','paid','2026-03-13 01:25:19','2026-03-13 01:26:03'),(9,3,'2026-03-06',200000,200000,0,'cash','paid','2026-03-13 01:26:21','2026-03-13 01:26:42'),(10,3,'2026-03-03',200000,200000,0,'cash','paid','2026-03-13 01:52:20','2026-03-13 01:57:05'),(11,3,'2026-03-06',300000,300000,0,'cash','paid','2026-03-13 02:19:21','2026-03-13 02:42:10'),(12,3,'2026-03-05',200000,0,200000,'Transfer','active','2026-03-13 04:20:42','2026-03-13 04:20:42');
/*!40000 ALTER TABLE `employee_cash_loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_salary` int NOT NULL,
  `is_admin_gudang` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `extra_job_salary` int NOT NULL DEFAULT '0',
  `meal_allowance` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'Ani',40000,0,'active','2026-03-11 19:32:37','2026-03-12 17:37:00',0,5000),(2,'Wati',45000,0,'active','2026-03-12 07:13:04','2026-03-12 17:37:13',0,5000),(3,'Nita',40000,0,'active','2026-03-12 07:13:17','2026-03-12 17:36:50',10000,5000),(4,'Intan',35000,0,'active','2026-03-12 09:31:17','2026-03-12 17:37:30',0,5000);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_at_available_at_index` (`queue`,`reserved_at`,`available_at`)
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_03_11_171922_create_employees_table',1),(5,'2026_03_11_172518_create_attendance_logs_table',2),(6,'2026_03_12_161246_create_employee_cash_loans_table',3),(7,'2026_03_12_171446_add_extra_salary_to_employees_table',4),(8,'2026_03_12_174541_add_allowances_to_attendance_logs',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
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
INSERT INTO `sessions` VALUES ('3Hfw3fUoAZpdbhMSy3Xnpu8kwy5zW3QScmulfKkQ',NULL,'125.164.233.210','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOU1jR0JIeXZDdDlWWnpndWFSanV4QlhaWjVXclhDa0JRbXlDQXVSaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vb3BzLmRoYXJkaGVzLmNvbS9lbXBsb3llZXMiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1773381831),('hkAHVR3DCWqK2a2n9pRotiDo1H9EQTESnrkcnicw',NULL,'185.177.72.52','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiam1Za1dhcm5QeU53M0hKZVVoU2RKZmRTaWFXRm1RS2FKVm5KTjFIMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vb3BzLmRoYXJkaGVzLmNvbS8/cHA9ZW52IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1773378265),('MiplKsEoWiUxbXGYKsuOP1vg1eSWmSCAcV2wNmy1',NULL,'195.211.77.141','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXdpVnllSERxSUxFbTRxcElkekhtdTl2c3NHSHR5UkdBUk9oV05mbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vb3BzLmRoYXJkaGVzLmNvbSI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1773381335),('qyxMG5P2oMRM3peKxvp4TqtP7SbQiL85g5iWxyeG',NULL,'195.211.77.141','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoiQmMzZHU4WUV2WWROQ25wb0l6MVNodjlzR3NBbWRGclBDZlpvV0YxdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1773381315),('UcRNCG2eheuf2nPWSwAnsKNPtxVBXIn3T6EGLgsJ',NULL,'185.177.72.52','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRTBkQmtyY0Z1V2VKeXg2bXl2eWRTejhuQXQ0cmp3aWFGa2RrOWtxZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vb3BzLmRoYXJkaGVzLmNvbS8/cGhwaW5mbz0xIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1773378265),('vG0w6lMKRlRCzV2u6RWssWbiGNFBkZsQtZhbxgCe',NULL,'185.177.72.52','curl/8.7.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNUNYRlVBOGF4VEhCQ1hpMlNUckNWZlJoOTVGc0x0YVVVUG0wMW9kYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vb3BzLmRoYXJkaGVzLmNvbSI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1773378188);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2026-03-13 13:17:32
