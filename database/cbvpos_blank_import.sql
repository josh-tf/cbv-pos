-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: cbvposdev-db
-- Generation Time: Oct 18, 2018 at 07:02 AM
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
-- Database: `cbvpos_blank`
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
('cbvopt_distpass', 'cbvuser'),
('cbvopt_distuser', 'user'),
('cbvopt_distver', 'Ubuntu 16.04'),
('cbvopt_item_cat', 'Desktop,Laptop,Used Equipment,New Equipment,User Support,Ebay Sales,Recycling Fees,CBV Membership'),
('cbvopt_item_cpu', 'C2D,i3,i5,i7'),
('cbvopt_item_optical', 'DVD-RW,Blueray'),
('cbvopt_item_os', 'Ubuntu 16.04, Ubuntu 18.04'),
('cbvopt_item_ram', '2,4,6,8,10,12'),
('cbvopt_item_screen', '12,14,15.4,17,19,20,22'),
('cbvopt_item_storage', '160,200,250,360,500,1000'),
('cbvopt_item_type', 'Tower,All-in-One,Small Form'),
('client_id', '8024ef54-5c31-4aa0-99ab-8d37e5f5561d'),
('company', 'Computerbank Victoria Inc.'),
('company_logo', ''),
('country_codes', 'au'),
('currency_decimals', '2'),
('currency_symbol', '$'),
('custom10_name', 'Desktop Type'),
('custom11_name', 'Battery Life'),
('custom12_name', 'Box Only Price'),
('custom13_name', 'Extras'),
('custom14_name', 'Other Notes'),
('custom15_name', ''),
('custom16_name', ''),
('custom17_name', ''),
('custom18_name', ''),
('custom19_name', ''),
('custom1_name', 'Build Date'),
('custom20_name', ''),
('custom2_name', 'Brand / Model'),
('custom3_name', 'CPU Type'),
('custom4_name', 'CPU Speed'),
('custom5_name', 'RAM'),
('custom6_name', 'Storage'),
('custom7_name', 'Operating System'),
('custom8_name', 'Screen Size'),
('custom9_name', 'Optical Drive'),
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
('number_locale', 'en-AU'),
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
('protocol', 'smtp'),
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
('smtp_host', ''),
('smtp_pass', 'c674c8c5be8783c02d7aac3fd6b91bea3772370334608c437b0d363c0c476c207c7036ce0b30db9eaa529d3b94a785655f182074e13c77410bfe2d31f3add05a+/Q67NyQgEmUpGH7PzX1SnXTT7ct4rOxLTcuXydHFKA='),
('smtp_port', ''),
('smtp_timeout', ''),
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
-- Table structure for table `cbvpos_cash_up`
--

CREATE TABLE `cbvpos_cash_up` (
  `cashup_id` int(10) NOT NULL,
  `open_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `close_date` timestamp NULL DEFAULT NULL,
  `open_amount_cash` decimal(15,2) NOT NULL,
  `transfer_amount_cash` decimal(15,2) NOT NULL,
  `note` int(1) NOT NULL,
  `closed_amount_cash` decimal(15,2) NOT NULL,
  `closed_amount_card` decimal(15,2) NOT NULL,
  `closed_amount_check` decimal(15,2) NOT NULL,
  `closed_amount_total` decimal(15,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `open_employee_id` int(10) NOT NULL,
  `close_employee_id` int(10) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_customers`
--

CREATE TABLE `cbvpos_customers` (
  `person_id` int(10) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `conc_id` varchar(255) DEFAULT NULL,
  `taxable` int(1) NOT NULL DEFAULT '1',
  `sales_tax_code` varchar(32) NOT NULL DEFAULT '1',
  `discount_percent` decimal(15,2) NOT NULL DEFAULT '0.00',
  `package_id` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
('admin', '$2y$10$vJBSMlD02EC7ENSrKfVQXuvq9tNRHMtcOA8MSK2NYS748HHWm.gcG', 1, 0, 2, '', '');

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
('cashups', 1, 'home'),
('config', 1, 'office'),
('customers', 1, 'home'),
('employees', 1, 'office'),
('expenses', 1, 'home'),
('expenses_categories', 1, 'office'),
('home', 1, 'office'),
('items', 1, 'home'),
('items_stock', 1, '--'),
('item_kits', 1, 'office'),
('messages', 1, 'office'),
('office', 1, 'home'),
('reports', 1, 'home'),
('reports_categories', 1, '--'),
('reports_customers', 1, '--'),
('reports_discounts', 1, '--'),
('reports_employees', 1, '--'),
('reports_expenses_categories', 1, '--'),
('reports_inventory', 1, '--'),
('reports_items', 1, '--'),
('reports_payments', 1, '--'),
('reports_receivings', 1, '--'),
('reports_sales', 1, '--'),
('reports_suppliers', 1, '--'),
('reports_taxes', 1, '--'),
('sales', 1, 'home'),
('sales_delete', 1, '--'),
('sales_stock', 1, '--'),
('taxes', 1, 'office');

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
  `custom10` varchar(255) DEFAULT NULL,
  `custom11` varchar(255) DEFAULT NULL,
  `custom12` varchar(255) DEFAULT NULL,
  `custom13` varchar(255) DEFAULT NULL,
  `custom14` varchar(255) DEFAULT NULL,
  `custom15` varchar(255) DEFAULT NULL,
  `custom16` varchar(255) DEFAULT NULL,
  `custom17` varchar(255) DEFAULT NULL,
  `custom18` varchar(255) DEFAULT NULL,
  `custom19` varchar(255) DEFAULT NULL,
  `custom20` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_items_taxes`
--

CREATE TABLE `cbvpos_items_taxes` (
  `item_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `percent` decimal(15,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
('module_cashups', 'module_cashups_desc', 50, 'cashups'),
('module_config', 'module_config_desc', 900, 'config'),
('module_customers', 'module_customers_desc', 30, 'customers'),
('module_employees', 'module_employees_desc', 70, 'employees'),
('module_expenses', 'module_expenses_desc', 40, 'expenses'),
('module_expenses_categories', 'module_expenses_categories_desc', 90, 'expenses_categories'),
('module_giftcards', 'module_giftcards_desc', 100, 'giftcards'),
('module_home', 'module_home_desc', 1, 'home'),
('module_items', 'module_items_desc', 20, 'items'),
('module_item_kits', 'module_item_kits_desc', 110, 'item_kits'),
('module_messages', 'module_messages_desc', 60, 'messages'),
('module_office', 'module_office_desc', 999, 'office'),
('module_receivings', 'module_receivings_desc', 120, 'receivings'),
('module_reports', 'module_reports_desc', 40, 'reports'),
('module_sales', 'module_sales_desc', 10, 'sales'),
('module_suppliers', 'module_suppliers_desc', 130, 'suppliers'),
('module_taxes', 'module_taxes_desc', 80, 'taxes');

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
('Front', 'Desk', NULL, '(03) 9600 9161', 'info@computerbank.org.au', '483 Victoria Street', '', 'West Melbourne', 'Victoria', '3003', 'Australia', '', 1);

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
('cashups', 'cashups', NULL),
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

-- --------------------------------------------------------

--
-- Table structure for table `cbvpos_sales_payments`
--

CREATE TABLE `cbvpos_sales_payments` (
  `sale_id` int(10) NOT NULL,
  `payment_type` varchar(40) NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `conc_id` varchar(255) DEFAULT NULL,
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
('GST', 1, '10.0000', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cbvpos_app_config`
--
ALTER TABLE `cbvpos_app_config`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cbvpos_cash_up`
--
ALTER TABLE `cbvpos_cash_up`
  ADD PRIMARY KEY (`cashup_id`),
  ADD KEY `open_employee_id` (`open_employee_id`),
  ADD KEY `close_employee_id` (`close_employee_id`);

--
-- Indexes for table `cbvpos_customers`
--
ALTER TABLE `cbvpos_customers`
  ADD UNIQUE KEY `conc_id` (`conc_id`),
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
  ADD PRIMARY KEY (`id`),
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
  ADD UNIQUE KEY `conc_id` (`conc_id`),
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
-- AUTO_INCREMENT for table `cbvpos_cash_up`
--
ALTER TABLE `cbvpos_cash_up`
  MODIFY `cashup_id` int(10) NOT NULL AUTO_INCREMENT;

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
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbvpos_items`
--
ALTER TABLE `cbvpos_items`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbvpos_item_kits`
--
ALTER TABLE `cbvpos_item_kits`
  MODIFY `item_kit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbvpos_people`
--
ALTER TABLE `cbvpos_people`
  MODIFY `person_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cbvpos_receivings`
--
ALTER TABLE `cbvpos_receivings`
  MODIFY `receiving_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cbvpos_sales`
--
ALTER TABLE `cbvpos_sales`
  MODIFY `sale_id` int(10) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `cbvpos_cash_up`
--
ALTER TABLE `cbvpos_cash_up`
  ADD CONSTRAINT `cbvpos_cash_up_ibfk_1` FOREIGN KEY (`open_employee_id`) REFERENCES `cbvpos_employees` (`person_id`),
  ADD CONSTRAINT `cbvpos_cash_up_ibfk_2` FOREIGN KEY (`close_employee_id`) REFERENCES `cbvpos_employees` (`person_id`);

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
