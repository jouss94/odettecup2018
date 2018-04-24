<?php

	require_once 'config.php';

	//	echo "yes" if the fields value is valid (and "no" if not)
	$val = $_GET[ 'value' ];
	$id = $_GET[ 'idDiv' ];
	$name = $_GET[ 'name' ];

	$value = $_GET[ 'name' ];
	if (strpos($value, 'numberMatch') !== false)
		$value = 'numberMatch';

	if (strpos($value, 'MinPronos') !== false)
		$value = 'MinPronos';

	if (strpos($value, 'InputText') !== false)
		$value = 'InputText';

	switch( $value ) {

		case 'departementProfil':
			if ( strlen( $val ) == 0 ) {
				echo 'no', ';', $id, ';1';
				break;
			}
			if ( strlen( $val ) > 6 ) {
				echo 'no', ';', $id, ';3';
				break;
			}
			echo ( is_numeric( $val ) ) ? 'yes' : 'no', ';', $id, ';2';
			break;
		
		case 'telProfil':
			if ( strlen( $val ) == 0 ) {
				echo 'no', ';', $id, ';1';
				break;
			}
			if ( strlen( $val ) != 10 ) {
				echo 'no', ';', $id, ';3';
				break;
			}
			echo ( is_numeric( $val ) ) ? 'yes' : 'no', ';', $id, ';2';
			break;


		case 'emailProfil':
			if ( strlen( $val ) == 0 ) {
				echo 'no', ';', $id, ';1';
				break;
			}
			if (!filter_var($val, FILTER_VALIDATE_EMAIL))
			{
				echo 'no', ';', $id, ';2';
				break;
			}
			echo 'yes', ';', $id, ';1';
		break;


		case 'confirmationProfil':
			echo (strlen( $val ) > 0 ) ? 'confirm' : 'no', ';', $id, ';1' ;
			break;

		case 'mpdProfil':
			echo (strlen( $val ) > 0 ) ? 'yes' : 'no', ';', $id, ';1' ;
			break;

		case 'prenomProfil':
			echo (strlen( $val ) > 0 ) ? 'yes' : 'no', ';', $id, ';1' ;
			break;



		case 'nomProfil':
			echo (strlen( $val ) > 0 ) ? 'yes' : 'no', ';', $id, ';1' ;
			break;

		case 'InputText':
			if ( strlen( $val ) == 0 ) {
				echo 'no', ';', $id, ';1';
				break;
			}
			echo ( is_numeric( $val ) ) ? 'no' : 'yes', ';', $id, ';2';
		break;

		case 'bestScorerBut':
			if ( strlen( $val ) == 0 ) {
				echo 'no', ';', $id, ';1';
				break;
			}
			echo ( is_numeric( $val ) ) ? 'yes' : 'no', ';', $id, ';2';
		break;
		case 'totalButFrench':
			if ( strlen( $val ) == 0 ) {
				echo 'no', ';', $id, ';1';
				break;
			}
			echo ( is_numeric( $val ) ) ? 'yes' : 'no', ';', $id, ';2';
		break;
		case 'totalBut':
			if ( strlen( $val ) == 0 ) {
				echo 'no', ';', $id, ';1';
				break;
			}
			echo ( is_numeric( $val ) ) ? 'yes' : 'no', ';', $id, ';2';
		break;
		
		break;

		case 'MinPronos':
			if ( strlen( $val ) == 0 ) {
				echo 'no', ';', $id, ';1';
				break;
			}
			if (is_numeric( $val ))
			{
				if ($val > 0 && $val < 125)
				{
					echo 'yes', ';', $id, ';3';
					break;

				}
				else
				{
					echo 'no', ';', $id, ';3';
					break;					
				}
			}
			else
				echo 'no', ';', $id, ';1';
			break;

		case 'required':
			echo (strlen( $val ) > 0 ) ? 'yes' : 'no', ';', $id, ';1' ;
			break;
		case 'required_prenom':
			echo (strlen( $val ) > 0 ) ? 'yes' : 'no', ';', $id, ';1' ;
			break;

		case 'check-surnom':
			if ( strlen( $val ) == 0 ) {
				echo 'no', ';', $id, ';1';
				break;
			}
			$qry = "SELECT id_joueur FROM joueurs WHERE surnom='".$val."';";
			$res = mysqli_query($con, $qry);
			$num_row = mysqli_num_rows($res);
			$row=mysqli_fetch_assoc($res);
			if( $num_row == 1 ) {
				echo 'no', ';', $id, ';2';
				}
			else {
				$qry = "SELECT id_demande FROM demandes WHERE surnom='".$val."';";
				$res = mysqli_query($con, $qry);
				$num_row = mysqli_num_rows($res);
				$row=mysqli_fetch_assoc($res);
				if( $num_row == 1 ) {
					echo 'no', ';', $id, ';2';
					}
				else {
				echo 'yes', ';', $id, ';1';
				}
			}
			break;

		case 'Email-check':
			if ( strlen( $val ) == 0 ) {
				echo 'no', ';', $id, ';1';
				break;
			}
			if (!filter_var($val, FILTER_VALIDATE_EMAIL))
			{
				echo 'no', ';', $id, ';2';
				break;
			}
			$qry = "SELECT id_joueur FROM joueurs WHERE email='".$val."';";
			$res = mysqli_query($con, $qry);
			$num_row = mysqli_num_rows($res);
			$row=mysqli_fetch_assoc($res);
			if( $num_row == 1 ) {
				echo 'no', ';', $id, ';3';
				}
			else {
				$qry = "SELECT id_demande FROM demandes WHERE mail='".$val."';";
				$res = mysqli_query($con, $qry);
				$num_row = mysqli_num_rows($res);
				$row=mysqli_fetch_assoc($res);
				if( $num_row == 1 ) {
					echo 'no', ';', $id, ';2';
					}
				else {
				echo 'yes', ';', $id, ';1';
				}
			}
			break;

		case 'number':
			if ( strlen( $val ) == 0 ) {
				echo 'no', ';', $id, ';1';
				break;
			}
			if ( strlen( $val ) != 10 ) {
				echo 'no', ';', $id, ';3';
				break;
			}
			echo ( is_numeric( $val ) ) ? 'yes' : 'no', ';', $id, ';2';
			break;

		case  'numberMatch' ;
			if ( strlen( $val ) == 0 ) {
				echo 'no', ';', $id, ';1';
				break;
			}
			echo ( is_numeric( $val ) ) ? 'yes' : 'no', ';', $id, ';2';
			break;

		case 'email':
			if ( strlen( $val ) == 0 ) {
				echo 'yes';
				break;
			}
			echo ( filter_var($val, FILTER_VALIDATE_EMAIL)) ? 'yes' : 'no';
			break;
		case 'url':
			if ( strlen( $val ) == 0 ) {
				echo 'yes';
				break;
			}
			$pattern = '/^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&amp;?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/';
			echo ( preg_match( $pattern, $val ) ) ? 'yes': 'no';
			break;

		default:
			echo 'yes';
	}
?>