<?php
function deleteData($table, $where, $json = true)
{
  global $con;
  $stmt = $con->prepare("DELETE FROM $table WHERE $where");
  $stmt->execute();
  $count = $stmt->rowCount();
  if ($json == true) {
    if ($count > 0) {
      printResults(ResultType::Success, null);
      // echo json_encode(array("status" => "success"));
    } else {
      printResults(ResultType::Failure, "failure to delete data");
      // echo json_encode(array("status" => "failure"));
    }
  }
  return $count;
}
