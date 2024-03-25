<?php

include "../../core/DB/connect.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/printResult.php";
include "../../core/functions/getData.php";
include "../../core/functions/updateData.php";


$email = filterRequest("email");

if (!empty($email)) {

  $data = getData("users", "users_email = ?", array($email), false);

  if ($data != null) {

    $verifycode  =  rand(10000, 99999);
    $values = array("users_verifycode" => "$verifycode");
    $where = "users_email = '$email'";

    updateData("users", $values, $where);
  } else {
    printResults(ResultType::Failure, "Email not found!");
  }
}
