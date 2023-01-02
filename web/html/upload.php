<?php
    error_reporting(E_ERROR);
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

$file = $_FILES['myFile'];    
$file_name =  $file['name']; //getting file name
$tmp_name = $file['tmp_name']; //getting temp_name of file
$file_up_name = time().$file_name; //making file name dynamic by adding time before file name
$sDate = date("Y-m-d H:i:s");
move_uploaded_file($tmp_name, "/var/www/html/" . $file_name);

  //file - filesContentA
  $queryFile = "INSERT INTO filesContentA(file_content) VALUES('$file_up_name')";
  $result1 = $conn->query($queryFile);
  if($result1){
    echo "success in query 1";
  } else {
    echo "Error running query 1: " . $conn->error;
  }
  //get file_id from file uploaded
  $queryFileId = "SELECT file_id FROM filesContentA WHERE file_content='$file_up_name'";
  $result2 = $conn->query($queryFileId);
  if ($result2) {
    echo "success in query 2";
    $rowFile = $result2->fetch_assoc();
    $rowFile = $rowFile['file_id'];

  } else {
    echo "Error running query 2: " . $conn->error;
  }
  
  //file hash - hashsA
  $value256 = hash_file('sha256', "/var/www/html/".$file_name);
  echo $value256;
  $hashArray = str_split($value256, 56);
  $hash1 = $hashArray[0]; 
  $hash2 = $hashArray[1];
  $queryHash = "INSERT INTO hashsA(hash_1, hash_2, file_fk) VALUES('$hash1', '$hash2', '$rowFile')";
  $result3 = $conn->query($queryHash);
  if ($result3) {
    echo "success in query 3";
  } else {
    echo "Error running query 3: " . $conn->error;
  }
  $queryHashId = "SELECT hash_id FROM hashsA WHERE hash_1 ='$hash1'";
  $result4 = $conn->query($queryHashId);
  if ($result4) {
    echo "success in query 4";
    $rowHash = $result4->fetch_assoc();
    $rowHash = $rowFile['hash_id'];

  } else {
    echo "Error running query 4: " . $conn->error;
  }
  //update information - updatesA
  $queryInfo = "INSERT INTO updatesA(file_title, submission_date, file_hash_fk) VALUES('$file_up_name', '$sDate', '$rowHash')";
  $result5 = $conn->query($queryInfo);
  if ($result5) {
    echo "success in query 5";
  } else {
    echo "Error running query 5: " . $conn->error;
  }

//close connection after upload finish
mysqli_close($conn);
?>
