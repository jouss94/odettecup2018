<?php

/**
 * Connexion simple à la base de données via PDO !
 */
include("constants.php");
$db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8mb4', $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
/**
 * On doit analyser la demande faite via l'URL (GET) afin de déterminer si on souhaite récupérer les messages ou en écrire un
 */
$task = "list";

if(array_key_exists("task", $_GET)){
  $task = $_GET['task'];
}

if($task == "write"){
  postMessage();
} else {
  getMessages();
}

/**
 * Si on veut récupérer, il faut envoyer du JSON
 */
function getMessages(){

  // 1. On requête la base de données pour sortir les 20 derniers messages
  // $resultats = $db->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 200");
  global $db;
  $resultats = $db->query(" SELECT 
  messages.content as content,
  messages.created_at as created_at,
  joueurs.surnom as surnom,
  joueurs.id_joueur as id_joueur,
  joueurs.image as image,
  joueurs.color as color,
  equipe_winner.logo as logo
  FROM messages 
  LEFT JOIN joueurs ON messages.author_id = joueurs.id_joueur
  LEFT JOIN equipes equipe_winner ON equipe_winner.id_equipe = joueurs.equipe 
  ORDER BY created_at DESC LIMIT 200");

  // 2. On traite les résultats
  $messages = $resultats->fetchAll();
  // 3. On affiche les données sous forme de JSON
  echo json_encode($messages);
}
/**
 * Si on veut écrire au contraire, il faut analyser les paramètres envoyés en POST et les sauver dans la base de données
 */
function postMessage(){
  // 1. Analyser les paramètres passés en POST (author, content)
  global $db;
  if(!array_key_exists('joueur_id', $_POST) || !array_key_exists('content', $_POST)){

    echo json_encode(["status" => "error", "message" => "One field or many have not been sent"]);
    return;

  }

  $joueur_id = $_POST['joueur_id'];
  $content = $_POST['content'];
//   echo $content;

  // 2. Créer une requête qui permettra d'insérer ces données
  $query = $db->prepare('INSERT INTO messages SET author_id = :joueur_id, content = :content, created_at = NOW()');

  $query->execute([
    "joueur_id" => $joueur_id,
    "content" => $content
  ]);

  // 3. Donner un statut de succes ou d'erreur au format JSON
  echo json_encode(["status" => "success"]);
}

?>