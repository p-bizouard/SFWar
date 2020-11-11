<?php
// Tableau avec des donnés suivant :
// terrestre x
//Nom
//attaque
// defence
// pdv
// pop
// description
// image


$terrestre_tauri_liste = array (
	'terrestre_0' => array ('terrestre0',		'Nom',							'Attaque',	'Defence',	'pdv',		'Population',	'bonus',		'Description',												'image', 															'puissance'),
	'terrestre_1' => array ('terrestre1',		'H&K MP-5',						'',			'',			'',			'',				'',				'http://www.stargate-fusion.com/index.php?cat=tec&id=75',	'http://www.stargate-fusion.com/sg1/pics/technologie/75/75.jpg',	'10'),
	'terrestre_2' => array ('terrestre1',		'P90',							'',			'',			'',			'',				'',				'http://www.stargate-fusion.com/index.php?cat=tec&id=77',	'http://www.stargate-fusion.com/sg1/pics/technologie/77/77.jpg',	'10'),
	'terrestre_3' => array ('terrestre1',		'Tourelle d\'Attaque Mobile',	'',			'',			'',			'',				'',				'http://www.stargate-fusion.com/index.php?cat=tec&id=80',	'http://www.stargate-fusion.com/sg1/pics/technologie/80/80.jpg',	'10'),
);	//
$terrestre_goauld_liste = array (
	'terrestre_0' => array ('terrestre0',		'Nom',							'Attaque',	'Defence',	'pdv',		'Population',	'bonus',		'Description',												'image', 															'puissance'),
	'terrestre_1' => array ('terrestre1',		'Zat\'n\'ktel',					'',			'',			'',			'',				'',				'http://www.stargate-fusion.com/index.php?cat=tec&id=113',	'http://www.stargate-fusion.com/sg1/pics/technologie/113/113.jpg',	'10'),
	'terrestre_2' => array ('terrestre1',		'Lance Goa\'uld',				'',			'',			'',			'',				'',				'http://www.stargate-fusion.com/index.php?cat=tec&id=100',	'http://www.stargate-fusion.com/sg1/pics/technologie/100/100.jpg',	'10'),
	'terrestre_3' => array ('terrestre1',		'Canon Énergétique',			'',			'',			'',			'',				'',				'http://www.stargate-fusion.com/index.php?cat=tec&id=88',	'http://www.stargate-fusion.com/sg1/pics/technologie/88/88.jpg',	'10'),
);	//	

// Tableau avec des donnés suivant :
// terrestre_1 =>
// Nom ressources nécaissaire
// part en x/15
$terrestre_cout = array (
	'terrestre_1' => array ('terrestre1','','','','',''),
	'terrestre_2' => array ('terrestre2','','','','',''),
	'terrestre_3' => array ('terrestre3','','','','',''),
	'terrestre_4' => array ('terrestre4','','','','',''),
	'terrestre_5' => array ('terrestre5','','','','',''),
	'terrestre_6' => array ('terrestre6','','','','',''),
	'terrestre_7' => array ('terrestre7','','','','',''),
	'terrestre_8' => array ('terrestre8','','','','',''),
	'terrestre_9' => array ('terrestre9','','','','',''),
	'terrestre_10' => array ('terrestre10','','','','',''),
);

if (isset($titre))
{

echo"terrestrex Tauri :<br><table border=\"1\"><tr>";
$i=0;
while ($i<=10) {
$i2=0;
while ($i2<=10) {
$test=$terrestre_tauri_liste["terrestre_$i"]["$i2"];
echo "<td>$test</td>";
$i2++;
}
echo"</tr>";
$i++;
}
echo"</table>";

echo"terrestrex Tauri :<br><table border=\"1\"><tr>";
$i=0;
while ($i<=10) {
	$i2=0;
	while ($i2<=10) {
		$test=$terrestre_goauld_liste["terrestre_$i"]["$i2"];
		echo "<td>$test</td>";
		$i2++;
	}
	echo"</tr>";
	$i++;
}
echo"</table>";
echo"<br><br>Pour les besoins du jeu, les terrestrex Stri'kes, Vel'kat, Beliskner et Volriek ont été renommés";
}
?>
<?php
// Tableau avec des donnés suivant :
// terrestre x
//Nom
//attaque
// defence
// pdv
// transport
// pop
// consomation
// description
// image
// et merci à lluvatar pour son aide


$terrestre_tauri_liste = array (
	'terrestre_0' => array ('terrestre0',		'Nom',						'Attaque',	'Defence',	'Scructure',	'Transport',	'Population',	'Conomation',	'bonus',	'Description',														'image', 'puissance'),
	'terrestre_1' => array ('terrestre1',		'X-301',					'10',		'5',		'100',			'0',			'2',			'15',			'8',		'terrestre terrien inspiré de splaneurs de la mort',					'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/3/3.jpg>', '10'),
	'terrestre_2' => array ('terrestre2',		'F-302',					'20',		'10',		'100',			'0',			'2',			'15',			'9',		'terrestre terrien issue du modèle X-301, il est plus performant.',	'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/2/2.jpg>', '20'),
	'terrestre_3' => array ('terrestre3',		'terrestre Romliest',		'150',		'100',		'20000',		'0',			'30',			'150',			'6',		'terrestre de bataille de to\'kra.',									'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/24/24.jpg>', '40'),
	'terrestre_4' => array ('terrestre4',		'Le "Daniel Jackson"',		'200',		'200',		'35000',		'0',			'50',			'200',			'5',		'terrestre inventé par les Hazgards en honneur aux humains.',		'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/26/26.jpg>', '80'),
	'terrestre_5' => array ('terrestre5',		'terrestre Volriek',			'300',		'200',		'30000',		'0',			'80',			'250',			'1',		'Description',														'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/33/33.jpg>', '160'),
	'terrestre_6' => array ('terrestre6',		'terrestre Beliskner',		'500',		'200',		'25000',		'0',			'150',			'350',			'2',		'Description',														'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/22/22.jpg>', '320'),
	'terrestre_7' => array ('terrestre7',		'Prométhée (BC-303)',		'1000',		'600',		'100000',		'0',			'500',			'800',			'3',		'Description',														'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/1/1.jpg>', '640'),
	'terrestre_8' => array ('terrestre8',		'Dédale',					'1200',		'1000',		'120000',		'0',			'550',			'1000',			'4',		'Description',														'<img src=http://www.chevron26.com/technic/database/images/daedalus2.jpg>', '1280'),
	'terrestre_9' => array ('terrestre9',		'Le "O\'neill"',			'1800',		'1500',		'20000',		'5000',			'700',			'1500',			'7',		'Description',														'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/23/23.jpg>', '2360'),
	'terrestre_10' => array ('terrestre10',	'Ecadron de Cargos Teltak',	'1',		'50',		'2000',			'500',			'2',			'7',			'0',		'Description',														'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/5/5.jpg>', '30'),
);	//
$terrestre_goauld_liste = array (
	'terrestre_0' => array ('terrestre0',		'Nom',							'Attaque',	'Defence',	'Scructure',	'Transport',	'Population',	'Conomation',	'bonus',	'Description',							'image', 'puissance'),
	'terrestre_1' => array ('terrestre1',		'Planeur de la Mort',			'10',		'5',		'100',			'0',			'2',			'15',			'8',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/6/6.jpg>', '10'),
	'terrestre_2' => array ('terrestre2',		'Planeur de la Mort Modifié',	'20',		'10',		'100',			'0',			'2',			'15',			'9',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/7/7.jpg>', '20'),
	'terrestre_3' => array ('terrestre3',		'Al\'Kesh',						'150',		'100',		'20000',		'0',			'30',			'150',			'6',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/4/4.jpg>', '40'),
	'terrestre_4' => array ('terrestre4',		'terrestre de Guerre',			'200',		'200',		'35000',		'0',			'50',			'200',			'5',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/8/8.jpg>', '80'),
	'terrestre_5' => array ('terrestre5',		'terrestre Vel\'kat',			'300',		'200',		'30000',		'0',			'80',			'250',			'1',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/29/29.jpg>', '160'),
	'terrestre_6' => array ('terrestre6',		'terrestre Stri\'kes',			'500',		'200',		'25000',		'0',			'150',			'350',			'2',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/12/12.jpg>', '320'),
	'terrestre_7' => array ('terrestre7',		'terrestre Ha\'tak',				'1000',		'600',		'100000',		'0',			'500',			'800',			'3',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/11/11.jpg>', '640'),
	'terrestre_8' => array ('terrestre8',		' terrestre amiral',				'1200',		'1000',		'120000',		'0',			'550',			'1000',			'4',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/9/9.jpg>', '1280'),
	'terrestre_9' => array ('terrestre9',		'S-V-M-Q-T',					'1800',		'1500',		'20000',		'5000',			'700',			'1500',			'7',		'Super terrestre de la Mort Qui Tue',	'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/32/32.jpg>', '2360'),
	'terrestre_10' => array ('terrestre10',	'terrestre de Transport',		'1',		'50',		'2000',			'500',			'2',			'7',			'0',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/terrestre/32/32.jpg>', '30'),
);		

// Tableau avec des donnés suivant :
// terrestre_1 =>
// Nom ressources nécaissaire
// part en x/15
$terrestre_cout = array (
	'terrestre_1' => array ('terrestre1','','','','',''),
	'terrestre_2' => array ('terrestre2','','','','',''),
	'terrestre_3' => array ('terrestre3','','','','',''),
	'terrestre_4' => array ('terrestre4','','','','',''),
	'terrestre_5' => array ('terrestre5','','','','',''),
	'terrestre_6' => array ('terrestre6','','','','',''),
	'terrestre_7' => array ('terrestre7','','','','',''),
	'terrestre_8' => array ('terrestre8','','','','',''),
	'terrestre_9' => array ('terrestre9','','','','',''),
	'terrestre_10' => array ('terrestre10','','','','',''),
);

if (isset($titre))
{

echo"terrestrex Tauri :<br><table border=\"1\"><tr>";
$i=0;
while ($i<=10) {
$i2=0;
while ($i2<=10) {
$test=$terrestre_tauri_liste["terrestre_$i"]["$i2"];
echo "<td>$test</td>";
$i2++;
}
echo"</tr>";
$i++;
}
echo"</table>";

echo"terrestrex Tauri :<br><table border=\"1\"><tr>";
$i=0;
while ($i<=10) {
	$i2=0;
	while ($i2<=10) {
		$test=$terrestre_goauld_liste["terrestre_$i"]["$i2"];
		echo "<td>$test</td>";
		$i2++;
	}
	echo"</tr>";
	$i++;
}
echo"</table>";
echo"<br><br>Pour les besoins du jeu, les terrestrex Stri'kes, Vel'kat, Beliskner et Volriek ont été renommés";
}
?>
