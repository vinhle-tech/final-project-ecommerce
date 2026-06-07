<?php
// Debug page — remove when done
session_start();
$cookieParams = session_get_cookie_params();
?><!doctype html>
<html>
<head><meta charset="utf-8"><title>Auth Debug</title></head>
<body>
<h2>Session Debug</h2>
<ul>
<li><strong>session_id()</strong>: <?php echo session_id(); ?></li>
<li><strong>session cookie params</strong>: <?php echo htmlspecialchars(json_encode($cookieParams)); ?></li>
<li><strong>$_SESSION</strong>: <pre><?php var_export($_SESSION); ?></pre></li>
<li><strong>$_COOKIE</strong>: <pre><?php var_export($_COOKIE); ?></pre></li>
<li><strong>HTTP_COOKIE header</strong>: <?php echo htmlspecialchars($_SERVER['HTTP_COOKIE'] ?? ''); ?></li>
</ul>
<p>Use this after signing in to confirm PHP session id and cookies.</p>
</body>
</html>