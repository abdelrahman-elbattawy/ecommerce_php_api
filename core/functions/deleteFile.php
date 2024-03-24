<?php
function deleteFile($fileName)
{
  $filePath = "../upload/" . $fileName;

  if (file_exists($filePath)) {
    unlink($filePath);
  }
}
