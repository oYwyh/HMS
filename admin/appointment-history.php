<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/admin-nav.php' ?>

    <!-- Start VIEW -->
    <div class="view">
        <div class="title">APPOINTMENT HOSTORY</div>
        <form action="<?php echo SITEURL.'search/search-appointment.php'?>" method="POST">
            <input type="text" name="search" id="search" placeholder="search">
            <input type="submit" value="Search" class="primary-btn">
        </form>
        <div class="container">
        <table>
                    <tr class="table-title">
                        <th>S.N</th>
                        <th>Doctor Name</th>
                        <th>Doctor Gender</th>
                        <th>Patient Name</th>
                        <th>Specialization</th>
                        <th>Appointment Date</th>
                        <th>Appointment Creation Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM tbl_appointment";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                        $row=mysqli_num_rows($res);
                        if($row > 0){
                            $sn=1;
                            while($rows=mysqli_fetch_assoc($res)) {
                                $id = $rows['id'];
                                $doctor_name = $rows['doctor_name'];
                                $doctor_gender = $rows['doctor_gender'];
                                $patient_name = $rows['patient_name'];
                                $specialization = $rows['specialization'];
                                $status = $rows['status'];
                                $appointment_date = $rows['appointment_date'];
                                $appointment_create_date = $rows['appointment_create_date'];
                                ?>
                                <tr class="table-info">
                                    <th><?php echo $sn; ?></th>
                                    <th><?php echo $doctor_name; ?></th>
                                    <th><?php echo $doctor_gender; ?></th>
                                    <th><?php echo $patient_name; ?></th>
                                    <th><?php echo $specialization; ?></th>
                                    <th><?php echo $appointment_date; ?></th>
                                    <th><?php echo $appointment_create_date; ?></th>
                                    <th><?php  
                                        if($status == 'Accepted') {
                                            echo '<p class="status-accepted">'.$status.'</p>';
                                        }else if($status == 'Canceled By Doctor') {
                                            echo '<p class="status-canceled">'.$status.'</p>';
                                        }else {
                                            $status = 'On Progress';
                                            echo '<p class="status-progress">'.$status.'</p>';
                                        }
                                    ; ?></th>     
                                    <th>
                                        <a href="<?php echo SITEURL.'patient/delete-patient.php?id='.$id; ?>" class="failed">Cancel</a>
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