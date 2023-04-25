<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/admin-nav.php' ?>


<?php  

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_doctor WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if($res) {
        $row=mysqli_num_rows($res);
        if($row > 0) {
            $rows = mysqli_fetch_assoc($res);
            $full_name = $rows['full_name'];
            $username = $rows['username'];
            $contact = $rows['contact'];
            $password = $rows['password'];
            $email = $rows['email'];
        }
    }
}else {
    header('Location:'.SITEURL.'admin/manage-doctors.php');
}

?>

<!-- Start Add -->
<div class="add">
    <div class="title">Update DOCTORS</div>
    <div class="container">
    <form action="" method="POST">
        <div class="row">
            <label for="full_name">Doctor Name</label>
            <input type="text" name="full_name"  value="<?php echo $full_name; ?>" placeholder="Enter New Name">
        </div>
        <div class="row">
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Enter New Name">
        </div>
        <div class="row">
            <label for="specialization">Specialization</label>
            <select name="specialization" id="specialization">
                <option value="surgery">surgery</option>
                <option value="surgery">surgery</option>
                <option value="surgery">surgery</option>
            </select>
        </div>
        <div class="row">
            <label for="gender">Gender</label>
            <select name="gender" id="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="row">
            <label for="email">Email</label>
            <input type="password" name="email" value="<?php echo $email; ?>" placeholder="Enter New Email">
        </div>
        <div class="row">
            <label for="contact">Contact</label>
            <input type="number" name="contact" value="<?php echo $contact; ?>" placeholder="Enter New Email">
        </div>
        <div class="row">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter New Password">
        </div>
            <input type="submit" name="submit" value="Update Doctors" class="btn-primary">
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
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $specialization = $_POST['specialization'];
    $gender = $_POST['gender'];
    //2. Set Query
    $sql = "UPDATE tbl_doctor SET
    full_name='$full_name',
    username='$username',
    password='$password',
    email='$email',
    contact='$contact',
    gender='$gender',
    specialization='$specialization'
    WHERE id='$id'
    ";
    //3. Excute Query
    $res = mysqli_query($conn, $sql);
    if($res) {
        $_SESSION['update'] = '<h1 class="success">Doctor Has Been Updated Successfully</h1>';
        header('Location:'.SITEURL.'admin/manage-doctors.php');
    }else {
        $_SESSION['update'] = '<h1 class="failed">Failed To Update Doctor</h1>';
        header('Location:'.SITEURL.'admin/manage-doctors.php');
    }
}

?>
