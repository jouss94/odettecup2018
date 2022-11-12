SET @nom = 'Jousseau';
SET @prenom = 'Odile';
SET @surnom = 'Mamie loute';
SET @email = 'Dam-papillon@live.fr';
SET @password = 'LA58PE';
SET @telephone = '0620694215';
SET @description = "Contenter de vous retrouver  j’espère que mon mari ne va pas m’aider car il est trop fort...";


INSERT INTO `joueurs` (`prenom`, `nom`, `surnom`, `email`, `password`, `telephone`, `description`) 
VALUES (@prenom, @nom, @surnom, @email, @password, @telephone, @description);

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