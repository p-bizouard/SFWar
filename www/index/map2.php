<?php
session_start();
$pseudo=$_SESSION["pseudo"];

include ("../../connexion.php");
// On va renvoyer une image PNG


 $largeur=50;
 $hauteur=50;


// on sp&eacute;cifie le type de document que l'on va cr&eacute;er (ici une image au format PNG
header ("Content-type: image/png");

// on dessine une image vide de 200 pixels sur 100   <- Onwned !
$image = @ImageCreate (320, 320) or die ("Erreur lors de la cr&eacute;ation de l'image");

// on applique &agrave; cette image une couleur de fond, les couleurs &eacute;tant au format RVB, on aura donc ici une couleur rouge
$couleur_fond = ImageColorAllocate ($image, 0, 0, 0);

$bleu = imagecolorallocate($image, 50, 150, 255);
$vert = imagecolorallocate($image, 0,255, 0);	
$jaune = imagecolorallocate($image, 210,210, 0);	
$noir = imagecolorallocate($image, 0,0,0);
$blanc = imagecolorallocate($image, 255,255,255);	
$rouge = imagecolorallocate($image, 255, 100, 100);

$rouge_fonce = imagecolorallocate($image, 200, 0, 0);
$bleu_fonce = imagecolorallocate($image, 0, 0, 200);
$blanc_fonce = imagecolorallocate($image, 190, 190, 190);
$vert_fonce = imagecolorallocate($image, 70, 170, 70);

$reponse = mysql_query("SELECT X_max,Y_max FROM sg_config_carte");
$donnees = mysql_fetch_array($reponse);
$X_max = $donnees['X_max'];
$Y_max = $donnees['Y_max'];
	
	

	
	
	$reponse = mysql_query("SELECT * FROM sg_flotte");	
	while ($donnees = mysql_fetch_array($reponse)) {

		$pseudo_flotte = addslashes($donnees['pseudo']);
		
		$reponse2 = mysql_query("SELECT clan FROM sg_perso WHERE pseudo='$pseudo_flotte'");	
		$donnees2 = mysql_fetch_array($reponse2);	
		
		if ($donnees2['clan'] == "0")
		{
			$couleur = $vert;
		}
		if ($donnees2['clan'] == "1")
		{
			$couleur = $bleu;
		}
		if ($donnees2['clan'] == "2")
		{
			$couleur = $rouge;
		}
		if ($donnees2['clan'] == "3")
		{
			$couleur = $blanc;
		}
		
		$coord_X = $donnees['coord_X'] * 6 + 10;
		$coord_Y = ($Y_max * 6 + 10) - ($donnees['coord_Y'] * 6);
		ImageFilledRectangle ($image, $coord_X-6+6, $coord_Y-6, $coord_X-1+6, $coord_Y+5-6, $couleur);											
	}
	

	
	$reponse = mysql_query("SELECT * FROM sg_planete");	
	while ($donnees = mysql_fetch_array($reponse)) {

		$pseudo_planete = addslashes($donnees['pseudo']);
		
		$reponse2 = mysql_query("SELECT clan FROM sg_perso WHERE pseudo='$pseudo_planete'");	
		$donnees2 = mysql_fetch_array($reponse2);	
		
		if ($donnees2['clan'] == "0")
		{
			$couleur = $vert_fonce;
		}
		if ($donnees2['clan'] == "1")
		{
			$couleur = $bleu_fonce;
			
		}
		if ($donnees2['clan'] == "2")
		{
			$couleur = $rouge_fonce;
			
		}
		if ($donnees2['clan'] == "3")
		{
			$couleur = $blanc_fonce;
			
		}
		
		$coord_X = $donnees['coord_X'] * 6 + 10;
		$coord_Y = ($Y_max * 6 + 10) - ($donnees['coord_Y'] * 6);
		ImageFilledRectangle ($image, $coord_X-6+6, $coord_Y-6, $coord_X-1+6, $coord_Y+5-6, $couleur);											
	}
	


	

for($i=10; $i<320;$i = $i+60)
{
	ImageLine ($image, 10, $i, $X_max * 6 + 10, $i , $vert);
	ImageLine ($image, $i, 10, $i , $Y_max * 6 + 10, $vert);
}

//On place les rectangles de vue des flottes :
if (isset($pseudo))
{
	$reponse = mysql_query("SELECT * FROM sg_flotte WHERE pseudo='$pseudo'");
	while ($donnees = mysql_fetch_array($reponse))
	{
	$x1 = ($donnees['coord_X'] - 4) * 6 + 4;
	$y1 = ($Y_max - $donnees['coord_Y'] - 4) * 6 + 4;
	$x2 = $x1 + 10*6;
	$y2 = $y1 + 10*6;
	ImageRectangle ($image, $x1, $y1, $x2, $y2, $blanc);
	}
	
	$reponse = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo'");
	while ($donnees = mysql_fetch_array($reponse))
	{
	$x1 = ($donnees['coord_X'] - 4) * 6 + 4;
	$y1 = ($Y_max - $donnees['coord_Y'] - 4) * 6 + 4;
	$x2 = $x1 + 10*6;
	$y2 = $y1 + 10*6;
	ImageRectangle ($image, $x1, $y1, $x2, $y2, $blanc);
	}
}

ImageFilledRectangle ($image, 0, 0, $X_max * 6 + 20, 9, $jaune);
ImageFilledRectangle ($image, 0, 0, 9,$Y_max * 6 + 20 , $jaune);
ImageFilledRectangle ($image, 0,$Y_max * 6 + 11,$X_max * 6 + 20,$Y_max * 6+ 20 , $jaune);
ImageFilledRectangle ($image, $X_max * 6 + 11,0,$Y_max * 6+ 20,$X_max * 6 + 20 , $jaune);

//Pour noter les coordonn&eacute;es
$x = 0;
for($i=9; $i<320;$i = $i+59)
{

	ImageString ($image, 1, $i, 310, $x, $noir);

	$x = $x + 10;
}
$y = 0;
for($i=305; $i>0;$i = $i-59)
{

	ImageString ($image, 1,1,  $i, $y, $noir);

	$y = $y + 10;
}

// on dessine notre image PNG
ImagePng ($image);
?>