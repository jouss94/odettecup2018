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
(1, 3, 1, 0, 0, '2021-06-11 21:00:00', 'Olimpico in Rome - Rome', '', 0, 1, 'A', 0, 0),
(2, 4, 2, 0, 0, '2021-06-12 15:00:00', 'Bakı Olimpiya Stadionu - Bakou', '', 0, 1, 'A', 0, 0),
(3, 6, 7, 0, 0, '2021-06-12 18:00:00', 'Parken - Copenhague', '', 0, 1, 'B', 0, 0),
(4, 5, 8, 0, 0, '2021-06-12 21:00:00', 'Gazprom Arena - Saint-Pétersbourg', '', 0, 1, 'B', 0, 0),
(11, 15, 13, 0, 0, '2021-06-13 15:00:00', 'Wembley Stadium - Londres', '', 0, 1, 'D', 0, 0),
(5, 9, 11, 0, 0, '2021-06-13 18:00:00', 'National Arena Bucharest - Bucarests', '', 0, 1, 'C', 0, 0),
(6, 10, 12, 0, 0, '2021-06-13 21:00:00', 'Johan Cruijff ArenA - Amsterdam', '', 0, 1, 'C', 0, 0),
(7, 16, 14, 0, 0, '2021-06-14 15:00:00', 'Hampden Park - Glasgow', '', 0, 1, 'D', 0, 0),
(8, 17, 18, 0, 0, '2021-06-14 18:00:00', 'Aviva Stadium - Dublin', '', 0, 1, 'E', 0, 0),
(9, 19, 20, 0, 0, '2021-06-14 21:00:00', 'Estadio de San Mamés - Bilbao', '', 0, 1, 'E', 0, 0),
(10, 23, 24, 0, 0, '2021-06-15 18:00:00', 'Puskás Aréna - Budapest', '', 0, 1, 'F', 0, 0),
(12, 21, 22, 0, 0, '2021-06-15 21:00:00', 'Allianz Arena - Munich', '', 0, 1, 'F', 0, 0),
(13, 7, 8, 0, 0, '2021-06-16 15:00:00', 'Gazprom Arena - Saint-Pétersbourg', '', 0, 1, 'B', 0, 0),
(14, 3, 4, 0, 0, '2021-06-16 18:00:00', 'Bakı Olimpiya Stadionu - Bakou', '', 0, 1, 'A', 0, 0),
(15, 1, 2, 0, 0, '2021-06-16 21:00:00', 'Olimpico in Rome - Rome', '', 0, 1, 'A', 0, 0),
(16, 12, 11, 0, 0, '2021-06-17 15:00:00', 'National Arena Bucharest - Bucarest', '', 0, 1, 'C', 0, 0),
(17, 6, 5, 0, 0, '2021-06-17 18:00:00', 'Parken - Copenhague', '', 0, 1, 'B', 0, 0),
(18, 10, 9, 0, 0, '2021-06-17 21:00:00', 'Johan Cruijff ArenA - Amsterdam', '', 0, 1, 'C', 0, 0),
(19, 20, 18, 0, 0, '2021-06-18 15:00:00', 'Aviva Stadium - Dublin', '', 0, 1, 'E', 0, 0),
(20, 13, 14, 0, 0, '2021-06-18 18:00:00', 'Hampden Park - Glasgow', '', 0, 1, 'D', 0, 0),
(21, 15, 16, 0, 0, '2021-06-18 21:00:00', 'Wembley Stadium - Londres', '', 0, 1, 'D', 0, 0),
(22, 23, 21, 0, 0, '2021-06-19 15:00:00', 'Puskás Aréna - Budapest', '', 0, 1, 'F', 0, 0),
(23, 24, 22, 0, 0, '2021-06-19 18:00:00', 'Allianz Arena - Munich', '', 0, 1, 'F', 0, 0),
(24, 19, 17, 0, 0, '2021-06-19 21:00:00', 'Estadio de San Mamés - Bilbao', '', 0, 1, 'E', 0, 0),
(25, 1, 4, 0, 0, '2021-06-20 18:00:00', 'Olimpico in Rome - Rome', '', 0, 1, 'A', 0, 0),
(26, 2, 3, 0, 0, '2021-06-20 18:00:00', 'Bakı Olimpiya Stadionu - Bakou', '', 0, 1, 'A', 0, 0),
(27, 11, 10, 0, 0, '2021-06-21 18:00:00', 'Johan Cruijff ArenA - Amsterdam', '', 0, 1, 'C', 0, 0),
(28, 12, 9, 0, 0, '2021-06-21 18:00:00', 'National Arena Bucharest - Bucarest', '', 0, 1, 'C', 0, 0),
(29, 8, 6, 0, 0, '2021-06-21 21:00:00', 'Parken - Copenhague', '', 0, 1, 'B', 0, 0), 
(30, 7, 5, 0, 0, '2021-06-21 21:00:00', 'Gazprom Arena - Saint-Pétersbourg', '', 0, 1, 'B', 0, 0), 
(31, 14, 15, 0, 0, '2021-06-22 21:00:00', 'Wembley Stadium - Londres', '', 0, 1, 'D', 0, 0), 
(32, 13, 16, 0, 0, '2021-06-22 21:00:00', 'Hampden Park - Glasgow', '', 0, 1, 'D', 0, 0), 
(33, 18, 19, 0, 0, '2021-06-23 18:00:00', 'Estadio de San Mamés - Bilbao', '', 0, 1, 'E', 0, 0), 
(34, 20, 17, 0, 0, '2021-06-23 18:00:00', 'Aviva Stadium - Dublin', '', 0, 1, 'E', 0, 0), 
(35, 22, 23, 0, 0, '2021-06-23 21:00:00', 'Allianz Arena - Munich', '', 0, 1, 'F', 0, 0), 
(36, 24, 21, 0, 0, '2021-06-23 21:00:00', 'Puskás Aréna - Budapest', '', 0, 1, 'F', 0, 0),
(37, 1, 1, 0, 0, '2021-06-26 18:00:00', 'Johan Cruijff ArenA - Amsterdam', '', 0, 0, '', 0, 0),
(38, 1, 1, 0, 0, '2021-06-26 21:00:00', 'Wembley Stadium - Londres', '', 0, 0, '', 0, 0),
(39, 1, 1, 0, 0, '2021-06-27 18:00:00', 'Puskás Aréna - Budapest', '', 0, 0, '', 0, 0),
(40, 1, 1, 0, 0, '2021-06-27 21:00:00', 'Estadio de San Mamés - Bilbao', '', 0, 0, '', 0, 0),
(41, 1, 1, 0, 0, '2021-06-28 18:00:00', 'Parken - Copenhague', '', 0, 0, '', 0, 0),
(42, 1, 1, 0, 0, '2021-06-28 21:00:00', 'National Arena Bucharest - Bucarest', '', 0, 0, '', 0, 0),
(43, 1, 1, 0, 0, '2021-06-29 18:00:00', 'Aviva Stadium - Dublin', '', 0, 0, '', 0, 0),
(44, 1, 1, 0, 0, '2021-06-29 21:00:00', 'Hampden Park - Glasgow', '', 0, 0, '', 0, 0),0
(45, 1, 1, 0, 0, '2021-07-02 18:00:00', 'Gazprom Arena - Saint-Pétersbourg', '', 0, 0, '', 0, 0),
(46, 1, 1, 0, 0, '2021-07-02 21:00:00', 'Allianz Arena - Munich', '', 0, 0, '', 0, 0),
(47, 1, 1, 0, 0, '2021-07-03 18:00:00', 'Bakı Olimpiya Stadionu - Bakou', '', 0, 0, '', 0, 0),
(48, 1, 1, 0, 0, '2021-07-03 21:00:00', 'Olimpico in Rome - Rome', '', 0, 0, '', 0, 0),
(49, 1, 1, 0, 0, '2021-07-06 21:00:00', 'Wembley Stadium - Londres', '', 0, 0, '', 0, 0),
(50, 1, 1, 0, 0, '2021-07-07 21:00:00', 'Wembley Stadium - Londres', '', 0, 0, '', 0, 0),
(51, 1, 1, 0, 0, '2021-07-11 21:00:00', 'Wembley Stadium - Londres', '', 0, 0, '', 0, 0);


;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
