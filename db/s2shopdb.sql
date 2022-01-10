-- s2sdb.sql

-- DATABASE

DROP DATABASE IF EXISTS s2shop;
SET foreign_key_checks=0;
CREATE DATABASE s2shop;
USE s2shop;


-- ------------------------------------

-- ATTRIBUTE

DROP TABLE IF EXISTS `attribute`;

CREATE TABLE `attribute` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50) NOT NULL UNIQUE
);

INSERT INTO `attribute` (`name`) 
VALUES	('foo'),
	('grams'),
	('size');

-- ------------------------------------

-- PRODUCT 

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `sku` varchar(50) NOT NULL UNIQUE,
  `created_at` timestamp NOT NULL
);

INSERT INTO `product` (`id`, `sku`, `created_at`) 
VALUES	(10, 'abc', '2022-01-10 15:20:43'),
	(11, 'bdf', '2022-01-10 15:20:43'),
	(12, 'ceg', '2022-01-10 15:20:43'),
	(13, 'dfa', '2022-01-10 15:20:43');

-- ------------------------------------

-- PRODUCT ATTRIBUTE

DROP TABLE IF EXISTS `product_attribute`;

CREATE TABLE `product_attribute` (
  `id` int(11) NOT NULL COMMENT 'Index' PRIMARY KEY AUTO_INCREMENT,
  `product_id` int(11) NOT NULL COMMENT 'Product ID' REFERENCES `product`(`id`),
  `attribute_id` int(11) NOT NULL COMMENT 'Attribute ID' REFERENCES `attribute`(`id`),
  `attribute_value` varchar(255) NOT NULL COMMENT 'Attribute Value',
  `created_at` timestamp NOT NULL COMMENT 'Created At'
);

INSERT INTO `product_attribute` (`id`, `product_id`, `attribute_id`, `attribute_value`, `created_at`)
VALUES	(1, 10, 1, 'small', '2022-01-10 15:22:48'),
	(2, 10, 2, '100', '2022-01-10 15:22:48'),
	(3, 10, 3, 'bar', '2022-01-10 15:22:48');

-- -------------------------------------
