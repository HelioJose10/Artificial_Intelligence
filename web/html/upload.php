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
   
  $file_name =  $_FILES['file']['name']; //getting file name
  $tmp_name = $_FILES['file']['tmp_name']; //getting temp_name of file
  $file_up_name = time().$file_name; //making file name dynamic by adding time before file name
  $sDate = date("Y-m-d H:i:s");
  
  $error = $_FILES['file']['error'];
  echo "error = " . $error."<br/><br/>";
  echo "temp_name= ".$tmp_name."<br/><br/>";

  //file - filesContentA
  $queryFile = "INSERT INTO filesContentA(file_content) VALUES('$tmp_name');";
  $result1 = $conn->query($queryFile);
  if($result1){
    echo "success in query 1";
  } else {
    echo "Error running query 1:" . $conn->error;
  }
  //get file_id from file uploaded
  $queryFileId = "SELECT file_id FROM filesContentA WHERE file_content='$tmp_name'";
  $result2 = $conn->query($queryFileId);
  if ($result2) {
    echo "<br/><br/>success in query 2<br/><br/>";
    $rowFile = $result2->fetch_assoc();
    $id = $rowFile['file_id'];

  } else {
    echo "Error running query 2: " . $conn->error;
  }
  
  //file hash - hashsA
  if (is_uploaded_file($tmp_name)) {
    $value256 = hash_file('sha256', $tmp_name);
    echo "<br/><br/>";
    echo $value256;
  echo "<br/><br/>";
  }else{
  echo "is_uploaded_file not working<br/><br/>";
  }
   echo "attempt hash after is_uploaded<br/><br/>";
  $value256 = hash_file('sha256', $_FILES['file']['tmp_name']);
 
  echo $value256;
  $hashArray = str_split($value256, 56);
  $hash1 = $hashArray[0]; 
  $hash2 = $hashArray[1];
  echo "hash_1: ".$hash1."<br/>";
  echo "hash_2: ".$hash2."<br/>";
  $queryHash = "INSERT INTO hashsA(hash_1, hash_2, file_fk) VALUES('$hash1', '$hash2', '$id')";
  $result3 = $conn->query($queryHash);
  if ($result3) {
    echo "success in query 3<br/><br/>";
  } else {
    echo "Error running query 3: <br/><br/>" . $conn->error;
  }
  $queryHashId = "SELECT hash_id FROM hashsA WHERE hash_1 ='$hash1'";
  $result4 = $conn->query($queryHashId);
  if ($result4) {
    echo "success in query 4<br/><br/>";
    $rowHash = $result4->fetch_assoc();
    $hash_id_return = $rowHash['hash_id'];

  } else {
    echo "Error running query 4: <br/><br/> " . $conn->error;
  }
  //update information - updatesA
  $queryInfo = "INSERT INTO updatesA(file_title, submission_date, file_hash_fk) VALUES('$file_up_name', '$sDate', '$hash_id_return')";
  $result5 = $conn->query($queryInfo);
  if ($result5) {
    echo "success in query 5<br/><br/>";
  } else {
    echo "Error running query 5: <br/><br/>" . $conn->error;
  }

//close connection after upload finish
mysqli_close($conn);
?>
