<?php

include "../../core/DB/connect.php";
include "../../core/functions/printResult.php";
include "../../core/functions/getAllDataByCount.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/getData.php";

$categoryID = filterRequest("categoryID");

if (!empty($categoryID)) {

  $data = getData("categories", "categories_id = ?", array($categoryID), false);

  if ($data != null || $categoryID == "All") {

    if ($categoryID == "All") {

      $allData = getAllDataByCount(
        "items_view",
        null,
        null,
        5,
        false
      );
    } else {

      $allData = getAllDataByCount(
        "items_view",
        "categories_id = ?",
        array($categoryID),
        5,
        false
      );
    }

    if ($allData != null) {
      printResults(ResultType::Success, $allData);
    } else {
      printResults(ResultType::Failure, "No data!");
    }
  } else {
    printResults(ResultType::Failure, "Category ID not found!");
  }
}
