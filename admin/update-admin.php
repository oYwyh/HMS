<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/admin-nav.php' ?>


<?php  

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_admin WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if($res) {
        $row=mysqli_num_rows($res);
        if($row > 0) {
            $rows = mysqli_fetch_assoc($res);
            $full_name = $rows['full_name'];
            $username = $rows['username'];
            $password = $rows['password'];
        }
    }
}else {
    header('Location:'.SITEURL.'admin/manage-admin.php');
}

?>

<!-- Start Add -->
<div class="add">
    <div class="title">Update Admin</div>
    <div class="container">
    <form action="" method="POST">
        <div class="row">
            <label for="full_name">Admin Name</label>
            <input type="text" name="full_name"  value="<?php echo $full_name; ?>" placeholder="Enter Admin New Name">
        </div>
        <div class="row">
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Enter Admin New Name">
        </div>
        <div class="row">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter Admin New Password">
        </div>
            <input type="submit" name="submit" value="Update Admin" class="btn-primary">
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
    //2. Set Query
    $sql = "UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    WHERE id='$id'
    ";
    //3. Excute Query
    $res = mysqli_query($conn, $sql);
    if($res) {
        $_SESSION['update'] = '<h1 class="success">Admin Has Been Updated Successfully</h1>';
        header('Location:'.SITEURL.'admin/manage-admin.php');
    }else {
        $_SESSION['update'] = '<h1 class="failed">Failed To Update Admin</h1>';
        header('Location:'.SITEURL.'admin/manage-admin.php');
    }
}

?>
