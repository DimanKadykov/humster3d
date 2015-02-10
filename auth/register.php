<?php

session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/mail.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/HttpUtils.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = $_POST['email'];
    $sql = 'SELECT * FROM user where email = :email';    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($result) 
    {
        HttpUtils::addFlash('User with email ' . $email . ' is already registered');
        goto redirector;
    }
    
    $user = new User($db);
    $user->fromArray($_POST);
    
    $errorsReg = $user->validate();
    
    if(empty($errorsReg))
    {
        $user->generateRegistrationConfirmToken();
        $user->save();
        $mail->addAddress($email);
        $mail->isHTML(true); 

        $mail->Subject = 'Registration confirmation';
        $mail->Body    = 'To confirm your registration follow this <a href="http://3dwrapapp.com/auth/registration_confirm.php?token=' . $user->getRegistrationConfirmToken() . '">link</a>';
        $mail->send();
        
        HttpUtils::addFlash('User ' . $user->getFirstName() . ' ' . $user->getLastName() . ' has been successfully registered. You need to confirm your account via email');
        
        redirector: {
            header('Location: /ImageRoller/');
        }    
    } else {
        require_once 'login.php';
        exit;
    }
}