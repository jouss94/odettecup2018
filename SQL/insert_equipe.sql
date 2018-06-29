SET @id1 = 22;
SET @id2 = 14;
SET @id3 = 18;
SET @nom = 'Equipe 7';

INSERT INTO `coequipiers` (`nom`) 
VALUES (@nom);

SET @ID = LAST_INSERT_ID();

SELECT @ID;

update `joueurs`
SET `equipe` = @ID WHERE id_joueur IN (@id1, @id2, @id3);

SET @TypeEquipe = 'equipe';
INSERT INTO `classements`(`type`, `owner_id`) 
VALUES (@TypeEquipe, @ID);
