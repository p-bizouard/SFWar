<?php


/*
** Description : Trouve les bonus d'un type de vaisseau
** Input : $id : l'id du vaisseau qui a le bonus, $bonus_spatial : tableau des bonus
** Output : Un tableau contenant les id des vaisseaux
** Creator : Gueust
** Date : 20 juin 2007
*/
function trouve_bonus ($id)
{
  global $type;
  if (($type == "flotte") || ($type == "planete")) 
    {
      global $bonus_terrestre;
      $bonus_spatial = $bonus_terrestre;
    } 
  else 
   {
     global $bonus_spatial;
   }
  // Chaine contenant les bonus du vaisseau de type id
	$chaine_bonus = $bonus_spatial[$id];
  
  // On renvoit le tout sous forme de tableau
	$return = explode (',',$chaine_bonus);

	return $return;
}

function verif_protection ($pseudo_cible, $id_perso)
{
if ($pseudo_cible == 'neutre')
	return 0;

  $row = mysql_fetch_array(mysql_query("SELECT status, heure_attaque, id_attaquant FROM sg_perso WHERE pseudo='" . $pseudo_cible."'"));
  
  $heure			= $row['heure_attaque'];
  $status			= $row['status'];
  $id_attaquant	= $row['id_attaquant'];
  if ($status == 0) // perdu
    {
      if ($id_perso == $id_attaquant)
        {
          if ($heure + 3600 > time())
            return ($heure + 3600 - time());
        }
    }
  elseif ($status == 1) // null
    {
      if ($heure + 3600 > time())

            return ($heure + 3600 - time());
    }
  elseif ($status == 2) // gagne
    {
      if ($heure + 14400 > time())
            return ($heure + 14400 - time());
    }
  return (0);
}

function add_protection ($pseudo_cible, $id_perso, $status)
{

  $time = time();
  mysql_query("UPDATE sg_perso SET id_attaquant=$id_perso, status=$status, heure_attaque=$time WHERE pseudo='". mysql_real_escape_string($pseudo_cible) ."'");

}
/*
** Description : trouve les noms des vaisseaux sur lequel un vaisseau a un bonus
** Input : $id : l'id du vaisseau qui a le bonus, $bonus_spatial : tableau des bonus
** Output : un tableau contenant les noms des vaisseaux sur lequel on a un bonus
** Creator : Gueust
** Date : 19 juin 2007
*/
function affichage_bonus ($id)
{

	// On prend les bonus de id
	$bonus_spatial_type = trouve_bonus($id);
      
	$return = array();
	
  // On fait tous les bonus (generalement 2)
	for ($i = 0; $i < count($bonus_spatial_type); $i++)
  {
    // On passe de l'id au nonm du vaisseau
		$return[] = type_id_vaisseaux_to_name($bonus_spatial_type[$i]);
	}
	return $return;
}
/*
** Description : Trouve le nom du vaisseau a partir de son id
** Input : $id : l'id du vaisseau
** Output : Un tableau contenant les noms des vaisseaux
** Creator : Leodi
** Date : 20 juin 2007
*/
function type_id_vaisseaux_to_name ($id, $id_race = '') 
{
  global $race; 
  global $type;
  
	if ($id_race != '') {
		$race_name = race_id_to_name_simple($id_race);
		
		if (($type == "flotte") || ($type == "planete")) {
			global ${'terrestre_'.$race_name}; 
			$array = ${'terrestre_'.$race_name};
		} else {
			global ${'vaisseaux_'.$race_name}; 
			$array = ${'vaisseaux_'.$race_name};
		}
		
		for ($y = 0; $y < $id; $y++)
		{
			@next($array);
		}
		
		$vagueames = @key($array);
		
	} else {
	  for ($i=0; $i< count($race); $i++) {
		if (($type == "flotte") || ($type == "planete")) {
			global ${'terrestre_'.$race[$i]}; 
			$array = ${'terrestre_'.$race[$i]};
		} else {
			global ${'vaisseaux_'.$race[$i]};
			$array = ${'vaisseaux_'.$race[$i]};
		}
	  
	    // On parcourt jusqu'au numero ID du tableau
	    for ($y = 0; $y < $id; $y++)
	    {
	      // On incremente le pointeur
	      next($array);
	    }
	    
	    // Et on prend le nom de la clef
	    $vagueames[] = key($array);
	    
	  }
	}
  return $vagueames;
}


/*
** Description : Calcule la taille globale
** Input : $type : tableau contenent les types des vaisseaux, $nombre : nombre de vaisseaux pour chaque type, $vaisseau : caractéristique des vaisseaux pour toutes les races
** Output : La taille totale de la flotte
** Creator :Gueust
** Date : 19 juin 2007
*/
function taille_flotte ($type2,$nombre) 
{
	global $vaisseaux;
	$taille_flotte = 0;
	for ($i=0; $i< count($type2); $i++) {
		$taille_flotte += $nombre[$i] * $vaisseaux[$type2[$i]]['Taille'];
	}
	return $taille_flotte;
}


/*
** Description : Calcule la taille d'un vaisseau donné
** Input : $type : tableau contenent les types des vaisseaux, $nombre : nombre de vaisseaux pour chaque type, $vaisseau : caractéristique des vaisseaux pour toutes les races
** Output : Taille d'un type dans une flotte
** Creator :Gueust
** Date : 20 juin 2007
*/
function taille_vaisseau ($type2,$nombre) 
{
	global $vaisseaux;
	$taille_vaisseau = $nombre * $vaisseaux[$type2]['Taille'];

	return $taille_vaisseau;
}


/*
** Description : Script qui genere une valeur aleatoire pour les degats que font un vaisseau
** Input : l'id du vaisseau
** Output : ses degats
** Creator : Leodi
** Date : 20 juin 2007
*/
function attaque_aleatoire($id_vaisseau) 
{
	global $vaisseaux;
	$degats_vaisseau = mt_rand($vaisseaux[$id_vaisseau]['Attaque_min']*100, $vaisseaux[$id_vaisseau]['Attaque_max']*100)/100;  

	return $degats_vaisseau;
}


/*
** Description : Script qui genere une valeur aleatoire pour lla vie du type de vaisseau
** Input : l'id du vaisseau
** Output : sa vie
** Creator : Leodi
** Date : 20 juin 2007
*/
function vie_aleatoire($id_vaisseau) 
{
	global $vaisseaux;
	$vie_vaisseau = mt_rand($vaisseaux[$id_vaisseau]['Vie_min']*100, $vaisseaux[$id_vaisseau]['Vie_max']*100)/100;  
  
	return $vie_vaisseau;
}

/*
** Description :Renvoit en global le type et le nombre de vaisseaux def / attaquants pour la vague suivante
** Input : les nombres restants de vaisseaux
** Output : le type et le nombre
** Creator : Leodi
** Date : 24 juin 2007
*/
function type_et_nombre_vaisseaux_restants($nb_vaisseaux_attaquant_restants, $nb_vaisseaux_defenseur_restants) 
{
	$continue_attaquant = "false"; // SI on passe au round suivant (si il reste des survivants)
	$continue_defenseur = "false"; // SI on passe au round suivant (si il reste des survivants)

	global $vague;
	global $type_vaisseau_attaquant, $nombre_vaisseau_attaquant;
	global $type_vaisseau_defenseur, $nombre_vaisseau_defenseur;
	
	$y = 0;
	for ($i = 0; $i < count($type_vaisseau_attaquant[$vague]); $i++) {
		if ($nb_vaisseaux_attaquant_restants[$vague][$i] !=0 ) {
			$nombre_vaisseau_attaquant[$vague+1][$y] = $nb_vaisseaux_attaquant_restants[$vague][$i];
			$type_vaisseau_attaquant[$vague+1][$y] = $type_vaisseau_attaquant[$vague][$i];

			$continue_attaquant = "true";
			$y++;
		}
	}
	$y = 0;
	for ($i = 0; $i < count($type_vaisseau_defenseur[$vague]); $i++) {
		if ($nb_vaisseaux_defenseur_restants[$vague][$i] !=0 ) {
			$nombre_vaisseau_defenseur[$vague+1][$y] = $nb_vaisseaux_defenseur_restants[$vague][$i];
			$type_vaisseau_defenseur[$vague+1][$y] = $type_vaisseau_defenseur[$vague][$i];

			$continue_defenseur = "true";
			$y++;
		}
	}
	if (($continue_attaquant == "false") OR ($continue_defenseur == "false")) {
		unset($nombre_vaisseau_defenseur[$vague+1]);
		unset($type_vaisseau_defenseur[$vague+1]);
		unset($nombre_vaisseau_attaquant[$vague+1]);
		unset($type_vaisseau_attaquant[$vague+1]);
		
		$vague = 99; // On met le round a 99 (pour quer la boucle s'arrete)	
	}
}


/*
** Description : Script qui genere une valeur aleatoire pour lla vie du type de vaisseau
** Input : l'id du vaisseau
** Output : sa vie
** Creator : Leodi
** Date : 20 juin 2007
*/
function rapport_combat($vie_aleatoire, $degat_aleatoire, $type_vaisseau_attaquant, $type_vaisseau_defenseur, $nombre_vaisseau_attaquant, $nombre_vaisseau_defenseur, $nb_vaisseau_attaque, $nb_vaisseau_defense, $nb_vaisseau_attaque,$nb_vaisseau_defense, $nb_vaisseaux_defenseur_tues, $nb_vaisseaux_attaquant_tues, $nb_vaisseaux_attaquant_restants, $nb_vaisseaux_defenseur_restants) 
{

	global $message;
	global $type;
	
	global $race_attaquant, $race_defenseur;

		if (($type == "flotte") || ($type == "planete")) {
			global $terrestre;
			global ${'terrestre_'.race_id_to_name_simple($race_defenseur)}, ${'terrestre_'.race_id_to_name_simple($race_attaquant)};
			
			$vaisseaux_race_attaquant = ${'terrestre_'.race_id_to_name_simple($race_attaquant)};
			$vaisseaux_race_defenseur = ${'terrestre_'.race_id_to_name_simple($race_defenseur)};
		} else {
			global $vaisseaux;
			global ${'vaisseaux_'.race_id_to_name_simple($race_defenseur)}, ${'vaisseaux_'.race_id_to_name_simple($race_attaquant)};
			
			$vaisseaux_race_attaquant = ${'vaisseaux_'.race_id_to_name_simple($race_attaquant)};
			$vaisseaux_race_defenseur = ${'vaisseaux_'.race_id_to_name_simple($race_defenseur)};
		}

	
	$message = '';
	
	$flotte_attaquant = '';
	$flotte_defenseur = '';
	
	
	for ($attaquant = 0; $attaquant < count($type_vaisseau_attaquant[0]); $attaquant++) {

			$flotte_attaquant .= $nombre_vaisseau_attaquant[0][$attaquant] . ' ' . type_id_vaisseaux_to_name($type_vaisseau_attaquant[0][$attaquant], $race_attaquant). '<br />';
}
	for ($defenseur = 0; $defenseur < count($type_vaisseau_defenseur[0]); $defenseur++) {

			$flotte_defenseur .= $nombre_vaisseau_defenseur[0][$defenseur] . ' ' . type_id_vaisseaux_to_name($type_vaisseau_defenseur[0][$defenseur], $race_defenseur). '<br />';
		
	}

	
	$message .= '<table><tr><td width="250"><b>Forces attaquantes</b></td><td width="250"><b>Forces defensives</b></td></tr><tr><td width="250">' . $flotte_attaquant . '</td><td width="250">' . $flotte_defenseur . '</td></tr></table>';
	
	for ($vague_for = 0; $vague_for < count($type_vaisseau_attaquant); $vague_for++) {

		$message .= '<br /><font color="#bb0000"><b>Round ' . ($vague_for+1) . '</b></font><br />';
	
		$message .= '<br />Attaquant :<br />';
		

	
		for ($attaquants = 0; $attaquants < count($type_vaisseau_attaquant[$vague_for]); $attaquants++) {
		
	
			for ($defenseurs = 0; $defenseurs < count($type_vaisseau_defenseur[$vague_for]); $defenseurs++) {
				
				if ($nb_vaisseau_attaque[$vague_for][$attaquants][$defenseurs] != 0) {
					if ($nb_vaisseau_attaque[$vague_for][$attaquants][$defenseurs] > 1) {
						$message .= '' . $nb_vaisseau_attaque[$vague_for][$attaquants][$defenseurs] . ' ' . type_id_vaisseaux_to_name($type_vaisseau_attaquant[$vague_for][$attaquants], $race_attaquant) . ' tirent (' . $degat_aleatoire[$vague_for][$attaquants]. ' dégats/vx) et détruisent ' . $nb_vaisseaux_defenseur_tues[$vague_for][$attaquants][$defenseurs] . ' ' .type_id_vaisseaux_to_name($type_vaisseau_defenseur[$vague_for][$defenseurs], $race_defenseur) . ' ('.$vie_aleatoire[$vague_for][$defenseurs].' vie/vx) <br />';
					} else {
						$message .= '' . $nb_vaisseau_attaque[$vague_for][$attaquants][$defenseurs] . ' ' . type_id_vaisseaux_to_name($type_vaisseau_attaquant[$vague_for][$attaquants], $race_attaquant) . ' tire (' . $degat_aleatoire[$vague_for][$attaquants]. ' dégats/vx) et détruis ' . $nb_vaisseaux_defenseur_tues[$vague_for][$attaquants][$defenseurs] . ' ' .type_id_vaisseaux_to_name($type_vaisseau_defenseur[$vague_for][$defenseurs], $race_defenseur) . '('.$vie_aleatoire[$vague_for][$defenseurs].' vie/vx)<br />';
					}
				}
			}
		}

		$message .= '<br />Defenseur :<br />';
		
		for ($attaquants = 0; $attaquants < count($type_vaisseau_defenseur[$vague_for]); $attaquants++) {
		
			for ($defenseurs = 0; $defenseurs < count($type_vaisseau_attaquant[$vague_for]); $defenseurs++) {
				
				if ($nb_vaisseau_defense[$vague_for][$attaquants][$defenseurs] != 0) {
				
					if ($nb_vaisseau_defense[$vague_for][$attaquants][$defenseurs] > 1) {
						$message .= '' . $nb_vaisseau_defense[$vague_for][$attaquants][$defenseurs] . ' ' . type_id_vaisseaux_to_name($type_vaisseau_defenseur[$vague_for][$attaquants], $race_defenseur) . ' tirent (' . $degat_aleatoire[$vague_for][$attaquants]. ' dégats/vx) et détruisent ' . $nb_vaisseaux_attaquant_tues[$vague_for][$attaquants][$defenseurs] . ' ' .type_id_vaisseaux_to_name($type_vaisseau_attaquant[$vague_for][$defenseurs], $race_attaquant) . '('.$vie_aleatoire[$vague_for][$defenseurs].' vie/vx)<br />';
					} else {
						$message .= '' . $nb_vaisseau_defense[$vague_for][$attaquants][$defenseurs] . ' ' . type_id_vaisseaux_to_name($type_vaisseau_defenseur[$vague_for][$attaquants], $race_defenseur) . ' tire (' . $degat_aleatoire[$vague_for][$attaquants]. ' dégats/vx) et détruis ' . $nb_vaisseaux_attaquant_tues[$vague_for][$attaquants][$defenseurs] . ' ' .type_id_vaisseaux_to_name($type_vaisseau_attaquant[$vague_for][$defenseurs], $race_attaquant) . '('.$vie_aleatoire[$vague_for][$defenseurs].' vie/vx)<br />';
					}
				}
			}
		
		}
		
		$flotte_attaquant = '';
		$flotte_defenseur = '';
		
		for ($attaquant = 0; $attaquant < count($type_vaisseau_attaquant[$vague_for]); $attaquant++) {
			$flotte_attaquant .= $nb_vaisseaux_attaquant_restants[$vague_for][$attaquant] . ' ' . type_id_vaisseaux_to_name($type_vaisseau_attaquant[$vague_for][$attaquant], $race_attaquant). '<br />';
		}
		for ($defenseur = 0; $defenseur < count($type_vaisseau_defenseur[$vague_for]); $defenseur++) {
			$flotte_defenseur .= $nb_vaisseaux_defenseur_restants[$vague_for][$defenseur] . ' ' . type_id_vaisseaux_to_name($type_vaisseau_defenseur[$vague_for][$defenseur], $race_defenseur). '<br />';
		}
	$message .= '<br /><table><tr><td width="250"><b>Forces attaquantes</b></td><td width="250"><b>Forces defensives</b></td></tr><tr><td width="250">'  . $flotte_attaquant . '</td><td width="250">' . $flotte_defenseur . '</td></tr></table>';
	
		
	}

			
}


?>
