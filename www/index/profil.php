

<?php
if (@$_GET['action']==="edit") 
{
	if (@$_GET['confirm']==="yes") 
	{
	
	
	$reponse = mysql_query("SELECT * FROM  sg_perso WHERE pseudo='$pseudo'");
	$donnees = mysql_fetch_array($reponse);
	$mail=$donnees['mail'];
	$pass=$donnees['pass'];
	
	$mailconf = strip_tags(trim ($_POST["mail"]));
	$passconf = strip_tags(trim ($_POST["newpass2"]));
	$newmail = strip_tags(trim ($_POST["newmail"]));
	$newpass = strip_tags(trim ($_POST["newpass"]));
	
	if (isset($_POST["rapport_mail"])) $rapport_mail = 1;
	else $rapport_mail = '0';
	
	if (isset($_POST["message_mail"])) $message_mail = 1;
	else $message_mail = '0';
	
	if (isset($_POST["save"])) $save = 1;
	else $save = '0';
	
	
	mysql_query("UPDATE sg_perso SET message_mail='$message_mail', save='$save', rapport_mail='$rapport_mail' WHERE pseudo='$pseudo'")
	or die ("Bug");

	$passconfmd5=md5($passconf);
	$newpassmd5=md5($newpass);
	// L'email
		if (($mailconf==="") && ($newmail==="")) {
		
		}
		if (($mailconf!="") AND ($newmail !="")) { 
			if ((strlen($mailconf)>30) AND (strlen($newmail)>30)) {
				$message_erreur = '<p class="erreur">Les champs -email- ne peuvent comporter que 30 caract&egrave;res, veuillez r&eacute;esseyer.</p>';	
				require ("erreur.php");						
				die("");
			} if ((strlen($mail)<=30) AND (strlen($newmail)<=30)) {
			if ($mailconf !== $mail) {
				$message_erreur = "<p>La confirmation de l'email a &eacute;t&eacute; sans succ&egrave;s, merci de r&eacute;eseyer. </p>";	
				require ("erreur.php");						
				die("");
			} if ($mailconf === $mail) {
				echo"<p>L'email a bien &eacute;t&eacute; modifi&eacute;e</p>";
				mysql_query("UPDATE sg_perso SET mail='$newmail' WHERE pseudo='$pseudo'");
			}
		}
	}
	
	//password
		if (($passconf==="") && ($newpass==="")) {
		}
		if (($passconf!="") AND ($newpass !="")) { 
			if ((strlen($passconf)>20) AND (strlen($newpass)>20)) {
				$message_erreur = '<p class="erreur">Les champs -pass- ne peuvent comporter que 20 caract&egrave;res, veuillez r&eacute;esseyer.</p>';	
				require ("erreur.php");						
				die("");
			} if ((strlen($passconf)<=20) AND (strlen($newpass)<=20)) {
			if ($passconfmd5 !== $pass) {
				$message_erreur = "<p>La confirmation de pass a &eacute;t&eacute; sans succ&egrave;s, merci de r&eacute;eseyer. </p>";	
				require ("erreur.php");						
				die("");
			} if ($passconfmd5 == $pass) {
				echo"<p>Le mot de passe a bien &eacute;t&eacute; modifi&eacute;.</p>";
				mysql_query("UPDATE sg_perso SET pass='$newpassmd5' WHERE pseudo='$pseudo'");
			}
		}
	}
	
	}	
	
	$reponse = mysql_query("SELECT * FROM  sg_perso WHERE pseudo='$pseudo'");
	$donnees = mysql_fetch_array($reponse);
	
	$rapport_mail = $donnees['rapport_mail'];
	$message_mail = $donnees['message_mail'];
	$save = $donnees['save'];
	
	if ($rapport_mail == "1") $rapport_mail = 'checked';
	else $rapport_mail = '';
	
	if ($message_mail == "1") $message_mail = 'checked';
	else $message_mail = '';
	
	if ($save == "1") $save = 'checked';
	else $save = '';
	

	
	echo '<p>Remplissez les champs que vous souhaitez modifier.</p>';
	
	?>
	<form method="post" action="accueil.php?page=profil&action=edit&confirm=yes">
		<table border="0" bgcolor="" width="">
   			<tr bgcolor="#6983A3">
				<td style="width:">Ancienne adresse email :</td>
				<td style="width:"><input type="text" name="mail" size="20"></td>
   			</tr>
   			<tr bgcolor="#717D8D">
				<td style="width:">Nouvelle adresse email :</td>
				<td style="width:"><input type="text" name="newmail" size="20"></td>
   			</tr>
   			<tr ><td>&nbsp;</td><td>&nbsp;</td></tr>
   			<tr bgcolor="#6983A3">
				<td style="width:">Ancien mot de passe :</td>
				<td style="width:"><input name="passconf" type="password"></td>
   			</tr>
			 <tr bgcolor="#717D8D">
				<td style="width:">Nouveau mot de pass :</td>
				<td style="width:"><input name="newpass" type="password"></td>
   			</tr >
			 <tr bgcolor="#6983A3">
				<td style="width:">Confirmation :</td>
				<td style="width:"><input name="newpass2" type="password"></td>
   			</tr>
   			<tr ><td>&nbsp;</td><td>&nbsp;</td></tr>
			 <tr bgcolor="#717D8D">
				<td style="width:">Recevoir une copie des rapports de combats par mail :</td>
				<td style="width:" align="center"><input name="rapport_mail" type="checkbox" <?php echo $rapport_mail;?>></td>
   			</tr>
			 <tr bgcolor="#6983A3">
				<td style="width:">Recevoir une copie des messages perso par mail :</td>
				<td style="width:" align="center"><input name="message_mail" type="checkbox" <?php echo $message_mail;?>></td>
   			</tr>
   			<tr ><td>&nbsp;</td><td>&nbsp;</td></tr>
			 <tr bgcolor="#717D8D">
				<td style="width:">Se r&eacute;inscrire automatiquement apr&egrave;s une fin de partie :</td>
				<td style="width:" align="center"><input name="save" type="checkbox" <?php echo $save;?>></td>
   			</tr>
   			</tr>
   			<tr>
			   <td style="width:" align="center"><div align="center"><input type="submit" value="Valider"></div></td>
			   <td style="width:"><div align="center"><input type="reset" value="Annuler"></div></td>
			</tr>
		</table>
		

	</form>
	<?
	

}
if (!isset($_GET['action']))  {

?>


<form NAME="menu">				
<div align="center">					
<p>
Choix de du joueur :	
<select NAME="popup" onChange="change_site();"size="1">
<option VALUE="">-&nbsp;&nbsp;Aucune</option>		
<?php	
$reponse = mysql_query("SELECT * FROM sg_perso WHERE pseudo!='tauri' AND pseudo!='ori' AND pseudo!='goauld' AND pseudo!='neutre' ORDER BY pseudo ASC");			
while ($donnees = mysql_fetch_array($reponse)) 
{
	$pseudojoueur = $donnees['pseudo'];
	if (isset($_GET['joueur']))
	{
		if ($pseudojoueur  == $_GET['joueur']) echo '<option SELECTED VALUE="accueil.php?page=profil&joueur=' . $pseudojoueur . '">-&nbsp;&nbsp;' . $pseudojoueur . '</option>';
		else echo '<option VALUE="accueil.php?page=profil&joueur=' . $pseudojoueur . '">-&nbsp;&nbsp;' . $pseudojoueur . '</option>';
	}
	elseif (!isset($_GET['joueur']))
	{
		if ($pseudojoueur  == $pseudo) echo '<option SELECTED VALUE="accueil.php?page=profil&joueur=' . $pseudojoueur . '">-&nbsp;&nbsp;' . $pseudojoueur . '</option>';
		if ($pseudojoueur  !== $pseudo)  echo '<option VALUE="accueil.php?page=profil&joueur=' . $pseudojoueur . '">-&nbsp;&nbsp;' . $pseudojoueur . '</option>';
	}
}
?>
</select>
</p>
</div></form>									
	<script>
	function change_site() {
		var site = document.menu.popup.selectedIndex;
		{
			window.location.href =
			document.menu.popup.options[site].value;
		}
	}
	</script>


<?php
if (!isset($_GET['joueur'])) {$_GET['joueur']="$pseudo";}
$pseudojoueur=$_GET['joueur'];
$reponse = mysql_query("SELECT * FROM  sg_perso WHERE pseudo='$pseudojoueur'");
$donnees = mysql_fetch_array($reponse);
$dateinscription = date('\L\e d m Y',$donnees['time']);


$clan = clan_id_to_name($donnees['clan']);
					
$reponse = mysql_query("SELECT * FROM  sg_planete WHERE pseudo='$pseudojoueur'");
$iplanete=0;
while ($donnees = mysql_fetch_array($reponse)) 
{
	$iplanete++;
}
if ($iplanete < 2) {$planete="plan&egrave;te";}
if ($iplanete > 1) {$planete="plan&egrave;tes";}

echo '<table border="0" bgcolor="" width="">
	<tr bgcolor="#6983A3">
		<td style="width:">Pseudo : ' . $pseudojoueur. '</td>
	</tr>
	<tr bgcolor="#717D8D">
		<td style="width:">Date d\'inscription : '. $dateinscription . '</td>
	</tr>
	<tr bgcolor="#6983A3">
		<td style="width:">Clan : '. $clan. '</td>
	</tr>
	<tr bgcolor="#717D8D">
		<td style="width:">Poss&egrave;de :  ' . $iplanete . ' ' . $planete. '</td>
	</tr>
</table>';
if ($_GET['joueur']===$pseudo) { echo"<br /><p><a href=accueil.php?page=profil&action=edit>Modifier votre profil</a></p>";}
}
?>
