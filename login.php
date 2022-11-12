<?php

include('config.php');
include('functions.php');

session_start();

$uName = sanitize_string($_POST['name'], $con);
$pWord = sanitize_string($_POST['pwd'], $con);

// echo "SELECT id_joueur, surnom, oauth FROM joueurs WHERE surnom='".$uName."' AND password='".$pWord."';";
$qry = "SELECT id_joueur, surnom, oauth FROM joueurs WHERE surnom='".$uName."' AND password='".$pWord."';";
$res = mysqli_query($con, $qry);
$num_row = mysqli_num_rows($res);
$row = mysqli_fetch_assoc($res);

$return = "";

if( $num_row == 1 ) 
{
	$return = 'true';
	// $_SESSION['uName'] = $row['surnom'];
	// $_SESSION['oId'] = $row['id_joueur'];
	// $_SESSION['auth'] = $row['oauth'];

	// $_SESSION['pseudo'] = $row['surnom'];
	// $_SESSION['level'] = $row['oauth'];
	// $_SESSION['id'] = $row['id_joueur'];
	
	// setcookie('Cookie-Test', 'Encore un autre test', $arr_cookie_options); 

	// setcookie('id', $row['id_joueur'], $arr_cookie_options); 
	// setcookie('pseudo', $row['surnom'], $arr_cookie_options); 
	// $_COOKIE['id'] = $row['id_joueur'];
	// $_COOKIE['pseudo'] = $row['surnom'];
}
else
{
	$return = 'false';
}
?>

<?php echo $return ?>