<?php
  require_once('../model/token.php');
  require_once('../model/connexionBD.php');
  use \Firebase\JWT\JWT;

  //TODO: mettre dans un fichier .env
  $key = "ceSera1cLERiasEcP0UrP1Sc1nE";

   //On vérifie que l'utilisateur est déjà connecté
   if(!isset($_COOKIE["token"])){
			$menu="menu.php";
            // On le redirige vers la page d'accueil
            include('../view/pageAccueil.php');
    }
    else{
		$menu="menuJoueur.php";
      include('../view/pageAccueil.php');
      }
?>