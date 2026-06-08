<?php
session_start();
require_once 'db.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare('SELECT id, name, password FROM users WHERE email = ? OR username = ?');
$stmt->bind_param('ss', $email, $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $name, $hash);
    $stmt->fetch();
    if (password_verify($password, $hash)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $name;
        // regenerate session id to prevent fixation and ensure session cookie is set
        session_regenerate_id(true);
        // set session cookie explicitly (HttpOnly)
        setcookie(session_name(), session_id(), 0, '/', '', false, true);
        // fallback cookies to restore session if PHP session cookie fails
        setcookie('user_id', $id, time() + 3600, '/', '', false, true);
        setcookie('user_name', $name, time() + 3600, '/', '', false, true);
        // non-HttpOnly flag to let client-side script detect login state
        setcookie('user_present', '1', time() + 3600, '/');
        header('Location: ../pages/myAccount.php');
        exit;
    }
}
header('Location: ../pages/sign-in.html?error=invalid');