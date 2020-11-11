<?php

$serveur     = "localhost";
$utilisateur = "root";
$motDePasse  = "";
$base        = "stargate";


mysql_connect($serveur, $utilisateur , $motDePasse)
    or die("Impossible de se connecter au serveur de bases de données.");
mysql_select_db($base)
    or die("Base de données non trouvée."); 
?>