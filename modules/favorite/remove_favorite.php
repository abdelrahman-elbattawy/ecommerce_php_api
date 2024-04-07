<?php

include "../../core/DB/connect.php";
include "../../core/functions/printResult.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/deleteData.php";

$userID = filterRequest("userID");
$itemID = filterRequest("itemID");

if (!empty($itemID) && !empty($userID)) {

  deleteData("favorite_items", "fav_userID = $userID AND fav_itemID = $itemID");
}
