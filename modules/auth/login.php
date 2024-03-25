<?php

include "../../core/DB/connect.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/printResult.php";
include "../../core/functions/getData.php";

$email       = filterRequest("email");
$password    = filterRequest("password");

if (!empty($email) && !empty($password)) {

  $data = getData("users", "users_email = ?", array($email), false);

  if ($data != null) {
    $hasedPassword = $data['users_password'];

    if (password_verify($password, $hasedPassword)) {
      $emailApproved = $data['users_approve'];

      if ($emailApproved == 1) {
        printResults(ResultType::Success, $data);
      } else {
        printResults(ResultType::Failure, "Email not verifed");
      }
    } else {
      printResults(ResultType::Failure, "Email or Password incorrect");
    }
  } else {
    printResults(ResultType::Failure, "Email or Password incorrect");
  }
}
