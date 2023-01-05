<?php

//error_reporting(E_ERROR);
$hostname = "databaseA";
$username = "user";
$password = "password"; 
$database = "filesA";

$conn = new mysqli($hostname, $username, $password, $database);

//GET ALL DATA ON FILES SAVED:
$queryList = "SELECT file_title, submission_date, hash_1, hash_2, file_content FROM updatesA INNER JOIN hashsA ON file_hash_fk=hash_id INNER JOIN filesContentA ON file_fk=filesContentA.file_id;";
$result = $conn->query($queryList);

while ($row = $result->fetch_assoc()){
    $table = '<tr>';
    $table .= '<td>' . htmlspecialchars($row['file_title']) . '</td>';
    $table .= '<td>' . htmlspecialchars($row['submission_date']) . '</td>';
    $hash = $row['hash_1'] . $row['hash_2']; //concatenate the hash back
    $table .= '<td>' . htmlspecialchars($hash) . '</td>';
    $table .= '<td>' . htmlspecialchars($row['file_content']) . '</td>';
    $table .= '</tr>';
    echo $table;
}


?>