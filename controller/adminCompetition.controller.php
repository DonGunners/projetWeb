<?php
require_once('../vendor/autoload.php');
require_once('../model/token.php');
require_once('../model/competition.php');
require_once('../model/connexionBD.php');
use \Firebase\JWT\JWT;

//TODO: mettre dans un fichier .env
$key = "ceSera1cLEPouRPrONos";

//On vérifie que l'utilisateur est connecté
if(!isset($_COOKIE["token"])){
	$menu="menu.php";
	// On le redirige vers la page d'accueil
	Header('Location:../controller/redirection.php');
}else{
	//On décode le token
	$decoded = JWT::decode($_COOKIE["token"], $key, array('HS256'));
	$decoded_array = (array) $decoded;
	//verification du contenu du token
	if (verificationToken($decoded_array)){
		//Si c'est un joueur, on le redirige vers la page d'accueil
		if($decoded_array['role']==="joueur"){
			$menu="menuJoueur.php";
			Header('Location:../controller/redirection.php');
		//Si c'est un admin, on récupère la liste des compétitions
		}else if($decoded_array['role']==="admin"){
			$menu="menuAdmin.php";
			$listeCompetition=listeCompetition();
			include('../view/adminCompetition.php');
		}else{
			// On le redirige vers la page d'accueil
			$menu="menu.php";
			Header('Location:../controller/redirection.php');	
		}
	}else{
		Header('Location:../controller/redirection.php');
	}
}
?>