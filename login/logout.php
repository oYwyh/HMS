<?php 

include_once '../config/constans.php';

    //1. Delete Session
    unset($_SESSION["doctor-logged-in"]);
    unset($_SESSION["admin-logged-in"]);
    unset($_SESSION["patient-logged-in"]);
    //2. Set Logout Success Seccion MsgL
    $_SESSION['logout-msg'] = '<h1 class="success">Logout Succesfully</h1>';
    //3. Redirect
    header('location:'.SITEURL.'login/login.php');

?>