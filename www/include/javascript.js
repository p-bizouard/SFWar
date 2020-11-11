function ouvrirfenetre()
{
	exemple=window.open ("","fenetreimage", "width=360,height=500, top=0, left=200, scrollbars=yes, toolbar=no, location=no, directories=no, status=no")
}

function twFermer()
{
	window.close();
}



var IBB=new Object;
var posX=0;posY=0;
var xOffset=10;yOffset=25;

	function Affbulle2(texte, width) 
	{
		var contenu = "";
		contenu = contenu +'<table style="background:#b9c0cb" border="0" cellpadding="0" cellspacing="0" width="'+width+'"><tr><td width="32">';
		contenu = contenu +'<a href="" onMouseDown="Hidebulle2()"><img src="images/page_haut_gauche2.png" border="0" /></a>';
		contenu = contenu +'</td><td background="images/page_haut.png">&nbsp;</td><td width="32"><img src="images/page_haut_droit.png" /></td></tr><tr><td background="images/page_gauche.png">&nbsp;</td><td class="centre ; texte">';
		contenu = contenu +texte;
		contenu = contenu +'</td><td background="images/page_droit.png">&nbsp;</td></tr><tr><td width="32"><img src="images/page_bas_gauche2.png" /></td><td background="images/page_bas.png">&nbsp;</td><td width="32"><img src="images/page_bas_droit.png" /></td></tr></table>';
		

  var finalPosX=posX-xOffset;
	  if (finalPosX<0) finalPosX=0;
		
		
	  if (document.layers) {
	    document.layers["bulle2"].document.write(contenu);
	    document.layers["bulle2"].document.close();
	    document.layers["bulle2"].top=posY+yOffset;
	    document.layers["bulle2"].left=finalPosX;
	    document.layers["bulle2"].visibility="show";
		}
	  if (document.all) {
	    //var f=window.event;
	    //doc=document.body.scrollTop;
	    bulle2.innerHTML=contenu;
	    document.all["bulle2"].style.top=posY+yOffset;
	    document.all["bulle2"].style.left=finalPosX;//f.x-xOffset;
	    document.all["bulle2"].style.visibility="visible";
	  }
	  //modif CL 09/2001 - NS6 : celui-ci ne supporte plus document.layers mais document.getElementById
	  else if (document.getElementById) {
	    document.getElementById("bulle2").innerHTML=contenu;
	    document.getElementById("bulle2").style.top=posY+yOffset +'px';
	    document.getElementById("bulle2").style.left = finalPosX +'px';
	    document.getElementById("bulle2").style.visibility="visible";
	  }
	}
	function getMousePos(e) 
	{
	  if (document.all) {
	  posX=event.x+document.body.scrollLeft; //modifs CL 09/2001 - IE : regrouper l'évènement
	  posY=event.y+document.body.scrollTop;
	  }
	  else {
	  posX=e.pageX; //modifs CL 09/2001 - NS6 : celui-ci ne supporte pas e.x et e.y
	  posY=e.pageY;
	  }
	}
	function Hidebulle2() 
	{
		if (document.layers) {document.layers["bulle2"].visibility="hide";}
		if (document.all) {document.all["bulle2"].style.visibility="hidden";}
		else if (document.getElementById){document.getElementById("bulle2").style.visibility="hidden";}
	}

	function Initbulle2(ColTexte,ColFond,ColContour,NbPixel) 
	{
		IBB.ColTexte=ColTexte;IBB.ColFond=ColFond;IBB.ColContour=ColContour;IBB.NbPixel=NbPixel;
		if (document.layers) {
			window.captureEvents(Event.MOUSEMOVE);window.onMouseMove=getMousePos;
			document.write("<LAYER name='bulle2' z-index='9'  top=0 left=0 visibility='hide'></LAYER>");
		}
		
		if (document.all) {
			document.write("<DIV id='bulle2' z-index='9' style='position:absolute;top:0;left:0;visibility:hidden'></DIV>");
			document.onmousemove=getMousePos;
		}
		//modif CL 09/2001 - NS6 : celui-ci ne supporte plus document.layers mais document.getElementById
		else if (document.getElementById) {
		        document.onmousemove=getMousePos;
		        document.write("<DIV id='bulle2' z-index='9'  style='position:absolute;top:0;left:0;visibility:hidden'></DIV>");
		}
	}
  
 
Initbulle2("#333333","#B0A37A","#FFFFFF",1);
  