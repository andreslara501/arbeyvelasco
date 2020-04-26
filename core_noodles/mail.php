<?php
echo "mail";
	// Pear Mail Library
	require_once "Mail.php";

	$from = '<correoarbeyvelasco@gmail.com>';
	$to = '<andreslara501@gmail.com>, <juanfernando115@hotmail.com>';
	$subject = 'Mensaje desde la página web';
	$body = "
		Nombre: {$_POST['nombre']} \n 
		Celular: {$_POST['celular']} \n 
		Correo: {$_POST['correo']} \n
		Mensaje: {$_POST['mensaje']} \n
	";

	$headers = array(
		'From' => $from,
		'To' => $to,
		'Subject' => $subject
	);

	$smtp = Mail::factory('smtp', array(
		'host' => 'ssl://smtp.gmail.com',
		'port' => '465',
		'auth' => true,
		'username' => 'correoarbeyvelasco@gmail.com',
		'password' => 'Billetede20'
	));

	$mail = $smtp->send($to, $headers, $body);

	if (PEAR::isError($mail)) {
		echo('<p>' . $mail->getMessage() . '</p>');
	} else {
		echo('<p>Message successfully sent!</p>');
	}
?>
