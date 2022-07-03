-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for ooms
CREATE DATABASE IF NOT EXISTS `ooms` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ooms`;

-- Dumping structure for table ooms.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `BrandID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '0',
  `Description` text NOT NULL,
  `OwnerID` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`BrandID`),
  KEY `FK_brand_corparation` (`OwnerID`),
  CONSTRAINT `FK_brand_corparation` FOREIGN KEY (`OwnerID`) REFERENCES `corparation` (`CorparationID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.brand: ~12 rows (approximately)
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` (`BrandID`, `Name`, `Description`, `OwnerID`) VALUES
	(1, 'SR Site VIews', '', 1),
	(2, 'Web hosting', 'Our in-house, expert team is always on hand to help answer your questions, get you started, and grow your presence online. You can call, chat or email us any time!', 3),
	(3, 'Web ADS', 'Earn money by allowing relevant and trusted advertisers to place their ads on your website. Ads are screened to ensure they are high quality and relevant to your content or audience. Simple & Automated Tools. Variety of Ad Formats. $26B Paid to Publishers. Vignette Ads.', 3),
	(4, 'Hasbro', 'Hasbro, Inc. is an American multinational conglomerate with toy, board game, and media assets, headquartered in Pawtucket, Rhode Island. Hasbro owns the trademarks and products of Kenner, Parker Brothers, and Milton Bradley, among others.', 4),
	(6, 'Marfex', 'MAFEX CYBORG (ZACK SNYDER\'S JUSTICE LEAGUE Ver.) ... MAFEX CYCLOPS (Comic Variant Suit Ver.) ... MAFEX THE JOKER (THE NEW BATMAN ADVENTURES).', 4),
	(8, 'S.H. Figuarts', 'Bandai Bandai Figuarts Mini Demon Slayer Enmu Figure $29.99 · S.H. Figuarts Masked Kamen Rider Revise Kamen Rider Revi Rex Genome & Kamen Rider Vice', 4),
	(10, 'IndiBro', 'asdasdasdasdasdaasdasdasdasdasdaasdasdasdasdasdaasdasdasdasdasdaasdasdasdasdasdaasdasdasdasdasdaasdasdasdasdasdaasdasdasdasdasdaasdasdasdasdasdaasdasdasdasdasdaasdasdasdasdasdaasdasdasdasdasdaasdasdasdasdasda', 4),
	(11, 'Bandai ', 'Product Categories · Toys · Collectibles · Shops · Bandai Namco Toys & Collectibles America · Latest Video · Latest News.', 4),
	(12, 'TAMASHII NATIONS', 'PRODUCTS · METAL ROBOT SPIRITS GUNDAM DEATHSCYTHE HELL · CHOGOKIN XL-15 SPACE SHIP · S.H.Figuarts · METAL ROBOT SPIRITS G-PARTS[HRUDUDU]＆ ADVANCED PARTS SET · ROBOT ..', 4),
	(13, 'Dojoo', '', 4);
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;

-- Dumping structure for table ooms.brand_access
CREATE TABLE IF NOT EXISTS `brand_access` (
  `Brand_AccessID` int(11) NOT NULL AUTO_INCREMENT,
  `Relationship` char(15) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT 'A',
  `BrandID` int(11) NOT NULL DEFAULT 0,
  `CorparationID` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Brand_AccessID`),
  UNIQUE KEY `BrandID_CorparationID` (`BrandID`,`CorparationID`),
  KEY `FK_using_brands_supplier` (`CorparationID`) USING BTREE,
  CONSTRAINT `FK_using_brands_brand` FOREIGN KEY (`BrandID`) REFERENCES `brand` (`BrandID`),
  CONSTRAINT `FK_using_brands_corparation` FOREIGN KEY (`CorparationID`) REFERENCES `corparation` (`CorparationID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.brand_access: ~9 rows (approximately)
/*!40000 ALTER TABLE `brand_access` DISABLE KEYS */;
INSERT INTO `brand_access` (`Brand_AccessID`, `Relationship`, `Status`, `BrandID`, `CorparationID`) VALUES
	(1, 'Valid User', 'A', 3, 1),
	(2, 'Valid User', 'A', 3, 2),
	(3, 'Valid User', 'A', 4, 4),
	(4, 'Valid User', 'A', 6, 4),
	(5, 'Valid User', 'A', 11, 4),
	(9, 'Valid User', 'A', 8, 4),
	(10, 'Valid User', 'A', 12, 4),
	(11, '', 'A', 10, 4),
	(12, '', 'A', 13, 4);
/*!40000 ALTER TABLE `brand_access` ENABLE KEYS */;

-- Dumping structure for table ooms.card
CREATE TABLE IF NOT EXISTS `card` (
  `CardID` int(11) NOT NULL AUTO_INCREMENT,
  `CardType` varchar(50) NOT NULL DEFAULT '0',
  `CardName` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`CardID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.card: ~1 rows (approximately)
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` (`CardID`, `CardType`, `CardName`) VALUES
	(1, 'Amex', 'Sampath');
/*!40000 ALTER TABLE `card` ENABLE KEYS */;

-- Dumping structure for table ooms.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `CartID` int(11) NOT NULL AUTO_INCREMENT,
  `Quantity` int(11) NOT NULL DEFAULT 1,
  `Status` char(1) NOT NULL DEFAULT 'A',
  `StocksID` int(11) NOT NULL DEFAULT 0,
  `CustomerID` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`CartID`),
  KEY `FK_cart_stocks` (`StocksID`),
  KEY `FK_cart_customer` (`CustomerID`),
  CONSTRAINT `FK_cart_customer` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`),
  CONSTRAINT `FK_cart_stocks` FOREIGN KEY (`StocksID`) REFERENCES `stocks` (`StocksID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.cart: ~0 rows (approximately)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping structure for table ooms.category
CREATE TABLE IF NOT EXISTS `category` (
  `CategoryID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.category: ~2 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`CategoryID`, `Name`, `Status`) VALUES
	(1, 'New', 'A'),
	(2, 'Host Level', 'A'),
	(3, 'Height', 'A');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table ooms.category_item
CREATE TABLE IF NOT EXISTS `category_item` (
  `CategoryID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `Values` varchar(50) DEFAULT NULL,
  `Status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`CategoryID`,`ItemID`),
  KEY `FK_category_item_item` (`ItemID`),
  CONSTRAINT `FK_category_item_item` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`),
  CONSTRAINT `FK_category_items_categories` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.category_item: ~4 rows (approximately)
/*!40000 ALTER TABLE `category_item` DISABLE KEYS */;
INSERT INTO `category_item` (`CategoryID`, `ItemID`, `Values`, `Status`) VALUES
	(1, 1, '23', 'A'),
	(2, 1, 'ss', 'A'),
	(3, 2, '16', 'A'),
	(3, 4, '16', 'A'),
	(3, 5, '16', 'A');
/*!40000 ALTER TABLE `category_item` ENABLE KEYS */;

-- Dumping structure for table ooms.checkout
CREATE TABLE IF NOT EXISTS `checkout` (
  `CheckoutID` int(11) NOT NULL AUTO_INCREMENT,
  `SelectDelivery` enum('Delivery','Pickup') NOT NULL DEFAULT 'Delivery',
  `DeliveryAddress` varchar(50) NOT NULL DEFAULT '0',
  `DeliveryLocation` varchar(50) NOT NULL DEFAULT '0',
  `PaymentMethod` enum('Cash','Card','Online') NOT NULL DEFAULT 'Cash',
  `PaymentStatus` enum('Paid','Not Paid') NOT NULL DEFAULT 'Not Paid',
  `Status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`CheckoutID`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.checkout: ~0 rows (approximately)
/*!40000 ALTER TABLE `checkout` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkout` ENABLE KEYS */;

-- Dumping structure for table ooms.checkout_corparation
CREATE TABLE IF NOT EXISTS `checkout_corparation` (
  `Checkout_CorparationID` int(11) NOT NULL AUTO_INCREMENT,
  `CheckoutID` int(11) NOT NULL,
  `CorparationID` int(11) NOT NULL,
  `DeliveryFee` decimal(15,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`Checkout_CorparationID`),
  KEY `FK_checkout_corparation_checkout` (`CheckoutID`),
  KEY `FK_checkout_corparation_corparation` (`CorparationID`),
  CONSTRAINT `FK_checkout_corparation_checkout` FOREIGN KEY (`CheckoutID`) REFERENCES `checkout` (`CheckoutID`),
  CONSTRAINT `FK_checkout_corparation_corparation` FOREIGN KEY (`CorparationID`) REFERENCES `corparation` (`CorparationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.checkout_corparation: ~0 rows (approximately)
/*!40000 ALTER TABLE `checkout_corparation` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkout_corparation` ENABLE KEYS */;

-- Dumping structure for table ooms.checkout_corp_promo
CREATE TABLE IF NOT EXISTS `checkout_corp_promo` (
  `Checkout_CorparationID` int(11) NOT NULL,
  `PromotionCode` char(8) NOT NULL,
  PRIMARY KEY (`Checkout_CorparationID`,`PromotionCode`),
  KEY `FK_checkout_corp_promo_customer_promotion` (`PromotionCode`),
  CONSTRAINT `FK_checkout_corp_promo_checkout_corparation` FOREIGN KEY (`Checkout_CorparationID`) REFERENCES `checkout_corparation` (`Checkout_CorparationID`),
  CONSTRAINT `FK_checkout_corp_promo_customer_promotion` FOREIGN KEY (`PromotionCode`) REFERENCES `customer_promotion` (`PromotionCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.checkout_corp_promo: ~0 rows (approximately)
/*!40000 ALTER TABLE `checkout_corp_promo` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkout_corp_promo` ENABLE KEYS */;

-- Dumping structure for table ooms.checkout_corp_voucher
CREATE TABLE IF NOT EXISTS `checkout_corp_voucher` (
  `Checkout_CorparationID` int(11) NOT NULL,
  `VoucherCode` char(8) NOT NULL,
  PRIMARY KEY (`Checkout_CorparationID`,`VoucherCode`),
  KEY `FK_checkout_corp_voucher_voucher` (`VoucherCode`),
  CONSTRAINT `FK_checkout_corp_voucher_checkout_corparation` FOREIGN KEY (`Checkout_CorparationID`) REFERENCES `checkout_corparation` (`Checkout_CorparationID`),
  CONSTRAINT `FK_checkout_corp_voucher_voucher` FOREIGN KEY (`VoucherCode`) REFERENCES `voucher` (`VoucherCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.checkout_corp_voucher: ~0 rows (approximately)
/*!40000 ALTER TABLE `checkout_corp_voucher` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkout_corp_voucher` ENABLE KEYS */;

-- Dumping structure for table ooms.corparation
CREATE TABLE IF NOT EXISTS `corparation` (
  `CorparationID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Summary` tinytext DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `BIR` char(15) DEFAULT NULL,
  `Logo` varchar(100) DEFAULT NULL COMMENT 'Path',
  `Rate` decimal(5,4) NOT NULL DEFAULT 0.0000,
  `Status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`CorparationID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.corparation: ~4 rows (approximately)
/*!40000 ALTER TABLE `corparation` DISABLE KEYS */;
INSERT INTO `corparation` (`CorparationID`, `Name`, `Summary`, `Description`, `BIR`, `Logo`, `Rate`, `Status`) VALUES
	(1, 'SR Productions', 'Its an IT Corp started my 3 friends ititally', NULL, NULL, 'SR_Production.jpg', 4.2000, 'A'),
	(2, 'Kingdom 360', 'We are a team of friends who worked in the corporate sector and we thought of making an impact in the corporate world. "How can we do this?" was the first question we had.', NULL, NULL, 'KDM.jpg', 4.7625, 'A'),
	(3, 'Hostinger', 'Hostinger International, Ltd is an employee-owned Web hosting provider and Internet domain registrar, established in 2004. Hostinger is the parent company of 000Webhost, Niagahoster and Weblink.', NULL, NULL, 'Hostinger.jpg', 4.0000, 'A'),
	(4, 'Disney', 'he Walt Disney Company, commonly known as Disney, is an American multinational mass media and entertainment conglomerate headquartered at the Walt Disney Studios complex in Burbank, California.', NULL, NULL, 'Disney.jpg', 5.0000, 'A');
/*!40000 ALTER TABLE `corparation` ENABLE KEYS */;

-- Dumping structure for table ooms.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(50) NOT NULL DEFAULT '0',
  `GPS` varchar(50) DEFAULT '0',
  `Gender` enum('M','F') NOT NULL DEFAULT 'M',
  `DOB` date DEFAULT NULL,
  `Membership` varchar(50) NOT NULL DEFAULT 'Newbie',
  `Status` char(1) NOT NULL DEFAULT 'A',
  `UserID` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`CustomerID`),
  KEY `FK_customer_user` (`UserID`),
  CONSTRAINT `FK_customer_user` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.customer: ~0 rows (approximately)
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Dumping structure for table ooms.customer_offer
CREATE TABLE IF NOT EXISTS `customer_offer` (
  `CustomerID` int(11) NOT NULL,
  `OfferID` int(11) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`CustomerID`,`OfferID`),
  KEY `FK_customer_offer_offer` (`OfferID`),
  CONSTRAINT `FK_customer_offer_customer` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`),
  CONSTRAINT `FK_customer_offer_offer` FOREIGN KEY (`OfferID`) REFERENCES `offer` (`OfferID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.customer_offer: ~0 rows (approximately)
/*!40000 ALTER TABLE `customer_offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_offer` ENABLE KEYS */;

-- Dumping structure for table ooms.customer_promotion
CREATE TABLE IF NOT EXISTS `customer_promotion` (
  `PromotionCode` char(8) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `PromotionID` int(11) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`PromotionCode`),
  UNIQUE KEY `PromotionCode` (`PromotionCode`),
  KEY `FK_customer_promotion_customer` (`CustomerID`),
  KEY `FK_customer_promotion_promotion` (`PromotionID`),
  CONSTRAINT `FK_customer_promotion_customer` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`),
  CONSTRAINT `FK_customer_promotion_promotion` FOREIGN KEY (`PromotionID`) REFERENCES `promotion` (`PromotionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.customer_promotion: ~0 rows (approximately)
/*!40000 ALTER TABLE `customer_promotion` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_promotion` ENABLE KEYS */;

-- Dumping structure for table ooms.employee
CREATE TABLE IF NOT EXISTS `employee` (
  `EmployeeID` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(50) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `TelephoneNo` char(15) NOT NULL,
  `NICNo` char(12) NOT NULL,
  `Photo` varchar(50) DEFAULT NULL COMMENT 'Path',
  `Rate` decimal(5,4) NOT NULL DEFAULT 0.0000,
  PRIMARY KEY (`EmployeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.employee: ~0 rows (approximately)
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;

-- Dumping structure for table ooms.employee_services
CREATE TABLE IF NOT EXISTS `employee_services` (
  `EmployeeID` int(11) NOT NULL,
  `ServiceID` int(11) NOT NULL,
  `Status` char(1) DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`,`ServiceID`),
  KEY `FK_employee_services_service` (`ServiceID`),
  CONSTRAINT `FK_employee_services_employee` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`),
  CONSTRAINT `FK_employee_services_service` FOREIGN KEY (`ServiceID`) REFERENCES `service` (`ServiceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.employee_services: ~0 rows (approximately)
/*!40000 ALTER TABLE `employee_services` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_services` ENABLE KEYS */;

-- Dumping structure for table ooms.equipment
CREATE TABLE IF NOT EXISTS `equipment` (
  `EquipmentID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '0',
  `Highlight` tinytext DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Status` char(1) NOT NULL DEFAULT 'A',
  `Rental_Sales` enum('Sale','Rental','Both') DEFAULT 'Sale',
  `Rate` decimal(5,4) NOT NULL DEFAULT 0.0000,
  `CorparationID` int(11) NOT NULL DEFAULT 0,
  `Brand_AccessID` int(11) NOT NULL DEFAULT 0,
  `GenreID` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`EquipmentID`),
  KEY `FK_equipment_genre` (`GenreID`),
  KEY `FK_equipment_supplier` (`CorparationID`) USING BTREE,
  KEY `FK_equipment_using_brands` (`Brand_AccessID`) USING BTREE,
  CONSTRAINT `FK_equipment_brands_access` FOREIGN KEY (`Brand_AccessID`) REFERENCES `brand_access` (`Brand_AccessID`),
  CONSTRAINT `FK_equipment_corparation` FOREIGN KEY (`CorparationID`) REFERENCES `corparation` (`CorparationID`),
  CONSTRAINT `FK_equipment_genre` FOREIGN KEY (`GenreID`) REFERENCES `genre` (`GenreID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.equipment: ~6 rows (approximately)
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
INSERT INTO `equipment` (`EquipmentID`, `Name`, `Highlight`, `Description`, `Status`, `Rental_Sales`, `Rate`, `CorparationID`, `Brand_AccessID`, `GenreID`) VALUES
	(4, 'Red Parrot', 'Start ERP Manager', NULL, 'A', 'Rental', 3.0000, 1, 1, 2),
	(6, 'Ironman Mafex', 'All Ironman Marfex Action Figures', NULL, 'A', 'Both', 4.2500, 4, 4, 7),
	(9, 'Captian America S.H.F', 'All Captian America SHF Action Fiigure', NULL, 'A', 'Sale', 4.0000, 4, 9, 7),
	(10, 'Spiderman Mafex', 'All Spiderman Marfex Action Fiigure', NULL, 'A', 'Sale', 0.0000, 4, 4, 7),
	(12, 'Captian America Mafex', 'All Ironman Marfex Action Figures', NULL, 'A', 'Sale', 4.0000, 4, 4, 7),
	(14, 'Thor Marfex', 'All Thor Marfex Action Figures', NULL, 'A', 'Sale', 5.0000, 4, 4, 7);
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;

-- Dumping structure for table ooms.equipment_offer
CREATE TABLE IF NOT EXISTS `equipment_offer` (
  `OfferID` int(11) NOT NULL,
  `EquipmentID` int(11) NOT NULL,
  `Quanitity` int(5) NOT NULL DEFAULT 1,
  `OfferRate` decimal(5,2) NOT NULL DEFAULT 0.00,
  `OfferAmt` decimal(15,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`OfferID`,`EquipmentID`),
  KEY `FK_equipment_offer_equipment` (`EquipmentID`),
  CONSTRAINT `FK_equipment_offer_equipment` FOREIGN KEY (`EquipmentID`) REFERENCES `equipment` (`EquipmentID`),
  CONSTRAINT `FK_equipment_offer_offer` FOREIGN KEY (`OfferID`) REFERENCES `offer` (`OfferID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.equipment_offer: ~8 rows (approximately)
/*!40000 ALTER TABLE `equipment_offer` DISABLE KEYS */;
INSERT INTO `equipment_offer` (`OfferID`, `EquipmentID`, `Quanitity`, `OfferRate`, `OfferAmt`) VALUES
	(2, 6, 1, 20.00, 0.00),
	(2, 10, 1, 20.00, 0.00),
	(2, 12, 1, 20.00, 0.00),
	(2, 14, 1, 20.00, 0.00),
	(3, 6, 3, 33.33, 0.00),
	(3, 10, 3, 33.33, 0.00),
	(3, 12, 3, 33.33, 0.00),
	(3, 14, 1, 33.00, 0.00);
/*!40000 ALTER TABLE `equipment_offer` ENABLE KEYS */;

-- Dumping structure for table ooms.genre
CREATE TABLE IF NOT EXISTS `genre` (
  `GenreID` int(11) NOT NULL AUTO_INCREMENT,
  `GenreName` varchar(50) NOT NULL DEFAULT '0',
  `ParentID` int(11) DEFAULT 0,
  PRIMARY KEY (`GenreID`),
  KEY `FK_genre_genre` (`ParentID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.genre: ~8 rows (approximately)
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` (`GenreID`, `GenreName`, `ParentID`) VALUES
	(2, 'Web Application', 8),
	(3, 'Web Site', 8),
	(4, 'PC Application', 8),
	(5, 'OS Application', 8),
	(6, 'Items', 1),
	(7, 'Action Figures', 12),
	(8, 'Software', 1),
	(12, 'Toys', 6);
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;

-- Dumping structure for table ooms.image
CREATE TABLE IF NOT EXISTS `image` (
  `ImageID` int(11) NOT NULL AUTO_INCREMENT,
  `ImagePath` varchar(100) DEFAULT NULL COMMENT 'Path',
  `Status` char(1) DEFAULT 'A',
  `ItemID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ImageID`),
  KEY `FK_image_items` (`ItemID`) USING BTREE,
  CONSTRAINT `FK_image_item` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.image: ~33 rows (approximately)
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` (`ImageID`, `ImagePath`, `Status`, `ItemID`) VALUES
	(1, 'IronmanMarfex02.jpg', 'A', 5),
	(2, 'IronmanMarfex01.jpg', 'A', 2),
	(3, 'IronmanMarfex03.jpg', 'A', 4),
	(5, 'CaptainAmericaSHF05.jpg', 'A', 6),
	(6, 'CaptainAmericaSHF04.jpg', 'A', 6),
	(7, 'CaptainAmericaSHF03.jpg', 'A', 6),
	(8, 'CaptainAmericaSHF02.jpg', 'A', 6),
	(9, 'CaptainAmericaSHF01.jpg', 'A', 6),
	(10, 'IronmanMarfex04.jpg', 'A', 4),
	(11, 'IronmanMarfex06.jpg', 'A', 5),
	(12, 'IronmanMarfex05.jpg', 'A', 2),
	(13, 'SpidermanMarfex02.jpg', 'A', 7),
	(14, 'SpidermanMarfex01.jpg', 'A', 7),
	(15, 'SpidermanMarfex03.jpg', 'A', 7),
	(16, 'SpidermanMarfex04.jpg', 'A', 7),
	(17, 'CaptainAmericaMarfex01.jpg', 'A', 8),
	(18, 'CaptainAmericaMarfex02.jpg', 'A', 8),
	(19, 'CaptainAmericaMarfex03.jpg', 'A', 8),
	(20, 'CaptainAmericaMarfex04.jpg', 'A', 8),
	(21, 'CaptainAmericaMarfex05.jpg', 'A', 8),
	(22, 'CaptainAmericaMarfex09.jpg', 'A', 9),
	(23, 'CaptainAmericaMarfex07.jpg', 'A', 9),
	(24, 'CaptainAmericaMarfex08.jpg', 'A', 9),
	(25, 'CaptainAmericaMarfex06.jpg', 'A', 9),
	(26, 'ThorMarfex01.jpg', 'A', 11),
	(27, 'ThorMarfex02.jpg', 'A', 11),
	(28, 'ThorMarfex03.jpg', 'A', 11),
	(29, 'ThorMarfex04.jpg', 'A', 12),
	(30, 'ThorMarfex05.jpg', 'A', 12),
	(31, 'ThorMarfex07.jpg', 'A', 12),
	(32, 'ThorMarfex09.jpg', 'A', 12),
	(33, 'ThorMarfex06.jpg', 'A', 13),
	(34, 'ThorMarfex08.jpg', 'A', 13);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;

-- Dumping structure for table ooms.item
CREATE TABLE IF NOT EXISTS `item` (
  `ItemID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '0',
  `Status` char(1) NOT NULL DEFAULT 'A',
  `EquipmentID` int(11) NOT NULL,
  PRIMARY KEY (`ItemID`) USING BTREE,
  KEY `FK_items_equipment` (`EquipmentID`),
  CONSTRAINT `FK_items_equipment` FOREIGN KEY (`EquipmentID`) REFERENCES `equipment` (`EquipmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.item: ~11 rows (approximately)
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` (`ItemID`, `Name`, `Status`, `EquipmentID`) VALUES
	(1, 'FIrst Site', 'A', 4),
	(2, 'Ironman Avengers', 'A', 6),
	(4, 'Ironman End Game', 'A', 6),
	(5, 'Ironman 3', 'A', 6),
	(6, 'Captain America Civil War', 'A', 9),
	(7, 'Spiderman Homecoming', 'A', 10),
	(8, 'Captain America Infinity War', 'A', 12),
	(9, 'Captain America End Game', 'A', 12),
	(11, 'Thor Love and Thunder', 'A', 14),
	(12, 'Thor Infinity War', 'A', 14),
	(13, 'Thor End Game', 'A', 14);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;

-- Dumping structure for table ooms.item_rental
CREATE TABLE IF NOT EXISTS `item_rental` (
  `Item_RentalID` int(11) NOT NULL AUTO_INCREMENT,
  `Preiod` int(11) NOT NULL,
  `Amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `PreiodType` enum('D','W','M','Q','H','Y') NOT NULL DEFAULT 'D',
  `ItemID` int(11) NOT NULL,
  PRIMARY KEY (`Item_RentalID`) USING BTREE,
  KEY `FK_items_rental_items` (`ItemID`) USING BTREE,
  CONSTRAINT `FK_item_rental_item` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.item_rental: ~3 rows (approximately)
/*!40000 ALTER TABLE `item_rental` DISABLE KEYS */;
INSERT INTO `item_rental` (`Item_RentalID`, `Preiod`, `Amount`, `PreiodType`, `ItemID`) VALUES
	(2, 12, 25000.00, 'M', 1),
	(3, 30, 500.00, 'D', 5),
	(4, 30, 550.00, 'D', 2),
	(5, 30, 500.00, 'D', 4);
/*!40000 ALTER TABLE `item_rental` ENABLE KEYS */;

-- Dumping structure for table ooms.item_sale
CREATE TABLE IF NOT EXISTS `item_sale` (
  `Item_SaleID` int(11) NOT NULL AUTO_INCREMENT,
  `Price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `InternalDiscount` decimal(15,2) DEFAULT 0.00,
  `ItemID` int(11) NOT NULL,
  PRIMARY KEY (`Item_SaleID`) USING BTREE,
  KEY `FK__items` (`ItemID`) USING BTREE,
  CONSTRAINT `FK_item_sale_item` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.item_sale: ~10 rows (approximately)
/*!40000 ALTER TABLE `item_sale` DISABLE KEYS */;
INSERT INTO `item_sale` (`Item_SaleID`, `Price`, `InternalDiscount`, `ItemID`) VALUES
	(1, 17500.00, 1000.00, 5),
	(4, 19000.00, 2500.00, 2),
	(5, 22500.00, 3500.00, 4),
	(6, 15000.00, 699.99, 6),
	(9, 17900.00, 42.90, 7),
	(10, 25000.00, 5000.00, 8),
	(11, 23000.00, 7500.00, 9),
	(12, 32000.00, 5000.00, 11),
	(13, 27000.00, 4000.00, 13),
	(14, 21000.00, 3540.00, 12);
/*!40000 ALTER TABLE `item_sale` ENABLE KEYS */;

-- Dumping structure for table ooms.offer
CREATE TABLE IF NOT EXISTS `offer` (
  `OfferID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '0',
  `Description` tinytext DEFAULT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `PaymentMethod` enum('Cash','Card','Online') NOT NULL DEFAULT 'Cash',
  `CardID` int(11) DEFAULT NULL,
  PRIMARY KEY (`OfferID`),
  KEY `FK_offer_cards` (`CardID`),
  CONSTRAINT `FK_offer_cards` FOREIGN KEY (`CardID`) REFERENCES `card` (`CardID`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.offer: ~1 rows (approximately)
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
INSERT INTO `offer` (`OfferID`, `Name`, `Description`, `StartDate`, `EndDate`, `PaymentMethod`, `CardID`) VALUES
	(2, '20% for toys', '20% off for all action figures of Marfex', '2022-05-23', '2022-06-23', 'Card', 1),
	(3, 'Buy 2 and get one free', 'Buy 2 and get one free action figure free', '2022-05-23', '2022-06-23', 'Cash', NULL);
/*!40000 ALTER TABLE `offer` ENABLE KEYS */;

-- Dumping structure for table ooms.promotion
CREATE TABLE IF NOT EXISTS `promotion` (
  `PromotionID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '0',
  `Description` tinytext NOT NULL,
  `DiscountType` enum('Rate','Amount') NOT NULL DEFAULT 'Amount',
  `DiscountValue` decimal(15,2) NOT NULL DEFAULT 0.00,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `MinimumValue` decimal(15,2) NOT NULL DEFAULT 0.00,
  `MaximumAmount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `CorparationID` int(11) NOT NULL,
  `BrandID` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`PromotionID`),
  KEY `FK_promotion_corparation` (`CorparationID`),
  KEY `FK_promotion_brand` (`BrandID`),
  CONSTRAINT `FK_promotion_brand` FOREIGN KEY (`BrandID`) REFERENCES `brand` (`BrandID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_promotion_corparation` FOREIGN KEY (`CorparationID`) REFERENCES `corparation` (`CorparationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.promotion: ~0 rows (approximately)
/*!40000 ALTER TABLE `promotion` DISABLE KEYS */;
/*!40000 ALTER TABLE `promotion` ENABLE KEYS */;

-- Dumping structure for table ooms.service
CREATE TABLE IF NOT EXISTS `service` (
  `ServiceID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '0',
  `Description` text DEFAULT NULL,
  `Wage` decimal(15,2) NOT NULL DEFAULT 0.00,
  `WageType` enum('hr','D','W','M') NOT NULL DEFAULT 'D',
  `ContactDetails` int(12) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT 'A',
  `CorparationID` int(11) NOT NULL,
  PRIMARY KEY (`ServiceID`) USING BTREE,
  KEY `FK_service_supplier` (`CorparationID`) USING BTREE,
  CONSTRAINT `FK_service_corparation` FOREIGN KEY (`CorparationID`) REFERENCES `corparation` (`CorparationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.service: ~0 rows (approximately)
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
/*!40000 ALTER TABLE `service` ENABLE KEYS */;

-- Dumping structure for table ooms.service_checkout_list
CREATE TABLE IF NOT EXISTS `service_checkout_list` (
  `CheckoutID` int(11) NOT NULL,
  `ServiceID` int(11) NOT NULL,
  `WagePreiod` int(11) DEFAULT 0,
  `ServiceDate` date DEFAULT NULL,
  `Status` char(1) DEFAULT 'A',
  PRIMARY KEY (`CheckoutID`,`ServiceID`),
  KEY `FK_servicecheckoutlist_service` (`ServiceID`),
  CONSTRAINT `FK_servicecheckoutlist_checkout` FOREIGN KEY (`CheckoutID`) REFERENCES `checkout` (`CheckoutID`),
  CONSTRAINT `FK_servicecheckoutlist_service` FOREIGN KEY (`ServiceID`) REFERENCES `service` (`ServiceID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.service_checkout_list: ~0 rows (approximately)
/*!40000 ALTER TABLE `service_checkout_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_checkout_list` ENABLE KEYS */;

-- Dumping structure for table ooms.stocks
CREATE TABLE IF NOT EXISTS `stocks` (
  `StocksID` int(11) NOT NULL AUTO_INCREMENT,
  `TotalStocks` decimal(15,2) NOT NULL DEFAULT 0.00,
  `SoldStocks` decimal(15,2) NOT NULL DEFAULT 0.00,
  `Status` char(1) NOT NULL DEFAULT 'A',
  `ItemID` int(11) NOT NULL,
  PRIMARY KEY (`StocksID`),
  KEY `FK_stocks_items` (`ItemID`) USING BTREE,
  CONSTRAINT `FK_stocks_item` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.stocks: ~4 rows (approximately)
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` (`StocksID`, `TotalStocks`, `SoldStocks`, `Status`, `ItemID`) VALUES
	(1, 100.00, 29.00, 'A', 1),
	(2, 50.00, 24.00, 'A', 1),
	(3, 500.00, 0.00, 'A', 5),
	(4, 100.00, 0.00, 'A', 2),
	(5, 50.00, 0.00, 'A', 4);
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;

-- Dumping structure for table ooms.stocks_checkout_list
CREATE TABLE IF NOT EXISTS `stocks_checkout_list` (
  `CechkoutID` int(11) NOT NULL AUTO_INCREMENT,
  `CartID` int(11) NOT NULL DEFAULT 0,
  `_ReturnDate` date NOT NULL,
  `Status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`CechkoutID`,`CartID`),
  KEY `FK_stocks_checkout_list_cart` (`CartID`),
  CONSTRAINT `FK_stocks_checkout_list_cart` FOREIGN KEY (`CartID`) REFERENCES `cart` (`CartID`),
  CONSTRAINT `FK_stocks_checkout_list_checkout` FOREIGN KEY (`CechkoutID`) REFERENCES `checkout` (`CheckoutID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.stocks_checkout_list: ~0 rows (approximately)
/*!40000 ALTER TABLE `stocks_checkout_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `stocks_checkout_list` ENABLE KEYS */;

-- Dumping structure for table ooms.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `SupplierID` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(50) NOT NULL DEFAULT '0',
  `About` varchar(50) NOT NULL DEFAULT '0',
  `Status` char(1) NOT NULL DEFAULT 'A',
  `UserID` int(11) NOT NULL DEFAULT 0,
  `CorparationID` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`SupplierID`),
  KEY `FK_supplier_user` (`UserID`),
  KEY `FK_supplier_corparation` (`CorparationID`),
  CONSTRAINT `FK_supplier_corparation` FOREIGN KEY (`CorparationID`) REFERENCES `corparation` (`CorparationID`),
  CONSTRAINT `FK_supplier_user` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.supplier: ~0 rows (approximately)
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` (`SupplierID`, `FullName`, `About`, `Status`, `UserID`, `CorparationID`) VALUES
	(3, 'Visula Rajakaruna', 'Software Enigner', 'A', 1, 1);
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;

-- Dumping structure for table ooms.user
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL DEFAULT '3e0cd7dbf477f6da9831acd7c1d617bc',
  `Email` varchar(50) NOT NULL,
  `TelephoneNo` varchar(15) NOT NULL,
  `Address` varchar(15) DEFAULT NULL,
  `Status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `UserName` (`UserName`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.user: ~1 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`UserID`, `UserName`, `Password`, `Email`, `TelephoneNo`, `Address`, `Status`) VALUES
	(1, 'Visula', '3e0cd7dbf477f6da9831acd7c1d617bc', 'svisula@gmail.com', '', '', 'A');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table ooms.voucher
CREATE TABLE IF NOT EXISTS `voucher` (
  `VoucherCode` char(8) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Description` tinytext DEFAULT NULL,
  `DiscountAmount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `StartDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  PRIMARY KEY (`VoucherCode`),
  UNIQUE KEY `VoucherCode` (`VoucherCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.voucher: ~0 rows (approximately)
/*!40000 ALTER TABLE `voucher` DISABLE KEYS */;
/*!40000 ALTER TABLE `voucher` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
