<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/admin-nav.php' ?>


<!-- Start Add -->
<div class="add">
    <div class="title">ADD DOCTORS</div>
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
            <label for="full_name">Doctor Name</label>
            <input type="text" name="full_name" placeholder="Enter Your Name">
        </div>
        <div class="row">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Enter Your Name">
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
            <input type="email" name="email" placeholder="Enter Your Email">
        </div>
        <div class="row">
            <label for="contact">Contact</label>
            <input type="number" name="contact" placeholder="Enter Your Email">
        </div>
        <div class="row">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter Your Password">
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
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $specialization = $_POST['specialization'];
    $gender = $_POST['gender'];
    if($full_name == '' or $username == '' or $password == '' or $contact == '' or $email == '') {
        $_SESSION['empty'] = '<h1 class="failed">One Of The Inputs Is Invalid</h1>';
        header("Refresh:0");
        die();
    }
    //2. Set Query
    $sql = "INSERT INTO tbl_doctor SET
    full_name='$full_name',
    username='$username',
    password='$password',
    email='$email',
    contact='$contact',
    gender='$gender',
    specialization='$specialization'
    ";
    //3. Excute Query
    $res = mysqli_query($conn, $sql);
    if($res) {
        $_SESSION['add'] = '<h1 class="success">Doctor Has Been Added Successfully</h1>';
        header('Location:'.SITEURL.'admin/manage-doctors.php');
    }else {
        $_SESSION['add'] = '<h1 class="failed">Failed To Add Doctor</h1>';
        header('Location:'.SITEURL.'admin/manage-doctors.php');
    }
}

?>
