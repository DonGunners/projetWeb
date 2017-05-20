<?php

function existeJoueur($pseudo,$email){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT id_joueur FROM joueur WHERE pseudo_joueur=? OR email_joueur=?;');
			$req->execute(array($pseudo,$email));
			$id=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		return $id[0];
}

function connexionJoueur($pseudo,$password){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT pseudo_admin FROM administrateur WHERE pseudo_admin=? AND mdp_admin=?;');
			$req->execute(array($pseudo,$password));
			$id=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		
		if(empty($id)){
		
			try{
				$req=$pdo->prepare('SELECT pseudo_joueur FROM joueur WHERE pseudo_joueur=? AND mdp_joueur=?;');
				$req->execute(array($pseudo,$password));
				$id=$req->fetch();
			}catch(PDOException $e){
				echo($e->getMessage());
				die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
			}
			
			$id[1]="joueur";
		}else{
			$id[1]="admin";
		}
		return $id;
		
}

function ajoutJoueur($pseudo,$password,$email){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('INSERT INTO joueur (pseudo_joueur,mdp_joueur,email_joueur) VALUES (?,?,?)');
			$req->execute(array($pseudo,$password,$email));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
}

function listeJoueurs(){
	global $pdo;
	try{
		$req=$pdo->prepare('SELECT pseudo_joueur,email_joueur FROM joueur');
		$req->execute();
		$liste=$req;
	}catch(PDOException $e){
		echo($e->getMessage());
		die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
	}
	return $liste;
}

function supprimerJoueur($pseudo){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('DELETE FROM joueur WHERE pseudo_joueur=?;');
			$req->execute(array($pseudo));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
}

function getIdJoueur($pseudo){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT id_joueur FROM joueur WHERE pseudo_joueur=?;');
			$req->execute(array($pseudo));
			$pseudo=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		return $pseudo[0];
}

function getJoueur($pseudo){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT * FROM joueur WHERE pseudo_joueur=?;');
			$req->execute(array($pseudo));
			$pseudo=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		return $pseudo;
}

?>