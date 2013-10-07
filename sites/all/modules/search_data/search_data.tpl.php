<?php 
global $base_url;
if(isset($_POST['keys'])) {
drupal_goto($base_url."/search_data/".$_POST['keys']);
}
if(arg(1) == "") {
$msg="no";
}
else {
$word=arg(1);
$res="select n.title as title1,cp.title,cp.description,nr.teaser,n.nid,cp.pid,n.type,cp.property_type from node as n join node_revisions as nr on nr.nid=n.nid join cfh_property as cp on cp.pid=n.nid where n.title like '%".$word."%' or nr.body like '%".$word."%' or cp.address like '%".$word."%' or cp.description like '%".$word."%' or cp.title like '%".$word."%' or cp.sub_cat like '%".$word."%' group by n.nid";
$count_query = "select count(*) from node as n join node_revisions as nr on nr.nid=n.nid join cfh_property as cp on cp.pid=n.nid where n.title like '%".$word."%' or nr.body like '%".$word."%' or cp.address like '%".$word."%' or cp.description like '%".$word."%'  or cp.title like '%".$word."%' or cp.sub_cat like '%".$word."%'";
$count = db_result(db_query("select count(*) from node as n join node_revisions as nr on nr.nid=n.nid join cfh_property as cp on cp.pid=n.nid where n.title like '%".$word."%' or nr.body like '%".$word."%' or cp.address like '%".$word."%' or cp.description like '%".$word."%' or cp.title like '%".$word."%' or cp.sub_cat like '%".$word."%'"));

$query = pager_query($res, 5, 0, $count_query);
}
?> 

  <!-- end : Menu-->  <!-- BEGIN : Middle container-->
  <div id="middle_container" >
    <div class="middle_container_inner">
      <!-- BEGIN : left side content-->
      <div id="left_container">
        <div class="left_container_sml">
          <div class="topshadow_effect"></div>
          <div class="sidelink">
             <!--<p>Contact</p>-->
             <br />
             <?php $facebook_link=db_result(db_query("select link from cfh_facebook")); ?>        
         <input type="button" class="facebook" onclick="window.open('<?=$facebook_link?>','_blank');" />
          </div>
          <div class="clear"></div>
        </div>
      </div>
      <!-- end : left side content-->
      <!-- BEGIN : right side content-->
      <div id="right_container_auto">
        <!-- separate styles used for this page -->
        <div class="topshadow_effect"></div>
        <div class="content_text">
        <h2 class="head_dynamic">SEARCH</h2>
        <form class="search-form" id="search-form" method="post" accept-charset="UTF-8" action="#">
        <div><div class="form-item">
        <label>Enter your keywords: </label>
        <div class="container-inline"><div id="edit-keys-wrapper" class="form-item">
        <input type="text" class="form-text" value="<?=arg(1)?>" size="40" id="edit-keys" name="keys" maxlength="255">
        </div>
        <input type="submit" class="form-submit" value="" id="edit-submit" name="op">
        </div>
        </div>
        <input type="hidden" value="form-2e7c684dcbfab32816934a0db6096e07" id="form-2e7c684dcbfab32816934a0db6096e07" name="form_build_id">
        <input type="hidden" value="search_form" id="edit-search-form" name="form_id">
        </div></form>
        <div class="box">
        <?php if($count == 0) { ?>
        <h2 class="title">Your search yielded no results</h2>
        <?php }
		      else { ?>
        <h2 class="title">Search results</h2>
        <?php } ?>
        <div class="content">
        <?php if($count == 0) { ?>
                <ul>
                <li>Check if your spelling is correct.</li>
                <li>Remove quotes around phrases to match each word individually: <em>"blue smurf"</em> will match less than <em>blue smurf</em>.</li>
                <li>Consider loosening your query with <em>OR</em>: <em>blue smurf</em> will match less than <em>blue OR smurf</em>.</li>
                </ul>
        <?php } ?>
        <?php 
		while($row=db_fetch_object($query)) { 
		$title = $row->title;
		if($row->type == "") {
		if($row->property_type == 1) {
		 $url=$base_url."/view_property/residential/".$row->nid;
		}
		else if($row->property_type == 2) {
		 $url=$base_url."/view_property/commercial/".$row->nid;
		}
		else {
		 $url=$base_url."/view_property/past_projects";
		}
		 $description=$row->description;
		}
		else {
		 $title = $row->title1;
		 $description=strip_tags($row->teaser);
		 $srcs=db_query("select * from url_alias");
		 while($row1=db_fetch_object($srcs)) { 
		 $src=explode('/',$row1->src);
		 if($src[1] == $row->nid) {
		 $url_alias = db_result(db_query("select dst from url_alias where src='".$row1->src."'"));
		 if($url_alias == "contactus_content.html") {
		 $url_alias = "contactus.html";
		 }
		 }
		 }
		
		//$url_alias = db_result(db_query("select dst from url_alias where pid=".$row->nid));
		$url=$base_url."/".$url_alias;
		} 
		
		
		
		?>
       
          <dl class="search-results node-results">
          <dt class="title">
          <a href="<?=$url?>"><?=$title?></a>
          </dt>
          <dd>
         <p class="search-snippet"><?=$description?></p>
         </dd>
         </dl>
       
        
        
        
        
        
        
        <?php 
		
		}
		/*$row1 = "insert into cfh_property(pid) values";
		//$row2 = "insert into node_revisions(nid) values";
		$num= db_result(db_query("select count(pid) from cfh_property"));
        $kk= db_query("select nid from node");
		while($row=db_fetch_object($kk)) {  
		$row1 .= "('".$row->nid."'),"; 
		//$row2 .= "('".$row->pid."'),";
		
		}
		print $row1; print "<br />";*/
		//print $row2; print "<br />";
		 ?>
      </div>  
      </div>
      </div>
      <?php
	    $output =theme('pager', NULL, 5, 0);
        print $output;
	  ?>	
      <div class="clear"></div>
    </div><div class="clear"></div>
  </div>
  