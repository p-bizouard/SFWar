<?php

//////////////////////////////////////////////////
//////////////////////normal//////////////////////
require ("batiment.php");
//////////////////////////////////////////////////
//////////////////////////////////////////////////


//////////////////////////////////////////////////
///////////////////Ressources/////////////////////
$reponse = mysql_query("SELECT * FROM sg_ressource WHERE pseudo='$pseudo'"); // on se connecte a la table des ressources
$donnees = mysql_fetch_array($reponse);
//pour récupérer le niveau des mines
$ressource_fer = $donnees['fer'];
$ressource_carbone = $donnees['carbone'];
$ressource_or = $donnees['or'];
$ressource_naquada = $donnees['naquada'];
$ressource_trinium = $donnees['trinium'];
$population = $donnees['population'];
$popularite = $donnees['popularite'];
/////////////////////////fin///////....///////////
//////////////////////////////////////////////////

//////////////////////////////////////////////////
////////////////Nombres de planètes///////////////
$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_planete WHERE pseudo='$pseudo'");
$donnees = mysql_fetch_array($retour);
$nb_planetes = $donnees['nbre_entrees'];
//////////////////////////////////////////////////
//////////////////////////////////////////////////


//////////////////////////////////////////////////
/////////////////////Hangars//////////////////////
$reponse = mysql_query("SELECT * FROM  sg_construction WHERE pseudo='$pseudo'"); // on se connecte a la table des contruction
$donnees = mysql_fetch_array($reponse);
//pour récupérer le niveau des centres de stokage
$immeuble = $donnees['immeuble'];

	//////////////////////////////////////Upgrade des mines/////////////////////////////////
	$timeend = $donnees['timeend'];
	$batiment = $donnees['batiment'];
	$time=time();
	if ($timeend < $time) { $requete = mysql_query("UPDATE sg_construction SET `$batiment`=`$batiment`+1, timeend='0', batiment='' WHERE pseudo='$pseudo'"); }
	//////////////////////////////////////Upgrade des mines/////////////////////////////////

$Y = $batiment_liste["Batiment_06"][1];
$Z = $batiment_liste["Batiment_06"][2];
$immeuble =(floor(($Y*pow($Z,$immeuble))));


//////////////////////////////////////////////////
////////////////////mines_niveau//////////////////
$reponse = mysql_query("SELECT * FROM  sg_construction WHERE pseudo='$pseudo'"); // on se connecte a la table des niveaux
$donnees = mysql_fetch_array($reponse);

$niveau_mine_fer = $donnees['fer'];
$niveau_mine_carbone = $donnees['carbone'];
$niveau_mine_or = $donnees['or'];
$niveau_mine_naquada = $donnees['naquada'];
$niveau_mine_trinium = $donnees['trinium'];
////////////////////////fin///////////////////////
//////////////////////////////////////////////////

//////////////////////////////////////////////////
////////////////////time_maj//////////////////////
$reponse = mysql_query("SELECT maj FROM sg_perso WHERE pseudo='$pseudo'");
$donnees = mysql_fetch_array($reponse);
$maj=$donnees['maj']; //on va chercher le dernier time() enregistré
$nbsec= time()-$maj;  // on soustrait le time() récupéré au time() courant
///////////////////////fin////////////////////////
//////////////////////////////////////////////////



//////////////////////////////////////////////////
////////////////////Fer///////////////////////////
//echo"<b>Fer :</b><br />";
$Y = $batiment_liste["Batiment_01"][1];
$Z = $batiment_liste["Batiment_01"][2];

$production_mine_fer_normal  = ($Y*pow($Z,$niveau_mine_fer))/3600; // Production par secondes (/3600)
$production_fer_round=round(($production_mine_fer_normal *$nbsec),2); //Production en naquada a mettre a jour
$production_fer=floor($production_fer_round);
$reste_fer=$production_fer_round-$production_fer;
/////////////////////carbone_fin///////////////////////
//////////////////////////////////////////////////


//////////////////////////////////////////////////
////////////////////carbone////////////////////////////
$Y = $batiment_liste["Batiment_02"][1];
$Z = $batiment_liste["Batiment_02"][2];

$production_mine_carbone_normal  = ($Y*pow($Z,$niveau_mine_carbone))/3600; // Production par secondes (/3600)
$production_carbone_round=round(($production_mine_carbone_normal *$nbsec),2); //Production en naquada a mettre a jour
$production_carbone=floor($production_carbone_round);
$reste_carbone=$production_carbone_round-$production_carbone;
/////////////////////carbone_fin///////////////////////
//////////////////////////////////////////////////


//////////////////////////////////////////
////////////////////or////////////////////////////
$Y = $batiment_liste["Batiment_03"][1];
$Z = $batiment_liste["Batiment_03"][2];

$production_mine_or_normal = ($Y*pow($Z,$niveau_mine_or))/3600; // Production par secondes (/3600)
$production_or_round=round(($production_mine_or_normal*$nbsec),2); //Production en naquada a mettre a jour
$production_or=floor($production_or_round);
$reste_or=$production_or_round-$production_or;
/////////////////////or_fin///////////////////////
//////////////////////////////////////////////////


//////////////////////////////////////////////////
//////////////////Naquada/////////////////////////
//echo"<b>Naquada :</b><br />";
$Y = $batiment_liste["Batiment_04"][1];
$Z = $batiment_liste["Batiment_04"][2];
//echo"X= $X<br />";
$production_mine_naquada_normal = ($Y*pow($Z,$niveau_mine_naquada))/3600; // Production par secondes (/3600)
$production_naquada_round=round(($production_mine_naquada_normal*$nbsec),2); //Production en naquada a mettre a jour
$production_naquada=floor($production_naquada_round);
$reste_naquada=$production_naquada_round-$production_naquada;
//////////////////Naquada_fin/////////////////////
//////////////////////////////////////////////////


//////////////////////////////////////////////////
//////////////////Trinium/////////////////////////
//echo"<b>Trinium :</b><br />";
$Y = $batiment_liste["Batiment_05"][1];
$Z = $batiment_liste["Batiment_05"][2];

$production_mine_trinium_normal = ($Y*pow($Z,$niveau_mine_trinium))/3600; // Production par secondes (/3600)
$production_trinium_round=round(($production_mine_trinium_normal*$nbsec),2); //Production en naquada a mettre a jour
$production_trinium=floor($production_trinium_round);
$reste_trinium=$production_trinium_round-$production_trinium;
///////////////////Trinium_fin////////////////////
//////////////////////////////////////////////////

//////////////////////////////////////////////////
///////////////////Population/////////////////////
$alpha=0.1;
$maj_population = $population + $alpha*$nbsec * $nb_planetes;
if ($maj_population > $immeuble) {$maj_population=$immeuble;};
//////////////////Fin Population//////////////////
//////////////////////////////////////////////////

//////////////////////////////////////////////////
///////////Multiplication par planètes////////////
$production_fer = $production_fer + $production_fer * ($nb_planetes*15/100);
$production_carbone = $production_carbone + $production_carbone  * ($nb_planetes*15/100);
$production_naquada = $production_naquada + $production_naquada  * ($nb_planetes*15/100);
$production_trinium = $production_trinium  + $production_trinium * ($nb_planetes*15/100);
$production_or = $production_or + $production_or  * ($nb_planetes*15/100);
/////////Multiplication par planètes fin//////////
//////////////////////////////////////////////////

//////////////////////////////////////////////////
/////////////Mise a jour de la bdd////////////////
$maj_fer=$production_fer+$ressource_fer;
//echo "maj_fer = $maj_fer<br />";
$maj_carbone=$production_carbone+$ressource_carbone;
//echo"maj_carbone = $maj_carbone<br />";
$maj_or=$production_or+$ressource_or;
//echo"maj_or = $maj_or<br />";
$maj_naquada=$production_naquada+$ressource_naquada+$reste_naquada;
//echo"maj_naquada = $maj_naquada<br />";
$maj_trinium=$production_trinium+$ressource_trinium+$reste_trinium;
//echo"maj_trinium = $maj_trinium<br /><br />";

$requete = mysql_query("UPDATE sg_ressource SET fer=$maj_fer WHERE pseudo='$pseudo'"); // on met a jour la production de fer
$requetes = mysql_query("UPDATE sg_ressource SET `or`=$maj_or WHERE pseudo='$pseudo'");// // on met a jour la production de carbonne
$requetes = mysql_query("UPDATE sg_ressource SET carbone=$maj_carbone WHERE pseudo='$pseudo'");// // on met a jour la production de carbonne
$requete = mysql_query("UPDATE sg_ressource SET naquada='$maj_naquada' WHERE pseudo='$pseudo'"); // on met a jour la production de naquada
$requete = mysql_query("UPDATE sg_ressource SET trinium='$maj_trinium' WHERE pseudo='$pseudo'"); // on met a jour la production de trinium
$requete = mysql_query("UPDATE sg_ressource SET population='$maj_population' WHERE pseudo='$pseudo'"); // on met a jour la population
$time=time(); 
$reponse = mysql_query("UPDATE sg_perso SET maj='$time' WHERE pseudo='$pseudo'");
//////////////////////fin/////////////////////////
//////////////////////////////////////////////////

//////////////////////////////////////////////////
///////////////comptage resources ////////////////
$fer = number_format($maj_fer, 0, ' ', ' ');
$carbone = number_format($maj_carbone, 0, ' ', ' ');
$or = number_format($maj_or, 0, ' ', ' ');
$naquada = number_format($maj_naquada, 0, ' ', ' ');
$trinium = number_format($maj_trinium, 0, ' ', ' ');
if ($maj_population > $immeuble) $population= "<font color=#FF0000>".number_format($maj_population, 0, ' ', ' ')."</font>";
else $population = number_format($maj_population, 0, ' ', ' ');
//////////////comptage resources fin//////////////
//////////////////////////////////////////////////
?>
