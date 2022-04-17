-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sss-archiving
CREATE DATABASE IF NOT EXISTS `sss-archiving` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sss-archiving`;

-- Dumping structure for table sss-archiving.file_upload
CREATE TABLE IF NOT EXISTS `file_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(100) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `path` varchar(155) DEFAULT NULL,
  `filename` varchar(155) DEFAULT NULL,
  `filesize` varchar(50) DEFAULT NULL,
  `filecategory` int(20) DEFAULT NULL COMMENT '1 = Doc 2 = Image 3 = Video 4 = Sound',
  `format` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `filesizeraw` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `type` varchar(155) DEFAULT NULL,
  `product` varchar(155) DEFAULT NULL,
  `tags` varchar(500) DEFAULT NULL,
  `description` longtext,
  `filelength` varchar(50) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `date_transaction` date DEFAULT NULL,
  `restored_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table sss-archiving.history_logs
CREATE TABLE IF NOT EXISTS `history_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logs` longtext,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table sss-archiving.thumbnail
CREATE TABLE IF NOT EXISTS `thumbnail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_id` int(11) DEFAULT NULL,
  `path` varchar(50) DEFAULT NULL,
  `filename` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table sss-archiving.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(255) DEFAULT NULL,
  `user_company` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_password_decrypt` varchar(100) DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL COMMENT '1 = Admin 2 = Client',
  `created_at` date DEFAULT NULL,
  `user_department` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
