<script language="javascript">
function validate() {
var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
var email = document.getElementById("pay_rent_online").value;
 if(regexp.test(email)) {
 return true;
 }
 else {
  alert("Please enter valid URL");
  return false;
 }
}

function validate_mail(email) {
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   if(reg.test(email) == false) {
      //alert('Invalid Email Address');
      return false;
   }
}


</script>
<?php 
global $base_url;

if(isset($_POST['Save'])) {
db_query("update cfh_links set link= '".$_POST['pay_rent_online']."' where id='1'");
$msg="Successfully saved";
}


drupal_set_title("Edit Pay Rent Online Link");
$link=db_result(db_query("SELECT link from cfh_links where id='1'"));
?>
<form name="form1" id="form1" method="post" action="">
<table class="list_table">
<?php if($msg != "") { ?>
<tr><td colspan="2"><?=$msg?></td></tr>
<?php } ?>
<tr><td>Pay Rent Online:</td><td><input type="text" name="pay_rent_online" id="pay_rent_online" value="<?=$link?>" style=" size:100px;" size="100px" /></td></tr>
<tr style="border:none"><td style="border:none"></td><td style="border:none"><input id="send" type="submit" name="Save" value="Save" onclick="return validate()" /></td></tr>
</table>
</form>