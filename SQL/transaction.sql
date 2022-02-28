-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 
-- サーバのバージョン： 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `transaction`
--

CREATE TABLE `transaction` (
  `recordID` int(20) NOT NULL,
  `workdate` date NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time DEFAULT NULL,
  `empno` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `workplaceno` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdatetime` datetime NOT NULL,
  `created_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `updatedatetime` datetime NOT NULL,
  `updated_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD UNIQUE KEY `recordID` (`recordID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `recordID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
