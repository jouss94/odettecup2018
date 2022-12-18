-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : Dim 18 déc. 2022 à 21:40
-- Version du serveur :  10.5.16-MariaDB
-- Version de PHP : 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `id19608161_qatar2022`
--

-- --------------------------------------------------------

--
-- Structure de la table `best_scorer`
--

CREATE TABLE `best_scorer` (
  `id_joueur` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nb_but` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `best_scorer`
--

INSERT INTO `best_scorer` (`id_joueur`, `name`, `nb_but`) VALUES
(1, 'Valencia', 3),
(2, 'Saka', 3),
(3, 'Bellingham', 1),
(4, 'Sterling', 1),
(5, 'Rashford', 3),
(6, 'Taremi', 2),
(7, 'Grealish', 1),
(12, 'Gakpo', 3),
(11, 'Klaassen', 1),
(13, 'Giroud', 4),
(14, 'Mbappe', 8),
(15, 'Richarlison', 2),
(16, 'Ferran', 2),
(17, 'Morata', 3),
(18, 'Messi', 7),
(19, 'Alvarez', 4);

-- --------------------------------------------------------

--
-- Structure de la table `classements`
--

CREATE TABLE `classements` (
  `type` varchar(50) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `bonus` int(11) NOT NULL DEFAULT 0,
  `nb_perf` int(11) NOT NULL DEFAULT 0,
  `nb_correct_plus` int(11) NOT NULL DEFAULT 0,
  `nb_correct` int(11) NOT NULL DEFAULT 0,
  `nb_inverse` int(11) NOT NULL DEFAULT 0,
  `nb_echec` int(11) NOT NULL DEFAULT 0,
  `rang` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `classements`
--

INSERT INTO `classements` (`type`, `owner_id`, `points`, `bonus`, `nb_perf`, `nb_correct_plus`, `nb_correct`, `nb_inverse`, `nb_echec`, `rang`) VALUES
('general', 1, 144, 16, 7, 0, 25, 4, 28, 3),
('general', 2, 141, 6, 8, 0, 26, 1, 29, 4),
('general', 3, 121, 1, 4, 0, 30, 2, 28, 10),
('general', 4, 111, 0, 7, 0, 20, 2, 35, 14),
('general', 5, 121, 6, 5, 0, 26, 2, 31, 10),
('general', 6, 124, 1, 4, 0, 31, 2, 27, 9),
('general', 7, 114, 1, 5, 0, 25, 3, 31, 13),
('general', 8, 138, 1, 7, 0, 29, 1, 27, 6),
('general', 9, 157, 16, 8, 0, 28, 1, 27, 1),
('general', 10, 106, 6, 4, 0, 23, 3, 34, 15),
('general', 11, 138, 6, 6, 0, 28, 6, 24, 6),
('general', 12, 151, 1, 8, 0, 30, 4, 22, 2),
('general', 13, 118, 6, 3, 0, 29, 4, 28, 12),
('general', 14, 139, 6, 4, 0, 35, 0, 25, 5),
('general', 15, 126, 11, 6, 0, 23, 4, 31, 8);

-- --------------------------------------------------------

--
-- Structure de la table `coequipiers`
--

CREATE TABLE `coequipiers` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `demandes`
--

CREATE TABLE `demandes` (
  `id_demande` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `surnom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `payement` varchar(255) NOT NULL,
  `description` varchar(4024) NOT NULL,
  `id_joueur` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `demandes`
--

INSERT INTO `demandes` (`id_demande`, `nom`, `prenom`, `surnom`, `mail`, `telephone`, `payement`, `description`, `id_joueur`) VALUES
(1, 'Jousseau', 'Florian', 'Test', 'f.jousseau@gmailtest.com', '0760851992', 'liquide', '', NULL),
(2, 'joussau', 'bernard', 'One Dollar', 'varadero77@hotmail.fr', '0620694215', 'liquide', 'possible de faire mieux et cette année j\'ai de la chance', NULL),
(3, 'NYK', 'Josselin', 'Papa Nyk', 'joss917@hotmail.fr', '0676746467', 'virement', '', NULL),
(4, '', '', '', '', '', '', '', NULL),
(5, 'TOUROUDE', 'Déborah', 'Debby', 'deborah184@hotmail.fr', '0658213945', 'virement', '', NULL),
(6, 'Jousseau', 'Florian', 'aaaaa', 'f.jousseau@gmailaaaaa.com', '0760851992', 'liquide', '', NULL),
(7, 'Mollica', 'Adrien', 'Adrien', 'Adrienmollica@gmail.com', '0616276825', 'liquide', '', NULL),
(8, 'Vanwynsberge', 'Yannick', 'Yaya', 'yannick.vwy@gmail.com', '0620508108', 'virement', 'Le roi est ambitieux.', NULL),
(9, 'Malvy', 'Antoine', 'Malvy 4TW', 'malvyantoine@gmail.com', '0672310587', 'liquide', 'Malvy for the win t’as capté ?!\r\n\r\nSim’s anglais bloqué à Montpellier, tu me trouveras au Shakespeare durant toute la compet \r\n\r\nFree CR7 \r\n', NULL),
(10, 'Le Chapelain', 'Léa', 'Léa ', 'Lealechapelain@yahoo.fr', '0612341117', 'virement', '', NULL),
(11, 'dantoine', 'nicolas', 'BangBang', 'pierrot5633@outlook.fr', '0667339309', 'virement', 'Bonne chance a tous BangBang', NULL),
(12, 'vigeant', 'aurelie', 'Mouche', 'aurelie.vigeant@hotmail.fr', '0662272478', 'virement', 'rien du tout coup de couteau !', NULL),
(13, 'lorain', 'christopher', 'Golo', 'christopher.lorain@hotmail.fr', '0788597852', 'virement', '', NULL),
(14, 'Aflalaye', 'Dalia', 'Queen D ', 'dalia.aflalaye@live.fr', '0649852445', 'liquide', 'De retour pour vous jouer un mauvais tour ! Vous avez déjà mon RIB ', NULL),
(15, 'KACHOUH ', 'Damien', 'Damo', 'damien.kachouh@gmail.com', '0767672593', 'liquide', '', NULL),
(16, 'GINIES', 'jb', 'WARIKAZBI', 'jbginies@yahoo.fr', '0685877752', 'virement', '', NULL),
(17, 'Monica', 'Mathias', 'Jah-Bis', 'mathiasmonica@zohomail.eu', '0781958773', 'liquide', 'Pull up, vivant ARGENTINAAAAAAAA', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

CREATE TABLE `equipes` (
  `id_equipe` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group` varchar(1) NOT NULL,
  `image` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL DEFAULT 'images\\flag\\',
  `color` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id_equipe`, `name`, `group`, `image`, `logo`, `color`) VALUES
(1, 'Qatar', 'A', '', 'images\\flag\\QAT.webp', '#65112d'),
(2, 'Équateur', 'A', '', 'images\\flag\\ECU.webp', '#faea0e'),
(3, 'Sénégal', 'A', '', 'images\\flag\\SEN.webp', '#138f55'),
(4, 'Pays-Bas', 'A', '', 'images\\flag\\NED.webp', '#ff7e04'),
(5, 'Angleterre', 'B', '', 'images\\flag\\ENG.webp', '#ffffff'),
(6, 'Iran', 'B', '', 'images\\flag\\IRN.webp', '#950c0c'),
(7, 'États-Unis', 'B', '', 'images\\flag\\USA.webp', '#292975'),
(8, 'Pays de Galles', 'B', '', 'images\\flag\\WAL.webp', '#179355'),
(9, 'Argentine', 'C', '', 'images\\flag\\ARG.webp', '#5bbee9'),
(10, 'Arabie saoudite', 'C', '', 'images\\flag\\KSA.webp', '#004300'),
(11, 'Mexique', 'C', '', 'images\\flag\\MEX.webp', '#159153'),
(12, 'Pologne', 'C', '', 'images\\flag\\POL.webp', '#dc171d'),
(13, 'France', 'D', '', 'images\\flag\\FRA.webp', '#000066'),
(14, 'Danemark', 'D', '', 'images\\flag\\DEN.webp', '#dc171d'),
(15, 'Tunisie', 'D', '', 'images\\flag\\TUN.webp', '#dc171e'),
(16, 'Australie', 'D', '', 'images\\flag\\AUS.webp', '#e1d71d'),
(17, 'Espagne', 'E', '', 'images\\flag\\ESP.jpg', '#dc080d'),
(18, 'Allemagne', 'E', '', 'images\\flag\\GER.webp', '#000000'),
(19, 'Japon', 'E', '', 'images\\flag\\JPN.webp', '#fff'),
(20, 'Costa Rica', 'E', '', 'images\\flag\\CRC.webp', '#012987'),
(21, 'Belgique', 'F', '', 'images\\flag\\BEL.webp', '#dc151d'),
(22, 'Canada', 'F', '', 'images\\flag\\CAN.webp', '#dc171e'),
(23, 'Maroc', 'F', '', 'images\\flag\\MAR.webp', '#db161d'),
(24, 'Croatie', 'F', '', 'images\\flag\\CRO.webp', '#db161d'),
(25, 'Brésil', 'G', '', 'images\\flag\\BRA.webp', '#ffec00'),
(26, 'Serbie', 'G', '', 'images\\flag\\SRB.webp', '#dc080d'),
(27, 'Suisse', 'G', '', 'images\\flag\\SUI.webp', '#dc080d'),
(28, 'Cameroun', 'G', '', 'images\\flag\\CMR.webp', '#ffec00'),
(29, 'Portugal', 'H', '', 'images\\flag\\POR.webp', '#149153'),
(30, 'Ghana', 'H', '', 'images\\flag\\GHA.webp', '#fcea0d'),
(31, 'Uruguay', 'H', '', 'images\\flag\\URU.webp', '#5bbee9'),
(32, 'Rép. de Corée', 'H', '', 'images\\flag\\KOR.webp', '#fff');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id` int(11) NOT NULL,
  `attribut` varchar(25) NOT NULL,
  `value` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id`, `attribut`, `value`) VALUES
(1, 'PRONOS_BONUS', 0),
(2, 'PRONOS', 0);

-- --------------------------------------------------------

--
-- Structure de la table `historic_rang`
--

CREATE TABLE `historic_rang` (
  `type` varchar(50) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `date` date NOT NULL,
  `rang` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `joker`
--

CREATE TABLE `joker` (
  `id_membre` int(11) NOT NULL,
  `joker_double_match` int(11) NOT NULL,
  `joker_double_point` int(4) DEFAULT -1,
  `joker_score_match` int(11) DEFAULT NULL,
  `joker_score_match_pronos` varchar(255) DEFAULT NULL,
  `joker_score_point` int(4) DEFAULT -1,
  `joker_but_match` int(11) NOT NULL,
  `joker_but_point` int(4) DEFAULT -1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE `joueurs` (
  `id_joueur` int(6) UNSIGNED NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `surnom` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `image` varchar(300) DEFAULT 'images/user/default.jpg',
  `departement` int(6) DEFAULT NULL,
  `telephone` varchar(255) NOT NULL,
  `payed` tinyint(1) NOT NULL DEFAULT 0,
  `updated` tinyint(1) NOT NULL DEFAULT 0,
  `female` tinyint(1) NOT NULL DEFAULT 0,
  `modif_profil` tinyint(1) NOT NULL DEFAULT 0,
  `modif_match` tinyint(1) NOT NULL DEFAULT 0,
  `modif_bonus` tinyint(1) NOT NULL DEFAULT 0,
  `modif_joker` tinyint(1) NOT NULL DEFAULT 0,
  `description` varchar(4024) DEFAULT NULL,
  `equipe` int(11) DEFAULT NULL,
  `oauth` enum('Yes','No') NOT NULL DEFAULT 'No',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `color` varchar(100) NOT NULL DEFAULT '#9c2950'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `joueurs`
--

INSERT INTO `joueurs` (`id_joueur`, `prenom`, `nom`, `surnom`, `email`, `password`, `image`, `departement`, `telephone`, `payed`, `updated`, `female`, `modif_profil`, `modif_match`, `modif_bonus`, `modif_joker`, `description`, `equipe`, `oauth`, `status`, `color`) VALUES
(1, 'Florian ', 'Jousseau', 'Jouss', 'f.jousseau@gmail.com', 'admin', 'images/user/1.jpg', 94, '0760851992', 1, 0, 0, 1, 1, 1, 0, 'Président directeur général de la Odette Cup', 9, 'No', 'active', '#5bbee9'),
(2, 'Bernard', 'Jousseau', 'One Dollar', 'varadero77@hotmail.fr', 'poupdam62', 'images/user/C5998F9F-94BF-49F6-8011-E81B3037C981.jpeg', NULL, '0620694215', 1, 0, 0, 1, 1, 1, 0, 'possible de faire mieux et cette année j\'ai de la chance ', 25, 'No', 'active', '#ffec00'),
(3, 'Josselin', 'NYK', 'Papa Nyk', 'joss917@hotmail.fr', 'abcd91', 'images/user/default.jpg', NULL, '0676746467', 1, 0, 0, 1, 1, 1, 0, '', 25, 'No', 'active', '#ffec00'),
(5, 'Adrien', 'Mollica', 'Adrien', 'Adrienmollica@gmail.com', 'ME89FG', 'images/user/default.jpg', NULL, '0616276825', 0, 0, 0, 1, 1, 1, 0, '', 25, 'No', 'active', '#ffec00'),
(4, 'Déborah', 'TOUROUDE', 'Debby', 'deborah184@hotmail.fr	', 'Deborah189', 'images/user/GOPR0327.JPG', NULL, '0658213945', 1, 0, 0, 1, 1, 1, 0, '', 17, 'No', 'active', '#dc080d'),
(6, 'Yannick', 'Vanwynsberge', 'Yaya', 'yannick.vwy@gmail.com', 'TV21PZ', 'images/user/87867A72-60C4-4F50-B8A6-85B9DE06DB35.jpeg', NULL, '0620508108', 0, 0, 0, 1, 1, 1, 0, 'Le roi est ambitieux.', 25, 'No', 'active', '#ffec00'),
(7, 'Antoine', 'Malvy', 'Malvy 4TW', 'malvyantoine@gmail.com', 'RL32SQ', 'images/user/IMG_1455.JPG', NULL, '0672310587', 0, 0, 0, 1, 1, 1, 0, 'Malvy for the win t’as capté ?!\r\n\r\nSim’s anglais bloqué à Montpellier, tu me trouveras au Shakespeare durant toute la compet ! \r\n\r\nFree CR7 \r\n', 25, 'No', 'active', '#ffec00'),
(8, 'Léa', 'Le Chapelain', 'Léa', 'Lealechapelain@yahoo.fr', 'FR44BV', 'images/user/default.jpg', NULL, '0612341117', 0, 0, 0, 1, 1, 1, 0, '', 25, 'No', 'active', '#ffec00'),
(9, 'nicolas', 'dantoine', 'BangBang', 'pierrot5633@outlook.fr', '250318', 'images/user/E727296C-017E-4980-8806-B503CD9BFE75.jpeg', NULL, '0667339309', 1, 0, 0, 1, 1, 1, 0, 'Bonne chance a tous BangBang', 13, 'No', 'active', '#000066'),
(10, 'aurelie', 'vigeant', 'Mouche', 'aurelie.vigeant@hotmail.fr', 'Mamanpapa33', 'images/user/61853BD8-FDE9-44F6-A049-FEE7EE65E8E0.jpeg', NULL, '0662272478', 1, 0, 0, 1, 1, 1, 0, '', 29, 'No', 'active', '#149153'),
(11, 'christopher', 'lorain', 'Golo', 'christopher.lorain@hotmail.fr', 'gerrard77', 'images/user/3C0A122F-16FF-455F-A3A5-6A778E4048D5.jpeg', NULL, '0788597852', 1, 0, 0, 1, 1, 1, 0, '', 25, 'No', 'active', '#ffec00'),
(12, 'Dalia', 'Aflalaye', 'Queen D', 'dalia.aflalaye@live.fr', 'NL18DF', 'images/user/Photo Win.jpg', NULL, '0649852445', 0, 0, 0, 1, 1, 1, 0, 'Puisse le sort vous être favorable ', 25, 'No', 'active', '#ffec00'),
(13, 'Damien', 'KACHOUH', 'Damo', 'damien.kachouh@gmail.com', 'FR65BZ', 'images/user/default.jpg', NULL, '0767672593', 0, 0, 0, 1, 1, 1, 0, '', 25, 'No', 'active', '#ffec00'),
(14, 'jb', 'GINIES', 'Warikazbi', 'jbginies@yahoo.fr', 'LZ52TR', 'images/user/default.jpg', NULL, '0685877752', 0, 0, 0, 1, 1, 1, 0, '', 25, 'No', 'active', '#ffec00'),
(15, 'Mathias', 'Monica', 'Jah-Bis', 'mathiasmonica@zohomail.eu', 'HT12KL', 'images/user/IMG_20220901_175910.jpg', NULL, '0781958773', 0, 0, 0, 1, 1, 1, 0, 'Pull up, viva ARGENTINAAAAAAAA', 9, 'No', 'active', '#5bbee9');

-- --------------------------------------------------------

--
-- Structure de la table `matches`
--

CREATE TABLE `matches` (
  `id_match` int(11) NOT NULL,
  `id_team_home` int(11) NOT NULL,
  `id_team_away` int(11) NOT NULL,
  `score_home` int(11) NOT NULL DEFAULT 0,
  `score_away` int(11) NOT NULL DEFAULT 0,
  `date` datetime NOT NULL,
  `stadium` varchar(255) NOT NULL,
  `diff` varchar(255) NOT NULL DEFAULT 'BeIn',
  `played` tinyint(1) NOT NULL DEFAULT 0,
  `modif` tinyint(1) NOT NULL DEFAULT 1,
  `groupe` varchar(5) NOT NULL,
  `dayOfstage` tinyint(1) NOT NULL DEFAULT 0,
  `montagne` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `matches`
--

INSERT INTO `matches` (`id_match`, `id_team_home`, `id_team_away`, `score_home`, `score_away`, `date`, `stadium`, `diff`, `played`, `modif`, `groupe`, `dayOfstage`, `montagne`) VALUES
(1, 1, 2, 0, 2, '2022-11-20 17:00:00', 'Al Bayt Stadium', 'TF1 - BeIn1', 1, 2, 'A', 1, 0),
(2, 5, 6, 6, 2, '2022-11-21 14:00:00', 'Khalifa International Stadium', 'BeIn1', 1, 2, 'B', 1, 0),
(3, 3, 4, 0, 2, '2022-11-21 17:00:00', 'Al Thumama Stadium', 'BeIn1', 1, 2, 'A', 1, 0),
(4, 7, 8, 1, 1, '2022-11-21 20:00:00', 'Ahmad Bin Ali Stadium', 'TF1 - BeIn1', 1, 2, 'B', 1, 0),
(5, 9, 10, 1, 2, '2022-11-22 11:00:00', 'Lusail Stadium', 'BeIn1', 1, 2, 'C', 1, 0),
(6, 14, 15, 0, 0, '2022-11-22 14:00:00', 'Education City Stadium', 'BeIn1', 1, 2, 'D', 1, 0),
(7, 11, 12, 0, 0, '2022-11-22 17:00:00', 'Stadium 974', 'BeIn1', 1, 2, 'C', 1, 0),
(8, 13, 16, 4, 1, '2022-11-22 20:00:00', 'Al-Janoub Stadium', 'TF1 - BeIn1', 1, 2, 'D', 1, 0),
(9, 23, 24, 0, 0, '2022-11-23 11:00:00', 'Al Bayt Stadium', 'BeIn1', 1, 2, 'F', 1, 0),
(10, 18, 19, 1, 2, '2022-11-23 14:00:00', 'Khalifa International Stadium', 'BeIn1', 1, 2, 'E', 1, 0),
(11, 17, 20, 7, 0, '2022-11-23 17:00:00', 'Al Thumama Stadium', 'BeIn1', 1, 2, 'E', 1, 0),
(12, 21, 22, 1, 0, '2022-11-23 20:00:00', 'Ahmad Bin Ali Stadium', 'TF1 - BeIn1', 1, 2, 'F', 1, 0),
(13, 27, 28, 1, 0, '2022-11-24 11:00:00', 'Al-Janoub Stadium', 'BeIn1', 1, 2, 'G', 1, 0),
(14, 31, 32, 0, 0, '2022-11-24 14:00:00', 'Education City Stadium', 'BeIn1', 1, 2, 'H', 1, 0),
(15, 29, 30, 3, 2, '2022-11-24 17:00:00', 'Stadium 974', 'BeIn1', 1, 2, 'H', 1, 0),
(16, 25, 26, 2, 0, '2022-11-24 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 1, 2, 'G', 1, 0),
(17, 8, 6, 0, 2, '2022-11-25 11:00:00', 'Ahmad Bin Ali Stadium', 'BeIn1', 1, 2, 'B', 2, 0),
(18, 1, 3, 1, 3, '2022-11-25 14:00:00', 'Al Thumama Stadium', 'BeIn1', 1, 2, 'A', 2, 0),
(19, 4, 2, 1, 1, '2022-11-25 17:00:00', 'Khalifa International Stadium', 'BeIn1', 1, 2, 'A', 2, 0),
(20, 5, 7, 0, 0, '2022-11-25 20:00:00', 'Al Bayt Stadium', 'TF1 - BeIn1', 1, 2, 'B', 2, 0),
(21, 15, 16, 0, 1, '2022-11-26 11:00:00', 'Al-Janoub Stadium', 'BeIn1', 1, 2, 'D', 2, 0),
(22, 12, 10, 2, 0, '2022-11-26 14:00:00', 'Education City Stadium', 'BeIn1', 1, 2, 'C', 2, 0),
(23, 13, 14, 2, 1, '2022-11-26 17:00:00', 'Stadium 974', 'TF1 - BeIn1', 1, 2, 'D', 2, 0),
(24, 9, 11, 2, 0, '2022-11-26 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 1, 2, 'C', 2, 0),
(25, 19, 20, 0, 1, '2022-11-27 11:00:00', 'Ahmad Bin Ali Stadium', 'BeIn1', 1, 2, 'E', 2, 0),
(26, 21, 23, 0, 2, '2022-11-27 14:00:00', 'Al Thumama Stadium', 'TF1 - BeIn1', 1, 2, 'F', 2, 0),
(27, 24, 22, 4, 1, '2022-11-27 17:00:00', 'Khalifa International Stadium', 'BeIn1', 1, 2, 'F', 2, 0),
(28, 17, 18, 1, 1, '2022-11-27 20:00:00', 'Al Bayt Stadium', 'TF1 - BeIn1', 1, 2, 'E', 2, 0),
(29, 28, 26, 3, 3, '2022-11-28 11:00:00', 'Al-Janoub Stadium', 'BeIn1', 1, 2, 'G', 2, 0),
(30, 32, 30, 2, 3, '2022-11-28 14:00:00', 'Education City Stadium', 'BeIn1', 1, 2, 'H', 2, 0),
(31, 25, 27, 1, 0, '2022-11-28 17:00:00', 'Stadium 974', 'BeIn1', 1, 2, 'G', 2, 0),
(32, 29, 31, 2, 0, '2022-11-28 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 1, 2, 'H', 2, 0),
(33, 2, 3, 1, 2, '2022-11-29 16:00:00', 'Khalifa International Stadium', 'BeIn2', 1, 2, 'A', 3, 0),
(34, 4, 1, 2, 0, '2022-11-29 16:00:00', 'Al Bayt Stadium', 'BeIn1', 1, 2, 'A', 3, 0),
(35, 6, 7, 0, 1, '2022-11-29 20:00:00', 'Al Thumama Stadium', 'BeIn2', 1, 2, 'B', 3, 0),
(36, 8, 5, 0, 3, '2022-11-29 20:00:00', 'Ahmad Bin Ali Stadium', 'TF1 - BeIn1', 1, 2, 'B', 3, 0),
(37, 16, 14, 1, 0, '2022-11-30 16:00:00', 'Al-Janoub Stadium', 'BeIn2', 1, 2, 'D', 3, 0),
(38, 15, 13, 1, 0, '2022-11-30 16:00:00', 'Education City Stadium', 'TF1 - BeIn1', 1, 2, 'D', 3, 0),
(39, 10, 11, 1, 2, '2022-11-30 20:00:00', 'Lusail Stadium', 'BeIn2', 1, 2, 'C', 3, 0),
(40, 12, 9, 0, 2, '2022-11-30 20:00:00', 'Stadium 974', 'TF1 - BeIn1', 1, 2, 'C', 3, 0),
(41, 22, 23, 1, 2, '2022-12-01 16:00:00', 'Al Thumama Stadium', 'BeIn2', 1, 2, 'F', 3, 0),
(42, 24, 21, 0, 0, '2022-12-01 16:00:00', 'Ahmad Bin Ali Stadium', 'BeIn1', 1, 2, 'F', 3, 0),
(43, 20, 18, 2, 4, '2022-12-01 20:00:00', 'Al Bayt Stadium', 'BeIn2', 1, 2, 'E', 3, 0),
(44, 19, 17, 2, 1, '2022-12-01 20:00:00', 'Khalifa International Stadium', 'TF1 - BeIn1', 1, 2, 'E', 3, 0),
(45, 30, 31, 0, 2, '2022-12-02 16:00:00', 'Al-Janoub Stadium', 'BeIn2', 1, 2, 'H', 3, 0),
(46, 32, 29, 2, 1, '2022-12-02 16:00:00', 'Education City Stadium', 'BeIn1', 1, 2, 'H', 3, 0),
(47, 26, 27, 2, 3, '2022-12-02 20:00:00', 'Stadium 974', 'BeIn2', 1, 2, 'G', 3, 0),
(48, 28, 25, 1, 0, '2022-12-02 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 1, 2, 'G', 3, 0),
(49, 4, 7, 3, 1, '2022-12-03 16:00:00', 'Khalifa International Stadium', 'BeIn1', 1, 2, '1/8', 0, 0),
(50, 9, 16, 2, 1, '2022-12-03 20:00:00', 'Ahmad Bin Ali Stadium', 'BeIn1', 1, 2, '1/8', 0, 0),
(51, 13, 12, 3, 1, '2022-12-04 16:00:00', 'Al Thumama Stadium', 'BeIn1', 1, 2, '1/8', 0, 0),
(52, 5, 3, 3, 0, '2022-12-04 20:00:00', 'Al Bayt Stadium', 'BeIn1', 1, 2, '1/8', 0, 0),
(53, 19, 24, 1, 1, '2022-12-05 16:00:00', 'Al-Janoub Stadium', 'BeIn1', 1, 2, '1/8', 0, 0),
(54, 25, 32, 4, 1, '2022-12-05 20:00:00', 'Stadium 974', 'BeIn1', 1, 2, '1/8', 0, 0),
(55, 23, 17, 0, 0, '2022-12-06 16:00:00', 'Education City Stadium', 'BeIn1', 1, 2, '1/8', 0, 0),
(56, 29, 27, 6, 1, '2022-12-06 20:00:00', 'Lusail Stadium', 'BeIn1', 1, 2, '1/8', 0, 0),
(57, 24, 25, 1, 1, '2022-12-09 16:00:00', 'Education City Stadium', 'BeIn1', 1, 2, '1/4', 0, 0),
(58, 4, 9, 2, 2, '2022-12-09 20:00:00', 'Lusail Stadium', 'BeIn1', 1, 2, '1/4', 0, 0),
(59, 23, 29, 1, 0, '2022-12-10 16:00:00', 'Al Thumama Stadium', 'BeIn1', 1, 2, '1/4', 0, 0),
(60, 5, 13, 1, 2, '2022-12-10 20:00:00', 'Al Bayt Stadium', 'BeIn1', 1, 2, '1/4', 0, 0),
(61, 9, 24, 3, 0, '2022-12-13 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 1, 2, '1/2', 0, 0),
(62, 13, 23, 2, 0, '2022-12-14 20:00:00', 'Al Bayt Stadium', 'TF1 - BeIn1', 1, 2, '1/2', 0, 0),
(63, 24, 23, 2, 1, '2022-12-17 16:00:00', 'Khalifa International Stadium', 'TF1 - BeIn1', 1, 2, '3', 0, 0),
(64, 9, 13, 3, 3, '2022-12-18 16:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 1, 2, 'Final', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `author_id`, `content`, `created_at`) VALUES
(1, 1, 'Bienvenue à tous pour cette nouvelle Odette Cup !!!', '2022-11-14 19:07:17'),
(2, 1, 'Bienvenue a One Dollar', '2022-11-14 19:07:24'),
(3, 1, 'Bienvenue a Papa Nyk et Debby ', '2022-11-14 19:07:36'),
(4, 1, 'Bienvenue a Adrien !', '2022-11-14 19:08:43'),
(5, 1, 'Bienvenue a Yaya ', '2022-11-14 22:14:45'),
(6, 1, 'Bienvenue a Malvy 4TW et Léa !', '2022-11-15 09:24:51'),
(7, 1, 'Bienvenue a BangBang, Mouche et Golo !', '2022-11-15 13:33:23'),
(8, 7, 'Yallah ! Je te promet pas d\'être actif ici mais le coeur y est !!', '2022-11-15 18:19:56'),
(9, 1, 'Pas de soucis c\'est plus pour la com officiel ici, on a la conv WhatsApp !', '2022-11-15 20:35:34'),
(10, 2, 'Merci Florian pour ce formidable travail ', '2022-11-16 18:23:33'),
(14, 1, 'Et enfin bienvenue a Jah-Bis !!', '2022-11-17 22:12:10'),
(13, 1, 'Bienvenue a Warikazbi ! ', '2022-11-16 19:27:38'),
(15, 15, 'Mon premier perfect 🥲🥲🥲🥲🥲', '2022-11-21 23:16:47');

-- --------------------------------------------------------

--
-- Structure de la table `pronostics`
--

CREATE TABLE `pronostics` (
  `id_pronostic` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `id_match` int(11) NOT NULL,
  `prono_home` int(11) NOT NULL,
  `prono_away` int(11) NOT NULL,
  `point` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pronostics`
--

INSERT INTO `pronostics` (`id_pronostic`, `id_membre`, `id_match`, `prono_home`, `prono_away`, `point`) VALUES
(673, 2, 48, 0, 2, 0),
(672, 2, 47, 1, 1, 0),
(671, 2, 46, 0, 2, 0),
(670, 2, 45, 1, 2, 3),
(669, 2, 44, 0, 1, 0),
(668, 2, 43, 0, 2, 3),
(667, 2, 42, 1, 2, 0),
(666, 2, 41, 1, 1, 0),
(665, 2, 40, 1, 2, 3),
(664, 2, 39, 1, 2, 7),
(663, 2, 38, 1, 2, 0),
(662, 2, 37, 1, 2, 0),
(661, 2, 36, 1, 2, 3),
(660, 2, 35, 1, 2, 3),
(659, 2, 34, 2, 1, 3),
(658, 2, 33, 1, 1, 0),
(657, 2, 32, 2, 1, 3),
(656, 2, 31, 2, 0, 3),
(655, 2, 30, 2, 1, 0),
(654, 2, 29, 1, 1, 3),
(653, 2, 28, 2, 2, 3),
(652, 2, 27, 2, 1, 3),
(651, 2, 26, 2, 1, 0),
(650, 2, 25, 1, 1, 0),
(649, 2, 24, 2, 1, 3),
(648, 2, 23, 2, 1, 7),
(647, 2, 22, 2, 0, 7),
(646, 2, 21, 1, 1, 0),
(645, 2, 20, 2, 1, 0),
(644, 2, 19, 2, 1, 0),
(643, 2, 18, 1, 1, 0),
(642, 2, 17, 2, 0, 1),
(641, 2, 16, 2, 0, 7),
(640, 2, 15, 1, 0, 3),
(639, 2, 14, 2, 1, 0),
(638, 2, 13, 1, 1, 0),
(637, 2, 12, 2, 0, 3),
(636, 2, 11, 2, 0, 3),
(635, 2, 10, 2, 0, 0),
(634, 2, 9, 1, 1, 3),
(633, 2, 8, 2, 1, 3),
(632, 2, 7, 1, 1, 3),
(631, 2, 6, 2, 1, 0),
(630, 2, 5, 3, 0, 0),
(629, 2, 4, 2, 1, 0),
(628, 2, 3, 1, 2, 3),
(627, 2, 2, 3, 0, 3),
(626, 2, 1, 2, 1, 0),
(721, 9, 48, 1, 4, 0),
(720, 9, 47, 1, 1, 0),
(719, 9, 46, 1, 3, 0),
(718, 9, 45, 0, 1, 3),
(717, 9, 44, 0, 1, 0),
(716, 9, 43, 0, 2, 3),
(715, 9, 42, 1, 1, 3),
(714, 9, 41, 1, 2, 7),
(713, 9, 40, 1, 2, 3),
(712, 9, 39, 1, 2, 7),
(711, 9, 38, 0, 3, 0),
(710, 9, 37, 0, 2, 0),
(709, 9, 36, 0, 3, 7),
(708, 9, 35, 1, 2, 3),
(707, 9, 34, 2, 1, 3),
(706, 9, 33, 1, 2, 7),
(705, 9, 32, 1, 1, 0),
(704, 9, 31, 2, 0, 3),
(703, 9, 30, 1, 1, 0),
(702, 9, 29, 0, 2, 0),
(701, 9, 28, 2, 1, 0),
(700, 9, 27, 1, 0, 3),
(699, 9, 26, 2, 1, 0),
(698, 9, 25, 1, 1, 0),
(697, 9, 24, 2, 0, 7),
(696, 9, 23, 2, 1, 7),
(695, 9, 22, 2, 1, 3),
(694, 9, 21, 1, 2, 3),
(693, 9, 20, 2, 2, 3),
(692, 9, 19, 2, 0, 0),
(691, 9, 18, 1, 1, 0),
(690, 9, 17, 1, 1, 0),
(689, 9, 16, 3, 2, 3),
(688, 9, 15, 2, 0, 3),
(687, 9, 14, 2, 1, 0),
(686, 9, 13, 0, 0, 0),
(685, 9, 12, 2, 0, 3),
(684, 9, 11, 3, 1, 3),
(683, 9, 10, 2, 0, 0),
(682, 9, 9, 0, 1, 0),
(681, 9, 8, 3, 0, 3),
(680, 9, 7, 1, 2, 0),
(679, 9, 6, 3, 1, 0),
(678, 9, 5, 2, 1, 1),
(677, 9, 4, 2, 1, 0),
(676, 9, 3, 1, 2, 3),
(675, 9, 2, 3, 0, 3),
(674, 9, 1, 2, 1, 0),
(97, 10, 1, 2, 1, 0),
(98, 10, 2, 2, 0, 3),
(99, 10, 3, 1, 3, 3),
(100, 10, 4, 2, 2, 3),
(101, 10, 5, 3, 1, 0),
(102, 10, 6, 1, 1, 3),
(103, 10, 7, 2, 2, 3),
(104, 10, 8, 3, 2, 3),
(105, 10, 9, 2, 2, 3),
(106, 10, 10, 2, 0, 0),
(107, 10, 11, 2, 2, 0),
(108, 10, 12, 2, 1, 3),
(109, 10, 13, 2, 0, 3),
(110, 10, 14, 2, 1, 0),
(111, 10, 15, 2, 0, 3),
(112, 10, 16, 2, 3, 0),
(113, 10, 17, 1, 1, 0),
(114, 10, 18, 2, 1, 0),
(115, 10, 19, 2, 0, 0),
(116, 10, 20, 3, 2, 0),
(117, 10, 21, 1, 2, 3),
(118, 10, 22, 1, 0, 3),
(119, 10, 23, 2, 1, 7),
(120, 10, 24, 2, 2, 0),
(121, 10, 25, 1, 1, 0),
(122, 10, 26, 1, 1, 0),
(123, 10, 27, 1, 2, 0),
(124, 10, 28, 3, 2, 0),
(125, 10, 29, 1, 2, 0),
(126, 10, 30, 1, 1, 0),
(127, 10, 31, 2, 1, 3),
(128, 10, 32, 1, 0, 3),
(129, 10, 33, 1, 1, 0),
(130, 10, 34, 2, 3, 0),
(131, 10, 35, 1, 2, 3),
(132, 10, 36, 2, 2, 0),
(133, 10, 37, 1, 1, 0),
(134, 10, 38, 0, 4, 0),
(135, 10, 39, 1, 3, 3),
(136, 10, 40, 1, 1, 0),
(137, 10, 41, 2, 1, 1),
(138, 10, 42, 0, 1, 0),
(139, 10, 43, 0, 2, 3),
(140, 10, 44, 1, 1, 0),
(141, 10, 45, 0, 0, 0),
(142, 10, 46, 1, 2, 1),
(143, 10, 47, 2, 1, 0),
(144, 10, 48, 0, 3, 0),
(146, 4, 1, 2, 0, 1),
(147, 4, 2, 4, 0, 3),
(148, 4, 3, 1, 2, 3),
(149, 4, 4, 1, 2, 0),
(150, 4, 5, 4, 0, 0),
(151, 4, 6, 1, 0, 0),
(152, 4, 7, 1, 2, 0),
(153, 4, 8, 2, 0, 3),
(154, 4, 9, 0, 2, 0),
(155, 4, 10, 4, 0, 0),
(156, 4, 11, 3, 0, 3),
(157, 4, 12, 1, 0, 7),
(158, 4, 13, 1, 1, 0),
(159, 4, 14, 2, 0, 0),
(160, 4, 15, 1, 0, 3),
(161, 4, 16, 3, 0, 3),
(162, 4, 17, 2, 0, 1),
(163, 4, 18, 0, 1, 3),
(164, 4, 19, 3, 0, 0),
(165, 4, 20, 3, 0, 0),
(166, 4, 21, 1, 1, 0),
(167, 4, 22, 2, 0, 7),
(168, 4, 23, 1, 1, 0),
(169, 4, 24, 2, 0, 7),
(170, 4, 25, 0, 0, 0),
(171, 4, 26, 2, 1, 0),
(172, 4, 27, 1, 1, 0),
(173, 4, 28, 2, 1, 0),
(174, 4, 29, 1, 0, 0),
(175, 4, 30, 1, 2, 3),
(176, 4, 31, 3, 1, 3),
(177, 4, 32, 0, 0, 0),
(178, 4, 33, 1, 1, 0),
(179, 4, 34, 4, 0, 3),
(180, 4, 35, 1, 1, 0),
(181, 4, 36, 1, 2, 3),
(182, 4, 37, 0, 2, 0),
(183, 4, 38, 0, 3, 0),
(184, 4, 39, 0, 2, 3),
(185, 4, 40, 0, 3, 3),
(186, 4, 41, 0, 0, 0),
(187, 4, 42, 1, 2, 0),
(188, 4, 43, 0, 2, 3),
(189, 4, 44, 1, 3, 0),
(190, 4, 45, 0, 1, 3),
(191, 4, 46, 0, 2, 0),
(192, 4, 47, 2, 1, 0),
(193, 4, 48, 1, 2, 0),
(194, 5, 1, 0, 2, 7),
(195, 5, 2, 3, 0, 3),
(196, 5, 3, 1, 3, 3),
(197, 5, 4, 2, 1, 0),
(198, 5, 5, 3, 0, 0),
(199, 5, 6, 2, 0, 0),
(200, 5, 7, 2, 2, 3),
(201, 5, 8, 3, 0, 3),
(202, 5, 9, 1, 3, 0),
(203, 5, 10, 3, 0, 0),
(204, 5, 11, 4, 0, 3),
(205, 5, 12, 2, 0, 3),
(206, 5, 13, 0, 0, 0),
(207, 5, 14, 1, 0, 0),
(208, 5, 15, 2, 1, 3),
(209, 5, 16, 2, 0, 7),
(210, 5, 17, 1, 0, 0),
(211, 5, 18, 0, 1, 3),
(212, 5, 19, 3, 0, 0),
(213, 5, 20, 3, 1, 0),
(214, 5, 21, 1, 0, 1),
(215, 5, 22, 2, 0, 7),
(216, 5, 23, 2, 1, 7),
(217, 5, 24, 3, 1, 3),
(218, 5, 25, 1, 1, 0),
(219, 5, 26, 3, 0, 0),
(220, 5, 27, 2, 1, 3),
(221, 5, 28, 1, 3, 0),
(222, 5, 29, 1, 2, 0),
(223, 5, 30, 2, 1, 0),
(224, 5, 31, 4, 1, 3),
(225, 5, 32, 2, 2, 0),
(226, 5, 33, 1, 0, 0),
(227, 5, 34, 4, 0, 3),
(228, 5, 35, 0, 0, 0),
(229, 5, 36, 1, 3, 3),
(230, 5, 37, 0, 2, 0),
(231, 5, 38, 1, 3, 0),
(232, 5, 39, 0, 1, 3),
(233, 5, 40, 1, 3, 3),
(234, 5, 41, 2, 0, 0),
(235, 5, 42, 3, 4, 0),
(236, 5, 43, 0, 5, 3),
(237, 5, 44, 1, 3, 0),
(238, 5, 45, 0, 3, 3),
(239, 5, 46, 1, 2, 1),
(240, 5, 47, 1, 0, 0),
(241, 5, 48, 0, 3, 0),
(337, 1, 48, 0, 4, 0),
(336, 1, 47, 2, 1, 0),
(335, 1, 46, 1, 2, 1),
(334, 1, 45, 0, 2, 7),
(333, 1, 44, 1, 2, 1),
(332, 1, 43, 0, 3, 3),
(331, 1, 42, 2, 1, 0),
(330, 1, 41, 1, 2, 7),
(329, 1, 40, 1, 2, 3),
(328, 1, 39, 0, 2, 3),
(327, 1, 38, 1, 2, 0),
(326, 1, 37, 0, 2, 0),
(325, 1, 36, 0, 2, 3),
(324, 1, 35, 1, 2, 3),
(323, 1, 34, 3, 0, 3),
(322, 1, 33, 1, 1, 0),
(321, 1, 32, 2, 1, 3),
(320, 1, 31, 2, 0, 3),
(319, 1, 30, 2, 0, 0),
(318, 1, 29, 0, 2, 0),
(317, 1, 28, 1, 1, 7),
(316, 1, 27, 1, 0, 3),
(315, 1, 26, 2, 0, 1),
(314, 1, 25, 2, 0, 0),
(313, 1, 24, 3, 0, 3),
(312, 1, 23, 1, 1, 0),
(311, 1, 22, 2, 1, 3),
(310, 1, 21, 2, 1, 0),
(309, 1, 20, 1, 0, 0),
(308, 1, 19, 3, 0, 0),
(307, 1, 18, 0, 2, 3),
(306, 1, 17, 2, 1, 0),
(305, 1, 16, 2, 0, 7),
(304, 1, 15, 2, 0, 3),
(303, 1, 14, 1, 0, 0),
(302, 1, 13, 1, 0, 7),
(301, 1, 12, 1, 0, 7),
(300, 1, 11, 3, 1, 3),
(299, 1, 10, 2, 0, 0),
(298, 1, 9, 1, 2, 0),
(297, 1, 8, 2, 0, 3),
(296, 1, 7, 0, 1, 0),
(295, 1, 6, 3, 1, 0),
(294, 1, 5, 3, 0, 0),
(293, 1, 4, 1, 2, 0),
(292, 1, 3, 0, 2, 7),
(291, 1, 2, 3, 1, 3),
(290, 1, 1, 1, 1, 0),
(577, 11, 48, 0, 2, 0),
(576, 11, 47, 1, 1, 0),
(575, 11, 46, 1, 2, 1),
(574, 11, 45, 0, 1, 3),
(573, 11, 44, 0, 1, 0),
(572, 11, 43, 0, 2, 3),
(571, 11, 42, 1, 1, 3),
(570, 11, 41, 1, 2, 7),
(569, 11, 40, 1, 2, 3),
(568, 11, 39, 0, 2, 3),
(567, 11, 38, 0, 1, 1),
(566, 11, 37, 0, 1, 1),
(565, 11, 36, 1, 3, 3),
(564, 11, 35, 1, 2, 3),
(563, 11, 34, 2, 1, 3),
(562, 11, 33, 1, 2, 7),
(561, 11, 32, 1, 1, 0),
(560, 11, 31, 2, 0, 3),
(559, 11, 30, 1, 1, 0),
(558, 11, 29, 1, 2, 0),
(557, 11, 28, 1, 1, 7),
(556, 11, 27, 2, 1, 3),
(555, 11, 26, 1, 1, 0),
(554, 11, 25, 1, 0, 1),
(553, 11, 24, 2, 1, 3),
(552, 11, 23, 1, 0, 3),
(551, 11, 22, 2, 0, 7),
(550, 11, 21, 1, 0, 1),
(549, 11, 20, 2, 1, 0),
(548, 11, 19, 2, 0, 0),
(547, 11, 18, 1, 1, 0),
(546, 11, 17, 1, 2, 3),
(545, 11, 16, 2, 0, 7),
(544, 11, 15, 2, 1, 3),
(543, 11, 14, 2, 1, 0),
(542, 11, 13, 1, 1, 0),
(541, 11, 12, 1, 1, 0),
(540, 11, 11, 2, 0, 3),
(539, 11, 10, 3, 1, 0),
(538, 11, 9, 1, 1, 3),
(537, 11, 8, 1, 0, 3),
(536, 11, 7, 2, 1, 0),
(535, 11, 6, 1, 0, 0),
(534, 11, 5, 2, 0, 0),
(533, 11, 4, 2, 1, 0),
(532, 11, 3, 1, 2, 3),
(531, 11, 2, 2, 0, 3),
(530, 11, 1, 1, 1, 0),
(722, 15, 1, 2, 2, 0),
(723, 15, 2, 2, 0, 3),
(724, 15, 3, 2, 1, 0),
(725, 15, 4, 1, 1, 7),
(726, 15, 5, 4, 0, 0),
(727, 15, 6, 1, 0, 0),
(728, 15, 7, 1, 0, 0),
(729, 15, 8, 3, 1, 3),
(730, 15, 9, 1, 2, 0),
(731, 15, 10, 2, 1, 1),
(732, 15, 11, 2, 2, 0),
(733, 15, 12, 3, 1, 3),
(734, 15, 13, 0, 1, 1),
(735, 15, 14, 2, 1, 0),
(736, 15, 15, 2, 0, 3),
(737, 15, 16, 3, 0, 3),
(738, 15, 17, 1, 0, 0),
(739, 15, 18, 0, 2, 3),
(740, 15, 19, 1, 0, 0),
(741, 15, 20, 2, 0, 0),
(742, 15, 21, 1, 1, 0),
(743, 15, 22, 1, 0, 3),
(744, 15, 23, 3, 1, 3),
(745, 15, 24, 2, 0, 7),
(746, 15, 25, 1, 0, 1),
(747, 15, 26, 3, 0, 0),
(748, 15, 27, 1, 0, 3),
(749, 15, 28, 2, 2, 3),
(750, 15, 29, 1, 1, 3),
(751, 15, 30, 1, 1, 0),
(752, 15, 31, 2, 0, 3),
(753, 15, 32, 2, 2, 0),
(754, 15, 33, 1, 1, 0),
(755, 15, 34, 2, 0, 7),
(756, 15, 35, 0, 1, 7),
(757, 15, 36, 1, 3, 3),
(758, 15, 37, 1, 1, 0),
(759, 15, 38, 1, 2, 0),
(760, 15, 39, 0, 2, 3),
(761, 15, 40, 0, 3, 3),
(762, 15, 41, 1, 1, 0),
(763, 15, 42, 2, 3, 0),
(764, 15, 43, 1, 2, 3),
(765, 15, 44, 0, 1, 0),
(766, 15, 45, 0, 2, 7),
(767, 15, 46, 1, 2, 1),
(768, 15, 47, 0, 1, 3),
(769, 15, 48, 1, 4, 0),
(770, 13, 1, 1, 1, 0),
(771, 13, 2, 3, 0, 3),
(772, 13, 3, 1, 2, 3),
(773, 13, 4, 2, 2, 3),
(774, 13, 5, 3, 0, 0),
(775, 13, 6, 1, 0, 0),
(776, 13, 7, 1, 1, 3),
(777, 13, 8, 2, 1, 3),
(778, 13, 9, 0, 1, 0),
(779, 13, 10, 2, 1, 1),
(780, 13, 11, 2, 0, 3),
(781, 13, 12, 4, 1, 3),
(782, 13, 13, 2, 2, 0),
(783, 13, 14, 2, 1, 0),
(784, 13, 15, 3, 1, 3),
(785, 13, 16, 2, 1, 3),
(786, 13, 17, 2, 1, 0),
(787, 13, 18, 0, 1, 3),
(788, 13, 19, 1, 0, 0),
(789, 13, 20, 2, 1, 0),
(790, 13, 21, 1, 1, 0),
(791, 13, 22, 3, 1, 3),
(792, 13, 23, 1, 1, 0),
(793, 13, 24, 2, 1, 3),
(794, 13, 25, 1, 1, 0),
(795, 13, 26, 2, 0, 1),
(796, 13, 27, 2, 1, 3),
(797, 13, 28, 2, 2, 3),
(798, 13, 29, 2, 1, 0),
(799, 13, 30, 1, 1, 0),
(800, 13, 31, 2, 0, 3),
(801, 13, 32, 2, 1, 3),
(802, 13, 33, 1, 1, 0),
(803, 13, 34, 2, 0, 7),
(804, 13, 35, 1, 0, 1),
(805, 13, 36, 1, 2, 3),
(806, 13, 37, 1, 2, 0),
(807, 13, 38, 0, 2, 0),
(808, 13, 39, 0, 2, 3),
(809, 13, 40, 1, 2, 3),
(810, 13, 41, 1, 1, 0),
(811, 13, 42, 1, 2, 0),
(812, 13, 43, 1, 3, 3),
(813, 13, 44, 0, 1, 0),
(814, 13, 45, 1, 2, 3),
(815, 13, 46, 0, 1, 0),
(816, 13, 47, 0, 1, 3),
(817, 13, 48, 1, 3, 0),
(818, 7, 1, 0, 2, 7),
(819, 7, 2, 2, 0, 3),
(820, 7, 3, 1, 2, 3),
(821, 7, 4, 1, 1, 7),
(822, 7, 5, 4, 0, 0),
(823, 7, 6, 1, 0, 0),
(824, 7, 7, 0, 0, 7),
(825, 7, 8, 2, 0, 3),
(826, 7, 9, 1, 0, 0),
(827, 7, 10, 2, 1, 1),
(828, 7, 11, 1, 0, 3),
(829, 7, 12, 3, 0, 3),
(830, 7, 13, 1, 1, 0),
(831, 7, 14, 1, 0, 0),
(832, 7, 15, 2, 1, 3),
(833, 7, 16, 1, 0, 3),
(834, 7, 17, 1, 0, 0),
(835, 7, 18, 1, 2, 3),
(836, 7, 19, 2, 0, 0),
(837, 7, 20, 3, 0, 0),
(838, 7, 21, 1, 1, 0),
(839, 7, 22, 2, 1, 3),
(840, 7, 23, 1, 2, 1),
(841, 7, 24, 3, 1, 3),
(842, 7, 25, 1, 0, 1),
(843, 7, 26, 2, 1, 0),
(844, 7, 27, 2, 1, 3),
(845, 7, 28, 1, 2, 0),
(846, 7, 29, 1, 2, 0),
(847, 7, 30, 1, 1, 0),
(848, 7, 31, 3, 0, 3),
(849, 7, 32, 1, 0, 3),
(850, 7, 33, 1, 0, 0),
(851, 7, 34, 3, 0, 3),
(852, 7, 35, 0, 1, 7),
(853, 7, 36, 1, 1, 0),
(854, 7, 37, 1, 2, 0),
(855, 7, 38, 1, 3, 0),
(856, 7, 39, 0, 2, 3),
(857, 7, 40, 1, 1, 0),
(858, 7, 41, 1, 1, 0),
(859, 7, 42, 2, 1, 0),
(860, 7, 43, 0, 3, 3),
(861, 7, 44, 1, 1, 0),
(862, 7, 45, 0, 1, 3),
(863, 7, 46, 0, 2, 0),
(864, 7, 47, 1, 1, 0),
(865, 7, 48, 1, 2, 0),
(866, 12, 1, 1, 2, 3),
(867, 12, 2, 3, 0, 3),
(868, 12, 3, 0, 2, 7),
(869, 12, 4, 1, 1, 7),
(870, 12, 5, 3, 0, 0),
(871, 12, 6, 2, 0, 0),
(872, 12, 7, 2, 2, 3),
(873, 12, 8, 1, 0, 3),
(874, 12, 9, 1, 1, 3),
(875, 12, 10, 2, 0, 0),
(876, 12, 11, 3, 1, 3),
(877, 12, 12, 2, 0, 3),
(878, 12, 13, 1, 0, 7),
(879, 12, 14, 2, 0, 0),
(880, 12, 15, 3, 1, 3),
(881, 12, 16, 3, 1, 3),
(882, 12, 17, 1, 0, 0),
(883, 12, 18, 1, 1, 0),
(884, 12, 19, 2, 1, 0),
(885, 12, 20, 2, 1, 0),
(886, 12, 21, 0, 0, 0),
(887, 12, 22, 1, 0, 3),
(888, 12, 23, 2, 1, 7),
(889, 12, 24, 3, 1, 3),
(890, 12, 25, 1, 0, 1),
(891, 12, 26, 2, 1, 0),
(892, 12, 27, 2, 1, 3),
(893, 12, 28, 2, 2, 3),
(894, 12, 29, 1, 2, 0),
(895, 12, 30, 1, 0, 0),
(896, 12, 31, 2, 0, 3),
(897, 12, 32, 3, 2, 3),
(898, 12, 33, 0, 1, 3),
(899, 12, 34, 2, 0, 7),
(900, 12, 35, 0, 2, 3),
(901, 12, 36, 1, 2, 3),
(902, 12, 37, 0, 1, 1),
(903, 12, 38, 1, 1, 0),
(904, 12, 39, 1, 2, 7),
(905, 12, 40, 1, 2, 3),
(906, 12, 41, 2, 1, 1),
(907, 12, 42, 2, 2, 3),
(908, 12, 43, 0, 2, 3),
(909, 12, 44, 1, 2, 1),
(910, 12, 45, 0, 2, 7),
(911, 12, 46, 0, 1, 0),
(912, 12, 47, 2, 1, 0),
(913, 12, 48, 0, 2, 0),
(1201, 3, 48, 0, 4, 0),
(1200, 3, 47, 1, 2, 3),
(1199, 3, 46, 1, 2, 1),
(1198, 3, 45, 2, 2, 0),
(1197, 3, 44, 0, 2, 0),
(1196, 3, 43, 0, 3, 3),
(1195, 3, 42, 1, 2, 0),
(1194, 3, 41, 0, 1, 3),
(1193, 3, 40, 0, 2, 7),
(1192, 3, 39, 0, 3, 3),
(1191, 3, 38, 1, 3, 0),
(1190, 3, 37, 1, 3, 0),
(1189, 3, 36, 0, 2, 3),
(1188, 3, 35, 0, 1, 7),
(1187, 3, 34, 2, 0, 7),
(1186, 3, 33, 0, 1, 3),
(1185, 3, 32, 1, 1, 0),
(1184, 3, 31, 3, 1, 3),
(1183, 3, 30, 0, 1, 3),
(1182, 3, 29, 1, 2, 0),
(1181, 3, 28, 2, 2, 3),
(1180, 3, 27, 2, 0, 3),
(1179, 3, 26, 2, 1, 0),
(1178, 3, 25, 2, 1, 0),
(1177, 3, 24, 3, 0, 3),
(1176, 3, 23, 0, 1, 0),
(1175, 3, 22, 3, 0, 3),
(1174, 3, 21, 2, 0, 0),
(1173, 3, 20, 2, 0, 0),
(1172, 3, 19, 2, 1, 0),
(1171, 3, 18, 1, 1, 0),
(1170, 3, 17, 2, 1, 0),
(1169, 3, 16, 3, 0, 3),
(1168, 3, 15, 2, 1, 3),
(1167, 3, 14, 1, 1, 3),
(1166, 3, 13, 2, 0, 3),
(1165, 3, 12, 3, 0, 3),
(1164, 3, 11, 3, 0, 3),
(1163, 3, 10, 3, 0, 0),
(1162, 3, 9, 1, 2, 0),
(1161, 3, 8, 2, 1, 3),
(1160, 3, 7, 1, 1, 3),
(1159, 3, 6, 2, 1, 0),
(1158, 3, 5, 3, 0, 0),
(1157, 3, 4, 1, 1, 7),
(1156, 3, 3, 1, 2, 3),
(1155, 3, 2, 3, 0, 3),
(1154, 3, 1, 1, 0, 0),
(962, 6, 1, 0, 0, 0),
(963, 6, 2, 3, 0, 3),
(964, 6, 3, 1, 2, 3),
(965, 6, 4, 1, 1, 7),
(966, 6, 5, 4, 0, 0),
(967, 6, 6, 1, 1, 3),
(968, 6, 7, 1, 1, 3),
(969, 6, 8, 3, 1, 3),
(970, 6, 9, 1, 2, 0),
(971, 6, 10, 3, 0, 0),
(972, 6, 11, 2, 1, 3),
(973, 6, 12, 3, 1, 3),
(974, 6, 13, 0, 0, 0),
(975, 6, 14, 2, 0, 0),
(976, 6, 15, 3, 1, 3),
(977, 6, 16, 3, 0, 3),
(978, 6, 17, 1, 0, 0),
(979, 6, 18, 0, 2, 3),
(980, 6, 19, 3, 1, 0),
(981, 6, 20, 3, 1, 0),
(982, 6, 21, 2, 1, 0),
(983, 6, 22, 2, 0, 7),
(984, 6, 23, 1, 0, 3),
(985, 6, 24, 3, 1, 3),
(986, 6, 25, 1, 1, 0),
(987, 6, 26, 2, 0, 1),
(988, 6, 27, 1, 1, 0),
(989, 6, 28, 1, 2, 0),
(990, 6, 29, 1, 1, 3),
(991, 6, 30, 1, 2, 3),
(992, 6, 31, 2, 0, 3),
(993, 6, 32, 2, 2, 0),
(994, 6, 33, 1, 2, 7),
(995, 6, 34, 3, 0, 3),
(996, 6, 35, 0, 2, 3),
(997, 6, 36, 1, 2, 3),
(998, 6, 37, 0, 2, 0),
(999, 6, 38, 1, 2, 0),
(1000, 6, 39, 1, 3, 3),
(1001, 6, 40, 1, 2, 3),
(1002, 6, 41, 2, 2, 0),
(1003, 6, 42, 1, 2, 0),
(1004, 6, 43, 1, 3, 3),
(1005, 6, 44, 1, 2, 1),
(1006, 6, 45, 1, 1, 0),
(1007, 6, 46, 0, 2, 0),
(1008, 6, 47, 1, 2, 3),
(1009, 6, 48, 1, 3, 0),
(1010, 8, 1, 1, 2, 3),
(1011, 8, 2, 3, 0, 3),
(1012, 8, 3, 2, 2, 0),
(1013, 8, 4, 1, 2, 0),
(1014, 8, 5, 3, 0, 0),
(1015, 8, 6, 2, 1, 0),
(1016, 8, 7, 2, 2, 3),
(1017, 8, 8, 2, 1, 3),
(1018, 8, 9, 1, 2, 0),
(1019, 8, 10, 3, 0, 0),
(1020, 8, 11, 1, 1, 0),
(1021, 8, 12, 2, 0, 3),
(1022, 8, 13, 1, 2, 0),
(1023, 8, 14, 2, 0, 0),
(1024, 8, 15, 2, 1, 3),
(1025, 8, 16, 3, 1, 3),
(1026, 8, 17, 2, 1, 0),
(1027, 8, 18, 0, 2, 3),
(1028, 8, 19, 2, 2, 3),
(1029, 8, 20, 4, 2, 0),
(1030, 8, 21, 2, 2, 0),
(1031, 8, 22, 3, 0, 3),
(1032, 8, 23, 2, 1, 7),
(1033, 8, 24, 3, 2, 3),
(1034, 8, 25, 1, 2, 3),
(1035, 8, 26, 2, 1, 0),
(1036, 8, 27, 3, 1, 3),
(1037, 8, 28, 1, 3, 0),
(1038, 8, 29, 1, 1, 3),
(1039, 8, 30, 1, 2, 3),
(1040, 8, 31, 3, 1, 3),
(1041, 8, 32, 2, 2, 0),
(1042, 8, 33, 1, 2, 7),
(1043, 8, 34, 2, 0, 7),
(1044, 8, 35, 1, 2, 3),
(1045, 8, 36, 2, 3, 3),
(1046, 8, 37, 1, 3, 0),
(1047, 8, 38, 1, 3, 0),
(1048, 8, 39, 1, 3, 3),
(1049, 8, 40, 2, 3, 3),
(1050, 8, 41, 2, 2, 0),
(1051, 8, 42, 2, 2, 3),
(1052, 8, 43, 2, 4, 7),
(1053, 8, 44, 1, 2, 1),
(1054, 8, 45, 1, 3, 3),
(1055, 8, 46, 0, 2, 0),
(1056, 8, 47, 2, 1, 0),
(1057, 8, 48, 1, 3, 0),
(1345, 14, 48, 0, 3, 0),
(1344, 14, 47, 1, 4, 3),
(1343, 14, 46, 1, 1, 0),
(1342, 14, 45, 0, 0, 0),
(1341, 14, 44, 1, 3, 0),
(1340, 14, 43, 0, 2, 3),
(1339, 14, 42, 2, 2, 3),
(1338, 14, 41, 1, 2, 7),
(1337, 14, 40, 0, 1, 3),
(1336, 14, 39, 1, 3, 3),
(1335, 14, 38, 0, 2, 0),
(1334, 14, 37, 1, 3, 0),
(1333, 14, 36, 1, 2, 3),
(1332, 14, 35, 1, 1, 0),
(1331, 14, 34, 3, 0, 3),
(1330, 14, 33, 1, 3, 3),
(1329, 14, 32, 1, 3, 0),
(1328, 14, 31, 4, 2, 3),
(1327, 14, 30, 0, 1, 3),
(1326, 14, 29, 2, 2, 3),
(1325, 14, 28, 2, 2, 3),
(1324, 14, 27, 1, 0, 3),
(1323, 14, 26, 2, 1, 0),
(1322, 14, 25, 1, 1, 0),
(1321, 14, 24, 2, 1, 3),
(1320, 14, 23, 0, 0, 0),
(1319, 14, 22, 2, 0, 7),
(1318, 14, 21, 1, 1, 0),
(1317, 14, 20, 3, 0, 0),
(1316, 14, 19, 4, 0, 0),
(1315, 14, 18, 1, 0, 0),
(1314, 14, 17, 2, 1, 0),
(1313, 14, 16, 4, 0, 3),
(1312, 14, 15, 2, 2, 0),
(1311, 14, 14, 1, 1, 3),
(1310, 14, 13, 3, 1, 3),
(1309, 14, 12, 2, 0, 3),
(1308, 14, 11, 4, 0, 3),
(1307, 14, 10, 3, 0, 0),
(1306, 14, 9, 1, 1, 3),
(1305, 14, 8, 2, 0, 3),
(1304, 14, 7, 2, 2, 3),
(1303, 14, 6, 1, 0, 0),
(1302, 14, 5, 4, 0, 0),
(1301, 14, 4, 1, 3, 0),
(1300, 14, 3, 1, 2, 3),
(1299, 14, 2, 4, 1, 3),
(1298, 14, 1, 1, 1, 0),
(1473, 1, 56, 2, 0, 3),
(1472, 1, 55, 1, 2, 0),
(1471, 1, 54, 2, 0, 3),
(1470, 1, 53, 1, 0, 0),
(1469, 1, 52, 2, 0, 3),
(1468, 1, 51, 2, 0, 3),
(1467, 1, 50, 2, 0, 3),
(1466, 1, 49, 1, 0, 3),
(1354, 5, 49, 2, 0, 3),
(1355, 5, 50, 3, 0, 3),
(1356, 5, 51, 4, 1, 3),
(1357, 5, 52, 2, 1, 3),
(1358, 5, 53, 1, 2, 0),
(1359, 5, 54, 3, 0, 3),
(1360, 5, 55, 0, 2, 0),
(1361, 5, 56, 2, 1, 3),
(1362, 2, 49, 2, 1, 3),
(1363, 2, 50, 2, 1, 7),
(1364, 2, 51, 2, 1, 3),
(1365, 2, 52, 2, 1, 3),
(1366, 2, 53, 1, 2, 0),
(1367, 2, 54, 2, 1, 3),
(1368, 2, 55, 1, 2, 0),
(1369, 2, 56, 2, 1, 3),
(1370, 14, 49, 2, 0, 3),
(1371, 14, 50, 1, 0, 3),
(1372, 14, 51, 2, 0, 3),
(1373, 14, 52, 3, 1, 3),
(1374, 14, 53, 0, 0, 3),
(1375, 14, 54, 4, 1, 7),
(1376, 14, 55, 1, 1, 3),
(1377, 14, 56, 2, 1, 3),
(1481, 3, 56, 2, 1, 3),
(1480, 3, 55, 0, 1, 0),
(1479, 3, 54, 3, 0, 3),
(1478, 3, 53, 2, 1, 0),
(1477, 3, 52, 3, 1, 3),
(1476, 3, 51, 0, 1, 0),
(1475, 3, 50, 2, 0, 3),
(1474, 3, 49, 2, 0, 3),
(1386, 10, 49, 1, 0, 3),
(1387, 10, 50, 2, 1, 7),
(1388, 10, 51, 3, 1, 7),
(1389, 10, 52, 1, 0, 3),
(1390, 10, 53, 2, 1, 0),
(1391, 10, 54, 1, 0, 3),
(1392, 10, 55, 1, 2, 0),
(1393, 10, 56, 2, 1, 3),
(1394, 9, 49, 2, 1, 3),
(1395, 9, 50, 2, 0, 3),
(1396, 9, 51, 2, 0, 3),
(1397, 9, 52, 2, 1, 3),
(1398, 9, 53, 1, 1, 7),
(1399, 9, 54, 2, 1, 3),
(1400, 9, 55, 0, 1, 0),
(1401, 9, 56, 3, 2, 3),
(1417, 11, 56, 2, 1, 3),
(1416, 11, 55, 0, 1, 0),
(1415, 11, 54, 2, 0, 3),
(1414, 11, 53, 1, 2, 0),
(1413, 11, 52, 1, 1, 0),
(1412, 11, 51, 1, 0, 3),
(1411, 11, 50, 2, 0, 3),
(1410, 11, 49, 1, 0, 3),
(1441, 4, 56, 1, 1, 0),
(1440, 4, 55, 1, 2, 0),
(1439, 4, 54, 2, 0, 3),
(1438, 4, 53, 1, 0, 0),
(1437, 4, 52, 2, 1, 3),
(1436, 4, 51, 2, 1, 3),
(1435, 4, 50, 3, 1, 3),
(1434, 4, 49, 2, 0, 3),
(1442, 12, 49, 2, 1, 3),
(1443, 12, 50, 3, 0, 3),
(1444, 12, 51, 2, 1, 3),
(1445, 12, 52, 2, 1, 3),
(1446, 12, 53, 1, 2, 0),
(1447, 12, 54, 3, 1, 3),
(1448, 12, 55, 0, 1, 0),
(1449, 12, 56, 2, 0, 3),
(1450, 7, 49, 1, 1, 0),
(1451, 7, 50, 2, 0, 3),
(1452, 7, 51, 4, 1, 3),
(1453, 7, 52, 2, 1, 3),
(1454, 7, 53, 2, 1, 0),
(1455, 7, 54, 2, 0, 3),
(1456, 7, 55, 1, 1, 3),
(1457, 7, 56, 1, 0, 3),
(1458, 15, 49, 1, 1, 0),
(1459, 15, 50, 3, 0, 3),
(1460, 15, 51, 2, 0, 3),
(1461, 15, 52, 2, 0, 3),
(1462, 15, 53, 2, 1, 0),
(1463, 15, 54, 2, 0, 3),
(1464, 15, 55, 1, 3, 0),
(1465, 15, 56, 1, 1, 0),
(1482, 6, 49, 1, 0, 3),
(1483, 6, 50, 3, 0, 3),
(1484, 6, 51, 2, 0, 3),
(1485, 6, 52, 1, 1, 0),
(1486, 6, 53, 0, 0, 3),
(1487, 6, 54, 3, 1, 3),
(1488, 6, 55, 2, 1, 0),
(1489, 6, 56, 3, 1, 3),
(1505, 8, 56, 3, 1, 3),
(1504, 8, 55, 2, 3, 0),
(1503, 8, 54, 3, 1, 3),
(1502, 8, 53, 2, 2, 3),
(1501, 8, 52, 2, 1, 3),
(1500, 8, 51, 3, 1, 7),
(1499, 8, 50, 3, 1, 3),
(1498, 8, 49, 2, 1, 3),
(1506, 13, 49, 2, 1, 3),
(1507, 13, 50, 3, 0, 3),
(1508, 13, 51, 3, 1, 7),
(1509, 13, 52, 2, 0, 3),
(1510, 13, 53, 0, 1, 0),
(1511, 13, 54, 3, 0, 3),
(1512, 13, 55, 1, 3, 0),
(1513, 13, 56, 2, 0, 3),
(1605, 1, 60, 2, 1, 1),
(1604, 1, 59, 0, 3, 0),
(1603, 1, 58, 0, 1, 0),
(1602, 1, 57, 0, 2, 0),
(1526, 6, 57, 1, 4, 0),
(1527, 6, 58, 1, 2, 0),
(1528, 6, 59, 1, 1, 0),
(1529, 6, 60, 1, 2, 7),
(1530, 8, 57, 2, 4, 0),
(1531, 8, 58, 1, 2, 0),
(1532, 8, 59, 1, 1, 0),
(1533, 8, 60, 1, 2, 7),
(1534, 14, 57, 0, 3, 0),
(1535, 14, 58, 1, 1, 3),
(1536, 14, 59, 1, 2, 0),
(1537, 14, 60, 1, 1, 0),
(1549, 11, 60, 1, 2, 7),
(1548, 11, 59, 0, 1, 1),
(1547, 11, 58, 1, 1, 3),
(1546, 11, 57, 0, 2, 0),
(1550, 3, 57, 1, 3, 0),
(1551, 3, 58, 1, 0, 0),
(1552, 3, 59, 0, 1, 1),
(1553, 3, 60, 1, 3, 3),
(1561, 2, 60, 1, 2, 7),
(1560, 2, 59, 0, 2, 0),
(1559, 2, 58, 1, 2, 0),
(1558, 2, 57, 0, 2, 0),
(1562, 5, 57, 0, 2, 0),
(1563, 5, 58, 1, 2, 0),
(1564, 5, 59, 0, 2, 0),
(1565, 5, 60, 1, 3, 3),
(1566, 7, 57, 0, 2, 0),
(1567, 7, 58, 2, 1, 0),
(1568, 7, 59, 0, 3, 0),
(1569, 7, 60, 1, 3, 3),
(1570, 12, 57, 0, 4, 0),
(1571, 12, 58, 1, 2, 0),
(1572, 12, 59, 0, 2, 0),
(1573, 12, 60, 2, 3, 3),
(1574, 4, 57, 1, 4, 0),
(1575, 4, 58, 2, 2, 7),
(1576, 4, 59, 1, 3, 0),
(1577, 4, 60, 1, 2, 7),
(1578, 15, 57, 1, 3, 0),
(1579, 15, 58, 1, 2, 0),
(1580, 15, 59, 1, 3, 0),
(1581, 15, 60, 1, 1, 0),
(1582, 9, 57, 1, 2, 0),
(1583, 9, 58, 1, 1, 3),
(1584, 9, 59, 1, 2, 0),
(1585, 9, 60, 1, 2, 7),
(1593, 10, 60, 2, 1, 1),
(1592, 10, 59, 0, 0, 0),
(1591, 10, 58, 2, 1, 0),
(1590, 10, 57, 2, 2, 3),
(1601, 13, 60, 2, 1, 1),
(1600, 13, 59, 0, 2, 0),
(1599, 13, 58, 1, 2, 0),
(1598, 13, 57, 1, 3, 0),
(1633, 1, 62, 1, 0, 3),
(1632, 1, 61, 3, 1, 3),
(1614, 15, 61, 2, 1, 3),
(1615, 15, 62, 1, 0, 3),
(1616, 14, 61, 2, 1, 3),
(1617, 14, 62, 3, 1, 3),
(1637, 4, 62, 2, 0, 7),
(1636, 4, 61, 2, 2, 0),
(1620, 3, 61, 1, 2, 0),
(1621, 3, 62, 1, 0, 3),
(1622, 2, 61, 1, 0, 3),
(1623, 2, 62, 2, 0, 7),
(1624, 5, 61, 2, 0, 3),
(1625, 5, 62, 2, 0, 7),
(1626, 13, 61, 2, 1, 3),
(1627, 13, 62, 2, 1, 3),
(1628, 8, 61, 2, 2, 0),
(1629, 8, 62, 2, 1, 3),
(1638, 11, 61, 1, 0, 3),
(1639, 11, 62, 1, 0, 3),
(1640, 9, 61, 1, 0, 3),
(1641, 9, 62, 2, 1, 3),
(1642, 10, 61, 2, 1, 3),
(1643, 10, 62, 2, 0, 7),
(1644, 6, 61, 1, 0, 3),
(1645, 6, 62, 3, 1, 3),
(1646, 7, 61, 1, 1, 0),
(1647, 7, 62, 3, 1, 3),
(1651, 12, 62, 2, 0, 7),
(1650, 12, 61, 2, 1, 3),
(1683, 1, 64, 2, 1, 0),
(1682, 1, 63, 1, 0, 3),
(1695, 4, 64, 2, 4, 0),
(1694, 4, 63, 2, 1, 7),
(1656, 15, 63, 2, 1, 7),
(1657, 15, 64, 3, 2, 0),
(1658, 2, 63, 2, 1, 7),
(1659, 2, 64, 2, 1, 0),
(1660, 7, 63, 2, 1, 7),
(1661, 7, 64, 0, 3, 0),
(1662, 12, 63, 1, 0, 3),
(1663, 12, 64, 2, 3, 0),
(1664, 5, 63, 3, 1, 3),
(1665, 5, 64, 2, 3, 0),
(1668, 3, 63, 3, 0, 3),
(1669, 3, 64, 3, 2, 0),
(1670, 9, 63, 1, 0, 3),
(1671, 9, 64, 1, 2, 0),
(1672, 10, 63, 1, 1, 0),
(1673, 10, 64, 2, 1, 0),
(1676, 14, 63, 2, 1, 7),
(1677, 14, 64, 1, 1, 6),
(1678, 11, 63, 2, 0, 3),
(1679, 11, 64, 1, 2, 0),
(1680, 6, 63, 1, 1, 0),
(1681, 6, 64, 1, 1, 6),
(1684, 8, 63, 2, 1, 7),
(1685, 8, 64, 1, 3, 0),
(1691, 13, 64, 2, 1, 0),
(1690, 13, 63, 2, 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `pronostics_bonus`
--

CREATE TABLE `pronostics_bonus` (
  `id_membre` int(11) NOT NULL,
  `team_winner_id` int(11) NOT NULL,
  `team_winner_id_point` int(4) DEFAULT -1,
  `min_first` int(11) DEFAULT NULL,
  `min_first_point` int(4) DEFAULT -1,
  `min_last` int(11) DEFAULT NULL,
  `min_last_point` int(4) DEFAULT -1,
  `total_but` int(11) DEFAULT NULL,
  `total_but_point` int(4) DEFAULT -1,
  `best_scorer` varchar(255) DEFAULT NULL,
  `best_scorer_point` int(4) DEFAULT -1,
  `player_winner_id` int(11) NOT NULL,
  `player_winner` varchar(255) DEFAULT NULL,
  `player_winner_point` int(4) DEFAULT -1,
  `modif` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pronostics_bonus`
--

INSERT INTO `pronostics_bonus` (`id_membre`, `team_winner_id`, `team_winner_id_point`, `min_first`, `min_first_point`, `min_last`, `min_last_point`, `total_but`, `total_but_point`, `best_scorer`, `best_scorer_point`, `player_winner_id`, `player_winner`, `player_winner_point`, `modif`) VALUES
(2, 25, 1, 17, 5, 83, 0, 143, 0, 'Neymar', 0, 13, NULL, 0, 1),
(9, 13, 6, 18, 5, 83, 0, 152, 0, 'Mbappe', 5, 11, NULL, 0, 1),
(10, 29, 1, 12, 0, 59, 0, 176, 0, 'Messi', 0, 9, NULL, 5, 1),
(8, 25, 1, 29, 0, 79, 0, 164, 0, 'Neymar', 0, 8, NULL, 0, 1),
(1, 9, 11, 21, 0, 62, 0, 171, 5, 'Messi', 0, 11, NULL, 0, 1),
(4, 17, 0, 25, 0, 79, 0, 145, 0, 'Messi', 0, 6, NULL, 0, 1),
(5, 25, 1, 33, 0, 61, 0, 144, 0, 'Mbappe', 5, 5, NULL, 0, 1),
(11, 25, 1, 18, 5, 66, 0, 158, 0, 'Messi', 0, 3, NULL, 0, 1),
(15, 9, 11, 43, 0, 78, 0, 166, 0, 'Messi', 0, 15, NULL, 0, 1),
(13, 25, 1, 18, 5, 61, 0, 161, 0, 'Neymar', 0, 6, NULL, 0, 1),
(12, 25, 1, 34, 0, 78, 0, 154, 0, 'Kane', 0, 13, NULL, 0, 1),
(7, 25, 1, 51, 0, 86, 0, 158, 0, 'Neymar', 0, 7, NULL, 0, 1),
(3, 25, 1, 22, 0, 70, 0, 160, 0, 'Neymar', 0, 6, NULL, 0, 1),
(6, 25, 1, 23, 0, 89, 0, 132, 0, 'Neymar', 0, 6, NULL, 0, 1),
(14, 25, 1, 17, 5, 72, 0, 178, 0, 'Kane', 0, 14, NULL, 0, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `best_scorer`
--
ALTER TABLE `best_scorer`
  ADD PRIMARY KEY (`id_joueur`);

--
-- Index pour la table `coequipiers`
--
ALTER TABLE `coequipiers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `demandes`
--
ALTER TABLE `demandes`
  ADD PRIMARY KEY (`id_demande`);

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id_equipe`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `historic_rang`
--
ALTER TABLE `historic_rang`
  ADD PRIMARY KEY (`type`,`id_owner`,`date`);

--
-- Index pour la table `joker`
--
ALTER TABLE `joker`
  ADD UNIQUE KEY `id_membre` (`id_membre`);

--
-- Index pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD PRIMARY KEY (`id_joueur`);

--
-- Index pour la table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id_match`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pronostics`
--
ALTER TABLE `pronostics`
  ADD PRIMARY KEY (`id_pronostic`);

--
-- Index pour la table `pronostics_bonus`
--
ALTER TABLE `pronostics_bonus`
  ADD UNIQUE KEY `id_membre` (`id_membre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `best_scorer`
--
ALTER TABLE `best_scorer`
  MODIFY `id_joueur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `coequipiers`
--
ALTER TABLE `coequipiers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demandes`
--
ALTER TABLE `demandes`
  MODIFY `id_demande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `joueurs`
--
ALTER TABLE `joueurs`
  MODIFY `id_joueur` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `matches`
--
ALTER TABLE `matches`
  MODIFY `id_match` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `pronostics`
--
ALTER TABLE `pronostics`
  MODIFY `id_pronostic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1696;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
