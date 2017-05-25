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
		if($decoded_array['role']==="joueur"){
			//Si c'est un joueur on le redirige vers l'accueil
			Header('Location:/redirection');
		}else if($decoded_array['role']==="admin"){
			//Si c'est un admin on effectue les tests
			//On vérifie que les champs ne soient pas vide et non null.
			if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['email'])
			&& !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['email'])){
				//Sécurisation des données saisies
				$pseudo = htmlspecialchars ($_POST['pseudo']);
				$password = htmlspecialchars ($_POST['password']);
				$email = htmlspecialchars ($_POST['email']);
				//Vérification de la validité de l'email
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					//On crypte le mot de passe avec un "grain de sel"
					$password = crypt($password,$keyCryptage);
					$truePassword=getMdpAdmin($pseudo);
					//On vérifie que le mot de passe est bon
					if($password===$truePassword){
						//on vérifie si le mail n'existe pas déjà
						$id=existeEmailAdmin($email);
						if(!$id>0){
							//modification email
							ModifierEmailAdmin($pseudo,$email);
							Header('Location:/admins/update/email/confirmation');
						}else{
							echo "email déjà pris";
							Header('Location:/admins/update/email');
						}
					}else{
						echo "mot de passe incorrecte";
						Header('Location:/admins/update/email');			
					}
				}else{
					echo "email invalide";
					Header('Location:/admins/update/email');			
				}
			}else{
				echo "champs vide";
				Header('Location:/admins/update/email');
			}
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