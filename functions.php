<?php
function erreur($err='')
{
   $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';
   exit('<p>'.$mess.'</p>
   <p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d\'accueil</p></div></body>');
}

function utf8_encode_function($str)
{
    return utf8_encode($str);
    return ($str);
}

function utf8_decode_function($str)
{
    return utf8_decode($str);
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

function verif_auth($auth_necessaire)
{
    $level=(isset($_SESSION['level']))?$_SESSION['level']:1;
    return ($auth_necessaire <= intval($level));
}

function sanitize_string($str, $con) 
{
	if (get_magic_quotes_gpc()) 
    {
		$sanitize = mysqli_real_escape_string($con, stripslashes($str));	 
	} 
    else 
    {
		$sanitize = mysqli_real_escape_string($con, $str);	
	}

	return $sanitize;
}

?>