<?php
require_once('../vendor/autoload.php');
require_once('../model/joueur.php');
require_once('../model/token.php');
require_once('../model/connexionBD.php');
use \Firebase\JWT\JWT;

//TODO : mettre ces variables dans un fichier .env
$key = "ceSera1cLEPouRPrONos";
$keyCryptage= "ProJEtWe5";

//On vérifie que l'utilisateur est connecté
if(isset($_COOKIE["token"])){
	//On décode le token
	$decoded = JWT::decode($_COOKIE["token"], $key, array('HS256'));
	$decoded_array = (array) $decoded;
	//on vérifie le contenu du token
	if (verificationToken($decoded_array)){
		//On vérifie que c'est un joueur
		if($decoded_array['role']==="joueur"){
			//On vérifie que les champs ne soient pas vide et non null.
			if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email'])
			&& !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['email'])){
				//Sécurisation des données saisies
				$pseudo = htmlspecialchars ($_POST['pseudo']);
				$password = htmlspecialchars ($_POST['password']);
				$email = htmlspecialchars ($_POST['email']);
				//On vérifie si l'email est valide
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					//On crypte le mot de passe avec un "grain de sel"
					$password = crypt($password,$keyCryptage);
					$truePassword=getMdpJoueur($pseudo);
					//On vérifie que le mdp est bon
					if($password===$truePassword){
						//Modification de l'email
						ModifierEmailJoueur($pseudo,$email);
						Header('Location:/profil/email/confirmation');
					}else{
						echo "mot de passe incorrecte";
						Header('Location:/profil/email');			
					}
				}else{
					echo "email incorrecte";
					Header('Location:/profil/email');			
				}
			}else{
				echo "champs vides";
				Header('Location:/profil/email');
			}
		}else if($decoded_array['role']==="admin"){
			//Si c'est un admin on le redirige vers l'accueil
			Header('Location:/redirection');			
		}else{
			//redirection accueil
			Header('Location:/redirection');
		}
	}else{
		header('Location:/redirection');
	}
}else{
	header('Location:/redirection');
}
?>