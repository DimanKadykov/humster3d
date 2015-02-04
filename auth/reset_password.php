<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/mail.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/HttpUtils.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = $_POST['email'];
    
    $sql = 'SELECT * FROM user where email = :email';    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $loginErrors = [];
    
    if(!$result) {
        $loginErrors[]= 'No user found with email ' . $email; 
    }
    
    if(empty($loginErrors)) {
        $token = md5($email) . md5(microtime());
        
        $sql = '
            UPDATE user 
            SET restore_pass_token = :token
            WHERE email = :email';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        
        $mail->From = 'noreply@sharklasers.com';
        $mail->FromName = 'Mailer';
        $mail->addAddress($email);
        $mail->isHTML(true); 

        $mail->Subject = 'Resstore password';
        $mail->Body    = 'To change password follow this <a href="http://3dwrapapp.com/auth/change_password.php?token=' . $token . '">link</a>';
        $mail->send();
        
        HttpUtils::addFlash('Link for changing password has been sent to your email');

//        if(!$mail->send()) {
//            echo 'Message could not be sent.';
//            echo 'Mailer Error: ' . $mail->ErrorInfo;
//        } else {
//            echo 'Message has been sent';
//        }
        
//        exit;
        
        header('Location: /ImageRoller/');
    }
}

$title = 'Restore password - 3dwrapp';
$template = 'restore_password.php';
    
require_once 'layout/main.php';