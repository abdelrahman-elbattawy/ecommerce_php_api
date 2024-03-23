<?php

include "../connect.php";


$email       = filterRequest("email");
$password    = filterRequest("password");

if (!empty($email) && !empty($password)) {

  $stmt = $con->prepare("SELECT * FROM users WHERE users_email = ?");
  $stmt->execute(array($email));

  $data = $stmt->fetch(PDO::FETCH_ASSOC);

  $count = $stmt->rowCount();

  if ($count > 0) {
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
