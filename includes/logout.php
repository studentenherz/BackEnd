<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: X-PINGOTHER, Content-Type");

$data = json_decode(file_get_contents('php://input'));

if(isset($data->logout)){
  require "db.php";

  $token = $data->token;

  $sql = "SELECT token, privkey FROM sessions";
  $result = $conn->query($sql);

  while($row = $result->fetch_assoc()){
    if($row["token"] == hash_hmac('sha256', $token, $row["privkey"])){
      $stmt = $conn->prepare("DELETE FROM sessions WHERE token=?");
      $stmt->bind_param("s", $row["token"]);
      $stmt->execute();
      exit("done");
    }
  }
}
// else{
//   header("Location: ".$frontEndUrl. "index.html");
// }
