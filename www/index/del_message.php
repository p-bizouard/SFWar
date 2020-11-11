<?php
	require("../../connexion.php");

$pseudo = $_POST['pseudo'];

$pseudo2 = mysql_fetch_array(mysql_query("SELECT pseudo FROM sg_perso WHERE pass='".$_POST['value']. "' AND  pseudo='".$_POST['pseudo']. "'"));
$pseudo = $pseudo2['pseudo'];

mysql_query("DELETE FROM `sg_messagerie` WHERE `sg_messagerie`.`destinataire`='$pseudo' AND `sg_messagerie`.`id`='".$_POST['id']."';");
?>