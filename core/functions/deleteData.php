<?php
function deleteData($table, $where, $json = true)
{
  global $con;
  $stmt = $con->prepare("DELETE FROM $table WHERE $where");
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
