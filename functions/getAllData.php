<?php
function getAllData($table, $where = null, $values = null)
{
  global $con;
  $data = array();
  $stmt = $con->prepare("SELECT  * FROM $table WHERE   $where ");
  $stmt->execute($values);
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $count  = $stmt->rowCount();
  if ($count > 0) {
    printResults(ResultType::Success, $data);
    // echo json_encode(array("status" => "success", "data" => $data));
  } else {
    printResults(ResultType::Failure, "falire to get all data");
    // echo json_encode(array("status" => "failure"));
  }
  return $count;
}
