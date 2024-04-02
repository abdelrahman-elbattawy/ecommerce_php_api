<?php

include "../../core/DB/connect.php";
include "../../core/functions/printResult.php";
include "../../core/functions/getAllData.php";
include "../../core/functions/getAllDataByCount.php";

$categories = getAllData("categories", null, null, false);
$items = getAllDataByCount("items_view", null, null, 5, false);

$allData = array(
  "categories" => $categories,
  "items" => $items
);

if ($allData != null) {
  printResults(ResultType::Success, $allData);
} else {
  printResults(ResultType::Failure, "No data!");
}
