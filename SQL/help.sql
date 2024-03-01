SELECT * FROM `pronostics` 
JOIN matches on matches.id_match = pronostics.id_match
WHERE day=24 AND id_joueur = 1