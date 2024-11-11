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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
