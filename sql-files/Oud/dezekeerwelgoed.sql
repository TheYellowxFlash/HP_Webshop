-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2017 at 02:13 PM
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
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `ID` int(11) NOT NULL,
  `Gebruikersnaam` varchar(45) NOT NULL,
  `Wachtwoord` varchar(255) NOT NULL,
  `Rol_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `administrator`
--

TRUNCATE TABLE `administrator`;
-- --------------------------------------------------------

--
-- Table structure for table `bestelling`
--

DROP TABLE IF EXISTS `bestelling`;
CREATE TABLE IF NOT EXISTS `bestelling` (
  `Bestelnummer` int(11) NOT NULL,
  `Klantnummer` int(11) NOT NULL,
  `Productnaam` varchar(255) NOT NULL,
  `Verzendmethode` int(11) NOT NULL,
  `Besteldatum` date NOT NULL,
  `Aantal` int(11) NOT NULL,
  PRIMARY KEY (`Bestelnummer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `bestelling`
--

TRUNCATE TABLE `bestelling`;
--
-- Dumping data for table `bestelling`
--

INSERT INTO `bestelling` (`Bestelnummer`, `Klantnummer`, `Productnaam`, `Verzendmethode`, `Besteldatum`, `Aantal`) VALUES
(0, 0, 'Fikse lading nootmuskaat 500kg', 0, '2017-04-23', 1),
(1, 1, 'Dikke driemaster', 1, '2017-04-24', 1),
(2, 3, 'Grootschalig pakhuis één stuk', 0, '2017-04-25', 3);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `categorie`
--

TRUNCATE TABLE `categorie`;
--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`ID`, `Naam`) VALUES
(1, 'Vaartuigen'),
(2, 'Specerijen'),
(3, 'Vastgoed');

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
(1, 'Amsterdam'),
(2, 'Den Haag'),
(3, 'Rotterdam');

-- --------------------------------------------------------

--
-- Table structure for table `klant`
--

DROP TABLE IF EXISTS `klant`;
CREATE TABLE IF NOT EXISTS `klant` (
  `Klantnummer` int(11) NOT NULL DEFAULT '0',
  `Email` varchar(45) DEFAULT NULL,
  `Voornaam` varchar(45) DEFAULT NULL,
  `Tussenvoegsel` varchar(45) NOT NULL,
  `Achternaam` varchar(45) DEFAULT NULL,
  `Wachtwoord` varchar(512) DEFAULT NULL,
  `Rol_ID` int(11) DEFAULT NULL,
  `Salt` varchar(15) NOT NULL,
  PRIMARY KEY (`Klantnummer`),
  UNIQUE KEY `Salt` (`Salt`),
  UNIQUE KEY `Email_UNIQUE` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `klant`
--

TRUNCATE TABLE `klant`;
--
-- Dumping data for table `klant`
--

INSERT INTO `klant` (`Klantnummer`, `Email`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Wachtwoord`, `Rol_ID`, `Salt`) VALUES
(0, 'willem@dezwijger.com', 'Willem', 'van', 'Oranje', '6963cb98cc0c6f24d1d8d472f9665e6efe0186400267dc9b1ec00d8f9add8abb5ef682d4961d516b44b8e8b78cc726f12089960d66756a1c51222592a3533e8f', 1, '30WsET30WsET30W'),
(1, 'tolmeester@kanaal.nl', 'Michiel Adriaenszoon', 'de', 'Ruyter', '7d993e66602f1ecf54534a7357ced40da758b13962058b4f72c3b24c8c00e3727abea5d0f2b20ed5fdbc75555e4f1f5976560d880aa89894141a828178c95cb1', 1, 'MRSwJ5UMqRvrlfR'),
(2, 'sinterbaas@hotmale.nl', 'Jan', 'Pieterszoon', 'Coen', '692de305a5f41f770e4992d949724bbb053a26eb916e5c8ba2977a4f5b6f5c0596fb99924aa798fb7bec74902e45f01c18c6f8c3292a4626b50457d3f51065b0', 1, 'tAfiFpqOAUkjCz2'),
(3, 'maximvanree@gmail.com', 'Maxim', '', 'Ivanov', '2d56b5d2d7323f2cd559889a71496c078d6e8a3d40ff0e528b7b153f21b229f830cc80cb8202368827c8bcbc421ac828352ebb9df3229b1f190fe649200374d5', 1, 'UCmeKvvZwmT5HhJ'),
(4, 'cowfaicd@gmail.com', 'Jeroen', '', 'Dekker', '8497657f46af501c6deb2395027771a1172aa732a8fc00edb9890d21293e6183672296f51a2ab66fe28ced48287cbd61a8ff11e2aaa574a3cc9d976d0b11c075', 1, 'mfRJ9Ec8jQTDbk1');

-- --------------------------------------------------------

--
-- Table structure for table `locatie`
--

DROP TABLE IF EXISTS `locatie`;
CREATE TABLE IF NOT EXISTS `locatie` (
  `Klantnummer` int(11) NOT NULL,
  `Huisnummer` varchar(45) NOT NULL,
  `Postcode` varchar(6) NOT NULL,
  `Straat` varchar(50) NOT NULL,
  `Woonplaats` varchar(50) NOT NULL,
  PRIMARY KEY (`Klantnummer`,`Huisnummer`,`Postcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `locatie`
--

TRUNCATE TABLE `locatie`;
--
-- Dumping data for table `locatie`
--

INSERT INTO `locatie` (`Klantnummer`, `Huisnummer`, `Postcode`, `Straat`, `Woonplaats`) VALUES
(0, '1', '1533OS', 'Oranjelaan', 'Den Haag'),
(1, '3', '1673NL', 'Mastenstraat', 'Amsterdam'),
(2, '420', '1337XD', 'Denhaagstraat', 'Amsterdam'),
(3, '123', '8031EJ', 'Handellaan', 'Zwolle'),
(4, '20', '7701ED', 'Ridderspoorstraat', 'Dedemsvaart');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `ID` int(11) NOT NULL,
  `Item` varchar(45) NOT NULL,
  `Link` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `menu`
--

TRUNCATE TABLE `menu`;
-- --------------------------------------------------------

--
-- Table structure for table `pagina`
--

DROP TABLE IF EXISTS `pagina`;
CREATE TABLE IF NOT EXISTS `pagina` (
  `ID` int(11) NOT NULL,
  `Titel` varchar(255) NOT NULL,
  `Inhoud` longtext NOT NULL,
  `Menu_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `pagina`
--

TRUNCATE TABLE `pagina`;
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
  `Categorie_ID` int(11) NOT NULL,
  PRIMARY KEY (`Productnummer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `product`
--

TRUNCATE TABLE `product`;
--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Productnummer`, `Productbeschrijving`, `Prijs`, `Afbeelding`, `Productnaam`, `Collectie_ID`, `Categorie_ID`) VALUES
(100, 'Een stevige sloep', '100.00', 'sloep.jpg', 'Sloep', 1, 1),
(101, 'Dikke driemaster', '10000.00', 'driemaster.jpg', 'Driemaster', 2, 1),
(103, 'Een vissersbootje', '1000.00', 'vissersboot.jpg', 'Vissersboot', 3, 1),
(201, 'Lekker nootmuskaatje', '10.00', 'nootmuskaat.jpg', 'Pak Nootmuskaat', 1, 2),
(202, 'Lekker kaneeltje', '9.75', 'kaneel.jpg', 'Pak Kaneel', 2, 2),
(203, 'Heerlijk pakje foelie', '10.00', 'foelie.jpg', 'Pak Foelie', 3, 2),
(301, 'Een mooi, ruim pakhuis', '100000.00', 'pakhuis.jpg', 'Pakhuis', 1, 3),
(302, 'Plekkie om bootjes te repareren', '10000.00', 'boodwerf', 'Boot Werf', 2, 3),
(303, 'Enkel koffie en thee met verse blaadjes', '120000.00', 'koffiewinkel.jpg', 'Koffiewinkel', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rollen`
--

DROP TABLE IF EXISTS `rollen`;
CREATE TABLE IF NOT EXISTS `rollen` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `rollen`
--

TRUNCATE TABLE `rollen`;
--
-- Dumping data for table `rollen`
--

INSERT INTO `rollen` (`ID`, `Naam`) VALUES
(0, 'Administrator'),
(1, 'Klant');

-- --------------------------------------------------------

--
-- Table structure for table `werknemer`
--

DROP TABLE IF EXISTS `werknemer`;
CREATE TABLE IF NOT EXISTS `werknemer` (
  `ID` int(11) NOT NULL,
  `Gebruikersnaam` varchar(45) NOT NULL,
  `Wachtwoord` varchar(255) NOT NULL,
  `Naam` varchar(255) NOT NULL,
  `Rol_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `werknemer`
--

TRUNCATE TABLE `werknemer`;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
