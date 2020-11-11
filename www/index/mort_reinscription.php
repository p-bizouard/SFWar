<?php

if (isset($_POST['pass'])
AND isset($_POST['nom_planete'])
AND isset($_POST['nom_planete2'])) {
		$pass = strip_tags(trim ($_POST['pass']));
	$nom_planete = strip_tags(trim ($_POST['nom_planete']));
	$nom_planete2 = strip_tags(trim ($_POST['nom_planete2']));
	
   if ($nom_planete==$nom_planete2) {
        $message_erreur = "Vos plan&egrave;tes doivent porter un nom diff&eacute;rent.";
   }
   
   // On v&eacute;rifie la justesse les donn&eacute;es r&eacute;cup&eacute;r&eacute;s.
   if (strlen ($nom_planete) >20) {
      $message_erreur = "Votre nom de plan&egrave;te m&egrave;re ne peut comporter que 20 caract&egrave;res.";
   } elseif ($nom_planete=="") {
      $message_erreur = "Vous devez saisir un nom de plan&egrave;te m&egrave;re";
   }

   if (strlen ($nom_planete2) >20) {
      $message_erreur = "Votre nom de plan&egrave;te secondaire ne peut comporter que 20 caract&egrave;res.";
   } elseif ($nom_planete2=="") {
      $message_erreur = "Vous devez saisir un nom de plan&egrave;te secondaire";
   }
   
	$reponse = mysql_query("SELECT pass FROM sg_perso WHERE pseudo='$pseudo'");
	$donnees = mysql_fetch_array($reponse);
	
	$pass = $donnees['pass'];
	
	if ((md5($_POST['pass'])) != $pass) {
		echo "Votre mot de passe n'est pas valide.";
		mort_reinscription();
	}
	
   mysql_query("INSERT INTO sg_ressource (pseudo)".
   " VALUES ('$pseudo') ")
   or die("Erreur 102 dans l'incr&eacute;mentation de vos ressources. Votre inscription n'a pas pu &ecirc;tre valid&eacute;.");

   mysql_query("INSERT INTO sg_construction (pseudo)".
   " VALUES ('$pseudo') ")
   or die("Erreur 103 dans l'incr&eacute;mentation de vos constructions. Votre inscription n'a pas pu &ecirc;tre valid&eacute;.");
   
   $message="Vous avez &eacute;t&eacute; promus aux commandes d\'un empire !";

   mysql_query("INSERT INTO sg_historique (pseudo, message, time)".
   " VALUES ('$pseudo', '$message', '$time') ")
   or die("Erreur 104 dans l'incr&eacute;mentation de votre historique. Votre inscription n'a pas pu &ecirc;tre valid&eacute;.");

	mysql_query("UPDATE  sg_perso SET maj='".time()."' WHERE pseudo='$pseudo'");
	
  
  $reponse = mysql_query("SELECT race, clan FROM sg_perso WHERE pseudo='$pseudo'");
	$donnees = mysql_fetch_array($reponse);
	
  $race = $donnees['race'];
  $clan = $donnees['clan'];
  
   //////////////////////////////
   // On ajoute les 2 plan&egrave;tes //
   //////////////////////////////

   // On r&eacute;cup&egrave;re la taille de la carte
   $reponse = mysql_query("SELECT X_max,Y_max FROM sg_config_carte");
   $donnees = mysql_fetch_array($reponse);
   $X_max = $donnees['X_max'];
   $Y_max = $donnees['Y_max'];
			
   // On trouve des coordonn&eacute;es al&eacute;atoires pour les plan&egrave;tes en v&eacute;rifiant que la place n'est pas d&eacute;ja prise
   do {

      $X1 = rand(0,$X_max);
      $Y1 = rand(0,$Y_max);

      $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE coord_X='$X1' AND coord_Y='$Y1'");
      $donnees = mysql_fetch_array($retour);
      $existe = $donnees['nbre_entrees'];
  } while ($existe!=0);

  do {
  $X2 = rand(0,$X_max);
    $Y2 = rand(0,$Y_max);

    $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE coord_X='$X2' AND coord_Y='$Y2'");
    $donnees = mysql_fetch_array($retour);
    $existe = $donnees['nbre_entrees'];
  } while ($existe!=0);
		
  // On ins&egrave;re les plan&egrave;tes dans la BDD
  mysql_query("INSERT INTO sg_planete (pseudo, nom, coord_X, coord_Y, clan, race)".
  " VALUES ('$pseudo', '$nom_planete', '$X1', '$Y1', '$clan', '$race') ")
  or die("Erreur dans l'implantation de vos plan&egrave;tes. Votre inscription n'a pas pu &ecirc;tre valid&eacute;.");
			
   mysql_query("INSERT INTO sg_planete (pseudo, nom, coord_X, coord_Y, clan, race)".
   " VALUES ('$pseudo', '$nom_planete2', '$X2', '$Y2', '$clan', '$race') ")
   or die("Erreur dans l'implantation de vos plan&egrave;tes. Votre inscription n'a pas pu &ecirc;tre valid&eacute;.");

   echo '<div style="width:500px;margin-left:auto;margin-right:auto;">Vous vous &ecirc;tes correctement r&eacute;inscrit. <br />Vous pouvez d&egrave;s a pr&eacute;sent reprendre le controle de votre empire.</div>';
} else {
	mort_reinscription();
}
?>