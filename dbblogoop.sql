-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Gegenereerd op: 12 jun 2020 om 13:29
-- Serverversie: 8.0.18
-- PHP-versie: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbblogoop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_id` (`photo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`id`, `photo_id`, `author`, `body`) VALUES
(1, 5, 'TommyR', 'Lorem ipsum Photo 5'),
(6, 5, 'dqwd', 'dwqd');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `alternate_text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `photos`
--

INSERT INTO `photos` (`id`, `title`, `description`, `filename`, `type`, `size`, `caption`, `alternate_text`) VALUES
(5, 'Little Blessings Icon', '', 'favicon wendy.png', 'image/png', 1269588, 'Visit https://www.little-blessings.be', ''),
(7, 'Belgium Flag', '', 'Flag_of_Belgium.svg', 'image/svg+xml', 182, 'Vlag van België in al zijn glorie', ''),
(8, 'Antideptressiva', 'Lijst met alle soorten antidepressiva', 'Antidepressiva.jpg', 'image/jpeg', 129317, 'Lijst Antidepressiva', 'Geen');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `user_image`) VALUES
(1, 'TommyR', 'kek', 'Tommy', 'Rooryck', 'avatar.png'),
(2, 'TyeishaV', 'lol', 'Tyeisha', 'Vansevenhant', ''),
(14, '14', 'test123', 'Jax', 'Test', 'avatar3.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
