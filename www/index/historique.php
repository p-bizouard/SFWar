
<table border="0" cellpadding="0" cellspacing="0" height="50" width="570">
      <tr>
          <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#CFC7B6">
          <td>
              Objectif de la partie :
          </td>
      </tr>
      <tr>
          <td>&nbsp;</td>
      </tr>
      <tr>
          <td  align="center">
               <font color="green">Vous et votre clan, devez capturer les 8 parcelles de la plan&egrave;te "Valhalla", situ&eacute;e aux coordonn&eacute;es x25;y25.<br />Bonne chance !</font>
          </td>
      </tr>

<?
if (isset($_GET['action']) AND ($_GET['action'] == "suppression")) {
  mysql_query("DELETE FROM sg_historique WHERE pseudo='$pseudo'");
}




$reponse = mysql_query("SELECT * FROM sg_historique WHERE pseudo='$pseudo' ORDER BY time DESC");


while ($donnees = mysql_fetch_array($reponse)) {
      $time= $donnees['time'];

      $date = date("d/m/y",$time);
      $heure = date("H:i:s",$time);
      ?>
      <tr>
          <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#CFC7B6">
          <td>
              Evenement du <?php echo $date; ?> - <?php echo $heure; ?>
          </td>
      </tr>
      <tr>
          <td>&nbsp;</td>
      </tr>
      <tr>
          <td  align="center">
               <?php echo $donnees['message']; ?>
          </td>
      </tr>
        <?
}
?>
<tr>
          <td>&nbsp;</td>
</tr>
<?
$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_historique WHERE pseudo='$pseudo'");
$donnees = mysql_fetch_array($retour);
$nb_ligne = $donnees['nbre_entrees'];

if ($nb_ligne!=0) {
   ?>
   <tr>
       <td align="center">
           <form method="post" action="accueil.php?page=historique&action=suppression">
           <input type="submit" name="efface" value="Effacer Historique">
           <br />
           </form>
       </td>
   </tr><?
} else {
  echo '<p class="center">Vous avez supprim&eacute; votre historique.</p>';
}

?>

</tr>
</table>
