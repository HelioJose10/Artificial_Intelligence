<?php

    //error_reporting(E_ERROR);
    session_start();
    $hostname = "databaseA";
    $username = "user";
    $password = "password"; 
    $database = "filesA";
    $mimetype = $_COOKIE['filetype'];

    $conn = new mysqli($hostname, $username, $password, $database);
    
    if (!$conn || $conn->connect_error){
        die("connection failed: " . $conn->connect_error);
    }else{
        //echo "connected <br/><br/>";
    }

    $id = $_POST['file_id'];
    //$blob = $_GET['blob'];
    //get BLOB
    $queryBLOB = "SELECT file_title, file_content FROM updatesA INNER JOIN hashsA ON file_hash_fk=hash_id INNER JOIN filesContentA ON file_fk=filesContentA.file_id WHERE filesContentA.file_id='$id';";
    $result = $conn->query($queryBLOB);
    $row = $result->fetch_assoc();
    $blob = $row['file_content'];
    $filename = $row['file_title'];

    header('Content-Type: ' . $mimetype);
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    echo $blob;

    mysqli_close($conn);
?>