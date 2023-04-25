<?php

if($patient_complaint == '' || $on_examination == ''|| $diagnosis == '') {
    $_SESSION['empty'] = '<h1 class="failed">One Of The Input Is Invalid</h1>';
    header('Location:patient-info-seen.php?id='.$_GET['id'].'');
    die();
}else {
    $sql2 = "UPDATE tbl_session SET
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
    surgical_intervention='$surgical_intervention',
    surgical_price='$surgical_price',
    final_price='$final_price',
    lab_request='$lab_selected',
    medicine_request='$med_selected',
    radiology_request='$rad_selected',
    prescription_lab='$url_lab',
    prescription_med='$url_med',
    prescription_rad='$url_rad'
    WHERE id=$id
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