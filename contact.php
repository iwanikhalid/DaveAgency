<html>
<head>
<style>
.alignc { text-align: center; }
span { color: red; }
body { font-size: 12px; background: #fff; font-family: Arial, Helvetica, sans-serif; color: #666; text-align: center; }
td { width: 30%; }
td + td { width: 60%; }
input, textarea { padding: 2px; border: 1px solid #ccc; }
input#submit, input#reset {
background: #00aeef;
color: #fff; 
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
border: 0;
padding: 5px;
font-size: 14px; 
font-weight: bold;
}
</style>
</head>

<body>

<?php

if(isset($_POST['email'])) {
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "iwanikhalid@gmail.com";
    $email_subject = "A feedback from Dave's Agency website";
     
     
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please fix these errors.<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['customer_name']) ||
        !isset($_POST['contact_no']) ||
        !isset($_POST['email']) ||
        !isset($_POST['subject']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $customer_name = $_POST['customer_name']; // required
    $contact_no = $_POST['contact_no']; // required
    $email = $_POST['email']; // required
    $subject = $_POST['subject']; // not required
    $message = $_POST['message']; // required
     
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Customer Name: ".clean_string($customer_name)."\n";
    $email_message .= "Contact No: ".clean_string($contact_no)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Subject: ".clean_string($subject)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
     
     
// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Thank you for contacting us. We will be in touch with you very soon.
 
<?php
} 
?>

<form id="contactFormName" name="contactform" method="post" action="contact.php">
<table>
	<tr>
		<td>Customer's Name:</td>
		<td><input name="customer_name" type="text" /></td>
	</tr>
	<tr>
		<td>Contact Number <span>*</span>:</td>
		<td><input name="contact_no"type="text" /></td>
	</tr>
	<tr>
		<td>E-mail <span>*</span>:</td>
		<td><input name="email" type="text" /></td>
	</tr>
	<tr>
		<td>Subject <span>*</span>:</td>
		<td><input name="subject" type="text" /></td>
	</tr>
	<tr>
		<td>Message <span>*</span>:</td>
		<td><textarea cols="25" rows="5" name="message"></textarea></td>
	</tr>	
	<tr>
		<td>&nbsp;</td>
		<td><span>*</span> Required Field</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>
			<input id="submit" type="submit" />
			<input id="reset" type="reset" />
		</td>
	</tr>
</table>

</form>

</body>
</html>