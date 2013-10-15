-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 15 okt 2013 kl 20:46
-- Serverversion: 5.6.12-log
-- PHP-version: 5.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `todinterface`
--
CREATE DATABASE IF NOT EXISTS `todinterface` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `todinterface`;

-- --------------------------------------------------------

--
-- Tabellstruktur `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(65) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumpning av Data i tabell `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'Default'),
(2, 'Admin'),
(3, 'Builder');

-- --------------------------------------------------------

--
-- Tabellstruktur `plugins`
--

CREATE TABLE IF NOT EXISTS `plugins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `plugin_name` varchar(65) COLLATE utf8_bin NOT NULL,
  `version` varchar(20) COLLATE utf8_bin NOT NULL,
  `last_update` date NOT NULL,
  `link_download` varchar(256) COLLATE utf8_bin NOT NULL,
  `link_plugin` varchar(256) COLLATE utf8_bin NOT NULL,
  `plugin_description` text COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL,
  `broken` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Dumpning av Data i tabell `plugins`
--

INSERT INTO `plugins` (`id`, `plugin_name`, `version`, `last_update`, `link_download`, `link_plugin`, `plugin_description`, `active`, `broken`) VALUES
(1, 'Torsten the World Turtle', '1.0', '2013-01-23', 'http://imgur.com/pF7owkL', '', 'Torsten!', 1, 0),
(7, 'WorldEdit', '5.5.8', '2013-10-10', 'http://dev.bukkit.org/bukkit-plugins/worldedit/', 'http://wiki.sk89q.com/wiki/WorldEdit', 'Terraforming, protection', 1, 0),
(8, 'WorldGuard', '5.8', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/worldguard/', 'http://wiki.sk89q.com/wiki/WorldGuard', 'Protection and stuff', 1, 0),
(9, 'Ion Cannon', '1.0.2', '2013-10-31', 'ioncannon.org', '', 'Blast users from SPAACE!', 0, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `temples`
--

CREATE TABLE IF NOT EXISTS `temples` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(65) COLLATE utf8_bin NOT NULL,
  `entrancePosX` float NOT NULL,
  `entrancePosY` float NOT NULL,
  `entrancePosZ` float NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `other` text COLLATE utf8_bin NOT NULL,
  `is_finished` tinyint(1) NOT NULL,
  `public` tinyint(1) NOT NULL,
  `hasBravery` tinyint(1) NOT NULL,
  `minBravery` int(11) NOT NULL,
  `maxBravery` int(11) NOT NULL,
  `rewardBravery` int(11) NOT NULL,
  `costBravery` int(11) NOT NULL,
  `image` varchar(70) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumpning av Data i tabell `temples`
--

INSERT INTO `temples` (`id`, `name`, `entrancePosX`, `entrancePosY`, `entrancePosZ`, `description`, `other`, `is_finished`, `public`, `hasBravery`, `minBravery`, `maxBravery`, `rewardBravery`, `costBravery`, `image`) VALUES
(1, 'Test', 551, 115, 512, '<p>Dungeon thing</p>', '<p>test</p>', 1, 1, 1, 12, 0, 122, 16, '8U4xFWjdFpYi3Nb0eLmO22rvxCmxpC0qnAqdWIj6I72NvuSsNKVtD5hpeZaCpU8W.jpg');

-- --------------------------------------------------------

--
-- Tabellstruktur `temple_approvals`
--

CREATE TABLE IF NOT EXISTS `temple_approvals` (
  `temple_id` int(11) NOT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `approved_date` datetime NOT NULL,
  PRIMARY KEY (`temple_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumpning av Data i tabell `temple_approvals`
--

INSERT INTO `temple_approvals` (`temple_id`, `is_approved`, `approved_by`, `approved_date`) VALUES
(1, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellstruktur `temple_plugins`
--

CREATE TABLE IF NOT EXISTS `temple_plugins` (
  `temple_id` int(11) NOT NULL,
  `plugin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumpning av Data i tabell `temple_plugins`
--

INSERT INTO `temple_plugins` (`temple_id`, `plugin_id`) VALUES
(1, 1),
(1, 7);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(65) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `password` varchar(65) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `description`, `password`) VALUES
(1, 'Williamsson', 'Awesome', '21227022eb273d222324dbfd1d385447335f70be');

-- --------------------------------------------------------

--
-- Tabellstruktur `users_permissions`
--

CREATE TABLE IF NOT EXISTS `users_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumpning av Data i tabell `users_permissions`
--

INSERT INTO `users_permissions` (`user_id`, `permission_id`) VALUES
(1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
