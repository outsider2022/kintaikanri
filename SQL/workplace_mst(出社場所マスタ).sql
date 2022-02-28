-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2022-02-15 08:23:33
-- サーバのバージョン: 5.7.24
-- PHP のバージョン: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db5`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `workplace_mst`
--

CREATE TABLE `workplace_mst` (
  `workplaceno` char(5) COLLATE utf8_unicode_ci NOT NULL COMMENT '出社場所ID',
  `workplacename` char(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '出社先名',
  `postcode` char(7) COLLATE utf8_unicode_ci NOT NULL COMMENT '郵便番号',
  `address` char(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '住所',
  `activeindicator` char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT '削除フラグ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
