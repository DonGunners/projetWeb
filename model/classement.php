<?php

function classement(){

		global $pdo;
		try{
			$req=$pdo->prepare('SELECT pseudo_joueur, SUM(cote1) AS total FROM((SELECT SUM(m.cote_equipe1) AS cote1, j.pseudo_joueur
				FROM match m, pronostic p, joueur j
				WHERE m.id_match=p.id_match AND p.id_joueur=j.id_joueur
				AND m.resultat_match LIKE \'1\' AND p.prono_joueur LIKE \'1\'
				GROUP BY j.pseudo_joueur)
				UNION
				(SELECT SUM(m.cote_equipe2) AS cote1, j.pseudo_joueur
				FROM match m, pronostic p, joueur j
				WHERE m.id_match=p.id_match AND p.id_joueur=j.id_joueur
				AND m.resultat_match LIKE \'2\' AND p.prono_joueur LIKE \'2\'
				GROUP BY j.pseudo_joueur)
				UNION
				(SELECT SUM(m.cote_match_nul) AS cote1, j.pseudo_joueur
				FROM match m, pronostic p, joueur j
				WHERE m.id_match=p.id_match AND p.id_joueur=j.id_joueur
				AND m.resultat_match LIKE \'N\' AND p.prono_joueur LIKE \'N\'
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
				FROM match m, pronostic p, joueur j, phase ph, competition c
				WHERE m.id_match=p.id_match AND p.id_joueur=j.id_joueur AND m.id_phase=ph.id_phase AND ph.id_competition=c.id_competition
				AND m.resultat_match LIKE \'1\' AND p.prono_joueur LIKE \'1\' AND c.nom_competition LIKE ? AND j.pseudo_joueur LIKE ?
				GROUP BY j.pseudo_joueur)
				UNION
				(SELECT SUM(m.cote_equipe2) AS cote1, j.pseudo_joueur
				FROM match m, pronostic p, joueur j, phase ph, competition c
				WHERE m.id_match=p.id_match AND p.id_joueur=j.id_joueur AND m.id_phase=ph.id_phase AND ph.id_competition=c.id_competition
				AND m.resultat_match LIKE \'2\' AND p.prono_joueur LIKE \'2\' AND c.nom_competition LIKE ? AND j.pseudo_joueur LIKE ?
				GROUP BY j.pseudo_joueur)
				UNION
				(SELECT SUM(m.cote_match_nul) AS cote1, j.pseudo_joueur
				FROM match m, pronostic p, joueur j, phase ph, competition c
				WHERE m.id_match=p.id_match AND p.id_joueur=j.id_joueur AND m.id_phase=ph.id_phase AND ph.id_competition=c.id_competition
				AND m.resultat_match LIKE \'N\' AND p.prono_joueur LIKE \'N\' AND c.nom_competition LIKE ? AND j.pseudo_joueur LIKE ?
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