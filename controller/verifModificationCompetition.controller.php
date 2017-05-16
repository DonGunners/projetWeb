<?php
require_once('../vendor/autoload.php');
require_once('../model/token.php');
require_once('../model/connexionBD.php');
require_once('../model/competition.php');
use \Firebase\JWT\JWT;


//TODO : mettre ces variables dans un fichier .env
$key = "ceSera1cLEPouRPrONos";
$keyCryptage= "ProJEtWe5";

//vérifie que l'utilisateur n'est pas connecté
if(isset($_COOKIE["token"])){
	  $decoded = JWT::decode($_COOKIE["token"], $key, array('HS256'));
      $decoded_array = (array) $decoded;
	  
	  if (verificationToken($decoded_array)){
        if($decoded_array['role']==="joueur"){
			header('Location:../controller/redirection.php');
        }
        else if($decoded_array['role']==="admin"){
		  $menu="menuAdmin.php";
			//vérifie que tous les champs sont non vides et non NULL
			if (isset($_POST['nom']) && isset($_POST['id']) &&
				!empty($_POST['nom']) && !empty($_POST['id'])){
				//Sécurisation des données saisies
				$nom = htmlspecialchars ($_POST['nom']);
				$image = htmlspecialchars ($_POST['image']);
				$id = htmlspecialchars ($_POST['id']);
				modifierCompetition($id,$nom,$image);
				header('Location:../controller/pageConfirmationModificationCompetition.controller.php');
			}else{
					echo 'ERREUR : un des champs est vide';
			}
        }else{
          // On le redirige vers la page admin
		  $menu="menuAdmin.php";
          include('../view/pageAccueil.php');			
		}
	  }else{
	header('Location:../controller/redirection.php');
	  }
}else{
	header('Location:../controller/redirection.php');
}
?>
