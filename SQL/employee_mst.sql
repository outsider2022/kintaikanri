-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2022-02-15 08:18:36
-- サーバのバージョン： 5.7.24
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
-- テーブルの構造 `employee_mst`
--

CREATE TABLE `employee_mst` (
  `empno` char(12) COLLATE utf8_unicode_ci NOT NULL COMMENT '社員番号',
  `empname` char(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '社員名漢字',
  `empnamekana` char(60) COLLATE utf8_unicode_ci NOT NULL COMMENT '社員名カナ',
  `departmentno` char(6) COLLATE utf8_unicode_ci NOT NULL COMMENT '所属部署ID',
  `mail` char(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'メールアドレス',
  `telno` char(15) COLLATE utf8_unicode_ci NOT NULL COMMENT '電話番号',
  `workplaceno` char(5) COLLATE utf8_unicode_ci NOT NULL COMMENT 'デフォルト出社場所',
  `activeindicator` char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT '削除フラグ',
  `createdatetime` datetime NOT NULL COMMENT '作成日',
  `updatedatetime` datetime NOT NULL COMMENT '更新日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
