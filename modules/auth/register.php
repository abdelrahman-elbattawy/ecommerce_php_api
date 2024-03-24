<?php

include "../../core/DB/connect.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/printResult.php";
include "../../core/functions/insertData.php";


$username    = filterRequest("username");
$email       = filterRequest("email");
$password    = filterRequest("password");
$phone       = filterRequest("phone");

$verifycode  =  rand(10000, 99999);


if (
  !empty($email) &&
  !empty($password) &&
  !empty($username) &&
  !empty($phone)
) {

  $hasedPassword = password_hash($password, PASSWORD_DEFAULT);

  $stmt = $con->prepare("SELECT * FROM users WHERE users_email = ? OR users_phone = ?");

  $stmt->execute(array($email, $password));

  $count = $stmt->rowCount();

  if ($count > 0) {
    printResults(ResultType::Failure, "Email or Phone is exist");
  } else {
    $data = array(
      "users_email" => $email,
      "users_name" => $username,
      "users_phone" => $phone,
      "users_password" => $hasedPassword,
      "users_verifycode" => $verifycode,
    );

    insertData("users", $data);
  }
}
