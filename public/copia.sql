-- MySQL dump 10.17  Distrib 10.3.16-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sistemamedico
-- ------------------------------------------------------
-- Server version	10.3.16-MariaDB

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
-- Table structure for table `accidentado`
--

DROP TABLE IF EXISTS `accidentado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accidentado` (
  `paciente_id` bigint(20) unsigned NOT NULL,
  `area_accidente` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region_afectada` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_lesion` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `causa_lesion` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar_accidente` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones_accidente` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `accidentado_paciente_id_foreign` (`paciente_id`),
  CONSTRAINT `accidentado_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accidentado`
--

LOCK TABLES `accidentado` WRITE;
/*!40000 ALTER TABLE `accidentado` DISABLE KEYS */;
INSERT INTO `accidentado` VALUES (15,'Interno','Dedo anular','Fractura','Caída de escaleras','Salón B103','Se mandó a urgencias','2019-10-24 01:55:16','2019-10-24 01:55:16');
/*!40000 ALTER TABLE `accidentado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `afeccion`
--

DROP TABLE IF EXISTS `afeccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `afeccion` (
  `id_afeccion` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_afeccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_afeccion`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `afeccion`
--

LOCK TABLES `afeccion` WRITE;
/*!40000 ALTER TABLE `afeccion` DISABLE KEYS */;
INSERT INTO `afeccion` VALUES (1,'Respiratorias',NULL,NULL),(2,'Digestivas',NULL,NULL),(3,'Osteomusculares',NULL,NULL),(4,'Cardiovasculares',NULL,NULL),(5,'Genito-Urinarias',NULL,NULL),(6,'Dermatológicas',NULL,NULL),(7,'Oftalmológicas',NULL,NULL),(8,'Neurológico',NULL,NULL),(9,'Gineco-Obstetrico',NULL,NULL),(10,'Curación',NULL,NULL),(11,'Planificación Familiar',NULL,NULL),(12,'Aplicación Medicamento',NULL,NULL),(13,'Toma de Presión Arterial',NULL,NULL),(14,'Campaña Mensual',NULL,NULL),(15,'Otros',NULL,NULL);
/*!40000 ALTER TABLE `afeccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrera` (
  `id_carrera` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_carrera` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_carrera`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrera`
--

LOCK TABLES `carrera` WRITE;
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
INSERT INTO `carrera` VALUES (1,'LAG/LAE',NULL,NULL),(2,'IBT',NULL,NULL),(3,'ITA',NULL,NULL),(4,'IIN',NULL,NULL),(5,'IIF/ITI',NULL,NULL),(6,'IFI',NULL,NULL),(7,'IET',NULL,NULL),(8,'ADMINISTRATIVO / PROFESORES / OTROS',NULL,NULL);
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `embarazada`
--

DROP TABLE IF EXISTS `embarazada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `embarazada` (
  `paciente_id` bigint(20) unsigned NOT NULL,
  `control` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comentarios` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_prob_parto` date NOT NULL,
  `f_ingreso` date NOT NULL,
  `semanas_embarazo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `embarazada_paciente_id_foreign` (`paciente_id`),
  CONSTRAINT `embarazada_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `embarazada`
--

LOCK TABLES `embarazada` WRITE;
/*!40000 ALTER TABLE `embarazada` DISABLE KEYS */;
INSERT INTO `embarazada` VALUES (2,'nose','Ninguno','2020-01-22','2019-10-22',8,'2019-10-22 21:58:48','2019-10-22 21:58:48');
/*!40000 ALTER TABLE `embarazada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicamentos` (
  `id_medicamento` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_medicamento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_medicamento`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicamentos`
--

LOCK TABLES `medicamentos` WRITE;
/*!40000 ALTER TABLE `medicamentos` DISABLE KEYS */;
INSERT INTO `medicamentos` VALUES (1,'Caladryl',6,'2019-10-22 21:19:30','2019-10-22 21:19:30'),(2,'Paracetamol',4,'2019-10-22 21:19:42','2019-10-22 21:19:42'),(3,'Ibuprofeno',7,'2019-10-22 21:19:51','2019-10-22 21:19:51'),(4,'Dextrometorfano',3,'2019-10-22 21:19:59','2019-10-22 21:19:59'),(6,'Clonazepam',13,'2019-11-05 17:39:30','2019-11-05 17:39:30');
/*!40000 ALTER TABLE `medicamentos` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000__rol',1),(2,'2014_10_12_200000_create_users_table',1),(3,'2014_10_12_300000_create_password_resets_table',1),(4,'2019_07_29_134136_create_medicamentos_table',1),(5,'2019_07_29_143550_create_afeccion_table',1),(6,'2019_07_29_143551_create_carrera_table',1),(7,'2019_07_29_143552_create_pacientes_table',1),(8,'2019_07_29_145514_create_notas_table',1),(9,'2019_09_20_175514_create_tratamiento_table',1),(13,'2019_10_01_160903_create_embarazada_table',3),(14,'2019_10_22_151257_create_planificador_fam_table',4),(16,'2019_10_23_201043_create_accidentado_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas`
--

DROP TABLE IF EXISTS `notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `asunto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notas_user_id_foreign` (`user_id`),
  CONSTRAINT `notas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas`
--

LOCK TABLES `notas` WRITE;
/*!40000 ALTER TABLE `notas` DISABLE KEYS */;
INSERT INTO `notas` VALUES (2,2,'Viernes de Condones!','asdfds','2019-10-24 02:11:24','2019-10-24 02:11:24'),(4,1,'Wenas Tardes','Ibuuu','2019-11-05 18:53:31','2019-11-05 18:53:31');
/*!40000 ALTER TABLE `notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `id_paciente` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `matricula` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nac` date DEFAULT NULL,
  `area_id` bigint(20) unsigned NOT NULL,
  `diagnostico` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `envio_imss` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_ref` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `afeccion_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_paciente`),
  KEY `pacientes_area_id_foreign` (`area_id`),
  KEY `pacientes_afeccion_id_foreign` (`afeccion_id`),
  KEY `pacientes_user_id_foreign` (`user_id`),
  CONSTRAINT `pacientes_afeccion_id_foreign` FOREIGN KEY (`afeccion_id`) REFERENCES `afeccion` (`id_afeccion`),
  CONSTRAINT `pacientes_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `carrera` (`id_carrera`),
  CONSTRAINT `pacientes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (1,'TCAO150672','Alexa Talamantes','1997-10-22',5,'Cólicos','No','Ninguna',15,1,'2019-10-22 21:16:57','2019-10-22 21:16:57'),(2,'IGMO160477','Fernanda Ibarra Gómez','1996-10-20',2,'Embarazada','No','Ninguna',12,1,'2019-08-22 21:21:06','2019-10-22 21:21:06'),(4,'RCDO150677','Dulce Rivera Carranza','1997-09-28',1,'Embarazo','No','Ninguna',1,1,'2019-10-22 21:32:48','2019-10-22 21:32:48'),(5,'RCEO189574','Eleuteria Rojas Cruz','1960-02-20',8,'Diarreita','No','Ninguna',2,1,'2019-02-23 03:07:05','2019-10-23 02:07:05'),(6,'TCAO150672','Alexa Talamantes','1997-02-24',5,'Aplicación de Implante','No','Ninguna',11,1,'2019-02-23 03:33:04','2019-10-23 02:33:04'),(8,'ULDO141775','Doloooores Umbridge Lopez','1995-05-24',1,'Aplicación de Inyección Anticonceptiva','No','Ninguna',11,1,'2019-07-23 02:58:07','2019-10-23 02:58:07'),(9,'CBMO167892','Maria Corrales Becerraaa','1993-07-14',1,'Aplicación de Implante','No','Ninguna',11,1,'2019-10-23 03:02:13','2019-10-23 03:02:13'),(14,'CMRO142378','Rosalba Cruz Martinez','1993-09-11',4,'Dedo Fracturado','No','Ninguna',10,1,'2019-08-23 20:17:08','2019-10-23 20:17:08'),(15,'TCAO150672','Alexa Haydee Talamantes Cuevas','1997-02-24',6,'Dedo Fracturado','Si','Fractura en el dedo: URGENCIAS.',10,1,'2019-09-23 21:26:17','2019-10-23 21:26:17'),(16,'IGMO160477','Fernandaaa Ibarra Gómez','1996-10-20',1,'Dedo Fracturado','Si','Fractura en el dedo',10,1,'2019-10-24 21:59:39','2019-10-24 21:59:39'),(17,'IGMO160477','Fernanda Ibarra Gómez','1996-10-20',1,'Dedo Fracturado','Si','Fractura en el dedo',10,1,'2018-10-24 22:00:15','2019-10-24 22:00:15'),(18,'CDMO140314','Mirna Cuevas Dominguez','1998-10-04',2,'Dolor de Cabeza','No','Ninguna',15,1,'2019-10-29 01:53:45','2019-10-29 01:53:45');
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
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
-- Table structure for table `planificador_fam`
--

DROP TABLE IF EXISTS `planificador_fam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planificador_fam` (
  `paciente_id` bigint(20) unsigned NOT NULL,
  `nss` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_metodo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_aplicacion` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `planificador_fam_paciente_id_foreign` (`paciente_id`),
  CONSTRAINT `planificador_fam_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planificador_fam`
--

LOCK TABLES `planificador_fam` WRITE;
/*!40000 ALTER TABLE `planificador_fam` DISABLE KEYS */;
INSERT INTO `planificador_fam` VALUES (6,'10169722807','Implante','tcao150672@gmail.com','Normal','2017-07-11','2019-10-23 03:52:24','2019-10-23 03:52:24'),(8,'10169722888','Pastillas','uldo141775.@upemor.edu.mx','Normal','2019-10-23','2019-10-23 05:02:40','2019-10-23 05:02:40'),(9,'11256698742','Implante','cbmo167892.@upemor.edu.mx','Normal','2019-10-23','2019-10-23 05:04:53','2019-10-23 05:04:53');
/*!40000 ALTER TABLE `planificador_fam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'SuperAdministrador','Total control en el  sistema'),(2,'Médico','Control medio del sistema, únicamente no puede registrar nuevos usuarios.');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tratamiento`
--

DROP TABLE IF EXISTS `tratamiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tratamiento` (
  `medicamento_id` bigint(20) unsigned NOT NULL,
  `paciente_id` bigint(20) unsigned NOT NULL,
  `cantidad_medicamento` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `tratamiento_medicamento_id_foreign` (`medicamento_id`),
  KEY `tratamiento_paciente_id_foreign` (`paciente_id`),
  CONSTRAINT `tratamiento_medicamento_id_foreign` FOREIGN KEY (`medicamento_id`) REFERENCES `medicamentos` (`id_medicamento`),
  CONSTRAINT `tratamiento_paciente_id_foreign` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id_paciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tratamiento`
--

LOCK TABLES `tratamiento` WRITE;
/*!40000 ALTER TABLE `tratamiento` DISABLE KEYS */;
INSERT INTO `tratamiento` VALUES (1,1,1,'2019-10-22 21:21:54','2019-10-22 21:21:54'),(3,1,2,'2019-10-22 21:22:18','2019-10-22 21:22:18'),(2,2,1,'2019-10-22 21:22:47','2019-10-22 21:22:47'),(2,8,2,'2019-10-23 02:59:00','2019-10-23 02:59:00'),(2,14,4,'2019-10-23 20:57:35','2019-10-23 20:57:35'),(3,15,2,'2019-10-24 00:42:37','2019-10-24 00:42:37'),(1,2,1,'2019-10-24 00:44:04','2019-10-24 00:44:04'),(2,15,1,'2019-10-24 00:44:31','2019-10-24 00:44:31'),(4,4,1,'2019-10-24 00:49:02','2019-10-24 00:49:02'),(4,15,1,'2019-10-24 00:52:04','2019-10-24 00:52:04'),(1,15,2,'2019-10-24 00:55:36','2019-10-24 00:55:36'),(2,4,2,'2019-10-24 00:55:53','2019-10-24 00:55:53'),(4,2,3,'2019-10-24 00:56:13','2019-10-24 00:56:13'),(3,14,1,'2019-10-24 00:57:23','2019-10-24 00:57:23');
/*!40000 ALTER TABLE `tratamiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol_id` int(10) unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_rol_id_foreign` (`rol_id`),
  CONSTRAINT `users_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Alexa','Talamantes','tcao150672@upemor.edu.mx',NULL,'$2y$12$uLsJyWDXWamX.ADsHWBBw.jjFyRb9Hq4S25Js/n6L/6.o5XPUI2ZK',1,NULL,NULL,NULL),(2,'Mario','Uribe','serviciomedicoam@upemor.edu.mx',NULL,'$2y$10$pq5mBI66BL4vW/WZl82qAenJV2wKFnxolG0RziSEv2cTdPCsuRZ1u',2,NULL,NULL,NULL),(3,'Alejandro','Cuevas Torres','acuevas@gmail.com',NULL,'$2y$10$cv2KbVMnEFSOC5BtPqgPLuCEDiwM85bHNz6Ao2DP8HAxLtOe5i722',2,NULL,'2019-10-30 19:26:53','2019-10-30 19:26:53'),(4,'Camila','Peralta','cperalta@gmail.com',NULL,'$2y$10$i..1cJwF/pk9Ut2NJoArYOkaCphJUWn9XYbJNqaciLZg0KQN9d4VK',2,NULL,'2019-10-30 19:27:21','2019-10-30 19:27:21'),(8,'Camila Nicolle','Peralta','alexa.haydee0115@gmail.com',NULL,'123',2,NULL,'2019-10-31 22:17:27','2019-10-31 22:17:27'),(9,'Jesus Alejandro','Cárdenas Peralta','Sicknessacr@gmail.com',NULL,'alexcardenas',2,NULL,'2019-10-31 23:41:02','2019-10-31 23:41:02');
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

-- Dump completed on 2019-11-06 11:35:06
