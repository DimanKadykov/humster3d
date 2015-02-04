<?php

// email-smtp.us-west-2.amazonaws.com

require_once 'PHPMailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();

$mail->Host = 'email-smtp.us-west-2.amazonaws.com';               // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                                           // Enable SMTP authentication
$mail->Username = 'AKIAIQVINUJFVT55FQJA';                         // SMTP username
$mail->Password = 'AqxCzVw1lbfMMEW+eNrGhMM6uPpfsm6ebLLKxp+sUnG0'; // SMTP password
$mail->SMTPSecure = 'tls';                                        // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;  