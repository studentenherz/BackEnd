<?php

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Allow-Headers: X-PINGOTHER, Content-Type");

echo "a ver";

// $data = json_decode(file_get_contents('php://input'));
//
//
// if(isset($data->submit)){
//
//   $username = $data->username;
//   $password = $data->password;
//
//   require 'db.php';
//
//   if(empty($username) || empty($password)){
//     $response = array('status' => 'error' , 'error' => 'empty' );
//     exit(json_encode($response));
//     // header("Location: ../../FrontEnd/index.html?status=error&error=empty");
//   }else{
//     $stmt = $conn->prepare("SELECT * FROM users WHERE uuname=?");
//     $stmt->bind_param("s", $username);
//     $stmt->execute();
//     $result = $stmt->get_result();
//
//     if($result->num_rows){
//       $row=$result->fetch_assoc();
//
//       if(password_verify($password, $row['upass'])){
//         // create a sesion token and info
//         $name = $row['uname'];
//         $token = bin2hex(random_bytes(16));
//         $privkey = bin2hex(random_bytes(16));
//         $hashedToken = hash_hmac('sha256', $token, $privkey);
//
//         $stmt = $conn->prepare("INSERT INTO sessions (token, privkey, username) VALUES (?,?,?)");
//         $stmt->bind_param("sss", $hashedToken, $privkey, $username);
//         $stmt->execute();
//
//         $response = array('status' => 'success' , 'name' => $name, 'username' => $username, 'token' => $token );
//         exit(json_encode($response));
//
//         // header("Location: ../../FrontEnd/index.html?status=success&name=$name&username=$username&token=$token");
//       }
//       else{
//         $response = array('status' => 'error' , 'error' => 'incorrect' );
//         exit(json_encode($response));
//
//         // header("Location: ../../FrontEnd/index.html?status=error&error=incorrect");
//       }
//
//     }
//     else{
//       $response = array('status' => 'error' , 'error' => 'incorrect' );
//       exit(json_encode($response));
//       // header("Location: ../../FrontEnd/index.html?status=error&error=incorrect");
//     }
//   }
//
// }
// else{
//   header("Location: ".$frontEndUrl. "index.html");
//   // echo "Hola";
// }
