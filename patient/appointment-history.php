<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/patient-nav.php' ?>

    <!-- Start VIEW -->
    <div class="view">
        <div class="title">APPOINTMENT HOSTORY</div>
        <?php
            if(isset($_SESSION['add'])) {
                if($_SESSION['add'] === '<h1 class="success">Appointment Has Been Added Successfully</h1>') {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }else if($_SESSION['add'] === '<h1 class="failed">Failed To Add Appointment</h1>') {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            }
            if(isset($_SESSION['delete'])) {
                if($_SESSION['delete'] === '<h1 class="success">Appointment Has Been Canceld Successfully</h1>') {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }else if($_SESSION['delete'] === '<h1 class="failed">Failed To Cancel Appointment</h1>') {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            }
        ?>
        <div class="search">
            <form action="<?php echo SITEURL.'search/search-appointment-patient.php'?>" method="POST">
                <input type="text" name="search" id="search" placeholder="search">
                <input type="submit" value="Search" class="primary-btn">
            </form>
        </div>
        
        <div class="container">
            <table>
                    <tr class="table-title">
                        <th>S.N</th>
                        <th>Doctor Name</th>
                        <th>Specialization</th>
                        <th>Examinations</th>
                        <th>Contracts</th>
                        <th>Appointment Date</th>
                        <th>Appointment Creation Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    $patient_name = $_SESSION['patient_name'];
                    $sql = "SELECT * FROM tbl_appointment WHERE patient_name='$patient_name'";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                        $row=mysqli_num_rows($res);
                        if($row > 0){
                            $sn=1;
                            while($rows=mysqli_fetch_assoc($res)) {
                                $id = $rows['id'];
                                $doctor_name = $rows['doctor_name'];
                                $specialization = $rows['specialization'];
                                $examinations_names = $rows['examinations_names'];
                                $contracts_names = $rows['contracts_names'];
                                $status = $rows['status'];
                                $appointment_date = $rows['appointment_date'];
                                $appointment_create_date = $rows['appointment_create_date'];
                                ?>
                                <tr class="table-info">
                                    <th><?php echo $sn++; ?></th>
                                    <th><?php echo $doctor_name; ?></th>
                                    <th><?php echo $specialization; ?></th>
                                    <th><?php echo $examinations_names; ?></th>
                                    <th><?php echo $contracts_names; ?></th>
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
                                    ; ?></th>                                    <th>
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

<?php include_once '../partials/footer.php'; ?>