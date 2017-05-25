<?php

	function verificationToken($decoded_array){
	//donnée : un token déjà decodé
	//résultat : true si le token est valide, else sinon
		$roles= array("joueur", "admin");
		return $decoded_array['iss']==$_SERVER['HTTP_HOST'] && $decoded_array['exp'] > time() && !empty($decoded_array['id']) && in_array($decoded_array['role'],$roles);
  }

?>
