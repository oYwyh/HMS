<?php 

include_once '../config/constans.php';

if(isset($_POST['submit'])) {
        echo 'hi';

        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn ,md5($_POST['password']));

        $sql = "SELECT * FROM tbl_doctor WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        if($res) {
            $row=mysqli_num_rows($res);
    
            if($row==1) {
                // User Avaliable & Login Succes => Diffrent UserName
                $rows=mysqli_fetch_assoc($res);
                $_SESSION['doctor_name'] = $rows['full_name'];
                $_SESSION['login'] = '<h1 class="success">Login Succesful</h1>';
                $_SESSION['doctor-logged-in'] = '';
                header('Location:'.SITEURL.'doctor/index.php');
            }else {
                // User Does Not Avaliable & Login Failes => Diffrent UserName
                $_SESSION['login'] = '<h1 class="failed">Failed To Login</h1>';
                header('Location:'.SITEURL.'login/login.php');
            }
        }
        
    }
?>