<?php
    //Si un utilisateur n'est pas connecté
    if (!isset($_COOKIE["token"])){
      include('../view/pageConfirmationInscription.php');
    }
    else{
      include('redirection.php');
    }
  ?>
