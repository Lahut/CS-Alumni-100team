-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 29, 2019 at 05:25 PM
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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `NickName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PublicInfo` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `Generation` int(11) NOT NULL,
  `Active` int(11) NOT NULL,
  `Type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `CreatedBy` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `CreatedOn` datetime NOT NULL,
  `UpdatedBy` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UpdatedOn` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserCode`, `FirstName`, `LastName`, `NickName`, `Password`, `Email`, `PublicInfo`, `Generation`, `Active`, `Type`, `CreatedBy`, `CreatedOn`, `UpdatedBy`, `UpdatedOn`) VALUES
('ADM0000000', 'Alumni', 'Administrator', 'CS', '$2a$10$UuVG2uO9JYqVnmvU6HBya.dd5g2mO/ebaGZ2VKNUx9Td/AMzbRfSK', 'admin@alumni.cs', 'Admin', 0, 1, 'ADMIN', 'ADM0000000', '2019-08-30 00:00:00', NULL, NULL),
('ALN0000001', 'บัวดำ', 'บูชาไฟ', 'ขาว', '$2a$10$UuVG2uO9JYqVnmvU6HBya.dd5g2mO/ebaGZ2VKNUx9Td/AMzbRfSK', 'bau@dam.kaw', 'แรลลีดีพาร์ทเมนท์โค้ชออร์แกนิกราสเบอร์รี อาว์โหงวเฮ้งแทคติคชิฟฟอนดีพาร์ทเมนท์ บ๊อบบอยคอตต์ฟรังก์ไฟลต์ สโตร์โฟล์คพีเรียด สเตเดียมเทอร์โบสุนทรีย์ ซะสุริยยาตร์แชเชือนสโตนโปสเตอร์ คณาญาติเพรสเที่ยงคืนวิลล์วิลล์ โปสเตอร์ปิโตรเคมีพิซซ่าซีนีเพล็กซ์ อีโรติกฮิสโตน คันยิแพกเกจ ฟลุทคอร์รัปชันบรรพชน มาราธอน ออยล์ซิตีซีเนียร์ แมกกาซีนเทอร์โบเป่ายิ้งฉุบต่อรอง เซี้ยว ยูโร', 99, 1, 'ALUMNI', 'ALN0000001', '2019-08-29 23:17:05', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
