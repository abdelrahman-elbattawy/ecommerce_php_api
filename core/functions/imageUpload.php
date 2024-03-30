<?php

define('MB', 1048576);

function imageUpload($imageRequest, $imageFolder)
{
  global $msgError;

  $imageName       = rand(1000, 10000) . $imageRequest['name'];
  $imageTmp        = $imageRequest['tmp_name'];
  $imageSize       = $imageRequest['size'];
  $imageType       = $imageRequest['type'];

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
    move_uploaded_file($imageTmp, "../../uploads/$imageFolder/" . $imageName);
    return $imageName;
  } else {
    return "fail";
  }
}
