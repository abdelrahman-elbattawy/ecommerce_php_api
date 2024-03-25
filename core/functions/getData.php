<?php

function getData($table, $where = null, $values = null, $json = true)
{
  global $con;
  $data = array();

  if ($where == null) {
    $stmt = $con->prepare("SELECT * FROM $table");
  } else {
    $stmt = $con->prepare("SELECT * FROM $table WHERE $where");
  }

  $stmt->execute($values);
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  $count  = $stmt->rowCount();

  if ($json == true) {
    if ($count > 0) {
      printResults(ResultType::Success, $data);
    } else {
      printResults(ResultType::Failure, "No data!");
    }
  }

  return $data;
}
