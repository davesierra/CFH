<?php 
global $base_url;
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
if((arg(4)=="main") && (arg(5)!="")) {

$res34=db_query("update cfh_images set main='1' where image_id=".arg(5));
$msg="Set as Main Photo successfully";
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
$res="select * from cfh_images where pid='".arg(3)."' order by image_id";
$count_query = "SELECT count(*) from cfh_images where pid='".arg(3)."' order by image_id";
$query1 = pager_query($res, 10, 0, $count_query);

?>
<table>
<tr><td><b>Property Title</b></td><td><b>Image</b></td><td><b>Set as Main</b></td><td><b>Delete</b></td></tr>
<?php 
while($row=db_fetch_object($query1)) {
$title=db_result(db_query("select title from cfh_property where pid=".arg(3)));
?>
<tr><td><?=$title?></td><td><a href="<?=$base_url."/sites/default/files/imgs/".$row->image_url?>" class="thickbox" caption="<?=$base_url."/sites/default/files/imgs/".$row->image_url?>"><div class="table_img"><img src="<?=$base_url."/sites/default/files/imgs/thumbs/".$row->image_url?>" /></div></a></td>
<?php if($row->main == 1) { ?>
<td>Main Photo</td>
<?php } else { ?>
<td><a href="<?=$base_url?>/property1/list/view_imgs/<?=arg(3)?>/main/<?=$row->image_id?>">Set as Main</a></td>
<?php } ?>
<td><a href="<?=$base_url?>/property1/list/view_imgs/<?=arg(3)?>/delete/<?=$row->image_id?>">Delete</a></td></tr>
<?php
}
?>
<tr><td><a href="<?=$base_url?>/property1/list">Back</a></td></tr>
</table>
<?php
 $output =theme('pager', NULL, 10, 0);
 print $output;
}
else if((arg(2)=="") && (arg(3)=="")) {
 
$res="select * from cfh_property order by pid";
$count_query = "SELECT count(*) from cfh_property order by pid";
$query = pager_query($res, 10, 0, $count_query);
?>
<table>
<tr><td><b>Title</b></td><td><b>Property Type</b></td><td><b>Category</b></td><td><b>Sub Category</b></td><td><b>View Images</b></td><td><b>Edit</b></td><td><b>Delete</b></td></tr>
<?php 
while($row=db_fetch_object($query)) {
$category=db_result(db_query("select name from term_data where tid=".$row->category));
$type=db_result(db_query("select name from term_data where tid=".$row->property_type));
?>
<tr><td><?=$row->title?></td><td><?=$type?></td><td><?=$category?></td><td><?=$row->sub_cat?></td><td><a href="<?=$base_url?>/property1/list/view_imgs/<?=$row->pid?>">View Images</a></td><td><a href="<?=$base_url?>/property1/manage/edit/<?=$row->pid?>">Edit</a></td><td><a href="<?=$base_url?>/property1/list/delete/<?=$row->pid?>">Delete</a></td></tr>
<?php
}
?>
</table>

<?php
 $output =theme('pager', NULL, 10, 0);
 print $output;
}
?>
