<?php

function existeJoueur($pseudo,$email){
	//donnée : pseudo et email d'un joueur
	//résultat : id du joueur
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT id_joueur FROM joueur WHERE pseudo_joueur=? OR email_joueur=?;');
			$req->execute(array($pseudo,$email));
			$id=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
		return $id[0];
}

function existeEmailJoueur($email){
	//donnée : l'email d'un joueur
	//résultat : l'id d'un joueur si le mail existe déjà
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT id_joueur FROM joueur WHERE email_joueur=?;');
			$req->execute(array($email));
			$id=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
		return $id[0];
}

function connexionJoueur($pseudo,$password){
	//donnée : pseudo et mdp d'un joueur ou admin
	//résultat : pseudo et role du joueur ou admin
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT pseudo_admin FROM administrateur WHERE pseudo_admin=? AND mdp_admin=?;');
			$req->execute(array($pseudo,$password));
			$id=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
		
		if(empty($id)){
		
			try{
				$req=$pdo->prepare('SELECT pseudo_joueur FROM joueur WHERE pseudo_joueur=? AND mdp_joueur=?;');
				$req->execute(array($pseudo,$password));
				$id=$req->fetch();
			}catch(PDOException $e){
				echo($e->getMessage());
			die("Erreur lors de la requete");
			}
			
			$id[1]="joueur";
		}else{
			$id[1]="admin";
		}
		return $id;
		
}

function ajoutJoueur($pseudo,$password,$email){
	//donnée : pseudo, mdp et email d'un joueur 
	//résultat : ajout du joueur à la bd
		global $pdo;
		try{
			$req=$pdo->prepare('INSERT INTO joueur (pseudo_joueur,mdp_joueur,email_joueur) VALUES (?,?,?)');
			$req->execute(array($pseudo,$password,$email));
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
}

function listeJoueurs(){
	//donnée : 
	//résultat : toutes les informations de tous les joueurs
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT * FROM joueur');
			$req->execute();
			$liste=$req;
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
		return $liste;
}

function supprimerJoueur($id){
	//donnée : id d'un joueur 
	//résultat : suppression du joueur
		global $pdo;
		try{
			$req=$pdo->prepare('DELETE FROM joueur WHERE id_joueur=?;');
			$req->execute(array($id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
}

function getIdJoueur($pseudo){
	//donnée : pseudo d'un joueur
	//résultat : id du joueur
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT id_joueur FROM joueur WHERE pseudo_joueur=?;');
			$req->execute(array($pseudo));
			$pseudo=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
		return $pseudo[0];
}

function getPseudoJoueur($id){
	//donnée : id d'un joueur
	//résultat : pseudo du joueur
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT pseudo_joueur FROM joueur WHERE id_joueur=?;');
			$req->execute(array($id));
			$pseudo=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
		return $pseudo;
}

function getJoueur($pseudo){
	//donnée : pseudo d'un joueur 
	//résultat : toutes les informations du joueur
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT * FROM joueur WHERE pseudo_joueur=?;');
			$req->execute(array($pseudo));
			$pseudo=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
		return $pseudo;
}

function classement(){
	//donnée : 
	//résultat : liste des joueurs et leur total de points 
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT pseudo_joueur, ROUND(SUM(cote1),2) AS total FROM((SELECT SUM(m.cote_equipe1) AS cote1, j.pseudo_joueur
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
			die("Erreur lors de la requete");
		}
		return $liste;
}

function getScore($pseudo,$compet){
	//donnée : pseudo d'un joueur et nom d'une competition
	//résultat : score du joueur dans la compétition
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT ROUND(SUM(cote1),2) AS total FROM((SELECT SUM(m.cote_equipe1) AS cote1, j.pseudo_joueur
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
			die("Erreur lors de la requete");
		}
		return $liste[0];
}

function getMdpJoueur($pseudo){
	//donnée : pseudo d'un joueur
	//résultat : mdp du joueur
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT mdp_joueur FROM joueur WHERE pseudo_joueur=?');
			$req->execute(array($pseudo));
			$mdp=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
		
		return $mdp[0];
}

function modifierMdpJoueur($pseudo,$mdp){
	//donnée : pseudo et nouveau mdp d'un joueur
	//résultat : modification du mot de passe du joueur
		global $pdo;
		try{
			$req=$pdo->prepare('UPDATE joueur SET mdp_joueur=? WHERE pseudo_joueur=?');
			$req->execute(array($mdp,$pseudo));
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
}

function modifierEmailJoueur($pseudo,$email){
	//donnée : pseudo et nouvel email d'un joueur 
	//résultat : modification de l'email du joueur
		global $pdo;
		try{
			$req=$pdo->prepare('UPDATE joueur SET email_joueur=? WHERE pseudo_joueur=?');
			$req->execute(array($email,$pseudo));
		}catch(PDOException $e){
			echo($e->getMessage());
			die("Erreur lors de la requete");
		}
}

?>