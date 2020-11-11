<table border="0" cellpadding="0" cellspacing="0" height="50" width="300">
<tr>
	<td class="Ttexte" background="../images/titre1.png">&nbsp;</td>
	<td class="Ttexte" background="../images/titre2.png"><?php echo $titre; ?></td>
	<td class="Ttexte" background="../images/titre3.png">&nbsp;</td>
	</tr>
</table>
<?

$pseudo = $_SESSION['pseudo'];

// on inclut Connexion.php pour se connecter a la BDD
// et on inclut batiment.php pour toutes les carac. (cout, production..)
require_once ("../../connexion.php");
require_once ("../include/batiment.php");

//////////////////////////////////////////////////
////////////////Nombres de plan&egrave;tes///////////////
$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE pseudo='$pseudo'");
$donnees = mysql_fetch_array($retour);
$nb_planetes = $donnees['nbre_entrees'];

//////////////////////////////////////////////////
//////////////////////////////////////////////////

if ($HTTP_GET_VARS["batiment"]!="") {

	//L&agrave; on r&eacute;cup&egrave;re l'id du batiment pour les actions suivantes
	if ($HTTP_GET_VARS['batiment'] === 'Batiment_01') {$Batiment_id="1";}
	IF ($HTTP_GET_VARS['batiment'] === 'Batiment_02') {$Batiment_id="2";}
	IF ($HTTP_GET_VARS['batiment'] === 'Batiment_03') {$Batiment_id="3";}
	IF ($HTTP_GET_VARS['batiment'] === 'Batiment_04') {$Batiment_id="4";}
	IF ($HTTP_GET_VARS['batiment'] === 'Batiment_05') {$Batiment_id="5";}
	IF ($HTTP_GET_VARS['batiment'] === 'Batiment_06') {$Batiment_id="6";}
	//End
	
	//L&agrave; on r&eacute;cup&egrave;re tout ce qui concerne le batiment, nom, chemin, descr...
	$reponse_construction = mysql_query("SELECT * FROM sg_batiment WHERE id='$Batiment_id'");
	$donnees_construction = mysql_fetch_array($reponse_construction);
	$nom_batiment = $donnees_construction["nom_batiment"];
	$chemin_image = $donnees_construction["chemin_image"];
	$description_batiment = $donnees_construction["description_batiment"];
	//End
	
	
	$Batiment_selectione =$HTTP_GET_VARS["batiment"];
	$Y = $batiment_liste["$Batiment_selectione"][1];
	$Z = $batiment_liste["$Batiment_selectione"][2];	
	$Nom_batiment= $batiment_liste["$Batiment_selectione"][0];
	
	$reponse_construction = mysql_query("SELECT * FROM sg_construction WHERE pseudo='$pseudo'");
	$donnees_construction = mysql_fetch_array($reponse_construction);
	$niveau= $donnees_construction["$Nom_batiment"];


	$niveau_min=$niveau-2;
	$niveau_max=$niveau+14; //12

	if ($Batiment_selectione == "Batiment_06") {
    $col2titre="Capacit&eacute; de stockage";
  } else {
    $col2titre="Production/h";
  }

	if ($niveau_min<1) {
		$niveau_min = 1;
	}
	if ($niveau_max>40) {
		$niveau_max = 40;
	}
	?>
	<?php echo $nom_batiment; ?>
	<table border="0" bgcolor="" width="">
   <tr valign="top">
	<td style="width:">
	<table border="0" bgcolor=""width="120">
   <tr>
	<td style="width:"><img src="../<?php echo $chemin_image;?>"></td>
  </tr>
  <tr>
	<td style="width:"><?php echo $description_batiment; ?></td>
	</tr>
</table>
		</td>
 	<td style="width:">
	<table border="0" bgcolor="" width="">
   <tr>
	<td style="width:">
	<table border="0">
	<tr>
		<td>Niveau :</td>
		<td><?php echo$col2titre;?></td>
	</tr>
	<?
  
  
  
	while ($niveau_min<$niveau_max) {
	


		$col21 = ($Y*pow($Z,$niveau_min));
		$col2 = number_format(floor($col21) , 0, ' ', ' ');

		
		?>
		<tr>
			<td><?php if ($niveau_min==$niveau) {$tot = (int)$col21; echo "<font color=#FF0000>$niveau_min</font>";} else { echo $niveau_min; }?></td>
			<td><?php echo $col2 ;?></td>
		</tr>
		
		<?
		$niveau_min++;
	}
	?></table></td>
   </tr>
</table>
	 </td>
	</tr>
</table>
<p>
<?php if ($Batiment_selectione != "Batiment_06") echo "En tout vous produisez donc :  ".$tot * $nb_planetes . "/h au niveau " . $niveau . " avec " . $nb_planetes . " planete(s)"; ?>
 <FORM>
<INPUT TYPE="BUTTON" VALUE="Fermer la fen&ecirc;tre" ONCLICK="window.close()">
</FORM></p><br />
	<?
}



?>
