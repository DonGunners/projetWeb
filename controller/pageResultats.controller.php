<?php
require_once('../vendor/autoload.php');
require_once('../model/token.php');
require_once('../model/joueur.php');
require_once('../model/pronostic.php');
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
		//si c'est un joueur on récupère ses pronostics et on affiche la page
		if($decoded_array['role']==="joueur"){
			$menu="menuJoueur.php";
			$id=getIdJoueur($pseudo);
			if(isset($_GET['mode'])){
				$listeParis=listeParisEnCours($id);
			}else{
				$listeParis=listeParisFinis($id);			  
			}
			include('../view/pageResultats.php');
		}else if($decoded_array['role']==="admin"){
			//si c'est un admin on le redirige
			Header('Location:/redirection');
		}else{
			Header('Location:/redirection');	
		}
	}else{
		Header('Location:/redirection');
	}
}
?>