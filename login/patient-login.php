<?php

include_once '../config/constans.php';

if(isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_patient WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn , $sql);

    if($res) {
        $row = mysqli_num_rows($res);
        if($row==1) {
            $rows=mysqli_fetch_assoc($res);
            $_SESSION['patient_name'] = $rows['full_name'];
            $_SESSION['login'] = '<h1 class="success">Login Succesful</h1>';
            $_SESSION['patient-logged-in'] = '';
            header('location:'.SITEURL.'patient/index.php');
        }else {
            $_SESSION['login'] = '<h1 class="failed">Failed To Login</h1>';
            header('location:'.SITEURL.'login/login.php');
        }
    }else {
        $_SESSION['login'] = '<h1 class="failed">Failed To Log In</h1>';
        header('location:'.SITEURL.'login/login.php');
    }
}

?>