function redirect_url_paypal(obj) {
	var form_id = "profile-form";
	var name = obj.id;
	var url = document.getElementById('c_url').value;
	var b = document.getElementById('edit-crls-str').value;
    var temp = new Array();
    temp = b.split(',');
    for(i=0;i<temp.length;i++) {
		if(temp[i] == url) {
		alert("Choose another name");
		return false;
		}
	}
	
	
	if(hasWhiteSpace(url) == true) {
	document.getElementById('edit-return').value += '&url='+url;
	document.getElementById(form_id).method = "POST";
	document.getElementById(form_id).action = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	}
	else {
	return false;
	}
	}
	
function hasWhiteSpace(s) 
{
   //  var whiteSpaceExp=/\s/g;
     reWhiteSpace = new RegExp(/\s/g);

     // Check for white space
     if (reWhiteSpace.test(s)) {
          alert("custom url should not contain white spaces");
          return false;
     }
	 else {
		return true; 
	 }
}