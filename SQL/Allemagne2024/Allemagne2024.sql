CREATE DATABASE Allemagne2024 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE Allemagne2024;

--
-- Table `competition`
--

DROP TABLE IF EXISTS `competition`;
CREATE TABLE IF NOT EXISTS `competition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8mb4_unicode_ci;

--
-- Data `competition`
--

INSERT INTO `competition` (`id`, `name`) VALUES
(1, 'famille'),
(2, 'poto');

--
-- Table `classements`
--

DROP TABLE IF EXISTS `classements`;
CREATE TABLE IF NOT EXISTS `classements` (
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0',
  `nb_perf` int(11) NOT NULL DEFAULT '0',
  `nb_correct_plus` int(11) NOT NULL DEFAULT '0',
  `nb_correct` int(11) NOT NULL DEFAULT '0',
  `nb_inverse` int(11) NOT NULL DEFAULT '0',
  `nb_echec` int(11) NOT NULL DEFAULT '0',
  `rang` int(11) NOT NULL DEFAULT '1',
  `competition` int(11) NOT NULL DEFAULT '0',
  FOREIGN KEY (competition) REFERENCES competition(id)
) ENGINE=MyISAM DEFAULT  COLLATE=utf8mb4_unicode_ci;

--
-- Data `classements`
--

INSERT INTO `classements` (`type`, `owner_id`, `points`, `bonus`, `nb_perf`, `nb_correct_plus`, `nb_correct`, `nb_inverse`, `nb_echec`, `rang`, `competition`) VALUES
('general', 1, 0, 0, 0, 0, 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table `demandes`
--

DROP TABLE IF EXISTS `demandes`;
CREATE TABLE IF NOT EXISTS `demandes` (
  `id_demande` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surnom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(4024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_joueur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_demande`)
) ENGINE=MyISAM DEFAULT  COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table `equipes`
--

DROP TABLE IF EXISTS `equipes`;
CREATE TABLE IF NOT EXISTS `equipes` (
  `id_equipe` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images\\flag\\',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_equipe`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT  COLLATE=utf8mb4_unicode_ci;

--
-- TODO DATA `equipes`
--


-- (1, 'ALLEMAGNE', 'A', '', 'images\\flag\\QAT.png', '#65112d'),
-- (2, 'Équateur', 'A', '', 'images\\flag\\ECU.png', '#faea0e'),
-- (3, 'Sénégal', 'A', '', 'images\\flag\\SEN.png', '#138f55'),
-- (4, 'Pays-Bas', 'A', '', 'images\\flag\\NED.png', '#ff7e04'),
-- (5, 'Angleterre', 'B', '', 'images\\flag\\ENG.png', '#ffffff'),
-- (6, 'Iran', 'B', '', 'images\\flag\\IRN.png', '#950c0c'),
-- (7, 'États-Unis', 'B', '', 'images\\flag\\USA.png', '#292975'),
-- (8, 'Pays de Galles', 'B', '', 'images\\flag\\WAL.png', '#179355'),
-- (9, 'Argentine', 'C', '', 'images\\flag\\ARG.png', '#5bbee9'),
-- (10, 'Arabie saoudite', 'C', '', 'images\\flag\\KSA.png', '#004300'),
-- (11, 'Mexique', 'C', '', 'images\\flag\\MEX.png', '#159153'),
-- (12, 'Pologne', 'C', '', 'images\\flag\\POL.png', '#dc171d'),
-- (13, 'France', 'D', '', 'images\\flag\\FRA.png', '#000066'),
-- (14, 'Danemark', 'D', '', 'images\\flag\\DEN.png', '#dc171d'),
-- (15, 'Tunisie', 'D', '', 'images\\flag\\TUN.png', '#dc171e'),
-- (16, 'Australie', 'D', '', 'images\\flag\\AUS.png', '#e1d71d'),
-- (17, 'Espagne', 'E', '', 'images\\flag\\ESP.jpg', '#dc080d'),
-- (18, 'Allemagne', 'E', '', 'images\\flag\\GER.png', '#000000'),
-- (19, 'Japon', 'E', '', 'images\\flag\\JPN.png', '#fff'),
-- (20, 'Costa Rica', 'E', '', 'images\\flag\\CRC.png', '#012987'),
-- (21, 'Belgique', 'F', '', 'images\\flag\\BEL.png', '#dc151d'),
-- (22, 'Canada', 'F', '', 'images\\flag\\CAN.png', '#dc171e'),
-- (23, 'Maroc', 'F', '', 'images\\flag\\MAR.png', '#db161d'),
-- (24, 'Croatie', 'F', '', 'images\\flag\\CRO.png', '#db161d'),
-- (25, 'Brésil', 'G', '', 'images\\flag\\BRA.png', '#ffec00'),
-- (26, 'Serbie', 'G', '', 'images\\flag\\SRB.png', '#dc080d'),
-- (27, 'Suisse', 'G', '', 'images\\flag\\SUI.png', '#dc080d'),
-- (28, 'Cameroun', 'G', '', 'images\\flag\\CMR.png', '#ffec00'),
-- (29, 'Portugal', 'H', '', 'images\\flag\\POR.png', '#149153'),
-- (30, 'Ghana', 'H', '', 'images\\flag\\GHA.png', '#fcea0d'),
-- (31, 'Uruguay', 'H', '', 'images\\flag\\URU.png', '#5bbee9'),
-- (32, 'Rép. de Corée', 'H', '', 'images\\flag\\KOR.png', '#fff');
INSERT INTO `equipes` (`id_equipe`, `name`, `group`, `image`, `logo`, `color`) VALUES
(1, 'Allemagne', 'A', '', 'images\\\Euro\\GER.png', '#231f20'),
(2, 'Écosse', 'A', '', 'images\\\Euro\\SCO.png', '#006cb8'),
(3, 'Hongrie', 'A', '', 'images\\\Euro\\HUN.png', '#008c55'),
(4, 'Suisse', 'A', '', 'images\\\Euro\\SUI.png', '#ed1c24'),

(5, 'Espagne', 'B', '', 'images\\\Euro\\ESP.png', '#c72127'),
(6, 'Croatie', 'B', '', 'images\\\Euro\\CRO.png', '#ffffff'), 
(7, 'Italie', 'B', '', 'images\\\Euro\\ITA.png', '#004d93'),	 
(8, 'Albanie', 'B', '', 'images\\\Euro\\ALB.png', '#ed1c24'),

(9, 'Slovénie', 'C', '', 'images\\\Euro\\SVN.png', '#005aab'),
(10, 'Danemark', 'C', '', 'images\\\Euro\\DEN.png', '#005aab'),
(11, 'Serbie', 'C', '', 'images\\\Euro\\SRB.png', '#005aab'),
(12, 'Angleterre', 'C', '', 'images\\\Euro\\ENG.png', '#005aab'),

(13, 'Barrage A', 'D', '', 'images\\\Euro\\KAZ.png', '#65112d'),	 
(14, 'Pays-Bas', 'D', '', 'images\\\Euro\\NED.png', '#ff6c00'),	 
(15, 'Autriche', 'D', '', 'images\\\Euro\\AUT.png', '#ed1c24'),	 
(16, 'France', 'D', '', 'images\\\Euro\\FRA.png', '#005aab'),	 

(17, 'Belgique', 'E', '', 'images\\\Euro\\BEL.png', '#ffd503'),	 	 
(18, 'Slovaquie', 'E', '', 'images\\\Euro\\SVK.png', '#ffffff'),
(19, 'Roumanie', 'E', '', 'images\\\Euro\\ROU.png', '#ffde00'),
(20, 'Barrage B', 'E', '', 'images\\\Euro\\KAZ.png', '#65112d'),	

(21, 'Turquie', 'F', '', 'images\\\Euro\\TUR.png', '#ed1c24'),
(22, 'Barrage C', 'F', '', 'images\\\Euro\\KAZ.png', '#65112d'), 
(23, 'Portugal', 'F', '', 'images\\\Euro\\POR.png', '#006940'),
(24, 'Tchéquie', 'F', '', 'images\\\Euro\\CZE.png', '#ffffff');

-- --------------------------------------------------------

--
-- Table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attribut` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(1) NOT NULL,
  `competition` int(11) NOT NULL DEFAULT '0',
  FOREIGN KEY (competition) REFERENCES competition(id),
  PRIMARY KEY (`id`)
)  AUTO_INCREMENT=0 DEFAULT  COLLATE=utf8mb4_unicode_ci;
--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`attribut`, `value`, `competition`) VALUES
('PRONOS_BONUS', 1, 1),
('PRONOS', 1, 1),
('PRONOS_BONUS', 1, 2),
('PRONOS', 1, 2);

-- --------------------------------------------------------

--
-- Table `joueurs`
--

DROP TABLE IF EXISTS `joueurs`;
CREATE TABLE IF NOT EXISTS `joueurs` (
  `id_joueur` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surnom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT 'images/user/default.jpg',
  `departement` int(6) DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payed` tinyint(1) NOT NULL DEFAULT '0',
  `updated` tinyint(1) NOT NULL DEFAULT '0',
  `female` tinyint(1) NOT NULL DEFAULT '0',
  `modif_profil` tinyint(1) NOT NULL DEFAULT '0',
  `modif_match` tinyint(1) NOT NULL DEFAULT '0',
  `modif_bonus` tinyint(1) NOT NULL DEFAULT '0',
  `modif_joker` tinyint(1) NOT NULL DEFAULT '0',
  `description` varchar(4024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `equipe` int(11) DEFAULT NULL,
  `oauth` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `color` varchar(100) NOT NULL DEFAULT '#9c2950',
  `competition` int(11) NOT NULL DEFAULT '0',
  FOREIGN KEY (competition) REFERENCES competition(id),
  PRIMARY KEY (`id_joueur`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT  COLLATE=utf8mb4_unicode_ci;

--
-- Data `joueurs`
--

INSERT INTO `joueurs` (`id_joueur`, `prenom`, `nom`, `surnom`, `email`, `password`, `image`, `departement`, `telephone`, `payed`, `updated`, `female`, `modif_profil`, `modif_match`, `modif_bonus`, `modif_joker`, `description`, `equipe`, `oauth`, `status`, `competition`) VALUES
(1, 'Florian ', 'Jousseau', 'La Flouf', 'f.jousseau@gmail.com', 'admin', 'images/user/18260_10200113693266289_1751359165_n.jpg', 94, '0760851992', 0, 0, 0, 0, 0, 0, 0, 'Président directeur général de la Odette Cup', NULL, 'No', 'active', 1),
(2, 'Florian ', 'Jousseau', 'Jouss', 'f.jousseau@gmail.com', 'admin', 'images/user/18260_10200113693266289_1751359165_n.jpg', 94, '0760851992', 0, 0, 0, 0, 0, 0, 0, 'Président directeur général de la Odette Cup', NULL, 'No', 'active', 2);

-- --------------------------------------------------------

--
-- Table `matches`
--

DROP TABLE IF EXISTS `matches`;
CREATE TABLE IF NOT EXISTS `matches` (
  `id_match` int(11) NOT NULL AUTO_INCREMENT,
  `id_team_home` int(11) NOT NULL,
  `id_team_away` int(11) NOT NULL,
  `score_home` int(11) NOT NULL DEFAULT '0',
  `score_away` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `stadium` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BeIn',
  `played` tinyint(1) NOT NULL DEFAULT '0',
  `modif` tinyint(1) NOT NULL DEFAULT '1',
  `groupe` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dayOfstage` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_match`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT  COLLATE=utf8mb4_unicode_ci;

-- DATA `Matchs` --  NO MORE MONTAGNE Last value

INSERT INTO `matches` (`id_team_home`, `id_team_away`, `score_home`, `score_away`, `date`, `stadium`, `diff`, `played`, `modif`, `groupe`, `dayOfstage`) VALUES

(1, 2, 0, 0, '2024-06-14 21:00:00', 'Munich', 'TF1 ou M6', 0, 1, 'A', 1),

(3, 4, 0, 0, '2024-06-15 15:00:00', 'Cologne', 'TF1 ou M6', 0, 1, 'A', 1),
(5, 6, 0, 0, '2024-06-15 18:00:00', 'Berlin', 'TF1 ou M6', 0, 1, 'B', 1),
(7, 8, 0, 0, '2024-06-15 21:00:00', 'Dortmund', 'TF1 ou M6', 0, 1, 'B', 1),

(13, 14, 0, 0, '2024-06-16 15:00:00', 'Hambourg', 'TF1 ou M6', 0, 1, 'D', 1),
(9, 10, 0, 0, '2024-06-16 18:00:00', 'Stuttgart', 'TF1 ou M6', 0, 1, 'C', 1),
(11, 12, 0, 0, '2024-06-16 21:00:00', 'Gelsenkirchen', 'TF1 ou M6', 0, 1, 'C', 1),

(19, 20, 0, 0, '2024-06-17 15:00:00', 'Munich', 'TF1 ou M6', 0, 1, 'E', 1),
(17, 18, 0, 0, '2024-06-17 18:00:00', 'Francfort', 'TF1 ou M6', 0, 1, 'E', 1),
(15, 16, 0, 0, '2024-06-17 21:00:00', 'Düsseldorf', 'TF1 ou M6', 0, 1, 'D', 1),

(21, 22, 0, 0, '2024-06-18 18:00:00', 'Dortmund', 'TF1 ou M6', 0, 1, 'F', 1),
(23, 24, 0, 0, '2024-06-18 21:00:00', 'Leipzig', 'TF1 ou M6', 0, 1, 'F', 1),

(6, 8, 0, 0, '2024-06-19 15:00:00', 'Hambourg', 'TF1 ou M6', 0, 1, 'B', 2),
(1, 3, 0, 0, '2024-06-19 18:00:00', 'Stuttgart', 'TF1 ou M6', 0, 1, 'A', 2),
(2, 4, 0, 0, '2024-06-19 21:00:00', 'Cologne', 'TF1 ou M6', 0, 1, 'A', 2),

(9, 11, 0, 0, '2024-06-20 15:00:00', 'Munich', 'TF1 ou M6', 0, 1, 'C', 2),
(10, 12, 0, 0, '2024-06-20 18:00:00', 'Francfort', 'TF1 ou M6', 0, 1, 'C', 2),
(5, 7, 0, 0, '2024-06-20 21:00:00', 'Gelsenkirchen', 'TF1 ou M6', 0, 1, 'B', 2),

(18, 20, 0, 0, '2024-06-21 15:00:00', 'Düsseldorf', 'TF1 ou M6', 0, 1, 'E', 2),
(13, 15, 0, 0, '2024-06-21 18:00:00', 'Berlin', 'TF1 ou M6', 0, 1, 'D', 2),
(14, 16, 0, 0, '2024-06-21 21:00:00', 'Leipzig', 'TF1 ou M6', 0, 1, 'D', 2),

(22, 24, 0, 0, '2024-06-22 15:00:00', 'Hambourg', 'TF1 ou M6', 0, 1, 'F', 2),
(21, 23, 0, 0, '2024-06-22 18:00:00', 'Dortmund', 'TF1 ou M6', 0, 1, 'F', 2),
(17, 19, 0, 0, '2024-06-22 21:00:00', 'Cologne', 'TF1 ou M6', 0, 1, 'E', 2),

(4, 1, 0, 0, '2024-06-23 21:00:00', 'Francfort', 'TF1 ou M6', 0, 1, 'A', 3),
(2, 3, 0, 0, '2024-06-23 21:00:00', 'Stuttgart', 'TF1 ou M6', 0, 1, 'A', 3),

(8, 5, 0, 0, '2024-06-24 21:00:00', 'Düsseldorf', 'TF1 ou M6', 0, 1, 'B', 3),
(6, 7, 0, 0, '2024-06-24 21:00:00', 'Leipzig', 'TF1 ou M6', 0, 1, 'B', 3),

(14, 15, 0, 0, '2024-06-25 18:00:00', 'Berlin', 'TF1 ou M6', 0, 1, 'D', 3),
(16, 13, 0, 0, '2024-06-25 18:00:00', 'Dortmund', 'TF1 ou M6', 0, 1, 'D', 3),
(12, 9, 0, 0, '2024-06-25 21:00:00', 'Cologne', 'TF1 ou M6', 0, 1, 'C', 3),
(10, 11, 0, 0, '2024-06-25 21:00:00', 'Munich', 'TF1 ou M6', 0, 1, 'C', 3),

(18, 19, 0, 0, '2024-06-26 18:00:00', 'Berlin', 'TF1 ou M6', 0, 1, 'E', 3),
(20, 17, 0, 0, '2024-06-26 18:00:00', 'Dortmund', 'TF1 ou M6', 0, 1, 'E', 3),
(22, 23 , 0, 0, '2024-06-26 21:00:00', 'Cologne', 'TF1 ou M6', 0, 1, 'F', 3),
(24, 21, 0, 0, '2024-06-26 21:00:00', 'Munich', 'TF1 ou M6', 0, 1, 'F', 3),

---

(1, 1, 0, 0, '2024-06-29 18:00:00', 'Berlin', 'TF1 ou M6', 0, 0, '', 0),
(1, 1, 0, 0, '2024-06-29 21:00:00', 'Dortmund', 'TF1 ou M6', 0, 0, '', 0),

(1, 1, 0, 0, '2024-06-30 18:00:00', 'Gelsenkirchen', 'TF1 ou M6', 0, 0, '', 0),
(1, 1, 0, 0, '2024-06-30 21:00:00', 'Cologne', 'TF1 ou M6', 0, 0, '', 0),

(1, 1, 0, 0, '2024-07-01 18:00:00', 'Düsseldorf', 'TF1 ou M6', 0, 0, '', 0),
(1, 1, 0, 0, '2024-07-01 21:00:00', 'Francfort', 'TF1 ou M6', 0, 0, '', 0),

(1, 1, 0, 0, '2024-07-02 18:00:00', 'Munich', 'TF1 ou M6', 0, 0, '', 0),
(1, 1, 0, 0, '2024-07-02 21:00:00', 'Leipzig', 'TF1 ou M6', 0, 0, '', 0),

---

(1, 1, 0, 0, '2024-07-05 18:00:00', 'Hambourg', 'TF1 ou M6', 0, 0, '', 0),
(1, 1, 0, 0, '2024-07-05 21:00:00', 'Stuttgart', 'TF1 ou M6', 0, 0, '', 0),

(1, 1, 0, 0, '2024-07-06 18:00:00', 'Düsseldorf', 'TF1 ou M6', 0, 0, '', 0),
(1, 1, 0, 0, '2024-07-06 21:00:00', 'Berlin', 'TF1 ou M6', 0, 0, '', 0),

----
(1, 1, 0, 0, '2024-07-09 21:00:00', 'Munich', 'TF1 ou M6', 0, 0, '', 0),

(1, 1, 0, 0, '2024-07-10 21:00:00', 'Dortmund', 'TF1 ou M6', 0, 0, '', 0),

---

(1, 1, 0, 0, '2024-07-14 21:00:00', 'Berlin', 'TF1 ou M6', 0, 0, '', 0);


-- (2, 5, 6, 0, 0, '2022-11-21 14:00:00', 'Khalifa International Stadium', 'BeIn1', 0, 1, 'B', 1, 0),
-- (3, 3, 4, 0, 0, '2022-11-21 17:00:00', 'Al Thumama Stadium', 'BeIn1', 0, 1, 'A', 1, 0),
-- (4, 7, 8, 0, 0, '2022-11-21 20:00:00', 'Ahmad Bin Ali Stadium', 'TF1 - BeIn1', 0, 1, 'B', 1, 0),

-- (5, 9, 10, 0, 0, '2022-11-22 11:00:00', 'Lusail Stadium', 'BeIn1', 0, 1, 'C', 1, 0),
-- (6, 14, 15, 0, 0, '2022-11-22 14:00:00', 'Education City Stadium', 'BeIn1', 0, 1, 'D', 1, 0),
-- (7, 11, 12, 0, 0, '2022-11-22 17:00:00', 'Stadium 974', 'BeIn1', 0, 1, 'C', 1, 0),
-- (8, 13, 16, 0, 0, '2022-11-22 20:00:00', 'Al-Janoub Stadium', 'TF1 - BeIn1', 0, 1, 'D', 1, 0),

-- (9, 23, 24, 0, 0, '2022-11-23 11:00:00', 'Al Bayt Stadium', 'BeIn1', 0, 1, 'F', 1, 0),
-- (10, 18, 19, 0, 0, '2022-11-23 14:00:00', 'Khalifa International Stadium', 'BeIn1', 0, 1, 'E', 1, 0),
-- (11, 17, 20, 0, 0, '2022-11-23 17:00:00', 'Al Thumama Stadium', 'BeIn1', 0, 1, 'E', 1, 0),
-- (12, 21, 22, 0, 0, '2022-11-23 20:00:00', 'Ahmad Bin Ali Stadium', 'TF1 - BeIn1', 0, 1, 'F', 1, 0),

-- (13, 27, 28, 0, 0, '2022-11-24 11:00:00', 'Al-Janoub Stadium', 'BeIn1', 0, 1, 'G', 1, 0),
-- (14, 31, 32, 0, 0, '2022-11-24 14:00:00', 'Education City Stadium', 'BeIn1', 0, 1, 'H', 1, 0),
-- (15, 29, 30, 0, 0, '2022-11-24 17:00:00', 'Stadium 974', 'BeIn1', 0, 1, 'H', 1, 0),
-- (16, 25, 26, 0, 0, '2022-11-24 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 0, 1, 'G', 1, 0),

-- (17, 8, 6, 0, 0, '2022-11-25 11:00:00', 'Ahmad Bin Ali Stadium', 'BeIn1', 0, 1, 'B', 2, 0),
-- (18, 1, 3, 0, 0, '2022-11-25 14:00:00', 'Al Thumama Stadium', 'BeIn1', 0, 1, 'A', 2, 0),
-- (19, 4, 2, 0, 0, '2022-11-25 17:00:00', 'Khalifa International Stadium', 'BeIn1', 0, 1, 'A', 2, 0),
-- (20, 5, 7, 0, 0, '2022-11-25 20:00:00', 'Al Bayt Stadium', 'TF1 - BeIn1', 0, 1, 'B', 2, 0),

-- (21, 15, 16, 0, 0, '2022-11-26 11:00:00', 'Al-Janoub Stadium', 'BeIn1', 0, 1, 'D', 2, 0),
-- (22, 12, 10, 0, 0, '2022-11-26 14:00:00', 'Education City Stadium', 'BeIn1', 0, 1, 'C', 2, 0),
-- (23, 13, 14, 0, 0, '2022-11-26 17:00:00', 'Stadium 974', 'TF1 - BeIn1', 0, 1, 'D', 2, 0),
-- (24, 9, 11, 0, 0, '2022-11-26 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 0, 1, 'C', 2, 0),

-- (25, 19, 20, 0, 0, '2022-11-27 11:00:00', 'Ahmad Bin Ali Stadium', 'BeIn1', 0, 1, 'E', 2, 0),
-- (26, 21, 23, 0, 0, '2022-11-27 14:00:00', 'Al Thumama Stadium', 'TF1 - BeIn1', 0, 1, 'F', 2, 0),
-- (27, 24, 22, 0, 0, '2022-11-27 17:00:00', 'Khalifa International Stadium', 'BeIn1', 0, 1, 'F', 2, 0),
-- (28, 17, 18, 0, 0, '2022-11-27 20:00:00', 'Al Bayt Stadium', 'TF1 - BeIn1', 0, 1, 'E', 2, 0),

-- (29, 28, 26, 0, 0, '2022-11-28 11:00:00', 'Al-Janoub Stadium', 'BeIn1', 0, 1, 'G', 2, 0),
-- (30, 32, 30, 0, 0, '2022-11-28 14:00:00', 'Education City Stadium', 'BeIn1', 0, 1, 'H', 2, 0),
-- (31, 25, 27, 0, 0, '2022-11-28 17:00:00', 'Stadium 974', 'BeIn1', 0, 1, 'G', 2, 0),
-- (32, 29, 31, 0, 0, '2022-11-28 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 0, 1, 'H', 2, 0),

-- (33, 2, 3, 0, 0, '2022-11-29 16:00:00', 'Khalifa International Stadium', 'BeIn2', 0, 1, 'A', 3, 0),
-- (34, 4, 1, 0, 0, '2022-11-29 16:00:00', 'Al Bayt Stadium', 'BeIn1', 0, 1, 'A', 3, 0),
-- (35, 6, 7, 0, 0, '2022-11-29 20:00:00', 'Al Thumama Stadium', 'BeIn2', 0, 1, 'B', 3, 0),
-- (36, 8, 5, 0, 0, '2022-11-29 20:00:00', 'Ahmad Bin Ali Stadium', 'TF1 - BeIn1', 0, 1, 'B', 3, 0),

-- (37, 16, 14, 0, 0, '2022-11-30 16:00:00', 'Al-Janoub Stadium', 'BeIn2', 0, 1, 'D', 3, 0),
-- (38, 15, 13, 0, 0, '2022-11-30 16:00:00', 'Education City Stadium', 'TF1 - BeIn1', 0, 1, 'D', 3, 0),
-- (39, 10, 11, 0, 0, '2022-11-30 20:00:00', 'Lusail Stadium', 'BeIn2', 0, 1, 'C', 3, 0),
-- (40, 12,  9, 0, 0, '2022-11-30 20:00:00', 'Stadium 974', 'TF1 - BeIn1', 0, 1, 'C', 3, 0),

-- (41, 22, 23, 0, 0, '2022-12-01 16:00:00', 'Al Thumama Stadium', 'BeIn2', 0, 1, 'F', 3, 0),
-- (42, 24, 21, 0, 0, '2022-12-01 16:00:00', 'Ahmad Bin Ali Stadium', 'BeIn1', 0, 1, 'F', 3, 0),
-- (43, 20, 18, 0, 0, '2022-12-01 20:00:00', 'Al Bayt Stadium', 'BeIn2', 0, 1, 'E', 3, 0),
-- (44, 19, 17, 0, 0, '2022-12-01 20:00:00', 'Khalifa International Stadium', 'TF1 - BeIn1', 0, 1, 'E', 3, 0),

-- (45, 30, 31, 0, 0, '2022-12-02 16:00:00', 'Al-Janoub Stadium', 'BeIn2', 0, 1, 'H', 3, 0),
-- (46, 32, 29, 0, 0, '2022-12-02 16:00:00', 'Education City Stadium', 'BeIn1', 0, 1, 'H', 3, 0),
-- (47, 26, 27, 0, 0, '2022-12-02 20:00:00', 'Stadium 974', 'BeIn2', 0, 1, 'G', 3, 0),
-- (48, 28, 25, 0, 0, '2022-12-02 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 0, 1, 'G', 3, 0),

-- (49, 1, 1, 0, 0, '2022-12-03 16:00:00', 'Khalifa International Stadium', 'BeIn1', 0, 0, '', 0, 0),
-- (50, 1, 1, 0, 0, '2022-12-03 20:00:00', 'Ahmad Bin Ali Stadium', 'BeIn1', 0, 0, '', 0, 0),

-- (51, 1, 1, 0, 0, '2022-12-04 16:00:00', 'Al Thumama Stadium', 'BeIn1', 0, 0, '', 0, 0),
-- (52, 1, 1, 0, 0, '2022-12-04 20:00:00', 'Al Bayt Stadium', 'BeIn1', 0, 0, '', 0, 0),

-- (53, 1, 1, 0, 0, '2022-12-05 16:00:00', 'Al-Janoub Stadium', 'BeIn1', 0, 0, '', 0, 0),
-- (54, 1, 1, 0, 0, '2022-12-05 20:00:00', 'Stadium 974', 'BeIn1', 0, 0, '', 0, 0),

-- (55, 1, 1, 0, 0, '2022-12-06 16:00:00', 'Education City Stadium', 'BeIn1', 0, 0, '', 0, 0),
-- (56, 1, 1, 0, 0, '2022-12-06 20:00:00', 'Lusail Stadium', 'BeIn1', 0, 0, '', 0, 0),

-- (57, 1, 1, 0, 0, '2022-12-09 16:00:00', 'Education City Stadium', 'BeIn1', 0, 0, '', 0, 0),
-- (58, 1, 1, 0, 0, '2022-12-09 20:00:00', 'Lusail Stadium', 'BeIn1', 0, 0, '', 0, 0),

-- (59, 1, 1, 0, 0, '2022-12-10 16:00:00', 'Al Thumama Stadium', 'BeIn1', 0, 0, '', 0, 0),
-- (60, 1, 1, 0, 0, '2022-12-10 20:00:00', 'Al Bayt Stadium', 'BeIn1', 0, 0, '', 0, 0),

-- (61, 1, 1, 0, 0, '2022-12-13 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 0, 0, '', 0, 0),

-- (62, 1, 1, 0, 0, '2022-12-14 20:00:00', 'Al Bayt Stadium', 'TF1 - BeIn1', 0, 0, '', 0, 0),

-- (63, 1, 1, 0, 0, '2022-12-17 20:00:00', 'Khalifa International Stadium', 'TF1 - BeIn1', 0, 0, '', 0, 0),

-- (64, 1, 1, 0, 0, '2022-12-18 20:00:00', 'Lusail Stadium', 'TF1 - BeIn1', 0, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table `pronostics`
--

DROP TABLE IF EXISTS `pronostics`;
CREATE TABLE IF NOT EXISTS `pronostics` (
  `id_pronostic` int(11) NOT NULL AUTO_INCREMENT,
  `id_joueur` int(11) NOT NULL,
  `id_match` int(11) NOT NULL,
  `prono_home` int(11) NOT NULL,
  `prono_away` int(11) NOT NULL,
  `point` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pronostic`)
) ENGINE=MyISAM DEFAULT  COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table `pronostics_bonus`
--

DROP TABLE IF EXISTS `pronostics_bonus`;
CREATE TABLE IF NOT EXISTS `pronostics_bonus` (
  `id_joueur` int(11) NOT NULL,
  `team_winner_id` int(11) NOT NULL,
  `team_winner_id_point` int(4) NULL DEFAULT NULL,
  `min_first` int(11) NULL,
  `min_first_point` int(4) NULL DEFAULT NULL,
  `min_last` int(11) NULL,
  `min_last_point` int(4) NULL DEFAULT NULL,
  `total_but` int(11) NULL,
  `total_but_point` int(4) NULL DEFAULT NULL,
  `best_scorer` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `best_scorer_point` int(4) NULL DEFAULT NULL,
  `player_winner_id` int(11) NOT NULL,  
  `player_winner` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `player_winner_point` int(4) NULL DEFAULT NULL,
  `modif` int(11) NULL DEFAULT '1',
  UNIQUE KEY `id_joueur` (`id_joueur`)
) ENGINE=MyISAM DEFAULT  COLLATE=utf8mb4_unicode_ci;
COMMIT;

--
-- Table `pronostics_bonus_result`
--

DROP TABLE IF EXISTS `pronostics_bonus_result`;
CREATE TABLE IF NOT EXISTS `pronostics_bonus_result` (
  `id_pronostics_bonus_result` int(11) NOT NULL AUTO_INCREMENT,
  `team_winner_id` int(11) NULL,
  `team_winner_id_activated` tinyint(1) NOT NULL DEFAULT '0',
  `min_first` int(11) NULL,
  `min_first_activated` tinyint(1) NOT NULL DEFAULT '0',
  `min_last` int(11) NULL,
  `min_last_activated` tinyint(1) NOT NULL DEFAULT '0',
  `total_but` int(11) NULL,
  `total_but_activated` tinyint(1) NOT NULL DEFAULT '0',
  `best_scorer` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `best_scorer_activated` tinyint(1) NOT NULL DEFAULT '0',
  `player_winner_id` int(11) NULL,  
  `player_winner_id_activated` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `id_pronostics_bonus_result` (`id_pronostics_bonus_result`)
) ENGINE=MyISAM DEFAULT  COLLATE=utf8mb4_unicode_ci;
COMMIT;

INSERT INTO `pronostics_bonus_result`( `team_winner_id_activated`, `min_first_activated`, `min_last_activated`, `total_but_activated`, `best_scorer_activated`, `player_winner_id_activated`) 
VALUES (0, 0, 0, 0, 0, 0)


-- --------------------------------------------------------

--
-- Table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table `best_scorer`
--

DROP TABLE IF EXISTS `best_scorer`;
CREATE TABLE IF NOT EXISTS `best_scorer` (
  `id_joueur` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `nb_but` int(11) NOT NULL,
  PRIMARY KEY (`id_joueur`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;
