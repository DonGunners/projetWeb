<?php
require_once('../vendor/autoload.php');
require_once('../model/token.php');
require_once('../model/joueur.php');
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
		$pseudo=$decoded_array['id'];
		//Si c'est un joueur on récupère ses informations et on affiche le profil
		if($decoded_array['role']==="joueur"){
			$menu="menuJoueur.php";
			$joueur=getJoueur($pseudo);
			include('../view/profil.php');
		//Si c'est un admin on le redirige
		}else if($decoded_array['role']==="admin"){
			Header('Location:/redirection');
		}else{
			Header('Location:/redirection');		
		}
	}else{
		Header('Location:/redirection');
	}
}
?>