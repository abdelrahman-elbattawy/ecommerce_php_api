<?php

include "../../core/DB/connect.php";
include "../../core/functions/printResult.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/getData.php";

$userID = filterRequest("userID");
$categoryID = filterRequest("categoryID");

if (!empty($categoryID) && !empty($userID)) {

  $data = getData("categories", "categories_id = ?", array($categoryID), false);

  if ($data != null || $categoryID == "All") {

    if ($categoryID == "All") {
      $stmt = $con->prepare("CALL allItems (?)");

      $values = array($userID);
    } else {
      $stmt = $con->prepare("CALL itemsByCategory (?, ?)");

      $values = array($userID, $categoryID);
    }

    $stmt->execute($values);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count  = $stmt->rowCount();

    if ($count > 0) {
      printResults(ResultType::Success, $data);
    } else {
      printResults(ResultType::Failure, "No data!");
    }
  } else {
    printResults(ResultType::Failure, "Category ID not found!");
  }
}
