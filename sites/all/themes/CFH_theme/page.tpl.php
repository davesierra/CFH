<?php
global $base_url;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CFH</title>
<link href="<?=$base_url?>/sites/all/themes/CFH_theme/css/style1.css" rel="stylesheet" type="text/css" />
<link href="<?=$base_url?>/sites/all/themes/CFH_theme/css/chromestyle.css" rel="stylesheet" type="text/css"/>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>

<script src="<?=$base_url?>/sites/all/themes/CFH_theme/js/chrome.js" type="text/javascript"></script>
<!--[if IE 6]>
<SCRIPT src="<?=$base_url?>/sites/all/themes/CFH_theme/js/DD_belatedPNG_0.0.8a-min.js"></SCRIPT>
<SCRIPT>
      DD_belatedPNG.fix('img,div,h1,a,li,.slider li');
</SCRIPT>
<![endif]-->
<!--
  jQuery library
-->
<script type="text/javascript" src="<?=$base_url?>/sites/all/themes/CFH_theme/js/jquery-1.4.2.min.js"></script>
<!--
  jCarousel library
-->
<script type="text/javascript" src="<?=$base_url?>/sites/all/themes/CFH_theme/js/jquery.jcarousel.min.js"></script>
<!--
  jCarousel skin stylesheet
-->
<link rel="stylesheet" type="text/css" href="<?=$base_url?>/sites/all/themes/CFH_theme/css/skin.css" />
<script type="text/javascript" src="<?=$base_url?>/sites/all/themes/CFH_theme/js/smoothscroll.js"></script>
<?php
if(arg(2) == "") {
 ?>
<script type="text/javascript">

function mycarousel_initCallback(carousel)
{
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
        auto: 3,
        wrap: 'last',
        initCallback: mycarousel_initCallback
    });
});

</script>
<?php
}
?>
</head>
<body>
<div id="outer_main">
  <div id="header">
    <div id="logo">
      <h1><a href="<?=$base_url?>">CFH</a></h1>
    </div>
    <!-- END : Logo-->
    <!-- BEGIN : Search-->
    <div id="search_area">
      <?php print $search_box; ?>
    <!--  <input name="#" type="button" class="serch_btn" />
      <input name="#" type="text" class="serch_field" />-->
    </div>
    <!-- END : Search-->
    <div class="clear"></div>
  </div>
  <!-- BEGIN : Menu-->

<div id="menu_container">
    <div id="menu">
      <div  id="chromemenu">
        <ul>
          <li class="nav1"><a href="<?=$base_url?>" >Home</a></li>
          <li class="nav2"><a href="<?=$base_url?>/company_overview.html" >Our Company</a></li>
          <li class="nav3"><a href="<?=$base_url?>/services.html" >Services</a></li>
          <li class="nav4"><a href="<?=$base_url?>/view_property" rel="dropmenu1">Property</a></li>
          <li class="nav5"><a href="<?=$base_url?>/career.html" >Careers</a></li>
          <!--<li class="nav6"><a href="#" ></a></li>-->
          <li class="nav7"><a href="<?=$base_url?>/contactus.html" >Contact us</a></li>
          <li class="nav8"><a href="<?=$base_url?>/news" >News</a></li>
        </ul>
      </div>
      <div id="dropmenu1" class="dropmenudiv"> 
        <a href="<?=$base_url?>/view_property/residential">Residential</a>
        <div class="line"></div>
        <a href="<?=$base_url?>/view_property/commercial">Commercial</a>
        <div class="line"></div>
        <a href="<?=$base_url?>/view_property/past_projects">Past Projects</a>
        <div class="line"></div>
      </div>
	 
    </div>
  </div>
   <script type="text/javascript">
	  	cssdropdown.startchrome("chromemenu")
   </script>
   
  <?php
  
    if((arg(0) == "user") || ($content == "You are not authorized to access this page.") || (arg(0) == "search")) {
  ?>
  
     <div id="middle_container" >
    <div class="middle_container_inner">
 
      <!-- BEGIN : left side content-->
      <div id="left_container">
        <div class="left_container_sml">
          <div class="topshadow_effect"></div>
          <div class="sidelink">
          <?php  if(arg(0) == "user") {
		    if(arg(1) == "") {
		  ?>
           <p>User Login</p>
           <?php } else if(arg(1) == "password") { ?>
            <p>Request New Password</p>
           <?php
		   }
		   } 
		   ?>
            <?php  if(arg(0) == "search") { ?>
           <p>SEARCH</p>
           <?php } ?>
           <!-- <ul>
              <li><a href="residential_details.html">burmuda vilas </a></li>
              <li><a href="residential_details.html">Harbour Key </a></li>
            </ul>
            <p><a href="#">Gulf coast</a></p>
            <p><a href="#">cental florida</a></p>
            <input type="button" class="facebook"  />-->
          </div>
          <div class="clear"></div>
        </div>
      </div>
      <!-- end : left side content-->
      <!-- BEGIN : right side content-->
      <div id="right_container">
      
        <!-- separate styles used for this page -->
        <div class="topshadow_effect"></div>
         
            <div class="content_text">
           <?php  
		   if(arg(0) == "user") {
			   if(arg(1) == "") {
		   ?>
           <h2 class="head_dynamic">User Login</h2>
           <?php } else if(arg(1) == "password") { ?> 
           <h2 class="head_dynamic">Request New Password</h2>
           <?php } ?>
           
           
           
            <?php if ($show_messages && $messages): print $messages; endif; ?>
           <?php } 
            if(arg(0) == "search") { ?>
            <h2 class="head_dynamic">SEARCH</h2>
             <?php if ($show_messages && $messages): print $messages; endif; ?>
          <?php } ?>
            <?php   print $content;  ?>
            </div>
            
            <div class="clear"></div>
          </div>

      <div class="clear"></div>
    </div><div class="clear"></div>
  </div>
  
 
  
  
  
  
  
  <?php
	} 
  else {
	   
  if((arg(0) !="contactus.html") && (arg(0) != "view_property") && (arg(0) != "search_data")) {  
  ?>
  <div id="middle_container" >
  <div class="middle_container_inner">
  <!-- BEGIN : left side content-->
  <div id="left_container">
  <?php if(arg(0) == "services.html") { ?>
  <div class="left_container_big">
  <?php } else { ?>
  <div class="left_container_sml">
  <?php } ?>
  <div class="topshadow_effect"></div>
  <div class="sidelink">
  <?php  
  	   
  if(arg(1) == 8) {  
   ?>
 <p><a href="services.html">Property Management</a></p>
 <p><a href="paramount_depot.html">PARAMOUNT Depot</a></p>
 <p><a href="paramount_nursery.html">PARAMOUNT Nursery</a></p>
 <?php } 
  else if(arg(1) == 7) {  
   ?>
  <p><a href="services.html">Property Management</a></p>
 <p><a href="paramount_depot.html">PARAMOUNT Depot</a></p>
 <p><a href="paramount_nursery.html">PARAMOUNT Nursery</a></p>
 <?php } 
 else if(arg(1) == 6) {  
   ?>
   <p><a href="company_overview.html">About CFH</a></p>
   <p><a href="leadership.html">CFH Group Leadership</a></p>
   <ul id="cfh_personnels">  
    <!--<li><a href="#tom">Tom Cabrezio</a></li>
        <li><a href="#gliset">Gliset Perez</a></li>
    <li><a href="#jim">Jim Kennedy</a></li>
    <li><a href="#nathan">Nathan Verdrani</a></li>
    <li><a href="#ivan">Ivan Fuentes</a></li>-->
   </ul>
   <p><a href="green_initiatives.html">GREEN INITIATIVES</a></p>
   <script language="javascript">
   jQuery(document).ready(function() {
	   var personnel_cnt = '';
	   jQuery('#right_container_auto .content_text a').each(function(index) {
		   if(jQuery(this).text() != "Back To Top") {
		   var myarr = jQuery(this).text().split("|");
	       personnel_cnt +='<li><a href="#'+jQuery(this).attr('id')+'">'+myarr[0]+'</a></li>';
		   } 
		   jQuery('#cfh_personnels').html(personnel_cnt);
       });
   });
   </script>
 <?php }
 else if(arg(1) == 5) {  
   ?>
  <p><a href="services.html">Property Management</a></p>
  <ul>
   <li><a href="#res">Residential Management </a></li>
   <li><a href="#com">Commercial Management </a></li>
   </ul>
  <p><a href="paramount_depot.html">PARAMOUNT Depot</a></p>
  <p><a href="paramount_nursery.html">PARAMOUNT Nursery</a></p>
 <?php }
 else if(arg(1) == 4 || arg(1) == 219) {  
   ?>
   <p><a href="company_overview.html">About CFH</a></p>
   <p><a href="leadership.html">CFH Group Leadership</a></p>
   <p><a href="green_initiatives.html">GREEN INITIATIVES</a></p>
 
 <?php } 
 else if(arg(1) == 9) {  
   ?>
  <!-- <p>Careers</p>-->
 <?php } 
 else if(arg(1) == 13) {  
   ?>
   <p>Terms & Condition</p>
 <?php } 
  if((arg(0) !="contactus.html") && (arg(0) != "view_property")) {
 ?>
         
         <br />
  <?php $facebook_link=db_result(db_query("select link from cfh_facebook")); ?>        
         <input type="button" class="facebook" onclick="window.open('<?=$facebook_link?>','_blank');" />
 <?php } ?>       
          </div>
          <div class="clear"></div>
        </div>
      </div>
  
  
  <?php  
  }
  if(arg(1) == 219) { ?>
    <div class="green_head_container" id="right_container">
      <div class="greenlandingPage">
        <?php print $content;  ?>
      </div>
    </div>
  <?php
  } else if (arg(1) == 230) { ?>
    <div class="news_container" id="right_container">
      <div class="news_page">
        <div class="topshadow_effect">&nbsp;</div>
        <h2 class="blue_hdr">News</h2>
        <div class="content_text">
          <?php print $content;  ?>
        </div>
        
      </div>
    </div>
    <?php
  }else {
    print $content; 
  }
  }
   
   ?>
  <div class="clear"></div>
   <?php 
  if(arg(1) == 8) {  
   ?>
    <div class="clear"></div>
    </div>
    </div>

  <div id="footer_services" style="position:relative">
 <?php } 
  else if(arg(1) == 7) {  
   ?>
 <div class="clear"></div>
 </div>
    </div>
 <div id="footer_paramount" style="position:relative">
 <?php } 
 else if(arg(1) == 6) {  
   ?>
 
   <div class="clear"></div>
   </div>
    </div>
   <div id="footer" style="position:relative">
 <?php }
 else if(arg(1) == 5) {  
   ?>
 <div class="clear"></div>
 </div>
    </div>
 <div id="footer" style="position:relative">
 <?php }
 else if(arg(1) == 4 || arg(1) == 230) {  
   ?>
  
  <div class="clear"></div>
  </div>
    </div>
  <div id="footer" style="position:relative">
 <?php } 
 else if(arg(1) == 9) {  
   ?>
  
  <div class="clear"></div>
  </div>
    </div>
  <div id="footer" style="position:relative">
 <?php } 
  else if(arg(1) == 209) {  
 ?>
 
   <div class="clear"></div>
   </div>
    </div>
   <div id="footer" style="position:relative">
 <?php }
 
 else if(arg(1) == 11) {  
   ?>
  
  <div class="clear"></div>
  </div>
    </div>
  <div id="footer" style="position:relative">
 <?php }
  else if(arg(1) == 13) {  
   ?>
  
  <div class="clear"></div>
  </div>
    </div>
  <div id="footer" style="position:relative">
 <?php }
  else if(arg(1) == 219 ) {  
   ?>
  
  <div class="clear"></div>
  </div>
    </div>
  <div id="footer" style="position:relative" class="footer_green">
 <?php }

 else  if((arg(0) == "user") || ($content == "You are not authorized to access this page.") || (arg(0) == "search") || (arg(0) =="view_property") || (arg(0) =="contactus.html") || (arg(0) =="search_data")) {
 
 ?>
 
  <div class="clear"></div>
  
  <div id="footer" style="position:relative">
 <?php
 }
 else { ?>
  <div class="clear"></div>
  <div id="footer_home" style="position:relative">
 <?php } ?>
    <p style="padding:38px 39px 5px 0;"><a href="<?=$base_url?>/company_overview.html" >Company Overview</a> | <a href="<?=$base_url?>/services.html" >Services</a> | <a href="<?=$base_url?>/view_property/commercial">Properties</a> | <a href="<?=$base_url?>/career.html" >Careers</a> <!--| <a href="#">Investors</a> -->| <a href="<?=$base_url?>/contactus.html">Contact</a> <!-- | <a href="<?=$base_url?>/privacy.html">Privacy Policy</a>--></p>
    <p style="padding:0px 39px 5px 0;">© 2010 CFH Group   | <a href="<?=$base_url?>/terms_of_use.html">Terms and Conditions</a> | <a href="<?=$base_url?>/privacy.html">Privacy Policy</a><div class="footer_logo"></div></p>
    <!-- BEGIN : Footer container-->
  </div>
</div>
</div>
<!-- END : Outer Main-->
</body>
</html>
