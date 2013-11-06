<?php
if(isset($_REQUEST['arrayorder'])) {

$array	= $_REQUEST['arrayorder'];

if ($_REQUEST['update'] == "update"){
	
	$count = 1;
	foreach ($array as $idval) {
		$query = "UPDATE `cfh_images` SET `order` = " . $count . " WHERE `image_id` = " . $idval;
		
		db_query($query) or die('Error, insert query failed');
		$count++;	
	}
	
	echo 'Order saved! Refresh the page to see the changes.';
}



}

else {
?>
<!--
<script type="text/javascript" src="http://cfhgroup.com/sites/all/modules/cfh_property1/js/jquery-1.4.3.min.js"></script>
-->
<script language="javascript">
function confirmDelete() {
  if (confirm("Are you sure you want to delete?")) {
    return true;
  }
  else {
  return false;
  }
  
}

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
$res=confirmDelete();
if($res) {
var total="";
for(var i=1; i <=document.form1.tot.value; i++) {
if($('input[name=user_'+i+']').is(':checked'))
total +=i + "\n";
}
if(total=="") {
alert("Please select atleast one to delete");
return false;
}
else {
return true;
}
}
else {
return false;
}
}


</script>

<?php 
global $base_url;


if(isset($_POST['delete'])) {
for($i=1;$i<=$_POST['tot'];$i++) {
if($_POST['user_'.$i] == "on") {

$re1=db_query("delete from cfh_property where pid=".$i);
$res34=db_query("select cfi.image_url from cfh_images as cfi  where cfi.pid='".$i."' order by cfi.order");
while($row3=db_fetch_object($res34)) {
unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/normal/".$row3->image_url);
unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/thumbs/".$row3->image_url);
unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/".$row3->image_url);
}
$res2=db_query("delete from cfh_images where pid=".$i);
$msg="Deleted successfully";
}
}
drupal_set_message($msg);
drupal_goto($base_url."/property1/list");
}

if(isset($_POST['delete_img'])) {
	print_r($_POST);
	for($i=1;$i<=$_POST['tot'];$i++) {
		if($_POST['user_'.$i] == "on") {
			$res34=db_query("select image_url from cfh_images where image_id=".$i);
			while($row3=db_fetch_object($res34)) {
				unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/normal/".$row3->image_url);
				unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/thumbs/".$row3->image_url);
				unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/".$row3->image_url);
			}

			$res2=db_query("delete from cfh_images where image_id=".$i);
			$msg="Deleted successfully";
		}
	}
	drupal_set_message($msg);
	drupal_goto($base_url."/property1/list/view_imgs/".arg(3));
}
if(isset($_POST['upload_img'])) {
	print_r($_POST);
}


if((arg(2)=="delete") && (arg(3)!="")) {
	$re1=db_query("delete from cfh_property where pid=".arg(3));
	$res34=db_query("select image_url from cfh_images where pid=".arg(3));
	while($row3=db_fetch_object($res34)) {
	unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/normal/".$row3->image_url);
	unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/thumbs/".$row3->image_url);
	unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/".$row3->image_url);
	}
	$res2=db_query("delete from cfh_images where pid=".arg(3));
	$msg="Deleted successfully";
	drupal_set_message($msg);
	drupal_goto($base_url."/property1/list");
}
if((arg(4)=="delete") && (arg(5)!="")) {

	$res34=db_query("select image_url from cfh_images where image_id=".arg(5));
	while($row3=db_fetch_object($res34)) {
	unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/normal/".$row3->image_url);
	unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/thumbs/".$row3->image_url);
	unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/".$row3->image_url);
	}
	$res2=db_query("delete from cfh_images where image_id=".arg(5));
	$msg="Deleted successfully";
	drupal_set_message($msg);
	drupal_goto($base_url."/property1/list/view_imgs/".arg(3));


}
if((arg(4)=="main") && (arg(5)!="")) {
	$res34=db_query("update cfh_images set main='0' where pid=".arg(3));
	$res34=db_query("update cfh_images set main='1' where image_id=".arg(5));
	$msg="Set album cover successfully";
	drupal_set_message($msg);
	drupal_goto($base_url."/property1/list/view_imgs/".arg(3));


}


if((arg(2)=="view_imgs") && (arg(3)!="")) {

drupal_set_title("View Images");


					
			           $table = '<style type="text/css">
			                     .demo ul { list-style-type: none; margin: 0; padding: 0; margin-bottom: 10px; }
	                             .demo li { margin: 5px; padding: 5px; width: 150px; }
			                     </style>
					             <link type="text/css" href="'.$base_url.'/sites/all/modules/cfh_property1/css/themes/base/jquery.ui.all.css" rel="stylesheet" />
                                 <link type="text/css" href="'.$base_url.'/sites/all/modules/cfh_property1/css/demos1.css" rel="stylesheet" />
					             <link type="text/css" href="'.$base_url.'/sites/all/modules/cfh_property1/css/thickbox.css" rel="stylesheet" />
			                     <script type="text/javascript" src="'.$base_url.'/sites/all/modules/cfh_property1/js/jquery-1.3.2.min1.js"></script>
					             <script type="text/javascript" src="'.$base_url.'/sites/all/modules/cfh_property1/js/jquery.ui.core.min.js"></script>
								  <script type="text/javascript" src="'.$base_url.'/sites/all/modules/cfh_property1/js/jquery.ui.widget.min.js"></script>
								  <script type="text/javascript" src="'.$base_url.'/sites/all/modules/cfh_property1/js/jquery.ui.mouse.min.js"></script>
								  <script type="text/javascript" src="'.$base_url.'/sites/all/modules/cfh_property1/js/jquery.ui.draggable.min.js"></script>
								  <script type="text/javascript" src="'.$base_url.'/sites/all/modules/cfh_property1/js/jquery.ui.sortable.min.js"></script>
								  <script type="text/javascript" src="'.$base_url.'/sites/all/modules/cfh_property1/js/thickbox-compressed.js"></script>
								  <script type="text/javascript">
									$(function() {
									$("#sortable").sortable({
										revert: true
									});
									$("#draggable").draggable({
										connectToSortable: "#sortable",
										helper: "clone",
										revert: "invalid"
									});
									$("ul, li").disableSelection();
								   });
								  </script>';
								  
print $table;
$res="select * from cfh_images as ci where ci.pid='".arg(3)."' order by ci.order";
$count_query = "SELECT count(*) from cfh_images as ci where ci.pid='".arg(3)."' order by ci.order";
$cnt= db_result(db_query($count_query));
$query1 = pager_query($res, $cnt, 0, $count_query);
$cnt= db_result(db_query($count_query));
?>

 <style>
ul {
	padding:0px;
	margin: 0px;
}
#response {
	padding:10px;
	background-color:#9F9;
	border:2px solid #396;
	margin-bottom:20px;
}
 li.row1_bg {
	background:#ecf5ff;
	margin: 0 0 3px;
	padding:8px;
	color:#000;
	list-style: none;
	cursor:move;
	height:15px;
}
 li.row2_bg {
	background:#fff;
	margin: 0 0 3px;
	padding:8px;
	color:#000;
	list-style: none;
	cursor:move;
	height:15px;
}

</style>   







<form name="form1" id="form1" method="post" action="">
<table class="list_table">
<tr><td colspan="8"><a style="float:right;" href="<?=$base_url?>/property1/list">Back</a></td></tr>
<?php if($cnt!=0) { ?>
<tr class="tabletop"><td><input type='checkbox' name='sel_all' id="sel_all" onclick="select_all()" /></td><td><b>Property Title</b></td><td><b>Image</b></td><td><b>Set album cover</b></td><td><b>Delete</b></td></tr>
<?php }
   else {
 ?>
<tr><td colspan="8" align="center">No images uploaded for this property</td></tr>
<?php 
}
?>
<tr><td colspan="5">
<div id="list">

    <div id="response"></div>
<ul>
<?php
$i=1;
while($row=db_fetch_object($query1)) {
                                  if($i%2 == 1) {
								  $classname="row1_bg";
								  }
								  else {
								  $classname="row2_bg";
								  }
$title=db_result(db_query("select title from cfh_property where pid=".arg(3)));
$maxpid=db_result(db_query("select max(ci.image_id) from cfh_images as ci where ci.pid='".arg(3)."' order by ci.order ASC"));
?>
<li id="arrayorder_<?=$row->image_id?>"  class="<?=$classname?>" style="width:921px; height:62px; margin-left:-6px;">
<div style="width:10%; float:left;margin-left:-2px;"><input type='checkbox' name='user_<?=$row->image_id?>' id='user_<?=$row->image_id?>' /></div><div style="margin-left:-23px;width:10%; float:left"><?=$title?></div>
<div style="width:40%; float:left;margin-left:179px;"><a href="<?=$base_url."/sites/default/files/imgs/".$row->image_url?>" class="thickbox" caption="<?=$base_url."/sites/default/files/imgs/".$row->image_url?>"><div class="table_img" ><img src="<?=$base_url."/sites/default/files/imgs/thumbs/".$row->image_url?>" /></div></a></div>
<?php if($row->main == 1) { ?>
<div style="width:10%; float:left; margin-left:-220px">Main Photo</div>
<?php } else { ?>
<div style="width:10%; float:left; margin-left:-220px"><a href="<?=$base_url?>/property1/list/view_imgs/<?=arg(3)?>/main/<?=$row->image_id?>"><!--<img src="<?//=$base_url?>//sites/all/modules/cfh_property1/fix_it.jpg" width="100px" height="50px" />-->Set</a></div>
<?php } ?>
<div style="width:10%; float:left;margin-left:91px;"><a href="<?=$base_url?>/property1/list/view_imgs/<?=arg(3)?>/delete/<?=$row->image_id?>" onclick="return confirmDelete();"><img src="<?=$base_url?>/sites/all/modules/cfh_property1/1276266111_delete.png" /></a></div>
</li>
<?php
$lid = $row->image_id;
$i=$i+1;
}
?>
</ul></div>  
</td></tr>
<input type="hidden" name="tot" value="<?php print $maxpid; ?>" />
<?php if($cnt!=0) { ?>
<td colspan="4">
	<input type="submit" class="send" name="delete_img" value="Delete" onclick="return validate()" />
</td>

<td colspan="4">
	
	<div id="mUpload">
		Upload images:
		<input class="upload" name="fileX[]" type="file" id="fileX" onchange="do1();" />
		<input style="display: none;" class="upload" name="fileX[]" type="file" />
		<input style="display: none;" id="element_input" class="upload" name="fileX[]" type="file" />
	</div>
	<input type="submit" class="send" name="upload_img" value="Upload" onclick="return validate()" />
</td>

<?php } ?>
</table>
</form>
<script>	
function slideout(){
  setTimeout(function(){
  $("#response").slideUp("slow", function () {
      });
    
}, 2000);} 
   
	$(function() {
	$("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {
			
			var order = $(this).sortable("serialize") + '&update=update'; 
                        var open_base_url = $('#open_base_url').val();
                        //alert(open_base_url);
			//alert(order);
			$.post(open_base_url+"/property1/list/view_imgs/212", order, function(theResponse){
			
			  if(theResponse != "") {
		 	    //alert(theResponse);
				$("#response").html("Order saved! Refresh the page to see the changes.");
				$("#response").slideDown('slow');
				slideout();
				}
			}); 															 
		}								  
		});
	});
    </script>
<?php
 $output =theme('pager', NULL, $cnt, 0);
 print $output;
 
}
else if((arg(2)=="") && (arg(3)=="")) {
//print_r($_POST);
if((isset($_POST['key'])) || (isset($_POST['property_type']))) {
	if(($_POST['key'] != "") || ($_POST['property_type'] != "")) {
	$where='';
	}
	else if(($_POST['key'] == "") && ($_POST['property_type'] == "")) {
	$_SESSION['where']='';
	}
	if($_POST['key'] != "") {
	$where .=" and (title like '".addslashes($_POST['key'])."%' or title like '%".addslashes($_POST['key'])."')";
	}
	if($_POST['property_type'] != ""){
	$where .=" and property_type = '".$_POST['property_type']."'";
    }
	$_SESSION['where'] = $where;
}
else {
    if((!isset($_GET['page'])) && (!isset($_GET['key']))) {
	$_SESSION['where']='';
	}
	else if($_SESSION['where'] == "") {
	$_SESSION['where']='';
	}
}
//print $_SESSION['where'];

$res="select * from cfh_property where property_type !=0 ".$_SESSION['where']." order by pid";
$count_query = "SELECT count(*) from cfh_property where property_type !=0 ".$_SESSION['where']."  order by pid";
$cnt=db_result(db_query("SELECT count(*) from cfh_property  ".$_SESSION['where']."  order by pid"));
$query = pager_query($res, 10, 0, $count_query);
$res = db_query("select tid,name from term_data where vid='1' order by tid");
?>
<form method="post" action="">
<table class="list_table">
<tr><td>Enter Key</td><td><input type="text" name="key" id="key" value="<?=$_POST['key']?>" /></td></tr>
<tr><td>Choose Property Type</td><td>
<select name="property_type" id="property_type">
<option value="">--Select--</option>
<?php 
 while($row=db_fetch_object($res)) {
?>
<option value="<?php print $row->tid;?>" <?php if($_POST['property_type']==$row->tid) { ?> selected="selected" <?php } ?>><?php print $row->name; ?></option>
<?php 
 }
 ?>
</select>


</td></tr>
<tr><td colspan="2"><input type="submit" id="send" name="filter" value="Filter" /></td></tr>
</table>
</form>
<form name="form1" id="form1" method="post" action="">

<table class="list_table">
<?php if($cnt != 0) { ?>
<tr class="tabletop"><td><input type='checkbox' name='sel_all' id="sel_all" onclick="select_all()" /></td><td><b>Title</b></td><td><b>Property Type</b></td><td><b>Category</b></td><td><b>Sub Category</b></td><td><b>View Images</b></td><td><b>Edit</b></td><td><b>Delete</b></td></tr>
<?php } 
else {
?>
<tr><td colspan="8" align="center">No properties found</td></tr>

<?php 
}
while($row=db_fetch_object($query)) {
$category=db_result(db_query("select name from term_data where tid=".$row->category));
$type=db_result(db_query("select name from term_data where tid=".$row->property_type));
?>
<tr><td><input type='checkbox' name='user_<?=$row->pid?>' id='user_<?=$row->pid?>' /></td><td><?=stripslashes($row->title)?></td><td><?=$type?></td><td><?=$category?></td><td><?=stripslashes($row->sub_cat)?></td><td align="center"><a href="<?=$base_url?>/property1/list/view_imgs/<?=$row->pid?>"><img src="<?=$base_url?>/sites/all/modules/cfh_property1/1276266170_zoom_in.png" /></a></td><td align="center"><a href="<?=$base_url?>/property1/manage/edit/<?=$row->pid?>"><img src="<?=$base_url?>/sites/all/modules/cfh_property1/1276266386_page_white_wrench.png" /></a></td><td align="center"><a href="<?=$base_url?>/property1/list/delete/<?=$row->pid?>" onclick="return confirmDelete();"><img src="<?=$base_url?>/sites/all/modules/cfh_property1/1276266111_delete.png" /></a></td></tr>
<?php
$lid = $row->pid;

}
?>
<input type="hidden" name="tot" value="<?php print $lid; ?>" />
<?php if($cnt != 0) { ?>
<td colspan="8"><input type="submit" id="send" name="delete" value="Delete" onclick="return validate()" /></td>
<?php } ?>
</table>
</form>
<?php
 $output =theme('pager', NULL, 10, 0);
 print $output;
}
}
?>
<script language="javascript">
$("#response").hide();
</script>
<input type="text" id="open_base_url" value="<?php echo $base_url; ?>" /> 