SET @prenom = 'Julien';
SET @nom = 'Jousseau';
SET @surnom = 'Joussao';
SET @email = 'julien.jousseau@hotmail.fr';
SET @password = 'WPEMD9ZP';
SET @telephone = '0699244942';
SET @female = 0;
SET @description = "Il est temps de passer aux choses sérieuses...";


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

INSERT INTO `classements`(`type`, `owner_id`) 
VALUES (@TypeFemme, @ID);