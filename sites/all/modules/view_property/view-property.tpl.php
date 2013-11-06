<?php 
global $base_url;
global $user;
if($user->uid==1) {
drupal_goto($base_url."/user");
}
?>
 <script src="<?=$base_url?>/themes/garland/js_menu1/jquery-1.2.1.min.js" type="text/javascript"></script>
 <script type="text/javascript">
    //var $j = jQuery.noConflict(true);
 </script>
 <script src="<?=$base_url?>/themes/garland/js_menu1/jquery.cookie.js" type="text/javascript"></script>
 <script src="<?=$base_url?>/themes/garland/js_menu1/menu.js" type="text/javascript"></script>	
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<!--[if lt IE 8]>
   <style type="text/css">
   li a {display:inline-block;}
   li a {display:block;}
   </style>
   <![endif]--> 
<?php
if(arg(2)== "") {


if(arg(1) == "past_projects") { 
$past_projects=db_query("select * from cfh_property where property_type='12' order by category,title");
$cnt_past_projects=db_result(db_query("select count(*) from cfh_property where property_type='12' order by category,title"));
$divide=$cnt_past_projects/3;
if($divide<7) {
$cut=6;
}
else {
 $cut=round($divide);

}
//print $cut;
$cnt=1;
?>
  <div id="middle_container" >
    <div class="middle_container_inner">
      <!-- BEGIN : left side content-->
      <div id="left_container">
        <div class="left_container_sml">
			<div class="topshadow_effect"></div>
			<div class="sidelink">
			<!--<p>Past Projects</p>-->

			<?php $facebook_link=db_result(db_query("select link from cfh_facebook")); ?>        
				<input type="button" class="facebook" onClick="window.open('<?=$facebook_link?>','_blank');" />
			</div>
			<div class="clear"></div>
		</div>
      </div>
      <!-- end : left side content-->
      <!-- BEGIN : right side content-->
      <div id="right_container_auto">
        <!-- separate styles used for this page -->
        <div class="pastproject_banner">
          <div class="topshadow_effect"></div>
          <h2 class="blue_hdr"> Past Projects</h2>
        </div>
        <div class="content_text">
          	<div class="past_details">
                
               <?php 
			   while($row=db_fetch_object($past_projects)) {
			    if(($cnt == 1)) {
				?>
                <div class="list_box1">
                <?php
				}
				if(($cnt_past_projects%3 == 1) || ($cnt_past_projects%3 == 2)) {
				if(($cnt ==($cut+1))) {
				?>
                </div>
                 <div class="list_box1 middle_top">
                 
                <?php
				}
				}
				else {
				if(($cnt ==($cut+1))) {
				?>
                </div>
                <div class="list_box1 middle_top">
                 
                <?php
				}
				}
				if(($cnt_past_projects%3 == 2)) {
				if(($cnt ==($cut+$cut+2))) {
				?>
                </div>
                 <div class="list_box2">
                 
               <?php 
				}
				}
				else {
				if(($cnt ==($cut+$cut+1))) {
				?>
                </div>
                 <div class="list_box2">
                 
               <?php 
				}
				}
				
			      if($row->category != $last) {
				   $cat_name=db_result(db_query("select name from term_data where tid=".$row->category));
			   
			   ?>
				<h3><?=$cat_name?></h3>
                <?php } ?>
                <p>
                    	<span><?=$row->sub_cat?></span><br  />
                        <strong><?=nl2br($row->address)?></strong><br  />
                        <strong><?=$row->unit?></strong>
                       
                </p>
               <?php  
			   
			    if(($cnt == $cnt_past_projects)) {
			   ?>
              	
				</div>
               <?php
				}
				     
                
			   $cnt++;
			   $last = $row->category;
			   }
			   ?> 
                
               
             
          	</div>
            <div class="clear"></div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
 
 <?php
 }   
 else {
 ?>
	
 <!-- end : Menu-->
  <!-- BEGIN : Middle container-->
  <div id="middle_container" >

    <div class="middle_container_inner">
      <!-- BEGIN : left side content-->
      <div id="left_container">
        <div class="left_container_sml">
          <div class="topshadow_effect"></div>
          <div class="sidelink">
          <?php if(arg(1)=="commercial") { ?>
          <ul>
          <?php } else { ?>
          <ul class="menu1" id="menu1">
          <?php } ?>
          <?php if(arg(1)=="residential") {
		  $residential=db_query("select * from term_data where vid='2' order by weight");
		  $m=1;
		  while($row=db_fetch_object($residential)) {
		  $category=$row->name;
		  $cnt_sub=db_result(db_query("select count(*) from cfh_property where property_type='1' and category=".$row->tid." order by title"));
		  if($cnt_sub != 0) {
		  if($m != 1) {
		  $m=$m+1;
		  }
		  ?>
           <li><a href="#<?=$category?>" class="m<?=$m?>"><?=$category?></a>
           
          <?php  
		  }
		  $residential_sub=db_query("select * from cfh_property where property_type='1' and category=".$row->tid." order by title");
		 
		  if($cnt_sub != 0) {
		  ?>
            <ul>
          <?php
		  }
		  
		  while($row1=db_fetch_object($residential_sub)) {
		  ?>
          <!-- <li><a class="m<//?=$m=$m+1?>" href="<?//=$base_url?>/view_property/residential/<?//=$row1->pid?>"><?//=stripslashes($row1->sub_cat)?></a></li>-->
          <li><a class="m<?=$m=$m+1?>" href="<?=$base_url?>/view_property/residential/<?=$row1->pid?>"><?=stripslashes($row1->sub_cat)?></a></li>
          <?php
		      
		  }
          if($cnt_sub != 0) {
		  ?>
          </ul>
          </li>
          <?php
		  }
		  }
		  }
		 else if(arg(1)=="commercial") {
		  $m=1;
		  $commercial=db_query("select * from term_data where vid='2'");
		  
		  while($row=db_fetch_object($commercial)) {
		  $category=$row->name;
		  $cnt_sub=db_result(db_query("select count(*) from cfh_property where property_type='2' and category=".$row->tid." order by title"));
		  if($cnt_sub != 0) {
		  if($m != 1) {
		  $m=$m+1;
		  }
		  ?>
          <!-- <li><a href="#" class="m<?//=$m?>"><?//=$category?></a>-->
           <li><a href="#<?=$category?>"><?=$category?></a>
          <?php  
		  
		  }
		  $commercial_sub=db_query("select * from cfh_property where property_type='2' and category=".$row->tid." order by title");
		  
		  	  
		  if($cnt_sub != 0) {
		  ?>
          <ul>
          <?php
		  }
		  
		  while($row1=db_fetch_object($commercial_sub)) {
		  ?>  
          <li><a class="m<?=$m+1?>" href="<?=$base_url?>/view_property/commercial/<?=$row1->pid?>"><?=stripslashes($row1->sub_cat)?></a></li>
              
          <?php 
		  
		  }
          if($cnt_sub != 0) {
		  ?>
          
          </ul>
          </li>
          <?php
		  }
		  }
		  } 
		 ?></ul>
           <?php $facebook_link=db_result(db_query("select link from cfh_facebook")); ?>        
         <input type="button" class="facebook" onClick="window.open('<?=$facebook_link?>','_blank');" />
          </div>
          <div class="clear"></div>
        </div>
      </div>
      <!-- end : left side content-->
      <!-- BEGIN : right side content-->
      <?php  if((arg(1)=="residential") || (arg(1)=="commercial")) {   ?>
      <div id="right_container_auto">
        <!-- separate styles used for this page -->
        <div class="topshadow_effect" id="top"></div>
       <?php  } else {  ?> 
        <div id="right_container_auto">
       <?php } ?>
         <?php if(arg(1)=="residential") { 
		 //$res2=db_query("select * from cfh_property where property_type='1'");
		 $type1="residential";
		 $res="select * from cfh_property as cp join term_data as t on cp.category=t.tid where cp.property_type='1' order by t.weight,cp.title";
         $count_query = "select count(*) from cfh_property as cp join term_data as t on cp.category=t.tid where cp.property_type='1' order by t.weight";
		// $query = pager_query($res, 9, 0, $count_query);
		 $query = db_query($res);
		 ?>
            <h2> Residential Properties</h2>
         <?php } else if(arg(1)=="commercial") { 
		// $res2=db_query("select * from cfh_property where property_type='2'");
		 $res="select * from cfh_property as cp join term_data as t on cp.category=t.tid where cp.property_type='2' order by t.weight,cp.title";
         $count_query = "select count(*) from cfh_property as cp join term_data as t on cp.category=t.tid where cp.property_type='2' order by t.weight";
        // $cnt=db_result(db_query("SELECT count(*) from cfh_property order by pid"));
       //  $query = pager_query($res, 9, 0, $count_query);
         $query = db_query($res);
		 $type1="commercial";
		 ?>   
            <h2> Commercial Properties</h2>
         <?php } 
		 if((arg(1)=="residential") || (arg(1)=="commercial")) { 		 
		 ?>
          <div class="content_text">
         <?php
		 }
		 else {
		 ?>
          <div class="content">
         <?php
		 $cnt=0;
		 $cnt1=1;
		 }
		  while($row_prop=db_fetch_object($query)) {
		  $img_url=db_result(db_query("select image_url from cfh_images where pid='".$row_prop->pid."' and main='1'"));
		  $prop_cnt=db_result(db_query("SELECT count(*) from cfh_property where category='".$row_prop->category."'"));
		  $cat_name=db_result(db_query("select name from term_data where tid='".$row_prop->category."'"));
		   if($cat_name_back != $cat_name) { $cnt1=1;//print $prop_cnt;
		    // if($cnt%3 == 0) {
		          if($cnt==0) {  
		  ?>
             <div style="width: 250px; height: 15px;"><h1 style="color:#868686; font-family:Arial, Helvetica, sans-serif; font-size:19px; font-weight:normal;" id="<?=$cat_name?>"><?=$cat_name?></h1></div><div class="clear"></div><br class='clear'>

          <?php   } 
		          else { 
		  ?>
             <div style="width: 250px; height: 15px;"><h1 style="color:#868686; font-family:Arial, Helvetica, sans-serif; font-size:19px; font-weight:normal;" id="<?=$cat_name?>"><?=$cat_name?></h1></div><div class="clear"></div><br class='clear'>
          <?php   }
		    // }
		   }
		  
		  ?>    
              <div class="img_div" style="overflow:hidden"><div class="img_div_container"><a href="<?=$base_url?>/view_property/<?=$type1?>/<?=$row_prop->pid?>"><img src="<?=$base_url?>/sites/default/files/imgs/normal/<?=$img_url?>" alt="residential" border="0" /> </a></div><br /><a href="<?=$base_url?>/view_property/<?=$type1?>/<?=$row_prop->pid?>">
                <b style="color:#0363A8;"><?=stripslashes($row_prop->sub_cat)?></b><br />
                <?=nl2br(stripslashes($row_prop->address))?> </a></div>
          <?php 
		  if($cnt1==$prop_cnt) {
		  $minus= $prop_cnt%3;
		  if($minus == 2) {
		  ?>
           <div class="img_div" style="overflow:hidden"><div class=""></div><br /></div><br class='clear'><div class="back"><a href="#top">Back To Top</a></div>
          <?php
		  }
		  else if($minus == 1) {
		  ?>
                   <div class="img_div" style="overflow:hidden"><div class=""></div><br /></div>
                   <div class="img_div" style="overflow:hidden"><div class=""></div><br /></div><br class='clear'><div class="back"><a href="#top">Back To Top</a></div>
           <?php
		  }
		  else {
		  ?>
          <br class='clear'><div class="back"><a href="#top">Back To Top</a></div>
          <?php
		  }
		  }
		  
		  $cat_name_back=$cat_name;
		  $cnt=$cnt+1;
		  $cnt1=$cnt1+1;
		  } ?>
          <?php  if((arg(1)!="residential") && (arg(1) !="commercial")) { 	?>      
          <div class="projectpro_banner">
          <div class="topshadow_effect">&nbsp;</div>
          <h2 class="blue_hdr"><a name="top"></a></h2>
          </div>
          <div class="quick_links">
          <input type="button" onclick="location.href='view_property/past_projects'" class="pastproject_new" name="Past Projects">
          <input type="button" onclick="location.href='view_property/commercial'" class="commerical_new" name="commercial">
          <input type="button" onclick="location.href='view_property/residential'" class="residential_new" name="residential">
          </div>     
           <?php } ?>     
           </div>
           <div class="clear"></div>
           <?php 
		//  $output =theme('pager', NULL, 9, 0);
        //  print $output;?>
         
          </div>

      <div class="clear"></div>
    </div><div class="clear"></div>
  </div>
 <?php
  }
  }
 else if(arg(3) == "map") {
 ?>
  
  <!-- end : Menu-->  <!-- BEGIN : Middle container-->
  <div id="middle_container" >
    <div class="middle_container_inner">
      <!-- BEGIN : left side content-->
      <div id="left_container">
        <div id="left_container2">
          <div class="left_container_sml">
            <div class="topshadow_effect"></div>
            <div class="sidelink">
          <?php if(arg(1)=="commercial") { ?>
          <ul>
          <?php } else { ?>
          <ul class="menu1" id="menu1">
          <?php } ?>
          <?php if(arg(1)=="residential") {
		  $residential=db_query("select * from term_data where vid='2' order by weight");
		  $m=1;
		  while($row=db_fetch_object($residential)) {
		  $category=$row->name;
		  $cnt_sub=db_result(db_query("select count(*) from cfh_property where property_type='1' and category=".$row->tid." order by title"));
		  if($cnt_sub != 0) {
		  if($m != 1) {
		  $m=$m+1;
		  }
		  ?>
           <li><a href="#<?=$category?>" class="m<?=$m?>"><?=$category?></a>
           
          <?php  
		  }
		  $residential_sub=db_query("select * from cfh_property where property_type='1' and category=".$row->tid." order by title");
		 
		  if($cnt_sub != 0) {
		  ?>
            <ul>
          <?php
		  }
		  
		  while($row1=db_fetch_object($residential_sub)) {
		  ?>
           <li><a class="m<?=$m=$m+1?>" href="<?=$base_url?>/view_property/residential/<?=$row1->pid?>"><?=stripslashes($row1->sub_cat)?></a></li>
          <?php
		      
		  }
          if($cnt_sub != 0) {
		  ?>
          </ul>
          </li>
          <?php
		  }
		  }
		  }
		 else if(arg(1)=="commercial") {
		  $m=1;
		  $commercial=db_query("select * from term_data where vid='2'");
		  
		  while($row=db_fetch_object($commercial)) {
		  $category=$row->name;
		  $cnt_sub=db_result(db_query("select count(*) from cfh_property where property_type='2' and category=".$row->tid." order by title"));
		  if($cnt_sub != 0) {
		  if($m != 1) {
		  $m=$m+1;
		  }
		  ?>
           <li><a href="#<?=$category?>" class="m<?=$m?>"><?=$category?></a>
          <?php  
		  
		  }
		  $commercial_sub=db_query("select * from cfh_property where property_type='2' and category=".$row->tid." order by title");
		  
		  	  
		  if($cnt_sub != 0) {
		  ?>
          <ul>
          <?php
		  }
		  
		  while($row1=db_fetch_object($commercial_sub)) {
		  ?>  
          <li><a class="m<?=$m+1?>" href="<?=$base_url?>/view_property/commercial/<?=$row1->pid?>"><?=stripslashes($row1->sub_cat)?></a></li>
              
          <?php 
		  
		  }
          if($cnt_sub != 0) {
		  ?>
          
          </ul>
          </li>
          <?php
		  }
		  }
		  } 
		 ?></ul>
               <?php $facebook_link=db_result(db_query("select link from cfh_facebook")); ?>        
         <input type="button" class="facebook" onClick="window.open('<?=$facebook_link?>','_blank');" />
            </div>
            <div class="clear"></div>
          </div>
        </div>
      </div>
      <!-- end : left side content-->
      <!-- BEGIN : right side content-->
      <div id="right_container">
        <!-- separate styles used for this page -->
        <div class="topshadow_effect"></div>
        <?php 
		$title=db_result(db_query("select sub_cat from cfh_property where pid=".arg(2)));
		$to_zip=db_result(db_query("select zip from cfh_property where pid=".arg(2)));
		$to=db_result(db_query("select address from cfh_property where pid=".arg(2)));
		$address=db_result(db_query("select address from cfh_property where pid=".arg(2)));
		if(isset($_POST['from'])) {
		$from = $_POST['from'];
		}
		 $address1 = str_replace(" ","%20",$address);
		 $address2 = (string)$address1;
		/*$add_array=explode(' ',$address);
		

		 $address1= implode(' ',$add_array);
		 $address1 = str_replace(",","",$address1);
		 $address1 = str_replace(" ","%20",$address1);
		 $address1 = str_replace(".","",$address1);
		 $address2 = (string)$address1;

		 $addr = "daddr=".$address1;
		 */
		//print "http://maps.google.com/maps?f=d&amp;source=s_d&amp;saddr='".$from."'&amp;daddr='".$to." ".$address."'&amp;hl=en&amp;output=embed";
		  
		  
		  
		 if(empty($from)):
		 $var = "&q=".$address;
		  else:		  
		 $var = "&saddr=".$from."&daddr=".$to_zip."+".address;
		  endif; 
		  
		 ?>
         <h2><?=$title?><a href="<?=$base_url?>/<?=arg(0)?>/<?=arg(1)?>/<?=arg(2)?>" class="back_button" >Back</a></h2>
        
            <div class="content_text">
            <div class="map">
          <div id="map_canvas" style="width: 650px; height: 500px"></div> 
		<!-- <iframe width="581" height="578" align="middle" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=d&source=s_d<?//=$var?>&hl=en&output=embed"></iframe> -->
		
          
            <p><br />
            </p>
            </div>
          	<div class="clear"></div>
           	<div class="map_detils"> 
            <h3>Driving Directions </h3>
            
           <!--  <form action="#" onsubmit="showAddress(this.address.value,''); return false"> 
             <p> 
            <input type="text" size="60" name="address" value="1600 Amphitheatre Pky, Mountain View, CA" /> 
            <input type="submit" value="Go!" /> 
            </p> 
           
           </form> -->
           
            <body onUnload="GUnload()">  
             <form name="form2" action="#" onSubmit="showAddress(this.address.value,this.from.value); return false">
            <div>to <input id="to" name="address" type="text" value="<?=$address?>" disabled="disabled" class="field_class" onBlur="if(!/\S/.test(this.value))this.value=this.defaultValue" onFocus="this.value='';" /> From
              <input name="from" id="from" type="text" class="field_class" value="<?=$from?>" />
              <input name="route" id="route" type="hidden" class="field_class" value="" />
              <input type="submit" name="button" id="button" value="Get Direction" class="getdirection" />
              <input type="reset" name="button2" id="button2" value="Clear" class="clear_btn" />
              </form>
            </body> 
            </div>
            </div>
            </div> <div class="clear"></div>
          </div>

      <div class="clear"></div>
    </div><div class="clear"></div>
  </div>
   <script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAAGARPqavBnvD0dzcoh50EQxS0nJlEHN5uViEQT0SWEFXFudJywRQXSD30RhocxNdTyfgORpQrIpE4xA" type="text/javascript"></script> 
    <script type="text/javascript"> 
 
    var map = null;
    var geocoder = null;
    var directionsPanel;
    var directions;
    function initialize() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("map_canvas"));
        map.setCenter(new GLatLng(37.4419, -122.1419), 13);
        geocoder = new GClientGeocoder();
		
       }
    }
 
    function showAddress(address,from) {
	////if(from != "") {
	
	//}
	if(from == "") { 
      if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
              map.setCenter(point, 13);
              var marker = new GMarker(point);
              map.addOverlay(marker);
              marker.openInfoWindowHtml(address);
			  
            }
          }
        );
      }
	  }
	  else {
	  var to = "from: " +from+ " to: " +address;
	  if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert(address + " not found");
            } else {
             // map.setCenter(point, 13);
             // var marker = new GMarker(point);
             // map.addOverlay(marker);
              //marker.openInfoWindowHtml(address);
			  directionsPanel = document.getElementById("route");
			  directions = new GDirections(map, directionsPanel);
			 // alert(address);alert(from);
              directions.load(to);
            }
          }
        );
      }
	  
	  
	  }
	  
    }
	
   function init() {
          //load();
          initialize();
          showAddress(document.form2.address.value,'');
     }
    window.onload = init; 
     
    
 </script> 
<?php 
 }
 else if(arg(3) == "emailing") {
 
if(isset($_POST['send'])) {
$email_array=explode(',',$_POST['email']);
//print_r($_POST);
for($i=0;$i<count($email_array);$i++) {
$emailing=$base_url."/".arg(0)."/".arg(1)."/".arg(2);
$to = $email_array[$i];
$from= $_POST['email'];
$name= $_POST['name'];
$subject= $_POST['subject'];
$message1=$_POST['message'];
//print_r($_POST);

$message = '<table width="608" cellspacing="0" cellpadding="0" border="0" align="center" style="background-color: rgb(255, 255, 255);">
  <tbody><tr>
    <td valign="top" align="left" style="background-color: rgb(208, 229, 242); font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px;">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" align="left"><img height="110" width="608" border="0" usemap="#Map" alt="top" src="http://cfhgroup.com/sites/all/themes/CFH_theme/images/top.jpg"></td>
  </tr>
  <tr>
    <td valign="top" align="left" style="padding: 20px;"><table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tbody><tr>
        <td valign="top" align="left" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(3, 99, 168); padding-bottom: 20px; line-height: 18px;"><p style="font-family: Tahoma,arial,verdana; font-size: 13px; font-weight: bold;">Hello Friend,</p>       
          <p style="color: rgb(70, 70, 70);"<br />'.$message1.'
          </p>
		  <p>Property Link:<a href="'.$emailing.'">Click on the link</a></p>
          <p style="font-family: Tahoma,arial,verdana; font-size: 11px;">Thanks,<br>
            <strong>CFH</strong></p></td>
      </tr>
      <tr>
        <td valign="top" align="left" style="border-top: 1px solid rgb(216, 220, 224); color: rgb(155, 161, 167); font-size: 10px; font-family: Tahoma,arial,verdana; padding-top: 10px;">If you do not wish to receive further email notifications like this one, please unsubscribe . <br>
          &copy; 2009,cfh<br></td>
      </tr>
    </tbody></table></td>
  </tr>
  <tr>
    <td valign="bottom" align="left"><img height="10" width="608" alt="bottom" src="http://cfhgroup.com/sites/all/themes/CFH_theme/images/bottom.gif"></td>
  </tr>
</tbody></table>';




 
			
$messagefile = <<<EOF
			 
<html>
  <body bgcolor="#DCEEFC">
	<center>
		$message
		</br>
	   
	</center>
	 
  </body>
</html>
EOF;
		
		   //end of message
			$headers  = "From: $from\r\n";
			$headers .= "Content-type: text/html\r\n";
		
			//options to send to cc+bcc
			//$headers .= "Cc: [email]maa@p-i-s.cXom[/email]";
			//$headers .= "Bcc: [email]email@maaking.cXom[/email]";
			
			// now lets send the email.
			mail($to, $subject, $messagefile, $headers);
			$sent = "Thank you for refering property.";
			
    }
	}
 
 
 $attention11 = db_query("select * from term_data where vid='3'");
 $properties = db_query("select * from cfh_property");

?>
 






  <!-- end : Menu-->
  <!-- BEGIN : Middle container-->
  <div id="middle_container" >
    <div class="middle_container_inner">
      <!-- BEGIN : left side content-->
      <div id="left_container">
        <div class="left_container_sml">
          <div class="topshadow_effect"></div>
          <div class="sidelink">
          <?php if(arg(1)=="commercial") { ?>
          <ul>
          <?php } else { ?>
          <ul class="menu1" id="menu1">
          <?php } ?>
          <?php if(arg(1)=="residential") {
		  $residential=db_query("select * from term_data where vid='2' order by weight");
		  $m=1;
		  while($row=db_fetch_object($residential)) {
		  $category=$row->name;
		  $cnt_sub=db_result(db_query("select count(*) from cfh_property where property_type='1' and category=".$row->tid." order by title"));
		  if($cnt_sub != 0) {
		  if($m != 1) {
		  $m=$m+1;
		  }
		  ?>
           <li><a href="#<?=$category?>" class="m<?=$m?>"><?=$category?></a>
           
          <?php  
		  }
		  $residential_sub=db_query("select * from cfh_property where property_type='1' and category=".$row->tid." order by title");
		 
		  if($cnt_sub != 0) {
		  ?>
            <ul>
          <?php
		  }
		  
		  while($row1=db_fetch_object($residential_sub)) {
		  ?>
           <li><a class="m<?=$m=$m+1?>" href="<?=$base_url?>/view_property/residential/<?=$row1->pid?>"><?=stripslashes($row1->sub_cat)?></a></li>
          <?php
		      
		  }
          if($cnt_sub != 0) {
		  ?>
          </ul>
          </li>
          <?php
		  }
		  }
		  }
		 else if(arg(1)=="commercial") {
		  $m=1;
		  $commercial=db_query("select * from term_data where vid='2'");
		  
		  while($row=db_fetch_object($commercial)) {
		  $category=$row->name;
		  $cnt_sub=db_result(db_query("select count(*) from cfh_property where property_type='2' and category=".$row->tid." order by title"));
		  if($cnt_sub != 0) {
		  if($m != 1) {
		  $m=$m+1;
		  }
		  ?>
           <li><a href="#<?=$category?>" class="m<?=$m?>"><?=$category?></a>
          <?php  
		  
		  }
		  $commercial_sub=db_query("select * from cfh_property where property_type='2' and category=".$row->tid." order by title");
		  
		  	  
		  if($cnt_sub != 0) {
		  ?>
          <ul>
          <?php
		  }
		  
		  while($row1=db_fetch_object($commercial_sub)) {
		  ?>  
          <li><a class="m<?=$m+1?>" href="<?=$base_url?>/view_property/commercial/<?=$row1->pid?>"><?=stripslashes($row1->sub_cat)?></a></li>
              
          <?php 
		  
		  }
          if($cnt_sub != 0) {
		  ?>
          
          </ul>
          </li>
          <?php
		  }
		  }
		  } 
		 ?></ul>
            <?php $facebook_link=db_result(db_query("select link from cfh_facebook")); ?>        
         <input type="button" class="facebook" onClick="window.open('<?=$facebook_link?>','_blank');" />
          </div>
          <div class="clear"></div>
        </div>
      </div>
      <!-- end : left side content-->
      
 <link rel="stylesheet" href="<?=$base_url?>/sites/all/modules/view_property/css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<script src="<?=$base_url?>/sites/all/modules/view_property/js/jquery.validationEngine-en.js" type="text/javascript"></script>
		<script src="<?=$base_url?>/sites/all/modules/view_property/js/jquery.validationEngine.js" type="text/javascript"></script>

		<script>	
		$(document).ready(function() {
			// SUCCESS AJAX CALL, replace "success: false," by:     success : function() { callSuccessFunction() }, 
			
			$("#service").validationEngine()
			
			
			//$.validationEngine.loadValidation("#date")
			//alert($("#formID").validationEngine({returnIsValid:true}))
			//$.validationEngine.buildPrompt("#date","This is an example","error")	 		 // Exterior prompt build example								 // input prompt close example
			//$.validationEngine.closePrompt(".formError",true) 							// CLOSE ALL OPEN PROMPTS
		});
		
		// JUST AN EXAMPLE OF VALIDATIN CUSTOM FUNCTIONS : funcCall[validate2fields]
		function validate2fields(){
			if($("#firstname").val() =="" || $("#lastname").val() == ""){
				return true;
			}else{
				return false;
			}
		}
	</script>     
      <!-- BEGIN : right side content-->
      <div id="right_container">
        <!-- separate styles used for this page -->
        <div class="topshadow_effect"></div>
        <h2 align="center" style="font-size:15px;"><?=$sent?></h2>
        <h2> Email this listing <a style="float:right" href="<?=$base_url?>/<?=arg(0)?>/<?=arg(1)?>/<?=arg(2)?>" class="back_button">Back</a></h2>
        <div class="content_text">
          <div class="lable">Website:</div>
          <form method="post" name="service" id="service" class="formular" action="">
          <input type="text" class="validate[length[0,100]] contact_input" value="<?=$base_url?>/<?=arg(0)?>/<?=arg(1)?>/<?=arg(2)?>" name="url"  id="url" disabled="disabled" />
            
          <br class="clear"/>
          <div class="lable">Reciepient's Email:</div>
          <input type="text" class="validate[required,custom[email]] contact_input"  name="email"  id="email" />         
          <!-- p style="margin:0px 0px 0px 120px; padding:0px;">(Please add coma "," seperated email address)</p -->
          <br class="clear"/>
          <div class="lable">Subject:</div>
          <input type="text" class="validate[required,custom[onlyLetter],length[0,100]] contact_input" name="subject"  id="subject" />
          <br class="clear"/>
          
         
          <br class="clear"/>
          <div class="lable">Message:</div>
          <textarea cols="5" rows="5" class="contact_textarea" name="message"  id="message"></textarea>
          <br />
          <div class="btn_div" align="center">
            <input type="reset" class="reset_btn" name="reset" value="" />
            <input type="submit" class="send_btn" name="send" value=""  />
            </form>
          </div>
          <div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>







 
 
<?php 
 
 
 
 
 }
 else if(arg(3) == "service_request.html") { 
if(isset($_POST['send'])) {
//print_r($_POST);
$emailing=$base_url."/".arg(0)."/".arg(1)."/".arg(2);
//if(arg(1) == "commercial") {
$to = db_result(db_query("select service_request_email from cfh_property where pid=".$_POST['attention']));
//}
//else {
//$to = db_result(db_query("select email from cfh_property where pid=".$_POST['attention']));
//}

//variable_get('site_mail'); 
//if($to == "") {
$cc = variable_get('site_mail'); 
//}
$from= $_POST['email'];
$name= $_POST['name'];
$subject= $_POST['subject'];
$attention1 = db_result(db_query("select title from cfh_property where pid=".$_POST['attention']));
$apt_no=$_POST['apt_no'];
$phone=$_POST['phone'];
$message1=$_POST['message'];
//print_r($_POST);

$message = '<table width="608" cellspacing="0" cellpadding="0" border="0" align="center" style="background-color: rgb(255, 255, 255);">
  <tbody><tr>
    <td valign="top" align="left" style="background-color: rgb(208, 229, 242); font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px;">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" align="left"><img height="110" width="608" border="0" usemap="#Map" alt="top" src="http://cfhgroup.com/sites/all/themes/CFH_theme/images/top.jpg"></td>
  </tr>
  <tr>
    <td valign="top" align="left" style="padding: 20px;"><table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tbody><tr>
        <td valign="top" align="left" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(3, 99, 168); padding-bottom: 20px; line-height: 18px;"><p style="font-family: Tahoma,arial,verdana; font-size: 13px; font-weight: bold;">Hello,</p>       
          <p style="color: rgb(70, 70, 70);"><br />Property: '.$attention1.'<br />Apt No: '.$apt_no.'<br />Phone: '.$phone.'<br /><br />'.$message1.'
          </p>
		  <p>Property Link:<a href="'.$emailing.'">Click on the link</a></p>
          <p style="font-family: Tahoma,arial,verdana; font-size: 11px;">Thanks,<br>
            <strong>'.$name.'</strong></p></td>
      </tr>
      <tr>
        <td valign="top" align="left" style="border-top: 1px solid rgb(216, 220, 224); color: rgb(155, 161, 167); font-size: 10px; font-family: Tahoma,arial,verdana; padding-top: 10px;">If you do not wish to receive further email notifications like this one, please unsubscribe . <br>
          &copy; 2009,cfh<br></td>
      </tr>
    </tbody></table></td>
  </tr>
  <tr>
    <td valign="bottom" align="left"><img height="10" width="608" alt="bottom" src="http://cfhgroup.com/sites/all/themes/CFH_theme/images/bottom.gif"></td>
  </tr>
</tbody></table>';




 
			
$messagefile = <<<EOF
			 
<html>
  <body bgcolor="#DCEEFC">
	<center>
		$message
		</br>
	   
	</center>
	 
  </body>
</html>
EOF;
		
		   //end of message
			$headers  = "From: $from\r\n";
			$headers .= "Cc: $cc\r\n";
			$headers .= "Content-type: text/html\r\n";
		
			//options to send to cc+bcc
			//$headers .= "Cc: [email]maa@p-i-s.cXom[/email]";
			//$headers .= "Bcc: [email]email@maaking.cXom[/email]";
			
			// now lets send the email.
			mail($to, $subject, $messagefile, $headers);
			$sent = "Thank you for submitting a service request, we will reply within 1 business day during our regular office hours. However if this is a maintenance emergency please call the leasing office so it can be addressed right away. If this an emergency of any other nature, please dial 911.";
			
    }
 
 
 $attention11 = db_query("select * from term_data where vid='3'");
 if(arg(1) == "commercial") {
 $properties = db_query("select * from cfh_property where property_type='2'");
 }
 else {
 $properties = db_query("select * from cfh_property where property_type='1'");
 }

?>
 






  <!-- end : Menu-->
  <!-- BEGIN : Middle container-->
  <div id="middle_container" >
    <div class="middle_container_inner">
      <!-- BEGIN : left side content-->
      <div id="left_container">
        <div class="left_container_sml">
          <div class="topshadow_effect"></div>
          <div class="sidelink">
          <?php if(arg(1)=="commercial") { ?>
          <ul>
          <?php } else { ?>
          <ul class="menu1" id="menu1">
          <?php } ?>
          <?php if(arg(1)=="residential") {
		  $residential=db_query("select * from term_data where vid='2' order by weight");
		  $m=1;
		  while($row=db_fetch_object($residential)) {
		  $category=$row->name;
		  $cnt_sub=db_result(db_query("select count(*) from cfh_property where property_type='1' and category=".$row->tid." order by title"));
		  if($cnt_sub != 0) {
		  if($m != 1) {
		  $m=$m+1;
		  }
		  ?>
           <li><a href="#<?=$category?>" class="m<?=$m?>"><?=$category?></a>
           
          <?php  
		  }
		  $residential_sub=db_query("select * from cfh_property where property_type='1' and category=".$row->tid." order by title");
		 
		  if($cnt_sub != 0) {
		  ?>
            <ul>
          <?php
		  }
		  
		  while($row1=db_fetch_object($residential_sub)) {
		  ?>
           <li><a class="m<?=$m=$m+1?>" href="<?=$base_url?>/view_property/residential/<?=$row1->pid?>"><?=stripslashes($row1->sub_cat)?></a></li>
          <?php
		      
		  }
          if($cnt_sub != 0) {
		  ?>
          </ul>
          </li>
          <?php
		  }
		  }
		  }
		 else if(arg(1)=="commercial") {
		  $m=1;
		  $commercial=db_query("select * from term_data where vid='2'");
		  
		  while($row=db_fetch_object($commercial)) {
		  $category=$row->name;
		  $cnt_sub=db_result(db_query("select count(*) from cfh_property where property_type='2' and category=".$row->tid." order by title"));
		  if($cnt_sub != 0) {
		  if($m != 1) {
		  $m=$m+1;
		  }
		  ?>
           <li><a href="#<?=$category?>" class="m<?=$m?>"><?=$category?></a>
          <?php  
		  
		  }
		  $commercial_sub=db_query("select * from cfh_property where property_type='2' and category=".$row->tid." order by title");
		  
		  	  
		  if($cnt_sub != 0) {
		  ?>
          <ul>
          <?php
		  }
		  
		  while($row1=db_fetch_object($commercial_sub)) {
		  ?>  
          <li><a class="m<?=$m+1?>" href="<?=$base_url?>/view_property/commercial/<?=$row1->pid?>"><?=stripslashes($row1->sub_cat)?></a></li>
              
          <?php 
		  
		  }
          if($cnt_sub != 0) {
		  ?>
          
          </ul>
          </li>
          <?php
		  }
		  }
		  } 
		 ?></ul>
            <?php $facebook_link=db_result(db_query("select link from cfh_facebook")); ?>        
         <input type="button" class="facebook" onClick="window.open('<?=$facebook_link?>','_blank');" />
          </div>
          <div class="clear"></div>
        </div>
      </div>
      <!-- end : left side content-->
      
 <link rel="stylesheet" href="<?=$base_url?>/sites/all/modules/view_property/css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<script src="<?=$base_url?>/sites/all/modules/view_property/js/jquery.validationEngine-en.js" type="text/javascript"></script>
		<script src="<?=$base_url?>/sites/all/modules/view_property/js/jquery.validationEngine.js" type="text/javascript"></script>

		<script>	
		$(document).ready(function() {
			// SUCCESS AJAX CALL, replace "success: false," by:     success : function() { callSuccessFunction() }, 
			
			$("#service").validationEngine()
			
			
			//$.validationEngine.loadValidation("#date")
			//alert($("#formID").validationEngine({returnIsValid:true}))
			//$.validationEngine.buildPrompt("#date","This is an example","error")	 		 // Exterior prompt build example								 // input prompt close example
			//$.validationEngine.closePrompt(".formError",true) 							// CLOSE ALL OPEN PROMPTS
		});
		
		// JUST AN EXAMPLE OF VALIDATIN CUSTOM FUNCTIONS : funcCall[validate2fields]
		function validate2fields(){
			if($("#firstname").val() =="" || $("#lastname").val() == ""){
				return true;
			}else{
				return false;
			}
		}
	</script>     
      <!-- BEGIN : right side content-->
      <div id="right_container">
        <!-- separate styles used for this page -->
        <div class="topshadow_effect"></div>
        <h2 align="center" style="font-size:15px;"><?=$sent?></h2>
        <h2> Service Request <a style="float:right" href="<?=$base_url?>/<?=arg(0)?>/<?=arg(1)?>/<?=arg(2)?>" class="back_button">Back</a></h2>
        <div class="content_text">
          <div class="lable">Name:</div>
          <form method="post" name="service" id="service" class="formular" action="">
            <input type="text" class="validate[required,custom[onlyLetter],length[0,100]] contact_input_mid" name="name"  id="name" />
          <div class="lable_auto">Phone:</div> 
            <input type="text" class="validate[required,custom[telephone]] contact_input_sml"  name="phone"  id="phone" />
        
          <br class="clear"/>
          <div class="lable">Email address:</div>
          <input type="text" class="validate[required,custom[email]] contact_input"  name="email"  id="email" />
          <br class="clear"/>
          <div class="lable">Subject:</div>
        <!--  <input type="text" class="validate[required,custom[onlyLetter],length[0,100]] contact_input" name="subject"  id="subject" />-->
         <input type="text" class="validate[required,length[0,100]] contact_input" name="subject"  id="subject" />
          <br class="clear"/>
          <div class="lable">Property:</div>
          <div class="contact_input_mid_div">
            <select class="validate[required] contact_select" name="attention"  id="attention">
              <option value="">--select--</option>
                <?php while($row=db_fetch_object($properties)) { ?>
                <option value="<?=$row->pid?>" <?php if($row->pid == arg(2)) { ?> selected="selected" <?php } ?>><?=$row->title?></option>
                <?php } ?>
            </select>
          </div>
         <div style="float:left; padding-top:8px"> <div class="lable_auto">Apt. No.:</div>
            <input type="text" class="validate[required] contact_input_sml" name="apt_no"  id="apt_no" /></div>
          <br class="clear"/>
          <div class="lable">Message:</div>
          <textarea cols="5" rows="5" class="validate[required,length[6,300]] contact_textarea" name="message"  id="message"></textarea>
          <br />
          <div class="btn_div" align="center">
            <input type="reset" class="reset_btn" name="reset" value="" />
            <input type="submit" class="send_btn" name="send" value=""  />
            </form>
          </div>
          <div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>







 
 
<?php 
 }
 else if((arg(1) == "commercial") || (arg(1) == "residential")) {
if(arg(3) == "download") {
$brochure_url=$base_url."/sites/default/files/brochure/".arg(4);
$filename = $brochure_url;

$path = $_SERVER['DOCUMENT_ROOT']."/"; // change the path to fit your websites document structure
$fullPath = $path."/sites/default/files/brochure/".arg(4);
 
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
 
 if(isset($_POST['send'])) {
 $emailing=$base_url."/".arg(0)."/".arg(1)."/".arg(2);
for($i=1;$i<=5;$i++) {
    
	 $from=$_POST['from12'];
	 $to=$_POST['email'.$i];
	 $cc=variable_get('site_mail'); 
	 $message1=$_POST['comment1'];
	 $subject="Email this listing";
	if($to != "") {
	// print $to;
	$message = '<table width="608" cellspacing="0" cellpadding="0" border="0" align="center" style="background-color: rgb(255, 255, 255);">
  <tbody><tr>
    <td valign="top" align="left" style="background-color: rgb(208, 229, 242); font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px;">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" align="left"><img height="110" width="608" border="0" usemap="#Map" alt="top" src="http://cfhgroup.com/sites/all/themes/CFH_theme/images/top.jpg"></td>
  </tr>
  <tr>
    <td valign="top" align="left" style="padding: 20px;"><table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tbody><tr>
        <td valign="top" align="left" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(3, 99, 168); padding-bottom: 20px; line-height: 18px;"><p style="font-family: Tahoma,arial,verdana; font-size: 13px; font-weight: bold;">Hello Friend</p>       
          <p style="color: rgb(70, 70, 70);">'.$message1.'
          </p>
		  <p><a href='.$emailing.'/>Click on this link</a>
          <p style="font-family: Tahoma,arial,verdana; font-size: 11px;">Thanks,<br>
            <strong>CFH</strong></p></td>
      </tr>
      <tr>
        <td valign="top" align="left" style="border-top: 1px solid rgb(216, 220, 224); color: rgb(155, 161, 167); font-size: 10px; font-family: Tahoma,arial,verdana; padding-top: 10px;">If you do not wish to receive further email notifications like this one, please unsubscribe . <br>
          &copy; 2009,cfh<br></td>
      </tr>
    </tbody></table></td>
  </tr>
  <tr>
    <td valign="bottom" align="left"><img height="10" width="608" alt="bottom" src="http://cfhgroup.com/sites/all/themes/CFH_theme/images/bottom.gif"></td>
  </tr>
</tbody></table>';

	
	
	
	
	
	 
	 $messagefile = <<<EOF
     
<html>
  <body bgcolor="#DCEEFC">
    <center>
		$message
		</br>
       
    </center>
     
  </body>
</html>

EOF;

   //end of message
    $headers  = "From: $from\r\n";
    $headers .= "Content-type: text/html\r\n";

    //options to send to cc+bcc
    $headers .= "Cc: [email]".$cc."[/email]";
    //$headers .= "Bcc: [email]email@maaking.cXom[/email]";
    
    // now lets send the email.
    mail($to, $subject, $messagefile, $headers);
	
    $sent = "Sent successfully";
   
	 
	 }
	 
}

 
 
 
 }
 
 ?>
<link rel="stylesheet" type="text/css" href="<?=$base_url?>/sites/all/modules/view_property/popup.css" />
<script src="<?=$base_url?>/sites/all/modules/view_property/js1/rotate.js" type="text/javascript"></script>

<!--<script src="<?=$base_url?>/sites/all/modules/view_property/js1/query-1.2.1.pack.js" type="text/javascript"></script>-->
<script src="<?=$base_url?>/sites/all/modules/view_property/js1/jquery-easing.1.2.pack.js" type="text/javascript"></script>
<script src="<?=$base_url?>/sites/all/modules/view_property/js1/jquery-easing-compatibility.1.2.pack.js" type="text/javascript"></script>
<script src="<?=$base_url?>/sites/all/modules/view_property/js1/coda-slider.1.1.1.pack.js" type="text/javascript"></script>
<script src="<?=$base_url?>/sites/all/modules/view_property/popup.js" type="text/javascript"></script>

<!-- Initialize each slider on the page. Each slider must have a unique id -->
<script type="text/javascript">
		jQuery(window).bind("load", function() {
			//jQuery("div#slider1").codaSlider()
			// jQuery("div#slider2").codaSlider()
			// etc, etc. Beware of cross-linking difficulties if using multiple sliders on one page.
		});
		
		
    $(document).ready(function(){
    	 //$j('.flexslider').flexslider();
 // add a "rel" attrib if Opera 7+
 if(window.opera) {
  if ($("a.save_list").attr("rel") != ""){ // don't overwrite the rel attrib if already set
   $("a.save_list").attr("rel","sidebar");
  }
 }

 $("a.save_list").click(function(event){
  event.preventDefault(); // prevent the anchor tag from sending the user off to the link
  var url = this.href;
  var title = this.title;

  if (window.sidebar) { // Mozilla Firefox Bookmark
   window.sidebar.addPanel(title, url,"");
  } else if( window.external ) { // IE Favorite
   window.external.AddFavorite( url, title);
  } else if(window.opera) { // Opera 7+
   return false; // do nothing - the rel="sidebar" should do the trick
  } else { // for Safari, Konq etc - browsers who do not support bookmarking scripts (that i could find anyway)
    alert('Unfortunately, this browser does not support the requested action,'
    + ' please bookmark this page manually.');
  }

 });
});

function exportmasterfile(url){   
  //  var url='../documenten/Master-File.xls';    
    window.open(url,'Download');  
}

		
		
</script>
<div id="popupContact"></div>
<div id="backgroundPopup"></div>
  <!-- end : Menu-->
  <!-- BEGIN : Middle container-->
  <div id="middle_container" >
    <div class="middle_container_inner">
      <!-- BEGIN : left side content-->
      <div id="left_container">
        <div class="left_container_sml">
          <div class="topshadow_effect"></div>
          <div class="sidelink">
          <?php if(arg(1)=="commercial") { ?>
          <ul>
          <?php } else { ?>
          <ul class="menu1" id="menu1">
          <?php } ?>
          <?php if(arg(1)=="residential") {
		  $residential=db_query("select * from term_data where vid='2' order by weight");
		  $m=1;
		  while($row=db_fetch_object($residential)) {
		  $category=$row->name;
		  $cnt_sub=db_result(db_query("select count(*) from cfh_property where property_type='1' and category=".$row->tid." order by title"));
		  if($cnt_sub != 0) {
		  if($m != 1) {
		  $m=$m+1;
		  }
		  ?>
           <li><a href="#<?=$category?>" class="m<?=$m?>"><?=$category?></a>
           
          <?php  
		  }
		  $residential_sub=db_query("select * from cfh_property where property_type='1' and category=".$row->tid." order by title");
		 
		  if($cnt_sub != 0) {
		  ?>
            <ul>
          <?php
		  }
		  
		  while($row1=db_fetch_object($residential_sub)) {
		  ?>
           <li><a class="m<?=$m=$m+1?>" href="<?=$base_url?>/view_property/residential/<?=$row1->pid?>"><?=stripslashes($row1->sub_cat)?></a></li>
          <?php
		      
		  }
          if($cnt_sub != 0) {
		  ?>
          </ul>
          </li>
          <?php
		  }
		  }
		  }
		 else if(arg(1)=="commercial") {
		  $m=1;
		  $commercial=db_query("select * from term_data where vid='2'");
		  
		  while($row=db_fetch_object($commercial)) {
		  $category=$row->name;
		  $cnt_sub=db_result(db_query("select count(*) from cfh_property where property_type='2' and category=".$row->tid." order by title"));
		  if($cnt_sub != 0) {
		  if($m != 1) {
		  $m=$m+1;
		  }
		  ?>
           <li><a href="#<?=$category?>" class="m<?=$m?>"><?=$category?></a>
          <?php  
		  
		  }
		  $commercial_sub=db_query("select * from cfh_property where property_type='2' and category=".$row->tid." order by title");
		  
		  	  
		  if($cnt_sub != 0) {
		  ?>
          <ul>
          <?php
		  }
		  
		  while($row1=db_fetch_object($commercial_sub)) {
		  ?>  
          <li><a class="m<?=$m+1?>" href="<?=$base_url?>/view_property/commercial/<?=$row1->pid?>"><?=stripslashes($row1->sub_cat)?></a></li>
              
          <?php 
		  
		  }
          if($cnt_sub != 0) {
		  ?>
          
          </ul>
          </li>
          <?php
		  }
		  }
		  } 
		 ?></ul>
             <?php $facebook_link=db_result(db_query("select link from cfh_facebook")); ?>        
         <input type="button" class="facebook" onClick="window.open('<?=$facebook_link?>','_blank');" />
          </div>
          <div class="clear"></div>
        </div>
      </div>
      <!-- end : left side content-->
      <!-- BEGIN : right side content-->
      <div id="right_container_auto">
       <div class="topshadow_effect"></div>
       <?php 
	   $url=db_result(db_query("select logo from cfh_property where pid=".arg(2)));
	   $brochure=db_result(db_query("select brochure from cfh_property where pid=".arg(2)));
	   $brochure_url=$base_url."/sites/default/files/brochure/".$brochure;
	   $logo_url=$base_url."/sites/default/files/imgs/logo/".$url; 
	   list($width, $height, $type, $attr) = getimagesize($logo_url);
	   ?> <h2 align="center" style="font-size:15px;"><?php
       if($sent != "") { print "<script language='javascript'>showpopup('Thanks');</script>"; }
	   ?></h2>
           <?php if(arg(1) != "commercial") { ?>  
           <div class="nobhill_logo" style="background:url('<?=$logo_url?>') center center no-repeat;"></div> <?php } else {
		   $head=db_result(db_query("select title from cfh_property where pid=".arg(2)));
		   $head_desc = db_result(db_query("select header_section from cfh_property where pid=".arg(2)));
		   ?>
        	<div>
				<p style="color:#0363A8;float:left; font-size:22px; margin:20px 37px 15px;"><?=$head?></p>
			</div>
			<?php } ?>
            
			<?php if($brochure != "") { ?>   
				<div class="btn_div"> 
			<?php } else { ?> 
				<div style="padding-right: 45px; margin-top: 30px;"> 
			<?php } ?>
			<?php $map_url=$base_url."/".arg(0)."/".arg(1)."/".arg(2)."/map"; ?>
           	<?php if($brochure != "") {?>
           		<span class="map_btn btn" onClick="window.open('<?=$map_url?>','_self')" >Map & Directions</span>
           	<?php } else { ?>
				<span class="map_btn btn" style="float:right;" onClick="window.open('<?=$map_url?>','_self')" >Map & Directions</span>
			<?php } ?>
			<?php if($brochure != "") { ?>
				<span class="brochure_btn btn" onClick="window.open('<?=$base_url?>/<?=arg(0)?>/<?=arg(1)?>/<?=arg(2)?>/download/<?=$brochure?>','_self')" >Download Brochure</span>
			<?php  } ?>
            </div>
            <div class="clear"></div>
            <!-- BEGIN : rgallery-->
            <div class="residential_content">

              <div style="position:relative;" >
              <?=$head_desc?>
              </div>
                <div class="clear"></div>
                  <div class="slider_wrapper pan3lContainer">
                   	<?php 
				   
					    $pictures=db_query("select ci.image_url from cfh_images as ci where ci.pid=".arg(2)." order by ci.order");
						$cnt_pictures=db_result(db_query("select count(*) from cfh_images where pid=".arg(2))); 
						$tmp_cnt = 1;
						$cnt_imgs = 1;
						$main_img_cnt = 1;
						$thumb_img_cnt = 1;
						$num = 1;
					?>
					<div id="slider" class="gall3ry flexslider">
                    	<ul class="slides">
						<?php 
						// First while loop for main images
						while($row=db_fetch_object($pictures)) {//print $cnt_imgs; ?>      
	                		<li><a class="fancybox" rel="group" href="<?=$base_url?>/sites/default/files/imgs/<?=$row->image_url?>">
	                				<img src="<?=$base_url?>/sites/default/files/imgs/<?=$row->image_url?>"  alt="" /></a></li>

	                 			<?php 
					    } //end of main image while loop ?>
 						</ul>
 					</div>
 					<div id="carousel" class="gall3ry flexslider">
                    	<ul class="slides">
	 					<?php
					 	// Second while loop for thumb images
					 	$pictures=db_query("select ci.image_url from cfh_images as ci where ci.pid=".arg(2)." order by ci.order");
						while($row=db_fetch_object($pictures)) {//print $cnt_imgs; ?>      
	                		<li><img src="<?=$base_url?>/sites/default/files/imgs/thumbs/<?=$row->image_url?>"  alt="" /></li>

	                 			<?php 

					  		//print $tmp_cnt;
						  	$tmp_cnt = $tmp_cnt + 1;					  
							$num = $num + 1;
							//$cnt_imgs =$cnt_imgs+1;
							$thumb_img_cnt++;
					    } //end of thumb image while loop ?>
						</ul>
					</div>
				</div>
                  <!-- .panelContainer -->

               <!-- END: gallery -->
              <?php 
			  $properties=db_query("select * from cfh_property where pid=".arg(2));
			  while($row_properties=db_fetch_object($properties)) {   
			  ?> 
              <div class="clear"></div>
              <div class="detil_warp">
              <div class="sml_div1">
                <strong>
				<?php 
					echo nl2br(stripslashes($row_properties->address))."<br /><br />";
					// for($k=0;$k<=strlen($row_properties->address);$k=$k+20) { 
					// echo stripslashes(substr($row_properties->address, $k, 20))."<br />";
					//  }
				?>
            	<?php if($row_properties->phone!= "") { ?>    
              		<a href="tel:<?=$row_properties->phone?>"><i class="fa fa-phone"></i> <?=$row_properties->phone?></a>
              		<br />
              	<?php } ?>
              	<?php if($row_properties->fax!= "") { ?>    
              		Fax: <?=$row_properties->fax?>
              		<br />
              	<?php } ?>

               	<?php if($row_properties->property_url!= "") { 
					$rest = substr($row_properties->property_url, 0, 4);
					if($rest != "http") { 
						$url = "http://".$row_properties->property_url;
					} else { 
						$url = $row_properties->property_url; } ?>
					<a target="_blank" href="<?=$url?>">
						Our Website
					</a>
					<br />
				<?php } ?>

            	
            		<a href="mailto:<?=$row_properties->email?>">Email Us</a>
            	</strong>
              
              </div>
             
              <div class="sml_div2 ">
              <?php $emailing=$base_url."/".arg(0)."/".arg(1)."/".arg(2); ?>
                <!-- <div class="icon_1">
                	<a href="#" class="save_list" title="<?=$row_properties->title?>" >Save This Listing</a>
            	</div>-->
               	<!-- <div class="icon_4">
               		<a href="#" onclick="showpopup('<//?=$emailing?>');">Email This Listing</a>
               	</div>-->
                <div class="icon_4">
                	<a href="<?=$base_url?>/<?=arg(0)?>/<?=arg(1)?>/<?=arg(2)?>/emailing">Email This Listing</a>
                </div>
                <br class="clear" />
                <div class="icon_2">
                	<a href="#" onClick="PrintContent('print_content')">Print This Listing</a>
                </div>
                <div class="icon_5">
                	<a href="<?=$emailing?>/service_request.html">Service Request</a>
                </div>
                <br class="clear" />
                
                <?php if(arg(1) == "residential") { 
				if($row_properties->facebook != "") {?>
                <div class="icon_3">
                	<a target="_blank" href="<?=$row_properties->facebook?>">Facebook Page</a>
                </div>
                 <?php } } ?>
                
               
				<?php if($row_properties->online != "") { ?>
                <div class="icon_6"> 
                	<a target="" href="<?=$row_properties->online?>">Apply Online</a>
                </div>
                <?php } ?>
                
                </div>
               
              
              <?php
              // pass zip here------------------------------------------------->
             // $xml = simplexml_load_file('http://www.google.com/ig/api?weather='.$row_properties->zip);
             // $information = $xml->xpath("/xml_api_reply/weather/forecast_information");
             // $current = $xml->xpath("/xml_api_reply/weather/current_conditions");
 
              ?>
 

               
                
              
              <?php if($row_properties->zip != 0) { ?>
              <!--<div class="right_btn_div">
                <div class="weather_box">
                <a href="#"><img src="< ?='http://www.google.com'.$current[0]->icon['data']?>" width="24" height="19" alt="weather" /></a>
                <div class="text">< ?=$current[0]->temp_f['data']?>.F <sup>f</sup></div>
                <div class="clear"></div>
                <a href="#">< ? = $information[0]->city['data']?></a></div>
              <?php //if($row_properties->pay_rent != "") { ?>  
                <input  type="button" class="pay_rent_btn" onClick="window.open('< ? =$row_properties->pay_rent?>','_self')" />
              <?php //} ?>  
              </div>
              </div>-->
              <?php } ?>
              <div class="clear"></div>  
              <?php if($row_properties->title != "") { ?> 
             <!-- <div> 
              <strong>
              Property Name: <?//=$row_properties->title?><br />
              </strong>
              </div>  -->
              <?php } ?>
              <div class="content_desc">
              	<?=stripslashes($row_properties->description)?>
              </div>
            	<?php if(arg(1) == "commercial") { 
			 if($row_properties->leasing_info != "") {
			 ?> 
			 <div class="brd">Leasing Information</div>
			 <div class="clear"></div>
             <div class="content_desc"><?=stripslashes($row_properties->leasing_info)?></div>
			 <?php }} ?>             
			 
			 <?php 
			 $am_community_array=explode(";",$row_properties->amenity_community);
			 $am_home_array=explode(";",$row_properties->amenity_home);
			 $cnt1=count($am_community_array);
			 $cnt2=count($am_home_array);
			 ?>
              <div class="clear"></div>
              
              
             <?php if(($cnt1 != 1) && ($cnt2 != 1)) { ?> <div class="brd">Amenities</div> <?php } ?>
              <div class="clear"></div>
             <?php if(($cnt1 != 1) && ($cnt2 != 1)) { ?> <div class="sml_div">
                <p><span class="blue_hdr">In Your Community </span></p>
              <?php if($cnt1!=0) { ?>
                <ul>
              <?php  } 
			  for($i=0;$i<$cnt1;$i++) {
			  ?> 
              
                  <li><?=stripslashes($am_community_array[$i])?></li>
                
              <?php 
			  }
			  if($cnt1!=0) { ?>
                </ul>
              <?php } ?>
              </div> <?php } ?>
              <?php if(($cnt1 != 1) && ($cnt2 != 1)) { ?><div class="sml_div">
                <p><span class="blue_hdr">In Your Home </span></p>
              <?php if($cnt2!=0) { ?>
                <ul>
              <?php  } 
			  for($i=0;$i<$cnt2;$i++) {
			  ?> 
              
                  <li><?=stripslashes($am_home_array[$i])?></li>
                
              <?php 
			  }
			  if($cnt2!=0) { ?>
                </ul>
              <?php } ?>
              </div> <?php } ?>
               <?php } ?>
              <div class="clear"></div>
            </div>
<div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
  </div>

 
 <?php
 }
 ?>
 
 <div id="print_content" style="display:none;" align="">

  <div id="middle_container" style="padding-left:120px;">
    <div class="middle_container_inner">
      <!-- BEGIN : left side content-->
      
      <!-- end : left side content-->
      <!-- BEGIN : right side content-->
      <div id="right_container_auto">
       <div class="topshadow_effect"></div>
       <?php 
	   $url=db_result(db_query("select logo from cfh_property where pid=".arg(2)));
	   if(arg(1) != "commercial") { $head = db_result(db_query("select title from cfh_property where pid=".arg(2)));}
	   $img=db_result(db_query("select image_url from cfh_images where pid='".arg(2)."' and main='1'"));
	   $brochure=db_result(db_query("select brochure from cfh_property where pid=".arg(2)));
	   $brochure_url=$base_url."/sites/default/files/brochure/".$brochure;
	   $logo_url=$base_url."/sites/default/files/imgs/logo/".$url; 
	   $first_url=$base_url."/sites/default/files/imgs/".$img;
	   list($width, $height, $type, $attr) = getimagesize($logo_url);
	   ?> <h2 align="center" style="font-size:15px;"><?php
      
	   ?></h2>
           <?php if(arg(1) != "commercial") { ?>  <div class="nobhill_logo"><img src="<?=$logo_url?>" /></div> <?php } else {
		   $head=db_result(db_query("select title from cfh_property where pid=".arg(2)));
		   $head_desc = db_result(db_query("select header_section from cfh_property where pid=".arg(2)));
		   ?>
           <div> <p style="color:#0363A8;float:left; font-size:22px; margin:20px 37px 15px;"><?=$head?></p></div>
           <?php } ?>
            
        
            <div class="clear"></div>
            <!-- BEGIN : rgallery-->
            <div class="residential_content">
              <div style="position:relative;" >
              <div style="margin: 20px 17px 1px;">
              <?=$head_desc?>
              </div>
                <div class="clear"></div>
               <div id="right_bar" style="float:left;">
                  <div id="">
                    <div class="" id=""><h2><?=$head?></h2></div>
                  </div>
                  <!-- END: imagerotation -->
                </div>
                <div id="right_bar" style="float:right;">
                  <div id="">
                    <div class="" id=""><img src="<?=$first_url?>" /></div>
                  </div>
                  <!-- END: imagerotation -->
                </div>
              </div>
               <!-- END: gallery -->
              <?php 
			  $properties=db_query("select * from cfh_property where pid=".arg(2));
			  while($row_properties=db_fetch_object($properties)) {   
			  ?> 
              <div class="clear"></div>
              <div class="detil_warp">
              <div class="sml_div1">
                <strong>
              <?php 
			  echo nl2br(stripslashes($row_properties->address))."<br />";
			 // for($k=0;$k<=strlen($row_properties->address);$k=$k+20) { 
			 // echo stripslashes(substr($row_properties->address, $k, 20))."<br />";
			//  }
			  ?>
              <?php if($row_properties->phone!= "") { ?>    Phone: <?=$row_properties->phone?><br /><?php } ?>
              <?php if($row_properties->fax!= "") { ?>    Fax: <?=$row_properties->fax?><br /> <?php } ?>
                <a href="mailto:<?=$row_properties->email?>"><?=$row_properties->email?></a></strong>
              
                
              </div>
             
            
               
              
              <?php
              // pass zip here------------------------------------------------->
              //$xml = simplexml_load_file('http://www.google.com/ig/api?weather='.$row_properties->zip);
              //$information = $xml->xpath("/xml_api_reply/weather/forecast_information");
              //$current = $xml->xpath("/xml_api_reply/weather/current_conditions");
 
              ?>
 

              
              
              
              <?php // if($row_properties->zip != "") { ?>
              <!--<div class="right_btn_div" style="float:right;">
                <div class="weather_box">
                <a href="#"><img src="< ?='http://www.google.com'.$current[0]->icon['data']?>" width="24" height="19" alt="weather" /></a>
                <div class="text">< ?=$current[0]->temp_f['data']?>.F <sup>f</sup></div>
                <div class="clear"></div>
                <a href="#">< ?=$information[0]->city['data']?></a></div>
             
              </div>
              </div>-->
              <?php //} ?>
              <div class="clear"></div>
              <?php if($row_properties->title != "") { ?>
             <!-- <div> 
              <strong>
              Property Name: <?//=$row_properties->title?><br />
              </strong>
              </div>  -->
              <?php } ?>
              <div class="content_desc"><?=stripslashes($row_properties->description)?></div>
             <?php if(arg(1) == "commercial") { 
			         if($row_properties->leasing_info != "") {
			 ?> 
			 <div class="brd">Leasing Information</div>
			 <div class="clear"></div>
             <div class="content_desc"><?=stripslashes($row_properties->leasing_info)?></div>
			 <?php }} ?>             
			 
			 <?php 
			 $am_community_array=explode(",",$row_properties->amenity_community);
			 $am_home_array=explode(",",$row_properties->amenity_home);
			 $cnt1=count($am_community_array);
			 $cnt2=count($am_home_array);
			 ?>
              <div class="clear"></div>
              
              
             <?php if(($cnt1 != 1) && ($cnt2 != 1)) { ?> <div class="brd">Amenities</div> <?php } ?>
              <div class="clear"></div>
             <?php if(($cnt1 != 1) && ($cnt2 != 1)) { ?> <div class="sml_div">
                <p><span class="blue_hdr">In Your Community </span></p>
              <?php if($cnt1!=0) { ?>
                <ul>
              <?php  } 
			  for($i=0;$i<$cnt1;$i++) {
			  ?> 
              
                  <li><?=stripslashes($am_community_array[$i])?></li>
                
              <?php 
			  }
			  if($cnt1!=0) { ?>
                </ul>
              <?php } ?>
              </div> <?php } ?>
              <?php if(($cnt1 != 1) && ($cnt2 != 1)) { ?><div class="sml_div">
                <p><span class="blue_hdr">In Your Home </span></p>
              <?php if($cnt2!=0) { ?>
                <ul>
              <?php  } 
			  for($i=0;$i<$cnt2;$i++) {
			  ?> 
              
                  <li><?=stripslashes($am_home_array[$i])?></li>
                
              <?php 
			  }
			  if($cnt2!=0) { ?>
                </ul>
              <?php } ?>
              </div> <?php } ?>
               <?php } ?>
              <div class="clear"></div> 
            </div>
      <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  </div>
  <?php  if(arg(2) != "" && arg(1) !="past_projects") {
	//echo "q".arg(2); exit;   
	 ?>
     </div>
     <?php  
  if(arg(3) != "map" && arg(3) != "service_request.html" && arg(3) != "emailing" && arg(1) !="past_projects") {
  ?>
  
  </div>
  <?php  } } ?>

 <script language="javascript">
   
      function PrintContent(node) {   
      var DocumentContainer = document.getElementById('print_content');
      var WindowObject = window.open('', "print_content",  
      "width=740,height=325,top=200,left=250,toolbars=no,scrollbars=yes,status=no,resizable=no");
      WindowObject.document.writeln(DocumentContainer.innerHTML);
      WindowObject.document.close();
      WindowObject.focus();
      WindowObject.print();
      WindowObject.close();
      }
 </script>