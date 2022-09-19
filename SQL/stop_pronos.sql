
-- Stop Pronos Premier tour

UPDATE `matches` SET `modif`=2 WHERE `id_match` >= 37 AND `id_match` <= 44;

UPDATE `etat` SET `value`= 0;

---------------------------------------------------------------------------------------------------------------------------

-- Etat des joueurs

SELECT * FROM `joueurs` WHERE `modif_profil` = 0 OR `modif_match` = 0 OR `modif_bonus` = 0

SELECT * FROM `joueurs` WHERE `payed` = 0

---------------------------------------------------


-- Prochain tour 8eme / Quart / Demi / Finale
---- Set les matchs equipe + modif = 1
UPDATE `etat` SET `value`= 1 WHERE `attribut` = 'PRONOS';
UPDATE `joueurs` SET `modif_match`=0 ;


--- Nombre de but :

SELECT SUM(score_home + score_away) FROM `matches` WHERE 1;
--- nombre de match :
SELECT COUNT(*) FROM `matches` WHERE played = 1;


1er Boubou0677 266€
2eme Alvorada 103€
3eme Titish 41€
4eme Rambo 20€

Pour infos les gains sont les suivants : 1er 169€ 2eme 65€ 3eme 26€