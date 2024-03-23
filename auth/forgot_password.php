<?php

include "../connect.php";


$email = filterRequest("email");

if (!empty($email)) {

  $stmt = $con->prepare("SELECT * FROM users WHERE users_email = ?");
  $stmt->execute(array($email));

  $count = $stmt->rowCount();

  if ($count > 0) {
    $verifycode  =  rand(10000, 99999);
    $data = array("users_verifycode" => "$verifycode");
    updateData("users", $data, "users_email = '$email'");
  } else {
    printResults(ResultType::Failure, "Email not found!");
  }
}
