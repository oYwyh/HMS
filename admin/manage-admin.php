<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/admin-nav.php' ?>

    <!-- Start DASHBORDER -->
    <div class="view">
        <div class="title">MANAGE DOCTORS</div>
        <?php
        
        if(isset($_SESSION['add'])) {
            if($_SESSION['add'] === '<h1 class="success">Admin Has Been Added Successfully</h1>') {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }else if($_SESSION['add'] === '<h1 class="failed">Failed To Add Admin</h1>') {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        }
        if(isset($_SESSION['delete'])) {
            if($_SESSION['delete'] === '<h1 class="success">Admin Has Been Deleted Successfully</h1>') {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }else if($_SESSION['delete'] === '<h1 class="failed">Failed To Delete Admin</h1>') {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
        }
        if(isset($_SESSION['update'])) {
            if($_SESSION['update'] === '<h1 class="success">Admin Has Been Updated Successfully</h1>') {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }else if($_SESSION['update'] === '<h1 class="failed">Failed To Update Admin</h1>') {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        }

        ?>
        <div class="container">
            <table>
                    <tr class="table-title">
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Add Date</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                    $sql = "SELECT * FROM tbl_admin";
                    $res = mysqli_query($conn, $sql);
                    if($res) {
                        $row=mysqli_num_rows($res);
                        if($row > 0) {
                            $sn=1;
                            while($rows=mysqli_fetch_assoc($res)) {
                                $id= $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];
                                $add_date = $rows['add_date']
                                ?>
                                <tr class="table-info">
                                    <th><?php echo $sn++ ?></th>
                                    <th><?php echo $full_name;?></th>
                                    <th><?php echo $username;?></th>
                                    <th><?php echo $add_date;?></th>
                                    <th class="actions">
                                        <a href="<?php echo SITEURL.'admin/delete-admin.php?id='.$id ?>" class="failed">Delete</a>
                                        <a href="<?php echo SITEURL.'admin/update-admin.php?id='.$id ?>" class="success">Update</a>
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
    <!-- End DASHBORDER -->

<?php include_once '../partials/footer.php' ?>