<?php





	require("../../connexion.php");
	require("../include/units.php");
	require("../include/fonction.php");

$pseudo = stripslashes(urldecode($_POST['pseudo']));
$pass = stripslashes($_POST['value']);
		$reponse = mysql_query("SELECT * FROM sg_perso WHERE pseudo='$pseudo' AND pass='$pass'");
		$donnees = mysql_fetch_array($reponse);
		$race=$donnees['race'];
		
if ($race == '')
	die($pseudo);
		

		//////////////////////SPATIAL/////////////////////////////////////////////////////////////////////////////
		$liste_spatial = ${'liste_'.$race}; 	// $liste_tauri = array( 'F-16', 'X-301', ...					//
		$vaisseaux = ${'vaisseaux_'.$race}; 	//c'est les caract&eacute;ristiques de tous les vaisseaux				//
		$nb_spatial = count($liste_spatial);	// c'est pour savoir combien il y a de nombre de vaisseaux diff	//
		//////////////////////////////////////////////////////////////////////////////////////////////////////////
			
		//////////////////////TERRESTRE///////////////////////////////////////////////////////////////////////////
		$liste_terrestre = ${'liste_terrestre_'.$race};// $liste_terrestre_tauri = array( 'H&K MP-5', 'P90',...	//
		$terrestre = ${'terrestre_'.$race}; //c'est les caract&eacute;ristiques de tous les terr.						//
		$nb_terrestre = count($liste_terrestre);// c'est pour savoir combien il y a de nombre de terr. diff		//
		//////////////////////////////////////////////////////////////////////////////////////////////////////////







		
		$reponse 	= mysql_query("SELECT * FROM sg_ressource WHERE pseudo='$pseudo'"); // on se connecte a la table des ressources
		$donnees 	= mysql_fetch_array($reponse);
		$ress_fer 		= $donnees['fer'];
		$ress_carbone 	= $donnees['carbone'];
		$ress_or 		= $donnees['or'];
		$ress_naquada 	= $donnees['naquada'];
		$ress_trinium 	= $donnees['trinium'];
		$ress_pop		= $donnees['population'];	
		
		//Juste pour pas m&eacute;langer les variables
		//////////////////////////////////////
		$ress_rest_fer 		= $ress_fer;	//
		$ress_rest_carbone 	= $ress_carbone;//
		$ress_rest_or 		= $ress_or;		//
		$ress_rest_naquada 	= $ress_naquada;//
		$ress_rest_trinium 	= $ress_trinium;//
		$ress_rest_pop 		= $ress_pop;	//
		//////////////////////////////////////
		
		$test = "true"; //Initialisation
		
		for ($i=0;$i<$nb_spatial;$i++)
		{
		
			//echo '<donnee>'.$_POST["vaisseau".$i].'</donnee>';     
			
			
			@$achat[] = $_POST["vaisseau_".$i];
			//c'est le nombre de vaisseau de type $i achet&eacute;
			
			if (!empty($achat[$i])) //si au moins un champ a &eacute;t&eacute; rempli
			{
				if(is_numeric($achat[$i]))//On v&eacute;rufue qu'il s'agit d'un nombre
				{
					$achat2[$i] = floor($achat[$i]);//on arondi, d&egrave;s fois qu'un malin veuille qu'une moiti&eacute; de vaisseau
						
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
				//echo '<p class="erreur">Merci de choisir un nombre r&eacute;el pour les vaisseaux : ' . $liste_spatial[$i] . '</p>';
				
				echo ('<p class="erreur">Merci de choisir un nombre r&eacute;el pour les vaisseaux : ' . $liste_spatial[$i] . '</p>');
				$test = "false";
				}
				
			}
			
		}
		
		

	$test2 = "false";
		
		
	for ($i=0;$i< $nb_terrestre;$i++)
		{
		
			@$achat_terrestre[] = $_POST["terrestre_".$i];
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
					echo ('<p class="erreur">Merci de choisir un nombre r&eacute;el pour les unit&eacute;es terrestres suivantes : ' . $liste_terrestre[$i] . '</p>');
					$test = "false";
				}
				
			}
			
		}	
		
		if ($ress_rest_fer < "0") { echo ('<p class="erreur">Vous ne poss&eacute;dez pas sufisament de fer ( '. number_format($ress_rest_fer, 0, ' ', ' ') . ').</p>'); $test = "false"; }
		if ($ress_rest_carbone < "0") { echo ('<p class="erreur">Vous ne poss&eacute;dez pas sufisament de carbone ( '. number_format($ress_rest_carbone, 0, ' ', ' ') . ').</p>'); $test = "false"; }
		if ($ress_rest_or < "0") { echo ('<p class="erreur">Vous ne poss&eacute;dez pas sufisament de or ( '. number_format($ress_rest_or, 0, ' ', ' ') . ').</p>'); $test = "false"; }
		if ($ress_rest_naquada < "0") { echo ('<p class="erreur">Vous ne poss&eacute;dez pas sufisament de naquada ( '. number_format($ress_rest_naquada, 0, ' ', ' ') . ').</p>'); $test = "false"; }
		if ($ress_rest_pop < "0") { echo ('<p class="erreur">Vous ne poss&eacute;dez pas sufisament de population civile ( '. number_format($ress_rest_pop, 0, ' ', ' ') . ').</p>'); $test = "false"; }
		
		
		
		
		
		
		
		
		
//On boucle sur le resultat


?>
