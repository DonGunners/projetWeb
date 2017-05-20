<?php

function setProno($idM,$res,$idJ){
	
		global $pdo;
		try{
			$req=$pdo->prepare('INSERT INTO pronostic VALUES(?,?,?,CURRENT_TIMESTAMP)');
			$req->execute(array($idJ,$idM,$res));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
}

function listeParisFinis($id){
	
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT c.nom_competition, p.libelle_phase, m.date_rencontre, m.nom_equipe1, m.nom_equipe2, m.cote_equipe1, m.cote_nul, m.cote_equipe2, m.resultat_rencontre, pr.prono_joueur, pr.date_prono
				FROM rencontre m, pronostic pr, phase p, competition c
				WHERE c.id_competition=p.id_competition AND p.id_phase=m.id_phase AND m.id_rencontre=pr.id_rencontre AND pr.id_joueur=? AND m.resultat_rencontre IS NOT NULL
				ORDER BY m.date_rencontre DESC');
			$req->execute(array($id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		return $req;
}

function listeParisEnCours($id){
	
		global $pdo;
		try{
			$req=$pdo->prepare('SELECT c.nom_competition, p.libelle_phase, m.date_rencontre, m.nom_equipe1, m.nom_equipe2, m.cote_equipe1, m.cote_nul, m.cote_equipe2, pr.prono_joueur, pr.date_prono
				FROM rencontre m, pronostic pr, phase p, competition c
				WHERE c.id_competition=p.id_competition AND p.id_phase=m.id_phase AND m.id_rencontre=pr.id_rencontre AND pr.id_joueur=? AND m.resultat_rencontre IS NULL
				ORDER BY m.date_rencontre ASC');
			$req->execute(array($id));
		}catch(PDOException $e){
			echo($e->getMessage());
			die(" Erreur lors de la vérification de l'existence de l'étudiant dans la base de données " );
		}
		return $req;
}


?>