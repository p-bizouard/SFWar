<?php

require_once("include/fonction_combat.php");


$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE pseudo='$pseudo'");
$donnees = mysql_fetch_array($retour);
$nb_ligne = $donnees['nbre_entrees'];

$retour2 = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE pseudo='$pseudo' AND nom!=''");
$donnees2 = mysql_fetch_array($retour2);
$nb_ligne2 = $donnees2['nbre_entrees'];

if (($nb_ligne2 != '0') OR ($nb_ligne != '0')) {
  if (($nb_ligne==0) AND (!isset($_GET['type']))) {

  	$reponse = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo' LIMIT 1");
  	$donnees = mysql_fetch_array($reponse);

    $HTTP_GET_VARS["nom"] = $donnees['nom'];
    $_GET['type'] = 'plapla';

    
  }
  										



  if  (@$_GET['type'] == "flotte")
  {
  	$HTTP_GET_VARS["flotte"] = $HTTP_GET_VARS["nom"];
  	
  }

  if ((isset($_GET['type'])) AND ($_GET['type'] == "plapla")) {


  	$nom_plapla = urldecode($HTTP_GET_VARS["nom"]);
  	$reponse = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo' AND nom='$nom_plapla'");
  	$donnees = mysql_fetch_array($reponse);
    $id_plapla = $donnees['id'];
  	$X = $donnees['coord_X'];
  	$Y = $donnees['coord_Y'];
  	$nom = $nom_plapla;
  }
  else
  {

  	if (empty($_SESSION['flotte'])) 
  	{	// Session vide.


  		if(!isset($HTTP_GET_VARS["flotte"])) 
  		{
  		//vide. Rien en session ni en variable. Donc rien.
  			$reponse = mysql_query("SELECT * FROM sg_flotte WHERE pseudo='$pseudo' ORDER BY nom LIMIT 1");
  			$donnees = mysql_fetch_array($reponse);
  			$X = $donnees['coord_X'];
  			$Y = $donnees['coord_Y'];
  			$nom = $donnees['nom'];
  			$id_flotte= $donnees['id'];
  	
  		} else {//Rien en session, mais quelque chose en variable

  			//////////////////////////////////////
  			// on v&eacute;rifie que l'escouade existe	//
  			//////////////////////////////////////
  			$nom_flotte = $HTTP_GET_VARS["flotte"];
  			$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE pseudo='$pseudo' AND nom='$nom_flotte'");
  			$donnees = mysql_fetch_array($retour);
  			$nb_ligne2 = $donnees['nbre_entrees'];
  								
  			if ($nb_ligne2==0) {
  				die("Vous n'avez pas le droit de pirater ce site. Merci233");
  			}
  								
  			$reponse = mysql_query("SELECT * FROM sg_flotte WHERE pseudo='$pseudo' AND nom='$nom_flotte'");
  			$donnees = mysql_fetch_array($reponse);
  			$X = $donnees['coord_X'];
  			$Y = $donnees['coord_Y'];
  			$nom = $donnees['nom'];
  			$id_flotte= $donnees['id'];
  										
  			// Mise en session du nom de l'escouade
  			$_SESSION['flotte'] = $id_flotte;
  			
  		}				

  	} 
  	else 
  	{// Session pleine
  		$id_flotte = $_SESSION["flotte"];
  									
  								
  		//////////////////////////////////////
  		// on v&eacute;rifie que l'escouade existe	//
  		//////////////////////////////////////
  		$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE pseudo='$pseudo' AND id='$id_flotte'");
  		$donnees = mysql_fetch_array($retour);
  		$nb_ligne3 = $donnees['nbre_entrees'];
  				
  		if ($nb_ligne3==0) {
  				$reponse = mysql_query("SELECT * FROM sg_flotte WHERE pseudo='$pseudo' ORDER BY nom LIMIT 1");
  			$donnees = mysql_fetch_array($reponse);
  			$X = $donnees['coord_X'];
  			$Y = $donnees['coord_Y'];
  			$nom = $donnees['nom'];
  			$id_flotte= $donnees['id'];
  		}
  							
  		if(!isset($HTTP_GET_VARS["flotte"])) {//vide. Quelque chose en session. rien en URL
  			$reponse = mysql_query("SELECT * FROM sg_flotte WHERE id='$id_flotte' AND pseudo='$pseudo'");
  			$donnees = mysql_fetch_array($reponse);			
  			$X = $donnees['coord_X'];
  			$Y = $donnees['coord_Y'];
  			$nom = $donnees['nom'];
  			$id_flotte= $donnees['id'];
  			
  		} else {//Quelque chose en session, et quelque chose en URL
  			$flotte_nom = urldecode($HTTP_GET_VARS["flotte"]);					

  			//////////////////////////////////////
  			// on v&eacute;rifie que l'escouade existe	//
  			//////////////////////////////////////
  			$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE pseudo='$pseudo' AND nom='$flotte_nom'");
  			$donnees = mysql_fetch_array($retour);
  			$nb_ligne4 = $donnees['nbre_entrees'];
  								
  			if ($nb_ligne4==0) {
  				$message = "Vous n'avez pas le droit de pirater ce site. Merci (code 203)";	
  				die("Vous n'avez pas le droit de pirater ce site. Merci (code 203)");
  			}
  										
  			$reponse = mysql_query("SELECT * FROM sg_flotte WHERE nom='$flotte_nom' AND pseudo='$pseudo'");
  			$donnees = mysql_fetch_array($reponse);
  			$X = $donnees['coord_X'];
  			$Y = $donnees['coord_Y'];
  			$nom = $donnees['nom'];
  			$id_flotte= $donnees['id'];
  												
  			// Mise en session du nom de l'escouade
  			$_SESSION['flotte'] = $id_flotte;
  		}
  	}
  }
  $message="<p><center>";
  //////////////////////////
  // on g&egrave;re le mouvement	//
  //////////////////////////


  if ((isset($_GET['action'])) AND ($_GET['action'] == 'hyperespace')) {
    if ((is_numeric($_POST['x'])) AND (is_numeric($_POST['y'])) AND ($_POST['x'] <= 49) AND ($_POST['x'] >= 0) AND ($_POST['y'] <= 49) AND ($_POST['y'] >= 0)) {
      
      $X_hyper = $_POST['x'];
      $Y_hyper = $_POST['y'];

      $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE coord_X='".$X_hyper."' AND  coord_Y='".$Y_hyper."'");
      $donnees = mysql_fetch_array($retour);
      $nb_ligne5 = $donnees['nbre_entrees'];

      $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE coord_X='".$X_hyper."' AND  coord_Y='".$Y_hyper."'");
      $donnees = mysql_fetch_array($retour);
      $nb_ligne5 += $donnees['nbre_entrees'];

      if ($nb_ligne5==0) {
          mysql_query("UPDATE sg_flotte SET coord_X='".$X_hyper."' WHERE id='$id_flotte' AND pseudo='$pseudo'");	
          mysql_query("UPDATE sg_flotte SET coord_Y='".$Y_hyper."' WHERE id='$id_flotte' AND pseudo='$pseudo'");	
        echo '<p>Votre flotte vient de sortir de l\'hyperespace aux coordonn&eacute;es x'.$X_hyper.';y'.$Y_hyper.'</p>';
        
        $X = $X_hyper;
        $Y = $Y_hyper;
      } else {
        echo '<p>Il y a d&eacute;j&agrave; une flotte ou une plan&egrave;te sur ces coordonn&eacute;es. Impossible d\'entrer en hyperespace.</p>';
      }
    } else {
      echo '<p>Impossible d\'effectuer le saut en hyperespace : les coordonn&eacute;es doivent &ecirc;tre comprises entre 0 et 49 (compris)';
    }
  }





  if (isset($direction)) {


  if ($direction =="NO") {

  	$reponse = mysql_query("SELECT * FROM sg_flotte WHERE id='$id_flotte' AND pseudo='$pseudo' LIMIT 1");
  	$donnees = mysql_fetch_array($reponse);
  	$X = $donnees['coord_X'];
  	$Y = $donnees['coord_Y'];

  	$X = $X-1;
  	$Y = $Y+1;
  	if ($X <0) $X = 0;
  	if ($Y < 0) $Y = 0;
  	if ($X > 49) $X = 49;
  	if ($Y > 49) $Y = 49;
  } elseif ($direction =="N") {

  	$reponse = mysql_query("SELECT * FROM sg_flotte WHERE id='$id_flotte' AND pseudo='$pseudo' LIMIT 1");
  	$donnees = mysql_fetch_array($reponse);
  	$X = $donnees['coord_X'];
  	$Y = $donnees['coord_Y'];

  	$Y = $Y+1;
  	$X = $X;
  	if ($X <0) $X = 0;
  	if ($Y < 0) $Y = 0;
  	if ($X > 49) $X = 49;
  	if ($Y > 49) $Y = 49;

  } elseif ($direction =="NE") {

  	$reponse = mysql_query("SELECT * FROM sg_flotte WHERE id='$id_flotte' AND pseudo='$pseudo' LIMIT 1");
  	$donnees = mysql_fetch_array($reponse);
  	$X = $donnees['coord_X'];
  	$Y = $donnees['coord_Y'];

  	$Y = $Y+1;
  	$X = $X+1;
  	if ($X <0) $X = 0;
  	if ($Y < 0) $Y = 0;
  	if ($X > 49) $X = 49;
  	if ($Y > 49) $Y = 49;


  								} elseif ($direction =="O") {
  	
  	$reponse = mysql_query("SELECT * FROM sg_flotte WHERE id='$id_flotte' AND pseudo='$pseudo' LIMIT 1");
  	$donnees = mysql_fetch_array($reponse);
  	$X = $donnees['coord_X'];
  	$Y = $donnees['coord_Y'];
  	
  	$Y = $Y;
  	$X = $X-1;
  	if ($X <0) $X = 0;
  	if ($Y < 0) $Y = 0;
  	if ($X > 49) $X = 49;
  	if ($Y > 49) $Y = 49;


  								} elseif ($direction =="E") {
  	
  	$reponse = mysql_query("SELECT * FROM sg_flotte WHERE id='$id_flotte' AND pseudo='$pseudo' LIMIT 1");
  	$donnees = mysql_fetch_array($reponse);
  	$X = $donnees['coord_X'];
  	$Y = $donnees['coord_Y'];

  	$Y = $Y;
  	$X = $X+1;
  	if ($X <0) $X = 0;
  	if ($Y < 0) $Y = 0;
  	if ($X > 49) $X = 49;
  	if ($Y > 49) $Y = 49;

  								} elseif ($direction =="SO") {
  	
  	$reponse = mysql_query("SELECT * FROM sg_flotte WHERE id='$id_flotte' AND pseudo='$pseudo' LIMIT 1");
  	$donnees = mysql_fetch_array($reponse);
  	$X = $donnees['coord_X'];
  	$Y = $donnees['coord_Y'];

  	$Y = $Y-1;
  	$X = $X-1;
  	if ($X <0) $X = 0;
  	if ($Y < 0) $Y = 0;
  	if ($X > 49) $X = 49;
  	if ($Y > 49) $Y = 49;

  								} elseif ($direction =="S") {
  		
  	$reponse = mysql_query("SELECT * FROM sg_flotte WHERE id='$id_flotte' AND pseudo='$pseudo' LIMIT 1");
  	$donnees = mysql_fetch_array($reponse);
  	$X = $donnees['coord_X'];
  	$Y = $donnees['coord_Y'];

  	$Y = $Y-1;
  	$X = $X;
  	if ($X <0) $X = 0;
  	if ($Y < 0) $Y = 0;
  	if ($X > 49) $X = 49;
  	if ($Y > 49) $Y = 49;

  								} elseif ($direction =="SE") {
  		
  	$reponse = mysql_query("SELECT * FROM sg_flotte WHERE id='$id_flotte' AND pseudo='$pseudo' LIMIT 1");
  	$donnees = mysql_fetch_array($reponse);
  	$X = $donnees['coord_X'];
  	$Y = $donnees['coord_Y'];

  	$Y = $Y-1;
  	$X = $X+1;
  	if ($X <0) $X = 0;
  	if ($Y < 0) $Y = 0;
  	if ($X > 49) $X = 49;
  	if ($Y > 49) $Y = 49;


  	} 

  	// v&eacute;rification : place libre ?

  	$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE coord_X='$X' AND coord_Y='$Y'");
  	$donnees = mysql_fetch_array($retour);
  	$existe = $donnees['nbre_entrees'];
  	
  	$retour12 = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE coord_X='$X' AND coord_Y='$Y'");
  	$donnees12 = mysql_fetch_array($retour12);
  	$existe12 = $donnees12['nbre_entrees'];

  	$existe3=$existe+$existe12;
  		
  			
  	if ($existe3 != 0) 
  	{
  			$message = "$message Vous ne pouvez pas vous d&eacute;placer sur cette zone.</p>";
  	} else 
  	{
  		mysql_query("UPDATE sg_flotte SET coord_Y='$Y' WHERE id='$id_flotte' AND pseudo='$pseudo'");	
  		mysql_query("UPDATE sg_flotte SET coord_X='$X' WHERE id='$id_flotte' AND pseudo='$pseudo'");	
  	}
  }// Fin du si il y a une variable.

  ?>
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
  <td style="width:50%">
  <p> <?php

    if ($nb_ligne != '0') {
      ?>
      <!-- DEBUT DU SCRIPT MENU DEROULANT-->

      <form NAME="menu_flotte">
      <label for="flotte_choix">Choix de flotte :&nbsp; </label>
      <select id="flotte_choix" NAME="popup_flotte" onChange="change_flotte();" size="1">
     		
      <?php
      
      if (@$_GET['type'] == "plapla") {
        echo '<option>-&nbsp;&nbsp;Choix des flottes-</option>';
      }
      
      $reponse = mysql_query("SELECT * FROM sg_flotte WHERE pseudo='$pseudo'");
      			
      while ($donnees = mysql_fetch_array($reponse)) {
      	$flotte_nom = $donnees['nom'];
      	?>
      	<option <?php if ($flotte_nom == $nom) echo " SELECTED "; ?>value="accueil.php?page=carte&flotte=<?php echo urlencode($flotte_nom); ?>">-&nbsp;&nbsp;<?php echo $flotte_nom; ?></option>
      	<?php
      }
      ?>
      </select>
      </form>										



      
      									
      <script>
      function change_flotte() {
      	var flotte = document.menu_flotte.popup_flotte.selectedIndex;
      	{
      		window.location.href =
      		document.menu_flotte.popup_flotte.options[flotte].value;
      	}
      }
      </script>

      <?

    }
    ?>&nbsp;
	</p>
  </td>
  <td style="width:50%">
	<form NAME="menu_plapla">
      
      <label for="plan&egrave;te_choix">Choix de plan&egrave;te :&nbsp; </label>
      <select id="plan&egrave;te_choix" NAME="popup_plapla" onChange="change_plapla();" size="1">
      		
      <?php
      if (@$_GET['type'] != "plapla") {
        echo '<option>-&nbsp;&nbsp;Choix des plan&egrave;tes-</option>';
      }
      $reponse = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo'");
      			
      while ($donnees = mysql_fetch_array($reponse)) {
      	$planete_nom = $donnees['nom'];
      	?>
      	<option <?php if (($_GET['type'] == "plapla") AND ($planete_nom == $nom)) echo " SELECTED "; ?>value="accueil.php?page=carte&amp;type=plapla&amp;nom=<?php echo urlencode($planete_nom); ?>">-&nbsp;&nbsp;<?php echo $planete_nom; ?></option>
      	<?php
      }
      ?>
      </select>
      </form>										
    						
      <script>
      function change_plapla() {
      	var plapla = document.menu_plapla.popup_plapla.selectedIndex;
      	{
      		window.location.href =
      		document.menu_plapla.popup_plapla.options[plapla].value;
      	}
      }
      </script>
  </p>
  </td>
  </tr>
  </Table>

  <?php


  echo $message;

  /////////////////////////////////////////////////////////////////////////////
  ////////////////////////  GESTION DE L'ATTAQUE //////////////////////////////
  /////////////////////////////////////////////////////////////////////////////
  	
  	$X_max_attaque = $X + 1;
  	$X_min_attaque = $X - 1;
  	$Y_max_attaque = $Y + 1;
  	$Y_min_attaque = $Y - 1;
  	
  	
  	//////////////////////////////////////////////////////////////////////////////
  	// on prend la race du joueur pour qu'il ne puisse pas attaquer ses alli&eacute;s	//
  	//////////////////////////////////////////////////////////////////////////////
  	$reponse = mysql_query("SELECT * FROM sg_perso WHERE pseudo='$pseudo'");
  	$donnees = mysql_fetch_array($reponse);
  	$clan = $donnees['clan'];
  	$race = $donnees['race'];
  	
		
if ((!isset($_GET['type'])) OR ($_GET['type'] != "plapla")) {
  	/////////////////////////////////////////////////////////////////////////
  	//////////////////////////Pour les flottes //////////////////////////////
  	/////////////////////////////////////////////////////////////////////////
  		
  	
  		//////////////////////////////////////////////////////////////////////
  		// On regarde le nombre de gas a portee et pas de la m&ecirc;me clan	//
  		//////////////////////////////////////////////////////////////////////
  		$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE coord_X<='$X_max_attaque' AND coord_X>='$X_min_attaque' AND coord_Y>='$Y_min_attaque' AND coord_Y<='$Y_max_attaque' AND clan!='$clan'");
  		$donnees = mysql_fetch_array($retour);
  		$nb_ligne6 = $donnees['nbre_entrees'];




  		if ($nb_ligne6 ==0) {// SI PERSONNE A PORTEE

  		} else {//SINON 2
  			if ($nb_ligne6!=0) {// SI IL Y A DES GAS

  				$reponse = mysql_query("SELECT * FROM sg_perso WHERE pseudo='$pseudo'");
  				$donnees = mysql_fetch_array($reponse);
  			?>		
  					
  					<form action="accueil.php?page=combat" method="post">
           
            <input name="flotte" type="hidden" value="<?php echo $id_flotte; ?>">
  					<table  border='0' cellpadding='0' cellspacing='0'>
  					<tr>
  						<td>
              <label for="flotte_a_portee">Flottes &agrave; port&eacute;e :&nbsp; </label>
              <select id="flotte_a_portee" name="adversaire">
  							
  								<?php
  	
  								//////////////////////////////////////////////////////////////////////
  								// On regarde les 		 gas a portee et pas de la m&ecirc;me clan	//
  								//////////////////////////////////////////////////////////////////////
  								$reponse = mysql_query("SELECT * FROM sg_flotte WHERE coord_X<='$X_max_attaque' AND coord_X>='$X_min_attaque' AND coord_Y>='$Y_min_attaque' AND coord_Y<='$Y_max_attaque' AND clan!='$clan'");
  	
  								while ($donnees = mysql_fetch_array($reponse)) {
  									$nom3 = $donnees['nom'];
  									$pseudo45 = $donnees['pseudo'];
  									$id = $donnees['id'];
  	
  										?>
  											<option value="<?php echo $id; ?>"><?php echo $nom3; ?> [<?php echo $pseudo45; ?>]</option>
  										<?

  								}// fin while
  									?>
  								
  							</select>
             
  						</td>


  						<td align="center">
  							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Attaquer" >
  						</td>
  					</tr>
  				</table>
  				
  				
  			
  				</form>	
  				
  				<?php
  			}//fon du if si $nb_ligne!=0

  	
  		}
  	}
  		
  	/////////////////////////////////////////////////////////////////////////
  	//////////////////////////Pour les plan&egrave;tes//////////////////////////////
  	/////////////////////////////////////////////////////////////////////////
  		
  	
  		//////////////////////////////////////////////////////////////////////
  		// On regarde le nombre de gas a portee et pas de la m&ecirc;me clan	//
  		//////////////////////////////////////////////////////////////////////
  		$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE coord_X<='$X_max_attaque' AND coord_X>='$X_min_attaque' AND coord_Y>='$Y_min_attaque' AND coord_Y<='$Y_max_attaque' AND clan!='$clan'");
  		$donnees = mysql_fetch_array($retour);
  		$nb_ligne7 = $donnees['nbre_entrees'];
  	



  		if ($nb_ligne7 ==0) {// SI PERSONNE A PORTEE

  		} else 
  		{//SINON 2
  			if ($nb_ligne7!=0) {// SI IL Y A DES GAS

  				$reponse = mysql_query("SELECT * FROM sg_perso WHERE pseudo='$pseudo'");
  				$donnees = mysql_fetch_array($reponse);
  			?>		
  					
  					<form action="accueil.php?page=combat_2" method="post">
  					<?
            if ($_GET['type'] == "plapla") {
              echo '<input name="type" type="hidden" value="planete">
              <input name="id" type="hidden" value="'. $id_plapla . '">';
            } else {
              echo '<input name="type" type="hidden" value="flotte"><input name="id" type="hidden" value="'. $id_flotte . '">';
            }
  					?>
  					<table  border='0' cellpadding='0' cellspacing='0' >
  					<tr>
  						<td>
              <label for="plan&egrave;te_a_portee">Plan&egrave;tes &agrave; port&eacute;e :&nbsp; </label>
              <select id="plan&egrave;te_a_portee" name="adversaire">
  							
  								<?php
  	
  								//////////////////////////////////////////////////////////////////////
  								// On regarde les 		 gas a portee et pas de la m&ecirc;me clan	//
  								//////////////////////////////////////////////////////////////////////
  								$reponse = mysql_query("SELECT * FROM sg_planete WHERE coord_X<='$X_max_attaque' AND coord_X>='$X_min_attaque' AND coord_Y>='$Y_min_attaque' AND coord_Y<='$Y_max_attaque' AND clan!='$clan'");
  	
  								while ($donnees = mysql_fetch_array($reponse)) {
  									$nom3 = $donnees['nom'];
  									$pseudo45 = $donnees['pseudo'];
  									$id = $donnees['id'];
  	
  										?>
  											<option value="<?php echo $id; ?>"><?php echo $nom3; ?> [<?php echo $pseudo45; ?>]</option>
  										<?

  								}// fin while
  									?>
  								
  							</select>
  						</td>

  						<td align="center">
  							&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Attaquer" >
  						</td>
  					</tr>
  				</table>
  				
  				<br>
  			
  				</form>	
  				
  				<?php
  			}//fon du if si $nb_ligne!=0
  	
  	
  		}		
  		
  /////////////////////////////////////////////////////////////////////////////
  ///////////////////// FIN DE LA GESTION DE L'ATTAQUE ////////////////////////
  /////////////////////////////////////////////////////////////////////////////



  //////////////////////////////////////////////////////////////////////////////
  // D&eacute;but de la gestion de la carte. Alors, on fait deux requ&egrave;te emboit&eacute;.	//
  // On fait ligne pr ligne. Dans chaque ligne, on fait collone par collones.	//
  // On commence en haut a gauche. on fait la 1&eacute;er ligne, puis la Seconde...	//
  //////////////////////////////////////////////////////////////////////////////
  //	Y								//
  //	|	Xmin	Xmax				//
  //	|---|-------|-------Ymax		//
  //	|	|	+	|					//
  //	|---|-------|-------Ymin		//
  //	|	|		|					//
  //	|___|_______|________ X			//
  //									//
  //									//
  //////////////////////////////////////

  $X_max = $X + 5;
  $Y_max = $Y + 5;
  $X_min = $X - 5;
  $Y_min = $Y - 5;

  $c = 35; //Longueur des cot&eacute;s des carr&eacute;s.
  ?>
	<div id="carte">
	<div id="sous_carte">
		<div class="carte_xy"></div>
  <?
  $i=$X_min;
  while ($i <= $X_max) {
  	
  	
  			if (($i >= 0) && ($i <50))
  			{
					echo '<div class="carte_square_coord_x">';
					if ($i == ($X_min+5)) 
						echo "<b>".$i."</b>"; 
					else 
						echo $i;
					echo '</div>';
  			}
   $i++;
   
  }
  $Y = $Y_max;

  while ($Y >= $Y_min) {
  	if (($Y >= 0) && ($Y <50))
  			{
					echo '<div class="carte_square_coord_y">';
					if ($Y == ($Y_min+5)) 
						echo "<b>".$Y."</b>"; 
					else
						echo $Y;
					echo '</div>';

  		$X = $X_min;

  		while ($X <= $X_max) {

  			if (($X >= 0) && ($X <50))
  			{
  				//////////////////////////////////////////////
  				//on regarde les escouades sur cette case	//
  				//////////////////////////////////////////////////////////////////////////////////
  				$sql = "SELECT * FROM sg_flotte WHERE coord_X='$X' AND coord_Y='$Y'";			
  				$query = mysql_query($sql);													
  				$fetch = mysql_fetch_array($query);										

  				$clan_flotte = $fetch['clan'];	
  				$race_flotte = $fetch['race'];														
  				$pseudo2 = $fetch['pseudo'];												
  				$nom2 = $fetch['nom'];															
  				$image2 = "images/flotte_" . $clan_flotte . "_".$race_flotte.".png";								
  				$id_flotte = $fetch['id'];	
  				
  				//////////////////////////////////////////////////////////////////////////////////

  				///////////////////////////////////////////////////////
  				//on regarde les plan&egrave;tes pr&eacute;sentes sur la case      //
  				//////////////////////////////////////////////////////////////////////////////////
  				$sqll = "SELECT * FROM sg_planete WHERE coord_X='$X' AND coord_Y='$Y'";	//
  				$query = mysql_query($sqll);												
  				$fetch = mysql_fetch_array($query);											
  																							
  				$id_planete = $fetch['id'];											
  				$clan = $fetch['clan'];												
  				$race = $fetch['race'];													
  				$proprio_planete = $fetch['pseudo'];									
  				$nom = $fetch['nom'];													
  				$image_plapla_spe = $fetch['image'];										
  				if ($image_plapla_spe == "")													
  				{																				
  					$image_planete = "images/planete_" . $clan . "_".$race.".png";					
  				}
  				else
  				{
  					$image_planete = $image_plapla_spe . '_'.$clan.'.png';
  				}
  				//////////////////////////////////////////////////////////////////////////////////
  				
          $clan = clan_id_to_name($clan);
          $clan_flotte = clan_id_to_name($clan_flotte);
          $race = race_name_to_name($race);
          $race_flotte = race_name_to_name($race_flotte);

		if ($pseudo2!="") 
		{
			if (verif_protection ($pseudo2, $id_joueur) > 0)
				$protection = '<font color=green>Activ&eacute;</a>';
			else 
				$protection = '<font color=red>Attaquable</a>';
		} 
		elseif ($proprio_planete!="")
		{
			if (verif_protection ($proprio_planete, $id_joueur) > 0)
				$protection = '<font color=green>Activ&eacute;</a>';
			else 
				$protection = '<font color=red>Attaquable</a>';
		}

  				if ($pseudo2!="") {// If : si c'ets une flotte
  				
    				echo '<div class="carte_square">';
						?>
            <img src='<?php echo $image2; ?>' border='0' onMouseOver="(Affbulle2('<center><h3><?php echo quote($nom2); ?></h3></center><table><tr><td>Joueur :</td><td><?php echo quote($pseudo2); ?></td></tr><tr><td>Clan :</td><td><?php echo quote($clan_flotte)?></td></tr><tr><td>Race :</td><td><?php echo quote($race_flotte)?></td></tr><tr><td>Coordonn&eacute;e : </td><td><?php echo $X; echo ","; echo $Y; ?></td></tr><tr><td>Puissance :</td><td><?php echo puissance_flotte($id_flotte, $pseudo);?></td></tr><tr><td>Protection :</td><td><?php echo $protection; ?></td></tr></table>'));" onMouseOut="return(Hidebulle2())"><?php	
  				} elseif ($proprio_planete!="") { // Si c'ets une plapla
  				
    				echo '<div class="carte_square">';
						?>
    				<img src="<?php echo $image_planete; ?>" border="0" onMouseOver="(Affbulle2('<center><h3><?php echo quote($nom); ?></h3></center><table><tr><td>Joueur : </td><td><?php echo quote($proprio_planete); ?> </td></tr><tr><td>Clan :</td><td><?php echo quote($clan)?></td></tr><tr><td>Race :</td><td><?php echo quote($race)?></td></tr><tr><td>Coordonn&eacute;e : </td><td><?php echo $X; echo ","; echo $Y; ?></td></tr><tr><td>Puissance :</td><td><?php echo puissance_plapla($id_planete, $pseudo); ?></td></tr><tr><td>Protection :</td><td><?php echo $protection; ?></td></tr></table>'));" onMouseOut="return(Hidebulle2())"><?php	

  				} else {

  				echo '<div class="carte_square">';
					?>
    			<?php if ($Y == ($Y_min+5)) echo '<font color="white"><div>+</div></font>'; ?>
          <?php if (($X == ($X_min+5)) AND ($Y != $Y_min+2) AND ($Y != $Y_min+8) AND ($Y != $Y_min+5)) echo '<font color="white"><div>+</div></font>'; ?>
          
    			<?php if ($Y == ($Y_min+2)) echo '<font color="white"><div>*</div></font>'; ?>
          <?php if (($X == ($X_min+2)) AND ($Y != $Y_min+2) AND ($Y != $Y_min+8) AND ($Y != $Y_min+5)) echo '<font color="white"><div>*</div></font>'; ?>
          
    			<?php if ($Y == ($Y_min+8)) echo '<font color="white"><div>*</div></font>'; ?>
          <?php if (($X == ($X_min+8)) AND ($Y != $Y_min+2) AND ($Y != $Y_min+8) AND ($Y != $Y_min+5)) echo '<font color="white"><div>*</div></font>'; ?>

  				<?php							

  				
  				}
					echo "</div>";
  			}
  		$X++;
  		}
  	}
  	$Y--;
  	
  }							
  
	echo '<div class="carte_xy2"></div>';
  $i=$X_min;
  while ($i <= $X_max) {
  	
  	
  			if (($i >= 0) && ($i <50))
  			{
					echo '<div class="carte_square_coord_x">';
					if ($i == ($X_min+5)) 
						echo "<b>".$i."</b>"; 
					else 
						echo $i;
					echo '</div>';
  			}
   $i++;
   
  }
	?>
	</div>
  </div>

  <br />
    
  <?php
  if (@$_GET['type'] != "plapla") {
  ?>

	<div id="deplacement" style="float:left;">
    <table width="358px">
      <tr>
        <td style="width:50%" align="center">
    <table  border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
    	<td><form action="accueil.php?page=carte&direction=NO" method="post"><input type="submit" style="width: 30px; height:30px;padding:0px;margin:0px;" value="NO" name="direct"></form></td>
    	<td><form action="accueil.php?page=carte&direction=N" method="post"><input type="submit" style="width: 30px; height:30px;padding:0px;margin:0px;" value="N" name="direct"></form></td>
    	<td><form action="accueil.php?page=carte&direction=NE" method="post"><input type="submit" style="width: 30px; height:30px;padding:0px;margin:0px;" value="NE" name="direct"></form></td>
    </tr>
    <tr>
    	<td><form action="accueil.php?page=carte&direction=O" method="post"><input type="submit" style="width: 30px; height:30px;padding:0px;margin:0px;" value="O" name="direct"></form></td>
    	<td>&nbsp;</td>
    	<td><form action="accueil.php?page=carte&direction=E" method="post"><input type="submit" style="width: 30px; height:30px;padding:0px;margin:0px;" value="E" name="direct"></form></td>
    </tr>
    <tr>
    	<td><form action="accueil.php?page=carte&direction=SO" method="post"><input type="submit" style="width: 30px; height:30px;padding:0px;margin:0px;" value="SO" name="direct"></form></td>
    	<td><form action="accueil.php?page=carte&direction=S" method="post"><input type="submit" style="width: 30px; height:30px;padding:0px;margin:0px;" value="S" name="direct"></form></td>
    	<td><form action="accueil.php?page=carte&direction=SE" method="post"><input type="submit" style="width: 30px; height:30px;padding:0px;margin:0px;" value="SE" name="direct"></form></td>
    </tr>
    </table>

        </td>
        <td style="width:50%" align="center">
        
    <p><b>Sauter en hyperespace :</b></p>
    <form action="accueil.php?page=carte&action=hyperespace" method="post">
    <p>
    <label>Coordonn&eacute;e X : <input type="text" size="10" name="x" /></label><br />
    <label>Coordonn&eacute;e Y : <input type="text" size="10" name="y" /></label><br />
    <input type="submit" value="Go !" style="float:right;margin-top:10px;"></p>
    </form> 
        
        </td>
      </tr>
    </table>
	</div>
  <?php
  }
  ?>

<?php
} else {// SI aucune flotte ni plan&egrave;te
  echo '<p>Vous devez d\'abord nommer vos plan&egrave;tes dans la partie "<a href="accueil.php?page=commandement">Commandement</a>".</p>';
}
?>
