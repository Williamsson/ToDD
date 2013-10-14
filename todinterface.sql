-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 14 okt 2013 kl 19:49
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
  `name` varchar(65) COLLATE utf8_bin NOT NULL,
  `link_download` varchar(256) COLLATE utf8_bin NOT NULL,
  `link_plugin` varchar(256) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `plugins`
--

INSERT INTO `plugins` (`id`, `name`, `link_download`, `link_plugin`, `description`, `active`) VALUES
(1, 'Test', 'http://google.se', 'http://google.se', '', 0),
(2, 'test2', '', '', '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `temples`
--

INSERT INTO `temples` (`id`, `name`, `entrancePosX`, `entrancePosY`, `entrancePosZ`, `description`, `other`, `is_finished`, `public`, `hasBravery`, `minBravery`, `maxBravery`, `rewardBravery`, `costBravery`, `image`) VALUES
(1, 'Test Dungeon', 0, 0, 0, '<p>Test</p>', '<p>Test 2</p>\r\n<p>&nbsp;</p>\r\n<p>Test 3</p>', 0, 1, 0, 0, 0, 0, 0, 'S6w3c5rPtbJypZi3MBHa2s3HnEBg1rzvhptZLvZsyJC7kkPRBOU19kjX8Fc0poAi.jpg'),
(2, 'Dark Lord''s Tower', -11232, 60, -11232, '<p>The natural home of all Dark Lords.</p>\r\n<p>They have gathered here for ages and will for all eternity.</p>\r\n<p>The tower looks on the outside to be really big, but for some reason it look a lot smaller on the inside...</p>', '', 1, 1, 1, 0, 0, 2, 0, '');

-- --------------------------------------------------------

--
-- Tabellstruktur `temples_plugins`
--

CREATE TABLE IF NOT EXISTS `temples_plugins` (
  `temple_id` int(11) NOT NULL,
  `plugin_name` varchar(65) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(1, 0, 0, '0000-00-00 00:00:00'),
(2, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellstruktur `temple_plugins`
--

CREATE TABLE IF NOT EXISTS `temple_plugins` (
  `temple_id` int(11) NOT NULL,
  `plugin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
