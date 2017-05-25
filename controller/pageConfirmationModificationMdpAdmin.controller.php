<?php
require_once('../vendor/autoload.php');
require_once('../model/admin.php');
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
	//On vérifie le contenu du token
	if (verificationToken($decoded_array)){
		//Si c'est un joueur on le redirige
		if($decoded_array['role']==="joueur"){
			Header('Location:/redirection');
		}else if($decoded_array['role']==="admin"){
			//Si c'est un admins on poursuit les tests
			//On vérifie que les champs ne soient pas vide et non null.
			if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['oldPassword'])
				&& !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['oldPassword'])){
				//on vérifie que les deux mdp sont égaux
				if($_POST['password']===$_POST['password2']){
					//Sécurisation des données saisies
					$pseudo = htmlspecialchars ($_POST['pseudo']);
					$password = htmlspecialchars ($_POST['password']);
					$password2 = htmlspecialchars ($_POST['password2']);
					$oldPassword = htmlspecialchars ($_POST['oldPassword']);
					//On crypte le mot de passe avec un "grain de sel"
					$oldPassword = crypt($oldPassword,$keyCryptage);
					$truePassword=getMdpAdmin($pseudo);
					//Vérification que l'ancien mdp est correcte
					if($oldPassword===$truePassword){
						//On crypte le mot de passe avec un "grain de sel"
						$password = crypt($password,$keyCryptage);
						//modification du mdp et affichage de la page de confirmation
						ModifierMdpAdmin($pseudo,$password);
						Header('Location:/admins/update/mdp/confirmation');
					}else{
						echo "l'ancien mdp est incorrecte";
						Header('Location:/admins/update/mdp');			
					}
				}else{
					echo "les deux mdp ne sont pas égaux";
					Header('Location:/admins/update/mdp');			
				}
			}else{
				echo "champs vides";
				Header('Location:/admins/update/mdp');
			}
		}else{
			Header('Location:/redirection');
		}
	}else{
		Header('Location:/redirection');
	}
}else{
	header('Location:/redirection');
}

?>