<?php

include "../../core/DB/connect.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/printResult.php";
include "../../core/functions/insertData.php";
include "../../core/functions/getData.php";


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

  $data = getData(
    "users",
    "users_email = ? OR users_phone = ?",
    array($email, $phone),
    false
  );


  if ($data == null) {
    $hasedPassword = password_hash($password, PASSWORD_DEFAULT);

    $values = array(
      "users_email" => $email,
      "users_name" => $username,
      "users_phone" => $phone,
      "users_password" => $hasedPassword,
      "users_verifycode" => $verifycode,
    );

    insertData("users", $values);
  } else {
    printResults(ResultType::Failure, "Email or Phone is exist");
  }
}
