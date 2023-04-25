<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/admin-nav.php' ?>

    <!-- Start DASHBORDER -->
    <div class="view">
        <div class="title">MANAGE DOCTORS</div>
        <?php
        if(isset($_SESSION['add'])) {
            if($_SESSION['add'] === '<h1 class="success">Doctor Has Been Added Successfully</h1>') {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }else if($_SESSION['add'] === '<h1 class="failed">Failed To Add Doctor</h1>') {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        }
        if(isset($_SESSION['delete'])) {
            if($_SESSION['delete'] === '<h1 class="success">Doctor Has Been Deleted Successfully</h1>') {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }else if($_SESSION['delete'] === '<h1 class="failed">Failed To Delete Doctor</h1>') {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
        }
        if(isset($_SESSION['update'])) {
            if($_SESSION['update'] === '<h1 class="success">Doctor Has Been Updated Successfully</h1>') {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }else if($_SESSION['update'] === '<h1 class="failed">Failed To Update Doctor</h1>') {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        }
        ?>
        <div class="container">
            <div class="profile">
                <form action="" method="POST">
                    
                </form>
            </div>
        </div>
    </div>
    <!-- End DASHBORDER -->

<?php include_once '../partials/footer.php' ?>