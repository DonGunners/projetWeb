<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Projet Web</title>

    <link href="../assets/css/projetWeb.css" rel="stylesheet">	
	
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="../assets/css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">


</head>

<body id="page-top" class="index">

	<?php 
	if(isset($menu)){
		include($menu);
	}else{
		include('menu.php');
	}?>

	<section id="portfolio">
        <div class="container">
            <div class="row">
				<a href="../controller/adminPhase.controller.php?idC=<?php echo $_GET['idC'];?>"><button type="button" class="btn btn-primary">Retour</button></a>
                <div class="col-lg-12 text-center">
                    <h2>Gestion Matchs</h2>
                    <hr class="star-primary">
				<div class="panel panel-success" id="tableGestion">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Date Match</th>
								<th>Equipe Domicile</th>
								<th>Equipe Extérieur</th>
								<th>cote 1</th>
								<th>cote N</th>
								<th>cote 2</th>
								<th>Résultat</th>
								<th>Modifier</th>
								<th>Supprimer</th>
							</tr>
						</thead>
					<?php
					while($donnees=$listeMatchs->fetch()){
						    echo "<tr>";
							echo "<td> $donnees[date_match] </td>";
							echo "<td> $donnees[nom_equipe1] </td>";
							echo "<td> $donnees[nom_equipe2] </td>";
							echo "<td> $donnees[cote_equipe1] </td>";
							echo "<td> $donnees[cote_match_nul] </td>";
							echo "<td> $donnees[cote_equipe2] </td>";
							echo "<td> $donnees[resultat_match] </td>";
							echo "<td><a href=\"../controller/modifierMatch.controller.php?idM=$donnees[id_match]&idP=";
							echo $_GET['idP'];
							echo "&idC=";
							echo $_GET['idC'];
							echo "\"><button type=\"button\" class=\"btn btn-warning\">Modifier</button></a></td>";
							echo "<td><a href=\"../controller/supprimerMatch.controller.php?idM=$donnees[id_match]&idP=";
							echo $_GET['idP'];
							echo "&idC=";
							echo $_GET['idC'];
							echo "\"><button type=\"button\" class=\"btn btn-danger\">Supprimer</button></a></td>";
							echo "</tr>";
					}						
					?>
					<form method="post" action="../controller/pageConfirmationAjoutMatch.controller.php?idC=<?php echo $_GET['idC']; ?>&idP=<?php echo $_GET['idP']; ?>">
						<td><input type="datetime" name="date" id="date" value="2004-10-19 10:23:54"/></td>
						<td><input type="text" name="nom1" id="nom1" /></td>
						<td><input type="text" name="nom2" id="nom2" /></td>
						<td><input type="text" name="cote1" id="cote1" size="4"/></td>
						<td><input type="text" name="coteNul" id="coteN" size="4"/></td>
						<td><input type="text" name="cote2" id="cote2" size="4"/></td>
						<td><input type="submit" value="Confirmer" /></td>
						<td></td>
						<td></td>
						<input type="hidden" name="id_phase" id="id_phase" value="<?php echo $_GET['idP']; ?>"/>
					</form>
					</table>
				</div>
			</div>
            </div>
        </div>
    </section>

	<?php include("footer.php"); ?>
	
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="../js/freelancer.min.js"></script>

</body>

</html>
