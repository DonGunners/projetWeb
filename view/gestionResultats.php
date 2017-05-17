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
                    <h2>Gestion Résultats</h2>
                    <hr class="star-primary">
					<p>Liste des matchs en attente de résultats</p>
				<div class="panel panel-success">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Compétition</th>
								<th>Phase</th>
								<th>Match</th>
								<th>Date</th>
								<th>Résultat</th>
								<th></th>
							</tr>
						</thead>
					<?php
					$var="1";
					while($donnees=$listeMatch->fetch()){
						    echo "<tr>";
							echo "<td>$donnees[nom_competition]</td>";
							echo "<td>$donnees[libelle_phase]</td>";
							echo "<td>$donnees[match]</td>";
							echo "<td>$donnees[date_match]</td>";
							echo "<td><select name=\"resultat\" id=\"resultat\" onchange=\"res();\"><option value=\"1\">$donnees[nom_equipe1]</option><option value=\"N\">Nul</option><option value=\"2\">$donnees[nom_equipe2]</option></select></td>";
							echo "<td><input id=\"submitter\" type=\"submit\" value=\"\" /></td>";
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
	
	<script type="text/javascript">
		function res()
		{document.getElementById("submitter").value=resultat.options[resultat.selectedIndex].value;}
	</script>
	
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
