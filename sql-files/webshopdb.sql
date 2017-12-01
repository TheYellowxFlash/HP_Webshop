-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 01 dec 2017 om 14:29
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
  `Productnaam` varchar(255) NOT NULL,
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

INSERT INTO `bestelling` (`Bestelnummer`, `Klantnummer`, `Productnaam`, `Verzendmethode`, `Besteldatum`, `Aantal`) VALUES
(0, 0, 'Fikse lading nootmuskaat 500kg', 0, '2017-04-23', 1),
(1, 1, 'Dikke driemaster', 1, '2017-04-24', 1),
(2, 3, 'Grootschalig pakhuis één stuk', 0, '2017-04-25', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tabel leegmaken voor invoegen `categorie`
--

TRUNCATE TABLE `categorie`;
--
-- Gegevens worden uitgevoerd voor tabel `categorie`
--

INSERT INTO `categorie` (`ID`, `Naam`) VALUES
(1, 'Vaartuigen'),
(2, 'Specerijen'),
(3, 'Vastgoed');

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
(1, 'Amsterdam'),
(2, 'Den Haag'),
(3, 'Rotterdam');

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
(0, 'willem@dezwijger.com', 'Willem', 'van', 'Oranje', 'a83518c0922d85e9651fcea02662a65177982ec3e5311aeeee52e563d0ac5f0a8f954468fcfcab2676085736841a08832815578914542e8c39be8ed13ccb2487', 1, 'jOgQPiR6PVzUWqJ');

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
(1, '3', '1673NL', 'Mastenstraat', 'Amsterdam'),
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
  `Categorie_ID` int(11) NOT NULL,
  PRIMARY KEY (`Productnummer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tabel leegmaken voor invoegen `product`
--

TRUNCATE TABLE `product`;
--
-- Gegevens worden uitgevoerd voor tabel `product`
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
--
-- Gegevens worden uitgevoerd voor tabel `rollen`
--

INSERT INTO `rollen` (`ID`, `Naam`) VALUES
(0, 'Administrator'),
(1, 'Klant');

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
