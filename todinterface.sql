-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 25 okt 2013 kl 20:48
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
-- Tabellstruktur `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(65) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `posted` date NOT NULL,
  `author` int(11) NOT NULL,
  `visibility` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumpning av Data i tabell `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `posted`, `author`, `visibility`) VALUES
(3, 'New PvP system', '<p>We have a new PvP plugin installed (or rather, we reinstalled a system we used before). You can test it out in the PvP arena in the Minigame Universe.</p>\r\n<p>&nbsp;</p>\r\n<p>It gives cookies to winners.</p>', '2013-10-21', 3, 3),
(4, '4 Frog', '<p>This is what our meeting has decieded regarding the behaviour of frog78.</p>\r\n<p>The rest will be in swedish because resons.</p>\r\n<p>HELST:<br />- Ingen WG<br />- Bara towny baserat p&aring; det inv&aring;narantal han har och/eller k&ouml;pt till sig<br />- Adminflagga kvar<br />- Spela som alla andra, separera p&aring; adminroll/spelarroll</p>\r\n<p>OK:<br />- Ingen WG<br />- Bara towny, okej med bonusar<br />- Ingen adminflagga<br />- Spela som alla andra</p>\r\n<p>&nbsp;</p>\r\n<p>Fine, men bara pga serverns ekonomi:</p>\r\n<p>- WG enbart runt ditt lager, men dess storlek ska begr&auml;nsas till minimala storleken som kr&auml;vs f&ouml;r att skydda lagret som det ser ut idag (25/10 - 2013).</p>\r\n<p><br />Helst inte:<br />- WG skydda allt<br />- Bort med towny<br />- Ingen adminflagga<br />- Agera inventarie p&aring; server, NPC, questing, osv</p>', '2013-10-25', 3, 3);

-- --------------------------------------------------------

--
-- Tabellstruktur `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(65) COLLATE utf8_bin NOT NULL,
  `author` int(11) unsigned NOT NULL,
  `created` date NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumpning av Data i tabell `pages`
--

INSERT INTO `pages` (`id`, `title`, `author`, `created`, `content`) VALUES
(1, 'Testpage', 1, '2013-10-25', '<h1>This is content</h1>\r\n<p>With some lorem ipsum</p>');

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
(2, 'Builder'),
(3, 'Admin');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=44 ;

--
-- Dumpning av Data i tabell `plugins`
--

INSERT INTO `plugins` (`id`, `plugin_name`, `version`, `last_update`, `link_download`, `link_plugin`, `plugin_description`, `active`, `broken`) VALUES
(7, 'WorldEdit', '5.5.8', '2013-10-10', 'http://dev.bukkit.org/bukkit-plugins/worldedit/', 'http://wiki.sk89q.com/wiki/WorldEdit', 'Terraforming, protection', 1, 0),
(8, 'WorldGuard', '5.8', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/worldguard/', 'http://wiki.sk89q.com/wiki/WorldGuard', 'Protection and stuff', 1, 0),
(10, 'AutoGamemode', '2.0', '2013-10-25', 'http://dev.bukkit.org/bukkit-plugins/autogamemode/', 'http://dev.bukkit.org/bukkit-plugins/autogamemode/', 'Change gamemode easily', 1, 0),
(11, 'Bandit', '0.5', '2013-10-25', '', '', 'Make someone a bandit if they kill people', 1, 0),
(12, 'BooksWithoutBorders', '1.2.6', '2013-10-25', 'http://dev.bukkit.org/bukkit-plugins/books-without-borders/', '', 'Copy and edit books', 1, 0),
(13, 'ChestShop', '3.4.2', '2013-10-25', '', '', 'Make shops with chests. Not really used anywhere, even by players', 1, 0),
(14, 'CoreProtect', '2.0.8', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/coreprotect/', 'http://minerealm.com/community/viewtopic.php?f=32&t=6781&p=82240', 'Take care of griefing', 1, 0),
(15, 'Craftbook', '3.7-SNAPSHOT:3253', '2013-10-13', 'http://dev.bukkit.org/server-mods/craftbook/', '', 'Don''t know why we have it..', 1, 0),
(16, 'Decapitation', '0.2.8', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/decapitation/', '', 'Makes you drop your head upon dying', 1, 0),
(17, 'Dynmap', '1.9', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/dynmap/', 'https://github.com/webbukkit/dynmap/wiki/Commands', 'A dynamic web-based map', 1, 0),
(18, 'Dynmap-Towny', '0.50', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/dynmap-towny/', 'https://github.com/webbukkit/Dynmap-Towny/wiki', 'Shows towny information on the dynmap', 1, 0),
(19, 'Essentials', '2.12.1', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/essentials/', 'http://wiki.ess3.net/wiki/Main_Page', 'Lots of good commands', 1, 0),
(20, 'EssentialsChat', '2.12.1', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/essentials/', '', 'Essentials chat functionality', 1, 0),
(21, 'EssentialsSpawn', 'Pre2.12.1.2', '2013-08-13', 'http://dev.bukkit.org/bukkit-plugins/essentials/', '', 'Essentials Spawn functionallity', 1, 0),
(22, 'GoldIsMoney', '2.0.2', '2012-09-19', 'http://dev.bukkit.org/bukkit-plugins/goldismoney/', '', 'Make physical gold the currency', 1, 0),
(23, 'LightningTP', '0.1', '2012-05-10', '', '', 'Teleport and strike lightning!', 1, 0),
(24, 'MultiInv', '3.2.6', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/multiinv/', '', 'Separate inventories between worlds', 1, 0),
(25, 'Multiverse-Core', '2.5', '2013-04-03', 'http://dev.bukkit.org/bukkit-plugins/multiverse-core/', 'https://github.com/Multiverse/Multiverse-Core/wiki', 'Possibility to have multiple worlds', 1, 0),
(26, 'Multiverse-Portals', '2.5', '2013-04-03', 'http://dev.bukkit.org/bukkit-plugins/multiverse-portals/', 'https://github.com/Multiverse/Multiverse-Portals/wiki', 'Adds multiverse portals between worlds', 1, 0),
(27, 'OpenInv', '2.0.9', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/openinv/', '', 'Open a users inventory', 1, 0),
(28, 'PermissionsEx', '1.19.6', '2013-08-14', 'http://dev.bukkit.org/bukkit-plugins/permissionsex/', '', 'Permissions system, ofc', 1, 0),
(29, 'RPGItems', '3.3', '2013-07-04', 'http://dev.bukkit.org/bukkit-plugins/rpg-items/', '', 'Do awesome stuff with "custom items"', 1, 0),
(30, 'ScheduledAnnouncer', '2.8', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/scheduledannouncer2/', '', 'Sends defined messages at defined intervals', 1, 0),
(31, 'ShelfIt', '1.3.5', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/shelf-it/', '', 'Place books in bookshelfs', 1, 0),
(32, 'Shopkeepers', '1.15.1', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/shopkeepers/', '', 'Villager shopkeepers that trade', 1, 0),
(33, 'Stargate', '0.7.7.4', '2013-08-26', 'http://forum.thedgtl.net/viewtopic.php?f=4&t=5', '', 'Cool tp gates with multiple destinations', 1, 0),
(34, 'TimTheEnchanter', '3.0', '2012-02-02', 'http://dev.bukkit.org/bukkit-plugins/enchanter/', '', 'Enchant equipment with commands', 1, 0),
(35, 'Towny', '0.84.0.0', '2013-10-13', 'http://www.palmergames.com/downloads/', 'https://code.google.com/a/eclipselabs.org/p/towny/wiki/Commands', 'Towns and nations to protect constructions', 1, 0),
(36, 'TreasureChest', '8.4.4', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/treasurechest/', '', 'Chests are cool and amazing', 1, 0),
(37, 'TuxTwoLib', '1.6.4-b3', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/tuxtwolib/', '', 'An API for other plugins to hook into and do stuff', 1, 0),
(38, 'VanishNoPacket', '3.18.3', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/vanish/', '', 'Vanish without leaving a trace behind..', 1, 0),
(39, 'War', '1.8-preview', '2013-10-20', 'http://dev.bukkit.org/bukkit-plugins/war/', 'http://war.tommytony.com/instructions#zone', 'Create PvP arenas', 1, 0),
(40, 'Vault', '1.2.27', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/vault/', '', 'An API for other plugins to hook into and do stuff', 1, 0),
(41, 'VoiceControl', '2.5', '2012-11-17', '', '', 'Speak "Friend" and enter.', 1, 0),
(42, 'WorldBorder', '1.7.5', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/worldborder/', '', 'plugin for limiting the size of your worlds.', 1, 0),
(43, 'VoxelSniper', '5.168.7-Snapshot', '2013-10-13', 'http://dev.bukkit.org/bukkit-plugins/voxelsniper/', 'http://www.voxelwiki.com/minecraft/VoxelSniper', 'Terraforming stuff', 1, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `temples`
--

CREATE TABLE IF NOT EXISTS `temples` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(65) COLLATE utf8_bin NOT NULL,
  `responsible` int(11) unsigned NOT NULL,
  `entrancePosX` float NOT NULL,
  `entrancePosY` float NOT NULL,
  `entrancePosZ` float NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `other` text COLLATE utf8_bin NOT NULL,
  `is_finished` tinyint(1) NOT NULL,
  `visibility` int(11) NOT NULL,
  `hasBravery` tinyint(1) NOT NULL,
  `minBravery` int(11) NOT NULL,
  `maxBravery` int(11) NOT NULL,
  `rewardBravery` int(11) NOT NULL,
  `costBravery` int(11) NOT NULL,
  `image` varchar(70) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumpning av Data i tabell `temples`
--

INSERT INTO `temples` (`id`, `name`, `responsible`, `entrancePosX`, `entrancePosY`, `entrancePosZ`, `description`, `other`, `is_finished`, `visibility`, `hasBravery`, `minBravery`, `maxBravery`, `rewardBravery`, `costBravery`, `image`) VALUES
(10, 'Test', 1, 123, 123, 123, '<p>Testtest</p>', '', 1, 1, 0, 0, 0, 0, 0, 'tGPQOUyrRKUeVi2zaDvBuruPT8D0xueUDXJSeJr2J6s5RFl03utUowUHZDGSLmpK.png');

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
(10, 1, 3, '0000-00-00 00:00:00');

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
(10, 7),
(10, 8);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `description`, `password`) VALUES
(1, 'Williamsson', '<p>I am the Alpha and Omega, I am the web developer of KBK, I am the Hoster of Servers - I am the Eater of Worlds.</p>', '21227022eb273d222324dbfd1d385447335f70be'),
(3, 'Zephyyrr', '<p>I am the 1337 coder of ToD and KBK.</p>\r\n<p>I have been an admin since 2011 or so.</p>', 'bfe1e6a85f3b3340e4a982651fbead94a5494d47'),
(4, 'Jezereth', '', '36d1858a98645f1c0bd60f19f72c87899a803926');

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
(1, 3),
(3, 3),
(4, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
