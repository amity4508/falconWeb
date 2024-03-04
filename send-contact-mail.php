<?php 
	//echo phpinfo(); exit;
	include_once("common.php");
	include_once('smtp/PHPMailerAutoload.php');
	
	
	$name=trim($_POST['name']);
	$mobile=trim($_POST['mobile']);
	$email=trim($_POST['email']);	
	$website=trim($_POST['website']);	
    $message=isset($_POST['message'])?trim($_POST['message']):'';
	
	$redirect='https://www.falconcorporation.in/index.php';
	
	$errors = '';
	
	function IsInjected($str)
	{
	  $injections = array('(\n+)',
				  '(\r+)',
				  '(\t+)',
				  '(%0A+)',
				  '(%0D+)',
				  '(%08+)',
				  '(%09+)'
				  );
	  $inject = join('|', $injections);
	  $inject = "/$inject/i";
	  if(preg_match($inject,$str))
		{
		return true;
	  }
	  else
		{
		return false;
	  }
	}
	
	if(empty($name))
	{
		$errors .= "\n Name is required.";	
	}
	if(empty($email))
	{
		$errors .= "\n Email is required.";	
	}	
	if(IsInjected($email))
	{
		$errors .= "\n Bad email value!";
	} 
	
	
	if(!empty($errors))
	{
		$_SESSION['err_msg'] = $errors;
		echo '<script language="javascript">';
		echo 'window.history.back();';
		echo '</script>';
	}
	
	
			
	$insertid = $contact_enquiry_obj->add_contact_enquiry(array('contact_enquiry_name'=>$name,'contact_enquiry_mobile'=>$mobile,'contact_enquiry_email'=>$email,'contact_enquiry_website'=>$website,'contact_enquiry_message'=>$message));
	
	$subject='New Enquiry From Falcon Corporation'; 
	
	$body='';
	$body.="<table width=100% border=0 cellspacing=2 cellpadding=2>";
  	$body.="<tr><td colspan=2><hr /><font face=Verdana; size=4px>Enquiry Details</font><hr /></td></tr>";
	
  	
	$body.="<tr><td width=10% bgcolor=#eeeeee><font face=Verdana; size=3px><b>Name</b></font></td><td colspan=3> <font face=Verdana; size=3px>: $name</font></td></tr>";
  	
	$body.="<tr><td bgcolor=#eeeeee><font face=Verdana; size=3px><b>Email</b></font></td><td colspan=3><font face=Verdana; size=3px>: $email</font></td></tr>";
	
	$body.="<tr><td width=10% bgcolor=#eeeeee><font face=Verdana; size=3px><b>Mobile</b></font></td><td colspan=3> <font face=Verdana; size=3px>: $mobile</font></td></tr>";
	
	$body.="<tr><td width=20% bgcolor=#eeeeee><font face=Verdana; size=3px><b>Website </b></font></td><td colspan=3> <font face=Verdana; size=3px>: $website</font></td></tr>";	
	
	$body.="<tr><td bgcolor=#eeeeee><font face=Verdana; size=3px><b>Message</b></font></td><td colspan=3><font face=Verdana; size=3px>: $message</font></td></tr>";	
		
	//$body.="<tr><td bgcolor=#eeeeee><font face=Verdana; size=3px><b>IP Address</b></font></td><td colspan=3><font face=Verdana; size=3px>: $_SERVER[REMOTE_ADDR]</font></td></tr>";
 	$body.="<tr><td colspan=2><hr></td></tr></table>";

	$body .= "<br>";
	
	$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = false;	//3								
	$mail->isSMTP();											
	$mail->Host	 = 'localhost';					
	$mail->SMTPAuth = false;							
	$mail->Username = 'info@falconcorporation.in';	 	
	$mail->Password = '';						
	$mail->SMTPSecure = '';							
	$mail->Port	 = 25;

	$mail->setFrom('info@falconcorporation.in', 'Falcon Corporation');		
	$mail->addAddress('info@falconcorporation.in'); // receiver
	//$mail->addCC('xyz@gmail.com');
	$mail->addBCC('developer.kaif@gmail.com');
	
	$mail->isHTML(true);								
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AltBody = '';
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	$mail->send();
	//echo $body; exit;
	
} catch (Exception $e) {
	//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	//echo "Mail could not be sent. Please contact admin.";
}
	
	if($insertid){
		$_SESSION['msg'] = "Message sent successfully!";
		//header("Location:index.php");
		echo '<script language="javascript">';
			echo 'alert("Thank you for your query. we will contact you soon."); document.location.href="'.$redirect.'";';
			echo '</script>';
			
	}


?>