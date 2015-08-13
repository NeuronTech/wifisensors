-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2015 at 06:27 PM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `esp`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `esp_id` int(8) unsigned NOT NULL,
  `esp_zone` int(4) unsigned NOT NULL,
  `esp_chan` int(8) unsigned NOT NULL,
  `esp_status` int(1) unsigned NOT NULL DEFAULT '1',
  `esp_batt` float NOT NULL,
  `esp_rx_time` time NOT NULL,
  `esp_rx_date` date NOT NULL,
  `esp_rx_level` float NOT NULL,
  `esp_rx_treshold` float unsigned NOT NULL,
  `esp_type` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT 'inertia',
  `esp_location` varchar(50) COLLATE utf8_bin NOT NULL,
  `esp_actives` int(11) unsigned NOT NULL,
  `esp_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `esp_id` (`esp_id`),
  KEY `esp_status` (`esp_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=20 ;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `esp_id`, `esp_zone`, `esp_chan`, `esp_status`, `esp_batt`, `esp_rx_time`, `esp_rx_date`, `esp_rx_level`, `esp_rx_treshold`, `esp_type`, `esp_location`, `esp_actives`, `esp_timestamp`) VALUES
(1, 1, 11, 11, 1, 3.31, '04:14:05', '2015-08-12', 114, 180, 'inertia', 'Basement Door', 1, '2015-08-12 02:14:05'),
(3, 17, 19, 4, 1, 4.01, '15:23:27', '2015-08-13', 153, 0, 'inertia', 'Kitchen', 2795, '2015-08-13 13:23:27'),
(17, 13, 10, 11, 1, 2.98, '14:50:34', '2015-08-13', 311, 101, 'inertia', 'Attic', 5, '2015-08-13 12:50:34'),
(18, 11, 9, 9, 1, 3.31, '12:14:54', '2015-08-12', 100, 198, 'inertia', 'Bedroom 1', 2, '2015-08-12 10:14:54'),
(19, 24, 11, 11, 0, 3.11, '00:00:00', '0000-00-00', 99, 250, 'inertia', 'Bedroom 2', 0, '2015-08-11 09:38:49');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
