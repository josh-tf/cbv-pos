-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: cbvposdev-db
-- Generation Time: Sep 14, 2018 at 02:19 AM
-- Server version: 10.1.21-MariaDB-1~jessie
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbvpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_app_config`
--

CREATE TABLE `cbvpos_app_config` (
  `key` varchar(50) NOT NULL,
  `value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_app_config`
--

INSERT INTO `cbvpos_app_config` (`key`, `value`) VALUES
('address', '483 Victoria Street\r\nWest Melbourne\r\nVIC 3003'),
('allow_duplicate_barcodes', '0'),
('barcode_content', 'id'),
('barcode_first_row', 'category'),
('barcode_font', 'Arial'),
('barcode_font_size', '10'),
('barcode_formats', '[]'),
('barcode_generate_if_empty', '0'),
('barcode_height', '50'),
('barcode_num_in_row', '2'),
('barcode_page_cellspacing', '20'),
('barcode_page_width', '100'),
('barcode_second_row', 'item_code'),
('barcode_third_row', 'unit_price'),
('barcode_type', 'Code39'),
('barcode_width', '250'),
('cash_decimals', '2'),
('cash_rounding_code', '1'),
('client_id', '8024ef54-5c31-4aa0-99ab-8d37e5f5561d'),
('company', 'Computerbank Victoria Inc.'),
('company_logo', 'company_logo.png'),
('country_codes', 'au'),
('currency_decimals', '2'),
('currency_symbol', '$'),
('custom10_name', 'Box Only Price'),
('custom1_name', 'Build Date'),
('custom2_name', 'Brand / Model'),
('custom3_name', 'CPU Type'),
('custom4_name', 'CPU Speed'),
('custom5_name', 'RAM'),
('custom6_name', 'Storage'),
('custom7_name', 'Screen Size'),
('custom8_name', 'Optical Drive'),
('custom9_name', 'Extras'),
('customer_reward_enable', '0'),
('customer_sales_tax_support', '0'),
('dateformat', 'd/m/Y'),
('date_or_time_format', ''),
('default_origin_tax_code', ''),
('default_register_mode', 'sale'),
('default_sales_discount', '0'),
('default_tax_1_name', ' GST'),
('default_tax_1_rate', '10'),
('default_tax_2_name', ''),
('default_tax_2_rate', ''),
('default_tax_category', 'Standard'),
('default_tax_rate', '8'),
('derive_sale_quantity', '0'),
('dinner_table_enable', '0'),
('email', 'info@computerbank.org.au'),
('email_receipt_check_behaviour', 'last'),
('fax', ''),
('financial_year', '7'),
('gcaptcha_enable', '0'),
('gcaptcha_secret_key', ''),
('gcaptcha_site_key', ''),
('giftcard_number', 'series'),
('invoice_default_comments', 'Thank you for supporting Computerbank Victoria'),
('invoice_email_message', 'Dear {CU}, In attachment the receipt for sale $INV'),
('invoice_enable', '1'),
('language', 'english'),
('language_code', 'en-US'),
('last_used_invoice_number', '0'),
('last_used_quote_number', '0'),
('last_used_work_order_number', '0'),
('lines_per_page', '25'),
('line_sequence', '0'),
('mailpath', '/usr/sbin/sendmail'),
('msg_msg', ''),
('msg_pwd', ''),
('msg_src', ''),
('msg_uid', ''),
('notify_horizontal_position', 'center'),
('notify_vertical_position', 'bottom'),
('number_locale', 'en_AU'),
('payment_options_order', 'cashdebitcredit'),
('phone', '(03) 9600 9161'),
('print_bottom_margin', ''),
('print_footer', '0'),
('print_header', '0'),
('print_left_margin', ''),
('print_receipt_check_behaviour', 'last'),
('print_right_margin', ''),
('print_silently', '0'),
('print_top_margin', ''),
('protocol', 'sendmail'),
('quantity_decimals', '0'),
('quote_default_comments', 'This is a default quote comment'),
('receipt_font_size', '12'),
('receipt_show_company_name', '1'),
('receipt_show_description', '1'),
('receipt_show_serialnumber', '0'),
('receipt_show_taxes', '1'),
('receipt_show_total_discount', '1'),
('receipt_template', 'receipt_default'),
('receiving_calculate_average_price', '0'),
('recv_invoice_format', '{CO}'),
('return_policy', 'GST IS NOT APPLICABLE ON SECOND-HAND GOODS.'),
('sales_invoice_format', '{CO}'),
('sales_quote_format', 'Q%y{QSEQ:6}'),
('smtp_crypto', 'ssl'),
('smtp_host', 'imap.gmail.com'),
('smtp_pass', 'db1d6664c705b08988ced5ccd726c0115edabbca33ec148634dd011c1a85a7242d6cfed14578748d6587f497f93551269b8a732220bb56ceb630e36ab6511714tX/HhFucWgLOyPwdUHezPuecnUscPTPFcyL/sQeYW+Y='),
('smtp_port', '993'),
('smtp_timeout', '5'),
('smtp_user', ''),
('statistics', '1'),
('suggestions_first_column', 'name'),
('suggestions_second_column', ''),
('suggestions_third_column', ''),
('tax_decimals', '2'),
('tax_included', '1'),
('theme', 'united'),
('thousands_separator', 'thousands_separator'),
('timeformat', 'H:i:s'),
('timezone', 'Australia/Hobart'),
('website', 'www.computerbank.org.au'),
('work_order_enable', '0'),
('work_order_format', 'W%y{WSEQ:6}');

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_customers`
--

CREATE TABLE `cbvpos_customers` (
  `person_id` int(10) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `taxable` int(1) NOT NULL DEFAULT '1',
  `sales_tax_code` varchar(32) NOT NULL DEFAULT '1',
  `discount_percent` decimal(15,2) NOT NULL DEFAULT '0.00',
  `package_id` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_customers`
--

INSERT INTO `cbvpos_customers` (`person_id`, `company_name`, `account_number`, `taxable`, `sales_tax_code`, `discount_percent`, `package_id`, `points`, `deleted`) VALUES
(2, NULL, NULL, 1, '', '0.00', NULL, NULL, 0),
(5, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(6, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(7, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(8, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(9, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(10, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(11, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(12, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(13, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(14, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(15, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(16, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(17, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(19, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(20, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(21, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(22, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(23, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(24, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(25, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(26, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(27, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(28, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(29, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(30, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(31, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(32, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(33, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(34, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(35, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(36, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(37, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(38, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(39, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(40, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(41, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(42, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(43, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(44, NULL, NULL, 0, '', '0.00', NULL, NULL, 0),
(45, NULL, NULL, 0, '', '0.00', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_customers_packages`
--

CREATE TABLE `cbvpos_customers_packages` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(255) DEFAULT NULL,
  `points_percent` float NOT NULL DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_customers_packages`
--

INSERT INTO `cbvpos_customers_packages` (`package_id`, `package_name`, `points_percent`, `deleted`) VALUES
(1, 'Default', 0, 0),
(2, 'Bronze', 10, 0),
(3, 'Silver', 20, 0),
(4, 'Gold', 30, 0),
(5, 'Premium', 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_customers_points`
--

CREATE TABLE `cbvpos_customers_points` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `points_earned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_dinner_tables`
--

CREATE TABLE `cbvpos_dinner_tables` (
  `dinner_table_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_dinner_tables`
--

INSERT INTO `cbvpos_dinner_tables` (`dinner_table_id`, `name`, `status`, `deleted`) VALUES
(1, 'Delivery', 0, 0),
(2, 'Take Away', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_employees`
--

CREATE TABLE `cbvpos_employees` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `hash_version` int(1) NOT NULL DEFAULT '2',
  `language` varchar(48) DEFAULT NULL,
  `language_code` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_employees`
--

INSERT INTO `cbvpos_employees` (`username`, `password`, `person_id`, `deleted`, `hash_version`, `language`, `language_code`) VALUES
('admin', '$2y$10$vJBSMlD02EC7ENSrKfVQXuvq9tNRHMtcOA8MSK2NYS748HHWm.gcG', 1, 0, 2, '', ''),
('bill.b', '$2y$10$qwK8nh.fGMItvG9.uYrCwOBZwuHB4c5aH82BIwEfk3HdrZjXSKViC', 4, 0, 2, '', ''),
('frontdesk', '$2y$10$7MtM0KpwFHJZ3mVFgaS6cuPkg6DKa.QQBRlAFkWRMvvUfbBs2miyu', 18, 0, 2, '', ''),
('j.bush', '$2y$10$66wNQ4RNpzeKH0XVdpzGg.JLSCtU4TJ1tN.9rm2OfO.AOe6mHUjXu', 3, 0, 2, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_expenses`
--

CREATE TABLE `cbvpos_expenses` (
  `expense_id` int(10) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` decimal(15,2) NOT NULL,
  `payment_type` varchar(40) NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `employee_id` int(10) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `supplier_name` varchar(255) DEFAULT NULL,
  `supplier_tax_code` varchar(255) DEFAULT NULL,
  `tax_amount` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_expenses`
--

INSERT INTO `cbvpos_expenses` (`expense_id`, `date`, `amount`, `payment_type`, `expense_category_id`, `description`, `employee_id`, `deleted`, `supplier_name`, `supplier_tax_code`, `tax_amount`) VALUES
(1, '2017-04-20 07:00:00', '15.00', '', 1, 'Water', 1, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_expense_categories`
--

CREATE TABLE `cbvpos_expense_categories` (
  `expense_category_id` int(10) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_description` varchar(255) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_expense_categories`
--

INSERT INTO `cbvpos_expense_categories` (`expense_category_id`, `category_name`, `category_description`, `deleted`) VALUES
(1, 'Utilities', 'Water', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_giftcards`
--

CREATE TABLE `cbvpos_giftcards` (
  `record_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `giftcard_id` int(11) NOT NULL,
  `giftcard_number` varchar(255) DEFAULT NULL,
  `value` decimal(15,2) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  `person_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_grants`
--

CREATE TABLE `cbvpos_grants` (
  `permission_id` varchar(255) NOT NULL,
  `person_id` int(10) NOT NULL,
  `menu_group` varchar(32) DEFAULT 'home'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_grants`
--

INSERT INTO `cbvpos_grants` (`permission_id`, `person_id`, `menu_group`) VALUES
('config', 1, 'office'),
('config', 3, 'office'),
('config', 4, 'home'),
('customers', 1, 'home'),
('customers', 3, 'home'),
('customers', 4, 'home'),
('customers', 18, 'home'),
('employees', 1, 'office'),
('employees', 4, 'home'),
('expenses', 1, 'home'),
('expenses', 3, 'home'),
('expenses', 4, 'home'),
('expenses_categories', 1, 'home'),
('expenses_categories', 3, 'office'),
('expenses_categories', 4, 'home'),
('giftcards', 1, 'home'),
('giftcards', 3, 'home'),
('giftcards', 4, 'home'),
('home', 1, 'office'),
('home', 3, 'office'),
('home', 4, 'home'),
('items', 1, 'home'),
('items', 3, 'home'),
('items', 4, 'home'),
('items', 18, 'home'),
('items_stock', 1, '--'),
('items_stock', 3, '--'),
('items_stock', 4, '--'),
('items_stock', 18, '--'),
('item_kits', 1, 'home'),
('item_kits', 3, 'home'),
('item_kits', 4, 'home'),
('item_kits', 18, 'home'),
('messages', 1, 'home'),
('messages', 3, 'home'),
('messages', 4, 'home'),
('office', 1, 'home'),
('office', 3, 'home'),
('office', 4, 'home'),
('receivings', 1, 'home'),
('receivings', 3, 'home'),
('receivings', 4, 'home'),
('receivings_stock', 1, '--'),
('receivings_stock', 3, '--'),
('receivings_stock', 4, '--'),
('reports', 1, 'home'),
('reports', 3, 'home'),
('reports', 4, 'home'),
('reports', 18, 'home'),
('reports_categories', 1, '--'),
('reports_categories', 3, '--'),
('reports_categories', 4, '--'),
('reports_customers', 1, '--'),
('reports_customers', 3, '--'),
('reports_customers', 4, '--'),
('reports_discounts', 1, '--'),
('reports_discounts', 3, '--'),
('reports_discounts', 4, '--'),
('reports_employees', 1, '--'),
('reports_employees', 3, '--'),
('reports_employees', 4, '--'),
('reports_expenses_categories', 1, '--'),
('reports_expenses_categories', 3, '--'),
('reports_expenses_categories', 4, '--'),
('reports_inventory', 1, '--'),
('reports_inventory', 3, '--'),
('reports_inventory', 4, '--'),
('reports_items', 1, '--'),
('reports_items', 3, '--'),
('reports_items', 4, '--'),
('reports_items', 18, '--'),
('reports_payments', 1, '--'),
('reports_payments', 3, '--'),
('reports_payments', 4, '--'),
('reports_payments', 18, '--'),
('reports_receivings', 1, '--'),
('reports_receivings', 3, '--'),
('reports_receivings', 4, '--'),
('reports_sales', 1, '--'),
('reports_sales', 3, '--'),
('reports_sales', 4, '--'),
('reports_sales', 18, '--'),
('reports_suppliers', 1, '--'),
('reports_suppliers', 3, '--'),
('reports_suppliers', 4, '--'),
('reports_taxes', 1, '--'),
('reports_taxes', 3, '--'),
('reports_taxes', 4, '--'),
('sales', 1, 'home'),
('sales', 3, 'home'),
('sales', 4, 'home'),
('sales', 18, 'home'),
('sales_delete', 1, '--'),
('sales_delete', 3, '--'),
('sales_delete', 4, '--'),
('sales_delete', 18, '--'),
('sales_stock', 1, '--'),
('sales_stock', 3, '--'),
('sales_stock', 4, '--'),
('sales_stock', 18, '--'),
('suppliers', 1, 'home'),
('suppliers', 3, 'home'),
('suppliers', 4, 'home'),
('taxes', 1, 'office'),
('taxes', 3, 'office'),
('taxes', 4, 'home');

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_inventory`
--

CREATE TABLE `cbvpos_inventory` (
  `trans_id` int(11) NOT NULL,
  `trans_items` int(11) NOT NULL DEFAULT '0',
  `trans_user` int(11) NOT NULL DEFAULT '0',
  `trans_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trans_comment` text NOT NULL,
  `trans_location` int(11) NOT NULL,
  `trans_inventory` decimal(15,3) NOT NULL DEFAULT '0.000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_inventory`
--

INSERT INTO `cbvpos_inventory` (`trans_id`, `trans_items`, `trans_user`, `trans_date`, `trans_comment`, `trans_location`, `trans_inventory`) VALUES
(1, 1, 1, '2017-12-30 00:50:36', 'Manual Edit of Quantity', 1, '1.000'),
(2, 2, 1, '2017-12-30 00:50:36', 'Manual Edit of Quantity', 1, '1.000'),
(3, 1, 1, '2017-12-30 23:15:19', 'POS 1', 1, '-1.000'),
(4, 3, 1, '2017-12-30 23:27:43', 'Manual Edit of Quantity', 1, '0.000'),
(5, 3, 1, '2017-12-30 23:28:38', 'RECV 1', 1, '1.000'),
(6, 1, 1, '2017-12-31 09:37:27', 'RECV 2', 1, '1.000'),
(7, 2, 1, '2017-12-31 09:37:27', 'RECV 2', 1, '1.000'),
(8, 1, 1, '2017-12-31 09:39:07', 'POS 2', 1, '-1.000'),
(9, 2, 1, '2017-12-31 09:39:07', 'POS 2', 1, '-1.000'),
(10, 3, 1, '2018-04-25 13:51:20', 'POS 3', 1, '-1.000'),
(11, 2, 1, '2018-05-08 12:41:31', 'POS 4', 1, '-1.000'),
(12, 4, 1, '2018-05-08 12:43:55', 'Manual Edit of Quantity', 1, '1.000'),
(13, 5, 1, '2018-05-08 12:45:47', 'Manual Edit of Quantity', 1, '1.000'),
(14, 4, 1, '2018-05-08 12:46:07', 'POS 5', 1, '-1.000'),
(15, 2, 1, '2018-05-08 12:46:30', 'Deleting sale 4', 1, '1.000'),
(16, 4, 1, '2018-05-08 12:46:30', 'Deleting sale 5', 1, '1.000'),
(17, 4, 1, '2018-05-08 13:44:07', 'POS 6', 1, '-1.000'),
(18, 4, 1, '2018-05-08 13:44:21', 'Deleting sale 6', 1, '1.000'),
(19, 4, 1, '2018-05-08 13:49:18', 'POS 7', 1, '-1.000'),
(20, 4, 1, '2018-05-08 13:50:57', 'Deleting sale 7', 1, '1.000'),
(21, 4, 1, '2018-05-08 13:51:53', 'POS 8', 1, '-1.000'),
(22, 5, 1, '2018-05-08 13:54:17', 'POS 9', 1, '-1.000'),
(23, 4, 1, '2018-05-08 13:55:37', 'Deleting sale 8', 1, '1.000'),
(24, 5, 1, '2018-05-08 13:55:37', 'Deleting sale 9', 1, '1.000'),
(25, 4, 1, '2018-05-08 14:03:22', 'POS 10', 1, '-1.000'),
(26, 4, 1, '2018-05-08 14:03:52', 'Deleting sale 10', 1, '1.000'),
(27, 4, 1, '2018-05-08 14:03:59', 'POS 11', 1, '-1.000'),
(28, 4, 1, '2018-05-08 14:04:43', 'Deleting sale 11', 1, '1.000'),
(29, 4, 1, '2018-05-08 14:04:53', 'POS 12', 1, '-1.000'),
(30, 6, 3, '2018-06-15 09:31:38', 'Manual Edit of Quantity', 1, '1.000'),
(31, 7, 3, '2018-06-15 09:33:11', 'Manual Edit of Quantity', 1, '1.000'),
(32, 8, 3, '2018-06-15 09:34:38', 'Manual Edit of Quantity', 1, '1.000'),
(33, 9, 3, '2018-06-15 09:35:42', 'Manual Edit of Quantity', 1, '1.000'),
(34, 10, 3, '2018-06-15 09:36:06', 'Manual Edit of Quantity', 1, '1.000'),
(35, 11, 3, '2018-06-15 09:38:09', 'Manual Edit of Quantity', 1, '1.000'),
(36, 12, 3, '2018-06-15 09:39:33', 'Manual Edit of Quantity', 1, '1.000'),
(37, 13, 3, '2018-06-15 09:41:37', 'Manual Edit of Quantity', 1, '1.000'),
(38, 14, 3, '2018-06-15 09:42:46', 'Manual Edit of Quantity', 1, '1.000'),
(39, 15, 3, '2018-06-15 09:43:41', 'Manual Edit of Quantity', 1, '1.000'),
(40, 16, 3, '2018-06-15 09:44:59', 'Manual Edit of Quantity', 1, '1.000'),
(41, 17, 3, '2018-06-15 09:47:12', 'Manual Edit of Quantity', 1, '1.000'),
(42, 18, 3, '2018-06-15 09:49:22', 'Manual Edit of Quantity', 1, '1.000'),
(43, 19, 3, '2018-06-15 09:51:20', 'Manual Edit of Quantity', 1, '1.000'),
(44, 20, 3, '2018-06-15 09:53:24', 'Manual Edit of Quantity', 1, '1.000'),
(45, 21, 3, '2018-06-15 09:54:46', 'Manual Edit of Quantity', 1, '1.000'),
(46, 22, 3, '2018-06-15 09:56:22', 'Manual Edit of Quantity', 1, '1.000'),
(47, 23, 3, '2018-06-15 09:58:22', 'Manual Edit of Quantity', 1, '1.000'),
(48, 24, 3, '2018-06-15 09:59:46', 'Manual Edit of Quantity', 1, '1.000'),
(49, 2, 3, '2018-06-15 00:00:45', 'Deleted', 1, '-1.000'),
(50, 5, 3, '2018-06-15 00:00:45', 'Deleted', 1, '-1.000'),
(51, 25, 3, '2018-06-15 12:24:26', 'Manual Edit of Quantity', 1, '1.000'),
(52, 26, 3, '2018-06-15 12:25:06', 'Manual Edit of Quantity', 1, '1.000'),
(53, 7, 3, '2018-06-15 12:25:38', 'POS 13', 1, '-1.000'),
(54, 8, 3, '2018-06-15 12:38:00', 'POS 14', 1, '-1.000'),
(55, 20, 3, '2018-06-15 12:43:54', 'POS 15', 1, '-1.000'),
(56, 17, 3, '2018-06-15 13:42:55', 'POS 16', 1, '-1.000'),
(57, 17, 3, '2018-06-15 13:43:09', 'Deleting sale 16', 1, '1.000'),
(58, 27, 3, '2018-06-15 13:48:21', 'Manual Edit of Quantity', 1, '1.000'),
(59, 28, 3, '2018-06-15 13:49:20', 'Manual Edit of Quantity', 1, '1.000'),
(60, 17, 3, '2018-06-15 13:49:38', 'POS 17', 1, '-1.000'),
(61, 10, 3, '2018-06-15 14:08:03', 'POS 18', 1, '-1.000'),
(62, 9, 3, '2018-06-15 14:33:34', 'POS 19', 1, '-1.000'),
(63, 11, 3, '2018-06-15 14:38:18', 'POS 20', 1, '-1.000'),
(64, 29, 3, '2018-06-15 14:42:58', 'Manual Edit of Quantity', 1, '1.000'),
(65, 16, 3, '2018-06-15 14:43:11', 'POS 21', 1, '-1.000'),
(66, 6, 3, '2018-06-15 15:51:09', 'POS 22', 1, '-1.000'),
(67, 30, 3, '2018-06-15 15:52:12', 'Manual Edit of Quantity', 1, '1.000'),
(68, 30, 3, '2018-06-15 15:53:15', 'POS 23', 1, '-1.000'),
(69, 31, 3, '2018-06-15 16:19:27', 'Manual Edit of Quantity', 1, '1.000'),
(70, 32, 3, '2018-06-15 16:21:04', 'Manual Edit of Quantity', 1, '1.000'),
(71, 33, 3, '2018-06-15 16:46:51', 'Manual Edit of Quantity', 1, '1.000'),
(72, 34, 3, '2018-06-15 16:49:54', 'Manual Edit of Quantity', 1, '1.000'),
(73, 35, 3, '2018-06-15 16:50:48', 'Manual Edit of Quantity', 1, '1.000'),
(74, 36, 3, '2018-06-16 16:01:40', 'Manual Edit of Quantity', 1, '1.000'),
(75, 36, 3, '2018-06-16 16:02:27', 'POS 25', 1, '-1.000'),
(76, 36, 3, '2018-06-16 16:03:24', 'Deleting sale 25', 1, '1.000'),
(77, 36, 3, '2018-06-16 16:17:38', 'POS 26', 1, '-1.000'),
(78, 36, 3, '2018-06-16 16:18:45', 'Deleting sale 26', 1, '1.000'),
(79, 37, 3, '2018-06-16 16:19:07', 'Manual Edit of Quantity', 1, '1.000'),
(80, 36, 3, '2018-06-16 16:29:52', 'POS 30', 1, '-1.000'),
(81, 36, 3, '2018-06-16 16:30:06', 'Deleting sale 30', 1, '1.000'),
(82, 38, 3, '2018-06-18 16:41:43', 'Manual Edit of Quantity', 1, '1.000'),
(83, 39, 3, '2018-06-18 16:43:16', 'Manual Edit of Quantity', 1, '1.000'),
(84, 40, 3, '2018-06-18 16:44:09', 'Manual Edit of Quantity', 1, '1.000'),
(85, 40, 3, '2018-06-18 16:46:38', 'POS 38', 1, '-1.000'),
(86, 39, 1, '2018-06-19 15:15:18', 'POS 39', 1, '-1.000'),
(87, 39, 1, '2018-06-19 15:15:29', 'Deleting sale 39', 1, '1.000'),
(88, 36, 1, '2018-06-19 15:16:37', 'POS 40', 1, '-1.000'),
(89, 39, 1, '2018-06-19 15:16:37', 'POS 40', 1, '-1.000'),
(90, 36, 1, '2018-06-19 15:19:07', 'Deleting sale 40', 1, '1.000'),
(91, 39, 1, '2018-06-19 15:19:07', 'Deleting sale 40', 1, '1.000'),
(92, 36, 1, '2018-06-19 15:19:58', 'POS 41', 1, '-1.000'),
(93, 39, 1, '2018-06-19 15:19:58', 'POS 41', 1, '-1.000'),
(94, 38, 1, '2018-06-19 15:24:25', 'POS 42', 1, '-1.000'),
(95, 36, 1, '2018-06-19 15:31:24', 'Deleting sale 41', 1, '1.000'),
(96, 39, 1, '2018-06-19 15:31:24', 'Deleting sale 41', 1, '1.000'),
(97, 38, 1, '2018-06-19 15:31:24', 'Deleting sale 42', 1, '1.000'),
(98, 39, 1, '2018-06-19 15:32:06', 'Manual Edit of Quantity', 1, '999.000'),
(99, 38, 1, '2018-06-19 15:32:14', 'Manual Edit of Quantity', 1, '999.000'),
(100, 39, 1, '2018-06-19 15:32:30', 'POS 44', 1, '-1.000'),
(101, 39, 1, '2018-06-19 16:11:15', 'Deleting sale 44', 1, '1.000'),
(102, 41, 3, '2018-06-22 09:50:54', 'Manual Edit of Quantity', 1, '1.000'),
(103, 42, 3, '2018-06-22 09:54:11', 'Manual Edit of Quantity', 1, '1.000'),
(104, 43, 3, '2018-06-22 09:56:18', 'Manual Edit of Quantity', 1, '1.000'),
(105, 44, 3, '2018-06-22 09:57:10', 'Manual Edit of Quantity', 1, '1.000'),
(106, 45, 3, '2018-06-22 09:59:01', 'Manual Edit of Quantity', 1, '1.000'),
(107, 46, 3, '2018-06-22 10:00:05', 'Manual Edit of Quantity', 1, '1.000'),
(108, 47, 3, '2018-06-22 10:00:25', 'Manual Edit of Quantity', 1, '1.000'),
(109, 48, 3, '2018-06-22 10:02:53', 'Manual Edit of Quantity', 1, '1.000'),
(110, 14, 3, '2018-06-22 11:49:47', 'POS 45', 1, '-1.000'),
(111, 14, 3, '2018-06-22 11:50:49', 'Deleting sale 45', 1, '1.000'),
(112, 49, 3, '2018-06-22 11:51:25', 'Manual Edit of Quantity', 1, '1.000'),
(113, 14, 3, '2018-06-22 11:52:22', 'POS 46', 1, '-1.000'),
(114, 49, 3, '2018-06-22 11:52:22', 'POS 46', 1, '-1.000'),
(115, 50, 3, '2018-06-22 12:55:48', 'Manual Edit of Quantity', 1, '1.000'),
(116, 50, 3, '2018-06-22 12:56:56', 'POS 47', 1, '-1.000'),
(117, 38, 3, '2018-06-22 12:56:56', 'POS 47', 1, '-1.000'),
(118, 38, 3, '2018-06-22 13:11:15', 'Deleting sale 47', 1, '1.000'),
(119, 50, 3, '2018-06-22 13:11:15', 'Deleting sale 47', 1, '1.000'),
(120, 51, 3, '2018-06-22 13:13:05', 'Manual Edit of Quantity', 1, '1.000'),
(121, 51, 3, '2018-06-22 14:00:12', 'POS 48', 1, '-1.000'),
(122, 43, 3, '2018-06-22 14:02:18', 'POS 49', 1, '-1.000'),
(123, 52, 3, '2018-06-22 14:04:54', 'Manual Edit of Quantity', 1, '1.000'),
(124, 53, 3, '2018-06-22 14:08:29', 'Manual Edit of Quantity', 1, '1.000'),
(125, 54, 3, '2018-06-22 14:09:26', 'Manual Edit of Quantity', 1, '2.000'),
(126, 52, 3, '2018-06-22 14:10:07', 'POS 50', 1, '-1.000'),
(127, 53, 3, '2018-06-22 14:10:07', 'POS 50', 1, '-1.000'),
(128, 54, 3, '2018-06-22 14:10:07', 'POS 50', 1, '-2.000'),
(129, 55, 3, '2018-06-22 14:18:57', 'Manual Edit of Quantity', 1, '1.000'),
(130, 56, 3, '2018-06-22 15:09:50', 'Manual Edit of Quantity', 1, '1.000'),
(131, 56, 3, '2018-06-22 15:10:22', 'POS 51', 1, '-1.000'),
(132, 51, 3, '2018-06-22 15:43:26', 'Deleting sale 48', 1, '1.000'),
(133, 51, 3, '2018-06-22 15:45:01', 'POS 52', 1, '-1.000'),
(134, 57, 3, '2018-06-22 15:50:16', 'Manual Edit of Quantity', 1, '1.000'),
(135, 57, 3, '2018-06-22 15:51:04', 'POS 53', 1, '-1.000'),
(136, 58, 3, '2018-06-22 16:44:39', 'Manual Edit of Quantity', 1, '1.000'),
(137, 59, 3, '2018-06-22 16:48:08', 'Manual Edit of Quantity', 1, '1.000'),
(138, 59, 3, '2018-06-22 16:48:35', 'POS 54', 1, '-1.000'),
(139, 60, 3, '2018-06-22 16:55:57', 'Manual Edit of Quantity', 1, '1.000'),
(140, 38, 3, '2018-06-23 13:38:04', 'POS 56', 1, '-1.000'),
(141, 38, 3, '2018-06-23 13:38:15', 'Deleting sale 56', 1, '1.000'),
(142, 61, 1, '2018-06-25 11:14:14', 'Manual Edit of Quantity', 1, '1.000'),
(143, 29, 1, '2018-06-25 23:06:58', 'Deleted', 1, '-1.000'),
(144, 62, 3, '2018-06-29 10:00:45', 'Manual Edit of Quantity', 1, '1.000'),
(145, 63, 3, '2018-06-29 10:05:15', 'Manual Edit of Quantity', 1, '1.000'),
(146, 64, 3, '2018-06-29 10:06:24', 'Manual Edit of Quantity', 1, '1.000'),
(147, 65, 3, '2018-06-29 10:07:35', 'Manual Edit of Quantity', 1, '1.000'),
(148, 66, 3, '2018-06-29 10:08:25', 'Manual Edit of Quantity', 1, '1.000'),
(149, 67, 3, '2018-06-29 10:09:29', 'Manual Edit of Quantity', 1, '1.000'),
(150, 68, 3, '2018-06-29 10:11:34', 'Manual Edit of Quantity', 1, '1.000'),
(151, 69, 3, '2018-06-29 10:12:46', 'Manual Edit of Quantity', 1, '1.000'),
(152, 44, 3, '2018-06-29 10:20:08', 'POS 57', 1, '-1.000'),
(153, 12, 3, '2018-06-29 10:22:45', 'Manual Edit of Quantity', 1, '-1.000'),
(154, 15, 3, '2018-06-29 10:23:18', 'Manual Edit of Quantity', 1, '-1.000'),
(155, 41, 3, '2018-06-29 10:23:28', 'Manual Edit of Quantity', 1, '-1.000'),
(156, 41, 3, '2018-06-29 10:23:53', 'Manual Edit of Quantity', 1, '1.000'),
(157, 39, 3, '2018-06-29 11:21:56', 'POS 58', 1, '-1.000'),
(158, 19, 3, '2018-06-29 11:21:56', 'POS 58', 1, '-1.000'),
(159, 19, 3, '2018-06-29 11:22:45', 'Deleting sale 58', 1, '1.000'),
(160, 39, 3, '2018-06-29 11:22:45', 'Deleting sale 58', 1, '1.000'),
(161, 44, 3, '2018-06-29 11:22:50', 'Deleting sale 57', 1, '1.000'),
(162, 31, 3, '2018-06-29 11:25:50', 'Manual Edit of Quantity', 1, '-1.000'),
(163, 23, 3, '2018-06-29 11:26:06', 'Manual Edit of Quantity', 1, '-1.000'),
(164, 39, 3, '2018-06-29 11:28:06', 'POS 59', 1, '-1.000'),
(165, 19, 3, '2018-06-29 11:28:06', 'POS 59', 1, '-1.000'),
(166, 19, 3, '2018-06-29 11:28:28', 'Deleting sale 59', 1, '1.000'),
(167, 39, 3, '2018-06-29 11:28:28', 'Deleting sale 59', 1, '1.000'),
(168, 39, 3, '2018-06-29 11:28:49', 'POS 60', 1, '-1.000'),
(169, 19, 3, '2018-06-29 11:28:49', 'POS 60', 1, '-1.000'),
(170, 70, 18, '2018-06-29 12:03:21', 'Manual Edit of Quantity', 1, '1.000'),
(171, 70, 18, '2018-06-29 12:04:57', 'POS 61', 1, '-1.000'),
(172, 60, 18, '2018-06-29 12:04:57', 'POS 61', 1, '-1.000'),
(173, 71, 18, '2018-06-29 13:30:21', 'Manual Edit of Quantity', 1, '1.000'),
(174, 71, 18, '2018-06-29 13:32:15', 'POS 62', 1, '-1.000'),
(175, 24, 18, '2018-06-29 13:32:15', 'POS 62', 1, '-1.000'),
(176, 62, 18, '2018-06-29 13:34:00', 'POS 63', 1, '-1.000'),
(177, 72, 18, '2018-06-29 13:46:29', 'Manual Edit of Quantity', 1, '1.000'),
(178, 72, 18, '2018-06-29 13:46:52', 'POS 64', 1, '-1.000'),
(179, 62, 18, '2018-06-29 16:56:19', 'Deleting sale 63', 1, '1.000'),
(180, 62, 18, '2018-06-29 16:57:24', 'POS 65', 1, '-1.000'),
(181, 73, 18, '2018-06-29 16:58:05', 'Manual Edit of Quantity', 1, '1.000'),
(182, 73, 18, '2018-06-29 16:58:25', 'POS 66', 1, '-1.000'),
(183, 69, 3, '2018-07-06 09:08:26', 'Manual Edit of Quantity', 1, '-1.000'),
(184, 67, 3, '2018-07-06 09:08:38', 'Manual Edit of Quantity', 1, '-1.000'),
(185, 63, 3, '2018-07-06 09:08:50', 'Manual Edit of Quantity', 1, '-1.000'),
(186, 65, 3, '2018-07-06 09:09:02', 'Manual Edit of Quantity', 1, '-1.000'),
(187, 66, 3, '2018-07-06 09:09:12', 'Manual Edit of Quantity', 1, '-1.000'),
(188, 68, 3, '2018-07-06 09:09:28', 'Manual Edit of Quantity', 1, '-1.000'),
(189, 64, 3, '2018-07-06 09:09:50', 'Manual Edit of Quantity', 1, '-1.000'),
(190, 32, 3, '2018-07-06 09:10:30', 'Manual Edit of Quantity', 1, '-1.000'),
(191, 46, 3, '2018-07-06 09:10:39', 'Manual Edit of Quantity', 1, '-1.000'),
(192, 42, 3, '2018-07-06 09:10:51', 'Manual Edit of Quantity', 1, '-1.000'),
(193, 41, 3, '2018-07-06 09:11:05', 'Manual Edit of Quantity', 1, '-1.000'),
(194, 47, 3, '2018-07-06 09:11:19', 'Manual Edit of Quantity', 1, '-1.000'),
(195, 74, 3, '2018-07-06 09:23:28', 'Manual Edit of Quantity', 1, '1.000'),
(196, 75, 3, '2018-07-06 09:26:53', 'Manual Edit of Quantity', 1, '1.000'),
(197, 76, 3, '2018-07-06 09:32:34', 'Manual Edit of Quantity', 1, '1.000'),
(198, 77, 3, '2018-07-06 09:35:12', 'Manual Edit of Quantity', 1, '1.000'),
(199, 78, 3, '2018-07-06 09:37:05', 'Manual Edit of Quantity', 1, '1.000'),
(200, 79, 3, '2018-07-06 09:38:41', 'Manual Edit of Quantity', 1, '1.000'),
(201, 80, 3, '2018-07-06 09:39:34', 'Manual Edit of Quantity', 1, '1.000'),
(202, 81, 3, '2018-07-06 09:40:38', 'Manual Edit of Quantity', 1, '1.000'),
(203, 82, 3, '2018-07-06 09:42:09', 'Manual Edit of Quantity', 1, '1.000'),
(204, 83, 3, '2018-07-06 09:43:41', 'Manual Edit of Quantity', 1, '1.000'),
(205, 77, 3, '2018-07-06 12:44:25', 'POS 67', 1, '-1.000'),
(206, 74, 3, '2018-07-06 12:55:46', 'POS 68', 1, '-1.000'),
(207, 39, 3, '2018-07-06 12:55:46', 'POS 68', 1, '-1.000'),
(208, 80, 3, '2018-07-06 14:14:46', 'POS 70', 1, '-1.000'),
(209, 82, 3, '2018-07-06 14:16:26', 'POS 71', 1, '-1.000'),
(210, 84, 3, '2018-07-06 14:18:05', 'Manual Edit of Quantity', 1, '1.000'),
(211, 84, 3, '2018-07-06 14:19:05', 'POS 72', 1, '-1.000'),
(212, 39, 3, '2018-07-06 14:19:05', 'POS 72', 1, '-1.000'),
(213, 79, 3, '2018-07-06 14:20:59', 'POS 73', 1, '-1.000'),
(214, 85, 1, '2018-07-07 14:18:14', 'Manual Edit of Quantity', 1, '1.000'),
(215, 39, 3, '2018-07-08 10:47:15', 'POS 74', 1, '-1.000'),
(216, 13, 3, '2018-07-08 10:49:33', 'POS 75', 1, '-1.000'),
(217, 39, 3, '2018-07-08 10:49:33', 'POS 75', 1, '-1.000'),
(218, 86, 3, '2018-07-08 10:52:25', 'Manual Edit of Quantity', 1, '1.000'),
(219, 86, 3, '2018-07-08 10:52:53', 'POS 76', 1, '-1.000'),
(220, 39, 3, '2018-07-08 10:52:53', 'POS 76', 1, '-1.000'),
(221, 86, 3, '2018-07-09 10:24:14', 'Manual Edit of Quantity', 1, '10.000'),
(222, 86, 3, '2018-07-09 10:24:34', 'POS 77', 1, '-1.000'),
(223, 39, 3, '2018-07-10 16:00:56', 'POS 78', 1, '-1.000'),
(224, 39, 3, '2018-07-10 16:01:26', 'Deleting sale 78', 1, '1.000'),
(225, 38, 1, '2018-08-08 21:59:14', 'Manual Edit of Quantity', 1, '-1000.000'),
(226, 38, 1, '2018-08-08 21:59:47', 'Manual Edit of Quantity', 1, '1.000'),
(227, 87, 3, '2018-08-09 10:32:22', 'Manual Edit of Quantity', 1, '1.000'),
(228, 78, 3, '2018-08-09 15:58:53', 'POS 80', 1, '-1.000'),
(229, 84, 3, '2018-08-09 16:00:15', 'Manual Edit of Quantity', 1, '1.000'),
(230, 78, 1, '2018-08-10 14:57:44', 'Deleting sale 80', 1, '1.000'),
(231, 82, 1, '2018-08-10 15:13:41', 'RECV 3', 1, '-1.000'),
(232, 82, 1, '2018-08-10 15:17:29', 'Deleting receiving 3', 1, '1.000'),
(233, 82, 1, '2018-08-10 15:18:29', 'RECV 4', 1, '1.000'),
(234, 20, 1, '2018-08-10 15:27:22', 'RECV 5', 1, '1.000'),
(235, 40, 1, '2018-08-10 15:43:29', 'RECV 6', 1, '1.000'),
(236, 18, 3, '2018-08-13 10:48:50', 'POS 82', 1, '-1.000'),
(237, 55, 3, '2018-08-13 10:50:09', 'POS 84', 1, '-1.000'),
(238, 20, 3, '2018-08-13 10:51:00', 'POS 85', 1, '-1.000'),
(239, 22, 3, '2018-08-13 10:51:47', 'POS 86', 1, '-1.000'),
(240, 88, 3, '2018-08-17 09:28:26', 'Manual Edit of Quantity', 1, '1.000'),
(241, 89, 3, '2018-08-17 09:40:18', 'Manual Edit of Quantity', 1, '1.000'),
(242, 90, 3, '2018-08-17 09:47:16', 'Manual Edit of Quantity', 1, '1.000'),
(243, 91, 3, '2018-08-17 09:49:03', 'Manual Edit of Quantity', 1, '1.000'),
(244, 92, 3, '2018-08-17 09:53:25', 'Manual Edit of Quantity', 1, '1.000'),
(245, 93, 3, '2018-08-17 09:56:52', 'Manual Edit of Quantity', 1, '1.000'),
(246, 94, 3, '2018-08-17 09:57:54', 'Manual Edit of Quantity', 1, '1.000'),
(247, 95, 3, '2018-08-17 09:59:03', 'Manual Edit of Quantity', 1, '1.000'),
(248, 96, 3, '2018-08-17 10:00:46', 'Manual Edit of Quantity', 1, '1.000'),
(249, 97, 3, '2018-08-17 10:01:39', 'Manual Edit of Quantity', 1, '1.000'),
(250, 98, 3, '2018-08-17 10:03:02', 'Manual Edit of Quantity', 1, '1.000'),
(251, 97, 3, '2018-08-17 11:37:09', 'POS 88', 1, '-1.000'),
(252, 93, 3, '2018-08-17 12:04:04', 'POS 89', 1, '-1.000'),
(253, 99, 1, '2018-08-17 13:27:37', 'Manual Edit of Quantity', 1, '1.000'),
(254, 99, 1, '2018-08-17 13:28:53', 'POS 90', 1, '-1.000'),
(255, 100, 18, '2018-08-17 13:48:30', 'Manual Edit of Quantity', 1, '1.000'),
(256, 101, 18, '2018-08-17 13:49:54', 'Manual Edit of Quantity', 1, '1.000'),
(257, 101, 18, '2018-08-17 13:49:59', 'POS 91', 1, '-1.000'),
(258, 102, 18, '2018-08-17 13:57:17', 'Manual Edit of Quantity', 1, '1.000'),
(259, 98, 18, '2018-08-17 14:33:24', 'POS 92', 1, '-1.000'),
(260, 103, 18, '2018-08-17 14:37:00', 'Manual Edit of Quantity', 1, '1.000'),
(261, 96, 18, '2018-08-17 14:48:45', 'POS 93', 1, '-1.000'),
(262, 95, 18, '2018-08-17 16:07:16', 'POS 94', 1, '-1.000'),
(263, 104, 18, '2018-08-17 16:08:27', 'Manual Edit of Quantity', 1, '1.000'),
(264, 105, 18, '2018-08-17 16:09:07', 'Manual Edit of Quantity', 1, '1.000'),
(265, 104, 18, '2018-08-17 16:09:12', 'POS 95', 1, '-1.000'),
(266, 105, 18, '2018-08-17 16:09:12', 'POS 95', 1, '-1.000'),
(267, 106, 18, '2018-08-17 16:09:34', 'Manual Edit of Quantity', 1, '1.000'),
(268, 27, 18, '2018-08-17 16:10:00', 'POS 96', 1, '-1.000'),
(269, 94, 18, '2018-08-17 16:51:31', 'POS 97', 1, '-1.000'),
(270, 107, 18, '2018-08-17 16:57:20', 'Manual Edit of Quantity', 1, '1.000'),
(271, 85, 1, '2018-08-23 13:28:32', 'POS 98', 1, '-1.000'),
(272, 85, 1, '2018-08-23 13:29:29', 'Deleting sale 98', 1, '1.000'),
(273, 85, 1, '2018-08-23 13:31:11', 'POS 99', 1, '-1.000'),
(274, 36, 1, '2018-08-23 13:32:34', 'POS 100', 1, '-1.000'),
(275, 85, 1, '2018-08-23 13:33:45', 'Deleting sale 99', 1, '1.000'),
(276, 36, 1, '2018-08-23 13:33:45', 'Deleting sale 100', 1, '1.000'),
(277, 36, 1, '2018-08-23 13:34:13', 'POS 101', 1, '-1.000'),
(278, 40, 1, '2018-08-23 13:35:37', 'POS 102', 1, '-1.000'),
(279, 36, 3, '2018-08-24 11:03:20', 'Deleting sale 101', 1, '1.000'),
(280, 40, 3, '2018-08-24 11:03:20', 'Deleting sale 102', 1, '1.000'),
(281, 36, 3, '2018-08-24 11:03:58', 'POS 103', 1, '-1.000'),
(282, 36, 3, '2018-08-24 11:04:34', 'Deleting sale 103', 1, '1.000'),
(283, 36, 3, '2018-08-24 11:04:59', 'POS 104', 1, '-1.000'),
(284, 36, 3, '2018-08-24 11:05:30', 'Deleting sale 104', 1, '1.000'),
(285, 36, 3, '2018-08-24 11:43:46', 'POS 105', 1, '-1.000'),
(286, 36, 3, '2018-08-24 11:46:29', 'Deleting sale 105', 1, '1.000'),
(287, 36, 3, '2018-08-24 13:41:06', 'POS 106', 1, '-1.000'),
(288, 36, 3, '2018-08-24 13:41:21', 'Deleting sale 106', 1, '1.000'),
(289, 36, 3, '2018-08-24 13:48:09', 'POS 107', 1, '-1.000'),
(290, 108, 3, '2018-08-24 14:03:05', 'Manual Edit of Quantity', 1, '1.000'),
(291, 108, 3, '2018-08-24 14:03:39', 'POS 108', 1, '-1.000'),
(292, 36, 3, '2018-08-24 14:04:32', 'Deleting sale 107', 1, '1.000'),
(293, 108, 3, '2018-08-24 14:04:32', 'Deleting sale 108', 1, '1.000'),
(294, 36, 1, '2018-09-01 13:34:07', 'POS 109', 1, '-1.000');

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_items`
--

CREATE TABLE `cbvpos_items` (
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `item_number` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `cost_price` decimal(15,2) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `reorder_level` decimal(15,3) NOT NULL DEFAULT '0.000',
  `receiving_quantity` decimal(15,3) NOT NULL DEFAULT '1.000',
  `item_id` int(10) NOT NULL,
  `pic_filename` varchar(255) DEFAULT NULL,
  `allow_alt_description` tinyint(1) NOT NULL,
  `is_serialized` tinyint(1) NOT NULL,
  `stock_type` tinyint(2) NOT NULL DEFAULT '0',
  `item_type` tinyint(2) NOT NULL DEFAULT '0',
  `tax_category_id` int(10) NOT NULL DEFAULT '1',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `custom1` varchar(255) DEFAULT NULL,
  `custom2` varchar(255) DEFAULT NULL,
  `custom3` varchar(255) DEFAULT NULL,
  `custom4` varchar(255) DEFAULT NULL,
  `custom5` varchar(255) DEFAULT NULL,
  `custom6` varchar(255) DEFAULT NULL,
  `custom7` varchar(255) DEFAULT NULL,
  `custom8` varchar(255) DEFAULT NULL,
  `custom9` varchar(255) DEFAULT NULL,
  `custom10` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_items`
--

INSERT INTO `cbvpos_items` (`name`, `category`, `supplier_id`, `item_number`, `description`, `cost_price`, `unit_price`, `reorder_level`, `receiving_quantity`, `item_id`, `pic_filename`, `allow_alt_description`, `is_serialized`, `stock_type`, `item_type`, `tax_category_id`, `deleted`, `custom1`, `custom2`, `custom3`, `custom4`, `custom5`, `custom6`, `custom7`, `custom8`, `custom9`, `custom10`) VALUES
('Item Name', 'Category', NULL, NULL, '', '0.00', '50.00', '1.000', '1.000', 1, NULL, 0, 0, 0, 0, 0, 1, '', '', '', '', '', '', '', '', '', ''),
('Item Name 2', 'Category', NULL, NULL, '', '0.00', '50.00', '1.000', '1.000', 2, NULL, 0, 0, 0, 0, 0, 1, '', '', '', '', '', '', '', '', '', ''),
('Blah', 'Laptop', NULL, NULL, '', '0.00', '40.00', '1.000', '0.000', 3, NULL, 0, 0, 0, 0, 0, 1, '', '', '', '', '', '', '', '', '', ''),
('822', 'Laptop', NULL, NULL, 'Laptop, Dell E6400, C2D, 2.4 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.6\" Monitor', '0.00', '100.00', '0.000', '1.000', 4, NULL, 0, 0, 0, 0, 0, 1, '23/4/18', 'Dell E6400', 'C2D', '2.4', '4', '160', '15.6', 'DVD-RW', '', ''),
('823', 'Desktop', NULL, NULL, 'Desktop, Generic, i7, 2.8 GHz, 8 GB RAM, 250 GB HDD, DVD-RW, 22\" Monitor', '0.00', '250.00', '0.000', '1.000', 5, NULL, 0, 0, 0, 0, 0, 1, '23/4/18', 'Generic', 'i7', '2.8', '8', '250', '22', 'DVD-RW', '', '220'),
('8910', 'Laptop', NULL, NULL, 'Laptop,\r\n Lenovo T520, i5, 2.3 GHz, 4 GB RAM, 320 GB HDD, DVD-RW, 15.6\" Monitor', '0.00', '155.00', '0.000', '1.000', 6, NULL, 0, 0, 0, 0, 0, 0, '', 'Lenovo T520', 'i5', '2.3', '4', '320', '15.6', 'DVD-RW', '', ''),
('8907', 'Laptop', NULL, NULL, 'Laptop, Lenovo T520, i5, 2.4 GHz, 4 GB RAM, 750 GB HDD, DVD-RW, 15.6\" Monitor', '0.00', '165.00', '0.000', '1.000', 7, NULL, 0, 0, 0, 0, 0, 0, '', 'Lenovo T520', 'i5', '2.4', '4', '750', '15.6', 'DVD-RW', '', ''),
('8914', 'Laptop', NULL, NULL, 'Lenovo T520, Lenovo T520, i5, 2.6 GHz, 4 GB RAM, 320 GB HDD, DVD-RW, 15.6\" Monitor', '0.00', '165.00', '0.000', '1.000', 8, NULL, 0, 0, 0, 0, 0, 0, '', 'Lenovo T520', 'i5', '2.6', '4', '320', '15.6', 'DVD-RW', '', ''),
('8941', 'Laptop', NULL, NULL, 'Laptop, HP Elitebook 8440P, i5, 2.9 GHz, 4 GB RAM, 320 GB HDD, DVD-RW, 14\" Monitor', '0.00', '180.00', '0.000', '1.000', 9, NULL, 0, 0, 0, 0, 0, 0, '', 'HP Elitebook 8440P', 'i5', '2.9', '4', '320', '14', 'DVD-RW', '', ''),
('8944', 'Laptop', NULL, NULL, 'Laptop, HP Elitebook 8460P, i5, 3.2 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 14\" Monitor', '0.00', '235.00', '0.000', '1.000', 10, NULL, 0, 0, 0, 0, 0, 0, '', 'HP Elitebook 8460P', 'i5', '3.2', '4', '160 SSD', '14', 'DVD-RW', '', ''),
('8939', 'Laptop', NULL, NULL, 'Laptop, 240, i5, 3.2 GHz, 4 GB RAM, 160 SSD GB HDD, DVD-RW, 14\" Monitor', '0.00', '163.00', '0.000', '1.000', 11, NULL, 0, 0, 0, 0, 0, 0, '', '240', 'i5', '3.2', '4', '160 SSD', '14', 'DVD-RW', '', ''),
('8945', 'Laptop', NULL, NULL, 'Laptop, Hp Elitebook 9470U, i5, 2.8 GHz, 8 GB RAM, 320 SSD GB HDD, , 15.6\" Monitor', '0.00', '265.00', '0.000', '1.000', 12, NULL, 0, 0, 0, 0, 0, 0, '', 'Hp Elitebook 9470U', 'i5', '2.8', '8', '320 SSD', '15.6', '', '', ''),
('8937', 'Desktop', NULL, NULL, 'Desktop, Lenovo, C2D, 3.0 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15\" Monitor', '0.00', '50.00', '0.000', '1.000', 13, NULL, 0, 0, 0, 0, 0, 0, '2018-06-13', 'Lenovo', 'C2D', '3.0', '4', '160', '15', 'DVD-RW', '', '34'),
('8923', 'Desktop', NULL, NULL, 'Desktop, Lenovo, C2D, 3.0 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 19\" Monitor', '0.00', '58.00', '0.000', '1.000', 14, NULL, 0, 0, 0, 0, 0, 0, '', 'Lenovo', 'C2D', '3.0', '4', '160', '19', 'DVD-RW', '', '38'),
('8947', 'Desktop', NULL, NULL, 'Desktop, HP, C2D, 3.0 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 19\" Monitor', '0.00', '58.00', '0.000', '1.000', 15, NULL, 0, 0, 0, 0, 0, 0, '', 'HP', 'C2D', '3.0', '4', '160', '19', 'DVD-RW', '', '38'),
('8787', 'Desktop', NULL, NULL, 'Desktop, Lenovo, i5, 3.2 GHz, 4 GB RAM, 250 GB HDD, DVD-RW, 19\" Monitor', '0.00', '163.00', '0.000', '1.000', 16, NULL, 0, 0, 0, 0, 0, 0, '', 'Lenovo', 'i5', '3.2', '4', '250', '19', 'DVD-RW', '', '140'),
('8946', 'Desktop', NULL, NULL, 'Desktop, HP 4300 SFF, i5, 2.9 GHz, 4 GB RAM, 500 GB HDD, DVD-RW, 19\" Monitor', '0.00', '180.00', '0.000', '1.000', 17, NULL, 0, 0, 0, 0, 0, 0, '', 'HP 4300 SFF', 'i5', '2.9', '4', '500', '19', 'DVD-RW', '', '160'),
('8911', 'Desktop', NULL, NULL, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '200.00', '0.000', '1.000', 18, NULL, 0, 0, 0, 0, 0, 0, '', 'Lenovo', 'i5', '3.6', '4', '500', '19 + spkrs', 'DVD-RW', '', '177'),
('8940', 'Desktop', NULL, NULL, 'Desktop, Lenovo Thinkcentre, i5, 3.2 GHz, 8 GB RAM, 500 GB HDD, DVD-RW, 22\" Monitor', '0.00', '220.00', '0.000', '1.000', 19, NULL, 0, 0, 0, 0, 0, 0, '', 'Lenovo Thinkcentre', 'i5', '3.2', '8', '500', '22', 'DVD-RW', '', '190'),
('8924', 'Tower', NULL, NULL, 'Tower, Generic, i7, 2.8 GHz, 8 GB RAM, 1000 GB HDD, DVD-RW, 22\" Monitor', '0.00', '230.00', '0.000', '1.000', 20, NULL, 0, 0, 0, 0, 0, 0, '', 'Generic', 'i7', '2.8', '8', '1000', '22', 'DVD-RW', '1 G', '200'),
('8935', 'Desktop', NULL, NULL, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '230.00', '0.000', '1.000', 21, NULL, 0, 0, 0, 0, 0, 0, '', 'Dell 9020', 'i5', '3.3', '8', '500', '19', 'DVD-RW', '', '210'),
('8932', 'Desktop', NULL, NULL, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '255.00', '0.000', '1.000', 22, NULL, 0, 0, 0, 0, 0, 0, '', 'HP 6300', 'i7', '3.4', '8', '1000', '19', 'DVD-RW', '', '230'),
('8931', 'Tower', NULL, NULL, 'Tower, Generic, i5, 3.4 GHz, 8 GB RAM, 250 + 1TB GB HDD, DVD-RW, 19 + spkrs\" Monitor', '0.00', '268.00', '0.000', '1.000', 23, NULL, 0, 0, 0, 0, 0, 0, '', 'Generic', 'i5', '3.4', '8', '250 + 1TB', '19 + spkrs', 'DVD-RW', '2 GB', '245'),
('8933', 'Desktop', NULL, NULL, 'Desktop, HP 6800, i7, 3.4 GHz, 8 GB RAM, 1000 GB HDD, DVD-RW, 23 wide\" Monitor', '0.00', '310.00', '0.000', '1.000', 24, NULL, 0, 0, 0, 0, 0, 0, '', 'HP 6800', 'i7', '3.4', '8', '1000', '23 wide', 'DVD-RW', '', '230'),
('Laptop Case', 'Miscellaneous', NULL, NULL, 'Miscellaneous, , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '0.00', '0.000', '1.000', 25, NULL, 0, 0, 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('Computer case', 'Miscellaneous', NULL, NULL, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '0.00', '0.000', '1.000', 26, NULL, 0, 0, 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('Keyboard + Mouse', 'Miscellaneous', NULL, NULL, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '5.00', '0.000', '1.000', 27, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('Keyboard+mouse', 'Miscellaneous', NULL, NULL, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '5.00', '0.000', '1.000', 28, NULL, 0, 0, 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('USB Wifi', 'Miscellaneous', NULL, NULL, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '10.00', '0.000', '1.000', 29, NULL, 0, 0, 1, 0, 0, 1, '', '', '', '', '', '', '', '', '', ''),
('4G DDR3 1333 RAM', 'Miscellaneous', NULL, NULL, 'Miscellaneous, , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '0.00', '0.000', '1.000', 30, NULL, 0, 0, 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('8948', 'Desktop', NULL, NULL, 'Desktop, HP 8000, C2D, 3.0 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 19\" Monitor', '0.00', '58.00', '0.000', '1.000', 31, NULL, 0, 0, 0, 0, 0, 0, '15/6/18', 'HP 8000', 'C2D', '3.0', '4', '160', '19', 'DVD-RW', '', '38'),
('8949', 'Desktop', NULL, NULL, 'Desktop, HP 6000, C2D, 3.06 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 19\" Monitor', '0.00', '58.00', '0.000', '1.000', 32, NULL, 0, 0, 0, 0, 0, 0, '', 'HP 6000', 'C2D', '3.06', '4', '160', '19', 'DVD-RW', '', '38'),
('Apple iPad 3rd Gen', 'Ebay Sale', NULL, NULL, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '140.00', '0.000', '1.000', 33, NULL, 0, 0, 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('Apple iPad 3rd gen', 'Ebay Sale', NULL, NULL, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '140.00', '0.000', '1.000', 34, NULL, 0, 0, 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('5507 iPad 3rd gen', 'Ebay Sale', NULL, NULL, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '140.00', '0.000', '1.000', 35, NULL, 0, 0, 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('801', 'Desktop', NULL, NULL, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '0.00', '56.00', '0.000', '1.000', 36, NULL, 0, 0, 0, 0, 0, 0, '15/6/18', 'Lenovo', 'C2D', '2.3', '4', '160', '19', '', '', '36'),
('Test', 'Miscellaneous', NULL, NULL, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '10.00', '0.000', '1.000', 37, NULL, 0, 0, 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('User Support (per hour)', 'Support', NULL, NULL, 'Support Hours', '0.00', '25.00', '0.000', '1.000', 38, NULL, 0, 0, 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('Wifi USB', 'Miscellaneous-new', NULL, NULL, 'Miscellaneous-new', '0.00', '10.00', '0.000', '1.000', 39, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('811', 'Laptop', NULL, NULL, 'Laptop, Dell, i3, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 14\" Monitor', '0.00', '100.00', '0.000', '1.000', 40, NULL, 0, 0, 0, 0, 0, 0, '', 'Dell', 'i3', '2.3', '4', '160', '14', '', '', ''),
('8949', 'All-in-One', NULL, NULL, 'All-in-One, HP Touchsmart, AMD-Athlon, 2.8 GHz, 4 GB RAM, 640 GB HDD, DVD-RW, 20\" Monitor', '0.00', '140.00', '0.000', '1.000', 41, NULL, 0, 0, 0, 0, 0, 0, '', 'HP Touchsmart', 'AMD-Athlon', '2.8', '4', '640', '20', 'DVD-RW', '', '140'),
('8952', 'Laptop', NULL, NULL, 'Laptop, Dell Inspiron 6400, C2D, 1.73 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.4\" Monitor', '0.00', '85.00', '0.000', '1.000', 42, NULL, 0, 0, 0, 0, 0, 0, '', 'Dell Inspiron 6400', 'C2D', '1.73', '4', '160', '15.4', 'DVD-RW', '', ''),
('8950', 'Laptop', NULL, NULL, 'Laptop, Dell Inspiron 6400, C2D, 1.73 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.4\" Monitor', '0.00', '90.00', '0.000', '1.000', 43, NULL, 0, 0, 0, 0, 0, 0, '22/6/18', 'Dell Inspiron 6400', 'C2D', '1.73', '4', '160', '15.4', 'DVD-RW', '', ''),
('8951', 'Laptop', NULL, NULL, 'Laptop, Dell Inspiron 6400, C2D, 1.73 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.4\" Monitor', '0.00', '90.00', '0.000', '1.000', 44, NULL, 0, 0, 0, 0, 0, 0, '20/6/18', 'Dell Inspiron 6400', 'C2D', '1.73', '4', '160', '15.4', 'DVD-RW', '', ''),
('8957', 'Laptop', NULL, NULL, 'Laptop, Toshiba Satellite L750, i5, 2.4 GHz, 4 GB RAM, 500 GB HDD, DVD-RW, 15.6\" Monitor', '0.00', '145.00', '0.000', '1.000', 45, NULL, 0, 0, 0, 0, 0, 0, '20/6/18', 'Toshiba Satellite L750', 'i5', '2.4', '4', '500', '15.6', 'DVD-RW', '', ''),
('8955', 'Laptop', NULL, NULL, 'Laptop, HP Elitebook 8440P, i5, 2.4 GHz, 4 GB RAM, 160 SSD GB HDD, DVD-RW, 14\" Monitor', '0.00', '220.00', '0.000', '1.000', 46, NULL, 0, 0, 0, 0, 0, 0, '', 'HP Elitebook 8440P', 'i5', '2.4', '4', '', '14', 'DVD-RW', '', ''),
('8956', 'Laptop', NULL, NULL, 'Laptop, , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '0.00', '240.00', '0.000', '1.000', 47, NULL, 0, 0, 0, 0, 0, 0, '', 'HP Elitebook 8460P', 'i5', '2.4', '4', '', '14', 'DVD-RW', '', ''),
('8954', 'Laptop', NULL, NULL, '', '0.00', '250.00', '0.000', '1.000', 48, NULL, 0, 0, 0, 0, 0, 0, '20/6/18', 'HP Elitebook 8460P', 'i5', '2.5 - 3.2', '4', '160 SSD', '14', 'DVD-RW', '', ''),
('Cable', 'Miscellaneous', NULL, NULL, '', '0.00', '2.00', '0.000', '1.000', 49, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('111', 'Desktop', NULL, NULL, 'Desktop, Dell, i3, 2.5 GHz, 4 GB RAM, 160 GB HDD, , 17\" Monitor', '0.00', '100.00', '0.000', '1.000', 50, NULL, 0, 0, 0, 0, 0, 0, '', 'Dell', 'i3', '2.5', '4', '160', '17', '', '', '80'),
('8934', 'Laptop', NULL, NULL, 'Laptop, Dell 6420, i7, 2.2 GHz, 8 GB RAM, 240 SSD GB HDD, DVD-RW, 14\" Monitor', '0.00', '325.00', '0.000', '1.000', 51, NULL, 0, 0, 0, 0, 0, 0, '31/5/18', 'Dell 6420', 'i7', '2.2', '8', '240 SSD', '14', 'DVD-RW', 'NVS 4200M 512MB', ''),
('8958', 'Desktop', NULL, NULL, 'Desktop, Dell Optiplex 990, i5, 3.1 GHz, 4 GB RAM, 320 GB HDD, DVD-RW, 19\" Monitor', '0.00', '143.00', '0.000', '1.000', 52, NULL, 0, 0, 0, 0, 0, 0, '22/6/18', 'Dell Optiplex 990', 'i5', '3.1', '4', '320', '19', 'DVD-RW', '', '120'),
('200 GB IDE Hard drive', 'Miscellaneous', NULL, NULL, '', '0.00', '15.00', '0.000', '1.000', 53, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('1GB DDR2 5300 RAM', 'Miscellaneous', NULL, NULL, '', '0.00', '7.00', '0.000', '1.000', 54, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('19\" Monitor with spkrs', 'Miscellaneous', NULL, NULL, '', '0.00', '23.00', '0.000', '1.000', 55, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('PSU 460W', 'Miscellaneous', NULL, NULL, '', '0.00', '20.00', '0.000', '1.000', 56, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('Monitor 19\" w spkrs', 'Miscellaneous', NULL, NULL, '', '0.00', '23.00', '0.000', '1.000', 57, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('8961', 'Desktop', NULL, NULL, 'Desktop, HP Pro3000, C2D, 3.00 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 17\" Monitor', '0.00', '48.00', '0.000', '1.000', 58, NULL, 0, 0, 0, 0, 0, 0, '22/6/18', 'HP Pro3000', 'C2D', '3.00', '4', '160', '17', 'DVD-RW', '', '38'),
('Old case', 'Miscellaneous', NULL, NULL, '', '0.00', '10.00', '0.000', '1.000', 59, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('8962', 'Desktop', NULL, NULL, 'Desktop, Dell Optiplex 780, C2D, 2.93 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 19\" Monitor', '0.00', '53.00', '0.000', '1.000', 60, NULL, 0, 0, 0, 0, 0, 0, '22/6/18', 'Dell Optiplex 780', 'C2D', '2.93', '4', '160', '19', 'DVD-RW', '', '33'),
('TaxTest', 'User Support', NULL, NULL, '', '0.00', '10.00', '0.000', '1.000', 61, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('8963', 'Desktop', NULL, NULL, 'Desktop, Dell Optiplex 990, i5, 3.1 GHz, 4 GB RAM, 320 GB HDD, DVD-RW, 19\" Monitor', '0.00', '165.00', '0.000', '1.000', 62, NULL, 0, 0, 0, 0, 0, 0, '22/6/18', 'Dell Optiplex 990', 'i5', '3.1', '4', '320', '19', 'DVD-RW', '', '135'),
('8964', 'Laptop', NULL, NULL, 'Laptop, Dell E6430, i7, 3.6 GHz, 8 GB RAM, 256 SSFD GB HDD, DVD-RW, 14\" Monitor', '0.00', '345.00', '0.000', '1.000', 63, NULL, 0, 0, 0, 0, 0, 0, '', 'Dell E6430', 'i7', '3.6', '8', '', '14', 'DVD-RW', '', ''),
('8965', 'Laptop', NULL, NULL, 'Laptop, Dell inspiron 6400, C2D, 1.73 GHz, 4 GB RAM, 320 GB HDD, DVD-RW, 15.6\" Monitor', '0.00', '90.00', '0.000', '1.000', 64, NULL, 0, 0, 0, 0, 0, 0, '', 'Dell inspiron 6400', 'C2D', '1.73', '4', '320', '15.6', 'DVD-RW', '', ''),
('8966', 'Laptop', NULL, NULL, 'Laptop, Dell Inspiron 6400, C2D, 1.73 GHz, 3 GB RAM, 320 GB HDD, DVD-RW, 15.4\" Monitor', '0.00', '80.00', '0.000', '1.000', 65, NULL, 0, 0, 0, 0, 0, 0, '', 'Dell Inspiron 6400', 'C2D', '1.73', '3', '320', '15.4', 'DVD-RW', '', ''),
('8967', 'Laptop', NULL, NULL, 'Laptop, Dell inspiron 6400, C2D, 1.73 GHz, 3 GB RAM, 320 GB HDD, DVD-RW, 15.4\" Monitor', '0.00', '80.00', '0.000', '1.000', 66, NULL, 0, 0, 0, 0, 0, 0, '', 'Dell inspiron 6400', 'C2D', '1.73', '3', '320', '15.4', 'DVD-RW', '', ''),
('8968', 'Laptop', NULL, NULL, 'Laptop, Dell inspiron 6400, C2D, 1.73 GHz, 4 GB RAM, 320 GB HDD, DVD-RW, 15.34\" Monitor', '0.00', '90.00', '0.000', '1.000', 67, NULL, 0, 0, 0, 0, 0, 0, '', 'Dell inspiron 6400', 'C2D', '1.73', '4', '320', '15.34', 'DVD-RW', '', ''),
('8969', 'Laptop', NULL, NULL, 'Laptop, Dell Inspiron 6400, C2D, 1.73 GHz, 3 GB RAM, 320 GB HDD, DVD-RW, 15.4\" Monitor', '0.00', '80.00', '0.000', '1.000', 68, NULL, 0, 0, 0, 0, 0, 0, '', 'Dell Inspiron 6400', 'C2D', '1.73', '3', '320', '15.4', 'DVD-RW', '', ''),
('8970', 'Laptop', NULL, NULL, 'Laptop, Dell Inspiron 6400, C2D, 1.73 GHz, 3 GB RAM, 320 GB HDD, DVD-RW, 15.4\" Monitor', '0.00', '80.00', '0.000', '1.000', 69, NULL, 0, 0, 0, 0, 0, 0, '', 'Dell Inspiron 6400', 'C2D', '1.73', '3', '320', '15.4', 'DVD-RW', '', ''),
('Cat 5 Cable', 'Miscellaneous', NULL, NULL, '', '0.00', '2.00', '0.000', '1.000', 70, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('Webcam', 'Miscellaneous', NULL, NULL, '', '0.00', '5.00', '0.000', '1.000', 71, NULL, 0, 0, 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('KVM + Keyboard', 'Miscellaneous', NULL, NULL, '', '0.00', '10.00', '0.000', '1.000', 72, NULL, 0, 0, 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('8971', 'Desktop', NULL, NULL, '', '0.00', '43.00', '0.000', '1.000', 73, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('8960', 'Desktop', NULL, NULL, '', '0.00', '55.00', '0.000', '1.000', 74, NULL, 0, 0, 0, 0, 0, 0, '2018-06-22', 'Lenovo Thinkcentre', 'C2D', '2.66', '4', '160', '17', 'DVD-RW', '', '35'),
('8959', 'Desktop', NULL, NULL, '', '0.00', '200.00', '0.000', '1.000', 75, NULL, 0, 0, 0, 0, 0, 0, '2018-06-21', 'Acer verton', 'i5', '3.6', '4', '500', '24', 'DVD-RW', '', '145'),
('8974', 'Desktop', NULL, NULL, '', '0.00', '175.00', '0.000', '1.000', 76, NULL, 0, 0, 0, 0, 0, 0, '2018-07-05', 'HP 8300', 'i5', '3.2', '4', '500', '19', 'DVD-RW', '', '155'),
('8976', 'Tower', NULL, NULL, '', '0.00', '370.00', '0.000', '1.000', 77, NULL, 0, 0, 0, 0, 0, 0, '2018-07-05', 'Dell XPS', 'i7', '3.4', '8', '', '24', 'DVD-RW', 'GT545 1 GB', '305'),
('8980', 'Tower', NULL, NULL, '', '0.00', '275.00', '0.000', '1.000', 78, NULL, 0, 0, 0, 0, 0, 0, '2018-07-05', 'Generic', 'i7', '3', '6', '750', '24', 'DVD-RW Blue-ray', 'GT430 1 GB', '220'),
('8979', 'Laptop', NULL, NULL, '', '0.00', '140.00', '0.000', '1.000', 79, NULL, 0, 0, 0, 0, 0, 0, '2018-07-05', 'Toshiba', 'i3', '2.3', '4', '500', '15.6', 'DVD-RW', '', ''),
('8978', 'Laptop', NULL, NULL, '', '0.00', '145.00', '0.000', '1.000', 80, NULL, 0, 0, 0, 0, 0, 0, '2018-07-05', 'Toshiba', 'i3', '2.2', '4', '320', '15.6', 'DVD-RW', '', ''),
('8975', 'Laptop', NULL, NULL, '', '0.00', '165.00', '0.000', '1.000', 81, NULL, 0, 0, 0, 0, 0, 0, '2018-07-05', 'Asus F501A', 'i3', '2.3', '4', '500', '15.6', 'None', '', ''),
('8977', 'Laptop', NULL, NULL, '', '0.00', '185.00', '0.000', '1.000', 82, NULL, 0, 0, 0, 0, 0, 0, '2018-07-05', 'Sony Vaio', 'i5', '2.5', '4', '500', '13.3', 'DVD reader', '', ''),
('8973', 'Laptop', NULL, NULL, '', '0.00', '245.00', '0.000', '1.000', 83, NULL, 0, 0, 0, 0, 0, 0, '2018-07-05', 'Asus U315', 'i5', '2.4', '8', '500', '13.3', 'None', '', ''),
('2G DDR2 RAM', 'Miscellaneous', NULL, NULL, '', '0.00', '7.00', '0.000', '1.000', 84, NULL, 0, 0, 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('888', 'Laptop', NULL, NULL, 'Laptop, Dell 6420, i3, 2.2 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.6\" Monitor', '0.00', '100.00', '0.000', '1.000', 85, NULL, 0, 0, 0, 0, 0, 0, '2018-07-07', 'Dell 6420', 'i3', '2.2', '4', '160', '15.6', 'DVD-RW', '', ''),
('89dummy', 'Desktop', NULL, NULL, 'Desktop, Dell, i3, 2.2 GHz, 3.9 GB RAM, 160 GB HDD, DVD-RW, 19\" Monitor', '0.00', '100.00', '0.000', '1.000', 86, NULL, 0, 0, 0, 0, 0, 0, '2018-07-08', 'Dell', 'i3', '2.2', '3.9', '160', '19', 'DVD-RW', '', '80'),
('8974', 'Laptop', NULL, NULL, 'Laptop, Dell 6420, i5, 2.2 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15\" Monitor', '0.00', '150.00', '0.000', '1.000', 87, NULL, 0, 0, 0, 0, 0, 0, '2018-08-09', 'Dell 6420', 'i5', '2.2', '4', '160', '15', 'DVD-RW', '', ''),
('9039', 'Desktop', NULL, NULL, 'Desktop, Lenovo Thinkcentre, i5, 3.1 GHz, 4 GB RAM, 250 GB HDD, DVD-RW, 19\" Monitor', '0.00', '140.00', '0.000', '1.000', 88, NULL, 0, 0, 0, 0, 0, 0, '2018-08-16', 'Lenovo Thinkcentre', 'i5', '3.1', '4', '250', '19', 'DVD-RW', '', '200'),
('9037', 'Desktop', NULL, NULL, 'Desktop, , Dell optiplex 7010, 3.4 GHz, 4 GB RAM, 500 GB HDD, DVD-RW, 19\" Monitor', '0.00', '195.00', '0.000', '1.000', 89, NULL, 0, 0, 0, 0, 0, 0, '2018-08-16', '', 'Dell optiplex 7010', '3.4', '4', '500', '19', 'DVD-RW', 'with speakers', '170'),
('9036', 'Desktop', NULL, NULL, 'Desktop, Dell Optiplex 7010, i7, 3.4 GHz, 4 GB RAM, 500 GB HDD, DVD-RW, 19\" Monitor', '0.00', '200.00', '0.000', '1.000', 90, NULL, 0, 0, 0, 0, 0, 0, '2018-08-16', 'Dell Optiplex 7010', 'i7', '3.4', '4', '500', '19', 'DVD-RW', '1GB', '180'),
('8994', 'Desktop', NULL, NULL, 'Desktop, Lenovo Thinkcentre, i5, 2.6 GHz, 4 GB RAM, 500 GB HDD, DVD-RW, 20\" Monitor', '0.00', '220.00', '0.000', '1.000', 91, NULL, 0, 0, 0, 0, 0, 0, '2018-08-16', 'Lenovo Thinkcentre', 'i5', '2.6', '4', '500', '20', 'DVD-RW', '', '200'),
('9038', 'Desktop', NULL, NULL, 'Desktop, Dell Optiplex 7010, i7, 3.4 GHz, 4 GB RAM, 1000 GB HDD, DVD-RW, 19\" Monitor', '0.00', '225.00', '0.000', '1.000', 92, NULL, 0, 0, 0, 0, 0, 0, '2018-08-16', 'Dell Optiplex 7010', 'i7', '3.4', '4', '1000', '19', 'DVD-RW', '1 GB', '205'),
('9018', 'Laptop', NULL, NULL, 'Laptop, Dell E4310, i5, 2.4 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 13.3\" Monitor', '0.00', '150.00', '0.000', '1.000', 93, NULL, 0, 0, 0, 0, 0, 0, '2018-08-16', 'Dell E4310', 'i5', '2.4', '4', '160', '13.3', 'DVD-RW', '', ''),
('9034', 'Laptop', NULL, NULL, 'Laptop, Sony Vaio, i5, 2.5 GHz, 4 GB RAM, 500 GB HDD, DVD-RW, 13.3\" Monitor', '0.00', '165.00', '0.000', '1.000', 94, NULL, 0, 0, 0, 0, 0, 0, '2018-08-16', 'Sony Vaio', 'i5', '2.5', '4', '500', '13.3', 'DVD-RW', '', ''),
('9031', 'Laptop', NULL, NULL, 'Laptop, Toshiba Dyna book, i5, 1.8 GHz, 4 GB RAM,  GB HDD, , 13.3\" Monitor', '0.00', '180.00', '0.000', '1.000', 95, NULL, 0, 0, 0, 0, 0, 0, '2018-08-16', 'Toshiba Dyna book', 'i5', '1.8', '4', '', '13.3', '', '', ''),
('9040', 'Laptop', NULL, NULL, 'Laptop, HP Elitebook 8440P, I5, 2.4 GHz, 4 GB RAM,  GB HDD, DVD-RW, 14\" Monitor', '0.00', '210.00', '0.000', '1.000', 96, NULL, 0, 0, 0, 0, 0, 0, '2018-08-16', 'HP Elitebook 8440P', 'I5', '2.4', '4', '', '14', 'DVD-RW', '', ''),
('9033', 'Laptop', NULL, NULL, 'Laptop, Asus 5750G, i5, 2.4 GHz, 4 GB RAM, 640 GB HDD, DVD-RW, 15.6\" Monitor', '0.00', '235.00', '0.000', '1.000', 97, NULL, 0, 0, 0, 0, 0, 0, '2018-08-16', 'Asus 5750G', 'i5', '2.4', '4', '640', '15.6', 'DVD-RW', '', ''),
('9035', 'Laptop', NULL, NULL, 'Laptop, Dell XPS 13 L322X, i7, 1.9 GHz, 8 GB RAM,  GB HDD, , 13.3\" Monitor', '0.00', '275.00', '0.000', '1.000', 98, NULL, 0, 0, 0, 0, 0, 0, '2018-08-16', 'Dell XPS 13 L322X', 'i7', '1.9', '8', '', '13.3', '', '', ''),
('400W PSU', 'Used Parts', NULL, NULL, '', '0.00', '5.00', '0.000', '1.000', 99, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('Macbook 7.1', 'Used Parts', NULL, NULL, '', '0.00', '150.00', '0.000', '1.000', 100, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('Macbook 7.1', 'Miscellaneous', NULL, NULL, '', '0.00', '0.00', '0.000', '1.000', 101, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('9042', 'Desktop', NULL, NULL, 'Desktop, Lenovo Thinkcentre, Dual Core, 2.7 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 17\" Monitor', '0.00', '43.00', '0.000', '1.000', 102, NULL, 0, 0, 0, 0, 0, 0, '2018-08-17', 'Lenovo Thinkcentre', 'Dual Core', '2.7', '4', '160', '17', 'DVD-RW', '', '33'),
('9043', 'Desktop', NULL, NULL, 'Desktop, Lenovo Thinkcentre, C2D, 2.66 GHz, 4 GB RAM, 160 GB HDD, DVD reader, 17\" Monitor', '0.00', '40.00', '0.000', '1.000', 103, NULL, 0, 0, 0, 0, 0, 0, '2018-08-17', 'Lenovo Thinkcentre', 'C2D', '2.66', '4', '160', '17', 'DVD reader', '', '30'),
('24v Adapter', 'Used Parts', NULL, NULL, '', '0.00', '5.00', '0.000', '1.000', 104, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('Phone', 'Used Parts', NULL, NULL, '', '0.00', '5.00', '0.000', '1.000', 105, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('Keyboard', 'Used Parts', NULL, NULL, '', '0.00', '10.00', '0.000', '1.000', 106, NULL, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', ''),
('9045', 'Desktop', NULL, NULL, 'Desktop, HP Compaq, C2D, 2.2 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 19\" Monitor', '0.00', '53.00', '0.000', '1.000', 107, NULL, 0, 0, 0, 0, 0, 0, '2018-08-17', 'HP Compaq', 'C2D', '2.2', '4', '160', '19', 'DVD-RW', '', '33'),
('856', 'Laptop', NULL, NULL, 'Laptop, Shonky xxx, i4, 1.3 GHz, 2 GB RAM, 80 GB HDD, DVD-RW, 14\" Screen', '0.00', '100.00', '0.000', '1.000', 108, NULL, 0, 0, 0, 0, 0, 0, '2018-08-24', 'Shonky xxx', 'i4', '1.3', '2', '80', '14', 'DVD-RW', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_items_taxes`
--

CREATE TABLE `cbvpos_items_taxes` (
  `item_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_items_taxes`
--

INSERT INTO `cbvpos_items_taxes` (`item_id`, `name`, `percent`) VALUES
(12, ' GST', '0.000'),
(13, ' GST', '10.000'),
(14, ' GST', '0.000'),
(15, ' GST', '0.000'),
(19, ' GST', '0.000'),
(23, ' GST', '0.000'),
(24, ' GST', '0.000'),
(31, ' GST', '0.000'),
(38, 'GST', '10.000'),
(39, '', '10.000'),
(40, '', '0.000'),
(41, ' GST', '0.000'),
(42, ' GST', '0.000'),
(43, ' GST', '0.000'),
(44, ' GST', '0.000'),
(45, ' GST', '0.000'),
(46, ' GST', '0.000'),
(47, ' GST', '0.000'),
(48, ' GST', '0.000'),
(49, ' GST', '0.000'),
(50, ' GST', '0.000'),
(51, ' GST', '0.000'),
(52, ' GST', '0.000'),
(53, ' GST', '0.000'),
(54, ' GST', '0.000'),
(55, ' GST', '0.000'),
(56, ' GST', '0.000'),
(57, ' GST', '0.000'),
(58, ' GST', '0.000'),
(59, ' GST', '0.000'),
(60, ' GST', '0.000'),
(61, ' GST', '0.000'),
(62, ' GST', '0.000'),
(63, ' GST', '0.000'),
(64, ' GST', '0.000'),
(65, ' GST', '0.000'),
(66, ' GST', '0.000'),
(67, ' GST', '0.000'),
(68, ' GST', '0.000'),
(69, ' GST', '0.000'),
(70, ' GST', '0.000'),
(71, ' GST', '0.000'),
(72, ' GST', '0.000'),
(73, ' GST', '0.000'),
(74, ' GST', '0.000'),
(75, ' GST', '0.000'),
(76, ' GST', '0.000'),
(77, ' GST', '0.000'),
(78, ' GST', '0.000'),
(79, ' GST', '0.000'),
(80, ' GST', '0.000'),
(81, ' GST', '0.000'),
(82, ' GST', '0.000'),
(83, ' GST', '0.000'),
(84, ' GST', '0.000'),
(85, ' GST', '0.000'),
(86, ' GST', '0.000'),
(87, ' GST', '0.000'),
(88, ' GST', '0.000'),
(89, ' GST', '0.000'),
(90, ' GST', '0.000'),
(91, ' GST', '0.000'),
(92, ' GST', '0.000'),
(93, ' GST', '0.000'),
(94, ' GST', '0.000'),
(95, ' GST', '0.000'),
(96, ' GST', '0.000'),
(97, ' GST', '0.000'),
(98, ' GST', '0.000'),
(99, ' GST', '0.000'),
(100, ' GST', '0.000'),
(101, ' GST', '0.000'),
(102, ' GST', '0.000'),
(103, ' GST', '0.000'),
(104, ' GST', '0.000'),
(105, ' GST', '0.000'),
(106, ' GST', '0.000'),
(107, ' GST', '0.000'),
(108, ' GST', '0.000');

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_item_kits`
--

CREATE TABLE `cbvpos_item_kits` (
  `item_kit_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `item_id` int(10) NOT NULL DEFAULT '0',
  `kit_discount_percent` decimal(15,2) NOT NULL DEFAULT '0.00',
  `price_option` tinyint(2) NOT NULL DEFAULT '0',
  `print_option` tinyint(2) NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_item_kit_items`
--

CREATE TABLE `cbvpos_item_kit_items` (
  `item_kit_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` decimal(15,3) NOT NULL,
  `kit_sequence` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_item_quantities`
--

CREATE TABLE `cbvpos_item_quantities` (
  `item_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `quantity` decimal(15,3) NOT NULL DEFAULT '0.000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_item_quantities`
--

INSERT INTO `cbvpos_item_quantities` (`item_id`, `location_id`, `quantity`) VALUES
(1, 1, '0.000'),
(2, 1, '0.000'),
(3, 1, '0.000'),
(4, 1, '0.000'),
(5, 1, '0.000'),
(6, 1, '0.000'),
(7, 1, '0.000'),
(8, 1, '0.000'),
(9, 1, '0.000'),
(10, 1, '0.000'),
(11, 1, '0.000'),
(12, 1, '0.000'),
(13, 1, '0.000'),
(14, 1, '0.000'),
(15, 1, '0.000'),
(16, 1, '0.000'),
(17, 1, '0.000'),
(18, 1, '0.000'),
(19, 1, '0.000'),
(20, 1, '0.000'),
(21, 1, '1.000'),
(22, 1, '0.000'),
(23, 1, '0.000'),
(24, 1, '0.000'),
(25, 1, '1.000'),
(26, 1, '1.000'),
(27, 1, '0.000'),
(28, 1, '1.000'),
(29, 1, '0.000'),
(30, 1, '0.000'),
(31, 1, '0.000'),
(32, 1, '0.000'),
(33, 1, '1.000'),
(34, 1, '1.000'),
(35, 1, '1.000'),
(36, 1, '0.000'),
(37, 1, '1.000'),
(38, 1, '1.000'),
(39, 1, '994.000'),
(40, 1, '1.000'),
(41, 1, '0.000'),
(42, 1, '0.000'),
(43, 1, '0.000'),
(44, 1, '1.000'),
(45, 1, '1.000'),
(46, 1, '0.000'),
(47, 1, '0.000'),
(48, 1, '1.000'),
(49, 1, '0.000'),
(50, 1, '1.000'),
(51, 1, '0.000'),
(52, 1, '0.000'),
(53, 1, '0.000'),
(54, 1, '0.000'),
(55, 1, '0.000'),
(56, 1, '0.000'),
(57, 1, '0.000'),
(58, 1, '1.000'),
(59, 1, '0.000'),
(60, 1, '0.000'),
(61, 1, '1.000'),
(62, 1, '0.000'),
(63, 1, '0.000'),
(64, 1, '0.000'),
(65, 1, '0.000'),
(66, 1, '0.000'),
(67, 1, '0.000'),
(68, 1, '0.000'),
(69, 1, '0.000'),
(70, 1, '0.000'),
(71, 1, '0.000'),
(72, 1, '0.000'),
(73, 1, '0.000'),
(74, 1, '0.000'),
(75, 1, '1.000'),
(76, 1, '1.000'),
(77, 1, '0.000'),
(78, 1, '1.000'),
(79, 1, '0.000'),
(80, 1, '0.000'),
(81, 1, '1.000'),
(82, 1, '1.000'),
(83, 1, '1.000'),
(84, 1, '1.000'),
(85, 1, '1.000'),
(86, 1, '9.000'),
(87, 1, '1.000'),
(88, 1, '1.000'),
(89, 1, '1.000'),
(90, 1, '1.000'),
(91, 1, '1.000'),
(92, 1, '1.000'),
(93, 1, '0.000'),
(94, 1, '0.000'),
(95, 1, '0.000'),
(96, 1, '0.000'),
(97, 1, '0.000'),
(98, 1, '0.000'),
(99, 1, '0.000'),
(100, 1, '1.000'),
(101, 1, '0.000'),
(102, 1, '1.000'),
(103, 1, '1.000'),
(104, 1, '0.000'),
(105, 1, '0.000'),
(106, 1, '1.000'),
(107, 1, '1.000'),
(108, 1, '1.000');

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_migrations`
--

CREATE TABLE `cbvpos_migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_migrations`
--

INSERT INTO `cbvpos_migrations` (`version`) VALUES
(20180225100000);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_modules`
--

CREATE TABLE `cbvpos_modules` (
  `name_lang_key` varchar(255) NOT NULL,
  `desc_lang_key` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `module_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_modules`
--

INSERT INTO `cbvpos_modules` (`name_lang_key`, `desc_lang_key`, `sort`, `module_id`) VALUES
('module_config', 'module_config_desc', 110, 'config'),
('module_customers', 'module_customers_desc', 10, 'customers'),
('module_employees', 'module_employees_desc', 80, 'employees'),
('module_expenses', 'module_expenses_desc', 108, 'expenses'),
('module_expenses_categories', 'module_expenses_categories_desc', 109, 'expenses_categories'),
('module_giftcards', 'module_giftcards_desc', 90, 'giftcards'),
('module_home', 'module_home_desc', 1, 'home'),
('module_items', 'module_items_desc', 20, 'items'),
('module_item_kits', 'module_item_kits_desc', 30, 'item_kits'),
('module_messages', 'module_messages_desc', 98, 'messages'),
('module_office', 'module_office_desc', 999, 'office'),
('module_receivings', 'module_receivings_desc', 60, 'receivings'),
('module_reports', 'module_reports_desc', 50, 'reports'),
('module_sales', 'module_sales_desc', 70, 'sales'),
('module_suppliers', 'module_suppliers_desc', 40, 'suppliers'),
('module_taxes', 'module_taxes_desc', 105, 'taxes');

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_people`
--

CREATE TABLE `cbvpos_people` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(1) DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `person_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_people`
--

INSERT INTO `cbvpos_people` (`first_name`, `last_name`, `gender`, `phone_number`, `email`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `comments`, `person_id`) VALUES
('John', 'Doe', NULL, '555-555-5555', 'changeme@example.com', 'Address 1', '', '', 'Victoria', '', 'Australia', '', 1),
('First Name', 'Last Name', 1, '0431714960', 'justin@justinbush.com.au', 'Address1', 'Address2', 'Melbourne', 'Victoria', '3056', 'Austalia', '', 2),
('Justin', 'Bush', NULL, '0431714960', 'justin.d.k.bush+ospos@gmail.com', '', '', '', 'Victoria', '', 'Australia', '', 3),
('Bill', 'B', NULL, '', '', '', '', '', 'Victoria', '', 'Australia', '', 4),
('Fredelindo', 'Guerrero', 1, '', '', '23 Meadow Drive', '', 'Sunshine', 'Vic', '3020', 'Australia', '', 5),
('Fredelindo', 'Guerrero', NULL, '0414004073', '', '23 Meadowbank Drive', '', 'Sunshine', 'Vic', '3020', 'Australia', '', 6),
('Kirsty', 'Sword  (ASRC)', NULL, '0481322384', 'kirsty.s@asrc.org.au', '214 Nicholson St', '', 'Footscray', 'Vic', '3011', 'Australia', '', 7),
('Graham', 'Ellis', NULL, '', 'funnyuhmn@gmail.com', '66 McCulloch St', '', '', '', '', '', '', 8),
('Marilou', 'Quatermain', NULL, '0456223442', 'treszigmaepage128@gmail.com', '1-17 Glen Eloor Ave', '', 'Blackburn', 'Vic', '3130', 'Australia', '', 9),
('Sarah', 'Hammad', NULL, '0474800803', '', '32/110 Elizabeth St', '', 'Richmond', 'Vic', '3121', 'Australia', '', 10),
('Sarah', 'Hammad', NULL, '0474800803', '', '32/110 Elizabeth St', '', 'Richmond', 'Vic', '3121', 'Australia', '', 11),
('Sarah', 'Hammad', NULL, '0474800803', '', '32/110 Elizabeth St', '', 'Richmond', 'Vic', '3121', 'Australia', '', 12),
('Achol', 'Cinkok', NULL, '0406965283', '', '191/110 Elizabeth St', '', 'Richmond', 'Vic', '3021', 'Australia', '', 13),
('Patrick', 'Cartwright', NULL, '', 'patcartwright1964@gmail.com', '3/41-43 Jackson St', '', 'St. Kilda', 'Vic', '3182', 'Australia', '', 14),
('Paul', 'Dynon', NULL, '0413542976', 'pauldynon@hotmail.com', '17/342 Beaconsfield Pde', '', 'St. Kilda', 'Vic', '3182', 'Australia', '', 15),
('Bariyya14', 'Ebay Name', NULL, '', '', '', '', '', '', '', '', '', 16),
('Ebay Name', 'Bariyya14', NULL, '', '', '', '', '', '', '', '', '', 17),
('Front', 'Desk', NULL, '', '', '', '', '', 'Victoria', '', 'Australia', '', 18),
('Ian', 'McGilliuray', NULL, '0431038389', 'ian_f_mcgilliuray@yahoo.com', '201/28 Woodstock St', '', 'Balaclava', 'Victoria', '3183', 'Australia', '', 19),
('Mark', 'Basmadji', NULL, '0421109697', 'mark-bsj@hotmail.com', '4 Toogtooawah St', '', 'Melton South', 'Victoria', '3338', 'Australia', '', 20),
('Murray ', 'Sanford', NULL, '', 'murraysanford@gmail.com', '2/11 Patterson St', '', 'Bayswater', 'Victoria', '3053', 'Australia', '', 21),
('Stefan', 'Stefan', NULL, '', '', '', '', '', 'Victoria', '', 'Australia', '', 22),
('Ben', 'Customer', NULL, '', '', '', '', '', 'Victoria', '', 'Australia', '', 23),
('Murtaza', 'Ahmadi', NULL, '0410162725', 'murtazaahmad152@gmail.com', '14 Serpells Way', '', 'Cranbourne East', 'Victoria', '3997', 'Australia', '', 24),
('Stefan', 'Customer', NULL, '', '', '', '', '', 'Victoria', '', 'Australia', '', 25),
('Jane', 'McDonald', NULL, '0422217223', 'jmac00319@hotmail.com', '14 Sheringham Drive', '', 'Werribee', 'Victoria', '3030', 'Australia', '', 26),
('Monique', 'Vorchheimer', NULL, '0421843719', '', 'Unit 207, 275 Malvern Road', '', 'South Yarra', 'Victoria', '3141', 'Australia', '', 27),
('Simon', 'Obeid', NULL, '0414935350', 'simonobeid@gmail.com', '13 Henry Cable Crt', '', 'Mill park', 'Victoria', '3082', 'Australia', '', 28),
('Geoffrey', 'Dye', NULL, '0401161454', 'geoffreyz@tpg.com.au', 'Unit 8, 205-211 Highett St', '', 'Richmond', 'Victoria', '3121', 'Australia', '', 29),
('Ian', 'McV', NULL, '', '', '', '', '', 'Victoria', '', 'Australia', '', 30),
('Mark', 'Allen', NULL, '0422229908', 'pommymark8@hotmail.com.au', '5 Nesbit Court', '', 'Cranbourne North', 'Victoria', '3977', 'Australia', '', 31),
('Cromwell', 'Hooper', NULL, '0448365191', 'cromwellhooper@gmail.com', '2 Ascot Street', '', 'Laverton', 'Victoria', '', 'Australia', '', 32),
('Gregory', 'Ellsmore', NULL, '0411383551', 'gregoryellsmore@gmail.com', '79 Rosebery St', '', 'Altona Meadows', 'Victoria', '3028', 'Australia', '', 33),
('Pavan', 'Patel', NULL, '0490818420', 'pavanmona6662@gmail.com', '220 Bethany Rd', '', 'Tarneit', 'Victoria', '3029', 'Australia', '', 34),
('Mathew', 'Parker', NULL, '', '', '', '', '', 'Victoria', '', 'Australia', '', 35),
('Nikunjkumar', 'Patel', NULL, '0468389439', 'krivi2012@gmail.com', '220 Bethany Rd', '', 'Tarneit', 'Victoria', '3029', 'Australia', '', 36),
('Paul', 'Taylor', NULL, '', 'taypaul@gmail.com', '1/18 Gothic Rd', '', 'Aspendale', 'Victoria', '3195', 'Australia', '', 37),
('Jack', 'Nicolaides', NULL, '0400557549', 'jacknicolaides@bigpond.com', '1 Taurima Ct', '', '', 'Victoria', '', 'Australia', '', 38),
('Frontdesk', 'Sale', NULL, '', '', '', '', '', 'Victoria', '', 'Australia', '', 39),
('Luigi', 'Mantuano', NULL, '', '', '', '', '', 'Victoria', '', 'Australia', '', 40),
('Binish', 'Ali', NULL, '0426206793', 'binishaly94@gmail.com', 'Unit 9, 9a Coombs Ave', '', 'Oakleigh South', 'Victoria', '3167', 'Australia', '', 41),
('Annie', 'Watson', NULL, '', '', 'Frontyard Youth Services  19 King st, Melbourne', '', 'Melbourne', 'Victoria', 'AWatson@mcm.org.au', 'Australia', 'For Sanpaw Jubilee', 42),
('Fatni', 'Hashi', NULL, '0470145470', 'hmoham@deakin.edu.au', '2 Clemens grove', '', 'Reservoir', 'Victoria', '3073', 'Australia', '', 43),
('Abdirashid', 'Jama', NULL, '0421321718', 'aratojama@gmail.com', '50 Alfrd St', '', 'North Melbourne', 'Victoria', '3051', 'Australia', '', 44),
('Richard', 'O\'Beirne', NULL, '', 'rjob.obeirne@gmail.com', '', '', '', 'Victoria', '', 'Australia', '', 45);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_permissions`
--

CREATE TABLE `cbvpos_permissions` (
  `permission_id` varchar(255) NOT NULL,
  `module_id` varchar(255) NOT NULL,
  `location_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_permissions`
--

INSERT INTO `cbvpos_permissions` (`permission_id`, `module_id`, `location_id`) VALUES
('config', 'config', NULL),
('customers', 'customers', NULL),
('employees', 'employees', NULL),
('expenses', 'expenses', NULL),
('expenses_categories', 'expenses_categories', NULL),
('giftcards', 'giftcards', NULL),
('home', 'home', NULL),
('items', 'items', NULL),
('items_stock', 'items', 1),
('item_kits', 'item_kits', NULL),
('messages', 'messages', NULL),
('office', 'office', NULL),
('receivings', 'receivings', NULL),
('receivings_stock', 'receivings', 1),
('reports', 'reports', NULL),
('reports_categories', 'reports', NULL),
('reports_customers', 'reports', NULL),
('reports_discounts', 'reports', NULL),
('reports_employees', 'reports', NULL),
('reports_expenses_categories', 'reports', NULL),
('reports_inventory', 'reports', NULL),
('reports_items', 'reports', NULL),
('reports_payments', 'reports', NULL),
('reports_receivings', 'reports', NULL),
('reports_sales', 'reports', NULL),
('reports_suppliers', 'reports', NULL),
('reports_taxes', 'reports', NULL),
('sales', 'sales', NULL),
('sales_delete', 'sales', NULL),
('sales_stock', 'sales', 1),
('suppliers', 'suppliers', NULL),
('taxes', 'taxes', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_receivings`
--

CREATE TABLE `cbvpos_receivings` (
  `receiving_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `supplier_id` int(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL DEFAULT '0',
  `comment` text,
  `receiving_id` int(10) NOT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `reference` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_receivings`
--

INSERT INTO `cbvpos_receivings` (`receiving_time`, `supplier_id`, `employee_id`, `comment`, `receiving_id`, `payment_type`, `reference`) VALUES
('2017-12-30 23:28:38', NULL, 1, '', 1, 'Cash', NULL),
('2017-12-31 09:37:27', NULL, 1, '', 2, 'Cash', NULL),
('2018-08-10 15:18:29', NULL, 1, '', 4, 'Credit Card', NULL),
('2018-08-10 15:27:22', NULL, 1, '', 5, 'Cash', NULL),
('2018-08-10 15:43:29', NULL, 1, '', 6, 'Cash', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_receivings_items`
--

CREATE TABLE `cbvpos_receivings_items` (
  `receiving_id` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) NOT NULL DEFAULT '0',
  `description` varchar(30) DEFAULT NULL,
  `serialnumber` varchar(30) DEFAULT NULL,
  `line` int(3) NOT NULL,
  `quantity_purchased` decimal(15,3) NOT NULL DEFAULT '0.000',
  `item_cost_price` decimal(15,2) NOT NULL,
  `item_unit_price` decimal(15,2) NOT NULL,
  `discount_percent` decimal(15,2) NOT NULL DEFAULT '0.00',
  `item_location` int(11) NOT NULL,
  `receiving_quantity` decimal(15,3) NOT NULL DEFAULT '1.000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_receivings_items`
--

INSERT INTO `cbvpos_receivings_items` (`receiving_id`, `item_id`, `description`, `serialnumber`, `line`, `quantity_purchased`, `item_cost_price`, `item_unit_price`, `discount_percent`, `item_location`, `receiving_quantity`) VALUES
(1, 3, '', '', 1, '1.000', '0.00', '0.00', '0.00', 1, '0.000'),
(2, 1, '', '', 1, '1.000', '0.00', '0.00', '0.00', 1, '1.000'),
(2, 2, '', '', 2, '1.000', '0.00', '0.00', '0.00', 1, '1.000'),
(4, 82, '', '', 1, '1.000', '0.00', '0.00', '0.00', 1, '1.000'),
(5, 20, 'Tower, Generic, i7, 2.8 GHz, 8', '', 1, '1.000', '0.00', '0.00', '0.00', 1, '1.000'),
(6, 40, 'Laptop, Dell, i3, 2.3 GHz, 4 G', NULL, 1, '1.000', '0.00', '100.00', '0.00', 1, '1.000');

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_sales`
--

CREATE TABLE `cbvpos_sales` (
  `sale_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int(10) DEFAULT NULL,
  `employee_id` int(10) NOT NULL DEFAULT '0',
  `comment` text,
  `invoice_number` varchar(32) DEFAULT NULL,
  `quote_number` varchar(32) DEFAULT NULL,
  `sale_id` int(10) NOT NULL,
  `sale_status` tinyint(2) NOT NULL DEFAULT '0',
  `dinner_table_id` int(11) DEFAULT NULL,
  `work_order_number` varchar(32) DEFAULT NULL,
  `sale_type` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_sales`
--

INSERT INTO `cbvpos_sales` (`sale_time`, `customer_id`, `employee_id`, `comment`, `invoice_number`, `quote_number`, `sale_id`, `sale_status`, `dinner_table_id`, `work_order_number`, `sale_type`) VALUES
('2017-12-30 23:15:19', 2, 1, '', NULL, NULL, 1, 0, NULL, NULL, 0),
('2017-12-31 09:39:07', NULL, 1, '', NULL, NULL, 2, 0, NULL, NULL, 0),
('2018-04-25 13:51:20', NULL, 1, '', NULL, NULL, 3, 0, NULL, NULL, 0),
('2018-05-08 12:41:31', NULL, 1, '', NULL, NULL, 4, 2, NULL, NULL, 0),
('2018-05-08 12:46:07', NULL, 1, '', NULL, NULL, 5, 2, NULL, NULL, 0),
('2018-05-08 13:44:07', NULL, 1, '', NULL, NULL, 6, 2, NULL, NULL, 0),
('2018-05-08 13:49:18', NULL, 1, '', NULL, NULL, 7, 2, NULL, NULL, 0),
('2018-05-08 13:51:53', NULL, 1, '', NULL, NULL, 8, 2, NULL, NULL, 0),
('2018-05-08 13:54:17', NULL, 1, '', NULL, NULL, 9, 2, NULL, NULL, 0),
('2018-05-08 14:03:22', NULL, 1, '', NULL, NULL, 10, 2, NULL, NULL, 0),
('2018-05-08 14:03:59', NULL, 1, '', NULL, NULL, 11, 2, NULL, NULL, 0),
('2018-05-08 14:04:53', NULL, 1, '', NULL, NULL, 12, 0, NULL, NULL, 0),
('2018-06-15 12:25:38', 6, 3, '', NULL, NULL, 13, 0, NULL, NULL, 0),
('2018-06-15 12:38:00', 7, 3, '', NULL, NULL, 14, 0, NULL, NULL, 0),
('2018-06-15 12:43:54', 8, 3, '', NULL, NULL, 15, 0, NULL, NULL, 0),
('2018-06-15 13:42:55', NULL, 3, '', NULL, NULL, 16, 2, NULL, NULL, 0),
('2018-06-15 13:49:38', NULL, 3, '', NULL, NULL, 17, 0, NULL, NULL, 0),
('2018-06-15 14:08:03', 9, 3, '', NULL, NULL, 18, 0, NULL, NULL, 0),
('2018-06-15 14:33:34', 13, 3, '', NULL, NULL, 19, 0, NULL, NULL, 0),
('2018-06-15 14:38:18', 10, 3, '', NULL, NULL, 20, 0, NULL, NULL, 0),
('2018-06-15 14:43:11', 14, 3, '', NULL, NULL, 21, 0, NULL, NULL, 0),
('2018-06-15 15:51:09', 15, 3, '', NULL, NULL, 22, 0, NULL, NULL, 0),
('2018-06-15 15:53:15', NULL, 3, '', NULL, NULL, 23, 0, NULL, NULL, 0),
('2018-06-15 16:51:31', 17, 3, '', NULL, NULL, 24, 0, NULL, NULL, 0),
('2018-06-16 16:02:27', NULL, 3, '', NULL, NULL, 25, 2, NULL, NULL, 0),
('2018-06-16 16:17:38', NULL, 3, '', NULL, NULL, 26, 2, NULL, NULL, 0),
('2018-06-16 16:26:11', NULL, 3, '', NULL, NULL, 27, 2, NULL, NULL, 0),
('2018-06-16 16:28:04', NULL, 3, '', NULL, NULL, 28, 2, NULL, NULL, 0),
('2018-06-16 16:28:34', NULL, 3, '', NULL, NULL, 29, 2, NULL, NULL, 0),
('2018-06-16 16:29:52', NULL, 3, '', NULL, NULL, 30, 2, NULL, NULL, 0),
('2018-06-16 16:31:38', NULL, 3, '', NULL, NULL, 31, 2, NULL, NULL, 0),
('2018-06-16 16:32:02', NULL, 3, '', NULL, NULL, 32, 2, NULL, NULL, 0),
('2018-06-16 16:32:45', NULL, 3, '', NULL, NULL, 33, 2, NULL, NULL, 0),
('2018-06-16 16:33:29', NULL, 3, '', NULL, NULL, 34, 2, NULL, NULL, 0),
('2018-06-16 16:38:17', NULL, 3, '', NULL, NULL, 35, 2, NULL, NULL, 0),
('2018-06-16 16:42:40', NULL, 3, '', NULL, NULL, 36, 2, NULL, NULL, 0),
('2018-06-16 16:45:25', NULL, 3, '', NULL, NULL, 37, 2, NULL, NULL, 0),
('2018-06-18 16:46:38', NULL, 3, '', NULL, NULL, 38, 0, NULL, NULL, 0),
('2018-06-19 15:15:18', NULL, 1, '', NULL, NULL, 39, 2, NULL, NULL, 0),
('2018-06-19 15:16:37', NULL, 1, '', NULL, NULL, 40, 2, NULL, NULL, 0),
('2018-06-19 15:19:58', NULL, 1, '', NULL, NULL, 41, 2, NULL, NULL, 0),
('2018-06-19 15:24:25', NULL, 1, '', NULL, NULL, 42, 2, NULL, NULL, 0),
('2018-06-19 15:30:54', NULL, 1, '', NULL, NULL, 43, 2, NULL, NULL, 0),
('2018-06-19 15:32:30', NULL, 1, '', NULL, NULL, 44, 2, NULL, NULL, 0),
('2018-06-22 11:49:47', 19, 3, '', NULL, NULL, 45, 2, NULL, NULL, 0),
('2018-06-22 11:52:22', 19, 3, '', NULL, NULL, 46, 0, NULL, NULL, 0),
('2018-06-22 12:56:56', NULL, 3, '', NULL, NULL, 47, 2, NULL, NULL, 0),
('2018-06-22 14:00:12', 20, 3, 'Final Pay', NULL, NULL, 48, 2, NULL, NULL, 0),
('2018-06-22 14:02:18', 21, 3, '', NULL, NULL, 49, 0, NULL, NULL, 0),
('2018-06-22 14:10:07', 24, 3, 'Box only', NULL, NULL, 50, 0, NULL, NULL, 0),
('2018-06-22 15:10:22', 23, 3, '', NULL, NULL, 51, 0, NULL, NULL, 0),
('2018-06-22 15:45:01', 24, 3, '', NULL, NULL, 52, 0, NULL, NULL, 0),
('2018-06-22 15:51:04', 25, 3, '', NULL, NULL, 53, 0, NULL, NULL, 0),
('2018-06-22 16:48:35', NULL, 3, '', NULL, NULL, 54, 0, NULL, NULL, 0),
('2018-06-23 10:33:28', NULL, 3, '', NULL, NULL, 55, 2, NULL, NULL, 0),
('2018-06-23 13:38:04', NULL, 3, '', NULL, NULL, 56, 2, NULL, NULL, 0),
('2018-06-29 10:20:08', NULL, 3, '', NULL, NULL, 57, 2, NULL, NULL, 0),
('2018-06-29 11:21:56', 26, 3, '', NULL, NULL, 58, 2, NULL, NULL, 0),
('2018-06-29 11:28:06', 26, 3, '', NULL, NULL, 59, 2, NULL, NULL, 0),
('2018-06-29 11:28:49', NULL, 3, '', NULL, NULL, 60, 0, NULL, NULL, 0),
('2018-06-29 12:04:57', 27, 18, '', NULL, NULL, 61, 0, NULL, NULL, 0),
('2018-06-29 13:32:15', 28, 18, '', NULL, NULL, 62, 0, NULL, NULL, 0),
('2018-06-29 13:34:00', 29, 18, '', NULL, NULL, 63, 2, NULL, NULL, 0),
('2018-06-29 13:46:52', 30, 18, '', NULL, NULL, 64, 0, NULL, NULL, 0),
('2018-06-29 16:57:24', 29, 18, '', NULL, NULL, 65, 0, NULL, NULL, 0),
('2018-06-29 16:58:25', NULL, 18, '', NULL, NULL, 66, 0, NULL, NULL, 0),
('2018-07-06 12:44:25', 31, 3, '', NULL, NULL, 67, 0, NULL, NULL, 0),
('2018-07-06 12:55:46', 32, 3, '', NULL, NULL, 68, 0, NULL, NULL, 0),
('2018-07-06 14:04:22', NULL, 3, '', NULL, NULL, 69, 0, NULL, NULL, 0),
('2018-07-06 14:14:46', 33, 3, '', NULL, NULL, 70, 0, NULL, NULL, 0),
('2018-07-06 14:16:26', 34, 3, '', NULL, NULL, 71, 0, NULL, NULL, 0),
('2018-07-06 14:19:05', 35, 3, '', NULL, NULL, 72, 0, NULL, NULL, 0),
('2018-07-06 14:20:59', 36, 3, '', NULL, NULL, 73, 0, NULL, NULL, 0),
('2018-07-08 10:47:15', NULL, 3, '', NULL, NULL, 74, 0, NULL, NULL, 0),
('2018-07-08 10:49:33', NULL, 3, '', NULL, NULL, 75, 0, NULL, NULL, 0),
('2018-07-08 10:52:53', NULL, 3, '', NULL, NULL, 76, 0, NULL, NULL, 0),
('2018-07-09 10:24:34', NULL, 3, '', NULL, NULL, 77, 0, NULL, NULL, 0),
('2018-07-10 16:00:56', NULL, 3, '', NULL, NULL, 78, 2, NULL, NULL, 0),
('2018-08-08 22:00:47', NULL, 1, '', '0', NULL, 79, 0, NULL, NULL, 1),
('2018-08-09 15:58:53', NULL, 3, '', NULL, NULL, 80, 2, NULL, NULL, 0),
('2018-08-09 15:59:11', NULL, 3, '', NULL, NULL, 81, 2, NULL, NULL, 0),
('2018-08-13 10:48:50', NULL, 3, '', NULL, NULL, 82, 0, NULL, NULL, 0),
('2018-08-13 10:49:21', NULL, 3, '', NULL, NULL, 83, 0, NULL, NULL, 0),
('2018-08-13 10:50:09', NULL, 3, '', NULL, NULL, 84, 0, NULL, NULL, 0),
('2018-08-13 10:51:00', NULL, 3, '', NULL, NULL, 85, 0, NULL, NULL, 0),
('2018-08-13 10:51:47', NULL, 3, '', NULL, NULL, 86, 0, NULL, NULL, 0),
('2018-08-14 10:24:15', NULL, 1, '', NULL, NULL, 87, 0, NULL, NULL, 0),
('2018-08-17 11:37:09', 37, 3, '', NULL, NULL, 88, 0, NULL, NULL, 0),
('2018-08-17 12:04:04', 38, 3, 'Invoiced', NULL, NULL, 89, 0, NULL, NULL, 0),
('2018-08-17 13:28:53', 39, 1, '', NULL, NULL, 90, 0, NULL, NULL, 0),
('2018-08-17 13:49:59', 40, 18, '', NULL, NULL, 91, 0, NULL, NULL, 0),
('2018-08-17 14:33:24', 41, 18, '', NULL, NULL, 92, 0, NULL, NULL, 0),
('2018-08-17 14:48:45', 42, 18, '', NULL, NULL, 93, 0, NULL, NULL, 0),
('2018-08-17 16:07:16', 43, 18, '', NULL, NULL, 94, 0, NULL, NULL, 0),
('2018-08-17 16:09:12', 39, 18, '', NULL, NULL, 95, 0, NULL, NULL, 0),
('2018-08-17 16:10:00', NULL, 18, '', NULL, NULL, 96, 0, NULL, NULL, 0),
('2018-08-17 16:51:31', 44, 18, '', NULL, NULL, 97, 0, NULL, NULL, 0),
('2018-08-23 13:28:32', 45, 1, '', NULL, NULL, 98, 2, NULL, NULL, 0),
('2018-08-23 13:31:11', 45, 1, '', NULL, NULL, 99, 2, NULL, NULL, 0),
('2018-08-23 13:32:34', 45, 1, '', NULL, NULL, 100, 2, NULL, NULL, 0),
('2018-08-23 13:34:13', 45, 1, '', NULL, NULL, 101, 2, NULL, NULL, 0),
('2018-08-23 13:35:37', 45, 1, '', NULL, NULL, 102, 2, NULL, NULL, 0),
('2018-08-24 11:03:58', 45, 3, '', '1', NULL, 103, 2, NULL, NULL, 1),
('2018-08-24 11:04:59', NULL, 3, '', '2', NULL, 104, 2, NULL, NULL, 1),
('2018-08-24 11:43:46', 45, 3, '', '3', NULL, 105, 2, NULL, NULL, 1),
('2018-08-24 13:41:06', NULL, 3, '', '4', NULL, 106, 2, NULL, NULL, 1),
('2018-08-24 13:48:09', NULL, 3, '', '5', NULL, 107, 2, NULL, NULL, 1),
('2018-08-24 14:03:39', NULL, 3, '', '6', NULL, 108, 2, NULL, NULL, 1),
('2018-09-01 13:34:07', NULL, 1, '', NULL, NULL, 109, 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_sales_items`
--

CREATE TABLE `cbvpos_sales_items` (
  `sale_id` int(10) NOT NULL DEFAULT '0',
  `item_id` int(10) NOT NULL DEFAULT '0',
  `description` varchar(255) DEFAULT NULL,
  `serialnumber` varchar(30) DEFAULT NULL,
  `line` int(3) NOT NULL DEFAULT '0',
  `quantity_purchased` decimal(15,3) NOT NULL DEFAULT '0.000',
  `item_cost_price` decimal(15,2) NOT NULL,
  `item_unit_price` decimal(15,2) NOT NULL,
  `discount_percent` decimal(15,2) NOT NULL DEFAULT '0.00',
  `item_location` int(11) NOT NULL,
  `print_option` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_sales_items`
--

INSERT INTO `cbvpos_sales_items` (`sale_id`, `item_id`, `description`, `serialnumber`, `line`, `quantity_purchased`, `item_cost_price`, `item_unit_price`, `discount_percent`, `item_location`, `print_option`) VALUES
(1, 1, '', '', 1, '1.000', '0.00', '50.00', '0.00', 1, 0),
(2, 1, '', '', 1, '1.000', '0.00', '50.00', '0.00', 1, 0),
(2, 2, '', '', 2, '1.000', '0.00', '50.00', '0.00', 1, 0),
(3, 3, '', '', 1, '1.000', '0.00', '40.00', '0.00', 1, 0),
(4, 2, '', '', 1, '1.000', '0.00', '50.00', '0.00', 1, 0),
(5, 4, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(6, 4, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(7, 4, 'Laptop, Dell E6400, C2D, 2.4 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.6\" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(8, 4, 'Laptop, Dell E6400, C2D, 2.4 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.6\" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(9, 5, 'Desktop, Generic, i7, 2.8 GHz, 8 GB RAM, 250 GB HDD, DVD-RW, 22\" Monitor', '', 1, '1.000', '0.00', '250.00', '0.00', 1, 0),
(10, 4, 'Laptop, Dell E6400, C2D, 2.4 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.6\" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(11, 4, 'Laptop, Dell E6400, C2D, 2.4 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.6\" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(12, 4, 'Laptop, Dell E6400, C2D, 2.4 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.6\" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(13, 7, 'Laptop, Lenovo T520, i5, 2.4 GHz, 4 GB RAM, 750 GB HDD, DVD-RW, 15.6\" Monitor', '', 1, '1.000', '0.00', '165.00', '0.00', 1, 0),
(13, 26, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 2, '1.000', '0.00', '10.00', '0.00', 1, 0),
(14, 8, 'Lenovo T520, Lenovo T520, i5, 2.6 GHz, 4 GB RAM, 320 GB HDD, DVD-RW, 15.6\" Monitor', '', 1, '1.000', '0.00', '165.00', '100.00', 1, 0),
(15, 20, 'Tower, Generic, i7, 2.8 GHz, 8 GB RAM, 1000 GB HDD, DVD-RW, 22\" Monitor', '', 1, '1.000', '0.00', '230.00', '0.00', 1, 0),
(16, 17, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '180.00', '0.00', 1, 0),
(17, 17, 'Desktop, HP 4300 SFF, i5, 2.9 GHz, 4 GB RAM, 500 GB HDD, DVD-RW, 19\" Monitor', '', 1, '1.000', '0.00', '160.00', '0.00', 1, 0),
(17, 28, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 2, '1.000', '0.00', '5.00', '0.00', 1, 0),
(18, 10, 'Laptop, HP Elitebook 8460P, i5, 3.2 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 14\" Monitor', '', 1, '1.000', '0.00', '210.00', '0.00', 1, 0),
(19, 9, 'Laptop, HP Elitebook 8440P, i5, 2.9 GHz, 4 GB RAM, 320 GB HDD, DVD-RW, 14\" Monitor', '', 1, '1.000', '0.00', '180.00', '0.00', 1, 0),
(20, 11, 'Laptop, 240, i5, 3.2 GHz, 4 GB RAM, 160 SSD GB HDD, DVD-RW, 14\" Monitor', '', 1, '1.000', '0.00', '163.00', '0.00', 1, 0),
(21, 16, 'Desktop, Lenovo, i5, 3.2 GHz, 4 GB RAM, 250 GB HDD, DVD-RW, 19\" Monitor', '', 1, '1.000', '0.00', '163.00', '0.00', 1, 0),
(21, 29, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 2, '1.000', '0.00', '10.00', '0.00', 1, 0),
(22, 6, 'Laptop, Lenovo T520, i5, 2.3 GHz, 4 GB RAM, 320 GB HDD, DVD-RW, 15.6\" Monitor', '', 1, '1.000', '0.00', '155.00', '0.00', 1, 0),
(23, 30, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '15.00', '0.00', 1, 0),
(24, 35, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '140.00', '0.00', 1, 0),
(25, 36, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '', 1, '1.000', '0.00', '56.00', '0.00', 1, 0),
(26, 36, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '', 1, '1.000', '0.00', '56.00', '0.00', 1, 0),
(27, 37, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(28, 37, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(29, 37, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(30, 36, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '', 1, '1.000', '0.00', '56.00', '0.00', 1, 0),
(31, 37, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(32, 37, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(33, 37, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(34, 37, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(35, 37, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(36, 37, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(37, 37, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(38, 40, 'Laptop, Dell, i3, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 14\" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(39, 39, 'Miscellaneous-new', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(40, 36, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '', 1, '1.000', '0.00', '56.00', '0.00', 1, 0),
(40, 39, 'Miscellaneous-new', '', 2, '1.000', '0.00', '10.00', '0.00', 1, 0),
(41, 36, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '', 1, '1.000', '0.00', '56.00', '0.00', 1, 0),
(41, 39, 'Miscellaneous-new', '', 2, '1.000', '0.00', '10.00', '0.00', 1, 0),
(42, 38, 'Support', '', 1, '1.000', '0.00', '25.00', '0.00', 1, 0),
(43, 29, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(44, 39, 'Miscellaneous-new', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(45, 14, 'Desktop, Lenovo, C2D, 3.0 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 19\" Monitor', '', 1, '1.000', '0.00', '58.00', '0.00', 1, 0),
(46, 14, 'Desktop, Lenovo, C2D, 3.0 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 19\" Monitor', '', 1, '1.000', '0.00', '58.00', '0.00', 1, 0),
(46, 49, '', '', 2, '1.000', '0.00', '2.00', '0.00', 1, 0),
(47, 38, 'Support', '', 2, '1.000', '0.00', '25.00', '0.00', 1, 0),
(47, 50, 'Desktop, Dell, i3, 2.5 GHz, 4 GB RAM, 160 GB HDD, , 17\" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(48, 51, 'Laptop, Dell 6420, i7, 2.2 GHz, 8 GB RAM, 240 SSD GB HDD, DVD-RW, 14\" Monitor', '', 1, '1.000', '0.00', '250.00', '0.00', 1, 0),
(49, 43, 'Laptop, Dell Inspiron 6400, C2D, 1.73 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.4\" Monitor', '', 1, '1.000', '0.00', '90.00', '0.00', 1, 0),
(50, 52, 'Desktop, Dell Optiplex 990, i5, 3.1 GHz, 4 GB RAM, 320 GB HDD, DVD-RW, 19\" Monitor', '', 1, '1.000', '0.00', '120.00', '0.00', 1, 0),
(50, 53, '', '', 2, '1.000', '0.00', '15.00', '0.00', 1, 0),
(50, 54, '', '', 3, '2.000', '0.00', '7.00', '0.00', 1, 0),
(51, 56, '', '', 1, '1.000', '0.00', '20.00', '0.00', 1, 0),
(52, 51, 'Laptop, Dell 6420, i7, 2.2 GHz, 8 GB RAM, 240 SSD GB HDD, DVD-RW, 14\" Monitor', '', 1, '1.000', '0.00', '325.00', '0.00', 1, 0),
(53, 57, '', '', 1, '1.000', '0.00', '23.00', '0.00', 1, 0),
(54, 59, '', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(55, 26, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '20.00', '0.00', 1, 0),
(56, 38, 'Support', '', 1, '1.000', '0.00', '25.00', '0.00', 1, 0),
(57, 44, 'Laptop, Dell Inspiron 6400, C2D, 1.73 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.4\" Monitor', '', 1, '1.000', '0.00', '90.00', '0.00', 1, 0),
(58, 19, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 2, '1.000', '0.00', '220.00', '0.00', 1, 0),
(58, 39, 'Miscellaneous-new', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(59, 19, 'Desktop, Lenovo Thinkcentre, i5, 3.2 GHz, 8 GB RAM, 500 GB HDD, DVD-RW, 22\" Monitor', '', 2, '1.000', '0.00', '220.00', '0.00', 1, 0),
(59, 39, 'Miscellaneous-new', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(60, 19, 'Desktop, Lenovo Thinkcentre, i5, 3.2 GHz, 8 GB RAM, 500 GB HDD, DVD-RW, 22\" Monitor', '', 2, '1.000', '0.00', '220.00', '0.00', 1, 0),
(60, 39, 'Miscellaneous-new', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(61, 60, 'Desktop, Dell Optiplex 780, C2D, 2.93 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 19\" Monitor', '', 2, '1.000', '0.00', '53.00', '0.00', 1, 0),
(61, 70, '', '', 1, '1.000', '0.00', '2.00', '0.00', 1, 0),
(62, 24, 'Desktop, HP 6800, i7, 3.4 GHz, 8 GB RAM, 1000 GB HDD, DVD-RW, 23 wide\" Monitor', '', 2, '1.000', '0.00', '310.00', '0.00', 1, 0),
(62, 71, '', '', 1, '1.000', '0.00', '5.00', '0.00', 1, 0),
(63, 62, 'Desktop, Dell Optiplex 990, i5, 3.1 GHz, 4 GB RAM, 320 GB HDD, DVD-RW, 19\" Monitor', '', 1, '1.000', '0.00', '165.00', '0.00', 1, 0),
(64, 72, '', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(65, 62, 'Desktop, Dell Optiplex 990, i5, 3.1 GHz, 4 GB RAM, 320 GB HDD, DVD-RW, 19\" Monitor', '', 1, '1.000', '0.00', '135.00', '0.00', 1, 0),
(66, 73, '', '', 1, '1.000', '0.00', '43.00', '0.00', 1, 0),
(67, 77, '', '', 1, '1.000', '0.00', '370.00', '0.00', 1, 0),
(68, 39, 'Miscellaneous-new', '', 2, '1.000', '0.00', '10.00', '0.00', 1, 0),
(68, 74, '', '', 1, '1.000', '0.00', '55.00', '0.00', 1, 0),
(69, 26, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '5.00', '0.00', 1, 0),
(70, 80, '', '', 1, '1.000', '0.00', '145.00', '0.00', 1, 0),
(71, 82, '', '', 1, '1.000', '0.00', '185.00', '0.00', 1, 0),
(72, 39, 'Miscellaneous-new', '', 2, '1.000', '0.00', '10.00', '0.00', 1, 0),
(72, 84, '', '', 1, '1.000', '0.00', '7.00', '0.00', 1, 0),
(73, 79, '', '', 1, '1.000', '0.00', '140.00', '0.00', 1, 0),
(74, 39, 'Miscellaneous-new', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(75, 13, 'Desktop, Lenovo, C2D, 3.0 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15\" Monitor', '', 1, '1.000', '0.00', '50.00', '0.00', 1, 0),
(75, 39, 'Miscellaneous-new', '', 2, '1.000', '0.00', '10.00', '0.00', 1, 0),
(76, 39, 'Miscellaneous-new', '', 2, '1.000', '0.00', '10.00', '0.00', 1, 0),
(76, 86, 'Desktop, Dell, i3, 2.2 GHz, 3.9 GB RAM, 160 GB HDD, DVD-RW, 19\" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(77, 86, 'Desktop, Dell, i3, 2.2 GHz, 3.9 GB RAM, 160 GB HDD, DVD-RW, 19\" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(78, 39, 'Miscellaneous-new', '', 1, '1.000', '0.00', '10.00', '0.00', 1, 0),
(79, 38, 'Support Hours', '', 1, '2.000', '0.00', '25.00', '0.00', 1, 0),
(80, 78, '', '', 1, '1.000', '0.00', '275.00', '0.00', 1, 0),
(81, 38, 'Support Hours', '', 1, '1.000', '0.00', '25.00', '0.00', 1, 0),
(82, 18, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '200.00', '0.00', 1, 0),
(83, 38, 'Support Hours', '', 1, '1.000', '0.00', '25.00', '0.00', 1, 0),
(84, 38, 'Support Hours', '', 1, '1.000', '0.00', '25.00', '0.00', 1, 0),
(84, 55, '', '', 2, '1.000', '0.00', '23.00', '0.00', 1, 0),
(85, 20, 'Tower, Generic, i7, 2.8 GHz, 8 GB RAM, 1000 GB HDD, DVD-RW, 22\" Monitor', '', 1, '1.000', '0.00', '230.00', '0.00', 1, 0),
(85, 38, 'Support Hours', '', 2, '1.000', '0.00', '25.00', '0.00', 1, 0),
(86, 22, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '255.00', '0.00', 1, 0),
(86, 25, 'Miscellaneous, , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 2, '1.000', '0.00', '10.00', '0.00', 1, 0),
(87, 38, 'Support Hours', '', 1, '1.000', '0.00', '25.00', '0.00', 1, 0),
(88, 97, 'Laptop, Asus 5750G, i5, 2.4 GHz, 4 GB RAM, 640 GB HDD, DVD-RW, 15.6\" Monitor', '', 1, '1.000', '0.00', '235.00', '0.00', 1, 0),
(89, 93, 'Laptop, Dell E4310, i5, 2.4 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 13.3\" Monitor', '', 1, '1.000', '0.00', '150.00', '0.00', 1, 0),
(90, 99, '', '', 1, '1.000', '0.00', '5.00', '0.00', 1, 0),
(91, 101, '', '', 1, '1.000', '0.00', '0.00', '0.00', 1, 0),
(92, 98, 'Laptop, Dell XPS 13 L322X, i7, 1.9 GHz, 8 GB RAM,  GB HDD, , 13.3\" Monitor', '', 1, '1.000', '0.00', '275.00', '0.00', 1, 0),
(93, 96, 'Laptop, HP Elitebook 8440P, I5, 2.4 GHz, 4 GB RAM,  GB HDD, DVD-RW, 14\" Monitor', '', 1, '1.000', '0.00', '210.00', '0.00', 1, 0),
(94, 95, 'Laptop, Toshiba Dyna book, i5, 1.8 GHz, 4 GB RAM,  GB HDD, , 13.3\" Monitor', '', 1, '1.000', '0.00', '180.00', '0.00', 1, 0),
(95, 104, '', '', 1, '1.000', '0.00', '5.00', '0.00', 1, 0),
(95, 105, '', '', 2, '1.000', '0.00', '5.00', '0.00', 1, 0),
(96, 27, ', , ,  GHz,  GB RAM,  GB HDD, , \" Monitor', '', 1, '1.000', '0.00', '15.00', '0.00', 1, 0),
(97, 94, 'Laptop, Sony Vaio, i5, 2.5 GHz, 4 GB RAM, 500 GB HDD, DVD-RW, 13.3\" Monitor', '', 1, '1.000', '0.00', '165.00', '0.00', 1, 0),
(98, 85, 'Laptop, Dell 6420, i3, 2.2 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.6\" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(99, 85, 'Laptop, Dell 6420, i3, 2.2 GHz, 4 GB RAM, 160 GB HDD, DVD-RW, 15.6\" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(100, 36, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '', 1, '1.000', '0.00', '56.00', '0.00', 1, 0),
(101, 36, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '', 1, '1.000', '0.00', '56.00', '0.00', 1, 0),
(102, 40, 'Laptop, Dell, i3, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 14\" Monitor', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(103, 36, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '', 1, '1.000', '0.00', '56.00', '0.00', 1, 0),
(104, 36, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '', 1, '1.000', '0.00', '56.00', '20.00', 1, 0),
(105, 36, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '', 1, '1.000', '0.00', '56.00', '0.00', 1, 0),
(106, 36, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '', 1, '1.000', '0.00', '56.00', '0.00', 1, 0),
(107, 36, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '', 1, '1.000', '0.00', '56.00', '0.00', 1, 0),
(108, 108, 'Laptop, Shonky xxx, i4, 1.3 GHz, 2 GB RAM, 80 GB HDD, DVD-RW, 14\" Screen', '', 1, '1.000', '0.00', '100.00', '0.00', 1, 0),
(109, 36, 'Desktop, Lenovo, C2D, 2.3 GHz, 4 GB RAM, 160 GB HDD, , 19\" Monitor', '', 1, '1.000', '0.00', '56.00', '0.00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_sales_items_taxes`
--

CREATE TABLE `cbvpos_sales_items_taxes` (
  `sale_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `line` int(3) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `tax_type` tinyint(2) NOT NULL DEFAULT '0',
  `rounding_code` tinyint(2) NOT NULL DEFAULT '0',
  `cascade_tax` tinyint(2) NOT NULL DEFAULT '0',
  `cascade_sequence` tinyint(2) NOT NULL DEFAULT '0',
  `item_tax_amount` decimal(15,4) NOT NULL DEFAULT '0.0000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_sales_items_taxes`
--

INSERT INTO `cbvpos_sales_items_taxes` (`sale_id`, `item_id`, `line`, `name`, `percent`, `tax_type`, `rounding_code`, `cascade_tax`, `cascade_sequence`, `item_tax_amount`) VALUES
(39, 39, 1, '', '10.0000', 0, 1, 0, 0, '0.9091'),
(40, 39, 2, '', '10.0000', 0, 1, 0, 0, '0.9091'),
(41, 39, 2, '', '10.0000', 0, 1, 0, 0, '0.9091'),
(42, 38, 1, '', '10.0000', 0, 1, 0, 0, '2.2728'),
(44, 39, 1, '', '10.0000', 0, 1, 0, 0, '0.9091'),
(47, 38, 2, '', '10.0000', 0, 1, 0, 0, '2.2728'),
(56, 38, 1, '', '10.0000', 0, 1, 0, 0, '2.2728'),
(57, 44, 1, 'Old Goods', '0.0000', 1, 1, 0, 0, '0.0000'),
(60, 19, 2, 'Old Goods', '0.0000', 1, 1, 0, 0, '0.0000'),
(60, 39, 1, '', '10.0000', 0, 1, 0, 0, '0.9091'),
(60, 39, 1, 'Old Goods', '0.0000', 1, 1, 0, 0, '0.0000'),
(66, 73, 1, 'Old Goods', '0.0000', 1, 1, 0, 0, '0.0000'),
(74, 39, 1, '', '10.0000', 0, 1, 0, 0, '0.9091'),
(75, 13, 1, ' GST', '10.0000', 0, 1, 0, 0, '4.5455'),
(75, 39, 2, '', '10.0000', 0, 1, 0, 0, '0.9091'),
(76, 39, 2, '', '10.0000', 0, 1, 0, 0, '0.9091'),
(78, 39, 1, '', '10.0000', 0, 1, 0, 0, '0.9091'),
(79, 38, 1, '', '10.0000', 0, 1, 0, 0, '4.5455'),
(81, 38, 1, 'GST', '10.0000', 0, 1, 0, 0, '2.2728'),
(83, 38, 1, 'GST', '10.0000', 0, 1, 0, 0, '2.2728'),
(84, 38, 1, 'GST', '10.0000', 0, 1, 0, 0, '2.2728'),
(85, 38, 2, 'GST', '10.0000', 0, 1, 0, 0, '2.2728'),
(87, 38, 1, 'GST', '10.0000', 0, 1, 0, 0, '2.2728');

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_sales_payments`
--

CREATE TABLE `cbvpos_sales_payments` (
  `sale_id` int(10) NOT NULL,
  `payment_type` varchar(40) NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_sales_payments`
--

INSERT INTO `cbvpos_sales_payments` (`sale_id`, `payment_type`, `payment_amount`) VALUES
(1, 'Cash', '50.00'),
(2, 'Cash', '100.00'),
(3, 'Cash', '40.00'),
(4, 'Cash', '50.00'),
(5, 'Cash', '100.00'),
(6, 'Cash', '100.00'),
(7, 'Cash', '100.00'),
(8, 'Cash', '100.00'),
(9, 'Cash', '250.00'),
(10, 'Cash', '100.00'),
(11, 'Cash', '100.00'),
(12, 'Cash', '100.00'),
(13, 'Credit Card', '175.00'),
(15, 'Cash', '230.00'),
(16, 'Cash', '180.00'),
(17, 'Credit Card', '165.00'),
(18, 'Cash', '210.00'),
(19, 'Credit Card', '180.00'),
(20, 'Credit Card', '163.00'),
(21, 'Cash', '173.00'),
(22, 'Credit Card', '155.00'),
(23, 'Credit Card', '15.00'),
(24, 'Credit Card', '140.00'),
(25, 'Cash', '56.00'),
(26, 'Cash', '56.00'),
(27, 'Cash', '10.00'),
(28, 'Cash', '10.00'),
(29, 'Cash', '10.00'),
(30, 'Cash', '56.00'),
(31, 'Cash', '10.00'),
(32, 'Cash', '10.00'),
(33, 'Cash', '10.00'),
(34, 'Cash', '10.00'),
(35, 'Cash', '10.00'),
(36, 'Cash', '10.00'),
(37, 'Cash', '10.00'),
(38, 'Cash', '100.00'),
(39, 'Cash', '10.00'),
(40, 'Cash', '66.00'),
(41, 'Cash', '66.00'),
(42, 'Cash', '25.00'),
(43, 'Cash', '10.00'),
(44, 'Cash', '10.00'),
(45, 'Credit Card', '58.00'),
(46, 'Credit Card', '60.00'),
(47, 'Cash', '125.00'),
(48, 'Check', '250.00'),
(49, 'Cash', '90.00'),
(50, 'Credit Card', '149.00'),
(51, 'Cash', '20.00'),
(52, 'Check', '250.00'),
(52, 'Credit Card', '75.00'),
(53, 'Credit Card', '23.00'),
(54, 'Credit Card', '10.00'),
(55, 'Cash', '20.00'),
(56, 'Cash', '25.00'),
(57, 'Credit Card', '90.00'),
(58, 'Cash', '230.00'),
(59, 'Cash', '230.00'),
(60, 'Cash', '230.00'),
(61, 'Cash', '55.00'),
(62, 'Cash', '315.00'),
(63, 'Credit Card', '165.00'),
(64, 'Cash', '10.00'),
(65, 'Credit Card', '135.00'),
(66, 'Credit Card', '43.00'),
(67, 'Credit Card', '370.00'),
(68, 'Credit Card', '65.00'),
(69, 'Credit Card', '5.00'),
(70, 'Credit Card', '145.00'),
(71, 'Credit Card', '185.00'),
(72, 'Cash', '17.00'),
(73, 'Cash', '140.00'),
(74, 'Cash', '10.00'),
(75, 'Cash', '60.00'),
(76, 'Cash', '110.00'),
(77, 'Cash', '100.00'),
(78, 'Cash', '10.00'),
(79, 'Cash', '50.00'),
(80, 'Cash', '275.00'),
(81, 'Cash', '25.00'),
(82, 'Cash', '200.00'),
(83, 'Cash', '25.00'),
(84, 'Cash', '48.00'),
(85, 'Cash', '255.00'),
(86, 'Cash', '265.00'),
(87, 'Cash', '25.00'),
(88, 'Cash', '235.00'),
(89, 'Check', '150.00'),
(90, 'Cash', '5.00'),
(91, 'Cash', '150.00'),
(92, 'Credit Card', '275.00'),
(93, 'Credit Card', '210.00'),
(94, 'Credit Card', '180.00'),
(95, 'Cash', '10.00'),
(96, 'Cash', '15.00'),
(97, 'Credit Card', '165.00'),
(98, 'Cash', '100.00'),
(99, 'Cash', '100.00'),
(100, 'Cash', '56.00'),
(101, 'Cash', '56.00'),
(102, 'Cash', '100.00'),
(103, 'Due', '56.00'),
(104, 'Due', '44.80'),
(105, 'Due', '56.00'),
(106, 'Due', '56.00'),
(107, 'Due', '56.00'),
(108, 'Due', '100.00'),
(109, 'Cash', '56.00');

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_sales_reward_points`
--

CREATE TABLE `cbvpos_sales_reward_points` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `earned` float NOT NULL,
  `used` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_sales_taxes`
--

CREATE TABLE `cbvpos_sales_taxes` (
  `sale_id` int(10) NOT NULL,
  `tax_type` smallint(2) NOT NULL,
  `tax_group` varchar(32) NOT NULL,
  `sale_tax_basis` decimal(15,4) NOT NULL,
  `sale_tax_amount` decimal(15,4) NOT NULL,
  `print_sequence` tinyint(2) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `tax_rate` decimal(15,4) NOT NULL,
  `sales_tax_code` varchar(32) NOT NULL DEFAULT '',
  `rounding_code` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_sales_taxes`
--

INSERT INTO `cbvpos_sales_taxes` (`sale_id`, `tax_type`, `tax_group`, `sale_tax_basis`, `sale_tax_amount`, `print_sequence`, `name`, `tax_rate`, `sales_tax_code`, `rounding_code`) VALUES
(39, 0, '10% ', '10.0000', '0.9100', 0, '', '10.0000', '', 1),
(40, 0, '10% ', '10.0000', '0.9100', 0, '', '10.0000', '', 1),
(41, 0, '10% ', '10.0000', '0.9100', 0, '', '10.0000', '', 1),
(42, 0, '10% ', '25.0000', '2.2700', 0, '', '10.0000', '', 1),
(44, 0, '10% ', '10.0000', '0.9100', 0, '', '10.0000', '', 1),
(47, 0, '10% ', '25.0000', '2.2700', 0, '', '10.0000', '', 1),
(56, 0, '10% ', '25.0000', '2.2700', 0, '', '10.0000', '', 1),
(60, 0, '10% ', '10.0000', '0.9100', 0, '', '10.0000', '', 1),
(74, 0, '10% ', '10.0000', '0.9100', 0, '', '10.0000', '', 1),
(75, 0, '10% ', '10.0000', '0.9100', 0, '', '10.0000', '', 1),
(75, 0, '10%  GST', '50.0000', '4.5500', 0, ' GST', '10.0000', '', 1),
(76, 0, '10% ', '10.0000', '0.9100', 0, '', '10.0000', '', 1),
(78, 0, '10% ', '10.0000', '0.9100', 0, '', '10.0000', '', 1),
(79, 0, '10% ', '50.0000', '4.5500', 0, '', '10.0000', '', 1),
(81, 0, '10% GST', '25.0000', '2.2700', 0, 'GST', '10.0000', '', 1),
(83, 0, '10% GST', '25.0000', '2.2700', 0, 'GST', '10.0000', '', 1),
(84, 0, '10% GST', '25.0000', '2.2700', 0, 'GST', '10.0000', '', 1),
(85, 0, '10% GST', '25.0000', '2.2700', 0, 'GST', '10.0000', '', 1),
(87, 0, '10% GST', '25.0000', '2.2700', 0, 'GST', '10.0000', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_sessions`
--

CREATE TABLE `cbvpos_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_sessions`
--

INSERT INTO `cbvpos_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('24cdc06b01af4fbbe6bc1427c36cf130cf9fc5ab', '172.21.0.1', 1536884935, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363838343933353b706572736f6e5f69647c733a313a2231223b6d656e755f67726f75707c733a343a22686f6d65223b),
('760d90591bcdda15b38c2d18fbf8b817b7f8d35e', '172.21.0.1', 1536886785, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363838363738353b706572736f6e5f69647c733a313a2231223b6d656e755f67726f75707c733a343a22686f6d65223b6974656d5f6c6f636174696f6e7c733a313a2231223b),
('beb18bab4072d816e6e1f5f6bc711d1b31ef4ede', '172.21.0.1', 1536887198, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363838373139383b706572736f6e5f69647c733a313a2231223b6d656e755f67726f75707c733a343a22686f6d65223b6974656d5f6c6f636174696f6e7c733a313a2231223b),
('14d8bdf865eb867f390163cabfa0dc2adf0dd52b', '172.21.0.1', 1536890827, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363839303832373b706572736f6e5f69647c733a313a2231223b6d656e755f67726f75707c733a343a22686f6d65223b6974656d5f6c6f636174696f6e7c733a313a2231223b),
('05533565f3fe87b4240569a84127ed30cfb94737', '172.21.0.1', 1536891534, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363839313533343b706572736f6e5f69647c733a313a2231223b6d656e755f67726f75707c733a363a226f6666696365223b6974656d5f6c6f636174696f6e7c733a313a2231223b),
('19d47ae6a21dd527aabf83aec4fc767a509ae012', '172.21.0.1', 1536891552, 0x5f5f63695f6c6173745f726567656e65726174657c693a313533363839313533343b706572736f6e5f69647c733a313a2231223b6d656e755f67726f75707c733a363a226f6666696365223b6974656d5f6c6f636174696f6e7c733a313a2231223b);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_stock_locations`
--

CREATE TABLE `cbvpos_stock_locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_stock_locations`
--

INSERT INTO `cbvpos_stock_locations` (`location_id`, `location_name`, `deleted`) VALUES
(1, 'Warehouse', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_suppliers`
--

CREATE TABLE `cbvpos_suppliers` (
  `person_id` int(10) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `agency_name` varchar(255) NOT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_tax_categories`
--

CREATE TABLE `cbvpos_tax_categories` (
  `tax_category_id` int(10) NOT NULL,
  `tax_category` varchar(32) NOT NULL,
  `tax_group_sequence` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_tax_categories`
--

INSERT INTO `cbvpos_tax_categories` (`tax_category_id`, `tax_category`, `tax_group_sequence`) VALUES
(1, 'Old Goods', 0),
(2, 'Services', 10),
(3, 'New Goods', 10);

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_tax_codes`
--

CREATE TABLE `cbvpos_tax_codes` (
  `tax_code` varchar(32) NOT NULL,
  `tax_code_name` varchar(255) NOT NULL DEFAULT '',
  `tax_code_type` tinyint(2) NOT NULL DEFAULT '0',
  `city` varchar(255) NOT NULL DEFAULT '',
  `state` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_tax_code_rates`
--

CREATE TABLE `cbvpos_tax_code_rates` (
  `rate_tax_code` varchar(32) NOT NULL,
  `rate_tax_category_id` int(10) NOT NULL,
  `tax_rate` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `rounding_code` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cbvpos_tax_code_rates`
--

INSERT INTO `cbvpos_tax_code_rates` (`rate_tax_code`, `rate_tax_category_id`, `tax_rate`, `rounding_code`) VALUES
('GST', 1, '0.0000', 1),
('GST', 2, '10.0000', 1),
('GST', 3, '10.0000', 1),
('VAT', 1, '10.0000', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cbvpos_app_config`
--
ALTER TABLE `cbvpos_app_config`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cbvpos_customers`
--
ALTER TABLE `cbvpos_customers`
  ADD UNIQUE KEY `account_number` (`account_number`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `cbvpos_customers_packages`
--
ALTER TABLE `cbvpos_customers_packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `cbvpos_customers_points`
--
ALTER TABLE `cbvpos_customers_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `cbvpos_dinner_tables`
--
ALTER TABLE `cbvpos_dinner_tables`
  ADD PRIMARY KEY (`dinner_table_id`);

--
-- Indexes for table `cbvpos_employees`
--
ALTER TABLE `cbvpos_employees`
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `cbvpos_expenses`
--
ALTER TABLE `cbvpos_expenses`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `expense_category_id` (`expense_category_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `cbvpos_expense_categories`
--
ALTER TABLE `cbvpos_expense_categories`
  ADD PRIMARY KEY (`expense_category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `cbvpos_giftcards`
--
ALTER TABLE `cbvpos_giftcards`
  ADD PRIMARY KEY (`giftcard_id`),
  ADD UNIQUE KEY `giftcard_number` (`giftcard_number`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `cbvpos_grants`
--
ALTER TABLE `cbvpos_grants`
  ADD PRIMARY KEY (`permission_id`,`person_id`),
  ADD KEY `ospos_grants_ibfk_2` (`person_id`);

--
-- Indexes for table `cbvpos_inventory`
--
ALTER TABLE `cbvpos_inventory`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `trans_items` (`trans_items`),
  ADD KEY `trans_user` (`trans_user`),
  ADD KEY `trans_location` (`trans_location`);

--
-- Indexes for table `cbvpos_items`
--
ALTER TABLE `cbvpos_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `item_number` (`item_number`);

--
-- Indexes for table `cbvpos_items_taxes`
--
ALTER TABLE `cbvpos_items_taxes`
  ADD PRIMARY KEY (`item_id`,`name`,`percent`);

--
-- Indexes for table `cbvpos_item_kits`
--
ALTER TABLE `cbvpos_item_kits`
  ADD PRIMARY KEY (`item_kit_id`);

--
-- Indexes for table `cbvpos_item_kit_items`
--
ALTER TABLE `cbvpos_item_kit_items`
  ADD PRIMARY KEY (`item_kit_id`,`item_id`,`quantity`),
  ADD KEY `ospos_item_kit_items_ibfk_2` (`item_id`);

--
-- Indexes for table `cbvpos_item_quantities`
--
ALTER TABLE `cbvpos_item_quantities`
  ADD PRIMARY KEY (`item_id`,`location_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `cbvpos_modules`
--
ALTER TABLE `cbvpos_modules`
  ADD PRIMARY KEY (`module_id`),
  ADD UNIQUE KEY `desc_lang_key` (`desc_lang_key`),
  ADD UNIQUE KEY `name_lang_key` (`name_lang_key`);

--
-- Indexes for table `cbvpos_people`
--
ALTER TABLE `cbvpos_people`
  ADD PRIMARY KEY (`person_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `cbvpos_permissions`
--
ALTER TABLE `cbvpos_permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `ospos_permissions_ibfk_2` (`location_id`);

--
-- Indexes for table `cbvpos_receivings`
--
ALTER TABLE `cbvpos_receivings`
  ADD PRIMARY KEY (`receiving_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `reference` (`reference`);

--
-- Indexes for table `cbvpos_receivings_items`
--
ALTER TABLE `cbvpos_receivings_items`
  ADD PRIMARY KEY (`receiving_id`,`item_id`,`line`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `cbvpos_sales`
--
ALTER TABLE `cbvpos_sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `sale_time` (`sale_time`),
  ADD KEY `dinner_table_id` (`dinner_table_id`);

--
-- Indexes for table `cbvpos_sales_items`
--
ALTER TABLE `cbvpos_sales_items`
  ADD PRIMARY KEY (`sale_id`,`item_id`,`line`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `item_location` (`item_location`);

--
-- Indexes for table `cbvpos_sales_items_taxes`
--
ALTER TABLE `cbvpos_sales_items_taxes`
  ADD PRIMARY KEY (`sale_id`,`item_id`,`line`,`name`,`percent`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `cbvpos_sales_payments`
--
ALTER TABLE `cbvpos_sales_payments`
  ADD PRIMARY KEY (`sale_id`,`payment_type`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `cbvpos_sales_reward_points`
--
ALTER TABLE `cbvpos_sales_reward_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`);

--
-- Indexes for table `cbvpos_sales_taxes`
--
ALTER TABLE `cbvpos_sales_taxes`
  ADD PRIMARY KEY (`sale_id`,`tax_type`,`tax_group`),
  ADD KEY `print_sequence` (`sale_id`,`print_sequence`,`tax_type`,`tax_group`);

--
-- Indexes for table `cbvpos_sessions`
--
ALTER TABLE `cbvpos_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `cbvpos_stock_locations`
--
ALTER TABLE `cbvpos_stock_locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `cbvpos_suppliers`
--
ALTER TABLE `cbvpos_suppliers`
  ADD UNIQUE KEY `account_number` (`account_number`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `cbvpos_tax_categories`
--
ALTER TABLE `cbvpos_tax_categories`
  ADD PRIMARY KEY (`tax_category_id`);

--
-- Indexes for table `cbvpos_tax_codes`
--
ALTER TABLE `cbvpos_tax_codes`
  ADD PRIMARY KEY (`tax_code`);

--
-- Indexes for table `cbvpos_tax_code_rates`
--
ALTER TABLE `cbvpos_tax_code_rates`
  ADD PRIMARY KEY (`rate_tax_code`,`rate_tax_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cbvpos_customers_packages`
--
ALTER TABLE `cbvpos_customers_packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cbvpos_customers_points`
--
ALTER TABLE `cbvpos_customers_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbvpos_dinner_tables`
--
ALTER TABLE `cbvpos_dinner_tables`
  MODIFY `dinner_table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cbvpos_expenses`
--
ALTER TABLE `cbvpos_expenses`
  MODIFY `expense_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cbvpos_expense_categories`
--
ALTER TABLE `cbvpos_expense_categories`
  MODIFY `expense_category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cbvpos_giftcards`
--
ALTER TABLE `cbvpos_giftcards`
  MODIFY `giftcard_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbvpos_inventory`
--
ALTER TABLE `cbvpos_inventory`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `cbvpos_items`
--
ALTER TABLE `cbvpos_items`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `cbvpos_item_kits`
--
ALTER TABLE `cbvpos_item_kits`
  MODIFY `item_kit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbvpos_people`
--
ALTER TABLE `cbvpos_people`
  MODIFY `person_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `cbvpos_receivings`
--
ALTER TABLE `cbvpos_receivings`
  MODIFY `receiving_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cbvpos_sales`
--
ALTER TABLE `cbvpos_sales`
  MODIFY `sale_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `cbvpos_sales_reward_points`
--
ALTER TABLE `cbvpos_sales_reward_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbvpos_stock_locations`
--
ALTER TABLE `cbvpos_stock_locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cbvpos_tax_categories`
--
ALTER TABLE `cbvpos_tax_categories`
  MODIFY `tax_category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cbvpos_customers`
--
ALTER TABLE `cbvpos_customers`
  ADD CONSTRAINT `cbvpos_customers_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `cbvpos_people` (`person_id`),
  ADD CONSTRAINT `cbvpos_customers_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `cbvpos_customers_packages` (`package_id`);

--
-- Constraints for table `cbvpos_customers_points`
--
ALTER TABLE `cbvpos_customers_points`
  ADD CONSTRAINT `cbvpos_customers_points_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `cbvpos_customers` (`person_id`),
  ADD CONSTRAINT `cbvpos_customers_points_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `cbvpos_customers_packages` (`package_id`),
  ADD CONSTRAINT `cbvpos_customers_points_ibfk_3` FOREIGN KEY (`sale_id`) REFERENCES `cbvpos_sales` (`sale_id`);

--
-- Constraints for table `cbvpos_employees`
--
ALTER TABLE `cbvpos_employees`
  ADD CONSTRAINT `cbvpos_employees_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `cbvpos_people` (`person_id`);

--
-- Constraints for table `cbvpos_expenses`
--
ALTER TABLE `cbvpos_expenses`
  ADD CONSTRAINT `cbvpos_expenses_ibfk_1` FOREIGN KEY (`expense_category_id`) REFERENCES `cbvpos_expense_categories` (`expense_category_id`),
  ADD CONSTRAINT `cbvpos_expenses_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `cbvpos_employees` (`person_id`);

--
-- Constraints for table `cbvpos_giftcards`
--
ALTER TABLE `cbvpos_giftcards`
  ADD CONSTRAINT `cbvpos_giftcards_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `cbvpos_people` (`person_id`);

--
-- Constraints for table `cbvpos_grants`
--
ALTER TABLE `cbvpos_grants`
  ADD CONSTRAINT `cbvpos_grants_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `cbvpos_permissions` (`permission_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cbvpos_grants_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `cbvpos_employees` (`person_id`) ON DELETE CASCADE;

--
-- Constraints for table `cbvpos_inventory`
--
ALTER TABLE `cbvpos_inventory`
  ADD CONSTRAINT `cbvpos_inventory_ibfk_1` FOREIGN KEY (`trans_items`) REFERENCES `cbvpos_items` (`item_id`),
  ADD CONSTRAINT `cbvpos_inventory_ibfk_2` FOREIGN KEY (`trans_user`) REFERENCES `cbvpos_employees` (`person_id`),
  ADD CONSTRAINT `cbvpos_inventory_ibfk_3` FOREIGN KEY (`trans_location`) REFERENCES `cbvpos_stock_locations` (`location_id`);

--
-- Constraints for table `cbvpos_items`
--
ALTER TABLE `cbvpos_items`
  ADD CONSTRAINT `cbvpos_items_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `cbvpos_suppliers` (`person_id`);

--
-- Constraints for table `cbvpos_items_taxes`
--
ALTER TABLE `cbvpos_items_taxes`
  ADD CONSTRAINT `cbvpos_items_taxes_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `cbvpos_items` (`item_id`) ON DELETE CASCADE;

--
-- Constraints for table `cbvpos_item_kit_items`
--
ALTER TABLE `cbvpos_item_kit_items`
  ADD CONSTRAINT `cbvpos_item_kit_items_ibfk_1` FOREIGN KEY (`item_kit_id`) REFERENCES `cbvpos_item_kits` (`item_kit_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cbvpos_item_kit_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `cbvpos_items` (`item_id`) ON DELETE CASCADE;

--
-- Constraints for table `cbvpos_item_quantities`
--
ALTER TABLE `cbvpos_item_quantities`
  ADD CONSTRAINT `cbvpos_item_quantities_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `cbvpos_items` (`item_id`),
  ADD CONSTRAINT `cbvpos_item_quantities_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `cbvpos_stock_locations` (`location_id`);

--
-- Constraints for table `cbvpos_permissions`
--
ALTER TABLE `cbvpos_permissions`
  ADD CONSTRAINT `cbvpos_permissions_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `cbvpos_modules` (`module_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cbvpos_permissions_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `cbvpos_stock_locations` (`location_id`) ON DELETE CASCADE;

--
-- Constraints for table `cbvpos_receivings`
--
ALTER TABLE `cbvpos_receivings`
  ADD CONSTRAINT `cbvpos_receivings_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `cbvpos_employees` (`person_id`),
  ADD CONSTRAINT `cbvpos_receivings_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `cbvpos_suppliers` (`person_id`);

--
-- Constraints for table `cbvpos_receivings_items`
--
ALTER TABLE `cbvpos_receivings_items`
  ADD CONSTRAINT `cbvpos_receivings_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `cbvpos_items` (`item_id`),
  ADD CONSTRAINT `cbvpos_receivings_items_ibfk_2` FOREIGN KEY (`receiving_id`) REFERENCES `cbvpos_receivings` (`receiving_id`);

--
-- Constraints for table `cbvpos_sales`
--
ALTER TABLE `cbvpos_sales`
  ADD CONSTRAINT `cbvpos_sales_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `cbvpos_employees` (`person_id`),
  ADD CONSTRAINT `cbvpos_sales_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `cbvpos_customers` (`person_id`),
  ADD CONSTRAINT `cbvpos_sales_ibfk_3` FOREIGN KEY (`dinner_table_id`) REFERENCES `cbvpos_dinner_tables` (`dinner_table_id`);

--
-- Constraints for table `cbvpos_sales_items`
--
ALTER TABLE `cbvpos_sales_items`
  ADD CONSTRAINT `cbvpos_sales_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `cbvpos_items` (`item_id`),
  ADD CONSTRAINT `cbvpos_sales_items_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `cbvpos_sales` (`sale_id`),
  ADD CONSTRAINT `cbvpos_sales_items_ibfk_3` FOREIGN KEY (`item_location`) REFERENCES `cbvpos_stock_locations` (`location_id`);

--
-- Constraints for table `cbvpos_sales_items_taxes`
--
ALTER TABLE `cbvpos_sales_items_taxes`
  ADD CONSTRAINT `cbvpos_sales_items_taxes_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `cbvpos_sales_items` (`sale_id`),
  ADD CONSTRAINT `cbvpos_sales_items_taxes_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `cbvpos_items` (`item_id`);

--
-- Constraints for table `cbvpos_sales_payments`
--
ALTER TABLE `cbvpos_sales_payments`
  ADD CONSTRAINT `cbvpos_sales_payments_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `cbvpos_sales` (`sale_id`);

--
-- Constraints for table `cbvpos_sales_reward_points`
--
ALTER TABLE `cbvpos_sales_reward_points`
  ADD CONSTRAINT `cbvpos_sales_reward_points_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `cbvpos_sales` (`sale_id`);

--
-- Constraints for table `cbvpos_suppliers`
--
ALTER TABLE `cbvpos_suppliers`
  ADD CONSTRAINT `cbvpos_suppliers_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `cbvpos_people` (`person_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
