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
                    <h2>Pronostics</h2>
                    <hr class="star-primary">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead style="background-color: #5CB85C";>
							<tr>
								<th>Compétition</th>
								<th colspan="3">Match/cotes</th>
								<th>Pronostic</th>
								<th></th>
							</tr>
						</thead>
					<?php
					while($donnees=$listePronos->fetch()){
						    echo "<tr>";
							echo "<td rowspan=\"2\"> $donnees[nom_competition] <br /> $donnees[libelle_phase] <br /> $donnees[date_rencontre]</td>";
							echo "<td colspan=\"3\"> $donnees[nom_equipe1] - $donnees[nom_equipe2]</td>";
							echo "<td rowspan=\"2\"><select name=\"resultat$donnees[id_rencontre]\" id=\"resultat$donnees[id_rencontre]\" onchange=\"prono($donnees[id_rencontre]);\"><option value=\"1\">$donnees[nom_equipe1]</option><option value=\"N\">Nul</option><option value=\"2\">$donnees[nom_equipe2]</option></select></td>";
							echo "<td rowspan=\"2\"><a id=\"test$donnees[id_rencontre]\"href=\"../controller/setProno.controller.php?idM=$donnees[id_rencontre]&Res=1\"><input id=\"submitter\" type=\"submit\" value=\"Confirmer\" /></a></td>";
							echo "</tr>";
							echo "<tr>";
							echo "<td> $donnees[cote_equipe1] </td>";
							echo "<td> $donnees[cote_nul] </td>";
							echo "<td> $donnees[cote_equipe2] </td>";
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
	
	<script src="../js/projetweb.js"></script>
	
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
