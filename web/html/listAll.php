<?php

//error_reporting(E_ERROR);
$hostname = "databaseA";
$username = "user";
$password = "password"; 
$database = "filesA";

$conn = new mysqli($hostname, $username, $password, $database);

if (!$conn || $conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}else{
echo "connected <br/><br/>";
}


//GET ALL DATA ON FILES SAVED:
$query = "SELECT file_title, submission_date, hash_1, hash_2, file_content FROM updatesA INNER JOIN hashsA ON file_hash_fk=hash_id INNER JOIN filesContentA ON file_fk=filesContentA.file_id;";






?>