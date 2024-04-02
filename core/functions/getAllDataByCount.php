<?php

function getAllDataByCount($table, $where = null, $values = null, $count = 5, $json = true)
{
  global $con;
  $data = array();

  if ($where == null) {
    $stmt = $con->prepare("SELECT * FROM $table ORDER BY RAND() LIMIT $count");
  } else {
    $stmt = $con->prepare("SELECT * FROM $table WHERE $where ORDER BY RAND() LIMIT $count");
  }

  $stmt->execute($values);
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
