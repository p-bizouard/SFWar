<?
include("fonction_combat.php");
include("units.php");


/*
$type_vaisseau_attaquant = array('0','1','2');
$nombre_vaisseau_attaquant = array ('10','6','1');

$type_vaisseau_defenseur = array('0', '1','3');
$nombre_vaisseau_defenseur = array ('10','6', '4');
*/


$race_attaquant = 1;
$race_defenseur = 2;

$type_vaisseau_attaquant[0] = array('0','1','3');
$nombre_vaisseau_attaquant[0] = array ('30','7','5');

$type_vaisseau_defenseur[0] = array('0', '1');
$nombre_vaisseau_defenseur[0] = array ('200','100');


////////////////////////////
////// VAGUE $vague ///////////
///////////////////////////


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
		if (preg_match(','.$type_vaisseau_defenseur[$vague][$defenseur].',', $bonus[$type_vaisseau_attaquant[$vague][$attaquant]])=== 1) 
			$degat_attaquant[$vague][$attaquant][$defenseur]*=2;

	}
}


//print_rr($degat_attaquant);




// $nb_vaisseaux_defenseur_restants et $nb_vaisseaux_defenseur_tues
for ($attaquant = 0; $attaquant < count($type_vaisseau_attaquant[$vague]); $attaquant++) {

  for ($defenseur=0; $defenseur < count($type_vaisseau_defenseur[$vague]); $defenseur++) {

    if (!isset($vie_aleatoire[$vague][$defenseur])) $vie_aleatoire[$vague][$defenseur] = vie_aleatoire($type_vaisseau_defenseur[$vague][$defenseur]);
	if (!isset($nb_vaisseaux_defenseur_restants[$vague][$defenseur])) $nb_vaisseaux_defenseur_restants[$vague][$defenseur] = $nombre_vaisseau_defenseur[$vague][$defenseur];
    
	// Si le nombre de défenseur tué est plus grand que le nombre de défenseur restant : alors... sinon
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
		if (preg_match(','.$type_vaisseau_attaquant[$vague][$attaquant].',', $bonus[$type_vaisseau_defenseur[$vague][$defenseur]])=== 1) 
			$degat_defenseur[$vague][$defenseur][$attaquant]*=2;

	}
}






// $nb_vaisseaux_attaquant_restants et $nb_vaisseaux_attaquant_tues
for ($defenseur = 0; $defenseur < count($type_vaisseau_defenseur[$vague]); $defenseur++) {

  for ($attaquant=0; $attaquant < count($type_vaisseau_attaquant[$vague]); $attaquant++) {

    if (!isset($vie_aleatoire[$vague][$attaquant])) $vie_aleatoire[$vague][$attaquant] = vie_aleatoire($type_vaisseau_attaquant[$vague][$attaquant]);
	if (!isset($nb_vaisseaux_attaquant_restants[$vague][$attaquant])) $nb_vaisseaux_attaquant_restants[$vague][$attaquant] = $nombre_vaisseau_attaquant[$vague][$attaquant];
    
	// Si le nombre de défenseur tué est plus grand que le nombre de défenseur restant : alors... sinon
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
-vérifier nb vaisseau defenseut tue est inférieur au nombre total de vaisseaux
- vérifier qu'il reste des vaisseaux du type cible avant de calculer le nombre de defenseur tué et être capable d'ifentifier une vague qui se trompe cmme une merde.

*/

//print_rr($type_vaisseau_attaquant);

rapport_combat($type_vaisseau_attaquant, $type_vaisseau_defenseur, $nombre_vaisseau_attaquant, $nombre_vaisseau_defenseur, $nb_vaisseau_attaque, $nb_vaisseau_defense, $nb_vaisseau_attaque,$nb_vaisseau_defense, $nb_vaisseaux_defenseur_tues, $nb_vaisseaux_attaquant_tues, $nb_vaisseaux_attaquant_restants, $nb_vaisseaux_defenseur_restants) ;

?>