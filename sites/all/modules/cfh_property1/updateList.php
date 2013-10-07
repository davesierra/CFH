<?php 
//echo "hello";
//include("connect.php");
$link = mysql_connect("cfhdatabase.db.6330561.hostedresource.com","cfhdatabase","cfhMiami123");
mysql_select_db("cfhdatabase", $link) or die("Could not able to Select the Database".mysql_error());

$array	= $_REQUEST['arrayorder'];

if ($_REQUEST['update'] == "update"){
	
	$count = 1;
	foreach ($array as $idval) {
		$query = "UPDATE `cfh_images` SET `order` = " . $count . " WHERE `image_id` = " . $idval;
		
		mysql_query($query) or die('Error, insert query failed');
		$count++;	
	}
	
	echo 'Order saved! Refresh the page to see the changes.';
}
?>