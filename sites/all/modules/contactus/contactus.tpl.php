<?php 
global $base_url;
$to = db_result(db_query("select email from term_data where tid=".$_POST['attention']));//variable_get('site_mail'); 
$from= $_POST['email'];
$name= $_POST['name'];
$subject= $_POST['subject'];
$attention1 = db_result(db_query("select name from term_data where tid=".$_POST['attention']));
$message1=$_POST['message'];
if(isset($_POST['send'])) {
//print_r($_POST);
    
	$message = '<table width="608" cellspacing="0" cellpadding="0" border="0" align="center" style="background-color: rgb(255, 255, 255);">
  <tbody><tr>
    <td valign="top" align="left" style="background-color: rgb(208, 229, 242); font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 12px;">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" align="left"><img height="110" width="608" border="0" usemap="#Map" alt="top" src="http://122.166.13.6sites/all/themes/CFH_theme/images/top.jpg"></td>
  </tr>
  <tr>
    <td valign="top" align="left" style="padding: 20px;"><table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tbody><tr>
        <td valign="top" align="left" style="font-family: Arial,Helvetica,sans-serif; font-size: 12px; color: rgb(3, 99, 168); padding-bottom: 20px; line-height: 18px;"><p style="font-family: Tahoma,arial,verdana; font-size: 13px; font-weight: bold;">Hello Admin</p>       
          <p style="color: rgb(70, 70, 70);"><br />Attention: '.$attention1.'<br />'.$message1.'
          </p>
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
    <td valign="bottom" align="left"><img height="10" width="608" alt="bottom" src="http://122.166.13.6sites/all/themes/CFH_theme/images/bottom.gif"></td>
  </tr>
</tbody></table>';
	
	

	
	 
	 
	 
	 
$messagefile = <<<EOF
     
<html>
  <body bgcolor="#DCEEFC">
    
		$message
		</br>
       
    
     
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
    @mail($to, $subject, $messagefile, $headers);
    $sent = "Thank you for contacting us. We will get back to you soon....";
    $res=db_query("insert into contactus(name,email,subject,attention,message) values ('".addslashes($name)."','".$from."','".addslashes($subject)."','".$_POST['attention']."','".addslashes($message1)."')");
	 
	 
	 

}






$attention11 = db_query("select * from term_data where vid='3'");
?> 

<link rel="stylesheet" href="<?=$base_url?>/sites/all/modules/contactus/css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<script src="<?=$base_url?>/sites/all/modules/contactus/js/jquery.validationEngine-en.js" type="text/javascript"></script>
		<script src="<?=$base_url?>/sites/all/modules/contactus/js/jquery.validationEngine.js" type="text/javascript"></script>

		<script>	
		$(document).ready(function() {
			// SUCCESS AJAX CALL, replace "success: false," by:     success : function() { callSuccessFunction() }, 
			
			$("#contactus").validationEngine()
			
			
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
      <div id="right_container">
        <!-- separate styles used for this page -->
        <div class="topshadow_effect"></div>
        <form name="contactus" class="formular" id="contactus" method="post" action="#">
         <h2 align="center" style="font-size:15px;"><?=$sent?></h2>
         <h2> Contact</h2>
            <div class="content_text">
              <div class="lable">Name:</div>
              <input type="text" class="validate[required,custom[onlyLetter],length[0,100]] contact_input" name="name" id="name" />
              <br class="clear"/>
              <div class="lable">E mail address:</div>
              <input type="text" class="validate[required,custom[email]] contact_input" name="email" id="email" />
              <br class="clear"/>
              <div class="lable">Subject:</div>
              <input type="text" class="validate[required,custom[onlyLetter],length[0,100]] contact_input" name="subject" id="subject" />
              <br class="clear"/>
              <div class="lable">Attention:</div>
              <select class="validate[required] contact_select" name="attention" id="attention">
                <option value="">--select--</option>
                <?php while($row=db_fetch_object($attention11)) { ?>
                <option value="<?=$row->tid?>"><?=$row->name?></option>
                <?php } ?>
              </select>
              <br class="clear"/>
              <div class="lable">Message:</div>
              <textarea cols="5" rows="5" class="validate[required,length[6,600]] contact_textarea" name="message" id="message"></textarea>
              <br />
              <div class="btn_div" align="center">
                <input type="reset" class="reset_btn" name="reset" id="reset" value="" />
                <input type="submit" class="send_btn" name="send" id="send" value="" onclick="return validate();" />
              </div><br class="clear"/>
              <div class="empty25"></div>
              <?php
			  $contents=db_result(db_query("select body from node_revisions where nid='12'")); 
			  print $contents;
			  ?>
              <!--<div class="sml_div">
                <h3><span>Residential</span></h3>
                Lori Donnelly / VP of Property Management<br />
                Ph:(305) 779-8040 ext 2116<br />
                Fax: (305) 779-6547<br />
                email: <a href="mailto:email@Idonnelly@cfhgroup.com?">Idonnelly@cfhgroup.com</a><br />
                <br />
                <h3><span>Acquisitions</span></h3>
                Nathan Vedrani / Director of Acquisitions<br />
                Ph:(305) 779-8040 ext 2123<br />
                Fax: (305) 779-8447<br />
                email: <a href="mailto:email@nvedrani@cfhgroup.com?">nvedrani@cfhgroup.com</a></div>
              <div class="sml_div">
                <h3><span>Commercial</span></h3>
                Ivan Fuentes / Director of Operations<br />
                Ph:(305) 779-8040 ext 2115<br />
                Fax: (305) 779-8348<br />
                email: <a href="mailto:email@Ifuentes@cfhgroup.com?">Ifuentes@cfhgroup.com</a><br />
                <br />
                <h3><span>Customer Service</span></h3>
                email: <a href="mailto:email@customerservice@cfhgroup.com?">customerservice@cfhgroup.com</a> </div>-->
              <div class="clear"></div>
            </div> <div class="clear"></div>
          </div>
</form>
      <div class="clear"></div>
    </div><div class="clear"></div>
  </div>