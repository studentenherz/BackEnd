<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: X-PINGOTHER, Content-Type");

require 'db.php';

if(isset($_POST['validate'])){
  $username  = $_POST['username'];
  $token  = $_POST['token'];

  $sql = "SELECT token, privkey FROM sessions";
  $result = $conn->query($sql);

  while($row = $result->fetch_assoc()){
    if($row["token"] == hash_hmac('sha256', $token, $row["privkey"])){

      $stmt = $conn->prepare("SELECT * FROM users WHERE uuname=?");
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows){
        while ($row = $result->fetch_assoc()) {
          $response = array('valid'=>true, 'name' => $row['uname'], 'avatar' => 'avatar/'.$row['avatar']);

          exit(json_encode($response));
        }
      }
      exit();
    }
  }

}
// else{
//   header("Location: ".$frontEndUrl. "index.html");
// }
