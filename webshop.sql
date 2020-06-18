-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 01. Apr 2019 um 17:56
-- Server-Version: 10.1.38-MariaDB
-- PHP-Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `webshop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel`
--

CREATE TABLE `artikel` (
  `ANr` int(6) NOT NULL,
  `AName` varchar(30) NOT NULL DEFAULT '',
  `ALieferumfang` varchar(30) NOT NULL DEFAULT '',
  `ABild` varchar(30) NOT NULL DEFAULT '',
  `APreis` decimal(8,2) NOT NULL DEFAULT '0.00',
  `ABestand` int(7) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `artikel`
--

INSERT INTO `artikel` (`ANr`, `AName`, `ALieferumfang`, `ABild`, `APreis`, `ABestand`) VALUES
(98, 'Rothaus Pils Tannenzaepfle', '6 Flaschen', 'RothausPils.jpg', '12.99', 120),
(99, 'Schoefferhofer Kristallweizen', '20 Flaschen', 'SchoefferhoferKristallweizen.p', '27.99', 1300),
(100, 'Fuechschen Altbier', '20 Flaschen', 'alt-bier.png', '30.00', 400),
(110, 'Gaffel Koelsch', '20 Flaschen', 'koelsch.jpg', '35.00', 600),
(1145, 'Wulle Vollbier hell', '12 Flaschen', 'wullebier.jpg', '18.99', 1200);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellt`
--

CREATE TABLE `bestellt` (
  `SNr` int(6) NOT NULL DEFAULT '0',
  `ANr` int(6) NOT NULL DEFAULT '0',
  `bZeitpunkt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bAnzahl` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `klasse`
--

CREATE TABLE `klasse` (
  `KName` char(3) NOT NULL DEFAULT '',
  `KLName` char(30) NOT NULL DEFAULT '',
  `KLDBez` char(20) NOT NULL DEFAULT '',
  `KLEmail` char(40) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schueler`
--

CREATE TABLE `schueler` (
  `SNr` int(6) NOT NULL,
  `SName` char(30) NOT NULL DEFAULT '',
  `SVorname` char(30) NOT NULL DEFAULT '',
  `KName` char(3) NOT NULL DEFAULT '',
  `SMail` varchar(50) NOT NULL,
  `SPassword` varchar(40) NOT NULL,
  `SSession` varchar(48) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`ANr`),
  ADD UNIQUE KEY `IDArtikel` (`ANr`);

--
-- Indizes für die Tabelle `bestellt`
--
ALTER TABLE `bestellt`
  ADD PRIMARY KEY (`SNr`,`ANr`,`bZeitpunkt`),
  ADD UNIQUE KEY `IDbestellt` (`SNr`,`ANr`,`bZeitpunkt`),
  ADD KEY `FKBES_SCH` (`ANr`),
  ADD KEY `FKBES_ART` (`SNr`);

--
-- Indizes für die Tabelle `klasse`
--
ALTER TABLE `klasse`
  ADD PRIMARY KEY (`KName`),
  ADD UNIQUE KEY `IDKlasse` (`KName`);

--
-- Indizes für die Tabelle `schueler`
--
ALTER TABLE `schueler`
  ADD PRIMARY KEY (`SNr`),
  ADD UNIQUE KEY `IDSchueler` (`SNr`),
  ADD KEY `FKIST_IN` (`KName`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `artikel`
--
ALTER TABLE `artikel`
  MODIFY `ANr` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1146;

--
-- AUTO_INCREMENT für Tabelle `schueler`
--
ALTER TABLE `schueler`
  MODIFY `SNr` int(6) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
