<?php
require_once('../vendor/autoload.php');
require_once('../model/token.php');
require_once('../model/connexionBD.php');
use \Firebase\JWT\JWT;

//TODO: mettre dans un fichier .env
$key = "ceSera1cLEPouRPrONos";

//On regarde si l'utilisateur est connecté
if(!isset($_COOKIE["token"])){
	$menu="menu.php";
	// On affiche la page d'accueil
	include('../view/pageAccueil.php');
}else{
	//On décode le token
	$decoded = JWT::decode($_COOKIE["token"], $key, array('HS256'));
	$decoded_array = (array) $decoded;
	//On vérifie le contenu du token
	if (verificationToken($decoded_array)){
		if($decoded_array['role']==="joueur"){
			//Si c'est un joueur on créé un menu joueur
			$menu="menuJoueur.php";
			include('../view/pageAccueil.php');
		}else if($decoded_array['role']==="admin"){
			//Si c'est un admin on créé un menu admin
			$menu="menuAdmin.php";
			include('../view/pageAccueil.php');
		}else{
			$menu="menu.php";
			include('../view/pageAccueil.php');			
		}
	}else{
		include('../view/pageAccueil.php');
	}
}
?>