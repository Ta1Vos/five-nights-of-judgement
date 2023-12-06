-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 06 dec 2023 om 14:05
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
(0, 'VHS Tapes', 'categories/VHS.jpg', 'The treasures that contain the lore of the universe of five nights at freddy\'s. All the stories about the characters can be found in these tapes. Some say these are cursed, that if you would watch these, you\'re the next victim.', 1),
(1, 'non-canon', 'categories/non-canon.jpg', 'All the fnaf content that is not in a direct relation to the official five nights at freddy\'s lore.', 1),
(2, 'Game characters', 'categories/characters.jpg', 'All of the five nights at freddy\'s characters that can be found in the official games.  ', 17),
(3, 'Official games', 'categories/official_games.jpg', 'All of the main five night at freddy games that have been made by Scott Cawthon. These may include fnaf-related games he has worked on with others.', 2);

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
(1, 'Freddy (FNAF 1)', 'products/characters/freddy_fnaf_1.png', 'Freddy is the main singer of his band, standing in the middle on the stage.\r\n<h5>Game Mechanics</h5>\r\nHe is the main character of FNAF 1.<br> Freddy is one of the hardest characters to understand in this game, as he cannot always be seen on the camera\'s around the office. Watch out when he is around you, as otherwise you\'ll soon feel a tap on your shoulder..\r\n<br><br>\r\nYou will know where he is, by listening to his laugh, which will gradually move away or get closer to the office.', 1, 2),
(2, 'Chica (FNAF 1)', 'products/characters/chica_fnaf_1.png', 'Chica is the backup singer in freddy\'s band, on the right side of the stage.\r\n<h5>Game Mechanics</h5>\r\nIn the game chica mostly can be heard in the kitchen, and otherwise appears at the right door.', 4, 2),
(3, 'Bonnie (FNAF 1)', 'products/characters/bonnie_fnaf_1.png', 'Bonnie is the guitarist in freddy\'s band, appearing on the left side of the stage.<h5>Game Mechanics</h5>\r\nIn the game bonnie appears in the left door, and is known for standing in the closet.', 1, 2),
(4, 'Foxy (FNAF 1)', 'products/characters/foxy_fnaf_1.png', 'Foxy is a discontinued animatronic in FNAF 1. He is not visible to the public and is found on his own stage, called \'pirates cove\'.\r\n<h5>Game Mechanics</h5>\r\n\r\nIn the game, foxy has one of the hardest mechanics. If you keep your eye off of him for too long, he\'ll be in your office in no time.', 0, 2),
(5, 'Golden Freddy (FNAF 1)', 'products/characters/golden_freddy_fnaf_1.png', 'Golden Freddy is a discontinued animatronic, who was formerly a mascot at Fredbear\'s Family Diner.\r\n<h5>Game Mechanics</h5>\r\nGolden Freddy is an easter egg in the FNAF 1 game, who rarely appears during gameplay. If you see him in the night, all hope is lost and he will kill you within seconds.<br><b>UNLESS you look at the cameras fast enough. This gives you the chance to most likely dodge him in that case.</b> ', 0, 2),
(6, 'Toy Freddy (FNAF 2)', 'products/characters/toy_freddy_fnaf_2.png', 'Toy Freddy is the main mascot in the reopening of Freddy Fazbear\'s pizzeria in 1987.\r\n<h5>Game Mechanics</h5>\r\nIn the game, Toy Freddy is the most active in the first two nights. Upon appearance of Toy Freddy, he can be found leaning in into the office, before he would enter it. Putting on the freddy mask would send him back to the stage.', 0, 2),
(7, 'Toy Chica (FNAF 2)', 'products/characters/toy_chica_fnaf_2.png', 'Toy chica is a redesigned version of chica from FNAF 1. \r\n<br><br>\r\n<h5>Game Mechanics</h5>\r\nIn the game, toy chica becomes active since night 1. She will become more active in and after night 3 or 4.\r\n<br><br>\r\nToy chica usually comes into the office through the left vent and can sometimes be seen in the hallway.\r\n<br><br>\r\nTo prevent her from jumpscaring you, you will have to put on the freddy mask, just like most of the animatronics.\r\n', 2, 2),
(8, 'Toy Bonnie (FNAF 2)', 'products/characters/toy_bonnie_fnaf_2.png', 'Toy bonnie is a redesigned version of bonnie from FNAF 1. \r\n<h5>Game Mechanics</h5>\r\nToy Bonnie always enters the office through the Right Air Vent, from Party Room 2 into the office.\r\n<br><br>\r\nTo prevent him from jumpscaring you when he enters your blind spot, you will have to put on the freddy mask, just like most of the animatronics.', 1, 2),
(9, 'Toy Foxy/Mangle (FNAF 2)', 'products/characters/mangle_fnaf_2.png', 'The new version of Foxy, initially intended as a \"take-apart-and-put-back-together attraction.\r\n<h5>Game Mechanics</h5>\r\nMangle starts in Kid\'s Cove but becomes more active as the nights go on. Keep an eye on the hallway using the flashlight and use the Freddy Fazbear Head if Mangle is in the vent.', 0, 2),
(10, 'Balloon Boy/BB (FNAF 2)', 'products/characters/balloon_boy_fnaf_2.png', 'Balloon Boy, or BB for short, appears as an animatronic boy at FNAF 2. He holds a balloon in his right hand and a sign with the letters \'Baloons!\' on it.\r\n<h5>Game Mechanics</h5>\r\nBB disables the flashlight, making it easier for other animatronics to attack. Use the mask to deter him when he\'s in the office.', 0, 2),
(11, 'The Puppet/Marionette (FNAF 2)', 'products/characters/puppet_fnaf_2.png', 'An omnious puppet hiding inside of a large present, the puppet appears as a tall figure looking like a mime.\r\n<h5>Game mechanics</h5>\r\nThe Puppet becomes active if you don\'t wind the music box in the Prize Corner. Keep the music box wound up to prevent it from leaving the box and attacking.\r\n<br><br>\r\nOnce the music box has run out, there is no more saving you.', 0, 2),
(12, 'Withered Freddy (FNAF 2)', 'products/characters/withered_freddy_fnaf_2.png', 'Withered Freddy appears as the broken version of Freddy from FNAF 1. His face is not entirely covered, thus revealing his endoskeleton.\r\n<h5>Game Mechanics</h5>\r\nWithered Freddy starts in the Parts/Service room and becomes active as the nights progress. He moves through various rooms towards the player\'s location.\r\n<br><br>\r\nMonitor Withered Freddy on the cameras and use the Freddy Fazbear Head when he\'s close to the office. Failure to do so may result in an attack.', 0, 2),
(13, 'Withered Chica (FNAF 2)', 'products/characters/withered_chica_fnaf_2.png', 'Withered Chica appears as a deteriorated and damaged version of Chica from FNAF 1. She is missing her hands and has a gaping jaw, revealing her sharp teeth.\r\n<h5>Game Mechanics</h5>\r\nWithered Chica starts in the Parts/Service room and moves through various locations. She can approach from either the left or right hallway.\r\n<br><br>\r\nMonitor Withered Chica on the cameras and use the Freddy Fazbear Head when she\'s close to the office. React promptly to avoid an attack.', 0, 2),
(14, 'Withered Bonnie (FNAF 2)', 'products/characters/withered_bonnie_fnaf_2.png', 'Withered Bonnie appears as a tattered and damage version of Bonnie from FNAF 1. He is missing his face and arm coverings, revealing his endoskeleton.\r\n<h5>Game Mechanics</h5>\r\nWithered Bonnie begins in the Parts/Service room and roams the building. He may approach from either the left or right hallway.\r\n<br><br>\r\nKeep an eye on Withered Bonnie through the cameras and use the Freddy Fazbear Head to fend him off when he\'s near. Reacting quickly is crucial to survival.', 1, 2),
(15, 'Withered Foxy (FNAF 2)', 'products/characters/withered_foxy_fnaf_2.png', 'Withered Foxy is the worn-out version of the original Foxy from FNAF 1. His fur is torn and tattered, and his endoskeleton is exposed. Withered Foxy has a damaged eyepatch and a more menacing appearance.\r\n<h5>Game Mechanics</h5>\r\nWithered Foxy starts in the Parts/Service room and becomes active later in the game. He approaches from the hallway in a similar fashion to the original Foxy.\r\n<br><br>\r\nKeep an eye on Withered Foxy using the flashlight and the Freddy Fazbear Head. Flash the hallway to slow him down, and use the mask when he\'s at the entrance to the office.', 0, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `registered_user`
--

DROP TABLE IF EXISTS `registered_user`;
CREATE TABLE `registered_user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `registered_user`
--

INSERT INTO `registered_user` (`id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES
(1, 'Tim', 'Vos', '302196386@student.rocmondriaan.nl', 'testestest', 'member'),
(2, 'Tee', 'Vos', '302196386@student.rocmondriaan.nl', 'testestest', 'member'),
(3, 'Tim', 'Vos', '302196386@student.rocmondriaan.nl', 'testestestee', 'member'),
(4, 'Tim', 'Vos', '302196386@student.rocmondriaan.nl', 'ggggggggggggggggg', 'member'),
(5, 'Tim', 'V', '', 'Password1', 'admin');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `rating` varchar(4) NOT NULL,
  `publish_time` datetime NOT NULL,
  `product_id` int(11) NOT NULL,
  `registered_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexen voor tabel `registered_user`
--
ALTER TABLE `registered_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registered_user_id` (`registered_user_id`),
  ADD KEY `product_id` (`product_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT voor een tabel `registered_user`
--
ALTER TABLE `registered_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Beperkingen voor tabel `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`registered_user_id`) REFERENCES `registered_user` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
