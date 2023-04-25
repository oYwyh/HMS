<?php

// Authn That Your Logged In

if(!isset($_SESSION['doctor-logged-in'])) {
    $_SESSION['no-login-msg'] = '<h1 class="failed">Please Login First</h1>';
    header('Location:'.SITEURL.'login/login.php');
}

?>