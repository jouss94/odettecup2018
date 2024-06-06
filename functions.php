<?php
function erreur($err='')
{
   $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
   exit('<p>'.$mess.'</p>
   <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p></div></body>');
}

function utf8_encode_function($str)
{
    // TODO : CHECK il me semble que cetait un probleme d'env
    // return utf8_encode($str);
    return ($str);
}

function utf8_decode_function($str)
{
    // TODO : CHECK il me semble que cetait un probleme d'env 
    // return utf8_decode($str);
    return ($str);
}

function move_avatar($avatar)
{
    $extension_upload = strtolower(substr(  strrchr($avatar['name'], '.')  ,1));
    $name = time();
    $nomavatar = str_replace(' ','',$name).".".$extension_upload;
    $name = "./pictures/avatar/".str_replace(' ','',$name).".".$extension_upload;
    move_uploaded_file($avatar['tmp_name'],$name);
    return $nomavatar;
}

function sanitize_string($str, $con) 
{
	// if (get_magic_quotes_gpc()) 
    // {
	// 	$sanitize = mysqli_real_escape_string($con, stripslashes($str));	 
	// } 
    // else 
    // {
		$sanitize = mysqli_real_escape_string($con, $str);	
    //	}

	return $sanitize;
}

// Bonus

function GetCloserPlayer($con, $compet, $select) {
    $subQry = "SELECT joueurs.id_joueur, ($select) as abs_value
    FROM `pronostics_bonus` pb 
    LEFT JOIN joueurs on joueurs.id_joueur = pb.id_joueur
    WHERE competition = 1
    ORDER BY ($select) ASC;";

    $subResult = mysqli_query($con, $subQry);
    $num_row = mysqli_num_rows($subResult);

    $array_result = array();
    if ($num_row > 0) {
        $closer_value = null;

        while ($subRow = mysqli_fetch_array($subResult)) 
        {
            if ($closer_value == null) {
                $closer_value = $subRow["abs_value"];
            }
            if ($closer_value == $subRow["abs_value"]) {
                array_push($array_result, $subRow["id_joueur"]); 
            }
        }
    }

    return $array_result;
}

function GetCloserPlayerFirstMinute($con, $compet) {
    $select = "SELECT abs(min_first - pb.min_first) FROM pronostics_bonus_result";
    return GetCloserPlayer($con, $compet, $select);
}

function GetCloserPlayerLastMinute($con, $compet) {
    $select = "SELECT abs(min_last - pb.min_last) FROM pronostics_bonus_result";
    return GetCloserPlayer($con, $compet, $select);
}

function GetCloserPlayerTotalBut($con, $compet) {
    $select = "SELECT abs(total_but - pb.total_but) FROM pronostics_bonus_result";
    return GetCloserPlayer($con, $compet, $select);
}

function GetCloserPlayerFairplay($con, $compet) {
    $select = "SELECT abs(fairplay_score - pb.fairplay) FROM pronostics_bonus_result";
    return GetCloserPlayer($con, $compet, $select);
}

function GetCloserPlayerPenalty($con, $compet) {
    $select = "SELECT abs(penalty_score - pb.penalty) FROM pronostics_bonus_result";
    return GetCloserPlayer($con, $compet, $select);
}

function GetCloserPlayerButEdf($con, $compet) {
    $select = "SELECT abs(but_edf_score - pb.but_edf) FROM pronostics_bonus_result";
    return GetCloserPlayer($con, $compet, $select);
}

?>