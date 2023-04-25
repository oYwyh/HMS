<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/doctor-nav.php' ?>

    <!-- Start VIEW -->
    <div class="view">
        <div class="title">APPOINTMENT HOSTORY</div>
        <form action="<?php echo SITEURL.'search/search-appointment-doctor.php'?>" method="POST">
            <input type="text" name="search" id="search" placeholder="search">
            <input type="submit" value="Search" class="primary-btn">
        </form>
        <?php 
            $doctor_name = $_SESSION['doctor_name'];
            if(isset($_SESSION['patient_info_saved'])) {
                echo $_SESSION['patient_info_saved'];
                unset($_SESSION['patient_info_saved']);
            }
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['yes'])) {
                echo $_SESSION['yes'];
                unset($_SESSION['yes']);
            }
            if(isset($_SESSION['no'])) {
                echo $_SESSION['no'];
                unset($_SESSION['no']);
            }
            if(isset($_SESSION['cancel'])) {
                echo $_SESSION['cancel'];
                unset($_SESSION['cancel']);
            }
        ?>
        <div class="container">
        <table>
                    <tr class="table-title">
                        <th>S.N</th>
                        <th>Patient Name</th>
                        <th>Patient Gender</th>
                        <th>Patient Age</th>
                        <th>Patient Tel</th>
                        <th>Patient Address</th>
                        <th>Examinations</th>
                        <th>Appointment Date</th>
                        <th>Appointment Creation Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM tbl_appointment WHERE doctor_name='$doctor_name'";
                        $res = mysqli_query($conn, $sql);
                        if($res) {
                            $row=mysqli_num_rows($res);
                            if($row > 0){
                                $sn=1;
                                while($rows=mysqli_fetch_assoc($res)) {
                                    $id = $rows['id'];
                                    $patient_name = $rows['patient_name'];
                                    $patient_gender = $rows['patient_gender'];
                                    $patient_age = $rows['patient_age'];
                                    $patient_tel = $rows['patient_tel'];
                                    $patient_address = $rows['patient_address'];
                                    $examinations_names = $rows['examinations_names'];
                                    $status = $rows['status'];
                                    $appointment_date = $rows['appointment_date'];
                                    $appointment_create_date = $rows['appointment_create_date'];
                                    ?>
                                    <tr class="table-info">
                                        <th><?php echo $sn++; ?></th>
                                        <th><?php echo $patient_name; ?></th>
                                        <th><?php echo $patient_gender; ?></th>
                                        <th><?php echo $patient_age; ?></th>
                                        <th><?php echo $patient_tel; ?></th>
                                        <th><?php echo $patient_address; ?></th>
                                        <th><?php echo $examinations_names; ?></th>
                                        <th><?php echo $appointment_date; ?></th>
                                        <th><?php echo $appointment_create_date; ?></th>
                                        <th><?php  
                                            if($status == 'Accepted') {
                                                echo "<a href='".SITEURL.'doctor/patient-info.php?id='.$id.'&undone=undone'."'class='status-accepted'>".$status."</a>";
                                            }else if($status == 'Canceled By Doctor') {
                                                echo '<p class="status-canceled">'.$status.'</p>';
                                            }else if($status == 'seen'){
                                                $status = 'seen';
                                                echo '<a href="patient-info-seen.php?id='.$id.'" class="status-seen">'.$status.'</a>';
                                            }else {
                                                $status = 'On Progress';
                                                echo '<p class="status-progress">'.$status.'</p>';
                                            }
                                        ; ?></th>     
                                        <th class="actions">
                                            <?php
                                                if($status == 'seen') {
                                                    ?>
                                                        <a href="#" class="mid">Nothing To Do Here</a>
                                                    <?php
                                                }else {
                                                    ?>
                                                        <a href="<?php echo SITEURL.'doctor/cancel-appointment.php?id='.$id; ?>" class="failed">Cancel</a>
                                                        <a href="<?php echo SITEURL.'doctor/update-status.php?id='.$id.'&normal=normal'; ?>" class="success">Update Status</a>
                                                    <?php
                                                }
                                            ?>
                                        </th>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    ?>
            </table>
        </div>
    </div>
    <!-- End VIEW -->

<?php include_once '../partials/footer.php' ?>