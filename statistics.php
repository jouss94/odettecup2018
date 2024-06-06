<?php
session_start();

$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
if ($id == 0) { header('Location: index.php'); }

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
	<head>
		<title>Statistiques</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<?php include("include/style.php");?>
		<link rel="stylesheet" type="text/css" href="css/tabs.css">
		<link rel="stylesheet" type="text/css" href="css/bandeau.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
		<script src="javascript/jquery-2.2.3.min.js"></script>
		<script src="javascript/jquery-ui.min.js"></script>
		<script src="javascript/login.js"></script>
		<script src="javascript/bandeau.js"></script>
		<script src="javascript/calendrier.js"></script>
		<script src="javascript/sorttable.js"></script>
		<script src="javascript/classement.js"></script>
		<script src="./chartjs/moment.js"></script>
		<script src="./chartjs/Chart.min.js"></script>
	</head>
	<body>
		<div style="display:none" id="idPhp" name='<?php echo $id ?>'> </div>
		<?php include("background.php");?>
		<?php include("include/bandeau.php");?>
		<div class="padding20">
			<div class="loginform-in blackougedefault">
				<div style="width:100%;">
						<?php include("include/viewStatistics.php");?>
				</div>
			</div>
		</div>
	</body>
</html>