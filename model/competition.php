<?php

function listeCompetition(){
	//donnée : 
	//résultat : toutes les informations de toutes les compétitions
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT * FROM competition;');
			$req->execute();
			$liste=$req;
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
		return $liste;
}

function getCompetition($id){
	//donnée : id d'une compétition
	//résultat : toutes les informations de cette compétition
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT * FROM competition WHERE id_competition=?;');
			$req->execute(array($id));
			$compet=$req->fetch();
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
		return $compet;
}

function modifierCompetition($id,$nom,$image){
	//donnée : id, nouveau nom et nouvelle image d'une compétition
	//résultat : la modification de la compétition
		global $pdo;
		try{
			$req=$pdo->prepare('UPDATE competition SET nom_competition=?,image_competition=? WHERE id_competition=?;');
			$req->execute(array($nom,$image,$id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
}

function supprimerCompetition($id){
	//donnée : id d'une compétition
	//résultat : suppression de la compétition
		global $pdo;
		try{
			$req=$pdo->prepare('DELETE FROM competition WHERE id_competition=?;');
			$req->execute(array($id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
}

function ajouterCompetition($nom,$image){
	//donnée : nom et image d'une compétition
	//résultat : ajout de la compétition dans la bd
		global $pdo;
		try{
			$req=$pdo->prepare('INSERT INTO competition (nom_competition, image_competition) VALUES (?,?);');
			$req->execute(array($nom,$image));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
}

?>