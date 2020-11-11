<?
// SG-War Version Beta
ini_set("url_rewriter.tags","a=href,area=href,frame=src,iframe=src,input=src");
ini_set('arg_separator.output', '&amp;');
session_start();
 
if ((isset($_GET['action'])) AND ($_GET['action'] == "deco")) {
  session_destroy();
  unset($_SESSION);
}
require_once ("../connexion.php");
require_once ("include/fonction.php");
require_once ("include/haut_page_index.php");

@$page=$_GET["page"];// Le @ permet de ne pas avoir d'erreur si il n'arrive pas a récupérer la variable.
if ($page=="") @$page=$_POST["page"];

$tabPage = array (
	'index' => array ("Bienvenue dans SG-War", "index/index.php"),
	'erreur' => array ("Une erreur est survenue", "index/erreur.php"),
	'inscription' => array ("Inscription à SG-War", "index/inscription.php"),
	'login' => array ("Vous voici connecté", "index/login.php"),
	'reglement' => array ("Règlement", "index/reglement.php"),
	'pre_requis' => array ("Prè requis", "index/pre_requis.php"),
	'remerciements' => array ("Remerciements", "index/remerciements.php"),
	'aide' => array ("Aide", "index/aide.php"),
	'' => array ("Bienvenue dans SG-War", "index/index_index.php")


);

if ((isset($pseudo)) AND (!empty($pseudo)) AND $_GET["page"] != "mort_reinscription" AND $_GET["page"] != "inscription" AND $_GET["page"] != "login") {
	if (verif_mort_perso($pseudo)) {
		mort_reinscription();
	}
}
	
$test = false;
for ($i = 0; $i < count($tabPage); $i++)
{
	if (key($tabPage) == $page)
		$test = true;
	next($tabPage);
}
if (!$test)
	$page = 'index';

$titre=$tabPage["$page"][0];
include($tabPage["$page"][1]);


require_once ("include/bas_page_index.php");
?>



