DROP TABLE IF EXISTS `historic_rang`;
CREATE TABLE IF NOT EXISTS `historic_rang` (
  `type` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `id_owner` int(11) NOT NULL,
  `date` date NOT NULL,
  `rang` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`type`,`id_owner`,`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
