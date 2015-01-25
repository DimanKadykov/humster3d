<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/db/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/HttpUtils.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $user = new User($db);
    $user->fromArray($_POST);
    
    $errorsReg = $user->validate();
    
    if(empty($errorsReg)) 
    {
        $user->save();
        HttpUtils::addFlash('User ' . $user->getFirstName() . ' ' . $user->getLastName() . ' has been successfully registered');
        
        header('Location: /ImageRoller/');
    } else {
        require_once 'login.php';
        exit;
    }    
}