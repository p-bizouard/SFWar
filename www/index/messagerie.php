<?php

$pass = mysql_fetch_array(mysql_query("SELECT pass FROM sg_perso WHERE id=".mysql_real_escape_string($id_joueur)));
$pass = $pass['pass'];

?>


<script type="text/javascript">
var xhr = null; 

function getXhr(){
	if(window.XMLHttpRequest) // Firefox et autres
	   xhr = new XMLHttpRequest(); 
	else if(window.ActiveXObject){ // Internet Explorer 
	   try {
			 xhr = new ActiveXObject("Msxml2.XMLHTTP");
		  } catch (e) {
			 xhr = new ActiveXObject("Microsoft.XMLHTTP");
		  }
	}
	else { // XMLHttpRequest non support&eacute; par le navigateur 
	   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
	   xhr = false; 
	} 
}


function go(id){
	getXhr();
	// On d&eacute;fini ce qu'on va faire quand on aura la r&eacute;ponse
	xhr.onreadystatechange = function(){
		// On ne fait quelque chose que si on a tout re&ccedil;u et que le serveur est ok
		if(xhr.readyState == 4 && xhr.status == 200){
			leselect = xhr.responseText;
			// On se sert de innerHTML pour rajouter les options a la liste
			document.getElementById(id).style.display = 'none';
		}
	}

	
	// Ici on va voir comment faire du post
	xhr.open("post","index/del_message.php",true);
	// ne pas oublier &ccedil;a pour le post
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

	
	xhr.send("id="+id+"&value=<?php echo $pass; ?>&pseudo=<?php echo $pseudo; ?>");
}
</script>

<?
	////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////// D&eacute;but	////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<?
if (@$HTTP_GET_VARS["type"] == "") 
		{
			$type = "clan";
		} 
		else 
		{
			$type = $HTTP_GET_VARS["type"];
		}
		
 

?>
	<br />
	<br />
			
			<!-- ***************************************************************** -->
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tbody>
	<tr>
        	<td class="maintext" align="center">

		<table width="550" border="0" cellspacing="0" cellpadding="0">
			<tr>

				<table width="550" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<div align="center">
						<a href="accueil.php?page=messagerie&type=perso"  class="messagerie">
						Messagerie perso <?php new_message($pseudo, "perso"); ?>
						</a>
						</div>
					</td>
					<td>
						<div align="center">
						<a href="accueil.php?page=messagerie&type=rapport"  class="messagerie">
						Rapports de combats <?php new_message($pseudo, "rapport"); ?>
						</a>
						</div>
					</td>
					<td>
						<div align="center">
						<a href="accueil.php?page=messagerie&type=guilde" class="messagerie">
						Messagerie guilde
						</a>
						</div>
					</td>
					<td>
						<div align="center">
						<a href="accueil.php?page=messagerie&type=clan" class="messagerie">
						Messagerie clan
						</a>
						</div>
					</td>
					<td>
						<div align="center">
						<a href="accueil.php?page=messagerie&type=envoi"class="messagerie">
						Ecrire un message
						</a>
						</div>
					</td>
					<td>
						<div align="center">
						<a href="accueil.php?page=messagerie&type=envoyes"class="messagerie">
						Messages envoy&eacute;s
						</a>
						</div>
					</td>
				</tr>

				</table>
              	  </tr>



       	 </td>
	</tr>
	<tr>
	


	<tr>
	<td class="maintext" align="center">
	<br>

		<?php
		
		
			if ($type=='vue')
			{
        if ((isset($HTTP_GET_VARS["type2"])) AND ($HTTP_GET_VARS["type2"] == "rapport")) {
  				mysql_query ("UPDATE sg_messagerie SET vue='true' WHERE destinataire='". $pseudo ."' AND type='rapport'")
  				or die ("<p align=center>Echec Update</p>");
  				echo '<p>Vos rapports de combats sont maintenant d&eacute;clar&eacute;s comme lu</p>';
  				$type="rapport";

        } else {
  				mysql_query ("UPDATE sg_messagerie SET vue='true' WHERE destinataire='". $pseudo ."' AND type='perso'")
  				or die ("<p align=center>Echec Update</p>");
  				echo '<p>Vos messages personels sont maintenant d&eacute;clar&eacute;s comme lu</p>';
  				$type="perso";
        }
			}
			if ($type=="perso") {
				?>
				
				<br />
				
			
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr style="text-align:center;">
					<td >
						<b>&nbsp;</b>
					</td>
					<td style="width:20%">
						<b>Exp&eacute;diteur</b>
					</td>
					<td style="width:40%" align="left">
						<b>Sujet</b>
					</td>
					<td style="width:30%">
						<b>Heure d'envoi</b>
					</td>
				</tr>
				</table>
				<?php
				$reponse2 = mysql_query("SELECT * FROM sg_messagerie WHERE type='perso' AND destinataire='$pseudo' ORDER BY heure DESC");
			
	
				while ($donnees = mysql_fetch_array($reponse2)) {
					$heure= $donnees['heure'];
					$sujet= $donnees['sujet'];
					$message= $donnees['message'];
					$vue= $donnees['vue'];
					$id = $donnees['id'];
					$color = $donnees['color'];
					$destinateur= $donnees['destinateur'];
			
					
					$time = time();
					if (date("d/m/y", $time) == date("d/m/y",$heure)) {
						$date = "<b>" . date("d/m/y",$heure);
						$heure= date("H\h i\m s\s",$heure) . "<b>";
					} else {
						$date= date("d/m/y",$heure);
						$heure= date("H\h i\m s\s",$heure);				
					}
					
					
					$vue= $donnees['vue'];
					if ($vue == "false") $vue = '<img src="images/non_vue.gif">';					
					else $vue = '<img src="images/vue.gif">';
					
				$reponse = mysql_query("SELECT clan FROM sg_perso WHERE pseudo='$destinateur'");
				$donnees = mysql_fetch_array($reponse);
				$clan_expe = $donnees['clan'];
					if ($clan_expe == "1") $clan_expe = "Tauri";
					if ($clan_expe == "2") $clan_expe = "Goa'uld";	
					if ($clan_expe == "3") $clan_expe = "Ori";			
					if ($clan_expe == "4") $clan_expe = "BSG";			
					if ($clan_expe == "5") $clan_expe = "Cylon";						
					
					?>
<div id="<?php echo $id; ?>" style="float:left;width:570px">
<div style="float:left;width:10px;"><?php echo $vue; ?></div>
<div style="float:left;width:160px"><?php echo "$destinateur ($clan_expe)"; ?></div>
<div style="float:left;width:230px;text-align:left;"><a onMouseDown="Affbulle2('<p><?php include("index/message.php");?></p>', 500)"><font color="<? echo $color;?>"><?php echo $sujet; ?></font></a></div>
<div style="float:left;width:160px"><?php echo $date; ?> &agrave; <?php echo $heure; ?></div>
<div style="float:left;width:10px;"><a href="#" onClick="go('<?php echo $id; ?>');"><img src="images/del.gif" alt="del" /></a></div>
</div>
<br />
					<?
				}
				?>

				<br /> <a href="accueil.php?page=messagerie&type=vue">D&eacute;clarer vos messages personels comme lu</a>
				<?
			}
			elseif ($type=="rapport") {
				?>
				
				<br />
				
		

<div id="" style="float:left;width:600px">
<div style="float:left;width:10px;">&nbsp;</div>
<div style="padding-left:20px;float:left;width:350px;text-align:left;"><b>Sujet</b></div>
<div style="float:left;width:160px"><b>Heure d'envoi</b></div>
<div style="float:left;width:20px;">&nbsp;</div>
</div><br />
				<?php
				$reponse2 = mysql_query("SELECT * FROM sg_messagerie WHERE type='rapport' AND destinataire='$pseudo' ORDER BY heure DESC");
			
	
				while ($donnees = mysql_fetch_array($reponse2)) {
					$heure= $donnees['heure'];
					$sujet= $donnees['sujet'];
					$message= $donnees['message'];
					$vue= $donnees['vue'];
					$id = $donnees['id'];
					$color = $donnees['color'];
			
					
					$time = time();
					if (date("d/m/y", $time) == date("d/m/y",$heure))
					{
						$date = "<b>" . date("d/m/y",$heure);
						$heure= date("H\h i\m s\s",$heure) . "<b>";
					}
					else
					{
						$date= date("d/m/y",$heure);
						$heure= date("H\h i\m s\s",$heure);				
					}
					
					
					$vue= $donnees['vue'];
					if ($vue == "false") $vue = '<img src="images/non_vue.gif">';					
					else $vue = '<img src="images/vue.gif">';
					
					
					
					?>
<div id="<?php echo $id; ?>" style="float:left;width:600px;">
<div style="float:left;width:10px;"><?php echo $vue; ?></div>
<div style="padding-left:20px;float:left;width:350px;text-align:left;"><a onMouseDown="(Affbulle2('<p><?php include("index/message.php");?></p>',650))"><font color="<? echo $color;?>"><?php echo $sujet; ?></font></a></div>
<div style="float:left;width:160px"><?php echo $date; ?> &agrave; <?php echo $heure; ?></div>
<div style="float:left;width:20px;"><a href="#" onClick="go('<?php echo $id; ?>');"><img src="images/del.gif" alt="del" /></a></div>
</div>


					<?
				}
				?>
		
				
				<br /><br /><div style="float:left;width:500px"><a href="accueil.php?page=messagerie&type=vue&type2=rapport">D&eacute;clarer vos rapports de combats comme lu</a></div>
				<?
			} elseif ($type=="guilde") {
				
				$reponse = mysql_query("SELECT guilde FROM sg_perso WHERE pseudo='$pseudo'");
				$donnees = mysql_fetch_array($reponse);
				$guilde = $donnees['guilde'];

				if ($guilde !== "")			
				{
				?>
				<table width="520" border="0" cellspacing="0" cellpadding="0">

				<br />
				
			
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr style="text-align:center;">
					<td style="width:30%">
						<b>Exp&eacute;diteur</b>
					</td>
					<td style="width:40%" align="left">
						<b>Sujet</b>
					</td>
					<td style="width:30%">
						<b>Heure d'envoi</b>
					</td>
				</tr>
				<?php
				$reponse = mysql_query("SELECT * FROM sg_perso WHERE pseudo='$pseudo'");
				$donnees = mysql_fetch_array($reponse);
				$guilde = $donnees['guilde'];
				
				$reponse2 = mysql_query("SELECT * FROM sg_messagerie WHERE type='guilde' AND destinataire='".addslashes($guilde)."' ORDER BY heure DESC");
			
	
				while ($donnees = mysql_fetch_array($reponse2)) {
					$heure= $donnees['heure'];
					$sujet= $donnees['sujet'];
					$message= $donnees['message'];
					$vue= $donnees['vue'];
					$id= $donnees['id'];
					$color = $donnees['color'];
					$destinateur= $donnees['destinateur'];
			
					$time = time();
					if (date("d/m/y", $time) == date("d/m/y",$heure))
					{
						$date = "<b>" . date("d/m/y",$heure);
						$heure= date("H\h i\m s\s",$heure) . "<b>";
					}
					else
					{
						$date= date("d/m/y",$heure);
						$heure= date("H\h i\m s\s",$heure);				
					}
					
					$reponse = mysql_query("SELECT clan FROM sg_perso WHERE pseudo='$destinateur'");
					$donnees = mysql_fetch_array($reponse);
					$clan_expe = $donnees['clan'];
					if ($clan_expe == "1") $clan_expe = "Tauri";
					if ($clan_expe == "2") $clan_expe = "Goa'uld";	
					if ($clan_expe == "3") $clan_expe = "Ori";			
					if ($clan_expe == "4") $clan_expe = "BSG";			
					if ($clan_expe == "5") $clan_expe = "Cylon";						
					
					?>
					<tr style="text-align:center;">
					<td style="width:30%">
						<?php echo "$destinateur ($clan_expe)"; ?>
					</td>
					<td style="width:40%" align="left">
						<a onMouseDown="(Affbulle2('<p><?php include("index/message.php");?></p>'))"><font color="<?php echo $color;?>"><?php echo $sujet; ?></font></a>
					</td>
					<td style="width:30%">
						<?php echo $date; ?> <?php echo $heure; ?>
					</td>
				</tr>

					<?
				}
				
				?>
				
				</table>
				
				<?
				}
				else 
				{
					echo"<p>Vous n'&ecirc;tes membre d'aucune guilde</p>";
				}


				
				
			} elseif ($type=='clan') {
				?>

				<br />
				
			
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr style="text-align:center;">
					<td style="width:30%">
						<b>Exp&eacute;diteur</b>
					</td>
					<td style="width:40%" align="left">
						<b>Sujet</b>
					</td>
					<td style="width:30%">
						<b>Heure d'envoi</b>
					</td>
				</tr>
				<?php
				$reponse = mysql_query("SELECT * FROM sg_perso WHERE pseudo='$pseudo'");
				$donnees = mysql_fetch_array($reponse);
				$clan = $donnees['clan'];


						
				$reponse2 = mysql_query("SELECT * FROM sg_messagerie WHERE type='clan' AND destinataire='$clan' ORDER BY heure DESC");

				while ($donnees = mysql_fetch_array($reponse2)) {
					$heure= $donnees['heure'];
					$sujet= $donnees['sujet'];
					$message= $donnees['message'];
					$vue= $donnees['vue'];
					$id= $donnees['id'];
					$color = $donnees['color'];
					$destinateur= $donnees['destinateur'];
			
					$time = time();
					if (date("d/m/y", $time) == date("d/m/y",$heure))
					{
						$date = "<b>" . date("d/m/y",$heure);
						$heure= date("H\h i\m s\s",$heure) . "<b>";
					}
					else
					{
						$date= date("d/m/y",$heure);
						$heure= date("H\h i\m s\s",$heure);				
					}
					
					$reponse = mysql_query("SELECT clan FROM sg_perso WHERE pseudo='$destinateur'");
					$donnees = mysql_fetch_array($reponse);
					$clan_expe = $donnees['clan'];
					
					if ($clan_expe == "1") $clan_expe = "Tauri";
					if ($clan_expe == "2") $clan_expe = "Goa'uld";	
					if ($clan_expe == "3") $clan_expe = "Ori";			
					if ($clan_expe == "4") $clan_expe = "BSG";			
					if ($clan_expe == "5") $clan_expe = "Cylon";					
					
					?>
					<tr style="text-align:center;">
					<td style="width:30%">
						<?php echo "$destinateur ($clan_expe)"; ?>
					</td>
					<td style="width:40%" align="left">
						<a onMouseDown="(Affbulle2('<p><?php include("index/message.php");?></p>'))"><font color="<?php echo $color;?>"><?php echo $sujet; ?></font></a>
					</td>
					<td style="width:30%">
						<?php echo $date; ?> <?php echo $heure; ?>
					</td>
				</tr>
					<?
				}
				?>
		
				</table>
			
				<?php
			} elseif ($type=='envoyes') 
			{
				?>

				<br />
				
			
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr style="text-align:center;">
					<td style="width:15%">
						<b>Accus&eacute; de rec.</b>
					</td>
					<td style="width:25%">
						<b>Destinataire</b>
					</td>
					<td style="width:30%" align="left">
						<b>Sujet</b>
					</td>
					<td style="width:30%">
						<b>Heure d'envoi</b>
					</td>
				</tr>
				<?php

						
				$reponse2 = mysql_query("SELECT * FROM sg_messagerie WHERE destinateur='$pseudo' ORDER BY heure DESC");

				while ($donnees = mysql_fetch_array($reponse2)) {
					$heure= $donnees['heure'];
					$sujet= $donnees['sujet'];
					$message= $donnees['message'];
					$vue = $donnees['vue'];
					$id = $donnees['id'];
					$type = $donnees['type'];
					$color = $donnees['color'];
					$destinataire = $donnees['destinataire'];
					
	
					$time = time();
					if (date("d/m/y", $time) == date("d/m/y",$heure))
					{
						$date = "<b>" . date("d/m/y",$heure);
						$heure= date("H\h i\m s\s",$heure) . "<b>";
					}
					else
					{
						$date= date("d/m/y",$heure);
						$heure= date("H\h i\m s\s",$heure);				
					}
					
					$vue= $donnees['vue'];
					if ($vue == "false") $vue = '<img src="images/non_vue.gif">';					
					else $vue = '<img src="images/vue.gif">';	
					
					$reponse = mysql_query("SELECT clan FROM sg_perso WHERE pseudo='".addslashes($destinataire) ."'");
					$donnees = mysql_fetch_array($reponse);
					$clan_expe = $donnees['clan'];
					
					if ($clan_expe == "1") $clan_expe = "Tauri";
					if ($clan_expe == "2") $clan_expe = "Goa'uld";	
					if ($clan_expe == "3") $clan_expe = "Ori";			
					if ($clan_expe == "4") $clan_expe = "BSG";			
					if ($clan_expe == "5") $clan_expe = "Cylon";							
					
					if ($type == "guilde")
					{
						$vue = '<img src="images/vue_clan.gif">';
					}
					if ($destinataire == "1") 
					{
						$destinataire = "Clan";
						$clan_expe = "Tauri";
						$vue = '<img src="images/vue_clan.gif">';
					}
					if ($destinataire == "2")
					{
						$destinataire = "Clan";
						$clan_expe = "Goa'uld";	
						$vue = '<img src="images/vue_clan.gif">';
					}	
					if ($destinataire == "3")
					{
						$destinataire = "Clan";
						$clan_expe = "Ori";	
						$vue = '<img src="images/vue_clan.gif">';
					}	
					if ($destinataire == "4")
					{
						$destinataire = "Clan";
						$clan_expe = "BSG";	
						$vue = '<img src="images/vue_clan.gif">';
					}	
					if ($destinataire == "5")
					{
						$destinataire = "Clan";
						$clan_expe = "Cylon";	
						$vue = '<img src="images/vue_clan.gif">';
					}	
					?>
					<tr style="text-align:center;">
					<td style="width:15%">
						<?php echo $vue; ?>
					</td>
					<td style="width:25%">
						<?php 
						if ($clan_expe != "")
						{
							echo "$destinataire ($clan_expe)"; 
						}
						else echo $destinataire; 
						?>
					</td>
					<td style="width:30%" align="left">
						<a onMouseDown="(Affbulle2('<p><?php include("index/message.php");?></p>'))"><font color="<?php echo $color;?>"><?php echo $sujet; ?></font></a>
					</td>
					<td style="width:30%">
						<?php echo $date; ?> <?php echo $heure; ?>
					</td>
				</tr>
					<?
				}
				?>
				<tr>
					<td colspan="5">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="5"><small>
					<br /><img src="images/vue.gif"> : Lu
					<br /><img src="images/non_vue.gif"> : Non lu 
					<br /><img src="images/vue_clan.gif">: Message clan / guilde</small>
					</td>
				</tr>
				</table>
				
			
				<?php
			} 
			elseif ($type=='envoi')
			{
				$sujet = "";
				$message2 = "";
				$destinataire = "";
				if (isset($_POST['destinataire']) AND isset($_POST['sujet']) AND isset($_POST['message'])) {
					
					$destinataire = addslashes($_POST['destinataire']);
					$color = addslashes($_POST['color']);
					if ($destinataire == "guilde") 
					{			
						$reponse = mysql_query("SELECT guilde FROM sg_perso WHERE pseudo='$pseudo'");
						$donnees = mysql_fetch_array($reponse);
						$guilde = $donnees['guilde'];
						
						$type = "guilde";
						$destinataire = addslashes($guilde);
					}					
					elseif ($destinataire == "clan") 
					{
						$reponse = mysql_query("SELECT clan FROM sg_perso WHERE pseudo='$pseudo'");
						$donnees = mysql_fetch_array($reponse);
						$clan = $donnees['clan'];
						
						$type = "clan"; 
						$destinataire = $clan;
					}
					else
					{
						$type = "perso";
						$destinataire = addslashes($destinataire);
					}
					$sujet = $_POST['sujet'];
					$sujet=addslashes($sujet);

					$message2 = $_POST['message'];
					
					
					
					$time=time();
					
					$test = 'true';
					$message = '';
					if ($destinataire=="aucun") 
					{
						$message ='<p class="erreur">Vous n\'avez pas selection&eacute; de destinataire.</p>';
						$test = 'false';
					} 
					if ($sujet == "") 
					{
						$message .= '<p class="erreur">Vous n\'avez pas entr&eacute; de sujet</p>';
						$test = 'false';
					} 
					if ($message2 == "") 
					{
						$message .= '<p class="erreur">Vous n\'avez pas entr&eacute; de message.</p>';
						$test = 'false';
					} 
					if ($test == 'true')
					{
					
						$message2 = stripslashes($message2);
						$message2 = eregi_replace( "\r\n", "<br />", $message2);
						$message2 = addslashes($message2);
					
					 	mysql_query("INSERT INTO sg_messagerie (destinataire, destinateur, heure, sujet, message, type, color)".
						" VALUES ('$destinataire', '$pseudo', '$time', '$sujet','$message2', '$type', '$color') ")
						or die("Erreur.Impossible d'envoyer le message.");

						$message='<font color="green">Vous avez bien envoy&eacute; ce message</font>';
						$sujet="";
						$message2="";
					}
				}
				?>

				<br />
				
				<?php
				
				if (isset($message))
				{
					echo $message;
				}

					if ($test !== 'true')
					{
					?>
					
					<br />
					<center>
					<form method="post" action="" name="NAME">
					<table width="500" cellpadding="5" >
						<tr>
							<td>
								Destinataire :
														
								<select size="1" name="destinataire">
								<option value="aucun">--Choisir--</option>
								<option value="clan">Au clan</option>
								<option value="guilde">A la guilde</option>
								<option value="aucun">------------</option>
								<?php
								$reponse = mysql_query("SELECT pseudo FROM sg_perso ORDER BY pseudo");
								
								while ($donnees = mysql_fetch_array($reponse)) {
									$pseudo2= $donnees['pseudo'];
									if ($destinataire == $pseudo2)
									{
										?>
										<option SELECTED value="<?php echo $pseudo2 ; ?>"><?php echo $pseudo2; ?></option>
										<?
									}
									else
									{
										?>
										<option value="<?php echo $pseudo2 ; ?>"><?php echo $pseudo2; ?></option>
										<?						
									}
								}
								?>
									
								</select>	
							</td>
							<td>
								Type de message :
								<select size="1" name="color">
									<option value="black">Normal</option>
									<option value="red">Urgent</option>
									<option value="green">Rapport</option>
									<option value="blue">Demande d'info</option>
								</select>
							</td>
						</tr>
					</table>
					
					<br />
					Sujet : <input name="sujet" value="<?php echo $sujet; ?>" size="65" maxlength="65" type="text">
					

					<textarea name="message" cols="54" rows="20"><?php echo $message2; ?></textarea>
					<br />
					
					<br />
					<br />
					<input type="submit" value="Envoyer">
					</center>
					</form>
					
					Le BBcode est actif, plus d'aide <a href="index/bbcode.php" target="fenetreimage" onclick="ouvrirfenetre()">-&gt;ICI&lt;-</a>

					
					<?php
				
				}
			}
		
		?>		
		</td>
	</tr>
	</table>
	
	
	
	
	<br />
	
		
		

	<br />
<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////// Fin du coeur de la page	///////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


