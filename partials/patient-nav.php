<?php

include_once '../login/patient-login-check.php';

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
                $image_name = $rows['image_name'];
            }
        }
    ?>

                <img src="
                <?php 
                if($image_name) {
                    echo "../assets/images/profiles_pics/".$image_name;
                }else {
                    echo "../assets/images/profiles_pics/default_profile_pic.jpeg";
                }
                ?>" alt="">
                <div class="username"><?php echo $patient_name; ?></div>
                <div class="toggle"><i class="fa-solid fa-chevron-down"></i></div>
            </div>
            <div class="profile-options none" id="profile-options">
                <ul>
                    <li><a href="<?php echo SITEURL.'patient/patient-profile.php' ?>">Profile</a></li>
                    <li style="border: none;"><a href="<?php echo SITEURL.'login/logout.php' ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="main-content">
    <div class="links" id="links">
        <div class="container">
            <div class="nav-title" id="nav-title">MAIN VANIGATION</div>
            <ul>
<li><a href="<?php echo SITEURL.'patient/index.php' ?>"><i class="fa-solid fa-chart-line"></i> <span id="nav-links">DASHBORED</span></a></li>
            <li><a href="<?php echo SITEURL.'patient/book-appointment.php' ?>" style="border-bottom: none;"><i class="fa-solid fa-bed"></i> <span id="nav-links">BOOK APPOINTMENT</span></a></li>
            <li><a href="<?php echo SITEURL.'patient/appointment-history.php' ?>" style="border-bottom: none;"><i class="fa-solid fa-calendar-check"></i> <span id="nav-links">APPOINTMENT HISTORY</span></a></li>
        </ul>
    </div>
</div>
<!-- End Links -->