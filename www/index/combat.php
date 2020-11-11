<?
require_once("include/units.php");
require_once("include/fonction_combat.php");

if (isset($_POST['flotte']) && isset($_POST['adversaire']))
{
$id_flotte =$_POST['flotte'];
$id_adversaire =$_POST['adversaire'];

  $sqll = "SELECT * FROM sg_flotte WHERE id='$id_flotte'";	
  $query = mysql_query($sqll);
  $donnees = mysql_fetch_array($query);
  $nom_flotte = $donnees['nom'];
  $X = $donnees['coord_X'];
  $Y = $donnees['coord_Y'];
  $clan= $donnees['clan'];

  $sqll = "SELECT * FROM sg_flotte WHERE id='$id_adversaire'";	
  $query = mysql_query($sqll);
  $donnees = mysql_fetch_array($query);
  $nom_flotte_ennemi = $donnees['nom'];
  $pseudo_ennemi = $donnees['pseudo'];
  $X_ennemi = $donnees['coord_X'];
  $Y_ennemi = $donnees['coord_Y'];
  $clan_ennemi= $donnees['clan'];
  
  if ($clan==$clan_ennemi) {
     die ("Erreur 1043");
  } elseif ($X_ennemi>$X+1 or $X_ennemi<$X-1 or $Y_ennemi>$Y+1 or $Y_ennemi<$Y-1) {
    die ("Erreur 1044");
  }
$test = verif_protection ($pseudo_ennemi, $id_joueur);
if ($test > 0)
  {
    $titre_erreur = "Combat";
    $message_erreur = "Votre ennemi est actuellement intouchable.";
    include ("index/erreur_bis.php");
    die();
  }

  //if $nombre>=1  {
//	  $message_erreur="Impossible d'attaquer une plan&egrave;te avec une flotte en orbite";
} else die ("Erreur 1045.");

// V&eacute;rificaton puissance
// V&eacute;rificaton puissance
if ((puissance_flotte($id_flotte, $pseudo, true) > ((3*puissance_flotte($id_adversaire, $pseudo_ennemi, true)/5) + puissance_flotte($id_adversaire, $pseudo_ennemi, true))) AND (puissance_flotte($id_adversaire, $pseudo_ennemi, true) != 0)) {
	$message_erreur="Impossible d'attaquer une flotte n'ayant pas au moins les 3/5 de votre puissance (".number_format(puissance_flotte($id_adversaire, $pseudo_ennemi, true), 0, ',', ' ') ."pour votre ennemi contre ". number_format(((3*puissance_flotte($id_adversaire, $pseudo_ennemi, true)/5) + puissance_flotte($id_adversaire, $pseudo_ennemi, true)), 0, ',', ' ')." au maximum pour vous.";
	include ("index/erreur.php");
} else {

	// Si on le met pas l&agrave;, alors on a 2 barres Tete.png lorsqu'on inclut le erreur.php
?>

<table border="0" cellpadding="0" cellspacing="0" height="50" width="570">
<tr>
	<td class="Ttexte" align="left" background="images/Tete.png" valign="middle"><? echo $titre; ?></td>
	</tr>
</table>

<?
// On r&eacute;cup&egrave;re toutes les variables
$id_attaquant = $_POST['flotte'];
$id_defenseur = $_POST['adversaire'];


$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte_units WHERE id_flotte='$id_attaquant'  AND unit='spatial'");
$donnees = mysql_fetch_array($retour);
$nombre_attaquant = $donnees['nbre_entrees'];

$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte_units WHERE id_flotte='$id_defenseur' AND unit='spatial'");
$donnees = mysql_fetch_array($retour);
$nombre_defenseur = $donnees['nbre_entrees'];

/////////////////////////////////////////////////////////

$reponse = mysql_query("SELECT * FROM sg_flotte WHERE id='$id_attaquant'");
$donnees = mysql_fetch_array($reponse);
$race_attaquant = race_name_to_id($donnees['race']);



$reponse = mysql_query("SELECT * FROM sg_flotte WHERE id='$id_defenseur'");
$donnees = mysql_fetch_array($reponse);
$race_defenseur = race_name_to_id($donnees['race']);

/////////////////////////////////////////////////




$combat_rapport_attaquant = "<br />".'<font color="#6983A3"><b>Votre flotte '.$type.' '. $nom_flotte .' attaque la flotte ' . $nom_flotte_ennemi.".</b></font><br /><br />";
$combat_rapport_defenseur = "<br />".'<font color="#6983A3"><b>Votre flotte '. $nom_flotte_ennemi .' est attaqu&eacute;e par la flotte ' . $nom_flotte.".</b></font><br /><br />";
  






// On v&eacute;rifie que la flotte attaquante n'est pas vide...
if ($nombre_attaquant==0) {
	?>
		<p><font color="#6983A3"><b>Vous devez poss&eacute;der des unit&eacute;s spatials pour attaquer une flotte !</b></font></p>
	<?
} elseif ($nombre_defenseur==0) {// on v&eacute;rifie que la flotte de d&eacute;fense n'est pas vide...

  $combat_rapport_attaquant .= '<font color="#6983A3"><b>La flotte adverse n\'avait pas de quoi vous affronter ! Vous detruisez la flotte'. $nom_flotte_ennemi. '.</b></font><br />';
  $combat_rapport_defenseur .= '<font color="#6983A3"><b>Vous ne possediez aucune defence sur place. Vous perdez votre planete '. $nom_flotte_ennemi. '.</b></font><br />';

		mysql_query("DELETE FROM sg_flotte WHERE id='$id_defenseur'");
		mysql_query("DELETE FROM sg_flotte_units WHERE id_flotte='$id_defenseur'");

  historique($combat_rapport_attaquant, $pseudo);
  historique($combat_rapport_defenseur, $pseudo_ennemi);

  combat_result($pseudo, 'win');
  combat_result($pseudo_ennemi, 'loose');

	       add_protection ($pseudo_ennemi, $id_joueur, 0);

  rapport_combat_messagerie($combat_rapport_attaquant, $pseudo, "green");
  rapport_combat_messagerie($combat_rapport_defenseur, $pseudo_ennemi, "red");

  rapport_mail(name_to_id($pseudo), $combat_rapport_attaquant);
  rapport_mail(name_to_id($pseudo_ennemi), $combat_rapport_defenseur);

  echo $combat_rapport_attaquant;

} else {// on g&egrave;re le combat
	$reponse = mysql_query("SELECT * FROM sg_flotte_units WHERE id_flotte='$id_attaquant'  AND `nombre`!='0' AND unit='spatial'");
		
  while ($donnees = mysql_fetch_array($reponse)) {
	  $type_vaisseau_attaquant[0][] = $donnees['type'];
		$nombre_vaisseau_attaquant[0][] = $donnees['nombre'];
    $nombre_vaisseau_attaquant_debut[0][] = $donnees['nombre'];
  } 
	
	$reponse = mysql_query("SELECT * FROM sg_flotte_units WHERE id_flotte='$id_defenseur' AND `nombre`!='0' AND unit='spatial'");
		
	while ($donnees = mysql_fetch_array($reponse)) {								
	  $type_vaisseau_defenseur[0][] = $donnees['type'];
		$nombre_vaisseau_defenseur[0][] = $donnees['nombre'];
    $nombre_vaisseau_defenseur_debut[0][] = $donnees['nombre'];
	   } 


		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
for ($vague = 0; $vague < 2; $vague++) {



$taille_flotte_attaquant[$vague] = taille_flotte($type_vaisseau_attaquant[$vague],$nombre_vaisseau_attaquant[$vague]);
$taille_flotte_defenseur[$vague] = taille_flotte($type_vaisseau_defenseur[$vague],$nombre_vaisseau_defenseur[$vague]);



/// CALCULE POUR L'ATTAQUANT
// $nb_vaisseau_attaque
for ($attaquant=0; $attaquant< count($type_vaisseau_attaquant[$vague]); $attaquant++) {
	$somme = 0;
	for ($defenseur=0; $defenseur< count($type_vaisseau_defenseur[$vague])-1; $defenseur++) {// <-1 <=> <= -2
	
		$nb_vaisseau_attaque[$vague][$attaquant][$defenseur] =  ceil((taille_vaisseau ($type_vaisseau_defenseur[$vague][$defenseur],$nombre_vaisseau_defenseur[$vague][$defenseur])/$taille_flotte_defenseur[$vague])*$nombre_vaisseau_attaquant[$vague][$attaquant]);
		
		if (($nb_vaisseau_attaque[$vague][$attaquant][$defenseur]+$somme)>$nombre_vaisseau_attaquant[$vague][$attaquant])
			$nb_vaisseau_attaque[$vague][$attaquant][$defenseur]=$nombre_vaisseau_attaquant[$vague][$attaquant] - $nb_vaisseau_attaque[$vague][$attaquant][$defenseur];
		
		$somme += $nb_vaisseau_attaque[$vague][$attaquant][$defenseur];
	}
	$nb_vaisseau_attaque[$vague][$attaquant][count($type_vaisseau_defenseur[$vague])-1]= $nombre_vaisseau_attaquant[$vague][$attaquant] - $somme;
}
//print_rr($nb_vaisseau_attaque);



// $degat_attaquant
for ($attaquant= 0; $attaquant < count($type_vaisseau_attaquant[$vague]); $attaquant++) {

	$degat_aleatoire[$vague][$attaquant] = attaque_aleatoire($type_vaisseau_attaquant[$vague][$attaquant]);
	
	for ($defenseur=0; $defenseur < count($type_vaisseau_defenseur[$vague]); $defenseur++) {
  
		$degat_attaquant[$vague][$attaquant][$defenseur] = $nb_vaisseau_attaque[$vague][$attaquant][$defenseur] * $degat_aleatoire[$vague][$attaquant];
		if (preg_match(','.$type_vaisseau_defenseur[$vague][$defenseur].',', $bonus_spatial[$type_vaisseau_attaquant[$vague][$attaquant]])=== 1) 
			$degat_attaquant[$vague][$attaquant][$defenseur]*=2;

	}
}


//print_rr($degat_attaquant);




// $nb_vaisseaux_defenseur_restants et $nb_vaisseaux_defenseur_tues
for ($attaquant = 0; $attaquant < count($type_vaisseau_attaquant[$vague]); $attaquant++) {

  for ($defenseur=0; $defenseur < count($type_vaisseau_defenseur[$vague]); $defenseur++) {

    if (!isset($vie_aleatoire[$vague][$defenseur])) $vie_aleatoire[$vague][$defenseur] = vie_aleatoire($type_vaisseau_defenseur[$vague][$defenseur]);
	if (!isset($nb_vaisseaux_defenseur_restants[$vague][$defenseur])) $nb_vaisseaux_defenseur_restants[$vague][$defenseur] = $nombre_vaisseau_defenseur[$vague][$defenseur];
    
	// Si le nombre de d&eacute;fenseur tu&eacute; est plus grand que le nombre de d&eacute;fenseur restant : alors... sinon
	if (floor($degat_attaquant[$vague][$attaquant][$defenseur]/ $vie_aleatoire[$vague][$defenseur]) > $nb_vaisseaux_defenseur_restants[$vague][$defenseur]) 
		$nb_vaisseaux_defenseur_tues[$vague][$attaquant][$defenseur] = $nb_vaisseaux_defenseur_restants[$vague][$defenseur];
	else 
		$nb_vaisseaux_defenseur_tues[$vague][$attaquant][$defenseur] = floor($degat_attaquant[$vague][$attaquant][$defenseur]/ $vie_aleatoire[$vague][$defenseur]);
		
		
    $nb_vaisseaux_defenseur_restants[$vague][$defenseur] -= $nb_vaisseaux_defenseur_tues[$vague][$attaquant][$defenseur];
  }
}
 //print_rr($nb_vaisseaux_defenseur_restants);




/// CALCULE POUR L'defenseur
// $nb_vaisseau_defense
for ($defenseur=0; $defenseur< count($type_vaisseau_defenseur[$vague]); $defenseur++) {
	$somme = 0;
	for ($attaquant=0; $attaquant< count($type_vaisseau_attaquant[$vague])-1; $attaquant++) {// <-1 <=> <= -2
	
		$nb_vaisseau_defense[$vague][$defenseur][$attaquant] =  ceil((taille_vaisseau ($type_vaisseau_attaquant[$vague][$attaquant],$nombre_vaisseau_attaquant[$vague][$attaquant])/$taille_flotte_attaquant[$vague])*$nombre_vaisseau_defenseur[$vague][$defenseur]);
		
		if (($nb_vaisseau_defense[$vague][$defenseur][$attaquant]+$somme)>$nombre_vaisseau_defenseur[$vague][$defenseur])
			$nb_vaisseau_defense[$vague][$defenseur][$attaquant]=$nombre_vaisseau_defenseur[$vague][$defenseur] - $nb_vaisseau_defense[$vague][$defenseur][$attaquant];
		
		$somme += $nb_vaisseau_defense[$vague][$defenseur][$attaquant];
	}
	$nb_vaisseau_defense[$vague][$defenseur][count($type_vaisseau_attaquant[$vague])-1]= $nombre_vaisseau_defenseur[$vague][$defenseur] - $somme;
}

//print_rr(	$nb_vaisseau_defense);

// $degat_defenseur
for ($defenseur= 0; $defenseur < count($type_vaisseau_defenseur[$vague]); $defenseur++) {

	$degat_aleatoire[$vague][$defenseur] = attaque_aleatoire($type_vaisseau_defenseur[$vague][$defenseur]);
	
	for ($attaquant=0; $attaquant < count($type_vaisseau_attaquant[$vague]); $attaquant++) {
  
		$degat_defenseur[$vague][$defenseur][$attaquant] = $nb_vaisseau_defense[$vague][$defenseur][$attaquant] * $degat_aleatoire[$vague][$defenseur];
		if (preg_match(','.$type_vaisseau_attaquant[$vague][$attaquant].',', $bonus_spatial[$type_vaisseau_defenseur[$vague][$defenseur]])=== 1) 
			$degat_defenseur[$vague][$defenseur][$attaquant]*=2;

	}
}






// $nb_vaisseaux_attaquant_restants et $nb_vaisseaux_attaquant_tues
for ($defenseur = 0; $defenseur < count($type_vaisseau_defenseur[$vague]); $defenseur++) {

  for ($attaquant=0; $attaquant < count($type_vaisseau_attaquant[$vague]); $attaquant++) {

    if (!isset($vie_aleatoire[$vague][$attaquant])) $vie_aleatoire[$vague][$attaquant] = vie_aleatoire($type_vaisseau_attaquant[$vague][$attaquant]);
	if (!isset($nb_vaisseaux_attaquant_restants[$vague][$attaquant])) $nb_vaisseaux_attaquant_restants[$vague][$attaquant] = $nombre_vaisseau_attaquant[$vague][$attaquant];
    
	// Si le nombre de d&eacute;fenseur tu&eacute; est plus grand que le nombre de d&eacute;fenseur restant : alors... sinon
	if (floor($degat_defenseur[$vague][$defenseur][$attaquant]/ $vie_aleatoire[$vague][$attaquant]) > $nb_vaisseaux_attaquant_restants[$vague][$attaquant]) 
		$nb_vaisseaux_attaquant_tues[$vague][$defenseur][$attaquant] = $nb_vaisseaux_attaquant_restants[$vague][$attaquant];
	else 
		$nb_vaisseaux_attaquant_tues[$vague][$defenseur][$attaquant] = floor($degat_defenseur[$vague][$defenseur][$attaquant]/ $vie_aleatoire[$vague][$attaquant]);
		
		
    $nb_vaisseaux_attaquant_restants[$vague][$attaquant] -= $nb_vaisseaux_attaquant_tues[$vague][$defenseur][$attaquant];
  }
}

	if ($vague == 0) {
		type_et_nombre_vaisseaux_restants($nb_vaisseaux_attaquant_restants, $nb_vaisseaux_defenseur_restants);
	}

}   // Fin du for pour les vagues
// TESTs
/*
-v&eacute;rifier nb vaisseau defenseut tue est inf&eacute;rieur au nombre total de vaisseaux
- v&eacute;rifier qu'il reste des vaisseaux du type cible avant de calculer le nombre de defenseur tu&eacute; et &ecirc;tre capable d'ifentifier une vague qui se trompe cmme une merde.

*/

//print_rr($type_vaisseau_attaquant);

rapport_combat($vie_aleatoire, $degat_aleatoire, $type_vaisseau_attaquant, $type_vaisseau_defenseur, $nombre_vaisseau_attaquant, $nombre_vaisseau_defenseur, $nb_vaisseau_attaque, $nb_vaisseau_defense, $nb_vaisseau_attaque,$nb_vaisseau_defense, $nb_vaisseaux_defenseur_tues, $nb_vaisseaux_attaquant_tues, $nb_vaisseaux_attaquant_restants, $nb_vaisseaux_defenseur_restants) ;



	// On regarde si une des 2 flotte est morte
	global $puissance_perdue_attaquant;
	global $puissance_perdue_defenseur;
	
	$nb_vaisseaux_total_attaquant_restant=0;
	$nb_vaisseaux_total_defenseur_restant=0;

	$puissance_perdue_attaquant = 0;
	$puissance_perdue_defenseur = 0;
	
	
	$nb_vagues = count($type_vaisseau_attaquant);
	
		for ($i=0; $i < count($nb_vaisseaux_attaquant_restants[$nb_vagues-1]) ; $i++) 
			{
		    $nb_vaisseaux_total_attaquant_restant+= $nb_vaisseaux_attaquant_restants[$nb_vagues-1][$i];
			
		    $nb_vaisseaux_perdus_attaquant = $nombre_vaisseau_attaquant[0][$i] - $nb_vaisseaux_attaquant_restants[$nb_vagues-1][$i];
			
		    $puissance_perdue_attaquant += $nb_vaisseaux_perdus_attaquant * $vaisseaux[$type_vaisseau_attaquant[$nb_vagues-1][$i]]['Puissance'];
				

				mysql_query("UPDATE  sg_flotte_units  SET nombre='".$nb_vaisseaux_attaquant_restants[$nb_vagues-1][$i]."' WHERE id_flotte='$id_attaquant' and unit='spatial' and type='".$type_vaisseau_attaquant[$nb_vagues-1][$i]."'");
				
		
		}
		
		
		for ($i=0; $i < count($nb_vaisseaux_defenseur_restants[$nb_vagues-1]) ; $i++) {
		    $nb_vaisseaux_total_defenseur_restant+= $nb_vaisseaux_defenseur_restants[$nb_vagues-1][$i];
			
		    $nb_vaisseaux_perdus_defenseur = $nombre_vaisseau_defenseur[0][$i] - $nb_vaisseaux_defenseur_restants[$nb_vagues-1][$i];
			
		    $puissance_perdue_defenseur += $nb_vaisseaux_perdus_defenseur * $vaisseaux[$type_vaisseau_defenseur[$nb_vagues-1][$i]]['Puissance'];
			
			mysql_query("UPDATE  sg_flotte_units  SET nombre='".$nb_vaisseaux_defenseur_restants[$nb_vagues-1][$i]."' WHERE id_flotte='$id_defenseur' and unit='spatial' and type='".$type_vaisseau_defenseur[$nb_vagues-1][$i]."'");
			
	}		 
		 
		 
		 
		 
		 

	
	if ($nb_vaisseaux_total_attaquant_restant==0)  {

		mysql_query("DELETE FROM sg_flotte WHERE id='$id_attaquant'");
		mysql_query("DELETE FROM sg_flotte_units WHERE id_flotte='$id_attaquant'");
    
		combat_result($pseudo, 'loose');
		combat_result($pseudo_ennemi, 'win');
    
	       add_protection ($pseudo_ennemi, $id_joueur, 2);
		
		historique($combat_rapport_attaquant."<br />".'Vous n\'avez pas r&eacute;ussit a briser la d&eacute;fense adverse, et avez perdu toutes vos unit&eacute;s.<br />Vous avez perdu cette bataille !<br />', $pseudo);
		historique($combat_rapport_defenseur . "<br />".'Vous avez contr&eacute; l\'attaque &eacute;nnemie, leur flotte est r&eacute;duite a n&eacute;ant ! F&eacute;licitation.<br />', $pseudo_ennemi);
		
		$combat_rapport_attaquant .= $message . "<br />".'<font color="#6983A3"><b>Vous n\'avez pas r&eacute;ussit a briser la d&eacute;fense adverse, et avez perdu toutes vos unit&eacute;s.</b></font>';
		$combat_rapport_attaquant .= "<br />".'<font color="#6983A3"><b>Vous avez perdu cette bataille !</b></font><br />';
    
		$combat_rapport_defenseur .= $message . "<br />".'<font color="#6983A3"><b>Vous avez contr&eacute; l\'attaque &eacute;nnemie, leur flotte est r&eacute;duite a n&eacute;ant ! F&eacute;licitation.</b></font><br />';
       
    


    rapport_combat_messagerie($combat_rapport_attaquant, $pseudo, "red");
    rapport_combat_messagerie($combat_rapport_defenseur, $pseudo_ennemi, "orange");
    
    rapport_mail(name_to_id($pseudo), $combat_rapport_attaquant);
    rapport_mail(name_to_id($pseudo_ennemi), $combat_rapport_defenseur);
    
    if (verif_mort_perso($pseudo)) {
      $combat_rapport_attaquant .= "<br />".'<font color="#6983A3"><b>Vous fetez la victoire de cette bataille dans votre QG, quand soudaint l\'un de vos officiers vous remette un telegramme provenant de nacelles de sauvetage de la flotte ennemie. Sur celui ci est inscrit que dans l\'une d\'entre elles, se trouve le commandant adverse, et qu\'il vous offrira toutes ses ressources si vous le laissez s\'en aller sans detruire son vaisseau. Bien evidement, vous acceptez.</b></font>'; 
    }
				
	}



	if ($nb_vaisseaux_total_attaquant_restant != 0 AND $nb_vaisseaux_total_defenseur_restant == 0)  {
  
		mysql_query("DELETE FROM sg_flotte WHERE id='$id_defenseur'");
		mysql_query("DELETE FROM sg_flotte_units WHERE id_flotte='$id_defenseur'");
    
		historique($combat_rapport_attaquant . "<br />".'Vous remportez le combat, et d&eacute;truisez la flotte ' . $nom_flotte_ennemi . ' !<br />', $pseudo);
		historique($combat_rapport_defenseur . "<br />".'Toutes vos unit&eacute;es ont &eacute;t&eacute; d&eacute;truitres. Vos d&eacute;fenses ont faillit, votre flotte ' . $nom_flotte_ennemi . ' est d&eacute;truite.<br />', $pseudo_ennemi);
		
		$combat_rapport_attaquant .= $message . "<br />".'<font color="#6983A3"><b>Vous remportez le combat, et d&eacute;truisez la flotte ' . $nom_flotte_ennemi . ' !</b></font><br />';
		$combat_rapport_defenseur .= $message . "<br />".'<font color="#6983A3"><b>Toutes vos unit&eacute;es ont &eacute;t&eacute; d&eacute;truitres. Vos d&eacute;fenses ont faillit, votre flotte ' . $nom_flotte_ennemi . ' est d&eacute;truite.</b></font><br />';
       
		combat_result($pseudo, 'win');
		combat_result($pseudo_ennemi, 'loose');
       
	       add_protection ($pseudo_ennemi, $id_joueur, 0);
    
	  rapport_combat_messagerie($combat_rapport_attaquant, $pseudo, "green");
	  rapport_combat_messagerie($combat_rapport_defenseur, $pseudo_ennemi, "red");
	    
	  rapport_mail(name_to_id($pseudo), $combat_rapport_attaquant);
	  rapport_mail(name_to_id($pseudo_ennemi), $combat_rapport_defenseur);
	    
	    if (verif_mort_perso($pseudo)) {
	      $combat_rapport_attaquant .= "<br />".'Vous fetez la victoire de cette bataille dans votre QG, quand soudaint l\'un de vos officiers vous remette un telegramme provenant de nacelles de sauvetage de la flotte ennemie. Sur celui ci est inscrit que dans l\'une d\'entre elles, se trouve le commandant adverse, et qu\'il vous offrira toutes ses ressources si vous le laissez s\'en aller sans detruire son vaisseau. Bien evidement, vous acceptez.'; 
	    }
	}	

  if (($nb_vaisseaux_total_attaquant_restant !=0 ) AND ($nb_vaisseaux_total_defenseur_restant != 0)) {
  
    if ($puissance_perdue_attaquant < $puissance_perdue_defenseur) {

			historique($combat_rapport_attaquant . "<br />".'Vous detruisez plus de vaisseaux que vous n\'en perdez, vous remportez le combat !<br />', $pseudo);
			historique($combat_rapport_defenseur . "<br />".'Vous perdez plus d\'unites que vous n\'en tuez. Vous perdez donc ce combat, mais pas la guerre !<br />', $pseudo_ennemi);
			
			$combat_rapport_attaquant .= $message . "<br />".'<font color="#6983A3"><b>Vous detruisez plus de vaisseaux que vous n\'en perdez, vous remportez le combat !</b></font><br />';
			$combat_rapport_defenseur .= $message . "<br />".'<font color="#6983A3"><b>Vous perdez plus d\'unites que vous n\'en tuez. Vous perdez donc ce combat, mais pas la guerre !</b></font><br />';
	       
			combat_result($pseudo, 'win');
			combat_result($pseudo_ennemi, 'loose');
	       
	       add_protection ($pseudo_ennemi, $id_joueur, 0);
	    
		  rapport_combat_messagerie($combat_rapport_attaquant, $pseudo, "green");
		  rapport_combat_messagerie($combat_rapport_defenseur, $pseudo_ennemi, "red");
		    
		  rapport_mail(name_to_id($pseudo), $combat_rapport_attaquant);
		  rapport_mail(name_to_id($pseudo_ennemi), $combat_rapport_defenseur);
		    			 
    } elseif ($puissance_perdue_attaquant > $puissance_perdue_defenseur) {

			historique($combat_rapport_attaquant . "<br />".'Vous perdez plus d\'unites que vous n\'en tuez. Vous perdez donc ce combat, mais pas la guerre !<br />', $pseudo);
			historique($combat_rapport_defenseur . "<br />".'Vous detruisez plus de vaisseaux que vous n\'en perdez, vous repoussez l\attaque !<br />', $pseudo_ennemi);
			
			$combat_rapport_attaquant .= $message . "<br />".'<font color="#6983A3"><b>Vous perdez plus d\'unites que vous n\'en tuez. Vous perdez donc ce combat, mais pas la guerre !</b></font><br />';
			$combat_rapport_defenseur .= $message . "<br />".'<font color="#6983A3"><b>Vous detruisez plus de vaisseaux que vous n\'en perdez, vous repoussez l\attaque !</b></font><br />';
	       
			combat_result($pseudo, 'loose');
			combat_result($pseudo_ennemi, 'win');
	       
	       add_protection ($pseudo_ennemi, $id_joueur, 2);
	    
		  rapport_combat_messagerie($combat_rapport_attaquant, $pseudo, "orange");
		  rapport_combat_messagerie($combat_rapport_defenseur, $pseudo_ennemi, "orange");
		    
		  rapport_mail(name_to_id($pseudo), $combat_rapport_attaquant);
		  rapport_mail(name_to_id($pseudo_ennemi), $combat_rapport_defenseur);
		    
		   
		
    } else {
		
			historique($combat_rapport_attaquant . "<br />".'Vous tuez autant de vaisseaux ennemis que vous n\'en perdez. Il n\'y a donc ni vainqueur, ni vaincus... pour cette fois.<br />', $pseudo);
			historique($combat_rapport_defenseur . "<br />".'Vous tuez autant de vaisseaux ennemis que vous n\'en perdez. Il n\'y a donc ni vainqueur, ni vaincus... pour cette fois.<br />', $pseudo_ennemi);
			
			$combat_rapport_attaquant .= $message . "<br />".'<font color="#6983A3"><b>Vous tuez autant de vaisseaux ennemis que vous n\'en perdez. Il n\'y a donc ni vainqueur, ni vaincus... pour cette fois.</b></font><br />';
			$combat_rapport_defenseur .= $message . "<br />".'<font color="#6983A3"><b>Vous tuez autant de vaisseaux ennemis que vous n\'en perdez. Il n\'y a donc ni vainqueur, ni vaincus... pour cette fois.</b></font><br />';
	       
			combat_result($pseudo, 'equal');
			combat_result($pseudo_ennemi, 'equal');
	       
	       add_protection ($pseudo_ennemi, $id_joueur, 1);
	    
		  rapport_combat_messagerie($combat_rapport_attaquant, $pseudo, "orange");
		  rapport_combat_messagerie($combat_rapport_defenseur, $pseudo_ennemi, "orange");
		    
		  rapport_mail(name_to_id($pseudo), $combat_rapport_attaquant);
		  rapport_mail(name_to_id($pseudo_ennemi), $combat_rapport_defenseur);
		    
	       add_protection ($pseudo_ennemi, $id_joueur, 1);
		}
  
		
	
  }

	echo $combat_rapport_attaquant;
		
		
} // Fin du else du test pour savoir si la puissance adverse est trop importante.
}
?>
