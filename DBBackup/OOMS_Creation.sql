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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.brand: ~0 rows (approximately)
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.category: ~0 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table ooms.category_items
CREATE TABLE IF NOT EXISTS `category_items` (
  `CategoryID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  PRIMARY KEY (`CategoryID`,`ItemID`),
  KEY `FK_category_items_items` (`ItemID`),
  CONSTRAINT `FK_category_items_categories` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`),
  CONSTRAINT `FK_category_items_items` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.category_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `category_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_items` ENABLE KEYS */;

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
  PRIMARY KEY (`Checkout_CorparationID`,`PromotionCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.checkout_corp_promo: ~0 rows (approximately)
/*!40000 ALTER TABLE `checkout_corp_promo` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkout_corp_promo` ENABLE KEYS */;

-- Dumping structure for table ooms.checkout_corp_voucher
CREATE TABLE IF NOT EXISTS `checkout_corp_voucher` (
  `Checkout_CorparationID` int(11) NOT NULL,
  `VoucherCode` char(8) NOT NULL,
  PRIMARY KEY (`Checkout_CorparationID`,`VoucherCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.checkout_corp_voucher: ~0 rows (approximately)
/*!40000 ALTER TABLE `checkout_corp_voucher` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkout_corp_voucher` ENABLE KEYS */;

-- Dumping structure for table ooms.corparation
CREATE TABLE IF NOT EXISTS `corparation` (
  `CorparationID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Description` text DEFAULT NULL,
  `BIR` char(15) DEFAULT NULL,
  `Logo` varchar(50) DEFAULT NULL COMMENT 'Path',
  `Rate` decimal(5,4) NOT NULL DEFAULT 0.0000,
  `Status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`CorparationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.corparation: ~0 rows (approximately)
/*!40000 ALTER TABLE `corparation` DISABLE KEYS */;
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
  PRIMARY KEY (`CustomerID`,`OfferID`)
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
  `SupplierID` int(11) NOT NULL DEFAULT 0,
  `Using_BrandID` int(11) NOT NULL DEFAULT 0,
  `GenreID` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`EquipmentID`),
  KEY `FK_equipment_supplier` (`SupplierID`),
  KEY `FK_equipment_using_brands` (`Using_BrandID`),
  KEY `FK_equipment_genre` (`GenreID`),
  CONSTRAINT `FK_equipment_genre` FOREIGN KEY (`GenreID`) REFERENCES `genre` (`GenreID`),
  CONSTRAINT `FK_equipment_supplier` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`),
  CONSTRAINT `FK_equipment_using_brands` FOREIGN KEY (`Using_BrandID`) REFERENCES `using_brands` (`Using_BrandID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.equipment: ~0 rows (approximately)
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;

-- Dumping structure for table ooms.equipment_offer
CREATE TABLE IF NOT EXISTS `equipment_offer` (
  `OfferID` int(11) NOT NULL,
  `EquipmentID` int(11) NOT NULL,
  `Quanitity` int(5) NOT NULL DEFAULT 1,
  `Buy_Get` enum('Buy','Get Free') DEFAULT 'Buy',
  PRIMARY KEY (`OfferID`,`EquipmentID`),
  KEY `FK_equipment_offer_equipment` (`EquipmentID`),
  CONSTRAINT `FK_equipment_offer_equipment` FOREIGN KEY (`EquipmentID`) REFERENCES `equipment` (`EquipmentID`),
  CONSTRAINT `FK_equipment_offer_offer` FOREIGN KEY (`OfferID`) REFERENCES `offer` (`OfferID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.equipment_offer: ~0 rows (approximately)
/*!40000 ALTER TABLE `equipment_offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment_offer` ENABLE KEYS */;

-- Dumping structure for table ooms.genre
CREATE TABLE IF NOT EXISTS `genre` (
  `GenreID` int(11) NOT NULL AUTO_INCREMENT,
  `GenreName` varchar(50) NOT NULL DEFAULT '0',
  `ParentID` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`GenreID`),
  KEY `FK_genre_genre` (`ParentID`),
  CONSTRAINT `FK_genre_genre` FOREIGN KEY (`ParentID`) REFERENCES `genre` (`GenreID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.genre: ~0 rows (approximately)
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;

-- Dumping structure for table ooms.image
CREATE TABLE IF NOT EXISTS `image` (
  `ImageID` int(11) NOT NULL AUTO_INCREMENT,
  `ImagePath` varchar(50) DEFAULT NULL COMMENT 'Path',
  `Status` char(1) DEFAULT 'A',
  `ItemsID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ImageID`),
  KEY `FK_image_items` (`ItemsID`),
  CONSTRAINT `FK_image_items` FOREIGN KEY (`ItemsID`) REFERENCES `items` (`ItemsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.image: ~0 rows (approximately)
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
/*!40000 ALTER TABLE `image` ENABLE KEYS */;

-- Dumping structure for table ooms.items
CREATE TABLE IF NOT EXISTS `items` (
  `ItemsID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '0',
  `Price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `InternalDiscount` decimal(15,2) DEFAULT 0.00,
  `Status` char(1) NOT NULL DEFAULT 'A',
  `EquipmentID` int(11) NOT NULL,
  PRIMARY KEY (`ItemsID`),
  KEY `FK_items_equipment` (`EquipmentID`),
  CONSTRAINT `FK_items_equipment` FOREIGN KEY (`EquipmentID`) REFERENCES `equipment` (`EquipmentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.items: ~0 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping structure for table ooms.offer
CREATE TABLE IF NOT EXISTS `offer` (
  `OfferID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '0',
  `Description` tinytext DEFAULT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  PRIMARY KEY (`OfferID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.offer: ~0 rows (approximately)
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
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
  `WageType` enum('H','D','W','M') NOT NULL DEFAULT 'D',
  `ContactDetails` int(12) NOT NULL,
  `Status` char(1) NOT NULL DEFAULT 'A',
  `SupplierID` int(11) NOT NULL,
  PRIMARY KEY (`ServiceID`) USING BTREE,
  KEY `FK_service_supplier` (`SupplierID`),
  CONSTRAINT `FK_service_supplier` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.service: ~0 rows (approximately)
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
/*!40000 ALTER TABLE `service` ENABLE KEYS */;

-- Dumping structure for table ooms.service_checkout_list
CREATE TABLE IF NOT EXISTS `service_checkout_list` (
  `CheckoutID` int(11) NOT NULL,
  `ServiceID` int(11) NOT NULL,
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
  `ItemsID` int(11) NOT NULL,
  PRIMARY KEY (`StocksID`),
  KEY `FK_stocks_items` (`ItemsID`),
  CONSTRAINT `FK_stocks_items` FOREIGN KEY (`ItemsID`) REFERENCES `items` (`ItemsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.stocks: ~0 rows (approximately)
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.supplier: ~0 rows (approximately)
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;

-- Dumping structure for table ooms.user
CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `TelephoneNo` varchar(15) NOT NULL,
  `Address` varchar(15) NOT NULL,
  `Status` char(50) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table ooms.using_brands
CREATE TABLE IF NOT EXISTS `using_brands` (
  `Using_BrandID` int(11) NOT NULL AUTO_INCREMENT,
  `Relationship` char(1) NOT NULL DEFAULT '0',
  `Status` char(1) NOT NULL DEFAULT '0',
  `BrandID` int(11) NOT NULL DEFAULT 0,
  `SupplierID` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Using_BrandID`),
  KEY `FK_using_brands_brand` (`BrandID`),
  KEY `FK_using_brands_supplier` (`SupplierID`),
  CONSTRAINT `FK_using_brands_brand` FOREIGN KEY (`BrandID`) REFERENCES `brand` (`BrandID`),
  CONSTRAINT `FK_using_brands_supplier` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ooms.using_brands: ~0 rows (approximately)
/*!40000 ALTER TABLE `using_brands` DISABLE KEYS */;
/*!40000 ALTER TABLE `using_brands` ENABLE KEYS */;

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
