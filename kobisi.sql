-- --------------------------------------------------------
-- Sunucu:                       127.0.0.1
-- Sunucu sürümü:                5.7.36 - MySQL Community Server (GPL)
-- Sunucu İşletim Sistemi:       Win64
-- HeidiSQL Sürüm:               12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- tablo yapısı dökülüyor kobisi.companies
CREATE TABLE IF NOT EXISTS `companies` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `site_url` varchar(50) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `token` varchar(100) NOT NULL,
  `add_date` datetime DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Bu tabloda firmalara ait bilgiler tutulmaktadır.';

-- kobisi.companies: 5 rows tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` (`company_id`, `company_name`, `site_url`, `name`, `lastname`, `email`, `password`, `token`, `add_date`) VALUES
	(1, 'Firma 1', 'www.firma1.com', 'Buse', 'Aydogdu', 'buse.aydogdu@kobisi.com', '3a799dedf10c421920f1fbded87d09e5', 'MzAyMDE2NjEwNjY0NDg', '2022-08-21 10:20:48'),
	(2, 'Firma 2', 'www.firma2.com', 'Mert', 'Güneş', 'mert.gunes@kobisi.com', '3a799dedf10c421920f1fbded87d09e5', 'NzAyNjE2NjEwNjY0Nzg', '2022-08-21 10:21:18'),
	(3, 'Firma 3', 'www.firma3.com', 'Ayşe', 'Aykaç', 'ayse.aykac@kobisi.com', '3a799dedf10c421920f1fbded87d09e5', 'NjkyMzE2NjEwNjY1MDA', '2022-08-21 10:21:40'),
	(4, 'Firma 4', 'www.firma4.com', 'Cansu', 'Saygı', 'cansu.saygi@kobisi.com', '3a799dedf10c421920f1fbded87d09e5', 'Njg0OTE2NjEwNjY3MzE', '2022-08-21 10:25:31'),
	(5, 'Firma 5', 'www.firma5.com', 'Murat', 'Yıldırım', 'murat.yildirim@kobisi.com', '3a799dedf10c421920f1fbded87d09e5', 'NzAwNTE2NjEwNjY4MDY', '2022-08-21 10:26:46');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;

-- tablo yapısı dökülüyor kobisi.company_packages
CREATE TABLE IF NOT EXISTS `company_packages` (
  `company_packages_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `period` enum('yearly','monthly') NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`company_packages_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='Firma ile bağlantılı paket bilgilerini tutmaktadır.';

-- kobisi.company_packages: 5 rows tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `company_packages` DISABLE KEYS */;
INSERT INTO `company_packages` (`company_packages_id`, `company_id`, `package_id`, `period`, `start_date`, `end_date`, `status`) VALUES
	(1, 1, 1, 'yearly', '2022-08-21 10:30:16', '2023-08-21 10:30:17', '1'),
	(2, 2, 2, 'monthly', '2022-08-21 10:30:31', '2022-09-21 10:30:32', '1'),
	(3, 3, 3, 'monthly', '2022-08-21 10:30:41', '2022-09-21 10:30:42', '1'),
	(4, 4, 4, 'yearly', '2022-08-21 10:30:57', '2023-08-21 10:30:58', '1'),
	(5, 5, 5, 'monthly', '2022-08-21 10:31:08', '2022-09-21 10:31:08', '1');
/*!40000 ALTER TABLE `company_packages` ENABLE KEYS */;

-- tablo yapısı dökülüyor kobisi.packages
CREATE TABLE IF NOT EXISTS `packages` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(50) DEFAULT NULL,
  `package_status` enum('0','1') DEFAULT '1',
  `add_date` datetime DEFAULT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='Oluşturulan paket bilgilerini tutmaktadır';

-- kobisi.packages: 5 rows tablosu için veriler indiriliyor
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` (`package_id`, `package_name`, `package_status`, `add_date`) VALUES
	(1, 'Paket 1', '1', '2022-08-21 10:27:15'),
	(2, 'Paket 2', '1', '2022-08-21 10:27:15'),
	(3, 'Paket 3', '1', '2022-08-21 10:27:15'),
	(4, 'Paket 4', '1', '2022-08-21 10:27:15'),
	(5, 'Paket 5', '1', '2022-08-21 10:27:15');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
