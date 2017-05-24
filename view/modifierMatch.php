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
				<a href="/competition/<?php echo $_GET['idC'];?>/phase/<?php echo $_GET['idP'];?>/match"><button type="button" class="btn btn-primary">Retour</button></a>
                <div class="col-lg-12 text-center">
                    <h2>Formulaire modification</h2>
                    <hr class="star-primary">
					<form method="post" action="/controller/pageConfirmationModificationMatch.controller.php?idP=<?php echo $_GET['idP']; ?>&idC=<?php echo $_GET['idC']; ?>">
						<label for="pseudo">Date Match :</label><br />
						<input type="datetime" name="date" id="date" value="<?php echo $match[0]['date_rencontre'];?>"/><br />
						<label for="pseudo">Équipe Domicile :</label><br />
						<input type="text" name="nom1" id="nom1" value="<?php echo $match[0]['nom_equipe1'];?>"/><br />
						<label for="pseudo">Équipe Extérieur :</label><br />
						<input type="datetime" name="nom2" id="nom2" value="<?php echo $match[0]['nom_equipe2'];?>"/><br />
						<label for="pseudo">cote Équipe Domicile :</label><br />
						<input type="text" name="cote1" id="cote1" value="<?php echo $match[0]['cote_equipe1'];?>"/><br />
						<label for="pseudo">cote Match Nul :</label><br />
						<input type="datetime" name="coteN" id="coteN" value="<?php echo $match[0]['cote_nul'];?>"/><br />
						<label for="pseudo">cote Équipe Extérieur :</label><br />
						<input type="text" name="cote2" id="cote2" value="<?php echo $match[0]['cote_equipe2'];?>"/><br />
						<label for="pseudo">Résultat Match :</label><br />
						<input type="text" name="res" id="res" value="<?php echo $match[0]['resultat_rencontre'];?>"/><br />
						<input type="hidden" name="id_rencontre" id="id_rencontre" value="<?php echo $_GET['idM']; ?>"/>
						<input type="submit" value="Confirmer" />
					</form>
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
