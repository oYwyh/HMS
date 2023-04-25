<?php

include_once '../config/constans.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_doctor WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if($res) {
        $_SESSION['delete'] = '<h1 class="success">Doctor Has Been Deleted Successfully</h1>';
        header('Location:'.SITEURL.'admin/manage-doctors.php');
    }else {
        $_SESSION['delete'] = '<h1 class="failed">Failed To Delete Doctor</h1>';
        header('Location:'.SITEURL.'admin/manage-doctors.php');
    }
}else {
    header('location:'.SITEURL.'admin/manage-doctors.php');
}


?>