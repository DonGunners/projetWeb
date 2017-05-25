<?php

function listePhaseCompetition($id){
	//donnée : id d'une phase
	//résultat : toutes les informations des phases de la compétition
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT * FROM phase WHERE id_competition=?;');
			$req->execute(array($id));
			$liste=$req;
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
		return $liste;
}


function ajouterPhase($id,$nom){
	//donnée : id et nom d'une phase
	//résultat : ajout de la phase
		global $pdo;
		try{
			$req=$pdo->prepare('INSERT INTO phase (id_competition,libelle_phase) VALUES (?,?);');
			$req->execute(array($id,$nom));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
}

function getPhase($id){
	//donnée : id d'une phase 
	//résultat : toutes les informations de la phase 
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT * FROM phase WHERE id_phase=?;');
			$req->execute(array($id));
			$phase=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
		return $phase;
}

function modifierPhase($id,$nom){
	//donnée : id et nouveau nom d'une phase
	//résultat : modification du nom de la phase 
		global $pdo;
		try{
			$req=$pdo->prepare('UPDATE phase SET libelle_phase=? WHERE id_phase=?;');
			$req->execute(array($nom,$id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
}

function supprimerPhase($id){
	//donnée : id d'une phase
	//résultat : suppression de la phase
		global $pdo;
		try{
			$req=$pdo->prepare('DELETE FROM phase WHERE id_phase=?;');
			$req->execute(array($id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
}

?>