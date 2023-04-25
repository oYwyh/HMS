<?php include_once '../config/constans.php' ?>

<?php

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM tbl_appointment WHERE id=$id";

    $res = mysqli_query($conn,$sql);

    if($res) {
        $_SESSION['cancel'] = '<h1 class="success">Appointment Has Been Canceled Successfully</h1>';
        header("Location:".SITEURL."doctor/view-appointment.php");
    }else {
        $_SESSION['cancel'] = '<h1 class="failed">Failed To Cancel Appointment! Try Again</h1>';
        header("Location:".SITEURL."doctor/view-appointment.php");
    }
}

?>