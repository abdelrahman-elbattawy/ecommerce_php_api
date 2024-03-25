<?php

function updateData($table, $data, $where, $json = true)
{
  global $con;
  $cols = array();
  $vals = array();

  foreach ($data as $key => $val) {
    $vals[] = "$val";
    $cols[] = "`$key` =  ? ";
  }
  $sql = "UPDATE $table SET " . implode(', ', $cols) . " WHERE $where";

  $stmt = $con->prepare($sql);
  $stmt->execute($vals);
  $count = $stmt->rowCount();

  if ($json == true) {
    if ($count > 0) {
      printResults(ResultType::Success);
    } else {
      printResults(ResultType::Failure, "No data!");
    }
  }
}
