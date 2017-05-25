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

	if (verificationToken($decoded_array)){
		if($decoded_array['role']==="joueur"){
			//Si c'est un joueur on effectue les tests
			//on vérifie si les champs ne sont pas vides
			if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['oldPassword'])
			&& !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['oldPassword'])){
				//On vérifie si les deux mots de passes sont egaux
				if($_POST['password']===$_POST['password2']){
					//Sécurisation des données saisies
					$pseudo = htmlspecialchars ($_POST['pseudo']);
					$password = htmlspecialchars ($_POST['password']);
					$password2 = htmlspecialchars ($_POST['password2']);
					$oldPassword = htmlspecialchars ($_POST['oldPassword']);
					//On crypte le mot de passe avec un "grain de sel"
					$oldPassword = crypt($oldPassword,$keyCryptage);
					$truePassword=getMdpJoueur($pseudo);
					//On vérifie que l'ancien mot de passe est correcte
					if($oldPassword===$truePassword){
						//On crypte le mot de passe avec un "grain de sel"
						$password = crypt($password,$keyCryptage);
						//modification mot de passe joueur et affichage page confirmation
						ModifierMdpJoueur($pseudo,$password);
						Header('Location:/profil/mdp/confirmation');
					}else{
						echo "l'ancien mot de passe est incorrecte";
						Header('Location:/profil/mdp');			
					}
				}else{
					echo "les deux mdp ne sont pas égaux"
					Header('Location:/profil/mdp');			
				}
			}else{
				echo "champs vides";
				Header('Location:/profil/mdp');
			}
		}else if($decoded_array['role']==="admin"){
			//Si c'est un admin on le redirige à l'accueil
			Header('Location:/redirection');
		}else{
			Header('Location:/redirection');
		}
	}else{
		header('Location:/redirection');
	}
}else{
	header('Location:/redirection');
}

?>