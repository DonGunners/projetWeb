<?php
require_once('../vendor/autoload.php');
require_once('../model/token.php');
require_once('../model/connexionBD.php');
use \Firebase\JWT\JWT;

//TODO: mettre dans un fichier .env
$key = "ceSera1cLEPouRPrONos";

//On vérifie que l'utilisateur n'est pas connecté pour lui afficher la page
if(!isset($_COOKIE["token"])){
	$menu="menu.php";
	include('../view/pageInscription.php');
}else{
	Header('Location:/redirection');
}
?>