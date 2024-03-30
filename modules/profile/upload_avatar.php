<?php

include "../../core/functions/imageUpload.php";
include "../../core/functions/printResult.php";

$imageRequest = $_FILES['file'];

if (!empty($imageRequest)) {
  $imageName = imageUpload($imageRequest, "users");

  if (!empty($imageName)) {
    printResults(ResultType::Success, $imageName);
  } else {
    printResults(ResultType::Failure, "Cannot upload image");
  }
}
