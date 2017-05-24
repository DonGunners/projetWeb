<?php
require_once('../vendor/autoload.php');
require_once('../model/admin.php');
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
		$pseudo=$decoded_array['id'];
		if($decoded_array['role']==="joueur"){
			Header('Location:/redirection');
		}else if($decoded_array['role']==="admin"){
			$menu="menuAdmin.php";
			//On vérifie que les champs ne soient pas vide et non null.
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
					$truePassword=getMdpAdmin($pseudo);
					if($oldPassword===$truePassword){
						$password = crypt($password,$keyCryptage);
						ModifierMdpAdmin($pseudo,$password);
						Header('Location:/admins/update/mdp/confirmation');
					}else{
						Header('Location:/admins/update/mdp');			
					}
				}else{
					Header('Location:/admins/update/mdp');			
				}
			}else{
				Header('Location:/admins/update/mdp');
			}
		}else{
			Header('Location:/admins/update/mdp');
		}
	}else{
		Header('Location:/admins/update/mdp');
	}
}else{
	// Cas où la personne passe directement ici par l'url et n'est pas connecté
	header('Location:/redirection');
}

?>