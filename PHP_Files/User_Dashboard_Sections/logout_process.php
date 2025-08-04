<?php 
    session_start();

// Clear the session variables
$_SESSION = [];

// Destroy the session cookie if any ...
if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
    // time() - 42000   
    // Sets the cookie's expiration time to the past, making it immediately invalid.
    // Arbitrary, but safely ensures expiration (used by convention)
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]
    );
}

// Finally, destroy the session completely
session_destroy();

// Now, redirect to the login page
header("Location: /ProjectIII/PHP_Files/login.php");
exit();
?>