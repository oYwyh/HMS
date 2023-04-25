<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/patient-nav.php' ?>


<!-- Start Add -->
<div class="profile">
    <div class="title" style="text-align: center;">Patient Profile</div>
    <div class="container">
    <?php
            if(isset($_SESSION['update_profile'])) {
                if($_SESSION['update_profile'] === '<h1 class="failed">Failed To Update You Profile, Try Again</h1>') {
                    echo $_SESSION['update_profile'];
                    echo '<br><br>';
                    unset($_SESSION['update_profile']);
                }
            }
        if(isset($_SESSION['password_error'])) {
            if($_SESSION['password_error'] === '<h1 class="failed">Current Password Isn\'t Correct</h1>') {
                echo $_SESSION['password_error'];
                unset($_SESSION['password_error']);
                echo '<br><br>';
            }
        }
        if(isset($_SESSION['big_size'])) {
                echo $_SESSION['big_size'];
                echo '<br><br>';
                unset($_SESSION['big_size']);
        }
        if(isset($_SESSION['wrong_ext'])) {
            echo $_SESSION['wrong_ext'];
            echo '<br><br>';
            unset($_SESSION['wrong_ext']);
        }
        if(isset($_SESSION['pic_error'])) {
            echo $_SESSION['pic_error'];
            echo '<br><br>';
            unset($_SESSION['pic_error']);
        }
        if(isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            echo '<br><br>';
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['empty'])) {
            echo $_SESSION['empty'];
            echo '<br><br>';
            unset($_SESSION['empty']);
        }
    ?>
    <?php 
        $patient_name = $_SESSION['patient_name'];
        $sql = "SELECT * FROM tbl_patient WHERE full_name='$patient_name'";
        $res = mysqli_query($conn, $sql);
        if($res) {
            $row =mysqli_num_rows($res);
            if($row>0) {
                $rows=mysqli_fetch_assoc($res);
                $id=$rows['id'];
                $username = $rows['username'];
                $image_name = $rows['image_name'];
                $current_password = $rows['password'];
                $gender = $rows['gender'];
                $email = $rows['email'];
                $address = $rows['address'];
                $contact = $rows['contact'];
                $age = $rows['age'];
            }
        }
    ?>
        <div class="row">
            <div class="column">
            <img class="profile-pic" src="
                <?php 
                if($image_name != '') {
                    echo "../assets/images/profiles_pics/".$image_name;
                }else {
                    echo "../assets/images/profiles_pics/default_profile_pic.jpeg";
                }
            ?>" alt="">        
                <div class="row">
                    <a href="#" id="add_pic_btn" class="change-pic">Update Picture</a>
                    <form method="POST" enctype="multipart/form-data" id="pic_form" style="display:none;">
                        <input type="file" name="profile_pic" id="profile_pic">
                        <input type="submit" class="update" name="submit_pic" value="Update" style="cursor:pointer; outline:none; border:none;">
                        <?php
                        
                        if(isset($_POST['submit_pic']) && isset($_FILES['profile_pic'])) {

                            $img_name = $_FILES['profile_pic']['name'];
                            $img_size = $_FILES['profile_pic']['size'];
                            $tmp_name = $_FILES['profile_pic']['tmp_name'];
                            $error = $_FILES['profile_pic']['error'];

                            if($error == 0) {
                                if($img_size > 250000) {
                                    die();
                                }else {

                                    $oldpath = '../assets/images/profiles_pics/'.$image_name;
                                    unlink($oldpath);

                                    $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
                                    $img_ext_lc = strtolower($img_ext);
                                    $allowed_ext = ['jpg','jpeg','png'];
                                    if(in_array($img_ext_lc, $allowed_ext)) {
                                        $new_img_name = 'Profile_Pic_'.date("Y-d-h-i-s").'.'.$img_ext_lc;
                                        $path = '../assets/images/profiles_pics/'.$new_img_name;
                                        $upload = move_uploaded_file($tmp_name, $path);
                                        
                                        $sql = "UPDATE tbl_patient SET
                                        image_name='$new_img_name'
                                        WHERE full_name='$patient_name'
                                        ";
                                        $res = mysqli_query($conn, $sql);
                                        if($res) {
                                            $_SESSION['upload'] = '<h1 class="success">Image Uploaded Succesfully</h1>';
                                            header('Refresh: 0');
                                        }
                                        if(!$upload) { 
                                            $_SESSION['upload'] = '<h1 class="failed">Failed To Upload The Image</h1>';
                                            header('Location:'.SITEURL.'admin/manage-category.php');
                                            // Stopping The Procces To Not Upload To The DB
                                            die();
                                        }
                                    }else {
                                        $_SESSION['wrong_ext'] = "<h1 class='failed'>Sorry, You Can't Use This File Type</h1>";
                                        header("Refresh: 0");
                                        die();
                                    }
                                }
                            }else {
                                $_SESSION['pic_error'] = "<h1 class='failed'>error</h1>";
                                header("Refresh: 0");
                                // $em = "unknown";
                                // header("Location: patient-profile.php?error=$em");
                            }
                        }else {
                        }
                        
                        ?>
                    </form>
                </div>
                <script>
                    const add_pic_btn = document.getElementById('add_pic_btn');
                    const pic_form = document.getElementById('pic_form')

                    add_pic_btn.addEventListener('click', () => {
                        pic_form.style.display = 'block';
                    })
                </script>
            </div>
            <div class="column">
                <div class="patient-name"><?php echo $patient_name ?></div>
            </div>
        </div>
        <div class="row">
            <div class="options column">
                <a href="#" class="update" id="update-profile">Update Profile</a>
                <a href='<?php echo SITEURL.'partials/profile-delete.php?id='.$id.'&image_name='.$image_name; ?>' class="delete">Delete Or Die</a>
            </div>
            <form action="" method="POST" class="profile-info column">
                    <div class="info-text" id="patient_name_text">
                    <strong>Full Name: </strong>
                    <input type="text" name="full_name" value="<?php echo $patient_name; ?>" disabled>
                </div>
                <div class="info-text">
                    <strong>Username : </strong>
                    <input type="text" name="username" value="<?php echo $username; ?>" disabled>
                </div>
                <div class="info-text">
                    <strong>Email Address: </strong>
                    <input type="text" name="email" value="<?php echo $email; ?>" disabled>
                </div>
                <div class="info-text"> 
                    <strong>Age : </strong>
                    <input type="number" name="age" value="<?php echo $age; ?>" disabled>
                </div>
                <div class="info-text">
                    <strong>Mobile Number: </strong>
                    <input type="text" name="contact" value="<?php echo $contact; ?>" disabled>
                </div>
                <div class="info-text">
                    <strong>Gender :</strong>
                    <select name="gender" disabled>
                        <!-- <option value="Select Your Gender" disabled>Select Your Gender</option> -->
                        <option value="Male" <?php if ($gender == 'Male') {echo 'selected';}; ?>>Male</option>
                        <option value="Female" <?php if ($gender == 'Female') {echo 'selected';}; ?>>Female</option>
                    </select>
                </div>
                <div class="info-text">
                    <strong>Address: </strong>
                    <input type="text" name="address" value="<?php echo $address; ?>" disabled>
                </div>
                <div class="info-text" id="patient_current_password" style="display: none;">
                    <strong>Current Password: </strong>
                    <input type="text" name="current_password" placeholder="Enter You Current Password" disabled>
                </div>
                <div class="info-text" id="patient_new_password" style="display: none;">
                    <strong>New Password : </strong>
                    <input type="text" name="new_password" placeholder="Enter Your New Password" disabled>
                </div>
                <input type="submit" name="submit" class="btn-primary" value="Submit" id="submit">
            </form>
        </div>
    </div>
</div>

<script>
    let update_profile = document.getElementById('update-profile');
    let inputs = document.querySelectorAll('input');
    let submit = document.querySelector('input[name="submit"]')
    let patient_name_text = document.getElementById('patient_name_text')
    let patient_current_password = document.getElementById('patient_current_password')
    let patient_new_password = document.getElementById('patient_new_password')
    let select = document.querySelectorAll('select')
    let select_default = document.createElement('option');


    
    update_profile.addEventListener('click', () => {
        submit.style.display = 'block'
        patient_new_password.style.display = 'flex'
        patient_current_password.style.display = 'flex'
        inputs.forEach(input => {
            input.removeAttribute('disabled')
        });
        select.forEach(select => {
            // select_default.setAttribute("value", 'sdsd')
            // select_default.innerHTML = 'Select Your Gender'
            // select_default.setAttribute('disabled' , true);
            // select_default.setAttribute('selected' , true);
            // select.append(select_default);
            select.removeAttribute('disabled')
        });
    }
    );
</script>
<?php include_once '../partials/footer.php' ?>

<?php

if(isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $current_password2 = $_POST['current_password'];
    $new_password = md5($_POST['new_password']);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $sql2 = "UPDATE tbl_patient SET 
    full_name='$full_name',
    username='$username',
    password='$new_password',
    email='$email',
    address='$address',
    contact='$contact',
    gender='$gender',
    age='$age'
    WHERE full_name='$patient_name'";

    if(!(md5($current_password2) == $current_password)) {
        $_SESSION['password_error'] = '<h1 class="failed">Current Password Isn\'t Correct</h1>';
        header("Refresh:0");
    }else {
        if($full_name == '' or $address == '' or $age == '' or $username == '' or $email == '' or $contact == '') {
            $_SESSION['empty'] = '<br><br><h1 class="failed">One Of The Inputs Are Invalid</h1>';
            header("Refresh:0");
            die();
        }else {
            $res2 = mysqli_query($conn, $sql2);
            if($res2) {
                $_SESSION['update_profile'] = '<h1 class="success">Your Profile Has Been Updated Successfully, Please Login Again</h1>';
                include_once '../login/logout.php';
            }else {
                $_SESSION['update_profile'] = '<h1 class="failed">Failed To Update You Profile, Try Again</h1>';
            }
        }
    }
}
?>