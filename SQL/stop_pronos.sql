
UPDATE `matches` SET `modif`=2 WHERE `id_match` >= 0 AND `id_match` <= 48;

UPDATE `etat` SET `value`= 0;

---------------------------------------------------------------------------------------------------------------------------


SELECT * FROM `joueurs` WHERE `modif_profil` = 0 OR `modif_match` = 0 OR `modif_bonus` = 0

SELECT * FROM `joueurs` WHERE `payed` = 0

---------------------------------------------------

UPDATE `etat` SET `value`= 1 WHERE `attribut` = 'PRONOS'
UPDATE `joueurs` SET `modif_match`=0 

