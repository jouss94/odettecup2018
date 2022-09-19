-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 05 avr. 2018 à 12:48
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `russia2018`
--

-- --------------------------------------------------------

--
-- Structure de la table `matches`
--

DROP TABLE IF EXISTS `matches`;
CREATE TABLE IF NOT EXISTS `matches` (
  `id_match` int(11) NOT NULL AUTO_INCREMENT,
  `id_team_home` int(11) NOT NULL,
  `id_team_away` int(11) NOT NULL,
  `score_home` int(11) NOT NULL DEFAULT '0',
  `score_away` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `stadium` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `diff` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT 'BeIn',
  `played` tinyint(1) NOT NULL DEFAULT '0',
  `modif` tinyint(1) NOT NULL DEFAULT '1',
  `groupe` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `phased` tinyint(1) NOT NULL DEFAULT '0',
  `montagne` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_match`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `matches`
--

INSERT INTO `matches` (`id_match`, `id_team_home`, `id_team_away`, `score_home`, `score_away`, `date`, `stadium`, `diff`, `played`, `modif`, `groupe`, `phased`, `montagne`) VALUES
(1, 1, 2, 0, 0, '2018-06-14 17:00:00', 'Stade Loujniki', 'BeIn - TF1', 0, 1, 'A', 0, 0),
(2, 3, 4, 0, 0, '2018-06-15 14:00:00', 'Iekaterinbourg Arena', 'BeIn', 0, 1, 'A', 0, 0),
(3, 5, 6, 0, 0, '2018-06-15 17:00:00', 'Stade de Saint-Pétersbourg', 'BeIn', 0, 1, 'B', 0, 0),
(4, 7, 8, 0, 0, '2018-06-15 20:00:00', 'Stade Ficht', 'BeIn - TF1', 0, 1, 'B', 0, 0),
(5, 9, 10, 0, 0, '2018-06-16 12:00:00', 'Kazan Arena', 'BeIn - TF1', 0, 1, 'C', 0, 0),
(6, 13, 14, 0, 0, '2018-06-16 15:00:00', 'Stade du Spartak', 'BeIn', 0, 1, 'D', 0, 0),
(7, 11, 12, 0, 0, '2018-06-16 18:00:00', 'Stade de Mordovie', 'BeIn', 0, 1, 'C', 0, 0),
(8, 15, 16, 0, 0, '2018-06-16 20:00:00', 'Stade de Kaliningrad', 'BeIn - TF1', 0, 1, 'D', 0, 0),
(9, 17, 18, 0, 0, '2018-06-17 15:00:00', 'Samara Arena', 'BeIn', 0, 1, 'E', 0, 0),
(10, 21, 22, 0, 0, '2018-06-17 17:00:00', 'Stade Loujniki', 'BeIn - TF1', 0, 1, 'F', 0, 0),
(11, 19, 20, 0, 0, '2018-06-17 20:00:00', 'Rostov Arena', 'BeIn - TF1', 0, 1, 'E', 0, 0),
(12, 23, 24, 0, 0, '2018-06-18 14:00:00', 'Stade de Nijni-Novgorod', 'BeIn', 0, 1, 'F', 0, 0),
(13, 25, 26, 0, 0, '2018-06-18 17:00:00', 'Stade Ficht', 'BeIn', 0, 1, 'G', 0, 0),
(14, 27, 28, 0, 0, '2018-06-18 20:00:00', 'Volgograd Arena', 'BeIn - TF1', 0, 1, 'G', 0, 0),
(15, 29, 30, 0, 0, '2018-06-19 14:00:00', 'Stade de Mordovie', 'BeIn', 0, 1, 'H', 0, 0),
(16, 31, 32, 0, 0, '2018-06-19 17:00:00', 'Stade du Spartak', 'BeIn', 0, 1, 'H', 0, 0),
(17, 1, 3, 0, 0, '2018-06-19 20:00:00', 'Stade de Saint-Pétersbourg', 'BeIn', 0, 1, 'A', 0, 0),
(18, 7, 5, 0, 0, '2018-06-20 14:00:00', 'Stade Loujniki', 'BeIn', 0, 1, 'B', 0, 0),
(19, 4, 2, 0, 0, '2018-06-20 17:00:00', 'Rostov Arena', 'BeIn', 0, 1, 'A', 0, 0),
(20, 6, 8, 0, 0, '2018-06-20 20:00:00', 'Kazan Arena', 'BeIn', 0, 1, 'B', 0, 0),
(21, 12, 10, 0, 0, '2018-06-21 15:00:00', 'Samara Arena', 'BeIn', 0, 1, 'C', 0, 0),
(22, 9, 11, 0, 0, '2018-06-21 17:00:00', 'Iekaterinbourg Arena', 'BeIn - TF1', 0, 1, 'C', 0, 0),
(23, 13, 15, 0, 0, '2018-06-21 20:00:00', 'Stade de Nijni-Novgorod', 'BeIn - TF1', 0, 1, 'D', 0, 0),
(24, 19, 17, 0, 0, '2018-06-22 14:00:00', 'Stade de Saint-Pétersbourg', 'BeIn', 0, 1, 'E', 0, 0),
(25, 16, 14, 0, 0, '2018-06-22 17:00:00', 'Volgograd Arena', 'BeIn', 0, 1, 'D', 0, 0),
(26, 18, 20, 0, 0, '2018-06-22 20:00:00', 'Stade de Kaliningrad', 'BeIn', 0, 1, 'E', 0, 0),
(27, 25, 27, 0, 0, '2018-06-23 14:00:00', 'Stade du Spartak', 'BeIn', 0, 1, 'G', 0, 0),
(28, 24, 22, 0, 0, '2018-06-23 17:00:00', 'Rostov Arena', 'BeIn', 0, 1, 'F', 0, 0),
(29, 21, 23, 0, 0, '2018-06-23 20:00:00', 'Stade Ficht', 'BeIn - TF1', 0, 1, 'F', 0, 0),
(30, 28, 26, 0, 0, '2018-06-24 14:00:00', 'Stade de Nijni-Novgorod', 'BeIn', 0, 1, 'G', 0, 0),
(31, 30, 32, 0, 0, '2018-06-24 19:00:00', 'Iekaterinbourg Arena', 'BeIn', 0, 1, 'H', 0, 0),
(32, 31, 29, 0, 0, '2018-06-24 20:00:00', 'Kazan Arena', 'BeIn - TF1', 0, 1, 'H', 0, 0),
(33, 4, 1, 0, 0, '2018-06-25 17:00:00', 'Samara Arena', 'BeIn', 0, 1, 'A', 0, 0),
(34, 2, 3, 0, 0, '2018-06-25 16:00:00', 'Volgograd Arena', 'BeIn', 0, 1, 'A', 0, 0),
(35, 6, 7, 0, 0, '2018-06-25 20:00:00', 'Stade de Mordovie', 'BeIn', 0, 1, 'B', 0, 0),
(36, 8, 5, 0, 0, '2018-06-25 19:00:00', 'Stade de Kaliningrad', 'BeIn', 0, 1, 'B', 0, 0),
(37, 12, 9, 0, 0, '2018-06-26 16:00:00', 'Stade Loujniki', 'BeIn - TF1', 0, 1, 'C', 0, 0),
(38, 10, 11, 0, 0, '2018-06-26 16:00:00', 'Stade Ficht', 'BeIn', 0, 1, 'C', 0, 0),
(39, 16, 13, 0, 0, '2018-06-26 20:00:00', 'Stade de Saint-Pétersbourg', 'BeIn - TF1', 0, 1, 'D', 0, 0),
(40, 14, 16, 0, 0, '2018-06-26 20:00:00', 'Rostov Arena', 'BeIn - TF1', 0, 1, 'D', 0, 0),
(41, 22, 23, 0, 0, '2018-06-27 18:00:00', 'Iekaterinbourg Arena', 'BeIn', 0, 1, 'F', 0, 0),
(42, 24, 21, 0, 0, '2018-06-27 16:00:00', 'Kazan Arena', 'BeIn', 0, 1, 'F', 0, 0),
(43, 18, 19, 0, 0, '2018-06-27 20:00:00', 'Stade du Spartak', 'BeIn - TF1', 0, 1, 'E', 0, 0),
(44, 20, 17, 0, 0, '2018-06-27 20:00:00', 'Stade de Nijni-Novgorod', 'BeIn - TF1', 0, 1, 'E', 0, 0),
(45, 30, 31, 0, 0, '2018-06-28 16:00:00', 'Volgograd Arena', 'BeIn', 0, 1, 'H', 0, 0),
(46, 32, 29, 0, 0, '2018-06-28 17:00:00', 'Samara Arena', 'BeIn', 0, 1, 'H', 0, 0),
(47, 26, 27, 0, 0, '2018-06-28 20:00:00', 'Stade de Mordovie', 'BeIn - TF1', 0, 1, 'G', 0, 0),
(48, 28, 25, 0, 0, '2018-06-28 19:00:00', 'Stade de Kaliningrad', 'BeIn - TF1', 0, 1, 'G', 0, 0),
(49, 1, 1, 0, 0, '2018-06-30 16:00:00', 'Kazan Arena', 'BeIn', 0, 0, '', 0, 0),
(50, 1, 1, 0, 0, '2018-06-30 20:00:00', 'Stade Ficht', 'BeIn', 0, 0, '', 0, 0),
(51, 1, 1, 0, 0, '2018-07-01 16:00:00', 'Stade Loujniki', 'BeIn', 0, 0, '', 0, 0),
(52, 1, 1, 0, 0, '2018-07-01 20:00:00', 'Stade de Nijni-Novgorod', 'BeIn', 0, 0, '', 0, 0),
(53, 1, 1, 0, 0, '2018-07-02 17:00:00', 'Samara Arena', 'BeIn', 0, 0, '', 0, 0),
(54, 1, 1, 0, 0, '2018-07-02 20:00:00', 'Rostov Arena', 'BeIn', 0, 0, '', 0, 0),
(55, 1, 1, 0, 0, '2018-07-03 16:00:00', 'Stade de Saint-Pétersbourg', 'BeIn', 0, 0, '', 0, 0),
(56, 1, 1, 0, 0, '2018-07-03 20:00:00', 'Stade du Spartak', 'BeIn', 0, 0, '', 0, 0),
(57, 1, 1, 0, 0, '2018-07-06 16:00:00', 'Stade de Nijni-Novgorod', 'BeIn', 0, 0, '', 0, 0),
(58, 1, 1, 0, 0, '2018-07-06 20:00:00', 'Kazan Arena', 'BeIn', 0, 0, '', 0, 0),
(59, 1, 1, 0, 0, '2018-07-07 16:00:00', 'Samara Arena', 'BeIn', 0, 0, '', 0, 0),
(60, 1, 1, 0, 0, '2018-07-07 20:00:00', 'Stade Ficht', 'BeIn', 0, 0, '', 0, 0),
(61, 1, 1, 0, 0, '2018-07-10 20:00:00', 'Stade de Saint-Pétersbourg', 'BeIn', 0, 0, '', 0, 0),
(62, 1, 1, 0, 0, '2018-07-11 20:00:00', 'Stade Loujniki', 'BeIn', 0, 0, '', 0, 0),
(63, 1, 1, 0, 0, '2018-07-14 16:00:00', 'Stade de Saint-Pétersbourg', 'BeIn', 0, 0, '', 0, 0),
(64, 1, 1, 0, 0, '2018-07-15 17:00:00', 'Stade Loujniki', 'BeIn', 0, 0, '', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
