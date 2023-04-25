<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/admin-nav.php' ?>

    <!-- Start VIEW -->
    <div class="view">
        <div class="title">VIEW PATIENT</div>

        <?php
            if(isset($_SESSION['delete'])) {
                if($_SESSION['delete'] === '<h1 class="success">Patient Has Been Deleted Successfully</h1>') {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }else if($_SESSION['delete'] === '<h1 class="failed">Failed To Delete Patient</h1>') {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
            }
        ?>
        <div class="search">
            <form action="<?php echo SITEURL.'search/search-patient.php'?>" method="POST">
                <input type="text" name="search" id="search" placeholder="search">
                <input type="submit" value="Search" class="primary-btn">
            </form>
        </div>
        
        <div class="container">
            <table>
                    <tr class="table-title">
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Birth Date</th>
                        <th>Add Date</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                    $sql = "SELECT * FROM tbl_patient";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                        $row=mysqli_num_rows($res);
                        if($row > 0) {
                            $sn=1;
                            while($rows=mysqli_fetch_assoc($res)) {
                                $id= $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];
                                $gender = $rows['gender'];
                                $email = $rows['email'];
                                $contact = $rows['contact'];
                                $birth_date = $rows['birth_date'];
                                $add_date = $rows['add_date']
                                ?>
                                <tr class="table-info">
                                    <th><?php echo $sn++ ?></th>
                                    <th><?php echo $full_name;?></th>
                                    <th><?php echo $username;?></th>
                                    <th><?php echo $gender;?></th>
                                    <th><?php echo $contact;?></th>
                                    <th><?php echo $email;?></th>
                                    <th><?php echo $birth_date;?></th>
                                    <th><?php echo $add_date;?></th>
                                    <th class="actions">
                                        <a href="<?php echo SITEURL.'admin/delete-patient.php?id='.$id?>" class="failed">Delete</a>
                                    </th>
                                </tr>
                                <?php
                            }
                        }else {

                        }
                    }
                    ?>

            </table>
        </div>
    </div>
    <!-- End VIEW -->

<?php include_once '../partials/footer.php' ?>