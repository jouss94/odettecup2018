SET @prenom = 'Dalia';
SET @nom = 'Aflalaye';
SET @surnom = 'Daliou';
SET @email = 'Dalia.aflalaye@live.fr';
SET @password = '87TV31';
SET @telephone = '0649852445';
SET @female = 0;
SET @description = "";


INSERT INTO `joueurs` (`prenom`, `nom`, `surnom`, `email`, `password`, `telephone`, `female`, `description`) 
VALUES (@prenom, @nom, @surnom, @email, @password, @telephone, @female, @description);

SET @ID = LAST_INSERT_ID();

SELECT @ID;
SET @TypeGeneral = 'general';
SET @TypeMontagne = 'montagne';
SET @TypeFemme = 'femme';
SET @TypeEquipe = 'equipe';

INSERT INTO `classements`(`type`, `owner_id`) 
VALUES (@TypeGeneral, @ID);

INSERT INTO `classements`(`type`, `owner_id`) 
VALUES (@TypeMontagne, @ID);
