<?php

function OpenCon()
{
    $servername = "localhost";
    $username = " ";
    $password = "password";
    $database = " ";
    $port = " ";

    $conn = new mysqli($servername, $username, $password, $database, $port);
    
    if ($conn->connect_error){
        die("connection failed: " . $conn->connect_error);
    }

    return $conn;
 
}

function CloseCon($conn)
{
    mysqli_close($conn);
}
?>