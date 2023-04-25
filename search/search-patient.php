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
                <th>Full Name</th>
                <th>Username</th>
                <th>Contact</th>
                <th>Add Date</th>
                <th>Actions</th>
            </tr>
            <?php 
            if(isset($_POST['search'])) {
                $search = $_POST['search'];
                $sql = "SELECT * FROM tbl_patient WHERE full_name LIKE '%$search%' OR username LIKE '%$search%' OR contact LIKE '%$search%'";
                $res = mysqli_query($conn, $sql);
                if($res) {
                    $row=mysqli_num_rows($res);
                    if($row > 0) {
                        $sn=0;
                        while($rows=mysqli_fetch_assoc($res)) {
                            $id= $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];
                            $contact = $rows['contact'];
                            $add_date = $rows['add_date']
                            ?>
                            <tr class="table-info">
                                <th><?php echo $full_name;?></th>
                                <th><?php echo $username;?></th>
                                <th><?php echo $contact; ?></th>
                                <th><?php echo $add_date;?></th>
                                <th class="actions">
                                    <a href="<?php echo SITEURL.'admin/delete-doctor.php?id='.$id?>"class="failed">Delete</a>
                                    <a href="<?php echo SITEURL.'admin/update-doctor.php?id='.$id?>"class="success">Update</a>
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