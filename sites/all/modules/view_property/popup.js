//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;
var popupStatus = 0;
//loading popup with jQuery magic!
function loadPopup_media(path){
//loads popup only if it is disabled
if(popupStatus==0){
$("#backgroundPopup").css({
"opacity": "0.7"
});
$("#backgroundPopup").fadeIn("slow");
$("#popupContact").fadeIn("slow");
//alert (base);
//alert(path);
$("#popupContact").load("http://192.168.2.44/cfh/sites/all/modules/view_property/popup_media.php?path="+path);
popupStatus = 1;
}
}

//disabling popup with jQuery magic!
function disablePopup(){
//disables popup only if it is enabled
if(popupStatus==1){
$("#backgroundPopup").fadeOut("slow");
$("#popupContact").fadeOut("slow");
popupStatus = 0;
//location.reload(true);
}

}

//centering popup
function centerPopup_media(){
//request data for centering
var windowWidth = document.documentElement.clientWidth;
var windowHeight = document.documentElement.clientHeight;
var popupHeight = $("#popupContact").height();
var popupWidth = $("#popupContact").width();
//centering

$("#popupContact").css({
"position": "absolute",
"top": windowHeight/2-popupHeight/2,
"left": windowWidth/2-popupWidth/2
});

//only need force for IE6

$("#backgroundPopup").css({
"height": windowHeight,
"width": windowWidth
});

}

function showpopup(path)
{
 //alert (path);
  centerPopup_media();  
  loadPopup_media(path);  

}
function showPopupimg(path,img)
{
 // alert (path);
  //alert(img);
  centerPopup();  
  loadPopup(path);  

}

$(document).ready(function(){
$(document).keypress(function(e){
if(e.keyCode==27 && popupStatus==1){
disablePopup();
}
});
						   })
