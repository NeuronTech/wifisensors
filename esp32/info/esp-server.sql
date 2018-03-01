SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `esp-server`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `is_client` tinyint(1) NOT NULL,
  `esp_ip` varchar(15) COLLATE utf8_bin NOT NULL DEFAULT '192.168.0.0',
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
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=20 ;

INSERT INTO `clients` (`id`, `is_client`, `esp_ip`, `esp_id`, `esp_zone`, `esp_chan`, `esp_status`, `esp_batt`, `esp_rx_time`, `esp_rx_date`, `esp_rx_level`, `esp_rx_treshold`, `esp_type`, `esp_location`, `esp_actives`, `esp_timestamp`) VALUES
(1, 1, '192.168.0.0', 1, 11, 11, 1, 3.31, '04:14:05', '2015-08-12', 114, 180, 'inertia', 'Basement Door', 1, '2015-08-19 23:34:03'),
(3, 1, '192.168.0.0', 17, 19, 4, 1, 4.01, '04:12:39', '2015-08-16', 139, 0, 'inertia', 'Kitchen', 2800, '2015-08-19 23:34:03'),
(17, 1, '192.168.0.0', 13, 10, 11, 1, 2.98, '14:50:34', '2015-08-13', 311, 101, 'inertia', 'Attic', 5, '2015-08-19 23:34:03'),
(18, 1, '192.168.0.0', 11, 9, 9, 1, 3.31, '12:14:54', '2015-08-12', 100, 198, 'inertia', 'Bedroom 1', 2, '2015-08-19 23:34:03'),
(19, 1, '192.168.0.0', 24, 11, 11, 0, 3.11, '00:00:00', '0000-00-00', 99, 250, 'inertia', 'Bedroom 2', 0, '2015-08-19 23:34:03');

CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `esp_is_client` tinyint(1) NOT NULL,
  `esp_ip` varchar(15) COLLATE utf8_bin NOT NULL DEFAULT '192.168.000.000',
  `esp_zone` int(4) unsigned NOT NULL,
  `esp_chan` int(8) unsigned NOT NULL,
  `esp_status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `esp_batt` float NOT NULL,
  `esp_rx_time` time NOT NULL,
  `esp_rx_date` date NOT NULL,
  `esp_rssi` smallint(6) NOT NULL,
  `esp_adc_reading` float NOT NULL,
  `esp_adc_trigger` float NOT NULL,
  `esp_type` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT 'inertia',
  `esp_location` varchar(50) COLLATE utf8_bin NOT NULL,
  `esp_actives` int(11) unsigned NOT NULL,
  `esp_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `esp_gpio0` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio1` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio2` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio3` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio4` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio5` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio9` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio10` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio12` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio13` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio14` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio15` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio16` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_adc` tinyint(1) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `esp_status` (`esp_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15 ;

INSERT INTO `devices` (`id`, `esp_is_client`, `esp_ip`, `esp_zone`, `esp_chan`, `esp_status`, `esp_batt`, `esp_rx_time`, `esp_rx_date`, `esp_rssi`, `esp_adc_reading`, `esp_adc_trigger`, `esp_type`, `esp_location`, `esp_actives`, `esp_timestamp`, `esp_gpio0`, `esp_gpio1`, `esp_gpio2`, `esp_gpio3`, `esp_gpio4`, `esp_gpio5`, `esp_gpio9`, `esp_gpio10`, `esp_gpio12`, `esp_gpio13`, `esp_gpio14`, `esp_gpio15`, `esp_gpio16`, `esp_adc`) VALUES
(1, 1, '192.168.0.0', 11, 11, 1, 3.31, '04:14:05', '2015-08-12', 114, 180, 0, 'inertia', 'Basement Door', 1, '2015-08-19 22:34:03', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 1, '192.168.1.3', 2, 4, 1, 3.01, '08:33:45', '2015-09-17', -43, 122, 101, 'inertia reed', 'Kitchen', 6042, '2015-09-17 06:33:45', 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 1, '192.168.0.0', 10, 11, 1, 2.98, '13:09:39', '2015-08-27', 311, 101, 0, 'inertia', 'Attic', 21, '2015-08-27 11:09:39', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(14, 1, '192.168.1.4', 0, 9, 1, 3.12, '16:24:23', '2015-08-27', 254, 200, 0, 'inertai', 'Kitchen', 0, '2015-07-01 02:50:36', 0, 0, 0, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1),
(5, 0, '192.168.1.8', 5, 11, 1, 3.21, '16:16:03', '2015-08-27', 123, 124, 0, 'server', 'Lounge', 3, '2015-08-27 14:16:03', 1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1);


CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) COLLATE utf8_bin NOT NULL,
  `pass` varchar(100) COLLATE utf8_bin NOT NULL,
  `auth` tinyint(1) NOT NULL,
  `user_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

INSERT INTO `login` (`id`, `user`, `pass`, `auth`, `user_ip`) VALUES
(1, 'admin', 'letmein', 1, '192.168.1.1'),
(2, 'user', 'pass', 1, '192.168.1.1');


CREATE TABLE IF NOT EXISTS `servers` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `esp_ip` varchar(15) COLLATE utf8_bin NOT NULL DEFAULT '192.168.000.000',
  `esp_id` int(8) unsigned NOT NULL,
  `esp_zone` int(4) unsigned NOT NULL,
  `esp_chan` int(8) unsigned NOT NULL,
  `esp_status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `esp_batt` float NOT NULL,
  `esp_rx_time` time NOT NULL,
  `esp_rx_date` date NOT NULL,
  `esp_rx_level` float NOT NULL,
  `esp_rx_treshold` float unsigned NOT NULL,
  `esp_type` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT 'inertia',
  `esp_location` varchar(50) COLLATE utf8_bin NOT NULL,
  `esp_actives` int(11) unsigned NOT NULL,
  `esp_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `esp_gpios` varchar(255) COLLATE utf8_bin NOT NULL,
  `esp_gpio0` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio1` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio2` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio3` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio4` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio5` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio9` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio10` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio12` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio13` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio14` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio15` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_gpio16` tinyint(1) NOT NULL DEFAULT '-1',
  `esp_adc` tinyint(1) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `esp_id` (`esp_id`),
  KEY `esp_status` (`esp_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

INSERT INTO `servers` (`id`, `esp_ip`, `esp_id`, `esp_zone`, `esp_chan`, `esp_status`, `esp_batt`, `esp_rx_time`, `esp_rx_date`, `esp_rx_level`, `esp_rx_treshold`, `esp_type`, `esp_location`, `esp_actives`, `esp_timestamp`, `esp_gpios`, `esp_gpio0`, `esp_gpio1`, `esp_gpio2`, `esp_gpio3`, `esp_gpio4`, `esp_gpio5`, `esp_gpio9`, `esp_gpio10`, `esp_gpio12`, `esp_gpio13`, `esp_gpio14`, `esp_gpio15`, `esp_gpio16`, `esp_adc`) VALUES
(1, '192.168.0.8', 1, 1, 1, 1, 3.3, '00:00:00', '0000-00-00', 0, 255, 'inertia', 'Rooftop', 0, '2015-08-19 13:57:20', '00,02', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);