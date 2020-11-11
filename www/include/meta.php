<?php
/* FONCTIONS PERMETTANT DE CALCULER LE TEMPS D'EXÉCUTION D'UNE PAGE */
function debut_calcultemps() {
	$debut_temp = microtime();
	return $debut_temp;
}

function ecrire_temps($temps_debut) {
	$fin_temps = microtime();
	$chrono = $fin_temps - $temps_debut;
	return "Exec : ".$chrono." sec";
}

	// Script de vérification si le joueur ne s'est pas fait tuer.
	


?>
