<?
	require("../../connexion.php");
	require("../include/units.php");
	require("../include/fonction.php");

$pseudo = stripslashes(urldecode($_POST['pseudo']));
$pass = stripslashes($_POST['value']);


		$reponse = mysql_query("SELECT * FROM sg_perso WHERE pseudo='".mysql_real_escape_string($pseudo)."' AND pass='".mysql_real_escape_string($pass)."'");
		$donnees = mysql_fetch_array($reponse);
		$race = $donnees['race'];
		$id_joueur = $donnees['id'];
		
if ($race == '')
	die($pseudo);


	$id_expe = $_POST['id']; // id de la flotte / plan&egrave;te expediteur
	$type_expe = $_POST['type']; // type (flotte / plapla) de l'expediteur

	$explode = explode("_", $_POST['destination']); //de la forme "p_3"
	
	if ($explode[0] == "p") $type_dest = "planete";
	elseif ($explode[0] == "f") $type_dest = "flotte";
	else 
	{
		tricheur($pseudo);
		die("Tricheur...");
	 }
$transfert_spatial = $_POST['transfert_spatial'];
$transfert_terrestre = $_POST['transfert_terrestre'];

	
	$id_dest = $explode[1]; // l&agrave; où on va envoyer
	
	$reponse = mysql_query("SELECT * FROM sg_".$type_expe." WHERE id=".$id_expe);
	$donnees = mysql_fetch_array($reponse);
	$nom_expe = $donnees['nom'];
	
	$reponse = mysql_query("SELECT * FROM sg_".$type_dest." WHERE id=".$id_dest);
	$donnees = mysql_fetch_array($reponse);
	$nom_dest = $donnees['nom'];
														
	//////////////////////////////////////////////////////////////////////////////////////
	$reponse_sg_perso = mysql_query("SELECT * FROM  sg_perso WHERE pseudo='$pseudo'");	//
	$donnees_sg_perso = mysql_fetch_array($reponse_sg_perso);							
	$race = $donnees_sg_perso['race'];													
	//////////////////////////////////////////////////////////////////////////////////////

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

  
  
  
  
  
  

  
  
  
	for ($i=0;$i<$nb_spatial;$i++)
	{
		$transfert_spatial[] = $_POST[urlencode($liste_spatial[$i])];
		
		
		if (!empty($transfert_spatial[$i])) //si au moins un champ a &eacute;t&eacute; rempli
		{
			if(is_numeric($transfert_spatial[$i]))//On v&eacute;rifie qu'il s'agit d'un nombre
			{
				
				$reponse = mysql_query("SELECT * FROM sg_".$type_expe."_units WHERE id_".$type_expe."='$id_expe' AND unit='spatial' AND type='$i'"); // on se connecte a la table des ressources
				$donnees = mysql_fetch_array($reponse);
				
				if($donnees['nombre'] <  $transfert_spatial[$i])
				{	
         echo '<br />Vous ne poss&eacute;dez pas assez de '.$liste_spatial[$i].' sur votre plan&egrave;te d\'origine pour efectuer le transfert.';
				}
				else
				{
				
					$select = "SELECT * FROM sg_".$type_dest."_units WHERE type=".$i." AND unit='spatial' AND id_".$type_dest."='$id_dest'";
					$resselect = @mysql_query ($select);	
					
					if (!mysql_num_rows($resselect))
					{
						
						mysql_query("INSERT INTO sg_".$type_dest."_units (id, id_joueur, id_".$type_dest.", type, nombre, unit) VALUES ('','$id_joueur', '$id_dest', '$i', '$transfert_spatial[$i]', 'spatial')")
						or die("Rat&eacute;1");
						echo '<p>Vous avez transf&eacute;r&eacute; ' . $transfert_spatial[$i] . ' ' . $liste_spatial[$i] . ' de la ' . $type_expe . ' <b>' . $nom_expe . '</b> vers la ' . $type_dest . ' <b>' . $nom_dest . '</b>.</p>';
					}
					else
					{

						mysql_query("UPDATE sg_".$type_dest."_units SET nombre=nombre+".$transfert_spatial[$i]." WHERE type=".$i." AND unit='spatial' AND id_".$type_dest."=".$id_dest."")
						or die("Rat&eacute;2");
						echo '<p>Vous avez transf&eacute;r&eacute; ' . $transfert_spatial[$i] . ' ' . $liste_spatial[$i] . ' de la ' . $type_expe . ' <b>' . $nom_expe . '</b> vers la ' . $type_dest . ' <b>' . $nom_dest . '</b>.</p>';
					}
					mysql_query ("UPDATE sg_".$type_expe."_units SET nombre=nombre-".$transfert_spatial[$i]." WHERE type=".$i." AND unit='spatial' AND id_".$type_expe."=".$id_expe)
					or die("Rat&eacute;3");
					
					if (($donnees['nombre'] - $transfert_spatial[$i]) < 1) {
						mysql_query ("DELETE FROM sg_".$type_expe."_units WHERE type=".$i." AND unit='spatial' AND id_".$type_expe."=".$id_expe);
					}
          
				}
			}
			
		}
	}
  
	for ($i = 0; $i<$nb_terrestre;$i++)
	{
		$transfert_terrestre[] = $_POST[urlencode($liste_terrestre[$i])];
		
		
		
		if (!empty($transfert_terrestre[$i])) //si au moins un champ a &eacute;t&eacute; rempli
		{
			if(is_numeric($transfert_terrestre[$i]))//On v&eacute;rufue qu'il s'agit d'un nombre
			{
				$y = $i;
				
				$reponse = mysql_query("SELECT * FROM sg_".$type_expe."_units WHERE id_".$type_expe."='$id_expe' AND unit='terrestre' AND type='$y'"); // on se connecte a la table des ressources
				$donnees = mysql_fetch_array($reponse);
				
				if($donnees['nombre'] <  $transfert_terrestre[$i])
				{	
					echo 'Vous ne poss&eacute;dez pas assez de '.$liste_terrestre[$i].' sur votre plan&egrave;te d\'origine pour efectuer le transfert.';
				}
				else
				{
				
					$select = "SELECT * FROM sg_".$type_dest."_units WHERE type=".$y." AND unit='terrestre' AND id_".$type_dest."='$id_dest'";
					$resselect = @mysql_query ($select);					
					
					if (!mysql_num_rows($resselect))
					{
						
						mysql_query("INSERT INTO sg_".$type_dest."_units (id, id_joueur, id_".$type_dest.", type, nombre, unit) VALUES ('','$id_joueur', '$id_dest', '$y', '$transfert_terrestre[$i]', 'terrestre')")
						or die("Rat&eacute;1");
						echo '<p>Vous avez transf&eacute;r&eacute; ' . $transfert_terrestre[$i] . ' ' . $liste_terrestre[$i] . ' de la ' . $type_expe . ' <b>' . $nom_expe . '</b> vers la ' . $type_dest . ' <b>' . $nom_dest . '</b>.</p>';
					}
					else
					{

						mysql_query("UPDATE sg_".$type_dest."_units SET nombre=nombre+".$transfert_terrestre[$i]." WHERE type=".$y." AND unit='terrestre' AND id_".$type_dest."=".$id_dest."")
						or die("Rat&eacute;2");
						echo '<p>Vous avez transf&eacute;r&eacute; ' . $transfert_terrestre[$i] . ' ' . $liste_terrestre[$i] . ' de la ' . $type_expe . ' <b>' . $nom_expe . '</b> vers la ' . $type_dest . ' <b>' . $nom_dest . '</b>.</p>';
					}
					mysql_query ("UPDATE sg_".$type_expe."_units SET nombre=nombre-".$transfert_terrestre[$i]." WHERE type=".$y." AND unit='terrestre' AND id_".$type_expe."=".$id_expe)
					or die("Rat&eacute;3");
						
					if (($donnees['nombre'] - $transfert_terrestre[$i]) < 1) {
						mysql_query ("DELETE FROM sg_".$type_expe."_units WHERE type=".$y." AND unit='terrestre' AND id_".$type_expe."=".$id_expe);
					}
          
				}
			}
			
		}
	}
	

?>
