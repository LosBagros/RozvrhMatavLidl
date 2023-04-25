SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `casove_useky` (
  `id` int(11) NOT NULL,
  `zacatek` time NOT NULL,
  `konec` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `casove_useky` (`id`, `zacatek`, `konec`) VALUES
(2, '07:10:00', '07:55:00'),
(3, '08:00:00', '08:45:00'),
(4, '08:55:00', '09:40:00'),
(5, '09:50:00', '10:35:00'),
(6, '10:50:00', '11:35:00'),
(7, '11:45:00', '12:30:00'),
(8, '12:40:00', '13:25:00'),
(9, '13:35:00', '14:20:00');

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

INSERT INTO `rozvrh` (`id`, `den_v_tydnu`, `casovy_usek_id`, `zkratka_predmetu`, `nazev_predmetu`, `zkratka_vyucujiciho`, `jmeno_vyucujiciho`, `ucebna`) VALUES
(1, 2, 4, 'PVA', 'Programovani', 'MATAV', 'Matej Verner', '329'),
(3, 1, 5, 'DAS', 'Datove Site', 'Mit', 'Jiri Costa Mit', '221'),
(4, 1, 6, '123', '123', '123', '123', '123'),
(5, 2, 5, '456', '456', '456', '465', '456');

CREATE TABLE `uzivatele` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `heslo` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `uzivatele` (`id`, `email`, `heslo`) VALUES
(1, 'tom@bagros.eu', '$2y$10$XFo.64OJLcX.yURHl9uKYOaj0bcKMfHBdxPsgMdjAbvq7hp7xxnsW');


ALTER TABLE `casove_useky`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `rozvrh`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_rozvrh` (`den_v_tydnu`,`casovy_usek_id`),
  ADD KEY `casovy_usek_id` (`casovy_usek_id`);

ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `casove_useky`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `rozvrh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `uzivatele`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `rozvrh`
  ADD CONSTRAINT `rozvrh_ibfk_2` FOREIGN KEY (`casovy_usek_id`) REFERENCES `casove_useky` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
