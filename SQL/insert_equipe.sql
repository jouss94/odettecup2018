SET @id1 = 2;
SET @id2 = 2;
SET @id3 = 2;
SET @nom = 'Team de FEMME';

INSERT INTO `coequipiers` (`nom`) 
VALUES (@nom);

SET @ID = LAST_INSERT_ID();

SELECT @ID;

update `joueurs`
 SET `equipe` = @ID WHERE id_joueur IN (@id1, @id2, @id3);

SET @TypeEquipe = 'equipe';
INSERT INTO `classements`(`type`, `owner_id`) 
VALUES (@TypeEquipe, @ID);
