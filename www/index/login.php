<?

if (isset($_POST['pseudo']) AND isset($_POST['pass'])) {
	
	//////////////////////////////////////////////
	// 1) on prend le pseudo et le pass+verif	//
	// 2) on prend l'ip du joueur				//
	//////////////////////////////////////////////
	$pseudo = strip_tags(trim ($_POST["pseudo"]));
	$pass = strip_tags(trim ($_POST["pass"]));


	
	
	// En cas d'erreur on fixe le titre de l'erreur
	$titre_erreur= "Erreur de connection";	
	
	if ($pseudo=="") {
		$message_erreur = "Vous n'avez pas rentr&eacute; de pseudo.";	
		include ("index/erreur.php");						

	} elseif (strlen ($pseudo) >20) {
		$message_erreur = "Votre pseudo ne peut comporter que 20 caract&egrave;res. Veuillez r&eacute;essayer.";	
		include ("index/erreur.php");	
							
	} elseif ($pass=="") {
		$message_erreur = "Votre n'avez pas rentr&eacute; de mot de passe.";	
		include ("erreur.php");						

	} elseif (strlen ($pass) >30) {
		$message_erreur = "Votre mot de passe ne peut comporter que 30 caract&egrave;res. Veuillez r&eacute;essayer.";	
		include ("index/erreur.php");	

	} else {
		//////////////////////////////////////////////////
		// On cr&eacute;e 1 identifiant unique					//
		// et on le met ds la variable session			//
		//////////////////////////////////////////////////
		$identifiant_session = md5(uniqid($pseudo));	//
		$_SESSION['idj'] = $identifiant_session;		//
		$_SESSION['pseudo'] = $pseudo;					//
		//////////////////////////////////////////////////

		//////////////////////////////////
		// on r&eacute;cup&egrave;re l'ip				//
		//////////////////////////////////
		$ip = $_SERVER["REMOTE_ADDR"];	//
		//////////////////////////////////

		//////////////////////////////////////////////////////
		// on v&eacute;rifie l'existance des informations envoy&eacute;es	//
		//////////////////////////////////////////////////////
		$retour = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM sg_perso WHERE pseudo='$pseudo'");
		$donnees = mysql_fetch_array($retour);
		$existe = $donnees['nbre_entrees'];


		
		if ($existe=="0") {
			$message_erreur = "Ce pseudo n'existe pas. V&eacute;rifiez son &eacute;criture.";
			include ("index/erreur.php");

		} else {

			$reponse = mysql_query("SELECT pass FROM sg_perso WHERE pseudo='$pseudo'");
			$donnees = mysql_fetch_array($reponse);
			$pass_BDD = $donnees['pass'];
	
			$pass = md5($pass);

			if ($pass!=$pass_BDD) {
				$message_erreur = "Vous vous &ecirc;tes tromp&eacute; de mot de passe. Veuillez r&eacute;&eacute;ssayer.";
				include ("index/erreur.php");

			} else {
				$retour = mysql_query("SELECT * FROM sg_perso WHERE pseudo='$pseudo'");
				$donnees = mysql_fetch_array($retour);
				$id_joueur= $donnees['id'];
				
				$_SESSION["id_joueur"]=$id_joueur;
				$_SESSION["pseudo"]="$pseudo";
				echo"<script language=\"JavaScript\">window.location='accueil.php?page=historique'</script>";
			}
		}
	}
}
?>
