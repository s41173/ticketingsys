-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2018 at 08:08 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glsaasadmin`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addaccountsp` (IN `p_member` VARCHAR(3))  INSERT into accounts (member_id, classification_id, currency, code, name, alias, status, defaults, bank_stts)
SELECT p_member, classification_id, currency, code, name, alias, status, defaults, bank_stts
from sample_accounts$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `addbalancesp` (IN `p_month` VARCHAR(2), IN `p_year` VARCHAR(4))  INSERT into balances (currency, account_id, month, year)
SELECT currency, id, p_month, p_year  from accounts$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(9) NOT NULL,
  `member_id` smallint(3) NOT NULL,
  `classification_id` int(3) DEFAULT NULL,
  `currency` varchar(15) NOT NULL,
  `code` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `alias` text NOT NULL,
  `acc_no` varchar(100) DEFAULT NULL,
  `bank` text,
  `city` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `zip` int(10) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `balance_phone` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `defaults` int(1) NOT NULL DEFAULT '0',
  `bank_stts` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `icon` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `parent_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `menu_order` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `class_style` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `id_style` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `target` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '_parent',
  `parent_status` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `icon`, `parent_id`, `name`, `modul`, `url`, `menu_order`, `class_style`, `id_style`, `target`, `parent_status`, `created`, `updated`, `deleted`) VALUES
(41, NULL, 0, 'Home', 'main', 'main/', 0, 'fa fa-home', '', '_parent', 1, NULL, '2016-11-24 15:42:01', NULL),
(42, NULL, 0, 'Dashboard', 'main', 'main/', 1, 'fa fa-home', '', '_parent', 1, NULL, '2016-11-24 15:42:45', NULL),
(187, NULL, 0, 'General Ledger', 'main', 'main/', 5, 'fa fa-money', '', '_parent', 1, '2017-06-23 09:42:43', '2017-06-23 13:54:39', NULL),
(191, NULL, 187, 'Financial Report', 'report_reference', 'report_reference/', 0, '', '', '_parent', 0, '2017-06-23 10:31:50', NULL, NULL),
(192, NULL, 187, 'COA', 'account', 'account/', 4, '', '', '_parent', 0, '2017-06-23 10:37:52', NULL, NULL),
(193, NULL, 187, 'GL - Journal Transaction', 'journalgl', 'journalgl/', 5, '', '', '_parent', 0, '2017-06-23 10:38:41', NULL, NULL),
(194, NULL, 187, 'Account Ledger', 'ledger', 'ledger/', 6, '', '', '_parent', 0, '2017-06-23 10:39:35', NULL, NULL),
(195, NULL, 0, 'Transaction', 'main', 'main/', 3, 'fa fa-file', '', '_parent', 1, '2017-06-28 08:26:00', NULL, NULL),
(196, NULL, 195, 'Cash In', 'cashin', 'cashin/', 0, '', '', '_parent', 0, '2017-06-28 08:27:19', NULL, NULL),
(197, NULL, 195, 'Cash Out', 'cashout', 'cashout/', 1, '', '', '_parent', 0, '2017-06-28 08:27:45', NULL, NULL),
(198, NULL, 195, 'Fund Transfer', 'transfer', 'transfer/', 2, '', '', '_parent', 0, '2017-06-28 08:28:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `id` int(8) NOT NULL,
  `currency` varchar(15) NOT NULL DEFAULT 'IDR',
  `account_id` int(9) NOT NULL,
  `beginning` decimal(15,2) NOT NULL,
  `end` decimal(15,2) NOT NULL,
  `vamount` decimal(15,2) NOT NULL,
  `budget` decimal(15,2) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `id` int(2) NOT NULL,
  `question` varchar(30) NOT NULL,
  `answer` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`id`, `question`, `answer`) VALUES
(1, '1 + 1 = ', '2'),
(2, '2 x 3 = ', '6'),
(3, '5 + 4 =', '9'),
(4, '6 x 3 =', '18'),
(5, '4 x 6 =', '24'),
(6, '1 + 7 =', '8'),
(7, '4 + 3 = ', '7'),
(8, '6 + 6 =', '12');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(100) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('885f9f9ba22aab178159a8d9c51cc6be', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (K', 1464691531, 'a:3:{s:4:\"lang\";s:2:\"ID\";s:12:\"refered_from\";s:37:\"http://localhost/dswip/index.php/home\";s:4:\"menu\";s:1:\"1\";}'),
('d58b0e60b442a5f41ec802344d2174c1', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWeb', 1470982648, 'a:3:{s:4:\"lang\";s:2:\"ID\";s:12:\"refered_from\";s:37:\"http://localhost/dswip/index.php/home\";s:4:\"menu\";s:1:\"1\";}');

-- --------------------------------------------------------

--
-- Table structure for table `classifications`
--

CREATE TABLE `classifications` (
  `id` int(3) NOT NULL,
  `no` int(3) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(30) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classifications`
--

INSERT INTO `classifications` (`id`, `no`, `name`, `type`, `status`, `created`, `updated`, `deleted`) VALUES
(7, 110, 'Kas', 'harta', 1, NULL, NULL, NULL),
(8, 120, 'Bank', 'harta', 1, NULL, NULL, NULL),
(10, 210, 'Hutang Usaha', 'kewajiban', 1, NULL, NULL, NULL),
(13, 150, 'Biaya Dibayar Dimuka', 'harta', 1, NULL, NULL, NULL),
(14, 140, 'Persediaan', 'harta', 1, NULL, NULL, NULL),
(15, 510, 'Biaya Usaha', 'biaya', 1, NULL, NULL, NULL),
(16, 410, 'Pendapatan Usaha', 'pendapatan', 1, NULL, NULL, NULL),
(17, 520, 'Biaya Usaha Lain', 'biaya', 1, NULL, NULL, NULL),
(18, 320, 'Laba', 'modal', 1, NULL, NULL, NULL),
(19, 610, 'Biaya Administratsi / Umum', 'biaya', 1, NULL, NULL, NULL),
(20, 130, 'Piutang Usaha', 'harta', 1, NULL, NULL, NULL),
(21, 810, 'Pendapatan Luar Usaha', 'pendapatan', 1, NULL, NULL, NULL),
(22, 310, 'Modal', 'modal', 1, NULL, NULL, NULL),
(24, 660, 'Biaya Non Operasional', 'biaya', 1, NULL, NULL, NULL),
(25, 910, 'Pengeluaran Luar Usaha', 'biaya', 1, NULL, NULL, NULL),
(26, 170, 'Harta Tetap Berwujud', 'harta', 1, NULL, NULL, NULL),
(27, 135, 'Piutang Non Usaha', 'harta', 1, NULL, NULL, NULL),
(29, 160, 'Investasi Jangka Panjang', 'harta', 1, NULL, NULL, NULL),
(30, 180, 'Harta Tetap Tidak Berwujud', 'harta', 1, NULL, NULL, NULL),
(31, 190, 'Harta Lainnya', 'harta', 1, NULL, NULL, NULL),
(32, 240, 'Hutang Non Usaha', 'kewajiban', 1, NULL, NULL, NULL),
(34, 220, 'Pendapatan Terima Dimuka', 'kewajiban', 1, NULL, NULL, NULL),
(35, 230, 'Hutang Jangka Panjang', 'kewajiban', 1, NULL, NULL, NULL),
(36, 250, 'Hutang Lainnya', 'kewajiban', 1, NULL, '2017-06-23 11:50:38', NULL),
(37, 420, 'Pendapatan Usaha Lainnya', 'pendapatan', 1, NULL, '2017-08-10 14:52:06', NULL),
(41, 999, 'NENEKS', 'pendapatan', 0, '2017-06-23 12:05:31', '2017-06-23 16:14:00', '2017-06-23 16:14:02');

-- --------------------------------------------------------

--
-- Table structure for table `closing`
--

CREATE TABLE `closing` (
  `id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `dates` date NOT NULL,
  `times` varchar(30) NOT NULL,
  `user` int(3) NOT NULL,
  `type` enum('month','year') NOT NULL,
  `status` smallint(1) NOT NULL,
  `log` int(9) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(15) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `created`, `updated`, `deleted`) VALUES
(1, 'idr', 'IDR', NULL, '2017-06-30 10:37:14', NULL),
(2, 'us dollar', 'USD', NULL, '2017-06-30 10:37:20', NULL),
(3, 'ruppee', 'Rp', '2017-06-30 10:33:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gls`
--

CREATE TABLE `gls` (
  `id` int(9) NOT NULL,
  `member_id` smallint(3) NOT NULL,
  `no` varchar(15) NOT NULL,
  `dates` date NOT NULL,
  `code` varchar(10) NOT NULL,
  `currency` varchar(15) NOT NULL,
  `docno` varchar(100) NOT NULL,
  `notes` varchar(250) NOT NULL,
  `balance` decimal(18,2) NOT NULL,
  `desc` text,
  `log` int(5) NOT NULL,
  `cf` int(1) NOT NULL DEFAULT '0',
  `approved` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `installation`
--

CREATE TABLE `installation` (
  `database_type` varchar(100) NOT NULL,
  `database_name` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL DEFAULT 'root',
  `pass` varchar(100) NOT NULL,
  `host` varchar(100) NOT NULL DEFAULT 'localhost',
  `status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journaltypes`
--

CREATE TABLE `journaltypes` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journaltypes`
--

INSERT INTO `journaltypes` (`id`, `code`, `name`, `desc`) VALUES
(1, 'GJ', 'General Journals', 'General Journal'),
(4, 'PJ', 'Purchase Journals', 'Purchase Journals'),
(5, 'SJ', 'Sales Journal', 'Sales Journal'),
(6, 'CD', 'Write Check', 'Write Check'),
(7, 'CR', 'Cash Deposit', 'Cash Deposit'),
(8, 'IJ', 'Inventory', 'Inventory'),
(9, 'SD', 'Sales Discount', 'Sales Discount'),
(10, 'PD', 'Purchase Discount', 'Purchase Discount'),
(11, 'SF', 'Lates Charges (sales)', 'Lates Charges (sales)'),
(12, 'PF', 'Late Charges (purchases)', 'Late Charges (purchases)'),
(13, 'PR', 'Purchase Return', 'Purchase Return'),
(14, 'SR', 'Sales Return', 'Sales Return'),
(15, 'TR', 'Fund Transfer ', 'desc'),
(16, 'AJE', 'Adjustment', 'Adjustment'),
(17, 'AP', 'Assembly Journal', 'Assembly Journal'),
(18, 'TJ', 'Tuition Journal', 'Tuition Journal'),
(19, 'DJ', 'Daily Journal', 'Daily Journal'),
(20, 'DJC', 'Daily Journal Cash', 'Daily Journal Cash');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(10) NOT NULL,
  `userid` int(3) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(30) CHARACTER SET latin1 NOT NULL,
  `component_id` int(5) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `userid`, `date`, `time`, `component_id`, `activity`, `description`, `created`, `updated`, `deleted`) VALUES
(4, 1, '2018-09-19', '09:00:37', 153, 'update', '', NULL, NULL, NULL),
(3, 1, '2018-09-19', '09:00:37', 153, 'update', '', NULL, NULL, NULL),
(5, 1, '2018-09-19', '09:43:22', 153, 'update', '', NULL, NULL, NULL),
(6, 1, '2018-09-19', '09:43:25', 153, 'update', '', NULL, NULL, NULL),
(7, 1, '2018-09-19', '09:44:01', 153, 'update', '', NULL, NULL, NULL),
(8, 1, '2018-09-19', '09:45:24', 153, 'update', '', NULL, NULL, NULL),
(9, 1, '2018-09-19', '09:45:44', 153, 'update', '', NULL, NULL, NULL),
(10, 1, '2018-09-19', '11:13:19', 153, 'update', '', NULL, NULL, NULL),
(11, 1, '2018-09-19', '11:13:19', 153, 'update', '', NULL, NULL, NULL),
(12, 1, '2018-09-19', '11:13:41', 153, 'update', '', NULL, NULL, NULL),
(13, 1, '2018-09-19', '11:13:41', 153, 'update', '', NULL, NULL, NULL),
(14, 1, '2018-09-19', '11:15:01', 153, 'update', '', NULL, NULL, NULL),
(15, 1, '2018-09-19', '11:15:01', 153, 'update', '', NULL, NULL, NULL),
(16, 1, '2018-09-19', '12:24:30', 153, 'update', '', NULL, NULL, NULL),
(17, 1, '2018-09-19', '12:24:32', 153, 'update', '', NULL, NULL, NULL),
(18, 1, '2018-09-19', '12:37:07', 153, 'update', '', NULL, NULL, NULL),
(19, 1, '2018-09-19', '12:38:45', 153, 'update', '', NULL, NULL, NULL),
(20, 1, '2018-09-19', '13:20:45', 153, 'update', '', NULL, NULL, NULL),
(21, 1, '2018-09-19', '13:21:43', 153, 'update', '', NULL, NULL, NULL),
(22, 1, '2018-09-19', '14:43:13', 153, 'update', '', NULL, NULL, NULL),
(23, 1, '2018-09-19', '14:43:42', 153, 'update', '', NULL, NULL, NULL),
(24, 1, '2018-09-19', '14:43:42', 153, 'update', '', NULL, NULL, NULL),
(25, 1, '2018-09-19', '14:43:50', 153, 'update', '', NULL, NULL, NULL),
(26, 1, '2018-09-19', '14:44:18', 153, 'update', '', NULL, NULL, NULL),
(27, 1, '2018-09-19', '14:44:18', 153, 'update', '', NULL, NULL, NULL),
(28, 1, '2018-09-19', '14:44:27', 153, 'update', '', NULL, NULL, NULL),
(29, 1, '2018-09-19', '14:46:20', 153, 'update', '', NULL, NULL, NULL),
(30, 1, '2018-09-19', '14:52:57', 162, 'update', '', NULL, NULL, NULL),
(31, 1, '2018-09-19', '14:53:29', 162, 'update', '', NULL, NULL, NULL),
(32, 1, '2018-09-19', '14:55:16', 165, 'create', '', NULL, NULL, NULL),
(33, 1, '2018-09-19', '14:55:48', 165, 'create', '', NULL, NULL, NULL),
(34, 1, '2018-09-19', '15:02:07', 162, 'update', '', NULL, NULL, NULL),
(35, 1, '2018-09-19', '15:02:33', 162, 'update', '', NULL, NULL, NULL),
(36, 1, '2018-09-19', '15:02:46', 162, 'update', '', NULL, NULL, NULL),
(37, 1, '2018-09-19', '15:03:31', 165, 'create', '', NULL, NULL, NULL),
(38, 1, '2018-09-19', '15:03:55', 165, 'create', '', NULL, NULL, NULL),
(39, 1, '2018-09-19', '15:25:11', 153, 'update', '', NULL, NULL, NULL),
(40, 1, '2018-09-19', '15:25:11', 153, 'update', '', NULL, NULL, NULL),
(41, 1, '2018-09-19', '15:25:15', 153, 'update', '', NULL, NULL, NULL),
(42, 1, '2018-09-19', '15:25:48', 153, 'update', '', NULL, NULL, NULL),
(43, 1, '2018-09-19', '15:26:27', 153, 'update', '', NULL, NULL, NULL),
(44, 1, '2018-09-19', '15:26:27', 153, 'update', '', NULL, NULL, NULL),
(45, 1, '2018-09-19', '16:32:18', 162, 'update', '', NULL, NULL, NULL),
(46, 1, '2018-09-19', '16:32:46', 162, 'update', '', NULL, NULL, NULL),
(47, 1, '2018-09-19', '16:33:38', 200, 'update', '', NULL, NULL, NULL),
(48, 1, '2018-09-19', '16:33:51', 200, 'update', '', NULL, NULL, NULL),
(49, 1, '2018-09-19', '16:40:24', 153, 'update', '', NULL, NULL, NULL),
(50, 1, '2018-09-19', '16:40:37', 153, 'update', '', NULL, NULL, NULL),
(51, 1, '2018-09-19', '16:40:37', 153, 'update', '', NULL, NULL, NULL),
(52, 1, '2018-09-19', '16:42:38', 153, 'update', '', NULL, NULL, NULL),
(53, 1, '2018-09-19', '16:43:03', 153, 'update', '', NULL, NULL, NULL),
(54, 1, '2018-09-19', '16:43:13', 153, 'update', '', NULL, NULL, NULL),
(55, 1, '2018-09-19', '16:43:13', 153, 'update', '', NULL, NULL, NULL),
(56, 1, '2018-09-19', '16:52:21', 153, 'update', '', NULL, NULL, NULL),
(57, 1, '2018-09-19', '16:55:04', 153, 'update', '', NULL, NULL, NULL),
(58, 1, '2018-09-19', '16:55:10', 153, 'update', '', NULL, NULL, NULL),
(59, 1, '2018-09-19', '16:55:35', 153, 'update', '', NULL, NULL, NULL),
(60, 1, '2018-09-19', '16:56:28', 153, 'update', '', NULL, NULL, NULL),
(61, 1, '2018-09-19', '16:56:33', 153, 'update', '', NULL, NULL, NULL),
(62, 1, '2018-09-19', '16:56:40', 153, 'update', '', NULL, NULL, NULL),
(63, 1, '2018-09-19', '16:59:53', 153, 'update', '', NULL, NULL, NULL),
(64, 1, '2018-09-19', '17:49:26', 153, 'update', '', NULL, NULL, NULL),
(65, 1, '2018-09-19', '17:49:29', 153, 'update', '', NULL, NULL, NULL),
(66, 1, '2018-09-19', '17:50:02', 153, 'update', '', NULL, NULL, NULL),
(67, 1, '2018-09-19', '21:05:59', 132, 'forced_delete', '', NULL, NULL, NULL),
(68, 1, '2018-09-19', '21:06:22', 132, 'forced_delete', '', NULL, NULL, NULL),
(69, 1, '2018-09-19', '21:06:30', 132, 'forced_delete', '', NULL, NULL, NULL),
(70, 1, '2018-09-19', '21:06:45', 132, 'forced_delete', '', NULL, NULL, NULL),
(71, 1, '2018-09-20', '08:36:33', 0, 'login', '', NULL, NULL, NULL),
(72, 1, '2018-09-20', '08:37:57', 132, 'create', '', NULL, NULL, NULL),
(73, 1, '2018-09-20', '08:38:17', 132, 'create', '', NULL, NULL, NULL),
(74, 1, '2018-09-20', '08:38:59', 132, 'create', '', NULL, NULL, NULL),
(75, 1, '2018-09-20', '08:40:40', 201, 'update', '', NULL, NULL, NULL),
(76, 1, '2018-09-20', '08:41:13', 201, 'update', '', NULL, NULL, NULL),
(77, 1, '2018-09-20', '08:43:14', 201, 'update', '', NULL, NULL, NULL),
(78, 1, '2018-09-20', '08:44:50', 201, 'update', '', NULL, NULL, NULL),
(79, 1, '2018-09-20', '08:45:08', 201, 'update', '', NULL, NULL, NULL),
(80, 1, '2018-09-20', '08:46:45', 201, 'update', '', NULL, NULL, NULL),
(81, 1, '2018-09-20', '08:46:48', 201, 'update', '', NULL, NULL, NULL),
(82, 1, '2018-09-20', '08:48:13', 40, 'delete', '', NULL, NULL, NULL),
(83, 1, '2018-09-20', '08:48:19', 40, 'delete', '', NULL, NULL, NULL),
(84, 1, '2018-09-20', '08:48:22', 40, 'delete', '', NULL, NULL, NULL),
(85, 1, '2018-09-20', '09:00:49', 40, 'update', '', NULL, NULL, NULL),
(86, 1, '2018-09-20', '09:01:14', 40, 'update', '', NULL, NULL, NULL),
(87, 1, '2018-09-20', '09:01:37', 40, 'update', '', NULL, NULL, NULL),
(88, 1, '2018-09-20', '09:02:12', 40, 'update', '', NULL, NULL, NULL),
(89, 1, '2018-09-20', '09:05:07', 40, 'update', '', NULL, NULL, NULL),
(90, 1, '2018-09-20', '09:06:59', 162, 'update', '', NULL, NULL, NULL),
(91, 1, '2018-09-20', '09:07:58', 162, 'update', '', NULL, NULL, NULL),
(92, 1, '2018-09-20', '09:08:20', 162, 'update', '', NULL, NULL, NULL),
(93, 1, '2018-09-20', '11:00:27', 0, 'login', '', NULL, NULL, NULL),
(94, 1, '2018-09-20', '11:11:56', 0, 'logout', '', NULL, NULL, NULL),
(95, 1, '2018-09-20', '11:12:51', 0, 'login', '', NULL, NULL, NULL),
(96, 1, '2018-09-20', '11:13:38', 153, 'create', '', NULL, NULL, NULL),
(97, 1, '2018-09-20', '11:13:41', 153, 'update', '', NULL, NULL, NULL),
(98, 1, '2018-09-20', '11:13:41', 153, 'update', '', NULL, NULL, NULL),
(99, 1, '2018-09-20', '11:13:44', 153, 'update', '', NULL, NULL, NULL),
(100, 1, '2018-09-20', '11:13:44', 153, 'update', '', NULL, NULL, NULL),
(101, 1, '2018-09-20', '11:13:50', 153, 'delete', '', NULL, NULL, NULL),
(102, 1, '2018-09-20', '12:05:09', 162, 'update', '', NULL, NULL, NULL),
(103, 1, '2018-09-20', '12:05:26', 162, 'update', '', NULL, NULL, NULL),
(104, 1, '2018-09-20', '12:06:00', 162, 'update', '', NULL, NULL, NULL),
(105, 1, '2018-09-20', '12:06:14', 162, 'update', '', NULL, NULL, NULL),
(106, 1, '2018-09-20', '12:06:27', 162, 'update', '', NULL, NULL, NULL),
(107, 1, '2018-09-20', '12:06:41', 162, 'update', '', NULL, NULL, NULL),
(108, 1, '2018-09-20', '12:06:51', 162, 'update', '', NULL, NULL, NULL),
(109, 1, '2018-09-20', '12:08:22', 162, 'update', '', NULL, NULL, NULL),
(110, 1, '2018-09-20', '12:08:36', 162, 'update', '', NULL, NULL, NULL),
(111, 1, '2018-09-20', '12:09:09', 162, 'update', '', NULL, NULL, NULL),
(112, 1, '2018-09-20', '12:09:21', 162, 'update', '', NULL, NULL, NULL),
(113, 1, '2018-09-20', '12:12:18', 162, 'update', '', NULL, NULL, NULL),
(114, 1, '2018-09-20', '12:12:37', 162, 'update', '', NULL, NULL, NULL),
(115, 1, '2018-09-20', '12:13:23', 162, 'update', '', NULL, NULL, NULL),
(116, 1, '2018-09-20', '12:13:42', 162, 'update', '', NULL, NULL, NULL),
(117, 1, '2018-09-20', '12:14:01', 162, 'update', '', NULL, NULL, NULL),
(118, 1, '2018-09-20', '12:14:14', 162, 'update', '', NULL, NULL, NULL),
(119, 1, '2018-09-20', '12:14:23', 162, 'update', '', NULL, NULL, NULL),
(120, 1, '2018-09-20', '12:17:25', 162, 'update', '', NULL, NULL, NULL),
(121, 1, '2018-09-20', '12:17:55', 162, 'update', '', NULL, NULL, NULL),
(122, 1, '2018-09-20', '12:18:05', 162, 'update', '', NULL, NULL, NULL),
(123, 1, '2018-09-20', '12:18:12', 162, 'update', '', NULL, NULL, NULL),
(124, 1, '2018-09-20', '12:18:24', 162, 'update', '', NULL, NULL, NULL),
(125, 1, '2018-09-20', '12:18:38', 162, 'update', '', NULL, NULL, NULL),
(126, 1, '2018-09-20', '12:23:49', 162, 'update', '', NULL, NULL, NULL),
(127, 1, '2018-09-20', '12:23:57', 162, 'update', '', NULL, NULL, NULL),
(128, 1, '2018-09-20', '12:24:11', 162, 'update', '', NULL, NULL, NULL),
(129, 1, '2018-09-20', '12:24:26', 162, 'update', '', NULL, NULL, NULL),
(130, 1, '2018-09-20', '12:25:10', 162, 'update', '', NULL, NULL, NULL),
(131, 1, '2018-09-20', '12:25:15', 162, 'update', '', NULL, NULL, NULL),
(132, 1, '2018-09-20', '12:25:20', 162, 'update', '', NULL, NULL, NULL),
(133, 1, '2018-09-20', '12:25:30', 162, 'update', '', NULL, NULL, NULL),
(134, 1, '2018-09-20', '12:25:37', 162, 'update', '', NULL, NULL, NULL),
(135, 1, '2018-09-20', '12:25:45', 162, 'update', '', NULL, NULL, NULL),
(136, 1, '2018-09-20', '12:27:03', 162, 'update', '', NULL, NULL, NULL),
(137, 1, '2018-09-21', '11:44:49', 0, 'login', '', NULL, NULL, NULL),
(138, 1, '2018-09-21', '11:45:57', 0, 'create', '', NULL, NULL, NULL),
(139, 1, '2018-09-21', '11:49:12', 132, 'create', '', NULL, NULL, NULL),
(140, 1, '2018-09-21', '17:50:59', 0, 'login', '', NULL, NULL, NULL),
(141, 1, '2018-09-21', '17:57:14', 40, 'create', '', NULL, NULL, NULL),
(142, 1, '2018-09-24', '12:29:08', 0, 'login', '', NULL, NULL, NULL),
(143, 1, '2018-09-24', '12:50:50', 177, 'create', '', NULL, NULL, NULL),
(144, 1, '2018-09-24', '15:20:02', 0, 'login', '', NULL, NULL, NULL),
(145, 1, '2018-09-24', '15:27:38', 153, 'update', '', NULL, NULL, NULL),
(146, 1, '2018-09-24', '15:27:43', 153, 'update', '', NULL, NULL, NULL),
(147, 1, '2018-09-24', '15:27:43', 153, 'update', '', NULL, NULL, NULL),
(148, 1, '2018-09-24', '15:28:46', 153, 'update', '', NULL, NULL, NULL),
(149, 1, '2018-09-24', '16:07:41', 202, 'create', '', NULL, NULL, NULL),
(150, 1, '2018-09-24', '16:07:46', 202, 'update', '', NULL, NULL, NULL),
(151, 1, '2018-09-24', '16:10:36', 153, 'update', '', NULL, NULL, NULL),
(152, 1, '2018-09-24', '16:11:11', 153, 'update', '', NULL, NULL, NULL),
(153, 1, '2018-09-24', '16:11:56', 153, 'update', '', NULL, NULL, NULL),
(154, 1, '2018-09-24', '19:15:09', 153, 'update', '', NULL, NULL, NULL),
(155, 1, '2018-09-24', '19:15:17', 153, 'update', '', NULL, NULL, NULL),
(156, 1, '2018-09-24', '19:15:41', 153, 'update', '', NULL, NULL, NULL),
(157, 1, '2018-09-24', '19:16:14', 153, 'update', '', NULL, NULL, NULL),
(158, 1, '2018-09-24', '19:16:29', 153, 'update', '', NULL, NULL, NULL),
(159, 1, '2018-09-24', '19:17:05', 153, 'update', '', NULL, NULL, NULL),
(160, 1, '2018-09-24', '19:17:40', 153, 'update', '', NULL, NULL, NULL),
(161, 1, '2018-09-24', '19:18:28', 153, 'update', '', NULL, NULL, NULL),
(162, 1, '2018-09-24', '19:21:12', 153, 'update', '', NULL, NULL, NULL),
(163, 1, '2018-09-24', '19:21:39', 153, 'update', '', NULL, NULL, NULL),
(164, 1, '2018-09-24', '19:21:54', 153, 'update', '', NULL, NULL, NULL),
(165, 1, '2018-09-24', '19:23:04', 153, 'update', '', NULL, NULL, NULL),
(166, 1, '2018-09-24', '19:23:46', 153, 'update', '', NULL, NULL, NULL),
(167, 1, '2018-09-24', '19:24:20', 153, 'update', '', NULL, NULL, NULL),
(168, 1, '2018-09-24', '19:36:39', 153, 'update', '', NULL, NULL, NULL),
(169, 1, '2018-09-24', '19:37:04', 153, 'update', '', NULL, NULL, NULL),
(170, 1, '2018-09-24', '19:37:23', 153, 'update', '', NULL, NULL, NULL),
(171, 1, '2018-09-24', '19:37:53', 153, 'update', '', NULL, NULL, NULL),
(172, 1, '2018-09-25', '10:34:07', 0, 'login', '', NULL, NULL, NULL),
(173, 1, '2018-09-25', '10:36:00', 153, 'update', '', NULL, NULL, NULL),
(174, 1, '2018-09-25', '10:36:13', 153, 'update', '', NULL, NULL, NULL),
(175, 1, '2018-09-25', '10:36:30', 153, 'update', '', NULL, NULL, NULL),
(176, 1, '2018-09-25', '10:39:46', 153, 'update', '', NULL, NULL, NULL),
(177, 1, '2018-09-25', '10:40:00', 153, 'update', '', NULL, NULL, NULL),
(178, 1, '2018-09-25', '10:41:26', 153, 'update', '', NULL, NULL, NULL),
(179, 1, '2018-09-25', '10:45:34', 153, 'update', '', NULL, NULL, NULL),
(180, 1, '2018-09-25', '10:47:20', 153, 'update', '', NULL, NULL, NULL),
(181, 1, '2018-09-25', '10:47:33', 153, 'update', '', NULL, NULL, NULL),
(182, 1, '2018-09-25', '10:48:11', 153, 'update', '', NULL, NULL, NULL),
(183, 1, '2018-09-25', '10:48:41', 153, 'update', '', NULL, NULL, NULL),
(184, 1, '2018-09-25', '14:34:50', 0, 'login', '', NULL, NULL, NULL),
(185, 1, '2018-09-25', '15:19:58', 153, 'update', '', NULL, NULL, NULL),
(186, 1, '2018-09-25', '15:20:17', 153, 'update', '', NULL, NULL, NULL),
(187, 1, '2018-09-25', '15:21:50', 153, 'update', '', NULL, NULL, NULL),
(188, 1, '2018-09-25', '15:24:24', 153, 'update', '', NULL, NULL, NULL),
(189, 1, '2018-09-25', '15:24:40', 153, 'update', '', NULL, NULL, NULL),
(190, 1, '2018-09-25', '15:24:52', 153, 'update', '', NULL, NULL, NULL),
(191, 1, '2018-09-25', '15:33:16', 153, 'update', '', NULL, NULL, NULL),
(192, 1, '2018-09-25', '15:45:25', 153, 'update', '', NULL, NULL, NULL),
(193, 1, '2018-09-25', '15:59:59', 170, 'create', '', NULL, NULL, NULL),
(194, 1, '2018-09-25', '18:31:28', 0, 'login', '', NULL, NULL, NULL),
(195, 1, '2018-09-25', '19:27:12', 0, 'logout', '', NULL, NULL, NULL),
(196, 1, '2018-09-25', '20:43:49', 0, 'login', '', NULL, NULL, NULL),
(197, 1, '2018-09-26', '08:23:03', 0, 'login', '', NULL, NULL, NULL),
(198, 1, '2018-09-26', '09:03:17', 0, 'create', '', NULL, NULL, NULL),
(199, 1, '2018-09-26', '09:04:05', 132, 'create', '', NULL, NULL, NULL),
(200, 1, '2018-09-26', '09:27:15', 203, 'create', '', NULL, NULL, NULL),
(201, 1, '2018-09-26', '09:29:04', 203, 'create', '', NULL, NULL, NULL),
(202, 1, '2018-09-26', '09:30:00', 203, 'create', '', NULL, NULL, NULL),
(203, 1, '2018-09-26', '10:09:22', 203, 'update', '', NULL, NULL, NULL),
(204, 1, '2018-09-26', '10:17:24', 153, 'update', '', NULL, NULL, NULL),
(205, 1, '2018-09-26', '10:17:47', 203, 'update', '', NULL, NULL, NULL),
(206, 1, '2018-09-26', '10:18:19', 203, 'update', '', NULL, NULL, NULL),
(207, 1, '2018-09-26', '10:18:41', 203, 'update', '', NULL, NULL, NULL),
(208, 1, '2018-09-26', '10:19:00', 203, 'update', '', NULL, NULL, NULL),
(209, 1, '2018-09-26', '10:38:22', 203, 'update', '', NULL, NULL, NULL),
(210, 1, '2018-09-26', '10:38:28', 203, 'update', '', NULL, NULL, NULL),
(211, 1, '2018-09-26', '11:22:11', 203, 'update', '', NULL, NULL, NULL),
(212, 1, '2018-09-26', '11:22:58', 203, 'update', '', NULL, NULL, NULL),
(213, 1, '2018-09-26', '12:39:36', 165, 'update', '', NULL, NULL, NULL),
(214, 1, '2018-09-26', '12:41:50', 165, 'create', '', NULL, NULL, NULL),
(215, 1, '2018-09-26', '12:43:57', 162, 'update', '', NULL, NULL, NULL),
(216, 1, '2018-09-26', '16:09:27', 0, 'login', '', NULL, NULL, NULL),
(217, 1, '2018-09-26', '16:14:06', 162, 'update', '', NULL, NULL, NULL),
(218, 1, '2018-09-26', '16:14:55', 165, 'update', '', NULL, NULL, NULL),
(219, 1, '2018-09-26', '16:18:49', 203, 'update', '', NULL, NULL, NULL),
(220, 1, '2018-09-26', '16:20:19', 203, 'update', '', NULL, NULL, NULL),
(221, 1, '2018-09-26', '16:20:24', 203, 'update', '', NULL, NULL, NULL),
(222, 1, '2018-09-26', '16:21:02', 203, 'update', '', NULL, NULL, NULL),
(223, 1, '2018-09-26', '16:41:19', 203, 'update', '', NULL, NULL, NULL),
(224, 1, '2018-09-26', '16:41:19', 203, 'update', '', NULL, NULL, NULL),
(225, 1, '2018-09-26', '16:41:31', 203, 'update', '', NULL, NULL, NULL),
(226, 1, '2018-09-26', '16:41:59', 203, 'update', '', NULL, NULL, NULL),
(227, 1, '2018-09-26', '16:43:58', 203, 'update', '', NULL, NULL, NULL),
(228, 1, '2018-09-26', '16:43:58', 203, 'update', '', NULL, NULL, NULL),
(229, 1, '2018-09-26', '16:44:05', 203, 'update', '', NULL, NULL, NULL),
(230, 1, '2018-09-26', '16:45:38', 203, 'update', '', NULL, NULL, NULL),
(231, 1, '2018-09-27', '13:20:25', 0, 'login', '', NULL, NULL, NULL),
(232, 1, '2018-09-27', '13:20:58', 153, 'create', '', NULL, NULL, NULL),
(233, 1, '2018-09-27', '13:56:38', 153, 'create', '', NULL, NULL, NULL),
(234, 1, '2018-09-27', '13:57:19', 153, 'create', '', NULL, NULL, NULL),
(235, 1, '2018-10-12', '11:04:11', 153, 'update', '', NULL, NULL, NULL),
(236, 1, '2018-10-12', '11:04:11', 153, 'update', '', NULL, NULL, NULL),
(237, 1, '2018-10-12', '11:05:19', 153, 'update', '', NULL, NULL, NULL),
(238, 1, '2018-10-12', '11:06:03', 153, 'update', '', NULL, NULL, NULL),
(239, 1, '2018-10-12', '11:06:03', 153, 'update', '', NULL, NULL, NULL),
(240, 1, '2018-10-12', '11:07:12', 153, 'update', '', NULL, NULL, NULL),
(241, 1, '2018-10-12', '11:07:46', 0, 'login', '', NULL, NULL, NULL),
(242, 1, '2018-10-12', '11:13:30', 153, 'update', '', NULL, NULL, NULL),
(243, 1, '2018-10-12', '11:14:49', 153, 'update', '', NULL, NULL, NULL),
(244, 1, '2018-10-12', '11:15:38', 153, 'update', '', NULL, NULL, NULL),
(245, 1, '2018-10-12', '11:15:57', 153, 'update', '', NULL, NULL, NULL),
(246, 1, '2018-10-12', '11:15:57', 153, 'update', '', NULL, NULL, NULL),
(247, 1, '2018-10-12', '11:16:10', 153, 'update', '', NULL, NULL, NULL),
(248, 1, '2018-10-12', '11:17:15', 153, 'update', '', NULL, NULL, NULL),
(249, 1, '2018-10-12', '11:17:20', 153, 'update', '', NULL, NULL, NULL),
(250, 1, '2018-10-12', '11:18:06', 153, 'update', '', NULL, NULL, NULL),
(251, 1, '2018-10-12', '11:18:26', 153, 'update', '', NULL, NULL, NULL),
(252, 1, '2018-10-12', '11:18:26', 153, 'update', '', NULL, NULL, NULL),
(253, 1, '2018-10-12', '11:18:41', 153, 'update', '', NULL, NULL, NULL),
(254, 1, '2018-10-12', '11:31:47', 153, 'update', '', NULL, NULL, NULL),
(255, 1, '2018-10-12', '11:32:41', 153, 'update', '', NULL, NULL, NULL),
(256, 1, '2018-10-12', '11:32:41', 153, 'update', '', NULL, NULL, NULL),
(257, 1, '2018-10-12', '11:33:56', 153, 'update', '', NULL, NULL, NULL),
(258, 1, '2018-10-12', '11:33:56', 153, 'update', '', NULL, NULL, NULL),
(259, 1, '2018-10-14', '14:17:04', 0, 'login', '', NULL, NULL, NULL),
(260, 1, '2018-10-14', '14:19:34', 0, 'login', '', NULL, NULL, NULL),
(261, 1, '2018-10-14', '21:30:29', 0, 'login', '', NULL, NULL, NULL),
(262, 1, '2018-10-14', '21:56:28', 0, 'login', '', NULL, NULL, NULL),
(263, 1, '2018-10-15', '09:02:28', 0, 'login', '', NULL, NULL, NULL),
(264, 1, '2018-10-18', '08:37:26', 0, 'login', '', NULL, NULL, NULL),
(265, 1, '2018-10-18', '08:44:04', 40, 'update', '', NULL, NULL, NULL),
(266, 1, '2018-10-18', '08:45:01', 40, 'update', '', NULL, NULL, NULL),
(267, 1, '2018-10-18', '08:46:38', 40, 'update', '', NULL, NULL, NULL),
(268, 1, '2018-10-18', '08:47:03', 40, 'update', '', NULL, NULL, NULL),
(269, 1, '2018-10-18', '08:48:37', 40, 'update', '', NULL, NULL, NULL),
(270, 1, '2018-10-18', '09:27:59', 132, 'forced_delete', '', NULL, NULL, NULL),
(271, 1, '2018-10-18', '09:40:39', 132, 'update', '', NULL, NULL, NULL),
(272, 1, '2018-10-18', '09:41:03', 132, 'forced_delete', '', NULL, NULL, NULL),
(273, 1, '2018-10-18', '09:41:10', 132, 'update', '', NULL, NULL, NULL),
(274, 1, '2018-10-18', '21:47:21', 0, 'login', '', NULL, NULL, NULL),
(275, 1, '2018-10-19', '06:51:33', 0, 'login', '', NULL, NULL, NULL),
(276, 1, '2018-10-19', '07:14:39', 203, 'update', '', NULL, NULL, NULL),
(277, 1, '2018-10-19', '07:14:41', 203, 'delete', '', NULL, NULL, NULL),
(278, 1, '2018-10-19', '07:38:15', 0, 'forced_delete', '', NULL, NULL, NULL),
(279, 1, '2018-10-19', '07:38:30', 132, 'forced_delete', '', NULL, NULL, NULL),
(280, 1, '2018-10-19', '07:38:57', 132, 'forced_delete', '', NULL, NULL, NULL),
(281, 1, '2018-10-19', '07:39:14', 0, 'forced_delete', '', NULL, NULL, NULL),
(282, 1, '2018-10-19', '07:41:27', 0, 'forced_delete', '', NULL, NULL, NULL),
(283, 1, '2018-10-19', '07:41:45', 0, 'forced_delete', '', NULL, NULL, NULL),
(284, 1, '2018-10-19', '07:42:56', 203, 'create', '', NULL, NULL, NULL),
(285, 1, '2018-10-19', '08:14:59', 203, 'update', '', NULL, NULL, NULL),
(286, 1, '2018-10-19', '08:14:59', 203, 'update', '', NULL, NULL, NULL),
(287, 1, '2018-10-19', '08:19:29', 203, 'update', '', NULL, NULL, NULL),
(288, 1, '2018-10-19', '08:19:29', 203, 'update', '', NULL, NULL, NULL),
(289, 1, '2018-10-19', '08:19:48', 203, 'update', '', NULL, NULL, NULL),
(290, 1, '2018-10-19', '08:24:19', 203, 'update', '', NULL, NULL, NULL),
(291, 1, '2018-10-19', '08:24:21', 203, 'update', '', NULL, NULL, NULL),
(292, 1, '2018-10-19', '08:24:22', 203, 'update', '', NULL, NULL, NULL),
(293, 1, '2018-10-19', '08:24:22', 203, 'update', '', NULL, NULL, NULL),
(294, 1, '2018-10-19', '08:24:22', 203, 'update', '', NULL, NULL, NULL),
(295, 1, '2018-10-19', '08:24:39', 203, 'update', '', NULL, NULL, NULL),
(296, 1, '2018-10-19', '08:31:00', 203, 'update', '', NULL, NULL, NULL),
(297, 1, '2018-11-07', '11:57:52', 0, 'login', '', NULL, NULL, NULL),
(298, 1, '2018-11-07', '11:57:55', 0, 'login', '', NULL, NULL, NULL),
(299, 1, '2018-11-07', '11:57:58', 0, 'login', '', NULL, NULL, NULL),
(300, 1, '2018-11-07', '12:14:34', 0, 'login', '', NULL, NULL, NULL),
(301, 1, '2018-11-07', '12:16:59', 0, 'login', '', NULL, NULL, NULL),
(302, 1, '2018-11-07', '12:17:02', 0, 'login', '', NULL, NULL, NULL),
(303, 1, '2018-11-07', '12:17:03', 0, 'login', '', NULL, NULL, NULL),
(304, 1, '2018-11-07', '12:17:05', 0, 'login', '', NULL, NULL, NULL),
(305, 1, '2018-11-07', '12:20:55', 0, 'login', '', NULL, NULL, NULL),
(306, 1, '2018-11-07', '12:21:07', 0, 'login', '', NULL, NULL, NULL),
(307, 1, '2018-11-07', '12:21:08', 0, 'login', '', NULL, NULL, NULL),
(308, 1, '2018-11-07', '12:22:49', 0, 'login', '', NULL, NULL, NULL),
(309, 1, '2018-11-07', '12:22:51', 0, 'login', '', NULL, NULL, NULL),
(310, 1, '2018-11-07', '12:23:26', 0, 'login', '', NULL, NULL, NULL),
(311, 1, '2018-11-07', '12:23:28', 0, 'login', '', NULL, NULL, NULL),
(312, 1, '2018-11-07', '12:23:28', 0, 'login', '', NULL, NULL, NULL),
(313, 1, '2018-11-07', '12:34:23', 0, 'login', '', NULL, NULL, NULL),
(314, 1, '2018-11-07', '12:34:24', 0, 'login', '', NULL, NULL, NULL),
(315, 1, '2018-11-07', '12:34:26', 0, 'login', '', NULL, NULL, NULL),
(316, 1, '2018-11-07', '12:34:26', 0, 'login', '', NULL, NULL, NULL),
(317, 1, '2018-11-07', '12:34:26', 0, 'login', '', NULL, NULL, NULL),
(318, 1, '2018-11-07', '12:34:26', 0, 'login', '', NULL, NULL, NULL),
(319, 1, '2018-11-07', '12:34:26', 0, 'login', '', NULL, NULL, NULL),
(320, 1, '2018-11-07', '12:36:15', 0, 'login', '', NULL, NULL, NULL),
(321, 1, '2018-11-07', '12:36:26', 0, 'login', '', NULL, NULL, NULL),
(322, 1, '2018-11-07', '12:36:48', 0, 'login', '', NULL, NULL, NULL),
(323, 1, '2018-11-07', '13:06:43', 0, 'login', '', NULL, NULL, NULL),
(324, 1, '2018-11-07', '13:24:30', 132, 'forced_delete', '', NULL, NULL, NULL),
(325, 1, '2018-11-07', '13:26:57', 132, 'forced_delete', '', NULL, NULL, NULL),
(326, 1, '2018-11-07', '16:55:14', 0, 'login', '', NULL, NULL, NULL),
(327, 1, '2018-11-07', '19:23:41', 0, 'login', '', NULL, NULL, NULL),
(328, 1, '2018-11-08', '08:25:48', 0, 'login', '', NULL, NULL, NULL),
(329, 1, '2018-11-08', '09:37:21', 132, 'forced_delete', '', NULL, NULL, NULL),
(330, 1, '2018-11-08', '09:37:31', 132, 'forced_delete', '', NULL, NULL, NULL),
(331, 1, '2018-11-08', '09:51:42', 132, 'forced_delete', '', NULL, NULL, NULL),
(332, 1, '2018-11-08', '11:51:43', 162, 'create', '', NULL, NULL, NULL),
(333, 1, '2018-11-08', '11:53:29', 162, 'create', '', NULL, NULL, NULL),
(334, 1, '2018-11-08', '12:43:19', 162, 'update', '', NULL, NULL, NULL),
(335, 1, '2018-11-08', '12:43:33', 162, 'update', '', NULL, NULL, NULL),
(336, 1, '2018-11-08', '12:43:42', 162, 'update', '', NULL, NULL, NULL),
(337, 1, '2018-11-08', '15:14:32', 0, 'login', '', NULL, NULL, NULL),
(338, 1, '2018-11-08', '20:04:26', 0, 'login', '', NULL, NULL, NULL),
(339, 1, '2018-11-08', '20:10:05', 0, 'logout', '', NULL, NULL, NULL),
(340, 3, '2018-11-08', '20:10:22', 0, 'login', '', NULL, NULL, NULL),
(341, 3, '2018-11-08', '20:19:11', 0, 'logout', '', NULL, NULL, NULL),
(342, 1, '2018-11-08', '20:20:12', 0, 'login', '', NULL, NULL, NULL),
(343, 1, '2018-11-09', '08:51:18', 0, 'login', '', NULL, NULL, NULL),
(344, 1, '2018-11-09', '09:37:20', 0, 'logout', '', NULL, NULL, NULL),
(345, 3, '2018-11-09', '09:37:27', 0, 'login', '', NULL, NULL, NULL),
(346, 3, '2018-11-09', '09:41:35', 0, 'logout', '', NULL, NULL, NULL),
(347, 1, '2018-11-09', '09:41:40', 0, 'login', '', NULL, NULL, NULL),
(348, 1, '2018-11-09', '09:43:19', 0, 'logout', '', NULL, NULL, NULL),
(349, 1, '2018-11-09', '09:43:26', 0, 'login', '', NULL, NULL, NULL),
(350, 1, '2018-11-09', '09:43:45', 0, 'logout', '', NULL, NULL, NULL),
(351, 3, '2018-11-09', '09:43:51', 0, 'login', '', NULL, NULL, NULL),
(352, 3, '2018-11-09', '09:57:08', 0, 'logout', '', NULL, NULL, NULL),
(353, 1, '2018-11-09', '09:57:14', 0, 'login', '', NULL, NULL, NULL),
(354, 1, '2018-11-09', '09:58:34', 0, 'logout', '', NULL, NULL, NULL),
(355, 3, '2018-11-09', '09:58:37', 0, 'login', '', NULL, NULL, NULL),
(356, 3, '2018-11-09', '10:24:34', 0, 'logout', '', NULL, NULL, NULL),
(357, 1, '2018-11-09', '10:24:40', 0, 'login', '', NULL, NULL, NULL),
(358, 1, '2018-11-09', '10:26:41', 0, 'update', '', NULL, NULL, NULL),
(359, 1, '2018-11-09', '10:27:30', 0, 'update', '', NULL, NULL, NULL),
(360, 1, '2018-11-09', '10:27:55', 0, 'update', '', NULL, NULL, NULL),
(361, 1, '2018-11-09', '10:30:08', 0, 'logout', '', NULL, NULL, NULL),
(362, 1, '2018-11-09', '10:30:26', 0, 'login', '', NULL, NULL, NULL),
(363, 3, '2018-11-09', '10:30:30', 0, 'login', '', NULL, NULL, NULL),
(364, 3, '2018-11-09', '13:02:46', 0, 'login', '', NULL, NULL, NULL),
(365, 1, '2018-11-09', '15:17:27', 0, 'login', '', NULL, NULL, NULL),
(366, 3, '2018-11-09', '17:26:12', 0, 'login', '', NULL, NULL, NULL),
(367, 1, '2018-11-09', '18:32:53', 162, 'update', '', NULL, NULL, NULL),
(368, 3, '2018-11-09', '21:19:37', 0, 'login', '', NULL, NULL, NULL),
(369, 1, '2018-11-10', '09:55:14', 0, 'login', '', NULL, NULL, NULL),
(370, 3, '2018-11-10', '10:08:50', 0, 'login', '', NULL, NULL, NULL),
(371, 1, '2018-11-10', '20:38:23', 0, 'login', '', NULL, NULL, NULL),
(372, 3, '2018-11-10', '21:03:05', 0, 'login', '', NULL, NULL, NULL),
(373, 1, '2018-11-10', '21:27:52', 162, 'update', '', NULL, NULL, NULL),
(374, 1, '2018-11-10', '21:28:13', 162, 'update', '', NULL, NULL, NULL),
(375, 1, '2018-11-10', '21:28:32', 162, 'update', '', NULL, NULL, NULL),
(376, 1, '2018-11-10', '21:35:00', 162, 'update', '', NULL, NULL, NULL),
(377, 1, '2018-11-10', '21:40:31', 162, 'update', '', NULL, NULL, NULL),
(378, 1, '2018-11-10', '21:49:30', 162, 'update', '', NULL, NULL, NULL),
(379, 1, '2018-11-10', '22:31:57', 0, 'logout', '', NULL, NULL, NULL),
(380, 1, '2018-11-11', '09:57:48', 0, 'login', '', NULL, NULL, NULL),
(381, 1, '2018-11-11', '12:41:04', 0, 'login', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_status`
--

CREATE TABLE `login_status` (
  `userid` int(5) NOT NULL,
  `log` int(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_status`
--

INSERT INTO `login_status` (`userid`, `log`) VALUES
(1, 380),
(3, 371),
(4, 13851),
(7, 13880),
(10, 30299),
(11, 13903),
(12, 13905),
(13, 13907);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(4) NOT NULL,
  `company` text,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fax` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(50) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `joined` datetime DEFAULT NULL,
  `status` smallint(1) NOT NULL,
  `verify_code` text,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `company`, `first_name`, `last_name`, `address`, `phone`, `fax`, `email`, `website`, `state`, `city`, `zip`, `image`, `joined`, `status`, `verify_code`, `created`, `updated`, `deleted`) VALUES
(1, 'PT. Angin Ribut Makmur', 'Tojino', 'Martini', 'JL Senam', '061931794', '0', 'none@none.com', 'www.homepage.com', 'North Sumatera', 'Medan', '13819', NULL, '2018-11-08 06:15:30', 1, NULL, '2018-11-08 05:05:13', NULL, NULL),
(2, 'PT. KeDua', 'Tojino', 'Martini', 'JL Senam', '061931794', '0', 'none@none.com', 'www.homepage.com', 'North Sumatera', 'Medan', '13819', NULL, '2018-11-08 06:15:30', 1, NULL, '2018-11-08 05:05:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `parent_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `position` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `type` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '#',
  `menu_order` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `class_style` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `id_style` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `default` int(1) NOT NULL DEFAULT '0',
  `limit` int(3) NOT NULL DEFAULT '5',
  `icon` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `target` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '_parent',
  `publish` smallint(1) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id` int(5) NOT NULL,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `limit` int(3) NOT NULL DEFAULT '10',
  `publish` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  `status` enum('user','admin') COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL,
  `role` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `icon` varchar(50) COLLATE latin1_general_ci DEFAULT 'default.png',
  `order` int(5) NOT NULL DEFAULT '0',
  `closing` smallint(1) NOT NULL,
  `table_name` text COLLATE latin1_general_ci,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id`, `name`, `title`, `limit`, `publish`, `status`, `aktif`, `role`, `icon`, `order`, `closing`, `table_name`, `created`, `updated`, `deleted`) VALUES
(34, 'main', '', 10, 'N', 'admin', 'Y', 'admin,officer,staff', '', 0, 0, NULL, NULL, NULL, NULL),
(39, 'log', 'Log History', 25, 'N', 'admin', 'Y', 'admin', 'log.png', 0, 1, 'log', NULL, '2017-07-17 10:40:41', NULL),
(40, 'admin', 'User Login', 15, 'N', 'admin', 'Y', 'admin', 'admin.png', 0, 0, 'user', NULL, '2017-07-17 10:40:16', NULL),
(41, 'login', '', 10, 'N', 'admin', 'Y', 'admin', '', 0, 1, NULL, NULL, '2017-07-15 12:04:38', NULL),
(47, 'configuration', 'Configuration', 10, 'N', 'admin', 'Y', 'admin', 'configuration.png', 0, 0, 'property', NULL, '2017-07-17 10:41:08', NULL),
(131, 'widget', 'Widget', 25, 'Y', 'admin', 'Y', 'officer,admin', 'widget.png', 1, 1, 'widget', NULL, '2017-07-17 10:40:29', NULL),
(92, 'roles', 'Role  & Privileges', 15, 'N', 'admin', 'Y', 'admin', '', 0, 0, 'role', NULL, '2017-07-17 10:40:55', NULL),
(132, 'adminmenu', 'Menu Administrator', 1000, 'Y', 'admin', 'Y', 'officer,admin', 'adminmenu.png', 2, 0, 'admin_menu', NULL, '2017-07-17 10:38:22', NULL),
(134, 'frontmenu', 'Front Page Menu', 20, 'Y', 'admin', 'Y', 'officer,admin', 'menu.png', 3, 1, 'menu', NULL, '2017-07-17 10:33:01', NULL),
(135, 'city', 'City', 10, 'Y', 'admin', 'Y', 'officer,admin,staff', 'default.png', 5, 0, 'kabupaten', NULL, '2017-10-12 16:59:34', NULL),
(150, 'payment', 'Payment Type', 1000, 'Y', 'admin', 'Y', 'officer,admin', 'default.png', 1, 0, 'payment', '2017-01-09 11:05:52', '2017-07-17 10:22:03', NULL),
(151, 'bank', 'Bank Details', 1000, 'Y', 'admin', 'Y', 'officer,admin', 'default.png', 1, 1, 'bank', '2017-01-10 10:27:04', '2017-07-17 10:22:16', NULL),
(152, 'customer', 'Customers', 10000, 'Y', 'admin', 'Y', 'officer,admin,staff', 'default.png', 1, 1, 'customer', '2017-01-10 14:53:08', '2017-10-12 16:59:48', NULL),
(160, 'journalgl', 'GL - Journal Transaction', 1000000, 'N', 'admin', 'Y', 'officer,admin', 'default.png', 1, 1, 'balances,gls,transactions', '2017-06-23 09:25:09', '2017-07-17 10:32:12', NULL),
(161, 'ledger', 'Account Ledger', 1000000, 'N', 'admin', 'Y', 'officer,admin,staff', 'default.png', 1, 1, 'balances', '2017-06-23 09:29:06', '2017-10-12 16:59:59', NULL),
(162, 'account', 'Chart Of Account', 50, 'N', 'admin', 'Y', 'officer,admin', 'default.png', 1, 0, 'accounts', '2017-06-23 09:29:49', '2018-11-09 10:27:55', NULL),
(163, 'report_reference', 'Financial Report', 1000, 'N', 'admin', 'Y', 'officer,admin', 'default.png', 1, 0, NULL, '2017-06-23 09:30:33', NULL, NULL),
(164, 'classification', 'Account Classification', 1000, 'Y', 'admin', 'Y', 'officer,admin', 'default.png', 1, 0, 'classifications', '2017-06-23 09:35:43', '2017-07-17 10:30:55', NULL),
(165, 'controls', 'Account Control', 1000, 'N', 'admin', 'Y', 'officer,admin', 'default.png', 1, 0, 'controls', '2017-06-23 09:36:10', '2017-07-17 10:31:12', NULL),
(166, 'balance', 'Account Balance', 1000, 'N', 'admin', 'Y', 'officer,admin', 'default.png', 1, 1, 'balances', '2017-06-23 09:36:46', '2017-07-17 10:31:31', NULL),
(167, 'closing', 'Period End', 10000, 'N', 'admin', 'Y', 'officer,admin', 'default.png', 1, 0, NULL, '2017-06-27 11:29:50', NULL, NULL),
(168, 'report', 'Report', 1000, 'N', 'admin', 'Y', 'officer,admin', 'default.png', 0, 0, NULL, '2017-06-27 16:22:05', NULL, NULL),
(169, 'cashin', 'Cash - IN', 1000000, 'Y', 'admin', 'Y', 'officer,admin', 'default.png', 1, 1, 'cashin,cashin_trans', '2017-06-28 08:22:14', '2017-07-17 10:23:41', NULL),
(170, 'cashout', 'Cash - Out', 1000000, 'Y', 'admin', 'Y', 'officer,admin', 'default.png', 0, 1, 'cashout,cashout_trans', '2017-06-28 08:22:38', '2017-07-17 10:24:00', NULL),
(171, 'transfer', 'Fund Transfer', 10000000, 'N', 'admin', 'Y', 'officer,admin', 'default.png', 1, 1, 'transfer', '2017-06-28 08:23:08', '2017-07-17 10:24:20', NULL),
(173, 'currency', 'Currency', 100, 'N', 'admin', 'Y', 'officer,admin', 'default.png', 1, 0, 'currencies', '2017-06-30 10:09:58', '2017-07-17 10:20:47', NULL),
(174, 'tax', 'Tax Details', 30, 'N', 'admin', 'Y', 'officer,admin', 'default.png', 1, 0, 'tax', '2017-06-30 10:11:14', '2017-07-17 10:20:13', NULL),
(176, 'cost', 'Cost Type', 1000, 'N', 'admin', 'Y', 'officer,admin', 'default.png', 1, 0, 'costs', '2017-06-30 12:12:36', '2017-07-17 10:22:27', NULL),
(177, 'apc', 'AP - Cash Transaction', 10000, 'N', 'admin', 'Y', 'officer,admin', 'default.png', 1, 1, 'apc,apc_trans,cash_ledger', '2017-06-30 19:56:11', '2017-07-17 09:59:38', NULL),
(202, 'vendor', 'Vendor', 100, 'Y', 'admin', 'Y', 'officer,admin', 'default.png', 0, 0, 'vendor', '2018-09-21 11:45:57', NULL, NULL),
(203, 'service', 'Service Order', 1000, 'Y', 'admin', 'Y', 'officer,admin', 'default.png', 0, 0, 'service', '2018-09-26 09:03:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `id` int(5) NOT NULL,
  `member_id` smallint(3) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(5) NOT NULL,
  `closing_month` int(2) NOT NULL,
  `start_month` int(2) NOT NULL,
  `start_year` int(4) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `member_id`, `month`, `year`, `closing_month`, `start_month`, `start_year`, `status`, `created`, `updated`, `deleted`) VALUES
(1, 1, 9, 2018, 12, 5, 2018, 1, '0000-00-00 00:00:00', '2018-11-09 16:38:35', NULL),
(2, 2, 11, 2018, 12, 5, 2018, 1, '0000-00-00 00:00:00', '2018-09-20 09:05:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone1` varchar(100) NOT NULL,
  `phone2` varchar(100) NOT NULL,
  `fax` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `billing_email` varchar(100) NOT NULL,
  `technical_email` varchar(100) DEFAULT NULL,
  `cc_email` varchar(100) NOT NULL,
  `zip` int(10) NOT NULL,
  `city` char(30) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_no` varchar(100) NOT NULL,
  `bank` text NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `logo` text,
  `meta_description` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `manager` varchar(100) NOT NULL,
  `accounting` varchar(100) NOT NULL,
  `email_link` text,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `name`, `address`, `phone1`, `phone2`, `fax`, `email`, `billing_email`, `technical_email`, `cc_email`, `zip`, `city`, `account_name`, `account_no`, `bank`, `site_name`, `logo`, `meta_description`, `meta_keyword`, `manager`, `accounting`, `email_link`, `created`, `updated`, `deleted`) VALUES
(1, 'Dswip Kreasindo Digital', 'Jl. Jend Gatot Subroto No.329-331\n', '061-4159955', '0-0', '061-4522712', 'info@jumboholidays.com', 'info@jumboholidays.com', 'info@jumboholidays.com', 'info@jumboholidays.com', 20119, 'Medan', 'Jumbo Holidays', '105-000-000000-0', 'Unknow', 'www.jumboholidays.com', 'logo.png', 'Jumbo Holidays', 'Jumbo Holidays', 'Manager', 'Accounting', '', NULL, '2018-09-20 09:05:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `rules` int(1) NOT NULL DEFAULT '1',
  `granted_menu` text,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `desc`, `rules`, `granted_menu`, `created`, `updated`, `deleted`) VALUES
(2, 'officer', 'Manage allsss', 3, '187,165,212,199,178,176,195', NULL, '2017-10-12 16:58:52', NULL),
(4, 'admin', 'Administrator', 3, '187,165,212,199,178,176,195', NULL, '2017-07-23 11:03:18', NULL),
(7, 'staff', 'general staff', 2, '165,178', NULL, '2017-10-12 16:51:55', NULL),
(8, 'marketing', 'marketing', 4, '', NULL, '2016-11-24 15:37:17', '2017-10-12 16:21:11'),
(9, 'Manager', 'Manager', 3, '42,187,41,165,212,199,178,176,195', '2017-10-12 16:22:07', NULL, '2017-10-12 16:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `sample_accounts`
--

CREATE TABLE `sample_accounts` (
  `id` int(9) NOT NULL,
  `member_id` smallint(3) NOT NULL,
  `classification_id` int(3) DEFAULT NULL,
  `currency` varchar(15) NOT NULL,
  `code` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `alias` text NOT NULL,
  `acc_no` varchar(100) DEFAULT NULL,
  `bank` text,
  `city` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `zip` int(10) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `balance_phone` varchar(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `defaults` int(1) NOT NULL DEFAULT '0',
  `bank_stts` int(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sample_accounts`
--

INSERT INTO `sample_accounts` (`id`, `member_id`, `classification_id`, `currency`, `code`, `name`, `alias`, `acc_no`, `bank`, `city`, `phone`, `zip`, `contact`, `fax`, `balance_phone`, `status`, `defaults`, `bank_stts`, `created`, `updated`, `deleted`) VALUES
(11, 1, 14, 'IDR', '140-10', 'Persediaan - 1', 'Stock 1', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, '2018-09-20 12:09:09', NULL),
(12, 1, 13, 'IDR', '150-10', 'Pajak Di Bayar Di Muka - Pembelian', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(8, 1, 7, 'IDR', '110-10', 'Kas Kecil', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 1, NULL, NULL, NULL),
(13, 1, 10, 'IDR', '210-20', 'Hutang Vendor', 'Hutang Vendor', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, '2018-09-21 11:15:54', NULL),
(14, 1, 15, 'IDR', '510-86', 'Biaya Pengiriman Barang', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(15, 1, 16, 'IDR', '410-90', 'Pendapatan atas pengantaran', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(16, 1, 16, 'IDR', '410-60', 'Penjualan', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(17, 1, 15, 'IDR', '510-85', 'Potongan Pembelian', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(18, 1, 16, 'IDR', '410-70', 'Potongan Penjualan', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(19, 1, 17, 'IDR', '520-20', 'Biaya Denda Keterlambatan', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(20, 1, 16, 'IDR', '410-80', 'Pendapatan Denda Keterlambatan', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(21, 1, 18, 'IDR', '320-20', 'Laba Tahun Berjalan', '', '', '', 'MEDAN', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(23, 1, 18, 'IDR', '320-99', 'Historical Balancing', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(24, 1, 7, 'IDR', '110-20', 'Kas', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 1, NULL, NULL, NULL),
(125, 1, 19, 'IDR', '610-15', 'Biaya Retrebusi dan Parkir Kendaraan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(124, 1, 19, 'IDR', '610-14', 'Biaya Pem & Rep. Kendaraan', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(28, 1, 14, 'IDR', '140-20', 'Persediaan - 2', 'Persediaan - 2', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, '2018-09-20 12:09:21', NULL),
(29, 1, 14, 'IDR', '140-30', 'Persediaan 3', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(34, 1, 21, 'IDR', '810-20', 'Laba Rugi Selisih Kurs', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(35, 1, 22, 'IDR', '310-10', 'Modal', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(123, 1, 19, 'IDR', '610-13', 'Biaya BBM Kendaraan', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(122, 1, 19, 'IDR', '610-12', 'Biaya Pengangkutan', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(40, 1, 14, 'IDR', '140-13', 'Retur Pembelian', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(43, 1, 10, 'IDR', '210-10', 'Hutang Dagang', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 1, NULL, NULL, NULL),
(45, 1, 15, 'IDR', '510-83', 'Biaya ( Produksi - HPP )', 'Biaya( Produksi - HPP )', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, '2018-11-10 21:49:30', NULL),
(46, 1, 22, 'IDR', '310-20', 'Modal Perakitan', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(47, 1, 14, 'IDR', '140-40', 'Persediaan 4', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(48, 1, 16, 'IDR', '410-61', 'Penjualan Perakitan', '', '', '', 'bandung', '', 0, '', '', '', 0, 0, 0, NULL, '2018-09-21 11:14:50', NULL),
(49, 1, 20, 'IDR', '130-30', 'Piutang Lain - Lain', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(51, 1, 17, 'IDR', '520-80', 'Komisi Penjualan', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(52, 1, 10, 'IDR', '210-30', 'Hutang Biaya', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(53, 1, 8, 'IDR', '120-11', 'Bank - 1', 'Bank - 1', '', '', 'bandung', '', 0, '', '', '', 1, 0, 1, NULL, '2018-11-10 21:27:52', NULL),
(55, 1, 26, 'IDR', '170-11', 'Akumulasi Penyusutan Tanah', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(56, 1, 26, 'IDR', '170-12', 'Inventaris Alat Listrik', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(57, 1, 26, 'IDR', '170-13', 'Inventaris Alat Elektronik', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(277, 1, 19, 'IDR', '610-46', 'Biaya Pem & Perawatan Gedung', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 1, NULL, NULL, NULL),
(278, 1, 19, 'IDR', '610-48', 'Biaya Deviden', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(275, 1, 10, 'IDR', '210-84', 'Titipan Customer', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(289, 1, 10, 'IDR', '210-32', 'Hutang PPH 21', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(288, 1, 10, 'IDR', '210-19', 'Hutang Giro', 'Hutang Giro', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, '2018-09-22 08:53:04', NULL),
(287, 1, 31, 'IDR', '190-20', 'Biaya Pra Operasi dan Operasi', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(285, 1, 20, 'IDR', '130-93', 'Piutang Karyawan', 'Piutang Karyawan', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(83, 1, 16, 'IDR', '410-30', 'Pendapatan Lain', 'Pendapatan Lain', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, '2018-09-21 11:14:08', NULL),
(84, 1, 16, 'IDR', '410-32', 'Pendapatan Lain 2', 'Pendapatan Lain 2', '', '', 'bandung', '', 0, '', '', '', 0, 0, 0, NULL, '2018-09-21 11:14:32', NULL),
(91, 1, 16, 'IDR', '410-31', 'Pendapatan Lain 3', 'Pendapatan Lain 3', '', '', 'bandung', '', 0, '', '', '', 0, 0, 0, NULL, '2018-09-21 11:14:25', NULL),
(270, 1, 19, 'IDR', '610-45', 'Biaya Sewa Kantor', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(103, 1, 15, 'IDR', '510-42', 'Biaya Perlengkapan Gudang', '', '', '', 'Sumatera Utara', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(118, 1, 17, 'IDR', '520-30', 'Kerusakan dan Kegagalan Material', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(119, 1, 17, 'IDR', '520-10', 'Kerugian Piutang', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(126, 1, 19, 'IDR', '610-16', 'Biaya Internet', 'Biaya Internet', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, '2018-09-21 11:23:41', NULL),
(127, 1, 19, 'IDR', '610-17', 'Biaya Keperluan Kantor', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(133, 1, 19, 'IDR', '610-26', 'PPh Psl 21 / Badan', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(136, 1, 19, 'IDR', '610-29', 'Biaya Bunga Pinjaman Bank', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(137, 1, 19, 'IDR', '610-30', 'Biaya Adm Bank', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(139, 1, 19, 'IDR', '610-32', 'Biaya Pengiriman', 'Biaya Pengiriman', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, '2018-09-21 11:19:37', NULL),
(140, 1, 19, 'IDR', '610-33', 'Biaya Administrasi', 'Biaya Administrasi', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, '2018-09-21 11:20:32', NULL),
(142, 1, 19, 'IDR', '610-35', 'Biaya Direksi', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(150, 1, 24, 'IDR', '660-30', 'Biaya Penyusutan Bangunan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(155, 1, 25, 'IDR', '910-10', 'Biaya Bunga', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(169, 1, 20, 'IDR', '130-50', 'PPn Masukkan', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(173, 1, 10, 'IDR', '210-40', 'Ppn Keluaran', 'Ppn Keluaran', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, '2018-11-10 21:35:00', NULL),
(174, 1, 10, 'IDR', '210-50', 'Hutang Pada Direksi', '', '', '', 'bandung', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(177, 1, 19, 'IDR', '610-18', 'Biaya Pem & Rep Kantor ', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(179, 1, 27, 'IDR', '135-10', 'Piutang Non Usaha', '', '', '', 'MEDAN', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(180, 1, 29, 'IDR', '160-10', 'Investasi Jangka Panjang', '', '', '', 'MEDAN', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(181, 1, 30, 'IDR', '180-20', 'Hak Cipta', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(182, 1, 31, 'IDR', '190-21', 'Akumulasi Amortisasi Pra Operational & Operasi', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(183, 1, 34, 'IDR', '220-10', 'Pendapatan Terima Dimuka', '', '', '', 'MEDAN', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(184, 1, 35, 'IDR', '230-10', 'Hutang Jangka Panjang', '', '', '', 'MEDAN', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(185, 1, 32, 'IDR', '240-10', 'Hutang Non Usaha', '', '', '', 'MEDAN', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(186, 1, 36, 'IDR', '250-10', 'Hutang Lain', '', '', '', 'MEDAN', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(187, 1, 20, 'IDR', '130-52', 'Piutang Persediaan', '', '', '', 'MEDAN', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(189, 1, 37, 'IDR', '420-11', 'Pendapatan Lebih Persediaan', '', '', '', 'MEDAN', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(191, 1, 20, 'IDR', '130-10', 'Piutang Dagang PPN', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(193, 1, 8, 'IDR', '120-13', 'Bank - 2', 'Bank - 2', '', '', 'Medan', '', 0, '', '', '', 1, 0, 1, NULL, '2018-11-10 21:28:13', NULL),
(194, 1, 8, 'IDR', '120-14', 'Bank - 3', 'Bank - 3', '', '', 'Medan', '', 0, '', '', '', 1, 0, 1, NULL, '2018-11-10 21:28:32', NULL),
(202, 1, 20, 'IDR', '130-80', 'Piutang Giro', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(203, 1, 20, 'IDR', '130-90', 'Pinjaman Direksi', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(205, 1, 13, 'IDR', '150-20', 'Asuransi di bayar Dimuka', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(206, 1, 26, 'IDR', '170-20', 'Bangunan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(207, 1, 26, 'IDR', '170-21', 'Akumulasi Penyusutan Bangunan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(208, 1, 26, 'IDR', '170-30', 'Mesin & Peralatan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(209, 1, 26, 'IDR', '170-31', 'Akumulasi Penyusutan Mesin & Peralatan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(210, 1, 26, 'IDR', '170-40', 'Inventaris Kantor', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(211, 1, 26, 'IDR', '170-41', 'Akumulasi Penyusutan Inventaris Kantor', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(212, 1, 26, 'IDR', '170-50', 'Kendaraan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(213, 1, 26, 'IDR', '170-51', 'Akumulasi Penyusutan Kendaraan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(214, 1, 26, 'IDR', '170-10', 'Tanah', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(215, 1, 26, 'IDR', '170-70', 'Harta Lainnya', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(216, 1, 26, 'IDR', '170-71', 'Akumulasi Penyusutan Harta Lainnya', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(217, 1, 26, 'IDR', '170-90', 'Aktiva Tetap', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(218, 1, 26, 'IDR', '170-91', 'Akumulasi Penyusutan Aktiva Tetap', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(219, 1, 30, 'IDR', '180-30', 'Good Will', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(220, 1, 10, 'IDR', '210-31', 'Hutang Gaji', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(221, 1, 10, 'IDR', '210-51', 'Hutang PPh psl 23', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(222, 1, 10, 'IDR', '210-54', 'Hutang Pph 29', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(223, 1, 10, 'IDR', '210-55', 'Laba/Rugi Tahun Berjalan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(224, 1, 10, 'IDR', '210-60', 'Hutang Bank', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(226, 1, 10, 'IDR', '210-82', 'Hutang Komisi Penjualan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(228, 1, 16, 'IDR', '410-13', 'Discount Pasang Iklan', '', '', '', 'Medan', '', 0, '', '', '', 0, 0, 0, NULL, '2018-09-20 12:13:42', NULL),
(229, 1, 16, 'IDR', '410-25', 'Discount Pasang Billboard', 'Discount Pasang Billboard', '', '', 'Medan', '', 0, '', '', '', 0, 0, 0, NULL, '2017-07-06 10:16:56', NULL),
(230, 1, 16, 'IDR', '410-12', 'Discount Penjualan', 'Discount Penjualan', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, '2018-09-26 16:14:06', NULL),
(231, 1, 16, 'IDR', '410-14', 'penjualan Dari Spanduk dn Umbul - Umbul', '', '', '', 'Medan', '', 0, '', '', '', 0, 0, 0, NULL, '2018-09-20 12:14:01', NULL),
(232, 1, 16, 'IDR', '410-33', 'Pendapatan Sewa Tenda dan Inflatables', '', '', '', 'Medan', '', 0, '', '', '', 0, 0, 0, NULL, '2018-09-20 12:14:14', NULL),
(233, 1, 16, 'IDR', '410-40', 'Penjualan Jsa Cetak', '', '', '', 'Medan', '', 0, '', '', '', 0, 0, 0, NULL, '2018-09-20 12:17:25', NULL),
(234, 1, 16, 'IDR', '410-50', 'Pendapatan Jasa Giro', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(235, 1, 16, 'IDR', '410-51', 'Pendapatan Bunga Deposito', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(238, 1, 15, 'IDR', '510-02', 'Biaya Dokumentasi', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(242, 1, 15, 'IDR', '510-80', 'Biaya atas pengiriman Barang', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(243, 1, 19, 'IDR', '610-01', 'Biaya Gaji Karyawan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(244, 1, 19, 'IDR', '610-02', 'Biaya Audit', 'Biaya Audit', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, '2018-09-21 11:25:54', NULL),
(245, 1, 19, 'IDR', '610-03', 'Biaya Tunjangan Karyawan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(246, 1, 19, 'IDR', '610-04', 'Biaya Lembur Karyawan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(247, 1, 19, 'IDR', '610-05', 'Biaya Makan Karyawan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(248, 1, 19, 'IDR', '610-06', 'Biaya Keperluan Dapur', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(249, 1, 19, 'IDR', '610-07', 'Biaya Telepon', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(250, 1, 19, 'IDR', '610-08', 'Biaya Listrik Kantor', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(251, 1, 19, 'IDR', '610-19', 'Biaya Pem & Rep Peralatan Kantor', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(252, 1, 19, 'IDR', '610-20', 'Biaya Penyusutan Aktiva Tetap', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(253, 1, 19, 'IDR', '610-36', 'Biaya Jasa Konsultan', 'Biaya Jasa Konsultan', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, '2018-09-21 11:24:59', NULL),
(254, 1, 19, 'IDR', '610-37', 'Laba Atas Penjualan Aktiva Tetap', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(255, 1, 19, 'IDR', '610-38', 'Biaya Serba Serbi', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(256, 1, 19, 'IDR', '610-39', 'Biaya PPN & Bunga Penagihan PPh', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(257, 1, 19, 'IDR', '610-40', 'Biaya Pemutihan / Pengahapusan Piutang', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(258, 1, 19, 'IDR', '610-41', 'Pajak PBB', 'Pajak PBB', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, '2018-09-21 11:22:37', NULL),
(259, 1, 19, 'IDR', '610-42', 'Biaya THR Karyawan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(260, 1, 19, 'IDR', '610-43', 'Biaya Pem & Rep Mesin dan Peralatan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(261, 1, 19, 'IDR', '610-44', 'Selisih Pembulatan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(262, 1, 24, 'IDR', '660-16', 'Amotisasi Pra operasi dan Operasi', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(263, 1, 24, 'IDR', '660-32', 'Biaya Penyusutan Mesin dan Peralatan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(264, 1, 24, 'IDR', '660-33', 'Biaya Penyusutan Inventaris Kantor', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(265, 1, 24, 'IDR', '660-34', 'Biaya Penyusutan Kendaraan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(266, 1, 24, 'IDR', '660-35', 'Biaya Penyusutan Harta Lainnya', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(267, 1, 21, 'IDR', '810-30', 'Hasil Sewa', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(268, 1, 25, 'IDR', '910-11', 'Jasa Bank', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(269, 1, 16, 'IDR', '410-91', 'Pendapatan Lain  Lain', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(290, 1, 10, 'IDR', '210-53', 'Hutang Pph Psl 25', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(291, 1, 10, 'IDR', '210-70', 'Hutang Lain-Lain', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, '2017-06-23 16:02:07', NULL),
(292, 1, 10, 'IDR', '210-83', 'Kelebihan Pembayaran', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(294, 1, 18, 'IDR', '320-11', 'Saldo Laba', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(295, 1, 18, 'IDR', '320-21', 'Laba Ditahan', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL),
(296, 1, 15, 'IDR', '510-04', 'Discount Pembelian', '', '', '', 'Medan', '', 0, '', '', '', 1, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(9) NOT NULL,
  `gl_id` int(9) NOT NULL,
  `account_id` int(9) DEFAULT NULL,
  `debit` decimal(18,2) NOT NULL,
  `credit` decimal(18,2) NOT NULL,
  `vamount` decimal(18,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `member_id` smallint(3) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` char(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `lastlogin` varchar(10) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `member_id`, `username`, `password`, `name`, `role`, `status`, `lastlogin`, `created`, `updated`, `deleted`) VALUES
(1, 1, 'admin', 'ss2017', 'Administrator', 'admin', 1, '', NULL, '2017-10-12 16:26:07', NULL),
(3, 2, 'demo', 'demo', 'demo', 'admin', 1, '', '2017-09-02 13:43:50', '2017-10-12 16:25:53', NULL),
(4, 1, 'user1', 'user1', 'user1', 'admin', 0, '', '2017-09-29 16:48:33', '2017-10-12 16:25:46', '2017-10-12 17:04:45'),
(5, 1, 'user2', 'user2', 'user2', 'admin', 1, '', '2017-09-29 16:49:08', NULL, '2017-10-12 16:25:31'),
(6, 1, 'user3', 'user3', 'user3', 'admin', 1, '', '2017-09-29 16:50:02', NULL, '2017-10-12 16:25:31'),
(7, 1, 'ratna', 'ratnass201701', 'Ratna', 'staff', 1, '', '2017-10-12 16:27:34', NULL, '2018-09-20 08:48:13'),
(8, 1, 'mita', 'mitass201702', 'MIta', 'staff', 1, '', '2017-10-12 16:28:05', NULL, '2018-09-20 08:48:19'),
(9, 1, 'nisa', 'nisass201703', 'nisa', 'staff', 1, '', '2017-10-12 16:28:40', NULL, '2018-09-20 08:48:22'),
(10, 1, 'officer1', '13241613.', 'Officer1', 'officer', 1, '', '2017-10-12 17:05:42', NULL, NULL),
(11, 1, 'officer2', '13241613.', 'officer2', 'officer', 1, '', '2017-10-12 17:06:23', NULL, NULL),
(12, 1, 'officer3', 'jjss201701', 'Officer3', 'officer', 1, '', '2017-10-12 17:07:16', NULL, NULL),
(13, 1, 'officer4', 'pjss201702', 'officer4', 'officer', 1, '', '2017-10-12 17:08:00', NULL, NULL),
(14, 1, 'dodol', '12345', 'dodol', 'officer', 1, '', '2018-09-21 17:57:14', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classification_id` (`classification_id`);

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `classifications`
--
ALTER TABLE `classifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `closing`
--
ALTER TABLE `closing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gls`
--
ALTER TABLE `gls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `journaltypes`
--
ALTER TABLE `journaltypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sample_accounts`
--
ALTER TABLE `sample_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classification_id` (`classification_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `journal` (`gl_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `classifications`
--
ALTER TABLE `classifications`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `closing`
--
ALTER TABLE `closing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gls`
--
ALTER TABLE `gls`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `journaltypes`
--
ALTER TABLE `journaltypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=382;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sample_accounts`
--
ALTER TABLE `sample_accounts`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
