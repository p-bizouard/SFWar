<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
      <title>SG-War [Jeu Online gratuit et multijoueur]</title>
      <!-- <link rel="Shortcut Icon" href="images/icone2.png" /> -->
      <link rel="stylesheet" href="../include/style.css" />
      <meta http-equiv="Content-Language" content="fr" />
      <meta name="reply-to" content="mj@sg-war.fr" />
      <meta name="category" content="Jeux" />
      <meta name="robots" content="index, follow" />
      <meta name="Keywords" content="" />
      <meta name="distribution" content="local" />
      <meta name="revisit-after" content="15 days" />
      <meta name="author" lang="fr" content="Gueust, L&eacute;odi" />
      <meta name="copyright" content="Gueust & L&eacute;odi" />
      <meta name="generator" content="Notepad++" />
      <meta name="identifier-url" content="http://leodi14.free.fr/stargate/SG-War%20Beta/jeu/" />
      <meta name="expires" content="never" />
      <meta name="Date-Creation-yyyymmdd" content="20060101" />

<script>
function sourisxy(e)
  {
  x = (navigator.appName=="Netscape") ? e.pageX : event.x + document.body.scrollLeft;
  y = (navigator.appName=="Netscape") ? e.pageY : event.y + document.body.scrollTop;
  
  x = x-5;
    
  	x = Math.round(x/6);
	y = Math.round(y/6);
	
	y = 50 - y + 4;
	x = x - 3;
	
	if(x<0) x=0;
	if(y<0) y=0;
	
	if(x>50) x=50;
	if(y>50) y=50;
	
document.getElementById("coord").innerHTML = "Coordonn&eacute;es X:"+x+" / Y:"+ y;
}

if(navigator.appName.substring(0,3) == "Net")
document.captureEvents(Event.mousemove);
document.onmousemove = sourisxy;


</script>

</head>
<body>
<br />

<table>
	<tr>
		<td style="width:10"></td>
		<td><img src=map2.php></td>
		<td></td>
	</tr>
</table>
<div id="coord" style="padding-left:30px;"></div>
<table>
	<tr>
		<td style="width:10"></td>
		<td colspan="2" align="center"><b>Plan&egrave;tes</b></td>
		<td style="width:10"></td>
		<td colspan="2" align="center"><b>Flottes</b></td>
	</tr>
	<tr>
		<td style="width:10"></td>
		<td><font color="#0000c8">&#8718;</font></td>
		<td>Seigneurs de Guerre</td>
		<td style="width:10"></td>
		<td><font color="#3296ff">&#8718;</font></td>
		<td>Seigneurs de Guerre</td>
	</tr>

	<tr>
		<td style="width:10"></td>
		<td><font color="#c80000">&#8718;</font></td>
		<td>Ma&icirc;tres de la Destin&eacute;e</td>
		<td style="width:10"></td>
		<td><font color="#ff6464">&#8718;</font></td>
		<td>Ma&icirc;tres de la Destin&eacute;e</td>
	</tr>
	<tr>
		<td style="width:10"></td>
		<td><font color="#d7d7d7">&#8718;</font></td>
		<td>Guerriers de l'Humanit&eacute;</td>
		<td style="width:10"></td>
		<td><font color="#ffffff">&#8718;</font></td>
		<td>Guerriers de l'Humanit&eacute;</td>
	</tr>
	<tr>
		<td style="width:10"></td>
		<td><font color="#669900">&#8718;</font></td>
		<td>Neutre</td>
		<td style="width:10"></td>
		<td><font color="#66CC00">&#8718;</font></td>
		<td>Neutre</td>
	</tr>
</table>
<br />
<center>
	<table>
		<tr>
			<td>
				<input type="button" value="Mettre &agrave; jour" onClick="window.location.reload(true)">
			</td>
			<td>
				<input type="button" value="Fermer la carte" onClick="window.close()">
			</td>
		</tr>
	</table>
</center>

</body>
</html>