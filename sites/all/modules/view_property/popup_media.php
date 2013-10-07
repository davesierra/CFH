<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Player</title>
<script language="javascript">
function validate_mail(email) {
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   if(reg.test(email) == false) {
      //alert('Invalid Email Address');
      return false;
   }
}

function validate() {
var t=0;
  if(validate_mail(document.getElementById("from12").value) == false) {
   alert("Enter valid from email id");
  return false;
  }
  else {

  if(validate_mail(document.getElementById("email1").value) != false) {
  t=t+1;
  }
  if(validate_mail(document.getElementById("email2").value) != false) {
  t=t+1;
  }
  if(validate_mail(document.getElementById("email3").value) != false) {
  t=t+1;
  }
  if(validate_mail(document.getElementById("email4").value) != false) {
  t=t+1;
  }
  if(validate_mail(document.getElementById("email5").value) != false) {
  t=t+1;
  }
  if(validate_mail(document.getElementById("email6").value) != false) {
  t=t+1;
  }
  if(t==0){
  alert("Enter valid To email id");
  return false;
  }
  else {
  return true;

  }
  
  }
  
  
  }
</script>
</head>

<body>
<?php 
$delpath = "http://192.168.2.44/cfh/sites/all/modules/view_property/close.png";
?>
<div style="width:450px; height:35px; background-color:#FFFFFF"> <a href="javascript:undefined" onclick="disablePopup()" ><img src="<?php print $delpath; ?>" width="30" height="30" align="right"/></a></div>
<div style="width:450px;">
<form name="emailing" id="emailing" method="post" action="#">
<table width="450px">
<?php if($_GET['path'] == 'Thanks') { ?>
<tr><td colspan="2">Thanks for refering our property to your friends</td></tr>
<?php } ?>
<tr><td colspan="2"><h2>Email this listing</h2></td></tr>
<tr><td>From Email</td><td><input type="text" name="from12" id="from12"  size="33" /></td></tr>
<tr><td>To Email 1</td><td><input type="text" name="email1" id="email1" size="33" /></td></tr>
<tr><td>To Email 2</td><td><input type="text" name="email2" id="email2" size="33" /></td></tr>
<tr><td>To Email 3</td><td><input type="text" name="email3" id="email3" size="33" /></td></tr>
<tr><td>To Email 4</td><td><input type="text" name="email4" id="email4" size="33" /></td></tr>
<tr><td>To Email 5</td><td><input type="text" name="email5" id="email5" size="33" /></td></tr>
<tr><td valign="top">Comment:</td><td><textarea name="comment1" id="comment1" rows="5" cols="25"></textarea></td></tr>
<tr><td colspan="2"><input name="send" type="submit" value="Send" onclick="return validate();" id="send_butt" /></td></tr>
</table>
</form>
</div>
</body>
</html>
