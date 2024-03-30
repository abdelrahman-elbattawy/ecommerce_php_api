<?php

include "../../core/DB/connect.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/printResult.php";
include "../../core/functions/getData.php";
include "../../core/functions/deleteData.php";

$email = filterRequest("email");

if (!empty($email)) {

  $data = getData("users", "users_email = ?", array($email), false);

  if ($data != null) {
    deleteData("users", "users_email = '$email'");
  } else {
    printResults(ResultType::Failure, "Email not exist!");
  }
}
