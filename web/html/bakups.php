<?php

    //error_reporting(E_ERROR);
    session_start();
    $hostname = "databaseA";
    $username = "user";
    $password = "password"; 
    $maindb = "filesA";
    $backupdb = "backupA";

    //copy all data
    exec("mysqldump -h databaseA -u user -p password filesA > dump.sql");
    //overwrite all data
    exec("mysql -h databaseA -u user -p password backupA < dump.sql");












    /*
    $conn1 = new mysqli($hostname, $username, $password, $maindb); //to pull data
    $conn2 = new mysqli($hostname, $username, $password, $backupdb); //to insert data
    
    if (!$conn || $conn->connect_error){
        die("connection failed: " . $conn->connect_error);
    }else{
        //echo "connected <br/><br/>";
    }

    //copy data between databases
    $queryfilesContentA = "SELECT * FROM filesContentA;";
    $result = $conn1->query($queryfilesContentA);
    $row = $result->fetch_assoc();
    $querybcfilesContentA = "INSERT INTO bcfilesContentA(files_content) VALUES('$blob');";
    while ($row =  $result->fetch_assoc()) {
        $id = $row['file_id'];
        $blob = $row['file_content'];
        $result = $conn2->query($querybcfilesContentA);
        if (!$result) {
            echo "Error: " . mysqli_error($conn2);
        }
    }
    
    $queryhashsA = "SELECT * FROM hashsA;";
    $result = $conn1->query($queryhashsA);


    $queryupdatesA = "SELECT * FROM updatesA;";

    mysqli_close($conn);
    */

?>