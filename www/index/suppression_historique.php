
<table border="0" cellpadding="0" cellspacing="0" height="50" width="570">


<?

mysql_query("DELETE FROM sg_historique WHERE pseudo='$pseudo'");

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
           <form method="post" action="accueil.php?page=supression_historique">

           <input type="hidden" name="idj" value="115024531">
           <input type="submit" name="efface" value="Effacer Historique">
           <br />
           </form>
       </td>
   </tr><?
}

?>

</tr>
</table>
