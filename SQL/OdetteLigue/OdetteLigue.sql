DROP DATABASE IF EXISTS `odetteligue1`;

CREATE DATABASE OdetteLigue1 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE OdetteLigue1;

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
(1, 'Ligue1_2023_2024_test');

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
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images\\flag\\',
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_equipe`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT  COLLATE=utf8mb4_unicode_ci;

--
-- TODO DATA `equipes`
-- 

INSERT INTO `equipes` (`id_equipe`, `name`, `display_name`, `group`, `image`, `logo`, `color`) VALUES
(1, 'OGC Nice', 'Nice', '', '', 'images\\\ligue1\\NIC.png', '#e02025'),
(2, 'Lille', 'Lille', '', '', 'images\\ligue1\\LIL.png', '#e9261d'),
(3, 'Olympique Marseille', 'Marseille', '', '', 'images\\ligue1\\MAR.png', '#08a5e6'),
(4, 'Stade de Reims', 'Reims', '', '', 'images\\ligue1\\REM.png', '#ee0303'),
(5, 'Paris Saint-Germain', 'Paris-SG', '', '', 'images\\ligue1\\PAR.png', '#0d5a98'),
(6, 'Lorient', 'Lorient', '', '', 'images\\ligue1\\LOR.png', '#ff863c'), 
(7, 'Stade Brestois 29', 'Brest', '', '', 'images\\ligue1\\BRE.png', '#ff313c'),	 
(8, 'Lens', 'Lens', '', '', 'images\\ligue1\\LEN.png', '#cdac00'),
(9, 'Clermont', 'Clermont', '', '', 'images\\ligue1\\CLE.png', '#e32265'),
(10, 'AS Monaco', 'Monaco', '', '', 'images\\ligue1\\MON.png', '#FFFFFF'),
(11, 'FC Nantes', 'Nantes', '', '', 'images\\ligue1\\NAN.png', '#ffdd04'),
(12, 'Toulouse', 'Toulouse', '', '', 'images\\ligue1\\TOU.png', '#635681'),
(13, 'Montpellier', 'Montpellier', '', '', 'images\\ligue1\\MTP.png', '#ff9248'),	 
(14, 'Le Havre', 'Le Havre', '', '', 'images\\ligue1\\HAC.png', '#8cc4e7'),	 
(15, 'Stade Rennais', 'Rennes', '', '', 'images\\ligue1\\REN.png', '#000000'),	 
(16, 'FC Metz', 'Metz', '', '', 'images\\ligue1\\MET.png', '#7e1b1f'),	 
(17, 'RC Strasbourg', 'Strasbourg', '', '', 'images\\ligue1\\STR.png', '#12b2f5'),	 	 
(18, 'Olympique Lyonnais', 'Lyon', '', '', 'images\\ligue1\\LYO.png', '#ffffff');

-- --------------------------------------------------------

--
-- Table `etat`
--

-- DROP TABLE IF EXISTS `etat`;
-- CREATE TABLE IF NOT EXISTS `etat` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `attribut` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `value` int(1) NOT NULL,
--   `competition` int(11) NOT NULL DEFAULT '0',
--   FOREIGN KEY (competition) REFERENCES competition(id),
--   PRIMARY KEY (`id`)
-- )  AUTO_INCREMENT=0 DEFAULT  COLLATE=utf8mb4_unicode_ci;
--
-- Déchargement des données de la table `etat`
--

-- INSERT INTO `etat` (`attribut`, `value`, `competition`) VALUES
-- ('PRONOS_BONUS', 1, 1),
-- ('PRONOS', 1, 1),
-- ('PRONOS_BONUS', 1, 2),
-- ('PRONOS', 1, 2);

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
  `color` varchar(100) NOT NULL DEFAULT '#1473e6',
  `competition` int(11) NOT NULL DEFAULT '0',
  FOREIGN KEY (competition) REFERENCES competition(id),
  PRIMARY KEY (`id_joueur`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT  COLLATE=utf8mb4_unicode_ci;

--
-- Data `joueurs`
--

INSERT INTO `joueurs` (`id_joueur`, `prenom`, `nom`, `surnom`, `email`, `password`, `image`, `departement`, `telephone`, `payed`, `updated`, `female`, `modif_profil`, `modif_match`, `modif_bonus`, `modif_joker`, `description`, `equipe`, `oauth`, `status`, `competition`) VALUES
(1, 'Florian ', 'Jousseau', 'Jouss94', 'f.jousseau@gmail.com', 'admin', 'images/user/18260_10200113693266289_1751359165_n.jpg', 94, '0760851992', 0, 0, 0, 0, 0, 0, 0, 'Créateur président directeur général de la Odette Ligue', NULL, 'No', 'active', 1);

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
  `stadium` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `diff` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `played` tinyint(1) NOT NULL DEFAULT '0',
  `modif` tinyint(1) NOT NULL DEFAULT '1',
  `groupe` varchar(5) COLLATE utf8mb4_unicode_ci NULL,
  `day` int(11) NULL,
  `years` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `competition` int(11) NOT NULL DEFAULT '0',
  `reporte` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_match`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT  COLLATE=utf8mb4_unicode_ci;

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

-- DROP TABLE IF EXISTS `pronostics_bonus`;
-- CREATE TABLE IF NOT EXISTS `pronostics_bonus` (
--   `id_joueur` int(11) NOT NULL,
--   `team_winner_id` int(11) NOT NULL,
--   `team_winner_id_point` int(4) NULL DEFAULT NULL,
--   `min_first` int(11) NULL,
--   `min_first_point` int(4) NULL DEFAULT NULL,
--   `min_last` int(11) NULL,
--   `min_last_point` int(4) NULL DEFAULT NULL,
--   `total_but` int(11) NULL,
--   `total_but_point` int(4) NULL DEFAULT NULL,
--   `best_scorer` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
--   `best_scorer_point` int(4) NULL DEFAULT NULL,
--   `player_winner_id` int(11) NOT NULL,  
--   `player_winner` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
--   `player_winner_point` int(4) NULL DEFAULT NULL,
--   `modif` int(11) NULL DEFAULT '1',
--   UNIQUE KEY `id_joueur` (`id_joueur`)
-- ) ENGINE=MyISAM DEFAULT  COLLATE=utf8mb4_unicode_ci;
-- COMMIT;

--
-- Table `pronostics_bonus_result`
--

-- DROP TABLE IF EXISTS `pronostics_bonus_result`;
-- CREATE TABLE IF NOT EXISTS `pronostics_bonus_result` (
--   `id_pronostics_bonus_result` int(11) NOT NULL AUTO_INCREMENT,
--   `team_winner_id` int(11) NULL,
--   `team_winner_id_activated` tinyint(1) NOT NULL DEFAULT '0',
--   `min_first` int(11) NULL,
--   `min_first_activated` tinyint(1) NOT NULL DEFAULT '0',
--   `min_last` int(11) NULL,
--   `min_last_activated` tinyint(1) NOT NULL DEFAULT '0',
--   `total_but` int(11) NULL,
--   `total_but_activated` tinyint(1) NOT NULL DEFAULT '0',
--   `best_scorer` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
--   `best_scorer_activated` tinyint(1) NOT NULL DEFAULT '0',
--   `player_winner_id` int(11) NULL,  
--   `player_winner_id_activated` tinyint(1) NOT NULL DEFAULT '0',
--   UNIQUE KEY `id_pronostics_bonus_result` (`id_pronostics_bonus_result`)
-- ) ENGINE=MyISAM DEFAULT  COLLATE=utf8mb4_unicode_ci;
-- COMMIT;

-- INSERT INTO `pronostics_bonus_result`( `team_winner_id_activated`, `min_first_activated`, `min_last_activated`, `total_but_activated`, `best_scorer_activated`, `player_winner_id_activated`) 
-- VALUES (0, 0, 0, 0, 0, 0);


--

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


DROP TABLE IF EXISTS `playoffs`;
CREATE TABLE IF NOT EXISTS `playoffs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `equipe_home` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `equipe_ext` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `id_equipe_home` int(11) NULL,
  `id_equipe_ext` int(11) NULL,
  `day` int(11) NULL,
  `competition` int(11) NULL,
  `score_home` int(11) NULL,
  `score_away` int(11) NULL,
  `parent` int(11) NULL,
  `vainqueur` int(11) NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--

--
-- Table `best_scorer`
--

-- DROP TABLE IF EXISTS `best_scorer`;
-- CREATE TABLE IF NOT EXISTS `best_scorer` (
--   `id_joueur` int(11) NOT NULL AUTO_INCREMENT,
--   `name` varchar(255) NOT NULL,
--   `nb_but` int(11) NOT NULL,
--   PRIMARY KEY (`id_joueur`)
-- ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4;
