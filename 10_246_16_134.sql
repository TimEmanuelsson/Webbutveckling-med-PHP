-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: 10.246.16.134:3306
-- Generation Time: Mar 26, 2015 at 09:45 AM
-- Server version: 5.5.42-MariaDB-1~wheezy
-- PHP Version: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `timemanuelsson_`
--
CREATE DATABASE `timemanuelsson_` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `timemanuelsson_`;

-- --------------------------------------------------------

--
-- Table structure for table `flow`
--

CREATE TABLE IF NOT EXISTS `flow` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(150) CHARACTER SET utf8 NOT NULL,
  `flowtypeID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `flow`
--

INSERT INTO `flow` (`ID`, `url`, `flowtypeID`) VALUES
(1, 'http://www.aftonbladet.se/sportbladet/rss.xml', 1),
(2, 'http://www.aftonbladet.se/nojesbladet/rss.xml', 2),
(3, 'http://www.expressen.se/Pages/OutboundFeedsPage.aspx?id=3646032&viewstyle=rss', 1),
(4, 'http://www.expressen.se/Pages/OutboundFeedsPage.aspx?id=3646056', 2);

-- --------------------------------------------------------

--
-- Table structure for table `flowtype`
--

CREATE TABLE IF NOT EXISTS `flowtype` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `flowtype`
--

INSERT INTO `flowtype` (`ID`, `type`) VALUES
(1, 'Sport'),
(2, 'Pleasure');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(40) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `password`) VALUES
(11, 'kevin', '516b98488eff166d9f10c4af5003a0e4'),
(10, 'test', '1943b8b39ca8df2919faff021e0aca98'),
(9, 'admin', 'dc647eb65e6711e155375218212b3964');

-- --------------------------------------------------------

--
-- Table structure for table `userflow`
--

CREATE TABLE IF NOT EXISTS `userflow` (
  `userflowID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `flowtypeID` int(11) NOT NULL,
  PRIMARY KEY (`userflowID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `userflow`
--

INSERT INTO `userflow` (`userflowID`, `userID`, `flowtypeID`) VALUES
(10, 11, 1),
(6, 9, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
