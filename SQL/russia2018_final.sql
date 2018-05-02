-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 01 mai 2018 à 15:16
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
-- CREATE DATABASE IF NOT EXISTS `russia2018` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
-- USE `russia2018`;

-- --------------------------------------------------------

--
-- Structure de la table `classements`
--

DROP TABLE IF EXISTS `classements`;
CREATE TABLE IF NOT EXISTS `classements` (
  `type` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0',
  `nb_perf` int(11) NOT NULL DEFAULT '0',
  `nb_correct_plus` int(11) NOT NULL DEFAULT '0',
  `nb_correct` int(11) NOT NULL DEFAULT '0',
  `nb_inverse` int(11) NOT NULL DEFAULT '0',
  `nb_echec` int(11) NOT NULL DEFAULT '0',
  `rang` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `classements`
--

INSERT INTO `classements` (`type`, `owner_id`, `points`, `bonus`, `nb_perf`, `nb_correct_plus`, `nb_correct`, `nb_inverse`, `nb_echec`, `rang`) VALUES
('general', 1, 0, 0, 0, 0, 0, 0, 0, 1),
('montagne', 1, 0, 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `coequipiers`
--

DROP TABLE IF EXISTS `coequipiers`;
CREATE TABLE IF NOT EXISTS `coequipiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

DROP TABLE IF EXISTS `demandes`;
CREATE TABLE IF NOT EXISTS `demandes` (
  `id_demande` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `prenom` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `surnom` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `mail` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `telephone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `payement` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(4024) COLLATE latin1_general_ci NOT NULL,
  `id_joueur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_demande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

DROP TABLE IF EXISTS `equipes`;
CREATE TABLE IF NOT EXISTS `equipes` (
  `id_equipe` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `group` varchar(1) COLLATE latin1_general_ci NOT NULL,
  `image` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `logo` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT 'images\\logo\\',
  PRIMARY KEY (`id_equipe`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id_equipe`, `name`, `group`, `image`, `logo`) VALUES
(1, 'Russie', 'A', '', 'images\\logo\\rus.png'),
(2, 'Arabie Saoudite', 'A', '', 'images\\logo\\ksa.png'),
(3, 'Egypte', 'A', '', 'images\\logo\\egy.png'),
(4, 'Uruguay', 'A', '', 'images\\logo\\uru.png'),
(5, 'Maroc', 'B', '', 'images\\logo\\mar.png'),
(6, 'Iran', 'B', '', 'images\\logo\\irn.png'),
(7, 'Portugal', 'B', '', 'images\\logo\\por.png'),
(8, 'Espagne', 'B', '', 'images\\logo\\esp.png'),
(9, 'France', 'C', '', 'images\\logo\\fra.png'),
(10, 'Australie', 'C', '', 'images\\logo\\aus.png'),
(11, 'Pérou', 'C', '', 'images\\logo\\per.png'),
(12, 'Danemark', 'C', '', 'images\\logo\\den.png'),
(13, 'Argentine', 'D', '', 'images\\logo\\arg.png'),
(14, 'Islande', 'D', '', 'images\\logo\\isl.png'),
(15, 'Croatie', 'D', '', 'images\\logo\\cro.png'),
(16, 'Nigeria', 'D', '', 'images\\logo\\nga.png'),
(17, 'Costa Rica', 'E', '', 'images\\logo\\crc.png'),
(18, 'Serbie', 'E', '', 'images\\logo\\srb.png'),
(19, 'Brésil', 'E', '', 'images\\logo\\bra.png'),
(20, 'Suisse', 'E', '', 'images\\logo\\sui.png'),
(21, 'Allemagne', 'F', '', 'images\\logo\\ger.png'),
(22, 'Mexique', 'F', '', 'images\\logo\\mex.png'),
(23, 'Suède', 'F', '', 'images\\logo\\swe.png'),
(24, 'Corée du Sud', 'F', '', 'images\\logo\\kor.png'),
(25, 'Belgique', 'G', '', 'images\\logo\\bel.png'),
(26, 'Panama', 'G', '', 'images\\logo\\pan.png'),
(27, 'Tunisie', 'G', '', 'images\\logo\\tun.png'),
(28, 'Angleterre', 'G', '', 'images\\logo\\eng.png'),
(29, 'Colombie', 'H', '', 'images\\logo\\col.png'),
(30, 'Japon', 'H', '', 'images\\logo\\jpn.png'),
(31, 'Pologne', 'H', '', 'images\\logo\\pol.png'),
(32, 'Sénégal', 'H', '', 'images\\logo\\sen.png');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `attribut` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`attribut`, `value`) VALUES
('PRONOS_BONUS', 1),
('PRONOS', 1);

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

DROP TABLE IF EXISTS `joueurs`;
CREATE TABLE IF NOT EXISTS `joueurs` (
  `id_joueur` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nom` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `surnom` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `image` varchar(300) COLLATE latin1_general_ci DEFAULT 'images/user/default.jpg',
  `departement` int(6) DEFAULT NULL,
  `telephone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `payed` tinyint(1) NOT NULL DEFAULT '0',
  `updated` tinyint(1) NOT NULL DEFAULT '0',
  `female` tinyint(1) NOT NULL DEFAULT '0',
  `modif_profil` tinyint(1) NOT NULL DEFAULT '0',
  `modif_match` tinyint(1) NOT NULL DEFAULT '0',
  `modif_bonus` tinyint(1) NOT NULL DEFAULT '0',
  `description` varchar(4024) COLLATE latin1_general_ci DEFAULT NULL,
  `equipe` int(11) DEFAULT NULL,
  `oauth` enum('Yes','No') COLLATE latin1_general_ci NOT NULL DEFAULT 'No',
  `status` enum('active','inactive') COLLATE latin1_general_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id_joueur`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Déchargement des données de la table `joueurs`
--

INSERT INTO `joueurs` (`id_joueur`, `prenom`, `nom`, `surnom`, `email`, `password`, `image`, `departement`, `telephone`, `payed`, `updated`, `female`, `modif_profil`, `modif_match`, `modif_bonus`, `description`, `equipe`, `oauth`, `status`) VALUES
(1, 'Florian ', 'Jousseau', 'La Flouf', 'f.jousseau@gmail.com', 'admin', 'images/user/18260_10200113693266289_1751359165_n.jpg', 94, '0760851992', 0, 0, 0, 0, 0, 0, 'Président directeur général de la Odette Cup', NULL, 'No', 'active');

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
(1, 1, 2, 1, 1, '2018-06-14 17:00:00', 'Stade Loujniki', 'BeIn - TF1', 0, 1, 'A', 0, 0),
(2, 3, 4, 0, 0, '2018-06-15 14:00:00', 'Iekaterinbourg Arena', 'BeIn', 0, 1, 'A', 0, 0),
(3, 5, 6, 0, 0, '2018-06-15 17:00:00', 'Stade de Saint-Pétersbourg', 'BeIn', 0, 1, 'B', 0, 0),
(4, 7, 8, 0, 0, '2018-06-15 20:00:00', 'Stade Ficht', 'BeIn - TF1', 0, 1, 'B', 0, 1),
(5, 9, 10, 0, 0, '2018-06-16 12:00:00', 'Kazan Arena', 'BeIn - TF1', 0, 1, 'C', 0, 0),
(6, 13, 14, 0, 0, '2018-06-16 15:00:00', 'Stade du Spartak', 'BeIn', 0, 1, 'D', 0, 0),
(7, 11, 12, 0, 0, '2018-06-16 18:00:00', 'Stade de Mordovie', 'BeIn', 0, 1, 'C', 0, 1),
(8, 15, 16, 0, 0, '2018-06-16 20:00:00', 'Stade de Kaliningrad', 'BeIn - TF1', 0, 1, 'D', 0, 0),
(9, 17, 18, 0, 0, '2018-06-17 15:00:00', 'Samara Arena', 'BeIn', 0, 1, 'E', 0, 0),
(10, 21, 22, 0, 0, '2018-06-17 17:00:00', 'Stade Loujniki', 'BeIn - TF1', 0, 1, 'F', 0, 0),
(11, 19, 20, 0, 0, '2018-06-17 20:00:00', 'Rostov Arena', 'BeIn - TF1', 0, 1, 'E', 0, 0),
(12, 23, 24, 0, 0, '2018-06-18 14:00:00', 'Stade de Nijni-Novgorod', 'BeIn', 0, 1, 'F', 0, 1),
(13, 25, 26, 0, 0, '2018-06-18 17:00:00', 'Stade Ficht', 'BeIn', 0, 1, 'G', 0, 0),
(14, 27, 28, 0, 0, '2018-06-18 20:00:00', 'Volgograd Arena', 'BeIn - TF1', 0, 1, 'G', 0, 0),
(15, 29, 30, 0, 0, '2018-06-19 14:00:00', 'Stade de Mordovie', 'BeIn', 0, 1, 'H', 0, 0),
(16, 31, 32, 0, 0, '2018-06-19 17:00:00', 'Stade du Spartak', 'BeIn', 0, 1, 'H', 0, 0),
(17, 1, 3, 0, 0, '2018-06-19 20:00:00', 'Stade de Saint-Pétersbourg', 'BeIn', 0, 1, 'A', 0, 1),
(18, 7, 5, 0, 0, '2018-06-20 14:00:00', 'Stade Loujniki', 'BeIn', 0, 1, 'B', 0, 0),
(19, 4, 2, 0, 0, '2018-06-20 17:00:00', 'Rostov Arena', 'BeIn', 0, 1, 'A', 0, 0),
(20, 6, 8, 0, 0, '2018-06-20 20:00:00', 'Kazan Arena', 'BeIn', 0, 1, 'B', 0, 0),
(21, 12, 10, 0, 0, '2018-06-21 15:00:00', 'Samara Arena', 'BeIn', 0, 1, 'C', 0, 0),
(22, 9, 11, 0, 0, '2018-06-21 17:00:00', 'Iekaterinbourg Arena', 'BeIn - TF1', 0, 1, 'C', 0, 0),
(23, 13, 15, 0, 0, '2018-06-21 20:00:00', 'Stade de Nijni-Novgorod', 'BeIn - TF1', 0, 1, 'D', 0, 0),
(24, 19, 17, 0, 0, '2018-06-22 14:00:00', 'Stade de Saint-Pétersbourg', 'BeIn', 0, 1, 'E', 0, 0),
(25, 16, 14, 0, 0, '2018-06-22 17:00:00', 'Volgograd Arena', 'BeIn', 0, 1, 'D', 0, 1),
(26, 18, 20, 0, 0, '2018-06-22 20:00:00', 'Stade de Kaliningrad', 'BeIn', 0, 1, 'E', 0, 1),
(27, 25, 27, 0, 0, '2018-06-23 14:00:00', 'Stade du Spartak', 'BeIn', 0, 1, 'G', 0, 0),
(28, 24, 22, 0, 0, '2018-06-23 17:00:00', 'Rostov Arena', 'BeIn', 0, 1, 'F', 0, 0),
(29, 21, 23, 0, 0, '2018-06-23 20:00:00', 'Stade Ficht', 'BeIn - TF1', 0, 1, 'F', 0, 0),
(30, 28, 26, 0, 0, '2018-06-24 14:00:00', 'Stade de Nijni-Novgorod', 'BeIn', 0, 1, 'G', 0, 0),
(31, 30, 32, 0, 0, '2018-06-24 19:00:00', 'Iekaterinbourg Arena', 'BeIn', 0, 1, 'H', 0, 1),
(32, 31, 29, 0, 0, '2018-06-24 20:00:00', 'Kazan Arena', 'BeIn - TF1', 0, 1, 'H', 0, 1),
(33, 4, 1, 0, 0, '2018-06-25 17:00:00', 'Samara Arena', 'BeIn', 0, 1, 'A', 0, 1),
(34, 2, 3, 0, 0, '2018-06-25 16:00:00', 'Volgograd Arena', 'BeIn', 0, 1, 'A', 0, 0),
(35, 6, 7, 0, 0, '2018-06-25 20:00:00', 'Stade de Mordovie', 'BeIn', 0, 1, 'B', 0, 0),
(36, 8, 5, 0, 0, '2018-06-25 19:00:00', 'Stade de Kaliningrad', 'BeIn', 0, 1, 'B', 0, 0),
(37, 12, 9, 0, 0, '2018-06-26 16:00:00', 'Stade Loujniki', 'BeIn - TF1', 0, 1, 'C', 0, 0),
(38, 10, 11, 0, 0, '2018-06-26 16:00:00', 'Stade Ficht', 'BeIn', 0, 1, 'C', 0, 0),
(39, 16, 13, 0, 0, '2018-06-26 20:00:00', 'Stade de Saint-Pétersbourg', 'BeIn - TF1', 0, 1, 'D', 0, 0),
(40, 14, 16, 0, 0, '2018-06-26 20:00:00', 'Rostov Arena', 'BeIn - TF1', 0, 1, 'D', 0, 0),
(41, 22, 23, 0, 0, '2018-06-27 18:00:00', 'Iekaterinbourg Arena', 'BeIn', 0, 1, 'F', 0, 1),
(42, 24, 21, 0, 0, '2018-06-27 16:00:00', 'Kazan Arena', 'BeIn', 0, 1, 'F', 0, 0),
(43, 18, 19, 0, 0, '2018-06-27 20:00:00', 'Stade du Spartak', 'BeIn - TF1', 0, 1, 'E', 0, 0),
(44, 20, 17, 0, 0, '2018-06-27 20:00:00', 'Stade de Nijni-Novgorod', 'BeIn - TF1', 0, 1, 'E', 0, 0),
(45, 30, 31, 0, 0, '2018-06-28 16:00:00', 'Volgograd Arena', 'BeIn', 0, 1, 'H', 0, 0),
(46, 32, 29, 0, 0, '2018-06-28 17:00:00', 'Samara Arena', 'BeIn', 0, 1, 'H', 0, 0),
(47, 26, 27, 0, 0, '2018-06-28 20:00:00', 'Stade de Mordovie', 'BeIn - TF1', 0, 1, 'G', 0, 0),
(48, 28, 25, 0, 0, '2018-06-28 19:00:00', 'Stade de Kaliningrad', 'BeIn - TF1', 0, 1, 'G', 0, 1),
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

-- --------------------------------------------------------

--
-- Structure de la table `pronostics`
--

DROP TABLE IF EXISTS `pronostics`;
CREATE TABLE IF NOT EXISTS `pronostics` (
  `id_pronostic` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `id_match` int(11) NOT NULL,
  `prono_home` int(11) NOT NULL,
  `prono_away` int(11) NOT NULL,
  `point` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pronostic`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pronostics_bonus`
--

DROP TABLE IF EXISTS `pronostics_bonus`;
CREATE TABLE IF NOT EXISTS `pronostics_bonus` (
  `id_membre` int(11) NOT NULL,
  `team_winner_id` int(11) NOT NULL,
  `team_winner_id_point` int(4) NOT NULL DEFAULT '-1',
  `min_first` int(11) NOT NULL,
  `min_first_point` int(4) NOT NULL DEFAULT '-1',
  `min_last` int(11) NOT NULL,
  `min_last_point` int(4) NOT NULL DEFAULT '-1',
  `total_but` int(11) NOT NULL,
  `total_but_point` int(4) NOT NULL DEFAULT '-1',
  `best_scorer` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `best_scorer_point` int(4) NOT NULL DEFAULT '-1',
  `modif` int(11) NOT NULL DEFAULT '1',
  UNIQUE KEY `id_membre` (`id_membre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
