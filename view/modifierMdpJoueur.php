<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projet Web</title>

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
	<!-- affichage du menu correspondant à l'utilisateur -->
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
                    <h2>Formulaire modification du mot de passe</h2>
                    <hr class="star-primary">
					<!-- Création du formulaire de modification du mdp joueur -->
					<form method="post" action="/controller/pageConfirmationModificationMdpJoueur.controller.php">
						<p>
							<label for="pseudo"> Ancien mot de passe :</label><br />
							<input type="password" name="oldPassword" id="oldPassword" value=""/>
							<br />
							<br />
							<label for="pseudo"> Nouveau mot de passe :</label><br />
							<input type="password" name="password" id="password" value=""/>
							<br />
							<br />
							<label for="pseudo"> Confirmer nouveau mot de passe :</label><br />
							<input type="password" name="password2" id="password2" value=""/>
							<br />
							<br />
							<input type="hidden" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>" />
							<input type="submit" value="Confirmer" />
						</p>
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
