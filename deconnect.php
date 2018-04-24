<?php

session_start();

session_destroy();

unset($_SESSION['level']);
unset($_SESSION['id']);
unset($_SESSION['pseudo']);

header('Location: acceuil.php'); 
?>