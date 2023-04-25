<?php

include_once '../config/constans.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_patient WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if($res) {
        $_SESSION['delete'] = '<h1 class="success">Patient Has Been Deleted Successfully</h1>';
        header('Location:'.SITEURL.'admin/manage-patient.php');
    }else {
        $_SESSION['delete'] = '<h1 class="failed">Failed To Delete Patient</h1>';
        header('Location:'.SITEURL.'admin/manage-patient.php');
    }
}else {
    header('location:'.SITEURL.'admin/manage-patient.php');
}


?>