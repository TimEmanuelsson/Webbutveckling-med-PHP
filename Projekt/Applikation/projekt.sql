-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 24 okt 2014 kl 00:32
-- Serverversion: 5.6.15-log
-- PHP-version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `timemanuelsson_`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `flow`
--

CREATE TABLE IF NOT EXISTS `flow` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `url` varchar(70) COLLATE utf8_swedish_ci NOT NULL,
  `flowtypeID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `flow`
--

INSERT INTO `flow` (`ID`, `url`, `flowtypeID`) VALUES
(1, 'http://www.aftonbladet.se/sportbladet/rss.xml', 1),
(2, 'http://www.aftonbladet.se/nojesbladet/rss.xml', 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `flowtype`
--

CREATE TABLE IF NOT EXISTS `flowtype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `flowtype`
--

INSERT INTO `flowtype` (`ID`, `type`) VALUES
(1, 'Sport'),
(2, 'Pleasure');

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key',
  `username` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=24 ;

--
-- Dumpning av Data i tabell `user`
--

INSERT INTO `user` (`ID`, `username`, `password`) VALUES
(23, 'tim', '516b98488eff166d9f10c4af5003a0e4'),
(22, 'admin', 'dc647eb65e6711e155375218212b3964'),
(21, 'inge', 'd9e5e3f10d20aa6b583b17969c345b96');

-- --------------------------------------------------------

--
-- Tabellstruktur `userflow`
--

CREATE TABLE IF NOT EXISTS `userflow` (
  `UserFlowID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `flowTypeID` int(11) NOT NULL,
  PRIMARY KEY (`UserFlowID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=27 ;

--
-- Dumpning av Data i tabell `userflow`
--

INSERT INTO `userflow` (`UserFlowID`, `userID`, `flowTypeID`) VALUES
(24, 22, 1),
(23, 23, 0),
(21, 23, 2),
(25, 22, 0),
(22, 23, 1),
(26, 22, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
