<?php include_once '../config/constans.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/search.css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
</head>
<body>
    <div class="search">
        <table>
            <tr class="table-title">
                <th>Patient Name</th>
                <th>Specialization</th>
                <th>Appointment Date</th>
                <th>Appointment Create Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php 
            if(isset($_POST['search'])) {
                $search = $_POST['search'];
                $doctor_name = $_SESSION['doctor_name'];
                $sql = "SELECT * FROM tbl_appointment WHERE doctor_name='$doctor_name' AND
                (patient_name LIKE '%$search%' OR specialization LIKE '%$search% 'OR appointment_date LIKE '%$search%')";
                $res = mysqli_query($conn, $sql);
                if($res) {
                    $row=mysqli_num_rows($res);
                    if($row > 0) {
                        $sn=0;
                        while($rows=mysqli_fetch_assoc($res)) {
                            $id= $rows['id'];
                            $patient_name = $rows['patient_name'];
                            $specialization = $rows['specialization'];
                            $status = $rows['status'];
                            $appointment_date = $rows['appointment_date'];
                            $appointment_create_date = $rows['appointment_create_date']
                            ?>
                            <tr class="table-info">
                                <th><?php echo $patient_name;?></th>
                                <th><?php echo $specialization; ?></th>
                                <th><?php echo $appointment_date;?></th>
                                <th><?php echo $appointment_create_date;?></th>
                                <th><?php  
                                    if($status == 'Accepted') {
                                        echo '<p class="status-accepted">'.$status.'</p>';
                                    }else if($status == 'Canceled By Doctor') {
                                        echo '<p class="status-canceled">'.$status.'</p>';
                                    }else if($status == 'On Progress') {
                                        echo '<p class="status-progress">'.$status.'</p>';
                                    }
                                    ; ?></th>   
                                <th class="actions">
                                    <a href="<?php echo SITEURL.'patient/delete-patient.php?id='.$id?>" class="failed">Cancel</a>
                                    <a href="<?php echo SITEURL.'doctor/update-status.php?id='.$id?>" class="success">Update Status</a>
                                </th>
                            </tr>
                            <?php
                        }
                    }else {

                    }
                }
            }else {
                header('location:'.SITEURL.'login/login.php');
            }
            ?>
        </table>
        <div class="go-back" id="go-back">
            <button id="back">Go Back</button>
            <script>
                let back = document.getElementById('back');
                back.setAttribute("class", "back");
                back.onclick = () => {
                    window.history.back()
                }
            </script>
        </div>
    </div>
</body>
</html>