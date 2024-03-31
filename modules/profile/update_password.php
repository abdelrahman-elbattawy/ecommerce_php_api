<?php

include "../../core/DB/connect.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/printResult.php";
include "../../core/functions/updateData.php";
include "../../core/functions/getData.php";


$email          = filterRequest("email");
$oldPassword    = filterRequest("oldPassword");
$newPassword    = filterRequest("newPassword");

if (!empty($email) && !empty($oldPassword) && !empty($newPassword)) {

  $data = getData("users", "users_email = ?", array($email), false);

  if ($data != null) {

    $hasedOldPassword = $data['users_password'];

    if (password_verify($oldPassword, $hasedOldPassword)) {
      $hasedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

      $values = array("users_password" => "$hasedNewPassword");
      updateData("users", $values, "users_email = '$email'");
    } else {
      printResults(ResultType::Failure, "Old password dosn't match");
    }
  } else {
    printResults(ResultType::Failure, "Email not found!");
  }
}
