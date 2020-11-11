<?
session_start() ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>SG-War [Jeu Online gratuit et multijoueur]</title>
	<!-- <link rel="Shortcut Icon" href="../images/icone2.png" /> -->
	<link rel="stylesheet" href="../include/style.css" />
    	<meta http-equiv="Content-Language" content="fr" />
	<meta name="reply-to" content="mj@sg-war.com" />
	<meta name="category" content="Jeux" />
	<meta name="robots" content="index, follow" />
	<meta name="Keywords" content="" />
	<meta name="distribution" content="local" />
	<meta name="revisit-after" content="15 days" />
	<meta name="author" lang="fr" content="Gueust, L&eacute;odi" />
	<meta name="copyright" content="G&L products" />
	<meta name="generator" content="Script Edit" />
	<meta name="identifier-url" content="http://" />
	<meta name="expires" content="never" />
	<meta name="Date-Creation-yyyymmdd" content="20040124" />
	
<!-- D&eacute;but
function twFermer() {
  window.close();
}
// Fin -->
</script>

</head>
<body>


<div align="center">


<br />
<table border="0" cellpadding="0" cellspacing="0" width="200">
<tr>
	<td align="center" valign="top" width="40">
	
			
	</td>
	<td class="centre ; texte" align="center" valign="top">
		<table border="0" cellpadding="0" cellspacing="0" width="100">
		<tr>
			<td height="23" width="32"><img src="../images/page_haut_gauche.png" /></td>
			<td background="../images/page_haut.png">&nbsp;</td>
			<td height="23" width="32"><img src="../images/page_haut_droit.png" /></td>
		</tr>
		<tr>
			<td background="../images/page_gauche.png">&nbsp;</td>
			<td align="center"class="centre ; texte">
		<?	/* On inclue la page*/
@$page=$_GET["page"];// Le @ permet de ne pas avoir d'erreur si il n'arrive pas a r&eacute;cup&eacute;rer la variable.
if ($page=="") @$page=$_POST["page"];


$tabPage = array (
	'descrtech' => array ("Les Batiments", "../index/descriptif_technique.php"),
);

if (isset($tabPage["$page"][0]) AND isset($tabPage["$page"][1])) {


	$titre=$tabPage["$page"][0];
	include($tabPage["$page"][1]);

}
?>
			</td>
			<td background="../images/Cdroit.png">&nbsp;</td>
		</tr>
		<tr>
			<td height="23" width="32"><img src="../images/page_bas_gauche.png" /></td>
			<td background="../images/page_bas.png">&nbsp;</td>
			<td height="23" width="32"><img src="../images/page_bas_droit.png" /></td>
		</tr>
		</table>
	</td>

	<td align="center" valign="top" width="135">
		
	</td>
</tr>
</table>


</center>

<p class="InfoSite">Programm&eacute; par Gueust et L&eacute;odi - Version Beta</p>

<table border="0" cellpadding="0" cellspacing="0" width="300">
<tr>
	<td align="left">
	<td align="center">
	</td>
</tr>
</table>

</div>

<?

?>
</body>
</html>
