-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2018 at 04:28 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

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
(23, 1513166868, 'P0R9C-D4I3', 1, 1513166879, 3, 1513166868, 91),
(24, 1513168517, 'P0R9C-D4I3', 1, 1513168525, 3, 1513168517, 44),
(25, 1513179279, 'P0R9C-D4I3', 1, 1513179404, 4, 1513179279, 91),
(26, 1513226666, 'P0R9C-D4I3', 3, 1513226763, 5, 1513226666, 92),
(28, 1513179315, 'P0R9C-D4I3', 3, 1513227133, 4, 1513179315, 44),
(29, 1513227259, 'P0R9C-D4I3', 3, 1513227297, 6, 1513227259, 91),
(30, 1513227372, 'P0R9C-D4I3', 3, 1513227581, 6, 1513227372, 44),
(31, 1513227713, 'P0R9C-D4I3', 3, 1513227736, 6, 1513227713, 44),
(32, 1513227809, 'P0R9C-D4I3', 3, 1513227829, 6, 1513227809, 44),
(33, 1513227954, 'P0R9C-D4I3', 3, 1513228221, 6, 1513227954, 44),
(34, 1513233386, 'P0R9C-D4I3', 3, 1513233488, 7, 1513233386, 91),
(35, 1513231022, 'P0R9C-D4I3', 3, 1515221336, 4, 1513231022, 91),
(36, 1515208107, 'P0R9C-D4I3', 3, 1515221364, 3, 1515208107, 91);

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
(1, 1, 'Shinichi', 'Nakahara', 'Kagari', 1512795132, 1512812820, '09777013858', 'seraH@gmail.com', 9),
(2, 2, 'Henzo', 'Lee', 'Yasakawa', 1512812820, 1512812820, '09777013858', 'henzoyasakawa@gmail.com', 8),
(3, 3, 'Rikiya', NULL, 'Mononobe', 1512794432, 1512812820, '09777013858', 'mononobe.rikiya@gmail.com', 7),
(4, 4, 'Taishi', 'Hayato', 'Kiyonori', 1512812820, 1512812820, '09777013858', 'taishi.kiyonori@gmail.com', 9);

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
(11, 'New Year Celebration!', 'Where:\nWhen:\nNOTE: Be There!', '#189142', '2018-01-03 00:00:00', '2018-01-04 00:00:00', 'true');

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
(1, 'Create', 1, 0, 0, '+0', 1512977966, 1, 1512977966, 1),
(2, 'Create', 46, 0, 0, '+0', 1512977985, 1, 1512977985, 1),
(3, 'Create', 1, 0, 0, '+0', 1513040660, 1, 1513040660, 1),
(4, 'Create', 1, 0, 0, '+0', 1513044371, 1, 1513044371, 1),
(5, 'Create', 1, 0, 0, '+0', 1513044371, 1, 1513044371, 1),
(6, 'Create', 9, 0, 0, '+0', 1513052435, 1, 1513052435, 1),
(7, 'Create', 4, 0, 0, '+0', 1513052469, 3, 1513052469, 3),
(8, 'Create', 46, 0, 0, '+0', 1513147439, 1, 1513147439, 1),
(9, 'Transaction Consumpt', 3, 20, 19, '-1', 1513163109, 1, 1513163109, 1),
(10, 'Transaction Consumpt', 3, 20, 19, '-1', 1513163333, 1, 1513163333, 1),
(11, 'Transaction Consumpt', 3, 20, 19, '-1', 1513163717, 1, 1513163717, 1),
(12, 'Transaction Consumpt', 3, 20, 19, '-1', 1513163745, 1, 1513163745, 1),
(13, 'Transaction Consumpt', 3, 20, 19, '-1', 1513163778, 1, 1513163778, 1),
(14, 'Transaction Consumpt', 3, 20, 19, '-1', 1513163806, 1, 1513163806, 1),
(15, 'Transaction Consumpt', 3, 20, 19, '-1', 1513164025, 1, 1513164025, 1),
(16, 'Transaction Consumpt', 3, 20, 19, '-1', 1513164044, 1, 1513164044, 1),
(17, 'Transaction Consumpt', 3, 20, 19, '-1', 1513164163, 1, 1513164163, 1),
(18, 'Transaction Consumpt', 3, 20, 19, '-1', 1513164287, 1, 1513164287, 1),
(19, 'Transaction Consumpt', 3, 20, 19, '-1', 1513164341, 1, 1513164341, 1),
(20, 'Transaction Consumpt', 3, 20, 19, '-1', 1513166307, 1, 1513166307, 1),
(21, 'Transaction Consumpt', 3, 20, 19, '-1', 1513166346, 1, 1513166346, 1),
(22, 'Transaction Consumpt', 3, 20, 19, '-1', 1513166402, 1, 1513166402, 1),
(23, 'Transaction Consumpt', 3, 20, 19, '-1', 1513166470, 1, 1513166470, 1),
(24, 'Transaction Consumpt', 3, 20, 19, '-1', 1513166493, 1, 1513166493, 1),
(25, 'Transaction Consumpt', 3, 20, 19, '-1', 1513166550, 1, 1513166550, 1),
(26, 'Transaction Consumpt', 3, 20, 19, '-1', 1513166756, 1, 1513166756, 1),
(27, 'Transaction Consumpt', 7, 20, 19, '-1', 1513166756, 1, 1513166756, 1),
(28, 'Transaction Consumpt', 3, 20, 19, '-1', 1513166757, 1, 1513166757, 1),
(29, 'Transaction Consumpt', 23, 20, 19, '-1', 1513166757, 1, 1513166757, 1),
(30, 'Transaction Consumpt', 11, 20, 19, '-1', 1513166757, 1, 1513166757, 1),
(31, 'Transaction Consumpt', 3, 20, 19, '-1', 1513166757, 1, 1513166757, 1),
(32, 'Transaction Consumpt', 3, 20, 19, '-1', 1513166847, 1, 1513166847, 1),
(33, 'Transaction Consumpt', 3, 20, 19, '-1', 1513166880, 1, 1513166880, 1),
(34, 'Transaction Consumpt', 7, 20, 19, '-1', 1513166880, 1, 1513166880, 1),
(35, 'Transaction Consumpt', 3, 20, 19, '-1', 1513166881, 1, 1513166881, 1),
(36, 'Transaction Consumpt', 23, 20, 19, '-1', 1513166881, 1, 1513166881, 1),
(37, 'Transaction Consumpt', 11, 20, 19, '-1', 1513166881, 1, 1513166881, 1),
(38, 'Transaction Consumpt', 3, 20, 19, '-1', 1513166881, 1, 1513166881, 1),
(39, 'Transaction Consumpt', 3, 20, 19, '-1', 1513168526, 1, 1513168526, 1),
(40, 'Transaction Consumpt', 3, 20, 19, '-1', 1513179404, 1, 1513179404, 1),
(41, 'Transaction Consumpt', 7, 20, 19, '-1', 1513179404, 1, 1513179404, 1),
(42, 'Transaction Consumpt', 3, 20, 19, '-1', 1513179404, 1, 1513179404, 1),
(43, 'Transaction Consumpt', 23, 20, 19, '-1', 1513179404, 1, 1513179404, 1),
(44, 'Transaction Consumpt', 11, 20, 19, '-1', 1513179404, 1, 1513179404, 1),
(45, 'Transaction Consumpt', 3, 20, 19, '-1', 1513179404, 1, 1513179404, 1),
(46, 'Transaction Consumpt', 3, 20, 19, '-1', 1513226765, 3, 1513226765, 3),
(47, 'Transaction Consumpt', 7, 20, 19, '-1', 1513226765, 3, 1513226765, 3),
(48, 'Transaction Consumpt', 3, 20, 19, '-1', 1513226765, 3, 1513226765, 3),
(49, 'Transaction Consumpt', 23, 20, 19, '-1', 1513226765, 3, 1513226765, 3),
(50, 'Transaction Consumpt', 11, 20, 19, '-1', 1513226765, 3, 1513226765, 3),
(51, 'Transaction Consumpt', 3, 20, 19, '-1', 1513226765, 3, 1513226765, 3),
(52, 'Transaction Consumpt', 2, 20, 19, '-1', 1513226765, 3, 1513226765, 3),
(53, 'Transaction Consumpt', 46, 5, 4, '-1', 1513226766, 3, 1513226766, 3),
(54, 'Transaction Consumpt', 44, 20, 19, '-1', 1513226766, 3, 1513226766, 3),
(55, 'Transaction Consumpt', 5, 20, 19, '-1', 1513226766, 3, 1513226766, 3),
(56, 'Transaction Consumpt', 31, 20, 19, '-1', 1513226766, 3, 1513226766, 3),
(57, 'Transaction Consumpt', 3, 20, 19, '-1', 1513226904, 3, 1513226904, 3),
(58, 'Transaction Consumpt', 7, 20, 19, '-1', 1513226904, 3, 1513226904, 3),
(59, 'Transaction Consumpt', 3, 20, 19, '-1', 1513226904, 3, 1513226904, 3),
(60, 'Transaction Consumpt', 23, 20, 19, '-1', 1513226904, 3, 1513226904, 3),
(61, 'Transaction Consumpt', 11, 20, 19, '-1', 1513226904, 3, 1513226904, 3),
(62, 'Transaction Consumpt', 3, 20, 19, '-1', 1513226905, 3, 1513226905, 3),
(63, 'Transaction Consumpt', 2, 20, 19, '-1', 1513226905, 3, 1513226905, 3),
(64, 'Transaction Consumpt', 46, 5, 4, '-1', 1513226905, 3, 1513226905, 3),
(65, 'Transaction Consumpt', 44, 20, 19, '-1', 1513226905, 3, 1513226905, 3),
(66, 'Transaction Consumpt', 5, 20, 19, '-1', 1513226905, 3, 1513226905, 3),
(67, 'Transaction Consumpt', 31, 20, 19, '-1', 1513226905, 3, 1513226905, 3),
(68, 'Transaction Consumpt', 3, 20, 19, '-1', 1513227133, 3, 1513227133, 3),
(69, 'Transaction Consumpt', 3, 20, 19, '-1', 1513227296, 3, 1513227296, 3),
(70, 'Transaction Consumpt', 7, 20, 19, '-1', 1513227296, 3, 1513227296, 3),
(71, 'Transaction Consumpt', 3, 20, 19, '-1', 1513227296, 3, 1513227296, 3),
(72, 'Transaction Consumpt', 23, 20, 19, '-1', 1513227296, 3, 1513227296, 3),
(73, 'Transaction Consumpt', 11, 20, 19, '-1', 1513227296, 3, 1513227296, 3),
(74, 'Transaction Consumpt', 3, 20, 19, '-1', 1513227297, 3, 1513227297, 3),
(75, 'Transaction Consumpt', 3, 20, 19, '-1', 1513227582, 3, 1513227582, 3),
(76, 'Transaction Consumpt', 3, 20, 19, '-1', 1513227736, 3, 1513227736, 3),
(77, 'Transaction Consumpt', 3, 20, 19, '-1', 1513227829, 3, 1513227829, 3),
(78, 'Transaction Consumpt', 3, 20, 19, '-1', 1513228221, 3, 1513228221, 3),
(79, 'Transaction Consumpt', 3, 20, 19, '-1', 1513233490, 3, 1513233490, 3),
(80, 'Transaction Consumpt', 7, 20, 19, '-1', 1513233491, 3, 1513233491, 3),
(81, 'Transaction Consumpt', 3, 20, 19, '-1', 1513233491, 3, 1513233491, 3),
(82, 'Transaction Consumpt', 23, 20, 19, '-1', 1513233491, 3, 1513233491, 3),
(83, 'Transaction Consumpt', 11, 20, 19, '-1', 1513233491, 3, 1513233491, 3),
(84, 'Transaction Consumpt', 3, 20, 19, '-1', 1513233491, 3, 1513233491, 3),
(85, 'Transaction Consumpt', 3, 20, 19, '-1', 1513233541, 3, 1513233541, 3),
(86, 'Transaction Consumpt', 7, 20, 19, '-1', 1513233541, 3, 1513233541, 3),
(87, 'Transaction Consumpt', 3, 20, 19, '-1', 1513233541, 3, 1513233541, 3),
(88, 'Transaction Consumpt', 23, 20, 19, '-1', 1513233541, 3, 1513233541, 3),
(89, 'Transaction Consumpt', 11, 20, 19, '-1', 1513233542, 3, 1513233542, 3),
(90, 'Transaction Consumpt', 3, 20, 19, '-1', 1513233542, 3, 1513233542, 3),
(91, 'Transaction Consumpt', 3, 20, 19, '-1', 1513233542, 3, 1513233542, 3),
(92, 'Transaction Consumpt', 7, 20, 19, '-1', 1513233542, 3, 1513233542, 3),
(93, 'Transaction Consumpt', 3, 20, 19, '-1', 1513233542, 3, 1513233542, 3),
(94, 'Transaction Consumpt', 23, 20, 19, '-1', 1513233542, 3, 1513233542, 3),
(95, 'Transaction Consumpt', 11, 20, 19, '-1', 1513233542, 3, 1513233542, 3),
(96, 'Transaction Consumpt', 3, 20, 19, '-1', 1513233543, 3, 1513233543, 3),
(97, 'Transaction Consumpt', 3, 20, 19, '-1', 1515221334, 3, 1515221334, 3),
(98, 'Transaction Consumpt', 7, 20, 19, '-1', 1515221334, 3, 1515221334, 3),
(99, 'Transaction Consumpt', 3, 20, 19, '-1', 1515221334, 3, 1515221334, 3),
(100, 'Transaction Consumpt', 23, 20, 19, '-1', 1515221334, 3, 1515221334, 3),
(101, 'Transaction Consumpt', 11, 20, 19, '-1', 1515221334, 3, 1515221334, 3),
(102, 'Transaction Consumpt', 3, 20, 19, '-1', 1515221334, 3, 1515221334, 3),
(103, 'Transaction Consumpt', 3, 20, 19, '-1', 1515221366, 3, 1515221366, 3),
(104, 'Transaction Consumpt', 7, 20, 19, '-1', 1515221366, 3, 1515221366, 3),
(105, 'Transaction Consumpt', 3, 20, 19, '-1', 1515221366, 3, 1515221366, 3),
(106, 'Transaction Consumpt', 23, 20, 19, '-1', 1515221366, 3, 1515221366, 3),
(107, 'Transaction Consumpt', 11, 20, 19, '-1', 1515221367, 3, 1515221367, 3),
(108, 'Transaction Consumpt', 3, 20, 19, '-1', 1515221367, 3, 1515221367, 3);

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
(1, 1, 'Blue Top', 30, 1512812820, 1513044371, 1, '100.00'),
(2, 1, 'EDTA Tubes', 20, 1512902201, 1512902201, 1, '0.00'),
(3, 1, 'Red Top Tubes', 20, 1512902284, 1512902284, 1, '0.00'),
(4, 1, 'EDTA Microtainer', 40, 1512902395, 1513052469, 3, '0.00'),
(5, 1, 'Plain Tubes', 20, 1512902528, 1512902528, 1, '0.00'),
(6, 2, 'Chole RGT', 20, 1512902590, 1512902590, 1, '0.00'),
(7, 2, 'Tag RGT', 20, 1512902598, 1512902598, 1, '0.00'),
(8, 2, 'HDL A & B Reagent', 20, 1512902598, 1512902598, 1, '0.00'),
(9, 2, 'BUN RGT', 40, 1512902598, 1513052435, 1, '0.00'),
(10, 2, 'Glucose RGT', 20, 1512902598, 1512902598, 1, '0.00'),
(11, 2, 'Creatinine', 20, 1512902598, 1512902598, 1, '0.00'),
(12, 2, 'ALY RGT', 20, 1512902598, 1512902598, 1, '0.00'),
(13, 2, 'HBA1C', 20, 1512902598, 1512902598, 1, '0.00'),
(14, 2, 'Biochem Control II', 20, 1512902598, 1512902598, 1, '0.00'),
(15, 2, 'Trutol orange 100g', 20, 1512902598, 1512902598, 1, '0.00'),
(16, 2, 'Trutol orange 75g', 20, 1512902598, 1512902598, 1, '0.00'),
(17, 2, 'Antisera A', 20, 1512902598, 1512902598, 1, '0.00'),
(18, 2, 'Antisera B', 20, 1512902598, 1512902598, 1, '0.00'),
(19, 2, 'Antisera D', 20, 1512902598, 1512902598, 1, '0.00'),
(20, 2, 'Biochem Calibrator', 20, 1512902598, 1512902598, 1, '0.00'),
(21, 2, 'ASY RGT', 20, 1512902598, 1512902598, 1, '0.00'),
(22, 2, 'Biochem Control I', 20, 1512902598, 1512902598, 1, '0.00'),
(23, 2, 'BUA RGT', 20, 1512902598, 1512902598, 1, '0.00'),
(24, 3, 'Blue TIPS', 20, 1512902598, 1512902598, 1, '0.00'),
(25, 3, 'Yellow TIPS', 20, 1512902598, 1512902598, 1, '0.00'),
(26, 4, 'RPR KIT', 20, 1512902598, 1512902598, 1, '0.00'),
(27, 4, 'HBSAG KIT', 20, 1512902598, 1512902598, 1, '0.00'),
(28, 5, 'Glucose Meter Strips', 20, 1512902598, 1512902598, 1, '0.00'),
(29, 5, 'Seal Ease Tube Sealant', 20, 1512902598, 1512902598, 1, '0.00'),
(30, 5, 'Probe Cleanser', 20, 1512902598, 1512902598, 1, '0.00'),
(31, 5, 'Glass Slides', 20, 1512902598, 1512902598, 1, '0.00'),
(32, 5, 'Pregnancy Test', 20, 1512902598, 1512902598, 1, '0.00'),
(33, 5, 'Hema Screen Occult Blood', 20, 1512902598, 1512902598, 1, '0.00'),
(34, 5, 'Micropore 3M', 20, 1512902598, 1512902598, 1, '0.00'),
(35, 5, 'Cover Slip', 20, 1512902598, 1512902598, 1, '0.00'),
(36, 5, 'Applicator Stick', 20, 1512902598, 1512902598, 1, '0.00'),
(37, 5, 'Blood Lancet', 20, 1512902598, 1512902598, 1, '0.00'),
(38, 5, 'ESR Tubes w/ AC', 20, 1512902598, 1512902598, 1, '0.00'),
(39, 5, 'Parafilm', 20, 1512902598, 1512902598, 1, '0.00'),
(40, 5, 'Tuberculin', 20, 1512902598, 1512902598, 1, '0.00'),
(41, 5, 'Syringe 3cc', 20, 1512902598, 1512902598, 1, '0.00'),
(42, 5, 'Syringe 5cc', 20, 1512902598, 1512902598, 1, '0.00'),
(43, 5, 'Urine Strips (10 para)', 20, 1512902598, 1512902598, 1, '0.00'),
(44, 5, 'Urine Strips (4 para)', 20, 1512902598, 1512902598, 1, '0.00'),
(45, 5, 'Heparinized Capillet', 20, 1512902598, 1512902598, 1, '0.00'),
(46, 5, 'Urine Cups', 5, 1512977985, 1513147439, 1, '0.00'),
(47, 0, '', 19, 0, 1513162990, 1, '0.00'),
(48, 0, '', 19, 0, 1513163108, 1, '0.00'),
(49, 0, '', 19, 0, 1513163333, 1, '0.00'),
(50, 0, '', 19, 0, 1513163717, 1, '0.00'),
(51, 0, '', 19, 0, 1513163745, 1, '0.00'),
(52, 0, '', 19, 0, 1513163778, 1, '0.00'),
(53, 0, '', 19, 0, 1513163806, 1, '0.00'),
(54, 0, '', 19, 0, 1513164025, 1, '0.00'),
(55, 0, '', 19, 0, 1513164044, 1, '0.00'),
(56, 0, '', 19, 0, 1513164163, 1, '0.00'),
(57, 0, '', 19, 0, 1513164287, 1, '0.00'),
(58, 0, '', 19, 0, 1513164341, 1, '0.00'),
(59, 0, '', 19, 0, 1513166306, 1, '0.00'),
(60, 0, '', 19, 0, 1513166346, 1, '0.00'),
(61, 0, '', 19, 0, 1513166402, 1, '0.00'),
(62, 0, '', 19, 0, 1513166470, 1, '0.00'),
(63, 0, '', 19, 0, 1513166493, 1, '0.00'),
(64, 0, '', 19, 0, 1513166550, 1, '0.00'),
(65, 0, '', 19, 0, 1513166756, 1, '0.00'),
(66, 0, '', 19, 0, 1513166756, 1, '0.00'),
(67, 0, '', 19, 0, 1513166756, 1, '0.00'),
(68, 0, '', 19, 0, 1513166757, 1, '0.00'),
(69, 0, '', 19, 0, 1513166757, 1, '0.00'),
(70, 0, '', 19, 0, 1513166757, 1, '0.00'),
(71, 0, '', 19, 0, 1513166846, 1, '0.00'),
(72, 0, '', 19, 0, 1513166880, 1, '0.00'),
(73, 0, '', 19, 0, 1513166880, 1, '0.00'),
(74, 0, '', 19, 0, 1513166881, 1, '0.00'),
(75, 0, '', 19, 0, 1513166881, 1, '0.00'),
(76, 0, '', 19, 0, 1513166881, 1, '0.00'),
(77, 0, '', 19, 0, 1513166881, 1, '0.00'),
(78, 0, '', 19, 0, 1513168525, 1, '0.00'),
(79, 0, '', 19, 0, 1513179404, 1, '0.00'),
(80, 0, '', 19, 0, 1513179404, 1, '0.00'),
(81, 0, '', 19, 0, 1513179404, 1, '0.00'),
(82, 0, '', 19, 0, 1513179404, 1, '0.00'),
(83, 0, '', 19, 0, 1513179404, 1, '0.00'),
(84, 0, '', 19, 0, 1513179404, 1, '0.00'),
(85, 0, '', 19, 0, 1513226765, 3, '0.00'),
(86, 0, '', 19, 0, 1513226765, 3, '0.00'),
(87, 0, '', 19, 0, 1513226765, 3, '0.00'),
(88, 0, '', 19, 0, 1513226765, 3, '0.00'),
(89, 0, '', 19, 0, 1513226765, 3, '0.00'),
(90, 0, '', 19, 0, 1513226765, 3, '0.00'),
(91, 0, '', 19, 0, 1513226765, 3, '0.00'),
(92, 0, '', 4, 0, 1513226765, 3, '0.00'),
(93, 0, '', 19, 0, 1513226766, 3, '0.00'),
(94, 0, '', 19, 0, 1513226766, 3, '0.00'),
(95, 0, '', 19, 0, 1513226766, 3, '0.00'),
(96, 0, '', 19, 0, 1513226904, 3, '0.00'),
(97, 0, '', 19, 0, 1513226904, 3, '0.00'),
(98, 0, '', 19, 0, 1513226904, 3, '0.00'),
(99, 0, '', 19, 0, 1513226904, 3, '0.00'),
(100, 0, '', 19, 0, 1513226904, 3, '0.00'),
(101, 0, '', 19, 0, 1513226904, 3, '0.00'),
(102, 0, '', 19, 0, 1513226905, 3, '0.00'),
(103, 0, '', 4, 0, 1513226905, 3, '0.00'),
(104, 0, '', 19, 0, 1513226905, 3, '0.00'),
(105, 0, '', 19, 0, 1513226905, 3, '0.00'),
(106, 0, '', 19, 0, 1513226905, 3, '0.00'),
(107, 0, '', 19, 0, 1513227133, 3, '0.00'),
(108, 0, '', 19, 0, 1513227296, 3, '0.00'),
(109, 0, '', 19, 0, 1513227296, 3, '0.00'),
(110, 0, '', 19, 0, 1513227296, 3, '0.00'),
(111, 0, '', 19, 0, 1513227296, 3, '0.00'),
(112, 0, '', 19, 0, 1513227296, 3, '0.00'),
(113, 0, '', 19, 0, 1513227296, 3, '0.00'),
(114, 0, '', 19, 0, 1513227581, 3, '0.00'),
(115, 0, '', 19, 0, 1513227736, 3, '0.00'),
(116, 0, '', 19, 0, 1513227829, 3, '0.00'),
(117, 0, '', 19, 0, 1513228221, 3, '0.00'),
(118, 0, '', 19, 0, 1513233490, 3, '0.00'),
(119, 0, '', 19, 0, 1513233491, 3, '0.00'),
(120, 0, '', 19, 0, 1513233491, 3, '0.00'),
(121, 0, '', 19, 0, 1513233491, 3, '0.00'),
(122, 0, '', 19, 0, 1513233491, 3, '0.00'),
(123, 0, '', 19, 0, 1513233491, 3, '0.00'),
(124, 0, '', 19, 0, 1513233541, 3, '0.00'),
(125, 0, '', 19, 0, 1513233541, 3, '0.00'),
(126, 0, '', 19, 0, 1513233541, 3, '0.00'),
(127, 0, '', 19, 0, 1513233541, 3, '0.00'),
(128, 0, '', 19, 0, 1513233541, 3, '0.00'),
(129, 0, '', 19, 0, 1513233542, 3, '0.00'),
(130, 0, '', 19, 0, 1513233542, 3, '0.00'),
(131, 0, '', 19, 0, 1513233542, 3, '0.00'),
(132, 0, '', 19, 0, 1513233542, 3, '0.00'),
(133, 0, '', 19, 0, 1513233542, 3, '0.00'),
(134, 0, '', 19, 0, 1513233542, 3, '0.00'),
(135, 0, '', 19, 0, 1513233543, 3, '0.00'),
(136, 0, '', 19, 0, 1515221334, 3, '0.00'),
(137, 0, '', 19, 0, 1515221334, 3, '0.00'),
(138, 0, '', 19, 0, 1515221334, 3, '0.00'),
(139, 0, '', 19, 0, 1515221334, 3, '0.00'),
(140, 0, '', 19, 0, 1515221334, 3, '0.00'),
(141, 0, '', 19, 0, 1515221334, 3, '0.00'),
(142, 0, '', 19, 0, 1515221366, 3, '0.00'),
(143, 0, '', 19, 0, 1515221366, 3, '0.00'),
(144, 0, '', 19, 0, 1515221366, 3, '0.00'),
(145, 0, '', 19, 0, 1515221366, 3, '0.00'),
(146, 0, '', 19, 0, 1515221367, 3, '0.00'),
(147, 0, '', 19, 0, 1515221367, 3, '0.00');

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
  `trans_id` int(11) NOT NULL,
  `result_passive_creator` int(11) NOT NULL COMMENT 'the user who put the result to passive',
  `result_passive_created_At` int(11) NOT NULL COMMENT 'unix(when was it moved to passive?)',
  `result_updatedby` int(11) NOT NULL COMMENT 'the last user (medtech) who updated the result',
  `test_result_id_and_result_value` varchar(255) NOT NULL COMMENT '1; 115 mg/dl'
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
(3, 'Mariah', NULL, 'Carey', 1, '09123123123', 'mariah@gmail.com', 'Nick', 'G', 'Lodeon', 'Ex-Husband', '09123123124', 1512803582, 1512974933),
(4, 'Styxray', NULL, 'Luntayao', 0, '09066529486', 'styxluntayao@gmail.com', 'Teresita', NULL, 'Oboza', 'Grandmother', '09168460801', 1513179261, 1513179261),
(5, 'Patricia', NULL, 'Vino', 1, '090000000000', '', 'Yanni', NULL, 'Sta. Maria', '', 'Mother', 1513226637, 1513226637),
(6, 'Dipper', NULL, 'Pines', 0, '099943043', '', 'Stanley', NULL, 'Pines', 'Grunkle', '54345543', 1513227249, 1513227249),
(7, 'Pat', NULL, 'Vino', 1, '909220', '', 'Styx', NULL, 'Luntayao', 'Brother', '012930', 1513233327, 1513233327);

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

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`id`, `queue_id`, `patient_id`, `status_id`, `created_At`) VALUES
(11, 1515221381, 3, 1, 1515221381),
(12, 1515221433, 3, 1, 1515221433),
(13, 1515221440, 3, 1, 1515221440),
(14, 1515221466, 3, 1, 1515221466),
(15, 1515221500, 3, 1, 1515221500),
(16, 1515221506, 3, 1, 1515221506),
(17, 1515221529, 3, 1, 1515221529),
(18, 1515221534, 4, 1, 1515221534),
(19, 1515221560, 3, 1, 1515221560),
(20, 1515221567, 3, 1, 1515221567),
(21, 1515221622, 3, 1, 1515221622),
(22, 1515221662, 3, 1, 1515221662),
(23, 1515221717, 3, 1, 1515221717),
(24, 1515221736, 3, 1, 1515221736),
(25, 1515221740, 7, 1, 1515221740),
(26, 1515221744, 6, 1, 1515221744),
(27, 1515221785, 3, 1, 1515221785),
(28, 1515221805, 3, 1, 1515221805),
(29, 1515221816, 7, 1, 1515221816);

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
(1, 1513148301, 3, 1, 'CREATE', 'user logged in creates a queue', 1513148301),
(2, 1513149449, 3, 1, 'CREATE', 'user logged in creates a queue', 1513149449),
(3, 1513162989, 3, 1, 'CREATE', 'user logged in creates a queue', 1513162989),
(4, 1513163108, 3, 1, 'CREATE', 'user logged in creates a queue', 1513163108),
(5, 1513163333, 3, 1, 'CREATE', 'user logged in creates a queue', 1513163333),
(6, 1513163717, 3, 1, 'CREATE', 'user logged in creates a queue', 1513163717),
(7, 1513163745, 3, 1, 'CREATE', 'user logged in creates a queue', 1513163745),
(8, 1513163778, 3, 1, 'CREATE', 'user logged in creates a queue', 1513163778),
(9, 1513163806, 3, 1, 'CREATE', 'user logged in creates a queue', 1513163806),
(10, 1513164025, 3, 1, 'CREATE', 'user logged in creates a queue', 1513164025),
(11, 1513164043, 3, 1, 'CREATE', 'user logged in creates a queue', 1513164043),
(12, 1513164163, 3, 1, 'CREATE', 'user logged in creates a queue', 1513164163),
(13, 1513164287, 3, 1, 'CREATE', 'user logged in creates a queue', 1513164287),
(14, 1513164341, 3, 1, 'CREATE', 'user logged in creates a queue', 1513164341),
(15, 1513166306, 3, 1, 'CREATE', 'user logged in creates a queue', 1513166306),
(16, 1513166346, 3, 1, 'CREATE', 'user logged in creates a queue', 1513166346),
(17, 1513166402, 3, 1, 'CREATE', 'user logged in creates a queue', 1513166402),
(18, 1513166469, 3, 1, 'CREATE', 'user logged in creates a queue', 1513166469),
(19, 1513166493, 3, 1, 'CREATE', 'user logged in creates a queue', 1513166493),
(20, 1513166550, 3, 1, 'CREATE', 'user logged in creates a queue', 1513166550),
(21, 1513166743, 3, 1, 'CREATE', 'user logged in creates a queue', 1513166743),
(22, 1513166756, 3, 1, 'CREATE', 'user logged in creates a queue', 1513166756),
(23, 1513166846, 3, 1, 'CREATE', 'user logged in creates a queue', 1513166846),
(24, 1513166868, 3, 1, 'CREATE', 'user logged in creates a queue', 1513166868),
(25, 1513166879, 3, 1, 'CREATE', 'user logged in creates a queue', 1513166879),
(26, 1513168517, 3, 1, 'CREATE', 'user logged in creates a queue', 1513168517),
(27, 1513168525, 3, 1, 'CREATE', 'user logged in creates a queue', 1513168525),
(28, 1513179280, 4, 1, 'CREATE', 'user logged in creates a queue', 1513179280),
(29, 1513179315, 4, 1, 'CREATE', 'user logged in creates a queue', 1513179315),
(30, 1513179403, 4, 1, 'CREATE', 'user logged in creates a queue', 1513179403),
(31, 1513226666, 5, 3, 'CREATE', 'user logged in creates a queue', 1513226666),
(32, 1513226764, 5, 3, 'CREATE', 'user logged in creates a queue', 1513226764),
(33, 1513226903, 5, 3, 'CREATE', 'user logged in creates a queue', 1513226903),
(34, 1513227132, 4, 3, 'CREATE', 'user logged in creates a queue', 1513227132),
(35, 1513227259, 6, 3, 'CREATE', 'user logged in creates a queue', 1513227259),
(36, 1513227296, 6, 3, 'CREATE', 'user logged in creates a queue', 1513227296),
(37, 1513227372, 6, 3, 'CREATE', 'user logged in creates a queue', 1513227372),
(38, 1513227582, 6, 3, 'CREATE', 'user logged in creates a queue', 1513227582),
(39, 1513227713, 6, 3, 'CREATE', 'user logged in creates a queue', 1513227713),
(40, 1513227736, 6, 3, 'CREATE', 'user logged in creates a queue', 1513227736),
(41, 1513227809, 6, 3, 'CREATE', 'user logged in creates a queue', 1513227809),
(42, 1513227828, 6, 3, 'CREATE', 'user logged in creates a queue', 1513227828),
(43, 1513227954, 6, 3, 'CREATE', 'user logged in creates a queue', 1513227954),
(44, 1513228221, 6, 3, 'CREATE', 'user logged in creates a queue', 1513228221),
(45, 1513231022, 4, 3, 'CREATE', 'user logged in creates a queue', 1513231022),
(46, 1513233386, 7, 3, 'CREATE', 'user logged in creates a queue', 1513233386),
(47, 1513233489, 7, 3, 'CREATE', 'user logged in creates a queue', 1513233489),
(48, 1513233539, 7, 3, 'CREATE', 'user logged in creates a queue', 1513233539),
(49, 1513233542, 7, 3, 'CREATE', 'user logged in creates a queue', 1513233542),
(50, 1515208107, 3, 3, 'CREATE', 'user logged in creates a queue', 1515208107),
(51, 1515221336, 4, 3, 'CREATE', 'user logged in creates a queue', 1515221336),
(52, 1515221364, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221364),
(53, 1515221381, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221381),
(54, 1515221433, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221433),
(55, 1515221440, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221440),
(56, 1515221466, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221466),
(57, 1515221500, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221500),
(58, 1515221506, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221506),
(59, 1515221529, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221529),
(60, 1515221534, 4, 3, 'CREATE', 'user logged in creates a queue', 1515221534),
(61, 1515221560, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221560),
(62, 1515221567, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221567),
(63, 1515221622, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221622),
(64, 1515221662, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221662),
(65, 1515221717, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221717),
(66, 1515221736, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221736),
(67, 1515221740, 7, 3, 'CREATE', 'user logged in creates a queue', 1515221740),
(68, 1515221744, 6, 3, 'CREATE', 'user logged in creates a queue', 1515221744),
(69, 1515221785, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221785),
(70, 1515221805, 3, 3, 'CREATE', 'user logged in creates a queue', 1515221805),
(71, 1515221816, 7, 3, 'CREATE', 'user logged in creates a queue', 1515221816);

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
  `normal_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `trans_id`, `test_id`, `test_result_name`, `result`, `gender`, `normal_value`) VALUES
(9, 1513166868, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(10, 1513166868, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(11, 1513166868, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(12, 1513166868, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(13, 1513166868, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(14, 1513166868, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(15, 1513166868, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(16, 1513166868, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(17, 1513166868, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(18, 1513166868, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(19, 1513166868, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(20, 1513166868, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(21, 1513168517, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(22, 1513179279, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(23, 1513179279, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(24, 1513179279, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(25, 1513179279, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(26, 1513179279, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(27, 1513179279, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(28, 1513226666, 92, 'FBS', '', '', '70 - 110 mg/dl'),
(29, 1513226666, 92, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(30, 1513226666, 92, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(31, 1513226666, 92, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(32, 1513226666, 92, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(33, 1513226666, 92, 'SGPT', '', '', '0 - 38 uL'),
(34, 1513226666, 92, 'RED BLOOD CELL COUNT', '', 'M', '4.5 - 6.5 x10^12/l'),
(35, 1513226666, 92, 'RED BLOOD CELL COUNT', '', 'F', '3.9 - 5.0 x10^12/l'),
(36, 1513226666, 92, 'WHITE BLOOD CELL COUNT', '', '', '5.0 - 10.0 x10^9/l'),
(37, 1513226666, 92, 'PLATELET COUNT', '', '', '150 - 400 X10^9/l'),
(38, 1513226666, 92, 'FBS', '', '', '70 - 110 mg/dl'),
(39, 1513226666, 92, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(40, 1513226666, 92, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(41, 1513226666, 92, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(42, 1513226666, 92, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(43, 1513226666, 92, 'SGPT', '', '', '0 - 38 uL'),
(44, 1513226666, 92, 'RED BLOOD CELL COUNT', '', 'M', '4.5 - 6.5 x10^12/l'),
(45, 1513226666, 92, 'RED BLOOD CELL COUNT', '', 'F', '3.9 - 5.0 x10^12/l'),
(46, 1513226666, 92, 'WHITE BLOOD CELL COUNT', '', '', '5.0 - 10.0 x10^9/l'),
(47, 1513226666, 92, 'PLATELET COUNT', '', '', '150 - 400 X10^9/l'),
(48, 1513179315, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(49, 1513227259, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(50, 1513227259, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(51, 1513227259, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(52, 1513227259, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(53, 1513227259, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(54, 1513227259, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(55, 1513227259, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(56, 1513227259, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(57, 1513227259, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(58, 1513227259, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(59, 1513227259, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(60, 1513227259, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(61, 1513227372, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(62, 1513227372, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(63, 1513227372, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(64, 1513227713, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(65, 1513227713, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(66, 1513227713, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(67, 1513227713, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(68, 1513227809, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(69, 1513227809, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(70, 1513227809, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(71, 1513227809, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(72, 1513227809, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(73, 1513227954, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(74, 1513227954, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(75, 1513227954, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(76, 1513227954, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(77, 1513227954, 44, 'FBS', '', '', '70 - 110 mg/dl'),
(78, 1513233386, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(79, 1513233386, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(80, 1513233386, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(81, 1513233386, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(82, 1513233386, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(83, 1513233386, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(84, 1513233386, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(85, 1513233386, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(86, 1513233386, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(87, 1513233386, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(88, 1513233386, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(89, 1513233386, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(90, 1513233386, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(91, 1513233386, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(92, 1513233386, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(93, 1513233386, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(94, 1513233386, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(95, 1513233386, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(96, 1513233386, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(97, 1513233386, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(98, 1513233386, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(99, 1513233386, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(100, 1513233386, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(101, 1513233386, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(102, 1513233386, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(103, 1513233386, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(104, 1513233386, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(105, 1513233386, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(106, 1513233386, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(107, 1513233386, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(108, 1513233386, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(109, 1513233386, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(110, 1513233386, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(111, 1513233386, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(112, 1513233386, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(113, 1513233386, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(114, 1513233386, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(115, 1513233386, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(116, 1513233386, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(117, 1513233386, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(118, 1513233386, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(119, 1513233386, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(120, 1513233386, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(121, 1513233386, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(122, 1513233386, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(123, 1513233386, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(124, 1513233386, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(125, 1513233386, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(126, 1513233386, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(127, 1513233386, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(128, 1513233386, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(129, 1513233386, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(130, 1513233386, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(131, 1513233386, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(132, 1513233386, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(133, 1513233386, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(134, 1513233386, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(135, 1513233386, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(136, 1513233386, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(137, 1513233386, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(138, 1513233386, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(139, 1513233386, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(140, 1513233386, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(141, 1513233386, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(142, 1513233386, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(143, 1513233386, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(144, 1513233386, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(145, 1513233386, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(146, 1513233386, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(147, 1513233386, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(148, 1513233386, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(149, 1513233386, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(150, 1513231022, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(151, 1513231022, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(152, 1513231022, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(153, 1513231022, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(154, 1513231022, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(155, 1513231022, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(156, 1513231022, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(157, 1513231022, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(158, 1513231022, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(159, 1513231022, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(160, 1513231022, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(161, 1513231022, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(162, 1513231022, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(163, 1513231022, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(164, 1513231022, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(165, 1513231022, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(166, 1513231022, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(167, 1513231022, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(168, 1513231022, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(169, 1513231022, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(170, 1513231022, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(171, 1513231022, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(172, 1513231022, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(173, 1513231022, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(174, 1515208107, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(175, 1515208107, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(176, 1515208107, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(177, 1515208107, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(178, 1515208107, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(179, 1515208107, 91, 'FBS', '', '', '70 - 110 mg/dl'),
(180, 1515208107, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(181, 1515208107, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(182, 1515208107, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(183, 1515208107, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(184, 1515208107, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(185, 1515208107, 91, 'TRIGLYCERIDES', '', '', '40 - 140 mg/dl'),
(186, 1515208107, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(187, 1515208107, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(188, 1515208107, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(189, 1515208107, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(190, 1515208107, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(191, 1515208107, 91, 'CALCIUM', '', '', '0.80 - 1.10 mmol/L'),
(192, 1515208107, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(193, 1515208107, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(194, 1515208107, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(195, 1515208107, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(196, 1515208107, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(197, 1515208107, 91, 'URIC ACID', '', '', '3 - 7 mg/dl'),
(198, 1515208107, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(199, 1515208107, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(200, 1515208107, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(201, 1515208107, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(202, 1515208107, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(203, 1515208107, 91, 'CREATININE', '', '', '0.6 - 1.3 mg/dl'),
(204, 1515208107, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(205, 1515208107, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(206, 1515208107, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(207, 1515208107, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(208, 1515208107, 91, 'SGPT', '', 'M', '0 - 38 uL'),
(209, 1515208107, 91, 'SGPT', '', 'M', '0 - 38 uL');

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
  `created_At` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `created_At`, `amount`, `user_id`) VALUES
(1, 1513162990, '8', 1),
(2, 1513163109, '8', 1),
(3, 1513163333, '8', 1),
(4, 1513163717, '8', 1),
(5, 1513163745, '8', 1),
(6, 1513163778, '8', 1),
(7, 1513163806, '8', 1),
(8, 1513164025, '8', 1),
(9, 1513164044, '8', 1),
(10, 1513164163, '8', 1),
(11, 1513164287, '8', 1),
(12, 1513164341, '8', 1),
(13, 1513166306, '8', 1),
(14, 1513166346, '8', 1),
(15, 1513166402, '8', 1),
(16, 1513166469, '8', 1),
(17, 1513166492, '8', 1),
(18, 1513166550, '8', 1),
(19, 1513166757, '6', 1),
(20, 1513166847, '8', 1),
(21, 1513166880, '6', 1),
(22, 1513168525, '8', 1),
(23, 1513179404, '6', 1),
(24, 1513226766, '9', 3),
(25, 1513226903, '9', 3),
(26, 1513227133, '8', 3),
(27, 1513227297, '6', 3),
(28, 1513227582, '8', 3),
(29, 1513227736, '8', 3),
(30, 1513227829, '8', 3),
(31, 1513228221, '8', 3),
(32, 1513233489, '6', 3),
(33, 1513233539, '6', 3),
(34, 1513233542, '6', 3),
(35, 1515221334, '6', 3),
(36, 1515221364, '6', 3);

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
(94, 'Package 4', '1,600.00', '', '', 10),
(95, 'Others', '', 'Others', '', 0);

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
(26, 91, 'SGPT', 0, '0 - 38 uL');

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
(2, 'medtech', 'da2550f00907e1601628524200439e35', 8),
(3, 'recept', '21232f297a57a5a743894a0e4a801fc3', 7),
(4, 'owner', '72122ce96bfec66e2396d2e25225d70a', 9);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trans_id` (`trans_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trans_id` (`trans_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `inventory_history`
--
ALTER TABLE `inventory_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT for table `inventory_prerequisite`
--
ALTER TABLE `inventory_prerequisite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;
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
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `print_log`
--
ALTER TABLE `print_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `queue_log`
--
ALTER TABLE `queue_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;
--
-- AUTO_INCREMENT for table `result_log`
--
ALTER TABLE `result_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
