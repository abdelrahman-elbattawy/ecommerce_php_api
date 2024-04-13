<?php
function deleteData($table, $where, $json = true, $limit = 0)
{
  global $con;
  if ($limit > 0) {
    $stmt = $con->prepare("DELETE FROM $table WHERE $where LIMIT $limit");
  } else {
    $stmt = $con->prepare("DELETE FROM $table WHERE $where");
  }
  $stmt->execute();
  $count = $stmt->rowCount();
  if ($json == true) {
    if ($count > 0) {
      printResults(ResultType::Success);
    } else {
      printResults(ResultType::Failure, "No data!");
    }
  }
}
