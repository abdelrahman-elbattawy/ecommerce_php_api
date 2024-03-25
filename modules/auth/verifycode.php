<?php

include "../../core/DB/connect.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/printResult.php";
include "../../core/functions/updateData.php";
include "../../core/functions/getData.php";

$email         = filterRequest("email");
$verifycode    = filterRequest("verifycode");


if (!empty($email) && !empty($verifycode)) {

  $data = getData(
    "users",
    "users_email = ? AND users_verifycode = ?",
    array($email, $verifycode),
    false
  );

  if ($data != null) {
    $values = array("users_approve" => "1");
    updateData("users", $values, "users_email = '$email'");
  } else {
    printResults(ResultType::Failure, "Incorrect verifycode!");
  }
}
