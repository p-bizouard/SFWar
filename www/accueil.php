<?
// SG-War Version Beta
ini_set("url_rewriter.tags","a=href,area=href,frame=src,iframe=src,input=src");
ini_set('arg_separator.output', '&amp;');
session_start();

require_once ("../connexion.php");
require_once ("include/fonction.php");

$page='';
@$pseudo=$_SESSION["pseudo"];
@$id_joueur =$_SESSION["id_joueur"];

// on vérifie que le joueur existe.
player_exist($pseudo,'Erreur existe accueil 1');

if ((!isset($_SESSION["pseudo"]) AND isset($pseudo))) {
include ("index.php");
die("");
}

if ((isset($_GET["page"])) AND (!empty($_GET["page"]))) {
	$page=$_GET["page"];
} elseif ((isset($_POST["page"])) AND (!empty($_POST["page"]))) {
	$page=$_POST["page"];
}


$tabPage = array (
	'historique' => array ("Historique", "index/historique.php"),
	'suppression_historique' => array ("Historique", "index/suppression_historique.php"),
	'mine' => array ("Gestion de vos mines", "index/mine.php"),
	'carte' => array ("Commandement des flottes", "index/carte.php"),
	'commandement' => array ("Poste de Commandement", "index/commandement.php"),
	'creation_flotte' => array ("Création de flottes", "index/creation_flotte.php"),
	'spatial' => array ("Création de flottes", "index/spatial.php"),
	'combat' => array ("Rapport du Combat Spatial", "index/combat.php"),
	'simulation' => array ("Vaisseaux et simulation", "index/simulation.php"),
	'combat_2' => array ("Rapport du Combat Terrestre", "index/combat_2.php"),
	'profil' => array ("Profil des membres", "index/profil.php"),
	'messagerie' => array ("Messagerie interne", "index/messagerie.php"),
	'message' => array ("Messagerie interne", "index/message.php"),
	'recrutement' => array ("Recrutement", "index/recrutement.php"),
	'classement' => array ("Classement", "index/classement.php"),
	'transfert' => array ("Transfert", "index/transfert.php"),
	'guilde' => array ("Guilde", "index/guilde.php"),
	'chat' => array ("Chat", "index/chat.php"),
	'mort_reinscription' => array ("Ré-inscription", "index/mort_reinscription.php"),
	'aide' => array ("Aide", "index/aide.php"),
	'' => array ("Historique", "index/historique.php")



);


if ($page=="carte" AND isset($_GET["direction"])) {
   $direction=$_GET["direction"];
}
if ($page=="carte" AND isset($_GET["flotte"])) {
   $nom_flotte=$_GET["flotte"];
}
          


if (isset($tabPage["$page"][0]) AND isset($tabPage["$page"][1])) {

	require_once ("include/majressources.php");
	
	require_once ("include/haut_page_acceuil.php");


        $titre=$tabPage["$page"][0];
        include($tabPage["$page"][1]);

	require_once ("include/bas_page_acceuil.php");
} else {

	require_once ("include/haut_page_index.php");
	
	$titre="Bienvenue dans SG-War";
	include("index/index.php");
	
	require_once ("include/bas_page_index.php");
}
