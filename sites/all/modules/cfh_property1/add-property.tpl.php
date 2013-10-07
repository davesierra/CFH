<?php       global $base_url;
            //if(isset($_POST['Submit'])) {
			//echo "<PRE>";
			//print_r($_POST);
			//print_r($_FILES);
			//echo "</PRE>"; exit; }
			//print $_SERVER['DOCUMENT_ROOT'];
			$uploaded = 0;
			if(arg(4) == "download") {
				$brochure_url=$base_url."/sites/default/files/brochure/".arg(5);
				$filename = $brochure_url;
				
				$path = $_SERVER['DOCUMENT_ROOT']."/"; // change the path to fit your websites document structure
				$fullPath = $path."/sites/default/files/brochure/".arg(5);
				 
				if ($fd = fopen ($fullPath, "r")) {
					$fsize = filesize($fullPath);
					$path_parts = pathinfo($fullPath);
					$ext = strtolower($path_parts["extension"]);
					switch ($ext) {
						case "pdf":
						header("Content-type: application/pdf"); // add here more headers for diff. extensions
						header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
						break;
						default:
						header("Content-type: application/octet-stream");
						header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
					}
					header("Content-length: $fsize");
					header("Cache-control: private"); //use this to open files directly
					while(!feof($fd)) {
						$buffer = fread($fd, 2048);
						echo $buffer;
					}
				}
				fclose ($fd);
				exit;
				}
				else if(arg(4) == "download_image") {
				$brochure_url=$base_url."/sites/default/files/imgs/logo/".arg(5);
				$filename = $brochure_url;
				
				$path = $_SERVER['DOCUMENT_ROOT']."/"; // change the path to fit your websites document structure
				$fullPath = $base_url."/sites/default/files/imgs/logo/".arg(5);
				
				if ($fd = fopen ($fullPath, "r")) {
					//$fsize = filesize($fullPath);
					$path_parts = pathinfo($fullPath);
					$ext = strtolower($path_parts["extension"]);
					switch ($ext) {
						case "pdf":
						header('Content-type: image/jpg');// add here more headers for diff. extensions
						header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
						break;
						default:
						header('Content-type: image/jpg');
						header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");
					}
					header("Content-length: $fsize");
					header("Cache-control: private"); //use this to open files directly
					//echo $fd;
					while(!feof($fd)) {
						$buffer = fread($fd, 1024);
						echo $buffer;
					}
				}
				fclose ($fd);
				exit;
				
				
				
				// The PDF source is in original.pdf
				//echo $fullPath;
				//readfile($fullPath);
				
				
				 
				
				}
			
			
			//starts imgReisize function
			function imgReisize($uploadedfile, $Destination, $Thumb, $normal, $last_id, $img_flename){
			//this is the function that will resize and copy our images
			
			// Create an Image from it so we can do the resize
			$src = imagecreatefromjpeg($uploadedfile);
			
			// Capture the original size of the uploaded image
			list($width,$height)=getimagesize($uploadedfile);
			
			// For our purposes, I have resized the image to be
			// 600 pixels wide, and maintain the original aspect
			// ratio. This prevents the image from being "stretched"
			// or "squashed". If you prefer some max width other than
			// 600, simply change the $newwidth variable
			$newwidth=356;
			$newheight=265;//($height/$width)*;
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			
			// this line actually does the image resizing, copying from the original
			// image into the $tmp image
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			// now write the resized image to disk. I have assumed that you want the
			// resized, uploaded image file to reside in the ./images subdirectory.
			$filename = $Destination;
			imagejpeg($tmp,$filename,100);
			
			
			
			
			// For our purposes, I have resized the image to be
			// 150 pixels high, and maintain the original aspect
			// ratio. This prevents the image from being "stretched"
			// or "squashed". If you prefer some max height other than
			// 150, simply change the $newheight variable
			$newheight=58;
			$newwidth=58;//($width/$height)*75;
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			
			// this line actually does the image resizing, copying from the original
			// image into the $tmp image
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			// now write the resized image to disk. I have assumed that you want the
			// resized, uploaded image file to reside in the ./images subdirectory.
			$filename = $Thumb;
			imagejpeg($tmp,$filename,100);
			
			// For our purposes, I have resized the image to be
			// 300 pixels high, and maintain the original aspect
			// ratio. This prevents the image from being "stretched"
			// or "squashed". If you prefer some max height other than
			// 300, simply change the $newheight variable
			$newheight=114;
			$newwidth=172;//($width/$height)*150;
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			
			// this line actually does the image resizing, copying from the original
			// image into the $tmp image
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			// now write the resized image to disk. I have assumed that you want the
			// resized, uploaded image file to reside in the ./images subdirectory.
			$filename = $normal;
			imagejpeg($tmp,$filename,100);
			
			
			
			
			imagedestroy($src);
			imagedestroy($tmp); // NOTE: PHP will clean up the temp file it created when the request
			// has completed.
			$sql1= "insert into cfh_images(pid,image_url) values('".$last_id."','". $img_flename."')";
			$res2 = db_query($sql1); 
			$img_id = db_result(db_query("select image_id from cfh_images where pid='".$last_id."' order by image_id limit 1"));
			$res3=db_query("update cfh_images set main='1' where image_id='".$img_id."'");
			if(arg(3) != "") {
			$_SESSION['msg']="Successfully saved";
			}
			else {
			$_SESSION['msg']="Successfully added";
			}
			//echo "Successfully Uploaded: <img src='".$filename."'>";
			}
			//ends imgReisize function

			if(isset($_POST['Submit']) && ($_POST['Submit'] == "Submit")){
			if($_POST['featured'] == 'on') {
			$featured =1;
			}
			else {
			$featured =0;
			}
			$tmp_name=$_FILES['logo']['tmp_name'];
			//print_r($_FILES);
			if($tmp_name != "") {
			$tmp_name=$_FILES['logo']['tmp_name'];
			$Unique=microtime();
			$img_flename = md5($Unique).".jpg";
			$Dest=$_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/logo/".$img_flename;
			move_uploaded_file($tmp_name, $Dest);
			// Create an Image from it so we can do the resize
			//$src = imagecreatefromjpeg($tmp_name);
			
			// Capture the original size of the uploaded image
			//list($width,$height)=getimagesize($tmp_name);
			
			// For our purposes, I have resized the image to be
			// 600 pixels wide, and maintain the original aspect
			// ratio. This prevents the image from being "stretched"
			// or "squashed". If you prefer some max width other than
			// 600, simply change the $newwidth variable
			//$newwidth=162;
			//$newheight=62;//($height/$width)*;
			//$tmp=imagecreatetruecolor($newwidth,$newheight);
			
			// this line actually does the image resizing, copying from the original
			// image into the $tmp image
			//imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			// now write the resized image to disk. I have assumed that you want the
			// resized, uploaded image file to reside in the ./images subdirectory.
			//$filename = $Dest;
			//imagejpeg($tmp,$filename,100);
			
			}
			$tmp_name=$_FILES['brochure']['tmp_name'];
			//move_uploaded_file($tmp_name, $Dest);
			if($tmp_name != "") {
			$tmp_name=$_FILES['brochure']['tmp_name'];
			$name = $_FILES['brochure']['name'];
			$names = explode(".", $name);
			//print_r($_FILES);
			$Unique=microtime();
			$doc_flename = $name;
			//$doc_flename = md5($Unique).".".$names[1];
			$Dest=$_SERVER['DOCUMENT_ROOT']."/sites/default/files/brochure/".$doc_flename;
			move_uploaded_file($tmp_name, $Dest);
			}
			
			$sql= "insert into cfh_property(title,property_type,category,sub_cat,description,amenity_community,amenity_home,address,phone,fax,email,zip,featured,logo,pay_rent,brochure,online,facebook,header_section,leasing_info,property_url,unit,service_request_email) values ('".addslashes($_POST['title'])."','".$_POST['property_type']."','".$_POST['category']."','".addslashes($_POST['sub_cat'])."','".addslashes($_POST['FCKeditor1'])."','".addslashes($_POST['community'])."','".addslashes($_POST['home'])."','".addslashes($_POST['address'])."','".$_POST['phone']."','".$_POST['fax']."','".$_POST['email']."','".$_POST['zip']."','".$featured."','".$img_flename."','".$_POST['pay_rent']."','".$doc_flename."','".$_POST['online']."','".$_POST['facebook']."','".addslashes($_POST['FCKeditor2'])."','".addslashes($_POST['FCKeditor3'])."','".$_POST['property_url']."','".addslashes($_POST['unit'])."','".$_POST['service_request_email']."')";
			
			$_SESSION['msg1']="Successfully added";
			$res1 = db_query($sql); 
			$last_id = db_result(db_query("select pid from cfh_property order by pid DESC")); 
			db_query("insert into node(nid,vid) values('".$last_id."','".$last_id."')");
			db_query("insert into node_revisions(nid) values('".$last_id."')");
			 //uploading images
			 $imgNumb=1; //This the "pointer" to images
			 $DestinationDir=$_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/";  //Place the destination dir here
			 $ThumbDir=$_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/thumbs/";  //Place the thumb dir here
			 $normaldir =$_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/normal/";
			 //print count($_FILES['fileX']['tmp_name']);
			 for($i=0;$i<count($_FILES['fileX']['tmp_name']);$i++) {
			   
			    if($_FILES['fileX']['name'][$i] != "") {
				 if($_FILES['fileX']['error'][$i] ==1) {
					  $_SESSION['error'][] = "The file name ".$_FILES['fileX']['name'][$i]." could not be uploaded and the uploaded file exceeds the maximam file size.";
					  }
				 else if($_FILES['fileX']['error'][$i] ==2) {
					  $_SESSION['error'][] = "The file name ".$_FILES['fileX']['name'][$i]." could not be uploaded and the uploaded file exceeds the maximam file size.";
					  }
				 else if($_FILES['fileX']['error'][$i] ==3) {
					  $_SESSION['error'][] = "The file name ".$_FILES['fileX']['name'][$i]." was only partially uploaded.";
					  } 	
				 else if($_FILES['fileX']['error'][$i] ==4) {
					  $_SESSION['error'][] = "The file name ".$_FILES['fileX']['name'][$i]." could not be uploaded.";
					  } 		    
				
				}
			 
				
				if($_FILES['fileX']['tmp_name'][$i] != "") {
					  $Unique=microtime(); // We want unique names, right?
					  $img_flename = md5($Unique).".jpg";
					  $destination=$DestinationDir.md5($Unique).".jpg";
					  $thumb=$ThumbDir.md5($Unique).".jpg";
					  $normal=$normaldir.md5($Unique).".jpg";
					  imgReisize($_FILES['fileX']['tmp_name'][$i], $destination, $thumb, $normal,$last_id, $img_flename);
					  				  
					  $imgNumb++;
				}
			
			   }
			for($k=0;$k<count($_SESSION['error']);$k++) {
			echo  $_SESSION['error'][$k]."<br />";
			}
			unset($_SESSION['error']);
			echo $_SESSION['msg1'];
			unset($_SESSION['msg1']);
			}
			else if(isset($_POST['Submit']) && ($_POST['Submit'] == "Save")){
			
			if($_POST['featured'] == 'on') {
			$featured =1;
			}
			else {
			$featured =0;
			}
			//print_r($_FILES);
			if($_FILES['logo']['name'] != "") {
			$img=db_result(db_query("select logo from cfh_property where pid=".arg(3)));
			@unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/logo/".$img);
			$tmp_name=$_FILES['logo']['tmp_name'];
			$Unique=microtime();
			$img_flename = md5($Unique).".jpg";
			$Dest=$_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/logo/".$img_flename;
			$tmp_name=$_FILES['logo']['tmp_name'];
			$Unique=microtime();
			$img_flename = md5($Unique).".jpg";
			$Dest=$_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/logo/".$img_flename;
			move_uploaded_file($tmp_name, $Dest);
			// Create an Image from it so we can do the resize
			//$src = imagecreatefromjpeg($tmp_name);
			
			// Capture the original size of the uploaded image
			//list($width,$height)=getimagesize($tmp_name);
			
			// For our purposes, I have resized the image to be
			// 600 pixels wide, and maintain the original aspect
			// ratio. This prevents the image from being "stretched"
			// or "squashed". If you prefer some max width other than
			// 600, simply change the $newwidth variable
			//$newwidth=162;
			//$newheight=62;//($height/$width)*;
			//$tmp=imagecreatetruecolor($newwidth,$newheight);
			
			// this line actually does the image resizing, copying from the original
			// image into the $tmp image
			//imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			
			// now write the resized image to disk. I have assumed that you want the
			// resized, uploaded image file to reside in the ./images subdirectory.
			//$filename = $Dest;
			//imagejpeg($tmp,$filename,100);
			
			//move_uploaded_file($tmp_name, $Dest);
			}
			else {
			$img=db_result(db_query("select logo from cfh_property where pid=".arg(3)));
			$img_flename=$img;
			}
			if($_FILES['brochure']['name'] != "") {
			$doc=db_result(db_query("select brochure from cfh_property where pid=".arg(3)));
			@unlink($_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/logo/".$doc);
			$tmp_name=$_FILES['brochure']['tmp_name'];
			$name = $_FILES['brochure']['name'];
			$names = explode(".", $name);
			//print_r($_FILES);
			$Unique=microtime();
			$doc_flename = $name;
			//$doc_flename = md5($Unique).".".$names[1];
			$Dest=$_SERVER['DOCUMENT_ROOT']."/sites/default/files/brochure/".$doc_flename;
			move_uploaded_file($tmp_name, $Dest);
			}
			else {
			$doc=db_result(db_query("select brochure from cfh_property where pid=".arg(3)));
			$doc_flename = $doc;
			}
			
			
			$sql= "update cfh_property set title='".addslashes($_POST['title'])."',property_type='".$_POST['property_type']."',category='".$_POST['category']."',sub_cat='".addslashes($_POST['sub_cat'])."',description='".addslashes($_POST['FCKeditor1'])."',amenity_community='".addslashes($_POST['community'])."',amenity_home='".addslashes($_POST['home'])."',address='".addslashes($_POST['address'])."',phone='".$_POST['phone']."',fax='".$_POST['fax']."',email='".$_POST['email']."',zip='".$_POST['zip']."',featured='".$featured."',logo='".$img_flename."',pay_rent='".$_POST['pay_rent']."',brochure='".$doc_flename."',online='".$_POST['online']."',facebook='".$_POST['facebook']."',header_section='".addslashes($_POST['FCKeditor2'])."',leasing_info='".addslashes($_POST['FCKeditor3'])."',property_url='".$_POST['property_url']."',unit='".addslashes($_POST['unit'])."',service_request_email='".$_POST['service_request_email']."' where pid=".arg(3);
			$_SESSION['msg1']="Successfully edited";
			$res1 = db_query($sql); 
			if(arg(3) != "") {
			$last_id = arg(3); 
			}
			else {
			$last_id = db_result(db_query("select pid from cfh_property order by pid DESC")); 
			 }
			 //uploading images
			 $imgNumb=1; //This the "pointer" to images
			 $DestinationDir=$_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/";  //Place the destination dir here
			 $ThumbDir=$_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/thumbs/";  //Place the thumb dir here
			 $normaldir =$_SERVER['DOCUMENT_ROOT']."/sites/default/files/imgs/normal/";
			 //print count($_FILES['fileX']['tmp_name']);
			 for($i=0;$i<count($_FILES['fileX']['tmp_name']);$i++) {
				 if($_FILES['fileX']['name'][$i] != "") {
				 if($_FILES['fileX']['error'][$i] ==1) {
					  $_SESSION['error'][] = "The file name ".$_FILES['fileX']['name'][$i]." could not be uploaded and the uploaded file exceeds the maximam file size.";
					  }
				 else if($_FILES['fileX']['error'][$i] ==2) {
					  $_SESSION['error'][] = "The file name ".$_FILES['fileX']['name'][$i]." could not be uploaded and the uploaded file exceeds the maximam file size.";
					  }
				 else if($_FILES['fileX']['error'][$i] ==3) {
					  $_SESSION['error'][] = "The file name ".$_FILES['fileX']['name'][$i]." was only partially uploaded.";
					  } 	
				 else if($_FILES['fileX']['error'][$i] ==4) {
					  $_SESSION['error'][] = "The file name ".$_FILES['fileX']['name'][$i]." could not be uploaded.";
					  } 		    
				
				}
				if($_FILES['fileX']['tmp_name'][$i] != "") {
					  $Unique=microtime(); // We want unique names, right?
					  $img_flename = md5($Unique).".jpg";
					  $destination=$DestinationDir.md5($Unique).".jpg";
					  $thumb=$ThumbDir.md5($Unique).".jpg";
					  $normal=$normaldir.md5($Unique).".jpg";
					  imgReisize($_FILES['fileX']['tmp_name'][$i], $destination, $thumb, $normal,$last_id, $img_flename);
					  $imgNumb++;
				}
			
			   }
			for($k=0;$k<count($_SESSION['error']);$k++) {
			echo  $_SESSION['error'][$k]."<br />";
			}
			unset($_SESSION['error']);
			echo $_SESSION['msg1'];
			unset($_SESSION['msg1']);
			
			
			}
			
			
			
		    $res = db_query("select tid,name from term_data where vid='1' order by weight");
			$res55 = db_query("select tid,name from term_data where vid='2' order by weight");
			
			if((arg(2)!="") && (arg(3)!="")) {
			drupal_set_title("Edit Property");
			$res2=db_query("select * from cfh_property where pid='".arg(3)."' order by pid");
			 while($row1=db_fetch_object($res2)) {
			 $title=stripslashes($row1->title);
			 $cat=$row1->category;
			 $type=$row1->property_type;
			 $sub=$row1->sub_cat;
			 $description=stripslashes($row1->description);
			 $address=stripslashes($row1->address);
			 $phone=$row1->phone;
			 $fax=$row1->fax;
			 $email=$row1->email;
			 $zip=$row1->zip;
			 $featured=$row1->featured;
			 $commmunity=stripslashes($row1->amenity_community);
			 $am_home=stripslashes($row1->amenity_home);
			 $logo=$row1->logo;
			 $pay_rent=$row1->pay_rent;
			 $brochure=$row1->brochure;
			 $online=$row1->online;
			 $facebook=$row1->facebook;
			 $header_section=stripslashes($row1->header_section);
			 $leasing_info=stripslashes($row1->leasing_info);
			 $unit=stripslashes($row1->unit);
			 $property_url=$row1->property_url;
			 $service_request_email=$row1->service_request_email;
			 }
			
			}
			
			
		 

?>
<style type="text/css">
/*.classs1 td {
width:20px;
}*/
</style>
<!--<script language="javascript">

function addmore(id) {
var num = id + 1;
var num1 = id + 2;
var up_id='upload' + num; 
var up_idh = '#upload' + num; 
var up_id1 ='upload' + num1;
var img_id = "img" + id;
var getvalue=document.getElementById(img_id).getAttribute("src");

//document.getElementById("myimage").setAttribute("src","another.gif")

document.getElementById(up_id).innerHTML = "<td><input type='file' name='img"+num+"' id='img"+num+"' /> <a href='#' onclick='addmore("+num+")' id='"+num+"' >Add more</a></td>";
$(up_idh).after("<tr id='"+up_id1+"'></tr>");

//document.getElementById(up_id).outerHTML ="<div id='"+up_id1+"'></div>";
//document.getElementById('img'+id).value="hj";
document.getElementById(id).style.display = 'none';
}

</script>
-->
<script type="text/javascript" src="<?=$base_url?>/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	// Default skin
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "FCKeditor1",
		theme : "advanced",
		skin : "o2k7",
		height : "500px",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});

	// O2k7 skin
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "FCKeditor2",
		theme : "advanced",
		skin : "o2k7",
		height : "500px",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});

	// O2k7 skin (silver)
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "FCKeditor3",
		theme : "advanced",
		skin : "o2k7",
		height : "500px",
		//skin_variant : "silver",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});

	
</script>







<form action="#" method="post" enctype="multipart/form-data">
<table class="classs1">
<tr><td colspan="2"><a style="float:right" href="<?=$base_url?>/property1/list">Back</a></td></tr>
<tr><td width="130">Title:</td>
<td width="240"><input type="text" name="title" id="title" value="<?=stripslashes($title)?>" size="33" /></td></tr>
<tr><td style="width:20px;">Description:</td><td>
<textarea id="FCKeditor1" name="FCKeditor1" rows="40" cols="80" style="width: 80%"><?=$description?></textarea>



<?php
		   /* include("fckeditor/fckeditor.php");
			$sBasePath = $_SERVER['PHP_SELF'] ;
			$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
			
			$oFCKeditor = new FCKeditor('FCKeditor1') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Value		= $description;
			//$oFCKeditor->Value		=
			$oFCKeditor->Create() ;*/
?>

<tr><td>Choose Property type:</td>
<td>
<select name="property_type" id="property_type" onchange="hide_id();">
<option value="">--Select--</option>
<?php 
 while($row=db_fetch_object($res)) {
?>
<option value="<?php print $row->tid;?>" <?php if($type==$row->tid) { ?> selected="selected" <?php } ?>><?php print $row->name; ?></option>
<?php 
 }
 ?>
</select>
</td>
</tr>
<tr><td>Choose Category:</td>
<td>
<select name="category" id="category">
<option value="">--Select--</option>
<?php 
 while($row1=db_fetch_object($res55)) {
?>
<option value="<?php print $row1->tid;?>" <?php if($cat==$row1->tid) { ?> selected="selected" <?php } ?>><?php print $row1->name; ?></option>
<?php 
 }
 ?>
</select>
</td>
</tr>
<tr><td>Sub Category</td><td><input type="text" name="sub_cat" id="sub_cat" value="<?=stripslashes($sub)?>" size="33" /></td></tr>

<tr><td style="width:20px;"><div id="residential_am1" <?php if(($type == 1)) { ?>  <?php } else { ?> style="display:none;" <?php } ?>>Amenities-Community:</div></td><td><div id="residential_am2" <?php if(($type == 1)) { ?>  <?php } else { ?> style="display:none;" <?php } ?>><textarea name="community" id="community" cols="30" rows="6"><?=stripslashes($commmunity)?></textarea><br />Enter text as comma separated</div></td></tr>
<tr><td style="width:20px;"><div id="residential_am3" <?php if(($type == 1)) { ?>  <?php } else { ?> style="display:none;" <?php } ?>>Amenities-Home:</div></td><td><div id="residential_am4" <?php if(($type == 1)) { ?>  <?php } else { ?> style="display:none;" <?php } ?>><textarea name="home" id="home" cols="30" rows="6"><?=stripslashes($am_home)?></textarea><br />Enter text as comma separated</div></td></tr>

<tr><td style="width:20px;"><div id="commercial_top" <?php if(($type == 1) || ($type == 12)) { ?> style="display:none;" <?php } ?>> Top Header Description:</div></td><td>
<div id="commercial_top1" <?php if(($type == 1) || ($type == 12)) { ?> style="display:none;" <?php } ?>>
	<textarea id="FCKeditor2" name="FCKeditor2" rows="40" cols="80" style="width: 80%"><?=$header_section?></textarea>
<?php
		  /* // include("fckeditor/fckeditor.php");
			$sBasePath = $_SERVER['PHP_SELF'] ;
			$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
			
			$oFCKeditor = new FCKeditor('FCKeditor2') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Value		= $header_section;
			//$oFCKeditor->Value		=
			$oFCKeditor->Create() ;*/
?>
</div></td></tr>
<tr><td style="width:20px;"><div id="commercial_lease" <?php if(($type == 1) || ($type == 12)) { ?> style="display:none;" <?php } ?>>Leasing Information:</div></td><td>
<div id="commercial_lease1" <?php if(($type == 1) || ($type == 12)) { ?> style="display:none;" <?php } ?>>
	<textarea id="FCKeditor3" name="FCKeditor3" rows="40" cols="80" style="width: 80%"><?=$leasing_info?></textarea>

<?php
		/*   // include("fckeditor/fckeditor.php");
			$sBasePath = $_SERVER['PHP_SELF'] ;
			$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
			
			$oFCKeditor = new FCKeditor('FCKeditor3') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Value		= $leasing_info;
			//$oFCKeditor->Value		=
			$oFCKeditor->Create() ; */
?>
</div></td></tr>




<tr style="width:20px;"><td>Address:</td><td><textarea name="address" id="address" cols="30" rows="6" onkeypress="return imposeMaxLength(this, 125);"><?=stripslashes($address)?></textarea></td></tr>
<tr><td>Units:</td><td><input type="text" name="unit" id="unit" value="<?=$unit?>" size="33" /></td></tr>
<tr><td>Phone:</td><td><input type="text" name="phone" id="phone" value="<?=$phone?>" size="33" /><br />Enter the phone number in this format(111.111.1111)</td></tr>
<tr><td>Fax:</td><td><input type="text" name="fax" id="fax" value="<?=$fax?>" size="33" /><br />Enter the fax number in this format(111.111.1111)</td></tr>
<tr><td>Email:</td><td><input type="text" name="email" id="email" value="<?=$email?>" size="33" /></td></tr>
<tr><td>Service Request Email:</td><td><input type="text" name="service_request_email" id="service_request_email" value="<?=$service_request_email?>" size="33" /></td></tr>
<tr><td>Zip:</td><td><input type="text" name="zip" id="zip" value="<?=$zip?>" size="33" /></td></tr>
<tr><td>Property Website:</td><td><input name="property_url" id="property_url" type="text" size="33" value="<?=$property_url?>" /><br />Enter the  Website in this format(http://www.abc.com)</td></tr>
<tr><td>Pay Rent Link:</td><td><input name="pay_rent" id="pay_rent" type="text" size="33" value="<?=$pay_rent?>" /><br />Enter the  URL in this format(http://www.abc.com)</td></tr>
<tr><td>Face book Link:</td><td><input name="facebook" id="facebook" type="text" size="33" value="<?=$facebook?>" /><br />Enter the  URL in this format(http://www.abc.com)</td></tr>
<tr><td>Apply Online Link:</td><td><input name="online" id="online" type="text" size="33" value="<?=$online?>" /><br />Enter the  URL in this format(http://www.abc.com)</td></tr>
<tr><td>Brochure:</td><td><input name="brochure" id="brochure" type="file" /></td></tr>
<?php if(arg(2) == "edit") { 
          if($brochure!="") { ?>
<tr><td colspan="2"><a href="<?=$base_url?>/<?=arg(0)?>/<?=arg(1)?>/<?=arg(2)?>/<?=arg(3)?>/download/<?=$brochure?>">Click on this link to download</a></td></tr>
<?php }} ?>
<tr><td>Logo:</td><td><input name="logo" id="logo_form" type="file" /></td></tr>
<?php if(arg(2) == "edit") { 
             if($logo !="") {?>
<tr><td colspan="2"><a target="_blank" href="<?=$base_url?>/<?=arg(0)?>/<?=arg(1)?>/<?=arg(2)?>/<?=arg(3)?>/download_image/<?=$logo?>">Click on this link to download</a></td></tr>
<?php }} ?>
<tr><td>Featured:</td><td><input type="checkbox" name="featured" id="featured" <?php if($featured==1) { ?> checked="checked"  <?php } ?> /></td></tr>
<tr><td>Upload images:</td>

<!--<tr id="upload1"><td><input type="file" name="img1" id= "img1" value="" /><a href="#" onclick="addmore(1)" id="1" >Add more</a></td>
</tr>
<tr id="upload2"></tr>
-->
<td>
<div id="mUpload">
<input class="upload" name="fileX[]" type="file" id="fileX" onchange="do1();" />
<input style="display: none;" class="upload" name="fileX[]" type="file" />
<input style="display: none;" id="element_input" class="upload" name="fileX[]" type="file" />
</div>
</td></tr>
</table>
<div name="asdf" id="asdf"></div><div id="files_list" style="border:1px solid black;padding:5px;background:#fff;font-size:x-small;"></div>
<table>
<?php
if((arg(2)=="") && (arg(3)=="")) {
?>
<tr><td>
<input name="Submit" value="Submit" id="send" type="submit" onclick="return validate();">
</td></tr>
<?php 
}
else {
?>
<tr><td>
<input name="Submit" value="Save" id="send" type="submit" onclick="return validate();">
</td></tr>
<?php 
}
?>
</table>
</form>

<script src="<?php print $base_url; ?>/sites/all/moduless/cfh_property1/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
function imposeMaxLength(Object, MaxLen)
{
  return (Object.value.length <= MaxLen);
}
function hide_id() {
var id=document.getElementById("property_type").value;
//alert(document.getElementById("property_type").value);
if(id==2) {
document.getElementById("commercial_top").style.display = "block";
document.getElementById("commercial_top1").style.display = "block";
document.getElementById("commercial_lease").style.display = "block";
document.getElementById("commercial_lease1").style.display = "block";
document.getElementById("residential_am1").style.display = "none";
document.getElementById("residential_am2").style.display = "none";
document.getElementById("residential_am3").style.display = "none";
document.getElementById("residential_am4").style.display = "none";

}
else if(id==1) {
document.getElementById("commercial_top").style.display = "none";
document.getElementById("commercial_top1").style.display = "none";
document.getElementById("commercial_lease").style.display = "none";
document.getElementById("commercial_lease1").style.display = "none";
document.getElementById("residential_am1").style.display = "block";
document.getElementById("residential_am2").style.display = "block";
document.getElementById("residential_am3").style.display = "block";
document.getElementById("residential_am4").style.display = "block";

}
else if(id==12) {
document.getElementById("commercial_top").style.display = "none";
document.getElementById("commercial_top1").style.display = "none";
document.getElementById("commercial_lease").style.display = "none";
document.getElementById("commercial_lease1").style.display = "none";
document.getElementById("residential_am1").style.display = "none";
document.getElementById("residential_am2").style.display = "none";
document.getElementById("residential_am3").style.display = "none";
document.getElementById("residential_am4").style.display = "none";


}
}


function validate() {
var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
var reZip = new RegExp(/(^\d{5}$)|(^\d{5}-\d{4}$)/);
var regExpObj = /(\d\d\d).\d\d\d.\d\d\d\d/;
var title = document.getElementById("title").value;
//var description = document.getElementById("description").value;
var pro_type = document.getElementById("property_type").value;
var category = document.getElementById("category").value;
var sub_cat = document.getElementById("sub_cat").value;
var address = document.getElementById("address").value;
var phone = document.getElementById("phone").value;
var fax = document.getElementById("fax").value;
var zip = document.getElementById("zip").value;
var logo =  document.getElementById("logo_form").value;
var email = document.getElementById("email").value;
var pay_rent = document.getElementById("pay_rent").value;
var facebook =  document.getElementById("facebook").value;
var online = document.getElementById("online").value;
var property_url = document.getElementById("property_url").value;

     if(title != "") {
	   // if(description != "") {
		  	 if(pro_type != "") {   
				  if(category != ""){
	                if(sub_cat != "") {
	                    if(address != "") {
						     if(regExpObj.exec(phone) != null) {
							   if(regExpObj.exec(fax) != null) {
						         if(validate_mail(email) != false){
						              if(reZip.test(zip) == true) {
									   if(regexp.test(property_url) == true) { 
									    if(regexp.test(pay_rent) = true ) {
										   if(regexp.test(facebook) == true) {
											 if(regexp.test(online) == true) {
												// if(logo != "") {
								  
										  
			 
												//  }
												// else {
												// alert("Please choose image for logo");
												// return false;
												// }
											 }
											 else {
											    if(online != "") {
												 alert("Please enter valid online URL");
												 return false;
												 }
											    }
										   }
										   else {
										   if(facebook != "") {
										    alert("Please enter valid facebook URL");
								            return false;
											}
									       }
									   }
									   else {
									    if(pay_rent != "") {
									     alert("Please enter valid pay rent URL");
								         return false;
										 }
									   }
									  } 
									 else {
									    if(property_url != "") {
									     alert("Please enter valid property URL");
								         return false;
										 }
									   } 
									}
	                                 else {
									  if(zip != "") {
	                                 alert("Please enter valid zip");
								     return false;
									 }
	                                 }
						          
	 
	                              }
	                              else {
								  if(email != "") {
	                               alert("Please enter valid email");
								   return false;
								   }
	                              }
						       }
							   else {
							   if(fax != "") {
							   alert("Please enter valid fax number");
							   return false;
							   }
							   
							   }
	 
	                            }
	                          else {
							   if(phone != "") {
	                           alert("Please enter valid phone number");
							   return false;
							   }
	                          }
							  
						     
	 
	                      }
	                      else {
	                      alert("Please enter address");
						  return false;
	                      }
	 
	 
	 
	                  }
	                  else {
	                  alert("Please enter the sub category");
					  return false;
	                  }
	 
	 
	             }
	            else {
	            alert("Please choose the category");
				return false;
	            }
			}
			else {
	            alert("Please choose the Property type");
				return false;
	            }	
	   // }
	  //  else {
	  //  alert("Please enter the description");
		//return false;
	  //  }
	 }
	 else {
	 alert("Please enter the title");
	 return false;
	 }
   return true;
}

function validate_mail(email) {
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   if(reg.test(email) == false) {
      //alert('Invalid Email Address');
      return false;
   }
}

function do1() {
//obj=document.getElementById('fileX[0]');
obj = document.getElementById('fileX');
var fileMax = 100000;
//$('#asdf').after('<div id="files_list" style="border:1px solid black;padding:5px;background:#fff;font-size:x-small;"></div>');
doIt(obj, fileMax);
}


function doIt(obj, fm) {
//alert(obj.value);
if($('input.upload').size() > fm) {alert('Max files is '+fm); obj.value='';return true;}
$(obj).hide();
$(obj).parent().prepend('<input type="file" id="fileX" name="fileX[]" onchange="do1();" />');
var v = obj.value;
if(v != '') {
$("div#files_list").append('<div>'+v+'<input type="button" class="remove" value="Delete" /></div>')
.find("input").click(function(){
$(this).parent().remove();
$(obj).remove();
return true;
});
}

};

</script>
