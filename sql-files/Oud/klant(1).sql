-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 01 dec 2017 om 14:28
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
