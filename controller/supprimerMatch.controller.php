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
	// On le redirige vers la page d'accueil
	Header('Location:/redirection');
}else{
	//On décode le token
	$decoded = JWT::decode($_COOKIE["token"], $key, array('HS256'));
	$decoded_array = (array) $decoded;
	//on vérifie le contenu du token
	if (verificationToken($decoded_array)){
		//Si c'est un joueur on le redirige
		if($decoded_array['role']==="joueur"){
			Header('Location:/redirection');
		//Si c'est un admin on affiche la page
		}else if($decoded_array['role']==="admin"){
			$menu="menuAdmin.php";
			include('../view/supprimerMatch.php');
		}else{
			Header('Location:/redirection');	
		}
	}else{
		Header('Location:/redirection');
	}
}
?>