<?php
    //error_reporting(E_ERROR);
    session_start();
    $hostname = "databaseA";
    $username = "user";
    $password = "password"; 
    $database = "filesA";

    $conn = new mysqli($hostname, $username, $password, $database);
    
    if (!$conn || $conn->connect_error){
        die("connection failed: " . $conn->connect_error);
    }else{
        //echo "connected <br/><br/>";
    }
   
  $file_name =  $_FILES['file']['name']; //getting file name
  $tmp_name = $_FILES['file']['tmp_name']; //getting temp_name of file
  $file_up_name = time().$file_name; //making file name dynamic by adding time before file name
  $sDate = date("Y-m-d H:i:s");
  $mimetype = $_FILES['file']['type'];
  $size = $_FILES['file']['size'];
  setcookie('filetype', $mimetype, time() + 86400, '/');
  $error = $_FILES['file']['error'];
  $blob = file_get_contents($tmp_name);
  //$blob = mysqli_real_escape_string($conn, $blob);
  //file - filesContentA
  $queryFile = "INSERT INTO filesContentA(file_content) VALUES('$blob');";
  $result1 = $conn->query($queryFile);

  if (!$result1) {
    echo "Error: " . mysqli_error($conn);
}

 
  //get file_id from file uploaded
  $queryFileId = "SELECT file_id FROM filesContentA WHERE file_content='$blob'";
  $result2 = $conn->query($queryFileId);
  $rowFile = $result2->fetch_assoc();
  $id = $rowFile['file_id'];
  setcookie('fileID', $id, time() + 86400, '/');
  $value256 = hash_file('sha256', $tmp_name);
  //$sendBlob = http_build_query(array('id' => $id,'blob' => $blob));
  //$url = 'download.php?' . $sendBlob;
  
  //echo $value256;
  $hashArray = str_split($value256, 56);
  $hash1 = $hashArray[0]; 
  $hash2 = $hashArray[1];

  $queryHash = "INSERT INTO hashsA(hash_1, hash_2, file_fk) VALUES('$hash1', '$hash2', '$id')";
  $result3 = $conn->query($queryHash);

  $queryHashId = "SELECT hash_id FROM hashsA WHERE hash_1 ='$hash1'";
  $result4 = $conn->query($queryHashId);

  $rowHash = $result4->fetch_assoc();
  $hash_id_return = $rowHash['hash_id'];
  //update information - updatesA
  $queryInfo = "INSERT INTO updatesA(file_title, submission_date, file_hash_fk) VALUES('$file_name', '$sDate', '$hash_id_return')";
  $result5 = $conn->query($queryInfo);

  //update datatable
  $queryList = "SELECT file_title, submission_date, hash_1, hash_2, file_content FROM updatesA INNER JOIN hashsA ON file_hash_fk=hash_id INNER JOIN filesContentA ON file_fk=filesContentA.file_id WHERE hash_id='$hash_id_return';";
  $result = $conn->query($queryList);
  $row = $result->fetch_assoc();
  $hash = $row['hash_1'] . $row['hash_2']; //concatenate the hash back
  $data = ['<tr>','<td>' . htmlspecialchars($row['file_title']) . '</td>','<td>' . htmlspecialchars($row['submission_date']) . '</td>','<td>' . htmlspecialchars($hash) . '</td>','<td><form action="download.php" method="POST" id="download-form"><input type="hidden" name="file_id" value="'. $id .'"><input type="submit" value="DOWNLOAD"></form></td>','</tr>'];
  
  echo implode(' ', $data);

  //close connection after upload finish
  mysqli_close($conn);
?>
