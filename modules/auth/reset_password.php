<?php

include "../../core/DB/connect.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/printResult.php";
include "../../core/functions/updateData.php";
include "../../core/functions/getData.php";


$email       = filterRequest("email");
$password    = filterRequest("password");

if (!empty($email) && !empty($password)) {

  $data = getData("users", "users_email = ?", array($email), false);

  if ($data != null) {

    $hasedPassword = password_hash($password, PASSWORD_DEFAULT);
    $values = array("users_password" => "$hasedPassword");

    updateData("users", $values, "users_email = '$email'");
  } else {
    printResults(ResultType::Failure, "Email not found!");
  }
}
