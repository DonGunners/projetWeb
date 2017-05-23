<?php
require_once('../vendor/autoload.php');
require_once('../model/token.php');
require_once('../model/rencontre.php');
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
	//On vérifie le contenu du token
	if (verificationToken($decoded_array)){
		//Si c'est un joueur on le redirige vers la page d'accueil
		if($decoded_array['role']==="joueur"){
			$menu="menuJoueur.php";
			Header('Location:../controller/redirection.php');
		//Si c'est un admin on récupère la liste des matchs de la phase
		}else if($decoded_array['role']==="admin"){
			$menu="menuAdmin.php";
			$listeMatchs=listeMatchPhase($_GET['idP']);
			include('../view/adminMatch.php');
		}else{
			//Sinon on le redirige vers la page d'accueil
			$menu="menu.php";
			Header('Location:../controller/redirection.php');	
		}
	}else{
		Header('Location:../controller/redirection.php');
	}
}
?>