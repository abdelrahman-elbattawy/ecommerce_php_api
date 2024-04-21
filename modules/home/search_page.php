<?php

include "../../core/DB/connect.php";
include "../../core/functions/printResult.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/execProc.php";

$searchWord = filterRequest("searchWord");

if (!empty($searchWord)) {

  $data = execProc("getItemsBySearch", "?", array($searchWord), false);

  if ($data != null) {
    printResults(ResultType::Success, $data);
  } else {
    printResults(ResultType::Failure, "No data!");
  }
}
