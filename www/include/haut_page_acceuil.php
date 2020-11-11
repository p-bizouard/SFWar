<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<?php include ("include/head.php"); ?>
 <style type="text/css" media="all">
  @import url("include/style_ff.css");
 </style>
</head>
<body>

	<div id="header">
		<h1> SF-War </h1>
	</div>
	
	<div id="page">
		<div id="menu">
			<div id="QG" class="categorie">
							<div class="menu_titre"><img src="design/font/quartier_general.gif" alt="Quartier Geneneral" /></div>
							<div class="menu_middle_1">
							<ul>
					<li><a href="accueil.php?page=historique">Historique</a></li>
					<li><a href="accueil.php?page=carte">La carte</a></li>
					<li><a href="accueil.php?page=guilde">les Guildes</a></li>
					<li><a href="accueil.php?page=messagerie">Messagerie <?php new_message($pseudo, "tout") ?></a></li>
					<li><a href="index/map.php" target=fenetreimage onclick=ouvrirfenetre()>Carte de la galaxie</a></li>
					<li><a href="accueil.php?page=classement">Classement</a></li>
					<li><a href="accueil.php?page=aide">Aide</a></li>
							</ul>
							</div>
							<div class="menu_bas"></div>
			</div>
			<div id="Gestion" class="categorie">
							<div class="menu_titre"><img src="design/font/gestion.gif" alt="Gestion" /></div>
							<div class="menu_middle_2">
							<ul>
					<li><a href="accueil.php?page=mine">Les Mines</a></li>
					<li><a href="accueil.php?page=commandement">Commandement</a></li>
					<li><a href="accueil.php?page=recrutement">Recrutement</a></li>
					<li><a href="accueil.php?page=simulation">Statistiques</a></li>
							</ul>
							</div>
							<div class="menu_bas"></div>
			</div>

			<div id="Autre" class="categorie">
							<div class="menu_titre"><img src="design/font/autre.gif" alt="Autre" /></div>
							<div class="menu_middle_3">
							<ul>
			          <li><a href="accueil.php?page=profil">Profil</a></li>
								<li><a href="accueil.php?page=chat">Chat</a></li>
								<li><a href="http://www.sf-war.com/forum/">Forum</a></li>
								<li><a href="index.php?action=deco">Se deconnecter</a></li>
							</ul>
							</div>
							<div class="menu_bas"></div>
			</div>
		</div>
		
		<div id="corp">
			<div id="ressource">
							<div class="corp_titre"><img src="design/font/ressources.gif" alt="Ressources" /></div>
							<table class="corp_middle">
								<tr style="width:630px">
									<td style="width:90px">&nbsp;</td>
									<td style="width:200px"><div id="fer"><?php echo $fer; ?></div></td>
									<td style="width:220px"><div id="carbone"><?php echo $carbone; ?></div></td>
									<td style="width:100px"><div id="or"><?php echo $or; ?></div></td>
								</tr>
								<tr style="width:630px">
									<td style="width:90px">&nbsp;</td>
									<td style="width:200px"><div id="naquada"><?php echo $naquada; ?></div></td>
									<td style="width:220px"><div id="trinium"><?php echo $trinium; ?></div></td>
									<td style="width:100px"><div id="population"><?php echo $population; ?></div></td>
								</tr>
							</table>
							<div class="corp_bas"></div>
			</div>
		
		
			<div id="contenu">
							<div class="corp_titre"><img src="design/font/contenu.gif" alt="Contenu" /></div>
							<div class="contenu_middle">
