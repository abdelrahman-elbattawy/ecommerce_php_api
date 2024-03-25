<?php

include "../../core/DB/connect.php";
include "../../core/functions/printResult.php";
include "../../core/functions/getAllData.php";

$categories = getAllData("categories", null, null, false);

$allData = array("categories" => $categories);

if ($allData != null) {
  printResults(ResultType::Success, $allData);
} else {
  printResults(ResultType::Failure, "No data!");
}
