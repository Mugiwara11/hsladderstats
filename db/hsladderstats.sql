-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 27, 2015 at 07:38 PM
-- Server version: 5.5.41-log
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hsladderstats`
--

-- --------------------------------------------------------

--
-- Table structure for table `stats_totales`
--

CREATE TABLE IF NOT EXISTS `stats_totales` (
`id` int(15) NOT NULL,
  `token` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `wins` int(15) NOT NULL,
  `losses` int(15) NOT NULL,
  `games` int(15) NOT NULL,
  `class` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=223 ;

--
-- Dumping data for table `stats_totales`
--

INSERT INTO `stats_totales` (`id`, `token`, `wins`, `losses`, `games`, `class`) VALUES
(205, 'd_qNX7WZbubTinTB5Qgi', 72, 64, 136, 'Druid'),
(206, 'd_qNX7WZbubTinTB5Qgi', 11, 14, 25, 'Rogue'),
(207, 'd_qNX7WZbubTinTB5Qgi', 0, 0, 0, 'Warlock'),
(208, 'd_qNX7WZbubTinTB5Qgi', 0, 0, 0, 'Warrior'),
(209, 'd_qNX7WZbubTinTB5Qgi', 2, 4, 6, 'Shaman'),
(210, 'd_qNX7WZbubTinTB5Qgi', 0, 0, 0, 'Hunter'),
(211, 'd_qNX7WZbubTinTB5Qgi', 35, 22, 57, 'Paladin'),
(212, 'd_qNX7WZbubTinTB5Qgi', 0, 0, 0, 'Priest'),
(213, 'd_qNX7WZbubTinTB5Qgi', 10, 11, 21, 'Mage'),
(214, 'vvPWSYz_WQVeL95EQ9Yx', 340, 281, 621, 'Druid'),
(215, 'vvPWSYz_WQVeL95EQ9Yx', 297, 289, 586, 'Rogue'),
(216, 'vvPWSYz_WQVeL95EQ9Yx', 216, 212, 428, 'Warlock'),
(217, 'vvPWSYz_WQVeL95EQ9Yx', 26, 33, 59, 'Warrior'),
(218, 'vvPWSYz_WQVeL95EQ9Yx', 13, 18, 31, 'Shaman'),
(219, 'vvPWSYz_WQVeL95EQ9Yx', 45, 40, 85, 'Hunter'),
(220, 'vvPWSYz_WQVeL95EQ9Yx', 66, 58, 124, 'Paladin'),
(221, 'vvPWSYz_WQVeL95EQ9Yx', 0, 0, 0, 'Priest'),
(222, 'vvPWSYz_WQVeL95EQ9Yx', 0, 0, 0, 'Mage');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `token`, `fecha_alta`) VALUES
(4, 'silent-cenarius-5140', 'd_qNX7WZbubTinTB5Qgi', '2015-05-25 17:57:30'),
(5, 'wild-nozdormu-6251', 'vvPWSYz_WQVeL95EQ9Yx', '2015-05-25 17:57:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stats_totales`
--
ALTER TABLE `stats_totales`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD UNIQUE KEY `token` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stats_totales`
--
ALTER TABLE `stats_totales`
MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=223;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
