<?php
require_once('../vendor/autoload.php');
require_once('../model/token.php');
require_once('../model/competition.php');
require_once('../model/joueur.php');  
require_once('../model/connexionBD.php');
use \Firebase\JWT\JWT;

//TODO: mettre dans un fichier .env
$key = "ceSera1cLEPouRPrONos";

//On vérifie que l'utilisateur est connecté
if(!isset($_COOKIE["token"])){
	$menu="menu.php";
	// On le redirige vers la page d'accueil
	Header('Location:/redirection');
}else{
	//On décode le token
	$decoded = JWT::decode($_COOKIE["token"], $key, array('HS256'));
	$decoded_array = (array) $decoded;
	//On vérifie le contenu du token
	if (verificationToken($decoded_array)){
		//Si c'est un joueur on affiche le classement
		if($decoded_array['role']==="joueur"){
			$menu="menuJoueur.php";
			$listeCompet=listeCompetition();// on récupère la liste des compétitions
			$class=classement();//on récupère le classement total de chaque joueur
			$cpt=1; //initialisation du compteur du classement
			include('../view/classement.php');
		//Si c'est un admin on affiche le classement
		}else if($decoded_array['role']==="admin"){
			$menu="menuAdmin.php";
			$listeCompet=listeCompetition();// on récupère la liste des compétitions
			$class=classement();//on récupère le classement total de chaque joueur
			$cpt=1; //initialisation du compteur du classement
			include('../view/classement.php');
		}else{
			// On le redirige vers la page d'accueil
			Header('Location:/redirection');	
		}
	}else{
		Header('Location:/redirection');
	}
}
?>