<?php
require_once('../vendor/autoload.php');
require_once('../model/token.php');
require_once('../model/admin.php');
require_once('../model/connexionBD.php');
use \Firebase\JWT\JWT;

//TODO: mettre dans un fichier .env
$key = "ceSera1cLEPouRPrONos";
$keyCryptage= "ProJEtWe5";

//On vérifie que l'utilisateur est connecté
if(!isset($_COOKIE["token"])){
	// On le redirige vers la page d'accueil
	Header('Location:/redirection');
}else{
	//On décode le token
	$decoded = JWT::decode($_COOKIE["token"], $key, array('HS256'));
	$decoded_array = (array) $decoded;
	//On vérifie le contenu du token
	if (verificationToken($decoded_array)){
		if($decoded_array['role']==="joueur"){
			//Si c'est un joueur on le redirige vers l'accueil
			Header('Location:/redirection');
		}else if($decoded_array['role']==="admin"){
			//Si c'est un admin on regarde que les champs ont bien été remplis
			if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['email']) &&
			!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email'])){
				//Sécurisation des données saisies
				$pseudo = htmlspecialchars ($_POST['pseudo']);
				$password = htmlspecialchars ($_POST['password']);
				$password2 = htmlspecialchars ($_POST['password2']);
				$email = htmlspecialchars ($_POST['email']);
				//on vérifie que le mot de passe et sa confirmation son égaux
				if($password==$password2){
					//on vérifie que l'email est bien formé
					if(filter_var($email, FILTER_VALIDATE_EMAIL)){
						//On crypte le mot de passe avec un "grain de sel"
						$password = crypt($password,$keyCryptage);
						$id=existeAdmin($pseudo,$email);
						//On vérifie que l'admin n'est pas déjà dans la base de données
						if(!$id>0){
							ajoutAdmin($pseudo,$password,$email);
							Header('Location:/admins');
						}else{
							echo "L'utilisateur existe déjà";
							Header('Location:/admins/add');
						}
					}else{
						echo "l'email n'est pas valide";
						Header('Location:/admins/add');
					}
				}else{
					echo "les mots de passes ne sont pas égaux";
					Header('Location:/admins/add');
				}
			}else{
				echo "des champs sont vides";
				Header('Location:/admins/add');
			}
		}else{
			// On le redirige vers la page d'accueil
			Header('Location:/redirection');		
		}
	}else{
		Header('Location:/redirection');
	}
}
?>