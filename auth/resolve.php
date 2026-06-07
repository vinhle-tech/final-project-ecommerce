<?php
session_start();
// Absolute app path
$root = '/final-project-ecommerce-main';
if (isset($_SESSION['user_id'])) {
    header('Location: ' . $root . '/pages/myAccount.php');
    exit;
}
header('Location: ' . $root . '/pages/sign-in.html');
exit;
