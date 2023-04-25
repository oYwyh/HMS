<?php include_once '../config/constans.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/sign-up.css">
</head>
<body>
        <!-- Start Header -->
    <div class="header">
        <div class="logo">HMS</div>
            <ul class="links">
                <li><a href="#"><i class="fa-solid fa-house"></i> Home</a></li>
                <li><a href="#"><i class="fa-solid fa-phone"></i> Contact</a></li>
            </ul>
    </div>
    <!-- End Header -->
    <!-- Start Login -->
    <div class="login">
        <div class="container">
            <div class="login-changer">
                <ul>
                    <li id="patient" class="active">Patient</li>
                </ul>
            </div>
            <?php 
                if(isset($_SESSION['empty'])) {
                    echo $_SESSION['empty'];
                    unset($_SESSION['empty']);
                }
                if(isset($_SESSION['match'])) {
                    echo $_SESSION['match'];
                    unset($_SESSION['match']);
                }
            ?>
            <div class="patient-login login-box" id="login_box patient">
                <div class="title">Patient Login</div>
                <form action="" method="POST">
                    <div class="parent-row">
                        <div class="row">
                            <div class="icon"><i class="fa-solid fa-file-signature"></i></div>
                            <input type="text" name="full_name" placeholder="Enter Your Full Name">
                        </div>
                        <div class="row">
                            <div class="icon"><i class="fa-solid fa-file-signature"></i></div>
                            <input type="text" name="username" placeholder="Enter Your Username">
                        </div>
                    </div>
                    <div class="parent-row">
                        <div class="row">
                            <div class="icon"><i class="fa-solid fa-file-signature"></i></div>
                            <input type="text" name="email" placeholder="Enter Your email">
                        </div>
                        <div class="row">
                            <div class="icon"><i class="fa-solid fa-file-signature"></i></div>
                            <input type="number" name="contact" placeholder="Enter Your Contact Number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="icon"><i class="fa-solid fa-file-signature"></i></div>
                        <input type="text" name="address" placeholder="Enter Your address">
                    </div>
                    <div class="parent-row">
                        <div class="row">
                            <div class="icon"><i class="fa-solid fa-file-signature"></i></div>
                            <input type="number" name="age" placeholder="Enter Age">
                        </div>
                        <div class="row">
                            <div class="icon"><i class="fa-solid fa-file-signature"></i></div>
                            <select name="gender" style="padding: 0.98rem 2rem;">
                                <option value="Select Your Gender" disabled selected>Select Your Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="parent-row">
                        <div class="row">
                            <div class="icon"><i class="fa-sharp fa-solid fa-key"></i></div>
                            <input type="password" name="password" placeholder="Enter Your Password">
                        </div>
                        <div class="row">
                            <div class="icon"><i class="fa-sharp fa-solid fa-key"></i></div>
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </div>
                    </div>
                    <input type="submit" name="submit" class="btn-primary" value="Login">
                </form>
                <div class="login">Already Have An Acount, <a href="../login/login.php">Login</a></div>
                <script>
                    const login_changer = document.querySelectorAll('.login-changer ul li')
                    const login_box = document.querySelectorAll('.login-box')
                    const admin = document.querySelector('.admin-login')
                    const doctor = document.querySelector('.doctor-login')
                    const patient = document.querySelector('.patient-login')
                    login_changer.forEach(changer => {
                        changer.addEventListener('click', () => {
                            changer.classList.remove('active')
                            if(changer.id == 'patient') {
                                patient.classList.remove('none')
                                doctor.classList.add('none')
                                admin.classList.add('none')
                            }else if(changer.id == 'doctor') {
                                doctor.classList.remove('none')
                                admin.classList.add('none')
                                patient.classList.add('none')
                            }else if(changer.id == 'admin') {
                                admin.classList.remove('none')
                                patient.classList.add('none')
                                doctor.classList.add('none')
                            }
                        })
                    });
                </script>
            </div>
        </div>
    </div>
    <!-- End Login -->
</body>
</html>

<?php 

if(isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    if($full_name == '' or $address == '' or $age == '' or $username == '' or $password == '' or $gender == '' or $email == '' or $contact == '' or $confirm_password == '') {
        $_SESSION['empty'] = '<br><br><h1 class="failed">One Of The Inputs Is Invalid</h1>';
        header("Refresh:0");
        die();
    }
    if($password != $confirm_password) {
        $_SESSION['match'] = '<br><br><h1 class="failed">Password Doesn\'t Match</h1>';
        header("Refresh:0");
        die();
    }
        $sql = "INSERT INTO tbl_patient SET
        full_name='$full_name',
        username='$username',
        email='$email',
        address='$address',
        contact='$contact',
        gender='$gender',
        age='$age',
        password='$password'
        ";
        $res = mysqli_query($conn, $sql);
        header('Location:'.SITEURL.'login/login.php');
}

?>