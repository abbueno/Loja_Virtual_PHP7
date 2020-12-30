<?php

//$to      = Config::EMAIL_USER;
$to      = 'allanbighibueno@gmail.com';
$subject = 'Contato - Loja Virtual';
$message = 'Email de'.$_GET['txtinputnome']. "\r\n" .$_GET['txtinputarea'];
$dest = $_GET['txtinputemail'];

$headers = "From: " .$dest;

mail($to, $subject, $message, $headers);
?>