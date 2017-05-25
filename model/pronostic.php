<?php

function setProno($idM,$res,$idJ){
	//donnée : id d'un match, id d'un joueur et un résultat
	//résultat : ajout du pronostic dans la bd	
		global $pdo;
		try{
			$req=$pdo->prepare('INSERT INTO pronostic VALUES(?,?,?,CURRENT_TIMESTAMP)');
			$req->execute(array($idJ,$idM,$res));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
}

function listeParisFinis($id){
	//donnée : id d'un joueur 
	//résultat : liste des pronostic associé à ce joueur dont le résultat n'est pas null
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT c.nom_competition, p.libelle_phase, m.date_rencontre, m.nom_equipe1, m.nom_equipe2, m.cote_equipe1, m.cote_nul, m.cote_equipe2, m.resultat_rencontre, pr.prono_joueur, pr.date_prono
				FROM rencontre m, pronostic pr, phase p, competition c
				WHERE c.id_competition=p.id_competition AND p.id_phase=m.id_phase AND m.id_rencontre=pr.id_rencontre AND pr.id_joueur=? AND m.resultat_rencontre IS NOT NULL
				ORDER BY m.date_rencontre DESC');
			$req->execute(array($id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
		return $req;
}

function listeParisEnCours($id){
	//donnée : id d'un joueur 
	//résultat : liste des pronostic associé à ce joueur dont le résultat est null	
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT c.nom_competition, p.libelle_phase, m.date_rencontre, m.nom_equipe1, m.nom_equipe2, m.cote_equipe1, m.cote_nul, m.cote_equipe2, pr.prono_joueur, pr.date_prono
				FROM rencontre m, pronostic pr, phase p, competition c
				WHERE c.id_competition=p.id_competition AND p.id_phase=m.id_phase AND m.id_rencontre=pr.id_rencontre AND pr.id_joueur=? AND m.resultat_rencontre IS NULL
				ORDER BY m.date_rencontre ASC');
			$req->execute(array($id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la requete" );
		}
		return $req;
}


?>