<?php

include_once '../config/constans.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_admin WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if($res) {
        $_SESSION['delete'] = '<h1 class="success">Admin Has Been Deleted Successfully</h1>';
        header('Location:'.SITEURL.'admin/manage-admin.php');
    }else {
        $_SESSION['delete'] = '<h1 class="failed">Failed To Delete Admin</h1>';
        header('Location:'.SITEURL.'admin/manage-admin.php');
    }
}else {
    header('location:'.SITEURL.'admin/manage-admin.php');
}


?>