<?php

//error_reporting(E_ERROR);
$hostname = "databaseA";
$username = "user";
$password = "password"; 
$database = "filesA";
session_start();
$id = $_COOKIE['fileID'];
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
    $table .= '<td><form action="download.php" method="POST" id="download-form"><input type="hidden" name="file_id" value="' . $id . '"><input type="submit" value="DOWNLOAD"></form></td>';
    $table .= '</tr>';
    echo $table;
}


?>