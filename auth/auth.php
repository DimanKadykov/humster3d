<?php

session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/HttpUtils.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/User.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = 'SELECT * FROM user where email = :email';    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $loginErrors = [];
    
    if(!$result) {
        $loginErrors[]= 'No such user or password is incorrect'; 
    } else {
        if(md5($password) != $result['password_hash']) {
            $loginErrors[]= 'No such user or password is incorrect'; 
        }
    }
    
    if(empty($loginErrors)) {
        $_SESSION['auth'] = '1';
        $_SESSION['uid'] = $result['id']; 
        $_SESSION['first_name'] = $result['first_name'];
        $_SESSION['lsrst_name'] = $result['last_name'];
        
        header('Location: /ImageRoller/');
    }
}

$flashes = HttpUtils::retrieveFlashMessages();

if(empty($_SESSION['auth'])) 
{
    require_once 'login.php';
    exit;
}