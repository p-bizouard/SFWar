<?php

	require("../../connexion.php");
	require("../include/fonction.php");
	
$pseudo = stripslashes(urldecode($_POST['pseudo']));
$pass = stripslashes($_POST['value']);
$type = stripslashes($_POST['type']);

		$reponse = mysql_query("SELECT * FROM sg_perso WHERE pseudo='$pseudo' AND pass='$pass'");
		$donnees = mysql_fetch_array($reponse);
		$race=$donnees['race'];
		
if ($race == '')
	die("Erreur");
	

	if ($type == "flotte")
		{
			echo puissance_flotte($_POST['id'], $pseudo);
		}
	elseif ($type == "planete")
		{
			echo puissance_plapla($_POST['id'], $pseudo);
		}
	else die("Erreur");

?>