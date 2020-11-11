<table border="0" cellpadding="0" cellspacing="0" height="50" width="570">
<tr>
	<td class="Ttexte" align="left" background="images/Tete.png" valign="middle"><?php echo $titre_erreur; ?></td>
	</tr>
</table>
				
<table border="0" cellpadding="0" cellspacing="0" height="50" width="570">
<tr>
	<td> <p><?php echo $message_erreur; ?></p> </td>
</tr>
</table>
<?

if ($page=="carte" AND isset($_GET["direction"])) {
   $direction=$_GET["direction"];
}
if ($page=="carte" AND isset($_GET["flotte"])) {
   $nom_flotte=$_GET["flotte"];
}
          


if (isset($tabPage["$page"][0]) AND isset($tabPage["$page"][1])) {

	require_once ("include/haut_page_acceuil.php");
	require_once ("include/majressources.php");

        $titre=$tabPage["$page"][0];
        //include($tabPage["$page"][1]);

	require_once ("include/bas_page_acceuil.php");
} else {

	require_once ("include/haut_page_index.php");
	
	$titre="Bienvenue dans SG-War";
	include("index/index.php");
	
	require_once ("include/bas_page_index.php");
}

?>