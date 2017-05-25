<?php

function listeAdmins($pseudo){
	//donnée : pseudo d'un admin
	//résultat : toutes les informations des admins sauf lui-meme
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT * FROM administrateur WHERE pseudo_admin!=?;');
			$req->execute(array($pseudo));
			$liste=$req;
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
		return $liste;
}

function existeAdmin($pseudo,$email){
	//donnée : pseudo et l'email d'un admin
	//résultat : id de l'admin
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT id_admin FROM administrateur WHERE pseudo_admin=? OR email_admin=?;');
			$req->execute(array($pseudo,$email));
			$id=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
		return $id[0];
}

function existeEmailAdmin($email){
	//donnée : l'email d'un admin
	//résultat : l'id d'un admin si le mail existe déjà
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT id_admin FROM administrateur WHERE email_admin=?;');
			$req->execute(array($email));
			$id=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
		return $id[0];
}

function ajoutAdmin($pseudo,$password,$email){
	//donnée : pseudo, mdp et email du futur admin
	//résultat : ajout de l'admin dans la bd
		global $pdo;
		try{
			$req=$pdo->prepare('INSERT INTO administrateur (pseudo_admin,mdp_admin,email_admin) VALUES (?,?,?)');
			$req->execute(array($pseudo,$password,$email));
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
}


function supprimerAdmin($id){
	//donnée : id d'un admin
	//résultat : suppression de l'admin
		global $pdo;
		try{
			$req=$pdo->prepare('DELETE FROM administrateur WHERE id_admin=? AND pseudo_admin NOT LIKE \'AdminProjetWeb\';');
			$req->execute(array($id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
}

function getMdpAdmin($pseudo){
	//donnée : pseudo d'un admin 
	//résultat : mdp de l'admin
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT mdp_admin FROM administrateur WHERE pseudo_admin=?');
			$req->execute(array($pseudo));
			$mdp=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
		
		return $mdp[0];
}

function getPseudoAdmin($id){
	//donnée : id de l'admin
	//résultat : pseudo de l'admin
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT pseudo_admin FROM administrateur WHERE id_admin=?');
			$req->execute(array($id));
			$mdp=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
		
		return $mdp[0];
}

function modifierMdpAdmin($pseudo,$mdp){
	//donnée : pseudo et le nouveau mdp d'un admin
	//résultat : modification de son mdp
		global $pdo;
		try{
			$req=$pdo->prepare('UPDATE administrateur SET mdp_admin=? WHERE pseudo_admin=?');
			$req->execute(array($mdp,$pseudo));
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
}

function modifierEmailAdmin($pseudo,$email){
	//donnée : pseudo et le nouvel email d'un admin
	//résultat : modification de son email
		global $pdo;
		try{
			$req=$pdo->prepare('UPDATE administrateur SET email_admin=? WHERE pseudo_admin=?');
			$req->execute(array($email,$pseudo));
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
}

?>