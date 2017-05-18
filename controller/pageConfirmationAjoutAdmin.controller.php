<?php
  require_once('../vendor/autoload.php');
  require_once('../model/token.php');
  require_once('../model/admin.php');
  require_once('../model/connexionBD.php');
  use \Firebase\JWT\JWT;

  //TODO: mettre dans un fichier .env
  $key = "ceSera1cLEPouRPrONos";

    //On vérifie que l'utilisateur est déjà connecté
    if(!isset($_COOKIE["token"])){
			$menu="menu.php";
            // On le redirige vers la page d'accueil
            Header('Location:../controller/redirection.php');
    }
    else{
		
		//On décode le token
      $decoded = JWT::decode($_COOKIE["token"], $key, array('HS256'));
      $decoded_array = (array) $decoded;
	  
	  if (verificationToken($decoded_array)){
		$pseudo=$decoded_array['id'];
        if($decoded_array['role']==="joueur"){
          Header('Location:../controller/redirection.php');
        }
        else if($decoded_array['role']==="admin"){
		  $menu="menuAdmin.php";
		  if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['email']) &&
			!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email'])){
				//Sécurisation des données saisies
				$pseudo = htmlspecialchars ($_POST['pseudo']);
				$password = htmlspecialchars ($_POST['password']);
				$password2 = htmlspecialchars ($_POST['password2']);
				$email = htmlspecialchars ($_POST['email']);
				//vérifie que le mot de passe et sa confirmation son égaux
				if($password==$password2){

					//vérifie que l'email est bien de la forme prenom.nom@etu.umontpellier.Fr
					if(filter_var($email, FILTER_VALIDATE_EMAIL)){
						//On crypte le mot de passe avec un "grain de sel"
						$password = crypt($password,$keyCryptage);
						$id=existeAdmin($pseudo,$email);
						//On vérifie que l'étudiant n'est pas déjà dans la base de données
						if(!$id>0){
							ajoutAdmin($pseudo,$password,$email);
							header('Location:../view/pageConfirmationInscription.php');
						}else{
							echo 'ERREUR : un compte pour cet étudiant existe déjà';
						}
					}else{
						echo 'ERREUR : l\'email n\'a pas la forme d\'un email';
					}
				}else{
					echo 'ERREUR : les deux mots de passe ne correspondent pas';
				}
			}else{
				echo 'ERREUR : un des champs est vide';
			}
          Header('Location:../controller/gestionAdmins.controller.php');
        }else{
          // On le redirige vers la page admin
		  $menu="menu.php";
            Header('Location:../controller/redirection.php');		
		}
	  }else{
            Header('Location:../controller/redirection.php');
	  }
    }
?>