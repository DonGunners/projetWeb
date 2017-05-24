<?php
require_once('../vendor/autoload.php');
require_once('../model/joueur.php');
require_once('../model/token.php');
require_once('../model/connexionBD.php');
use \Firebase\JWT\JWT;

//TODO : mettre ces variables dans un fichier .env
$key = "ceSera1cLEPouRPrONos";
$keyCryptage= "ProJEtWe5";

//On vérifie que l'utilisateur n'est pas déjà connecté
if(isset($_COOKIE["token"])){
	//On décode le token
	$decoded = JWT::decode($_COOKIE["token"], $key, array('HS256'));
	$decoded_array = (array) $decoded;

	if (verificationToken($decoded_array)){
		if($decoded_array['role']==="joueur"){
			if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['oldPassword'])
			&& !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['oldPassword'])){
				if($_POST['password']===$_POST['password2']){
					//Sécurisation des données saisies
					$pseudo = htmlspecialchars ($_POST['pseudo']);
					$password = htmlspecialchars ($_POST['password']);
					$password2 = htmlspecialchars ($_POST['password2']);
					$oldPassword = htmlspecialchars ($_POST['oldPassword']);

					//On crypte le mot de passe avec un "grain de sel"
					$oldPassword = crypt($oldPassword,$keyCryptage);
					$truePassword=getMdpJoueur($pseudo);
					if($oldPassword===$truePassword){
						$password = crypt($password,$keyCryptage);
						ModifierMdpJoueur($pseudo,$password);
						Header('Location:/profil/mdp/confirmation');
					}else{
						Header('Location:/profil/mdp');			
					}
				}else{
					Header('Location:/profil/mdp');			
				}
			}else{
				Header('Location:/profil/mdp');
			}

		}else if($decoded_array['role']==="admin"){
			$menu="menuAdmin.php";
			Header('Location:/redirection');
			//On vérifie que les champs ne soient pas vide et non null.
		}
	}else{

		header('Location:/redirection');
	}
}else{
	// Cas où la personne passe directement ici par l'url et n'est pas connecté
	header('Location:/redirection');
}

?>