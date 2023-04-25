<?php

    session_start();
    ob_start();
    // Constant For NonReapeated Values
    define('SITEURL', 'http://localhost/hms/');
    define('LOCALHOST' , 'localhost');
    define('DB_USERNAME' , 'root');
    define('DB_PASSWORD' , '');
    define('DB_NAME' , 'hms');

    // Create connection
    // $conn = new mysqli($servername, $username, $password);
    $conn = mysqli_connect(LOCALHOST , DB_USERNAME , DB_PASSWORD);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $db_select = mysqli_select_db($conn, DB_NAME); // Selecting DB

?>