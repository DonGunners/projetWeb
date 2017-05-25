<?php
require_once('../vendor/autoload.php');
require_once('../model/token.php');
require_once('../model/connexionBD.php');
require_once('../model/rencontre.php');
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
		if($decoded_array['role']==="joueur"){
			//Si joueur on le redirige
			Header('Location:/redirection');
		}else if($decoded_array['role']==="admin"){
			//Si admin on modifie le match et on affiche la page de confirmation
			if(empty($_POST['res'])){
				//Si le résultat est vide on lui assigne une valeur NULL
				$_POST['res']=NULL;
			}
			modifierMatch($_POST['id_rencontre'],$_POST['date'],$_POST['nom1'],$_POST['nom2'],$_POST['cote1'],$_POST['coteN'],$_POST['cote2'],$_POST['res']);
			Header('Location:/competition/'.$_GET['idC'].'/phase/'.$_GET['idP'].'/match/'.$_POST['id_rencontre'].'/update/confirmation');
		}else{
			//redirection accueil
			Header('Location:/redirection');			
		}
	}else{
		Header('Location:/redirection');
	}
}
?>