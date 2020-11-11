<SCRIPT LANGUAGE="JavaScript">
function confirmation() {
var msg = "&ecirc;tes-vous sur de vouloir quitter cette guilde ?";
if (confirm(msg))
location.replace("accueil.php?page=guilde&action=quitter");
}
function confirmation2() {
var msg = "&ecirc;tes-vous sur de vouloir annuler votre postulation &agrave; cette guilde ?";
if (confirm(msg))
location.replace("accueil.php?page=guilde&action=annuler");
}
</SCRIPT>

<?
if (isset($_GET['action']))
{
	if ($_GET['action'] == "quitter")
	{
		$reponse_sg_perso = mysql_query("SELECT * FROM  sg_perso WHERE pseudo='$pseudo'");
		$donnees_sg_perso = mysql_fetch_array($reponse_sg_perso);
		$guilde = $donnees_sg_perso['guilde'];
		
		mysql_query ("UPDATE sg_perso SET guilde='' WHERE pseudo='$pseudo'")
		or die ("<p align=center>Echec Update</p>");
		echo '<p>Vous avez quitt&eacute; la guilde ' . $guilde .'</p>';
		
		$histo = 'Vous avez quitt&eacute; votre guilde ('.$guilde.')';
		historique($histo, $pseudo);   
        
		echo '<p><a href="accueil.php?page=guilde">Retour</a></p>';      
		
	}
	if ($_GET['action'] == "annuler")
	{
		$reponse_sg_perso = mysql_query("SELECT * FROM  sg_perso WHERE pseudo='$pseudo'");
		$donnees_sg_perso = mysql_fetch_array($reponse_sg_perso);
		$guilde = $donnees_sg_perso['guilde'];
		
		$explode = explode("--", $guilde); 
		$guilde = $explode[0];
		
		mysql_query ("UPDATE sg_perso SET guilde='' WHERE pseudo='$pseudo'")
		or die ("<p align=center>Echec Update</p>");
		echo '<p>Vous avez annul&eacute; votre postulation &agrave; la guilde '.$guilde. '</p>';
		
		$histo = 'Vous avez annul&eacute; votre postulation &agrave; la guilde '.$guilde;
		historique($histo, $pseudo);   
        
		echo '<p><a href="accueil.php?page=guilde">Retour</a></p>';      
		
	}
	if ($_GET['action'] == "administrer")
	{	
	
		$reponse_sg_perso_leader = mysql_query("SELECT * FROM  sg_perso WHERE pseudo='$pseudo'");
		$donnees_sg_perso_leader = mysql_fetch_array($reponse_sg_perso_leader);
		$guilde_leader = $donnees_sg_perso_leader['guilde'];
		
		$reponse_sg_guilde_entrees = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_guilde WHERE leader='$pseudo'");
		$donnees_sg_guilde_entrees = mysql_fetch_array($reponse_sg_guilde_entrees);
		$nb_entrees = $donnees_sg_guilde_entrees['nbre_entrees'];
		
				
		if ($nb_entrees == 1)
		{
			
			
			if (isset($_GET['action2']))
			{		
				if ($_GET['action2'] == "accepter")
				{
					if (is_numeric($_GET['id']))
					{
						$id_membre = $_GET['id'];
						$reponse_sg_perso_leader = mysql_query("SELECT * FROM sg_perso WHERE id='$id_membre'");
						$donnees_sg_perso_leader = mysql_fetch_array($reponse_sg_perso_leader);
						$guilde_membre = explode('--', $donnees_sg_perso_leader['guilde']);
						$pseudo_membre = $donnees_sg_perso_leader['pseudo'];
						
						if ($guilde_membre[1] == "postul") // On v&eacute;rifie si il est effectivement postulant
						{
							mysql_query ("UPDATE sg_perso SET guilde='".addslashes($guilde_membre[0])."' WHERE id='$id_membre'")
							or die ("<p align=center>Echec Update</p>");
							echo '<p>Vous venez d\'accepter '.$pseudo_membre.'.</p>';
							historique('Vous venez d\'&ecirc;tre admis en temps que membre dans la guilde '. $guilde_membre[0], $pseudo_membre);
						}
						else tricheur($pseudo);
					}
					else tricheur($pseudo);
				}
				else tricheur($pseudo);
						
				if ($_GET['action2'] == "supprimer_membre")
				{
					if (is_numeric($_GET['id']))
					{
						$id_membre = $_GET['id'];
						$reponse_sg_perso_membre = mysql_query("SELECT * FROM sg_perso WHERE id='$id_membre'");
						$donnees_sg_perso_membre = mysql_fetch_array($reponse_sg_perso_membre);
						$pseudo_membre = $donnees_sg_perso_membre['pseudo'];
						$guilde_membre = $donnees_sg_perso_membre['guilde'];
						

						mysql_query ("UPDATE sg_perso SET guilde='' WHERE id='$id_membre'")
						or die ("<p align=center>Echec Update</p>");
						echo '<p>Vous venez de supprimer '.$pseudo_membre.' de votre guilde.</p>';
						historique('Vous venez d\'&ecirc;tre exclu de la guilde '. $guilde_membre, $pseudo_membre);

            $retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_perso WHERE guilde='$guilde_membre'");
            $donnees = mysql_fetch_array($retour);
            $nombre_guildiens = $donnees['nbre_entrees'];
						
            if ($nombre_guildiens == "0") {
              mysql_query("DELETE FROM sg_guilde WHERE nom='$guilde_membre'");
              echo '<br />N\'ayant plus de membres dans votre guilde, celle ci sera dissoute.';
            }
            
					}
					else tricheur($pseudo);
				}
				else tricheur($pseudo);
			}

      
      if ($nombre_guildiens != "0") {
  			if (isset($_POST['description']))
  			{
  				$desc = $_POST['description'];
  				$desc = stripslashes($desc);
  				$desc = eregi_replace( "\r\n", "<br />", $desc);
  				$desc = addslashes($desc);
  				mysql_query ("UPDATE sg_guilde SET description='$desc' WHERE leader='$pseudo'")
  						or die ("<p align=center>Echec Update</p>");
  						echo '<p>Vous venez de mettre &agrave; jour la description de votre guilde.</p>';
  				
  			}
			
  			
  			
  			
  			
  			
  			
  			
  			
  			
  			$reponse_sg_guilde = mysql_query("SELECT * FROM sg_guilde WHERE leader='$pseudo'");
  			$donnees_sg_guilde = mysql_fetch_array($reponse_sg_guilde);
  			
  			$verif_clan = $donnees_sg_guilde['clan'];
  			$leader_guilde = $donnees_sg_guilde['leader'];
  			$nom_guilde = $donnees_sg_guilde['nom'];
  			$inscription_guilde = $donnees_sg_guilde['inscription'];
  			$description_guilde = $donnees_sg_guilde['description'];
  			
  			echo '<p>Liste des membres de '. $nom_guilde . ' :</p>';
  			echo '<table width="100%" cellpadding="4">';
  			echo'
  					<tr>
  						<td>Nom</td>
  						<td>Etat</td>
  						<td>Action</td>
  					</tr>
  				';


  			
  			$i = "0";
  			$reponse_sg_perso_leader = mysql_query("SELECT * FROM sg_perso WHERE guilde='". addslashes($nom_guilde) ."' OR guilde='".addslashes($nom_guilde)."--postul'");
  			while ($donnees_sg_perso_leader = mysql_fetch_array($reponse_sg_perso_leader))
  			{
  				$pseudo_membre = $donnees_sg_perso_leader['pseudo'];
  				$guilde_membre = $donnees_sg_perso_leader['guilde'];
  				$id_membre = $donnees_sg_perso_leader['id'];
  				
  				$explode = explode("--", $guilde_membre); 
  				if (isset($explode[1])) $etat_membre = '<a href="accueil.php?page=guilde&action=administrer&action2=accepter&id='.$id_membre.'">Accepter</a>';
  				else $etat_membre = 'Membre';
  				
  				if ($pseudo_membre == $leader_guilde) $etat_membre = '<b>Leader</b>';
  				
  				echo '
  					<SCRIPT LANGUAGE="JavaScript">	
  						function confirmation'.($i+3).'() {
  						var msg = "&ecirc;tes-vous sur de vouloir supprimer ce membre ?";
  						if (confirm(msg))
  						location.replace("accueil.php?page=guilde&action=administrer&action2=supprimer_membre&id='.$id_membre.'");
  						}
  					</script>
  				';
  				
  				
  				if ($i % 2 == 0) 
  				{
  					echo "<tr bgcolor=\"#6983A3\">";
  				} 
  				else 
  				{
  					echo "<tr bgcolor=\"#717D8D\">";
  				}
  				
  				echo '
  						<td>' . $pseudo_membre . '</td>
  						<td>' . $etat_membre . '</td>
  						<td><a onClick=confirmation'.($i+3).'()>Supprimer</a></td>
  					</tr>
  					';
  				$i++;
  			}
  			
  			
  			
  			echo '</table>';
  			echo '<br /><hr width="100%"><p>Apercu de la description de votre guilde :</p>';
  			echo '<center>';
  			
  			if ($description_guilde == "") $description_guilde = "Vous n'avez entr&eacute; aucune description.";
  			else $description_guilde = str_replace("<br />", "\r\n", $description_guilde);
  			
  			echo '<hr width="100%"><p class="center">' . nl2br(stripslashes(remplace_formulaire($description_guilde))) . '</p><hr width="100%">';
  			echo '<p class="center">Le BBcode est actif, plus d\'aide <a href="index/bbcode.php" target=fenetreimage onclick=ouvrirfenetre()>->ICI<-</a></p>
  				  <hr width="100%">
  				  <form method="post" action="" name="guilde">';
  			echo '<textarea name="description" cols="54" rows="20">'. $description_guilde .'</textarea>';
  			echo '<br /><input type="submit" value="Valider">';
  			echo '</form>';
  			echo '</center>';
  			
  		
  		
  		}
  		else
  		{
  			tricheur($pseudo);
  		}
		}

	}
	if ($_GET['action'] == "make")
	{
		$reponse_sg_perso = mysql_query("SELECT * FROM sg_perso WHERE pseudo='$pseudo'");
		$donnees_sg_perso = mysql_fetch_array($reponse_sg_perso);
		$clan = $donnees_sg_perso['clan'];
		$guilde = $donnees_sg_perso['guilde'];
		
		if ($guilde !== "") tricheur($pseudo);
		else
		{
			if (isset($_POST['nom']))
			{
				$desc = addslashes($_POST['desc']);
				$nom = addslashes($_POST['nom']);
				
				if (($desc == "") || ($nom == ""))
				{
					echo '<p class="erreur">Vous n\'avez pas rempli tous les champs</p>';
					$erreur_nom = $nom;
					$erreur_desc = $desc;
				}
				else
				{
					$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_guilde WHERE nom='$nom'");
					$donnees = mysql_fetch_array($retour);
					$nb = $donnees['nbre_entrees'];
					
					if ($nb == "0")
					{
						$desc = stripslashes($desc);
						$desc = eregi_replace( "\r\n", "<br />", $desc);
						$desc = addslashes($desc);
						
						$nom = str_replace("-", "&#45;", $nom);
						
						mysql_query("INSERT INTO sg_guilde (nom, description, date, leader, clan)".
									" VALUES ('$nom', '$desc', '".time()."', '$pseudo','$clan') ")
						or die("Erreur dans la cr&eacute;ation de votre guilde.");
						
						mysql_query ("UPDATE sg_perso SET guilde='$nom' WHERE pseudo='$pseudo'")
						or die ("<p align=center>Echec Update</p>");
						
						echo '<p>Vous venez de cr&eacute;er la guilde '.$nom . '.</p>';
						$good = "good";
						$histo = 'Vous venez de cr&eacute;er la guilde '.$nom;
						historique($histo, $pseudo);   
						echo '<p><a href="accueil.php?page=guilde">Retour</a></p>';
					}
					else
					{
						echo '<p class="erreur">Une guilde porte d&eacute;j&agrave; ca nom, veuillez le modifier</p>';
					}
				}
			}
			
			if (!isset($erreur_nom)) 	$erreur_nom = "";
			if (!isset($erreur_desc))	$erreur_desc = "";
			
			if (!isset($good)) // si le post n'a pas &eacute;t&eacute; envoy&eacute; et pas accept&eacute;
			{
				?>
					<p>Pour cr&eacute;er votre guilde, veuillez remplir les champs suivants.</p>
					
					<form method="post" action="">
					
					<table width="100%">
						<tr>
							<td>Nom</td>
							<td><input name="nom" size="20" type="text" value="<? echo $erreur_nom;?>"> (D&eacute;finitif)</td>
						</tr>
						<tr>
							<td>Description</td>
							<td><textarea name="desc" cols="40" rows="20"><?php echo $erreur_desc; ?></textarea></td>
						</tr>
					</table>
					<center><input type="submit" value="Envoyer"></center>
					
					</form>
					<p>Le BBcode est actif, plus d'aide <a href="index/bbcode.php" target="fenetreimage" onclick="ouvrirfenetre()">-&gt;ICI&lt;-</a></p>
						
				<?
			}
		}
	}
	if ($_GET['action'] == "inscription")
	{
		$reponse_sg_perso = mysql_query("SELECT * FROM sg_perso WHERE pseudo='$pseudo'");
		$donnees_sg_perso = mysql_fetch_array($reponse_sg_perso);
		$clan = $donnees_sg_perso['clan'];
		$idj = $donnees_sg_perso['id'];
		$guilde = $donnees_sg_perso['guilde'];
		
		$explode = explode("--", $guilde); 
		
		if((empty($guilde)) AND (!isset($explode[1])))
		{
			$id_guilde = $_GET['guilde'];
			
			$reponse_sg_guilde = mysql_query("SELECT * FROM  sg_guilde WHERE id='$id_guilde'");
			$donnees_sg_guilde = mysql_fetch_array($reponse_sg_guilde);
			$verif_clan = $donnees_sg_guilde['clan'];
			$leader = $donnees_sg_guilde['leader'];
			$nom_guilde = $donnees_sg_guilde['nom'];
			
			if ($verif_clan == $clan)
			{
				$time = time();
				$sujet = 'Une nouvelle postulation pour la guilde';
				$message2 = addslashes('Bonjour<br />Le joueur '.user($pseudo).' vient de postuler &agrave; votre guilde. Pour acc&eacute;pter ou d&eacute;cliner sa demande, allez dans l\'administration de votre guilde.');
				$type = 'perso';
				
				mysql_query("INSERT INTO sg_messagerie (destinataire, destinateur, heure, sujet, message, type)".
							" VALUES ('$pseudo_leader', 'Guilde', '$time', '$sujet','$message2', '$type') ")
				or die("Erreur.Votre demande ne peut pas &ecirc;tre valid&eacute;e");
						
				mysql_query ("UPDATE sg_perso SET guilde='".addslashes($nom_guilde)."--postul' WHERE pseudo='$pseudo'")
				or die ("<p align=center>Echec Update</p>");
				echo '<p>Vous venez de postuler &agrave; la guilde '.$nom_guilde. '</p>';	
						
			}
			else
			{
				echo '<p>Merci de ne pas tricher, les MJs ont &eacute;t&eacute; avertis.</p>';
				tricheur($pseudo);
			}
		}
		else
		{
			echo '<p>Vous &ecirc;tes d&eacute;j&agrave; dans une guilde, ou vous avez postul&eacute; dans l\'une d\'entre elles, quittez la dabord avant d\'int&eacute;grer une nouvelle guilde.</p>';
			echo '<p><a href="accueil.php?page=guilde">Retour</a></p>';  
		}
	}
  
}
else
{
	$reponse_sg_perso = mysql_query("SELECT * FROM  sg_perso WHERE pseudo='$pseudo'");
	$donnees_sg_perso = mysql_fetch_array($reponse_sg_perso);
	$clan = $donnees_sg_perso['clan'];
	$guilde = $donnees_sg_perso['guilde'];
	
	echo '<table align="center" width="550" border="0" cellpadding="4">
			<tr style="text-align:center;">
				<td style="width:25%">Nom :</td>
				<td style="width:25%">Leader :</td>
				<td style="width:15%">Membres :</td>
				<td style="width:20%">Cr&eacute;e le :</td>
				<td style="width:25%">Inscription :</td>
			</tr>
		';

	$i = "0";
	$reponse_sg_guilde = mysql_query("SELECT * FROM  sg_guilde WHERE clan='$clan'");
	while($donnees_sg_guilde = mysql_fetch_array($reponse_sg_guilde))
	{
	
		$id_guilde 			= $donnees_sg_guilde['id'];
		$nom_guilde 		= $donnees_sg_guilde['nom'];
		$description_guilde = $donnees_sg_guilde['description'];
		$date_guilde 		= $donnees_sg_guilde['date'];
		$leader_guilde 		= $donnees_sg_guilde['leader'];
		$clan_guilde 		= $donnees_sg_guilde['clan'];
		$inscription_guilde = $donnees_sg_guilde['inscription'];
		
	
		$nb_joueurs = "0";
		$reponse_sg_perso_2 = mysql_query("SELECT * FROM sg_perso WHERE guilde='".addslashes($nom_guilde)."'");
		while($donnees_sg_perso_2 = mysql_fetch_array($reponse_sg_perso_2))
		{
			$joueurs[$i][] = $donnees_sg_perso_2['pseudo'];
			$nb_joueurs++;
		}
		
		//print_rr($joueurs);
		

		
		if (($inscription_guilde == "open") AND ($guilde == "")) $inscription_guilde = '<a href=accueil.php?page=guilde&action=inscription&guilde='.$id_guilde.'>Ouverte</a>';
		if (($inscription_guilde == "close") AND ($guilde == "")) $inscription_guilde = 'Ferm&eacute;';
		
		if (($guilde !== $nom_guilde)AND ($guilde !== "")) $inscription_guilde = '-';
		if ($guilde == $nom_guilde) $inscription_guilde = '<b><a onClick=confirmation()>Quitter</a></b>';
		
		$explode = explode("--", $guilde);
		if (isset($explode[1]))	
		{
			if ($explode[1] == "postul") $inscription_guilde = '<b><a onClick=confirmation2()>Annuler la postulation</a></b>';
		}		
		if (($leader_guilde == $pseudo) AND ($guilde == $nom_guilde)) $inscription_guilde = '<b><a href=accueil.php?page=guilde&action=administrer>Administration</a></b>';

		
		$date_guilde = date('d-m-Y', $date_guilde);
		

		
		$count = "0";
		if (isset($joueurs[$i][1])) $count = count($joueurs[$i]);
		 
		$guilde_vue  = '';
		$guilde_vue .= '<table width=250><tr><td>';
		
		$guilde_vue .= '<center><font class=Tete>';
		$guilde_vue .= quote_big($nom_guilde);
		$guilde_vue .= '</font><br />';
		

		$guilde_vue .= '<p align=center>'.nl2br(stripslashes(remplace_formulaire(quote($description_guilde)))).'</p>';
		$guilde_vue .= '</center>';
		
		$guilde_vue .= '<table width=100% >';
		
		$guilde_vue .= '<tr bgcolor=#6983A3>';
		$guilde_vue .= '<td>Leader : </td>';
		$guilde_vue .= '<td>'.$leader_guilde.'</td>';
		$guilde_vue .= '</tr>';
		
		$guilde_vue .= '<tr bgcolor=#717D8D>';
		$guilde_vue .= '<td>Cr&eacute;&eacute;e le :</td>';
		$guilde_vue .= '<td>'.$date_guilde.'</td>';
		$guilde_vue .= '</tr>';
		
		$guilde_vue .= '<tr bgcolor=#6983A3>';
		$guilde_vue .= '<td>Inscriptions :</td>';
		$guilde_vue .= '<td>'. $inscription_guilde.'</td>';
		$guilde_vue .= '</tr>';
		
		$guilde_vue .= '<tr>';
		$guilde_vue .= '<td colspan=2><hr width=100%></td>';
		$guilde_vue .= '</tr>';
		
		$guilde_vue .= '<tr bgcolor=#6983A3>';
		$guilde_vue .= '<td>Membres :</td>';
		$guilde_vue .= '<td>&nbsp;</td>';
		$guilde_vue .= '</tr>';
		
		
		
		for($y=0;$y < $count;$y++)
		{
			if ($y % 2 == 0) 
			{
				$guilde_vue .= '<tr bgcolor=#717D8D>';
			} 
			else 
			{
				$guilde_vue .= '<tr bgcolor=#6983A3>';
			}
			
			$guilde_vue .= '<td></td>';
			$guilde_vue .= '<td>[ '. ($y+1). ' ] ' . user($joueurs[$i][$y]) .'</td>';
			$guilde_vue .= '</tr>';
			
		}
		
		

		$guilde_vue .= '</table>';
		
		$guilde_vue .= '</td>';
		$guilde_vue .= '</tr>';
		$guilde_vue .= '</table>';
		
		
		if (($inscription_guilde !== "Ferm&eacute;") AND ($guilde == ""))
		{
			$guilde_vue .= '<p align=center><a href=accueil.php?page=guilde&action=inscription&guilde='.$id_guilde.'>Devenir membre</a></p></br />';
		}
		
		
		
		if ($i % 2 == 0) 
		{
			echo "<tr bgcolor=\"#6983A3\">";
		} 
		else 
		{
			echo "<tr bgcolor=\"#717D8D\">";
		}
		
		echo '
				<td><div class="a" onMouseDown="(Affbulle2(\''.quote($guilde_vue).'\', \'0\'));"><u><b>'.$nom_guilde.'</b></u></div></td>
				<td>'.user($leader_guilde).'</td>
				<td>'.$nb_joueurs.'</td>
				<td>'.$date_guilde.'</td>
				<td>'.$inscription_guilde.'</td>
			</tr>
			';
		
		$i++;
	}
	
	echo '</table>';
	
		if ($guilde == "") echo '<p><a href="accueil.php?page=guilde&action=make">Cr&eacute;er une guilde</a></p>';
		
		
}
