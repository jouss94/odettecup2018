SET @nom = 'NYK';
SET @prenom = 'Josselin';
SET @surnom = 'Polak';
SET @email = 'josselin.nyk@gmail.com';
SET @password = 'NH22TE';
SET @telephone = '0676746467';
SET @description = "Alea jacta est";
SET @competition = 1; -- 1


INSERT INTO `joueurs` (`prenom`, `nom`, `surnom`, `email`, `password`, `telephone`, `description`, `competition`) 
VALUES (@prenom, @nom, @surnom, @email, @password, @telephone, @description, @competition);

SET @ID = LAST_INSERT_ID();

SELECT @ID;
SET @TypeGeneral = 'general';

INSERT INTO `classements`(`type`, `owner_id`, `competition`) 
VALUES (@TypeGeneral, @ID, @competition);



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
Francette.lorain@gmail.com
pat.lesverts@gmail.com
girondin77@hotmail.com
Aurelien.jousseau@gmail.com
ch.jousseau@gmail.com
joussor.romain@gmail.com
raphael.jousseau@outlook.fr
mjousseau@gmail.com
Michael.courtaux@gmail.com
jojo-dipla@live.fr
alexandre.jousseau@hotmail.com
charline.bastide@hotmail.com