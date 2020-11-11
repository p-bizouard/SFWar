

<?php
$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE pseudo='$pseudo'");
$donnees = mysql_fetch_array($retour);
$nombre_de_flotte = $donnees['nbre_entrees'];

$reponse = mysql_query("SELECT * FROM sg_perso WHERE pseudo='$pseudo'");
$donnees = mysql_fetch_array($reponse);
$clan = $donnees['clan'];


if ($nombre_de_flotte>=3)  {
  echo "<p>Vous ne pouvez pas poss&eacute;der plus de 3 flottes.</p>";
} else {
	if (isset($_POST['base_de_lancement']) AND isset($_POST['nom']) AND @$_POST['base_de_lancement']!="Aucune" AND @$_POST['nom']!="") {
		$base_de_lancement = $_POST['base_de_lancement'];
		$nom_flotte = strip_tags(trim ($_POST['nom']));
		
		
		
		$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE pseudo='$pseudo'");
		$donnees = mysql_fetch_array($retour);
		$nombre_de_flotte = $donnees['nbre_entrees'];
		
		if ($nombre_de_flotte>=3)  {
			echo "<p>Vous ne pouvez pas poss&eacute;der plus de 3 flottes.</p>";
		} else {
		
			// On v&eacute;rifie que la plan&egrave;te existe bien et appartient bien au joueur
			$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE pseudo='$pseudo' AND nom='$base_de_lancement'");
			$donnees = mysql_fetch_array($retour);
			$nb_ligne2 = $donnees['nbre_entrees'];

			if ($nb_ligne2!=0) {
				$reponse = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo' AND nom='$base_de_lancement'");
				$donnees = mysql_fetch_array($reponse);
				$X_lancement = $donnees['coord_X'];
				$Y_lancement = $donnees['coord_Y'];
			
				$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE coord_X<='$X_lancement+1' AND coord_X>='$X_lancement-1' AND coord_Y<='$Y_lancement+1' AND coord_Y>='$Y_lancement-1'");
				$donnees = mysql_fetch_array($retour);
				$nb_planete = $donnees['nbre_entrees'];
			
				$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE coord_X<='$X_lancement+1' AND coord_X>='$X_lancement-1' AND coord_Y<='$Y_lancement+1' AND coord_Y>='$Y_lancement-1'");
				$donnees = mysql_fetch_array($retour);
				$nb_flotte = $donnees['nbre_entrees'];
			
				$nb_element=$nb_planete+$nb_flotte;

				//Si 8 &eacute;lement alors cr&eacute;ation de flotte impossible
				if ($nb_element>=8) {
					echo "<p>Votre plan&egrave;te est assi&eacute;g&eacute;. Vous ne pouvez faire d&eacute;coller une flotte sans quelle soit d&eacute;truit. Choississez une autre base de lancement.</p>";	
				} else {
				
					do {
	
						$X1 = rand($X_lancement-1,$X_lancement+1);
						$Y1 = rand($Y_lancement-1,$Y_lancement+1);
				
						$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE coord_X='$X1' 