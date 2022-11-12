<?php

// setcookie('id', null, time() - 3600);
// setcookie('pseudo', null, time() - 3600);

session_start();

unset($_SESSION['id']);
unset($_SESSION['pseudo']);

session_destroy();

// if (isset($_COOKIE['pseudo'])) {
//     unset($_COOKIE['pseudo']); 
//     setcookie('pseudo', null, -1, '/'); 
// }


// if (isset($_COOKIE['id'])) {
//     unset($_COOKIE['id']); 
//     setcookie('id', null, -1, '/'); 
// }

header('Location: index.php'); 
?>