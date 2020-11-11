<?
 
if (isset($_POST['pseudo'])
	AND isset($_POST['pass'])
	AND isset($_POST['passconf'])
	AND isset($_POST['emailconf'])
	AND isset($_POST['email'])
	AND isset($_POST['emailconf'])
	AND isset($_POST['nom_planete'])
	AND isset($_POST['nom_planete2'])
	AND isset($_POST['race'])
	AND isset($_POST['clan'])
	AND (@$_POST['clan'] == '1')
	OR (@$_POST['clan'] == '2')
	OR (@$_POST['clan'] == '3')
	OR (@$_POST['clan'] == '4')
	AND ($_POST['race'] == 'tauri')
	OR (@$_POST['race'] == 'goauld')
	OR (@$_POST['race'] == 'ori')
	OR (@$_POST['race'] == 'bsg')
	OR (@$_POST['race'] == 'cylon')
) {

   //////////////////////////////////////////////////
   // On r&eacute;cup&egrave;re les donn&eacute;es
   // On enl&egrave;ve les espace (trim)
   // On enl&egrave;ve les balies html (strip_tags)
   //////////////////////////////////////////////////
   $pseudo = strip_tags(trim ($_POST['pseudo']));
   $pass = strip_tags(trim ($_POST['pass']));
   $pass2 = strip_tags(trim ($_POST['passconf']));
   $mail = strip_tags(trim ($_POST['email']));
   $mail2 = strip_tags(trim ($_POST['emailconf']));
   $clan = strip_tags(trim ($_POST['clan']));
   $nom_planete = strip_tags(trim ($_POST['nom_planete']));
   $nom_planete2 = strip_tags(trim ($_POST['nom_planete2']));
   $race = strip_tags(trim ($_POST['race']));
   $clan = strip_tags(trim ($_POST['clan']));

   if ($clan == 4)
		{
			$clan = clan_par_nb_perso();
			arsort($clan);
			
				for ($i = 0; $i < count($clan); $i++)
				{
					if ($i == 2)
						$clan =  key($clan);
					else
						next($clan);
				}
		}
		
	// En cas d'erreur on fixe le titre de l'erreur
   $titre_erreur= "Erreur dans l'inscription de votre profil";

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

   if (strlen ($mail) >50) {
      $message_erreur = "Votre e-mail ne peut comporter que 50 caract&egrave;res.";
   } elseif ($mail=="") {
      $message_erreur = "Vous devez saisir une adresse e-mail";
   }

   if (strlen ($pass) >20) {
      $message_erreur = "Votre mot de passe ne peut comporter que 20 caract&egrave;res.";
   } elseif ($pass=="") {
      $message_erreur = "Vous devez saisir un mot de passe";
   }

   if (strlen ($pseudo) >20) {
      $message_erreur = "Votre pseudo ne peut comporter que 20 caract&egrave;res.";
   } elseif ($pseudo=="") {
      $message_erreur = "Vous devez saisir un pseudo";
   }

   if ($pass2!=$pass) {// confirmation du pass erron&eacute;e
      $message_erreur ="Vous vous &ecirc;tes tromp&eacute; dans la v&eacute;rification de votre mot de passe. Merci de r&eacute;essayer.";						
      
   }

   if ($mail2!=$mail) {// confirmation du pass erron&eacute;e
      $message_erreur ="Vous vous &ecirc;tes tromp&eacute; dans la v&eacute;rification de votre e-mail. Merci de r&eacute;essayer.";							
   }

   ////////////////////////////////////////////
   // On v&eacute;rifie l'existence des plan&egrave;tes    //
   ////////////////////////////////////////////
   $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE nom='$nom_planete'");
   $donnees = mysql_fetch_array($retour);
   $nombre_planete = $donnees['nbre_entrees'];
   
   if ($nombre_planete !=0) 
   	$message_erreur = '<p>Le nom de votre premi&egrave;re plan&egrave;te existe d&eacute;ja .</p><p><form><input type="button" value="Retour" onClick="history.back()"></form></p>';
   
   $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE nom='$nom_planete2'");
   $donnees = mysql_fetch_array($retour);
   $nombre_planete2 = $donnees['nbre_entrees'];
   
   if ($nombre_planete2 !=0)  $message_erreur = "Le nom de votre deuxi&egrave;me plan&egrave;te existe d&eacute;ja.";
   

   ///////////////////////////////////////////////
   // On v&eacute;rifie que le joueur n'existe pas     //
   ////////////////////////////////////////////////////////////////////////////////////////////////////
   $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_perso WHERE pseudo='$pseudo'");    //
   $donnees = mysql_fetch_array($retour);                                                            //							
   $existe = $donnees['nbre_entrees'];					                             //
   ////////////////////////////////////////////////////////////////////////////////////////////////////
   if ($existe!=0) {
      $message_erreur = "Ce pseudo existe d&eacute;ja.";
   }

   if (isset($message_erreur)) {
      include ("index/erreur.php");
   } else {

   // On code le mot de pass
   $pass = md5 ($pass);

   // On rel&egrave;ve l'heure
   $time = time();

   // On r&eacute;cup&egrave;re l'ip du joueur
   $ip = $_SERVER["REMOTE_ADDR"];

   // On cr&eacute; le joueur
   mysql_query("INSERT INTO sg_perso (pseudo, pass, mail, time, ip_inscription, clan, race, maj)".
   " VALUES ('$pseudo', '$pass', '$mail', '$time', '$ip', '$clan', '$race', '$time' ) ")
   or die("Erreur 101 dans l'incr&eacute;mentation de votre personnage. Votre inscription n'a pas pu &ecirc;tre valid&eacute;.");
				
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

   //////////////////////////////
   // On ajoute les 2 plan&egrave;tes //
   //////////////////////////////

   // On r&eacute;cup&egrave;re la taille de la carte
   $reponse = mysql_query("SELECT X_max,Y_max FROM sg_config_carte");
   $donnees = mysql_fetch_array($reponse);
   $X_max = $donnees['X_max']-1;
   $Y_max = $donnees['Y_max']-1;
			
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

   ?>

<p>Vous vous &ecirc;tes correctement inscrit. Vous pouvez d&egrave;s maintenant prendre le contr&ocirc;le de votre empire en vous connectant &agrave; votre compte via le formulaire de gauche.</p>

  <?

   }

} else {
	?>
	<form method="post" action="index.php?page=inscription">
	
	<p>Veuillez remplir le champs suivants : </p>
	
	<table class="style_table">
    	<tr bgcolor="#6983A3">
			<td>Pseudo : </td>
			<td><input type="text" name="pseudo" size="30" maxlength="20" /></td>
			<td>&nbsp;</td>
		</tr>
		<tr bgcolor="#717D8D">
			<td>Mot de passe : </td>
			<td><input type="password" name="pass" size="30" /></td>
			<td>&nbsp;</td>
		</tr>
		<tr bgcolor="#6983A3">
			<td>Confirmation : </td>
			<td><input type="password" name="passconf" size="30" /></td>
			<td>&nbsp;</td>
		</tr>
		<tr bgcolor="#717D8D">
			<td>Email : </td>
			<td><input type="text" name="email" size="30" maxlength="50" /></td>
			<td>&nbsp;</td>
		</tr>
		<tr bgcolor="#6983A3">
			<td style="width:">Confirmation :</td>
			<td style="width:"><input type="text" name="emailconf" size="30" maxlength="50" /></td>
			<td>&nbsp;</td>
    	</tr>
		<tr bgcolor="#717D8D">
			<td style="width:">Nom de votre premi&egrave;re plan&egrave;te :</td>
			<td style="width:"><input type="text" name="nom_planete" size="30" maxlength="20" /></td>
			<td>&nbsp;</td>
    	</tr>
		<tr bgcolor="#6983A3">
			<td style="width:">Nom de votre seconde plan&egrave;te :</td>
			<td style="width:"><input type="text" name="nom_planete2" size="30" maxlength="20" /></td>
			<td>&nbsp;</td>
    	</tr>  	
		<tr>
			<td style="width:">&nbsp;</td>
			<td style="width:">&nbsp;</td>
			<td style="font-size:10px;"></td>
    </tr>  	
		<tr bgcolor="#6983A3">
			<td style="width:">Clan :</td>
			<td style="width:"><label><input type="radio" value="4" name="clan">Je ne sais pas</label></td>
			<td style="font-size:10px;"><small>Choix encourag&eacute;.</small></td>
    </tr>
		<tr bgcolor="#717D8D">
			<td style="width:">&nbsp;</td>
			<td style="width:"><label><input type="radio" value="1" checked name="clan">Les Seigneurs de Guerre</label></td>
			<td style="font-size:10px;">&nbsp;</td>
    </tr>
		<tr bgcolor="#6983A3">
			<td style="width:">&nbsp;</td>
			<td style="width:"><label><input type="radio" value="2" name="clan">Les Ma&icirc;tres de la Destin&eacute;e</label></td>
			<td style="font-size:10px;">&nbsp;</td>
    </tr>  	
		<tr bgcolor="#717D8D">
			<td style="width:">&nbsp;</td>
			<td style="width:"><label><input type="radio" value="3" name="clan">Les Guerriers de l'Humanit&eacute;</label></td>
			<td style="font-size:10px;">&nbsp;</td>
    </tr>  	
		<tr>
			<td style="width:">&nbsp;</td>
			<td style="width:"></td>
			<td style="font-size:10px;"></td>
    </tr>
		<tr bgcolor="#6983A3">
			<td style="width:">Race :</td>
			<td style="width:"><label><input type="radio" value="tauri" checked name="race">Tauri</label></td>
			<td style="font-size:10px;">Univers de Stargate, il s'agit de l'alliance form&eacute;e entre les terriens, les asgards et la Tokra.</td>
    </tr>
		<tr bgcolor="#717D8D">
			<td style="width:">&nbsp;</td>
			<td style="width:"><label><input type="radio" value="goauld" name="race">Goa'uld</label></td>
			<td style="font-size:10px;">Univers de Stargate, il s'agit de parasites ayant pris possession d'&ecirc;tres humains.</td>
    </tr>
		<tr bgcolor="#6983A3">
			<td style="width:">&nbsp;</td>
			<td style="width:"><label><input type="radio" value="ori" name="race">Ori</label></td>
			<td style="font-size:10px;">Univers Stargate, il s'agit d'un peuple venu d'une autre galaxie et voulant imposer leur religion.</td>
    </tr>
		<tr bgcolor="#717D8D">
			<td style="width:">&nbsp;</td>
			<td style="width:"><label><input type="radio" value="bsg" name="race">BSG</label></td>
			<td style="font-size:10px;">Univers Battlestar Galactica, ce sont les survivants terriens. Ils cherchent la terre afin de sauver leur race.</td>
    </tr>
		<tr bgcolor="#6983A3">
			<td style="width:">&nbsp;</td>
			<td style="width:"><label><input type="radio" value="cylon" name="race">Cylon</label></td>
			<td style="font-size:10px;">Univers Battlestar Galactica, cr&eacute;&eacute;s par les humains, ils se sont rebell&eacute;s, et ont &eacute;volu&eacute;s. Ils sont eux aussi &agrave; la recherche de la terre.</td>
    </tr>  
</table>
<br />
	<input type="submit" value="Continuer" name="submit" />
	
	</form>
	<?php	
}
?>
