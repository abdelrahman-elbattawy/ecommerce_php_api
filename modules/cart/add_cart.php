<?php

include "../../core/DB/connect.php";
include "../../core/functions/printResult.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/insertData.php";

$userID = filterRequest("userID");
$itemID = filterRequest("itemID");

if (!empty($itemID) && !empty($userID)) {

  $values = array("cart_userId" => $userID, "cart_itemId" => $itemID);
  insertData("cart_items", $values);
}
