<span><hr /></span>

<p>
<b><big>Les combats</big></b>
</p>		

<span><hr /></span>

<pre>
<b>Armees :</b>	
	Ataquant :	
		30 F-302
		7 Jumper
		5 Dedale
	Defenseur :   
		200 Planeur de la Mort
		100 Vaisseau Teltak


Analyse d'un rapport de combat :

<b>Round 1</b>

Attaquant :
17 F-302 tirent et d&eacute;truisent 21 Planeur de la Mort
13 F-302 tirent et d&eacute;truisent 9 Vaisseau Teltak
4 Jumper tirent et d&eacute;truisent 10 Planeur de la Mort
3 Jumper tirent et d&eacute;truisent 4 Vaisseau Teltak
3 D&eacute;dale (BC-304) tirent et d&eacute;truisent 145 Planeur de la Mort
2 D&eacute;dale (BC-304) tirent et d&eacute;truisent 57 Vaisseau Teltak

Defenseur :
48 Planeur de la Mort tirent et d&eacute;truisent 30 F-302
18 Planeur de la Mort tirent et d&eacute;truisent 7 Jumper
134 Planeur de la Mort tirent et d&eacute;truisent 0 D&eacute;dale (BC-304)
24 Vaisseau Teltak tirent et d&eacute;truisent 0 F-302
9 Vaisseau Teltak tirent et d&eacute;truisent 0 Jumper
67 Vaisseau Teltak tirent et d&eacute;truisent 1 D&eacute;dale (BC-304)

<b>Round 2</b>

Attaquant :
2 D&eacute;dale (BC-304) tirent et d&eacute;truisent 24 Planeur de la Mort
2 D&eacute;dale (BC-304) tirent et d&eacute;truisent 30 Vaisseau Teltak

Defenseur :
24 Planeur de la Mort tirent et d&eacute;truisent 4 D&eacute;dale (BC-304)
30 Vaisseau Teltak tirent et d&eacute;truisent 0 D&eacute;dale (BC-304)
		
		
		
		
		
		
		

Attaquant
(
    [Vague 1] => 
        (
            [F-302 x30] => Array
                (
                    [Planeur de la Mort] => 17   <- Les F-302 se separent en 2 groupes
                    [Vaisseau Teltak] => 13 
                )

            [Jumper x7] => 
                (
                    [Planeur de la Mort] => 4   <- idem pour les Jumpers
                    [Vaisseau Teltak] => 3
                )

            [Dedale x5] => 
                (
                    [Planeur de la Mort] => 3   <- Et pour les Dedales
                    [Vaisseau Teltak] => 2
                )

        )

    [Vague 2] =>
        (
            [Dedale x1] =>   <- x1 car 4 ont ete detruits lors de la premiere vague
                (
                    [Planeur de la Mort] => 1
                    [Vaisseau Teltak] => 0   <- Il ne reste qu'un dedale, il ne poura donc tapper qu'un seul type d'unite
                )

        )

)


Ils se separent en fonction de l'importance des vaisseaux en face.
Chaque type de vaisseau a une taille, respectivement 3, 5, 30 et 50

En face il y avait 200 Planeurs et 100 Teltak.
Ce qui fait 
200*3 = 600 points pour les planeurs
100*5 = 500 points pour les teltak

Soit en tout 1100

Il y aura donc 6/11 = 54% des vaisseaux qui combattrons les planeurs (ici 17 chasseurs, 4 jumpers et 3 dedales)
et 5/11 = 46% qui combattrons les teltak. (ici 13 chasseurs, 3 jumpers et 2 dedales) pour la premire vague.






==================================================================

Defenseur
(
    [Vague 1] => 
		(
            [Planeur de la Mort x200] =>
                (
                    [F-302] => 48
                    [Jumper] => 18
                    [Dedale] => 134
                )

            [Vaisseau Teltak x100] =>
                (
                    [F-302] => 24
                    [Jumper] => 9
                    [Dedale] => 67
                )

        )

    [Vague 2] =>
        (
            [Planeur de la Mort x24] =>
                (
                    [Dedale] => 24
                )

            [Vaisseau Teltak x30] =>
                (
                    [Dedale] => 30
                )

        )

)

En face il y avait 30 F-302, 7 Jumper et 5 Dedale.
Ce qui fait 
30*3 = 90 points pour les F-302
7*5 = 35 points pour les Jumper
5*50 = 250 points pour les Dedale


Soit au total 275 points

Il y aura donc :
90/405 = 22% des vaisseaux qui combattrons les F-302 (ici 48 Planeurs, et 24 Teltak)
65/405 = 16% des vaisseaux qui combattrons les Jumper (ici 18 Planeurs, et 9 Teltak)
250/405 = 62% des vaisseaux qui combattrons les Dedale (ici 134 Planeurs, et 67 Teltak)
pour la premire vague.




</pre>