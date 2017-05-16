<?php
  require_once('../vendor/autoload.php');
  require_once('../model/token.php');
  require_once('../model/connexionBD.php');
  use \Firebase\JWT\JWT;

  //TODO: mettre dans un fichier .env
  $key = "ceSera1cLEPouRPrONos";

    //On vérifie que l'utilisateur est déjà connecté
    if(!isset($_COOKIE["token"])){
			$menu="menu.php";
            // On le redirige vers la page d'accueil
            include('Location:../view/pageConfirmationInscription.php');
    }
    else{
		
            Header('Location:../controller/redirection.php');
    }
?>