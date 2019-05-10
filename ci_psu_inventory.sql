-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2019 at 07:54 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_psu_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_no` int(11) NOT NULL,
  `cat_name` varchar(20) NOT NULL,
  `cat_encode` int(11) NOT NULL DEFAULT '0',
  `cat_encode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cat_inactive` int(11) NOT NULL DEFAULT '0',
  `cat_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_no`, `cat_name`, `cat_encode`, `cat_encode_date`, `cat_inactive`, `cat_delete`) VALUES
(1, 'Sample category1', 0, '2019-04-06 23:44:24', 0, 1),
(2, 'another shot2', 0, '2019-04-06 23:45:04', 0, 0),
(3, 'new cat', 0, '2019-04-06 23:56:01', 0, 0),
(4, 'new', 0, '2019-04-06 23:56:11', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `depart_no` int(11) NOT NULL,
  `depart_code` varchar(50) NOT NULL,
  `depart_title` varchar(100) NOT NULL,
  `depart_encode` int(11) NOT NULL DEFAULT '0',
  `depart_encode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `depart_inactive` int(11) NOT NULL DEFAULT '0',
  `depart_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`depart_no`, `depart_code`, `depart_title`, `depart_encode`, `depart_encode_date`, `depart_inactive`, `depart_delete`) VALUES
(1, 'VERITATIS1', 'Triston Pfannerstill', 0, '2019-04-06 18:39:01', 0, 0),
(2, 'ESTasd', 'Mrs. Lilla Wyman', 0, '2019-04-06 18:39:01', 0, 0),
(3, 'DOLORUM', 'Mrs. Graciela Hermann Jr.', 0, '2019-04-06 18:39:01', 0, 0),
(4, 'ODIT1111', 'Cordia Goldner DVM', 0, '2019-04-06 18:39:01', 0, 0),
(5, 'DOLORIBUS', 'Doris Larkin', 0, '2019-04-06 18:39:01', 0, 0),
(6, 'PERFERENDI', 'Prof. Boyd Daniel', 0, '2019-04-06 18:39:01', 0, 0),
(7, 'AUT', 'Levi Huel III', 0, '2019-04-06 18:39:01', 0, 0),
(8, 'DEBITIS', 'Kaleb Hagenes', 0, '2019-04-06 18:39:01', 0, 0),
(9, 'QUI', 'Anabel Denesik I', 0, '2019-04-06 18:39:01', 0, 0),
(10, 'ET', 'Marcia Walsh', 0, '2019-04-06 18:39:01', 0, 0),
(11, 'OCCAECATI', 'Demetrius Connelly', 0, '2019-04-06 18:39:01', 0, 0),
(12, 'MAXIME', 'Lulu Thompson', 0, '2019-04-06 18:39:01', 0, 0),
(13, 'MOLESTIAE', 'Darby Wiegand DVM', 0, '2019-04-06 18:39:01', 0, 0),
(14, 'MAGNI', 'Macy Osinski', 0, '2019-04-06 18:39:01', 0, 0),
(15, 'QUIA', 'Dr. Electa Roberts MD', 0, '2019-04-06 18:39:01', 0, 0),
(16, 'CULPA', 'Jaron Gerlach III', 0, '2019-04-06 18:39:01', 0, 0),
(17, 'HIC', 'Elda Buckridge', 0, '2019-04-06 18:39:01', 0, 0),
(18, 'NISI', 'Dr. Keaton O\'Kon V', 0, '2019-04-06 18:39:01', 0, 0),
(19, 'SED', 'Ms. Freida Wolff', 0, '2019-04-06 18:39:01', 0, 0),
(20, 'NOSTRUM', 'Destiney Bednar', 0, '2019-04-06 18:39:01', 0, 0),
(21, 'UT', 'Amya Smith', 0, '2019-04-06 18:39:01', 0, 0),
(22, 'FACILIS', 'Stephon Dickinson', 0, '2019-04-06 18:39:01', 0, 0),
(23, 'SOLUTA', 'Scottie Walter', 0, '2019-04-06 18:39:01', 0, 0),
(24, 'CONSECTETU', 'Jordi Marquardt', 0, '2019-04-06 18:39:01', 0, 0),
(25, 'QUAM', 'Mya Stehr', 0, '2019-04-06 18:39:01', 0, 0),
(26, 'SITE', 'School of Information Tec', 0, '2019-04-06 23:55:06', 0, 1),
(27, 'SOE', 'School of Engineering', 2, '2019-04-07 15:49:08', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employments`
--

CREATE TABLE `employments` (
  `employ_no` int(11) NOT NULL,
  `depart_no` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `employ_start` date NOT NULL,
  `employ_end` date DEFAULT NULL,
  `employ_rate` double NOT NULL,
  `tenure_no` int(11) NOT NULL DEFAULT '0',
  `employ_encode` int(11) NOT NULL DEFAULT '0',
  `employ_encode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employ_inactive` int(11) NOT NULL DEFAULT '0',
  `employ_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employments`
--

INSERT INTO `employments` (`employ_no`, `depart_no`, `user_no`, `employ_start`, `employ_end`, `employ_rate`, `tenure_no`, `employ_encode`, `employ_encode_date`, `employ_inactive`, `employ_delete`) VALUES
(1, 16, 1, '2016-01-01', NULL, 175, 0, 0, '2019-04-06 20:37:41', 0, 0),
(2, 5, 2, '1990-11-13', '2004-06-19', 370, 0, 0, '2019-04-06 20:37:41', 0, 0),
(3, 23, 3, '1988-04-04', '1990-01-30', 206, 0, 0, '2019-04-06 20:37:41', 0, 0),
(4, 11, 4, '1980-04-26', '1988-04-28', 218, 0, 0, '2019-04-06 20:37:41', 0, 0),
(5, 19, 5, '2012-06-06', '2002-11-08', 256, 0, 0, '2019-04-06 20:37:42', 0, 0),
(6, 23, 6, '1973-10-28', '2009-09-19', 354, 0, 0, '2019-04-06 20:37:42', 0, 0),
(7, 13, 7, '1997-09-15', '1979-05-23', 137, 0, 0, '2019-04-06 20:37:42', 0, 0),
(8, 10, 8, '2000-06-05', '1999-03-02', 372, 0, 0, '2019-04-06 20:37:42', 0, 0),
(9, 11, 9, '2005-02-23', '1974-04-08', 213, 0, 0, '2019-04-06 20:37:42', 0, 0),
(10, 22, 10, '1981-03-15', '1976-03-17', 329, 0, 0, '2019-04-06 20:37:42', 0, 0),
(11, 4, 11, '1993-09-05', '1991-08-06', 105, 0, 0, '2019-04-06 20:37:42', 0, 0),
(12, 2, 12, '2002-03-25', '1982-09-10', 308, 0, 0, '2019-04-06 20:37:42', 0, 0),
(13, 24, 13, '2015-04-15', '1973-08-01', 237, 0, 0, '2019-04-06 20:37:43', 0, 0),
(14, 7, 14, '2005-02-08', '1973-09-19', 167, 0, 0, '2019-04-06 20:37:43', 0, 0),
(15, 4, 15, '1999-12-17', '1975-03-13', 365, 0, 0, '2019-04-06 20:37:43', 0, 0),
(16, 21, 16, '1976-02-10', '1976-12-21', 188, 0, 0, '2019-04-06 20:37:43', 0, 0),
(17, 9, 17, '1976-08-02', '2004-05-08', 315, 0, 0, '2019-04-06 20:37:43', 0, 0),
(18, 24, 18, '1982-06-09', '2014-06-27', 98, 0, 0, '2019-04-06 20:37:43', 0, 0),
(19, 13, 19, '1982-10-12', '1994-06-12', 254, 0, 0, '2019-04-06 20:37:43', 0, 0),
(20, 25, 20, '2018-03-16', '2005-11-01', 366, 0, 0, '2019-04-06 20:37:43', 0, 0),
(21, 9, 21, '2010-05-06', '2008-10-03', 146, 0, 0, '2019-04-06 20:37:43', 0, 0),
(22, 22, 22, '1980-12-16', '2017-11-13', 383, 0, 0, '2019-04-06 20:37:43', 0, 0),
(23, 8, 23, '2003-05-10', '2001-02-15', 98, 0, 0, '2019-04-06 20:37:44', 0, 0),
(24, 23, 24, '2011-06-14', '1988-08-20', 137, 0, 0, '2019-04-06 20:37:44', 0, 0),
(25, 19, 25, '1970-01-18', '2013-11-18', 292, 0, 0, '2019-04-06 20:37:44', 0, 0),
(26, 12, 26, '2015-07-06', NULL, 125, 0, 0, '2019-04-06 21:48:44', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invent_no` int(11) NOT NULL,
  `pro_no` int(11) NOT NULL,
  `invent_quantity` int(11) NOT NULL,
  `invent_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sup_no` int(11) NOT NULL DEFAULT '0',
  `invent_refno` varchar(50) DEFAULT NULL,
  `invent_encode` int(11) NOT NULL DEFAULT '0',
  `invent_encode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invent_inactive` int(11) NOT NULL DEFAULT '0',
  `invent_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invent_no`, `pro_no`, `invent_quantity`, `invent_date`, `sup_no`, `invent_refno`, `invent_encode`, `invent_encode_date`, `invent_inactive`, `invent_delete`) VALUES
(1, 1, 100, '2019-04-01 00:00:00', 10, '12345', 2, '2019-04-13 12:31:29', 0, 0),
(2, 1, 1000, '2019-04-08 00:00:00', 1, '21314', 2, '2019-04-13 14:16:49', 0, 0),
(3, 3, 100, '2019-04-01 00:00:00', 1, '123123123', 2, '2019-04-13 14:26:40', 0, 0),
(4, 5, 5, '2019-04-09 00:00:00', 10, '00223118-45244', 2, '2019-04-13 14:27:51', 0, 0),
(5, 6, 20, '2019-04-12 00:00:00', 1, '231231', 2, '2019-04-13 14:30:03', 0, 0),
(6, 5, 1, '2019-04-13 00:00:00', 1, '111111', 2, '2019-04-13 15:08:07', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_no` int(11) NOT NULL,
  `cat_no` int(11) NOT NULL,
  `unit_no` int(11) NOT NULL,
  `pro_code` varchar(20) NOT NULL,
  `pro_title` varchar(30) NOT NULL,
  `pro_price` decimal(10,2) NOT NULL,
  `pro_encode` int(11) NOT NULL DEFAULT '0',
  `pro_encode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pro_inactive` int(11) NOT NULL DEFAULT '0',
  `pro_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_no`, `cat_no`, `unit_no`, `pro_code`, `pro_title`, `pro_price`, `pro_encode`, `pro_encode_date`, `pro_inactive`, `pro_delete`) VALUES
(1, 3, 4, 'COKEs', 'COCA COLA', '40.00', 0, '2019-04-07 00:28:21', 0, 0),
(2, 2, 3, 'NO', 'another product', '0.00', 0, '2019-04-07 00:34:37', 0, 1),
(3, 2, 3, 'NOS', 'Nostril', '200.00', 0, '2019-04-07 00:36:01', 0, 0),
(4, 2, 4, 'NEO', 'neozep', '500.00', 0, '2019-04-07 00:39:59', 0, 0),
(5, 3, 5, 'QWEASD', 'One Copy', '500.00', 2, '2019-04-13 14:27:26', 0, 0),
(6, 2, 3, 'SPSWE', 'Coca Cola', '7.00', 2, '2019-04-13 14:29:34', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `release_inventory`
--

CREATE TABLE `release_inventory` (
  `release_no` int(11) NOT NULL,
  `pro_no` int(11) NOT NULL,
  `release_quantity` int(11) NOT NULL,
  `release_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `release_remark` text NOT NULL,
  `release_status` varchar(50) NOT NULL DEFAULT 'Waiting',
  `release_encode` int(11) NOT NULL DEFAULT '0',
  `release_encode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `release_inactive` int(11) NOT NULL DEFAULT '0',
  `release_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `release_inventory`
--

INSERT INTO `release_inventory` (`release_no`, `pro_no`, `release_quantity`, `release_date`, `release_remark`, `release_status`, `release_encode`, `release_encode_date`, `release_inactive`, `release_delete`) VALUES
(1, 1, 99, '2019-04-13 00:00:00', 'Release for today', 'Release', 2, '2019-04-13 17:29:11', 0, 0),
(2, 1, 10, '2019-04-13 00:00:00', 'To be release on', 'Waiting', 2, '2019-04-13 19:01:07', 0, 0),
(3, 5, 1, '2019-04-13 00:00:00', 'wew', 'Waiting', 2, '2019-04-13 19:12:41', 0, 0),
(4, 1, 1, '2019-04-19 00:00:00', 'Release', 'Release', 4, '2019-04-19 16:55:24', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_no` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `depart_no` int(11) NOT NULL,
  `request_code` varchar(20) DEFAULT NULL,
  `request_purpose` text NOT NULL,
  `request_encode` int(11) NOT NULL DEFAULT '0',
  `request_encode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `request_inactive` int(11) NOT NULL DEFAULT '0',
  `request_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_no`, `user_no`, `depart_no`, `request_code`, `request_purpose`, `request_encode`, `request_encode_date`, `request_inactive`, `request_delete`) VALUES
(14, 2, 5, 'OIU', 'Something ', 2, '2019-04-11 17:46:27', 0, 0),
(15, 3, 23, 'QWE', 'it was on purpose', 3, '2019-04-19 14:53:22', 0, 0),
(16, 6, 23, 'ASD', 'my purpose', 6, '2019-04-19 14:55:08', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `request_items`
--

CREATE TABLE `request_items` (
  `ri_no` int(11) NOT NULL,
  `request_no` int(11) NOT NULL,
  `pro_no` int(11) NOT NULL,
  `ri_quantity` int(11) NOT NULL,
  `ri_remark` int(11) DEFAULT NULL,
  `ri_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `ri_encode` int(11) NOT NULL DEFAULT '0',
  `ri_encode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ri_inactive` int(11) NOT NULL DEFAULT '0',
  `ri_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_items`
--

INSERT INTO `request_items` (`ri_no`, `request_no`, `pro_no`, `ri_quantity`, `ri_remark`, `ri_status`, `ri_encode`, `ri_encode_date`, `ri_inactive`, `ri_delete`) VALUES
(28, 14, 1, 2, NULL, 'Pending', 2, '2019-04-11 17:46:28', 0, 1),
(29, 14, 4, 2, NULL, 'Pending', 2, '2019-04-11 17:46:28', 0, 1),
(30, 14, 1, 2, NULL, 'Pending', 2, '2019-04-11 18:00:52', 0, 1),
(31, 14, 4, 1, NULL, 'Pending', 2, '2019-04-11 18:00:52', 0, 1),
(32, 14, 1, 1, NULL, 'Approved', 2, '2019-04-11 18:42:21', 0, 0),
(33, 14, 4, 1, NULL, 'Denied', 2, '2019-04-11 18:42:21', 0, 0),
(34, 15, 5, 3, NULL, 'Pending', 3, '2019-04-19 14:53:22', 0, 0),
(38, 16, 1, 1, NULL, 'Denied', 6, '2019-04-19 14:56:09', 0, 0),
(39, 16, 4, 1, NULL, 'Pending', 6, '2019-04-19 14:56:09', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_code` varchar(20) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_encode` int(11) NOT NULL DEFAULT '0',
  `role_encode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_inactive` int(11) NOT NULL DEFAULT '0',
  `role_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_code`, `role_name`, `role_encode`, `role_encode_date`, `role_inactive`, `role_delete`) VALUES
(1, 'ADM', 'Administrative Officer', 0, '2019-04-07 18:22:20', 0, 0),
(2, 'SO', 'Supply Officer', 0, '2019-04-07 18:22:20', 0, 0),
(3, 'SS', 'Supply Staff', 0, '2019-04-07 18:22:44', 0, 0),
(4, 'EMP', 'Employees', 0, '2019-04-07 18:22:44', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `sup_no` int(11) NOT NULL,
  `sup_name` varchar(100) NOT NULL,
  `sup_encode` int(11) NOT NULL DEFAULT '0',
  `sup_encode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sup_inactive` int(11) NOT NULL DEFAULT '0',
  `sup_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplies`
--

INSERT INTO `supplies` (`sup_no`, `sup_name`, `sup_encode`, `sup_encode_date`, `sup_inactive`, `sup_delete`) VALUES
(1, 'Alibaba', 2, '2019-04-11 19:02:50', 0, 0),
(10, 'Lazada', 2, '2019-04-11 19:42:47', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_no` int(11) NOT NULL,
  `unit_name` varchar(30) NOT NULL,
  `unit_encode` int(11) NOT NULL DEFAULT '0',
  `unit_encode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unit_inactive` int(11) NOT NULL DEFAULT '0',
  `unit_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_no`, `unit_name`, `unit_encode`, `unit_encode_date`, `unit_inactive`, `unit_delete`) VALUES
(1, 'pieces', 0, '2019-04-06 23:06:27', 0, 1),
(2, 'Gallon', 0, '2019-04-06 23:17:16', 0, 1),
(3, 'Bottle', 0, '2019-04-06 23:27:11', 0, 0),
(4, 'Box', 0, '2019-04-06 23:27:16', 0, 0),
(5, 'Rim', 0, '2019-04-06 23:27:23', 0, 0),
(6, 'Piece', 0, '2019-04-06 23:55:38', 0, 0),
(7, 'qweasd', 0, '2019-04-06 23:55:50', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_no` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_mname` varchar(50) NOT NULL,
  `user_inactive` int(11) NOT NULL DEFAULT '0',
  `user_delete` int(11) NOT NULL DEFAULT '0',
  `user_encode` int(11) NOT NULL DEFAULT '0',
  `user_encode_delete` datetime DEFAULT NULL,
  `user_encode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_no`, `user_id`, `user_lname`, `user_fname`, `user_mname`, `user_inactive`, `user_delete`, `user_encode`, `user_encode_delete`, `user_encode_date`) VALUES
(1, '179722', 'Ernser', 'Shaniya', 'Trantowville', 0, 0, 0, '2019-04-06 02:09:48', '2019-04-05 12:03:36'),
(2, '4935', 'Morissette', 'Felicity', 'East Catalinaland', 0, 0, 0, NULL, '2019-04-05 12:03:36'),
(3, '1797', 'Ernser', 'Shaniya', 'Trantowville', 0, 0, 0, NULL, '2019-04-05 12:03:36'),
(4, '90846191', 'Mante', 'Amya', 'Clairstad', 0, 0, 0, NULL, '2019-04-05 12:03:36'),
(5, '123456', 'Brad', 'Clair', 'Holly', 0, 0, 0, NULL, '2019-04-05 12:03:36'),
(6, '1433610', 'Daniel', 'Hellen', 'East Dawn', 0, 0, 0, NULL, '2019-04-05 12:03:36'),
(7, '189', 'Lynch', 'Ibrahim', 'New Dedrick', 0, 0, 0, NULL, '2019-04-05 12:03:36'),
(8, '8576', 'Murray', 'Hollis', 'Reichertberg', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(9, '5', 'Goldner', 'Oceane', 'Merleland', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(10, '1824740', 'Herman', 'Christelle', 'Herzogfurt', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(11, '96535', 'Johns', 'Maya', 'Boydland', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(12, '56630823', 'Runte', 'Gunnar', 'West Jeramy', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(13, '454897', 'Huels', 'Alessandro', 'Bernhardhaven', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(14, '79', 'Cummerata', 'Orie', 'New Adah', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(15, '172106', 'Sipes', 'Etha', 'Leuschkestad', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(16, '734', 'Champlin', 'Alaina', 'Port Vilma', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(17, '13459', 'Halvorson', 'Christa', 'South Johnnyburgh', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(18, '2', 'Mayer', 'Liana', 'Sheilafort', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(19, '78008260', 'Vandervort', 'Madisen', 'Hillfurt', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(20, '8417', 'Gulgowski', 'Toy', 'Port Yvonneview', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(21, '13', 'Murray', 'Beryl', 'Estefaniaview', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(22, '32604', 'Grady', 'Letha', 'East Emil', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(23, '3457783', 'Toy', 'Edmund', 'Port Tristonchester', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(24, '3038609', 'Parisian', 'Damon', 'Jarvisstad', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(25, '11111', 'boy er update', 'Unique', 'Dejaburgh', 0, 0, 0, NULL, '2019-04-05 12:03:37'),
(26, '10-0203-0', 'sample', 'data', '****', 0, 0, 0, '2019-04-06 02:21:32', '2019-04-06 02:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `login_no` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `login_name` varchar(50) NOT NULL,
  `login_pword` varchar(100) NOT NULL,
  `login_encode` int(11) NOT NULL DEFAULT '0',
  `login_encode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login_inactive` int(11) NOT NULL DEFAULT '0',
  `login_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`login_no`, `user_no`, `role_id`, `login_name`, `login_pword`, `login_encode`, `login_encode_date`, `login_inactive`, `login_delete`) VALUES
(1, 3, 4, 'employee', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '2019-04-15 22:49:17', 0, 0),
(2, 2, 1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '2019-04-07 01:42:37', 0, 0),
(3, 4, 2, 'officer', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '2019-04-15 23:00:52', 0, 0),
(4, 5, 3, 'staff', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '2019-04-15 23:01:12', 0, 0),
(5, 6, 4, 'pogi', '36f17c3939ac3e7b2fc9396fa8e953ea', 2, '2019-04-19 14:54:53', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_no`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`depart_no`);

--
-- Indexes for table `employments`
--
ALTER TABLE `employments`
  ADD PRIMARY KEY (`employ_no`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invent_no`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_no`);

--
-- Indexes for table `release_inventory`
--
ALTER TABLE `release_inventory`
  ADD PRIMARY KEY (`release_no`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_no`);

--
-- Indexes for table `request_items`
--
ALTER TABLE `request_items`
  ADD PRIMARY KEY (`ri_no`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`sup_no`),
  ADD UNIQUE KEY `sup_name` (`sup_name`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_no`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`login_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `depart_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `employments`
--
ALTER TABLE `employments`
  MODIFY `employ_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invent_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `release_inventory`
--
ALTER TABLE `release_inventory`
  MODIFY `release_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `request_items`
--
ALTER TABLE `request_items`
  MODIFY `ri_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `supplies`
--
ALTER TABLE `supplies`
  MODIFY `sup_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `login_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
