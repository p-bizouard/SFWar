<?php
// Tableau avec des donnés suivant :
// Batiment_1 =>
//Nom court
// valeur de Y
//valeur de Z
// $Y * $Z^($niveau-1)
//Nom / Y / Z / Nbresource / X / coef directeur
//Nombre de type de ressources nécaissaire a sa construction
// Y*Z^niveau
$batiment_liste = array (
	'Batiment_01' => array ('fer','700','1.06','2','4500', '850'),
	'Batiment_02' => array ('carbone','360','1.06','2','2250', '850'),
	'Batiment_03' => array ('or','140','1.06','2','1500', '850'),
	'Batiment_04' => array ('naquada','40','1.06','2','300', '850'),
	'Batiment_05' => array ('trinium','20','1.06','3','200', '850'),
	'Batiment_06' => array ('immeuble','15000','1.07','3','20000', '850'),
);	

for ($i = 1; $i <= count($batiment_liste); $i++)
{
	$coef_dir[] = $batiment_liste["Batiment_0" . $i][5];
}

function id_to_name_ress3($id) {
	$name === false;
	if ($id == 0) $name = 'fer';
	if ($id == 1) $name = 'carbone';
	if ($id == 2) $name = 'or';
	if ($id == 3) $name = 'naquada';
	if ($id == 4) $name = 'trinium';
	if ($id == 5) $name = 'immeuble';
	
	return ($name);
}

function temps_creation_mine($niveau, $coef_directeur) {
  if ($niveau ==  0) $niveau = 0.5;
  $temps = (int)($coef_directeur*$niveau);
  return $temps;
}

function id_to_coef($id)
{
	global $coef_dir;
	return $coef_dir[$id];
}
	
$i = 0;
$time_restant = 0;
while ($i == 0) {
	$sql = mysql_query("SELECT * FROM sg_construction WHERE `pseudo`='".$pseudo."';");
	$result = mysql_fetch_array($sql);
	$timeend = $result['timeend'];

	$time = time();
	$sql = mysql_query("SELECT * FROM sg_mine WHERE `id_joueur`='".$id_joueur."' AND prior='0';");
	$result = mysql_fetch_array($sql);
	$id_ress = $result['id_ress'];
	
	if (!is_numeric($id_ress)) $i = 1;
	
	if (($timeend <= ($time + $time_restant)) AND ($timeend != 0))
	{
		$time_restant = ($time + $time_restant) - $timeend;
		
		mysql_query ("UPDATE sg_construction SET `".id_to_name_ress3($id_ress)."`=".id_to_name_ress3($id_ress)."+1 WHERE pseudo='".$pseudo."'");
		mysql_query("DELETE FROM sg_mine WHERE `id_joueur`='".$id_joueur."' AND prior='0';");
		mysql_query ("UPDATE sg_mine SET prior=prior-1 WHERE id_joueur='".$id_joueur."'");

		$sql = mysql_query("SELECT * FROM sg_mine WHERE `id_joueur`='".$id_joueur."' AND prior='0';");
		$result = mysql_fetch_array($sql);
		$id_ress = $result['id_ress'];

		$sql = mysql_query("SELECT * FROM sg_construction WHERE `pseudo`='".$pseudo."'");
		$result = mysql_fetch_array($sql);
		$niveau = $result[id_to_name_ress3($id_ress)];
		
		$temp = time() + temps_creation_mine($niveau, id_to_coef($id_ress));
		mysql_query ("UPDATE sg_construction SET timeend='".$temp."' WHERE pseudo='".$pseudo."'");
		
	} else {
		$i = 1;
	}
}

?>
