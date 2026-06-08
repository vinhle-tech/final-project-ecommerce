<?php
// Returns a JSON object with the proper profile link based on session
session_start();
$base = dirname($_SERVER['SCRIPT_NAME']);
// compute app root path like /final-project-ecommerce-main
$parts = explode('/', trim($base, '/'));
$appRoot = '/' . ($parts[0] ?? '');
// explicit root to ensure correct path
$appRoot = '/final-project-ecommerce-main';
$href = $appRoot . '/pages/sign-in.html';
if (isset($_SESSION['user_id'])) {
    $href = $appRoot . '/pages/myAccount.php';
}
header('Content-Type: application/json');
echo json_encode(['href' => $href]);
