<?php include_once '../config/constans.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">
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
                    <li id="doctor">Doctors</li>
                    <li id="admin">Admin</li>
                </ul>
            </div>
            <?php
                if(isset($_SESSION['login'])) {
                    echo '<br><br>'.$_SESSION['login'];
                    unset($_SESSION['login']);
                }
                
                if(isset($_SESSION['no-login-msg'])) {
                    echo '<br><br>'.$_SESSION['no-login-msg'];
                    unset($_SESSION['no-login-msg']);
                }
                if(isset($_SESSION['logout-msg'])) {
                    echo '<br><br>'.$_SESSION['logout-msg'];
                    unset($_SESSION['logout-msg']);
                }
                if(isset($_SESSION['update_profile'])) {
                    if($_SESSION['update_profile'] == '<h1 class="success">Your Profile Has Been Updated Successfully, Please Login Again</h1>') {
                        echo '<br><br>'.$_SESSION['update_profile'];
                        unset($_SESSION['update_profile']);
                    }
                }
                if(isset($_SESSION['profile_delete'])) {
                    echo '<br><br>'.$_SESSION['profile_delete'];
                    unset($_SESSION['profile_delete']);
                }
            ?>
            <div class="admin-login login-box none" id="login_box admin">
                <div class="title">Admin Login</div>
                <form action="<?php echo SITEURL.'login/admin-login.php' ?>" method="POST">
                    <div class="row">
                        <div class="icon"><i class="fa-solid fa-file-signature"></i></div>
                        <input type="text" name="username" placeholder="Enter Your username or email">
                    </div>
                    <div class="row">
                        <div class="icon"><i class="fa-sharp fa-solid fa-key"></i></div>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </div>
                    <input type="submit" name="submit" class="btn-primary" value="Login">
                </form>
            </div>
            <div class="doctor-login login-box none" id="login_box doctor">
                <div class="title">Doctors Login</div>
                <form action="<?php echo SITEURL.'login/doctor-login.php' ?>" method="post">
                    <div class="row">
                        <div class="icon"><i class="fa-solid fa-file-signature"></i></div>
                        <input type="text" name="username" placeholder="Enter Your username or email">
                    </div>
                    <div class="row">
                        <div class="icon"><i class="fa-sharp fa-solid fa-key"></i></div>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </div>
                    <input type="submit" name="submit" class="btn-primary" value="Login">
                </form>
            </div>
            <div class="patient-login login-box" id="login_box patient">
                <div class="title">Patient Login</div>
                <form action="<?php echo SITEURL.'login/patient-login.php' ?>" method="POST">
                    <div class="row">
                        <div class="icon"><i class="fa-solid fa-file-signature"></i></div>
                        <input type="text" name="username" placeholder="Enter Your Username">
                    </div>
                    <div class="row">
                        <div class="icon"><i class="fa-sharp fa-solid fa-key"></i></div>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </div>
                    <input type="submit" name="submit" class="btn-primary" value="Login">
                </form>
                <div class="sign-up">Dont Have An Account, <a href="../sign-up/sign-up.php">Sign Up</a></div>
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