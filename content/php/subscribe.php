<?php

function email($email, $message){
	$url = 'https://api.sendgrid.com/';
	$user = '';
	$pass = '';

	$json_string = array(

	  'to' => array(
	    'daniel@abnoba.io'
	  ),
	  'category' => 'contact_form'
	);

	$text = "From: $email\n\n$message";

	$params = array(
	    'api_user'  => $user,
	    'api_key'   => $pass,
	    'x-smtpapi' => json_encode($json_string),
	    'to'        => 'edaniel@abnoba.io',
	    'subject'   => 'Contact Form Submission',
	    'html'      => nl2br($text),
	    'text'      => $text,
	    'from'      => 'info@abnoba.io',
	  );


	$request =  $url.'api/mail.send.json';

	// Generate curl request
	$session = curl_init($request);
	// Tell curl to use HTTP POST
	curl_setopt ($session, CURLOPT_POST, true);
	// Tell curl that this is the body of the POST
	curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
	// Tell curl not to return headers, but do return the response
	curl_setopt($session, CURLOPT_HEADER, false);
	// Tell PHP not to use SSLv3 (instead opting for TLS)
	curl_setopt($session, CURLOPT_SSLVERSION, 'CURL_SSLVERSION_TLSv1_2');
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

	// obtain response
	$response = curl_exec($session);
	curl_close($session);

	// print everything out
	// print_r($response);
}

if ( isset( $_POST['newsletter_submit'] ) ) {
	// Initialize error array
	$newsletter_errors = array();

	// Check email input field
	if ( trim( $_POST['contact_email'] ) === '' )
		$newsletter_errors[] = 'Email address is required';
	elseif ( !preg_match( "/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,4}$/i", trim( $_POST['contact_email'] ) ) )
		$newsletter_errors[] = 'Email address is not valid'; 
	else
		$contact_email = trim( $_POST['contact_email'] );
	
	if ( trim( $_POST['contact_message'] ) === '' )
		$newsletter_errors[] = 'Please enter a message';
	else
		$contact_message = trim( $_POST['contact_message'] );

	// Send email if no input errors
	if ( empty( $newsletter_errors ) ) {
		email($contact_email, $contact_message);
		echo 'Thank you for message. We will get back to you within one business day.';
	} else {
		echo 'Please go back and correct the following errors:<br />';
		foreach ( $newsletter_errors as $error ) {
			echo $error . '<br />';
		}
	}
}
?>
