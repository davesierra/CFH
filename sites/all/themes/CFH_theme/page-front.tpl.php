<?php 
global $base_url;
include('mobile-detection.php');
$featured_property=db_query("select * from cfh_images where pid in (select p.pid from cfh_property as p where featured='1') and main='1'");
$payrent_online_link=db_query("select link  from cfh_links where id='1'");
$payrent_online_link_row=db_fetch_object($payrent_online_link);
$payrent_online_link_row_link=$payrent_online_link_row->link;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>CFH</title>

<link href="<?=$base_url?>/sites/all/themes/CFH_theme/css/style1.css" rel="stylesheet" type="text/css" />
<link href="<?=$base_url?>/sites/all/themes/CFH_theme/css/chromestyle.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="<?=$base_url?>/sites/all/themes/CFH_theme/css/mobile.css" media="handheld, only screen and (max-width:480px)"/>

<script src="<?=$base_url?>/sites/all/themes/CFH_theme/js/chrome.js" type="text/javascript"></script>

<!--[if IE 6]>
<SCRIPT src="<?=$base_url?>/sites/all/themes/CFH_theme/js/DD_belatedPNG_0.0.8a-min.js"></SCRIPT>
<SCRIPT>
			DD_belatedPNG.fix('img,div,h1,a,li,.slider li');
</SCRIPT>
<![endif]-->

<!-- jQuery library -->
<script type="text/javascript" src="<?=$base_url?>/sites/all/themes/CFH_theme/js/jquery-1.4.2.min.js"></script>

<script type="text/javascript" src="<?=$base_url?>/sites/all/themes/CFH_theme/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript">
	var $j = jQuery.noConflict(true); // Set a new variable for a noconflict between the original jQ library and the newer one needed for slider
</script>

<!-- jCarousel library -->
<script type="text/javascript" src="<?=$base_url?>/sites/all/themes/CFH_theme/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?=$base_url?>/sites/all/themes/CFH_theme/js/jquery.touchwipe.min.js"></script>

<!-- jCarousel skin stylesheet -->
<link rel="stylesheet" type="text/css" href="<?=$base_url?>/sites/all/themes/CFH_theme/css/skin.css" />

<script type="text/javascript">

//var mobileCheck = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
//var isMobileDevice = navigator.userAgent.match(/iPad|iPhone|iPod/i) != null || screen.width <= 480;
var isMobileDevice = navigator.userAgent.match(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i) != null || screen.width <= 480;

//alert(isMobileDevice); //spits out true=mobile or false=desktop

function mycarousel_initCallback(carousel) {
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

// If mobile, set the number of visible items


jQuery(document).ready(function() {
	if( isMobileDevice ) { 
		visibleItems = 4;
		$('#edit-search-theme-form-1').attr('placeholder', 'Search');
	} else {
		visibleItems = null;
	}

	jQuery('#mycarousel').jcarousel({
		auto: 3,
		visible : visibleItems,
		wrap: 'last',
		itemFallbackDimension: 300,
		initCallback: mycarousel_initCallback
	});
	
	var carousel = jQuery('#mycarousel').data('jcarousel');
	$("#mycarousel").touchwipe({
		wipeLeft: function() { carousel.next(); },
		wipeRight: function() { carousel.prev(); },
		min_move_x: 20,
		min_move_y: 20,
		preventDefaultEvents: true
	});
	
});

</script>

</head>
<body class="front-page">
<div id="outer_main">
	<div id="header">
		<div id="logo">
			<h1><a href="<?=$base_url?>">CFH</a></h1>
		</div>
		<div id="search_area">
		 <?php print $search_box; ?>
			<!--<input name="#" type="button" class="serch_btn" />
			<input name="#" type="text" class="serch_field" />-->
		</div>
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
		</div>
	</div>

	<?php if($ismobile==false){ //desktop ?>
	<div id="dropmenu1" class="dropmenudiv"> 
		<a href="<?=$base_url?>/view_property/residential">Residential</a>
		<div class="line"></div>
		<a href="<?=$base_url?>/view_property/commercial">Commercial</a>
		<div class="line"></div>
		<a href="<?=$base_url?>/view_property/past_projects">Past Projects</a>
		<div class="line"></div>
	</div><!-- end : Menu-->
	<script type="text/javascript">cssdropdown.startchrome("chromemenu");</script>
	<?php } ?>

	<div class="featured_properties">
		<h2>Featured properties </h2>
		<!-- BEGIN : Gallery -->
		<div class="slider">
			<ul id="mycarousel" class="jcarousel-skin-tango">
		
				<?php while($row=db_fetch_object($featured_property)) { 
					$type=db_result(db_query("select property_type from cfh_property where pid=".$row->pid));
					//$type_name=db_result(db_query("select name from term_data where tid=".$type));
					if($type==2) {
						$type_name="commercial";
					} else {
						$type_name="residential";
					} ?>

				<li><a href="<?=$base_url?>/view_property/<?=$type_name?>/<?=$row->pid?>"><img src="<?=$base_url?>/sites/default/files/imgs/normal/<?=$row->image_url?>" width="93" height="70" alt="image1" /></a></li>
			
				<?php } ?>
			
			</ul>
		</div><!-- END : Gallery --> 
	</div>

	<!-- BEGIN : Middle container-->
	<div id="middle_container" >
		<div class="middle_container_inner">
		 <!-- BEGIN : banner-->
			<div id="banner"></div>
	
			<!-- BEGIN : quick links -->
			<div class="quick_links">
			 <!-- <input name="investors" type="button" class="investors" />-->
				<span name="pay_rent" class="pay_rent btn" onclick="window.open('<?php echo $payrent_online_link_row->link; ?>','_blank');" >Pay Rent Online</span>
				<span name="commercial" class="commerical btn"  onclick="location.href='view_property/commercial'">Commercial</span>
				<span name="residential" class="residential btn" onclick="location.href='view_property/residential'">Residential</span>
				<span name="login" class="login btn" onclick="location.href='view_property/residential'">Resident Login</span>
			</div> 
			<!-- end : quick links -->

			<div class="clear"></div>
		</div>
	</div>
	<div id="footer" class="home">
			
		<div class="greenlogofooter">
			<a href="<?=$base_url?>/green_initiatives.html">
				<img src="<?=$base_url?>/sites/all/themes/CFH_theme/images/footer_greenlogo.png" width="191" height="69" alt="" />
			</a>  
		</div>
		<div class="legal_info">
			© 2010 CFH Group &nbsp;
			<a href="<?=$base_url?>/terms_of_use.html" class="m-show">Terms and Conditions</a>  
			<a href="<?=$base_url?>/privacy.html" class="m-show">Privacy Policy</a>  
			<a href="<?=$base_url?>/company_overview.html" >Company Overview</a>  
			<a href="<?=$base_url?>/services.html" >Services</a>  
			<a href="<?=$base_url?>/view_property/commercial">Properties</a>  
			<a href="<?=$base_url?>/career.html" >Careers</a>  
			<a href="<?=$base_url?>/contactus.html">Contact</a>
			<div class="footer_logo"></div>
		</div>
		
	</div>	
</div><!-- END : Outer Main-->


</body>
</html>



 