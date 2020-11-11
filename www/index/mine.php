<script>
function ouvrirfenetre() {
exemple=window.open ("","fenetreimage", "width=400,height=515,scrollbars=yes, toolbar=no, location=no, directories=no, status=no")
}
</script>
<?php

require_once ("include/batiment.php");


if (isset($_POST['mine'])) {

	mysql_query("DELETE FROM sg_mine WHERE `id_joueur`='".$id_joueur."' AND prior!='0';") OR DIE ("DELETE FROM sg_mine WHERE `id_joueur`='".$id_joueur."' AND prior!='0';");

	$mine = $_POST['mine'];
	$count = count($mine);
	
$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_mine WHERE `id_joueur`='".$id_joueur."' AND `prior`='0';");
$donnees = mysql_fetch_array($retour);
$nombre = $donnees['nbre_entrees'];

if ($nombre == 1)
{
	for ($i = 0; $i < $count; $i++)
	{
		mysql_query("INSERT INTO sg_mine (id, id_ress, prior, id_joueur) VALUES ('','".$mine[$i]."', '".($i+1)."', '".$id_joueur."')")
		or die("Rat&eacute;1");
	}
} 
else 
{
	for ($i = 0; $i < $count; $i++)
	{
		mysql_query("INSERT INTO sg_mine (id, id_ress, prior, id_joueur) VALUES ('','".$mine[$i]."', '".$i."', '".$id_joueur."')")
		or die("Rat&eacute;1");
	}
}

$reponse = mysql_query("SELECT * FROM sg_mine WHERE `id_joueur`='" . $id_joueur ."' AND `prior`='0'");
$reponse = mysql_fetch_array($reponse);
$id_ress = $reponse['id_ress'];


if ($nombre == 0)
{
	$reponse_construction = mysql_query("SELECT * FROM sg_construction WHERE pseudo='$pseudo'");
	$donnees_construction = mysql_fetch_array($reponse_construction);
	$niveau= $donnees_construction[id_to_name_ress3($id_ress)];
		
	mysql_query ("UPDATE sg_construction SET timeend='".(time()+temps_creation_mine($niveau, id_to_coef($id_ress)))."' WHERE pseudo='".$pseudo."'")
	or die("UPDATE sg_construction SET timeend='".(time()+temps_creation_mine($niveau, id_to_coef($id_ress)))."' WHERE pseudo='".$pseudo."'");
}

}
?>


<table border="1" cellpadding="0" cellspacing="0" height="50" width="570">

<?php

$reponse = mysql_query("SELECT * FROM sg_batiment");	
										
		function format_sec ($temps) {
        	$jours = floor($temps / (3600*24));
			$heures = floor(($temps - ($jours * 86400)) / 3600);
			$minutes = floor(($temps - ($jours * 86400) - ($heures * 3600)) / 60);
        	$secondes = $temps - ($jours * 86400) - ($heures * 3600) - ($minutes * 60);

        	if (($jours == 0) AND ($heures == 0)) { return $minutes.' Min '.(int)$secondes.' Sec'; }
        	if (($jours == 0) AND ($heures == 0) AND ($minutes == 0)) { return (int)$secondes.'Sec'; }
        	if (($jours == 0) AND ($heures !== 0)) {return $heures.' Heures '.$minutes.' Min '.(int)$secondes.' Sec'; }
        	if (($jours !== 0) AND ($heures !== 0)) return $jours.' Jours '.$heures.' Heures '.$minutes.' Min '.(int)$secondes.' Sec';
		}
		
while ($donnees = mysql_fetch_array($reponse) ) {
	$id= $donnees['id'];
	$nom_batiment= $donnees['nom_batiment'];
	$chemin_image= $donnees['chemin_image'];
	$description_batiment= $donnees['description_batiment'];
	
	// On r&eacute;cup&egrave;re le nom du batiment en version courte
	// ex : on r&eacute;cup&egrave;re "fer" pour "Technologie de l'extraction du minerais de fer"
	// Cela permettra de faire la requ&egrave;te SQl du niveau. on r&eacute;cup&egrave;re le chiffre dans la case "fer"
	if ($id < 10) {
		$Batiment_selectione="Batiment".'_'.'0'."$id";	
	} else {
		$Batiment_selectione="Batiment".'_'."$id";	
	}
	$Nom_batiment= $batiment_liste["$Batiment_selectione"][0];
	
	// on r&eacute;cup&egrave;re le niveau du batiment.
	$reponse_construction = mysql_query("SELECT * FROM sg_construction WHERE pseudo='$pseudo'");
	$donnees_construction = mysql_fetch_array($reponse_construction);
	$niveau= $donnees_construction["$Nom_batiment"];
	// Niveau du batiment +1. (pour marquer : Agrandir au Niveau 12 (pour un niv de 11 construit)
	$niveau_2=$niveau+1;
	$niveau_3=$niveau-1;
	
	$niveau_array[] = $niveau;
	// Cout total des mines
	// $Y * $Z^($niveau-1)
	// $Y = multiplicateur
	// $Z = elevateur
	$multiplicateur= $batiment_liste["$Batiment_selectione"][1];
	$elevateur= $batiment_liste["$Batiment_selectione"][2];	
	$cout_total = floor($multiplicateur*pow($elevateur,($niveau-1)));
	
	?>

												
	<tr>
		<td style="width:100">
<a href="index/popup.php?page=descrtech&batiment=<?php echo $Batiment_selectione; ?>" target="fenetreimage" onclick="ouvrirfenetre()" ><img border="0" src="<?php echo  $chemin_image; ?>" alt="" width="100"></a></td>
		<td style="width:430xp"><b><?php echo $nom_batiment; ?> (Niveau : <?php echo $niveau; ?>)</b><br />
		<?php echo $description_batiment; ?><br />
		
    <?php
    if ($niveau <40) {
      ?>
  		<b>Temps n&eacute;cessaire :</b>
  		<?
  		$i=0;
  		$entree=0;
  		$coef_directeur = $batiment_liste["$Batiment_selectione"][5];
  		$temps_necessaire = temps_creation_mine($niveau, $coef_directeur);
  		$temps_necessaire_format = format_sec ($temps_necessaire);

  		echo $temps_necessaire_format;
      
    }
		?>
		</td>
	</tr>									
	<?
}

?></table>
<?php
for ($i = 0; $i < count($niveau_array); $i++)
	{
		echo '<input type="hidden" id="mine_'.$i.'" value="'.$niveau_array[$i].'" />';
	}













////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
?>
<script type="text/javascript">
<!--

function del()
{
	document.getElementById("liste").options[document.getElementById("liste").options.selectedIndex]=null;
	
  count = document.getElementById("liste").options.length;
	for (i = 0; i < count; i++)
		{
		id = (i+1);
		if ((i+1) < 100) id = '.' + (i+1);
		if ((i+1) < 10) id = '..' + (i+1);
		document.getElementById("liste").options[i].text = document.getElementById("liste").options[i].text.replace(document.getElementById("liste").options[i].text.substring(0,3), id);
		}
}

function bulle(i)
{
	(Affbulle2('<h2>Actions :</h2><ul><li class="a" onClick="del('+i+');"><a>Supprimer</a></li><li class="a" onClick="up('+i+');"><a>Monter</a></li><li onClick="down('+i+');" class="a"><a>Descendre</a></li></ul>'));
}
function format_sec (temps) {
			jours = Math.floor(temps / (3600*24));
	heures = Math.floor((temps - (jours * 86400)) / 3600);
	minutes = Math.floor((temps - (jours * 86400) - (heures * 3600)) / 60);
			secondes = temps - (jours * 86400) - (heures * 3600) - (minutes * 60);

			if ((jours == 0) && (heures == 0)) return (minutes + " Min "+parseInt(secondes)+ " Sec"); 
			if ((jours == 0) && (heures == 0) && (minutes == 0)) return (parseInt(secondes)+" Sec"); 
			if ((jours == 0) && (heures !== 0)) return (heures+" Heures "+minutes+" Min "+parseInt(secondes)+" Sec"); 
			if ((jours !== 0) && (heures !== 0))	return (jours+" Jours "+heures+" Heures "+minutes+" Min "+parseInt(secondes)+  " Sec"); 
}
function valider()
{
  count = document.getElementById("liste").options.length;

  for (i = 0; i < count; i++) 
	{
		value = document.getElementById("liste").options[i].value;
		document.getElementById("input").innerHTML += '<input type="hidden" name="mine[]" value="'+value+'" />';
  }
	
	document.getElementById("form").submit();
}

function id_to_coef(id)
{
<?php
echo 'coef = [';
for ($i = 0; $i < count($coef_dir); $i++)
	{
		echo $coef_dir[$i].',';
	}
echo "0];\n";
?>

return (coef[id]);
}

function temps_creation_mine(niveau, coef_directeur) {
  if (niveau ==  0) niveau = 0.5;
  temps = parseInt(coef_directeur * niveau);
  
  return temps;
}

function ajouter(nom1, nom2) {

var mine = 1;

  count = document.getElementById("liste").options.length;

  for (i = 0; i < count; i++) 
	{
    if (document.getElementById("liste").options[i].value == nom2){
			mine++;
		}
  }
	
	count1 = parseInt(mine) + parseInt(document.getElementById("mine_"+nom2).value);
	
	id = (count+1);
	if ((count+1) < 100) id = '.' + (count+1);
	if ((count+1) < 10) id = '..' + (count+1);
	
  document.getElementById("liste").options[count] = new Option(id + " : " + nom1 + " - Monter au niveau " + count1 +" ( "+ format_sec(temps_creation_mine(count1, id_to_coef(nom2))) + " )", nom2);
	
}
var Obj=null;

function Deplacer(sens){
    if(Obj==null){return false;};
    var OptionSel= Obj.selectedIndex;

switch (true){
    case ( Obj.length == -1 & sens==-1):
        alert('Pas de mines &agrave; d&eacute;placer');
        break;
    case(OptionSel== -1):
        alert('Selectionnez une mine &agrave; d&eacute;placer');
        break;
    case(Obj.length==0):
        alert('Il n\'y a qu\'une mine \!');
        break;
    case(OptionSel== 0 && sens==-1):
        alert('La premi&egrave;re mine ne peut &ecirc;tre d&eacute;plac&eacute;e');
        break;

   case(OptionSel== Obj.length-1 && sens==1):
        alert('La mine option ne peut &ecirc;tre d&eacute;plac&eacute;e');
         break;

    case(sens==-1):
        // Ce code est le code qui est appel&eacute; lorque l'on veut remonter une
		//		option dans la liste
        // On m&eacute;morise dans des variables le texte et les valeurs des &eacute;l&eacute;ments
		// 		que l'on d&eacute;place.
        // Il suffit ensuite d'&eacute;changer les deux &eacute;l&eacute;ments
        var moveText1 = Obj[OptionSel-1].text;
        var moveText2 = Obj[OptionSel].text;
        var moveValue1 = Obj[OptionSel-1].value;
        var moveValue2 = Obj[OptionSel].value;

        // Echange des &eacute;l&eacute;ments
        Obj[OptionSel].text = moveText1;
        Obj[OptionSel].value = moveValue1;
        Obj[OptionSel-1].text = moveText2;
        Obj[OptionSel-1].value = moveValue2;
				
				var machaine = Obj[OptionSel-1].text.substring(1,3);
				machaine = machaine.replace(".", "");
				
				var machaine2 = Obj[OptionSel].text.substring(1,3);
				machaine2 = machaine2.replace(".", "");
				
				if ((parseInt(machaine) < 100) && ( parseInt(machaine) >= 10)) {
					if ((( parseInt(machaine)-1) < 100) && (( parseInt(machaine)-1) >= 10)) {
						Obj[OptionSel-1].text = Obj[OptionSel-1].text.replace("." + parseInt(machaine), "."+(parseInt(machaine)-1));
						Obj[OptionSel].text = Obj[OptionSel].text.replace("." + parseInt(machaine2), "."+(parseInt(machaine2)+1));

					} else if (( parseInt(machaine)-1) < 10){
						Obj[OptionSel-1].text = Obj[OptionSel-1].text.replace("." + parseInt(machaine), ".."+(parseInt(machaine)-1));
						Obj[OptionSel].text = Obj[OptionSel].text.replace(".." + parseInt(machaine2), "."+(parseInt(machaine2)+1));
					}
				} else if ( parseInt(machaine) < 10) {
						Obj[OptionSel-1].text = Obj[OptionSel-1].text.replace(".." + parseInt(machaine), ".."+(parseInt(machaine)-1));
						Obj[OptionSel].text = Obj[OptionSel].text.replace(".." + parseInt(machaine2), ".."+(parseInt(machaine2)+1));
				}


        Obj.selectedIndex = OptionSel-1;
        break;
				

   case(sens==1):
         // On proc&egrave;de de la m&ecirc;me mani&egrave;re que pour faire monter une option.
         // La diff&eacute;rence, c que dans ce cas, on prend en compte l'option suivante,
		 // 	et non la pr&eacute;cedente comme auparavant
         var moveText1 = Obj[OptionSel].text;
         var moveText2 = Obj[OptionSel+1].text;
         var moveValue1 = Obj[OptionSel].value;
         var moveValue2 = Obj[OptionSel+1].value;
         Obj[OptionSel].text = moveText2;
         Obj[OptionSel].value = moveValue2;
         Obj[OptionSel+1].text = moveText1;
         Obj[OptionSel+1].value = moveValue1;
				 
				var machaine = Obj[OptionSel+1].text.substring(1,3);
				machaine = machaine.replace(".", "");

				var machaine2 = Obj[OptionSel].text.substring(1,3);
				machaine2 = machaine2.replace(".", "");
				if ((( parseInt(machaine)) < 100) && (( parseInt(machaine)) >= 10)) {
					if ((( parseInt(machaine)+1) < 100) && (( parseInt(machaine)+1) >= 10)) {
						Obj[OptionSel+1].text = Obj[OptionSel+1].text.replace("." + parseInt(machaine), "."+(parseInt(machaine)+1));
						Obj[OptionSel].text = Obj[OptionSel].text.replace("." + parseInt(machaine2), "."+(parseInt(machaine2)-1));
					} else if (( parseInt(machaine)+1) < 10){
						Obj[OptionSel+1].text = Obj[OptionSel+1].text.replace("." + parseInt(machaine), ".."+(parseInt(machaine)+1));
						Obj[OptionSel].text = Obj[OptionSel].text.replace(".." + parseInt(machaine2), "."+(parseInt(machaine2)-1));
					}
				} else if (parseInt(machaine) < 10) {
					if ((parseInt(machaine)+1) < 10)
						{
							Obj[OptionSel+1].text = Obj[OptionSel+1].text.replace(".." + parseInt(machaine), ".."+(parseInt(machaine)+1));
							Obj[OptionSel].text = Obj[OptionSel].text.replace(".." + parseInt(machaine2), ".."+(parseInt(machaine2)-1));
						}
					else
						{
							Obj[OptionSel+1].text = Obj[OptionSel+1].text.replace(".." + parseInt(machaine), "."+(parseInt(machaine)+1));
							Obj[OptionSel].text = Obj[OptionSel].text.replace("." + parseInt(machaine2), ".."+(parseInt(machaine2)-1));
						}
				}
				
         Obj.selectedIndex = OptionSel+1;
         break;
    }
}

var action_mine = '<input type="button" name="up" id="up" value="Monter" onClick="Deplacer(-1);" style="width:80px"/><br/><br/> <input type="button" name="down" id="down" value="Descendre" onClick="Deplacer(1);" style="width:80px"/><br/><br/> <input type="button"  value="Supprimer" onClick="del();" style="width:80px"/>';
//-->
</script>
<?php

function id_to_name_ress($id) {
	$name === false;
	if ($id == 0) $name = 'Fer';
	if ($id == 1) $name = 'Carbone';
	if ($id == 2) $name = 'Or';
	if ($id == 3) $name = 'Naquada';
	if ($id == 4) $name = 'Trinium';
	if ($id == 5) $name = 'Architecture';
	
	return ($name);
}
function id_to_name_ress2($id) {
	$name === false;
	if ($id == 0) $name = 'Fer...............';
	if ($id == 1) $name = 'Carbone.......';
	if ($id == 2) $name = 'Or................';
	if ($id == 3) $name = 'Naquada.......';
	if ($id == 4) $name = 'Trinium.........';
	if ($id == 5) $name = 'Architecture..';
	
	return ($name);
}
echo '<form method="post" action="accueil.php?page=mine" id="form">';

$reponse = mysql_query("SELECT * FROM sg_construction WHERE `pseudo`='" . $pseudo ."'");
$reponse = mysql_fetch_array($reponse);
$time_end = $reponse['timeend'];

$reponse = mysql_query("SELECT * FROM sg_mine WHERE `id_joueur`='" . $id_joueur ."' AND `prior`='0'");
$reponse = mysql_fetch_array($reponse);


if (is_numeric($reponse["id_ress"])) {
	$niveau_array[$reponse["id_ress"]]++;
	echo '<div style="width:500px;float:left;padding-left:20px;padding-top:20px;">'
	     .'Recherche en cours : <b>' . id_to_name_ress($reponse["id_ress"]) . '</b>, niveau <b>'. $niveau_array[$reponse["id_ress"]] .'</b>. Temps restant : <b>' . format_sec($time_end - time()).'</b>'
	     .'</div>';
} else {
	echo '<div style="width:500px;float:left;padding-left:20px;padding-top:20px;">'
	     .'Aucune recherche en cours'
	     .'</div>';
}
		 echo '<div style="width:430px;float:left;padding-left:20px;padding-top:20px;">'
     .'<select size="10" style="width:430px;" name="liste" id="liste" onClick="Obj=this;document.getElementById(\'actions\').innerHTML = action_mine;">';
		 

		 
		 
$reponse = mysql_query("SELECT * FROM sg_mine WHERE `id_joueur`='" . $id_joueur ."' AND `prior`!='0' ORDER BY `prior`");
$i = 0;
while ($donnees = mysql_fetch_array($reponse) ) {
	$i++;
	$id_ress = $donnees['id_ress'];
		$niveau_array[$id_ress]++;
		
		$i2 = $i;
		if ($i < 100) $i2 = "." . $i;
		if ($i < 10) $i2 = ".." . $i;
	echo '<option value="'.$id_ress.'">'.$i2 . ' : ' . ucfirst(id_to_name_ress2($id_ress)).' - Monter au niveau '.$niveau_array[$id_ress]. ' ( '. format_sec(temps_creation_mine($niveau_array[$id_ress], id_to_coef($id_ress))) . ' )</option>';
}
echo '</select>'
     .'</div>';

echo '<div style="width:100px;float:left;padding-left:10px;padding-top:50px;text-align:center;font-weight:bold;" id="actions">'
     .'Veuillez s&eacute;l&eacute;ctionner une mine.'
     .'</div>';
echo '<div style="text-align:left;width:300px;float:left;padding-left:20px;padding-top:10px;">'
     .'<div class="a" onClick="ajouter(\'Fer...............\', \'0\');">Monter la mine de fer</div>'
     .'<div class="a" onClick="ajouter(\'Carbone.......\', \'1\');">Monter la mine de carbone</div>'
     .'<div class="a" onClick="ajouter(\'Or................\', \'2\');">Monter la mine d&apos;or</div>'
     .'<div class="a" onClick="ajouter(\'Naquada.......\', \'3\');">Monter la mine de naquada</div>'
     .'<div class="a" onClick="ajouter(\'Trinium.........\', \'4\');">Monter la mine de trinium</div>'
     .'<div class="a" onClick="ajouter(\'Architecture..\', \'5\');">Monter la technologie architecturale</div>'
     .'</div>';
echo '<div style="width:100px;float:left;padding-left:10px;padding-top:50px;text-align:center;font-weight:bold;" id="actions">'
     .'<input type="button" onClick="valider();" value="Valider les changements">'
     .'</div>';
echo '<div id="input"></div>';
		 
echo '</form>';
?>
