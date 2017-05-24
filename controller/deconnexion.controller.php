<?php
	// Suppression du cookie
	setcookie('token', '', time()-10000000, '/');
	// Unset cookie 
	unset($_COOKIE["token"]);
	header('Location:/accueil');
?>
