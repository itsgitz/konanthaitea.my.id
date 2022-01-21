-- MariaDB dump 10.19  Distrib 10.6.3-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: minuman_tile
-- ------------------------------------------------------
-- Server version	10.6.3-MariaDB-1:10.6.3+maria~focal

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
-- Current Database: `minuman_tile`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `minuman_tile` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `minuman_tile`;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Admin Minuman','admin@minuman.com',NULL,'$2y$10$JfjgcnDcnPgtkMxBQmmSLeULleanrAemDgGWykEM8ms1voQ.FMnIa',NULL,'2022-01-05 09:54:39','2022-01-05 09:54:39');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_orders`
--

DROP TABLE IF EXISTS `cart_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `cart_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_orders`
--

LOCK TABLES `cart_orders` WRITE;
/*!40000 ALTER TABLE `cart_orders` DISABLE KEYS */;
INSERT INTO `cart_orders` VALUES (1,1,1,'2022-01-05 09:57:03','2022-01-05 09:57:03'),(2,2,2,'2022-01-05 09:58:57','2022-01-05 09:58:57'),(3,3,3,'2022-01-09 09:31:25','2022-01-09 09:31:25'),(4,4,4,'2022-01-09 09:49:10','2022-01-09 09:49:10'),(5,5,5,'2022-01-09 09:52:22','2022-01-09 09:52:22'),(6,6,6,'2022-01-09 11:31:45','2022-01-09 11:31:45'),(7,7,7,'2022-01-09 13:00:08','2022-01-09 13:00:08'),(8,8,8,'2022-01-09 13:08:21','2022-01-09 13:08:21'),(9,9,9,'2022-01-09 13:43:46','2022-01-09 13:43:46'),(10,10,10,'2022-01-10 11:13:50','2022-01-10 11:13:50'),(11,11,11,'2022-01-10 11:26:36','2022-01-10 11:26:36'),(12,11,12,'2022-01-10 11:26:36','2022-01-10 11:26:36'),(13,12,13,'2022-01-10 12:26:50','2022-01-10 12:26:50'),(14,13,14,'2022-01-10 12:50:38','2022-01-10 12:50:38'),(15,14,15,'2022-01-10 13:09:00','2022-01-10 13:09:00'),(16,15,16,'2022-01-10 13:12:20','2022-01-10 13:12:20'),(17,16,17,'2022-01-10 13:15:04','2022-01-10 13:15:04'),(18,17,18,'2022-01-10 19:43:56','2022-01-10 19:43:56'),(19,18,20,'2022-01-18 11:39:39','2022-01-18 11:39:39');
/*!40000 ALTER TABLE `cart_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `menu_id` bigint(20) unsigned NOT NULL,
  `status` enum('On Cart','Finish') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` bigint(20) unsigned NOT NULL,
  `subtotal_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (1,1,1,'Finish',10,150000.00,'2022-01-05 09:56:54','2022-01-05 09:57:03'),(2,1,1,'Finish',2,30000.00,'2022-01-05 09:58:42','2022-01-05 09:58:57'),(3,1,1,'Finish',8,120000.00,'2022-01-09 09:31:15','2022-01-09 09:31:25'),(4,1,2,'Finish',5,75000.00,'2022-01-09 09:49:03','2022-01-09 09:49:10'),(5,1,2,'Finish',5,75000.00,'2022-01-09 09:51:55','2022-01-09 09:52:22'),(6,1,2,'Finish',5,75000.00,'2022-01-09 11:31:23','2022-01-09 11:31:45'),(7,1,1,'Finish',1,15000.00,'2022-01-09 13:00:01','2022-01-09 13:00:08'),(8,1,1,'Finish',5,75000.00,'2022-01-09 13:08:13','2022-01-09 13:08:21'),(9,1,2,'Finish',10,150000.00,'2022-01-09 13:43:36','2022-01-09 13:43:46'),(10,1,1,'Finish',1,15000.00,'2022-01-10 08:26:50','2022-01-10 11:13:50'),(11,1,2,'Finish',1,15000.00,'2022-01-10 11:26:06','2022-01-10 11:26:36'),(12,1,1,'Finish',1,15000.00,'2022-01-10 11:26:22','2022-01-10 11:26:36'),(13,1,1,'Finish',1,15000.00,'2022-01-10 12:26:39','2022-01-10 12:26:50'),(14,1,2,'Finish',1,15000.00,'2022-01-10 12:50:33','2022-01-10 12:50:38'),(15,1,1,'Finish',1,15000.00,'2022-01-10 13:08:54','2022-01-10 13:09:00'),(16,1,1,'Finish',1,15000.00,'2022-01-10 13:12:16','2022-01-10 13:12:20'),(17,1,1,'Finish',1,15000.00,'2022-01-10 13:15:00','2022-01-10 13:15:04'),(18,1,2,'Finish',1,15000.00,'2022-01-10 19:33:13','2022-01-10 19:43:56'),(20,1,1,'Finish',1,15000.00,'2022-01-18 11:39:30','2022-01-18 11:39:39');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Tile Leti','tile@gmail.com',NULL,'$2y$10$s/BlDzP5tubAUWeRenwpWu3duMjdPgluvmmcybZwZMfbln7dWyAjy',NULL,'2022-01-05 09:54:39','2022-01-05 09:54:39');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `menu_stocks`
--

DROP TABLE IF EXISTS `menu_stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) unsigned NOT NULL,
  `stock_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_stocks`
--

LOCK TABLES `menu_stocks` WRITE;
/*!40000 ALTER TABLE `menu_stocks` DISABLE KEYS */;
INSERT INTO `menu_stocks` VALUES (1,1,3,5,'2022-01-05 09:56:46','2022-01-05 09:56:46'),(2,1,1,5,'2022-01-05 09:56:46','2022-01-05 09:56:46'),(3,1,2,1,'2022-01-05 09:56:46','2022-01-09 13:00:39'),(4,2,3,10,'2022-01-09 07:18:18','2022-01-09 07:18:18'),(5,2,1,10,'2022-01-09 07:18:18','2022-01-09 07:18:18'),(6,2,2,1,'2022-01-09 07:18:18','2022-01-09 07:18:18');
/*!40000 ALTER TABLE `menu_stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('Available','Sold Out') COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Blueberry Hot',15000.00,3,'Available','/storage/menus/TRr5FUHWA00PF9WXSEwb50EHTchRjTGvbspDpeEp.png','2022-01-05 09:56:46','2022-01-18 11:39:39'),(2,'Durian Hot',15000.00,2,'Sold Out','/storage/menus/pn8z8yXsH017W1XgqfYIZlc0A5mtir3Fphj9fZB6.png','2022-01-09 07:18:18','2022-01-11 21:15:01');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2021_10_31_144244_create_admins_table',1),(6,'2021_10_31_144623_create_clients_table',1),(7,'2021_10_31_232649_create_stocks_table',1),(8,'2021_10_31_233011_create_menus_table',1),(9,'2021_11_01_152310_create_orders_table',1),(10,'2021_11_01_153015_create_menu_stocks_table',1),(11,'2021_11_14_113951_create_carts_table',1),(12,'2021_11_19_015504_create_cart_orders_table',1),(13,'2021_11_20_020836_create_stock_units_table',1),(14,'2021_11_26_211858_create_restock_histories_table',1),(15,'2022_01_09_072719_add_address_to_orders_table',2),(16,'2022_01_09_074757_update_payment_status_and_delivery_status_columns_to_orders_table',3),(17,'2022_01_10_191620_add_phone_number_to_orders_table',4),(18,'2022_01_10_192122_add_phone_number_to_orders_table',5),(19,'2022_01_10_192643_add_phone_number_to_orders_table',6),(20,'2022_01_10_192756_add_phone_number_to_orders_table',7),(21,'2022_01_17_185514_update_limited_status_on_stocks_table',8),(22,'2022_01_18_003131_create_request_stocks_table',9),(23,'2022_01_18_030919_add_status_to_request_stocks_table',10),(24,'2022_01_18_041621_add_finish_status_to_request_stocks',11),(25,'2022_01_18_042301_add_price_to_request_stocks',12);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('Paid','Unpaid','Canceled') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` enum('Bank Transfer','E-money') COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_method` enum('Pickup','Delivery') COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_status` enum('Waiting','Confirmed','On Progress','Ready','Delivery','Finish','Failed','Canceled') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,150000.00,'Paid','Bank Transfer','Pickup','Ready',NULL,NULL,'2022-01-05 09:57:03','2022-01-05 09:58:09'),(2,1,30000.00,'Paid','Bank Transfer','Pickup','Ready',NULL,NULL,'2022-01-05 09:58:57','2022-01-09 09:51:18'),(3,1,120000.00,'Paid','Bank Transfer','Delivery','Finish',NULL,NULL,'2022-01-09 09:31:25','2022-01-09 09:51:29'),(4,1,75000.00,'Paid','Bank Transfer','Pickup','Ready',NULL,NULL,'2022-01-09 09:49:10','2022-01-09 09:51:42'),(5,1,75000.00,'Paid','Bank Transfer','Pickup','Ready',NULL,NULL,'2022-01-09 09:52:22','2022-01-09 13:14:53'),(6,1,75000.00,'Paid','Bank Transfer','Pickup','Ready',NULL,NULL,'2022-01-09 11:31:45','2022-01-09 13:14:46'),(7,1,15000.00,'Paid','Bank Transfer','Pickup','Ready',NULL,NULL,'2022-01-09 13:00:08','2022-01-09 13:14:39'),(8,1,75000.00,'Paid','Bank Transfer','Pickup','Ready',NULL,NULL,'2022-01-09 13:08:21','2022-01-09 13:13:08'),(9,1,150000.00,'Paid','Bank Transfer','Pickup','Ready',NULL,NULL,'2022-01-09 13:43:46','2022-01-10 11:14:39'),(10,1,26000.00,'Paid','Bank Transfer','Delivery','Finish',NULL,'Jalan Taman Sari no.6','2022-01-10 11:13:50','2022-01-10 11:23:29'),(11,1,41000.00,'Paid','Bank Transfer','Delivery','Finish',NULL,'Jalan Kebon Rumput no. 6A','2022-01-10 11:26:36','2022-01-10 12:19:18'),(12,1,26000.00,'Canceled','Bank Transfer','Delivery','Canceled',NULL,'Jalan Kebon Rumput no. 6A','2022-01-10 12:26:50','2022-01-10 12:27:06'),(13,1,15000.00,'Canceled','E-money','Pickup','Canceled',NULL,NULL,'2022-01-10 12:50:38','2022-01-10 13:05:39'),(14,1,15000.00,'Canceled','Bank Transfer','Pickup','Canceled',NULL,NULL,'2022-01-10 13:09:00','2022-01-10 13:10:20'),(15,1,15000.00,'Canceled','Bank Transfer','Pickup','Canceled',NULL,NULL,'2022-01-10 13:12:20','2022-01-10 13:12:45'),(16,1,15000.00,'Canceled','Bank Transfer','Pickup','Canceled',NULL,NULL,'2022-01-10 13:15:04','2022-01-10 13:15:29'),(17,1,15000.00,'Canceled','Bank Transfer','Delivery','Failed','08134567890','Jalan Kebon Rumput no. 6A','2022-01-10 19:43:56','2022-01-18 12:31:21'),(18,1,15000.00,'Canceled','Bank Transfer','Pickup','Canceled',NULL,NULL,'2022-01-18 11:39:39','2022-01-18 12:32:42');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_stocks`
--

DROP TABLE IF EXISTS `request_stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_id` bigint(20) unsigned NOT NULL,
  `request_quantity` int(11) NOT NULL,
  `processed_quantity` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Accepted','Not Accepted','Finish') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_stocks`
--

LOCK TABLES `request_stocks` WRITE;
/*!40000 ALTER TABLE `request_stocks` DISABLE KEYS */;
INSERT INTO `request_stocks` VALUES (1,'rs-18012022042001000000',1,100,100,NULL,'Finish',NULL,'2022-01-18 01:46:07','2022-01-18 04:35:25'),(2,'rs-18012022042001000000',3,150,100,'Kurang','Finish',NULL,'2022-01-18 01:46:07','2022-01-18 04:35:25'),(3,'rs-18012022043901000000',2,50,50,NULL,'Finish',NULL,'2022-01-18 04:40:40','2022-01-18 04:48:00'),(4,'rs-18012022043901000000',4,50,50,NULL,'Finish',NULL,'2022-01-18 04:40:40','2022-01-18 04:48:00'),(5,'rs-18012022044301000000',3,100,100,NULL,'Finish',NULL,'2022-01-18 04:43:01','2022-01-18 04:50:07'),(6,'rs-18012022044705000000',1,50,50,NULL,'Finish',NULL,'2022-01-18 04:47:05','2022-01-18 04:50:48'),(7,'rs-18012022044705000000',5,500,500,NULL,'Finish',NULL,'2022-01-18 04:47:05','2022-01-18 04:50:48'),(8,'rs-18012022120736000000',1,1000,1000,NULL,'Finish',NULL,'2022-01-18 12:07:36','2022-01-18 12:08:28'),(9,'rs-18012022120736000000',3,1000,1000,NULL,'Finish',NULL,'2022-01-18 12:07:36','2022-01-18 12:08:28');
/*!40000 ALTER TABLE `request_stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restock_histories`
--

DROP TABLE IF EXISTS `restock_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restock_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stock_id` bigint(20) unsigned NOT NULL,
  `stock_units_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `invoice_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restock_histories`
--

LOCK TABLES `restock_histories` WRITE;
/*!40000 ALTER TABLE `restock_histories` DISABLE KEYS */;
INSERT INTO `restock_histories` VALUES (1,1,2,'Gula',10,60000.00,'/storage/invoices/XJWLGBQax037agOeclt2pMt5InYGL2qGLAYKyh9a.jpg','2022-01-05 09:55:07','2022-01-05 09:55:07'),(2,2,3,'Sedotan',10,5000.00,'/storage/invoices/TwWSqk5txsMn6kmVOZ0eSDeALdzVhhN6QYVmpOvu.jpg','2022-01-05 09:55:39','2022-01-05 09:55:39'),(3,3,1,'Air',10,1000.00,'/storage/invoices/sMiTxv2PwHCEGBrVP6eK4lWARqzkKU5AgkUGuo7z.jpg','2022-01-05 09:56:02','2022-01-05 09:56:02'),(4,3,1,'Air',50,1000.00,'/storage/invoices/2Ltlk3WMsDbDhCeljuHQn3aatoHNsydwJfiRBi92.jpg','2022-01-05 09:57:35','2022-01-05 09:57:35'),(5,1,2,'Gula',50,1000.00,'/storage/invoices/UIg9VHiVFI50QGZoKDJVXyN9x34k6oFohpNgFnJf.jpg','2022-01-05 09:57:44','2022-01-05 09:57:44'),(6,2,3,'Sedotan',50,1000.00,'/storage/invoices/MoG3nrk05nYuL4Q51LaJScR405RP3Re9wTFFABTM.jpg','2022-01-05 09:57:51','2022-01-05 09:57:51'),(7,3,1,'Air',10,15000.00,'/storage/invoices/HszJagQwtjx4uQ1U4kpQugYMeaS6PgufhXjwttt2.png','2022-01-08 21:53:12','2022-01-08 21:53:12'),(8,1,2,'Gula',10,5000.00,'/storage/invoices/pYucOtmtUZoNv9LEWflNMgIRGUwYTkjAjgAqk5Qn.png','2022-01-09 09:29:48','2022-01-09 09:29:48'),(9,2,3,'Sedotan',10,5000.00,'/storage/invoices/5q1mATXSFZNLCr0H4mGtpuSULjB6BGdwDFrisNQy.png','2022-01-09 09:30:45','2022-01-09 09:30:45'),(10,3,1,'Air',40,10.00,'/storage/invoices/KgxOrBSn1I4RzLIMTzZwHjfKH2uFgiBKQHCNXbpl.png','2022-01-09 09:47:04','2022-01-09 09:47:04'),(11,1,2,'Gula',40,1000.00,'/storage/invoices/qgHrUOhnIUCY2YksXghhchFbl2aN8IWTBVFMH4Sb.png','2022-01-09 09:47:20','2022-01-09 09:47:20'),(12,2,3,'Sedotan',40,1000.00,'/storage/invoices/wlaCm8a5n1TgnHbkfGYSEcrOif54BI6SYyytNLvI.png','2022-01-09 09:47:56','2022-01-09 09:47:56'),(13,1,2,'Gula',50,100.00,'/storage/invoices/rAGkpbX2A77vX3x4C0IHx44noDjCmW31EjBQ4BiW.png','2022-01-09 09:49:40','2022-01-09 09:49:40'),(14,3,1,'Air',50,15000.00,'/storage/invoices/jyhJjKPq7JkilY0LOPQzlLR9abOrRTiQShIt7woz.png','2022-01-09 09:50:55','2022-01-09 09:50:55'),(15,3,1,'Air',40,15000.00,'/storage/invoices/S30ZPCZ3IrE1ZiMCnMpVeRMPcHmJiDLfiBNElPh2.png','2022-01-09 11:30:27','2022-01-09 11:30:27'),(16,3,1,'Air',10,1500.00,'/storage/invoices/DcWoImZZfd0hIVc2Jn4SRiMVnsYN2rpuk0rlr8j6.png','2022-01-09 11:30:46','2022-01-09 11:30:46'),(17,1,2,'Gula',50,1500.00,'/storage/invoices/BNdayujdG0jNugQ4pW6oGOgku1gQWdfZgEsnQaJo.png','2022-01-09 11:30:54','2022-01-09 11:30:54'),(18,2,3,'Sedotan',5,1000.00,'/storage/invoices/bbENkkaQzql35sjA77kKLt0iMxASDw67FuPcaDLJ.png','2022-01-09 11:31:04','2022-01-09 11:31:04'),(19,3,1,'Air',50,100.00,'/storage/invoices/rfOVWqJPq2tjIwTalYsONG8y33pqnKq2VyDYDfTc.png','2022-01-09 12:49:14','2022-01-09 12:49:14'),(20,1,2,'Gula',50,1000.00,'/storage/invoices/ZkqwGKuYM76KJtUtRqUFme011v9bIrwN010wUIrR.png','2022-01-09 12:49:23','2022-01-09 12:49:23'),(21,2,3,'Sedotan',5,1500.00,'/storage/invoices/Qk7fZKAfvwgpK2crptH4Q7C84bL1MarYfEh1uCII.png','2022-01-09 12:49:41','2022-01-09 12:49:41'),(22,2,3,'Sedotan',5,1000.00,'/storage/invoices/47Y5QAqyAlrflB5XDyUdsEU9bXKxYjmxxWxNGDtn.png','2022-01-09 13:00:30','2022-01-09 13:00:30'),(23,3,1,'Air',20,15000.00,'/storage/invoices/taiV4v1wu8PA92y5BSXicBzkwfmSihQTuIcdFMks.png','2022-01-09 13:09:55','2022-01-09 13:09:55'),(24,1,2,'Gula',20,1500.00,'/storage/invoices/t6pYQ223IM8WuhVcOkpggQ4DKtqdGeQamjxpHu7V.png','2022-01-09 13:10:14','2022-01-09 13:10:14'),(25,3,1,'Air',10,10.00,'/storage/invoices/vUQcsPA9iDxmvkUOiOyO4PAmUBwUECIO6M3lz0sQ.png','2022-01-09 13:14:08','2022-01-09 13:14:08'),(26,1,2,'Gula',10,5000.00,'/storage/invoices/4ooTtyRfxiW0a8NmR4OJ2uAnOew7eyAIqp6YLQVb.png','2022-01-09 13:14:22','2022-01-09 13:14:22'),(27,2,3,'Sedotan',50,1000.00,'/storage/invoices/fNR9dghATlPTLPZKm6LZdlGlxsP6UMlquQwkKhvn.png','2022-01-09 13:14:30','2022-01-09 13:14:30'),(28,3,1,'Air',100,5000.00,'/storage/invoices/vYbOlC05iRggHSsLrrLlKHK9XsPgeM0mn442NuYu.png','2022-01-09 13:44:25','2022-01-09 13:44:25'),(29,1,2,'Gula',100,10000.00,'/storage/invoices/GN4dEm1i6APImlUMhudZW7uUPYOZu4Xjyy8cmYNf.png','2022-01-09 13:45:10','2022-01-09 13:45:10'),(30,3,1,'Air',20,15000.00,'/storage/invoices/ZgNenqcrCaiYDsENWaYkGpdTl8infZM9MfCbIF09.png','2022-01-10 12:17:32','2022-01-10 12:17:32'),(31,1,2,'Gula',20,15000.00,'/storage/invoices/xBw2gtvI1sIqMjPM129W0u2uvFo8RyeIuQtlTtyK.png','2022-01-10 12:17:47','2022-01-10 12:17:47'),(32,3,1,'Air',10,1000.00,'/storage/invoices/NyzTVycbhIqtDNYgPZWphWhBSZb2jPe6lIwqtgzS.png','2022-01-10 13:08:22','2022-01-10 13:08:22'),(33,1,2,'Gula',10,1000.00,'/storage/invoices/jAXj6EjRpZ84Bl8SpKTsYyE1ZiyvQNoxR9QWAHBE.png','2022-01-10 13:08:31','2022-01-10 13:08:31'),(34,3,1,'Air',10,15000.00,'/storage/invoices/zjkiVopIgmKJCF4C70bWoYbHqsncGoeIYzrgcPNE.png','2022-01-10 19:45:52','2022-01-10 19:45:52'),(35,1,2,'Gula',10,1500.00,'/storage/invoices/4VQwOMcn7eFAhanpZeBI7HMikGfWOI3jGVoWSyxA.png','2022-01-10 19:45:59','2022-01-10 19:45:59'),(36,4,3,'Botol',10,150000.00,'/storage/invoices/gZPvWdeaPrPredltYGU7mdMouSd7l5TRDgeLb2lj.png','2022-01-17 21:58:53','2022-01-17 21:58:53'),(37,5,2,'Gula Aren',1000,50000.00,'/storage/invoices/p4f9QuPsE0gBn15K32ZOR0H2tbHCHdeKCBjRX8Vl.png','2022-01-17 22:06:17','2022-01-17 22:06:17'),(38,3,1,'Air',50,150000.00,'/storage/invoices/HDf8WFgQvSLkVLDlczoX5IGuai6MB3XdenF4qQY1.png','2022-01-17 22:06:47','2022-01-17 22:06:47'),(39,2,3,'Sedotan',15,100000.00,'/storage/invoices/FRseFUYdR7SJk94RMXTNj8WEgGBTQwhXipj9CQaa.png','2022-01-17 22:07:03','2022-01-17 22:07:03'),(40,1,2,'Gula',15,10000.00,'/storage/invoices/D1Ms1fnwNBs20HyAVrEbsZPu9EVvZZM02LIlScK0.png','2022-01-17 22:07:16','2022-01-17 22:07:16'),(41,4,3,'Botol',10,15000.00,'/storage/invoices/ObCT1hj4AS2JgGJsNnVypo5wkVoVhKd0CBnIf6EV.png','2022-01-17 22:10:36','2022-01-17 22:10:36'),(42,4,3,'Botol',10,50000.00,'/storage/invoices/z1OipdWKo4nUZvFD29RmkU5MMvhTbACtV5T4rSA8.png','2022-01-17 22:12:06','2022-01-17 22:12:06'),(43,2,3,'Sedotan',10,1000.00,'/storage/invoices/weubk6JEgar1uOE6LnL7BEsYpvDrhQ03yltSjnfK.png','2022-01-18 01:44:41','2022-01-18 01:44:41'),(44,3,1,'Air',100,50000.00,'/storage/invoices/wtdFp7NeRAJ1DUEqc0iDnaXcZx1ybUuw1HoJXJgp.png','2022-01-18 04:35:25','2022-01-18 04:35:25'),(45,1,2,'Gula',100,50000.00,'/storage/invoices/wtdFp7NeRAJ1DUEqc0iDnaXcZx1ybUuw1HoJXJgp.png','2022-01-18 04:35:25','2022-01-18 04:35:25'),(46,2,3,'Sedotan',50,15000.00,'/storage/invoices/J7Q99JtQep553AEYdWkNTfWiT8llauiZwodlM9v8.png','2022-01-18 04:48:00','2022-01-18 04:48:00'),(47,4,3,'Botol',50,15000.00,'/storage/invoices/J7Q99JtQep553AEYdWkNTfWiT8llauiZwodlM9v8.png','2022-01-18 04:48:00','2022-01-18 04:48:00'),(48,3,1,'Air',100,5000.00,'/storage/invoices/cARO3AIznkAwnvwbh424OUoAsGkg9c5VSAdztdBc.png','2022-01-18 04:50:07','2022-01-18 04:50:07'),(49,1,2,'Gula',50,5000.00,'/storage/invoices/FfvDCxpqtPod8agWdtcTutpbELage0IrBo5aiHRV.png','2022-01-18 04:50:48','2022-01-18 04:50:48'),(50,5,2,'Gula Aren',500,5000.00,'/storage/invoices/FfvDCxpqtPod8agWdtcTutpbELage0IrBo5aiHRV.png','2022-01-18 04:50:48','2022-01-18 04:50:48'),(51,1,2,'Gula',1000,50000.00,'/storage/invoices/7of2wrtiL0tKbNMETbtRFzd0xMc8SKECALqGyYNj.png','2022-01-18 12:08:28','2022-01-18 12:08:28'),(52,3,1,'Air',1000,50000.00,'/storage/invoices/7of2wrtiL0tKbNMETbtRFzd0xMc8SKECALqGyYNj.png','2022-01-18 12:08:28','2022-01-18 12:08:28');
/*!40000 ALTER TABLE `restock_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_units`
--

DROP TABLE IF EXISTS `stock_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_units`
--

LOCK TABLES `stock_units` WRITE;
/*!40000 ALTER TABLE `stock_units` DISABLE KEYS */;
INSERT INTO `stock_units` VALUES (1,'Mililiter','2022-01-05 09:54:39','2022-01-05 09:54:39'),(2,'Gram','2022-01-05 09:54:39','2022-01-05 09:54:39'),(3,'Buah','2022-01-05 09:55:24','2022-01-05 09:55:24');
/*!40000 ALTER TABLE `stock_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stock_units_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('Available','Not Available','Limited') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocks`
--

LOCK TABLES `stocks` WRITE;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` VALUES (1,2,'Gula',1205,'Available','2022-01-05 09:55:07','2022-01-18 12:32:42'),(2,3,'Sedotan',113,'Available','2022-01-05 09:55:39','2022-01-18 12:32:42'),(3,1,'Air',1290,'Available','2022-01-05 09:56:02','2022-01-18 12:32:42'),(4,3,'Botol',80,'Available','2022-01-17 21:58:53','2022-01-18 11:43:26'),(5,2,'Gula Aren',1500,'Available','2022-01-17 22:06:17','2022-01-18 04:50:48');
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-20 15:58:56
