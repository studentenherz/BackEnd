<?php

if(isset($_POST['login-submit'])){

  $username = $_POST['username'];
  $password = $_POST['password'];

  require 'db.php';

  if(empty($username) || empty($password)){
    header("Location: ../../FrontEnd/index.html?login=error&error=empty");
  }else{
    $stmt = $conn->prepare("SELECT * FROM users WHERE uuname=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows){
      $row=$result->fetch_assoc();

      if(password_verify($password, $row['upass'])){
        // create a sesion token and info
        $name = $row['uname'];
        $token = bin2hex(random_bytes(16));
        $privkey = bin2hex(random_bytes(16));
        $hashedToken = hash_hmac('sha256', $token, $privkey);

        $stmt = $conn->prepare("INSERT INTO sessions (token, privkey, username) VALUES (?,?,?)");
        $stmt->bind_param("sss", $hashedToken, $privkey, $username);
        $stmt->execute();

        header("Location: ../../FrontEnd/index.html?login=success&name=$name&username=$username&token=$token");
      }
      else{
        header("Location: ../../FrontEnd/index.html?login=error&error=incorrect");
      }

    }
    else{
      header("Location: ../../FrontEnd/index.html?login=error&error=incorrect");
    }
  }

}
else{
  header("Location: ../../FrontEnd/index.html");
}
