-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Stř 26. dub 2023, 13:25
-- Verze serveru: 10.4.24-MariaDB
-- Verze PHP: 8.1.6

CREATE DATABASE IF NOT EXISTS `lidlrozvrh`;
USE `lidlrozvrh`;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `lidlrozvrh`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `casove_useky`
--

CREATE TABLE `casove_useky` (
  `id` int(11) NOT NULL,
  `zacatek` time NOT NULL,
  `konec` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `casove_useky`
--

INSERT INTO `casove_useky` (`id`, `zacatek`, `konec`) VALUES
(1, '08:00:00', '08:45:00'),
(2, '08:55:00', '09:40:00'),
(3, '09:50:00', '10:35:00'),
(4, '10:50:00', '11:35:00'),
(5, '11:45:00', '12:30:00'),
(6, '12:40:00', '13:25:00'),
(7, '13:35:00', '14:20:00');

-- --------------------------------------------------------

--
-- Struktura tabulky `rozvrh`
--

CREATE TABLE `rozvrh` (
  `id` int(11) NOT NULL,
  `den_v_tydnu` int(11) NOT NULL,
  `casovy_usek_id` int(11) NOT NULL,
  `zkratka_predmetu` varchar(8) NOT NULL,
  `nazev_predmetu` varchar(64) NOT NULL,
  `zkratka_vyucujiciho` varchar(8) NOT NULL,
  `jmeno_vyucujiciho` varchar(32) NOT NULL,
  `ucebna` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `rozvrh`
--

INSERT INTO `rozvrh` (`id`, `den_v_tydnu`, `casovy_usek_id`, `zkratka_predmetu`, `nazev_predmetu`, `zkratka_vyucujiciho`, `jmeno_vyucujiciho`, `ucebna`) VALUES
(7, 1, 1, '', '', '', '', ''),
(8, 1, 2, '', '', '', '', ''),
(9, 1, 3, '', '', '', '', ''),
(10, 1, 4, '', '', '', '', ''),
(11, 1, 5, '', '', '', '', ''),
(12, 1, 6, '', '', '', '', ''),
(13, 1, 7, '', '', '', '', ''),
(14, 2, 1, '', '', '', '', ''),
(15, 2, 2, '', '', '', '', ''),
(16, 2, 3, '', '', '', '', ''),
(17, 2, 4, '', '', '', '', ''),
(18, 2, 5, '', '', '', '', ''),
(19, 2, 6, '', '', '', '', ''),
(20, 2, 7, '', '', '', '', ''),
(21, 3, 1, 'PVA', 'Programovani', 'Matav', 'Matav5Gaming - Matěj Verner', '329'),
(22, 3, 2, 'PVA', 'Programovani', 'MATAV', 'Matav5Gaming - Matěj Verner', '329'),
(23, 3, 3, '', '', '', '', ''),
(24, 3, 4, '', '', '', '', ''),
(25, 3, 5, '', '', '', '', ''),
(26, 3, 6, 'WEA', 'Webovky', 'MATAV', 'Matav Gaming', '935'),
(27, 3, 7, '', '', '', '', ''),
(28, 4, 1, '', '', '', '', ''),
(29, 4, 2, '', '', '', '', ''),
(30, 4, 3, '', '', '', '', ''),
(31, 4, 4, '', '', '', '', ''),
(32, 4, 5, '', '', '', '', ''),
(33, 4, 6, '', '', '', '', ''),
(34, 4, 7, '', '', '', '', ''),
(35, 5, 1, '', '', '', '', ''),
(36, 5, 2, '', '', '', '', ''),
(37, 5, 3, '', '', '', '', ''),
(38, 5, 4, '', '', '', '', ''),
(39, 5, 5, '', '', '', '', ''),
(40, 5, 6, '', '', '', '', ''),
(41, 5, 7, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatele`
--

CREATE TABLE `uzivatele` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `heslo` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vypisuji data pro tabulku `uzivatele`
--

INSERT INTO `uzivatele` (`id`, `email`, `heslo`) VALUES
(1, 'tom@bagros.eu', '$2y$10$XFo.64OJLcX.yURHl9uKYOaj0bcKMfHBdxPsgMdjAbvq7hp7xxnsW');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `casove_useky`
--
ALTER TABLE `casove_useky`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `rozvrh`
--
ALTER TABLE `rozvrh`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_rozvrh` (`den_v_tydnu`,`casovy_usek_id`),
  ADD KEY `casovy_usek_id` (`casovy_usek_id`);

--
-- Indexy pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `casove_useky`
--
ALTER TABLE `casove_useky`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pro tabulku `rozvrh`
--
ALTER TABLE `rozvrh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pro tabulku `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `rozvrh`
--
ALTER TABLE `rozvrh`
  ADD CONSTRAINT `rozvrh_ibfk_2` FOREIGN KEY (`casovy_usek_id`) REFERENCES `casove_useky` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
