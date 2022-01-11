-- DROP DB
DROP DATABASE s2shop;
CREATE DATABASE s2shop;
USE s2shop;

-- PRODUCT TABLE
CREATE TABLE `product` (
  `id` int NOT NULL COMMENT 'Product ID' PRIMARY KEY AUTO_INCREMENT,
  `sku` varchar(50) NOT NULL COMMENT 'Product SKU' UNIQUE,
  `attributes` json NOT NULL COMMENT 'Product attributes',
  `created_at` timestamp NOT NULL COMMENT 'Created At'
);

-- SAMPLE DATA
INSERT INTO `product` (`sku`, `attributes`, `created_at`) VALUES
('abc', '{\"foo\": \"bar\", \"size\": \"small\", \"grams\": \"100\"}', '2022-01-10 13:20:43'),
('bdf', '{\"foo\": \"bar\", \"size\": \"small\", \"grams\": \"100\"}', '2022-01-10 13:20:43'),
('ceg', '{\"foo\": \"bar\", \"size\": \"small\", \"grams\": \"100\"}', '2022-01-10 13:20:43'),
('dfa', '{\"foo\": \"bar\", \"size\": \"small\", \"grams\": \"100\"}', '2022-01-10 13:20:43');
