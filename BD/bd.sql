-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.4.0.6659
-- --------------------------------------------------------
/*
https://mermaid.live/edit#pako:eNrFV21vmzAQ_ivIn9sqOC8lfN20L5OmfZ4ioSu-UK9gI9u0SdP-95mQNEDshi1ZixRFPD7fPc-dX44NSSVDEpOFQPWVQ6agWIjAPpVGpYOXl-truQlKJdeYGqmDOFiQMP6xII3VYWBn-Qi5VHjaTt79RsMfpU5KxUXKS8gHzEqBobC_bZSddbi3drs8ioe6xJQveTpADQjIueY6WUoGA9klbXJ-42WF6hksV6kMnjYvwCj-nKRQ4FDbEpThdRpSLkV7UrvAm-alfrgwAWfBz-8HSFtHIguEjXoEYgE8P0JL0PpJKnYYMLxAbaAog1QhGGQJmGb0tfnrq3ifUg3V1BOLf3NQlcWdwmTvrUUDVyZgqFPFyzohvZHClvkIfHSBleDMFrpeSEZZPRlPQQ-R2x2tSuZPxn4XnU7FXqgnHVtHFybn3mf_TnWb1b3T_8a1ve1Pc93PO0j8SNbdY-7MzCpc5rjqrONmDmaVMBC6YeqGx2544oanbnjmhm_dcOSG5x45Iw_u0Rl6hIYepaFHaujRGnrEhh61oUdu6NFLPXqpr64evdSjl3r00umF13z3qh2w5nMQ_fWOoipsvHLYsX-5nZoM3qgO0ruTGlJ7kNQ3y2fK6TUlZ1Sh8fRhxNvt0VlleLvU4TPr4OzgzltelkyPfsf7xfdFet-pxI7GA647rAtkvCqaZgvyCrt6cFVyW403eschklymD3pAoB0sn-x3zl8E0ajrFtAVoZf_O561WtNj6zIBxmxPp_vtZD0BMhTmqDzrXLaPg9p9DtokzVFh1ju-5IpkijMSG1XhFSlQ2c7cvpIt5wUx92jbd1J_ADBQD_UXQD2nBPFLymI_TckquyfxEnJt35ri7j4I31CFgqH6Iu0FQGI6pVsnJN6QFYmvQzq6mdMZvZ1ORtE8Go_t8JrEYTS5GUfT2WwUjeY0mlD6ekWet4HDm1k0isZ0Eo0m0_FkSl__APx_eZQ
*/
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para gestion_login
CREATE DATABASE IF NOT EXISTS `gestion_login` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `gestion_login`;

-- Volcando estructura para tabla gestion_login.analisis_foda
CREATE TABLE IF NOT EXISTS `analisis_foda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `tipo` enum('Fuerza','Oportunidad','Debilidad','Amenaza') DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plan_id` (`plan_id`),
  CONSTRAINT `analisis_foda_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `planes_estrategicos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_login.analisis_foda: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gestion_login.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_login.cache: ~4 rows (aproximadamente)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel_cache_asda@adsa|127.0.0.1', 'i:1;', 1744612874),
	('laravel_cache_asda@adsa|127.0.0.1:timer', 'i:1744612874;', 1744612874),
	('laravel_cache_test@example.com|127.0.0.1', 'i:1;', 1744611644),
	('laravel_cache_test@example.com|127.0.0.1:timer', 'i:1744611643;', 1744611644);

-- Volcando estructura para tabla gestion_login.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_login.cache_locks: ~0 rows (aproximadamente)


-- Volcando estructura para tabla gestion_login.fuerzas_porter
CREATE TABLE IF NOT EXISTS `fuerzas_porter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `fuerza` enum('Competidores','Clientes','Proveedores','Sustitutos','Nuevos Ingresos') DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plan_id` (`plan_id`),
  CONSTRAINT `fuerzas_porter_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `planes_estrategicos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_login.fuerzas_porter: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gestion_login.matriz_came
CREATE TABLE IF NOT EXISTS `matriz_came` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `estrategia` varchar(150) DEFAULT NULL,
  `tipo` enum('Ofensiva','Defensiva','Supervivencia','Reorientación') DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plan_id` (`plan_id`),
  CONSTRAINT `matriz_came_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `planes_estrategicos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_login.matriz_came: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gestion_login.matriz_participacion
CREATE TABLE IF NOT EXISTS `matriz_participacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `area` varchar(100) DEFAULT NULL,
  `participacion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `plan_id` (`plan_id`),
  CONSTRAINT `matriz_participacion_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `planes_estrategicos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Volcando estructura para tabla gestion_login.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_login.sessions: ~2 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('9mD0rBWev5XeohlFMg0dRVthgyosxVOWG7bKzosD', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSXVGek81MlR5SlR2WXFpcmE4bm9oTDNYUlFQVkQ2NG43d3hURXFibyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC92YWxvcmVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1745446836),
	('ecCReqRyiEGzaOqzclrgjuKNafxNyKrofWNbeXZe', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36 OPR/117.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNjFzejN2VGRuZHROVEU4cVY1cmNUR2NGek5CWmVEUzZvQlBTQWZEVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYW5lbCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==', 1744625193);

-- Volcando estructura para tabla gestion_login.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nombre_proyecto` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `mision` text DEFAULT NULL, -- Nueva columna
  `vision` text DEFAULT NULL, -- Nueva columna
  `unidades_estrategicas` text DEFAULT NULL, -- Nueva columna
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `valores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `valor` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `proyecto_id` (`proyecto_id`),
  CONSTRAINT `valores_ibfk_1` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `objetivos_principales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `objetivo` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `proyecto_id` (`proyecto_id`),
  CONSTRAINT `objetivos_principales_ibfk_1` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `objetivos_especificos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo_principal_id` int(11) NOT NULL,
  `objetivo` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `objetivo_principal_id` (`objetivo_principal_id`),
  CONSTRAINT `objetivos_especificos_ibfk_1` FOREIGN KEY (`objetivo_principal_id`) REFERENCES `objetivos_principales` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `cadenadevalor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `reflexion` TEXT DEFAULT NULL,
  `pregunta1` INT DEFAULT NULL,
  `pregunta2` INT DEFAULT NULL,
  `pregunta3` INT DEFAULT NULL,
  `pregunta4` INT DEFAULT NULL,
  `pregunta5` INT DEFAULT NULL,
  `pregunta6` INT DEFAULT NULL,
  `pregunta7` INT DEFAULT NULL,
  `pregunta8` INT DEFAULT NULL,
  `pregunta9` INT DEFAULT NULL,
  `pregunta10` INT DEFAULT NULL,
  `pregunta11` INT DEFAULT NULL,
  `pregunta12` INT DEFAULT NULL,
  `pregunta13` INT DEFAULT NULL,
  `pregunta14` INT DEFAULT NULL,
  `pregunta15` INT DEFAULT NULL,
  `pregunta16` INT DEFAULT NULL,
  `pregunta17` INT DEFAULT NULL,
  `pregunta18` INT DEFAULT NULL,
  `pregunta19` INT DEFAULT NULL,
  `pregunta20` INT DEFAULT NULL,
  `pregunta21` INT DEFAULT NULL,
  `pregunta22` INT DEFAULT NULL,
  `pregunta23` INT DEFAULT NULL,
  `pregunta24` INT DEFAULT NULL,
  `pregunta25` INT DEFAULT NULL,
  `porcentaje` DOUBLE DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `proyecto_id_cadenadevalor_fk` (`proyecto_id`),
  CONSTRAINT `proyecto_id_cadenadevalor_fk` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla gestion_login.users: ~1 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
	(1, 'Administrador', 'admin@peti.com', '$2y$12$C680abLVgyqrnpTS0juqROz7Uq9Y/9PGB5eV06UTvxqagYa8k5YOS', '2025-04-14 07:49:40');

CREATE TABLE IF NOT EXISTS `fortalezas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `fortaleza1` TEXT DEFAULT NULL,
  `fortaleza2` TEXT DEFAULT NULL,
  `fortaleza3` TEXT DEFAULT NULL,
  `fortaleza4` TEXT DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_fortalezas_proyecto_idx` (`proyecto_id`),
  CONSTRAINT `fk_fortalezas_proyecto` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `oportunidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `oportunidad1` TEXT DEFAULT NULL,
  `oportunidad2` TEXT DEFAULT NULL,
  `oportunidad3` TEXT DEFAULT NULL,
  `oportunidad4` TEXT DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_oportunidades_proyecto_idx` (`proyecto_id`),
  CONSTRAINT `fk_oportunidades_proyecto` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `debilidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `debilidad1` TEXT DEFAULT NULL,
  `debilidad2` TEXT DEFAULT NULL,
  `debilidad3` TEXT DEFAULT NULL,
  `debilidad4` TEXT DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_debilidades_proyecto_idx` (`proyecto_id`),
  CONSTRAINT `fk_debilidades_proyecto` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `amenazas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `amenaza1` TEXT DEFAULT NULL,
  `amenaza2` TEXT DEFAULT NULL,
  `amenaza3` TEXT DEFAULT NULL,
  `amenaza4` TEXT DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_amenazas_proyecto_idx` (`proyecto_id`),
  CONSTRAINT `fk_amenazas_proyecto` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla gestion_login.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `venta` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_productos_proyecto_idx` (`proyecto_id`),
  CONSTRAINT `fk_productos_proyecto` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla gestion_login.TCM
CREATE TABLE IF NOT EXISTS `TCM` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `porcentaje` float DEFAULT NULL,
  `periodo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tcm_producto_idx` (`producto_id`),
  CONSTRAINT `fk_tcm_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla gestion_login.Competidor
CREATE TABLE IF NOT EXISTS `Competidor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `venta` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_competidor_producto_idx` (`producto_id`),
  CONSTRAINT `fk_competidor_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando estructura para tabla gestion_login.autodiagnosticoporter
CREATE TABLE IF NOT EXISTS `autodiagnosticoporter` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` INT(11) NOT NULL,
  `pregunta1` INT DEFAULT NULL,
  `pregunta2` INT DEFAULT NULL,
  `pregunta3` INT DEFAULT NULL,
  `pregunta4` INT DEFAULT NULL,
  `pregunta5` INT DEFAULT NULL,
  `pregunta6` INT DEFAULT NULL,
  `pregunta7` INT DEFAULT NULL,
  `pregunta8` INT DEFAULT NULL,
  `pregunta9` INT DEFAULT NULL,
  `pregunta10` INT DEFAULT NULL,
  `pregunta11` INT DEFAULT NULL,
  `pregunta12` INT DEFAULT NULL,
  `pregunta13` INT DEFAULT NULL,
  `pregunta14` INT DEFAULT NULL,
  `pregunta15` INT DEFAULT NULL,
  `pregunta16` INT DEFAULT NULL,
  `pregunta17` INT DEFAULT NULL,
  `conclusion` VARCHAR(255) DEFAULT NULL,
  `puntaje` INT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_autodiagnosticoporter_proyecto_idx` (`proyecto_id`),
  CONSTRAINT `fk_autodiagnosticoporter_proyecto` FOREIGN KEY (`proyecto_id`) REFERENCES `proyectos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
