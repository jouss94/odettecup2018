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
(1, 'Italie', 'A', '', 'images\\flag\\ITA.webp'),
(2, 'Suisse', 'A', '', 'images\\flag\\SUI.webp'),
(3, 'Turquie', 'A', '', 'images\\flag\\TUR.webp'),
(4, 'Pays de Galles', 'A', '', 'images\\flag\\WAL.webp'),
(5, 'Belgique', 'B', '', 'images\\flag\\BEL.webp'),
(6, 'Danemark', 'B', '', 'images\\flag\\DEN.webp'),
(7, 'Finlande', 'B', '', 'images\\flag\\FIN.webp'),
(8, 'Russie', 'B', '', 'images\\flag\\RUS.webp'),
(9, 'Autriche', 'C', '', 'images\\flag\\AUT.webp'),
(10, 'Pays-Bas', 'C', '', 'images\\flag\\NED.webp'),
(11, 'Macédoine du Nord', 'C', '', 'images\\flag\\MKD.webp'),
(12, 'Ukraine', 'C', '', 'images\\flag\\UKR.webp'),
(13, 'Croatie', 'D', '', 'images\\flag\\CRO.webp'),
(14, 'Rép. tchèque', 'D', '', 'images\\flag\\CZE.webp'),
(15, 'Angleterre', 'D', '', 'images\\flag\\ENG.webp'),
(16, 'Écosse', 'D', '', 'images\\flag\\SCO.webp'),
(17, 'Pologne', 'E', '', 'images\\flag\\POL.webp'),
(18, 'Slovaquie', 'E', '', 'images\\flag\\SVK.webp'),
(19, 'Espagne', 'E', '', 'images\\flag\\ESP.webp'),
(20, 'Suède', 'E', '', 'images\\flag\\SWE.webp'),
(21, 'France', 'F', '', 'images\\flag\\FRA.webp'),
(22, 'Allemagne', 'F', '', 'images\\flag\\GER.webp'),
(23, 'Hongrie', 'F', '', 'images\\flag\\HUN.webp'),
(24, 'Portugal', 'F', '', 'images\\flag\\POR.webp');

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
(44, 1, 1, 0, 0, '2021-06-29 21:00:00', 'Hampden Park - Glasgow', '', 0, 0, '', 0, 0),
(45, 1, 1, 0, 0, '2021-07-02 18:00:00', 'Gazprom Arena - Saint-Pétersbourg', '', 0, 0, '', 0, 0),
(46, 1, 1, 0, 0, '2021-07-02 21:00:00', 'Allianz Arena - Munich', '', 0, 0, '', 0, 0),
(47, 1, 1, 0, 0, '2021-07-03 18:00:00', 'Bakı Olimpiya Stadionu - Bakou', '', 0, 0, '', 0, 0),
(48, 1, 1, 0, 0, '2021-07-03 21:00:00', 'Olimpico in Rome - Rome', '', 0, 0, '', 0, 0),
(49, 1, 1, 0, 0, '2021-07-06 21:00:00', 'Wembley Stadium - Londres', '', 0, 0, '', 0, 0),
(50, 1, 1, 0, 0, '2021-07-07 21:00:00', 'Wembley Stadium - Londres', '', 0, 0, '', 0, 0),
(51, 1, 1, 0, 0, '2021-07-11 21:00:00', 'Wembley Stadium - Londres', '', 0, 0, '', 0, 0);


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
