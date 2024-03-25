<?php

include "../../core/DB/connect.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/printResult.php";
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
    printResults(ResultType::Success);
  } else {
    printResults(ResultType::Failure, "Incorrect verifycode!");
  }
}
