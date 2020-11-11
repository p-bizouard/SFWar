<?php
$pass = mysql_fetch_array(mysql_query("SELECT pass FROM sg_perso WHERE id=".mysql_real_escape_string($id_joueur)));
$pass = $pass['pass'];





?>




      <?php require("include/units.php"); ?>
      <?php /*require("index/transfert.php"); */?>  
        <div id="message"></div>
        
<table border="0" cellpadding="0" cellspacing="0" height="50" width="570">
<tr>
  <td><p><b>Vos plan&egrave;tes</b></p><br />

  <table border="0" cellpadding="4" width="100%" align="center" valign="center">
  <tr>
    <td align="center">Nom (Voir)</td>
    <td align="center" colspan="2">Coordonn&eacute;es</td>
    <td align="center">Action</td>
    <td align="center">Puissance</td>
  </tr>
  <?

  
// Test, si le joueur veut nommer une de ses plan&egrave;tes
if ((isset($_POST['nom_planete'])) AND (isset($_POST['id_planete']))) {
   $nom_planete = strip_tags(trim ($_POST['nom_planete']));  
   $id_planete = strip_tags(trim ($_POST['id_planete']));  
   
   // On v&eacute;rifie les donn&eacute;es r&eacute;cup&eacute;r&eacute;s.
  if (strlen ($nom_planete) >20) 
  {
    $message_erreur = '<p>Votre nom de plan&egrave;te ne peut comporter que 20 caract&egrave;res.</p>';
  }
  elseif ($nom_planete == "") 
  {
    $message_erreur = '<p class="erreur">Vous devez saisir un nom de plan&egrave;te</p>';
  }
  else
  {
    if (is_numeric($id_planete))
    {
      $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE nom='$nom_planete'");
      $donnees = mysql_fetch_array($retour);
      $nombre_planete = $donnees['nbre_entrees'];
       
      if ($nombre_planete !=0) $message_erreur = '<p>Le nom de votre plan&egrave;te existe d&eacute;ja .</p><p><form><input type="button" value="Retour" onClick="history.back()"></form></p>';
      
      mysql_query ("UPDATE sg_planete SET nom='$nom_planete' WHERE id='$id_planete'")
      or die ('<p align="center">Echec Update, contactez le webmaster</p>');
    }
  }

}
  
  
  
  
  
  
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$reponse_sg_perso = mysql_query("SELECT * FROM  sg_perso WHERE pseudo='$pseudo'");  
$donnees_sg_perso = mysql_fetch_array($reponse_sg_perso);              
$race = $donnees_sg_perso['race'];                          
$clan = $donnees_sg_perso['clan'];   
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////SPATIAL////////////////////////////////////////////////////////////////////////////////////
$liste_spatial = ${'liste_'.$race};   // $liste_tauri = array( 'F-16', 'X-301', ...          //
$vaisseaux = ${'vaisseaux_'.$race};   //c'est les caract&eacute;ristiques de tous les vaisseaux        //
$nb_spatial = count($liste_spatial);  // c'est pour savoir combien il y a de nombre de vaisseaux diff  //
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
//////////////////////TERRESTRE/////////////////////////////////////////////////////////////////////////////////
$liste_terrestre = ${'liste_terrestre_'.$race};// $liste_terrestre_tauri = array( 'H&K MP-5', 'P90',...  //
$terrestre = ${'terrestre_'.$race}; //c'est les caract&eacute;ristiques de tous les terr.          //
$nb_terrestre = count($liste_terrestre);// c'est pour savoir combien il y a de nombre de terr. diff    //
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  
	
	
	
	
	
	
	
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE pseudo='$pseudo'");
$donnees = mysql_fetch_array($retour);
$nombre_de_flotte = $donnees['nbre_entrees'];  




if ($nombre_de_flotte<3) {

if (isset($_POST['base_de_lancement']) AND isset($_POST['nom']) AND @$_POST['base_de_lancement']!="Aucune" AND @$_POST['nom']!="") {
  $base_de_lancement = $_POST['base_de_lancement'];
  $nom_flotte = strip_tags(trim ($_POST['nom']));
  
  
      
    // On v&eacute;rifie que la plan&egrave;te existe bien et appartient bien au joueur
    $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE pseudo='$pseudo' AND nom='$base_de_lancement'");
    $donnees = mysql_fetch_array($retour);
    $nb_ligne2 = $donnees['nbre_entrees'];

    if ($nb_ligne2!=0) {
      $reponse = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo' AND nom='$base_de_lancement'");
      $donnees = mysql_fetch_array($reponse);
      $X_lancement = $donnees['coord_X'];
      $Y_lancement = $donnees['coord_Y'];
    
      $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE coord_X<='".($X_lancement+1)."' AND coord_X>='".($X_lancement-1)."' AND  coord_Y<='".($Y_lancement+1)."' AND coord_Y>='".($Y_lancement-1)."'");
      $donnees = mysql_fetch_array($retour);
      $nb_planete = $donnees['nbre_entrees'];
    
      $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE coord_X<='".($X_lancement+1)."' AND coord_X>='".($X_lancement-1)."' AND  coord_Y<='".($Y_lancement+1)."' AND coord_Y>='".($Y_lancement-1)."'");
      $donnees = mysql_fetch_array($retour);
      $nb_flotte = $donnees['nbre_entrees'];
    
      $nb_element=$nb_planete+$nb_flotte;

      //Si 8 &eacute;lement alors cr&eacute;ation de flotte impossible
      if ($nb_element==9) {
        $message_decollage =  "<p>Votre plan&egrave;te est assi&eacute;g&eacute;. Vous ne pouvez faire d&eacute;coller une flotte sans quelle soit d&eacute;truite. Choississez une autre base de lancement.</p>";  
      } else {
      
        do {

          $X1 = rand($X_lancement-1,$X_lancement+1);
          $Y1 = rand($Y_lancement-1,$Y_lancement+1);
      
          $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE coord_X='$X1' AND coord_Y='$Y1'");
          $donnees = mysql_fetch_array($retour);
          $existe = $donnees['nbre_entrees'];
        
          $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE coord_X='$X1' AND coord_Y='$Y1'");
          $donnees = mysql_fetch_array($retour);
          $existe2 = $donnees['nbre_entrees'];
        
          $existe+=$existe2;
        } while ($existe!=0);
      
        $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE pseudo='$pseudo' AND nom='$nom_flotte'");
        $donnees = mysql_fetch_array($retour);
        $flotte_impossible = $donnees['nbre_entrees'];
        if (  $flotte_impossible!=0) {
          $message_decollage =  "<p>Vous poss&eacute;dez d&eacute;ja une flotte qui porte ce nom.</p>";
         } else{
          $message_decollage =  "<p>Votre flotte a correctement d&eacute;coll&eacute; de ".stripslashes($base_de_lancement) .".</p>";
          
          mysql_query("INSERT INTO sg_flotte (pseudo, nom, coord_X, coord_Y, race, clan)".
          " VALUES ('$pseudo', '$nom_flotte', '$X1', '$Y1','$race', '$clan') ")
          or die("Erreur dans l'implantation de vos plan&egrave;tes. Votre inscription n'a pas pu &ecirc;tre valid&eacute;.");
        }
      }
    } else $message_decollage =  "Erreur 2014. Veuillez pr&eacute;venir un administrateur.";
  
}
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>
<script type="text/javascript">
<!--
 function isInt(x) {
   var y=parseInt(x);
   if (isNaN(y)) return false;
   return true;
 } 
 
function getXhr(){
													var xhr = null; 
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
													return xhr;
}



function maj_units_planete(i)
{ 
  for (y=0;y<<?php echo $nb_spatial; ?>;y++)
    {
      if (isInt(document.getElementById("planete_flotte_rest_"+i+"_" +y).value))
        {
          document.getElementById("planete_flotte_nb_"+i+"_"+y).innerHTML = parseInt(document.getElementById("planete_flotte_nb_"+i+"_"+y).innerHTML, 10) + parseInt(document.getElementById("planete_flotte_rest_"+i+"_" +y).value, 10);
        }
    }
  for (y=0;y<<?php echo $nb_terrestre; ?>;y++)
    {
      if (isInt(document.getElementById("planete_terrestre_rest_"+i+"_" +y).value))
        {
          document.getElementById("planete_terrestre_nb_"+i+"_"+y).innerHTML = parseInt(document.getElementById("planete_terrestre_nb_"+i+"_"+y).innerHTML, 10) + parseInt(document.getElementById("planete_terrestre_rest_"+i+"_" +y).value, 10);
        }
    }
}




function planete(i){
var xhr = getXhr();

type = "planete";
id = document.getElementById("planete_"+i).value;
destination = document.getElementById("destination_planete_"+i).options[document.getElementById("destination_planete_"+i).selectedIndex].value;

	// On d&eacute;fini ce qu'on va faire quand on aura la r&eacute;ponse
	xhr.onreadystatechange = function(){
		// On ne fait quelque chose que si on a tout re&ccedil;u et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			result = xhr.responseText;

				document.getElementById("message").innerHTML = result;

				id_dest = document.getElementById("destination_planete_"+i).options[document.getElementById("destination_planete_"+i).selectedIndex].value.substring(2,6);
				type_dest = document.getElementById("destination_planete_"+i).options[document.getElementById("destination_planete_"+i).selectedIndex].value.substring(0,1);
				
				for (y=0;y<<?php echo $nb_spatial; ?>;y++)
				{
					if (type_dest == "p")
						{
							document.getElementById("planete_flotte_rest_"+id_dest+"_" +y).value = parseInt(document.getElementById("planete_flotte_rest_"+id_dest+"_" +y).value, 10) + parseInt(document.getElementById("planete_flotte_"+i+"_"+y).value, 10);
						}
					else 
						{
							document.getElementById("flotte_flotte_rest_"+id_dest+"_" +y).value = parseInt(document.getElementById("flotte_flotte_rest_"+id_dest+"_" +y).value, 10) + parseInt(document.getElementById("planete_flotte_"+i+"_"+y).value, 10);
						}
					document.getElementById("planete_flotte_rest_"+i+"_" +y).value = parseInt(document.getElementById("planete_flotte_rest_"+i+"_" +y).value, 10) - parseInt(document.getElementById("planete_flotte_"+i+"_"+y).value, 10);
					document.getElementById("planete_flotte_nb_"+i+"_"+y).innerHTML -= document.getElementById("planete_flotte_"+i+"_"+y).value;
					document.getElementById("planete_flotte_"+i+"_"+y).value = "";
					
					
				}
				for (y=0;y<<?php echo $nb_terrestre; ?>;y++)
				{
					if (type_dest == "p")
						{
							document.getElementById("planete_terrestre_rest_"+id_dest+"_" +y).value = parseInt(document.getElementById("planete_terrestre_rest_"+id_dest+"_" +y).value, 10) + parseInt(document.getElementById("planete_terrestre_"+i+"_"+y).value, 10);
						}
					else 
						{
							document.getElementById("flotte_terrestre_rest_"+id_dest+"_" +y).value = parseInt(document.getElementById("flotte_terrestre_rest_"+id_dest+"_" +y).value, 10) + parseInt(document.getElementById("planete_terrestre_"+i+"_"+y).value, 10);
						}
					
					document.getElementById("planete_terrestre_rest_"+i+"_" +y).value = parseInt(document.getElementById("planete_terrestre_rest_"+i+"_" +y).value, 10) - parseInt(document.getElementById("planete_terrestre_"+i+"_"+y).value, 10);
					document.getElementById("planete_terrestre_nb_"+i+"_"+y).innerHTML -= document.getElementById("planete_terrestre_"+i+"_"+y).value;
					document.getElementById("planete_terrestre_"+i+"_"+y).value = "";
				}
				
					puissance_planete(i);
		}
	}

	// Ici on va voir comment faire du post
	xhr.open("post","index/transfert.php",true);
	// ne pas oublier &ccedil;a pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

	var aenvoyer = "pseudo=<?php echo jsencode($pseudo); ?>&value=<?php echo $pass; ?>&type="+type+"&id="+id+"&destination="+destination;
erreur = 0;
	for (y=0;y<<?php echo $nb_spatial; ?>;y++)
	{
		if (parseInt(document.getElementById("planete_flotte_"+i+"_"+y).value, 10) > parseInt(document.getElementById("planete_flotte_nb_"+i+"_"+y).innerHTML, 10))
			erreur = 1;
		aenvoyer = aenvoyer+"&transfert_spatial["+y+"]="+document.getElementById("planete_flotte_"+i+"_"+y).value; 
	}

	for (y=0;y<<?php echo $nb_terrestre; ?>;y++)
	{
		if (parseInt(document.getElementById("planete_terrestre_"+i+"_"+y).value, 10) > parseInt(document.getElementById("planete_terrestre_nb_"+i+"_"+y).innerHTML, 10))
			erreur = 1;
		aenvoyer = aenvoyer+"&transfert_terrestre["+y+"]="+document.getElementById("planete_terrestre_"+i+"_"+y).value;
	}

	if (erreur == 0)
		xhr.send(aenvoyer);
	else alert("Il y a une erreur dans votre saisie, merci de verivier que vous n'envoyez pas plus d'unites que vous n'en disposez.");
}









function maj_units_flotte(i)
{ 
  for (y=0;y<<?php echo $nb_spatial; ?>;y++)
    {
      if (isInt(document.getElementById("flotte_flotte_rest_"+i+"_" +y).value))
        {
          document.getElementById("flotte_flotte_nb_"+i+"_"+y).innerHTML = parseInt(document.getElementById("flotte_flotte_nb_"+i+"_"+y).innerHTML, 10) + parseInt(document.getElementById("flotte_flotte_rest_"+i+"_" +y).value, 10);
        }
    }
  for (y=0;y<<?php echo $nb_terrestre; ?>;y++)
    {
      if (isInt(document.getElementById("flotte_terrestre_rest_"+i+"_" +y).value))
        {
          document.getElementById("flotte_terrestre_nb_"+i+"_"+y).innerHTML = parseInt(document.getElementById("flotte_terrestre_nb_"+i+"_"+y).innerHTML, 10) + parseInt(document.getElementById("flotte_terrestre_rest_"+i+"_" +y).value, 10);
        }
  }
}




function flotte(i){
var xhr = getXhr();

type = "flotte";
id = document.getElementById("flotte_"+i).value;
destination = document.getElementById("destination_flotte_"+i).options[document.getElementById("destination_flotte_"+i).selectedIndex].value;

	// On d&eacute;fini ce qu'on va faire quand on aura la r&eacute;ponse
	xhr.onreadystatechange = function(){
		// On ne fait quelque chose que si on a tout re&ccedil;u et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			result = xhr.responseText;

				document.getElementById("message").innerHTML = result;

				id_dest = document.getElementById("destination_flotte_"+i).options[document.getElementById("destination_flotte_"+i).selectedIndex].value.substring(2,6);
				type_dest = document.getElementById("destination_flotte_"+i).options[document.getElementById("destination_flotte_"+i).selectedIndex].value.substring(0,1);
				
				for (y=0;y<<?php echo $nb_spatial; ?>;y++)
				{
					if (type_dest == "p")
						{
							document.getElementById("planete_flotte_rest_"+id_dest+"_" +y).value = parseInt(document.getElementById("planete_flotte_rest_"+id_dest+"_" +y).value, 10) + parseInt(document.getElementById("flotte_flotte_"+i+"_"+y).value, 10);
						}
					else 
						{
							document.getElementById("flotte_flotte_rest_"+id_dest+"_" +y).value = parseInt(document.getElementById("flotte_flotte_rest_"+id_dest+"_" +y).value, 10) + parseInt(document.getElementById("flotte_flotte_"+i+"_"+y).value, 10);
						}
					
					document.getElementById("flotte_flotte_rest_"+i+"_" +y).value = parseInt(document.getElementById("flotte_flotte_rest_"+i+"_" +y).value, 10) - parseInt(document.getElementById("flotte_flotte_"+i+"_"+y).value, 10);
					document.getElementById("flotte_flotte_nb_"+i+"_"+y).innerHTML -= document.getElementById("flotte_flotte_"+i+"_"+y).value;
					document.getElementById("flotte_flotte_"+i+"_"+y).value = "";
				}
				for (y=0;y<<?php echo $nb_terrestre; ?>;y++)
				{
					if (type_dest == "p")
						{
							document.getElementById("planete_terrestre_rest_"+id_dest+"_" +y).value = parseInt(document.getElementById("planete_terrestre_rest_"+id_dest+"_" +y).value, 10) + parseInt(document.getElementById("flotte_terrestre_"+i+"_"+y).value, 10);
						}
					else 
						{
							document.getElementById("flotte_terrestre_rest_"+id_dest+"_" +y).value = parseInt(document.getElementById("flotte_terrestre_rest_"+id_dest+"_" +y).value, 10) + parseInt(document.getElementById("flotte_terrestre_"+i+"_"+y).value, 10);
						}
					
					document.getElementById("flotte_terrestre_rest_"+i+"_" +y).value = parseInt(document.getElementById("flotte_terrestre_rest_"+i+"_" +y).value, 10) - parseInt(document.getElementById("flotte_terrestre_"+i+"_"+y).value, 10);
					document.getElementById("flotte_terrestre_nb_"+i+"_"+y).innerHTML -= document.getElementById("flotte_terrestre_"+i+"_"+y).value;
					document.getElementById("flotte_terrestre_"+i+"_"+y).value = "";
				}
				
					puissance_flotte(i);
				
		}
	}

	// Ici on va voir comment faire du post
	xhr.open("post","index/transfert.php",true);
	// ne pas oublier &ccedil;a pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

	var aenvoyer = "pseudo=<?php echo jsencode($pseudo); ?>&value=<?php echo $pass; ?>&type="+type+"&id="+id+"&destination="+destination;
erreur = 0;
	for (y=0;y<<?php echo $nb_spatial; ?>;y++)
	{
		if (parseInt(document.getElementById("flotte_flotte_"+i+"_"+y).value, 10) > parseInt(document.getElementById("flotte_flotte_nb_"+i+"_"+y).innerHTML, 10))
			erreur = 1;
		aenvoyer = aenvoyer+"&transfert_spatial["+y+"]="+document.getElementById("flotte_flotte_"+i+"_"+y).value; 
	}

	for (y=0;y<<?php echo $nb_terrestre; ?>;y++)
	{
		if (parseInt(document.getElementById("flotte_terrestre_"+i+"_"+y).value, 10) > parseInt(document.getElementById("flotte_terrestre_nb_"+i+"_"+y).innerHTML, 10))
			erreur = 1;
		aenvoyer = aenvoyer+"&transfert_terrestre["+y+"]="+document.getElementById("flotte_terrestre_"+i+"_"+y).value;
	}

	if (erreur == 0)
		xhr.send(aenvoyer);
	else alert("Il y a une erreur dans votre saisie, merci de verivier que vous n'envoyez pas plus d'unites que vous n'en disposez.");
}








function puissance_planete(i) {

	puissance(i, "planete");
	
	id_dest = document.getElementById("destination_planete_"+i).options[document.getElementById("destination_planete_"+i).selectedIndex].value.substring(2,6);
	type_dest = document.getElementById("destination_planete_"+i).options[document.getElementById("destination_planete_"+i).selectedIndex].value.substring(0,1);
	
	if (type_dest == "p") type_dest = "planete"
	else if (type_dest == "f") type_dest = "flotte"
	
	puissance(id_dest, type_dest);
}
function puissance_flotte(i) {
	puissance(i, "flotte");
	
	id_dest = document.getElementById("destination_flotte_"+i).options[document.getElementById("destination_flotte_"+i).selectedIndex].value.substring(2,6);
	type_dest = document.getElementById("destination_flotte_"+i).options[document.getElementById("destination_flotte_"+i).selectedIndex].value.substring(0,1);
	
	if (type_dest == "p") type_dest = "planete"
	else if (type_dest == "f") type_dest = "flotte"
	
	puissance(id_dest, type_dest);
}


function puissance(i, type){

				var xhr = getXhr();
				// On d&eacute;fini ce qu'on va faire quand on aura la r&eacute;ponse
				xhr.onreadystatechange = function(){
					// On ne fait quelque chose que si on a tout re&ccedil;u et que le serveur est ok
					if(xhr.readyState == 4 && xhr.status == 200){
						document.getElementById("puissance_"+type+"_"+i).innerHTML = xhr.responseText;
					}
				}
				
		
	
		// Ici on va voir comment faire du post
		xhr.open("post","index/puissance_verif.php",true);
		// ne pas oublier &ccedil;a pour le post
		xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

		var aenvoyer = "pseudo=<?php echo jsencode($pseudo); ?>&value=<?php echo $pass; ?>&type="+type+"&id="+i;

		xhr.send(aenvoyer);
}


</script>


<?php
  

//////////////////////////////////////////////////////////////////////////////////////////
$reponse_sg_flotte_units = mysql_query("SELECT * FROM sg_flotte_units WHERE id_joueur='$id_joueur'");      //
$reponse_sg_planete_units_2 = mysql_query("SELECT * FROM sg_planete_units WHERE id_joueur='$id_joueur'");    //
                                         
// Initialisation de $nb_vaisseau_total /////////////////////
for ($i=0;$i < $nb_spatial;$i++)  
{              
  $nb_vaisseau_total[$i] = "0"; 
}              
/////////////////////////////////////////////////////// 
//Initialisation de $nb_terrestre_total // 
for ($i=0;$i < $nb_terrestre;$i++)   
{                  
  $nb_terrestre_total[$i] = "0";
}                   
///////////////////////////////////////////////////////                        //

// Jusqu'a ce que  l'on ai trait&eacute; tous les types d'unit&eacute;s pr&eacute;sent sur la flotte
while ($donnees_sg_flotte_units = mysql_fetch_array($reponse_sg_flotte_units))       //            
{                                            //
  if ($donnees_sg_flotte_units['unit'] == 'spatial')  // Si c'est du spatial          //
  {                                          //
    $type_flotte = $donnees_sg_flotte_units['type'];                //
    $nb_vaisseau_total[$type_flotte] = $nb_vaisseau_total[$type_flotte] + $donnees_sg_flotte_units['nombre'];  //
  }                                          //
  else    // SI c'ets du terrestre                              //
  {                                          //
    $type_terrestre = ($donnees_sg_flotte_units['type']);                //
    @$nb_terrestre_total[$type_terrestre] = $nb_terrestre_total[$type_terrestre] + $donnees_sg_flotte_units['nombre'];  //
  }                                          //
}                                            //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Idem mais pour les plapla
while ($donnees_sg_planete_units_2 = mysql_fetch_array($reponse_sg_planete_units_2))             
{                                          
                                           
  if ($donnees_sg_planete_units_2['unit'] == 'spatial')                
  {                                         
    $type_flotte = $donnees_sg_planete_units_2['type'];               
    $nb_vaisseau_total[$type_flotte] = $nb_vaisseau_total[$type_flotte] + $donnees_sg_planete_units_2['nombre'];  //
    
  }                                       
  else                                      
  {                                   
    $type_terrestre = ($donnees_sg_planete_units_2['type']);         
    $nb_terrestre_total[$type_terrestre] = $nb_terrestre_total[$type_terrestre] + $donnees_sg_planete_units_2['nombre'];  //
    
  }                                          
}    

//
//////////////////////////////////////////////////////////////////////////////////////////




  

  
$incr=0; // On initialise la boucle
$reponse_sg_planete_comm = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo'");
// On boucle sur toutes les plan&egrave;tes  
while ($donnees_sg_planete_comm = mysql_fetch_array($reponse_sg_planete_comm)) {
  
  $coord_X = $donnees_sg_planete_comm['coord_X'];
  $coord_Y = $donnees_sg_planete_comm['coord_Y'];
  $nom = $donnees_sg_planete_comm['nom'];
  $id_planete = $donnees_sg_planete_comm['id'];
  
  $type = "planete";
  
  if ($incr % 2 == 0) {
    echo "<tr bgcolor=\"#6983A3\">";
  } else {
    echo "<tr bgcolor=\"#717D8D\">";
  }
  
  if ($nom == "") {
    echo '<form method="post" action="#">'; // Pour dans le cas où une des plapla ne soit pas encore nomm&eacute;e
    $nom = '<input type="text" name="nom_planete" size="20" maxlength="20" />';
    $nom .= '<input type="hidden" value="'.$id_planete.'" name="id_planete">';
    
    $nom2 = "";
  } else {
    $nom = '<a href="accueil.php?page=carte&type=plapla&nom='.urlencode($nom).'">'.$nom.'</a>';
  }
  
  ?>
      <td style="width:30%" align="center"><?php echo $nom; ?></td>
      <td style="width:10%" align="center">X<?php echo $coord_X; ?></td>
      <td style="width:10%" align="center">Y<?php echo $coord_Y; ?></td>
      <?        
      if (isset($nom2))
      {
        echo '<td align="center"><input type="submit" value="Renommer" name="submit" /></td>';
        echo '</form>';
      }
      else
      {
        ?>
        <td style="width:20%" align="center"><div class="a" onMouseDown="(Affbulle2('<?
                  

                  echo quote( '<p><b>Etape 1 :</b> Choisissez le nombre d unit&eacute;s a transf&eacute;rer :</p>');


                    $reponse_sg_planete = mysql_query("SELECT * FROM sg_planete WHERE id='$id_planete' ");
                    $donnees_sg_planete = mysql_fetch_array($reponse_sg_planete);
                    $nom_planete = $donnees_sg_planete['nom'];
                    $id_planete = $donnees_sg_planete['id'];
                    
                    $type = "planete";
  
                    $vaisseau_nombre_planete[0] = '$vaisseau_nombre_planete';
                    $terrestre_nombre_planete[0] = '$terrestre_nombre_planete';
                    

                      for ($i=0;$i <= $nb_spatial;$i++)                           //
                      {    
                        if (!isset($vaisseau_nombre_planete[$id_planete][$i]))
                        $vaisseau_nombre_planete[$id_planete][$i] = "0";
                      }  
                      for ($i=0;$i <= $nb_terrestre;$i++)                           //
                      {    
                        if (!isset($terrestre_nombre_planete[$id_planete][$i]))
                        $terrestre_nombre_planete[$id_planete][$i] = "0";
                      }    
                      
                    $reponse_sg_planete_units = mysql_query("SELECT * FROM sg_planete_units WHERE id_joueur='$id_joueur' AND id_planete='$id_planete' ");
                    while($donnees_sg_planete_units = mysql_fetch_array($reponse_sg_planete_units))
                    {

                      
                      if ($donnees_sg_planete_units['unit'] == 'spatial')
                      {
                        $type_planete = $donnees_sg_planete_units['type'];
                        $vaisseau_nombre_planete[$id_planete][$type_planete] = $donnees_sg_planete_units['nombre'];
                      }
                      else
                      {
                        $type_terrestre = ($donnees_sg_planete_units['type']);
                        $terrestre_nombre_planete[$id_planete][$type_terrestre] = $donnees_sg_planete_units['nombre'];
                      }
                      
              
                      
                    /////////////////////////////////////////////////////////////////////////////////////////////

                      
                    
                    }
            

                  ?><form method=post action=accueil.php?page=commandement&action=transfert name=trans_planete><table border=0><tr><td>Nom</td><td>Sur <?php echo quote( $nom_planete); ?></td><td>En tout</td><td>Transfert</td></tr><?

                        




                  for ($i=0;$i<$nb_spatial;$i++)
                  {
                    $vaisseau = $liste_spatial[$i];
                    

                    if ($i % 2 == 0) 
                    {
                      echo quote( "<tr bgcolor=#6983A3>");
                    } else 
                    {
                      echo quote( "<tr bgcolor=#717D8D>");
                    }

                      
                      echo quote( '<td width=45%>'.$liste_spatial[$i].'</td>');
                      echo quote( '<td width=20%><div name=planete_flotte_nb_'.$id_planete.'_'.$i.' id=planete_flotte_nb_'.$id_planete.'_'.$i.'>'. $vaisseau_nombre_planete[$id_planete][$i] . '</div></td>');
                      echo quote( '<td width=20%>' . $nb_vaisseau_total[$i] . '</td>');
                      echo quote( '<td width=15%><input type=text id=planete_flotte_'.$id_planete.'_'.$i.' size=6></td>');
                     echo quote( '</tr>');
                  }
                    
                  echo quote( '<tr><td colspan=4><hr width=100% ></td></tr>');
                    
                  for ($i=0;$i<$nb_terrestre;$i++)
                  {
                    $terrestre = $liste_terrestre[$i];
                    

                    if ($i % 2 == 0) 
                    {
                      echo quote( "<tr bgcolor=#6983A3>");
                    } else 
                    {
                      echo quote( "<tr bgcolor=#717D8D>");
                    }

                      
                      echo quote( '<td>'.$liste_terrestre[$i].'</td>');
                      echo quote( '<td><div id=planete_terrestre_nb_'.$id_planete.'_'.$i.' name=planete_terrestre_nb_'.$id_planete.'_'.$i.'>'. $terrestre_nombre_planete[$id_planete][$i] . '</div></td>');
                      echo quote( '<td>' . $nb_terrestre_total[$i] . '</td>');
                      echo quote( '<td><input type=text id=planete_terrestre_'.$id_planete.'_'.$i.' size=6></td>');
                    echo quote( '</tr>');
                  }


                  ?><tr><td colspan=4><b>Etape 2 :</b>Choisissez une destination :</td></tr><tr><td colspan=3><select NAME=destination_planete_<?php echo $id_planete; ?> id = destination_planete_<?php echo $id_planete; ?> size=1><?php

                      
                        echo quote(  '<optgroup label=planetes>');
                        $reponse_sg_planete_nom_id = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo'");
                        while ($donnees_sg_planete_nom_id = mysql_fetch_array($reponse_sg_planete_nom_id)) 
                        {
                          $planete_id = $donnees_sg_planete_nom_id['id'];
                          $planete_nom = $donnees_sg_planete_nom_id['nom'];
                          
                          if ($planete_id !== $id_planete)
                          {            
                          ?><option value=<?php echo quote( urlencode("p_".$planete_id)); ?>>(P)&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo quote( $planete_nom); ?>&nbsp;&nbsp;&nbsp;&nbsp;</option><?php
                          }          
                          


                        }
                        echo quote(  '<optgroup label=Flottes>');
                        $reponse_sg_flotte = mysql_query("SELECT * FROM sg_flotte WHERE pseudo='$pseudo'");
                        while ($donnees_sg_flotte = mysql_fetch_array($reponse_sg_flotte)) 
                        {
                          $flotte_nom = $donnees_sg_flotte['nom'];
                          $flotte_id = $donnees_sg_flotte['id'];  
                          

                            ?><option value=<?php echo quote( urlencode("f_".$flotte_id)); ?>>(F)&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo quote( $flotte_nom); ?>&nbsp;&nbsp;&nbsp;&nbsp;</option><?php
                          



                        }
                        ?></select></td><td><input type=button value=Ok onClick=planete(<?php echo $id_planete; ?>);></td></tr></table><input type=hidden value=planete name=type><input type=hidden value=<?php echo quote( $id_planete); ?> id=planete_<?php echo $id_planete; ?>></form>', '400')); maj_units_planete(<?php echo $id_planete;?>);"><a> Transfert</a></div>
                        </td>
                        
      <td style="width:30%" align="center"><div id="puissance_planete_<?php echo $id_planete; ?>"><?php echo puissance_plapla($id_planete, $pseudo); ?></div></td>
                        
                        
      <?
      }
      ?>
    </tr>
  <?    
	for ($y=0;$y< $nb_spatial; $y++)
	{
		echo '<input type="hidden" id="planete_flotte_rest_' .$id_planete .'_' . $y .'" value="0" />';
	}

	for ($y = 0;$y < $nb_terrestre; $y++)
	{
		echo '<input type="hidden" id="planete_terrestre_rest_' .$id_planete .'_' . $y .'" value="0" />';
	}
echo '<input type="hidden" id="puissance_planete_rest_' .$id_planete .'" value="0" />';
$incr++;

}
?>
</table>
<br />
</td>
</tr>
</table>
<br />
<table border="0" cellpadding="0" cellspacing="0" height="50" width="570">
<tr>
<td><p><b>Vos flottes</b></p>


<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE pseudo='$pseudo'");
$donnees = mysql_fetch_array($retour);
$nombre_de_flotte = $donnees['nbre_entrees'];  


if (isset($message_decollage))
	echo $message_decollage;

if (isset($nom2)) {
  echo '<p>Vous devez d\'abord nommer toutes vos plan&egrave;tes.</p>';
}





if (($nombre_de_flotte<3) AND (!isset($nom2))) {


  $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_flotte WHERE pseudo='$pseudo'");
  $donnees = mysql_fetch_array($retour);
  $nombre_de_flotte = $donnees['nbre_entrees'];
  
  if ($nombre_de_flotte>=3)  {
    
  } else {
  
  
  $nb_restante = (3-$nombre_de_flotte);
  if ($nb_restante != 1) $test = true;
  else $test = false;

    ?>
    <form method="post" action="accueil.php?page=commandement" class="form">
    <p>Vous pouvez d'ici g&eacute;rer le d&eacute;colage de vos flottes (<?php echo $nb_restante; ?> restante<?php if ($test) echo 's'; ?>).
    
    <br /><br />
    Nom de la flotte : <input type="text" name="nom" size="20"><br />
    Plan&egrave;te de lancement de la flotte :
    <select name="base_de_lancement" size="1">
    <option VALUE="Aucune">-&nbsp;&nbsp;Aucune</option>
    
    <?
    
    $reponse = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo'");
      
    while ($donnees = mysql_fetch_array($reponse)) {
      $planete_lancement = $donnees['nom'];
      ?>
    
      <option value="<?php echo $planete_lancement; ?>">-&nbsp;&nbsp;<?php echo $planete_lancement; ?></option>
      <?
    }
    echo '</select>'                                                          
    .'<input style="margin-left:10px;"type="submit" value="Lancer la flotte">'                                          //
    .'</p>'                                                                
    .'</form>';                                                              
  }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////










if ($nombre_de_flotte !== '0') {
?>

<table border="0" cellpadding="4" width="100%"  align="center" valign="center">
  <tr>
    <td align="center">Nom (Voir)</td>
    <td align="center" colspan="2">Coordonn&eacute;es</td>
    <td align="center">Action</td>
    <td align="center">Puissance</td>
  </tr>
<?
}






unset($vaisseau_nombre);
unset($terrestre_nombre);    

$incr=1;
$reponse_sg_flotte_comm = mysql_query("SELECT * FROM sg_flotte WHERE pseudo='$pseudo'");  
while ($donnees_sg_flotte_comm = mysql_fetch_array($reponse_sg_flotte_comm)) 
{
  
  $coord_X = $donnees_sg_flotte_comm['coord_X'];
  $coord_Y = $donnees_sg_flotte_comm['coord_Y'];
  $nom_flotte = $donnees_sg_flotte_comm['nom'];
  $id_flotte = $donnees_sg_flotte_comm['id'];
  
  $id_type = $id_flotte;
  $type_Carte = "flotte";
  
  if ($incr % 2 == 0) {
    echo "<tr bgcolor=\"#6983A3\">";
  } else {
    echo "<tr bgcolor=\"#717D8D\">";
  }
  
  ?>
      <td style="width:30%" align="center"><a href="accueil.php?page=carte&type=flotte&nom=<?php echo urlencode("$nom_flotte");?>" ><?php echo $nom_flotte;?></a></td>
      <td style="width:10%" align="center">&nbsp; X<?php echo $coord_X; ?> &nbsp;</td>
      <td style="width:10%" align="center">&nbsp; Y<?php echo $coord_Y; ?> </td>
      <td style="width:20%" align="center"><div class="a" onMouseDown="(Affbulle2('<?
                  

                  echo quote( "<p><b>Etape 1 :</b> Choisissez le nombre d'unit&eacute;s a transf&eacute;rer :</p>");


                    $reponse_sg_flotte = mysql_query("SELECT * FROM sg_flotte WHERE id='$id_flotte' ");
                    $donnees_sg_flotte = mysql_fetch_array($reponse_sg_flotte);
                    $nom_flotte = $donnees_sg_flotte['nom'];
                    
                    $type = "flotte";
  
                    $vaisseau_nombre_flotte[0] = '$vaisseau_nombre_flotte';
                    $terrestre_nombre_flotte[0] = '$terrestre_nombre_flotte';
                    
                  /*  // Initialisation de $nb_vaisseau //  
                    $nb_vaisseau_total[0] = '$nb_vaisseau_total';
                    for ($i=1;$i <= $nb_spatial;$i++)    //                        //
                    {                    //                        //
                      $nb_vaisseau_total[$i] = "0";    //                        //
                    }                    //                        //
                    //////////////////////////////////////////  
                    $nb_terrestre_total[0] = '$nb_terrestre_total';
                    //Initialisation de $nb_terrestre_total //                        //
                    for ($i=1;$i <= $nb_terrestre;$i++)    //                        //
                    {                    //                        //
                      $nb_terrestre_total[$i] = "0";    //                        //
                    }                    //                        //
                    //////////////////////////////////////////  */
                      for ($i=0;$i < $nb_spatial;$i++)                           //
                      {    
                        if (!isset($vaisseau_nombre_flotte[$incr][$i]))
                        $vaisseau_nombre_flotte[$incr][$i] = "0";
                      }  
                      for ($i=0;$i < $nb_terrestre;$i++)                           //
                      {    
                        if (!isset($terrestre_nombre_flotte[$incr][$i]))
                        $terrestre_nombre_flotte[$incr][$i] = "0";
                      }  
                    
                    $reponse_sg_flotte_units = mysql_query("SELECT * FROM sg_flotte_units WHERE id_joueur='$id_joueur' AND id_flotte='$id_flotte' ");
                    while($donnees_sg_flotte_units = mysql_fetch_array($reponse_sg_flotte_units))
                    {
    
                      
                      if ($donnees_sg_flotte_units['unit'] == 'spatial')
                      { 
                        $type_flotte = $donnees_sg_flotte_units['type'];
                        $vaisseau_nombre_flotte[$incr][$type_flotte] = $donnees_sg_flotte_units['nombre'];
                        
                      }
                      else                      
                      {
                        $type_terrestre = ($donnees_sg_flotte_units['type']);
                        $terrestre_nombre_flotte[$incr][$type_terrestre] = $donnees_sg_flotte_units['nombre'];
                        
                      }

                    
                      
                    /////////////////////////////////////////////////////////////////////////////////////////////

                      
                    
                    }
                  ?><form method=post action=accueil.php?page=commandement&action=transfert name=trans_flotte><table border=0><tr><td>Nom</td><td>Sur <?php echo quote( $nom_flotte); ?></td><td>En tout</td><td>Transfert</td></tr><?

                        




                  for ($i=0;$i<$nb_spatial;$i++)
                  {
                    $vaisseau = $liste_spatial[$i];
                    

                    if ($i % 2 == 0) 
                    {
                      echo quote( "<tr bgcolor=#6983A3>");
                    } else 
                    {
                      echo quote( "<tr bgcolor=#717D8D>");
                    }

                      echo quote( '<td width=45%>'.$liste_spatial[$i].'</td>');
                      echo quote( '<td width=20%><div name=flotte_flotte_nb_'.$id_flotte.'_'.$i.' id=flotte_flotte_nb_'.$id_flotte.'_'.$i.'>'. $vaisseau_nombre_flotte[$incr][$i] . '</div</td>');
                      echo quote( '<td width=20%>' . $nb_vaisseau_total[$i] . '</td>');
                      echo quote( '<td width=15%><input type=text id=flotte_flotte_'.$id_flotte.'_'.$i.' size=6></td>');
                    echo quote( '</tr>');
                  }
                    
                  echo quote( '<tr><td colspan=4><hr width=100% ></td></tr>');
                    
                  for ($i=0;$i<$nb_terrestre;$i++) {
                    $terrestre = $liste_terrestre[$i];
                    

                    if ($i % 2 == 0) 
                    {
                      echo quote( "<tr bgcolor=#6983A3>");
                    } else 
                    {
                      echo quote( "<tr bgcolor=#717D8D>");
                    }

                      
                      echo quote( '<td>'.$liste_terrestre[$i].'</td>');
                      echo quote( '<td><div name=flotte_terrestre_nb_'.$id_flotte.'_'.$i.' id=flotte_terrestre_nb_'.$id_flotte.'_'.$i.'>'. $terrestre_nombre_flotte[$incr][$i] . '</div></td>');
                      echo quote( '<td>' . $nb_terrestre_total[$i] . '</td>');
                      echo quote( '<td><input type=text id=flotte_terrestre_'.$id_flotte.'_'.$i.' size=6></td>');
                    echo quote( '</tr>');
                  }


                  ?><tr><td colspan=4><b>Etape 2 :</b>Choisissez une destination :</td></tr><tr><td colspan=3><select NAME=destination_flotte_<?php echo $id_flotte; ?> id=destination_flotte_<?php echo $id_flotte; ?> size=1><?php

                      
                        echo quote(  '<optgroup label=planetes>');
                        $reponse_sg_planete_nom_id = mysql_query("SELECT * FROM sg_planete WHERE pseudo='$pseudo'");
                        while ($donnees_sg_planete_nom_id = mysql_fetch_array($reponse_sg_planete_nom_id)) 
                        {
                          $planete_id = $donnees_sg_planete_nom_id['id'];
                          $planete_nom = $donnees_sg_planete_nom_id['nom'];
          
                          ?><option value=<?php echo quote( urlencode("p_".$planete_id)); ?>>(P)&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo quote( $planete_nom); ?>&nbsp;&nbsp;&nbsp;&nbsp;</option><?php
        
                          


                        }
                        echo quote(  '<optgroup label=Flottes>');
                        $reponse_sg_flotte = mysql_query("SELECT * FROM sg_flotte WHERE pseudo='$pseudo'");
                        while ($donnees_sg_flotte = mysql_fetch_array($reponse_sg_flotte)) 
                        {
                          $flotte_nom = $donnees_sg_flotte['nom'];
                          $flotte_id = $donnees_sg_flotte['id'];  
                          
                          if ($flotte_id !== $id_flotte)
                          {
                            ?><option value=<?php echo quote( urlencode("f_".$flotte_id)); ?>>(F)&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo quote( $flotte_nom); ?>&nbsp;&nbsp;&nbsp;&nbsp;</option><?php
                          }



                        }
                        ?></select></td><td><input type=button value=Ok onClick=flotte(<?php echo $id_flotte; ?>);></td></tr></table><input type=hidden value=<?php echo quote($id_flotte); ?> id=flotte_<?php echo $id_flotte ?>></form>', '400')); maj_units_flotte(<?php echo $id_flotte;?>);"> <a> Transfert</a></div>

      
</td>

      <td style="width:30%" align="center"><div id="puissance_flotte_<?php echo $id_flotte; ?>"><?php echo puissance_flotte($id_flotte, $pseudo); ?></div></td>

</tr>
    <?       
	for ($y=0;$y< $nb_spatial; $y++)
	{
		echo '<input type="hidden" id="flotte_flotte_rest_' .$id_flotte .'_' . $y .'" value="0" />';
	}

	for ($y = 0;$y < $nb_terrestre; $y++)
	{
		echo '<input type="hidden" id="flotte_terrestre_rest_' .$id_flotte .'_' . $y .'" value="0" />';
	}
	
echo '<input type="hidden" id="puissance_flotte_rest_' .$id_flotte .'" value="0" />';

                   
  $incr++;
  }
/*  print_rr($vaisseau_nombre_flotte);
  print_rr($terrestre_nombre_flotte);
  print_rr($nb_vaisseau_total);
  print_rr($nb_terrestre_total);
  */
 
  
if ($nombre_de_flotte !== '0') {
?>
</table>

<?
}
?>
  
  <br />
  </td>
</tr>
</table>