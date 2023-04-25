<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/doctor-nav.php' ?>
<!-- Start Add -->
<div class="add">
    <div class="title">Patient Info</div>
    <?php 
        if(isset($_SESSION['empty'])) {
            echo $_SESSION['empty'];
            unset($_SESSION['empty']);
        }
        if(isset($_SESSION['test'])) {
            echo $_SESSION['test'];
            unset($_SESSION['test']);
        }
        if(isset($_SESSION['diagnosis'])) {
            echo $_SESSION['diagnosis'];
            unset($_SESSION['diagnosis']);
        }
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql2 = "SELECT * FROM tbl_appointment WHERE id='$id'";
            $res2 = mysqli_query($conn, $sql2);
            if($res2) {
                $row=mysqli_num_rows($res2);
                if($row>0) {
                    $rows=mysqli_fetch_assoc($res2);
                    $id = $rows['id'];
                    $patient_name = $rows['patient_name'];
                    $patient_gender = $rows['patient_gender'];
                    $patient_tel = $rows['patient_tel'];
                    $patient_age = $rows['patient_age'];
                    $patient_address = $rows['patient_address'];
                    $status = $rows['status'];
                    $examinations_names = $rows['examinations_names'];
                    $contracts_names = $rows['contracts_names'];
                    $examinations_pics_names = $rows['examinations_pics_names'];
                    $contracts_pics_names = $rows['contracts_pics_names'];
                }
            }
        }else {
            header('Location:view-appintment?error="No_Id_Found"');
        }
    ?>
    <div class="container">
        <form action="" method="POST">
            <div class="row">
                <label for="patient_name">Patient Name</label>
                <input type="text" name="patient_name" readonly value="<?php echo $patient_name ?>">
            </div>
            <div class="row">
                <label for="patient_age">Patient Age</label>
                <input type="text" name="patient_age" value="<?php echo $patient_age ?>" readonly>
            </div>
            <div class="row">
                <label for="patient_gender">Patient Gender</label>
                <input type="text" name="patient_gender" readonly value="<?php echo $patient_gender ?>">
            </div>
            <div class="row">
                <label for="patient_tel">Patient Tel</label>
                <input type="text" name="patient_tel" readonly value="<?php echo $patient_tel ?>">
            </div>
            <div class="row">
                <label for="patient_address">Patient Address</label>
                <input type="text" name="patient_address" readonly value="<?php echo $patient_address ?>">
            </div>
            <div class="row">
                <label for="patient_complaint">Patient Complaint</label>
                <textarea name="patient_complaint" cols="30" rows="10" placeholder="Enter Patient Complaint"></textarea>
            </div>
            <div class="parent-row-column">
                <div class="row">
                    <label for="patient_examinations">Examinations</label>
                    <input type="text" name="patient_examinations" readonly value="<?php echo $examinations_names ?>" >
                </div>
                <div class="row row-pics-examinations">
                    <label for=""></label>
                    <?php 
                    $examinations_pics_names_one_index = strpos($examinations_pics_names, ',');
                    $len = strlen($examinations_pics_names);
                    $examinations_pics_names_one = substr_replace($examinations_pics_names, '', $examinations_pics_names_one_index , $len );
                    $examinations_pics_names_two_index_demo = strpos($examinations_pics_names, ',');
                    $examinations_pics_names_two_demo = substr_replace($examinations_pics_names, '', 0 , $examinations_pics_names_two_index_demo + 1);
                    $examinations_pics_names_two_index = strpos($examinations_pics_names_two_demo, '@');
                    $examinations_pics_names_two = substr_replace($examinations_pics_names_two_demo, '' , $examinations_pics_names_two_index ,$len);
                    $examinations_pics_names_three_index = strpos($examinations_pics_names_two_demo, '@');
                    $examinations_pics_names_three = substr_replace($examinations_pics_names_two_demo, '' , 0 ,$examinations_pics_names_three_index + 1);
                    ?>
                    <!-- <div class="box"> -->
                        <!-- <div class="icon none"><i class="fa-solid fa-x"></i></div> -->
                        <img src="<?php echo '../assets/images/examinations_pics/'.$examinations_pics_names_one ?>" alt="">
                    <!-- </div> -->
                    <!-- <div class="box"> -->
                        <div class="icon none"><i class="fa-solid fa-x"></i></div>
                        <img src="<?php echo '../assets/images/examinations_pics/'.$examinations_pics_names_two ?>" alt="">
                    <!-- </div> -->
                    <!-- <div class="box"> -->
                        <div class="icon none"><i class="fa-solid fa-x"></i></div>
                        <img src="<?php echo '../assets/images/examinations_pics/'.$examinations_pics_names_three ?>" alt="">
                    <!-- </div> -->
                </div>
                <script>
                    const ex_imgs = document.querySelectorAll('.row-pics-examinations img');
                    const ex_icons = document.querySelectorAll('.row-pics .icon')
                    ex_imgs.forEach(img => {
                        img.addEventListener('click', (e) => {
                            e.currentTarget.classList.toggle('zoom')
                            window.scrollTo(0 , 0)
                            document.body.classList.toggle('overflowY')
                        })
                    });
                </script>
            </div>
            <div class="parent-row-column">
                <div class="row">
                    <label for="patient_contracts">Contracts</label>
                    <input type="text" name="patient_contracts" readonly value="<?php echo $contracts_names ?>" >
                </div>
                <div class="row row-pics-contracts">
                    <?php 
                    $contracts_pics_names_one_index = strpos($contracts_pics_names, ',');
                    $len = strlen($contracts_pics_names);
                    $contracts_pics_names_one = substr_replace($contracts_pics_names, '', $contracts_pics_names_one_index , $len );
                    $contracts_pics_names_two_index_demo = strpos($contracts_pics_names, ',');
                    $contracts_pics_names_two_demo = substr_replace($contracts_pics_names, '', 0 , $contracts_pics_names_two_index_demo + 1);
                    $contracts_pics_names_two_index = strpos($contracts_pics_names_two_demo, '@');
                    $contracts_pics_names_two = substr_replace($contracts_pics_names_two_demo, '' , $contracts_pics_names_two_index ,$len);
                    $contracts_pics_names_three_index = strpos($contracts_pics_names_two_demo, '@');
                    $contracts_pics_names_three = substr_replace($contracts_pics_names_two_demo, '' , 0 ,$contracts_pics_names_three_index + 1);
                    ?>
                    <!-- <div class="box"> -->
                        <!-- <div class="icon none"><i class="fa-solid fa-x"></i></div> -->
                        <img src="<?php echo '../assets/images/contracts_pics/'.$contracts_pics_names_one ?>" alt="">
                    <!-- </div> -->
                    <!-- <div class="box"> -->
                        <div class="icon none"><i class="fa-solid fa-x"></i></div>
                        <img src="<?php echo '../assets/images/contracts_pics/'.$contracts_pics_names_two ?>" alt="">
                    <!-- </div> -->
                    <!-- <div class="box"> -->
                        <div class="icon none"><i class="fa-solid fa-x"></i></div>
                        <img src="<?php echo '../assets/images/contracts_pics/'.$contracts_pics_names_three ?>" alt="">
                    <!-- </div> -->
                </div>
                <script>
                    const cn_imgs = document.querySelectorAll('.row-pics-contracts img');
                    cn_imgs.forEach(img => {
                        img.addEventListener('click', (e) => {
                            e.currentTarget.classList.toggle('zoom')
                            window.scrollTo(0 , 0)
                            document.body.classList.toggle('overflowY')
                        })
                    });
                </script>
            </div>
            <div class="row">
                <label for="on_examination">On Examination</label>
                <input type="text" name="on_examination" placeholder="On Examination">
            </div>
            <div class="row">
                <label for="diagnosis">Diagnosis</label>
                <input type="text" name="diagnosis" id="diagnosis" placeholder="Diagnosis">
            </div>
            <div class="row-option">
                    <label for="surgical_intervention" data-updateable="label">Surgical Intervention</label>
                    <div class="column">
                        <div id="surgical_intervention">
                            <span class="btn-text">Select Surgical Intervention</span>
                            <span class="arrow-dwn">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                        </div>
                        <div class="option">
                            <div class="opt">
                                <span class="checkbox">
                                    <i class="fa-solid fa-check check-icon"></i>
                                </span>
                                <span class="opt-text" data-price="100">HTML</span>
                            </div>
                            <div class="opt">
                                <span class="checkbox">
                                    <i class="fa-solid fa-check check-icon"></i>
                                </span>
                                <span class="opt-text" data-price="200">CSS</span>
                            </div>
                            <div class="opt">
                                <span class="checkbox">
                                    <i class="fa-solid fa-check check-icon"></i>
                                </span>
                                <span class="opt-text" data-price="300">JS</span>
                            </div>
                            <button class="select btn-primary" id="select">Select</button>
                        </div>
                    </div>
            </div>
            <div class="row">
                <label for="Surgical Price" data-updateable="label">Surgical Price</label>
                <input type="text" name="surgical_price" id="surgical_price" readonly vlaue="">
            </div>
            <div class="row">
                <label for="Final Price" data-updateable="label">Final Price</label>
                <input type="text" name="final_price" id="final_price" readonly value="">
            </div>
            <div class="row row-list row-lab">
                <label for="lab_request">Lab Request</label>
                <div class="list">
                    <div class="select-btn">
                            <span class="btn-text">Select Lab</span>
                            <span class="arrow-dwn">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                    </div>
                    <ul class="list-items-lab list-items">
                        <li class="list-title">
                            <div class="list-text">Title</div>
                            <div class="list-icon"><i class="fa-solid fa-chevron-down"></i></div>
                        </li>
                        <div class="list-container none">
                            <li class="item">
                                <div class="main">
                                    <span class="checkbox">
                                        <i class="fa-solid fa-check check-icon"></i>
                                    </span>
                                    <span class="item-text">HTML</span>
                                </div>
                                <div class="info none">
                                    <p>1</p>
                                    <p>2</p>
                                    <p>3</p>
                                </div>
                            </li>
                            <li class="item">
                                <div class="main">
                                    <span class="checkbox">
                                        <i class="fa-solid fa-check check-icon"></i>
                                    </span>
                                    <span class="item-text">Bii</span>
                                </div>
                                <div class="info none">
                                    <p>1</p>
                                    <p>2</p>
                                    <p>3</p>
                                </div>
                            </li>
                            <li class="item">
                                <div class="main">
                                    <span class="checkbox">
                                        <i class="fa-solid fa-check check-icon"></i>
                                    </span>
                                    <span class="item-text">wow</span>
                                </div>
                                <div class="info none">
                                    <p>1</p>
                                    <p>2</p>
                                    <p>3</p>
                                </div>
                            </li>
                        </div>
                        <li class="list-title">
                            <div class="list-text">Title</div>
                            <div class="list-icon"><i class="fa-solid fa-chevron-down"></i></div>
                        </li>
                        <div class="list-container none">
                            <li class="item">
                                <div class="main">
                                    <span class="checkbox">
                                        <i class="fa-solid fa-check check-icon"></i>
                                    </span>
                                    <span class="item-text">sdsd</span>
                                </div>
                                <div class="info none">
                                    <p>1</p>
                                    <p>2</p>
                                    <p>3</p>
                                </div>
                            </li>
                            <li class="item">
                                <div class="main">
                                    <span class="checkbox">
                                        <i class="fa-solid fa-check check-icon"></i>
                                    </span>
                                    <span class="item-text">hs</span>
                                </div>
                                <div class="info none">
                                    <p>1</p>
                                    <p>2</p>
                                    <p>3</p>
                                </div>
                            </li>
                            <li class="item">
                                <div class="main">
                                    <span class="checkbox">
                                        <i class="fa-solid fa-check check-icon"></i>
                                    </span>
                                    <span class="item-text">Js<span>
                                </div>
                                <div class="info none">
                                    <p>1</p>
                                    <p>2</p>
                                    <p>3</p>
                                </div>
                            </li>
                        </div>
                        <input type='submit' id="add" class="add btn-primary" value="add">
                    </ul>
                </div>
            </div>
            <div class="row row-lab-prescription lab-prescription prescription">
            </div>
            <div class="row row-list row-rad">
                <label for="rad_request">Rad Request</label>
                <div class="list">
                    <div class="select-btn">
                            <span class="btn-text">Select Radiology</span>
                            <span class="arrow-dwn">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                    </div>
                    <ul class="list-items-rad list-items">
                        <li class="list-title">
                            <div class="list-text">Title</div>
                            <div class="list-icon"><i class="fa-solid fa-chevron-down"></i></div>
                        </li>
                        <div class="list-container none">
                            <li class="item">
                                <div class="main">
                                    <span class="checkbox">
                                        <i class="fa-solid fa-check check-icon"></i>
                                    </span>
                                    <span class="item-text">rad1</span>
                                </div>
                                <div class="info none">
                                    header_register_callback
                                </div>
                            </li>
                            <li class="item">
                                <div class="main">
                                    <span class="checkbox">
                                        <i class="fa-solid fa-check check-icon"></i>
                                    </span>
                                    <span class="item-text">rad2</span>
                                </div>
                                <div class="info none">
                                    header_register_callback
                                </div>
                            </li>
                            <li class="item">
                                <div class="main">
                                    <span class="checkbox">
                                        <i class="fa-solid fa-check check-icon"></i>
                                    </span>
                                    <span class="item-text">rad5</span>
                                </div>
                                <div class="info none">
                                    header_register_callback
                                </div>
                            </li>
                        </div>
                        <li class="list-title">
                            <div class="list-text">Title</div>
                            <div class="list-icon"><i class="fa-solid fa-chevron-down"></i></div>
                        </li>
                        <div class="list-container none">
                            <li class="item">
                                <div class="main">
                                    <span class="checkbox">
                                        <i class="fa-solid fa-check check-icon"></i>
                                    </span>
                                    <span class="item-text">rad1</span>
                                </div>
                                <div class="info none">
                                    header_register_callback
                                </div>
                            </li>
                            <li class="item">
                                <div class="main">
                                    <span class="checkbox">
                                        <i class="fa-solid fa-check check-icon"></i>
                                    </span>
                                    <span class="item-text">rad2</span>
                                </div>
                                <div class="info none">
                                    header_register_callback
                                </div>
                            </li>
                            <li class="item">
                                <div class="main">
                                    <span class="checkbox">
                                        <i class="fa-solid fa-check check-icon"></i>
                                    </span>
                                    <span class="item-text">rad5</span>
                                </div>
                                <div class="info none">
                                    header_register_callback
                                </div>
                            </li>
                        </div>
                        <input type='submit' id="add" class="add btn-primary" value="add">
                    </ul>
                </div>
            </div>
            <div class="row row-rad-prescription rad-prescription prescription">
            </div>
            <div class="row row-list row-med">
                <label for="med_request">Med Request</label>
                <div class="list">
                    <div class="select-btn">
                            <span class="btn-text">Select Medicine</span>
                            <span class="arrow-dwn">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                    </div>
                    <ul class="list-items-med list-items">
                    <div class="search">
                            <i class="uil uil-search"></i>
                            <input spellcheck="false" type="text" name="search" placeholder="Search">
                        </div>
                        <input type='submit' id="med-add" class="add btn-primary" value="add">
                        <script>
                            // to use json file data
                            fetch('../assets/json/dataJSON.json')
                            .then(res => res.json())
                            .then((res) => {
                                for (var i = 1; i < 20; i++) {
                                    const main = document.createElement('div');
                                    main.classList.add('main')
                                    const item = document.createElement('li')
                                    item.classList.add('item')
                                    item.classList.add('item-med')
                                    const itemSpan = document.createElement('span')
                                    itemSpan.classList.add('checkbox')
                                    const icon = document.createElement('i')
                                    icon.classList.add("fa-solid")
                                    icon.classList.add('fa-check')
                                    icon.classList.add('check-icon')
                                    itemSpan.append(icon)
                                    const itemTxt = document.createElement('span')
                                    itemTxt.classList.add('item-text')
                                    itemTxt.innerHTML = res[""+i+""][0]
                                    main.append(itemSpan);
                                    main.append(itemTxt);
                                    item.append(main)
                                    const info = document.createElement('div')
                                    const mechanism = document.createElement('p')
                                    const company = document.createElement('p')
                                    const description = document.createElement('p')
                                    info.classList.add('info')
                                    info.classList.add('none')
                                    mechanism.innerHTML = `<strong>Mechanism of action :</strong> ${res[""+i+""][7]}`
                                    description.innerHTML = `<strong>Description :</strong> ${res[""+i+""][9]}`
                                    company.innerHTML = `<strong>Company Name :</strong> ${res[""+i+""][8]}`
                                    info.append(mechanism)
                                    info.append(description)
                                    info.append(company)
                                    item.append(info);

                                    document.querySelector('.list-items-med').append(item);
                                }
                                })
                        </script>
                    </ul>
                </div>
            </div>
            <div class="row row-med-prescription med-prescription prescription"></div>
            <div class="names-lab" id="names-lab">
            </div>
            <div class="names-rad" id="names-rad">
            </div>
            <div class="names-med" id="names-med">
            </div>
            <input type="submit" name="submit" id="end-session" value="End Session" class="btn-primary">
            <script>

            </script>
        </div>
    </form>
</div>
</div>
<?php include_once '../partials/footer.php' ?>

<script src="../assets/js/html2canvas.js"></script>
<?php include_once '../assets/js/prescriptionGenerator.php' ?>
<?php
if(isset($_POST['submit'])) {
    $patient_name_db = $_POST['patient_name'];
    $patient_age_db = $_POST['patient_age'];
    $patient_gender_db = $_POST['patient_gender'];
    $patient_tel_db = $_POST['patient_tel'];
    $patient_address_db = $_POST['patient_address'];
    $patient_complaint = $_POST['patient_complaint'];
    $patient_examinations = $_POST['patient_examinations'];
    $patient_contracts = $_POST['patient_contracts'];
    $on_examination = $_POST['on_examination'];
    $diagnosis = $_POST['diagnosis'];
    $surgical_intervention = $_POST['surgical_intervention'];
    $surgical_price = $_POST['surgical_price'];
    $final_price = $_POST['final_price'];
    $examinations_pics_names_one_db = $examinations_pics_names_one;
    $examinations_pics_names_two_db = $examinations_pics_names_two;
    $examinations_pics_names_three_db = $examinations_pics_names_three;
    $examinations_pics_names_arr = [$examinations_pics_names_one_db, $examinations_pics_names_two_db , $examinations_pics_names_three_db];
    $contracts_pics_names_one_db = $contracts_pics_names_one;
    $contracts_pics_names_two_db = $contracts_pics_names_two;
    $contracts_pics_names_three_db = $contracts_pics_names_three;
    $contracts_pics_names_arr = [$contracts_pics_names_one_db, $contracts_pics_names_two_db , $contracts_pics_names_three_db];
    $url_lab= $_COOKIE['url_lab'];
    $url_med= $_COOKIE['url_med'];
    $url_rad= $_COOKIE['url_rad'];
    if($patient_complaint == '' || $on_examination == ''|| $diagnosis == '') {
        $_SESSION['empty'] = '<h1 class="failed">One Of The Input Is Invalid</h1>';
        header('Location:patient-info.php?id='.$_GET['id'].'');
        die();
    }else {
        $sql2 = "INSERT INTO tbl_session SET
        id='$id',
        patient_name='$patient_name_db',
        patient_age='$patient_age_db',
        patient_gender='$patient_gender_db',
        patient_tel='$patient_tel_db',
        patient_address='$patient_address_db',
        patient_complaint='$patient_complaint',
        patient_examinations='$patient_examinations',
        examinations_pics='$examinations_pics_names_one_db,$examinations_pics_names_two_db@$examinations_pics_names_three_db',
        patient_contracts='$patient_contracts',
        contracts_pics='$contracts_pics_names_one_db,$contracts_pics_names_two_db@$contracts_pics_names_three_db',
        on_examination='$on_examination',
        diagnosis='$diagnosis',
        surgical_intervention='$surgical_intervention',
        surgical_price='$surgical_price',
        final_price='$final_price',
        lab_request='$lab_selected',
        medicine_request='$med_selected',
        radiology_request='$rad_selected',
        prescription_lab='$url_lab',
        prescription_med='$url_med',
        prescription_rad='$url_rad'
        ";
        $res = mysqli_query($conn, $sql2);
        if($res) {
            $_SESSION['patient_info_saved'] = '<h1 class="success">Patient Info Has Been Save Successfully</h1>';
            header('Location:update-status.php?id='.$_GET['id'].'&status=seen');
        }else {
            $_SESSION['patient_info_saved'] = '<h1 class="failed">Failed To Save Patient Info</h1>';
            header("Location:view-appointment.php");
        }
    }
    ?>
    <?php
    
}
?>

