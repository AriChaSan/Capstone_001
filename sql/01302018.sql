-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2018 at 06:21 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `account_type_id` int(11) NOT NULL,
  `account_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`account_type_id`, `account_type_name`) VALUES
(0, 'Developer'),
(1, ''),
(2, ''),
(3, ''),
(4, ''),
(5, ''),
(6, ''),
(7, 'Receptionist'),
(8, 'Medical Technologist'),
(9, 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `active_result`
--

CREATE TABLE `active_result` (
  `id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `result_updatedby` int(11) NOT NULL COMMENT 'the last user (medtech) who updated the result',
  `result_number` int(11) NOT NULL COMMENT 'how many times was it updated?',
  `test_result_id_and_result_value` varchar(255) NOT NULL COMMENT '1;2;'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `active_transaction`
--

CREATE TABLE `active_transaction` (
  `id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL COMMENT 'unix',
  `trans_key` varchar(10) NOT NULL COMMENT 'rand pass(10)',
  `user_activate_id` int(11) NOT NULL COMMENT 'the user who activated the transaction (most likely medtech)',
  `created_At` int(11) NOT NULL COMMENT 'the unix when was it activated',
  `patient_id` int(11) NOT NULL COMMENT 'patient_id',
  `queue_id` int(11) NOT NULL COMMENT 'queue_id',
  `test_content_id` int(11) NOT NULL COMMENT 'all the tests that actually belongs to this transaction will be listed here'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_transaction`
--

INSERT INTO `active_transaction` (`id`, `trans_id`, `trans_key`, `user_activate_id`, `created_At`, `patient_id`, `queue_id`, `test_content_id`) VALUES
(10, 1517246192, 'P0R9C-D4I3', 3, 1517246205, 1, 1517246192, 44);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `lastupdate_date` int(11) NOT NULL,
  `register_date` int(11) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `account_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `user_id`, `fname`, `mname`, `lname`, `lastupdate_date`, `register_date`, `contact`, `email`, `account_type_id`) VALUES
(1, 1, 'Patricia', 'Rubi', 'Vino', 1512795132, 1512812820, '09777013858', 'patriciavino@gmail.com', 9),
(2, 2, 'Yanni Joyce', 'B', 'Sta. Maria', 1512812820, 1512812820, '09777013858', 'yannistamaria@gmail.com', 8),
(3, 3, 'Styray', 'C', 'Luntayao', 1512794432, 1512812820, '09777013858', 'styxrayluntayao@gmail.com', 7),
(4, 4, 'Romeo', NULL, 'Cajurao', 1512812820, 1512812820, '09777013858', 'cajuraoromeo@gmail.com', 9),
(5, 5, 'Admin', NULL, 'Account', 1517098961, 1517098961, '09777013858', 'dlxagcs@gmail.com', 7);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#3a87ad',
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `allDay` varchar(50) NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `color`, `start`, `end`, `allDay`) VALUES
(1, 'SQA', 'Check All', '#000000', '2017-10-17 00:00:00', '2017-10-18 00:00:00', 'true'),
(2, 'SQA V2', 'Checking...', '#3a87ad', '2017-10-17 00:00:00', '2017-10-18 00:00:00', 'true'),
(3, 'Sportsfest', 'Go!', '#e91818', '2017-10-18 00:00:00', '2017-10-19 00:00:00', 'true'),
(6, 'qwewqe', 'qwewq', '#3a87ad', '2017-12-06 00:00:00', '2017-12-07 00:00:00', 'true'),
(8, 'aaaaaaerwerer', 'qweqwerere', '#3a87ad', '2017-12-06 00:00:00', '2017-12-07 00:00:00', 'true'),
(9, 'wrwere', 'rre', '#3a87ad', '2017-12-07 00:00:00', '2017-12-08 00:00:00', 'true'),
(10, 'Uwi', 'dsd', '#282cca', '2017-11-29 00:00:00', '2017-11-30 00:00:00', 'true'),
(11, 'New Year Celebration!', 'Where:\nWhen:\nNOTE: Be There!', '#189142', '2018-01-03 00:00:00', '2018-01-04 00:00:00', 'true'),
(12, 'Hey', 'Sample Test', '#6d24e3', '2018-01-03 00:00:00', '2018-01-04 00:00:00', 'true'),
(13, 'Hello', 'e', '#3a87ad', '2018-01-03 00:00:00', '2018-01-04 00:00:00', 'true'),
(14, 'asdsa', 'asdsa', '#3a87ad', '2018-01-23 00:00:00', '2018-01-24 00:00:00', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_history`
--

CREATE TABLE `inventory_history` (
  `id` int(11) NOT NULL,
  `history_type` varchar(20) NOT NULL,
  `items_id` int(11) NOT NULL,
  `quantity_old` int(11) NOT NULL,
  `quantity_new` int(11) NOT NULL,
  `quantity_summary` varchar(20) NOT NULL,
  `old_update_date` int(11) NOT NULL,
  `old_updateby` int(11) NOT NULL,
  `new_update_date` int(11) NOT NULL,
  `new_updateby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_history`
--

INSERT INTO `inventory_history` (`id`, `history_type`, `items_id`, `quantity_old`, `quantity_new`, `quantity_summary`, `old_update_date`, `old_updateby`, `new_update_date`, `new_updateby`) VALUES
(1, 'Transaction Consumpt', 3, 82, 81, '-1', 1517215903, 3, 1517215903, 3),
(2, 'Transaction Consumpt', 7, 82, 81, '-1', 1517215903, 3, 1517215903, 3),
(3, 'Transaction Consumpt', 3, 82, 81, '-1', 1517215903, 3, 1517215903, 3),
(4, 'Transaction Consumpt', 23, 82, 81, '-1', 1517215903, 3, 1517215903, 3),
(5, 'Transaction Consumpt', 11, 82, 81, '-1', 1517215903, 3, 1517215903, 3),
(6, 'Transaction Consumpt', 3, 82, 81, '-1', 1517215904, 3, 1517215904, 3),
(7, 'Transaction Consumpt', 3, 81, 80, '-1', 1517215905, 3, 1517215905, 3),
(8, 'Transaction Consumpt', 3, 80, 79, '-1', 1517215906, 3, 1517215906, 3),
(9, 'Transaction Consumpt', 7, 80, 79, '-1', 1517215906, 3, 1517215906, 3),
(10, 'Transaction Consumpt', 3, 80, 79, '-1', 1517215906, 3, 1517215906, 3),
(11, 'Transaction Consumpt', 23, 80, 79, '-1', 1517215906, 3, 1517215906, 3),
(12, 'Transaction Consumpt', 11, 80, 79, '-1', 1517215906, 3, 1517215906, 3),
(13, 'Transaction Consumpt', 3, 80, 79, '-1', 1517215906, 3, 1517215906, 3),
(14, 'Transaction Consumpt', 2, 80, 79, '-1', 1517215906, 3, 1517215906, 3),
(15, 'Transaction Consumpt', 46, 80, 79, '-1', 1517215906, 3, 1517215906, 3),
(16, 'Transaction Consumpt', 44, 80, 79, '-1', 1517215906, 3, 1517215906, 3),
(17, 'Transaction Consumpt', 5, 80, 79, '-1', 1517215907, 3, 1517215907, 3),
(18, 'Transaction Consumpt', 31, 80, 79, '-1', 1517215907, 3, 1517215907, 3),
(19, 'Transaction Consumpt', 3, 79, 78, '-1', 1517218012, 3, 1517218012, 3),
(20, 'Transaction Consumpt', 3, 78, 77, '-1', 1517218014, 3, 1517218014, 3),
(21, 'Transaction Consumpt', 7, 78, 77, '-1', 1517218014, 3, 1517218014, 3),
(22, 'Transaction Consumpt', 3, 78, 77, '-1', 1517218014, 3, 1517218014, 3),
(23, 'Transaction Consumpt', 23, 78, 77, '-1', 1517218014, 3, 1517218014, 3),
(24, 'Transaction Consumpt', 11, 78, 77, '-1', 1517218014, 3, 1517218014, 3),
(25, 'Transaction Consumpt', 3, 78, 77, '-1', 1517218014, 3, 1517218014, 3),
(26, 'Transaction Consumpt', 3, 77, 76, '-1', 1517222444, 3, 1517222444, 3),
(27, 'Transaction Consumpt', 3, 76, 75, '-1', 1517245895, 3, 1517245895, 3),
(28, 'Transaction Consumpt', 3, 75, 74, '-1', 1517245978, 3, 1517245978, 3),
(29, 'Transaction Consumpt', 3, 74, 73, '-1', 1517246166, 3, 1517246166, 3),
(30, 'Transaction Consumpt', 3, 73, 72, '-1', 1517246205, 3, 1517246205, 3);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_prerequisite`
--

CREATE TABLE `inventory_prerequisite` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL COMMENT 'the test_id',
  `test_title` varchar(50) NOT NULL,
  `items_id` int(11) DEFAULT NULL COMMENT 'the item id ',
  `amount_used` int(11) NOT NULL DEFAULT '0' COMMENT 'amount that will be deducted from the inventory'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_prerequisite`
--

INSERT INTO `inventory_prerequisite` (`id`, `test_id`, `test_title`, `items_id`, `amount_used`) VALUES
(1, 44, '', 3, 1),
(2, 49, '', 7, 1),
(3, 60, '', 3, 1),
(4, 47, '', 23, 1),
(5, 46, '', 11, 1),
(6, 51, '', 3, 1),
(7, 11, '', 2, 1),
(8, 1, '', 46, 1),
(9, 1, '', 44, 1),
(10, 1, '', 5, 1),
(11, 1, '', 31, 1),
(12, 91, 'FBS', 3, 1),
(13, 91, 'TAG', 7, 1),
(14, 91, 'TC', 3, 1),
(15, 91, 'BUA', 23, 1),
(16, 91, 'CREA', 11, 1),
(17, 91, 'SGPT', 3, 1),
(18, 92, 'FBS', 3, 1),
(19, 92, 'TAG', 7, 1),
(20, 92, 'TC', 3, 1),
(21, 92, 'BUA', 23, 1),
(22, 92, 'CREA', 11, 1),
(23, 92, 'SGPT', 3, 1),
(24, 92, 'CBC w/ PC', 2, 1),
(25, 92, 'UA', 46, 1),
(26, 92, 'UA', 44, 1),
(27, 92, 'UA', 5, 1),
(28, 92, 'UA', 31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `created_At` int(11) NOT NULL,
  `lastupdated_date` int(11) NOT NULL,
  `lastupdated_by` int(11) NOT NULL COMMENT 'user_id who actually updated the item last',
  `price` varchar(20) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_type_id`, `item_name`, `quantity`, `created_At`, `lastupdated_date`, `lastupdated_by`, `price`) VALUES
(1, 1, 'Blue Top', 72, 1512812820, 1517246205, 3, '100.00'),
(2, 1, 'EDTA Tubes', 72, 1512902201, 1517246205, 3, '0.00'),
(3, 1, 'Red Top Tubes', 72, 1512902284, 1517246205, 3, '0.00'),
(4, 1, 'EDTA Microtainer', 72, 1512902395, 1517246205, 3, '0.00'),
(5, 1, 'Plain Tubes', 72, 1512902528, 1517246205, 3, '0.00'),
(6, 2, 'Chole RGT', 72, 1512902590, 1517246205, 3, '0.00'),
(7, 2, 'Tag RGT', 72, 1512902598, 1517246205, 3, '0.00'),
(8, 2, 'HDL A & B Reagent', 72, 1512902598, 1517246205, 3, '0.00'),
(9, 2, 'BUN RGT', 72, 1512902598, 1517246205, 3, '0.00'),
(10, 2, 'Glucose RGT', 72, 1512902598, 1517246205, 3, '0.00'),
(11, 2, 'Creatinine', 72, 1512902598, 1517246205, 3, '0.00'),
(12, 2, 'ALY RGT', 72, 1512902598, 1517246205, 3, '0.00'),
(13, 2, 'HBA1C', 72, 1512902598, 1517246205, 3, '0.00'),
(14, 2, 'Biochem Control II', 72, 1512902598, 1517246205, 3, '0.00'),
(15, 2, 'Trutol orange 100g', 72, 1512902598, 1517246205, 3, '0.00'),
(16, 2, 'Trutol orange 75g', 72, 1512902598, 1517246205, 3, '0.00'),
(17, 2, 'Antisera A', 72, 1512902598, 1517246205, 3, '0.00'),
(18, 2, 'Antisera B', 72, 1512902598, 1517246205, 3, '0.00'),
(19, 2, 'Antisera D', 72, 1512902598, 1517246205, 3, '0.00'),
(20, 2, 'Biochem Calibrator', 72, 1512902598, 1517246205, 3, '0.00'),
(21, 2, 'ASY RGT', 72, 1512902598, 1517246205, 3, '0.00'),
(22, 2, 'Biochem Control I', 72, 1512902598, 1517246205, 3, '0.00'),
(23, 2, 'BUA RGT', 72, 1512902598, 1517246205, 3, '0.00'),
(24, 3, 'Blue TIPS', 72, 1512902598, 1517246205, 3, '0.00'),
(25, 3, 'Yellow TIPS', 72, 1512902598, 1517246205, 3, '0.00'),
(26, 4, 'RPR KIT', 72, 1512902598, 1517246205, 3, '0.00'),
(27, 4, 'HBSAG KIT', 72, 1512902598, 1517246205, 3, '0.00'),
(28, 5, 'Glucose Meter Strips', 72, 1512902598, 1517246205, 3, '0.00'),
(29, 5, 'Seal Ease Tube Sealant', 72, 1512902598, 1517246205, 3, '0.00'),
(30, 5, 'Probe Cleanser', 72, 1512902598, 1517246205, 3, '0.00'),
(31, 5, 'Glass Slides', 72, 1512902598, 1517246205, 3, '0.00'),
(32, 5, 'Pregnancy Test', 72, 1512902598, 1517246205, 3, '0.00'),
(33, 5, 'Hema Screen Occult Blood', 72, 1512902598, 1517246205, 3, '0.00'),
(34, 5, 'Micropore 3M', 72, 1512902598, 1517246205, 3, '0.00'),
(35, 5, 'Cover Slip', 72, 1512902598, 1517246205, 3, '0.00'),
(36, 5, 'Applicator Stick', 72, 1512902598, 1517246205, 3, '0.00'),
(37, 5, 'Blood Lancet', 72, 1512902598, 1517246205, 3, '0.00'),
(38, 5, 'ESR Tubes w/ AC', 72, 1512902598, 1517246205, 3, '0.00'),
(39, 5, 'Parafilm', 72, 1512902598, 1517246205, 3, '0.00'),
(40, 5, 'Tuberculin', 72, 1512902598, 1517246205, 3, '0.00'),
(41, 5, 'Syringe 3cc', 72, 1512902598, 1517246205, 3, '0.00'),
(42, 5, 'Syringe 5cc', 72, 1512902598, 1517246205, 3, '0.00'),
(43, 5, 'Urine Strips (10 para)', 72, 1512902598, 1517246205, 3, '0.00'),
(44, 5, 'Urine Strips (4 para)', 72, 1512902598, 1517246205, 3, '0.00'),
(45, 5, 'Heparinized Capillet', 72, 1512902598, 1517246205, 3, '0.00'),
(46, 5, 'Urine Cups', 72, 1512977985, 1517246205, 3, '0.00'),
(221, 5, 'Large Syringe', 72, 1517098703, 1517246205, 3, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE `item_type` (
  `id` int(11) NOT NULL,
  `item_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`id`, `item_type_name`) VALUES
(1, 'TUBES'),
(2, 'RGT'),
(3, 'TIPS'),
(4, 'KIT'),
(5, 'GENERAL');

-- --------------------------------------------------------

--
-- Table structure for table `passive_result`
--

CREATE TABLE `passive_result` (
  `id` int(11) NOT NULL,
  `result_passive_creator` int(11) NOT NULL COMMENT 'the user who put the result to passive',
  `result_passive_created_At` int(11) NOT NULL COMMENT 'unix(when was it moved to passive?)',
  `result_updatedby` int(11) NOT NULL COMMENT 'the last user (medtech) who updated the result'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passive_transaction`
--

CREATE TABLE `passive_transaction` (
  `id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL COMMENT 'unix',
  `trans_key` varchar(10) NOT NULL COMMENT 'rand pass(10)',
  `user_activate_id` int(11) NOT NULL COMMENT 'the user who activated the transaction (most likely medtech)',
  `created_At` int(11) NOT NULL COMMENT 'the unix when was it activated',
  `patient_id` int(11) NOT NULL COMMENT 'patient_id',
  `queue_id` int(11) NOT NULL COMMENT 'queue_id',
  `test_content_id` int(11) NOT NULL COMMENT 'all the tests that actually belongs to this transaction will be listed here'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `p-fname` varchar(255) NOT NULL,
  `p-mname` varchar(255) DEFAULT NULL,
  `p-lname` varchar(255) NOT NULL,
  `p-gender` int(1) NOT NULL,
  `p-contact` varchar(20) NOT NULL,
  `p-email` varchar(255) NOT NULL,
  `e-fname` varchar(255) NOT NULL,
  `e-mname` varchar(255) DEFAULT NULL,
  `e-lname` varchar(255) NOT NULL,
  `e-relation` varchar(255) NOT NULL,
  `e-contact` varchar(255) NOT NULL,
  `register_date` int(11) NOT NULL,
  `lastupdate_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `p-fname`, `p-mname`, `p-lname`, `p-gender`, `p-contact`, `p-email`, `e-fname`, `e-mname`, `e-lname`, `e-relation`, `e-contact`, `register_date`, `lastupdate_date`) VALUES
(1, 'Jericho', NULL, 'Rosales', 0, '09777013858', 'jericho.rosales@gmail.com', '', NULL, '', '', '', 1517100364, 1517216090),
(2, 'Anika', NULL, 'Gonzales', 1, '09777013858', 'anika.13@gmail.com', '', NULL, '', '', '', 1517100385, 1517100407),
(3, 'Yanni', NULL, 'Sta. Maria', 1, '', '', '', NULL, '', '', '', 1517216395, 1517216395),
(4, 'Yanni', NULL, 'Joyce', 1, '', '', '', NULL, '', '', '', 1517216605, 1517216605),
(5, 'Miguel', NULL, 'Alone', 0, '09474034038', 'miguelalone@mail.com', '', NULL, '', '', '', 1517217883, 1517217883);

-- --------------------------------------------------------

--
-- Table structure for table `print_log`
--

CREATE TABLE `print_log` (
  `id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `print_type` varchar(10) NOT NULL COMMENT 'receipt or result',
  `print_status` varchar(10) NOT NULL COMMENT 'original or copy',
  `print_number` int(11) NOT NULL COMMENT 'number of print occurences',
  `user_id` int(11) NOT NULL COMMENT 'the user who printed the receipt',
  `print_date` int(11) NOT NULL COMMENT 'date when it was printed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `id` int(11) NOT NULL,
  `queue_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `created_At` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `queue_log`
--

CREATE TABLE `queue_log` (
  `id` int(11) NOT NULL,
  `queue_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'the user who created the action',
  `queue_status` varchar(10) NOT NULL COMMENT 'create / activate / remove',
  `comments_At` varchar(255) NOT NULL COMMENT 'more likely not null and required on remove',
  `created_At` int(11) NOT NULL COMMENT 'when was the action fired?'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `queue_log`
--

INSERT INTO `queue_log` (`id`, `queue_id`, `patient_id`, `user_id`, `queue_status`, `comments_At`, `created_At`) VALUES
(1, 1517215858, 1, 3, 'CREATE', 'user logged in creates a queue', 1517215858),
(2, 1517215904, 1, 3, 'CREATE', 'user logged in creates a queue', 1517215904),
(3, 1517215904, 1, 3, 'CREATE', 'user logged in creates a queue', 1517215904),
(4, 1517215905, 1, 3, 'CREATE', 'user logged in creates a queue', 1517215905),
(5, 1517217903, 5, 3, 'CREATE', 'user logged in creates a queue', 1517217903),
(6, 1517218013, 5, 3, 'CREATE', 'user logged in creates a queue', 1517218013),
(7, 1517218013, 5, 3, 'CREATE', 'user logged in creates a queue', 1517218013),
(8, 1517218890, 1, 3, 'CREATE', 'user logged in creates a queue', 1517218890),
(9, 1517222444, 1, 3, 'CREATE', 'user logged in creates a queue', 1517222444),
(10, 1517245877, 2, 3, 'CREATE', 'user logged in creates a queue', 1517245877),
(11, 1517245894, 2, 3, 'CREATE', 'user logged in creates a queue', 1517245894),
(12, 1517245965, 2, 3, 'CREATE', 'user logged in creates a queue', 1517245965),
(13, 1517245978, 2, 3, 'CREATE', 'user logged in creates a queue', 1517245978),
(14, 1517246088, 2, 3, 'CREATE', 'user logged in creates a queue', 1517246088),
(15, 1517246165, 2, 3, 'CREATE', 'user logged in creates a queue', 1517246165),
(16, 1517246192, 1, 3, 'CREATE', 'user logged in creates a queue', 1517246192),
(17, 1517246205, 1, 3, 'CREATE', 'user logged in creates a queue', 1517246205);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `test_result_name` varchar(100) NOT NULL,
  `result` varchar(100) NOT NULL,
  `gender` varchar(3) NOT NULL,
  `normal_value` varchar(100) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `trans_id`, `test_id`, `test_result_name`, `result`, `gender`, `normal_value`, `comment`) VALUES
(1, 1517215858, 44, 'FBS', '70 mg/dl', '', '70 - 110 mg/dl', ''),
(2, 1517215858, 91, 'CALCIUM', '1.00 mmol/L', '', '0.80 - 1.10 mmol/L', ''),
(3, 1517215858, 91, 'CREATININE', '1.00 mg/dl', '', '0.6 - 1.3 mg/dl', ''),
(4, 1517215858, 91, 'FBS', '75 mg/dl', '', '70 - 110 mg/dl', ''),
(5, 1517215858, 91, 'SGPT', '35 uL', '', '0 - 38 uL', ''),
(6, 1517215858, 91, 'TRIGLYCERIDES', '125 mg/dl', '', '40 - 140 mg/dl', ''),
(7, 1517215858, 91, 'URIC ACID', '8 mg/dl', '', '3 - 7 mg/dl', 'Too High'),
(8, 1517215858, 92, 'CALCIUM', '1.00 mmol/L', '', '0.80 - 1.10 mmol/L', ''),
(9, 1517215858, 92, 'CREATININE', '1.00 mg/dl', '', '0.6 - 1.3 mg/dl', ''),
(10, 1517215858, 92, 'FBS', '85 mg/dl', '', '70 - 110 mg/dl', ''),
(11, 1517215858, 92, 'PLATELET COUNT', '500 X10^9/l', '', '150 - 400 X10^9/l', 'ABN'),
(12, 1517215858, 92, 'RED BLOOD CELL COUNT', '6.5 x10^12/l', 'M', '4.5 - 6.5 x10^12/l', ''),
(13, 1517215858, 92, 'SGPT', '38 uL', '', '0 - 38 uL', ''),
(14, 1517215858, 92, 'TRIGLYCERIDES', '140 mg/dl', '', '40 - 140 mg/dl', ''),
(15, 1517215858, 92, 'URIC ACID', '7 mg/dl', '', '3 - 7 mg/dl', ''),
(16, 1517215858, 92, 'WHITE BLOOD CELL COUNT', '7.0 x10^9/l', '', '5.0 - 10.0 x10^9/l', ''),
(17, 1517217903, 44, 'FBS', '', '', '70 - 110 mg/dl', ''),
(18, 1517217903, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L', ''),
(19, 1517217903, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl', ''),
(20, 1517217903, 91, 'FBS', '', '', '70 - 110 mg/dl', ''),
(21, 1517217903, 91, 'SGPT', '', '', '0 - 38 uL', ''),
(22, 1517217903, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl', ''),
(23, 1517217903, 91, 'URIC ACID', '', '', '3 - 7 mg/dl', ''),
(24, 1517218890, 44, 'FBS', '100 mg/dl', '', '70 - 110 mg/dl', 'good'),
(25, 1517245965, 44, 'FBS', '75 mg/dl', '', '70 - 110 mg/dl', 'clear'),
(26, 1517246088, 44, 'FBS', '', '', '70 - 110 mg/dl', ''),
(27, 1517246192, 44, 'FBS', '', '', '70 - 110 mg/dl', '');

-- --------------------------------------------------------

--
-- Table structure for table `result_history`
--

CREATE TABLE `result_history` (
  `id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `test_result_name` varchar(100) NOT NULL,
  `result` varchar(100) NOT NULL,
  `gender` varchar(3) NOT NULL,
  `normal_value` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'user_id who finalize the test result (prefered to be medtech)',
  `finalize_At` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result_history`
--

INSERT INTO `result_history` (`id`, `trans_id`, `test_id`, `test_result_name`, `result`, `gender`, `normal_value`, `comment`, `user_id`, `finalize_At`) VALUES
(1, 1517218890, 44, 'FBS', '100 mg/dl', '', '70 - 110 mg/dl', 'good', 2, 1517244180),
(2, 1517215858, 44, 'FBS', '70 mg/dl', '', '70 - 110 mg/dl', '', 2, 1517245599),
(3, 1517215858, 91, 'CALCIUM', '1.00 mmol/L', '', '0.80 - 1.10 mmol/L', '', 2, 1517245599),
(4, 1517215858, 91, 'CREATININE', '1.00 mg/dl', '', '0.6 - 1.3 mg/dl', '', 2, 1517245599),
(5, 1517215858, 91, 'FBS', '75 mg/dl', '', '70 - 110 mg/dl', '', 2, 1517245599),
(6, 1517215858, 91, 'SGPT', '35 uL', '', '0 - 38 uL', '', 2, 1517245599),
(7, 1517215858, 91, 'TRIGLYCERIDES', '125 mg/dl', '', '40 - 140 mg/dl', '', 2, 1517245599),
(8, 1517215858, 91, 'URIC ACID', '8 mg/dl', '', '3 - 7 mg/dl', 'Too High', 2, 1517245599),
(9, 1517215858, 92, 'CALCIUM', '1.00 mmol/L', '', '0.80 - 1.10 mmol/L', '', 2, 1517245600),
(10, 1517215858, 92, 'CREATININE', '1.00 mg/dl', '', '0.6 - 1.3 mg/dl', '', 2, 1517245600),
(11, 1517215858, 92, 'FBS', '85 mg/dl', '', '70 - 110 mg/dl', '', 2, 1517245600),
(12, 1517215858, 92, 'PLATELET COUNT', '500 X10^9/l', '', '150 - 400 X10^9/l', 'ABN', 2, 1517245600),
(13, 1517215858, 92, 'RED BLOOD CELL COUNT', '6.5 x10^12/l', 'M', '4.5 - 6.5 x10^12/l', '', 2, 1517245600),
(14, 1517215858, 92, 'SGPT', '38 uL', '', '0 - 38 uL', '', 2, 1517245600),
(15, 1517215858, 92, 'TRIGLYCERIDES', '140 mg/dl', '', '40 - 140 mg/dl', '', 2, 1517245600),
(16, 1517215858, 92, 'URIC ACID', '7 mg/dl', '', '3 - 7 mg/dl', '', 2, 1517245600),
(17, 1517215858, 92, 'WHITE BLOOD CELL COUNT', '7.0 x10^9/l', '', '5.0 - 10.0 x10^9/l', '', 2, 1517245600),
(18, 1517217903, 44, 'FBS', '', '', '70 - 110 mg/dl', '', 2, 1517245660),
(19, 1517217903, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L', '', 2, 1517245660),
(20, 1517217903, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl', '', 2, 1517245660),
(21, 1517217903, 91, 'FBS', '', '', '70 - 110 mg/dl', '', 2, 1517245660),
(22, 1517217903, 91, 'SGPT', '', '', '0 - 38 uL', '', 2, 1517245660),
(23, 1517217903, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl', '', 2, 1517245660),
(24, 1517217903, 91, 'URIC ACID', '', '', '3 - 7 mg/dl', '', 2, 1517245660),
(25, 1517245965, 44, 'FBS', '75 mg/dl', '', '70 - 110 mg/dl', 'clear', 2, 1517246271),
(26, 1517246088, 44, 'FBS', '', '', '70 - 110 mg/dl', '', 2, 1517246323);

-- --------------------------------------------------------

--
-- Table structure for table `result_log`
--

CREATE TABLE `result_log` (
  `id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `result_updatedby` int(11) NOT NULL,
  `result_number` int(11) NOT NULL COMMENT 'how many times was it updated?',
  `result_status` varchar(10) NOT NULL COMMENT 'update / passive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `created_At` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `trans_id`, `created_At`, `amount`, `user_id`) VALUES
(1, 1517215858, 1517215907, '1700', 3),
(2, 1517217903, 1517218015, '760', 3),
(3, 1517218890, 1517222445, '80', 3),
(4, 1517245877, 1517245894, '80', 3),
(5, 1517245965, 1517245979, '80', 3),
(6, 1517246088, 1517246165, '80', 3),
(7, 1517246192, 1517246206, '80', 3);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `code` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `code`) VALUES
(1, 'Pending Queue', 100),
(2, 'Package Creation', 200),
(3, 'Receipt Generation', 300),
(4, 'Result Generation', 500);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `test_name` varchar(50) NOT NULL,
  `test_price` varchar(10) NOT NULL,
  `test_description_number` text NOT NULL,
  `test_description` text NOT NULL,
  `test_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `test_name`, `test_price`, `test_description_number`, `test_description`, `test_type_id`) VALUES
(1, 'Urinalysis', '40.00', '', '', 1),
(2, 'Fecalysis', '40.00', '', '', 1),
(3, 'Urine Bile', '50.00', '', '', 1),
(4, 'Urine Sugar', '40.00', '', '', 1),
(5, 'Urine PH', '40.00', '', '', 1),
(6, 'Occult Blood', '200.00', '', '', 1),
(7, 'Pregnancy Test', '150.00', '', '', 1),
(8, 'Albumin', '40.00', '', '', 1),
(9, 'Sperm Analysis', '250.00', '', '', 1),
(10, 'Pap''s Smear', '250.00', '', '', 1),
(11, 'CBC', '120.00', '', '', 2),
(12, 'HGB & HCT', '70.00', '', '', 2),
(13, 'WBC Count', '70.00', '', '', 2),
(14, 'Platelet Count', '100.00', '', '', 2),
(15, 'Peripheral Smear', '250.00', '', '', 2),
(16, 'Reticulocyte Count', '150.00', '', '', 2),
(17, 'ESR', '120.00', '', '', 2),
(18, 'Clotting Time', '50.00', '', '', 2),
(19, 'Bleeding Time', '50.00', '', '', 2),
(20, 'Protime(PT)', '400.00', '', '', 2),
(21, 'Prothrombin Time(PTT)', '450.00', '', '', 2),
(22, 'Blood Typing(ABO)', '80.00', '', '', 3),
(23, 'Blood Typing(RH)', '50.00', '', '', 3),
(24, 'Crossmatching', '250.00', '', '', 3),
(25, 'RPRL/VDRL', '200.00', '', '', 4),
(26, 'ASO Titer', '525.00', '', '', 4),
(27, 'RA Latex', '200.00', '', '', 4),
(28, 'CRP', '250.00', '', '', 4),
(29, 'C3', '600.00', '', '', 4),
(30, 'Dengue NS1', '1,100.00', '', '', 4),
(31, 'Widal Test', '300.00', '', '', 4),
(32, 'Malaria', '300.00', '', '', 4),
(33, 'Typhidot', '1,145.00', '', '', 4),
(34, 'PSA', '1,200.00', '', '', 5),
(35, 'CEA', '700.00', '', '', 5),
(36, 'AFP', '700.00', '', '', 5),
(37, 'Beta HCG', '700.00', '', '', 5),
(38, 'T3', '400.00', '', '', 6),
(39, 'T4', '400.00', '', '', 6),
(40, 'FT3', '450.00', '', '', 6),
(41, 'FT4', '550.00', '', '', 6),
(42, 'TSH', '550.00', '', '', 6),
(43, 'FSH', '600.00', '', '', 6),
(44, 'FBS/RBS', '80.00', '', '', 7),
(45, 'BUN', '80.00', '', '', 7),
(46, 'Creatinine', '80.00', '', '', 7),
(47, 'BUA(Uric Acid)', '80.00', '', '', 7),
(48, 'Cholesterol', '80.00', '', '', 7),
(49, 'Triglycerides', '180.00', '', '', 7),
(50, 'HDL/LDL', '300.00', '', '', 7),
(51, 'SGPT(ALT)', '180.00', '', '', 7),
(52, 'SGOT(AST)', '180.00', '', '', 7),
(53, 'HgbA1C', '550.00', '', '', 7),
(54, 'Alkaline Phosphatase', '250.00', '', '', 7),
(55, 'Acid Phosphatase', '600.00', '', '', 7),
(56, 'Sodium', '180.00', '', '', 7),
(57, 'Potassium', '180.00', '', '', 7),
(58, 'Chloride', '180.00', '', '', 7),
(59, 'Ionized Calcium', '350.00', '', '', 7),
(60, 'Total Calcium', '250.00', '', '', 7),
(61, 'Inorganic Phosphorous', '200.00', '', '', 7),
(62, 'LDH', '350.00', '', '', 7),
(63, 'TPHA', '300.00', '', '', 7),
(64, 'Total CPK with Fraction', '600.00', '', '', 7),
(65, 'Total CPK/CK', '400.00', '', '', 7),
(66, 'CKMB', '500.00', '', '', 7),
(67, 'Amylase', '300.00', '', '', 7),
(68, 'Lipase', '300.00', '', '', 7),
(69, 'Total Bilirubin - Direct Bilirubin', '300.00', '', '', 7),
(70, 'Albumin', '150.00', '', '', 7),
(71, 'TP A/G Ratio', '250.00', '', '', 7),
(72, 'Gram Stain', '150.00', '', '', 8),
(73, 'AFB Stain', '180.00', '', '', 8),
(74, 'KOH Mount', '150.00', '', '', 8),
(75, 'Stool C/S', '500.00', '', '', 8),
(76, 'Urine C/S', '500.00', '', '', 8),
(77, 'Blood C/S', '500.00', '', '', 8),
(78, 'Hepatitis B Profile', '2,000.00', '', '', 9),
(79, 'Hepatitis B Profile w/ HAV IgM', '1,800.00', '', '', 9),
(80, 'HBSAg Screening Test', '200.00', '', '', 9),
(81, 'HBSAg ELISA', '350.00', '', '', 9),
(82, 'Anti-HBS', '250.00', '', '', 9),
(83, 'HbeAg', '450.00', '', '', 9),
(84, 'Anti-Hbe', '450.00', '', '', 9),
(85, 'Anti-HBc(IgG)', '400.00', '', '', 9),
(86, 'Anti-HBc(IgM)', '400.00', '', '', 9),
(87, 'Anti-HAV(IgG)', '450.00', '', '', 9),
(88, 'Anti-HAV(IgM)', '450.00', '', '', 9),
(89, 'Anti-HCV', '750.00', '', '', 9),
(90, 'HIV', '650.00', '', '', 9),
(91, 'Package 1', '680.00', '44,49,60,47,46,51', 'FBS, TAG, TC, BUA, CREA, SGPT', 10),
(92, 'Package 2', '940.00', '44,49,60,47,46,51,11,1', 'FBS, TAG, TC, BUA, CREA, SGPT, CBC w/ PC, UA', 10),
(93, 'Package 3', '1,240.00', '', '', 10),
(94, 'Package 4', '1,600.00', '', '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `test_content`
--

CREATE TABLE `test_content` (
  `id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `trans_key` varchar(10) NOT NULL,
  `test_id` int(3) NOT NULL COMMENT 'all the test that belongs to this trans_id'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_result`
--

CREATE TABLE `test_result` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `test_result_name` varchar(50) NOT NULL COMMENT '0-M/ 1-F/ 3-All',
  `gender` int(1) NOT NULL,
  `test_result_normal_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_result`
--

INSERT INTO `test_result` (`id`, `test_id`, `test_result_name`, `gender`, `test_result_normal_value`) VALUES
(1, 44, 'FBS', 3, '70 - 110 mg/dl'),
(2, 49, 'TRIGLYCERIDES', 3, '40 - 140 mg/dl'),
(3, 60, 'CALCIUM', 3, '0.80 - 1.10 mmol/L'),
(4, 47, 'URIC ACID', 3, '3 - 7 mg/dl'),
(5, 46, 'CREATININE', 3, '0.6 - 1.3 mg/dl'),
(6, 51, 'SGPT', 3, '0 - 38 uL'),
(7, 11, 'RED BLOOD CELL COUNT', 0, '4.5 - 6.5 x10^12/l'),
(8, 11, 'RED BLOOD CELL COUNT', 1, '3.9 - 5.0 x10^12/l'),
(9, 11, 'WHITE BLOOD CELL COUNT', 3, '5.0 - 10.0 x10^9/l'),
(10, 14, 'PLATELET COUNT', 3, '150 - 400 X10^9/l'),
(11, 92, 'FBS', 3, '70 - 110 mg/dl'),
(12, 92, 'TRIGLYCERIDES', 3, '40 - 140 mg/dl'),
(13, 92, 'CALCIUM', 3, '0.80 - 1.10 mmol/L'),
(14, 92, 'URIC ACID', 3, '3 - 7 mg/dl'),
(15, 92, 'CREATININE', 3, '0.6 - 1.3 mg/dl'),
(16, 92, 'SGPT', 3, '0 - 38 uL'),
(17, 92, 'RED BLOOD CELL COUNT', 0, '4.5 - 6.5 x10^12/l'),
(18, 92, 'RED BLOOD CELL COUNT', 1, '3.9 - 5.0 x10^12/l'),
(19, 92, 'WHITE BLOOD CELL COUNT', 3, '5.0 - 10.0 x10^9/l'),
(20, 92, 'PLATELET COUNT', 3, '150 - 400 X10^9/l'),
(21, 91, 'FBS', 3, '70 - 110 mg/dl'),
(22, 91, 'TRIGLYCERIDES', 3, '40 - 140 mg/dl'),
(23, 91, 'CALCIUM', 3, '0.80 - 1.10 mmol/L'),
(24, 91, 'URIC ACID', 3, '3 - 7 mg/dl'),
(25, 91, 'CREATININE', 3, '0.6 - 1.3 mg/dl'),
(26, 91, 'SGPT', 3, '0 - 38 uL');

-- --------------------------------------------------------

--
-- Table structure for table `test_type`
--

CREATE TABLE `test_type` (
  `id` int(11) NOT NULL,
  `test_type_name` varchar(50) NOT NULL,
  `test_result_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_type`
--

INSERT INTO `test_type` (`id`, `test_type_name`, `test_result_id`) VALUES
(1, 'CLINICAL MICROSCOPY', 1),
(2, 'HEMATOLOGY', 2),
(3, 'BLOOD BLANK', 3),
(4, 'SEROLOGY', 4),
(5, 'TUMOR MARKERS', 5),
(6, 'ENDOCRINOLOGY', 6),
(7, 'CLINICAL CHEMISTRY', 7),
(8, 'MICROBIOLOGY', 8),
(9, 'IMMUNOLOGY', 9),
(10, 'CC-PACKAGE', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `account_type_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 7),
(2, 'medtech', '21232f297a57a5a743894a0e4a801fc3', 8),
(3, 'recept', '21232f297a57a5a743894a0e4a801fc3', 7),
(4, 'owner', '21232f297a57a5a743894a0e4a801fc3', 9),
(5, '5adminaccount', '5f4dcc3b5aa765d61d8327deb882cf99', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`account_type_id`);

--
-- Indexes for table `active_result`
--
ALTER TABLE `active_result`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trans_id` (`trans_id`);

--
-- Indexes for table `active_transaction`
--
ALTER TABLE `active_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `employee_id` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_history`
--
ALTER TABLE `inventory_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_prerequisite`
--
ALTER TABLE `inventory_prerequisite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_type`
--
ALTER TABLE `item_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passive_result`
--
ALTER TABLE `passive_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passive_transaction`
--
ALTER TABLE `passive_transaction`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trans_id` (`trans_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `print_log`
--
ALTER TABLE `print_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trans_id` (`trans_id`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `queue_id` (`queue_id`);

--
-- Indexes for table `queue_log`
--
ALTER TABLE `queue_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result_history`
--
ALTER TABLE `result_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result_log`
--
ALTER TABLE `result_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trans_id` (`trans_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_content`
--
ALTER TABLE `test_content`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trans_id` (`trans_id`);

--
-- Indexes for table `test_result`
--
ALTER TABLE `test_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_type`
--
ALTER TABLE `test_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `account_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `active_result`
--
ALTER TABLE `active_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `active_transaction`
--
ALTER TABLE `active_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `inventory_history`
--
ALTER TABLE `inventory_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `inventory_prerequisite`
--
ALTER TABLE `inventory_prerequisite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;
--
-- AUTO_INCREMENT for table `item_type`
--
ALTER TABLE `item_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `passive_result`
--
ALTER TABLE `passive_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `passive_transaction`
--
ALTER TABLE `passive_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `print_log`
--
ALTER TABLE `print_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `queue_log`
--
ALTER TABLE `queue_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `result_history`
--
ALTER TABLE `result_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `result_log`
--
ALTER TABLE `result_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `test_content`
--
ALTER TABLE `test_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `test_result`
--
ALTER TABLE `test_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `test_type`
--
ALTER TABLE `test_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
