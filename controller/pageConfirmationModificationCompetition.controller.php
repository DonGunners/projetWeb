<?php
  require_once('../vendor/autoload.php');
  require_once('../model/token.php');
  require_once('../model/competition.php');
  require_once('../model/connexionBD.php');
  use \Firebase\JWT\JWT;

  //TODO: mettre dans un fichier .env
  $key = "ceSera1cLEPouRPrONos";

    //On vérifie que l'utilisateur est déjà connecté
    if(!isset($_COOKIE["token"])){
			$menu="menu.php";
            // On le redirige vers la page d'accueil
            Header('Location:/redirection');
    }
    else{
		
		//On décode le token
      $decoded = JWT::decode($_COOKIE["token"], $key, array('HS256'));
      $decoded_array = (array) $decoded;
	  
	  if (verificationToken($decoded_array)){
		$pseudo=$decoded_array['id'];
        if($decoded_array['role']==="joueur"){
		  $menu="menuJoueur.php";
            Header('Location:/redirection');
        }
        else if($decoded_array['role']==="admin"){
		  $menu="menuAdmin.php";
			$nom = htmlspecialchars ($_POST['nom']);
			$image = htmlspecialchars ($_POST['image']);
			$id = htmlspecialchars ($_POST['id']);
			modifierCompetition($id,$nom,$image);
          Header('Location:/competition/'.$id.'/update/confirmation');
        }else{
          // On le redirige vers la page admin
		  $menu="menu.php";
            Header('Location:/redirection');			
		}
	  }else{
            Header('Location:/redirection');
	  }
    }
?>