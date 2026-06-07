<?php
session_start();
require_once 'db.php';

$name = trim($_POST['name'] ?? '');
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$name || !$username || !$email || !$password) {
    header('Location: ../pages/sign-up.html');
    exit;
}

$stmt = $conn->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
$stmt->bind_param('ss', $username, $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    header('Location: ../pages/sign-up.html?error=exists');
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare('INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)');
$stmt->bind_param('ssss', $name, $username, $email, $hash);
if ($stmt->execute()) {
    // use connection insert_id and regenerate session id
    $_SESSION['user_id'] = $conn->insert_id;
    $_SESSION['user_name'] = $name;
    session_regenerate_id(true);
    // set session cookie explicitly (HttpOnly)
    setcookie(session_name(), session_id(), 0, '/', '', false, true);
    // fallback cookies to restore session if PHP session cookie fails
    setcookie('user_id', $conn->insert_id, time() + 3600, '/', '', false, true);
    setcookie('user_name', $name, time() + 3600, '/', '', false, true);
    // non-HttpOnly flag to let client-side script detect login state
    setcookie('user_present', '1', time() + 3600, '/');
    header('Location: ../pages/myAccount.php?created=1');
    exit;
} else {
    header('Location: ../pages/sign-up.html?error=unable');
    exit;
}