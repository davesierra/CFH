// JavaScript Document
var current=1;
var changeopacity=0;
function replace_me(value){
	current=value;
	loadPicture(current);	
	}

function loadPicture(current){
	var img = 'img'+ current;
	//alert(document.getElementById(img).value);
	document.getElementById("mainimage").style.backgroundImage = 'url(' + document.getElementById(img).value + ')';
	var mainimage="mainimage";
		fadeOut(mainimage,0)
	
	
	}
	
	function pre(){
		current=current-1;
		if(current<1){
			current=12
			loadPicture(current);
			}
			else
			loadPicture(current);
		}
		
	function next(){
		current=current+1;
		if(current>12){
			current=1;
			loadPicture(current);
			}
			else
			loadPicture(current);
		}
		
function fadeOut(objId,opacity) {
 if (document.getElementById) {
    if (opacity <=100) {
       document.getElementById("mainimage").style.MozOpacity = opacity/100;
	   document.getElementById("mainimage").style.opacity = opacity/100;
	   document.getElementById("mainimage").style.filter = "alpha(opacity:"+opacity+")";
	  // Safari<1.2, Konqueror
   		document.getElementById("mainimage").style.KHTMLOpacity = opacity/100;
       opacity += 10;
       window.setTimeout("fadeOut('"+objId+"',"+opacity+")",30);
	   
    }
	
  }
}

function init(){
	document.getElementById("mainimage").style.backgroundImage = 'url(images/gallery_large/img0'+current+'.jpg)';
	var mainimage="mainimage";
	fadeOut(mainimage,0)
		}








