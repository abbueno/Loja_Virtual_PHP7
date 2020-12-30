<?php

//$to      = Config::EMAIL_USER;
$to      = 'allanbighibueno@gmail.com';
$subject = 'Contato - Loja Virtual';
$message = $_GET['txtinputarea'];
$headers = 'From: ' . $_GET['txtinputemail'] .' ' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>