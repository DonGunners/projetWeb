<?php
try
	{
		$pseudo='postgres';
		$password='postgresql';
		$pdo = new PDO('pgsql:host=localhost;dbname=bdPronos',$pseudo,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());

	}
?>