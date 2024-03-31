<?php

include "../../core/DB/connect.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/printResult.php";
include "../../core/functions/getData.php";
include "../../core/functions/deleteFile.php";
include "../../core/functions/updateData.php";


$username     = filterRequest("username");
$email        = filterRequest("email");
$phone        = filterRequest("phone");
$imageName    = filterRequest("imageName");
$imageFoldar  = filterRequest("folder");

if (!empty($username) && !empty($email) && !empty($phone) && !empty($imageName)) {

  $data = getData("users", "users_email = ?", array($email), false);

  if ($data != null) {

    $oldImage = $data['users_image'];

    if ($oldImage != $imageName) {
      deleteFile($oldImage, $imageFoldar);
    }

    $values = array(
      "users_name" => $username,
      "users_phone" => $phone,
      "users_image" => $imageName,
    );

    updateData("users", $values, "users_email = '$email'", false);

    $data['users_image'] = $imageName;
    $data['users_name'] = $username;
    $data['users_phone'] = $phone;

    printResults(ResultType::Success, $data);
  } else {
    printResults(ResultType::Failure, "Email not exist!");
  }
}
