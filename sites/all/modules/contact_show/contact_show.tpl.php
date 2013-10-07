<script language="javascript">
function select_all() {
if(document.getElementById('sel_all').checked == true) {
	for(var i=0; i <=document.form1.tot.value; i++) {
	$('input[name=user_'+i+']').attr('checked', true);
	//document.form1.users[i].checked =true;
	}
}
else if(document.getElementById('sel_all').checked == false) {
	for(var i=0; i <=document.form1.tot.value; i++) {
	$('input[name=user_'+i+']').attr('checked', false);
	//document.form1.users[i].checked =false;
	}
}


}

function validate() {
var total="";
for(var i=1; i <=document.form1.tot.value; i++) {
if($('input[name=user_'+i+']').is(':checked'))
total +=i + "\n";
}
if(total=="") {
alert("Please select messages to delete");
return false;
}
else {
return true;
}
}


</script>
<?php 
global $base_url;
if(isset($_POST['delete'])) {
for($i=1;$i<=$_POST['tot'];$i++) {
if($_POST['user_'.$i] == "on") {
$result = db_query("delete from contactus where cid ='$i'");
$msg="You deleted message successfully";
}
}
}



if((arg(2)=="delete") && (arg(3)!="")) {
$re1=db_query("delete from cfh_property where pid=".arg(3));
$res34=db_query("select image_url from cfh_images where pid=".arg(3));
while($row3=db_fetch_object($res34)) {
unlink($_SERVER['DOCUMENT_ROOT']."/cfh/sites/default/files/imgs/normal/".$row3->image_url);
unlink($_SERVER['DOCUMENT_ROOT']."/cfh/sites/default/files/imgs/thumbs/".$row3->image_url);
unlink($_SERVER['DOCUMENT_ROOT']."/cfh/sites/default/files/imgs/".$row3->image_url);
}
$res2=db_query("delete from cfh_images where pid=".arg(3));
$msg="Deleted successfully";
drupal_set_message($msg);
drupal_goto($base_url."/property1/list");
}
if((arg(4)=="delete") && (arg(5)!="")) {

$res34=db_query("select image_url from cfh_images where image_id=".arg(5));
while($row3=db_fetch_object($res34)) {
unlink($_SERVER['DOCUMENT_ROOT']."/cfh/sites/default/files/imgs/normal/".$row3->image_url);
unlink($_SERVER['DOCUMENT_ROOT']."/cfh/sites/default/files/imgs/thumbs/".$row3->image_url);
unlink($_SERVER['DOCUMENT_ROOT']."/cfh/sites/default/files/imgs/".$row3->image_url);
}
$res2=db_query("delete from cfh_images where image_id=".arg(5));
$msg="Deleted successfully";
drupal_set_message($msg);
drupal_goto($base_url."/property1/list/view_imgs/".arg(3));


}




if((arg(2)=="") && (arg(3)=="")) {
drupal_set_title("View messages");
$res="select * from contactus order by cid";
$count_query = "SELECT count(*) from contactus order by cid";
$cnt=db_result(db_query("SELECT count(*) from contactus order by cid"));
$query = pager_query($res, 10, 0, $count_query);
?>
<form name="form1" id="form1" method="post" action="">
<table class="list_table">

<?php
if($msg != "") { ?>
<tr><td colspan="6"><?=$msg?></td></tr>
<?php }
 if($cnt != 0) { ?>
<tr class="tabletop"><td><input type='checkbox' name='sel_all' id="sel_all" onchange="select_all()" /></td><td><b>Subject</b></td><td><b>From</b></td><td><b>Name</b></td><td>Attention</td><td><b>View</b></td></tr>
<?php } ?>
<?php 
while($row=db_fetch_object($query)) {
$attent=db_result(db_query("select name from term_data where tid=".$row->attention));
?>
<tr><td><input type='checkbox' name='user_<?=$row->cid?>' id='user_<?=$row->cid?>' /></td><td><?=stripslashes($row->subject)?></td><td><?=$row->email?></td><td><?=stripslashes($row->name)?></td><td><?=$attent?></td><td align="center"><a href="<?=$base_url?>/contact_show.html/view/<?=$row->cid?>"><img src="<?=$base_url?>/sites/all/modules/cfh_property1/1276266170_zoom_in.png" /></a></td></tr>
<?php
$lid = $row->cid;
}
?>
<input type="hidden" name="tot" value="<?php print $lid; ?>" />
<td colspan="6"><input id="send" type="submit" name="delete" value="Delete" onclick="return validate()" /></td>
</table>
</form>
<?php
 $output =theme('pager', NULL, 10, 0);
 print $output;
}
else if((arg(1)=="view") && (arg(2)!="")) {

drupal_set_title("View details");
$res=db_query("select * from contactus where cid=".arg(2));
$count_query = "SELECT count(*) from contactus where cid=".arg(2);
$cnt=db_result(db_query("SELECT count(*) from contactus where cid=".arg(2)));

?>
<form name="form1" id="form1" method="post" action="">
<table class="list_table">

<?php
while($row=db_fetch_object($res)) {
$attent=db_result(db_query("select name from term_data where tid=".$row->attention));
?>

<tr><td><b>Subject</b></td><td><?=stripslashes($row->subject)?></td></tr>
<tr><td><b>Name</b></td><td><?=stripslashes($row->name)?></td></tr>
<tr><td><b>Email</b></td><td><?=$row->email?></td></tr>
<tr><td><b>Attention</b></td><td><?=$attent?></td></tr>
<tr><td><b>Message</b></td><td><?=stripslashes($row->message)?></td></tr>
<?php
$lid = $row->cid;
}
?>
<input type="hidden" name="tot" value="<?php print $lid; ?>" />
<tr><td colspan="3"><a href="<?=$base_url?>/<?=arg(0)?>">Back</a></td></tr>

</table>
</form>
<?php
}
?>
