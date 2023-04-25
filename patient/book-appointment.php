<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/patient-nav.php' ?>


<!-- Start Add -->
<div class="add">
    <div class="title">Book Appointment</div>
    <?php 
        if(isset($_SESSION['empty'])) {
            echo $_SESSION['empty'];
            unset($_SESSION['empty']);
        }
        if(isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
    $patient_name = $_SESSION['patient_name'];
    $sql2 = "SELECT * FROM tbl_patient WHERE full_name='$patient_name'";
    $res2 = mysqli_query($conn, $sql2);
    if($res2) {
        $row=mysqli_num_rows($res2);
        if($row>0) {
            $rows=mysqli_fetch_assoc($res2);
            $patient_name_db = $rows['full_name'];
            $patient_gender = $rows['gender'];
            $patient_tel = $rows['contact'];
            $patient_age = $rows['age'];
            $patient_address = $rows['address'];
        }
    }
    ?>
    <div class="container">
    <form action="" method="POST"enctype="multipart/form-data">
        <div class="row">
            <label for="specialization">Specialization</label>
            <select name="specialization" id="specialization_list">
                <option value="select_an_option" disabled selected>Select An Option</option>
                <option value="surgery">Surgery</option>
                <option value="kids">Kids</option>
            </select>
        </div>
        <div class="row doctor_name_row none" id="doctor_name_row">
            <label for="doctor_name">Doctor Name</label>
            <select name="doctor_name" id="doctor_name_list">
                <option value="Select An option" class="none" disabled selected>Select An Option</option>
                <option value="Doctor Waleed" class="none" data-specialization="surgery">Doctor Waleed</option>
                <option value="Doctor Doaa" class="none" data-specialization="kids">Doctor Doaa</option>
            </select>
        </div>
        <div class="row">
            <label for="appointment_date">Appointment Date</label>
            <input type="date" name="appointment_date">
        </div>
        <div class="parent-row" id="parent-row-examination">
            <div class="row">
                <label for="q_examination">Do You Have Any Examination</label>
                <select name="q_examination" id="q_examination">
                    <option value="Select An Option" disabled selected>Select An Option</option>
                    <option value="Yes" >Yes</option>
                    <option value="No" >No</option>
                </select>
            </div>
        </div>
        <div class="parent-row" id="parent-row-contracts">
            <div class="row">
                <label for="q_contracts">Do You Have Any Contracts</label>
                <select name="q_contracts" id="q_contracts">
                    <option value="Select An Option" disabled selected>Select An Option</option>
                    <option value="Yes" >Yes</option>
                    <option value="No" >No</option>
                </select>
            </div>
        </div>
            <input type="submit" name="submit" value="Book Appontment" class="btn-primary">
        </form>
    </div>
</div>
<script>
    const sub = document.querySelector('input[name="submit"]');
    const specialization_list = document.getElementById('specialization_list');
    const doctor_name_list = document.getElementById('doctor_name_list');
    const doctor_name_list_options = document.querySelectorAll('#doctor_name_list option');
    specialization_list.addEventListener('change', () => {
        doctor_name_list.parentElement.classList.remove('none')
        let selected = specialization_list.value;
        let selected_lc = selected.toLowerCase();
        doctor_name_list_options.forEach(option => {
            const attribute = option.getAttribute("data-specialization");
            if(selected == selected) {
                option.classList.add('none')
                if(attribute == selected_lc) {
                    option.classList.remove('none')
                }
            }
        });
    })

    const q_examination = document.getElementById('q_examination');
    const parentExamination = document.getElementById('parent-row-examination')
    q_examination.addEventListener('change', () => {
        q_examination.setAttribute('disabled', '')
        const selected = q_examination.value;
        const selected_lc = selected.toLowerCase();
        if(selected_lc == 'yes') {
            const row1 = document.createElement('div');
            const row2 = document.createElement('div');
            const label1 = document.createElement('label')
            const label2 = document.createElement('label')
            const inputTxt = document.createElement('input');
            const inputFile = document.createElement('input');

            inputFile.setAttribute('type', 'file');
            inputFile.setAttribute('name', 'examinations_pics[]');
            inputFile.setAttribute('id', 'examinations_pics');
            inputFile.setAttribute('multiple', '');
            label2.setAttribute('for', 'examination');
            label2.innerHTML = 'Upload Exmanations Pics';
            row2.classList.add('row')
            row2.append(label2);
            row2.append(inputFile);

            inputTxt.setAttribute('name', 'examinations_names');
            inputTxt.setAttribute('id', 'examinations_names');
            inputTxt.setAttribute('placeholder', 'Enter Examination Names');
            label1.setAttribute('for', 'examinations_names');
            label1.innerHTML = 'Examinations Names'
            row1.classList.add('row');
            row1.append(label1)
            row1.append(inputTxt)
            parentExamination.append(row1);
            parentExamination.append(row2);
        }else {
            const inputTxt = document.createElement('input');
            inputTxt.setAttribute('name', 'examinations_names');
            inputTxt.setAttribute('id', 'examinations_names');
            inputTxt.setAttribute('placeholder', 'Enter Examination Names');
            inputTxt.style.display = 'none'
            inputTxt.value = 'None'
            const row1 = document.createElement('div');
            row1.append(inputTxt)
            parentExamination.append(row1);
        }
    })
    const q_contracts = document.getElementById('q_contracts');
    const parentContracts = document.getElementById('parent-row-contracts')
    q_contracts.addEventListener('change', () => {
        q_contracts.setAttribute('disabled', '')
        const selected = q_contracts.value;
        const selected_lc = selected.toLowerCase();
        if(selected_lc == 'yes') {
            const row1 = document.createElement('div');
            const row2 = document.createElement('div');
            const label1 = document.createElement('label')
            const label2 = document.createElement('label')
            const inputTxt = document.createElement('select');
            const inputFile = document.createElement('input');
            const opt_def = document.createElement('option')
            opt_def.value = 'select_an_option'
            opt_def.innerHTML = 'Select An Option'
            opt_def.setAttribute('selected', true)
            opt_def.setAttribute('disabled', true)
            const opt_1 = document.createElement('option')
            opt_1.value = 'opt_1'
            opt_1.innerHTML = 'Opt 1'
            const opt_2 = document.createElement('option')
            opt_2.value = 'opt_2'
            opt_2.innerHTML = 'Opt 2'
            const opt_3 = document.createElement('option')
            opt_3.value = 'opt_3'
            opt_3.innerHTML = 'Opt 3'
            const opt_4 = document.createElement('option')
            opt_4.value = 'opt_4'
            opt_4.innerHTML = 'Opt 4'

            inputFile.setAttribute('type', 'file');
            inputFile.setAttribute('name', 'contracts_pics[]');
            inputFile.setAttribute('id', 'contracts_pics');
            inputFile.setAttribute('multiple', '');
            label2.setAttribute('for', 'contracts');
            label2.innerHTML = 'Upload Contracts Pics';
            row2.classList.add('row')
            row2.append(label2);
            row2.append(inputFile);

            inputTxt.setAttribute('name', 'contracts_names');
            inputTxt.append(opt_def)
            inputTxt.append(opt_1)
            inputTxt.append(opt_2)
            inputTxt.append(opt_3)
            inputTxt.append(opt_4)
            label1.setAttribute('for', 'contracts_names');
            label1.innerHTML = 'Contracts Names'
            row1.classList.add('row');
            row1.append(label1)
            row1.append(inputTxt)
            parentContracts.append(row1);
            parentContracts.append(row2);
        }else {
            const inputTxt = document.createElement('input');
            inputTxt.setAttribute('name', 'contracts_names');
            inputTxt.style.display = 'None'
            inputTxt.value = 'None'
            const row1 = document.createElement('div');
            row1.append(inputTxt)
            parentExamination.append(row1);
        }
    })
</script>
<?php include_once '../partials/footer.php' ?>
<?php

if(isset($_POST['submit'])) {
    // Pics
    if(isset($_FILES['examinations_pics'])) {
        foreach ($_FILES['examinations_pics']['name'] as $key => $value) {
            $img_name = $_FILES['examinations_pics']['name'][$key];
            $img_size = $_FILES['examinations_pics']['size'][$key];
            $tmp_name = $_FILES['examinations_pics']['tmp_name'][$key];
            $error = $_FILES['examinations_pics']['error'][$key];
            // header('Location:book-appointment.php?error='.$img_name);
            if($error == 0) {
                if($img_size > 50000000) {
                    die();
                }else {
                    $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ext_lc = strtolower($img_ext);
                    $allowed_ext = ['jpg','jpeg','png'];
                    if(in_array($img_ext_lc, $allowed_ext)) {
                        $new_img_name = 'examinations_pics_'.$key.date("Ydhis").'.'.$img_ext_lc;
                        // if($new_img_name) {
                        //     $oldpath = '../assets/images/examinations_pics/'.$new_img_name;
                        //     unlink($oldpath);
                        // }
                        $path = '../assets/images/examinations_pics/'.$new_img_name;
                        $upload = move_uploaded_file($tmp_name, $path);
                        if(!$upload) { 
                            $_SESSION['upload'] = '<h1 class="failed">Failed To Upload The Image</h1>';
                            header('Location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }
                    }else {
                        $_SESSION['wrong_ext'] = "<h1 class='failed'>Sorry, You Can't Use This File Type</h1>";
                        header("Refresh: 0");
                        die();
                    }
                }
            }else {
                $_SESSION['pic_error'] = "<h1 class='failed'>error</h1>";
                header("Refresh: 0");
            }
        }
            $count = count($_FILES['examinations_pics']['name']);
            if($count == 2) {
                $new_img_name_one = substr_replace($new_img_name, 0 , 18 , 1);
                $img_name_arr_examinations = [$new_img_name_one, $new_img_name];
            }elseif($count == 1) {
                $img_name_arr = [$new_img_name];
            }elseif($count == 3) {
                $new_img_name_one = substr_replace($new_img_name, 0 , 18 , 1);
                $new_img_name_two = substr_replace($new_img_name, 1 , 18 , 1);
                $img_name_arr_examinations = [$new_img_name_one,$new_img_name_two, $new_img_name];
            }
    }else {
    }
    if(isset($_FILES['contracts_pics'])) {
        foreach ($_FILES['contracts_pics']['name'] as $key => $value) {
            $img_name = $_FILES['contracts_pics']['name'][$key];
            $img_size = $_FILES['contracts_pics']['size'][$key];
            $tmp_name = $_FILES['contracts_pics']['tmp_name'][$key];
            $error = $_FILES['contracts_pics']['error'][$key];
            // header('Location:book-appointment.php?error='.$img_name);
            if($error == 0) {
                if($img_size > 50000000) {
                    die();
                }else {
                    $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ext_lc = strtolower($img_ext);
                    $allowed_ext = ['jpg','jpeg','png'];
                    if(in_array($img_ext_lc, $allowed_ext)) {
                        $new_img_name_contracts = 'contracts_pics_'.$key.date("Ydhis").'.'.$img_ext_lc;
                        // if($new_img_name) {
                        //     $oldpath = '../assets/images/contracts_pics/'.$new_img_name;
                        //     unlink($oldpath);
                        // }
                        $path = '../assets/images/contracts_pics/'.$new_img_name_contracts;
                        $upload = move_uploaded_file($tmp_name, $path);
                        if(!$upload) { 
                            $_SESSION['upload'] = '<h1 class="failed">Failed To Upload The Image</h1>';
                            header('Location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }
                    }else {
                        $_SESSION['wrong_ext'] = "<h1 class='failed'>Sorry, You Can't Use This File Type</h1>";
                        header("Refresh: 0");
                        die();
                    }
                }
            }else {
                $_SESSION['pic_error'] = "<h1 class='failed'>error</h1>";
                header("Refresh: 0");
            }
        }
            $count = count($_FILES['contracts_pics']['name']);
            if($count == 2) {
                $new_img_name_one_contracts = substr_replace($new_img_name_one_contracts, 0 , 18 , 1);
                $img_name_arr_contracts = [$new_img_name_one_contracts, $new_img_name_contracts];
            }elseif($count == 1) {
                $img_name_arr_contracts = [$new_img_name_one_contracts];
            }elseif($count == 3) {
                $new_img_name_one_contracts = substr_replace($new_img_name_contracts, 0 , 18 , 1);
                $new_img_name_two_contracts = substr_replace($new_img_name_contracts, 1 , 18 , 1);
                $img_name_arr_contracts = [$new_img_name_one_contracts,$new_img_name_two_contracts, $new_img_name_contracts];
            }
    }else {
    }
    //1. Get Data
    $specialization = $_POST['specialization'];
    $doctor_name = $_POST['doctor_name'];
    $appointment_date = $_POST['appointment_date'];
    if(isset($_POST['examinations_names']) and isset($_POST['contracts_names'])) {
        $examinations_names = $_POST['examinations_names'];
        $contracts_names = $_POST['contracts_names'];
        if($doctor_name == '' or $specialization == '' or $appointment_date == '' or $examinations_names == '') {
            $_SESSION['empty'] = '<h1 class="failed">One Of The Inputs Is Invalid</h1>';
            header("Refresh:0");
            die();
        }
        $sql = "INSERT INTO `tbl_appointment`(`doctor_name`, `specialization`, `patient_name`, `patient_gender`, `patient_age`, `patient_address`, `patient_tel`, `appointment_date` , `examinations_names`, `examinations_pics_names` , `contracts_names`, `contracts_pics_names`) VALUES    
        ('$doctor_name','$specialization','$patient_name','$patient_gender','$patient_age','$patient_address','$patient_tel','$appointment_date', '$examinations_names' ,". '\'' . $img_name_arr_examinations[0] .','. $img_name_arr_examinations[1] .'@'. $img_name_arr_examinations[2] .'\'' ." , '$contracts_names' ,". '\'' . $img_name_arr_contracts[0] .','. $img_name_arr_contracts[1] .'@'. $img_name_arr_contracts[2] .'\'' .")";
        //3. Excute Query
        $res = mysqli_query($conn, $sql);
        if($res) {
            $_SESSION['add'] = '<h1 class="success">Appointment Has Been Added Successfully</h1>';
            // header('Location:'.SITEURL.'patient/appointment-history.php?img1='.$new_img_name_one.'?img2='.$new_img_name_two.'?img3='.$new_img_name);
        }else {
            $_SESSION['add'] = '<h1 class="failed">Failed To Add Appointment</h1>';
            // header('Location:'.SITEURL.'patient/appointment-history.php');
        }
    }else {
        if($doctor_name == '' or $specialization == '' or $appointment_date == '') {
            $_SESSION['empty'] = '<h1 class="failed">One Of The Inputs Is Invalid</h1>';
            header("Refresh:0");
            die();
        }
        $sql2 = "INSERT INTO `tbl_appointment`(`doctor_name`, `specialization`, `patient_name`, `patient_gender`, `patient_age`, `patient_address`, `patient_tel`, `appointment_date` , `examinations_names` , `examinations_pics_names`, `contracts_names` , `contracts_pics_names`) VALUES 
        ('$doctor_name','$specialization','$patient_name','$patient_gender','$patient_age','$patient_address','$patient_tel','$appointment_date', 'None' , '', 'None' , '')";
        //3. Excute Query
        $res2 = mysqli_query($conn, $sql2);
        if($res2) {
            $_SESSION['add'] = '<h1 class="success">Appointment Has Been Added Successfully</h1>';
            // header('Location:'.SITEURL.'patient/appointment-history.php');
        }else {
            $_SESSION['add'] = '<h1 class="failed">Failed To Add Appointment</h1>';
            // header('Location:'.SITEURL.'patient/appointment-history.php');
        }
    }
    //2. Set Query
    // $sql = "INSERT INTO tbl_appointment SET
    // doctor_name='$doctor_name',
    // specialization='$specialization',
    // patient_name='$patient_name_db',
    // patient_gender='$patient_gender',
    // patient_age='$patient_age',
    // patient_address='$patient_address'
    // patient_tel='$patient_tel',
    // appointment_date='$appointment_date'
    // ";

}

?>
