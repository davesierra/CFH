<?php 
global $base_url;
$featured_property=db_query("select * from cfh_images where pid in (select p.pid from cfh_property as p where featured='1') and main='1'");
$payrent_online_link=db_query("select link  from cfh_links where id='1'");
$payrent_online_link_row=db_fetch_object($payrent_online_link);
$payrent_online_link_row_link=$payrent_online_link_row->link;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>CFH</title>
<link href="<?=$base_url?>/sites/all/themes/CFH_theme/css/style1.css" rel="stylesheet" type="text/css" />
<link href="<?=$base_url?>/sites/all/themes/CFH_theme/css/chromestyle.css" rel="stylesheet" type="text/css"/>
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
      <!--<input name="#" type="button" class="serch_btn" />
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
          <li class="nav1"><a href=""<?=$base_url?>" >Home</a></li>
          <li class="nav2"><a href="<?=$base_url?>/company_overview.html" >Company Overview</a></li>
          <li class="nav3"><a href="<?=$base_url?>/services.html" >Services</a></li>
          <li class="nav4"><a href="<?=$base_url?>/view_property" rel="dropmenu1">Property</a></li>
          <li class="nav5"><a href="<?=$base_url?>/career.html" >Careers</a></li>
          <!--<li class="nav6"><a href="#" ></a></li>-->
          <li class="nav7"><a href="<?=$base_url?>/contactus.html" >Contact us</a></li>
        </ul>
      </div>
    </div>
  </div>
    <div id="dropmenu1" class="dropmenudiv"> 
        <a href="<?=$base_url?>/view_property/residential">Residential</a>
        <div class="line"></div>
        <a href="<?=$base_url?>/view_property/commercial">Commercial</a>
        <div class="line"></div>
        <a href="<?=$base_url?>/view_property/past_projects">Past Projects</a>
        <div class="line"></div>
      </div>
	  <script type="text/javascript">
	  	cssdropdown.startchrome("chromemenu")
      </script>
  <!-- end : Menu-->
  <!-- BEGIN : Middle container-->
  <div id="middle_container" >
    <div class="middle_container_inner">
     <!-- BEGIN : banner-->
      <div id="banner"> </div>
       <!-- BEGIN : quick links -->
      <div class="quick_links">
       <!-- <input name="investors" type="button" class="investors" />-->
        <input name="pay_rent" type="button" class="pay_rent" onclick="window.open('<?php echo $payrent_online_link_row->link; ?>','_blank');" />
        <input name="commercial" type="button" class="commerical"  onclick="location.href='view_property/commercial'"/>
        <input name="residential" type="button" class="residential" onclick="location.href='view_property/residential'"/>
        
      </div> 
      <!-- end : quick links -->
 <div class="featured_properties">
            <h2>Featured properties </h2>
            <!-- BEGIN : Gallery -->
            <div class="slider">
              <ul id="mycarousel" class="jcarousel-skin-tango">
            <?php  while($row=db_fetch_object($featured_property)) { 
			$type=db_result(db_query("select property_type from cfh_property where pid=".$row->pid));
			//$type_name=db_result(db_query("select name from term_data where tid=".$type));
			if($type==2) {
			$type_name="commercial";
			}
			else {
			$type_name="residential";
			}
			?>
            <li><a href="<?=$base_url?>/view_property/<?=$type_name?>/<?=$row->pid?>"><img src="<?=$base_url?>/sites/default/files/imgs/normal/<?=$row->image_url?>" width="93" height="70" alt="image1" /></a></li>
            <?php   } ?>
              
              </ul>
            </div>
            <!-- END : Gallery -->
      </div>
          <div class="clear"></div>
       </div>
      </div>
       <div id="footer_home" style="position:relative">
      
       <div class="greenlogofooter">
       <a href="<?=$base_url?>/green_initiatives.html"><img src="<?=$base_url?>/sites/all/themes/CFH_theme/images/footer_greenlogo.png" width="191" height="69" alt="" /> </a>  
       </div>
      
      <p style="padding:38px 93px 30px 0;">© 2010 CFH Group | <a href="<?=$base_url?>/terms_of_use.html">Terms and Conditions</a> | <a href="<?=$base_url?>/privacy.html">Privacy Policy</a> | <a href="<?=$base_url?>/company_overview.html" >Company Overview</a> | <a href="<?=$base_url?>/services.html" >Services</a> | <a href="<?=$base_url?>/view_property/commercial">Properties</a> | <a href="<?=$base_url?>/career.html" >Careers</a> <!--| <a href="#">Investors</a> -->| <a href="<?=$base_url?>/contactus.html">Contact</a> </p>
    <div class="footer_logo" style="right: 42px;top: 155px;"></div>
   <!-- BEGIN : Footer container--></div>
    
</div> 
<!-- END : Outer Main-->
</body>
</html>