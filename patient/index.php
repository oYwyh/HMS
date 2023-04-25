<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/patient-nav.php' ?>

    <!-- Start DASHBORDER -->
    <div class="dashbored-patient">
        <div class="title">DASHBORED</div>
        <?php
            if(isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
                // echo 'Welcome Back '.$_SESSION['patient_name'].'';
            }
        ?>
        <div class="container">
            <div class="box">
                <div class="column">
                    <div class="icon"><i class="fa-solid fa-user-doctor"></i></div>
                    <div class="title">My Profile</div>
                </div>
                <div class="box-title">
                    <p>[</p>
                    <a href="<?php echo SITEURL.'patient/patient-profile.php' ?>" >View My Profile</a>
                    <p>]</p>
                </div>
            </div>
            <div class="box">
                <div class="column">
                    <div class="icon"><i class="fa-solid fa-user-doctor"></i></div>
                    <div class="title">Book An Appointment</div>
                </div>
                <div class="box-title">
                    <p>[</p>
                    <a href="<?php echo SITEURL.'patient/book-appointment.php' ?>" >Book An Appointment</a>
                    <p>]</p>
                </div>
            </div>
            <div class="box">
                <div class="column">
                    <div class="icon"><i class="fa-solid fa-user-doctor"></i></div>
                    <div class="title">Appointment History</div>
                </div>
                <div class="box-title">
                    <p>[</p>
                    <a href="<?php echo SITEURL.'patient/appointment-history.php' ?>" >View My Appointment History</a>
                    <p>]</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End DASHBORDER -->

<?php include_once '../partials/footer.php' ?>