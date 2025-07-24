<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/session.php';

startSession();

$_SESSION = array(); // Clear all session variables

if (ini_get("session.use_cookies")) { // Clear any cookies being used -> TODO: double check this
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();

redirect('login.php');
?>