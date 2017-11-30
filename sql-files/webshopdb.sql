-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 30 nov 2017 om 15:13
-- Serverversie: 5.6.13
-- PHP-versie: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `webshopdb`
--
CREATE DATABASE IF NOT EXISTS `webshopdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `webshopdb`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `administrator`
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
-- Tabel leegmaken voor invoegen `administrator`
--

TRUNCATE TABLE `administrator`;
-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

DROP TABLE IF EXISTS `bestelling`;
CREATE TABLE IF NOT EXISTS `bestelling` (
  `Bestelnummer` int(11) NOT NULL,
  `Klantnummer` int(11) NOT NULL,
  `Productnummer` int(11) NOT NULL,
  `Verzendmethode` int(11) NOT NULL,
  `Besteldatum` date NOT NULL,
  `Aantal` int(11) NOT NULL,
  PRIMARY KEY (`Bestelnummer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tabel leegmaken voor invoegen `bestelling`
--

TRUNCATE TABLE `bestelling`;
--
-- Gegevens worden uitgevoerd voor tabel `bestelling`
--

INSERT INTO `bestelling` (`Bestelnummer`, `Klantnummer`, `Productnummer`, `Verzendmethode`, `Besteldatum`, `Aantal`) VALUES
(0, 0, 0, 0, '2017-04-23', 1),
(1, 1, 0, 1, '2017-04-24', 1),
(2, 3, 0, 0, '2017-04-25', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `collectie`
--

DROP TABLE IF EXISTS `collectie`;
CREATE TABLE IF NOT EXISTS `collectie` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tabel leegmaken voor invoegen `collectie`
--

TRUNCATE TABLE `collectie`;
--
-- Gegevens worden uitgevoerd voor tabel `collectie`
--

INSERT INTO `collectie` (`ID`, `Naam`) VALUES
(1, 'Specerijen'),
(2, 'Vaartuigen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
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
-- Tabel leegmaken voor invoegen `klant`
--

TRUNCATE TABLE `klant`;
--
-- Gegevens worden uitgevoerd voor tabel `klant`
--

INSERT INTO `klant` (`Klantnummer`, `Email`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Wachtwoord`, `Rol_ID`, `Salt`) VALUES
(0, 'willem@dezwijger.com', 'Willem', 'van', 'Oranje', '6963cb98cc0c6f24d1d8d472f9665e6efe0186400267dc9b1ec00d8f9add8abb5ef682d4961d516b44b8e8b78cc726f12089960d66756a1c51222592a3533e8f', 1, '30WsET30WsET30W'),
(1, 'tolmeester@kanaal.nl', 'Michiel Adriaenszoon', 'de', 'Ruyter', '7d993e66602f1ecf54534a7357ced40da758b13962058b4f72c3b24c8c00e3727abea5d0f2b20ed5fdbc75555e4f1f5976560d880aa89894141a828178c95cb1', 1, 'MRSwJ5UMqRvrlfR'),
(2, 'sinterbaas@hotmale.nl', 'Jan', 'Pieterszoon', 'Coen', '692de305a5f41f770e4992d949724bbb053a26eb916e5c8ba2977a4f5b6f5c0596fb99924aa798fb7bec74902e45f01c18c6f8c3292a4626b50457d3f51065b0', 1, 'tAfiFpqOAUkjCz2'),
(3, 'maximvanree@gmail.com', 'Maxim', '', 'Ivanov', '2d56b5d2d7323f2cd559889a71496c078d6e8a3d40ff0e528b7b153f21b229f830cc80cb8202368827c8bcbc421ac828352ebb9df3229b1f190fe649200374d5', 1, 'UCmeKvvZwmT5HhJ'),
(4, 'cowfaicd@gmail.com', 'Jeroen', '', 'Dekker', '8497657f46af501c6deb2395027771a1172aa732a8fc00edb9890d21293e6183672296f51a2ab66fe28ced48287cbd61a8ff11e2aaa574a3cc9d976d0b11c075', 1, 'mfRJ9Ec8jQTDbk1');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `locatie`
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
-- Tabel leegmaken voor invoegen `locatie`
--

TRUNCATE TABLE `locatie`;
--
-- Gegevens worden uitgevoerd voor tabel `locatie`
--

INSERT INTO `locatie` (`Klantnummer`, `Huisnummer`, `Postcode`, `Straat`, `Woonplaats`) VALUES
(0, '1', '1533OS', 'Oranjelaan', 'Den Haag'),
(1, '3', '1673NL', 'Mastenstraat', 'Vlissingen'),
(2, '420', '1337XD', 'Denhaagstraat', 'Amsterdam'),
(3, '123', '8031EJ', 'Handellaan', 'Zwolle'),
(4, '20', '7701ED', 'Ridderspoorstraat', 'Dedemsvaart');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `ID` int(11) NOT NULL,
  `Item` varchar(45) NOT NULL,
  `Link` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tabel leegmaken voor invoegen `menu`
--

TRUNCATE TABLE `menu`;
-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pagina`
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
-- Tabel leegmaken voor invoegen `pagina`
--

TRUNCATE TABLE `pagina`;
-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
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
-- Tabel leegmaken voor invoegen `product`
--

TRUNCATE TABLE `product`;
--
-- Gegevens worden uitgevoerd voor tabel `product`
--

INSERT INTO `product` (`Productnummer`, `Productbeschrijving`, `Prijs`, `Afbeelding`, `Productnaam`, `Collectie_ID`) VALUES
(0, 'Fikse Lading Nootmuskaat 500kg', '500.00', 'nootmuskaat.jpg', 'Nootmuskaat 500kg', 1),
(1, 'Dikke driemaster', '2500.00', 'boot3.jpg', 'Driemaster', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rollen`
--

DROP TABLE IF EXISTS `rollen`;
CREATE TABLE IF NOT EXISTS `rollen` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tabel leegmaken voor invoegen `rollen`
--

TRUNCATE TABLE `rollen`;
-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `werknemer`
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
-- Tabel leegmaken voor invoegen `werknemer`
--

TRUNCATE TABLE `werknemer`;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
