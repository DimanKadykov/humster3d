<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/db/connect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/HttpUtils.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPassword = $_POST['new_password'];
    $confirmNewPassword = $_POST['confirm_new_password'];
    $token = $_POST['token'];
    $newPasswordHash = md5($newPassword);
    
    if ($newPassword != $confirmNewPassword) {
        HttpUtils::addFlash('Passwords are not matched');
        header('Location: /auth/change_password.php?token=' . $token);
        exit;
    }

    $sql = '
            UPDATE user 
            SET password_hash = :new_password_hash,
                restore_pass_token = ""
            WHERE restore_pass_token = :token';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':new_password_hash', $newPasswordHash);
    $stmt->bindParam(':token', $token);
    $stmt->execute();
    
    HttpUtils::addFlash('Password has been successfully changed');
    header('Location: /ImageRoller/');
    exit;
}

$token = empty($_GET['token']) ? null : $_GET['token'];

if (!$token) {
    die('no token');
    header('Location: /ImageRoller/');
}

$sql = 'SELECT * FROM user WHERE restore_pass_token = :token';
$stmt = $db->prepare($sql);
$stmt->bindParam(':token', $token);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    HttpUtils::addFlash('Link for restoring password is invalid');
    header('Location: /ImageRoller/');
    exit;
}

$flashes = HttpUtils::retrieveFlashMessages();

$title = 'Change password - 3dwrapp';
$template = 'change_password.php';
    
require_once 'layout/main.php';