<?php

include "../../core/DB/connect.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/printResult.php";
include "../../core/functions/updateData.php";


$email       = filterRequest("email");
$password    = filterRequest("password");

if (!empty($email) && !empty($password)) {

  $stmt = $con->prepare("SELECT * FROM users WHERE users_email = ?");
  $stmt->execute(array($email));

  $count = $stmt->rowCount();

  if ($count > 0) {

    $hasedPassword = password_hash($password, PASSWORD_DEFAULT);
    $data = array("users_password" => "$hasedPassword");

    updateData("users", $data, "users_email = '$email'");
  } else {
    printResults(ResultType::Failure, "Email not found!");
  }
}
