<?php

$race = array('tauri','goauld','ori','bsg','cylon');

$type_vaisseaux = array ('Chasseur','Bombardier','Soutient','Assaut');

//$liste_tauri = array('F-302', 'Jumper', 'Prométhé (BC-303)', 'Dédale (BC-304)');
//$liste_goauld = array('Planeur de la Mort', 'Vaisseau Teltak', 'Al&#39;Kesh', 'Vaisseau Ha&#39;tak');
//$liste_ori = array('Chasseur', 'Chasseur lourd', 'Vaisseau de guerre', 'Vaisseau mère');
//$liste_bsg = array('Viper', 'Rapace', 'Pegasus', 'Galactica');
//$liste_cylon = array('Raider', 'Raider Lourd', 'Vaisseau de résurection', 'Base cylon');

$bonus_spatial = array(
		'0' => ',0,1,',
		'1' => ',2,3,',
		'2' => ',0,1,',
		'3' => ',2,3,'
);

$bonus_terrestre = array(
		'0' => ',1,',
		'1' => ',2,',
		'2' => ',0,'
);

$vaisseaux = array (
	'0' => array (
		'Attaque_min' 	=>25,
		'Attaque_max' 	=>100,
		'Vie_min' 	=>250,
		'Vie_max' 	=>600,
		'Taille' 	=>3,
		'Puissance' 	=>100,
		'Fer'		=> 660,
		'Carbone'	=> 360,
		'Or'		=> 120,
		'Naquada'	=> 36,
		'Trinium'	=> 24,
		'Population' 	=> 4),
	'1' => array (
		'Attaque_min' 	=>19,
		'Attaque_max' 	=>86,
		'Vie_min' 	=>355,
		'Vie_max' 	=>868,
		'Taille' 	=>4,
		'Puissance' 	=>140,
		'Fer'		=> 990,
		'Carbone'	=> 540,
		'Or'		=> 180,
		'Naquada'	=> 54,
		'Trinium'	=> 36,
		'Population' 	=> 13),
	'2' => array (
		'Attaque_min' 	=>60,
		'Attaque_max' 	=>350,
		'Vie_min' 	=>130,
		'Vie_max' 	=>1940,
		'Taille' 	=>6,
		'Puissance' 	=>300,
		'Fer'		=> 1980,
		'Carbone'	=> 1080,
		'Or'		=> 360,
		'Naquada'	=> 108,
		'Trinium'	=> 72,
		'Population' 	=> 30),
	'3' => array (
		'Attaque_min' 	=>45,
		'Attaque_max' 	=>490,
		'Vie_min' 	=>600,
		'Vie_max' 	=>4500,
		'Taille' 	=>15,
		'Puissance' 	=>670,
		'Fer'		=> 4422,
		'Carbone'	=> 2412,
		'Or'		=> 804,
		'Naquada'	=> 241,
		'Trinium'	=> 160,
		'Population' 	=> 65)
);

$terrestre = array (
	'0' => array ('Attaque_min' 	=>1,
		'Attaque_max' 	=>3,
		'Vie_min' 	=>5,
		'Vie_max' 	=>10,
		'Taille' 	=>1,
		'Puissance' 	=>8,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 10,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1),
	'1' => array (
		'Attaque_min' 	=>2,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>5,
		'Vie_max' 	=>13,
		'Taille' 	=>1,
		'Puissance' 	=>10,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 13,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1),
	'2' => array (
		'Attaque_min' 	=>3,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>3,
		'Vie_max' 	=>20,
		'Taille' 	=>1,
		'Puissance' 	=>12,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 20,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1
		)
);


$vaisseaux_tauri = array (

	'F-302' => array (
		'Attaque_min' 	=>25,
		'Attaque_max' 	=>100,
		'Vie_min' 	=>250,
		'Vie_max' 	=>600,
		'Taille' 	=>3,
		'Puissance' 	=>100,
		'Fer'		=> 660,
		'Carbone'	=> 360,
		'Or'		=> 120,
		'Naquada'	=> 36,
		'Trinium'	=> 24,
		'Population' 	=> 4,
		'Type' 	=> "Chasseur",
		'Description' 	=> 'Vaisseau terrien inspiré des planeurs de la mort. Il est léger, rapide, efficace en dogfight.',
		'Image' 		=> 'images/units/tauri_f302.jpg'),

	'Jumper' => array (
		'Attaque_min' 	=>19,
		'Attaque_max' 	=>86,
		'Vie_min' 	=>355,
		'Vie_max' 	=>868,
		'Taille' 	=>4,
		'Puissance' 	=>140,
		'Fer'		=> 990,
		'Carbone'	=> 540,
		'Or'		=> 180,
		'Naquada'	=> 54,
		'Trinium'	=> 36,
		'Population' 	=> 13,
		'Type' 	=> "Bombardier",
		'Description' 	=> 'Vaisseau qui appartenait aux anciens. Ces modèles ne disposent pas d\'E2PZ, mais disposent d\'une puissance de feu non négligeable, principalement contre les vaisseaux de grosse envergure.',
    'Image' 	=> 'images/units/tauri_jumper.jpg'),

	'Prométhé (BC-303)' => array (
		'Attaque_min' 	=>60,
		'Attaque_max' 	=>350,
		'Vie_min' 	=>130,
		'Vie_max' 	=>1940,
		'Taille' 	=>6,
		'Puissance' 	=>300,
		'Fer'		=> 1980,
		'Carbone'	=> 1080,
		'Or'		=> 360,
		'Naquada'	=> 108,
		'Trinium'	=> 72,
		'Population' 	=> 30,
		'Type' 	=> "Soutient",
		'Description' 	=> 'Le Prométhée ou BC-303 (désigné X-303 pendant la phase de développement) est entièrement de conception humaine. Il est principalement efficasse contre les chasseurs et les bombardiers.',
    'Image' => 'images/units/tauri_promethe.jpg'),

	'Dédale (BC-304)' => array (
		'Attaque_min' 	=>45,
		'Attaque_max' 	=>490,
		'Vie_min' 	=>600,
		'Vie_max' 	=>4500,
		'Taille' 	=>15,
		'Puissance' 	=>670,
		'Fer'		=> 4422,
		'Carbone'	=> 2412,
		'Or'		=> 804,
		'Naquada'	=> 241,
		'Trinium'	=> 160,
		'Population' 	=> 65,
		'Type' 	=> "Assaut",
		'Description' 	=> 'Seconde version du BC-303, il est surtout oriente vers les combats d\'importance capitale, tel que les vaisseaux de classe Assaut ou soutient.',
    'Image' 		=> 'images/units/tauri_dedale.jpg')

	
);	


$liste_tauri = array('F-302', 'Jumper', 'Prométhé (BC-303)', 'Dédale (BC-304)');

$terrestre_tauri = array (
	'P90' => array (
		'Attaque_min' 	=>1,
		'Attaque_max' 	=>3,
		'Vie_min' 	=>5,
		'Vie_max' 	=>10,
		'Taille' 	=>1,
		'Puissance' 	=>8,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 10,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Le P-90 est un pistolet mitrailleur développé à la fin des années 1980 par FN Herstal, entreprise d\'armement belge. Il a été conçu comme arme personelle de défense ou PDW (personal defense weapon) pour les officiers. les équipages de véhicules, serveurs d\'artillerie.',
    'Image' 		=> 'images/units/tauri_p90.jpg'),
		
	'M4' => array (
		'Attaque_min' 	=>2,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>5,
		'Vie_max' 	=>13,
		'Taille' 	=>1,
		'Puissance' 	=>10,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 13,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Le M4 est une arme d\'assaut par exelence, et peut s\'adapter a toutes les situations. Il s\'aggit du\'un  M16 avec crosse téléscopique, cache flamme amélioré, canon et mécanisme d\'emprunt de gaz raccourci et tirant automatique.',
    'Image' 		=> 'images/units/tauri_m4.jpg'),
		
	'Tourelle Mobile' => array (
		'Attaque_min' 	=>3,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>3,
		'Vie_max' 	=>20,
		'Taille' 	=>1,
		'Puissance' 	=>12,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 100,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'La tourelle mobile est une arme lourde, et extremement efficase contre les attaques ennemies ou la defence de points strategiques.',
    'Image' 		=> 'images/units/tauri_tourellemobile.jpg')
);	

$liste_terrestre_tauri = array('P90', 'M4', 'Tourelle Mobile');



$vaisseaux_goauld = array (

	'Planeur de la Mort' => array (
		'Attaque_min' 	=>25,
		'Attaque_max' 	=>100,
		'Vie_min' 	=>250,
		'Vie_max' 	=>600,
		'Taille' 	=>3,
		'Puissance' 	=>100,
		'Fer'		=> 660,
		'Carbone'	=> 360,
		'Or'		=> 120,
		'Naquada'	=> 36,
		'Trinium'	=> 24,
		'Population' 	=> 4,
		'Type' 	=> "Chasseur",
		'Description' 	=> 'Le planeur de la mort est un vaisseau Goa\'uld. Leger, rapide est extremement efficase lors des combats raproches contre les autres chasseurs.',
    'Image' 		=> 'images/units/goauld_planeurdelamort.jpg'),

	'Vaisseau Teltak' => array (
		'Attaque_min' 	=>19,
		'Attaque_max' 	=>86,
		'Vie_min' 	=>355,
		'Vie_max' 	=>868,
		'Taille' 	=>4,
		'Puissance' 	=>140,
		'Fer'		=> 990,
		'Carbone'	=> 540,
		'Or'		=> 180,
		'Naquada'	=> 54,
		'Trinium'	=> 36,
		'Population' 	=> 13,
		'Type' 	=> "Bombardier",
		'Description' 	=> 'Le vaisseau Teltak est a la base un vaisseau de transport, mais lourdement arme, et capable de rivaliser face a des vaisseaux de type assaut ou soutient.',
    'Image' 		=> 'images/units/goauld_teltak.jpg'),

	'Al&#39;Kesh' => array (
		'Attaque_min' 	=>60,
		'Attaque_max' 	=>350,
		'Vie_min' 	=>130,
		'Vie_max' 	=>1940,
		'Taille' 	=>6,
		'Puissance' 	=>300,
		'Fer'		=> 1980,
		'Carbone'	=> 1080,
		'Or'		=> 360,
		'Naquada'	=> 108,
		'Trinium'	=> 72,
		'Population' 	=> 30,
		'Type' 	=> "Soutient",
		'Description' 	=> 'Le Al\'Kesh  est un vaisseau d\'assaut, rapide pour sa taille, il est capable de faire face a une attaque massive de chasseurs et de bombardiers.',
    'Image' 		=> 'images/units/goauld_alkesh.jpg'),

	'Vaisseau Ha&#39;tak' => array (
		'Attaque_min' 	=>45,
		'Attaque_max' 	=>490,
		'Vie_min' 	=>600,
		'Vie_max' 	=>4500,
		'Taille' 	=>15,
		'Puissance' 	=>670,
		'Fer'		=> 4422,
		'Carbone'	=> 2412,
		'Or'		=> 804,
		'Naquada'	=> 241,
		'Trinium'	=> 160,
		'Population' 	=> 65,
		'Type' 	=> "Assaut",
		'Description' 	=> 'Le Ha\'Tak est le vaisseaux mere Goa\'uld par excelence. Les flottes en etaient majoritairement constitues.',
    'Image' 		=> 'images/units/goauld_hatak.jpg')
	
	
);	


$terrestre_goauld = array (
	'Zat`n`ktel' => array (
		'Attaque_min' 	=>1,
		'Attaque_max' 	=>3,
		'Vie_min' 	=>5,
		'Vie_max' 	=>10,
		'Taille' 	=>1,
		'Puissance' 	=>8,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 10,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Le Zat est une arme de poing inventes par les Go\'Ulds. Lors du premier tire, il assome l\'ennemi, lors du second, il le tue.',
    'Image' 		=> 'images/units/goauld_zat.jpg'),
		
	'Lance Goa`uld' => array (
		'Attaque_min' 	=>2,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>5,
		'Vie_max' 	=>13,
		'Taille' 	=>1,
		'Puissance' 	=>10,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 13,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'La lance est la principale arme des soldats goaulds. Bien que peu pratique lors des combats en interieur, elle est d\'une eficassite redoutable en exterieur.',
    'Image' 		=> 'images/units/goauld_lance.jpg'),
		
	'Canon Énergétique' => array (
		'Attaque_min' 	=>3,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>3,
		'Vie_max' 	=>20,
		'Taille' 	=>1,
		'Puissance' 	=>12,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 100,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Le canon energetique est une arme lourde, utilisee principalement pour defendre et garder une position.',
    'Image' 		=> 'images/units/goauld_canon.jpg')
);
$liste_terrestre_goauld = array('Zat`n`ktel', 'Lance Goa`uld', 'Canon Énergétique');
$liste_goauld = array('Planeur de la Mort', 'Vaisseau Teltak', 'Al&#39;Kesh', 'Vaisseau Ha&#39;tak');







$vaisseaux_ori = array (

	'Chasseur' => array (
		'Attaque_min' 	=>25,
		'Attaque_max' 	=>100,
		'Vie_min' 	=>250,
		'Vie_max' 	=>600,
		'Taille' 	=>3,
		'Puissance' 	=>100,
		'Fer'		=> 660,
		'Carbone'	=> 360,
		'Or'		=> 120,
		'Naquada'	=> 36,
		'Trinium'	=> 24,
		'Population' 	=> 4,
		'Type' 	=> "Chasseur",
		'Description' 	=> 'Les chasseurs Oris sont les vaisseaux de bases, legerement armnes, mais tres rapides. Ils sont redoutable lors des combats face a des vaisseaux tels que les chasseurs ou les Bombardiers.',
    'Image' 		=> 'images/units/ori_chasseur.jpg'),

	'Chasseur lourd' => array (
		'Attaque_min' 	=>19,
		'Attaque_max' 	=>86,
		'Vie_min' 	=>355,
		'Vie_max' 	=>868,
		'Taille' 	=>4,
		'Puissance' 	=>140,
		'Fer'		=> 990,
		'Carbone'	=> 540,
		'Or'		=> 180,
		'Naquada'	=> 54,
		'Trinium'	=> 36,
		'Population' 	=> 13,
		'Type' 	=> "Bombardier",
		'Description' 	=> 'Ces modeles de chasseurs sont quipes d\'armes plus lourdes, reduisant leur mobilite, mais augmentant grandement leur puissance de feu, notement face a des vaisseaux de grande envergure.',
    'Image' 		=> 'images/units/ori_chasseur.jpg'),

	'Vaisseau de guerre' => array (
		'Attaque_min' 	=>60,
		'Attaque_max' 	=>350,
		'Vie_min' 	=>130,
		'Vie_max' 	=>1940,
		'Taille' 	=>6,
		'Puissance' 	=>300,
		'Fer'		=> 1980,
		'Carbone'	=> 1080,
		'Or'		=> 360,
		'Naquada'	=> 108,
		'Trinium'	=> 72,
		'Population' 	=> 30,
		'Type' 	=> "Soutient",
		'Description' 	=> 'Les vaisseaux de guerre Oris sont des vaisseaux d\'assaut, tres efficaces contre les chasseurs et les bombardiers.',
    'Image' 		=> 'images/units/ori_soutient.jpg'),

	'Vaisseau mère' => array (
		'Attaque_min' 	=>45,
		'Attaque_max' 	=>490,
		'Vie_min' 	=>600,
		'Vie_max' 	=>4500,
		'Taille' 	=>15,
		'Puissance' 	=>670,
		'Fer'		=> 4422,
		'Carbone'	=> 2412,
		'Or'		=> 804,
		'Naquada'	=> 241,
		'Trinium'	=> 160,
		'Population' 	=> 65,
		'Type' 	=> "Assaut",
		'Description' 	=> 'Les Vaisseaux mere Oris sont plus resistants que leurs homologues de guerre, et disposent d\'un faisceau laser capable de passer nimporte quel bouclier. Il est redoutable face aux vaisseaux de type assaut et soutient.',
    'Image' 		=> 'images/units/ori_mere.jpg')

);	

$liste_ori = array('Chasseur', 'Chasseur lourd', 'Vaisseau de guerre', 'Vaisseau mère');

$terrestre_ori = array (
	'Soldat Ori' => array (
		'Attaque_min' 	=>1,
		'Attaque_max' 	=>3,
		'Vie_min' 	=>5,
		'Vie_max' 	=>10,
		'Taille' 	=>1,
		'Puissance' 	=>8,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 10,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Les soldats Ori de bases sont des simples paysans recruté dans le vaste empire Ori. Une arme simple, aucune armure, leur force est leur nombre.',
		'Description' 	=> 'Les soldats Oris sont equipes de lances, mais bien que peu pratique dans les endroits a mobilite reduite, les hommes qui les tiennent sont des fanatiques, prets a donner leur vie.',
		'Image' 		=> 'images/units/ori_soldat.jpg'),
		
	'Soldat d\'éliteOri' => array (
		'Attaque_min' 	=>2,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>5,
		'Vie_max' 	=>13,
		'Taille' 	=>1,
		'Puissance' 	=>10,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 13,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Image' 		=> 'images/units/ori_precheur.jpg'),
	
	'Precheur' => array(
	'Attaque_min' 	=>1,
		'Attaque_min' 	=>3,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>3,
		'Vie_max' 	=>20,
		'Taille' 	=>1,
		'Puissance' 	=>12,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 100,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Les precheurs Oris sont dotes de pouvoirs surnaturels. A eux seuls ils peuvent lutter contre toute une escouade ennemie.',
		'Image' 		=> 'images/units/ori_precheur.jpg')
  );	

$liste_terrestre_ori = array('Soldat Ori', 'Precheur');




$vaisseaux_bsg = array (

	'Viper' => array (
		'Attaque_min' 	=>25,
		'Attaque_max' 	=>100,
		'Vie_min' 	=>250,
		'Vie_max' 	=>600,
		'Taille' 	=>3,
		'Puissance' 	=>100,
		'Fer'		=> 660,
		'Carbone'	=> 360,
		'Or'		=> 120,
		'Naquada'	=> 36,
		'Trinium'	=> 24,
		'Population' 	=> 4,
		'Type' 	=> "Chasseur",
		'Description' 	=> 'Ces Vipers de type Mark VII sont tres efficaces contre les vaisseaux de petite envergure, tel que les Chasseurs et les Bombardiers.',
    'Image' 		=> 'images/units/bsg_viper.jpg'),

	'Rapace' => array (
		'Attaque_min' 	=>19,
		'Attaque_max' 	=>86,
		'Vie_min' 	=>355,
		'Vie_max' 	=>868,
		'Taille' 	=>4,
		'Puissance' 	=>140,
		'Fer'		=> 990,
		'Carbone'	=> 540,
		'Or'		=> 180,
		'Naquada'	=> 54,
		'Trinium'	=> 36,
		'Population' 	=> 13,
		'Type' 	=> "Bombardier",
		'Description' 	=> 'Les raports sont principalement utilises pour des missions de transport ou de reconaissance, mais ils disposent d\'armes destructrices contre les vaisseaux imposants.',
    'Image' 		=> 'images/units/bsg_rapace.jpg'),

	'Pegasus' => array (
		'Attaque_min' 	=>60,
		'Attaque_max' 	=>350,
		'Vie_min' 	=>130,
		'Vie_max' 	=>1940,
		'Taille' 	=>6,
		'Puissance' 	=>300,
		'Fer'		=> 1980,
		'Carbone'	=> 1080,
		'Or'		=> 360,
		'Naquada'	=> 108,
		'Trinium'	=> 72,
		'Population' 	=> 30,
		'Type' 	=> "Soutient",
		'Description' 	=> 'Vaiseau de classe Battlestar. Commandé durant un certain temps par le commandant Apollo. Il dispose de plusieurs escadrons de vipers et de raptors, ce aui fait qu\il est tres efficace contre les Chasseurs et les Bombardiers.',
    'Image' 		=> 'images/units/bsg_pegasus.jpg'),

	'Galactica' => array (
		'Attaque_min' 	=>45,
		'Attaque_max' 	=>490,
		'Vie_min' 	=>600,
		'Vie_max' 	=>4500,
		'Taille' 	=>15,
		'Puissance' 	=>670,
		'Fer'		=> 4422,
		'Carbone'	=> 2412,
		'Or'		=> 804,
		'Naquada'	=> 241,
		'Trinium'	=> 160,
		'Population' 	=> 65,
		'Type' 	=> "Assaut",
		'Description' 	=> 'Un second vaisseau de classe Battlestar. Il est eauipe d\'ogives nucleaires et de canon lourds, il est de ce fait l\'un des meilleurs vaisseaux contre les Assauts et les Soutients.',
    'Image' 		=> 'images/units/bsg_bsg.jpg')
	
);	

$liste_bsg = array('Viper', 'Rapace', 'Pegasus', 'Galactica');

$terrestre_bsg = array (
	'H&K MP-5' => array (
		'Attaque_min' 	=>1,
		'Attaque_max' 	=>3,
		'Vie_min' 	=>5,
		'Vie_max' 	=>10,
		'Taille' 	=>1,
		'Puissance' 	=>8,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 10,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Le MP-5 est un fusil automatique leger, et peu encombrant. Il trouve sa place dans nimporte quelle situation.',
    'Image' 		=> 'images/units/bsg_mp5.jpg'),
		
	'Beretta Cx4 Storm' => array (
		'Attaque_min' 	=>2,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>5,
		'Vie_max' 	=>13,
		'Taille' 	=>1,
		'Puissance' 	=>10,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 13,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Le nouveau Beretta Cx4 Storm est un fusil semi-automatique avec un design particulièrement intéressant et facile d\'utilisation.',
    'Image' 		=> 'images/units/bsg_beretta.jpg'),
		
	'Lance missile' => array (
		'Attaque_min' 	=>3,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>3,
		'Vie_max' 	=>20,
		'Taille' 	=>1,
		'Puissance' 	=>12,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 100,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Lance missile de type Eryx, il est capable de deloger nimporte quel ennemi d\'une position retranche.',
    'Image' 		=> 'images/units/bsg_lancemissile.jpg')
);	

$liste_terrestre_bsg = array('H&K MP-5', 'Beretta Cx4 Storm', 'Lance missile');



$vaisseaux_cylon = array (
    
	'Raider' => array (
		'Attaque_min' 	=>25,
		'Attaque_max' 	=>100,
		'Vie_min' 	=>250,
		'Vie_max' 	=>600,
		'Taille' 	=>3,
		'Puissance' 	=>100,
		'Fer'		=> 660,
		'Carbone'	=> 360,
		'Or'		=> 120,
		'Naquada'	=> 36,
		'Trinium'	=> 24,
		'Population' 	=> 4,
		'Type' 	=> "Chasseurs",
		'Description' 	=> 'Les chasseurs Cylons sont rapide, et disposent d\'armes legeres, mais restent destructeurs facent a d\'autres chasseurs ou ades bombardiers.',
    'Image' 		=> 'images/units/cylon_chasseur.jpg'),
    
	'Raider Lourd' => array (
		'Attaque_min' 	=>19,
		'Attaque_max' 	=>86,
		'Vie_min' 	=>355,
		'Vie_max' 	=>868,
		'Taille' 	=>4,
		'Puissance' 	=>140,
		'Fer'		=> 990,
		'Carbone'	=> 540,
		'Or'		=> 180,
		'Naquada'	=> 54,
		'Trinium'	=> 36,
		'Population' 	=> 13,
		'Type' 	=> "Bombardier",
		'Description' 	=> 'Les bombardiers cylons disposent d\'un lourd arsenal, et sont tres éfficaces contre les vaisseaux mères, et de classe Battlestar.',
    'Image' 		=> 'images/units/cylon_raiderlourd.jpg'),

	'Vaisseau de résurection' => array (
		'Attaque_min' 	=>60,
		'Attaque_max' 	=>350,
		'Vie_min' 	=>130,
		'Vie_max' 	=>1940,
		'Taille' 	=>6,
		'Puissance' 	=>300,
		'Fer'		=> 1980,
		'Carbone'	=> 1080,
		'Or'		=> 360,
		'Naquada'	=> 108,
		'Trinium'	=> 72,
		'Population' 	=> 30,
		'Type' 	=> "Soutient",
		'Description' 	=> 'Vaisseau cylon jouant un double rôle : elle fait récusiter les cylons a proximité, et servant de plateforme contre les chasseurs et les bombardiers ennemis.',
    'Image' 		=> 'images/units/cylon_resu.jpg'),

	'Base cylon' => array (
		'Attaque_min' 	=>45,
		'Attaque_max' 	=>490,
		'Vie_min' 	=>600,
		'Vie_max' 	=>4500,
		'Taille' 	=>15,
		'Puissance' 	=>670,
		'Fer'		=> 4422,
		'Carbone'	=> 2412,
		'Or'		=> 804,
		'Naquada'	=> 241,
		'Trinium'	=> 160,
		'Population' 	=> 65,
		'Type' 	=> "Assaut",
		'Description' 	=> 'Vaisseaux de combats cylons par excellence. Ils disposent d\'une grande force de frappe contre les vaisseaux de combats énnemis.',
    'Image' 		=> 'images/units/cylon_base.jpg')

);	

$liste_cylon = array('Raider', 'Raider Lourd', 'Vaisseau de résurection', 'Base cylon');

$terrestre_cylon = array (
	'Humanoïde' => array (
		'Attaque_min' 	=>1,
		'Attaque_max' 	=>3,
		'Vie_min' 	=>5,
		'Vie_max' 	=>10,
		'Taille' 	=>1,
		'Puissance' 	=>8,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 10,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Les humanoïde sont des versions humines de cylons. Bien que moins puissances et moins resistantes que les centurions, ces repliques peuvent tout de meme infiltrer les rangs humains.',
    'Image' 		=> 'images/units/bsg_mp5.jpg'),
    
	'Centurion' => array (
		'Attaque_min' 	=>2,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>5,
		'Vie_max' 	=>13,
		'Taille' 	=>1,
		'Puissance' 	=>10,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 13,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Ces robots furent à la base créés par les humains. Ils disposent d\'une grande puissance d\'attaque et d\une structure très résistante.',
    'Image' 		=> 'images/units/cylon_centurion.jpg'),
    
	'Mortier Cylon' => array (
		'Attaque_min' 	=>3,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>3,
		'Vie_max' 	=>20,
		'Taille' 	=>1,
		'Puissance' 	=>12,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 100,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Les mortiers Cylons sont des armes destructrices, capable de faire un barage pour stopper une progression ennemie, ou de les deloger de leur retranchement.',
    'Image' 		=> 'images/units/cylon_mortier.jpg')
);	

$liste_terrestre_cylon = array('Humanoïde', 'Centurion', 'Mortier Cylon');























$vaisseaux_neutre = array (

	'F-302' => array (
		'Attaque_min' 	=>25,
		'Attaque_max' 	=>100,
		'Vie_min' 	=>250,
		'Vie_max' 	=>600,
		'Taille' 	=>3,
		'Puissance' 	=>100,
		'Fer'		=> 660,
		'Carbone'	=> 360,
		'Or'		=> 120,
		'Naquada'	=> 36,
		'Trinium'	=> 24,
		'Population' 	=> 4,
		'Type' 	=> "Chasseur",
		'Description' 	=> 'Vaisseau terrien inspiré des planeurs de la mort. Il est léger, rapide, efficace en dogfight.',
		'Image' 		=> 'images/units/tauri_f302.jpg'),

	'Jumper' => array (
		'Attaque_min' 	=>37,
		'Attaque_max' 	=>171,
		'Vie_min' 	=>710,
		'Vie_max' 	=>1735,
		'Taille' 	=>6,
		'Puissance' 	=>280,
		'Fer'		=> 1980,
		'Carbone'	=> 1080,
		'Or'		=> 360,
		'Naquada'	=> 108,
		'Trinium'	=> 72,
		'Population' 	=> 25,
		'Type' 	=> "Bombardier",
		'Description' 	=> 'Vaisseau qui appartenait aux anciens. Ces modèles ne disposent pas d\'E2PZ, mais disposent d\'une puissance de feu non négligeable, principalement contre les vaisseaux de grosse envergure.',
    'Image' 	=> 'images/units/tauri_jumper.jpg'),

	'Prométhé (BC-303)' => array (
		'Attaque_min' 	=>60,
		'Attaque_max' 	=>350,
		'Vie_min' 	=>130,
		'Vie_max' 	=>1940,
		'Taille' 	=>6,
		'Puissance' 	=>300,
		'Fer'		=> 1980,
		'Carbone'	=> 1080,
		'Or'		=> 360,
		'Naquada'	=> 108,
		'Trinium'	=> 72,
		'Population' 	=> 30,
		'Type' 	=> "Soutient",
		'Description' 	=> 'Le Prométhée ou BC-303 (désigné X-303 pendant la phase de développement) est entièrement de conception humaine. Il est principalement efficasse contre les chasseurs et les bombardiers.',
    'Image' => 'images/units/tauri_promethe.jpg'),

	'Dédale (BC-304)' => array (
		'Attaque_min' 	=>45,
		'Attaque_max' 	=>490,
		'Vie_min' 	=>600,
		'Vie_max' 	=>4500,
		'Taille' 	=>15,
		'Puissance' 	=>670,
		'Fer'		=> 4422,
		'Carbone'	=> 2412,
		'Or'		=> 804,
		'Naquada'	=> 241,
		'Trinium'	=> 160,
		'Population' 	=> 65,
		'Type' 	=> "Assaut",
		'Description' 	=> 'Seconde version du BC-303, il est surtout oriente vers les combats d\'importance capitale, tel que les vaisseaux de classe Assaut ou soutient.',
    'Image' 		=> 'images/units/tauri_dedale.jpg')

	
);	


$liste_neutre = array('F-302', 'Jumper', 'Prométhé (BC-303)', 'Dédale (BC-304)');

$terrestre_neutre = array (
	'P90' => array (
		'Attaque_min' 	=>1,
		'Attaque_max' 	=>3,
		'Vie_min' 	=>5,
		'Vie_max' 	=>10,
		'Taille' 	=>1,
		'Puissance' 	=>8,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 10,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Le P-90 est un pistolet mitrailleur développé à la fin des années 1980 par FN Herstal, entreprise d\'armement belge. Il a été conçu comme arme personelle de défense ou PDW (personal defense weapon) pour les officiers. les équipages de véhicules, serveurs d\'artillerie.',
    'Image' 		=> 'images/units/tauri_p90.jpg'),
		
	'M4' => array (
		'Attaque_min' 	=>2,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>5,
		'Vie_max' 	=>13,
		'Taille' 	=>1,
		'Puissance' 	=>10,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 13,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'Le M4 est une arme d\'assaut par exelence, et peut s\'adapter a toutes les situations. Il s\'aggit du\'un  M16 avec crosse téléscopique, cache flamme amélioré, canon et mécanisme d\'emprunt de gaz raccourci et tirant automatique.',
    'Image' 		=> 'images/units/tauri_m4.jpg'),
		
	'Tourelle Mobile' => array (
		'Attaque_min' 	=>3,
		'Attaque_max' 	=>5,
		'Vie_min' 	=>3,
		'Vie_max' 	=>20,
		'Taille' 	=>1,
		'Puissance' 	=>12,
		'Fer'		=> 0,
		'Carbone'	=> 0,
		'Or'		=> 100,
		'Naquada'	=> 0,
		'Trinium'	=> 0,
		'Population' 	=> 1,
		'Description' 	=> 'La tourelle mobile est une arme lourde, et extremement efficase contre les attaques ennemies ou la defence de points strategiques.',
    'Image' 		=> 'images/units/tauri_tourellemobile.jpg')
);	

$liste_terrestre_neutre = array('P90', 'M4', 'Tourelle Mobile');

?>
