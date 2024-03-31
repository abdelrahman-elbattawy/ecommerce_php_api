<?php
function deleteFile($fileName, $imageFolder)
{
  $filePath = "../../uploads/$imageFolder/" . $fileName;

  if (file_exists($filePath)) {
    unlink($filePath);
  }
}
