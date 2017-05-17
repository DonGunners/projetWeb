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

?>