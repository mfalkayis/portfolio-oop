-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_portfolio
CREATE DATABASE IF NOT EXISTS `db_portfolio` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_portfolio`;

-- Dumping structure for table db_portfolio.achievements
CREATE TABLE IF NOT EXISTS `achievements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `DESCRIPTION` text,
  `image` varchar(255) DEFAULT NULL,
  `verification_url` varchar(255) DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_portfolio.achievements: ~3 rows (approximately)
INSERT INTO `achievements` (`id`, `title`, `DESCRIPTION`, `image`, `verification_url`, `issued_date`, `created_at`) VALUES
	(3, 'Infinite', 'Ketua Divisi', 'Kapem week 2.jpg', '', '2025-06-22', '2025-10-22 06:45:37'),
	(6, 'Inspace', 'Panitia Divisi Acara ', 'WIN_20250623_11_37_19_Pro.jpg', '', '2012-12-21', '2025-10-23 09:03:51'),
	(7, 'Memukuli alkayis', 'Tolongggg', 'WIN_20251023_17_11_14_Pro.jpg', NULL, NULL, '2025-10-23 09:11:40');

-- Dumping structure for table db_portfolio.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `project_url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_portfolio.projects: ~1 rows (approximately)
INSERT INTO `projects` (`id`, `title`, `description`, `project_url`, `image`, `created_at`) VALUES
	(1, 'Ingfinite', 'IF anniversary', 'infinite.itk.ac.id', 'kmitk.jpg', '2025-10-17 15:36:54');

-- Dumping structure for table db_portfolio.skills
CREATE TABLE IF NOT EXISTS `skills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `percentage` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_portfolio.skills: ~2 rows (approximately)
INSERT INTO `skills` (`id`, `name`, `percentage`, `created_at`) VALUES
	(1, 'Leader', 60, '2025-10-22 11:40:52'),
	(2, 'Memarahi alkayis', 100, '2025-10-22 13:20:44');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
