-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Mrz 2025 um 15:41
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `meine_datenbank`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

CREATE TABLE `posts` (
  `idPosts` int(11) NOT NULL,
  `GerichtName` varchar(45) NOT NULL,
  `Users_Benutzername` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tagkategorie`
--

CREATE TABLE `tagkategorie` (
  `idTagKategorie` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tags`
--

CREATE TABLE `tags` (
  `Tagname` varchar(40) NOT NULL,
  `TagArt` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tagszupost`
--

CREATE TABLE `tagszupost` (
  `idTagsZuPost` int(11) NOT NULL,
  `Posts_idPosts` int(11) NOT NULL,
  `Tags_idTag` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `passwort` varchar(150) NOT NULL,
  `age` int(3) NOT NULL,
  `geschlecht` varchar(20) NOT NULL,
  `geburtsjahr` year(4) NOT NULL,
  `nationalitaet` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `nachname`, `email`, `passwort`, `age`, `geschlecht`, `geburtsjahr`, `nationalitaet`) VALUES
(1, 'Elena', 'Starke', 'elena.starke@web.de', '$2y$10$i/wTe8c0I/RKuLBDWwXPVee9Ye6ScQfRGqNtemIP9EC3RU3N5K49i', 19, 'weiblich', '2005', 'Deutschland'),
(2, 'marcel', 'starke', 'marcel.starke03@web.de', '$2y$10$REmvKg7urfCsl0tgdSazkugIOVqg1wSxuGGGOSqvvS9ulhMj/fY6O', 0, '', '0000', ''),
(3, 'Marcel', 'Starke', 'marcel.starke@web.de', '$2y$10$Q9TGfSV3ZrpnX7tPB5qTUudzTNg6XR6avtmOHCZ2m3eB2wfqsIVYO', 18, 'männlich', '2007', 'Deutschland'),
(4, 'Elena', 'Starke', 'elena.starke@web.de', '$2y$10$i/wTe8c0I/RKuLBDWwXPVee9Ye6ScQfRGqNtemIP9EC3RU3N5K49i', 19, 'weiblich', '2005', 'Deutschland');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`idPosts`);

--
-- Indizes für die Tabelle `tagkategorie`
--
ALTER TABLE `tagkategorie`
  ADD PRIMARY KEY (`idTagKategorie`);

--
-- Indizes für die Tabelle `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`Tagname`);

--
-- Indizes für die Tabelle `tagszupost`
--
ALTER TABLE `tagszupost`
  ADD PRIMARY KEY (`idTagsZuPost`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
