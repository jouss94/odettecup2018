SET @prenom = 'Manil';
SET @nom = 'Benkhelifa';
SET @surnom = 'Francis';
SET @email = 'manilbenkhelifa@icloud.com';
SET @password = '89VE53';
SET @telephone = '0601100195';
SET @female = 0;
SET @description = "L'importance est de participer , 
Mais l'ISF arrive a grand pas..
Vous plumez je dois.
Pour cette première participation soyez prêt 
Le promu vous fera déchanter 
Sarko la finance te dit merci d?avance 
#ISFontour 
";


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
