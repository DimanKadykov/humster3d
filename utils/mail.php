<?php

// email-smtp.us-west-2.amazonaws.com

require_once 'PHPMailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();

$mail->Host = 'email-smtp.us-west-2.amazonaws.com';               // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                                           // Enable SMTP authentication
$mail->Username = 'AKIAIJ3ER5XDRHNLQUSA';                         // SMTP username
$mail->Password = 'ApjBf2z9uMndOUqBRqeIpijMBldWkrz5B3SUk96NFJ2t'; // SMTP password
$mail->SMTPSecure = 'tls';                                        // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;  