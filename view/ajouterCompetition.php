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
	<!-- On affiche le menu correspondant à l'utilisateur -->
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
				<a href="../controller/adminPhase.controller.php?idC=<?php echo $_GET['idC'];?>"><button type="button" class="btn btn-primary">Retour</button></a>
				<div class="col-lg-12 text-center">
					<h2>Formulaire d'ajout</h2>
					<hr class="star-primary">
					<!-- Création du formulaire d'ajout de compétition -->
					<form method="post" action="../controller/pageConfirmationAjoutCompetition.controller.php">
					<p>
					<label for="nom">Nom compétition :</label><br />
					<input type="text" name="nom" id="nom" />
					<br /><br />
					<label for="image">Image compétition :</label><br />
					<input type="text" name="image" id="image" />
					<br /><br />
					<input type="submit" value="Confirmer" />
					</p>
					</form>
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

	<!-- Theme JavaScript -->
	<script src="../js/freelancer.min.js"></script>

</body>

</html>
