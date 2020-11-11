<table width="500" border="0" cellpadding="0" cellspacing="2">
	<tr>
		<th align="center">Points</th>
		<th align="center">Pseudo</th>
		<th align="center">Clan</th>
		<th align="center">Guilde</th>
	</tr>
	
<?php
	$classement = array();
	$reponse = mysql_query("SELECT * FROM sg_perso WHERE win!=0 OR equal!=0 OR loose!=0");	
	while($donnees = mysql_fetch_array($reponse)) {
  
    if (($donnees['pseudo'] != 'goauld') AND ($donnees['pseudo'] != 'ori') AND ($donnees['pseudo'] != 'tauri') AND ($donnees['pseudo'] != 'neutre')) {
    
      $donnees['clan'] = clan_id_to_name($donnees['clan']);
    
  		$classement[$donnees['id']]['classement'] = (int)(($donnees['win'] *2) + $donnees['equal'] - ($donnees['loose']/2));
  		$classement[$donnees['id']]['guilde'] = $donnees['guilde'];
  		$classement[$donnees['id']]['pseudo'] = $donnees['pseudo'];
  		$classement[$donnees['id']]['clan'] = $donnees['clan'];
    }
	}
	
	rsort($classement);
	
	for ($i=0; $i<count($classement); $i++) {
		echo '<tr>
			<td align="center">'.($i+1).' ( '. $classement[$i]['classement'] . ' )</td>
			<td align="center">'.$classement[$i]['pseudo'].'</td>
			<td align="center">'.$classement[$i]['clan'].'</td>
			<td align="center">'.$classement[$i]['guilde'].'</td>
		</tr>';
	}
///	print_rr($classement);
?>
	
	</table>
	
	<p>Note : 2 points par combats gagn&eacute;s. 1 par combats ex-æquos, -0.5 par d&eacute;faites. Ne sont r&eacute;f&eacute;renc&eacute;s que les joueurs ayant particip&eacute; a au moins une bataille.</p>
	<p>Note² : Un classement ne veut rien dire. Le but est de faire gagner son clan, et non de se voir en t&ecirc;te du classement.</p>