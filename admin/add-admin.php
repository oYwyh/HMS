<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/admin-nav.php' ?>


<!-- Start Add -->
<div class="add">
    <div class="title">ADD ADMIN</div>
    <?php 
        if(isset($_SESSION['empty'])) {
            if($_SESSION['empty'] === '<h1 class="failed">One Of The Inputs Is Invalid</h1>') {
                echo $_SESSION['empty'];
                unset($_SESSION['empty']);
            }
        }
    ?>
    <div class="container">
    <form action="" method="POST">
        <div class="row">
            <label for="full_name">Admin Name</label>
            <input type="text" name="full_name" placeholder="Enter Admin Name">
        </div>
        <div class="row">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Enter Admin Username">
        </div>
        <div class="row">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter Admin Password">
        </div>
            <input type="submit" name="submit" value="Add Doctors" class="btn-primary">
        </form>
    </div>
</div>

<?php include_once '../partials/footer.php' ?>

<?php

if(isset($_POST['submit'])) {
    //1. Get Data
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    if($full_name == '' or $username == '' or $password == '') {
        $_SESSION['empty'] = '<h1 class="failed">One Of The Inputs Is Invalid</h1>';
        header("Refresh:0");
        die();
    }
    //2. Set Query
    $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    ";
    //3. Excute Query
    $res = mysqli_query($conn, $sql);
    if($res) {
        $_SESSION['add'] = '<h1 class="success">Admin Has Been Added Successfully</h1>';
        header('Location:'.SITEURL.'admin/manage-admin.php');
    }else {
        $_SESSION['add'] = '<h1 class="failed">Failed To Add Admin</h1>';
        header('Location:'.SITEURL.'admin/manage-admin.php');
    }
}

?>
