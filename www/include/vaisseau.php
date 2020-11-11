<?php
// Tableau avec des donnés suivant :
// vaisseau x
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


$vaisseau_tauri_liste = array (
	'vaisseau_0' => array ('vaisseau0',		'Nom',						'Attaque',	'Defence',	'Scructure',	'Transport',	'Population',	'Conomation',	'bonus',	'Description',														'image', 'puissance'),
	'vaisseau_1' => array ('vaisseau1',		'X-301',					'10',		'5',		'100',			'0',			'2',			'15',			'8',		'Vaisseau terrien inspiré de splaneurs de la mort',					'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/3/3.jpg>', '10'),
	'vaisseau_2' => array ('vaisseau2',		'F-302',					'20',		'10',		'100',			'0',			'2',			'15',			'9',		'Vaisseau terrien issue du modèle X-301, il est plus performant.',	'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/2/2.jpg>', '20'),
	'vaisseau_3' => array ('vaisseau3',		'Vaisseau Romliest',		'150',		'100',		'20000',		'0',			'30',			'150',			'6',		'Vaisseau de bataille de to\'kra.',									'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/24/24.jpg>', '40'),
	'vaisseau_4' => array ('vaisseau4',		'Le "Daniel Jackson"',		'200',		'200',		'35000',		'0',			'50',			'200',			'5',		'Vaisseau inventé par les Hazgards en honneur aux humains.',		'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/26/26.jpg>', '80'),
	'vaisseau_5' => array ('vaisseau5',		'Vaisseau Volriek',			'300',		'200',		'30000',		'0',			'80',			'250',			'1',		'Description',														'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/33/33.jpg>', '160'),
	'vaisseau_6' => array ('vaisseau6',		'Vaisseau Beliskner',		'500',		'200',		'25000',		'0',			'150',			'350',			'2',		'Description',														'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/22/22.jpg>', '320'),
	'vaisseau_7' => array ('vaisseau7',		'Prométhée (BC-303)',		'1000',		'600',		'100000',		'0',			'500',			'800',			'3',		'Description',														'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/1/1.jpg>', '640'),
	'vaisseau_8' => array ('vaisseau8',		'Dédale',					'1200',		'1000',		'120000',		'0',			'550',			'1000',			'4',		'Description',														'<img src=http://www.chevron26.com/technic/database/images/daedalus2.jpg>', '1280'),
	'vaisseau_9' => array ('vaisseau9',		'Le "O\'neill"',			'1800',		'1500',		'20000',		'5000',			'700',			'1500',			'7',		'Description',														'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/23/23.jpg>', '2360'),
	'vaisseau_10' => array ('vaisseau10',	'Ecadron de Cargos Teltak',	'1',		'50',		'2000',			'500',			'2',			'7',			'0',		'Description',														'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/5/5.jpg>', '30'),
);	//
$vaisseau_goauld_liste = array (
	'vaisseau_0' => array ('vaisseau0',		'Nom',							'Attaque',	'Defence',	'Scructure',	'Transport',	'Population',	'Conomation',	'bonus',	'Description',							'image', 'puissance'),
	'vaisseau_1' => array ('vaisseau1',		'Planeur de la Mort',			'10',		'5',		'100',			'0',			'2',			'15',			'8',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/6/6.jpg>', '10'),
	'vaisseau_2' => array ('vaisseau2',		'Planeur de la Mort Modifié',	'20',		'10',		'100',			'0',			'2',			'15',			'9',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/7/7.jpg>', '20'),
	'vaisseau_3' => array ('vaisseau3',		'Al\'Kesh',						'150',		'100',		'20000',		'0',			'30',			'150',			'6',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/4/4.jpg>', '40'),
	'vaisseau_4' => array ('vaisseau4',		'Vaisseau de Guerre',			'200',		'200',		'35000',		'0',			'50',			'200',			'5',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/8/8.jpg>', '80'),
	'vaisseau_5' => array ('vaisseau5',		'Vaisseau Vel\'kat',			'300',		'200',		'30000',		'0',			'80',			'250',			'1',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/29/29.jpg>', '160'),
	'vaisseau_6' => array ('vaisseau6',		'Vaisseau Stri\'kes',			'500',		'200',		'25000',		'0',			'150',			'350',			'2',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/12/12.jpg>', '320'),
	'vaisseau_7' => array ('vaisseau7',		'Vaisseau Ha\'tak',				'1000',		'600',		'100000',		'0',			'500',			'800',			'3',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/11/11.jpg>', '640'),
	'vaisseau_8' => array ('vaisseau8',		' Vaisseau amiral',				'1200',		'1000',		'120000',		'0',			'550',			'1000',			'4',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/9/9.jpg>', '1280'),
	'vaisseau_9' => array ('vaisseau9',		'S-V-M-Q-T',					'1800',		'1500',		'20000',		'5000',			'700',			'1500',			'7',		'Super Vaisseau de la Mort Qui Tue',	'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/32/32.jpg>', '2360'),
	'vaisseau_10' => array ('vaisseau10',	'Vaisseau de Transport',		'1',		'50',		'2000',			'500',			'2',			'7',			'0',		'Description',							'<img src=http://www.stargate-fusion.com/sg1/pics/vaisseau/32/32.jpg>', '30'),
);		

// Tableau avec des donnés suivant :
// vaisseau_1 =>
// Nom ressources nécaissaire
// part en x/15
$vaisseau_cout = array (
	'vaisseau_1' => array ('vaisseau1','','','','',''),
	'vaisseau_2' => array ('vaisseau2','','','','',''),
	'vaisseau_3' => array ('vaisseau3','','','','',''),
	'vaisseau_4' => array ('vaisseau4','','','','',''),
	'vaisseau_5' => array ('vaisseau5','','','','',''),
	'vaisseau_6' => array ('vaisseau6','','','','',''),
	'vaisseau_7' => array ('vaisseau7','','','','',''),
	'vaisseau_8' => array ('vaisseau8','','','','',''),
	'vaisseau_9' => array ('vaisseau9','','','','',''),
	'vaisseau_10' => array ('vaisseau10','','','','',''),
);

if (isset($titre))
{

echo"Vaisseaux Tauri :<br><table border=\"1\"><tr>";
$i=0;
while ($i<=10) {
$i2=0;
while ($i2<=10) {
$test=$vaisseau_tauri_liste["vaisseau_$i"]["$i2"];
echo "<td>$test</td>";
$i2++;
}
echo"</tr>";
$i++;
}
echo"</table>";

echo"Vaisseaux Tauri :<br><table border=\"1\"><tr>";
$i=0;
while ($i<=10) {
	$i2=0;
	while ($i2<=10) {
		$test=$vaisseau_goauld_liste["vaisseau_$i"]["$i2"];
		echo "<td>$test</td>";
		$i2++;
	}
	echo"</tr>";
	$i++;
}
echo"</table>";
echo"<br><br>Pour les besoins du jeu, les vaisseaux Stri'kes, Vel'kat, Beliskner et Volriek ont été renommés";
}
?>
