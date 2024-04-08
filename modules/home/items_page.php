<?php

include "../../core/DB/connect.php";
include "../../core/functions/printResult.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/getData.php";
include "../../core/functions/execProc.php";

$categoryID = filterRequest("categoryID");

if (!empty($categoryID)) {

  $checkCategory = getData("categories", "categories_id = ?", array($categoryID), false);

  if ($checkCategory != null || $categoryID == "All") {

    if ($categoryID == "All") {
      $data = execProc("getAllItems", null, null, false);
    } else {
      $data = execProc("getItemsByCategory", "?", array($categoryID), false);
    }

    if ($data != null) {
      printResults(ResultType::Success, $data);
    } else {
      printResults(ResultType::Failure, "No data!");
    }
  } else {
    printResults(ResultType::Failure, "Category ID not found!");
  }
}
