<?php
$time=time();

if (isset($_POST['message']) and $_POST['message']!='') {
	$message = $_POST['message'];
	
	mysql_query("INSERT INTO sg_mess (pseudo, message, heure)".
   	" VALUES ('$pseudo', '$message', '$time') ")
   	or die("Erreur 202 dans l'incr&eacute;mentation de votre message. La requ&egrave;te n'a pas pu &ecirc;tre valid&eacute;.");

}


?>
<form method="post" action="accueil.php?page=chat">
<p>Message : 
<input type="text" name="message" maxlength="100" />
<input type="submit" value="Envoyer le message" name="submit" />	
</p>
</form>
<p>
<?php

$reponse = mysql_query("SELECT * FROM sg_mess order by  id desc limit 50");	
while($donnees = mysql_fetch_array($reponse)) {
	$heure = $donnees['heure'];
	$pseudo_posteur = $donnees['pseudo'];
	$message = $donnees['message'];
	$aujourdhui = date("m/d - H:i:s",$heure);
	echo '['.$aujourdhui.'] '.$pseudo_posteur.' : '.$message.'<br />';
}

?>
</p>