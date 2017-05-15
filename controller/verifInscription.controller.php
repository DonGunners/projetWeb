<?php
require_once('../model/connexionBD.php');
require_once('../model/joueur.php');


//TODO : mettre ces variables dans un fichier .env
$key = "ceSera1cLEPouRPrONos";
$keyCryptage= "ProJEtWe5";

//vérifie que l'utilisateur n'est pas connecté
if(!isset($_COOKIE["token"])){
	 //vérifie que tous les champs sont non vides et non NULL
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
          		$id=existeJoueur($pseudo);
				//On vérifie que l'étudiant n'est pas déjà dans la base de données
				if(!$id>0){
			        ajoutJoueur($pseudo,$password,$email);
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
}else{
	header('Location:../controller/redirection.php');
}
?>
