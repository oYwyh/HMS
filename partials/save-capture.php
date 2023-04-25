<?php include_once '../config/constans.php'?>;

<?php

function saveCapLab() {
    // Get the incoming image data
    $image = $_POST["image"];

    // Remove image/jpeg from left side of image data
    // and get the remaining part
    $image = explode(";", $image)[1];

    // Remove base64 from left side of image data
    // and get the remaining part
    $image = explode(",", $image)[1];

    // Replace all spaces with plus sign (helpful for larger images)
    $image = str_replace(" ", "+", $image);

    // Convert back from base64
    $image = base64_decode($image);
    

    // Save the image as filename.jpeg
    file_put_contents("../doctor/assets/prescriptions/prescriptions-lab/prescriptions-lab-".date('Ymds').".jpeg", $image);

    // Sending response back to client
    echo $session_url = "../doctor/assets/prescriptions/prescriptions-lab/prescriptions-lab-".date('Ymds').".jpeg";
    $_SESSION['prescription_url_lab'] = $session_url;
}
function saveCapMed() {
    // Get the incoming image data
    $image_med = $_POST["image"];

    // Remove image_med/jpeg from left side of image_med data
    // and get the remaining part
    $image_med = explode(";", $image_med)[1];

    // Remove base64 from left side of image_med data
    // and get the remaining part
    $image_med = explode(",", $image_med)[1];

    // Replace all spaces with plus sign (helpful for larger image_meds)
    $image_med = str_replace(" ", "+", $image_med);

    // Convert back from base64
    $image_med = base64_decode($image_med);

    // Save the image_med as filename.jpeg
    file_put_contents("../doctor/assets/prescriptions/prescriptions-med/prescriptions-med-".date('Ymds').".jpeg", $image_med);

    // Sending response back to client
    echo $session_url = "../doctor/assets/prescriptions/prescriptions-med/prescriptions-med-".date('Ymds').".jpeg";
    $_SESSION['prescription_url_med'] = $session_url;

}
function saveCapRad() {
    // Get the incoming image_med data
    $image_rad = $_POST["image"];

    // Remove image/jpeg from left side of image data
    // and get the remaining part
    $image_rad = explode(";", $image_rad)[1];

    // Remove base64 from left side of image_rad data
    // and get the remaining part
    $image_rad = explode(",", $image_rad)[1];

    // Replace all spaces with plus sign (helpful for larger image_rads)
    $image_rad = str_replace(" ", "+", $image_rad);

    // Convert back from base64
    $image_rad = base64_decode($image_rad);

    // Save the image as filename.jpeg
    file_put_contents("../doctor/assets/prescriptions/prescriptions-rad/prescriptions-rad-".date('Ymds').".jpeg", $image_rad);

    // Sending response back to client
    echo $session_url = "../doctor/assets/prescriptions/prescriptions-rad/prescriptions-rad-".date('Ymds').".jpeg";
    $_SESSION['prescription_url_rad'] = $session_url;}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if($id == 'lab') {
        saveCapLab();
    }else if($id == 'med') {
        saveCapMed();
    }else if($id == 'rad'){
        saveCapRad();
    }
}

?>