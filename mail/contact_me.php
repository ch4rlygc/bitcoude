<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['message'])	  ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	$arrContact = array('status' => 'fail', 'message' => 'Lo siento, todos los campos son requeridos.');
		print json_encode($arrContact);
		die;
   }

$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];

// Create the email and send the message
$to = 'info@bitcoude.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nMessage:\n$message";
$headers = "From: noreply@bitcoude.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";

if ( mail($to,$email_subject,$email_body,$headers) ) {
	$arrContact = array('status' => 'ok', 'message' => 'Tu mensaje ha sido enviado exitosamente.' );
	print json_encode($arrContact);
	return true;
}
else {
	$arrContact = array('status' => 'fail' => 'message' => 'Al parecer ocurrió un problema al enviar el correo, inténtalo de nuevo.' );
	print json_encode($arrContact);
	return false;
}
else {
	$arrContact = array('status' => 'fail' => 'message' => 'No se pudo enviar tu mensaje.');
	print json_encode($arrContact);
	return false;
}
die;

?>
