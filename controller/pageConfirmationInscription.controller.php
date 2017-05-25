<?php
require_once('../vendor/autoload.php');
require_once('../model/token.php');
require_once('../model/connexionBD.php');
use \Firebase\JWT\JWT;

//TODO: mettre dans un fichier .env
$key = "ceSera1cLEPouRPrONos";

//On vérifie que l'utilisateur n'est pas connecté
if(!isset($_COOKIE["token"])){
	$menu="menu.php";
	//On affiche la page de confirmation d'inscription
	include('Location:/inscription/confirmation');
}else{
	//Sinon on le redirige vers l'accueil
	Header('Location:/redirection');
}
?>