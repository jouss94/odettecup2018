<?php

include("playoff_matrices.php");

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

$GLOBALS['current_day'] = null;
$GLOBALS['current_day_plus_2'] = null;
$GLOBALS['current_day_in_progress'] = null;

function getCurrentDayInProgress($con, $day) {
    // $GLOBALS['current_day'] = null;
    if ($GLOBALS['current_day_in_progress'] == null && $day != '') {

        $subQry = "SELECT * FROM matches WHERE day = $day AND Date < NOW() ORDER BY Date LIMIT 1;";
		$subResult = mysqli_query($con, $subQry);

		$num_row = mysqli_num_rows($subResult);
		if ($num_row == 1) {
			$GLOBALS['current_day_in_progress'] = true;
		}
    }

    return $GLOBALS['current_day_in_progress'];
}

function getCurrentDay($con) {
    if ($GLOBALS['current_day'] == null) {

        $qry = "SELECT day FROM matches where date > NOW() AND matches.reporte = 0 ORDER BY date LIMIT 1";
        $result = mysqli_query($con, $qry);
        $num_row = mysqli_num_rows($result);

        if ($num_row == 1) {
            $GLOBALS['current_day'] = date(mysqli_fetch_array($result)[0]);
        }
        else {
            $GLOBALS['current_day'] = 0;
        }
    }

    return $GLOBALS['current_day'];
}

function getCurrentDayPlus2($con) {
    if ($GLOBALS['current_day_plus_2'] == null) {

        $qry = "SELECT day FROM matches where date > DATE_ADD(NOW(), INTERVAL -2 DAY) AND matches.reporte = 0 ORDER BY date LIMIT 1";
        $result = mysqli_query($con, $qry);
        $num_row = mysqli_num_rows($result);

        if ($num_row == 1) {
            $GLOBALS['current_day_plus_2'] = date(mysqli_fetch_array($result)[0]);
        }
        else {
            $GLOBALS['current_day_plus_2'] = 0;
        }
    }

    return $GLOBALS['current_day_plus_2'];
}


function display2DigitNumer($number) {
    if (intval($number) <= 9) {
        return '0' . $number;
    }

    return $number;
}

$GLOBALS['playoff_days'] = null;

function getPlayoffDays($con, $competition_param)
{
    if ($GLOBALS['playoff_days'] == null) {

        $subQry = "SELECT DISTINCT day FROM playoffs WHERE competition=$competition_param ORDER BY day;";
        $subResult = mysqli_query($con, $subQry);
    
        $array_result = array();
        while ($row = mysqli_fetch_array($subResult)) 
        {
            array_push($array_result, $row["day"]); 
        }
    
        $GLOBALS['playoff_days'] = $array_result;
    }

    return $GLOBALS['playoff_days'];
}

$GLOBALS['all_days'] = null;

function getDays($con, $competition_param)
{
    if ($GLOBALS['all_days'] == null) {

        $subQry = "SELECT DISTINCT day FROM matches WHERE competition=$competition_param ORDER BY day;";
        $subResult = mysqli_query($con, $subQry);

        $array_result = array();
        while ($row = mysqli_fetch_array($subResult)) 
        {
            array_push($array_result, $row["day"]); 
        }

        $GLOBALS['all_days'] = $array_result;
    }

    return $GLOBALS['all_days'];
}

function getClassementFromNumeric($numeric) {
    if ($numeric == 1) {
        return "1er";
    }
    return strval($numeric) . "ème";
}

$years = "2023-2024";

$months = array(
    1 => "Janvier",
    2 => "Février",
    3 => "Mars",
    4 => "Avril",
    5 => "Mai",
    6 => "Juin",
    7 => "Juillet",
    8 => "Aout",
    9 => "Septembre",
    10 => "Octobre",
    11 => "Novembre",
    12 => "Décembre",
);

$days = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi','Jeudi','Vendredi', 'Samedi');


//TODO RESET TO 0 AFTER TEST = 0;
// $playoff_titles = array("A" => '1er tour de Barrage', "B" => '2ème tour de Barrage', "C" => 'Quart de finale', "D" => 'Demi-finale', "E" => 'Finale',);
$playoff_titles = array("Z" => '1er tour de Barrage', "Y" => '2ème tour de Barrage', "A" => 'Quart de finale', "B" => 'Demi-finale', "C" => 'Finale',);

// $playoff_classement = array("A" => 'background-yellow', "B" => 'background-green', "C" => 'background-green-plus', "D" => 'background-bleu');
$playoff_classement = array("A" => 'background-green', "B" => 'background-bleu', "C" => 'background-green-plus', "D" => 'background-bleu');

?>