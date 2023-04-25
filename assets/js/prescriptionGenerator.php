<?php
?>
<script>
setTimeout(() => {
    const searchInp = document.querySelector('input[name="search"]')
    searchInp.addEventListener('keyup', (e) => {
        const searchBox = searchInp.value.toUpperCase()
        const medItems = document.querySelectorAll('.list-items-med .item');
        const txt = document.querySelectorAll('.list-items-med .item-text')
        for(let i =0; i< txt.length;i++) {
            const match = medItems[i].querySelectorAll('.list-items-med .item-text')[0];
            if(match) {
                let txtVal = match.textContent || match.innerHTML;
                if(txtVal.toUpperCase().indexOf(searchBox) > -1) {
                    medItems[i].style.display = ''
                }else {
                    medItems[i].style.display = 'none'
                }
            }
        }
    })
    const listTitle = document.querySelectorAll(".list-title");
    listTitle.forEach(title => {
        title.addEventListener('click', () => {
            title.nextElementSibling.classList.toggle('none');
        }) 
    });
    const rowLab = document.querySelector(`.row-lab`),
    selectBtnLab = rowLab.querySelector(".select-btn"),
    searchInpLab = rowLab.querySelector("input"),
    selectedTxtLab = rowLab.querySelector(".selected"),
    itemLab = rowLab.querySelectorAll(".list-items-lab .item"),
    addBtnLab = rowLab.querySelector(".list-items-lab #add"),
    itemTxtLab = document.querySelectorAll(`.list-items-lab .main .item-text`);
    const rowMed = document.querySelector(`.row-med`),
    selectBtnMed = rowMed.querySelector(".select-btn"),
    searchInpMed = rowMed.querySelector("input"),
    selectedTxtMed = rowMed.querySelector(".selected"),
    addBtnMed = rowMed.querySelector("#med-add"),
    itemTxtMed = document.querySelectorAll(`.list-items-med .item-text`);
    const rowRad = document.querySelector(`.row-rad`),
    selectBtnRad = rowRad.querySelector(".select-btn"),
    searchInpRad = rowRad.querySelector("input"),
    selectedTxtRad = rowRad.querySelector(".selected"),
    itemRad = rowRad.querySelectorAll(".list-items-rad .item"),
    addBtnRad = rowRad.querySelector(".list-items-rad #add"),
    itemTxtRad = document.querySelectorAll(`.list-items-rad .item-text`);
    const namesLab = document.getElementById('names-lab');
    const namesMed = document.getElementById('names-med');
    const namesRad = document.getElementById('names-rad');
    const labPrescription = document.querySelector('.lab-prescription');
    const radPrescription = document.querySelector('.rad-prescription');
    const medPrescription = document.querySelector('.med-prescription');
    var mainRtlTitle;
    var mainText;
    var url;
    var editIcon;
    var prescSec;
    var header;
    var info;
    var prescriptionCont;
    var footer;
    var uploadBtn;
    function createPrescription(txtVal,mainSec,prescSecPram,btnSecParam,request,id) {
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
        patientNameTxt.innerHTML = 'المريض : <?php echo $patient_name ?>'
        patientName.append(patientNameTxt)
        
        const patientAge = document.createElement('div');
        patientAge.id = 'patient-age'
        const patientAgeTxt = document.createElement('p')
        patientAgeTxt.innerHTML = 'السن : <?php echo $patient_age ?>'
        patientAge.append(patientAgeTxt)
        
        const diagnosis = document.createElement('div');
        diagnosis.id = 'diagnosis'
        const diagnosisTxt = document.createElement('p')
        diagnosisTxt.innerHTML = `التشخيص : ${document.querySelector('input[name="diagnosis"]').value}`
        diagnosis.append(diagnosisTxt)


        const date = document.createElement('div');
        date.id = 'date'
        const dateTxt = document.createElement('p')
        dateTxt.innerHTML = `التاريخ : <?php echo date('d / m / Y') ?>`
        date.append(dateTxt)

        infoColumn.append(patientName);
        infoColumn.append(patientAge);
        infoColumn.append(diagnosis);
        infoColumn.append(date);

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
        mainRtlTitleAr = document.createElement('p')
        mainRtlTitleEn = document.createElement('p')
        mainRtlBr = document.createElement('br')


        mainRtl.append(mainRtlTitleAr)
        mainRtl.append(mainRtlBr)
        mainRtl.append(mainRtlTitleEn)
        // mainRtl.append(editIcon)
        main.append(mainRtl)

        editIcon = document.createElement('p');
        editIcon.classList.add('edit')
        editIcon.innerHTML = '<i class="fa-solid fa-pen-to-square"></i>';
        const editInp = document.createElement('textarea');
        const editSub = document.createElement('input');
        const inpRow = document.createElement('div')
        mainRtlTitleAr.innerHTML = `${request}`
        mainRtlTitleEn.innerHTML = `${id}`
        inpRow.classList.add('edit-row');
        editSub.classList.add('edit-sub');
        
        editInp.classList.add('edit-inp');
        editSub.type = 'submit';
        editInp.innerHTML = txtVal.innerText;
        inpRow.append(editInp);
        inpRow.append(editSub);
        inpRow.classList.add('none')
        editIcon.addEventListener('click', () => {
            edit(request,txtVal)
        })
        
        mainText = document.createElement('div')
        mainText.classList.add('main-text')
        txtVal.append(editIcon)
        mainText.append(txtVal)
        mainText.append(inpRow)
        main.append(mainText)
        // prescriptionCont.append(overlayImgParent)
        
        prescriptionCont.append(main)
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
        prescriptionRowFooterSecondFlat.innerHTML = 'الدور الثاني ت: ٠١٠٢٤٨٢٤٧١٦'

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
        prescriptionRowFooterThirdSite.innerHTML = 'www .waleedhaikal.com'
        
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
            delPresc(prescSec);
        })

        let row = document.createElement('div');
        row.classList.add('presc-row');

        uploadBtn = document.createElement('p');
        uploadBtn.innerHTML = '<i class="fa-solid fa-upload"></i>';
        uploadBtn.id = 'uploadBtn';
        
        uploadBtn.addEventListener('click', () => {
        setTimeout(() => {
            btnSec.append(printBtn)
            row.style.border = 'none'
        }, 600);
        prescriptionCont.style.padding = '0'
        prescSec.style.border = 'none'
        uploadPresc(prescSec, id);
        })
        
        const printBtn = document.createElement('p');
        printBtn.innerHTML ='<i class="fa-solid fa-print"></i>'
        printBtn.id = 'printBtn';

        printBtn.addEventListener('click', () => {
            printPresc();
        })


        btnSec.style.zIndex = 1000;
        mainSec.style.gap = '3rem';
        mainSec.append(btnSec);
        btnSec.append(uploadBtn)
        mainSec.append(prescSec);
        row.append(header)
        row.append(info)
        prescSec.append(row)
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
                    }, 500);
                }
            };
        });
    }
    var prescriptionImg;
    function createImg(mainSec,url,id) {
        prescriptionImg = document.createElement('img');
        prescriptionImg.src = url;
        document.cookie = `url_${id}=${prescriptionImg.src}`
        console.log(document.cookie);
        console.log(prescriptionImg.src);
        mainSec.append(prescriptionImg);
    }
    function delPresc(prescSec) {
        prescSec.remove()
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
    function uploadPresc(prescSec, id) {
            editIcon.remove();
            uploadBtn.remove();
            setTimeout(() => {
                header.remove()
                info.remove()
                prescriptionCont.remove()
                footer.remove()
            }, 600);
            doCapture(prescSec, id);
    }
    function edit(request,txtVal) {
        const editInpE = document.querySelectorAll('.edit-row .edit-inp');
        const editSubE = document.querySelectorAll('.edit-row .edit-sub');
        const editRowE = document.querySelectorAll('.edit-row');
        editRowE.forEach(editRowE => {
            editRowE.classList.remove('none')
        });
        editSubE.forEach(editSubE => {
            editSubE.addEventListener('click',(e) => {
                e.preventDefault();
                for (let i = 0; i < editInpE.length; i++) {
                    const len = editInpE[i].value.split('\n').length;
                    const spl = editInpE[i].value.split('\n');
                    for (let i = 0; i < len; i++) {
                        if(document.querySelectorAll('.item-names-lab')[i]) {
                            document.querySelectorAll('.item-names-lab')[i].innerHTML = spl[i];
                        }else if(document.querySelectorAll('.item-names-rad')[i]) {
                            document.querySelectorAll('.item-names-rad')[i].innerHTML = spl[i];
                        }else if(document.querySelectorAll('.item-names-med')[i]) {
                            document.querySelectorAll('.item-names-med')[i].innerHTML = spl[i];
                        }
                    }
                }
                editRowE.forEach(editRowE => {
                    editRowE.classList.add('none')
                });
            })
        });
    }
    function createGenerator(txtVal,mainSec,prescSecPram,btnSecParam,request,id,val3) {
        const generate = document.createElement('p');
        generate.innerHTML = `Generate ${id}`;
        generate.classList.add(`generate`)
        generate.classList.add(`generate-${id}`)
        val3.append(generate);
        if(generate.classList.contains('generate-lab')) {
            generate.onclick = () => {
                selectBtnLab.remove();
                document.querySelector('.row-lab .list').remove();
                generate.remove();
                    itemTxtLab.forEach(txt => {
                        const parent = txt.parentElement;
                        const realParent = parent.parentElement;
                        if(realParent.classList.contains('checked')) {
                            txt.classList.remove('item-text')
                            txt.classList.add('item-names-lab')
                            txt.style.direction = 'ltr';
                            realParent.remove()
                            namesLab.append(txt)
                        }
                    });
                createPrescription(namesLab,mainSec,prescSecPram,btnSecParam,request,id);
            }
        }else if(generate.classList.contains('generate-med')) {
            setTimeout(() => {
            generate.onclick = () => {
            selectBtnMed.remove();
            document.querySelector('.row-med .list').remove();
                generate.remove();
                console.log(itemTxtMed);
                    itemTxtMed.forEach(txt => {
                        const parent = txt.parentElement;
                        const realParent = parent.parentElement;
                        console.log(realParent);
                        if(realParent.classList.contains('checked')) {
                            txt.classList.remove('item-text')
                            txt.classList.add('item-names-med')
                            txt.style.direction = 'ltr';
                            realParent.remove()
                            namesMed.append(txt)
                        }
                    });
                createPrescription(namesMed,mainSec,prescSecPram,btnSecParam,request,id);
            }
            }, 200);
        }else if(generate.classList.contains('generate-rad')) {
            generate.onclick = () => {
            document.querySelector('.row-rad .list').remove();
            selectBtnRad.remove();
            generate.remove();
                    itemTxtRad.forEach(txt => {
                        const parent = txt.parentElement;
                        const realParent = parent.parentElement;
                        console.log(realParent);
                        if(realParent.classList.contains('checked')) {
                            txt.classList.remove('item-text')
                            txt.classList.add('item-names-rad')
                            txt.style.direction = 'ltr';
                            realParent.remove()
                            namesRad.append(txt)
                        }
                    });
                createPrescription(namesRad,mainSec,prescSecPram,btnSecParam,request,id);
            }
        }
    }
    // Lab
    itemLab.forEach(item => {
        const info = item.lastElementChild;
        item.onmouseenter = () => {
            info.classList.remove('none')
        }
        item.onmouseleave = () => {
            info.classList.add('none')
        }
        item.addEventListener("click", () => {
            item.classList.toggle("checked");
            let checked = document.querySelectorAll(".row-lab .checked"),
                btnText = document.querySelector(".row-lab .btn-text");
                if(checked && checked.length > 0){
                    btnText.innerText = `${checked.length} Selected`;
                }else{
                    btnText.innerText = "Select Language";
                }
        });
    })
    var txtVal;
    addBtnLab.addEventListener('click', (e) => {
        e.preventDefault();
        if(document.querySelector('input[name="diagnosis"]').value != '') {
            createGenerator(txtVal, labPrescription,document.querySelector('.column-prescription'),document.querySelector('.btn-section'),'التحاليل','lab',rowLab);
            document.querySelector('.row-lab .select-btn').classList.remove('open')
            if(document.querySelectorAll('.generate-lab').length > 1) {
                document.querySelectorAll('.generate-lab')[0].remove()
            }
        }else {
            alert('we need diagnosis')
        }
    })
    selectBtnLab.addEventListener("click", () => {
        selectBtnLab.classList.toggle("open");
    });
    // Med
    var txtVal;
    addBtnMed.addEventListener('click', (e) => {
        e.preventDefault();
        if(document.querySelector('input[name="diagnosis"]').value != '') {
            createGenerator(txtVal, medPrescription,document.querySelector('.column-prescription'),document.querySelector('.btn-section'),'الدواء','med',rowMed);
            document.querySelector('.row-med .select-btn').classList.remove('open')
            if(document.querySelectorAll('.generate-med').length > 1) {
                document.querySelectorAll('.generate-med')[0].remove()
            }
        }else {
                alert('we need diagnosis bruh')
        }
    })
    selectBtnMed.addEventListener("click", () => {
        selectBtnMed.classList.toggle("open");
    });
    document.querySelectorAll('.list-items-med .item').forEach(item => {
        const info = item.lastElementChild;
        item.onmouseenter = () => {
            info.classList.remove('none')
        }
        item.onmouseleave = () => {
            info.classList.add('none')
        }
        item.addEventListener("click", () => {
            item.classList.toggle("checked");
            let checked = document.querySelectorAll(".row-med .checked"),
                btnText = document.querySelector(".row-med .btn-text");
                if(checked && checked.length > 0){
                    btnText.innerText = `${checked.length} Selected`;
                }else{
                    btnText.innerText = "Select Language";
                }
        });
    })
    // Rad
    var txtVal;
    addBtnRad.addEventListener('click', (e) => {
        e.preventDefault();
        if(document.querySelector('input[name="diagnosis"]').value != '') {
            createGenerator(txtVal, radPrescription,document.querySelector('.column-prescription'),document.querySelector('.btn-section'),'الفحص','rad',rowRad);
            document.querySelector('.row-rad .select-btn').classList.remove('open')
            if(document.querySelectorAll('.generate-rad').length > 1) {
                document.querySelectorAll('.generate-rad')[0].remove()
            }
        }else {
                alert('we need diagnosis bruh')
        }
    })
    selectBtnRad.addEventListener("click", () => {
        selectBtnRad.classList.toggle("open");
    });
    itemRad.forEach(item => {
        const info = item.lastElementChild;
        item.onmouseenter = () => {
            info.classList.remove('none')
        }
        item.onmouseleave = () => {
            info.classList.add('none')
        }
        item.addEventListener("click", () => {
            item.classList.toggle("checked");
            let checked = document.querySelectorAll(".row-rad .checked"),
                btnText = document.querySelector(".row-rad .btn-text");
                if(checked && checked.length > 0){
                    btnText.innerText = `${checked.length} Selected`;
                }else{
                    btnText.innerText = "Select Language";
                }
        });
    })
}, 300);
const surgical_intervention = document.getElementById('surgical_intervention');
const surgical_price_div = document.getElementById('surgical_price');
const final_price_div = document.getElementById('final_price');
const contracts = document.querySelector('input[name="patient_contracts"]');
const option = document.querySelector('.row-option .option');
const opt = document.querySelectorAll('.row-option .opt')
const selectBtn = document.getElementById('select')
const sub = document.getElementById('end-session');
var surgical_price = 0;
var final_price = 0;

surgical_intervention.addEventListener('click', () => {
    option.classList.toggle('active')
})
opt.forEach(opt => {
    opt.addEventListener('click', () => {
        opt.classList.toggle('checked')
    })
})
selectBtn.addEventListener('click', (e) => {
    option.classList.remove('active')
    e.preventDefault();
    surgical_price = 0
    opt.forEach(opt => {
        if(opt.classList.contains('checked')) {
            const optSelected = opt;
            const optSelectedSpec = opt.querySelector('.opt-text');
            const optSelectedTxt = optSelectedSpec.innerHTML;
            const optSelectedPrice = optSelectedSpec.getAttribute('data-price');
            const len = document.querySelectorAll('.row-option .checked').length;
            const optTxt = document.querySelectorAll('.row-option .opt-text')
            surgical_price = surgical_price + Number(optSelectedPrice);
            if(contracts.value == 'opt_1') {
                final_price = 150;
            }else if(contracts.value == 'opt_2') {
                final_price = 250;
            }else if(contracts.value == 'opt_3') {
                final_price = 350;
            }else if(contracts.value == 'opt_4') {
                final_price = 450;
            }else {
                final_price = 0;
            }
            surgical_price_div.value = surgical_price;
            final_price_div.value = surgical_price - final_price;
            let reg = /\-\d+/;
            if(reg.test(final_price_div.value)) {
                final_price = surgical_price;
                final_price_div.value = surgical_price - final_price;
            }

        }
    })
})
window.addEventListener('load', () => {
    document.cookie = `url_med=;`
    document.cookie = `url_rad=;`
    document.cookie = `url_lab=;`
    console.log(document.cookie);
})
</script>
<?php
?>