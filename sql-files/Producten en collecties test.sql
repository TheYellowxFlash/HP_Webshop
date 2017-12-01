-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2017 at 11:58 AM
-- Server version: 5.6.13
-- PHP Version: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webshopdb`
--
CREATE DATABASE IF NOT EXISTS `webshopdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `webshopdb`;

-- --------------------------------------------------------

--
-- Table structure for table `collectie`
--

DROP TABLE IF EXISTS `collectie`;
CREATE TABLE IF NOT EXISTS `collectie` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `collectie`
--

TRUNCATE TABLE `collectie`;
--
-- Dumping data for table `collectie`
--

INSERT INTO `collectie` (`ID`, `Naam`) VALUES
(1, 'Vaartuigen'),
(2, 'Specerijenn'),
(3, 'Vastgoed');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `Productnummer` int(11) NOT NULL,
  `Productbeschrijving` longtext NOT NULL,
  `Prijs` decimal(9,2) NOT NULL,
  `Afbeelding` varchar(255) NOT NULL,
  `Productnaam` varchar(45) NOT NULL,
  `Collectie_ID` int(11) NOT NULL,
  PRIMARY KEY (`Productnummer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `product`
--

TRUNCATE TABLE `product`;
--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Productnummer`, `Productbeschrijving`, `Prijs`, `Afbeelding`, `Productnaam`, `Collectie_ID`) VALUES
(100, 'Een stevige sloep', '100.00', 'sloep.jpg', 'Sloep', 1),
(101, 'Dikke driemaster', '10000.00', 'driemaster.jpg', 'Driemaster', 1),
(201, 'Lekker nootmuskaatje', '10.00', 'nootmuskaat.jpg', 'Pak Nootmuskaat', 2),
(202, 'Lekker kaneeltje', '9.75', 'kaneel.jpg', 'Pak Kaneel', 2),
(301, 'Een mooi, ruim pakhuis', '100000.00', 'pakhuis.jpg', 'Pakhuis', 3),
(302, '', '10000.00', 'boodwerf', 'Boot Werf', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
