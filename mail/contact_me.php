<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
// use actual sendgrid username and password in this section
$url = 'https://api.sendgrid.com/';
 // grabs HTML form's post data; if you customize the form.html parameters then you will need to reference their new new names here
$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$user = getenv(SENDGRID_USERNAME);
$key = getenv(SENDGRID_PASSWORD);
// note the above parameters now referenced in the 'phone', 'html', and 'text' sections
// make the to email be your own address or where ever you would like the contact form info sent
 $params = array(
      'api_user' => "app56505530@heroku.com",
      'api_key' => "4uugFG45673472gh5675HFv789kshg871745423",
      'to' => "nathanielcfa@gmail.com", // set TO address to have the contact form's email content sent to
      'subject' => "cewaccounting.com Contact Form:  $name ($email)", // Either give a subject for each submission, or set to $subject
      'html' => "<html><head><title>Contact Form</title><body>
       Name: $name\n<br>
       Email: $email\n<br>
       Phone: $phone\n<br>
       Message: $message <body></title></head></html>", // Set HTML here.  Will still need to make sure to reference post data names,
      'text' => "
       Name: $name\n
       Email: $email\n
       Subject: $phone\n
       Message: $message",
      'from' => 'noreply@cewaccounting.com', // set from address here, it can really be anything
   );
 curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
 $request = $url.'api/mail.send.json';
 // Generate curl request
 $session = curl_init($request);
 // Tell curl to use HTTP POST
 curl_setopt ($session, CURLOPT_POST, true);
 // Tell curl that this is the body of the POST
 curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
 // Tell curl not to return headers, but do return the response
 curl_setopt($session, CURLOPT_HEADER, false);
 curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
 // obtain response
 $response = curl_exec($session);
 curl_close($session);
 // print everything out
 print_r($response);

?>
