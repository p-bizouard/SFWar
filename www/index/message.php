<?


	
	if (isset($id))
	{
		$id_message = $id;
	}
	else
	{
		$id_message = $_GET['message'];
	}
	$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_messagerie WHERE id='$id_message'");
	$donnees = mysql_fetch_array($retour);
	$existe = $donnees['nbre_entrees'];
	
	if ($existe==0) {
	
	} else {
		
	
		$reponse = mysql_query("SELECT * FROM sg_messagerie WHERE id='$id_message'");
		$donnees = mysql_fetch_array($reponse);
		$destinataire = $donnees['destinataire'];
		$destinateur = $donnees['destinateur'];	
		$heure = $donnees['heure'];
		$sujet = $donnees['sujet'];	
		$message = $donnees['message'];	
		
		
		
		$vue = $donnees['vue'];	 
		
		$message=nl2br(stripslashes($message));
		$sujet=stripslashes($sujet);
		$date= date("d/m/y",$heure);
		$heure= date("H\h i\m s\s",$heure);
				
		if (($vue == "false"))
		{
			$requete = mysql_query("UPDATE sg_messagerie SET vue='true' WHERE id='$id_message'"); 		
		}

		
		$reponse = mysql_query("SELECT * FROM sg_perso WHERE pseudo='$pseudo'");
		$donnees = mysql_fetch_array($reponse);
		$guilde = $donnees['guilde'];
		
		
		$reponse = mysql_query("SELECT signature_message, clan FROM sg_perso WHERE pseudo='$destinateur'");
		$donnees = mysql_fetch_array($reponse);
		$signature_message = nl2br($donnees['signature_message']);
		$clan_expe = $donnees['clan'];

		if ($clan_expe == "1") $clan_expe = "Tauri";
		if ($clan_expe == "2") $clan_expe = "Goa'uld";
		echo quote('<table width=100%><tr width=75><td width=75><p><b>Ecrit par : </b></p></td><td><p>Le ' . $clan_expe . ' ' . $destinateur . ', le ' . $date . ' &agrave; ' . $heure . '</p></td></tr><tr><td><b><p>Sujet : </p></b></td><td align=left><p>' . $sujet . '</p></td></tr><tr><td><b><p>Message : </p></b></td><td align=left><p>' . remplace_formulaire($message) . '</p></td></tr><tr><td colspan=2 align=center><p><hr width=80%></p></td></tr><tr><td colspan=2 align=center><p>' . $signature_message . '</p></td></tr></table>');

	}
	

?>
