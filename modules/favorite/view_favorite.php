<?php

include "../../core/DB/connect.php";
include "../../core/functions/printResult.php";
include "../../core/functions/filterRequest.php";

$userID = filterRequest("userID");

if (!empty($userID)) {
  $stmt = $con->prepare("CALL favoriteItemsBy (?)");
  $values = array($userID);
  $stmt->execute($values);

  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $count  = $stmt->rowCount();

  if ($count > 0) {
    printResults(ResultType::Success, $data);
  } else {
    printResults(ResultType::Failure, "No data!");
  }
}
