<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require "db.php";

if(isset($_POST['upload_image'])){
  $username  = $_POST['username'];
  $token  = $_POST['token'];

  $sql = "SELECT token, privkey FROM sessions";
  $result = $conn->query($sql);

  while($row = $result->fetch_assoc()){
    if($row["token"] == hash_hmac('sha256', $token, $row["privkey"])){
      $image = $_FILES['profileImage'];

      $fileName = $image['name'];
      $fileTmpName = $image['tmp_name'];
      $fileSize = $image['size'];
      $fileError = $image['error'];
      $fileType = $image['type'];

      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));

      $allowed = array('jpg', 'jpeg', 'png');

      if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
          if($fileSize < 100000){
            $newFileName = uniqid($username).".".$fileActualExt;
            $fileDestination = $filesFolder.$newFileName;
            move_uploaded_file($fileTmpName, $fileDestination);

            $sql = "UPDATE users SET avatar='$newFileName' WHERE uuname='$username'";
            $conn->query($sql);

            exit("success?");
          }
          else{
            echo "too big file";
          }
        }else{
          echo "there was an error uploading";
        }
      }
      else{
        echo "wrong file type";
      }
      exit("done");
    }
  }
}else{
  header("Location: ".$frontEndUrl. "index.html");
}
