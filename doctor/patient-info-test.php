<?php include_once '../partials/menu.php' ?>
<?php include_once '../partials/doctor-nav.php' ?>


<!-- Start Add -->
<div class="add">
    <div class="title">Patient Info</div>
    <?php 
        if(isset($_SESSION['empty'])) {
            if($_SESSION['empty'] === '<h1 class="failed">One Of The Inputs Is Invalid</h1>') {
                echo $_SESSION['empty'];
                unset($_SESSION['empty']);
            }
        }
        if(isset($_SESSION['test'])) {
            echo $_SESSION['test'];
            unset($_SESSION['test']);
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
                    $examinations_pics_names = $rows['examinations_pics_names'];
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
                <div class="row row-pics">
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
                    const imgs = document.querySelectorAll('.row-pics img');
                    const icons = document.querySelectorAll('.row-pics .icon')
                    imgs.forEach(img => {
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
                <input type="text" name="diagnosis" placeholder="Diagnosis">
            </div>
            <div class="row row-list row-lab">
                <label for="lab_request">Lab Request</label>
                <div class="gap">
                    <div class="row-center">
                        <input type="text" name="lab_selected" readonly class="selected">
                    </div>
                    <div class="content">
                        <div class="search">
                            <i class="uil uil-search"></i>
                            <input spellcheck="false" type="text" placeholder="Search">
                        </div>
                        <ul class="options"></ul>
                        <input type="submit" name="add" value="Add" class="btn-primary" style="margin-top:2rem ;">
                    </div> 
                    <div class="select-btn">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div> 
                </div>
            </div>
            <div class="row row-lab-prescription lab-prescription prescription">

            </div>
            <div class="row row-list row-radiology">
                <label for="radiology_request">Radiology Request</label>
                <div class="gap">
                    <div class="row-center">
                        <input type="text" name="med_selected" readonly class="selected">
                    </div>
                    <div class="content">
                        <div class="search">
                            <i class="uil uil-search"></i>
                            <input spellcheck="false" type="text" placeholder="Search">
                        </div>
                        <ul class="options"></ul> 
                    </div> 
                    <div class="select-btn">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div> 
                </div>
            </div>
            <div class="row row-radiology-prescription radiology-prescription prescription">

            </div>
            <div class="row row-list row-medicine">
                <label for="midicine_request">Medicine Request</label>
                <div class="gap">
                    <div class="row-center">
                    <input type="text" name="rad_selected" readonly class="selected">
                    </div>
                    <div class="content">
                        <div class="search">
                            <i class="uil uil-search"></i>
                            <input spellcheck="false" type="text" placeholder="Search">
                        </div>
                        <ul class="options"></ul>
                    </div> 
                    <div class="select-btn">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div> 
                </div>
            </div>
            <div class="row row-medicine-prescription medicine-prescription prescription">

            <input type="submit" name="submit" id="sub_ma" value="Book Appontment" class="btn-primary">
            </div>
            <script src="../assets/js/html2canvas.js"></script>
            <script>
                    const rowLab = document.querySelector(`.row-lab`),
                    selectBtnLab = rowLab.querySelector(".select-btn"),
                    searchInpLab = rowLab.querySelector("input"),
                    optionsLab = rowLab.querySelector(".options"),
                    selectedTxtLab = rowLab.querySelector(".selected")
                    const rowCenterLab = document.querySelector('.row-lab .row-center')
                    const rowCenterMed = document.querySelector('.row-medicine .row-center')
                    const rowCenterRad = document.querySelector('.row-radiology .row-center')
                    const labPrescription = document.querySelector('.lab-prescription');
                    const radPrescription = document.querySelector('.radiology-prescription');
                    const medPrescription = document.querySelector('.medicine-prescription');
                    var url;
                    var mainRtlTxt;
                    var editIcon;
                    var prescSec;
                    var header;
                    var info;
                    var prescriptionCont;
                    var footer;
                    var uploadBtn;
                    let labArr = ["lab1", 'bab2'];
                    function createPrescription(val1,mainSec,prescSecPram,btnSecParam,request,id) {
                        header = document.createElement('div');
                        header.classList.add('header');
                        const logo = document.createElement('div');
                        logo.classList.add('logo');
                        const logoImg = document.createElement('img');
                        logoImg.src = '../assets/images/logo.png'
                        header.append(logo);
                        logo.append(logoImg);
                        
                        info = document.createElement('div');
                        info.classList.add('info');
                        const infoColumn = document.createElement('div')
                        infoColumn.classList.add('column');
                        info.append(infoColumn);
                        
                        const patientName = document.createElement('div');
                        patientName.id = 'patient-name'
                        const patientNameTxt = document.createElement('p')
                        patientNameTxt.innerHTML = 'اسم المريض : <?php echo $patient_name ?>'
                        patientName.append(patientNameTxt)
                        
                        const diagnosis = document.createElement('div');
                        diagnosis.id = 'diagnosis'
                        const diagnosisTxt = document.createElement('p')
                        diagnosisTxt.innerHTML = `التشخيص : ${val1.value}`
                        diagnosis.append(diagnosisTxt)


                        const date = document.createElement('div');
                        date.id = 'date'
                        const dateTxt = document.createElement('p')
                        dateTxt.innerHTML = `التاريخ : <?php echo date('d / m / Y') ?>`
                        date.append(dateTxt)

                        infoColumn.append(patientName);
                        infoColumn.append(diagnosis);
                        info.append(date);

                        prescriptionCont = document.createElement('div');
                        prescriptionCont.classList.add('prescription-cont')
                        const prescriptionContLogo = document.createElement('div');
                        prescriptionContLogo.classList.add('logo')
                        prescriptionContLogo.innerHTML = 'R /';
                        prescriptionCont.append(prescriptionContLogo)
                        
                        const overlayImgParent = document.createElement('div');
                        overlayImgParent.classList.add('overlay-img')
                        const overlayImg = document.createElement('img');
                        overlayImg.src = '../assets/images/logo.png'
                        overlayImgParent.append(overlayImg);
                        
                        const main = document.createElement('div');
                        main.classList.add('main', 'column')
                        const mainRtl = document.createElement('div');
                        mainRtl.classList.add('rtl')
                        mainRtlTxt = document.createElement('p')
                        editIcon = document.createElement('p');
                        editIcon.classList.add('edit')
                        editIcon.innerHTML = '<i class="fa-solid fa-pen-to-square"></i>';
                        mainRtlTxt.innerHTML = `طلب ${request} : ${val1.value}`
                        mainRtl.append(mainRtlTxt)
                        mainRtl.append(editIcon)
                        main.append(mainRtl)

                        editIcon.addEventListener('click', () => {
                            edit(request,val1)
                        })

                        prescriptionCont.append(main)
                        prescriptionCont.append(overlayImgParent)

                        footer = document.createElement('div');
                        footer.classList.add('footer')

                        const prescriptionRowFooter = document.createElement('div')
                        prescriptionRowFooter.classList.add('prescription-row-footer')
                        
                        const prescriptionRowFooterIcon = document.createElement('p')
                        prescriptionRowFooterIcon.classList.add('icon')
                        prescriptionRowFooterIcon.innerHTML = '<i class="fa-solid fa-location-dot"></i>'
                        
                        
                        const prescriptionRowFooterAddress = document.createElement('p')
                        prescriptionRowFooterAddress.classList.add('address')
                        prescriptionRowFooterAddress.innerHTML = '٦ اكتوبر - ٣٦١ المحور المركزي - امام التوحيد والنور بجوار المنوفي الكبابجي'
                        
                        footer.append(prescriptionRowFooter)
                        prescriptionRowFooter.append(prescriptionRowFooterIcon)
                        prescriptionRowFooter.append(prescriptionRowFooterAddress)

                        const prescriptionParentRowFooter = document.createElement('div')
                        prescriptionParentRowFooter.classList.add('prescription-parent-row-footer')

                        const prescriptionRowFooterSecond = document.createElement('div')
                        prescriptionRowFooterSecond.classList.add('prescription-row-footer')
                        
                        const prescriptionRowFooterSecondIcon = document.createElement('p')
                        prescriptionRowFooterSecondIcon.classList.add('icon')
                        prescriptionRowFooterSecondIcon.innerHTML = '<i class="fa-sharp fa-solid fa-phone"></i>'
                        
                        const prescriptionRowFooterSecondFlat = document.createElement('p')
                        prescriptionRowFooterSecondFlat.classList.add('flat')
                        prescriptionRowFooterSecondFlat.innerHTML = 'الدور الثاني شقة ٤ ت: ٠١٠٢٤٨٢٤٧١٦'
                        

                        footer.append(prescriptionParentRowFooter)
                        prescriptionParentRowFooter.append(prescriptionRowFooterSecond)
                        prescriptionRowFooterSecond.append(prescriptionRowFooterSecondIcon)
                        prescriptionRowFooterSecond.append(prescriptionRowFooterSecondFlat)

                        const prescriptionRowFooterThird = document.createElement('div')
                        prescriptionRowFooterThird.classList.add('prescription-row-footer')
                        
                        const prescriptionRowFooterThirdIcon = document.createElement('p')
                        prescriptionRowFooterThirdIcon.classList.add('icon')
                        prescriptionRowFooterThirdIcon.innerHTML = '<i class="fa-brands fa-whatsapp"></i>'
                        
                        const prescriptionRowFooterThirdSite = document.createElement('a')
                        prescriptionRowFooterThirdSite.href = 'www.waleedhaikal.com';
                        prescriptionRowFooterThirdSite.classList.add('site')
                        prescriptionRowFooterThirdSite.innerHTML = 'www.waleedhaikal.com'
                        
                        prescriptionParentRowFooter.append(prescriptionRowFooterThird)
                        prescriptionRowFooterThird.append(prescriptionRowFooterThirdIcon)
                        prescriptionRowFooterThird.append(prescriptionRowFooterThirdSite)

                        prescSec = document.createElement('div');
                        prescSec.classList.add('column-prescription');

                        const btnSec = document.createElement('div');
                        btnSec.classList.add('btn-section');

                        const delBtn = document.createElement('p');
                        delBtn.innerHTML = '<i class="fa-sharp fa-solid fa-trash"></i>'
                        delBtn.id = 'delBtn';
                        
                        delBtn.addEventListener('click',() => {
                            deletePresc();
                        })

                        uploadBtn = document.createElement('p');
                        uploadBtn.innerHTML = '<i class="fa-solid fa-upload"></i>';
                        uploadBtn.id = 'uploadBtn';

                        uploadBtn.addEventListener('click', () => {
                            uploadPresc(prescSec, id);
                        })
                        
                        const printBtn = document.createElement('p');
                        printBtn.innerHTML ='<i class="fa-solid fa-print"></i>'
                        printBtn.id = 'printBtn';

                        printBtn.addEventListener('click', () => {
                            printPresc();
                        })

                        mainSec.append(btnSec);
                        btnSec.append(uploadBtn)
                        btnSec.append(delBtn)
                        btnSec.append(printBtn)
                        mainSec.append(prescSec);
                        prescSec.append(header);
                        prescSec.append(info);
                        prescSec.append(prescriptionCont);
                        prescSec.append(footer);
                        // section.append(delBtn);
                        // section.append(printBtn);
                    }
                    function doCapture(mainSec,id) {
                        html2canvas(mainSec).then(function (canvas) {
                            // Create an AJAX object
                            var ajax = new XMLHttpRequest();

                            // Setting method, server file name, and asynchronous
                            ajax.open("POST", `../partials/save-capture.php?id=${id}`, true);
                            // window.open(`../partials/save-capture.php?id=${id}`)
                            
                            // Setting headers for POST method
                            ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            
                            // Sending image data to server
                            ajax.send("image=" + canvas.toDataURL("image/jpeg", 0.9));

                            // Receiving response from server
                            // This function will be called multiple times
                            ajax.onreadystatechange = function () {
                                // Check when the requested is completed
                                if (this.readyState == 4 && this.status == 200) {
                                    console.log(this.responseText);
                                    // Displaying response from server
                                    url = this.responseText.replace(';' , ' ');
                                    
                                    setTimeout(() => {
                                        createImg(mainSec,url,id)
                                    }, 2000);
                                }
                            };
                        });
                    }
                    var prescriptionImg;
                    function createImg(mainSec,url,id) {
                        prescriptionImg = document.createElement('img');
                        prescriptionImg.src = url;
                        document.cookie = `url_${id}=${prescriptionImg.src}`
                        // document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
                        console.log(document.cookie);
                        console.log(prescriptionImg.src);
                        mainSec.append(prescriptionImg);

                    }
                    var popup;
                    function printPresc() {
                        function closePrint () {
                            if ( popup ) {
                                popup.close();
                            }
                        }
                        popup = window.open(prescriptionImg.src);
                        popup.onbeforeunload = closePrint;
                        popup.onafterprint = closePrint;
                        popup.focus(); // Required for IE
                        popup.print();
                        if(popup.print()) {
                            window.close();
                        }
                    }
                    function addCountryLab(selectedLab) {
                        optionsLab.innerHTML = "";
                        labArr.forEach(lab => {
                            let isSelected = lab == selectedLab ? "selected" : "";
                            let li = `<li onclick="updateNameLab(this)" class="${isSelected}">${lab}</li>`;
                            optionsLab.insertAdjacentHTML("beforeend", li);
                        });
                    }
                    addCountryLab();
                    var prescSecVal;
                    var idVal;
                    function createGenerator(val1,mainSec,prescSecPram,btnSecParam,request,id,val3) {
                        const generate = document.createElement('p');
                        generate.innerHTML = 'Generate';
                        generate.classList.add('generate')
                        val3.append(generate);
                        generate.onclick = () => {
                            generate.remove();
                            createPrescription(val1,mainSec,prescSecPram,btnSecParam,request,id);
                            prescSecVal = prescSecPram;
                            idVal = id;
                        }
                    }
                    function uploadPresc(prescSec, id) {
                        editIcon.remove();
                        uploadBtn.remove();
                        setTimeout(() => {
                            header.remove()
                            info.remove()
                            prescriptionCont.remove()
                            footer.remove()
                        }, 2100);
                        doCapture(prescSec, id);
                    }
                    function updateNameLab(selectedLi) {
                        searchInpLab.value = "";
                        addCountryLab(selectedLi.innerText);
                        rowLab.classList.remove("active");
                        selectedTxtLab.value = selectedLi.innerText;
                        createGenerator(selectedTxtLab, labPrescription,document.querySelector('.column-prescription'),document.querySelector('.btn-section'),'التحاليل','lab',rowCenterLab);
                    }
                    function edit(request,oldVal) {
                        const editInp = document.createElement('input');
                        const submitInp = document.createElement('input');
                        const inpRow = document.createElement('div')
                        inpRow.classList.add('row');
                        submitInp.type = 'submit';
                        editInp.value = oldVal.value;
                        submitInp.addEventListener('click',(e) => {
                            e.preventDefault();
                            mainRtlTxt.innerHTML = `طلب ${request} : ${editInp.value}`
                        })
                        inpRow.append(editInp);
                        inpRow.append(submitInp);
                        mainRtlTxt.append(inpRow);
                    }
                    searchInpLab.addEventListener("keyup", () => {
                        let arr = [];
                        let searchWord = searchInpLab.value.toLowerCase();
                        arr = labArr.filter(data => {
                            return data.toLowerCase().startsWith(searchWord);
                        }).map(data => {
                            let isSelected = data == selectBtnLab.firstElementChild.innerText ? "selected" : "";
                            return `<li onclick="updateNameLab(this)" class="${isSelected}">${data}</li>`;
                        }).join("");
                        optionsLab.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! Lab Request not found</p>`;
                    });
                    selectBtnLab.addEventListener("click", () => rowLab.classList.toggle("active"));
                    // 
                    const rowMed = document.querySelector(`.row-medicine`),
                    selectBtnMed = rowMed.querySelector(".select-btn"),
                    searchInpMed = rowMed.querySelector("input"),
                    optionsMed = rowMed.querySelector(".options"),
                    selectedTxtMed = rowMed.querySelector(".selected")
                    let medicineArr = ["augmentin","aux",'box','back'];
                    function addCountryMed(selectedMed) {
                        optionsMed.innerHTML = "";
                        medicineArr.forEach(med => {
                            let isSelected = med == selectedMed ? "selected" : "";
                            let li = `<li onclick="updateNameMed(this)" class="${isSelected}">${med}</li>`;
                            optionsMed.insertAdjacentHTML("beforeend", li);
                        });
                    }
                    addCountryMed();
                    function updateNameMed(selectedLi) {
                        searchInpMed.value = "";
                        addCountryMed(selectedLi.innerText);
                        rowMed.classList.remove("active");
                        selectedTxtMed.value = selectedLi.innerText;
                        createGenerator(selectedTxtMed,medPrescription,document.querySelector('.column-prescription'),document.querySelector('.btn-section'),'الدواء','med',rowCenterMed);
                    }
                    searchInpMed.addEventListener("keyup", () => {
                        let arr = [];
                        let searchWord = searchInpMed.value.toLowerCase();
                        arr = medicineArr.filter(data => {
                            return data.toLowerCase().startsWith(searchWord);
                        }).map(data => {
                            let isSelected = data == selectBtnMed.firstElementChild.innerText ? "selected" : "";
                            return `<li onclick="updateNameMed(this)" class="${isSelected}">${data}</li>`;
                        }).join("");
                        optionsMed.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! Medicine not found</p>`;
                    });
                    selectBtnMed.addEventListener("click", () => rowMed.classList.toggle("active"));
                    // 
                    const rowRad = document.querySelector('.row-radiology'),
                    selectBtnRad = rowRad.querySelector(".select-btn"),
                    searchInpRad = rowRad.querySelector("input"),
                    optionsRad = rowRad.querySelector(".options"),
                    selectedTxtRad = rowRad.querySelector(".selected")
                    let radiologyArr = ["AfghanistanRad"];
                    function addCountryRad(selectedRad) {
                        optionsRad.innerHTML = "";
                        radiologyArr.forEach(rad => {
                            let isSelected = rad == selectedRad ? "selected" : "";
                            let li = `<li onclick="updateNameRad(this)" class="${isSelected}">${rad}</li>`;
                            optionsRad.insertAdjacentHTML("beforeend", li);
                        });
                    }
                    addCountryRad();
                    function updateNameRad(selectedLi) {
                        searchInpRad.value = "";
                        addCountryRad(selectedLi.innerText);
                        rowRad.classList.remove("active");
                        selectedTxtRad.value = selectedLi.innerText;
                        createGenerator(selectedTxtRad,radPrescription,document.querySelector('.column-prescription'),document.querySelector('.btn-section'),'الاشعة','rad',rowCenterRad);
                    }
                    searchInpRad.addEventListener("keyup", () => {
                        let arr = [];
                        let searchWord = searchInpRad.value.toLowerCase();
                        arr = radiologyArr.filter(data => {
                            return data.toLowerCase().startsWith(searchWord);
                        }).map(data => {
                            let isSelected = data == selectBtnRad.firstElementChild.innerText ? "selected" : "";
                            return `<li onclick="updateNameRad(this)" class="${isSelected}">${data}</li>`;
                        }).join("");
                        optionsRad.innerHTML = arr ? arr : `<p style="margin-top: 10px;">Oops! Country not found</p>`;
                    });
                    selectBtnRad.addEventListener("click", () => rowRad.classList.toggle("active"));
            </script>
        </form>
    </div>
</div>
<?php include_once '../partials/footer.php' ?>

<?php
if(isset($_POST['submit'])) {

    // echo <<<"Now"
    // <script>
    //     document.getElementById("sub_ma").addEventListener("click", (e) => {
    //         e.preventDefault()
    //         console.log(prescSec);
    //     })
    // </script>
    // Now;
    // // doCapture(prescSec,idVal)

    header("Location:patient-info.php?id=195?url_lab=".$url_lab."&url_med=".$url_med."&url_rad=".$url_rad);
    $patient_name_db = $_POST['patient_name'];
    $patient_age_db = $_POST['patient_age'];
    $patient_gender_db = $_POST['patient_gender'];
    $patient_tel_db = $_POST['patient_tel'];
    $patient_address_db = $_POST['patient_address'];
    $patient_complaint = $_POST['patient_complaint'];
    $patient_examinations = $_POST['patient_examinations'];
    $on_examination = $_POST['on_examination'];
    $diagnosis = $_POST['diagnosis'];
    $examinations_pics_names_one_db = $examinations_pics_names_one;
    $examinations_pics_names_two_db = $examinations_pics_names_two;
    $examinations_pics_names_three_db = $examinations_pics_names_three;
    // $examinations_pics_names_arr = [$examinations_pics_names_one_db];
    $examinations_pics_names_arr = [$examinations_pics_names_one_db, $examinations_pics_names_two_db , $examinations_pics_names_three_db];
    $lab_selected = $_POST['lab_selected'];
    $med_selected = $_POST['med_selected'];
    $rad_selected = $_POST['rad_selected'];
    $url_lab= $_COOKIE['url_lab'];
    $url_med= $_COOKIE['url_med'];
    $url_rad= $_COOKIE['url_rad'];
    
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
    on_examination='$on_examination',
    diagnosis='$diagnosis',
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