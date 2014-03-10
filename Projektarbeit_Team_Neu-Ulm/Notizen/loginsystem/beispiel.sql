-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 17. Mai 2012 um 02:31
-- Server Version: 5.5.16
-- PHP-Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `beispiel`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nutzer`
--

CREATE TABLE IF NOT EXISTS `nutzer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nutzername` varchar(32) NOT NULL DEFAULT 'not',
  `email` varchar(100) NOT NULL DEFAULT 'not',
  `passwort` varchar(40) NOT NULL DEFAULT 'not',
  `anmeldedatum` datetime DEFAULT NULL,
  `aktivierungscode` int(6) NOT NULL DEFAULT '123',
  `aktiviert` int(11) NOT NULL DEFAULT '0',
  `vergessen` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Daten für Tabelle `nutzer`
--

INSERT INTO `nutzer` (`id`, `nutzername`, `email`, `passwort`, `anmeldedatum`, `aktivierungscode`, `aktiviert`, `vergessen`) VALUES
(36, 'hi', 'hi', 'fd4cef7a4e607f1fcc920ad6329a6df2df99a4e8', '2012-05-17 01:58:27', 481774, 1, 744100);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
