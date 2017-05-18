<?php

function listeMatchPhase($id){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT * FROM match WHERE id_phase=?;');
			$req->execute(array($id));
			$liste=$req;
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		return $liste;
}


function ajouterMatch($id,$date,$nom1,$nom2,$cote1,$coteN,$cote2){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('INSERT INTO match (id_phase,date_match,nom_equipe1,nom_equipe2,cote_equipe1,cote_match_nul,cote_equipe2) VALUES (?,?,?,?,?,?,?);');
			$req->execute(array($id,$date,$nom1,$nom2,$cote1,$coteN,$cote2));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
}

function getMatch($id){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT * FROM match WHERE id_match=?;');
			$req->execute(array($id));
			$match=$req->fetchAll();
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		return $match;
}

function modifierMatch($id,$date,$nom1,$nom2,$cote1,$coteN,$cote2,$res){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('UPDATE match SET (date_match,nom_equipe1,nom_equipe2,cote_equipe1,cote_match_nul,cote_equipe2,resultat_match) = (?,?,?,?,?,?,?) WHERE id_match=?;');
			$req->execute(array($date,$nom1,$nom2,$cote1,$coteN,$cote2,$res,$id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
}

function supprimerMatch($id){
	//donnée : email de l'étudiant et son mot de passe crypté 
	//pré : email : String / password : String 
	//résultat : id de l'étudiant s'il existe, NULL sinon 
	//post : id : entier >0
		global $pdo;
		try{
			$req=$pdo->prepare('DELETE FROM match WHERE id_match=?;');
			$req->execute(array($id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
}

function listeMatchEnCours(){
	
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT m.id_match,c.nom_competition, p.libelle_phase, concat(m.nom_equipe1,\' - \',m.nom_equipe2) AS match, m.date_match, m.nom_equipe1, m.nom_equipe2, m.resultat_match FROM competition c, phase p, match m WHERE c.id_competition=p.id_competition AND p.id_phase=m.id_phase AND m.resultat_match IS NULL ORDER BY m.date_match');
			$req->execute();
			$liste=$req;
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		return $liste;
}

function setResultat($id,$res){
	
		global $pdo;
		try{
			$req=$pdo->prepare('UPDATE match SET resultat_match=? WHERE id_match=?');
			$req->execute(array($res,$id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
}

function listePronostics($pseudo){
	
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT c.nom_competition, p.libelle_phase, m.date_match, m.id_match, m.nom_equipe1, m.nom_equipe2, m.cote_equipe1, m.cote_match_nul, m.cote_equipe2
				FROM competition c, phase p, match m
				WHERE c.id_competition=p.id_competition AND p.id_phase=m.id_phase AND m.id_match NOT IN (
				SELECT pr.id_match 
				FROM pronostic pr, joueur j 
				WHERE j.pseudo_joueur LIKE ? AND j.id_joueur=pr.id_joueur)
				ORDER BY m.date_match');
			$req->execute(array($pseudo));
			$liste=$req;
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		return $liste;
}

?>