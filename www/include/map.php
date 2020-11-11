<?php
include ("../../connexion.php");
// On va renvoyer une image PNG
 header('Content-Type: image/png');

 $largeur=50;
 $hauteur=50;


// on spécifie le type de document que l'on va créer (ici une image au format PNG
header ("Content-type: image/png");

// on dessine une image vide de 200 pixels sur 100
$image = @ImageCreate (300, 300) or die ("Erreur lors de la création de l'image");

// on applique à cette image une couleur de fond, les couleurs étant au format RVB, on aura donc ici une couleur rouge
$couleur_fond = ImageColorAllocate ($image, 0, 0, 0);

$bleu = imagecolorallocate($image, 0, 120, 200);


	$reponse = mysql_query("SELECT * FROM sg_flotte");	
	while ($donnees = mysql_fetch_array($reponse)) {
		
		$coord_X = $donnees['coord_X'] * 6;
		$coord_Y = $donnees['coord_Y'] * 6;
		ImageFilledRectangle ($image, $coord_X, $coord_Y, $coord_X+5, $coord_Y+5, $bleu);											
	}
	
$rouge = imagecolorallocate($image, 255, 0, 0);
	$reponse = mysql_query("SELECT * FROM sg_planete");	
	while ($donnees = mysql_fetch_array($reponse)) {
		
		$coord_X = $donnees['coord_X'] * 6;
		$coord_Y = $donnees['coord_Y'] * 6;
		ImageFilledRectangle ($image, $coord_X, $coord_Y, $coord_X+5, $coord_Y+5, $rouge);											
	}

// on dessine notre image PNG
ImagePng ($image);


?>
