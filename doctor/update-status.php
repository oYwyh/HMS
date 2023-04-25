<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/doctor-nav.php' ?>


<?php

if(isset($_GET['id']) && isset($_GET['normal'])) {
    $id = $_GET['id'];
?>
<!-- Start Add -->
<div class="add">
    <div class="title">ADD DOCTORS</div>
    <?php 
        if(isset($_SESSION['empty'])) {
            echo $_SESSION['empty'];
            unset($_SESSION['empty']);
        }
    ?>
    <div class="container">
    <form action="" method="POST">
        <div class="row">
            <label for="status">Update Status</label>
            <select name="status">
                <option value="" disabled selected>Select An Option</option>
                <option value="Canceled By Doctor">Canceled By Doctor</option>
                <option value="Accepted">Accepted</option>
                <option value="On Progress">On Progress</option>
            </select>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Status" class="btn-primary">
        </form>
    </div>
</div>
<?php include_once '../partials/footer.php' ?>
<?php
if(isset($_POST['submit'])) {
    if(isset($_POST['status'])) {
        //1. Get Data
        $id = $_POST['id'];
        $status = $_POST['status'];
        if($status == '') {
            $_SESSION['empty'] = '<h1 class="failed">Invalid Value</h1>';
            header("Refresh:0");
            die();
        }
        //2. Set Query
        $sql = "UPDATE tbl_appointment SET status='$status' WHERE id='$id'";
        //3. Excute Query
        $res = mysqli_query($conn, $sql);
        if($res) {
            $_SESSION['update'] = '<h1 class="success">Appointment Has Been Added Successfully</h1>';
            header('Location:'.SITEURL.'doctor/view-appointment.php');
        }else {
            $_SESSION['update'] = '<h1 class="failed">Failed To Add Appointment</h1>';
            header('Location:'.SITEURL.'doctor/view-appointment.php');
        }
    }
}

?>

<?php
}elseif(isset($_GET['id']) && isset($_GET['status'])) {
    //1. Get Data
    $id = $_GET['id'];
    $status = $_GET['status'];
    //2. Set Query
    $sql = "UPDATE tbl_appointment SET status='$status' WHERE id='$id'";
    //3. Excute Query
    $res = mysqli_query($conn, $sql);
    if($res) {
        $_SESSION['update'] = '<h1 class="success">Status Has been Updated Succesfully</h1>';
        header('Location:view-appointment.php');
    }else {
        $_SESSION['update'] = '<h1 class="failed">Failed To Update</h1>';
        header('Location:view-appointment.php');
    }

}

?>

