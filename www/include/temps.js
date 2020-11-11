						function t(){
           		     v=new Date();
           		     var bxx=document.getElementById('bxx');
               		 n=new Date();
               		 ss=pp;
              		  s=ss-Math.round((n.getTime()-v.getTime())/1000.);
              		  m=0;h=0;
              		  if(s<0){
              		    bxx.innerHTML="Terminé<br>"+"<a href=accueil.php?page=mine&action="+ps+">Valider</a>"
                }else{
				  if(s<60){
				   m=0
				   h=0
				   d=0
				  }
                  if(s>59){
                    m=Math.floor(s/60);
                    s=s-m*60
                    h=0
                    d=0
                  }
                  if(m>59){
                    h=Math.floor(m/60);
                    m=m-h*60
                    d=0
                  }
                   if(h>24){
                    d=Math.floor(h/24);
                    h=h-d*24
                  }

                  if(s<10){
                    s="0"+s
                  }
                  if(m<10){
                    m="0"+m
                  }
                  if(d<=1){

					if (h<1){
                     if (m<1){
                  	  bxx.innerHTML=s+"s"+"<br><a href=accueil.php?page=mine&action="+pc+">Annuler</a>"
                  	 }
                     if (m>=1){
                  	  bxx.innerHTML=m+"m "+s+"s"+"<br><a href=accueil.php?page=mine&action="+pc+">Annuler</a>"
                  	 }									
                  	}
                  	 if(h>0){
				      bxx.innerHTML=h+"h "+m+"m "+s+"s"+"<br><a href=accueil.php?page=mine&action="+pc+">Annuler</a>"
				     }
				  }
                  if(d>0){
                   bxx.innerHTML=d+"j "+h+"h "+m+"m "+s+"s"+"<br><a href=accueil.php?page=mine&action="+pc+">Anuler</a>"
				  }
				}
       		         pp=pp-1;
       		         window.setTimeout("t();",999);

     		         }
