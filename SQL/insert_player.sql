SET @prenom = 'Solene';
SET @nom = 'Teisseire';
SET @surnom = 'la loute';
SET @email = 'Soso@gmail.com';
SET @password = 'admin';
SET @telephone = '0760851992';
SET @female = 1;
SET @description = 'Soso';


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