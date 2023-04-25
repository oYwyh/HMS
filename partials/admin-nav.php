
<?php

include_once '../login/admin-login-check.php';

?>

<?php 
        $admin_name = $_SESSION['admin_name'];
        $sql = "SELECT * FROM tbl_admin WHERE full_name='$admin_name'";
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
                <div class="username"><?php echo $admin_name; ?></div>
                <div class="toggle"><i class="fa-solid fa-chevron-down"></i></div>
            </div>
            <div class="profile-options none" id="profile-options">
                <ul>
                    <li><a href="<?php echo SITEURL.'admin/admin-profile.php' ?>">Profile</a></li>
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

<li><a href="<?php echo SITEURL.'admin/index.php' ?>"><i class="fa-solid fa-chart-line"></i> <span id="nav-links">DASHBORED</span></a></li>
            <ul class="nested-list">
                <li>
                <div>
                    <i class="fa-solid fa-user-doctor" id="nested-icon"></i> <span class="nested-title" id="nested-title">Doctors</span> 
                </div>
                <i class="fa-solid fa-chevron-down" id="nested-toggle"></i>
                </li>
                <li class="append-list none" id="append-list">
                    <a href="<?php echo SITEURL.'admin/add-doctors.php' ?>"><i class="fa-solid fa-user-doctor"></i> <span id="nav-links">ADD DOCTORS</span></a>
                    <a href="<?php echo SITEURL.'admin/manage-doctors.php' ?>" style="border-bottom: none; padding-bottom: 0 !important;" ><i class="fa-solid fa-user-doctor"></i> <span id="nav-links">MANAGE DOCTORS</span></a>
                </li>
            </ul>
            <ul class="nested-list">
                <li>
                <div>
                    <i class="fa-solid fa-screwdriver-wrench" id="nested-icon"></i> <span class="nested-title" id="nested-title">Admin</span> 
                </div>
                <i class="fa-solid fa-chevron-down" id="nested-toggle"></i>
                </li>
                <li class="append-list none" id="append-list">
                    <a href="<?php echo SITEURL.'admin/add-admin.php' ?>"><i class="fa-solid fa-screwdriver-wrench"></i> <span id="nav-links">ADD ADMIN</span></a>
                    <a href="<?php echo SITEURL.'admin/manage-admin.php' ?>" style="border-bottom: none; padding-bottom: 0 !important;" ><i class="fa-solid fa-screwdriver-wrench"></i> <span id="nav-links">MANAGE ADMIN</span></a>
                </li>
            </ul>
            <ul class="nested-list">
                <li>
                <div>
                    <i class="fa-solid fa-bed" id="nested-icon"></i> <span class="nested-title" id="nested-title">Patient</span> 
                </div>
                <i class="fa-solid fa-chevron-down" id="nested-toggle"></i>
                </li>
                <li class="append-list none" id="append-list">
                    <a href="<?php echo SITEURL.'admin/manage-patient.php' ?>" style="border-bottom: none; padding-bottom: 0 !important;" ><i class="fa-solid fa-bed"></i> <span id="nav-links">MANAGE PATIENT</span></a>
                </li>
                <li class="append-list none" id="append-list">
                    <a href="<?php echo SITEURL.'admin/appointment-history.php' ?>" style="border-bottom: none;"><i class="fa-solid fa-calendar-check"></i> <span id="nav-links">APPOINTMENT</span></a>
                </li>
            </ul>
        </ul>
    </div>
</div>
<!-- End Links -->

<script>
header_toggle = document.getElementById('header-toggle');
logo_title = document.getElementById('logo-title')
nav_links = document.querySelectorAll('#nav-links')
nav_title = document.getElementById('nav-title')
logo = document.getElementById('logo')
links = document.getElementById('links')
append_list = document.querySelectorAll('#append-list')
nested_toggle = document.querySelectorAll('#nested-toggle')
nested_title = document.querySelectorAll('#nested-title')
nested_icon = document.querySelectorAll('#nested-icon')

nested_toggle[0].onclick = () => {
    append_list[0].classList.toggle('none')
}
nested_toggle[1].onclick = () => {
    append_list[1].classList.toggle('none')
}
nested_toggle[2].onclick = () => {
    append_list[2].classList.toggle('none')
    append_list[3].classList.toggle('none')
}

header_toggle.onclick = (e) => {
    logo_title.classList.toggle('none')
    nav_title.classList.toggle('none')
    // nested_title.classList.toggle('none')
    // nested_icon.classList.toggle('none')
    logo.classList.toggle('smaller')
    links.classList.toggle('smaller')
    for(let i = 0; i< nav_links.length; i++) {
        nav_links[i].classList.toggle('none')
    }
}
</script>