-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 30 Mars 2018 à 20:35
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `france2016`
--
CREATE DATABASE IF NOT EXISTS `france2016` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `france2016`;

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

--
-- Contenu de la table `demandes`
--

INSERT INTO `demandes` (`id_demande`, `nom`, `prenom`, `surnom`, `mail`, `telephone`, `payement`, `description`, `id_joueur`) VALUES
(4, 'Damien', 'Kachouh', 'Damo', 'nikesamere@tonpere.fr', '0123456789', 'liquide', 'Je baise ta mere !', NULL),
(5, 'Damien', 'Kachouh', 'Damo1', 'nikesamere1@tonpere.fr', '0123456789', 'liquide', '', NULL),
(7, 'test''', 'test', 'test', 'test@test.fr', '0000000000', 'liquide', 'testlol', NULL),
(10, 'Teisseire', 'Solène', 'Soso', 'flo948@hotmail.fr', '0760851992', 'liquide', '', NULL),
(11, 'Jousseau', 'Florian', 'lol', 'f.jousseauuu@gmail.com', '0760851992', 'liquide', '', NULL),
(12, 'Jousseau', 'Florian', 'testt', 'f.jousseaaaaaaaaaau@gmail.com', '0760851992', 'liquide', '', NULL),
(13, 'Jousseau', 'Florian', 'tesssss', 'f.jousseau@gmail.com', '0760851992', 'liquide', '', NULL),
(14, 'Jousseau', 'Florian', 'aaaaaa', 'fffffff.jousseau@gmail.com', '0760851992', 'liquide', '', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE IF NOT EXISTS `equipes` (
  `id_equipe` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `group` varchar(1) COLLATE latin1_general_ci NOT NULL,
  `image` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `logo` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT 'images\\logo\\',
  PRIMARY KEY (`id_equipe`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=25 ;

--
-- Contenu de la table `equipes`
--

INSERT INTO `equipes` (`id_equipe`, `name`, `group`, `image`, `logo`) VALUES
(1, 'Albanie', 'A', '', 'images\\logo\\752.png'),
(2, 'France', 'A', '', 'images\\logo\\769.png'),
(3, 'Roumanie', 'A', '', 'images\\logo\\790.png'),
(4, 'Suisse', 'A', '', 'images\\logo\\798.png'),
(5, 'Angleterre', 'B', '', 'images\\logo\\765.png'),
(6, 'Russie', 'B', '', 'images\\logo\\791.png'),
(7, 'Slovaquie', 'B', '', 'images\\logo\\794.png'),
(8, 'Pays de Galles', 'B', '', 'images\\logo\\801.png'),
(9, 'Allemagne', 'C', '', 'images\\logo\\771.png'),
(10, 'Irlande du Nord', 'C', '', 'images\\logo\\785.png'),
(11, 'Pologne', 'C', '', 'images\\logo\\787.png'),
(12, 'Ukraine', 'C', '', 'images\\logo\\800.png'),
(13, 'Croatie', 'D', '', 'images\\logo\\761.png'),
(14, 'Rép. tchèque', 'D', '', 'images\\logo\\763.png'),
(15, 'Espagne', 'D', '', 'images\\logo\\796.png'),
(16, 'Turquie', 'D', '', 'images\\logo\\799.png'),
(17, 'Belgique', 'E', '', 'images\\logo\\757.png'),
(18, 'Italie', 'E', '', 'images\\logo\\776.png'),
(19, 'Irlande', 'E', '', 'images\\logo\\789.png'),
(20, 'Suède', 'E', '', 'images\\logo\\797.png'),
(21, 'Autriche', 'F', '', 'images\\logo\\755.png'),
(22, 'Islande', 'F', '', 'images\\logo\\774.png'),
(23, 'Portugal', 'F', '', 'images\\logo\\788.png'),
(24, 'Hongrie', 'F', '', 'images\\logo\\773.png');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE IF NOT EXISTS `etat` (
  `attribut` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etat`
--

INSERT INTO `etat` (`attribut`, `value`) VALUES
('PRONOS_BONUS', 1),
('PRONOS', 1);

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE IF NOT EXISTS `joueurs` (
  `id_joueur` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `surnom` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `image` varchar(50) COLLATE latin1_general_ci DEFAULT 'images/user/default.jpg',
  `departement` int(6) DEFAULT NULL,
  `telephone` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `points` int(6) DEFAULT '0',
  `bonus` int(6) DEFAULT '0',
  `payed` tinyint(1) NOT NULL DEFAULT '0',
  `updated` tinyint(1) NOT NULL DEFAULT '0',
  `nb_perf` int(6) DEFAULT '0',
  `nb_correct_plus` int(4) NOT NULL DEFAULT '0',
  `nb_correct` int(4) NOT NULL DEFAULT '0',
  `nb_inverse` int(4) NOT NULL DEFAULT '0',
  `nb_echec` int(4) NOT NULL DEFAULT '0',
  `oauth` enum('Yes','No') COLLATE latin1_general_ci NOT NULL DEFAULT 'No',
  `status` enum('active','inactive') COLLATE latin1_general_ci NOT NULL DEFAULT 'inactive',
  `membre_siteweb` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `membre_avatar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `membre_signature` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `membre_inscrit` int(11) NOT NULL,
  `membre_derniere_visite` int(11) NOT NULL,
  `membre_rang` tinyint(4) DEFAULT '2',
  `membre_post` int(11) NOT NULL,
  `modif_profil` tinyint(1) NOT NULL DEFAULT '0',
  `modif_match` tinyint(1) NOT NULL DEFAULT '0',
  `modif_bonus` tinyint(1) NOT NULL DEFAULT '0',
  `rang` int(4) NOT NULL DEFAULT '0',
  `description` varchar(4024) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_joueur`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `joueurs`
--

INSERT INTO `joueurs` (`id_joueur`, `nom`, `surnom`, `email`, `password`, `image`, `departement`, `telephone`, `points`, `bonus`, `payed`, `updated`, `nb_perf`, `nb_correct_plus`, `nb_correct`, `nb_inverse`, `nb_echec`, `oauth`, `status`, `membre_siteweb`, `membre_avatar`, `membre_signature`, `membre_inscrit`, `membre_derniere_visite`, `membre_rang`, `membre_post`, `modif_profil`, `modif_match`, `modif_bonus`, `rang`, `description`) VALUES
(1, 'Florian Jousseau', 'La Flouf', 'f.jousseau@gmail.com', 'admin', 'images/user/IMG_5752.JPG', 94, '0760851992', 25, 0, 1, 0, 3, 0, 1, 1, 2, 'No', 'active', 'www.odettecup2016.de.lz', 'images/default.png', 'Jouss''', 0, 0, 2, 0, 1, 1, 1, 1, 'bonjour je m''appel florian et je vous baise'),
(2, 'Teisseire Solène', 'Soso', 'flo948@hotmail.fr', 'soso', 'images/user/default.jpg', 94, '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'No', 'inactive', '', '', '', 0, 0, 2, 0, 0, 0, 0, 2, 'Description vide -> Modifier votre profil pour y insérer votre description');

-- --------------------------------------------------------

--
-- Structure de la table `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
  `id_match` int(11) NOT NULL AUTO_INCREMENT,
  `id_team_home` int(11) NOT NULL,
  `id_team_away` int(11) NOT NULL,
  `score_home` int(11) NOT NULL DEFAULT '0',
  `score_away` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `stadium` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `diff` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `played` tinyint(1) NOT NULL DEFAULT '0',
  `ville` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `modif` tinyint(1) NOT NULL DEFAULT '1',
  `groupe` varchar(5) COLLATE latin1_general_ci NOT NULL,
  `phased` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_match`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=53 ;

--
-- Contenu de la table `matches`
--

INSERT INTO `matches` (`id_match`, `id_team_home`, `id_team_away`, `score_home`, `score_away`, `date`, `stadium`, `diff`, `played`, `ville`, `modif`, `groupe`, `phased`) VALUES
(1, 2, 3, 1, 2, '2016-06-10 21:00:00', '', 'TF1 - BeIn', 1, 'Saint-Denis', 1, 'A', 0),
(2, 1, 4, 1, 1, '2016-06-11 15:00:00', '', 'TF1 - BeIn', 1, 'Lens', 1, 'A', 0),
(3, 8, 7, 0, 1, '2016-06-11 18:00:00', '', 'BeIn', 1, 'Bordeaux', 1, 'B', 0),
(4, 5, 6, 1, 0, '2016-06-11 21:00:00', '', 'M6 - BeIn', 1, 'Marseilles', 1, 'B', 0),
(5, 16, 13, 0, 0, '2016-06-12 15:00:00', '', 'TF1 - BeIn', 1, 'Paris', 1, 'D', 0),
(6, 11, 10, 0, 0, '2016-06-12 18:00:00', '', 'BeIn', 1, 'Nice', 1, 'C', 0),
(7, 9, 12, 0, 0, '2016-06-12 21:00:00', '', 'TF1 - BeIn', 1, 'Lille', 1, 'C', 0),
(8, 15, 14, 0, 0, '2016-06-13 15:00:00', '', 'BeIn', 0, 'Toulouse', 1, 'D', 0),
(9, 19, 20, 0, 0, '2016-06-13 18:00:00', '', 'BeIn', 0, 'Saint Denis', 1, 'E', 0),
(10, 17, 18, 0, 0, '2016-06-13 21:00:00', '', 'M6 - BeIn', 0, 'Lyon', 1, 'E', 0),
(11, 21, 24, 0, 0, '2016-06-14 18:00:00', '', 'BeIn', 0, 'Bordeaux', 1, 'F', 0),
(12, 23, 22, 0, 0, '2016-06-14 21:00:00', '', 'TF1 - BeIn', 0, 'St Etienne', 1, 'F', 0),
(13, 6, 7, 0, 0, '2016-06-15 15:00:00', '', 'BeIn', 0, 'Lille', 1, 'B', 0),
(14, 3, 4, 0, 0, '2016-06-15 18:00:00', '', 'TF1 - BeIn', 0, 'Paris', 1, 'A', 0),
(15, 2, 1, 0, 0, '2016-06-15 21:00:00', '', 'TF1 - BeIn', 0, 'Marseille', 1, 'A', 0),
(16, 5, 8, 0, 0, '2016-06-16 15:00:00', '', 'BeIn', 0, 'Lens', 1, 'B', 0),
(17, 12, 10, 0, 0, '2016-06-16 18:00:00', '', 'BeIn', 0, 'Lyon', 1, 'C', 0),
(18, 9, 11, 0, 0, '2016-06-16 21:00:00', '', 'M6 - BeIn', 0, 'Saint Denis', 1, 'C', 0),
(19, 18, 20, 0, 0, '2016-06-17 15:00:00', '', 'TF1 - BeIn', 0, 'Toulouse', 1, 'E', 0),
(20, 14, 13, 0, 0, '2016-06-17 18:00:00', '', 'BeIn', 0, 'St Etienne', 1, 'D', 0),
(21, 15, 16, 0, 0, '2016-06-17 21:00:00', '', 'M6 - BeIn', 0, 'Nice', 1, 'D', 0),
(22, 17, 19, 0, 0, '2016-06-18 15:00:00', '', 'TF1 - BeIn', 0, 'Bordeaux', 1, 'E', 0),
(23, 22, 24, 0, 0, '2016-06-18 18:00:00', '', 'BeIn', 0, 'Marseille', 1, 'F', 0),
(24, 23, 21, 0, 0, '2016-06-18 21:00:00', '', 'TF1 - BeIn', 0, 'Paris', 1, 'F', 0),
(25, 4, 2, 0, 0, '2016-06-19 21:00:00', '', 'M6 - BeIn', 0, 'Lilles', 1, 'A', 0),
(26, 3, 1, 0, 0, '2016-06-19 21:00:00', '', 'BeIn', 0, 'Lyon', 1, 'A', 0),
(27, 7, 5, 0, 0, '2016-06-20 21:00:00', '', 'TMC - BeIn', 0, 'St Etienne', 1, 'B', 0),
(28, 6, 8, 0, 0, '2016-06-20 21:00:00', '', 'BeIn', 0, 'Toulouse', 1, 'B', 0),
(29, 10, 9, 0, 0, '2016-06-21 18:00:00', '', 'BeIn', 0, 'Paris', 1, 'C', 0),
(30, 12, 11, 0, 0, '2016-06-21 18:00:00', '', 'BeIn', 0, 'Marseille', 1, 'C', 0),
(31, 13, 15, 0, 0, '2016-06-21 21:00:00', '', 'TF1 - BeIn', 0, 'Bordeaux', 1, 'D', 0),
(32, 14, 16, 0, 0, '2016-06-21 21:00:00', '', 'BeIn', 0, 'Lens', 1, 'D', 0),
(33, 24, 23, 0, 0, '2016-06-22 18:00:00', '', 'BeIn', 0, 'Lyon', 1, 'F', 0),
(35, 22, 21, 0, 0, '2016-06-22 18:00:00', '', 'BeIn', 0, 'Saint Denis', 1, 'F', 0),
(36, 20, 17, 0, 0, '2016-06-22 21:00:00', '', 'M6 - BeIn', 0, 'Nice', 1, 'E', 0),
(37, 18, 19, 0, 0, '2016-06-22 21:00:00', '', 'BeIn', 0, 'Lille', 1, 'E', 0),
(38, 1, 1, 0, 0, '2016-06-25 15:00:00', '', 'BeIn', 0, 'St Etienne', 0, '', 0),
(39, 1, 1, 0, 0, '2016-06-25 18:00:00', '', 'BeIn', 0, 'Paris', 0, '', 0),
(40, 1, 1, 0, 0, '2016-06-25 21:00:00', '', 'BeIn', 0, 'Lens', 0, '', 0),
(41, 1, 1, 0, 0, '2016-06-26 15:00:00', '', 'BeIn', 0, 'Lyon', 0, '', 0),
(42, 1, 1, 0, 0, '2016-06-26 18:00:00', '', 'BeIn', 0, 'Lille', 0, '', 0),
(43, 1, 1, 0, 0, '2016-06-26 21:00:00', '', 'BeIn', 0, 'Toulouse', 0, '', 0),
(44, 1, 1, 0, 0, '2016-06-27 18:00:00', '', 'BeIn', 0, 'Saint Denis', 0, '', 0),
(45, 1, 1, 0, 0, '2016-06-27 21:00:00', '', 'BeIn', 0, 'Nice', 0, '', 0),
(46, 1, 1, 0, 0, '2016-06-30 21:00:00', '', 'BeIn', 0, 'Marseille', 0, '', 0),
(47, 1, 1, 0, 0, '2016-07-01 21:00:00', '', 'BeIn', 0, 'Lille', 0, '', 0),
(48, 1, 1, 0, 0, '2016-07-02 21:00:00', '', 'BeIn', 0, 'Bordeaux', 0, '', 0),
(49, 1, 1, 0, 0, '2016-07-03 21:00:00', '', 'BeIn', 0, 'Saint Denis', 0, '', 0),
(50, 1, 1, 0, 0, '2016-07-06 21:00:00', '', 'BeIn', 0, 'Lyon', 0, '', 0),
(51, 1, 1, 0, 0, '2016-07-07 21:00:00', '', 'BeIn', 0, 'Marseille', 0, '', 0),
(52, 1, 1, 0, 0, '2016-07-10 21:00:00', '', 'M6 - BeIn', 0, 'Saint Denis', 0, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `pronostics`
--

CREATE TABLE IF NOT EXISTS `pronostics` (
  `id_pronostic` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `id_match` int(11) NOT NULL,
  `prono_home` int(11) NOT NULL,
  `prono_away` int(11) NOT NULL,
  `point` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pronostic`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2377 ;

--
-- Contenu de la table `pronostics`
--

INSERT INTO `pronostics` (`id_pronostic`, `id_membre`, `id_match`, `prono_home`, `prono_away`, `point`) VALUES
(2376, 1, 37, 0, 0, 0),
(2375, 1, 36, 0, 0, 0),
(2374, 1, 35, 0, 0, 0),
(2373, 1, 33, 0, 0, 0),
(2372, 1, 32, 0, 0, 0),
(2371, 1, 31, 0, 0, 0),
(2370, 1, 30, 0, 0, 0),
(2369, 1, 29, 0, 0, 0),
(2368, 1, 28, 0, 0, 0),
(2367, 1, 27, 0, 0, 0),
(2366, 1, 26, 0, 0, 0),
(2365, 1, 25, 0, 0, 0),
(2364, 1, 24, 0, 0, 0),
(2363, 1, 23, 0, 0, 0),
(2362, 1, 22, 0, 0, 0),
(2361, 1, 21, 0, 0, 0),
(2360, 1, 20, 0, 0, 0),
(2359, 1, 19, 0, 0, 0),
(2358, 1, 18, 0, 0, 0),
(2357, 1, 17, 0, 0, 0),
(2356, 1, 16, 0, 0, 0),
(2355, 1, 15, 0, 0, 0),
(2354, 1, 14, 0, 0, 0),
(2353, 1, 13, 0, 0, 0),
(2352, 1, 12, 0, 0, 0),
(2351, 1, 11, 0, 0, 0),
(2350, 1, 10, 0, 0, 0),
(2349, 1, 9, 0, 0, 0),
(2348, 1, 8, 0, 0, 0),
(2347, 1, 7, 0, 0, 0),
(2346, 1, 6, 0, 0, 0),
(2345, 1, 5, 0, 0, 0),
(2344, 1, 4, 0, 0, 0),
(2343, 1, 3, 0, 0, 0),
(2342, 1, 2, 0, 0, 0),
(2341, 1, 1, 2, 1, 0),
(2340, 1, 37, 0, 0, 0),
(2339, 1, 36, 0, 0, 0),
(2338, 1, 35, 0, 0, 0),
(2337, 1, 33, 0, 0, 0),
(2336, 1, 32, 0, 0, 0),
(2335, 1, 31, 0, 0, 0),
(2334, 1, 30, 0, 0, 0),
(2333, 1, 29, 0, 0, 0),
(2332, 1, 28, 0, 0, 0),
(2331, 1, 27, 0, 0, 0),
(2330, 1, 26, 0, 0, 0),
(2329, 1, 25, 0, 0, 0),
(2328, 1, 24, 0, 0, 0),
(2327, 1, 23, 0, 0, 0),
(2326, 1, 22, 0, 0, 0),
(2325, 1, 21, 0, 0, 0),
(2324, 1, 20, 0, 0, 0),
(2323, 1, 19, 0, 0, 0),
(2322, 1, 18, 0, 0, 0),
(2321, 1, 17, 0, 0, 0),
(2320, 1, 16, 0, 0, 0),
(2319, 1, 15, 0, 0, 0),
(2318, 1, 14, 0, 0, 0),
(2317, 1, 13, 0, 0, 0),
(2316, 1, 12, 0, 0, 0),
(2315, 1, 11, 0, 0, 0),
(2314, 1, 10, 0, 0, 0),
(2313, 1, 9, 0, 0, 0),
(2312, 1, 8, 0, 0, 0),
(2311, 1, 7, 0, 0, 7),
(2310, 1, 6, 0, 0, 7),
(2309, 1, 5, 0, 0, 7),
(2308, 1, 4, 0, 0, 0),
(2307, 1, 3, 0, 0, 0),
(2306, 1, 2, 0, 0, 3),
(2305, 1, 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `pronostics_bonus`
--

CREATE TABLE IF NOT EXISTS `pronostics_bonus` (
  `id_membre` int(11) NOT NULL,
  `team_winner_id` int(11) NOT NULL,
  `team_winner_id_point` int(4) NOT NULL DEFAULT '-1',
  `best_attack_id` int(11) NOT NULL,
  `best_attack_id_point` int(4) NOT NULL DEFAULT '-1',
  `best_defence_id` int(11) NOT NULL,
  `best_defence_id_point` int(4) NOT NULL DEFAULT '-1',
  `min_first` int(11) NOT NULL,
  `min_first_point` int(4) NOT NULL DEFAULT '-1',
  `min_last` int(11) NOT NULL,
  `min_last_point` int(4) NOT NULL DEFAULT '-1',
  `total_but` int(11) NOT NULL,
  `total_but_point` int(4) NOT NULL DEFAULT '-1',
  `best_scorer` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `best_scorer_point` int(4) NOT NULL DEFAULT '-1',
  `best_passeur` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `best_passeur_point` int(4) NOT NULL DEFAULT '-1',
  `nb_best_scorer` int(11) NOT NULL,
  `nb_best_scorer_point` int(4) NOT NULL DEFAULT '-1',
  `first_france` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `first_france_point` int(4) NOT NULL DEFAULT '-1',
  `nb_but_france` int(6) NOT NULL,
  `nb_but_france_point` int(4) NOT NULL DEFAULT '-1',
  `modif` int(11) NOT NULL DEFAULT '1',
  UNIQUE KEY `id_membre` (`id_membre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Contenu de la table `pronostics_bonus`
--

INSERT INTO `pronostics_bonus` (`id_membre`, `team_winner_id`, `team_winner_id_point`, `best_attack_id`, `best_attack_id_point`, `best_defence_id`, `best_defence_id_point`, `min_first`, `min_first_point`, `min_last`, `min_last_point`, `total_but`, `total_but_point`, `best_scorer`, `best_scorer_point`, `best_passeur`, `best_passeur_point`, `nb_best_scorer`, `nb_best_scorer_point`, `first_france`, `first_france_point`, `nb_but_france`, `nb_but_france_point`, `modif`) VALUES
(1, 2, -1, 5, -1, 17, -1, 16, -1, 85, -1, 142, -1, 'Muller', -1, 'Ozil', -1, 7, -1, 'Boubou', -1, 14, -1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
