<?php

include "../../core/DB/connect.php";
include "../../core/functions/printResult.php";
include "../../core/functions/getAllData.php";
include "../../core/functions/filterRequest.php";

$userID = filterRequest("userID");


if (!empty($userID)) {
  $categories = getAllData("categories", null, null, false);

  $stmt = $con->prepare("CALL allItems (?)");
  $values = array($userID);

  $stmt->execute($values);
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $count  = $stmt->rowCount();

  if ($count > 0) {
    $items = $data;
  } else {
    $items = "No Data!";
  }

  $allData = array(
    "categories" => $categories,
    "items" => $items
  );

  if ($allData != null) {
    printResults(ResultType::Success, $allData);
  } else {
    printResults(ResultType::Failure, "No data!");
  }
}
