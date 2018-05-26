SET @prenom = 'Michaël';
SET @nom = 'Courtaux';
SET @surnom = 'MajinMikki';
SET @email = 'Michael.courtaux@gmail.com';
SET @password = '45UG90';
SET @telephone = '0614434816';
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

INSERT INTO `classements`(`type`, `owner_id`) 
VALUES (@TypeFemme, @ID);