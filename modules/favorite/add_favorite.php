<?php

include "../../core/DB/connect.php";
include "../../core/functions/printResult.php";
include "../../core/functions/filterRequest.php";
include "../../core/functions/insertData.php";

$userID = filterRequest("userID");
$itemID = filterRequest("itemID");

if (!empty($itemID) && !empty($userID)) {

  $values = array("fav_userID" => $userID, "fav_itemID" => $itemID);
  insertData("favorite_items", $values);
}
