<?php

include "../../core/DB/connect.php";
include "../../core/functions/printResult.php";
include "../../core/functions/getAllData.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/execProc.php";

$userID = filterRequest("userID");


if (!empty($userID)) {
  $categories = getAllData("categories", null, null, false);

  $items = execProc("getAllItems", null, null, false);

  $favItems = execProc("getFavoriteItemsBy", "?", array($userID), false);

  $cartItems = execProc("getCartItems", "?", array($userID), false);

  $allData = array(
    "categories" => $categories,
    "items" => $items,
    "favoriteItems" => $favItems,
    "cartItems" => $cartItems,
  );

  if ($allData != null) {
    printResults(ResultType::Success, $allData);
  } else {
    printResults(ResultType::Failure, "No data!");
  }
}
