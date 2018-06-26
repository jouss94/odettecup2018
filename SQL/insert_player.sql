SET @prenom = 'Amandine';
SET @nom = 'Pavageau';
SET @surnom = 'Didine';
SET @email = 'amandine.pavageau@yahoo.fr';
SET @password = '90TV42';
SET @telephone = '0670272846';
SET @female = 1;
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


f.jousseau@gmail.com
Christopher.lorain@hotmail.fr
tjousseau@gmail.com
titish77@hotmail.com
julien.jousseau@hotmail.fr
Solene.teisseire@icloud.com
Varadero77@hotmail.fr
grisbleu99@yahoo.fr
Dam-papillon@live.fr
jean-marc.jousseau@arteliagroup.com
soignolles@sapo.pt
christine.jousseau@orange.fr
Camiillecaramelle@live.fr
Francette.lorain@gmail.com
pat.lesverts@gmail.com
girondin77@hotmail.com
Aurelien.jousseau@gmail.com
ch.jousseau@gmail.com
joussor.romain@gmail.com
raphael.jousseau@outlook.fr
mjousseau@gmail.com
Michael.courtaux@gmail.com
joussor.romain@gmail.com
joussor.romain@gmail.com
joussor.romain@gmail.com
Camille77170@hotmail.com
jojo-dipla@live.fr
alexandre.jousseau@hotmail.com
charline.bastide@hotmail.com