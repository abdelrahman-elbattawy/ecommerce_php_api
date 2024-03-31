<?php

include "../../core/DB/connect.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/printResult.php";
include "../../core/functions/getData.php";
include "../../core/functions/imageUpload.php";

$email        = filterRequest("email");
$imageFoldar  = filterRequest("foldar");
$imageRequest = $_FILES['profile_pic'];

if (!empty($imageRequest) && !empty($imageFoldar) && !empty($email)) {

  $data = getData("users", "users_email = ?", array($email), false);

  if ($data != null) {
    $imageName = imageUpload($imageRequest, $imageFoldar);

    if (!empty($imageName)) {
      printResults(ResultType::Success, $imageName);
    } else {
      printResults(ResultType::Failure, "Cannot upload image");
    }
  } else {
    printResults(ResultType::Failure, "Email not exist!");
  }
}
