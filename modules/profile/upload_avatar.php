<?php

include "../../core/functions/filterRequest.php";
include "../../core/functions/imageUpload.php";

$imageRequest = $_FILES['file'];

if (!empty($imageRequest)) {
  imageUpload($imageRequest, "users");
}
