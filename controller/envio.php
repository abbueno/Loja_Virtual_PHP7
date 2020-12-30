<?php
$to      = $_POST['email'];
$subject = 'Contato - Loja Virtual';
$message = $_POST['subject'];
$headers = 'From: '. Config::EMAIL_HOST .' ' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>