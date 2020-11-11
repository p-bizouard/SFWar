<?
include ("../connexion.php");


mysql_connect($serveur, $utilisateur , $motDePasse)
    or die("Impossible de se connecter au serveur de bases de données.");
mysql_select_db($base)
    or die("Base de données non trouvée."); 
	
if (@$_GET['make'] == "y")
{

// Vidage des tables
mysql_query ("TRUNCATE TABLE `sg_config_carte`");
mysql_query ("TRUNCATE TABLE `sg_construction`");
mysql_query ("TRUNCATE TABLE `sg_flotte`");
mysql_query ("TRUNCATE TABLE `sg_flotte_units`");
mysql_query ("TRUNCATE TABLE `sg_planete`");
mysql_query ("TRUNCATE TABLE `sg_planete_units`");
mysql_query ("TRUNCATE TABLE `sg_ressource`");
mysql_query ("TRUNCATE TABLE `sg_mine`");

//mysql_query ("TRUNCATE TABLE `sg_guilde`");
//mysql_query ("TRUNCATE TABLE `sg_historique`");
//mysql_query ("TRUNCATE TABLE `sg_messagerie`");



	// Initialisation des variables
	$config_carte_X = "50";
	$config_carte_Y = "50";
	
	mysql_query("INSERT INTO `sg_config_carte` ( `X_max` , `Y_max`) 
				VALUES ('$config_carte_X', '$config_carte_Y')
				");	
////////////////////////////////////
	$time = time();
	
/*
	mysql_query("DELETE FROM sg_perso WHERE pseudo='tauri'");
	mysql_query("DELETE FROM sg_perso WHERE pseudo='goauld'");
	mysql_query("DELETE FROM sg_perso WHERE pseudo='ori'");
*/
	mysql_query("DELETE FROM sg_perso WHERE pseudo='neutre'");
  
/*
    mysql_query("INSERT INTO sg_perso (pseudo, pass, mail, time, ip_inscription, clan, maj, save)".
    " VALUES ('tauri', '".md5('tuwovdko')."', '', '$time', '', 'tauri', '', '1' ) ");
    mysql_query("INSERT INTO sg_perso (pseudo, pass, mail, time, ip_inscription, clan, maj, save)".
    " VALUES ('goauld', '".md5('tuwovdko')."', '', '$time', '', 'goauld', '', '1' ) ");
    mysql_query("INSERT INTO sg_perso (pseudo, pass, mail, time, ip_inscription, clan, maj, save)".
    " VALUES ('ori', '".md5('tuwovdko')."', '', '$time', '', 'ori', '', '1' ) ");
*/
    
    mysql_query("INSERT INTO sg_perso (pseudo, pass, mail, time, ip_inscription, race, clan, maj, save)".
    " VALUES ('neutre', '".md5('tuwovdko')."', '', '$time', '', 'tauri', '0', '', '1' ) ");
  
  

mysql_query("INSERT INTO `sg_planete` (`id`, `pseudo`, `nom`, `coord_X`, `coord_Y`, `race`, `clan`, `image`, `protection`) VALUES 
(47, 'neutre', 'Valhalla 1', 24, 26, 'tauri', 0, 'images/plapla_mere_1', 0),
(48, 'neutre', 'Valhalla 2', 25, 26, 'tauri', 0, 'images/plapla_mere_2', 0),
(49, 'neutre', 'Valhalla 3', 26, 26, 'tauri', 0, 'images/plapla_mere_3', 0),
(50, 'neutre', 'Valhalla 4', 24, 25, 'tauri', 0, 'images/plapla_mere_4', 0),
(51, 'neutre', 'Valhalla 5', 25, 25, 'tauri', 0, 'images/plapla_mere_5', 0),
(52, 'neutre', 'Valhalla 6', 26, 25, 'tauri', 0, 'images/plapla_mere_6', 0),
(53, 'neutre', 'Valhalla 7', 24, 24, 'tauri', 0, 'images/plapla_mere_7', 0),
(54, 'neutre', 'Valhalla 8', 25, 24, 'tauri', 0, 'images/plapla_mere_8', 0),
(55, 'neutre', 'Valhalla 9', 26, 24, 'tauri', 0, 'images/plapla_mere_9', 0);");

  
  
  
  
/*	
    $X_tauri = (int)rand((($config_carte_X-1) / 10), (($config_carte_X-1) / 2));
    $Y_tauri = (int)rand((($config_carte_Y-1) / 1.6), (($config_carte_Y-1) / 1.1));
	
	mysql_query("INSERT INTO `sg_planete` ( `id` , `pseudo` , `nom` , `coord_X` , `coord_Y` , `race`, `clan`, `image`) VALUES 
        ('', 'tauri', 'Terre', '".($X_tauri)."', '".($Y_tauri)."', 'tauri', '1',  'images/terre_3.png'),
				('', 'tauri', 'Terre', '".($X_tauri + 1)."', '".($Y_tauri)."', 'tauri', '1',  'images/terre_4.png'),
				'', 'tauri', 'Terre', '".($X_tauri)."', '".($Y_tauri + 1)."', 'tauri', '1',  'images/terre_1.png'),
				('', 'tauri', 'Terre', '".($X_tauri + 1)."', '".($Y_tauri + 1)."', 'tauri', '1',  'images/terre_2.png');
				");
			
			
	$X_goauld = (int)rand(($config_carte_X / 10), ($config_carte_X / 2.5));
    $Y_goauld = (int)rand(($config_carte_Y / 10), ($config_carte_Y / 2.5));
	
	mysql_query("INSERT INTO `sg_planete` ( `id` , `pseudo` , `nom` , `coord_X` , `coord_Y` , `race`, `clan`, `image`) VALUES 
        ('', 'goauld', 'Dakara', '".($X_goauld)."', '".($Y_goauld)."', 'goauld', '2',  'images/dakara_3.png'),
				('', 'goauld', 'Dakara', '".($X_goauld + 1)."', '".($Y_goauld)."', 'goauld', '2',  'images/dakara_4.png'),
				('', 'goauld', 'Dakara', '".($X_goauld)."', '".($Y_goauld + 1)."', 'goauld', '2',  'images/dakara_1.png'),
				('', 'goauld', 'Dakara', '".($X_goauld + 1)."', '".($Y_goauld + 1)."', 'goauld', '2',  'images/dakara_2.png');
				");

				
    $X_ori = (int)rand(($config_carte_X / 1.6), ($config_carte_X / 1.1));
    $Y_ori = (int)rand(($config_carte_Y / 10), ($config_carte_Y / 2.5));
	
	mysql_query("INSERT INTO `sg_planete` ( `id` , `pseudo` , `nom` , `coord_X` , `coord_Y` , `race`, `clan`, `image`) VALUES 
        ('', 'ori', 'Super Porte', '".($X_ori)."', '".($Y_ori)."', 'ori', '3',  'images/sporte_3.png'),
				('', 'ori', 'Super Porte', '".($X_ori + 1)."', '".($Y_ori)."', 'ori', '3',  'images/sporte_4.png'),
				('', 'ori', 'Super Porte', '".($X_ori)."', '".($Y_ori + 1)."', 'ori', '3',  'images/sporte_1.png'),
				('', 'ori', 'Super Porte', '".($X_ori + 1)."', '".($Y_ori + 1)."', 'ori', '3',  'images/sporte_2.png');
				");	
	
	*/
	
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
$end = 155520000; // 1 mois
$time = time();
$time_end = $time - $end;

$nb_inactifs = "0";

$sql = mysql_query("SELECT * FROM sg_perso WHERE time<'$time_end' OR save='false'");
while ($donnees = mysql_fetch_array($sql))
{
	$id = $donnees['id'];
	$pseudo = addslashes($donnees['pseudo']);
	mysql_query("DELETE FROM sg_perso WHERE id='$id'");
	mysql_query("DELETE FROM sg_messagerie WHERE destinataire='$pseudo' OR destinateur='$pseudo'");
	mysql_query("DELETE FROM sg_historique WHERE pseudo='$pseudo'");
	mysql_query("DELETE FROM sg_guilde WHERE leader='$pseudo'");
	$nb_inactifs++;
	
}

echo '<p>'. $nb_inactifs .' joueurs étaient inactifs</p>';
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////	




////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////
$end = 604800; // 1 semaine
$time = time();
$time_end = $time - $end;

$sql = mysql_query("SELECT * FROM sg_messagerie WHERE heure<'".$time_end."' AND type!='perso'");
while ($donnees = mysql_fetch_array($sql))
{
	$id = $donnees['id'];
	mysql_query("DELETE FROM sg_messagerie WHERE id='".$id."'");
}
echo '<p>Les messages ont été effacés correctement.</p>';
////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////	




///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


	$reponse_sg_perso = mysql_query("SELECT * FROM sg_perso WHERE pseudo!='tauri' AND pseudo!='goauld' AND pseudo!='ori'");	
	while ($donnees_sg_perso = mysql_fetch_array($reponse_sg_perso)) 
	{
		$pseudo = $donnees_sg_perso['pseudo'];
		$clan = $donnees_sg_perso['clan'];
		$race = $donnees_sg_perso['race'];
		
		mysql_query("UPDATE `sg_perso` SET maj='".time()."' WHERE pseudo='$pseudo'");
	 mysql_query("INSERT INTO sg_ressource (pseudo)".
					" VALUES ('".addslashes($pseudo)."') ")
	 or die("Erreur 102 dans l'incrémentation de vos ressources. Votre inscription n'a pas pu être validé.");

	 
	 
	mysql_query("INSERT INTO sg_construction (pseudo)".
					" VALUES ('".addslashes($pseudo)."') ")
	or die("Erreur 103 dans l'incrémentation de vos constructions. Votre inscription n'a pas pu être validé.");
	
	$message='<font color="green">Vous avez été promus aux commandes d\\\'un empire !</font>';
	$time = time();
		
	mysql_query("INSERT INTO sg_historique (pseudo, message, time)".
					" VALUES ('".addslashes($pseudo)."', '$message', '$time') ")
	or die("Erreur 104 dans l'incrémentation de votre historique. Votre inscription n'a pas pu être validé.");

	//////////////////////////////
	// On ajoute les 2 planètes //
	//////////////////////////////
	$reponse = mysql_query("SELECT X_max,Y_max FROM sg_config_carte");
	$donnees = mysql_fetch_array($reponse);
		$X_max = $donnees['X_max'];
		$Y_max = $donnees['Y_max'];
				
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
			
if ($pseudo != 'neutre') {
	  mysql_query("INSERT INTO sg_planete (pseudo, nom, coord_X, coord_Y, race, clan)".
	  " VALUES ('".addslashes($pseudo)."', '', '$X1', '$Y1', '$race', '$clan') ")
	  or die("Erreur dans l'implantation de vos planètes. Votre inscription n'a pas pu être validé.");
				
	mysql_query("INSERT INTO sg_planete (pseudo, nom, coord_X, coord_Y, race, clan)".
	" VALUES ('".addslashes($pseudo)."', '', '$X2', '$Y2', '$race', '$clan') ")
	or die("Erreur dans l'implantation de vos planètes. Votre inscription n'a pas pu être validé.");
}
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////



}
else
{
	echo '<p>Ce script va réinisialiser la base de donnée, voulez vous réèlement continuer ?</p>';
	echo '<p><a href="make.php?make=y">OUI</a></p>';
}


?>
