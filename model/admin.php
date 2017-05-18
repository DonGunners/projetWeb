<?php

function listeAdmins($pseudo){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT pseudo_admin, email_admin FROM administrateur WHERE pseudo_admin!=?;');
			$req->execute(array($pseudo));
			$liste=$req;
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		return $liste;
}

function existeAdmin($pseudo,$email){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT id_admin FROM administrateur WHERE pseudo_admin=? OR email_admin=?;');
			$req->execute(array($pseudo,$email));
			$id=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		return $id[0];
}

function ajoutAdmin($pseudo,$password,$email){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('INSERT INTO administrateur (pseudo_admin,mdp_admin,email_admin) VALUES (?,?,?)');
			$req->execute(array($pseudo,$password,$email));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
}


function supprimerAdmin($pseudo){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('DELETE FROM administrateur WHERE pseudo_admin=? AND pseudo_admin NOT LIKE \'AdminProjetWeb\';');
			$req->execute(array($pseudo));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
}

function getMdpAdmin($pseudo){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT mdp_admin FROM administrateur WHERE pseudo_admin=?');
			$req->execute(array($pseudo));
			$mdp=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		
		return $mdp[0];
}

function modifierMdpAdmin($pseudo,$mdp){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('UPDATE administrateur SET mdp_admin=? WHERE pseudo_admin=?');
			$req->execute(array($mdp,$pseudo));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
}

function modifierEmailAdmin($pseudo,$email){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('UPDATE administrateur SET email_admin=? WHERE pseudo_admin=?');
			$req->execute(array($email,$pseudo));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
}

?>