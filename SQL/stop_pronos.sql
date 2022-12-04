
---------------------------------------------------
-- Etat des joueurs
---------------------------------------------------
SELECT * FROM `joueurs` WHERE `modif_profil` = 0 OR `modif_match` = 0 OR `modif_bonus` = 0

SELECT * FROM `joueurs` WHERE `payed` = 0



---------------------------------------------------
-- Stop Pronos Premier tour
---------------------------------------------------

-- -1 Export de la base 

-- -2 fermer la modification 
UPDATE `etat` SET `value`= 0;

-- -3 Cloture des matchs 
UPDATE `matches` SET `modif`=2 WHERE `id_match` >= 0 AND `id_match` <= 48;

-- 4 - Couleur des joueurs
UPDATE joueurs  
LEFT JOIN pronostics_bonus on pronostics_bonus.id_membre = joueurs.id_joueur
LEFT JOIN equipes on equipes.id_equipe = pronostics_bonus.team_winner_id
SET equipe = pronostics_bonus.team_winner_id, joueurs.color = equipes.color;

-- 5 Update des pronostics bonus
UPDATE `pronostics_bonus` 
SET `team_winner_id_point` = NULL
    ,`min_first_point` = NULL
    ,`min_last_point` = NULL
    ,`total_but_point` = NULL
    ,`best_scorer_point` = NULL
    ,`player_winner_point` = NULL;

-- Vérification des données Bonus (meilleur buteur à récrir et liste des équipes)

-- 6 Livraison du code 
C:\wamp64\www\odettecup2018-git\include\updateAll.php
C:\wamp64\www\odettecup2018-git\include\viewProfil.php
C:\wamp64\www\odettecup2018-git\css\style.css -- V1
C:\wamp64\www\odettecup2018-git\acceuil.php
C:\wamp64\www\odettecup2018-git\css\style-v1.css
C:\wamp64\www\odettecup2018-git\material_design\style-v1.css

---------------------------------------------------
-- Prochain tour 8eme / Quart / Demi / Finale
---------------------------------------------------


---- Set les matchs equipe + modif = 1
--- export de la base
--- mise a jour de  update
UPDATE `etat` SET `value`= 1 WHERE `attribut` = 'PRONOS';
UPDATE `joueurs` SET `modif_match`=0 ;

--- 1/8
UPDATE `etat` SET `value`= 0;
UPDATE `matches` SET `modif`=2 WHERE `id_match` >= 49 AND `id_match` <= 56;

--- Nombre de but :

SELECT SUM(score_home + score_away) FROM `matches` WHERE 1;

--- nombre de match :

SELECT COUNT(*) FROM `matches` WHERE played = 1;

SELECT joueurs.surnom, Count(*) FROM `pronostics`
JOIN joueurs on joueurs.id_joueur = pronostics.id_membre
GROUP BY joueurs.id_joueur;

SELECT * FROM `joueurs` WHERE `modif_profil` = 0 OR `modif_match` = 0 OR `modif_bonus` = 0

INSERT INTO `best_scorer` (`name`, `nb_but`) VALUES ('Morata', '3');
INSERT INTO `best_scorer` (`name`, `nb_but`) VALUES ('Ferran', '2');

1er Boubou0677 266€
2eme Alvorada 103€
3eme Titish 41€
4eme Rambo 20€

Pour infos les gains sont les suivants : 1er 169€ 2eme 65€ 3eme 26€