<?php

session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/mail.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/db/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/HttpUtils.php';

$token = empty($_GET['token']) ? null : $_GET['token'];

if (!$token) {
    die('no token');
    header('Location: /ImageRoller/');
}

$sql = '
        UPDATE user 
        SET is_active = 1
        WHERE registration_confirm_token = :token';
$stmt = $db->prepare($sql);
$stmt->bindParam(':token', $token);
$stmt->execute();

HttpUtils::addFlash('Your account has been activated. try to log in with your email and password');
header('Location: /ImageRoller/');
exit;