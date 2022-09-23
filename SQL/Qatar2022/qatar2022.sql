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

-- --------------------------------------------------------

--
-- Structure de la table `classements`
--

DROP TABLE IF EXISTS `classements`;
CREATE TABLE IF NOT EXISTS `classements` (
  `type` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0',
  `nb_perf` int(11) NOT NULL DEFAULT '0',
  `nb_correct_plus` int(11) NOT NULL DEFAULT '0',
  `nb_correct` int(11) NOT NULL DEFAULT '0',
  `nb_inverse` int(11) NOT NULL DEFAULT '0',
  `nb_echec` int(11) NOT NULL DEFAULT '0',
  `rang` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT  COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `classements`
--

INSERT INTO `classements` (`type`, `owner_id`, `points`, `bonus`, `nb_perf`, `nb_correct_plus`, `nb_correct`, `nb_inverse`, `nb_echec`, `rang`) VALUES
('general', 1, 0, 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `coequipiers`
--

DROP TABLE IF EXISTS `coequipiers`;
CREATE TABLE IF NOT EXISTS `coequipiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT  COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

DROP TABLE IF EXISTS `demandes`;
CREATE TABLE IF NOT EXISTS `demandes` (
  `id_demande` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `surnom` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `payement` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `description` varchar(4024) COLLATE utf8_general_ci NOT NULL,
  `id_joueur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_demande`)
) ENGINE=MyISAM DEFAULT  COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

DROP TABLE IF EXISTS `equipes`;
CREATE TABLE IF NOT EXISTS `equipes` (
  `id_equipe` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `group` varchar(1) COLLATE utf8_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_general_ci NOT NULL DEFAULT 'images\\flag\\',
  PRIMARY KEY (`id_equipe`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT  COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id_equipe`, `name`, `group`, `image`, `logo`) VALUES
(1, 'Qatar', 'A', '', 'images\\flag\\QAT.webp'),
(2, 'Équateur', 'A', '', 'images\\flag\\ECU.webp'),
(3, 'Sénégal', 'A', '', 'images\\flag\\SEN.webp'),
(4, 'Pays-Bas', 'A', '', 'images\\flag\\NED.webp'),
(5, 'Angleterre', 'B', '', 'images\\flag\\ENG.webp'),
(6, 'Iran', 'B', '', 'images\\flag\\IRN.webp'),
(7, 'États-Unis', 'B', '', 'images\\flag\\USA.webp'),
(8, 'Pays de Galles', 'B', '', 'images\\flag\\WAL.webp'),
(9, 'Argentine', 'C', '', 'images\\flag\\ARG.webp'),
(10, 'Arabie saoudite', 'C', '', 'images\\flag\\KSA.webp'),
(11, 'Mexique', 'C', '', 'images\\flag\\MEX.webp'),
(12, 'Pologne', 'C', '', 'images\\flag\\POL.webp'),
(13, 'France', 'D', '', 'images\\flag\\FRA.webp'),
(14, 'Danemark', 'D', '', 'images\\flag\\DEN.webp'),
(15, 'Tunisie', 'D', '', 'images\\flag\\TUN.webp'),
(16, 'Australie', 'D', '', 'images\\flag\\AUS.webp'),
(17, 'Espagne', 'E', '', 'images\\flag\\ESP.jpg'),
(18, 'Allemagne', 'E', '', 'images\\flag\\GER.webp'),
(19, 'Japon', 'E', '', 'images\\flag\\JPN.webp'),
(20, 'Costa Rica', 'E', '', 'images\\flag\\CRC.webp'),
(21, 'Belgique', 'F', '', 'images\\flag\\BEL.webp'),
(22, 'Canada', 'F', '', 'images\\flag\\CAN.webp'),
(23, 'Maroc', 'F', '', 'images\\flag\\MAR.webp'),
(24, 'Croatie', 'F', '', 'images\\flag\\CRO.webp'),
(25, 'Brésil', 'G', '', 'images\\flag\\BRA.webp'),
(26, 'Serbie', 'G', '', 'images\\flag\\SRB.webp'),
(27, 'Suisse', 'G', '', 'images\\flag\\SUI.webp'),
(28, 'Cameroun', 'G', '', 'images\\flag\\CMR.webp'),
(29, 'Portugal', 'H', '', 'images\\flag\\POR.webp'),
(30, 'Ghana', 'H', '', 'images\\flag\\GHA.webp'),
(31, 'Uruguay', 'H', '', 'images\\flag\\URU.webp'),
(32, 'Rép. de Corée', 'H', '', 'images\\flag\\KOR.webp');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribut` varchar(25) COLLATE utf8_general_ci NOT NULL,
  `value` int(1) NOT NULL,
   PRIMARY KEY (`id`)
)  AUTO_INCREMENT=0 DEFAULT  COLLATE=utf8_general_ci;
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
  `prenom` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8_general_ci DEFAULT NULL,
  `surnom` varchar(50) COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8_general_ci DEFAULT NULL,
  `image` varchar(300) COLLATE utf8_general_ci DEFAULT 'images/user/default.jpg',
  `departement` int(6) DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `payed` tinyint(1) NOT NULL DEFAULT '0',
  `updated` tinyint(1) NOT NULL DEFAULT '0',
  `female` tinyint(1) NOT NULL DEFAULT '0',
  `modif_profil` tinyint(1) NOT NULL DEFAULT '0',
  `modif_match` tinyint(1) NOT NULL DEFAULT '0',
  `modif_bonus` tinyint(1) NOT NULL DEFAULT '0',
  `description` varchar(4024) COLLATE utf8_general_ci DEFAULT NULL,
  `equipe` int(11) DEFAULT NULL,
  `oauth` enum('Yes','No') COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `status` enum('active','inactive') COLLATE utf8_general_ci NOT NULL DEFAULT 'active',
  `color` varchar(100) NOT NULL DEFAULT '#209aad',
  PRIMARY KEY (`id_joueur`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT  COLLATE=utf8_general_ci;

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
  `stadium` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `diff` varchar(255) COLLATE utf8_general_ci NOT NULL DEFAULT 'BeIn',
  `played` tinyint(1) NOT NULL DEFAULT '0',
  `modif` tinyint(1) NOT NULL DEFAULT '1',
  `groupe` varchar(5) COLLATE utf8_general_ci NOT NULL,
  `phased` tinyint(1) NOT NULL DEFAULT '0',
  `montagne` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_match`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT  COLLATE=utf8_general_ci;

INSERT INTO `matches` (`id_match`, `id_team_home`, `id_team_away`, `score_home`, `score_away`, `date`, `stadium`, `diff`, `played`, `modif`, `groupe`, `phased`, `montagne`) VALUES

(1, 2, 1, 0, 0, '2022-11-20 17:00:00', 'Al Bayt Stadium', 'TF1 - BeIn1', 0, 1, 'A', 0, 0),

(2, 5, 6, 0, 0, '2022-11-21 14:00:00', 'Khalifa International Stadium', 'BeIn1', 0, 1, 'B', 0, 0),
(3, 3, 4, 0, 0, '2022-11-21 17:00:00', 'Al Thumama Stadium', 'BeIn1', 0, 1, 'A', 0, 0),
(4, 7, 8, 0, 0, '2022-11-21 20:00:00', 'Ahmad Bin Ali Stadium', 'TF1 - BeIn1', 0, 1, 'B', 0, 0),

(5, 9, 10, 0, 0, '2022-11-22 11:00:00', 'Lusail Stadium', 'BeIn1', 0, 1, 'C', 0, 0),
(6, 14, 15, 0, 0, '2022-11-22 14:00:00', 'Education City Stadium', 'BeIn1', 0, 1, 'D', 0, 0),
(7, 11, 12, 0, 0, '2022-11-22 17:00:00', 'Stadium 974', 'BeIn1', 0, 1, 'C', 0, 0),
(8, 13, 16, 0, 0, '2022-11-22 20:00:00', 'Al-Janoub Stadium', 'TF1 - BeIn1', 0, 1, 'D', 0, 0),

(9, 23, 24, 0, 0, '2022-11-23 11:00:00', 'Al Bayt Stadium', 'BeIn1', 0, 1, 'F', 0, 0),
(10, 18, 19, 0, 0, '2022-11-23 14:00:00', 'Khalifa International Stadium', 'BeIn1', 0, 1, 'E', 0, 0),
(11, 17, 20, 0, 0, '2022-11-23 17:00:00', 'Al Thumama Stadium', 'BeIn1', 0, 1, 'E', 0, 0),
(12, 21, 22, 0, 0, '2022-11-23 20:00:00', 'Ahmad Bin Ali Stadium', 'TF1 - BeIn1', 0, 1, 'F', 0, 0),

(13, 27, 28, 0, 0, '2022-11-24 11:00:00', 'Al-Janoub Stadium', 'BeIn1', 0, 1, 'G', 0, 0),
(14, 31, 32, 0, 0, '2022-11-24 14:00:00', 'Education City Stadium', 'BeIn1', 0, 1, 'H', 0, 0),
(15, 29, 30, 0, 0, '2022-11-24 17:00:00', 'Stadium 974', 'BeIn1', 0, 1, 'H', 0, 0),
(16, 25, 26, 0, 0, '2022-11-24 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 0, 1, 'G', 0, 0),

(17, 8, 6, 0, 0, '2022-11-25 11:00:00', 'Ahmad Bin Ali Stadium', 'BeIn1', 0, 1, 'B', 0, 0),
(18, 1, 3, 0, 0, '2022-11-25 14:00:00', 'Al Thumama Stadium', 'BeIn1', 0, 1, 'A', 0, 0),
(19, 4, 2, 0, 0, '2022-11-25 17:00:00', 'Khalifa International Stadium', 'BeIn1', 0, 1, 'A', 0, 0),
(20, 5, 7, 0, 0, '2022-11-25 20:00:00', 'Al Bayt Stadium', 'TF1 - BeIn1', 0, 1, 'B', 0, 0),

(21, 15, 16, 0, 0, '2022-11-26 11:00:00', 'Al-Janoub Stadium', 'BeIn1', 0, 1, 'D', 0, 0),
(22, 12, 10, 0, 0, '2022-11-26 14:00:00', 'Education City Stadium', 'BeIn1', 0, 1, 'C', 0, 0),
(23, 13, 14, 0, 0, '2022-11-26 17:00:00', 'Stadium 974', 'TF1 - BeIn1', 0, 1, 'D', 0, 0),
(24, 9, 11, 0, 0, '2022-11-26 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 0, 1, 'C', 0, 0),

(25, 19, 20, 0, 0, '2022-11-27 11:00:00', 'Ahmad Bin Ali Stadium', 'BeIn1', 0, 1, 'E', 0, 0),
(26, 21, 23, 0, 0, '2022-11-27 14:00:00', 'Al Thumama Stadium', 'TF1 - BeIn1', 0, 1, 'F', 0, 0),
(27, 24, 22, 0, 0, '2022-11-27 17:00:00', 'Khalifa International Stadium', 'BeIn1', 0, 1, 'F', 0, 0),
(28, 17, 18, 0, 0, '2022-11-27 20:00:00', 'Al Bayt Stadium', 'TF1 - BeIn1', 0, 1, 'E', 0, 0),

(29, 28, 26, 0, 0, '2022-11-28 11:00:00', 'Al-Janoub Stadium', 'BeIn1', 0, 1, 'G', 0, 0),
(30, 32, 30, 0, 0, '2022-11-28 14:00:00', 'Education City Stadium', 'BeIn1', 0, 1, 'H', 0, 0),
(31, 25, 27, 0, 0, '2022-11-28 17:00:00', 'Stadium 974', 'BeIn1', 0, 1, 'G', 0, 0),
(32, 29, 31, 0, 0, '2022-11-28 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 0, 1, 'H', 0, 0),

(33, 2, 3, 0, 0, '2022-11-29 16:00:00', 'Khalifa International Stadium', 'BeIn2', 0, 1, 'A', 0, 0),
(34, 4, 1, 0, 0, '2022-11-29 16:00:00', 'Al Bayt Stadium', 'BeIn1', 0, 1, 'A', 0, 0),
(35, 6, 7, 0, 0, '2022-11-29 20:00:00', 'Al Thumama Stadium', 'BeIn2', 0, 1, 'B', 0, 0),
(36, 8, 5, 0, 0, '2022-11-29 20:00:00', 'Ahmad Bin Ali Stadium', 'TF1 - BeIn1', 0, 1, 'B', 0, 0),

(37, 16, 14, 0, 0, '2022-11-30 16:00:00', 'Al-Janoub Stadium', 'BeIn2', 0, 1, 'D', 0, 0),
(38, 15, 13, 0, 0, '2022-11-30 16:00:00', 'Education City Stadium', 'TF1 - BeIn1', 0, 1, 'D', 0, 0),
(39, 10, 11, 0, 0, '2022-11-30 20:00:00', 'Lusail Stadium', 'BeIn2', 0, 1, 'C', 0, 0),
(40, 12,  9, 0, 0, '2022-11-30 20:00:00', 'Stadium 974', 'TF1 - BeIn1', 0, 1, 'C', 0, 0),

(41, 22, 23, 0, 0, '2022-12-01 16:00:00', 'Al Thumama Stadium', 'BeIn2', 0, 1, 'F', 0, 0),
(42, 24, 21, 0, 0, '2022-12-01 16:00:00', 'Ahmad Bin Ali Stadium', 'BeIn1', 0, 1, 'F', 0, 0),
(43, 20, 18, 0, 0, '2022-12-01 20:00:00', 'Al Bayt Stadium', 'BeIn2', 0, 1, 'E', 0, 0),
(44, 19, 17, 0, 0, '2022-12-01 20:00:00', 'Khalifa International Stadium', 'TF1 - BeIn1', 0, 1, 'E', 0, 0),

(45, 30, 31, 0, 0, '2022-12-02 16:00:00', 'Al-Janoub Stadium', 'BeIn2', 0, 1, 'H', 0, 0),
(46, 32, 29, 0, 0, '2022-12-02 16:00:00', 'Education City Stadium', 'BeIn1', 0, 1, 'H', 0, 0),
(47, 26, 27, 0, 0, '2022-12-02 20:00:00', 'Stadium 974', 'BeIn2', 0, 1, 'G', 0, 0),
(48, 28, 25, 0, 0, '2022-12-02 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 0, 1, 'G', 0, 0),

(49, 1, 1, 0, 0, '2022-12-03 16:00:00', 'Khalifa International Stadium', 'BeIn1', 0, 0, '', 0, 0),
(50, 1, 1, 0, 0, '2022-12-03 20:00:00', 'Ahmad Bin Ali Stadium', 'BeIn1', 0, 0, '', 0, 0),

(51, 1, 1, 0, 0, '2022-12-04 16:00:00', 'Al Thumama Stadium', 'BeIn1', 0, 0, '', 0, 0),
(52, 1, 1, 0, 0, '2022-12-04 20:00:00', 'Al Bayt Stadium', 'BeIn1', 0, 0, '', 0, 0),

(53, 1, 1, 0, 0, '2022-12-05 16:00:00', 'Al-Janoub Stadium', 'BeIn1', 0, 0, '', 0, 0),
(54, 1, 1, 0, 0, '2022-12-05 20:00:00', 'Stadium 974', 'BeIn1', 0, 0, '', 0, 0),

(55, 1, 1, 0, 0, '2022-12-06 16:00:00', 'Education City Stadium', 'BeIn1', 0, 0, '', 0, 0),
(56, 1, 1, 0, 0, '2022-12-06 20:00:00', 'Lusail Stadium', 'BeIn1', 0, 0, '', 0, 0),

(57, 1, 1, 0, 0, '2022-12-09 16:00:00', 'Education City Stadium', 'BeIn1', 0, 0, '', 0, 0),
(58, 1, 1, 0, 0, '2022-12-09 20:00:00', 'Lusail Stadium', 'BeIn1', 0, 0, '', 0, 0),

(59, 1, 1, 0, 0, '2022-12-10 16:00:00', 'Al Thumama Stadium', 'BeIn1', 0, 0, '', 0, 0),
(60, 1, 1, 0, 0, '2022-12-10 20:00:00', 'Al Bayt Stadium', 'BeIn1', 0, 0, '', 0, 0),

(61, 1, 1, 0, 0, '2022-12-13 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 0, 0, '', 0, 0),

(62, 1, 1, 0, 0, '2022-12-14 20:00:00', 'Al Bayt Stadium', 'TF1 - BeIn1', 0, 0, '', 0, 0),

(63, 1, 1, 0, 0, '2022-12-17 20:00:00', 'Khalifa International Stadium', 'TF1 - BeIn1', 0, 0, '', 0, 0),

(64, 1, 1, 0, 0, '2022-12-18 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 0, 0, '', 0, 0);

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
) ENGINE=MyISAM DEFAULT  COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pronostics_bonus`
--

DROP TABLE IF EXISTS `pronostics_bonus`;
CREATE TABLE IF NOT EXISTS `pronostics_bonus` (
  `id_membre` int(11) NOT NULL,
  `team_winner_id` int(11) NOT NULL,
  `team_winner_id_point` int(4) NULL DEFAULT '-1',
  `min_first` int(11) NULL,
  `min_first_point` int(4) NULL DEFAULT '-1',
  `min_last` int(11) NULL,
  `min_last_point` int(4) NULL DEFAULT '-1',
  `total_but` int(11) NULL,
  `total_but_point` int(4) NULL DEFAULT '-1',
  `best_scorer` varchar(255) COLLATE utf8_general_ci NULL,
  `best_scorer_point` int(4) NULL DEFAULT '-1',
  `modif` int(11) NULL DEFAULT '1',
  UNIQUE KEY `id_membre` (`id_membre`)
) ENGINE=MyISAM DEFAULT  COLLATE=utf8_general_ci;
COMMIT;

DROP TABLE IF EXISTS `historic_rang`;
CREATE TABLE IF NOT EXISTS `historic_rang` (
  `type` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `id_owner` int(11) NOT NULL,
  `date` date NOT NULL,
  `rang` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`type`,`id_owner`,`date`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;


DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER DATABASE euro2021 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
