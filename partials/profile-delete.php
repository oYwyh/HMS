<?php include_once '../config/constans.php'; ?>
<?php

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        if(isset($_SESSION['patient_name'])) {
            $sql2 = "DELETE FROM tbl_patient WHERE id=$id";
            $res2 = mysqli_query($conn, $sql2);
            if($res2) {
                $_SESSION['profile_delete'] = "<h1 class='success'>We Are Sad Seeing You Quitting :(</h1>";
                $oldpath = '../assets/images/profiles_pics/'.$image_name;
                unlink($oldpath);
                header('Location:'.SITEURL.'login/login.php');
            }
        }
    }
?>