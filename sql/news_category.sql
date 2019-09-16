-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 15, 2019 at 07:04 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs_alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `news_category`
--

CREATE TABLE `news_category` (
  `CategoryCode` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `CategoryName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `AllowAlumni` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `CreatedBy` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `UpdatedOn` datetime DEFAULT NULL,
  `UpdatedBy` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news_category`
--

INSERT INTO `news_category` (`CategoryCode`, `CategoryName`, `AllowAlumni`, `Active`, `CreatedOn`, `CreatedBy`, `UpdatedOn`, `UpdatedBy`) VALUES
('C0001', 'งานประชาสัมพันธ์', 1, 1, '2019-09-15 23:02:41', 'OFC0000001', '2019-09-16 01:19:16', 'OFC0000001'),
('C0002', 'งานกิจกรรมนักศึกษา', 0, 1, '2019-09-15 23:03:42', 'OFC0000001', '2019-09-15 23:06:31', 'OFC0000001');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news_category`
--
ALTER TABLE `news_category`
  ADD PRIMARY KEY (`CategoryCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
