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

function classement(){

		global $pdo;
		try{
			$req=$pdo->prepare('SELECT pseudo_joueur, SUM(cote1) AS total FROM((SELECT SUM(m.cote_equipe1) AS cote1, j.pseudo_joueur
				FROM rencontre m, pronostic p, joueur j
				WHERE m.id_rencontre=p.id_rencontre AND p.id_joueur=j.id_joueur
				AND m.resultat_rencontre LIKE \'1\' AND p.prono_joueur LIKE \'1\'
				GROUP BY j.pseudo_joueur)
				UNION
				(SELECT SUM(m.cote_equipe2) AS cote1, j.pseudo_joueur
				FROM rencontre m, pronostic p, joueur j
				WHERE m.id_rencontre=p.id_rencontre AND p.id_joueur=j.id_joueur
				AND m.resultat_rencontre LIKE \'2\' AND p.prono_joueur LIKE \'2\'
				GROUP BY j.pseudo_joueur)
				UNION
				(SELECT SUM(m.cote_nul) AS cote1, j.pseudo_joueur
				FROM rencontre m, pronostic p, joueur j
				WHERE m.id_rencontre=p.id_rencontre AND p.id_joueur=j.id_joueur
				AND m.resultat_rencontre LIKE \'N\' AND p.prono_joueur LIKE \'N\'
				GROUP BY j.pseudo_joueur)) AS TOTAL
				GROUP BY pseudo_joueur
				ORDER BY total DESC;');
			$req->execute();
			$liste=$req;
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		return $liste;
}

function getScore($pseudo,$compet){
	
	global $pdo;
		try{
			$req=$pdo->prepare('SELECT SUM(cote1) AS total FROM((SELECT SUM(m.cote_equipe1) AS cote1, j.pseudo_joueur
				FROM rencontre m, pronostic p, joueur j, phase ph, competition c
				WHERE m.id_rencontre=p.id_rencontre AND p.id_joueur=j.id_joueur AND m.id_phase=ph.id_phase AND ph.id_competition=c.id_competition
				AND m.resultat_rencontre LIKE \'1\' AND p.prono_joueur LIKE \'1\' AND c.nom_competition LIKE ? AND j.pseudo_joueur LIKE ?
				GROUP BY j.pseudo_joueur)
				UNION
				(SELECT SUM(m.cote_equipe2) AS cote1, j.pseudo_joueur
				FROM rencontre m, pronostic p, joueur j, phase ph, competition c
				WHERE m.id_rencontre=p.id_rencontre AND p.id_joueur=j.id_joueur AND m.id_phase=ph.id_phase AND ph.id_competition=c.id_competition
				AND m.resultat_rencontre LIKE \'2\' AND p.prono_joueur LIKE \'2\' AND c.nom_competition LIKE ? AND j.pseudo_joueur LIKE ?
				GROUP BY j.pseudo_joueur)
				UNION
				(SELECT SUM(m.cote_nul) AS cote1, j.pseudo_joueur
				FROM rencontre m, pronostic p, joueur j, phase ph, competition c
				WHERE m.id_rencontre=p.id_rencontre AND p.id_joueur=j.id_joueur AND m.id_phase=ph.id_phase AND ph.id_competition=c.id_competition
				AND m.resultat_rencontre LIKE \'N\' AND p.prono_joueur LIKE \'N\' AND c.nom_competition LIKE ? AND j.pseudo_joueur LIKE ?
				GROUP BY j.pseudo_joueur)) AS TOTAL
				GROUP BY pseudo_joueur
				ORDER BY total DESC;');
			$req->execute(array($compet,$pseudo,$compet,$pseudo,$compet,$pseudo));
			$liste=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		return $liste[0];
}

?>