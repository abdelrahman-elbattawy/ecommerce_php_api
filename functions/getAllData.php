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
  } else {
    printResults(ResultType::Failure, "falire to get all data");
  }
  return $count;
}
