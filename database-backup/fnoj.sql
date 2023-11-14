-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 nov 2023 om 15:09
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fnoj`
--
CREATE DATABASE IF NOT EXISTS `fnoj` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fnoj`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `visits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `description`, `visits`) VALUES
(0, 'VHS Tapes', 'categories/VHS.jpg', 'The treasures that contain the lore of the universe of five nights at freddy\'s. All the stories about the characters can be found in these tapes. Some say these are cursed, that if you would watch these, you\'re the next victim.', 0),
(1, 'non-canon', 'categories/non-canon.jpg', 'All the fnaf content that is not in a direct relation to the official five nights at freddy\'s lore.', 0),
(2, 'Game characters', 'categories/characters.jpg', 'All of the five nights at freddy\'s characters that can be found in the official games.  ', 0),
(3, 'Official games', 'categories/official_games.jpg', 'All of the main five night at freddy games that have been made by Scott Cawthon. These may include fnaf-related games he has worked on with others.', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `visits` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `name`, `picture`, `description`, `visits`, `category_id`) VALUES
<<<<<<< Updated upstream
(1, 'Freddy (FNAF 1)', 'products/characters/freddy_fnaf_1.png', 'The main character of FNAF 1.<br><br> Freddy is one of the hardest characters to understand in this game, as he cannot always be seen on the camera\'s around the office. Watch out when he is around you, as otherwise you\'ll soon feel a tap on your shoulder..', 0, 2);
=======
(1, 'Freddy (FNAF 1)', 'products/characters/freddy_fnaf_1.png', 'Freddy is the main singer of his band, standing in the middle on the stage.<br><br>\r\nHe is the main character of FNAF 1.<br> Freddy is one of the hardest characters to understand in this game, as he cannot always be seen on the camera\'s around the office. Watch out when he is around you, as otherwise you\'ll soon feel a tap on your shoulder..', 0, 2),
(2, 'Chica (FNAF 1)', 'products/characters/chica_fnaf_1.png', 'Chica is the backup singer in freddy\'s band, on the right side of the stage.<br><br> In the game chica mostly can be heard in the kitchen, and otherwise appears at the right door.', 0, 2),
(3, 'Bonnie (FNAF 1)', 'products/characters/bonnie_fnaf_1.png', 'Bonnie is the guitarist in freddy\'s band, appearing on the left side of the stage.<br><br> In the game bonnie appears in the left door, and is known for standing in the closet.', 0, 2),
(4, 'Foxy (FNAF 1)', 'products/characters/foxy_fnaf_1.png', 'Foxy is a discontinued animatronic in FNAF 1. He is not visible to the public and is found on his own stage, called \'pirates cove\'.<br><br>\r\nIn the game, foxy has one of the hardest mechanics. If you keep your eye off of him for too long, he\'ll be in your office in no time.', 0, 2),
(5, 'Golden Freddy (FNAF 1)', 'products/characters/golden_freddy_fnaf_1.png', 'Golden Freddy is a discontinued animatronic, who was formerly a mascot at Fredbear\'s Family Diner.<br><br>\r\nGolden Freddy is an easter egg in the FNAF 1 game, who rarely appears during gameplay. If you see him in the night, all hope is lost and he will kill you within seconds.<br><b>UNLESS you look at the cameras fast enough. This gives you the chance to most likely dodge him in that case.</b> ', 0, 2);
>>>>>>> Stashed changes

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
