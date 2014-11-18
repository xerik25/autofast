<?php



if(!$_POST) exit;



function tommus_email_validate($email) { return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $email); }


$name = $_POST['name']; 
$email = $_POST['email']; 
$phone = $_POST['phone']; 
$origincity = $_POST['origincity'];
$originstate = $_POST['originstate'];
$originzip = $_POST['originzip'];
$destcity = $_POST['destcity'];
$deststate = $_POST['deststate'];
$destzip = $_POST['destzip'];
$vehicletype = $_POST['vehicletype'];
$vehiclemake = $_POST['vehiclemake'];
$vehiclemodel = $_POST['vehiclemodel'];
$vehicleyear = $_POST['vehicleyear'];
$pickup = $_POST['pickup'];
$dropoff = $_POST['dropoff'];
$operational = $_POST['operational'];
$comments = $_POST['comments']; 

$file = 'log.txt';
file_put_contents($file, print_r($_POST,true));


if(trim($name) == '') {

	exit('<div class="error_message">Attention! You must enter your name.</div>');

} else if(trim($name) == 'Name') {

	exit('<div class="error_message">Attention! You must enter your name.</div>');

} else if(trim($email) == '') {

	exit('<div class="error_message">Attention! Please enter a valid email address.</div>');

} else if(!tommus_email_validate($email)) {

	exit('<div class="error_message">Attention! You have entered an invalid e-mail address.</div>');

} else if(trim($comments) == 'Comment') {

	exit('<div class="error_message">Attention! Please enter your message.</div>');

} else if(trim($comments) == '') {

	exit('<div class="error_message">Attention! Please enter your message.</div>');

} if(get_magic_quotes_gpc()) { $comments = stripslashes($comments); }



$address = 'xerik25@gmail.com';



$e_subject = 'FastQuote You\'ve been contacted by ' . $name . '.';

$e_body = "You have been contacted by $name from your contact form, their additional message is as follows." . "\r\n" . "\r\n";

//$e_content = "\"$comments\"" . "\r\n" . "\r\n" . "\"$origincity\"";
$e_content = 
  "Name:" . "\"$name\"" . "\r\n" .  
  "Phone:" . "\"$phone\"" . "\r\n" .  
  "Email:" . "\"$email\"" . "\r\n" .  
  "Origin City:" . "\"$origincity\"" . "\r\n" .  
  "Origin State:" . "\"$originstate\"" . "\r\n" . 
  "Origin Zip:" . "\"$originzip\"" . "\r\n" . 
  "Destination City:" . "\"$origincity\"" . "\r\n" .  
  "Destination State:" . "\"$originstate\"" . "\r\n" . 
  "Destination Zip:" . "\"$originzip\"" . "\r\n" . 
  "Vehicle Type:" . "\"$vehicletype\"" . "\r\n" . 
  "Make:" . "\"$vehiclemake\"" . "\r\n" . 
  "Model:" . "\"$vehiclemodel\"" . "\r\n" . 
  "Year:" . "\"$vehicleyear\"" . "\r\n" . 
  "Pickup Location:" . "\"$pickup\"" . "\r\n" . 
  "Dropoff Location:" . "\"$dropoff\"" . "\r\n" . 
  "Operational:" . "\"$operational\"" . "\r\n" . 
  "\"$comments\"" . "\r\n" . "\r\n";

$e_reply = "You can contact $name via email, $email";



$msg = wordwrap( $e_body . $e_content . $e_reply, 70 );



$headers = "From: $email" . "\r\n";

$headers .= "Reply-To: $email" . "\r\n";

$headers .= "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type: text/plain; charset=utf-8" . "\r\n";

$headers .= "Content-Transfer-Encoding: quoted-printable" . "\r\n";



if(mail($address, $e_subject, $msg, $headers)) { echo "<fieldset><div id='success_page'><h3>Email Sent Successfully.</h3><p>Thank you $name, your message has been submitted to us.</p></div></fieldset>"; }
