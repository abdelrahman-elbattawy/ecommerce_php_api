<?php
function filterRequest($requestName)
{
  // PREVENT SQL INJECTION
  if (isset($_POST[$requestName]) && !empty($_POST[$requestName])) {

    // PREVENT XSS
    return htmlspecialchars(strip_tags($_POST[$requestName]));
  }

  return null;
}
