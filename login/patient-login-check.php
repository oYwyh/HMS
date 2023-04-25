<?php

if(!isset($_SESSION['patient-logged-in'])) {
    $_SESSION['no-login-msg'] = '<h1 class="failed">Please Login First</h1>';
    header('location:'.SITEURL.'login/login.php');
}

?>