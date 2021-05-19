SET @prenom = 'Olivier';
SET @nom = 'Courtaux';
SET @surnom = 'Angus93';
SET @email = 'grisbleu99@yahoo.fr';
SET @password = 'VB55FQ';
SET @telephone = '0612253231';
SET @female = 0;
SET @description = "";


INSERT INTO `joueurs` (`prenom`, `nom`, `surnom`, `email`, `password`, `telephone`, `female`, `description`) 
VALUES (@prenom, @nom, @surnom, @email, @password, @telephone, @female, @description);

SET @ID = LAST_INSERT_ID();

SELECT @ID;
SET @TypeGeneral = 'general';

INSERT INTO `classements`(`type`, `owner_id`) 
VALUES (@TypeGeneral, @ID);


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