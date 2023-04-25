<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/doctor-nav.php' ?>


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
                    <div class="icon"><i class="fa-solid fa-calendar-check"></i></div>
                    <div class="column">
                        <?php
                        $doctor_name = $_SESSION['doctor_name'];
                        $sql = "SELECT * FROM tbl_appointment WHERE doctor_name='$doctor_name'";
                        $res = mysqli_query($conn, $sql);
                        if($res) {
                            $row=mysqli_num_rows($res);
                        }
                        ?>
                        <div class="total"><?php echo $row; ?></div>
                        <div class="box-title">Total Appointment</div>
                    </div>
                </div>
                <a href="<?php echo SITEURL.'doctor/view-appointment.php' ?>" class="manage">Manage Appointment</a>
            </div>
        </div>
    </div>
    <!-- End DASHBORDER -->

<?php include_once '../partials/footer.php' ?>