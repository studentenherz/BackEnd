<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: X-PINGOTHER, Content-Type");

$data = json_decode(file_get_contents('php://input'));

if(isset($data->submit)){

  $name = $data->name;
  $username = $data->username;
  $password = $data->password;

  if(empty($name) || empty($username) || empty($password)){
    $response = array('status' => 'error' , 'error' => 'empty' );
    echo json_encode($response);
    // header("Location: ../../FrontEnd/registration/signup.html?status=error&error=empty");
  }else{
    require 'db.php';

    $stmt = $conn->prepare("INSERT INTO users (uname, uuname, upass) VALUES(?,?,?)");

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    $stmt->bind_param("sss", $name, $username, $hashedPwd);

    $stmt->execute();
    $stmt->close();
    $conn->close();

    $response = array('status' => 'success');
    echo json_encode($response);
    // header("Location: ../../FrontEnd/registration/signup.html?status=success");
  }
}
else {
  header("Location: ".$frontEndUrl. "index.html");
}
