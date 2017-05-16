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
                <div class="col-lg-12 text-center">
                    <h2>Gestion Compétitions</h2>
                    <hr class="star-primary">

				<div class="panel panel-success">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th></th>
								<th>Nom compétition</th>
								<th>Modifier</th>
								<th>Supprimer</th>
							</tr>
						</thead>
					<?php
					while($donnees=$listeCompetition->fetch()){
						    echo "<tr>";
							echo "<td><img src=\"../image/$donnees[image_competition]\" style=\"width:20px;height:20px;\"> </td>";
							echo "<td> $donnees[nom_competition] </td>";
							echo "<td><a href=\"../controller/modifierCompetition.controller.php?id=$donnees[id_competition]\"><button type=\"button\" class=\"btn btn-primary\">Modifier</button></a></td>";
							echo "<td><a href=\"../controller/supprimerCompetition.controller.php?id=$donnees[id_competition]\"><button type=\"button\" class=\"btn btn-danger\">Supprimer</button></a></td>";
							echo "</tr>";
					}						
					?>
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
