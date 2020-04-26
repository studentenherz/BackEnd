<?php

if(isset($_POST['submit-signup'])){

  $name = $_POST['name'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  if(empty($name) || empty($username) || empty($password)){
    header("Location: ../../FrontEnd/registration/signup.html?status=error&error=empty");
  }else{
    require 'db.php';

    $stmt = $conn->prepare("INSERT INTO users (uname, uuname, upass) VALUES(?,?,?)");

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    $stmt->bind_param("sss", $name, $username, $hashedPwd);

    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: ../../FrontEnd/registration/signup.html?status=success");
  }
}
else {
  header("Location: ../../FrontEnd/registration/signup.html?status=error&error=empty");
}
