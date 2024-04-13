<?php

include "../../core/DB/connect.php";
include "../../core/functions/printResult.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/deleteData.php";

$userID = filterRequest("userID");
$itemID = filterRequest("itemID");

if (!empty($itemID) && !empty($userID)) {

  deleteData("cart_items", "cart_userId = $userID AND cart_itemId = $itemID", true, 1);
}
