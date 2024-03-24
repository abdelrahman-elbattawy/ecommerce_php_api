<?php

define('MB', 1048576);

function imageUpload($imageRequest)
{
  global $msgError;

  $imageName       = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
  $imageTmp        = $_FILES[$imageRequest]['tmp_name'];
  $imageSize       = $_FILES[$imageRequest]['size'];
  $imageType       = $_FILES[$imageRequest]['type'];

  $strToArray      = explode(".", $imageName);

  $allowExt        = array("png", "jpg", "gif", "jpeg");
  $allowMimeType   = array("image/png", "image/jpg", "image/gif", "image/jpeg");

  $ext             = end($strToArray);
  $ext             = strtolower($ext);


  if (!empty($imageName)) {

    if (!in_array($ext, $allowExt)) {
      $msgError[] = "Ext";
    }

    if (!in_array($imageType, $allowMimeType)) {
      $msgError[] = "Mime Type";
    }

    if ($imageSize > 2 * MB) {
      $msgError[] = "Size";
    }
  }

  if (empty($msgError)) {
    move_uploaded_file($imageTmp, "../upload/" . $imageName);
    return $imageName;
  } else {
    return "fail";
  }
}
