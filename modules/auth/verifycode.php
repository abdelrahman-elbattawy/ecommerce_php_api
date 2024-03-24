<?php

include "../../core/DB/connect.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/printResult.php";
include "../../core/functions/updateData.php";


$email         = filterRequest("email");
$verifycode    = filterRequest("verifycode");


if (!empty($email) && !empty($verifycode)) {

  $stmt = $con->prepare("SELECT * FROM users WHERE users_email = ? AND users_verifycode = ?");

  $stmt->execute(array($email, $verifycode));

  $count = $stmt->rowCount();

  if ($count > 0) {
    $data = array("users_approve" => "1");
    updateData("users", $data, "users_email = '$email'");
  } else {
    printResults(ResultType::Failure, "Incorrect verifycode!");
  }
}
