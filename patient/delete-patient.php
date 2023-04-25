<?php

include_once '../config/constans.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_appointment WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if($res) {
        $_SESSION['delete'] = '<h1 class="success">Appointment Has Been Canceld Successfully</h1>';
        header('Location:'.SITEURL.'patient/appointment-history.php');
    }else {
        $_SESSION['delete'] = '<h1 class="failed">Failed To Cancel Appointment</h1>';
        header('Location:'.SITEURL.'patient/appointment-history.php');
    }
}

?>