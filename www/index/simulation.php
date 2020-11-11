
<?php
include_once ("include/units.php");



$nb_vaisseaux = count ($liste_tauri);
?>
<br />

Recapitulatif : 
<table width="100%" border="1">
	<tr>
	<td> Type de vaisseau </td>
	<td> Vitesse </td>
	<td> Taille </td>
	<td> Precision</td>
	<td> Attaque </td>
	<td> Structure </td>
	</tr>
<?php
for ($i=0; $i<$nb_vaisseaux;$i++) {

	$caracteristique = $vaisseaux_tauri[${'liste_tauri'}["$i"]];
	$type = $caracteristique['Type'];	
	$vitesse = $caracteristique['Vitesse'];
	$taille = $caracteristique['Taille'];
	$precision = $caracteristique['Precision'];
	$attaque = $caracteristique['Attaque'];
	$structure = $caracteristique['Structure'];

	echo "<tr>
	<td> $type </td>
	<td> $vitesse </td>
	<td> $taille </td>
	<td> $precision </td>
	<td> $attaque </td>
	<td> $structure </td>
	</tr>";

	
}
?>
</table>
<br />
<br />
Chance de toucher : 
<br />

<table width="100%" border="1">
	<tr>
	<td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Tireur<br />Cible </td>
<?php
for ($i=0; $i<$nb_vaisseaux;$i++) {

	$pr = array();

	$caracteristique = $vaisseaux_tauri[${'liste_tauri'}[$i]];
	$type = $caracteristique['Type'];	
	$vitesse = $caracteristique['Vitesse'];
	$taille = $caracteristique['Taille'];
	$precision = $caracteristique['Precision'];
	$attaque = $caracteristique['Attaque'];
	$structure = $caracteristique['Structure'];

	echo "	<td> $type </td>";
}
?>
	</tr>

<?php
$nb_vaisseaux2 = count ($liste_goauld);

for ($a=0; $a<$nb_vaisseaux2;$a++) {
	echo "<tr>";

	$caracteristique = $vaisseaux_goauld[${'liste_goauld'}[$a]];
	$type = $caracteristique['Type'];	
	$vitesse = $caracteristique['Vitesse'];
	$taille = $caracteristique['Taille'];
	echo "<td> $type </td>";

	for ($i=0; $i<$nb_vaisseaux;$i++) {
		
		$caracteristique = $vaisseaux_tauri[${'liste_tauri'}[$i]];
		$type = ${'liste_tauri'}[$i];	
		$precision = $caracteristique['Precision'];

		$chance = $precision - $vitesse/2 + $taille;
		if ($chance >95) $chance = 95;
		if ($chance <5) $chance = 5;

		echo "<td>$chance </td>";
	}
	echo "</tr>";
}
?>
</table>