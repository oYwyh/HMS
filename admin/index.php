<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/admin-nav.php' ?>



    <!-- Start DASHBORDER -->
    <div class="dashbored">
        <div class="title">DASHBORED</div>
        <?php
        if(isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <div class="container">
            <div class="box">
                <div class="row">
                    <div class="icon"><i class="fa-solid fa-user"></i></div>
                    <div class="column">
                    <?php 
                    $sql = "SELECT * FROM tbl_admin";
                    $res = mysqli_query($conn , $sql);
                        if($res) {
                        $row = mysqli_num_rows($res);
                    }
                    ?>
                        <div class="total"><?php echo $row; ?></div>
                        <div class="box-title">Total Admins</div>
                    </div>
                </div>
                <a href="<?php echo SITEURL.'admin/manage-admin.php' ?>" class="manage">Manage Admin</a>
            </div>
            <div class="box">
                <div class="row">
                    <div class="icon"><i class="fa-solid fa-user-doctor"></i></div>
                    <div class="column">
                    <?php 
                    $sql = "SELECT * FROM tbl_doctor";
                    $res = mysqli_query($conn , $sql);
                        if($res) {
                        $row = mysqli_num_rows($res);
                    }
                    ?>
                        <div class="total"><?php echo $row; ?></div>
                        <div class="box-title">Doctors</div>
                    </div>
                </div>
                <a href="<?php echo SITEURL.'admin/manage-doctors.php' ?>" class="manage">Manage Doctors</a>
            </div>
            <div class="box">
                <div class="row">
                    <div class="icon"><i class="fa-solid fa-bed"></i></div>
                    <div class="column">
                    <?php 
                    $sql = "SELECT * FROM tbl_patient";
                    $res = mysqli_query($conn , $sql);
                        if($res) {
                        $row = mysqli_num_rows($res);
                    }
                    ?>
                        <div class="total"><?php echo $row; ?></div>
                        <div class="box-title">Total Patients</div>
                    </div>
                </div>
                <a href="<?php echo SITEURL.'admin/manage-patient.php' ?>" class="manage">Manage Patient</a>
            </div>
            <div class="box">
                <div class="row">
                    <div class="icon"><i class="fa-solid fa-calendar-check"></i></div>
                    <div class="column">
                    <?php 
                    $sql = "SELECT * FROM tbl_appointment";
                    $res = mysqli_query($conn , $sql);
                        if($res) {
                        $row = mysqli_num_rows($res);
                    }
                    ?>
                        <div class="total"><?php echo $row; ?></div>
                        <div class="box-title">Total Appointment</div>
                    </div>
                </div>
                <a href="<?php echo SITEURL.'admin/appointment-history.php' ?>" class="manage">View Appointment</a>
            </div>

        </div>
    </div>
    <!-- End DASHBORDER -->

<?php include_once '../partials/footer.php' ?>