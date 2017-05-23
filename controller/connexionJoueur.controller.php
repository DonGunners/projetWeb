<?php
require_once('../vendor/autoload.php');
require_once('../model/joueur.php');
require_once('../model/connexionBD.php');
use \Firebase\JWT\JWT;

//TODO : mettre ces variables dans un fichier .env
$key = "ceSera1cLEPouRPrONos";
$keyCryptage= "ProJEtWe5";
$validity_time=5400; //Validité d'une heure trente

//On vérifie que l'utilisateur n'est pas déjà connecté
if(!isset($_COOKIE["token"])){
	//On vérifie que les champs ne soient pas vide et non null.
	if(isset($_POST['pseudo']) && isset($_POST['password']) && !empty($_POST['pseudo']) && !empty($_POST['password']) ){

		//Sécurisation des données saisies
		$pseudo = htmlspecialchars ($_POST['pseudo']);
		$password = htmlspecialchars ($_POST['password']);

		//On crypte le mot de passe avec un "grain de sel"
		$password = crypt($password,$keyCryptage);
		$id=connexionJoueur($pseudo,$password);

		//On vérifie que le login existe dans la table et que les informations sont exactes
		if (!empty($id[0])){
			//On définit le token contenant les différentes informations.
			$token = array(
			"iss" => $_SERVER['HTTP_HOST'], //contenu de l'entete Host
			"exp" => time() + $validity_time, //temps de validité du token
			"id" => $id[0], //pseudo de l'utilisateur
			"role" => $id[1] //role de l'utilisateur
			);

			//On encode le token en JWT
			$jwt = JWT::encode($token, $key);
			JWT::$leeway = 60; // $leeway in seconds

			//On conserve le token dans un cookie
			setcookie("token", $jwt, time()+$validity_time,"/", null, false, true);
			header('Location:../controller/pageAccueil.controller.php');
		}else{
			//Si le login est faux, on renvoie l'utilisateur sur la page de connexion
			include('../controller/pageConnexion.controller.php');
		}
	}else{
		//On redirige vers la page de connexion
		header('Location:../controller/pageConnexion.controller.php');
	}
}else{
	//On redirige vers la page d'accueil
	header('Location:../controller/redirection.php');
}
?>