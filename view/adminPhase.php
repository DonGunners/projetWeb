<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Projet Web</title>

    <link href="/assets/css/projetWeb.css" rel="stylesheet">	
	
    <!-- Bootstrap Core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="/assets/css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">


</head>

<body id="page-top" class="index">
	<!-- On récupère le menu correspondant à l'utilisateur -->
	<?php 
	if(isset($menu)){
		include($menu);
	}else{
		include('menu.php');
	}?>

	<section id="portfolio">
		<div class="container">
			<div class="row">
				<!-- Ajout d'un bouton de retour -->
				<a href="/competition"><button type="button" class="btn btn-primary">Retour</button></a>
					<div class="col-lg-12 text-center">
						<h2>Gestion Phases</h2>
						<hr class="star-primary">
						<!-- Ajout d'un bouton pour accéder au formulaire d'ajout de phase -->
						<a href="/competition/<?php echo $_GET['idC']; ?>/phase/add"><button type="button" class="btn btn-primary">Ajouter une phase</button></a><br /><br />
						<table class="table table-bordered">
							<thead>
								<tr>
								<th>Phase</th>
								<th>Matchs</th>
								<th>Modifier</th>
								<th>Supprimer</th>
								</tr>
							</thead>
							<tbody>
								<?php
								//Pour chaque phase on récupère les données et on les affiche
								while($donnees=$listePhase->fetch()){
									echo "<tr>";
									echo "<td> $donnees[libelle_phase] </td>";
									echo "<td><a href=\"/competition/";
									echo $_GET['idC'];
									echo "/phase/$donnees[id_phase]/match\"><button type=\"button\" class=\"btn btn-primary\">Matchs</button></a></td>";
									echo "<td><a href=\"/competition/";
									echo $_GET['idC'];
									echo "/phase/$donnees[id_phase]/update\"><button type=\"button\" class=\"btn btn-warning\">Modifier</button></a></td>";
									echo "<td><a href=\"/competition/";
									echo $_GET['idC'];
									echo "/phase/$donnees[id_phase]/delete\"><button type=\"button\" class=\"btn btn-danger\">Supprimer</button></a></td>";
									echo "</tr>";
								}						
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include("footer.php"); ?>

	<!-- jQuery -->
	<script src="/vendor/jquery/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>

	<!-- Plugin JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	
	<!-- Theme JavaScript -->
	<script src="/js/freelancer.min.js"></script>

</body>

</html>
