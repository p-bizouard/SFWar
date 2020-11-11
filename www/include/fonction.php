<?php


function jsencode($var) {
	$var = rawurlencode($var);
	$var = str_replace("-", "%2D", $var);
	$var = str_replace('.', "%2E", $var);
	$var = str_replace("+", "%2B", $var);
	$var = str_replace("_", "%5F", $var);
	return $var;
}




function verif ($chaine,$nom_chaine,$taille) {
    if (strlen ($chaine) >$taille) {
		$message_erreur = "Votre $nom_chaine ne peut comporter que $taille caractères.";
                return ($message_erreur);
    } elseif ($chaine=="") {
             $message_erreur = "Vous devez saisir un $nom_chaine";
             return ($message_erreur);
    }
}
function print_rr($var) {	
	echo"<pre>";
	print_r($var);
	echo"</pre>";
}


///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
function puissance_flotte($id_flotte, $pseudo) {
	@include("include/units.php");
	@include("../include/units.php");
	
	$reponse2 = mysql_query("SELECT race FROM sg_perso WHERE pseudo='$pseudo'");
	$donnees2 = mysql_fetch_array($reponse2);
	$race = $donnees2['race'];
	
		$nb_spatial = count(${'liste_'.$race});
		$nb_terrestre = count(${'liste_terrestre_'.$race});
		
		for ($i=0; $i<$nb_spatial; $i++) {
			$vaisseau_type = (${'liste_'.$race}[$i]);
			$puissance_unique_vaisseau_terrestre[] = ${'vaisseaux_'.$race}[$vaisseau_type]["Puissance"];	
			$vaisseau_nombre_terrestre[$i] = "0";
		}	
		
		for ($i=0; $i <$nb_terrestre; $i++) {
			$terrestre_type = (${'liste_terrestre_'.$race}[$i]);
			$puissance_unique_terrestre_terrestre[] = ${'terrestre_'.$race}[$terrestre_type]["Puissance"];
			$terrestre_nombre_terrestre[$i] = "0";
		}	
		
		
	$reponse_sg_terrestre_units = mysql_query("SELECT * FROM sg_flotte_units WHERE id_flotte='$id_flotte'");	
	while($donnees_sg_terrestre_units = mysql_fetch_array($reponse_sg_terrestre_units)) {
			if ($donnees_sg_terrestre_units['unit'] == 'spatial') {
				$type_spatial_terrestre = $donnees_sg_terrestre_units['type'];
				$vaisseau_nombre_terrestre[$type_spatial_terrestre] = $donnees_sg_terrestre_units['nombre'];
			} else {
				$type_terrestre_terrestre = $donnees_sg_terrestre_units['type'];
				$terrestre_nombre_terrestre[$type_terrestre_terrestre] = $donnees_sg_terrestre_units['nombre'];
			}
									
	}
	$count1 = count($vaisseau_nombre_terrestre);
	$count2 = count($terrestre_nombre_terrestre);
	
	//print_rr($puissance_unique_terrestre);
	//print_rr ($vaisseau_nombre_terrestre);
	//print_rr ($terrestre_nombre_terrestre);
	
	$puissance_terrestre = "0";
	for ($i=0; $i<$count1; $i++) {
		@$puissance_terrestre = $puissance_terrestre + $vaisseau_nombre_terrestre[$i] * $puissance_unique_vaisseau_terrestre[$i];
	}
	for ($i=0; $i<$count2; $i++) {
		@$puissance_terrestre = $puissance_terrestre + $terrestre_nombre_terrestre[$i] * $puissance_unique_terrestre_terrestre[$i];
	}
	return number_format($puissance_terrestre, 0, ',', ' ');


}
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
function puissance_plapla($id_planete, $pseudo) {

	@include("include/units.php");
	@include("../include/units.php");
	
	$reponse2 = mysql_query("SELECT race FROM sg_perso WHERE pseudo='$pseudo'");
	$donnees2 = mysql_fetch_array($reponse2);
	$race = $donnees2['race'];
	
		//print_rr (${'vaisseaux_'.$race});
		//print_rr(${'liste_'.$race});
		$count = ${'liste_'.$race};
		
		
		$nb_spatial = count($count);
		
		$nb_terrestre = count(${'liste_terrestre_'.$race});	
		
		for ($i=0; $i<$nb_spatial; $i++) {
			$vaisseau_type = (${'liste_'.$race}[$i]);
			$puissance_unique_vaisseau_terrestre[] = ${'vaisseaux_'.$race}[$vaisseau_type]["Puissance"];	
			$vaisseau_nombre_terrestre[$i] = "0";
		}	
		
		
		for ($i=0; $i <$nb_terrestre; $i++) {
			$terrestre_type = (${'liste_terrestre_'.$race}[$i]);
			$puissance_unique_terrestre_terrestre[] = ${'terrestre_'.$race}[$terrestre_type]["Puissance"];
			$terrestre_nombre_terrestre[$i] = "0";
		}	
		
		
	$reponse_sg_terrestre_units = mysql_query("SELECT * FROM sg_planete_units WHERE id_planete='$id_planete'");	
	while($donnees_sg_terrestre_units = mysql_fetch_array($reponse_sg_terrestre_units)) {
			if ($donnees_sg_terrestre_units['unit'] == 'spatial') {
				$type_spatial_terrestre = $donnees_sg_terrestre_units['type'];
				$vaisseau_nombre_terrestre[$type_spatial_terrestre] = $donnees_sg_terrestre_units['nombre'];
			} else {
				$type_terrestre_terrestre = $donnees_sg_terrestre_units['type'];
				$terrestre_nombre_terrestre[$type_terrestre_terrestre] = $donnees_sg_terrestre_units['nombre'];
			}
									
	}
	$count1 = count($vaisseau_nombre_terrestre);
	$count2 = count($terrestre_nombre_terrestre);
	
	//print_rr($puissance_unique_terrestre);
	//print_rr ($vaisseau_nombre_terrestre);
	//print_rr ($terrestre_nombre_terrestre);
	
	$puissance_terrestre = "0";
	for ($i=0; $i<$count1; $i++) {
		@$puissance_terrestre = $puissance_terrestre + $vaisseau_nombre_terrestre[$i] * $puissance_unique_vaisseau_terrestre[$i];
	}
	for ($i=0; $i<$count2; $i++) {
		@$puissance_terrestre = $puissance_terrestre + $terrestre_nombre_terrestre[$i] * $puissance_unique_terrestre_terrestre[$i];
	}
	return number_format($puissance_terrestre, 0, ',', ' ');

}
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////
function quote($var) {
	$var = str_replace("'", '&amp;apos;', $var);
	$var = str_replace('"', '&amp;quot;', $var);
	$var = str_replace("&#39;", '&amp;apos;', $var);
	//$var = str_replace("\r", "<br />", $var);
	return $var;
}
function quote_big($var) {
	$var = str_replace("'", '&amp;apos;', $var);
	$var = str_replace('"', '&amp;quot;', $var);
	$var = str_replace("&#39;", '&amp;apos;', $var);
	//$var = str_replace("\r", "<br />", $var);
	return $var;
}



function detail_vaisseaux($detail, $nom) {

	//$vitesse = $detail['Vitesse'];
	//$taille = $detail['Taille'];
	//$precision = $detail['Precision'];
	$attaque_min = $detail['Attaque_min'];
	$attaque_max = $detail['Attaque_max'];
	$vie_min = $detail['Vie_min'];
	$vie_max = $detail['Vie_max'];
	//$bonus = $detail['Bonus'];
	$puissance = $detail['Puissance'];
	$description = $detail['Description'];
	$image = $detail['Image'];
	$type = $detail['Type'];

	return '<table width=250><tr><td><center><h2>'. $nom .'</h2><img alt=vaisseau width=212 src='.$image.'><br /><br /><table width=100%><tr bgcolor=#6983A3><td>Attaque :</td><td>'.$attaque_min.'-'.$attaque_max.'</td></tr><tr bgcolor=#717D8D><td>Structure :</td><td>'.$vie_min.'-'.$vie_max.'</td></tr><tr bgcolor=#6983A3><td>Puissance :</td><td>'.$puissance.'</td></tr><tr bgcolor=#717D8D><td>Type :</td><td>'.$type.'</td></tr></table><p>'.$description.'</p></center></td></tr></table>';
}
function detail_terrestre($detail2, $nom2) {

	$attaque_min = $detail2['Attaque_min'];
	$attaque_max = $detail2['Attaque_max'];
	$vie_min = $detail2['Vie_min'];
	$vie_max = $detail2['Vie_max'];
	$puissance = $detail2['Puissance'];
	$description = $detail2['Description'];
	$image = $detail2['Image'];
	$cout_pop = $detail2['Population'];
	$cout_or = $detail2['Or'];
	
	

	return '<table width=250><tr><td><center><h2>'. $nom2 .'</h2><img alt=vaisseau width=212 src='.$image.'><br /><br /><table width=100%><tr bgcolor=#6983A3><td>Attaque :</td><td>'.$attaque_min.'-'.$attaque_max.'</td></tr><tr bgcolor=#717D8D><td>Défense : </td><td>'.$vie_min.'-'.$vie_max.'</td></tr><tr bgcolor=#6983A3><td>Puissance :</td><td>'.$puissance.'</td></tr></table><p>'.$description.'</p></center></td></tr></table>';
}


function user($pseudo) {
	return $pseudo;
}


function tricheur($pseudo) {
	$time = time();
	$page = addslashes($_SERVER["REQUEST_URI"]);
	$ip = $_SERVER["REMOTE_ADDR"];
	$pseudo_s = addslashes($pseudo);
	
	mysql_query("INSERT INTO sg_triche (pseudo, ip, page, time) VALUES ('$pseudo_s','$ip', '$page', '$time')")
	or die ("<p align=center>Echec Insert</p>");
}


function historique($message, $pseudo) {
	$time = time();
	$message = addslashes($message);
	$pseudo_s = addslashes($pseudo);
	
	mysql_query("INSERT INTO sg_historique (id, message, pseudo, time) VALUES ('','$message', '$pseudo_s', '$time')")
	or die ("<p align=center>Echec Insert</p>");

}


function remplace_formulaire($var) {

	if(isset($var)) {
		$var = preg_replace('!\[b\](.+)\[/b\]!isU', '<strong>$1</strong>', $var);
		$var = preg_replace('!\[img\](.+)\[/img\]!isU', '<img class=max src=$1></img>', $var);
		$var = preg_replace('!\[center\](.+)\[/center\]!isU', '<div align=center>$1</div>', $var);
		$var = preg_replace('!\[i\](.+)\[/i\]!isU', '<em>$1</em>', $var);
		$var = preg_replace('!\[u\](.+)\[/u\]!isU', '<ins>$1</ins>', $var);
		$var = preg_replace('!\[color=(red|green|blue|yellow|purple|olive|black|orange|navy|white)\](.+)\[/color\]!isU', '<span style=color:$1>$2</span>', $var);
		$var = preg_replace('!\[size=(1|2|3|4|5|6|7|8|9)\](.+)\[/size\]!isU', '<span style=font weight: bold; font-size: 1$1px;>$2</span>', $var);
		$var = preg_replace('!\[url=(.+)\](.+)\[/url\]!iU', '<a href=$1>$2</a>', $var);
		$var = preg_replace('!\[url\](.+)\[/url\]!isU', '<a href=$1>$1</a>', $var);
		$var = preg_replace('!\[mail=(.+)\](.+)\[/mail\]!iU', '<a href=mailto:$1>$2</a>', $var);
		$var = preg_replace('!\[quote\](.+)\[/quote\]!isU', '<blockquote>$1</blockquote>', $var);
		
	}
return $var;
}




///////////////////////////////////////////////////////////////
function new_message($pseudo, $type) { // pour a coté de messages du menu

	if ($type == "tout") {
		$type = "";
	} elseif (($type == "perso") OR ($type == "rapport")) {
		$type= "type='$type' AND";
	}
	$reponse_messagerie = mysql_query("SELECT * FROM sg_messagerie WHERE ".$type." destinataire='$pseudo' AND vue='false'");	
	
	$i = "0";
	while ( $donnees_messagerie = mysql_fetch_array($reponse_messagerie)) {
		$i++;
	}
	echo " ($i)";
	
}

function player_exist($pseudo,$erreur = '') {

	// on vérifie que le joueur existe.
	$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_perso WHERE pseudo ='$pseudo'");
	$donnees = mysql_fetch_array($retour);
	$existe = $donnees['nbre_entrees'];
	
	if ($existe==0) {
		include ("index.php");
		die("Erreur $erreur");
	}
}


function clan_perso_pseudo($pseudo_joueur) {
	$reponse = mysql_query("SELECT clan FROM sg_perso WHERE pseudo='$pseudo_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['clan'];
}
function clan_flotte_pseudo($pseudo_joueur) {
	$reponse = mysql_query("SELECT clan FROM sg_flotte WHERE pseudo='$pseudo_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['clan'];
}
function clan_plapla_pseudo($pseudo_joueur) {
	$reponse = mysql_query("SELECT clan FROM sg_planete WHERE pseudo='$pseudo_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['clan'];
}
function race_perso_pseudo($pseudo_joueur) {
	$reponse = mysql_query("SELECT race FROM sg_perso WHERE pseudo='$pseudo_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['race'];
}
function race_flotte_pseudo($pseudo_joueur) {
	$reponse = mysql_query("SELECT race FROM sg_flotte WHERE pseudo='$pseudo_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['race'];
}
function race_plapla_pseudo($pseudo_joueur) {
	$reponse = mysql_query("SELECT race FROM sg_planete WHERE pseudo='$pseudo_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['race'];
}


function clan_perso_id($id_joueur) {
	$reponse = mysql_query("SELECT clan FROM sg_perso WHERE id='$id_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['clan'];
}
function clan_flotte_id($id_joueur) {
	$reponse = mysql_query("SELECT clan FROM sg_flotte WHERE id='$id_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['clan'];
}
function clan_plapla_id($id_joueur) {
	$reponse = mysql_query("SELECT clan FROM sg_planete WHERE id='$id_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['clan'];
}


function race_perso_id($id_joueur) {
	$reponse = mysql_query("SELECT race FROM sg_perso WHERE id='$id_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['race'];
}
function race_flotte_id($id_joueur) {
	$reponse = mysql_query("SELECT race FROM sg_flotte WHERE id='$id_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['race'];
}
function race_plapla_id($id_joueur) {
	$reponse = mysql_query("SELECT race FROM sg_planete WHERE id='$id_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['race'];
}

function race_id_to_name($id_race) {
  if ($id_race == 0) return "Neutre";
  elseif ($id_race == 1) return "Tauri";
  elseif ($id_race == 2) return "Goa'uld";
  elseif ($id_race == 3) return "Ori";
  elseif ($id_race == 4) return "Bsg";
  elseif ($id_race == 5) return "Cylon";
  
  else return "erreur";
}
function race_id_to_name_simple($id_race) {
  if ($id_race == 0) return "neutre";
  elseif ($id_race == 1) return "tauri";
  elseif ($id_race == 2) return "goauld";
  elseif ($id_race == 3) return "ori";
  elseif ($id_race == 4) return "bsg";
  elseif ($id_race == 5) return "cylon";
  
  else return "erreur";
}
function race_name_to_id($id_race) {
  
	if ($id_race == "neutre") return 0;
  elseif ($id_race == "tauri") return 1;
  elseif ($id_race == "goauld") return 2;
  elseif ($id_race == "ori") return 3;
  elseif ($id_race == "bsg") return 4;
  elseif ($id_race == "cylon") return 5;
  
  else return "erreur";
}
function race_name_to_name($id_race) {
  if ($id_race == "neutre") return "Neutre";
  elseif ($id_race == "tauri") return "Tauri";
  elseif ($id_race == "goauld") return "Goa'uld";
  elseif ($id_race == "ori") return "Ori";
  elseif ($id_race == "bsg") return "Bsg";
  elseif ($id_race == "cylon") return "Cylon";
  
  else return "erreur";
}

function clan_id_to_name($id) {
	
  if ($id == 0) $name = "Les Maitres du jeu";
  elseif ($id == 1) $name = "Les Seigneurs de Guerre";
  elseif ($id == 2) $name = "Les Maîtres de la Destinée";
  elseif ($id == 3) $name = "Les Guerriers de l'Humanité";
  else $name = "erreur";
	return $name;
}

function assign_planet($id_planete,$joueur) {
	mysql_query("UPDATE  sg_planete  SET pseudo='$joueur', clan='".clan_perso_pseudo($joueur)."', race='".race_perso_pseudo($joueur)."' WHERE id='$id_planete'");
	mysql_query("DELETE FROM sg_planete_units WHERE id_planete='$id_planete'");

}

function id_to_name($id_joueur) {
	$reponse = mysql_query("SELECT pseudo FROM sg_perso WHERE id='$id_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['pseudo'];
}
function name_to_id($pseudo_joueur) {
	$reponse = mysql_query("SELECT id FROM sg_perso WHERE pseudo='$pseudo_joueur'");
	$donnees = mysql_fetch_array($reponse);
	
	return $donnees['id'];
}


function verif_mort_perso($pseudo)  {


  $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_perso WHERE pseudo='$pseudo'");
  $donnees = mysql_fetch_array($retour);
  
  $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE pseudo='$pseudo'");
  $donnees = mysql_fetch_array($retour);
  $nombre_planete = $donnees['nbre_entrees'];
  
  $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE pseudo='$pseudo'");
  $donnees = mysql_fetch_array($retour);
  $nombre_flotte = $donnees['nbre_entrees'];
  
  if (($nombre_planete == $nombre_flotte) AND ($nombre_flotte == 0) AND ($donnees['nbre_entrees'] == "1")) {
    mort_perso($pseudo);
    return true;
  } else {
    return false;
  }
}
function mort_perso($pseudo)  {
	$id = name_to_id($pseudo);
	mysql_query("DELETE FROM sg_construction WHERE pseudo='$pseudo'");	
	mysql_query("DELETE FROM sg_flotte WHERE pseudo='$pseudo'");	
	mysql_query("DELETE FROM sg_flotte_units WHERE id_joueur='$id'");
	mysql_query("DELETE FROM sg_planete WHERE pseudo='$pseudo'");	
	mysql_query("DELETE FROM sg_planete_units WHERE id_joueur='$id'");	
	mysql_query("DELETE FROM sg_ressource WHERE pseudo='$pseudo'");	
}
function mort_reinscription() {

		echo '
		<div style="width:500px;margin-left:auto;margin-right:auto;"><h2 style="color:red">Vous venez de perdre votre empire.</h2>
		<p>Votre  dernièer QG est tombé aux mains énnemis. Alors que vous battez en retraite dans un refuge secret, vous voyez votre planète mère se faire envahir, votre capitale se faire bombarder. Vous perdez le reste de votre flotte, ainsi que vos technologies.</p>
		<p>Mais, malgrès la défaite, vous savez que vous avez des amis fidèles, qui vous aiderons a remonter la pente et a recréer votre armée afin de continuer le combat...</p>
		
		<br />
			<form method="POST" action="accueil.php?page=mort_reinscription">
		
    
		<p>Pour vous réinscrire, veuillez remplir les champs suivants : </p>
		
		<table class="style_table">
			<tr>
				<td>Mot de passe : </td>
				<td><input type="password" name="pass" /></td>
			</tr>
			<tr>
				<td width="">Nom de votre première planète :</td>
				<td width=""><input type="text" name="nom_planete" size="20" maxlength="20" /></td>
	    	</tr>
			<tr>
				<td width="">Nom de votre seconde planète :</td>
				<td width=""><input type="text" name="nom_planete2" size="20" maxlength="20" /></td>
	    	</tr>    	
		</table>

		<input type="submit" value="Reprendre le combat" name="submit" />
		</form>
		</div>
		';
		die();
		
}

function combat_result($pseudo, $result) {
	// $result // win // loose // equal
	
	if ($result == 'win' || $result == 'loose' || $result == 'equal') {
		mysql_query("UPDATE  sg_perso SET ".$result."=".$result."+1 WHERE pseudo='$pseudo'");
	}
}
function rapport_combat_messagerie($message, $id_pseudo, $color) {

  $time = time();
  $pseudo = addslashes($id_pseudo);
  $message = addslashes($message);
  
  mysql_query("INSERT INTO sg_messagerie (destinataire, destinateur, heure, sujet, message, type, color)".
  " VALUES ('$pseudo', '', '$time', 'Rapport de combat','$message', 'rapport', '$color') ")
  or die("Erreur.Impossible d'envoyer le rapport");
}
function rapport_mail($id_joueur, $rapport) {

  $reponse = mysql_query("SELECT mail, rapport_mail FROM sg_perso WHERE id='$id_joueur'");
	$donnees = mysql_fetch_array($reponse);
  $adresse = $donnees['mail'];
  $mail = $donnees['rapport_mail'];
  
  if ($mail) {
    $headers ='From: "Rapport de combat"<mj@sf-war.fr>'."\n";
    $headers .='Reply-To: leodi@orange.fr'."\n";
    $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
    $headers .='Content-Transfer-Encoding: 8bit';

    $message ='<html><head><title>Rapport de combat</title></head><body>'.$rapport.'</body></html>';

   mail($adresse, 'Rapport de combat', $message, $headers);
 }
}

function convert_sec ($time) {

	$output = '';
	$tab = array ('jour' => '86400', 'heure' => '3600', 'minute' => '60', 'seconde' => '1');

	foreach ($tab as $key => $value) 
		{
			$compteur = 0;
			while ($time > ($value-1)) 
				{
					$time = $time - $value;
					$compteur++;
				}
			if ($compteur != 0) 
				{
					$output .= $compteur.' '.$key;
					if ($compteur > 1) $output .= 's';
					if ($value != 1) $output .= ', ';
				}
		}
	return $output;
}

function clan_par_nb_perso() 
{
$clan = array(0 => 0, 1 => 0, 2 => 0, 3 => 0);

	$reponse = mysql_query("SELECT clan FROM sg_perso");
	while ($donnees = mysql_fetch_array($reponse)) 
		{
			$clan[$donnees['clan']]++;
		}
	unset($clan[0]);

	
	return ($clan);
}

function nb_planetes($clan) 
{
	$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE clan='$clan'");
	$donnees = mysql_fetch_array($retour);
	return($donnees['nbre_entrees']);
}

function nb_flottes($clan) 
{
	$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE clan='$clan'");
	$donnees = mysql_fetch_array($retour);
	return($donnees['nbre_entrees']);
}
function nb_race($race, $clan = '') 
{
	if (!empty($clan)) 
	{
		$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_perso WHERE race='$race' AND clan='$clan'");
	} else {
		$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_perso WHERE race='$race'");
	}
	
	$donnees = mysql_fetch_array($retour);
	return($donnees['nbre_entrees']);
}

function nb_utilisateurs_connectes() 
{
	$time = time() - 5*60;
	$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_perso WHERE maj>'$time'");
	$donnees = mysql_fetch_array($retour);
	return($donnees['nbre_entrees']);
}



?>
