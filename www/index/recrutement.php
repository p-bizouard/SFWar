<script type="text/javascript">
/* Made by Mathias Bynens <http://mathiasbynens.be/> */
function number_format(a, b, c, d) {
 a = Math.round(a * Math.pow(10, b)) / Math.pow(10, b);
 e = a + '';
 f = e.split('.');
 if (!f[0]) {
  f[0] = '0';
 }
 if (!f[1]) {
  f[1] = '';
 }
 if (f[1].length < b) {
  g = f[1];
  for (i=f[1].length + 1; i <= b; i++) {
   g += '0';
  }
  f[1] = g;
 }
 if(d != '' && f[0].length > 3) {
  h = f[0];
  f[0] = '';
  for(j = 3; j < h.length; j+=3) {
   i = h.slice(h.length - j, h.length - j + 3);
   f[0] = d + i +  f[0] + '';
  }
  j = h.substr(0, (h.length % 3 == 0) ? 3 : (h.length % 3));
  f[0] = j + f[0];
 }
 c = (b <= 0) ? '' : c;
 return f[0] + c + f[1];
}

function refresh_ress(r1, r2, r3, r4, r5, r6)
{
  document.getElementById("fer").innerHTML = number_format(r1, 0, ',', ' ');
  document.getElementById("carbone").innerHTML = number_format(r2, 0, ',', ' ');
  document.getElementById("or").innerHTML = number_format(r3, 0, ',', ' ');;
  document.getElementById("naquada").innerHTML = number_format(r4, 0, ',', ' ');
  document.getElementById("trinium").innerHTML = number_format(r5, 0, ',', ' ');
  document.getElementById("population").innerHTML = number_format(r6, 0, ',', ' ');
}
</script>
<!-- Utilis&eacute; par l'ajax pour l'afficage des erreurs -->
<div id="message"></div>
<?

$pass = mysql_fetch_array(mysql_query("SELECT pass FROM sg_perso WHERE id=".mysql_real_escape_string($id_joueur)));
$pass = $pass['pass'];


// Par d&eacute;faut le les conditions du test sont bonnes. On va le mettre false si une ne l'est plus.
$test = true;

// Si une plan&egrave;te n'a pas de nom -> Erreur
$reponse_sg_planete_comm = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo'");	
while ($donnees_sg_planete_comm = mysql_fetch_array($reponse_sg_planete_comm)) 
{
	$nom = $donnees_sg_planete_comm['nom'];
	if ($nom == "")
	{
		$test = false;
	}
}

// Si tout est bon, alors on g&egrave;re le recrutement.
if ($test)
	{
	// Fichier de configuration de l'ensemble des unit&eacute;s du jeu avec les caract&eacute;ristiques.
	require("include/units.php");


		$reponse = mysql_query("SELECT * FROM  sg_perso WHERE pseudo='$pseudo'");
		$donnees = mysql_fetch_array($reponse);
		$race=$donnees['race'];
		
		//////////////////////SPATIAL/////////////////////////////////////////////////////////////////////////////
		$liste_spatial = ${'liste_'.$race}; 	// $liste_tauri = array( 'F-16', 'X-301', ...		
		$vaisseaux = ${'vaisseaux_'.$race}; 	//c'est les caract&eacute;ristiques de tous les vaisseaux	
		$nb_spatial = count($liste_spatial);	// c'est pour savoir combien il y a de nombre de vaisseaux diff	
		//////////////////////////////////////////////////////////////////////////////////////////////////////////
			
		//////////////////////TERRESTRE///////////////////////////////////////////////////////////////////////////
		$liste_terrestre = ${'liste_terrestre_'.$race};// $liste_terrestre_tauri = array( 'H&K MP-5', 'P90',...	
		$terrestre = ${'terrestre_'.$race}; //c'est les caract&eacute;ristiques de tous les terr.		
		$nb_terrestre = count($liste_terrestre);// c'est pour savoir combien il y a de nombre de terr. dif
		//////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

		<script type="text/javascript">
<!--
var xhr = null; 

function getXhr(){
	if(window.XMLHttpRequest) // Firefox et autres
	   xhr = new XMLHttpRequest(); 
	else if(window.ActiveXObject){ // Internet Explorer 
	   try {
			 xhr = new ActiveXObject("Msxml2.XMLHTTP");
		  } catch (e) {
			 xhr = new ActiveXObject("Microsoft.XMLHTTP");
		  }
	}
	else { // XMLHttpRequest non support&eacute; par le navigateur 
	   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
	   xhr = false; 
	} 
}


function go(){
	getXhr();
	// On d&eacute;fini ce qu'on va faire quand on aura la r&eacute;ponse
	xhr.onreadystatechange = function(){
		// On ne fait quelque chose que si on a tout re&ccedil;u et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			result = xhr.responseText;
			
				document.getElementById("message").innerHTML = result;
		}
	}

	
	// Ici on va voir comment faire du post
	xhr.open("post","index/recrutement_verif.php",true);
	// ne pas oublier &ccedil;a pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

	var aenvoyer = "pseudo=<?php echo jsencode($pseudo); ?>&value=<?php echo $pass; ?>";
<?
	for ($i=0;$i<$nb_spatial;$i++)
	{
		echo 'aenvoyer = aenvoyer+"&vaisseau_'.$i.'="+document.recrutement.vaisseau' . $i. '.value;' . "\n\r"; 
	}
	for ($i=0;$i<$nb_terrestre;$i++)
	{
		echo 'aenvoyer = aenvoyer+"&terrestre_'.$i.'="+document.recrutement.terrestre' . $i. '.value;' . "\n\r"; 
	}
?>
	xhr.send(aenvoyer);
}



function go2(){
	getXhr();
	// On d&eacute;fini ce qu'on va faire quand on aura la r&eacute;ponse
	xhr.onreadystatechange = function(){
		// On ne fait quelque chose que si on a tout re&ccedil;u et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			result = xhr.responseText;
			if (result == '')
				document.recrutement.submit();
			else
				document.getElementById("message").innerHTML = result;
		}
	}

	
	// Ici on va voir comment faire du post
	xhr.open("post","index/recrutement_verif.php",true);
	// ne pas oublier &ccedil;a pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

	var aenvoyer = "pseudo=<?php echo jsencode($pseudo); ?>&value=<?php echo $pass; ?>";
<?
	for ($i=0;$i<$nb_spatial;$i++)
	{
		echo 'aenvoyer = aenvoyer+"&vaisseau_'.$i.'="+document.recrutement.vaisseau' . $i. '.value;' . "\n\r"; 
	}
	for ($i=0;$i<$nb_terrestre;$i++)
	{
		echo 'aenvoyer = aenvoyer+"&terrestre_'.$i.'="+document.recrutement.terrestre' . $i. '.value;' . "\n\r"; 
	}
?>
	xhr.send(aenvoyer);
}

    





-->

</script>


<?
	if (isset($_POST['hidden'])) //ca doit &ecirc;tre le login cript&eacute; en md5, c'est juste pour voir si le formulaire a &eacute;t&eacute; envoy&eacute; (non gueust, pas tapp&eacute;, pas tapp&eacute;, nooon ! aie aie ouille! -> Mouais, c'est bien parceque c'est toi
	{


		// On va chercher les ressources du joueur
		$reponse 	= mysql_query("SELECT * FROM sg_ressource WHERE pseudo='$pseudo'"); 
		$donnees 	= mysql_fetch_array($reponse);
		$ress_fer 	= $donnees['fer'];
		$ress_carbone 	= $donnees['carbone'];
		$ress_or 	= $donnees['or'];
		$ress_naquada 	= $donnees['naquada'];
		$ress_trinium 	= $donnees['trinium'];
		$ress_pop	= $donnees['population'];	
		
		////////////////////////////////////////
		//Juste pour pas m&eacute;langer les variables
		////////////////////////////////////////
		$ress_rest_fer 		= $ress_fer;
		$ress_rest_carbone 	= $ress_carbone;
		$ress_rest_or 		= $ress_or;
		$ress_rest_naquada 	= $ress_naquada;
		$ress_rest_trinium 	= $ress_trinium;
		$ress_rest_pop 		= $ress_pop;	
		//////////////////////////////////////
		
		$test = "true"; //Initialisation
		
		for ($i=0;$i<$nb_spatial;$i++)
		{
			@$achat[] = $_POST["vaisseau".$i];
			//c'est le nombre de vaisseau de type $i achet&eacute;
			
			if (!empty($achat[$i])) //si au moins un champ a &eacute;t&eacute; rempli
			{
				if(is_numeric($achat[$i]))//On v&eacute;rifie qu'il s'agit d'un nombre
				{
					$achat2[$i] = floor($achat[$i]);//on arondi, d&egrave;s fois qu'un malin veuille qu'une moiti&eacute; de vaisseau
					
					// Calcule des couts pour cette achat
					$cout_fer 	= ($vaisseaux[$liste_spatial[$i]]['Fer']) * $achat2[$i];
					$cout_carbone 	= ($vaisseaux[$liste_spatial[$i]]['Carbone']) * $achat2[$i];
					$cout_or 	= ($vaisseaux[$liste_spatial[$i]]['Or']) * $achat2[$i];
					$cout_naquada  	= ($vaisseaux[$liste_spatial[$i]]['Naquada']) * $achat2[$i];
					$cout_trinium 	= ($vaisseaux[$liste_spatial[$i]]['Trinium']) * $achat2[$i];
					$cout_pop 	= ($vaisseaux[$liste_spatial[$i]]['Population']) * $achat2[$i];
					
					//ress-rest est mis &agrave; jour a chaque fois qu'il y a un vaisseau diff&eacute;rent
					$ress_rest_fer 		= $ress_rest_fer - $cout_fer;
					$ress_rest_carbone 	= $ress_rest_carbone - $cout_carbone;
					$ress_rest_or  		= $ress_rest_or  - $cout_or ;
					$ress_rest_naquada 	= $ress_rest_naquada - $cout_naquada;
					$ress_rest_trinium 	= $ress_rest_trinium - $cout_trinium;
					$ress_rest_pop 		= $ress_rest_pop - $cout_pop;
					
				}
				else
				{
				echo '<p class="erreur">Merci de choisir un nombre r&eacute;el pour les vaisseaux : ' . $liste_spatial[$i] . '</p>';
				$test = "false";
				}
				
			}
			
		}
		if ($ress_rest_fer < "0") { echo '<p class="erreur">Vous ne poss&eacute;dez pas sufisament de fer ( '. number_format($ress_rest_fer, 0, ' ', ' ') . ').</p>'; $test = "false"; }
		if ($ress_rest_carbone < "0") { echo '<p class="erreur">Vous ne poss&eacute;dez pas sufisament de carbone ( '. number_format($ress_rest_carbone, 0, ' ', ' ') . ').</p>'; $test = "false"; }
		if ($ress_rest_or < "0") { echo '<p class="erreur">Vous ne poss&eacute;dez pas sufisament de or ( '. number_format($ress_rest_or, 0, ' ', ' ') . ').</p>'; $test = "false"; }
		if ($ress_rest_naquada < "0") { echo '<p class="erreur">Vous ne poss&eacute;dez pas sufisament de naquada ( '. number_format($ress_rest_naquada, 0, ' ', ' ') . ').</p>'; $test = "false"; }
		if ($ress_rest_pop < "0") { echo '<p class="erreur">Vous ne poss&eacute;dez pas sufisament de population civile ( '. number_format($ress_rest_pop, 0, ' ', ' ') . ').</p>'; $test = "false"; }
		
		if ($test == "true") //SI tout est impec
		{
			$id_plapla = $_POST['plapla']; //champ hidden, c'ets l'id de la plapla
			for ($i=0;$i<$nb_spatial;$i++)
			{
				if (!empty($achat[$i]))
				{
					$y = $i;
	              
						
						$select = "SELECT * FROM sg_planete_units WHERE type=".$i." AND id_planete='$id_plapla'";
	                    $resselect = @mysql_query ($select);					
						
						if (!mysql_num_rows($resselect))
	                       {
							
	                          mysql_query("INSERT INTO sg_planete_units (id, id_joueur, id_planete, type, nombre, unit) VALUES ('','$id_joueur', '$id_plapla', '$i', '$achat2[$i]', 'spatial')")
	                          or die ("<p align=center>Echec Insert</p>");
								echo '<div id="suppr" class="visible"><p>Vous avez achet&eacute; ' . $achat2[$i] . ' ' . $liste_spatial[$i] . '</p></div>';
	                       }
	                    else
	                       {
	                          mysql_query ("UPDATE sg_planete_units SET nombre=nombre + $achat2[$i] WHERE type=".$i." AND unit='spatial' AND id_planete='$id_plapla'")
							  or die ("<p align=center>Echec Update</p>");
								echo '<div id="suppr" class="visible"><p>Vous avez achet&eacute; ' . $achat2[$i] . ' ' . $liste_spatial[$i] . '</p></div>';
	                       }
					echo "<script type=\"text/javascript\">refresh_ress($ress_rest_fer, $ress_rest_carbone, $ress_rest_or, $ress_rest_naquada, $ress_rest_trinium, $ress_rest_pop);</script>";
					mysql_query ("UPDATE sg_ressource SET fer=$ress_rest_fer, `or`=$ress_rest_or, carbone=$ress_rest_carbone, naquada=$ress_rest_naquada, trinium=$ress_rest_trinium, population=$ress_rest_pop WHERE pseudo='$pseudo'")
					or die ("<p align=center>Echec Update2</p>");
					
						//Ici c'est pour l'affichage &agrave; droite des ressources (mise &agrave; jour)
						//////////////////////////////////////////////////
						///////////////comptage resources ////////////////
						$fer = number_format($ress_rest_fer, 0, ' ', ' ');
						$carbone = number_format($ress_rest_carbone, 0, ' ', ' ');
						$or = number_format($ress_rest_or, 0, ' ', ' ');
						$naquada = number_format($ress_rest_naquada, 0, ' ', ' ');
						$trinium = number_format($ress_rest_trinium, 0, ' ', ' ');
						if ($ress_rest_pop > $immeuble) $population= "<font color=#FF0000>".number_format($ress_rest_pop, 0, ' ', ' ')."</font>";
						else $population = number_format($ress_rest_pop, 0, ' ', ' ');
						//////////////comptage resources fin//////////////
						//////////////////////////////////////////////////
			
				}
			}
			


			
		}
		
		
		
		
		//////////////////////////////////////////////////////////////////////////////////
		/*
		
		
											Spacial
		
		
		
											Terrestre
		
		
		*/ 
		//////////////////////////////////////////////////////////////////////////////////
		
		
		
	$test2 = "false";
		
		
	for ($i=0;$i< $nb_terrestre;$i++)
		{
		
			@$achat_terrestre[] = $_POST["terrestre".$i];
			//c'est le nombre de vaisseau de type $i achet&eacute;
			
			if (!empty($achat_terrestre[$i])) //si au moins un champ a &eacute;t&eacute; rempli
			{
				if(is_numeric($achat_terrestre[$i]))//On v&eacute;rufue qu'il s'agit d'un nombre
				{
					$achat2_terrestre[$i] = floor($achat_terrestre[$i]);//on arondi, d&egrave;s fois qu'un malin veuille qu'une moiti&eacute; de vaisseau
						
					
					$cout_or 		= ($terrestre[$liste_terrestre[$i]]['Or']) * $achat2_terrestre[$i];
					$cout_pop 		= ($terrestre[$liste_terrestre[$i]]['Population']) * $achat2_terrestre[$i];
					
					//ress-rest est mis &agrave; jour a chaque fois qu'il y a un vaisseau diff&eacute;rent
				
					$ress_rest_or  		= $ress_rest_or  - $cout_or ;
					$ress_rest_pop 		= $ress_rest_pop - $cout_pop;
					
					$test2 = "true";
				}
				else
				{
				echo '<p class="erreur">Merci de choisir un nombre r&eacute;el pour les unit&eacute;es terrestres suivantes : ' . $liste_terrestre[$i] . '</p>';
				$test = "false";
				}
				
			}
			
		}
		
		if ($test2 == "true")
		{
			if ($ress_rest_or < "0") { echo '<p class="erreur">Vous ne poss&eacute;dez pas sufisament d\'or (' . number_format($ress_rest_or, 0, ' ', ' ') . ').</p>'; $test = "false"; }
			if ($ress_rest_pop < "0") { echo '<p class="erreur">Vous ne poss&eacute;dez pas sufisament de population civile (' . number_format($ress_rest_pop, 0, ' ', ' ') . ').</p>'; $test = "false"; }
			
			if ($test == "true") //SI tout est impec
			{
				
				$id_plapla = $_POST['plapla']; //champ hidden, c'ets l'id de la plapla
				for ($i=0;$i<$nb_terrestre;$i++)
				{
					if (!empty($achat_terrestre[$i]))
					{
						$y = $i;
							
							$select = "SELECT * FROM sg_planete_units WHERE type=".$y." AND unit='terrestre' AND id_planete='$id_plapla'";
		                    $resselect = @mysql_query ($select);					
							
							if (!mysql_num_rows($resselect))
		                       {
								
		                          mysql_query("INSERT INTO sg_planete_units (id, id_joueur, id_planete, type, nombre, unit) VALUES ('','$id_joueur', '$id_plapla', '$y', '$achat2_terrestre[$i]', 'terrestre')")
		                          or die ("<p align=center>Echec Insert</p>");
									echo '<div id="suppr" class="visible"><p>Vous avez achet&eacute; ' . $achat2_terrestre[$i] . ' ' . $liste_terrestre[$i] . '</p></div>';
		                       }
		                    else
		                       {
		                          mysql_query ("UPDATE sg_planete_units SET nombre=nombre + $achat2_terrestre[$i] WHERE type=".$y." AND id_planete='$id_plapla' and unit='terrestre'")
								  or die ("<p align=center>Echec Update</p>");
									echo '<div id="suppr" class="visible"><p>Vous avez achet&eacute; ' . $achat2_terrestre[$i] . ' ' . $liste_terrestre[$i] . '</p></div>';
		                       }
					echo "<script type=\"text/javascript\">refresh_ress($ress_rest_fer, $ress_rest_carbone, $ress_rest_or, $ress_rest_naquada, $ress_rest_trinium, $ress_rest_pop);</script>";
					mysql_query ("UPDATE sg_ressource SET `or`=$ress_rest_or, population=$ress_rest_pop WHERE pseudo='$pseudo'")
					or die ("<p align=center>Echec Update2</p>");
					
							
					//Ici c'est pour l'affichage &agrave; droite des ressources (mise &agrave; jour)
					//////////////////////////////////////////////////
					///////////////comptage resources ////////////////
					$or = number_format($ress_rest_or, 0, ' ', ' ');
					if ($ress_rest_pop > $immeuble) 
					$population= "<font color=#FF0000>".number_format($ress_rest_pop, 0, ' ', ' ')."</font>";
					else $population = number_format($ress_rest_pop, 0, ' ', ' ');
					//////////////comptage resources fin//////////////
					//////////////////////////////////////////////////
						
					}
				}
			}


			
		}
	}

	$reponse = mysql_query("SELECT * FROM  sg_perso WHERE pseudo='$pseudo'");
	$donnees = mysql_fetch_array($reponse);
	$race=$donnees['race'];
	$liste_spatial = ${'liste_'.$race}; // $liste_tauri = array( 'F-16', 'X-301', 'F-302', 'Prom&eacute;th&eacute; (BC-303)', 'D&eacute;dale (BC-304)', 'Odyss&eacute; (DSC-304)', 'Jumper');
	$vaisseaux = ${'vaisseaux_'.$race}; //c'est les caract&eacute;ristiques de tous les vaisseaux
	$nb_spatial = count($liste_spatial);	// c'est pour savoir combien il y a de nombre de vaisseaux diff
	//print_rr($vaisseaux);

	if (empty($_SESSION['planete'])) {	// Session vide.

		if(!isset($HTTP_GET_VARS["planete"])) 
		{//vide. Rien en session ni en variable. Donc rien.
			$reponse = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo' ORDER BY nom LIMIT 1");
			$donnees = mysql_fetch_array($reponse);
			$nom = $donnees['nom'];
			$id_planete= $donnees['id'];
		}

	} 
	else 
	{// Session pleine
		$id_planete = $_SESSION["planete"];
									
									
		//////////////////////////////////////
		// on v&eacute;rifie que l'escouade existe	//
		//////////////////////////////////////
		$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE pseudo='$pseudo' AND id='$id_planete'");
		$donnees = mysql_fetch_array($retour);
		$nb_ligne = $donnees['nbre_entrees'];
				
		if ($nb_ligne==0) {
				$reponse = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo' ORDER BY nom LIMIT 1");
			$donnees = mysql_fetch_array($reponse);
			$nom = $donnees['nom'];
			$id_planete= $donnees['id'];
		}
							
		if(!isset($HTTP_GET_VARS["planete"])) {//vide. Quelque chose en session. rien en URL
			$reponse = mysql_query("SELECT * FROM sg_planete WHERE id='$id_planete' AND pseudo='$pseudo'");
			$donnees = mysql_fetch_array($reponse);	
			$nom = $donnees['nom'];
			$id_planete= $donnees['id'];
			
		}
		
	}

	if(isset($_GET["planete"])) {
			$id= urldecode($_GET["planete"]);	
			$reponse = mysql_query("SELECT * FROM sg_planete WHERE id='$id' AND pseudo='$pseudo'");
			$donnees = mysql_fetch_array($reponse);
			$nom = $donnees['nom'];
			$id_planete= $donnees['id'];
												
			// Mise en session du nom de l'escouade
			$_SESSION['planete'] = $id_planete;
	}
	?>
	<!-- DEBUT DU SCRIPT MENU DEROULANT-->
	<form NAME="menu">
										
	<div align="center">
										
	<p>
	Choix de la plan&egrave;te de recrutement :
										
	<select NAME="popup" onChange="change_site();" size="1">
			
	<?php

	echo $_SESSION['planete'];

	$reponse = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo'");
	while ($donnees = mysql_fetch_array($reponse)) 
	{
		$planete_nom = $donnees['nom'];
		$planete_id = $donnees['id'];

		?>
		<option <?php if ($planete_nom == $nom) echo " SELECTED "; ?>value="accueil.php?page=recrutement&planete=<?php echo urlencode($planete_id); ?>">-&nbsp;&nbsp;<?php echo $planete_nom; ?></option>
		<?php
	}
	?>
	</select>
											
	</p>
	</div>

	</form>
										
	<script>
	function change_site() {
		var site = document.menu.popup.selectedIndex;
		{
			window.location.href =
			document.menu.popup.options[site].value;
		}
	}
	</script>
	</p>
	<!-- FIN DU SCRIPT MENU DEROULANT-->
	<form method="post" action="accueil.php?page=recrutement" name="recrutement">
	<table border="0" cellpadding="4">
		<tr>
			<td>Nom</td>
			<td>Sur&nbsp;la&nbsp;plan&egrave;te</td>
			<td>En&nbsp;tout</td>
			<td>Fer</td>
			<td>Carbone</td>
			<td>Or</td>
			<td>Naquada</td>
			<td>Trinium</td>
			<td>Civils</td>
			<td>Achat</td>
		</tr>
	<?
	/*$reponse = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo' AND id='$id_planete'");
	$donnees = mysql_fetch_array($reponse);
	$id_plapla = $donnees['id'];*/


	// Mise en place du calcule du nombre d'unit&eacute; sur la plan&egrave;te et au total
	$reponse = mysql_query("SELECT * FROM sg_planete_units WHERE id_joueur='$id_joueur' AND id='$id_planete' ");
	$donnees = mysql_fetch_array($reponse);

	
	//////////////////////////////////////////////////////////////////////
 	// Mise &agrave; zero du nombre de vaisseaux et de terrestre sur la plan&egrave;te
	//////////////////////////////////////////////////////////////////////
	for ($i=0;$i < $nb_spatial;$i++) 				
	{		
		if (!isset($vaisseau_nombre_planete[$i]))
		$vaisseau_nombre_planete[$i] = "0";
	}	
	for ($i=0;$i < $nb_terrestre;$i++) 								
	{		
		if (!isset($terrestre_nombre_planete[$i]))
		$terrestre_nombre_planete[$i] = "0";
	}	
												
	// 1 - Par plapla
	//Pour le spatial
	$reponse_sg_planete_units = mysql_query("SELECT * FROM sg_planete_units WHERE id_joueur='$id_joueur' and unit='spatial' AND id_planete='$id_planete' ");
	while($donnees_sg_planete_units = mysql_fetch_array($reponse_sg_planete_units))
	{		
			$type_planete = $donnees_sg_planete_units['type'];
			$vaisseau_nombre_planete[$type_planete] = $donnees_sg_planete_units['nombre'];
	}
											

	//Pour le terrestre					
	$reponse_sg_planete_units = mysql_query("SELECT * FROM sg_planete_units WHERE id_joueur='$id_joueur' and unit='terrestre' AND id_planete='$id_planete' ");
	while($donnees_sg_planete_units = mysql_fetch_array($reponse_sg_planete_units))
	{
			$type_terrestre = ($donnees_sg_planete_units['type']);
			$terrestre_nombre_planete[$type_terrestre] = $donnees_sg_planete_units['nombre'];
	}
			
	
	/////////////////////////////////////////	
	// Initialisation de $nb_vaisseau_total 
	/////////////////////////////////////////	
	for ($i=0;$i < $nb_spatial;$i++)										
	{
		$nb_vaisseau_total[$i] = "0";												
	}																		

	for ($i=0;$i < $nb_terrestre;$i++)											
	{							
		$nb_terrestre_total[$i] = "0";		
	}																		
	//////////////////////////////////////////

	///////////////////////////////////////////////////////////////////////////////////
	// 2 - Au total
												
	for ($i=0;$i < $nb_spatial;$i++) 											
	{		
		$vaisseau_nombre_planete_total[$i] = "0";
	}	
				
	for ($i=0;$i < $nb_terrestre;$i++) 								
	{		
		$terrestre_nombre_planete_total[$i] = "0";
	}	
																			
	////////////////////////////////////////////////////////////////////////////////////				
	$reponse_sg_flotte_units = mysql_query("SELECT * FROM sg_flotte_units WHERE id_joueur='$id_joueur' AND unit='spatial'");
	
	while ($donnees_sg_flotte_units = mysql_fetch_array($reponse_sg_flotte_units)) 	
	{																		
		$type_flotte = $donnees_sg_flotte_units['type'];		
		$nb_vaisseau_total[$type_flotte] = $nb_vaisseau_total[$type_flotte] + $donnees_sg_flotte_units['nombre'];	
	}

	$reponse_sg_flotte_units = mysql_query("SELECT * FROM sg_flotte_units WHERE id_joueur='$id_joueur' AND unit='terrestre'");
	
	while ($donnees_sg_flotte_units = mysql_fetch_array($reponse_sg_flotte_units)) 	
	{															
		$type_terrestre = $donnees_sg_flotte_units["type"];
		@$nb_terrestre_total[$type_terrestre] = $nb_terrestre_total[$terrestre] + $donnees_sg_flotte_units["nombre"];		
	}	
	//////////////////////////////////////////////////////////////////////////////////////////

	$reponse_sg_planete_units_2 = mysql_query("SELECT * FROM sg_planete_units WHERE id_joueur='$id_joueur' AND unit='spatial'");			
	while ($donnees_sg_planete_units_2 = mysql_fetch_array($reponse_sg_planete_units_2)) 
	{											
		$type_flotte = $donnees_sg_planete_units_2['type'];			
		$nb_vaisseau_total[$type_flotte] = $nb_vaisseau_total[$type_flotte] + $donnees_sg_planete_units_2['nombre'];				
	}

	$reponse_sg_planete_units_2 = mysql_query("SELECT * FROM sg_planete_units WHERE id_joueur='$id_joueur'  AND unit='terrestre'");			
	while ($donnees_sg_planete_units_2 = mysql_fetch_array($reponse_sg_planete_units_2)) 
	{												
		$type_terrestre = $donnees_sg_planete_units_2['type'];			
		$nb_terrestre_total[$type_terrestre] = $nb_terrestre_total[$type_terrestre] + $donnees_sg_planete_units_2['nombre'];
	}	
	//////////////////////////////////////////////////////////////////////////////////////////
	
																						
												



	for ($i=0;$i<$nb_spatial;$i++)
	{
		$vaisseau = $liste_spatial[$i];
		
		
		$cout_fer = $vaisseaux[$liste_spatial[$i]]['Fer'];
		$cout_carbone = $vaisseaux[$liste_spatial[$i]]['Carbone'];
		$cout_or = $vaisseaux[$liste_spatial[$i]]['Or'];
		$cout_naquada  = $vaisseaux[$liste_spatial[$i]]['Naquada'];
		$cout_trinium = $vaisseaux[$liste_spatial[$i]]['Trinium'];
		$cout_pop = $vaisseaux[$liste_spatial[$i]]['Population'];


		
		if ($i % 2 == 0) 
		{
			echo '<tr bgcolor="#6983A3">';
		} else 
		{
			echo '<tr bgcolor="#717D8D">';
		}
				echo '<td <a onMouseDown="(Affbulle2(\''.quote(detail_vaisseaux($vaisseaux[$liste_spatial[$i]], $liste_spatial[$i])).'\'))"><u>'.$liste_spatial[$i].'</u></a></td>';
				echo '<td>'.$vaisseau_nombre_planete[$i].'</td>';
				echo '<td>'.$nb_vaisseau_total[$i].'</td>';
				echo '<td>'.$cout_fer.'</td>';
				echo '<td>'.$cout_carbone.'</td>';
				echo '<td>'.$cout_or.'</td>';
				echo '<td>'.$cout_naquada.'</td>';
				echo '<td>'.$cout_trinium.'</td>';
				echo '<td>'.$cout_pop.'</td>';
				echo '<td><input type="text" name="vaisseau'.$i.'" size="10" onKeyUp="go(); if (event.which==13)  go2();" ></td>';
			echo '</tr>';
			
		}
	echo '<tr> <td colspan="10"> <hr width="100%" /> </td> </tr>';
	for ($i=0;$i<$nb_terrestre;$i++)
	{

		
		$cout_or = $terrestre[$liste_terrestre[$i]]['Or'];
		$cout_pop = $terrestre[$liste_terrestre[$i]]['Population'];

		
	if ($i % 2 == 0) 
	{
		echo "<tr bgcolor=\"#6983A3\">";
	} else 
	{
		echo "<tr bgcolor=\"#717D8D\">";
	}
			echo '<td <a onMouseDown="(Affbulle2(\''.quote(detail_terrestre($terrestre[$liste_terrestre[$i]], $liste_terrestre[$i])).'\'))"><u>'.$liste_terrestre[$i].'</u></a></td>';
			echo '<td>'. $terrestre_nombre_planete[$i] . '</td>';
			echo '<td>' . $nb_terrestre_total[$i] . '</td>';
			echo '<td>-</td>';
			echo '<td>-</td>';
			echo '<td>'.$cout_or.'</td>';
			echo '<td>-</td>';
			echo '<td>-</td>';
			echo '<td>'.$cout_pop.'</td>';
			echo '<td><input type="text" name="terrestre'.$i.'" size="10" onKeyUp="go(); if (event.which==13)  go2();" ></td>';
		echo '</tr>';
	}

	?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><input type="button" value="Ok" onClick="go2()"></td>
		
	</table>

	<input type="hidden" value="<?php echo md5($pseudo);?>" name="hidden">
	<input type="hidden" value="<?php echo $id_planete; ?>" name="plapla">
	</form>
<?

}
else
{		
	echo '<p>Vous devez d\'abord nommer toutes vos plan&egrave;tes dans le poste de commandement.</p>';
}
