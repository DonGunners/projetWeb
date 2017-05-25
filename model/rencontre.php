<?php

function listeMatchPhase($id){
	//donnée : id d'une phase
	//résultat : toutes les informations des matchs de cette phase
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT * FROM rencontre WHERE id_phase=?;');
			$req->execute(array($id));
			$liste=$req;
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
		return $liste;
}


function ajouterMatch($id,$date,$nom1,$nom2,$cote1,$coteN,$cote2){
	//donnée : id, date, deux equipes et trois cotes d'un match 
	//résultat : ajout de la rencontre dans la bd 
		global $pdo;
		try{
			$req=$pdo->prepare('INSERT INTO rencontre (id_phase,date_rencontre,nom_equipe1,nom_equipe2,cote_equipe1,cote_nul,cote_equipe2) VALUES (?,?,?,?,?,?,?);');
			$req->execute(array($id,$date,$nom1,$nom2,$cote1,$coteN,$cote2));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
}

function getMatch($id){
	//donnée : id d'une rencontre
	//résultat : toutes les informations de cette rencontre 
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT * FROM rencontre WHERE id_rencontre=?;');
			$req->execute(array($id));
			$match=$req->fetchAll();
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
		return $match;
}

function modifierMatch($id,$date,$nom1,$nom2,$cote1,$coteN,$cote2,$res){
	//donnée : id, date, deux équipes et trois cotes d'un match
	//résultat : modification de cette rencontre
		global $pdo;
		try{
			$req=$pdo->prepare('UPDATE rencontre SET date_rencontre=?,nom_equipe1=?,nom_equipe2=?,cote_equipe1=?,cote_nul=?,cote_equipe2=?,resultat_rencontre=? WHERE id_rencontre=?;');
			$req->execute(array($date,$nom1,$nom2,$cote1,$coteN,$cote2,$res,$id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
}

function supprimerMatch($id){
	//donnée : id d'une rencontre
	//résultat : suppression de la rencontre
		global $pdo;
		try{
			$req=$pdo->prepare('DELETE FROM rencontre WHERE id_rencontre=?;');
			$req->execute(array($id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
}

function listeMatchEnCours(){
	//donnée :
	//résultat : liste des matchs sans résultats	
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT m.id_rencontre,c.nom_competition, p.libelle_phase, concat(m.nom_equipe1,\' - \',m.nom_equipe2) AS rencontre, m.date_rencontre, m.nom_equipe1, m.nom_equipe2, m.resultat_rencontre FROM competition c, phase p, rencontre m WHERE c.id_competition=p.id_competition AND p.id_phase=m.id_phase AND m.resultat_rencontre IS NULL ORDER BY m.date_rencontre');
			$req->execute();
			$liste=$req;
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
		return $liste;
}

function setResultat($id,$res){
	//donnée : id et resultat d'un match
	//résultat : modification du résultat du match	
		global $pdo;
		try{
			$req=$pdo->prepare('UPDATE rencontre SET resultat_rencontre=? WHERE id_rencontre=?');
			$req->execute(array($res,$id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
}

function listePronostics($pseudo){
	//donnée : pseudo d'un joueur 
	//résultat : liste des matchs qui n'ont pas débuté et que le joueur n'a pas encore pronostiqué 	
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT c.nom_competition, p.libelle_phase, m.date_rencontre, m.id_rencontre, m.nom_equipe1, m.nom_equipe2, m.cote_equipe1, m.cote_nul, m.cote_equipe2
				FROM competition c, phase p, rencontre m
				WHERE c.id_competition=p.id_competition AND p.id_phase=m.id_phase AND m.date_rencontre>CURRENT_TIMESTAMP  AND m.id_rencontre NOT IN (
				SELECT pr.id_rencontre 
				FROM pronostic pr, joueur j 
				WHERE j.pseudo_joueur LIKE ? AND j.id_joueur=pr.id_joueur)
				ORDER BY m.date_rencontre');
			$req->execute(array($pseudo));
			$liste=$req;
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
		return $liste;
}

?>