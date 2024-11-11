-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 11:39 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdsqemuujff`
--

-- --------------------------------------------------------

--
-- Table structure for table `visitors_invoices`
--

CREATE TABLE `visitors_invoices` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(256) DEFAULT NULL,
  `doc_id` varchar(115) DEFAULT NULL,
  `amount` varchar(256) NOT NULL,
  `nos_item` varchar(256) NOT NULL,
  `nos_days` varchar(256) NOT NULL,
  `adhoc_prices` varchar(256) DEFAULT NULL,
  `contact_name` varchar(256) DEFAULT NULL,
  `sent_stage` varchar(256) DEFAULT NULL,
  `phone` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `payment_method` varchar(256) DEFAULT NULL,
  `bill_address` varchar(256) DEFAULT NULL,
  `item_ids` varchar(256) DEFAULT NULL,
  `invoice_quotes_status` int(11) DEFAULT NULL,
  `ex_inv_date` timestamp NULL DEFAULT NULL,
  `invoice_status` int(11) NOT NULL,
  `inv_date` timestamp NULL DEFAULT NULL,
  `moloni_invoice` text,
  `owner_id` varchar(110) NOT NULL DEFAULT '31',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitors_invoices`
--

INSERT INTO `visitors_invoices` (`id`, `invoice_id`, `doc_id`, `amount`, `nos_item`, `nos_days`, `adhoc_prices`, `contact_name`, `sent_stage`, `phone`, `email`, `payment_method`, `bill_address`, `item_ids`, `invoice_quotes_status`, `ex_inv_date`, `invoice_status`, `inv_date`, `moloni_invoice`, `owner_id`, `created_at`, `updated_at`) VALUES
(1, '27877563', '', '33.30', '1', '1', '10', 'MyVis', '', '(798) 797-9879', 'myvis@yopmail.com', '2112063', '10600, Highland Springs Avenue, Beaumont, Riverside County, California, United States, 92223', '103', 0, '2024-01-16 18:30:00', 0, '2024-01-16 18:30:00', NULL, '31', '2024-01-18 05:51:12', '2024-01-18 05:51:12'),
(5, 'M/-1', '647491608', '77.7', '1', '1', '10', 'myvv', '', '(798) 797-9779', 'myvv@yopmail.com', '2112068', '10600, Highland Springs Avenue, Beaumont, Riverside County, California, United States, 92223', '103', 0, '2024-01-17 18:30:00', 1, '2024-01-17 18:30:00', NULL, '31', '2024-01-18 06:09:59', '2024-01-18 06:09:59'),
(20, 'M/-1', '647503000', '99.90', '1', '1', '50', 'samvv', '', '+17987987987', 'samvv@yopmail.com', '2112073', '10600, Highland Springs Avenue, Beaumont, Riverside County, California, United States, 92223', '103', 0, '2024-01-17 18:30:00', 1, '2024-01-17 18:30:00', NULL, '31', '2024-01-18 06:21:40', '2024-01-18 06:21:40'),
(21, '66198622', '', '22.20', '1', '1', '10', 'ads', '', '+12343242342', 'sada@yopmail.com', '', '20 De Gerlachekaai', '103', 0, '2024-01-17 18:30:00', 0, '2024-01-17 18:30:00', NULL, '31', '2024-01-18 06:22:14', '2024-01-18 06:22:14'),
(22, '57352085', '', '150.96', '1', '1', '110', 'Sammy', '', '+17897979798', 'sammy@yopmail.com', '2112063', '123, Queen Street West, Old Toronto, Toronto, Toronto, Toronto, Ontario, Canada, M5H 3M9', '103,100', 0, '2024-01-16 18:30:00', 0, '2024-01-16 18:30:00', NULL, '31', '2024-01-18 06:24:01', '2024-01-18 06:24:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `visitors_invoices`
--
ALTER TABLE `visitors_invoices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `visitors_invoices`
--
ALTER TABLE `visitors_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
